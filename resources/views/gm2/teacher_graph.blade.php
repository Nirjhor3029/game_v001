@extends('game_views.gm2.admin.layout.gm2_admin_app')

@push('css')

@endpush

@push('js')
    <script>

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#sortable").sortable({
                connectWith: [".droppable"],

            });

            function initializeShortable() {
                $(".droppable").sortable({
                    cursor: "move",
                    connectWith: "#sortable",
                    cancel: ".not_shortable",
                    // disabled: ".not_shortable",
                    update: function (e, ui) {
                        let row = $(this).closest('tr').index();
                        let column = $(this).closest('td').index();
                        // console.log(`row ${row} & column ${column}`);
                        /* each restaurant drop in every box so push restaurant Id & name array */
                        let restData = [];
                        if ($(this).children().length > 6) {
                            //ui.sender: will cancel the change.
                            //Useful in the 'receive' callback.
                            $(ui.sender).sortable('cancel');
                            // alert("You Can not Add More than 6 Items !!");
                            toastr.error("You Can not Add More than 6 Items !!");


                        }
                        $(this).children().each(function (idx, ele) {

                            let restId = $(ele).data('tag');

                            restData.push(restId);
                        });
                        console.dir(restData);
                        let groupId = $(this).attr("data-group");
                        // console.log(groupId);
                        // return;

                        sendData(groupId, restData);
                    },
                    receive: function (event, ui) {
                        // after drop this callback execute.
                    }
                });
            }


            function sendData(groupId, restData) {
                $(document).ready(function () {
                    let data = {
                        groupId: groupId,
                        restData: restData
                    };
                    $.ajax({
                        type: "POST",
                        url: "add_restaurant_point",
                        data: data,
                        success: function (data) {
                            console.table(data);
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


            let res_group = @json($restaurantGroups);

            // console.log("hello");
            res_group.forEach(function (ele) {
                let point = ele.point;
                let row = (String(point).slice(0, 1)) - 1;
                let col = (String(point).slice(-1)) - 1;
                $('.dragdrop_graph tr').eq(row).children(':eq(' + col + ')').append(setDroppableCard(ele).removeClass("invisible"));


                ele.restaurant_point.forEach(function (point_ele) {
                    let point = ele.point;
                    // console.log(point);
                    let row = (String(point).slice(0, 1)) - 1;
                    let col = (String(point).slice(-1)) - 1;
                    let demoRestaurantName = setSelectedOptionItem(point_ele);
                    $('.dragdrop_graph tr').eq(row).children(':eq(' + col + ')').find('.card-body').append(demoRestaurantName.removeClass("invisible"));
                });

                initializeShortable();
            });

            function setSelectedOptionItem(ele) {
                let demo_option_item = $(".demo_option_item").clone().removeClass('demo_option_item');
                demo_option_item.find('.res_name').text(ele.restaurant.name);


                demo_option_item.attr("data-tag", ele.res_id);
                demo_option_item.attr("data-name", ele.restaurant.name);
                if (ele.leader) {
                    demo_option_item.attr('draggable', false);
                    demo_option_item.addClass('not_shortable');
                    demo_option_item.append($(".leader").clone().removeClass("invisible leader"));
                }
                return demo_option_item;
            }

            function setDroppableCard(ele) {
                // let box = $(".dropBox");
                let box = $(".dropBox").clone().removeClass("dropBox");

                let boxHeader = box.find(".card-header");
                let boxBody = box.find(".card-body");

                boxBody.attr("data-group", ele.id);
                boxHeader.text(ele.name);
                // console.log(box);
                return box;
            }


            $(".selected_div").parent('.empty2').addClass("selected_td");

            $(".option-item").on("dblclick", function () {
                // console.log("double click");
                let that = $(this);
                let cardBody = that.parents(".card-body");
                let leaderIcon = cardBody.find(".leader-icon");
                // console.log(leaderIcon.length);
                // return;
                if (leaderIcon.length <= 0) {
                    leaderIcon = $("#leader-icon").clone().removeClass("invisible");
                    leaderIcon.removeAttr('id');
                } else {
                    leaderIcon.parent(".option-item").removeClass("not_shortable").attr("draggble", true);
                }
                // console.log(leaderIcon);
                // return;

                that.append(leaderIcon).addClass("not_shortable").attr("draggble", false);

                restId = that.data("tag");
                groupId = cardBody.data("group");
                // set Leader by ajax
                let data = {
                    groupId: groupId,
                    restId: restId
                };
                // console.log(data);
                // return;
                $.ajax({
                    type: "POST",
                    url: "set_leader",
                    data: data,
                    success: function (data) {
                        console.table(data);
                        toastr.success(data.success);
                    }
                });
            });


        });
    </script>

@endpush

@section('content')


    <?php $mimnus_data = $addedRestaurants;?>
    <div class="gm2">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">
                    <p>
                        Once you have created your groups, please drag the restaurant in that specific group. Please
                        select one restaurant per group to be assigned. The selected restaurant would be assigned a a
                        star on the right after the selection is done.
                    </p>
                </div>
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

                            @if(!$empty)
                                <div class="left-side-container">
                                    <div class="row">
                                        <div class="col-sm-4 graph_txt">High</div>
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
                                            <div class="col-sm-4 graph_txt">
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
                            @else
                                <div class="left-side-container">
                                    <h4> First Set The Group & Graph Criteria.</h4>
                                    <a href="{{route('teacher.set_group2')}}">Set Group</a>
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>

            <div class="submit go-right">
                <a class="btn btn-warning" href="{{route('teacher.assign_student')}}"
                   onclick='return checkRestaurantList()'>Next</a>
            </div>
        </div>
    </div>


    <!-- DemoDroppableCard -->
    <div class="card dropBox invisible">
        <div class="card-header" style="text-align: center;padding:0px !important"></div>
        <div class="card-body droppable dropBody ui-sortable" data-group="">

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


    <!--Demo Start  -->
    <img src="{{asset('assets/icons/favourites.svg')}}" alt="" class="leader leader-icon invisible" id="leader-icon">

    <script>
        function checkRestaurantList() {
            let shortableItems = $("#sortable").find(".option-item").length;
            // console.log(shortableItems);
            // e.preventDefault();
            // alert("ok");

            // return false;
            if (shortableItems) {
                toastr.error("Need To put all the restaurants into the groups");
                return false;
                e.stopPropagation();

            }
        }

    </script>
@endsection
