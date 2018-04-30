<?php
ob_start();
session_start();
require_once('parcalar/koruma.php');
require_once('baglan.php');
require_once('parcalar/ustkisim.html');
$kosul = intval($_GET['konu']);
//Konular//
$konugetir = $db ->query("SELECT * FROM konular WHERE id = $kosul", PDO::FETCH_ASSOC);
if ( $konugetir->rowCount() ){
	foreach( $konugetir as $row ){
	$id = $row['id'];
	$baslik = $row['baslik'];
	$icerik = $row['icerik'];
	$katagori = $row['katagori'];
	$kimacti = $row['kimacti'];
	$icon = $row['icon'];
		}
	}else{
		header("location:forum.php");
		die();
	}
//Yorumlar//
$yorumgetir = $db ->query("SELECT yorum,kimyapti FROM yorumlar WHERE konuid = $kosul", PDO::FETCH_ASSOC);
if ( $yorumgetir->rowCount() ){
	$toplamyorum = $yorumgetir->rowCount();
	foreach( $yorumgetir as $row ){
	$yorum = $row['yorum'];
	$kimyapti = $row['kimyapti'];
		}
	}
if ($kosul == $id)
{
	//Konu gösterimi
	echo "<center><div class='container'><div class='notification'><img src='$icon' height='16' width='16' > <strong style='font-size: 20px;'>$baslik</strong></div></div><br>$icerik</center>";
	//Yorum gösterimi
	if ($toplamyorum == 0) {
	  echo "<br><center>Burada hiç yorum yok gibi gözüküyor";
	}else{
		echo "<center><br>---------------<br>$yorum";
	}
}else{
	header("location:forum.php");
	die();
}
?>