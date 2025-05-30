@extends('layouts.app')

@section('title', 'All Our Cats')

@section('content')
  <div class="container p-2">
    @if (session('alert'))
    <div class="flex justify-end mb-3">
      <p class="bg-red-500 py-4 px-16 text-[18px] text-right rounded-xl">{{ session('alert') }}</p>
    </div>
    @endif
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2">
      @foreach ($cats as $cat)
        <x-cat-grid :cat="$cat" />
      @endforeach
    </div>

    <div class="mt-12"></div>
      {{ $cats->links() }}
    </div>
  </div>
@endsection
