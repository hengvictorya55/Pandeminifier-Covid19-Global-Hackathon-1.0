<!DOCTYPE html>
<html>
<head>
	<title>Pandeminifier</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js.js?<?=uniqid()?>"></script>
	<style>
	body{
		margin:0;
		padding:0;
	}
	#top{
		position:fixed;
		top:20px;
		right:20px;
		z-index:99999;
		text-align:right;
	}
	#top img{
		width:50px;
	}
	#bottom{
		position:fixed;
		bottom:0;
		left:0;
		width:100%;
		height:70px;
		z-index:99999;
		background: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,1));
	}
	.item{
		float:left;
		width:32vw;
		margin-left:0.66vw;
		margin-right:0.66vw;
		margin-top:5px;
		margin-bottom:0px;
		border-radius:20px;
		box-sizing:border-box;
		padding:3px;
		background:white;
		align-items: center;
		align-content: center;
		display: flex;
		justify-content: center;
		font-size:7px;
	}
	.item img{
		height:20px;
		margin-right:2px;
	}
	</style>
	
</head>
<body>



<div id="mapid" style="width: 100vw; height: 100vh;"></div>

<div id="top">
	<img src="current.png?<?=uniqid()?>"/>
</div>

<div id="bottom">
<center>
	<div class="item" value="1" style="background: #e0e0e0;"><img src="p1.png"/>COUGH</div>
	<div class="item" value="2"><img src="p2.png?<?=uniqid()?>"/>HIGH TEMPERATURE</div>
	<div class="item" value="3"><img src="p3.png?<?=uniqid()?>"/>DIFFICULT BREATHING</div>
	<div class="item" value="4"><img src="p4.png?<?=uniqid()?>"/>HEADACHE</div>
	<div class="item" value="5"><img src="p5.png?<?=uniqid()?>"/>CLOSE CONTACTED</div>
	<div class="item" value="6"><img src="p6.png?<?=uniqid()?>"/>WENT TO INFECTED AREA</div>
	<div style="clear:both"></div>
</center>
</div>
 


</body>
</html>
