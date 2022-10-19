
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_reports/index">
			<img src="../images/chart.png" alt="" width="48" height="48" border="0"/>
		</a>
	  </td>
      <td><strong><font color="#990000" size="4">ระบบรายงาน/สถิติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.2.1 รายชื่อหัวหน้าชั้น</strong></font></span></td>
      <td align="right">
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_reports/roomLeaderList&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_reports/roomLeaderList&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		 ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_reports/roomLeaderList&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_reports/roomLeaderList&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<br/>
	  </td>
    </tr>
  </table>
<? $_sql = "select room_id,student_id from rooms where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' order by room_id"; ?>
<? $_result = mysql_query($_sql); ?>
<? if(mysql_num_rows($_result)>0) { ?>
		<div align="center">
		<table class="admintable" align="center" >
			<tr>
				<th colspan="4" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>รายชื่อหัวหน้าห้อง
					<br/>ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
					<br/>
				</th>
			</tr>
			<tr>
				<td class="key" width="45px" align="center">ที่</td>
				<td class="key" width="90px" align="center">ห้อง</td>
				<td class="key" width="250px" align="center">หัวหน้าห้อง</td>
				<td class="key" width="90px" align="center">ชื่อเล่น</td>
			</tr>
			<? $_i = 1;?>
			<?  while($_dat = mysql_fetch_assoc($_result)) { ?>
				<tr>
				<? $_student = displayStudent($_dat['student_id'],$acadyear); ?>
				<td align="center"><?=$_i++?></td>
				<td align="center"><?=getFullRoomFormat($_dat['room_id']) ?></td>
				<td align="left"><?=$_student['prefix']==""?"-":$_student['prefix'] . $_student['firstname'] . ' ' . $_student['lastname']?></td>
				<td align="left"><?=$_student['nickname']==""?"-":$_student['nickname']?></td>
				</tr>
			<? } // end-while ?>
		</table>
        </div> <? }  //end - if
		
	else { echo "<font color='red'><center><br/>ไม่มีข้อมูลในภาคเรียนที่ " .$acadsemester." ปีการศึกษา " .$acadyear."</center></font>"; }?>
	
</div>
<?
	function displayStudent($_value,$_year){
		$_sql = "select id,prefix,firstname,lastname,nickname,studstatus,sex,p_village from students where id = '" . $_value . "' and xedbe = '" . $_year . "' ";
		$_dat = mysql_fetch_assoc(mysql_query($_sql));
		return $_dat;
	}
	function displayStatus($id)
	{
		switch ($id) {
			case 0 :  return "<font color='red'><b>ออก</b></font>"; break;
			case 1 :  return "ปกติ"; break;
			case 2 :  return "<b>สำเร็จการศึกษา</b>"; break;
			case 3 :  return "<font color='red'><b>แขวนลอย</b></font>"; break;
			case 4 :  return "<font color='darkorange'><b>พักการเรียน</b></font>"; break;
			case 5 :  return "<font color='blue'><b>ย้ายสถานศึกษา</b></font>"; break;
			case 9 :  return "<font color='red'><b>เสียชีวิต</b></font>"; break;
			default : return " - ไม่ทราบ - ";
		}	
	}
?>