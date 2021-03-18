@extends('game_views.gm2.layout.app')

@section('content')

    <?php

    use App\Models\Restaurant;

    $colors = ["#4AD179", "#ED375D", "#FE8400"];

    $groups = ["group_1", "group_2", "group_3", "group_4",];


    ?>
    <div class="gm2">


        <div class="col-md-12 mt-9vh">
            <div class="card gm2_card_rest">
                <div class="card-header gm2_card_header" style="background-color: #ED375D;">
                    <div class="row">
                        <div class="col-sm-8">
                            Task - 1 Result
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{$taskOneResult['result']}}
                </div>

            </div>
        </div>

        <div class="col-md-12 mt-9vh">
            <div class="card gm2_card_rest">
                <div class="card-header gm2_card_header" style="background-color: #FE8400;">
                    <div class="row">
                        <div class="col-sm-8">
                            Task - 2(A) Result
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    Correct : {{$taskTwoResult['Correct']}} <br>
                    Wrong : {{$taskTwoResult['Wrong']}}
                </div>

            </div>
        </div>

        <div class="col-md-12 mt-9vh">
            <div class="card gm2_card_rest">
                <div class="card-header gm2_card_header" style="background-color: #4AD179;">
                    <div class="row">
                        <div class="col-sm-8">
                            Task - 2 (B) Result
                        </div>

                    </div>

                </div>
                <div class="card-body">
                    @if($defenderSum == 0)
                        <h1>{{$defenderSum}}%</h1>
                    @else
                        <h1>-{{$defenderSum}}%</h1>
                    @endif


                </div>

            </div>
        </div>


    </div>


@endsection