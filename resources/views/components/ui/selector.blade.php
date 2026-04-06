@props([
    'label' => null,
    'name' => null,
    'id' => null,

    'variant' => 'default', // default, filled, ghost
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

    'value' => null,
    'options' => [],
])

@php
    $selectorId = $id ?: ($name ? str_replace(['[', ']'], ['_', ''], $name) : 'selector_' . uniqid());

    $normalizedOptions = collect($options)->map(function ($option) {
        if (is_array($option)) {
            return [
                'label' => $option['label'] ?? $option['value'] ?? '',
                'value' => $option['value'] ?? $option['label'] ?? '',
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

    $hasMessage = filled($error) || filled($success) || filled($hint);

    $sizeMap = [
        'xs' => [
            'trigger' => 'min-h-8 px-2.5 py-1.5 text-xs rounded-lg gap-2',
            'icon' => 'h-3.5 w-3.5',
            'pill' => 'h-5 px-1.5 text-[10px] rounded-md',
            'search' => 'px-2.5 py-2 text-xs',
            'option' => 'px-2.5 py-2 text-xs rounded-md',
            'panel' => 'p-2',
        ],
        'sm' => [
            'trigger' => 'min-h-9 px-3 py-2 text-sm rounded-lg gap-2',
            'icon' => 'h-4 w-4',
            'pill' => 'h-6 px-2 text-[11px] rounded-md',
            'search' => 'px-3 py-2 text-sm',
            'option' => 'px-3 py-2 text-sm rounded-md',
            'panel' => 'p-2',
        ],
        'md' => [
            'trigger' => 'min-h-10 px-3.5 py-2.5 text-sm rounded-xl gap-2.5',
            'icon' => 'h-4 w-4',
            'pill' => 'h-6 px-2 text-xs rounded-md',
            'search' => 'px-3.5 py-2.5 text-sm',
            'option' => 'px-3.5 py-2.5 text-sm rounded-lg',
            'panel' => 'p-2',
        ],
        'lg' => [
            'trigger' => 'min-h-11 px-4 py-3 text-base rounded-xl gap-2.5',
            'icon' => 'h-5 w-5',
            'pill' => 'h-7 px-2.5 text-xs rounded-md',
            'search' => 'px-4 py-3 text-base',
            'option' => 'px-4 py-3 text-base rounded-lg',
            'panel' => 'p-2.5',
        ],
        'xl' => [
            'trigger' => 'min-h-12 px-4.5 py-3.5 text-base rounded-2xl gap-3',
            'icon' => 'h-5 w-5',
            'pill' => 'h-8 px-3 text-sm rounded-lg',
            'search' => 'px-4.5 py-3 text-base',
            'option' => 'px-4.5 py-3 text-base rounded-xl',
            'panel' => 'p-3',
        ],
    ];

    $variantMap = [
        'default' => 'bg-background border-border',
        'filled' => 'bg-muted/60 border-transparent focus-within:bg-background',
        'ghost' => 'bg-transparent border-transparent shadow-none',
    ];

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
        'relative flex w-full items-center border transition-all duration-200',
        'text-left',
        'overflow-hidden',
        'hover:border-foreground/20',
        'focus-within:ring-4 focus-within:shadow-md',
        $sizeMap[$size]['trigger'] ?? $sizeMap['md']['trigger'],
        $variantMap[$variant] ?? $variantMap['default'],
        $shadowMap[$shadow] ?? '',
        $stateClasses,
        $disabledClasses,
        $readonlyClasses,
    ]));

    $panelClasses = implode(' ', array_filter([
        'absolute z-50 mt-2 w-full overflow-hidden rounded-xl border border-border bg-background text-foreground shadow-xl',
        'isolate',
        $shadowMap[$shadow] ?? '',
    ]));

    $message = $error ?: ($success ?: $hint);
    $messageClass = filled($error)
        ? 'text-sm text-red-500'
        : (filled($success) ? 'text-sm text-emerald-500' : 'text-xs text-muted-foreground');

    $initialValue = $multiple
        ? (is_array($value) ? array_values($value) : (filled($value) ? [(string) $value] : []))
        : (filled($value) ? (string) $value : '');
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

        get normalizedSelected() {
            return this.multiple
                ? (Array.isArray(this.selected) ? this.selected : [])
                : (this.selected ?? '');
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
                return this.options.filter(option => this.normalizedSelected.includes(option.value));
            }

            return this.options.filter(option => option.value === this.normalizedSelected);
        },

        get selectedLabel() {
            if (this.multiple) {
                return '';
            }

            const found = this.options.find(option => option.value === this.normalizedSelected);
            return found ? found.label : '';
        },

        get hasValue() {
            return this.multiple
                ? this.normalizedSelected.length > 0
                : !!this.normalizedSelected;
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

        select(option) {
            if (option.disabled || this.disabled || this.readonly) return;

            if (this.multiple) {
                if (this.normalizedSelected.includes(option.value)) {
                    this.selected = this.normalizedSelected.filter(value => value !== option.value);
                } else {
                    this.selected = [...this.normalizedSelected, option.value];
                }

                this.$dispatch('input', this.selected);
                this.$dispatch('change', this.selected);
                return;
            }

            this.selected = option.value;
            this.$dispatch('input', this.selected);
            this.$dispatch('change', this.selected);
            this.close();
        },

        remove(value) {
            if (!this.multiple || this.disabled || this.readonly) return;

            this.selected = this.normalizedSelected.filter(item => item !== value);
            this.$dispatch('input', this.selected);
            this.$dispatch('change', this.selected);
        },

        clear() {
            if (!this.clearable || this.disabled || this.readonly) return;

            this.selected = this.multiple ? [] : '';
            this.search = '';
            this.$dispatch('input', this.selected);
            this.$dispatch('change', this.selected);
        },

        isSelected(option) {
            return this.multiple
                ? this.normalizedSelected.includes(option.value)
                : this.normalizedSelected === option.value;
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
        }
    }"
    x-on:click.outside="close()"
    class="w-full"
>
    @if($label)
        <label for="{{ $selectorId }}" class="mb-2 block">
            <span class="text-sm font-medium text-foreground">{{ $label }}</span>

            @if($description)
                <span class="mt-1 block text-xs text-muted-foreground">
                    {{ $description }}
                </span>
            @endif
        </label>
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
                <span class="shrink-0 text-muted-foreground">
                    {{ $leading }}
                </span>
            @endisset

            <div class="min-w-0 flex-1">
                <template x-if="multiple && selectedOptions.length > 0">
                    <div class="flex flex-wrap gap-1.5">
                        <template x-for="option in selectedOptions" :key="option.value">
                            <span class="inline-flex max-w-full items-center gap-1 bg-muted text-foreground {{ $sizeMap[$size]['pill'] ?? $sizeMap['md']['pill'] }}">
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
                            class="text-muted-foreground"
                            x-text="placeholder"
                        ></span>
                    </div>
                </template>

                <template x-if="!multiple && !selectedLabel">
                    <span class="block truncate text-left text-muted-foreground" x-text="placeholder"></span>
                </template>
            </div>

            <div class="ml-3 flex shrink-0 items-center gap-2">
                @isset($trailing)
                    <span class="shrink-0 text-muted-foreground">
                        {{ $trailing }}
                    </span>
                @endisset

                @if($loading)
                        <x-lucide-loader-2 class="{{ $sizeMap[$size]['icon'] ?? $sizeMap['md']['icon'] }} shrink-0 animate-spin text-muted-foreground" />
                @elseif($clearable)
                    <button
                        type="button"
                        x-show="hasValue"
                        x-cloak
                        @click.stop="clear()"
                        class="inline-flex shrink-0 items-center justify-center text-muted-foreground transition hover:text-foreground"
                    >
                        <x-lucide-x class="{{ $sizeMap[$size]['icon'] ?? $sizeMap['md']['icon'] }}" />
                    </button>
                @endif

                <x-lucide-chevron-down
                    class="{{ $sizeMap[$size]['icon'] ?? $sizeMap['md']['icon'] }} shrink-0 text-muted-foreground transition-transform duration-200"
                    ::class="open ? 'rotate-180' : ''"
                />
            </div>
        </div>

        @if($name)
            <template x-if="!multiple">
                <input type="hidden" name="{{ $name }}" :value="selected">
            </template>

            <template x-if="multiple">
                <div>
                    <template x-for="(item, index) in normalizedSelected" :key="`${item}-${index}`">
                        <input type="hidden" name="{{ $name }}[]" :value="item">
                    </template>
                </div>
            </template>
        @endif

        <div
            x-show="open"
            x-cloak
            x-transition.origin.top.left
            class="{{ $panelClasses }}"
        >
            @if($searchable)
                <div class="border-b border-border bg-background">
                    <div class="relative bg-background">
                        <input
                            x-ref="searchInput"
                            type="text"
                            x-model="search"
                            :placeholder="searchPlaceholder"
                            class="w-full border-0 bg-background pr-10 text-foreground outline-none ring-0 placeholder:text-muted-foreground {{ $sizeMap[$size]['search'] ?? $sizeMap['md']['search'] }}"
                        />

                        <span class="pointer-events-none absolute inset-y-0 right-3 inline-flex items-center text-muted-foreground">
                            <x-lucide-search class="{{ $sizeMap[$size]['icon'] ?? $sizeMap['md']['icon'] }}" />
                        </span>
                    </div>
                </div>
            @endif

            <div class="max-h-72 overflow-y-auto bg-background {{ $sizeMap[$size]['panel'] ?? $sizeMap['md']['panel'] }}">
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
                            '{{ $sizeMap[$size]['option'] ?? $sizeMap['md']['option'] }}',
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
                            <x-lucide-check class="{{ $sizeMap[$size]['icon'] ?? $sizeMap['md']['icon'] }}" />
                        </span>
                    </button>
                </template>
            </div>
        </div>
    </div>

    @if($hasMessage)
        <p class="mt-2 {{ $messageClass }}">
            {{ $message }}
        </p>
    @endif
</div>
