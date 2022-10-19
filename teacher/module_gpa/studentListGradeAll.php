<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_gpa/index"><img src="../images/gpa.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Learning Achievement</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.2 ผลสัมฤทธิ์นักเรียนตามห้องเรียน (ทุกภาคเรียน)</strong></font></span></td>
      <td >
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_gpa/studentListGradeAll&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_gpa/studentListGradeAll&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_gpa/studentListGradeAll&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_gpa/studentListGradeAll&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		</font>
		<br/>
	  	<font  size="2" color="#000000">เลือกห้องเรียน
			<?php 
					$sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
					//echo $sql_Room ;
					$resRoom = mysql_query($sql_Room);			
			?>
			<select name="roomID" class="inputboxUpdate">
				<option value=""></option>
				<?php

					while($dat = mysql_fetch_assoc($resRoom))
					{
						$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
						echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
						echo getFullRoomFormat($dat['room_id']);
						echo "</option>";
					}
					
				?>
			</select>
	  		<input type="submit" value="สืบค้น" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			</font>
	   </td>
    </tr>
  </table>
  </form>
<?php
	  $xlevel = getXlevel($_POST['roomID']);
	  $xyearth= getXyearth($_POST['roomID']);
	  $room = getRoom($_POST['roomID']);
?>

  
<? if(isset($_POST['search']) && $_POST['roomID'] == "") { ?>
	<center><br/><font color="#FF0000">กรุณาเลือกห้องเรียนก่อน !</font></center>
<? } else if (isset($_POST['search']) && $_POST['roomID'] != "") { ?>
<div align="center">
  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th colspan="10" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายชื่อนักเรียนห้อง <?=getFullRoomFormat($_POST['roomID'])?><br/>
			ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
	  </th>
    </tr>
    <tr> 
		<td class="key" width="35px" align="center" rowspan="2">เลขที่</td>
      	<td class="key" width="80px" align="center" rowspan="2">เลขประจำตัว</td>
      	<td class="key" width="195px" align="center" rowspan="2">ชื่อ - นามสกุล</td>
      	<td class="key" width="100px"  align="center" rowspan="2">สถานภาพ</td>
		<td class="key" width="95px" align="center" rowspan="2">คะแนน<br/>ความประพฤติ</td>
		<td class="key" align="center" colspan="4">ผลการเรียนไม่พึงประสงค์</td>
		<td class="key" width="70px" align="center" rowspan="2">-</td>
    </tr>
    <tr>
      	<td class="key" width="60px" align="center">0</td>
      	<td class="key" width="60px" align="center">ร</td>
      	<td class="key" width="60px"  align="center">มส.</td>
        <td class="key" width="60px"  align="center">มร.</td>
    </tr>
	<?php
		$sqlStudent = "select 
							id,prefix,firstname,lastname,studstatus,points,
							sum(if(grade='0',1,0)) as z0,
							sum(if(grade='ร',1,0)) as z1,
							sum(if(grade='มส',1,0)) as z2,
							sum(if(grade='',1,0)) as z3
					   from students left outer join grades on (id = student_id)
					   where 
					   		students.xlevel = '". $xlevel . "' and 
							xyearth = '" . $xyearth . "' and 
							room = '" . $room . "'  and 
							xedbe = '" . $acadyear . "'";
							// and	grade in ('0','ร','มส','') ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		$sqlStudent .= "group by student_id ";
		$sqlStudent .= "order by sex,id ";
		
		 //echo $sqlStudent;
		
		$resStudent = mysql_query($sqlStudent);
		$ordinal = 1;
		$totalRows = mysql_num_rows($resStudent);
		for($i = 0; $i < $totalRows ; $i++) { ?>
		<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
			<? $dat = mysql_fetch_array($resStudent); ?>
			<td align="center"><?=$ordinal++?></td>
			<td align="center"><?=$dat['id']?></td>
			<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
			<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
			<td align="center"><?=displayPoint($dat['points'])?></td>
			<td align="center"><?=$dat['z0']==0?"-":("<b>" . $dat['z0'] . "</b>")?></td>
            <td align="center"><?=$dat['z1']==0?"-":("<b>" . $dat['z1'] . "</b>")?></td>
            <td align="center"><?=$dat['z2']==0?"-":("<b>" . $dat['z2'] . "</b>")?></td>
            <td align="center"><?=$dat['z3']==0?"-":("<b>" . $dat['z3'] . "</b>")?></td>
            <td align="center">
            	<a href="index.php?option=module_gpa/gradeDetailsAll&xlevel=<?=$xlevel?>&xyearth=<?=$xyearth?>
                         &room=<?=$room?>&name=<?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?>&student_id=<?=$dat['id']?>">
                	รายละเอียด
                </a>
            </td>
		</tr>
	<? } //end for?>
</table>
</div>
  <? } //end else-if ?>
</div>

