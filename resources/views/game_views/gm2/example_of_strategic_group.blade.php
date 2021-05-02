@extends('game_views.gm2.layout.app')

@section('content')

    <div class="gm2">

        <div class="market_strategy">
            <div class="title title_strategy mt-9vh">
                <h4>An example of Strategic Group Analysis for Global Automobile Industry</h4>
            </div>
            <img src="{{asset('assets/img/stretegic.JPG')}}" class="image" alt="">
            <h2>Strategic Groupsss</h2>



        </div>

        <div class="next">
            <div class="row">
                <div class="col-sm-2">
                    <a href="{{route('gm2.strategic_group')}}" class="btn btn-next" style="background-color: rgb(29, 116, 246);color:white ">Back</a>
                </div>
                <div class="col-sm-10">

                </div>
            </div>
        </div>

    </div>


@endsection
