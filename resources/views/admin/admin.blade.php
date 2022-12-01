@extends('admin.layouts.layout_main')

@section('content')
<div style="">
    <div class="w-3/12">
        <canvas id="upgraded_projects_chart"></canvas>
    </div>
    <div class="w-3/12">
        <canvas id="projects_bar_chart"></canvas>
    </div>
    <div class="w-3/12">
        <canvas id="chart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('upgraded_projects_chart')
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
        options: {}
    });

    const bar_chart = document.getElementById('projects_bar_chart')
    new Chart(bar_chart, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'Septermber', 'October', 'November',  'December'],
            datasets: [{
                label: '# of Projects',
                data: {{json_encode($project_array)}},
                borderWidth: 1
            }]
        },
        options: {}
    });

</script>

@endsection

