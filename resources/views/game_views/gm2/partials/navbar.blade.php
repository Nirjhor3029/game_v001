<?php
use App\Models\Admin\Navbar;
$navbars = Navbar::orderBy('priority')->get();
?>
<nav class="gm2_nav">
    <div class="logo">
        <h4>Calibrate</h4>
    </div>
    <ul class="nav-links">
        <!-- @foreach($navbars as $item)
        <li class="{{ request()->is('/'.$item->slug) ? 'active' : '' }}">
            <a href="{{$item->slug}}">
                {{$item->name}}
            </a>
        </li>
        @endforeach -->

        <li>
            <a href="strategic_group" class="{{ Request::is('gm2/strategic_group') ? 'active' : '' }}">
                Strategic Group
            </a>
        </li>
        <li>
            <a href="marketing_strategy" class="{{ Request::is('gm2/marketing_strategy') ? 'active' : '' }}">
                Marketing Strategy
            </a>
        </li>
        <li>
            <a href="development_of_strategic_group"
                class="{{ Request::is('gm2/development_of_strategic_group') ? 'active' : '' }}">
                Development of Strategic Group
            </a>
        </li>
        <li>
            <a href="game">
                Game
            </a>
        </li>
        <li>
            <a href="{{route('gm2.user_graph')}}">
                Game2
            </a>
        </li>
        <li>
            <a href="{{route('gm2.market_scenario')}}">
                Market Scenario
            </a>
        </li>
        <li>
            <a href="{{route('gm2.market_scenario_defend')}}">
                Market Scenario Defend
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png" width="40" height="40" class="rounded-circle">
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Dashboard</a>
                <a class="dropdown-item" href="#">Edit Profile</a>
                <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="{{route('logout')}}" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
                </form>
            </div>
        </li>   
    </ul>

    <div class="burger">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>
</nav>


<form method="POST" action="http://127.0.0.1:8000/logout">
    <input type="hidden" name="_token" value="zGR9vq1weRxS2fuOfnuH4wcTnuwR4ZvuJm36bjDs">
        <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="http://127.0.0.1:8000/logout" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
</form>
