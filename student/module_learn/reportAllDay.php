<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.2 รายงานประวัติการเข้าห้องเรียน</strong></font></span></td>
      <td >
	  	 ปีการศึกษา
        <? if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
					echo "<a href=\"index.php?option=module_learn/reportAllDay&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_learn/reportAllDay&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
        ภาคเรียนที่ 
        <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_learn/reportAllDay&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_learn/reportAllDay&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>	<br/>
		 <font  size="2" color="#000000">
		 </font>
	  </td>
    </tr>
  </table>


<?	$_sql = "select check_date,
			  sum(if(period = 1,timecheck_id,null)) as p1,
			  sum(if(period = 2,timecheck_id,null)) as p2,
			  sum(if(period = 3,timecheck_id,null)) as p3,
			  sum(if(period = 4,timecheck_id,null)) as p4,
			  sum(if(period = 5,timecheck_id,null)) as p5,
			  sum(if(period = 6,timecheck_id,null)) as p6,
			  sum(if(period = 7,timecheck_id,null)) as p7,
			  sum(if(period = 8,timecheck_id,null)) as p8
			from student_learn
			where acadyear = '" . $acadyear . "' and acadsemester = '". $acadsemester . "' and student_id = '" . $_SESSION['username'] . "'
			group by check_date
			order by check_date ";				
	$_res = mysql_query($_sql); ?>
	<? if(@mysql_num_rows($_res)>0) { ?>
			<table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center">
			<tr>
			  <td colspan="7" align="right" valign="top">
			  	<b>โรงเรียนโป่งนกประชาสามัคคี</b>ิ<br/>
				รายงานการเข้าชั้นเรียนของนักเรียน	<br/>
				ภาคเรียนที่ <b><?=$acadsemester?></b> ปีการศึกษา <b><?=$acadyear?></b><br/>
				<b>เลขประจำตัว : </b><?=$_SESSION['username']?><br/>
				<b>ชื่อ-สกุล : </b> <?=$_SESSION['name']?>
			  </td>
			  <td colspan="3" class="key" valign="top" align="center">
				<img src="../images/studphoto/id<?=$_SESSION['username']?>.jpg" width="130px"><br/>	
			  </td>
			</tr>
			<tr> 
				<td class="key" width="60px" align="center" rowspan="2">ลำดับที่</td>
				<td class="key" width="230px"  align="center" rowspan="2">วัน/เดือน/ปี</td>
				<td class="key" align="center" colspan="8">คาบเรียนที่</td>
			</tr>
			<tr align="center">
				<td class="key" width="50px">1</td>
				<td class="key" width="50px">2</td>
				<td class="key" width="50px">3</td>
				<td class="key" width="50px">4</td>
				<td class="key" width="50px">5</td>
				<td class="key" width="50px">6</td>
				<td class="key" width="50px">7</td>
				<td class="key" width="50px">8</td>
			</tr>
			<? $_i = 1; ?>
			<? while($_dat = mysql_fetch_assoc($_res)){ ?>
			<tr>
				<td align="center"><?=$_i++?></td>
				<td align="center"><?=displayDate($_dat['check_date'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p1'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p2'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p3'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p4'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p5'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p6'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p7'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p8'])?></td>
			</tr>
			<? } mysql_free_result($_res); //end while ?>
		 </table>
<?	} else { //end chekc_rows	 ?>
		<table width="100%" align="center">
			<tr>
				<td width="40px">&nbsp;</td>
				<td><font color="#FF0000" size="3"><br/><br/>ไม่พบข้อมูลที่ค้นตามเงื่อนไข กรุณาทดลองใหม่อีกครั้ง</font></td>
			</tr>
		</table>
<?	} //end else check rows ?>
</div>
