@extends('layouts.app')

@section('title', 'Cats for Adoption')

@section('content')
  <div class="container p-4">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
      @foreach ($cats as $cat)
        <div class="bg-[#333333] p-2 pb-4 rounded-lg">
          <div class="flex justify-center h-60 xl:h-64">
            <img src="{{ $cat->photo }}" alt="cat picture" class="object-cover h-full w-full rounded-lg">
          </div>
          <div class="px-3 mt-4">
            <p class="text-2xl font-medium mb-2">{{ $cat->name }}</p>
            <p class="text-base/7"><span class="font-medium">Breed: </span>{{ $cat->breed }}</p>
            <p class="text-base/7"><span class="font-medium">Age: </span>{{ $cat->age }}</p>
            <p class="text-base/7">
              <span class="font-medium">Vaccinated: </span>
              @if ($cat->vaccinated)
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                  class="inline text-green-600"
                >
                  <path d="M5 12l5 5l10 -10" />
                </svg>
              @else
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                  class="inline text-red-600"
                >
                  <path d="M18 6L6 18"></path>
                  <path d="M6 6l12 12"></path>
                </svg>
              @endif
            </p>
            <a href="#"
              class="inline-block mt-4 p-3 px-6 bg-sky-600 hover:bg-sky-700 transition-colors rounded-sm font-medium"
            >
              Adopt Now
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
