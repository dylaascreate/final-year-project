<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
         @fluxAppearance
    </head>

   <body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <a href="{{ route('home') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                <x-app-logo />
            </a>
        <flux:spacer />
        <flux:button icon="magnifying-glass">Find Career</flux:button>
        <flux:navbar class="-mb-px max-lg:hidden">
          @if (Route::has('login'))
            @auth
            <flux:dropdown position="top" align="start">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                />
                <flux:menu>
                    <flux:menu.item icon="user" href="{{ route('settings.profile') }}">
                        {{ __('Profile') }}
                    </flux:menu.item>
                    <flux:menu.item icon="layout-grid" href="{{ route('dashboard') }}">
                        {{ __('Dashboard') }}
                    </flux:menu.item>
                    <flux:menu.separator />
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
            @else
              <flux:tooltip content="Login">
                  <flux:navbar.item  icon="arrow-right-end-on-rectangle" href="{{ route('login') }}"/>
              </flux:tooltip>
            @endauth
          @endif
        </flux:navbar>
    </flux:header>
   
    {{-- <flux:main container>
        <flux:heading size="xl" level="1">Good afternoon, Olivia</flux:heading>
        <flux:text class="mt-2 mb-6 text-base">Here's what's new today</flux:text>
        <flux:separator variant="subtle" />
    </flux:main> --}}

    {{ $slot }}

    @fluxScripts
    </body>
</html>