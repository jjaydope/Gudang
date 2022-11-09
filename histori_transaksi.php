<?php
include "header_member.php";
?>
        <!DOCTYPE html>
        <html>
        <head>
	    <title>Grafik Barang</title>
	  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        </head>
        <body>
            <h2>Histori Permintaan Barang</h2>
            <!-- form filter data berdasarkan range tanggal  -->
            <form action="histori_transaksi.php" method="get">
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
                        <a href="histori_transaksi.php" class="btn btn-danger">Reset</a>
                    </div>
                </div>
            </form>
            <table class="table table-hover table-striped">
                        <thead>
                        <th>NO</th>
                        <th>Tanggal </th>
                        <th>Nama Barang</th>
                        </thead>
                        <tbody>
        <?php
            include "koneksi.php";
            
                $batas = 5;
				$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
				$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
 
				$previous = $halaman - 1;
				$next = $halaman + 1;
                //jika tanggal dari dan tanggal ke ada maka
                if(isset($_GET['dari']) && isset($_GET['ke'])){
                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                    $data = mysqli_query($conn, "select * from transaksi order by id_transaksi desc WHERE tgl BETWEEN '".$_GET['dari']."' and '".$_GET['ke']."'");
                }else{
                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                    $data=mysqli_query($conn,"select * from transaksi order by id_transaksi desc ");
                }
              
                $jumlah_data = mysqli_num_rows($data);
                
				$total_halaman = ceil($jumlah_data / $batas);
                $qry_histori = mysqli_query($conn,"select * from transaksi order by id_transaksi limit $halaman_awal, $batas");
                $no = $halaman_awal+1;
                while($dt_histori=mysqli_fetch_array($qry_histori)){
               
            //menampilkan barang yang diminta
            $barang_diminta="<ol>";
            $qry_barang=mysqli_query($conn,"select * from detail_transaksi join barang on barang.id_barang=detail_transaksi.id_barang where id_transaksi ='".$dt_histori['id_transaksi']."'");
            while($dt_barang=mysqli_fetch_array($qry_barang)){
            $barang_diminta.="<li>".$dt_barang['nama_barang']."</li>";
            }

        ?>
            <tr>
                <td><?php echo$no++?></td>
                <td><?php echo$dt_histori['tgl']?></td>
                <td><?php echo$barang_diminta?></td>
            </tr>
        <?php
            }
        ?>
        </tbody>
        </table>
		<nav>
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
				</li>
                <?php
             ?>
			</ul>
		</nav>
	</div>
    
</body>
</html>

