<?php
include "../db.php";
include "../function.php";
$uid = $_GET['uid'];
$data = [];$data['name']='';
$select = actionDB($conn,"select","users",$data,"WHERE uid='".$uid."'");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="css/style.css?<?=uniqid()?>">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<title>Pandeminifier</title>
		<script>
		$(document).ready(function(){
			$('.submit').click(function(){
				var gender = "";
				if($("#genderId1").is(":checked")){
					gender = "m";
				}else if($("#genderId2").is(":checked")){
					gender = "f";
				}
				

				if(gender!="" && isNaN($("#age").val())==false && $("#age").val()!="" && $("#name").val()!=""){
					$("#loading").show();
					$(".reloading").text("SUBMITTING...");
					$.post("update.php", {info: true, uid: "<?=$uid?>", name: $("#name").val(), age: $("#age").val(), gen: gender}, function(result){
						console.log("Update success");
						$(".loadingimg").hide();
						$(".tickimg").show();
						$(".reloading").text("DONE!");
					});
				}else{
					alert("Please enter everything correctly");
				}
			});
		});
	</script>
	</head>
	<body>
		<div id="background"></div>
		<div id="loading">
			<center>
				<div class="loadwrap">
					<div class="reloading">RELOADING...</div>
					<img class="loadingimg"src="images/loading.gif"/>
					<img class="tickimg" src="images/tick.png" style="display:none;max-width: 100px;margin-top:20px;"/>
				</div>
			</center>
		</div>
		
		<div id="table">
			<div class="table-row">
				<div id="container">
					<div class="row">
						<div class="picture">
							<img src="images/icon-name.png?<?=uniqid()?>"/>
						</div>
						<div class="content">
							<center>
								<div class="question">ENTER YOUR NAME</div>
								<input id="name" type="text" value="<?=$select[0]['name']?>" placeholder="ENTER YOUR NAME HERE"></input>
							</center>
						</div>
					</div>
					<div style="clear:both"></div>
					<div class="row">
						<div class="picture">
							<img src="images/icon-age.png?<?=uniqid()?>"/>
						</div>
						<div class="content">
							<center>
								<div class="question">ENTER AGE</div>
								<input type="number" id="age" value="" placeholder="ENTER YOUR AGE HERE" min="13" max="100"></input>
							</center>
						</div>
					</div>
					<div style="clear:both"></div>
					<div class="row">
						<div class="picture">
							<img src="images/icon-gender.png?<?=uniqid()?>"/>
						</div>
						<div class="content">
							<center>
								<div class="question">SELECT YOUR GENDER</div>
								<div class="radiowrap">
									<input type="radio" class="" id="genderId1" name="gender" />
									<label class="" for="genderId1" >MALE</label>
									<input type="radio" class="" id="genderId2" name="gender" />
									<label class="" for="genderId2" >FEMALE</label>
								</div>
							</center>
						</div>
					</div>
					<div style="clear:both"></div>
					<div class="row" style="justify-content: center;border-bottom:0px solid black;">
						<center>
							<div id="submitwrap">
								<div class="submit">SUBMIT</div>
							</div>
						</center>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>
		</div>
	</body>
</html>
