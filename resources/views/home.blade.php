@extends('layouts.app')

@section('title', 'Cats for Adoption')

@section('content')
  <div class="container p-2 mb-10">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2">
      @foreach ($cats as $cat)
        <div class="bg-[#333333] p-2 pb-3 rounded-lg">
          <div class="flex justify-center h-52">
            <a href="{{ route('cats.show', $cat->id) }}" class="w-full">
              <img src="{{ Storage::url($cat->photo) }}" alt="cat picture" class="object-cover h-full w-full rounded-lg">
            </a>
          </div>
          <div class="px-3 mt-4">
            <p class="text-xl font-medium mb-1">{{ $cat->name }}</p>
            <p class="text-base/7"><span class="font-medium">Breed: </span>{{ $cat->breed }}</p>
            <p class="text-base/7"><span class="font-medium">Age: </span>{{ $cat->age }}</p>
            <p class="text-base/7">
              <span class="font-medium">Vaccinated: </span>

              @if ($cat->vaccinated)
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="inline text-green-600">
                  <path d="M5 12l5 5l10 -10" />
                </svg>
              @else
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="inline text-red-600">
                  <path d="M18 6L6 18"></path>
                  <path d="M6 6l12 12"></path>
                </svg>
              @endif
            </p>

            <div class="flex justify-between mt-3">
              @if (auth()->user()?->is_admin)
                <form
                  action="{{ route('cats.destroy', $cat->id) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this cat?');"
                >
                  @method('DELETE')
                  @csrf

                  <button type="submit" class="p-2 px-5 bg-red-500 hover:bg-red-600 transition-colors rounded-sm font-medium cursor-pointer">
                    Delete
                  </button>
                </form>
                <a
                  href="{{ route('cats.edit', $cat) }}"
                  class="p-2 px-5 bg-sky-600 hover:bg-sky-700 transition-colors rounded-sm font-medium"
                >
                  Edit
                </a>
              @else
                <a href="#"
                  class="p-2 px-5 bg-sky-600 hover:bg-sky-700 transition-colors rounded-sm font-medium"
                >
                  Adopt Now
                </a>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-10"></div>
      {{ $cats->links() }}
    </div>

  </div>
@endsection
