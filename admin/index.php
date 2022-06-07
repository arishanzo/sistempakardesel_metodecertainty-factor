<?php include_once('header.php');
require_once "../config/config.php";
?>

<div class="col-lg-12 mt-5">
    <div class="card">
        <div class="card-body">
            <a class="btn btn-info btn-action btn-xs mr-1" href="add.php" data-toggle="tooltip" title="Tambah data"><span>Tambah Data Admin</span></a>
        </div>
        <div class="card-body">

            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 admin" id="admin">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Admin</th>
                                    <th>Username</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $SqlQuery = mysqli_query($con, "SELECT * FROM admin");
                                $no = 1;
                                if (mysqli_num_rows($SqlQuery) > 0) {
                                    while ($row = mysqli_fetch_array($SqlQuery)) {
                                ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['username'] ?></td>

                                            <td>
                                                <a href="edit.php?id=<?= $row['id_admin'] ?>" class="btn btn-primary btn-action mr-1" title="Edit"><i class="fas fa-pencil-alt"></i></a>

                                                <a href="delete.php?id=<?= $row['id_admin'] ?>" class="btn btn-danger btn-xs delete-data" title="hapus"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan=\"8\" align=\"center\">data tidak ada</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </section>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('.admin').DataTable({
            "paging": true,

        });

    });
</script>

<script>
    // swall
    $('.delete-data').on('click', function(e) {
        e.preventDefault();
        var getLink = $(this).attr('href');

        Swal.fire({
            title: 'Apa Anda Yakin?',
            text: "Data akan dihapus permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                window.location.href = getLink;
            }
        })
    });
</script>
<?php include_once('footer.php');

?>