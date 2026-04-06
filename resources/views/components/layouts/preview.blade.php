<x-layouts.app>
    <div
        x-data="{
            sidebarOpen: false
        }"
        class="min-h-screen bg-background text-foreground"
    >
        <div class="flex min-h-screen">

            <!-- Sidebar -->
            <aside
                class="fixed inset-y-0 left-0 z-40 w-72 border-r border-border bg-card/90 backdrop-blur transition-transform duration-300 lg:translate-x-0"
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            >
                <div class="flex h-full flex-col">

                    <!-- Header -->
                    <div class="flex items-center justify-between border-b border-border px-5 py-4">
                        <div>
                            <h1 class="text-lg font-semibold">UI System</h1>
                            <p class="text-sm text-muted-foreground">Laravel Starter</p>
                        </div>

                        <button
                            @click="sidebarOpen = false"
                            class="lg:hidden"
                        >
                            ✕
                        </button>
                    </div>

                    <!-- Nav -->
                    <div class="flex-1 overflow-y-auto p-4 space-y-6">
                        <div>
                            <p class="mb-2 text-xs uppercase text-muted-foreground">Components</p>

                            <nav class="space-y-1">
                                <a href="{{ route('ui.buttons') }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-muted">
                                    Buttons
                                </a>

                                <a href="{{ route('ui.inputs') }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-muted">
                                    Inputs
                                </a>

                                <a href="{{ route('ui.date-time') }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-muted">
                                    Date / Time Inputs
                                </a>

                                <a href="{{ route('ui.textarea') }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-muted">
                                    Textarea
                                </a>

                                <a href="{{ route('ui.select') }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-muted">
                                    Select
                                </a>

                                <a href="{{ route('ui.file-upload') }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-muted">
                                    File Upload
                                </a>

                                <a href="{{ route('ui.cards') }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-muted">
                                    Cards
                                </a>

                                <a href="#themes" class="block rounded-xl px-3 py-2 text-sm hover:bg-muted">
                                    Theme
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Overlay -->
            <div
                x-show="sidebarOpen"
                @click="sidebarOpen = false"
                class="fixed inset-0 z-30 bg-black/40 lg:hidden"
            ></div>

            <!-- Main -->
            <div class="flex-1 lg:pl-72">

                <!-- Topbar -->
                <header class="sticky top-0 z-20 border-b border-border bg-background">
                    <div class="flex items-center justify-between px-6 py-4">
                        <button
                            @click="sidebarOpen = true"
                            class="lg:hidden"
                        >
                            ☰
                        </button>

                        <h2 class="font-semibold">Component Preview</h2>

                        <div class="hidden gap-2 sm:flex">
                            <x-ui.button size="sm" variant="ghost" @click="theme = 'light'">Light</x-ui.button>
                            <x-ui.button size="sm" variant="ghost" @click="theme = 'dark'">Dark</x-ui.button>
                            <x-ui.button size="sm" variant="ghost" @click="theme = 'system'">System</x-ui.button>
                        </div>
                    </div>
                </header>

                <!-- Content -->
                <main class="space-y-8 p-6">
                    <!-- Sections -->
                    {{ $slot ?? '' }}
                </main>
            </div>
        </div>
    </div>
</x-layouts.app>
