
<link rel="stylesheet" type="text/css" href="module_800/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_800/js/calendar.js"></script>

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center" valign="top"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td valign="top"><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.3 แบบรายงานประจำวัน</strong></font></span></td>
      <td >
	  	
		
		
		<?php
			$_error = 1;
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_800/reportdayName&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportdayName&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		 ภาคเรียนที่   
		 <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_800/reportdayName&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_800/reportdayName&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		
		<form action="" method="post">
		<font color="#000000" size="2"  >ระดับชั้น
		  	<select name="roomID" class="inputboxUpdate">
		  		<option value=""> </option>
				<option value="3/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/1"?"selected":""?>> มัธยมศึกษาปีที่ 1 </option>
				<option value="3/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/2"?"selected":""?>> มัธยมศึกษาปีที่ 2 </option>
				<option value="3/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/3"?"selected":""?>> มัธยมศึกษาปีที่ 3 </option>
				<option value="4/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/1"?"selected":""?>> มัธยมศึกษาปีที่ 4 </option>
				<option value="4/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/2"?"selected":""?>> มัธยมศึกษาปีที่ 5 </option>
				<option value="4/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/3"?"selected":""?>> มัธยมศึกษาปีที่ 6 </option>
				<option value="all" <?=isset($_POST['roomID'])&&$_POST['roomID']=="all"?"selected":""?>> ทั้งโรงเรียน </option>
			</select> 
			วันที่ 
			<input name="date" type="text" id="date" onClick="showCalendar(this.id)" size="10px" maxlength="10" value="<?=(isset($_POST['date'])&&$_POST['date']!=""?$_POST['date']:"")?>" class="inputboxUpdate"/>
			<input type="submit" value="เรียกดู" class="button" name="search"/><br/>
			การมาเข้าแถว
				<select name="checkType" class="inputboxUpdate">
					<option value="">&nbsp; &nbsp; </option>
					<option value="00" <?=isset($_POST['checkType'])&&$_POST['checkType']=='00'?"selected":""?>> มาปกติ </option>
					<option value="01" <?=isset($_POST['checkType'])&&$_POST['checkType']=='01'?"selected":""?>> กิจกรรม </option>
					<option value="02" <?=isset($_POST['checkType'])&&$_POST['checkType']=='02'?"selected":""?>> สาย </option>
					<option value="03" <?=isset($_POST['checkType'])&&$_POST['checkType']=='03'?"selected":""?>> ลา </option>
					<option value="04" <?=isset($_POST['checkType'])&&$_POST['checkType']=='04'?"selected":""?>> ขาด </option>
					<option value="02,03,04" <?=isset($_POST['checkType'])&&$_POST['checkType']=='02,03,04'?"selected":""?>> สาย,ลาและขาด </option>
					<option value="01,02,03,04" <?=isset($_POST['checkType'])&&$_POST['checkType']=='01,02,03,04'?"selected":""?>>กิจกรรม,สาย,ลาและขาด </option>
				</select>
			 <br/>
			 <input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		  </font>
	    </form>
	  </td>
    </tr>
  </table>

  <?php
  $xlevel;
  $xyearth;
  if($_POST['roomID'] != "all")
  {
  	$xlevel = substr($_POST['roomID'],0,1);;
	$xyearth = substr($_POST['roomID'],2,1);
  }
  ?>

  <table class="admintable">
    <tr>
	<?php
		if(isset($_POST['search']) && ($_POST['date'] == "" || $_POST['roomID'] == "" || $_POST['checkType'] == ""))
		{
			echo "<td align='center'><br/><font color='red'>กรุณาตรวจสอบการข้อมูลให้ถูกต้อง ให้ทำการเลือกระดับชั้นที่ต้องการดู การมาเข้าแถว และวันที่ให้เรียบร้อยก่อน !</font></td></tr>";
		}
		else if(isset($_POST['search']) && $_POST['date'] != "" && $_POST['roomID'] != "" && $_POST['checkType'] != "")
		{
			$sqlStudent="";
			if($_POST['roomID'] == "all")
			{
				$sqlStudent = "select a.id,a.prefix,a.firstname,a.lastname ,a.xlevel,a.xyearth,a.room, b.timecheck_id,a.studstatus from students as a
							join student_800 as b on a.id = b.student_id
							where a.xedbe = '" . $acadyear . "' 
							and b.check_date ='" . $_POST['date'] . "' and timecheck_id in (" . $_POST['checkType'] . ")
							and b.acadyear = '" .$acadyear . "' and b.acadsemester = '" . $acadsemester . "' ";
				if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
				$sqlStudent .= " order by a.xlevel,a.xyearth,a.room,a.sex,a.id ";
			}
			else
			{
				$sqlStudent = "select a.id,a.prefix,a.firstname,a.lastname ,a.xlevel,a.xyearth,a.room, b.timecheck_id,a.studstatus from students as a
							join student_800 as b on a.id = b.student_id
							where a.xlevel = '". $xlevel . "' and a.xyearth = '" . $xyearth . "' and a.xedbe = '" . $acadyear . "' 
							and b.check_date ='" . $_POST['date'] . "' and timecheck_id in (" . $_POST['checkType'] . ")
							and b.acadyear = '" .$acadyear . "' and b.acadsemester = '" . $acadsemester . "' ";
				if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
				$sqlStudent .= " order by a.room,a.sex,a.ordinal ";
			}
			//echo $sqlStudent;
			$resStudent = mysql_query($sqlStudent);
			$ordinal = 1;
			$totalRows = mysql_num_rows($resStudent);
			if($totalRows == 0)
			{
				echo "<td align='center'><font color='red'><br/>ไม่พบข้อมูลในรายการที่คุณเลือก</font></td></tr>";
				$_error = 0;
			}
			else{
	?>	 
      <th colspan="6" align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>รายงานการเข้าร่วมกิจกรรมหน้าเสาธงนักเรียนชั้นมัธยมศึกษาปีที่ <?php echo displayXyear($_POST['roomID']); ?>
		<br/>ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
		<br/><?=displayFullDate($_POST['date']); ?>
	  </th>
    </tr>
    <tr height="30px"> 
		<td class="key" width="55px" align="center">ลำดับที่</td>
      	<td class="key" width="100px" align="center">เลขประจำตัว</td>
      	<td class="key" width="200px" align="center">ชื่อ - นามสกุล</td>
      	<td class="key" width="70px" align="center">ห้อง</td>
		<td class="key" width="120px"  align="center">สถานภาพปัจจุบัน</td>
		<td class="key" width="85px" align="center">การมาเข้าแถว</td>
    </tr>
	<?php
		$_x = 0;
		for($i = 0; $i < $totalRows ; $i++)
		{
			if($_x < 5 ){echo "<tr>";}
			else{echo "<tr bgcolor=\"#EFFEFE\">";}
			$dat = mysql_fetch_array($resStudent);
			echo "<td align=\"center\">$ordinal</td>";
			echo "<td align=\"center\">" . $dat['id'] . "</td>";
			echo "<td>" . $dat['prefix'] . $dat['firstname'] . " " . $dat['lastname'] . "</td>";
			if($_POST['roomID'] != "all")
			{
				echo "<td align=\"center\">" . displayXyear($_POST['roomID']) . "/" .$dat['room'] . "</td>";
			}
			else
			{
				echo "<td align=\"center\">" . displayRoomTable($dat['xlevel'] , $dat['xyearth']) . "/" .$dat['room'] . "</td>";
			}
			echo "<td align=\"center\">" . displayStudentStatusColor($dat['studstatus']) . "</td>";			
			echo "<td align=\"center\">" . displayTimecheckColor($dat['timecheck_id']) . "</td>";			
			echo "</tr>";
			$ordinal++;
			$_x++;
			if($_x == 10){$_x = 0;}
			else{}
		} //end-for
		mysql_free_result($resStudent);
	  }//ปิด if-else ตรวจสอบข้อมูลในฐานข้อมูล
?>

	<tr>
		<td colspan="6" align="center">
        <br/>
		<?php if($_error){ ?>
			<table width="400px" cellpadding="1" cellspacing="1">
				<tr height="30px">
					<td class="key" width="70px" align="center">ห้อง</td>
					<td class="key" width="55px" align="center">มาปกติ</td>
					<td class="key" width="55px" align="center">กิจกรรม</td>
					<td class="key" width="55px" align="center">สาย</td>
					<td class="key" width="55px" align="center">ลา</td>
					<td class="key" width="55px" align="center">ขาด</td>
					<td class="key" width="60px" align="center">รวม</td>
				</tr>
				<?php
					$_sql = "";
					if($_POST['roomID'] != "all")
					{
						$_sql = "select class_id,
									  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
									  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
									  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
									  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
									  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
									  count(class_id) as sum
								from student_800 left outer join students on student_id = id
								where check_date = '" . $_POST['date'] . "' and class_id like '" . displayXyear($_POST['roomID'],0,1) . "%' 
									and xEDBE = '" . $acadyear . "' ";
						if($_POST['studstatus']=="1,2") $_sql .= " and studstatus in (1,2)";
						$_sql .= " group by class_id order by class_id";
					}
					else
					{
						$_sql = "select class_id,
									  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
									  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
									  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
									  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
									  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
									  count(class_id) as sum
								from student_800 left outer join students on student_id = id
								where check_date = '" . $_POST['date'] . "' and xEDBE = '" . $acadyear . "' ";
						if($_POST['studstatus']=="1,2") $_sql .= " and studstatus in (1,2)";
						$_sql .= " group by check_date";
					}
					$_result = mysql_query($_sql);
					while($_dat = mysql_fetch_assoc($_result))
					{
						echo "<tr bgcolor=\"white\">";
						if($_POST['roomID'] != "all")
						{ echo "<td align=\"center\">" . getFullRoomFormat($_dat['class_id']) . "</td>";}
						else
						{ echo "<td align=\"center\">-</td>";}
						echo "<td align=\"right\">" . ($_dat['a']==0?"-":number_format($_dat['a'],0,'',',')) . "</td>";
						echo "<td align=\"right\">" . ($_dat['b']==0?"-":$_dat['b']) . "</td>";
						echo "<td align=\"right\">" . ($_dat['c']==0?"-":$_dat['c']) . "</td>";
						echo "<td align=\"right\">" . ($_dat['d']==0?"-":$_dat['d']) . "</td>";
						echo "<td align=\"right\">" . ($_dat['e']==0?"-":$_dat['e']) . "</td>";
						echo "<td align=\"right\">" . ($_dat['sum']==0?"-":number_format($_dat['sum'],0,'',',')) . "</td>";
						echo "</tr>";
					} mysql_free_result($_result);
				?>
			</table>
			<?php } //ปิด การแสดงผลตารางข้อมูลสรุป?>
		</td>
	<?php
			}//ปิด if-else ตรวจสอบการเลือกวันที่
	?>
	</tr>
</table>

</div>

