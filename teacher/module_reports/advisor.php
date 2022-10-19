
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_reports/index">
			<img src="../images/chart.png" alt="" width="48" height="48" border="0"/>
		</a>
	  </td>
      <td><strong><font color="#990000" size="4">ระบบรายงาน/สถิติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.1.2 ทำเนียบครูที่ปรึกษา</strong></font></span></td>
      <td align="right">
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_reports/advisor&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_reports/advisor&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_reports/advisor&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_reports/advisor&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<br/>
	  </td>
    </tr>
  </table>
<?php
	$_sql = "(select a.room_id,a.teacher_id,b.prefix,b.firstname,b.lastname,b.nickname,b.t_mobile,1 as priority
				from rooms a left outer join teachers b on a.teacher_id = b.teaccode
				where a.acadsemester = '" . $acadsemester . "' and acadyear = '" . $acadyear . "')
			union
			(select a.room_id,a.teacher_id2,b.prefix,b.firstname,b.lastname,b.nickname,b.t_mobile,2 as priority
							from rooms a left outer join teachers b on a.teacher_id2 = b.teaccode
							where a.acadsemester = '" . $acadsemester . "' and acadyear = '" . $acadyear . "' and a.teacher_id2 != '')
			order by room_id,priority";
	$_result = mysql_query($_sql);
	if(mysql_num_rows($_result)>0)
	{
?>
		<table class="admintable" width="100%" align="center" >
			<tr>
				<th colspan="4" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>ทำเนียบครูที่ปรึกษา
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
						echo "<td align='center'  width='154px'  valign='bottom'>";
						echo "<img src='../images/teacphoto/TC" . $_dat['teacher_id']. ".jpg' width='140px' height='190px' style='border:1px #000 solid;' alt='รูปครูที่ปรึกษา' /><br/>";
						echo "ห้อง " . getFullRoomFormat($_dat['room_id']) . " - " . ($_dat['nickname']!=""?"ครู".$_dat['nickname']:"???") . "<br/>";
						echo $_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname'] . "<br/>";
						echo "มือถือ : " . ($_dat['t_mobile']!=""?$_dat['t_mobile']:"0xx xxx xxxx");
						echo "</td>";
						if($_i%4==0) echo "</tr>";
						$_i++;
					} // end-while
				} // end-for
			?>
		</table> <? }  //end - if
	else { echo "<br/><br/><center><font color='red'>ยังไม่มีการจัดการห้องเรียนในภาคเรียนนี้</font></center>";   }?>
	
</div>
