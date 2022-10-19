<?php
	if(!isset($_SESSION['pk-logined']) && $_SESSION['pk-type'] != 'admin') {
		?><meta http-equiv="refresh" content="0;url=../../index.php"><?
	} else
	{
?>

<div id="content">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="10" class="header">
  <tr>
    <td width="6%" align="center">
		<a href="index.php?option=module_profile/index">
			<img src="../images/profile.png" alt="" height="48" />
		</a>
	</td>
    <td >Profile - ข้อมูลส่วนตัว<br />
		<span class="normal">เปลี่ยนรหัสผ่าน</span>
	</td>
    <td width="100px">&nbsp;</td>
  </tr>
</table>

<?php
	$_res = mysql_query("select * from teachers where username = '" . $_SESSION['username'] . "'");
	$_dat = mysql_fetch_assoc($_res);
	$_messageStatus = "";
	if(isset($_POST['submit']))
	{
		if($_POST['pass1'] == "")
		{
			$_messageStatus = "<font color='red'>กรุณาป้อนรหัสผ่านเดิมก่อน</font>";
		}
		else if($_POST['pass1'] != $_dat['password'])
		{
			$_messageStatus = "<font color='red'>รหัสผ่านเดิมไม่ถูกต้องกรุณาลองใหม่อีกครั้ง</font>";
		}
		else if($_POST['pass2'] == "")
		{
			$_messageStatus = "<font color='red'>กรุณาป้อนรหัสผ่านใหม่</font>";
		}
		else if($_POST['pass3'] == "" || $_POST['pass2'] != $_POST['pass3'])
		{
			$_messageStatus = "<font color='red'>การยืนยันรหัสผ่านใหม่ไม่ถูกต้อง</font>";
		}
		else
		{
			$_sqlUpdate = "update teachers set password = '" . $_POST['pass2'] . "' where username = '" . $_SESSION['username'] . "'";
			if(mysql_query($_sqlUpdate))
			{
				$_messageStatus = "<font color='green'>แก้ไขรหัสผ่านเรียบร้อยแล้ว</font>";
			}
			else
			{
				$_messageStatus = "<font color='red'>ผิดพลาดทางเทคนิค กรุณาติดต่อผู้ดูแลระบบ</font>";
			}
		}
	}
?>

<form id="form1" method="post" action="">
<table width="100%" align="center" cellspacing="1" class="admintable">
  <tr>
    <td colspan="2" class="key">&nbsp;</td>
  </tr>
  <tr>
    <td width="36%" align="right">ชื่อเข้าใช้งาน :</td>
    <td width="64%"><?=$_SESSION['username']?></td>
  </tr>
  <tr>
    <td width="36%" align="right">รหัสผ่านเดิม :</td>
    <td width="64%">
      <p>
        <input name="pass1" type="password" class="inputbox" id="pass1" />
      </p>    </td>
  </tr>
  <tr>
    <td align="right">รหัสผ่านใหม่ :</td>
    <td><input name="pass2" type="password" class="inputbox" id="pass2" /></td>
  </tr>
  <tr>
    <td align="right">ยืนยันรหัสผ่านใหม่ :</td>
    <td><input name="pass3" type="password" class="inputbox" id="pass3" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?=$_messageStatus?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="submit" type="submit" class="button" id="submit" value="บันทึก" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
  </form>

</div>

<?php
	} // end-else
?>
