<div wire:poll.750ms>
    @section('nextUrl',$nextUrl)
    @section('previousUrl',$previousUrl)
    
    <div class="card">
        <div class="card-body">
            <canvas id="PieChartDicisionDriven" width="400" height="400"></canvas>
            
            <p style="margin-top:10px;text-align:center;font-weight:bolder;font-size:22px">Market share<p>
        </div>
    </div>

    <script>
        var piechartdicision = document.getElementById('PieChartDicisionDriven').getContext('2d');
        var myPieChart = new Chart(piechartdicision, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [{{$market_share}},{{$MARKET_TOTAL_SELL_VALUE}}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                }],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    'market share',
                    'total market sell'
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            // beginAtZero: false
                            min: 1,
                            max:{{$MARKET_TOTAL_SELL_VALUE}}
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