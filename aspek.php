<?php 
	if(cekOtorisasi($_SESSION["id_user"],5)){
?>
    <div class="row">
	<div class="col-sm-6">
   <form class="spasiAtas" action="proses.php">
    <input type="hidden" name="aksi" value="tambahAspek">
  <div class="form-group">
    <label>Kode Aspek</label>
   <input type="text" class="form-control" name="kodeAspek" placeholder='AI'>
  </div>
   <div class="form-group">
    <label>Nama Aspek</label>
   <input type="text" class="form-control" name="namaAspek" placeholder='Aspek KeVVibuan'>
  </div>
  <div class="form-group">
    <label>Persentase (%)</label>
   <input type="number" class="form-control" name="persentaseAspek" placeholder='40'> 
  </div>
  <input type="submit" class="btn btn-primary" value="Tambah">&nbsp;&nbsp;<input type="button" class="btn btn-info" value="Pie" data-toggle="modal" data-target="#pieAspekModal">
  </form>
  	</div>
	</div>
	
	<div class="modal fade" id="pieAspekModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pie chart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <canvas id="chart-area"></canvas>
        <script type="text/javascript">
		function getRandomInt(max) {
			return Math.floor(Math.random() * Math.floor(max));
		}
		$.getJSON("proses.php?getAllDataAspek", function(data2){
			console.log(data2);
		}).done(function(data2){
			var persentase=[];
			var warna=[];
			var label=[];
			$.each(data2.data,function(k,v){
				persentase.push(parseInt(v.persentase));
				warna.push("rgb("+getRandomInt(255)+","+getRandomInt(255)+","+getRandomInt(255)+")");
				label.push(v.nama_aspek);
				console.log(v.persentase);
			});
			//alert(persentase);
			var config = {
			type: 'pie',
			data: {
				datasets: [{
					data:persentase,
					backgroundColor: warna,
					label: 'Dataset 1'
					}],
					labels:label
					},
				options: {
					responsive: true
				}
			};
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		});
		
		</script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

	
<?php 
}

if(cekOtorisasi($_SESSION["id_user"],6)){
?>
  <div class="row">
  <div class="col-sm-12">
	<table class="table table-striped">
	<tr><th>#</th><th>Kode</th><th>Nama Aspek</th><th>Persentase</th><th>Aksi</th></tr>
	<?php 
	$total=0;
	$i=0;
	$query=mysqli_query($koneksi,"select * from tbl_aspek order by id asc") or die(mysqli_error($koneksi));
	while($fetch=mysqli_fetch_array($query)){
		echo "<tr><td>".(++$i)."</td><td>".$fetch["kode"]."</td><td>".$fetch["nama_aspek"]."</td><td>".$fetch["persentase"]."</td> <td><a class='btn btn-warning edit' href='#' data-id='".$fetch["id"]."'>Edit</a> | <a class='btn btn-danger hapus' href='#' data-id='".$fetch["id"]."'>Hapus</a></td></tr>";
		$total+=intval($fetch["persentase"]);
	} 
	if($total<100){
		?>
		<div class="alert alert-danger" role="alert">
			Jumlah persentase harus 100%, jumlah sekarang <?php echo $total; ?>%
		</div>
		<?php 
	}else{
		?>
		<div class="alert alert-primary" role="alert">
			Jumlah persentase sudah 100%
		</div>
		<?php
	}
	?>
	</table>
	</div>
	</div><!--end row-->
<?php 
}
?>