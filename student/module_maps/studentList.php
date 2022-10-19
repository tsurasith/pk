<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_maps/index"><img src="../images/add.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td ><strong><font color="#990000" size="4">แผนที่ติดตามที่อยู่</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>1.1.1 รายชื่อนักเรียนตามห้องเรียน</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			else if(isset($_POST['acadyear'])){ $acadyear = $_POST['acadyear']; }
			
			if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
			else if(isset($_POST['acadsemester'])){ $acadsemester = $_POST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_maps/studentList&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_maps/studentList&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1){ echo "<font color='blue'>1</font> , "; }
					else{
						echo " <a href=\"index.php?option=module_maps/studentList&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2){ echo "<font color='blue'>2</font>"; }
					else{
						echo " <a href=\"index.php?option=module_maps/studentList&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
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
				<? while($dat = mysql_fetch_assoc($resRoom)) {
						$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
						echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
						echo getFullRoomFormat($dat['room_id']);
						echo "</option>";
					} ?>
			</select>
	  		<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		 </font>
	   </td>
    </tr>
  </table>
  </form>
  <?php
  	  $xlevel = getXlevel($_POST['roomID']);
	  $xyearth= getXyearth($_POST['roomID']);
	  $room = getRoom($_POST['roomID']);
  ?>

<? if(isset($_POST['search']) && $_POST['roomID']==""){ ?>
		<center><font color="#FF0000"><br/>กรุณาเลือกห้องที่ต้องการเรียกดูข้อมูลก่อน</font></center>
<? }//end if หากไม่เลือกห้องเรียนแล้วกดปุ่ม 'เรียกดู' ?>  

<? if(isset($_POST['search']) && $_POST['roomID'] != "") { ?>
	<table class="admintable" align="center">
		<tr>
			<th colspan="8" align="center">
				<img src="../images/school_logo.gif" width="120px"><br/>
				รายชื่อนักเรียนห้อง <?=getFullRoomFormat($_POST['roomID'])?> <br/>
				ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
			</th>
		</tr>
		<tr>
			<td class="key" width="35px" align="center">เลขที่</td>
			<td class="key" width="70px" align="center">เลขประจำตัว</td>
			<td class="key" width="200px" align="center">ชื่อ - นามสกุล</td>
			<td class="key" width="50px" align="center">ชื่อเล่น</td>
			<td class="key" width="100px"  align="center">สถานภาพ<br/>ปัจจุบัน</td>
			<td class="key" width="160px" align="center">หมู่บ้าน</td>
			<td class="key" width="80px" align="center">ใช้เวลา<br/>มา ร.ร.</td>
			<td class="key" width="70px"  align="center">แผนที่</td>
		</tr>
		<?	$sqlStudent = "select id,prefix,firstname,lastname,nickname,howlong,p_village,utm_coordinate_x,utm_coordinate_y,studstatus
						 from students   where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' 
						 		and room = '" . $room . "' and xedbe = '" . $acadyear . "' ";
			if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
			$sqlStudent .= " order by sex,id ";
			$resStudent = mysql_query($sqlStudent); ?>
		<? 	$ordinal = 1; ?>
		<? while($_dat = mysql_fetch_assoc($resStudent)) { ?>
			<tr>
				<td align="center"><?=$ordinal++?></td>
				<? if($_SESSION['superAdmin']) { ?>
				<td align="center"><a href='index.php?option=module_maps/updatemaps&report=studentList&room=<?=$_POST['roomID']?>&acadsemester=<?=$acadsemester?>&acadyear=<?=$acadyear?>&student_id=<?=$_dat['id']?>'><?=$_dat['id']?></a></td><? }
				else { echo "<td align='center'>" . $_dat['id'] . "</td>"; } ?>
				<td><?=$_dat['prefix'] . $_dat['firstname'] . " " . $_dat['lastname']?></td>
				<td align="center"><?=$_dat['nickname']==""?"-":$_dat['nickname']?></td>
				<td align="center"><?=displayStudentStatusColor($_dat['studstatus'])?></td>
				<td><?=$_dat['p_village']!=""?$_dat['p_village']:"-"?></td>
				<td align="center"><?=$_dat['howlong']>0?$_dat['howlong']:"-"?></td>
				<td align="center">
					<? if(trim($_dat['utm_coordinate_x']) != "" && trim($_dat['utm_coordinate_y']) != ""){ ?>
                    	<a href="module_maps/maps.php?id=<?=$_dat['id']?>
                        		&stName=<?=$_dat['prefix'].$_dat['firstname'].'%20'.$_dat['lastname']?>
                                &p_village=<?=$_dat['p_village']?>
                                &lat=<?=$_dat['utm_coordinate_x']?>
                                &long=<?=$_dat['utm_coordinate_y']?>" target="_blank">แผนที่</a>
                    <? }else { ?>
                    	-
                    <? } ?>
				</td>
			</tr>
		<? } //end while ?>
</table>
<? } //end if ?>

</div>

