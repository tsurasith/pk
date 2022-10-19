
<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_maps/index"><img src="../images/add.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">แผนที่ติดตามที่อยู่</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>4.1 รายการแก้ไขข้อมูลเพิ่มเติมเกี่ยวกับแผนที่และที่อยู่อาศัย<br/>ของนักเรียน [รายชื่อตามห้อง]</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			else if(isset($_POST['acadyear'])) { $acadyear = $_POST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
			else if(isset($_POST['acadsemester'])) { $acadsemester = $_POST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_maps/studentListEdit&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_maps/studentListEdit&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_maps/studentListEdit&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_maps/studentListEdit&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		</font>
		<br/>
	  		<font color="#000000"  size="2" >เลือกห้อง 
			<?php 
					$sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
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
		 </font>
	   </td>
    </tr>
  </table>
  </form>
<? if(isset($_POST['search']) && $_POST['roomID'] == "") { ?>
		<center><font color="#FF0000"><br/>กรุณาเลือก ห้องเรียน ที่ต้องการเรียกดูข้อมูลก่อน</font></center>
<? } //end if ?>

<?php
      $xlevel = getXlevel($_POST['roomID']);
	  $xyearth= getXyearth($_POST['roomID']);
	  $room = getRoom($_POST['roomID']);
?>

<? if(isset($_POST['search']) && $_POST['roomID'] != "") { ?>
	<table class="admintable" width="100%" align="center">
		<tr> 
			<th colspan="8" align="center">
				<img src="../images/school_logo.gif" width="120px"><br/>
				รายชื่อนักเรียนห้อง <?=getFullRoomFormat($_POST['roomID'])?> <br/>
				ภาคเรียนที่ <?=$acadsemester; ?> ปีการศึกษา <?=$acadyear; ?>
			</th>
		</tr>
		<tr> 
			<td class="key" width="35px" align="center">เลขที่</td>
			<td class="key" width="80px" align="center">เลขประจำตัว</td>
			<td class="key" width="200px" align="center">ชื่อ - นามสกุล</td>
			<td class="key" width="100px"  align="center">สถานภาพ<br/>ปัจจุบัน</td>
			<td class="key" align="center">แก้ไขรูปบ้าน</td>
			<td class="key" align="center">แก้ไขรูปบิดา</td>
			<td class="key" align="center">แก้ไขรูปมารดา</td>
			<td class="key" align="center">แก้ไขรูป<br/>ผู้ปกครอง</td>
		</tr>
		<?php
			$sqlStudent = "select id,prefix,firstname,lastname,studstatus from students 
						 where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' and room = '" . $room . "' and xedbe = '" . $acadyear . "' ";
			if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
			$sqlStudent .= " order by sex,id ";
			$resStudent = mysql_query($sqlStudent);
			$ordinal = 1; ?>
		<? while ($dat = mysql_fetch_array($resStudent)) { ?>
		<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
			<td align="center"><?=$ordinal++?></td>
			<td align="center"><?=$dat['id']?></td>
			<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
			<td align="center"><?=displayStatus($dat['studstatus'])?></td>
			<td align="center">
				<a href="index.php?option=module_maps/updateHomePics&room=<?=$_POST['roomID']?>&acadsemester=<?=$acadsemester?>&acadyear=<?=$acadyear?>&student_id=<?=$dat['id']?>&report=studentListEdit">
				<? if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/pk/images/studhome/id" . $dat['id'] .".jpg")) { ?>
					<img src="../images/home.png" width="16px" alt="คลิ๊กเพื่อแก้ไขรูปถ่ายบ้านพักของนักเรียน" />
				<? } else { ?>
					<img src="../images/delete.png" width="16px" alt="คลิ๊กเพื่อแก้ไขรูปถ่ายบ้านพักของนักเรียน" />
				<? } ?>
				</a>
			</td>
			<td align="center">
				<a href="index.php?option=module_maps/updateFatherPics&room=<?=$_POST['roomID']?>&acadsemester=<?=$acadsemester?>&acadyear=<?=$acadyear?>&student_id=<?=$dat['id']?>&report=studentListEdit">
				<? if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/pk/images/PapaPhoto/id" . $dat['id'] .".jpg")) { ?>
					<img src="../images/apply.png" width="16px" alt="คลิ๊กเพื่อแก้ไขรูปบิดาของนักเรียน" />
				<? } else { ?>
					<img src="../images/delete.png" width="16px" alt="คลิ๊กเพื่อแก้ไขรูปบิดาของนักเรียน" />
				<? } ?>
				</a>
			</td>
			<td align="center">
				<a href="index.php?option=module_maps/updateMotherPics&room=<?=$_POST['roomID']?>&acadsemester=<?=$acadsemester?>&acadyear=<?=$acadyear?>&student_id=<?=$dat['id']?>&report=studentListEdit">
				<? if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/pk/images/MamaPhoto/id" . $dat['id'] .".jpg")) { ?>
					<img src="../images/apply.png" width="16px" alt="คลิ๊กเพื่อแก้ไขรูปมารดาของนักเรียน" />
				<? } else { ?>
					<img src="../images/delete.png" width="16px" alt="คลิ๊กเพื่อแก้ไขรูปมารดาของนักเรียน" />
				<? } ?>
				</a>
			</td>
			<td align="center">
				<a href="index.php?option=module_maps/updateAPics&room=<?=$_POST['roomID']?>&acadsemester=<?=$acadsemester?>&acadyear=<?=$acadyear?>&student_id=<?=$dat['id']?>&report=studentListEdit">
				<? if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/pk/images/APhoto/id" . $dat['id'] .".jpg")) { ?>
					<img src="../images/apply.png" width="16px" alt="คลิ๊กเพื่อแก้ไขรูปผู้ปกครองของนักเรียน" />
				<? } else { ?>
					<img src="../images/delete.png" width="16px" alt="คลิ๊กเพื่อแก้ไขรูปผู้ปกครองของนักเรียน" />
				<? } ?>
				</a>
			</td>
		</tr>
		<? } //end while ?>
</table>
<? } //end if แสดงข้อมูล ?>  
</div>
<?php
	function displayStatus($id) {
		switch ($id) {
			case 0 :  return "<font color='red'><b>ออก</b></font>"; break;
			case 1 :  return "ปกติ"; break;
			case 2 :  return "<b>สำเร็จการศึกษา</b>"; break;
			case 3 :  return "<font color='red'><b>แขวนลอย</b></font>"; break;
			case 4 :  return "<font color='darkorange'><b>พักการเรียน</b></font>"; break;
			case 5 :  return "<font color='blue'><b>ย้ายสถานศึกษา</b></font>"; break;
			case 9 :  return "<font color='red'><b>เสียชีวิต</b></font>"; break;
			default : return " - ไม่ทราบ - ";
		}	
	}
?>