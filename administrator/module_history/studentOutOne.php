<SCRIPT language="javascript" type="text/javascript">
      function isNumberKey(evt) {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
      }
      function checkValue(){
	  	if(document.getElementById('studstatus').value == "" || document.getElementById('studstatus').value == "1")
		{alert('กรุณาระบุสถานภาพของนักเรียนก่อน'); document.getElementById('studstatus').focus(); return; }
		
		if(document.getElementById('retirecause').value == "")
		{alert('กรุณาระบุประเภทสาเหตุของนักเรียนก่อน'); document.getElementById('retirecause').focus(); return; }
		
		if(document.getElementById('cause').value == "")
		{alert('กรุณาระบุสาเหตุโดยละเอียดของนักเรียนก่อน'); document.getElementById('cause').focus(); return; }
		
		if(document.getElementById('leave').value.length < 10)
		{alert('กรุณาระบุวันที่พ้นสภาพของนักเรียนก่อน'); document.getElementById('leave').focus(); return; }
		else { document.myform.submit(); }
	  }
   </SCRIPT>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td align="center">
      <a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.3 แก้ไขข้อมูลนักเรียนออก/แขวนลอย/พักการศึกษา</strong></font></span></td>
      <td >
		ปีการศึกษา <?=$acadyear?>  ภาคเรียนที่ <?=$acadsemester?> <br/>
		<font   size="2" color="#000000">
		<form method="post">
			เลขประจำตัวนักเรียน <input type="text" name="studentid" onkeypress="return isNumberKey(event)" value="<?=isset($_POST['studentid'])?$_POST['studentid']:""?>" maxlength="5" size="5" class="inputboxUpdate" />
			<input type="submit" name="search" value="เรียกดู" class="button" />
		</form>
		</font>
	  </td>
    </tr>
</table>

<?php
	if(isset($_POST['updateHistory']) && isset($_POST['studentid'])){
		$_sql = "update students set 
					studstatus = '" . $_POST['studstatus'] . "',
					retirecause = '" . $_POST['retirecause'] . "',
					students.CAUSE = '" . $_POST['CAUSE'] . "',
					students.LEAVE = '" . $_POST['LEAVE'] . "'
				where ID = '" . $_POST['studentid'] . "' and xEDBE = '" . $acadyear . "'";
		$_update = mysql_query($_sql) or die (mysql_error());
		if($_update)
		{ ?>
			<table class="admintable" width="100%" align="center">
				<tr>
					<td class="key" colspan="2">ผลการดำเนินการ</td>
				</tr>
				<tr>
					<td width="100px">&nbsp;</td>
					<td><font color="#008000" size="3"><b>แก้ไขประวัติเรียบร้อยแล้ว</b></font></td>
				</tr>
			</table>
	<?	} //end if_update
	}// end if_submit updateHisotry
?>

<?php
	$_result;
	if(isset($_POST['studentid']))
	{
		$_sql = "select * from students 
					where xEDBE = '" . $acadyear . "'
						and ID = '". $_POST['studentid'] . "'";
		$_result = mysql_query($_sql);
?>

<?php if(mysql_num_rows($_result)>0) { ?>
	<? $_dat = mysql_fetch_assoc($_result); ?>
<form method="post" name="myform">
<table class="admintable" cellpadding="0" cellspacing="0" align="center" width="100%">
	<tr><td colspan="3" class="key">รายการแก้ไขข้อมูลนักเีรียนกรณี ออก/ลาออก/แขวนลอย</td></tr>
	<tr><td align="right" >เลขประจำตัว :</td>
		<td>
			<b><?=$_dat['ID']?></b><input type="hidden" name="studentid" value="<?=$_dat['ID']?>" />
		</td>
		<td rowspan="9" valign="top">
			<? if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/pk/images/studphoto/id" . $_dat['ID'] . ".jpg"))
						{ echo "<img src='../images/studphoto/id" . $_dat['ID'] . ".jpg' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #000000'/><br/>"; }
						else 
						{echo "<img src='../images/" . ($_dat['SEX']==1?"_unknown_male":"_unknown_female") . ".png' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/><br/>"; } ?>
		</td>
	</tr>
	<tr>
	  <td align="right">ชื่อ - สกุล :</td>
	  <td>
			<b><?=$_dat['PREFIX'] . $_dat['FIRSTNAME'] . ' ' . $_dat['LASTNAME'] ?></b>
		</td>
  </tr>
  <tr>
	  <td align="right">ระดับชั้น :</td>
	<td> <b><?=($_dat['xLevel']==3?$_dat['xYearth']:$_dat['xYearth']+3) . '/' . $_dat['ROOM']?></b></td>
  </tr>
  <tr>
	  <td align="right">ปีการศึกษา :</td>
	  <td><input type="text" value="<?=$acadyear?>" name="xEDBE" class="inputboxUpdate" size="4" disabled="disabled" /></td>
  </tr>
  <tr>
	  <td align="right">สถานภาพปัจจุบัน :</td>
	  <td>
	  	<select id="studstatus" name="studstatus" class="inputboxUpdate">
		<?php
			$_resStatus = mysql_query("SELECT * FROM ref_studstatus where studstatus != '2'");
			while($_datStatus = mysql_fetch_assoc($_resStatus))
			{  ?>
				<option value="<?=$_datStatus['studstatus']?>" <?=($_dat['studstatus']==$_datStatus['studstatus']?"SELECTED":"")?>><?=$_datStatus['studstatus_description']?></option>
		<?	} mysql_free_result($_resStatus); ?>
		</select> <font color="#FF0000"><b>*</b></font>
	  </td>
  </tr>
  <tr>
  		<td align="right">ประเภทของสาเหตุ :</td>
		<td>
			<select id="retirecause" name="retirecause" class="inputboxUpdate">
			<? $_resRetire = mysql_query("SELECT * FROM ref_retire where retire_id != '11' "); ?>
				<option value=""></option>
			<?	while($_datRe = mysql_fetch_assoc($_resRetire)) {  ?>
					<option value="<?=$_datRe['retire_id']?>" <?=($_dat['retirecause']==$_datRe['retire_id']?"SELECTED":"")?>><?=$_datRe['retire_description']?></option>
			<?	} mysql_free_result($_resRetire); ?>
			</select> <font color="#FF0000"><b>*</b></font>
		</td>
  </tr>
  <tr>
  		<td align="right" valign="top">สาเหตุ :</td>
		<td>
			<textarea id="cause" name="CAUSE" class="inputboxUpdate" cols="50" rows="3"><?=$_dat['CAUSE']?></textarea>
		</td>
  </tr>
  <tr>
  		<td align="right">วันที่ออก/แขวนลอย :</td>
		<td>
			<input id="leave" type="text" value="<?=$_dat['LEAVE']?>" name="LEAVE" class="inputboxUpdate" size="10" maxlength="10" onkeypress="return isKeyNumber(event)" />
			<font color="#FF0000"><b>*</b></font>
			ตัวอย่าง = 10/03/2548
		</td>
  </tr>
  <tr>
	  <td align="right">&nbsp;</td>
	  <td>
			<input type="hidden" name="updateHistory" />
			<input type="button" value="บันทึก" class="button" onclick="checkValue()" /> 
			<input type="button" value="ยกเลิก" class="button" onclick="location.href='index.php?option=module_history/index'" />	
	  </td>
  </tr>
</table>
</form>
<? } else { //end-if-check-rows ?>
	<table width="100%" class="admintable">
			<tr><td class="key" colspan="2">ผลการค้นหานักเรียน</td></tr>
			<tr>
				<td align="center"><br /><font color="#FF0000">ผลการค้นหาผิดพลาด อาจเนื่องมาจากเลขประจำตัวของนักเรียนผิด<br/>กรุณาทดลองค้นหาใหม่อีกครั้ง</font>
				</td>
			</tr>
		</table>
<? } //end-else_check-rows ?>
<? } //end-if-check-submit-search ?>
</div>
   