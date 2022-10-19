

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.2 แสดงจำนวนนักเรียนที่เข้าห้องเรียนสาย<br/> แยกตามระดับชั้น [รายภาคเรียน]</strong></font></span></td>
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
					echo "<a href=\"index.php?option=module_learn/xChartLevelSemester&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_learn/xChartLevelSemester&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_learn/xChartLevelSemester&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_learn/xChartLevelSemester&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
	  </td>
    </tr>
  </table>
  <br/>
  <table cellpadding="1" cellspacing="1" border="0" align="center" width="100%">
	<?php
			$sqlStudent = "select substr(class_id,1,1) as class_id,count(timecheck_id) as late from student_learn
								where acadyear = '" . $acadyear . "' and acadsemester = '". $acadsemester . "' and timecheck_id = '02'
								group by substr(class_id,1,1)
								order by class_id";
			$resStudent = mysql_query($sqlStudent);
			@$totalRows = mysql_num_rows($resStudent);
			if($totalRows < 1)
			{
				echo "<tr><td align='center'><font color='red'> <br/>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก </font></td></tr>";
			}
			else
			{
	?>	
    <tr > 
		<th align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>แผนภูมิการเข้าห้องเรียนสายของนักเรียน
		<br/>ประจำภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
		<br/>
				<?php
					$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
					$_strXML = $_strXML . "<graph xAxisName='ระดับชั้น' yAxisName='Units' decimalPrecision='0' formatNumberScale='0'>";
					while($dat = mysql_fetch_assoc($resStudent))
					{
						$_strXML .= " <set name='ม." . $dat['class_id'] . "' value='" . $dat['late'] . "' color='" . getFCColor()  . "' /> ";
					}
					$_strXML = $_strXML . "</graph>";
					FC_SetRenderer( "javascript" );
					echo renderChart("../fusionII/charts/Column3D.swf", "", $_strXML , "absent", 650, 450);
					//echo $_strXML ;
				?>
		</th>
    </tr>
	<?php
	  }//ปิด if-else ตรวจสอบข้อมูลในฐานข้อมูล
	?>
</table>

</div>

