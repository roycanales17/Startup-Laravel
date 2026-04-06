<x-layouts.app>
    <div class="min-h-screen flex items-center justify-center p-6">
        <x-ui.card class="max-w-xl w-full text-center">
            <h1 class="text-2xl font-bold">Starter Project Ready 🚀</h1>

            <p class="mt-3 text-muted-foreground">
                Laravel + Tailwind + Blade Components + Theme Support
            </p>

            <div class="mt-6 flex justify-center gap-3">
                <x-ui.button href="{{ route('ui.buttons') }}">
                    Open UI Preview
                </x-ui.button>

                <x-ui.button variant="outline" href="https://laravel.com">
                    Laravel Docs
                </x-ui.button>
            </div>
        </x-ui.card>
    </div>
</x-layouts.app>
