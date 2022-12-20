@extends('admin.layouts.layout_main')

@section('content')
@if ($jumlah_project != 0)
<div class="flex flex-col justify-center items-center w-full">
    <div class="flex flex-row w-8/12">
        <div class="w-1/2">
            <canvas id="upgraded_projects_chart"></canvas>
        </div>
        <div class="w-1/2">
            <canvas id="chart_pekerjaan"></canvas>
        </div>
    </div>
    <div class="flex flex-row">
        <div class="">
            <canvas id="projects_bar_chart"></canvas>
        </div>
        <div>
            <p class="text-xl text-center">Projects Upgraded</p>
            <p class="text-8xl text-center">{{$upgraded_counter}}</p>
        </div>
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
                label: '% of Projects',
                data: [{{$upgraded_percentage}}, {{$unupgraded_percentage}}],
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

    const chart_pekerjaan = document.getElementById('chart_pekerjaan')
    new Chart(chart_pekerjaan, {
        type: 'pie',
        data: {
            labels: ['Pelajar', 'Mahasiswa', 'Pekerja', 'Lainnya'],
            datasets: [{
                label: '# of People',
                data: {{json_encode($pekerjaan_data)}},
                borderWidth: 1
            }]
        },
        options: {}
    });

</script>
@else
<p class="text-2xl m-12">Belum ada project</p>
@endif
@endsection

