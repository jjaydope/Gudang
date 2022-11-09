<?php
 session_start();
if($_SESSION['status_login']!=true){
header('location: login.member.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
crossorigin="anonymous">
<title>Barang</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light"
style="box-shadow: 4px 4px 5px -4px;">
<div class="container-fluid">
<a class="navbar-brand" href="#">LAUNDRY</a>

<button class="navbar-toggler" type="button" data-bs-
toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"

aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link active" aria-current="page"
href="home.member.php">Home</a>
</li>

<li class="nav-item">
<a class="nav-link" aria-current="page" href="tampil_barang_member.php">Barang</a>
</li>
<li class="nav-item">
<a class="nav-link" aria-current="page" href="keranjang.php">Keranjang</a>
</li>
</br>
<a class="nav-link" aria-current="page" href="histori_transaksi.php">History</a>
</li>



<li class="nav-item">
<a class="nav-link" aria-current="page" href="logout.member.php">Logout</a>
</li>
</ul>
</div>
</div>
</nav>
<div class="container bg-light rounded" style="margin-top:10px">