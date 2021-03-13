<x-app-layout>
    @include('partials.subnavbar')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden" style="padding:40px;box-sizing:border-box">
                <livewire:decision-driven/>
            </div>
        </div>
    </div>

</x-app-layout>
