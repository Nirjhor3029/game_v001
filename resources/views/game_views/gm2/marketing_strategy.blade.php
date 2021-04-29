@extends('game_views.gm2.layout.app')

@section('content')

    <div class="gm2">
        <div class="header mt-9vh">
            <div class="welcome">
                <h2 class="title">
                    Market Scenario
                </h2>
                <p>
                    {{-- Restaurants in Dhaka can be grouped in terms of types of food they serve, product range, price,
                     perceived quality, level of location, breath, level of vertical integration, number of outlets.
                     Based on this, your research team has come up with the following table with the analysis of
                     restaurants that are relevant to you. You need to keep a closer look at this table to better
                     understand the dhaka restaurant markets.--}}
                    Restaurants in Dhaka can be grouped in terms of types of food that they serve (restaurant types),
                    product range, price, perceived quality, breadth of location, level of vertical integration, number
                    of outlets.
                </p>
                <p>
                    Based on this, your research team has come up with the following table with the analysis of
                    restaurants that are relevant to you. You need to keep a closer look at this table to better
                    understand the Dhaka restaurant markets.
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

        <div class="market_strategy" style="margin:20px 0;">
            <!-- <div class="title title_strategy mt-9vh">
                <h2>Strategic groups within the world automobile industry.</h2>
            </div> -->
            <h2>Market Scenario Table</h2>
            {{-- <img src="{{asset('assets/img/marketing_strategy_table_1.JPG')}}" class="image" alt=""> --}}
            {{-- <img src="{{asset('assets/img/marketing_strategy_table_2.JPG')}}" class="image" alt=""> --}}
            <div class="table table-responsive" style="height: 80vh">
                <table class="table  table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col ">Name</th>
                        <th scope="col">Product Range</th>
                        <th scope="col">Price</th>
                        <th scope="col">Location Breadth</th>
                        <th scope="col">Level of vertical integration</th>
                        <th scope="col">Level of product quality</th>
                        <th scope="col">Outlets</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Tasty Treat</th>
                        <td>High-Fast food and bakery</td>
                        <td>Low</td>
                        <td>Very High</td>
                        <td>High</td>
                        <td>Low</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <th scope="row">Unimart</th>
                        <td>Mid – fast food, limited lunch set menu, limited dessert menu</td>
                        <td>High</td>
                        <td>Low</td>
                        <td>High</td>
                        <td>High</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <th scope="row">Pizza Roma</th>
                        <td>Low - Italian</td>
                        <td>Very High</td>
                        <td>Very Low</td>
                        <td>Low</td>
                        <td>High</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th scope="row">Pizza Hut</th>
                        <td>Very Low- Pizzeria</td>
                        <td>High</td>
                        <td>High</td>
                        <td>Low</td>
                        <td>Mid</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <th scope="row">Bella Italia</th>
                        <td>Low- Italian</td>
                        <td>Very High</td>
                        <td>Very Low</td>
                        <td>Low</td>
                        <td>High</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th scope="row">North End</th>
                        <td>Very Low - High end coffee with Bakery</td>
                        <td>High</td>
                        <td>Mid</td>
                        <td>Mid</td>
                        <td>High</td>
                        <td>7</td>
                    </tr>
                    <tr>
                        <th scope="row">Tabaq</th>
                        <td>Very Low - High end coffee with Bakery</td>
                        <td>Mid</td>
                        <td>Mid</td>
                        <td>Low</td>
                        <td>High</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <th scope="row">Peyala</th>
                        <td>Low- Coffee with fast food with Bakery and Salad Bar</td>
                        <td>Mid</td>
                        <td>Mid</td>
                        <td>Low</td>
                        <td>Mid</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <th scope="row">Burger King</th>
                        <td>Very low- Burger Chain</td>
                        <td>High</td>
                        <td>Mid</td>
                        <td>Low</td>
                        <td>High</td>
                        <td>11</td>
                    </tr>

                    <tr>
                        <th scope="row">TakeOut</th>
                        <td>Very Low Burger Chain</td>
                        <td>Mid</td>
                        <td>Low</td>
                        <td>Low</td>
                        <td>Mid</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <th scope="row">KFC</th>
                        <td>Low - Burger with very limited fast food options</td>
                        <td>Mid</td>
                        <td>High</td>
                        <td>Low</td>
                        <td>High</td>
                        <td>20</td>
                    </tr>
                    <tr>
                        <th scope="row">Salam’s Kitchen</th>
                        <td>Very Low - Biriyani</td>
                        <td>Mid</td>
                        <td>Very Low</td>
                        <td>Low</td>
                        <td>Low</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th scope="row">Sultan’s Dine</th>
                        <td>Very Low- Biriyani</td>
                        <td>High</td>
                        <td>Low</td>
                        <td>Low</td>
                        <td>High</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <th scope="row">Kacchi Bhai</th>
                        <td>Very Low- Biriyani</td>
                        <td>Mid</td>
                        <td>Low</td>
                        <td>Low</td>
                        <td>Mid</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <th scope="row">Glazed</th>
                        <td>Very Low Dessert Shop</td>
                        <td>High</td>
                        <td>Low</td>
                        <td>Low</td>
                        <td>High</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <th scope="row">Star Kabab</th>
                        <td>Low - Bengali/ Indian</td>
                        <td>Low</td>
                        <td>Mid</td>
                        <td>Low</td>
                        <td>Low</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <th scope="row">Dhanshiri</th>
                        <td>Low- Bengali/ Indian</td>
                        <td>Low</td>
                        <td>Low</td>
                        <td>Low</td>
                        <td>Low</td>
                        <td>3</td>
                    </tr>
                    {{-- <tr>
                        <th scope="row">Treat</th>
                        <td>dd</td>
                        <td>dd</td>
                        <td>dd</td>
                        <td>dd</td>
                        <td>dd</td>
                        <td>dd</td>
                    </tr> --}}

                    </tbody>
                </table>
            </div>
            {{--  <h2>Market Scenario Table</h2>--}}
        </div>

        <div class="next mb-3rem">
            <div class="row ">
                <div class="col-sm-10"></div>
                <div class="col-sm-2">
                    <a href="{{route('gm2.market')}}" class="btn btn-next">Next</a>
                </div>
            </div>
        </div>

    </div>


@endsection
