
<?php
	if(isset($_POST['delete']))
	{
		$delSql = "delete from student_learn_task where task_date = '" . $_POST['delete'] . "'" ;
		$resDel = mysql_query($delSql);
		if($resDel)
		{
			echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php?option=module_learn/dateTaskCreated\">";
		}
	}
?>
	  <div id="content">
	   <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
       <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.2 ตรวจสอบวันที่สร้างงานบันทึกแล้ว >> รายละเอียดการบันทึก</strong></font></span></td>
      <td >&nbsp;
	  	
	  </td>
    </tr>
  </table>
	<form method="post" action="">
		<table width="100%" align="center" class="admintable">
			<tr>
				
        <td colspan="2" class="key" align="center">รายละเอียดการบันทึกข้อมูลวันที่  <?=displayFullDate($_REQUEST['date']) . ' - [' . $_REQUEST['date'] . ']'; ?></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<table width="80%" border="0" cellspacing="1" cellpadding="1" bgcolor="lightpink">
						<tr bgcolor="#CCCCCC">
							<td align="center" width="50px" rowspan="2">ห้อง</td>
							<td align="center" colspan="8">คาบเรียน</td>
						</tr>
						<tr>
							<?php
								for($i = 1; $i < 9 ; $i++)
								{
									echo "<td align=\"center\" width=\"75px\" bgcolor=\"#CCCCCC\">" . $i . "</td>";
								}
							?>
						</tr>
						<?php
							$sign = 0;
							$sql = "select task_roomid,
									  sum(if(period = 1,task_status,null)) as a,
									  sum(if(period = 2,task_status,null)) as b,
									  sum(if(period = 3,task_status,null)) as c,
									  sum(if(period = 4,task_status,null)) as d,
									  sum(if(period = 5,task_status,null)) as e,
									  sum(if(period = 6,task_status,null)) as f,
									  sum(if(period = 7,task_status,null)) as g,
									  sum(if(period = 8,task_status,null)) as h
									from student_learn_task
									where task_date = '" . $_REQUEST['date'] ."'
									group by task_roomid order by task_roomid" ;
							$res = mysql_query($sql);
							while($dat = mysql_fetch_assoc($res))
							{
								echo "<tr bgcolor=\"white\">";
								echo "<td align=\"center\">" . getFullRoomFormat($dat['task_roomid']) . "</td>";
								echo "<td align=\"center\">" . displayTaskStatus($dat['a']) . "</td>";
								echo "<td align=\"center\">" . displayTaskStatus($dat['b']) . "</td>";
								echo "<td align=\"center\">" . displayTaskStatus($dat['c']) . "</td>";
								echo "<td align=\"center\">" . displayTaskStatus($dat['d']) . "</td>";
								echo "<td align=\"center\">" . displayTaskStatus($dat['e']) . "</td>";
								echo "<td align=\"center\">" . displayTaskStatus($dat['f']) . "</td>";
								echo "<td align=\"center\">" . displayTaskStatus($dat['g']) . "</td>";
								echo "<td align=\"center\">" . displayTaskStatus($dat['h']) . "</td>";
								echo "</tr>";
								if($dat['a'] == 1 || $dat['b'] == 1 || $dat['c'] == 1 || $dat['d'] == 1 || $dat['e'] == 1 || $dat['f'] == 1 || $dat['g'] == 1 || $dat['h'] == 1)
								{
									$sign = 1;
								}
							} mysql_free_result($res);
						?>
					</table>
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
				?>
				</td>
			</tr>
		</table>
 	</form>
</div>
	
<?php
	function displayTaskStatus($_value)
	{
		if($_value == 1)
		{ return "<font color='blue'>บันทึก</font>";}
		else
		{ return "<font color='red'>ยังไม่บันทึก</font>";}
	}
?>		