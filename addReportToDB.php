<?php
	$category = $_REQUEST["category"];
	$latitude = $_REQUEST["latitude"];
	$longitude = $_REQUEST["longitude"];
	$description = $_REQUEST["description"];
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = '';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass);
	if (! $conn){
		die('Could not connect: ' . mysql_error());
	}
	echo 'Connected successfully\n';
	mysql_select_db('HACKTJ');
	#$sql = "CREATE TABLE reports(".
	#	"report_id INT NOT NULL AUTO_INCREMENT, ".
	#	"category TINYTEXT NOT NULL, ".
	#	"description TEXT NOT NULL, ".
	#	"num_confirmed INT NOT NULL, ".
	#	"num_resolved INT NOT NULL, ".
	#	"latitude FLOAT NOT NULL, ".
	#	"longitude FLOAT NOT NULL, ".
	#	"report_date DATE NOT NULL, ".
	#	"PRIMARY KEY (report_id));";
	#$retval = mysql_query ($sql, $conn);
	#if(!$retval){
	#	die('Could not create table:'.mysql_error());
	#}
	#echo 'Created Table\n';
	$date = date("y-m-d");
	$sql = "INSERT INTO reports(".
		"category, description, num_confirmed, num_resolved, latitude, longitude, report_date) ".
		"VALUES ".
		"('$category', '$description', 1, 0, '$latitude', '$longitude', '$date')";
	$retval = mysql_query($sql, $conn);
	if (!$retval){
		die('Could not enter data: ' . mysql_error());
	}
	echo "data entered successfully :)";
	mysql_close($conn);
?>
