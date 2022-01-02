<?php
include "db.php";
include "function.php";
ini_set('error_log', 'log');

$data = [];
$data["DISTINCT(uid)"] = "";
$data["time"] = "";
$data["lat"] = "";
$data["lng"] = "";
$select = "";
if($_GET['q']=="1"){
	$select = actionDB($conn,"select","data",$data,"WHERE cough='1' ORDER BY time ASC");
}
if($_GET['q']=="2"){
	$select = actionDB($conn,"select","data",$data,"WHERE temperature='1' ORDER BY time ASC");
}
if($_GET['q']=="3"){
	$select = actionDB($conn,"select","data",$data,"WHERE breath='1' ORDER BY time ASC");
}
if($_GET['q']=="4"){
	$select = actionDB($conn,"select","data",$data,"WHERE headache='1' ORDER BY time ASC");
}
if($_GET['q']=="5"){
	$select = actionDB($conn,"select","data",$data,"WHERE touched='1' ORDER BY time ASC");
}
if($_GET['q']=="6"){
	$select = actionDB($conn,"select","data",$data,"WHERE infectedsite='1' ORDER BY time ASC");
}
$data = [];
foreach($select as $s){
	array_push($data,[$s['lat'],$s['lng']]);
}
echo json_encode($data);
?>