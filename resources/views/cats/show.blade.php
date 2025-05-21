@extends('layouts.app')

@section('content')
  <div class="flex justify-center mt-20">
    <div class="w-full max-w-md bg-[#333333] p-6 rounded-lg shadow-xl">
      <div class="flex justify-center h-64 mb-6">
        <img src="{{ Storage::url($cat->photo) }}" alt="cat picture" class="object-cover h-full w-full rounded-lg">
      </div>
      <div class="text-gray-200">
        <h2 class="text-3xl font-bold mb-4 text-center">{{ $cat->name }}</h2>
        <p class="mb-2"><span class="font-semibold">Breed:</span> {{ $cat->breed }}</p>
        <p class="mb-2"><span class="font-semibold">Age:</span> {{ $cat->age }}</p>
        <p class="mb-2 flex items-center">
          <span class="font-semibold mr-2">Vaccinated:</span>
          @if ($cat->vaccinated)
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="inline text-green-600">
              <path d="M5 12l5 5l10 -10" />
            </svg>
          @else
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="inline text-red-600">
              <path d="M18 6L6 18"></path>
              <path d="M6 6l12 12"></path>
            </svg>
          @endif
        </p>
        <div class="flex justify-between mt-6 gap-2">
          @if(auth()->user()?->is_admin)
            <a
              href="{{ route('cats.edit', $cat) }}"
              class="p-2 px-5 bg-sky-600 hover:bg-sky-700 transition-colors rounded-sm font-medium"
            >
              Edit
            </a>
            <form
              action="{{ route('cats.destroy', $cat->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this cat?');"
            >
              @csrf
              @method('DELETE')

              <button type="submit" class="p-2 px-5 bg-red-500 hover:bg-red-600 transition-colors rounded-sm font-medium">Delete</button>
            </form>
          @else
            <a href="#" class="p-2 px-5 bg-sky-600 hover:bg-sky-700 transition-colors rounded-sm font-medium">Adopt Now</a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
