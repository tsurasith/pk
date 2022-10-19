

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_reports/index">
			<img src="../images/chart.png" alt="" width="48px" border="0" />
		</a>
	  </td>
      <td><strong><font color="#990000" size="4">ระบบรายงาน/สถิติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.6.7 สารสนเทศนักเรียนตามรายวิชาที่ชอบ/ไม่ชอบ<br/> ถนัด/ไม่ถนัด</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_reports/ReportHistorySubject&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_reports/ReportHistorySubject&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		<br/>
		<font color="#000000" size="2"  >
		<form method="post">
			วิชา 
			<select name="subject" class="inputboxUpdate">
				<option value=""></option>
				<option value="subject_like" <?=isset($_POST['subject'])&&$_POST['subject']=="subject_like"?"selected":""?>>ชอบ/ถนัด</option>
				<option value="subject_hate" <?=isset($_POST['subject'])&&$_POST['subject']=="subject_hate"?"selected":""?>>ไม่ชอบ/ไม่ถนัด</option>
			</select>
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
			<input type="submit" value="เรียกดู" name="search" class="button" /><br/>
			<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		</form>
		</font>
	  </td>
    </tr>
  </table>  
<? if(isset($_POST['search']) && ($_POST['roomID'] =="" || $_POST['subject'] == "")) { ?>
	<? echo "<br/><br/><center><font color='red'>กรุณาเลือก ระดับชั้น และ ประเภทวิชา ที่ต้องการทราบข้อมูลก่อน</font></center>";} ?>	
<? if(isset($_POST['search']) && $_POST['roomID'] != "" && $_POST['subject'] != ""){ ?>
	<? $_sql = "select " . $_POST['subject'] . " as 'subject',
				  sum(if(sex=1,1,0)) as 'male',
				  sum(if(sex=2,1,0)) as 'female',
				  count(*) as 'total'
				from students
				where xedbe = '" . $acadyear . "' "; ?>
	<? $_sqlTotal = "select count(*) as 'xx' from students where xedbe = '" . $acadyear . "' "; ?>
	<? $_sqlTotal .= ($_POST['studstatus']=="1,2"?" and studstatus in (1,2) ":"") ; ?>
	<? $_sqlTotal .= ($_POST['roomID']!="all"?" and xlevel = '" . substr($_POST['roomID'],0,1) . "' and xyearth = '" . substr($_POST['roomID'],2,1) . "'":"");?>
	
	<? $_sql .= ($_POST['studstatus']=="1,2"?" and studstatus in (1,2) ":"") ; ?>
	<? $_sql .= ($_POST['roomID']!="all"?" and xlevel = '" . substr($_POST['roomID'],0,1) . "' and xyearth = '" . substr($_POST['roomID'],2,1) . "'":""); ?>
	<? $_sql .=	" group by " . $_POST['subject'] . " order by count(*) desc"; ?>
	<? $_resTotal = mysql_query($_sqlTotal); ?>
	<? $_x = mysql_fetch_assoc($_resTotal); ?>
	
	<? $_result = mysql_query($_sql); ?>
	<? if(mysql_num_rows($_result)>0){ ?>
	<? $_xmlColumn = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlPie = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlColumn .= "<graph caption='' xAxisName='' yAxisName='Person' formatNumberScale='0' decimalPrecision='0'>";
		$_xmlPie .="<graph caption='' decimalPrecision='0' showPercentageValues='1' showNames='1'  showValues='1'  pieYScale='65' pieSliceDepth='25' pieRadius='100'>";
		
		$_catXML = "<categories>";
		$_setA = "<dataset seriesname='ชาย'  showValue='1'>";
		$_setB = "<dataset seriesname='หญิง' showValue='1'>";
		$_m = 0; $_f = 0; $_s = 0; $_t = 0; ?>
		
		<table class="admintable" width="100%" align="center" >
			<tr>
				<th colspan="2" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>
					สารสนเทศนักเรียนตามวิชาที่ <?=$_POST['subject']=="subject_like"?"ชอบ/ถนัด":"ไม่ชอบ/ไม่ถนัด"?>  
					ชั้นมัธยมศึกษาปีที่ <?=displayXyear($_POST['roomID'])?> <br/>
					ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
					<br/>
				</th>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<table align="center" >
						<tr>
							<td class="key" rowspan="2" align="center" width="220px">วิชา</td>
							<td class="key" colspan="2" align="center" width="180px">จำนวนนักเรียน(คน)</td>
							<td class="key" rowspan="2" align="center" width="100px">รวม</td>
							<td class="key" rowspan="2" align="center" width="100px">ร้อยละ</td>
						</tr>
						<tr>
							<td class="key" align="center">ชาย</td>
							<td class="key" align="center">หญิง</td>
						</tr>
							<? while($_dat = mysql_fetch_assoc($_result)) { ?>
								<? $_catXML .= "<category name='" . ($_dat['subject']==""?"ไม่ระบุ":$_dat['subject']) . "' hoverText=''/>"; ?>
								<? $_color = getFCColor(); ?>
								<? $_setA .= "<set value='" . $_dat['male'] . "' color = '" . $_color . "' />"; ?>
								<? $_setB .= "<set value='" . $_dat['female'] . "' color = '" . $_color . "' />"; ?>
								<? $_xmlPie .= "<set value='" . ($_dat['male']+$_dat['female']) . "' name='" .($_dat['subject']==""?"ไม่ระบุ":$_dat['subject']). "' color='" . $_color . "'/>"; ?>
								<? $_m += $_dat['male']; $_f +=$_dat['female']; $_t += $_dat['total']; ?>
								<tr>
									<td align="left" style="padding-left:15px;"><?=$_dat['subject']==""?"ไม่ระบุ":$_dat['subject']?></td>
									<td align="right" style="padding-right:20px;"><?=$_dat['male']==0?"-":number_format($_dat['male'],0,'',',')?></td>
									<td align="right" style="padding-right:20px;"><?=$_dat['female']==0?"-":number_format($_dat['female'],0,'',',')?></td>
									<td align="right" style="padding-right:20px;"><?=$_dat['total']==0?"-":number_format($_dat['total'],0,'',',')?></td>
									<td align="right" style="padding-right:20px;"><?=$_dat['total']==0?"-":number_format(($_dat['total']/$_x['xx'])*100,2,'.',',')?></td>
								</tr>
							<? } ?>
						<tr>
							<td class="key" align="center">รวม</td>
							<td class="key" align="right" style="padding-right:20px;"><?=number_format($_m,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:20px;"><?=number_format($_f,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:20px;"><?=number_format($_t,0,'',',')?></td>
							<td class="key" align="right" style="padding-right:20px;"><?=number_format(100*$_t/$_x['xx'],2,'.',',')?></td>
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
			  <td><div id="chart2" align="center" ></div></td>
		  </tr>
			<tr>
				<td><div id="chart1" align="center" ></div></td>
				
			</tr>
		</table>
		<script language="javascript" type="text/javascript">
			FusionCharts.setCurrentRenderer('JavaScript');
			var myColumn = new FusionCharts("../fusionII/charts/MSColumn3D.swf", "myColumn", "700", "400"); 
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
								
			var myPie = new FusionCharts("../fusionII/charts/Pie3D.swf", "myPie", "500", "350"); 
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

