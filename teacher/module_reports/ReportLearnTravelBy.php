

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_reports/index">
			<img src="../images/chart.png" alt="" width="48px" border="0" />
		</a>
	  </td>
      <td><strong><font color="#990000" size="4">ระบบรายงาน/สถิติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.5.4 วิเคราะห์วิธีการเดินทางมาโรงเรียน เพศ <br/>
        และการเข้าชั้นเรียน</strong></font></span></td>
      <td width="55%">
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_reports/ReportLearnTravelBy&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_reports/ReportLearnTravelBy&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		 ภาคเรียนที่   <? if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else { echo " <a href=\"index.php?option=module_reports/ReportLearnTravelBy&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ; }
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_reports/ReportLearnTravelBy&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<br/>
		<font color="#000000" size="2"  >
		<form method="post">
			การเข้าชั้นเรียน
			<select name="timecheck" class="inputboxUpdate">
				<option value=""></option>
				<option value="00" <?=isset($_POST['timecheck']) && $_POST['timecheck'] == "00" ? "selected" :""?>>มา</option>
				<option value="01" <?=isset($_POST['timecheck']) && $_POST['timecheck'] == "01" ? "selected" :""?>>กิจกรรม</option>
				<option value="03" <?=isset($_POST['timecheck']) && $_POST['timecheck'] == "03" ? "selected" :""?>>ลา</option>
				<option value="02" <?=isset($_POST['timecheck']) && $_POST['timecheck'] == "02" ? "selected" :""?>>สาย</option>
				<option value="04" <?=isset($_POST['timecheck']) && $_POST['timecheck'] == "04" ? "selected" :""?>>ขาด</option>
			</select>
			<input type="submit" value="เรียกดู" name="search" class="button" /><br/>
			<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		</form>
		</font>
	  </td>
    </tr>
  </table>  
<? if(isset($_POST['search']) && $_POST['timecheck'] =="") { ?>
	<? echo "<br/><br/><center><font color='red'>กรุณาเลือกการมาเข้าชั้นเรียนก่อน !</font></center>";} ?>	
<? if(isset($_POST['search']) && $_POST['timecheck'] != ""){ ?>
	<? $_sql = "select travelby,count(distinct id) as 'student',
					sum(if(sex=1 && timecheck_id = '" . $_POST['timecheck'] . "',1,0)) as 'male' ,
					sum(if(sex=2 && timecheck_id = '" . $_POST['timecheck'] . "',1,0)) as 'female',
					sum(if(timecheck_id = '" . $_POST['timecheck'] . "',1,0)) as 'sum',
					count(timecheck_id) as 'total'
			from students a right outer join student_learn b on (a.id = b.student_id)
			where xedbe = '" . $acadyear . "' and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'"; ?>
	<? $_sql .= ($_POST['studstatus']=="1,2"?" and studstatus in (1,2) ":"") ; ?>
	<? $_sql .=	" group by travelby order by 2 desc"; ?>
	<? $_result = mysql_query($_sql); ?>
	<? if(mysql_num_rows($_result)>0){ ?>
	<? $_xmlColumn = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlPie = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlColumn .= "<graph caption='' xAxisName='' yAxisName='Person' formatNumberScale='0' decimalPrecision='0'>";
		$_xmlPie .="<graph caption='' decimalPrecision='0' showPercentageValues='1' showNames='1'  showValues='1'  pieYScale='65' pieSliceDepth='25' pieRadius='100'>";
		
		$_catXML = "<categories>";
		$_setA = "<dataset seriesname='ชาย'  showValue='1'>";
		$_setB = "<dataset seriesname='หญิง' showValue='1'>";
		$_m = 0; $_f = 0; $_x = 0; $_s = 0; $_t = 0; ?>
		
		<table class="admintable" width="100%" align="center" >
			<tr>
				<th colspan="2" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>
					วิเคราะห์วิธีการเดินทางมาโรงเรียน เพศ <br/>และการเข้าชั้นเรียน
					ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
					<br/>
				</th>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<table align="center" >
						<tr>
							<td class="key" rowspan="2" align="center" width="140px">วิธีการเดินทาง<br/>มาโรงเรียน</td>
							<td class="key" rowspan="2" align="center" width="70px">นักเรียน<br/>(คน)</td>
							<td class="key" colspan="2" align="center">จำนวน<?=displayTimecheck($_POST['timecheck'])?>(ครั้ง)</td>
							<td class="key" rowspan="2" align="center" width="60px">รวม<?=displayTimecheck($_POST['timecheck'])?></td>
							<td class="key" rowspan="2" align="center" width="110px">จำนวนที่เช็ค<br/>ทั้งหมด(ครั้ง)</td>
							<td class="key" rowspan="2" align="center" width="70px">% แต่ละ วิธีการ</td>
						</tr>
						<tr>
							<td class="key" align="center" width="60px">ชาย</td>
							<td class="key" align="center" width="60px">หญิง</td>
						</tr>
							<? while($_dat = mysql_fetch_assoc($_result)) { ?>
								<? if($_dat['sum']>0){ ?>
									<? $_catXML .= "<category name='" . ($_dat['travelby']==""?"ไม่ระบุ":displayTravel($_dat['travelby'])) . "' hoverText=''/>"; ?>
									<? $_color = getFCColor(); ?>
									<? $_setA .= "<set value='" . $_dat['male'] . "' color = '" . $_color . "' />"; ?>
									<? $_setB .= "<set value='" . $_dat['female'] . "' color = '" . $_color . "' />"; ?>
									<? $_xmlPie .= "<set value='" . (100*$_dat['sum']/$_dat['total']) . "' name='" .($_dat['travelby']==""?"ไม่ระบุ":displayTravel($_dat['travelby'])). "' color='" . $_color . "'/>"; ?>
								<? } //end ตรวจสอบข้อมูลว่างไม่ให้แสดงที่แผนภูมิ ?>
								<? $_m += $_dat['male']; $_f +=$_dat['female']; $_x += $_dat['sum'];
									$_s += $_dat['student']; $_t += $_dat['total']; ?>
								<tr>
									<td align="left" style="padding-left:15px;"><?=$_dat['travelby']==""?"ไม่ระบุ":displayTravel($_dat['travelby'])?></td>
									<td align="right" style="padding-right:20px;"><?=$_dat['student']==0?"-":number_format($_dat['student'],0,'',',')?></td>
									<td align="right" style="padding-right:20px;"><?=$_dat['male']==0?"-":number_format($_dat['male'],0,'',',')?></td>
									<td align="right" style="padding-right:20px;"><?=$_dat['female']==0?"-":number_format($_dat['female'],0,'',',')?></td>
									<td align="right" style="padding-right:20px;"><?=$_dat['sum']==0?"-":number_format($_dat['sum'],0,'',',')?></td>
									<td align="right" style="padding-right:20px;"><?=$_dat['total']==0?"-":number_format($_dat['total'],0,'',',')?></td>
									<td align="right" style="padding-right:20px;"><?=$_dat['sum']==0?"-":number_format(($_dat['sum']/$_dat['total'])*100,2,'.',',')?></td>
								</tr>
							<? } ?>
						<tr>
							<td class="key" align="center">รวม</td>
							<td class="key" align="right" style="padding-right:20px;"><?=number_format($_s,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:20px;"><?=number_format($_m,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:20px;"><?=number_format($_f,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:20px;"><?=number_format($_x,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:20px;"><?=number_format($_t,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:20px;"><?=number_format(($_x/$_t)*100,2,'.',',')?></td>
						</tr>
					</table>
				</td>
			</tr>
		<?	$_catXML .= "</categories>";
			$_setA .= "</dataset>";
			$_setB .= "</dataset>";
			$_xmlColumn .= $_catXML . $_setA . $_setB  . "</graph>";
			
			$_xmlPie .= "</graph>"; ?>
		
			<tr>
				<td colspan="2"><div id="chart2" align="center" ></div></td>
			</tr>
			<tr>
				<td colspan="2"><div id="chart1" align="center" ></div></td>
			</tr>
		</table>
		<script language="javascript" type="text/javascript">
			FusionCharts.setCurrentRenderer('JavaScript');
			var myColumn = new FusionCharts("../fusionII/charts/MSColumn3D.swf", "myColumn", "500", "330"); 
			myColumn.setDataXML("<?=$_xmlColumn?>"); 
			myColumn.render("chart1");
			myColumn.addEventListener( "nodatatodisplay", function() { 
									if ( window.windowIsReady ){
										notifyLocalAJAXSecurityRestriction(); 
									}else
									{
										$(document).ready (function(){
											notifyLocalAJAXSecurityRestriction();
										});
									}
								});
			
			var myPie = new FusionCharts("../fusionII/charts/Pie3D.swf", "myPie", "550", "330"); 
			myPie.setDataXML("<?=$_xmlPie?>");
			myPie.render("chart2");
			myColumn.addEventListener( "nodatatodisplay", function() { 
									if ( window.windowIsReady ){
										notifyLocalAJAXSecurityRestriction(); 
									}else
									{
										$(document).ready (function(){
											notifyLocalAJAXSecurityRestriction();
										});
									}
								});
		</script>
	<? } else {echo "<br/><br/><center><font color='red'>ไม่พบข้อมูลในรายการที่ท่านเลือก</font></center>";} ?>
<? } //end if select data?>
</div>

