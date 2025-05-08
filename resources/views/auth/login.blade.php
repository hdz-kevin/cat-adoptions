@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="md:flex md:justify-center md:items-center mt-15">
  <div class="md:w-4/12 bg-[#333333] p-6 rounded-lg shadow-xl">
    <form action="{{ route('login.store') }}" method="POST" novalidate>
      @csrf

      <div class="mb-5">
        <label for="email" class="mb-2 block text-gray-200 font-bold">Email</label>
        <input
          id="email"
          name="email"
          type="email"
          placeholder="Your email address"
          class="bg-[#444444] p-3 w-full rounded-lg focus:border-2 focus:border-gray-400 focus:outline-none"
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
          class="bg-[#444444] p-3 w-full rounded-lg focus:border-2 focus:border-gray-400 focus:outline-none"
        />

        @error('password')
          <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
        @enderror
      </div>

      <input type="submit" value="Login"
        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer font-bold w-full p-3 text-white rounded-lg" />
    </form>
  </div>
</div>
@endsection
