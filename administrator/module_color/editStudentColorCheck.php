
<link rel="stylesheet" type="text/css" href="module_800/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_800/js/calendar.js"></script>
<script type="text/javascript" language="javascript">
function check(name,value) { document.getElementById(name).bgColor=value; }
</script>

<div id="content">
	<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
		<tr>
			<td width="6%" align="center"><a href="index.php?option=module_color/index"><img src="../images/color.png" alt="กิจกรรมคณะสี" width="48" height="48" border="0"/></a></td>
			<td><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br /> 
				<span class="normal"><font color="#0066FF"><strong>2.3 แก้ไขการบันทึก(รายคน)</strong></font></span></td>
			<td width="300px"> ปีการศึกษา <?=$acadyear?> 	ภาคเรียนที่ <?=$acadsemester?></td>
		</tr>
	</table>
	<? if(isset($_POST['search']) && ($_POST['studentid'] == "" || $_POST['date'] == "")){ ?>
			<center><font color="#FF0000"><br/>กรุณาป้อนเลขประจำตัวนักเรียน และวันที่ต้องการแก้ไขข้อมูลก่อน</font></center><br/>
	<? } //end if ?>
	<form method="post">
	<table width="100%" align="center" cellspacing="1" class="admintable">
		<tr height="35px"> 
			<td colspan="2" class="key">แก้ไขการบันทึกการเ้ข้าแถวหน้าเสาธงรายคน</td>
		</tr>
		<tr> 
			<td width="160px" align="right">เลขประจำตัวนักเรียน : </td>
			<td><input type="text" name="studentid" value="<?=isset($_POST['studentid'])?$_POST['studentid']:""?>" size="5" maxlength="5" class="inputboxUpdate" /></td>
		</tr>
		<tr> 
			<td align="right">วันที่แก้ไข : </td>
			<td><input type="text" id="date" name="date" value="<?=isset($_POST['date'])?$_POST['date']:""?>" size="10" onClick="showCalendar(this.id)" class="inputboxUpdate"/>
				<input type="submit" name="search" value="เรียกดูข้อมูล" />
			</td>
		</tr>
	</table><br/>
	</form>
	
	<? if(isset($_POST['search']) && $_POST['studentid'] != "" && $_POST['date'] != ""){ ?>
			<? $_sql = "select * from student_color where student_id = '" . $_POST['studentid'] . "' and check_date = '" . $_POST['date'] . "'" ;?>
			<? $result = mysql_query($_sql); ?>
			<? if(mysql_num_rows($result) > 0){ ?>
					<form method="post">
					<table width="100%" class="admintable">
						<tr height="35px"> 
							<td colspan="2" class="key">ผลการค้นหาข้อมูล</td>
						</tr>
						<tr>
							<td width="160px" align="right">วันที่บันทึก : </td>
							<td>
								<font color="darkblue"><?=displayDate($_POST['date'])?></font>
								<input type="hidden" value="<?=$_POST['date']?>" name="date">
							</td>
						</tr>
						<? $sql_student = "select prefix , firstname , lastname, studstatus,color from students where id = '" . $_POST['studentid'] . "'"; ?>
						<? $res_student = mysql_query($sql_student); ?>
						<? $dat_student = mysql_fetch_assoc($res_student); ?>
						<tr>							
							<td align="right">ชื่อ - สกุล : </td>
							<td><font color="darkblue"><?=$dat_student['prefix'] . $dat_student['firstname'] . ' ' . $dat_student['lastname']?></font></td>
						</tr>
						<tr>
							<td align="right">เลขประจำตัว : </td>
							<td>
								<font color="darkblue"><?=$_POST['studentid']?></font>
								<input type="hidden" value="<?=$_POST['studentid']?>" name="studentid">
							</td>
						</tr>
						<tr>
							<td align="right">คณะสี : </td>
							<td><font color="darkblue"><?=$dat_student['color']?></font></td>
						</tr>
						<? $periodRows = 1; ?>
						<? while($dat = mysql_fetch_assoc($result)) { ?>
						<tr>
							<td align="right">การเข้าร่วมกิจกรรมคณะสี : </td>
							<td id="<?="check[$periodRows]"?>">
								<? $p0Check = ""; $p1Check = ""; $p2Check = ""; $p3Check = ""; $p4Check = ""; ?>
								<? switch($dat['timecheck_id']) {
										case '00' : $p0Check = "checked"; break;  
										case '01' : $p1Check = "checked"; break;
										case '02' : $p2Check = "checked"; break;  
										case '03' : $p3Check = "checked"; break;
										case '04' : $p4Check = "checked"; break;  
										default : echo "xx";
									} //end switch ?>
								<input type='radio' name="<?="check[$periodRows]"?>" value='white'  <?=$p0Check?>  onclick="check(this.name,this.value)" /> มา |
								<input type='radio' name="<?="check[$periodRows]"?>" value='lightgreen'  <?=$p1Check?> onclick="check(this.name,this.value)" /> กิจกรรม |
								<input type='radio' name="<?="check[$periodRows]"?>" value='yellow'  <?=$p2Check?>  onclick="check(this.name,this.value)" > สาย |
								<input type='radio' name="<?="check[$periodRows]"?>" value='blue'  <?=$p3Check?>  onclick="check(this.name,this.value)" > ลา | 
								<input type='radio' name="<?="check[$periodRows]"?>" value='red'  <?=$p4Check?> onclick="check(this.name,this.value)" > ขาด
							</td>
						</tr>
						<? $periodRows++; ?>
						<? }//end while ?>
						<tr>
							<td>&nbsp;</td>
							<td>
								<input type="submit" value="บันทึก"  name="saveedit" class="button"/>
								<input type="button" value="ยกเลิก" class="button" onClick="location.href='index.php?option=module_color/index'"/>
							</td>
						</tr>
					</table>
					</form>
				<? } else { echo "<font color='red'><center><br/>ไม่พบข้อมูลที่ค้นหา</center></font><br/>"; } ?>
		<? } //end if กดปุ่มเรียกดูข้อมูล ?>
			
		<? if(isset($_POST['saveedit']) && $_POST['studentid'] != '') {
				$sqlEdit = 'update student_color set ';
				$sqlEdit = $sqlEdit . " timecheck_id = '" . timecheck_id($_POST['check'][1]) . "'";
				$sqlEdit = $sqlEdit . " where student_id = '" . $_POST['studentid'] . "'" ;
				$sqlEdit = $sqlEdit . " and check_date = '" . $_POST['date']  . "'" ;
				$update = mysql_query($sqlEdit) or die ('Error - ' . mysql_error());
				if($update) { echo "<center><font color='green' ><br/>บันทึกการแก้ไขข้อมูลเรียบร้อยแล้ว</font></center>"; }
				else { echo "<center><font color='red'><br/>เกิดข้อผิดพลาดเนื่องจาก - ". mysql_error() . "</font></color>";}
			}
		?>
</div>

<?php
function timecheck_id($value) {
	if($value == 'white') return '00';
	if($value == 'lightgreen') return '01';
	if($value == 'yellow') return '02';
	if($value == 'blue') return '03';
	if($value == 'red') return '04';
	else return 9;
}
	function displayDate($date) {
		$txt = "" ;
		$_x = explode('-',$date,3);
		switch ($_x[1]) {
			case "01" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน มกราคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "02" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน กุมภาพันธ์  พ.ศ. " . ($_x[0] + 543) ;break;
			case "03" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน มีนาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "04" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน เมษายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "05" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน พฤษภาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "06" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน มิถุุนายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "07" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน กรกฎาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "08" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน สิงหาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "09" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน กันยายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "10" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน ตุลาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "11" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน พฤศจิกายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "12" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน ธันวาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			default : $txt = $txt . "ผิดพลาด";
		}
		return $txt ;
	}
?>