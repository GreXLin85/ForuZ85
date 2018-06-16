<?php
ob_start();
session_start();
require_once('verial.php');
$veri = intval($_GET['goster']);
if (!$veri == "10") {
	header("location:yenikonu.php?goster=10");
}
$b = "1";
$toplam = $veri+$b;
$konugetir = $db ->query("SELECT * FROM konular ORDER BY konular.tarih DESC limit 0,$veri", PDO::FETCH_ASSOC);
if ($konugetir->rowCount()) {
	$toplamkonu = $konugetir->rowCount();
	foreach($konugetir as $konu) {
			$icon = $konu['icon'];
			$baslik = $konu['baslik'];
			$id = $konu["id"];
			$tarih = $konu["tarih"];
			print '<div class="container is-fullhd">
  <div class="notification" style="text-align:center;border:solid;">
    <code>YENİ</code><a href="konuoku.php?konu='.$id.'"><img src="'.$icon.'">'.$baslik.'</a> - '.$tarih.'</div></div><br>';
	}

echo "<center><a href='yenikonu.php?goster=".$toplam."'>Daha fazla göster</a></center>";
}
?>