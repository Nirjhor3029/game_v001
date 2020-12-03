<div>
    {{-- Success is as dangerous as failure. --}}

    
            <!--start graph -->
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <livewire:livewire-pie-chart
                            key="{{ $pieChartModel->reactiveKey() }}"
                            :pie-chart-model="$pieChartModel"
                        />
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <livewire:livewire-column-chart
                                key="{{ $columnChartModel->reactiveKey() }}"
                                :column-chart-model="$columnChartModel"
                            />
                        </div>
                    </div>
                </div>

            </div>
            <!--end graph -->




</div>
