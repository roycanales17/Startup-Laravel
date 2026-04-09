@props([
    'variant' => 'primary',
    'size' => 'md',
    'radius' => 'lg',
    'type' => 'button',
    'label' => null,
    'slim' => false,
    'fullWidth' => false,
    'loadingText' => 'Loading...',
    'loadingPosition' => 'left',
    'iconPosition' => 'left',
    'iconOnly' => false,
    'tooltip' => null,
    'error' => null,
    'description' => null,
    'wireTarget' => null,
    'badge' => null,
    'badgeVariant' => 'default',
    'center' => false,
])

@php
    $base = 'cursor-pointer relative inline-flex items-center justify-center select-none font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';

    $badgeVariants = [
        'default' => 'bg-slate-500/15 text-slate-300 border-slate-400/20',
        'amber' => 'bg-amber-500/15 text-amber-300 border-amber-400/20',
        'rose' => 'bg-rose-500/15 text-rose-300 border-rose-400/20',
        'success' => 'bg-emerald-500/15 text-emerald-300 border-emerald-400/20',
    ];

    $variants = [
        'primary' => 'bg-primary text-primary-foreground hover:opacity-90',
        'secondary' => 'bg-secondary text-secondary-foreground hover:opacity-90',
        'outline' => 'border border-border bg-transparent text-foreground hover:bg-muted',
        'ghost' => 'bg-transparent text-foreground hover:bg-muted',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
        'success' => 'bg-emerald-600 text-white hover:bg-emerald-700',
        'soft' => 'bg-muted text-foreground hover:opacity-90',
    ];

    $sizes = [
        'xs' => $iconOnly ? 'h-7 w-7 text-xs' : 'h-7 px-2.5 text-xs',
        'sm' => $iconOnly ? 'h-9 w-9 text-sm' : 'h-9 px-3 text-sm',
        'md' => $iconOnly ? 'h-10 w-10 text-sm' : 'h-10 px-4 text-sm',
        'lg' => $iconOnly ? 'h-11 w-11 text-base' : 'h-11 px-5 text-base',
        'xl' => $iconOnly ? 'h-12 w-12 text-base' : 'h-12 px-6 text-base',
    ];

    $radii = [
        'sm' => 'rounded-md',
        'md' => 'rounded-lg',
        'lg' => 'rounded-xl',
        'full' => 'rounded-full',
    ];

    $leftIcon = $leftIcon ?? null;
    $rightIcon = $rightIcon ?? null;

    $classes = implode(' ', array_filter([
        $base,
        $variants[$variant] ?? $variants['primary'],
        $sizes[$size] ?? $sizes['md'],
        $radii[$radius] ?? $radii['lg'],
        $fullWidth ? 'w-full' : null,
        $error ? 'ring-2 ring-red-500 border-red-500 focus:ring-red-500' : null,
    ]));

    $wireTargetAttr = filled($wireTarget) ? $wireTarget : $attributes->get('wire:target');
@endphp

<div class="{{ $fullWidth ? 'w-full' : '' }}">
    <button
        type="{{ $type }}"
        {{ $attributes->except(['wireTarget'])->class([$classes]) }}
        @if($tooltip) title="{{ $tooltip }}" @endif
        @if($wireTargetAttr)
            wire:loading.attr="disabled"
        wire:target="{{ $wireTargetAttr }}"
        wire:loading.class="cursor-wait opacity-90"
        @else
            wire:loading.attr="disabled"
        wire:loading.class="cursor-wait opacity-90"
        @endif
    >
        <span @class([
            'inline-flex items-center justify-center' => $iconOnly,

            // normal behavior
            'flex w-full items-center gap-2 justify-start' => !$iconOnly && !$center,

            // centered behavior
            'flex w-full items-center gap-2 justify-center' => !$iconOnly && $center,
        ])>
            @if($loadingPosition === 'left')
                <span
                    wire:loading.inline-flex
                    @if($wireTargetAttr) wire:target="{{ $wireTargetAttr }}" @endif
                    class="hidden items-center justify-center shrink-0"
                >
                    <x-lucide-loader-2 class="h-4 w-4 animate-spin" />
                </span>
            @endif

            @if(!$iconOnly && isset($leftIcon) && $iconPosition === 'left')
                <span
                    wire:loading.remove
                    @if($wireTargetAttr) wire:target="{{ $wireTargetAttr }}" @endif
                    class="inline-flex items-center shrink-0"
                >
                    {{ $leftIcon }}
                </span>
            @endif

            @if($iconOnly)
                <span
                    wire:loading.remove
                    @if($wireTargetAttr) wire:target="{{ $wireTargetAttr }}" @endif
                    class="inline-flex items-center justify-center shrink-0"
                >
                    {{ $leftIcon ?? $rightIcon }}
                </span>
            @else
                <span
                    wire:loading.remove
                    @if($wireTargetAttr) wire:target="{{ $wireTargetAttr }}" @endif
                    class="{{ $center ? 'inline-flex items-center' : 'inline-flex min-w-0 flex-1 items-center' }}"
                >
                    {{ $label ?? $slot }}
                </span>

                <span
                    wire:loading.inline-flex
                    @if($wireTargetAttr) wire:target="{{ $wireTargetAttr }}" @endif
                    class="{{ $center
                        ? 'hidden inline-flex items-center justify-center gap-2'
                        : 'hidden min-w-0 flex-1 items-center' }}"
                >
                    {{ $loadingText }}
                </span>

                @if(filled($badge))
                    <span
                        wire:loading.remove
                        @if($wireTargetAttr) wire:target="{{ $wireTargetAttr }}" @endif
                        class="ml-auto inline-flex shrink-0 items-center rounded-full border px-2 py-0.5 text-[11px] font-medium {{ $badgeVariants[$badgeVariant] ?? $badgeVariants['default'] }}"
                    >
                        {{ $badge }}
                    </span>
                @endif
            @endif

            @if(!$iconOnly && isset($rightIcon) && $iconPosition === 'right')
                <span
                    wire:loading.remove
                    @if($wireTargetAttr) wire:target="{{ $wireTargetAttr }}" @endif
                    class="inline-flex items-center shrink-0"
                >
                    {{ $rightIcon }}
                </span>
            @endif

            @if($loadingPosition === 'right')
                <span
                    wire:loading.inline-flex
                    @if($wireTargetAttr) wire:target="{{ $wireTargetAttr }}" @endif
                    class="{{ $center
                        ? 'hidden inline-flex items-center justify-center gap-2 shrink-0'
                        : 'hidden items-center justify-center shrink-0' }}"
                >
                    <x-lucide-loader-2 class="h-4 w-4 animate-spin" />
                </span>
            @endif
        </span>
    </button>

    @if($description && !$error)
        <p class="mt-1 text-xs text-muted-foreground">{{ $description }}</p>
    @endif

    @if($error)
        <p class="mt-1 text-xs text-red-600">{{ $error }}</p>
    @endif
</div>
