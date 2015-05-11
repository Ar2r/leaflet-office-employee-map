<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Lang" content="en">
<meta name="author" content="">
<meta http-equiv="Reply-to" content="@.com">
<meta name="generator" content="PhpED 6.0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="creation-date" content="06/01/2011">
<meta name="revisit-after" content="15 days">
<title>Leaflet office rooms</title>

<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.css" />
 <!--[if lte IE 8]>
     <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.ie.css" />
 <![endif]-->
  <script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>
  <script src="http://yandex.st/jquery/2.0.3/jquery.min.js"></script>

</head>
<body>
  <style>
  #map { height: 100%; }
  .br_radius {
-moz-border-radius: 5px;
border-radius: 5px;
	border:1px solid black;
	  -moz-box-shadow:    0px 0px 3px 3px #ff0005;
  -webkit-box-shadow: 0px 0px 3px 3px #ff0005;
  box-shadow:         0px 0px 3px 3px #ff0005;
} 
  </style>

  <a href="?action=view">View</a> | 
  <?for($i=1;$i<10;$i++){?>
  <a href="?user_id=<?=$i?>">Mark user<?=$i?></a> [<a href="?find=<?=$i?>">??</a>] | 
  <?}?>
  
  <div id="map"></div>
  
  <script>
var map = L.map('map').setView([0, 0], 9);
map.dragging.disable();
map.touchZoom.disable();
map.doubleClickZoom.disable();
map.scrollWheelZoom.disable();
var popup = L.popup();
var marker = [];

var imageUrl = 'img/map.jpg',
    imageBounds = [[-0.7, -1.5], [0.7, 1.5]];

L.imageOverlay(imageUrl, imageBounds).addTo(map);
	
$(document).ready(function () {


<? if(isset($_GET['user_id'])){?>
	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent("You clicked the map at " + e.latlng.toString())
			.openOn(map);
			
			$.get("json.php", {user_id: <?=$_GET['user_id']?>,  name: "John", lat: e.latlng.lat, lng: e.latlng.lng} );
	}
	map.on('click', onMapClick);

<? }else{ ?>

points  = $.getJSON("json.php", function(data) {
	$.each(data.points, function(key, val) {
	var myIcon = L.icon({
		iconUrl: 'img/face/'+key+'.jpg',
		iconRetinaUrl: 'img/face/'+key+'.jpg',
		iconSize: [40, 40],
		iconAnchor: [20, 20],
		popupAnchor: [0, -20],
		//shadowUrl: 'leaflet-master/images/marker-shadow.png',
		//shadowRetinaUrl: 'my-icon-shadow@2x.png',
		//shadowSize: [80, 80],
		shadowAnchor: [22, 94],
		className: 'br_radius'
	});	
	
	marker[key] = L.marker([val.lat, val.lng], {icon: myIcon}).addTo(map).bindPopup("<b>Hello world!</b><br>My name is: "+val.name + "<br><i>MyID: "+ key+"</i>");
	//console.log(marker);
	});
	
	<? if(isset($_GET['find'])){?>
		marker[<?=$_GET['find']?>].openPopup();
	<? } ?>

});
<? } ?>
});


	
	
	
</script>
  
</body>
</html>
