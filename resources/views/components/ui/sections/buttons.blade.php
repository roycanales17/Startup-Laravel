<x-layouts.preview>
    <section class="space-y-6">

        <div>
            <h2 class="text-xl font-semibold">Buttons</h2>
            <p class="text-sm text-muted-foreground">
                Variants, sizes, radius, loading, icons, descriptions, and states.
            </p>
        </div>

        <x-ui.card
            title="Variants"
            description="Different visual button styles for common UI actions."
            footerBordered
        >
            <div class="flex flex-wrap gap-3">
                <x-ui.button variant="primary">Primary</x-ui.button>
                <x-ui.button variant="secondary">Secondary</x-ui.button>
                <x-ui.button variant="outline">Outline</x-ui.button>
                <x-ui.button variant="ghost">Ghost</x-ui.button>
                <x-ui.button variant="danger">Danger</x-ui.button>
                <x-ui.button variant="success">Success</x-ui.button>
                <x-ui.button variant="soft">Soft</x-ui.button>
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.button variant="primary"&gt;Primary&lt;/x-ui.button&gt;
                    &lt;x-ui.button variant="secondary"&gt;Secondary&lt;/x-ui.button&gt;
                    &lt;x-ui.button variant="outline"&gt;Outline&lt;/x-ui.button&gt;
                    &lt;x-ui.button variant="ghost"&gt;Ghost&lt;/x-ui.button&gt;
                    &lt;x-ui.button variant="danger"&gt;Danger&lt;/x-ui.button&gt;
                    &lt;x-ui.button variant="success"&gt;Success&lt;/x-ui.button&gt;
                    &lt;x-ui.button variant="soft"&gt;Soft&lt;/x-ui.button&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <x-ui.card
            title="Sizes"
            description="Supports extra small to extra large button sizes."
            footerBordered
        >
            <div class="flex flex-wrap items-center gap-3">
                <x-ui.button size="xs">XS</x-ui.button>
                <x-ui.button size="sm">SM</x-ui.button>
                <x-ui.button size="md">MD</x-ui.button>
                <x-ui.button size="lg">LG</x-ui.button>
                <x-ui.button size="xl">XL</x-ui.button>
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.button size="xs"&gt;XS&lt;/x-ui.button&gt;
                    &lt;x-ui.button size="sm"&gt;SM&lt;/x-ui.button&gt;
                    &lt;x-ui.button size="md"&gt;MD&lt;/x-ui.button&gt;
                    &lt;x-ui.button size="lg"&gt;LG&lt;/x-ui.button&gt;
                    &lt;x-ui.button size="xl"&gt;XL&lt;/x-ui.button&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <x-ui.card
            title="Radius"
            description="Adjust the corner roundness for different button shapes."
            footerBordered
        >
            <div class="flex flex-wrap gap-3">
                <x-ui.button radius="sm">SM</x-ui.button>
                <x-ui.button radius="md">MD</x-ui.button>
                <x-ui.button radius="lg">LG</x-ui.button>
                <x-ui.button radius="full">FULL</x-ui.button>
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.button radius="sm"&gt;SM&lt;/x-ui.button&gt;
                    &lt;x-ui.button radius="md"&gt;MD&lt;/x-ui.button&gt;
                    &lt;x-ui.button radius="lg"&gt;LG&lt;/x-ui.button&gt;
                    &lt;x-ui.button radius="full"&gt;FULL&lt;/x-ui.button&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <x-ui.card
            title="States"
            description="Examples of slim, full width, disabled, and Livewire loading button states."
            footerBordered
        >
            <div class="flex flex-wrap gap-3">
                <x-ui.button :slim="true">Slim</x-ui.button>
                <x-ui.button fullWidth class="sm:w-auto">Full Width</x-ui.button>
                <x-ui.button disabled>Disabled</x-ui.button>
                <x-ui.button variant="secondary" disabled>Disabled Secondary</x-ui.button>
                <x-ui.button variant="outline" disabled>Disabled Outline</x-ui.button>

                <x-ui.button disabled>
                    <x-slot:leftIcon>
                        <x-lucide-lock class="h-4 w-4" />
                    </x-slot:leftIcon>
                    Locked
                </x-ui.button>
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.button :slim="true"&gt;Slim&lt;/x-ui.button&gt;
                    &lt;x-ui.button fullWidth class="sm:w-auto"&gt;Full Width&lt;/x-ui.button&gt;
                    &lt;x-ui.button disabled&gt;Disabled&lt;/x-ui.button&gt;
                    &lt;x-ui.button variant="secondary" disabled&gt;Disabled Secondary&lt;/x-ui.button&gt;
                    &lt;x-ui.button variant="outline" disabled&gt;Disabled Outline&lt;/x-ui.button&gt;

                    &lt;x-ui.button disabled&gt;
                    &lt;x-slot:leftIcon&gt;
                    &lt;x-lucide-lock class="h-4 w-4" /&gt;
                    &lt;/x-slot:leftIcon&gt;
                    Locked
                    &lt;/x-ui.button&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <x-ui.card
            title="Icons"
            description="Support for icon-only buttons and buttons with left or right icons."
            footerBordered
        >
            <div class="flex flex-wrap gap-3">
                <x-ui.button :iconOnly="true" tooltip="Search">
                    <x-slot:leftIcon>
                        <x-lucide-search class="h-4 w-4" />
                    </x-slot:leftIcon>
                </x-ui.button>

                <x-ui.button iconPosition="right">
                    Continue
                    <x-slot:rightIcon>
                        <x-lucide-arrow-right class="h-4 w-4" />
                    </x-slot:rightIcon>
                </x-ui.button>
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.button :iconOnly="true" tooltip="Search"&gt;
                    &lt;x-slot:leftIcon&gt;
                    &lt;x-lucide-search class="h-4 w-4" /&gt;
                    &lt;/x-slot:leftIcon&gt;
                    &lt;/x-ui.button&gt;

                    &lt;x-ui.button iconPosition="right"&gt;
                    Continue
                    &lt;x-slot:rightIcon&gt;
                    &lt;x-lucide-arrow-right class="h-4 w-4" /&gt;
                    &lt;/x-slot:rightIcon&gt;
                    &lt;/x-ui.button&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <x-ui.card
            title="Description"
            description="Buttons can show supporting text below the main label."
            footerBordered
        >
            <div class="flex max-w-sm flex-col gap-4">
                <x-ui.button description="This will save your changes">
                    Save Changes
                </x-ui.button>

                <x-ui.button description="Continue to the next step">
                    <x-slot:leftIcon>
                        <x-lucide-arrow-right class="h-4 w-4" />
                    </x-slot:leftIcon>
                    Continue
                </x-ui.button>

                <x-ui.button disabled description="You don’t have permission">
                    Disabled Action
                </x-ui.button>
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.button description="This will save your changes"&gt;
                    Save Changes
                    &lt;/x-ui.button&gt;

                    &lt;x-ui.button description="Continue to the next step"&gt;
                    &lt;x-slot:leftIcon&gt;
                    &lt;x-lucide-arrow-right class="h-4 w-4" /&gt;
                    &lt;/x-slot:leftIcon&gt;
                    Continue
                    &lt;/x-ui.button&gt;

                    &lt;x-ui.button disabled description="You don’t have permission"&gt;
                    Disabled Action
                    &lt;/x-ui.button&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <x-ui.card
            title="Error"
            description="Display an error message below the button when needed."
            footerBordered
        >
            <div class="max-w-sm">
                <x-ui.button error="Something went wrong">
                    Retry
                </x-ui.button>
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.button error="Something went wrong"&gt;
                    Retry
                    &lt;/x-ui.button&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

    </section>
</x-layouts.preview>
