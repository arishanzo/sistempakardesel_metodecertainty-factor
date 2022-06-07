<?php
require_once "config/config.php";
if (isset($_SESSION['username'])) {
    echo "<script>window.location='" . base_url() . "';</script>";
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login</title>


        <link rel="stylesheet" href="assets/vendor/animate/animate.css">

        <link rel="stylesheet" href="assets/css/bootstrap.css">

        <link rel="stylesheet" href="assets/css/maicons.css">

        <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.carousel.css">

        <link rel="stylesheet" href="assets/css/theme.css">

        <!-- Custom fonts for this template-->

    </head>

    <!-- Back to top button -->
    <div class="back-to-top"></div>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light navbar-float">
            <div class="container">
                <a href="index.php" class="navbar-brand">Sistem Pakar<span class="text-primary">Desel</span></a>

                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Nav Bar -->
                <div class="navbar-collapse collapse" id="navbarContent">
                    <ul class="navbar-nav ml-lg-4 pt-3 pt-lg-0">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="web/konsultasi.php" class="nav-link">Konsultasi</a>
                        </li>
                        <li class="nav-item">
                            <a href="web/about.php" class="nav-link">About</a>
                        </li>

                    </ul>
                    <div class="ml-auto">
                        <a href="../login.php" class="btn btn-outline rounded-pill">Login Admin</a>
                    </div>
                </div>
            </div>
        </nav>

        <body class="bodybackground">

            <div class="container">

                <!-- Outer Row -->
                <div class="row justify-content-center mt-5">

                    <div class="col-xl-6 col-lg-6 col-md-9 mt-5">

                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 "> Login Admin</h1>
                                                <h3 class="h4 text-gray-900 mb-4"></h3>

                                            </div>
                                            <form class="user" method="POST" action="#">
                                                <?php
                                                if (isset($_POST['submit'])) {
                                                    $user = trim(mysqli_real_escape_string($con, $_POST['username']));
                                                    $pass = md5(mysqli_real_escape_string($con, $_POST['password']));
                                                    $sql_login = mysqli_query($con, "SELECT * FROM admin WHERE username ='$user' AND password = '$pass'") or die(mysqli_error($con));
                                                    if ($row = mysqli_fetch_array($sql_login)) {
                                                        $_SESSION['id_admin'] = $row['id_admin'];
                                                        $_SESSION['nama'] = $row['nama'];
                                                        $_SESSION['username'] = $user;
                                                        echo "<script>window.location='" . base_url('dashboard/index.php') . "';</script>";
                                                    } else { ?>
                                                        <div class="mt-3">
                                                            <div class="alert alert-danger alert-dismissable" role="alert">
                                                                <center>
                                                                    <strong>Login Gagal</strong> <br>
                                                                    Username Dan Password salah
                                                                </center>
                                                            </div>
                                                        </div>

                                                <?php
                                                    }
                                                }

                                                ?>
                                                <div class="form-group">
                                                    <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username">
                                                </div>

                                                <div class="form-group">
                                                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                                </div>

                                                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                                    Login
                                                </button>
                                                <hr>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="<?= base_url() ?>../vendor/jquery/jquery.min.js"></script>
            <script src="<?= base_url() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="<?= base_url() ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="<?= base_url() ?>/js/sb-admin-2.min.js"></script>

        </body>

    </html>

<?php
}
?>