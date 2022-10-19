<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_tcss/index&content=sdq"><img src="../images/tcss.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">TCSS</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.1 รายงานติดตามการประเมิน (รายชื่อรายห้อง)</strong></font></span></td>
      <td >
	  <?    if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_tcss/sdq_studentList&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_tcss/sdq_studentList&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_tcss/sdq_studentList&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_tcss/sdq_studentList&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		</font><br/>
		<font color="#000000" size="2">
	  		เลือกห้อง 
			<? $sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
			   $resRoom = mysql_query($sql_Room); ?>
			<select name="roomID" class="inputboxUpdate">
				<option value=""></option>
				<? while($dat = mysql_fetch_assoc($resRoom)) {
						$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
						echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
						echo getFullRoomFormat($dat['room_id']);
						echo "</option>";
					} ?>
			</select></font>
	  		<input type="submit" value="เรียกดู" class="button" name="search"/>
	   </td>
    </tr>
  </table>
  </form>
  <?php
if(isset($_POST['search']) && $_POST['roomID'] != "")
{
  $xlevel = getXlevel($_POST['roomID']);
  $xyearth= getXyearth($_POST['roomID']);
  $room = getRoom($_POST['roomID']);
  
  $_sqlCount = "select 
					  sum(if(b.status = 0,b.status,null)+1) as b0,
					  sum(if(b.status = 1,b.status,null)) as b1,
					  sum(if(c.status = 0,c.status,null)+1) as c0,
					  sum(if(c.status = 1,c.status,null)) as c1,
					  sum(if(d.status = 0,d.status,null)+1) as d0,
					  sum(if(d.status = 1,d.status,null)) as d1
					from students a left outer join sdq_student b
					  on a.id = b.student_id
					  join sdq_parent c on a.id = c.student_id
					  join sdq_teacher d on a.id = d.student_id
					where a.xedbe = '" . $acadyear . "' and a.xlevel = '" . $xlevel . "' and a.xyearth = '" . $xyearth . "' and a.room = '" . $room . "'
					  and b.acadyear = '" . $acadyear . "' and b.semester = '". $acadsemester . "'
					  and c.acadyear = '" . $acadyear . "' and c.semester = '". $acadsemester . "'
					  and d.acadyear = '" . $acadyear . "' and d.semester = '". $acadsemester . "'";
	$_resCount = mysql_query($_sqlCount);
	$_datCount = mysql_fetch_assoc($_resCount);
  ?>
  <table class="admintable" align="center">
    <tr> 
      <th colspan="8" align="center">
	  	<img src="../images/school_logo.gif" width="120px"><br/>
	  	สรุปผลการทำแบบประเมิน SDQ ห้อง <?=$_POST['roomID']?> ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?><br />
		<table align="center" bgcolor="#FFCCFF" cellpadding="1" cellspacing="1">
			<tr bgcolor="#FFFFFF">
				<td colspan="6">
					<font color="#0000CC">จำนวนนักเรียนทั้งหมด </font><font color="#0000CC" size="4"> <?=$_datCount['b0']+$_datCount['b1']?></font> คน
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td colspan="2" align="center">
					<font color="#0000FF"><b>นักเรียน</b></font>
				</td>
				<td colspan="2" align="center">
					<font color="#0000FF"><b>ผู้ปกครอง</b></font>
				</td>
				<td colspan="2" align="center">
					<font color="#0000FF"><b>ครูที่ปรึกษา</b></font>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td align="right"><font color="green" size="4"><?=$_datCount['b1']!=""?$_datCount['b1']:0?></font> </td>
				<td>คน ประเมินแล้ว</td>
				<td align="right"><font color="green" size="4"><?=$_datCount['c1']!=""?$_datCount['c1']:0?></font> </td>
				<td>คน ประเมินแล้ว</td>
				<td align="right"><font color="green" size="4"><?=$_datCount['d1']!=""?$_datCount['d1']:0?></font> </td>
				<td>คน ประเมินแล้ว</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td align="right"><?=displayPoint($_datCount['b0']!=""?$_datCount['b0']:0)?> </td>
				<td>คน ยังไม่ประเมิน</td>
				<td align="right"><?=displayPoint($_datCount['c0']!=""?$_datCount['c0']:0)?> </td>
				<td>คน ยังไม่ประเมิน</td>
				<td align="right"><?=displayPoint($_datCount['d0']!=""?$_datCount['d0']:0)?> </td>
				<td>คน ยังไม่ประเมิน</td>
			</tr>
		</table>
	  </th>
    </tr>
    <tr> 
		<td class="key" width="40px" align="center">เลขที่</td>
      	<td class="key" width="85px" align="center">เลขประจำตัว</td>
      	<td class="key" width="200px" align="center">ชื่อ - นามสกุล</td>
      	<td class="key" width="80px"  align="center">สถานภาพ</td>
		<td class="key" width="100px" align="center">คะแนน<br/>ความประพฤติ</td>
		<td class="key" width="70px" align="center">นักเรียน<br/>ประเมิน</td>
		<td class="key" width="70px" align="center">ผู้ปกครอง<br/>ประเมิน</td>
      	<td class="key" width="70px" align="center">ครูที่ปรึกษา<br/>ประเมิน</td>
    </tr>
	<? $sqlStudent = "select id,prefix,firstname,lastname,studstatus,points,c.status x,d.status y,e.status z
						from students a 
							 join sdq_student c on a.id = c.student_id
							 join sdq_parent d on a.id = d.student_id
							 join sdq_teacher e on a.id = e.student_id
						where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' and room = '" . $room . "' 
										and a.xedbe = '" .$acadyear ."'
										and c.acadyear = '" .$acadyear ."'
										and c.semester = '" .$acadsemester ."'
										and d.acadyear = '" .$acadyear ."'
										and d.semester = '" .$acadsemester ."'
										and e.acadyear = '" .$acadyear ."'
										and e.semester = '" .$acadsemester ."'
						order by sex,id,ordinal";
		$resStudent = mysql_query($sqlStudent); ?>
	<?  $ordinal = 1; ?>
	<?  while($dat = mysql_fetch_array($resStudent)) { ?>
		<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF"> 
			<td align="center"><?=$ordinal++?></td>
			<td align="center"><?=$dat['id']?></td>
			<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
			<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
			<td align="center"><?=displayPoint($dat['points'])?></td>
			<td align="center"><?=($dat['x']==0?"<img src='../images/delete.png' alt='ยังไม่ได้ประเมิน' />":"<img src='../images/ball_green.png' alt='ประเมินแล้ว' />")?></td>
			<td align="center"><?=($dat['y']==0?"<img src='../images/delete.png' alt='ยังไม่ได้ประเมิน' />":"<img src='../images/ball_green.png' alt='ประเมินแล้ว' />")?></td>
			<td align="center"><?=($dat['z']==0?"<img src='../images/delete.png' alt='ยังไม่ได้ประเมิน' />":"<img src='../images/ball_green.png' alt='ประเมินแล้ว' />")?></td>
		</tr>
	<? } ?>
</table>
<? } // end if ?>
</div>

