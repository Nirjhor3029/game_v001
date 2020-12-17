<div>
    <style>
        .input-sm{

        }
        .input_box{
            padding: 5px;
        }
    </style>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div class="input_box">
        @if (!$check_null)
            <div class="alert alert-danger">
                Field can not be empty
            </div>
        @endif
        
        <div class="row">
            <div class="col-sm-2">
                <label for="">Name</label>
            </div>
            <div class="col-sm-2">
                <label for=""> Assigned value (%)</label>
                
            </div>
            <div class="col-sm-2">
                <label for=""> Actual value</label>
            </div>
            <div class="col-sm-2">
                <label for=""> Point value (%) </label>
            </div>
            <div class="col-sm-2">
                <label for=""> Mark value (%)</label>
            </div>
        </div>
    </div>


    <div class="input_box">
        
        <div class="row">
            <div class="col-sm-2">
                <h4>Market share</h4>
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="market_share_assigned_value" name="market_share_assigned_value" id="" class="form-control input-sm" placeholder="Enter assigned value">
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="market_share_actual_value" name="market_share_actual_value" id="" class="form-control" placeholder="actual value" readonly>
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="market_share_point_value" name="market_share_point_value" id="" class="form-control" placeholder="Enter point value">
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="market_share_mark_value" name="market_share_mark_value" id="" class="form-control" placeholder="mark value" readonly>
            </div>
        </div>
    </div>

    {{-- Revenue Box --}}
    <div class="input_box">
        <div class="row">
            <div class="col-sm-2">
                <h4>Revenue</h4>
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="revenue_assigned_value" name="revenue_assigned_value" id="" class="form-control input-sm" placeholder="Enter assigned value">
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="revenue_actual_value" name="revenue_actual_value" id="" class="form-control" placeholder="actual value" readonly>
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="revenue_point_value" name="revenue_point_value" id="" class="form-control" placeholder="Enter point value">
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="revenue_mark_value" name="revenue_mark_value" id="" class="form-control" placeholder="mark value" readonly>
            </div>
        </div>
    </div>

    {{-- Cost --}}
    <div class="input_box">
        <div class="row">
            <div class="col-sm-2">
                <h4>Cost</h4>
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="cost_assigned_value" name="cost_assigned_value" id="" class="form-control input-sm" placeholder="Enter assigned value">
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="cost_actual_value" name="cost_actual_value" id="" class="form-control" placeholder="actual value" readonly>
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="cost_point_value" name="cost_point_value" id="" class="form-control" placeholder="Enter point value">
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="cost_mark_value" name="cost_mark_value" id="" class="form-control" placeholder="mark value" readonly>
            </div>
        </div>
    </div>


    {{-- Unit sales in countries --}}
    <div class="input_box">
        <div class="row">
            <div class="col-sm-2">
                <h4>Unit sales in countries</h4>
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="usic_assigned_value" name="usic_assigned_value" id="" class="form-control input-sm" placeholder="Enter assigned value">
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="usic_actual_value" name="usic_actual_value" id="" class="form-control" placeholder="actual value" readonly>
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="usic_point_value" name="usic_point_value" id="" class="form-control" placeholder="Enter point value">
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="usic_mark_value" name="usic_mark_value" id="" class="form-control" placeholder="mark value" readonly>
            </div>
        </div>
    </div>


    {{-- Net profit --}}
    <div class="input_box">
        <div class="row">
            <div class="col-sm-2">
                <h4>Net profit</h4>
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="net_profit_assigned_value" name="net_profit_assigned_value" id="" class="form-control input-sm" placeholder="Enter assigned value">
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="net_profit_actual_value" name="net_profit_actual_value" id="" class="form-control" placeholder="actual value" readonly>
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="net_profit_point_value" name="net_profit_point_value" id="" class="form-control" placeholder="Enter point value">
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="net_profit_mark_value" name="net_profit_mark_value" id="" class="form-control" placeholder="mark value" readonly>
            </div>
        </div>
    </div>


    {{-- Pricing vs. Competition --}}
    {{-- <div class="input_box">
        <div class="row">
            <div class="col-sm-2">
                <h4>Pricing vs. Competition</h4>
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="cm_price_assigned_value" name="cm_price_assigned_value" id="" class="form-control input-sm" placeholder="Enter assigned value">
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="cm_price_actual_value" name="cm_price_actual_value" id="" class="form-control" placeholder="actual value" readonly>
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="cm_price_point_value" name="cm_price_point_value" id="" class="form-control" placeholder="Enter point value">
            </div>
            <div class="col-sm-2">
                <input type="number" wire:model="cm_price_mark_value" name="cm_price_mark_value" id="" class="form-control" placeholder="mark value" readonly>
            </div>
        </div>
    </div> --}}
    


</div>
