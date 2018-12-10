<?php 
include "koneksi.php";
include "hitung.class.php";
$dataAlternatif=[];
$query=mysqli_query($koneksi, "select * from tbl_alternatif order by id asc") or die(mysqli_error($koneksi));
while($fetch=mysqli_fetch_object($query)){
	$alternatif=new Alternatif($fetch->id, $fetch->kode, $fetch->nama_alternatif);
	array_push($dataAlternatif, $alternatif);
}
$sql="select * from tbl_aspek order by id asc";
$query=mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
$arrayHitung=[];
while($fetch=mysqli_fetch_object($query)){
	$Hitung=new Hitung();
	$Aspek=new Aspek($fetch->kode, $fetch->nama_aspek, $fetch->persentase);
	$Hitung->Aspek=$Aspek;
	foreach($dataAlternatif as $alternatif1){
		$Data = new Data();
		$Data->Alternatif=$alternatif1;
		
		$sql2="SELECT a.id_alternatif,c.nama_alternatif,a.id_kriteria,b.kode,b.nama_kriteria,b.nilai as nilai_kriteria,b.factor,b.id_aspek,d.nama_aspek,a.nilai_profile FROM tbl_profile a 
				inner join tbl_kriteria b on a.id_kriteria=b.id inner join tbl_alternatif c on a.id_alternatif=c.id
				inner join tbl_aspek d on d.id=b.id_aspek where b.id_aspek='".$fetch->id."' and c.id='".$alternatif1->id."' order by id_alternatif,a.id_kriteria";
		$query2=mysqli_query($koneksi, $sql2);
		$coreF=0;$secondaryF=0;
		$C=0;$S=0;
		while($fetch2=mysqli_fetch_object($query2)){
			$Profile = new Profile($fetch2);
			$Data->addProfile($Profile);
			
			if($fetch2->factor==1){
				$coreF+=$Profile->bobot;
				$C++;
			}
			else{
				$secondaryF+=$Profile->bobot;
				$S++;
			}
			
		}
		if($C==0)$Data->NCF=0;
		else $Data->NCF=$coreF/$C;
		if($S==0)$Data->NSF=0;
		else $Data->NSF=$secondaryF/$S;
		$Data->hitungTotal();
		$Hitung->addData($Data);
		
	}
	array_push($arrayHitung, $Hitung);
}
$th="";
foreach($dataAlternatif as $dataAlternatif2){
	$x[$dataAlternatif2->id]=$dataAlternatif2;

}

foreach($arrayHitung as $key=>$hitungz){
	foreach($hitungz->Data as $data){
		$Njir["Alternatif"][$data->Alternatif->id]=$data->Alternatif;
		$Njir["Hasil"][$data->Alternatif->id][]=$data->Total*$hitungz->Aspek->nilai_persen/100;
		//$hasil[$data->Alternatif->id][]=
	}
	$th.="<th>".$hitungz->Aspek->value." (".$hitungz->Aspek->nilai_persen."%)</th>";
}

$keys=array_keys($Njir["Hasil"]);
$DataAkhir=[];
foreach($Njir["Alternatif"] as $key=>$val){
	array_push($DataAkhir,  array("Alternatif"=>$val, "Hasil"=>$Njir["Hasil"][$key], "Rank"=>array_sum($Njir["Hasil"][$key])));
}
//print_r($DataAkhir);die;
for($i=0; $i<count($DataAkhir); $i++){
	for($j=0; $j<$i; $j++){
		if($DataAkhir[$i]["Rank"]>$DataAkhir[$j]["Rank"]){
			$tmp = $DataAkhir[$j];
			
			$DataAkhir[$j] = $DataAkhir[$i];
			
			$DataAkhir[$i] = $tmp;
			
		}
	}
}
$html="";
$i=1;
foreach($DataAkhir as $Data){
	$html.="<tr><td>".$Data["Alternatif"]->key." - ".$Data["Alternatif"]->value."</td>";
	foreach($Data["Hasil"] as $hasil)$html.="<td>".$hasil."</td>";
	$html.="<td>".$Data["Rank"]."</td><td>".$i++."</td></tr>";
}
//print_r($DataAkhir);die;
//print_r($arrayHitung);

?>
<table class="table table-striped">
	<tr><th>Alternatif</th><?php echo $th; ?><th>Total</th><th>Rank</th></tr>
	<?php echo $html; ?>
	</table>