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
            const data = await fetch(
                'https://demo-live-data.highcharts.com/aapl-ohlcv.json'
            ).then(response => response.json());

            Highcharts.stockChart('container', {
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
@stop
