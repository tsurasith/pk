<SCRIPT language="javascript" type="text/javascript">
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
	  function checkValue(){
	  	if(document.getElementById('studstatus').value == "1")
		{alert('กรุณาเปลี่ยนสถานภาพนักเรียนให้ย้ายสถานศึกษาก่อน'); document.getElementById('studstatus').focus(); return;}
		if(document.getElementById('retirecause').value == "0")
		{alert('กรุณาเลือกประเภทสาเหตุที่ย้านสถานศึกษาก่อน'); document.getElementById('retirecause').focus(); return;}
		if(document.getElementById('cause').value == "")
		{alert('กรุณาระบุสาเหตุที่ย้ายโดยละเอียดก่อน'); document.getElementById('cause').focus(); return;}
		if(document.getElementById('leave').value == "" || document.getElementById('leave').value.length != 10)
		{alert('กรุณาระบุวันที่นักเรียนย้ายก่อน'); document.getElementById('leave').focus(); return;}
		else
		{document.move.submit();}
	  }
      //-->
   </SCRIPT>

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td align="center">
      <a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.4 แก้ไขข้อมูลนักเรียนย้ายสถานศึกษา(กรณีย้ายออก)</strong></font></span></td>
      <td>
	  			
				
		 <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_history/studentMove&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/studentMove&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?><br/>
		<font   size="2" color="#000000">
		<form method="post">
			เพิ่มข้อมูลนักเรียนย้ายโรงเรียน <input type="text" name="studentid" onkeypress="return isNumberKey(event)" value="<?=isset($_POST['studentid'])?$_POST['studentid']:""?>" maxlength="5" size="5" class="inputboxUpdate" />
			<input type="submit" name="search" value="เรียกดู" class="button" />
		</form>
		</font>
	  </td>
    </tr>
</table>

<?php
	$_message="";
	$_sqlUpdate;
	if(isset($_POST['saveEditMove']))
	{
		$_sqlUpdate = "update students set 
						studstatus = '" . $_POST['studstatus'] . "',
						retirecause = '" . $_POST['retirecause'] . "',
						students.leave = '" . $_POST['leave'] . "',
						students.cause = '" . $_POST['cause'] . "'
					where ID = '" . $_POST['id'] . "' and xEDBE = '" . $_POST['xEDBE'] . "'";
		if(mysql_query($_sqlUpdate))
		{echo "<br/><br/><center><font color='green'><b>บันทึกการย้ายสถานศึกษาเรียบร้อยแล้ว</b></font></center><br/>";}
		else{ echo "<br/><br/><center><font color='red'>บันทึกข้อมูลผิดพลาดเนื่องจาก : " . mysql_error() . " กรุณานำปัญหานี้แจ้งต่อผู้ดูแลระบบ</font></center><br/>";}
	}
?>

<?php
	$_sqlMove = "select id,prefix,firstname,lastname,xlevel,xyearth,room,students.cause,points,gpa
				 from students where xEDBE = '" . $acadyear . "' and studstatus = 5 order by xlevel,xyearth,room,id";
	$_resMove = mysql_query($_sqlMove);
	$_no = 1;
?>
<table class="admintable" cellpadding="1" cellspacing="1" align="center" width="100%">
	<tr><td colspan="7" class="key">รายชื่อนักเรียนย้ายสถานศึกษาปีการศึกษา <?=$acadyear?> </td></tr>
	<tr align="center" bgcolor="#CCCCFF">
		<td width="25px"><b>ที่</b></td>
		<td width="85px"><b>เลขประจำตัว</b></td>
		<td width="190px"><b>ชื่อ-สกุล</b></td>
		<td width="60px"><b>ห้อง</b></td>
		<td width="60px"><b>ผลการเรียน</b></td>
		<td width="85px"><b>คะแนน <br/>พฤติกรรม</b></td>
		<td><b>สาเหตุ</b></td>
	</tr>
	<? while($_dat = mysql_fetch_assoc($_resMove)) { ?>
	<tr>
		<td valign="top" align="center"><?=$_no++?></td>
		<td valign="top" align="center"><?=$_dat['id']?></td>
		<td valign="top"><?=$_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname'] ?></td>
		<td valign="top" align="center"><?=($_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3) . '/' . $_dat['room']?></td>
		<td valign="top" align="center"><?=$_dat['gpa']?></td>
		<td valign="top" align="center"><?=$_dat['points']?></td>
		<td valign="top"><?=$_dat['cause']?></td>
	</tr>
	<? } //end while ?>
</table>


<?	if(isset($_POST['search']) && mysql_num_rows(mysql_query("select ID from students where xEDBE = '" . $acadyear . "' and studstatus = '1' and ID = '" . $_POST['studentid'] . "'")) > 0 ) { ?>
	<? $_dat = mysql_fetch_assoc(mysql_query("select id,prefix,firstname,sex,lastname,xlevel,xyearth,room,students.cause,studstatus,retirecause from students where xEDBE = '" . $acadyear . "' and ID = '" . $_POST['studentid'] . "'")); ?>
		<form method="post" name="move">
		<table class="admintable" width="100%" align="center">
			<tr><td colspan="3" class="key">รายการแก้ไขข้อมูลการย้ายสถานศึกษาของนักเรียน</td></tr>
			<tr>
				<td width="200px" align="right">เลขประจำตัว :</td>
				<td><b><?=$_dat['id']?></b> <input type="hidden" name="id" value="<?=$_dat['id']?>" /> <input type="hidden" name="xEDBE" value="<?=$acadyear?>" /></td>
				<td valign="top" rowspan="8">
					<? if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/pk/images/studphoto/id" . $_dat['id'] . ".jpg"))
						{ echo "<img src='../images/studphoto/id" . $_dat['id'] . ".jpg' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #000000'/><br/>"; }
						else 
						{echo "<img src='../images/" . ($_dat['sex']==1?"_unknown_male":"_unknown_female") . ".png' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/><br/>"; } ?>
				</td>
			</tr>
			<tr>
				<td align="right">ชื่อ-สกุล :</td>
				<td><b><?=$_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname'] ?></b></td>
			</tr>
			<tr>
				<td align="right">ระดับชั้น :</td>
				<td><b><?=($_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3) . '/' . $_dat['room']?></b></td>
			</tr>
			<tr>
				<td align="right">สถานภาพ :</td>
				<td>
					<select id="studstatus" name="studstatus" class="inputboxUpdate">
				  		<?php
							$_resStatus = mysql_query("SELECT * FROM ref_studstatus where studstatus in (1,5)");
							while($_datStatus = mysql_fetch_assoc($_resStatus))
							{  ?>
								<option value="<?=$_datStatus['studstatus']?>" <?=($_dat['studstatus']==$_datStatus['studstatus']?"SELECTED":"")?>><?=$_datStatus['studstatus_description']?></option>
						<?	} mysql_free_result($_resStatus); ?>
					</select> <font color="#FF0000">*</font>
				</td>
			</tr>
			<tr>
				<td align="right">ประเภทสาเหตุ :</td>
				<td>
					<select id="retirecause" name="retirecause" class="inputboxUpdate">
				  		<?php
							$_resRetire = mysql_query("SELECT * FROM ref_retire");
							while($_datRe = mysql_fetch_assoc($_resRetire)) {  ?>
								<option value="<?=$_datRe['retire_id']?>" <?=($_dat['retirecause']==$_datRe['retire_id']?"SELECTED":"")?>><?=$_datRe['retire_description']?></option>
						<?	} mysql_free_result($_resRetire); ?>
					</select> <font color="#FF0000">*</font>
				</td>
			</tr>
			<tr>
				<td align="right" valign="top">สาเหตุที่่ย้าย :</td>
				<td>
					<textarea id="cause" class="inputboxUpdate" name="cause" cols="50" rows="3"></textarea>
					<font color="#FF0000">*</font>
				</td>
			</tr>
			<tr>
				<td align="right">วันที่ย้าย :</td>
				<td>
					<input id="leave" type="text" name="leave" size="10" class="inputboxUpdate" maxlength="10" />
					<font color="#FF0000">*</font> ตัวอย่าง 16/09/2552
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="hidden" name="saveEditMove" />
					<input type="button" value="บันทึก" class="button" onclick="checkValue();" /> 
					<input type="button" value="ยกเลิก" class="button" onclick="location.href='index.php?option=module_history/index'" />
				</td>
			</tr>
		</table>
		</form>
<? } else if (isset($_POST['search']) || mysql_num_rows(mysql_query("select ID from students where xEDBE = '" . $acadyear . "' and studstatus = '1' and ID = '" . $_POST['studentid'] . "'")) < 0 ){ //end-if__check เพิ่มข้อมูลนักเรียนย้ายใหม่ ?>
		<br/><br/>
		<table width="100%" class="admintable">
			<tr><td class="key" colspan="2">ผลการค้นหานักเรียน</td></tr>
			<tr>
				<td align="center"><br /><font color="#FF0000">ผลการค้นหาผิดพลาด อาจเนื่องมาจากเลขประจำตัวของนักเรียนผิด หรือ ป้อนเลขประจำตัวนักเรียนที่ย้ายแล้ว<br/>
					กรุณาทดลองค้นหาใหม่อีกครั้ง</font>
				</td>
			</tr>
		</table>
<? } // end_else?>
</div>
   