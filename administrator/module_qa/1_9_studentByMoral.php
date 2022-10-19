<div id="content">
<form name="myform" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_qa/index"><img src="../images/qa.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">งานประกันคุณภาพและมาตรฐาน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.9 แสดงค่าร้อยละจำนวนผู้เรียนที่ได้รับการยกย่องชมเชย หรือประกาศเกียรติคุณ </strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_qa/1_9_studentByMoral&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_qa/1_9_studentByMoral&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	   </td>
    </tr>
  </table>
  </form>
<br/>
<? $_sql = "select moral_description,
			  sum(if(mlevel='04',1,0)) as 'country',
			  sum(if(mlevel='03',1,0)) as 'province',
			  sum(if(mlevel='02',1,0)) as 'union',
			  sum(if(mlevel='01',1,0)) as 'social',
			  sum(if(mlevel='00',1,0)) as 'school',
			  count(id) as 'sum'
			from ref_moral right outer join student_moral on (moral_id = mtype)
			where acadyear = '" . $acadyear . "' group by mtype";?>
<? $_result = mysql_query($_sql); ?>
<? if(mysql_num_rows($_result)>0) { ?>
		<table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
			<tr> 
				<th align="center">
					<img src="../images/school_logo.gif" width="120px"><br/><br/>
					แสดงจำนวนนักเรียนที่ได้รับการยกย่องชมเชยหรือประกาศเกียรติคุณ ปีการศึกษา <?=$acadyear?><br/>
				</th>
			</tr>
			<tr>
				<td align="center">
					<table cellpadding="0" cellspacing="1">
						<tr>
							<td class="key" width="200px" align="center" rowspan="2">ประเภทการได้รับยกย่อง/ชมเชย</td>
							<td class="key" align="center" colspan="5">ระดับหน่วยงานที่มอบเกียรติบัตร (จำนวนครั้ง)</td>
							<td class="key" width="100px" align="center" rowspan="2">รวม</td>
						</tr>
						<tr>
							<td class="key" width="70px" align="center">ประเทศ</td>
							<td class="key" width="70px" align="center">จังหวัด</td>
							<td class="key" width="70px" align="center">เขตพื้นที่ฯ</td>
							<td class="key" width="70px" align="center">ชุมชน</td>
							<td class="key" width="70px" align="center">กิจกรรมภายใน</td>
						</tr>
						<?	$_a;$_b;$_c;$_d;$_e; $_sum; ?>
						<?	while($_dat = mysql_fetch_assoc($_result)){ ?>
						<tr>
							<td style="padding-left:10px;"><?=$_dat['moral_description']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['country']==0?"-":$_dat['country']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['province']==0?"-":$_dat['province']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['union']==0?"-":$_dat['union']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['social']==0?"-":$_dat['social']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['school']==0?"-":$_dat['school']?></td>
							<td style="padding-right:10px;" align="right"><?=$_dat['sum']==0?"-":$_dat['sum']?></td>
						</tr>
						<?	$_a+=$_dat['country'];  $_b+=$_dat['province'];  $_c+=$_dat['union']; ?>
						<?	$_d+=$_dat['social'];   $_e+=$_dat['school'];    $_sum+=$_dat['sum'];?>
						<?	} mysql_free_result($_result); ?>
						<tr height="35px">
							<td class="key" align="center">รวม</td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_a>0?number_format($_a,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_b>0?number_format($_b,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_c>0?number_format($_c,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_d>0?number_format($_d,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_e>0?number_format($_e,0,'',','):"-"?></td>
							<td style="padding-right:10px;" class="key" align="right"><?=$_sum>0?number_format($_sum,0,'',','):"-"?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
<? }else {echo "<center><font color='red'><br/>ยังไม่มีข้อมูลในปีการศึกษา " . $acadyear . "</font></center>";} ?>
</div>

