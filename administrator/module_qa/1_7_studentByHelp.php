<div id="content">
<form name="myform" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_qa/index"><img src="../images/qa.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">งานประกันคุณภาพและมาตรฐาน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.7 แสดงร้อยละของเด็กพิเศษที่(ต้อง)ได้รับการช่วยเหลือ</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_qa/1_7_studentByHelp&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_qa/1_7_studentByHelp&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
		<font color="#000000" size="2"  >
		เลือกประเภท
		<select name="type" class="inputboxUpdate" onchange="document.myform.submit();">
			<option value="absent"  <?=isset($_POST['type'])&&$_POST['type']=="absent"?"selected":""?> >ความขาดแคลน</option>
			<option value="cripple" <?=isset($_POST['type'])&&$_POST['type']=="cripple"?"selected":""?> >ความพิการ</option>
		</select><br/>
		<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> onclick="document.myform.submit();" />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			 </font>
	   </td>
    </tr>
  </table>
  </form>
<br/>
<? $_text = ($_POST['type']=="cripple"?"cripple":"absent"); ?>
<? $_sql = "select ".$_text."_description as 'desc',
				sum(if(sex=1 && xlevel = 3,1,0)) as 'am',
				sum(if(sex=2 && xlevel = 3,1,0)) as 'af',
				sum(if(sex=1 && xlevel = 4,1,0)) as 'bm',
				sum(if(sex=2 && xlevel = 4,1,0)) as 'bf',
				count(sex) as 'sum'
			from ref_".($_POST['type']=="cripple"?"cripple":"studabsent")." right outer join students 
			on (".$_text."_id = ".($_POST['type']=="cripple"?"cripple":"studabsent").")
			where xedbe = '" . $acadyear . "' group by ".($_POST['type']=="cripple"?"cripple":"studabsent") ;?>			
<? $_result = mysql_query($_sql); ?>
<? if(mysql_num_rows($_result)>0) { ?>
		<table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
			<tr> 
				<th align="center">
					<img src="../images/school_logo.gif" width="120px"><br/><br/>
					ข้อมูลนักเรียนด้าน<?=$_POST['type']=="cripple"?"ร่างกายและความพิการ":"ความขาดแคลน"?> ปีการศึกษา <?=$acadyear?><br/>
					<? $_resTotal = mysql_query("select count(id) as 'total' from students where xedbe = '" . $acadyear . "'" . ($_POST['studstatus']=="1,2"?"and studstatus in (1,2) ":""));?>
					<? $_total = mysql_fetch_assoc($_resTotal); ?>
				</th>
			</tr>
			<tr>
				<td align="center">
					<table cellpadding="0" cellspacing="1">
						<tr>
							<td class="key" width="200px" align="center" rowspan="3">ระดับชั้น</td>
							<td class="key" align="center" colspan="4">จำนวนนักเรียน(คน)</td>
							<td class="key" width="70px" align="center" rowspan="3">รวม</td>
						</tr>
						<tr>
							<td class="key" align="center" colspan="2">ม.ต้น</td>
							<td class="key" align="center" colspan="2">ม.ปลาย</td>
						</tr>
						<tr>
							<td class="key" width="50px" align="center">ชาย</td>
							<td class="key" width="50px" align="center">หญิง</td>
							<td class="key" width="50px" align="center">ชาย</td>
							<td class="key" width="50px" align="center">หญิง</td>
						</tr>
						<?	$_am;$_af;$_bm;$_bf; $_sum; ?>
						<?	while($_dat = mysql_fetch_assoc($_result)){ ?>
						<tr>
							<td style="padding-left:10px;" align="left"><?=trim($_dat['desc'])!=""?$_dat['desc']:"ยังไม่บันทึกข้อมูล"?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['am']==0?"-":$_dat['am']?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['af']==0?"-":$_dat['af']?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['bm']==0?"-":$_dat['bm']?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['bf']==0?"-":$_dat['bf']?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['sum']==0?"-":number_format($_dat['sum'],0,'.',',')?></td>
						</tr>
						<?	$_am+=$_dat['am'];  $_af+=$_dat['af'];  $_bm+=$_dat['bm'];  $_bf+=$_dat['bf']; $_sum+=$_dat['sum'];?>
						<?	} mysql_free_result($_result); ?>
						<tr height="35px">
							<td class="key" align="center">รวม</td>
							<td class="key" align="right"><?=($_am==0?"-":$_am)?></td>
							<td class="key" align="right"><?=($_af==0?"-":$_af)?></td>
							<td class="key" align="right"><?=($_bm==0?"-":$_bm)?></td>
							<td class="key" align="right"><?=($_bf==0?"-":$_bf)?></td>
							<td class="key" align="right"><?=number_format($_total['total'],0,'.',',')?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
<? }else {echo "<center><font color='red'><br/>ยังไม่มีข้อมูลในปีการศึกษา " . $acadyear . "</font></center>";} ?>
</div>

