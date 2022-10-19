

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.1 แผนภูมิรายงานประจำภาคเรียน(ตัวเลขทั้งโรงเรียน)</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_800/reportSemesterChart&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportSemesterChart&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <? if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_800/reportSemesterChart&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_800/reportSemesterChart&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
<form action="" method="post">
		<select name="check" class="inputboxUpdate">
			<option></option>
			<option value="01" <?=isset($_POST['check'])&&$_POST['check']=='01'?"selected":""?>> กิจกรรม </option>
			<option value="02" <?=isset($_POST['check'])&&$_POST['check']=='02'?"selected":""?>> สาย </option>
			<option value="03" <?=isset($_POST['check'])&&$_POST['check']=='03'?"selected":""?>> ลา </option>
			<option value="04" <?=isset($_POST['check'])&&$_POST['check']=='04'?"selected":""?>> ขาด </option>
		</select>  <input type="submit" name="search" value="เรียกดู" class="button" /><br/>
		<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
		<font color="#000000" size="2" >เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา</font>
</form>
	  </td>
    </tr>
  </table>

<? if(isset($_POST['search']) && $_POST['check'] == ""){ ?>
		<br/><br/><center><font color="#FF0000">กรุณาเลือก รายการ การเข้าร่วมกิจกรรมหน้าเสาธงก่อน</font></center>
<? } //end if ?>

<? if(isset($_POST['search']) && $_POST['check'] != ""){ ?>
  <br/>
  <table cellpadding="1" cellspacing="1" border="0" align="center" width="100%">
	<?php
			if($_POST['studstatus']=="1,2")
			{
				$sqlStudent = "select class_id,
							  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
							  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
							  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
							  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
							  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e 
							from student_800 left outer join students on student_id = id
							where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' 
								and xEDBE = '" . $acadyear . "' and studstatus in (" . $_POST['studstatus'] . ")
							group by class_id
							order by class_id";
			}
			else
			{
				$sqlStudent = "select class_id,
							  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
							  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
							  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
							  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
							  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e 
							from student_800 
							where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' 
							group by class_id
							order by class_id";
			}
			$resStudent = mysql_query($sqlStudent);
			$totalRows = mysql_num_rows($resStudent);
			if($totalRows <2)
			{
				echo "<tr><td align='center'><br/><br/><font color='red'>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</font></td></tr>";
			}
			else
			{
	?>	
    <tr > 
		<th align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>รายงานสรุปการ<?=displayTimecheck($_POST['check'])?> การเข้าร่วมกิจกรรมหน้าเสาธง
		<br/>ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
		<br/>
				<?php
					$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
					$_newStringXML = "";
					$_strXML = $_strXML . "<chart caption='' xAxisName='ห้อง' yAxisName='ครั้ง' decimalPrecision='0' formatNumberScale='0'>";
					while($dat = mysql_fetch_assoc($resStudent))
					{
						switch($_POST['check']) {
							case '01' :	$_strXML = $_strXML . "<set name='" . getFullRoomFormat($dat['class_id']) . "' value='" . $dat['b'] . "' color='" . getFCColor()  . "' /> ";break;
							case '02' :	$_strXML = $_strXML . "<set name='" . getFullRoomFormat($dat['class_id']) . "' value='" . $dat['c'] . "' color='" . getFCColor()  . "' /> ";break;
							case '03' :	$_strXML = $_strXML . "<set name='" . getFullRoomFormat($dat['class_id']) . "' value='" . $dat['d'] . "' color='" . getFCColor()  . "' /> ";break;
							case '04' :	$_strXML = $_strXML . "<set name='" . getFullRoomFormat($dat['class_id']) . "' value='" . $dat['e'] . "' color='" . getFCColor()  . "' /> ";break;
							default : 	$_strXML = $_strXML . "<set name='" . getFullRoomFormat($dat['class_id']) . "' value='" . $dat['e'] . "' color='" . getFCColor()  . "' /> ";
						}
					}
					$_strXML = $_strXML . "</chart>";
					FC_SetRenderer( "javascript" );
					echo renderChart("../fusionII/charts/Column3D.swf", "", $_strXML, "absent", 600, 450, false, true); 
				?>
		
		</th>
    </tr>
	<tr>
		<td><u>หมายเหตุ</u>: แกน X คือ ห้องเรียน และ แกน Y คือ จำนวนครั้ง</td>
	</tr>
	<? }//ปิด if-else ตรวจสอบข้อมูลในฐานข้อมูล ?>
</table>
<? }//end if ตรวจสอบการคลิ๊กเลือกรายการ ?>
</div>


  