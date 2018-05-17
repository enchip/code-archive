<?PHP
try {
	$db = new PDO('mysql:host=localhost;dbname=DBNAME', 'DBUSER', 'DBPASS');
	$db -> exec("set names UTF8");
	}catch (PDOException $e){
}
?>
