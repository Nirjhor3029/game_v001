<style>


</style>

<x-app-layout>
    @include('partials.subnavbar')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">


                <div class="row">
                    <div class="col-md-6 ">
                        @include('partials.aside')
                        @include('partials.revenue_urls')
                    </div>
                    <div class="col-md-6">
                        @livewire('revenue')
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
