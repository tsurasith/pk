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
	  	if(document.getElementById('project_id').value == '' || document.getElementById('project_id').value.length != 10)
			{ alert('กรุณาป้อนข้อมูล รหัสกิจกรรม/โครงการให้ถูกต้อง'); document.getElementById('project_id').focus(); return;}
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
	<span class="normal"><font color="#0066FF"><strong>1.1 บันทึกข้อมูลกิจกรรม/โครงการ</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_projects/addnew&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo "<a href=\"index.php?option=module_projects/addnew&acadyear=" . ($acadyear + 1) . "\"> <img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		 ภาคเรียนที่   <?php 
					if($acadsemester == 1){ echo "<font color='blue'>1</font> , "; }
					else{
						echo " <a href=\"index.php?option=module_projects/addnew&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2){ echo "<font color='blue'>2</font>"; }
					else{
						echo " <a href=\"index.php?option=module_projects/addnew&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
	  </td>
    </tr>
  </table>

 
 <? if(!isset($_POST['save'])){ ?>
<form method="post" autocomplete="off" name="myform">
	<table class="admintable" width="100%" align="center">
		<tr>
			<td class="key" colspan="2">รายละเีอียดกิจกรรม/โครงการ</td>
		</tr>
		<tr>
			<td align="right" class="key">ภาคเรียนที่ :</td>
			<td><b><font color="#0000FF"><?=$acadsemester?></font>/<font color="#0000FF"><?=$acadyear?></font></b></td>
		</tr>
		<tr>
			<td align="right" width="200px" valign="top" class="key">รหัสกิจกรรม/โครงการ :</td>
			<td>
				<input type="text" id="project_id" name="project_id" class="noborder2" size="10" maxlength="10" value="<?=isset($_POST['save'])?$_POST['project_id']:getNextProjectID($acadyear,$acadsemester)?>" />
				<font color="#FF0000">*</font>(อัตโนมัติ รูปแบบ : YYYY-T-XXX)
			</td>
		</tr>
		<tr>
			<td align="right" class="key">ชื่อกิจกรรม/โครงการ :</td>
			<td><input type="text" id="project_name" name="project_name" class="noborder2" size="50" maxlength="255" value="<?=isset($_POST['save'])?$_POST['project_name']:""?>" /><font color="#FF0000">*</font></td>
		</tr>
		<tr>
			<td align="right" valign="top" class="key">หลักการและเหตุผล :</td>
			<td>
				<textarea id="detail" name="detail" cols="70" rows="12" class="inputboxUpdate" ><?=isset($_POST['save'])?$_POST['detail']:""?></textarea>
			</td>
		</tr>
		<tr>
			<td align="right" valign="top" class="key">เป้าหมายเชิงปริมาณ :</td>
			<td>
				<input type="radio" id="purpose1" name="purpose" value="1" <?=isset($_POST['purpose'])&&$_POST['purpose']==1?"checked":""?> /> ผ่านเกณฑ์ที่ตั้งไว้ <br/>
				<input type="radio" id="purpose2" name="purpose" value="0" <?=isset($_POST['purpose'])&&$_POST['purpose']==0?"checked":""?>/> ไม่ผ่านเกณฑ์ที่ตั้งไว้
			</td>
		</tr>
		<tr>
			<td align="right" class="key">วันที่เริ่ม :</td>
			<td><input type="text" name="start_date" id="start_date" size="10" onClick="showCalendar(this.id)" value="<?=isset($_POST['start_date'])?$_POST['start_date']:""?>" class="noborder2"  /><font color="#FF0000">*</font></td>
		</tr>
		<tr>
			<td align="right" class="key">วันที่สิ้นสุด :</td>
			<td><input type="text" name="finish_date" id="finish_date" size="10" onClick="showCalendar(this.id)" value="<?=isset($_POST['finish_date'])?$_POST['finish_date']:""?>" class="noborder2"  /><font color="#FF0000">*</font></td>
		</tr>
		<tr>
			<td height="51" align="right" valign="top" class="key">เงินงบประมาณที่ใช้ :</td>
			<td>
				<input type="radio" id="budget_type1" name="budget_type" value="00" <?=isset($_POST['budget_type'])&&$_POST['budget_type']=="00"?"checked":""?> /> เงินงบประมาณแผ่นดิน <br/>
				<input type="radio" id="budget_type2" name="budget_type" value="01" <?=isset($_POST['budget_type'])&&$_POST['budget_type']=="01"?"checked":""?>/> เงินอุดหนุนอื่น
			</td>
		</tr>
		<tr>
			<td align="right" valign="top" class="key">ฝ่ายที่รับผิดชอบกิจกรรม/โครงการ :</td>
			<td valign="top">
				<select name="budget_academic" id="budget_academic" class="inputboxUpdate">
					<option value=""></option>
					<option value="กิจการนักเรียน">กิจการนักเรียน</option>
					<option value="วิชาการ">วิชาการ</option>
					<option value="บริหารทั่วไป">บริหารทั่วไป</option>
					<option value="อำนวยการ">อำนวยการ</option>
				</select><font color="#FF0000">*</font>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">จำนวนเงินงบประมาณที่ได้รับ :</td>
			<td><input type="text" id="budget_income" name="budget_income" size="10" value="<?=isset($_POST['budget_income'])?$_POST['budget_income']:""?>" onkeypress="return isNumberKey(event)" class="noborder2"  /> บาท <font color="#FF0000">*</font></td>
		</tr>
		<tr>
			<td align="right" class="key">ผู้บันทึกข้อมูล :</td>
			<td><?=$_SESSION['name']?></td>
		</tr>
		<tr>
			<td align="right"></td>
			<td>
				<input type="hidden" value="save" name="save" />
				<input type="button"  value="บันทึก" onclick="checkFormValue()" class="button" />
			</td>
		</tr>
	</table>
</form>
<? } else { 
	$_chekcID = mysql_num_rows(mysql_query("select project_id from project where project_id = '" . $_POST['project_id'] . "'"));
	if($_checkID > 0) { ?>
		<center><br/><font color="#FF0000">ไม่สามารถบันทึกข้อมูลได้เนื่องจาก "รหัสกิจกรรม/โครงการ" ซ้ำกับฐานข้อมูลเดิม</font><br/>
		<input type="button" value="ย้อนกลับ" onclick="history.go(-1)" />
		</center>
	<? } //end if check Project_id repeated ?>
<?
		$_sql = "insert into project values (
					'" . $_POST['project_id'] . "',
					'" . trim($_POST['project_name']) . "',
					'" . $acadyear . "',
					'" . $acadsemester . "',
					'" . trim($_POST['detail']) . "',
					'" . $_POST['purpose'] . "',
					'" . $_POST['start_date'] . "',
					'" . $_POST['finish_date'] . "',
					'" . $_POST['budget_type'] . "',
					'" . $_POST['budget_academic'] . "',
					'" . $_POST['budget_income'] . "',
					'" . $_SESSION['name'] ."'
						)";
		if(mysql_query($_sql)) { ?>
			<center><br/>
				<font color="#008000">บันทึกกิจกรรมโครงการเรียบร้อยแล้ว</font>
					<br/><br/><input type="button" value="ดำเนินการต่อไป" onclick="location.href= 'index.php?option=module_projects/index'" />
			</font></center>
<?		} else { echo "<center><font color='red'><br/> ผิดพลาดเนื่องจาก - " . mysql_error() . "</font></center>";} //end insert
   } //end else
?>
</div>

<?php
	function getNextProjectID($acadyear,$acadsemester)
	{
		$_sql = "select substr(project_id,8,3) as id from project where acadyear='".$acadyear."' and acadsemester='".$acadsemester."' order by 1 desc limit 0,1";
		$_dat = mysql_fetch_assoc(mysql_query($_sql));
		if($_dat['id']==""){
			return  $acadyear.'-'.$acadsemester.'-001';
		}
		else
		{
			$_x = (int)$_dat['id']+1;
			if($_x >= 100) return $acadyear.'-'.$acadsemester.'-'.$_x;
			else if($_x >= 10) return $acadyear.'-'.$acadsemester.'-0'.$_x;
			else return $acadyear.'-'.$acadsemester.'-00'.$_x;
		}
	}
?>