@extends('layouts.app')
@section('head')
    <style type="text/css">
        .bravo_topbar, .bravo_header, .bravo_footer {
            display: none;
        }
        html, body, .bravo_wrap, .bravo_user_profile, .row-eq-height > .col-md-3 {
            min-height: 100vh !important;
        }
    </style>
    <link href="{{ asset('module/user/css/user.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="bravo_user_profile">
        <div class="container-fluid">
            <div class="row row-eq-height">
                <div class="col-md-3">
                    @include('User::frontend.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @include('User::frontend.layouts.dashboard.index')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script type="text/javascript" src="{{ asset("libs/chart_js/Chart.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("module/user/js/user.js") }}"></script>
    <script type="text/javascript">
        jQuery(function ($) {
            $(".bravo-user-render-chart").each(function () {
                let ctx = $(this)[0].getContext('2d');
                window.myMixedChartForVendor = new Chart(ctx, {
                    type: 'bar',//line - bar
                    data: earning_chart_data,
                    options: {
                        responsive: true,
                        legend: {
                            display: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: '{{__("Timeline")}}'
                                }
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: '{{__("Currency: :currency_main",['currency_main'=>setting_item('currency_main')])}}'
                                }
                            }]
                        },
                        tooltips: {
                            callbacks: {
                                label: function (tooltipItem, data) {
                                    var label = data.datasets[tooltipItem.datasetIndex].label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += tooltipItem.yLabel + " ({{setting_item('currency_format')}})";
                                    return label;
                                }
                            }
                        }
                    }
                });
            });

            $(".bravo-user-chart form select").change(function () {
                $(this).closest("form").submit();
            });


            var start = moment().startOf('week');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                "alwaysShowCalendars": true,
                "opens": "left",
                "showDropdowns": true,
                ranges: {
                    '{{__("Today")}}': [moment(), moment()],
                    '{{__("Yesterday")}}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '{{__("Last 7 Days")}}': [moment().subtract(6, 'days'), moment()],
                    '{{__("Last 30 Days")}}': [moment().subtract(29, 'days'), moment()],
                    '{{__("This Month")}}': [moment().startOf('month'), moment().endOf('month')],
                    '{{__("Last Month")}}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    '{{__("This Year")}}': [moment().startOf('year'), moment().endOf('year')],
                    '{{__('This Week')}}': [moment().startOf('week'), end]
                }
            }, cb).on('apply.daterangepicker', function (ev, picker) {

                // Reload Earning JS

                $.ajax({
                    url: '{{url('user/reloadChart')}}',
                    data: {
                        chart: 'earning',
                        from: picker.startDate.format('YYYY-MM-DD'),
                        to: picker.endDate.format('YYYY-MM-DD'),
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function (res) {
                        console.log(res.data);
                        if (res.status) {

                            window.myMixedChartForVendor.data = res.data;

                            window.myMixedChartForVendor.update();


                        }
                    }
                })

            });

            cb(start, end);


        });
    </script>
@endsection