@extends('game_views.gm2.admin.layout.gm2_admin_app')

@push('css')

@endpush
@push('js')
    <script>

        $(".group_input_plus").click(function (e) {
            let that = $(this);
            let groupInputContainer = $('#group_input_container');
            let groupInput = that.parents('.group_input');

            let clone_input = groupInput.clone();
            clone_input.find('.invisible').removeClass('invisible');
            clone_input.find(".group_input_minus").removeClass('invisible').attr('disabled', true).hide();
            clone_input.removeClass("mb-50px");
            clone_input.find(".group_input_plus").parent('.col-sm-2').remove();
            clone_input.prependTo(groupInputContainer);
            that.attr("disabled", true);

            // Count Group Number
            var min_number_of_group = $("#group_input_container").find(".group_name").length;
            // console.log(min_number_of_group);

        });

        function clickthis(e) {
            // console.log(min_number_of_group);
            // console.log(minGroups);
            if (min_number_of_group >= minGroups) {
                return true;
            } else {
                alert("Minimum Group " + minGroups);
                return false;
            }
            return false;
        }


        $(document).on("click", ".group_input_minus", function (e) {
            let that = $(this);
            let groupInput = that.parents('.group_input');
            // let row_val = groupInput.find('.group_row').val();
            // let column_val = groupInput.find('.group_column').val();
            // select_graph_box(row_val, column_val, 'dragdrop_graph');
            let groupPoint = groupInput.find('.group_point').val();
            let groupname = groupInput.find('.group_name').val();

            let data = {
                groupPoint: groupPoint,
            };
            $.ajax({
                type: "POST",
                url: "gm2_delete_single_group",
                data: data,
                success: function (successData) {
                    if (successData.status == "error") {
                        toastr.error(successData.msg);
                    } else {
                        // console.table(successData);
                        groupInput.remove();
                        toastr.success(successData.msg);
                        $("#" + groupPoint).removeClass("selectedTd selectedpoint").addClass('setGroupTd');
                        $("#" + groupPoint).text("");

                        const index = GroupNames.indexOf(groupname.toUpperCase());
                        if (index > -1) {
                            GroupNames.splice(index, 1);
                        }
                        // console.log(GroupNames);
                    }
                }
            });
        });

        $(document).on("click", '.setGroupTd', function (e) {
            let that = $(this);
            let checkedLength = $(".dragdrop_graph").find(".checkedTd").length;
            if (checkedLength > 0) {
                that.removeClass("checkedTd");
                return false;
            } else {
                that.addClass("checkedTd");
            }
            // console.log("clicked !");
        });

        // graph
        function checkRCDif(boxes) {
            // console.table(boxes);
            let countRow = 1;
            let countColumn = 1;
            console.log("length:" + boxes.length);
            if (boxes.length > 1) {

                for (var i = 0; i < boxes.length; i++) {
                    let dif = Math.abs(boxes[0] - boxes[i]);
                    if (dif == 1 || dif == 2) {
                        countColumn++;
                    } else if (dif == 10 || dif == 20) {
                        countRow++;
                    }
                    // console.log(dif);

                }

                // console.log("rowspan: "+countRow);
                // console.log("colspan: "+countColumn);
            }


        }

        var GroupNames = [];

        function checkGroupName() {
            $("#group_input_container .group_name").each(function (index) {
                GroupNames.push($(this).val().toUpperCase());
            });
            // console.log(GroupNames);
        }

        checkGroupName();

        $(document).on("click", ".setTD", function (e) {

            // console.log(GroupNames);
            let that = $(this);

            let groupInput = that.parents(".group_input");
            let groupName = groupInput.find('.group_name');
            // console.log(groupName.val());
            let checkedTds = [];
            $(".checkedTd").each(function (el) {
                let tdId = $(this).attr("id");
                checkedTds.push(tdId)
                // console.log(tdId);
            });

            if (GroupNames.includes(groupName.val().toUpperCase())) {
                toastr.error("Name Should be Unique.");
                return false;
            }

            // return false;

            if (groupName.val() == "") {
                //  alert("Write Group Name First");
                toastr.error("Write Group Name First");
                groupName.addClass("red-border");
                return;
            } else if (checkedTds.length <= 0) {
                //alert("Select At Least One Box.");
                toastr.error("Select At Least One Box.");
                $("table td").addClass("red-border");
                groupName.removeClass("red-border");
                return;
            } else {
                $("table td").removeClass("red-border");
                groupName.removeClass("red-border");
                // groupName.attr("disabled",true);
                groupInput.find(".setTD").attr("disabled", true);
                // groupInput.find(".group_input_minus").remove();
            }
            // console.log(checkedTds);


            // checkRCDif(checkedTds);
            // return;
            let data = {
                groupName: groupName.val(),
                points: checkedTds,
            };
            $.ajax({
                type: "POST",
                url: "gm2_set_single_group",
                data: data,
                success: function (SuccessData) {
                    // console.table(SuccessData);

                    if (SuccessData.status == "success") {
                        toastr.success(SuccessData.msg);
                        // that.find("setTD");
                        $(".group_input_plus").attr("disabled", false);
                        $(".checkedTd").addClass("selectedpoint").removeClass("checkedTd").text(SuccessData.groupName);

                        groupName.after('<input type="text" class="form-control form-control-sm group_point" value="' + SuccessData.groupPoint + '" hidden="">');
                        groupInput.find('.group_input_minus').attr('disabled', false).show();
                        that.text('Update').removeClass('btn-success setTD').addClass('btn-warning group_name_update').attr("disabled", false);
                        groupName.val(SuccessData.groupName);

                        GroupNames.push(groupName.val().toUpperCase());
                        // console.log("update: "+GroupNames);
                    }

                }
            });
        });

        $(document).on("click", ".group_name_update", function (e) {
            let that = $(this);
            let groupInput = that.parents(".group_input");
            let groupName = groupInput.find('.group_name');

            if (groupName.val() == "") {
                alert("Write Group Name First");
                toastr.error("Write Group Name First");
                groupName.addClass("red-border");
                return;
            } else {
                $("table td").removeClass("red-border");
                groupName.removeClass("red-border");
                groupInput.find(".group_name").attr("disabled", true);
            }
            let groupPoint = groupInput.find('.group_point').val();
            let data = {
                groupName: groupName.val(),
                groupPoint: groupPoint,
            };
            $.ajax({
                type: "POST",
                url: "group_name_update",
                data: data,
                success: function (data) {
                    // console.table(data);
                    toastr.success(data.success);
                    const index = GroupNames.indexOf(data.oldGroupName.toUpperCase());
                    if (index > -1) {
                        GroupNames[index] = data.groupName.toUpperCase();
                        $('#' + groupPoint).text(data.groupName);
                        groupInput.find(".group_name").attr("disabled", false);
                        // GroupNames.splice(index, 1);
                    }
                    // console.log(GroupNames);

                }
            });
        });

        $("#gm2-y-axis").on("click", function () {
            let selectedValue = $(this).val();
            $("#gm2-x-axis").children("option").each(function (e) {
                if ($(this).val() == selectedValue) {
                    $(this).attr("disabled", true);
                } else {
                    $(this).attr("disabled", false);
                }
            });
        });
        $("#gm2-x-axis").on("click", function () {
            let selectedValue = $(this).val();
            $("#gm2-y-axis").children("option").each(function (e) {
                if ($(this).val() == selectedValue) {
                    $(this).attr("disabled", true);
                } else {
                    $(this).attr("disabled", false);
                }
            });
        });

        $(document).ready(function () {

            if (performance.navigation.type == 2) {
                location.reload(true);
            }
            var minGroups = {{$minGroups}};
            // console.log(minGroups);
            var min_number_of_group = 0;

            let res_group = @json($points_array);
            // console.table(res_group);
            $.each(res_group, function (index, item) {
                // console.log(e);
                // let points = e.split(",");
                let td = $("#" + index);
                td.addClass("selectedpoint");
                td.removeClass("setGroupTd");
                td.text(item);
                // console.log($("#11"));

            });
        });

    </script>

@endpush
@section('content')

    <?php
    $rows = 5;
    $columns = 5;
    ?>
    <div class="gm2">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">
                    <p>
                        In order to make the next game accessible to your students you need to form strategic groups for
                        the restaurants industry and assign a particular restaurant to each student. Please note that
                        you can only choose only one restaurant per group to be assigned among students. So, if you have
                        burger king and KFC under the same group, you can only assign either Burger King or KFC to
                        students.
                    </p>
                    <p>
                        To create your own strategic group, please select the variables to be used as dimensions on
                        axis.
                    </p>
                    <p>
                        Then create the number of groups that you may deem necessary by clicking on the add button.
                        Please click on the available boxes (green) to create your strategic groups. You may choose more
                        than one box to create a group.
                    </p>

                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-9vh"
                     style="padding:40px;box-sizing:border-box ">


                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="row group_input mb-50px">

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="group_name">Group Name</label>
                                        <input type="text" class="form-control form-control-sm group_name"
                                               placeholder="Enter group Name" value="">
                                    </div>
                                </div>

                                <div class="offset-sm-1 col-sm-2">
                                    <label for=""></label>
                                    <input type="button" value="+"
                                           class="btn btn-success btn-sm form-control group_input_plus">
                                </div>
                                <div class=" offset-sm-1 col-sm-3 col-md-3 col-lg-2">
                                    <label for=""></label>
                                    <input type="button" value="Delete"
                                           class="invisible btn btn-danger btn-sm form-control group_input_minus">
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-2">
                                    <label for=""></label>
                                    <button class="invisible btn btn-success btn-sm form-control setTD">
                                    <!-- <img src="{{asset('/assets/icons/checked.svg')}}" alt="" class="leader-icon"> -->
                                        Set
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4" id="group_input_container">
                            @foreach($restaurantGroups as $key => $item)
                                <?php
                                $firstInput = $restaurantGroups;
                                $row = substr($item->point, 0, 1);
                                $column = substr($item->point, 1, 2);
                                ?>

                                <div class="row group_input">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="group_name">Group Name</label>
                                            <input type="text" class="form-control form-control-sm group_name"
                                                   value="{{$item->name}}">
                                            <input type="text" class="form-control form-control-sm group_point"
                                                   value="{{$item->point}}" hidden>
                                        </div>
                                    </div>

                                    <?php
                                    $row = substr($item->point, 0, 1);
                                    $column = substr($item->point, 1, 2);
                                    ?>

                                    <div class="offset-sm-1 col-sm-3 col-md-3 col-lg-3 col-xl-2">
                                        <label for=""></label>
                                        <input type="button" value="Delete"
                                               class=" btn btn-danger btn-sm form-control group_input_minus">
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-2">
                                        <label for=""></label>
                                        <input type="button" value="Update"
                                               class=" btn btn-warning btn-sm form-control group_name_update">
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="col-sm-8">
                            <div class="left-side-container">
                                <div class="row">
                                    <div class="col-sm-4 txt-center">High</div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4"></div>
                                </div>

                                <div class="flex">
                                    <!-- <h1>Price</h1> -->
                                    <select name="" id="gm2-y-axis" class="form-control form-control-sm select_criteria"
                                            data-type="1">
                                        <option selected value="0" disabled>Select criteria</option>
                                        @foreach($gType as $item)
                                            <option value="{{$item['id']}}"
                                                    class="" {{ ( optional($graphLevel)->y_level == $item['id'] )? "selected" : ""}}>{{Str::title($item['name'])}}
                                            </option>
                                        @endforeach
                                    </select>


                                    <div class="chart">
                                        <div class="table-responsive">
                                            <table class="dragdrop_graph " id="">
                                                @for($r=1; $r <= $rows; $r++)
                                                    <tr>
                                                        @for($c=1; $c <= $columns; $c++)
                                                            <td class="empty2 droppable jquery_drop_box setGroupTd"
                                                                id="{{$r}}{{$c}}"
                                                                style="text-align: center;border: 1px solid black !important;"></td>
                                                        @endfor
                                                    </tr>
                                                @endfor
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
                                            <select name="" id="gm2-x-axis" class="form-control form-control-sm "
                                                    data-type="2">
                                                <option selected value="0" disabled>Select criteria</option>
                                                @foreach($gType as $item)
                                                    <option
                                                        value="{{$item['id']}}" {{ ( optional($graphLevel)->x_level == $item['id'] )? "selected" : ""}}>{{Str::title($item['name'])}}</option>
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

                    <div class="submit go-right">
                        <input type="button" value="Set" class="btn btn-success" id="gm2_group_set">
                        <a class="btn btn-warning" href="{{route('teacher.set_restaurant2')}}"
                           onclick="return checkGroupAmount({{$minGroups}}) ">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function checkGroupAmount(minGroups) {
            // console.log(minGroups);
            let Items = $(".dragdrop_graph ").find(".selectedpoint").length;
            // console.log(Items);
            if (Items < minGroups) {
                toastr.error("Create minimum  " + minGroups + " groups");
                return false;
                e.stopPropagation();
            }
        }

    </script>
@endsection
