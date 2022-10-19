<?php
	include("../../include/class.mysqldb.php");
	include("../../include/config.inc.php");
	if(!isset($_SESSION['pk-logined'])) {
		?><meta http-equiv="refresh" content="0;url=../index.php"><?
	} 
	
?>
<html>
	<head>
		<title>หน้าต่างแก้ไขและบันทึกข้อมูลคณะสีของนักเรียน</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" language="javascript">
			function check(name,value) {  document.getElementById(name).bgColor=value;  }
		</script>
	</head>
	<body>
	<?php
			$room_id = substr($_REQUEST['room'],2,1);
			$room_id2 = substr($_REQUEST['room'],0,1);
			if($room_id2 == "6" || $room_id2 == "3"){ $xyear = "3";}
			if($room_id2 == "5" || $room_id2 == "2"){ $xyear = "2";}
			if($room_id2 == "4" || $room_id2 == "1") {$xyear = "1";}
			$xlevel = "";
			if(substr($_REQUEST['room'],0,1) >= 4) { $xlevel = "4"; }
			else { $xlevel = "3";}
	?>
	<table width="800px" align="center">
		<tr>
			<th align="center">
				<img src="../../images/school_logo.gif" width="120px"><br/>
				บันทึก/แ้ก้ไข ข้อมูลคณะสี ห้อง <font color="red">
				<?php echo $_REQUEST['room']; ?></font><br/>
				ภาคเรียนที่ <?=$_REQUEST['acadsemester']?> ปีการศึกษา <?=$_REQUEST['acadyear']?>
			</th>
                      </tr>
					  <tr>
					  <td align="center">
					  <form method="post" action="../index.php?option=module_color/updateStudentColor">
					  	<input type="hidden" name="room_id" value="<?php echo $_REQUEST['room']; ?>"/>
					  	<input type="hidden" name="acadyear" value="<?php echo $_REQUEST['acadyear']; ?>"/>
					  	<input type="hidden" name="acadsemester" value="<?php echo $_REQUEST['acadsemester']; ?>"/>
						<table width="638" cellspacing="1" cellpadding="1">
							<tr> 
								<td>
									<font size="2">ผู้บันทึกข้อมูล :</font><font color="blue" size="2"> <?= $_SESSION['name'] ?></font> 
								</td>
							</tr>
						</table>
                        
						<table width="638" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#3366FF">
							<tr bgcolor="#CCCCFF">
								<td width="6%" rowspan="2" align="center"><font color="#990066"><strong>เลขที่</strong></font></td>
								<td width="14%" rowspan="2" align="center"><font color="#990066"><strong>เลขประจำตัว</strong></font></td>
								<td width="36%" rowspan="2" align="center"><font color="#990066"><strong>ชื่อ - สกุล</strong></font></td>
								<td colspan="5" align="center"><font color="#990066"><strong>คณะสี</strong></font></td>
							</tr>
							<tr> 
								<td width="8%" bgcolor="#CCCCFF" align="center"><font color="#990066"><strong>เขียว</strong></font></td>
								<td width="8%" bgcolor="#CCCCFF" align="center"><font color="#990066"><strong>เหลือง</strong></font></td>
								<td width="8%" bgcolor="#CCCCFF" align="center"><font color="#990066"><strong>แสด</strong></font></td>
								<td width="8%" bgcolor="#CCCCFF" align="center"><font color="#990066"><strong>ม่วง</strong></font></td>
								<td width="8%" bgcolor="#CCCCFF" align="center"><font color="#990066"><strong>ชมพู</strong></font></td>
							</tr>
							<? $sql = 'SELECT id, prefix , firstname , lastname,color FROM students WHERE xLevel =  \''. $xlevel . '\' AND xYearth = \'' . $xyear .'\' and room = \'' . $room_id  .  '\'  and xedbe = \'' . $_REQUEST['acadyear'] . '\' order by ordinal'; ?>
							<? $result = mysql_query($sql) or die ('Error  - ' .mysql_error()); ?>
							<? $i = 1; $j = 0; $rows = mysql_num_rows($result); ?>
							<? while($data = mysql_fetch_array($result)) {
								echo "<tr   id=\"check[$j]\"  bgcolor=\"" . getBgColor($data[4]) . "\" >";
								echo "<td align=\"center\"><font size=\"2\" face=\"Tahoma\">" . $i . "</font></td>";
								echo "<td align=\"center\"><input type=\"hidden\" name=\"student_id[$j]\" value=\"$data[0]\" /><font size=\"2\" face=\"Tahoma\">$data[0]</font></td>";
								echo "<td><font size=\"2\" face=\"Tahoma\">$data[1]$data[2]  $data[3]</font></td>";
								echo "<td align=\"center\"><input type='radio' name=\"check[$j]\" value='green' " .  getCheck($data[4],'เขียว') . "  onclick=\"check(this.name,this.value)\" /></td>";
								echo "<td align=\"center\"><input type='radio' name=\"check[$j]\" value='yellow' " .  getCheck($data[4],'เหลือง') . " onclick=\"check(this.name,this.value)\" /></td>";
								echo "<td align=\"center\"><input type='radio' name=\"check[$j]\" value='orange' " .  getCheck($data[4],'ส้ม') . "  onclick=\"check(this.name,this.value)\" ></td>";
								echo "<td align=\"center\"><input type='radio' name=\"check[$j]\" value='violet' " .  getCheck($data[4],'ม่วง') . "  onclick=\"check(this.name,this.value)\" ></td>";
								echo "<td align=\"center\"><input type='radio' name=\"check[$j]\" value='pink' " .  getCheck($data[4],'ชมพู') . " onclick=\"check(this.name,this.value)\" ></td>";	
								echo "</tr>";
								$j++; $i++;	
							   }//end while ?>
							   <tr bgcolor="#FFFFFF"> 
								   <td colspan="8" align="center"> 
									   <input type="hidden" name="count" value="<?php  echo $j; ?>"/>
									   <input type="submit" value="บันทึก"/> 
									   <input type="button" value="ยกเลิก" onClick="history.go(-1)"/> 
									</td>
								</tr>
							</table>
						</form>
					  </td>
					</tr>
				</table>
			</body>
			</html>
<?php    
	function getBgColor($value)
	{
		if($value == 'เขียว') return 'green';
		if($value == 'เหลือง') return 'yellow';
		if($value == 'ส้ม') return 'orange';
		if($value == 'ม่วง') return 'violet';
		if($value == 'ชมพู') return 'pink';
		else return '#FFFFFF';
	}
	function getCheck($value,$color)
	{
		if($value == 'เขียว' && $color == $value) { return 'checked';break;}
		if($value == 'เหลือง' && $color == $value) { return 'checked';break;}
		if($value == 'ส้ม' && $color == $value) { return 'checked';break;}
		if($value == 'ม่วง' && $color == $value) { return 'checked';break;}
		if($value == 'ชมพู' && $color == $value){ return 'checked';break;}
		else return '';
	}
?>					