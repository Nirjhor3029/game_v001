<?php

use App\Http\Controllers\Game\gm2\IndexController;
use App\Http\Controllers\Gm2\AjaxController;
use App\Http\Controllers\Gm2\Gm2AjaxController;
use App\Models\Cost;
use App\Models\Game\FinancialOptions;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $user_type = Auth::user()->type; //1=admin,2=teacher,3=student
    if($user_type == 2){
        return view('game_views.gm2.admin.dashboard');
    }else{
        return view('dashboard');
    }
    // return $user_type;

})->name('dashboard');


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    // Route::post('start-the-game', [\App\Http\Controllers\Game\StartGameController::class, 'store'])->name('start_the_game');

    Route::get('submit-game', [\App\Http\Controllers\Game\StartGameController::class, 'submitGame'])->name('submitGame');

    Route::get('overview', [\App\Http\Controllers\GamePageController::class, 'overview'])->name('overview');
    Route::get('budgeting', [\App\Http\Controllers\GamePageController::class, 'budgeting'])->name('budgeting');
    Route::get('recruitment', [\App\Http\Controllers\GamePageController::class, 'recruitment'])->name('recruitment');
    Route::get('revenue', [\App\Http\Controllers\GamePageController::class, 'revenue'])->name('revenue');
    Route::get('revenue-np', [\App\Http\Controllers\GamePageController::class, 'revenue_np'])->name('revenue_np');
    Route::get('revenue-other', [\App\Http\Controllers\GamePageController::class, 'revenueOther'])->name('revenueOther');
    Route::get('financial-statements', [\App\Http\Controllers\GamePageController::class, 'financialStatements'])->name('financial-statements');
    Route::get('cash-flow-statements', [\App\Http\Controllers\GamePageController::class, 'cashFlowStatements'])->name('cash-flow-statements');
    Route::get('decision-driven', [\App\Http\Controllers\GamePageController::class, 'decisionDriven'])->name('decision-driven');
    Route::get('course-points', [\App\Http\Controllers\GamePageController::class, 'coursePoints'])->name('course-points');

    // Ajax routes
    Route::get('update-revenue-chart/{marketPlace}/{product}/{month}', [\App\Http\Controllers\Game\DecisionDrivenController::class, 'updateRevenueChart'])->name('updateRevenueChart');
    Route::get('update-cost-chart', [\App\Http\Controllers\Game\DecisionDrivenController::class, 'updateCostChart'])->name('updateCostChart');
    Route::get('update-unit-sales-chart', [\App\Http\Controllers\Game\DecisionDrivenController::class, 'updateUnitSalesChart'])->name('updateUnitSalesChart');
    Route::get('update-pricing-competition-chart', [\App\Http\Controllers\Game\DecisionDrivenController::class, 'updatePricingCompetitionChart'])->name('updatePricingCompetitionChart');


    // Later moved to admin middleware
    Route::get('admin', [\App\Http\Controllers\Admin\AdminController::class, 'takeInput'])->name('admin');
});


//ajax request route for Drag & Drop part
Route::post('add-revenues', [\App\Http\Controllers\AjaxRequestController::class, 'addRevenue']);
Route::post('add-expenses', [\App\Http\Controllers\AjaxRequestController::class, 'addExpenses']);
Route::post('add_cash_flow', [\App\Http\Controllers\AjaxRequestController::class, 'addCashFlow']);
Route::post('add-cash-flow-expenses', [\App\Http\Controllers\AjaxRequestController::class, 'addCashFlowExpenses']);

$restaurant = \App\Models\Restaurant::get();
Route::view('/demo', 'demo', ['options' => $restaurant]);

// added robin hossain
Route::name('gm2.')->prefix('gm2')->namespace('Gm2')->middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::post('start-the-game', [\App\Http\Controllers\Game\StartGameController::class, 'startGame2'])->name('startGame2');

    Route::get('overview', [\App\Http\Controllers\Gm2\GamePageController::class, 'overview']);

    // Route::view('/graph', 'gm2.market_scenario');

    Route::get('market_scenario', [\App\Http\Controllers\Gm2\GamePageController::class, 'market_scenario_2'])->name("market_scenario");
    Route::get('market_scenario_defend', [\App\Http\Controllers\Gm2\GamePageController::class, 'market_scenario_defend'])->name('market_scenario_defend');

    // Route::view('/market_scenario', 'gm2.market_scenario');

    Route::post('subcat', function (Request $request) {
        // dd($request->all());
        $parent_id = $request->input('cat_id');
        // $type = $request->input('type');
        $subcategories = Cost::where('id', $parent_id)
            ->with('subCosts')
            ->get();
        return response()->json([
            'subcategories' => $subcategories
        ]);
    })->name('subcat');
    Route::get('user_graph', [\App\Http\Controllers\Gm2\GamePageController::class, 'show_users_graph'])->name('user_graph');
    Route::post('add_user_graph', [\App\Http\Controllers\Gm2\GamePageController::class, 'add_users_graph']);
    Route::post('gm2_attack', [Gm2AjaxController::class, 'gm2_attack'])->name('gm2_attack');


    Route::post('admin/gm2_update_group', [Gm2AjaxController::class, 'updateGroup'])->name('gm2_update_group');
    Route::post('admin/gm2_update_restaurant_group', [Gm2AjaxController::class, 'updateRestaurantGroup'])->name('admin.gm2_update_restaurant_group');
    Route::post('admin/assign_student', [Gm2AjaxController::class, 'assignStudent'])->name('admin.assign_student');

    Route::post('admin/add_restaurant_point', [Gm2AjaxController::class, 'addRestaurantPoint'])->name('admin.add_restaurant_Point');


    Route::post('set_student_criteria', [Gm2AjaxController::class, 'setStudentCriteria'])->name('set_student_criteria');
    Route::post('user_set_group', [Gm2AjaxController::class, 'userSetGroup'])->name('user_set_group');

    Route::post('defend_market', [IndexController::class, 'defendMarket'])->name('defend_market');


    Route::view('level_table', 'gm2.level_table');
    Route::get('result', [IndexController::class, 'result'])->name("result");
    Route::view('admin/', 'game_views.gm2.admin.dashboard')->name('admin.dashboard');


    Route::get('admin/criteria_combination', [\App\Http\Controllers\Game\gm2\IndexController::class, 'criteria_combination'])->name('admin.criteria_combination');
    Route::post('admin/criteria_combination', [\App\Http\Controllers\Game\gm2\IndexController::class, 'criteria_combination_post'])->name('admin.criteria_combination');

    Route::get('admin/set_group', [\App\Http\Controllers\Game\gm2\IndexController::class, 'setGroup'])->name('admin.set_group');

    Route::get('admin/set_restaurant', [\App\Http\Controllers\Game\gm2\IndexController::class, 'setRestaurant'])->name('admin.set_restaurant');
    Route::get('admin/set_restaurant2', [\App\Http\Controllers\Game\gm2\IndexController::class, 'setRestaurant2'])->name('admin.set_restaurant2');


    Route::get('admin/assign_student', [\App\Http\Controllers\Game\gm2\IndexController::class, 'assignStudent'])->name('admin.assign_student');


    Route::get('admin/user-role', [\App\Http\Controllers\Game\gm2\Gm2AdminController::class, 'userRole'])->name('admin.user_role');
    Route::get('admin/user-manage/{id}', [\App\Http\Controllers\Game\gm2\Gm2AdminController::class, 'userManage'])->name('admin.user_manage');

    Route::get('/task1', [IndexController::class,'get_task_one_result']);
    Route::get('/task2', [IndexController::class,'get_task_two_result']);

});


// added by nirjhor

Route::name('gm2.')->prefix('gm2')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/drag', function () {
        $options = FinancialOptions::select(['title', 'value'])->whereStatus(0)->get();
        return view('game_views.drag', compact('options'));
    });

    Route::get('/', [\App\Http\Controllers\Game\gm2\IndexController::class, 'index']);
    Route::get('/strategic_group', [\App\Http\Controllers\Game\gm2\IndexController::class, 'strategic_group'])->name("strategic_group");
    Route::get('/marketing_strategy', [\App\Http\Controllers\Game\gm2\IndexController::class, 'marketing_strategy'])->name('marketing_strategy');
    Route::get('/development_of_strategic_group', [\App\Http\Controllers\Game\gm2\IndexController::class, 'development_of_strategic_group'])->name('development_of_strategic_group');
    Route::get('/game', [\App\Http\Controllers\Game\gm2\IndexController::class, 'game'])->name('game');

    Route::post('add_graph', [\App\Http\Controllers\Gm2\GamePageController::class, 'addGraph']);

});

Route::get('/test', function () {
    $promotion_options = Config::get('game.game2.promotion_options');
    $market_promotion_values = [0, 10, 20];
    return $promotion_options[0]['name'];
});

Route::get('/migrate', function () {
    Artisan::call('migrate',);
});

Route::get('/test2', [IndexController::class,'test2']);
