@props([
    'variant' => 'info', // info | success | warning | danger
    'title' => null,
    'description' => null,
    'icon' => true,
    'dismissible' => true,
    'duration' => 4000,
])

@php
    $base = 'pointer-events-auto relative w-full overflow-hidden rounded-2xl border bg-background/95 text-foreground shadow-lg backdrop-blur-sm transition-all';
    $variants = [
        'info' => [
            'wrapper' => 'border-sky-200 dark:border-sky-900/60',
            'accent' => 'bg-sky-500',
            'icon' => 'text-sky-600 dark:text-sky-400',
        ],
        'success' => [
            'wrapper' => 'border-emerald-200 dark:border-emerald-900/60',
            'accent' => 'bg-emerald-500',
            'icon' => 'text-emerald-600 dark:text-emerald-400',
        ],
        'warning' => [
            'wrapper' => 'border-amber-200 dark:border-amber-900/60',
            'accent' => 'bg-amber-500',
            'icon' => 'text-amber-600 dark:text-amber-400',
        ],
        'danger' => [
            'wrapper' => 'border-rose-200 dark:border-rose-900/60',
            'accent' => 'bg-rose-500',
            'icon' => 'text-rose-600 dark:text-rose-400',
        ],
    ];

    $current = $variants[$variant] ?? $variants['info'];

    $iconMap = [
        'info' => 'info',
        'success' => 'circle-check-big',
        'warning' => 'triangle-alert',
        'danger' => 'circle-alert',
    ];

    $resolvedIcon = $iconMap[$variant] ?? 'info';
@endphp

<div
    {{ $attributes->merge(['class' => "{$base} {$current['wrapper']}"]) }}
    x-data="{ show: false, timeout: null, leaving: false }"
    x-init="
        $nextTick(() => {
            show = true;
        });

        if ({{ (int) $duration }} > 0) {
            timeout = setTimeout(() => {
                leaving = true;
                show = false;

                setTimeout(() => {
                    $el.remove();
                }, 300);
            }, {{ (int) $duration }});
        }
    "
    x-show="show"
    x-transition:enter="transform transition-all duration-300 ease-[cubic-bezier(0.22,1,0.36,1)]"
    x-transition:enter-start="opacity-0 translate-y-3 scale-[0.96] sm:translate-y-0 sm:translate-x-4"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100 sm:translate-x-0"
    x-transition:leave="transform transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)]"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100 sm:translate-x-0"
    x-transition:leave-end="opacity-0 translate-y-2 scale-[0.98] sm:translate-y-0 sm:translate-x-3"
    role="status"
>
    <div class="absolute inset-x-0 top-0 h-1 {{ $current['accent'] }}"></div>

    <div class="flex items-start gap-3 p-4">
        @if($icon)
            <div class="mt-0.5 shrink-0">
                @switch($resolvedIcon)
                    @case('circle-check-big')
                        <x-lucide-circle-check-big class="h-5 w-5 {{ $current['icon'] }}" />
                        @break

                    @case('triangle-alert')
                        <x-lucide-triangle-alert class="h-5 w-5 {{ $current['icon'] }}" />
                        @break

                    @case('circle-alert')
                        <x-lucide-circle-alert class="h-5 w-5 {{ $current['icon'] }}" />
                        @break

                    @default
                        <x-lucide-info class="h-5 w-5 {{ $current['icon'] }}" />
                @endswitch
            </div>
        @endif

        <div class="min-w-0 flex-1">
            @if($title)
                <div class="text-sm font-semibold leading-5">
                    {{ $title }}
                </div>
            @endif

            @if($description || trim($slot))
                <div class="mt-1 text-sm leading-5 text-muted-foreground">
                    {{ $description ?? $slot }}
                </div>
            @endif
        </div>

        @if($dismissible)
            <button
                type="button"
                @click="
                    if (timeout) clearTimeout(timeout);
                    leaving = true;
                    show = false;

                    setTimeout(() => {
                        $el.remove();
                    }, 300);
                "
                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-muted-foreground transition hover:bg-black/5 hover:text-foreground dark:hover:bg-white/10"
                aria-label="Dismiss notification"
            >
                <x-lucide-x class="h-4 w-4" />
            </button>
        @endif
    </div>
</div>
