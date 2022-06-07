<?php
require_once "../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="copyright" content="MACode ID, https://macodeid.com">

    <title>Hasil Diagnosa</title>

    <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/css/maicons.css">

    <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

    <link rel="stylesheet" href="../assets/css/theme.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>

    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../datatable/css/datatables.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">



</head>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Kerusakan</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../datatable/css/datatables.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="../sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../datatable/js/datatables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
    <script src="../sweetalert/sweetalert.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>/js/sb-admin-2.min.js"></script>

    <script type="text/javascript" src="<?= base_url() ?>/chartjs/Chart.js"></script>

</head>



<body>

    <!-- Back to top button -->
    <div class="back-to-top"></div>

    <header>

        <div class="container mt-5">

            <div class="row justify-content-center align-items-center">
                <div class="col-md">

                    <center>

                        <div>

                            <div class="widget-box widget-color-grey" id="widget-box-2">
                                <div class="widget-header">
                                    <h1 class="title-section">Hasil <span class="marked"> Diagnosa </span></h1>

                                </div>
                                <div class="widget-body mt-3">
                                    <div class="widget-main no-padding">

                                        <table class="table table-striped table-bordered table-hover" id="diagnosa">
                                            <thead class="thin-border-bottom">
                                                <tr>
                                                    <th style=" text-align:center">No</th>
                                                    <th style=" text-align:center">Nama Kerusakan</th>
                                                    <th style="width:200px; text-align:center">Nilai Diagnosa</th>
                                                    <th style="width:200px; text-align:center">Persen</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $SqlQuery = mysqli_query($con, "SELECT * FROM `hasil` INNER JOIN t_kerusakan as h ON hasil.kd_kerusakan = h.kd_kerusakan WHERE hasil.id_hasil");
                                                $no = 1;
                                                if (mysqli_num_rows($SqlQuery) > 0) {
                                                    while ($row = mysqli_fetch_array($SqlQuery)) {
                                                ?>
                                                        <tr>
                                                            <td style=" text-align:center"><?= $no++ ?></td>
                                                            <td style=" text-align:center"><?= $row['nama_kerusakan'] ?></td>
                                                            <td style=" text-align:center"><?= $row['nilai_cf'] ?></td>
                                                            <?php
                                                            $persen = $row['nilai_cf'] * 100;
                                                            ?>
                                                            <td style=" text-align:center"><?= $persen ?> %</td>


                                                        </tr>
                                                <?php
                                                    }
                                                } else {
                                                    echo "<tr><td colspan=\"8\" align=\"center\">data tidak ada</td></tr>";
                                                }
                                                ?>

                                            </tbody>

                                        </table>
                                        <!-- Close Table -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $SqlQuery = mysqli_query($con, "SELECT MAX(nilai_cf) FROM `hasil` INNER JOIN t_kerusakan as h ON hasil.kd_kerusakan = h.kd_kerusakan WHERE hasil.id_hasil");
                                    $rowbesar = mysqli_fetch_array($SqlQuery);
                                    $nilaiterbesar = $rowbesar['MAX(nilai_cf)'];
                                    $nilaicf = round($rowbesar['MAX(nilai_cf)'], 2);
                                    $persen = $nilaicf * 100;

                                    $Sqlkerusakan = mysqli_query($con, "SELECT * FROM `hasil` INNER JOIN t_kerusakan as h ON hasil.kd_kerusakan = h.kd_kerusakan WHERE hasil.nilai_cf='$nilaiterbesar'");
                                    $rowkerusakan = mysqli_fetch_array($Sqlkerusakan);
                                    ?>
                                    <p>Nilai Diagnosa Paling Tinggi Adalah <strong><?= $persen ?> %</strong> Pada Kerusakan <strong><?= $rowkerusakan['nama_kerusakan'] ?></strong></p>
                                </div>
                            </div>


                            <div class="clearfix form-actions">

                            </div>
                        </div>

                    </center>


                    <script>
                        $(document).ready(function() {
                            $('.diagnosa').DataTable({
                                "paging": true,

                            });

                        });
                    </script>


                </div>
            </div>

        </div>
    </header>

    <br></br>



    <script src="../assets/js/jquery-3.5.1.min.js"></script>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/vendor/wow/wow.min.js"></script>

    <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <script src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>

    <script src="../assets/vendor/animateNumber/jquery.animateNumber.min.js"></script>

    <script src="../assets/js/google-maps.js"></script>

    <script src="../assets/js/theme.js"></script>

</body>

</html>
<script>
    window.print();
</script>