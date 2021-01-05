<?php

namespace App\Http\Livewire;

use App\Models\Game\Budget;
use Livewire\Component;
use Auth;
// use Session;
use Illuminate\Support\Facades\Session;

class Budgeting extends Component
{
    public $recruitment_bd = 0;
    public $manufacturing_bd = 0;
    public $launch_bd = 0;
    public $other_bd = 0;
    public $output_total_budget = 0;

    public $recruitment_np = 0;
    public $manufacturing_np = 0;
    public $launch_np = 0;
    public $other_np = 0;
    public $output_total_budget_np = 0;

    public $total_budget = 15;

    public $nextUrl = "/revenue";
    public $previousUrl = "/recruitment";

    // code for check null/empty value and show error message
    public $check_null = 1;
    public function updated($propertyName)
    {
        if($this->$propertyName == ""){
            $this->check_null = 0;
        }else{
            $this->check_null = 1;
        }
    }


    public function checkIsNotZero($arry, $total_output)
    {
        $total = 0;
        foreach ($arry as $pro) {
            if ($this->{$pro} == "") {
                $this->{$pro} = 0;
            } else {
                $total += $this->{$pro};
            }
        }
        $this->{$total_output} = $total;

        $condition = $this->output_total_budget + $this->output_total_budget_np;
        if ($condition > $this->total_budget) {
            session()->flash('error', 'Your value is geather than your budget.');
            return false;
        }
        return true;
    }

    public function calculateBdBudget()
    {
        $statment = $this->checkIsNotZero([
            'recruitment_bd', 'manufacturing_bd', 'launch_bd', 'other_bd'
        ], 'output_total_budget');

        if ($statment) {
            Budget::where(['user_id' => Auth::guard('web')->user()->id, 'game_id' => Session::get('game_id'), 'marketplace_id' => 1])->update(['recruitment' => $this->recruitment_bd, 'manufacturing' => $this->manufacturing_bd, 'launch' => $this->launch_bd, 'other' => $this->other_bd]);
        }
    }


    public function calculateBdBudgetForNp()
    {
        $statment = $this->checkIsNotZero([
            'recruitment_np', 'manufacturing_np', 'launch_np', 'other_np'
        ], 'output_total_budget_np');

        if ($statment) {
            Budget::where(['user_id' => Auth::guard('web')->user()->id, 'game_id' => Session::get('game_id'), 'marketplace_id' => 2])->update(['recruitment' => $this->recruitment_np, 'manufacturing' => $this->manufacturing_np, 'launch' => $this->launch_np, 'other' => $this->other_np]);
        }
    }


    public function mount()
    {
        if($this->check_null){
            $bangladesh =  Budget::where(['user_id' => Auth::guard('web')->user()->id, 'game_id' => Session::get('game_id'), 'marketplace_id' => 1])->get()->first();
            $this->recruitment_bd = $bangladesh->recruitment;
            $this->manufacturing_bd = $bangladesh->manufacturing;
            $this->launch_bd = $bangladesh->launch;
            $this->other_bd = $bangladesh->other;
            $this->output_total_budget = $bangladesh->recruitment + $bangladesh->manufacturing + $bangladesh->launch + $bangladesh->other;
    
            $nepalBudget = Budget::where(['user_id' => Auth::guard('web')->user()->id, 'game_id' => Session::get('game_id'), 'marketplace_id' => 2])->get()->first();
            $this->recruitment_np = $nepalBudget->recruitment;
            $this->manufacturing_np = $nepalBudget->manufacturing;
            $this->launch_np = $nepalBudget->launch;
            $this->other_np = $nepalBudget->other;
            $this->output_total_budget_np = $nepalBudget->recruitment + $nepalBudget->manufacturing + $nepalBudget->launch + $nepalBudget->other;
        }
        
    }




    public function render()
    {
        if($this->check_null){  
            $this->calculateBdBudget();
            $this->calculateBdBudgetForNp();
        }
        
        return view('livewire.budgeting');
    }
}