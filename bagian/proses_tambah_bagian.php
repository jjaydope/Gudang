<?php
	if($_POST){

        $nama_bagian=$_POST['nama_bagian'];
  
		
		if(empty($nama_bagian)){
			echo "<script>alert('bagian tidak boleh kosong');location.href='tambah_bagian.php';</script>";
		} else {
			include "../koneksi.php";
			
			$insert=mysqli_query($conn,"insert into bagian (nama_bagian) value ('". $nama_bagian."')");
			
			if($insert){
				echo "<script>alert('Bagian berhasil di tambah ');location.href='../tampil_bagian.php';</script>";
			} else {
				echo "<script>alert('Gagal Menambah Bagian ');location.href='../tampil_bagian.php';</script>";
			
			}
		}
		
		
	}
?>