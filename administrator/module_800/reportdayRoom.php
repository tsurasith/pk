
<link rel="stylesheet" type="text/css" href="module_discipline/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_discipline/js/calendar.js"></script>

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.2 แบบรายงานประจำวัน(รายชื่อตามห้องเรียน)</strong></font></span></td>
      <td >

		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_800/reportdayRoom&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportdayRoom&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <? if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_800/reportdayRoom&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_800/reportdayRoom&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form action="" method="post">
		<font color="#000000" size="2"  >
		เลือกห้อง 
		<?  $error = 1;
		    $sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
			$resRoom = mysql_query($sql_Room);
			//echo $sql_Room;
		?>
		  <select name="roomID" class="inputboxUpdate">
		  	<option> &nbsp; &nbsp; &nbsp; </option>
			<?  while($dat = mysql_fetch_assoc($resRoom)) {
					$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
					echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
					echo getFullRoomFormat($dat['room_id']);
					echo "</option>";
				} mysql_free_result($resRoom);//end while ?>
			</select> &nbsp; วันที่ 
			 <input name="date" type="text" id="date" onClick="showCalendar(this.id)" size="10px" maxlength="10" value="<?=(isset($_POST['date'])&&$_POST['date']!=""?$_POST['date']:"")?>" class="inputboxUpdate" />
			 <input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			 <input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		  </font>
		  </form>
	  </td>
    </tr>
  </table>

 <?php
	  $xlevel  = getXlevel($_POST['roomID']);
	  $xyearth = getXyearth($_POST['roomID']);
	  $room    = getRoom($_POST['roomID']);
 ?>

  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%">
    <tr>
	<?php
		if(isset($_POST['search']) && ($_POST['date'] == "" || $_POST['roomID']== ""))
		{
			echo "<td align='center'><font color='red'><br/>กรุณาเลือกห้องเรียน และ วันที่ต้องการดูข้อมูลก่อน !</font></td></tr>";
		}
		else if(isset($_POST['search']) && $_POST['date'] != "")
		{
			$sqlStudent = "select a.id,a.prefix,a.firstname,a.lastname , b.timecheck_id,a.studstatus from students as a
							join student_800 as b on a.id = b.student_id
							where a.xlevel = '". $xlevel . "' and a.xyearth = '" . $xyearth . "' and a.room = '" . $room . "' 
							and b.check_date ='" . $_POST['date'] . "' and a.xedbe = '" . $acadyear . "' 
							and b.acadyear = '" . $acadyear . "' and b.acadsemester = '" . $acadsemester . "' ";
			if($_POST['studstatus'] == "1,2") $sqlStudent .= "and studstatus in (1,2)";
			$sqlstudent .= " order by a.sex,a.ordinal ";
			$resStudent = mysql_query($sqlStudent);
			$ordinal = 1;
			$totalRows = mysql_num_rows($resStudent);
			if($totalRows == 0)
			{
				echo "<td align='center'><font color='red'><br/>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</font></td></tr>";
				$error = 0;
			}
			else{
	?>	 
      <th colspan="6" align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>รายงานการเข้าร่วมกิจกรรมหน้าเสาธงนักเรียนห้อง <?=getFullRoomFormat($_POST['roomID']); ?>
		<br/>ภาคเรียนที่ <?=$acadsemester; ?> ปีการศึกษา <?=$acadyear; ?>
		<br/>ประจำวันที่ <?=displayFullDate($_POST['date']);?>
	  </th>
    </tr>
    <tr> 
		<td class="key" width="55px" align="center">เลขที่</td>
      	<td class="key" width="100px" align="center">เลขประจำตัว</td>
      	<td class="key" width="200px" align="center">ชื่อ - นามสกุล</td>
		<td class="key" width="120px"  align="center">สถานภาพปัจจุบัน</td>
		<td class="key" width="85px" align="center">การมาเข้าแถว</td>
    </tr>
	<? $_x = 0;
		for($i = 0; $i < $totalRows ; $i++) {
			if($_x < 5 ){echo "<tr>";}
			else{echo "<tr bgcolor=\"#EFFEFE\">";}
			$dat = mysql_fetch_array($resStudent);
			echo "<td align=\"center\">$ordinal</td>";
			echo "<td align=\"center\">" . $dat['id'] . "</td>";
			echo "<td>" . $dat['prefix'] . $dat['firstname'] . " " . $dat['lastname'] . "</td>";
			echo "<td align=\"center\">" . displayStudentStatusColor($dat['studstatus']) . "</td>";
			echo "<td align=\"center\">" . displayTimecheckColor($dat['timecheck_id']) . "</td>";			
			echo "</tr>";
			$ordinal++;
			$_x++;
			if($_x == 10){$_x = 0;}
			else{}
		} mysql_free_result($resStudent); ?>
		<table class="admintable">
	<tr><td class="key" align="center" colspan="2">สรุปผล</td>
	<?php
		$_sql = "select class_id,
			sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
			sum(if(timecheck_id = '01',timecheck_id,null)) as b,
			sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
			sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
			sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
			count(class_id) as sum
			from student_800 left outer join students on student_id = id
			where check_date = '" . $_POST['date'] . "' and class_id = '" . $_POST['roomID'] . "'
			and xEDBE = '" . $acadyear . "' ";
						if($_POST['studstatus'] == "1,2") $_sql .= "and studstatus in (1,2) ";
						$_sql .= " group by class_id order by class_id";
						$_result = mysql_query($_sql);
						$_dat = mysql_fetch_assoc($_result);
					?>
					<?php
						if($error)
						{ ?>
							<tr bgcolor="#FFFFFF">
								<td align="right" width="70px">มาปกติ</td><td align="center" width="50px"><?=$_dat['a']==0?"-":$_dat['a']?></td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<td align="right">กิจกรรม</td><td align="center"><?=$_dat['b']==0?"-":$_dat['b']?></td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<td align="right">สาย</td><td align="center"><?=$_dat['c']==0?"-":$_dat['c']?></td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<td align="right">ลา</td><td align="center"><?=$_dat['d']==0?"-":$_dat['d']?></td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<td align="right">ขาด</td><td align="center"><?=$_dat['e']==0?"-":$_dat['e']?></td>
							</tr>
							<tr bgcolor="#FFCCFF">
								<th align="right">รวม</th><th align="center"><?=$_dat['sum']?></th>
							</tr>
						<?php } mysql_free_result($_result);?>
				</table>
	<?  }//ปิด if-else ตรวจสอบข้อมูลในฐานข้อมูล
	}//ปิด if-else ตรวจสอบการเลือกวันที่
	?>
</table>
</div>
