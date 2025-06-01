@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <div class="max-w-md mx-auto mt-16 bg-[#333333] p-8 rounded-lg shadow-xl">
    <h2 class="text-2xl font-bold text-center mb-6">User Profile</h2>
    <div class="mb-4">
      <span class="block text-gray-400 mb-1">Name:</span>
      <span class="text-[17px] text-white font-medium">{{ $user->name }}</span>
    </div>
    <div class="mb-4">
      <span class="block text-gray-400 mb-1">Email:</span>
      <span class="text-[17px] text-white font-medium">{{ $user->email }}</span>
    </div>
    <div class="mb-4">
      <span class="block text-gray-400 mb-1">Username:</span>
      <span class="text-[17px] text-white font-medium">{{ $user->username ?? '-' }}</span>
    </div>
    @if ($user->is_admin)
      <div class="mb-4">
        <span class="block text-gray-400 mb-1">Role:</span>
        <span class="text-[17px] text-white font-medium">Admin</span>
      </div>
    @endif
  </div>
@endsection
