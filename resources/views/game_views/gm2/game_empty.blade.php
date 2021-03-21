@extends('game_views.gm2.layout.app')

@push('css')

@endpush

@push('js')
    <script>
        $("#sortable").sortable({
            connectWith: [".droppable"]
        });

        function shortableConfig() {
            $(".droppable").sortable({
                cursor: "move",
                connectWith: "#sortable",
                update: function (e, ui) {
                    let row = $(this).closest('tr').index();
                    let column = $(this).closest('td').index();
                    console.log(`row ${row} & column ${column}`);
                    /* each restaurant drop in every box so push restaurant Id & name array */
                    let restData = [];
                    $(this).children().each(function (idx, ele) {
                        let result = {
                            'restId': $(ele).data('tag'),
                            'restName': $(ele).data('name'),
                        }
                        restData.push(result);
                    });

                    console.dir(restData);
                    sendData(row, column, restData);
                }
            });
        }


        function sendData(graphPointRow, graphPointColumn, restData) {
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let data = {
                    graphPointRow: graphPointRow,
                    graphPointColumn: graphPointColumn,
                    restData: restData
                };
                $.ajax({
                    type: "POST",
                    url: "add_graph",
                    data: data,
                    success: function (data) {
                        // console.log(data);
                        toastr.success(data.success);
                    }
                });
            });
        }

        function titleCase(str) {
            return str.toLowerCase().split(' ').map(function (word) {
                return (word.charAt(0).toUpperCase() + word.slice(1));
            }).join(' ');
        }

        $(".ajx_select_criteria").on("change", function (e) {
            console.log("change");
            let xAxis = $('#x-axis').children("option:selected").val();
            let yAxis = $('#y-axis').children("option:selected").val();
            $.ajax({
                type: "POST",
                url: "set_student_criteria",
                data: {
                    xAxis: xAxis,
                    yAxis: yAxis,
                },
                success: function (data) {
                    console.log(data);
                    // $(this).prop("disabled", "true");
                    toastr.success(data.success);
                    //return;
                }
            });
        });

        $(document).ready(function () {

            var part = 2;
            $(".btn_part").on("click",function(){
                console.log(part);
                if(part == 2){
                    let ajxSelect = $(".ajx_select_criteria");
                    if(ajxSelect[0].value == 0 || ajxSelect[1].value == 0){
                        ajxSelect.addClass("borderRed");
                        toastr.error("Select Criteria");
                        return;
                    }
                    else{
                        $(".part_2").removeClass("invisible");
                        ajxSelect.removeClass("borderRed");
                        part++;
                    }

                }
                else if(part == 3){
                    let numberOfGroup = $("#gm2_number_of_group");
                    console.log(numberOfGroup.val());

                    if(numberOfGroup.val() == 0){
                        numberOfGroup.addClass("borderRed");
                        toastr.error("Select Number OF Group");
                        return;
                    }else{
                        $(".part_3").removeClass("invisible");
                        numberOfGroup.removeClass("borderRed");
                        part++;
                    }
                    console.log("else");
                }
                else if(part == 4){
                    let jquery_drop_box  = $(".jquery_drop_box");
                    if(gm2NumberOfGrapchBox > 0){
                        toastr.error("Pick Groups");
                        jquery_drop_box.addClass("borderRed");
                        return;
                    }else{
                        $(".part_4").removeClass("invisible");
                        $(".part_5").removeClass("invisible");
                        $(this).addClass("invisible");
                        jquery_drop_box.removeClass("borderRed");
                    }
                }

                // console.log("click");
            });



            var gm2NumberOfGrapchBox_selected = 0;
            let tmpPoint = 0;
           

            gm2NumberOfGrapchBox_selected = $(".droppable").length - 1;
            // console.log(gm2NumberOfGrapchBox_selected);
            let gm2_number_of_group = $("#gm2_number_of_group").val(gm2NumberOfGrapchBox_selected);

            // Game page
            var gm2NumberOfGrapchBox = 0;

            $('#gm2_number_of_group').on('change', function (e) {
                let that = $(this);
                let numberOfBox = that.find(':selected').val();
                let gm2_select_group_txt = $('#gm2_select_group_txt');
                let empty2 = $('.empty2');
                gm2_select_group_txt.text("Select " + numberOfBox + " boxes from the chart.");
                empty2.addClass("jquery_dragdrop_box");
                empty2.removeClass("droppable");
                // $('.empty2').addClass("jquery_droppable");

                gm2NumberOfGrapchBox = numberOfBox - gm2NumberOfGrapchBox_selected;
                console.log("gm2NumberOfGrapchBox: " + gm2NumberOfGrapchBox);
            });


            $('.jquery_drop_box').on("click", function (e) {
                let that = $(this);
                console.log(that);

                if (gm2NumberOfGrapchBox > 0) {
                    gm2NumberOfGrapchBox--;
                    // that.addClass('jquery_selected_box droppable');
                    that.append(setDroppableCard(e).removeClass("invisible")).removeClass('jquery_dragdrop_box');
                    console.log(that);
                }
                if (gm2NumberOfGrapchBox == 0) {
                    $('.empty2').removeClass('jquery_dragdrop_box');
                }

                $(".droppable").sortable({
                    cursor: "move",
                    connectWith: "#sortable",
                    update: function (e, ui) {
                        let row = $(this).closest('tr').index();
                        let column = $(this).closest('td').index();
                        console.log(`row ${row} & column ${column}`);
                        /* each restaurant drop in every box so push restaurant Id & name array */
                        let restData = [];
                        $(this).children().each(function (idx, ele) {
                            let result = {
                                'restId': $(ele).data('tag'),
                                'restName': $(ele).data('name'),
                            }
                            restData.push(result);
                        });

                        console.dir(restData);
                        sendData(row, column, restData);
                    }
                });
            });


            // $(".droppable").sortable({
            //         cursor: "move",
            //         connectWith: "#sortable",
            //         update: function (e, ui) {
            //             let row = $(this).closest('tr').index();
            //             let column = $(this).closest('td').index();
            //             console.log(`row ${row} & column ${column}`);
            //             /* each restaurant drop in every box so push restaurant Id & name array */
            //             let restData = [];
            //             $(this).children().each(function (idx, ele) {
            //                 let result = {
            //                     'restId': $(ele).data('tag'),
            //                     'restName': $(ele).data('name'),
            //                 }
            //                 restData.push(result);
            //             });

            //             console.dir(restData);
            //             sendData(row, column, restData);
            //         }
            //     });

            shortableConfig();
        });
    </script>

@endpush

@section('content')

    <?php $mimnus_data = [];?>
    <div class="gm2">

        <div class="header mt-9vh" style="height: 20vh">
            <div class="welcome">
                <h2 class="title">
                    Simluation
                </h2>
                <p>
                    Based on the information provided in table 1, group restaurants on any two dimensions of your choice. However, those two dimensions, when combined together, would have to make a strong business case in order to distinguish themselves from others.
                </p>
                {{-- <ol style="margin-left: 6rem;">
                    <li class="part_1">Choice of dimensions</li>
                    <li class="invisible part_2">Number of groups</li>
                    <li class="invisible part_3">Pick groups</li>
                    <li class="invisible part_4">Drag and drop</li>
                </ol> --}}
                {{-- <p class="invisible part_4">
                    Please drag and drop the restaurants in each group from the left as per your choice to create strategic groups for restaurants in Dhaka.
                </p> --}}
            </div>
            <div class="video invisible">
                <!-- <video width="400" controls>
                <source src="mov_bbb.mp4" type="video/mp4">
                <source src="mov_bbb.ogg" type="video/ogg">
                Your browser does not support HTML video.
                </video> -->
                <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY">
                </iframe>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"
                     style="padding:40px;box-sizing:border-box">
                    @php
                        $rest_icons = ["diet","french-fries","hamburger","healthy-eating"];
                    @endphp
                    <div class="row mt-9vh">
                        <div class="col-md-2">
                            <div>
                                <div id="sortable" class="part_4 invisible" style="min-height: 600px;">
                                    @foreach($restaurants as $restaurant)
                                        @if(!in_array(trim($restaurant->id),$mimnus_data))
                                            <?php $url = $rest_icons[rand(0, 3)] ?>
                                            <div data-tag="{{$restaurant->id}}" data-name="{{$restaurant->name}}"
                                                 draggable="true"
                                                 class="option-item bg-light badge badge-pill">
                                                <img src="{{asset('assets/icons/'.$url.'.svg')}}" alt=""
                                                     class="rest_icon">
                                                <span class="res_name">{{Str::title($restaurant->name)}}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="select_box invisible part_2">
                                How many groups You want to create
                                <div class="row">
                                    <select class="form-control offset-sm-4 col-sm-3" id="gm2_number_of_group">
                                        <option value="0" selected>Select</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <p id="gm2_select_group_txt" class="gm2_select_group_txt"></p>
                                </div>
                            </div>

                            <div class="left-side-container">
                                <div class="row">
                                    <div class="col-sm-4 graph_txt">High</div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4"></div>
                                </div>

                                <div class="flex">
                                    <!-- <h1>Price</h1> -->
                                    <select name="" id="y-axis"
                                            class="form-control form-control-sm select_criteria ajx_select_criteria"
                                            data-type="1">
                                        <option selected value="0">Select criteria</option>
                                        @foreach($gType as $item)
                                            <option value="{{$item['id']}}"
                                                    class="" {{(optional($graphLevel)->y_level==$item['id'])? "selected":""}}>{{$item['name']}}
                                            </option>
                                        @endforeach
                                    </select>


                                    <div class="chart">
                                        <div class="table-responsive">
                                            <table class="dragdrop_graph " id="">
                                                <tr>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                </tr>
                                                <tr>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                </tr>
                                                <tr>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                </tr>
                                                <tr>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                </tr>
                                                <tr>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                    <td class="empty2 jquery_drop_box"></td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col-sm-4 graph_txt">
                                            Low
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <select name="" id="x-axis"
                                                    class="form-control form-control-sm ajx_select_criteria"
                                                    data-type="2">
                                                <option selected value="0">Select criteria</option>
                                                @foreach($gType as $item)
                                                    <option
                                                        value="{{$item['id']}}" {{(optional($graphLevel)->x_level==$item['id'])? "selected":""}} >{{$item['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4 txt-center">
                                            High
                                        </div>
                                    </div>
                                    <!-- <h1 class="txt_xaxis">Level of vertical Integration</h1> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="next mb-3rem">
                        <div class="row ">
                            <div class="col-sm-10"></div>
                            <div class="col-sm-2">
                                <a href="javascript:void(0)" class="btn btn-next float-right btn_part btn_next_part ">Next</a>
                                <a href="{{route('gm2.marketing_strategy')}}" class="btn btn-next float-right invisible part_5">Next</a>
                                <!-- <a href="{{route('gm2.game')}}" class="btn btn-next" >Next</a> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- DemoDroppableCard -->
    <div class="card dropBox invisible">
        <div class="card-header" style="text-align: center;padding:0px !important"></div>
        <div class="card-body droppable dropBody ui-sortable" data-tag="" data-name="" style="padding-left: 5px !important;">

        </div>
    </div>


    <!-- option-item-demo -->
    <div data-tag="" data-name="" draggable="true" class="demo_option_item option-item bg-light badge badge pill invisible">
        <?php $url = $rest_icons[rand(0, 3)] ?>
        <img src="{{asset('assets/icons/'.$url.'.svg')}}" alt="" class="rest_icon">
        <span class="res_name">
        </span>
    </div>

    <div class="sticky-popup-box invisible part_4">
        <p>
            Please drag and drop the restaurants in each group from the left as per your choice to create strategic groups for restaurants in Dhaka.
        </p>
    </div>

@endsection
