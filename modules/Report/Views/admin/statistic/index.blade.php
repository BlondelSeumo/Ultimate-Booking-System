@extends ('admin.layouts.app')
@section('script.head')
    <style type="text/css">
        .select2-container.select2-container--open .select2-dropdown {
            min-width: 220px !important;
        }
    </style>
@endsection
@section ('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('Bookings Statistic')}}</h1>
        </div>
        @include('admin.message')
        <div class="bravo-statistic">
            <div class="row">
                <div class="col-md-12">
                    <form action="" class="form-fiter-statistic">
                        <div class="header-statistic">
                            <div class="item">
                                {{__("Filter:")}}
                            </div>
                            <div class="item no-padding">
                                <div class="group-icon">
                                    <select name="user_type">
                                        <option value="">{{__("-- User Type --")}}</option>
                                        <option value="customer">{{__("Customer User")}}</option>
                                        <option value="vendor">{{__("Vendor User")}}</option>
                                    </select>
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="item no-padding">
                                <div class="group-icon">
                                    <?php
                                    $user = !empty(Request()->user_id) ? App\User::find(Request()->user_id) : false;
                                    \App\Helpers\AdminForm::select2('user_id', [
                                        'configs' => [
                                            'ajax'        => [
                                                'url' => url('/admin/module/user/getForSelect2'),
                                                'dataType' => 'json'
                                            ],
                                            'allowClear'  => true,
                                            'placeholder' => __('-- Select User --')
                                        ]
                                    ], !empty($user->id) ? [
                                        $user->id,
                                        $user->name_or_email . ' (#' . $user->id . ')'
                                    ] : false)
                                    ?>
                                </div>
                            </div>
                            <div class="item">
                                <div id="reportrange">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span>
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    <input type="hidden" name="from">
                                    <input type="hidden" name="to">
                                </div>
                            </div>
                            <div class="item">
                                <button type="submit" class="btn-submit">{{__("Apply")}}
                                    <i class="fa fa-spinner fa-pulse fa-fw"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row row-eq-height">
                <div class="col-md-8">
                    <div class="g-statistic">
                        <div class="head">
                            {{__("Bookings Statistic")}}
                        </div>
                        <div class="content">
                            <canvas id="earning_chart"></canvas>
                            <script>
                                var earning_chart_data = {!! json_encode($earning_chart_data) !!};
                                var earning_detail_data = {!! json_encode($earning_detail_data) !!};
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="g-statistic">
                        <div class="head">
                            {{__("Detail statistics")}}
                        </div>
                        <div class="content">
                            <div class="list-detail">
                                @if(!empty($earning_detail_data))
                                    @foreach($earning_detail_data as $key=>$detail)
                                        <div class="item item-{{$key}}">
                                            <span>{{$detail['title']}}: </span> {{$detail['val']}}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script.body')
    <script src="{{url('libs/chart_js/Chart.min.js')}}"></script>
    <script src="{{url('libs/daterange/moment.min.js')}}"></script>
    <script src="{{url('libs/daterange/daterangepicker.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('libs/daterange/daterangepicker.css')}}"/>

    <script>
        jQuery(function ($) {
            var ctx = document.getElementById('earning_chart').getContext('2d');
            window.myMixedChart = new Chart(ctx, {
                type: 'bar',
                data: earning_chart_data,
                options: {
                    responsive: true,
                    title: {
                        display: false,
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
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
            var start = moment().startOf('week');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#reportrange input[name=from]').val(start.format('YYYY-MM-DD'));
                $('#reportrange input[name=to]').val(end.format('YYYY-MM-DD'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                "alwaysShowCalendars": true,
                "opens": "center",
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
                $('#reportrange input[name=from]').val(picker.startDate.format('YYYY-MM-DD'));
                $('#reportrange input[name=to]').val(picker.endDate.format('YYYY-MM-DD'));
            });
            cb(start, end);
            $('.form-fiter-statistic').submit(function (e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                $.ajax({
                    url: '{{url('admin/module/report/statistic/reloadChart')}}',
                    data: form.serialize(),
                    dataType: 'json',
                    type: 'post',
                    beforeSend: function () {
                        form.addClass("loading");
                    },
                    success: function (res) {
                        form.removeClass("loading");
                        if (res.status) {
                            window.myMixedChart.data = res.chart_data;
                            window.myMixedChart.update();
                            $(".bravo-statistic .list-detail").html("");
                            for (var item_id in res.detail_data) {
                                var item = res.detail_data[item_id];
                                $(".bravo-statistic .list-detail").append("<div class='item'><span>" + item.title + ": </span> " + item.val + "</div>");
                            }
                        }
                    }
                })
            })
        })
    </script>
@endsection