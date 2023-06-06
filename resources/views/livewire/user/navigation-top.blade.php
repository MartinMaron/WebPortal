<nav x-data="{ open: false }" class="bg-sky-100 my-1.5border-b border-gray-100 rounded-md">


    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Navigation Links -->
            <div class="flex">
                <a href="{{ route('guest.home') }}" :active="request()->routeIs('login')">
                    <x-jet-application-mark class="block h-9 w-auto" />
                </a>
                <div class="hidden md:visible md:flex md:items-center md:ml-6">
                    <div class="flex justify-end space-x-8 md:-my-px md:ml-10 md:flex">
                        <x-button.navigation href="{{ route('guest.home') }}" :active="request()->routeIs('login')">
                            {{ __('Startseite') }}
                        </x-button.navigation>
                    </div>
                </div>

                <div class="hidden md:visible md:flex md:items-center md:ml-6">
                    <!-- Kontakt -->
                    <div class="flex justify-end space-x-8 md:-my-px md:ml-10 md:flex">
                       <x-button.navigation href="{{ route('guest.home') }}" :active="request()->routeIs('login')">
                           {{ __('Startseite') }}
                       </x-jet-nav-link>
                   </div>
               </div>


                @if (Auth::user()->isMieter)
                    <div class="hidden md:visible md:flex md:items-center md:ml-6">
                        <!-- Nutzeeinheiten -->
                        <div class="flex justify-end space-x-8 md:-my-px md:ml-10 md:flex">
                        <x-jet-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                            {{ __('Liste der Nutzeinheiten') }}
                        </x-jet-nav-link>
                    </div>
                @endif
                @if (Auth::user()->isUser)
                    <div class="md:flex md:items-center md:ml-6">
                        <!-- Kontakt -->
                        <div class="flex justify-end space-x-8 md:-my-px md:ml-10 md:flex">
                        <x-jet-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                            {{ __('Liegenschaftsliste') }}
                        </x-jet-nav-link>
                    </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex items-center ml-6">
                  <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-sky-50 hover:text-gray-700 focus:outline-none transition">
                                    {{ Auth::user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Kontodaten bearbeiten') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Kundenkonto') }}
                            </x-jet-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <!-- Logout -->
                            <div class="hidden md:block">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                             onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Ausloggen') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </div>
                            <div class="md:hidden">
                                <form method="POST" action="{{ route('logoutin') }}">
                                    @csrf
                                    <x-jet-dropdown-link href="{{ route('logoutin') }}"
                                             onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Ausloggen') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </div>

                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            {{-- <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div> --}}
        </div>


        </div>
    </div>



</nav>
