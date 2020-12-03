<?php

namespace App\Http\Controllers;


use App\Models\Game\FinancialOptions;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\Game\FinancialStatement;
use App\Models\Game\FinancialStatementItems;
use App\Models\Game\CashFlowStatement;
use App\Models\Game\CashFlowStatementItems;

class GamePageController extends Controller
{
    //

    public function startTheGame()
    {
    }


    public function overview()
    {
        return view('game_views.overview');
    }

    public function budgeting()
    {
        return view('game_views.budgeting');
    }
    public function recruitment()
    {
        return view('game_views.recruitment');
    }

    public function revenue()
    {
        return view('game_views.revenue');
    }
    public function revenue_np()
    {
        return view('game_views.revenue-np');
    }
    public function revenueOther()
    {
        return view('game_views.revenue-other');
    }

    public function financialStatements()
    {
        $options = FinancialOptions::get();

        $financial = FinancialStatement::where(['game_id' => Session::get('game_id'), 'user_id' => Auth::guard('web')->user()->id, 'session_id' => Session::getId()])->get()->first();

        $revenueData = null;
        $expensesData = null;
        $total_revenue = 0;
        $total_expenses = 0;
        $total_income = 0;

        if (!is_null($financial)) {
            $total_revenue = $financial->total_revenue;
            $total_expenses = $financial->total_expanses;
            $total_income = $total_revenue - $total_expenses;
            $revenueData = FinancialStatementItems::where(['financial_id' => $financial->id, 'type' => 'revenue'])->get();
            $expensesData = FinancialStatementItems::where(['financial_id' => $financial->id, 'type' => 'expenses'])->get();

            $data =  FinancialStatementItems::where(['financial_id' => $financial->id, 'type' => 'revenue'])->get()->toArray();

            //$result = array_diff($options->toArray(), $data);
            //dd($options->toArray());
        }
        return view('game_views.finalcial-statement', [
            'revenueData' => $revenueData,
            'expensesData' => $expensesData,
            'options' => $options,
            'total_revenue' => $total_revenue,
            'total_expenses' => $total_expenses,
            'total_income' => $total_income,
        ]);
    }


    public function cashFlowStatements()
    {
        $options = FinancialOptions::get();

        $financial = CashFlowStatement::where(['game_id' => Session::get('game_id'), 'user_id' => Auth::guard('web')->user()->id, 'session_id' => Session::getId()])->get()->first();

        $revenueData = null;
        $expensesData = null;
        $total_revenue = 0;
        $total_expenses = 0;
        $total_income = 0;

        if (!is_null($financial)) {
            $total_revenue = $financial->total_revenue;
            $total_expenses = $financial->total_expanses;
            $total_income = $total_revenue - $total_expenses;
            $revenueData = CashFlowStatementItems::where(['cash_flow_statement_id' => $financial->id, 'type' => 'revenue'])->get();
            $expensesData = CashFlowStatementItems::where(['cash_flow_statement_id' => $financial->id, 'type' => 'expenses'])->get();

            $data =  CashFlowStatementItems::where(['cash_flow_statement_id' => $financial->id, 'type' => 'revenue'])->get()->toArray();

            //$result = array_diff($options->toArray(), $data);
            //dd($options->toArray());
        }
        return view('game_views.cash-flow-statement', [
            'revenueData' => $revenueData,
            'expensesData' => $expensesData,
            'options' => $options,
            'total_revenue' => $total_revenue,
            'total_expenses' => $total_expenses,
            'total_income' => $total_income,
        ]);
    }



    public function decisionDriven()
    {
        return view('game_views.decision-driven');
    }


    public function coursePoints()
    {
        return view('game_views.course-points');
    }
}