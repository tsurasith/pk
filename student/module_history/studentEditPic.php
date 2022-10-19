<?php
$_target = $_SERVER["DOCUMENT_ROOT"] . "/pk/images/studphoto/";
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
			@unlink($_target . "id" . $_SESSION['username'] . ".jpg");
			move_uploaded_file($_FILES["file"]["tmp_name"], $_target . $_FILES["file"]["name"]);
			if($_FILES["file"]["name"] != ( "id" . $_SESSION['username'] . ".jpg"))
			{
				@rename($_target . $_FILES["file"]["name"] , $_target . "id" . $_SESSION['username'] . ".jpg");
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
	  	<a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0"/></a></td>
      <td width="94%"><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>ระบบบริหารจัดการ/สืบค้นประวัตินักเรียน</strong></font></span></td>
      <td width="94%">&nbsp;</td>
    </tr>
  </table>
<form method="post" enctype="multipart/form-data" action=""> 
<table class="admintable" align="center" width="100%">
	<tr>
		<td class="key" colspan="2">รายการปรับแต่งรูปถ่ายนักเรียน</td>
	</tr>
			<tr>
				<td width="140" valign="top" align="right" class="key">รูปภาพ</td>
				<td class="key">
					<img src="../images/studphoto/id<?=$_SESSION['username']?>.jpg" width="160px" height="200"><br/>
					<br/>
					รูปภาพนักเรียนที่อัพโหลดควรมีขนาด กว้าง 200 pixel สูง 266 pixel <br/>
					และมีรูปแบบไฟล์เป็น .jpg <br/>
					ขนาดไม่ควรเกิน 200 Kb<br/><br/>
						<input type="file" name="file" size="60px"/><br/>
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
