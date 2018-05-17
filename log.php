<?PHP
/* LOG */
//log.sql dosyasında yer aldığı gibi veri tabanı tablosu oluşturulur
//dbconn.php dosyasında yer aldığı gibi veritabanı bağlantısı kurulur
function newLog($CODE,$RESULT,$RESULT2){
	global $db;
	/* Codes: Default, Primary, Success, Info, Warning, Danger */
	$IP=$_SERVER['HTTP_X_FORWARDED_FOR'];
	if(!isset($IP)) {
		$IP=$_SERVER['REMOTE_ADDR'];
	}
	if (!isset($_SERVER['HTTP_REFERER'])){
		$REFERRER="-";
	}else{
		$REFERRER=$_SERVER['HTTP_REFERER'];
	}
	if (!isset($_SERVER['HTTP_USER_AGENT'])){
		$HTTP_USER_AGENT="-";
	}else{
		$HTTP_USER_AGENT=$_SERVER['HTTP_USER_AGENT'];
	}
	$SCRIPT_NAME=$_SERVER['SCRIPT_NAME'];
	$newLog=$db->prepare("INSERT INTO log (IP,UID,DATE,PAGE,CODE,RESULT,RESULT2,AGENT,REFERRER,EMAIL) VALUES (:IP, :UID, :DATE, :PAGE, :CODE, :RESULT, :RESULT2, :AGENT, :REFERRER, :EMAIL)");
	if (!isset($_SESSION["EMAIL"])){
		$Tempusername="-";
	}else{
		$Tempusername=$_SESSION["EMAIL"];
	}
	if(isset($_COOKIE['UID'])){
		$UID=$_COOKIE['UID'];
	}else{
		$UID="-";
	}
  //timestamp.php dosyasında bulunan timestamp() fonksiyonu ile zaman damgası İstanbul'a göre ayarlanır
	$newLog->execute(array('IP' => $IP, 'UID' => $UID, 'DATE' => timestamp(), 'PAGE' => $SCRIPT_NAME, 'CODE' => $CODE, 'RESULT' => $RESULT, 'RESULT2' => $RESULT2, 'AGENT' => $HTTP_USER_AGENT, 'REFERRER' => $REFERRER, 'EMAIL' => $Tempusername));
}
?>
