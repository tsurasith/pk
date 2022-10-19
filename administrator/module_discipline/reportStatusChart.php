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
					echo "<a href=\"index.php?option=module_discipline/reportStatusChart&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/reportStatusChart&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/reportStatusChart&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/reportStatusChart&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<font color="#000000" size="2">
		  <form action="" method="post">
			<select name="level" class="inputboxUpdate">
		  		<option value="all">ทั้งโรงเรียน</option>
				<option value="3/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/1"?"selected":""?>> มัธยมศึกษาปีที่ 1 </option>
				<option value="3/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/2"?"selected":""?>> มัธยมศึกษาปีที่ 2 </option>
				<option value="3/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/3"?"selected":""?>> มัธยมศึกษาปีที่ 3 </option>
				<option value="4/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/1"?"selected":""?>> มัธยมศึกษาปีที่ 4 </option>
				<option value="4/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/2"?"selected":""?>> มัธยมศึกษาปีที่ 5 </option>
				<option value="4/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/3"?"selected":""?>> มัธยมศึกษาปีที่ 6 </option>
			</select><br/>
			<input name="chartType" type="radio" value="column" checked> กราฟแท่ง 
			<input type="radio" value="pie" name="chartType"> กราฟวงกลม
		    <input type="submit" name="search" value="สืบค้น" class="button"/>
		  </form>
		  </font>
		  </td>
    </tr>
  </table>

<?php
	if(isset($_POST['search']))
	{
		$_sql = "";	
		if($_POST['level'] == "all")
		{
			$_sql = "select status_detail, count(dis_status) as 'cc'
						from  student_disciplinestatus left outer join
							ref_disciplinestatus on dis_status = status
						where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
						group by dis_status
						order by dis_status";
		}
		else
		{
			$_sql = "select status_detail, count(dis_status) as 'cc'
						from  student_disciplinestatus left outer join
							ref_disciplinestatus on dis_status = status
						where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
							  and student_id in (select id from students where xlevel = '" . substr($_POST['level'],0,1) . "' and xyearth = '" . substr($_POST['level'],2,1) . "' and xedbe = '". $acadyear . "')
						group by dis_status
						order by dis_status";
		}
		
		$_res = mysql_query($_sql);
		
					
		$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
		if($_POST['chartType'] == "column")
		{
			$_strXML = $_strXML . "<graph caption='สรุปการรายการคดี' xAxisName='สถานะ' yAxisName='Units' decimalPrecision='0' formatNumberScale='0' >";
		}
		else
		{
			$_strXML = $_strXML . "<graph caption='สรุปการรายการคดี' decimalPrecision='0' showNames='1' numberSuffix=' คดี' pieSliceDepth='30' formatNumberScale='0'>";
		}
		
		
		while($_dat = mysql_fetch_assoc($_res))
		{
			$_strXML = $_strXML . "<set name='" . $_dat['status_detail'] . "' value='" . $_dat['cc'] . "' color='" . getFCColor()  . "' showname='0'/> ";
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

	} //end if
?>
</div>
