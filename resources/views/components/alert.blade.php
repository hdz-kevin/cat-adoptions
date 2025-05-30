@php
  $bg = [
      'danger' => 'bg-red-500',
      'success' => 'bg-green-600',
      'info' => 'bg-sky-500',
  ];
@endphp

<p class="{{ $bg[$type] ?? 'bg-sky-500' }} py-3 px-16 text-[18px] text-right rounded-xl">
  {{ session('alert')['message'] }}
</p>
