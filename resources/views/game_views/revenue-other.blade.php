<style>
    .box {
        background-color: #EDEDED;
        border: 2px solid #5B9BD5;
        border-radius: 5%;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 20px;
        padding-bottom: 10px;
        margin-bottom: 50px;
        font-size: 12px;
    }

    .input-field {
        height: 70% !important;
    }

    .box-rev {
        background-color: #FFF2CC;
        border: 2px solid #5B9BD5;
        border-radius: 5%;

        padding-left: 20px;
        padding-right: 20px;
        padding-top: 20px;
        padding-bottom: 10px;

        margin-bottom: 50px;
    }


    .sub-box {
        background-color: #5B9BD5;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 20px;
        padding-bottom: 10px;
    }

    .single-field {
        /* margin-bottom: 10px; */
    }

    .single-field-rev {
        margin-bottom: 10px;
    }

    .lbl {
        background-color: #5B9BD5;
        color: white;
        display: block;
        padding: 6px 14px;
    }

    .price-txt {
        border: 2px solid #5B9BD5;
        background-color: #000000;
        color: white;
        text-align: center;
        font-size: 20px;

    }

    .row-price {
        padding: 14px;
    }

    .row-unitsold {
        padding: 10px 15px;
        text-align: center;
    }

    .col-unitsold {
        background-color: #5B9BD5;
        padding: 10px;
        /* text-align: center; */
        color: white
    }

    .row-title {
        text-align: center;
    }

    .box-rev > .row {
        /* padding: 10px */
    }

    .input_unitsold {
        width: 60% !important;
        float: left !important;
    }


</style>

<x-app-layout>
    @include('partials.subnavbar')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:40px;box-sizing:border-box">


                <div class="row">
                    <div class="col-md-12">
                        {{-- @include('partials.aside')  --}}
                        <div class="row" style="margin-bottom:30px;">
                            <h1 class="aside_title">Revenue Chart</h1>
                            <p class="aside_details">
                                You need to make sure you sell 2 items ( A, B)from the day you launch Teaco in
                                Bangladesh, and 1 items in Nepal. ( A). For each products to produce, cost will be: A: 2
                                BDT, B: 1 BDT. Now, you need to project how many items do you need to sell to gain 10%
                                of the market share in Bangladesh. You should bear in mind that competitor for A priced
                                at 3 BDT, and B priced at 6 BDT. Put your price too. Based on your pricing, what would
                                be the revenues you would get in month 1, and if you gain 10% additional sales in B plus
                                30% additional sales for B in Month 2, how much would you revenue you would earn in 2
                                months timeline.
                            </p>
                        </div>


                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        @livewire('revenue-other')
                    </div>
                </div>


                <div style="margin-top: 50px">
                    @include('partials.revenue_urls')
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
