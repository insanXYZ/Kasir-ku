@extends('layout.template-cashier')
@push('style')
    @livewireStyles()
@endpush
@push('script')
    @livewireScripts()
    <script src="{{ asset('js/product.js') }}"></script>
@endpush
@section('container')
    <livewire:product.create-product></livewire:product.create-product>
    <livewire:product.update-product></livewire:product.update-product>
    <div class="flex justify-between">
        <div class="flex gap-3">
            <div class="buttonModal bg-orange p-2 font-semibold text-white rounded cursor-pointer">
                + Plus Product</div>
            <div class="generateBarqode bg-green-500 p-2 font-semibold text-white rounded cursor-pointer flex items-center gap-3">
                <img class="w-5" src="{{ asset('svg/cashier/qr.svg') }}" alt="qr">
                Generate Json
            </div>
        </div>
        <livewire:product.search-product></livewire:product.search-product>
    </div>
    <livewire:product.table-product></livewire:product.table-product>
@endsection
