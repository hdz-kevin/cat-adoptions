@extends('layouts.app')

@section('title', 'All Cats')

@section('content')
  <div class="container p-2">
    @if ($alert = session('alert'))
    <div class="flex justify-end mb-3">
      <x-alert :type="$alert['type']" :message="$alert['message']" />
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
