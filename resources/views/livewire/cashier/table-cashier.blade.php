<div class="w-full mt-8 ">
  @if (count($products) > 0)
    <table class="w-full table-fixed">
      <thead>
        <tr class="text-white bg-orange">
          <th  class="w-20">Aksi</th>
          <th>Barqode</th>
          <th>Nama Barang</th>
          <th>Qty</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
            <tr class="odd:bg-white even:bg-blue-200 ">
              <td wire:click="deleteInput('{{ $product['barqode'] }}')"><img class="cursor-pointer w-6 p-1 rounded bg-red-400 m-auto" src="{{asset('svg/cashier/trash.svg')}}" alt="remove product"></td>
              <td class="px-1 py-2 break-words text-sm">{{$product['barqode']}}</td>
              <td class="px-1 py-2 break-words text-sm nama">{{$product['nama']}}</td>
              <td class="py-2 break-words text-md text-center"><input class="border qty" type="number" value="1" min="1" max="{{$product['qty']}}"></td>
              <td class="px-1 py-2 break-words text-sm ">Rp {{ number_format($product['hargaPenjualan'], 0, ',', '.') }}</td>
              <div class="hidden harga">{{$product['hargaPenjualan']}}</div>
            </tr>
        @endforeach
      </tbody>
    </table>
@endif
</div>
