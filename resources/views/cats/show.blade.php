@extends('layouts.app')

@section('content')
<div class="lg:flex lg:gap-5 mt-20">
    <div class="w-full max-w-md mx-auto bg-[#333333] p-6 rounded-lg shadow-xl {{ auth()->user()->is_admin ? 'lg:w-1/3 lg:mx-0' : '' }} flex-shrink-0">
      <x-cat-show :cat="$cat" />
    </div>
    @if (auth()->user()?->is_admin)
    <div class="lg:w-2/3 bg-[#333333] p-6 py-4 mt-6 lg:mt-0 lg:mx-0 rounded-lg shadow-xl flex-shrink-0">
      <h2 class="text-xl text-center font-bold mb-4">Adoption Requests for {{ $cat->name }}</h2>
      <div class="overflow-y-scroll max-h-96">
        @foreach ($cat->adoptionRequests as $adoptionRequest)
          <x-adoption-request :$adoptionRequest />
        @endforeach
      </div>
    </div>
    @endif
  </div>
@endsection
