<div>
    {{-- The best athlete wants his opponent at his best. --}}


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
        

    <!--start for bd market -->
    <div class="row">
        <div class="col-md-6">
            <div style="padding:20px 20px 10px 20px;background-color:#5B9BD5">
                <h4 style="text-align:center;color:white;">Total Budget BD</h4>
            </div>
        </div>
        <div class="col-md-6" style="padding:20px 20px 10px 20px;background-color:#7030A0">
         <h4 style="text-align:center;color:white;">{{$output_total_budget}} BDT</h4>     
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div style="padding:20px 20px 10px 20px;background-color:#D0CECE">
                <h4 style="text-align:center;color:white;">Recruitment</h4>
            </div>
        </div>
        <div class="col-md-6" style="padding:20px 20px 10px 20px;background-color:#F4F5F7">
            <input type="number" step=".001" class="form-control" name="" wire:model="recruitment_bd" />    
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div style="padding:20px 20px 10px 20px;background-color:#D0CECE">
                <h4 style="text-align:center;color:white;">Manufacturing</h4>
            </div>
        </div>
        <div class="col-md-6" style="padding:20px 20px 10px 20px;background-color:#F4F5F7">
            <input type="number" step=".001" class="form-control" name="" wire:model="manufacturing_bd" readonly onclick="popup()"/>   
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div style="padding:20px 20px 10px 20px;background-color:#D0CECE">
                <h4 style="text-align:center;color:white;">Launch</h4>
            </div>
        </div>
        <div class="col-md-6" style="padding:20px 20px 10px 20px;background-color:#F4F5F7">
            <input type="number" step=".001" class="form-control" name="" wire:model="launch_bd" />   
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div style="padding:20px 20px 10px 20px;background-color:#D0CECE">
                <h4 style="text-align:center;color:white;">Other</h4>
            </div>
        </div>
        <div class="col-md-6" style="padding:20px 20px 10px 20px;background-color:#F4F5F7">
            <input type="number" step=".001" class="form-control" name="" wire:model="other_bd" />    
        </div>
    </div>
    <!--end for bd market -->
    

        <!--start for bd market -->
        <div class="row" style="margin-top:50px;">
            <div class="col-md-6">
                <div style="padding:20px 20px 10px 20px;background-color:#5B9BD5">
                    <h4 style="text-align:center;color:white;">Total Budget NP</h4>
                </div>
            </div>
            <div class="col-md-6" style="padding:20px 20px 10px 20px;background-color:#7030A0">
             <h4 style="text-align:center;color:white;">{{$output_total_budget_np}} BDT</h4>     
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-6">
                <div style="padding:20px 20px 10px 20px;background-color:#D0CECE">
                    <h4 style="text-align:center;color:white;">Recruitment</h4>
                </div>
            </div>
            <div class="col-md-6" style="padding:20px 20px 10px 20px;background-color:#F4F5F7">
                <input type="number" step=".001" class="form-control" name="" wire:model="recruitment_np" />    
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-6">
                <div style="padding:20px 20px 10px 20px;background-color:#D0CECE">
                    <h4 style="text-align:center;color:white;">Manufacturing</h4>
                </div>
            </div>
            <div class="col-md-6" style="padding:20px 20px 10px 20px;background-color:#F4F5F7">
                <input type="number" step=".001" class="form-control" name="" wire:model="manufacturing_np" readonly onclick="popup()"/>   
            </div>
        </div>
    
    
        <div class="row">
            <div class="col-md-6">
                <div style="padding:20px 20px 10px 20px;background-color:#D0CECE">
                    <h4 style="text-align:center;color:white;">Launch</h4>
                </div>
            </div>
            <div class="col-md-6" style="padding:20px 20px 10px 20px;background-color:#F4F5F7">
                <input type="number" step=".001" class="form-control" name="" wire:model="launch_np" />   
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-6">
                <div style="padding:20px 20px 10px 20px;background-color:#D0CECE">
                    <h4 style="text-align:center;color:white;">Other</h4>
                </div>
            </div>
            <div class="col-md-6" style="padding:20px 20px 10px 20px;background-color:#F4F5F7">
                <input type="number" step=".001" class="form-control" name="" wire:model="other_np" />    
            </div>
        </div>
        <!--end for bd market -->

        <div class="row" style="margin-top:50px;">
            <div class="col-md-6">
                <div style="padding:20px 20px 10px 20px;background-color:#5B9BD5">
                    <h4 style="text-align:center;color:white;">Total Budget</h4>
                </div>
            </div>
            <div class="col-md-6" style="padding:20px 20px 10px 20px;background-color:#7030A0">
                <h4 style="text-align:center;color:white;">{{$output_total_budget_np + $output_total_budget}}  BDT</h4>     
            </div>
        </div>


</div>

<script>
    function popup() {
        alert("Can’t insert any value here.This is inconsistent to the case.");
    }
</script>