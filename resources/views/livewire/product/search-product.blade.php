<form wire:submit.prevent="input" class="flex justify-center items-center relative">
    <input wire:model="data" class="box-border w-72 p-2 pr-20 outline-none rounded focus:ring-2 focus:ring-orange transition duration-300" type="text">
    <button type="submit" class="bg-orange px-2 py-1 rounded text-white absolute top-1/2 right-1 transform -translate-y-1/2">search</button>
</form>
