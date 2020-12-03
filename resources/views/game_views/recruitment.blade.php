<style>
    .photo{

    }
    .degicnation{
        text-align: center;
    }


    .float-left{
        float: left;
    }


    /* Slider */

    
    .slidecontainer {
    width: 100%;
    }

    .slider {
    -webkit-appearance: none;
    width: 100%;
    height: 25px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
    }

    .slider:hover {
    opacity: 1;
    }

    .slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    background: #4CAF50;
    cursor: pointer;
    }

    .slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    background: #4CAF50;
    cursor: pointer;
}



</style>

<x-app-layout>
    @include('partials.subnavbar')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">


                <div class="row">
                    <div class="col-md-6">
                        @include('partials.aside') 
                    </div>
                    <div class="col-md-6">
                        @livewire('recruitment')
                    </div>
                </div>


                
            </div>
        </div>
    </div>
</x-app-layout>
