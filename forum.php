<?php
ob_start();
session_start();
require_once('verial.php');
$panel = $_GET["admin"];

if ($_SESSION["yetki"] == "1") {
  if ($panel == $_SESSION["panelurl"]) {
    print "admin panelindesiniz";
  }
}else{
  echo "<center>İZİNSİZ GİRİŞ ENGELLENDİ</center>";
}
   $select = $db ->query("SELECT * FROM kategoriler", PDO::FETCH_ASSOC);
   if ( $select->rowCount() ){ 
   		$toplam = $select->rowCount();
/* Toplam veri sayısını öğrenmek için rowCount() methoduni kullanabilirsiniz.. */
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