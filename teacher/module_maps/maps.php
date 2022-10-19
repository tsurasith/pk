<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps API - แผนที่บ้านจากโรงเรียนไปบ้านของนักเรียน - <?=$_REQUEST['stName']?></title>
    <script src="http://maps.google.com/maps?file=api&amp;sensor=false" type="text/javascript"></script>
    <script type="text/javascript">

    // Create a directions object and register a map and DIV to hold the 
    // resulting computed directions
    
    var map;
    var directionsPanel;
    var directions;
    var target = "";
		target = "<?=$_REQUEST['lat']?>" + "," + "<?=$_REQUEST['long']?>";
    function initialize() {
      map = new GMap2(document.getElementById("map_canvas"));
      map.setCenter(new GLatLng(15.764025, 101.557868), 15);
      directionsPanel = document.getElementById("route");
	  directions = new GDirections(map, directionsPanel);
      directions.load("15.764025, 101.557868 to: " + target);
	  
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
		#map_canvas{
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
</head> 
  <body onload="initialize()" onunload="GUnload()" style="font-family: Arial;border: 0 none;">
  	<div id="studentInfo">
    	แผนที่การเดินทางไปบ้านนักเรียน 
        เลขประจำตัว <b><?=$_REQUEST['id']?> </b>
        ชื่อ <b><?=$_REQUEST['stName']?></b>
        ที่อยู่ <b><?=$_REQUEST['p_village']?></b>
    </div>
    <div id="map_canvas" ></div>
    <div id="route" ></div>
    <br/>
  </body>
</html>