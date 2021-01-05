<div>
    @section('nextUrl',$nextUrl)
    @section('previousUrl',$previousUrl)
    
    @if (session()->has('error'))
            <div class="alert alert-success">
                {{ session('error') }}
            </div>
    @endif
    @if (!$check_null)
            <div class="alert alert-danger">
                Field can not be empty
            </div>
    @endif
    {{-- Nepal Box Start --}}
    <div class="box">
        <div class="row">
            <div class="col-md-6 ">
                Product A
                <div class="sub-box">
                    <div class="row single-field">
                        <div class="col-md-6 ">
                            <input type="number"  class="form-control input-field" name="" wire:model="np_a_productCost"/>
                        </div>
                        <div class="col-md-6">
                            Production cost
                        </div>
                    </div>
                    <div class="row single-field">
                        <div class="col-md-6 ">
                            <input type="number"  class="form-control input-field" name="" wire:model="np_a_opex" readonly/>
                        </div>
                        <div class="col-md-6">
                            OPEX
                        </div>
                    </div>
                    <div class="row single-field">
                        <div class="col-md-6 ">
                            <input type="number"  class="form-control input-field" name="" wire:model="np_a_totalCost" readonly/>
                        </div>
                        <div class="col-md-6">
                            Total cost
                        </div>
                    </div>
                    <div class="row single-field">
                        <div class="col-md-6 ">
                            <input type="number"  class="form-control input-field" name="" wire:model="np_a_competitorsPrice" />
                        </div>
                        <div class="col-md-6">
                            Competitor’s Price
                        </div>
                    </div>
                    <div class="row single-field">
                        <div class="col-md-6 ">
                            <input type="range" step="1"  class="markUp_slider input-field" name="" wire:model="np_a_markup" min="0" max="100"/>
                            {{$np_a_markup}}%
                        </div>
                        <div class="col-md-6">
                            Mark up %
                        </div>
                    </div>
                </div>

                <div class="row row-price">
                    <div class="col-md-6 price-txt">
                        Price
                    </div>
                    <div class="col-md-6">
                        <input type="number"  class="form-control input-field" name="" wire:model="np_a_price" readonly/>
                    </div>
                </div>

                <div class="row row-unitsold">
                    <div class="col-md-12 col-unitsold ">
                        Units Sold
                    </div>
                </div>
                <div class="row revenue_radio_box">
                    <div class="col-md-2 revenue_radio">
                        <input type="radio"  class="form-control input-field input_unitsold"  wire:model="np_a_unitSold" value="0"/> 0
                    </div>
                    <div class="col-md-2 revenue_radio">
                        <input type="radio"  class="form-control input-field input_unitsold"  wire:model="np_a_unitSold" value="20"/> 20
                    </div>
                    <div class="col-md-2 revenue_radio">
                        <input type="radio"  class="form-control input-field input_unitsold"  wire:model="np_a_unitSold" value="30"/> 30
                    </div>
                    <div class="col-md-2 revenue_radio">
                        <input type="radio"  class="form-control input-field input_unitsold"  wire:model="np_a_unitSold" value="40"/> 40
                    </div>
                    <div class="col-md-2 revenue_radio">
                        <input type="radio"  class="form-control input-field input_unitsold"  wire:model="np_a_unitSold" value="50"/> 50
                    </div>
                </div>

                <div class="row row-unitsold">
                    <div class="col-md-12 col-unitsold ">
                        Revenue
                    </div>
                </div>
                <div class="row row-unitsold">
                    <div class="col-md-12">
                        <input type="number"  class="form-control input-field" name="" wire:model="np_a_revenue" readonly/>
                    </div>
                </div>
                
            </div>
    
            <div class="col-md-6 ">
                Product B
                <div class="sub-box">
                    <div class="row single-field">
                        <div class="col-md-6 ">
                            <input type="number"  class="form-control input-field" name="" wire:model="np_b_productCost"/>
                        </div>
                        <div class="col-md-6">
                            Production cost
                        </div>
                    </div>
                    <div class="row single-field">
                        <div class="col-md-6 ">
                            <input type="number"  class="form-control input-field" name="" wire:model="np_b_opex" readonly/>
                        </div>
                        <div class="col-md-6">
                            OPEX
                        </div>
                    </div>
                    <div class="row single-field">
                        <div class="col-md-6 ">
                            <input type="number"  class="form-control input-field" name="" wire:model="np_b_totalCost" readonly/>
                        </div>
                        <div class="col-md-6">
                            Total cost
                        </div>
                    </div>
                    <div class="row single-field">
                        <div class="col-md-6 ">
                            <input type="number"  class="form-control input-field" name="" wire:model="np_b_competitorsPrice" />
                        </div>
                        <div class="col-md-6">
                            Competitor’s Price
                        </div>
                    </div>
                    <div class="row single-field">
                        <div class="col-md-6 ">
                            <input type="range" step="1"  class="markUp_slider input-field" name="" wire:model="np_b_markup" min="0" max="100"/>
                            {{$np_b_markup}}%
                        </div>
                        <div class="col-md-6">
                            Mark up %
                        </div>
                        
                    </div>

                    
                </div>
                


                <div class="row row-price">
                    <div class="col-md-6 price-txt">
                        Price
                    </div>
                    <div class="col-md-6">
                        <input type="number"  class="form-control input-field" name="" wire:model="np_b_price" readonly/>
                    </div>
                </div>
                <div class="row row-unitsold">
                    <div class="col-md-12 col-unitsold ">
                        Units Sold
                    </div>
                </div>
                <div class="row revenue_radio_box">
                    <div class="col-md-2 revenue_radio">
                        <input type="radio"  class="form-control input-field input_unitsold"  wire:model="np_b_unitSold" value="0"/> 0
                    </div>
                    <div class="col-md-2 revenue_radio">
                        <input type="radio"  class="form-control input-field input_unitsold"  wire:model="np_b_unitSold" value="20"/> 20
                    </div>
                    <div class="col-md-2 revenue_radio">
                        <input type="radio"  class="form-control input-field input_unitsold"  wire:model="np_b_unitSold" value="30"/> 30
                    </div>
                    <div class="col-md-2 revenue_radio">
                        <input type="radio"  class="form-control input-field input_unitsold"  wire:model="np_b_unitSold" value="40"/> 40
                    </div>
                    <div class="col-md-2 revenue_radio">
                        <input type="radio"  class="form-control input-field input_unitsold"  wire:model="np_b_unitSold" value="50"/> 50
                    </div>
                </div>
                <div class="row row-unitsold">
                    <div class="col-md-12 col-unitsold ">
                        Revenue
                    </div>
                </div>
                <div class="row row-unitsold">
                    <div class="col-md-12">
                        <input type="number"  class="form-control input-field" name="" wire:model="np_b_revenue" readonly/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-title">
            <div class="col-md-12">
                <h3>Nepal</h3>
            </div>
        </div>
    </div>

</div>

<script>
    function popup() {
        alert("Can’t insert any value here.This is inconsistent to the case.");
    }
</script>