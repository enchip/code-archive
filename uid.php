<?PHP
/* UID (Unique Identifier - Benzersiz Tanımlayıcı) oluşturur */
if(count($_COOKIE) > 0) {
  if(!isset($_COOKIE['UID'])){
    $IPTemp=$_SERVER['HTTP_X_FORWARDED_FOR'];
	  if(!isset($IPTemp)) {
		$IPTemp=$_SERVER['REMOTE_ADDR'];
	  }
    $UID=$IPTemp.date("Y-m-d H:i:s");
    setcookie("UID", MD5($UID), time() + (365*60*60*24), "", "", "TRUE", "TRUE");
  }else{
    setcookie("UID", $_COOKIE['UID'], time() + (365*60*60*24), "", "", "TRUE", "TRUE");
  }
}else{
  //header("Location:error.php");
  //die();
}
?>
