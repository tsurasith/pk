

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.6 แสดงสถิติของครูผู้สอนที่ไม่ลงชื่อเปรียบเทียบในแต่ละภาคเรียน</strong></font></span></td>
      <td >
		ปีการศึกษา <?=$acadyear?>
		ภาคเรียนที่ <?=$acadsemester?>
	  </td>
    </tr>
  </table>
  <br/>
  <table cellpadding="1" cellspacing="1" border="0" align="center" width="100%">
	<?php
			$sqlStudent = "select acadyear,acadsemester,count(stutus) as late
							from teachers_learn
							where stutus = 'unsign'
							group by acadyear,acadsemester
							order by acadyear,acadsemester";
			$resStudent = mysql_query($sqlStudent);
			@$totalRows = mysql_num_rows($resStudent);
			if($totalRows < 1)
			{
				echo "<tr><td style='padding-left:35px'><font color='red'><b><br/><br/>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</b></font></td></tr>";
			}
			else
			{
	?>	
    <tr > 
		<th align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>แผนภูมิเปรียบเทียบการไม่ลงชื่อเข้าสอน
		<br/>ระหว่างภาคเรียน
		<br/>
				<?php
					$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
					$_strXML = $_strXML . "<graph caption='' xAxisName='ภาคเรียน/ปีการศึกษา' yAxisName='Units' decimalPrecision='0' formatNumberScale='0'>";
					while($dat = mysql_fetch_assoc($resStudent))
					{
						$_strXML .= " <set name='" . $dat['acadsemester'].'/'.$dat['acadyear'] . "' value='" . $dat['late'] . "' color='" . getFCColor()  . "' /> ";
					}
					$_strXML = $_strXML . "</graph>";
					FC_SetRenderer("javascript");
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

