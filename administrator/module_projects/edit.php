<SCRIPT language="Javascript" type="text/javascript">
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
      }
	  function checkFormValue()
	  {
		if(document.getElementById('project_name').value == '' || document.getElementById('project_name').value.length < 6)
			{ alert('กรุณาป้อนข้อมูล ชื่อรหัสกิจกรรม/โครงการก่อน'); document.getElementById('project_name').focus(); return;}
		if(document.getElementById('detail').value == '' || document.getElementById('detail').value.length < 6)
			{ alert('กรุณาป้อนข้อมูล รายละเอียดกิจกรรมหรือหลักการและเหตุผลก่อน'); document.getElementById('detail').focus(); return;}
		if(!document.getElementById('purpose1').checked && !document.getElementById('purpose2').checked)
			{ alert('กรุณาเลือก ผลการประเมินตามเป้าหมายเชิงปริมาณก่อน'); document.getElementById('purpose1').focus(); return;}
		if(document.getElementById('start_date').value == '' || document.getElementById('start_date').value.length < 10)
			{ alert('กรุณาป้อนข้อมูล วันที่เริ่มโครงการก่อน'); document.getElementById('start_date').focus(); return;}
		if(document.getElementById('finish_date').value == '' || document.getElementById('finish_date').value.length < 10)
			{ alert('กรุณาป้อนข้อมูล วันที่สิ้นสุดโครงการก่อน'); document.getElementById('finish_date').focus(); return;}
		if(!document.getElementById('budget_type1').checked && !document.getElementById('budget_type2').checked)
			{ alert('กรุณาเลือก แหล่งเงินงบประมาณที่ใช้ก่อน'); document.getElementById('budget_type1').focus(); return;}
		if(document.getElementById('budget_academic').value == '')
			{ alert('กรุณาเลือก ฝ่ายที่เป็นเจ้าของกิจกรรม/โครงการก่อน'); document.getElementById('budget_academic').focus(); return;}
		if(document.getElementById('budget_income').value == '')
			{ alert('กรุณาป้อนข้อมูลจำนวนงบประมาณที่ได้รับการอนุมัติก่อน'); document.getElementById('budget_income').focus(); return;}
		else { document.myform.submit();}
	  }
   </SCRIPT>
<div id="content">
	<link rel="stylesheet" type="text/css" href="module_projects/css/calendar-mos2.css"/>
	<script language="JavaScript" type="text/javascript" src="module_projects/js/calendar.js"></script>
	<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
		<tr>
			<td width="6%" align="center">
				<a href="index.php?option=module_projects/index">
				<img src="../images/computer.png" alt="" width="48" height="48" border="0"/>
				</a>
			</td>
			<td ><strong><font color="#990000" size="4">ระบบสารสนเทศกิจกรรม/โครงการ</font></strong><br />
				<span class="normal"><font color="#0066FF"><strong>1.1 บันทึกข้อมูลกิจกรรม/โครงการ &gt;&gt; แก้ไขข้อมูล</strong></font></span></td>
			<td>
			<?php
				if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
				if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
			?>
			ปีการศึกษา<?php  
						echo "<a href=\"index.php?option=module_projects/edit&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
						echo ' <font color=\'blue\'>' .$acadyear . '</font>';
						echo "<a href=\"index.php?option=module_projects/edit&acadyear=" . ($acadyear + 1) . "\"> <img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
					?>
			 ภาคเรียนที่   <?php 
						if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
						else {
							echo " <a href=\"index.php?option=module_projects/edit&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
						}
						if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
						else {
							echo " <a href=\"index.php?option=module_projects/edit&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
						}
					?>
			</td>
		</tr>
	</table>


<form method="post" autocomplete="off">
	<table class="admintable" width="100%" align="center">
		<tr>
			<td class="key" colspan="2">
				<? $_res = mysql_query("select project_id,project_name from project where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' "); ?>
				ชื่อกิจกรรมโครงการ 
				<select name="project_id" class="inputboxUpdate">
					<option value=""></option>
					<? while($_dat = mysql_fetch_assoc($_res)) { ?>
						<option value="<?=$_dat['project_id']?>" <?=$_POST['project_id']==$_dat['project_id']?"selected":""?>><?=strlen(trim($_dat['project_name']))>102?(substr($_dat['project_name'],0,102) . "..."):$_dat['project_name']?></option>
					<? }//end while ?>
				</select> <input type="submit" class="button" name="search" value="เรียกดู" />
			</td>
		</tr>
	</table>
</form>

<? if($_POST['save']){ 
		$_sql = "update project set
					project_name = '" . trim($_POST['project_name']) . "',
					detail = '" . trim($_POST['detail']) . "',
					purpose = '" . $_POST['purpose'] . "',
					start_date = '" . $_POST['start_date'] . "',
					finish_date = '" . $_POST['finish_date'] . "',
					budget_type = '" . $_POST['budget_type'] . "',
					budget_income = '" . $_POST['budget_income'] . "',
					budget_academic = '" . $_POST['budget_academic'] . "'
					where project_id = '" . $_POST['project_id'] ."'";
		if(mysql_query($_sql)) { ?>
			<center><br/><font color="#008000">บันทึกแก้ไขกิจกรรมโครงการเรียบร้อยแล้ว</font></center>
	<?  } else { echo "<center><font color='red'><br/>ผิดพลาดเนื่องจาก - " . mysql_error . "</font></center>";} ?>
<? } //end update ?>

<? if(isset($_POST['search']) && $_POST['project_id'] == "") { ?>
		<center><font color="#FF0000"><br/>กรุณาเลือก กิจกรรม/โครงการ ที่ต้องการแก้ไขข้อมูลก่อน</font></center>
<? } ?>

<? if(isset($_POST['search']) && $_POST['project_id'] != ""){ ?>
<? $_sql = "select * from project where project_id ='" . $_POST['project_id'] ."'"; ?>
<? $_res = @mysql_query($_sql); ?>
<? if(@mysql_num_rows($_res)>0) { ?>
	<?	$_dat = mysql_fetch_assoc($_res); ?>
<form method="post" name="myform" autocomplete="off">
	<table class="admintable" width="100%" align="center">
		<tr>
			<td align="right" class="key">ภาคเรียนที่ :</td>
			<td><b><font color="#0000FF"><?=$acadsemester?></font>/<font color="#0000FF"><?=$acadyear?></font></b></td>
		</tr>
		<tr>
			<td align="right" width="200px" valign="top" class="key">รหัสกิจกรรม/โครงการ :</td>
			<td>
				<input type="text" name="project_id" class="noborder2" size="10" maxlength="10" value="<?=$_dat['project_id']?>" readonly="true" />
			</td>
		</tr>
		<tr>
			<td align="right" class="key">ชื่อกิจกรรม/โครงการ :</td>
			<td><input type="text" id="project_name" name="project_name" class="noborder2" size="50" maxlength="255" value="<?=$_dat['project_name']?>" /><font color="#FF0000">*</font></td>
		</tr>
		<tr>
			<td align="right" valign="top" class="key">หลักการและเหตุผล :</td>
			<td>
				<textarea id="detail" name="detail" cols="70" rows="12" class="inputboxUpdate" ><?=$_dat['detail']?></textarea>
			</td>
		</tr>
		<tr>
			<td align="right" valign="top" class="key">เป้าหมายเชิงปริมาณ :</td>
			<td>
				<input type="radio" id="purpose1" name="purpose" value="1" <?=$_dat['purpose']==1?"checked":""?> /> ผ่านเกณฑ์ที่ตั้งไว้ <br/>
				<input type="radio" id="purpose2" name="purpose" value="0" <?=$_dat['purpose']==0?"checked":""?>/> ไม่ผ่านเกณฑ์ที่ตั้งไว้
			</td>
		</tr>
		<tr>
			<td align="right" class="key">วันที่เริ่ม :</td>
			<td><input type="text" name="start_date" id="start_date" size="10" onClick="showCalendar(this.id)" value="<?=$_dat['start_date']?>" class="noborder2"  /><font color="#FF0000">*</font></td>
		</tr>
		<tr>
			<td align="right" class="key">วันที่สิ้นสุด :</td>
			<td><input type="text" name="finish_date" id="finish_date" size="10" onClick="showCalendar(this.id)" value="<?=$_dat['finish_date']?>" class="noborder2"  /><font color="#FF0000">*</font></td>
		</tr>
		<tr>
			<td height="51" align="right" valign="top" class="key">เงินงบประมาณที่ใช้ :</td>
			<td>
				<input type="radio" id="budget_type1" name="budget_type" value="00" <?=$_dat['budget_type']=="00"?"checked":""?> /> เงินงบประมาณแผ่นดิน <br/>
				<input type="radio" id="budget_type2" name="budget_type" value="01" <?=$_dat['budget_type']=="01"?"checked":""?>/> เงินอุดหนุนอื่น
			</td>
		</tr>
		<tr>
			<td align="right" valign="top" class="key">ฝ่ายที่รับผิดชอบกิจกรรม/โครงการ :</td>
			<td valign="top">
				<select name="budget_academic" id="budget_academic" class="inputboxUpdate">
					<option value=""></option>
					<option value="กิจการนักเรียน" <?=$_dat['budget_academic']=="กิจการนักเรียน"?"selected":""?>>กิจการนักเรียน</option>
					<option value="วิชาการ" <?=$_dat['budget_academic']=="วิชาการ"?"selected":""?>>วิชาการ</option>
					<option value="บริหารทั่วไป" <?=$_dat['budget_academic']=="บริหารทั่วไป"?"selected":""?>>บริหารทั่วไป</option>
					<option value="อำนวยการ" <?=$_dat['budget_academic']=="อำนวยการ"?"selected":""?>>อำนวยการ</option>
				</select><font color="#FF0000">*</font>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">จำนวนเงินงบประมาณที่ได้รับ :</td>
			<td><input type="text" id="budget_income" name="budget_income" size="10" value="<?=$_dat['budget_income']?>" onkeypress="return isNumberKey(event)" class="noborder2"/><font color="#FF0000">*</font></td>
		</tr>
		<tr>
			<td align="right" class="key">ผู้บันทึกข้อมูล :</td>
			<td><?=$_dat['user_create']?></td>
		</tr>
		<tr>
			<td align="right"></td>
			<td>
				<input type="hidden" name="p_id" value="<?=$_POST['p_id']?>" />
				<input type="hidden" name="save" value="save" />
				<input type="button" onclick="checkFormValue()" value="บันทึก" class="button" />
			</td>
		</tr>
	</table>
</form>
<? } else { ?>
		<center><br/><font color="#FF0000">ไม่พบข้อมูลโครงการ ตามรหัสกิจกรรมที่ค้นหา</font></center>
	<? } //end else search ?>
<? } //end if submit search ?>

</div>
