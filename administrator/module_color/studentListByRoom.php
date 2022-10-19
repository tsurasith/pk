<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_color/index"><img src="../images/color.png" alt="กิจกรรมคณะสี" width="48" height="48" border="0"/></a></td>
	  <td><strong><font color="#990000" size="4">กิจกรรมคณะสี</font></strong><br />
		<span class="normal"><font color="#0066FF"><strong>3.1.1 รายชื่อนักเรียนตามห้องเรียนและคณะสี</strong></font></span></td>
      <td align="right">
	  <?php
			if(isset($_REQUEST['acadyear']))
			{
				$acadyear = $_REQUEST['acadyear'];
			}
			if(isset($_REQUEST['acadsemester']))
			{
				$acadsemester = $_REQUEST['acadsemester'];
			}
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_color/studentListByRoom&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_color/studentListByRoom&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_color/studentListByRoom&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_color/studentListByRoom&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		</font>
		<br/>
	  	<font  size="2" color="#000000">เลือกห้องเรียน
			<?php 
					$sql_Room = "select replace(room_id,'0','/') as room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
					//echo $sql_Room ;
					$resRoom = mysql_query($sql_Room);			
			?>
			<select name="roomID" class="inputboxUpdate">
				<option value=""></option>
				<?php

					while($dat = mysql_fetch_assoc($resRoom))
					{
						$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
						echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
						echo $dat['room_id'];
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
  <?php
  $xlevel;
  $xyearth;
  $room = substr($_POST['roomID'],2,1);
  if(substr($_POST['roomID'],0,1) > 3)
  {
  	$xlevel = 4;
	if(substr($_POST['roomID'],0,1) == 4){ $xyearth = 1;}
	if(substr($_POST['roomID'],0,1) == 5){ $xyearth = 2;}
	if(substr($_POST['roomID'],0,1) == 6){ $xyearth = 3;}		
  }
  else
  {
  	$xlevel = 3;
	if(substr($_POST['roomID'],0,1) == 1){ $xyearth = 1;}
	if(substr($_POST['roomID'],0,1) == 2){ $xyearth = 2;}
	if(substr($_POST['roomID'],0,1) == 3){ $xyearth = 3;}
  }
  ?>
  
<? if(isset($_POST['search']) && $_POST['roomID'] == "") { ?>
	<center><br/><br/><font color="#FF0000">กรุณาเลือกห้องเรียนก่อน</font></center>
<? } else if (isset($_POST['search']) && $_POST['roomID'] != "") { ?>
  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th colspan="6" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายชื่อนักเรียนห้อง <?=$_POST['roomID']?><br/>
			ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear; ?>
	  </th>
    </tr>
    <tr height="35px"> 
		<td width="50px" align="center" class="key">เลขที่</td>
      	<td width="95px" align="center" class="key">เลขประจำตัว</td>
      	<td width="200px" align="center"class="key">ชื่อ - นามสกุล</td>
		<td width="90px" align="center" class="key">ชื่อเล่น</td>
      	<td width="110px" align="center"class="key">สถานภาพ</td>
		<td width="120px" align="center" class="key">คณะสี</td>
    </tr>
	<? $sqlStudent = "select id,prefix,firstname,lastname,nickname,studstatus,color from students 
						where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' and room = '" . $room . "'  and xedbe = '" . $acadyear . "' "; ?>
	<?	if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) "; ?>
	<?	$sqlStudent .= "order by sex,id "; ?>
	<?	$resStudent = mysql_query($sqlStudent); ?>
	<?	$ordinal = 1; ?>
	<? while($dat = mysql_fetch_assoc($resStudent)){ ?>
		<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
			<td align="center"><?=$ordinal++?></td>
			<td align="center"><?=$dat['id']?></td>
			<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
			<td align="center"><?=$dat['nickname']==""?"-":$dat['nickname']?></td>
			<td align="center"><?=displayStatus($dat['studstatus'])?></td>
			<td align="center"><?=$dat['color']!="9"?$dat['color']:"-"?></td>
		</tr>
	<? } //end while?>
</table>
  <? } //end else-if ?>
</div>
<?php
	function displayStatus($id) {
		switch ($id) {
			case 0 :  return "<font color='red'><b>ออก</b></font>"; break;
			case 1 :  return "<font color='green'><b>ปกติ</b></font>"; break;
			case 2 :  return "<b>สำเร็จการศึกษา</b>"; break;
			case 3 :  return "<font color='red'><b>แขวนลอย</b></font>"; break;
			case 4 :  return "<font color='darkorange'><b>พักการเรียน</b></font>"; break;
			case 5 :  return "<font color='blue'><b>ย้ายสถานศึกษา</b></font>"; break;
			case 9 :  return "<font color='red'><b>เสียชีวิต</b></font>"; break;
			default : return " - ไม่ทราบ - ";
		}	
	}
?>