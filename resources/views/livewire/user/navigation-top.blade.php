<nav x-data="{ open: false }" class="my-1 border-b border-gray-100 rounded-md bg-sky-100">

<div class="flex justify-between pt-1 pb-1">
    <div class="items-center ml-2 sm:hidden">

        <x-jet-dropdown align="left" href="{{ route('user.dashboard') }}" :active="request()->routeIs('user.dashboard')" >
            <x-slot name="trigger">
                <i class="mt-1 text-2xl transition duration-150 fa-solid fa-bars text-sky-900 opacity-90 group-hover:opacity-100 ease"></i>
            </x-slot>

            <x-slot name="content">

                <!-- sonstiges -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Menu') }}
                </div>
                <x-jet-dropdown-link href="{{ route('guest.home') }}">
                    {{ __('Startseite') }}
                </x-jet-dropdown-link>
                <x-jet-dropdown-link href="{{ route('user.verbrauchsinfos') }}">
                    {{ __('Liste der Nutzeinheiten') }}
                </x-jet-dropdown-link>
                <x-jet-dropdown-link href="{{ route('user.realestates') }}">
                    {{ __('Liegenschaftsliste') }}
                </x-jet-dropdown-link>

            </x-slot>
        </x-jet-dropdown>

</div>

<div class="items-center pr-2 sm:hidden">
    <!-- Settings Dropdown -->
  <div class="relative pr-5 ml-3">
      <x-jet-dropdown align="right" width="48">
          <x-slot name="trigger">
              <span class="inline-flex rounded-md">
                  <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition border border-transparent rounded-md bg-sky-50 hover:text-gray-700 focus:outline-none">
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
</div>

    <div class="hidden max-w-full px-4 mx-auto md:visible md:flex md:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Navigation Links -->
            <div class="flex">
                <a href="{{ route('guest.home')}}" :active="request()->routeIs('login')">
                    <x-jet-application-mark class="block w-auto h-9" />
                </a>
                <div class="hidden md:visible md:flex md:items-center md:ml-6 sm:enabled">
                    <div class="flex justify-end space-x-8 md:-my-px md:ml-10 md:flex">
                        <x-button.navigation href="{{ route('guest.home') }}" :active="request()->routeIs('login')">
                            {{ __('Startseite') }}
                        </x-button.navigation>
                    </div>
                </div>
                @if (Auth::user()->isUser)

            @endif
                @if (Auth::user()->isMieter)
                    <div class="hidden md:visible md:flex md:items-center md:ml-6">
                        <!-- Nutzeeinheiten -->
                        <div class="flex justify-end space-x-8 md:-my-px md:ml-10 md:flex">
                        <x-jet-nav-link href="{{ route('user.verbrauchsinfos') }}" :active="request()->routeIs('login')">
                            {{ __('Liste der Nutzeinheiten') }}
                        </x-jet-nav-link>
                    </div>
                    <div class="md:flex md:items-center md:ml-6">
                        <!-- Kontakt -->
                        <div class="flex justify-end space-x-8 md:-my-px md:ml-10 md:flex">
                        <x-jet-nav-link href="{{ route('user.realestates') }}" :active="request()->routeIs('login')">
                            {{ __('Liegenschaftsliste') }}
                        </x-jet-nav-link>
                    </div>
                    </div>
                @endif

            </div>
        </div>
        <div class="flex items-center">
                  <!-- Settings Dropdown -->
                <div  class="mx-8">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition border border-transparent rounded-md ml-80 bg-sky-50 hover:text-gray-700 focus:outline-none">
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



        </div>


        </div>
    </div>

</nav>
