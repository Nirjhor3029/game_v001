@extends('game_views.gm2.layout.app')

@section('content')

    <div class="gm2">
        <div class="header mt-9vh">
            <div class="welcome">
                <h2 class="title">
                    Market Research
                </h2>
                <p>
                Restaurants in Dhaka can be grouped in terms of types of food they serve, product range, price, perceived quality, level of location, breath, level of vertical integration, number of outlets. Based on this, your research team has come up with the following table with the analysis of restaurants that are relevant to you. You need to keep a closer look at this table to better understand the dhaka restaurant markets.
                </p>
            </div>
            <div class="video">
                <!-- <video width="400" controls>
                <source src="mov_bbb.mp4" type="video/mp4">
                <source src="mov_bbb.ogg" type="video/ogg">
                Your browser does not support HTML video.
                </video> -->
                <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY">
                </iframe>
            </div>
        </div>

        <div class="market_strategy">
            <div class="title title_strategy mt-9vh">
                <!-- <i class="fa fa-book"></i> -->
                <h2>Strategic groups within the world automobile industry.</h2>
            </div>
            <img src="{{asset('assets/img/marketing_strategy_table_1.JPG')}}" class="image" alt="">
            <h2>Market Scenario Table</h2>
            <img src="{{asset('assets/img/marketing_strategy_table_2.JPG')}}" class="image" alt="">
            <h2>Market Scenario Table</h2>
        </div>

        <div class="next mb-3rem">
            <div class="row ">
                <div class="col-sm-10"></div>
                <div class="col-sm-2">
                    <a href="{{route('gm2.game')}}" class="btn btn-next" >Next</a>
                </div>
            </div>
        </div>

    </div>


@endsection
