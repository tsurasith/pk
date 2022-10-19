<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.6.3 ทำเนียบนักเรียนตามชั้นม.ต้น<br/>และม.ปลาย</strong></font></span></td>
      <td >
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_history/studentListPicsSchool&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/studentListPicsSchool&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_history/studentListPicsSchool&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_history/studentListPicsSchool&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<br/><font color="#000000" size="2" >
	  		เลือกระดับชั้น
			<select name="roomID" class="inputboxUpdate">
		  		<option value=""></option>
				<option value="3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3"?"selected":""?>>มัธยมศึกษาตอนต้น</option>
				<option value="4" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4"?"selected":""?>>มัธยมศึกษาตอนปลาย</option>
				<option value="5" <?=isset($_POST['roomID'])&&$_POST['roomID']=="5"?"selected":""?>> ทั้งโรงเรียน </option>
			</select> 
			เพศ
			<select name="sex" class="inputboxUpdate">
				<option value=""></option>
				<option value="1" <?=isset($_POST['search'])&&$_POST['sex']==1?"selected":""?>>ชาย</option>
				<option value="2" <?=isset($_POST['search'])&&$_POST['sex']==2?"selected":""?>>หญิง</option>
				<option value="3" <?=isset($_POST['search'])&&$_POST['sex']==3?"selected":""?>>ทั้งหมด</option>
			</select>
	  		<input type="submit" value="สืบค้น" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา</font>
	   </td>
    </tr>
  </table>
  </form>
  
<? if(isset($_POST['search']) && ( $_POST['roomID'] == "" || $_POST['sex'] == "")) { ?>
  		<br/><center><font color="#FF0000">กรุณาเลือก ระดับการศึกษา และ เพศ ที่ต้องการดูทำเนียบก่อน</font></center>
<? } //?>
  
<? if(isset($_POST['search']) && $_POST['roomID'] != "" && $_POST['sex'] != "") { ?>
	<?php
		$sqlStudent = "select id,prefix,firstname,lastname,sex,nickname,p_village,studstatus,points
						from students 
						where xedbe = '" . $acadyear . "' ";
		if($_POST['roomID'] != "5") $sqlStudent .= "and xlevel = '". $_POST['roomID'] . "' ";
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
	  	ทำเนียบนักเรียน <?=($_POST['roomID']>3?($_POST['roomID']==4?"มัธยมศึกษาตอนปลาย":"ทั้งโรงเรียน"):("มัธยมศึกษาตอนต้น"))?>
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

