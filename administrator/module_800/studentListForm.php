<?php
	include("../../include/class.mysqldb.php");
	include("../../include/config.inc.php");
	include("../../include/shareFunction.php");
	if(!isset($_SESSION['pk-logined'])) {
		echo "<meta http-equiv=\"refresh\" content=\"0;url=../index.php\">";
	} 
	
?>
<html>
	<head>
		<title>หน้าต่างบันทึกข้อมูลการเข้าร่วมกิจกรรมหน้าเสาธง</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style>
			body,table{
				font-family:Tahoma;
			}
			th{
				font-size:18px;
				font-family:Tahoma;
			}
			
			.hover:hover{
				color:#00F;
				font-weight:bold;
				cursor:pointer;
			}
			input,label{
				cursor:pointer;
			}
			input:hover{
				border:1px solid #F00;
			}
		</style>
	</head>
<body>
<script type="text/javascript" language="javascript">
	function check(name,value){ document.getElementById(name).bgColor=value; }
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
<table width="800" align="center">
                      <tr>
                        <th > 
								<img src="../../images/school_logo.gif" width="120px"><br/>
								บันทึกการมาเข้าร่วมกิจกรรมหน้าเสาธง<br />
								ภาคเรียนที่ <?=$_REQUEST['acadsemester']?>  ปีการศึกษา <?=$_REQUEST['acadyear']?><br />
								ประจำวันที่  
							<font color="red"><?=displayFullDate($_REQUEST['date']); ?></font>
							 ห้อง  <font color="red"><?=getFullRoomFormat($_REQUEST['room']); ?> </font>
							 
						</th>
                      </tr>
					  <tr>
					  <td align="center">
					  
					  <form method="post" action="../index.php?option=module_800/insertStudentCheck">
					  <input type="hidden" name="room_id" value="<?php echo $_REQUEST['room']; ?>" />
					  <input type="hidden" name="acadyear" value="<?=$_REQUEST['acadyear']?>"/>
					  <input type="hidden" name="acadsemester" value="<?=$_REQUEST['acadsemester']?>"/>
					  <input type="hidden" name="date" value="<?php echo $_REQUEST['date']; ?>"/>
					  
					  					<table width="638" cellspacing="1" cellpadding="1">
											<tr>
												<td>
													<input type="radio" name="teacherSign" checked value="sign" id="teacherSign">
              										<label for="teacherSign"><strong><font color="#009900" face="Tahoma" size="2"> มี</font></strong><font face="Tahoma" size="2">ลายเซ็นต์อาจารย์ที่ปรึกษา </font> </label><br/>
													<input type="radio" name="teacherSign" value="unsign" id="teacherUnsign">
													<label for="teacherUnsign"><strong><font color="#FF0000" face="Tahoma" size="2">ไม่มี</font></strong><font face="Tahoma" size="2">ลายเซ็นต์อาจารย์ที่ปรึกษา  </font></label><br/>
													<font face="Tahoma" size="2">ผู้บันทึกข้อมูล :</font><font color="blue" face="Tahoma" size="2"> <?= $_SESSION['name'] ?></font>
												</td>
											</tr>
										</table>
                                          <table width="638" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#3366FF">
                                            <tr bgcolor="#CCCCFF"> 
                                              <td width="6%" rowspan="2"><div align="center"><font color="#990066"><strong>เลขที่</strong></font></div></td>
                                              <td width="14%" rowspan="2"><div align="center"><font color="#990066"><strong>เลขประจำตัว</strong></font></div></td>
                                              <td width="36%" rowspan="2"><div align="center"><font color="#990066"><strong>ชื่อ - สกุล</strong></font></div></td>
                                              <td colspan="5"><div align="center"><font color="#990066"><strong>การมาเข้าแถว</strong></font></div></td>
                                            </tr>
                                            <tr> 
                                              <td width="8%" bgcolor="#CCCCFF"><div align="center"><font color="#990066"><strong>มา</strong></font></div></td>
                                              <td width="8%" bgcolor="#CCCCFF"><div align="center"><font color="#990066"><strong>กิจกรรม</strong></font></div></td>
											  <td width="8%" bgcolor="#CCCCFF"><div align="center"><font color="#990066"><strong>สาย</strong></font></div></td>
                                              <td width="8%" bgcolor="#CCCCFF"><div align="center"><font color="#990066"><strong>ลา</strong></font></div></td>
                                              <td width="8%" bgcolor="#CCCCFF"><div align="center"><font color="#990066"><strong>ขาด</strong></font></div></td>
                                            </tr>
 <?php

  	$sql = 'SELECT id, prefix , firstname , lastname FROM students WHERE xLevel =  \''. $xlevel . '\' AND xYearth = \'' . $xyear .'\' and room = \'' . $room_id  .  '\' and studstatus = \'1\' and xedbe = \'' .$acadyear . '\' order by sex,id';
	//echo $sql;
  	$result = mysql_query($sql) or die ('ผิดพลาดเนื่องจาก  - ' .mysql_error());
	$i = 1;
	$j = 0;
	$rows = mysql_num_rows($result);
	while($data = mysql_fetch_array($result))
	{
		echo "<tr class=\"hover\"   id=\"check[$j]\"  bgcolor='#FFFFFF' >";
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
                                                <input type="button" value="ยกเลิก" onClick="history.go(-1)" /> 
                                              </td>
                                            </tr>
                                          </table>

</form>
					  </td>
					  </tr>
</table>

<? mysql_free_result($result);  ?>					
</body>
</html>

