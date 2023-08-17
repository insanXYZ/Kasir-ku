<div class="modal fixed transition top-0 left-0 z-10 w-full h-full flex justify-center items-center mobile:items-start backdrop-blur-sm hidden">
    <div class="closeModal absolute top-10 right-10 text-3xl w-10 h-10 text-center cursor-pointer bg-white rounded-full">
        &#x2715
    </div>
    <div class="w-[640px] rounded bg-white p-3 font-mono flex flex-col gap-5 items-center value">
        <div class="w-[380px] overflow-hidden">
            <div class="text-center text-2xl font-bold font-mono mb-6">Kasir-ku</div>
            <div>Tanggal: {{date("d-m-Y")}} </div>
            <div>Nomor Transaksi: {{$nomorTransaksi}} </div>
            <div>Kasir: {{Auth()->user()->nama}} </div>
            <div>===========================================</div>
            @php
                $total = 0;
            @endphp
            @if (count($products))
                @foreach ($products as $product)
                    <div class="flex">
                        <div class="w-2/3">
                            {{$product['nama']}}(x{{$product['qty']}})
                        </div>
                        <div class="w-1/3 text-end">
                            Rp {{ number_format($product['harga'] * $product['qty'], 0, ',', '.') }}
                        </div>
                        @php
                            $total += $product['harga']*$product['qty'];
                        @endphp
                    </div> 
                @endforeach
            @endif
            <div>============================================</div>
            <div class="flex justify-end">
                <div>Total: Rp {{number_format($total, 0, ',', '.')}} </div>
            </div>
        </div>
        <div class="flex justify-end  w-[380px]">
            <button class="bg-green-500 py-2 px-6 font-semibold text-white rounded cursor-pointer flex items-center focus:ring-4 buttonPrint" autofocus>Print</button>
        </div>
    </div>
</div>
