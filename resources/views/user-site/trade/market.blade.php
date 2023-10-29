@extends('user-site.trade.trading')

@section('page-title')
    Market
@stop

{{--@section('title')--}}
{{--    Market--}}
{{--@stop--}}

@section('content')

    <div class=" d-flex justify-content-between align-items-center mt-1">
        <div>
            <select class="form-control form-control-sm bg-dark" name="coin" id="coin" onChange="loadChart()" style="width: 150px;">
                <option value="">Currency</option>
                @foreach(getCoins() as $coin)
                    <option value="{{$coin->id}}">{{$coin->name}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="button" id="tradeHistoryCollapse" class="btn btn-sm btn secondary">
                Recent Trades
            </button>
{{--            <button class="btn btn-sm btn secondary mr-2" id="hide-show-trade-history" onclick="show_hide_trade()">Show Trading History</button>--}}
        </div>
    </div>

    <div class="result-box p-0">
        <span class="text-white px-2 py-1 mt-1 rounded" id="time"></span>
        <span class="text-white px-2 py-1 mt-1 rounded" id="trading-rate"></span>
        <span class="text-white px-2 py-1 mt-1 rounded" id="trading-info"></span>
    </div>
{{--<div class="col-md-12">--}}
    <div class="chart-div p-0 py-1">
        <div class="text-white" id="chart_controls"></div>
        <div class="container-fluid my-2 p-0" id="container"></div>
        <div class="button-box p-0">
            <button class="btn btn-success mr-1 px-2" id="btn-buy" data-label="buy">85% Buy</button>
            <button class="btn btn-danger mr-1 px-2" id="btn-sell" data-label="sell">75% Sell</button>
        </div>
    </div>
{{--</div>--}}

    <div id="recent-trades-box">
        <div id="recent-trades-box-dismiss">
            <i class="fas fa-times"></i>
        </div>
        <div class="card border-0 mt-2">
            <div class="card-header bg-success p-0 px-1 py-2">
                <h6 class="m-0 text-white" style="font-family: med;">Recent Trades</h6>
            </div>
            <div class="card-body bg-second p-0 p-1">
                <table class="table table-sm">
                    <tr>
                        <th class="bg-secondary" style="font-size: 14px;" width="15%">Currency</th>
                        <th class="bg-secondary" style="font-size: 14px;" width="15%">Amount</th>
                        <th class="bg-secondary" style="font-size: 14px;" width="15%">Starting Price</th>
                        <th class="bg-secondary" style="font-size: 14px;" width="15%">Closing Price</th>
                        <th class="bg-secondary" style="font-size: 14px;" width="10%">Time</th>
                        <th class="bg-secondary" style="font-size: 14px;" width="10%">Type</th>
                        <th class="bg-secondary" style="font-size: 14px;" width="50%">Result</th>
                    </tr>
                    @if(count($recentTrades) > 0)
                        @foreach($recentTrades as $trade)
                            <tr>
                                <td style="font-size: 12px;">{{$trade->coin_name}}</td>
                                <td style="font-size: 12px;">${{$trade->amount_invested}}</td>
                                <td style="font-size: 12px;">${{$trade->starting_price}}</td>
                                <td style="font-size: 12px;">${{$trade->closing_price}}</td>
                                <td style="font-size: 12px;">{{$trade->time_period}}</td>
                                <td style="font-size: 12px;">{!! statusBadge($trade->label) !!}</td>
                                <td style="font-size: 12px;">
                                    @php
                                        $class = "btn-danger";
                                        $icon = "fa-minus";
                                        $txt = '$'.sprintf("%0.2f", $trade->amount_invested) . " " . $trade->result;

                                        if ($trade->result == "Profit") {
                                            $class = "btn-success";
                                            $icon = "fa-plus";
                                            $txt = '$'.sprintf("%0.2f", $trade->profit) . " " . $trade->result;
                                        }
                                    @endphp
                                    <a class="btn btn-sm {{$class}}"><i class="far {{$icon}} text-white mr-1" style="font-size: 12px;"></i>{{$txt}}</a>
                                </td>
                            </tr>
                        @endforeach
                    @else

                    @endif
                </table>
            </div>
        </div>
    </div>

{{--<div class="mt-3 col-lg-12 col-md-12" id="history-box">--}}
{{--    <div class="card border-0 mt-2">--}}
{{--        <div class="card-header bg-success">--}}
{{--            <h6 class="m-0 text-white" style="font-family: med;">Trading History</h6>--}}
{{--        </div>--}}
{{--        <div class="card-body bg-black border border-dark">--}}
{{--            <div class="table-responsive p-0">--}}
{{--                <table class="table table-sm data-table" id="trading-data-table">--}}
{{--                    <thead class="">--}}
{{--                    <tr>--}}
{{--                        <th width="20%">Coin</th>--}}
{{--                        <th width="20%">Amount Invested</th>--}}
{{--                        <th width="20%">Starting Price</th>--}}
{{--                        <th width="20%">Closing Price</th>--}}
{{--                        <th width="20%">Time Period</th>--}}
{{--                        <th width="20%">Type</th>--}}
{{--                        <th width="20%">Result</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Modal -->
<div class="modal fade" id="tradePeriod" data-backdrop="static" data-keyboard="false" tabindex="-1"
     aria-labelledby="tradePeriodLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-white" id="tradePeriodLabel">Trade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="label" id="label" value="">
                <input type="hidden" name="coin_id" id="coin_id" value="">
                <input type="hidden" name="coin_name" id="coin_name" value="">
                <input type="hidden" name="close" id="close" value="">
                <input type="hidden" name="amt_percent" id="amt_percent" value="0">
                <div>
                    <div class="d-flex justify-content-end align-items-center">
                        <span class="user-account-balance rounded text-white px-4 py-2" style="background: black;"><small>Balance:</small>  ${{sprintf("%0.2f", (auth()->user()->is_demo_account) ? auth()->user()->demo_account_balance : auth()->user()->account_balance)}}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <div style="width: 50%;" class="mr-2">
                            <label class="form-label" for="amt">Enter Amount</label>
                            <input type="number" step="0.01" class="form-control form-control-sm" minlength="1"
                                   required id="amt" name="amt" value="0">
                        </div>
                        <div style="width: 50%;">
                            <label class="form-label" for="profit">Profit</label>
                            <input type="text" class="form-control form-control-sm bg-secondary" readonly id="profit" name="profit" value="0">
                        </div>
                    </div>
                </div>
                <label class="form-label mt-3">Select Period</label>
                <div class="period-box mt-1">

                        <button class="btn btn-sm btn-secondary btn_trade_period mb-3 mr-3" data-type="s" data-period="5">5S</button>

                        <button class="btn btn-sm btn-secondary btn_trade_period mb-3 mr-3" data-type="s" data-period="10">10S</button>

                        <button class="btn btn-sm btn-secondary btn_trade_period mb-3 mr-3" data-type="s" data-period="30">30S</button>

                        <button class="btn btn-sm btn-secondary btn_trade_period mb-3 mr-3" data-type="m" data-period="1">1M</button>

                        <button class="btn btn-sm btn-secondary btn_trade_period mb-3 mr-3" data-type="m" data-period="5">5M</button>

                        <button class="btn btn-sm btn-secondary btn_trade_period mb-3 mr-3" data-type="m" data-period="15">15M</button>

                        <button class="btn btn-sm btn-secondary btn_trade_period mb-3 mr-3" data-type="m" data-period="30">30M</button>

                        <button class="btn btn-sm btn-secondary btn_trade_period mb-3 mr-3" data-type="h" data-period="1">1H</button>

                        <button class="btn btn-sm btn-secondary btn_trade_period mb-3 mr-3" data-type="h" data-period="2">2H</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{--- AM charts - live stock data ---}}
@stop

@section('styles')
<!-- Styles -->
<style>
    .title-box {
        display: none;
    }
    #chart_controls {
        height: auto;
        padding: 0;
        max-width: 100%;
    }

    #container {
        width: 100%;
        height: 100%;
        max-width: 100%
    }

    .am5stock-control-label,
    .am5stock-control-icon,
    .am5stock-control,
    .am5stock-control-button,
    .am5stock-control-dropdown	 {
        color: #ffffff;
    }
</style>

<!-- Chart code -->
@stop

@section('scripts')
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/stock.js"></script>
    {{--<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>--}}
    <script src="https://cdn.amcharts.com/lib/5/themes/Responsive.js"></script>
    {{--<script src="https://cdn.amcharts.com/lib/5/themes/Dark.js"></script>--}}
<script>
    var show_history = true
    var is_trade_running = false;
    var is_trade = false;
    function show_hide_trade() {
        if(show_history){
            $('#history-box').fadeIn();
            loadTradingHistory($('#coin').val())
            show_history = false;
            $('#hide-show-trade-history').text('Hide Trading History');
        }
        else{
            $('#history-box').fadeOut();
            $('#hide-show-trade-history').text('Show Trading History');
            show_history = true;
        }
    }

    var root;
    var is_pump = false;
    var pump_type = '';
    var pump_start = '';
    var pump_end = '';
    $("#history-box").hide();

    $(document).ready(function () {
        $("#recent-trades-box").mCustomScrollbar({
            theme: "minimal"
        });

        $('#recent-trades-box-dismiss, .overlay').on('click', function () {
            $('#recent-trades-box').removeClass('active');
        });

        $('#tradeHistoryCollapse').on('click', function () {
            $('#recent-trades-box').addClass('active');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            loadTradingHistory($('#coin').val())
        });
        // $('#history-box').hide();
        var coin_id = $('#coin option:eq(1)').prop('selected', true);
        // $("#time-type").hide();
        $("#chart-div").hide();
        root = am5.Root.new("container");

        function getCoinPump() {
            if ($("#coin").val()) {
                $.ajax({
                    url: "{{url('trading/get-coin-pump')}}" + "/" + $("#coin").val(),
                    type: "GET",
                    cache: false,
                    processData: false,
                    contentType: "application/json; charset=UTF-8",
                    success: function (res) {
                        if (res.success == true) {
                            pump_type = res.data['pump_type'];
                            pump_start = res.data['start_date_time'];
                            pump_end = res.data['end_date_time'];

                            const current_date_time = formatDateTime(new Date());

                            if (pump_start <= current_date_time && pump_end >= current_date_time) {
                                is_pump = true;
                            } else {
                                is_pump = false;
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // alert(textStatus + ' : ' + errorThrown);
                    }
                });
            }
            else{
                return;
            }
        }

       setInterval(getCoinPump, 10000);

        loadChart();
    });

    function formatDateTime(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Adding 1 to month because it's zero-based
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');

        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

    function loadTradingHistory(coin_id) {
        {{--$('#trading-data-table').DataTable({--}}
        {{--    processing: true,--}}
        {{--    serverSide: true,--}}
        {{--    destroy: true,--}}
        {{--    aaSorting: [[0, "desc"]],--}}
        {{--    columnsDefs: [{--}}
        {{--        orderable: true--}}
        {{--    }],--}}
        {{--    ajax: {url: "{{url('trading/history').'/'.auth()->user()->id}}"+"/"+coin_id},--}}
        {{--    columns: [--}}
        {{--        {data: 'coin', name: 'coin'},--}}
        {{--        {data: 'amount_invested', name: 'amount_invested'},--}}
        {{--        {data: 'starting_price', name: 'starting_price'},--}}
        {{--        {data: 'closing_price', name: 'closing_price'},--}}
        {{--        {data: 'time_period', name: 'time_period'},--}}
        {{--        {data: 'type', name: 'type'},--}}
        {{--        {data: 'result', name: 'result'}--}}
        {{--    ]--}}
        {{--});--}}
    }

    function loadChart() {

        // let date_axis_time_value = $("#time-type").val()

        let date_axis_time_value = 'minute'

        root.dispose();

        coin_id = $("#coin").val();
        let coin_data = [];
        // $("#time-type").fadeIn();
        $("#chart-div").fadeIn();

        // $("#history-box").show();
        loadTradingHistory(coin_id);

        am5.ready(async function () {

            coin_data = await fetch(
                '{{url('trading/coin-rate/')}}' + '/' + coin_id
            ).then(response => response.json());

            // Create root element
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            root = am5.Root.new("container");

            root.setThemes([
                am5themes_Responsive.new(root)
            ]);

            /* remove amchart logo */

            root._logo.dispose();

            // Set themes
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([am5themes_Responsive.new(root)]);

            // Create a stock chart
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/charts/stock-chart/#Instantiating_the_chart
            var stockChart = root.container.children.push(
                am5stock.StockChart.new(root, {})
            );

            // stockChart.svgContainer.autoResize = false;
            // stockChart.svgContainer.measure();

            // Set global number format
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/concepts/formatters/formatting-numbers/
            root.numberFormatter.set("numberFormat", "#,###.0000");

            // Create a main stock panel (chart)
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/charts/stock-chart/#Adding_panels
            var mainPanel = stockChart.panels.push(
                am5stock.StockPanel.new(root, {
                    wheelY: "zoomX",
                    panX: true,
                    panY: true
                })
            );

            var myTooltip = am5.Tooltip.new(root, {});


            // Create value axis
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var valueAxis = mainPanel.yAxes.push(
                am5xy.ValueAxis.new(root, {
                    renderer: am5xy.AxisRendererY.new(root, {
                        pan: "zoom"
                    }),
                    extraMin: 0.1, // adds some space for main series
                    tooltip: myTooltip,
                    numberFormat: "#,###.0000",
                    extraTooltipPrecision: 4
                })
            );

            myTooltip.get("background").set("fill", "#0390fc");
            var dateAxis = mainPanel.xAxes.push(
                am5xy.GaplessDateAxis.new(root, {
                    start: .9,
                    minZoomCount: 10,
                    // maxZoomCount: 10,
                    baseInterval: {
                        timeUnit: date_axis_time_value,
                        count: 1
                    },
                    renderer: am5xy.AxisRendererX.new(root, {}),
                    tooltip: am5.Tooltip.new(root, {})
                })
            );

            // add range which will show current value
            var currentValueDataItem = valueAxis.createAxisRange(valueAxis.makeDataItem({value: 0}));
            var currentLabel = currentValueDataItem.get("label");
            if (currentLabel) {
                currentLabel.setAll({
                    fill: am5.color(0xffffff),
                    background: am5.Rectangle.new(root, {fill: am5.color(0x000000)})
                })
            }

            var currentGrid = currentValueDataItem.get("grid");
            if (currentGrid) {
                currentGrid.setAll({strokeOpacity: 0.5, strokeDasharray: [2, 5], stroke: am5.color(0xffffff)});
            }


            // Add series
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var valueSeries = mainPanel.series.push(
                am5xy.CandlestickSeries.new(root, {
                    name: "AMCH",
                    clustered: false,
                    valueXField: "Date",
                    valueYField: "Close",
                    highValueYField: "High",
                    lowValueYField: "Low",
                    openValueYField: "Open",
                    calculateAggregates: true,
                    xAxis: dateAxis,
                    yAxis: valueAxis,
                    legendValueText:
                        "open: [bold]{openValueY}[/] high: [bold]{highValueY}[/] low: [bold]{lowValueY}[/] close: [bold]{valueY}[/]",
                    legendRangeValueText: ""
                })
            );

            // Set main value series
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/charts/stock-chart/#Setting_main_series
            stockChart.set("stockSeries", valueSeries);

            // Add a stock legend
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/charts/stock-chart/stock-legend/
            var valueLegend = mainPanel.plotContainer.children.push(
                am5stock.StockLegend.new(root, {
                    stockChart: stockChart
                })
            );

            // Set main series
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/charts/stock-chart/#Setting_main_series
            valueLegend.data.setAll([valueSeries]);

            $("#btn-buy").text(`${coin_data.buy_profit}% Buy`);
            $("#btn-sell").text(`${coin_data.sell_profit}% Sell`);
            // Add custom button
            // var buy = mainPanel.plotContainer.children.push(am5.Button.new(root, {
            //     dx: 700,
            //     dy: 400,
            //     layer: 40,
            //     label: am5.Label.new(root, {
            //         text: `${coin_data.buy_profit}% Buy`,
            //         fontSize: 15,
            //         fontWeight: "600",
            //         paddingTop: 0,
            //         paddingRight: 14,
            //         paddingBottom: 0,
            //         paddingLeft: 14,
            //     })
            // }));
            // buy.get("background").setAll({
            //     cornerRadiusTL: 3,
            //     cornerRadiusTR: 3,
            //     cornerRadiusBR: 3,
            //     cornerRadiusBL: 3,
            //     fill: '#1d9c09',
            //     fillOpacity: 1
            // })
            // buy.get("background").states.create("hover", {}).setAll({
            //     fill: am5.color('#068c06'),
            //     fillOpacity: 0.8
            // });

            // buy.get("background").states.create("down", {}).setAll({
            //     fill: am5.color(0xff0000),
            //     fillOpacity: 1
            // });

            // var sell = mainPanel.plotContainer.children.push(am5.Button.new(root, {
            //     dx: 850,
            //     dy: 400,
            //     layer: 40,
            //     label: am5.Label.new(root, {
            //         text: `${coin_data.sell_profit}% Sell`,
            //         fontSize: 15,
            //         fontWeight: "600",
            //         paddingTop: 0,
            //         paddingRight: 14,
            //         paddingBottom: 0,
            //         paddingLeft: 14
            //     })
            // }));
            // sell.get("background").setAll({
            //     cornerRadiusTL: 3,
            //     cornerRadiusTR: 3,
            //     cornerRadiusBR: 3,
            //     cornerRadiusBL: 3,
            //     fill: '#c92112',
            //     fillOpacity: 1
            // });
            // sell.get("background").states.create("hover", {}).setAll({
            //     fill: am5.color('#b51405'),
            //     fillOpacity: 0.8
            // });

            // buy.events.on("click", function(ev) {
            //     var last = valueSeries.data.getIndex(valueSeries.data.length - 1);
            //     $("#label").val("buy");
            //     $("#coin_id").val(coin_data.id);
            //     $("#coin_name").val(coin_data.name);
            //     $("#close").val(last.Close);
            //     $("#amt").val(0);
            //     $("#profit").val(0);
            //     $("#tradePeriod").modal("show");
            //     // calculate("buy", last, coin_data);
            // });
            //
            // sell.events.on('click', function (e) {
            //     var last = valueSeries.data.getIndex(valueSeries.data.length - 1);
            //     $("#label").val("sell");
            //     $("#coin_id").val(coin_data.id);
            //     $("#coin_name").val(coin_data.name);
            //     $("#close").val(last.Close);
            //     $("#amt").val(0);
            //     $("#profit").val(0);
            //     $("#tradePeriod").modal("show");
            //     // calculate("sell", last, coin_data);
            // });

            // Add cursor(s)
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            mainPanel.set(
                "cursor",
                am5xy.XYCursor.new(root, {
                    yAxis: valueAxis,
                    xAxis: dateAxis,
                    snapToSeries: [valueSeries],
                    snapToSeriesBy: "y!"
                })
            );

            // Set up series type switcher
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/charts/stock/toolbar/series-type-control/
            var seriesSwitcher = am5stock.SeriesTypeControl.new(root, {
                stockChart: stockChart
            });

            seriesSwitcher.events.on("selected", function (ev) {
                setSeriesType(ev.item.id);
            });

            // Stock toolbar
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/charts/stock/toolbar/
            var toolbar = am5stock.StockToolbar.new(root, {
                container: document.getElementById("chart_controls"),
                stockChart: stockChart,
                controls: [
                    // am5stock.IndicatorControl.new(root, {
                    //     stockChart: stockChart,
                    //     legend: valueLegend
                    // }),
                    // am5stock.DateRangeSelector.new(root, {
                    //     stockChart: stockChart
                    // }),
                    am5stock.PeriodSelector.new(root, {
                        stockChart: stockChart,
                        periods: [
                            // {timeUnit: "second", count: 5, name: "5S"},
                            // {timeUnit: "second", count: 10, name: "10S"},
                            // {timeUnit: "second", count: 30, name: "30S"},
                            {timeUnit: "minute", count: 1, name: "1Min"},
                            // {timeUnit: "minute", count: 5, name: "5Min"},
                            {timeUnit: "minute", count: 15, name: "15Min"},
                            {timeUnit: "minute", count: 30, name: "30Min"},
                            {timeUnit: "hour", count: 1, name: "1Hr"},
                            {timeUnit: "hour", count: 2, name: "2Hr"},
                        ]
                    }),
                    // seriesSwitcher,
                    // am5stock.DrawingControl.new(root, {
                    //     stockChart: stockChart
                    // }),
                    // am5stock.ResetControl.new(root, {
                    //     stockChart: stockChart
                    // }),
                    // am5stock.SettingsControl.new(root, {
                    //     stockChart: stockChart
                    // })
                ]
            });

            // Data generator
            var firstDate = new Date();
            var lastDate;
            var value = coin_data.coin_price;

            var autoUpdate = true;

            $("#btn-buy").click(function() {
                if(is_trade_running){
                    toast('You have already initiated a trade', 'warning');
                    return;
                }
                var last = valueSeries.data.getIndex(valueSeries.data.length - 1);
                $("#label").val("buy");
                $("#coin_id").val(coin_data.id);
                $("#coin_name").val(coin_data.name);
                $("#close").val(last.Close);
                $("#amt").val(0);
                $("#profit").val(0);
                $("#tradePeriod").modal("show");
            });

            $("#btn-sell").click(function() {
                if(is_trade_running){
                    toast('You have already initiated a trade', 'warning');
                    return;
                }
                var last = valueSeries.data.getIndex(valueSeries.data.length - 1);
                $("#label").val("sell");
                $("#coin_id").val(coin_data.id);
                $("#coin_name").val(coin_data.name);
                $("#close").val(last.Close);
                $("#amt").val(0);
                $("#profit").val(0);
                $("#tradePeriod").modal("show");
            });

            $("#amt").on('keyup', function () {
                let amount = $("#amt").val();
                let user_balance = {{(auth()->user()->is_demo_account) ? auth()->user()->demo_account_balance : auth()->user()->account_balance}};
                if (user_balance < amount) {
                    toast("You don't have enough balance. Please deposit money", "warning");
                    return;
                }

                let profit_percent = 0;
                if ($("#label").val() == "buy") {
                    profit_percent = coin_data.buy_profit;
                } else {
                    profit_percent = coin_data.sell_profit;
                }

                let profit = (Number(amount) * (Number(profit_percent) / 100)).toFixed(2);
                let total = (Number(amount) + Number(profit)).toFixed(2);
                $("#profit").val(total);

            });

            $("#trading-rate").hide();
            $("#trading-info").hide();

            $(".btn_trade_period").on('click', function () {
                if ($("#amt").val() < 1) {
                    toast("Please enter amount", "info");
                    return;
                }

                let user_balance = {{(auth()->user()->is_demo_account) ? auth()->user()->demo_account_balance : auth()->user()->account_balance}};
                if (user_balance < $("#amt").val()) {
                    toast("You don't have enough balance. Please deposit money", "warning");
                    return;
                }

                is_trade_running = true;
                let period = $(this).data('period');
                let type = $(this).data('type');
                let time_period = period+type;
                let seconds = 0;
                let milliseconds = 0;
                if (type == "s") {
                    seconds = period;
                }
                if (type == "m") {
                    seconds = period * 60;
                }

                if (type == "h") {
                    seconds = period * 60 * 60;
                }

                milliseconds = seconds * 1000;


                let iconClass = $("#label").val() == "buy" ? "fa-arrow-up" : "fa-arrow-down";

                document.getElementById("trading-rate").innerHTML = `<small>Trade Closed on:</small> ${$("#close").val()}<i class="fa ${iconClass} ml-1"></i>`;
                document.getElementById("trading-rate").style.background = $("#label").val() == "buy" ? "#1d9c09" : "#c92112";
                document.getElementById("trading-rate").style.color = "#ffffff";
                $("#trading-rate").show();
                document.getElementById("trading-info").innerHTML = `<small>Invested Amount:</small> $${$("#amt").val()} <small>Expected Profit:</small> $${$("#profit").val()}`;
                document.getElementById("trading-info").style.background = "rgba(146,176,178,0.73)";
                document.getElementById("trading-info").style.color = "#ffffff";
                $("#trading-info").show();
                // autoUpdate = false;
                runTimer(seconds, time_period, type);
                $("#tradePeriod").modal("hide");
                // updateChart(milliseconds);

                // alert(period + ' =====' + seconds);


            });
            $("#time").hide();

            function runTimer(seconds, time_period, type) {
                let amt = $("#amt").val();
                $.ajax({
                    url: "{{url('/update-account-balance')}}",
                    type: "POST",
                    data: JSON.stringify({
                        trade_amount: amt,
                    }),
                    cache: false,
                    processData: false,
                    contentType: "application/json; charset=UTF-8",
                    success: function (res) {
                        if (res === true) {
                            // toast(res.message, "success");
                            // let html = `<small>Balance:</small>  $${res.balance.toFixed(2)}`
                            // $('.user-account-balance').html(html)
                            setAccountBalance();
                        } else {
                            // toast(res.message, "info");
                            setAccountBalance();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        setAccountBalance();
                        // toast(res.message, "info");
                        // alert(textStatus + ' : ' + errorThrown);
                    }
                });
                // setAccountBalance();
                let count = new Date();
                count.setSeconds(count.getSeconds() + seconds);
                var countDown = count.getTime();
                var update = setInterval(function () {
                    var now = new Date().getTime();
                    var diff = countDown - now;
                    var days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    var hrs = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((diff % (1000 * 60)) / 1000);

                    let html = '';
                    if (type == 's') {
                        html += `<small>Time:</small> Second: ${seconds}`;
                    }

                    if (type == 'm') {
                        html += `<small>Time:</small> Minute: ${minutes} Second: ${seconds}`;
                    }

                    if (type == 'h') {
                        html += `<small>Time:</small> Hour: ${hrs} Minute: ${minutes} Second: ${seconds}`;
                    }
                    document.getElementById("time").innerHTML = html;
                    document.getElementById("time").style.background = "black";
                    document.getElementById("time").style.color = "#ffffff";
                    $("#time").show();
                    if (diff < 0) {
                        clearInterval(update);
                        $("#time").hide();
                        $("#trading-rate").hide();
                        $("#trading-info").hide();
                        let latest = valueSeries.data.getIndex(valueSeries.data.length - 1);
                        let label = $("#label").val();
                        let coin_id = $("#coin_id").val();
                        let coin_name = $("#coin_name").val();
                        let close_value = $("#close").val();
                        let profit = $("#profit").val();
                        $("#amt").val(0);
                        $("#profit").val(0);
                        is_trade = true;
                        if (is_trade) {
                            calculate(label, coin_id, coin_name, close_value, latest.Close, amt, profit, time_period);
                            is_trade = false;
                        }
                    }
                }, 1000);
            }

            function calculate(label, coin_id, coin_name, close_value, latest, amt, profit, time_period) {
                    $.ajax({
                        url: "{{url('trading/user-trade')}}",
                        type: "POST",
                        data: JSON.stringify({
                            amount_invested: amt,
                            profit: profit,
                            close_value: close_value,
                            latest: latest,
                            label: label,
                            coin_id: coin_id,
                            time_period: time_period
                        }),
                        cache: false,
                        processData: false,
                        contentType: "application/json; charset=UTF-8",
                        success: function (res) {
                            if (res.success == 1) {
                                toast(res.message, "success");
                                // let html = `<small>Balance:</small>  $${res.balance.toFixed(2)}`
                                // $('.user-account-balance').html(html)
                                setAccountBalance();
                            } else {
                                toast(res.message, "info");
                            }
                            loadTradingHistory(coin_id);
                            is_trade_running = false;

                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            toast(res.message, "info");
                            is_trade_running = false;
                            // alert(textStatus + ' : ' + errorThrown);
                        }
                    });
                }

            // data
            function generateChartData() {
                var chartData = [];
                var open = 0;
                var low = 0;
                var high = 0;

                // let loop_var = date_axis_time_value == 'minute' ? coin_data.diff_in_min : coin_data.diff_in_min * 60;
                loop_var = 1000;
                for (var i = 0; i < loop_var; i++) {
                    var newDate = new Date(firstDate);
                    if (date_axis_time_value == 'minute') {
                        newDate.setMinutes(newDate.getMinutes() - i);
                    } else {
                        newDate.setSeconds(newDate.getSeconds() - i);
                    }


                    // while(value >= coin_data.coin_min_price && value <= coin_data.coin_max_price) {
                    value += Math.abs(Math.round((Math.random() < 0.49 ? .5 : -.5) * Math.random() * 10));
                    // if(value >= coin_data.coin_min_price && value <= coin_data.coin_max_price){
                    //     value = coin_data.coin_price;
                    // }
                    // }

                    // while(open >= coin_data.coin_min_price && open <= coin_data.coin_max_price) {
                    open = value + Math.round(Math.random() * 16 - 8);
                    // }

                    // while(low >= coin_data.coin_min_price && low <= coin_data.coin_max_price) {
                    low = Math.min(value, open) - Math.round(Math.random() * 5);
                    // }

                    // while(high >= coin_data.coin_min_price && high <= coin_data.coin_max_price) {
                    high = Math.max(value, open) + Math.round(Math.random() * 5);
                    // }

                    chartData.unshift({
                        Date: newDate.getTime(),
                        Close: value,
                        Open: open,
                        Low: low,
                        High: high
                    });

                    lastDate = newDate;
                }
                return chartData;
            }

            var data = generateChartData();

            // set data to all series
            valueSeries.data.setAll(data);
            // sbSeries.data.setAll(data);

            // update data
            var previousDate;

            // let pump = true;
            setInterval(function () {
                if (autoUpdate) {
                    var valueSeries = stockChart.get("stockSeries");
                    var date = Date.now();
                    var lastDataObject = valueSeries.data.getIndex(valueSeries.data.length - 1);
                    if (lastDataObject) {
                        var previousDate = lastDataObject.Date;
                        var previousValue = lastDataObject.Close;

                        if (is_pump && pump_type == 'up') {
                            // while(value >= coin_data.coin_min_price && value <= coin_data.coin_max_price) {
                                value = am5.math.round(previousValue + (.25) * Math.random() * 1, 4);
                            // }
                        }
                        else if (is_pump && pump_type == 'down') {
                            // while(value >= coin_data.coin_min_price && value <= coin_data.coin_max_price) {
                                value = Math.abs(am5.math.round(previousValue - (.25) * Math.random() * 1, 4));
                            // }
                        }
                        else {
                            // while(value >= coin_data.coin_min_price && value <= coin_data.coin_max_price) {
                                value = Math.abs(am5.math.round(previousValue + (Math.random() < 0.5 ? .25 : -.25) * Math.random() * 2, 4));
                            // }
                        }


                        var high = lastDataObject.High;
                        var low = lastDataObject.Low;
                        var open = lastDataObject.Open;

                        if (am5.time.checkChange(date, previousDate, date_axis_time_value)) {
                            open = value;
                            high = value;
                            low = value;

                            var dObj1 = {
                                Date: date,
                                Close: value,
                                Open: value,
                                Low: value,
                                High: value
                            };

                            valueSeries.data.push(dObj1);
                            // sbSeries.data.push(dObj1);
                            previousDate = date;
                        } else {
                            if (value > high) {
                                high = value;
                            }

                            if (value < low) {
                                low = value;
                            }

                            var dObj2 = {
                                Date: date,
                                Close: value,
                                Open: open,
                                Low: low,
                                High: high
                            };

                            valueSeries.data.setIndex(valueSeries.data.length - 1, dObj2);
                            // sbSeries.data.setIndex(sbSeries.data.length - 1, dObj2);
                        }
                        // update current value
                        if (currentLabel) {
                            currentValueDataItem.animate({
                                key: "value",
                                to: value,
                                duration: 500,
                                easing: am5.ease.out(am5.ease.cubic)
                            });
                            currentLabel.set("text", stockChart.getNumberFormatter().format(value));
                            var bg = currentLabel.get("background");
                            if (bg) {
                                if (value < open) {
                                    bg.set("fill", root.interfaceColors.get("negative"));
                                } else {
                                    bg.set("fill", root.interfaceColors.get("positive"));
                                }
                            }
                        }
                    }
                }
            }, 500);

        }); // end am5.ready()
    }

</script>

@stop
