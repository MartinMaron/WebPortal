<div>
    <div class="hidden sm:block">
        <span class="flex w-32 text-center md:w-auto md:text-xl">
            {{ $this->realestate->address }}
        </span>
    </div>

    <div class="block sm:hidden">
        <span class="flex text-sm text-center sm:w-auto sm:text-sm">
            {{ $this->realestate->street }}
        </span>
        <span class="flex text-sm text-center sm:w-auto sm:text-sm">
            {{ $this->realestate->postCode }}
            {{ $this->realestate->city }}
        </span>
    </div>
</div>