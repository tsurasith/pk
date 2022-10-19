<?php
$_teacherCode = (isset($_REQUEST['teacher_code']))?$_REQUEST['teacher_code']:$_POST['teacher_code'];

$_target = $_SERVER["DOCUMENT_ROOT"] . "/pk/images/teacphoto/";
$_uploadError = 0;
if(isset($_POST['upload']))
{
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
			@unlink($_target . "TC" . $_teacherCode . ".jpg");
			move_uploaded_file($_FILES["file"]["tmp_name"], $_target . $_FILES["file"]["name"]);
			if($_FILES["file"]["name"] != ( "TC" . $_teacherCode . ".jpg"))
			{
				@rename($_target . $_FILES["file"]["name"] , $_target . "TC" . $_teacherCode . ".jpg");
				$_uploadError = 4; // upload Complete	
			}
		}
	}
	else
	{
		$_uploadError = 2; // error ที่เลือกไฟล์ไม่ถูกต้อง
	}
}

?>
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_config/index">
			<img src="../images/config.png" alt="" width="48" height="48" />
		</a>
	</td>
      <td><strong><font color="#990000" size="4">ปรับแต่งระบบ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1. จัดการบัญชีผู้ใช้งาน [บัญชีผู้ใช้งาน] &gt;&gt; แก้ไขรูปภาพ</strong></font></span></td>
      <td align="right">
	  	<input type="button" value="กลับ" onclick="location.href='index.php?option=module_config/userList'" />
	  </td>
    </tr>
  </table>
<form method="post" enctype="multipart/form-data" action=""> 
<table class="admintable" align="center" width="100%">
	<tr>
		<td class="key" colspan="2">รายการปรับแต่งรูปส่วนตัว</td>
	</tr>
			<tr>
				<td width="140" valign="top" align="right" class="key">รูปภาพ</td>
				<td class="key">
					<img src="../images/teacphoto/TC<?=$_teacherCode?>.jpg" width="150px" height="200" border="1"><br/>
					<br/>
					รูปภาพส่วนตัวที่อัพโหลดควรมีขนาด กว้าง 200 pixel สูง 266 pixel <br/>
					และมีรูปแบบไฟล์เป็น .jpg <br/>
					ขนาดไม่ควรเกิน 200 Kb<br/><br/>
						<input type="hidden" name="teacher_code" value="<?=$_teacherCode?>"/>
						<input type="file" name="file" size="40px" /><br/>
						<input type="submit" name="upload" value="อัพโหลดรูปภาพ"/>
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
					?>				</td>
			</tr>
</table>
</form>
<br/>
</div>
