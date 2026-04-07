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

    'prefix' => null,
    'suffix' => null,

    'loading' => false,
    'clearable' => false,
    'togglePassword' => false,

    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'description' => null,

    'suggestions' => [],
    'autocomplete' => false,
    'multipleAutocomplete' => false,
    'emptyText' => 'No results found.',

    'wireTarget' => null,
])

@php
    $inputId = $id ?? $name ?? 'input_' . uniqid();

    $hasError = filled($error);
    $hasSuccess = filled($success) && ! $hasError;

    $type = $attributes->get('type', 'text');
    $isPassword = $type === 'password';

    $hasLeading = isset($leading) || filled($prefix);
    $hasTrailing = isset($trailing) || filled($suffix) || $clearable || ($isPassword && $togglePassword);

    $sizeClasses = match ($size) {
        'xs' => 'min-h-8 text-xs rounded-lg',
        'sm' => 'min-h-9 text-sm rounded-lg',
        'lg' => 'min-h-11 text-base rounded-2xl',
        'xl' => 'min-h-12 text-lg rounded-2xl',
        default => 'min-h-10 text-sm rounded-xl',
    };

    $shadowClasses = match ($shadow) {
        'none' => 'shadow-none',
        'sm' => 'shadow-sm',
        'md' => 'shadow',
        'lg' => 'shadow-lg',
        'xl' => 'shadow-xl',
        default => 'shadow-sm',
    };

    $wrapperPaddingClasses = match ($size) {
        'xs' => 'px-2.5',
        'sm' => 'px-3',
        'lg' => 'px-4',
        'xl' => 'px-4',
        default => 'px-3',
    };

    $multiplePaddingClasses = match ($size) {
        'xs' => 'px-2.5 py-1.5',
        'sm' => 'px-3 py-2',
        'lg' => 'px-4 py-2.5',
        'xl' => 'px-4 py-3',
        default => 'px-3 py-2',
    };

    $variantClasses = match ($variant) {
        'filled' => 'bg-muted/60 border-transparent focus-within:bg-background',
        'ghost' => 'bg-transparent border-transparent shadow-none',
        default => 'bg-background border-border',
    };

    $stateClasses = $hasError
        ? 'border-red-500/70 focus-within:border-red-500 focus-within:ring-red-500/20'
        : ($hasSuccess
            ? 'border-emerald-500/70 focus-within:border-emerald-500 focus-within:ring-emerald-500/20'
            : 'focus-within:border-primary focus-within:ring-primary/20');

    $baseWrapperClasses = implode(' ', [
        'relative w-full border transition-all duration-200',
        $shadowClasses,
        'hover:border-foreground/20',
        'focus-within:ring-4 focus-within:shadow-md',
        'disabled:cursor-not-allowed disabled:opacity-60',
        $sizeClasses,
        $variantClasses,
        $stateClasses,
    ]);

    $singleWrapperClasses = implode(' ', [
        $baseWrapperClasses,
        'flex items-center',
        $wrapperPaddingClasses,
    ]);

    $multipleWrapperClasses = implode(' ', [
        $baseWrapperClasses,
        'flex flex-wrap items-center gap-2 cursor-text',
        $multiplePaddingClasses,
    ]);

    $singleInputClasses = implode(' ', [
        'block w-full min-w-0 flex-1 bg-transparent outline-none placeholder:text-muted-foreground',
        'disabled:cursor-not-allowed disabled:opacity-60',
        'readonly:cursor-default',
        'h-full min-h-[1.5rem] py-0 leading-normal',
        $hasLeading ? 'pl-7' : '',
        $hasTrailing ? 'pr-7' : '',
    ]);

    $normalizedSuggestions = collect($suggestions)->map(function ($item) {
        if (is_array($item)) {
            return [
                'label' => (string) ($item['label'] ?? $item['value'] ?? ''),
                'value' => (string) ($item['value'] ?? $item['label'] ?? ''),
            ];
        }

        return [
            'label' => (string) $item,
            'value' => (string) $item,
        ];
    })->values()->all();

    $wireTargetAttr = filled($wireTarget) ? $wireTarget : $attributes->get('wire:target');
@endphp

<div
    class="w-full space-y-2"
    x-data="{
        open: false,
        highlightedIndex: -1,
        search: '',
        selectedItems: [],
        showPassword: false,
        suggestions: {{ \Illuminate\Support\Js::from($normalizedSuggestions) }},
        autocompleteEnabled: {{ $autocomplete ? 'true' : 'false' }},
        multipleEnabled: {{ $multipleAutocomplete ? 'true' : 'false' }},
        disabled: {{ $disabled ? 'true' : 'false' }},
        readonly: {{ $readonly ? 'true' : 'false' }},

        init() {
            const input = this.$refs.input;

            if (this.multipleEnabled) {
                this.search = '';
                input.value = '';
            } else {
                this.search = input.value || '';
            }
        },

        get filteredSuggestions() {
            let items = this.suggestions;

            if (this.multipleEnabled) {
                items = items.filter(item => !this.selectedItems.some(selected => selected.value === item.value));
            }

            const keyword = (this.search || '').trim().toLowerCase();

            if (!keyword) {
                return items;
            }

            return items.filter(item =>
                item.label.toLowerCase().includes(keyword) ||
                item.value.toLowerCase().includes(keyword)
            );
        },

        get shouldShowDropdown() {
            return (this.autocompleteEnabled || this.multipleEnabled)
                && this.open
                && !this.disabled
                && !this.readonly;
        },

        get hasValue() {
            if (this.multipleEnabled) {
                return this.selectedItems.length > 0 || !!(this.search && this.search.length);
            }

            return !!(this.search && this.search.length);
        },

        onInput(event) {
            this.search = event.target.value;
            this.highlightedIndex = this.filteredSuggestions.length ? 0 : -1;

            if (this.autocompleteEnabled || this.multipleEnabled) {
                this.open = true;
            }
        },

        selectItem(item) {
            if (this.disabled || this.readonly) return;

            if (this.multipleEnabled) {
                if (!this.selectedItems.some(selected => selected.value === item.value)) {
                    this.selectedItems.push(item);
                }

                this.search = '';
                this.$refs.input.value = '';
                this.open = false;
                this.highlightedIndex = -1;
                this.$refs.input.dispatchEvent(new Event('input', { bubbles: true }));
                this.$refs.input.dispatchEvent(new Event('change', { bubbles: true }));
                this.$refs.input.focus();
                return;
            }

            this.search = item.label;
            this.$refs.input.value = item.value;
            this.open = false;
            this.highlightedIndex = -1;

            this.$refs.input.dispatchEvent(new Event('input', { bubbles: true }));
            this.$refs.input.dispatchEvent(new Event('change', { bubbles: true }));
        },

        removeItem(index) {
            if (this.disabled || this.readonly) return;

            this.selectedItems.splice(index, 1);
            this.$refs.input.dispatchEvent(new Event('input', { bubbles: true }));
            this.$refs.input.dispatchEvent(new Event('change', { bubbles: true }));
            this.$nextTick(() => this.$refs.input.focus());
        },

        onFocus() {
            if (this.disabled || this.readonly) return;

            if (this.autocompleteEnabled || this.multipleEnabled) {
                this.open = true;
            }
        },

        onKeydown(event) {
            if (this.disabled || this.readonly) return;

            if (!this.shouldShowDropdown) {
                if (event.key === 'ArrowDown' && this.filteredSuggestions.length) {
                    this.open = true;
                    this.highlightedIndex = 0;
                }

                if (this.multipleEnabled && event.key === 'Backspace' && !this.search && this.selectedItems.length) {
                    this.selectedItems.pop();
                    this.$refs.input.dispatchEvent(new Event('input', { bubbles: true }));
                    this.$refs.input.dispatchEvent(new Event('change', { bubbles: true }));
                }

                return;
            }

            if (event.key === 'ArrowDown') {
                event.preventDefault();
                if (!this.filteredSuggestions.length) return;
                this.highlightedIndex = (this.highlightedIndex + 1) % this.filteredSuggestions.length;
            }

            if (event.key === 'ArrowUp') {
                event.preventDefault();
                if (!this.filteredSuggestions.length) return;
                this.highlightedIndex = this.highlightedIndex <= 0
                    ? this.filteredSuggestions.length - 1
                    : this.highlightedIndex - 1;
            }

            if (event.key === 'Enter') {
                if (this.highlightedIndex >= 0 && this.filteredSuggestions[this.highlightedIndex]) {
                    event.preventDefault();
                    this.selectItem(this.filteredSuggestions[this.highlightedIndex]);
                }
            }

            if (event.key === 'Escape') {
                this.open = false;
                this.highlightedIndex = -1;
            }

            if (this.multipleEnabled && event.key === 'Backspace' && !this.search && this.selectedItems.length) {
                this.selectedItems.pop();
                this.$refs.input.dispatchEvent(new Event('input', { bubbles: true }));
                this.$refs.input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        },

        clearInput() {
            if (this.disabled || this.readonly) return;

            this.showPassword = false;

            if (this.multipleEnabled) {
                this.selectedItems = [];
                this.search = '';
                this.$refs.input.value = '';
                this.$refs.input.dispatchEvent(new Event('input', { bubbles: true }));
                this.$refs.input.dispatchEvent(new Event('change', { bubbles: true }));
                this.$refs.input.focus();
                return;
            }

            this.search = '';
            this.$refs.input.value = '';
            this.$refs.input.dispatchEvent(new Event('input', { bubbles: true }));
            this.$refs.input.dispatchEvent(new Event('change', { bubbles: true }));
            this.$refs.input.focus();
        }
    }"
    @click.away="open = false"
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

    <div class="relative">
        @if($multipleAutocomplete)
            <div
                class="{{ $multipleWrapperClasses }}"
                @if($wireTargetAttr)
                    wire:loading.class="opacity-70 pointer-events-none"
                wire:target="{{ $wireTargetAttr }}"
                @endif
                @click="$refs.input.focus()"
            >
                @if($prefix)
                    <span class="shrink-0 text-sm text-muted-foreground">
                        {{ $prefix }}
                    </span>
                @elseif(isset($leading))
                    <span class="shrink-0 text-muted-foreground">
                        {{ $leading }}
                    </span>
                @endif

                <template x-for="(item, index) in selectedItems" :key="item.value">
                    <span class="inline-flex max-w-full items-center gap-1 rounded-full border border-border bg-muted px-2.5 py-1 text-xs font-medium text-foreground">
                        <span class="truncate" x-text="item.label"></span>
                        <button
                            type="button"
                            class="shrink-0 text-muted-foreground transition hover:text-foreground disabled:pointer-events-none disabled:opacity-50"
                            @click.stop="removeItem(index)"
                            :disabled="disabled || readonly"
                        >
                            <x-lucide-x class="h-3.5 w-3.5" />
                        </button>
                    </span>
                </template>

                <input
                    x-ref="input"
                    id="{{ $inputId }}"
                    type="text"
                    @if($disabled) disabled @endif
                    @if($readonly) readonly @endif
                    x-model="search"
                    @input="onInput($event)"
                    @focus="onFocus()"
                    @keydown="onKeydown($event)"
                    autocomplete="off"
                    placeholder="{{ $attributes->get('placeholder') }}"
                    class="min-w-[120px] flex-1 bg-transparent outline-none placeholder:text-muted-foreground"
                    @if($wireTargetAttr)
                        wire:loading.attr="disabled"
                    wire:target="{{ $wireTargetAttr }}"
                    @endif
                />

                @if($name)
                    <template x-for="item in selectedItems" :key="'hidden-' + item.value">
                        <input type="hidden" name="{{ $name }}[]" :value="item.value">
                    </template>
                @endif

                @if($suffix)
                    <span class="shrink-0 text-sm text-muted-foreground">
                        {{ $suffix }}
                    </span>
                @elseif($clearable)
                    <button
                        x-show="hasValue && !disabled && !readonly"
                        x-cloak
                        type="button"
                        @click.stop="if (!disabled && !readonly) clearInput()"
                        :disabled="disabled || readonly"
                        @if($wireTargetAttr)
                            wire:loading.remove
                        wire:target="{{ $wireTargetAttr }}"
                        @endif
                        class="shrink-0 text-muted-foreground transition hover:text-foreground disabled:pointer-events-none disabled:opacity-50"
                    >
                        <x-lucide-x class="h-4 w-4" />
                    </button>
                @elseif(isset($trailing))
                    <span class="shrink-0 text-muted-foreground">
                        {{ $trailing }}
                    </span>
                @endif
            </div>
        @else
            <div
                class="{{ $singleWrapperClasses }}"
                @if($wireTargetAttr)
                    wire:loading.class="opacity-70"
                wire:target="{{ $wireTargetAttr }}"
                @endif
            >
                @if($prefix)
                    <div class="absolute left-3 top-1/2 z-10 -translate-y-1/2 text-sm text-muted-foreground">
                        {{ $prefix }}
                    </div>
                @elseif(isset($leading))
                    <div class="absolute left-3 top-1/2 z-10 -translate-y-1/2 text-muted-foreground">
                        {{ $leading }}
                    </div>
                @endif

                <input
                    x-ref="input"
                    id="{{ $inputId }}"
                    @if($name) name="{{ $name }}" @endif
                    type="{{ $type }}"
                    x-bind:type="(showPassword && {{ $isPassword && $togglePassword ? 'true' : 'false' }}) ? 'text' : '{{ $type }}'"
                    @if($required) required @endif
                    @if($disabled) disabled @endif
                    @if($readonly) readonly @endif
                    x-model="search"
                    @input="onInput($event)"
                    @focus="onFocus()"
                    @keydown="onKeydown($event)"
                    autocomplete="off"
                    {{ $attributes->except(['wireTarget', 'type'])->merge(['class' => $singleInputClasses]) }}
                    @if($wireTargetAttr)
                        wire:loading.attr="disabled"
                    wire:target="{{ $wireTargetAttr }}"
                    @endif
                />

                @if($suffix)
                    <div class="absolute right-3 top-1/2 z-10 -translate-y-1/2 text-sm text-muted-foreground">
                        {{ $suffix }}
                    </div>
                @elseif($isPassword && $togglePassword)
                    <button
                        x-show="hasValue && !disabled && !readonly"
                        x-cloak
                        type="button"
                        @click="showPassword = !showPassword"
                        :disabled="disabled || readonly"
                        @if($wireTargetAttr)
                            wire:loading.remove
                        wire:target="{{ $wireTargetAttr }}"
                        @endif
                        class="absolute right-3 top-1/2 z-10 -translate-y-1/2 text-muted-foreground transition hover:text-foreground disabled:pointer-events-none disabled:opacity-50"
                    >
                        <x-lucide-eye x-show="!showPassword" x-cloak class="h-4 w-4" />
                        <x-lucide-eye-off x-show="showPassword" x-cloak class="h-4 w-4" />
                    </button>
                @elseif($clearable)
                    <button
                        x-show="hasValue && !disabled && !readonly"
                        x-cloak
                        type="button"
                        @click="if (!disabled && !readonly) clearInput()"
                        :disabled="disabled || readonly"
                        @if($wireTargetAttr)
                            wire:loading.remove
                        wire:target="{{ $wireTargetAttr }}"
                        @endif
                        class="absolute right-3 top-1/2 z-10 -translate-y-1/2 text-muted-foreground transition hover:text-foreground disabled:pointer-events-none disabled:opacity-50"
                    >
                        <x-lucide-x class="h-4 w-4" />
                    </button>
                @elseif(isset($trailing))
                    <div class="absolute right-3 top-1/2 z-10 -translate-y-1/2 text-muted-foreground">
                        {{ $trailing }}
                    </div>
                @endif
            </div>
        @endif

        <div
            x-show="shouldShowDropdown"
            x-transition
            x-cloak
            class="absolute z-30 mt-2 w-full overflow-hidden rounded-2xl border border-border bg-background shadow-xl"
        >
            <div class="max-h-64 overflow-y-auto p-2">
                <template x-if="filteredSuggestions.length">
                    <div class="space-y-1">
                        <template x-for="(item, index) in filteredSuggestions" :key="item.value">
                            <button
                                type="button"
                                class="flex w-full items-center justify-between rounded-xl px-3 py-2 text-left text-sm transition"
                                :class="highlightedIndex === index ? 'bg-muted text-foreground' : 'text-muted-foreground hover:bg-muted hover:text-foreground'"
                                @mouseenter="highlightedIndex = index"
                                @click="selectItem(item)"
                            >
                                <span x-text="item.label"></span>
                                <x-lucide-check class="h-4 w-4" x-show="!multipleEnabled && search === item.label" x-cloak />
                            </button>
                        </template>
                    </div>
                </template>

                <template x-if="!filteredSuggestions.length">
                    <div class="px-3 py-2 text-sm text-muted-foreground">
                        {{ $emptyText }}
                    </div>
                </template>
            </div>
        </div>
    </div>

    @if($error)
        <p class="text-xs text-red-500">{{ $error }}</p>
    @elseif($success)
        <p class="text-xs text-emerald-600 dark:text-emerald-400">{{ $success }}</p>
    @elseif($hint)
        <p class="text-xs text-muted-foreground">{{ $hint }}</p>
    @endif
</div>
