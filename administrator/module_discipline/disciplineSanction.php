
<link rel="stylesheet" type="text/css" href="module_discipline/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_discipline/js/calendar.js"></script>
<script type="text/javascript" language="javascript">

function checkFormValue()
{
	if(document.getElementById('sanc_detail').value == "" && document.getElementById('sanc_detail').value.length < 10)
		{ alert('กรุณาป้อนข้อมูลรายละเอียดบทลงโทษก่อน'); document.getElementById('sanc_detail').focus(); return; }
	
	if(document.getElementById('hour').value == "0" && document.getElementById('minute').value == "0")
		{ alert('กรุณาระบุระยะเวลาที่ต้องทำกิจกรรมปรับเปลี่ยนพฤติกรรมก่อน'); document.getElementById('hour').focus(); return; }
	
	if(document.getElementById('sanc_teacher').value == "")
		{ alert('กรุณาเลือกครูผู้ลงโทษนักเรียนก่อน'); document.getElementById('sanc_teacher').focus(); return; }
	
	if(document.getElementById('sanc_date').value == "" && document.getElementById('sanc_date').value.length < 10)
		{ alert('กรุณาป้อนข้อมูลวันที่กำหนดบทลงโทษก่อน'); document.getElementById('sanc_date').focus(); return; }
	else { document.myform.submit();}
}
</script>

<div id="content">
	<? $_disID = isset($_POST['dis_id'])?$_POST['dis_id']:$_REQUEST['dis_id']; ?>
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td width="45%"><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.3 บันทึกบทลงโทษนักเรียน</strong></font></span></td>
      <td >
	  	<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_discipline/disciplineSanction&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/disciplineSanction&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่ <?php 
					if($acadsemester == 1){ echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_discipline/disciplineSanction&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_discipline/disciplineSanction&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?><br/>
		<font color="#000000" size="2"  >
		<form action="" method="post" autocomplete="off">
			หมายเลขคดี <input type="text" name="dis_id" value="<?=$_disID?>" maxlength="6" size="5" class="inputboxUpdate" onkeypress="return isNumberKey(event)" /> 
			<input type="submit" name="search" value="เรียกดู" class="button"/>
		</form>
		</font>
	  </td>
    </tr>
  </table>

	<? if(isset($_POST['search']) && $_disID == ""){?>
			<center><font color="#FF0000"><br/><br/>กรุณาป้อนหมายเลขที่คดีที่ต้องการดำเนินการก่อน</font></center>
	<? } ?>

	<form name="myform" method="post">
	<? if($_disID != "" && !isset($_POST['student_id'])){ ?>
	<?	$_sql = "select * from student_discipline left outer join student_disciplinestatus
						on student_discipline.dis_id = student_disciplinestatus.dis_id
						left outer join student_investigation on student_discipline.dis_id = student_investigation.dis_id
						where student_discipline.dis_id = '" . $_disID . "' 
						and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' and dis_status = 2";
		$_result = mysql_query($_sql);
		if(mysql_num_rows($_result)>0){ ?>
			<? 	$_dat = mysql_fetch_assoc($_result); ?>
			<input type="hidden" name="student_id" value="<?=$_dat['dis_studentid']?>" />
			<input type="hidden" name="dis_id" value="<?=$_dat['dis_id']?>" />
			<input type="hidden" name="dis_type" value="<?=$_dat['dis_type']?>" />
			<table width="100%" align="center" cellspacing="1" class="admintable" cellpadding="3">
				<tr>
					<td class="key" colspan="2">รายละเอียดข้อมูลพฤติกรรมไม่พึงประสงค์</td>
				</tr>
				<tr>
					<td align="right" width="250px"><b>หมายเลขคดี</b></td>
					<td><?=$_dat['dis_id']?></td>
				</tr>
				<tr>
					<td align="right" ><b>วัน/เวลา ที่เกิดเหตุ</b></td>
					<td><?=displayDate($_dat['dis_date']) . " / " . $_dat['dis_time']?> น. </td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>ข้อมูลนักเรียน</b></td>
					<td><?=studentData($_dat['dis_studentid'],$acadyear)?></td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>พฤติกรรมที่ไม่พึงประสงค์</b></td>
					<td><?=$_dat['dis_detail']?><br/>[ผู้แจ้ง : <?=$_dat['dis_inform']?>]<br/>[ผู้รับแจ้ง : <?=$_dat['dis_reciever']?>] </td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>รายละเอียดการสอบสวน</b></td>
					<td><?=$_dat['dis_investdetail']?></td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>ประเภทการกระทำความผิด</b></td>
					<td><?=disType($_dat['dis_type'])?></td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>ระดับของบทลงโทษ</b></td>
					<td><?=disLevel($_dat['dis_level'])?></td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>ครูผู้สอบสวน</b></td>
					<td><?=$_dat['dis_investor']?></td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>วันที่สอบสวน</b></td>
					<td><?=displayDate($_dat['dis_investdate'])?></td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>บันทึกบทลงโทษ</b></td>
					<td valign="top">
						<textarea id="sanc_detail" name="sanc_detail" cols="55" rows="7" class="inputboxUpdate"></textarea>
						<font color="#FF0000">*</font>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>ระยะเวลาที่ต้องทำกิจกรรม</b></td>
					<td><select id="hour" name="hour" class="inputboxUpdate">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="10">10</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="50">50</option>
						  </select> ชั่วโมง 
						  <select id="minute" name="minute" class="inputboxUpdate">
							<option value="0">00</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="45">45</option>
					  	</select> นาที  <font color="#FF0000">*</font>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>ผู้กำหนดบทลงโทษ</b></td>
					<td>
						<? $_sqlTeacher = "select teaccode,prefix,firstname,lastname from teachers where type in ('admin','teacher') order by firstname"; ?>
						<? $_resTeacher = mysql_query($_sqlTeacher); ?>
						<select id="sanc_teacher" name="sanc_teacher" class="inputboxUpdate">
							<option value=""></option>
						<? while($_dat = mysql_fetch_assoc($_resTeacher)){ ?>
							<option value="<?=$_dat['prefix'].$_dat['firstname'].' '.$_dat['lastname']?>" ><?=$_dat['prefix'].$_dat['firstname'].' '.$_dat['lastname']?></option>
						<? } mysql_free_result($_resTeacher);//end while ?>
						</select>
						<font color="#FF0000">*</font>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>วันที่กำหนดการลงโทษ</b></td>
					<td>
						<input type="text" name="sanc_date" id="sanc_date" size="10" class="inputboxUpdate" onClick="showCalendar(this.id)" />
						<font color="#FF0000">*</font>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top">&nbsp;</td>
					<td>
						<input type="button" name="save" class="button" value="บันทึก" onclick="checkFormValue()" />
						<input type="button" class="button" value="ยกเลิก" onclick="location.href='index.php?option=module_discipline/index'" />
					</td>
				</tr>
			</table>
	<?	} else {echo "<br/><br/><center><font color='red'>ไม่พบข้อมูลคดีจากหมายเลขที่ค้นหา กรุณาลองใหม่อีกครั้ง</font></center>";}
	} //end-check submit search
	?>
</form>

<?php
	if(isset($_POST['student_id']))
	{
			$_sanc_alltime = ($_POST['hour'] * 60) + ($_POST['minute']);
			$_resCheck = mysql_query("select * from student_sanction where dis_id = '" . $_POST['dis_id'] . "' and sanc_alltime = '" . $_sanc_alltime . "'");
			if(mysql_num_rows($_resCheck) > 0){echo "<center><font color='red'><br/>ได้มีการบันทึกข้อมูลเรียบร้อยแล้ว กรุณาดำเนินการต่อที่เมนู 1.4</font></center>";}
			else
			{
				//update student_disciplinestatus -> status = 3 && sanc_status = 02;
				//insert student_sanction-> 1 Record;
				$_sql = "update student_disciplinestatus set dis_status = 3 , sanc_status = '02' where dis_id = '" . $_POST['dis_id'] . "'";
				$_sql2 = "insert into student_sanction values(null,'" . $_POST['dis_id'] . "',
																	'" . $_POST['sanc_detail'] . "',
																	'0',
																	'" . $_sanc_alltime . "',
																	'" . $_POST['sanc_teacher'] . "',
																	'" . $_POST['sanc_date'] . "')";
				$_result1 = mysql_query($_sql);
				$_result2 = mysql_query($_sql2);				
				if($_result1 && $_result2) { 
					echo "<br/><center><font color='green'>บันทึกข้อมูลบทลงโทษเรียบร้อยแล้ว<br/>
							ดำเนินการต่อคลิกที่ : <a href='index.php?option=module_discipline/disciplineActivate&dis_id=" .  $_POST['dis_id'] . "&acadyear=". $acadyear . "&acadsemester=". $acadsemester . "'>"
								.  $_POST['dis_id'] ."</a>
							</font></center>"; 
				}
				else { echo "<br/><font color='red'><center>เกิดข้อผิดพลาด เนื่องจาก - " . mysql_error() . "</center></font>"; }
			}//end else if user click refresh button
	}//end if submit data
?>
</div>


<?php
	
	function studentData($_id,$acadyear)
	{
		$_sql = "select id,prefix,firstname,lastname,xlevel,xyearth,room,p_village from students where xedbe = '" . $acadyear  ."' and id = '". $_id . "'";
		$_result = mysql_query($_sql);
		$_dat = mysql_fetch_assoc($_result);
		$str = "";
		$str = $str . "เลขประจำตัว: " . $_dat['id'] . "<br/>ชื่อ-สกุล: ". $_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname'] . "<br/>";
		$str = $str . "ระดับชั้น: " .($_dat['xlevel']==4?$_dat['xyearth']+3:$_dat['xyearth']) . "/" . $_dat['room'] . "<br/>";
		$str = $str . "หมู่บ้าน: " . $_dat['p_village'] ;
		return $str;
	}
	function disType($_value)
	{
		switch ($_value)
		{
			case "00": return "ไม่มีความผิด"; break;
			case "10": return "ตรงต่อเวลา"; break;
			case "11": return "การเข้าชั้นเรียน"; break;
			case "12": return "ทะเลาะวิวาท"; break;
			case "13": return "ลักขโมย"; break;
			case "14": return "สิ่งเสพติด"; break;
			case "15": return "อาวุธ"; break;
			case "16": return "สื่อลามกอนาจาร"; break;
			case "17": return "พฤติกรรม"; break;
			case "18": return "เครื่องแต่งกาย"; break;
			case "19": return "อุปกรณ์อิเล็กทรอนิกส์"; break;
			case "20": return "เรื่องทั่วไป"; break;
			default : return "ผิดพลาด";
		}
	}
	function disLevel($_value)
	{
		switch ($_value)
		{
			case "00": return "ไม่มีความผิด"; break;
			case "10": return "สถานเบา"; break;
			case "11": return "สถานปานกลาง"; break;
			case "12": return "สถานหนัก"; break;
			case "13": return "สถานหนักมาก"; break;
			default : return "ผิดพลาด";
		}
	}
?>