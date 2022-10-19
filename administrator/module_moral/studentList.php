<div id="content">
	<form action="" method="post">
		<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
			<tr>
				<td width="6%" align="center"><a href="index.php?option=module_moral/index"><img src="../images/objects.png" alt="" width="48" height="48" border="0"/></a></td>
				<td>
					<strong><font color="#990000" size="4">ระบบสารสนเทศธนาคารความดี</font></strong><br />
					<span class="normal"><font color="#0066FF"><strong>1. รายชื่อนักเรียนตามห้องเรียน</strong></font></span>
				</td>
				<td>
				<?php
				if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
				else if(isset($_POST['acadyear'])){ $acadyear = $_POST['acadyear']; }
				if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
				else if(isset($_POST['acadsemester'])){ $acadsemester = $_POST['acadsemester']; }
				?>
				ปีการศึกษา<?php  
						echo "<a href=\"index.php?option=module_moral/studentList&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
						echo '<font color=\'blue\'>' .$acadyear . '</font>';
						echo " <a href=\"index.php?option=module_moral/studentList&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
					?>
					ภาคเรียนที่   <?php 
						if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
						else {
							echo " <a href=\"index.php?option=module_moral/studentList&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
						}
						if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
						else {
							echo " <a href=\"index.php?option=module_moral/studentList&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
						}
					?>
			</font><br/>
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
<? if(isset($_POST['search']) && $_POST['roomID']==""){ ?>
		<br/><br/><center><font color="#FF0000">กรุณาเลือก ห้องเรียน ที่ต้องการทราบข้อมูลก่อน</font></center>
<? } ?>

<? if($_POST['roomID'] != ""){ 
		$xlevel = getXlevel($_POST['roomID']);
		$xyearth= getXyearth($_POST['roomID']);
		$room = getRoom($_POST['roomID']);
?>
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
                <td class="key" width="80px" align="center">เลขประจำตัว</td>
                <td class="key" width="190px" align="center">ชื่อ - นามสกุล</td>
                <td class="key" width="80px" align="center">คะแนน<br/>ความประพฤติ</td>
                <td class="key" width="60px" align="center">ชื่อเล่น</td>
                <td class="key" width="100px"  align="center">สถานภาพ<br/>ปัจจุบัน</td>
                <td class="key" width="150px" align="center">หมู่บ้าน</td>
                <td class="key" width="80px" align="center">เวลาที่ใช้<br/>ในการมาร.ร.</td>
            </tr>
            <? $sqlStudent = "select id,prefix,firstname,lastname,nickname,howlong,p_village,points,studstatus
                                 from students 
                                 where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' 
                                        and room = '" . $room . "' and xedbe = '" . $acadyear . "' ";
                if($_POST['studstatus']=="1,2") {$sqlStudent .= " and studstatus in (1,2) ";}
                $sqlStudent .= " order by sex,id "; ?>
            <? $resStudent = mysql_query($sqlStudent); ?>
            <? $ordinal=1;?>
            <? while($dat = mysql_fetch_array($resStudent)) { ?>
                    <tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
                        <td align="center"><?=$ordinal++?></td>
                        <td align="center"><a href='index.php?option=module_moral/addMoral&acadsemester=<?=$acadsemester?>&acadyear=<?=$acadyear?>&studentid=<?=$dat['id']?>' ><?=$dat['id']?></a></td>
                        <td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
                        <td align="center"><?=displayPoint($dat['points'])?></td>
                        <td align="center"><?=$dat['nickname']?></td>
                        <td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
                        <td><?=$dat['p_village']?></td>
                        <td align="center"><?=$dat['howlong']?></td>
    </tr>
            <? } //end while?>
        </table>		
<? } ?>

</div>

