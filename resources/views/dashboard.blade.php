<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative flex-1 overflow-visible rounded-xl">
            <x-placeholder-pattern class="absolute inset-0 size-full" />
                    <flux:heading size="xl" level="1">Good afternoon, {{ Auth::user()->name }}</flux:heading>
                        <flux:text class="mt-2 mb-6 text-base">Here's what's new today</flux:text>
                        <flux:callout icon="sparkles" color="purple" class="mt-4">
                            <flux:callout.heading>Have a question?</flux:callout.heading>
                            <flux:callout.text>
                                Try our new AI assistant, Jeffrey. Let him handle tasks and answer questions for you.
                                <flux:callout.link href="#">Learn more</flux:callout.link>
                            </flux:callout.text>
                        </flux:callout>
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
