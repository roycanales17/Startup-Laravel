@props([
    'language' => 'markup',
    'title' => null,
])

@php
    $code = trim((string) $slot);

    // Split lines
    $lines = preg_split("/\r\n|\n|\r/", $code);

    // Remove ALL leading spaces (force left)
    $code = collect($lines)
        ->map(fn ($line) => ltrim($line))
        ->implode("\n");
@endphp

<div class="space-y-2 w-full">
    @if($title)
        <div class="text-sm font-medium text-muted-foreground">
            {{ $title }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-border bg-card">
        <div class="border-b border-border px-4 py-2 text-xs font-medium uppercase tracking-wide text-muted-foreground">
            {{ $language }}
        </div>

        <pre class="language-{{ $language }}"><code class="language-{{ $language }}">{!! $code !!}</code></pre>
    </div>
</div>
