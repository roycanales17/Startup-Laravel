@props([
    'label' => null,
    'name' => null,
    'id' => null,

    /**
     * date | time | datetime
     */
    'type' => 'date',

    'variant' => 'default',
    'size' => 'md',
    'shadow' => 'sm', // none | sm | md | lg | xl

    'hint' => null,
    'error' => null,
    'success' => null,

    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'description' => null,

    /**
     * Time controls
     * 24 | 12
     */
    'timeMode' => '24',

    /**
     * Time picker controls
     */
    'timeStep' => 30,
    'placeholder' => null,

    /**
     * Optional default value
     */
    'value' => null,
])

@php
    $inputId = $id ?? $name ?? 'datetime_' . uniqid();

    $hasError = filled($error);
    $hasSuccess = filled($success) && ! $hasError;

    $sizeClasses = match ($size) {
        'xs' => 'min-h-8 text-xs rounded-lg',
        'sm' => 'min-h-9 text-sm rounded-lg',
        'lg' => 'min-h-11 text-base rounded-2xl',
        'xl' => 'min-h-12 text-lg rounded-2xl',
        default => 'min-h-10 text-sm rounded-xl',
    };

    $shadowClasses = match ($shadow) {
        'none' => 'shadow-none',
        'sm' => 'shadow-sm',
        'md' => 'shadow',
        'lg' => 'shadow-lg',
        'xl' => 'shadow-xl',
        default => 'shadow-sm',
    };

    $paddingClasses = match ($size) {
        'xs' => 'px-2.5 py-1.5',
        'sm' => 'px-3 py-2',
        'lg' => 'px-4 py-2.5',
        'xl' => 'px-4 py-3',
        default => 'px-3 py-2',
    };

    $variantClasses = match ($variant) {
        'filled' => 'bg-muted/60 border-transparent focus-within:bg-background',
        'ghost' => 'bg-transparent border-transparent shadow-none',
        default => 'bg-background border-border',
    };

    $stateClasses = $hasError
        ? 'border-red-500/70 focus-within:border-red-500 focus-within:ring-red-500/20'
        : ($hasSuccess
            ? 'border-emerald-500/70 focus-within:border-emerald-500 focus-within:ring-emerald-500/20'
            : 'focus-within:border-primary focus-within:ring-primary/20');

    $wrapperClasses = implode(' ', [
        'relative w-full border transition-all duration-200',
        $shadowClasses,
        'hover:border-foreground/20',
        'focus-within:ring-4 focus-within:shadow-md',
        'disabled:cursor-not-allowed disabled:opacity-60',
        $sizeClasses,
        $paddingClasses,
        $variantClasses,
        $stateClasses,
    ]);

    $nativeInputClasses = 'w-full bg-transparent outline-none placeholder:text-muted-foreground disabled:cursor-not-allowed disabled:opacity-60 readonly:cursor-default';
    $triggerDisplayClasses = 'flex-1 bg-transparent text-left';
    $panelInputClasses = 'w-full rounded-xl border border-border bg-background px-3 py-2 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20';

    $resolvedPlaceholder = $placeholder ?: match ($type) {
        'time' => 'Select time',
        'datetime' => 'Select date and time',
        default => 'Select date',
    };
@endphp

<div
    class="w-full space-y-2"
    x-data="dateTimeField({
        type: @js($type),
        timeMode: @js($timeMode),
        timeStep: @js($timeStep),
        value: @js($value),
        disabled: @js($disabled),
        readonly: @js($readonly),
        placeholder: @js($resolvedPlaceholder),
    })"
>
    @if($label)
        <div class="space-y-1">
            <label
                @if($type === 'date') for="{{ $inputId }}" @endif
            class="inline-flex items-center gap-1 text-sm font-medium text-foreground"
            >
                <span>{{ $label }}</span>
                @if($required)
                    <span class="text-red-500">*</span>
                @endif
            </label>

            @if($description)
                <p class="text-xs text-muted-foreground">
                    {{ $description }}
                </p>
            @endif
        </div>
    @endif

    @if($type === 'date')
        <div class="{{ $wrapperClasses }}">
            <div class="flex items-center gap-3">
                <x-lucide-calendar class="h-4 w-4 shrink-0 text-muted-foreground" />

                <input
                    id="{{ $inputId }}"
                    type="date"
                    @if($name) name="{{ $name }}" @endif
                    @if($required) required @endif
                    @if($disabled) disabled @endif
                    @if($readonly) readonly @endif
                    x-model="singleDate"
                    class="{{ $nativeInputClasses }}"
                />
            </div>
        </div>
    @elseif($type === 'time')
        <div class="relative" @click.outside="closeAll()">
            <div
                class="{{ $wrapperClasses }} cursor-pointer"
                @click.stop="toggleSingleTime()"
            >
                <div class="flex w-full items-center gap-3 text-left">
                    <x-lucide-clock-3 class="h-4 w-4 shrink-0 text-muted-foreground" />

                    <div class="{{ $triggerDisplayClasses }}">
                        <span
                            x-text="singleTimeDisplay || placeholder"
                            :class="singleTimeDisplay ? 'text-foreground' : 'text-muted-foreground'"
                        ></span>
                    </div>

                    <x-lucide-chevron-down
                        class="h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-200"
                        ::class="singleTimeOpen ? 'rotate-180' : ''"
                    />
                </div>

                <input
                    type="hidden"
                    @if($name) name="{{ $name }}" @endif
                    :value="singleTime"
                />
            </div>

            <div
                x-show="singleTimeOpen"
                x-transition.origin.top.left
                @click.stop
                class="absolute z-30 mt-2 max-h-64 w-full overflow-y-auto rounded-2xl border border-border bg-background p-2 shadow-xl"
                style="display: none;"
            >
                <div class="space-y-1">
                    <template x-for="option in timeOptions" :key="option.value">
                        <button
                            type="button"
                            @click="selectSingleTime(option.value)"
                            class="flex w-full items-center justify-between rounded-xl px-3 py-2 text-left text-sm transition hover:bg-muted"
                            :class="singleTime === option.value ? 'bg-muted font-medium text-foreground' : 'text-foreground'"
                        >
                            <span x-text="option.label"></span>
                            <x-lucide-check class="h-4 w-4" x-show="singleTime === option.value"></x-lucide-check>
                        </button>
                    </template>
                </div>
            </div>
        </div>
    @elseif($type === 'datetime')
        <div class="relative" @click.outside="closeAll()">
            <div
                class="{{ $wrapperClasses }} cursor-pointer"
                @click.stop="toggleDateTime()"
            >
                <div class="flex w-full items-center gap-3 text-left">
                    <x-lucide-calendar-clock class="h-4 w-4 shrink-0 text-muted-foreground" />

                    <div class="{{ $triggerDisplayClasses }}">
                        <span
                            x-text="singleDateTimeDisplay || placeholder"
                            :class="singleDateTimeDisplay ? 'text-foreground' : 'text-muted-foreground'"
                        ></span>
                    </div>

                    <x-lucide-chevron-down
                        class="h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-200"
                        ::class="dateTimeOpen ? 'rotate-180' : ''"
                    />
                </div>

                <input
                    type="hidden"
                    @if($name) name="{{ $name }}" @endif
                    :value="singleDateTimeValue"
                />
            </div>

            <div
                x-show="dateTimeOpen"
                x-transition.origin.top.left
                @click.stop
                class="absolute z-30 mt-2 w-full rounded-2xl border border-border bg-background p-3 shadow-xl"
                style="display: none;"
            >
                <div class="space-y-3">
                    <div>
                        <label class="mb-1 block text-xs font-medium uppercase tracking-wide text-muted-foreground">
                            Date
                        </label>
                        <input
                            type="date"
                            x-model="draftDate"
                            class="{{ $panelInputClasses }}"
                            @if($disabled) disabled @endif
                            @if($readonly) readonly @endif
                        />
                    </div>

                    <div>
                        <label class="mb-1 block text-xs font-medium uppercase tracking-wide text-muted-foreground">
                            Time
                        </label>

                        <div class="max-h-56 overflow-y-auto rounded-xl border border-border bg-background p-1">
                            <div class="space-y-1">
                                <template x-for="option in timeOptions" :key="'dt-' + option.value">
                                    <button
                                        type="button"
                                        @click="draftTime = option.value"
                                        class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-left text-sm transition hover:bg-muted"
                                        :class="draftTime === option.value ? 'bg-muted font-medium text-foreground' : 'text-foreground'"
                                    >
                                        <span x-text="option.label"></span>
                                        <x-lucide-check class="h-4 w-4" x-show="draftTime === option.value"></x-lucide-check>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-1">
                        <x-ui.button
                            type="button"
                            size="sm"
                            variant="ghost"
                            @click="cancelDateTime()"
                        >
                            Cancel
                        </x-ui.button>

                        <x-ui.button
                            type="button"
                            size="sm"
                            variant="primary"
                            @click="applyDateTime()"
                        >
                            Apply
                        </x-ui.button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($error)
        <p class="text-xs text-red-500">{{ $error }}</p>
    @elseif($success)
        <p class="text-xs text-emerald-600 dark:text-emerald-400">{{ $success }}</p>
    @elseif($hint)
        <p class="text-xs text-muted-foreground">{{ $hint }}</p>
    @endif
</div>

@once
    <script>
        function dateTimeField(config) {
            return {
                type: config.type ?? 'date',
                timeMode: config.timeMode ?? '24',
                timeStep: Number(config.timeStep ?? 30),
                disabled: !!config.disabled,
                readonly: !!config.readonly,
                placeholder: config.placeholder ?? 'Select value',

                singleTimeOpen: false,
                dateTimeOpen: false,

                singleDate: '',
                singleTime: '',

                singleDateTime: '',
                draftDate: '',
                draftTime: '',

                init() {
                    if (this.type === 'date') {
                        this.singleDate = config.value ?? '';
                        return;
                    }

                    if (this.type === 'time') {
                        this.singleTime = config.value ?? '';
                        return;
                    }

                    if (this.type === 'datetime') {
                        const parsed = this.parseDateTime(config.value ?? '');
                        this.singleDateTime = config.value ?? '';
                        this.draftDate = parsed.date;
                        this.draftTime = parsed.time;
                    }
                },

                get timeOptions() {
                    const options = [];
                    const step = this.timeStep > 0 ? this.timeStep : 30;

                    for (let minutes = 0; minutes < 24 * 60; minutes += step) {
                        const hour = Math.floor(minutes / 60);
                        const minute = minutes % 60;
                        const value = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;

                        options.push({
                            value,
                            label: this.formatTime(value),
                        });
                    }

                    return options;
                },

                get singleTimeDisplay() {
                    return this.singleTime ? this.formatTime(this.singleTime) : '';
                },

                get singleDateTimeValue() {
                    if (!this.draftDate || !this.draftTime) {
                        return this.singleDateTime || '';
                    }

                    return `${this.draftDate}T${this.draftTime}`;
                },

                get singleDateTimeDisplay() {
                    const value = this.singleDateTimeValue;
                    if (!value) return '';

                    const parsed = this.parseDateTime(value);
                    if (!parsed.date || !parsed.time) return '';

                    return `${this.formatDate(parsed.date)} ${this.formatTime(parsed.time)}`;
                },

                toggleSingleTime() {
                    if (this.disabled || this.readonly) return;
                    this.dateTimeOpen = false;
                    this.singleTimeOpen = !this.singleTimeOpen;
                },

                toggleDateTime() {
                    if (this.disabled || this.readonly) return;

                    this.singleTimeOpen = false;

                    const parsed = this.parseDateTime(this.singleDateTime || '');
                    this.draftDate = parsed.date;
                    this.draftTime = parsed.time;

                    this.dateTimeOpen = !this.dateTimeOpen;
                },

                closeAll() {
                    this.singleTimeOpen = false;
                    this.dateTimeOpen = false;
                },

                selectSingleTime(value) {
                    this.singleTime = value;
                    this.singleTimeOpen = false;
                },

                applyDateTime() {
                    if (!this.draftDate || !this.draftTime) return;
                    this.singleDateTime = `${this.draftDate}T${this.draftTime}`;
                    this.dateTimeOpen = false;
                },

                cancelDateTime() {
                    const parsed = this.parseDateTime(this.singleDateTime || '');
                    this.draftDate = parsed.date;
                    this.draftTime = parsed.time;
                    this.dateTimeOpen = false;
                },

                parseDateTime(value) {
                    if (!value || typeof value !== 'string') {
                        return { date: '', time: '' };
                    }

                    const [datePart = '', timePart = ''] = value.split('T');

                    return {
                        date: datePart || '',
                        time: timePart ? timePart.slice(0, 5) : '',
                    };
                },

                formatDate(value) {
                    if (!value) return '';

                    const [year, month, day] = value.split('-');
                    if (!year || !month || !day) return value;

                    return `${month}/${day}/${year}`;
                },

                formatTime(value) {
                    if (!value) return '';

                    const [rawHour = '0', rawMinute = '0'] = value.split(':');
                    const hour = Number(rawHour);
                    const minute = String(rawMinute).padStart(2, '0');

                    if (this.timeMode === '12') {
                        const suffix = hour >= 12 ? 'PM' : 'AM';
                        const displayHour = hour % 12 || 12;
                        return `${displayHour}:${minute} ${suffix}`;
                    }

                    return `${String(hour).padStart(2, '0')}:${minute}`;
                },
            }
        }
    </script>
@endonce
