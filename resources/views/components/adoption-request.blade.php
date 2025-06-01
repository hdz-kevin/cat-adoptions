@php
  $textColor = $adoptionRequest->status == 'approved' ? 'text-green-500' :
              ($adoptionRequest->status == 'rejected' ? 'text-red-400' : '');
@endphp

<div class="flex justify-between items-center border-b border-gray-700 py-2 pr-4">
  {{-- User data --}}
  <div>
    {{-- Remove $adoptionRequest->user->id --}}
    <p class="{{ $textColor }} font-medium text-[17px] mb-1">{{ $adoptionRequest->id . ' - ' . $adoptionRequest->user->username }}</p>
    <a href="{{ route('profile', $adoptionRequest->user) }}" class="text-gray-300 underline">{{ $adoptionRequest->user->email }}</a>
  </div>
  {{-- Actions --}}
  @if ($showActions)
    <div>
      <form action="{{ route('adoption-requests.approve', $adoptionRequest) }}" method="POST" class="relative group inline-block mr-3">
        @csrf
        <button type="submit" class="cursor-pointer">
          <x-icon icon="check" />
        </button>
        <span
          class="absolute left-1/2 -translate-x-1/2 bottom-full px-2 py-1 rounded bg-[#222222] text-white
          text-xs opacity-0 group-hover:opacity-100 transition pointer-events-none whitespace-nowrap z-10">
          Approve
        </span>
      </form>

      <form action="{{ route('adoption-requests.reject', $adoptionRequest) }}" method="POST" class="relative group inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="cursor-pointer">
          <x-icon icon="cross" />
        </button>
        <span
          class="absolute left-1/2 -translate-x-1/2 bottom-full px-2 py-1 rounded bg-[#222222] text-white
          text-xs opacity-0 group-hover:opacity-100 transition pointer-events-none whitespace-nowrap z-10">
          Reject
        </span>
      </form>
    </div>
  @endif
</div>
