<?php
ob_start();
session_start();
require_once('parcalar/koruma.php');
require_once('baglan.php');
require_once('parcalar/ustkisim.html');
if ($_POST) {
	$baslik = $_POST["baslik"];
	$icerik = $_POST["icerik"];
	$katagori = $_POST["katagori"];
	$icon = $_POST["icon"];

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
	    print "insert işlemi başarılı!";
	}
}

?>
<center>
<form method="post" action="">
<input class="input" type="text" placeholder="Başlık" name="baslik" required="required" ><br>
<br><input type="text" name="icerik" class='textarea' placeholder="İçerik" required="required">
<br>
  <div class="select">
    <select name="katagori" required="required">
      <option disabled>Katagori Seç</option>
      <option>Hacking</option>
      <option>Kodlama</option>
    </select>
  </div> <br>
<div class="control" style="text-align: center;align-content: center;">
  <label class="radio">
    <input type="radio" name="icon" value="images/icons/internet.png">
    <img src="images/icons/internet.png">
  </label>
  <label class="radio">
    <input type="radio" name="icon" value="images/icons/chat.png">
    <img src="images/icons/chat.png">
  </label>
</div>
  <br>
<input type="submit" value="Gönder" class='button is-link'>
</form></center>