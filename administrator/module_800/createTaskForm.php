<div id="content">

<link rel="stylesheet" type="text/css" href="module_800/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_800/js/calendar.js"></script>
 
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
  <tr> 
    <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
    <td width="45%"><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br /> 
      <span class="normal"><font color="#0066FF"><strong>1.1 สร้างวันที่บันทึกข้อมูล</strong></font></span></td>
    <td >
		ปีการศึกษา
		<?=$acadyear?> 
		ภาคเรียนที่	<?=$acadsemester?>	
	</td>
  </tr>
</table>
<?php
	if(isset($_POST['create']))
	{
		$sql = 'SELECT distinct room_id FROM rooms where acadyear = ' . $acadyear .' and acadsemester = ' .$acadsemester ;
		$sql2 = "select distinct task_date from student_800_task where task_date = '" . $_POST['date'] . "'" ;
?>
<br/>
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
					$sql_insert = "insert into student_800_task values ( null,'". $_POST['date'] ."','" . $data['room_id'] . "','0', '" . $acadyear . "','" .$acadsemester ."') ";
					mysql_query($sql_insert) or die ('Error - ' . mysql_error());
					//echo $sql_insert . "<br/>";
				}
				echo "<td><font color=\"#009900\" size=\"2\" face=\"Tahoma, sans-serif\"><strong>บันทึกข้อมูลเรียบร้อยแล้ว</strong></font></td>";
				mysql_free_result($result);
			}
			else
			{
				echo "<td><font color=\"red\" size=\"2\" face=\"Tahoma, sans-serif\"><strong>คุณไม่สามารถบันทึกข้อมูลวันที่ทำการเช็คการเข้าแถวซ้ำได้</strong></font></td>";
			}
		}
		else
		{
			echo "<td><font color=\"red\" size=\"2\" face=\"Tahoma, sans-serif\"><strong>ผิดพลาดเนื่องจากคุณยังไม่ได้เลือกวันที่จะบันทึกข้อมูล !</strong></font></td>";
		}
		?>
			  </tr>
			</table>
			<table align="center">
				<tr>
					<td><br/><br/><input type="button" value="ดำเนินการต่อไป" onClick="history.go(-1)"/></td>
				</tr>
			</table>
<?php			
	}else
	{
?>
<form method="post" action=""/>
<table align="center" class="admintable" width="100%">
				  	<tr>
						<th  bgcolor="#FFCCFF" align="center" height="30px">สร้างวันที่บันทึกข้อมูล</th>
					</tr>
					<tr>
						<td align="center">
						
							<table width="400">
                                          <tr> 
                                            <td width="80" height="24" align="right" valign="top">
												<font color="#0000FF"><b>เลือกวันที่ :</b></font>
											</td>
                                            <td width="230"><input type="text" id="date" name="date" size="20" onClick="showCalendar(this.id)" class="inputboxUpdate"/>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="center" colspan="2">
											<br/>
											<br/>
											<input type="submit" value="สร้างงานบันทึกกิจกรรมหน้าเสาธง" name="create" />
											<br/>
											<br/>
										  </p></td>
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
	 <? } //end else ?>
</div>