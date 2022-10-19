

<div id="content">
<? $_disID = (isset($_POST['dis_id'])?$_POST['dis_id']:$_REQUEST['dis_id']); ?>
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>ระบบคัดลอกการสอบสวนพฤติกรรมไม่พึงประสงค์</strong></font></span></td>
      <td>
	  		<?php
				if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
				if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
			?>
			ปีการศึกษา
			<?php  
					echo "<a href=\"index.php?option=module_discipline/disciplineCopy&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/disciplineCopy&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
			?>
			ภาคเรียนที่
			<?php 
					if($acadsemester == 1){ echo "<font color='blue'>1</font> , "; }
					else{
						echo " <a href=\"index.php?option=module_discipline/disciplineCopy&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2){ echo "<font color='blue'>2</font>"; }
					else{
						echo " <a href=\"index.php?option=module_discipline/disciplineCopy&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
			?><br/>
			<font color="#000000" size="2">
			<form  method="post" autocomplete="off">
			หมายเลขคดี <input type="text" name="dis_id" value="<?=$_disID?>" maxlength="6" size="5" class="inputboxUpdate" onKeyPress="return isNumberKey(event)" /> 
			<input type="submit" name="search" value="เรียกดู" class="button"/>
			</form>
			</font>
			</td>
    </tr>
  </table>
 <!-- เิริ่มโค๊ด Insert คัดลอกคดี -->
 <?	if(isset($_POST['copy'])) { ?>
 		<? $sql = "insert into student_discipline values 
						(null,
						'" . $_POST['student_id'] . "',
						'" . $_POST['dis_date'] . "',
						'" . $_POST['dis_time'] . "',
						'" . $_POST['dis_village'] . "',
						'" . $_POST['dis_tumbol'] . "',
						'" . $_POST['dis_inform'] . "',
						'" . $_POST['dis_informdate'] . "',
						'" . $_POST['dis_informgroup'] . "',
						'" . $_POST['dis_reciever'] . "',
						'" . $_POST['dis_recievedate'] . "',
						'" . $_POST['dis_recieverdetail'] . "',
						'" . $_POST['dis_detail'] . "',
						'" . $_POST['dis_user'] . "')"; ?>				
		<table class="admintable" width="100%">
			<tr><td class="key"> ผลการคัดลอกพฤติกรรมไม่พึงประสงค์</td></tr>
			<?					
					if(mysql_query($sql)) {
						$_resNumberID = mysql_query("select dis_id from student_discipline
											 where dis_studentid ='" . $_POST['student_id'] . "'
												and dis_date = '" . $_POST['dis_date'] . "'
												and dis_detail = '" . $_POST['dis_detail'] . "'
												and dis_time = '" . $_POST['dis_time'] ."'");
						$_datID = mysql_fetch_assoc($_resNumberID) or die (mysql_error());
						//insert ลงในตาราง student_disciplinestatus,student_investigate
						$_disStatus = "insert into student_disciplinestatus select '" . $_POST['student_id'] . "'," . $_datID['dis_id'] . ",dis_status,sanc_status,point,acadyear,acadsemester from student_disciplinestatus where dis_id = '"  . $_POST['dis_id'] . "'";
						mysql_query($_disStatus);
						
						$_disInvest = "insert into student_investigation 
										select " . $_datID['dis_id'] . ",'" . $_POST['student_id'] . "',dis_type,dis_level,dis_investdetail,
										dis_sanction,dis_investor,dis_investdate from student_investigation where dis_id = '" . $_POST['dis_id'] . "'";
						mysql_query($_disInvest);
						//-----
						echo "<tr><td align='center'>
								<font color='green'>บันทึกข้อมูลเรียบร้อยแล้ว<br/>
								หมายเลขคดี : <b>
								<a href='index.php?option=module_discipline/disciplineSanction&dis_id=" .  $_datID['dis_id'] . "&acadyear=". $acadyear . "&acadsemester=". $acadsemester . "'>"
								. $_datID['dis_id'] ."</a></b></font></td></tr>";
					}
					else{ showError("การบันทึกข้อมูลผิดพลาด เนื่องจาก ". mysql_error()); } ?>
		</table>
		</form>
	<? } ?>
  <!-- สิ้นสุด Insert คัดลอกคดี -->
 
 
  
	
<? if(isset($_POST['search']) && $_disID == ""){?>
			<center><font color="#FF0000"><br/><br/>กรุณาป้อนหมายเลขที่คดีที่ต้องการดำเนินการก่อน</font></center>
	<? } ?>

	<form name="myform" method="post">
	<? if($_disID != "" && !isset($_POST['copy'])){ ?>
	<?	$_sql = "select * from student_discipline left outer join student_disciplinestatus
						on student_discipline.dis_id = student_disciplinestatus.dis_id
						left outer join student_investigation on student_discipline.dis_id = student_investigation.dis_id
						where student_discipline.dis_id = '" . $_disID . "' 
						and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' and dis_status = 2";
		$_result = mysql_query($_sql);
		if(mysql_num_rows($_result)>0){ ?>
			<? 	$_dat = mysql_fetch_assoc($_result); ?>
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
					<td>
						<?=displayDate($_dat['dis_date']) . " / " . $_dat['dis_time']?> น. 
						<input type="hidden" name="dis_date" value="<?=$_dat['dis_date']?>" />
						<input type="hidden" name="dis_time" value="<?=$_dat['dis_time']?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>ข้อมูลนักเรียน</b></td>
					<td><?=studentData($_dat['dis_studentid'],$acadyear)?></td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>พฤติกรรมที่ไม่พึงประสงค์</b></td>
					<td>
						<?=$_dat['dis_detail']?><br/>[ผู้แจ้ง : <?=$_dat['dis_inform']?>]<br/>[ผู้รับแจ้ง : <?=$_dat['dis_reciever']?>] 
						<input type="hidden" name="dis_detail" value="<?=$_dat['dis_detail']?>" />
						<input type="hidden" name="dis_inform" value="<?=$_dat['dis_inform']?>" />
						<input type="hidden" name="dis_informdate" value="<?=$_dat['dis_informdate']?>" />
						<input type="hidden" name="dis_informgroup" value="<?=$_dat['dis_informgroup']?>" />
						<input type="hidden" name="dis_reciever" value="<?=$_dat['dis_reciever']?>" />
						<input type="hidden" name="dis_recievedate" value="<?=$_dat['dis_recievedate']?>" />
						<input type="hidden" name="dis_recievedetail" value="<?=$_dat['dis_recievedetail']?>" />
						<input type="hidden" name="dis_user" value="<?=$_dat['dis_user']?>" />
					</td>
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
				<tr><td class="key" colspan="2" height="30px">ระบบคัดลอกพฤติกรรมไม่พึงประสงค์และการสอบสวน</td></tr>
				<tr>
					<td align="right" width="250px">ระบุเลขประจำตัวนักเรียน</td>
					<td>
						<input type="text" size="5" maxlength="5" name="student_id" value="<?=$_POST['student_id']?>" onkeypress="return isNumberKey(event)" class="inputboxUpdate" /> 
						<input type="submit" name="view" value="แสดงข้อมูลนักเรียน" />
					</td>
				</tr>
			</table>
			
			
			<? if(isset($_POST['view']) && $_POST['student_id'] != ""){ ?>
				<? $_res = mysql_query("select id,prefix,firstname,lastname,xlevel,xyearth,sex,room,p_village,p_tumbol,studstatus from students where xedbe = '" . $acadyear . "' and id = '" . $_POST['student_id'] . "'"); ?>
				<? if(mysql_num_rows($_res)>0){ ?>
					<? $_datS = mysql_fetch_assoc($_res); ?>
					<table class="admintable" width="100%" align="center">
						<tr>
							<td align="right" width="250px">ชื่อ - สกุล :</td>
							<td width="230px"><?=$_datS['prefix'].$_datS['firstname']. ' '  .$_datS['lastname']?></td>
							<td rowspan="4" valign="top">
								<? if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/pk/images/studphoto/id" . $_datS['id'] . ".jpg"))
									{ echo "<img src='../images/studphoto/id" . $_datS['id'] . ".jpg' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/><br/>"; }
									else 
									{echo "<img src='../images/" . ($_datS['sex']==1?"_unknown_male":"_unknown_female") . ".png' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/><br/>"; } ?>
							</td>
						</tr>
						<tr>
							<td align="right">ระดับชั้น :</td>
							<td><?=$_datS['xlevel']==3?$_datS['xyearth']:$_datS['xyearth']+3?>/<?=$_datS['room']?></td>
						</tr>
						<tr>
							<td align="right">สถานภาพ :</td>
							<td><?=displayStatus($_datS['studstatus'])?></td>
						</tr>
						<tr>
							<td align="right" valign="top">&nbsp;</td>
							<td>
								<input type="hidden" name="dis_village" value="<?=$_datS['p_village']?>" />
								<input type="hidden" name="dis_tumbol" value="<?=$_datS['p_tumbol']?>" />
								<input type="submit" name="copy" class="button" value="คัดลอก" onclick="checkFormValue()" />
								<input type="button" class="button" value="ยกเลิก" onclick="location.href='index.php?option=module_discipline/index'" />
							</td>
						</tr>
					</table>
				<? } else { echo "<br/><br/><center><font color='red'>ไม่พบข้อมูลคดีจากหมายเลขที่ค้นหา กรุณาลองใหม่อีกครั้ง</font></center>"; } ?>
			<? } //else { //<tr><td colspan="2" align="center"><br/><br/><font color="#FF0000">กรุณาระบุเลขประจำตัวนักเรียนที่ต้องการคัดลอกคดีก่อน</font></td></tr><? }//end คลิ๊กปุ่มแสดงข้อมูลนักเรียน ?>
	<?	} else {echo "<br/><br/><center><font color='red'>ไม่พบข้อมูลคดีจากหมายเลขที่ค้นหา กรุณาลองใหม่อีกครั้ง</font></center>";}
	} //end-check submit search
	?>
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
	function displayStatus($id) {
		switch ($id) {
			case 0 :  return "<font color='red'><b>ออก</b></font>"; break;
			case 1 :  return "<font color='green'><b>ปกติ</b></font>"; break;
			case 2 :  return "<b>สำเร็จการศึกษา</b>"; break;
			case 3 :  return "<font color='red'><b>แขวนลอย</b></font>"; break;
			case 4 :  return "<font color='darkorange'><b>พักการเรียน</b></font>"; break;
			case 5 :  return "<font color='blue'><b>ย้ายสถานศึกษา</b></font>"; break;
			case 9 :  return "<font color='red'><b>เสียชีวิต</b></font>"; break;
			default : return " - ไม่ทราบ - ";
		}	
	}
?>