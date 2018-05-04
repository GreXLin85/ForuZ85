<?php
ob_start();
session_start();
require_once('parcalar/koruma.php');
require_once('baglan.php');
require_once('parcalar/ustkisim.php');
   $select = $db ->query("SELECT * FROM konular", PDO::FETCH_ASSOC);
   if ( $select->rowCount() ){ 
   		$toplam = $select->rowCount();
/* Toplam veri sayısını öğrenmek için rowCount() methoduni kullanabilirsiniz.. */
	   foreach( $select as $row ){
		print '<article class="media" style="border-style:solid;">
  <figure class="media-left">
    <p class="image is-64x64">
      <img src="">
    </p>
  </figure>
  <div class="media-content">
    <div class="content">
      <p>
        <strong>'.substr($row['baslik'], 0, 10).'</strong> <small>@'.$row['kimacti'].'</small>
        <br>
        '.substr($row['icerik'], 0, 25).'... <a href="konuoku.php?konu='.$row['id'].'">Devamını oku</a></p>
    </div>
<nav class="level is-mobile"><div class="level-left"><a class="level-item"><span class="icon is-small"><i class="fas fa-reply"></i></span></a><a class="level-item"><span class="icon is-small"><i class="fas fa-retweet"></i></span></a><a class="level-item"><span class="icon is-small"><i class="fas fa-heart"></i></span></a></div></nav></div></article><br>';		
  	   }
   }
if ($toplam == 0) {
  print("<center>Burada hiç konu yok gibi gözüküyor.</center>");
}
?>
</body>
</html>