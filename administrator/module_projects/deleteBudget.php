<? if(isset($_POST['comfirm']))
	{
		$_sql = "delete from project_budget 
					where project_id = '" . $_POST['project_id'] . "'
						and budget_id = '" . $_POST['budget_id'] . "'";
		@mysql_query($_sql);
		?><meta http-equiv="refresh" content="0;url=index.php?option=module_projects/addBudget&acadyear=<?=$_POST['acadyear']?>&acadsemester=<?=$_POST['acadsemester']?>&p_id=<?=$_POST['project_id']?>"><?
	}
?>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_projects/index">
			<img src="../images/computer.png" alt="" width="48" height="48" border="0"/>
		</a>
	  </td>
	  <td >
	  		<strong><font color="#990000" size="4">ระบบสารสนเทศกิจกรรม/โครงการ</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>1.3 บันทึกการใช้งบประมาณ &gt;&gt; ลบรายการใช้งบประมาณ</strong></font></span>
	  </td>
      <td >&nbsp;</td>
    </tr>
  </table>
	
	<table class="admintable" width="100%">
		<tr>
			<td align="center" height="150px">
				<form method="post">
					<font color="#FF0000">
					คุณต้องการที่จะลบ<u>รายการใช้จ่าย</u> ออกจากกิจกรรม/โครงการนี้ "ใช่" หรือ "ไม่"<br/>
					ถ้าใช่ให้คลิก "ตกลง" แต่ถ้าไม่ให้คลิก "ยกเลิก" เพื่อดำเนินการต่อไป <br/>
					<input type="hidden" name="project_id" value="<?=$_REQUEST['project_id']?>" />
					<input type="hidden" name="budget_id" value="<?=$_REQUEST['budget_id']?>" />
					<input type="hidden" name="acadyear" value="<?=$_REQUEST['acadyear']?>" />
					<input type="hidden" name="acadsemester" value="<?=$_REQUEST['acadsemester']?>" />
					<br/><br/>
					<input type="submit" value="ตกลง" name="comfirm" /> 
					<input type="button" value="ยกเลิก" onclick="history.go(-1)" />
					</font>
				</form>
			</td>
		</tr>
	</table>
</div>

