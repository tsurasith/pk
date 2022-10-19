

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.5 แสดงสถิติร้อยละการไม่ลงชื่อเข้าสอนรายเดือนในแต่ละปีการศึกษา</strong></font></span></td>
      <td>
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_learn/xChartMonthUnsign&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_learn/xChartMonthUnsign&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
	  </td>
    </tr>
  </table>
	<?	$sqlStudent = "select month(check_date) as 'month',year(check_date) as 'year',
				count(distinct check_date) as 'day',
				sum(if(stutus = 'unsign',1,0)) as 'x',
				count(period) as 'all',
				100*sum(if(stutus = 'unsign',1,0))/count(period) as 'px'
			from teachers_learn where acadyear = '" . $acadyear . "'
			group by month(check_date) order by year(check_date),month(check_date)"; ?>

	<? $resStudent = mysql_query($sqlStudent); ?>
	<? if(mysql_num_rows($resStudent)>0) { ?>
		<table class="admintable" width="100%">
			<tr>
				<th align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>รายงานสรุปร้อยละการไม่ลงชื่อเข้าสอน
					<br/>ปีการศึกษา <?=$acadyear?><br/>
				</th>
			</tr>
			<tr><td align="center"><div id="chart1" align="center" ></div></td></tr>
			<tr>
				<td align="center">
					<? $_scale = 20; ?>
					<? $_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ; ?>
					<? $_strXML .= "<graph caption='' yAxisName='Units' decimalPrecision='2' formatNumberScale='0' yAxisMaxValue='" . $_scale ."' >"; ?>
					<table class="admintable">
						<tr>
							<td class="key" align="center" width="150px">เดือน</td>
							<td class="key" align="center" width="90px">จำนวนวัน<br/>ที่มีเรียน</td>
							<td class="key" align="center" width="100px">ไม่ลงชื่อ(ครั้ง)</td>
							<td class="key" align="center" width="140px">จำนวนคาบสอน<br/>ทั้งหมด(ครั้ง)</td>
							<td class="key" align="center" width="70px">ร้อยละ</td>
						</tr>
						<? $_day=0; $_x=0; $_all=0; ?>
						<? while($dat = mysql_fetch_assoc($resStudent)) { ?>
							<tr>
								<td align="left" style="padding-left:15px;"><?=displayMonth($dat['month']) . ' ' . ($dat['year']+543)?></td>
								<td align="right" style="padding-right:35px;"><?=$dat['day']?></td>
								<td align="right" style="padding-right:10px;"><?=$dat['x']==0?"-":number_format($dat['x'],0,'',',')?></td>
								<td align="right" style="padding-right:10px;"><?=$dat['all']==0?"-":number_format($dat['all'],0,'',',')?></td>
								<td align="right" style="padding-right:15px;"><?=$dat['all']==0?"-":number_format($dat['px'],2,'.',',')?></td>
							</tr>
							<? $_strXML .= "<set name='" . (displayShortMonth($dat['month']). ' '. substr(($dat['year']+543),2,2)) . "' value='" . number_format($dat['px'],2,'.',',') . "' color='" . getFCColor()  . "' /> "; ?>
						<? } //end while ?>
					</table>
					<? $_strXML = $_strXML . "</graph>"; ?>
					<script language="javascript" type="text/javascript">
					
						FusionCharts.setCurrentRenderer('JavaScript');
						var myColumn = new FusionCharts("../fusionII/charts/Column3D.swf", "myColumn", "600", "330");
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
			<tr><td><br/><u>หมายเหตุ</u>: แกน X คือ เดือน และ แกน Y คือ จำนวนครั้ง</td></tr>
</table>
	<? } else { echo "<br/><br/><center><font color='red'>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</font></center>"; } ?>
</div>
<?php
	function txtCheck($id) {
		switch ($id) {
			case "00" :  return "มา"; break;
			case "01" :  return "ทำกิจกรรม"; break;
			case "02" :  return "มาสาย"; break;
			case "03" :  return "ลา"; break;
			case "04" :  return "ขาด"; break;
			default :  return "ไม่ระบุ";
		}	
	}
?>