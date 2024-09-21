@props(['active'])

@php
$classes = 'bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700';
@endphp

<div class="py-10">
  <a {{ $attributes->merge(['class' => $classes]) }}>
      {{ $slot }}
  </a>
</div>