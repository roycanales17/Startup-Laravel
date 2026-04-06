<x-layouts.preview>
    <section id='cards' class='space-y-6'>

        <!-- Title -->
        <div>
            <h2 class='text-xl font-semibold'>Cards</h2>
            <p class='text-sm text-muted-foreground'>
                Flexible container component used to group related content. Supports header, title, description, actions, footer, variants, sizes, shadows, states, interactive behaviors, and collapsible content.
            </p>
        </div>

        <!-- Basic -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Basic</h3>

            <div class='grid gap-4 md:grid-cols-2'>
                <x-ui.card>
                    Simple card content
                </x-ui.card>

                <x-ui.card title='Card Title'>
                    Card with title only
                </x-ui.card>
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.card&gt;
                    Simple card content
                    &lt;/x-ui.card&gt;

                    &lt;x-ui.card title='Card Title'&gt;
                    Card with title only
                    &lt;/x-ui.card&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Header -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Header (Title &amp; Description)</h3>

            <div class='grid gap-4 md:grid-cols-2'>
                <x-ui.card
                    title='Monthly Budget'
                    description='Track your spending progress.'
                >
                    <p class='text-sm text-muted-foreground'>
                        You have spent ₱7,200 out of ₱10,000.
                    </p>
                </x-ui.card>

                <x-ui.card
                    title='Transactions'
                    description='Latest activity'
                >
                    <p class='text-sm text-muted-foreground'>
                        No transactions yet.
                    </p>
                </x-ui.card>
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.card
                    title='Monthly Budget'
                    description='Track your spending progress.'
                    &gt;
                    Content here
                    &lt;/x-ui.card&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Actions -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Header Actions</h3>

            <x-ui.card
                title='Transactions'
                description='Latest activity'
            >
                <x-slot:actions>
                    <x-ui.button size='sm' variant='ghost'>View All</x-ui.button>
                </x-slot:actions>

                <p class='text-sm text-muted-foreground'>
                    No recent records.
                </p>
            </x-ui.card>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.card
                    title='Transactions'
                    description='Latest activity'
                    &gt;
                    &lt;x-slot:actions&gt;
                    &lt;x-ui.button size='sm' variant='ghost'&gt;View All&lt;/x-ui.button&gt;
                    &lt;/x-slot:actions&gt;

                    &lt;p class='text-sm text-muted-foreground'&gt;
                    No recent records.
                    &lt;/p&gt;
                    &lt;/x-ui.card&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Footer -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Footer</h3>

            <x-ui.card
                title='Account Summary'
                description='Your changes have been saved.'
                footerBordered
            >
                <x-slot:footerSlot>
                    <x-ui.button size='sm'>Save</x-ui.button>
                    <x-ui.button size='sm' variant='outline'>Cancel</x-ui.button>
                </x-slot:footerSlot>
            </x-ui.card>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.card
                    title='Account Summary'
                    description='Your changes have been saved.'
                    footerBordered
                    &gt;
                    &lt;x-slot:footerSlot&gt;
                    &lt;x-ui.button size='sm'&gt;Save&lt;/x-ui.button&gt;
                    &lt;x-ui.button size='sm' variant='outline'&gt;Cancel&lt;/x-ui.button&gt;
                    &lt;/x-slot:footerSlot&gt;
                    &lt;/x-ui.card&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Collapsible -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Collapsible</h3>

            <div class='grid gap-4 md:grid-cols-2'>
                <x-ui.card
                    title='Account Summary'
                    description='Click the toggle to show or hide the content.'
                    collapsible
                >
                    <p class='text-sm text-muted-foreground'>
                        This content can be expanded and collapsed.
                    </p>
                </x-ui.card>

                <x-ui.card
                    title='Monthly Budget'
                    description='This card starts collapsed.'
                    collapsible
                    :expanded='false'
                >
                    <p class='text-sm text-muted-foreground'>
                        ₱7,200 / ₱10,000 used
                    </p>
                </x-ui.card>
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.card
                    title='Account Summary'
                    description='Click the toggle to show or hide the content.'
                    collapsible
                    &gt;
                    &lt;p class='text-sm text-muted-foreground'&gt;
                    This content can be expanded and collapsed.
                    &lt;/p&gt;
                    &lt;/x-ui.card&gt;

                    &lt;x-ui.card
                    title='Monthly Budget'
                    description='This card starts collapsed.'
                    collapsible
                    :expanded='false'
                    &gt;
                    &lt;p class='text-sm text-muted-foreground'&gt;
                    ₱7,200 / ₱10,000 used
                    &lt;/p&gt;
                    &lt;/x-ui.card&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Variants -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Variants</h3>

            <div class='grid gap-4 md:grid-cols-2'>
                <x-ui.card variant='default' title='Default'>Default card</x-ui.card>
                <x-ui.card variant='outline' title='Outline'>Outline card</x-ui.card>
                <x-ui.card variant='filled' title='Filled'>Filled card</x-ui.card>
                <x-ui.card variant='ghost' title='Ghost'>Ghost card</x-ui.card>
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.card variant='default' title='Default'&gt;Default card&lt;/x-ui.card&gt;
                    &lt;x-ui.card variant='outline' title='Outline'&gt;Outline card&lt;/x-ui.card&gt;
                    &lt;x-ui.card variant='filled' title='Filled'&gt;Filled card&lt;/x-ui.card&gt;
                    &lt;x-ui.card variant='ghost' title='Ghost'&gt;Ghost card&lt;/x-ui.card&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Sizes -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Sizes</h3>

            <div class='space-y-4'>
                <x-ui.card size='sm' title='Small'>Small card</x-ui.card>
                <x-ui.card size='md' title='Medium'>Medium card</x-ui.card>
                <x-ui.card size='lg' title='Large'>Large card</x-ui.card>
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.card size='sm' title='Small'&gt;Small card&lt;/x-ui.card&gt;
                    &lt;x-ui.card size='md' title='Medium'&gt;Medium card&lt;/x-ui.card&gt;
                    &lt;x-ui.card size='lg' title='Large'&gt;Large card&lt;/x-ui.card&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Shadows -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Shadows</h3>

            <div class='space-y-4'>
                <x-ui.card shadow='none'>No shadow</x-ui.card>
                <x-ui.card shadow='sm'>Small shadow</x-ui.card>
                <x-ui.card shadow='md'>Medium shadow</x-ui.card>
                <x-ui.card shadow='lg'>Large shadow</x-ui.card>
                <x-ui.card shadow='xl'>Extra large shadow</x-ui.card>
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.card shadow='none'&gt;No shadow&lt;/x-ui.card&gt;
                    &lt;x-ui.card shadow='sm'&gt;Small shadow&lt;/x-ui.card&gt;
                    &lt;x-ui.card shadow='md'&gt;Medium shadow&lt;/x-ui.card&gt;
                    &lt;x-ui.card shadow='lg'&gt;Large shadow&lt;/x-ui.card&gt;
                    &lt;x-ui.card shadow='xl'&gt;Extra large shadow&lt;/x-ui.card&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Interactive -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Interactive</h3>

            <div class='grid gap-4 md:grid-cols-2'>
                <x-ui.card hoverable title='Hoverable'>
                    Hover me
                </x-ui.card>

                <x-ui.card clickable hoverable title='Clickable'>
                    Click me
                </x-ui.card>
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.card hoverable title='Hoverable'&gt;
                    Hover me
                    &lt;/x-ui.card&gt;

                    &lt;x-ui.card clickable hoverable title='Clickable'&gt;
                    Click me
                    &lt;/x-ui.card&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Accent -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Accent</h3>

            <div class='space-y-4'>
                <x-ui.card accent='primary'>Primary accent</x-ui.card>
                <x-ui.card accent='success'>Success accent</x-ui.card>
                <x-ui.card accent='danger'>Danger accent</x-ui.card>
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.card accent='primary'&gt;Primary accent&lt;/x-ui.card&gt;
                    &lt;x-ui.card accent='success'&gt;Success accent&lt;/x-ui.card&gt;
                    &lt;x-ui.card accent='danger'&gt;Danger accent&lt;/x-ui.card&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- States -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>States</h3>

            <div class='grid gap-4 md:grid-cols-2'>
                <x-ui.card disabled title='Disabled'>
                    Disabled card
                </x-ui.card>

                <x-ui.card loading title='Loading'>
                    Loading state
                </x-ui.card>
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.card disabled title='Disabled'&gt;
                    Disabled card
                    &lt;/x-ui.card&gt;

                    &lt;x-ui.card loading title='Loading'&gt;
                    Loading state
                    &lt;/x-ui.card&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Combined -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Combined Example</h3>

            <x-ui.card
                title='Monthly Budget'
                description='Overview of your spending'
                variant='filled'
                shadow='md'
                hoverable
                accent='primary'
                footerBordered
                collapsible
            >
                <x-slot:actions>
                    <x-ui.button size='sm' variant='ghost'>Edit</x-ui.button>
                </x-slot:actions>

                <div class='text-sm text-muted-foreground'>
                    ₱7,200 / ₱10,000 used
                </div>

                <x-slot:footerSlot>
                    <x-ui.button size='sm'>View Details</x-ui.button>
                </x-slot:footerSlot>
            </x-ui.card>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.card
                    title='Monthly Budget'
                    description='Overview of your spending'
                    variant='filled'
                    shadow='md'
                    hoverable
                    accent='primary'
                    footerBordered
                    collapsible
                    &gt;
                    &lt;x-slot:actions&gt;
                    &lt;x-ui.button size='sm' variant='ghost'&gt;Edit&lt;/x-ui.button&gt;
                    &lt;/x-slot:actions&gt;

                    &lt;div class='text-sm text-muted-foreground'&gt;
                    ₱7,200 / ₱10,000 used
                    &lt;/div&gt;

                    &lt;x-slot:footerSlot&gt;
                    &lt;x-ui.button size='sm'&gt;View Details&lt;/x-ui.button&gt;
                    &lt;/x-slot:footerSlot&gt;
                    &lt;/x-ui.card&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

    </section>
</x-layouts.preview>
