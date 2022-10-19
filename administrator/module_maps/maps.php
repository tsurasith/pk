<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps API - แผนที่บ้านจากโรงเรียนไปบ้านของนักเรียน - <?=$_REQUEST['stName']?></title>   

    <style>
		body{
			margin:0;
		}
	
		#studentInfo{
			height:35px;
			border:1px solid #000000;
			margin-left:10px;
			margin-top:3px;
			margin-right:10px;
			right:5px;
			/* background-color:#D3630B; */
			background-color:#000033;
			text-align:center;
			padding-top:5px;
			font-family:Tahoma, Geneva, sans-serif;
			font-size:20px;
			color:#FFFFFF;
			text-shadow:#F00;
		}
		#map{
			width: 70%; 
			float:left; 
			border: 1px solid #000000;
			position:absolute;
			top:48px;
			right:0;
			bottom:0;
			left:10px;
		}
		#route{
			width: 28%;
			position: absolute;
			float: right;
			border: 1px solid #000;
			margin-right: 10px;
			margin-left: 3px;
			bottom:0;
			right:0;
			top:48px;
		}
	</style>
</head> 
<body>
  	<div id="studentInfo">
    	แผนที่การเดินทางไปบ้านนักเรียน 
        เลขประจำตัว <b><?=$_REQUEST['id']?> </b>
        ชื่อ <b><?=$_REQUEST['stName']?></b>
        ที่อยู่ <b><?=$_REQUEST['p_village']?></b>
    </div>
    <div id="map"></div>
    <div id="route" ></div>
<script>	  
 function initMap() {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: 15.764025, lng: 101.557868}
        });
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('route'));
        calculateAndDisplayRoute(directionsService, directionsDisplay);

      }

	  
	  
      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var start = {lat: 15.764068, lng: 101.558248};
        var end = {lat: <?=$_REQUEST['lat']?>, lng: <?=$_REQUEST['long']?>};
        directionsService.route({
          origin: start,
          destination: end,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
	  
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoeQwHJsfpDFV_K8szdkAbClLYnK9io7U&callback=initMap" async defer></script>
    
  </body>
</html>