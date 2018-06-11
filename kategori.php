<?php
ob_start();
session_start();
require_once ('parcalar/koruma.php');

require_once ('baglan.php');

require_once ('parcalar/ustkisim.php');

$kosul = intval($_GET['id']);
$konuidgetir = $db ->query("SELECT id FROM konular", PDO::FETCH_ASSOC);
$katagorigetir = $db->query("SELECT * FROM kategoriler WHERE id = $kosul", PDO::FETCH_ASSOC);

if ($katagorigetir->rowCount()) {
	$toplamkat = $katagorigetir->rowCount();
	foreach($katagorigetir as $row) {
		$id = $row['id'];
		$isim = $row['isim'];
		$konugetir = $db->query("SELECT * FROM konular WHERE katagori LIKE '$isim'", PDO::FETCH_ASSOC);
	}
}
if ($kosul == $id) {
	if ($konugetir->rowCount()) {
		$toplamkonu = $konugetir->rowCount();
		foreach($konugetir as $konu) {
			$icon = $konu['icon'];
			$baslik = $konu['baslik'];
			$id = $konu["id"];
			print '<div class="container is-fullhd">
  <div class="notification" style="text-align:center;border:solid;">
    <code>YENİ</code><a href="konuoku.php?konu='.$id.'"><img src="'.$icon.'">'.$baslik.'</a></div></div><br>';
		}
		}
	}
