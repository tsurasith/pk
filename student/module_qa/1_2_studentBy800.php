<div id="content">
<form name="myform" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_qa/index"><img src="../images/qa.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">งานประกันคุณภาพและมาตรฐาน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.2 แสดงการมาเรียนของผู้เรียนแต่ละห้องเรียน (เพิ่มเติม)</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_qa/1_2_studentBy800&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_qa/1_2_studentBy800&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	  	<font color="#000000" size="2"  >
			<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> onclick="document.myform.submit();" />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			 </font>
	   </td>
    </tr>
  </table>
  </form>
<br/>
<? $_sql = "select class_id,
			  sum(if(month(check_date)='05',1,0)) as 'may',
			  sum(if(month(check_date)='06',1,0)) as 'jun',
			  sum(if(month(check_date)='07',1,0)) as 'jul',
			  sum(if(month(check_date)='08',1,0)) as 'aug',
			  sum(if(month(check_date)='09',1,0)) as 'sep',
			  sum(if(month(check_date)='10',1,0)) as 'oct',
			  sum(if(month(check_date)='11',1,0)) as 'nov',
			  sum(if(month(check_date)='12',1,0)) as 'dec',
			  sum(if(month(check_date)='01',1,0)) as 'jan',
			  sum(if(month(check_date)='02',1,0)) as 'feb',
			  sum(if(month(check_date)='03',1,0)) as 'mar',
			  count(check_date) as 'sum'
			from student_800 left outer join students on (student_id = id)
			where acadyear = '" . $acadyear . "' ". ($_POST['studstatus']=="1,2"?" and studstatus in (1,2)":"") . "
				and timecheck_id = 04 and xedbe = '" . $acadyear . "' group by class_id";?>
<? $_result = mysql_query($_sql); ?>
<? if(mysql_num_rows($_result)>0) { ?>
		<table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
			<tr> 
				<th align="center">
					<img src="../images/school_logo.gif" width="120px"><br/><br/>
					แสดงการมาเรียนของผู้เรียนในแต่ละห้องเรียน ปีการศึกษา <?=$acadyear?><br/>
					<? $_resTotal = mysql_query("select count(student_id) as 'total' from student_800 left outer join students on (student_id = id) where acadyear = '" . $acadyear . "' ". ($_POST['studstatus']=="1,2"?" and studstatus in (1,2)":"") . " and xedbe = '" . $acadyear . "' ");?>
					<? $_total = mysql_fetch_assoc($_resTotal); ?>
				</th>
			</tr>
			<tr><th align="left">ข้อมูลพื้นฐาน</th></tr>
			<tr>
				<td>
					<? $_resDateCount = mysql_query("select distinct task_date from student_800_task where acadyear = '" . $acadyear . "'");?>
					<? $_resStudentCount = mysql_query("select id from students where xedbe = '" . $acadyear . "'" . ($_POST['studstatus']=="1,2"?" and studstatus in (1,2)":""));?>
					<ul>
						<li>จำนวนห้องเรียนในปีการศึกษา <?=displayText($acadyear)?> มีทั้งหมดจำนวน <?=displayText(mysql_num_rows($_result))?> ห้องเรียน</li>
						<li>จำนวนวันที่ต้องเรียนต้องมาเรียนทั้งหมดจำนวน <?=displayText(mysql_num_rows($_resDateCount))?> วัน</li>
						<li>จำนวกนักเรียนทั้งหมดจำนวน <?=displayText(number_format(mysql_num_rows($_resStudentCount),0,'.',','))?> คน</li>
						<li>จำนวนครั้งที่เช็คนักเรียนมาเรียนทั้งหมดจำนวน <?=displayText(number_format($_total['total'],0,'',','))?> ครั้ง</li>
						<li>ร้อยละ หมายถึง ร้อยละการขาดการเข้าร่วมกิจกรรมหน้าเสาธงของนักเรียน <br/>คำนวณได้จาก (จำนวนขาดรวมของห้องเรียน) / 
							(จำนวนครั้งที่เช็คนักเรียนมาเรียนทั้งหมด)</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td align="center">
					<table cellpadding="0" cellspacing="1">
						<tr>
							<td class="key" width="150px" align="center" rowspan="2">ระดับชั้น</td>
							<td class="key" align="center" colspan="13">จำนวนนักเรียนที่ไม่มาเรียน(คิดเป็นครั้ง)</td>
						</tr>
						<tr>
							<td class="key" width="40px" align="center">พ.ค.<br/><?=substr($acadyear,2,2)?></td>
							<td class="key" width="40px" align="center">มิ.ย.<br/><?=substr($acadyear,2,2)?></td>
							<td class="key" width="40px" align="center">ก.ค.<br/><?=substr($acadyear,2,2)?></td>
							<td class="key" width="40px" align="center">ส.ค.<br/><?=substr($acadyear,2,2)?></td>
							<td class="key" width="40px" align="center">ก.ย.<br/><?=substr($acadyear,2,2)?></td>
							<td class="key" width="40px" align="center">ต.ค.<br/><?=substr($acadyear,2,2)?></td>
							<td class="key" width="40px" align="center">พ.ย.<br/><?=substr($acadyear,2,2)?></td>
							<td class="key" width="40px" align="center">ธ.ค.<br/><?=substr($acadyear,2,2)?></td>
							<td class="key" width="40px" align="center">ม.ค.<br/><?=substr($acadyear+1,2,2)?></td>
							<td class="key" width="40px" align="center">ก.พ.<br/><?=substr($acadyear+1,2,2)?></td>
							<td class="key" width="40px" align="center">มี.ค.<br/><?=substr($acadyear+1,2,2)?></td>
							<td class="key" width="50px" align="center">รวม</td>
							<td class="key" width="80px" align="center">ร้อยละ</td>
						</tr>
						<?	$_may;$_jun;$_jul;$_aug;$_sep;$_oct;$_nov;$_dec;$_jan;$_feb;$_mar; $_sum; ?>
						<?	while($_dat = mysql_fetch_assoc($_result)){ ?>
						<tr>
							<td style="padding-left:10px;">มัธยมศึกษาปีที่ <?=getFullRoomFormat($_dat['class_id'])?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['may']==0?"-":$_dat['may']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['jun']==0?"-":$_dat['jun']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['jun']==0?"-":$_dat['jul']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['aug']==0?"-":$_dat['aug']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['sep']==0?"-":$_dat['sep']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['oct']==0?"-":$_dat['oct']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['nov']==0?"-":$_dat['nov']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['dec']==0?"-":$_dat['dec']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['jan']==0?"-":$_dat['jan']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['feb']==0?"-":$_dat['feb']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['mar']==0?"-":$_dat['mar']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['sum']==0?"-":number_format($_dat['sum'],0,'',',')?></td>
							<td style="padding-right:20px;" align="right"><?=number_format($_dat['sum']/$_total['total']*100,2,'.','')?></td>
						</tr>
						<?	$_may+=$_dat['may'];  $_jun+=$_dat['jun'];  $_jul+=$_dat['jul'];  $_aug+=$_dat['aug']; ?>
						<?	$_sep+=$_dat['sep'];  $_oct+=$_dat['oct'];  $_nov+=$_dat['nov'];  $_dec+=$_dat['dec']; ?>
						<?	$_jan+=$_dat['jan'];  $_feb+=$_dat['feb'];  $_mar+=$_dat['mar'];  $_sum+=$_dat['sum'];?>
						<?	} mysql_free_result($_result); ?>
						<tr height="35px">
							<td class="key" align="center">รวม</td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_may>0?number_format($_may,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_jun>0?number_format($_jun,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_jul>0?number_format($_jul,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_aug>0?number_format($_aug,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_sep>0?number_format($_sep,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_oct>0?number_format($_oct,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_nov>0?number_format($_nov,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_dec>0?number_format($_dec,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_jan>0?number_format($_jan,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_feb>0?number_format($_feb,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_mar>0?number_format($_mar,0,'',','):"-"?></td>
							<td class="key" align="right"><?=$_sum>0?number_format($_sum,0,'',','):"-"?></td>
							<td class="key" align="center"><?=$_sum>0?number_format($_sum/$_total['total']*100,2,'.',''):"-"?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
<? }else {echo "<center><font color='red'><br/>ยังไม่มีข้อมูลในปีการศึกษา " . $acadyear . "</font></center>";} ?>
</div>

