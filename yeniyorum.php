<?php
ob_start();
session_start();
require_once('verial.php');
$veri = intval($_GET['goster']);
if (!$veri == "10") {
	header("location:yeniyorum.php?goster=10");
}
$b = "1";
$toplam = $veri+$b;
$konugetir = $db ->query("SELECT * FROM yorumlar ORDER BY yorumlar.tarih DESC limit 0,$veri", PDO::FETCH_ASSOC);
if ($konugetir->rowCount()) {
	$toplamkonu = $konugetir->rowCount();
	foreach($konugetir as $konu) {
			$yorum = $konu['yorum'];
			$kimyapti = $konu['kimyapti'];
			$konuid = $konu["konuid"];
			$tarih = $konu["tarih"];
			print '<div class="container is-fullhd">
  <div class="notification" style="text-align:center;border:solid;">
    <code>YENİ</code>'.$kimyapti.' -<a href="konuoku.php?konu='.$konuid.'"> '.$yorum.'</a> - '.$tarih.'</div></div><br>';
	}

echo "<center><a href='yeniyorum.php?goster=".$toplam."'>Daha fazla göster</a></center>";
}
?>