<?php
    if($_POST){
        // detail transaction
        $qty = $_POST['qty'];
        $barang = $_POST['id_barang'];

        // transanction
       // $petugas = $_POST['petugas'];
        $member = $_POST['member'];
        $date = date('Y-m-d');

        // session login petugas
            session_start();
            $petugas = $_SESSION['id_petugas'];

    

        include ("../koneksi.php");

        if(empty($member) || empty($date)){
            echo "<script>alert('Harap semua data diisi dengan benar!');location.href='tambah_transaksi.php?total_pckg=1';</script>";

        } else {
            $insert_transaction = mysqli_query($conn,"insert into transaksi (id_petugas,NIP,tgl) value ('".$petugas."','".$member."','".$date."')");
            

        }

        $id_transaction = mysqli_insert_id($conn);

        for($i=0; $i<count($qty); $i++){
            $insert_dtl_transaction = mysqli_query($conn,"insert into detail_transaksi (id_transaksi, id_barang, qty,tgl) value ('".$id_transaction."','".$barang[$i]."','".$qty[$i]."','".$date."')");
            // echo "insert into detail_transaksi (id_transaksi, id_paket, qty) value ('".$id_transaction."','".$type[$i]."','".$qty[$i]."')";
        }

        if($insert_dtl_transaction){
            echo "<script>alert('Transaksi Sukses!');location.href='../tampil_transaksi.php';</script>";
        } else {
            echo "<script>alert('Transaksi Gagal! silakan coba kembali!');location.href='tambah_transaksi.php?total_pckg=1';</script>";
        }
    }
?>