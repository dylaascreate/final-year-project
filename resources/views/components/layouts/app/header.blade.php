<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        @php $user = auth()->user(); @endphp
    </head>

    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <a href="{{ route('home') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                <x-app-logo />
            </a>

            <!-- Main Navbar Links -->
            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>
                <flux:navbar.item icon="inbox">
                    {{ __('View Order History') }}
                </flux:navbar.item>
                <flux:navbar.item icon="cube">
                    {{ __('Browse Product') }}
                </flux:navbar.item>

                @if($user->role === 'admin')
                    <flux:dropdown align="start" position="bottom">
                        <flux:navbar.item icon="cog" class="cursor-pointer">
                            {{ __('Admin Panel') }}
                        </flux:navbar.item>

                        <flux:menu>
                            <flux:menu.item icon="inbox-stack">
                                {{ __('View All Orders') }}
                            </flux:menu.item>
                            <flux:menu.item icon="squares-plus">
                                {{ __('Manage Product') }}
                            </flux:menu.item>
                            <flux:menu.item icon="list-bullet">
                                {{ __('Manage Orders') }}
                            </flux:menu.item>

                            @if(in_array($user->position, ['SuperAdmin', 'Manager']))
                                <flux:menu.separator />
                                <flux:menu.item icon="user-plus">
                                    {{ __('Manage Customers') }}
                                </flux:menu.item>
                                <flux:menu.item icon="building-office-2">
                                    {{ __('Manage Staffs') }}
                                </flux:menu.item>
                            @endif
                        </flux:menu>
                    </flux:dropdown>
                @endif

            </flux:navbar>

            <flux:spacer />


            <!-- Desktop User Dropdown -->
            <flux:dropdown position="top" align="end">
                <flux:profile
                    class="cursor-pointer"
                    :initials="auth()->user()->initials()"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>
                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar stashable sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')">
                    <flux:navlist.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="inbox">
                        {{ __('View Order History') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="cube">
                        {{ __('Browse Product') }}
                    </flux:navlist.item>
                </flux:navlist.group>

                @if($user->role === 'admin')
                    <flux:navlist.group :heading="__('Admin Tools')">
                        <flux:navlist.item icon="inbox-stack">
                            {{ __('View All Orders') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="squares-plus">
                            {{ __('Manage Product') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="list-bullet">
                            {{ __('Manage Orders') }}
                        </flux:navlist.item>

                        @if(in_array($user->position, ['SuperAdmin', 'Manager']))
                            <flux:navlist.item icon="user-plus">
                                {{ __('Manage Customers') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="building-office-2">
                                {{ __('Manage Staffs') }}
                            </flux:navlist.item>
                        @endif
                    </flux:navlist.group>
                @endif
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                    {{ __('Repository') }}
                </flux:navlist.item>
                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                    {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>
        </flux:sidebar>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
