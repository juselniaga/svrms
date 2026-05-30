<div class="flex h-screen bg-surface overflow-hidden" x-data="{ sidebarOpen: false }">

    <!-- Mobile sidebar backdrop -->
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-gray-900/50 lg:hidden" @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-primary text-white transition-transform duration-300 lg:static lg:translate-x-0">
        <div class="flex items-center justify-center h-16 bg-primary-light">
            <span class="text-white font-display font-bold text-xl tracking-wider">SVRMS</span>
        </div>

        <nav class="mt-5 px-2 space-y-1">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-primary-light text-white' : 'text-gray-300 hover:bg-primary-light hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg class="mr-3 h-6 w-6 flex-shrink-0 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Dashboard
            </a>

            <!-- Role-Based Navigation Links -->
            @auth
                @if(auth()->user()->role === \App\Enums\UserRole::Admin)
                    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'bg-primary-light text-white' : 'text-gray-300 hover:bg-primary-light hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="mr-3 h-6 w-6 flex-shrink-0 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 001.591-.079 8.88 8.88 0 01-.894 2.905.349.349 0 00.62.254 9.003 9.003 0 001.921-4.148.983.983 0 00-.923-1.417A9.868 9.868 0 0015 19.128m0 0a9.332 9.332 0 01-2.625-.372m0 0a9.344 9.344 0 01-2.821-.375M15 19.128l.75.749A9.168 9.168 0 0918 19.875M15 19.128l-.75.749A9.168 9.168 0 0112 19.875m0 0a8.997 8.997 0 01-2.625-.372m0 0a9.332 9.332 0 01-2.821-.375M9 19.128m0 0l.75.749M9 19.128l-.75.749m0 0A9.168 9.168 0 016 19.875m3 0l3 .75m-6-.75l-3-.75M9 3h3.75M9 3v3.75M3 9h3.75M3 9V5.25M3 3h3.75M9 3h6m0 0h3.75M15 3v3.75M15 3h3.75M3 9h12" />
                        </svg>
                        Staff Management
                    </a>

                    <a href="{{ route('admin.mukims.index') }}" class="{{ request()->routeIs('admin.mukims.*') ? 'bg-primary-light text-white' : 'text-gray-300 hover:bg-primary-light hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="mr-3 h-6 w-6 flex-shrink-0 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 5.218A4.504 4.504 0 0019.5 21h-15a4.5 4.5 0 014.747-5.498M21 12a9 9 0 11-18 0 9 9 0 0118 0Z" />
                        </svg>
                        Mukim Management
                    </a>

                    <a href="{{ route('admin.bps.index') }}" class="{{ request()->routeIs('admin.bps.*') ? 'bg-primary-light text-white' : 'text-gray-300 hover:bg-primary-light hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="mr-3 h-6 w-6 flex-shrink-0 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h-3m0 0h-.375m.375 0H9m3-3h3m-6 0h.375m-.375 0H9m6-2.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9 9.75a.75.75 0 11-1.5 0A.75.75 0 019 9.75zM9 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        Block Perancang
                    </a>

                    <a href="{{ route('admin.bpks.index') }}" class="{{ request()->routeIs('admin.bpks.*') ? 'bg-primary-light text-white' : 'text-gray-300 hover:bg-primary-light hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="mr-3 h-6 w-6 flex-shrink-0 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m6 0a9 9 0 11-18 0 9 9 0 0118 0Z" />
                        </svg>
                        Block Perancang Kecil
                    </a>
                @endif
            @endauth

        </nav>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex flex-1 flex-col overflow-hidden">
        
        <!-- Top Navigation -->
        <header class="flex h-16 items-center justify-between border-b border-gray-200 bg-white px-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                @isset($header)
                    <h1 class="ml-4 text-2xl font-semibold text-gray-900 font-display sm:ml-0">{{ $header }}</h1>
                @endisset
            </div>

            <div class="flex items-center space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                            @auth
                                <div class="mr-2 hidden sm:block">{{ Auth::user()->name }}</div>
                            @endauth
                            <div class="h-8 w-8 rounded-full bg-primary-light flex items-center justify-center text-white font-bold ring-2 ring-white">
                                @auth
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                @else
                                    G
                                @endauth
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </header>

        <!-- Main Output -->
        <main class="flex-1 overflow-y-auto bg-surface p-4 sm:p-6 lg:p-8">
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-50 p-4 border border-green-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-md bg-red-50 p-4 border border-red-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>
</div>
