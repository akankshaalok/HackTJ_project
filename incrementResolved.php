<?php
	$latitude = $_REQUEST['latitude'];
	$longitude = $_REQUEST['longitude'];
	$inc_val = $_REQUEST['inc_val'];
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = '';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass);
	if (! $conn){
		die('Could not connect: ' . mysql_error());
	}
	echo 'Connected successfully\n';
	mysql_select_db('HACKTJ');
	$sql = "UPDATE reports SET num_resolved = num_resolved + '$inc_val' ".
		"WHERE latitude > '$latitude'- 0.01 AND latitude < '$latitude'+ 0.01 AND longitude > '$longitude' - 0.01 AND longitude < '$longitude' + 0.01";
	$retval = mysql_query($sql, $conn);
	if (!$retval){
		die('Could not update: ' .mysql_error());
	}
	echo "Updated successfully\n";
	mysql_close($conn);
?>
