﻿<?php
$_acadyear;
$_studentID;
$_roomID;

$_target = $_SERVER["DOCUMENT_ROOT"] . "/pk/images/studphoto/";
$_uploadError = 0;
if(isset($_POST['upload']))
{
	$_acadyear = $_POST['acadyear'];
	$_studentID = $_POST['student_id'];
	$_roomID = $_POST['roomID'];
	
	if ((($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg")))
	{
		if ($_FILES["file"]["error"] > 0)
		{
			$_uploadError = 1; //error ที่การ upload
		}
		else if ($_FILES["file"]["size"] > 210000)
		{
			$_uploadError = 3; //error ที่ขนาดไฟล์ใหญ่กว่าที่กำหนด 200Kb
		}
		else
		{
			@unlink($_target . "id" . $_studentID . ".jpg");
			move_uploaded_file($_FILES["file"]["tmp_name"], $_target . $_FILES["file"]["name"]);
			if($_FILES["file"]["name"] != ( "id" . $_studentID . ".jpg"))
			{
				@rename($_target . $_FILES["file"]["name"] , $_target . "id" . $_studentID . ".jpg");
				$_uploadError = 4; // upload Complete	
			}
		}
	}
	else
	{
		$_uploadError = 2; // error ที่เลือกไฟล์ไม่ถูกต้อง
	}
}// --- end upload file
else
{
	$_acadyear = $_REQUEST['acadyear'];
	$_studentID = $_REQUEST['student_id'];
	$_roomID = $_REQUEST['roomID'];
}
?>

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.6 รายการแสดงทำเนียบรูปภาพ &gt;&gt; แก้ไขรูปภาพนักเรียน</strong></font></span></td>
	</tr>
</table>
<?php
	$_sql = "select id,prefix,firstname,sex,lastname,nickname,p_village from students where id ='" . $_studentID . "' and xedbe = '" . $_acadyear . "'";
	$_result = mysql_query($_sql);
	$_dat = mysql_fetch_assoc($_result);
?>
<br/>

  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%">
    <tr> 
      	<td class="key" colspan="2">แก้ไขข้อมูลรูปภาพนักเรียน</td>
		<td align="center" class="key">
			<form method="post" action="index.php?option=module_history/studentListPics">
				<input type="hidden" name="roomID" value="<?=$_roomID?>" />
				<input type="submit" value="เสร็จสิ้น"  name="search"/>
			</form>
		</td>
    </tr>
    <tr>
      <td align="right" width="20%" >ชื่อ - สกุล :</td>
	  <td width="60%"><b><?=$_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname']?></b></td>
	  <td valign="top" rowspan="4" width="20%" align="center">
		<?
			if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/pk/images/studphoto/id" . $_dat['id'] . ".jpg"))
				{ echo "<img src='../images/studphoto/id" . $_dat['id'] . ".jpg' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/><br/>"; }
			else 
				{echo "<img src='../images/" . ($_dat['sex']==1?"_unknown_male":"_unknown_female") . ".png' width='120px' height='160px' alt='รูปถ่ายนักเรียน' style='border:1px solid #CC0CC0'/><br/>"; }
		?>
	  </td>
    </tr>
    <tr>
      <td align="right">ชื่อเล่น :</td>
      <td><b><?=$_dat['nickname']?></b></td>
    </tr>
    <tr>
      <td align="right">หมู่บ้าน :</td>
      <td><b><?=$_dat['p_village']?></b></td>
    </tr>
    <tr>
      <td align="right" valign="top">เลือกรูปภาพ :</td>
      <td valign="top">รูปภาพนักเรียนที่อัพโหลดควรมีขนาด กว้าง 200 pixel สูง 266 pixel <br/>
					และมีรูปแบบไฟล์เป็น .jpg <br/>
					ขนาดไม่ควรเกิน 200 Kb<br/><br/>
			<form method="post" enctype="multipart/form-data" action=""> 
				<input type="hidden" name="student_id" value="<?=$_studentID?>" />
				<input type="hidden" name="roomID" value="<?=$_roomID?>" />
				<input type="hidden" name="acadyear" value="<?=$_acadyear?>"/>
				<input type="file" name="file" size="60px"/><br/>
				<input type="submit" name="upload" value="อัพโหลดรูปภาพ"/>
			</form> 
			<?php
				if(isset($_POST['upload']) && $_uploadError != 0)
				{
					echo "<br/>";
					switch ($_uploadError)
					{
						case 1; echo "<font color='red'><b>การเชื่อมต่อเครือข่ายผิดพลาด กรุณาตรวจสอบอีกครั้ง</b></font>"; break;
						case 2; echo "<font color='red'><b>รูปแบบหรือนามสกุลไฟล์ที่อัพโหลดไม่ถูกต้อง</b></font>"; break;
						case 3; echo "<font color='red'><b>ขนาดไฟล์ใหญ่เกินไปและไฟล์ที่เลือกขนาดไม่ควรเกิน 200Kb </b>
															<br/>(ไฟล์ทีี่ Upload มีขนาด :" . number_format(($_FILES["file"]["size"]/1024),2,'.','') . "Kb)</font>"; break;
						case 4; echo "<font color='blue'><b>ทำการส่งรูปภาพเรียบร้อย</b></font>"; break;
						default : "ไม่ทราบสาเหตุ";
					}
				}
			?>
		</td>
    </tr>
</table> 
</div>

