<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
	<tr> 
	  <td width="6%" valign="top" align="center"><a href="index.php?option=module_color/index"><img src="../images/color.png" alt="กิจกรรมคณะสี" width="48" height="48" border="0"/></a></td>
	  <td valign="top"><strong><font color="#990000" size="4">กิจกรรมคณะสี</font></strong><br />
		<span class="normal"><font color="#0066FF"><strong>3.3.5 สรุปรายชื่อนักเรียนตาม<br/>การเข้าร่วมกิจกรรมคณะสี(รายภาคเรียน)</strong></font></span></td>
	  <td align="right">
		<?php
				if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
				if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
			?>
			ปีการศึกษา<?php  
						echo "<a href=\"index.php?option=module_color/reportColorNameAcadyear&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
						echo '<font color=\'blue\'>' .$acadyear . '</font>';
						echo " <a href=\"index.php?option=module_color/reportColorNameAcadyear&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
					?>
			ภาคเรียนที่   <?php 
						if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
						else {
							echo " <a href=\"index.php?option=module_color/reportColorNameAcadyear&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
						}
						if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
						else {
							echo " <a href=\"index.php?option=module_color/reportColorNameAcadyear&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
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
				<option value="all" <?=isset($_POST['roomID'])&&$_POST['roomID']=="all"?"selected":""?>> รวมทั้งหมด </option>
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
		<center><font color="#FF0000"><br/>
	    กรุณาเลือก ระดับชั้น  และ คณะสี ที่ต้องการทราบข้อมูลก่อน</font>
		</center>
<? } //end if ?>


<? if(isset($_POST['submit']) && $_POST['roomID'] !=  "" && $_POST['color'] != "") { ?>
		<? $_sql = "select id,prefix,firstname,lastname,xlevel,xyearth,room,a.color,
							sum(if(timecheck_id='00',1,null)) as 'a',
							  sum(if(timecheck_id='01',1,null)) as 'b',
							  sum(if(timecheck_id='02',1,null)) as 'c',
							  sum(if(timecheck_id='03',1,null)) as 'd',
							  sum(if(timecheck_id='04',1,null)) as 'e',
							  count(a.id) as 'total'
						from students a left outer join student_color b on a.id = b.student_id
						where a.color = '" . $_POST['color'] . "' " . ($_POST['studstatus']=="1,2"?"and studstatus in (1,2)":"") ; ?>
		<? if($_POST['roomID']!="all") $_sql .= "and xlevel = '" .substr($_POST['roomID'],0,1)."' and xyearth ='" .substr($_POST['roomID'],2,1)."' "; ?>
		<? $_sql .= " and xedbe = '" .$acadyear . "' and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
					  group by a.id order by xlevel,xyearth,a.color,room,sex,id"; ?>
		<?	$_result = mysql_query($_sql); ?>
		<? 	if(mysql_num_rows($_result)>0) { ?>
				<table class="admintable" width="100%">
					<tr>
						<th align="center" colspan="6">
							<img src="../images/school_logo.gif" width="120px"><br/>
							รายงานการเข้าร่วมกิจกรรมคณะสี
							<?=$_POST['roomID']!="all"?"<br/>ระดับชั้นมัธยมศึกษาปีที่":""?> <?=displayRoom($_POST['roomID'])?><br/>
							วันที่ <?=displayDate($_POST['date'])?>
							ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?><br/>
						</th>
					</tr>
					<tr>
						<td align="center">
							<table class="admintable" align="center">
								<tr align="center" height="30px">
									<td class="key" width="35px" rowspan="2">ที่</td>
									<td class="key" width="70px" rowspan="2">เลขประจำตัว</td>
									<td class="key" width="190px" rowspan="2">ชื่อ-สกุล</td>
									<td class="key" width="35px" rowspan="2">ห้อง</td>
									<td class="key" width="50px" rowspan="2">คณะสี</td>
									<td class="key" colspan="5">การเข้าร่วมคณะสี</td>
									<td class="key" width="70px" rowspan="2">รวม</td>
								</tr>
								<tr align="center">
									<td class="key" width="50px">มา</td>
									<td class="key" width="50px">กิจกรรม</td>
									<td class="key" width="50px">สาย</td>
									<td class="key" width="50px">ลา</td>
									<td class="key" width="50px">ขาด</td>
								</tr>
								<? $_i=1;?>
								<? while($_dat = mysql_fetch_assoc($_result)){ ?>
									<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
										<td align="center"><?=$_i++?></td>
										<td align="center"><?=$_dat['id']?></td>
										<td align="left"><?=$_dat['prefix'].$_dat['firstname']." ".$_dat['lastname']?></td>
										<td align="center"><?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?>/<?=$_dat['room']?></td>
										<td align="left"><?=$_dat['color']?></td>
										<td align="right" style="padding-right:5px;"><?=$_dat['a']!=""?number_format($_dat['a'],0,'',','):"-"?></td>
										<td align="right" style="padding-right:5px;"><?=$_dat['b']!=""?number_format($_dat['b'],0,'',','):"-"?></td>
										<td align="right" style="padding-right:5px;"><?=$_dat['c']!=""?number_format($_dat['c'],0,'',','):"-"?></td>
										<td align="right" style="padding-right:5px;"><?=$_dat['d']!=""?number_format($_dat['d'],0,'',','):"-"?></td>
										<td align="right" style="padding-right:5px;"><?=$_dat['e']!=""?number_format($_dat['e'],0,'',','):"-"?></td>
										<td align="right" style="padding-right:15px;"><?=$_dat['total']!=""?number_format($_dat['total'],0,'',','):"-"?></td>
									</tr>
								<? } //end while ?>
							</table>
						</td>
					</tr>
				</table>
			<? } else { ?> <center><font color="red"><br/>ไม่พบข้อมูลที่ต้องการตามเงื่อนไข</font></center> <? } ?>
	<?	} // end if ?>
		
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
	function displayRoom($_value) {
		switch ($_value){
			case "3/1": return "1" ; break;
			case "3/2": return "2" ; break;
			case "3/3": return "3" ; break;
			case "4/1": return "4" ; break;
			case "4/2": return "5" ; break;
			case "4/3": return "6" ; break;
			default : return "";
		}
	}
	function displayTimecheckID($id){
		switch ($id) {
			case "00" :  return "มา"; break;
			case "01" :  return "<font color='#66CC33'><b>กิจกรรม</b></font>"; break;
			case "02" :  return "<font color='#FFCC00'><b>สาย</b></font>"; break;
			case "03" :  return "<font color='blue'><b>ลา</b></font>"; break;
			case "04" :  return "<font color='red'><b>ขาด</b></font>"; break;
		}	
	}
	function displayDate($date) {
		$txt = "" ;
		$_x = explode('-',$date,3);
		switch ($_x[1]) {
			case "01" : $txt = $txt . number_format($_x[2],0,'.','') . "  มกราคม   " . ($_x[0] + 543) ;break;
			case "02" : $txt = $txt . number_format($_x[2],0,'.','') . "  กุมภาพันธ์   " . ($_x[0] + 543) ;break;
			case "03" : $txt = $txt . number_format($_x[2],0,'.','') . "  มีนาคม   " . ($_x[0] + 543) ;break;
			case "04" : $txt = $txt . number_format($_x[2],0,'.','') . "  เมษายน   " . ($_x[0] + 543) ;break;
			case "05" : $txt = $txt . number_format($_x[2],0,'.','') . "  พฤษภาคม   " . ($_x[0] + 543) ;break;
			case "06" : $txt = $txt . number_format($_x[2],0,'.','') . "  มิถุุนายน   " . ($_x[0] + 543) ;break;
			case "07" : $txt = $txt . number_format($_x[2],0,'.','') . "  กรกฎาคม   " . ($_x[0] + 543) ;break;
			case "08" : $txt = $txt . number_format($_x[2],0,'.','') . "  สิงหาคม   " . ($_x[0] + 543) ;break;
			case "09" : $txt = $txt . number_format($_x[2],0,'.','') . "  กันยายน   " . ($_x[0] + 543) ;break;
			case "10" : $txt = $txt . number_format($_x[2],0,'.','') . "  ตุลาคม   " . ($_x[0] + 543) ;break;
			case "11" : $txt = $txt . number_format($_x[2],0,'.','') . "  พฤศจิกายน   " . ($_x[0] + 543) ;break;
			case "12" : $txt = $txt . number_format($_x[2],0,'.','') . "  ธันวาคม   " . ($_x[0] + 543) ;break;
			default : $txt = $txt . "ผิดพลาด";
		}
		return $txt ;
	}
?>