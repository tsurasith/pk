<div id="content">
<form method="post" name="myform">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
	<tr> 
	  <td width="6%" align="center"><a href="index.php?option=module_color/index"><img src="../images/color.png" alt="กิจกรรมคณะสี" width="48" height="48" border="0"/></a></td>
	  <td><strong><font color="#990000" size="4">กิจกรรมคณะสี</font></strong><br />
		<span class="normal"><font color="#0066FF"><strong>3.3.6 สรุปจำนวนนักเรียนตามคณะสี เพศ และระดับชั้น</strong></font></span></td>
	  <td align="right">
		<?php
				if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
				if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
			?>
			ปีการศึกษา<?php  
						echo "<a href=\"index.php?option=module_color/reportCountStudentByColor&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
						echo '<font color=\'blue\'>' .$acadyear . '</font>';
						echo " <a href=\"index.php?option=module_color/reportCountStudentByColor&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
					?>
			<br/>
			<font color="#000000"   size="2">
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> onclick="document.myform.submit();" />
			เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			</font>
	  </td>
	</tr>
</table>
</form>
<? $_sql = "select color,
			  sum(if(xlevel=3&&sex=1,1,0)) as 'am',
			  sum(if(xlevel=3&&sex=2,1,0)) as 'af',
			  sum(if(xlevel=4&&sex=1,1,0)) as 'bm',
			  sum(if(xlevel=4&&sex=2,1,0)) as 'bf',
			  count(id) as 'sum' from students where xedbe = '" . $acadyear . "' " .($_POST['studstatus']=="1,2"?" and studstatus in (1,2) ":""). " group by color order by 6 desc"; ?>
	<? $_result = mysql_query($_sql); ?>
	<? if(mysql_num_rows($_result)>0) { ?>
		<table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" >
			<tr>
				<th align="center" colspan="6">
					<img src="../images/school_logo.gif" width="120px">
					<br/>
					สรุปจำนวนนักเรียนตามคณะสี<br/>
					ประจำปีการศึกษา <?=$acadyear?>
					<br/>
				</th>
			</tr>
			<tr height="35px" > 
				<td class="key" width="110px" align="center" rowspan="3">คณะสี</td>
				<td class="key" colspan="4"align="center" >จำนวนนักเรียน (คน)</td>
				<td class="key"  align="center" width="90px" rowspan="3">รวม</td>
			</tr>
			<tr>
				<td class="key" align="center" colspan="2">ม.ต้น</td>
				<td class="key" align="center" colspan="2">ม.ปลาย</td>
			</tr>
			<tr>
				<td class="key" align="center" width="60px">ชาย</td>
				<td class="key" align="center" width="60px">หญิง</td>
				<td class="key" align="center" width="60px">ชาย</td>
				<td class="key" align="center" width="60px">หญิง</td>
			</tr>
			<? $_a;$_b;$_c;$_d;$_sum; ?>
			<? while($_dat = mysql_fetch_assoc($_result)) { ?>
			<tr>
				<td align="left" style="padding-left:15px;"><?=$_dat['color']!="9"?$_dat['color']:"ไม่ระบุ"?></td>
				<td style="padding-right:15px;" align="right"><?=$_dat['am']>0?$_dat['am']:"-"?></td>
				<td style="padding-right:15px;" align="right"><?=$_dat['af']>0?$_dat['af']:"-"?></td>
				<td style="padding-right:15px;" align="right"><?=$_dat['bm']>0?$_dat['bm']:"-"?></td>
				<td style="padding-right:15px;" align="right"><?=$_dat['bf']>0?$_dat['bf']:"-"?></td>
				<th style="padding-right:30px;" align="right"><?=$_dat['sum']>0?$_dat['sum']:"-"?></th>
			</tr>
			<? $_a+=$_dat['am'];  $_b+=$_dat['af'];  $_c+=$_dat['bm'];  $_d+=$_dat['bf'];  $_sum+=$_dat['sum']; ?>
			<? } //end-while ?>
			<tr height="35px">
				<td align="center" class="key">รวม</td>
				<td class="key" align="right" style="padding-right:15px"><?=$_a>0?$_a:"-"?></td>
				<td class="key" align="right" style="padding-right:15px"><?=$_b>0?$_b:"-"?></td>
				<td class="key" align="right" style="padding-right:15px"><?=$_c>0?$_c:"-"?></td>
				<td class="key" align="right" style="padding-right:15px"><?=$_d>0?$_d:"-"?></td>
				<td class="key" align="right" style="padding-right:30px"><?=$_sum>0?$_sum:"-"?></td>
			</tr>
		</table>
	<? } else { ?> <div align="center"><font color="red"><br/><br/>ไม่พบข้อมูลที่ต้องการ</font></div> <? } ?>
</div>
