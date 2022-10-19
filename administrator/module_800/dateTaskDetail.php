
<?php
	if(isset($_POST['delete']))
	{
		$delSql = "delete from student_800_task where task_date = '" . $_POST['delete'] . "'" ;
		$resDel = mysql_query($delSql);
		if($resDel)
		{
			echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php?option=module_800/dateTaskCreated\">";
		}
	}
?>
	  <div id="content">
	  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.2 ตรวจสอบวันที่สร้างงานบันทึกข้อมูลแล้ว&gt;&gt;รายละเอียดการบันทึก</strong></font></span></td>
      <td >&nbsp;</td>
    </tr>
  </table>
	<form method="post" action="">
		<table width="100%" align="center" class="admintable">
			<tr>
				
        <td colspan="2" class="key" align="center">รายละเอียดการบันทึกข้อมูลวันที่  <?=displayFullDate($_REQUEST['date']) . ' - [' . $_REQUEST['date'] . ']'?></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
                	<div style="max-height:300px;overflow:auto;">
					<table width="400px" border="0" cellspacing="1" cellpadding="1" bgcolor="lightpink">
						<tr bgcolor="#CCCCCC">
							<td align="center" width="50px">ห้อง</td>
							<td align="center" width="150px">สถานะ</td>
							<td align="center">หมายเหตุ</td>
						</tr>
						<?php
							$sign = 0;
							$sql = "select * from student_800_task where task_date ='" . $_REQUEST['date'] . "' order by task_roomid" ;
							$res = mysql_query($sql);
							while($dat = mysql_fetch_assoc($res))
							{
								echo "<tr bgcolor=\"white\">";
								echo "<td align=\"center\">" . getFullRoomFormat($dat['task_roomid']) . "</td>";
								if($dat['task_status'] == "1")
								{
									echo "<td align=\"center\">บันทึกแล้ว</td>";
									$sign++;
								}
								else
								{
									echo "<td align=\"center\"><font color=\"red\">ยังไม่บันทึก</font></td>";
								}
								echo "<td>&nbsp;</td>";
								echo "</tr>";
							} mysql_free_result($res);
						?>
					</table>
                    </div>
				</td>
			</tr>
			<tr>
				<td class="key" colspan="2" align="center">
				<?php
					if($sign == 0)
					{
						echo "<input type=\"hidden\" value=\"" . $_REQUEST['date'] . "\" name=\"delete\" />";
						echo "<input type=\"submit\" value=\"ลบ\" class=\"button\" /> งานบันทึกข้อมูลวันนี้";
					}
					else
					{
						echo "<input type=\"button\" value=\"ย้อนกลับ\" onClick='history.go(-1)'  >";
					}
				?>
				</td>
			</tr>
		</table>
 	</form>
</div>

		