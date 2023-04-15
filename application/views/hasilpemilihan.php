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
    } else if ($login == 'loginpengawas') {
        redirect(base_url('?pesan=salah'));
    } else if ($login == 'loginsiswa') {
        redirect(base_url('?pesan=salah'));
    } else {
        redirect(base_url('?pesan=belumlogin'));
    }

    ?>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dasbor"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">Menu</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-list-ul"></i>Data</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-badge"></i><a href="Datacal">Data Calon</a></li>
                            <li><i class="fa fa-eye"></i><a href="Datapeng">Data Pengawas</a></li>
                            <li><i class="fa fa-user"></i><a href="Datapem">Data Pemilih</a></li>

                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="" data-toggle="" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart-o"></i>Hasil Pemilihan</a>
                        <a href="" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#konfirmkeluar"> <i class="menu-icon fa fa-times"></i>Keluar</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
    <!-- Left Panel -->



    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href=""><img src="images/logo.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div style="position: fixed;right: 30px; top: 8px;">
                <a class="btn btn-outline-primary" style="" data-toggle="modal" data-target="#konfirmkeluar">Keluar</a>
            </div>
        </header><!-- /header -->
        <!-- Header-->
        <div class="content pb-0">




            <h1><i class="fa fa-bar-chart-o"> </i> Hasil Pemilihan</h1>
            <hr>
            <!-- <a class="btn btn-success" href="<?php echo base_url('Hasilpilih/export'); ?>"><i class="fa fa-print">
                </i> Cetak</a> -->

            <?php $nototal = 0;
            $belummemilih = 0;
            $sudahmemilih = 0;
            $sudahabsen = 0;
            $belumabsen = 0;
            $sudahabsenbelummilih = 0;
            foreach ($datapemilih->result_array() as $j) :
                $id = $j['id'];
                $suara = $j['suara_1'];
                $absen = $j['absen'];
                if ($suara != 0) {
                    $sudahmemilih++;
                }
                if ($suara == 0) {
                    $belummemilih++;
                }
                if ($absen != 0) {
                    $sudahabsen++;
                }
                if ($absen == 0) {
                    $belumabsen++;
                }
                if ($suara == 0 && $absen != 0) {
                    $sudahabsenbelummilih++;
                };
                $nototal++;
            endforeach;

            ?>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-4"> DPT : <?php echo $nototal; ?> <br> Sudah absen belum memilih :
                        <?php echo $sudahabsenbelummilih; ?> </div>
                    <div class="col-4 text-center"> Sudah Memilih : <?php echo $sudahmemilih; ?><br>Sudah Absen :
                        <?php echo $sudahabsen; ?></div>
                    <div class="col-4 text-right"> Belum Memilih : <?php echo $belummemilih; ?><br>Belum Absen :
                        <?php echo $belumabsen; ?></div>
                </div>
            </div>
            <hr>

            <?php
            foreach ($data_divisi->result_array() as $i) :
                $id = $i['id_divisi'];
                $nama = $i['nama_divisi'];
                $ket = $i['ket_divisi'];

            ?>

                <div class="card">
                    <h5 class="card-header">Divisi : <b> <?php echo $nama; ?> </b> </h5>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            foreach ($data_by_divisi as $current_cat => $catgory_rows) {
                                $no = 1;

                                foreach ($catgory_rows as $key => $value) {
                                    if ($value->id_divisi == $id) {
                                        $idCalon = $value->id;
                                        $namaCalon = $value->namacalon;
                                        $visiCalon = $value->visi;
                                        $misiCalon = $value->misi;
                                        $fotoCalon = $value->foto;
                                        $totalSuara = $value->totalsuara;
                            ?>

                                        <div class="col-md-6">
                                            <aside class="profile-nav alt">
                                                <section class="card">
                                                    <div class="card-header user-header alt bg-dark">
                                                        <div class="media">
                                                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?php echo base_url('upload/' . $fotoCalon) ?>">
                                                            <div class="media-body">
                                                                <h2 class="text-light display-6"> <?php echo $namaCalon; ?></h2>
                                                                <p>Calon No <?php echo $no; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <center>
                                                                <h1><br><?php echo $totalSuara; ?> Suara</h1>
                                                                <h3><?php $persen = round(($totalSuara / $nototal) * 100, 2);
                                                                    echo $persen; ?> %</h3>
                                                                <br><br>
                                                            </center>
                                                        </li>
                                                    </ul>
                                                </section>
                                            </aside>
                                        </div>

                            <?php
                                    }
                                    $no++;
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>

            <?php
            endforeach; ?>

        </div>


    </div> <!-- .content -->
    <div class="clearfix"></div>


    <!--Modal Keluar -->
    <div class="modal fade" id="konfirmkeluar" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Apakah anda yakin ingin keluar?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <form action="<?php echo base_url('index.php/Welcome/logout'); ?>">
                        <input type="submit" class="btn btn-primary" value="Ya">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Grafik -->
    <div class="modal fade" id="lihatgrafik" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="largeModalLabel">
                        <center>Hasil Pemilihan</center>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                        </div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                    </div>
                                </div>
                                <h4 class="mb-3"> </h4>
                                <canvas id="doughutChart" height="300" width="601" class="chartjs-render-monitor" style="display: block; width: 601px; height: 300px;"></canvas>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <footer class="site-footer">
        <div class="footer-inner bg-white">
            <div class="row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6 text-right">
                    Copyright &copy; TIM IT SMANSAKU || <?php echo date('Y'); ?>
                </div>
            </div>
        </div>
    </footer>

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
</body>

</html>