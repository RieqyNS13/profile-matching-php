<?php 
session_start();
require_once "koneksi.php";
require_once "Otorisasi.php";
if(isset($_GET["getIdAlternatif"])){
	$id=mysqli_real_escape_string($koneksi, trim($_GET["getIdAlternatif"]));
	$sql="select * from tbl_alternatif where id='".$id."'";
	$query=mysqli_query($koneksi, $sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
	$fetch=mysqli_fetch_object($query);
	echo json_encode($fetch);
}
if(isset($_GET["getIdAspek"])){
	$id=mysqli_real_escape_string($koneksi, trim($_GET["getIdAspek"]));
	$sql="select * from `tbl_aspek` where id='".$id."'";
	$query=mysqli_query($koneksi, $sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
	$fetch=mysqli_fetch_object($query);
	echo json_encode($fetch);
}
if(isset($_GET["getIdKriteria"])){
	$id=mysqli_real_escape_string($koneksi, trim($_GET["getIdKriteria"]));
	$sql="select a.id as id_kriteria,a.id_aspek,a.kode as kode_kriteria,a.nama_kriteria,a.nilai,a.factor,b.id as id_aspek,b.kode as kode_aspek,b.nama_aspek from tbl_kriteria a inner join tbl_aspek b on a.id_aspek=b.id where a.id='".$id."'";
	$query=mysqli_query($koneksi, $sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
	$fetch=mysqli_fetch_object($query);
	echo json_encode($fetch);
}
if(isset($_GET["getKriteriaByIdAspek"])){
	$id=mysqli_real_escape_string($koneksi, trim($_GET["getKriteriaByIdAspek"]));
	$sql="select * from tbl_kriteria where id_aspek='".$id."'";
	$query=mysqli_query($koneksi, $sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
	$data=array();
	while($fetch=mysqli_fetch_object($query)){
		array_push($data,$fetch);
	}
	
	echo json_encode(array("sukses"=>$data));
}
if(isset($_GET["getAllDataAspek"])){
		
	$sql="select * from tbl_aspek";
	$query=mysqli_query($koneksi, $sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
	$data=array();
	while($fetch=mysqli_fetch_object($query)){
		array_push($data,$fetch);
	}
	
	echo json_encode(array("data"=>$data));
}

if(isset($_GET["getAllDataAlternatif"])){
		
	$sql="select * from tbl_alternatif";
	$query=mysqli_query($koneksi, $sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
	$data=array();
	while($fetch=mysqli_fetch_object($query)){
		array_push($data,$fetch);
	}
	
	echo json_encode(array("data"=>$data));
}
if(isset($_GET["getAllProfile"])){
	$sql="SELECT a.id,a.id_alternatif,c.nama_alternatif,a.id_kriteria,b.nama_kriteria,b.id_aspek,d.nama_aspek,a.nilai_profile FROM tbl_profile a inner join tbl_kriteria b on a.id_kriteria=b.id inner join tbl_alternatif c on a.id_alternatif=c.id inner join tbl_aspek d on d.id=b.id_aspek";
	$query=mysqli_query($koneksi, $sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
	$data=array();
	while($fetch=mysqli_fetch_object($query)){
		array_push($data,$fetch);
	}
	
	echo json_encode(array("data"=>$data));
}

if(isset($_GET["getAllKriteriaByIdAspek"])){
	$id_aspek=mysqli_real_escape_string($koneksi, trim($_GET["getAllKriteriaByIdAspek"]));
	$sql="select * from tbl_kriteria where id_aspek='$id_aspek' order by id";
	$query=mysqli_query($koneksi,$sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
	$data=array();
	while($fetch=mysqli_fetch_object($query)){
		array_push($data,$fetch);
	}
	
	echo json_encode(array("data"=>$data));
}

function cekIssetPost($post){
	$gay=true;
	foreach($post as $njir)
		$gay = $gay && isset($_POST[$njir]);
	return $gay;
}
function cekKosong($post){
	$gay=true;
	foreach($post as $njir)
		$gay = $gay && strlen(trim($_POST[$njir]))>0;
	return $gay;
	
}

if(isset($_POST["aksi"])){
	if($_POST["aksi"]=="inputNilaiProfil" && isset($_POST["data"])){
		
		if(!cekOtorisasi($_SESSION["id_user"],13))die(json_encode(array("error"=>"Ditolak. User tidak mempunyai hak akses"))); //12 = input_profle
			
		$data=json_decode($_POST["data"]);
		foreach($data as $nilai){
			$id_alternatif=mysqli_real_escape_string($koneksi,$nilai->id_alternatif);
			foreach($nilai->dataKriteria as $k=>$id_kriteria){
				$id_kriteria2=mysqli_real_escape_string($koneksi,$id_kriteria);
				$nilai_profile=mysqli_real_escape_string($koneksi,$nilai->dataNilai[$k]);
				$query=mysqli_query($koneksi, "select * from tbl_profile where id_alternatif='$id_alternatif' and id_kriteria='$id_kriteria'"); //cek apakah sudah ada data di tbl_profile dengan id_alternatif dan id_kriteria yg telah ditentukan
				if(mysqli_num_rows($query)==0){
					mysqli_query($koneksi, "insert into tbl_profile values(null,'".$id_alternatif."', '".$id_kriteria2."', '".$nilai_profile."')");
				}else{
					mysqli_query($koneksi, "update tbl_profile set nilai_profile='".$nilai_profile."' where id_alternatif='".$id_alternatif."' and id_kriteria='".$id_kriteria2."'");
				}
			}
		}
		echo json_encode(array("sukses"=>true));
	}
	
	if($_POST["aksi"]=="tambahAlternatif" && isset($_POST["kodeAlternatif"]) && isset($_POST["namaAlternatif"])){
		
		if(!cekOtorisasi($_SESSION["id_user"],1))die(json_encode(array("error"=>"Ditolak. User tidak mempunyai hak akses")));
		
		$kode=mysqli_real_escape_string($koneksi, trim($_POST["kodeAlternatif"]));
		$sql="select * from tbl_alternatif where kode='".$kode."'";
		$query=mysqli_query($koneksi,$sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		if(mysqli_num_rows($query)>0)die(json_encode(array("error"=>"Data dengan kode '".$kode."' sudah ada")));
		$query=mysqli_query($koneksi,$sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		$nama=mysqli_real_escape_string($koneksi, trim($_POST["namaAlternatif"]));
		if($kode=="" || $nama=="")die(json_encode(array("error"=>"Kode dan nama alternatif tidak boleh kosong")));
		$query="insert into tbl_alternatif values(null,'".$kode."', '".$nama."')";
		$input=mysqli_query($koneksi,$query) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		echo json_encode(array("sukses"=>"Input data sukses"));
	}
	if($_POST["aksi"]=="tambahAspek" && isset($_POST["kodeAspek"]) && isset($_POST["namaAspek"]) && isset($_POST["persentaseAspek"])){
		
		if(!cekOtorisasi($_SESSION["id_user"],5))die(json_encode(array("error"=>"Ditolak. User tidak mempunyai hak akses")));
		
		$sql="SELECT sum(`persentase`) as total_persentase FROM `tbl_aspek`";
		$query=mysqli_query($koneksi,$sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		$p=intval(mysqli_fetch_object($query)->total_persentase);
		$persentase=mysqli_real_escape_string($koneksi, trim($_POST["persentaseAspek"]));
		$p2=intval($persentase);
		if($p==100)die(json_encode(array("error"=>"Total bersentase sudah 100%, tidak bisa menambah lagi")));
		if($p2+$p>100)die(json_encode(array("error"=>"Persentase harus kurang dari atau sama dengan ".(100-$p))));
		$kode=mysqli_real_escape_string($koneksi, trim($_POST["kodeAspek"]));
		$sql="select * from tbl_aspek where kode='".$kode."'";
		$query=mysqli_query($koneksi,$sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		if(mysqli_num_rows($query)>0)die(json_encode(array("error"=>"Data dengan kode '".$kode."' sudah ada")));
		$nama=mysqli_real_escape_string($koneksi, trim($_POST["namaAspek"]));
		if($kode=="" || $nama=="" || $persentase=="")die(json_encode(array("error"=>"Kode, nama aspek, dan persentase tidak boleh kosong")));
		$query="insert into `tbl_aspek` values(null,'".$kode."', '".$nama."', '".$persentase."')";
		$input=mysqli_query($koneksi,$query) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		echo json_encode(array("sukses"=>"Input data aspek sukses"));
	}
	$kriteria_arr=["id_aspek","kode_kriteria","nama_kriteria","nilai_kriteria","factor_kriteria"];
	if($_POST["aksi"]=="tambahKriteria" && cekIssetPost($kriteria_arr)){
		
		if(!cekOtorisasi($_SESSION["id_user"],9))die(json_encode(array("error"=>"Ditolak. User tidak mempunyai hak akses")));
		
		if(!cekKosong($kriteria_arr))die(json_encode(array("error"=>"Data harus diisi semua")));
		
		$kode=mysqli_real_escape_string($koneksi, trim($_POST["kode_kriteria"]));
		$sql="select * from tbl_kriteria where kode='".$kode."'";
		$query=mysqli_query($koneksi,$sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		if(mysqli_num_rows($query)>0)die(json_encode(array("error"=>"Data dengan kode kriteria '".$kode."' sudah ada")));
		
		$id_aspek=mysqli_real_escape_string($koneksi, trim($_POST["id_aspek"]));
		$nama=mysqli_real_escape_string($koneksi, trim($_POST["nama_kriteria"]));
		$nilai=mysqli_real_escape_string($koneksi, trim($_POST["nilai_kriteria"]));
		if(!preg_match("/^[1-9]+$/",$nilai))die(json_encode(array("error"=>"Nilai kriteria harus di rentang 1-9")));
		$factor=mysqli_real_escape_string($koneksi, trim($_POST["factor_kriteria"]));
		$query="insert into tbl_kriteria(id_aspek,kode,nama_kriteria,nilai,factor) values('".$id_aspek."', '".$kode."', '".$nama."', '".$nilai."', '".$factor."')";
		$input=mysqli_query($koneksi,$query) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		echo json_encode(array("sukses"=>"Input data sukses"));
	}
	//Bagian edit//
	if($_POST["aksi"]=="editAlternatif" && isset($_POST["Id"]) && isset($_POST["kode"]) && isset($_POST["old_kode"]) && isset($_POST["nama_alternatif"])){
		
		if(!cekOtorisasi($_SESSION["id_user"],3))die(json_encode(array("error"=>"Ditolak. User tidak mempunyai hak akses")));
		
		$kode=mysqli_real_escape_string($koneksi, trim($_POST["kode"]));
		$old_kode=mysqli_real_escape_string($koneksi, trim($_POST["old_kode"]));
		if($kode!=$old_kode){
			$sql="select * from tbl_alternatif where kode='".$kode."'";
			$query=mysqli_query($koneksi,$sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
			if(mysqli_num_rows($query)>0)die(json_encode(array("error"=>"Data dengan kode '".$kode."' sudah ada")));
		}
		$nama=mysqli_real_escape_string($koneksi, trim($_POST["nama_alternatif"]));
		$id=mysqli_real_escape_string($koneksi, trim($_POST["Id"]));
		if($kode=="" || $nama=="")die(json_encode(array("error"=>"Kode dan nama alternatif tidak boleh kosong")));
		$query="update tbl_alternatif set kode='".$kode."', nama_alternatif='".$nama."' where id=".$id;
		$edit=mysqli_query($koneksi,$query) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		echo json_encode(array("sukses"=>"Edit data sukses"));
	}
	if($_POST["aksi"]=="editAspek" && isset($_POST["Id"]) && isset($_POST["kode"]) && isset($_POST["nama_aspek"]) &&  isset($_POST["old_kode"]) && isset($_POST["persentase"])){
		
		if(!cekOtorisasi($_SESSION["id_user"],7))die(json_encode(array("error"=>"Ditolak. User tidak mempunyai hak akses")));
		
		$id=mysqli_real_escape_string($koneksi, trim($_POST["Id"]));
		$sql="select sum(persentase) as total from tbl_aspek where id<>".$id;
		$query=mysqli_query($koneksi,$sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		$p=mysqli_fetch_object($query)->total;
		$kode=mysqli_real_escape_string($koneksi, trim($_POST["kode"]));
		$old_kode=mysqli_real_escape_string($koneksi, trim($_POST["old_kode"]));
		if($kode!=$old_kode){
			$sql="select * from tbl_aspek where kode='".$kode."'";
			$query=mysqli_query($koneksi,$sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
			if(mysqli_num_rows($query)>0)die(json_encode(array("error"=>"Data dengan kode '".$kode."' sudah ada")));
		}
		$nama=mysqli_real_escape_string($koneksi, trim($_POST["nama_aspek"]));
		$persentase=mysqli_real_escape_string($koneksi, trim($_POST["persentase"]));
		if($kode=="" || $nama=="" || $persentase=="")die(json_encode(array("error"=>"Kode, nama aspek, dan persentase tidak boleh kosong")));
		$p2=intval($persentase);
		if($p+$p2>100)die(json_encode(array("error"=>"Masukkan persentase kurang dari atau sama dengan ".(100-$p))));
		$query="update tbl_aspek set kode='".$kode."', nama_aspek='".$nama."', persentase='".$persentase."' where id=".$id;
		$edit=mysqli_query($koneksi,$query) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		echo json_encode(array("sukses"=>"Edit data sukses"));
	}
	if($_POST["aksi"]=="editKriteria" && isset($_POST["Id"]) && isset($_POST["old_kode"]) && cekIssetPost($kriteria_arr)){
		
		if(!cekOtorisasi($_SESSION["id_user"],11))die(json_encode(array("error"=>"Ditolak. User tidak mempunyai hak akses")));
		
		$arr2=array_merge(array("Id","old_kode"), $kriteria_arr);
		if(!cekKosong($arr2))die(json_encode(array("error"=>"Data harus diisi semua")));
		$id=mysqli_real_escape_string($koneksi, trim($_POST["Id"]));
		$kode=mysqli_real_escape_string($koneksi, trim($_POST["kode_kriteria"]));
		$old_kode=mysqli_real_escape_string($koneksi, trim($_POST["old_kode"]));
		if($kode!=$old_kode){
			$sql="select * from tbl_kriteria where kode='".$kode."'";
			$query=mysqli_query($koneksi,$sql) or die(json_encode(array("error"=>mysqli_error($koneksi))));
			if(mysqli_num_rows($query)>0)die(json_encode(array("error"=>"Data dengan kode '".$kode."' sudah ada")));
		}
		$id_aspek=mysqli_real_escape_string($koneksi, trim($_POST["id_aspek"]));
		$nama=mysqli_real_escape_string($koneksi, trim($_POST["nama_kriteria"]));
		$nilai=mysqli_real_escape_string($koneksi, trim($_POST["nilai_kriteria"]));
		if(!preg_match("/^[1-9]+$/",$nilai))die(json_encode(array("error"=>"Nilai kriteria harus di rentang 1-9")));
		$factor=mysqli_real_escape_string($koneksi, trim($_POST["factor_kriteria"]));
		$query="update tbl_kriteria set id_aspek='".$id_aspek."', kode='".$kode."', nama_kriteria='".$nama."', nilai='".$nilai."', factor='".$factor."' where id='".$id."'";
		$input=mysqli_query($koneksi,$query) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		echo json_encode(array("sukses"=>"Edit data sukses"));
	}
	//End edit//
	if($_POST["aksi"]=="hapusAlternatif" && isset($_POST["idHapus"])){
		
		if(!cekOtorisasi($_SESSION["id_user"],4))die(json_encode(array("error"=>"Ditolak. User tidak mempunyai hak akses")));
		
		$idHapus=mysqli_real_escape_string($koneksi, trim($_POST["idHapus"]));
		if($idHapus=="")die(json_encode(array("error"=>"Gagal hapus alternatif")));
		$query="delete from tbl_alternatif where id='".$idHapus."'";
		$hapus=mysqli_query($koneksi,$query) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		echo json_encode(array("sukses"=>"Hapus data sukses"));
	}
	if($_POST["aksi"]=="hapusAspek" && isset($_POST["idHapus"])){
		
		if(!cekOtorisasi($_SESSION["id_user"],8))die(json_encode(array("error"=>"Ditolak. User tidak mempunyai hak akses")));
		
		$idHapus=mysqli_real_escape_string($koneksi, trim($_POST["idHapus"]));
		if($idHapus=="")die(json_encode(array("error"=>"Gagal hapus aspek")));
		$query="delete from tbl_aspek where id='".$idHapus."'";
		$hapus=mysqli_query($koneksi,$query) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		echo json_encode(array("sukses"=>"Hapus data sukses"));
	}
	if($_POST["aksi"]=="hapusKriteria" && isset($_POST["idHapus"])){
		
		if(!cekOtorisasi($_SESSION["id_user"],12))die(json_encode(array("error"=>"Ditolak. User tidak mempunyai hak akses")));
		
		$idHapus=mysqli_real_escape_string($koneksi, trim($_POST["idHapus"]));
		if($idHapus=="")die(json_encode(array("error"=>"Gagal hapus data kriteria")));
		$query="delete from tbl_kriteria where id='".$idHapus."'";
		$hapus=mysqli_query($koneksi,$query) or die(json_encode(array("error"=>mysqli_error($koneksi))));
		echo json_encode(array("sukses"=>"Hapus data sukses"));
	}
}
