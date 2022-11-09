<?php
include 'koneksi.php';
include "header.php";
if ($_SESSION['role']=="owner") {
    echo "<script>location.href='home.php';</script>";
}
?>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- css bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body class="bg-secondary">
    <div>
    <div class="container">
  <div align="center">
    <h3>Transaksi</h3>
    </div>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>PETUGAS</th>
                    <th>MEMBER</th>
                    <th>TANGGAL</th>
                    <th>BARANG</th>
                    <th>TOTAL</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
               $batas = 5;
               $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
               $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

               $previous = $halaman - 1;
               $next = $halaman + 1;

                $data=mysqli_query($conn,"SELECT t.id_transaksi as t_id, m.nama as nama_member, t.tgl,  p.nama_petugas as nama_kasir FROM transaksi t, member m, petugas p WHERE t.NIP = m.NIP AND t.id_petugas = p.id_petugas  ");
                // echo "SELECT t.id_transaksi as t_id, m.nama as nama_member, t.tgl, t.batas_waktu, t.tgl_bayar, t.status, t.dibayar, u.nama as nama_kasir FROM transaksi t, member m, user u WHERE t.id_member = m.id_member AND t.id_user = u.id_user";
                               
                $jumlah_data = mysqli_num_rows($data);
				$total_halaman = ceil($jumlah_data / $batas);

                $qry_transaksi=mysqli_query($conn,"SELECT t.id_transaksi as t_id, m.nama as nama_member, t.tgl,  p.nama_petugas as nama_kasir FROM transaksi t, member m, petugas p WHERE t.NIP = m.NIP AND t.id_petugas = p.id_petugas order by tgl limit $halaman_awal, $batas");
                $nomor = $halaman_awal;

                while($data_transaksi=mysqli_fetch_array($qry_transaksi)){
                    $qry_dtl_transaksi = mysqli_query($conn, "SELECT *, qty  FROM detail_transaksi, barang WHERE id_transaksi = ".$data_transaksi['t_id']." AND barang.id_barang = detail_transaksi.id_barang");
                //    echo "SELECT *, qty * harga as total FROM detail_transaksi, paket WHERE id_transaksi = ".$data_transaksi['t_id']." AND paket.id_paket = detil_transaksi.id_paket";
                    $nomor++;
                    
                    $i = 0;
                    while ($data_dtl_transaksi = mysqli_fetch_assoc($qry_dtl_transaksi)) {
                        $i++;
                        if ($i == 1) {
                        ?>
                            <tr>
                                <td><?php echo $nomor?></td>
                                <td><?php echo $data_transaksi['nama_kasir']?></td>
                                <td><?php echo $data_transaksi['nama_member']?></td>
                                <td>
                                    <?php echo $data_transaksi['tgl']?>
                                </td>

                                <td>
                                    
                                    
                                    <?php
                        include "koneksi.php";
                        $qry_get_barang=mysqli_query($conn, "select * from barang where id_barang='".$data_dtl_transaksi['id_barang']."'");
                        $data_barang = mysqli_fetch_array($qry_get_barang   );
                        echo $data_barang['nama_barang']; 
                    ?>
                    <!-- <?php echo $data_barang['id_barang']?> --></td>

                                <td><?=$data_dtl_transaksi['qty']?></td>

                                <td> <a href="transaksi/hapus_transaksi.php?id_transaksi=<?=$data_transaksi['t_id']?>"
                                onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr> 
                        <?php
                        } else {
                        ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php
                        include "koneksi.php";
                        $qry_get_barang=mysqli_query($conn, "select * from barang where id_barang='".$data_dtl_transaksi['id_barang']."'");
                        $data_barang = mysqli_fetch_array($qry_get_barang   );
                        echo $data_barang['nama_barang']; 
                    ?>
                    <!-- <?=$data_barang['id_barang']?> --> </td>
                                <td><?=$data_dtl_transaksi['qty']?></td>
                                
                                <td></td>
                            </tr> 
                        <?php
                        }
                        
                    }
                    ?>
                    <?php
                }
                ?>
            </tbody>
            </table>
            <a href="tambah_transaksi.php?total_pckg = 1" class="btn btn-info">Tambah</a>
            <nav>
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
				</li>
			</ul>
		</nav>
	</div>
</body>
</html>