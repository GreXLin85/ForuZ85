<?php 
ob_start();
session_start();
require_once('baglan.php');

if($_POST){
  $kadi=$_POST["kadi"];
  $password=$_POST['password'];
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
    header("Refresh:2;url=forum.php");
    echo '<center style="color:white;">Giriş Yapıldı</center>';
    }
    else {echo '<center style="color:white;">Giriş Başarısız</center>';}
    }
    }else {echo '';}
?> 
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>ForuZ85 | Giriş</title>
  <link rel="stylesheet" href="style/giris.css">
</head>
<body>
  <form method="post" action="index.php" class="login">
    <p>
      <label for="login">Nick:</label>
      <input type="text" name="kadi" id="login" placeholder="Nick">
    </p>

    <p>
      <label for="password">Parola:</label>
      <input type="password" name="password" id="password" placeholder="Parola">
    </p>

    <p class="login-submit">
      <button type="submit" class="login-button">Giriş Yap !</button>
    </p>

    <p class="forgot-password"><a href="kayitol.php">Kayıt Ol !</a></p>
  </form>
</body>
</html>