
<?php
	$acadyear = isset($_REQUEST['acadyear'])?$_REQUEST['acadyear']:$_POST['acadyear'];
	$_sqlUpdate;
	if(isset($_POST['update']))
	{
		$_sqlUpdate = "update students
							set ent_date = '" . $_POST['ent_date'] . "',
								students.cause = '" . $_POST['cause'] . "',
								students.leave = '" . $_POST['leave'] ."',
								sch_name = '" . $_POST['sch_name'] . "',
								retirecause = '" . $_POST['retirecause'] . "'
							where id = '" . $_POST['student_id'] . "' and xedbe = '" . $acadyear . "'";
		//echo $_sqlUpdate;
	}
?>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>แก้ไขข้อมูลการย้ายสถานศึกษา/ลาออก ต่อเนื่องจาก 2.3.1 ...</strong></font></span></td>
      <td >
	  		ปีการศึกษา <?=$acadyear?> ภาคเรียนที่ <?=$acadsemester?>
	   </td>
    </tr>
  </table>
<?php
	$_studentID = (isset($_POST['student_id'])?$_POST['student_id']:$_REQUEST['student_id']);
	$sqlStudent = "select id,prefix,firstname,lastname,nickname,xlevel,xyearth,room,studstatus,points,
						ent_date,sch_name,gpa,students.leave,students.cause,retirecause,studnote
				 from students 
				 where id = '" . $_studentID . "' and xedbe = '" . $acadyear . "'";
						 
	$resStudent = mysql_query($sqlStudent);
	$_dat = mysql_fetch_assoc($resStudent);
?>	
<form method="post" action="index.php?option=module_history/studentListRetire">
	<table class="admintable" width="100%">
		<tr>
			<td class="key">รายการแก้ไขข้อมูลนักเรียนที่พ้นสภาพการเป็นนักเรียนที่ไม่สำเร็จการศึกษา</td>
			<td class="key" width="200px" align="center">
				<input type="hidden" name="acadyear" value="<?=$acadyear?>" />
				<input type="hidden" name="roomID" value="<?=$_REQUEST['roomID']?>" />
				<input type="hidden" name="search" value="สืบค้น" />
				<input type="submit" name="เสร็จสิ้น" value="เสร็จสิ้น" />
			</td>
		</tr>
	</table>
</form>
<? 
	if(isset($_POST['update'])){
		if(mysql_query($_sqlUpdate))
		{ echo "<br/><br/><center><font color='green'><b>บันทึกการแก้ไขเรียบร้อยแล้ว</b></font></center><br/>";}
		else{ echo "<br/><br/><center><font color='red'>บันทึกข้อมูลผิดพลาดเนื่องจาก : " . mysql_error() . " กรุณานำปัญหานี้แจ้งต่อผู้ดูแลระบบ</font></center><br/>";}
	}
?>
<form method="post">
	<input type="hidden" value="<?=$_studentID?>" name="student_id" />
	<table class="admintable" align="center" width="100%">
		
		<tr> 
			<td width="205px" align="right">เลขประจำตัว :</td>
			<td ><b><?=$_dat['id']?></b></td>
			<td rowspan="9" valign="top" ><img src='../images/studphoto/id<?=$_dat['id']?>.jpg' width='120px' style="border:solid 1px #000000;" alt='รูปถ่ายนักเรียน'/></td>
		</tr>
		<tr> 
			<td width="205px" align="right">ชื่อ-สกุล :</td>
			<td ><b><?=$_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname']?></b></td>
		</tr>
		<tr> 
			<td width="205px" align="right">สถานภาพของนักเรียน :</td>
			<td ><?=displayStudentStatusColor($_dat['studstatus'])?></td>
		</tr>
		<tr>
		  <td align="right">วันที่เข้าศึกษา :</td>
		  <td ><input type="text" name="ent_date" value="<?=$_dat['ent_date']?>" size="10" maxlength="10" class="inputboxUpdate" /></td>
		</tr>
		<tr>
		  <td align="right">โรงเรียนเดิมก่อนเข้าศึกษา :</td>
		  <td ><input type="text" name="sch_name" value="<?=$_dat['sch_name']?>" size="40" class="inputboxUpdate" /></td>
		</tr>
		<tr>
		  <td align="right" valign="top">วันที่ออกจากโรงเรียน :</td>
		  <td ><input type="text" name="leave" value="<?=$_dat['leave']?>" size="10" maxlength="10" class="inputboxUpdate"/></td>
		</tr>
		<tr>
			<td align="right">ประเภทสาเหตุ :</td>
			<td>
				<select name="retirecause" class="inputboxUpdate">
					<?php
						$_resRetire = mysql_query("SELECT * FROM ref_retire");
						while($_datRe = mysql_fetch_assoc($_resRetire))
						{  ?>
							<option value="<?=$_datRe['retire_id']?>" <?=($_dat['retirecause']==$_datRe['retire_id']?"SELECTED":"")?>><?=$_datRe['retire_description']?></option>
					<?	} mysql_free_result($_resRetire); ?>
				</select> <font color="#FF0000">*</font>
			</td>
		</tr>
		<tr>
		  <td align="right" valign="top">สาเหตุที่ออกจากโรงเรียน :</td>
		  <td>
		  		<textarea name="cause" class="inputboxUpdate" cols="50" rows="3"><?=$_dat['cause']?></textarea>
				<!--<input type="text" value="" name="cause" size="60" class="inputboxUpdate" />-->
			</td>
		</tr>
		<tr>
		  <td align="right">&nbsp;</td>
		  <td><input type="submit" class="button" value="แก้ไข" name="update" /></td>
		</tr>
	</table>
</form>

</div>

