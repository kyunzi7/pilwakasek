<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Pilwakasek</title>
    <meta name="description" content="Mumbool.com | Created By Josystem, Must Hasan">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="images/favicon.png">
    <link rel="shortcut icon" href="images/favicon.png">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">


    <link href="assets/weather/css/weather-icons.css" rel="stylesheet" />
    <link href="assets/calendar/fullcalendar.css" rel="stylesheet" />

    <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/css/charts/chartist.min.css" rel="stylesheet">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/datatable/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="assets/datatable/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.css">


</head>

<body>
    <?php
    $login = $this->session->userdata('status');
    if ($login == 'loginadmin') {
        redirect(base_url('?pesan=salah'));
    } else if ($login == 'loginpengawas') {
        redirect(base_url('?pesan=salah'));
    } else if ($login == 'loginsiswa') {
    } else {
        redirect(base_url('?pesan=belumlogin'));
    }
    ?>
    <div class="content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <div class="row">
                    <div class="col-3"><img src="<?php echo base_url('images/logo.png'); ?>"></div>
                    <div class="col text-right"><b>Selamat Datang : <?php echo $this->session->userdata('nama'); ?>
                        </b><br>Silahkan pilih calon Wakil Kepala Sekolah</div>
                </div>
            </li>
        </ol>
        <hr>


        <center>
            <div class="footer-inner bg-white">
                Copyright &copy; TIM IT SMANSAKU || 2023
            </div>
        </center>
    </div> <!-- .content -->
    </div><!-- /#right-panel -->



    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>


    <!--Chartist Chart-->
    <script src="assets/js/lib/chartist/chartist.min.js"></script>
    <script src="assets/js/lib/chartist/chartist-plugin-legend.js"></script>


    <script src="assets/js/lib/flot-chart/jquery.flot.js"></script>
    <script src="assets/js/lib/flot-chart/jquery.flot.pie.js"></script>
    <script src="assets/js/lib/flot-chart/jquery.flot.spline.js"></script>


    <script src="assets/weather/js/jquery.simpleWeather.min.js"></script>
    <script src="assets/weather/js/weather-init.js"></script>


    <script src="assets/js/lib/moment/moment.js"></script>
    <script src="assets/calendar/fullcalendar.min.js"></script>
    <script src="assets/calendar/fullcalendar-init.js"></script>

    <script type="text/javascript" src="assets/datatable/js/jquery.js"></script>
    <script type="text/javascript" src="assets/datatable/js/jquery.dataTables.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.dataku').DataTable();
        });
    </script>





</body>

</html>