@extends('layout.template')
@section('container')
  <div class="flex bg-slate-200">
    <div class="m-auto h-screen w-[600px] bg-white shadow-2xl flex flex-col items-center justify-center">
      <img class="w-60 mb-4"  src="{{asset('image/auth/image-1.png')}}" alt="image-kasir">
      <form class="flex flex-col gap-4 w-[400px] shadow-xl p-6" action="/sign-up" method="post">
      @csrf
        <label class="font-semibold text-lg" for="nama">nama</label>
        <input class="rounded p-2 shadow border focus:outline focus:outline-blue-200" type="text" name="nama" id="nama" placeholder="nama">
        <label class="font-semibold text-lg" for="password">password</label>
        <input class=" rounded p-2 shadow border appearance-none focus:outline focus:outline-blue-200" type="password" name="password" id="password" placeholder="Password">
        <div class="flex my-2 justify-between items-center">
          <a href="/sign-in">sudah punya akun?</a>
          <button class="bg-orange py-2 px-6 text-white rounded" type="submit">Sign-up</button>
        </div>
      </form>
    </div>
  </div>
@endsection