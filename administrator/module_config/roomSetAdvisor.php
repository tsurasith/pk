<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_config/index">
			<img src="../images/config.png" alt="" width="48" height="48" />
		</a>
	</td>
      <td><strong><font color="#990000" size="4">ปรับแต่งระบบ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.2 จัดการครูที่ปรึกษา</strong></font></span></td>
      <td align="right">
	  	<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_config/roomSetAdvisor&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_config/roomSetAdvisor&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_config/roomSetAdvisor&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_config/roomSetAdvisor&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<br/>
		<form method="post">
		<font color="#000000" size="2"  >
		<? $sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id"; ?>
		<? $resRoom = mysql_query($sql_Room); ?>
		 เลือกห้องเรียน 
		 <select name="roomID" class="inputboxUpdate">
		  	<option value=""> &nbsp; &nbsp; &nbsp; </option>
			<? while($dat = mysql_fetch_assoc($resRoom)){
					$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
					echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
					echo displayRoom($dat['room_id']);
					echo "</option>";
					} mysql_free_result($resRoom); ?>
			</select>
			<input type="submit" value="แก้ไข" name="search" class="button" />
			</font>
		</form>
	  </td>
    </tr>
  </table>

<? if(isset($_POST['search']) && $_POST['roomID'] == ""){?>
		<br/><font color="#FF0000"><center>กรุณาเลือกห้องเรียนที่ต้องการแก้ไขก่อน !</center></font><br/><br/>
<? } //end if ?>

<? if(isset($_POST['search']) && $_POST['roomID'] != ""){ ?>
		<form method="post">
		<? $_resRoom = mysql_query("select teacher_id,teacher_id2 from rooms where room_id = '" . $_POST['roomID'] . "' and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'");?>
		<? $_datRoom = mysql_fetch_assoc($_resRoom); ?>
		<? $_sqlTeacher = "select teaccode,prefix,firstname,lastname from teachers where type in ('admin','teacher') order by firstname"; ?>
		<? $_resTeacher = mysql_query($_sqlTeacher); ?>
		<? $_resTeacher2 = mysql_query($_sqlTeacher); ?>
		<table class="admintable" width="100%">
			<tr>
				<td colspan="3" class="key" align="center">
					รายการข้อมูลแก้ไขห้อง <?=displayRoom($_POST['roomID'])?> ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
				</td>
			</tr>
			<tr>
				<td width="50px"></td>
				<td width="200px" align="right">ครูที่ปรึกษาคนที่ 1 :</td>
				<td>
					<select name="teacher_id" class="inputboxUpdate">
						<option value=""></option>
					<? while($_dat = mysql_fetch_assoc($_resTeacher)){ ?>
						<option value="<?=$_dat['teaccode']?>" <?=$_dat['teaccode']==$_datRoom['teacher_id']?"selected":""?> ><?=$_dat['prefix'].$_dat['firstname'].' '.$_dat['lastname']?></option>
					<? } mysql_free_result($_resTeacher);//end while ?>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td align="right">ครูที่ปรึกษาคนที่ 2 :</td>
				<td>
					<select name="teacher_id2" class="inputboxUpdate">
						<option value=""></option>
					<? while($_dat = mysql_fetch_assoc($_resTeacher2)){ ?>
						<option value="<?=$_dat['teaccode']?>" <?=$_dat['teaccode']==$_datRoom['teacher_id2']?"selected":""?> ><?=$_dat['prefix'].$_dat['firstname'].' '.$_dat['lastname']?></option>
					<? } //end while ?>
					</select>
				</td>
			</tr>
			<tr>
				<td></td><td></td>
				<td>
					<br/>
					<input type="hidden" name="room_id" value="<?=$_POST['roomID']?>" />
					<input type="hidden" name="acadyear" value="<?=$acadyear?>" />
					<input type="hidden" name="acadsemester" value="<?=$acadsemester?>" />
					<input type="submit" name="save" value="บันทึก" class="button" /> 
					<input type="button" value="ยกเลิก" class="button" onclick="location.href='index.php?option=module_config/roomSetAdvisor&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>'" />
					<br/><br/><br/>
				</td>
			</tr>
		</table>
		</form>
<? } ?>

<? 
	if(isset($_POST['save'])){
		$_sql = "update rooms set 
					teacher_id = '" . $_POST['teacher_id'] . "',
					teacher_id2 = '" .$_POST['teacher_id2'] . "'
				 where room_id = '" . $_POST['room_id'] . "' and 
				 		acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' ";
		if(mysql_query($_sql)){ echo "<br/><center><font color='green'><b>บันทึกแก้ไขเรียบร้อยแล้ว</b></font></center><br/><br/>"; }
		else{ echo "<br/><center><font color='red'>บันทึกแก้ไขผิดพลาด เนื่องจาก - " . mysql_error() . "</font></center<br/><br/>"; }
	}
?>

	<? $_sqlAllRoom = "select * from rooms where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' order by room_id";?>
	<? $_resAll = mysql_query($_sqlAllRoom); ?>
	<table class="admintable" width="100%">
  		<tr>
			<td colspan="4"><b>ข้อแนะนำ</b> ก่อนทำการจัดการครูที่ปรึกษา ควรที่ทำการเพิ่ม/ลบ ข้อมูลห้องเรียนของระบบ ให้ตรงกันกับ ห้องเรียนในฐานข้อมูลประวัตินักเรียน</td>
		</tr>
		<? if(mysql_num_rows($_resAll)>0) {?>
		<tr>
			<td colspan="4" align="center" class="key"><br/>ข้อมูลห้องเรียนภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?><br/><br/></td>
		</tr>
		<tr>
			<td class="key" align="center" width="50px">ที่</td>
			<td class="key" align="center" width="120px">ห้องเรียน</td>
			<td class="key" align="center" width="200px">ครูที่ปรึกษาคนที่ 1</td>
			<td class="key" align="center" width="200px">ครูที่ปรึกษาคนที่ 2</td>
		</tr>
			<? $_x = 1;?>
			<? while($_datAll = mysql_fetch_assoc($_resAll)){ ?>
				<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
					<td align="center"><?=$_x++?></td>
					<td align="center"><?=displayRoom($_datAll['room_id'])?></td>
					<td><?=displayAdvisor($_datAll['teacher_id'])?></td>
					<td><?=displayAdvisor($_datAll['teacher_id2'])?></td>
				</tr>
			<? }//end while ?>
		<? } else { ?>
		<tr>
			<td colspan="4" align="center">
				<br/><br/><font color="#FF0000">ยังไม่มีข้อมูลห้องเรียนในระบบของภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?> </font>
				<br/><br/>
			</td>
		</tr>
		<? }//end check Room exist ?>
	</table>
</div>
<?
	function displayRoom($_value){
		$_level = substr($_value,0,1);
		$_room = (int)substr($_value,1,2);
		return $_level . '/' . $_room ;
	}
	function displayAdvisor($_value){
		$_sql = "select teaccode,prefix,firstname,lastname,nickname from teachers where teaccode = '" . $_value . "'";
		$_dat = mysql_fetch_assoc(mysql_query($_sql));
		return $_dat['prefix'].$_dat['firstname'].' '.$_dat['lastname']. ' [รหัส : ' .$_dat['teaccode'] . ']';
	}
?>