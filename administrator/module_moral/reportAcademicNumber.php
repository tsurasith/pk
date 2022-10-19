<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_moral/index"><img src="../images/objects.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">ระบบสารสนเทศธนาคารความดี</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>2.1.3 สรุปรายงานตามกลุ่มสาระการเรียนรู้และ<br/>ระดับของกิจกรรมรายภาคเรียน</strong></font></span></td>
     <td >
		<?  if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_moral/reportAcademicNumber&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_moral/reportAcademicNumber&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		 ภาคเรียนที่ <?  if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_moral/reportAcademicNumber&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_moral/reportAcademicNumber&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?><br/>
		<form method="post">
			<font color="#000000" size="2"  >
			ระดับชั้น 
			<select name="roomID" class="inputboxUpdate">
				<option value=""></option>
				<option value="3/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/1"?"selected":""?>> มัธยมศึกษาปีที่ 1 </option>
				<option value="3/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/2"?"selected":""?>> มัธยมศึกษาปีที่ 2 </option>
				<option value="3/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/3"?"selected":""?>> มัธยมศึกษาปีที่ 3 </option>
				<option value="4/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/1"?"selected":""?>> มัธยมศึกษาปีที่ 4 </option>
				<option value="4/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/2"?"selected":""?>> มัธยมศึกษาปีที่ 5 </option>
				<option value="4/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/3"?"selected":""?>> มัธยมศึกษาปีที่ 6 </option>
				<option value="all" <?=isset($_POST['roomID'])&&$_POST['roomID']=="all"?"selected":""?>> ทั้งโรงเรียน </option>
			</select>
			<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา</font>
		</form>
	  </td>
    </tr>
  </table>
  
<? if(isset($_POST['search']) && $_POST['roomID'] == "") { ?>
		<br/><br/><center><font color="#FF0000">กรุณาเลือก ระดับชั้น ที่ต้องการทราบข้อมูลก่อน</font></center>
<? }//end if ?> 
  
 <? if(isset($_POST['search']) && $_POST['roomID'] != "") { ?> 
	  <table class="admintable"  width="100%">
		<tr>
			<th align="center">
				<img src="../images/school_logo.gif" width="120px"><br/>
				รายงานพฤติกรรมที่พึงประสงค์ นักเรียนชั้นมัธยมศึกษาปีที่ <?=displayXyear($_POST['roomID'])?><br/>
				ภาคเรียนที่ <?=$acadsemester?> 
				ปีการศึกษา <?=$acadyear?>
			</th>
		</tr>
		<tr>
			<td align="center">
					<table align="center" class="admintable">
						<tr>
							<td class="key" align="center" rowspan="2" width="210px">กลุ่มสาระการเรียนรู้</td>
							<td class="key" align="center" colspan="5">ระดับของกิจกรรมที่เข้าร่วม(ครั้ง)</td>
							<td class="key" align="center" rowspan="2" width="100px">รวม</td>
						</tr>
						<tr>
							<td class="key" align="center" width="70px">ภายใน</td>
							<td class="key" align="center" width="70px">ชุมชน</td>
							<td class="key" align="center" width="70px">เขตพื้นที่<br/>การศึกษา</td>
							<td class="key" align="center" width="70px">จังหวัด</td>
							<td class="key" align="center" width="70px">ประเทศ</td>
						</tr>
						<? $_sql = "select academic,
									  sum(if(mlevel='00',1,0)) as a,
									  sum(if(mlevel='01',1,0)) as b,
									  sum(if(mlevel='02',1,0)) as c,
									  sum(if(mlevel='03',1,0)) as d,
									  sum(if(mlevel='04',1,0)) as e,
									  count(a.id) as total
									from student_moral a left outer join students b
									on a.student_id = b.id
									where xedbe = '" . $acadyear . "'and acadsemester = '" . $acadsemester . "' "; ?>
						<? if($_POST['roomID']!="all"){ $_sql .= " and xlevel = '" . substr($_POST['roomID'],0,1) . "' and xyearth = '" . substr($_POST['roomID'],2,1) . "' ";} ?>
						<? $_sql .= " and acadyear = '" . $acadyear . "' " . (isset($_POST['studstatus'])=="1,2"?" and studstatus in (1,2) ":"") . " group by academic order by academic ";?>
						<? $_result = mysql_query($_sql); ?>
						<? $_a = 0;$_b = 0; $_c = 0; $_d = 0; $_e = 0; $_sum = 0; ?>
						<? while($_dat = mysql_fetch_assoc($_result)) { ?>
						<tr>
							<td style="padding-left:20px" align="left"><?=displayAcademic($_dat['academic'])?></td>
							<td style="padding-right:10px" align="right"><?=$_dat['a']==0?"-":number_format($_dat['a'],0,'',',')?></td>
							<td style="padding-right:10px" align="right"><?=$_dat['b']==0?"-":number_format($_dat['b'],0,'',',')?></td>
							<td style="padding-right:10px" align="right"><?=$_dat['c']==0?"-":number_format($_dat['c'],0,'',',')?></td>
							<td style="padding-right:10px" align="right"><?=$_dat['d']==0?"-":number_format($_dat['d'],0,'',',')?></td>
							<td style="padding-right:10px" align="right"><?=$_dat['e']==0?"-":number_format($_dat['e'],0,'',',')?></td>
							<td align="right" style="padding-right:10px"><?=$_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']+$_dat['e']==0?"-":number_format($_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']+$_dat['e'],0,'',',')?></td>
							<? $_a += $_dat['a']; $_b += $_dat['b']; $_c += $_dat['c']; $_e+=$_dat['e'];
							   $_d += $_dat['d']; $_sum += ($_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']+$_dat['e']); ?>
						</tr>
						<? } mysql_free_result($_result); ?>
						<tr height="30px">
						  <td class="key" align="center">รวม</td>
						  <td class="key" style="padding-right:10px" align="right"><?=$_a==0?"-":number_format($_a,0,'',',');?></td>
						  <td class="key" style="padding-right:10px" align="right"><?=$_b==0?"-":number_format($_b,0,'',',');?></td>
						  <td class="key" style="padding-right:10px" align="right"><?=$_c==0?"-":number_format($_c,0,'',',');?></td>
						  <td class="key" style="padding-right:10px" align="right"><?=$_d==0?"-":number_format($_d,0,'',',');?></td>
						  <td class="key" style="padding-right:10px" align="right"><?=$_e==0?"-":number_format($_e,0,'',',');?></td>
						  <td class="key" align="right" style="padding-right:10px"><?=$_sum==0?"-":number_format($_sum,0,'',',');?></td>
					  </tr>
					</table>
			 </td>
			</tr>
		</table>
<? } //end if ?>
</div>
