<x-app-layout>
    <?php
    $previousUrl = null;
    $nextUrl = "/recruitment";
    ?>
    @section('nextUrl',$nextUrl)
    @section('previousUrl',$previousUrl)


    @include('partials.subnavbar')

    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">


                <div class="row">
                    <div class="col-md-6">
                        @include('partials.aside_timeline')
                    </div>
                    <div class="col-md-6">
                        @foreach(DB::table('tutorial_placeholder')->get() as $placeholder)
                            {!! $placeholder->placeholder!!}
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>

    @section('next_previous')
        {{-- nextUrl & previousUrl assigned from livewire individual views  --}}
        <div class="next_previous_container">
            <a href="{{(isset($nextUrl))? $nextUrl : "#"}}" id="arrow_next"
               class="arrow"><span>&#9658;&#9658;</span></a>

        </div>
    @endsection
</x-app-layout>


