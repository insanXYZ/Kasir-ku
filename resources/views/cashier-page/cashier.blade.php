@extends('layout.template-cashier')
@push('style')
    @livewireStyles()
    <style>
      @media print {
        .info {
          display: none
        }
        .closeModal {
          display: none
        }
        .buttonPrint {
          display: none
        }
      }
    </style>
@endpush
@section('modal')
<livewire:cashier.modal-cashier></livewire:cashier.modal-cashier>
@endsection
@push('script')
  @livewireScripts()
  <script src="{{asset('js/cashier.js')}}"></script>
  @endpush
@section('container')
  <div class="flex">
    <livewire:cashier.input-cashier></livewire:cashier.input-cashier>
  </div>
  <div class="w-full">
    <livewire:cashier.table-cashier></livewire:cashier.table-cashier>
  </div>
  <div class="flex justify-end mt-8">
    <div class="buttonBuy bg-green-500 py-2 px-6 font-semibold text-white rounded cursor-pointer flex items-center">Beli</div>
  </div>
@endsection