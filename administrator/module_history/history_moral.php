
<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.4 สืบค้นประวัติพฤติกรรมที่พึงประสงค์</strong></font></span></td>
      <td valign="bottom">
	  	<?php
			$s_id;
			if(isset($_POST['search'])){ $s_id = $_POST['studentid'];}
			else if(isset($_REQUEST['studentID'])){$s_id = $_REQUEST['studentID'];}
		?>
		
	  	<font color="#000000" size="2"  >
		เลขประจำตัวนักเรียน <input type="text" size="5" maxlength="5" name="studentid" id="studentid" onKeyPress="return isNumberKey(event)" class="inputboxUpdate" value="<?=$s_id?>"/>
	  					<input type="submit" value="สืบค้น" class="button" name="search" /></font></td>
    </tr>
  </table>
  </form>
<? if(isset($_POST['search']) && $_POST['studentid'] == "") { ?>
  		<center><br/><font color="#FF0000">กรุณาป้อนเลขประจำตัวนักเรียนก่อน !</font></center>
<? } ?>
   
<? if(isset($_POST['search']) && $_POST['studentid'] != "" || isset($_REQUEST['studentID']))  { 
		$_sqlStudent = "select id,prefix,firstname,lastname,nickname,studstatus,gpa from students where id = '" .$s_id . "' order by xedbe desc limit 0,1 ";
		$_resStudent = mysql_query($_sqlStudent);
?>
		<? if(mysql_num_rows($_resStudent) > 0) { ?>
			<table class="admintable"  cellpadding="1" cellspacing="1">
				<tr height="30"> 
					<td  class="key" colspan="2">ข้อมูลนักเรียน</td>
				</tr>
				<tr>
					<td valign="top" align="left">
					<? $datStudent = mysql_fetch_assoc($_resStudent);?>
						<table align="right" cellspacing="1" cellpadding="1">
							<tr bgcolor="#FFFFFF">
								<td align="right" width="160px">เลขประจำตัว :</td>
								<td width="250px"><?=displayText($datStudent['id'])?></td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<td align="right">ชื่อ - สกุล :</td>
								<td><?=displayText($datStudent['prefix'] . $datStudent['firstname'] . ' '. $datStudent['lastname'])?></td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<td align="right">ชื่อเล่น :</td>
								<td><?=displayText($datStudent['nickname'])?></td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<td align="right">สถานภาพปัจจุบัน :</td>
								<td><?=displayStudentStatusColor($datStudent['studstatus'])?></td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<td align="right">ผลการเรียนเฉลี่ยสะสม :</td>
								<td><?=displayText($datStudent['gpa'])?></td>
							</tr>
						</table>
					</td>
					<td align='center' valign='top'><img src='../images/studphoto/id<?=$datStudent['id']?>.jpg' width='120px' height='160px' style="border:#000000 1px solid" alt='รูปนักเรียน'/></td>
				</tr>
			</table>
			<table class="admintable">
				<? $_sql = "select * from student_moral where mtype = '00' and student_id = '" . $s_id . "' order by acadyear,acadsemester,mdate";?>
				<? $_res00 = mysql_query($_sql);?>
				<? if(mysql_num_rows($_res00)>0){ ?>
				<tr height="30px"><td class="key" >การบำเพ็ญประโยชน์/ทำความดี</td></tr>
				<tr>
					<td >
						<table width="100%">
							<? $_i = 1; ?>
							<? while($_dat = mysql_fetch_assoc($_res00)){ ?>
							<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
								<td align="right" valign="top" width="20px"><?=$_i++?>.</td>
								<td align="center" valign="top" width="55px"><?=$_dat['acadsemester'].'/'.$_dat['acadyear']?></td>
								<td valign="top" width="125px"><?=displayFullDate($_dat['mdate'])?></td>
								<td valign="top" width="400px">
									<a href="index.php?option=module_moral/moralFull&num_id=<?=$_dat['id']?>&acadyear=<?=$_dat['acadyear']?>">
										<?=$_dat['mdesc']?>
									</a>
								</td>
								<td valign="top" width="200px"><?=$_dat['place']?></td>
							</tr>
							<? } //end while ?>
						</table>
					</td>
				</tr>
				<? } else {  /*echo "<tr><td colspan='2' align='center'>ไม่มีประวัติการบำเพ็ญประโยชน์</td></tr>";*/ }?>
				
				<? $_sql = "select * from student_moral where mtype = '01' and student_id = '" . $s_id . "' order by acadyear,acadsemester,mdate";?>
				<? $_res01 = mysql_query($_sql);?>
				<? if(mysql_num_rows($_res01)>0){ ?>
				<tr height="30px"><td class="key" >การเข้าร่วมกิจกรรม</td></tr>
				<tr>
					<td >
						<table width="100%">
							<? $_i = 1; ?>
							<? while($_dat = mysql_fetch_assoc($_res01)){ ?>
							<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
								<td align="right" valign="top" width="20px"><?=$_i++?>.</td>
								<td align="center" valign="top" width="55px"><?=$_dat['acadsemester'].'/'.$_dat['acadyear']?></td>
								<td valign="top" width="125px"><?=displayFullDate($_dat['mdate'])?></td>
								<td valign="top" width="400px">
									<a href="index.php?option=module_moral/moralFull&num_id=<?=$_dat['id']?>&acadyear=<?=$_dat['acadyear']?>">
										<?=$_dat['mdesc']?>
									</a>
								</td>
								<td valign="top" width="200px"><?=$_dat['place']?></td>
							</tr>
							<? } //end while ?>
						</table>
					</td>
				</tr>
				<? } else { /* echo "<tr><td colspan='2' align='center'>ไม่มีประวัติการเข้าร่วมกิจกรรม</td></tr>"; */} ?>
				
			
				<? $_sql = "select * from student_moral where mtype = '02' and student_id = '" . $s_id . "' order by acadyear,acadsemester,mdate";?>
				<? $_res02 = mysql_query($_sql);?>
				<? if(mysql_num_rows($_res02)>0){ ?>
				<tr height="30px"><td class="key" >การแข่งขันทักษะทางวิชาการ</td></tr>
				<tr>
					<td >
						<table width="100%">
							<? $_i = 1; ?>
							<? while($_dat = mysql_fetch_assoc($_res02)){ ?>
							<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
								<td align="right" valign="top" width="20px"><?=$_i++?>.</td>
								<td align="center" valign="top" width="55px"><?=$_dat['acadsemester'].'/'.$_dat['acadyear']?></td>
								<td valign="top" width="125px"><?=displayFullDate($_dat['mdate'])?></td>
								<td valign="top" width="400px">
									<a href="index.php?option=module_moral/moralFull&num_id=<?=$_dat['id']?>&acadyear=<?=$_dat['acadyear']?>">
										<?=$_dat['mdesc']?>
									</a>
								</td>
								<td valign="top" width="200px"><?=$_dat['place']?></td>
							</tr>
							<? } //end while ?>
						</table>
					</td>
				</tr>
				<? } else {  /* echo "<tr><td colspan='2' align='center'>ไม่มีประวัติการแข่งขันทักษะทางวิชาการ</td></tr>"; */}?>
				

				<? $_sql = "select * from student_moral where mtype = '03' and student_id = '" . $s_id . "' order by acadyear,acadsemester,mdate";?>
				<? $_res03 = mysql_query($_sql);?>
				<? if(mysql_num_rows($_res03)>0){ ?>
				<tr height="30px"><td class="key">การแข่งขันด้านกีฬา</td></tr>
				<tr>
					<td >
						<table width="100%">
							<? $_i = 1; ?>
							<? while($_dat = mysql_fetch_assoc($_res03)){ ?>
							<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
								<td align="right" valign="top" width="20px"><?=$_i++?>.</td>
								<td align="center" valign="top" width="55px"><?=$_dat['acadsemester'].'/'.$_dat['acadyear']?></td>
								<td valign="top" width="125px"><?=displayFullDate($_dat['mdate'])?></td>
								<td valign="top" width="400px">
									<a href="index.php?option=module_moral/moralFull&num_id=<?=$_dat['id']?>&acadyear=<?=$_dat['acadyear']?>">
										<?=$_dat['mdesc']?>
									</a>
								</td>
								<td valign="top" width="200px"><?=$_dat['place']?></td>
							</tr>
							<? } //end while ?>
						</table>
					</td>
				</tr>
				<? } else { /* echo "<tr><td colspan='2' align='center'>ไม่มีประวัติการแข่งขันด้านกีฬา</td></tr>"; */}?>
			</table>
			<? } else { echo "<center><br/><br/><font color='#FF0000'>ไม่พบข้อมูลนักเรียน กรุณาตรวจสอบเลขประจำตัวนักเรียนอีกครั้ง</font></center>";} ?>
		<? } ?>
</div>
