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
                    <h1>{{$taskOneResult['result']}} </h1>
                </div>

            </div>
        </div>

        

        <div class="col-md-12 mt-9vh">
            <div class="card gm2_card_rest">
                <div class="card-header gm2_card_header" style="background-color: #4AD179;">
                    <div class="row">
                        <div class="col-sm-8">
                            Task - 2  Result
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @php $sum = $defenderSum + $attackerSum; @endphp
                    @if($sum == 0)
                        <h1> (Congratulations on defending your market share!) </h1>
                    @elseif($sum > 0)
                        <h1> (Congratulations! You have gained {{$sum }} % of market share from group '{{$restUser->restaurantGroup->name}}') </h1>
                    @else
                        <h1> (Tough luck! You have lost {{ $sum }} % of market share to group'{{$restUser->restaurantGroup->name}}')</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
