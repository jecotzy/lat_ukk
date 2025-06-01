<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gray-100 dark:bg-gray-900">
        {{-- Sidebar utama aplikasi dengan tema gelap --}}
        <flux:sidebar sticky stashable class="w-48 bg-gray-900 text-gray-100 border-e border-gray-800">

            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6">
                    <defs>
                        <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#06b6d4;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <path stroke="url(#grad1)" fill="none" stroke-linecap="round" stroke-linejoin="round" 
                          d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25
                             M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25
                             a9 9 0 0 0-9-9Z" />
                </svg>
                <span class="text-lg mt-1 font-bold" style="background: linear-gradient(90deg, #3b82f6, #06b6d4); 
                      -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; color: transparent;">
                    LaporPak
                </span>
            </div>

            {{-- Menu navigasi utama --}}
            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    <flux:navlist.item 
                        icon="home" 
                        :href="route('dashboard')" 
                        :current="request()->routeIs('dashboard')" 
                        wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            {{-- Bagian menu khusus untuk role Super_Admin --}}
            @hasrole('super_admin')
                <flux:navlist.item icon="user-circle" :href="route('siswa')" :current="request()->routeIs('siswa*')" wire:navigate>
                    {{ __('Siswa') }}
                </flux:navlist.item>

                <flux:navlist.item icon="academic-cap" :href="route('guru')" :current="request()->routeIs('guru*')" wire:navigate>
                    {{ __('Guru') }}
                </flux:navlist.item>

                <flux:navlist.item icon="building-office-2" :href="route('industri')" :current="request()->routeIs('industri*')" wire:navigate>
                    {{ __('Industri') }}
                </flux:navlist.item>

                <flux:navlist.item icon="briefcase" :href="route('pkl')" :current="request()->routeIs('pkl*')" wire:navigate>
                    {{ __('PKL') }}
                </flux:navlist.item>
            @endhasrole

            {{-- Bagian menu khusus untuk role Siswa --}}
            @hasrole('Siswa')
                <flux:navlist.item icon="building-office-2" :href="route('industri')" :current="request()->routeIs('industri*')" wire:navigate>
                    {{ __('Industri') }}
                </flux:navlist.item>

                <flux:navlist.item icon="briefcase" :href="route('pkl')" :current="request()->routeIs('pkl*')" wire:navigate>
                    {{ __('PKL') }}
                </flux:navlist.item>
            @endhasrole

            @hasrole('Guru')
                <flux:navlist.item icon="user-circle" :href="route('siswa')" :current="request()->routeIs('siswa*')" wire:navigate>
                    {{ __('Siswa') }}
                </flux:navlist.item>

                <flux:navlist.item icon="academic-cap" :href="route('guru')" :current="request()->routeIs('guru*')" wire:navigate>
                    {{ __('Guru') }}
                </flux:navlist.item>

                <flux:navlist.item icon="building-office-2" :href="route('industri')" :current="request()->routeIs('industri*')" wire:navigate>
                    {{ __('Industri') }}
                </flux:navlist.item>

                <flux:navlist.item icon="briefcase" :href="route('pkl')" :current="request()->routeIs('pkl*')" wire:navigate>
                    {{ __('PKL') }}
                </flux:navlist.item>
            @endhasrole


            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                    {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                    {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    {{-- Informasi profil user --}}
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
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
        </flux:sidebar>

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
                                    <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
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

        {{-- Konten utama halaman --}}
        {{ $slot }}

        @fluxScripts
    </body>
</html>
