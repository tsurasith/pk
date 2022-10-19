<link rel="stylesheet" type="text/css" href="module_discipline/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_discipline/js/calendar.js"></script>
<script language="javascript" type="text/javascript">
	function nodis(check) {
		if(check.checked)
		{for(i=1;i<=15;i++){document.getElementById(i).disabled = "disabled";}}
		else{for(j=1;j<=15;j++){document.getElementById(j).disabled = false;}}
	}

	function formCheckValue()
	{
		if(document.getElementById('investigate').value == "" || document.getElementById('investigate').value.length < 5)
			{ alert("กรุณาป้อนข้อมูลรายละเอียดการสอบสวนก่อน"); document.getElementById('investigate').focus(); return; }
		
		if(document.getElementById('teacher').value == "")
			{ alert("กรุณาเลือกครูผู้สอบสวนก่อน"); document.getElementById('teacher').focus(); return; }
		
		if(document.getElementById('invest_date').value == "" || document.getElementById('invest_date').value.length < 10)
			{ alert("กรุณาป้อนข้อมูลวันที่ทำการสอบสวน รูปแบบ yyyy-mm-dd (10 ตัวอักษร)"); document.getElementById('invest_date').focus(); return; }
		
		if(document.myform.noDis.checked == false && document.getElementById('1').checked == false && 
		   document.getElementById('2').checked == false && document.getElementById('3').checked == false && 
		   document.getElementById('4').checked == false && document.getElementById('5').checked == false &&
		   document.getElementById('6').checked == false && document.getElementById('7').checked == false &&
		   document.getElementById('8').checked == false && document.getElementById('9').checked == false &&
		   document.getElementById('10').checked == false && document.getElementById('11').checked == false)
			{ alert("กรุณาเลือกประเภทของความผิดก่อน"); document.getElementById('1').focus();return;}
		
		if(document.myform.noDis.checked == false && document.getElementById('12').checked == false && 
		   document.getElementById('13').checked == false && document.getElementById('14').checked == false && 
		   document.getElementById('15').checked == false)
			{ alert("กรุณาเลือกระดับของความผิดก่อน"); document.getElementById('12').focus();return;}
		else {document.myform.submit();}
	}
</script>

<div id="content">
<? $_disID = (isset($_POST['dis_id'])?$_POST['dis_id']:$_REQUEST['dis_id']); ?>
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.2 บันทึกการสอบสวนพฤติกรรมไม่พึงประสงค์</strong></font></span></td>
      <td >
	  		<?php
				if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
				if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
			?>
			ปีการศึกษา
			<?php  
					echo "<a href=\"index.php?option=module_discipline/disciplineInvestigate&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/disciplineInvestigate&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
			?>
			ภาคเรียนที่
			<?php 
					if($acadsemester == 1){ echo "<font color='blue'>1</font> , "; }
					else{
						echo " <a href=\"index.php?option=module_discipline/disciplineInvestigate&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2){ echo "<font color='blue'>2</font>"; }
					else{
						echo " <a href=\"index.php?option=module_discipline/disciplineInvestigate&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
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
  
	
	<? if(isset($_POST['search']) && $_disID == ""){ ?>
			<center><br /><font color="#FF0000">กรุณาป้อน หมายเลขคดี ก่อน ! </font></center>
	<? } ?>
	
	
<?php	
	if($_disID != "" && !isset($_POST['student_id']))
	{
		$_sql = "select * from student_discipline left outer join student_disciplinestatus
						on student_discipline.dis_id = student_disciplinestatus.dis_id
						where student_discipline.dis_id = '" . $_disID . "' 
						and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' and dis_status = 1";
		$_result = mysql_query($_sql);
		if(mysql_num_rows($_result)>0)	{ ?>
			<form name="myform"  method="post">
			<? $_dat = mysql_fetch_assoc($_result); ?>
			<table width="100%" align="center" cellspacing="1" class="admintable" border="0" cellpadding="3">
				<tr>
					<td align="right" width="250px"><b>หมายเลขคดี</b></td>
					<td><?=$_dat['dis_id']?>
						<input type="hidden" name="student_id" value="<?=$_dat['dis_studentid']?>" />
						<input type="hidden" name="dis_id" value="<?=$_dat['dis_id']?>" />
					</td>
				</tr>
				<tr>
					<td align="right" ><b>วัน/เวลา ที่เกิดเหตุ</b></td>
					<td><?=displayFullDate($_dat['dis_date']) . " / " . $_dat['dis_time']?> น. </td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>ข้อมูลนักเรียน</b></td>
					<td ><?=studentData($_dat['dis_studentid'],$acadyear)?></td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>พฤติกรรมที่ไม่พึงประสงค์</b></td>
					<td><?=$_dat['dis_detail']?><br/>[ผู้แจ้ง : <?=$_dat['dis_inform']?>]<br/>[ผู้รับแจ้ง : <?=$_dat['dis_reciever']?>] </td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>รายละเอียดการสอบสวน</b></td>
					<td><textarea id="investigate" name="investigate" cols=55 rows=12 class="inputboxUpdate" ></textarea></td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>สอบสวนแล้วไม่มีความผิด</b></td>
					<td><input type="checkbox" name="noDis" value="nodis" onClick="nodis(this)"> ไม่มีความผิด</td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>ประเภทการกระทำความผิด</b></td>
					<td>
						<table>
							<tr>
								<td><input type="radio" name="disType" id="1" value="10" /> ตรงต่อเวลา</td>
								<td><input type="radio" name="disType" id="5" value="11" /> การเข้าชั้นเรียน	</td>
								<td><input type="radio" name="disType" id="9" value="12" /> ทะเลาะวิวาท </td>
							</tr>
							<tr>
								<td><input type="radio" name="disType" id="2" value="13" /> ลักขโมย</td>
								<td><input type="radio" name="disType" id="6" value="14" /> สิ่งเสพติด	</td>
								<td><input type="radio" name="disType" id="10" value="15" /> อาวุธ </td>
							</tr>
							<tr>
								<td><input type="radio" name="disType" id="3" value="16" /> สื่อลามกอนาจาร	</td>
								<td><input type="radio" name="disType" id="7" value="17" /> พฤติกรรม	</td>
								<td><input type="radio" name="disType" id="11" value="18" /> เครื่องแต่งกาย </td>
							</tr>
							<tr>
								<td><input type="radio" name="disType" id="4" value="19" /> อุปกรณ์อิเล็กทรอนิกส์	</td>
								<td><input type="radio" name="disType" id="8" value="20" /> เรื่องทั่วไป </td>
								<td>&nbsp;</td>
							</tr>
						</table>
				  	</td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>ระดับของบทลงโทษ</b></td>
					<td><input type="radio"  id="12" name="disLevel" value="10"/> สถานเบา &nbsp;<input type="radio" name="disLevel" id="14" value="11"/> สถานปานกลาง <br/>
					  <input type="radio"  id="13" name="disLevel" value="12"/> สถานหนัก  <input type="radio" name="disLevel" id="15" value="13"/> สถานหนักมาก</td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>ครูผู้สอบสวน</b></td>
					<td>
						<? $_sqlTeacher = "select teaccode,prefix,firstname,lastname from teachers where type in ('admin','teacher') order by firstname"; ?>
						<? $_resTeacher = mysql_query($_sqlTeacher); ?>
						<select id="teacher" name="teacher" class="inputboxUpdate">
							<option value=""></option>
						<? while($_dat = mysql_fetch_assoc($_resTeacher)){ ?>
							<option value="<?=$_dat['prefix'].$_dat['firstname'].' '.$_dat['lastname']?>" <?=$_dat['teaccode']==$_datRoom['teacher_id']?"selected":""?> ><?=$_dat['prefix'].$_dat['firstname'].' '.$_dat['lastname']?></option>
						<? } mysql_free_result($_resTeacher);//end while ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top"><b>วันที่สอบสวน</b></td>
					<td><input id="invest_date" type="text" class="inputboxUpdate" name="invest_date" size="10" onClick="showCalendar(this.id)"></td>
				</tr>
				<tr>
					<td align="right" valign="top">&nbsp;</td>
					<td>
						<input type="hidden" name="save" />
						<input type="button" class="button" value="บันทึก" onclick="formCheckValue()">
						<input type="button" value="ยกเลิก" class="button" onclick="location.href='index.php?option=module_discipline/index'" />
					</td>
				</tr>
			</table>
	<?	} // end-if check data 
		else { ?>
			<center><br/><font color="#FF0000"><br/>ไม่พบข้อมูลตาม หมายเลขคดี ที่ค้นหา</font></center>
	<?	} //end-else-check data ?>
<?	} //check_Post['search'] || $_REQUEST['student_id']?>
</form>

<?php
	if(isset($_POST['save']) && $_POST['noDis'] != "nodis") {
				//update student_disciplinestatus -> status = 2 && sanc_status = 02;
				//insert student_investigeate-> 1 Record;
				$_sql = "update student_disciplinestatus set dis_status = 2 , sanc_status = '02' where dis_id = '" . $_POST['dis_id'] . "'";
				$_sql2 = "insert into student_investigation values('" . $_POST['dis_id'] . "',
																	'" . $_POST['student_id'] . "',
																	'" . $_POST['disType'] . "',
																	'" . $_POST['disLevel']. "',
																	'" . $_POST['investigate'] . "','02',
																	'" . $_POST['teacher'] . "',
																	'" . $_POST['invest_date'] . "')";
				$_result1 = mysql_query($_sql);
				$_result2 = mysql_query($_sql2);				
				if($_result1 && $_result2){
					echo "<br/><center><font color='green'>บันทึกข้อมูลการสอบสวนเรียบร้อยแล้ว<br/>
							ดำเนินการต่อคลิกที่ : <a href='index.php?option=module_discipline/disciplineSanction&dis_id=" .  $_POST['dis_id'] . "&acadyear=". $acadyear . "&acadsemester=". $acadsemester . "'>"
								.  $_POST['dis_id'] ."</a></font></center>"; 
				}
				else{ echo "<br/><center><font color=\"red\">เกิดข้อผิดพลาด เนื่องจาก - " . mysql_error() . "</font></center>"; }
	}//end if
	else
	{
			if($_POST['teacher'] != "" && $_POST['invest_date'] != "" && $_POST['investigate'] != "")
			{
				//update student_disciplinestatus -> status = 0 && sanc_status = 01;
				//insert student_investigeate-> 1 Record;
				$_sql = "update student_disciplinestatus set dis_status = 0 , sanc_status = '01' where dis_id = '" . $_POST['dis_id'] . "'";
				$_sql2 = "insert into student_investigation values('" . $_POST['dis_id'] . "',
																	'" . $_POST['student_id'] . "',
																	'00','00',
																	'" . $_POST['investigate'] . "','01',
																	'" . $_POST['teacher'] . "',
																	'" . $_POST['invest_date'] . "')";
				$_result1 = mysql_query($_sql);
				$_result2 = mysql_query($_sql2);
				if($_result1 && $_result2){ 
					echo "<br/><center><font color=\"green\">บันทึกข้อมูลการสอบสวนเรียบร้อยแล้ว<br/>
							ดำเนินการต่อคลิกที่ : <a href='index.php?option=module_discipline/disciplineFinished&dis_id=" .  $_POST['dis_id'] . "&acadyear=". $acadyear . "&acadsemester=". $acadsemester . "'>"
								.  $_POST['dis_id'] ."</a></font></center>"; 
				}
				else{ echo "<br/><center><font color=\"red\">เกิดข้อผิดพลาด เนื่องจาก - " . mysql_error() . "</font></center>"; }
			}
	}
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
?>