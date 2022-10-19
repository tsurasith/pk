<?php
		include("../../include/class.mysqldb.php");
		include("../../include/config.inc.php");
		$_zIndex = 1;
		$sqlStudent = "select id,prefix,firstname,lastname,xlevel,xyearth,room,
								howlong,travelby,utm_coordinate_x,utm_coordinate_y,studstatus
						 from students 
						 where xedbe = '" . $_REQUEST['acadyear'] . "' and trim(p_village) = '" . $_REQUEST['village'] . "'
						 order by xlevel,xyearth,room,sex ";
		$resStudent = mysql_query($sqlStudent);
	?>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="shortcut icon" href="../../images/favicon.ico" />
    <title>Google Maps API - แผนที่บ้านจากโรงเรียนไปบ้านของนักเรียน[ทดสอบแผนที่ ver3.0]</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" language="javascript">
	// lat=15.560862&long=101.995992 --> โรงเรียน
		var map;
		function initialize() {
			  var myOptions = {
				zoom: 14,
				center: new google.maps.LatLng(15.764, 101.557),
				mapTypeId: google.maps.MapTypeId.SATELLITE
			  }
			  map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
			  setMarkers(map, beaches);
			} //end-initalize function
			
		var beaches = [
			<? while($_dat = mysql_fetch_assoc($resStudent)) { ?>
			<? $_room = ($_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3) . '/' . $_dat['room']; ?>
				['<?=$_dat['id'] . ' ' . $_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname']?>', <?=$_dat['utm_coordinate_x']?>, <?=$_dat['utm_coordinate_y']?>, <?=$_zIndex++?>,'<?=$_dat['id']?>', '<?=displayStatus($_dat['studstatus'])?>' ,<?=$_dat['howlong']?>,'<?=displayTravel($_dat['travelby'])?>','<?=$_room?>','<?=displayFlag($_dat['studstatus'])?>'],
			<? } ?>
				['โรงเรียนโป่งนกประชาสามัคคี', 15.764025, 101.557868, 1000,'00000','ปกติ',0,'เดิน','พิเศษ','<?=displayFlag(2)?>']
				//[id+ชื่อ-สกุล,lat,long,zindex,id,status,howlong,travelby,flag path]				
		];
			
			function setMarkers(map, locations) {
			  //โค๊ดเดิม
			  var image = new google.maps.MarkerImage('../../images/flag-thai.png',
				  // This marker is 20 pixels wide by 32 pixels tall.
				  new google.maps.Size(20, 32),
				  // The origin for this image is 0,0.
				  new google.maps.Point(0,0),
				  // The anchor for this image is the base of the flagpole at 0,32.
				  new google.maps.Point(0, 30));
			  var shadow = new google.maps.MarkerImage('../../images/beachflag_shadow.png',
				  new google.maps.Size(20, 32),
				  new google.maps.Point(0,0),
				  new google.maps.Point(0, 32));
				  
			  var shape = {
				  coord: [1, 1, 1, 20, 18, 20, 18 , 1],
				  type: 'poly'
			  };
			  for (var i = 0; i < locations.length; i++) {
				var beach = locations[i];
				var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
				var marker = new google.maps.Marker({
					position: myLatLng,
					map: map,
					shadow: shadow,
					//icon: image, ของเดิม
					icon : new google.maps.MarkerImage(beach[9].toString(), new google.maps.Size(20, 32), new google.maps.Point(0,0), new google.maps.Point(0, 30)),
					shape: shape,
					title: beach[0],
					zIndex: beach[3]
				});
				attachSecretMessage(marker, beach[0], beach[4], beach[5], beach[6], beach[7], beach[8]);
			  }
			} // end-setMarker function
			
			//---เพิ่มบล็อกข้อมูลนักเรียน----//
			function attachSecretMessage(marker, studentName, studentID, studstatus, howlong, travelby, room) {
			  var message = "";
			  if(studentID.toString() != '00000'){
			  	message = "<table width='100%' align='center'>" + 
			  					"<tr><td colspan='2' ><b><font face='MS Sans Serif' size='2' color='blue'><?=$_REQUEST['village']?> - " + studentName.toString()  +"</font></b></td></tr>" +
			  					"<tr>"+
									"<td width='90px'><img src='../../images/studphoto/id" + studentID.toString() + ".jpg' width='90px' border='1'/></td> " +
									"<td valign='top'><font face='MS Sans Serif' size='2'>ระดับชั้น : <b>ม. " + room.toString() + "</b><br/> "+
									"สถานภาพปัจจุบัน : <b>" + studstatus.toString() + "</b><br/>" +
									"การเดินทาง : <b>" + travelby.toString() + "</b><br/> "+
									"ใช้เวลาเดินทาง : <b>" + howlong + "</b> นาที </font></td>"+
								"<tr><td colspan='2'><img src='../../images/studhome/id" + studentID.toString() + ".jpg' width='400px' height='300px' border='1'/></td></tr>"+
								"</tr>" +
							"</table>";
			  } //end if
			  else
			  {
			  	message = "<table width='100%'>" + 
			  					"<tr><td colspan='2' ><b><font face='MS Sans Serif' size='2' color='blue'><?=$_REQUEST['village']?> - " + studentName.toString()  +"</font></b></td></tr>" +
			  					"<tr>"+
									"<td width='90px'><img src='../../images/studphoto/id" + studentID.toString() + ".jpg' width='90px' border='1'/></td> " +
									"<td valign='top'><font face='MS Sans Serif' size='2'>สถานภาพปัจจุบัน : <b>" + studstatus.toString() + "</b><br/>" +
									"การเดินทาง : <b>" + travelby.toString() + "</b><br/> "+
									"ใช้เวลาเดินทาง : <b>" + howlong + "</b> นาที </font></td>"+
								"<tr><td colspan='2'><img src='../../images/studhome/school/school.jpg' width='400px' height='300px' border='1'/>"+
								"</td></tr>"+
							"</table>";
			  }
			  
			  var infowindow = new google.maps.InfoWindow(
				  { 
				  	content: message,
					maxWidth :440
					});
			 	google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
			  		});
			}
    </script>
	<? mysql_free_result($resStudent);?>
</head> 
 <body style="margin:0px; padding:0px;" onLoad="initialize()">
  <div id="map_canvas" style="width:100%; height:100%"></div>
</body>
</html>
<?php
	function displayStatus($id) {
		switch ($id) {
			case 0 :  return "ออก"; break;
			case 1 :  return "ปกติ"; break;
			case 2 :  return "สำเร็จการศึกษา"; break;
			case 3 :  return "แขวนลอย"; break;
			case 4 :  return "พักการเรียน"; break;
			case 5 :  return "ย้ายสถานศึกษา"; break;
			case 9 :  return "เสียชีวิต"; break;
			default : return " - ไม่ทราบ - ";
		}	
	}
	function displayFlag($_value){
		switch($_value){
			case 0 :  return "../../images/flag-red.png"; break;
			case 1 :  return "../../images/flag-green.png"; break;
			case 2 :  return "../../images/flag-green-finish.png"; break;
			case 3 :  return "../../images/flag-yellow.png"; break;
			case 4 :  return "../../images/flag-orange.png"; break;
			case 5 :  return "../../images/flag-blue.png"; break;
			case 9 :  return "../../images/flag-purple.png"; break;
			default : return "../../images/flag-thai.png";
		}
	}//ปิดฟังก์ชันแสดงธงสี
	
	function displayTravel($_id)
	{
		switch($_id) {
			case '01' : return "เดิน"; break;
			case '02' : return "รถจักรยาน"; break;
			case '03' : return "รถจักรยานยนต์"; break;
			case '04' : return "รถประจำทาง"; break;
			case '05' : return "ผู้ปกครองมาส่ง"; break;
			case '06' : return "รถรับส่งนักเรียน";break;
			default : return "ไม่ระบุ";
		}
	}
	
?>