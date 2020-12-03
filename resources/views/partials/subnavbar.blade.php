<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @foreach(DB::table("navbars")->get() as $navbar)
        <x-jet-nav-link href="{{ url($navbar->slug) }}">
            {{strtoupper($navbar->name)}}
        </x-jet-nav-link>
        @endforeach
    </h2>
</x-slot>