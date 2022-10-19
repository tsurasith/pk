<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_color/index"><img src="../images/color.png" alt="กิจกรรมคณะสี" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">กิจกรรมคณะสี</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.1 แก้ไขข้อมูลนักเรียน</strong></font></span></td>
      <td>
	  				<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_color/updateStudentColorForm&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_color/updateStudentColorForm&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_color/updateStudentColorForm&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_color/updateStudentColorForm&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		</font>
		<br/>
	  </td>
    </tr>
  </table>

	<table align="center" width="100%" class="admintable">
		<tr>
			<th height="36" bgcolor="#FFCCFF" ><font color="#990033" size="4"> &nbsp; เลือกห้องที่้ต้องการแก้ไขข้อมูล</font></th>
		</tr>
		<tr>
			<td align="center">
				<table class="admintable">
         	 	<?php
					$year = $acadyear;
					$semester = $acadsemester;
					$sql = "select replace(room_id,'0','/') as room_id,acadyear,acadsemester from rooms where acadyear = '" . $year . "' and acadsemester = '" . $semester . "' order by room_id";
					$result = mysql_query($sql) or die ('<tr><td>Error - ' . mysql_error() . '</td></tr>');
					$y = mysql_num_rows($result);
					if($y > 0){
						for($_i = 1; $_i <=6 ; $_i++){
							echo "<tr><td class='key' colspan='10' align='left'> ระดับชั้นมัธยมศึกษาปีที่ " . $_i . "</td></tr>";
							echo "<tr>";
							while($dat = mysql_fetch_assoc($result))
							{
								if(substr($dat['room_id'],0,1) == $_i)
								{
									echo "<td width=\"55px\">";
									echo "<a href=\"module_color/studentListFormUpdateColor.php?room=" . $dat['room_id'] . "&acadyear=" . $acadyear . "&acadsemester=". $acadsemester . "\" >";
									echo "ห้อง " . $dat['room_id'];
									echo "</a>";
									echo "</td>";
								}
								else
								{
									$_i++;
									echo "<tr><td class='key' colspan='10' align='left'> ระดับชั้นมัธยมศึกษาปีที่ " . $_i . "</td></tr>";
									echo "<tr>";
									echo "<td width=\"55px\">";
									echo "<a href=\"module_color/studentListFormUpdateColor.php?room=" . $dat['room_id'] . "&acadyear=" . $acadyear . "&acadsemester=". $acadsemester . "\" >";
									echo "ห้อง " . $dat['room_id'];
									echo "</a>";
									echo "</td>";
									
								}
							}
							echo "</tr>";
						}//end for-loop
					}
					else{ echo "<tr><td align='center'><br/><font color='red'>ยังไม่มีข้อมูลเนื่องจากยังไม่มีการจัดห้องเรียนภายในระบบ</font></td></tr>"; }
				?>
				</table>
			</td>
		</tr>
	</table>
	</form>
</div>