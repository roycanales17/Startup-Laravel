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

    'prefix' => null,
    'suffix' => null,

    'loading' => false,
    'clearable' => false,

    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'description' => null,

    'rows' => 4,
    'autosize' => false,
    'resize' => 'vertical', // none, vertical, horizontal, both
    'placeholder' => null,
])

@php
    $textareaId = $id ?? $name ?? 'textarea_' . uniqid();

    $slotValue = $slot->isEmpty() ? '' : trim((string) $slot);
    $resolvedValue = old($name, $slotValue);

    if (is_array($resolvedValue)) {
        $resolvedValue = implode("\n", array_map(fn ($i) => is_scalar($i) ? $i : json_encode($i), $resolvedValue));
    }

    $resolvedValue = (string) ($resolvedValue ?? '');

    $hasError = filled($error);
    $hasSuccess = filled($success) && ! $hasError;

    $sizeMap = [
        'xs' => [
            'wrapper' => 'rounded-lg',
            'textarea' => 'min-h-[70px] text-xs leading-5 px-2.5 py-2',
            'label' => 'text-xs',
            'description' => 'text-[11px]',
            'message' => 'text-[11px]',
            'affixTop' => 'top-2',
            'icon' => 'h-3.5 w-3.5',
            'prefixText' => 'text-xs',
        ],
        'sm' => [
            'wrapper' => 'rounded-lg',
            'textarea' => 'min-h-[84px] text-sm leading-5 px-3 py-2.5',
            'label' => 'text-sm',
            'description' => 'text-xs',
            'message' => 'text-xs',
            'affixTop' => 'top-2.5',
            'icon' => 'h-4 w-4',
            'prefixText' => 'text-sm',
        ],
        'md' => [
            'wrapper' => 'rounded-xl',
            'textarea' => 'min-h-[100px] text-sm leading-6 px-3.5 py-3',
            'label' => 'text-sm',
            'description' => 'text-xs',
            'message' => 'text-xs',
            'affixTop' => 'top-3.5',
            'icon' => 'h-4 w-4',
            'prefixText' => 'text-sm',
        ],
        'lg' => [
            'wrapper' => 'rounded-xl',
            'textarea' => 'min-h-[116px] text-base leading-6 px-4 py-3.5',
            'label' => 'text-base',
            'description' => 'text-sm',
            'message' => 'text-sm',
            'affixTop' => 'top-3.5',
            'icon' => 'h-5 w-5',
            'prefixText' => 'text-sm',
        ],
        'xl' => [
            'wrapper' => 'rounded-2xl',
            'textarea' => 'min-h-[132px] text-base leading-7 px-4.5 py-4',
            'label' => 'text-base',
            'description' => 'text-sm',
            'message' => 'text-sm',
            'affixTop' => 'top-4',
            'icon' => 'h-5 w-5',
            'prefixText' => 'text-base',
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

    $resizeClass = match ($resize) {
        'none' => 'resize-none',
        'horizontal' => 'resize-x',
        'both' => 'resize',
        default => 'resize-y',
    };

    $stateClasses = $hasError
    ? 'border-red-500/70 focus-within:border-red-500 focus-within:ring-red-500/20'
    : ($hasSuccess
        ? 'border-emerald-500/70 focus-within:border-emerald-500 focus-within:ring-emerald-500/20'
        : 'focus-within:border-primary focus-within:ring-primary/20');

    $disabledWrapperClasses = $disabled ? 'opacity-60 cursor-not-allowed' : '';
    $readonlyWrapperClasses = $readonly ? 'bg-muted/30' : '';

    $wrapperClasses = implode(' ', array_filter([
        'relative w-full border transition-all duration-200',
        'hover:border-foreground/20',
        'focus-within:ring-4 focus-within:shadow-md',
        $sizeMap[$size]['wrapper'] ?? $sizeMap['md']['wrapper'],
        $variantMap[$variant] ?? $variantMap['default'],
        $shadowMap[$shadow] ?? '',
        $stateClasses,
        $disabledWrapperClasses,
        $readonlyWrapperClasses,
    ]));

    $textareaClasses = implode(' ', array_filter([
        'block w-full bg-transparent text-foreground outline-none placeholder:text-muted-foreground',
        $sizeMap[$size]['textarea'] ?? $sizeMap['md']['textarea'],
        $resizeClass,
        'border-0 focus:ring-0 focus:outline-none',
        'disabled:cursor-not-allowed disabled:opacity-100',
        $readonly ? 'cursor-default' : '',
    ]));

    $affixTop = $sizeMap[$size]['affixTop'] ?? $sizeMap['md']['affixTop'];

    $messageClass = $hasError
        ? 'text-red-500'
        : ($hasSuccess ? 'text-emerald-600 dark:text-emerald-400' : 'text-muted-foreground');
@endphp

<div
    x-data="{
        value: @js($resolvedValue),
        autosize: {{ $autosize ? 'true' : 'false' }},
        disabled: {{ $disabled ? 'true' : 'false' }},
        readonly: {{ $readonly ? 'true' : 'false' }},

        prefixWidth: 0,
        suffixWidth: 0,

        get textareaStyle() {
            const left = this.prefixWidth ? this.prefixWidth + 17 : null;
            const right = this.suffixWidth ? this.suffixWidth + 17 : null;

            return [
                left ? `padding-left: ${left}px` : '',
                right ? `padding-right: ${right}px` : ''
            ].join(' ');
        },

        measure() {
            this.$nextTick(() => {
                this.prefixWidth = this.$refs.prefix ? this.$refs.prefix.offsetWidth : 0;
                this.suffixWidth = this.$refs.suffix ? this.$refs.suffix.offsetWidth : 0;
            });
        },

        resizeTextarea() {
            if (!this.$refs.textarea || !this.autosize) return;

            this.$refs.textarea.style.height = 'auto';
            this.$refs.textarea.style.height = this.$refs.textarea.scrollHeight + 'px';
        },

        clearInput() {
            if (this.disabled || this.readonly) return;

            this.value = '';

            this.$nextTick(() => {
                this.resizeTextarea();
                this.$refs.textarea?.focus();
            });
        },

        init() {
            this.measure();

            if (this.autosize) {
                this.$nextTick(() => this.resizeTextarea());
                this.$watch('value', () => this.resizeTextarea());
            }

            window.addEventListener('resize', () => this.measure());
        }
    }"
    class="w-full space-y-2"
>
    @if($label)
        <div class="space-y-1">
            <label for="{{ $textareaId }}" class="font-medium text-foreground {{ $sizeMap[$size]['label'] ?? $sizeMap['md']['label'] }}">
                {{ $label }}
                @if($required)
                    <span class="text-destructive">*</span>
                @endif
            </label>

            @if($description)
                <p class="text-muted-foreground {{ $sizeMap[$size]['description'] ?? $sizeMap['md']['description'] }}">
                    {{ $description }}
                </p>
            @endif
        </div>
    @endif

    <div class="{{ $wrapperClasses }}">
        @if($loading)
            <div
                x-ref="prefix"
                class="absolute left-3 {{ $affixTop }} flex items-center text-muted-foreground"
            >
                <x-lucide-loader-2 class="{{ $sizeMap[$size]['icon'] ?? $sizeMap['md']['icon'] }} animate-spin" />
            </div>
        @elseif($prefix)
            <div
                x-ref="prefix"
                class="absolute left-3 {{ $affixTop }} flex items-center whitespace-nowrap text-muted-foreground {{ $sizeMap[$size]['prefixText'] ?? $sizeMap['md']['prefixText'] }}"
            >
                {{ $prefix }}
            </div>
        @elseif(isset($leading))
            <div
                x-ref="prefix"
                class="absolute left-3 {{ $affixTop }} flex items-center text-muted-foreground"
            >
                {{ $leading }}
            </div>
        @endif

        <textarea
            x-ref="textarea"
            x-model="value"
            :style="textareaStyle"
            id="{{ $textareaId }}"
            name="{{ $name }}"
            rows="{{ $rows }}"
            @input="if (autosize) resizeTextarea()"
            placeholder="{{ $placeholder ?? $attributes->get('placeholder') }}"
            @disabled($disabled)
            @readonly($readonly)
            {{ $attributes->except(['class', 'placeholder'])->merge(['class' => $textareaClasses]) }}
        >{{ $resolvedValue }}</textarea>

        @if($suffix)
            <div
                x-ref="suffix"
                class="absolute right-3 {{ $affixTop }} flex items-center whitespace-nowrap text-muted-foreground {{ $sizeMap[$size]['prefixText'] ?? $sizeMap['md']['prefixText'] }}"
            >
                {{ $suffix }}
            </div>
        @elseif($clearable)
            <button
                x-ref="suffix"
                type="button"
                x-show="value.length"
                x-cloak
                @click="clearInput()"
                class="absolute right-3 {{ $affixTop }} flex items-center text-muted-foreground transition hover:text-foreground disabled:pointer-events-none"
                :disabled="disabled || readonly"
            >
                <x-lucide-x class="{{ $sizeMap[$size]['icon'] ?? $sizeMap['md']['icon'] }}" />
            </button>
        @elseif(isset($trailing))
            <div
                x-ref="suffix"
                class="absolute right-3 {{ $affixTop }} flex items-center text-muted-foreground"
            >
                {{ $trailing }}
            </div>
        @endif
    </div>

    @if($error || $success || $hint)
        <p class="{{ $sizeMap[$size]['message'] ?? $sizeMap['md']['message'] }} {{ $messageClass }}">
            {{ $error ?? $success ?? $hint }}
        </p>
    @endif
</div>
