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

        <form method="post" action="<?php echo base_url('index.php/form/pilihCalonWaka'); ?>">
            <?php
            foreach ($data_divisi->result_array() as $i) :
                $id = $i['id_divisi'];
                $nama = $i['nama_divisi'];
                $ket = $i['ket_divisi'];

            ?>
                <div class="card">
                    <h5 class="card-header">Divisi : <b><?php echo $nama; ?></b> </h5>
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
                                                            <h2 class="text-light display-6"><?php echo "{$no}. $namaCalon"; ?></h2>
                                                        </div>
                                                    </div>

                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <center>
                                                                <h1>
                                                                    <img class="align-self-center" style="width:240px; height:300px;" alt="" src="<?php echo base_url('upload/' . $fotoCalon) ?>">
                                                                </h1>
                                                            </center><br>
                                                            <p><b>VISI</b> <?php echo "<br />{$visiCalon}"; ?></p>
                                                            <p><b>MISI</b> <?php echo "<br />{$misiCalon}"; ?></p>
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
                        <select class="custom-select" required name="pilihan[]">
                            <option value="">Pilih Divisi <?php echo $nama; ?></option>
                            <?php
                            foreach ($data_by_divisi as $current_cat => $dc) {
                                foreach ($dc as $key => $value) {
                                    if ($value->id_divisi == $id) {
                                        $idCalon = $value->id;
                                        $namaCalon = $value->namacalon;
                                        $visiCalon = $value->visi;
                                        $misiCalon = $value->misi;
                                        $fotoCalon = $value->foto;
                                        $totalSuara = $value->totalsuara;
                            ?>
                                        <option value="<?php echo $idCalon; ?>"><?php echo $namaCalon; ?></option>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            <?php
            endforeach; ?>
            <input type="submit" class="btn btn-success btn-lg btn-block">
        </form>


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