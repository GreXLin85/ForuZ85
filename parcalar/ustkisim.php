<!DOCTYPE html>
<html>
<head>
  <title>ForuZ85</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
</head>
<body>
<section class="hero is-dark">
      <div class="hero-body">
        <div class="container">
          <center><p class="title">
            FORUZ85
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
    </nav>
          </p>";
        }
?>
          <br>
        </div>
      </div>
    </section>