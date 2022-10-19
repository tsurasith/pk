<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.1 รายงานการเข้าเรียนสายของนักเรียน<br/>แบบรายชื่อ [รายภาคเรียน]</strong></font></span></td>
       <td >
		<?php
			$_error = 1;
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_learn/reportSemesterName&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_learn/reportSemesterName&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_learn/reportSemesterName&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_learn/reportSemesterName&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form action="" method="post">
		<font color="#000000" size="2"  >
		เลือกระดับชั้น
		  	<select name="roomID" class="inputboxUpdate">
				<option value=""></option>
				<option value="3/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/1"?"selected":""?>> มัธยมศึกษาปีที่ 1 </option>
				<option value="3/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/2"?"selected":""?>> มัธยมศึกษาปีที่ 2 </option>
				<option value="3/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/3"?"selected":""?>> มัธยมศึกษาปีที่ 3 </option>
				<option value="4/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/1"?"selected":""?>> มัธยมศึกษาปีที่ 4 </option>
				<option value="4/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/2"?"selected":""?>> มัธยมศึกษาปีที่ 5 </option>
				<option value="4/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/3"?"selected":""?>> มัธยมศึกษาปีที่ 6 </option>
				<option value="all" <?=isset($_POST['roomID'])&&$_POST['roomID']=="all"?"selected":""?>> ทั้งโรงเรียน </option>
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
  $xlevel;
  $xyearth;
  if($_POST['roomID'] != "all")
  {
  	$xlevel = substr($_POST['roomID'],0,1);;
	$xyearth = substr($_POST['roomID'],2,1);
  }
  ?>

  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%" >
    <tr>
	<?php
		if(isset($_POST['search']) && $_POST['roomID'] == "")
		{
			echo "<td align='center'><br/><br/><font color='red'>กรุณาเลือกระดับชั้นที่ต้องการทราบข้อมูลก่อน !</font></td></tr>";
		}
		else if(isset($_POST['search']))
		{
			$sqlStudent = "";
			if($_POST['roomID'] != "all")
			{
				$sqlStudent = "select students.id,students.prefix,students.firstname,students.lastname,p_village,students.xyearth,students.xlevel,students.room,students.studstatus ,
								  count(timecheck_id) as late
								from students  left outer join student_learn on students.id = student_learn.student_id
								where timecheck_id = '02'
									  and xyearth = '" . $xyearth . "' and xlevel = '" . $xlevel ."' and xedbe = '" . $acadyear . "'
									  and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' ";
				if($_POST['studstatus']=="1,2") $sqlStudent .= "and studstatus in (1,2) ";
				$sqlStudent .= " group by student_id order by late desc,room,sex,id";
			}
			else
			{
				$sqlStudent = "select students.id,students.prefix,students.firstname,students.lastname,p_village,students.xyearth,students.xlevel,students.room,students.studstatus ,
								  count(timecheck_id) as late
								from students  left outer join student_learn on students.id = student_learn.student_id
								where xedbe = '" . $acadyear . "' and timecheck_id = '02'
									  and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' ";
				if($_POST['studstatus']=="1,2") $sqlStudent .= "and studstatus in (1,2) ";
				$sqlStudent .= " group by student_id order by late desc,xlevel,xyearth,room,sex,id";			
			}
			$resStudent = mysql_query($sqlStudent);
			$ordinal = 1;
			$totalRows = mysql_num_rows($resStudent);
			if($totalRows == 0)
			{
				echo "<td align='center'><font color='red'>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</font></td></tr>";
				$error = 0;
			}
			else{
	?>	 
      <th colspan="11" align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>
        รายงานการเข้าห้องเรียน <b><u>สาย</u></b> นักเรียนชั้นมัธยมศึกษาปีที่
        <?=displayXyear($_POST['roomID']); ?>
        <br/>
        ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
	  </th>
    </tr>
    <tr> 
		<td class="key" width="50px" align="center" >ลำดับ</td>
      	<td class="key" width="80px" align="center" >เลขประจำตัว</td>
      	<td class="key" width="230px" align="center" >ชื่อ - นามสกุล</td>
		<td class="key" align="center" width="60px" >ห้อง</td>
		<td class="key" width="80px"  align="center" >สถานภาพ<br/>ปัจจุบัน</td>
		<td class="key" align="center" width="100px">จำนวนครั้ง<br />ที่สาย</td>
		<td class="key" align="center">หมู่บ้านที่อาศัย</td>
    </tr>
	<? $ordinal = 1; ?>
	<? while($dat = mysql_fetch_assoc($resStudent)) { ?>
	<tr>
		<td align="center"><?=$ordinal++?></td>
		<td align="center"><?=$dat['id']?></td>
		<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
		<td align="center"><?=displayRoomTable($dat['xlevel'] , $dat['xyearth']) . "/" .$dat['room']?></td>
		<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
		<td align="center"><?=$dat['late']?></td>
		<td><?=$dat['p_village']?></td>
	</tr>
<?	} mysql_free_result($resStudent); //end while
  }//ปิด if-else ตรวจสอบข้อมูลในฐานข้อมูล
}//ปิด if-else ตรวจสอบการเลือกวันที่
?>
</table>

</div>

