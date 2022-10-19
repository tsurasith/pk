
<link rel="stylesheet" type="text/css" href="module_tcss/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_tcss/js/calendar.js"></script>

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_tcss/index&content=sdq"><img src="../images/tcss.png" alt="" width="48" height="48" border="0"/></a></td>
      <td><strong><font color="#990000" size="4">TCSS</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.1 สร้างงานประเมิน SDQ</strong></font></span></td>
      <td>
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_tcss/sdq_create&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_tcss/sdq_create&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_tcss/sdq_create&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_tcss/sdq_create&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<br/> 
	  </td>
    </tr>
  </table>
 <form method="post">
 <?php
	if(isset($_POST['created']) && $_POST['date'] != "") {
		$_sqlStudent = "insert into sdq_student
							select id,null,null,null,null,null,	null,null,null,null,null,
								null,null,null,null,null,null,null,null,null,null,
								null,null,null,null,null,'" . $acadsemester ."',
								'" . $acadyear . "',0,'" . $_POST['date'] . "',null
							from students
							where xedbe = '" . $acadyear . "' and studstatus in (1,4) ";
		$_sqlTeacher = "insert into sdq_teacher
							select id,'999',null,null,null,null,null,null,null,null,null,null,
								null,null,null,null,null,null,null,null,null,null,
								null,null,null,null,null,'" . $acadsemester ."',
								'" . $acadyear . "',0,'" . $_POST['date'] . "',null
							from students
							where xedbe = '" . $acadyear . "' and studstatus in (1,4) ";
		$_sqlParent = "insert into sdq_parent
							select id,null,null,null,null,null,null,null,null,null,null,
								null,null,null,null,null,null,null,null,null,null,
								null,null,null,null,null,'" . $acadsemester ."',
								'" . $acadyear . "',0,'" . $_POST['date'] . "',null
							from students
							where xedbe = '" . $acadyear . "' and studstatus in (1,4) ";
		if(mysql_query($_sqlStudent))
		{
			$_sql = "insert into sdq_result  
						select id,-1,-1,-1,-1,-1,-1,-1,
								'" . $acadyear . "','" . $acadsemester ."',
								'student'
							from students
							where xedbe = '" . $acadyear . "' and studstatus in (1,4) ";
			mysql_query($_sql) or die (mysql_error());
		}
		if(mysql_query($_sqlTeacher))
		{
			$_sql = "insert into sdq_result  
						select id,-1,-1,-1,-1,-1,-1,-1,
								'" . $acadyear . "','" . $acadsemester ."',
								'teacher'
							from students
							where xedbe = '" . $acadyear . "' and studstatus in (1,4) ";
			mysql_query($_sql) or die (mysql_error());
		}
		if(mysql_query($_sqlParent))
		{
			$_sql = "insert into sdq_result  
						select id,-1,-1,-1,-1,-1,-1,-1,
								'" . $acadyear . "','" . $acadsemester ."',
								'parent'
							from students
							where xedbe = '" . $acadyear . "' and studstatus in (1,4) ";
			mysql_query($_sql) or die (mysql_error());
		}
		else
		{
			echo "<font color='red'>&nbsp; &nbsp; &nbsp; &nbsp; ";
			echo "การประมวลผลผิดพลาดกรุณาติดต่อผู้ดูแลระบบ";
			echo "</font><br/>";
			echo $_sqlStudent;
		}
	}
?>
<?php
	$_sql = "SELECT distinct create_date FROM sdq_student where semester = '" . $acadsemester . "' and acadyear = '" . $acadyear . "'";
	$_result  = mysql_query($_sql);
	if(mysql_num_rows($_result) <= 0) { ?>
		<table width="100%" align="center" class="admintable">
			<tr>
				<td colspan="2" height="30px" class="key">&nbsp; สร้างแบบประเมิน SDQ สำหรับภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?></td>
			</tr>
			<tr>
				<td width="80px" align="right">เลือกวันที่ : </td>
				<td >
						<input type="text" id="date" name="date" onClick="showCalendar(this.id)" class="inputboxUpdate"/>				</td>
			</tr>
			<tr>
				<td >&nbsp;</td>
				<td >
					<input type="submit" value="สร้างงานประเมิน" name="created" /><br/><br/>
					&nbsp; &nbsp; 
					<font color="#FF0000">***</font>
					 สำหรับการสร้างแบบประเมินนั้น จะสามารถสร้างงานสำหรับประเมิน SDQ ได้เพียงภาคเรียนละ 1 ครั้งเท่านั้น
				</td>
			</tr>
			<tr>
			  <td >&nbsp;</td>
			  <td ><?php
						if($_POST['date'] == "") { 
							if(isset($_POST['date']))
							echo "<font color='red'>ผิดพลาดกรุณาเลือกวันที่ก่อน</font>";
						}
					?>
			  </td>
		  </tr>
		</table>

<? } else { ?>
</form>
<table width="100%" align="center" class="admintable">
	<tr>
		<td colspan="2" class="key">รายละเอียดสถานะการเริ่มระบบงานประเมิน SDQ</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
				<font color='green' size="2"><b>
					<? $_dat = mysql_fetch_assoc($_result); ?>
					<br/><br/>ได้ทำการสร้างแบบประเมิน SDQ สำหรับภาคเรียนนี้แล้ว<br/>
					โดยได้สร้างการประเมินขึ้น ณ วันที่ <?=displayFullDate($_dat['create_date'])?></b>
				</font>
		</td>
	</tr>
</table>
<? } // end else ?></div>

