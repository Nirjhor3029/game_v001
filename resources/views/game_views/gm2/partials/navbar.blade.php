<?php
use App\Models\Admin\Navbar;
$navbars = Navbar::orderBy('priority')->get();
?>
<nav class="gm2_nav">
    <div class="logo">
        <h4>The Nav</h4>
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
                strategic group
            </a>
        </li>
        <li>
            <a href="marketing_strategy" class="{{ Request::is('gm2/marketing_strategy') ? 'active' : '' }}">
                marketing strategy
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
                game
            </a>
        </li>
        <li>
            <a href="market_scenario_2">
                market scenario
            </a>
        </li>
        <li>
            <a href="{{route('gm2.market_scenario_defend')}}">
                Market Scenario Defend
            </a>
        </li>
        <li>
            <a href="marketing_strategy">
                demo
            </a>
        </li>
    </ul>

    <div class="burger">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>
</nav>
