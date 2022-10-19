<script language="javascript" type="text/javascript">
checked = false;
function checkedAll (count) {
	var aa= document.getElementById('frm1');
	    if (checked == false){checked = true}
        else{checked = false}
		
	for (var i =1; i < count+1; i++) 
	{
		if(!document.getElementById('chk'+i).disabled)
		{ 
			document.getElementById('chk' + i).checked = checked;
			if(checked == true){document.getElementById('row'+i).bgColor='#FFFF99';}
			else{document.getElementById('row'+i).bgColor='#FFFFFF';}
		}
	} 
}
function check(name,i)
{
	if(document.getElementById('chk'+i).checked == true)
	{ document.getElementById(name).bgColor='#FFFF99'; }
	else {document.getElementById(name).bgColor='#FFFFFF';}
}
</script>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td align="center">
      <a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.6 โปรแกรมเลื่อนชั้นนักเรียน</strong></font></span></td>
      <td>
	  	<form method="post">
			<? if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; } ?>
			ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_history/studentSetUplevel&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/studentSetUplevel&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
			</font><br/>
			<font  size="2" color="#000000">เลือกห้องเรียน
			<?php 
					$sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '2' and substr(room_id,1,1) in (1,2,4,5)  order by room_id";
					$resRoom = mysql_query($sql_Room);			
			?>
			<select name="roomID" class="inputboxUpdate">
				<option value=""></option>
				<? while($dat = mysql_fetch_assoc($resRoom)) {
						$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
						echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
						echo getFullRoomFormat($dat['room_id']);
						echo "</option>";
					}
				?>
			</select>
	  		<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			</font></form>
	  </td>
    </tr>
</table>
<? if(!isset($_POST['search']) && !isset($_POST['save'])){ ?>
	<table class="admintable" width="100%">
		<tr>
			<td class="key" colspan="2"> &nbsp; ข้อแนะนำการใช้งานโปรแกรมเลื่อนระดับชั้น</td>
		</tr>
		<tr>
			<td width="50px"></td>
			<td>
				1. โปรแกรมเลื่อนชั้นนักเรียนจะใช้ได้ก็ต่อเมื่อสิ้นภาคเรียนที่ 2 ของปีการศึกษานั้นๆ
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				2. ให้ผู้ดูแลระบบตรวจสอบ<b><u>สถานภาพ</u></b>ของนักเรียนในแต่ละห้องเรียนว่ามีการ ย้าย ออก แขวนลอย ในปีการศึกษา <?=$acadyear?>  หรือไม่
				หากมีให้ทำการแก้ไขประวัติก่อนทำการเลื่อนชั้น โดยเข้าไปที่ส่วนของ &quot;สืบค้นประวัติ&gt;&gt;3.3 หรือ 3.4&quot;
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				3. จากนั้นให้ทำการเลือกห้องเรียนและทำการเลื่อนชั้นโดยข้อควรพึงระวังคือ โปรดตรวจสอบปีการศึกษา ให้ชัดเจน ถูกต้อง
			</td>
		</tr>
	</table>
<? } ?>
<?
	  $xlevel = getXlevel($_POST['roomID']);
	  $xyearth= getXyearth($_POST['roomID']);
	  $room = getRoom($_POST['roomID']);
 ?>
<? if(isset($_POST['search']) && $_POST['roomID'] == ""){ ?>
	<center><br/><font color="#FF0000">กรุณาเลือกห้องเรียนก่อน !</font></center>
<? }//end if ตรวจสอบห้องเรียน ?>

<? if(isset($_POST['search']) && $_POST['roomID'] != ""){ ?>
	<? $_sql = "select id,prefix,firstname,lastname,nickname,gpa,studstatus,points from students where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' and room = '" . $room . "' and xedbe = '" . $acadyear . "'";
		$_sql .= " and id not in (select id from students where xedbe = '". ($acadyear+1) . "') ";
		if($_POST['studstatus']=="1,2") $_sql .= " and studstatus in (1,2) ";
		$_sql .= " order by sex,id ";?>
	<? $_res = mysql_query($_sql); ?>
	<? if(mysql_num_rows($_res)>0){ ?>
		<form method="post" id="frm1">
		<table class="admintable" width="100%">
			<tr>
				<td colspan="8" align="center">
					<img src="../images/school_logo.gif" width="120px"><br/>
					<b>รายชื่อนักเรียนห้อง <?=getFullRoomFormat($_POST['roomID'])?> ปีการศึกษา <?=$acadyear?><br/>
					ที่ยังไม่ได้ทำการเลื่อนชั้นเรียน</b>
				</td>
			</tr>
			<tr>
				<td width="40px" align="center" class="key">เลขที่</td>
				<td width="85px" align="center" class="key">เลขประจำตัว</td>
				<td  align="center" class="key">ชื่อ - นามสกุล</td>
				<td align="center" width="100px" class="key">ชื่อเล่น</td>
				<td align="center" width="60px" class="key">GPA.</td>
				<td width="150px"  align="center" class="key">สถานภาพปัจจุบัน</td>
				<td width="100px" align="center" class="key">คะแนน<br/>ความประพฤติ</td>
				<td align="center" width="40px" class="key"><input type='checkbox' name='checkall' onclick='checkedAll(<?=mysql_num_rows($_res)?>);' ></td>
			</tr>
			<? $_i = 1;?>
			<? while($_dat = mysql_fetch_assoc($_res)){ ?>
			<tr id="row<?=$_i?>">
				<td align="center"><?=$_i?></td>
				<td align="center"><?=$_dat['id']?></td>
				<td><?=$_dat['prefix'].$_dat['firstname']. ' ' .$_dat['lastname']?></td>
				<td align="center"><?=$_dat['nickname']!=""?$_dat['nickname']:"-"?></td>
				<td align="center"><?=$_dat['gpa']?></td>
				<td align="center"><?=displayStudentStatusColor($_dat['studstatus'])?></td>
				<td align="center"><?=getPoint($_dat['points'])?></td>
				<td align="center"><input type="checkbox" name="student[<?=$_i?>]" id="chk<?=$_i?>" value="<?=$_dat['id'] ?>" onclick="check('row<?=$_i?>',<?=$_i++?>)" <?=($_dat['studstatus']!=1 && $_dat['studstatus']!=3)?"disabled=disabled":""?>/></td>
			</tr>
			<? } //end while?>
			<tr>
				<td colspan="7" align="center">
					<input type="hidden" value="<?=$acadyear?>" name="acadyear" />
					<input type="hidden" value="<?=$_i?>" name="counter" />
					<input type="submit" name="save" value="เลื่อนชั้น" class="button" />
					<input type="button" value="ยกเลิก" class="button" onclick="location.href='index.php?option=module_history/index'" />
				</td>
			</tr>
		</table>
		</form>
	<? } else { //end check rows ?>
			<center><br/><font color="#008000">นักเรียนในห้องเรียนนี้ได้ทำการเลื่อนชั้นหมดแล้ว</font></center>
	<? } //end else ?>
<? }//end if ?>

<? if(isset($_POST['save'])){
		$_operation = false;
		for($_i = 1; $_i < $_POST['counter']; $_i++){
			if($_POST['student'][$_i] != "")
			{
				$_sql = "insert into students select
							ID, PREFIX, FIRSTNAME,LASTNAME,SCH_ID,
							xLevel,xYearth+1," . ($_POST['acadyear']+1) . ",ExEDBE,EnglishNAME,NICKNAME,
							SEX,PROGRAM,ROOM,ORDINAL,pin,BIRTHDAY,Race,Nationality,
							RELIGION,TALENT,ENT_YEAR,ENT_DATE,SCH_NAME,SCH_PROVINCE,
							SCH_LEVEL,SCH_CAUSE,SCH_Unit,SCH_Pass,SCH_GPA,SUBJECT_LIKE,
							SUBJECT_HATE,F_NAME,M_NAME,A_NAME,p_village,P_HOME,P_NO,P_GROUP,
							P_SOI,P_STREET,P_TUMBOL,P_AMPHUR,P_PROVINCE,P_ZIP,P_PHONE,mobile,
							fax,e_mail,blood_group,WEIGHT,HEIGHT,BMI,CRIPPLE,BTAMBOL,BAMPHUR,
							BPROVINCE,BHOSPITAL,F_EARN,F_Occupation,F_Mobile,M_EARN,M_Occupation,
							M_Mobile,All_EARN,FM_Status,A_EARN,A_Occupation,A_Mobile,A_Relation,
							GPA,PR,advisor11,advisor12,advisor21,advisor22,advisor31,advisor32,
							TrustTeacher1,TrustTeacher2,TrustTeacher3,education_loan1,education_loan2,
							education_loan3,Scout,ISSUE,students.LEAVE,CAUSE,studnote,studstatus,EPREFIX,
							EFIRSTNAME,ELASTNAME,ENationality,ERELIGION,ESCH_NAME,ESCH_COUNTRY,
							ESCH_GRADE,EF_NAME,EM_NAME,EA_NAME,EP_ADDRESS1,EP_ADDRESS2,
							EP_PROVINCE,EP_COUNTRY,EPlaceOfBirth,ECountryOfBirth,ESTUDNOTE,Start_Date,
							Expire_Date,InService,InTR_14,StudAbsent,retirecause,NextAcademic,NextRegion,
							StudJudge,F_Cripple,F_Status,M_Cripple,M_Status,travelby,HowLong,Dental,
							Scholar_Status,ScholarName1,ScholarName2,ScholarName3,GPA1,GPA2,GPA3,
							Change_Date,OLD_FIRSTNAME,OLD_LASTNAME,F_PIN,M_PIN,A_PIN,UTM_Coordinate_X,
							UTM_Coordinate_Y,UTM_Zone,100,Color
							from students where id = '" .$_POST['student'][$_i] . "' and xedbe = '" . $_POST['acadyear'] ."'";
				mysql_query($_sql) or die ('ผิดพลาดเนื่องจาก ' . mysql_error() . '<br/>');
				$_operation = true;
				//echo $_i .'. ' .$_POST['student'][$_i].'<br/>';
				
			}
		}
		//----แสดงผลหากไม่มีการเลือกข้อมูลนักเรียนคนใดเลย
		if($_operation)
		{
			echo "<center><font color='green'><br/><br/>";
			echo "ระบบได้ดำเนินการเลื่อนชั้นนักเรียนจากรายการที่เลือกเรียบร้อยแล้ว<br/><br/> ";
			echo "<input type='button' value='ดำเนินการต่อไป' onclick=\"location.href='index.php?option=module_history/studentSetUplevel&acadyear=" . $_POST['acadyear'] . "'\"/>";
			echo "</font></center>";
		}
		else
		{
			echo "<font color='red'><center><br/><br/>ยังไม่มีการดำเนินการใดๆ<br/>เนื่องจากคุณยังไม่ได้เลือกรายการเลื่อนชั้นของนักเรียน<br/><br/>";
			echo "<input type='button' value='ย้อนกลับ' onclick=\"history.go(-1)\" />";
			echo "</center></font>";
		}
	}
?>
</div>


