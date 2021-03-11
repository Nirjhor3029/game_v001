
// Game-2 Admin Js::start
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // set_group.blade.php
    $(".group_input_plus").click(function (e) {
        let that = $(this);
        let groupInputContainer = $('#group_input_container');
        let groupInput = that.parents('.group_input');

        let clone_input = groupInput.clone();
        clone_input.find(".group_input_minus").removeClass('invisible');
        clone_input.find(".group_input_plus").remove();
        clone_input.appendTo(groupInputContainer)
    });
    $(document).on("click", ".group_input_minus", function (e) {
        let that = $(this);
        let groupInput = that.parents('.group_input');
        groupInput.remove();
    });
    $(document).on("change", '.gm2-row', function (e) {
        let that = $(this);
        let groupInput = that.parents('.group_input');
        let groupColumn = groupInput.find(".gm2-column");
        groupColumn.prop("disabled", false);
        // console.log(groupColumn);
    });
    $(document).on("change", '.gm2-column', function (e) {
        let that = $(this);
        let groupInput = that.parents('.group_input');

        let groupName = groupInput.find('.group_name');
        let groupNameText = groupName.val();

        let groupRow = groupInput.find('.group_row');
        groupRow = groupRow.find(':selected');

        let groupColumn = groupInput.find('.group_column');
        groupColumn = groupColumn.find(':selected');

        let table = $('.dragdrop_graph');
        let row_column = groupRow.val() + '' + groupColumn.val();
        let group = table.find("#" + row_column);
        // console.log(group);
        group.addClass('gm2_admin_selected_box');

        group.empty();
        group.append(groupNameText);
    });
    $('#gm2Goup_set').click(function (e) {

        let xAxisValue = $("#gm2-x-axis").children("option:selected").val();
        let yAxisValue = $("#gm2-y-axis").children("option:selected").val();
        let groupNames = $(".group_name").map((i, e) => e.value).get();
        let groupRows = $(".gm2-row").map((i, e) => e.value).get();
        let groupColumns = $(".gm2-column").map((i, e) => e.value).get();
        // let groupRestaurants = $(".gm2-restaurant").map((i, e) => e.value).get();

        if (xAxisValue <= 0 || yAxisValue <= 0) {
            alert("You Must select X-label & Y-Label");
            return;
        }
        // console.log(groupRestaurants);

        $.ajax({
            type: "POST",
            url: "gm2_update_group",
            data: {
                xAxisValue: xAxisValue,
                yAxisValue: yAxisValue,
                groupNames: groupNames,
                groupRows: groupRows,
                groupColumns: groupColumns,
                // groupRestaurants: groupRestaurants,
            },
            success: function (data) {
                console.log(data);
                toastr.success(data.success);
                $(this).prop("disabled", "true");
                //return;
            }
        });
    });



    // set_restaurant to group
    var GroupLeaders = [];
    $(".leader").on("change", function (e) {
        let that = $(this);
        let parent = that.parents('.restaurant_container');
        let group = parent.find('.group');
        let groupValue = group.val();
        let restId = parent.find('.restaurant_name').val();

        let leader = 0;
        if (that.is(":checked")) {
            GroupLeaders.push(groupValue);
            group.prop('disabled', true);
            leader = 1;
        } else {
            GroupLeaders.pop(groupValue);
            group.prop('disabled', false);
            leader = 0;
        }
        // console.log(GroupLeaders);
        updateRestaurantGroup(restId, groupValue, leader);

    })
    $(".group").on("change", function (e) {
        let that = $(this);
        let parent = that.parents('.restaurant_container');
        let groupValue = parent.find('.group').val();
        let restId = parent.find('.restaurant_name').val();
        let checkBox = parent.find('.leader');
        let leader = 0;
        if (jQuery.inArray(groupValue, GroupLeaders) !== -1) {
            checkBox.prop('disabled', true);
            // console.log(groupValue + " found in");
        } else {
            checkBox.prop('disabled', false);
            // console.log("not found");
        }

        if (checkBox.is(":checked")) {
            leader = 1;
        } else {
            leader = 0;
        }
        updateRestaurantGroup(restId, groupValue, leader);
    })
    function updateRestaurantGroup(restId, groupValue, leader) {

        // console.log(leader);

        $.ajax({
            type: "POST",
            url: "gm2_update_restaurant_group",
            data: {
                restId: restId,
                groupValue: groupValue,
                leader: leader,
            },
            success: function (data) {
                console.log(data);
                toastr.success(data.success);
                // $(this).prop("disabled", "true");
                //return;
            }
        });
    }




    // assign_Student
    $(".set").on("click", function (e) {
        let that = $(this);
        let parent = that.parents(".restaurant_container");
        let studentId = parent.find('.student_name').val();
        let restId = parent.find('.restaurant_select').children("option:selected").val();

        $.ajax({
            type: "POST",
            url: "assign_student",
            data: {
                studentId: studentId,
                restId: restId,
            },
            success: function (data) {
                console.log(data);
                toastr.success(data.success);
                // $(this).prop("disabled", "true");
                //return;
            }
        });
    });


});
// Game-2 Admin Js::End