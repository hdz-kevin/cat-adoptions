@extends('layouts.app')

@section('title', 'Most Recent Cats')

@section('content')
  <div class="container p-2 mb-10">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2">
      @foreach ($cats as $cat)
        <x-cat :cat="$cat" />
      @endforeach
    </div>
  </div>
@endsection
