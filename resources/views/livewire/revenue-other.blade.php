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
    @if (!$check_previous_game)
            <div class="alert alert-danger">
                Play BD Revenue & Nepal Revenue 1st.
            </div>
    @endif

    {{-- New Page Bangladesh--}}
    <div class="row">
        <div class="col-md-7" style="min-height: 300px;">
            <livewire:livewire-column-chart
            key="{{ $product_1->reactiveKey() }}"
            :column-chart-model="$product_1"
            />
        </div>


        <div class="col-md 5">
            <div class="box-rev">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row single-field-rev">
                            <div class="col-md-6 ">
                                
                                <span class="lbl">A M1 rev</span>
                            </div>
                            <div class="col-md-6 ">
                                <input type="number"  class="form-control input-field" name="" wire:model="bn_AM1_revenue" readonly/>
                            </div>
                            
                        </div>
                        <div class="row single-field-rev">
                            <div class="col-md-6 ">
                                <span class="lbl">A M2</span>
                            </div>
                            <div class="col-md-6 ">
                                <input type="number"  class="form-control input-field" name="" wire:model="bn_AM2"/>
                            </div>
                            
                        </div>
                        <div class="row single-field-rev">
                            <div class="col-md-6 ">
                                
                                <span class="lbl">A M2 rev</span>
                            </div>
                            <div class="col-md-6 ">
                                <input type="number"  class="form-control input-field" name="" wire:model="bn_AM2_revenue" readonly/>
                            </div>
                            
                        </div>
                        <div class="row single-field-rev">
                            <div class="col-md-6 ">
                                
                                <span class="lbl">B M1 rev</span>
                            </div>
                            <div class="col-md-6 ">
                                <input type="number"  class="form-control input-field" name="" wire:model="bn_BM1_revenue" readonly/>
                            </div>
                            
                        </div>
                        <div class="row single-field-rev">
                            <div class="col-md-6 ">
                                
                                <span class="lbl">B M2</span>
                            </div>
                            <div class="col-md-6 ">
                                <input type="number"  class="form-control input-field" name="" wire:model="bn_BM2"/>
                            </div>
                            
                        </div>
                        <div class="row single-field-rev">
                            <div class="col-md-6 ">
                                
                                <span class="lbl">B M2 rev</span>
                            </div>
                            <div class="col-md-6 ">
                                <input type="number"  class="form-control input-field" name="" wire:model="bn_BM2_revenue" readonly/>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
        
                <div class="row row-title">
                    <div class="col-md-12">
                        Bangladesh
                    </div>
                </div>
                
            </div>
        </div>

    </div>


    {{-- New Page Nepal--}}
    <div class="row" style="margin-top: 50px">
       

        <div class="col-md-7" style="min-height: 300px;">
            <livewire:livewire-column-chart
            key="{{ $product_2->reactiveKey() }}"
            :column-chart-model="$product_2"
            />
        </div>

        <div class="col-md-5">
            <div class="box-rev">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row single-field-rev">
                            <div class="col-md-6 ">
                                <span class="lbl">A M1 rev</span>
                            </div>
                            <div class="col-md-6 ">
                                <input type="number"  class="form-control input-field" name="" wire:model="np_AM1_revenue" readonly />
                            </div>
                            
                        </div>
                        <div class="row single-field-rev">
                            <div class="col-md-6 ">
                                <span class="lbl">A M2</span>
                            </div>
                            <div class="col-md-6 ">
                                <input type="number"  class="form-control input-field" name="" wire:model="np_AM2"/>
                            </div>
                            
                        </div>
                        <div class="row single-field-rev">
                            <div class="col-md-6 ">
                                <span class="lbl">A M2 rev</span>
                            </div>
                            <div class="col-md-6 ">
                                <input type="number"  class="form-control input-field" name="" wire:model="np_AM2_revenue" readonly />
                            </div>
                            
                        </div>
                        <div class="row single-field-rev">
                            <div class="col-md-6 ">
                                <span class="lbl">B M1 rev</span>
                                
                            </div>
                            <div class="col-md-6 ">
                                <input type="number"  class="form-control input-field" name="" wire:model="np_BM1_revenue" readonly />
                            </div>
                            
                        </div>
                        <div class="row single-field-rev">
                            <div class="col-md-6 ">
                                <span class="lbl">B M2</span>
                                
                            </div>
                            <div class="col-md-6 ">
                                <input type="number"  class="form-control input-field" name="" wire:model="np_BM2"/>
                            </div>
                            
                        </div>
                        <div class="row single-field-rev">
                            <div class="col-md-6 ">
                                <span class="lbl">B M1 rev</span>
                                
                            </div>
                            <div class="col-md-6 ">
                                <input type="number"  class="form-control input-field" name="" wire:model="np_BM2_revenue" readonly />
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
        
                <div class="row row-title">
                    <div class="col-md-12">
                        Nepal
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</div>