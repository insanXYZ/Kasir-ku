<form wire:submit.prevent="store" wire:ignore class="modalUpdate fixed transition top-0 left-0 z-10 w-full h-full flex justify-center items-center backdrop-blur-sm hidden">
    <div wire:click="resetInput" class="closeUpdate absolute top-10 right-10 text-3xl w-10 h-10 text-center cursor-pointer bg-white rounded-full">
        &#x2715
    </div>
    <div class="bg-white w-1/2 h-[90%] min-h-[400px] rounded shadow-sm flex flex-col justify-center gap-4 p-5">
        <div class="w-full h-[80%] overflow-y-auto flex flex-col gap-5">    
            <label for="nama" >Nama Produk</label>
            <input class="border rounded outline-none p-2" wire:model="nama" type="text">
            <label for="harga-perolehan">Harga Perolehan</label>
            <input class="border rounded outline-none p-2" wire:model="hargaPerolehan" type="number">
            <label for="harga-penjualan">Harga Penjualan</label>
            <input class="border rounded outline-none p-2" wire:model="hargaPenjualan" type="number">
            <label for="barqode">Kode Barqode</label>
            <input class="border rounded outline-none p-2" wire:model="barqode" type="text">
            <label for="qty">Quantity</label>
            <input class="border rounded outline-none p-2" wire:model="qty" type="number">
        </div>
        <button class="buttonUpdate bg-orange rounded text-white py-2 px-6" type="submit">Perbarui Produk</button>
    </div>
</form>