

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.7 แผนภูมิแสดงเปรียบเทียบร้อยละในแต่ละเดือน 2 ปีการศึกษา<br/>ของการเข้าร่วมกิจกรรมหน้าเสาธง</strong></font></span></td>
      <td >
		<? if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; } ?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_800/reportAcadyearMonthCompareChart&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportAcadyearMonthCompareChart&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		
		<form action="" method="post">
			<font color="#000000" size="2" >
			การเข้าร่วมกิจกรรม 
				<select name="check" class="inputboxUpdate">
					<option></option>
					<option value="01" <?=isset($_POST['check'])&&$_POST['check']=='01'?"selected":""?>> กิจกรรม </option>
					<option value="02" <?=isset($_POST['check'])&&$_POST['check']=='02'?"selected":""?>> สาย </option>
					<option value="03" <?=isset($_POST['check'])&&$_POST['check']=='03'?"selected":""?>> ลา </option>
					<option value="04" <?=isset($_POST['check'])&&$_POST['check']=='04'?"selected":""?>> ขาด </option>
				</select>  <input type="submit" name="search" value="เรียกดู" class="button" /><br/>
				<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
				เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา</font>
		</form>
	  </td>
    </tr>
  </table>

<? if(isset($_POST['search']) && $_POST['check'] == ""){ ?>
		<br/><br/><center><font color="#FF0000">กรุณาเลือก รายการ การเข้าร่วมกิจกรรมหน้าเสาธงก่อน</font></center>
<? } //end if ?>

<? if(isset($_POST['search']) && $_POST['check'] != ""){ ?>
	<?	$sqlStudent = "select month(check_date) as 'month',
				sum(if(timecheck_id = '".$_POST['check']."' && acadyear = ".($acadyear-1)." && xedbe = ".($acadyear-1).",1,0)) as 'x',
				100*sum(if(timecheck_id = '".$_POST['check']."' && acadyear = ".($acadyear-1)." && xedbe = ".($acadyear-1).",1,0))/sum(if(acadyear=".($acadyear-1)." && xedbe = ".($acadyear-1).",1,0)) as 'px',
				sum(if(timecheck_id = '".$_POST['check']."' && acadyear = ".$acadyear." && xedbe = ".$acadyear.",1,0)) as 'y',
				100*sum(if(timecheck_id = '".$_POST['check']."' && acadyear = ".$acadyear." && xedbe = ".$acadyear.",1,0))/sum(if(acadyear=".$acadyear." && xedbe = ".$acadyear.",1,0)) as 'py'
			from student_800 right outer join students on (student_id = id)
			where xedbe in (".($acadyear-1).",".$acadyear.") and acadyear in (".($acadyear-1).",".$acadyear.")"; ?>
	<?  $sqlStudent .= ($_POST['studstatus']=="1,2"?" and studstatus in (1,2) ":"") ; ?>
	<?  $sqlStudent .= " group by month(check_date) order by year(check_date),month(check_date)"; ?>

	<? $resStudent = mysql_query($sqlStudent); ?>
	<? if(mysql_num_rows($resStudent)>0) { ?>
		<table class="admintable" width="100%">
			<tr>
				<th align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>รายงานเปรียบเทียบร้อยละการ<?=displayTimecheck($_POST['check'])?> การเข้าร่วมกิจกรรมหน้าเสาธง
					<br/>ในแต่ละเดือนระหว่างปีการศึกษา <?=$acadyear-1?> - <?=$acadyear?><br/>
				</th>
			</tr>
			<tr><td align="center"><div id="chart1" align="center" ></div></td></tr>
			<tr>
				<td align="center">
					<? $_scale = ($_POST['check']=="04"?15:5); ?>
					<? $_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ; ?>
					<? $_strXML .= "<graph caption='' yAxisName='Units' decimalPrecision='2' formatNumberScale='0' yAxisMaxValue='" . $_scale ."' >"; ?>
					<? $_catXML = "<categories>"; ?>
					<? $_setA = "<dataset seriesname='" . ($acadyear-1) . "'  showValue='1'>"; ?>
					<? $_setB = "<dataset seriesname='" . $acadyear . "' showValue='1'>"; ?>
					<table class="admintable">
						<tr>
							<td class="key" align="center" width="150px" rowspan="2">เดือน</td>
							<td class="key" align="center" colspan="2">ปีการศึกษา <?=$acadyear-1?></td>
							<td class="key" align="center" colspan="2">ปีการศึกษา <?=$acadyear?></td>
						</tr>
						<tr>
							<td class="key" align="center" width="100px">รวม<?=displayTimecheck($_POST['check'])?>(ครั้ง)</td>
							<td class="key" align="center" width="70px">ร้อยละ</td>
							<td class="key" align="center" width="100px">รวม<?=displayTimecheck($_POST['check'])?>(ครั้ง)</td>
							<td class="key" align="center" width="70px">ร้อยละ</td>
						</tr>
						<? while($dat = mysql_fetch_assoc($resStudent)) { ?>
							<tr>
								<td align="left" style="padding-left:15px;"><?=displayMonth($dat['month'])?></td>
								<td align="right" style="padding-right:10px;"><?=$dat['x']==0?"-":number_format($dat['x'],0,'',',')?></td>
								<td align="right" style="padding-right:10px;"><?=$dat['px']==0?"-":number_format($dat['px'],2,'.',',')?></td>
								<td align="right" style="padding-right:10px;"><?=$dat['y']==0?"-":number_format($dat['y'],0,'.',',')?></td>
								<td align="right" style="padding-right:10px;"><?=$dat['py']==0?"-":number_format($dat['py'],2,'.',',')?></td>
							</tr>
							<? $_color = getFCColor(); ?>
							<? $_catXML .= "<category name='" . displayMonth($dat['month']) . "' hoverText=''/>"; ?>
							<? $_setA .= "<set value='" . ($dat['px']>0?$dat['px']:0) . "' color = '" . $_color . "' />"; ?>
							<? $_setB .= "<set value='" . ($dat['py']>0?$dat['py']:0) . "' color = '" . $_color . "' />"; ?>
						<? } //end while ?>
					</table>
					<? $_catXML .= "</categories>"; ?>
					<? $_setA .= "</dataset>"; ?>
					<? $_setB .= "</dataset>"; ?>
					<? $_strXML .= $_catXML . $_setA . $_setB  . "</graph>"; ?>
					<script language="javascript" type="text/javascript">
						FusionCharts.setCurrentRenderer('JavaScript');
						var myColumn = new FusionCharts("../fusionII/charts/MSColumn3D.swf", "myColumn", "650", "330");
						myColumn.setDataXML("<?=$_strXML?>");
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
					</script>
				</td>
			</tr>
			<tr><td><br/><u>หมายเหตุ</u>: แกน X คือ เดือน และ แกน Y คือ ร้อยละ</td></tr>
</table>
	<? } else { echo "<br/><br/><center><font color='red'>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</font></center>"; } ?>
<? }//end if ตรวจสอบการคลิ๊กเลือกรายการ ?>
</div>


