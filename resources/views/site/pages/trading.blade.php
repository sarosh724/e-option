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
                'http://127.0.0.1:8000/trading/coin-rate/1'
            ).then(response => response.json());

            Highcharts.stockChart('container', {
                chart: {
                    // type: 'bar',
                    backgroundColor: '#000'
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
@stop
