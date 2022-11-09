<?php
	if($_POST){

        $barang=$_POST['id_barang'];
        $tglmasuk=$_POST['tgl_masuk'];
        $stok=$_POST['stok'];
		
		if(empty($barang)){
			echo "<script>alert('barang tidak boleh kosong');location.href='barang_masuk.php';</script>";
		} elseif(empty($stok)){
			echo "<script>alert('stok tidak boleh kosong );location.href='barang_masuk.php';</script>";
        } elseif(empty($tglmasuk)){
			echo "<script>alert('stok tidak boleh kosong );location.href='barang_masuk.php';</script>";
		} else {
			include "../koneksi.php";
			
			$insert=mysqli_query($conn,"insert into barang_masuk (id_barang,tgl_masuk,stok) value ('". $barang."','". $tglmasuk."','".$stok."')");
			
			if($insert){
				echo "<script>alert('Barang berhasil di tambah ');location.href='../tampil_barang_masuk.php';</script>";
			} else {
				echo "<script>alert('Gagal Menambah Barang ');location.href='barang_masuk.php';</script>";
			
			}
		}
		
		
	}
?>