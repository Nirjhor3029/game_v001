@extends('game_views.gm2.layout.app')

@section('content')

    <div class="gm2">
        <div class="header mt-9vh">
            <div class="welcome">
                <h2 class="title">
                    What is a Strategic Group?
                </h2>
                <p>
                    A strategic group is “the group of firms in an industry following the same or a similar strategy along the strategic dimensions.”  For Instance, restaurants who follow a similar strategy in terms of price or breath of location would be grouped together. You may find an example of a strategic group for the automobile industry by clicking
                    <a href="{{route('gm2.example_of_strategic_group')}}">here</a>.
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

        <div class="details">
            <div class="col1 col">
                <div class="content">
                    <div class="title">
                        <i class="fa fa-book"></i>
                        <h2>Simulation Objectives:</h2>
                    </div>
                    <div class="text">
                        <p>
                            Once you have played this simulation you would understand
                        </p>
                        <ol>
                            <li>How to formulate Strategic Groups for an industry;</li>
                            <li>What resources are required to facilitate move from one group to another;</li>
                            <li>How to use available resources either to gain market share from another group or to defend your own market share in the face of any attack.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col2 col">
                <div class="content">
                    <div class="title">
                        <i class="fa fa-book"></i>
                        <h2>What can you Expect from this simulation?</h2>
                    </div>
                    <div class="text">
                        <p>
                        As the strategic Head of a <b>{{$restaurant_name}}</b>, you are expected to design a strategy to gain more market share. In order to do so, you would have to first develop a strategic group for restaurant business in Dhaka, and then select another strategic group to penetrate and take market share from that group. You would have 20 million taka to do that. However, you may consider to keep some of that money in the reserve to protect your market share in the face of attack by another restaurant. Good Luck!
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="next">
            <div class="row">
                <div class="col-sm-10"></div>
                <div class="col-sm-2">
                    <a href="{{route('gm2.game')}}" class="btn btn-next" >Start The Game</a>
                </div>
            </div>
        </div>
    </div>


@endsection
