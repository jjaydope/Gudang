<?php include 'koneksi.php'; ?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"crossorigin="anonymous">
		 <title>Gudang</title>
	</head>
<body>
	<div class="container">
			<h3>pagination </h3>
		<br>	
        <h6>Pencarian</h6>
		 <form action="pagination.php" method="get">
 		<label>Cari :</label>
 		<input type="text" name="cari">
		<input type="submit" value="Cari">
		</form>	

		<table class="table table-hover table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Nomor</th>
					<th>Barang</th>
                    <th></th>
					<th>stok</th>
                    <th></th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$batas = 2;
				$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
				$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
 
				$previous = $halaman - 1;
				$next = $halaman + 1;
				
				$data = mysqli_query($conn,"select * from barang ");
				$jumlah_data = mysqli_num_rows($data);
				$total_halaman = ceil($jumlah_data / $batas);

                if(isset($_GET['cari'])){
                    $cari = $_GET['cari'];
                    $data = mysqli_query($conn,"select * from barang where nama_barang like '%".$cari."%'");    
                   }else{
                    $data = mysqli_query($conn,"select * from barang limit $halaman_awal, $batas");  
                   }
				$nomor = $halaman_awal+1;
                
				while($d = mysqli_fetch_array($data)){
					?>
                    
					<tr>
						<td><?php echo $nomor++; ?></td>
						<td><?php echo $d['nama_barang']; ?></td>
                        <td></td>
						<td><?php echo $d['stok']; ?></td>
                        <td></td>
                        <td><a
		href="barang/ubah_barang.php?id_barang=<?=$d['id_barang']?>"
		class="btn btn-success">Ubah</a>  | 

        <a href="barang/hapus_barang.php?id_barang=<?=$d['id_barang']?>"
		onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger">Hapus</a></td>

		
     </td>

					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
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