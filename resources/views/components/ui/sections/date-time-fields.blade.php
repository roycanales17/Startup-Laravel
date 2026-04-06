<x-layouts.preview>
    <section class="space-y-6">

        <!-- Title -->
        <div>
            <h2 class="text-xl font-semibold">Date / Time Inputs</h2>
            <p class="text-sm text-muted-foreground">
                Date, time, and datetime fields with a custom time dropdown and a single combined datetime control.
            </p>
        </div>

        <!-- Basic -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Basic</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.date-time-field
                    label="Date"
                    name="basic_date"
                    type="date"
                />

                <x-ui.date-time-field
                    label="Time"
                    name="basic_time"
                    type="time"
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.date-time-field
                    label="Date"
                    name="basic_date"
                    type="date"
                    /&gt;

                    &lt;x-ui.date-time-field
                    label="Time"
                    name="basic_time"
                    type="time"
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Types -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Types</h3>

            <div class="space-y-4">
                <x-ui.date-time-field
                    label="Date"
                    name="type_date"
                    type="date"
                />

                <x-ui.date-time-field
                    label="Time"
                    name="type_time"
                    type="time"
                />

                <x-ui.date-time-field
                    label="Datetime"
                    name="type_datetime"
                    type="datetime"
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.date-time-field type="date" /&gt;
                    &lt;x-ui.date-time-field type="time" /&gt;
                    &lt;x-ui.date-time-field type="datetime" /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Sizes -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Sizes</h3>

            <div class="space-y-3">
                <x-ui.date-time-field size="xs" type="date" label="Extra Small" />
                <x-ui.date-time-field size="sm" type="date" label="Small" />
                <x-ui.date-time-field size="md" type="date" label="Medium (default)" />
                <x-ui.date-time-field size="lg" type="date" label="Large" />
                <x-ui.date-time-field size="xl" type="date" label="Extra Large" />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.date-time-field size="xs" type="date" /&gt;
                    &lt;x-ui.date-time-field size="sm" type="date" /&gt;
                    &lt;x-ui.date-time-field size="md" type="date" /&gt;
                    &lt;x-ui.date-time-field size="lg" type="date" /&gt;
                    &lt;x-ui.date-time-field size="xl" type="date" /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Variants -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Variants</h3>

            <div class="space-y-3">
                <x-ui.date-time-field variant="default" type="date" label="Default" />
                <x-ui.date-time-field variant="filled" type="date" label="Filled" />
                <x-ui.date-time-field variant="ghost" type="date" label="Ghost" />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.date-time-field variant="default" type="date" /&gt;
                    &lt;x-ui.date-time-field variant="filled" type="date" /&gt;
                    &lt;x-ui.date-time-field variant="ghost" type="date" /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Shadows -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Shadows</h3>

            <div class="space-y-3">
                <x-ui.date-time-field shadow="none" type="date" label="No shadow" />
                <x-ui.date-time-field shadow="sm" type="date" label="Small shadow" />
                <x-ui.date-time-field shadow="md" type="date" label="Medium shadow" />
                <x-ui.date-time-field shadow="lg" type="date" label="Large shadow" />
                <x-ui.date-time-field shadow="xl" type="date" label="Extra large shadow" />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.date-time-field shadow="none" type="date" /&gt;
                    &lt;x-ui.date-time-field shadow="sm" type="date" /&gt;
                    &lt;x-ui.date-time-field shadow="md" type="date" /&gt;
                    &lt;x-ui.date-time-field shadow="lg" type="date" /&gt;
                    &lt;x-ui.date-time-field shadow="xl" type="date" /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- States -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">States</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.date-time-field
                    label="Error"
                    type="date"
                    error="This field is required."
                />

                <x-ui.date-time-field
                    label="Success"
                    type="date"
                    success="Looks good!"
                />

                <x-ui.date-time-field
                    label="Disabled"
                    type="date"
                    disabled
                />

                <x-ui.date-time-field
                    label="Readonly"
                    type="date"
                    readonly
                    value="2026-04-05"
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.date-time-field
                    label="Error"
                    type="date"
                    error="This field is required."
                    /&gt;

                    &lt;x-ui.date-time-field
                    label="Success"
                    type="date"
                    success="Looks good!"
                    /&gt;

                    &lt;x-ui.date-time-field
                    label="Disabled"
                    type="date"
                    disabled
                    /&gt;

                    &lt;x-ui.date-time-field
                    label="Readonly"
                    type="date"
                    readonly
                    value="2026-04-05"
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Description / Hint -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Description / Hint</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.date-time-field
                    label="Start Date"
                    name="start_date"
                    type="date"
                    description="Choose the date when the schedule should begin."
                />

                <x-ui.date-time-field
                    label="Meeting Time"
                    name="meeting_time"
                    type="time"
                    description="Select the preferred meeting time."
                    hint="Uses the custom time dropdown."
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.date-time-field
                    label="Start Date"
                    name="start_date"
                    type="date"
                    description="Choose the date when the schedule should begin."
                    /&gt;

                    &lt;x-ui.date-time-field
                    label="Meeting Time"
                    name="meeting_time"
                    type="time"
                    description="Select the preferred meeting time."
                    hint="Uses the custom time dropdown."
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Time Modes -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Time Modes</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.date-time-field
                    label="24-Hour Time"
                    name="time_24"
                    type="time"
                    timeMode="24"
                />

                <x-ui.date-time-field
                    label="AM / PM Time"
                    name="time_12"
                    type="time"
                    timeMode="12"
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.date-time-field
                    label="24-Hour Time"
                    name="time_24"
                    type="time"
                    timeMode="24"
                    /&gt;

                    &lt;x-ui.date-time-field
                    label="AM / PM Time"
                    name="time_12"
                    type="time"
                    timeMode="12"
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Time Steps -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Time Steps</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.date-time-field
                    label="15-Minute Step"
                    name="time_step_15"
                    type="time"
                    :timeStep="15"
                    timeMode="12"
                />

                <x-ui.date-time-field
                    label="30-Minute Step"
                    name="time_step_30"
                    type="time"
                    :timeStep="30"
                    timeMode="12"
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.date-time-field
                    label="15-Minute Step"
                    name="time_step_15"
                    type="time"
                    :timeStep="15"
                    timeMode="12"
                    /&gt;

                    &lt;x-ui.date-time-field
                    label="30-Minute Step"
                    name="time_step_30"
                    type="time"
                    :timeStep="30"
                    timeMode="12"
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Datetime -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Datetime</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.date-time-field
                    label="Datetime (24-Hour)"
                    name="datetime_24"
                    type="datetime"
                    timeMode="24"
                />

                <x-ui.date-time-field
                    label="Datetime (AM / PM)"
                    name="datetime_12"
                    type="datetime"
                    timeMode="12"
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.date-time-field
                    label="Datetime (24-Hour)"
                    name="datetime_24"
                    type="datetime"
                    timeMode="24"
                    /&gt;

                    &lt;x-ui.date-time-field
                    label="Datetime (AM / PM)"
                    name="datetime_12"
                    type="datetime"
                    timeMode="12"
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Preset Values -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Preset Values</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.date-time-field
                    label="Preset Date"
                    name="preset_date"
                    type="date"
                    value="2026-04-05"
                />

                <x-ui.date-time-field
                    label="Preset Time"
                    name="preset_time"
                    type="time"
                    value="20:30"
                    timeMode="12"
                />

                <x-ui.date-time-field
                    label="Preset Datetime"
                    name="preset_datetime"
                    type="datetime"
                    value="2026-04-05T20:30"
                    timeMode="12"
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.date-time-field
                    label="Preset Date"
                    name="preset_date"
                    type="date"
                    value="2026-04-05"
                    /&gt;

                    &lt;x-ui.date-time-field
                    label="Preset Time"
                    name="preset_time"
                    type="time"
                    value="20:30"
                    timeMode="12"
                    /&gt;

                    &lt;x-ui.date-time-field
                    label="Preset Datetime"
                    name="preset_datetime"
                    type="datetime"
                    value="2026-04-05T20:30"
                    timeMode="12"
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <!-- Full Example -->
        <x-ui.card>
            <h3 class="mb-4 font-medium">Full Example</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <x-ui.date-time-field
                    label="Event Schedule"
                    name="event_schedule"
                    type="datetime"
                    size="lg"
                    variant="default"
                    shadow="md"
                    timeMode="12"
                    :timeStep="15"
                    description="Choose the date and time for the event."
                    hint="Uses a single combined datetime control."
                />

                <x-ui.date-time-field
                    label="Published Time"
                    name="published_time"
                    type="time"
                    size="lg"
                    variant="filled"
                    shadow="lg"
                    timeMode="24"
                    :timeStep="30"
                    description="Choose a time using the dropdown list."
                    hint="This example uses the filled variant."
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.date-time-field
                    label="Event Schedule"
                    name="event_schedule"
                    type="datetime"
                    size="lg"
                    variant="default"
                    shadow="md"
                    timeMode="12"
                    :timeStep="15"
                    description="Choose the date and time for the event."
                    hint="Uses a single combined datetime control."
                    /&gt;

                    &lt;x-ui.date-time-field
                    label="Published Time"
                    name="published_time"
                    type="time"
                    size="lg"
                    variant="filled"
                    shadow="lg"
                    timeMode="24"
                    :timeStep="30"
                    description="Choose a time using the dropdown list."
                    hint="This example uses the filled variant."
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

    </section>
</x-layouts.preview>
