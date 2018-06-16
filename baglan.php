<?php
try {
     $db = new PDO("mysql:host=localhost;dbname=te", "root", "");
} catch ( PDOException $e ){
     print $e->getMessage();
}
?>