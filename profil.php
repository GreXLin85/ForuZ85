<?php
ob_start();
session_start();
require_once('parcalar/koruma.php');
require_once('baglan.php');
require_once('parcalar/ustkisim.html');
$kosul = intval($_GET['kisi']);
//Uyeye bak//
$profilgetir = $db ->query("SELECT * FROM uyeler WHERE id = $kosul", PDO::FETCH_ASSOC);
if ( $profilgetir->rowCount() ){
	foreach( $profilgetir as $row ){
	$id = $row['id'];
	$kadi = $row['kadi'];
	$yetki = $row['yetki'];
	$uyeliktarih = $row['uyeliktarih'];
		}
	}else{
		header("location:forum.php");
		die();
	}
$mesajgetir = $db ->query("SELECT mesaj,kimatti FROM ziyaretcimesaj WHERE uyeid = $kosul", PDO::FETCH_ASSOC);
if ( $mesajgetir->rowCount() ){
	$toplamyorum = $mesajgetir->rowCount();
	foreach( $mesajgetir as $row ){
	$mesaj = $row['mesaj'];
	$kimatti = $row['kimatti'];
		}
	}

if ($kosul == $id)
{
	//Konu gösterimi
	echo "<center>Kullanıcı adı : $kadi<br>Üyelik Tarihi : $uyeliktarih</center>";
	//Yorum gösterimi
	if ($toplamyorum == 0) {
	  echo "<br><center><br>==============<br>Burada hiç mesaj yok gibi gözüküyor";
	}else{
		echo "<center><br>==============<br>Kim Attı : $kimatti<br>Yorum : $mesaj";
	}
}else{
	header("location:forum.php");
	die();
}