<div id="content">
	<link rel="stylesheet" type="text/css" href="module_color/css/calendar-mos2.css"/>
	<script language="JavaScript" type="text/javascript" src="module_color/js/calendar.js"></script>
	<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
		<tr>
			<td width="6%" align="center"><a href="index.php?option=module_color/index"><img src="../images/color.png" alt="กิจกรรมคณะสี" width="48" height="48" border="0"/></a></td>
				<td ><strong><font color="#990000" size="4">กิจกรรมคณะสี</font></strong><br />
					<span class="normal"><font color="#0066FF"><strong>2.1 สร้างวันที่บันทึกข้อมูล</strong></font></span></td>
			<td> ปีการศึกษา <?=$acadyear?> ภาคเรียนที่ <?=$acadsemester?> </td>
		</tr>
	</table>
	
	<? if(isset($_POST['save']) && $_POST['date'] != ""){ ?>
	<?
			$sql = "SELECT distinct color_id FROM ref_color where color_id != '00'";
			$_resColor = mysql_query($sql);
			if(mysql_num_rows($_resColor) > 0) {
				$sql2 = "select distinct task_date from student_color_task where task_date = '" . $_POST['date'] . "'" ;
				$_resDateCreated = mysql_query($sql2);
				if(mysql_num_rows($_resDateCreated) > 0)
				{ ?>
					<center>
						<font color="#FF0000"><br/>ได้มีการสร้างงานบันทึกข้อมูลในวันนี้แ้ล้ว ท่านไม่สามารถสร้างงานบันทึกซ้ำได้</font><br/><br/>
						<input type="button" value="ดำเนินการต่อไป" onclick="history.go(-1)" />
					</center>
				  <?php
				}
				else
				{
					while ($data = mysql_fetch_assoc($_resColor))
					{
						$sql_insert = "insert into student_color_task values ( null,'". $_POST['date'] ."','" . "3" . $data['color_id'] . "','0' ,'" . $acadyear . "','" . $acadsemester . "') ";
						mysql_query($sql_insert) or die ('Error - ' . mysql_error());
						$sql_insert = "insert into student_color_task values ( null,'". $_POST['date'] ."','" . "4" . $data['color_id'] . "','0' ,'" . $acadyear . "','" . $acadsemester . "') ";
						mysql_query($sql_insert) or die ('Error - ' . mysql_error());
						//echo $sql_insert . "<br/>";
					} //end while	?>
						<table align="center" width="100%">
							<tr>
								<td height="56" align="center"><font color="green">ท่านได้ทำการสร้างงานบันทึกกิจกรรมคณะสีเรียบร้อยแล้ว</font></td>
							</tr>
							<tr>
								<td align="center"><input type="button" value="ดำเนินการต่อไป" onclick="history.go(-1)" /></td>
							</tr>
						</table>
					<?php
				} //end else
			} //end if check_ task_color
			else
			{
				?>
					<center><font color="#FF0000"><br/>ข้อมูลห้องเรียนในปีการศึกษานี้ผิดพลาด กรุณาแจ้งให้ผู้ดูแลระบบ<br/>
							ให้ทำการจัดการห้องเรียนให้เรียบร้อยก่อน มิฉะนั้นจะไม่สามารถดำเนินการบันทึกกิจกรรมคณะสีได้</font>
							<br/><br/><input type="button" value="ดำเนินการต่อไป" onclick="history.go(-1)" />
					</center>
				<?php
			} //end else
		}
		else
		{ ?>			
			<table align="center" width="100%">
				<tr>
					<td align="center">
						<form method="post">
						<table>
							<tr><th bgcolor="#FFCCFF" colspan="2" height="35px">สร้างงานบันทึก</th></tr>
							<tr>
								<td width="70px" height="35" align="right" >เลือกวันที่ :</td>
								<td width="218" align="left"><input type="text" id="date" name="date" size="10" onClick="showCalendar(this.id)" class="inputboxUpdate"/></td>
							</tr>
							<tr>
								<td align="center" colspan="2">
									<br><br><input type="submit" value="สร้างงานบันทึกกิจกรรมคณะสี" name="save" /><br><br>
								</td>
							</tr>
						</table>
						</form>
					</td>
				</tr>
			</table>
		<? }// end-else ?>
</div>