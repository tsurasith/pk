<SCRIPT language="javascript" type="text/javascript">
      function isNumberKey(evt) {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
      }
   </SCRIPT>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td align="center">
      <a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.1 แก้ไขประวัตินักเรียนในที่ปรึกษา(ทุกรายการ)</strong></font></span></td>
      <td >
	  			
		<?  $s_id;
			if(isset($_POST['search']) || isset($_POST['update'])){ $s_id = $_POST['student_id'];}
			else if(isset($_REQUEST['studentID'])){$s_id = $_REQUEST['studentID'];}

			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_history/studentEdit&studentID=". $s_id . "&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/studentEdit&studentID=". $s_id . "&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font><br/>
		<form method="post">
			<font color="#000000" size="2">
			เลขประจำตัวนักเรียน 
			<input type="text" size="5" maxlength="5" readonly name="student_id" value="<?=$s_id?>" onkeypress="return isNumberKey(event)" class="inputboxUpdate" />
			<input type="submit" value="เรียกดู" name="search" class="button"/>
			</font>
		</form>
	  </td>
    </tr>
</table>

<? if(isset($_POST['search']) && $s_id == "") { ?>
  		<center><br/><font color="#FF0000">กรุณาป้อนเลขประจำตัวนักเรียนก่อน </font></center>
<? } else if(isset($_POST['update']) && $_POST['student_id'] != "") { ?>
		<table class="admintable" align="center" width="100%">
			<tr><td colspan="2" class="key">ผลการแก้ไขข้อมูล</td></tr>
			<tr>
				<td>
					<?php
						$_sqlUpdate = "update students set ";
						$_sqlUpdate .= "PREFIX = 	'" . $_POST['PREFIX'] . "',";
						$_sqlUpdate .= "FIRSTNAME =	'" . trim($_POST['FIRSTNAME']) . "',";
						$_sqlUpdate .= "LASTNAME =	'" . trim($_POST['LASTNAME']) . "',";
						$_sqlUpdate .= "EnglishNAME = '" . trim($_POST['EnglishNAME']) . "',";
						$_sqlUpdate .= "NICKNAME = 	'" . trim($_POST['NICKNAME']) . "',";
						$_sqlUpdate .= "SEX = 		'" . trim($_POST['SEX']) . "',";
						$_sqlUpdate .= "ROOM = 		'" . trim($_POST['ROOM']) . "',";
						$_sqlUpdate .= "ORDINAL =	'" . trim($_POST['ORDINAL']) . "',";
						$_sqlUpdate .= "pin =		'" . trim($_POST['pin']) . "',";
						$_sqlUpdate .= "BIRTHDAY =	'" . trim($_POST['BIRTHDAY']) . "',";
						$_sqlUpdate .= "Race =		'" . $_POST['Race'] . "',";
						$_sqlUpdate .= "Nationality =	'" . $_POST['Nationality'] . "',";
						$_sqlUpdate .= "RELIGION =	'" . $_POST['RELIGION'] . "',";
						$_sqlUpdate .= "TALENT =	'" . trim($_POST['TALENT']) . "',";
						$_sqlUpdate .= "ENT_YEAR =	'" . $_POST['ENT_YEAR'] . "',";
						$_sqlUpdate .= "ENT_DATE =	'" . $_POST['ENT_DATE'] . "',";
						$_sqlUpdate .= "SCH_NAME =	'" . trim($_POST['SCH_NAME']) . "',";
						$_sqlUpdate .= "SCH_PROVINCE =	'" . trim($_POST['SCH_PROVINCE']) . "',";
						$_sqlUpdate .= "SCH_LEVEL =	'" . trim($_POST['SCH_LEVEL']) . "',";
						$_sqlUpdate .= "SCH_CAUSE =	'" . trim($_POST['SCH_CAUSE']) . "',";
						$_sqlUpdate .= "SCH_Unit =	'" . $_POST['SCH_Unit'] . "',";
						$_sqlUpdate .= "SCH_Pass =	'" . $_POST['SCH_Pass'] . "',";
						$_sqlUpdate .= "SCH_GPA =	'" . $_POST['SCH_GPA'] . "',";
						$_sqlUpdate .= "SUBJECT_LIKE =	'" . trim($_POST['SUBJECT_LIKE']) . "',";
						$_sqlUpdate .= "SUBJECT_HATE =	'" . trim($_POST['SUBJECT_HATE']) . "',";
						$_sqlUpdate .= "F_NAME =	'" . trim($_POST['F_NAME']) . "',";
						$_sqlUpdate .= "M_NAME =	'" . trim($_POST['M_NAME']) . "',";
						$_sqlUpdate .= "A_NAME =	'" . trim($_POST['A_NAME']) . "',";
						$_sqlUpdate .= "p_village =	'" . trim($_POST['p_village']) . "',";
						$_sqlUpdate .= "P_HOME =	'" . trim($_POST['P_HOME']) . "',";
						$_sqlUpdate .= "P_NO =		'" . $_POST['P_NO'] . "',";
						$_sqlUpdate .= "P_GROUP =	'" . $_POST['P_GROUP'] . "',";
						$_sqlUpdate .= "P_SOI =		'" . $_POST['P_SOI'] . "',";
						$_sqlUpdate .= "P_STREET =	'" . trim($_POST['P_STREET']) . "',";
						$_sqlUpdate .= "P_TUMBOL =	'" . trim($_POST['P_TUMBOL']) . "',";
						$_sqlUpdate .= "P_AMPHUR =	'" . trim($_POST['P_AMPHUR']) . "',";
						$_sqlUpdate .= "P_PROVINCE ='" . trim($_POST['P_PROVINCE']) . "',";
						$_sqlUpdate .= "P_ZIP =		'" . trim($_POST['P_ZIP']) . "',";
						$_sqlUpdate .= "P_PHONE =	'" . $_POST['P_PHONE'] . "',";
						$_sqlUpdate .= "mobile =	'" . $_POST['mobile'] . "',";
						$_sqlUpdate .= "fax =		'" . $_POST['fax'] . "',";
						$_sqlUpdate .= "e_mail =	'" . trim($_POST['e_mail']) . "',";
						$_sqlUpdate .= "blood_group =	'" . $_POST['blood_group'] . "',";
						$_sqlUpdate .= "WEIGHT =	'" . $_POST['WEIGHT'] . "',";
						$_sqlUpdate .= "HEIGHT =	'" . $_POST['HEIGHT'] . "',";
						$_sqlUpdate .= "BMI =		'" . @($_POST['WEIGHT']/($_POST['HEIGHT'] * $_POST['HEIGHT']/10000)) . "',";
						$_sqlUpdate .= "CRIPPLE =	'" . $_POST['CRIPPLE'] . "',";
						$_sqlUpdate .= "BTAMBOL =	'" . trim($_POST['BTAMBOL']) . "',";
						$_sqlUpdate .= "BAMPHUR =	'" . trim($_POST['BAMPHUR']) . "',";
						$_sqlUpdate .= "BPROVINCE =	'" . trim($_POST['BPROVINCE']) . "',";
						$_sqlUpdate .= "BHOSPITAL =	'" . trim($_POST['BHOSPITAL']) . "',";
						$_sqlUpdate .= "F_EARN =	'" . trim($_POST['F_EARN']) . "',";
						$_sqlUpdate .= "F_Occupation =	'" . $_POST['F_Occupation'] . "',";
						$_sqlUpdate .= "F_Mobile =	'" . trim($_POST['F_Mobile']) . "',";
						$_sqlUpdate .= "M_EARN =	'" . trim($_POST['M_EARN']) . "',";
						$_sqlUpdate .= "M_Occupation =	'" . $_POST['M_Occupation'] . "',";
						$_sqlUpdate .= "M_Mobile =	'" . trim($_POST['M_Mobile']) . "',";
						$_sqlUpdate .= "All_EARN =	'" . trim($_POST['All_EARN']) . "',";
						$_sqlUpdate .= "FM_Status =	'" . $_POST['FM_Status'] . "',";
						$_sqlUpdate .= "A_EARN =	'" . trim($_POST['A_EARN']) . "',";
						$_sqlUpdate .= "A_Occupation =	'" . $_POST['A_Occupation'] . "',";
						$_sqlUpdate .= "A_Mobile =	'" . trim($_POST['A_Mobile']) . "',";
						$_sqlUpdate .= "A_Relation ='" . $_POST['A_Relation'] . "',";
						$_sqlUpdate .= "GPA =	'" . $_POST['GPA'] . "',";
						$_sqlUpdate .= "PR =	'" . $_POST['PR'] . "',";
						$_sqlUpdate .= "advisor11 =	'" . $_POST['advisor11'] . "',";
						$_sqlUpdate .= "advisor12 =	'" . $_POST['advisor12'] . "',";
						$_sqlUpdate .= "advisor21 =	'" . $_POST['advisor21'] . "',";
						$_sqlUpdate .= "advisor22 =	'" . $_POST['advisor22'] . "',";
						$_sqlUpdate .= "advisor31 =	'" . $_POST['advisor31'] . "',";
						$_sqlUpdate .= "advisor32 =	'" . $_POST['advisor32'] . "',";
						$_sqlUpdate .= "TrustTeacher1 =	'" . $_POST['TrustTeacher1'] . "',";
						$_sqlUpdate .= "TrustTeacher2 =	'" . $_POST['TrustTeacher2'] . "',";
						$_sqlUpdate .= "TrustTeacher3 =	'" . $_POST['TrustTeacher3'] . "',";
						$_sqlUpdate .= "education_loan1 =	'" . $_POST['education_loan1'] . "',";
						$_sqlUpdate .= "education_loan2 =	'" . $_POST['education_loan2'] . "',";
						$_sqlUpdate .= "education_loan3 =	'" . $_POST['education_loan3'] . "',";
						$_sqlUpdate .= "Scout =		'" . $_POST['Scout'] . "',";
						$_sqlUpdate .= "ISSUE =		'" . trim($_POST['ISSUE']) . "',";
						$_sqlUpdate .= "students.LEAVE =		'" . trim($_POST['LEAVE']) . "',";
						$_sqlUpdate .= "CAUSE =		'" . trim($_POST['CAUSE']) . "',";
						$_sqlUpdate .= "studnote =	'" . trim($_POST['studnote']) . "',";
						$_sqlUpdate .= "studstatus ='" . $_POST['studstatus'] . "',";
						$_sqlUpdate .= "Start_Date ='" . $_POST['Start_Date'] . "',";
						$_sqlUpdate .= "Expire_Date =	'" . $_POST['Expire_Date'] . "',";
						$_sqlUpdate .= "InService =	'" . $_POST['InService'] . "',";
						$_sqlUpdate .= "InTR_14 =	'" . $_POST['InTR_14'] . "',";
						$_sqlUpdate .= "StudAbsent ='" . $_POST['StudAbsent'] . "',";
						$_sqlUpdate .= "retirecause =	'" . $_POST['retirecause'] . "',";
						$_sqlUpdate .= "NextAcademic =	'" . $_POST['NextAcademic'] . "',";
						$_sqlUpdate .= "NextRegion ='" . $_POST['NextRegion'] . "',";
						$_sqlUpdate .= "StudJudge =	'" . $_POST['StudJudge'] . "',";
						$_sqlUpdate .= "F_Cripple =	'" . $_POST['F_Cripple'] . "',";
						$_sqlUpdate .= "F_Status =	'" . $_POST['F_Status'] . "',";
						$_sqlUpdate .= "M_Cripple =	'" . $_POST['M_Cripple'] . "',";
						$_sqlUpdate .= "M_Status =	'" . $_POST['M_Status'] . "',";
						$_sqlUpdate .= "travelby =	'" . $_POST['travelby'] . "',";
						$_sqlUpdate .= "HowLong =	'" . $_POST['HowLong'] . "',";
						$_sqlUpdate .= "Dental =	'" . $_POST['Dental'] . "',";
						$_sqlUpdate .= "Scholar_Status ='" . $_POST['Scholar_Status'] . "',";
						$_sqlUpdate .= "ScholarName1 ='" . trim($_POST['ScholarName1']) . "',";
						$_sqlUpdate .= "ScholarName2 ='" . trim($_POST['ScholarName2']) . "',";
						$_sqlUpdate .= "ScholarName3 ='" . trim($_POST['ScholarName3']) . "',";
						$_sqlUpdate .= "GPA1 =		'" . $_POST['GPA1'] . "',";
						$_sqlUpdate .= "GPA2 =		'" . $_POST['GPA2'] . "',";
						$_sqlUpdate .= "GPA3 =		'" . $_POST['GPA3'] . "',";
						$_sqlUpdate .= "Change_Date ='" . $_POST['Change_Date'] . "',";
						$_sqlUpdate .= "OLD_FIRSTNAME =	'" . $_POST['OLD_FIRSTNAME'] . "',";
						$_sqlUpdate .= "OLD_LASTNAME =	'" . $_POST['OLD_LASTNAME'] . "',";
						$_sqlUpdate .= "F_PIN =		'" . $_POST['F_PIN'] . "',";
						$_sqlUpdate .= "M_PIN =		'" . $_POST['M_PIN'] . "',";
						$_sqlUpdate .= "A_PIN =		'" . $_POST['A_PIN'] . "',";
						$_sqlUpdate .= "UTM_Coordinate_X = '" . $_POST['UTM_Coordinate_X'] . "',";
						$_sqlUpdate .= "UTM_Coordinate_Y = '" . $_POST['UTM_Coordinate_Y'] . "',";
						$_sqlUpdate .= "UTM_Zone = '" . $_POST['UTM_Zone'] . "',";
						$_sqlUpdate .= "Color =	'" . $_POST['Color'] . "'";
						$_sqlUpdate .= " where ID =	'" . $_POST['student_id'] . "' and xEDBE = '" . $acadyear . "'";
						//echo $_sqlUpdate . "<br/>";
						if(mysql_query($_sqlUpdate)) {
							$_room = "";
							$_room = trim($_POST['level'])=="3"?trim($_POST['yearth']):trim($_POST['xYearth'])+3;
							$_room .= "/" . trim($_POST['ROOM']);
							echo "&nbsp; &nbsp; &nbsp; ";
							echo "<font color='green'><b>การดำเนินแก้ไขเรียบร้อยแล้ว</b></font><br/><br/>";
							echo "<form method='post' action='index.php?option=module_history/studentListUpdateHistory&acadyear=" . $acadyear . "'>";
							echo "&nbsp; &nbsp; &nbsp; ";
							echo "<input type='hidden' value='" . $_room ."' name='roomID'/>";
							echo "<input type='submit' value='ดำเนินการต่อ' name='search'/>";
							echo "</form>";
							
						}
						else { echo "<font color='red'>การดำเนินการผิดพลาดเนื่องจาก - " .  mysql_error() ."</font>"; }
					?>
				</td>
				<td></td>
			</tr>
		</table>
<?	}	else if($s_id != ""){ 
		$_sql = "select * from students where xEDBE = '" . $acadyear . "' and ID = '" . $s_id ."'";
		$_res = mysql_query($_sql);
		if(isset($_POST['student_id']))
		if(mysql_num_rows($_res)>0)
		{
			$_dat = mysql_fetch_assoc($_res);
			$_fields = 1; ?>
			<form method="post">
			<table class="admintable" cellpadding="0" cellspacing="0" align="center" width="100%">
				<tr><td colspan="3" class="key">ข้อมูลส่วนตัว(ประวัติหลัก)</td></tr>
				<tr><td align="center" width="50px"><?=$_fields++?>.</td><td align="right" >เลขประจำตัว :</td>
					<td><input type="text" value="<?=$_dat['ID']?>" name="ID" disabled="disabled" size="5" class="inputboxUpdate" /></td>
				</tr>
				<tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">คำนำหน้า :</td>
				  <td>
				  		<select name="PREFIX" class="inputboxUpdate">
				  		<? $_resPrefix = mysql_query("select prefix_detail from ref_prefix where prefix_id < 5");
						   while($_datPrefix = mysql_fetch_assoc($_resPrefix)) {  ?>
								<option value="<?=$_datPrefix['prefix_detail']?>" <?=($_dat['PREFIX']==$_datPrefix['prefix_detail']?"SELECTED":"")?>><?=$_datPrefix['prefix_detail']?></option>
						<?	} mysql_free_result($_resPrefix); ?>
						</select>
				  </td>
			  </tr>
				<tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ชื่อ :</td>
				  <td><input type="text" value="<?=$_dat['FIRSTNAME']?>" name="FIRSTNAME" class="inputboxUpdate" size="20" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">นามสกุล :</td>
				  <td><input type="text" value="<?=$_dat['LASTNAME']?>" name="LASTNAME" class="inputboxUpdate" size="20" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ชื่อเดิม :</td>
				  <td><input type="text" value="<?=$_dat['OLD_FIRSTNAME']?>" name="OLD_FIRSTNAME" class="inputboxUpdate" size="20" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">นามสกุลเดิม :</td>
				  <td><input type="text" value="<?=$_dat['OLD_LASTNAME']?>" name="OLD_LASTNAME" class="inputboxUpdate" size="20" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">วันที่ทำการเปลี่ยนชื่อ :</td>
				  <td>
				  		<input type="text" value="<?=$_dat['Change_Date']?>" name="Change_Date" class="inputboxUpdate" size="10" maxlength="10" />
						<font color="#FF0000"><b>*</b></font>
						ตัวอย่าง = 10/03/2548
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ระดับการศึกษา :</td>
				  <td>
				  		<select name="xLevel" class="inputboxUpdate" disabled="disabled">
							<option value="3" <?=($_dat['xLevel']==3?"selected":"")?>>มัธยมศึกษาตอนต้น</option>
							<option value="4" <?=($_dat['xLevel']==4?"selected":"")?>>มัธยมศึกษาตอนปลาย</option>
						</select>
                        <input type="hidden" name="level" value="<?=$_dat['xLevel']?>">
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ระดับชั้น :</td>
				  <td>
				  		<select name="xYearth" class="inputboxUpdate" disabled="disabled">
							<option value="1" <?=($_dat['xYearth']==1&&$_dat['xLevel']==3?"selected":"")?>>ม.1</option>
							<option value="2" <?=($_dat['xYearth']==2&&$_dat['xLevel']==3?"selected":"")?>>ม.2</option>
							<option value="3" <?=($_dat['xYearth']==3&&$_dat['xLevel']==3?"selected":"")?>>ม.3</option>
							<option value="1" <?=($_dat['xYearth']==1&&$_dat['xLevel']==4?"selected":"")?>>ม.4</option>
							<option value="2" <?=($_dat['xYearth']==2&&$_dat['xLevel']==4?"selected":"")?>>ม.5</option>
							<option value="3" <?=($_dat['xYearth']==3&&$_dat['xLevel']==4?"selected":"")?>>ม.6</option>
						</select>
                        <input type="hidden" name="yearth" value="<?=$_dat['xYearth']?>">
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ห้อง :</td>
				  <td><input type="text" value="<?=$_dat['ROOM']?>" name="ROOM" class="inputboxUpdate" size="2" maxlength="2" onKeyPress="return isNumberKey(event)" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">เลขที่ :</td>
				  <td><input type="text" value="<?=$_dat['ORDINAL']?>" name="ORDINAL" class="inputboxUpdate" size="2" maxlength="2" onKeyPress="return isNumberKey(event)" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ปีการศึกษา :</td>
				  <td><input type="text" value="<?=$_dat['xEDBE']?>" name="xEDBE" class="inputboxUpdate" size="4" disabled="disabled" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ชื่อภาษาอังกฤษ :</td>
				  <td><input type="text" value="<?=$_dat['EnglishNAME']?>" name="EnglishNAME" class="inputboxUpdate" size="30" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ชื่อเล่น :</td>
				  <td><input type="text" value="<?=$_dat['NICKNAME']?>" name="NICKNAME" class="inputboxUpdate" size="10" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">เพศ :</td>
				  <td>
				  		<input type="radio" name="SEX" value="1" <?=($_dat['SEX']==1?"checked":"")?> /> ชาย | <input type="radio" name="SEX" value="2" <?=($_dat['SEX']==2?"checked":"")?>/> หญิง				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">เลขบัตรประจำตัวประชาชน :</td>
				  <td><input type="text" value="<?=$_dat['pin']?>" name="pin" class="inputboxUpdate" size="13" maxlength="13" onKeyPress="return isNumberKey(event)" />
				  		<font color="#FF0000"><b>*</b></font> 13 หลัก ตัวอย่าง 3360622114897
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">วัน/เดือน/ปี เกิด :</td>
				  <td>
				  		<input type="text" value="<?=$_dat['BIRTHDAY']?>" name="BIRTHDAY" class="inputboxUpdate" size="10" maxlength="10" />
						<font color="#FF0000"><b>*</b></font>
						ตัวอย่าง ถ้าเกิดวันที่ 4 มีนาคม 2535 = 04/03/2535
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">เชื้อชาติ :</td>
				  <td>
				  		<select name="Race" class="inputboxUpdate">
				  		<?php
							$_resRace = mysql_query("select race_id,race_description from ref_race");
							while($_datRace = mysql_fetch_assoc($_resRace))
							{  ?>
								<option value="<?=$_datRace['race_id']?>" <?=($_dat['Race']==$_datRace['race_id']?"SELECTED":"")?>><?=$_datRace['race_description']?></option>
						<?	} mysql_free_result($_resRace);
						?>
						</select>
					</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">สัญชาติ :</td>
				  <td>
				  		<select name="Nationality" class="inputboxUpdate">
				  		<?php
							$_resNation = mysql_query("SELECT * FROM ref_nationality");
							while($_datNation = mysql_fetch_assoc($_resNation))
							{  ?>
								<option value="<?=$_datNation['nation_id']?>" <?=($_dat['Nationality']==$_datNation['nation_id']?"SELECTED":"")?>><?=$_datNation['nation_description']?></option>
						<?	} mysql_free_result($_resNation);
						?>
						</select>
					</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ศาสนา :</td>
				  <td>
				  		<select name="RELIGION" class="inputboxUpdate">
				  		<?php
							$_resReligion = mysql_query("SELECT * FROM ref_religion");
							while($_datReligion = mysql_fetch_assoc($_resReligion))
							{  ?>
								<option value="<?=$_datReligion['religion_id']?>" <?=($_dat['RELIGION']==$_datReligion['religion_id']?"SELECTED":"")?>><?=$_datReligion['religion_description']?></option>
						<?	} mysql_free_result($_resReligion);
						?>
						</select>
					</td>
			  </tr>
			  <tr>
				  <td align="center" valign="top"><?=$_fields++?>.</td>
				  <td align="right" valign="top">ความสามารถพิเศษ :</td>
				  <td><textarea name="TALENT" cols="60" class="inputboxUpdate" rows="4" ><?=ltrim(rtrim($_dat['TALENT']))?></textarea></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ปีที่เข้าศึกษา :</td>
				  <td><input type="text" value="<?=$_dat['ENT_YEAR']?>" name="ENT_YEAR" class="inputboxUpdate" size="5" maxlength="4" onkeypress="return isNumberKey(event)" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">วัน/เดือน/ปี ที่เข้าศึกษา :</td>
				  <td>
				  		<input type="text" value="<?=$_dat['ENT_DATE']?>" name="ENT_DATE" class="inputboxUpdate" size="10" maxlength="10" />
						<font color="#FF0000"><b>*</b></font>
						ตัวอย่าง = 31/05/2545
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">วิธีการเข้าศึกษา :</td>
				  <td>
				  		<select name="StudJudge" class="inputboxUpdate">
				  		<?php
							$_resStudjudge = mysql_query("SELECT * FROM ref_studjudge");
							while($_datJudge = mysql_fetch_assoc($_resStudjudge))
							{  ?>
								<option value="<?=$_datJudge['judge_id']?>" <?=($_dat['StudJudge']==$_datJudge['judge_id']?"SELECTED":"")?>><?=$_datJudge['judge_description']?></option>
						<?	} mysql_free_result($_resStudjudge); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">วันที่ออกบัตรนักเรียน :</td>
				  <td>
				  		<input type="text" value="<?=$_dat['Start_Date']?>" name="Start_Date" class="inputboxUpdate" size="10" maxlength="10" />
						<font color="#FF0000"><b>*</b></font>
						ตัวอย่าง = 01/06/2545
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">วันที่บัตรนักเรียนหมดอายุ :</td>
				  <td>
				  		<input type="text" value="<?=$_dat['Expire_Date']?>" name="Expire_Date" class="inputboxUpdate" size="10" maxlength="10" />
						<font color="#FF0000"><b>*</b></font>
						ตัวอย่าง = 31/03/2548
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">โรงเรียนเดิม :</td>
				  <td><input type="text" value="<?=$_dat['SCH_NAME']?>" name="SCH_NAME" class="inputboxUpdate" size="30" />
				  		<font color="#FF0000"><b>*</b></font> ตัวอย่าง โรงเรียนโป่งนกประชาสามัคคี
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">จังหวัดของโรงเรียนเดิม :</td>
				  <td>
				  		<select name="SCH_PROVINCE" class="inputboxUpdate">
				  		<option value=""></option>
						<? $_resProvince = mysql_query("SELECT * FROM ref_province");
						   while($_datProvince = mysql_fetch_assoc($_resProvince)) {  ?>
								<option value="<?=$_datProvince['prov_description']?>" <?=($_dat['SCH_PROVINCE']==$_datProvince['prov_description']?"SELECTED":"")?>><?=$_datProvince['prov_description']?></option>
						<?	} mysql_free_result($_resProvince); ?>
						</select>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ระดับการศึกษาที่ได้จากโรงเรียนเดิม :</td>
				  <td>
				  		<select name="SCH_LEVEL" class="inputboxUpdate">
				  			<option value=""></option>
							<option value="ประถมศึกษา" <?=($_dat['SCH_LEVEL']=="ประถมศึกษา"?"SELECTED":"")?>>ประถมศึกษา</option>
							<option value="มัธยมศึกษาตอนต้น" <?=($_dat['SCH_LEVEL']=="มัธยมศึกษาตอนต้น"?"SELECTED":"")?>>มัธยมศึกษาตอนต้น</option>
							<option value="มัธยมศึกษาตอนปลาย" <?=($_dat['SCH_LEVEL']=="มัธยมศึกษาตอนปลาย"?"SELECTED":"")?>>มัธยมศึกษาตอนปลาย</option>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">สาเหตุที่ออกจากโรงเรียนเดิม :</td>
				  <td>
				  		<select name="SCH_CAUSE" class="inputboxUpdate">
				  			<option value=""></option>
							<option value="สำเร็จการศึกษา" <?=($_dat['SCH_CAUSE']=="สำเร็จการศึกษา"?"SELECTED":"")?>>สำเร็จการศึกษา</option>
							<option value="ย้ายสถานศึกษา" <?=($_dat['SCH_CAUSE']=="ย้ายสถานศึกษา"?"SELECTED":"")?>>ย้ายสถานศึกษา</option>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">หน่วยการเรียนที่เรียนทั้งหมดโรงเรียนเดิม :</td>
				  <td><input type="text" value="<?=$_dat['SCH_Unit']?>" name="SCH_Unit" class="inputboxUpdate" size="5" maxlength="6" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">หน่วยการเรียนที่ผ่านโรงเรียนเดิม :</td>
				  <td><input type="text" value="<?=$_dat['SCH_Pass']?>" name="SCH_Pass" class="inputboxUpdate" size="5" maxlength="6" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ผลการเรียนจากโรงเรียนเดิม :</td>
				  <td><input type="text" value="<?=$_dat['SCH_GPA']?>" name="SCH_GPA" class="inputboxUpdate" size="5" maxlength="5" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">วิชาที่ถนัด/ชอบ :</td>
				  <td><input type="text" value="<?=$_dat['SUBJECT_LIKE']?>" name="SUBJECT_LIKE" class="inputboxUpdate" size="30" /> <font color="#FF0000"><b>*</b></font> ตัวอย่าง "คณิตศาสตร์"</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">วิชาที่ไม่ถนัด/ไม่ชอบ :</td>
				  <td><input type="text" value="<?=$_dat['SUBJECT_HATE']?>" name="SUBJECT_HATE" class="inputboxUpdate" size="30" /> <font color="#FF0000"><b>*</b></font> ตัวอย่าง "คณิตศาสตร์"</td>
			  </tr>
			   <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">เลขบัตรประจำตัวประชาชนบิดา :</td>
				  <td><input type="text" value="<?=$_dat['F_PIN']?>" name="F_PIN" class="inputboxUpdate" size="13" maxlength="13" onkeypress="return isNumberKey(event)" /> <font color="#FF0000"><b>*</b></font> 13 หลัก เช่น 3360622114897</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ชื่อ-สกุล บิดา :</td>
				  <td><input type="text" value="<?=$_dat['F_NAME']?>" name="F_NAME" class="inputboxUpdate" size="30" /> <font color="#FF0000"><b>*</b></font> ตัวอย่าง นายคุณธรรม ลูกกตัญญู</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">รายได้บิดา :</td>
				  <td><input type="text" value="<?=$_dat['F_EARN']?>" name="F_EARN" class="inputboxUpdate" size="9" maxlength="11" /> บาท/ปี <font color="#FF0000"><b>*</b></font> ตัวอย่าง 80000 (ไม่ต้องมีเครื่องหมาย ,)</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">อาชีพบิดา :</td>
				  <td>
				  		<select name="F_Occupation" class="inputboxUpdate">
				  		<?  $_resOCC = mysql_query("SELECT occ_id,occ_description FROM ref_occupation");
							while($_datOCC = mysql_fetch_assoc($_resOCC)) {  ?>
								<option value="<?=$_datOCC['occ_id']?>" <?=($_dat['F_Occupation']==$_datOCC['occ_id']?"SELECTED":"")?>><?=$_datOCC['occ_description']?></option>
						<?	} mysql_free_result($_resOCC); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">หมายเลขโทรศัพท์บิดา :</td>
				  <td><input type="text" value="<?=$_dat['F_Mobile']?>" name="F_Mobile" class="inputboxUpdate" size="10"  maxlength="10" onkeypress="return isNumberKey(event)"/> <font color="#FF0000"><b>*</b></font> ไม่ต้องเว้นวรรค</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">สถานะความพิการของบิดา :</td>
				  <td>
				  		<select name="F_Cripple" class="inputboxUpdate">
				  		<?  $_resCripple = mysql_query("SELECT * FROM ref_cripple");
							while($_datCripple = mysql_fetch_assoc($_resCripple)) {  ?>
								<option value="<?=$_datCripple['cripple_id']?>" <?=($_dat['F_Cripple']==$_datCripple['cripple_id']?"SELECTED":"")?>><?=$_datCripple['cripple_description']?></option>
						<?	} mysql_free_result($_resCripple); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">สถานภาพของบิดา :</td>
				  <td>
				  		<input type="radio" name="F_Status" value="1" <?=($_dat['F_Status']==1?"checked":"")?> /> ยังมีชีวิต | 
						<input type="radio" name="F_Status" value="0" <?=($_dat['F_Status']==0?"checked":"")?> /> ถึงแก่กรรม
				  </td>
			  </tr>
			   <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">เลขบัตรประจำตัวประชาชนมารดา :</td>
				  <td><input type="text" value="<?=$_dat['M_PIN']?>" name="M_PIN" class="inputboxUpdate" size="13" maxlength="13" onkeypress="return isNumberKey(event)" /> <font color="#FF0000"><b>*</b></font> 13 หลัก ตัวอย่าง 3360622114897</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ชื่อ-สกุล มารดา :</td>
				  <td><input type="text" value="<?=$_dat['M_NAME']?>" name="M_NAME" class="inputboxUpdate" size="30" /> <font color="#FF0000"><b>*</b></font> ตัวอย่าง นางประสพสุข ลูกกตัญญู</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">รายได้มารดา :</td>
				  <td><input type="text" value="<?=$_dat['M_EARN']?>" name="M_EARN" class="inputboxUpdate" size="9" maxlength="11" /> บาท/ปี <font color="#FF0000"><b>*</b></font> ตัวอย่าง 80000 (ไม่ต้องมีเครื่องหมาย ,)</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">อาชีพมารดา :</td>
				  <td>
				  		<select name="M_Occupation" class="inputboxUpdate">
				  		<?  $_resOCCM = mysql_query("SELECT occ_id,occ_description FROM ref_occupation");
							while($_datOCCM = mysql_fetch_assoc($_resOCCM)) {  ?>
								<option value="<?=$_datOCCM['occ_id']?>" <?=($_dat['M_Occupation']==$_datOCCM['occ_id']?"SELECTED":"")?>><?=$_datOCCM['occ_description']?></option>
						<?	} mysql_free_result($_resOCCM); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">หมายเลขโทรศัพท์มารดา :</td>
				  <td><input type="text" value="<?=$_dat['M_Mobile']?>" name="M_Mobile" class="inputboxUpdate" size="10" maxlength="10" onkeypress="return isNumberKey(event)" /> <font color="#FF0000"><b>*</b></font> ไม่ต้องเว้นวรรค</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">สถานะความพิการของมารดา :</td>
				  <td>
				  		<select name="M_Cripple" class="inputboxUpdate">
				  		<?  $_resCripple = mysql_query("SELECT * FROM ref_cripple");
							while($_datCripple = mysql_fetch_assoc($_resCripple)) {  ?>
								<option value="<?=$_datCripple['cripple_id']?>" <?=($_dat['M_Cripple']==$_datCripple['cripple_id']?"SELECTED":"")?>><?=$_datCripple['cripple_description']?></option>
						<?	} mysql_free_result($_resCripple); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">สถานภาพของมารดา :</td>
				  <td>
				  		<input type="radio" name="M_Status" value="1" <?=($_dat['M_Status']==1?"checked":"")?> /> ยังมีชีวิต | 
						<input type="radio" name="M_Status" value="0" <?=($_dat['M_Status']==0?"checked":"")?> /> ถึงแก่กรรม
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">รายได้รวมบิดาและมารดา :</td>
				  <td><input type="text" value="<?=$_dat['All_EARN']?>" name="All_EARN" class="inputboxUpdate" size="9" maxlength="11" /> <font color="#FF0000"><b>*</b></font> ตัวอย่าง 80000 (ไม่ต้องมีเครื่องหมาย ,)</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">สถานภาพบิดาและมารดา :</td>
				  <td>
				  		<select name="FM_Status" class="inputboxUpdate">
				  		<?  $_resFMStatus = mysql_query("SELECT * FROM ref_fmstatus");
							while($_datFMStatus = mysql_fetch_assoc($_resFMStatus)) {  ?>
								<option value="<?=$_datFMStatus['fmstatus_id']?>" <?=($_dat['FM_Status']==$_datFMStatus['fmstatus_id']?"SELECTED":"")?>><?=$_datFMStatus['fmstatus_description']?></option>
						<?	} mysql_free_result($_resFMStatus); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">เลขบัตรประจำตัวประชาชนผู้ปกครอง :</td>
				  <td><input type="text" value="<?=$_dat['A_PIN']?>" name="A_PIN" class="inputboxUpdate" size="13" maxlength="13" onkeypress="return isNumberKey(event)" /> <font color="#FF0000"><b>*</b></font> 13 หลัก ตัวอย่าง 3360622114897</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ชื่อ-สกุล ผู้ปกครอง :</td>
				  <td><input type="text" value="<?=$_dat['A_NAME']?>" name="A_NAME" class="inputboxUpdate" size="30" /> <font color="#FF0000"><b>*</b></font> ตัวอย่าง นางประสพสุข ลูกกตัญญู</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">รายได้ผู้ปกครอง :</td>
				  <td><input type="text" value="<?=$_dat['A_EARN']?>" name="A_EARN" class="inputboxUpdate" size="9" maxlength="11" /> บาท/ปี  <font color="#FF0000"><b>*</b></font> ตัวอย่าง 80000 (ไม่ต้องมีเครื่องหมาย ,)</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">รหัสอาชีพผู้ปกครอง :</td>
				  <td>
				  		<select name="A_Occupation" class="inputboxUpdate">
				  		<?  $_resOCCA = mysql_query("SELECT occ_id,occ_description FROM ref_occupation");
							while($_datOCCA = mysql_fetch_assoc($_resOCCA)) {  ?>
								<option value="<?=$_datOCCA['occ_id']?>" <?=($_dat['A_Occupation']==$_datOCCA['occ_id']?"SELECTED":"")?>><?=$_datOCCA['occ_description']?></option>
						<?	} mysql_free_result($_resOCCA); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">หมายเลขโทรศัพท์ผู้ปกครอง :</td>
				  <td><input type="text" value="<?=$_dat['A_Mobile']?>" name="A_Mobile" class="inputboxUpdate" size="10" maxlength="10" onkeypress="return isNumberKey(event)" /> <font color="#FF0000"><b>*</b></font> ไม่ต้องเว้นวรรค</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ความสัมพันธ์กับนักเรียนโดยเป็น :</td>
				  <td>
				  		<select name="A_Relation" class="inputboxUpdate">
				  		<?  $_resRelation = mysql_query("SELECT * FROM ref_relation");
							while($_datRelation = mysql_fetch_assoc($_resRelation)) {  ?>
								<option value="<?=$_datRelation['relation_id']?>" <?=($_dat['A_Relation']==$_datRelation['relation_id']?"SELECTED":"")?>><?=$_datRelation['relation_description']?></option>
						<?	} mysql_free_result($_resRelation); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ชื่อหมู่บ้านที่อาศัย :</td>
				  <td>
				  	<input type="text" value="<?=$_dat['p_village']?>" name="p_village" class="inputboxUpdate" size="20" /> 
					<font color="#FF0000"><b>*</b></font> ตัวอย่าง "บ้านหนองผักชี" , "บ้านตาเนิน"
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ชื่อบ้าน :</td>
				  <td><input type="text" value="<?=$_dat['P_HOME']?>" name="P_HOME" class="inputboxUpdate" size="20" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">บ้านเลขที่ :</td>
				  <td><input type="text" value="<?=$_dat['P_NO']?>" name="P_NO" class="inputboxUpdate" size="4"  /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">หมู่ที่ :</td>
				  <td><input type="text" value="<?=$_dat['P_GROUP']?>" name="P_GROUP" class="inputboxUpdate" size="2" maxlength="2" onkeypress="return isNumberKey(event)" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ซอย :</td>
				  <td><input type="text" value="<?=$_dat['P_SOI']?>" name="P_SOI" class="inputboxUpdate" size="10" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ถนน :</td>
				  <td><input type="text" value="<?=$_dat['P_STREET']?>" name="P_STREET" class="inputboxUpdate" size="15" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ตำบล :</td>
				  <td>
				  		<input type="text" value="<?=$_dat['P_TUMBOL']?>" name="P_TUMBOL" class="inputboxUpdate" size="15" />
						<font color="#FF0000"><b>*</b></font>
						ตัวอย่าง "หนองฉิม","ตาเนิน" เป็นต้น
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">อำเภอ :</td>
				  <td>
				  		<input type="text" value="<?=$_dat['P_AMPHUR']?>" name="P_AMPHUR" class="inputboxUpdate" size="15" />
						<font color="#FF0000"><b>*</b></font>
						ตัวอย่าง "บำเหน็จณรงค์","เมือง" เป็นต้น
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">จังหวัด :</td>
				  <td>
				  		<select name="P_PROVINCE" class="inputboxUpdate">
				  		<option value=""></option>
						<? $_resProvince = mysql_query("SELECT * FROM ref_province");
						   while($_datProvince = mysql_fetch_assoc($_resProvince)) {  ?>
								<option value="<?=$_datProvince['prov_description']?>" <?=($_dat['P_PROVINCE']==$_datProvince['prov_description']?"SELECTED":"")?>><?=$_datProvince['prov_description']?></option>
						<?	} mysql_free_result($_resProvince); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">รหัสไปรษณีย์ :</td>
				  <td><input type="text" value="<?=$_dat['P_ZIP']?>" name="P_ZIP" class="inputboxUpdate" size="5" maxlength="5" onkeypress="return isNumberKey(event)" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ตำแหน่งละติจูดที่บ้าน :</td>
				  <td><input type="text" value="<?=$_dat['UTM_Coordinate_X']?>" name="UTM_Coordinate_X" class="inputboxUpdate" size="20" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ตำแหน่งลองติจูดที่บ้าน :</td>
				  <td><input type="text" value="<?=$_dat['UTM_Coordinate_Y']?>" name="UTM_Coordinate_Y" class="inputboxUpdate" size="20" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">เส้นตำแหน่งเวลา :</td>
				  <td><input type="text" value="<?=$_dat['UTM_Zone']?>" name="UTM_Zone" class="inputboxUpdate" size="5" /> (ประเทศไทย +7GMT)</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">วิธีการเดินทางมาโรงเรียน :</td>
				  <td>
				  		<select name="travelby" class="inputboxUpdate">
				  		<?  $_resTravel = mysql_query("SELECT * FROM ref_travel");
							while($_datTravel = mysql_fetch_assoc($_resTravel)) {  ?>
								<option value="<?=$_datTravel['travel_id']?>" <?=($_dat['travelby']==$_datTravel['travel_id']?"SELECTED":"")?>><?=$_datTravel['travel_description']?></option>
						<?	} mysql_free_result($_resTravel); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">เวลาที่ใช้ในการเดินทาง :</td>
				  <td><input type="text" value="<?=$_dat['HowLong']?>" name="HowLong" class="inputboxUpdate" size="2" maxlength="3" onkeypress="return isNumberKey(event)" /> นาที</td>
			  </tr>
			   <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">การพักอาศัยของนักเรียน :</td>
				  <td>
				  		<select name="InService" class="inputboxUpdate">
				  		<?  $_resInService = mysql_query("SELECT * FROM ref_inservice");
							while($_datInService = mysql_fetch_assoc($_resInService)) {  ?>
								<option value="<?=$_datInService['service_id']?>" <?=($_dat['InService']==$_datInService['service_id']?"SELECTED":"")?>><?=$_datInService['service_description']?></option>
						<?	} mysql_free_result($_resInService); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">การมีชื่ออยู่ในทะเบียนบ้าน :</td>
				  <td>
				  		<input type="radio" name="InTR_14" value="1" <?=($_dat['InTR_14']==1?"checked":"")?>/> มี |
						<input type="radio" name="InTR_14" value="0" <?=($_dat['InTR_14']==0?"checked":"")?>/> ไม่มี
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">รหัสความขาดแคลนของนักเรียน :</td>
				  <td>
				  		<select name="StudAbsent" class="inputboxUpdate">
				  		<?  $_resAbsent = mysql_query("SELECT * FROM ref_studabsent");
							while($_datAbsent = mysql_fetch_assoc($_resAbsent)) {  ?>
								<option value="<?=$_datAbsent['absent_id']?>" <?=($_dat['StudAbsent']==$_datAbsent['absent_id']?"SELECTED":"")?>><?=$_datAbsent['absent_description']?></option>
						<?	} mysql_free_result($_resAbsent); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">หมายเลขโทรศัพท์ที่บ้าน :</td>
				  <td>
				  	<input type="text" value="<?=$_dat['P_PHONE']?>" name="P_PHONE" class="inputboxUpdate" size="10" maxlength="10" onkeypress="return isNumberKey(event)"/>
					<font color="#FF0000"><b>*</b></font> ตัวอย่าง "044891167" , "044846509"
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">หมายเลขมือถือ :</td>
				  <td>
				  	<input type="text" value="<?=$_dat['mobile']?>" name="mobile" class="inputboxUpdate" size="10" maxlength="10" onkeypress="return isNumberKey(event)" />
					<font color="#FF0000"><b>*</b></font> ตัวอย่าง "0862528451" , "0892356489"
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">หมายเลขโทรสาร :</td>
				  <td>
				  	<input type="text" value="<?=$_dat['fax']?>" name="fax" class="inputboxUpdate" size="10" maxlength="10" onkeypress="return isNumberKey(event)" />
					<font color="#FF0000"><b>*</b></font> ตัวอย่าง "044846453"
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">อีเมลนักเรียน :</td>
				  <td><input type="text" value="<?=$_dat['e_mail']?>" name="e_mail" class="inputboxUpdate" size="30" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">หมู่โลหิต :</td>
				  <td>
				  		<select name="blood_group" class="inputboxUpdate">
				  			<option value="เอ" <?=($_dat['blood_group']=="เอ"?"SELECTED":"")?>>เอ</option>
							<option value="บี" <?=($_dat['blood_group']=="บี"?"SELECTED":"")?>>บี</option>
							<option value="โอ" <?=($_dat['blood_group']=="โอ"?"SELECTED":"")?>>โอ</option>
							<option value="เอบี" <?=($_dat['blood_group']=="เอบี"?"SELECTED":"")?>>เอบี</option>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">น้ำหนัก :</td>
				  <td><input type="text" value="<?=$_dat['WEIGHT']?>" name="WEIGHT" class="inputboxUpdate" size="3" maxlength="6" /> กิโลกัรม </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ส่วนสูง :</td>
				  <td><input type="text" value="<?=$_dat['HEIGHT']?>" name="HEIGHT" class="inputboxUpdate" size="4" maxlength="6" /> เซนติเมตร </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ค่าดัชนีมวลกาย(BMI) :</td>
				  <td><input type="text" value="<?=$_dat['BMI']?>" name="BMI" class="inputboxUpdate" size="5"  maxlength="6" disabled="disabled" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">การมีปัญหาเรื่องสุขภาพฟัน :</td>
				  <td>
				  		<input type="radio" name="Dental" value="1" <?=($_dat['Dental']==1?"checked":"")?>/> มี |
						<input type="radio" name="Dental" value="0" <?=($_dat['Dental']==0?"checked":"")?>/> ไม่มี
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ความพิการของร่างกาย :</td>
				  <td>
				  		<select name="CRIPPLE" class="inputboxUpdate">
				  		<?php
							$_resCripple = mysql_query("SELECT * FROM ref_cripple");
							while($_datCripple = mysql_fetch_assoc($_resCripple))
							{  ?>
								<option value="<?=$_datCripple['cripple_id']?>" <?=($_dat['CRIPPLE']==$_datCripple['cripple_id']?"SELECTED":"")?>><?=$_datCripple['cripple_description']?></option>
						<?	} mysql_free_result($_resCripple); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ตำบลที่เกิด :</td>
				  <td><input type="text" value="<?=$_dat['BTAMBOL']?>" name="BTAMBOL" class="inputboxUpdate" size="20" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">อำเภอที่เกิด :</td>
				  <td><input type="text" value="<?=$_dat['BAMPHUR']?>" name="BAMPHUR" class="inputboxUpdate" size="20" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">จังหวัดที่เกิด :</td>
				  <td>
				  		<select name="BPROVINCE" class="inputboxUpdate">
				  		<option value=""></option>
						<? $_resProvince = mysql_query("SELECT * FROM ref_province");
						   while($_datProvince = mysql_fetch_assoc($_resProvince)) {  ?>
								<option value="<?=$_datProvince['prov_description']?>" <?=($_dat['BPROVINCE']==$_datProvince['prov_description']?"SELECTED":"")?>><?=$_datProvince['prov_description']?></option>
						<?	} mysql_free_result($_resProvince); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center" valign="top"><?=$_fields++?>.</td>
				  <td align="right" valign="top">โรงพยาบาลที่เกิด :</td>
				  <td>
				  		<input type="text" value="<?=$_dat['BHOSPITAL']?>" name="BHOSPITAL" class="inputboxUpdate" size="30" /><br/>
						<font color="#FF0000"><b>*</b></font> ตัวอย่าง "โรงพยาบาลบำเหน็จณรงค์" หรือ "สถานีอนามัยตาเนิน" หรือ <br/>
						ถ้าคลอดเองตามธรรมชาติ หรือ หมอตำแย ให้ระบุว่า "คลอดเองตามธรรมชาติ"
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">จำนวนเงินกู้ชั้นม.4 :</td>
				  <td><input type="text" value="<?=$_dat['education_loan1']?>" name="education_loan1" class="inputboxUpdate" size="5" maxlength="7" onkeypress="return isNumberKey(event)"/> บาท</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">จำนวนเงินกู้ชั้นม.5 :</td>
				  <td><input type="text" value="<?=$_dat['education_loan2']?>" name="education_loan2" class="inputboxUpdate" size="5" maxlength="7" onkeypress="return isNumberKey(event)"/> บาท</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">จำนวนเงินกู้ชั้นม.6 :</td>
				  <td><input type="text" value="<?=$_dat['education_loan3']?>" name="education_loan3" class="inputboxUpdate" size="5" maxlength="7" onkeypress="return isNumberKey(event)"/> บาท</td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">การเคยได้รับทุนการศึกษา :</td>
				  <td>
				  		<input type="radio" name="Scholar_Status" value="1" <?=($_dat['Scholar_Status']==1?"checked":"")?>/> เคยได้รับ |
						<input type="radio" name="Scholar_Status" value="0" <?=($_dat['Scholar_Status']==0?"checked":"")?>/> ไม่เคยได้รับ
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ทุนการศึกษาที่ได้รับครั้งที่ 1 :</td>
				  <td>
				  	<input type="text" value="<?=$_dat['ScholarName1']?>" name="ScholarName1" class="inputboxUpdate" size="40" />
					<font color="#FF0000"><b>*</b></font> ให้ระบุจำนวนเงินที่ได้รับด้วย
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ทุนการศึกษาที่ได้รับครั้งที่ 2 :</td>
				  <td>
				  	<input type="text" value="<?=$_dat['ScholarName2']?>" name="ScholarName2" class="inputboxUpdate" size="40" />
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ทุนการศึกษาที่ได้รับครั้งที่ 3 :</td>
				  <td><input type="text" value="<?=$_dat['ScholarName3']?>" name="ScholarName3" class="inputboxUpdate" size="40" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ผลการเรียนเฉลี่ยในปีที่ 1 :</td>
				  <td><input type="text" value="<?=$_dat['GPA1']?>" name="GPA1" class="inputboxUpdate" size="4" maxlength="4" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ผลการเรียนเฉลี่ยในปีที่ 2 :</td>
				  <td><input type="text" value="<?=$_dat['GPA2']?>" name="GPA2" class="inputboxUpdate" size="4"  maxlength="4"/></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ผลการเรียนเฉลี่ยในปีที่ 3 :</td>
				  <td><input type="text" value="<?=$_dat['GPA3']?>" name="GPA3" class="inputboxUpdate" size="4" maxlength="4" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ผลการเรียนเฉลี่ยรวมทั้งหมด :</td>
				  <td><input type="text" value="<?=$_dat['GPA']?>" name="GPA" class="inputboxUpdate" size="3" maxlength="4" /></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ตำแหน่งเปอร์เซ็นต์ไทน์ :</td>
				  <td><input type="text" value="<?=$_dat['PR']?>" name="PR" class="inputboxUpdate" size="3"  maxlength="5"/></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ครูที่ปรึกษาคนที่ 1 :</td>
				  <td>
						<? $_resTeacher = mysql_query("select teaccode,prefix,firstname,lastname from teachers order by firstname");?>
						<select name="advisor11" class="inputboxUpdate">
							<option value=""></option>
							<? while($_datAd = mysql_fetch_assoc($_resTeacher)){ ?>
							<option value="<?=$_datAd['teaccode']?>" <?=$_dat['advisor11']==$_datAd['teaccode']?"selected":""?> ><?=$_datAd['prefix'].$_datAd['firstname'].' '.$_datAd['lastname']?></option>
							<? } mysql_free_result($_resTeacher);//end while ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ครูที่ปรึกษาคนที่ 2 :</td>
				  <td>
				  		<? $_resTeacher = mysql_query("select teaccode,prefix,firstname,lastname from teachers order by firstname");?>
						<select name="advisor12" class="inputboxUpdate">
							<option value=""></option>
							<? while($_datAd = mysql_fetch_assoc($_resTeacher)){ ?>
							<option value="<?=$_datAd['teaccode']?>" <?=$_dat['advisor12']==$_datAd['teaccode']?"selected":""?> ><?=$_datAd['prefix'].$_datAd['firstname'].' '.$_datAd['lastname']?></option>
							<? } mysql_free_result($_resTeacher);//end while ?>
						</select>						
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ครูที่ปรึกษาคนที่ 3 :</td>
				  <td>
				  		<? $_resTeacher = mysql_query("select teaccode,prefix,firstname,lastname from teachers order by firstname");?>
						<select name="advisor21" class="inputboxUpdate">
							<option value=""></option>
							<? while($_datAd = mysql_fetch_assoc($_resTeacher)){ ?>
							<option value="<?=$_datAd['teaccode']?>" <?=$_dat['advisor21']==$_datAd['teaccode']?"selected":""?> ><?=$_datAd['prefix'].$_datAd['firstname'].' '.$_datAd['lastname']?></option>
							<? } mysql_free_result($_resTeacher);//end while ?>
						</select>	
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ครูที่ปรึกษาคนที่ 4 :</td>
				  <td>
				  		<? $_resTeacher = mysql_query("select teaccode,prefix,firstname,lastname from teachers order by firstname");?>
						<select name="advisor22" class="inputboxUpdate">
							<option value=""></option>
							<? while($_datAd = mysql_fetch_assoc($_resTeacher)){ ?>
							<option value="<?=$_datAd['teaccode']?>" <?=$_dat['advisor22']==$_datAd['teaccode']?"selected":""?> ><?=$_datAd['prefix'].$_datAd['firstname'].' '.$_datAd['lastname']?></option>
							<? } mysql_free_result($_resTeacher);//end while ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ครูที่ปรึกษาคนที่ 5 :</td>
				  <td>
				  		<? $_resTeacher = mysql_query("select teaccode,prefix,firstname,lastname from teachers order by firstname");?>
						<select name="advisor31" class="inputboxUpdate">
							<option value=""></option>
							<? while($_datAd = mysql_fetch_assoc($_resTeacher)){ ?>
							<option value="<?=$_datAd['teaccode']?>" <?=$_dat['advisor31']==$_datAd['teaccode']?"selected":""?> ><?=$_datAd['prefix'].$_datAd['firstname'].' '.$_datAd['lastname']?></option>
							<? } mysql_free_result($_resTeacher);//end while ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ครูที่ปรึกษาคนที่ 6 :</td>
				  <td>
				  		<? $_resTeacher = mysql_query("select teaccode,prefix,firstname,lastname from teachers order by firstname");?>
						<select name="advisor32" class="inputboxUpdate">
							<option value=""></option>
							<? while($_datAd = mysql_fetch_assoc($_resTeacher)){ ?>
							<option value="<?=$_datAd['teaccode']?>" <?=$_dat['advisor32']==$_datAd['teaccode']?"selected":""?> ><?=$_datAd['prefix'].$_datAd['firstname'].' '.$_datAd['lastname']?></option>
							<? } mysql_free_result($_resTeacher);//end while ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ครูที่นักเรียนไว้วางใจคนที่ 1 :</td>
				  <td>
				  		<? $_resTeacher = mysql_query("select teaccode,prefix,firstname,lastname from teachers order by firstname");?>
						<select name="TrustTeacher1" class="inputboxUpdate">
							<option value=""></option>
							<? while($_datAd = mysql_fetch_assoc($_resTeacher)){ ?>
							<option value="<?=$_datAd['teaccode']?>" <?=$_dat['TrustTeacher1']==$_datAd['teaccode']?"selected":""?> ><?=$_datAd['prefix'].$_datAd['firstname'].' '.$_datAd['lastname']?></option>
							<? } mysql_free_result($_resTeacher);//end while ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ครูที่นักเรียนไว้วางใจคนที่ 2 :</td>
				  <td>
				  		<? $_resTeacher = mysql_query("select teaccode,prefix,firstname,lastname from teachers order by firstname");?>
						<select name="TrustTeacher2" class="inputboxUpdate">
							<option value=""></option>
							<? while($_datAd = mysql_fetch_assoc($_resTeacher)){ ?>
							<option value="<?=$_datAd['teaccode']?>" <?=$_dat['TrustTeacher2']==$_datAd['teaccode']?"selected":""?> ><?=$_datAd['prefix'].$_datAd['firstname'].' '.$_datAd['lastname']?></option>
							<? } mysql_free_result($_resTeacher);//end while ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ครูที่นักเรียนไว้วางใจคนที่ 3 :</td>
				  <td>
				  		<? $_resTeacher = mysql_query("select teaccode,prefix,firstname,lastname from teachers order by firstname");?>
						<select name="TrustTeacher3" class="inputboxUpdate">
							<option value=""></option>
							<? while($_datAd = mysql_fetch_assoc($_resTeacher)){ ?>
							<option value="<?=$_datAd['teaccode']?>" <?=$_dat['TrustTeacher3']==$_datAd['teaccode']?"selected":""?> ><?=$_datAd['prefix'].$_datAd['firstname'].' '.$_datAd['lastname']?></option>
							<? } mysql_free_result($_resTeacher);//end while ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">การเรียนลูกเสือ/กิจกรรม :</td>
				  <td>
				  		<select name="Scout" class="inputboxUpdate">
				  		<?  $_resScout = mysql_query("SELECT * FROM ref_scout");
							while($_datScout = mysql_fetch_assoc($_resScout)) {  ?>
								<option value="<?=$_datScout['scout_id']?>" <?=($_dat['Scout']==$_datScout['scout_id']?"SELECTED":"")?>><?=$_datScout['scout_description']?></option>
						<?	} mysql_free_result($_resScout); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">คณะสี :</td>
				  <td>
				  		<select name="Color" class="inputboxUpdate">
				  		<? $_resColor = mysql_query("SELECT color_description FROM ref_color");
							while($_datColor = mysql_fetch_assoc($_resColor)) {  ?>
								<option value="<?=$_datColor['color_description']?>" <?=($_dat['Color']==$_datColor['color_description']?"SELECTED":"")?>><?=$_datColor['color_description']?></option>
						<?	} mysql_free_result($_resColor); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">สถานภาพปัจจุบัน :</td>
				  <td>
				  		<select name="studstatus" class="inputboxUpdate">
				  		<?  $_resStatus = mysql_query("SELECT * FROM ref_studstatus");
							while($_datStatus = mysql_fetch_assoc($_resStatus)) {  ?>
								<option value="<?=$_datStatus['studstatus']?>" <?=($_dat['studstatus']==$_datStatus['studstatus']?"SELECTED":"")?>><?=$_datStatus['studstatus_description']?></option>
						<?	} mysql_free_result($_resStatus); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">วันที่สำเร็จการศึกษา :</td>
				  <td>
				  		<input type="text" value="<?=$_dat['ISSUE']?>" name="ISSUE" class="inputboxUpdate" size="10" maxlength="10" onkeypress="return isKeyNumber(event)" />
						<font color="#FF0000"><b>*</b></font>
						ตัวอย่าง = 10/03/2548
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">วันที่ออกจากโรงเรียน :</td>
				  <td>
				  		<input type="text" value="<?=$_dat['LEAVE']?>" name="LEAVE" class="inputboxUpdate" size="10" maxlength="10" onkeypress="return isKeyNumber(event)" />
						<font color="#FF0000"><b>*</b></font>
						ตัวอย่าง = 10/03/2548
				  </td>
			  </tr>
			  <tr>
				  <td align="center" valign="top"><?=$_fields++?>.</td>
				  <td align="right" valign="top">สาเหตุที่ออกจากโรงเรียน :</td>
				  <td><textarea name="CAUSE" class="inputboxUpdate" rows="3" cols="40"><?=$_dat['CAUSE']?></textarea></td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ประเภทสาเหตุที่ออกจากโรงเรียน :</td>
				  <td>
				  		<select name="retirecause" class="inputboxUpdate">
				  		<?  $_resRetire = mysql_query("SELECT * FROM ref_retire");
							while($_datRe = mysql_fetch_assoc($_resRetire)) {  ?>
								<option value="<?=$_datRe['retire_id']?>" <?=($_dat['retirecause']==$_datRe['retire_id']?"SELECTED":"")?>><?=$_datRe['retire_description']?></option>
						<?	} mysql_free_result($_resRetire); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">ภูมิภาคที่นักเรียนศึกษาต่อ :</td>
				  <td>
				  		<select name="NextRegion" class="inputboxUpdate">
				  		<?  $_resNextRe = mysql_query("SELECT * FROM ref_nextregion");
							while($_datNextRe = mysql_fetch_assoc($_resNextRe)) {  ?>
								<option value="<?=$_datNextRe['id']?>" <?=($_dat['NextRegion']==$_datNextRe['id']?"SELECTED":"")?>><?=$_datNextRe['next_region']?></option>
						<?	} mysql_free_result($_resNextRe); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center"><?=$_fields++?>.</td>
				  <td align="right">รูปแบบสถานศึกษาที่ศึกษาต่อ :</td>
				  <td>
				  		<select name="NextAcademic" class="inputboxUpdate">
				  		<?  $_resNextAcad = mysql_query("SELECT * FROM ref_nextacademic");
							while($_datNextAcad = mysql_fetch_assoc($_resNextAcad)) {  ?>
								<option value="<?=$_datNextAcad['id']?>" <?=($_dat['NextAcademic']==$_datNextAcad['id']?"SELECTED":"")?>><?=$_datNextAcad['next_desc']?></option>
						<?	} mysql_free_result($_resNextAcad); ?>
						</select>
				  </td>
			  </tr>
			  <tr>
				  <td align="center" valign="top"><?=$_fields++?>.</td>
				  <td align="right" valign="top">บันทึกเพิ่มเติมสำหรับนักเรียน :</td>
				  <td><textarea name="studnote" class="inputboxUpdate" rows="3" cols="50"><?=$_dat['studnote']?></textarea></td>
			  </tr>
			  <tr>
			  	  <td></td>
				  <td align="right">
				  	<input type="hidden" value="<?=$_dat['ID']?>" name="student_id"/>				  </td>
				  <td>
				  		<input type="submit" value="บันทึก" name="update" class="button" /> 
						<input type="button" value="ยกเลิก" class="button" onclick="history.go(-2);" />				  </td>
			  </tr>
			</table>

			</form>
	<?	} //end if
		else
		{ ?>
			<table class="admintable" align="center" width="100%">
				<tr>
					<td align="center"><br/><font color="#FF0000">ไม่พบข้อมูลนักเรียน กรุณาตรวจสอบเลขประจำตัวนักเรียนอีกครั้ง</font></td>
				</tr>
			</table>
	<?	} }// end-else check rows ?>
<?	//} //end-else check submit update?>
</div> 
