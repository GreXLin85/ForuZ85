<!DOCTYPE html>
<html>
<head>
  <?php
$ayarlar = $db->query("SELECT * FROM ayarlar", PDO::FETCH_ASSOC);
if ( $ayarlar->rowCount() ){
     foreach( $ayarlar as $ayarlara ){
          $baslik = $ayarlara['sb'];
          $aciklama = $ayarlara['sa'];
     }
}

function yetkikontrol(){
  if ($_SESSION["yetki"] == "1") {
    print("<p class='level-item has-text-centered'><a class='link is-info' href='forum.php?admin=".$_SESSION["panelurl"]."'>Admin paneli</a></p>");
  }
}
  ?>
  <title><?php echo $baslik; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
  <?php echo '<meta name="description" content="'.$aciklama.'"/>'; ?>
  <meta name="keywords" content="a"/>
</head>
<body>
<section class="hero is-dark">
      <div class="hero-body">
        <div class="container">
          <center><p class="title">
            <?php echo $baslik; ?>
          </p></center>
          <?php
          if(!isset($_SESSION['login'])){
            echo "";
        }else{
          echo "<p class='subtitle'>
         <nav class='level'>
            <p class='level-item has-text-centered'><a class='link is-info' href='forum.php'>Anasayfa</a></p>
      <p class='level-item has-text-centered'><a class='link is-info'>Kullanıcı Paneli</a></p>
      <p class='level-item has-text-centered'><a class='link is-info'>Yeni Konular</a></p>
      <p class='level-item has-text-centered'><a class='link is-info'>Yeni Yorumlar</a></p>
      ".yetkikontrol()."
    </nav>
          </p>";
        }
?>
          <br>
        </div>
      </div>
    </section>