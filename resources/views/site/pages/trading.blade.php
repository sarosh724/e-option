@extends('site.templates.index')

@section('page-title')
    Trading
@stop

@section('content')
    @include('site.sections.breadcrumb', ['title' => 'trading'])
    <div class="container my-4" id="container"></div>

@stop

@section('scripts')
    <script src="{{asset('assets/site/highcharts/highstock.js')}}"></script>
    <script src="{{asset('assets/site/highcharts/highstock.js')}}"></script>
    <script src="{{asset('assets/site/highcharts/hollowcandlestick.js')}}"></script>
    <script src="{{asset('assets/site/highcharts/accessibility.js.js')}}"></script>
    <script>
        (async () => {

            // Load the dataset
            const chart_data = await fetch(
                'http://127.0.0.1:8000/trading/coin-rate/1'
            ).then(response => response.json());

            Highcharts.stockChart('container', {
                // chart: {
                //     // type: 'bar',
                //     backgroundColor: '#000'
                // },
                // rangeSelector: {
                //     selected: 1
                // },
                // navigator: {
                //     series: {
                //         color: Highcharts.getOptions().colors[0]
                //     }
                // },
                // series: [{
                //     type: 'hollowcandlestick',
                //     name: 'Hollow Candlestick',
                //     data: data
                // }]
                chart: {
                    type: 'candlestick',
                    backgroundColor: 'rgba(10,10,10,0.94)',
                    renderTo: 'container',
                    events: {
                        load: function() {
                            // set up the updating of the chart each second
                            var series = this.series[0];
                            console.log(series)
                            // setInterval(function() {
                            //     var last = series.data[series.data.length - 1];
                            //     var s1 = Math.random() * 2 + 70;
                            //     var s2 = Math.random() * 2 + 70;
                            //     var s3 = Math.random() * 2 + 70;
                            //     // console.log(last);
                            //     series.addPoint([last.x + 1000, s1, Math.max(s1, s2, s3), Math.min(s1, s2, s3), s3], true, true);
                            // }, 1000);
                            // setInterval(function() {
                            //     var nv = Math.random() * 2 + 70;
                            //     var last = series.data[series.data.length - 1];
                            //     var high = Math.max(last.high, nv);
                            //     var low = Math.min(last.low, nv);
                            //
                            //     last.update({
                            //         'high': high,
                            //         'low': low,
                            //         'close': nv
                            //     }, true);
                            //     //series.xAxis.setExtremes(1133395200000, 1135900800000, false, false);
                            //     //series.yAxis.setExtremes(68, 76, true, false);
                            // }, 1000);
                        }
                    }
                },

                rangeSelector: {

                    inputEnabled: false,
                    selected: 0,
                    enabled: false
                },

                scrollbar: {
                    enabled: false
                },
                navigator: {
                    enabled: true
                },

                series: [{
                    name: 'Random data',
                    // data: [
                    //     [1133395200000, 69.93, 71.73, 68.81, 71.60],
                    //     [1133481600000, 72.27, 72.74, 70.70, 72.63],
                    //     [1133740800000, 71.95, 72.53, 71.49, 71.82],
                    //     [1133827200000, 73.93, 74.83, 73.35, 74.05],
                    //     [1133913600000, 74.23, 74.46, 73.12, 73.95],
                    //     [1134000000000, 73.20, 74.17, 72.60, 74.08],
                    //     [1134086400000, 74.21, 74.59, 73.35, 74.33],
                    //     [1134345600000, 74.87, 75.35, 74.56, 74.91],
                    //     [1134432000000, 74.94, 75.46, 74.21, 74.98],
                    //     [1134518400000, 72.53, 73.30, 70.27, 72.01],
                    //     [1134604800000, 72.68, 72.86, 71.35, 72.18],
                    //     [1134691200000, 72.14, 72.30, 71.06, 71.11],
                    //     [1134950400000, 71.11, 72.60, 71.04, 71.38],
                    //     [1135036800000, 71.62, 72.38, 71.12, 72.11],
                    //     [1135123200000, 72.60, 73.61, 72.54, 73.50],
                    //     [1135209600000, 73.91, 74.49, 73.60, 74.02],
                    //     [1135296000000, 74.17, 74.26, 73.30, 73.35],
                    //     [1135641600000, 74.00, 75.18, 73.95, 74.23],
                    //     [1135728000000, 74.47, 74.76, 73.32, 73.57],
                    //     [1135814400000, 73.78, 73.82, 71.42, 71.45],
                    //     [1135900800000, 70.91, 72.43, 70.34, 71.89],
                    // ]
                    data: chart_data
                }
                ]
            });
        })();
    </script>
@stop
