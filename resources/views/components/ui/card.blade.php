@props([
    'variant' => 'default', // default | outline | ghost | filled
    'size' => 'md', // sm | md | lg
    'shadow' => 'sm', // none | sm | md | lg | xl

    'padding' => true,
    'compact' => false,

    'hoverable' => false,
    'clickable' => false,
    'disabled' => false,
    'loading' => false,

    'accent' => null, // primary | success | danger | warning | info

    'title' => null,
    'description' => null,
    'footer' => null,

    'headerBordered' => false,
    'footerBordered' => false,

    'collapsible' => false,
    'expanded' => true,
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'rounded-xl text-sm',
        'lg' => 'rounded-3xl text-base',
        default => 'rounded-2xl text-sm',
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
        'outline' => 'border border-border bg-transparent text-card-foreground',
        'ghost' => 'border border-transparent bg-transparent text-card-foreground shadow-none',
        'filled' => 'border border-transparent bg-muted/50 text-card-foreground',
        default => 'border border-border bg-card text-card-foreground',
    };

    $paddingClasses = $padding
        ? match (true) {
            $compact => 'p-3',
            $size === 'sm' => 'p-4',
            $size === 'lg' => 'p-8',
            default => 'p-6',
        }
        : 'p-0';

    $accentClasses = match ($accent) {
        'primary' => 'border-l-4 border-l-primary',
        'success' => 'border-l-4 border-l-emerald-500',
        'danger' => 'border-l-4 border-l-red-500',
        'warning' => 'border-l-4 border-l-amber-500',
        'info' => 'border-l-4 border-l-sky-500',
        default => '',
    };

    $interactiveClasses = implode(' ', array_filter([
        'relative w-full overflow-hidden transition-all duration-200',
        !$disabled && $hoverable ? 'hover:border-foreground/20 hover:shadow-md' : '',
        !$disabled && $clickable && !$collapsible ? 'cursor-pointer active:scale-[0.99]' : '',
        $disabled ? 'pointer-events-none select-none opacity-60' : '',
    ]));

    $classes = implode(' ', array_filter([
        $interactiveClasses,
        $sizeClasses,
        $shadowClasses,
        $variantClasses,
        $paddingClasses,
        $accentClasses,
    ]));

    $hasHeaderSlot = isset($header);
    $hasHeaderActions = isset($actions);
    $hasFooterSlot = isset($footerSlot);
    $hasHeader = $hasHeaderSlot || filled($title) || filled($description) || $hasHeaderActions || $collapsible;
    $hasFooter = $hasFooterSlot || filled($footer);

    $headerSpacing = $compact ? 'mb-3' : 'mb-5';
    $footerSpacing = $compact ? 'mt-3' : 'mt-5';

    $titleClasses = match ($size) {
        'sm' => 'text-base font-semibold leading-none tracking-tight text-card-foreground',
        'lg' => 'text-2xl font-semibold leading-none tracking-tight text-card-foreground',
        default => 'text-lg font-semibold leading-none tracking-tight text-card-foreground',
    };

    $descriptionClasses = 'text-sm text-muted-foreground';

    $headerClasses = implode(' ', array_filter([
        'flex items-start justify-between gap-4',
        $collapsible ? '' : $headerSpacing,
        $headerBordered ? 'border-b border-border pb-4' : '',
    ]));

    $footerClasses = implode(' ', array_filter([
        'flex items-center gap-2',
        $footerSpacing,
        $footerBordered ? 'border-t border-border pt-4' : '',
    ]));

    $toggleButtonClasses = implode(' ', array_filter([
        'inline-flex items-center justify-center rounded-lg border border-border bg-background text-muted-foreground transition-colors duration-200',
        'hover:bg-accent hover:text-accent-foreground',
        'focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2',
        $size === 'sm' ? 'h-8 w-8' : ($size === 'lg' ? 'h-10 w-10' : 'h-9 w-9'),
    ]));
@endphp

<div
    {{ $attributes->merge(['class' => $classes]) }}
    x-data="{ open: {{ $expanded ? 'true' : 'false' }} }"
>
    @if($loading)
        <div class="absolute inset-0 z-20 flex items-center justify-center bg-background/70 backdrop-blur-[1px]">
            <div class="inline-flex items-center gap-2 rounded-full border border-border bg-background px-3 py-2 text-sm text-muted-foreground shadow-sm">
                <svg class="h-4 w-4 animate-spin text-foreground" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                <span>Loading...</span>
            </div>
        </div>
    @endif

    @if($hasHeader)
            <div
                class="{{ $headerClasses }}"
                :class="{
                    '{{ $headerSpacing }}': open || !{{ $collapsible ? 'true' : 'false' }}
                }"
            >
            <div class="min-w-0 flex-1">
                @if($hasHeaderSlot)
                    {{ $header }}
                @else
                    @if($title)
                        <div class="{{ $titleClasses }}">
                            {{ $title }}
                        </div>
                    @endif

                    @if($description)
                        <p class="{{ $descriptionClasses }} {{ $title ? 'mt-1.5' : '' }}">
                            {{ $description }}
                        </p>
                    @endif
                @endif
            </div>

            <div class="shrink-0 flex items-start gap-2">
                @if($hasHeaderActions)
                    <div>
                        {{ $actions }}
                    </div>
                @endif

                @if($collapsible)
                    <button
                        type="button"
                        class="{{ $toggleButtonClasses }}"
                        @click="open = !open"
                        :aria-expanded="open.toString()"
                        aria-label="Toggle card content"
                    >
                        <svg
                            class="h-4 w-4 transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    @endif

    <div
        x-show="{{ $collapsible ? 'open' : 'true' }}"
        x-collapse
        class="text-card-foreground"
    >
        {{ $slot }}

        @if($hasFooter)
            <div class="{{ $footerClasses }}">
                @if($hasFooterSlot)
                    {{ $footerSlot }}
                @else
                    {{ $footer }}
                @endif
            </div>
        @endif
    </div>
</div>
