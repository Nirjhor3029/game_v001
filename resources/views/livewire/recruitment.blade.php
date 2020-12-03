
<div>
    <div class="col-md-12">
        @if (session()->has('error'))
                <div class="alert alert-success">
                    {{ session('error') }}
                </div>
        @endif
        <div class="row">
            <div class="col-md-6 float-left">
                <h5 class="degicnation">HR Manager</h5>
                <img class="photo" src="https://toppng.com/uploads/preview/roger-berry-avatar-placeholder-11562991561rbrfzlng6h.png" alt="Placeholder">
        
                <div class="slidecontainer">
                    {{$min_recruitment_budget}} - {{$max_recruitment_budget}}
                    <input type="range" min="{{$min_recruitment_budget}}" max="{{$max_recruitment_budget}}" value="1" step="1" class="slider" id="myRange" wire:model="slider_1" >
                    {{$slider_1}}
                    {{-- {{$check_max}} --}}
                </div>
                
            </div>
            <div class="col-md-6 float-left">
                <h5 class="degicnation">BDM</h5>
                <img class="photo" src="https://toppng.com/uploads/preview/roger-berry-avatar-placeholder-11562991561rbrfzlng6h.png" alt="Placeholder">
        
                <div class="slidecontainer">
                    {{$min_recruitment_budget}} - {{$max_recruitment_budget}}
                    <input type="range" min="{{$min_recruitment_budget}}" max="{{$max_recruitment_budget}}" value="0" step="1" class="slider" id="myRange" wire:model="slider_2">
                    {{$slider_2}}
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 float-left">
                <h5 class="degicnation">Salse Manager</h5>
                <img class="photo" src="https://toppng.com/uploads/preview/roger-berry-avatar-placeholder-11562991561rbrfzlng6h.png" alt="Placeholder">
        
                <div class="slidecontainer">
                    {{$min_recruitment_budget}} - {{$max_recruitment_budget}}
                    <input type="range" min="{{$min_recruitment_budget}}" max="{{$max_recruitment_budget}}" value="1" step="1" class="slider" id="myRange" wire:model="slider_3">
                    {{$slider_3}}
                </div>
                
            </div>
            <div class="col-md-6 ">
                
            </div>
        </div>
        
    </div>

    <div class="row" style="margin-top:50px;">
        <div class="col-md-6">
            <div style="padding:10px 20px 5px 20px;;background-color:#5B9BD5">
                <h4 style="text-align:center;color:white;">Total OPEX</h4>
            </div>
        </div>
        <div class="col-md-6" style="padding:10px 20px 5px 20px;;background-color:#7030A0">
            <h4 style="text-align:center;color:white;">{{$slider_1+$slider_2+$slider_3}} BDT</h4>     
        </div>
    </div>
</div>


