<?php
ob_start();
session_start();
require_once('verial.php');
$kosul = intval($_GET['kisi']);
if ($_POST) {
	$mesaj = htmlspecialchars($_POST["zmj"]);
	$kimatti = $_SESSION["kadi"];
	$uyeid = $kosul;

	$query = $db->prepare("INSERT INTO ziyaretcimesaj SET
	mesaj = :mesaj,
	kimatti = :kimatti,
	uyeid = :uyeid");

	$insert = $query->execute(array(
	    "mesaj" => $mesaj, 
	    "kimatti" => $kimatti,
	    "uyeid" => $uyeid
	));
	if ( $insert ){
	    $last_id = $db->lastInsertId();
	    print "<center> Yorumunuz yollamıştır. </center>";
	}else{
		print("Bir sorun var");
	}
}
function yetkine(){
	if ($_SESSION["yetki"] == "1") {
		return "Kurucu";
	}
	elseif ($_SESSION["yetki"] == "2") {
		return "Yönetici";
	}
	elseif ($_SESSION["yetki"] == "3") {
		return "Moderator";
	}
}

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
}

if ($kosul == $id)
{
	//Konu gösterimi
	echo "<center>Kullanıcı adı : $kadi<br>Üyelik Tarihi : $uyeliktarih<br>Yetki : ".yetkine()."</center>";
	//yorum gönderme
	echo "<br><form method='POST' action=''><input class='input' name='zmj' type='text' placeholder='Ziyaretçi mesajı yaz'></form>";
	//Yorum gösterimi
	if ($toplamyorum == 0) {
	  echo "<br><center><br>==============<br>Burada hiç mesaj yok gibi gözüküyor";
	}else{
			foreach( $mesajgetir as $row ){
			$mesaj = $row['mesaj'];
			$kimatti = $row['kimatti'];
			echo "<center><br>==============<br>Kim Attı : $kimatti<br>Yorum : $mesaj";
			}
	}
}else{
	header("location:forum.php");
	die();
}