<div>
    {{-- Success is as dangerous as failure. --}}
                                
        <!--start graph 1st row -->
        <div class="row">
            {{-- Market Share --}}
            <div class="col-md-4">
                {{-- @livewire('chart.decison-driven-market-share') --}}
                {{-- <livewire:chart.decison-driven-market-share/> --}}
                {{-- {{$MARKET_TOTAL_SELL_VALUE}} --}}

                <div wire:poll.750ms>
                    <div class="card">
                        <div class="card-body">
                            <canvas id="PieChartDicisionDriven" width="400" height="400"></canvas>
                            
                            <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Market share<p>
                        </div>
                    </div>
                
                    
                </div>
                
            </div>


            {{-- Revenue --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    {{-- <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                    </div> --}}
                                    <select class="custom-select" id="inputGroupSelect01">
                                        <option selected>Marketplace...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    {{-- <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                    </div> --}}
                                    <select class="custom-select" id="inputGroupSelect01">
                                        <option selected>Product...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
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
                        <center><h2 class="display-1">{{$this->net_income}}</h2></center>
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




    <script>
        var piechartdicision = document.getElementById('PieChartDicisionDriven').getContext('2d');
        var myPieChart = new Chart(piechartdicision, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [{{$marketShareValues[0]}},{{$marketShareValues[1]}},{{$marketShareValues[2]}}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                }],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    "{{$marketShareLabels[0]}}",
                    "{{$marketShareLabels[1]}}",
                    "{{$marketShareLabels[2]}}",
                    
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            // beginAtZero: false
                            min: 1,
                            max:{{$MARKET_TOTAL_SELL_VALUE}}
                        }
                    }]
                }
            }
        });
    </script>


    <script>
                            
        /******************* revenue Decision Driven *****************/
        var bchart = document.getElementById('BoundaryDicisionDriven').getContext('2d');
        var mylineChart = new Chart(bchart, {
            type: 'bar',
            data: {
                labels: ['Bangladesh', 'Nepal'],
                datasets: [{
                    label: 'Total Revenue',
                    data: [{{$bn_total_revenue}}, {{$np_total_revenue}}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        /******************* revenue Decision Driven *****************/


        /******************* cost graph Decision Driven *****************/
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Bangladesh', 'Nepal'],
                datasets: [{
                    label: 'Total cost',
                    data: [{{$bn_total_cost}}, {{$np_total_cost}}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        /******************* cost graph Decision Driven *****************/



        /******************* unitSales graph Decision Driven *****************/
        var unitSales = document.getElementById('unitSales').getContext('2d');
        let compitision = new Chart(unitSales, {
            type: 'line',
            data: {
                datasets: [
                    {
                        label: 'Red Team',
                        data: [{{$bn_unit_sales}}],
                        type: 'line',
                        backgroundColor: "transparent",
                        borderColor: "green"

                    },
                    {
                        label: 'Green Team',
                        data: [{{$np_unit_sales}}],
                        type: 'line',
                        backgroundColor: "transparent",
                        borderColor: "blue"

                    }
                ],
                labels: ['', '', '', '']
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMin: 50,
                            suggestedMax: 100
                        }
                    }]
                }
            }
        });
        /******************* unitSales graph Decision Driven *****************/


        /******************* Competitors Vs Price graph Decision Driven *****************/
        var pricing_compitision = document.getElementById('pricingvscompetition').getContext('2d');
        let price_compitision = new Chart(pricing_compitision, {
            type: 'line',
            data: {
                datasets: [
                    {
                        label: 'Red Team',
                        data: [{{$price}}],
                        type: 'line',
                        backgroundColor: "transparent",
                        borderColor: "green"

                    },
                    {
                        label: 'Green Team',
                        data: [{{$competitor}}],
                        type: 'line',
                        backgroundColor: "transparent",
                        borderColor: "blue"

                    }
                ],
                labels: {!! $pricelabel !!}
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMin: 50,
                            suggestedMax: 100
                        }
                    }]
                }
            }
        });
        /******************* Competitors Vs Price graph Decision Driven *****************/

    </script>

<script>
    $(document).ready(function(){
        $("button").click(function(){
            $.ajax({
                url: "/demo",
                success: function(result){
                    console.log(result);
                }
            });
        });
    });
</script>


<button>Get External Content</button>
</div>
