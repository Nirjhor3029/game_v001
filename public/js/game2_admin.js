$("#sortable").sortable({
    connectWith: [".droppable"]
});

/*    $(function () {
        $(".droppable").droppable({
            drop: function (event, ui) {
                // console.log(event.target);
                // console.log(ui);
                $(this)
                    .addClass("ui-state-highlight")
                    .html("Dropped!" + event.target);

            }
        });
    });*/

$(".droppable").sortable({
    cursor: "move",
    connectWith: "#sortable",
    update: function (e, ui) {
        let x = $(this).closest('tr').index();
        let y = $(this).closest('td').index();
        // console.log(e.target);
        // console.log(`row ${x} & column ${y}`);
    }
});


// market_scenario_2.blade.php ::start
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.type').on('change', function (e) {
        let that = $(this);
        let cat_id = e.target.value;
        let type = that.data('type');
        // console.log(type);
        // return;
        $.ajax({
            type: "POST",
            url: "subcat",
            data: {
                cat_id: cat_id,
                type: type,

            },
            success: function (data) {
                // console.log(data); return;
                let subCat = that.parent().siblings('.subclass').children('.subcategory')
                // console.log(subCat);subCat.css("background-color", "red"); return;
                subCat.empty();
                subCat.append(
                    '<option selected>Select type</option>');
                $.each(data
                    .subcategories[0].sub_costs,
                    function (index, subcategory) {
                        subCat.append('<option data-cost="' + subcategory.value + '" value="' + subcategory.id + '" >' + subcategory.name + '</option>');
                    })

            }
        })
    });
    $('.subcategory').on('change', function (e) {

        let that = $(this);
        let subCatParent = that.parent();
        let costField = subCatParent.siblings('.cost_class').children('.cost_value')

        let cost = that.find(':selected').data('cost');
        costField.val(cost);

        let card = subCatParent.parents('.card');
        // console.log(card);
        // total
        gm2_calculateTotal(card);

    });

    $('.competitors_move,.ajx_input_market_promotion').on('change', function (e) {
        let that = $(this);
        let card = that.parents('.card');
        // console.log(card);
        gm2_calculateTotal(card);
    });

    function gm2_calculateTotal(card) {
        let total = card.find(".gm2-total-value");
        let cost_value = card.find(".cost_value");

        let type = card.find(".type");
        let sub_type = card.find(".subcategory");

        let type_selected = type.find(':selected');
        let area_type = type_selected[0].value;
        let quelity_type = type_selected[1].value;

        let sub_type_selected = sub_type.find(':selected');
        let quelity_sub_type = 0;
        let area_sub_type = 0;
        if (sub_type_selected.length <= 0) {
            area_sub_type = 0;
            quelity_sub_type = 0;
        } else if (sub_type_selected.length >= 2) {
            area_sub_type = sub_type_selected[0].value;
            quelity_sub_type = sub_type_selected[1].value;
        } else {
            area_sub_type = sub_type_selected[0].value;
        }


        // console.log(type.find(':selected')[0].value);
        // console.log(quelity_sub_type);

        let competitorsMove = card.find(".competitors_move")[0];
        let rest_id = card.find(".rest_id")[0];

        // market promotions inputs
        let ajx_input_market_promotion = card.find(".ajx_input_market_promotion");
        let discountWithStore = ajx_input_market_promotion[0];
        let discountThroughDeliveryService = ajx_input_market_promotion[1];
        let AdvertisingThroughSocialMedia = ajx_input_market_promotion[2];
        let Branding = ajx_input_market_promotion[3];
        let Other = ajx_input_market_promotion[4];

        // console.log(discountWithStore.value);


        let area = cost_value[0];
        let quality = cost_value[1];
        let totalValue = parseInt(area.value) + parseInt(quality.value) + parseInt(competitorsMove.value) +
            parseInt(discountWithStore.value) + parseInt(discountThroughDeliveryService.value) +
            parseInt(AdvertisingThroughSocialMedia.value) + parseInt(Branding.value) + parseInt(Other.value);

        total.text(totalValue);
        // console.log(rest_id.value);

        // Update Database
        $.ajax({
            type: "POST",
            url: "gm2_update_market",
            data: {
                area: area.value,
                quality: quality.value,

                area_type: area_type,
                quelity_type: quelity_type,
                area_sub_type: area_sub_type,
                quelity_sub_type: quelity_sub_type,


                competitorsMove: competitorsMove.value,
                totalValue: totalValue,
                rest_id: rest_id.value,

                discountWithStore: discountWithStore.value,
                discountThroughDeliveryService: discountThroughDeliveryService.value,
                AdvertisingThroughSocialMedia: AdvertisingThroughSocialMedia.value,
                Branding: Branding.value,
                Other: Other.value,
            },
            success: function (data) {
                console.log(data);
                //return;
            }
        })
    }


    var gm2NumberOfGraphBox = 0;
    // Game page
    $('#gm2_number_of_group').on('change', function (e) {
        let that = $(this);
        let numberOfBox = that.find(':selected').val();
        let gm2_select_group_txt = $('#gm2_select_group_txt');
        let empty2 = $('.empty2');
        gm2_select_group_txt.text("Select " + numberOfBox + " boxes from the chart.");
        empty2.addClass("jquery_dragdrop_box");
        empty2.removeClass("droppable");
        // $('.empty2').addClass("jquery_droppable");

        gm2NumberOfGraphBox = numberOfBox;
    });


    $('.jquery_drop_box').click(function (e) {

        if (gm2NumberOfGraphBox > 0) {
            let that = $(this);
            that.addClass('jquery_selected_box droppable');
            console.log(that);
            gm2NumberOfGraphBox--;
        } else {
            $('.empty2').removeClass('jquery_dragdrop_box');
        }
    });


    // set_group.blade.php


    /* $(document).on("change", '.group_row', function (e) {
         let that = $(this);
         let groupInput = that.parents('.group_input');
         let groupColumn = groupInput.find(".gm2-column");
         groupColumn.prop("disabled", false);
         // console.log(groupColumn);
     });*/
    let RowColumnArray = [];
    $(document).on('change', '.group_column,.group_row', function () {
        var RowColumnVal = []
        console.log('dfdsfdsf');
        let that = $(this);
        let groupInput = that.parents('.group_input');
        let groupName = groupInput.find('.group_name').val();
        groupInput.find('.group_column').prop("disabled", false);
        // let RowVal = groupInput.find('.group_row').val();
        groupInput.find('.group_row, .group_column').each(function () {
            let item = $(this).val();
            if (item === 'null') {
                return 0
            } else {
                console.log(item);
                RowColumnVal.push(item)
            }
        });

        if (RowColumnVal.length > 1) {
            //  let arrays = rowColumn.split('');
            let Row = RowColumnVal[0];
            let Column = RowColumnVal[1];
            RowColumnArray.push(Row + '' + Column);
            let td = select_graph_box(Row, Column, 'dragdrop_graph');
            console.log(RowColumnArray);
            RowColumnArray.shift();

        } else {
            let td = select_graph_box(RowVal, ColumnVal, 'dragdrop_graph');
            td.append(groupName);
        }

        console.log(RowColumnVal);
        return;

        let ColumnVal = groupInput.find('.group_column').val();
        /* RowColumnArray.push(RowVal + '' + ColumnVal);
         if (RowColumnArray.length > 1) {
             let rowColumn = RowColumnArray[0];
             let arrays = rowColumn.split('');
             let Row = arrays[0];
             let Column = arrays[1];
             let td = select_graph_box(Row, Column, 'dragdrop_graph');
             RowColumnArray.shift();

         } else {
             let td = select_graph_box(RowVal, ColumnVal, 'dragdrop_graph');
             td.append(groupName);
         }*/
        let td = select_graph_box(RowVal, ColumnVal, 'dragdrop_graph');
        td.append(groupName);
    })

    /*    $(document).on("change", '.group_column', function (e) {
            let that = $(this);
            let groupInput = that.parents('.group_input');

            let groupName = groupInput.find('.group_name');
            let groupNameText = groupName.val();

            let groupRow = groupInput.find('.group_row');
            groupRow = groupRow.find(':selected').val();

            let groupColumn = groupInput.find('.group_column');
            groupColumn = groupColumn.find(':selected').val();
            let table = 'dragdrop_graph';
            let td = select_graph_box(groupRow, groupColumn, table);
            td.append(groupNameText);
        });*/

    function select_graph_box(row, column, tableClassName) {
        let table = $("." + tableClassName);
        let group = table.find("#" + row + '' + column);
        // console.log(group);
        group.toggleClass('gm2_admin_selected_box');
        group.empty();
        return group;
    }


    $('#gm2_group_set').click(function (e) {

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


    // Set  Restaurant to group
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
                // $(this).prop("disabled", "true");
                //return;
            }
        });
    }

    // assign_Student


    // Game page
    $(".ajx_select_criteria").on("change", function (e) {

        let xAxis = $('#x-axis').children("option:selected").val()
        let yAxis = $('#y-axis').children("option:selected").val()


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
                //return;
            }
        });
    });

    // market_scenario page
    $(".attack").on("click", function (e) {

        let group = $('input[name="attack_group"]:checked').val();
        let rest_id = $('.rest_id').val();
        // console.log(group);


        $.ajax({
            type: "POST",
            url: "user_set_group",
            data: {
                group: group,
                rest_id: rest_id,
            },
            success: function (data) {
                console.log(data);
                // $(this).prop("disabled", "true");
                //return;
            }
        });
    });


});


// market_scenario_2.blade.php ::end


//
