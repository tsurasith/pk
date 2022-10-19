<div id="content">
<?php
$sql = 'SELECT distinct room_id FROM rooms  where acadyear = ' . $acadyear .' and acadsemester = ' .$acadsemester ;
$sql2 = "select distinct task_date from student_learn_task where task_date = '" . $_POST['date'] . "'" ;
?>

<link rel="stylesheet" type="text/css" href="module_learn/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_learn/js/calendar.js"></script>
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.1 สร้างวันที่บันทึกการเข้าเรียน</strong></font></span></td>
      <td >
	  	ปีการศึกษา
		 <?=$acadyear?>  
		 ภาคเรียนที่ 
		 <?=$acadsemester?>	
	  </td>
    </tr>
  </table><br/>
  <?php
  	if($_POST['create'])
	{ ?>
	<table width="75%" border="0" cellspacing="1" cellpadding="3" align="center" bgcolor="#CC99FF">
  <tr bgcolor="#CCCCCC"> 
    <td colspan="2"><font size="2"  ><strong>ผลการดำเนินงาน</strong></font></td>
  </tr>
  <tr bgcolor="white"> 
    <td width="150px"><font size="2"  >ตรวจสอบรายชื่อห้อง</font></td>
    <td><font color="#009900" size="2"  ><strong>เรียบร้อย</strong></font></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td><font size="2"  >ตรวจสอบวันที่ทำการบันทึก</font></td>
    <?php

$c_date = mysql_query($sql2);
$rows = mysql_num_rows($c_date);
if($_POST['date'] != "")
{
	if($rows == 0)
	{
		$result = mysql_query($sql);
		while ($data = mysql_fetch_assoc($result))
		{
			for($p = 1; $p <= 8 ; $p++)
			{
				$sql_insert = "insert into student_learn_task values ( null,'". $_POST['date'] ."','" . $data['room_id'] . "','0','" . $p . "','" .$acadyear."','".$acadsemester."') ";
				mysql_query($sql_insert) or die ('Error - ' . mysql_error());
				//echo $sql_insert . "<br/>";
			}
		}
		echo "<td><font color=\"#009900\" size=\"2\" face=\"Tahoma\"><strong>บันทึกข้อมูลเรียบร้อยแล้ว</strong></font></td>";
	}
	else
	{
		echo "<td><font color=\"red\" size=\"2\" face=\"Tahoma\"><strong>คุณไม่สามารถบันทึกข้อมูลวันที่ทำการเช็คการเข้าแถวซ้ำได้</strong></font></td>";
	}
}
else
{
	echo "<td><font color=\"red\" size=\"2\" face=\"Tahoma\"><strong>ผิดพลาดเนื่องจากคุณยังไม่ได้เลือกวันที่จะบันทึกข้อมูล !</strong></font></td>";
}
		//mysql_close($nn);
?>
  </tr>
</table>
<br/>
<table align="center">
	<tr>
		<td><input type="button" value="ดำเนินการต่อไป" onClick="history.go(-1)"/></td>
	</tr>
</table>
<?php		
	}
  	else
	{
  ?>
  <form method="post" action=""/>
  <table  class="admintable" width="100%" align="center">
				  	<tr>
						<th height="30px" bgcolor="#FFCCFF" align="center" >สร้างงานบันทึก</th>
					</tr>
					<tr>
						<td align="center">
							<table width="400px">
                                          <tr> 
                                            <td height="24" align="right" valign="top"><font color="#0000FF"><b>เลือกวันที่ :</b></font></td>
                                            <td width="218"><input type="text" id="date" name="date" size="20" onClick="showCalendar(this.id)" class="inputboxUpdate"/>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="center" colspan="2"><br>
                                              <br>
                                              <input type="submit" value="สร้างงานบันทึกการเข้าห้องเรียน" name="create" />
                                              <br>
                                              <br>
                                            </td>
                                          </tr>
										  <tr>
										  	<td colspan="2" width="330px">
												  <p><br/>
													<font color='red'>***</font> กรุณาตรวจสอบข้อมูล<font color='red'><b>ปีการศึกษา</b></font>และ
													<font color='red'><b>ภาคเรียน</b></font>ให้ถูกต้อง
													หากไม่ตรงกับปีการศึกษาและภาคเรียนปัจจุบันโปรดแจ้งผู้ดูแลระบบ  
													เพื่อแก้ไขก่อนการดำเนินการเพื่อป้องกันข้อผิดพลาด </p>
												  <p><br/>
											</td>
										  </tr>
                                        </table>
						</td>
					</tr>
				  </table>
				  </form>
	<?php
		} // end - else
	?>  
</div>