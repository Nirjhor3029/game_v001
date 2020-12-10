
/******************* market Share Decision Driven *****************/


/******************* market Share Decision Driven *****************/
















/******************* unitSales graph Decision Driven *****************/
var pricing_compitision = document.getElementById('pricingvscompetition').getContext('2d');
let compitision = new Chart(pricing_compitision, {
    type: 'line',
    data: {
        datasets: [
            {
                label: 'Red Team',
                data: [12, 45, 56],
                type: 'line',
                backgroundColor: "transparent",
                borderColor: "green"

            },
            {
                label: 'Green Team',
                data: [50, 25, 76],
                type: 'line',
                backgroundColor: "transparent",
                borderColor: "blue"

            }
        ],
        labels: ['January', 'February', 'March', 'April']
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    suggestedMin: 50,
                    suggestedMax: 100
                }
            }]
        }
    }
});
/******************* unitSales graph Decision Driven *****************/