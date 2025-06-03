@extends('layouts.main')

@section('content')
    <div class="mt-5 ml-5">

        <div class="form-group row">
            <div class="col-sm-3">
               <select id="dataFilter" class="form-control" style="border-radius: 10px;">
                     <option value="all">Semua</option>
                     <option value="internal">Internal</option>
                    <option value="eksternal">Eksternal</option>
                </select>
            </div>
        </div>

        

        <div class="row">
            <div class="col-md-6">
                <div class="card p-5" style="background-color:transparent">
                    <h4 class="mb-2" style="text-align: center;">Data NCR</h4>
                    <div class="card-body">
                        <canvas id="ChartOpenClose" width="50" height="50"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-5" style="background-color:transparent">
                    <h4 class="mb-2" style="text-align: center;">Data NCR Close</h4>
                    <div class="card-body">
                        <canvas id="ChartClose" width="100" height="50"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-5" style="background-color:transparent">
                    <h4 class="mb-2" style="text-align: center;">Data OFI</h4>
                    <div class="card-body">
                        <canvas id="ChartStatusDoc" width="100" height="100"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-5" style="background-color:transparent">
                    <h4 class="mb-2" style="text-align: center;">Data OFI Close</h4>
                    <div class="card-body">
                        <canvas id="ChartHasilVerif" width="100" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

    // Start Data Dummy Pie Chart
        var chartNCR, chartNCRClose, chartOFI, chartOFIClose;

        const dummyNCR = {
            internal: [30, 70],
            eksternal: [70, 30]
        };

        const dummyNCRClose = {
            internal: [60, 40],
            eksternal: [20, 80]
        };

        const dummyOFI = {
            internal: [30, 10, 60],
            eksternal: [10, 20, 70]
        };

        const dummyOFIClose = {
            internal: [65, 35],
            eksternal: [35, 65]
        };

        function sumArrays(arr1, arr2) {
            return arr1.map((val, idx) => val + arr2[idx]);
        }

        var ctx = document.getElementById('ChartOpenClose').getContext('2d');
        chartNCR = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Open', 'Closed'],
                datasets: [{
                    data: sumArrays(dummyNCR.internal, dummyNCR.eksternal),
                    backgroundColor: ['rgba(231, 76, 60, 1)', 'rgba(46, 204, 113, 1)'],
                }]
            },
            options: {}
        });

        var ctx1 = document.getElementById('ChartClose').getContext('2d');
        chartNCRClose = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Efektif', 'Tidak Efektif'],
                datasets: [{
                    data: sumArrays(dummyNCRClose.internal, dummyNCRClose.eksternal),
                    backgroundColor: ['rgba(88, 245, 39, 0.8)', 'rgba(245, 161, 39, 0.8)'],
                }]
            },
            options: {}
        });

        var ctx2 = document.getElementById('ChartStatusDoc').getContext('2d');
        chartOFI = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Open', 'Cancel', 'Close'],
                datasets: [{
                    data: sumArrays(dummyOFI.internal, dummyOFI.eksternal),
                    backgroundColor: ['rgba(231, 76, 60, 1)', 'rgb(255, 165, 0)', 'rgba(46, 204, 113, 1)'],
                }]
            },
            options: {}
        });

        var ctx3 = document.getElementById('ChartHasilVerif').getContext('2d');
        chartOFIClose = new Chart(ctx3, {
            type: 'doughnut',
            data: {
                labels: ['Efektif', 'Tidak Efektif'],
                datasets: [{
                    data: sumArrays(dummyOFIClose.internal, dummyOFIClose.eksternal),
                    backgroundColor: ['rgba(88, 245, 39, 0.8)', 'rgba(245, 161, 39, 0.8)'],
                }]
            },
            options: {}
        });

        document.getElementById('dataFilter').addEventListener('change', function () {
            const filter = this.value.toLowerCase();

            if (filter === 'semua') {
                chartNCR.data.datasets[0].data = sumArrays(dummyNCR.internal, dummyNCR.eksternal);
                chartNCRClose.data.datasets[0].data = sumArrays(dummyNCRClose.internal, dummyNCRClose.eksternal);
                chartOFI.data.datasets[0].data = sumArrays(dummyOFI.internal, dummyOFI.eksternal);
                chartOFIClose.data.datasets[0].data = sumArrays(dummyOFIClose.internal, dummyOFIClose.eksternal);
            } else {
                chartNCR.data.datasets[0].data = dummyNCR[filter];
                chartNCRClose.data.datasets[0].data = dummyNCRClose[filter];
                chartOFI.data.datasets[0].data = dummyOFI[filter];
                chartOFIClose.data.datasets[0].data = dummyOFIClose[filter];
            }

            chartNCR.update();
            chartNCRClose.update();
            chartOFI.update();
            chartOFIClose.update();
        });


    // End Data Dummy Pie Chart



        var ctx = document.getElementById('ChartOpenClose').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Open', 'Closed'],
                datasets: [{
                    data: [@json($dataOpen), @json($dataClose)],
                    backgroundColor: [
                        'rgba(231, 76, 60, 1)',
                        'rgba(46, 204, 113, 1)',
                    ],
                    // borderColor: [
                    //     'rgba(255, 99, 132, 1)',
                    //     'rgba(54, 162, 235, 1)',
                    // ],
                }],
            },
            options: {}
        });

        var ctx1 = document.getElementById('ChartClose').getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Efektif', 'Tidak Efektif'],
                datasets: [{
                    data: [@json($closeEfektif), @json($closeTdkEfektif)],
                    backgroundColor: [
                        'rgba(88, 245, 39, 0.8)',
                        'rgba(245, 161, 39, 0.8)',
                    ],
                    // borderColor: [
                    //     'rgba(255, 99, 132, 1)',
                    //     'rgba(54, 162, 235, 1)',
                    // ],
                }],
            },
            options: {}
        });

        var ctx2 = document.getElementById('ChartStatusDoc').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['open', 'cancel', 'close'],
                datasets: [{
                    data: [@json($dataOpen1), @json($dataCancel1),
                        @json($dataClose1)
                    ],

                    backgroundColor: [
                        'rgba(231, 76, 60, 1)',
                        'rgb(255, 165, 0)',
                        'rgba(46, 204, 113, 1)',
                    ],
                }],
            },
            options: {}
        });

        var ctx3 = document.getElementById('ChartHasilVerif').getContext('2d');
        var myChart3 = new Chart(ctx3, {
            type: 'doughnut',
            data: {
                labels: ['Efektif', 'Tidak Efektif'],
                datasets: [{
                    data: [@json($closeEfektif1), @json($closeTidakEfektif1)],
                    backgroundColor: [
                        'rgba(88, 245, 39, 0.8)',
                        'rgba(245, 161, 39, 0.8)',
                    ],
                    // borderColor: [
                    //     'rgba(255, 99, 132, 1)',
                    //     'rgba(54, 162, 235, 1)',
                    // ],
                }],
            },
            options: {}
        });


        // fetch('{{ url('get/status-nc') }}')
        //     .then(response => response.json())
        //     .then(data => {

        //         // var name = data.map(x => x.name);
        //         // var jumlah = data.map(x => x.jumlah);

        //         const ctxChartStatusNc = document.getElementById('docChartStatusNc').getContext('2d');
        //         const docChartStatusNc = new Chart(ctxChartStatusNc, {
        //             type: 'doughnut',
        //             data: {
        //                 labels: ['Sudah Ditindaklanjuti', 'Belum Ditindaklanjuti', 'Tindak Lanjut Belum Sesuai'],
        //                 datasets: [{
        //                     data: [data[0].jumlah_sudah, data[0].jumlah_belum, data[0].jumlah_tidak],
        //                     backgroundColor: [
        //                         'rgba(46, 204, 113, 1)',
        //                         'rgba(241, 196, 15, 1)',
        //                         'rgba(231, 76, 60, 1)',
        //                     ]
        //                 }]
        //             },
        //             plugins: [ChartDataLabels],
        //             options: {
        //                 plugins: {
        //                     responsive: true,
        //                     legend: {
        //                         position: 'top',
        //                     },
        //                     title: {
        //                         display: true,
        //                         text: 'Chart Status Nc'
        //                     },
        //                     datalabels: {
        //                         color: '#fff'
        //                     }
        //                 }
        //             }
        //         });
        //     });

        // fetch('{{ url('get/status-ncr') }}')
        //     .then(response => response.json())
        //     .then(data => {

        //         // var name = data.map(x => x.name);
        //         // var jumlah = data.map(x => x.jumlah);

        //         const ctxChartStatusNcr = document.getElementById('docChartStatusNcr').getContext('2d');
        //         const docChartStatusNcr = new Chart(ctxChartStatusNcr, {
        //             type: 'doughnut',
        //             data: {
        //                 labels: ['Sudah Ditindaklanjuti', 'Belum Ditindaklanjuti',
        //                     'Tindak Lanjut Belum Sesuai'],
        //                 datasets: [{
        //                     data: [data[0].jumlah_sudah, data[0].jumlah_belum, data[0].jumlah_tidak],
        //                     backgroundColor: [
        //                         'rgba(46, 204, 113, 1)',
        //                         'rgba(241, 196, 15, 1)',
        //                         'rgba(231, 76, 60, 1)',
        //                     ]
        //                 }]
        //             },
        //             plugins: [ChartDataLabels],
        //             options: {
        //                 plugins: {
        //                     responsive: true,
        //                     legend: {
        //                         position: 'top',
        //                     },
        //                     title: {
        //                         display: true,
        //                         text: 'Chart Status Ncr'
        //                     },
        //                     datalabels: {
        //                         color: '#fff'
        //                     }
        //                 }
        //             }
        //         });
        //     });

        // fetch('{{ url('get/status-ofi') }}')
        //     .then(response => response.json())
        //     .then(data => {

        // var name = data.map(x => x.name);
        // var jumlah = data.map(x => x.jumlah);

        //     const ctxChartStatusOfi = document.getElementById('docChartStatusOfi').getContext('2d');
        //     const docChartStatusOfi = new Chart(ctxChartStatusOfi, {
        //         type: 'doughnut',
        //         data: {
        //             labels: ['Sudah Ditindaklanjuti', 'Belum Ditindaklanjuti',
        //                 'Tindak Lanjut Belum Sesuai'],
        //             datasets: [{
        //                 data: [data[0].jumlah_sudah, data[0].jumlah_belum, data[0].jumlah_tidak],
        //                 backgroundColor: [
        //                     'rgba(46, 204, 113, 1)',
        //                     'rgba(241, 196, 15, 1)',
        //                     'rgba(231, 76, 60, 1)',
        //                 ]
        //             }]
        //         },
        //         plugins: [ChartDataLabels],
        //         options: {
        //             plugins: {
        //                 responsive: true,
        //                 legend: {
        //                     position: 'top',
        //                 },
        //                 title: {
        //                     display: true,
        //                     text: 'Chart Status Ofi'
        //                 },
        //                 datalabels: {
        //                     color: '#fff'
        //                 }
        //             }
        //         }
        //     });
        // });
    </script>
@endsection
