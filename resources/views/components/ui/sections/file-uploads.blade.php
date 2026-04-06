<x-layouts.preview>
    <section id='file-upload' class='space-y-6'>

        <!-- Title -->
        <div>
            <h2 class='text-xl font-semibold'>File Upload</h2>
            <p class='text-sm text-muted-foreground'>
                Fully customizable file upload input with drag and drop support, normal input mode, file validation, optional previews, variants, sizes, shadows, states, and multiple file selection.
            </p>
        </div>

        <!-- Basic -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Basic</h3>

            <div class='grid gap-4 md:grid-cols-2'>
                <x-ui.file-upload
                    label='Upload file'
                    name='file_basic'
                />

                <x-ui.file-upload
                    label='With Description'
                    name='file_desc'
                    description='Upload your supporting document.'
                />
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.file-upload
                    label='Upload file'
                    name='file_basic'
                    /&gt;

                    &lt;x-ui.file-upload
                    label='With Description'
                    name='file_desc'
                    description='Upload your supporting document.'
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Modes -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Modes</h3>

            <div class='grid gap-4 md:grid-cols-2'>
                <x-ui.file-upload
                    label='Dropzone Upload'
                    name='file_dropzone_mode'
                    mode='dropzone'
                    description='Drag and drop files or click to browse.'
                />

                <x-ui.file-upload
                    label='Normal File Input'
                    name='file_input_mode'
                    mode='input'
                    description='Standard file input without the drag and drop box.'
                />
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.file-upload
                    label='Dropzone Upload'
                    name='file_dropzone_mode'
                    mode='dropzone'
                    description='Drag and drop files or click to browse.'
                    /&gt;

                    &lt;x-ui.file-upload
                    label='Normal File Input'
                    name='file_input_mode'
                    mode='input'
                    description='Standard file input without the drag and drop box.'
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Validation -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Validation (Type &amp; Size)</h3>

            <div class='grid gap-4 md:grid-cols-2'>
                <x-ui.file-upload
                    label='Images Only'
                    name='file_images'
                    accept='image/*'
                    description='Only image files are allowed.'
                />

                <x-ui.file-upload
                    label='PDF (Max 2MB)'
                    name='file_pdf'
                    accept='.pdf'
                    :max-mb='2'
                    description='Only PDF files under 2MB.'
                />
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.file-upload
                    label='Images Only'
                    name='file_images'
                    accept='image/*'
                    description='Only image files are allowed.'
                    /&gt;

                    &lt;x-ui.file-upload
                    label='PDF (Max 2MB)'
                    name='file_pdf'
                    accept='.pdf'
                    :max-mb='2'
                    description='Only PDF files under 2MB.'
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Multiple -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Multiple Upload</h3>

            <x-ui.file-upload
                label='Upload multiple files'
                name='file_multiple'
                multiple
                description='You can upload multiple files.'
            />

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.file-upload
                    label='Upload multiple files'
                    name='file_multiple'
                    multiple
                    description='You can upload multiple files.'
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Preview -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Preview</h3>

            <p class='mb-4 text-xs text-muted-foreground'>
                Preview is disabled by default. Enable it using <code>show-preview</code>. This works for both dropzone and normal input modes.
            </p>

            <div class='grid gap-4 md:grid-cols-2'>
                <x-ui.file-upload
                    label='Dropzone with Preview'
                    name='file_preview_dropzone'
                    mode='dropzone'
                    accept='image/*,.pdf'
                    :max-mb='5'
                    multiple
                    show-preview
                    description='Preview list will display after selecting files.'
                />

                <x-ui.file-upload
                    label='Input with Preview'
                    name='file_preview_input'
                    mode='input'
                    accept='image/*,.pdf'
                    :max-mb='5'
                    multiple
                    show-preview
                    description='Preview list also works in normal input mode.'
                />
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.file-upload
                    label='Dropzone with Preview'
                    name='file_preview_dropzone'
                    mode='dropzone'
                    accept='image/*,.pdf'
                    :max-mb='5'
                    multiple
                    show-preview
                    description='Preview list will display after selecting files.'
                    /&gt;

                    &lt;x-ui.file-upload
                    label='Input with Preview'
                    name='file_preview_input'
                    mode='input'
                    accept='image/*,.pdf'
                    :max-mb='5'
                    multiple
                    show-preview
                    description='Preview list also works in normal input mode.'
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Sizes -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Sizes</h3>

            <div class='space-y-4'>
                <x-ui.file-upload label='Extra Small' size='xs' name='file_xs' mode='input' />
                <x-ui.file-upload label='Small' size='sm' name='file_sm' mode='input' />
                <x-ui.file-upload label='Medium (Default)' size='md' name='file_md' mode='input' />
                <x-ui.file-upload label='Large' size='lg' name='file_lg' mode='input' />
                <x-ui.file-upload label='Extra Large' size='xl' name='file_xl' mode='input' />
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.file-upload label='Extra Small' size='xs' name='file_xs' mode='input' /&gt;
                    &lt;x-ui.file-upload label='Small' size='sm' name='file_sm' mode='input' /&gt;
                    &lt;x-ui.file-upload label='Medium (Default)' size='md' name='file_md' mode='input' /&gt;
                    &lt;x-ui.file-upload label='Large' size='lg' name='file_lg' mode='input' /&gt;
                    &lt;x-ui.file-upload label='Extra Large' size='xl' name='file_xl' mode='input' /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Variants -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Variants</h3>

            <div class='grid gap-4 md:grid-cols-2'>
                <x-ui.file-upload label='Default' name='file_default' variant='default' mode='input' />
                <x-ui.file-upload label='Filled' name='file_filled' variant='filled' mode='input' />
                <x-ui.file-upload label='Ghost' name='file_ghost' variant='ghost' mode='input' />
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.file-upload label='Default' name='file_default' variant='default' mode='input' /&gt;
                    &lt;x-ui.file-upload label='Filled' name='file_filled' variant='filled' mode='input' /&gt;
                    &lt;x-ui.file-upload label='Ghost' name='file_ghost' variant='ghost' mode='input' /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Shadows -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Shadows</h3>

            <div class='space-y-4'>
                <x-ui.file-upload label='No Shadow' shadow='none' name='file_shadow_none' mode='input' />
                <x-ui.file-upload label='Small Shadow' shadow='sm' name='file_shadow_sm' mode='input' />
                <x-ui.file-upload label='Medium Shadow' shadow='md' name='file_shadow_md' mode='input' />
                <x-ui.file-upload label='Large Shadow' shadow='lg' name='file_shadow_lg' mode='input' />
                <x-ui.file-upload label='Extra Large Shadow' shadow='xl' name='file_shadow_xl' mode='input' />
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.file-upload label='No Shadow' shadow='none' name='file_shadow_none' mode='input' /&gt;
                    &lt;x-ui.file-upload label='Small Shadow' shadow='sm' name='file_shadow_sm' mode='input' /&gt;
                    &lt;x-ui.file-upload label='Medium Shadow' shadow='md' name='file_shadow_md' mode='input' /&gt;
                    &lt;x-ui.file-upload label='Large Shadow' shadow='lg' name='file_shadow_lg' mode='input' /&gt;
                    &lt;x-ui.file-upload label='Extra Large Shadow' shadow='xl' name='file_shadow_xl' mode='input' /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- States -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>States</h3>

            <div class='grid gap-4 md:grid-cols-2'>
                <x-ui.file-upload
                    label='Disabled'
                    name='file_disabled'
                    disabled
                />

                <x-ui.file-upload
                    label='Readonly'
                    name='file_readonly'
                    readonly
                />

                <x-ui.file-upload
                    label='With Error'
                    name='file_error'
                    error='The file is required.'
                />

                <x-ui.file-upload
                    label='Success'
                    name='file_success'
                    success='File uploaded successfully.'
                />
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.file-upload
                    label='Disabled'
                    name='file_disabled'
                    disabled
                    /&gt;

                    &lt;x-ui.file-upload
                    label='Readonly'
                    name='file_readonly'
                    readonly
                    /&gt;

                    &lt;x-ui.file-upload
                    label='With Error'
                    name='file_error'
                    error='The file is required.'
                    /&gt;

                    &lt;x-ui.file-upload
                    label='Success'
                    name='file_success'
                    success='File uploaded successfully.'
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Combined Example -->
        <x-ui.card>
            <h3 class='mb-4 font-medium'>Combined Example</h3>

            <div class='grid gap-4 md:grid-cols-2'>
                <x-ui.file-upload
                    label='Product Images'
                    name='product_images'
                    mode='dropzone'
                    accept='image/*'
                    :max-mb='5'
                    multiple
                    show-preview
                    description='Upload one or more product images.'
                />

                <x-ui.file-upload
                    label='Import File'
                    name='import_file'
                    mode='input'
                    accept='.csv,.xlsx'
                    :max-mb='10'
                    description='Upload a CSV or Excel file for import.'
                />
            </div>

            <div class='mt-4'>
                <x-ui.code-preview language='markup'>
                    &lt;x-ui.file-upload
                    label='Product Images'
                    name='product_images'
                    mode='dropzone'
                    accept='image/*'
                    :max-mb='5'
                    multiple
                    show-preview
                    description='Upload one or more product images.'
                    /&gt;

                    &lt;x-ui.file-upload
                    label='Import File'
                    name='import_file'
                    mode='input'
                    accept='.csv,.xlsx'
                    :max-mb='10'
                    description='Upload a CSV or Excel file for import.'
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

    </section>
</x-layouts.preview>
