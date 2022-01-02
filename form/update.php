<?php
include "../db.php";
include "../function.php";
ini_set('error_log', 'log');
$uid = $_POST['uid'];

if(isset($_POST['info'])){
	$data = [];$data['name']='';$data['mid']="";
	$select = actionDB($conn,"select","users",$data,"WHERE uid='".$uid."' AND step='1'");
	if($select!=false){
		$sender = $select[0]['mid'];
		$data = [];
		$data['name']=$_POST['name'];
		$data['age']=$_POST['age'];
		$data['gender']=$_POST['gen'];
		$data['step']= "2";
		actionDB($conn,"update","users",$data,"WHERE uid='".$uid."'");
		send($sender,textTemplate("Thank you for filling out your information."));
		$array = [];
		$array[0] = "Answer Health Questions|https://pandeminifier.com/a/1.php?uid=".$uid."|web";
		$answer = postbackButtonTemplate("Please help us by answering your health check daily. This is not only to keep track of your health, but also to provide data to other people and help the whole community.\nDon't worry, we won't tell your personal information such as name, age, and gender to other users.",$array);
		send($sender,$answer);
	}
}

if(isset($_POST['record'])){
	$data = [];$data['name']='';$data['mid']="";
	$select = actionDB($conn,"select","users",$data,"WHERE uid='".$uid."' AND step='2'");
	if($select!=false){
		$sender = $select[0]['mid'];
		
		$data = [];
		$data['uid'] = $uid;
		$data['time'] = date("Ymd");
		$data['lng'] = $_POST['plng'];
		$data['lat'] = $_POST['plat'];
		$data['breath'] = $_POST['b'];
		$data['temperature'] = $_POST['t'];
		$data['cough'] = $_POST['c'];
		$data['headache'] = $_POST['h'];
		$data['touched'] = $_POST['t'];
		$data['infectedsite'] = $_POST['i'];
		$select = actionDB($conn,"select","data",$data,"WHERE uid='".$uid."' AND time='".$data['time']."'");
		if($select!=false){
			echo "3";
			actionDB($conn,"update","data",$data,"WHERE uid='".$uid."' AND time='".$data['time']."'");
		}else{
			actionDB($conn,"insert","data",$data);
		}
		$answer = textTemplate("Thank you for answering the questions and taking a part of helping the community by providing your health data. Stay Safe, Stay Healthly :)");
		send($sender,$answer);
		
		$array = [];
		$array[0]['image'] = "https://pandeminifier.com/profile.png";
		$array[0]['title'] = "Pandeminifier";
		$array[0]['buttons'][0]["web"] = "https://pandeminifier.com";
		$array[0]['buttons'][0]["text"] = "View Map";
		
		$array[0]['buttons'][1]["web"] = "https://pandeminifier.com/a/1.php?uid=".$uid;
		$array[0]['buttons'][1]["text"] = "Answer Health Questions";
		
		$array[0]['buttons'][2]["text"] = "View Health Records";
		
		
		$answer = genericTemplate($array);
		send($sender,$answer,"","NO_PUSH");
	}
}


?>