
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.5 แบบรายงานประจำเดือน(รายชื่อตามห้องเรียน)</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_800/reportMonthRoom&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportMonthRoom&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_800/reportMonthRoom&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_800/reportMonthRoom&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form action="" method="post">
		<font color="#000000" size="2"  >
		เลือกห้อง 
		  
		  <?php 
		  					$error = 1;
							$sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
							//echo $sql_Room ;
							$resRoom = mysql_query($sql_Room);			
					?>
		  <select name="roomID" class="inputboxUpdate">
		  	<option value=""> &nbsp; &nbsp; &nbsp; </option>
			<?php
		
							while($dat = mysql_fetch_assoc($resRoom))
							{
								$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
								echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
								echo getFullRoomFormat($dat['room_id']);
								echo "</option>";
							} mysql_free_result($resRoom);
						?>
			</select> &nbsp; เดือน
			 <select name="month" class="inputboxUpdate">
			 	<option value=""></option>
				<?php
					$_sqlMonth = "select distinct month(check_date)as m,year(check_date)+543 as y
									from student_800 where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
									order by year(check_date),month(check_date)";
					$_resMonth = mysql_query($_sqlMonth);
					while($_datMonth = mysql_fetch_assoc($_resMonth))
					{
						$_select = (isset($_POST['month'])&&$_POST['month'] == $_datMonth['m']?"selected":"");
						echo "<option value=\"" . $_datMonth['m'] . "\" $_select>" . displayMonth($_datMonth['m']) . ' ' . $_datMonth['y'] . "</option>";
					} mysql_free_result($_resMonth);
				?>
			 </select>
			 <input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			 <input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
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

  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%" >
    <tr>
	<?php
		if(isset($_POST['search']) && ($_POST['month'] == "" || $_POST['roomID'] == ""))
		{
			echo "<td align='center'><br/><font color='red'>กรุณาเลือกห้องเรียน และ เดือนที่ต้องการทราบข้อมูลก่อน !</font></td></tr>";
		}
		else if(isset($_POST['search']) && $_POST['month'] != "" && $_POST['roomID'] != "")
		{
			$sqlStudent = "select students.id,students.prefix,students.firstname,students.lastname ,students.studstatus ,
							  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
							  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
							  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
							  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
							  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
							  count(class_id) as sum
							from students  left outer join student_800 on students.id = student_800.student_id
							where month(check_date) = '" . $_POST['month'] . "'
								  and xyearth = '" . $xyearth . "' and xlevel = '" . $xlevel ."' and xedbe = '" . $acadyear . "'
								  and room = '" . $room . "' and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' ";
			if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) "; 
			$sqlStudent .= " group by id order by sex,id";
			
			//echo $sqlStudent;
			
			$resStudent = mysql_query($sqlStudent);
			$ordinal = 1;
			$totalRows = mysql_num_rows($resStudent);
			if($totalRows == 0)
			{
				echo "<td align='center'><br/><font color='red'>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</font></td></tr>";
				$error = 0;
			}
			else{
	?>	 
      <th colspan="10" align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>รายงานการเข้าร่วมกิจกรรมหน้าเสาธงนักเรียนห้อง <?=getFullRoomFormat($_POST['roomID']); ?>
		<br/>ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
		<br/>ประจำเดือน <?php echo displayMonth($_POST['month']); ?>
	  </th>
    </tr>
    <tr> 
		<td class="key"  width="55px" align="center" rowspan="2">เลขที่</td>
      	<td class="key"  width="90px" align="center" rowspan="2">เลขประจำตัว</td>
      	<td class="key"  width="210px" align="center" rowspan="2">ชื่อ - นามสกุล</td>
		<td class="key"  width="120px"  align="center" rowspan="2">สถานภาพ<br/>ปัจจุบัน</td>
		<td class="key"   align="center" colspan="6">การมาเข้าแถว</td>
    </tr>
	<tr>
		<td class="key"  width="60px" align="center">มา</td>
		<td class="key"  width="60px" align="center">กิจกรรม</td>
		<td class="key"  width="60px" align="center">สาย</td>
		<td class="key"  width="60px" align="center">ลา</td>
		<td class="key"  width="60px" align="center">ขาด</td>
		<td class="key"  width="60px" align="center">รวม</td>
	</tr>
	<? $_x = 0;?>
	<? for($i = 0; $i < $totalRows ; $i++) { ?>
		<tr <?=$_x < 5 ? "":"bgcolor=\"#EFFEFE\""?>>
		<? $dat = mysql_fetch_array($resStudent); ?>
		<td align="center"><?=$ordinal?></td>
		<td align="center"><?=$dat['id']?></td>
		<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
		<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
		<td align="center"><?=$dat['a']==0?"-":$dat['a']?></td>
		<td align="center"><?=$dat['b']==0?"-":$dat['b']?></td>
		<td align="center"><?=$dat['c']==0?"-":$dat['c']?></td>
		<td align="center"><?=$dat['d']==0?"-":$dat['d']?></td>
		<td align="center"><?=$dat['e']==0?"-":$dat['e']?></td>
		<td align="center"><?=$dat['sum']?></td>
		</tr>
		<? $ordinal++; $_x++; ?>
		<?	if($_x == 10){$_x = 0;}
			else{}
		} mysql_free_result($resStudent);
	  }//ปิด if-else ตรวจสอบข้อมูลในฐานข้อมูล
	}//ปิด if-else ตรวจสอบการเลือกวันที่	?>
</table>

</div>

