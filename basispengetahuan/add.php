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
                                    <label for="kategori">
                                        <div class="section-title mt-0"> Keterangan </div>
                                    </label>

                                    <select class="custom-select" id="pengetahuan" name="keterangan">
                                        <option disabled selected>Pilih Keterangan</option>
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
                                        <input type="text" class="form-control" name="mb" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="section-title mt-0">MD</div>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="md" required>
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
    $id_admin = @$_SESSION['id_admin'];

    $mb = $_POST['mb'];
    $md = $_POST['md'];
    $keterangan = $_POST['keterangan'];

    $save = mysqli_query($con, "INSERT INTO basis_pengetahuan VALUES ('', '$id_admin',  '$keterangan', '$mb', '$md')") or die(mysqli_error($con));

    echo "<script type='text/javascript'>
                                setTimeout(function () { 
                                    swal({ 
                                        title: 'Suksess', 
                                        text: 'Data Berhasil Disimpan', 
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