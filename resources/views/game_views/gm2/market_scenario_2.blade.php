@extends('game_views.gm2.layout.app')



@section('content')

    <?php

    // $restaurants = $restaurant;
    $colors = ["#4AD179", "#FE8400"];
    // $groups = ["group_1", "group_2", "group_3", "group_4",];
    function txtFormate($txt){
        $txt = Str::title(str_replace("_"," ",$txt));
        return $txt;
    }

    $userId = Auth::id();
    $colorIndex = 0;
    if($userId % 2 ==0){
        $colorIndex = 1;
    }

    ?>

    <div class="gm2">

        <div class="header ">
            <div class="welcome">
                <h2 class="title">
                    Marketing Scenario
                </h2>
                <p>
                    You have a budget of BDT 20 millions to spend to move to a new strategic group which offers you
                    additional profit without damaging your current brand value.
                </p>
                <p>
                    Use table 2 and 3 to identify costs associated with setting up new outlets and developing
                    infrastructure to offer new menu respectively to expand your business.
                </p>
                <p>
                    You must open at least one additional outlet and spend a minimum of BDT 3 million in marketing and
                    promotional activities to penetrate the new segment.
                    Please note that your competitors in the same group you are trying to penetrate might also a budget
                    to defend their market share should they deem any credible threat is about to enter into their
                    domain.
                </p>
                <p>
                    Before moving to decide how to attack another group consult table 4 to understand which mode of
                    attack may give you the best return in terms of gaining market share.
                </p>
            </div>
        </div>


        <div class="row">
            <!-- Table-2 -->
            <div class="col-md-6 col-sm-6 col-lg-6 market_scenario_table_box">
                <div>
                    <h3 class="text-center">Table 2</h3>
                </div>
                <table class="table table-responsive table-hover table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" colspan="4" class="text-center">Cost of Additional Outlet</th>
                    </tr>
                    <tr>
                        <th>Type/Area</th>
                        <th>Tri state Areas</th>
                        <th>Mid end Area</th>
                        <th>Low end Areas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Continental</th>
                        <td>10</td>
                        <td>8</td>
                        <td>6</td>
                    </tr>
                    <tr>
                        <th scope="row">Fast Food</th>
                        <td>5</td>
                        <td>4</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <th scope="row">Coffee/Bistro</th>
                        <td>3</td>
                        <td>2</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th scope="row">Desi</th>
                        <td>4</td>
                        <td>3</td>
                        <td>2</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Table-3 -->
            <div class="col-md-6 col-sm-6 col-lg-6 market_scenario_table_box">
                <div>
                    <h3 class="text-center">Table 3</h3>
                </div>
                <table class="table table-responsive table-hover table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" colspan="4" class="text-center">Cost per outlet for offering a new line of
                            product
                        </th>
                    </tr>
                    <tr>
                        <th>Type/Quality</th>
                        <th>High</th>
                        <th>Mid</th>
                        <th>Low</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Continental/Intl Chain</th>
                        <td>2</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th scope="row">Fast Food</th>
                        <td>1.5</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th scope="row">Coffee/Bistro</th>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th scope="row">Desi</th>
                        <td>1</td>
                        <td>0.5</td>
                        <td>0.5</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <h4>Use the template provided in table 2 & 3 to complete table 5 for your restaurant and wait for your
                competitor(s) to make a move!
            </h4>
        </div>

        <div class="row">

            <div class="col-md-6 col-sm-6 col-lg-6 market_scenario_table_box table_4" >
                <div>
                    <h3 class="text-center">Table 4</h3>
                </div>
                <table class="table table-responsive table-hover table-bordered">
                    <thead>
                    {{--  <tr>
                        <th scope="col" colspan="4" class="text-center">
                             $ required to gain 1% market share
                         </th>
                    </tr>--}}
                    <tr>
                        <th>Mode of Attack/Defend</th>
                        <th>$ required to gain 1% group market share(per year)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Discount within store</th>
                        <td>3.5</td>

                    </tr>
                    <tr>
                        <th scope="row">Discount through delivery services</th>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th scope="row">Advertising through social media</th>
                        <td>2.5</td>
                    </tr>
                    <tr>
                        <th scope="row">Branding</th>
                        <td>5</td>
                    </tr>
                    <tr>
                        <th scope="row">Others</th>
                        <td>8</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            @if(is_null($market))


            <div class="col-md-6">
                <div class="card gm2_card_rest">

                    <div class="card-header gm2_card_header"
                         style="background-color: <?php echo $colors[$colorIndex] ?>;">
                        <div class="row">
                            <div class="col-sm-6">
                                {{txtFormate($resGroup->restaurant->name)}} ({{txtFormate($resGroup->restaurantGroup->name)}})
                                <input type="number" name="rest_id" class="rest_id"
                                       value="{{$resGroup->restaurant->id}}" hidden>
                            </div>
                            <div class="col-sm-3 go-right">
                                <span class="gm2-total-text">Max: </span>
                                <span class="">{{$investment}}</span>
                                <input type="number" value="{{$investment}}" class="max_invest" hidden>
                            </div>
                            <div class="col-sm-3 go-right">
                                <span class="gm2-total-text">Total: </span>
                                <span class="gm2-total-value">0</span>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">

                        <div class="" id="alert_invest">

                        </div>

                        <div class="row">
                                <div class="col-sm-3">
                                    Area
                                </div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-3">Number Of Outlets</div>
                                <div class="col-sm-2">Total</div>
                        </div>

                        <div class="row inputField_row">

                            <div class="col-md-3">
                                <select name="" id="type" name="cat_id" class="form-control-sm form-control type"
                                        data-type="1">
                                    <option selected value="0">Select Areas</option>
                                    @foreach($typeArea as $item)
                                        <option value="{{$item->id}}" >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 subclass">
                                <select name="" id="subcategory" class="form-control-sm form-control subcategory sub_area">
                                    <option selected value="0">Select Type</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                    <input type="number" name="" min="1"  class="form-control-sm form-control number_of_outlets" value="1">
                            </div>
                            <div class="col-md-2 cost_class">
                                <input type="text" class="form-control-sm form-control cost_value" readonly
                                       value="0"
                                       required>
                            </div>
                        </div>

                        <div class="row">
                                <div class="col-sm-3">
                                    Quality
                                </div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-2"></div>
                        </div>
                        <div class="row inputField_row quality_row">
                            <div class="col-md-3">
                                <select name="" id="typeQuantity" class="form-control-sm form-control type"
                                        data-type="2">
                                    <option selected value="0">Select Range</option>
                                    @foreach($typeQuantity as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 subclass">
                                <select name="" id="typeQuantity_subcategory"
                                        class="form-control-sm form-control subcategory">
                                    <option selected value="0">Select Type</option>
                                </select>
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-md-2 cost_class">
                                <input type="text" id="typeQuantity_cost_value"
                                       class="form-control-sm form-control cost_value" value="0" readonly required>
                            </div>
                        </div>

                        <div class="gm2_market_promotion_container">

                            <div class="gm2_market_promotion_inputs">

                                <div class="row marketing-row">
                                    <div class="col-sm-6 bg_like_disable_input gm2_marketing_promotion_header">
                                        <img src="{{asset('assets/icons/career-promotion.svg')}}" alt=""
                                             class="promotion_icon">
                                        <h4>Marketing & Promotion</h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Discount within store</label>
                                            <input type="number"
                                                   class="form-control-sm form-control discount_within_store ajx_input_market_promotion"
                                                   id="" value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Discount through Delivery services</label>
                                            <input type="number"
                                                   class="form-control-sm form-control discount_through_delivery_services ajx_input_market_promotion"
                                                    value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Advertising through social media</label>
                                            <input type="number"
                                                   class="form-control-sm form-control advertising_through_social_media ajx_input_market_promotion"
                                                    value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Branding</label>
                                            <input type="number"
                                                   class="form-control-sm form-control branding ajx_input_market_promotion"
                                                    value="0" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Other</label>
                                            <input type="number"
                                                   class="form-control-sm form-control other ajx_input_market_promotion"

                                                   value="0" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row inputField_row">
                            <div class="col-md-4">
                                Reserve for Competitor’s future move
                            </div>
                            <div class="col-md-8">
                                <input type="number" value="{{$investment}}" readonly
                                       class="form-control-sm form-control competitors_move" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">


                        <div class="row">
                            <div class="col-sm-3">
                                Attack on group:

                            </div>
                            <div class="col-sm-6">

                                @foreach($restaurantGroups as $group)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="" name="attack_group"
                                               value="{{$group->id}}" required>
                                        <label class="form-check-label" for="">{{$group->name}}</label>
                                    </div>
                                @endforeach
                                <!-- <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="" name="attack_group"
                                               value="" checked>
                                        <label class="form-check-label" for="">None</label>
                                </div> -->
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" id="attack" class="attack go-right  btn btn-success">
                                    <img src="{{asset('assets/icons/battle.svg')}}" alt="" class="btn_attack_icon">
                                    Attack
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @else

            <?php
            $subAreaType = $market->marketCost[0]->area_sub_type;
            $subQuantityType = $market->marketCost[0]->quality_sub_type;
            // echo $subAreaType;
            ?>
            @push("js")
                <script>
                    $(document).ready(function(){
                        $("#typeArea").trigger("change",[{{$subAreaType}}]);
                        $("#typeQuantity").trigger("change",[{{$subQuantityType}}]);


                    });
                </script>
            @endpush
                <div class="col-md-6">
                    <div class="card gm2_card_rest">
                        <div class="card-header gm2_card_header"
                             style="background-color: <?php echo $colors[$colorIndex] ?>;">
                            <div class="row">
                                <div class="col-sm-6">
                                    {{txtFormate($resGroup->restaurant->name)}} ({{txtFormate($resGroup->restaurantGroup->name)}})
                                    <input type="number" name="rest_id" class="rest_id"
                                           value="{{$resGroup->restaurant->id}}" hidden>
                                </div>
                                <div class="col-sm-3 go-right">
                                    <span class="gm2-total-text">Max: </span>
                                    <span class="">{{$investment}}</span>
                                    <input type="number" value="{{$investment}}" class="max_invest" hidden>
                                </div>
                                <div class="col-sm-3 go-right">
                                    <span class="gm2-total-text">Total: </span>
                                    <span class="gm2-total-value">{{($market->total_cost - $market->marketCost[0]->competitors_move)}}</span>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">

                            <div class="" id="alert_invest">

                            </div>


                            <div class="row">
                                <div class="col-sm-3">
                                    Area
                                </div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-3">Number Of Outlets</div>
                                <div class="col-sm-2">Total</div>
                            </div>
                            <div class="row inputField_row">
                                <div class="col-md-3">
                                    <!-- <input type="button" class="btn_input btn_input_plus " value="+">
                                    <input type="number" name="" id="">
                                    <input type="button" class="btn_input btn_input_minus " value="-"> -->
                                    <select name="" id="typeArea" name="cat_id" class="form-control-sm form-control type"
                                            data-type="1" >
                                        <option selected value="0">Select Areas</option>
                                        @foreach($typeArea as $item)
                                            <option value="{{$item->id}}" {{($market->marketCost[0]->area_type == $item->id)? "selected":""}} >{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 subclass">
                                    <select name="" id="subcategory" class="form-control-sm form-control subcategory">
                                        <option selected value="0">Select Type</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name=""  class="form-control-sm form-control number_of_outlets" value="{{$market->marketCost[0]->number_of_outlets}}" min="1">
                                </div>
                                <div class="col-md-2 cost_class">
                                    <input type="text" class="form-control-sm form-control cost_value" readonly value="{{$market->marketCost[0]->area}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    Quality
                                </div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-2"></div>
                            </div>
                            <div class="row inputField_row">
                                <div class="col-md-3">
                                    <select name="" id="typeQuantity" class="form-control-sm form-control type"
                                            data-type="2">
                                        <option selected value="0">Select Range</option>
                                        @foreach($typeQuantity as $item)
                                            <option value="{{$item->id}}" {{($market->marketCost[0]->quality_type == $item->id)? "selected":""}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 subclass">
                                    <select name="" id="typeQuantity_subcategory"
                                            class="form-control-sm form-control subcategory">
                                        <option selected value="0">Select Type</option>
                                    </select>
                                </div>
                                <div class="col-sm-3"></div>
                                <div class="col-md-2 cost_class">
                                    <input type="text" id="typeQuantity_cost_value"
                                           class="form-control-sm form-control cost_value" value="{{$market->marketCost[0]->quality}}" readonly required>
                                </div>
                            </div>

                            <div class="gm2_market_promotion_container">

                                <div class="gm2_market_promotion_inputs">

                                    <div class="row marketing-row">
                                        <div class="col-sm-6 bg_like_disable_input gm2_marketing_promotion_header">
                                            <img src="{{asset('assets/icons/career-promotion.svg')}}" alt=""
                                                 class="promotion_icon">
                                            <h4>Marketing & Promotion</h4>
                                        </div>
                                        <div class="col-sm-6">
                                            @foreach($market->marketCost[0]->gm2MarketPromotion as $key=> $marketPromotion)
                                            <div class="form-group">
                                                <label for="" >{{ txtFormate($promotion_options[$key]['name'])}}</label>
                                                <input type="number"
                                                       class="form-control-sm form-control discount_within_store ajx_input_market_promotion"
                                                        value="{{$marketPromotion->value}}" min="0">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row inputField_row">
                                <div class="col-md-4">
                                    Reserve for Competitor’s future move
                                </div>
                                <div class="col-md-8">
                                    <input type="number" value="{{$market->marketCost[0]->competitors_move}}" readonly
                                           class="form-control-sm form-control competitors_move">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">


                            <div class="row">
                                <div class="col-sm-3">
                                    Attack on group:

                                </div>
                                <div class="col-sm-6">
                                    @foreach($restaurantGroups as $group)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="" name="attack_group"
                                                   value="{{$group->id}}" {{($group->id == $resturentUser->rest_group_id  )? "checked":""}} required>
                                            <label class="form-check-label" for="">{{$group->name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" id="attack" class="attack go-right  btn btn-success">
                                        <img src="{{asset('assets/icons/battle.svg')}}" alt="" class="btn_attack_icon">
                                        Attack
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="next mb-3rem">
            <div class="row ">
                <div class="col-sm-10"></div>
                <div class="col-sm-2">
                    <a href="{{route('gm2.market_scenario_defend')}}" class="btn btn-next" >Next</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="attackModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    test
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
