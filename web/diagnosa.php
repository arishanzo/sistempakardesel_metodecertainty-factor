<?php require_once "../config/config.php"; ?>
<?php

$perintah = "SELECT * from t_gejala";
$minta = mysqli_query($mysqli, $perintah);
$sql = '';
$i = 0;
//mengecek semua chekbox gejala
while ($hs = mysqli_fetch_array($minta)) {
	//jika gejala dipilih
	//menyusun daftar gejala misal '1','2','3' dst utk dipakai di query
	if ($_POST['gejala' . $hs['kd_gejala']] == 'true') {
		if ($sql == '') {
			$sql = "'$hs[kd_gejala]'";
		} else {
			$sql = $sql . ",'$hs[kd_gejala]'";
		}
	}
	$i++;
}



empty($daftar_kerusakan);
empty($daftar_cf);

if ($sql != '') {
	//mencari kode_penyakit di tabel pengetahuan yang gejalanya dipilih
	$perintah = "SELECT kd_kerusakan FROM t_diagnosa WHERE kd_gejala IN ($sql) GROUP BY kd_kerusakan ORDER BY kd_kerusakan";
	//echo "<br/>".$perintah."<br/>";
	$minta = mysqli_query($mysqli, $perintah);
	$kode_penyakit_terbesar = '';
	$nama_penyakit_terbesar = '';
	$c = 0;

	while ($hs = mysqli_fetch_array($minta)) {
		//memproses id penyakit satu persatu
		$kode_penyakit = $hs['kd_kerusakan'];
		$qryi = "SELECT * FROM t_kerusakan WHERE kd_kerusakan = '$kode_penyakit'";
		$qry = mysqli_query($mysqli, $qryi);
		$dt = mysqli_fetch_array($qry);
		$nama_penyakit = $dt['nama_kerusakan'];
		$daftar_penyakit[$c] = $hs['kd_kerusakan'];
		$p = "SELECT kd_kerusakan, mb, md, kd_gejala FROM t_diagnosa WHERE kd_gejala IN ($sql) AND kd_kerusakan = '$kode_penyakit'";
		//echo $p.'<br/>';
		$m = mysqli_query($mysqli, $p);
		//mencari jumlah gejala yang ditemukan
		$jml = mysqli_num_rows($m);
		//jika gejalanya 1 langsung ketemu CF nya

		if ($jml == 1) {
			$h = mysqli_fetch_array($m);
			$mb = $h['mb'];
			$md = $h['md'];
			$cf = $mb - $md;
			$daftar_cf[$c] = $cf;
			//cek apakah penyakit ini adalah penyakit dgn CF terbesar ?
			if (($id_penyakit_terbesar == '') || ($cf_terbesar < $cf)) {
				$cf_terbesar = $cf;
				$id_penyakit_terbesar = $kode_penyakit;
				$nama_penyakit_terbesar = $nama_penyakit;
			}
			//jika jumlah gejala cuma dua maka CF ketemu	
		} else if ($jml > 1) {
			$i = 1;
			//proses gejala satu persatu
			while ($h = mysqli_fetch_array($m)) {
				//pada gejala yang pertama masukkan MB dan MD menjadi MBlama dan MDlama
				if ($i == 1) {
					$mblama = $h['mb'];
					$mdlama = $h['md'];
				}
				//pada gejala yang nomor dua masukkan MB dan MD menjadi MBbaru dan MB baru kemudian hitung MBsementara dan MDsementara
				else if ($i == 2) {
					$mbbaru = $h['mb'];
					$mdbaru = $h['md'];
					$mbsementara = $mblama + ($mbbaru * (1 - $mblama));
					$mdsementara = $mdlama + ($mdbaru * (1 - $mdlama));
					//jika jumlah gejala cuma dua maka CF ketemu
					if ($jml == 2) {
						$mb = $mbsementara;
						$md = $mdsementara;
						$cf = $mb - $md;
						$daftar_cf[$c] = $cf;
						//cek apakah penyakit ini adalah penyakit dgn CF terbesar ?
						if (($id_penyakit_terbesar == '') || ($cf_terbesar < $cf)) {
							$cf_terbesar = $cf;
							$id_penyakit_terbesar = $id_penyakit;
							$nama_penyakit_terbesar = $nama_penyakit;
						}
					}
				}
				//pada gejala yang ke 3 dst proses MBsementara dan MDsementara menjadi MBlama dan MDlama
				//MB dan MD menjadi MBbaru dan MDbaru
				//hitung MBsementara dan MD sementara yg sekarang
				else if ($i >= 3) {
					$mblama = $mbsementara;
					$mdlama = $mdsementara;
					$mbbaru = $h['mb'];
					$mdbaru = $h['md'];
					$mbsementara = $mblama + ($mbbaru * (1 - $mblama));
					$mdsementara = $mdlama + ($mdbaru * (1 - $mdlama));
					//jika ini adalah gejala terakhir berarti CF ketemu
					if ($jml == $i) {
						$mb = $mbsementara;
						$md = $mdsementara;
						$cf = $mb - $md;
						$daftar_cf[$c] = $cf;
						//cek apakah penyakit ini adalah penyakit dgn CF terbesar ?
						if (($id_penyakit_terbesar == '') || ($cf_terbesar < $cf)) {
							$cf_terbesar = $cf;
							$id_penyakit_terbesar = $kode_penyakit;
							$nama_penyakit_terbesar = $nama_penyakit;
						}
					}
				}
				$i++;
			}
		}
		$c++;
	}
}
//urutkan daftar gejala berdasarkan besar CF
for ($i = 0; $i < count($daftar_penyakit); $i++) {
	for ($j = $i + 1; $j < count($daftar_penyakit); $j++) {
		if ($daftar_cf[$j] > $daftar_cf[$i]) {
			$t = $daftar_cf[$i];
			$daftar_cf[$i] = $daftar_cf[$j];
			$daftar_cf[$j] = $t;

			$t = $daftar_penyakit[$i];
			$daftar_penyakit[$i] = $daftar_penyakit[$j];
			$daftar_penyakit[$j] = $t;
		}
	}
}

?>