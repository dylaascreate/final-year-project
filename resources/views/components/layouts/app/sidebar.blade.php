<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        @php
            $user = auth()->user();
            // $dashboardRoute = $user->role === 'admin' ? 'admin.dashboard' : 'views.dashboard';
        @endphp
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('home') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Menu')" class="grid">
                    <flux:navlist.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="rocket-launch">
                        {{ __('View Roadmaps') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="bolt" >
                        {{ __('Browse Skills') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="rectangle-stack" >
                        {{ __('Browse Projects') }}
                    </flux:navlist.item>
                    {{-- 3 page ni semua sama je dgn admin side, 
                    ada condition based on id dan limitation based on access.
                    so just use the same page --}}
                </flux:navlist.group>

                @if($user->role === 'admin')
                    @if(in_array($user->position, ['superadmin']))
                        <flux:navlist.group expandable  :expanded="false"  heading="Admin Tools" class="grid">
                            <flux:navlist.item icon="inbox-stack">
                                {{ __('Manage Roadmaps') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="squares-plus">
                                {{ __('Manage Skills') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="list-bullet">
                                {{ __('Manage Projects') }}
                            </flux:navlist.item>

                            <flux:navlist.item icon="user-plus"
                                {{-- badge="{{ \App\Models\User::where('role', 'user')->count() }}" --}}
                                {{-- :href="route('manage-customer')" --}}
                                {{-- :current="request()->routeIs('manage-customer')" --}}
                                wire:navigate>
                                {{ __('Manage Users') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="building-office-2"
                                {{-- badge="{{ \App\Models\User::where('role', 'admin')->count() }}" --}}
                                {{-- :href="route('manage-staff')"
                                :current="request()->routeIs('manage-staff')" --}}
                                wire:navigate>
                                {{ __('Manage Admins') }}
                            </flux:navlist.item>
                        </flux:navlist.group>
                        <flux:navlist.group expandable  :expanded="false" heading="Website Management" class="grid">
                            <flux:navlist.item icon="home-modern">
                                {{ __('Manage Homepage') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="information-circle">
                                {{ __('Manage About') }}
                            </flux:navlist.item>
                        </flux:navlist.group>
                        <flux:navlist.group expandable :expanded="false" heading="Features Magic" class="grid">
                            <flux:navlist.item icon="briefcase">
                                {{ __('Manage Career') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="star">
                                {{ __('Manage MBTI') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="book-open">
                                {{ __('Manage Course') }}
                            </flux:navlist.item>
                        </flux:navlist.group>
                    @endif
                    @if(in_array($user->position, ['supervisor']))
                        <flux:navlist.group expandable :expanded="false" heading="Supervisor Tools" class="grid">
                            <flux:navlist.item icon="users">
                                {{ __('View Assigned Students') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="check-badge">
                                {{ __('Upvoted Project') }}
                            </flux:navlist.item>
                        </flux:navlist.group>
                    @endif

                    @if(in_array($user->position, ['advisor']))
                        <flux:navlist.group expandable :expanded="false" heading="Advisor Tools" class="grid">
                            <flux:navlist.item icon="academic-cap">
                                {{ __('View Student Progress') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="chart-bar">
                                {{ __('Generate Reports') }}
                            </flux:navlist.item>
                        </flux:navlist.group>
                    @endif

                    @if(in_array($user->position, ['company']))
                        <flux:navlist.group expandable :expanded="false" heading="Company Tools" class="grid">
                            <flux:navlist.item icon="briefcase">
                                {{ __('View Active Projects') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="globe-alt">
                                {{ __('Manage Partnerships') }}
                            </flux:navlist.item>
                        </flux:navlist.group>
                    @endif

                @endif
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="chat-bubble-left-right" href="" target="_blank">
                {{ __('WhatsApp Us') }}
                </flux:navlist.item>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
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
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
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
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
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
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
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

        {{ $slot }}

        @fluxScripts
    </body>
</html>
