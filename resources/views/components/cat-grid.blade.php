<div class="bg-[#333333] p-2 pb-3 rounded-lg">
  <div class="flex justify-center h-52">
    <a href="{{ route('cats.show', $cat->id) }}" class="w-full">
      <img src="{{ Storage::url($cat->photo) }}" alt="cat picture" class="object-cover h-full w-full rounded-lg">
    </a>
  </div>
  <div class="px-3 mt-4">
    <p class="text-xl font-medium mb-1">{{ $cat->name }}</p>
    <p class="text-base/7"><span class="font-medium">Breed: </span>{{ $cat->breed }}</p>

    <div class="flex justify-between mt-3">
      <x-cat-actions :cat="$cat" />
    </div>
  </div>
</div>
