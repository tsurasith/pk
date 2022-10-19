<? 
	for($i =0 ;$i < $_POST['count'] ;$i ++) {
		$sql_insert_student = 'update students set color = \'' . timecheck_id($_POST['check'][$i]) . '\' where id =\'' . $_POST['student_id'][$i]  . '\' and xedbe = \'' . $_POST['acadyear'] . '\'';
		$a = mysql_query($sql_insert_student) or die ('Error - ' . mysql_error());  // บันทึกข้อมูลการอัำปเดทรายการคณะสี
	}
?>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
		<tr>
			<td width="6%" align="center"><img src="../images/color.png" alt="" width="48" height="48" /></td>
		  <td><strong><font color="#990000" size="4">กิจกรรมคณะสี</font></strong><br />
			  <span class="normal"><font color="#0066FF"><strong>ผลการดำเนินการบันทึกแก้ไขข้อมูลคณะสีที่นักเรียนสังกัด</strong></font></span></td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<table align="center" width="100%"><tr><td align="center">
		<table width="75%"  class="admintable">
			<tr height="30px">
				<td colspan="2" class="key">ผลการดำเนินงาน </td>
			</tr>
			<tr>
				<td width="150" align="right">ตรวจสอบรายชื่อห้อง : </td>
				<td align="left"><font color="#009900" size="2"  ><strong>เรียบร้อย</strong></font></td>
			</tr>
			<tr> 
				<td align="right">บันทึกรายการคณะสี : </td>
				<td align="left"><font color="#009900" size="2"  ><strong>เรียบร้อย</strong></font></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<form>
						<input type="button" value="ดำเนินการต่อไป" onclick="window.location = 'index.php?option=module_color/updateStudentColorForm&acadyear=<?=$_POST['acadyear']?>&acadsemester=<?=$_POST['acadsemester']?>'"/>
					</form>
				</td>
			</tr>
		</table>
	</td></tr></table>
</div>

<?php

//-------------------------------
function timecheck_id($value)
{
	if($value == 'green') return 'เขียว';
	if($value == 'yellow') return 'เหลือง';
	if($value == 'orange') return 'ส้ม';
	if($value == 'violet') return 'ม่วง';
	if($value == 'pink') return 'ชมพู';
	else return 9;
}

?>