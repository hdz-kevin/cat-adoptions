@extends('layouts.app')

@section('title')

@section('content')
  <div class="container p-2 mt-16 mb-10">
    <div class="max-w-md h-40 mx-auto flex flex-col items-center justify-center gap-2 rounded-lg bg-[#333333]">
      <h2 class="text-2xl font-medium">
        {{ auth()->user()?->is_admin ? "Manage your cats!" : "Adopt your next pet!" }}
      </h2>
      <a href="{{ route('cats.index') }}" class="text-[17px] text-green-500 underline">See all Cats</a>
    </div>
  </div>
@endsection
