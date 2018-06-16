<?php
ob_start();
session_start();
require_once('verial.php');
if ($_POST) {
	$baslik = htmlspecialchars($_POST["baslik"]);
	$icerik = htmlspecialchars($_POST["icerik"]);
	$katagori = htmlspecialchars($_POST["katagori"]);
	$icon = htmlspecialchars($_POST["icon"]);

	$kimacti = $_SESSION["kadi"];
	$id = $_SESSION["id"];

	$query = $db->prepare("INSERT INTO konular SET
	baslik = :baslik,
	icerik = :icerik,
	katagori = :katagori,
	kimacti = :kimacti,
	icon = :icon");

	$insert = $query->execute(array(
	    "baslik" => $baslik, 
	    "icerik" => $icerik, 
	    "katagori" => $katagori, 
	    "kimacti" => $kimacti,
	    "icon" => $icon
	));

	if ( $insert ){
	    $last_id = $db->lastInsertId();
	    print "<center> Konu Başarıyla Açıldı </center>";
	    
	}
}
$icon = $db ->query("SELECT * FROM icon", PDO::FETCH_ASSOC);
$select = $db ->query("SELECT * FROM kategoriler", PDO::FETCH_ASSOC);
?>
<center>
<form method="post" action="">
<input class="input" type="text" placeholder="Başlık" name="baslik" required="required" ><br>
<br><input type="text" name="icerik" class='textarea' placeholder="İçerik" required="required">
<br>
  <div class="select">
    <select name="katagori" required="required">
      <option disabled>Katagori Seç</option>
<?php
if ( $select->rowCount() ){ 
   		$toplam = $select->rowCount();
/* Toplam veri sayısını öğrenmek için rowCount() methoduni kullanabilirsiniz.. */
	   foreach( $select as $row ){
		print '<option>'.$row["isim"].'</option>';		
  	   }
   }
?>
    </select>
  </div> <br>
<div class="control" style="text-align: center;align-content: center;">
    <?php
if ( $icon->rowCount() ){ 
   		$toplamicon = $icon->rowCount();
/* Toplam veri sayısını öğrenmek için rowCount() methoduni kullanabilirsiniz.. */
	   foreach( $icon as $row ){
		print '  <label class="radio">
    <input type="radio" name="icon" value="'.$row["icon"].'">
    <img src="'.$row["icon"].'">';		
  	   }
   }
?>
  </label>
</div>
  <br>
<input type="submit" value="Gönder" class='button is-link'>
</form></center>