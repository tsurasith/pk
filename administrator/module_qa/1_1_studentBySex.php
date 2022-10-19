<div id="content">
<form name="myform" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_qa/index"><img src="../images/qa.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">งานประกันคุณภาพและมาตรฐาน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.1 แสดงจำนวนนักเรียนแต่ละระดับชั้นจำแนกตามเพศ</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_qa/1_1_studentBySex&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_qa/1_1_studentBySex&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
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
<? $_sql = "select xlevel,xyearth, sum(if(sex=1,1,0)) as 'male', sum(if(sex=2,1,0)) as 'female', count(sex) as 'sum' ";?>
<? $_sql .= " from students where xedbe = '" . $acadyear . "' " . ($_POST['studstatus']=="1,2"?"and studstatus in (1,2) ":"") . "  group by xlevel,xyearth ";?>
<? $_result = mysql_query($_sql); ?>
<? if(mysql_num_rows($_result)>0) { ?>
		<table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
			<tr> 
				<th align="center">
					<img src="../images/school_logo.gif" width="120px"><br/><br/>
					จำนวนนักเรียนทุกระดับชั้น ปีการศึกษา <?=$acadyear?><br/>
					<? $_resTotal = mysql_query("select count(id) as 'total' from students where xedbe = '" . $acadyear . "'" . ($_POST['studstatus']=="1,2"?"and studstatus in (1,2) ":""));?>
					<? $_total = mysql_fetch_assoc($_resTotal); ?>
				</th>
			</tr>
			<tr>
				<td align="center">
					<table cellpadding="0" cellspacing="1">
						<tr>
							<td class="key" width="150px" align="center" rowspan="2">ระดับชั้น</td>
							<td class="key" align="center" colspan="4">จำนวนนักเรียน(คน)</td>
						</tr>
						<tr>
							<td class="key" width="70px" align="center">ชาย</td>
							<td class="key" width="70px" align="center">หญิง</td>
							<td class="key" width="70px" align="center">รวม</td>
							<td class="key" width="100px" align="center">คิดเป็นร้อยละ</td>
						</tr>
						<?	$_male; $_female; $_sum; ?>
						<?	while($_dat = mysql_fetch_assoc($_result)){ ?>
						<tr>
							<td style="padding-left:10px;">มัธยมศึกษาปีที่ <?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['male']==0?"-":$_dat['male']?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['female']==0?"-":$_dat['female']?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['sum']==0?"-":$_dat['sum']?></td>
							<td align="center"><?=number_format($_dat['sum']/$_total['total']*100,2,'.','')?></td>
						</tr>
						<?	$_male+=$_dat['male']; $_female+=$_dat['female']; $_sum+=$_dat['sum'];?>
						<?	} mysql_free_result($_result); ?>
						<tr height="35px">
							<td class="key" align="center">รวม</td>
							<td class="key" align="right"><?=number_format($_male,0,'.',',')?></td>
							<td class="key" align="right"><?=number_format($_female,0,'.',',')?></td>
							<td class="key" align="right"><?=number_format($_total['total'],0,'.',',')?></td>
							<td class="key" align="center"><?=number_format($_sum/$_total['total']*100,2,'.','')?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
<? }else {echo "<center><font color='red'><br/>ยังไม่มีข้อมูลในปีการศึกษา " . $acadyear . "</font></center>";} ?>
</div>

