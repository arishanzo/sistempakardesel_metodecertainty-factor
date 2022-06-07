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
                                <?php
                                // mengambil data barang dengan kode paling besar
                                $query = mysqli_query($con, "SELECT max(kd_gejala) as maxKode FROM t_gejala");
                                $data = mysqli_fetch_array($query);
                                $id = $data['maxKode'];


                                $urutan = $id;

                                $urutan++;
                                $huruf = "G";
                                $id = $huruf . sprintf("%03s", $urutan);
                                ?>

                                <div class="form-group">
                                    <label for="kategori">
                                        <div class="section-title mt-0"> Nama Kerusakan </div>
                                    </label>

                                    <select class="custom-select" name="idkerusakan">
                                        <option disabled selected>Pilih Kerusakan</option>
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
                                        <input type="text" class="form-control" name="kdgejala" required value="G0">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="section-title mt-0">Gejala Kerusakan</div>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="gejala" required>
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

    $idkerusakan = $_POST['idkerusakan'];
    $gejala = $_POST['gejala'];
    $kdgejala = $_POST['kdgejala'];

    $save = mysqli_query($con, "INSERT INTO t_gejala VALUES ('$id', '$kdgejala','$idkerusakan', '$gejala')") or die(mysqli_error($con));

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