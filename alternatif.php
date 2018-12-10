 <?php 
	if(cekOtorisasi($_SESSION["id_user"],1)){
	?>
  <div class="row">
  <div class="col-sm-6">
  <form class="spasiAtas" action="proses.php">
    <input type="hidden" name="aksi" value="tambahAlternatif">
  <div class="form-group">
    <label>Masukkan Kode Alternatif</label>
   <input type="text" class="form-control" name="kodeAlternatif" placeholder='Kode1'>
  </div>
   <div class="form-group">
    <label>Masukkan Nama Alternatif</label>
   <input type="text" class="form-control" name="namaAlternatif" placeholder='Rieqy Muwachid Erysya'>
  </div>
  <input type="submit" class="btn btn-primary" value="Tambah">&nbsp;&nbsp;<a href='cetak1.php'><input type="button" class="btn btn-info" value="Cetak pdf"></a>
  </form>
  </div>
  </div>
  <?php 
	}
  //1 adalah kode untuk read_alternatif
	if(cekOtorisasi($_SESSION["id_user"],2)){
  ?>
  <div class="row">
  <div class="col-sm-8">
	<table class="table table-striped">
	
	<tr><th>#</th><th>Kode</th><th>Nama Alternatif</th><th>Aksi</th></tr>
	<?php 
	$i=0;
	$query=mysqli_query($koneksi,"select * from tbl_alternatif order by id asc") or die(mysqli_error($koneksi));
	while($fetch=mysqli_fetch_array($query)){
		echo "<tr><td>".(++$i)."</td><td>".$fetch["kode"]."</td><td>".$fetch["nama_alternatif"]."</td><td><a class='btn btn-warning edit' href='#' data-id='".$fetch["id"]."'>Edit</a> | <a class='btn btn-danger hapus' href='#' data-id='".$fetch["id"]."'>Hapus</a></td></tr>";
	} 
	?>
	</table>
	</div>
	</div>
	<?php 
	}
	
	?>