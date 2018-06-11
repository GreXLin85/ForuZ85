<?php
ob_start();
session_start();
require_once('parcalar/koruma.php');
require_once('baglan.php');
require_once('parcalar/ustkisim.php');
$kosul = intval($_GET['konu']);
//yorum yollama post
if ($_POST) {
	$yorum = htmlspecialchars($_POST["yorum"]);
	$kimyapti = $_SESSION["kadi"];
	$konuid = $kosul;

	$query = $db->prepare("INSERT INTO yorumlar SET
	yorum = :yorum,
	kimyapti = :kimyapti,
	konuid = :konuid");

	$insert = $query->execute(array(
	    "yorum" => $yorum, 
	    "kimyapti" => $kimyapti,
	    "konuid" => $konuid
	));
	if ( $insert ){
	    $last_id = $db->lastInsertId();
	    print "<center> Konu Başarıyla Açıldı </center>";
	}
}
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
	}
if ($kosul == $id)
{
	//Konu gösterimi
	echo "<center><div class='container'><div class='notification'><img src='$icon' height='16' width='16' > <strong style='font-size: 20px;'>$baslik</strong></div></div><br>$icerik</center>";
	//Yorum yolla
	echo "<br><form method='POST' action=''><input class='input' name='yorum' type='text' placeholder='Yorum yaz !'></form>";
	//Yorum gösterimi
	if ($toplamyorum == 0) {
	  echo "<br><center>Burada hiç yorum yok gibi gözüküyor";
	}else{
			foreach( $yorumgetir as $row ){
	$yorum = $row['yorum'];
	$kimyapti = $row['kimyapti'];
	echo "<br>".$yorum;
		}
	}
}else{
	header("location:forum.php");
	die();
}
?>