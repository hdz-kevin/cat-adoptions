@extends('layouts.app')

@section('content')
  <div class="lg:flex lg:gap-5 mt-20">
    <div
      class="w-full max-w-md mx-auto bg-[#333333] p-6 rounded-lg shadow-xl {{ auth()->user()?->is_admin ? 'lg:w-1/3 lg:mx-0' : '' }} flex-shrink-0">

      <x-cat :$cat />

    </div>
    @if (auth()->user()?->is_admin)
      <div class="lg:w-2/3 bg-[#333333] p-6 py-4 mt-6 lg:mt-0 lg:mx-0 rounded-lg shadow-xl flex-shrink-0">
        @if ($cat->adoptionRequests->count() > 0)
          <h2 class="text-2xl text-center font-bold mb-4">Adoption Requests for {{ $cat->name }}</h2>
          <div class="overflow-y-scroll max-h-96">
            @php
              [
                'pending' => $pending,
                'approved' => $approved,
                'rejected' => $rejected,
              ] = $cat->groupedAdoptionRequests();

              $showActions = !$cat->is_adopted;
            @endphp

            @if (!$approved->isEmpty())
              <p class="text-xl text-center font-medium mt-5">Approved</p>
            @endif
            @foreach ($approved as $aR)
              <x-adoption-request :adoptionRequest="$aR" />
            @endforeach

            @if (!$pending->isEmpty())
              <p class="text-xl text-center font-medium mt-5">Pending</p>
            @endif
            @foreach ($pending as $aR)
              <x-adoption-request :adoptionRequest="$aR" :$showActions />
            @endforeach

            @if (!$rejected->isEmpty())
              <p class="text-[22px] text-center font-medium mt-5">Rejected</p>
            @endif
            @foreach ($rejected as $aR)
              <x-adoption-request :adoptionRequest="$aR" />
            @endforeach

          </div>
        @else
          <div class="h-full flex justify-center items-center">
            <h3 class="text-xl font-medium uppercase text-gray-300">{{ $cat->name }} has no adoption requests yet.</h3>
          </div>
        @endif
      </div>
    @endif
  </div>
@endsection
