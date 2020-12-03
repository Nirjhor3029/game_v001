<div wire:poll.750ms>
    <div class="card">
        <div class="card-body">
            <canvas id="PieChartDicisionDriven" width="400" height="400"></canvas>
            <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Market share<p>
        </div>
        {{$red}}
        <button wire:click="update">update</button>
    </div>

    <script>
        var piechartdicision = document.getElementById('PieChartDicisionDriven').getContext('2d');
        var myPieChart = new Chart(piechartdicision, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [{{$red}}, {{$yellow}}, {{$blue}}]
                }],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    'Red',
                    'Yellow',
                    'Blue'
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</div>


{{-- <div wire:poll.750ms>
    Current time: {{ now() }}
</div> --}}