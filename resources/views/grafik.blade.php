@extends('layouts.main')

@section('css')

@endsection

@section('main-content')
<div id="chart_div"></div>

@endsection

@section('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {'packages':['corechart','bar']});

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Tanggal Penjualan');
        data.addColumn('number', 'Qty');
        
        //data.addColumn('number', 'Energy Level');

        data.addRows([
        @forelse ($dataSales as $sales)
            ["{{ $sales->tgl }}",{{ $sales->qty }}],
        @empty
            [0,0]
        @endforelse
        ]);

        var options = {
            chart: {
                title: 'Data Penjualan',
                subtitle: 'Per Tanggal'
            },
            hAxis: {
                title: 'Penjualan Per Tanggal',
                format: 'h:mm a',
                viewWindow: {
                    min: [7, 30, 0],
                    max: [17, 30, 0]
                }
            },
            vAxis: {
                title: 'Sales'
            }
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.charts.Bar(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
@endsection