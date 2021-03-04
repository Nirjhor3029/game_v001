const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');

    const navLinks = document.querySelectorAll('.nav-links li');

    burger.addEventListener('click', () => {
        // console.log(nav.classList);
        nav.classList.toggle('nav-active');

        // animate links
        navLinks.forEach((link, index) => {
            // console.log(link);
            if (link.style.animation) {
                link.style.animation = "";
            } else {
                link.style.animation = `navLinkFade 0.5s ease forwards ${index / 10 + .5}s`;
            }
        });

        burger.classList.toggle("toggle");
    });
}
navSlide();



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
    update: function(e, ui) {
        let x = $(this).closest('tr').index();
        let y = $(this).closest('td').index();
        // console.log(e.target);
        // console.log(`row ${x} & column ${y}`);
    }
});




// market_scenario_2.blade.php ::start
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
        // console.log(type);
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
                        subCat.append('<option data-cost="' + subcategory.value + '" value="' + subcategory.id + '" >' + subcategory.name + '</option>');
                    })

            }
        })
    });
    $('.subcategory').on('change', function(e) {

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

    $('.competitors_move,.ajx_input_market_promotion').on('change', function(e) {
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
            success: function(data) {
                // console.log(data);
                //return;
            }
        })
    }



    var gm2NumberOfGrapchBox = 0;
    // Game page
    $('#gm2_number_of_group').on('change', function(e) {
        let that = $(this);
        let numberOfBox = that.find(':selected').val();
        let gm2_select_group_txt = $('#gm2_select_group_txt');
        let empty2 = $('.empty2');
        gm2_select_group_txt.text("Select " + numberOfBox + " Boxes from Chart.");
        empty2.addClass("jquery_dragdrop_box");
        empty2.removeClass("droppable");
        // $('.empty2').addClass("jquery_droppable");

        gm2NumberOfGrapchBox = numberOfBox;
    });


    $('.jquery_drop_box').click(function(e) {


        if (gm2NumberOfGrapchBox > 0) {
            let that = $(this);
            that.addClass('jquery_selected_box droppable');
            console.log(that);
            gm2NumberOfGrapchBox--;
        } else {
            $('.empty2').removeClass('jquery_dragdrop_box');
        }
    });


    // set_group.blade.php
    $(".group_input_plus").click(function(e) {
        let that = $(this);
        let groupInputContainer = $('#group_input_container');
        let groupInput = that.parents('.group_input');

        let clone_input = groupInput.clone();
        clone_input.find(".group_input_minus").removeClass('invisible');
        clone_input.find(".group_input_plus").remove();
        clone_input.appendTo(groupInputContainer)
    });

    $(document).on("click", ".group_input_minus", function(e) {
        let that = $(this);
        let groupInput = that.parents('.group_input');
        groupInput.remove();
    });

    // $(document).on("change", '.gm2-row', function(e) {
    //     let that = $(this);
    //     let groupInput = that.parents('.group_input');
    // });

    $(document).on("change", '.gm2-column', function(e) {
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


});

var GroupLeaders = [];
$(".leader").on("change", function(e) {
    let that = $(this);
    let parent = that.parents('.restaurant_container');
    let group = parent.find('.group');
    let groupValue = group.val();
    if (that.is(":checked")) {
        GroupLeaders.push(groupValue);
        group.prop('disabled', true);
    } else {
        GroupLeaders.pop(groupValue);
        group.prop('disabled', false);
    }
    console.log(GroupLeaders);
})

$(".group").on("change", function(e) {
        let that = $(this);
        let parent = that.parents('.restaurant_container');
        let groupValue = parent.find('.group').val();
        let checkBox = parent.find('.leader');
        if (jQuery.inArray(groupValue, GroupLeaders) !== -1) {
            checkBox.prop('disabled', true);
            // console.log(groupValue + " found in");
        } else {
            checkBox.prop('disabled', false);
            // console.log("not found");
        }
        // console.log(GroupLeaders);
    })
    // market_scenario_2.blade.php ::end



//