<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SIM-TL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/icon/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.min.css') }}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('assets/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    <!-- select2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <!-- selectpicker -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        @include('layouts.sidebar')
        <!-- sidebar menu area end -->

        <div class="main-content">
            <!-- header area start -->
            @include('layouts.header')
            <!-- header area end -->

            <!-- page title area start -->
            <div class="page-title-area mt-4" style="background: transparent;">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            {{-- <h4 class="page-title pull-left">Dashboard</h4>
                            {{-- <ul class="breadcrumbs pull-left">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span>Dashboard</span></li>
                            </ul> --}} 
                            <h4 class="page-title pull-left">@yield('page-title', 'Dashboard')</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span>@yield('breadcrumb', 'Dashboard')</span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-sm-6 clearfix" width="220px" padding:0px;>
                        <ul class="notification-area pull-right">
                            <li>
                                <h5>
                                    <div class="date">
                                        <script type='text/javascript'>
                                            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                                                'November', 'Desember'
                                            ];
                                            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                            var date = new Date();
                                            var day = date.getDate();
                                            var month = date.getMonth();
                                            var thisDay = date.getDay(),
                                                thisDay = myDays[thisDay];
                                            var yy = date.getYear();
                                            var year = (yy < 1000) ? yy + 1900 : yy;
                                            document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                                        </script></b>
                                    </div>
                                </h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            @yield('content')

        </div>

        <footer>
            <div class="footer-area">
                <p>Copyright &copy; 2024 <strong>PT. INKA (Persero)</strong></p>
            </div>
        </footer>
    </div>




    <script src="{{ asset('assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- selectpicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

    @yield('scripts')

    <!-- bootstrap 4 js -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="{{ asset('assets/js/line-chart.js') }}"></script>
    <!-- all pie chart -->
    <script src="{{ asset('assets/js/pie-chart.js') }}"></script>
    <script src="{{ asset('assets/js/bar-chart.js') }}"></script>
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        @if (Route::currentRouteName() != 'data-departemen-add' &&
                Route::currentRouteName() != 'data-departemen-edit' &&
                Route::currentRouteName() != 'data-user-add' &&
                Route::currentRouteName() != 'data-user-edit' &&
                Route::currentRouteName() != 'data-tema-add' &&
                Route::currentRouteName() != 'data-tema-edit')
            $(document).ready(function() {
                $('input').on('keydown', function(event) {
                    if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event
                            .shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
                        var $t = $(this);
                        event.preventDefault();
                        var char = String.fromCharCode(event.keyCode);
                        $t.val(char + $t.val().slice(this.selectionEnd));
                        this.setSelectionRange(1, 1);
                    }
                });
            });
        @endif

        if ($('#dataTable3').length) {
            @if (Route::currentRouteName() == 'data-nc' ||
                    Route::currentRouteName() == 'data-ncr' ||
                    Route::currentRouteName() == 'data-ofi')
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var min = new Date($('#minDateFilter').val());
                        var max = new Date($('#maxDateFilter').val());
                        var date = new Date(data[6]);

                        if (
                            ($('#minDateFilter').val() == '' && $('#maxDateFilter').val() == '') ||
                            ($('#minDateFilter').val() == '' && date <= max) ||
                            (min <= date && $('#maxDateFilter').val() == '') ||
                            (min <= date && date <= max)
                        ) {
                            return true;
                        }
                        return false;
                    }
                );
            @endif

            $(document).ready(function() {
                var dataTable3 = $('#dataTable3').DataTable({
                    // dom: 'Bfrtip',
                    responsive: true
                    // buttons: [
                    //   'print'
                    // ]
                });

                @if (Route::currentRouteName() == 'data-nc' ||
                        Route::currentRouteName() == 'data-ncr' ||
                        Route::currentRouteName() == 'data-ofi')
                    $('#minDateFilter, #maxDateFilter').on('change', function() {
                        dataTable3.draw();
                    });
                @endif
            });
        }
    </script>
    <!-- others plugins -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js?v=0.001') }}"></script>

    @if (session()->has('success'))
        <script>
            Swal.fire({
                title: 'Berhasil !',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {})
        </script>
    @elseif(session()->has('error'))
        <script>
            Swal.fire({
                title: 'Gagal !',
                text: '{{ session('error') }}',
                icon: 'error', // Perbaikan icon menjadi 'error'
                confirmButtonText: 'OK'
            }).then((result) => {})
        </script>
    @endif


</body>

</html>
