@extends('game_views.gm2.layout.app')

@push('css')

@endpush

@push('js')
    <script>


        $(document).ready(function () {
            $("#sortable").sortable({
                connectWith: [".droppable"]
            });

            function initializeShortable() {
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
                        url: "add_user_graph",
                        data: data,
                        success: function (data) {
                            console.log(data);
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


            let records = @json($rest_groups);
            let res_records = @json($records);
            records.forEach(function (ele) {
                let point = ele.point;
                let row = (String(point).slice(0, 1)) - 1;
                let col = (String(point).slice(-1)) - 1;
                $('.dragdrop_graph tr').eq(row).children(':eq(' + col + ')').append(setDroppableCard(ele).removeClass("invisible"));
                // $(".droppable").sortable();
                //    console.log(records);
                initializeShortable();
            });


            function setDroppableCard(ele) {
                // let box = $(".dropBox");
                let box = $(".dropBox").clone().removeClass("dropBox");

                let boxHeader = box.find(".card-header");
                let boxBody = box.find(".card-body");
                boxBody.data("name", ele.name);
                boxBody.data("tag", ele.id);
                boxHeader.text(ele.name);
                // console.log(box);
                return box;
            }

            res_records.forEach(function (ele) {
                let point = ele.graph_point;
                let row = (String(point).slice(0, 1)) - 1;
                let col = (String(point).slice(-1)) - 1;
                let demoRestaurantName = setSelectedOptionItem(ele);
                // console.log($('.dragdrop_graph tr').eq(row).children(':eq(' + col + ')').find('.card-body'));
                // return;
                $('.dragdrop_graph tr').eq(row).children(':eq(' + col + ')').find('.card-body').append(demoRestaurantName.removeClass("invisible"));
                // $(".droppable").sortable();
                console.log(res_records);
                //    initializeShortable();

            });

            function setSelectedOptionItem(ele) {
                let demo_option_item = $(".demo_option_item").clone().removeClass('demo_option_item');
                demo_option_item.find('.res_name').text(ele.name);

                demo_option_item.attr("data-tag", ele.restaurant_id);
                demo_option_item.attr("data-name", ele.name);

                return demo_option_item;
                // console.log(demo_option_item);
            }

            $(".selected_div").parent('.empty2').addClass("selected_td");
        });
    </script>

@endpush

@section('content')

    <?php $mimnus_data = $addedRestaurants;?>
    <div class="gm2">
        <div class="header mt-9vh">
            <div class="welcome">
                <h2 class="title">
                    Simulation part-2
                </h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam, porro. Et esse, animi vel nostrum magnam ipsum, laboriosam, hic reiciendis voluptatum laudantium ratione cumque impedit quo numquam facilis magni quas.
                </p>
                <ol style="margin-left: 6rem;">
                    <li class=" part_4">Drag and drop</li>
                </ol>
                <p class=" part_4">
                    Please drag and drop the restaurants in each group from the left as per your choice to create strategic groups for restaurants in Dhaka.
                </p>
            </div>
            <div class="video ">
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
                                <div id="sortable" class="" style="min-height: 600px;">
                                    @foreach($restaurants as $restaurant)
                                        @if(!in_array(trim($restaurant->id),$mimnus_data))
                                            <?php $url = $rest_icons[rand(0, 3)] ?>
                                            <div data-tag="{{$restaurant->id}}" data-name="{{$restaurant->name}}"
                                                 draggable="true"
                                                 class="option-item bg-light badge badge pill">

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

                            <div class="left-side-container">
                                <div class="row">
                                    <div class="col-sm-4 txt-center">High</div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4"></div>
                                </div>

                                <div class="flex">
                                    <h1 class="graph_label"> {{ Str::title($level_options[($graph_level->y_level)-1]['name'])}} </h1>

                                    <div class="chart">
                                        <div class="table-responsive">
                                            <table class="dragdrop_graph " id="">
                                                <tr>
                                                    <td class="empty2  jquery_drop_box">

                                                    </td>
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
                                        <div class="col-sm-4 txt-center">
                                            Low
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <h1 class="graph_label"> {{ Str::title($level_options[($graph_level->x_level)-1]['name'])}} </h1>
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
                </div>
            </div>
        </div>

        <div class="next mb-3rem">
            <div class="row ">
                <div class="col-sm-10"></div>
                <div class="col-sm-2">
                    <a href="{{route('gm2.market_scenario')}}" class="btn btn-next" >Next</a>
                </div>
            </div>
        </div>
    </div>


    <!-- DemoDroppableCard -->
    <div class="card dropBox invisible">
        <div class="card-header" style="text-align: center;padding:0px !important"></div>
        <div class="card-body droppable ui-sortable" data-tag="" data-name="" style="padding-left: 5px !important;">

        </div>
    </div>


    <!-- option-item-demo -->
    <div data-tag="" data-name="" draggable="true"
         class="demo_option_item option-item bg-light badge badge pill invisible">
        <?php $url = $rest_icons[rand(0, 3)] ?>
        <img src="{{asset('assets/icons/'.$url.'.svg')}}" alt="" class="rest_icon">
        <span class="res_name">
        </span>
    </div>

@endsection
