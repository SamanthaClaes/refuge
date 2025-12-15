@props([
  'title',
  'body'
])

<div
    class="inset-0 fixed z-[999] grid h-screen w-screen place-items-center bg-black/40 backdrop-blur-xs transition-opacity duration-300"
>
    <div
        class="relative m-4 p-4 w-2/5 min-w-[40%] max-w-[40%] rounded-lg bg-element shadow-sm"
    >
        <div class="flex shrink-0 items-center pb-4 text-3xl font-medium  font-title uppercase text-text">
            {{$title}}
        </div>
        <div>
            {{ $body }}
        </div>
    </div>
</div>
