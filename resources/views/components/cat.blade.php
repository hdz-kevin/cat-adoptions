<div class="flex justify-center h-64 mb-6">
  <img src="{{ Storage::url($cat->photo) }}" alt="cat picture" class="object-cover h-full w-full rounded-lg">
</div>
<div class="text-gray-200">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold text-center">{{ $cat->id .' - '. $cat->name }}</h2>
    @if ($cat->is_adopted)
      <span class="text-[20px] font-medium text-green-500 uppercase inline-block">Adopted</span>
    @endif
  </div>
  <p class="mb-2"><span class="font-semibold">Breed:</span> {{ $cat->breed }}</p>
  <p class="mb-2"><span class="font-semibold">Age:</span> {{ $cat->age }} years old</p>
  <p class="mb-2 flex items-center">
    <span class="font-semibold mr-2">Vaccinated:</span>
    @if ($cat->vaccinated)
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="inline text-green-600">
        <path d="M5 12l5 5l10 -10" />
      </svg>
    @else
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="inline text-red-600">
        <path d="M18 6L6 18"></path>
        <path d="M6 6l12 12"></path>
      </svg>
    @endif
  </p>
  <div class="flex justify-between mt-6">
    <x-cat-actions :cat="$cat" />
  </div>
</div>
