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
                <h4>Use the template provided in table 2 to complete table 3 for your restaurant and wait for your
                    competitor(s) to make a move!
                </h4>
            </div>

        </div>

        <div class="row">

            <!-- Attack -->
            <div class="col-md-6 attack_box">

                <?php
                $attackerRestId = [];
                ?>

                @foreach($attackMarkets as $item)

                    <?php
                    $attackerRestId[] = $item->restaurant_id;

                    ?>
                    <div class="card gm2_card_rest">
                        <div class="card-header gm2_card_header"
                             style="background-color: <?php echo $colors[rand(0, 2)] ?>;">
                            <div class="row">
                                <div class="col-sm-8">
                                    {{$item->restaurant->name}}
                                </div>

                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4 ">Attack</div>

                            </div>
                            @php
                                $innerAttack = 0;
                            @endphp
                            @foreach($promotions as $key => $promotion)
                                @php
                                    $promotion = (object) $promotion;

                                @endphp

                                @if($promotion->id == $item->marketCost[0]->gm2MarketPromotion[$key]->promotion_id )

                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="" class="col-form-label">
                                                {{$promotion->name}}
                                            </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="" readonly
                                                   value="{{$item->marketCost[0]->gm2MarketPromotion[$key]->value}}">
                                            @php
                                                $innerAttack = $innerAttack + $item->marketCost[0]->gm2MarketPromotion[$key]->value;
                                            @endphp

                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="offset-sm-8 col-sm-4 go-right">
                                    <span class="gm2-total-text">Total: </span>

                                    <span class="gm2-total-value">{{$innerAttack}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <?php
                $attackerRestId = implode(",", $attackerRestId);

                ?>
            </div>


            <!-- Defend -->
            <div class="col-md-6">
                <form action="{{route('gm2.defend_market')}}" method="post">
                    @csrf

                    <input type="text" name="attacker_res_id" value="{{$attackerRestId}}" hidden>
                    <div class="card gm2_card_rest defend_card">
                        <div class="card-header gm2_card_header" style="background-color: #00e5ff;">
                            <div class="row">
                                <div class="col-sm-4">
                                    {{$defendMarket->restaurant->name}}
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
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4 ">
                                    Defend
                                </div>
                            </div>

                            @foreach($promotions as $key => $promotion)
                                @php
                                    $promotion = (object) $promotion;
                                @endphp

                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="" class="col-form-label">
                                            {{$promotion->name}}
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
                                                   value="{{$defendMarketPromotions[$key]->value}}" disabled>
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

    </div>

@endsection
