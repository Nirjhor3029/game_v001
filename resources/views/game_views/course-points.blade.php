<x-app-layout>
    <?php
    $previousUrl = "/decision-driven";
    ?>
    {{-- @section('nextUrl',$nextUrl) --}}
    @section('previousUrl',$previousUrl)

    @include('partials.subnavbar')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden" style="padding:40px;box-sizing:border-box">
                {{-- <livewire:decision-driven/> --}}

                @if (!$result_done)
                    <div class="row">
                        Result Not Process yet !!!
                    </div>
                @else
                <!--start graph -->
                    <div class="row">

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    {{--<canvas id="PieChartDicisionDriven" width="400" height="400"></canvas>--}}
                                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">
                                        Market share
                                    <p>

                                    {{-- <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{($min_max[0]['actual'])*10}}%;" aria-valuenow="{{$min_max[0]['actual']}}" aria-valuemin="0" aria-valuemax="{{$min_max[0]['max']}}">
                                            {{$min_max[0]['actual']}}%
                                        </div>
                                    </div> --}}
                                    {{-- {{$min_max[0]['max']}} --}}


                                    <div class="progress-bar-container">
                                        <progress max="{{$min_max[0]['max']}}" value="{{$min_max[0]['actual']}}"
                                                  class="html5 progress-custom">
                                        </progress>
                                        <span style="margin-left: {{$min_max[0]['actual']/2}}%"
                                              class="progress-inner-label">{{$min_max[0]['actual']}}</span>
                                    </div>
                                    <p>{{$min_max[0]['max']}}</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    {{--<canvas id="BoundaryDicisionDriven" width="400" height="400"></canvas>--}}
                                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">
                                        Revenue
                                    <p>
                                    {{-- <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{$min_max[1]['actual']}}%;" aria-valuenow="{{$min_max[1]['actual']}}" aria-valuemin="0" aria-valuemax="{{$min_max[1]['max']}}">{{$min_max[1]['actual']}}%</div>
                                    </div>
                                    {{$min_max[1]['max']}} --}}

                                    <div class="progress-bar-container">
                                        <progress max="{{$min_max[1]['max']}}" value="{{$min_max[1]['actual']}}"
                                                  class="html5 progress-custom">
                                        </progress>
                                        <span style="margin-left: {{$min_max[1]['actual']/2}}%"
                                              class="progress-inner-label">{{$min_max[1]['actual']}}</span>
                                    </div>
                                    <p>{{$min_max[1]['max']}}</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    {{--<canvas id="myChart" width="400" height="400"></canvas>--}}
                                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Cost
                                    <p>
                                    {{-- <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{$min_max[2]['actual']}}%;" aria-valuenow="{{$min_max[2]['actual']}}" aria-valuemin="0" aria-valuemax="{{$min_max[2]['max']}}">{{$min_max[2]['actual']}}%</div>
                                    </div>
                                    {{$min_max[2]['max']}} --}}

                                    <div class="progress-bar-container">
                                        <progress max="{{$min_max[2]['max']}}" value="{{$min_max[2]['actual']}}"
                                                  class="html5 progress-custom">
                                        </progress>
                                        <span style="margin-left: {{$min_max[2]['actual']/2}}%"
                                              class="progress-inner-label">{{$min_max[2]['actual']}}</span>
                                    </div>
                                    <p>{{$min_max[2]['max']}}</p>
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
                                    {{--<canvas id="unitSales" width="400" height="400"></canvas>--}}
                                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Unit
                                        sales in countries
                                    <p>

                                    {{-- <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{$min_max[3]['actual']}}%;" aria-valuenow="{{$min_max[3]['actual']}}" aria-valuemin="0" aria-valuemax="{{$min_max[3]['max']}}">{{$min_max[3]['actual']}}%</div>
                                    </div>
                                    {{$min_max[3]['max']}} --}}

                                    <div class="progress-bar-container">
                                        <progress max="{{$min_max[3]['max']}}" value="{{$min_max[3]['actual']}}"
                                                  class="html5 progress-custom">
                                        </progress>
                                        <span style="margin-left: {{$min_max[3]['actual']/2}}%"
                                              class="progress-inner-label">{{$min_max[3]['actual']}}</span>
                                    </div>
                                    <p>{{$min_max[3]['max']}}</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    {{--<h2 class="display-1">123</h2>--}}
                                    <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Net
                                        profit
                                    <p>
                                    {{-- <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{$min_max[4]['actual']}}%;" aria-valuenow="{{$min_max[4]['actual']}}" aria-valuemin="0" aria-valuemax="{{$min_max[4]['max']}}">{{$min_max[4]['actual']}}%</div>
                                    </div>
                                    {{$min_max[4]['max']}} --}}

                                    <div class="progress-bar-container">
                                        <progress max="{{$min_max[4]['max']}}" value="{{$min_max[4]['actual']}}"
                                                  class="html5 progress-custom">
                                        </progress>
                                        <span style="margin-left: {{$min_max[4]['actual']/2}}%"
                                              class="progress-inner-label">{{$min_max[4]['actual']}}</span>
                                    </div>
                                    <p>{{$min_max[4]['max']}}</p>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!--end graph -->
                @endif


            </div>
        </div>
    </div>

</x-app-layout>
