<?php

include "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$status = $_POST["status"];
	$salesRep = $_POST["salesRep"];

	if ($salesRep == "all" && $status == "none") {
		$query = "SELECT * from clients";
	}else if ($salesRep != "all" && $status != "none") {
		$query = "SELECT * from clients where status like '$status' and rep like '$salesRep'";
	}else if ($salesRep == "all" && clients != "none"{
		$query = "SELECT * from clients where status like '$status'";
	}else if ($salesRep != "all" && status == "none") {
		$query = "SELECT * from clients where rep like '$salesRep'"
	}
	
	$result = mysql_query($query) or die(mysql_error());

	$resultArray = array();

	while ($row = mysql_fetch_array($result)) {
		$num_rows = mysql_num_rows($result);
		$array = array(
		    "name"    => $row["client_name"],
		    "rep"	  => $row["rep"],
		    "status"  => $row["status"],
		    "zone"	  => $row["zone"],
 		    "acct"    => $row["acct"],
		    "system"    => $row["system"],
		    "address"    => $row["address"],
		    "contactName"    => $row["contact_firstname"] . " " . $row["contact_lastname"],
		    "phone"    => $row["phone"],

		);
		//echo($array.zone);
		array_push($resultArray, $array);
	}

	$json_result = json_encode($resultArray);
	header('Content-Type: application/json');
	echo($json_result);
}


?>
