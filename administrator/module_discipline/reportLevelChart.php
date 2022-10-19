<?php
	include("../fusion/Includes/FusionCharts.php");
	include("../fusion/Includes/FC_Colors.php");
?>
<SCRIPT LANGUAGE="Javascript" type="text/javascript" SRC="../fusion/Charts/FusionCharts.js"></SCRIPT>
<div id="content">

  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td width="45%"><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>ระบบบริหารจัดการงานวินัยนักเรียน</strong></font></span></td>
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
					echo "<a href=\"index.php?option=module_discipline/reportLevelChart&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/reportLevelChart&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/reportLevelChart&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/reportLevelChart&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		 <form action="" method="post">
			<select name="level" class="inputboxUpdate">
					<option value="all">- ทุกสถานะการดำเนินการ -</option>
					<option value="0">[0] คดีสอบสวนไม่มีมูล</option>
					<option value="1">[1] รายการแจ้งพฤติกรรมไม่พึงประสงค์</option>
					<option value="2">[2] ดำเนินการสอบสวนแล้ว</option>
					<option value="3">[3] แจ้งบทลงโทษแล้ว</option>
					<option value="4">[4] อยู่ในระหว่างการดำเนินการกำกับ/ติดตาม</option>
					<option value="5">[5] อยู่ระหว่างการพิจารณาของหัวหน้าฝ่าย</option>
					<option value="5">[6] ดำเนินการเสร็จสิ้น/ปิดคดี</option>
			</select><br/> <font color="#000000" size="2">
			<input name="chartType" type="radio" value="column" checked> กราฟแท่ง 
			<input type="radio" value="pie" name="chartType"> กราฟวงกลม
		    <input type="submit" name="search" value="สืบค้น" class="button"/></font>
	    </form></td>
    </tr>
  </table>

<?php
	if(isset($_POST['search']))
	{
		$_sql = "";	
		if($_POST['level'] == "all")
		{
			$_sql = "select xlevel,xyearth,count(student_id) as 'cc'
						 from  student_disciplinestatus
						 left outer join students
						   on student_id = id
						 where acadyear = '". $acadyear ."' and acadsemester = '". $acadsemester . "' 
						 	   and xedbe = '" .$acadyear . "'
						group by xlevel,xyearth
						order by xlevel,xyearth";
		}
		else
		{
			$_sql = "select xlevel,xyearth,count(student_id) as 'cc'
						 from  student_disciplinestatus
						 left outer join students
						   on student_id = id
						 where acadyear = '". $acadyear ."' and acadsemester = '". $acadsemester . "' 
						 	   and xedbe = '" .$acadyear . "' and dis_status = '" . $_POST['level'] . "'
						group by xlevel,xyearth
						order by xlevel,xyearth";
		}
		
		$_res = mysql_query($_sql);
		
					
		$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
		if($_POST['chartType'] == "column")
		{
			$_strXML = $_strXML . "<graph caption='สรุปจำนวนคดีแยกตามระดับชั้น' xAxisName='สถานะ' yAxisName='Units' decimalPrecision='0' formatNumberScale='0' >";
		}
		else
		{
			$_strXML = $_strXML . "<graph caption='สรุปจำนวนคดีแยกตามระดับชั้น' decimalPrecision='0' showNames='1' numberSuffix=' คดี' pieSliceDepth='30' formatNumberScale='0'>";
		}
		
		while($_dat = mysql_fetch_assoc($_res))
		{
			$_level = ($_dat['xlevel']==3)?$_dat['xyearth']:($_dat['xyearth']+3);
			$_level = "ชั้นม. " . $_level;
			$_strXML = $_strXML . "<set name='" . $_level . "' value='" . $_dat['cc'] . "' color='" . getFCColor()  . "' showname='1'/> ";
		}
		$_strXML = $_strXML . "</graph>";
		if($_POST['chartType'] == "column")
		{
			echo renderChart("../fusion/Charts/FCF_Column3D.swf", "", $_strXML , "discipline", 600, 450);
		}
		else
		{
			echo renderChart("../fusion/Charts/FCF_Pie3D.swf", "", $_strXML , "discipline", 600, 450);
		}	
		echo $_strXML;
	} //end if
?>
</div>
