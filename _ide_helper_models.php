<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team|null $currentTeam
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $ownedTeams
 * @property-read int|null $owned_teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Admin extends \Eloquent {}
}

namespace App\Models\Admin{
/**
 * App\Models\Admin\Navbar
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int|null $priority
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\SubNavbar[] $subNavbarItem
 * @property-read int|null $sub_navbar_item_count
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar query()
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navbar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Navbar extends \Eloquent {}
}

namespace App\Models\Admin{
/**
 * App\Models\Admin\SubNavbar
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $navbar_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin\Navbar $navbarItem
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar whereNavbarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubNavbar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class SubNavbar extends \Eloquent {}
}

namespace App\Models\Admin{
/**
 * App\Models\Admin\Tutorial
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int|null $priority
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutorial whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Tutorial extends \Eloquent {}
}

namespace App\Models\Admin{
/**
 * App\Models\Admin\TutorialPlaceholder
 *
 * @property int $id
 * @property string|null $title
 * @property string $placeholder
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder query()
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder wherePlaceholder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TutorialPlaceholder whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class TutorialPlaceholder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Configure
 *
 * @property int $id
 * @property float $budget
 * @property float $recruitment_max_budget
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Configure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Configure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Configure query()
 * @method static \Illuminate\Database\Eloquent\Builder|Configure whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configure whereRecruitmentMaxBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configure whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Configure extends \Eloquent {}
}

namespace App\Models\Game{
/**
 * App\Models\Game\Budget
 *
 * @property int $id
 * @property float $recruitment
 * @property float $manufacturing
 * @property float $launch
 * @property float $other
 * @property int $marketplace_id
 * @property int $user_id
 * @property int $game_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Budget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget query()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereLaunch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereManufacturing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereMarketplaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereRecruitment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereUserId($value)
 * @mixin \Eloquent
 */
	class Budget extends \Eloquent {}
}

namespace App\Models\Game{
/**
 * App\Models\Game\CashFlowStatement
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property float $total_revenue
 * @property float $total_expanses
 * @property string $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement query()
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereTotalExpanses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereTotalRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatement whereUserId($value)
 * @mixin \Eloquent
 */
	class CashFlowStatement extends \Eloquent {}
}

namespace App\Models\Game{
/**
 * App\Models\Game\CashFlowStatementItems
 *
 * @property int $id
 * @property string $title
 * @property float $value
 * @property int $cash_flow_statement_id
 * @property string $session_id
 * @property int|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems query()
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereCashFlowStatementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashFlowStatementItems whereValue($value)
 * @mixin \Eloquent
 */
	class CashFlowStatementItems extends \Eloquent {}
}

namespace App\Models\Game{
/**
 * App\Models\Game\FinancialOptions
 *
 * @property int $id
 * @property string $title
 * @property float $value
 * @property int $status 0 = fixed, 1 = dynamic
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialOptions whereValue($value)
 * @mixin \Eloquent
 */
	class FinancialOptions extends \Eloquent {}
}

namespace App\Models\Game{
/**
 * App\Models\Game\FinancialStatement
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property float $total_revenue
 * @property float $total_expanses
 * @property string $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereTotalExpanses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereTotalRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatement whereUserId($value)
 * @mixin \Eloquent
 */
	class FinancialStatement extends \Eloquent {}
}

namespace App\Models\Game{
/**
 * App\Models\Game\FinancialStatementItems
 *
 * @property int $id
 * @property string $title
 * @property float $value
 * @property int $financial_id
 * @property string $session_id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereFinancialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialStatementItems whereValue($value)
 * @mixin \Eloquent
 */
	class FinancialStatementItems extends \Eloquent {}
}

namespace App\Models\Game{
/**
 * App\Models\Game\Marketplace
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Marketplace newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marketplace newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marketplace query()
 * @method static \Illuminate\Database\Eloquent\Builder|Marketplace whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marketplace whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marketplace whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marketplace whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Marketplace extends \Eloquent {}
}

namespace App\Models\Game{
/**
 * App\Models\Game\ResultProcess
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $process_id
 * @property float|null $assigned_value
 * @property float|null $actual_value
 * @property float|null $point_value
 * @property float|null $mark_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess query()
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereActualValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereAssignedValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereMarkValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess wherePointValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereProcessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResultProcess whereUserId($value)
 * @mixin \Eloquent
 */
	class ResultProcess extends \Eloquent {}
}

namespace App\Models\Game{
/**
 * App\Models\Game\RevenueOther
 *
 * @property int $id
 * @property int $revenue_id
 * @property float|null $month1_unit
 * @property float|null $month1_revenue
 * @property float|null $month2_unit
 * @property float|null $month2_revenue
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther query()
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereMonth1Revenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereMonth1Unit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereMonth2Revenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereMonth2Unit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereRevenueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueOther whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class RevenueOther extends \Eloquent {}
}

namespace App\Models\Game{
/**
 * App\Models\Game\StartGame
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Revenue[] $revenue
 * @property-read int|null $revenue_count
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame query()
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame whereUserId($value)
 * @mixin \Eloquent
 * @property-read User $user
 * @property int $status
 * @method static \Illuminate\Database\Eloquent\Builder|StartGame whereStatus($value)
 */
	class StartGame extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Membership
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership query()
 * @mixin \Eloquent
 */
	class Membership extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Recruitment
 *
 * @property int $id
 * @property float $hr_manager
 * @property float $bdm
 * @property float $sales_manager
 * @property int $user_id
 * @property int $game_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereBdm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereHrManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereSalesManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruitment whereUserId($value)
 * @mixin \Eloquent
 */
	class Recruitment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Revenue
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $market_place_id
 * @property int $product_id
 * @property float|null $product_cost
 * @property float|null $opex
 * @property float|null $total_cost
 * @property float|null $competitors_price
 * @property float|null $mark_up
 * @property float|null $price
 * @property float|null $unit_sold
 * @property float|null $revenue
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read StartGame $game
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue query()
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereCompetitorsPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereMarkUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereMarketPlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereOpex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereProductCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereUnitSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereUserId($value)
 * @mixin \Eloquent
 */
	class Revenue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Team
 *
 * @property-read \App\Models\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @mixin \Eloquent
 */
	class Team extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team|null $currentTeam
 * @property-read \Illuminate\Database\Eloquent\Collection|StartGame[] $game
 * @property-read int|null $game_count
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $ownedTeams
 * @property-read int|null $owned_teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Revenue[] $revenue
 * @property-read int|null $revenue_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

