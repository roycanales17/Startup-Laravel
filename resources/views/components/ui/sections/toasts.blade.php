<x-layouts.preview>
    <section id="toasts" class="space-y-6">
        <div>
            <h2 class="text-xl font-semibold">Toasts / Notifications</h2>
            <p class="text-sm text-muted-foreground">
                Floating notification messages for lightweight status feedback such as success, warnings,
                errors, and informational updates.
            </p>
        </div>

        <x-ui.card
            title="Toast Playground"
            description="Click the buttons below to preview toast notifications."
        >
            <div
                x-data="{
                    toasts: [],
                    nextId: 1,
                    showToast(variant, title, description, duration = 4000) {
                        const id = this.nextId++;
                        this.toasts.push({ id, variant, title, description, duration });

                        setTimeout(() => {
                            this.removeToast(id);
                        }, duration);
                    },
                    removeToast(id) {
                        this.toasts = this.toasts.filter(toast => toast.id !== id);
                    },
                }"
                class="space-y-4"
            >
                <div class="flex flex-wrap gap-3">
                    <x-ui.button
                        type="button"
                        variant="secondary"
                        x-on:click="showToast('info', 'Information', 'This is a general informational notification.')"
                    >
                        Show Info Toast
                    </x-ui.button>

                    <x-ui.button
                        type="button"
                        variant="success"
                        x-on:click="showToast('success', 'Success', 'Your changes have been saved successfully.')"
                    >
                        Show Success Toast
                    </x-ui.button>

                    <x-ui.button
                        type="button"
                        variant="outline"
                        x-on:click="showToast('warning', 'Warning', 'Please review the details before continuing.')"
                    >
                        Show Warning Toast
                    </x-ui.button>

                    <x-ui.button
                        type="button"
                        variant="danger"
                        x-on:click="showToast('danger', 'Error', 'Something went wrong while saving your data.')"
                    >
                        Show Error Toast
                    </x-ui.button>
                </div>

                <div class="rounded-xl border border-dashed border-border p-4 text-sm text-muted-foreground">
                    Toasts will appear at the top-right corner of the screen.
                </div>

                <div class="pointer-events-none fixed right-4 top-4 z-[100] flex w-full max-w-sm flex-col gap-3">
                    <template x-for="toast in toasts" :key="toast.id">
                        <div
                            x-transition:enter="transform transition duration-300 ease-[cubic-bezier(0.22,1,0.36,1)]"
                            x-transition:enter-start="translate-y-3 opacity-0 scale-[0.96] sm:translate-y-0 sm:translate-x-4"
                            x-transition:enter-end="translate-y-0 opacity-100 scale-100 sm:translate-x-0"
                            x-transition:leave="transform transition duration-200 ease-in"
                            x-transition:leave-start="translate-y-0 opacity-100 scale-100"
                            x-transition:leave-end="translate-y-2 opacity-0 scale-[0.98] sm:translate-y-0 sm:translate-x-3"
                            class="pointer-events-auto relative w-full overflow-hidden rounded-2xl border bg-background/95 text-foreground shadow-lg backdrop-blur-sm"
                            :class="{
                                'border-sky-200 dark:border-sky-900/60': toast.variant === 'info',
                                'border-emerald-200 dark:border-emerald-900/60': toast.variant === 'success',
                                'border-amber-200 dark:border-amber-900/60': toast.variant === 'warning',
                                'border-rose-200 dark:border-rose-900/60': toast.variant === 'danger',
                            }"
                            role="status"
                        >
                            <div
                                class="absolute inset-x-0 top-0 h-1"
                                :class="{
                                    'bg-sky-500': toast.variant === 'info',
                                    'bg-emerald-500': toast.variant === 'success',
                                    'bg-amber-500': toast.variant === 'warning',
                                    'bg-rose-500': toast.variant === 'danger',
                                }"
                            ></div>

                            <div class="flex items-start gap-3 p-4">
                                <div class="mt-0.5 shrink-0">
                                    <template x-if="toast.variant === 'info'">
                                        <x-lucide-info class="h-5 w-5 text-sky-600 dark:text-sky-400" />
                                    </template>

                                    <template x-if="toast.variant === 'success'">
                                        <x-lucide-circle-check-big class="h-5 w-5 text-emerald-600 dark:text-emerald-400" />
                                    </template>

                                    <template x-if="toast.variant === 'warning'">
                                        <x-lucide-triangle-alert class="h-5 w-5 text-amber-600 dark:text-amber-400" />
                                    </template>

                                    <template x-if="toast.variant === 'danger'">
                                        <x-lucide-circle-alert class="h-5 w-5 text-rose-600 dark:text-rose-400" />
                                    </template>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="text-sm font-semibold leading-5" x-text="toast.title"></div>
                                    <div class="mt-1 text-sm leading-5 text-muted-foreground" x-text="toast.description"></div>
                                </div>

                                <button
                                    type="button"
                                    class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-muted-foreground transition hover:bg-black/5 hover:text-foreground dark:hover:bg-white/10"
                                    @click="removeToast(toast.id)"
                                    aria-label="Dismiss notification"
                                >
                                    <x-lucide-x class="h-4 w-4" />
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;div
                    x-data="{
                    toasts: [],
                    nextId: 1,
                    showToast(variant, title, description, duration = 4000) {
                    const id = this.nextId++;
                    this.toasts.push({ id, variant, title, description, duration });

                    setTimeout(() =&gt; {
                    this.removeToast(id);
                    }, duration);
                    },
                    removeToast(id) {
                    this.toasts = this.toasts.filter(toast =&gt; toast.id !== id);
                    },
                    }"
                    &gt;
                    &lt;x-ui.button
                    type="button"
                    x-on:click="showToast('success', 'Success', 'Saved successfully.')"
                    &gt;
                    Show Toast
                    &lt;/x-ui.button&gt;

                    &lt;template x-for="toast in toasts" :key="toast.id"&gt;
                    &lt;!-- toast item --&gt;
                    &lt;/template&gt;
                    &lt;/div&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <x-ui.card title="Static Examples" description="Direct examples of each toast variant.">
            <div class="space-y-4">
                <x-ui.toast
                    variant="info"
                    title="Information"
                    description="This is a general informational notification."
                    :duration="999999"
                />

                <x-ui.toast
                    variant="success"
                    title="Success"
                    description="Your profile has been updated successfully."
                    :duration="999999"
                />

                <x-ui.toast
                    variant="warning"
                    title="Warning"
                    description="Your session will expire soon."
                    :duration="999999"
                />

                <x-ui.toast
                    variant="danger"
                    title="Error"
                    description="Unable to complete the requested action."
                    :duration="999999"
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.toast
                    variant="success"
                    title="Success"
                    description="Your profile has been updated successfully."
                    /&gt;

                    &lt;x-ui.toast
                    variant="danger"
                    title="Error"
                    description="Unable to complete the requested action."
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <x-ui.card title="Slot Content" description="Use the slot if you want fully custom toast content.">
            <div class="space-y-4">
                <x-ui.toast
                    variant="warning"
                    title="Storage almost full"
                    :duration="999999"
                >
                    You are close to your storage limit. Please remove unused files or upgrade your plan.
                </x-ui.toast>
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.toast
                    variant="warning"
                    title="Storage almost full"
                    &gt;
                    You are close to your storage limit. Please remove unused files or upgrade your plan.
                    &lt;/x-ui.toast&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>

        <x-ui.card title="Custom Duration" description="Control how long the toast stays visible using the duration prop in milliseconds.">
            <div class="space-y-4">
                <x-ui.toast
                    variant="info"
                    title="Short Toast"
                    description="This toast will auto-dismiss quickly."
                    :duration="2000"
                />

                <x-ui.toast
                    variant="success"
                    title="Longer Toast"
                    description="This toast stays visible longer."
                    :duration="6000"
                />
            </div>

            <div class="mt-4">
                <x-ui.code-preview language="markup">
                    &lt;x-ui.toast
                    variant="info"
                    title="Short Toast"
                    description="This toast will auto-dismiss quickly."
                    :duration="2000"
                    /&gt;

                    &lt;x-ui.toast
                    variant="success"
                    title="Longer Toast"
                    description="This toast stays visible longer."
                    :duration="6000"
                    /&gt;
                </x-ui.code-preview>
            </div>
        </x-ui.card>
    </section>
</x-layouts.preview>
