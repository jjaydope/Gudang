<?php
	if($_POST){

        $nama_barang=$_POST['nama'];
        $kode=$_POST['kode_barang'];
        $stok=$_POST['stok'];
		
		if(empty($nama_barang)){
			echo "<script>alert('barang tidak boleh kosong');location.href='add_dummy.php';</script>";
		} elseif(empty($stok)){
			echo "<script>alert('stok tidak boleh kosong );location.href='add_dummy.php';</script>";
		} else {
			include "../koneksi.php";
			
			$insert=mysqli_query($conn,"insert into dummy (nama,stok,kode_barang) value ('". $nama_barang."','".$stok."','". $kode."')");
			
			if($insert){
				echo "<script>alert('Barang berhasil di tambah ');location.href='dummy.php';</script>";
			} else {
				echo "<script>alert('Gagal Menambah Barang ');location.href='add_dummy.php';</script>";
			
			}
		}
		
		
	}
?>