<div>
    <div class="container-fluid my-4" id="container"></div>
</div>

<script>
    (async () => {

        // Load the dataset
        const data = await fetch(
            'https://demo-live-data.highcharts.com/aapl-ohlcv.json'
        ).then(response => response.json());

        Highcharts.stockChart('container', {
            chart: {
                // type: 'bar',
                backgroundColor: '#212529',
                height: '600px'
            },
            rangeSelector: {
                selected: 1
            },
            navigator: {
                series: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            series: [{
                type: 'hollowcandlestick',
                name: 'Hollow Candlestick',
                data: data
            }]
        });
    })();
</script>
