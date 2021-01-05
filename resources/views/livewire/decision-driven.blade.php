<div>
{{-- Success is as dangerous as failure. --}}
@section('nextUrl',$nextUrl)
@section('previousUrl',$previousUrl)
<!--start graph 1st row -->
    <div class="row">
        {{-- Market Share --}}
        <div class="col-md-4">
            {{-- @livewire('chart.decison-driven-market-share') --}}
            {{-- <livewire:chart.decison-driven-market-share/> --}}
            {{-- {{$MARKET_TOTAL_SELL_VALUE}} --}}

            <div>
                <div class="card">
                    <div class="card-body">
                        <canvas id="PieChartDicisionDriven" width="400" height="400"></canvas>

                        <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Market share

                        <p>
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
                                <select class="custom-select" id="marketPlace" onchange="updateRevenueChart()">
                                    <option value="0" selected>Marketplace...</option>
                                    @foreach ($marketPlaces as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                    <option value="0">All</option>
                                </select>
                            </div>
                        </div>
                        {{--<div class="col-md-4">
                            <div class="input-group mb-3">
                                --}}{{-- <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                </div> --}}{{--
                                <select class="custom-select" id="product" wire:model="selectedMarketPlace">
                                    <option value="0" selected>Product...</option>
                                    @foreach ($products as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                    <option value="0">All</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                --}}{{-- <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                </div> --}}{{--
                                <select class="custom-select" id="month">
                                    <option value="0" selected >months...</option>
                                    @foreach ($months as $item)
                                        <option value="{{$item}}">Months {{$item}}</option>
                                    @endforeach
                                    <option value="0">All</option>
                                </select>
                            </div>
                        </div>--}}
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="BoundaryDicisionDriven" width="400" height="400"></canvas>
                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">
                        Revenue {{$selectedMarketPlace}} / {{$bn_total_revenue}} <p>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart" width="400" height="400"></canvas>
                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Cost

                    <p>
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
                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Unit sales in
                        countries

                    <p>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <center><h2 class="display-1">{{$this->net_income}}</h2></center>
                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Net profit

                    <p>
                </div>
            </div>
        </div>

        {{-- Pricing vs. Competition Chart --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="pricingvscompetition_line" width="400" height="400"></canvas>
                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Pricing vs.
                        Competition
                    <p>
                </div>
            </div>
        </div>
        {{-- end of row --}}
    </div>

    {{-- <div class="row" style="margin-top: 25px">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="pricingvscompetition" width="400" height="150"></canvas>
                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Pricing vs.
                        Competition
                    <p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="pricingvscompetition_np" width="400" height="150"></canvas>
                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Pricing vs.
                        Competition
                    <p>
                </div>
            </div>
        </div>
    </div> --}}
    <!--end graph -->

    <div class="row" style="margin-top: 25px">
        {{-- Pricing vs. Competition Chart --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="pricingvscompetition_bd_bar" width="400" height="300"></canvas>
                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:16px">
                        <span style="font-size:22px">
                            Bangladesh:
                        </span>
                        Pricing vs. Competition
                    <p>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="pricingvscompetition_np_bar" width="400" height="300"></canvas>
                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:16px">
                        <span style="font-size:22px">
                            Nepal:
                        </span>
                        Pricing vs. Competition
                    <p>
                </div>
            </div>
        </div>
    </div>


    <div class="row submit_btn_container">
        {{-- <a href="{{ route('submitGame') }}"> --}}
            <Button class="submit_btn lnr lnr-arrow-right white " onclick="popup()">Submit</Button>
        {{-- </a> --}}
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Finish The Game</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <img src="https://freedesignfile.com/upload/2017/12/Alert-Icon.jpg" class="alert_img" alt="">
                        </div>
                        <div class="col-sm-10">
                            After Submit your result you'll <b>redirect to dashboard</b>. <br>
                            And you <b>can not edit</b>  this game ans.
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{ route('submitGame') }}">
                        <button type="button" class="btn btn-primary">Confirm</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function popup() {
            // alert("Can’t insert any value here.This is inconsistent to the case.");
            $('#exampleModal').modal('show');
        }
    </script>


    <script>
        var piechartdicision = document.getElementById('PieChartDicisionDriven').getContext('2d');
        var myPieChart = new Chart(piechartdicision, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [{{$marketShareValues[0]}}, {{$marketShareValues[1]}}, {{$marketShareValues[2]}}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
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
                            // beginAtZero: false,
                            min: 1,
                            max:{{$MARKET_TOTAL_SELL_VALUE}},
                        },
                        gridLines: {
                            // display: true,
                            // drawOnChartArea: false,
                            // drawTicks: false,
                        }
                    }],
                    
                    
                },

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
                    // barThickness: 50,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
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
                            beginAtZero: true,
                            display: false
                        },
                        gridLines: {
                            display: true
                        }
                    }]
                },
                title: {
                    display: false,
                    text: 'Custom Chart Title',
                    position: 'bottom'
                }
            },

        });
        /******************* revenue Decision Driven *****************/


        /******************* cost graph Decision Driven *****************/
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Bangladesh', 'Nepal'],
                datasets: [
                    {
                        label: 'Total Production Cost',
                        data: [{{$bn_total_cost}}, {{$np_total_cost}}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',

                        ],
                        borderWidth: 1
                    },
                    
                
                ],
                
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            // display: true,
                            drawOnChartArea: false,
                            // drawTicks: false,
                        }
                        
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            // display: true,
                            drawOnChartArea: false,
                            // drawTicks: false,
                        }
                        
                    }],
                    
                },
            }
        });
        /******************* cost graph Decision Driven-end *****************/


        /******************* unitSales graph Decision Driven *****************/
        var unitSales = document.getElementById('unitSales').getContext('2d');
        let compitision = new Chart(unitSales, {
            type: 'line',
            data: {
                datasets: [
                    {
                        label: 'Bangladesh',
                        data: [{{$bn_unit_sales}}],
                        type: 'line',
                        backgroundColor: "transparent",
                        borderColor: "green"

                    },
                    {
                        label: 'Nepal',
                        data: [{{$np_unit_sales}}],
                        type: 'line',
                        backgroundColor: "transparent",
                        borderColor: "blue"

                    }
                ],
                labels: {!! $unitSalesLabel !!}
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
        var pricingvscompetition_line = document.getElementById('pricingvscompetition_line').getContext('2d');
        let price_compitision_line = new Chart(pricingvscompetition_line, {
            type: 'line',
            data: {
                datasets: [
                    {
                        label: 'Price',
                        data: [{{$price}}],
                        type: 'line',
                        backgroundColor: "transparent",
                        borderColor: "green"

                    },
                    {
                        label: 'Competitors price',
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
        /******************* Competitors Vs Price graph Decision Driven-end *****************/

        // console.log({{$price}});
        /******************* cost graph Decision Driven *****************/

        


        // Test
        var pricingvscompetition_bd_bar = document.getElementById('pricingvscompetition_bd_bar').getContext('2d');
        var price_compitision_bd_bar = new Chart(pricingvscompetition_bd_bar, {
            type: 'bar',
            data: {
                labels: ['A', 'B'],
                datasets: [
                    {
                        label: "Price",
                        barThickness:25,
                        backgroundColor: "rgba(54, 162, 235, 0.8)",
                        data: [{{$price_bd}}]
                    },
                    {
                        label: "Comp Price",
                        barThickness:20,
                        backgroundColor: "rgba(255, 99, 132, 0.8)",
                        data: [{{$compt_bd}}]
                    },
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // nepal
        var pricingvscompetition_np_bar = document.getElementById('pricingvscompetition_np_bar').getContext('2d');
        var price_compitision_np_bar = new Chart(pricingvscompetition_np_bar, {
            type: 'bar',
            data: {
                labels: ['A', 'B'],
                datasets: [
                    {
                        label: "Price",
                        barThickness:25,
                        backgroundColor: "rgba(54, 162, 235, 0.8)",
                        data: [{{$price_np}}]
                    },
                    {
                        label: "Comp Price",
                        barThickness:25,
                        backgroundColor: "rgba(255, 99, 132, 0.8)",
                        data: [{{$compt_np}}]
                    },
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    </script>

    <script>

        function updateRevenueChart() {
            $.ajax({
                url: "/update-revenue-chart/" + $("#marketPlace").val() + "/" + 1 + "/" + 1,
                success: function (result) {
                    console.log(result.data);
                    mylineChart.data = {
                        labels: result.data.labels,
                        datasets: [{
                            label: result.data.chart_label,
                            data: result.data.values,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.8)',
                                'rgba(54, 162, 235, 0.8)',

                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',

                            ],
                            borderWidth: 2
                        }]
                    }
                    mylineChart.update();
                }
            });
        };


    </script>


</div>
