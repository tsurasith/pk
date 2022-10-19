<?php
	include("../fusion/Includes/FusionCharts.php");
	include("../fusion/Includes/FC_Colors.php");
?>
<SCRIPT LANGUAGE="Javascript" type="text/javascript" SRC="../fusion/Charts/FusionCharts.js"></SCRIPT>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
	<tr> 
	  <td width="6%" align="center"><a href="index.php?option=module_color/index"><img src="../images/color.png" alt="กิจกรรมคณะสี" width="48" height="48" border="0"/></a></td>
	  <td><strong><font color="#990000" size="4">กิจกรรมคณะสี</font></strong><br />
		<span class="normal"><font color="#0066FF"><strong>4.1 แผนภูมิจำนวนนักเรียนตามคณะสีและเพศ</strong></font></span></td>
	  <td align="right">
		<?  if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
			?>
			ปีการศึกษา<?php  
						echo "<a href=\"index.php?option=module_color/reportCountStudentByColorChart&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
						echo '<font color=\'blue\'>' .$acadyear . '</font>';
						echo " <a href=\"index.php?option=module_color/reportCountStudentByColorChart&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
					?>
			<br/>
		<form method="post" name="myform">
		<font color="#000000"   size="2">
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> onclick="document.myform.submit();" />
			เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		</font>
	  	</form>
	  </td>
	</tr>
</table>
<?php
	$_sql = "select color,
			  sum(if(xlevel=3,1,null)) as 'a',
			  sum(if(xlevel=4,1,null)) as 'b' from students
			where xedbe = '" . $acadyear . "' " . ($_POST['studstatus']=="1,2"?" and studstatus in (1,2) ":"") . "
			group by color order by color desc";
	$_result = mysql_query($_sql);
	if(mysql_num_rows($_result)>0) { ?>
		<table class="admintable" width="100%" cellpadding="1" cellspacing="1" border="0" align="center" >
			<tr>
				<th align="center" >
					<img src="../images/school_logo.gif" width="120px">
					<br/>
					แผนภูมิจำนวนนักเรียนตามคณะสี<br/>
					ประจำปีการศึกษา <?=$acadyear;?>
					<br/>
				</th>
			</tr>
			<tr> 
				<td align="center">
				<?php
					$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
					$_strXML = $_strXML . "<graph caption='' xAxisName='ห้อง' yAxisName='Units' formatNumberScale='0' decimalPrecision='0'>";
					$_catXML = "<categories>";
					
					$_setA = "<dataset seriesname='ม.ต้น' color='FF0000' showValue='1'>";
					$_setB = "<dataset seriesname='ม.ปลาย' color='0000FF' showValue='1'>";
					while($_dat = mysql_fetch_assoc($_result))
					{
						$_catXML .= "<category name='" . (strlen($_dat['color'])>2?$_dat['color']:"ไม่ระบุ") . "' hoverText=''/>";
						$_setA .= "<set value='" . $_dat['a'] . "' />";
						$_setB .= "<set value='" . $_dat['b'] . "' />";
					} //end-while
					$_catXML .= "</categories>";
					$_setA .= "</dataset>";
					$_setB .= "</dataset>";
					$_strXML .= $_catXML . $_setA . $_setB  . "</graph>";
					echo renderChart("../fusion/Charts/FCF_MSColumn3D.swf", "", $_strXML , "absent", 600, 300);
					echo $_strXML;
			?>
				</td>
			</tr>
		</table>
		<?php
	} else { ?> <br/><br/><center><font color="red">ไม่พบข้อมูลที่ต้องการ</font></center> <? } ?>
</div>
