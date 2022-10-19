
<link rel="stylesheet" type="text/css" href="module_800/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_800/js/calendar.js"></script>

<div id ="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.10 แบบรายงานเลือกช่วงเวลา</strong></font></span></td>
       <td >
		<?php
			if(isset($_REQUEST['acadyear']))
			{
				$acadyear = $_REQUEST['acadyear'];
			}
			if(isset($_REQUEST['acadsemester']))
			{
				$acadsemester = $_REQUEST['acadsemester'];
			}
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_800/reportPeriod&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportPeriod&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else { echo " <a href=\"index.php?option=module_800/reportPeriod&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ; }
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else { echo " <a href=\"index.php?option=module_800/reportPeriod&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ; }
				?>
		<form action="" method="post">
		<font   size="2" color="#000000">
		วันที่เริ่ม <input type="text" id="date" name="date" onClick="showCalendar(this.id)" value="<?=(isset($_POST['date'])&&$_POST['date']!=""?$_POST['date']:"")?>" class="inputboxUpdate" /> 
		วันที่สิ้นสุด  <input type="text" id="date2" name="date2" onClick="showCalendar(this.id)" value="<?=(isset($_POST['date2'])&&$_POST['date2']!=""?$_POST['date2']:"")?>" class="inputboxUpdate" /> <br/>
		เลือกห้อง 
			<?php 
					$sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
					//echo $sql_Room ;
					$resRoom = mysql_query($sql_Room);			
			?>
			<select name="roomID" class="inputboxUpdate">
				<option value=""> </option>
				<?php
					while($dat = mysql_fetch_assoc($resRoom))
					{
						$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
						echo "<option value=\"" . $dat['room_id'] . "\"" . $_select . " >";
						echo getFullRoomFormat($dat['room_id']);
						echo "</option>";
					} mysql_free_result($resRoom);
				?>
			</select>
			<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา </font>
			<input type="submit" value="เรียกดู" name="search" class="button"/> 
		</form>
	  </td>
    </tr>
  </table>
<br/>
	<?php
				if(isset($_POST['search']) && ($_POST['date'] == "" || $_POST['date2'] == "" || $_POST['roomID'] == ""))
				{
					echo "<table width='95%'><tr><td colspan=10 align='center'>";
					echo "<font color='red'>กรุณาเลือก วันที่เริ่ม วันที่สิ้นสุด และ เลือกห้องเรียนที่ต้องการทราบข้อมูลก่อน !</font>";
					echo "</td></tr></table>";
				}
				if(isset($_POST['search']) && $_POST['date'] != "" && $_POST['date2'] != "" and $_POST['roomID'] != "")
				{
					  $xlevel  = getXlevel($_POST['roomID']);
					  $xyearth = getXyearth($_POST['roomID']);
					  $room    = getRoom($_POST['roomID']);
					$sqlStudent = "select students.id,students.prefix,students.firstname,students.lastname ,students.studstatus ,
							  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
							  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
							  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
							  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
							  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
							  count(class_id) as sum
							from students  left outer join student_800 on students.id = student_800.student_id
							where check_date between '" . $_POST['date'] . "' and '" . $_POST['date2'] . "'
								  and xyearth = '" . $xyearth . "' and xlevel = '" . $xlevel ."' and xedbe = '" . $acadyear . "'
								  and room = '" . $room . "' and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' ";
					if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
					$sqlStudent .= " group by id order by sex,id";
					
					$resStudent = mysql_query($sqlStudent);
					$ordinal = 1;
					$totalRows = mysql_num_rows($resStudent);
					if(!$resStudent || mysql_num_rows($resStudent) == 0)
					{
						echo "<br/><center><font color='red'>ไม่พบข้อมูลที่ค้นหา อาจเนื่องมาจากยังไม่บันทึกข้อมูลวันที่ค้นหา หรือ รูปแบบวันที่ผิดพลาด</font></center>";
					}
					else
					{
			 ?>
 <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%" >
 
    <tr>
		<th colspan="10" align="center">
			<img src="../images/school_logo.gif" width="120px">
			<br/>รายงานการเข้าร่วมกิจกรรมหน้าเสาธงนักเรียนห้อง <?=getFullRoomFormat($_POST['roomID']); ?>
			<br/>ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?> <br/>
			ระหว่างวันที่ <?=displayFullDate($_POST['date']);?> ถึง วันที่ <?=displayFullDate($_POST['date2']);?>
		</th>
    </tr>
	 <tr> 
		<td class="key" width="55px" align="center" rowspan="2">เลขที่</td>
      	<td class="key" width="90px" align="center" rowspan="2">เลขประจำตัว</td>
      	<td class="key" width="210px" align="center" rowspan="2">ชื่อ - นามสกุล</td>
		<td class="key" width="110px"  align="center" rowspan="2">สถานภาพ<br/>ปัจจุบัน</td>
		<td class="key" align="center" colspan="6">การมาเข้าแถว</td>
    </tr>
	<tr>
		<td class="key" width="55px" align="center">มา</td>
		<td class="key" width="55px" align="center">กิจกรรม</td>
		<td class="key" width="55px" align="center">สาย</td>
		<td class="key" width="55px" align="center">ลา</td>
		<td class="key" width="55px" align="center">ขาด</td>
		<td class="key" width="55px" align="center">รวม</td>
	</tr>
	<? while($dat = mysql_fetch_assoc($resStudent)) { ?>
		<tr>
		<td align="center"><?=$ordinal++?></td>
		<td align="center"><?=$dat['id']?></td>
		<td align="left"><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
		<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
		<td align="right"><?=$dat['a']==0?"-":number_format($dat['a'],0,'.',',')?></td>
		<td align="right"><?=$dat['b']==0?"-":number_format($dat['b'],0,'.',',')?></td>
		<td align="right"><?=$dat['c']==0?"-":number_format($dat['c'],0,'.',',')?></td>
		<td align="right"><?=$dat['d']==0?"-":number_format($dat['d'],0,'.',',')?></td>
		<td align="right"><?=$dat['e']==0?"-":number_format($dat['e'],0,'.',',')?></td>
		<td align="right"><?=$dat['sum']==0?"-":number_format($dat['sum'],0,'.',',')?></td>
		</tr>
		<? } mysql_free_result($resStudent); ?>
	<? } } ?>
</table>

</div>
