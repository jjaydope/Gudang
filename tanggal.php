<html>
    <?php include "koneksi.php" ?>
    <?php include "header.php" ?>
    

    <head>
        <title> Juned💗tyun 🧑🏻‍❤️‍🧑🏽 ril jgn iri</title>
        <!-- bootstrap cdn  -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- css bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    
    <body>
    <div class="container">
  <div align="center">
    <h3>Barang Masuk</h3>
    </div>
<div class="container mt-4">
    
            <!-- form filter data berdasarkan range tanggal  -->
            <form action="tanggal.php" method="get">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label class="col-form-label">Periode</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" class="form-control" name="dari" required>
                    </div>
                    <div class="col-auto">
                        -
                    </div>
                    <div class="col-auto">
                        <input type="date" class="form-control" name="ke" required>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit">Cari</button>
                     <!-- running ke zummy 7 #sy tertekan bezty  -->
                        <a href="zummy7.php" class="btn btn-danger">Reset</a>
                    </div>
                </div>
            </form>
    
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Barang</td>
                                <td>Tanggal Masuk</td>
                                <td>Jumlah Barang</td>
                            </tr>
                        </thead>
                        <?php 
                            //jika tanggal dari dan tanggal ke ada maka
                            if(isset($_GET['dari']) && isset($_GET['ke'])){
                                // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                $data = mysqli_query($conn, "SELECT * FROM barang_masuk WHERE tgl_masuk BETWEEN '".$_GET['dari']."' and '".$_GET['ke']."'");
                            }else{
                                //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                $data = mysqli_query($conn, "select * from barang_masuk ");		
                            }
                            // $no digunakan sebagai penomoran 
                            $no = 1;
                            // while digunakan sebagai perulangan data 
                            while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>                                   
                        <?php
                        include "koneksi.php";
                        $qry_get_barang=mysqli_query($conn, "select * from barang where id_barang='".$d['id_barang']."'");
                        $data_barang = mysqli_fetch_array($qry_get_barang   );
                        echo $data_barang['nama_barang']; 
                    ?>
                    <!-- <?php echo $data_barang['id_barang']?> --></td>

                    <td><?php echo date('d-M-Y', strtotime($d['tgl_masuk']))?></td>
                    <td><?php echo $d['stok']?></td>
                   
                            
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
    
    </html>