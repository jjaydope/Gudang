<?php
// session_start();

//Auth Check
if (isset($_SESSION['id_petugas'])) {
    if ($_SESSION['role'] == 2) {
        //redirect ke halaman kasir.php
        header('Location:kasir.php');
    }
} else {
    $_SESSION['error'] = 'Anda harus login dahulu';
    header('location:loginpetugas.php');
}
