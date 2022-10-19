
<div id="content">

  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr>
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td width="350px"><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
          <span class="normal"><font color="#0066FF"><strong>1.1 รายงานแสดงรายละเอียดในแต่ละวัน</strong></font></span></td>
      <td ><?php
			$_error = 1;
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
        ปีการศึกษา
        <?php  
					echo "<a href=\"index.php?option=module_800/reportDetail&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportDetail&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
        ภาคเรียนที่
        <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_800/reportDetail&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_800/reportDetail&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
      </td>
    </tr>
  </table>

  <?php
		$sql = "select a.student_id,a.check_date,b.check_id
				from student_800 AS a right join ref_timecheck as b
				on a.timecheck_id = b.check_id
				where a.student_id =  '" . $_SESSION['username'] . "' and acadyear = '" . $acadyear . "' 
					and acadsemester = '" . $acadsemester . "' order by a.check_date";
		$result = mysql_query($sql);
		showData($result,$_SESSION['username']);
  ?>

  <?php
  	function showData($result,$s_id){
	$sqlStudent = "select id,prefix,firstname,lastname,xlevel,xyearth,room from students where id = '" . $s_id . "'";
	$resStudent = mysql_query($sqlStudent);
	$datStudent = mysql_fetch_assoc($resStudent);	
  ?>
  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%">
	<tr>
		<td align="center" width="55px" class="key">ลำดับที่</td>
		<td align="center" width="155px" class="key">วันที่เช็ค</td>
		<td align="center" width="80px" class="key">สถานะ</td>
		<td align="center" class="key" >ข้อมูลสรุป</td>
	</tr>
	<tr>
	 <?php
		if(mysql_num_rows($result) > 0)
		{
			$i = 1;
			while($dat = mysql_fetch_assoc($result))
			{
				echo "<tr>";
				echo "<td align=\"center\">" . $i++ . "</td>";
				echo "<td align=\"center\">" . displayDate($dat['check_date']) . "</td>";
				echo "<td >" . displayTimecheckColor($dat['check_id']) . "</td>";	
				if($i == 2)
				{
					echo "<td valign=\"top\" rowspan=\"" . mysql_num_rows($result) . "\">" . resultData($s_id,$datStudent) ."</td>";
				}
				echo "</tr>";
			}
		}else
		{
			echo "<tr><td colspan=\"3\" align='center'>";
			echo "<font color='red'>ไม่มีรายการบันทึกข้อมูลรายวัน<br/>ในภาคเรียนและปีการศึกษานี้</font>";
			echo "</td>";
			echo "<td valign=\"top\" >" . resultData($s_id,$datStudent) ."</td></tr>";
		}
	 ?>
	</tr>
  </table>
  <?php
  } // end function showData($result)
  ?>

</div>
<?php
	function resultData($studentID,$datStudent)
	{
		$_sql = "select acadyear,acadsemester,
					  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
					  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
					  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
					  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
					  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
					  count(class_id) as sum
					from  student_800
					where student_id = '" . $studentID . "'
					group by acadsemester,acadyear,student_id order by acadyear,acadsemester ";
		$_result = mysql_query($_sql);
		$view = "";
		$view = $view . "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"1\" bgcolor=\"#FFEEDD\">";
		$view = $view . "<tr bgcolor=\"#FFFFFF\"><td colspan=\"7\">";
		$view = $view . "<img src='../images/studphoto/id" . $datStudent['id'] . ".jpg' width='160px' style='border:1px solid #000'; /><br/>";
		$view = $view . "เลขประจำตัว : <b>" . $datStudent['id'] . "</b><br/>";
		$view = $view . "ชื่อ - สกุล : <b>" . $datStudent['prefix'] . $datStudent['firstname'] . ' '. $datStudent['lastname'] . "</br>";
		$view = $view . "<br/>---------------------------";
		$view = $view . "<br/>ประวัติการเข้าร่วมกิจกรรมหน้าเสาธง";
		$view = $view . "</td></tr>";
		$view = $view . "<tr bgcolor=\"#FFFFFF\">";
		$view = $view . "<th align=\"center\">ปีการศึกษา/ภาคเรียน</th><th width=\"40px\" align=\"center\">มา</th><th width=\"40px\" align=\"center\">กิจกรรม</th><th width=\"40px\" align=\"center\">สาย</th><th width=\"40px\" align=\"center\">ลา</th><th width=\"40px\" align=\"center\">ขาด</th><th align=\"center\" >รวม</th></tr>";
		while($_dat = mysql_fetch_assoc($_result))
		{
			$view = $view . "<tr bgcolor='white'>";
			$view = $view . "<td align=\"center\">" . $_dat['acadyear'] . '/' . $_dat['acadsemester'] . "</td>";
			$view = $view . "<td align=\"right\">" . displayText($_dat['a']) . "</td>";
			$view = $view . "<td align=\"right\">" . displayText($_dat['b']) . "</td>";
			$view = $view . "<td align=\"right\">" . displayText($_dat['c']) . "</td>";
			$view = $view . "<td align=\"right\">" . displayText($_dat['d']) . "</td>";
			$view = $view . "<td align=\"right\">" . displayText($_dat['e']) . "</td>";
			$view = $view . "<td align=\"right\">" . displayText($_dat['sum']) . "</td>";
			$view = $view . "</tr>";
		}
		$view = $view . "</table>";
		mysql_free_result($_result);
		return $view ;
	}

?>

