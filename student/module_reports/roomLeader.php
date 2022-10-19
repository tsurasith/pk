
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_reports/index">
			<img src="../images/chart.png" alt="" width="48" height="48" border="0"/>
		</a>
	  </td>
      <td><strong><font color="#990000" size="4">ระบบรายงาน/สถิติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.2.2 ทำเนียบหัวหน้าชั้น</strong></font></span></td>
      <td align="right">
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_reports/roomLeader&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_reports/roomLeader&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		 ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_reports/roomLeader&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_reports/roomLeader&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<br/>
	  </td>
    </tr>
  </table>
<? $_sql = "select room_id,student_id from rooms where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' order by room_id"; ?>
<? $_result = mysql_query($_sql); ?>
<? if(mysql_num_rows($_result)>0) { ?>
		<table class="admintable" align="center" >
			<tr>
				<th colspan="4" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>ทำเนียบหัวหน้าห้อง
					<br/>ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
					<br/>
				</th>
			</tr>
			<?php
				for($_i = 1; $_i <= mysql_num_rows($_result);)
				{
					if($_i%4==0 || $_i==1) echo "<tr>";
					while($_dat = mysql_fetch_assoc($_result))
					{
						$_student = displayStudent($_dat['student_id'],$acadyear);
						echo "<td align='center'  width='180px'  valign='bottom'>";
						if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/pk/images/studphoto/id" . $_dat['student_id'] . ".jpg")){ echo "<img src='../images/studphoto/id" . $_dat['student_id']. ".jpg' width='120px' height='160px' alt='หัวหน้าห้อง' style='border:#CC0CC0 solid 1px;' /><br/>";}
						else{echo "<img src='../images/" . ($_student['sex']==1?"_unknown_male":"_unknown_female") . ".png' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/><br/>";}
						echo getFullRoomFormat($_dat['room_id']). " - ";
						echo "ชื่อเล่น : " . ($_student['nickname']==""?"-":$_student['nickname']) . "<br/>";
						echo $_student['prefix'] . $_student['firstname'] . ' ' . $_student['lastname'] ;
						//echo "<br/>สถานภาพ : " . (trim($_student['id'])==""?"-":displayStatus($_student['studstatus']));
						echo "</td>";
						if($_i%4==0) echo "</tr>";
						$_i++;
					} // end-while
				} // end-for
			?>
		</table> <? }  //end - if
	else { echo "<font color='red'><center><br/>ไม่มีข้อมูลในภาคเรียนที่ " .$acadsemester." ปีการศึกษา " .$acadyear."</center></font>"; }?>
	
</div>
<?
	function displayStudent($_value,$_year){
		$_sql = "select id,prefix,firstname,lastname,nickname,studstatus,sex,p_village from students where id = '" . $_value . "' and xedbe = '" . $_year . "' ";
		$_dat = mysql_fetch_assoc(mysql_query($_sql));
		return $_dat;
	}
?>