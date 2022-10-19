<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
	<tr> 
	  <td width="6%" align="center" valign="top"><a href="index.php?option=module_color/index"><img src="../images/color.png" alt="กิจกรรมคณะสี" width="48" height="48" border="0"/></a></td>
	  <td valign="top"><strong><font color="#990000" size="4">กิจกรรมคณะสี</font></strong><br />
		<span class="normal"><font color="#0066FF"><strong>3.2.2 รายชื่อนักเรียนตามคณะสีตามระดับการศึกษา</strong></font></span></td>
	  <td align="right">
		<?php
				if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
				if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
			?>
			ปีการศึกษา<?php  
						echo "<a href=\"index.php?option=module_color/studentImageColor&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
						echo '<font color=\'blue\'>' .$acadyear . '</font>';
						echo " <a href=\"index.php?option=module_color/studentImageColor&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
					?>
			ภาคเรียนที่   <?php 
						if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
						else {
							echo " <a href=\"index.php?option=module_color/studentImageColor&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
						}
						if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
						else {
							echo " <a href=\"index.php?option=module_color/studentImageColor&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
						}
				?>
		</font>
	  <form method="post">
	  <font color="#330033"   size="2">
	  	คณะสี <select name="color" class="inputboxUpdate">
				<option value=""></option>
				<option value="ม่วง"  <?=isset($_POST['color'])&&$_POST['color']=="ม่วง"?"selected":""?>>ม่วง</option>
				<option value="เหลือง" <?=isset($_POST['color'])&&$_POST['color']=="เหลือง"?"selected":""?>>เหลือง</option>
				<option value="เขียว"  <?=isset($_POST['color'])&&$_POST['color']=="เขียว"?"selected":""?>>เขียว</option>
				<option value="ชมพู"  <?=isset($_POST['color'])&&$_POST['color']=="ชมพู"?"selected":""?>>ชมพู</option>
				<option value="ส้ม"   <?=isset($_POST['color'])&&$_POST['color']=="ส้ม"?"selected":""?>>ส้ม</option>
			 </select>
		 เพศ
			<select name="sex" class="inputboxUpdate">
				<option value=""></option>
				<option value="1" <?=isset($_POST['search'])&&$_POST['sex']==1?"selected":""?>>ชาย</option>
				<option value="2" <?=isset($_POST['search'])&&$_POST['sex']==2?"selected":""?>>หญิง</option>
				<option value="3" <?=isset($_POST['search'])&&$_POST['sex']=="3"?"selected":""?>>ทั้งหมด</option>
			</select>
			 <input type="submit" name="search" value="เรียกดู" class="button" /><br/>
		ระดับชั้น 	 
			 <input type="radio" name="level" value="3" <?=$_POST['level']!=4?"checked":""?> /> ม.ต้น |
			 <input type="radio" name="level" value="4" <?=$_POST['level']==4?"checked":""?> /> ม.ปลาย<br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
				เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			 </font>
	  </form>
	  </td>
	</tr>
</table><br/>

<? if(isset($_POST['search']) && ( $_POST['level'] == "" || $_POST['sex'] == "" || $_POST['color']=="")) { ?>
  		<br/><center><font color="#FF0000">กรุณาเลือก ระดับชั้น เพศ และ คณะสี ที่ต้องการดูทำเนียบก่อน</font></center>
<? } //?>
  
<? if(isset($_POST['search']) && $_POST['level'] != "" && $_POST['sex'] != "" && $_POST['color'] != "") { ?>
	<?php
		$sqlStudent = "select id,prefix,firstname,lastname,sex,nickname,xlevel,xyearth,room
						from students 
						where xedbe = '" . $acadyear . "' and color = '" . $_POST['color'] . "' ";
		if($_POST['roomID'] != "all") $sqlStudent .= "and xlevel = '". $_POST['level'] . "' ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		if($_POST['sex']!="3") $sqlStudent .= " and sex = '" . $_POST['sex'] . "' ";
		$sqlStudent .= " order by sex,xlevel,xyearth,room,id ";
		$resStudent = mysql_query($sqlStudent);
		$ordinal = 1;
		$totalRows = mysql_num_rows($resStudent); ?>
<? if($totalRows > 0) { ?>		
  <table class="admintable" >
    <tr> 
      <th colspan="5" align="center">
	  	<img src="../images/school_logo.gif" width="120px"><br/>
	  	ทำเนียบนักเรียนคณะสี<?=$_POST['color']?><br/>
		นักเรียนระดับชั้นมัธยมศึกษาตอน<?=$_POST['level']==3?"ต้น":"ปลาย"?>
	</th>
    </tr>
<?
		$_cols = 5;
		for($i = 0; $i < $totalRows/5 ; $i++)
		{
			echo "<tr height='205px'>";
			for($_j = 0 ; $_j < 5 ; $_j++)
			{
				if($ordinal > $totalRows) continue;
				$dat = mysql_fetch_array($resStudent);
				echo "<td align='center' width='160px'>";
				echo "<font color='red'><b>$ordinal</b></font>";
				if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/pk/images/studphoto/id" . $dat['id'] . ".jpg"))
					{ echo "<img src='../images/studphoto/id" . $dat['id'] . ".jpg' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/><br/>"; }
				else 
					{echo "<img src='../images/" . ($dat['sex']==1?"_unknown_male":"_unknown_female") . ".png' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/><br/>"; }
				echo ($dat['xlevel']==3?$dat['xyearth']:$dat['xyearth']+3)."/".$dat['room']. "-";
				echo "" . $dat['id'] . "- [". displayPoint($dat['nickname']) . "]<br/>" ;
				echo "" . displayPrefix($dat['prefix']) . $dat['firstname'] . " " . $dat['lastname'] . "<br/>";
				echo "</td>";
				$ordinal++;
			}
			echo "</tr>";
		} ?>
		</table>
	<? } else { echo "<br/><br/><center><font color='red'>ยังไม่มีข้อมูลในรายการที่ท่านเลือก</font></center>";} ?>
<? } //end else-if ?>
  
</div>
<?php
	function displayPoint($_value) {
		if($_value == 100) { return "<font color='blue' size='4'>" . $_value . "</font>"; }
		else if($_value >=80) { return "<font color='green' size='4'>" . $_value . "</font>"; }
		else if ($_value >=60) { return "<font color='orange' size='4'>" . $_value . "</font>"; }
		else { return "<font color='red' size='4'>" . $_value . "</font>"; }
	}
	function displayStatus($id)
	{
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
	function displayPrefix($_value)
	{
		if($_value == "เด็กชาย") { return "ด.ช."; }
		else if ($_value == "เด็กหญิง") { return "ด.ญ."; }
		else if ($_value == "นางสาว") { return "น.ส."; }
		else { return $_value; }
	}
?>