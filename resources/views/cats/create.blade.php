@extends('layouts.app')

@section('title', 'Add a new Cat for Adoption')

@section('content')
  <div class="md:flex md:justify-center md:items-center mt-15">
    <div class="md:w-4/12 bg-[#333333] p-6 rounded-lg shadow-xl">
      <form action="{{ route('cats.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-5">
          <label for="name" class="mb-2 block text-gray-200 font-bold">Name</label>
          <input
            id="name"
            name="name"
            type="text"
            placeholder="Cami"
            class="input-autofill p-3 w-full rounded-lg focus:border-2 focus:border-gray-400 focus:outline-none"
            value="{{ old('name') }}"
            autofocus
          />

          @error('name')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="breed" class="mb-2 block text-gray-200 font-bold">Breed</label>
          <input
            id="breed"
            name="breed"
            type="text"
            placeholder="Maine Coon"
            class="input-autofill p-3 w-full rounded-lg focus:border-2 focus:border-gray-400 focus:outline-none"
            value="{{ old('breed') }}"
            autofocus
          />

          @error('breed')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="age" class="mb-2 block text-gray-200 font-bold">Age</label>
          <input
            id="age"
            name="age"
            type="number"
            placeholder="3"
            class="input-autofill p-3 w-full rounded-lg focus:border-2 focus:border-gray-400 focus:outline-none"
            value="{{ old('age') }}"
          />

          @error('age')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-5 flex gap-1.5 items-center">
          <input type="checkbox" name="vaccinated" id="vaccinated">
          <label for="vaccinated" class="text-gray-200">Vaccinated</label>
        </div>

        <input type="submit" value="Save"
          class="bg-sky-600 hover:bg-sky-700 uppercase transition-colors cursor-pointer font-bold w-full p-3 text-white rounded-lg" />
      </form>
    </div>
  </div>
@endsection
