<?php
include "header.php";
include('koneksi.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Grafik Barang</title>
	<script src="js/Chart.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="row">
      <div class="panel panel-default">
        <div class="panel-heading"><b>Pencarian</b></div>
        <div class="panel-body">
<form class="form-inline" >
  <div class="form-group">
    <select class="form-conntrol" id="Kolom" name="Kolom" required="">
      <?php
        $kolom=(isset($_GET['Kolom']))? $_GET['Kolom'] : "";
      ?>
	<option value="nama_barang" <?php if ($kolom=="nama_barang") echo "selected"; ?>>Barang</option>
	
	
    </select>
  </div>
  <div class="form-group">
    <input type="text" class="form-conntrol" id="KataKunci" name="KataKunci" placeholder="Kata kunci.." required="" value="<?php if (isset($_GET['KataKunci']))  echo $_GET['KataKunci']; ?>">
  </div>
  <button type="submit" class="btn btn-primary">Cari</button>
  <a href="zummy4.php" class="btn btn-danger">Reset</a>
</form> 

	<div style="width: 1100px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>
  
  <?php
  $kolomCari=(isset($_GET['Kolom']))? $_GET['Kolom'] : "";
		 
  $kolomKataKunci=(isset($_GET['KataKunci']))? $_GET['KataKunci'] : "";
  //kondisi jika parameter pencarian kosong
  if($kolomCari=="" && $kolomKataKunci==""){
    $produk =mysqli_query($conn,"select * from barang");
  }else{
    //kondisi jika parameter kolom pencarian diisi
    $produk = mysqli_query($conn, "select * from barang WHERE $kolomCari LIKE '%$kolomKataKunci%'");
    }
    while($row = mysqli_fetch_array($produk)){
	  $nama_produk[] = $row['nama_barang'];
	
	  $query = mysqli_query($conn,"select sum(qty) as qty from detail_transaksi where id_barang='".$row['id_barang']."'");
	  $row = $query->fetch_array();
	  $jumlah_produk[] = $row['qty'];
  }
    $produk = mysqli_query($conn,"select * from barang");
    while($row = mysqli_fetch_array($produk)){	
	  $query = mysqli_query($conn,"select sum(stok) as stok from barang_masuk where id_barang='".$row['id_barang']."'");
	  $row = $query->fetch_array();
	  $jumlah_produk2[] = $row['stok'];
}
?>
 
 
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($nama_produk); ?>,
				datasets: [{
					label: 'barang keluar',
					data: <?php echo json_encode($jumlah_produk); ?>,
					backgroundColor: 'rgb(175, 238, 239)',
					borderColor: 'rgb(175, 238, 239)',
					borderWidth: 1
				},{
					label: 'barang Masuk',
					data: <?php echo json_encode($jumlah_produk2); ?>,
					backgroundColor: 'rgb(60, 179, 113)',
					borderColor: 'rgb(60, 179, 113)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>