<?php
	include("../fusion/Includes/FusionCharts.php");
	include("../fusion/Includes/FC_Colors.php");
?>
<SCRIPT LANGUAGE="Javascript" type="text/javascript" SRC="../fusion/Charts/FusionCharts.js"></SCRIPT>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_reports/index">
			<img src="../images/chart.png" alt="" width="48px" border="0" />
		</a>
	  </td>
      <td ><strong><font color="#990000" size="4">ระบบรายงาน/สถิติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>ระบบสารสนเทศ รายงาน สถิติการวิเคราะห์</strong></font></span></td>
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
					echo "<a href=\"index.php?option=module_reports/ChartStudentSexStatus&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo "<a href=\"index.php?option=module_reports/ChartStudentSexStatus&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
	  </td>
    </tr>
  </table>
<?php
	$_sql = "select b.studstatus_description, sum(if(sex = 1,1,0)) as male, sum(if(sex = 2,1,0)) as female, count(a.studstatus) as xx
				from students a left outer join ref_studstatus b on a.studstatus = b.studstatus
				where a.xedbe = '" .$acadyear . "'
				group by a.studstatus
				order by male desc";
	$_result = mysql_query($_sql);
	if(mysql_num_rows($_result)>0)
	{
		$_xmlColumn = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlPie = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlColumn .= "<graph caption=''  yAxisName='Person' formatNumberScale='0' decimalPrecision='0' yaxismaxvalue='400' >";
		$_xmlPie .="<graph caption='' decimalPrecision='0' showPercentageValues='1' showNames='1'  showValues='1'  pieYScale='100' pieSliceDepth='20' pieRadius='100'>";
		
		$_catXML = "<categories>";
		$_setA = "<dataset seriesname='ชาย'  showValue='1'>";
		$_setB = "<dataset seriesname='หญิง' showValue='1'>";
		$_m = 0;
		$_f = 0;
		while($_dat = mysql_fetch_assoc($_result))
		{
			$_color = getFCColor() ;
			$_catXML .= "<category name='" . $_dat['studstatus_description'] . "' hoverText=''/>";
			$_setA .= "<set value='" . $_dat['male'] . "' color = '" . $_color . "' />";
			$_setB .= "<set value='" . $_dat['female'] . "' color = '" . $_color . "' />";
			$_xmlPie .= "<set value='" . $_dat['xx'] . "' name='" . $_dat['studstatus_description'] . "' color='" . $_color . "'/>";
		}
		$_catXML .= "</categories>";
		$_setA .= "</dataset>";
		$_setB .= "</dataset>";
		$_xmlColumn .= $_catXML . $_setA . $_setB  . "</graph>";
		$_xmlPie .= "</graph>";

?>
		<table class="admintable" width="100%" align="center" >
			<tr>
				<td class="key" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>
					สารสนเทศเกี่ยวกับนักเรียน<br/>
					ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
				</td>
			</tr>
			<tr>
				<td><div id="chart2" align="center" ></div></td>
			</tr>
			<tr>
				<td><div id="chart1" align="center" ></div></td>
			</tr>
		</table>
		<script language="javascript" type="text/javascript">
			var myColumn = new FusionCharts("../fusion/Charts/FCF_MSColumn3D.swf", "myColumn", "500", "450"); 
			myColumn.setDataXML("<?=$_xmlColumn?>"); 
			myColumn.render("chart1");
			
			var myPie = new FusionCharts("../fusion/Charts/FCF_Pie3D.swf", "myPie", "600", "350"); 
			myPie.setDataXML("<?=$_xmlPie?>");
			myPie.render("chart2");
		</script> <? }  //end - if
	else
	{  }?>
	
</div>
