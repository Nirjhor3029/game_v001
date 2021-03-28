@extends('game_views.gm2.layout.app')

@section('content')

    <?php
    $colors = ["#4AD179", "#ED375D", "#FE8400"];
    function txtFormate($txt){
        $txt = Str::title(str_replace("_"," ",$txt));
        return $txt;
    }
    ?>

    <div class="gm2">

        <div class="header ">
            <div class="welcome mt-9vh">
                <h2 class="title">
                    Marketing Scenario
                </h2>
                <p>
                Congratulations on completing the last task on time. Please wait for your colleagues to join you in the next stage of this simulation. Thank you.
                </p>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <h4>Use the template provided in table 2 to complete table 3 for your restaurant and wait for your
                    competitor(s) to make a move!
                </h4>
            </div>

        </div>

        <div class="row">

            <!-- Attack -->
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header gm2_card_header" style="background-color: <?php echo $colors[rand(0, 2)] ?>;">
                        Attackers
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6"></div>
                            @foreach($attackersRests as $rest)
                                <div class="col-sm-2">
                                    {{txtFormate($rest['name'])}}
                                </div>
                            @endforeach
                        </div>
                    @foreach($promotions as $key => $promotion)
                    <div class="row">
                        <div class="col-sm-6">{{txtFormate($promotion['name'])}}</div>
                        @foreach($attackers as  $item)
                            <div class="col-sm-2">
                                @if($item[$key]['promotion_id'] == $promotion['id'])
                                    <input type="text" value="{{$item[$key]['value']}}" class="form-control" disabled>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    @endforeach
                    </div>
                </div>

            </div>


            <!-- Defend -->
            <div class="col-md-6">
                <form action="{{route('gm2.defend_market')}}" method="post">
                    @csrf

                    <input type="text" name="attacker_res_id" value="{{$attackersRestIds}}" hidden>
                    <input type="text" name="attackers_userId" value="{{$attackers_userId}}" hidden>
                    <div class="card gm2_card_rest defend_card">
                        <div class="card-header gm2_card_header" style="background-color: #00e5ff;">
                            <div class="row">
                                <div class="col-sm-4">
                                    {{txtFormate($defendMarket->restaurant->name)}}
                                    <input type="text" value="{{$defendMarket->marketCost[0]->id}}"
                                           name="market_cost_id" hidden>
                                </div>
                                <div class="col-sm-4 ">
                                    Defend Budget: <span
                                        id="defend_cost">{{$defendMarket->marketCost[0]->competitors_move}}</span>
                                </div>
                                <div class="col-sm-4 go-right">
                                    <span class="gm2-total-text">Total: </span>
                                    <span class="gm2-total-value">0</span>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-4 ">
                                    Defend
                                </div>
                            </div>

                            @foreach($promotions as $key => $promotion)
                                @php
                                    $promotion = (object) $promotion;
                                @endphp

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="" class="col-form-label">
                                            {{txtFormate($promotion->name)}}
                                            <input type="text" name="promotion_ids[]" class="form-control " id=""
                                                   value="{{$promotion->id}}" hidden>
                                        </label>
                                    </div>

                                    <div class="col-sm-4">
                                        @if($defendMarketPromotions->isEmpty())
                                            <input type="number" name="promotion_values[]"
                                                   class="form-control defends_option " id="" value="0">
                                        @else
                                            <input type="number" name="promotion_values[]"
                                                   class="form-control defends_option " id=""
                                                   value="{{$defendMarketPromotions[$key]->value}}" readonly>
                                        @endif
                                    </div>
                                </div>
                            @endforeach


                        </div>

                        <div class="card-footer">

                            <input type="submit" value="Defend"
                                   class="btn btn-success" {{($defendMarketPromotions->isEmpty())? "": "disabled"}}>
                        </div>

                    </div>
                </form>

            </div>


        </div>

        <div class="next mb-3rem">
            <div class="row ">
                <div class="col-sm-10"></div>
                <div class="col-sm-2">
                    <a href="{{route('gm2.result')}}" class="btn btn-next" >Next</a>
                </div>
            </div>
        </div>
    </div>

@endsection
