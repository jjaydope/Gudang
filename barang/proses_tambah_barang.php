<?php
	if($_POST){

        $nama_barang=$_POST['nama_barang'];
		$kode=$_POST['kode_barang'];
        $stok=$_POST['stok'];
		
		if(empty($nama_barang)){
			echo "<script>alert('barang tidak boleh kosong');location.href='tambah_barang.php';</script>";
		} elseif(empty($stok)){
			echo "<script>alert('stok tidak boleh kosong );location.href='tambah_barang.php';</script>";
		} else {
			include "../koneksi.php";
			
			$insert=mysqli_query($conn,"insert into barang (kode_barang,nama_barang,stok) value ('". $kode."','". $nama_barang."','".$stok."')");
			
			if($insert){
				echo "<script>alert('Barang berhasil di tambah ');location.href='../tampil_barang.php';</script>";
			} else {
				echo "<script>alert('Gagal Menambah Barang ');location.href='tambah_barang.php';</script>";
			
			}
		}
		
		
	}
?>