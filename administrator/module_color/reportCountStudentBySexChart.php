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
		<span class="normal"><font color="#0066FF"><strong>4.2 แผนภูมิจำนวนนักเรียนตามคณะสี</strong></font></span></td>
	  <td width="300px">
		<?php
				if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
				if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
			?>
			ปีการศึกษา<?php  
						echo "<a href=\"index.php?option=module_color/reportCountStudentBySexChart&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
						echo '<font color=\'blue\'>' .$acadyear . '</font>';
						echo " <a href=\"index.php?option=module_color/reportCountStudentBySexChart&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
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
	$_sql = "select color,count(id) as 'cc' from students
			where xedbe = '" . $acadyear . "' " . ($_POST['studstatus']=="1,2"?" and studstatus in (1,2) ":"") . "
			group by color order by color desc";
	$_result = mysql_query($_sql);
	if(mysql_num_rows($_result)>0) { ?>
		<table class="admintable" width="100%"  border="0" align="center" >
			<tr>
				<th align="center" >
					<img src="../images/school_logo.gif" width="120px"><br/>
					แผนภูมิจำนวนนักเรียนตามคณะสี<br/>
					ประจำปีการศึกษา <?=$acadyear?>
					<br/>
				</th>
			</tr>
			<tr> 
				<td align="center">
				<?php
					$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
					$_xmlPie = "<?xml version='1.0' encoding='UTF-8' ?>" ;
					$_xmlPie .= "<graph caption='ยอดนักเรียนทั้งหมด' decimalPrecision='0' showPercentageValues='1' showNames='1'  showValues='1'  pieYScale='65' pieSliceDepth='25' pieRadius='100'>";
					
					$_strXML = $_strXML . "<graph caption='' xAxisName='คณะสี' yAxisName='Units' formatNumberScale='0' decimalPrecision='0'>";
					$_catXML = "<categories>";
					$_setA = "<dataset seriesname='คณะสี'  showValue='1'>";
					
					while($_dat = mysql_fetch_assoc($_result)) {
						$_catXML .= "<category name='" . (strlen($_dat['color'])>2?$_dat['color']:"ไม่ระบุ") . "' hoverText=''/>";
						$_setA .= "<set value='" . $_dat['cc'] . "' color= " . getColor($_dat['color']) . " />";
						$_xmlPie .= "<set value='" . $_dat['cc'] . "' name='" . (strlen($_dat['color'])>2?$_dat['color']:"ไม่ระบุ") . "' color= " . getColor($_dat['color']) . " />";
					} //end-while
					$_catXML .= "</categories>";
					$_setA .= "</dataset>";
					$_strXML .= $_catXML . $_setA . "</graph>";
					echo renderChart("../fusion/Charts/FCF_MSColumn3D.swf", "", $_strXML , "absent", 400, 300);
					$_xmlPie .= "</graph>";
			?>
				</td>
			</tr>
			<tr>
				<td align="center">
					<div id="pie3D"></div>
					<script language="javascript" type="text/javascript">
						var myPie = new FusionCharts("../fusion/Charts/FCF_Pie3D.swf", "myPie", "600", "300"); 
							myPie.setDataXML("<?=$_xmlPie?>");
							myPie.render("pie3D");
					</script>
				</td>
			</tr>
		</table>
		<?php
	} else { ?> <br/><br/><center><font color="red">ไม่พบข้อมูลที่ต้องการ</font></center> <? } ?>
</div>
<? 
	function getColor($_value){
		//$_color = array('#FFFF00','#33CC33','#FF9900','#9966CC','#FF99CC','#000000');
		switch($_value){
			case "เหลือง" : return  "'#FFFF00'"; break;
			case "เขียว" : return  "'#33CC33'"; break;
			case "ส้ม" : return  "'#FF9900'"; break;
			case "ม่วง" : return  "'#9966CC'"; break;
			case "ชมพู" : return  "'#FF99CC'"; break;
			default : return "'#000000'";
		}
	}
?>