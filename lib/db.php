	<?php
	$host = 'localhost' ;
	$dbUser ='root';
	$dbPass ='';
	$dbName ='UserReview';

	include_once '../lib/MYSQLDB.php'; 

	$db = new MySQL( $host, $dbUser, $dbPass, $dbName);
	$db->createDatabase();
	$db->selectDatabase();
	?>
