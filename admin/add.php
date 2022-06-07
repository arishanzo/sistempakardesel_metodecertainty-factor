<?php include_once('header.php');
require_once "../config/config.php";
?>

<div class="row col-lg-12">
    <div class="col-lg-12">
        <div class="card">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="card-body">

                            <form action="" enctype="multipart/form-data" method="post">

                                <div class="form-group">
                                    <div class="section-title mt-0">Nama Admin</div>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="nama" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="section-title mt-0">Username</div>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="username">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="section-title mt-0">Password</div>
                                    <div class="input-group mb-2">
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>



                                <div class="card-footer bg-white">
                                    <button class="btn btn-primary mr-1" type="submit" name="submit">Simpan</button>

                                </div>
                                </from>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
if (isset($_POST['submit'])) {

    $nama = $_POST['nama'];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $pw = md5($password);
    $save = mysqli_query($con, "INSERT INTO admin VALUES ('', '$nama', '$username', '$pw')") or die(mysqli_error($con));

    echo "<script type='text/javascript'>
                                setTimeout(function () { 
                                    swal({ 
                                        title: 'Suksess', 
                                        text: 'Data Barang $nama Berhasil Disimpan', 
                                        type: 'success',
                                         timer: 3000,
                                          showConfirmButton: false });
                                },10);  
                                window.setTimeout(function(){ 
                                  window.location.replace('index.php');
                                } ,3000); 
                                </script>";
}
?>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
<?php include_once('footer.php');

?>