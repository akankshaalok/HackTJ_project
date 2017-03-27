<?php
	$latitude = $_REQUEST['latitude'];
	$longitude = $_REQUEST['longitude'];
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = '';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass);
	if (! $conn){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('HACKTJ');
	$query = "SELECT * FROM reports ".
		"WHERE latitude > '$latitude'- 0.01 AND latitude < '$latitude'+ 0.01 AND longitude > '$longitude' - 0.01 AND longitude < '$longitude' + 0.01".
		"LIMIT 0,1";
	$result = mysql_query($query, $conn);
	$res = mysql_fetch_assoc($result);
	$category = $res['category'];
	$description = $res['description'];
	$num_confirmed = $res['num_confirmed'];
	$num_resolved = $res['num_resolved'];
	$date = $res['report_date'];
	echo "Category: {$res['category']} <br> ".
		"Description: {$res['description']} <br> ".
		"Confirmed by {$res['num_confirmed']} users <br> ".
		"Marked Resolved by {$res['num_resolved']} users <br> ".
		"Reported on {$res['report_date']} <br>";
?>
