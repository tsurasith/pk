<SCRIPT language=Javascript>
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</SCRIPT>
<?php
	$acadyear = isset($_REQUEST['acadyear'])?$_REQUEST['acadyear']:$acadyear;
	if(isset($_POST['update']))
	{
		$_sqlUpdate = "update students
							set utm_coordinate_x = '" . $_POST['lat_x'] . "',
								utm_coordinate_y = '" . $_POST['lat_y'] . "',
								p_village = '" . $_POST['p_village'] ."',
								howlong = '" . $_POST['howlong'] . "',
								travelby = '" . $_POST['travelby'] . "'
							where id = '" . $_POST['student_id'] . "' and xedbe = '" . $acadyear . "'";
		@mysql_query($_sqlUpdate);
	}
?>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_maps/index"><img src="../images/add.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td >แผนที่ติดตามที่อยู่<br />
			<span class="normal">ระบบแผนที่และเส้นทางติดตามที่อยู่ของนักเรียน</span></td>
		<td>

		ปีการศึกษา <?=$acadyear?>
		<br/>ภาคเรียนที่   <?=$acadsemester?>
		</font>
		
	   </td>
    </tr>
  </table>
  <?php
  	$_studentID = (isset($_POST['student_id'])?$_POST['student_id']:$_REQUEST['student_id']);
	$sqlStudent = "select id,prefix,firstname,lastname,travelby,howlong,p_village,utm_coordinate_x,utm_coordinate_y,studstatus
						 from students 
						 where id = '" . $_studentID . "' and xedbe = '" . $acadyear . "'";
						 
	$resStudent = mysql_query($sqlStudent);
	$_dat = mysql_fetch_assoc($resStudent);
  ?>

  	<table class="admintable"  cellpadding="1" width="100%" cellspacing="1" border="0" align="center">
		<tr> 
		  <td class="key">
		  		<form method="post" action="index.php?option=module_maps/<?=$_REQUEST['report']?>">
		  			รายการแก้ไขตำแหน่งที่ตั้งบ้านของนักเรียนระบบแผนที่  &nbsp; | 
					<input type="hidden" value="<?=$_dat['p_village']?>" name="p_village"  />
					<input type="hidden" value="<?=$_REQUEST['acadyear']?>" name="acadyear" />
					<input type="hidden" value="<?=$_REQUEST['room']?>" name="roomID" />
					<input type="hidden" value="<?=$_REQUEST['acadsemester']?>" name="acadsemester"/>
					<input type="hidden" value="<?=$_REQUEST['travelby']?>" name="travelby" />
					<input type="submit" value="กลับ" />
				</form>
		  </td>
		</tr>
	</table>
<form method="post">
  	<input type="hidden" value="<?=$_studentID?>" name="student_id" />
	<table class="admintable" align="center" width="100%">
		<tr> 
			<td width="205px" align="right">ชื่อ-สกุล :</td>
			<td ><b><?=$_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname']?></b></td>
		</tr>
		<tr> 
			<td width="205px" align="right">สถานภาพของนักเรียน :</td>
			<td ><?=displayStatus($_dat['studstatus'])?></td>
		</tr>
		<tr>
		  <td align="right">หมู่บ้านที่อาศัย</td>
		  <td ><input type="text" name="p_village" value="<?=$_dat['p_village']?>" size="40" class="inputboxUpdate" /></td>
	  </tr>
	    <tr>
		  <td align="right">การเดินทางมาโรงเรียน</td>
		  <td >
		  		<select name="travelby" class="inputboxUpdate">
				<?php
					$_resTravel = mysql_query("SELECT * FROM ref_travel");
					while($_datTravel = mysql_fetch_assoc($_resTravel))
					{  ?>
						<option value="<?=$_datTravel['travel_id']?>" <?=($_dat['travelby']==$_datTravel['travel_id']?"SELECTED":"")?>><?=$_datTravel['travel_description']?></option>
				<?	} mysql_free_result($_resTravel);
				?>
				</select>
		  </td>
	  </tr>
		<tr>
		  <td align="right">ระยะเวลาในการเดินทางมาโรงเรียน :</td>
		  <td ><input type="text" name="howlong" value="<?=$_dat['howlong']?>" onkeypress="return isNumberKey(event)" size="3" maxlength="2" class="inputboxUpdate"/> นาที</td>
	  </tr>
		<tr>
		  <td align="right">ค่าละติจูด</td>
		  <td ><input type="text" value="<?=$_dat['utm_coordinate_x']?>" name="lat_x" class="inputboxUpdate" /></td>
	  </tr>
		<tr>
		  <td align="right">ค่าลองติจูด</td>
		  <td ><input type="text" value="<?=$_dat['utm_coordinate_y']?>" name="lat_y" class="inputboxUpdate"/></td>
	  </tr>
		<tr>
		  <td align="right">&nbsp;</td>
		  <td><input type="submit" class="button" value="แก้ไข" name="update" /></td>
	  </tr>
	</table>
  </form>
</div>
<?php
	function displayStatus($id)
	{
		switch ($id) {
			case 0 :  return "<font color='red'><b>ออก</b></font>"; break;
			case 1 :  return "<b>ปกติ</b>"; break;
			case 2 :  return "<b>สำเร็จการศึกษา</b>"; break;
			case 3 :  return "<font color='red'><b>แขวนลอย</b></font>"; break;
			case 4 :  return "<font color='darkorange'><b>พักการเรียน</b></font>"; break;
			case 5 :  return "<font color='blue'><b>ย้ายสถานศึกษา</b></font>"; break;
			case 9 :  return "<font color='red'><b>เสียชีวิต</b></font>"; break;
			default : return " - ไม่ทราบ - ";
		}	
	}
?>