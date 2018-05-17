<?PHP
$ip_temp = GetIP();
//ip.php dosyasında bulunan GetIP() fonksiyonu ile IP adresi alınır
//ipdirectory.sql dosyasında yer aldığı gibi veri tabanı tablosu oluşturulur
//dbconn.php dosyasında yer aldığı gibi veritabanı bağlantısı kurulur
//timestamp.php dosyasında bulunan timestamp() fonksiyonu ile zaman damgası İstanbul'a göre ayarlanır
$statusIP=$db->prepare("SELECT COUNT(*) AS countIP FROM IPDirectory WHERE IP=:IP AND DATETIME > '".timestamp()."' - INTERVAL 1 MINUTE");
$statusIP->execute(array('IP' => $ip_temp));
$statusIP=$statusIP->fetch();
$countIP=$statusIP['countIP'];

if($ip_temp=="AA.BB.CC.DD" || $ip_temp=="EE.FF.GG.HH"){
	$countLIMIT="500";
  // Tanımlanan IP adresleri için limit ayarı
}else{
	$countLIMIT="12";
  // Tanımlanmamış IP adresleri için limit ayarı
}
if ($countIP>$countLIMIT){
	$ip_status="Block";
	$insertIP=$db->prepare("INSERT INTO IPDirectory (IP,STATUS,DATETIME) VALUES (:IP, :STATUS, :DATETIME)");
	$insertIP->execute(array('IP' => $ip_temp, 'STATUS' => $ip_status, 'DATETIME' => timestamp()));
	header("Location:error.php");
	die();
}else{
	$ip_status="Allow";
	$insertIP=$db->prepare("INSERT INTO IPDirectory (IP,STATUS,DATETIME) VALUES (:IP, :STATUS, :DATETIME)");
	$insertIP->execute(array('IP' => $ip_temp, 'STATUS' => $ip_status, 'DATETIME' => timestamp()));
}
?>
