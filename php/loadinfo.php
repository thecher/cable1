<?php

include "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$salesRep = $_POST["salesRep"];
	$status = $_POST["status"];

	if ($salesRep != "all" && $status == "none") {
		$query = "SELECT * from clients where rep like '$salesRep'";
	}else if ($salesRep != "all" && $status != "none") {
		$query = "SELECT * from clients where rep like '$salesRep' and status like '$status'";
	}else {
		$query = "SELECT * from clients";
	}

	$result = mysql_query($query) or die(mysql_error());

	$resultArray = array();

	while ($row = mysql_fetch_array($result)) {
		$num_rows = mysql_num_rows($result);
		//$notes = array();
		//$notesQuery = "SELECT * from notes where acct like '$row["acct"]'";
		$array = array(
		    "name"   		 => $row["client_name"],
		    "rep"	  	     => $row["rep"],
		    "status" 		 => $row["status"],
		    "zone"	 		 => $row["zone"],
 		    "acct"   		 => $row["acct"],
		    "system"   		 => $row["system"],
		    "address"   	 => $row["address"],
		    "contactName"    => $row["contact_firstname"] . " " . $row["contact_lastname"],
		    "phone"    		 => $row["phone"],
		    "notes" 		 => $notes;
		);
		//echo($array.zone);
		array_push($resultArray, $array);
	}

	$json_result = json_encode($resultArray);
	header('Content-Type: application/json');
	echo($json_result);
}


?>
