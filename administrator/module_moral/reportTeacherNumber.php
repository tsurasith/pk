<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_moral/index"><img src="../images/objects.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">ระบบสารสนเทศธนาคารความดี</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>2.1.5 สรุปรายงานครูผู้ควบคุมนักเรียนตาม<br/>ประเภทของกิจกรรมรายภาคเรียน</strong></font></span></td>
     <td >
		<?php
			
			if(isset($_REQUEST['acadyear']))
			{
				$acadyear = $_REQUEST['acadyear'];
			}
			if(isset($_REQUEST['acadsemester']))
			{
				$acadsemester = $_REQUEST['acadsemester'];
			}
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_moral/reportTeacherNumber&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_moral/reportTeacherNumber&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		 ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_moral/reportTeacherNumber&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_moral/reportTeacherNumber&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?><br/>
		<form method="post">
			<font color="#000000" size="2"  >
			รายชื่อครู 
			<? @$_resTeacher = mysql_query("select distinct mteacher from student_moral where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'"); ?>
			<select name="mteacher" class="inputboxUpdate">
				<option value=""></option>
				<? while($_dat = mysql_fetch_assoc($_resTeacher)) { ?>
				<option value="<?=$_dat['mteacher']?>" <?=isset($_POST['mteacher']) && $_POST['mteacher']==$_dat['mteacher']?"selected":""?>><?=$_dat['mteacher']?></option>
				<? } ?>
				<option value="all" <?=$_POST['mteacher']=="all"?"selected":""?>>ทั้งหมด</option>
			</select>
			<input type="submit" value="เรียกดู" class="button" name="search"/><br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา</font>
		</form>
	  </td>
    </tr>
  </table>

<? if(isset($_POST['search']) && $_POST['mteacher'] == "") { ?>
		<br/><br/><center><font color="#FF0000">กรุณาเลือก ครูผู้ควบคุมนักเรียน ที่ต้องการทราบข้อมูลก่อน</font></center>
<? } ?>

<? if(isset($_POST['search']) && $_POST['mteacher'] != "") { ?>
  <table class="admintable"  width="100%">
  	<tr>
		<th colspan="8" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายงานสรุปจำนวนครูที่เป็นผู้ควบคุมนักเรียนเข้าร่วมกิจกรรมพฤติกรรมที่พึงประสงค์ของนักเรียน<br/>
			ภาคเรียนที่ <?=$acadsemester?> 
			ปีการศึกษา <?=$acadyear?><br/>
			<?=$_POST['mteacher']!="all"?"ของ" . $_POST['mteacher']:"สรุปในภาพรวมทั้งหมด"?>
		</th>
	</tr>
	<tr>
		<td align="center">
		  <? if($_POST['mteacher'] == "all") { ?>
  				<table align="center" class="admintable">
					<tr>
						<td class="key" align="center" rowspan="2" width="210px">ชื่อ - สกุล</td>
						<td class="key" align="center" colspan="4">ประเภทของกิจกรรมที่เข้าร่วม(นักเรียนคน)</td>
						<td class="key" align="center" rowspan="2" width="90px">รวม</td>
					</tr>
					<tr>
						<td class="key" align="center" width="80px">บำเพ็ญประโยชน์</td>
						<td class="key" align="center" width="80px">เข้าร่วมอบรม</td>
						<td class="key" align="center" width="80px">แข่งขันทักษะวิชาการ</td>
						<td class="key" align="center" width="80px">แข่งขันทักษะกีฬา</td>
					</tr>
					<? $_sql = "select mteacher,
								  sum(if(mtype='00',1,0)) as a,
								  sum(if(mtype='01',1,0)) as b,
								  sum(if(mtype='02',1,0)) as c,
								  sum(if(mtype='03',1,0)) as d,
								  count(a.id) as total
								from student_moral a left outer join students b
								on a.student_id = b.id
								where xedbe = '" . $acadyear . "'and acadsemester = '" . $acadsemester . "' 
									and acadyear = '" . $acadyear . "' " . (isset($_POST['studstatus'])=="1,2"?" and studstatus in (1,2) ":"") . "
								group by mteacher";?>
					<? $_result = mysql_query($_sql); ?>
					<? $_a = 0;$_b = 0; $_c = 0; $_d = 0; $_sum = 0; ?>
					<? while($_dat = mysql_fetch_assoc($_result)) { ?>
					<tr>
						<td style="padding-left:20px" align="left"><?=$_dat['mteacher']?></td>
						<td style="padding-right:10px" align="right"><?=$_dat['a']==0?"-":number_format($_dat['a'],0,'',',')?></td>
						<td style="padding-right:10px" align="right"><?=$_dat['b']==0?"-":number_format($_dat['b'],0,'',',')?></td>
						<td style="padding-right:10px" align="right"><?=$_dat['c']==0?"-":number_format($_dat['c'],0,'',',')?></td>
						<td style="padding-right:10px" align="right"><?=$_dat['d']==0?"-":number_format($_dat['d'],0,'',',')?></td>
						<td align="right" style="padding-right:10px"><?=$_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']==0?"-":number_format($_dat['a']+$_dat['b']+$_dat['c']+$_dat['d'],0,'',',')?></td>
						<? $_a += $_dat['a']; $_b += $_dat['b']; $_c += $_dat['c'];
						   $_d += $_dat['d']; $_sum += ($_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']); ?>
					</tr>
					<? } mysql_free_result($_result); ?>
					<tr height="30px">
					  <td class="key" align="center">รวม</td>
					  <td class="key" style="padding-right:10px" align="right"><?=$_a>0?number_format($_a,0,'',','):"-"?></td>
					  <td class="key" style="padding-right:10px" align="right"><?=$_b>0?number_format($_b,0,'',','):"-"?></td>
					  <td class="key" style="padding-right:10px" align="right"><?=$_c>0?number_format($_c,0,'',','):"-"?></td>
					  <td class="key" style="padding-right:10px" align="right"><?=$_d>0?number_format($_d,0,'',','):"-"?></td>
					  <td class="key" align="right" style="padding-right:10px"><?=$_sum>0?number_format($_sum,0,'',','):"-"?></td>
				  </tr>
				</table>
 		 <? } else {  ?>
		 		<table align="center" class="admintable">
					<tr>
						<td class="key" align="center" rowspan="2" width="150px">รางวัลที่ได้รับ</td>
						<td class="key" align="center" colspan="5">ระดับของกิจกรรม(นักเรียนคน)</td>
						<td class="key" align="center" rowspan="2" width="90px">รวม</td>
					</tr>
					<tr>
						<td class="key" align="center" width="70px">ภายใน</td>
						<td class="key" align="center" width="70px">ชุมชน</td>
						<td class="key" align="center" width="70px">เขตพื้นที่<br/>การศึกษา</td>
						<td class="key" align="center" width="70px">จังหวัด</td>
						<td class="key" align="center" width="70px">ประเทศ</td>
					</tr>
					<? $_sql = "select mprize,
								  sum(if(mlevel='00',1,0)) as a,
								  sum(if(mlevel='01',1,0)) as b,
								  sum(if(mlevel='02',1,0)) as c,
								  sum(if(mlevel='03',1,0)) as d,
								  sum(if(mlevel='04',1,0)) as e,
								  count(a.id) as total
								from student_moral a left outer join students b
								on a.student_id = b.id
								where xedbe = '" . $acadyear . "'and acadsemester = '" . $acadsemester . "' 
									and mteacher = '" . $_POST['mteacher'] . "'
									and acadyear = '" . $acadyear . "' " . (isset($_POST['studstatus'])=="1,2"?" and studstatus in (1,2) ":"") . "
								group by mprize";?>
					<? $_result = mysql_query($_sql); ?>
					<? $_a = 0;$_b = 0; $_c = 0; $_d = 0; $_e = 0; $_sum = 0; ?>
					<? while($_dat = mysql_fetch_assoc($_result)) { ?>
					<tr>
						<td style="padding-left:20px" align="left"><?=displayPrize($_dat['mprize'])?></td>
						<td style="padding-right:10px" align="right"><?=$_dat['a']==0?"-":number_format($_dat['a'],0,'',',')?></td>
						<td style="padding-right:10px" align="right"><?=$_dat['b']==0?"-":number_format($_dat['b'],0,'',',')?></td>
						<td style="padding-right:10px" align="right"><?=$_dat['c']==0?"-":number_format($_dat['c'],0,'',',')?></td>
						<td style="padding-right:10px" align="right"><?=$_dat['d']==0?"-":number_format($_dat['d'],0,'',',')?></td>
						<td style="padding-right:10px" align="right"><?=$_dat['e']==0?"-":number_format($_dat['e'],0,'',',')?></td>
						<td align="right" style="padding-right:10px"><?=$_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']+$_dat['e']>0?number_format($_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']+$_dat['e'],0,'',','):"-"?></td>
						<? $_a += $_dat['a']; $_b += $_dat['b']; $_c += $_dat['c']; $_e+=$_dat['e'];
						   $_d += $_dat['d']; $_sum += ($_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']+$_dat['e']); ?>
					</tr>
					<? } mysql_free_result($_result); ?>
					<tr height="30px">
					  <td class="key" align="center">รวม</td>
					  <td class="key" style="padding-right:10px" align="right"><?=$_a>0?number_format($_a,0,'',','):"-"?></td>
					  <td class="key" style="padding-right:10px" align="right"><?=$_b>0?number_format($_b,0,'',','):"-"?></td>
					  <td class="key" style="padding-right:10px" align="right"><?=$_c>0?number_format($_c,0,'',','):"-"?></td>
					  <td class="key" style="padding-right:10px" align="right"><?=$_d>0?number_format($_d,0,'',','):"-"?></td>
					  <td class="key" style="padding-right:10px" align="right"><?=$_e>0?number_format($_e,0,'',','):"-"?></td>
					  <td class="key" align="right" style="padding-right:10px"><?=$_sum>0?number_format($_sum,0,'',','):"-"?></td>
				  </tr>
				</table>
		 <? } //end else ?>
		 </td>
		</tr>
	</table>
<? } //end if ?>
</div>

