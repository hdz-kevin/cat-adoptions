@php
	$variants = [
		'primary' => 'bg-sky-600 hover:bg-sky-700',
		'danger' => 'bg-red-500 hover:bg-red-600',
		'success' => 'bg-green-500 hover:bg-green-600',
	];
@endphp

<button type="{{ $type }}"
  class="{{ $variants[$variant] }} p-2 px-5 transition-colors rounded-sm font-medium cursor-pointer">
  {{ $value }}
</button>
