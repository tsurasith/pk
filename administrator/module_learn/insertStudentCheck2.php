<?php
/* echo $_SESSION['name'] . "<br/>";
echo $_POST['room_id'] . "<br/>";
echo date('Y-m-d') . "<br/>";
echo $_POST['date'] . "<br/>"; */

for($i =1 ;$i < $_POST['count'] ;$i ++)
{
	$row_id = '';
	for($_period=1;$_period<=8;$_period++){
		if($i < 10) { $row_id = $_POST['date'] . '-' . $_POST['room_id'] . '-' . $_period . '-' . '0' .$i; }
		else { $row_id = $_POST['date'] . '-' . $_POST['room_id'] . '-' . $_period . '-' .$i; }
		$sql_insert_student = "INSERT INTO student_learn VALUES (
								'" . $row_id . "',
								'" . $_POST['student_id'][$i]  . "',
								'" . $_POST['room_id'] ."',
								'" . $_period . "' , 
								'" . timecheck_id($_POST['sCheck'][$i][$_period]) . "',
								'" . $_POST['date'] . "',
								'" . date('Y-m-d') . "',
								 " . $_POST['acadyear'] . ",
								 " . $_POST['acadsemester'] . ", 
								'" . $_SESSION['name']  . "')";
		//echo $sql_insert_student . '<br/>';
		$a = mysql_query($sql_insert_student) or die ('ผิดพลาดเนื่องจาก - ' . mysql_error());  // บันทึกข้อมูลการเช็ค
	}
}

	for($_period=1;$_period<=8;$_period++)
	{
		$sql_insert_teacher = "insert into  teachers_learn VALUES (
									'" . $_POST['date'] . '-' . $_POST['room_id'] . '-' . '0' . $_period . "',
									'" . $_POST['room_id'] ."', 
									'" . $_period . "' , 
									'" . $_POST['tCheck'][$_period] . "' , 
									'" . $_POST['date'] . "',
									 " . $_POST['acadyear'] . ", 
									 " . $_POST['acadsemester'] . ")";
		 $b = mysql_query($sql_insert_teacher) or die ('Error - '. mysql_error()); // บันทึกการเข้าใช้งานของครู
		//echo $sql_insert_teacher . '<br/>';
		updateTask($_POST['date'],$_POST['room_id'],$_period); // อัพเดทสถานะงานเป็น "บันทึก" แล้ว
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
    <div style="width:100%;" align="center">
        <table width="75%" border="0" cellspacing="1" cellpadding="3" align="center" bgcolor="#CC99FF">
          <tr bgcolor="#CCCCCC"> 
            <td colspan="2"><font size="2"  ><strong>ผลการดำเนินงาน</strong></font></td>
          </tr>
          <tr bgcolor="white"> 
            <td width="150px"><font size="2"  >ตรวจสอบรายชื่อห้อง</font></td>
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
                <form action="index.php?option=module_learn/dateTaskList2" method="post">
                    <input type="hidden" name="date" value="<?=$_POST['date']?>"/>
                    <input type="submit" name="Submit" value="ดำเนินการต่อไป" />
                </form>
                <br/>
            </td>
          </tr>
        </table>
    </div>
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