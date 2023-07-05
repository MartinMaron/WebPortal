<div
      class="h-8 w-10 items-center mx-auto rounded-lg md:flex-1 bg-sky-100 border-sky-100"
      x-data="{ 'isHamburgerOpen': false }"
      @keydown.escape="isHamburgerOpen = false"
>

    <div class="text-right" x-data="{ 'isHamburgerOpen': false }">
        <button
          type="button"
          title="Open the actions menu"
          class="px-2 font-mono text-2xl"
          @click="isHamburgerOpen = true"
          :class="{ 'rounded-lg cursor-pointer border-sky-200': isHamburgerOpen }"
        >
          &ctdot;
    </button>

        <ul 
            x-show="isHamburgerOpen"
            x-cloak
            @click.away="isHamburgerOpen = false"
            class="absolute -mt-10 -ml-12 text-left bg-white border shadow-md ">
            {{ $slot }}
        </ul>
    </div>
</div>