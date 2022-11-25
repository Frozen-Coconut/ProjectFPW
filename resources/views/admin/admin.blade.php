@extends('layout.main')

@section('head')

@endsection

@section('body')
<div class="w-3/12">
    <canvas id="chart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chart')
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['upgraded', 'not upgraded'],
            datasets: [{
                label: '# of Projects',
                data: [{{$upgraded_counter}}, {{$unupgraded_counter}}],
                borderWidth: 1
            }]
        },
        options: {

        }
    });
</script>

