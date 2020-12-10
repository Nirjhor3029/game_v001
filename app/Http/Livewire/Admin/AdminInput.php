<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminInput extends Component
{

    // Process ids
    public $market_share = 1;
    public $revenue = 2;
    public $cost = 3;
    public $usic = 4;
    public $net_profit = 5;
    public $cm_price = 6;


    public $market_share_assigned_value=1;
    public $market_share_actual_value = 2;  //come from actual market share 
    public $market_share_point_value;
    public $market_share_mark_value;


    public $revenue_assigned_value=1;
    public $revenue_actual_value = 2;  //come from actual revenue share 
    public $revenue_point_value;
    public $revenue_mark_value;


    public $cost_assigned_value=1;
    public $cost_actual_value = 2;  //come from actual cost share 
    public $cost_point_value;
    public $cost_mark_value;

    public $usic_assigned_value=1;
    public $usic_actual_value = 2;  //come from actual usic share 
    public $usic_point_value;
    public $usic_mark_value;


    public $net_profit_assigned_value=1;
    public $net_profit_actual_value = 2;  //come from actual net_profit share 
    public $net_profit_point_value;
    public $net_profit_mark_value;


    public $cm_price_assigned_value=1;
    public $cm_price_actual_value = 2;  //come from actual cm_price share 
    public $cm_price_point_value;
    public $cm_price_mark_value;

    public function mount()
    {
        
    }

    public function render()
    {

        $this->market_share_mark_value = ($this->market_share_actual_value/$this->market_share_assigned_value)*$this->market_share_point_value;


        $this->revenue_mark_value = ($this->revenue_actual_value/$this->revenue_assigned_value)*$this->revenue_point_value;


        $this->cost_mark_value = ($this->cost_actual_value/$this->cost_assigned_value)*$this->cost_point_value;
        
        $this->usic_mark_value = ($this->usic_actual_value/$this->usic_assigned_value)*$this->usic_point_value;
       
        $this->net_profit_mark_value = ($this->net_profit_actual_value/$this->net_profit_assigned_value)*$this->net_profit_point_value;
       
        $this->cm_price_mark_value = ($this->cm_price_actual_value/$this->cm_price_assigned_value)*$this->cm_price_point_value;

        return view('livewire.admin.admin-input');
    }


}
