
<x-app-layout>
    @include('partials.subnavbar')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden" style="padding:40px;box-sizing:border-box">
                {{-- <livewire:decision-driven/> --}}

                    
                <!--start graph 1st row -->
                <div class="row">
                    <div class="col-md-4">
                        {{-- @livewire('chart.decison-driven-market-share') --}}
                        <livewire:chart.decison-driven-market-share/>
                    </div>




                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="BoundaryDicisionDriven" width="400" height="400"></canvas>
                                <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Revenue <p>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="myChart" width="400" height="400"></canvas>
                                <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Cost <p>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end graph -->



                <!--start graph -->
                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="unitSales" width="400" height="400"></canvas>
                                <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Unit sales in countries<p>
                            </div>
                        </div>
                    </div>




                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="display-1">123</h2>
                                <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Net profit<p>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="pricingvscompetition" width="400" height="400"></canvas>
                                <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Pricing vs. Competition<p>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end graph -->




            </div>
        </div>
    </div>

</x-app-layout>