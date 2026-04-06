<x-layouts.preview>
    <section class="scroll-mt-24">
        <x-ui.card>
            <div class="mb-6">
                <h2 class="text-xl font-semibold">Buttons</h2>
                <p class="mt-1 text-sm text-muted-foreground">
                    Variants, sizes, radius, loading, icons, and states.
                </p>
            </div>

            <div class="space-y-8">

                <!-- Variants -->
                <div>
                    <h3 class="mb-3 text-sm font-semibold text-muted-foreground">Variants</h3>

                    <div class="flex flex-wrap gap-3">
                        <x-ui.button variant="primary">Primary</x-ui.button>
                        <x-ui.button variant="secondary">Secondary</x-ui.button>
                        <x-ui.button variant="outline">Outline</x-ui.button>
                        <x-ui.button variant="ghost">Ghost</x-ui.button>
                        <x-ui.button variant="danger">Danger</x-ui.button>
                        <x-ui.button variant="success">Success</x-ui.button>
                        <x-ui.button variant="soft">Soft</x-ui.button>
                        <x-ui.button variant="link">Link</x-ui.button>
                    </div>

                    <div class="mt-4">
                        <x-ui.code-preview language="markup">
                            &lt;x-ui.button variant="primary"&gt;Primary&lt;/x-ui.button&gt;
                            &lt;x-ui.button variant="secondary"&gt;Secondary&lt;/x-ui.button&gt;
                            &lt;x-ui.button variant="outline"&gt;Outline&lt;/x-ui.button&gt;
                            &lt;x-ui.button variant="ghost"&gt;Ghost&lt;/x-ui.button&gt;
                            &lt;x-ui.button variant="danger"&gt;Danger&lt;/x-ui.button&gt;
                            &lt;x-ui.button variant="success"&gt;Success&lt;/x-ui.button&gt;
                            &lt;x-ui.button variant="soft"&gt;Soft&lt;/x-ui.button&gt;
                            &lt;x-ui.button variant="link"&gt;Link&lt;/x-ui.button&gt;
                        </x-ui.code-preview>
                    </div>
                </div>

                <!-- Sizes -->
                <div>
                    <h3 class="mb-3 text-sm font-semibold text-muted-foreground">Sizes</h3>

                    <div class="flex flex-wrap items-center gap-3">
                        <x-ui.button size="xs">XS</x-ui.button>
                        <x-ui.button size="sm">SM</x-ui.button>
                        <x-ui.button size="md">MD</x-ui.button>
                        <x-ui.button size="lg">LG</x-ui.button>
                        <x-ui.button size="xl">XL</x-ui.button>
                    </div>

                    <div class="mt-4">
                        <x-ui.code-preview language="markup">
                            &lt;x-ui.button size="xs"&gt;XS&lt;/x-ui.button&gt;
                            &lt;x-ui.button size="sm"&gt;SM&lt;/x-ui.button&gt;
                            &lt;x-ui.button size="md"&gt;MD&lt;/x-ui.button&gt;
                            &lt;x-ui.button size="lg"&gt;LG&lt;/x-ui.button&gt;
                            &lt;x-ui.button size="xl"&gt;XL&lt;/x-ui.button&gt;
                        </x-ui.code-preview>
                    </div>
                </div>

                <!-- Radius -->
                <div>
                    <h3 class="mb-3 text-sm font-semibold text-muted-foreground">Radius</h3>

                    <div class="flex flex-wrap gap-3">
                        <x-ui.button radius="sm">SM</x-ui.button>
                        <x-ui.button radius="md">MD</x-ui.button>
                        <x-ui.button radius="lg">LG</x-ui.button>
                        <x-ui.button radius="full">FULL</x-ui.button>
                    </div>

                    <div class="mt-4">
                        <x-ui.code-preview language="markup">
                            &lt;x-ui.button radius="sm"&gt;SM&lt;/x-ui.button&gt;
                            &lt;x-ui.button radius="md"&gt;MD&lt;/x-ui.button&gt;
                            &lt;x-ui.button radius="lg"&gt;LG&lt;/x-ui.button&gt;
                            &lt;x-ui.button radius="full"&gt;FULL&lt;/x-ui.button&gt;
                        </x-ui.code-preview>
                    </div>
                </div>

                <!-- States -->
                <div>
                    <h3 class="mb-3 text-sm font-semibold text-muted-foreground">States</h3>

                    <div class="flex flex-wrap gap-3">
                        <x-ui.button :loading="true" loadingText="Saving...">Save</x-ui.button>
                        <x-ui.button :loading="true" loadingPosition="right">Submit</x-ui.button>
                        <x-ui.button :slim="true">Slim</x-ui.button>
                        <x-ui.button :full-width="true" class="sm:w-auto">Full Width</x-ui.button>
                        <x-ui.button disabled>Disabled</x-ui.button>
                        <x-ui.button variant="secondary" disabled>Disabled Secondary</x-ui.button>
                        <x-ui.button variant="outline" disabled>Disabled Outline</x-ui.button>

                        <x-ui.button disabled>
                            <x-slot:leftIcon>
                                <x-lucide-lock class="w-4 h-4" />
                            </x-slot:leftIcon>
                            Locked
                        </x-ui.button>
                    </div>

                    <div class="mt-4">
                        <x-ui.code-preview language="markup">
                            &lt;x-ui.button :loading="true" loadingText="Saving..."&gt;Save&lt;/x-ui.button&gt;
                            &lt;x-ui.button :loading="true" loadingPosition="right"&gt;Submit&lt;/x-ui.button&gt;
                            &lt;x-ui.button :slim="true"&gt;Slim&lt;/x-ui.button&gt;
                            &lt;x-ui.button :full-width="true"&gt;Full Width&lt;/x-ui.button&gt;
                            &lt;x-ui.button disabled&gt;Disabled&lt;/x-ui.button&gt;
                            &lt;x-ui.button variant="secondary" disabled&gt;Disabled Secondary&lt;/x-ui.button&gt;
                            &lt;x-ui.button variant="outline" disabled&gt;Disabled Outline&lt;/x-ui.button&gt;
                        </x-ui.code-preview>
                    </div>
                </div>

                <!-- Icons -->
                <div>
                    <h3 class="mb-3 text-sm font-semibold text-muted-foreground">Icons</h3>

                    <div class="flex flex-wrap gap-3">
                        <x-ui.button :icon-only="true" tooltip="Search">
                            <x-slot:leftIcon>
                                <x-lucide-search class="w-4 h-4" />
                            </x-slot:leftIcon>
                        </x-ui.button>

                        <x-ui.button iconPosition="right">
                            Continue
                            <x-slot:rightIcon>
                                <x-lucide-arrow-right class="w-4 h-4" />
                            </x-slot:rightIcon>
                        </x-ui.button>
                    </div>

                    <div class="mt-4">
                        <x-ui.code-preview language="markup">
                            &lt;x-ui.button :icon-only="true" tooltip="Search"&gt;
                            &lt;x-slot:leftIcon&gt;
                            &lt;x-lucide-search class="w-4 h-4" /&gt;
                            &lt;/x-slot:leftIcon&gt;
                            &lt;/x-ui.button&gt;

                            &lt;x-ui.button iconPosition="right"&gt;
                            Continue
                            &lt;x-slot:rightIcon&gt;
                            &lt;x-lucide-arrow-right class="w-4 h-4" /&gt;
                            &lt;/x-slot:rightIcon&gt;
                            &lt;/x-ui.button&gt;
                        </x-ui.code-preview>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <h3 class="mb-3 text-sm font-semibold text-muted-foreground">Description</h3>

                    <div class="flex flex-col gap-4 max-w-sm">
                        <x-ui.button description="This will save your changes">
                            Save Changes
                        </x-ui.button>

                        <x-ui.button :loading="true" description="Processing your request...">
                            Submit
                        </x-ui.button>

                        <x-ui.button description="Continue to the next step">
                            <x-slot:leftIcon>
                                <x-lucide-arrow-right class="w-4 h-4" />
                            </x-slot:leftIcon>
                            Continue
                        </x-ui.button>

                        <x-ui.button disabled description="You don’t have permission">
                            Disabled Action
                        </x-ui.button>
                    </div>

                    <div class="mt-4">
                        <x-ui.code-preview language="markup">
                            &lt;x-ui.button description="This will save your changes"&gt;
                            Save Changes
                            &lt;/x-ui.button&gt;

                            &lt;x-ui.button :loading="true" description="Processing your request..."&gt;
                            Submit
                            &lt;/x-ui.button&gt;
                        </x-ui.code-preview>
                    </div>
                </div>

                <!-- Error -->
                <div>
                    <h3 class="mb-3 text-sm font-semibold text-muted-foreground">Error</h3>

                    <div class="max-w-sm">
                        <x-ui.button error="Something went wrong">
                            Retry
                        </x-ui.button>
                    </div>

                    <div class="mt-4">
                        <x-ui.code-preview language="markup">
                            &lt;x-ui.button error="Something went wrong"&gt;
                            Retry
                            &lt;/x-ui.button&gt;
                        </x-ui.code-preview>
                    </div>
                </div>

            </div>
        </x-ui.card>
    </section>
</x-layouts.preview>
