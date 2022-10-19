

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_reports/index">
			<img src="../images/chart.png" alt="" width="48px" border="0" />
		</a>
	  </td>
      <td ><strong><font color="#990000" size="4">ระบบรายงาน/สถิติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.3.2 รายงานแสดงจำนวนห้องเรียน นักเรียนตามระดับชั้นและเพศ</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_reports/ReportRoomSexLevel&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_reports/ReportRoomSexLevel&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		<br/>
		<font size="2" color="#000000">
		<form method="post" name="myform">
			<input type="checkbox" name="studstatus" value="1,2"
				onclick="document.myform.submit()" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา 
		</form>
		</font>
	  </td>
    </tr>
  </table>
<?php
	$_sql = "select xlevel,xyearth, count(distinct room) as room, sum(if(sex=1,1,0)) as male, sum(if(sex=2,1,0)) as female,
				  count(id) as total from students where xedbe = '" . $acadyear . "' ";
	if($_POST['studstatus']=="1,2") { $_sql .= " and studstatus in (1,2) ";}
	$_sql .= " group by xlevel,xyearth ";
	$_result = mysql_query($_sql);
	if(mysql_num_rows($_result)>0) {
		$_xmlColumn = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlPie = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlColumn .= "<graph caption='' formatNumberScale='0' decimalPrecision='0' yaxismaxvalue='100' >";
		$_xmlPie .="<graph caption='' decimalPrecision='0' showPercentageValues='1' showNames='1'  showValues='1'  pieYScale='65' pieSliceDepth='25' pieRadius='100'>";
		
		$_xmlLevel = "<?xml version='1.0' encoding='UTF-8' ?>" . "<graph caption='' formatNumberScale='0' decimalPrecision='0' yaxismaxvalue='200' >";
		$_xmlLevelPie = "<?xml version='1.0' encoding='UTF-8' ?>" . "<graph decimalPrecision='0' showPercentageValues='1' showNames='1'  showValues='1'  pieYScale='65' pieSliceDepth='25' pieRadius='100'>";
		
		$_catXML = "<categories>";
		$_setA = "<dataset seriesname='ชาย'  showValue='1' color='FF0000'>";
		$_setB = "<dataset seriesname='หญิง' showValue='1' color='00CCFF'>";
		$_m = 0;
		$_f = 0; ?>
		
		<table class="admintable" width="100%" align="center" >
			<tr>
				<th colspan="7" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>
					สารสนเทศแสดงจำนวนห้องเรียน นักเรียนจำแนกตามเพศและระดับชั้น<br/>
					ปีการศึกษา <?=$acadyear?>
				</th>
			</tr>
			<tr>
				<td rowspan="2" width="100px">&nbsp;</td>
				<td rowspan="2" align="center" width="250px" class="key">ระดับชั้น</td>
				<td rowspan="2" align="center" width="70px" class="key">จำนวน<br/>ห้องเรียน</td>
				<td colspan="3" align="center" class="key">จำนวนนักเรียนทั้งหมด</td>
				<td rowspan="2" width="100px">&nbsp;</td>
			</tr>
			<tr>
				<td align="center" class="key">ชาย</td>
				<td align="center" class="key">หญิง</td>
				<td align="center" class="key">รวม</td>
			</tr>
			<? $_room = 0 ?>
			<? while($_dat = mysql_fetch_assoc($_result)){ ?>
			<tr>
			    <td>&nbsp;</td>
				<td align="center">ชั้นมัธยมศึกษาปีที่ <?=$_dat['xlevel']==3?$_dat['xyearth']:($_dat['xyearth']+3)?></td>
				<td align="center"><?=$_dat['room']?></td>
				<td align="right" style="padding-right:25px"><?=$_dat['male']?></td>
				<td align="right" style="padding-right:25px"><?=$_dat['female']?></td>
				<td align="right" style="padding-right:25px"><?=$_dat['total']?></td>
				<td>&nbsp;</td>
			<? 
			$_catXML .= "<category name='ม." . ($_dat['xlevel']==3?$_dat['xyearth']:($_dat['xyearth']+3)) . "' hoverText=''/>";
			$_setA .= "<set value='" . $_dat['male'] . "'  />";
			$_setB .= "<set value='" . $_dat['female'] . "'  />";
			$_color = getFCColor();
			$_xmlLevel .= "<set name='ม." . ($_dat['xlevel']==3?$_dat['xyearth']:($_dat['xyearth']+3)) . "' value='" . $_dat['total'] . "' color='" . $_color  . "' /> ";
			$_xmlLevelPie .= "<set name='ชั้นม." . ($_dat['xlevel']==3?$_dat['xyearth']:($_dat['xyearth']+3)) . "' value='" . $_dat['total'] . "' color='" . $_color  . "' /> ";
			
			$_m += $_dat['male'];
			$_f += $_dat['female'];
			$_room += $_dat['room']; ?>
			</tr>
			<? } //end while?>
			<tr height="30px">
				<td>&nbsp;</td>
				<td align="center" class="key"><b>รวม</b></td>
				<td align="center" class="key"><b><?=$_room?></b></td>
				<td align="right" style="padding-right:25px" class="key"><b><?=number_format($_m,0,'',',')?></b></td>
				<td align="right" style="padding-right:25px" class="key"><b><?=number_format($_f,0,'',',')?></b></td>
				<td align="right" style="padding-right:25px" class="key"><b><?=number_format($_m+$_f,0,'',',')?></b></td>
				<td>&nbsp;</td>
			</tr>
		</table>
	<?	$_catXML .= "</categories>";
		$_setA .= "</dataset>";
		$_setB .= "</dataset>";
		$_xmlColumn .= $_catXML . $_setA . $_setB  . "</graph>";
		
		$_xmlLevel .= "</graph>";
		$_xmlLevelPie.="</graph>";
		
		$_xmlPie .= "<set value='" . $_m . "' name='นักเรียนชาย' color='FF0000'/>";
		$_xmlPie .= "<set value='" . $_f . "' name='นักเรียนหญิง' color='00CCFF'/>";
		$_xmlPie .= "</graph>";
		
?>		
		<table class="admintable" width="100%" align="center" >
			<tr>
				<td width="50%"><div id="chart1" align="center" ></div></td>
				<td><div id="chart2" align="center" ></div></td>
			</tr>
			<tr>
			  <td><div id="chart3" align="center" ></div></td>
			  <td><div id="chart4" align="center" ></div></td>
		  </tr>
		</table>
		<script language="javascript" type="text/javascript">
			FusionCharts.setCurrentRenderer('JavaScript');
			var myColumn = new FusionCharts("../fusionII/charts/MSColumn3D.swf", "myColumn", "360", "300"); 
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
			
			var myPie = new FusionCharts("../fusionII/charts/Pie3D.swf", "myPie", "360", "250"); 
			myPie.setDataXML("<?=$_xmlPie?>");
			myPie.render("chart2");
			myPie.addEventListener( "nodatatodisplay", function() { 
									if ( window.windowIsReady ){
										notifyLocalAJAXSecurityRestriction(); 
									}else
									{
										$(document).ready (function(){
											notifyLocalAJAXSecurityRestriction();
										});
									}
								});
			
			var myColumn = new FusionCharts("../fusionII/charts/Column3D.swf", "myColumn2", "360", "300"); 
			myColumn.setDataXML("<?=$_xmlLevel?>"); 
			myColumn.render("chart3");
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
			
			var myColumn = new FusionCharts("../fusionII/charts/Pie3D.swf", "myColumn2", "360", "300"); 
			myColumn.setDataXML("<?=$_xmlLevelPie?>"); 
			myColumn.render("chart4");
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
			
		</script> <? }  //end - if
	else { echo "<br/><br/><center><font color='red'>ยังไม่มีข้อมูลในรายการที่ท่านเลือก</font></center>"; }?>
	
</div>
