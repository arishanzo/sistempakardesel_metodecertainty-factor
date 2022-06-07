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
                            $sql_admin = mysqli_query($con, "SELECT * FROM t_gejala as g inner join t_kerusakan as t on g.kd_kerusakaan = t.kd_kerusakan WHERE id_gejala = '$id'") or die(mysqli_error($con));
                            $data = mysqli_fetch_array($sql_admin)
                            ?>
                            <form action="" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <label for="kategori">
                                        <div class="section-title mt-0"> Nama Kerusakan </div>
                                    </label>

                                    <select class="custom-select" name="idkerusakan">
                                        <option value="<?= $data['kd_kerusakan'] ?>" selected><?= $data['nama_kerusakan'] ?></option>
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



                                <div class="form-group">
                                    <div class="section-title mt-0">Kode Gejala</div>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="gejala" required value="<?= $data['kd_gejala'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="section-title mt-0">Gejala Kerusakan</div>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="gejala" required value="<?= $data['nama_gejala'] ?>">
                                    </div>
                                </div>

                                <div class="card-footer bg-white text-right">
                                    <button class="btn btn-success mr-1" type="submit" name="submit">Update</button>
                                    <button class="btn btn-danger" type="reset">Reset</button>
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
    $idkerusakan = $_POST['idkerusakan'];
    $gejala = $_POST['gejala'];


    $update = mysqli_query($con, "UPDATE t_gejala set nama_gejala ='$gejala', kd_kerusakaan ='$idkerusakan' WHERE id_gejala = '$id'") or die(mysqli_error($con));

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