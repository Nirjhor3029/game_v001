@extends('game_views.gm2.layout.app')

@section('content')

    <?php

    // $restaurants = $restaurant;
    $colors = ["#4AD179", "#ED375D", "#FE8400"];
    $groups = ["group_1", "group_2", "group_3", "group_4",];

    ?>

    <div class="gm2">


        <div class="header ">
            <div class="welcome mt-9vh">
                <h2 class="title" style="text-align: center;">
                    {{(isset($msg)? $msg: "")}}
                    <br>
                    Waiting For Teacher Approval.
                </h2>
                <p>
                </p>
            </div>
        </div>


        <div class="row">
            <div class="offset-md-3 col-md-6 market_scenario_table_box">
                <div>
                    <h3 class="text-center">Table 2</h3>
                </div>
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" colspan="4" class="text-center">Cost of Additional Outlet with
                            everything as it is <br>(in millions)
                        </th>
                        <th scope="col" colspan="4" class="text-center">Cost per outlet for offering a new
                            line
                            of product / change the quality within the existing setup
                            <br>(in millions)
                        </th>
                    </tr>
                    <tr>
                        <th>Type/Area</th>
                        <th>Tri state Areas</th>
                        <th>Mid end Area</th>
                        <th>Low end Areas</th>
                        <th>Type/Quality</th>
                        <th>High</th>
                        <th>Mid</th>
                        <th>Low</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Continental/Intl Chain</th>
                        <td>10</td>
                        <td>8</td>
                        <td>6</td>
                        <th scope="row">Continental/Intl Chain</th>
                        <td>2</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th scope="row">Fast Food</th>
                        <td>5</td>
                        <td>4</td>
                        <td>3</td>
                        <th scope="row">Fast Food</th>
                        <td>1.5</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th scope="row">Coffee/Bistro</th>
                        <td>3</td>
                        <td>2</td>
                        <td>1</td>
                        <th scope="row">Coffee/Bistro</th>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th scope="row">Desi</th>
                        <td>4</td>
                        <td>3</td>
                        <td>2</td>
                        <th scope="row">Desi</th>
                        <td>1</td>
                        <td>0.5</td>
                        <td>0.5</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <h3>
                {{(isset($msg)? $msg: "")}}
            </h3>
        </div>


    </div>

@endsection
