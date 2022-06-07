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
                            <?php
                            $id = @$_GET['id'];
                            $sql_admin = mysqli_query($con, "SELECT * FROM t_kerusakan WHERE kd_kerusakan = '$id'") or die(mysqli_error($con));
                            $data = mysqli_fetch_array($sql_admin)
                            ?>
                            <form action="" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <div class="section-title mt-0">Nama Kerusakan</div>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="nama" required value="<?= $data['nama_kerusakan'] ?>">
                                    </div>
                                </div>
                                s
                                <div class="card-footer bg-white text-right">
                                    <button class="btn btn-success mr-1" type="submit" name="submit">Update</button>

                                </div>
                                </from>
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
    $update = mysqli_query($con, "UPDATE t_kerusakan set nama_kerusakan ='$nama' WHERE kd_kerusakan = '$id'") or die(mysqli_error($con));

    echo "<script type='text/javascript'>
                        setTimeout(function () { 
                            swal({ 
                                title: 'success', 
                                text: 'Berhasil Di Updhate', 
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
</div>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
<?php include_once('footer.php');

?>