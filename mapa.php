<!DOCTYPE html>
<html>
<head>
<h1>Proyecto Telemetria</h1>

<script
src="http://maps.googleapis.com/maps/api/js">
</script>

<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
var map;
var myCenter;
var marker;
var myVal = consulta();
	function consulta(){
		
		$.ajax({
			url:"loadmap.php",
			success:
				function(response){
					var data = response.split(";");
					document.getElementById("fechaHora").innerHTML = data[0];
					document.getElementById("latitud").innerHTML = data[1];
					document.getElementById("longitud").innerHTML = data[2];
					myCenter = new google.maps.LatLng(data[1],data[2]);
					
				},
		});
		
	}
	var refresh = setInterval(function(){
		consulta();
		marker.setPosition(myCenter);
		map.panTo(myCenter);
		},10000);

function placeMarker(location) {
    marker = new google.maps.Marker({
    position: location,
    map: map,
  });
  var infowindow = new google.maps.InfoWindow({
    content: 'Latitude: ' + location.lat() +
    '<br>Longitude: ' + location.lng()
  });
  infowindow.open(map,marker);
}

function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:5,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

  map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

marker=new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);
google.maps.event.addListener(map, 'click', function(event) {
  placeMarker(event.latLng);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
</head>

<body>
<div id="googleMap" style="width:1000px;height:400px;"></div>
Fecha y Hora: <div id="fechaHora"></div>
Latitud: <div id=latitud></div>
Longitud: <div id=longitud></div>
</body>
</html>