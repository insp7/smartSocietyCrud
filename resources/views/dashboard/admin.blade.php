@extends('layouts.base')

@section('page-content')

    <style>
        .font-size-18{
            text-align: right;
            font-size: 18px;
            font-weight: 500;
            color: #000000;
        }

        .font-size-24{
            text-align: right;
            font-size: 24px;
            font-weight: bold;
            color: #000000;
        }

        .custom-color {
            background-color: #FF957C;
        }
    </style>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header custom-color">
                    <h6 class="text-uppercase ls-1 font-size-18">Total Insiders</h6>
                </div>
                <div class="card-body">
                    <h5 class="h3 mb-0 font-size-24">{{ $insider_count }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header custom-color">
                    <h6 class="text-uppercase ls-1 font-size-18">Total Criminals</h6>
                </div>
                <div class="card-body">
                    <h5 class="h3 mb-0 font-size-24">{{ $criminal_count }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header custom-color">
                    <h6 class="text-uppercase ls-1 font-size-18">News Feed</h6>
                </div>
                <div class="card-body">
                    <h5 class="h3 mb-0 font-size-24">{{ $news_feed_count }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header custom-color">
                    <h6 class="text-uppercase ls-1 font-size-18">Total Users</h6>
                </div>
                <div class="card-body">
                    <h5 class="h3 mb-0 font-size-24">{{ $user_count }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header custom-color">
                    <h6 class="text-uppercase ls-1 font-size-18">Total Criminal Images</h6>
                </div>
                <div class="card-body">
                    <h5 class="h3 mb-0 font-size-24">{{ $criminal_images_count }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header custom-color">
                    <h6 class="text-uppercase ls-1 font-size-18">Total Insider Images</h6>
                </div>
                <div class="card-body">
                    <h5 class="h3 mb-0 font-size-24">{{ $insider_images_count }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card-header custom-color">
                <h6 class="text-uppercase ls-1 font-size-18">Total Criminal Images</h6>
            </div>
            <div class="card-body" id="chart_div1"></div>
        </div>
        <div class="col-md-6">
            <div class="card-header custom-color">
                <h6 class="text-uppercase ls-1 font-size-18">Total Criminal Images</h6>
            </div>
            <div class="card-body" id="chart_div2"></div>
        </div>
    </div>

@endsection

@section('custom-script')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([
                ['Mushrooms', 3],
                ['Onions', 1],
                ['Olives', 1],
                ['Zucchini', 1],
                ['Pepperoni', 2]
            ]);


            var data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'Topping');
            data2.addColumn('number', 'Slices');
            data2.addRows([
                ['Mushrooms', 3],
                ['Onions', 1],
                ['Olives', 1],
                ['Zucchini', 1],
                ['Pepperoni', 2]
            ]);

            // Set chart options
            var options = {'title':'How Much Pizza I Ate Last Night',
                height: 400
            };

            var options2 = {'title':'How Much Pizza I Ate Last Night',
                height: 400
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.BarChart(document.getElementById('chart_div1'));
            chart.draw(data, options);
            var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
            chart2.draw(data2, options2);
        }
    </script>

    <!-- Optional JS -->
    @if(session()->has('type'))
        <script>
            $.notify({
                // options
                title: '<h4 style="color:white">{{ session('title') }}</h4>',
                message: '{{ session('message') }}',
            },{
                // settings
                type: '{{ session('type') }}',
                allow_dismiss: true,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 3000,
                timer: 1000,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
            });
        </script>
    @endif
@endsection
