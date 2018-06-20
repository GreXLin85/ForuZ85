<?php 
ob_start();
session_start();
require_once('baglan.php');
require_once('parcalar/ustkisim.php');
require_once('parcalar/fonksyonlar.php');

if ($_POST) {
  $ayarlar = $db->query("SELECT * FROM ayarlar", PDO::FETCH_ASSOC);
  if ( $ayarlar->rowCount() ){
       foreach( $ayarlar as $ayarlara ){
            $baslik = $ayarlara['sb'];
            $aciklama = $ayarlara['sa'];
       }
  }
  $kadi = htmlspecialchars($_POST["kadi"]);
  $kontrolkadi = $_POST["kadi"];
  $nickkontrol = $db->query("SELECT * FROM uyeler WHERE kadi LIKE '%$kontrolkadi%'", PDO::FETCH_ASSOC);
  $nickmiktar=$nickkontrol->rowCount();
  if ($nickmiktar>1) {
    echo "<center>Zaten böyle bir üye var</center>";
    header("refresh:2;url=kayitol.php");
    die();
  }
  $sifre = t_crypto_v2($_POST["sifre"]);
  $mail = htmlspecialchars($_POST["mail"]);
  $yetki = "1";
  $query = $db->prepare("INSERT INTO uyeler SET
  kadi = :kadi,
  sifre = :sifre,
  mail = :mail,
  yetki = :yetki");

  $insert = $query->execute(array(
      "kadi" => $kadi, 
      "sifre" => $sifre,
      "mail" => $mail,
      "yetki" => $yetki
  ));

  if ( $insert ){
      $last_id = $db->lastInsertId();
      print "<center> Üyeliğiniz başarıyla açılmıştır </center>";
      header("location:index.php");
      
  }
}
?> 
<!DOCTYPE html>
<center>
<html lang="tr">
  <form method="POST" action="" class="login">
    <p>
      <label for="login" class="label">Nick:</label>
      <input type="text" name="kadi"class="input" placeholder="Nick">
    </p>
    <p>
      <label for="login" class="label">Mail:</label>
      <input type="text" name="mail"class="input" placeholder="Mail">
    </p>
    <p>
      <label for="password" class="label">Parola:</label>
      <input type="password" name="sifre"class="input" placeholder="Parola">
    </p>

    <p class="login-submit">
      <button type="submit" class="button is-primary">Kayıt Ol !</button>
    </p>
  </form>