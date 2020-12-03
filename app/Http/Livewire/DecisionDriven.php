<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;

class DecisionDriven extends Component
{
    public $types = ['food', 'shopping', 'entertainment', 'travel', 'other'];

    public $colors = [
        'food' => '#f6ad55',
        'shopping' => '#fc8181',
        'entertainment' => '#90cdf4',
        'travel' => '#66DA26',
        'other' => '#cbd5e0',
    ];

    public $firstRun = true;

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
    ];

    public function handleOnPointClick($point)
    {
        dd($point);
    }

    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }

    public function handleOnColumnClick($column)
    {
        dd($column);
    }


    public function render()
    {
        $columnChartModel  =  (new ColumnChartModel())
        ->setTitle('Expenses by Type')
        ->addColumn('food','300','#f6ad55')
        ->addColumn('shopping','600','#f6ad56')
        ->addColumn('entertainment','900','#90cdf4')
        ->setAnimated($this->firstRun)
        ->withOnColumnClickEventName('onColumnClick');


    $lineChartModel = (new LineChartModel())
        ->setTitle('Expenses Evolution')
        ->addMarker("test 1",200)
        ->addMarker("test 2",300)
        ->addPoint("hello",400)
        ->setAnimated($this->firstRun)
        ->withOnPointClickEvent('onPointClick');


    $areaChartModel = (new AreaChartModel())
            ->setTitle('Expenses Peaks')
            ->setAnimated($this->firstRun)
            ->setColor('#f6ad55')
            ->addPoint('hello','')
            ->withOnPointClickEvent('onAreaPointClick')
            ->setXAxisVisible(false)
            ->setYAxisVisible(true);


    $pieChartModel =  (new PieChartModel())
                ->setTitle('Expenses by Type')
                ->addSlice('hardword',200,'red')
                ->setAnimated($this->firstRun)
                ->withOnSliceClickEvent('onSliceClick');





        return view('livewire.decision-driven',[
            'columnChartModel'=>$columnChartModel,
            'lineChartModel'=>$lineChartModel,
            'areaChartModel'=>$areaChartModel,
            'pieChartModel'=>$pieChartModel,
        ]);
    }
}
