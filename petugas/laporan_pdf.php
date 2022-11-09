<!DOCTYPE html>
<html>
<head>
	<title>Cetak|Petugas</title>
</head>
<body>
 
	<center>
 
		<h2>Data Petugas</h2>
 
	</center>
 
	<?php 
	include '../koneksi.php';
	?>
 
	<table border="1" style="width: 100%">
		<tr>
			<th width="1%">No</th>
			<th>Nama </th>
			<th>Username</th>
			<th width="5%">Role</th>
		</tr>
		<?php 
		$no = 1;
		$sql = mysqli_query($conn,"select * from petugas");
		while($data = mysqli_fetch_array($sql)){
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $data['nama_petugas']; ?></td>
			<td><?php echo $data['username']; ?></td>
			<td><?php echo $data['role']; ?></td>
		</tr>
		<?php 
		}
		?>
	</table>
 
	<script>
		window.print();
	</script>
 
</body>
</html>













