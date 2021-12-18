@extends('layouts.mainlayout')
@section('mainContent')
    <div class="row">
        <div class="col s6">
            <canvas id="bar"></canvas>
        </div>
        <div class="col s6">
            <canvas id="pie"></canvas>
        </div>
        <div class="col s6">
            <canvas id="line"></canvas>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/chart.min.js')}}"></script>
    <script>
            var ctx1 = document.getElementById('bar');
            var myChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            // For a pie chart
            var ctx2 = document.getElementById('pie');
            var myPieChart = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ['Red', 'Blue', 'Yellow'],
                    datasets: [{
                        data: [12, 60, 23],
                        backgroundColor: [
                            'rgba(255, 99, 132)',
                            'rgba(54, 162, 235)',
                            'rgba(255, 206, 86)',
                        ],
                    }]
                }
            });
            var ctx3 = document.getElementById('line');
            var myPieChart = new Chart(ctx3, {
                type: 'line',
                data: {
                    labels: ['Red', 'Blue', 'Yellow'],
                    datasets: [{
                        label: 'Nombre de laho A3lam',
                        data: [12, 60, 23],
                        pointBackgroundColor: 'rgba(255, 159, 64)',
                        pointBorderWidth: 1,
                        pointRadius: 4,
                        fill: false,
                        borderColor: 'rgba(54, 162, 235)',
                        showLine:true
                    }],
                    
                }
            });
    </script>
@endsection
