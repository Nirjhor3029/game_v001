@extends('game_views.gm2.layout.app')

@section('content')

    <?php
    $colors = ["#4AD179", "#ED375D", "#FE8400"];
    ?>

    <div class="gm2">

        <div class="header ">
            <div class="welcome mt-9vh">
                <h2 class="title">
                    Marketing Scenario
                </h2>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ex repellendus maxime reiciendis explicabo
                    quos
                    vel iure architecto earum, voluptatum magnam pariatur, dolores necessitatibus aliquid incidunt! Iure
                    dolorem
                    officiis ex obcaecati!
                </p>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <!-- <h4>Use the template provided in table 2 to complete table 3 for your restaurant and wait for your
                    competitor(s) to make a move!
                </h4> -->
            </div>

        </div>

        <div class="row" style="text-align: center; margin-top:5vh">
            <div class="offset-sm-2 col-sm-6">
                <h4 style="text-align: center;text-transform: capitalize">{{$msg}}</h4>
            </div>
            
        </div>

    </div>

@endsection
