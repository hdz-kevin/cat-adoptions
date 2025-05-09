@extends('layouts.app')

@section('title', 'Create an Account')

@section('content')
  <div class="md:flex md:justify-center md:items-center mt-15">
    <div class="md:w-4/12 bg-[#333333] p-6 rounded-lg shadow-xl">
      <form action="{{ route('register') }}" method="POST" novalidate>
        @csrf

        <div class="mb-5">
          <label for="name" class="mb-2 block text-gray-200 font-bold">Name</label>
          <input
            id="name"
            name="name"
            type="text"
            placeholder="Tu Nombre"
            value="{{ old('name') }}"
            {{-- class="bg-[#444444] p-3 w-full rounded-lg focus:border-2 focus:border-gray-400 focus:outline-none" --}}
            class="input-autofill p-3 w-full rounded-lg focus:border-2 focus:border-gray-400 focus:outline-none"
            autofocus
          />

          @error('name')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="username" class="mb-2 block text-gray-200 font-bold">Username</label>
          <input
            id="username"
            name="username"
            type="text"
            placeholder="Your username"
            value="{{ old('username') }}"
            class="input-autofill p-3 w-full rounded-lg focus:border-2 focus:border-gray-400 focus:outline-none"
          />

          @error('username')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="email" class="mb-2 block text-gray-200 font-bold">Email</label>
          <input
            id="email"
            name="email"
            type="email"
            placeholder="Your email address"
            class="input-autofill p-3 w-full rounded-lg focus:border-2 focus:border-gray-400 focus:outline-none"
            value="{{ old('email') }}"
          />

          @error('email')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="password" class="mb-2 block  text-gray-200 font-bold">Password</label>
          <input
            id="password"
            name="password"
            type="password"
            placeholder="Your password"
            class="input-autofill p-3 w-full rounded-lg focus:border-2 focus:border-gray-400 focus:outline-none"
          />

          @error('password')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="password_confirmation" class="mb-2 block text-gray-200 font-bold">Confirm password</label>
          <input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            placeholder="Confirm your password"
            class="input-autofill p-3 w-full rounded-lg focus:border-2 focus:border-gray-400 focus:outline-none"
          />

          @error('password_confirmation')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <input type="submit" value="Create Account"
          class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer font-bold w-full p-3 text-white rounded-lg" />
      </form>
    </div>
  </div>
@endsection
