<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
	<tr> 
	  <td width="6%" valign="top" align="center"><a href="index.php?option=module_color/index"><img src="../images/color.png" alt="กิจกรรมคณะสี" width="48" height="48" border="0"/></a></td>
	  <td valign="top"><strong><font color="#990000" size="4">กิจกรรมคณะสี</font></strong><br />
		<span class="normal"><font color="#0066FF"><strong>1.1.2 รายชื่อนักเรียนตามคณะสีตามระดับชั้น</strong></font></span></td>
	  <td align="right">
		<?php
				if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
				if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
			?>
			ปีการศึกษา<?php  
						echo "<a href=\"index.php?option=module_color/studentListByLevelColor&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
						echo '<font color=\'blue\'>' .$acadyear . '</font>';
						echo " <a href=\"index.php?option=module_color/studentListByLevelColor&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
					?>
			ภาคเรียนที่   <?php 
						if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
						else {
							echo " <a href=\"index.php?option=module_color/studentListByLevelColor&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
						}
						if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
						else {
							echo " <a href=\"index.php?option=module_color/studentListByLevelColor&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
						}
				?>
		</font>
	  <form method="post">
	  <font color="#330033"   size="2">
	  	ระดับชั้น <select name="roomID" class="inputboxUpdate">
		  		<option value=""> </option>
				<option value="3/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/1"?"selected":""?>> มัธยมศึกษาปีที่ 1 </option>
				<option value="3/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/2"?"selected":""?>> มัธยมศึกษาปีที่ 2 </option>
				<option value="3/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/3"?"selected":""?>> มัธยมศึกษาปีที่ 3 </option>
				<option value="4/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/1"?"selected":""?>> มัธยมศึกษาปีที่ 4 </option>
				<option value="4/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/2"?"selected":""?>> มัธยมศึกษาปีที่ 5 </option>
				<option value="4/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/3"?"selected":""?>> มัธยมศึกษาปีที่ 6 </option>
			</select>
			
		คณะสี <select name="color" class="inputboxUpdate">
				<option value=""></option>
				<option value="ม่วง"  <?=isset($_POST['color'])&&$_POST['color']=="ม่วง"?"selected":""?>>ม่วง</option>
				<option value="เหลือง" <?=isset($_POST['color'])&&$_POST['color']=="เหลือง"?"selected":""?>>เหลือง</option>
				<option value="เขียว"  <?=isset($_POST['color'])&&$_POST['color']=="เขียว"?"selected":""?>>เขียว</option>
				<option value="ชมพู"  <?=isset($_POST['color'])&&$_POST['color']=="ชมพู"?"selected":""?>>ชมพู</option>
				<option value="ส้ม"   <?=isset($_POST['color'])&&$_POST['color']=="ส้ม"?"selected":""?>>ส้ม</option>
			 </select>
			 <input type="submit" name="submit" value="เรียกดู" class="button" /><br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
				เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			 </font>
	  </form>
	  </td>
	</tr>
</table><br/>
<? if(isset($_POST['submit']) && ($_POST['roomID'] == "" || $_POST['color'] == "")) { ?>
		<center><font color="#FF0000"><br/>กรุณาเลือก คณะสี และ ระดับชั้นที่ต้องการทราบข้อมูลก่อน</font></center>
<? } //end if ?>


<? if(isset($_POST['submit']) && $_POST['roomID'] !=  "" && $_POST['color'] != "") { ?>
		<? $_sql = "select id,prefix,firstname,lastname,nickname,xyearth,xlevel,room,studstatus from students 
						where xlevel = '" . substr($_POST['roomID'],0,1) . "' and xyearth = '" . substr($_POST['roomID'],2,1) ."' and color = '" . $_POST['color'] . "' " .($_POST['studstatus']=="1,2"?" and studstatus in (1,2) ":"") . "
							and xedbe = '" . $acadyear . "' order by sex,room,id"; ?>
		<?	$_result = mysql_query($_sql); ?>
		<? 	if($_result) { ?>
				<table class="admintable">
					<tr>
						<th align="center" colspan="6">
							<img src="../images/school_logo.gif" width="120px"><br/>
							รายชื่อนักเรียนคณะสี<?=$_POST['color']?><br/>
							ระดับชั้นมัธยมศึกษาปีที่ <?=displayRoom($_POST['roomID'])?><br/>
							ประจำภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?><br/>
						</th>
					</tr>
					<tr height="35px" > 
						<td class="key" width="40px" align="center">เลขที่</td>
						<td class="key" width="80px" align="center" >เลขประจำตัว</td>
						<td class="key" width="210px" align="center" >ชื่อ - นามสกุล</td>
						<td class="key" width="100px" align="center">ชื่อเล่น</td>
						<td class="key" align="center" width="70px">ห้อง</td>
						<td class="key" width="100px" align="center" >สถานภาพ<br/>ปัจจุบัน</td>
					</tr>
					<?	$_i = 1; ?>
					<?	while($_dat = mysql_fetch_assoc($_result)) { ?>
					<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
						<td align="center"><?=$_i++?></td>
						<td align="center"><?=$_dat['id']?></td>
						<td ><?=$_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname'] ?></td>
						<td align="center"><?=$_dat['nickname']==""?"-":$_dat['nickname']?>
						<td align="center"><?=(($_dat['xlevel']==4)?(($_dat['xyearth']+3)."/".$_dat['room']):($_dat['xyearth']."/".$_dat['room']))?></td>
						<td align="center"><?=displayStatus($_dat['studstatus'])?></td>
					</tr>
					<? } //end-while ?>
				</table>
			<? } else { ?> <center><font color="red"><br/>ไม่พบข้อมูลที่ต้องการตามเงื่อนไข</font></center> <? } ?>
	<?	} // end if ?>
		
</div>
<?php
	function displayStatus($id)
	{
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
	function displayRoom($_value) {
		switch ($_value){
			case "3/1": return "1" ; break;
			case "3/2": return "2" ; break;
			case "3/3": return "3" ; break;
			case "4/1": return "4" ; break;
			case "4/2": return "5" ; break;
			case "4/3": return "6" ; break;
			default : return "<<ทั้งโรงเรียน >>";
		}
	}
?>