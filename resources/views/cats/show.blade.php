@extends('layouts.app')

@section('content')
  <div class="flex justify-center mt-20">
    <x-cat-show :cat="$cat" />
  </div>
@endsection
