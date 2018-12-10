<?php 
session_start();
if(!isset($_SESSION["role"]) || !isset($_SESSION["username"])){
	header("Location: login.php");
	exit();
}
require_once "koneksi.php";
require_once "otorisasi.php";
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" crossorigin="anonymous">
	 <script src="js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>-->
    <script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>
	<script src="Chart.js/Chart.bundle.js"></script>
	<script src="Chart.js/samples/utils.js"></script>
	<style type="text/css">
	.spasiAtas{
		padding-top: 20px;
	}
	</style>
	<script type="text/javascript">
	$(function(){
		$("#tabNilaiProfil select[name='id_kriteria']").prop("disabled",true);
		//$("#tabNilaiProfil button[type='submit']").prop("disabled",true);
		$("#tabAlternatif a.edit").click(function(){
			var id=$(this).attr('data-id');
			$.getJSON('proses.php?getIdAlternatif='+id,function(data){
				$("#modalEditAlternatif input[name='kode']").val(data.kode);
				$("#modalEditAlternatif input[name='old_kode']").val(data.kode);
				$("#modalEditAlternatif input[name='nama_alternatif']").val(data.nama_alternatif);
				$("#modalEditAlternatif input[name='persentase']").val(data.persentase);
				$("#modalEditAlternatif input[name='Id']").val(data.id);
				$("#modalEditAlternatif").modal('show');

			}).fail(function(){
				alert('Gagal');
			});
			//alert($(this).attr('data-id'));
		});
		$("#tabAspek a.edit").click(function(){
			var id=$(this).attr('data-id');
			$.getJSON('proses.php?getIdAspek='+id,function(data){
				$("#modalEditAspek input[name='kode']").val(data.kode);
				$("#modalEditAspek input[name='old_kode']").val(data.kode);
				$("#modalEditAspek input[name='nama_aspek']").val(data.nama_aspek);
				$("#modalEditAspek input[name='persentase']").val(data.persentase);
				$("#modalEditAspek input[name='Id']").val(data.id);
				$("#modalEditAspek").modal('show');

			}).fail(function(){
				alert('Gagal');
			});
			//alert($(this).attr('data-id'));
		});
		$("#tabKriteria a.edit").click(function(){
			var id=$(this).attr('data-id');
			$.getJSON('proses.php?getIdKriteria='+id,function(data){
				$("#modalEditKriteria input[name='kode_kriteria']").val(data.kode_kriteria);
				$("#modalEditKriteria input[name='old_kode']").val(data.kode_kriteria);
				$("#modalEditKriteria input[name='nama_kriteria']").val(data.nama_kriteria);
				$("#modalEditKriteria input[name='nilai_kriteria']").val(data.nilai);
				$("#modalEditKriteria input[name='Id']").val(data.id_kriteria);
				$("#modalEditKriteria select[name='id_aspek']").val(data.id_aspek);
				if(data.factor=='1'){
					$("#modalEditKriteria input[name='factor_kriteria']:eq(0)").prop("checked",true);
				}else{
					$("#modalEditKriteria input[name='factor_kriteria']:eq(1)").prop("checked",true);
				}
				$("#modalEditKriteria").modal('show');

			}).fail(function(){
				alert('Gagal');
			});
			//alert($(this).attr('data-id'));
		});
		$("#tabAlternatif a.hapus").click(function(){
			var id=$(this).attr('data-id');
			$.getJSON('proses.php?getIdAlternatif='+id,function(data){
				$("#modalHapus input[name='idHapus']").val(data.id);
				$("#modalHapus input[name='aksi']").val("hapusAlternatif");
				$("#modalHapus").modal('show');
			}).fail(function(){
				alert('Gagal');
			});
			//
		});
		$("#tabAspek a.hapus").click(function(){
			var id=$(this).attr('data-id');
			$.getJSON('proses.php?getIdAspek='+id,function(data){
				$("#modalHapus input[name='idHapus']").val(data.id);
				$("#modalHapus input[name='aksi']").val("hapusAspek");
				$("#modalHapus").modal('show');
			}).fail(function(){
				alert('Gagal');
			});
			//
		});
		$('#myTab a').on('click', function (e) {
			e.preventDefault();
			var tab=$(this).attr('href');
			switch(tab){
				case "#tabAlternatif":
					localStorage.setItem("tabSekarang","#myTab a:eq(0)");
					break;
				case "#tabAspek":
					localStorage.setItem("tabSekarang","#myTab a:eq(1)");
					break;
				case "#tabKriteria":
					localStorage.setItem("tabSekarang","#myTab a:eq(2)");
					break;
				case "#tabNilaiProfil":
					localStorage.setItem("tabSekarang","#myTab a:eq(3)");
					break;
				default:
					localStorage.setItem("tabSekarang","#myTab a:eq(4)");
					break;
			}
			$(this).tab('show');
			//alert('sd');
		});
		$("#tabAlternatif form, #modalEditAlternatif form, #tabAspek form, #modalEditAspek form, #tabKriteria form, #modalEditKriteria form").submit(function(e){
			e.preventDefault();
			var data=$(this).serialize();
			$.ajax({
				url:'proses.php',
				method:'POST',
				dataType:'json',
				beforeSend:function(){
					$("input, button").prop("disabled",true);
				},
				data:data
			}).fail(function(){
				alert('Error');
				$("input, button").prop("disabled",false);
			}).done(function(data){
				if(data.sukses){
					alert(data.sukses);
					window.location.reload();
				}else if(data.error){
					alert('Error: '+data.error);
				}else{
					alert('Error tidak diketahui');
				}
				$("input, button").prop("disabled",false);
			});
		});
		$("#modalHapus form").submit(function(e){
			e.preventDefault();
			var data=$(this).serialize();
			//alert(data);
			$.ajax({
				url:'proses.php',
				dataType:'json',
				method:'POST',
				data:data,
				beforeSend:function(){
					$("input, button").prop("disabled",true);
				}
			}).done(function(data){
				if(data.sukses){
					alert(data.sukses);
					window.location.reload();
				}else if(data.error){
					alert('Error: '+data.error);
				}else{
					alert('Error tidak diketahui');
				}
				$("input, button").prop("disabled",false);
			});
		});
		$("#tabKriteria select[name='id_aspek']").change(function(){
			var val=$(this).val();
			var text=$(this).find("option:selected").text();
			console.log(text);
			if(val==-1){
				$("#tabKriteria input").prop('disabled',true);
			}else{
				var x=text.split("-");
				var x2=x[0].trim();
				$("#tabKriteria input[name='kode_kriteria']").val(x2+"1");
				$("#tabKriteria input").prop('disabled',false);
				
			}
		}).change();
		$("#tabNilaiProfil select[name='id_aspek']").change(function(){
			console.log($(this).val());
			var data='getKriteriaByIdAspek='+$(this).val();
			var x=$("#tabNilaiProfil select[name='id_kriteria']");
			if($(this).val()>-1){
				$.ajax({
					url:'proses.php',
					dataType:'json',
					method:'GET',
					data:data,
					beforeSend:function(){
						$("#tabNilaiProfil input, #tabNilaiProfil select").prop("disabled",false);
					}
				}).done(function(data){
					if(data.sukses){
						//alert(data.sukses);
						//window.location.reload();
						var html="<option value='-1'>Pilih Kriteria</option>";
						$.each(data.sukses, function(k,v){
							html+="<option value='"+v.id+"'>"+v.kode+" - " +v.nama_kriteria+"</option>";
						});
						$("#tabNilaiProfil select[name='id_kriteria']").html(html);
						
					}else if(data.error){
						alert('Error: '+data.error);
					}else{
						alert('Error tidak diketahui');
					}
					$("#tabNilaiProfil input, #tabNilaiProfil select").prop("disabled",false);
				});
			}else{
				$("#tabNilaiProfil select[name='id_kriteria']").prop("disabled",true);
				$("#tabNilaiProfil select[name='id_kriteria']").html("<option value='-1'>Pilih Kriteria</option>");
			}
		});
		$("#tabNilaiProfil select[name='id_kriteria']").change(function(){
			$.getJSON("proses.php?getAllDataAlternatif",function(dataAlternatif){
				var 
			});
		});
	
	});

	</script>
    <title>Profile Matching</title>
  </head>
  <body>
  <div class="container">
  <div class="row" style="padding-top: 25px;">
    <div class="col-sm-8">
     <ul class="nav nav-tabs" id="myTab">
  <li class="nav-item">
    <a class="nav-link active" href="#tabAlternatif">Alternatif</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#tabAspek">Aspek</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#tabKriteria">Kriteria</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#tabNilaiProfil">Nilai Profile</a>
  </li>
</ul>
</div>
 </div>
<div class="tab-content" id="myTabContent">
<!--Konten Alternatif-->

  <div class="tab-pane fade show active" id="tabAlternatif" role="tabpanel">
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
  </div>
  <!--End Alternatif-->
  <!--Aspek-->
  
  <div class="tab-pane fade" id="tabAspek" role="tabpanel" >
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
		var randomScalingFactor = function() {
			return Math.round(Math.random() * 100);
		};
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
    </div>
<!--End Aspek-->

<!--Mulai tab Kriteria-->
  <div class="tab-pane fade" id="tabKriteria" role="tabpanel" >
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
  </div>
 <!--end tab Kriteria--> 
  
  
 <!--Mulai tab Nilai-Profile-->
  <div class="tab-pane fade" id="tabNilaiProfil" role="tabpanel" >
  <div class="row">
	<div class="col-sm-6">
   <form class="spasiAtas" action="proses.php">
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
 
  <div class="form-group">
    <label>Pilih Kriteria</label>
  <select name="id_kriteria" class="form-control">
  <option value="-1">Pilih Kriteria</option>
  
  </select>
  </div>
  <table class="table table-striped" id="inputNilaiProfile">
  
  </table>
  
 
  
  	   <button type="submit" class="btn btn-primary">Tambah</button>
	   </form>
	   </div><!--end div class=col-6-->
	   </div><!--end div class=row-->

  </div>
 <!--End tab Nilai-Profile-->
</div>
    
 
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  
<!--modal edit alternatif-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditAlternatif">
  <div class="modal-dialog">
    <div class="modal-content">
	
	 <form>
	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Alternatif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <input type="hidden" name="aksi" value="editAlternatif">
	  <div class="modal-body">
        
			<input type="hidden" class="Id" name="Id">
			<input type="hidden" name="old_kode">
          <div class="form-group">
            <label for="nama" class="col-form-label">Kode Alternatif</label>
            <input type="text" name="kode" class="form-control" id="tblAlternatif_kode_edit">
          </div>
          <div class="form-group">
            <label for="kode" class="col-form-label">Nama Alternatif</label>
             <input type="text" name="nama_alternatif" class="form-control" id="tblAlternatif_nama_edit">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
	  </form>
	
	</div>
	</div>
	</div>
<!--end modal edit Alternatif-->

<!--modal edit Aspek-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditAspek">
  <div class="modal-dialog">
    <div class="modal-content">
	
	 <form>
	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Aspek</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <input type="hidden" name="aksi" value="editAspek">
	  <div class="modal-body">
        
			<input type="hidden" class="Id" name="Id">
			<input type="hidden" name="old_kode">
          <div class="form-group">
            <label for="nama" class="col-form-label">Kode Aspek:</label>
            <input type="text" name="kode" class="form-control">
          </div>
          <div class="form-group">
            <label for="kode" class="col-form-label">Nama Aspek:</label>
             <input type="text" name="nama_aspek" class="form-control">
          </div>
		   <div class="form-group">
			<label>Persentase (%)</label>
		   <input type="number" class="form-control" name="persentase"> 
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
	  </form>
	
	</div>
	</div>
	</div>
<!--end modal edit Aspek-->


<!--modal edit Kriteria-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditKriteria">
  <div class="modal-dialog">
    <div class="modal-content">
	
	 <form>
	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <input type="hidden" name="aksi" value="editKriteria">
	  <div class="modal-body">
        
			<input type="hidden" class="Id" name="Id">
			<input type="hidden" name="old_kode">
          <div class="form-group">
            <label for="nama" class="col-form-label">Pilih Aspek</label>
             <select name="id_aspek" class="form-control">
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
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
	  </form>
	
	</div>
	</div>
	</div>
<!--end modal edit Kriteria-->
  
  <!--Modal hapus-->
  <div class="modal fade bd-example-modal-sm" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
	<form>
	<input type="hidden" name="idHapus">
	<input type="hidden" name="aksi">
	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	
	<div class="modal-body">
	Hapus Data ?
	</div>
	
	 <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-primary">Hapus Data</button>
      </div>
	
     </form>
    </div>
  </div>
	</div>
	 <!--End modal hapus-->
  
  
  </body>
  
  <script type="text/javascript">
  
  if(localStorage.getItem("tabSekarang")!=null)
	$(localStorage.getItem("tabSekarang")).tab('show');
  </script>
  
</html>