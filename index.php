<?php
if (!file_exists("baglan.php")) {
  header("location:hazirlayici.php");
}

ob_start();
session_start();
require_once('baglan.php');
require_once('parcalar/fonksyonlar.php');
if($_POST){
  $kadi=$_POST["kadi"];
  $password=t_crypto_v2($_POST['password']);
if(empty($password) or empty($kadi)){
echo '<center style="color:white;">Kullanıcı Adınızı & Şifrenizi Boş Bırakmayınız...</center>';
}else{
  $sql= $db->prepare("SELECT * FROM uyeler WHERE kadi='$kadi' AND sifre='$password'");
  $query = $db->query("SELECT * FROM uyeler WHERE kadi='{$kadi}' AND sifre='{$password}'")->fetch(PDO::FETCH_ASSOC);
  $sql -> execute();
  if($sql -> rowCount()){
    $_SESSION["kadi"]=$query["kadi"];
    $_SESSION["id"]=$query["id"];
    $_SESSION["yetki"]=$query["yetki"];
    $_SESSION['login'] = '1';
    if ($_SESSION["yetki"] == "1") {
    	$_SESSION["panelurl"] = rand("10000","999999");
    }
    header("Refresh:2;url=forum.php");
    echo '<center style="color:white;">Giriş Yapıldı</center>';
    }
    else {echo '<center style="color:white;">Giriş Başarısız</center>';}
    }
    }else {echo '';}
    require_once('parcalar/ustkisim.php');
?> 
<!DOCTYPE html>
<center>
<html lang="tr">
  <form method="post" action="index.php" class="login">
    <p>
      <label for="login" class="label">Nick:</label>
      <input type="text" name="kadi" id="login" class="input" placeholder="Nick">
    </p>

    <p>
      <label for="password" class="label">Parola:</label>
      <input type="password" name="password" id="password" class="input" placeholder="Parola">
    </p>

    <p class="login-submit">
      <button type="submit" class="button is-primary">Giriş Yap !</button>
    </p>

    <p class="forgot-password"><a href="kayitol.php">Kayıt Ol !</a></p>
  </form>