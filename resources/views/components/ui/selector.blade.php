@props([
    'label' => null,
    'name' => null,
    'id' => null,

    'variant' => 'primary', // primary, secondary, filled, ghost
    'size' => 'md',         // xs, sm, md, lg, xl
    'shadow' => 'none',     // none, sm, md, lg, xl

    'hint' => null,
    'error' => null,
    'success' => null,
    'description' => null,

    'placeholder' => 'Select an option...',
    'searchPlaceholder' => 'Search...',
    'emptyText' => 'No options found.',
    'multiple' => false,
    'searchable' => false,
    'clearable' => false,
    'loading' => false,
    'disabled' => false,
    'readonly' => false,
    'required' => false,

    'value' => null,
    'options' => [],
])

@php
    $selectorId = $id ?: ($name ? str_replace(['[', ']'], ['_', ''], $name) : 'selector_' . uniqid());

    $normalizedOptions = collect($options)->map(function ($option) {
        if (is_array($option)) {
            return [
                'label' => $option['label'] ?? $option['value'] ?? '',
                'value' => (string) ($option['value'] ?? $option['label'] ?? ''),
                'description' => $option['description'] ?? null,
                'disabled' => (bool) ($option['disabled'] ?? false),
            ];
        }

        return [
            'label' => (string) $option,
            'value' => (string) $option,
            'description' => null,
            'disabled' => false,
        ];
    })->values()->all();

    $sizeClasses = match ($size) {
        'xs' => 'min-h-8 text-xs rounded-lg',
        'sm' => 'min-h-9 text-sm rounded-lg',
        'lg' => 'min-h-11 text-base rounded-2xl',
        'xl' => 'min-h-12 text-lg rounded-2xl',
        default => 'min-h-10 text-sm rounded-xl',
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

    $iconSizeClasses = match ($size) {
        'xs' => 'h-3.5 w-3.5',
        'sm' => 'h-4 w-4',
        'lg' => 'h-5 w-5',
        'xl' => 'h-5 w-5',
        default => 'h-4 w-4',
    };

    $pillClasses = match ($size) {
        'xs' => 'h-5 px-1.5 text-[10px] rounded-md',
        'sm' => 'h-6 px-2 text-[11px] rounded-md',
        'lg' => 'h-7 px-2.5 text-xs rounded-md',
        'xl' => 'h-8 px-3 text-sm rounded-lg',
        default => 'h-6 px-2 text-xs rounded-md',
    };

    $searchClasses = match ($size) {
        'xs' => 'px-2.5 py-2 text-xs',
        'sm' => 'px-3 py-2 text-sm',
        'lg' => 'px-4 py-2.5 text-base',
        'xl' => 'px-4 py-3 text-lg',
        default => 'px-3 py-2 text-sm',
    };

    $optionClasses = match ($size) {
        'xs' => 'px-2.5 py-2 text-xs rounded-md',
        'sm' => 'px-3 py-2 text-sm rounded-md',
        'lg' => 'px-4 py-2.5 text-base rounded-lg',
        'xl' => 'px-4 py-3 text-lg rounded-xl',
        default => 'px-3 py-2 text-sm rounded-lg',
    };

    $panelPaddingClasses = match ($size) {
        'xs' => 'p-2',
        'sm' => 'p-2',
        'lg' => 'p-2.5',
        'xl' => 'p-3',
        default => 'p-2',
    };

    $variantMap = [
        'primary' => 'bg-background border-border text-foreground',
        'secondary' => 'bg-secondary border-transparent text-foreground',
        'filled' => 'bg-muted/60 border-transparent text-foreground focus-within:bg-background',
        'ghost' => 'bg-transparent border-transparent shadow-none text-foreground',
    ];

    $placeholderTextClass = $variant === 'secondary'
        ? 'text-foreground/70'
        : 'text-muted-foreground';

    $iconTextClass = $variant === 'secondary'
        ? 'text-foreground/70'
        : 'text-muted-foreground';

    $shadowMap = [
        'none' => '',
        'sm' => 'shadow-sm',
        'md' => 'shadow',
        'lg' => 'shadow-lg',
        'xl' => 'shadow-xl',
    ];

    $stateClasses = filled($error)
        ? 'border-red-500/70 focus-within:border-red-500 focus-within:ring-red-500/20'
        : (filled($success)
            ? 'border-emerald-500/70 focus-within:border-emerald-500 focus-within:ring-emerald-500/20'
            : 'focus-within:border-primary focus-within:ring-primary/20');

    $disabledClasses = $disabled ? 'opacity-60 cursor-not-allowed pointer-events-none' : '';
    $readonlyClasses = $readonly ? 'cursor-default' : 'cursor-pointer';

    $triggerClasses = implode(' ', array_filter([
        'relative w-full border transition-all duration-200',
        'overflow-hidden text-left',
        'focus-within:ring-4 focus-within:shadow-md',
        $variant === 'secondary' ? 'hover:opacity-90' : 'hover:border-foreground/20',
        $sizeClasses,
        $shadowMap[$shadow] ?? '',
        $variantMap[$variant] ?? $variantMap['primary'],
        $stateClasses,
        $disabledClasses,
        $readonlyClasses,
        $multiple ? "flex flex-wrap items-center gap-2 cursor-text {$multiplePaddingClasses}" : "flex items-center {$wrapperPaddingClasses}",
    ]));

    $panelClasses = implode(' ', array_filter([
        'absolute z-50 mt-2 w-full overflow-hidden rounded-xl border border-border bg-background text-foreground shadow-xl',
        'isolate',
        $shadowMap[$shadow] ?? '',
    ]));

    if ($multiple) {
        if (is_array($value)) {
            $initialValue = array_values(array_map('strval', $value));
        } elseif (is_string($value) && $value !== '') {
            $decoded = json_decode($value, true);
            $initialValue = is_array($decoded)
                ? array_values(array_map('strval', $decoded))
                : [(string) $value];
        } else {
            $initialValue = [];
        }
    } else {
        $initialValue = filled($value) ? (string) $value : '';
    }

    $wireModel = $attributes->wire('model');
    $wireModelName = $wireModel?->value();

    $singleInputAttributes = $attributes;
    $multipleSelectAttributes = $attributes;
@endphp

<div
    x-data="{
        open: false,
        search: '',
        multiple: @js($multiple),
        searchable: @js($searchable),
        readonly: @js($readonly),
        disabled: @js($disabled),
        clearable: @js($clearable),
        placeholder: @js($placeholder),
        searchPlaceholder: @js($searchPlaceholder),
        emptyText: @js($emptyText),
        options: @js($normalizedOptions),
        selected: @js($initialValue),
        highlightedIndex: 0,
        model: {{ $wireModelName ? "\$wire.entangle('{$wireModelName}')" : 'null' }},

        get normalizedSelected() {
            return this.multiple
                ? (Array.isArray(this.selected) ? this.selected.map(String) : [])
                : String(this.selected ?? '');
        },

        get filteredOptions() {
            let items = this.options;

            if (this.searchable && this.search.trim() !== '') {
                const keyword = this.search.toLowerCase();

                items = items.filter(option => {
                    return String(option.label).toLowerCase().includes(keyword)
                        || String(option.value).toLowerCase().includes(keyword)
                        || String(option.description ?? '').toLowerCase().includes(keyword);
                });
            }

            return items;
        },

        get selectedOptions() {
            if (this.multiple) {
                return this.options.filter(option => this.normalizedSelected.includes(String(option.value)));
            }

            return this.options.filter(option => String(option.value) === this.normalizedSelected);
        },

        get selectedLabel() {
            if (this.multiple) {
                return '';
            }

            const found = this.options.find(option => String(option.value) === this.normalizedSelected);
            return found ? found.label : '';
        },

        get hasValue() {
            return this.multiple
                ? this.normalizedSelected.length > 0
                : this.normalizedSelected !== '';
        },

        normalizeIncoming(value) {
            if (this.multiple) {
                if (Array.isArray(value)) {
                    return value.map(String);
                }

                if (typeof value === 'string' && value !== '') {
                    try {
                        const parsed = JSON.parse(value);
                        return Array.isArray(parsed) ? parsed.map(String) : [String(value)];
                    } catch {
                        return [String(value)];
                    }
                }

                return [];
            }

            return value == null ? '' : String(value);
        },

        syncSelectedFromModel(value = null) {
            const incoming = value === null ? this.model : value;
            this.selected = this.normalizeIncoming(incoming);
        },

        syncModelFromSelected() {
            if (this.model === null || this.model === undefined) return;

            this.model = this.multiple
                ? [...this.normalizedSelected]
                : this.normalizedSelected;
        },

        syncSingle() {
            if (!this.$refs.hiddenInput) return;

            this.$refs.hiddenInput.value = this.normalizedSelected;
            this.$refs.hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
            this.$refs.hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
        },

        syncMultiple() {
            if (!this.$refs.multipleSelect) return;

            const select = this.$refs.multipleSelect;
            const values = this.normalizedSelected.map(String);

            Array.from(select.options).forEach(option => {
                option.selected = values.includes(String(option.value));
            });

            select.dispatchEvent(new Event('input', { bubbles: true }));
            select.dispatchEvent(new Event('change', { bubbles: true }));
        },

        syncOutputs() {
            this.syncModelFromSelected();

            if (this.multiple) {
                this.$nextTick(() => this.syncMultiple());
            } else {
                this.$nextTick(() => this.syncSingle());
            }
        },

        dispatchChange() {
            this.$dispatch('change', this.selected);
        },

        toggle() {
            if (this.disabled || this.readonly) return;

            this.open = !this.open;

            if (this.open) {
                this.$nextTick(() => {
                    if (this.searchable && this.$refs.searchInput) {
                        this.$refs.searchInput.focus();
                    }
                });
            } else {
                this.search = '';
            }
        },

        close() {
            this.open = false;
            this.search = '';
            this.highlightedIndex = 0;
        },

        resetSelection() {
            if (this.disabled || this.readonly) return;

            this.selected = this.multiple ? [] : '';
            this.syncOutputs();
            this.dispatchChange();
            this.close();
        },

        select(option) {
            if (option.disabled || this.disabled || this.readonly) return;

            if (this.multiple) {
                if (this.normalizedSelected.includes(String(option.value))) {
                    this.selected = this.normalizedSelected.filter(value => value !== String(option.value));
                } else {
                    this.selected = [...this.normalizedSelected, String(option.value)];
                }

                this.syncOutputs();
                this.dispatchChange();
                return;
            }

            this.selected = String(option.value);
            this.syncOutputs();
            this.dispatchChange();
            this.close();
        },

        remove(value) {
            if (!this.multiple || this.disabled || this.readonly) return;

            this.selected = this.normalizedSelected.filter(item => item !== String(value));
            this.syncOutputs();
            this.dispatchChange();
        },

        clear() {
            if (!this.clearable || this.disabled || this.readonly) return;

            this.selected = this.multiple ? [] : '';
            this.search = '';
            this.syncOutputs();
            this.dispatchChange();
        },

        isSelected(option) {
            return this.multiple
                ? this.normalizedSelected.includes(String(option.value))
                : this.normalizedSelected === String(option.value);
        },

        highlightNext() {
            if (!this.open || this.filteredOptions.length === 0) return;
            this.highlightedIndex = (this.highlightedIndex + 1) % this.filteredOptions.length;
        },

        highlightPrev() {
            if (!this.open || this.filteredOptions.length === 0) return;
            this.highlightedIndex = (this.highlightedIndex - 1 + this.filteredOptions.length) % this.filteredOptions.length;
        },

        selectHighlighted() {
            if (!this.open || this.filteredOptions.length === 0) return;
            this.select(this.filteredOptions[this.highlightedIndex]);
        },

        init() {
            if (this.model !== null && this.model !== undefined) {
                this.syncSelectedFromModel(this.model);

                this.$watch('model', value => {
                    const normalized = this.normalizeIncoming(value);
                    const current = JSON.stringify(this.selected);
                    const incoming = JSON.stringify(normalized);

                    if (current !== incoming) {
                        this.selected = normalized;
                    }
                });
            }

            this.$watch('selected', () => {
                if (this.multiple) {
                    this.$nextTick(() => this.syncMultiple());
                } else {
                    this.$nextTick(() => this.syncSingle());
                }
            });

            if (this.multiple) {
                this.$nextTick(() => this.syncMultiple());
            } else {
                this.$nextTick(() => this.syncSingle());
            }
        }
    }"
    x-init="init()"
    x-on:click.outside="close()"
    class="w-full space-y-2"
>
    @if($label)
        <div class="space-y-1">
            <label for="{{ $selectorId }}" class="inline-flex items-center gap-1 text-sm font-medium text-foreground">
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
        <div
            id="{{ $selectorId }}"
            role="button"
            tabindex="{{ ($disabled || $readonly) ? '-1' : '0' }}"
            @click="toggle()"
            @keydown.enter.prevent="toggle()"
            @keydown.space.prevent="toggle()"
            @keydown.arrow-down.prevent="open ? highlightNext() : toggle()"
            @keydown.arrow-up.prevent="highlightPrev()"
            @keydown.escape.prevent.stop="close()"
            class="{{ $triggerClasses }}"
        >
            @isset($leading)
                <div class="absolute left-3 top-1/2 z-10 -translate-y-1/2 text-muted-foreground">
                    {{ $leading }}
                </div>
            @endisset

            <div class="min-w-0 flex-1 {{ isset($leading) ? 'pl-7' : '' }}">
                <template x-if="multiple && selectedOptions.length > 0">
                    <div class="flex flex-wrap gap-1.5">
                        <template x-for="option in selectedOptions" :key="option.value">
                            <span class="inline-flex max-w-full items-center gap-1 bg-muted text-foreground {{ $pillClasses }}">
                                <span class="truncate" x-text="option.label"></span>

                                <button
                                    type="button"
                                    class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-foreground/70 transition hover:bg-background/80 hover:text-foreground"
                                    @click.stop="remove(option.value)"
                                >
                                    <x-lucide-x class="h-3 w-3" />
                                </button>
                            </span>
                        </template>
                    </div>
                </template>

                <template x-if="(!multiple && selectedLabel) || (multiple && selectedOptions.length === 0)">
                    <div class="truncate text-left">
                        <span
                            x-show="!multiple && selectedLabel"
                            x-text="selectedLabel"
                            class="text-foreground"
                        ></span>

                        <span
                            x-show="multiple && selectedOptions.length === 0"
                            class="{{ $placeholderTextClass }}"
                            x-text="placeholder"
                        ></span>
                    </div>
                </template>

                <template x-if="!multiple && !selectedLabel">
                    <span class="block truncate text-left {{ $placeholderTextClass }}" x-text="placeholder"></span>
                </template>
            </div>

            <div class="ml-3 flex shrink-0 items-center gap-2">
                @isset($trailing)
                    <span class="shrink-0 {{ $iconTextClass }}">
                        {{ $trailing }}
                    </span>
                @endisset

                @if($loading)
                    <x-lucide-loader-2 class="{{ $iconSizeClasses }} shrink-0 animate-spin text-muted-foreground" />
                @elseif($clearable)
                    <button
                        type="button"
                        x-show="hasValue"
                        x-cloak
                        @click.stop="clear()"
                        class="inline-flex shrink-0 items-center justify-center text-muted-foreground transition hover:text-foreground"
                    >
                        <x-lucide-x class="{{ $iconSizeClasses }}" />
                    </button>
                @endif

                <x-lucide-chevron-down
                    class="{{ $iconSizeClasses }} shrink-0 {{ $iconTextClass }} transition-transform duration-200"
                    ::class="open ? 'rotate-180' : ''"
                />
            </div>
        </div>

        @if($name)
            <template x-if="!multiple">
                <input
                    x-ref="hiddenInput"
                    type="hidden"
                    name="{{ $name }}"
                    value="{{ is_array($initialValue) ? '' : $initialValue }}"
                    {{ $singleInputAttributes }}
                >
            </template>

            <template x-if="multiple">
                <select
                    x-ref="multipleSelect"
                    multiple
                    class="hidden"
                    name="{{ $name }}[]"
                    {{ $multipleSelectAttributes }}
                >
                    @foreach ($normalizedOptions as $option)
                        <option
                            value="{{ $option['value'] }}"
                            @selected(in_array(
                                $option['value'],
                                is_array($initialValue) ? $initialValue : (array) $initialValue,
                                true
                            ))
                        >
                            {{ $option['label'] }}
                        </option>
                    @endforeach
                </select>
            </template>
        @endif

        <div
            x-show="open"
            x-cloak
            x-transition.origin.top.left
            class="{{ $panelClasses }}"
        >
            @if(! $multiple)
                <button
                    type="button"
                    @click="resetSelection()"
                    class="flex w-full items-center justify-between text-left transition bg-background"
                    :class="[
                        '{{ $optionClasses }}',
                        !hasValue ? 'bg-muted font-medium text-foreground' : 'text-muted-foreground hover:bg-muted/70'
                    ]"
                >
                    <span class="truncate">{{ $placeholder }}</span>

                    <span x-show="!hasValue" class="ml-3 shrink-0 text-foreground">
                        <x-lucide-check class="{{ $iconSizeClasses }}" />
                    </span>
                </button>
            @endif

            @if($searchable)
                <div class="border-b border-border bg-background">
                    <div class="relative bg-background">
                        <input
                            x-ref="searchInput"
                            type="text"
                            x-model="search"
                            :placeholder="searchPlaceholder"
                            class="w-full border-0 bg-background pr-10 text-foreground outline-none ring-0 placeholder:text-muted-foreground {{ $searchClasses }}"
                        />

                        <span class="pointer-events-none absolute inset-y-0 right-3 inline-flex items-center text-muted-foreground">
                            <x-lucide-search class="{{ $iconSizeClasses }}" />
                        </span>
                    </div>
                </div>
            @endif

            <div class="max-h-72 overflow-y-auto bg-background {{ $panelPaddingClasses }}">
                <template x-if="filteredOptions.length === 0">
                    <div class="bg-background px-3 py-6 text-center text-sm text-muted-foreground" x-text="emptyText"></div>
                </template>

                <template x-for="(option, index) in filteredOptions" :key="option.value">
                    <button
                        type="button"
                        @mouseenter="highlightedIndex = index"
                        @click="select(option)"
                        :disabled="option.disabled"
                        class="flex w-full items-start justify-between text-left transition bg-background"
                        :class="[
                            '{{ $optionClasses }}',
                            option.disabled ? 'cursor-not-allowed opacity-50' : 'hover:bg-muted/70',
                            highlightedIndex === index ? 'bg-muted/70' : 'bg-background',
                            isSelected(option) ? 'bg-muted font-medium text-foreground' : 'text-foreground'
                        ]"
                    >
                        <span class="min-w-0">
                            <span class="block truncate" x-text="option.label"></span>
                            <template x-if="option.description">
                                <span class="mt-0.5 block text-xs text-muted-foreground" x-text="option.description"></span>
                            </template>
                        </span>

                        <span x-show="isSelected(option)" class="ml-3 shrink-0 text-foreground">
                            <x-lucide-check class="{{ $iconSizeClasses }}" />
                        </span>
                    </button>
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
