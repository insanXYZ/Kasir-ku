<form wire:submit.prevent="store" wire:ignore class="modal fixed transition top-0 left-0 z-10 w-full h-full flex justify-center items-center backdrop-blur-sm hidden">
    <div class="closeModal absolute top-10 right-10 text-3xl w-10 h-10 text-center cursor-pointer bg-white rounded-full">
        &#x2715
    </div>
    <div class="bg-white w-[640px] h-[90%] min-h-[400px] rounded shadow-sm flex flex-col justify-center gap-4 p-5">
        <div class="w-full h-[80%] overflow-y-auto flex flex-col gap-5">    
            <label for="nama">Nama Produk</label>
            <input class="border rounded outline-none p-2" wire:model="nama" type="text" required>
            <label for="harga-perolehan" >Harga Perolehan</label>
            <input class="border rounded outline-none p-2" wire:model="hargaPerolehan" type="number" placeholder="format angka biasa seperti 1000" required>
            <label for="harga-penjualan">Harga Penjualan</label>
            <input class="border rounded outline-none p-2" wire:model="hargaPenjualan" type="number" placeholder="format angka biasa seperti 1000 (default 10% dari harga penjualan)">
            <label for="barqode">Kode Barqode</label>
            <input class="border rounded outline-none p-2" wire:model="barqode" type="text" required>
            <label for="qty">Quantity</label>
            <input class="border rounded outline-none p-2" wire:model="qty" type="number" required>
        </div>
        <button class="buttonInput bg-orange rounded text-white py-2 px-6" type="submit">Buat Produk</button>
    </div>
</form>