
<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td width="45%"><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.3 สืบค้นประวัติการเข้าเรียน</strong></font></span></td>
      <td >
	  <?php
			$s_id;
			if(isset($_POST['search'])){ $s_id = $_POST['studentid'];} 
			else if(isset($_REQUEST['studentID']) && !isset($_POST['search'])){$s_id = $_REQUEST['studentID'];}
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_history/history_room&studentID=" . $s_id . "&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/history_room&studentID=" . $s_id . "&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_history/history_room&studentID=" . $s_id . "&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_history/history_room&studentID=" . $s_id . "&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		</font><br/>
		<font   size="2" color="#000000">
		เลขประจำตัวนักเรียน 
	  	<input type="text" size="5" maxlength="5" name="studentid" id="studentid" onKeyPress="return isNumberKey(event)" class="inputboxUpdate" value="<?=isset($_POST['studentid'])?$_POST['studentid']:$_REQUEST['studentID']?>"/>
	  	<input type="submit" value="สืบค้น" class="button" name="search"/></font></td>
    </tr>
  </table>
  </form>
<? if(isset($_POST['search']) && $_POST['studentid'] == "") { ?>
	<br/><center><font color="#FF0000">กรุณาป้อนเลขประจำตัวนักเรียนก่อน !</font></center>
<? } else if(isset($_POST['search']) || (isset($_REQUEST['studentID']) && $_REQUEST['studentID'] != "")){ ?>
	<? 
		$_sql = "select id,prefix,firstname,lastname,nickname,xlevel,xyearth,room,studstatus,p_village,travelby
					from students where id = '" .$s_id."' and xedbe = '" . $acadyear . "'";
		$_res = mysql_query($_sql);
	?>
	<? if(mysql_num_rows($_res)>0) { ?>
		<? $_dat = mysql_fetch_assoc($_res);?>
		<table class="admintable" bgcolor="#FFCCFF" cellspacing="1">
		<tr><td  class="key" colspan="11">รายละเอียดการเข้าเรียนภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?></td></tr>
		<tr bgcolor="#FFFFFF">
			<td  colspan="11">
				<table width="100%" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
					<tr>
						<td align="right" width="250px">เลขประจำตัว :</td>
						<td width="200px"><b><?=$_dat['id']?></b></td>
						<td rowspan="7" align="right"><img src="../images/studphoto/id<?=$_dat['id']?>.jpg" width='120px' style="border:#000000 solid 1px"/></td>
					</tr>
					<tr>
						<td align="right">ชื่อ - สกุล :</td>
						<td><b><?=$_dat['prefix'].$_dat['firstname']. ' ' . $_dat['lastname']?></b></td>
					</tr>
					<tr>
						<td align="right">ชื่อเล่น :</td>
						<td><b><?=$_dat['nickname']?></b></td>
					</tr>
					<tr>
						<td align="right">ห้อง :</td>
						<td><b><?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?>/<?=$_dat['room']?></b></td>
					</tr>
					<tr>
						<td align="right">สถานภาพปัจจุบัน :</td>
						<td><b><?=displayStudentStatusColor($_dat['studstatus'])?></b></td>
					</tr>
					<tr>
						<td align="right">หมู่บ้านที่อาศัย :</td>
						<td><b><?=$_dat['p_village']?></b></td>
					</tr>
					<tr>
						<td align="right">การเดินทางมาโรงเรียน :</td>
						<td><b><?=displayTravel($_dat['travelby'])?></b></td>
					</tr>
				</table>
			</td>		
		</tr>
		<tr> 
		  <td  class="key" colspan="11"> ข้อมูลนักเรียนแสดงรายวัน</td>
		</tr>
		<?
			$_sqlx = "select a.check_date,a.timecheck_id as x,
						 sum(if(period = 1,b.timecheck_id,null)) as a,
						 sum(if(period = 2,b.timecheck_id,null)) as b,
						 sum(if(period = 3,b.timecheck_id,null)) as c,
						 sum(if(period = 4,b.timecheck_id,null)) as d,
						 sum(if(period = 5,b.timecheck_id,null)) as e,
						 sum(if(period = 6,b.timecheck_id,null)) as f,
						 sum(if(period = 7,b.timecheck_id,null)) as g,
						 sum(if(period = 8,b.timecheck_id,null)) as h
						from student_800 a right outer join student_learn b
						on (a.check_date = b.check_date and a.student_id = b.student_id)
						where a.student_id = '" . $s_id . "'
						and a.acadyear = '" . $acadyear . "' and a.acadsemester = '" . $acadsemester . "'
						and b.acadyear = '" . $acadyear . "' and b.acadsemester = '" . $acadsemester . "'
						group by a.check_date order by check_date";
			$_resx = mysql_query($_sqlx);
			//echo $_sqlx;
		?>
		<tr>
			<td class="key" align="center" width="65px" rowspan="2">ลำดับที่</td>
			<td class="key" align="center" width="165px" rowspan="2">วันที่เช็ค</td>
			<td class="key" align="center" width="80px" rowspan="2">หน้าเสาธง</td>
			<td class="key" align="center" width="320px" colspan = "8">คาบเรียน</td>
		</tr>
		<tr align="center">
			<td class="key" width="45px">คาบ1</td>
			<td class="key" width="45px">คาบ2</td>
			<td class="key" width="45px">คาบ3</td>
			<td class="key" width="45px">คาบ4</td>
			<td class="key" width="45px">คาบ5</td>
			<td class="key" width="45px">คาบ6</td>
			<td class="key" width="45px">คาบ7</td>
			<td class="key" width="45px">คาบ8</td>
		</tr>
		<? $_i = 1; ?>
		<? while($_dat = mysql_fetch_assoc($_resx)) { ?>
		<tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
			<td align="center"><?=$_i++?></td>
			<td align="center"><?=displayFullDate($_dat['check_date'])?></td>
			<td align="center"><?=displayTimecheckColor($_dat['x'])?></td>
			<td align="center"><?=displayTimecheckColor($_dat['a'])?></td>
			<td align="center"><?=displayTimecheckColor($_dat['b'])?></td>
			<td align="center"><?=displayTimecheckColor($_dat['c'])?></td>
			<td align="center"><?=displayTimecheckColor($_dat['d'])?></td>
			<td align="center"><?=displayTimecheckColor($_dat['e'])?></td>
			<td align="center"><?=displayTimecheckColor($_dat['f'])?></td>
			<td align="center"><?=displayTimecheckColor($_dat['g'])?></td>
			<td align="center"><?=displayTimecheckColor($_dat['h'])?></td>
		</tr>
		<? } mysql_free_result($_resx);//end while ?>
	</table>
	<? } else { echo "<br><center><font color='red'>ไม่พบข้อมูลนักเรียน กรุณาตรวจสอบเลขประจำตัวนักเรียนอีกครั้ง</font></center>";}?>
<? } //end if submit data ?>
</div>


