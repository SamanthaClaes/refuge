@props([
    'isLast' => false
])

<td class="px-4 py-4 {{$isLast ? 'border-r-0' : 'border-r-1' }} border-t-1 bg-white">
    {{ $slot }}
</td>
