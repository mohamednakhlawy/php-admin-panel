<?php
$servername = "localhost";
$db_name    = "project2";
$username   = "root";
$password   = "Nakhlawi!122-Lp";
try {
	$DB = new PDO("mysql:host=$servername;dbname=".$db_name, $username, $password);
	$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo "Connection failed: " . $e->getMessage();
}
// get config
$statement = $DB->prepare("select * from `config` ");
$statement->execute();
$data = $statement->fetchAll();
$config = [];
foreach ($data as $row) {
	$config[$row['key']] = $row['value'];
}
