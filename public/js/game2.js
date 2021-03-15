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
    update: function (e, ui) {
        let x = $(this).closest('tr').index();
        let y = $(this).closest('td').index();
        // console.log(e.target);
        // console.log(`row ${x} & column ${y}`);
    }
});


// market_scenario_2.blade.php ::start
var MaxAttackAmount = 20;
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
        $(".number_of_outlets").val(1);
        costField.val(cost);

        let card = subCatParent.parents('.card');
        // console.log(card);
        // total
        gm2_calculateTotal(card, that, false); //updateDb = false

    });

    $(".number_of_outlets").on("change", function (e) {
        let that = $(this);
        let card = that.parents('.card');
        let cost_value = card.find(".cost_value");
        let previousAreaValue = cost_value[0].value;
        cost_value[0].value = cost_value[0].value * that.val();
        let returnValue = gm2_calculateTotal(card, that, false); //updateDb = false
        if (returnValue == 0) {
            cost_value[0].value = previousAreaValue;
        }
    })

    $('.competitors_move,.ajx_input_market_promotion').on('change', function (e) {
        let that = $(this);
        let card = that.parents('.card');
        // console.log(card);
        gm2_calculateTotal(card, that, false); //updateDb = false
    });

    $("#attack").on("click", function (e) {
        console.log("Attacking");
        // $("#attackModal").modal();
        let that = $(this);
        let card = that.parents('.card');
        gm2_calculateTotal(card, that, true); //updateDb = true
    });


    // $(".attack").on("click", function (e) {
    //     let group = $('input[name="attack_group"]:checked').val();
    //     // console.log(group);
    //     let rest_id = $('.rest_id').val();
    //     // console.log(group);


    //     $.ajax({
    //         type: "POST",
    //         url: "user_set_group",
    //         data: {
    //             group: group,
    //             rest_id: rest_id,
    //         },
    //         success: function (data) {
    //             // console.log(data);
    //             // $(this).prop("disabled", "true");
    //             //return;
    //         }
    //     });
    // });


    function gm2_calculateTotal(card, that, updateDb) {

        let group = $('input[name="attack_group"]:checked').val();


        let max_invest = parseInt(card.find(".max_invest").val());
        // console.log(max_invest);
        let total = card.find(".gm2-total-value");
        let cost_value = card.find(".cost_value");
        let type = card.find(".type");
        let sub_type = card.find(".subcategory");
        let numberOfOutlets = card.find(".number_of_outlets");

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
        // area = parseInt(area.value) * parseInt(numberOfOutlets.val());

        let totalValue_without_move = parseInt(area.value) + parseInt(quality.value) +
            parseInt(discountWithStore.value) + parseInt(discountThroughDeliveryService.value) +
            parseInt(AdvertisingThroughSocialMedia.value) + parseInt(Branding.value) + parseInt(Other.value);
        competitorsMove.value = max_invest - totalValue_without_move;

        if (competitorsMove.value < 0) {
            alert("Total Investment Crossed the Max Limit !!!");
            that.val(that.val() - 1);
            //return;
            // let totalValue_without_move = parseInt(area.value) + parseInt(quality.value) +
            //     parseInt(discountWithStore.value) + parseInt(discountThroughDeliveryService.value) +
            //     parseInt(AdvertisingThroughSocialMedia.value) + parseInt(Branding.value) + parseInt(Other.value);
            // competitorsMove.value = max_invest - totalValue_without_move;
            return 0;
        }

        let totalValue = totalValue_without_move + parseInt(competitorsMove.value);
        total.text(totalValue_without_move);
        // return;
        // console.log(rest_id.value);

        console.log(cost_value[0].value);

        if (cost_value[0].value <= 0 || cost_value[1].value <= 0 || typeof group == "undefined") {
            cost_value.addClass("border_rd");
            card.find(".form-check").addClass("border_rd");
            toastr.error("All Required Field Must need to fill!");
            updateDb = 0;
        } else {
            cost_value.removeClass("border_rd");
            // updateDb = 1;
        }


        // Update Database

        // let required = $(":required");
        // console.log(required);
        if (updateDb) {
            $.ajax({
                type: "POST",
                url: "gm2_attack",
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

                    group: group,
                },
                success: function (data) {
                    // console.log(data);
                    toastr.success(data.success);
                    //return;
                }
            })
        }

    }

    // Game page


    // market_scenario page


    // Market Scenario defend page
    $(".defends_option").on("change", function (e) {
        console.log("changed");
        let that = $(this);
        let parent = that.parents(".card");
        let total = 0;
        let inputs = parent.find(".defends_option").each(function (index) {
            let item = parseInt($(this).val());
            total += item;
        });

        // total = parseInt(inputs[0].value) + parseInt(inputs[1].value) + parseInt(inputs[2].value) + parseInt(inputs[3].value) + parseInt(inputs[4].value);

        parent.find(".gm2-total-value").text(total);
        let defendCost = parseInt(parent.find("#defend_cost").text());
        if (defendCost < total) {
            alert("You Crossed Your Defend Budget: " + defendCost);
            that.val(0);
        }


        console.log(defendCost);
    })


});


// market_scenario_2.blade.php ::end


//
