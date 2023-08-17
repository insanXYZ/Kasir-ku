<div class="w-full mt-8">
    {{$products->links()}}
    <table class="table-auto w-full mt-8">
      <thead>
        <tr class="text-white bg-orange">
          <th>Nama Produk</th>
          <th>Kode Barqode</th>
          <th>Harga Perolehan</th>
          <th>Harga Penjualan</th>
          <th>Keuntungan</th>
          <th>Qty</th>
          <th>Aksi</th>
        </tr> 
      </thead>
      <tbody>
        @foreach ($products as $produk )
          <tr class="odd:bg-white even:bg-blue-200 ">
            <td class="px-1 py-2 break-words text-sm">{{$produk->nama}}</td>
            <td class="px-1 py-2 break-words text-sm">{{$produk->barqode}}</td>
            <td class="px-1 py-2 break-words text-sm">Rp {{ number_format($produk->hargaPerolehan, 0, ',', '.') }}</td>
            <td class="px-1 py-2 break-words text-sm">Rp {{ number_format($produk->hargaPenjualan, 0, ',', '.') }}</td>
            <td class="px-1 py-2 break-words text-sm">Rp {{ number_format($produk->untung, 0, ',', '.') }}</td>
            <td class="px-1 py-2 break-words text-sm">{{$produk->qty}} </td>
            <td>
              <span class="flex w-full justify-evenly gap-1">
                <img wire:click="downloadJson({{$produk->barqode}})" class="cursor-pointer w-6 p-1 rounded bg-blue-400" src="{{asset('svg/cashier/qr.svg')}}" alt="generate product">
                <img data-produk="{{$produk}}" class="update cursor-pointer w-6 p-1 rounded bg-yellow-400" src="{{asset('svg/cashier/update.svg')}}" alt="update product">
                <img data-barqode="{{$produk->barqode}}" class="remove cursor-pointer w-6 p-1 rounded bg-red-400 " src="{{asset('svg/cashier/trash.svg')}}" alt="remove product">              
              </span>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>