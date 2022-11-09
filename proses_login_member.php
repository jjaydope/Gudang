<?php
if ($_POST) {
    $NIP = $_POST['NIP'];
    $password = $_POST['password'];
    if (empty($NIP)) {
        echo "<script>alert('input NIP');location.href='login.member.php';</script>";
    } elseif (empty($password)) {
        echo "<script>alert('Password tidak boleh kosong');location.href='login.member.php';</script>";
    } else {
        include "koneksi.php";
        $qry_login = mysqli_query($conn, "select * from member where NIP = '" . $NIP . "' and password = '" . md5($password) . "'");
        if (mysqli_num_rows($qry_login) > 0) {
            $dt_login = mysqli_fetch_array($qry_login);
            session_start();
            $_SESSION['NIP'] = $dt_login['NIP'];
            $_SESSION['nama'] = $dt_login['nama'];
            $_SESSION['status_login'] = true;
            header("location: home.member.php");
        } else {
            echo "<script>alert('Username dan Password tidak benar');location.href='login.member.php';</script>";
        }
    }
}
