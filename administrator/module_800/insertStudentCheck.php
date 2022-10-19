
<?php
/* echo $_SESSION['name'] . "<br/>";
echo $_POST['room_id'] . "<br/>";
echo date('Y-m-d') . "<br/>";
echo $_POST['date'] . "<br/>"; */

	for($i =0 ;$i < $_POST['count'] ;$i ++)
	{
		$row_id = '';
		if($i < 10)
		{
			$row_id = $_POST['date'] . $_POST['room_id'] . '0' .$i;
		}
		else
		{
			$row_id = $_POST['date'] . $_POST['room_id'] .$i;
		}
		$sql_insert_student = 'INSERT INTO student_800 VALUES (\'' . $row_id . '\', \'' . $_POST['student_id'][$i]  . '\', \''. $_POST['room_id'] .'\', \'' . timecheck_id($_POST['check'][$i]) .'\', \''. $_POST['date'] . '\',\'' . date('Y-m-d') . '\', ' .$_POST['acadyear'] .', ' . $_POST['acadsemester'] . ', \''. $_SESSION['name']  . '\');'; 
		$a = mysql_query($sql_insert_student) or die ('Error - ' . mysql_error());  // บันทึกข้อมูลการเช็ค
		if($_POST['check'][$i] == "yellow" || $_POST['check'][$i] == "blue" || $_POST['check'][$i] == "red")
		{
			$sql = "insert into student_discipline values (null,'" . $_POST['student_id'][$i] . "','" . $_POST['date'] . "','08.00',' ',' ','". $_SESSION['name'] . "',curdate(),
								'ครู','" . $_SESSION['name'] . "','" . $_POST['date'] . "','เห็นควรมอบให้หัวหน้าระดับดำเนินการสอบสวน',
								'" . disDetail($_POST['check'][$i]) . "','" . $_SESSION['name'] . "')";
			$sql_status = "insert into student_disciplinestatus values('" . $_POST['student_id'][$i]  . "',null,'1','00','0','" . $acadyear . "','" . $acadsemester . "')";
			mysql_query($sql);
			mysql_query($sql_status);
		}
	}
	
	
	$sql_insert_teacher = 'insert into  teachers_800 VALUES (\'' . $_POST['date'] . '-' . $_POST['room_id'] .'\',\'' . $_POST['room_id'] .'\',\'' . $_POST['teacherSign'] .'\' , \'' . $_POST['date'] .'\', ' .$_POST['acadyear'] .', ' . $_POST['acadsemester'] . ') ';
	$b = mysql_query($sql_insert_teacher) or die ('Error - '. mysql_error()); // บันทึกการเข้าใช้งานของครู
	updateTask($_POST['date'],$_POST['room_id']); // อัพเดทสถานะงานเป็น "บันทึก" แล้ว
?>
	  <div id="content">
	  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td width="45%"><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>ระบบบันทึกการเข้าร่วมกิจกรรมหน้าเสาธง</strong></font></span></td>
      <td >&nbsp;</td>
    </tr>
  </table>
  <br/>
<table width="75%" border="0" cellspacing="1" cellpadding="3" align="center" bgcolor="#CC99FF">
  <tr bgcolor="#CCCCCC"> 
    <td colspan="2"><font size="2"  ><strong>ผลการดำเนินงาน</strong></font></td>
  </tr>
  <tr bgcolor="white"> 
    <td width="200px"><font size="2"  >ตรวจสอบรายชื่อห้อง</font></td>
    <td><font color="#009900" size="2"  ><strong>เรียบร้อย</strong></font></td>
  </tr>
  <tr bgcolor="white"> 
    <td><font size="2"  >บันทึกรายการนัดพบ</font></td>
    <td><font color="#009900" size="2"  ><strong>เรียบร้อย</strong></font></td>
  </tr>
  <tr bgcolor="white"> 
    <td><font size="2"  >บันทึกการเข้าแถว</font></td>
    <td><font color="#009900" size="2"  ><strong>เรียบร้อย</strong></font></td>
  </tr>
  <tr bgcolor="white"> 
    <td><font size="2"  >บันทึกการเข้าร่วมของครูที่ปรึกษา</font></td>
    <td><font color="#009900" size="2"  ><strong>เรียบร้อย</strong></font></td>
  </tr>
  <tr bgcolor="white">
    <td colspan="2" align="center">
    	<br/>
		<form action="index.php?option=module_800/dateTaskList" method="post">
			<input type="hidden" name="date" value="<?=$_POST['date']?>"/>
			<input type="submit" value="ดำเนินการต่อไป" />
		</form>
	</td>
    <br/>
  </tr>
</table>
</div>
<?php

//-------------------------------
function timecheck_id($value)
{
	if($value == 'white') return '00';
	if($value == 'lightgreen') return '01';
	if($value == 'yellow') return '02';
	if($value == 'blue') return '03';
	if($value == 'red') return '04';
	else return 9;
}

function disDetail($value)
{
	if($value == 'yellow') return 'สายการเข้าร่วมกิจกรรมหน้าเสาธง';
	if($value == 'blue') return 'ลาการเข้าร่วมกิจกรรมหน้าเสาธง';
	if($value == 'red') return 'ขาดการเข้าร่วมกิจกรรมหน้าเสาธง';
	else return "ผิดพลาด";
}

function updateTask($date,$room_id)
{
	
	$sql = "update student_800_task set task_status = '1' where task_date = '" . $date . "' and task_roomid = '" . $room_id . "'" ;
	//echo $sql . "<br/>";
	mysql_query($sql) or die ('Error - ' . mysql_error());

}

?>