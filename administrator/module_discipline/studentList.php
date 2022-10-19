<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1. ระบบรับแจ้งพฤติกรรม บันทึกการสอบสวนและดำเนินการ<br/>[รายชื่อนักเรียนตามห้องเรียน]</strong></font></span></td>
      <td >
	  	<?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_discipline/studentList&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/studentList&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1){ echo "<font color='blue'>1</font> , "; }
					else{
						echo " <a href=\"index.php?option=module_discipline/studentList&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2){ echo "<font color='blue'>2</font>"; }
					else{
						echo " <a href=\"index.php?option=module_discipline/studentList&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		</font>
		<br/>
	  	<font  size="2" color="#000000">เลือกห้องเรียน
			<?  $sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
			    $resRoom = mysql_query($sql_Room); ?>
			<select name="roomID" class="inputboxUpdate">
				<option value=""></option>
				<? while($dat = mysql_fetch_assoc($resRoom)) {
						$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
						echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
						echo getFullRoomFormat($dat['room_id']);
						echo "</option>";
					}
				?>
			</select>
	  		<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
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
	<center><br/><font color="#FF0000">กรุณาเลือกห้องเรียนก่อน </font></center>
<? } else if (isset($_POST['search']) && $_POST['roomID'] != "") { ?>

<div align="center">
  <table class="admintable" cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th colspan="13" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายชื่อนักเรียนห้อง <?=getFullRoomFormat($_POST['roomID'])?><br/>
			ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
	  </th>
    </tr>
    <tr height="30px"> 
		<td class="key" width="45px" align="center" >เลขที่</td>
      	<td class="key" width="95px" align="center" >เลขประจำตัว</td>
      	<td class="key" width="195px" align="center" >ชื่อ - นามสกุล</td>
      	<td class="key" width="100px"  align="center" >สถานภาพ</td>
		<td class="key" width="95px" align="center" >คะแนน<br/>ความประพฤติ</td>
		<td class="key" align="center" >-</td>
    </tr>
	<?php
		$sqlStudent = "select id,prefix,firstname,lastname,studstatus,points
						
					from students 
					where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' and room = '" . $room . "'  
					        and xedbe = '" . $acadyear . "' ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		$sqlStudent .= "group by id ";
		$sqlStudent .= "order by sex,id ";
		// echo $sqlStudent;
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
            <td>
            	<a href="index.php?option=module_discipline/disciplineSearch&page=1&student_id=<?=$dat['id']?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">
					แสดงคดี
				</a>
            </td>
		</tr>
	<? } //end for?>
</table>
</div>
  <? } //end else-if ?>
</div>


