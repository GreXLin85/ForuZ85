<?php
try {
     $db = new PDO("mysql:host=localhost;dbname=foruz85", "root", "");
} catch ( PDOException $e ){
     print $e->getMessage();
}
?>