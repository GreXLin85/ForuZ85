<?php
try {
     $db = new PDO("mysql:host=localhost;dbname=DBİsmi", "DBKullanıcıİsmi", "DBŞifresi"); //Veritabanı bilgilerini giriyoruz
} catch ( PDOException $e ){
     print $e->getMessage();
}
?>
