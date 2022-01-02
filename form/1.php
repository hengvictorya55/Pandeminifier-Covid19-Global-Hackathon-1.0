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
				var lat;
				var lng;
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(function(p){
						lat = p.coords.latitude;
						lng = p.coords.longitude;
					});
				}else {
					//x.innerHTML = "Geolocation is not supported by this browser.";
				}
				
				var breath = "";
				var temperature = "";
				var headache = "";
				var cough = "";
				var touched = "";
				var infectedsite = "";
				
				
				
				$(".submit").click(function(){
					if($("#breathId1").is(":checked")){
						breath = "1";
					}else if($("#breathId2").is(":checked")){
						breath = "0";
					}
					
					if($("#temperatureId1").is(":checked")){
						temperature = "1";
					}else if($("#temperatureId2").is(":checked")){
						temperature = "0";
					}
					
					if($("#headacheId1").is(":checked")){
						headache = "1";
					}else if($("#headacheId2").is(":checked")){
						headache = "0";
					}
					
					
					if($("#coughtId1").is(":checked")){
						cough = "1";
					}else if($("#coughtId2").is(":checked")){
						cough = "0";
					}
					
					if($("#touchId1").is(":checked")){
						touched = "1";
					}else if($("#touchId2").is(":checked")){
						touched = "0";
					}
					
					if($("#infetchedId1").is(":checked")){
						infectedsite = "1";
					}else if($("#infetchedId2").is(":checked")){
						infectedsite = "0";
					}

					if(breath!="" && temperature!="" && headache!="" && cough!="" && touched!="" && infectedsite!=""){
						$("#loading").show();
						$(".reloading").text("SUBMITTING...");
						$.post("update.php", {record: true, uid: "<?=$uid?>", b: breath, t: temperature, h: headache, c: cough, t: touched, i: infectedsite, plat: lat, plng: lng}, function(result){
							console.log("Update success");
							$(".loadingimg").hide();
							$(".tickimg").show();
							$(".reloading").text("DONE!");
						});
					}else{
						alert("Please fill all the form");
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
					<div class="reloading"></div>
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
							<img src="images/icon-cough.png?<?=uniqid()?>"/>
						</div>
						<div class="content">
							<center>
								<div class="question">DO YOU HAVE A COUGH?</div>
								<div class="radiowrap"><form>
									<input type="radio" class="" id="coughtId1" name="gender" />
									<label class="" for="coughtId1" >YES</label>
									<input type="radio" class="" id="coughtId2" name="gender" />
									<label class="" for="coughtId2" >NO</label>
								</form></div>
							</center>
						</div>
					</div>
					<div style="clear:both"></div>
					
					<div class="row">
						<div class="picture">
							<img src="images/icon-temperature.png?<?=uniqid()?>"/>
						</div>
						<div class="content">
							<center>
								<div class="question">DO YOU HAVE HIGH TEMPERATURE?</div>
								<div class="radiowrap"><form>
									<input type="radio" class="" id="temperatureId1" name="gender" />
									<label class="" for="temperatureId1" >YES</label>
									<input type="radio" class="" id="temperatureId2" name="gender" />
									<label class="" for="temperatureId2" >NO</label>
								</form></div>
							</center>
						</div>
					</div>
					<div style="clear:both"></div>
					
					<div class="row">
						<div class="picture">
							<img src="images/icon-breath.png?<?=uniqid()?>"/>
						</div>
						<div class="content">
							<center>
								<div class="question">ARE YOU DIFFICULT TO BREATH?</div>
								<div class="radiowrap"><form>
									<input type="radio" class="" id="breathId1" name="gender" />
									<label class="" for="breathId1" >YES</label>
									<input type="radio" class="" id="breathId2" name="gender" />
									<label class="" for="breathId2" >NO</label>
								</form></div>
							</center>
						</div>
					</div>
					<div style="clear:both"></div>
					
					
					
					<div class="row">
						<div class="picture">
							<img src="images/icon-headache.png?<?=uniqid()?>"/>
						</div>
						<div class="content">
							<center>
								<div class="question">DO YOU HAVE A HEADACHE?</div>
								<div class="radiowrap"><form>
									<input type="radio" class="" id="headacheId1" name="gender" />
									<label class="" for="headacheId1" >YES</label>
									<input type="radio" class="" id="headacheId2" name="gender" />
									<label class="" for="headacheId2" >NO</label>
								</form></div>
							</center>
						</div>
					</div>
					<div style="clear:both"></div>
					
					
					
					<div class="row">
						<div class="picture">
							<img src="images/icon-touch.png?<?=uniqid()?>"/>
						</div>
						<div class="content">
							<center>
								<div class="question">HAVE YOU EVER BEEN IN CLOSE CONTACT WITH A PATIENT?</div>
								<div class="radiowrap"><form>
									<input type="radio" class="" id="touchId1" name="gender" />
									<label class="" for="touchId1" >YES</label>
									<input type="radio" class="" id="touchId2" name="gender" />
									<label class="" for="touchId2" >NO</label>
								</form></div>
							</center>
						</div>
					</div>
					<div style="clear:both"></div>
					
					<div class="row">
						<div class="picture">
							<img src="images/icon-crowdy.png?<?=uniqid()?>"/>
						</div>
						<div class="content">
							<center>
								<div class="question">HAVE YOU EVER BEEN TO AN INFECTED SITE?</div>
								<div class="radiowrap"><form>
									<input type="radio" class="" id="infetchedId1" name="gender" />
									<label class="" for="infetchedId1" >YES</label>
									<input type="radio" class="" id="infetchedId2" name="gender" />
									<label class="" for="infetchedId2" >NO</label>
								</form></div>
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
