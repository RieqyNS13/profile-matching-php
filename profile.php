<div class="row">
	<div class="col-sm-6">
   <form class="spasiAtas" >
    <input type="hidden" value="4" name="tipe">
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
 

  <table class="table table-striped" id="inputNilaiProfile">
  <!--RieqyNS13 Was Here-->
  </table> 
  	   <button type="submit" class="btn btn-primary">Simpan</button>
	   </form>
	   </div><!--end div class=col-6-->
	   </div><!--end div class=row-->