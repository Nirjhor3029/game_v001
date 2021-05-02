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



$(".droppable").sortable({
    cursor: "move",
    connectWith: "#sortable",
    update: function (e, ui) {
        let x = $(this).closest('tr').index();
        let y = $(this).closest('td').index();
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



    $('.type').on('change', function (e, selected = null) {
        console.log(selected);
        console.log("change trigger");
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
                // console.log("type:" + type);
                // console.log(data); return;
                let subCat = that.parent().siblings('.subclass').children('.subcategory')
                // console.log(subCat);subCat.css("background-color", "red"); return;
                subCat.empty();
                subCat.append(
                    '<option selected>Select Type</option>');
                if (type == 2) { //type 2 means quality type
                    let subcategories = that.parent().parent().parent().find('.subcategory');
                    let firstSubCatTxt = subcategories.first().find(':selected').text();
                    console.log(firstSubCatTxt);
                    let match = 0;
                    $.each(data
                        .subcategories[0].sub_costs,
                        function (index, subcategory) {
                            let check = (selected == subcategory.id) ? "selected" : "";
                            // console.log(firstSubCatTxt.toLowerCase().normalize() + " : " + firstSubCatTxt.toLowerCase().normalize());
                            if (firstSubCatTxt.toLowerCase().normalize() === subcategory.name.toLowerCase().normalize()) {
                                console.log("match");
                                match++;
                                subCat.append('<option data-cost="' + subcategory.value + '" value="' + subcategory.id + '"' + check + ' >' + subcategory.name + '</option>');
                            } else {
                                subCat.append('<option data-cost="' + subcategory.value + '" value="' + subcategory.id + '"' + check + ' disabled>' + subcategory.name + '</option>');
                            }
                            console.log("match: " + match);
                        })
                    if (match == 0) {
                        // $("select option:first-child").attr("disabled", "true");
                        // console.log(subCat.find("option:nth-child(2)"));
                        subCat.find("option:nth-child(2)").attr("disabled", false);
                        // subCat.prop('selectedIndex', 1);
                    }
                    //else {
                    //     match == 0;
                    // }
                } else {
                    $.each(data
                        .subcategories[0].sub_costs,
                        function (index, subcategory) {
                            let check = (selected == subcategory.id) ? "selected" : "";
                            // console.log(selected);
                            subCat.append('<option data-cost="' + subcategory.value + '" value="' + subcategory.id + '"' + check + '>' + subcategory.name + '</option>');
                        })
                }



            }
        })
    });





    $('.subcategory').on('change', function (e) {
        let that = $(this);
        if (that.hasClass("sub_area")) {
            console.log("are sub");
            let areaRow = that.parents(".inputField_row");
            let qualityRow = areaRow.siblings(".quality_row");
            qualityRow.find("#typeQuantity").prop('selectedIndex', 0);
            qualityRow.find("#typeQuantity_subcategory").prop('selectedIndex', 0);
        }
        let subCatParent = that.parent();
        let costField = subCatParent.siblings('.cost_class').children('.cost_value')

        let cost = that.find(':selected').data('cost');
        $(".number_of_outlets").val(1);
        $(".number_of_outlets").removeClass("border_rd");
        costField.val(cost);

        let card = subCatParent.parents('.card');
        // console.log(card);
        // total
        console.log("ok");
        return;
        gm2_calculateTotal(card, that, false); //updateDb = false

    });

    $(".number_of_outlets").on("change", function (e) {
        let that = $(this);
        let card = that.parents('.card');
        let cost_value = card.find(".cost_value");


        let subCat = card.find(".subcategory");
        let dataCost = subCat.first().children(':selected').attr("data-cost");
        // console.log(dataCost);
        cost_value.first().val(dataCost * that.val());

        // console.log(cost_value[0].value);
        let returnValue = gm2_calculateTotal(card, that, false); //updateDb = false

    })

    $('.competitors_move,.ajx_input_market_promotion').on('change', function (e) {
        let that = $(this);
        if (that.val() < 0) {
            toastr.error("This Value can not be less that 0");
            that.addClass("border_rd");
            that.val(0);
            return;
        } else {
            that.removeClass("border_rd");
        }
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

        let sub_type_selected_cost = sub_type_selected.first().attr("data-cost");
        // console.log(sub_type_selected_cost);
        // return;
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
            // alert("Total Investment Crossed the Max Limit !!!");
            toastr.error("Total Investment Crossed the Max Limit !!!");
            that.val(0);
            that.addClass("border_rd");
            console.log(that);
            numberOfOutlets.val(1);
            area.value = sub_type_selected_cost;
            gm2_calculateTotal(card, that, updateDb);
            //return;
            // let totalValue_without_move = parseInt(area.value) + parseInt(quality.value) +
            //     parseInt(discountWithStore.value) + parseInt(discountThroughDeliveryService.value) +
            //     parseInt(AdvertisingThroughSocialMedia.value) + parseInt(Branding.value) + parseInt(Other.value);
            // competitorsMove.value = max_invest - totalValue_without_move;
            return 0;
        } else {
            // that.removeClass("border_rd");
        }

        let totalValue = totalValue_without_move + parseInt(competitorsMove.value);
        total.text(totalValue_without_move);
        // return;
        // console.log(rest_id.value);

        // console.log(cost_value[0].value);
        console.log("group ", group);

        if (cost_value[0].value <= 0 || cost_value[1].value <= 0 || typeof group == "undefined") {
            // that.addClass("border_rd");
            card.find(".form-check").addClass("border_rd");
            toastr.error("All Required Field Must need to fill!");
            return;
            updateDb = 0;
        } else {
            that.removeClass("border_rd");
            card.find(".form-check").removeClass("border_rd");
            // updateDb = 1;
        }


        // Update Database

        // let required = $(":required");
        // console.log(required);
        let data = {
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
            numberOfOutlets: numberOfOutlets.val(),

            group: group,
        };
        console.table(data);
        console.log("db:" + updateDb);
        // return data;
        if (updateDb) {
            $.ajax({
                type: "POST",
                url: "gm2_attack",
                data: data,
                success: function (data) {
                    console.log(data);
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
