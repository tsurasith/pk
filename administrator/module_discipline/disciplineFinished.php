
<link rel="stylesheet" type="text/css" href="module_discipline/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_discipline/js/calendar.js"></script>
<SCRIPT language="JavaScript" type="text/javascript">
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
   </SCRIPT>

<div id="content">
	<? $_disID = isset($_POST['dis_id'])?$_POST['dis_id']:$_REQUEST['dis_id']; ?>
	<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
		<tr> 
			<td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
			<td><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
				<span class="normal"><font color="#0066FF"><strong>[คดีที่เสร็จสิ้นแล้ว]</strong></font></span>
			</td>
			<td>
			<?php
				if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
				if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
			?>
			ปีการศึกษา
			<?php  
					echo "<a href=\"index.php?option=module_discipline/disciplineFinished&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/disciplineFinished&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
			?>
			ภาคเรียนที่
			<?php 
					if($acadsemester == 1){ echo "<font color='blue'>1</font> , "; }
					else{
						echo " <a href=\"index.php?option=module_discipline/disciplineFinished&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2){ echo "<font color='blue'>2</font>"; }
					else{
						echo " <a href=\"index.php?option=module_discipline/disciplineFinished&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
			?>
				<font color="#000000" size="2"  >
				<form action="" method="post" autocomplete="off">
					หมายเลขคดี <input type="text" value="<?=$_disID?>" name="dis_id" maxlength="6" size="5" class="inputboxUpdate" onkeypress="return isNumberKey(event)"/> 
					<input type="submit" name="search" value="เรียกดู" class="button"/>
				</form>
				</font>
			</td>
		</tr>
	</table>

	<? if(isset($_POST['search']) && $_disID == ""){?>
			<br/><center><font color="#FF0000">กรุณาป้อนหมายเลขคดีก่อน</font></center>
	<? } ?>

	<form action="" method="post">
	<? $_timeCount = 0; ?>
	<? $_timeAll = 0; ?>
	<? if($_disID != "") { ?>
	<? $_sql = "select * from student_discipline left outer join student_disciplinestatus
						on student_discipline.dis_id = student_disciplinestatus.dis_id
						left outer join student_investigation on student_discipline.dis_id = student_investigation.dis_id
						where student_discipline.dis_id = '" . $_disID . "' 
						and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' and dis_status in(0,6)"; ?>
	<? $_result = mysql_query($_sql); ?>
	<? if(mysql_num_rows($_result)>0){ ?>
			<? $_dat = mysql_fetch_assoc($_result); ?> 
			<input type="hidden" name="student_id" value="<?=$_dat['dis_studentid']?>" />
			<input type="hidden" name="dis_id" value="<?=$_dat['dis_id']?>" />
			<input type="hidden" name="dis_type" value="<?=$_dat['dis_type']?>" />
			<table width="100%" class="admintable">
				<tr>
					<td align="right" width="250px"><b>หมายเลขคดี</b></td>
					<td><?=$_dat['dis_id']?></td>
				</tr>
				<tr>
					<td align="right"><b>วัน/เวลา ที่เกิดเหตุ</b></td>
					<td><?=displayDate($_dat['dis_date']) . " / " . $_dat['dis_time']?> น. </td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>ข้อมูลนักเรียน</b></td>
					<td ><?=studentData($_dat['dis_studentid'],$acadyear)?></td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>พฤติกรรมที่ไม่พึงประสงค์</b></td>
					<td><?=$_dat['dis_detail']?><br/>[ผู้แจ้ง : <?=$_dat['dis_inform']?>]<br/>[ผู้รับแจ้ง : <?=$_dat['dis_reciever']?>]</td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>รายละเอียดการสอบสวน</b></td>
					<td><?=$_dat['dis_investdetail']?><br/>
						[ประเภทการกระทำความผิด : <?=disType($_dat['dis_type'])?>]<br/>
						[ระดับของบทลงโทษ : <?=disLevel($_dat['dis_level'])?>]<br/>
						[ครูผู้สอบสวน : <?=$_dat['dis_investor']?>]<br/>
						[วันที่สอบสวน : <?=displayDate($_dat['dis_investdate'])?>]<br/>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>บันทึกบทลงโทษ</b></td>
					<td><?=disSanction($_dat['dis_id'])?></td>
				</tr>
			</table>
			
			<? $_sqlSanc = "select * from student_sanction where dis_id = '" . $_dat['dis_id'] . "' order by id "; ?>
			<? $_resSanc = mysql_query($_sqlSanc);	?>
			<? if(mysql_num_rows($_resSanc) > 1){ ?>
					<table width="100%" class="admintable" >
						<tr>
							<td align="center" class="key">ครั้งที่</td>
							<td align="center" class="key" width="300px">กิจกรรมที่ปฏิบัติ</td>
							<td align="center" class="key">ระยะเวลา<br/>ที่ปฏิบัติ</td>
							<td align="center" class="key">ครูผู้ดูแล</td>
							<td align="center" class="key">วันที่ทำกิจกรรม</td>
						</tr>
						<? $_i = 0; ?>
						<? while($_datSanc = mysql_fetch_assoc($_resSanc)) { ?>
								<? $_timeAll =  $_timeAll + $_datSanc['sanc_alltime'] ;	?>
								<? if($_i == 0){ $_datSanc = mysql_fetch_assoc($_resSanc); } ?>
								<? $_timeCount = $_timeCount + $_datSanc['sanc_time'] ; ?>
							<tr>
								<td align="center" valign="top"><?=++$_i?></td>
								<td  width="300px"><?=$_datSanc['sanc_detail']?></td>
								<td align="center"><?=displayTime($_datSanc['sanc_time'])?></td>
								<td><?=$_datSanc['sanc_teacher']?></td>
								<td align="center"><?=displayDate($_datSanc['sanc_date'])?></td>
							</tr>
						<? } //end while ?>
						<tr bgcolor="lightblue">
							<td align="center" colspan="2"><b>รวมระยะเวลาที่ปฏิบัติกิจกรรมไปแล้ว</b></td>
							<td align="center"><b><?=displayTime($_timeCount)?></b></td>
							<td align="center"><b> เหลือ </b></td>
							<td align="center"><b><font color="red"><?=displayTime($_timeAll-$_timeCount)?></font></b></td>
						</tr>
					</table><br/>
			<? }///---end ตรวจสอบข้อมูลในฐานข้อมูลครั้งที่ 2 -----//// ?>

			<? $_sql = "select * from student_decision where dis_id = '" . $_disID . "'"; ?>
			<? $_point = $_dat['point'];?>
			<? $_result = mysql_query($_sql);?>
			<? if(mysql_num_rows($_result) > 0){ ?>
					<table width="100%" class="admintable">
					<tr height="35px"><td colspan="2" class="key"> &nbsp; รายละเอียดการพิจารณาของหัวหน้าฝ่าย</td></tr>
					<? $_dat = mysql_fetch_assoc($_result); ?>
					<tr>
						<td valign="top" align="right" width="300px"><b>ความเห็น</b></td>
						<td ><textarea class="inputboxUpdate" cols="30" rows="4" readonly><?=$_dat['dec_detail']?></textarea></td>
					</tr>
					<tr>
						<td align="right" valign="top" width="140px"><b>คะแนนความประพฤติ</b></td>
						<td>
							<input type="checkbox" value="ไม่หักคะแนน" readonly <?=$_dat['dec_point']=="ไม่หักคะแนน"?"checked":""?> disabled="disabled" /> ไม่หักคะแนนความประพฤติ <br/>
							<input type="checkbox" value="หักคะแนน" readonly <?=$_dat['dec_point']=="ไม่หักคะแนน"?"":"checked"?> disabled="disabled" /> หักคะแนนความประพฤติ  <br/>
							<input type="text" name="point" size="2" maxlength="3" readonly class="noborder2" value="<?=$_point?>"/> คะแนน</td>
						</tr>
						<tr>
						<td align="right" width="140px"><b>วันที่พิจารณา</b></td>
						<td><input type="text" name="dec_date" size="16" readonly class="noborder2"  value="<?=displayDate($_dat['dec_date'])?>"/></td>
					</tr>
					</table>
				<? } else { echo "<font color='red'><center><br/>คดีนี้ไม่มีการพิจารณาจากหัวหน้าฝ่ายกิจการนักเรียน</center></font>"; } ?>
		<? } else{ echo "<center><font color='red'><br/>ไม่พบหมายเลขคดีที่ค้นหา</font></center>"; }
	}//end if check submit value ?>
</form>
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
	function disSanction($_disID)
	{
		$_sql = "select * from student_sanction where dis_id = '" . $_disID . "' order by id ";
		$_result = mysql_query($_sql);
		$_dat = mysql_fetch_assoc($_result);
		if(mysql_num_rows($_result)>0)
		{
			$_str = "";
			$_str = $_str . $_dat['sanc_detail'] . "<br/>"
					. "[ผู้กำหนดบทลงโทษ : " . $_dat['sanc_teacher'] . "] <br/>" 
					. "[ระยะเวลาการลงโทษทั้งหมด : " . displayTime($_dat['sanc_alltime']) . "] <br/>"
					. "[วันที่กำหนดบทลงโทษ : " . displayDate($_dat['sanc_date']) . "]" ; 
			return $_str;
		}else { return "<font color='red'>ไม่มีความผิด/ไม่มีบทลงโทษ</font>";}
	}//end function disSanction
	function displayTime($_value){
		if($_value != "" && $_value > 0){
			$_textTime = "";
			if($_value/60 >= 1){ $_textTime .= (int)($_value/60) ." ชั่วโมง "; }
			if($_value%60 >  0){$_textTime .= (int)($_value%60) . " นาที"; }
			return $_textTime ;
		}else { return "-";}
	}//ปิดฟังก์ชันแสดงเวลา x ชั่วโมง y นาที
?>