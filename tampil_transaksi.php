<?php
include 'koneksi.php';
include "header.php";
if ($_SESSION['role']=="owner") {
    echo "<script>location.href='home.php';</script>";
}
?>
  <!DOCTYPE html>
  <html>
  <head>
  <title>barang|Gudang</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- css bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  </head>
  <body>
  <div class="container">
    <div align="center">
    <h3>Laporan Transaksi</h3>
    </div>
    <!-- form filter data berdasarkan range tanggal  -->
  <form action="tampil_transaksi.php" method="get">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label class="col-form-label">Periode</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" class="form-control" name="dari" required>
                    </div>
                    <div class="col-auto">
                        -
                    </div>
                    <div class="col-auto">
                        <input type="date" class="form-control" name="ke" required>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit">Cari</button>
                        <a href="tampil_transaksi.php" class="btn btn-danger">Reset</a>
                    </div>
                </div>              
            </form>
            <br/>
            <table class="table table-striped table-bordered table-hover">
              
  <thead>
                <tr>
                    <th>NO</th>
                    <th>PETUGAS</th>
                    <th>MEMBER</th>
                    <th>TANGGAL</th>
                    <th>BARANG</th>
                    <th>TOTAL</th>
                    <th>Print form</th>
                    </tr>
            </thead>
            <tbody>
                <?php
                
               
               $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
               $dari = (isset($_GET['dari']))? $_GET['dari'] : "";
               $ke = (isset($_GET['ke']))? $_GET['ke'] : "";


               $limit = 5;
               $limitStart = ($page - 1) * $limit;	


               if(isset($_GET['dari']) && isset($_GET['ke'])){
                $data = mysqli_query($conn, "SELECT t.id_transaksi as t_id, m.nama as nama_member, t.tgl,  p.nama_petugas as nama_kasir FROM transaksi t, member m, petugas p WHERE t.NIP = m.NIP AND t.id_petugas = p.id_petugas AND t.tgl BETWEEN  '".$_GET['dari']."' AND '".$_GET['ke']."' order by tgl LIMIT ".$limitStart.",".$limit);
                // echo "SELECT t.id_transaksi as t_id, m.nama as nama_member, t.tgl, t.batas_waktu, t.tgl_bayar, t.status, t.dibayar, u.nama as nama_kasir FROM transaksi t, member m, user u WHERE t.id_member = m.id_member AND t.id_user = u.id_user";
               }
               else {
                $data=mysqli_query($conn,"SELECT t.id_transaksi as t_id, m.nama as nama_member, t.tgl,  p.nama_petugas as nama_kasir FROM transaksi t, member m, petugas p WHERE t.NIP = m.NIP AND t.id_petugas = p.id_petugas LIMIT ".$limitStart.",".$limit);
               }
          // $qry_transaksi=mysqli_query($conn,"SELECT t.id_transaksi as t_id, m.nama as nama_member, t.tgl,  p.nama_petugas as nama_kasir FROM transaksi t, member m, petugas p WHERE t.NIP = m.NIP AND t.id_petugas = p.id_petugas order by tgl limit $halaman_awal, $batas");
                $no = $limitStart + 1;

                while($data_transaksi=mysqli_fetch_array($data)){
                    $qry_dtl_transaksi = mysqli_query($conn, "SELECT *, qty  FROM detail_transaksi, barang WHERE id_transaksi = ".$data_transaksi['t_id']." AND barang.id_barang = detail_transaksi.id_barang");
                //    echo "SELECT *, qty * harga as total FROM detail_transaksi, paket WHERE id_transaksi = ".$data_transaksi['t_id']." AND paket.id_paket = detil_transaksi.id_paket";
                    $no;
                    
                    $i = 0;
                    while ($data_dtl_transaksi = mysqli_fetch_assoc($qry_dtl_transaksi)) {
                        $i++;
                        if ($i == 1) {
                        ?>
                       
                            <tr>
                                <td><?php echo $no++?></td>
                                <td><?php echo $data_transaksi['nama_kasir']?> </td>
                                <td><?php echo $data_transaksi['nama_member']?> </td>
                                <td>
                                    <?php echo date('d-M-Y', strtotime($data_transaksi['tgl']))?>
                                </td>

                                <td>
                        <?php
                        include "koneksi.php";
                        $qry_get_barang=mysqli_query($conn, "select * from barang where id_barang='".$data_dtl_transaksi['id_barang']."'");
                        $data_barang = mysqli_fetch_array($qry_get_barang   );
                        echo $data_barang['nama_barang']; 
                    ?>
                    <!-- <?php echo $data_barang['id_barang']?> --></td>

                                <td><?=$data_dtl_transaksi['qty']?></td>

                                <td><a href="cetak_form.php?id_transaksi=<?=$data_dtl_transaksi['id_transaksi']?>"
		                            onclick="return confirm('cetak form?')" class="btn btn-warning">Print</a> | 
                                <a href="transaksi/hapus_transaksi.php?id_transaksi=<?=$data_dtl_transaksi['id_transaksi']?>"
		                            onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger">Hapus</a></td>
                                </td>
    
                            </tr> 
                        <?php
                        } else {
                        ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php
                        include "koneksi.php";
                        $qry_get_barang=mysqli_query($conn, "select * from barang where id_barang='".$data_dtl_transaksi['id_barang']."'");
                        $data_barang = mysqli_fetch_array($qry_get_barang   );
                        echo $data_barang['nama_barang']; 
                    ?>
                    <!-- <?=$data_barang['id_barang']?> --> </td>
                                <td><?=$data_dtl_transaksi['qty']?></td>
                                
                                
                            </tr> 
                        <?php
                        }
                        
                    }
                    ?>
                    <?php
                }
                ?>
            </tbody>
             <h5>Periode : <?php echo $dari;?> s.d. <?php echo $ke;?> </h5>
            </table>
            <a href="tambah_transaksi.php?total_pckg=1" class="btn btn-info">Tambah</a>
            <nav>
			<div align="right">
  <ul class="pagination">
    <?php
     // Jika page = 1, maka prev disable
     if($page == 1){ 
      ?>        
        <!-- link Previous Page disable --> 
        <li class="disabled"><a href="#">Previous</a></li>
      <?php
        }
        else{ 
          $prev = ($page > 1)? $page - 1 : 1;  
  
          if($dari == "" && $ke == ""){
          ?>
            <li><a href="tampil_transaksi.php?page=<?php echo $prev; ?>">Previous</a></li>
       <?php     
          }else{
        ?> 
          <li><a href="tampil_transaksi.php?dari=<?php echo $dari;?>&ke=<?php echo $ke;?>&page=<?php echo $prev;?>">Previous</a></li>

         <?php
           } 
        }
      ?>
    <?php
        //kondisi jika parameter pencarian kosong
       if(isset($_GET['dari']) && isset($_GET['ke'])){
        $data = mysqli_query($conn,  "SELECT t.id_transaksi as t_id, m.nama as nama_member, t.tgl,  p.nama_petugas as nama_kasir FROM transaksi t, member m, petugas p WHERE t.NIP = m.NIP AND t.id_petugas = p.id_petugas AND  t.tgl BETWEEN '".$_GET['dari']."' and '".$_GET['ke']."'");
        }else{
          //kondisi jika parameter kolom pencarian diisi
          $data = mysqli_query($conn, "SELECT t.id_transaksi as t_id, m.nama as nama_member, t.tgl,  p.nama_petugas as nama_kasir FROM transaksi t, member m, petugas p WHERE t.NIP = m.NIP AND t.id_petugas = p.id_petugas");
        }     
      
        //Hitung semua jumlah data yang berada pada tabel Sisawa
        $JumlahData = mysqli_num_rows($data);
        
        // Hitung jumlah halaman yang tersedia
        $jumlahPage = ceil($JumlahData / $limit); 
        
        // Jumlah link number 
        $jumlahNumber = 1; 
  
        // Untuk awal link number
        $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1; 
        
        // Untuk akhir link number
        $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage; 
        
        for($g = $startNumber; $g <= $endNumber; $g++){
          $linkActive = ($page == $g)? ' class="active"' : '';

            if($dari == "" && $ke == ""){
      ?>
          <li<?php echo $linkActive; ?>><a href="tampil_transaksi.php?page=<?php echo $g; ?>"><?php echo $g; ?></a></li>
  
      <?php
        }else{
          ?>          
          <li<?php echo $linkActive; ?>><a href="tampil_transaksi.php?dari=<?php echo $dari;?>&ke<?php echo $ke;?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php
        }
      }
      ?>
      
      <!-- link Next Page -->
      <?php       
       if($page == $jumlahPage){ 
      ?>
        <li class="disabled"><a href="#">Next</a></li>
      <?php
      }
      else{
        $linkNext = ($page < $jumlahPage)? $page + 1 : $jumlahPage;
        if($dari == "" && $ke == ""){
          ?>
            <li><a href="tampil_transaksi.php?page=<?php echo $linkNext; ?>">Next</a></li>
       <?php     
          }else{
        ?> 
           <li><a href="tampil_transaksi.php?dari=<?php echo $dari;?>&ke=<?php echo $ke;?>&page=<?php echo $linkNext; ?>">Next</a></li>
      <?php
        }
      }
      ?>
    </ul>
  </div>
  </body>
  </html>