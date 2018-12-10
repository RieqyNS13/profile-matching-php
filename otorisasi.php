<?php 
function cekOtorisasi($id_user,$id_menu){
	include "koneksi.php";
	$sql="select * from hak_akses where id_user=$id_user and id_menu=$id_menu";
	$query=mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
	return mysqli_num_rows($query)>0;
}
