<?php 
  if(cekOtorisasi($_SESSION["id_user"],9)){
	  ?>
  <div class="row">
  <div class="col-sm-6">
  <form class="spasiAtas" action="proses.php">
    <input type="hidden" name="aksi" value="tambahKriteria">
  <div class="form-group">
    <label>Pilih Aspek</label>
  <select name="id_aspek" class="form-control">
  <option value="-1">Pilih Aspek</option>
  <?php 
  $sql="select * from tbl_aspek order by id asc";
  $query=mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
  while($fetch=mysqli_fetch_object($query)){
	  echo "<option value='".$fetch->id."'>".$fetch->kode." - ".$fetch->nama_aspek."</option>";
  }
  ?>
  </select>
  </div>
   <div class="form-group">
    <label>Kode Kriteria</label>
   <input type="text" class="form-control" name="kode_kriteria" placeholder='AI1'>
  </div>
  <div class="form-group">
    <label>Nama Kriteria</label>
   <input type="text" class="form-control" name="nama_kriteria" placeholder='Kriteria Ke-1'> 
  </div>
  <div class="form-group">
    <label>Nilai (rentang 1-9)</label>
   <input type="number" class="form-control" name="nilai_kriteria" placeholder='5'> 
  </div>
   <div class="form-group">
    <label>Factor</label>
   <div class="form-check">
  <input class="form-check-input" type="radio" name="factor_kriteria" id="exampleRadios1" value="1" checked>
  <label class="form-check-label" for="exampleRadios1">
    Core
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="factor_kriteria" id="exampleRadios2" value="2">
  <label class="form-check-label" for="exampleRadios2">
    Secondary
  </label>
</div>
  </div>
  <input type="submit" class="btn btn-primary" value="Tambah">
  </form>
  </div>
 </div><!--end row-->
  <?php } 
  if(cekOtorisasi($_SESSION["id_user"],10)){
  ?>
 <div class="row">
 <div class="col-sm-12">
  <table class="table table-striped">
	<tr><th>#</th><th>Kode Kriteria</th><th>Aspek</th><th>Nama Kriteria</th><th>Nilai</th><th>Factor</th><th>Aksi</th></tr>
	<?php 
	$total=0;
	$i=0;
	$query=mysqli_query($koneksi,"select a.id as id_kriteria,a.id_aspek,a.kode as kode_kriteria,a.nama_kriteria,a.nilai,a.factor,b.kode as kode_aspek,b.nama_aspek from tbl_kriteria a inner join tbl_aspek b on a.id_aspek=b.id order by b.id, a.kode asc") or die(mysqli_error($koneksi));
	while($fetch=mysqli_fetch_array($query)){
		echo "<tr><td>".(++$i)."<td>".$fetch["kode_kriteria"]."</td><td>".$fetch["nama_aspek"]."</td><td>".$fetch["nama_kriteria"]."</td><td>".$fetch["nilai"]."</td><td>".($fetch["factor"]=='1'?"Core":"Secondary")."</td><td><a class='btn btn-warning edit' href='#' data-id='".$fetch["id_kriteria"]."'>Edit</a> | <a class='btn btn-danger hapus' href='#' data-id='".$fetch["id_kriteria"]."'>Hapus</a></td></tr>";
	} 
	?>
	</table>
	</div>
  </div><!--end row-->
  <?php } ?>