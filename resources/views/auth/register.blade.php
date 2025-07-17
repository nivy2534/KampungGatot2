@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
  {{-- Left Side --}}
  <div class="hidden md:block w-1/2 relative">
    <img
      src="{{ asset('assets/img/tros.jpeg') }}"
      alt="Login Image"
      class="w-full h-full object-cover"
    />
    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center px-10">
      <div class="text-white">
        <h1 class="text-3xl font-bold mb-2">
          Mulai kelola dan kembangkan website Desa Ngebruk
        </h1>
        <p class="text-lg">dengan mudah melalui panel admin</p>
      </div>
    </div>
  </div>

  {{-- Right Side (Login Form) --}}
  <div class="w-full md:w-1/2 flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md">
      <div class="mb-6">
        <h2 class="text-2xl font-semibold">Masuk</h2>
        <p class="text-gray-600">Masuk ke akun Anda untuk melanjutkan</p>
      </div>
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
          <label for="email" class="block text-sm font-medium">Alamat Email</label>
          <input
            id="email"
            name="email"
            type="email"
            required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Masukkan alamat email..."
          />
        </div>

        <div class="mb-4">
          <label for="name" class="block text-sm font-medium">Nama</label>
          <input
            id="name"
            name="name"
            type="name"
            required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Masukkan nama..."
          />
        </div>

        <div class="mb-4">
          <label for="password" class="block text-sm font-medium">Kata Sandi</label>
          <input
            id="password"
            name="password"
            type="password"
            required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Masukkan kata sandi..."
          />
        </div>

        <div class="text-sm text-gray-500 mb-4">
          Dilindungi dan bagian dari
          <a href="#" class="text-blue-600">Kebijakan Privasi</a> dan
          <a href="#" class="text-blue-600">Ketentuan Penggunaan</a>
        </div>

        <div class="mb-4">
          <button
            type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition"
          >
            Masuk
          </button>
        </div>

        <div class="text-sm">
          Belum punya akun?
          <a href="{{ route('register') }}" class="text-blue-600">Daftar</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
