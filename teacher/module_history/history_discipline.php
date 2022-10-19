
<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.5 สืบค้นประวัติพฤติกรรมไม่พึงประสงค์</strong></font></span></td>
      <td >
	  	<?php
			$s_id;
			if(isset($_POST['search'])){ $s_id = $_POST['studentid'];}
			else if(isset($_REQUEST['studentID'])){$s_id = $_REQUEST['studentID'];}
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_history/history_discipline&studentID=" . $s_id . "&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/history_discipline&studentID=" . $s_id . "&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font><br/>
	  	<font color="#000000" size="2">
		เลขประจำตัวนักเรียน <input type="text" size="5" maxlength="5" name="studentid" id="studentid" onKeyPress="return isNumberKey(event)" class="inputboxUpdate" value="<?=$s_id?>"/>
	  				<input type="submit" value="สืบค้น" class="button" name="search" /><br/>
					<input type="checkbox" name="split" value="split"  <?=$_POST['split']=="split"?"checked='checked'":""?> /> ไม่รวมการขาด สาย ลากิจกรรมหน้าเสาธง</font>
		</td>
    </tr>
  </table>
  </form>
  <? if(isset($_POST['search']) && $_POST['studentid'] == "") { ?>
  		<center><br/><font color="#FF0000">กรุณาป้อนเลขประจำตัวนักเรียนก่อน !</font></center>
  <? } 
  	else if(isset($_POST['search']) || (isset($_REQUEST['studentID']) && $_REQUEST['studentID'] != ""))
	{
		$_sqlStudent = "select id,prefix,firstname,lastname,nickname,xlevel,xyearth,room,studstatus,points from students where id = '" . $s_id . "' and xedbe = '" . $acadyear . "'";
		$_resStudent = mysql_query($_sqlStudent);
		$datStudent = mysql_fetch_assoc($_resStudent);	
  ?>
  <? if(mysql_num_rows($_resStudent)>0) { ?>	
		<table class="admintable">
			<tr>
				<td height="30px" colspan="3" class="key"> &nbsp; ข้อมูลเกี่ยวกับนักเรียน</td>
			</tr>
			<tr>
				<td width="200px" align="right">เลขประจำตัว :</td>
				<td width="200px"><?=displayText($datStudent['id'])?></td>
				<td align='center' valign='top' rowspan="7" width="180px"><img src='../images/studphoto/id<?=$datStudent['id']?>.jpg' width='120px' height='160px' style="border:#000000 1px solid" alt='รูปนักเรียน'/></td>
			</tr>
			<tr>
				<td align="right">ชื่อ - สกุล :</td>
				<td><?=displayText($datStudent['prefix'] . $datStudent['firstname'] . ' '. $datStudent['lastname'])?></td>
			</tr>
			<tr>
				<td align="right">ชื่อเล่น :</td>
				<td><?=displayText($datStudent['nickname'])?></td>
			</tr>
			<tr>
				<td align="right">ระดับชั้น :</td>
				<td><?=displayText($datStudent['xlevel']==3?$datStudent['xyearth']:$datStudent['xyearth']+3).'/'.displayText($datStudent['room'])?></td>
			</tr>
			<tr>
				<td align="right">สถานภาพ :</td>
				<td><?=displayText(displayStudentStatusColor($datStudent['studstatus']))?></td>
			</tr>
			<tr>
				<td align="right">คะแนนความประพฤติ :</td>
				<td><?=displayText($datStudent['points'])?></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</table>
		<?	$_sql = "select a.dis_id,a.dis_date,a.dis_detail,b.dis_status
						from student_discipline a right outer join student_disciplinestatus b on (a.dis_id = b.dis_id)
						where a.dis_studentid = '" . $s_id . "' and b.acadyear = '".$acadyear."' ";
			if($_POST['split']=="split") $_sql .= " and dis_detail not like '%การเข้าร่วมกิจกรรมหน้าเสาธง%' ";
			$_sql .= " order by dis_date";?>
		<?	$_resDis = mysql_query($_sql);?>
		<?	if(mysql_num_rows($_resDis) > 0){ ?>
			<table class="admintable">
				<tr> 
					<td height="30px" class="key" colspan="5"> &nbsp; รายละเอียดเกี่ยวกับพฤติกรรมไม่พึงประสงค์ ปีการศึกษา <?=$acadyear?></td>
				</tr>
				<tr>
					<td class="key" align="center" width="50px">ลำดับที่</td>
					<td class="key" align="center" width="80px">รหัส<br/>พฤติกรรม</td>
					<td class="key" align="center" width="150px">วัน เดือน ปี</td>
					<td class="key" align="center" width="350px">รายละเอียดพฤติกรรม</td>
					<td class="key" align="center" width="150px">สถานะดำเนินการ</td>
				</tr>
				<? $_i=1;?>
				<? while($_dat = mysql_fetch_assoc($_resDis)) { ?>
				<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
					<td align="center" valign="top"><?=$_i++?></td>
					<td valign="top" align="center"><?=$_dat['dis_id']?></td>
					<td valign="top"><?=displayDate($_dat['dis_date'])?></td>
					<td valign="top"><?=$_dat['dis_detail']?></td>
					<td valign="top"><?=displayDisciplineStatus($_dat['dis_status'])?></td>
				</tr>
				<? }//end while ?>
			</table>
		<? } else { echo "<br/><center><font color='red'>ไม่มีประวัติพฤติกรรมไม่พึงประสงค์</font></center>";} ?>
  <? } else { echo "<br/><center><font color='red'>ไม่พบข้อมูลนักเรียน กรุณาตรวจสอบเลขประจำตัวนักเรียนอีกครั้ง</font></center>";} ?>
<? } // end if-else check submit data ?>

</div>



