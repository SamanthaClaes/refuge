@props(
    [
        'title',
        'number',
        'svg',
        'route',
]
)
<div class="col-span-3">
    <a href="{{ $route }}">
        <div class="bg-element h-36 rounded-2xl transform transition-transform duration-300 ease-in-out hover:scale-105">
            <div class="flex justify-between pt-6 pr-6">
                <p class="text-6xl text-text pl-6">{!! $number !!}</p>
                <div class="w-16 h-16 bg-background rounded-full flex items-center justify-center">
                    <x-dynamic-component :component="'svg.' . $svg"/>
                </div>
            </div>
            <div class="pl-6 pt-2 text-text font-medium">
                {!! $title !!}
            </div>
        </div>
    </a>
</div>
