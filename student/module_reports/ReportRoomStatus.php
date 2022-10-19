<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_reports/index">
			<img src="../images/chart.png" alt="" width="48px" border="0" />
		</a>
	  </td>
      <td ><strong><font color="#990000" size="4">ระบบรายงาน/สถิติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.3.3 รายงานแสดงสถานภาพนักเรียนในแต่ละปีการศึกษา</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_reports/ReportRoomStatus&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_reports/ReportRoomStatus&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		<br/>
	  </td>
    </tr>
  </table>
<?php
	$_sql = "select studstatus,
				  sum(if(xlevel=3 and xyearth=1 and sex = 1 ,1,0)) as 'm1',
				  sum(if(xlevel=3 and xyearth=1 and sex = 2 ,1,0)) as 'f1',
				  sum(if(xlevel=3 and xyearth=2 and sex = 1 ,1,0)) as 'm2',
				  sum(if(xlevel=3 and xyearth=2 and sex = 2 ,1,0)) as 'f2',
				  sum(if(xlevel=3 and xyearth=3 and sex = 1 ,1,0)) as 'm3',
				  sum(if(xlevel=3 and xyearth=3 and sex = 2 ,1,0)) as 'f3',
				  sum(if(xlevel=4 and xyearth=1 and sex = 1 ,1,0)) as 'm4',
				  sum(if(xlevel=4 and xyearth=1 and sex = 2 ,1,0)) as 'f4',
				  sum(if(xlevel=4 and xyearth=2 and sex = 1 ,1,0)) as 'm5',
				  sum(if(xlevel=4 and xyearth=2 and sex = 2 ,1,0)) as 'f5',
				  sum(if(xlevel=4 and xyearth=3 and sex = 1 ,1,0)) as 'm6',
				  sum(if(xlevel=4 and xyearth=3 and sex = 2 ,1,0)) as 'f6',
				  count(*) as 'total'
				from students where xedbe = '" . $acadyear . "'
				group by studstatus order by count(*) desc";
	$_result = mysql_query($_sql);
	if(mysql_num_rows($_result)>0) { ?>
		<table class="admintable" width="100%" align="center" >
			<tr>
				<th align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>
					สารสนเทศจำนวนนักเรียนจำแนกตามสถานภาพ เพศและระดับชั้น<br/>
					ปีการศึกษา <?=$acadyear?>
				</th>
			</tr>
			<tr>
				<td align="center">
					<table class="admintable">
						<tr>
							<td rowspan="2" align="center" width="100px" class="key">สถานภาพ</td>
							<td colspan="2" align="center" class="key" width="100px">ม.1</td>
							<td colspan="2" align="center" class="key" width="100px">ม.2</td>
							<td colspan="2" align="center" class="key" width="100px">ม.3</td>
							<td colspan="2" align="center" class="key" width="100px">ม.4</td>
							<td colspan="2" align="center" class="key" width="100px">ม.5</td>
							<td colspan="2" align="center" class="key" width="100px">ม.6</td>
							<td rowspan="2" align="center" class="key" width="80px">รวม</td>
						</tr>
						<tr>
							<td align="center" class="key">ชาย</td>
							<td align="center" class="key">หญิง</td>
							<td align="center" class="key">ชาย</td>
							<td align="center" class="key">หญิง</td>
							<td align="center" class="key">ชาย</td>
							<td align="center" class="key">หญิง</td>
							<td align="center" class="key">ชาย</td>
							<td align="center" class="key">หญิง</td>
							<td align="center" class="key">ชาย</td>
							<td align="center" class="key">หญิง</td>
							<td align="center" class="key">ชาย</td>
							<td align="center" class="key">หญิง</td>
						</tr>
						<? $_m1=0; $_f1=0; $_m2=0; $_f2=0; $_m3=0; $_f3=0; 
						   $_m4=0; $_f4=0; $_m5=0; $_f5=0; $_m6=0; $_f6=0; $_count=0; ?>
						<? while($_dat = mysql_fetch_assoc($_result)){ ?>
						<tr>
							<td align="left"><?=displayStudentStatusColor($_dat['studstatus'])?></td>
							<td align="right" style="padding-right:5px"><?=$_dat['m1']>0?$_dat['m1']:"-"?></td>
							<td align="right" style="padding-right:5px"><?=$_dat['f1']>0?$_dat['f1']:"-"?></td>
							<td align="right" style="padding-right:5px"><?=$_dat['m2']>0?$_dat['m2']:"-"?></td>
							<td align="right" style="padding-right:5px"><?=$_dat['f2']>0?$_dat['f2']:"-"?></td>
							<td align="right" style="padding-right:5px"><?=$_dat['m3']>0?$_dat['m3']:"-"?></td>
							<td align="right" style="padding-right:5px"><?=$_dat['f3']>0?$_dat['f3']:"-"?></td>
							<td align="right" style="padding-right:5px"><?=$_dat['m4']>0?$_dat['m4']:"-"?></td>
							<td align="right" style="padding-right:5px"><?=$_dat['f4']>0?$_dat['f4']:"-"?></td>
							<td align="right" style="padding-right:5px"><?=$_dat['m5']>0?$_dat['m5']:"-"?></td>
							<td align="right" style="padding-right:5px"><?=$_dat['f5']>0?$_dat['f5']:"-"?></td>
							<td align="right" style="padding-right:5px"><?=$_dat['m6']>0?$_dat['m6']:"-"?></td>
							<td align="right" style="padding-right:5px"><?=$_dat['f6']>0?$_dat['f6']:"-"?></td>
							<td align="right" style="padding-right:5px"><?=number_format($_dat['total'],0,'',',')?></td>
						<? $_m1+=$_dat['m1']; $_f1+=$_dat['f1']; $_m2+=$_dat['m2']; $_f2+=$_dat['f2']; $_m3+=$_dat['m3']; $_f3+=$_dat['f3']; 
						   $_m4+=$_dat['m4']; $_f4+=$_dat['f4']; $_m5+=$_dat['m5']; $_f5+=$_dat['f5']; $_m6+=$_dat['m6']; $_f6+=$_dat['f6']; $_count+=$_dat['total'];?>
						</tr>
						<? } //end while?>
						<tr height="30px">
						<td align="center" class="key"><b>รวม</b></td>
						<td align="right" style="padding-right:5px" class="key"><b><?=number_format($_m1,0,'',',')?></b></td>
						<td align="right" style="padding-right:5px" class="key"><b><?=number_format($_f1,0,'',',')?></b></td>
						<td align="right" style="padding-right:5px" class="key"><b><?=number_format($_m2,0,'',',')?></b></td>
						<td align="right" style="padding-right:5px" class="key"><b><?=number_format($_f2,0,'',',')?></b></td>
						<td align="right" style="padding-right:5px" class="key"><b><?=number_format($_m3,0,'',',')?></b></td>
						<td align="right" style="padding-right:5px" class="key"><b><?=number_format($_f3,0,'',',')?></b></td>
						<td align="right" style="padding-right:5px" class="key"><b><?=number_format($_m4,0,'',',')?></b></td>
						<td align="right" style="padding-right:5px" class="key"><b><?=number_format($_f4,0,'',',')?></b></td>
						<td align="right" style="padding-right:5px" class="key"><b><?=number_format($_m5,0,'',',')?></b></td>
						<td align="right" style="padding-right:5px" class="key"><b><?=number_format($_f5,0,'',',')?></b></td>
						<td align="right" style="padding-right:5px" class="key"><b><?=number_format($_m6,0,'',',')?></b></td>
						<td align="right" style="padding-right:5px" class="key"><b><?=number_format($_f6,0,'',',')?></b></td>
						<td align="right" style="padding-right:5px" class="key"><b><?=number_format($_count,0,'',',')?></b></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
<?	} else { echo "<br/><br/><center><font color='red'>ยังไม่มีข้อมูลในรายการที่ท่านเลือก</font></center>"; }?>
	
</div>

