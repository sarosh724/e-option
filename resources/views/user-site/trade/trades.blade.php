<div>
    <div id="chartcontrols"></div>
    <div class="container-fluid my-4" id="container"></div>
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
    #chartcontrols {
        height: auto;
        padding: 5px 5px 0 16px;
        max-width: 100%;
    }

    #container {
        width: 100%;
        height: 600px;
        max-width: 100%
    }
</style>

<!-- Resources -->


<!-- Chart code -->
<script>
    let coin_data = [];

    am5.ready(async function () {

        coin_data = await fetch(
            {{url('trading/trading/coin-rate/1')}}
        ).then(response => response.json());


// Create root element
// -------------------------------------------------------------------------------
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("container");

// Set themes
// -------------------------------------------------------------------------------
// https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([am5themes_Animated.new(root)]);

// Create a stock chart
// -------------------------------------------------------------------------------
// https://www.amcharts.com/docs/v5/charts/stock-chart/#Instantiating_the_chart
        var stockChart = root.container.children.push(
            am5stock.StockChart.new(root, {})
        );

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
                    timeUnit: "minute",
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
                    timeUnit: "minute",
                    count: 1
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

        seriesSwitcher.events.on("selected", function(ev) {
            setSeriesType(ev.item.id);
        });

        // Stock toolbar
// -------------------------------------------------------------------------------
// https://www.amcharts.com/docs/v5/charts/stock/toolbar/
        var toolbar = am5stock.StockToolbar.new(root, {
            container: document.getElementById("chartcontrols"),
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
                    stockChart: stockChart
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
        })

// Data generator
        var firstDate = new Date();
        var lastDate;
        var value = coin_data.coin_price;

// data
        function generateChartData() {
            var chartData = [];

            for (var i = 0; i < coin_data.diff_in_min; i++) {
                var newDate = new Date(firstDate);
                newDate.setMinutes(newDate.getMinutes() - i);

                value += Math.round((Math.random() < 0.49 ? 1 : -1) * Math.random() * 10);

                var open = value + Math.round(Math.random() * 16 - 8);
                var low = Math.min(value, open) - Math.round(Math.random() * 5);
                var high = Math.max(value, open) + Math.round(Math.random() * 5);

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
        sbSeries.data.setAll(data);

// update data
        var previousDate;

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

                if (am5.time.checkChange(date, previousDate, "minute")) {
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
        }, 1000);

    }); // end am5.ready()

</script>

