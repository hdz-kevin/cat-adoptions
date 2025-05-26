<div class="flex justify-between items-center border-b border-gray-700 py-3 pr-4">
  {{-- User data --}}
  <div>
    {{-- Remove $adoptionRequest->user->id --}}
    <p class="font-medium text-[17px] mb-1">{{ $adoptionRequest->user->id . ' - ' . $adoptionRequest->user->name }}</p>
    <a href="#" class="underline">{{ $adoptionRequest->user->email }}</a>
  </div>
  {{-- Actions --}}
  <div>
    <form action="#" class="relative group inline-block mr-3">
      <button type="submit" class="cursor-pointer">
        <x-icon icon="check" />
      </button>
      <span
        class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 px-2 py-1 rounded bg-[#222222] text-white
        text-xs opacity-0 group-hover:opacity-100 transition pointer-events-none whitespace-nowrap z-10">
        Approve
      </span>
    </form>

    <form action="#" class="relative group inline-block">
      <button type="submit" class="cursor-pointer">
        <x-icon icon="cross" />
      </button>
      <span
        class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 px-2 py-1 rounded bg-[#222222] text-white
        text-xs opacity-0 group-hover:opacity-100 transition pointer-events-none whitespace-nowrap z-10">
        Reject
      </span>
    </form>
  </div>
</div>
