<?php
	include("../../include/class.mysqldb.php");
	include("../../include/config.inc.php");
	include("../../include/shareFunction.php");
	if(!isset($_SESSION['pk-logined'])) {
		echo "<meta http-equiv='refresh' content='0;url=../index.php'>";
	} 
?>
<html>
<head>
	<title>หน้าต่างบันทึกข้อมูลการห้องเรียน</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    
    <style>
		.hover:hover{
			color:#039;
			font-weight:bold;
			cursor:pointer;
		}
		input,label{
			cursor:pointer;
		}
	</style>
</head>
<body>
<script language="javascript" type="text/javascript">
	function check(name,value) { document.getElementById(name).bgColor=value; }
</script>
<?php
			$room_id = getRoom($_REQUEST['room']);
			$xyear = getXyearth($_REQUEST['room']);
			$xlevel  = getXLevel($_REQUEST['room']);
/*
	$date = ????-??-??
	$room_id = ?
	$room = ?0?
	$xlevel = 3|4
	$xyear = 1-6
*/
?>
 <form method="post" action="../index.php?option=module_learn/insertStudentCheck">
<div align="center">
	<table width="800px"  align="center" cellspacing="1" class="admintable">
		<tr>
			<td class="header" align="center">
				<img src="../../images/school_logo.gif" width="120px"><br/>
				บันทึกการเข้าชั้นเรียน<br/>ประจำวันที่  
				<font color="red"><?=displayFullDate($_REQUEST['date'])?></font>
				ห้อง  <font color="red"><?=getFullRoomFormat($_REQUEST['room'])?> </font>
				คาบที่ <font color="red"><?=$_REQUEST['period']?></font><br/>
				ภาคเรียนที่ <?=$_REQUEST['acadsemester']?>  ปีการศึกษา <?=$_REQUEST['acadyear']?><br/>
			</td>
		</tr>
		<tr>
			<td class="key">รายละเอียดเพิ่มเติม</td>
		</tr>
		<tr>
			<td>
				<font size="2" face="MS Sans Serif, sans-serif"><font color="#6633FF">คลิกเลือกที่กล่องหน้าข้อความคาบเรียน  
				สำหรับคาบที่ผลการตรวจสอบนักเรียนเข้าชั้นเรียนเหมือนคาบที่ <?=$_REQUEST['period']?></font></font>
				<table cellspacing="1" class="admintable">
					<tr>
					<? $p_sql = "select task_date,task_roomid,task_status,period from student_learn_task where task_date = '"  .$_REQUEST['date'] . "' and task_roomid = '" . $_REQUEST['room'] . "' order by period" ;?>
					<? $p_res = mysql_query($p_sql) or die ( ' ' . mysql_error());?>
					<? $y = 1; ?>
					<? while($p_dat = mysql_fetch_assoc($p_res)) {	?>
						<? if($y == $_REQUEST['period']) {?>
							<td valign="top">
								<font  size="2" color="#CC0000"><b> คาบที่ <?=$y?><br/></b></font>
								<font color="#FF0000"><font>คาบนี้</font></font>
								<? $y++;  ?>
							</td>
						<? }else if($p_dat['task_status'] == '1'){ ?>
							<td valign="top">
								<font  size="2" color="#CC0000"><b> คาบที่ <?=$y?><br/></b></font>
								<font color="#0000FF">บันทึกแล้ว</font>
								<? $y++;  ?>
							</td>
						<? } else { ?>
							<td valign="top" class="key">
								<input type="checkbox" name="cperiod[<?=$y?>]" value="<?=$y?>" checked>
								คาบที่ <?=$y?><br/>
								<input type="radio" name="cTeacherSign[<?=$y?>]" checked value="sign">มี <br/>
								<input type="radio" name="cTeacherSign[<?=$y?>]" value="unsign">ไม่มี
								<? $y++;  ?>
							</td>
						<? }//end if-else ?>
					<? }//end while ?>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center">
					  <input type="hidden" name="room_id" value="<?php echo $_REQUEST['room']; ?>"/>
					  <input type="hidden" name="date" value="<?php echo $_REQUEST['date']; ?>"/>
					  <input type="hidden" name="period" value="<?php echo $_REQUEST['period'] ; ?>"/>
					  <input type="hidden" name="acadyear" value="<?=$_REQUEST['acadyear']?>"/>
					  <input type="hidden" name="acadsemester" value="<?=$_REQUEST['acadsemester']?>"/>					  
					  					<table width="638" cellspacing="1" cellpadding="1">
											<tr>
												<td>
													<input type="radio" name="teacherSign" checked value="sign" id="teacherSign">
              										<label for="teacherSign"><strong><font color="#009900" face="Tahoma" size="2"> มี</font></strong><font face="Tahoma" size="2">การลงชื่อของครูผู้สอน </font></label><br/>
													<input type="radio" name="teacherSign" value="unsign" id="teacherUnsign">
													<label for="teacherUnsign"><strong><font color="#FF0000" face="Tahoma" size="2">ไม่มี</font></strong><font face="Tahoma" size="2">การลงชื่อของครูผู้สอน  </font></label><br/>
													<font face="Tahoma" size="2">ผู้บันทึกข้อมูล :</font><font color="blue" face="Tahoma" size="2"> <?= $_SESSION['name'] ?></font>
												</td>
											</tr>
										</table>
                                          <table width="638" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#3366FF">
                                            <tr bgcolor="#CCCCFF"> 
                                              <td width="6%" rowspan="2"><div align="center"><font color="#990066"><strong>เลขที่</strong></font></div></td>
                                              <td width="14%" rowspan="2"><div align="center"><font color="#990066"><strong>เลขประจำตัว</strong></font></div></td>
                                              <td width="36%" rowspan="2"><div align="center"><font color="#990066"><strong>ชื่อ - สกุล</strong></font></div></td>
                                              <td colspan="5"><div align="center"><font color="#990066"><strong>การมาเข้าห้องเรียน</strong></font></div></td>
                                            </tr>
                                            <tr> 
                                              <td width="8%" bgcolor="#CCCCFF"><div align="center"><font color="#990066"><strong>มา</strong></font></div></td>
                                              <td width="8%" bgcolor="#CCCCFF"><div align="center"><font color="#990066"><strong>กิจกรรม</strong></font></div></td>
											  <td width="8%" bgcolor="#CCCCFF"><div align="center"><font color="#990066"><strong>สาย</strong></font></div></td>
                                              <td width="8%" bgcolor="#CCCCFF"><div align="center"><font color="#990066"><strong>ลา</strong></font></div></td>
                                              <td width="8%" bgcolor="#CCCCFF"><div align="center"><font color="#990066"><strong>ขาด</strong></font></div></td>
                                            </tr>
                                            <?php

  	$sql = 'SELECT id, prefix , firstname , lastname FROM students WHERE xLevel =  \''. $xlevel . '\' AND xYearth = \'' . $xyear .'\' and room = \'' . $room_id  .  '\' and xedbe = \'' .$acadyear . '\'  and studstatus = \'1\' order by sex,id';
//	echo $sql;
  	$result = mysql_query($sql) or die ('Error  - ' .mysql_error());
	$i = 1;
	$j = 0;
	$rows = mysql_num_rows($result);
	while($data = mysql_fetch_array($result))
	{
		echo "<tr   id=\"check[$j]\"  bgcolor='#FFFFFF' class=\"hover\" >";
		echo "<td align=\"center\"><font size=\"2\" face=\"Tahoma\">" . $i . "</font></td>";
		echo "<td align=\"center\"><input type=\"hidden\" name=\"student_id[$j]\" value=\"$data[0]\" /><font size=\"2\" face=\"Tahoma\">$data[0]</font></td>";
		echo "<td><font size=\"2\" face=\"Tahoma\">$data[1]$data[2]  $data[3]</font></td>";
		echo "<td align=\"center\"><input type='radio' name=\"check[$j]\" value='white'  checked    onclick=\"check(this.name,this.value)\" /></td>";
		echo "<td align=\"center\"><input type='radio' name=\"check[$j]\" value='lightgreen'  onclick=\"check(this.name,this.value)\" /></td>";
		echo "<td align=\"center\"><input type='radio' name=\"check[$j]\" value='yellow'   onclick=\"check(this.name,this.value)\" ></td>";
		echo "<td align=\"center\"><input type='radio' name=\"check[$j]\" value='blue'   onclick=\"check(this.name,this.value)\" ></td>";
		echo "<td align=\"center\"><input type='radio' name=\"check[$j]\" value='red'  onclick=\"check(this.name,this.value)\" ></td>";	
		echo "</tr>";
		$j++;
		$i++;	
	}
	
?>
                                            <tr bgcolor="#FFFFFF"> 
                                              <td colspan="8" align="center"> <input type="hidden" name="count" value="<?php  echo $j; ?>"/>
                                                <input type="submit" value="บันทึก"/> 
                                                <input type="button" value="ยกเลิก" onClick="history.go(-1)"/> 
                                              </td>
                                            </tr>
                                          </table>


					  </td>
					  </tr>
</table>

<? mysql_free_result($result); ?>		
</div>		
</form>	
</body>
</html>
