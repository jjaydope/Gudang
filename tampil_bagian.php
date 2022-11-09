<?php include 'koneksi.php'; ?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
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
    <h3>Data bagian</h3>
  </div>
  <!--Panel Form pencarian -->
  <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading"><b>Pencarian</b></div>
        <div class="panel-body">
<form class="form-inline" >
  <div class="form-group">
    <select class="form-conntrol" id="Kolom" name="Kolom" required="">
      <?php
        $kolom=(isset($_GET['Kolom']))? $_GET['Kolom'] : "";
      ?>
		<option value="nama_bagian" <?php if ($kolom=="nama_bagian") echo "selected"; ?>>Bagian</option>
    </select>
  </div>
  <div class="form-group">
    <input type="text" class="form-conntrol" id="KataKunci" name="KataKunci" placeholder="Kata kunci.." required="" value="<?php if (isset($_GET['KataKunci']))  echo $_GET['KataKunci']; ?>">
  </div>
  <button type="submit" class="btn btn-primary">Cari</button>
  <a href="tampil_bagian.php" class="btn btn-danger">Reset</a>
</form> 
<table class="table table-striped table-bordered table-hover">
  <thead>
		 <tr>
		 	<th>NO</th>
			<th>Bagian</th>
			<th>Nama </th>
			<th>action</th>	
		 </tr>
		 </thead>
		 <?php 
				$page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
   
				$kolomCari=(isset($_GET['Kolom']))? $_GET['Kolom'] : "";
				
				$kolomKataKunci=(isset($_GET['KataKunci']))? $_GET['KataKunci'] : "";
 
				// Jumlah data per halaman
				$limit = 4;
				$limitStart = ($page - 1) * $limit;

				//kondisi jika parameter pencarian kosong
				if($kolomCari=="" && $kolomKataKunci==""){
					$data_bagian = mysqli_query($conn, "SELECT * FROM bagian LIMIT ".$limitStart.",".$limit);
				}else{
					//kondisi jika parameter kolom pencarian diisi
					$data_bagian = mysqli_query($conn, "SELECT * FROM bagian WHERE $kolomCari LIKE '%$kolomKataKunci%' LIMIT ".$limitStart.",".$limit);
				  }
				  $no = $limitStart + 1;

		 		while($d=mysqli_fetch_array($data_bagian)){
					?>
				<tr> 
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['nama_bagian']?></td>
					<td>
       					 <?php
                        include "koneksi.php";
                        $qry_get_member=mysqli_query($conn, "select * from member where id_bagian='".$d['id_bagian']."'");
                        $data_member = mysqli_fetch_array($qry_get_member  );
                        echo $data_member['nama']; 
                    ?>
                    <!-- <?=$d['nip']?> -->
               		 </td> 		
					<td>
			<a href="bagian/ubah_bagian.php?id_bagian=<?=$d['id_bagian']?>"
		class="btn btn-success">Ubah</a> | 
      		<a href="bagian/hapus_bagian.php?id_bagian=<?=$d['id_bagian']?>"
		onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger">Hapus</a>
			</td>		
     		</td>
		 </tr>
		 <?php
		 }
		 ?>
		 </tbody>
		</table>
		<a href="bagian/tambah_bagian.php"
                    class="btn btn-dark">Tambah bagian</a>
					<div align="right">
  <ul class="pagination">
    <?php
      // Jika page = 1, maka LinkPrev disable
      if($page == 1){ 
    ?>        
      <!-- link Previous Page disable --> 
      <li class="disabled"><a href="#">Previous</a></li>
    <?php
      }
      else{ 
        $LinkPrev = ($page > 1)? $page - 1 : 1;  

        if($kolomCari=="" && $kolomKataKunci==""){
        ?>
          <li><a href="tampil_bagian.php?page=<?php echo $LinkPrev; ?>">Previous</a></li>
     <?php     
        }else{
      ?> 
        <li><a href="tampil_bagian.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $LinkPrev;?>">Previous</a></li>
       <?php
         } 
      }
    ?>
	<?php
      //kondisi jika parameter pencarian kosong
      if($kolomCari=="" && $kolomKataKunci==""){
        $data_bagian = mysqli_query($conn, "SELECT * FROM bagian");
      }else{
        //kondisi jika parameter kolom pencarian diisi
        $data_bagian = mysqli_query($conn, "SELECT * FROM bagian WHERE $kolomCari LIKE '%$kolomKataKunci%'");
      }     
    
      //Hitung semua jumlah data yang berada pada tabel Sisawa
      $JumlahData = mysqli_num_rows($data_bagian);
      
      // Hitung jumlah halaman yang tersedia
      $jumlahPage = ceil($JumlahData / $limit); 
      
      // Jumlah link number 
      $jumlahNumber = 1; 

      // Untuk awal link number
      $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1; 
      
      // Untuk akhir link number
      $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage; 
      
      for($i = $startNumber; $i <= $endNumber; $i++){
        $linkActive = ($page == $i)? ' class="active"' : '';

        if($kolomCari=="" && $kolomKataKunci==""){
    ?>
        <li<?php echo $linkActive; ?>><a href="tampil_bagian.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

    <?php
      }else{
        ?>
        <li<?php echo $linkActive; ?>><a href="tampil_bagian.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
     if($kolomCari=="" && $kolomKataKunci==""){
        ?>
          <li><a href="tampil_bagian.php?page=<?php echo $linkNext; ?>">Next</a></li>
     <?php     
        }else{
      ?> 
         <li><a href="tampil_bagian.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $linkNext; ?>">Next</a></li>
    <?php
      }
    }
    ?>
  </ul>
</div>
</body>
</html>