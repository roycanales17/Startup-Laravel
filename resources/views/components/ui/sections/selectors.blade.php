<x-layouts.preview>
    <section class="space-y-6">

        <!-- Title -->
        <div>
            <h2 class="text-xl font-semibold">Selectors</h2>
            <p class="text-sm text-muted-foreground">
                Fully customizable selector fields with variants, sizes, icons, states, descriptions, shadows, searchable dropdowns, and single or multiple selection support.
            </p>
        </div>

        <!-- Basic -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Basic</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.selector
                    label="Default"
                    placeholder="Choose status..."
                    :options="[
                    'Pending',
                    'Processing',
                    'Completed',
                    'Cancelled',
                ]"
                />

                <x-ui.selector
                    label="With Hint"
                    placeholder="Choose priority..."
                    hint="Select one priority level."
                    :options="[
                    'Low',
                    'Medium',
                    'High',
                    'Urgent',
                ]"
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.selector
                    label="Default"
                    placeholder="Choose status..."
                    :options="[
                    'Pending',
                    'Processing',
                    'Completed',
                    'Cancelled',
                    ]"
                    /&gt;

                    &lt;x-ui.selector
                    label="With Hint"
                    placeholder="Choose priority..."
                    hint="Select one priority level."
                    :options="[
                    'Low',
                    'Medium',
                    'High',
                    'Urgent',
                    ]"
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Sizes -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Sizes</h3>

            <div class="space-y-3">
                <x-ui.selector size="xs" placeholder="Extra Small" :options="['One', 'Two', 'Three']" />
                <x-ui.selector size="sm" placeholder="Small" :options="['One', 'Two', 'Three']" />
                <x-ui.selector size="md" placeholder="Medium (default)" :options="['One', 'Two', 'Three']" />
                <x-ui.selector size="lg" placeholder="Large" :options="['One', 'Two', 'Three']" />
                <x-ui.selector size="xl" placeholder="Extra Large" :options="['One', 'Two', 'Three']" />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.selector size="xs" :options="['One', 'Two', 'Three']" /&gt;
                    &lt;x-ui.selector size="sm" :options="['One', 'Two', 'Three']" /&gt;
                    &lt;x-ui.selector size="md" :options="['One', 'Two', 'Three']" /&gt;
                    &lt;x-ui.selector size="lg" :options="['One', 'Two', 'Three']" /&gt;
                    &lt;x-ui.selector size="xl" :options="['One', 'Two', 'Three']" /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Variants -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Variants</h3>

            <div class="space-y-3">
                <x-ui.selector variant="default" placeholder="Default" :options="['One', 'Two', 'Three']" />
                <x-ui.selector variant="filled" placeholder="Filled" :options="['One', 'Two', 'Three']" />
                <x-ui.selector variant="ghost" placeholder="Ghost" :options="['One', 'Two', 'Three']" />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.selector variant="default" :options="['One', 'Two', 'Three']" /&gt;
                    &lt;x-ui.selector variant="filled" :options="['One', 'Two', 'Three']" /&gt;
                    &lt;x-ui.selector variant="ghost" :options="['One', 'Two', 'Three']" /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Shadows -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Shadows</h3>

            <div class="space-y-3">
                <x-ui.selector shadow="none" placeholder="No shadow" :options="['One', 'Two', 'Three']" />
                <x-ui.selector shadow="sm" placeholder="Small shadow" :options="['One', 'Two', 'Three']" />
                <x-ui.selector shadow="md" placeholder="Medium shadow" :options="['One', 'Two', 'Three']" />
                <x-ui.selector shadow="lg" placeholder="Large shadow" :options="['One', 'Two', 'Three']" />
                <x-ui.selector shadow="xl" placeholder="Extra large shadow" :options="['One', 'Two', 'Three']" />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.selector shadow="none" :options="['One', 'Two', 'Three']" /&gt;
                    &lt;x-ui.selector shadow="sm" :options="['One', 'Two', 'Three']" /&gt;
                    &lt;x-ui.selector shadow="md" :options="['One', 'Two', 'Three']" /&gt;
                    &lt;x-ui.selector shadow="lg" :options="['One', 'Two', 'Three']" /&gt;
                    &lt;x-ui.selector shadow="xl" :options="['One', 'Two', 'Three']" /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- States -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">States</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.selector
                    label="Error"
                    error="This field is required."
                    :options="[
                    'Draft',
                    'Published',
                    'Archived',
                ]"
                />

                <x-ui.selector
                    label="Success"
                    success="Looks good!"
                    :options="[
                    'Draft',
                    'Published',
                    'Archived',
                ]"
                />

                <x-ui.selector
                    label="Disabled"
                    disabled
                    placeholder="Disabled selector"
                    :options="[
                    'Draft',
                    'Published',
                    'Archived',
                ]"
                />

                <x-ui.selector
                    label="Readonly"
                    readonly
                    value="Published"
                    :options="[
                    'Draft',
                    'Published',
                    'Archived',
                ]"
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.selector
                    label="Error"
                    error="This field is required."
                    :options="[
                    'Draft',
                    'Published',
                    'Archived',
                    ]"
                    /&gt;

                    &lt;x-ui.selector
                    label="Success"
                    success="Looks good!"
                    :options="[
                    'Draft',
                    'Published',
                    'Archived',
                    ]"
                    /&gt;

                    &lt;x-ui.selector
                    label="Disabled"
                    disabled
                    :options="[
                    'Draft',
                    'Published',
                    'Archived',
                    ]"
                    /&gt;

                    &lt;x-ui.selector
                    label="Readonly"
                    readonly
                    value="Published"
                    :options="[
                    'Draft',
                    'Published',
                    'Archived',
                    ]"
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Icons -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Icons</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.selector
                    label="Leading Icon"
                    placeholder="Choose a user role..."
                    :options="[
                    'Super Admin',
                    'Manager',
                    'Viewer',
                ]"
                >
                    <x-slot:leading>
                        <x-lucide-shield-check class="h-4 w-4" />
                    </x-slot:leading>
                </x-ui.selector>

                <x-ui.selector
                    label="Trailing Icon"
                    placeholder="Choose a country..."
                    :options="[
                    'Philippines',
                    'Japan',
                    'Singapore',
                ]"
                >
                    <x-slot:trailing>
                        <x-lucide-globe-2 class="h-4 w-4" />
                    </x-slot:trailing>
                </x-ui.selector>
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.selector
                    label="Leading Icon"
                    placeholder="Choose a user role..."
                    :options="[
                    'Super Admin',
                    'Manager',
                    'Viewer',
                    ]"
                    &gt;
                    &lt;x-slot:leading&gt;
                    &lt;x-lucide-shield-check class="h-4 w-4" /&gt;
                    &lt;/x-slot:leading&gt;
                    &lt;/x-ui.selector&gt;

                    &lt;x-ui.selector
                    label="Trailing Icon"
                    placeholder="Choose a country..."
                    :options="[
                    'Philippines',
                    'Japan',
                    'Singapore',
                    ]"
                    &gt;
                    &lt;x-slot:trailing&gt;
                    &lt;x-lucide-globe-2 class="h-4 w-4" /&gt;
                    &lt;/x-slot:trailing&gt;
                    &lt;/x-ui.selector&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Extra Features -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Extra Features</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.selector
                    label="Clearable"
                    placeholder="Choose department..."
                    clearable
                    :options="[
                    'Finance',
                    'Operations',
                    'Marketing',
                    'Development',
                ]"
                />

                <x-ui.selector
                    label="Loading"
                    placeholder="Loading options..."
                    loading
                    :options="[
                    'Option 1',
                    'Option 2',
                ]"
                >
                    <x-slot:leading>
                        <x-lucide-loader-2 class="h-4 w-4 animate-spin" />
                    </x-slot:leading>
                </x-ui.selector>
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.selector
                    label="Clearable"
                    placeholder="Choose department..."
                    clearable
                    :options="[
                    'Finance',
                    'Operations',
                    'Marketing',
                    'Development',
                    ]"
                    /&gt;

                    &lt;x-ui.selector
                    label="Loading"
                    placeholder="Loading options..."
                    loading
                    :options="[
                    'Option 1',
                    'Option 2',
                    ]"
                    &gt;
                    &lt;x-slot:leading&gt;
                    &lt;x-lucide-loader-2 class="h-4 w-4 animate-spin" /&gt;
                    &lt;/x-slot:leading&gt;
                    &lt;/x-ui.selector&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Description / Pre-info -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Description / Pre-info</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.selector
                    label="Country"
                    description="Select the country used for this account."
                    placeholder="Choose country..."
                    :options="[
                    'Philippines',
                    'Japan',
                    'Singapore',
                    'Malaysia',
                ]"
                />

                <x-ui.selector
                    label="Project Status"
                    description="This affects how the project is shown in the admin panel."
                    hint="You can change this later."
                    placeholder="Choose status..."
                    :options="[
                    'Planning',
                    'In Progress',
                    'Completed',
                    'On Hold',
                ]"
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.selector
                    label="Country"
                    description="Select the country used for this account."
                    placeholder="Choose country..."
                    :options="[
                    'Philippines',
                    'Japan',
                    'Singapore',
                    'Malaysia',
                    ]"
                    /&gt;

                    &lt;x-ui.selector
                    label="Project Status"
                    description="This affects how the project is shown in the admin panel."
                    hint="You can change this later."
                    placeholder="Choose status..."
                    :options="[
                    'Planning',
                    'In Progress',
                    'Completed',
                    'On Hold',
                    ]"
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Searchable Selector -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Searchable Selector</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.selector
                    label="Country"
                    name="country"
                    placeholder="Choose country..."
                    searchable
                    searchPlaceholder="Search country..."
                    :options="[
                    'Philippines',
                    'Japan',
                    'Singapore',
                    'Malaysia',
                    'Thailand',
                    'Indonesia',
                ]"
                >
                    <x-slot:leading>
                        <x-lucide-search class="h-4 w-4" />
                    </x-slot:leading>
                </x-ui.selector>

                <x-ui.selector
                    label="Category"
                    description="This uses label/value pairs and descriptions."
                    name="category"
                    placeholder="Choose category..."
                    searchable
                    searchPlaceholder="Search category..."
                    :options="[
                    ['label' => 'Web Design', 'value' => 'web-design', 'description' => 'UI and website design'],
                    ['label' => 'Laravel Development', 'value' => 'laravel-development', 'description' => 'Backend and admin systems'],
                    ['label' => 'SEO', 'value' => 'seo', 'description' => 'Search engine optimization'],
                    ['label' => 'Branding', 'value' => 'branding', 'description' => 'Identity and brand assets'],
                ]"
                >
                    <x-slot:leading>
                        <x-lucide-folder-search class="h-4 w-4" />
                    </x-slot:leading>
                </x-ui.selector>
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.selector
                    label="Country"
                    name="country"
                    placeholder="Choose country..."
                    searchable
                    searchPlaceholder="Search country..."
                    :options="[
                    'Philippines',
                    'Japan',
                    'Singapore',
                    'Malaysia',
                    'Thailand',
                    'Indonesia',
                    ]"
                    &gt;
                    &lt;x-slot:leading&gt;
                    &lt;x-lucide-search class="h-4 w-4" /&gt;
                    &lt;/x-slot:leading&gt;
                    &lt;/x-ui.selector&gt;

                    &lt;x-ui.selector
                    label="Category"
                    description="This uses label/value pairs and descriptions."
                    name="category"
                    placeholder="Choose category..."
                    searchable
                    searchPlaceholder="Search category..."
                    :options="[
                    [
                    'label' =&gt; 'Web Design',
                    'value' =&gt; 'web-design',
                    'description' =&gt; 'UI and website design',
                    ],
                    [
                    'label' =&gt; 'Laravel Development',
                    'value' =&gt; 'laravel-development',
                    'description' =&gt; 'Backend and admin systems',
                    ],
                    [
                    'label' =&gt; 'SEO',
                    'value' =&gt; 'seo',
                    'description' =&gt; 'Search engine optimization',
                    ],
                    [
                    'label' =&gt; 'Branding',
                    'value' =&gt; 'branding',
                    'description' =&gt; 'Identity and brand assets',
                    ],
                    ]"
                    &gt;
                    &lt;x-slot:leading&gt;
                    &lt;x-lucide-folder-search class="h-4 w-4" /&gt;
                    &lt;/x-slot:leading&gt;
                    &lt;/x-ui.selector&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Multiple Selector -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Multiple Selector</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.selector
                    label="Skills"
                    description="Select multiple skills inside the same selector field."
                    name="skills"
                    placeholder="Choose skills..."
                    multiple
                    searchable
                    clearable
                    :options="[
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
                </x-ui.selector>

                <x-ui.selector
                    label="Project Tags"
                    name="tags"
                    placeholder="Choose tags..."
                    multiple
                    searchable
                    :options="[
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
                </x-ui.selector>
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.selector
                    label="Skills"
                    description="Select multiple skills inside the same selector field."
                    name="skills"
                    placeholder="Choose skills..."
                    multiple
                    searchable
                    clearable
                    :options="[
                    'PHP',
                    'Laravel',
                    'Livewire',
                    'Alpine.js',
                    'Tailwind CSS',
                    'MySQL',
                    'JavaScript',
                    ]"
                    hint="You can select more than one."
                    &gt;
                    &lt;x-slot:leading&gt;
                    &lt;x-lucide-tags class="h-4 w-4" /&gt;
                    &lt;/x-slot:leading&gt;
                    &lt;/x-ui.selector&gt;

                    &lt;x-ui.selector
                    label="Project Tags"
                    name="tags"
                    placeholder="Choose tags..."
                    multiple
                    searchable
                    :options="[
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
                    &lt;/x-ui.selector&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

    </section>
</x-layouts.preview>
