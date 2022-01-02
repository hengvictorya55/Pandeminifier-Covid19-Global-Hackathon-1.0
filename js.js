var meIcon = L.icon({
	iconUrl: 'me.png',
	iconSize:     [10, 10],
	iconAnchor:   [5, 5],
	popupAnchor:  [-3, -76]
});


var redIcon = L.icon({
	iconUrl: 'p1.png',
	iconSize:     [10, 14],
	iconAnchor:   [5, 14],
	popupAnchor:  [-3, -76]
});

var iconUrl = 'p1.png';
var iconSize =  [10, 14];
var iconAnchor= [5, 14];
var popupAnchor= [-3, -76];
var pointColor = "#f5010e";	

var layerGroup = L.layerGroup();		
var meGroup = L.layerGroup();		
var datas = [];
var datass = [];
datass[1] = [];
datass[2] = [];
datass[3] = [];
datass[4] = [];
datass[5] = [];
datass[6] = [];
		
$(document).ready(function(){
	
});

var melat = 0;
var melng = 0;

$(document).ready(function(){
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position){
			
			$("#top").click(function(){
				 mymap.setView(new L.LatLng(melat, melng), 15);
			});
			
			var mbAttr = '';
			var mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
			var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr});
			var mymap = L.map('mapid', {
				center: [ melat, melng],
				zoom: 7,
				minZoom: 6,
				maxZoom: 30,
				layers: [grayscale, L.layerGroup()]
			});
			
			layerGroup.addTo(mymap);
			meGroup.addTo(mymap);
			
		
			meIcon = L.icon({
				iconUrl: 'me.png',
				iconSize:     [14*(13-12), 14*(13-12)],
				iconAnchor:  [5*(13-12), 5*(13-12)],
				popupAnchor:  [-3, -76]
			});
			L.marker( [melat, melng], {icon: meIcon}).addTo(meGroup);
			
			for(var i=0;i<100;i++){
				//datas.push([(11677859 + (Math.floor(Math.random() * (11446447-12777859))))/1000000, -(104711650 + (Math.floor(Math.random() * (104914897-103511650))))/1000000]);
			}
			
			$.get("getdata.php?q=1", function(data, status){
			  datass[1] = JSON.parse(data);
			 datas = datass[1];
			 melat = position.coords.latitude;
			 melng = position.coords.longitude; 
			// melat = datas[20][0];
			// melng = datas[20][1];
			  //mymap.setView(new L.LatLng(datas[0][0], datas[0][1]), 16);
			  mymap.setView(new L.LatLng(melat, melng), 15);
				test();
			});
			
			

			mymap.on("zoomend", function(){
				test();
			});
			
			mymap.on("dragend", function(){
				test();
			});
			
			$(".item").click(function(){
				$(".item").attr("style","");
				$(this).attr("style","background: #e0e0e0;");
				var thisvalue = $(this).attr("value");
				datas = [];
				layerGroup.clearLayers();
				console.log($(this).attr("value"));
				iconUrl = 'p'+$(this).attr("value")+'.png';
				if(thisvalue==1){
					pointColor = "#f5010e";
				}
				if(thisvalue==2){
					pointColor = "#f5b700";
				}
				if(thisvalue==3){
					pointColor = "#089ff5";
				}
				if(thisvalue==4){
					pointColor = "#1bcd03";
				}
				if(thisvalue==5){
					pointColor = "#f40cb3";
				}
				if(thisvalue==6){
					pointColor = "#bd08f5";
				}
				
				if(datass[thisvalue].length==0){
					$.get("getdata.php?q="+$(this).attr("value"), function(data, status){
						datass[thisvalue] = JSON.parse(data);
					  datas = datass[thisvalue];
					  test();
					});
				}else{
					datas = datass[thisvalue];
					  test();
				}
			});
			
			function test(){
				var bound = mymap.getBounds();
				zoomLev = mymap.getZoom();
				console.log("zoom",zoomLev);
				var szoom = 9;
				layerGroup.clearLayers();
				meGroup.clearLayers();
				
				var meZoomLev = (zoomLev-12);
				if(zoomLev<13){
					meZoomLev = (13-12);
				}
				//var radius = (1/11)*77/0.0007071067811886678;
				//radius=1;
				
				//L.circle([position.coords.latitude, position.coords.longitude], radius, {
				//	color: 'red',
				//	fillColor: 'red',
				//	fillOpacity: 0.3,
				//	weight: 0,
				//	opacity: 0.1, 
				//}).addTo(meGroup).bindPopup("I am a circle.");
						
				meIcon = L.icon({
					iconUrl: 'me.png',
					iconSize:     [14*meZoomLev, 14*meZoomLev],
					iconAnchor:  [5*meZoomLev, 5*meZoomLev],
					popupAnchor:  [-3, -76]
				});
				L.marker( [melat, melng], {icon: meIcon}).addTo(meGroup);
				
				if(zoomLev>=szoom){
					for(var i=0;i<datas.length;i++){
						var data = datas[i];
						//console.log(data[0],bound['_southWest']['lat']);
						if(data[0]>bound['_southWest']['lat'] && data[0]<bound['_northEast']['lat'] && data[1]>bound['_southWest']['lng'] && data[1]<bound['_northEast']['lng']){
							//console.log(data);
							if(zoomLev<13){
								L.circle(data, 1, {
									color: pointColor,
									fillColor: pointColor,
									fillOpacity: 0.5
								}).addTo(layerGroup).bindPopup("I am a circle.");
							}else{
								iconSize = [10*(zoomLev-12), 14*(zoomLev-12)];
								iconAnchor = [5*(zoomLev-12), 14*(zoomLev-12)];
								redIcon = L.icon({
									iconUrl: iconUrl,
									iconSize:     iconSize,
									iconAnchor:  iconAnchor,
									popupAnchor:  popupAnchor
								});
								L.marker(data, {icon: redIcon}).addTo(layerGroup);
							}
						}
						
					}
				}else if(zoomLev>=1222){
					var slice = Math.floor(26-Math.pow(5,0.31*(szoom-zoomLev)));
					if(zoomLev>=11){
						slice = 50;
					}else{
						slice = 20;
					}
					var gdata = [];
					var w=(bound['_northEast']['lat']-bound['_southWest']['lat'])/slice;
					var h=(bound['_northEast']['lng']-bound['_southWest']['lng'])/slice;
					for(var i=0;i<slice;i++){
						for(var ii=0;ii<slice;ii++){
							var min0 = bound['_southWest']['lat'] + (w*i);
							var max0 = bound['_southWest']['lat'] + (w*(i+1));
							var min1 = bound['_southWest']['lng'] + (h*ii);
							var max1 = bound['_southWest']['lng'] + (h*(ii+1));
							//console.log(min0,max0,min1,max1);
							gdata[(i*slice)+ii] = [];
							for(var j=0;j<datas.length;j++){
								var data = datas[j];
								if(data[0]>min0 && data[0]<max0 && data[1]>min1 && data[1]<max1){
									//console.log((i*10)+ii);
									gdata[(i*slice)+ii].push(data);
								}  
							}
						}
					}
					//console.log(gdata);
					
					for(var i=0;i<gdata.length;i++){
						var lat = 0;
						var lng = 0;
						var maxLength = 0;
						for(var j=0;j<gdata[i].length;j++){
							var data = gdata[i][j];
							lat += parseInt(data[0]);
							lng += parseInt(data[1]);
							console.log(lng);
						}
						if(gdata[i].length>0){
							lat /= gdata[i].length;
							lng /= gdata[i].length;
							for(var j=0;j<gdata[i].length;j++){
								var data = gdata[i][j];
								var length = Math.sqrt(Math.pow(lat-data[0],2)+Math.pow(lng-data[1],2));
								if(length>maxLength){
									maxLength=length;
								}
							}
						}
						var radius = maxLength*77/0.0007071067811886678;
						//radius=1;
						
						L.circle([lat,lng], radius, {
							color: 'red',
							fillColor: 'red',
							fillOpacity: 0.3,
							weight: 0,
							opacity: 0.1, 
						}).addTo(layerGroup).bindPopup("I am a circle.");
						
						
					}
				}
			}

		});
	}else{
		//x.innerHTML = "Geolocation is not supported by this browser.";
	}
});

