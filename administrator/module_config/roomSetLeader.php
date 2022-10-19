<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_config/index">
			<img src="../images/config.png" alt="" width="48" height="48" />
		</a>
	</td>
      <td><strong><font color="#990000" size="4">ปรับแต่งระบบ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.3 จัดการหัวหน้าห้อง</strong></font></span></td>
      <td align="right">
	  	<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_config/roomSetLeader&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_config/roomSetLeader&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_config/roomSetLeader&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_config/roomSetLeader&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<br/>
		<form method="post">
		<font color="#000000" size="2"  >
		<? $sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id"; ?>
		<? $resRoom = mysql_query($sql_Room); ?>
		 เลือกห้องเรียน 
		 <select name="roomID" class="inputboxUpdate">
		  	<option value=""> &nbsp; &nbsp; &nbsp; </option>
			<? while($dat = mysql_fetch_assoc($resRoom)){
					$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
					echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
					echo displayRoom($dat['room_id']);
					echo "</option>";
					} mysql_free_result($resRoom); ?>
			</select>
			<input type="submit" value="แก้ไข" name="search" class="button" />
			</font>
		</form>
	  </td>
    </tr>
  </table>

<? if(isset($_POST['search']) && $_POST['roomID'] == ""){?>
		<br/><font color="#FF0000"><center>กรุณาเลือกห้องเรียนที่ต้องการแก้ไขก่อน !</center></font><br/><br/>
<? } //end if ?>
<?php
	$xlevel;
	$xyearth;
	$room = substr($_POST['roomID'],2,1);
	if(substr($_POST['roomID'],0,1) > 3)
	{
		$xlevel = 4;
		if(substr($_POST['roomID'],0,1) == 4){ $xyearth = 1;}
		if(substr($_POST['roomID'],0,1) == 5){ $xyearth = 2;}
		if(substr($_POST['roomID'],0,1) == 6){ $xyearth = 3;}		
	}
	else
	{
		$xlevel = 3;
		if(substr($_POST['roomID'],0,1) == 1){ $xyearth = 1;}
		if(substr($_POST['roomID'],0,1) == 2){ $xyearth = 2;}
		if(substr($_POST['roomID'],0,1) == 3){ $xyearth = 3;}
	}
?>
<? if(isset($_POST['search']) && $_POST['roomID'] != ""){ ?>
		<form method="post">
		<? $_resRoom = mysql_query("select student_id from rooms where room_id = '" . $_POST['roomID'] . "' and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'");?>
		<? $_datRoom = mysql_fetch_assoc($_resRoom); ?>
		<? $_sqlStudent = "select id,prefix,firstname,lastname,nickname,studstatus,p_village from students where xedbe = '" . $acadyear . "' and xlevel = '" . $xlevel . "' and xyearth = '" . $xyearth . "' and room = '" . $room . "' order by sex,id "; ?>
		<? $_resStudent = mysql_query($_sqlStudent); ?>
		<table class="admintable" width="100%">
			<tr>
				<td colspan="3" class="key" align="center">
					รายการข้อมูลแก้ไขห้อง <?=displayRoom($_POST['roomID'])?> ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
				</td>
			</tr>
			<tr>
				<td width="50px"></td>
				<td width="200px" align="right">หัวหน้าชั้น :</td>
				<td>
					<select name="student_id" class="inputboxUpdate">
						<option value=""></option>
					<? while($_dat = mysql_fetch_assoc($_resStudent)){ ?>
						<option value="<?=$_dat['id']?>" <?=$_dat['id']==$_datRoom['student_id']?"selected":""?> ><?=$_dat['prefix'].$_dat['firstname'].' '.$_dat['lastname']?></option>
					<? } mysql_free_result($_resStudent);//end while ?>
					</select>
				</td>
			</tr>
			<tr>
				<td></td><td></td>
				<td>
					<br/>
					<input type="hidden" name="room_id" value="<?=$_POST['roomID']?>" />
					<input type="hidden" name="acadyear" value="<?=$acadyear?>" />
					<input type="hidden" name="acadsemester" value="<?=$acadsemester?>" />
					<input type="submit" name="save" value="บันทึก" class="button" /> 
					<input type="button" value="ยกเลิก" class="button" onclick="location.href='index.php?option=module_config/roomSetAdvisor&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>'" />
					<br/><br/><br/>
				</td>
			</tr>
		</table>
		</form>
<? } ?>

<? 
	if(isset($_POST['save'])){
		$_sql = "update rooms set 
					student_id = '" . $_POST['student_id'] . "'
				 where room_id = '" . $_POST['room_id'] . "' and 
				 		acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' ";
		if(mysql_query($_sql)){ echo "<br/><center><font color='green'><b>บันทึกแก้ไขเรียบร้อยแล้ว</b></font></center><br/><br/>"; }
		else{ echo "<br/><center><font color='red'>บันทึกแก้ไขผิดพลาด เนื่องจาก - " . mysql_error() . "</font></center<br/><br/>"; }
	}
?>

	<? $_sqlAllRoom = "select * from rooms where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' order by room_id";?>
	<? $_resAll = mysql_query($_sqlAllRoom); ?>
	<table class="admintable" width="100%">
  		<tr>
			<td colspan="6"><b>ข้อแนะนำ</b> ก่อนทำการจัดการหัวหน้าห้องเรียน ควรที่ทำการเพิ่ม/ลบ ข้อมูลห้องเรียนของระบบ ให้ตรงกันกับ ห้องเรียนในฐานข้อมูลประวัตินักเรียน</td>
		</tr>
		<? if(mysql_num_rows($_resAll)>0) {?>
		<tr>
			<td colspan="6" align="center" class="key"><br/>ข้อมูลหัวหน้าห้องเรียนภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?><br/><br/></td>
		</tr>
		<tr>
			<td class="key" align="center" width="50px">ที่</td>
			<td class="key" align="center" width="90px">ห้องเรียน</td>
			<td class="key" align="center" width="200px">ชื่อ-สกุล</td>
			<td class="key" align="center" width="80px">ชื่อเล่น</td>
			<td class="key" align="center" width="120px">สถานภาพปัจจุบัน</td>
			<td class="key" align="center">หมู่บ้านที่อาศัย</td>
		</tr>
			<? $_x = 1;?>
			<? while($_datAll = mysql_fetch_assoc($_resAll)){ ?>
				<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
					<td align="center"><?=$_x++?></td>
					<td align="center"><?=displayRoom($_datAll['room_id'])?></td>
					<? $_view = displayStudent($_datAll['student_id'],$_datAll['acadyear']);?>
					<td style="padding-left:10px;"><?=$_view['prefix']==""?"-":$_view['prefix'].$_view['firstname']. ' '. $_view['lastname']?></td>
					<td align="center"><?=$_view['nickname']==""?"-":$_view['nickname']?></td>
					<td align="center"><?=$_view['studstatus']==""?"-":displayStatus($_view['studstatus'])?></td>
					<td><?=$_view['p_village']==""?"-":$_view['p_village']?>
				</tr>
			<? }//end while ?>
		<? } else { ?>
		<tr>
			<td colspan="6" align="center">
				<br/><br/><font color="#FF0000">ยังไม่มีข้อมูลห้องเรียนในระบบของภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?> </font>
				<br/><br/>
			</td>
		</tr>
		<? }//end check Room exist ?>
	</table>
</div>
<?
	function displayRoom($_value){
		$_level = substr($_value,0,1);
		$_room = (int)substr($_value,1,2);
		return $_level . '/' . $_room ;
	}
	function displayStudent($_value,$_year){
		$_sql = "select id,prefix,firstname,lastname,nickname,studstatus,p_village from students where id = '" . $_value . "' and xedbe = '" . $_year . "' ";
		$_dat = mysql_fetch_assoc(mysql_query($_sql));
		return $_dat;
	}
	function displayStatus($id)
	{
		switch ($id) {
			case 0 :  return "<font color='red'><b>ออก</b></font>"; break;
			case 1 :  return "ปกติ"; break;
			case 2 :  return "<b>สำเร็จการศึกษา</b>"; break;
			case 3 :  return "<font color='red'><b>แขวนลอย</b></font>"; break;
			case 4 :  return "<font color='darkorange'><b>พักการเรียน</b></font>"; break;
			case 5 :  return "<font color='blue'><b>ย้ายสถานศึกษา</b></font>"; break;
			case 9 :  return "<font color='red'><b>เสียชีวิต</b></font>"; break;
			default : return " - ไม่ทราบ - ";
		}	
	}
?>