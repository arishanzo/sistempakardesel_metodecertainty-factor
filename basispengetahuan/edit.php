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
                            $sql = mysqli_query($con, "SELECT * FROM basis_pengetahuan WHERE id_pengetahuan = '$id'") or die(mysqli_error($con));
                            $data = mysqli_fetch_array($sql)
                            ?>
                            <form action="" enctype="multipart/form-data" method="post">

                                <div class="form-group">
                                    <label for="kategori">
                                        <div class="section-title mt-0"> Keterangan </div>
                                    </label>

                                    <select class="custom-select" id="pengetahuan" name="keterangan">
                                        <option <?= $data['keterangan'] ?>selected><?= $data['keterangan'] ?></option>
                                        <option value="Sangat Yakin">Sangat Yakin</option>
                                        <option value="Yakin">Yakin</option>
                                        <option value="Cukup Yakin">Cukup Yakin</option>
                                        <option value="Sedikit Yakin">Sedikit Yakin</option>
                                        <option value="Tidak Tahu">Tidak Tahu</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="section-title mt-0">MB</div>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="mb" required value="<?= $data['mb_basis'] ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="section-title mt-0">MD</div>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="md" required value="<?= $data['md_basis'] ?>">
                                    </div>
                                </div>

                                <div class=" card-footer bg-white text-right">
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
    $id_admin = @$_SESSION['id_admin'];

    $mb = $_POST['mb'];
    $md = $_POST['md'];
    $keterangan = $_POST['keterangan'];


    $update = mysqli_query($con, "UPDATE basis_pengetahuan set  keterangan ='$keterangan', mb_basis='$mb' , md_basis='$md'  WHERE id_pengetahuan = '$id'") or die(mysqli_error($con));

    echo "<script type='text/javascript'>
                        setTimeout(function () { 
                            swal({ 
                                title: 'success', 
                                text: 'Berhasil Di Update', 
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