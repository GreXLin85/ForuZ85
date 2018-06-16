<?php

/*function yetkikontrol(){ //Admin paneli ile iletişim için kontrol yapılıyor.
  if ($_SESSION["yetki"] == "1") {
    print("<p class='level-item has-text-centered'><a class='link is-info' href='forum.php?admin=".$_SESSION["panelurl"]."'>Admin paneli</a></p>");
  }else{

  }
}*/

function ipal(){ // (Kod alıntıdır Kaynak : https://www.ahmetiscan.web.tr/php-ile-kullanicinin-gercek-ip-adresini-alma/)
	if(getenv("HTTP_CLIENT_IP")) {
 		$ip = getenv("HTTP_CLIENT_IP");
 	} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
 		$ip = getenv("HTTP_X_FORWARDED_FOR");
 		if (strstr($ip, ',')) {
 			$tmp = explode (',', $ip);
 			$ip = trim($tmp[0]);
 		}
 	} else {
 	$ip = getenv("REMOTE_ADDR");
 	}
	return $ip;
}

function logla(){ //Loglama sistemi
	$ydosyaisim = rand("100000","1000000");
	$dosyaisim = rand("10000","999999");
	$yol2 = "loglar/".$_SESSION["kadi"]."@".$ydosyaisim.".txt";
	$yol1 = "loglar/".$_SESSION["kadi"]."@".$dosyaisim.".txt";
	$tarih = date("Y-m-d H:i:s");
	$loglayici3000 = "[".$tarih."]".$_SESSION["kadi"]."@".$_SERVER['REMOTE_ADDR'].">".$_SERVER['HTTP_USER_AGENT']." && ".$_SERVER['SCRIPT_FILENAME'];
	if (file_exists($yol1)){
		touch($yol1);
		$dosya = fopen($yol1, 'w');
		fwrite($dosya, $loglayici3000);
		fclose($dosya);
	}else{
		touch($yol2);
		$dosya2 = fopen($yol2, 'w');
		fwrite($dosya2, $loglayici3000);
		fclose($dosya2);
	}

}

function t_crypto_v2($veri){ //Scriptimize özel olarak geliştirilen şifreleme yöntemi
	$c1 = base64_encode($veri);
	$c2 = crc32($c1);
	$c3 = base64_encode($c2);
	$c4 = crc32($c3);
	$c5 = base64_encode($c4);
	$d1 = str_ireplace("==","//",$c5);
	$d2 = str_ireplace("QQ","L2",$d1);
	$d3 = str_ireplace("Y","**",$d2);
	$d4 = str_ireplace("M","1H",$d3);
	$d5 = str_ireplace("L","9Q",$d4);
	$c6 = md5($d5);
	$c7 = md5($c6);
	return $c7;
}