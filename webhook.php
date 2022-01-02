<?php
include "db.php";
include "function.php";
ini_set('error_log', 'log');
$hubVerifyToken = 'handsome';
if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
  echo $_REQUEST['hub_challenge'];
  exit;
}

$ref = "";
$message = "";
$postback = "";
$sender="123123";
$answer = textTemplate("hi");
$attachments = [];
if(1==1){
	$input = json_decode(file_get_contents('php://input'), true);
	file_put_contents("b.txt",json_encode($input)); 
	$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
	$message = $input['entry'][0]['messaging'][0]['message']['text'];
	$postback = $input['entry'][0]['messaging'][0]['postback']['payload'];
	if($postback!=""){
		$message = $postback;
	}
	if($input['entry'][0]['messaging'][0]['message']['attachments']!=null){
		$attachments = $input['entry'][0]['messaging'][0]['message']['attachments'];
	}
	if($input['entry'][0]['messaging'][0]['postback']['referral']['ref']!=null){
		$ref = $input['entry'][0]['messaging'][0]['postback']['referral']['ref'];
	}else if($input['entry'][0]['messaging'][0]['referral']['ref']!=null){
		$ref = $input['entry'][0]['messaging'][0]['referral']['ref'];
	}
}




$data = [];$data['mid']='';$data['step']="";$data['uid']="";$data['name']="";
$select = actionDB($conn,"select","users",$data,"WHERE mid='".$sender."'");
if($select==false){
	$uid = uniqid();
	$data = [];
	$data['uid'] = $uid;
	$data['name'] = getname($sender);
	$data['mid'] = $sender;
	$data['step'] = "1";
	actionDB($conn,"insert","users",$data);
	
	$array = [];
	$array[0] = "Fill Information|https://pandeminifier.com/a/?uid=".$uid."|web";
	$answer = postbackButtonTemplate("Welcome to Pandeminifier! Please fill in your age and gender by clicking the button below.",$array);
	send($sender,$answer);
	
}else{
	$uid = $select[0]['uid'];
	if($select[0]['step']=="1"){
		$array = [];
		$array[0] = "FILL INFORMATION|https://pandeminifier.com/a/?uid=".$uid."|web";
		$answer = postbackButtonTemplate("Welcome to Pandeminifier! Please fill in your age and gender by clicking the button below.",$array);
		send($sender,$answer);
	}else{
		if($message=="View Health Records"){
			send($sender,[],"typing_on");
			$answer = [];
			$answer['attachment']['type'] ="image";
			$answer['attachment']['payload']['url'] = "https://i.imgur.com/D0EYEek.png";
			$answer['attachment']['payload']['is_reusable'] = 'true';
			send($sender,$answer);
		}else{
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
			
			$array = [];
			$array[0]['image'] = "https://i.imgur.com/vkc1lxx.png";
			$array[0]['title'] = "Coughing";
			$array[0]['buttons'][0]["web"] = "https://pandeminifier.com";
			$array[0]['buttons'][0]["text"] = "View Map";
			
			$array[1]['image'] = "https://i.imgur.com/7YJkrVk.png";
			$array[1]['title'] = "High Temperature";
			$array[1]['buttons'][0]["web"] = "https://pandeminifier.com";
			$array[1]['buttons'][0]["text"] = "View Map";
			
			$array[2]['image'] = "https://i.imgur.com/LaD1iWT.png";
			$array[2]['title'] = "Difficulty Breathing";
			$array[2]['buttons'][0]["web"] = "https://pandeminifier.com";
			$array[2]['buttons'][0]["text"] = "View Map";
			
			$array[3]['image'] = "https://i.imgur.com/vsrVSRw.png";
			$array[3]['title'] = "Headache";
			$array[3]['buttons'][0]["web"] = "https://pandeminifier.com";
			$array[3]['buttons'][0]["text"] = "View Map";
			
			$array[4]['image'] = "https://i.imgur.com/z6Avzql.png";
			$array[4]['title'] = "Close Contact With Patient";
			$array[4]['buttons'][0]["web"] = "https://pandeminifier.com";
			$array[4]['buttons'][0]["text"] = "View Map";
			
			$array[5]['image'] = "https://i.imgur.com/ZTNBnM3.png";
			$array[5]['title'] = "Been To Infected Area";
			$array[5]['buttons'][0]["web"] = "https://pandeminifier.com";
			$array[5]['buttons'][0]["text"] = "View Map";
			$answer = genericTemplate($array);
		}
	}
}

?>