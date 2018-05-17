<?PHP
/* Zaman damgasını İstanbul'a göre ayarlar */
function timestamp(){
	$tz = 'Europe/Istanbul';
	$timestampTemp = time();
	$dt = new DateTime("now", new DateTimeZone($tz));
	$dt->setTimestamp($timestampTemp);
	$timestamp =  $dt->format('Y-m-d H:i:s');
	return $timestamp;
}
?>
