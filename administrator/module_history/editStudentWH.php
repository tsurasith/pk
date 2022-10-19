
<?php
	$_update = 0;
	$_message = "";
	$acadyear = isset($_REQUEST['acadyear'])?$_REQUEST['acadyear']:$_POST['acadyear'];
	if(isset($_POST['update']))
	{
		if(is_numeric($_POST['weight']) && is_numeric($_POST['height']) && $_POST['weight'] >0 && $_POST['height'] >0)
		{
			$_bmi = $_POST['weight']/($_POST['height'] * $_POST['height']/10000);
			$_sqlUpdate = "update students
							set weight = '" . $_POST['weight'] . "',
								height = '" . $_POST['height'] . "',
								blood_group = '" . $_POST['blood_group'] ."',
								bmi = '" . $_bmi . "',
								cripple = '" . $_POST['cripple'] . "',
								inservice = '" . $_POST['inservice'] . "'
							where id = '" . $_POST['student_id'] . "' and xedbe = '" . $acadyear . "'";
			if(mysql_query($_sqlUpdate))
			{
				$_message = "<font color='green'><b>แก้ไขข้อมูลเรียบร้อยแล้ว</b></font>";
			}else {$_message = "<font color='red'><b>ผิดพลาดเนื่องจาก " . mysql_error() . "</b></font>";}
		} else {$_message = "<font color='red'><b>ผิดพลาดเนื่องจาก ค่าน้ำหนักหรือส่วนสูงที่ป้อนไม่ถูกต้องกรุณาตรวจสอบอีกครั้ง</b></font>";}
	}
?>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.1 รายงานข้อมูลสุขภาพนักเรียน [รายห้อง] &gt;&gt; แก้ไขข้อมูลสุขภาพ</strong></font></span></td>
      <td >
	  		ปีการศึกษา <? $acadyear = isset($_REQUEST['acadyear'])?$_REQUEST['acadyear']:$acadyear?> <?=$acadyear ?>
	   </td>
    </tr>
  </table>
<?php
	$_studentID = (isset($_POST['student_id'])?$_POST['student_id']:$_REQUEST['student_id']);
	$sqlStudent = "select id,prefix,firstname,lastname,nickname,xlevel,xyearth,room,studstatus,blood_group,
						weight,height,cripple,inservice
				 from students 
				 where id = '" . $_studentID . "' and xedbe = '" . $acadyear . "'";
						 
	$resStudent = mysql_query($sqlStudent);
	$_dat = mysql_fetch_assoc($resStudent);
?>

<? if(isset($_POST['update'])) { ?>
	<table class="admintable" width="100%">
		<tr><td class="key">ผลการดำเนินการ</td></tr>
		<tr><td style="padding-left:30px"><?=$_message?></td></tr>
	</table>
<? } //end-if ผลการดำเนินการ ?>
	<br/>
<form method="post" action="index.php?option=module_history/reportWHRoom">
	<table class="admintable" width="100%">
		<tr>
			<td class="key">รายการแก้ไขข้อมูลนักเรียนที่พ้นสภาพการเป็นนักเรียนที่ไม่สำเร็จการศึกษา</td>
			<td class="key" width="250px" align="center">
				<input type="hidden" name="acadyear" value="<?=$acadyear?>" />
				<input type="hidden" name="roomID" value="<?=$_REQUEST['roomID']?>" />
				<input type="hidden" name="search" value="สืบค้น" />
				<input type="submit" name="เสร็จสิ้น" value="เสร็จสิ้น" />
			</td>
		</tr>
	</table>
</form>

<form method="post">
	<input type="hidden" value="<?=$_studentID?>" name="student_id" />
	<table class="admintable" align="center" width="100%">
		
		<tr> 
			<td width="205px" align="right">เลขประจำตัว :</td>
			<td ><b><?=$_dat['id']?></b></td>
			<td rowspan="9" valign="top" width="200px" align="center">
				<? if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/pk/images/studphoto/id" . $_dat['id'] . ".jpg"))
						{ echo "<img src='../images/studphoto/id" . $_dat['id'] . ".jpg' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #000000'/><br/>"; }
						else 
						{echo "<img src='../images/" . ($_dat['sex']==1?"_unknown_male":"_unknown_female") . ".png' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/><br/>"; } 
				?>
			</td>
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
		  <td align="right">น้ำหนัก :</td>
		  <td ><input type="text" name="weight" value="<?=$_dat['weight']?>" size="4" maxlength="6" class="inputboxUpdate" /></td>
		</tr>
		<tr>
		  <td align="right">ส่วนสูง :</td>
		  <td ><input type="text" name="height" value="<?=$_dat['height']?>" size="4" maxlength="6" class="inputboxUpdate" /></td>
		</tr>
		<tr>
		  <td align="right" valign="top">หมู่โลหิต  :</td>
		  <td >
		  	<select name="blood_group" class="inputboxUpdate">
				<option value=""></option>
				<option value="เอ" <?=($_dat['blood_group']=="เอ"?"SELECTED":"")?>>เอ</option>
				<option value="บี" <?=($_dat['blood_group']=="บี"?"SELECTED":"")?>>บี</option>
				<option value="โอ" <?=($_dat['blood_group']=="โอ"?"SELECTED":"")?>>โอ</option>
				<option value="เอบี" <?=($_dat['blood_group']=="เอบี"?"SELECTED":"")?>>เอบี</option>
			</select>
		  </td>
		</tr>
		<tr>
		  <td align="right">สถานภาพความพิการ :</td>
		  <td >
		  	<select name="cripple" class="inputboxUpdate">
			<?  $_resCripple = mysql_query("SELECT * FROM ref_cripple");
				while($_datCripple = mysql_fetch_assoc($_resCripple)) {  ?>
					<option value="<?=$_datCripple['cripple_id']?>" <?=($_dat['cripple']==$_datCripple['cripple_id']?"SELECTED":"")?>><?=$_datCripple['cripple_description']?></option>
			<?	} mysql_free_result($_resCripple); ?>
			</select>
		  </td>
		</tr>
		<tr>
		  <td align="right" valign="top">การพักอาศัยของนักเรียน :</td>
		  <td >
		  	<select name="inservice" class="inputboxUpdate">
			<?  $_resInService = mysql_query("SELECT * FROM ref_inservice");
				while($_datInService = mysql_fetch_assoc($_resInService)) {  ?>
					<option value="<?=$_datInService['service_id']?>" <?=($_dat['inservice']==$_datInService['service_id']?"SELECTED":"")?>><?=$_datInService['service_description']?></option>
			<?	} mysql_free_result($_resInService); ?>
			</select>
		  </td>
		</tr>
		<tr>
		  <td align="right">&nbsp;</td>
		  <td><input type="submit" class="button" value="บันทึก" name="update" /></td>
		</tr>
	</table>
</form>

</div>

