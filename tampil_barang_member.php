<?php include "header_member.php"; ?>
<?php include 'koneksi.php'; ?>

<h2>Daftar Barang</h2>
<h6>Pencarian</h6>
		 <form action="tampil_barang_member.php" method="get">
 		<label>Cari :</label>
 		<input type="text" name="cari">
		<input type="submit" value="Cari">
		<a href="tampil_barang_member.php" class="btn btn-danger">Reset</a>
		</form>	
		

<div class="row">
<?php
$batas = 8;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

$previous = $halaman - 1;
$next = $halaman + 1;
$qry_barang = mysqli_query($conn,"select * from barang ");
$jumlah_data = mysqli_num_rows($qry_barang);
$total_halaman = ceil($jumlah_data / $batas);

if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $qry_barang=mysqli_query($conn,"select * from barang where nama_barang like '%".$cari."%'");    
}else{
    $qry_barang = mysqli_query($conn,"select * from barang limit $halaman_awal, $batas");
}
while($dt_barang=mysqli_fetch_array($qry_barang)){
?>
<div class="col-md-3">
<div class="card" >
<div class="card-body">
<h5 class="card-title"><?=$dt_barang['nama_barang']?></h5>
<h4></h4>
<h6> stok </h6><p class="card-text"><?=substr($dt_barang['stok'] ,
0,20)?></p>

<a href="minta_barang.php?id_barang=<?=$dt_barang['id_barang']?>" class="btn btn-info">Minta</a></td>

</div>
</div>
</div>
<?php
}
?>
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
