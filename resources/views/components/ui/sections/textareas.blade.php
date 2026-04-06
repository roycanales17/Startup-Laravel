<x-layouts.preview>
    <section class="space-y-6">

        <!-- Title -->
        <div>
            <h2 class="text-xl font-semibold">Textareas</h2>
            <p class="text-sm text-muted-foreground">
                Fully customizable textarea fields with support for variants, sizes, prefix/suffix, icons, descriptions, states, shadows, autosize, and flexible layouts.
            </p>
        </div>

        <!-- Basic -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Basic</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.textarea
                    label="Default"
                    placeholder="Write something..."
                />

                <x-ui.textarea
                    label="With Hint"
                    placeholder="Write something..."
                    hint="Helper message here."
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.textarea
                    label="Default"
                    placeholder="Write something..."
                    /&gt;

                    &lt;x-ui.textarea
                    label="With Hint"
                    placeholder="Write something..."
                    hint="Helper message here."
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Sizes -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Sizes</h3>

            <div class="space-y-3">
                <x-ui.textarea size="xs" placeholder="Extra Small" />
                <x-ui.textarea size="sm" placeholder="Small" />
                <x-ui.textarea size="md" placeholder="Medium (default)" />
                <x-ui.textarea size="lg" placeholder="Large" />
                <x-ui.textarea size="xl" placeholder="Extra Large" />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.textarea size="xs" /&gt;
                    &lt;x-ui.textarea size="sm" /&gt;
                    &lt;x-ui.textarea size="md" /&gt;
                    &lt;x-ui.textarea size="lg" /&gt;
                    &lt;x-ui.textarea size="xl" /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Variants -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Variants</h3>

            <div class="space-y-3">
                <x-ui.textarea variant="default" placeholder="Default" />
                <x-ui.textarea variant="filled" placeholder="Filled" />
                <x-ui.textarea variant="ghost" placeholder="Ghost" />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.textarea variant="default" /&gt;
                    &lt;x-ui.textarea variant="filled" /&gt;
                    &lt;x-ui.textarea variant="ghost" /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Shadows -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Shadows</h3>

            <div class="space-y-3">
                <x-ui.textarea shadow="none" placeholder="No shadow" />
                <x-ui.textarea shadow="sm" placeholder="Small shadow" />
                <x-ui.textarea shadow="md" placeholder="Medium shadow" />
                <x-ui.textarea shadow="lg" placeholder="Large shadow" />
                <x-ui.textarea shadow="xl" placeholder="Extra large shadow" />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.textarea shadow="none" /&gt;
                    &lt;x-ui.textarea shadow="sm" /&gt;
                    &lt;x-ui.textarea shadow="md" /&gt;
                    &lt;x-ui.textarea shadow="lg" /&gt;
                    &lt;x-ui.textarea shadow="xl" /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- States -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">States</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.textarea
                    label="Error"
                    error="This field is required."
                />

                <x-ui.textarea
                    label="Success"
                    success="Looks good!"
                />

                <x-ui.textarea
                    label="Disabled"
                    disabled
                    placeholder="Disabled textarea"
                />

                <x-ui.textarea
                    label="Readonly"
                    readonly
                >Readonly content</x-ui.textarea>
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.textarea label="Error" error="This field is required." /&gt;
                    &lt;x-ui.textarea label="Success" success="Looks good!" /&gt;
                    &lt;x-ui.textarea disabled placeholder="Disabled textarea" /&gt;
                    &lt;x-ui.textarea readonly&gt;Readonly content&lt;/x-ui.textarea&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Icons / Prefix / Suffix -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Icons / Prefix / Suffix</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.textarea label="With Prefix" prefix="Note:" placeholder="Add an internal note..." />

                <x-ui.textarea label="With Suffix" suffix="Optional" placeholder="Add extra details..." />

                <x-ui.textarea label="Leading Icon" placeholder="Write a message...">
                    <x-slot:leading>
                        <x-lucide-message-square-text class="h-4 w-4" />
                    </x-slot:leading>
                </x-ui.textarea>

                <x-ui.textarea label="Trailing Icon" placeholder="Searchable notes...">
                    <x-slot:trailing>
                        <x-lucide-search class="h-4 w-4" />
                    </x-slot:trailing>
                </x-ui.textarea>
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.textarea prefix="Note:" /&gt;
                    &lt;x-ui.textarea suffix="Optional" /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Textarea Features -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Textarea Features</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.textarea
                    label="Autosize"
                    autosize
                    placeholder="Start typing..."
                />

                <x-ui.textarea
                    label="Rows"
                    rows="6"
                    placeholder="Fixed height..."
                />

                <x-ui.textarea
                    label="Resize Disabled"
                    resize="none"
                    placeholder="Cannot resize..."
                />

                <x-ui.textarea
                    label="Resize Both"
                    resize="both"
                    placeholder="Try resizing..."
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.textarea autosize /&gt;
                    &lt;x-ui.textarea rows="6" /&gt;
                    &lt;x-ui.textarea resize="none" /&gt;
                    &lt;x-ui.textarea resize="both" /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Description / Pre-info -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Description / Pre-info</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.textarea
                    label="Internal Notes"
                    description="Only visible to admins."
                    placeholder="Write internal notes..."
                />

                <x-ui.textarea
                    label="Feedback"
                    description="Share your thoughts."
                    hint="Be as detailed as possible."
                    placeholder="Enter feedback..."
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.textarea description="Only visible to admins." /&gt;
                    &lt;x-ui.textarea hint="Be as detailed as possible." /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Extra Features -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Extra Features</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.textarea
                    label="Clearable"
                    clearable
                    placeholder="Try typing..."
                />

                <x-ui.textarea
                    label="Loading"
                    loading
                    placeholder="Loading..."
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.textarea clearable /&gt;
                    &lt;x-ui.textarea loading /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

    </section>
</x-layouts.preview>
