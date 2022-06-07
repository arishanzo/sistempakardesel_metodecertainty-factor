<?php
require_once "../config/config.php";
if (isset($_GET['idkerusakan'])) {

    $idkerusakan = $_GET["idkerusakan"];
    $qdatagrid = "SELECT * FROM t_gejala as g inner join t_kerusakan as t on g.kd_kerusakaan = t.kd_kerusakan where t.kd_kerusakan ='$idkerusakan'";
    $rdatagrid = mysqli_query($con, $qdatagrid);
    $i = 0;
    if (mysqli_num_rows($rdatagrid) > 0) {
        while ($ddatagrid = mysqli_fetch_array($rdatagrid)) {
            $cek = mysqli_num_rows($rdatagrid);
            $i++;
?>

            <tr>
                <td style=text-align:left> <input type="text" class="form-control bg-white" readonly required name="kerusakan<?= $i ?>" value="<?= $ddatagrid['nama_kerusakan'] ?>">
                    <input hidden type="text" class="form-control bg-white" readonly required name="idkerusakan<?= $i ?>" value="<?= $ddatagrid['kd_kerusakan'] ?>">
                    <input hidden type="text" class="form-control bg-white" readonly required name="cek" value="ada">

                </td>
                <td style=text-align:left> <input type="text" class="form-control bg-white" readonly required name="gejala<?= $i ?>" value="<?= $ddatagrid['nama_gejala'] ?>">
                </td>
                <td>
                    <select class="custom-select" name="pilih[]">
                        <option disabled selected>Pilih</option>
                        <option value="Sangat Yakin">Sangat Yakin</option>
                        <option value="Yakin">Yakin</option>
                        <option value="Sedikit Yakin">Sedikit Yakin</option>
                        <option value="Cukup Yakin">Cukup Yakin</option>
                        <option value="Tidak Tahu">Tidak Tahu</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </td>
            </tr>

        <?php
        }
    } else {
        ?>
        <td colspan="8" align="center">data tidak ada <input hidden type="text" class="form-control bg-white" readonly required name="cek" value="data tidak ada">
        </td>
<?php
    }
}
?>