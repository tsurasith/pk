
<?php
	$acadyear = isset($_REQUEST['acadyear'])?$_REQUEST['acadyear']:$acadyear;
	if(isset($_POST['update']))
	{
		$_sqlUpdate = "update students
							set utm_coordinate_x = '" . $_POST['lat_x'] . "',
								utm_coordinate_y = '" . $_POST['lat_y'] . "',
								p_village = '" . trim($_POST['p_village']) ."',
								p_tumbol = '" . trim($_POST['p_tumbolupdate']) . "',
								howlong = '" . $_POST['howlong'] . "',
								travelby = '" . $_POST['travelby'] . "',
								nickname = '" . $_POST['nickname'] . "'
							where id = '" . $_POST['student_id'] . "' and xedbe = '" . $acadyear . "'";
	}
?>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_maps/index"><img src="../images/add.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">แผนที่ติดตามที่อยู่</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>แก้ไขที่อยู่ ค่าพิกัดตำแหน่ง และวิธีการเดินทางมาโรงเรียน</strong></font></span></td>
		<td>

		ปีการศึกษา <?=$acadyear?> ภาคเรียนที่ <?=$acadsemester?>
		</font>
		
	   </td>
    </tr>
  </table>
  	<table class="admintable"  cellpadding="1" width="100%" cellspacing="1" border="0" align="center">
		<tr> 
		  <td class="key">
		  		<form method="post" action="index.php?option=module_maps/<?=$_REQUEST['report']?>">
		  			รายการแก้ไขตำแหน่งที่ตั้งบ้านของนักเรียนระบบแผนที่  &nbsp; | 
					<input type="hidden" value="<?=$_REQUEST['p_village']?>" name="p_village"  />
					<input type="hidden" value="<?=$_REQUEST['acadyear']?>" name="acadyear" />
					<input type="hidden" value="<?=$_REQUEST['room']?>" name="roomID" />
					<input type="hidden" value="<?=$_REQUEST['acadsemester']?>" name="acadsemester"/>
					<input type="hidden" value="<?=$_REQUEST['travelby']?>" name="travelby" />
					<input type="hidden" value="<?=$_REQUEST['p_tumbol']?>" name="p_tumbol" />
					<input type="hidden" value="<?=$_REQUEST['sex']?>" name="sex" />
					<input type="submit" value="กลับ" name="search" />
				</form>
		  </td>
		</tr>
	</table>
<? if(isset($_POST['update'])){ ?>
	<? if(mysql_query($_sqlUpdate)) { ?>
		<b><br/><center><font color="#008000">บันทึกการแก้ไขข้อมูลเรียบร้อยแล้ว</font></center></b>
	<? }else { ?> <br/><br/><center><font color="#FF0000">เกิดข้อผิดพลาดเนื่องจาก : <?=mysql_error()?></font></center> <? } ?>
<? } ?>
<?php
$_studentID = (isset($_POST['student_id'])?$_POST['student_id']:$_REQUEST['student_id']);
$sqlStudent = "select id,prefix,firstname,lastname,nickname,p_tumbol,travelby,howlong,p_village,utm_coordinate_x,utm_coordinate_y,studstatus
					 from students 
					 where id = '" . $_studentID . "' and xedbe = '" . $acadyear . "'";
					 
$resStudent = mysql_query($sqlStudent);
$_dat = mysql_fetch_assoc($resStudent);
?>
<form method="post">
  	<input type="hidden" value="<?=$_studentID?>" name="student_id" />
	<table class="admintable" align="center" width="100%">
		<tr> 
			<td width="205px" align="right">ชื่อ-สกุล :</td>
			<td ><b><?=$_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname']?></b></td>
		</tr>
		<tr> 
			<td width="205px" align="right">สถานภาพของนักเรียน :</td>
			<td ><?=displayStudentStatusColor($_dat['studstatus'])?></td>
		</tr>
		<tr>
		  <td align="right">ชื่อเล่น :</td>
		  <td ><input type="text" name="nickname" value="<?=$_dat['nickname']?>" size="10" class="inputboxUpdate" /></td>
	  </tr>
		<tr>
		  <td align="right">หมู่บ้านที่อาศัย :</td>
		  <td ><input type="text" name="p_village" value="<?=$_dat['p_village']?>" size="40" class="inputboxUpdate" /></td>
	  </tr>
	    <tr>
		  <td align="right">ตำบล :</td>
		  <td ><input type="text" name="p_tumbolupdate" value="<?=$_dat['p_tumbol']?>" size="20" class="inputboxUpdate" /></td>
	  </tr>
		<tr>
		  <td align="right">การเดินทางมาโรงเรียน :</td>
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
		  <td align="right">ค่าละติจูด :</td>
		  <td ><input type="text" value="<?=$_dat['utm_coordinate_x']?>" name="lat_x" class="inputboxUpdate" /></td>
	  </tr>
		<tr>
		  <td align="right">ค่าลองติจูด :</td>
		  <td ><input type="text" value="<?=$_dat['utm_coordinate_y']?>" name="lat_y" class="inputboxUpdate"/></td>
	  </tr>
		<tr>
		  <td align="right">&nbsp;</td>
		  <td><input type="submit" class="button" value="บันทึก" name="update" /></td>
	  </tr>
	</table>
  </form>
</div>
