
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.2 แผนภูมิรายงานประจำภาคเรียน(ตัวเลขตามระดับชั้น)</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_800/reportSemesterChartLevel&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportSemesterChartLevel&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_800/reportSemesterChartLevel&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_800/reportSemesterChartLevel&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form action="" method="post">
			<select name="class" class="inputboxUpdate">
					<option value=""></option>
				<? for($_i=1;$_i<=6;$_i++) { ?>
					<option value="<?=$_i?>" <?=isset($_POST['class'])&&$_POST['class']==$_i?"selected":""?>>
						ชั้นมัธยมศึกษาปีที่ <?=$_i?>
					</option>
				<? } ?>
			</select>
			<input type="submit" value="เรียกดู" class="button" /><br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 <font color="#000000" size="2" >เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา</font>
		  </form>
	  </td>
    </tr>
  </table>

  <table cellpadding="1" cellspacing="1" border="0" align="center" width="100%">
	<?php
			if($_POST['studstatus']=="1,2")
			{
				$sqlStudent = "select class_id,
							  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
							  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
							  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e 
							from student_800 left outer join students on student_id = id 
							where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' 
								and xEDBE = '" . $acadyear . "' and studstatus in (" . $_POST['studstatus'] . ")
								and class_id like '" . $_POST['class'] . "%'
							group by class_id order by class_id";
			}
			else
			{
				$sqlStudent = "select class_id,
							  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
							  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
							  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e 
							from student_800 where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' and class_id like '" . $_POST['class'] . "%'
							group by class_id order by class_id";
			}
			$resStudent = mysql_query($sqlStudent);
			$totalRows = mysql_num_rows($resStudent);
			if($totalRows <2) { echo "<tr><td align='center'><font color='red'><br/><br/>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</font></td></tr>"; }
			else
			{
	?>	
    <tr > 
		<th align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>รายงานการเข้าร่วมกิจกรรมหน้าเสาธง
		<br/>ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
		<br/>
				<?php
					$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
					$_strXML = $_strXML . "<chart caption='' xAxisName='ห้อง' yAxisName='Units' formatNumberScale='0' decimalPrecision='0'>";
					$_catXML = "<categories>";
					$_setA = "<dataset seriesname='สาย' color='FFFF00' showValue='1'>";
					$_setB = "<dataset seriesname='ลา' color='0000FF' showValue='1'>";
					$_setC = "<dataset seriesname='ขาด' color='FF0000' showValue='1'>";
					while($dat = mysql_fetch_assoc($resStudent))
					{
						$_catXML .= "<category name='" . getFullRoomFormat($dat['class_id']) . "' hoverText=''/>";
						$_setA .= "<set value='" . $dat['c'] . "' />";
						$_setB .= "<set value='" . $dat['d'] . "' />";
						$_setC .= "<set value='" . $dat['e'] . "' />";
					}
					$_catXML .= "</categories>";
					$_setA .= "</dataset>";
					$_setB .= "</dataset>";
					$_setC .= "</dataset>";
					$_strXML .= $_catXML . $_setA . $_setB . $_setC . "</chart>";
					FC_SetRenderer( "javascript" );
					echo renderChart("../fusionII/charts/MSColumn3D.swf", "", $_strXML , "absent", 700, 450);
					//echo $_strXML ;
				?>
		
		</th>
    </tr>
	<? }//ปิด if-else ตรวจสอบข้อมูลในฐานข้อมูล ?>
</table>
</div>


