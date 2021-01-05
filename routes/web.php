<?php

use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
})->name('dashboard');


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::post('start-the-game', [\App\Http\Controllers\Game\StartGameController::class, 'store'])->name('start_the_game');
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


// will Delete this routes
Route::get('/demo ', function () {
    return "hello";
});
