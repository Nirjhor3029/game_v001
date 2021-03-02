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

        let cost = that.find(':selected').data('cost')
        costField.val(cost);

        let card = subCatParent.parents('.card');
        console.log(card);
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
        console.log(sub_type);
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
        gm2_select_group_txt.text("Select " + numberOfBox + " Boxes from Below.");
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


});
// market_scenario_2.blade.php ::end