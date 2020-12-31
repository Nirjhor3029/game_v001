<?php

namespace App\Http\Controllers;

use App\Models\Game\FinancialStatement;
use App\Models\Game\FinancialStatementItems;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\Game\CashFlowStatement;
use App\Models\Game\CashFlowStatementItems;

class AjaxRequestController extends Controller
{
    public function addRevenue(Request $request)
    {
        //return($request);
        $financial = FinancialStatement::where(['game_id' => Session::get('game_id'), 'user_id' => Auth::guard('web')->user()->id, 'session_id' => Session::getId()])->get()->first();
        if (is_null($financial)) {
            $financial = new FinancialStatement();
            $financial->session_id = Session::getId();
            $financial->total_revenue = $request->totalreview;
            $financial->game_id = Session::get('game_id');
            $financial->user_id = Auth::guard('web')->user()->id;
            $financial->save();
        } else {
            $financial->total_revenue = $request->totalreview;
            $financial->update();
        }
        // return $financial;

        //remove old items
        FinancialStatementItems::where(['session_id' => Session::getId(), 'financial_id' => $financial->id, 'type' => 'revenue'])->delete();
        if ($request->filled('sendData')) {
            foreach ($request->sendData as $items) {
                //add new items
                $final_items = new FinancialStatementItems();
                $final_items->financial_id = $financial->id;
                $final_items->title = $items['tag'];
                $final_items->value = $items['pay'];
                $final_items->session_id = Session::getId();
                $final_items->save();
            }
        }

    }


    public function addExpenses(Request $request)
    {

        $financial = FinancialStatement::where(['game_id' => Session::get('game_id'), 'user_id' => Auth::guard('web')->user()->id, 'session_id' => Session::getId()])->get()->first();
        if (is_null($financial)) {
            $financial = new FinancialStatement();
            $financial->session_id = Session::getId();
            $financial->total_expanses = $request->totalreview;
            $financial->game_id = Session::get('game_id');
            $financial->user_id = Auth::guard('web')->user()->id;
            $financial->save();
        } else {
            $financial->total_expanses = $request->totalreview;
            $financial->update();
        }

        //remove old items
        FinancialStatementItems::where(['session_id' => Session::getId(), 'financial_id' => $financial->id, 'type' => 'expenses'])->delete();

        if ($request->filled('sendData')) {
            foreach ($request->sendData as $items) {
                //add new items
                $final_items = new FinancialStatementItems();
                $final_items->financial_id = $financial->id;
                $final_items->title = $items['tag'];
                $final_items->value = $items['pay'];
                $final_items->session_id = Session::getId();
                $final_items->type = 'expenses';
                $final_items->save();
            }
        }

        // print_r($request->sendData);
    }


    public function addCashFlow(Request $request)
    {
         //dd ($request->dataId);

        $financial = CashFlowStatement::where(['game_id' => Session::get('game_id'), 'user_id' => Auth::guard('web')->user()->id, 'session_id' => Session::getId()])->get()->first();

        if (is_null($financial)) {
            $financial = new CashFlowStatement();
            $financial->session_id = Session::getId();
            $financial->total_revenue = $request->totalreview['revenue'];
            $financial->total_expanses = $request->totalreview['expense'];
            $financial->game_id = Session::get('game_id');
            $financial->user_id = Auth::guard('web')->user()->id;
            $financial->save();
        } else {
            $financial->total_revenue = $request->totalreview['revenue'];
            $financial->total_expanses = $request->totalreview['expense'];
            $financial->update();
        }


        //remove old items
        CashFlowStatementItems::where(['session_id' => Session::getId(), 'cash_flow_statement_id' => $financial->id, 'type' => $request->dataId])->delete();
        if ($request->filled('sendData')) {
            foreach ($request->sendData as $items) {
                //add new items
                $final_items = new CashFlowStatementItems();
                $final_items->cash_flow_statement_id = $financial->id;
                $final_items->title = $items['tag'];
                $final_items->value = $items['pay'];
                $final_items->type = $request->dataId;
                $final_items->session_id = Session::getId();
                $final_items->save();
            }
        }
    }

}
