    

<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_config/index">
			<img src="../images/config.png" alt="" width="48" height="48" />
		</a>
	</td>
      <td><strong><font color="#990000" size="4">ปรับแต่งระบบ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.1 เพิ่ม/ลบ ห้องเรียนที่ใช้ในระบบ</strong></font></span></td>
      <td>
	  	<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_config/roomSetting&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_config/roomSetting&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_config/roomSetting&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_config/roomSetting&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<br/>
	  </td>
    </tr>
  </table>

	<table class="admintable" width="100%">
  		<tr>
			<td class="key" colspan="2" align="center">
				<br/>แสดงรายการข้อมูลการจัดการห้องเรียนระหว่างห้องเรียนจากฐานข้อมูลประวัติ และ ห้องเรียนจากระบบ<br/>
				เพื่อให้การทำงานของระบบสารสนเทศทำงานอย่างถูกขั้นตอนกรุณาสร้าง และตรวจสอบจัดการห้องเรียน ทุกๆ 1 ภาคเรียน<br/>
			</td>
		</tr>
		<tr>
			<td width="50%" valign="top" align="center" class="key">ปีการศึกษา <?=$acadyear?></td>
			<td valign="top" align="center" class="key">ภาคเรียนที่ <?=$acadsemester?></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<? if(isset($_POST['save']) && ($_POST['room_id'] == "" || strlen($_POST['room_id'])<3)) { ?>
						<font color="#FF0000"><br/>การเพิ่มห้องเรียนผิดพลาด กรุณาป้อนรหัสห้องเรียนให้ถูกรูปแบบก่อน !<br/><br/></font>
				<? } //end check isempty ?>
				
				<? if(isset($_POST['save']) && $_POST['room_id'] != "" && strlen($_POST['room_id']) == 3) { ?>
						<? if(mysql_num_rows(mysql_query("select * from rooms where acadyear = '" .$_POST['acadyear']."' and acadsemester = '" .$_POST['acadsemester'] ."' and room_id = '" .$_POST['room_id']."'"))>0){ ?>
								<font color="#FF0000"><br/>การเพิ่มห้องเรียนผิดพลาด เนื่องจากมีการเพิ่มห้องเรียนนี้ในภาคเรียนที่ <?=$_POST['acadsemester']?> ปีการศึกษา <?=$_POST['acadyear']?> แล้ว !<br/><br/></font>
						<? } 
							else
							{
								$_sqlInsert = "insert into rooms values(
											'" . $_POST['room_id'] . "',
											'000','000','',
											'" . $_POST['acadsemester']. "',
											'" . $_POST['acadyear']."')";
								if(mysql_query($_sqlInsert)){ echo "<font color='green'><br/><b>ได้ทำการบันทึกห้อง " . displayRoom($_POST['room_id']) . " เรียบร้อยแล้ว<b><br/><br/> </font>";}
								else { echo "<font color='red'><br/>เกิดข้อผิดพลาดเนื่องจาก - " . mysql_error() . "</font>";}
							}
						?>
				<? } //end submit valid value ?>
			</td>
		</tr>
		<tr>
			<td><b>สารสนเทศห้องเรียนจากฐานข้อมูลประวัติ</b></td>
			<td><b>สารสนเทศห้องเรียนที่สร้างขึ้นจากระบบ</b></td>
		</tr>
		<tr>
			<td align="center" valign="top">
				<? $_sqlH = "select xlevel,xyearth,room,count(id) as student from students
						where xedbe = '" . $acadyear . "'
						group by room,xyearth,xlevel order by xlevel,xyearth,room"; ?>
				<? $_resH = mysql_query($_sqlH); ?>
				<? if(mysql_num_rows($_resH)>0){ ?>
						<table>
							<tr>
								<td class="key" align="center">ที่</td>
								<td class="key" width="90px" align="center">ห้อง</td>
								<td class="key" align="center" width="140px">จำนวน<br/>นักเรียน</td>
							</tr>
							<? $_cRoomH = 1;?>
							<? while($_dat = mysql_fetch_assoc($_resH)){ ?>
							<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
								<td align="center"><?=$_cRoomH++?></td>
								<td align="center"><?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?>/<?=$_dat['room']?></td>
								<td align="center"><?=$_dat['student']?></td>
							</tr>
							<? } ?>
						</table>
				<? } else { echo "<font color='red'><br/>ไม่มีข้อมูลห้องเรียนจากฐานข้อมูลประวัตินักเรียน</font><br/><br/>";}?>
			</td>
			<td align="center" valign="top">
				<? $_sqlS = "select * from rooms where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' order by room_id";?>
				<? $_resS = mysql_query($_sqlS); ?>
				<? if(mysql_num_rows($_resS)>0){ ?>
						<table>
							<tr>
								<td class="key" align="center">ที่</td>
								<td class="key" width="90px" align="center">ห้อง</td>
								<td class="key" align="center" width="100px">รหัสครูที่ปรึกษา<br/>คนที่ 1</td>
								<td class="key" align="center" width="100px">รหัสครูที่ปรึกษา<br/>คนที่ 2</td>
								<td class="key" align="center" width="60px">ลบ<br/>ห้องเรียน</td>
							</tr>
							<? $_cRoomS = 1;?>
							<? while($_dat = mysql_fetch_assoc($_resS)){ ?>
							<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
								<td align="center"><?=$_cRoomS++?></td>
								<td align="center"><?=displayRoom($_dat['room_id'])?></td>
								<td align="center"><?=$_dat['teacher_id']?></td>
								<td align="center"><?=$_dat['teacher_id2']?></td>
								<td align="center">
									<a href="index.php?option=module_config/roomDelete&room_id=<?=$_dat['room_id']?>&acadyear=<?=$_dat['acadyear']?>&acadsemester=<?=$_dat['acadsemester']?>">
										ลบ
									</a>
								</td>
							</tr>
							<? } ?>
						</table>
				<? } else { echo "<font color='red'><br/>ไม่มีข้อมูลห้องเรียนจากฐานข้อมูลระบบ</font><br/><br/>";}?>
				
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<form method="post" autocomplete="off">
					รหัส 
					<input type="text" maxlength="3" name="room_id"  size="3" value="<?=isset($_POST['save'])?$_POST['room_id']:""?>" class="inputboxUpdate" onkeypress="return isNumberKey(event)" />
					<input type="hidden" value="<?=$acadyear?>" name="acadyear" />
					<input type="hidden" value="<?=$acadsemester?>" name="acadsemester" />
					<input type="submit" name="save" value="เพิ่ม" class="button" /><br/>
				</form>
				<b>คำแนะนำ</b>
				<ul>
					<li>ตรวจสอบ ปีการศึกษา และ ภาคเรียน ให้ถูกต้อง</li>
					<li>เพิ่มจำนวนห้องเรียนให้เท่ากับห้องเรียนที่ปรากฎอยู่ในฐานข้อมูลประวัติ</li>
					<li>หากต้องการเพิ่มห้องเรียน เช่น <b>1/1</b> ให้ป้อนข้อมูลเป็น <b>101</b> </li>
					<li>หากต้องการเพิ่มห้องเรียน เช่น <b>6/12</b> ให้ป้อนข้อมูลเป็น <b>612</b> </li>
				</ul>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<b>หมายเหตุ</b> ในกรณีเริ่มปีการศึกษาใหม่ ก่อนการดำเนินการจัดเตรียมห้องเรียนควรกระทำสิ่งต่อไปนี้ให้เสร็จก่อน
				<ol>
					<li>ทำการแจ้งนักเรียนที่สำเร็จการศึกษาโดยโปรแกรมแจ้งสำเร็จการศึกษาก่อน</li>
					<li>ทำการเลื่อนชั้นนักเรียนในแต่ละระดับชั้นโดยโปรแกรมเลื่อนชั้นก่อน
					<li>ทำการเพิ่มนักเรียนในแต่ละปีการศึกษานั้นๆ หรือนักเรียนเข้าใหม่ให้ครบถ้วนเสียก่อน</li>
				</ol>
			</td>
		</tr>
	</table>
</div>
<?
	function displayRoom($_value){
		$_level = substr($_value,0,1);
		$_room = (int)substr($_value,1,2);
		return $_level . '/' . $_room ;
	}
?>