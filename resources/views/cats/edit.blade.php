@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@push('scripts')
  @vite('resources/js/create-cat.js')
@endpush

@section('title')
  Editing cat 
@endsection

@section('content')
  <div class="md:flex md:justify-center md:items-center mt-12">
    <div class="md:w-4/12 bg-[#333333] p-5 rounded-lg shadow-xl">
      <form action="#" method="POST" novalidate class="form">
        @csrf
        @method('PUT')

        <div class="mb-4">
          <label for="name" class="mb-2 block text-gray-200 font-bold">Name</label>
          <input
            id="name"
            name="name"
            type="text"
            placeholder="Cami"
            class="input-autofill p-3 w-full rounded-lg focus:border focus:border-gray-400 focus:outline-none"
            value="{{ old('name') ?? $cat->name }}"
            autofocus
          />

          @error('name')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="breed" class="mb-2 block text-gray-200 font-bold">Breed</label>
          <input
            id="breed"
            name="breed"
            type="text"
            placeholder="Maine Coon"
            class="input-autofill p-3 w-full rounded-lg focus:border  focus:border-gray-400 focus:outline-none"
            value="{{ old('breed') ?? $cat->breed }}"
            autofocus
          />

          @error('breed')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="age" class="mb-2 block text-gray-200 font-bold">Age</label>
          <input
            id="age"
            name="age"
            type="number"
            placeholder="3"
            class="input-autofill p-3 w-full rounded-lg focus:border  focus:border-gray-400 focus:outline-none"
            value="{{ old('age') ?? $cat->age }}"
          />

          @error('age')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4 flex gap-1.5 items-center">
          <input
            type="checkbox"
            name="vaccinated"
            id="vaccinated"
            {{
              old('vaccinated') !== null ?  (old('vaccinated') ? 'checked' : '') :
                ($cat->vaccinated ? 'checked' : '')
            }}
          >
            <label for="vaccinated" class="text-gray-200">Vaccinated</label>
          </div>

        <div class="mb-4">
          <label class="mb-2 block text-gray-200 font-bold">Cat Photo</label>
          <div id="dropzone" class="dropzone flex justify-center items-center">
            <div class="dz-message" data-dz-message>
              <span>Drag cat photo here or click to upload</span>
            </div>
          </div>
        </div>

        <div class="mb-4">
          <input
            type="hidden"
            name="photo"
            value="{{ old('photo') }}"
          >

          @error('photo')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
          @enderror
        </div>

        <input
          type="submit"
          value="Save"
          class="bg-sky-600 hover:bg-sky-700 uppercase transition-colors cursor-pointer font-bold w-full p-3 text-white rounded-lg"
        />
      </form>
    </div>
  </div>
@endsection
