@props([
    'isLast' => false
])

<<<<<<< Updated upstream
<td class="px-4 py-4 {{$isLast ? 'border-r-0' : 'border-r' }} border-t bg-white text-center">
=======
<td class="px-4 py-4 {{$isLast ? 'border-r-0' : 'border-r' }} border-t bg-white">
>>>>>>> Stashed changes
    {{ $slot }}
</td>
