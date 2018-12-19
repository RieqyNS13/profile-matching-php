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
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


	 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	 
	



	<script src="Chart.js/Chart.bundle.min.js"></script>
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
		$("#tabKriteria a.hapus").click(function(){
			var id=$(this).attr('data-id');
			$.getJSON('proses.php?getIdKriteria='+id,function(data){
				$("#modalHapus input[name='idHapus']").val(data.id_kriteria);
				$("#modalHapus input[name='aksi']").val("hapusKriteria");
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
				case "#tabHitung":
					localStorage.setItem("tabSekarang","#myTab a:eq(4)");
					break;
				default:
					localStorage.setItem("tabSekarang","#myTab a:eq(0)");
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
			$("#inputNilaiProfile").html("");
			var id_aspek=$(this).val();
			if(id_aspek==-1)return false;
			var table="";
			$.getJSON("proses.php?getAllKriteriaByIdAspek="+id_aspek, function(dataKriteria){
				var dataK=[];
				table="<tr><th>Alternatif/Kriteria</th>";
				$.each(dataKriteria.data, function(k,v){
					console.log(v.nama_kriteria);
					dataK.push(v.id); //id kriteria
					table+="<th>"+v.nama_kriteria+"</th>";
				});
				table+="</tr>";
				$("#inputNilaiProfile").append(table);
				table="";
				$.getJSON("proses.php?getAllDataAlternatif", function(dataAlternatif){
					$.each(dataAlternatif.data, function(k,v){
						table+="<tr class='nilai' data-alternatif="+v.id+"><td>"+v.nama_alternatif+"</td>";
						$.each(dataK, function(k2, v2){
							table+="<td><input data-kriteria="+v2+" type='number' class='form-control'></td>";
						});
						table+="</tr>";
					});
					$("#inputNilaiProfile").append(table);
					$.getJSON("proses.php?getAllProfile", function(dataProfile){
						$.each(dataProfile.data, function(k3, v3){
							$("tr[data-alternatif="+v3.id_alternatif+"] input[data-kriteria="+v3.id_kriteria+"]").val(v3.nilai_profile);
						});
					});
				});
				
			});
		});
		
		$("#tabNilaiProfil form").submit(function(e){
			e.preventDefault();
			var data=[];
			var tr=$("#inputNilaiProfile tr.nilai");
			var arr=[];
			$.each(tr, function(k){
				var id_alternatif=$(this).attr('data-alternatif');
				var nilai={id_alternatif:id_alternatif,dataKriteria:[],dataNilai:[]};
				var input=$(this).find("input");
				$.each(input, function(k2){
					nilai.dataKriteria.push($(this).attr('data-kriteria'));
					nilai.dataNilai.push($(this).val());
				});
				data.push(nilai);
				
			});
			$.ajax({
				url:'proses.php',
				type: "POST",
				dataType: "json",
				data:'aksi=inputNilaiProfil&data='+JSON.stringify(data)
			}).done(function(data){
				if(data.sukses){
					alert('Simpan data berhasil');
				}else if(data.error)alert(data.error);
				else alert('Error');
				window.location.reload();
			}).fail(function(jqXHR,error){
				alert(error);
			});
		});
		$("#tabHitung form").submit(function(e){
			e.preventDefault();
			
			$.get("hitung.php",function(data){
				$("#hitung").html(data);
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
  <li class="nav-item">
    <a class="nav-link" href="#tabHitung">Perhitungan</a>
  </li>
</ul>
</div>
 </div>
<div class="tab-content" id="myTabContent">
<!--Konten Alternatif-->

  <div class="tab-pane fade show active" id="tabAlternatif" role="tabpanel">
	<?php include "alternatif.php"; ?>
  </div>
  <!--End Alternatif-->
  <!--Aspek-->
  
  <div class="tab-pane fade" id="tabAspek" role="tabpanel" >
	<?php include "aspek.php"; ?>
    </div>
<!--End Aspek-->

<!--Mulai tab Kriteria-->
  <div class="tab-pane fade" id="tabKriteria" role="tabpanel" >
  <?php include "kriteria.php"; ?>
  </div>
 <!--end tab Kriteria--> 
  
  
 <!--Mulai tab Nilai-Profile-->
  <div class="tab-pane fade" id="tabNilaiProfil" role="tabpanel" >
  <?php include "profile.php"; ?>

  </div>
 <!--End tab Nilai-Profile-->
 
 <!--Mulai tabHitung-->
 <div class="tab-pane fade" id="tabHitung" role="tabpanel" >
  <div class="row">
	<div class="col-sm-6">
   <form class="spasiAtas" method="POST" >
  	   <button type="submit" name="hitung" class="btn btn-primary">Hitung</button>
	   </form>
	   </div><!--end div class=col-6-->
	   </div><!--end div class=row-->

	<div class="row">
 <div class="col-sm-12" id="hitung">
 
	</div><!--end col-sm-12-->
  </div><!--end row-->   
	   
  </div>
 <!--End tabHitung-->
 
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