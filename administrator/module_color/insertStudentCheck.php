<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
		<tr>
			<td width="6%" align="center"><img src="../images/color.png" alt="" width="48" height="48" /></td>
			<td ><strong><font color="#990000" size="4">กิจกรรมคณะสี</font></strong><br />
				<span class="normal"><font color="#0066FF"><strong>ผลการดำเนินการบันทึกข้อมูลการเข้าร่วมกิจกรรมคณะสี</strong></font></span></td>
			<td >&nbsp;</td>
		</tr>
	</table>
	
	<?php
	for($i =0 ;$i < $_POST['count'] ;$i ++)
	{
		$row_id = '';
		if($i < 10) { $row_id = $_POST['date'] . $_POST['student_id'][$i] . '0' .$i; }
		else { $row_id = $_POST['date'] . $_POST['student_id'][$i] .$i; }
		$sql_insert_student = 'INSERT INTO student_color VALUES (\'' . $row_id . '\', \'' . $_POST['student_id'][$i]  . '\', \''. $_POST['room_id'][$i] .'\', \'' . timecheck_id($_POST['check'][$i]) .'\', \'' . $_POST['color'] . '\' , \''. $_POST['date'] . '\',\'' . date('Y-m-d') . '\', \'' . $acadyear . '\', \'' . $acadsemester . '\', \''. $_SESSION['name']  . '\');'; 
		$a = mysql_query($sql_insert_student) or die ('insert student_color Error - ' . mysql_error());  // บันทึกข้อมูลการเช็ค
	}
	updateTask($_POST['date'],$_POST['task_id']); // อัพเดทสถานะงานเป็น "บันทึก" แล้ว
	?>
	<table width="100%" class="admintable">
		<tr height="35px"> 
			<td colspan="3" class="key">ผลการดำเนินงาน</td>
		</tr>
		<tr>
			<td rowspan="3" width="100px">&nbsp;</td>
			<td width="150px" align="right">ตรวจสอบรายชื่อห้อง :</td><td align="left"><font color="#009900">เรียบร้อย</font></td>
		</tr>
		<tr>
			<td align="right">บันทึกการเข้าแถว :</td><td align="left"><font color="#009900">เรียบร้อย</font></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<form action="index.php?option=module_color/dateTaskList" method="post">
					<input type="hidden" name="date" value="<?=$_POST['date']?>"/>
					<input type="submit" value="ดำเนินการต่อไป" />
				</form>
			</td>
		</tr>
	</table>
</div>
<?php
function timecheck_id($value) {
	if($value == 'white') return '00';
	if($value == 'lightgreen') return '01';
	if($value == 'yellow') return '02';
	if($value == 'blue') return '03';
	if($value == 'red') return '04';
	else return 9;
}
function updateTask($date,$task_id) {
	$sql = "update student_color_task set task_status = '1' where task_date = '" . $date . "' and task_roomid = '" . $task_id . "'" ;
	mysql_query($sql) or die ('Error - ' . mysql_error()); 
}
?>