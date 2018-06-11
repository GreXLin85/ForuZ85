<?php
require_once ('parcalar/ustkisim.php');

if ( file_exists("baglan.php") ) {
header("location:index.php");
}else {
echo '<center>
<form action="" method="POST">
<label for="login" class="label">Yönetici Adı</label><input type="text" name="adminuser" placeholder="Yönetici Adı" class="input">
<label for="login" class="label">Yönetici E-Mail</label><input type="text" name="adminmail" placeholder="Yönetici E-Mail" class="input">
<label for="login" class="label">Yönetici Parolası</label><input type="password" name="adminpass" placeholder="Yönetici Parolası" class="input">
<label for="login" class="label">Site başlığı</label><input type="text" name="sb" placeholder="Site başlığı" class="input">
<label for="login" class="label">Site açıklaması</label><input type="text" name="sa" placeholder="Site açıklaması" class="input">
<label for="login" class="label">Veritabanı host</label><input type="text" name="vthost" placeholder="Veritabanı host" class="input">
<label for="login" class="label">Veritabanı user</label><input type="text" name="vtuser" placeholder="Veritabanı user" class="input">
<label for="login" class="label">Veritabanı parola</label><input type="text" name="vtpass" placeholder="Veritabanı parola" class="input">
<label for="login" class="label">Veritabanı isim</label><input type="text" name="vtisim" placeholder="Veritabanı isim" class="input">
<button type="submit" class="button is-primary">Gönder !</button>
</form>
</center>';

if ($_POST) {
	$kadi = $_POST["adminuser"];
	$mail = $_POST["adminmail"];
	$sifre = $_POST["adminpass"];
	$siteb = $_POST["sb"];
	$siteacik = $_POST["sa"];
	$vthost = $_POST["vthost"];
	$vtuser = $_POST["vtuser"];
	$vtpass = $_POST["vtpass"];
	$vtisim = $_POST["vtisim"];
	touch('baglan.php');
	$baglan = fopen('baglan.php', 'w');
	fwrite($baglan, '<?php
try {
     $db = new PDO("mysql:host='.$vthost.';dbname='.$vtisim.'", "'.$vtuser.'", "'.$vtpass.'");
} catch ( PDOException $e ){
     print $e->getMessage();
}
?>');
	fclose($baglan);
	require_once "baglan.php";
	$ayarlar = "CREATE TABLE ayarlar (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    sb VARCHAR(30) NOT NULL,
    sa VARCHAR(65) NOT NULL
    )";
    $icon = "CREATE TABLE icon (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    icon TEXT NOT NULL
    )";
    $kategoriler = "CREATE TABLE kategoriler (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    isim TEXT NOT NULL
    )";
    $konular = "CREATE TABLE konular (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    katagori TEXT NOT NULL,
    icon VARCHAR(65) NOT NULL,
    baslik VARCHAR(40) NOT NULL,
    icerik VARCHAR(1200) NOT NULL,
    kimacti VARCHAR(16) NOT NULL
    )";
    $uyeler = "CREATE TABLE uyeler (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    kadi VARCHAR(16) NOT NULL,
    sifre VARCHAR(64) NOT NULL,
    mail TEXT NOT NULL,
    yetki VARCHAR(200) NOT NULL,
    uyeliktarih timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $yorumlar = "CREATE TABLE yorumlar (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    yorum VARCHAR(250) NOT NULL,
    kimyapti VARCHAR(16) NOT NULL,
    konuid INT(11) NOT NULL
    )";
    $ziyaretcimesaj = "CREATE TABLE ziyaretcimesaj (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    mesaj VARCHAR(50) NOT NULL,
    kimatti VARCHAR(16) NOT NULL,
    uyeid int(11) NOT NULL
    )";

    $db->exec($ayarlar);
    $db->exec($icon);
    $db->exec($kategoriler);
    $db->exec($konular);
    $db->exec($uyeler);
    $db->exec($yorumlar);
    $db->exec($ziyaretcimesaj);

    $iconolus = $db -> prepare("INSERT INTO icon(icon) VALUES(?)");
    $iconolus -> execute(array("images/icons/internet.png"));
    $iconolus -> execute(array("images/icons/chat.png"));

    $kategorilerolus = $db -> prepare("INSERT INTO kategoriler(id,isim) VALUES(?,?)");
    $kategorilerolus -> execute(array("1","Hacking"));
    $kategorilerolus -> execute(array("2","Oyun"));

    $uyelerolus = $db -> prepare("INSERT INTO uyeler(kadi,sifre,mail,yetki) VALUES(?,?,?,?)");
    $uyelerolus -> execute(array($kadi,$sifre,$mail,"1"));

    $ayarlarolus = $db -> prepare("INSERT INTO ayarlar(sb,sa) VALUES(?,?)");
    $ayarlarolus -> execute(array($siteb,$siteacik));

    echo "İşlemler tamamdır !\nAnasayfaya yönlendiriliyorsunuz...";
    header("refresh:3;url=index.php");
}

}

?>