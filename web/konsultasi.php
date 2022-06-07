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

  <title>Konsultasi Kuy</title>

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/css/theme.css">

  <!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script> -->

  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>

</head>

<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a href="../index.php" class="navbar-brand">Sistem Pakar<span class="text-primary">Desel</span></a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarContent">
          <ul class="navbar-nav ml-lg-4 pt-3 pt-lg-0">
            <li class="nav-item">
              <a href="../index.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item active">
              <a href="konsultasi.php" class="nav-link">Konsultasi</a>
            </li>
            <li class="nav-item">
              <a href="about.php" class="nav-link">About</a>
            </li>

          </ul>
          <div class="ml-auto">
            <a href="../login.php" class="btn btn-outline rounded-pill">Login Admin</a>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <div class="container mt-5">

    <div class="row justify-content-center align-items-center">
      <div class="col-md">


        <center>

          <div>

            <div class="widget-box widget-color-grey" id="widget-box-2">
              <div class="widget-header">
                <h1 class="title-section">Silahkan pilih <span class="marked"> Gejala </span> yang dialami</h1>

              </div>


              <div class="widget-body mt-3" style="width:800px;">
                <div class="form-group">
                  <select class="custom-select" name="idkerusakan" id="idkerusakan">
                    <option disabled selected>Pilih Kerusakan </option>
                    <?php

                    $sql2 = mysqli_query($con, "SELECT * FROM t_kerusakan ");
                    while ($row2 = mysqli_fetch_array($sql2)) {
                    ?>
                      <option value="<?= $row2['kd_kerusakan'] ?>"><?= $row2['nama_kerusakan'] ?></option>
                    <?php

                    }

                    ?>
                  </select>
                </div>
                <script>
                  $("#idkerusakan").change(function() {
                    // variabel dari nilai combo box
                    var id_kerusakan = $("#idkerusakan").val();

                    // Menggunakan ajax untuk mengirim dan dan menerima data dari server
                    $.ajax({
                      type: "GET",
                      dataType: "html",
                      url: "data.php",
                      data: "idkerusakan=" + id_kerusakan,
                      success: function(data) {
                        $("#data").html(data);
                      }
                    });
                  });
                </script>
                <form action="hitung.php" enctype="multipart/form-data" method="GET">
                  <div class="widget-main no-padding">
                    <table class="table table-striped table-bordered table-hover">
                      <thead class="thin-border-bottom">
                        <tr>

                          <th style="text-align: center">Nama Kerusakan</th>
                          <th style="text-align: center">Nama Gejala</th>
                          <th style=" text-align:center">Pilih</th>
                        </tr>
                      </thead>
                      <tbody id="data">

                        <tr>
                          <td colspan="8" align="center">data tidak ada <input hidden type="text" class="form-control bg-white" readonly required name="cek" value="data tidak ada">
                          </td>
                        </tr>


                        </tr>

                      </tbody>
                    </table>
                  </div>
              </div>



              <div class="col-md-offset-3 col-md-9">
                <button type="submit" name="submit" class="btn btn-danger">Tambah Diagnosa</button>
              </div>
              </form>

              <div class="col-md-offset-3 col-md-9 mt-3">
                <a class="btn btn-info btn-action btn-xs mr-1" href="hasil.php" data-toggle="tooltip" title="Lihat Diagnosa"><span>Lihat Diagnosa</span></a>
              </div>
            </div>

        </center>


      </div>
    </div>

  </div>

  <!-- proses hitung -->






  <!-- Bootstrap core JavaScript-->

  <script src="<?= base_url() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../datatable/js/datatables.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
  <script src="<?= base_url() ?>/sweetalert/sweetalert.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url() ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url() ?>/js/sb-admin-2.min.js"></script>




</body>

</html>