<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudang | Transaksi</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
</head>

<body>
    <?php
    include "header.php";
    if ($_SESSION['role'] == 'owner') {
        echo "<script>alert('Role tidak benar');location.href='home.php';</script>";
    }
    ?>
    <main class="form-signin">
        <h1 class="h3 fw-normal text-center">Transaksi</h1>
        <form action="tambah_transaksi.php" method="get">
            <div class="relative mt-5">
                <label for="total_pckg">Jumlah Pemesanan</label>
                <div class="d-flex">
                    <input type="number" name="total_pckg" id="total_pckg" class="form-control" value="<?= $_GET['total_pckg'] ? $_GET['total_pckg'] : 1  ?>" min="1" />
                    <button type="submit" class="w-24 m-1 btn btn-lg btn-primary"><i class="bi bi-arrow-clockwise"></i></button>
                </div>
            </div>
        </form>
        <form action="transaksi/proses_tambah_transaksi.php" method="post">
            <div>
                <label for="member" class="form-label">Member</label>
                <select name="member" id="NIP" class="form-select">
                    <option disabled>Pilih Nama Member</option>
                    <?php
                    include "koneksi.php";
                    $qry_member = mysqli_query($conn, "select * from member");
                    while ($data_member = mysqli_fetch_array($qry_member)) {
                        echo '<option value="' . $data_member['NIP'] . '">' . $data_member['nama'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <!-- <div>
                <label for="tgl" class="form-label">Tanggal Pemesanan</label>
                <input type="date" class="form-control" id="tgl" name="tgl">
            </div> -->

            <?php for ($index = 0; $index < ($_GET['total_pckg'] ? $_GET['total_pckg'] : 1); $index++) : ?>
                <div>
                    <label for="barang" class="form-label">Barang</label>
                    <select name="id_barang[]" id="id_barang[]" class="form-select">
                        <option disabled selected>Jenis Barang</option>
                        <?php
                        include "koneksi.php";
                        $qry_packg = mysqli_query($conn, "select * from barang");
                        while ($data_packg = mysqli_fetch_array($qry_packg)) {
                            echo '<option value="' . $data_packg['id_barang'] . '">' . $data_packg['nama_barang'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <label for="qty" class="form-label">Kuantitas</label>
                <div class="form-floating">
                    <div class="d-flex">
                        <input type="number" class="form-control" id="qty[]" name="qty[]">
                        <span class="align-items-center justify-content-center d-flex my-auto m-1">pcs</span>
                    </div>
                </div>
            <?php endfor; ?>

            <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Tambah</button>
        </form>
    </main>
    <!-- Bootstrap Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#NIP').select2();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>