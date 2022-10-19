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
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.5 แจ้งนักเรียนสำเร็จการศึกษา</strong></font></span></td>
      <td>
	  	<form method="post">
			<? 
				if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			?>
			ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_history/studentSetFinish&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/studentSetFinish&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
			</font><br/>
			<font  size="2" color="#000000">เลือกห้องเรียน
			<?php 
					$sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '2' and substr(room_id,1,1) in (3,6)  order by room_id";
					$resRoom = mysql_query($sql_Room);			
			?>
			<select name="roomID" class="inputboxUpdate">
				<option value=""></option>
				<?php
					while($dat = mysql_fetch_assoc($resRoom))
					{
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
			<td class="key" colspan="2"> &nbsp; ข้อแนะนำการใช้งานโปรแกรมแจ้งสำเร็จการศึกษา</td>
		</tr>
		<tr>
			<td width="50px"></td>
			<td>
				1. โปรแกรมแจ้งสำเร็จการศึกษาจะใช้ได้ก็ต่อเมื่อสิ้นภาคเรียนที่ 2 ของปีการศึกษาที่ต้องการแจ้งนักเรียนสำเร็จการศึกษา
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
				3. ให้ทำการตรวจสอบในส่วน &quot;งานวินัย&quot; ว่านักเรียนมีคดี หรือ พฤติกรรมที่ไม่พึงประสงค์ ที่ยังไม่ดำเนินการให้เรียบร้อยหรือไม่
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				4. จากนั้นให้ทำการเลือกห้องเรียนและทำการแจ้งสำเร็จการศึกษาโดยข้อควรพึงระวังคือ โปรดตรวจสอบปีการศึกษา ให้ชัดเจน ถูกต้อง
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
<? } ?>

<? if(isset($_POST['search']) && $_POST['roomID'] != ""){ ?>
	<? $_sql = "select id,prefix,firstname,lastname,nickname,studstatus,gpa,points from students where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' and room = '" . $room . "' and xedbe = '" . $acadyear . "'";
		if($_POST['studstatus']=="1,2") $_sql .= " and studstatus in (1,2) ";
		$_sql .= " order by sex,id ";?>
	<? $_res = mysql_query($_sql); ?>
	<form method="post" id="frm1">
	<table class="admintable" width="100%">
		<tr>
			<td colspan="8" align="center">
				<img src="../images/school_logo.gif" width="120px"><br/>
				<b>รายชื่อนักเรียนห้อง <?=getFullRoomFormat($_POST['roomID'])?><br/>
				ปีการศึกษา <?=$acadyear?></b>
			</td>
		</tr>
		<tr>
			<td width="40px" align="center" class="key">เลขที่</td>
			<td width="85px" align="center" class="key">เลขประจำตัว</td>
			<td  align="center" class="key">ชื่อ - นามสกุล</td>
			<td align="center" width="100px" class="key">ชื่อเล่น</td>
			<td align="center" width="65px" class="key">GPA.</td>
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
			<td align="center"><input type="checkbox" name="student[<?=$_i?>]" id="chk<?=$_i?>" value="<?=$_dat['id'] ?>" onclick="check('row<?=$_i?>',<?=$_i++?>)" <?=$_dat['studstatus']!=1?"disabled=disabled":""?>/></td>
		</tr>
		<? } //end while?>
		<tr>
			<td colspan="7" align="center">
				<input type="hidden" value="<?=$acadyear?>" name="acadyear" />
				<input type="hidden" value="<?=$_i?>" name="counter" />
				<input type="submit" name="save" value="จบการศึกษา" class="button" />
				<input type="button" value="ยกเลิก" class="button" onclick="location.href='index.php?option=module_history/index'" />
			</td>
		</tr>
	</table>
	</form>
<? }//end if ?>

<? if(isset($_POST['save'])){
		$_operation = false;
		for($_i = 1; $_i < $_POST['counter']; $_i++){
			if($_POST['student'][$_i] != "")
			{
				$_sql = "update students set studstatus = '2' where id = '" . $_POST['student'][$_i] . "' and xedbe = '" . $_POST['acadyear'] . "'";
				mysql_query($_sql) or die ('<center><font color=red><br/><br/>ผิดพลาดเนื่องจาก ' . mysql_error() . '<br/></font></center>');
				$_operation = true;
				//echo $_i .'. ' .$_POST['student'][$_i].'<br/>';
				
			}
		}
		//----แสดงผลหากไม่มีการเลือกข้อมูลนักเรียนคนใดเลย
		if($_operation)
		{
			echo "<center><font color='green'><br/><br/>";
			echo "ระบบได้ดำเนินการปรับสถานะนักเรียนจากรายการที่เลือกเป็น 'สำเร็จการศึกษา' เรียบร้อยแล้ว<br/><br/> ";
			echo "<input type='button' value='ดำเนินการต่อไป' onclick=\"location.href='index.php?option=module_history/studentSetFinish&acadyear=" . $_POST['acadyear'] . "'\"/>";
			echo "</font></center>";
		}
		else
		{
			echo "<font color='red'><center><br/>ยังไม่มีการดำเนินการใดๆ<br/>เนื่องจากคุณยังไม่ได้เลือกรายการแจ้งสำเร็จการศึกษาของนักเรียน<br/><br/>";
			echo "<input type='button' value='ย้อนกลับ' onclick=\"history.go(-1)\" />";
			echo "</center></font>";
		}
	}
?>
</div>

 