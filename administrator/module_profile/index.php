
<div id="content">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="10" class="header">
  <tr>
    <td width="6%" align="center"><img src="../images/profile.png" alt="" height="48" /></td>
    <td >Profile - ข้อมูลส่วนตัว<br />
	<span class="normal"> 
			<b>[<a href="index.php?option=module_profile/changeprofile">แก้ไขข้อมูลส่วนตัว</a>]</b> |
			<b>[<a href="index.php?option=module_profile/changepassword">เปลี่ยนรหัสผ่าน</a>]</b></span></td>
    <td width="100px">&nbsp;</td>
  </tr>
</table>
<?php
	$_res = mysql_query("select * from teachers where username = '" . $_SESSION['username'] . "'");
	$_dat = mysql_fetch_assoc($_res);
?>
<table width="100%" align="center" cellspacing="1" class="admintable">
	<tr>
		<td colspan="3" class="key">&nbsp; -:- ข้อมูลส่วนตัว -:-</td>
	</tr>
	<tr>
		<td rowspan="12" width="160px" valign="top" align="center" class="key"><br/>
			<img src="../images/teacphoto/TC<?=$_dat['TeacCode']?>.jpg" width="140px" height="190px" alt="รูปภาพที่ใช้ในระบบ" />
			<br/>
			<a href="index.php?option=module_profile/AdminEditPic&teacher_code=<?=$_dat['TeacCode']?>">เปลี่ยนรูปภาพ</a>
		</td>
		<td width="120px" align="right">TeacherCode : </td>
		<td><b><?=$_dat['TeacCode']?></b></td>
	</tr>
	<tr>
	  <td align="right">ชื่อ-สกุล : </td>
	  <td><b><?=$_dat['PREFIX'] . $_dat['FIRSTNAME'] . ' ' . $_dat['LASTNAME'] ?></b></td>
    </tr>
	<tr>
	  <td align="right">ชื่อเล่น : </td>
	  <td><b><?=$_dat['NICKNAME']?></b></td>
    </tr>
	<tr>
	  <td align="right">ตำแหน่ง : </td>
	  <td><b><?=$_dat['POSITION']?></b></td>
    </tr>
	<tr>
	  <td align="right">โทรศัพท์ :</td>
	  <td><b><?=$_dat['T_PHONE']?></b></td>
    </tr>
	<tr>
	  <td align="right">มือถือ : </td>
	  <td><b><?=$_dat['t_mobile']?></b></td>
    </tr>
	<tr>
	  <td align="right">อีเมล : </td>
	  <td><b><?=$_dat['t_email']?></b></td>
    </tr>
	<tr>
	  <td align="right">&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td align="right">&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
</table>
</div>

