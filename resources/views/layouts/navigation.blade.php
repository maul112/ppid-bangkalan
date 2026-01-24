<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <img src="https://ppid.bangkalankab.go.id/assets/img/logo-ppid.png" alt="Logo PPID" class="h-12 w-auto">
                        <div class="hidden md:block font-bold text-blue-900 leading-tight">
                            PPID <br> <span class="text-xs text-gray-500 font-normal">KABUPATEN BANGKALAN</span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="url('/')" :active="request()->is('/')">
                        {{ __('BERANDA') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/informasi-publik')" :active="request()->is('informasi-publik')">
                        {{ __('INFORMASI PUBLIK') }}
                    </x-nav-link>
                    <x-nav-link :href="url('/prosedur')" :active="request()->is('prosedur')">
                        {{ __('PROSEDUR') }}
                    </x-nav-link>

                    @auth
                        @if(Auth::user()->role === 'admin_ppid' || Auth::user()->role === 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-red-600 font-bold border-red-500">
                                {{ __('DASHBOARD ADMIN') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.permohonan.index')" :active="request()->routeIs('admin.permohonan.*')">
                                {{ __('DAFTAR PERMOHONAN') }}
                            </x-nav-link>
                        @elseif(Auth::user()->role === 'admin_opd')
                            <x-nav-link :href="route('opd.dashboard')" :active="request()->routeIs('opd.dashboard')" class="text-green-600 font-bold border-green-500">
                                {{ __('DASHBOARD OPD') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white 
                                {{ Auth::user()->role === 'admin_ppid' ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} 
                                focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }} ({{ str_replace('_', ' ', strtoupper(Auth::user()->role)) }})</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profil Saya') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Keluar') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline font-medium italic">Login Pengelola</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>