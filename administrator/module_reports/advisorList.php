
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_reports/index">
			<img src="../images/chart.png" alt="" width="48" height="48" border="0"/>
		</a>
	  </td>
      <td><strong><font color="#990000" size="4">ระบบรายงาน/สถิติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.1.1 รายชื่อครูที่ปรึกษา</strong></font></span></td>
      <td align="right">
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_reports/advisorList&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_reports/advisorList&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_reports/advisorList&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_reports/advisorList&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<br/>
	  </td>
    </tr>
  </table>
<?php
	$_sql = "select * from rooms
				where acadsemester = '" . $acadsemester . "' and acadyear = '" . $acadyear . "' order by room_id ";
	$_result = mysql_query($_sql);
	if(mysql_num_rows($_result)>0){ ?>
    	<div align="center">
		<table class="admintable" align="center" >
			<tr>
				<th colspan="4" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>รายชื่อครูที่ปรึกษา
					<br/>ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
					<br/>
				</th>
			</tr>
			<tr height="30px">
				<td class="key" align="center" width="40px">ที่</td>
				<td class="key" align="center" width="70px">ห้อง</td>
				<td class="key" align="center" width="250px">ครูที่ปรึกษาคนที่ 1</td>
				<td class="key" align="center" width="250px">ครูที่ปรึกษาคนที่ 2</td>
			</tr>
			<? $_i=1;?>
			<? while($_dat = mysql_fetch_assoc($_result)) { ?>
			<tr>
				<td align="center" valign="top"><?=$_i++?></td>
				<td align="center" valign="top"><?=getFullRoomFormat($_dat['room_id'])?></td>
				<td align="left" style="padding-left:20px;"><?=$_dat['teacher_id']!=""?getTeacher($_dat['teacher_id']):"-"?></td>
				<td align="left" style="padding-left:20px;"><?=$_dat['teacher_id2']!=""?getTeacher($_dat['teacher_id2']):"-"?></td>
			</tr>
			<? } //end while ?>
		</table> 
        </div>
	<? }else{ echo "<br/><br/><center><font color='red'>ยังไม่มีการจัดการห้องเรียนในภาคเรียนนี้</font></center>";   }?>
</div>

