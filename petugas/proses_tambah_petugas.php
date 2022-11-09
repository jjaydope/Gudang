<?php
	if($_POST){

        $username=$_POST['username'];
        $password=$_POST['password'];
		$nama_petugas=$_POST['nama_petugas'];
        $role=$_POST['role'];
		
		if(empty($username)){
			echo "<script>alert('username tidak boleh kosong');location.href='tambah_petugas.php';</script>";
		} elseif(empty($password)){
			echo "<script>alert('password tidak boleh kosong );location.href='tambah_petugas.php';</script>";
        } elseif(empty($nama_petugas)){
			echo "<script>alert('Nama tidak boleh kosong');location.href='tambah_petugas.php';</script>";   
        } elseif(empty($role)){
			echo "<script>alert('input role !');location.href='tambah_petugas.php';</script>";
		} else {
			include "../koneksi.php";
			
			$insert=mysqli_query($conn,"insert into petugas (username,password,nama_petugas,role) value ('".$username."','".md5($password)."','".$nama_petugas."','".$role."')");
			
			if($insert){
				echo "<script>alert('Petugas berhasil di tambah ');location.href='../tampil_petugas.php';</script>";
			} else {
				echo "<script>alert('Gagal Menambah Petugas ');location.href='tambah_petugas.php';</script>";
			
			}
		}
		
		
	}
