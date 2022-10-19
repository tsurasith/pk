<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_tcss/index&content=sdq"><img src="../images/tcss.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">TCSS</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.2 รายงานติดตามการประเมิน (ตัวเลขรายห้อง)</strong></font></span></td>
      <td >
		<?  if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_tcss/sdq_status&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_tcss/sdq_status&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_tcss/sdq_status&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_tcss/sdq_status&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<br/> 
	  </td>
    </tr>
  </table>
<?php
	$_sqlCheck = "select xlevel,xyearth,room,
					  sum(if(b.status = 0,b.status,null)+1) as b0,
					  sum(if(b.status = 1,b.status,null)) as b1,
					  sum(if(c.status = 0,c.status,null)+1) as c0,
					  sum(if(c.status = 1,c.status,null)) as c1,
					  sum(if(d.status = 0,d.status,null)+1) as d0,
					  sum(if(d.status = 1,d.status,null)) as d1
					from students a left outer join sdq_student b
					  on a.id = b.student_id
					  join sdq_parent c on a.id = c.student_id
					  join sdq_teacher d on a.id = d.student_id
					where xedbe = '" . $acadyear . "'
					  and b.acadyear = '" . $acadyear . "' and b.semester = '". $acadsemester . "'
					  and c.acadyear = '" . $acadyear . "' and c.semester = '". $acadsemester . "'
					  and d.acadyear = '" . $acadyear . "' and d.semester = '". $acadsemester . "'
					group by xlevel,xyearth,room
					order by xlevel,xyearth,room";
	$_res = mysql_query($_sqlCheck);
	if(mysql_num_rows($_res)>0)
	{
?>
		<table width="100%" align="center" class="admintable">
			<tr>
				<th align="center">
					
					<img src="../images/school_logo.gif" width="120px"><br/>
					สรุปผลการประเมินตนเอง (SDQ)<br/>
					โรงเรียนโป่งนกประชาสามัคคี<br/>
					ประจำภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
			  </th>
			</tr>
			<tr>
				<td align="center">
					<table width="500px" align="center" class="admintable">
						<tr align="center">
							<td rowspan="2" valign="middle" width="120px" class="key">ห้อง</td>
							<td colspan="2" class="key">นักเรียนประเมิน</td>
							<td colspan="2" class="key">ผู้ปกครองประเมิน</td>
							<td colspan="2" class="key">ครูที่ปรึกษาประเมิน</td>
						</tr>
						<tr align="center">
							<td class="key"><img src='../images/delete.png' alt='ยังไม่ได้ประเมิน' /></td><td align="center" class="key"><img src="../images/ball_green.png" alt="ประเมินแล้ว"/></td>
							<td class="key"><img src='../images/delete.png' alt='ยังไม่ได้ประเมิน' /></td><td align="center" class="key"><img src="../images/ball_green.png" alt="ประเมินแล้ว"/></td>
							<td class="key"><img src='../images/delete.png' alt='ยังไม่ได้ประเมิน' /></td><td align="center" class="key"><img src="../images/ball_green.png" alt="ประเมินแล้ว"/></td>
						</tr>
						<? $_b0 = 0; $_c0 = 0; $_d0 = 0; ?>
						<? while($_dat = mysql_fetch_assoc($_res)){ ?>
						<tr bgcolor='<?=($_i%2==0?"#FFFFFF":"#FAF9FB")?>'>
							<td align='center'><?=($_dat['xlevel']==4?$_dat['xyearth']+3:$_dat['xyearth']) . "/" . $_dat['room']?></td>
							<td align='right'><font color='red' size='4'><?=$_dat['b0']==0?"-":$_dat['b0']?></font></td>
							<td align='right'><font color='green' size='4'><?=$_dat['b1']==0?"-":$_dat['b1']?></font></td>
							<td align='right'><font color='red' size='4'><?=$_dat['c0']==0?"-":$_dat['c0']?></font></td>
							<td align='right'><font color='green' size='4'><?=$_dat['c1']==0?"-":$_dat['c1']?></font></td>
							<td align='right'><font color='red' size='4'><?=$_dat['d0']==0?"-":$_dat['d0']?></font></td>
							<td align='right'><font color='green' size='4'><?=$_dat['d1']==0?"-":$_dat['d1']?></font></td>
						</tr>
						<? $_b0 += $_dat['b0']; $_c0 += $_dat['c0']; $_d0 += $_dat['d0']; ?>
						<? } //end while ?>
						<tr>
							<td align='center' class="key"><b>รวม</b></td>
							<td align='right' class="key"><font color='red' size='4'><?=number_format($_b0,0,'.',',')?></font></td>
							<td align='right' class="key"><font color='green' size='4'></font></td>
							<td align='right' class="key"><font color='red' size='4'><?=number_format($_c0,0,'.',',')?></font></td>
							<td align='right' class="key"><font color='green' size='4'></font></td>
							<td align='right' class="key"><font color='red' size='4'><?=number_format($_d0,0,'.',',')?></font></td>
							<td align='right' class="key"><font color='green' size='4'></font></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
<?php
	} // end if
	else
	{	
?>
		<table width="100%" align="center" class="admintable">
			<tr>
				<td align="center"><font color="#FF0000" size="2"><br/><br/>ยังไม่มีการสร้างงานประเมิน SDQ ในภาคเรียนนี้</font></td>
			</tr>
		</table>
<?php
	} //end else
?>
</div>

