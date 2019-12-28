@extends('layouts.mainlayout')
@section('mainContent')
    <div class="row">
        <div class="col s6">
            <canvas id="bar"></canvas>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/chart.min.js')}}"></script>
    <script>
            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
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

            // var pie=document.getElementById('pie');
            // var data= [{
            //         x: 10,
            //         y: 20
            //     }, {
            //         x: 15,
            //         y: 10
            // }];
            // var stackedLine = new Chart(pie, {
            //     type: 'line',
            //     data: data,
            //     options: {
            //         scales: {
            //             yAxes: [{
            //                 stacked: true
            //             }]
            //         }
            //     }
            // });
    </script>
@endsection
