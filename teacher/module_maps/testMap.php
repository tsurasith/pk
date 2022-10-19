<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps API - แผนที่บ้านจากโรงเรียนไปบ้านของนักเรียน[ทดสอบแผนที่ ver3.0]</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript">

    // Create a directions object and register a map and DIV to hold the 
    // resulting computed directions
    
    var map;
    var directionsPanel;
    var directions;
    var target = "";
		target = "15.560862,101.995992";
	var latlng = new google.maps.LatLng(15.563999, 101.999066);
    var myOptions = {
      zoom: 16,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.SATELLITE
   	 };

    function initialize() {
      map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
      directionsPanel = document.getElementById("route");
	  directions = new GDirections(map, directionsPanel);
      directions.load("15.563999, 101.999066 to: " + target);
	  
	   var mapTypeControl = new GMapTypeControl();
        var topRight = new GControlPosition(G_ANCHOR_TOP_RIGHT, new GSize(10,10));
        var bottomRight = new GControlPosition(G_ANCHOR_BOTTOM_RIGHT, new GSize(10,10));
        map.addControl(mapTypeControl, topRight);
        GEvent.addListener(map, "dblclick", function() {
          map.removeControl(mapTypeControl);
          map.addControl(new GMapTypeControl(), bottomRight);
        });
        map.addControl(new GSmallMapControl());
	  
      
    }
    

    </script>
</head> 
  <body onload="initialize()" onunload="GUnload()" style="font-family: Arial;border: 0 none;">
    <div id="map_canvas" style="width: 70%; height: 480px; float:left; border: 1px solid black;"></div>
    <div id="route" style="width: 25%; height:480px; float:right; border; 1px solid black;"></div>
    <br/>
  </body>
</html>