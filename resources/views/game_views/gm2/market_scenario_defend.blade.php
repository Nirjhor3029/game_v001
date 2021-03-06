@extends('game_views.gm2.layout.app')

@section('content')

<?php

use App\Models\Restaurant;

$restaurants = $graphItems;
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

            <div class="card gm2_card_rest">
                <div class="card-header gm2_card_header" style="background-color: <?php echo $colors[rand(0,2)] ?>;">
                    <div class="row">
                        <div class="col-sm-8">
                            <?php 
                                // $item = Restaurant::find($restaurant->rest_id);
                            ?>
                            Burger King
                        </div>
                        <div class="col-sm-4 go-right">
                            <span class="gm2-total-text">Total: </span>
                            <span class="gm2-total-value">21</span>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 ">Attack</div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Discount within
                                store</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="10">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Discount through Delivery
                                services</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="0">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Advertising through social media</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="2">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Branding</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="4">
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Other</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="5">
                        </div>
                       
                    </div>


                </div>
            </div>



            <div class="card gm2_card_rest">
                <div class="card-header gm2_card_header" style="background-color: <?php echo $colors[rand(0,2)] ?>;">
                    <div class="row">
                        <div class="col-sm-8">
                            <?php 
                                // $item = Restaurant::find($restaurant->rest_id);
                            ?>
                            Burger King
                        </div>
                        <div class="col-sm-4 go-right">
                            <span class="gm2-total-text">Total: </span>
                            <span class="gm2-total-value">21</span>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 ">Attack</div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Discount within
                                store</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="10">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Discount through Delivery
                                services</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="0">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Advertising through social media</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="2">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Branding</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="4">
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Other</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="5">
                        </div>
                       
                    </div>


                </div>
            </div>


            <div class="card gm2_card_rest">
                <div class="card-header gm2_card_header" style="background-color: <?php echo $colors[rand(0,2)] ?>;">
                    <div class="row">
                        <div class="col-sm-8">
                            <?php 
                                // $item = Restaurant::find($restaurant->rest_id);
                            ?>
                            Burger King
                        </div>
                        <div class="col-sm-4 go-right">
                            <span class="gm2-total-text">Total: </span>
                            <span class="gm2-total-value">21</span>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 ">Attack</div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Discount within
                                store</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="10">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Discount through Delivery
                                services</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="0">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Advertising through social media</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="2">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Branding</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="4">
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Other</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="5">
                        </div>
                       
                    </div>


                </div>
            </div>


            <div class="card gm2_card_rest">
                <div class="card-header gm2_card_header" style="background-color: <?php echo $colors[rand(0,2)] ?>;">
                    <div class="row">
                        <div class="col-sm-8">
                            <?php 
                                // $item = Restaurant::find($restaurant->rest_id);
                            ?>
                            Burger King
                        </div>
                        <div class="col-sm-4 go-right">
                            <span class="gm2-total-text">Total: </span>
                            <span class="gm2-total-value">21</span>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 ">Attack</div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Discount within
                                store</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="10">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Discount through Delivery
                                services</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="0">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Advertising through social media</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="2">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Branding</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="4">
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Other</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="" readonly value="5">
                        </div>
                       
                    </div>


                </div>
            </div>


            
        </div>





         <!-- Defend -->
         <div class="col-md-6">
            <div class="card gm2_card_rest defend_card">
                <div class="card-header gm2_card_header" style="background-color: #00e5ff;">
                    <div class="row">
                        <div class="col-sm-8">
                            <?php 
                                // $item = Restaurant::find($restaurant->rest_id);
                            ?>
                            Pizza Hut
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
                        <div class="col-sm-4 ">Defend</div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Discount within
                                store</label>
                        </div>
                        
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Discount through Delivery
                                services</label>
                        </div>
                        
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Advertising through social media</label>
                        </div>
                       
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Branding</label>
                        </div>
                       
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Other</label>
                        </div>
                        
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="">
                        </div>
                    </div>


                </div>
            </div>
        </div>



        <!-- Defend -->
        <!-- <div class="col-md-6">
            <div class="card gm2_card_rest">
                <div class="card-header gm2_card_header" style="background-color: <?php echo $colors[rand(0,2)] ?>;">
                    <div class="row">
                        <div class="col-sm-8">
                            <?php 
                                // $item = Restaurant::find($restaurant->rest_id);
                            ?>
                        </div>
                        <div class="col-sm-4 go-right">
                            <span class="gm2-total-text">Total: </span>
                            <span class="gm2-total-value">0</span>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    <div class="row inputField_row">
                        <div class="col-md-4">
                            Reserve for Competitor’s future move
                        </div>
                        <div class="col-md-8">
                            <input type="number" value="0" class="form-control-sm form-control competitors_move"
                                disabled>
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


                </div>
            </div>
        </div> -->


    </div>

</div>

@endsection
