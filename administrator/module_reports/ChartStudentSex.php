
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_reports/index">
			<img src="../images/chart.png" alt="" width="48px" border="0" />
		</a>
	  </td>
      <td width="55%"><strong><font color="#990000" size="4">ระบบรายงาน/สถิติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.1 แผนภูมิแสดงสถิตินักเรียนตามเพศ และระดับชั้น</strong></font></span></td>
      <td >
	  	<form method="post" name="myform">
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_reports/ChartStudentSex&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_reports/ChartStudentSex&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		<br/>
		<font color="#000000" size="2">
			<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> onclick="document.myform.submit();" />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		</font>
		</form>
	  </td>
    </tr>
  </table>
<?php
	$_sql = "select xlevel,
				  sum(if(sex = 1,1,null)) as male,
				  sum(if(sex = 2,1,null)) as female
				from students where xedbe = '" . $acadyear . "' ";
	if($_POST['studstatus']=="1,2") $_sql .=" and studstatus in (1,2) ";
	$_sql .= " group by xlevel";
	$_result = mysql_query($_sql);
	if(mysql_num_rows($_result)>0)
	{
		$_xmlColumn = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlPie = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlColumn .= "<graph caption='' xAxisName='ระดับการศึกษา' yAxisName='Person' formatNumberScale='0' decimalPrecision='0' yaxismaxvalue='250' >";
		$_xmlPie .="<graph caption='' decimalPrecision='0' showPercentageValues='1' showNames='1'  showValues='1'  pieYScale='65' pieSliceDepth='25' pieRadius='100'>";
		
		$_catXML = "<categories>";
		$_setA = "<dataset seriesname='ชาย'  showValue='1'>";
		$_setB = "<dataset seriesname='หญิง' showValue='1'>";
		$_m = 0;
		$_f = 0;
		while($_dat = mysql_fetch_assoc($_result))
		{
			$_catXML .= "<category name='" . ($_dat['xlevel']==3?"ม.ต้น":"ม.ปลาย") . "' hoverText=''/>";
			$_setA .= "<set value='" . $_dat['male'] . "' color = '" . getFCColor() . "' />";
			$_setB .= "<set value='" . $_dat['female'] . "' color = '" . getFCColor() . "' />";
			$_m += $_dat['male'];
			$_f += $_dat['female'];
		}
		$_catXML .= "</categories>";
		$_setA .= "</dataset>";
		$_setB .= "</dataset>";
		$_xmlColumn .= $_catXML . $_setA . $_setB  . "</graph>";
		
		$_xmlPie .= "<set value='" . $_m . "' name='นักเรียนชาย' color='" . getFCColor() . "'/>";
		$_xmlPie .= "<set value='" . $_f . "' name='นักเรียนหญิง' color='" . getFCColor() . "'/>";
		$_xmlPie .= "</graph>";
		
?>
		<table class="admintable" width="100%" align="center" >
			<tr>
				<th colspan="2" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>แผนภูมิแสดงจำนวนนักเรียน
					<br/>ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
					<br/>
				</th>
			</tr>
			<tr>
				<td width="50%"><div id="chart1" align="center" ></div></td>
				<td><div id="chart2" align="center" ></div></td>
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
		</script> <? }  //end - if
	else
	{  }?>
	
</div>
