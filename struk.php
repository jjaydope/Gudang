<html>
    <?php include "koneksi.php"
    ?>
<head>
<title>Faktur Pembayaran</title>
                        <style>
                        #tabel
                        {
                        font-size:15px;
                        border-collapse:collapse;
                        }
                        #tabel  td
                        {
                        padding-left:5px;
                        border: 1px solid black;
                        }
                        </style>
            </head>
             <!-- u/ muncul di halaman print -->
              <!--  <body style='font-family:tahoma; font-size:8pt;' onload="javascript:window.print()"> -->
<center>
<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
<span style='font-size:12pt'><b>Form Permintaan Barang</b></span></br>
where did you go? i should know, but its cold and i dont wanna be lonely so show me, you come home, i dont care if just a lie </br>
ilomilo
</td>

<td style='vertical-align:top' width='30%' align='left'>
<b><span style='font-size:12pt'>TRANSAKSI</span></b>
</br> Nomer Transaksi : </br>
Tanggal : </br>
</td>
</table>
<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='left' style='padding-right:80px; vertical-align:top'> Nama Petugas</br> Alamat : - </td>
<td style='vertical-align:top' width='30%' align='left'>
No Telp : -
</td>
</table>
<table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
        <thead>
            <tr align='center'>
                    <td width='7%'>Nomer</td>
                    <td width='10%'>Kode Barang</td>
                    <td width='20%'>Nama Barang</td>
                    <td width='13%'>Peminta</td>
                    <td width='4%'>Qty</td>
            </tr>
        </thead>
        <tbody>
                <?php 
                    include "koneksi.php";
                    $qry_paket=mysqli_query($conn,"select * from barang_masuk");
                    $no = 0;
                    while($data_paket=mysqli_fetch_array($qry_paket)){
                    $no++;
                ?>

            <tr>
                    <td><?=$no?></td>
                    <td><?=$data_paket['id_barang']?></td>
                    <td>                                   
                        <?php
                        include "koneksi.php";
                        $qry_get_barang=mysqli_query($conn, "select * from barang where id_barang='".$data_paket['id_barang']."'");
                        $data_barang = mysqli_fetch_array($qry_get_barang   );
                        echo $data_barang['nama_barang']; 
                    ?>
                    <!-- <?php echo $data_barang['id_barang']?> --></td>
                    <td><?=$data_paket['stok']?></td>
                    <td><?=$data_paket['stok']?></td>
            </tr>
                    </tbody>
                    <?php
                    }
                    ?>
                    
            <tr>

                    <th colspan = '6'><div style='text-align:right'>Total :</div></th>
                    

            </tr>
            <tr>
 
                    <table style='width:650; font-size:7pt;' cellspacing='2'>
            <tr>
                    <th align='center'>Diterima Oleh,</br></br>
                    <u>(............)</u>
                    </th>
                    <th style='border:1px solid black; padding:5px; text-align:left; width:30%'></th>
                    <th align='center'>TTD,</br></br> <u>(...........)</u>
                    </th>
            </tr>
            
</table>
</center>
</body>
</html>