<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title></title>
</head>

<body>
    <?php
    include "header.php";
    ?>

    <html lang="en">

    <head>
        <title>Laundry</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <body>

        <h3>Transaksi</h3>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIP</th>
                    <th>Barang</th>
                    <th>QTY</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "koneksi.php";
                $qry_dtl_transaksi = mysqli_query($conn, "select * from detail_transaksi");
                $no = 0;
                while ($data_dtl_transaksi = mysqli_fetch_array($qry_dtl_transaksi)) {
                    $no++; ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td>
                            <?= $data_dtl_transaksi['id_transaksi'] ?>
                        </td>
                        <td> <?php
                                include "koneksi.php";
                                $qry_get_barang = mysqli_query($conn, "select * from barang where id_barang='" . $data_dtl_transaksi['id_barang'] . "'");
                                $data_barang = mysqli_fetch_array($qry_get_barang);
                                echo $data_barang['nama_barang'];
                                ?>
                            <!--  <?= $data_dtl_transaksi['id_barang'] ?> -->
                        </td>
                        <td><?= $data_dtl_transaksi['qty'] ?></td>
                        <td>
                            <a href="transaksi/hapus_transaksi.php?id_transaksi=<?= $data_transaksi['id_transaksi'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                        </td>




                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>

    </html>