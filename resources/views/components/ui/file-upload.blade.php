@props([
    'label' => null,
    'name' => null,
    'id' => null,

    'variant' => 'default',
    'size' => 'md',
    'shadow' => 'sm',

    'hint' => null,
    'error' => null,
    'success' => null,

    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'description' => null,

    'multiple' => false,
    'accept' => null,
    'maxMb' => null,
    'showPreview' => false,
    'mode' => 'dropzone',

    'dragText' => 'Drag and drop files here',
    'browseText' => 'or click to browse',
    'emptyText' => 'No files selected.',
])

@php
    $inputId = $id ?? $name ?? 'file_upload_' . uniqid();

    $hasError = filled($error);
    $hasSuccess = filled($success) && ! $hasError;

    $sizeClasses = match ($size) {
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'lg' => 'text-base',
        'xl' => 'text-lg',
        default => 'text-sm',
    };

    $dropzoneHeightClasses = match ($size) {
        'xs' => 'min-h-24 rounded-lg px-3 py-3',
        'sm' => 'min-h-28 rounded-lg px-4 py-4',
        'lg' => 'min-h-36 rounded-2xl px-5 py-5',
        'xl' => 'min-h-40 rounded-2xl px-6 py-6',
        default => 'min-h-32 rounded-xl px-4 py-4',
    };

    $inputHeightClasses = match ($size) {
        'xs' => 'h-8 rounded-lg px-3',
        'sm' => 'h-9 rounded-lg px-3.5',
        'lg' => 'h-11 rounded-2xl px-4.5',
        'xl' => 'h-12 rounded-2xl px-5',
        default => 'h-10 rounded-xl px-4',
    };

    $buttonHeightClasses = match ($size) {
        'xs' => 'h-6 rounded-md px-2 text-[11px]',
        'sm' => 'h-7 rounded-md px-2.5 text-xs',
        'lg' => 'h-9 rounded-xl px-4 text-sm',
        'xl' => 'h-10 rounded-xl px-4 text-sm',
        default => 'h-8 rounded-lg px-3 text-xs',
    };

    $shadowClasses = match ($shadow) {
        'none' => 'shadow-none',
        'sm' => 'shadow-sm',
        'md' => 'shadow',
        'lg' => 'shadow-lg',
        'xl' => 'shadow-xl',
        default => 'shadow-sm',
    };

    $variantClasses = match ($variant) {
        'filled' => 'bg-muted/60 border-transparent',
        'ghost' => 'bg-transparent border-border',
        default => 'bg-background border-border',
    };

    $stateClasses = $hasSuccess
        ? 'border-emerald-500/70 focus-within:border-emerald-500 focus-within:ring-emerald-500/20'
        : 'hover:border-foreground/20 focus-within:border-primary focus-within:ring-primary/20';

    $dropzoneClasses = implode(' ', [
        'relative w-full border-2 border-dashed transition-all duration-200 focus-within:ring-4',
        $dropzoneHeightClasses,
        $shadowClasses,
        $variantClasses,
        $stateClasses,
    ]);

    $inputWrapperClasses = implode(' ', [
        'flex w-full items-center gap-3 border transition-all duration-200 focus-within:ring-4 overflow-hidden',
        $inputHeightClasses,
        $sizeClasses,
        $shadowClasses,
        $variantClasses,
        $stateClasses,
        ($disabled || $readonly) ? 'cursor-not-allowed opacity-60' : 'cursor-pointer',
    ]);

    $inputButtonClasses = implode(' ', [
        'inline-flex shrink-0 items-center justify-center gap-2 border border-border bg-muted font-medium text-foreground transition',
        $buttonHeightClasses,
        ($disabled || $readonly) ? 'cursor-not-allowed' : 'hover:bg-muted/80',
    ]);

    $acceptList = collect(explode(',', (string) $accept))
        ->map(fn ($item) => trim($item))
        ->filter()
        ->values();

    $acceptLabel = $acceptList->isNotEmpty()
        ? $acceptList->implode(', ')
        : null;
@endphp

<div
    {{ $attributes->only(['wire:key']) }}
    class="w-full space-y-2"
    x-data="{
        isDragging: false,
        files: [],
        maxMb: {{ $maxMb !== null ? (float) $maxMb : 'null' }},
        accept: {{ \Illuminate\Support\Js::from($accept) }},
        multiple: {{ $multiple ? 'true' : 'false' }},
        showPreview: {{ $showPreview ? 'true' : 'false' }},
        errorMessage: null,

        get hasAnyError() {
            return !!this.errorMessage;
        },

        init() {
            this.syncFilesFromInput();
        },

        makeFileId(file, index) {
            return [
                file.name || 'file',
                file.size || 0,
                file.type || 'unknown',
                file.lastModified || 0,
                index,
            ].join('__');
        },

        cleanupPreviews(files = this.files) {
            files.forEach(file => {
                if (file.preview) {
                    URL.revokeObjectURL(file.preview);
                }
            });
        },

        syncFilesFromInput() {
            const input = this.$refs.input;

            if (!input || !input.files) {
                this.cleanupPreviews();
                this.files = [];
                this.validateFiles();
                return;
            }

            const nextFiles = Array.from(input.files).map((file, index) => ({
                id: this.makeFileId(file, index),
                name: file.name,
                size: file.size,
                type: file.type,
                lastModified: file.lastModified ?? 0,
                preview: file.type.startsWith('image/') ? URL.createObjectURL(file) : null,
            }));

            this.cleanupPreviews();
            this.files = nextFiles;
            this.validateFiles();
        },

        handleChange() {
            this.syncFilesFromInput();
        },

        handleDrop(event) {
            if (this.disabledOrReadonly()) return;

            const droppedFiles = event.dataTransfer.files;

            if (!droppedFiles || !droppedFiles.length) return;

            const input = this.$refs.input;
            const dt = new DataTransfer();

            if (this.multiple) {
                Array.from(droppedFiles).forEach(file => dt.items.add(file));
            } else {
                dt.items.add(droppedFiles[0]);
            }

            input.files = dt.files;
            this.syncFilesFromInput();
            this.dispatchNativeEvents(input);
        },

        removeFile(index) {
            if (this.disabledOrReadonly()) return;

            const input = this.$refs.input;
            const dt = new DataTransfer();

            Array.from(input.files || []).forEach((file, fileIndex) => {
                if (fileIndex !== index) {
                    dt.items.add(file);
                }
            });

            input.files = dt.files;
            this.errorMessage = null;
            this.syncFilesFromInput();
            this.dispatchNativeEvents(input);
        },

        clearFiles() {
            if (this.disabledOrReadonly()) return;

            const input = this.$refs.input;
            input.value = '';
            this.errorMessage = null;
            this.cleanupPreviews();
            this.files = [];
            this.dispatchNativeEvents(input);
        },

        openPicker() {
            if (this.disabledOrReadonly()) return;
            this.$refs.input.click();
        },

        disabledOrReadonly() {
            return {{ $disabled ? 'true' : 'false' }} || {{ $readonly ? 'true' : 'false' }};
        },

        validateFiles() {
            this.errorMessage = null;

            if (!this.files.length) {
                return;
            }

            if (this.maxMb !== null) {
                const invalid = this.files.find(file => (file.size / 1024 / 1024) > this.maxMb);

                if (invalid) {
                    this.errorMessage = 'The file ' + invalid.name + ' exceeds the maximum size of ' + this.maxMb + ' MB.';
                    return;
                }
            }

            if (this.accept) {
                const rules = this.accept.split(',').map(rule => rule.trim()).filter(Boolean);

                const matchesRule = (file, rule) => {
                    if (rule.endsWith('/*')) {
                        const base = rule.replace('/*', '');
                        return file.type.startsWith(base + '/');
                    }

                    if (rule.startsWith('.')) {
                        return file.name.toLowerCase().endsWith(rule.toLowerCase());
                    }

                    return file.type === rule;
                };

                const invalid = this.files.find(file => !rules.some(rule => matchesRule(file, rule)));

                if (invalid) {
                    this.errorMessage = 'The file ' + invalid.name + ' is not an allowed file type.';
                    return;
                }
            }
        },

        dispatchNativeEvents(input) {
            input.dispatchEvent(new Event('input', { bubbles: true }));
            input.dispatchEvent(new Event('change', { bubbles: true }));
        },

        fileSize(size) {
            if (size < 1024) return size + ' B';
            if (size < 1024 * 1024) return (size / 1024).toFixed(1) + ' KB';
            return (size / 1024 / 1024).toFixed(2) + ' MB';
        },

        fileIcon(type, name) {
            if (type.startsWith('image/')) return 'image';
            if (type === 'application/pdf' || name.toLowerCase().endsWith('.pdf')) return 'pdf';

            if (
                type.includes('word') ||
                name.toLowerCase().endsWith('.doc') ||
                name.toLowerCase().endsWith('.docx')
            ) return 'doc';

            if (
                type.includes('excel') ||
                type.includes('spreadsheet') ||
                name.toLowerCase().endsWith('.xls') ||
                name.toLowerCase().endsWith('.xlsx') ||
                name.toLowerCase().endsWith('.csv')
            ) return 'sheet';

            return 'file';
        },
    }"
    x-on:beforeunload.window="cleanupPreviews()"
>
    @if($label)
        <div class="space-y-1">
            <label for="{{ $inputId }}" class="inline-flex items-center gap-1 text-sm font-medium text-foreground">
                <span>{{ $label }}</span>
                @if($required)
                    <span class="text-red-500">*</span>
                @endif
            </label>

            @if($description)
                <p class="text-xs text-muted-foreground">
                    {{ $description }}
                </p>
            @endif
        </div>
    @endif

    <input
        x-ref="input"
        id="{{ $inputId }}"
        type="file"
        class="sr-only"
        @if($name) name="{{ $multiple ? $name . '[]' : $name }}" @endif
        @if($required) required @endif
        @if($disabled) disabled @endif
        @if($readonly) disabled @endif
        @if($multiple) multiple @endif
        @if($accept) accept="{{ $accept }}" @endif
        @change="handleChange()"
        {{ $attributes->except(['class', 'wire:key']) }}
    />

    @if($mode === 'dropzone')
        <div class="relative">
            <label
                for="{{ $inputId }}"
                class="{{ $dropzoneClasses }} flex cursor-pointer flex-col items-center justify-center text-center
                    @if($error) border-red-500/70 focus-within:border-red-500 focus-within:ring-red-500/20 @endif"
                :class="{
                    'ring-4 border-primary bg-muted/40': isDragging,
                    'cursor-not-allowed opacity-60': disabledOrReadonly(),
                    'border-red-500/70 focus-within:border-red-500 focus-within:ring-red-500/20': hasAnyError,
                }"
                @dragover.prevent="if (!disabledOrReadonly()) isDragging = true"
                @dragleave.prevent="isDragging = false"
                @drop.prevent="isDragging = false; handleDrop($event)"
            >
                <div class="flex flex-col items-center justify-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-muted text-muted-foreground">
                        <x-lucide-upload-cloud class="h-6 w-6" />
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm font-medium text-foreground" x-show="!files.length">
                            {{ $dragText }}
                        </p>

                        <p class="text-sm font-medium text-foreground" x-show="files.length">
                            File selected<span x-show="files.length > 1">s</span>
                        </p>

                        <p class="text-xs text-muted-foreground" x-show="!files.length">
                            {{ $browseText }}
                        </p>

                        <p class="text-xs text-muted-foreground truncate" x-show="files.length && !showPreview">
                            <template x-if="files.length === 1">
                                <span x-text="files[0].name"></span>
                            </template>

                            <template x-if="files.length > 1">
                                <span x-text="files.length + ' files selected'"></span>
                            </template>
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center justify-center gap-2 text-[11px] text-muted-foreground">
                        @if($acceptLabel)
                            <span class="rounded-full bg-muted px-2.5 py-1">
                                Allowed: {{ $acceptLabel }}
                            </span>
                        @endif

                        @if($maxMb)
                            <span class="rounded-full bg-muted px-2.5 py-1">
                                Max: {{ rtrim(rtrim(number_format((float) $maxMb, 2, '.', ''), '0'), '.') }} MB
                            </span>
                        @endif

                        <span class="rounded-full bg-muted px-2.5 py-1">
                            {{ $multiple ? 'Multiple files allowed' : 'Single file only' }}
                        </span>
                    </div>
                </div>
            </label>
        </div>
    @else
        <div class="space-y-2">
            <div
                class="{{ $inputWrapperClasses }} group
                    @if($error) border-red-500/70 focus-within:border-red-500 focus-within:ring-red-500/20 @endif"
                :class="{
                    'border-red-500/70 focus-within:border-red-500 focus-within:ring-red-500/20': hasAnyError,
                }"
            >
                <div class="flex min-w-0 flex-1 items-center gap-3 text-left">
                    <div
                        class="{{ $inputButtonClasses }} bg-transparent border-none shadow-none text-primary cursor-pointer"
                        @click.stop="openPicker()"
                    >
                        <x-lucide-upload class="h-4 w-4" />
                        <span>Upload</span>
                    </div>

                    <div class="h-5 w-px bg-border"></div>

                    <p class="truncate text-left text-muted-foreground">
                        <template x-if="files.length === 0">
                            <span>Click anywhere to upload file</span>
                        </template>

                        <template x-if="files.length === 1">
                            <span class="font-medium text-foreground" x-text="files[0].name"></span>
                        </template>

                        <template x-if="files.length > 1">
                            <span class="font-medium text-foreground" x-text="files.length + ' files selected'"></span>
                        </template>
                    </p>
                </div>

                <button
                    type="button"
                    class="mr-3 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-muted-foreground transition hover:bg-muted hover:text-foreground"
                    x-show="files.length && !showPreview && !disabledOrReadonly()"
                    x-cloak
                    @click.stop="clearFiles()"
                >
                    <x-lucide-x class="h-4 w-4" />
                </button>
            </div>

            <div class="flex flex-wrap items-center gap-2 text-[11px] text-muted-foreground">
                @if($acceptLabel)
                    <span class="rounded-full bg-muted px-2.5 py-1">
                        Allowed: {{ $acceptLabel }}
                    </span>
                @endif

                @if($maxMb)
                    <span class="rounded-full bg-muted px-2.5 py-1">
                        Max: {{ rtrim(rtrim(number_format((float) $maxMb, 2, '.', ''), '0'), '.') }} MB
                    </span>
                @endif

                <span class="rounded-full bg-muted px-2.5 py-1">
                    {{ $multiple ? 'Multiple files allowed' : 'Single file only' }}
                </span>
            </div>
        </div>
    @endif

    <div x-show="files.length && showPreview" x-cloak class="space-y-3">
        <div class="rounded-2xl border border-border bg-background p-3 shadow-sm">
            <div class="mb-3 flex items-center justify-between gap-3">
                <p class="text-sm font-medium text-foreground">
                    Selected file<span x-show="files.length > 1">s</span>
                </p>

                <button
                    type="button"
                    @click="clearFiles()"
                    x-show="files.length && !disabledOrReadonly()"
                    x-cloak
                    class="text-xs text-muted-foreground transition hover:text-foreground"
                >
                    Clear all
                </button>
            </div>

            <div class="space-y-2">
                <template x-for="(file, index) in files" :key="file.id">
                    <div class="flex items-center gap-3 rounded-xl border border-border bg-muted/40 p-2.5">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-border bg-background">
                            <template x-if="file.preview">
                                <img :src="file.preview" alt="" class="h-full w-full object-cover">
                            </template>

                            <template x-if="!file.preview">
                                <div class="text-muted-foreground">
                                    <template x-if="fileIcon(file.type, file.name) === 'pdf'">
                                        <x-lucide-file-text class="h-5 w-5" />
                                    </template>

                                    <template x-if="fileIcon(file.type, file.name) === 'image'">
                                        <x-lucide-image class="h-5 w-5" />
                                    </template>

                                    <template x-if="fileIcon(file.type, file.name) === 'doc'">
                                        <x-lucide-file-badge class="h-5 w-5" />
                                    </template>

                                    <template x-if="fileIcon(file.type, file.name) === 'sheet'">
                                        <x-lucide-sheet class="h-5 w-5" />
                                    </template>

                                    <template x-if="fileIcon(file.type, file.name) === 'file'">
                                        <x-lucide-file class="h-5 w-5" />
                                    </template>
                                </div>
                            </template>
                        </div>

                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium text-foreground" x-text="file.name"></p>
                            <p class="text-xs text-muted-foreground">
                                <span x-text="file.type || 'Unknown type'"></span>
                                <span class="mx-1">•</span>
                                <span x-text="fileSize(file.size)"></span>
                            </p>
                        </div>

                        <button
                            type="button"
                            class="shrink-0 text-muted-foreground transition hover:text-red-500"
                            @click="removeFile(index)"
                            x-show="!disabledOrReadonly()"
                        >
                            <x-lucide-x class="h-4 w-4" />
                        </button>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <div
        x-show="!files.length && (showPreview || '{{ $mode }}' === 'dropzone')"
        x-cloak
    >
        <p class="text-xs text-muted-foreground">{{ $emptyText }}</p>
    </div>

    @if($error)
        <p class="text-xs text-red-500" x-show="!errorMessage">
            {{ $error }}
        </p>
    @elseif($success)
        <p class="text-xs text-emerald-600 dark:text-emerald-400" x-show="!errorMessage">
            {{ $success }}
        </p>
    @elseif($hint)
        <p class="text-xs text-muted-foreground" x-show="!errorMessage">
            {{ $hint }}
        </p>
    @endif

    <template x-if="errorMessage">
        <p class="text-xs text-red-500" x-text="errorMessage"></p>
    </template>
</div>
