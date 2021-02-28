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
                    <?php 
                    $item = Restaurant::find($restaurant->rest_id);
                ?>
                    {{$item->name}}
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
                            <select name="" id="type" name="cat_id" class="type" data-type="1">
                                <option selected>Select Areas</option>
                                @foreach($typeArea as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 subclass">
                            <select name="" id="subcategory" class="subcategory">
                            </select>
                        </div>
                        <div class="col-md-3 cost_class">
                            <input type="text" id="cost_value" class="cost_value" disabled>
                        </div>
                    </div>

                    <div class="row inputField_row">
                        <div class="col-md-3">
                            Quality
                        </div>
                        <div class="col-md-3">
                            <select name="" id="typeQuantity" class="type" data-type="2">
                                <option selected>Select Range</option>
                                @foreach($typeQuantity as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 subclass">
                            <select name="" id="typeQuantity_subcategory" class="subcategory">
                            </select>
                        </div>
                        <div class="col-md-3 cost_class">
                            <input type="number" id="typeQuantity_cost_value" class="cost_value" disabled>
                        </div>
                    </div>

                    <div class="row inputField_row">
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
                        <!-- <div class="col-md-3">
                            <select name="" id="">
                                <option selected>Select Areas</option>
                            </select>
                        </div> -->
                        <div class="col-md-3">
                            <input type="number">
                        </div>
                    </div>

                    <div class="row inputField_row">
                        <div class="col-md-4">
                            Reserve for Competitor’s future move
                        </div>
                        <div class="col-md-8">
                            <input type="number">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


    </div>




</div>

<script type="text/javascript">
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.type').on('change', function(e) {
        let that = $(this);
        let cat_id = e.target.value;
        let type = that.data('type');
        console.log(type);
        // return;
        $.ajax({
            type: "POST",
            url: "subcat",
            data: {
                cat_id: cat_id,
                type: type,

            },
            success: function(data) {
                // console.log(data); return;
                let subCat = that.parent().siblings('.subclass').children('.subcategory')
                // console.log(subCat);subCat.css("background-color", "red"); return;
                subCat.empty();
                subCat.append(
                    '<option selected>Select type</option>');
                $.each(data
                    .subcategories[0].sub_costs,
                    function(index, subcategory) {
                        subCat.append('<option data-cost="' +
                            subcategory
                            .value + '" value="' + subcategory.id + '">' +
                            subcategory.name + '</option>');
                    })

            }
        })
    });
    $('.subcategory').on('change', function(e) {

        let that = $(this);
        // console.log(that);
        let costField = that.parent().siblings('.cost_class').children('.cost_value')

        let cost = that.find(':selected').data('cost')
        costField.val(cost);
    });





    // Type quantity
    // $('#typeQuantity').on('change', function(e) {
    //     let cat_id = e.target.value;
    //     console.log(cat_id);
    //     $.ajax({
    //         type: "POST",
    //         url: "subcat",
    //         data: {
    //             cat_id: cat_id
    //         },
    //         success: function(data) {
    //             //  console.log(data);return;
    //             $('#typeQuantity_subcategory').empty();
    //             $('#typeQuantity_subcategory').append(
    //                 '<option selected>Select type</option>');
    //             $.each(data.subcategories[0].sub_costs, function(index, subcategory) {
    //                 $('#typeQuantity_subcategory').append('<option data-cost="' +
    //                     subcategory
    //                     .value + '" value="' + subcategory.id + '">' +
    //                     subcategory.name + '</option>');
    //             })

    //         }
    //     })
    // });
    // $('#typeQuantity_subcategory').on('change', function(e) {
    //     let cost = $(this).find(':selected').data('cost')
    //     $('#typeQuantity_cost_value').val(cost);
    // });
});
</script>

@endsection
