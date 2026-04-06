<x-layouts.preview>
    <section class="space-y-6">

        <!-- Title -->
        <div>
            <h2 class="text-xl font-semibold">Inputs</h2>
            <p class="text-sm text-muted-foreground">
                Fully customizable input fields with variants, sizes, icons, states, descriptions, shadows, and autocomplete features.
            </p>
        </div>

        <!-- Basic -->
        <x-ui.card
            title="Basic"
            description="Standard input usage with optional helper text."
        >
            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.input
                    label="Default"
                    placeholder="Enter text..."
                />

                <x-ui.input
                    label="With Hint"
                    placeholder="Enter text..."
                    hint="Helper message here."
                />
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.input
                    label="Default"
                    placeholder="Enter text..."
                    /&gt;

                    &lt;x-ui.input
                    label="With Hint"
                    placeholder="Enter text..."
                    hint="Helper message here."
                    /&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <!-- Sizes -->
        <x-ui.card
            title="Sizes"
            description="Supports extra small to extra large sizes."
        >
            <div class="space-y-3">
                <x-ui.input size="xs" placeholder="Extra Small" />
                <x-ui.input size="sm" placeholder="Small" />
                <x-ui.input size="md" placeholder="Medium (default)" />
                <x-ui.input size="lg" placeholder="Large" />
                <x-ui.input size="xl" placeholder="Extra Large" />
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.input size="xs" /&gt;
                    &lt;x-ui.input size="sm" /&gt;
                    &lt;x-ui.input size="md" /&gt;
                    &lt;x-ui.input size="lg" /&gt;
                    &lt;x-ui.input size="xl" /&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <!-- Variants -->
        <x-ui.card
            title="Variants"
            description="Different visual styles for various UI needs."
        >
            <div class="space-y-3">
                <x-ui.input variant="default" placeholder="Default" />
                <x-ui.input variant="filled" placeholder="Filled" />
                <x-ui.input variant="ghost" placeholder="Ghost" />
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.input variant="default" /&gt;
                    &lt;x-ui.input variant="filled" /&gt;
                    &lt;x-ui.input variant="ghost" /&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <!-- Shadows -->
        <x-ui.card
            title="Shadows"
            description="Shadow levels for flatter or more elevated input styles."
        >
            <div class="space-y-3">
                <x-ui.input shadow="none" placeholder="No shadow" />
                <x-ui.input shadow="sm" placeholder="Small shadow" />
                <x-ui.input shadow="md" placeholder="Medium shadow" />
                <x-ui.input shadow="lg" placeholder="Large shadow" />
                <x-ui.input shadow="xl" placeholder="Extra large shadow" />
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.input shadow="none" /&gt;
                    &lt;x-ui.input shadow="sm" /&gt;
                    &lt;x-ui.input shadow="md" /&gt;
                    &lt;x-ui.input shadow="lg" /&gt;
                    &lt;x-ui.input shadow="xl" /&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <!-- States -->
        <x-ui.card
            title="States"
            description="Validation and interaction states for different input conditions."
        >
            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.input
                    label="Error"
                    error="This field is required."
                />

                <x-ui.input
                    label="Success"
                    success="Looks good!"
                />

                <x-ui.input
                    label="Disabled"
                    disabled
                    placeholder="Disabled input"
                />

                <x-ui.input
                    label="Readonly"
                    readonly
                    value="Readonly value"
                />
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.input
                    label="Error"
                    error="This field is required."
                    /&gt;

                    &lt;x-ui.input
                    label="Success"
                    success="Looks good!"
                    /&gt;

                    &lt;x-ui.input
                    label="Disabled"
                    disabled
                    placeholder="Disabled input"
                    /&gt;

                    &lt;x-ui.input
                    label="Readonly"
                    readonly
                    value="Readonly value"
                    /&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <!-- Icons / Prefix / Suffix -->
        <x-ui.card
            title="Icons / Prefix / Suffix"
            description="Supports affixes and icon slots for clearer input context."
        >
            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.input
                    label="With Prefix"
                    prefix="₱"
                    type="number"
                    placeholder="0.00"
                />

                <x-ui.input
                    label="With Suffix"
                    suffix="PHP"
                    type="number"
                    placeholder="0.00"
                />

                <x-ui.input
                    label="Leading Icon"
                    placeholder="Username"
                >
                    <x-slot:leading>
                        <x-lucide-user class="h-4 w-4" />
                    </x-slot:leading>
                </x-ui.input>

                <x-ui.input
                    label="Trailing Icon"
                    placeholder="Search..."
                >
                    <x-slot:trailing>
                        <x-lucide-search class="h-4 w-4" />
                    </x-slot:trailing>
                </x-ui.input>
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.input
                    label="With Prefix"
                    prefix="₱"
                    type="number"
                    placeholder="0.00"
                    /&gt;

                    &lt;x-ui.input
                    label="With Suffix"
                    suffix="PHP"
                    type="number"
                    placeholder="0.00"
                    /&gt;

                    &lt;x-ui.input
                    label="Leading Icon"
                    placeholder="Username"
                    &gt;
                    &lt;x-slot:leading&gt;
                    &lt;x-lucide-user class="h-4 w-4" /&gt;
                    &lt;/x-slot:leading&gt;
                    &lt;/x-ui.input&gt;

                    &lt;x-ui.input
                    label="Trailing Icon"
                    placeholder="Search..."
                    &gt;
                    &lt;x-slot:trailing&gt;
                    &lt;x-lucide-search class="h-4 w-4" /&gt;
                    &lt;/x-slot:trailing&gt;
                    &lt;/x-ui.input&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <!-- Extra Features -->
        <x-ui.card
            title="Extra Features"
            description="Optional utility features like clearable input and loading state."
        >
            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.input
                    label="Clearable"
                    placeholder="Try typing..."
                    clearable
                />

                <x-ui.input
                    label="Loading"
                    placeholder="Loading..."
                    loading
                >
                    <x-slot:leading>
                        <x-lucide-loader-2 class="h-4 w-4 animate-spin" />
                    </x-slot:leading>
                </x-ui.input>
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.input
                    label="Clearable"
                    placeholder="Try typing..."
                    clearable
                    /&gt;

                    &lt;x-ui.input
                    label="Loading"
                    placeholder="Loading..."
                    loading
                    &gt;
                    &lt;x-slot:leading&gt;
                    &lt;x-lucide-loader-2 class="h-4 w-4 animate-spin" /&gt;
                    &lt;/x-slot:leading&gt;
                    &lt;/x-ui.input&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <!-- Description / Pre-info -->
        <x-ui.card
            title="Description / Pre-info"
            description="Helpful supporting text shown below the label before the field."
        >
            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.input
                    label="Email Address"
                    description="We’ll use this for account-related updates only."
                    placeholder="name@example.com"
                />

                <x-ui.input
                    label="Project Name"
                    description="Choose a short and recognizable name for your project."
                    placeholder="My Admin Dashboard"
                    hint="You can change this later."
                />
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.input
                    label="Email Address"
                    description="We’ll use this for account-related updates only."
                    placeholder="name@example.com"
                    /&gt;

                    &lt;x-ui.input
                    label="Project Name"
                    description="Choose a short and recognizable name for your project."
                    placeholder="My Admin Dashboard"
                    hint="You can change this later."
                    /&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <!-- Autocomplete -->
        <x-ui.card
            title="Autocomplete"
            description="Dropdown suggestions for faster and more guided text entry."
        >
            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.input
                    label="Country"
                    name="country"
                    placeholder="Type country..."
                    autocomplete
                    :suggestions="[
                        'Philippines',
                        'Japan',
                        'Singapore',
                        'Malaysia',
                        'Thailand',
                        'Indonesia',
                    ]"
                >
                    <x-slot:leading>
                        <x-lucide-map-pinned class="h-4 w-4" />
                    </x-slot:leading>
                </x-ui.input>

                <x-ui.input
                    label="Category"
                    description="This uses label/value pairs for autocomplete."
                    name="category"
                    placeholder="Choose category..."
                    autocomplete
                    :suggestions="[
                        ['label' => 'Web Design', 'value' => 'web-design'],
                        ['label' => 'Laravel Development', 'value' => 'laravel-development'],
                        ['label' => 'SEO', 'value' => 'seo'],
                        ['label' => 'Branding', 'value' => 'branding'],
                    ]"
                >
                    <x-slot:leading>
                        <x-lucide-folder-search class="h-4 w-4" />
                    </x-slot:leading>
                </x-ui.input>
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.input
                    label="Country"
                    name="country"
                    placeholder="Type country..."
                    autocomplete
                    :suggestions="[
                    'Philippines',
                    'Japan',
                    'Singapore',
                    'Malaysia',
                    'Thailand',
                    'Indonesia',
                    ]"
                    &gt;
                    &lt;x-slot:leading&gt;
                    &lt;x-lucide-map-pinned class="h-4 w-4" /&gt;
                    &lt;/x-slot:leading&gt;
                    &lt;/x-ui.input&gt;

                    &lt;x-ui.input
                    label="Category"
                    description="This uses label/value pairs for autocomplete."
                    name="category"
                    placeholder="Choose category..."
                    autocomplete
                    :suggestions="[
                    ['label' =&gt; 'Web Design', 'value' =&gt; 'web-design'],
                    ['label' =&gt; 'Laravel Development', 'value' =&gt; 'laravel-development'],
                    ['label' =&gt; 'SEO', 'value' =&gt; 'seo'],
                    ['label' =&gt; 'Branding', 'value' =&gt; 'branding'],
                    ]"
                    &gt;
                    &lt;x-slot:leading&gt;
                    &lt;x-lucide-folder-search class="h-4 w-4" /&gt;
                    &lt;/x-slot:leading&gt;
                    &lt;/x-ui.input&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

        <!-- Multi Autocomplete Pills -->
        <x-ui.card
            title="Autocomplete Pills / Multi Select"
            description="Select multiple options as pills within the same input."
        >
            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.input
                    label="Skills"
                    description="Select multiple skills inside the same input field."
                    name="skills"
                    placeholder="Type skill..."
                    multipleAutocomplete
                    :suggestions="[
                        'PHP',
                        'Laravel',
                        'Livewire',
                        'Alpine.js',
                        'Tailwind CSS',
                        'MySQL',
                        'JavaScript',
                    ]"
                    hint="You can select more than one."
                >
                    <x-slot:leading>
                        <x-lucide-tags class="h-4 w-4" />
                    </x-slot:leading>
                </x-ui.input>

                <x-ui.input
                    label="Project Tags"
                    name="tags"
                    placeholder="Choose tags..."
                    multipleAutocomplete
                    :suggestions="[
                        'Starter Kit',
                        'Admin',
                        'Dashboard',
                        'Livewire',
                        'Tailwind',
                        'Autocomplete',
                    ]"
                >
                    <x-slot:leading>
                        <x-lucide-bookmark-plus class="h-4 w-4" />
                    </x-slot:leading>
                </x-ui.input>
            </div>

            <x-slot:footerSlot>
                <x-ui.code-preview language="markup">
                    &lt;x-ui.input
                    label="Skills"
                    description="Select multiple skills inside the same input field."
                    name="skills"
                    placeholder="Type skill..."
                    multipleAutocomplete
                    :suggestions="[
                    'PHP',
                    'Laravel',
                    'Livewire',
                    'Alpine.js',
                    'Tailwind CSS',
                    'MySQL',
                    'JavaScript',
                    ]"
                    &gt;
                    &lt;x-slot:leading&gt;
                    &lt;x-lucide-tags class="h-4 w-4" /&gt;
                    &lt;/x-slot:leading&gt;
                    &lt;/x-ui.input&gt;

                    &lt;x-ui.input
                    label="Project Tags"
                    name="tags"
                    placeholder="Choose tags..."
                    multipleAutocomplete
                    :suggestions="[
                    'Starter Kit',
                    'Admin',
                    'Dashboard',
                    'Livewire',
                    'Tailwind',
                    'Autocomplete',
                    ]"
                    &gt;
                    &lt;x-slot:leading&gt;
                    &lt;x-lucide-bookmark-plus class="h-4 w-4" /&gt;
                    &lt;/x-slot:leading&gt;
                    &lt;/x-ui.input&gt;
                </x-ui.code-preview>
            </x-slot:footerSlot>
        </x-ui.card>

    </section>
</x-layouts.preview>
