<?php
/* echo $_SESSION['name'] . "<br/>";
echo $_POST['room_id'] . "<br/>";
echo date('Y-m-d') . "<br/>";
echo $_POST['date'] . "<br/>"; */

for($i =0 ;$i < $_POST['count'] ;$i ++)
{
	$row_id = '';
	if($i < 10) { $row_id = $_POST['date'] . '-' . $_POST['room_id'] . '-' . $_POST['period'] . '-' . '0' .$i; }
	else { $row_id = $_POST['date'] . '-' . $_POST['room_id'] . '-' . $_POST['period'] . '-' .$i; }
	$sql_insert_student = 'INSERT INTO student_learn VALUES (\'' . $row_id . '\', \'' . $_POST['student_id'][$i]  . '\', \''. $_POST['room_id'] .'\', \'' . $_POST['period'] .'\' , \'' . timecheck_id($_POST['check'][$i]) .'\', \''. $_POST['date'] . '\',\'' . date('Y-m-d') . '\', \'' . $_POST['acadyear'] . '\', \'' . $_POST['acadsemester'] . '\', \''. $_SESSION['name']  . '\');'; 
	//echo $sql_insert_student . '<br/>';
	$a = mysql_query($sql_insert_student) or die ('ผิดพลาดเนื่องจาก - ' . mysql_error());  // บันทึกข้อมูลการเช็ค
}


$sql_insert_teacher = 'insert into  teachers_learn VALUES (\'' . $_POST['date'] . '-' . $_POST['room_id'] . '-' . $_POST['period'] .'\',\'' . $_POST['room_id'] .'\', \'' . $_POST['period'] . '\' , \'' . $_POST['teacherSign'] .'\' , \'' . $_POST['date'] .'\',\'' . $_POST['acadyear'] . '\', \'' . $_POST['acadsemester'] . '\' ) ';
$b = mysql_query($sql_insert_teacher) or die ('Error - '. mysql_error()); // บันทึกการเข้าใช้งานของครู
//echo $sql_insert_teacher . '<br/>';
updateTask($_POST['date'],$_POST['room_id'],$_POST['period']); // อัพเดทสถานะงานเป็น "บันทึก" แล้ว

//---- code เพิ่มเติมจากของเดิม(ส่วน checkbox)
for($cc = 1 ; $cc <= 8 ; $cc++)
{
	if($_POST['cperiod'][$cc] != "" || $_POST['cperiod'][$cc] != null)
	{
		for($loop  = 0 ; $loop < $_POST['count'] ; $loop++)
		{
			$row_id = '';
			if($loop < 10){$row_id = $_POST['date'] . '-' . $_POST['room_id'] . '-' . $_POST['cperiod'][$cc] . '-' . '0' .$loop;}
			else{$row_id = $_POST['date'] . '-' . $_POST['room_id'] . '-' . $_POST['cperiod'][$cc] . '-' .$loop;}
			$sql_insert_studentX = 'INSERT INTO student_learn VALUES (\'' . $row_id . '\', \'' . $_POST['student_id'][$loop]  . '\', \''. $_POST['room_id'] .'\', \'' . $_POST['cperiod'][$cc] .'\' , \'' . timecheck_id($_POST['check'][$loop]) .'\', \''. $_POST['date'] . '\',\'' . date('Y-m-d') . '\', \'' . $_POST['acadyear'] . '\', \'' . $_POST['acadsemester']  . '\', \''. $_SESSION['name']  . '\');'; 
			$aa = mysql_query($sql_insert_studentX)or die ('Error - ' . mysql_error());  // บันทึกข้อมูลการเช็ค
		}
		$sql_insert_teacherX = 'insert into  teachers_learn VALUES (\'' . $_POST['date'] . '-' . $_POST['room_id'] . '-' . $_POST['cperiod'][$cc] .'\',\'' . $_POST['room_id'] .'\', \'' . $_POST['cperiod'][$cc] . '\' , \'' . $_POST['cTeacherSign'][$cc] .'\' , \'' . $_POST['date'] .'\',\'' .  $_POST['acadyear'] . '\', \'' . $_POST['acadsemester'] . '\' ); ';
		$bb = mysql_query($sql_insert_teacherX) or die ('Error - '. mysql_error()); // บันทึกการเข้าใช้งานของครู
		updateTask($_POST['date'],$_POST['room_id'],$_POST['cperiod'][$cc]); // อัพเดทสถานะงานเป็น "บันทึก" แล้ว
	}
}

?>
<div id="content">
 <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td width="45%"><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>ระบบบันทึกการเข้าเรียนของนักเรียน >> บันทึกข้อมูล</strong></font></span></td>
      <td>ปีการศึกษา <?=$acadyear?> ภาคเรียนที่ <?=$acadsemester?> </td>
    </tr>
  </table><br/>
<table width="75%" border="0" cellspacing="1" cellpadding="3" align="center" bgcolor="#CC99FF">
  <tr bgcolor="#CCCCCC"> 
    <td colspan="2"><font size="2"  ><strong>ผลการดำเนินงาน</strong></font></td>
  </tr>
  <tr bgcolor="white"> 
    <td width="200px"><font size="2"  >ตรวจสอบรายชื่อห้อง</font></td>
    <td><font color="#009900" size="2"  ><strong>เรียบร้อย</strong></font></td>
  </tr>
 
  <tr bgcolor="white"> 
    <td><font size="2"  >บันทึกการเข้าห้องเรียน</font></td>
    <td><font color="#009900" size="2"  ><strong>เรียบร้อย</strong></font></td>
  </tr>
  <tr bgcolor="white"> 
    <td><font size="2"  >บันทึกการเข้าร่วมของครูที่ปรึกษา</font></td>
    <td><font color="#009900" size="2"  ><strong>เรียบร้อย</strong></font></td>
  </tr>
  <tr bgcolor="white">
    <td colspan="2" align="center">
    	<br/>
		<form action="index.php?option=module_learn/dateTaskList" method="post">
			<input type="hidden" name="date" value="<?=$_POST['date']?>"/>
			<input type="submit" name="Submit" value="ดำเนินการต่อไป" />
		</form>
        <br/>
	</td>
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

function updateTask($date,$room_id,$period)
{
	
	$sql = "update student_learn_task set task_status = '1' where task_date = '" . $date . "' and task_roomid = '" . $room_id . "' and period = '" . $period . "'" ;
	//echo $sql . "<br/>";
	mysql_query($sql) or die ('Error - ' . mysql_error());

}

?>