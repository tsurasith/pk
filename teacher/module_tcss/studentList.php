<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_tcss/index&content=sdq"><img src="../images/tcss.png" alt="" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">TCSS</font></strong><br />
        <span class="normal">
		<font color="#0066FF"><strong>
			<? 	if($_REQUEST['type'] == "student") { echo "1.1 บันทึกข้อมูลนักเรียนประเมินตนเอง <br/>(นักเรียนเป็นผู้ประเมิน)"; }
				else if($_REQUEST['type'] == "parent") { echo "1.2 บันทึกข้อมูลผู้ปกครองประเมินนักเรียน<br/> (ผู้ปกครองเป็นผู้ประเมิน)"; }
				else if($_REQUEST['type'] == "teacher") { echo "1.3 บันทึกการประเมินนักเรียน <br/> (ครูเป็นผู้ประเมิน)"; } ?>
		</strong>
		</font></span></td>
      <td >
		<?php
			$_error = 1;
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_tcss/studentList&type=" . $_REQUEST['type'] . "&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_tcss/studentList&type=" . $_REQUEST['type'] . "&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		 ภาคเรียนที่   <?php 
					if($acadsemester == 1) {
						echo "<font color='blue'>1</font> , ";
					}
					else {
						echo " <a href=\"index.php?option=module_tcss/studentList&type=" . $_REQUEST['type'] . "&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_tcss/studentList&type=" . $_REQUEST['type'] . "&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
	  </td>
    </tr>
  </table>
<?php
	$_link = "";
	if($_REQUEST['type'] == "student")
	{
		$_link = "<a href='index.php?option=module_tcss/sdq_student&student_id=#'>ประเมิน</a>";
	}
	else if($_REQUEST['type'] == "parent")
	{
		$_link = "<a href='index.php?option=module_tcss/sdq_parent&student_id=#'>ประเมิน</a>";
	}
	else if($_REQUEST['type'] == "teacher")
	{
		$_link = "<a href='index.php?option=module_tcss/sdq_teacher&student_id=#'>ประเมิน</a>";
	}
	
	
	
	$_sqlCheckAdvisor = "select room_id from rooms 
			 where acadyear ='" . $acadyear . "' and 
			 		acadsemester ='" . $acadsemester . "' and 
					concat(teacher_id,teacher_id2) like '%" . $_SESSION['teacher_id'] . "%'";
	$_resCheckAdvisor = mysql_query($_sqlCheckAdvisor);
	
	// echo $_sqlCheckAdvisor;

	if(mysql_num_rows($_resCheckAdvisor)>0) {
		$_x = mysql_fetch_assoc($_resCheckAdvisor);
		$xlevel = (substr($_x['room_id'],0,1)>3?4:3);
		$xyearth = (substr($_x['room_id'],0,1)>3?substr($_x['room_id'],0,1)-3:substr($_x['room_id'],0,1));
		$room = substr($_x['room_id'],2,1);
?>
			  <table class="admintable" width="100%" cellpadding="1" cellspacing="1" border="0" align="center">
				<tr> 
				  <th colspan="6" align="center">
				  		<img src="../images/school_logo.gif" width="120px"><br/>
						รายชื่อนักเรียนในที่ปรึกษา <?=$_POST['roomID']; ?> <br/>
						ภาคเรียนที่ <?=$acadsemester; ?> ปีการศึกษา <?=$acadyear; ?><br/>
						สำหรับกรอกข้อมูลประเมิน SDQ (<?=displayQuestioner($_REQUEST['type'])?>เป็นผู้ประเมิน)
				 </th>
				</tr>
				<tr height="30px"> 
					<td class="key" width="50px" align="center">เลขที่</td>
					<td class="key" width="95px" align="center">เลขประจำตัว</td>
					<td class="key" width="200px" align="center">ชื่อ - นามสกุล</td>
					<td class="key" width="140px"  align="center">สถานภาพ</td>
					<td class="key" width="120px" align="center">คะแนนความประพฤติ</td>
					<td class="key" align="center">-</td>
				</tr>
				<?php
					$sqlStudent = "select id,prefix,firstname,lastname,studstatus,points,b.status
									from students right outer join sdq_" . $_REQUEST['type'] . " b
									on id = b.student_id
									where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' and room = '" . $room . "' 
											and xedbe = '" . $acadyear . "' and b.acadyear = '" . $acadyear . "' 
											and b.semester = '" . $acadsemester . "' 
									order by sex,id,ordinal ";
					$resStudent = mysql_query($sqlStudent);
					$ordinal = 1;
					$totalRows = mysql_num_rows($resStudent);
					for($i = 0; $i < $totalRows ; $i++)
					{ ?>
						<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
						<? $dat = mysql_fetch_array($resStudent); ?>
						<td align="center"><?=$ordinal++?></td>
						<td align="center"><?=$dat['id']?></td>
						<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
						<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
						<td align="center"><?=displayPoint($dat['points'])?></td>
						<td align="center"><?=$dat['status']==0?str_replace('#',$dat['id'],$_link):"<font color='blue'>ทำการประเมินแล้ว</font>"?></td>
						</tr>
				<?	} //END for	?>
			</table>
	  <? } // end if
	  	else
		{	?>
			<table width="100%" align="center">
				<tr>
					<td align="center">
						<br/><br/>
						<font color="#FF0000" size="2">ในปีการศึกษานี้คุณไม่มีนักเรียนในที่ปรึกษา</font>
					</td>
				</tr>
			</table>
	<? 	} // end-else ?>
  
</div>

