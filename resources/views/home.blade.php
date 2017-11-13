<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>


    </head>
    <body>
        <div style="width:75%;">
            <canvas id="canvas"></canvas>
        </div>

        <script>
            window.chartColors = {
                red: 'rgb(255, 99, 132)',
                orange: 'rgb(255, 159, 64)',
                yellow: 'rgb(255, 205, 86)',
                green: 'rgb(75, 192, 192)',
                blue: 'rgb(54, 162, 235)',
                purple: 'rgb(153, 102, 255)',
                grey: 'rgb(201, 203, 207)'
            };

            var ctx = document.getElementById("canvas").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [{{ implode(range(1, $savingsPeriodWeeks), ',') }}],
                    datasets: [{
                        label: "Value of BitCoin saved (USD)",
                        backgroundColor: window.chartColors.red,
                        borderColor: window.chartColors.red,
                        data: [
                            20,
                            22,
                            234,
                            211
                        ],
                        fill: false,
                    }, {
                        label: "Accumulated Money Deposited (USD)",
                        fill: false,
                        backgroundColor: window.chartColors.blue,
                        borderColor: window.chartColors.blue,
                        data: [ {{ implode($accumulatedMoney, ',') }} ],
                    }]
                },
                options: {
                    responsive: true,
                    title:{
                        display:true,
                        text:'Historical Savings Gains'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Weeks'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Value ($USD)'
                            }
                        }]
                    }
                }
            });


        </script>

    </body>
</html>
