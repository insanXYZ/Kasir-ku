@extends('layout.template-cashier')
@push('style')
    @livewireStyles()
@endpush
@push('script')
    @livewireScripts()
@endpush
@section('container')
    <div class="flex gap-3 justify  -between items-center">
        <div class="w-1/3 h-32 p-4 flex flex-col justify-evenly bg-white rounded shadow-sm">
            <div class="text-xl">Pendapatan hari ini</div>
            <div class="text-2xl font-semibold">Rp {{ number_format($harga, 0, ',', '.') }}</div>
        </div>
        <div class="w-1/3 h-32 p-4 flex flex-col justify-evenly bg-white rounded shadow-sm">
            <div class="text-xl">Keuntungan hari ini</div>
            <div class="text-2xl font-semibold">Rp {{ number_format($untung, 0, ',', '.') }}</div>
        </div>
        <div class="w-1/3 h-32 p-4 justify-around items-center flex bg-white rounded shadow-sm">
          <img class="w-20" src="{{ asset('image/cashier/' . $img . '.png') }}" alt="indicator">
          <div>{{$persen}} %</div>
        </div>
    </div>
    <table class="table-auto w-full mt-8">
      <thead>
        <tr class="text-white bg-orange">
          <th>Tanggal</th>
          <th>Total beli</th>
          <th>Untung</th>
          <th>Barang</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $d)
        <tr class="odd:bg-white even:bg-blue-200">
          <td class="px-1 py-2 break-words text-sm">{{$d->created_at->toDateString()}} </td>
          <td class="px-1 py-2 break-words text-sm">Rp {{ number_format($d->harga, 0, ',', '.') }} </td>
          <td class="px-1 py-2 break-words text-sm">Rp {{ number_format($d->untung, 0, ',', '.') }}</td>
          <td class="px-1 py-2 break-words text-sm">{{$d->nama}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    
@endsection
