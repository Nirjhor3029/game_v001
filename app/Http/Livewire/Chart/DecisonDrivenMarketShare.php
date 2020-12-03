<?php

namespace App\Http\Livewire\Chart;

use Livewire\Component;

class DecisonDrivenMarketShare extends Component
{
    public $red;
    public $yellow;
    public $blue;

    public function mount(){
        $this->red = 20;
        $this->yellow = 20;
        $this->blue = 10;
    }

    public function update()
    {
        $this->red += 50;
        $this->yellow = 10;
        $this->blue = 10;
    }

    public function render()
    {
        $this->red += 2;
        return view('livewire.chart.decison-driven-market-share');
    }
}
