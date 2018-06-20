<?php
ob_start();
session_start();
require_once('verial.php');
$panel = $_GET["admin"];

if ($_SESSION["yetki"] == "1") {
  if ($panel == $_SESSION["panelurl"]) {
    ?>
<div class="columns" style="text-align: center;">
  <div class="column" style="border-style: solid;">
    Üyeler
  </div>
  <div class="column" style="border-style: solid;">
    Konular
  </div>
  <div class="column" style="border-style: solid;">
    Yorumlar
  </div>
  <div class="column" style="border-style: solid;">
    Site ayarları
  </div>
</div>
<div style="text-align: center;font-size: 30px;">
Yönetim paneline hoş geldiniz<br>
<?php 
$datetr = date("H:i");
if ($datetr>"06:00") {
  echo "iyi günler ".$_SESSION["kadi"];
}else {
  echo "iyi akşamlar ".$_SESSION["kadi"];
}
?>
</div>
    <?php
    die();
  }
}else{
  echo "<center>İZİNSİZ GİRİŞ ENGELLENDİ</center>";
}
   $select = $db ->query("SELECT * FROM kategoriler", PDO::FETCH_ASSOC);
   if ( $select->rowCount() ){ 
   		$toplam = $select->rowCount();
	   foreach( $select as $row ){
	   	$bam = $row["isim"];
	   	$id = $row["id"];
	   		$katagorigetir = $db ->query("SELECT * FROM konular WHERE katagori LIKE '%$bam%'", PDO::FETCH_ASSOC);
			$miktar=$katagorigetir->rowCount();
		print '<div class="container is-fullhd">
  <div class="notification" style="text-align:center;border:solid;">
    <code>YENİ</code><a href="kategori.php?id='.$row["id"].'">'.$row["isim"].'</a> - '.$miktar.' Konu bulunuyor ! </div></div><br>';		
  	   }
   }
?>
</body>
</html>