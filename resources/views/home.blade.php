@extends('layouts.app')

@section('title', 'Cats for Adoption')

@php
  $cats = [
      (object) [
          'id' => 1,
          'name' => 'Whiskers',
          'age' => 2,
          'breed' => 'Siamese',
          'vaccinated' => true,
      ],
      (object) [
          'id' => 2,
          'name' => 'Mittens',
          'img' => asset('img/cat3.webp'),
          'age' => 3,
          'breed' => 'Persian',
          'vaccinated' => true,
      ],
      (object) [
          'id' => 3,
          'name' => 'Shadow',
          'img' => asset('img/cat4.webp'),
          'age' => 1,
          'breed' => 'Maine',
          'vaccinated' => false,
      ],
      (object) [
          'id' => 4,
          'name' => 'Luna',
          'img' => asset('img/cat3.webp'),
          'age' => 4,
          'breed' => 'Bengal',
          'vaccinated' => true,
      ],
      (object) [
          'id' => 5,
          'name' => 'Oliver',
          'age' => 5,
          'breed' => 'British Shorthair',
          'vaccinated' => false,
      ],
      (object) [
          'id' => 6,
          'name' => 'Bella',
          'img' => asset('img/cat5.webp'),
          'age' => 6,
          'breed' => 'Sphynx',
          'vaccinated' => true,
      ],
      (object) [
          'id' => 7,
          'name' => 'Charlie',
          'img' => asset('img/cat3.webp'),
          'age' => 7,
          'breed' => 'Ragdoll',
          'vaccinated' => true,
      ],
      (object) [
          'id' => 8,
          'name' => 'Max',
          'age' => 8,
          'breed' => 'Scottish Fold',
          'vaccinated' => true,
      ],
      (object) [
          'id' => 9,
          'name' => 'Coco',
          'img' => asset('img/cat4.webp'),
          'age' => 9,
          'breed' => 'Abyssinian',
          'vaccinated' => false,
      ],
      (object) [
          'id' => 10,
          'name' => 'Daisy',
          'age' => 10,
          'breed' => 'Sphynx',
          'vaccinated' => true,
      ],
  ];
@endphp

@section('content')
  <div class="container p-4">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
      @foreach ($cats as $cat)
        <div class="bg-[#333333] p-2 pb-4 rounded-lg">
          <div class="flex justify-center h-60 xl:h-64">
            <img src="{{ $cat->img ?? asset('img/cat2.webp') }}" alt="cat image" class="object-cover h-full w-full rounded-lg">
          </div>
          <div class="px-3 mt-5">
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
            <a href="#" class="inline-block mt-4 p-3 px-6 bg-sky-600 hover:bg-sky-700 transition-colors rounded-sm font-medium">Adopt Now</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
