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
                            $sql = mysqli_query($con, "SELECT * FROM barang as b INNER JOIN penjualan as p ON b.id_barang=p.id_barang WHERE p.id_penjualan = '$id'") or die(mysqli_error($con));
                            $data = mysqli_fetch_array($sql)
                            ?>
                            <form action="" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <label for="kategori">
                                        <div class="section-title mt-0"> Nama Barang </div>
                                    </label>

                                    <select class="custom-select" id="idbarang" name="idbarang">
                                        <option value="<?= $data['id_barang'] ?>" selected><?= $data['nama_barang'] ?></option>
                                        <?php

                                        $sql2 = mysqli_query($con, "SELECT * FROM barang ");
                                        while ($row2 = mysqli_fetch_array($sql2)) {
                                        ?>
                                            <option value="<?= $row2['id_barang'] ?>"><?= $row2['nama_barang'] ?></option>
                                        <?php

                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="Bulan">
                                        <div class="section-title mt-0"> Bulan </div>
                                    </label>

                                    <select class="custom-select" id="Bulan" name="bulan">
                                        <option value="<?= $data['bulan'] ?>" selected><?= $data['bulan'] ?></option>
                                        <option value="Januari">Januari</option>
                                        <option value="Februari">Februari</option>
                                        <option value="Maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                        <option value="Juni">Juni</option>
                                        <option value="Juli">Juli</option>
                                        <option value="Agustus">Agustus</option>
                                        <option value="September">September</option>
                                        <option value="Oktober">Oktober</option>
                                        <option value="November">November</option>
                                        <option value="Desember">Desember</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tahun">
                                        <div class="section-title mt-0"> Tahun </div>
                                    </label>

                                    <select class="custom-select" id="Tahun" name="tahun">
                                        <option value="<?= $data['tahun'] ?>" selected><?= $data['tahun'] ?></option>
                                       
                                            <option value="2022">2022</option>

                                          <option value="2021">2021</option>

                                        <option value="2020">2020</option>
                                           <option value="2019">2019</option>
                                      
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="section-title mt-0">Stok Barang</div>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" name="stokbarang" value="<?= $data['stok_barang'] ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="section-title mt-0">Harga</div>
                                    <div class="input-group mb-2">

                                        <div class="input-group-text">
                                            Rp
                                        </div>
                                        <input type="number" class="form-control" name="harga" value="<?= $data['harga_satuan'] ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="section-title mt-0">Terjual</div>
                                    <div class="input-group mb-2">

                                        <input type="number" class="form-control" name="terjual" value="<?= $data['terjual'] ?>" required>
                                    </div>
                                </div>
                                <div class="card-footer bg-white text-right">
                                    <button class="btn btn-dark mr-1" type="submit" name="submit">Update</button>
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
    $idbarang = $_POST['idbarang'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $terjual = $_POST['terjual'];
    $harga = $_POST['harga'];
    $stok = $_POST['stokbarang'];

$totalharga = $harga * $terjual;
    
        $update = mysqli_query($con, "UPDATE penjualan set id_barang ='$idbarang', bulan ='$bulan', tahun ='$tahun', terjual ='$terjual' , harga_satuan ='$harga', stok_barang ='$stok', total_harga ='$totalharga' WHERE id_penjualan = '$id'") or die(mysqli_error($con));

        echo "<script type='text/javascript'>
                                setTimeout(function () { 
                                    swal({ 
                                        title: 'Suksess', 
                                        text: 'Data Penjualan Berhasil Disimpan', 
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