<?php
	if($_POST){

        $NIP=$_POST['NIP'];
        $nama=$_POST['nama'];
        $id_bagian=$_POST['id_bagian'];
        $password=$_POST['password'];
		
		if(empty($NIP)){
			echo "<script>alert('NIP tidak boleh kosong');location.href='tambah_member.php';</script>";
		} elseif(empty($nama)){
			echo "<script>alert('password tidak boleh kosong );location.href='tambah_member.php';</script>";
        } elseif(empty($id_bagian)){
			echo "<script>alert('bagiantidak boleh kosong');location.href='tambah_member.php';</script>";   
        } elseif(empty($password)){
			echo "<script>alert('password tidak boleh kosong );location.href='tambah_member.php';</script>";
		} else {
			include "../koneksi.php";
			
			$insert=mysqli_query($conn,"insert into member (NIP,nama,id_bagian,password) value ('".$NIP."','".$nama."','".$id_bagian."','".md5($password)."')");
			
			if($insert){
				echo "<script>alert('member berhasil di tambah ');location.href='../tampil_member.php';</script>";
			} else {
				echo "<script>alert('Gagal Menambah member ');location.href='tambah_member.php';</script>";
			
			}
		}
		
		
	}
?>