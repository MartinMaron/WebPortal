


<nav class="bg-sky-100 shadow-md border-sky-300 rounded-md">
    <div class="hidden sm:flex justify-between">
        <a class="ml-4 m-1" href="{{ route('guest.home') }}" :active="request()->routeIs('login')">
            <x-jet-application-mark class="block h-9 w-auto" />
        </a>
        <!-- Primary Navigation Menu -->
        <div class=" sm:flex sm:flex-wrap items-center justify-start w-full max-w-7xl my-1">
               <!-- Navigation Links -->
               <!-- Dienstleistungen -->
            <x-jet-dropdown align="left" :active="request()->routeIs('user.dashboard')" >
                <x-slot name="trigger">
                        <x-button.navigation class="flex" >
                            <span class = "text-md font-semibold text-sky-900 opacity-90 group-hover:opacity-100 transition duration-150 ease">
                                {{ __('DIENSTLEISTUNGEN') }}
                            </span>
                            <i class="text-md ml-2 mt-1 fa fa-chevron-down"></i>
                        </x-button.navigation>
                </x-slot>
                <x-slot name="content">
                    <x-jet-dropdown-link href="{{ route('guest.heizkostenabrechnung') }}">
                    {{ __('Heizkosten') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('guest.betriebskostenabrechnung') }}">
                    {{ __('Betriebskosten') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('guest.energieausweis') }}">
                    {{ __('Energieausweis') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('guest.rauchmelderservice') }}">
                    {{ __('Rauchmelderservice') }}
                    </x-jet-dropdown-link>
                </x-slot>
            </x-jet-dropdown>
             <!-- Geräteservice -->
            <x-jet-dropdown align="left" href="{{ route('user.dashboard') }}" :active="request()->routeIs('user.dashboard')" >
                <x-slot name="trigger">
                    <x-button.navigation class="flex">
                        <span class = "text-md font-semibold text-sky-900 opacity-90 group-hover:opacity-100 transition duration-150 ease">
                            {{ __('GERÄTESERVICE') }}
                        </span>
                        <i class="text-md ml-2 mt-1 fa fa-chevron-down"></i>
                    </x-button.navigation>
                </x-slot>

                <x-slot name="content">
                    <x-jet-dropdown-link href="{{ route('guest.heizkostenverteiler') }}">
                        {{ __('Heizkostenverteiler') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('guest.waermezaehler') }}">
                        {{ __('Wäremzähler') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('guest.wasserzaehler') }}">
                        {{ __('Wasserzähler') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('guest.rauchmelder') }}">
                        {{ __('Rauchmelder') }}
                    </x-jet-dropdown-link>
                </x-slot>
            </x-jet-dropdown>
            <x-button.navigation class="flex" :active="request()->routeIs('guest.messdienstwechsel')">
                <a href="{{route('guest.messdienstwechsel')}}">
                    <span class = "text-md font-semibold text-sky-900 opacity-90 group-hover:opacity-100 transition duration-150 ease">
                        {{ __('MESSDIENSTWECHSEL') }}
                    </span>
                </a>
            </x-button.navigation>
            <x-button.navigation class="flex" :active="request()->routeIs('guest.kontakt')">
                <a href="{{route('guest.kontakt')}}">
                    <span class = "text-md font-semibold text-sky-900 opacity-90 group-hover:opacity-100 transition duration-150 ease">
                        {{ __('KONTAKT') }}
                    </span>
                </a>
            </x-button.navigation>
        </div>
        <div class=" sm:flex sm:flex-wrap items-center justify-end px-3 max-w-7xl my-1">
            <x-button.navigation>
                <a href="{{route('login')}}">
                    <span class = "text-md font-semibold text-sky-900 opacity-90 group-hover:opacity-100 transition duration-150 ease">
                        {{ __('NUTZERBEREICH') }}
                    </span>
                </a>
            </x-button.navigation>
        </div>
    </div>
    @if(Route::current()->getName() != 'login')
        <div class="sm:hidden flex justify-between items-center">
            <!-- Navigation -->
             <!-- Geräteservice -->
             <x-jet-dropdown align="left" href="{{ route('user.dashboard') }}" :active="request()->routeIs('user.dashboard')" >
                <x-slot name="trigger">
                    <i class="text-2xl ml-2 mt-1 fa-solid fa-bars text-sky-900 opacity-90 group-hover:opacity-100 transition duration-150 ease"></i>
                </x-slot>

                <x-slot name="content">
                    <!-- Dienstleistungen -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Diensleistungen') }}
                    </div>
                    <x-jet-dropdown-link href="{{ route('guest.heizkostenabrechnung') }}">
                    {{ __('Heizkosten') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('guest.betriebskostenabrechnung') }}">
                    {{ __('Betriebskosten') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('guest.energieausweis') }}">
                    {{ __('Energieausweis') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('guest.rauchmelderservice') }}">
                    {{ __('Rauchmelderservice') }}
                    </x-jet-dropdown-link>

                    <!-- Geräteservice -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Geräteservice') }}
                    </div>
                    <x-jet-dropdown-link href="{{ route('guest.heizkostenverteiler') }}">
                        {{ __('Heizkostenverteiler') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('guest.waermezaehler') }}">
                        {{ __('Wäremzähler') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('guest.wasserzaehler') }}">
                        {{ __('Wasserzähler') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('guest.rauchmelder') }}">
                        {{ __('Rauchmelder') }}
                    </x-jet-dropdown-link>

                    <!-- sonstiges -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('...') }}
                    </div>
                    <x-jet-dropdown-link href="{{ route('guest.heizkostenverteiler') }}">
                        {{ __('Messdienstwechsel') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('guest.waermezaehler') }}">
                        {{ __('Kontakt') }}
                    </x-jet-dropdown-link>

                </x-slot>
            </x-jet-dropdown>

            {{-- <!-- Login -->
            <a class="text-md text-right font-semibold text-sky-900 opacity-90" href="{{ route('login') }}" :active="request()->routeIs('login')">
                {{ __('LogIn -> Nutzerbereich') }}
            </a> --}}

            <x-button.navigation class="flex">
                <a href="{{route('login')}}">
                    <span class = "text-md font-semibold text-sky-900 opacity-90 group-hover:opacity-100 transition duration-150 ease">
                        {{ __('Nutzerbereich') }}
                    </span>
                </a>
            </x-button.navigation>


        </div>
    @endif

</nav>

