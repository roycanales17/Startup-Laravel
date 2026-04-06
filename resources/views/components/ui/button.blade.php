@props([
    'variant' => 'primary',
    'size' => 'md',
    'radius' => 'lg',
    'type' => 'button',
    'label' => null,
    'slim' => false,
    'fullWidth' => false,
    'loading' => false,
    'loadingText' => 'Loading...',
    'loadingPosition' => 'left',
    'iconPosition' => 'left',
    'iconOnly' => false,
    'tooltip' => null,
    'error' => null,
    'href' => null,
    'target' => null,
    'description' => null,
])

@php
    $tag = $href ? 'a' : 'button';
    $isLink = !empty($href);
    $isExternal = $isLink && $target === '_blank';

    $base = 'relative inline-flex items-center justify-center font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:opacity-50 select-none transition-all duration-200 cursor-pointer';

    $variants = [
        'primary' => 'bg-primary text-primary-foreground hover:opacity-90',
        'secondary' => 'bg-secondary text-secondary-foreground hover:opacity-90',
        'outline' => 'border border-border bg-transparent text-foreground hover:bg-muted',
        'ghost' => 'bg-transparent text-foreground hover:bg-muted',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
        'success' => 'bg-emerald-600 text-white hover:bg-emerald-700',
        'soft' => 'bg-muted text-foreground hover:opacity-90',
        'link' => 'bg-transparent text-primary underline-offset-4 hover:underline shadow-none px-0 h-auto',
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

    $slimClass = $slim && !$iconOnly && $variant !== 'link'
        ? match ($size) {
            'xs' => 'px-2',
            'sm' => 'px-2.5',
            'md' => 'px-3',
            'lg' => 'px-4',
            'xl' => 'px-5',
            default => '',
        }
        : '';

    $leftIconExists = !empty($leftIcon);
    $rightIconExists = !empty($rightIcon);

    $buttonLabel = $label ?? trim((string) $slot);

    $cursorClass = match (true) {
        $loading => 'cursor-wait',
        (!$isLink && $loading) => 'cursor-not-allowed', // fallback safety
        ($isLink && $loading) => 'cursor-wait pointer-events-none',
        (!$isLink && isset($attributes['disabled'])) => 'cursor-not-allowed',
        default => 'cursor-pointer',
    };

    $classes = trim(
        $base . ' ' .
        ($variants[$variant] ?? $variants['primary']) . ' ' .
        ($sizes[$size] ?? $sizes['md']) . ' ' .
        ($variant !== 'link' ? ($radii[$radius] ?? $radii['lg']) : '') . ' ' .
        $slimClass . ' ' .
        ($fullWidth ? 'w-full' : '') . ' ' .
        ($error ? 'ring-2 ring-red-500 border-red-500 focus:ring-red-500' : '') . ' ' .
        ($loading && $isLink ? 'pointer-events-none opacity-50' : '') . ' ' .
        $cursorClass
    );

    $spinner = '
        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    ';
@endphp

<div class="{{ $fullWidth ? 'w-full' : '' }}">
    <{{ $tag }}
        {{ $attributes->merge(['class' => $classes]) }}
        @if($isLink) href="{{ $href }}" @endif
        @if($target) target="{{ $target }}" @endif
        @if($isExternal) rel="noopener noreferrer" @endif
        @if(!$isLink) type="{{ $type }}" @endif
        @if(!$isLink && $loading) disabled @endif
        @if($isLink && $loading) onclick="return false;" @endif
        @if($tooltip) title="{{ $tooltip }}" @endif
        @if(!$isLink) aria-busy="{{ $loading ? 'true' : 'false' }}" @endif
         aria-disabled="{{ $loading ? 'true' : 'false' }}"
    >
    <span class="inline-flex items-center justify-center gap-2">
            @if($loading && $loadingPosition === 'left')
            {!! $spinner !!}
        @endif

        @if(!$loading && !$iconOnly && $leftIconExists && $iconPosition === 'left')
            <span class="inline-flex items-center">
                {{ $leftIcon }}
            </span>
        @endif

        @if($iconOnly)
            @if($leftIconExists)
                <span class="inline-flex items-center justify-center">
                    {{ $leftIcon }}
                </span>
            @elseif($rightIconExists)
                <span class="inline-flex items-center justify-center">
                    {{ $rightIcon }}
                </span>
            @endif
        @else
            <span>
                {{ $loading ? $loadingText : $buttonLabel }}
            </span>
        @endif

        @if(!$loading && !$iconOnly && $rightIconExists && $iconPosition === 'right')
            <span class="inline-flex items-center">
                {{ $rightIcon }}
            </span>
        @endif

        @if($loading && $loadingPosition === 'right')
            {!! $spinner !!}
        @endif
        </span>
</{{ $tag }}>

    {{-- Description / Hint --}}
    @if($description && !$error)
        <p class="mt-1 text-xs text-muted-foreground">
            {{ $description }}
        </p>
    @endif

    {{-- Error (takes priority) --}}
    @if($error)
        <p class="mt-1 text-xs text-red-600">
            {{ $error }}
        </p>
    @endif
</div>
