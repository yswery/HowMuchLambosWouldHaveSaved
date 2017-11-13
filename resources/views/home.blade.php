<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">

    </head>
    <body>
        <div class="row">
            <canvas class="col-lg-10 offset-lg-1" id="canvas"></canvas>
        </div>

        <br />

        <div class="row text-center">
            <div class="col-3">
                Total Saved: <strong>${{ round(end($valueOfBtcSaved)) }}</strong>
            </div>
            <div class="col-3">
                BTC Saved: <strong>{{ round($btcBalance, 4) }}</strong>
            </div>
            <div class="col-3">
                Savings Gains: <strong>{{ round(end($valueOfBtcSaved) / end($accumulatedMoney) * 100) }}%</strong>
            </div>
            <div class="col-3">
                Value Of BTC: <strong>${{ round($lastBtcPrice) }}</strong>
            </div>
        </div>

        <script>
            var ctx = document.getElementById("canvas").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [{{ implode(range(1, $savingsPeriodWeeks), ',') }}],
                    datasets: [{
                        label: "Value of BitCoin saved",
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: [ {{ implode($valueOfBtcSaved, ',') }} ],
                        fill: false,
                    }, {
                        label: "Accumulated Money Deposited",
                        fill: false,
                        backgroundColor: 'rgb(54, 162, 235)',
                        borderColor: 'rgb(54, 162, 235)',
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
