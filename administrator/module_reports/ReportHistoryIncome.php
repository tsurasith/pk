

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_reports/index">
			<img src="../images/chart.png" alt="" width="48px" border="0" />
		</a>
	  </td>
      <td><strong><font color="#990000" size="4">ระบบรายงาน/สถิติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.6.4 สารสนเทศนักเรียนตามรายได้ของผู้ปกครองนักเรียน</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_reports/ReportHistoryIncome&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_reports/ReportHistoryIncome&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		<br/>
		<font color="#000000" size="2"  >
		<form method="post">
			รายได้ของ 
			<select name="income" class="inputboxUpdate">
				<option value=""></option>
				<option value="f_earn" <?=isset($_POST['income'])&&$_POST['income']=="f_earn"?"selected":""?>>บิดา</option>
				<option value="m_earn" <?=isset($_POST['income'])&&$_POST['income']=="m_earn"?"selected":""?>>มารดา</option>
				<option value="a_earn" <?=isset($_POST['income'])&&$_POST['income']=="a_earn"?"selected":""?>>ผู้ปกครอง</option>
			</select>
			<input type="submit" value="เรียกดู" name="search" class="button" /><br/>
			<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		</form>
		</font>
	  </td>
    </tr>
  </table>  
<? if(isset($_POST['search']) && $_POST['income'] == "") { ?>
	<? echo "<br/><br/><center><font color='red'>กรุณาเลือก รายได้บิดา/มารดา/ผู้ปกครอง ที่ต้องการทราบข้อมูลก่อน</font></center>";} ?>	
<? if(isset($_POST['search']) && $_POST['income'] != ""){ ?>
	<? $_sql = "select xlevel,xyearth,
				  sum(if(".$_POST['income']."<30000,1,0)) as '30k',
				  sum(if(".$_POST['income'].">=30000 and ".$_POST['income']." <=50000,1,0)) as '50k',
				  sum(if(".$_POST['income'].">50000  and ".$_POST['income']." <= 90000,1,0)) as '90k',
				  sum(if(".$_POST['income'].">90000  and ".$_POST['income']." <= 120000,1,0)) as '120k',
				  sum(if(".$_POST['income'].">120000 and ".$_POST['income']." <= 150000,1,0)) as '150k',
				  sum(if(".$_POST['income'].">150000 and ".$_POST['income']." <= 200000,1,0)) as '200k',
				  sum(if(".$_POST['income'].">200000,1,0)) as '201k',
				  sum(if(".$_POST['income']." is null,1,0)) as 'null',
				  count(*) as 'total'
				from students where xedbe = '" . $acadyear . "' "; ?>
	<? $_sql .= ($_POST['studstatus']=="1,2"?" and studstatus in (1,2) ":"") ; ?>
	<? $_sql .=	" group by xlevel,xyearth order by 1,2 "; ?>	
	<? $_result = mysql_query($_sql); ?>
	<? $_30k=0; $_50k=0; $_90k=0; $_120k=0; $_150k=0; $_200k=0; $_201k=0; $_null=0; $_t=0; ?>
	<? if(mysql_num_rows($_result)>0){ ?>		
		<table class="admintable" width="100%" align="center" >
			<tr>
				<th colspan="2" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>
					สารสนเทศรายได้ของ <?=substr($_POST['income'],0,1)=="a"?"ผู้ปกครอง":(substr($_POST['income'],0,1)=="f"?"บิดา":"มารดา")?>นักเรียน<br/>
					ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
					<br/>
				</th>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<table align="center" >
						<tr>
							<td class="key" rowspan="2" align="center" width="160px">ระดับชั้น</td>
							<td class="key" colspan="8" align="center">รายได้ผู้ปกครอง (บาท)</td>
							<td class="key" rowspan="2" align="center" width="100px">รวม</td>
						</tr>
						<tr>
							<td class="key" align="center" width="60px">น้อยกว่า 30k</td>
							<td class="key" align="center" width="60px">30k - 50k</td>
							<td class="key" align="center" width="60px">50k - 90k</td>
							<td class="key" align="center" width="60px">90k - 120k</td>
							<td class="key" align="center" width="60px">120k - 150k</td>
							<td class="key" align="center" width="60px">150k - 200k</td>
							<td class="key" align="center" width="60px">มากกว่า 200k</td>
							<td class="key" align="center" width="60px">ไม่ระบุ</td>
						</tr>
							<? while($_dat = mysql_fetch_assoc($_result)) { ?>
								<tr>
									<td align="left" style="padding-left:15px;">ชั้นมัธยมศึกษาปีที่ <?=displayXyear($_dat['xlevel'].'/'.$_dat['xyearth'])?></td>
									<td align="right" style="padding-right:15px;"><?=$_dat['30k']==0?"-":number_format($_dat['30k'],0,'',',')?></td>
									<td align="right" style="padding-right:15px;"><?=$_dat['50k']==0?"-":number_format($_dat['50k'],0,'',',')?></td>
									<td align="right" style="padding-right:15px;"><?=$_dat['90k']==0?"-":number_format($_dat['90k'],0,'',',')?></td>
									<td align="right" style="padding-right:15px;"><?=$_dat['120k']==0?"-":number_format($_dat['120k'],0,'',',')?></td>
									<td align="right" style="padding-right:15px;"><?=$_dat['150k']==0?"-":number_format($_dat['150k'],0,'',',')?></td>
									<td align="right" style="padding-right:15px;"><?=$_dat['200k']==0?"-":number_format($_dat['200k'],0,'',',')?></td>
									<td align="right" style="padding-right:15px;"><?=$_dat['201k']==0?"-":number_format($_dat['201k'],0,'',',')?></td>
									<td align="right" style="padding-right:15px;"><?=$_dat['null']==0?"-":number_format($_dat['null'],0,'',',')?></td>
									<td align="right" style="padding-right:15px;"><?=$_dat['total']==0?"-":number_format($_dat['total'],0,'',',')?></td>
								</tr>
								<? $_30k+=$_dat['30k']; $_50k+=$_dat['50k']; $_90k+=$_dat['90k']; 
								   $_120k+=$_dat['120k']; $_150k+=$_dat['150k']; $_200k+=$_dat['200k']; 
								   $_201k+=$_dat['201k']; $_null+=$_dat['null']; $_t += $_dat['total']; ?>
							<? } ?>
						<tr>
							<td class="key" align="center">รวม</td>
							<td class="key" align="right" style="padding-right:15px;"><?=number_format($_30k,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:15px;"><?=number_format($_50k,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:15px;"><?=number_format($_90k,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:15px;"><?=number_format($_120k,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:15px;"><?=number_format($_150k,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:15px;"><?=number_format($_200k,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:15px;"><?=number_format($_201k,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:15px;"><?=number_format($_null,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:15px;"><?=number_format($_t,0,'',',')?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	<? } else {echo "<br/><br/><center><font color='red'>ไม่พบข้อมูลในรายการที่ท่านเลือก</font></center>";} ?>
<? } //end if select data?>
</div>

