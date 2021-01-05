<?php

namespace App\Http\Livewire;

use App\Models\Game\Budget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Recruitment extends Component
{
    public $slider_1=0;
    public $slider_2=0;
    public $slider_3=0;

    public $min_recruitment_budget = 0;
    public $max_recruitment_budget = 5;

    public $check_max  = 0;

    public $userId;
    public $gameId;

    public $nextUrl = "/budgeting";
    public $previousUrl = "/overview";

    public function updateDB()
    {
        $recruitment = \App\Models\Recruitment::where('user_id', $this->userId)
            ->where('game_id', $this->gameId)
            ->first();
        if(!isset($recruitment))
        {
            $recruitment = new \App\Models\Recruitment();
        }
        $recruitment->hr_manager = $this->slider_1;
        $recruitment->bdm = $this->slider_2;
        $recruitment->sales_manager = $this->slider_3;
        $recruitment->user_id = $this->userId;
        $recruitment->game_id = $this->gameId;
        $recruitment->save();
        //        return $recruitment;

        $this->setRecruitmentToBudget($recruitment);
    }

    public function setRecruitmentToBudget($recruitment)
    {
        $budgets_for_all_country = Budget::where('user_id',$this->userId)->where('game_id',$this->gameId)->get();
        foreach($budgets_for_all_country as $budget){
            $budget->recruitment = $recruitment->hr_manager +  $recruitment->bdm + $recruitment->sales_manager;
            $budget->save();
        }
    }

    public function setAllFields(){
        $recruitment = \App\Models\Recruitment::where('user_id', $this->userId)
            ->where('game_id', $this->gameId)
            ->first();
        if(!is_null($recruitment)){
            $this->slider_1 = $recruitment->hr_manager;
            $this->slider_2 = $recruitment->bdm;
            $this->slider_3 = $recruitment->sales_manager;
            $recruitment->save();
        }
    }


    public function mount()
    {
        $this->userId = Auth::user()->id;
        $this->gameId = Session::get("game_id");
        $this->setAllFields();
    }

    public function render()
    {
        $this->updateDB();
        // max amount limit check
        if (($this->slider_1 + $this->slider_2 + $this->slider_3) > $this->max_recruitment_budget) {
            session()->flash('error', 'Your value is geather than your budget.');
        } else {
        }
        return view('livewire.recruitment');
    }
}