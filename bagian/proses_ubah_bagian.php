<?php
if($_POST){
    $id_bagian=$_POST['id_bagian'];
    $nama_bagian = $_POST ['nama_bagian'];
   

        if(empty($nama_bagian)){
            echo "<script>alert(' data harus diisi!');location.href='ubah_bagian.php?id_bagian=$id_bagian'</script>";
            } else {
            include "../koneksi.php";
            $query = "update bagian set nama_bagian='$nama_bagian' where id_bagian='$id_bagian'";
            $update=mysqli_query($conn,$query);
            if($update){
                echo "<script>alert('Sukses update bagian');location.href='../tampil_bagian.php';</script>";
            } else {
            echo "<script>alert('Gagal update bagian');location.href='ubah_bagian.php?id_bagian=".$id_bagian."';</script>";


            } 
        }
    }