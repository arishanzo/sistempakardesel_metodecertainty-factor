<?php
require_once "../config/config.php";

$del1 = mysqli_query($con, "DELETE FROM t_diagnosa");

$i = 0;

// cek apakah data ada atau tidak ada
if ($_GET['cek'] == 'data tidak ada') {
    // melakukan perulangan sesuai data yang di pilih
    echo "<script>alert('Gagal di tambahkan Mohon Pilih Kerusakan Terelebih Dahulu!');history.go(-1);</script>";
} else {
    foreach ($_GET['pilih'] as $value) {

        $i++;

        // mengambil nilai get kerusakan

        $kerusakan = $_GET['kerusakan' . $i];
        $idkerusakan = $_GET['idkerusakan' . $i];
        $del1 = mysqli_query($con, "DELETE FROM hasil where kd_kerusakan='$idkerusakan'");

        // Mengambil data kd kerusakan dan id gejala dari database
        $SqlQuery = mysqli_query($con, "SELECT * FROM t_gejala as g inner join t_kerusakan as t on g.kd_kerusakaan = t.kd_kerusakan WHERE t.nama_kerusakan='$kerusakan'");
        $row = mysqli_fetch_array($SqlQuery);
        $idkerusakan = $row['kd_kerusakan'];
        $idgejala = $row['id_gejala'];


        $Sqlbasis = mysqli_query($con, "SELECT * FROM basis_pengetahuan");
        while ($rowbasis = mysqli_fetch_array($Sqlbasis)) {
            // menyimpan data yang di pilih tadi kedalam tabel t diagnosa
            if ($value == $rowbasis['keterangan']) {
                $mb = $rowbasis['mb_basis'];
                $md = $rowbasis['md_basis'];
                // menyimpan data yang di pilih tadi kedalam tabel t diagnosa

                $save = mysqli_query($con, "INSERT INTO t_diagnosa VALUES ('', '$idgejala', '$idkerusakan','$mb', '$md')") or die(mysqli_error($con));
            }
        }
    }

    // cek gejala 
    $gejala = mysqli_query($con, "SELECT * FROM t_gejala as g inner join t_kerusakan as t on t.nama_kerusakan ='$kerusakan' WHERE g.kd_kerusakaan = t.kd_kerusakan");
    $no = 1;
    // cek jika jumlah gejala ada 1 maka akan di proses seperti ini
    if (mysqli_num_rows($gejala) == 1) {
        while ($row = mysqli_fetch_array($gejala)) {
            $kd_kerusakangejala = $row['kd_kerusakan'];
            // query diagnosa
            $sqldiagnosa = mysqli_query($con, "SELECT * FROM t_diagnosa where kd_kerusakan = '$kd_kerusakangejala'");
            $rowcek = mysqli_fetch_array($sqldiagnosa);
            $kd_kerusakan = $rowcek['kd_kerusakan'];
            // nilai mb
            $mb = $rowcek['mb'];
            // nilai md
            $md = $rowcek['md'];
            // nilai cf
            $cf = $mb - $md;
            $save = mysqli_query($con, "INSERT INTO hasil VALUES ('', '$idkerusakan', '$cf','')") or die(mysqli_error($con));
            echo "<script>alert('Data Berhasil Ditambahkan');history.go(-1);</script>";
        }
    } else if (mysqli_num_rows($gejala) > 1) {
        $array = 0;
        // cek data di tabel diagnosa
        $sqldiagnosa = mysqli_query($con, "SELECT * FROM t_diagnosa where kd_kerusakan = '$idkerusakan'");
        while ($rowcek = mysqli_fetch_array($sqldiagnosa)) {
            $kd_kerusakangejala = $rowcek['kd_kerusakan'];
            // variabel array
            $array++;


            // cek jika array adalah 1 maka akan di cek array pertama
            if ($array == 1) {
                // nilai mblama
                $mblama = $rowcek['mb'];
                // nilai mdlama
                $mdlama = $rowcek['md'];
                // nilai cf
                $cf = $mb - $md;
                $save = mysqli_query($con, "INSERT INTO hasil VALUES ('', '$idkerusakan', '$cf','')") or die(mysqli_error($con));
                echo "<script>alert('Data Berhasil Ditambahkan');history.go(-1);</script>";
                // cek jika array adalah 2 maka akan di cek array ke dua
            } else if ($array == 2) {
                // nilai mb baru
                $mbbaru = $rowcek['mb'];
                // nilai md baru
                $mdbaru = $rowcek['md'];
                // hitung
                $mbsementara = $mblama + ($mbbaru * (1 - $mblama));
                $mdsementara = $mdlama + ($mdbaru * (1 - $mdlama));

                $mb = $mbsementara;
                $md = $mdsementara;
                // nilai cf
                $cf = $mb - $md;

                $update = mysqli_query($con, "UPDATE hasil set nilai_cf ='$cf' WHERE kd_kerusakan = '$idkerusakan'") or die(mysqli_error($con));
                echo "<script>alert('Data Berhasil Ditambahkan');history.go(-1);</script>";
            } else if ($array >= 3) {
                $mblama = $mbsementara;
                $mdlama = $mdsementara;
                $mbbaru = $rowcek['mb'];
                $mdbaru = $rowcek['md'];
                $mbsementara = $mblama + ($mbbaru * (1 - $mblama));
                $mdsementara = $mdlama + ($mdbaru * (1 - $mdlama));
                //jika ini adalah gejala terakhir berarti CF ketemu


                $mb3 = $mbsementara;
                $md3 = $mdsementara;
                $cf3 = round($mb3 - $md3, 1);
                $update = mysqli_query($con, "UPDATE hasil set nilai_cf ='$cf3' WHERE kd_kerusakan = '$idkerusakan'") or die(mysqli_error($con));
            }
        }
    }
}
echo "<script>alert('Data Berhasil Ditambahkan');history.go(-1);</script>";
