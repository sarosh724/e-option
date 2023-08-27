<div class="row">
    <div class="col-md-1 col-lg-1">
        <select class="form-control bg-dark" name="coin" id="coin" onChange="loadChart()">
            <option value="">COIN</option>
            @foreach(getCoins() as $coin)
                <option value="{{$coin->id}}">{{$coin->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-1 col-lg-1">
        <select class="form-control bg-dark" name="time-type" id="time-type" onChange="loadChart()">
            <option value="">Filter</option>
            <option value="second">Second</option>
            <option value="minute" selected>Minute</option>
        </select>
    </div>
    <div class="col-md-3">
        <span class="text-white py-2 px-4 rounded" style="font-size: 1rem;" id="time"></span>
    </div>
</div>

<div class="mt-2 chart-div">
    <div id="chart_controls"></div>
    <div class="container-fluid my-4" id="container"></div>
</div>

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
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-white">Select Amount*</span>
                        <span class="rounded text-white px-3 py-1" style="background: black;">Balance: ${{auth()->user()->account_balance}}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button class="btn btn-sm btn-outline-secondary btn_percent mr-1" style="width: 25%;" data-value="25">25%</button>
                        <button class="btn btn-sm btn-outline-secondary btn_percent mr-1" style="width: 25%;" data-value="50">50%</button>
                        <button class="btn btn-sm btn-outline-secondary btn_percent mr-1" style="width: 25%;" data-value="75">75%</button>
                        <button class="btn btn-sm btn-outline-secondary btn_percent" style="width: 25%;" data-value="100">100%</button>
                    </div>
                </div>
                <span class="mt-3 text-white d-block">Select Period*</span>
                <div class="row mt-2">
                    <div class="col-md-2 mb-3">
                        <button class="btn btn-sm btn-secondary btn_trade_period" data-type="s" data-period="5" style="width: 100% !important;">5S</button>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button class="btn btn-sm btn-secondary btn_trade_period" data-type="s" data-period="10" style="width: 100% !important;">10S</button>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button class="btn btn-sm btn-secondary btn_trade_period" data-type="s" data-period="30" style="width: 100% !important;">30S</button>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button class="btn btn-sm btn-secondary btn_trade_period" data-type="m" data-period="1" style="width: 100% !important;">1M</button>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button class="btn btn-sm btn-secondary btn_trade_period" data-type="m" data-period="5" style="width: 100% !important;">5M</button>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button class="btn btn-sm btn-secondary btn_trade_period" data-type="m" data-period="15" style="width: 100% !important;">15M</button>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button class="btn btn-sm btn-secondary btn_trade_period" data-type="m" data-period="30" style="width: 100% !important;">30M</button>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button class="btn btn-sm btn-secondary btn_trade_period" data-type="h" data-period="1" style="width: 100% !important;">1H</button>
                    </div>
                </div>
            </div>
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                <button type="button" class="btn btn-primary">Understood</button>--}}
{{--            </div>--}}
        </div>
    </div>
</div>

{{--<script>--}}
{{--    (async () => {--}}

{{--        // Load the dataset--}}
{{--        const chart_data = await fetch(--}}
{{--            'http://127.0.0.1:8000/trading/coin-rate/1'--}}
{{--        ).then(response => response.json());--}}

{{--        console.log(chart_data);--}}
{{--        Highcharts.stockChart('container', {--}}
{{--            // chart: {--}}
{{--            //     // type: 'bar',--}}
{{--            //     backgroundColor: '#000'--}}
{{--            // },--}}
{{--            // rangeSelector: {--}}
{{--            //     selected: 1--}}
{{--            // },--}}
{{--            // navigator: {--}}
{{--            //     series: {--}}
{{--            //         color: Highcharts.getOptions().colors[0]--}}
{{--            //     }--}}
{{--            // },--}}
{{--            // series: [{--}}
{{--            //     type: 'hollowcandlestick',--}}
{{--            //     name: 'Hollow Candlestick',--}}
{{--            //     data: data--}}
{{--            // }]--}}
{{--            chart: {--}}
{{--                type: 'candlestick',--}}
{{--                backgroundColor: 'rgba(10,10,10,0.94)',--}}
{{--                renderTo: 'container',--}}
{{--                events: {--}}
{{--                    load: async function() {--}}
{{--                        // set up the updating of the chart each second--}}
{{--                        console.log(this.series);--}}
{{--                        var series = await this.series[0];--}}
{{--                        console.log(series)--}}
{{--                        setInterval(function() {--}}
{{--                            var last = series.data[series.data.length - 1];--}}
{{--                            var s1 = Math.random() * 2 + 1500;--}}
{{--                            var s2 = Math.random() * 2 + 1500;--}}
{{--                            var s3 = Math.random() * 2 + 1500;--}}
{{--                            // console.log(last);--}}
{{--                            series.addPoint([last.x + 1000, s1, Math.max(s1, s2, s3), Math.min(s1, s2, s3), s3], true, true);--}}
{{--                        }, 5000);--}}
{{--                        setInterval(function() {--}}
{{--                            var nv = Math.random() * 2 + 1500;--}}
{{--                            var last = series.data[series.data.length - 1];--}}
{{--                            var high = Math.max(last.high, nv);--}}
{{--                            var low = Math.min(last.low, nv);--}}

{{--                            last.update({--}}
{{--                                'high': high,--}}
{{--                                'low': low,--}}
{{--                                'close': nv--}}
{{--                            }, true);--}}
{{--                            //series.xAxis.setExtremes(1133395200000, 1135900800000, false, false);--}}
{{--                            //series.yAxis.setExtremes(68, 76, true, false);--}}
{{--                        }, 5000);--}}
{{--                    }--}}
{{--                }--}}
{{--            },--}}

{{--            rangeSelector: {--}}

{{--                // inputEnabled: false,--}}
{{--                selected: 1,--}}
{{--                // enabled: false--}}
{{--            },--}}

{{--            // scrollbar: {--}}
{{--            //     enabled: false--}}
{{--            // },--}}
{{--            // navigator: {--}}
{{--            //     enabled: true--}}
{{--            // },--}}

{{--            series: [{--}}
{{--                type: 'candlestick',--}}
{{--                name: 'Coin data',--}}
{{--                // data: [--}}
{{--                //     [1133395200000, 69.93, 71.73, 68.81, 71.60],--}}
{{--                //     [1133481600000, 72.27, 72.74, 70.70, 72.63],--}}
{{--                //     [1133740800000, 71.95, 72.53, 71.49, 71.82],--}}
{{--                //     [1133827200000, 73.93, 74.83, 73.35, 74.05],--}}
{{--                //     [1133913600000, 74.23, 74.46, 73.12, 73.95],--}}
{{--                //     [1134000000000, 73.20, 74.17, 72.60, 74.08],--}}
{{--                //     [1134086400000, 74.21, 74.59, 73.35, 74.33],--}}
{{--                //     [1134345600000, 74.87, 75.35, 74.56, 74.91],--}}
{{--                //     [1134432000000, 74.94, 75.46, 74.21, 74.98],--}}
{{--                //     [1134518400000, 72.53, 73.30, 70.27, 72.01],--}}
{{--                //     [1134604800000, 72.68, 72.86, 71.35, 72.18],--}}
{{--                //     [1134691200000, 72.14, 72.30, 71.06, 71.11],--}}
{{--                //     [1134950400000, 71.11, 72.60, 71.04, 71.38],--}}
{{--                //     [1135036800000, 71.62, 72.38, 71.12, 72.11],--}}
{{--                //     [1135123200000, 72.60, 73.61, 72.54, 73.50],--}}
{{--                //     [1135209600000, 73.91, 74.49, 73.60, 74.02],--}}
{{--                //     [1135296000000, 74.17, 74.26, 73.30, 73.35],--}}
{{--                //     [1135641600000, 74.00, 75.18, 73.95, 74.23],--}}
{{--                //     [1135728000000, 74.47, 74.76, 73.32, 73.57],--}}
{{--                //     [1135814400000, 73.78, 73.82, 71.42, 71.45],--}}
{{--                //     [1135900800000, 70.91, 72.43, 70.34, 71.89],--}}
{{--                // ]--}}
{{--                data: chart_data--}}
{{--            }--}}
{{--            ]--}}
{{--        });--}}
{{--    })();--}}
{{--</script>--}}

{{--- AM charts - live stock data ---}}

<!-- Styles -->
<style>
    #chart_controls {
        height: auto;
        padding: 5px 5px 0 16px;
        max-width: 100%;
    }

    #container {
        width: 100%;
        height: 500px;
        max-width: 100%
    }
</style>

<!-- Chart code -->
<script src="//cdn.amcharts.com/lib/5/themes/Responsive.js"></script>
<script src="//cdn.amcharts.com/lib/5/themes/Dark.js"></script>
<script>
    var root;

    $(document).ready(function () {
        $("#time-type").hide();
        $("#chart-div").hide();
        root = am5.Root.new("container");
    });

    function loadChart() {

        let date_axis_time_value = $("#time-type").val()

        root.dispose();

        var coin_id = $("#coin").val();
        let coin_data = [];
        $("#time-type").fadeIn();
        $("#chart-div").fadeIn();

        am5.ready(async function () {

            coin_data = await fetch(
                '{{url('trading/coin-rate/')}}' + '/' + coin_id
            ).then(response => response.json());

            console.log(coin_data);

            // Create root element
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            root = am5.Root.new("container");

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
            root.numberFormatter.set("numberFormat", "#,###.00");

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

            // Create value axis
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var valueAxis = mainPanel.yAxes.push(
                am5xy.ValueAxis.new(root, {
                    renderer: am5xy.AxisRendererY.new(root, {
                        pan: "zoom"
                    }),
                    extraMin: 0.1, // adds some space for main series
                    tooltip: am5.Tooltip.new(root, {}),
                    numberFormat: "#,###.00",
                    extraTooltipPrecision: 2
                })
            );

            var dateAxis = mainPanel.xAxes.push(
                am5xy.GaplessDateAxis.new(root, {
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
                currentGrid.setAll({strokeOpacity: 0.5, strokeDasharray: [2, 5]});
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

            // Add custom button
            var buy = mainPanel.plotContainer.children.push(am5.Button.new(root, {
                dx: 10,
                dy: 350,
                layer: 40,
                label: am5.Label.new(root, {
                    text: `${coin_data.profit}% Buy`,
                    fontSize: 15,
                    fontWeight: "600",
                    paddingTop: 0,
                    paddingRight: 14,
                    paddingBottom: 0,
                    paddingLeft: 14
                })
            }));
            buy.get("background").setAll({
                cornerRadiusTL: 0,
                cornerRadiusTR: 0,
                cornerRadiusBR: 0,
                cornerRadiusBL: 0,
                fill: '#dc3545',
                fillOpacity: 0.7
            })
            var sell = mainPanel.plotContainer.children.push(am5.Button.new(root, {
                dx: 120,
                dy: 350,
                layer: 40,
                label: am5.Label.new(root, {
                    text: `${coin_data.profit}% Sell`,
                    fontSize: 15,
                    fontWeight: "600",
                    paddingTop: 0,
                    paddingRight: 14,
                    paddingBottom: 0,
                    paddingLeft: 14
                })
            }));
            sell.get("background").setAll({
                cornerRadiusTL: 0,
                cornerRadiusTR: 0,
                cornerRadiusBR: 0,
                cornerRadiusBL: 0,
                fill: '#28a745',
                fillOpacity: 0.7
            })

            buy.events.on("click", function(ev) {
                var last = valueSeries.data.getIndex(valueSeries.data.length - 1);
                console.log("last = ", last);
                $("#label").val("buy");
                $("#coin_id").val(coin_data.id);
                $("#coin_name").val(coin_data.name);
                $("#close").val(last.Close);
                $("#amt_percent").val(0);
                $("#tradePeriod").modal("show");
                // calculate("buy", last, coin_data);
            });

            sell.events.on('click', function (e) {
                var last = valueSeries.data.getIndex(valueSeries.data.length - 1);
                $("#label").val("sell");
                $("#coin_id").val(coin_data.id);
                $("#coin_name").val(coin_data.name);
                $("#close").val(last.Close);
                $("#amt_percent").val(0);
                $("#tradePeriod").modal("show");
                // calculate("sell", last, coin_data);
            });

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

            // Add scrollbar
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
            var scrollbar = mainPanel.set(
                "scrollbarX",
                am5xy.XYChartScrollbar.new(root, {
                    orientation: "horizontal",
                    height: 50
                })
            );
            stockChart.toolsContainer.children.push(scrollbar);

            var sbDateAxis = scrollbar.chart.xAxes.push(
                am5xy.GaplessDateAxis.new(root, {
                    baseInterval: {
                        timeUnit: date_axis_time_value,
                        count: 1,
                    },
                    renderer: am5xy.AxisRendererX.new(root, {})
                })
            );

            var sbValueAxis = scrollbar.chart.yAxes.push(
                am5xy.ValueAxis.new(root, {
                    renderer: am5xy.AxisRendererY.new(root, {})
                })
            );

            var sbSeries = scrollbar.chart.series.push(
                am5xy.LineSeries.new(root, {
                    valueYField: "Close",
                    valueXField: "Date",
                    xAxis: sbDateAxis,
                    yAxis: sbValueAxis
                })
            );

            sbSeries.fills.template.setAll({
                visible: true,
                fillOpacity: 0.3
            });

            // Set up series type switcher
            // -------------------------------------------------------------------------------
            // https://www.amcharts.com/docs/v5/charts/stock/toolbar/series-type-control/
            var seriesSwitcher = am5stock.SeriesTypeControl.new(root, {
                stockChart: stockChart
            });

            seriesSwitcher.events.on("selected", function (ev) {
                console.log("selected");
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
                            {timeUnit: "second", count: 5, name: "5S"},
                            {timeUnit: "second", count: 10, name: "10S"},
                            {timeUnit: "minute", count: 1, name: "1Min"},
                            {timeUnit: "hour", count: 1, name: "1Hr"},
                        ]
                    }),
                    // seriesSwitcher,
                    // am5stock.DrawingControl.new(root, {
                    //     stockChart: stockChart
                    // }),
                    // am5stock.ResetControl.new(root, {
                    //     stockChart: stockChart
                    // }),
                    am5stock.SettingsControl.new(root, {
                        stockChart: stockChart
                    })
                ]
            });

            // Data generator
            var firstDate = new Date();
            var lastDate;
            var value = coin_data.coin_price;

            var autoUpdate = true;

            function clearPercent() {
                $(".btn_percent").each(function() {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active')
                    }
                });
            }

            $(".btn_percent").on('click', function () {
                clearPercent();

               let value = $(this).data('value');
               $("#amt_percent").val(value);

               if (!$(this).hasClass("active")) {
                   $(this).addClass("active");
               }
            });

            $(".btn_trade_period").on('click', function () {
                if ($("#amt_percent").val() == 0) {
                    toast("Please select Amount", "info");
                    return;
                }
                clearPercent();

                let period = $(this).data('period');
                let type = $(this).data('type');
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

                // autoUpdate = false;
                runTimer(seconds);
                $("#tradePeriod").modal("hide");
                // updateChart(milliseconds);

                // alert(period + ' =====' + seconds);


            });
            $("#time").hide();
            function runTimer(seconds) {
                let count = new Date();
                count.setSeconds(count.getSeconds() + seconds);
                var countDown = count.getTime();
                console.log(countDown);
                var update = setInterval(function () {
                    var now = new Date().getTime();
                    var diff = countDown - now;
                    var days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    var hrs = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((diff % (1000 * 60)) / 1000);
                    document.getElementById("time").innerHTML =
                        days + "-D: " + hrs + "-H: " + minutes + "-M: " + seconds + "-S ";
                    document.getElementById("time").style.background = "black";
                    document.getElementById("time").style.color = "#ffffff";
                    $("#time").show();
                    if (diff < 0) {
                        clearInterval(update);
                        $("#time").hide();
                        // document.getElementById("time").innerHTML = "";
                        let latest = valueSeries.data.getIndex(valueSeries.data.length - 1);
                        let label = $("#label").val();
                        let coin_id = $("#coin_id").val();
                        let coin_name = $("#coin_name").val();
                        let close_value = $("#close").val();
                        let amt_percent = $("#amt_percent").val();
                        $("#amt_percent").val(0);
                        alert(latest.Close);

                        calculate(label, coin_id, coin_name, close_value, latest, amt_percent);
                    }
                }, 1000);
            }

            function calculate(label, coin_id, coin_name, close_value, latest, amt_percent) {
                let user_balance = {{auth()->user()->account_balance}};
                let amount_invested = user_balance * (amt_percent / 100);
                $.ajax({
                    url: "{{url('trading/user-trade')}}",
                    type: "POST",
                    data: JSON.stringify({
                        amount_invested: amount_invested,
                        close_value: close_value,
                        latest: latest,
                        label: label,
                        coin_id: coin_id
                    }),
                    cache: false,
                    processData: false,
                    contentType: "application/json; charset=UTF-8",
                    success: function (res) {

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(textStatus+' : '+errorThrown);
                    }
                });
                if (label == "buy") {

                }

                if (label == "sell") {
                    if (latest > close_value) {
                        alert("You earned profit of ");
                    } else {
                        alert("you lose");
                    }
                }
            }

            // data
            function generateChartData() {
                var chartData = [];
                var open = 0;
                var low = 0;
                var high = 0;

                let loop_var = date_axis_time_value == 'minute' ? coin_data.diff_in_min : coin_data.diff_in_min * 60;
                loop_var = 100;
                for (var i = 0; i < loop_var; i++) {
                    var newDate = new Date(firstDate);
                    if (date_axis_time_value == 'minute') {
                        newDate.setMinutes(newDate.getMinutes() - i);
                    } else {
                        newDate.setSeconds(newDate.getSeconds() - i);
                    }


                    // while(value >= coin_data.coin_min_price && value <= coin_data.coin_max_price) {
                    value += Math.round((Math.random() < 0.49 ? 1 : -1) * Math.random() * 10);
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
            console.log(data);

            // set data to all series
            valueSeries.data.setAll(data);
            sbSeries.data.setAll(data);

            // update data
            var previousDate;

            function updateChart(interval) {
                setInterval(function () {
                    var valueSeries = stockChart.get("stockSeries");
                    var date = Date.now();
                    var lastDataObject = valueSeries.data.getIndex(valueSeries.data.length - 1);
                    if (lastDataObject) {
                        var previousDate = lastDataObject.Date;
                        var previousValue = lastDataObject.Close;
                        value = am5.math.round(previousValue + (Math.random() < 0.5 ? 1 : -1) * Math.random() * 2, 2);

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
                            sbSeries.data.push(dObj1);
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
                            sbSeries.data.setIndex(sbSeries.data.length - 1, dObj2);
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
                }, interval);
            }

            setInterval(function () {
                if (autoUpdate) {
                    var valueSeries = stockChart.get("stockSeries");
                    var date = Date.now();
                    var lastDataObject = valueSeries.data.getIndex(valueSeries.data.length - 1);
                    if (lastDataObject) {
                        var previousDate = lastDataObject.Date;
                        var previousValue = lastDataObject.Close;

                        value = am5.math.round(previousValue + (Math.random() < 0.5 ? 1 : -1) * Math.random() * 2, 2);

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
                            sbSeries.data.push(dObj1);
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
                            sbSeries.data.setIndex(sbSeries.data.length - 1, dObj2);
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
            }, 1000);

        }); // end am5.ready()
    }

</script>

