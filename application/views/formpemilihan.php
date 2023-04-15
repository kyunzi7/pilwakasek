<!doctype html>
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

    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">

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
        <ol class="breadcrumb d-block">
            <li class="breadcrumb-item">
                <div class="row">
                    <div class="col-3"><img src="<?php echo base_url('images/logo.png'); ?>"></div>
                    <div class="col text-right"><b>Selamat Datang : <?php echo $this->session->userdata('nama'); ?>
                        </b><br>Silahkan pilih calon Wakil Kepala Sekolah</div>
                </div>
            </li>
        </ol>
        <hr>
        <form id="formPilihan">
            <?php
            foreach ($data_divisi->result_array() as $i) :
                $id = $i['id_divisi'];
                $nama = $i['nama_divisi'];
                $ket = $i['ket_divisi'];

            ?>
                <div class=" card">
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
                        <select class="custom-select" name="pilihan[]" required>
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
            <!-- <div class="spinner-border text-muted"></div> -->
            <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
        </form>

        <!-- <input type="submit" class="btn btn-success btn-lg btn-block"> -->
        <!-- <a href="" class="btn btn-success btn-lg btn-block" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#konfirmasiPilihan">SUBMIT PILIHAN</a> -->

        <!-- Modal -->
        <div class="modal fade" id="konfirmasiPilihan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Pilihan</h5>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin dengan pilihan ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btnCancel" data-dismiss="modal">Tidak</button>
                        <button type="submit" name="mySubmit" class="btn btn-success" id="submitPilihan">Ya</button>
                    </div>
                </div>
            </div>
        </div>

        <center>
            <div class="footer-inner bg-white">
                Copyright &copy; TIM IT SMANSAKU || 2023
            </div>
        </center>
    </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Link ke Bootstrap JS dan jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>
        $(document).ready(function() {
            var selectedValues = [];
            $('#formPilihan').submit(function(e) {
                e.preventDefault();
                selectedValues = [];

                var selectElements = document.querySelectorAll('[name="pilihan[]"]');


                for (var i = 0; i < selectElements.length; i++) {
                    var selectedOption = selectElements[i].value;

                    if (selectedOption) {
                        selectedValues.push(selectedOption);
                    }
                }

                console.log(selectedValues);


                // TODO : MODAL

                $('#konfirmasiPilihan').modal('show');
            });

            $('#submitPilihan').click(function(e) {
                $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading ....');
                $(this).prop('disabled', true);
                $('.btnCancel').prop('disabled', true);
                $.ajax({
                    url: '<?php echo base_url('index.php/form/pilih'); ?>',
                    type: 'post',
                    data: {
                        dataPilihan: selectedValues
                    },
                    success: function(response) {
                        console.log(response);
                        var baseUrl = window.location.origin;
                        window.location.href = baseUrl + '?pesan=terimakasih';
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>

    </script>



</body>

</html>