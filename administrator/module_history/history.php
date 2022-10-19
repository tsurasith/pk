
<div id="content">
<form method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.1 สืบค้นประวัติส่วนตัว</strong></font></span></td>
      <td >
	  			
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					$_studentID =isset($_POST['studentid'])?$_POST['studentid']:$_REQUEST['studentid'];
					echo "<a href=\"index.php?option=module_history/history&acadyear=" . ($acadyear - 1) . "&studentid=$_studentID\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/history&acadyear=" . ($acadyear + 1) . "&studentid=$_studentID\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>		
	  	<font color="#000000" size="2">
			เลขประจำตัวนักเรียน
			<input type="text" size="5" maxlength="5" name="studentid" value="<?=isset($_POST['studentid'])?$_POST['studentid']:$_REQUEST['studentid']?>" onKeyPress="return isNumberKey(event)" id="studentid" class="inputboxUpdate"/>
	  		<input type="submit" value="สืบค้น" class="button" name="search"/>
		</font>
	  </td>
    </tr>
  </table>
  </form>
  <? if(isset($_POST['search']) && $_POST['studentid']=="") { ?>
  		<br/><center><font color="#FF0000">กรุณาป้อนเลขประจำตัวนักเรียนก่อน ! </font></center>
  <? } else if(isset($_POST['search']) || isset($_REQUEST['studentid'])) {
		$sql = "select * from students where ID = '" . (isset($_POST['studentid'])?$_POST['studentid']:$_REQUEST['studentid']) . "' and xedbe = '" . $acadyear . "' order by xedbe desc limit 0,1 ";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) > 0) { ?>
		<? $dat = mysql_fetch_assoc($result); ?>
			<br/>
			<table class="admintable"  cellpadding="0" cellspacing="0" border="0" align="center">
				<tr height="35px"> 
					<td class="key" colspan="4" align="center">
						ข้อมูลนักเรียน :: คะแนนความประพฤติ <?=getPoint($dat['Points'])?> คะแนน || 	สถานภาพปัจจุบัน :: <?=displayStudentStatusColor($dat['studstatus'])?>					</td>
					<td rowspan="7" align="center" width="130px"><img src="../images/studphoto/id<?=$dat['ID']?>.jpg" alt="รูปของนักเรียน" width="120px" style="border:#000000 1px solid"/></td>
				</tr>
				<tr>
					<td align="right" width="150px">เลขประจำตัวนักเรียน :</td>
					<td width="220px"><?=display($dat['ID'] . " ")?></td>
					<td align="right" width="150px">เลขบัตรประจำตัวประชาชน :</td>
					<td ><?=displayPIN($dat['pin'] . " ")?></td>
				</tr>
				<tr>
					<td align="right">ชื่อ - สกุล :</td>
					<td><?=display($dat['PREFIX'] . $dat['FIRSTNAME'] . '  ' . $dat['LASTNAME'])?></td>
					<td align="right">เพศ :</td>
					<td ><?php if($dat['SEX'] == '2') echo display("หญิง"); else echo display("ชาย"); ?></td>
				</tr>
				<tr>
					<td align="right">ชื่อ - สกุล(เดิม) :</td>
					<td><?=display($dat['OLD_FIRSTNAME'] . '  ' . $dat['OLD_LASTNAME']. " ")?></td>
					<td align="right">วันที่เปลี่ยนชื่อ :</td>
					<td ><?=display($dat['Change_Date'])?></td>
				</tr>
				<tr>
					<td align="right">ชื่อเล่น :</td>
					<td><?=display($dat['NICKNAME'])?></td>
					<td align="right">GPAX :</td>
					<td><?=display($dat['GPA'])?></td>
				</tr>
				<tr>
					<td align="right">หมู่โลหิต :</td>
					<td><?=display($dat['blood_group']) ; ?></td>
					<td align="right">ความพิการ :</td>
					<td><?=display(displayCripple($dat['CRIPPLE']))?></td>
				</tr>
				<tr>
					 <td align="right">ระดับชั้น :</td>
				  	<td><?=display((($dat['xLevel'] == 4)?("ม. " . ($dat['xYearth']+3)) : ("ม. " . $dat['xYearth'])) . "/" . $dat['ROOM']) ?> </td>
				  	<td  align="right">ว/ด/ป เกิด :</td>
				  	<td><?php echo display($dat['BIRTHDAY']); ?></td>
				</tr>
				<tr>
					<td align="right">อายุ :</td>
				  	<td><?=display(displayAge($dat['BIRTHDAY']))?></td>
					<td align="right">ศาสนา :</td>
				  	<td><?=display(displayReligion($dat['RELIGION']))?></td>
				</tr>
				<tr> 
				  	<td align="right">เชื้อชาติ :</td>
				  	<td><?=display(displayNationality($dat['Race']))?></td>
				  	<td  align="right">สัญชาติ :</td>
				  	<td ><?=display(displayNationality($dat['Nationality']))?></td>
				</tr>
				<tr>
					<td  align="right">นน./สส. :</td>
					<td ><?=display($dat['WEIGHT'] . "/" . $dat['HEIGHT'])?></td>
					<td align="right">ค่าดัชนีมวลกาย :</td>
					<td colspan="2"><?=display($dat['BMI'])?> &nbsp; ความหมาย : <?=displayBMI($dat['BMI'])?></td>
				</tr>
				<tr>
					<td align="right">ครูที่ปรึกษา :</td>
					<td><?=display(getAdvisor($dat['xLevel'],$dat['xYearth'],$dat['ROOM'],$acadyear,$acadsemester))?></td>
				</tr>
				<tr> 
					<td align="right">เบอร์โทรศัพท์ :</td>
					<td><?=display(substr($dat['P_PHONE'],0,3) . "-". substr($dat['P_PHONE'],3,7) . "")?></td>
					<td  align="right">ที่อยู่ :</td>
					<td colspan="3" rowspan="3" valign="top">
						บ้านเลขที่ <?=display($dat['P_NO'] . " ")?> หมู่ที่ <?=display($dat['P_GROUP'] . " ")?> <?=display($dat['p_village'])?><br/>
						ตำบล <?=display($dat['P_TUMBOL'])?>
						อำเภอ <?=display($dat['P_AMPHUR'])?> <br/>
						จังหวัด <?=display($dat['P_PROVINCE'])?> รหัสไปรษณีย์ <?=display($dat['P_ZIP'] . " ")?>				  </td>
				</tr>
				<tr> 
					<td align="right">เบอร์มือถือ :</td>
					<td><?=display(substr($dat['mobile'],0,3). "-" . substr($dat['mobile'],3,7) . " ")?></td>
					<td  align="right">&nbsp;</td>
				</tr>
				<tr>
					<td align="right">อีเมล :</td>
					<td><?=display($dat['e_mail'])?></td>
					<td  align="right">&nbsp;</td>
				</tr>
				<tr> 
				  <td align="right">คณะสี :</td>
				  <td><?php echo display($dat['Color']) ;?></td>
				  <td  align="right">&nbsp;</td>
				</tr>
				<tr>
					<td align="right">สุขภาพฟัน :</td>
					<td><?=display($dat['Dental']==0?"ปกติ":"มีปัญหา")?></td>
				</tr>
				<tr>
					<td align="right">การพักอาศัย :</td>
					<td><?=display(displayInservice($dat['InService']))?></td>
					<td align="right">ความขาดแคลน :</td>
					<td><?=display(displayStudAbsent($dat['StudAbsent']))?></td>
				</tr>
				<tr> 
				  <td colspan="5">ระยะเวลาที่ใช้ในการเดินทางมาโรงเรียน :
					  <?=display($dat['HowLong'] . " ")?> นาที / เดินทางด้วยวิธี : <?=display(displayTravel($dat['travelby']))?></td>
				</tr>
				<tr> 
				  <td align="right">ภูมิลำเนา/สถานที่เกิด :</td>
				  <td colspan="4">
					โรงพยาบาล <?=display($dat['BHOSPITAL'])?> ตำบล <?=display($dat['BTAMBOL'])?> 
					อำเภอ <?=display($dat['BAMPHUR'])?> จังหวัด <?=display($dat['BPROVINCE'])?>					</td>
				</tr>
				<tr> 
				  <td class="key" colspan="5" align="center" height="35px">ข้อมูลด้านการเรียน/โรงเรียนเดิม/การศึกษาต่อ</td>
				</tr>
				<tr>
					<td align="right">ปีที่เข้าศึกษา :</td>
					<td><?=display($dat['ENT_YEAR']. " ")?></td>
					<td align="right">วันที่เข้าศึกษา :</td>
					<td><?=display($dat['ENT_DATE'])?></td>
				</tr>
				<tr>
					<td align="right">โรงเรียนเดิม :</td>
					<td><?=display($dat['SCH_NAME'])?></td>
					<td align="right">จังหวัด :</td>
					<td><?=display($dat['SCH_PROVINCE'])?></td>
				</tr>
				<tr>
					<td align="right">ระดับการศึกษาก่อนเข้า :</td>
					<td><?=display($dat['SCH_LEVEL'])?></td>
					<td align="right">สาเหตุที่ออก :</td>
					<td><?=display($dat['SCH_CAUSE'])?></td>
				</tr>
				<tr>
					<td align="right">หน่วยกิตที่เรียน(เดิม) :</td>
					<td><?=display($dat['SCH_Unit'])?></td>
					<td align="right">หน่วยกิตที่ได้(เดิม) :</td>
					<td><?=display($dat['SCH_Pass'])?></td>
				</tr>
				<tr>
					<td colspan="2">ผลการเรียนเฉลี่ยจากโรงเรียนเดิม : <?=display($dat['SCH_GPA'])?></td>
					<td align="right">วิธีการเข้ามาศึกษา :</td>
					<td><?=display(displayStudjudge($dat['StudJudge']))?></td>
				</tr>
				<tr>
					<td align="right" valign="top">ความสามารถพิเศษ :</td>
					<td colspan="3"><?=display($dat['TALENT'])?></td>
				</tr>
				<tr>
					<td align="right">วิชาที่ถนัด/ชอบ :</td>
					<td><?=display($dat['SUBJECT_LIKE'])?></td>
					<td align="right">วิชาที่ไม่ถนัด/ไม่ชอบ :</td>
					<td><?=display($dat['SUBJECT_HATE'])?></td>
				</tr>
				<tr><td colspan="4">&nbsp;</td></tr>
				<tr>
					<td align="right">ครูที่ปรึกษาชั้นม.<?=$dat['xLevel']==3?1:4?> :</td>
					<td><?=display(getTeacher($dat['advisor11']))?></td>
					<td><?=display(getTeacher($dat['advisor12']))?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="right">ครูที่ปรึกษาชั้นม.<?=$dat['xLevel']==3?2:5?> :</td>
					<td><?=display(getTeacher($dat['advisor21']))?></td>
					<td><?=display(getTeacher($dat['advisor22']))?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="right">ครูที่ปรึกษาชั้นม.<?=$dat['xLevel']==3?3:6?> :</td>
					<td><?=display(getTeacher($dat['advisor31']))?></td>
					<td><?=display(getTeacher($dat['advisor32']))?></td>
					<td>&nbsp;</td>
				</tr>
				<tr><td colspan="4">&nbsp;</td></tr>
				<tr>
					<td align="right">ครูที่ไว้วางใจคนที่ 1 :</td>
					<td><?=display(getTeacher($dat['TrustTeacher1']))?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="right">ครูที่ไว้วางใจคนที่ 2 :</td>
					<td><?=display(getTeacher($dat['TrustTeacher2']))?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="right">ครูที่ไว้วางใจคนที่ 3 :</td>
					<td><?=display(getTeacher($dat['TrustTeacher3']))?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr><td colspan="4">&nbsp;</td></tr>
				<tr>
					<td align="right">ผลการเรียน ม.<?=$dat['xLevel']==3?1:4?> :</td>
					<td><?=display($dat['GPA1'])?></td>
					<td align="right"><b>ผลการเรียนเฉลี่ยรวม :</b></td>
					<td><?=display($dat['GPA'])?></td>
				</tr>
				<tr>
					<td align="right">ผลการเรียน ม.<?=$dat['xLevel']==3?2:5?> :</td>
					<td><?=display($dat['GPA2'])?></td>
					<td align="right"><b>ตำแหน่ง PR :</b></td>
					<td><?=display($dat['PR'])?></td>
				</tr>
				<tr>
					<td align="right">ผลการเรียน ม.<?=$dat['xLevel']==3?3:6?> :</td>
					<td colspan="3"><?=display($dat['GPA3'])?></td>
				</tr>
				<tr><td colspan="4">&nbsp;</td></tr>
				<tr>
					<td align="right">ทุนการศึกษา :</td>
					<td colspan="3"><?=display(trim($dat['Scholar_Status'])=="0"?"ไม่เคยได้รับทุนการศึกษา":"เคยได้รับทุนการศึกษา")?></td>
				</tr>
				<? if(trim($dat['Scholar_Status'])=="1"){ ?>
				<tr>
					<td align="right">ชื่อทุนที่เคยได้รับ :</td>
					<td colspan="3"><?=display($dat['ScholarName1'])?></td>
				</tr>
				<tr>
					<td align="right">ชื่อทุนที่เคยได้รับ :</td>
					<td colspan="3"><?=display($dat['ScholarName2'])?></td>
				</tr>
				<tr>
					<td align="right">ชื่อทุนที่เคยได้รับ :</td>
					<td colspan="3"><?=display($dat['ScholarName3'])?></td>
				</tr>
				<? } //end if- ทุนการศึกษา ?>
				
				<? if($dat['education_loan1']>0) { ?>
				<tr>
					<td align="right">จำนวนเงินกู้ชั้น ม.4 :</td>
					<td><?=display($dat['education_loan1'])?> บาท</td>
				</tr>
				<? } //end if education_loan1 ?>
				
				<? if($dat['education_loan2']>0) { ?>
				<tr>
					<td align="right">จำนวนเงินกู้ชั้น ม.5 :</td>
					<td><?=display($dat['education_loan2'])?> บาท</td>
				</tr>
				<? } //end if education_loan2 ?>
				
				<? if($dat['education_loan3']>0) { ?>
				<tr>
					<td align="right">จำนวนเงินกู้ชั้น ม.6 :</td>
					<td><?=display($dat['education_loan3'])?> บาท</td>
				</tr>
				<? } //end if education_loan3 ?>
				
				<tr> 
				  <td class="key" colspan="4" align="center" height="35px"> ข้อมูลบิดา/มารดา/ผู้ปกครองนักเรียน</td>
				  <td align="center" rowspan="6" valign="top">
					<img src="../images/PapaPhoto/id<?=$dat['ID']?>.jpg" alt="รูปบิดาของนักเรียน" width="120px" height="160px" style="border:#000000 1px solid" />				  </td>
				</tr>
				<tr>
					<td colspan="4" class="key"> ข้อมูลบิดา</td>
				</tr>
				<tr> 
				  <td align="right">เลขที่บัตร :</td>
				  <td><?php echo displayPIN($dat['F_PIN']. " "); ?></td>
				  <td  align="right">สถานภาพ :</td>
				  <td><?=$dat['F_Status']!=""?($dat['F_Status']==1?display("ยังมีชีวิตอยู่"):display("ถึงแก่กรรม")):"ไม่ระบุ"?></td>
				</tr>
				<tr> 
				  <td align="right">ชื่อบิดา :</td>
				  <td><?php echo display($dat['F_NAME']); ?></td>
				  <td  align="right">อาชีพ :</td>
				  <td><?php echo display(displayOccupation($dat['F_Occupation'])); ?></td>
				</tr>
				<tr>
				  <td align="right">เบอร์ติดต่อ :</td><td><?=display(substr($dat['F_Mobile'],0,3) . "-". substr($dat['F_Mobile'],3,7) . " ")?></td>
				  <td align="right">รายได้/ปี</td><td><?php echo display($dat['F_EARN']); ?> บาท</td>
				</tr>
				<tr>
					<td colspan="4" height="40px">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="key"> ข้อมูลมารดา</td>
					<td align="center" rowspan="6" valign="top">
						<img src="../images/MamaPhoto/id<?=$dat['ID']?>.jpg" alt="รูปมารดาของนักเรียน" width="120px" height="160px" style="border:#000000 1px solid" />					</td>
				</tr>
				<tr> 
				  <td align="right">เลขที่บัตร :</td>
				  <td><?php echo displayPIN($dat['M_PIN']. " "); ?></td>
				  <td  align="right">สถานภาพ :</td>
				  <td><?=$dat['M_Status']!=""?($dat['M_Status']==1?display("ยังมีชีวิตอยู่"):display("ถึงแก่กรรม")):"ไม่ระบุ"?></td>
				</tr>
				<tr> 
				  <td align="right">ชื่อมารดา :</td>
				  <td><?php echo display($dat['M_NAME']); ?></td>
				  <td  align="right">อาชีพ :</td>
				  <td><?php echo display(displayOccupation($dat['M_Occupation'])); ?></td>
				</tr>
				<tr>
				  <td align="right">เบอร์ติดต่อ :</td><td><?=display(substr($dat['M_Mobile'],0,3) . "-" . substr($dat['M_Mobile'],3,7) . " ")?></td>
				  <td align="right">รายได้/ปี</td><td><?php echo display($dat['M_EARN']); ?> บาท</td>
				</tr>
				<tr>
					<td colspan="4" height="40px">&nbsp;</td>
				</tr>
				<tr>
					<td class="key" colspan="4">ข้อมูลผู้ปกครอง / สถานภาพบิดามารดนักเรียน</td>
				</tr>
				<tr>
				  <td align="right">เลขที่บัตร :</td>
				  <td colspan="3"><?php echo displayPIN($dat['A_PIN']. " "); ?></td>
				  <td rowspan="7"  align="center" valign="top">
					<img src="../images/Ahoto/id<?=$dat['ID']?>.jpg" alt="รูปผู้ปกครองของนักเรียน" width="120px" height="160px" style="border:#000000 1px solid" />				  </td>
				</tr>
				<tr> 
				  <td align="right">ชื่อผู้ปกครอง :</td>
				  <td><?php echo display($dat['A_NAME']); ?></td>
				  <td  align="right">อาชีพ :</td>
				  <td><?php echo display(displayOccupation($dat['A_Occupation'])); ?></td>
				 </tr>
				<tr> 
				  <td align="right">เบอร์โทรศัพท์ :</td>
				  <td><?php echo display(substr($dat['P_PHONE'],0,3) . "-" . substr($dat['P_PHONE'],3,7) . " "); ?></td>
				  <td align="right">รายได้/ปี :</td>
				  <td><?=display($dat['A_EARN'])?> บาท</td>
				</tr>
				<tr>
					<td  align="right">เบอร์มือถือ :</td>
					<td ><?php echo display(substr($dat['A_Mobile'],0,3) . "-" . substr($dat['A_Mobile'],3,7) . " "); ?></td>
					<td  align="right">สถานภาพบิดา-มารดา :</td>
					<td ><?=display(displayFMStatus($dat['FM_Status']))?></td>
				</tr>
				<tr> 
				  <td align="right">ความสัมพันธ์กับนักเรียน :</td>
				  <td colspan="3"><?php echo display(displayRelation($dat['A_Relation'])); ?></td>
				</tr>
				<tr>
					<td align="right">รายได้รวมบิดาและมารดา :</td>
					<td colspan="3"><?=display($dat['All_EARN'])?></td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
				</tr>
				<tr> 
				  <td colspan="6" class="key">ประวัติการเข้าร่วมกิจกรรมหน้าเสาธง</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="5">
						<table  cellspacing="1" bgcolor="#666699">
							<tr align="center" bgcolor="#CCCFFF">
								<td width="120px">ภาคเรียน/ปีการศึกษา</td>
								<td width="50px">มา</td>
								<td width="50px">กิจกรรม</td>
								<td width="50px">ลา</td>
								<td width="50px">สาย</td>
								<td width="50px">ขาด</td>
								<td width="60px">รวม</td>
							</tr>
							<?php
								$_sql = "select acadsemester,acadyear,
										  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
										  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
										  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
										  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
										  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
										  count(class_id) as sum
										from  student_800
										where student_id = '" . (isset($_POST['studentid'])?$_POST['studentid']:$_REQUEST['studentid']) . "'
										group by acadsemester,acadyear,student_id order by acadyear,acadsemester";
								$_result = mysql_query($_sql);
								while($_dat = mysql_fetch_assoc($_result)){ ?>
								<tr align="center" bgcolor="#FFFFFF">
									<td><?=$_dat['acadsemester'] . "/" . $_dat['acadyear']?></td>
									<td><?=display($_dat['a'] . " ")?></td>
									<td><?=display($_dat['b'] . " ")?></td>
									<td><?=display($_dat['d'] . " ")?></td>
									<td><?=display($_dat['c'] . " ")?></td>
									<td><?=display($_dat['e'] . " ")?></td>
									<td><?=display($_dat['sum'] . " ")?></td>
								</tr>
							<?	} mysql_free_result($_result); //end while?>
						</table>					</td>
				</tr>
								
				<tr> 
				  <td colspan="6" class="key">ประวัติการเข้ากิจกรรมคณะสี</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="5">
						<? $_sqlColor = "select acadyear,acadsemester,
									  sum(if(timecheck_id='00',1,null)) as 'a',
									  sum(if(timecheck_id='01',1,null)) as 'b',
									  sum(if(timecheck_id='02',1,null)) as 'c',
									  sum(if(timecheck_id='03',1,null)) as 'd',
									  sum(if(timecheck_id='04',1,null)) as 'e',
									  count(*) as 'total' from student_color
									where student_id = '" . (isset($_POST['studentid'])?$_POST['studentid']:$_REQUEST['studentid']) . "'
										group by acadsemester,acadyear,student_id order by acadyear,acadsemester"; ?>
						<? $_resColor = @mysql_query($_sqlColor); ?>
						<table  cellspacing="1" bgcolor="#666699">
							<tr align="center" bgcolor="#CCCFFF">
								<td width="120px">ภาคเรียน/ปีการศึกษา</td>
								<td width="50px">มา</td>
								<td width="50px">กิจกรรม</td>
								<td width="50px">ลา</td>
								<td width="50px">สาย</td>
								<td width="50px">ขาด</td>
								<td width="60px">รวม</td>
							</tr>
							<? if(mysql_num_rows($_resColor)>0){?>
								<? while($_datColor = mysql_fetch_assoc($_resColor)){ ?>
									<tr bgcolor="#FFFFFF" align="center">
										<td><?=$_datColor['acadsemester'].'/'.$_datColor['acadyear']?></td>
										<td><?=display($_datColor['a']." ")?></td>
										<td><?=display($_datColor['b']." ")?></td>
										<td><?=display($_datColor['c']." ")?></td>
										<td><?=display($_datColor['d']." ")?></td>
										<td><?=display($_datColor['e']." ")?></td>
										<td><?=display($_datColor['total']." ")?></td>
									</tr>
								<? } mysql_free_result($_resColor);//end while?>
							<? } else {//end if ?>
								<tr align="center" bgcolor="#FFFFFF">
									<td align="center" colspan="7"><?=display("ยังไม่มีประวัติการเข้าร่วมกิจกรรมคณะสี")?></td>
								</tr>
						  	<? }//end else ?>
						</table>					</td>
				</tr>
				
				
				<tr> 
				  <td colspan="6" class="key">ประวัติการเข้าชั้นเรียนสาย</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="5">
						<table  cellspacing="1" bgcolor="#666699">
							<tr align="center" bgcolor="#CCCFFF">
								<td width="120px">ภาคเรียน/ปีการศึกษา</td>
								<td width="90px">จำนวนครั้งที่<br/>เข้าห้องเรียนสาย</td>
							</tr>
						<?php
								$_sql = "select acadyear,acadsemester,count(*) as 'a' from student_learn
											where timecheck_id = '02' and student_id = '" .  (isset($_POST['studentid'])?$_POST['studentid']:$_REQUEST['studentid'])  . "'
										group by acadyear,acadsemester,timecheck_id";
								$_result = mysql_query($_sql);
								if(mysql_num_rows($_result)>0) {
									while($_dat = mysql_fetch_assoc($_result))
									{
										echo "<tr align=\"center\" bgcolor=\"#FFFFFF\">";
										echo "<td>".  $_dat['acadsemester'] . "/" . $_dat['acadyear'] . "</td>";
										echo "<td>" . display($_dat['a'] . " ") . "</td>";
										echo "</tr>";
									}
								}
								else {
									echo "<tr align=\"center\" bgcolor=\"#FFFFFF\">";
									echo "<td colspan=\"2\">" . display("ไม่มีประวัติการเข้าห้องเรียนสาย") . "</td>";
									echo "</tr>";
								}
							?>
							 </table>
					</td>
				</tr>
				<tr>
					<td colspan="5" class="key">ประวัติด้านพฤติกรรมที่พึงประสงค์</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="4">
						<? 
							$_sql = "select acadyear,acadsemester,sum(if(mtype='00',1,null)) as 'a',
									  sum(if(mtype='01',1,null)) as 'b',sum(if(mtype='02',1,null)) as 'c',
									  sum(if(mtype='03',1,null)) as 'd',count(mtype) as 'total'
									from student_moral where student_id = '" . (isset($_POST['studentid'])?$_POST['studentid']:$_REQUEST['studentid']) . "'
									group by acadyear,acadsemester order by acadyear,acadsemester";
							$_res = mysql_query($_sql);
						?>
						<table bgcolor="#666699" cellspacing="1">
							<tr bgcolor="#CCCFFF">
								<td align="center" width="120px">ภาคเรียน/ปีการศึกษา</td>
								<td align="center" width="105px">การบำเพ็ญประโยชน์</td>
								<td align="center" width="105px">การเข้าร่วมกิจกรรม</td>
								<td align="center" width="105px">การแข่งขันทักษะ<br/>ทางวิชาการ</td>
								<td align="center" width="105px">การแข่งขันทักษะ<br/>ด้านกีฬา</td>
								<td align="center" width="50px">รวม</td>
							</tr>
						<? if(mysql_num_rows($_res) > 0) { ?>
							<? while($_dat = mysql_fetch_assoc($_res)) { ?>
							<tr>
								<td bgcolor="#FFFFFF" align="center"><?=display($_dat['acadsemester'].'/'.$_dat['acadyear'])?></td>
								<td bgcolor="#FFFFFF" align="center"><?=display($_dat['a'] . " ")?></td>
								<td bgcolor="#FFFFFF" align="center"><?=display($_dat['b'] . " ")?></td>
								<td bgcolor="#FFFFFF" align="center"><?=display($_dat['c'] . " ")?></td>
								<td bgcolor="#FFFFFF" align="center"><?=display($_dat['d'] . " ")?></td>
								<td bgcolor="#FFFFFF" align="center"><?=display($_dat['total'] . " ")?></td>
							</tr>
							<? } //end while ?> 
						<? } else { ?>
							<tr><td align="center" bgcolor="#FFFFFF" colspan="6"><?=display("ยังไม่มีประวัติพฤติกรรมที่พึงประสงค์")?></td></tr>
						<? } //end else ?>
						</table>
					</td>
				</tr>
				<tr> 
				  <td colspan="6" class="key">ประวัติด้านพฤติกรรมไม่พึงประสงค์</td>
				</tr>
					<tr>
					<td>&nbsp;</td>
					<td colspan="5">
						<table  cellspacing="1" bgcolor="#666699">
							<tr align="center" bgcolor="#CCCFFF">
								<td width="120px" rowspan="2">ภาคเรียน/ปีการศึกษา</td>
								<td colspan="7">จำนวน/สถานะการดำเนินคดี</td>
							</tr>
							<tr align="center" bgcolor="#FFCCFF">
								<?php for($_i = 1; $_i <= 6; $_i++){ echo "<td width=\"40px\">" . $_i . "</td>" ;} ?>
								<td width="55px">รวม</td>
							</tr>
						<?php
								$_sql = "select acadsemester,acadyear,
										  sum(if(dis_status = 1,1,null)) as b,
										  sum(if(dis_status = 2,1,null)) as c,
										  sum(if(dis_status = 3,1,null)) as d,
										  sum(if(dis_status = 4,1,null)) as e ,
										  sum(if(dis_status = 5,1,null)) as f,
										  sum(if(dis_status = 6,1,null)) as g,
										  count(student_id) as 'sum'
										from  student_disciplinestatus where student_id ='".  (isset($_POST['studentid'])?$_POST['studentid']:$_REQUEST['studentid'])  . "' 
											and dis_id in (select dis_id from student_discipline where dis_detail not like '%การเข้าร่วมกิจกรรมหน้าเสาธง%') 
										group by acadsemester,acadyear
										order by acadyear,acadsemester";
								$_result = mysql_query($_sql);
								if(mysql_num_rows($_result)>0)
								{
									while($_dat = mysql_fetch_assoc($_result))
									{
										echo "<tr align=\"center\" bgcolor=\"#FFFFFF\">";
										echo "<td>".  $_dat['acadsemester'] . "/" . $_dat['acadyear'] . "</td>";
										echo "<td>" . display($_dat['b'] . " ") . "</td>";
										echo "<td>" . display($_dat['c'] . " ") . "</td>";
										echo "<td>" . display($_dat['d'] . " ") . "</td>";
										echo "<td>" . display($_dat['e'] . " ") . "</td>";
										echo "<td>" . display($_dat['f'] . " ") . "</td>";
										echo "<td>" . display($_dat['g'] . " ") . "</td>";
										echo "<td>" . display($_dat['sum'] . " ") . "</td>";
										echo "</tr>";
									}
								}
								else
								{
									echo "<tr align=\"center\" bgcolor=\"#FFFFFFF\">";
									echo "<td colspan=\"8\">" . display("ไม่มีประวัติพฤติกรรมไม่พึงประสงค์") . "</td>";
									echo "</tr>";
								}
							?>
					  </table><br/>
						<?php
							$_sql = "select * from ref_disciplinestatus where status > 0 order by 1 ";
							$_result = mysql_query($_sql);
							$num = mysql_num_rows($_result);
						?>
						<b>หมายเหตุ</b>: ในหน้าประวัตินี้จะไม่รวมพฤติกรรมไม่พึงประสงค์ในส่วนของการขาด สาย และลา การเข้าร่วมกิจกรรมหน้าเสาธง <br/> และ <u>สถานะการดำเนินคดี</u> อธิบายได้ดังนี้<br/>
						<? while($_dat = mysql_fetch_assoc($_result)){ ?>
								&nbsp; &nbsp; <?=$_dat['status']?> หมายถึง <?=$_dat['status_detail']?><br/>
						<? } //end while ?>
					</td>
				</tr>
			  </table>
	<?		mysql_free_result($result);
		}else { echo "<br/><center><font color=\"red\">ไม่พบข้อมูลนักเรียน กรุณาตรวจสอบเลขประจำตัวนักเรียนอีกครั้ง</font></center>"; }
	}//end else-if ?>

</div>


