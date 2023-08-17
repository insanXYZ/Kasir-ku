@extends('layout.template-cashier')
@section('container')
  <div class="flex gap-3 justify-between items-center">
    <div class="font-semibold text-4xl">Halo, {{Auth::user()->nama}} </div>
    <div class="w-1/3 h-32 p-4 flex flex-col justify-evenly bg-white rounded shadow-sm">
      <div class="text-xl">History hari ini</div>
      <div class="text-2xl font-semibold">{{$histories->count()}} </div>
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
        <th>Tipe</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($histories as $history)
      <tr class="odd:bg-white even:bg-blue-200">
            <td class="px-1 py-2 break-words text-sm">{{$history->updated_at->toDateString()}} </td>
            <td class="px-1 py-2 break-words text-sm">{{$history->tipe}} </td>
            <td class="px-1 py-2 break-words text-sm">{{$history->keterangan}} </td>
          </tr>
      @endforeach
    </tbody>
  </table>
  @endsection