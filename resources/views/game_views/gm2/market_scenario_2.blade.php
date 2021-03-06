@extends('game_views.gm2.layout.app')

@section('content')

<?php

use App\Models\Restaurant;

$restaurants = $graphs;
$colors = ["#4AD179", "#ED375D", "#FE8400"];

    $groups = ["group_1","group_2","group_3","group_4",];

    
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
        <div class="offset-md-3 col-md-6 market_scenario_table_box">
            <div>
                <h3 class="text-center">Table 2</h3>
            </div>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" colspan="4" class="text-center">Cost of Additional Outlet with
                            everything as it is <br>(in millions)
                        </th>
                        <th scope="col" colspan="4" class="text-center">Cost per outlet for offering a new
                            line
                            of product / change the quality within the existing setup
                            <br>(in millions)
                        </th>
                    </tr>
                    <tr>
                        <th>Type/Area</th>
                        <th>Tri state Areas</th>
                        <th>Mid end Area</th>
                        <th>Low end Areas</th>
                        <th>Type/Quality</th>
                        <th>High</th>
                        <th>Mid</th>
                        <th>Low</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Continental/Intl Chain</th>
                        <td>10</td>
                        <td>8</td>
                        <td>6</td>
                        <th scope="row">Continental/Intl Chain</th>
                        <td>2</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th scope="row">Fast Food</th>
                        <td>5</td>
                        <td>4</td>
                        <td>3</td>
                        <th scope="row">Fast Food</th>
                        <td>1.5</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th scope="row">Coffee/Bistro</th>
                        <td>3</td>
                        <td>2</td>
                        <td>1</td>
                        <th scope="row">Coffee/Bistro</th>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th scope="row">Desi</th>
                        <td>4</td>
                        <td>3</td>
                        <td>2</td>
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
        <h4>Use the template provided in table 2 to complete table 3 for your restaurant and wait for your
            competitor(s) to make a move!
        </h4>
    </div>




    <div class="row">


        @foreach($restaurants as $restaurant)
        <div class="col-md-6">
            <div class="card gm2_card_rest">
                <div class="card-header gm2_card_header" style="background-color: <?php echo $colors[rand(0,2)] ?>;">
                    <div class="row">
                        <div class="col-sm-8">
                            <?php 
                                $item = Restaurant::find($restaurant->rest_id);
                            ?>
                            {{$item->name}}
                            <input type="number" name="rest_id" class="rest_id" value="{{$item->id}}" hidden>
                        </div>
                        <div class="col-sm-4 go-right">
                            <span class="gm2-total-text">Total: </span>
                            <span class="gm2-total-value">0</span>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row inputField_row">
                        <div class="col-md-3">
                            Area
                        </div>
                        <div class="col-md-3">
                            <!-- <input type="button" class="btn_input btn_input_plus " value="+">
                            <input type="number" name="" id="">
                            <input type="button" class="btn_input btn_input_minus " value="-"> -->
                            <select name="" id="type" name="cat_id" class="form-control-sm form-control type"
                                data-type="1">
                                <option selected value="0">Select Areas</option>
                                @foreach($typeArea as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 subclass">
                            <select name="" id="subcategory" class="form-control-sm form-control subcategory">
                            </select>
                        </div>
                        <div class="col-md-3 cost_class">
                            <input type="text" class="form-control-sm form-control cost_value" disabled value="0">
                        </div>
                    </div>

                    <div class="row inputField_row">
                        <div class="col-md-3">
                            Quality
                        </div>
                        <div class="col-md-3">
                            <select name="" id="typeQuantity" class="form-control-sm form-control type" data-type="2">
                                <option selected value="0">Select Range</option>
                                @foreach($typeQuantity as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 subclass">
                            <select name="" id="typeQuantity_subcategory"
                                class="form-control-sm form-control subcategory">
                            </select>
                        </div>
                        <div class="col-md-3 cost_class">
                            <input type="number" id="typeQuantity_cost_value"
                                class="form-control-sm form-control cost_value" value="0" disabled>
                        </div>
                    </div>

                    <div class="gm2_market_promotion_container">

                        <div class="gm2_market_promotion_inputs">

                            <div class="row">
                                <div class="col-sm-6 bg_like_disable_input gm2_marketing_promotion_header">
                                    <h4>Marketing & Promotion</h4>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Discount within store</label>
                                        <input type="number"
                                            class="form-control-sm form-control discount_within_store ajx_input_market_promotion"
                                            id="" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Discount through Delivery services</label>
                                        <input type="number"
                                            class="form-control-sm form-control discount_through_delivery_services ajx_input_market_promotion"
                                            id="" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Advertising through social media</label>
                                        <input type="number"
                                            class="form-control-sm form-control advertising_through_social_media ajx_input_market_promotion"
                                            id="" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Branding</label>
                                        <input type="number"
                                            class="form-control-sm form-control branding ajx_input_market_promotion"
                                            id="" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Other</label>
                                        <input type="number"
                                            class="form-control-sm form-control other ajx_input_market_promotion" id=""
                                            value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- <div class="gm2_market_promotion_container">
                        <h4>Marketing & Promotion</h4>
                        <div class="gm2_market_promotion_inputs">

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="">Discount within store</label>
                                    <input type="number" class="form-control-sm form-control discount_within_store" id="" value="0">

                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Discount through Delivery services</label>
                                    <input type="number" class="form-control-sm form-control discount_through_delivery_services" id=""
                                        value="0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="">Advertising through social media</label>
                                    <input type="number" class="form-control-sm form-control advertising_through_social_media" id=""
                                        value="0">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Branding</label>
                                    <input type="number" class="form-control-sm form-control branding" id="" value="0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="">Other</label>
                                    <input type="number" class="form-control-sm form-control other" id="" value="0">
                                </div>
                            </div>
                        </div>
                    </div> -->




                    <!-- <div class="row inputField_row">
                        <div class="col-md-3">
                            Marketing & Promotion
                        </div>
                        <div class="col-md-3">
                            <select name="" id="">
                                <option selected>Select Areas</option>
                                <option value="">Discount within store</option>
                                <option value="">Discount through Delivery services</option>
                                <option value="">Advertising through social media</option>
                                <option value="">Branding</option>
                                <option value="">Other</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="number" value="0">
                        </div>
                    </div> -->

                    <div class="row inputField_row">
                        <div class="col-md-4">
                            Reserve for Competitor’s future move
                        </div>
                        <div class="col-md-8">
                            <input type="number" value="0" class="form-control-sm form-control competitors_move">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-4">
                            Attack on group:
                            
                        </div>
                        <div class="col-sm-6">
                        @foreach($groups as $group)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="" name="attack_group" value="{{$group}}">
                            <label class="form-check-label" for="">{{$group}}</label>
                        </div>
                        @endforeach
                        </div>
                        <div class="col-sm-2">
                            
                            <input type="submit" value="Attack" class="  btn btn-success">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        @endforeach


    </div>

</div>

@endsection
