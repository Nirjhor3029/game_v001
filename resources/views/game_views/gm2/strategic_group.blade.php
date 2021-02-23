@extends('game_views.gm2.layout.app')

@section('content')

<div class="gm2">
    <div class="header">
        <div class="welcome">
            <h2 class="title">
                Welcome To The Strategic Game
            </h2>
            <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ex repellendus maxime reiciendis explicabo
                quos
                vel iure architecto earum, voluptatum magnam pariatur, dolores necessitatibus aliquid incidunt! Iure
                dolorem
                officiis ex obcaecati!
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
        <div class="col1">
            <div class="content">
                <div class="title">
                    <i class="fa fa-book"></i>
                    <h2>What is strategic group ?</h2>
                </div>
                <div class="text">
                    <p>
                        A strategic group is “the group of firms in an industry following the same or a similar strategy
                        along the strategic dimensions.”
                    </p>
                </div>
            </div>
        </div>
        <div class="col2">
            <div class="content">
                <div class="title">
                    <i class="fa fa-book"></i>
                    <h2>Summery</h2>
                </div>
                <div class="text">
                    <p>
                        These strategic dimensions might include product range, geographical breadth, choice of
                        distribution channels, level of product quality, degree of vertical integration, choice of
                        technology, Price and so on.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
