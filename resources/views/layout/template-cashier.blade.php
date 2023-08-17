<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>kasir-ku</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/1692015520728.png') }}">
    @vite('resources/css/app.css')
    @stack('style')
</head>

<body>
    @yield('modal')
    <div class="w-screen h-screen relative hidden flex-col justify-center items-center mobile:flex info">
        <img class="w-[350px]" src="{{ asset('image/cashier/info.png') }}" alt="image">
        <p class="text-2xl font-semibold text-center">Kasir-ku tidak mendukung ukuran lebar layar</p>
    </div>
    <div class="flex mobile:hidden main">
        {{-- leftbar --}}
        <div class="w-[300px] bg-white shadow-2xl flex flex-col">
            <div class="flex flex-col items-center gap-3 p-2 justify-between h-screen">
                <div class="flex flex-col gap-6 w-full">
                    <div class="flex items-center gap-3">
                        <img class="w-20" src="{{ asset('image/cashier/image-1.png') }}">
                        <p class="text-2xl font-bold">kasir-ku</p>
                    </div>
                    <div class="flex flex-col gap-5">
                        <a href="/dashboard" class="flex items-center gap-4 cursor-pointer group">
                            <img class="grayscale gra w-10 group-hover:grayscale-0 transition duration-300 {{ Request::path() == 'dashboard' ? 'grayscale-0' : '' }}"
                                src="{{ asset('image/cashier/dashboard.png') }}" alt="dashboard">
                            <p
                                class="text-lg font-semibold text-gray-500 transition duration-300 group-hover:text-orange {{ Request::path() == 'dashboard' ? 'text-orange' : '' }}">
                                Dashboard</p>
                        </a>
                        <a href="/produk" class="flex items-center gap-4 group">
                            <img class="grayscale w-10 group-hover:grayscale-0  transition duration-300 {{ Request::path() == 'produk' ? 'grayscale-0' : '' }}"
                                src="{{ asset('image/cashier/box.png') }}" alt="box">
                            <p
                                class="text-lg font-semibold text-gray-500  transition duration-300 group-hover:text-orange {{ Request::path() == 'products' ? 'text-orange' : '' }}">
                                Produk</p>
                        </a>
                        <a href="/transaksi" class="flex items-center gap-4 group">
                            <img class="grayscale w-10 group-hover:grayscale-0  transition duration-300 {{ Request::path() == 'transaksi' ? 'grayscale-0' : '' }}"
                                src="{{ asset('image/cashier/money.png') }}" alt="money">
                            <p
                                class="text-lg font-semibold text-gray-500 transition duration-300 group-hover:text-orange {{ Request::path() == 'transaction' ? 'text-orange' : '' }}">
                                Transaksi</p>
                        </a>
                        <a href="/kasir" class="flex items-center gap-4 group">
                            <img class="grayscale w-10 group-hover:grayscale-0  transition duration-300 {{ Request::path() == 'kasir' ? 'grayscale-0' : '' }}"
                                src="{{ asset('image/cashier/cashier.png') }}" alt="money">
                            <p
                                class="text-lg font-semibold text-gray-500 transition duration-300 group-hover:text-orange {{ Request::path() == 'kasir' ? 'text-orange' : '' }}">
                                Kasir</p>
                        </a>
                    </div>
                </div>
                <div class="flex flex-col gap-5 w-full">
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" onclick="return confirm('anda yakin mau keluar?')"
                            class="flex items-center gap-4 group cursor-pointer">
                            <img class="grayscale w-10 group-hover:grayscale-0  transition duration-300"
                                src="{{ asset('image/cashier/logout.png') }}" alt="logout">
                            <p
                                class="text-lg font-semibold  transition duration-300 text-gray-500 group-hover:text-orange">
                                Keluar</p>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- rightBar --}}
        <div class="w-full h-screen bg-slate-200 overflow-y-auto relative p-9">
            @yield('container')
        </div>
    </div>
    <script src="{{ asset('js/setting.js') }}"></script>
    @stack('script')
</body>

</html>
