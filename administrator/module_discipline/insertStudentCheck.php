<?php 
	for($i =0 ;$i < $_POST['count'] ;$i ++) {
		$row_id = '';
		if($i < 10){ $row_id = $_POST['month'] . '-' . $_POST['room_id'] . '-' . $_POST['drugType'] . '-' . '0' .$i; }
		else{ $row_id = $_POST['month'] . '-' . $_POST['room_id'] . '-' . $_POST['drugType'] . '-' .$i; }
		$sql_insert_student = "INSERT INTO student_drug VALUES (
									'" . $row_id . "',
									'" . $_POST['student_id'][$i]  . "',
									'" . $_POST['room_id'] . "',
									'" . $_POST['drugType'] . "',
									'" . timecheck_id($_POST['check'][$i]) . "',
									'" . $_POST['month'] . "',
									'" . date('Y-m-d') . "',
									'" . $_POST['acadyear'] . "','" . $_POST['acadsemester'] . "','" . $_SESSION['name']  . "')"; 
		//echo $sql_insert_student . '<br/>';
		mysql_query($sql_insert_student) or die ('Error - ' . mysql_error());  // บันทึกข้อมูลการเช็ค
	}
	updateTask($_POST['month'],$_POST['room_id'],$_POST['drugType'],$_POST['acadyear']); // อัพเดทสถานะงานเป็น "บันทึก" แล้ว
	
	//---- บุหรี่
	if(isset($_POST['drugCheck00']) && $_POST['drugCheck00'] != "") {
		for($loop  = 0 ; $loop < $_POST['count'] ; $loop++) {
			$row_id = '';
			if($loop < 10){$row_id = $_POST['month'] . '-' . $_POST['room_id'] . '-' . $_POST['drugCheck00'] . '-' . '0' .$loop;}
			else{$row_id = $_POST['month'] . '-' . $_POST['room_id'] . '-' . $_POST['drugCheck00'] . '-' .$loop;}
			$sql_insert_studentX = 'INSERT INTO student_drug VALUES (\'' . $row_id . '\', \'' . $_POST['student_id'][$loop]  . '\', \''. $_POST['room_id'] .'\', \'' . $_POST['drugCheck00'] .'\' , \'' . timecheck_id($_POST['check'][$loop]) .'\', \''. $_POST['month'] . '\',\'' . date('Y-m-d') . '\', \'' . $_POST['acadyear'] . '\', \'' . $_POST['acadsemester']  . '\', \''. $_SESSION['name']  . '\');'; 
			//echo $sql_insert_studentX . "<br/>";
			$aa = mysql_query($sql_insert_studentX)or die ('Error - ' . mysql_error());  // บันทึกข้อมูลการเช็ค
		} //end for
		updateTask($_POST['month'],$_POST['room_id'],$_POST['drugCheck00'],$_POST['acadyear']); // อัพเดทสถานะงานเป็น "บันทึก" แล้ว
	}
	
	//-- แอลกอฮอล์
	if(isset($_POST['drugCheck01']) && $_POST['drugCheck01'] != "") {
		for($loop  = 0 ; $loop < $_POST['count'] ; $loop++) {
			$row_id = '';
			if($loop < 10){$row_id = $_POST['month'] . '-' . $_POST['room_id'] . '-' . $_POST['drugCheck01'] . '-' . '0' .$loop;}
			else{$row_id = $_POST['month'] . '-' . $_POST['room_id'] . '-' . $_POST['drugCheck01'] . '-' .$loop;}
			$sql_insert_studentX = 'INSERT INTO student_drug VALUES (\'' . $row_id . '\', \'' . $_POST['student_id'][$loop]  . '\', \''. $_POST['room_id'] .'\', \'' . $_POST['drugCheck01'] .'\' , \'' . timecheck_id($_POST['check'][$loop]) .'\', \''. $_POST['month'] . '\',\'' . date('Y-m-d') . '\', \'' . $_POST['acadyear'] . '\', \'' . $_POST['acadsemester']  . '\', \''. $_SESSION['name']  . '\');'; 
			//echo $sql_insert_studentX . "<br/>";
			$aa = mysql_query($sql_insert_studentX)or die ('Error - ' . mysql_error());  // บันทึกข้อมูลการเช็ค
		} //end for
		updateTask($_POST['month'],$_POST['room_id'],$_POST['drugCheck01'],$_POST['acadyear']); // อัพเดทสถานะงานเป็น "บันทึก" แล้ว
	}
	
	//-- ยาบ้า
	if(isset($_POST['drugCheck02']) && $_POST['drugCheck02'] != "") {
		for($loop  = 0 ; $loop < $_POST['count'] ; $loop++) {
			$row_id = '';
			if($loop < 10){$row_id = $_POST['month'] . '-' . $_POST['room_id'] . '-' . $_POST['drugCheck02'] . '-' . '0' .$loop;}
			else{$row_id = $_POST['month'] . '-' . $_POST['room_id'] . '-' . $_POST['drugCheck02'] . '-' .$loop;}
			$sql_insert_studentX = 'INSERT INTO student_drug VALUES (\'' . $row_id . '\', \'' . $_POST['student_id'][$loop]  . '\', \''. $_POST['room_id'] .'\', \'' . $_POST['drugCheck02'] .'\' , \'' . timecheck_id($_POST['check'][$loop]) .'\', \''. $_POST['month'] . '\',\'' . date('Y-m-d') . '\', \'' . $_POST['acadyear'] . '\', \'' . $_POST['acadsemester']  . '\', \''. $_SESSION['name']  . '\');'; 
			//echo $sql_insert_studentX . "<br/>";
			$aa = mysql_query($sql_insert_studentX)or die ('Error - ' . mysql_error());  // บันทึกข้อมูลการเช็ค
		} //end for
		updateTask($_POST['month'],$_POST['room_id'],$_POST['drugCheck02'],$_POST['acadyear']); // อัพเดทสถานะงานเป็น "บันทึก" แล้ว
	}
	
	//-- สารระเหย
	if(isset($_POST['drugCheck03']) && $_POST['drugCheck03'] != "") {
		for($loop  = 0 ; $loop < $_POST['count'] ; $loop++) {
			$row_id = '';
			if($loop < 10){$row_id = $_POST['month'] . '-' . $_POST['room_id'] . '-' . $_POST['drugCheck03'] . '-' . '0' .$loop;}
			else{$row_id = $_POST['month'] . '-' . $_POST['room_id'] . '-' . $_POST['drugCheck03'] . '-' .$loop;}
			$sql_insert_studentX = 'INSERT INTO student_drug VALUES (\'' . $row_id . '\', \'' . $_POST['student_id'][$loop]  . '\', \''. $_POST['room_id'] .'\', \'' . $_POST['drugCheck03'] .'\' , \'' . timecheck_id($_POST['check'][$loop]) .'\', \''. $_POST['month'] . '\',\'' . date('Y-m-d') . '\', \'' . $_POST['acadyear'] . '\', \'' . $_POST['acadsemester']  . '\', \''. $_SESSION['name']  . '\');'; 
			//echo $sql_insert_studentX . "<br/>";
			$aa = mysql_query($sql_insert_studentX)or die ('Error - ' . mysql_error());  // บันทึกข้อมูลการเช็ค
		} //end for
		updateTask($_POST['month'],$_POST['room_id'],$_POST['drugCheck03'],$_POST['acadyear']); // อัพเดทสถานะงานเป็น "บันทึก" แล้ว
	}
?>
<div id="content">
 <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>ระบบบริหารจัดการงานวินัยนักเรียน</strong></font></span></td>
      <td >
	  	ปีการศึกษา <?=$_POST['acadyear']?>
		ภาคเรียนที่ <?=$_POST['acadsemester']?>
	  </td>
    </tr>
  </table><br/>
<table width="75%" border="0" cellspacing="1" cellpadding="3" align="center" bgcolor="#CC99FF">
  <tr bgcolor="#CCCCCC"> 
    <td colspan="2"><font size="2"  ><strong>ผลการดำเนินงาน</strong></font></td>
  </tr>
  <tr bgcolor="white"> 
    <td width="150px"><font size="2"  >ตรวจสอบรายชื่อห้อง</font></td>
    <td><font color="#009900" size="2"  ><strong>เรียบร้อย</strong></font></td>
  </tr>
 
  <tr bgcolor="white"> 
    <td><font size="2"  >บันทึกการคัดกรอง</font></td>
    <td><font color="#009900" size="2"  ><strong>เรียบร้อย</strong></font></td>
  </tr>
  <tr bgcolor="white">
    <td colspan="2" align="center">
		<form action="index.php?option=module_discipline/Drug_tasklist" method="post">
			<input type="hidden" name="month" value="<?=$_POST['month']?>"/>
			<input type="submit" name="search" value="ดำเนินการต่อไป" />
		</form>
	</td>
  </tr>
</table>
</div>
<?php
//-------------------------------
function timecheck_id($value) {
	if($value == 'white') return '00';
	if($value == 'yellow') return '01';
	if($value == 'orange') return '02';
	if($value == 'red') return '03';
	else return 9;
}

function updateTask($month,$room_id,$drugType,$acadyear) {
	$sql = "update student_drug_task set task_status = '1' where month(task_date) = '" . $month . "' and task_roomid = '" . $room_id . "' and drug_id = '" . $drugType . "' and acadyear = '" . $acadyear . "'" ;
	//echo $sql . "<br/>";
	mysql_query($sql) or die ('Error - ' . mysql_error());
}
?>