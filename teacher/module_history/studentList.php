<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1. รายการสืบค้นประวัติ [รายชื่อนักเรียน]</strong></font></span></td>
      <td >
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_history/studentList&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/studentList&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_history/studentList&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_history/studentList&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
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
  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th colspan="10" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายชื่อนักเรียนห้อง <?=getFullRoomFormat($_POST['roomID'])?><br/>
			ภาคเรียนที่ <?=$acadsemester;?> ปีการศึกษา <?=$acadyear; ?>
	  </th>
    </tr>
    <tr> 
		<td class="key" width="35px" align="center">เลขที่</td>
      	<td class="key" width="65px" align="center">เลขประจำตัว</td>
      	<td class="key" width="185px" align="center">ชื่อ - นามสกุล</td>
      	<td class="key" width="100px"  align="center">สถานภาพ</td>
		<td class="key" width="65px" align="center">คะแนน<br/>ความประพฤติ</td>
		<td class="key" width="60px" align="center">ประวัติ</td>
		<td class="key" width="60px" align="center">เข้าแถว</td>
      	<td class="key" width="60px" align="center">เข้าห้องเรียน</td>
      	<td class="key" width="60px" align="center">ความดี</td>
      	<td class="key" width="60px"  align="center">พฤติกรรมฯ</td>
    </tr>
	<?php
		$sqlStudent = "select id,prefix,firstname,lastname,studstatus,points from students 
						where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' and room = '" . $room . "'  and xedbe = '" . $acadyear . "' ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		$sqlStudent .= "order by sex,id ";
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
			<td align="center">
				<form method="post" action="index.php?option=module_history/history&acadyear=<?=$acadyear?>">
					<input type="submit" name="search" value="HIS" class="buttonHis" />
					<input type="hidden" name="studentid" value="<?=$dat['id']?>">
				</form>
			</td>
			<td align="center">
				<form method="post" action="index.php?option=module_history/history_800&acadyear=<?=$acadyear?>">
					<input type="submit" name="search" value="800" class="button800" />
					<input type="hidden" name="studentid" value="<?=$dat['id']?>">
				</form>
			</td>
			<td align="center">
				<form method="post" action="index.php?option=module_history/history_room&acadyear=<?=$acadyear?>">
					<input type="submit" name="search" value="Room" class="buttonRoom" />
					<input type="hidden" name="studentid" value="<?=$dat['id']?>">
				</form>
			</td>
			<td align="center">
				<form method="post" action="index.php?option=module_history/history_moral">
					<input type="submit" name="search" value="Good" class="buttonAct" />
					<input type="hidden" name="studentid" value="<?=$dat['id']?>">
				</form>
			</td>
			<td align="center">
				<form method="post" action="index.php?option=module_history/history_discipline&acadyear=<?=$acadyear?>">
					<input type="submit" name="search" value="Disc" class="buttonDis" />
					<input type="hidden" name="studentid" value="<?=$dat['id']?>">
				</form>
			</td>
		</tr>
	<? } //end for?>
</table>
  <? } //end else-if ?>
</div>

