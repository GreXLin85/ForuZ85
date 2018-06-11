<?php 
ob_start();
session_start();
require_once('baglan.php');
require_once('parcalar/ustkisim.php');

if ($_POST) {
  $kadi = htmlspecialchars($_POST["kadi"]);
  $sifre = htmlspecialchars($_POST["sifre"]);
  $yetki = "1";
  $query = $db->prepare("INSERT INTO uyeler SET
  kadi = :kadi,
  sifre = :sifre,
  yetki = :yetki");

  $insert = $query->execute(array(
      "kadi" => $kadi, 
      "sifre" => $sifre,
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
      <label for="password" class="label">Parola:</label>
      <input type="password" name="sifre"class="input" placeholder="Parola">
    </p>

    <p class="login-submit">
      <button type="submit" class="button is-primary">Kayıt Ol !</button>
    </p>
  </form>