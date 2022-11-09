<?php
include 'koneksi.php';
session_start();
include 'authcheck.php';
include 'navbar.php';

$barang = mysqli_query($conn, 'SELECT * FROM barang');
// print_r($_SESSION);

$sum = 0;
if (isset($_SESSION['cart'])) {
	foreach ($_SESSION['cart'] as $key => $value) {
		$sum += ($value['qty']);
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Kasir</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Kasir</h1>
				<h2>Hai <?= $_SESSION['nama_petugas'] ?></h2>
				<a href="logout.php">Logout</a> |
				<a href="keranjang_reset.php">Reset Keranjang</a> |
				<a href="tampil_transaksi.php">Riwayat Transaksi</a>
				<br>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-8">
				<form method="post" action="keranjang_act.php">
					<div class="form-group">
						<input type="text" name="kode_barang" class="form-control" placeholder="Masukkan kode barang" autofocus>
					</div>
				</form>
				<br>
				<form method="post" action="keranjang_update.php">
					<table class="table table-bordered">
						<tr>
							<th>Nama</th>
							<th>Qty</th>
							<th></th>
						</tr>
						<?php if (isset($_SESSION['cart'])) : ?>
							<?php foreach ($_SESSION['cart'] as $key => $value) { ?>
								<tr>
									<td>
										<?= $value['nama'] ?>
									</td>
									<td class="col-md-2">
										<input type="number" name="qty[<?= $key ?>]" value="<?= $value['qty'] ?>" class="form-control">
									</td>
									<td><a href="keranjang_hapus.php?id=<?= $value['id'] ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a></td>
								</tr>
							<?php } ?>
						<?php endif; ?>
					</table>
					<button type="submit" class="btn btn-success">Perbaruhi</button>
				</form>
			</div>
			<div class="col-md-4">
				<h3>Total : <?= number_format($sum) ?></h3>
				<form action="transaksi_act.php" method="POST">
					<input type="hidden" name="total" value="<?= $sum ?>">
					<h5> member </h5>
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
					<div class="form-group">
						<input type="hidden" id="bayar" name="bayar" class="form-control">
					</div>
					<button type="submit" class="btn btn-primary">Selesai</button>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#NIP').select2();
		});

		//inisialisasi inputan
		var bayar = document.getElementById('bayar');

		bayar.addEventListener('keyup', function(e) {
			bayar.value = formatRupiah(this.value, 'Rp. ');
			// harga = cleanRupiah(dengan_rupiah.value);
			// calculate(harga,service.value);
		});

		//generate dari inputan angka menjadi format rupiah

		function formatRupiah(angka, prefix) {
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
				split = number_string.split(','),
				sisa = split[0].length % 3,
				rupiah = split[0].substr(0, sisa),
				ribuan = split[0].substr(sisa).match(/\d{3}/gi);

			if (ribuan) {
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

		//generate dari inputan rupiah menjadi angka

		function cleanRupiah(rupiah) {
			var clean = rupiah.replace(/\D/g, '');
			return clean;
			// console.log(clean);
		}
	</script>
</body>

</html>