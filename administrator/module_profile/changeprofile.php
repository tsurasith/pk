<?php
	if(!isset($_SESSION['pk-logined']) && $_SESSION['pk-type'] != 'admin') {
		?><meta http-equiv="refresh" content="0;url=../../index.php"><?
	} else
	{
?>
<SCRIPT language="javascript" type="text/javascript">
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
   </SCRIPT>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<div id="content">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="10" class="header">
  <tr>
    <td width="6%" align="center">
		<a href="index.php?option=module_profile/index">
			<img src="../images/profile.png" alt="" height="48" />
		</a>
	</td>
    <td >Profile - ข้อมูลส่วนตัว<br />
		<span class="normal">แก้ไขข้อมูลส่วนตัว</span>
	</td>
    <td width="100px">&nbsp;</td>
  </tr>
</table>

<?php
	
	$_messageStatus = "";
	if(isset($_POST['submit']))
	{
		if($_POST['prefix'] == "")
		{
			$_messageStatus = "<font color='red'>กรุณาป้อนคำนำหน้าก่อน</font>";
		}
		else if($_POST['firstname'] == "")
		{
			$_messageStatus = "<font color='red'>กรุณาป้อนชื่อก่อน</font>";
		}
		else if($_POST['lastname'] == "")
		{
			$_messageStatus = "<font color='red'>กรุณาป้อนนามสกุลก่อน</font>";
		}
		else if($_POST['nickname'] == "")
		{
			$_messageStatus = "<font color='red'>กรุณาป้อนชื่อเล่นก่อน</font>";
		}
		else if($_POST['t_mobile'] == "")
		{
			$_messageStatus = "<font color='red'>กรุณาป้อนหมายเลขมือถือก่อน</font>";
		}
		else if($_POST['t_email'] == "")
		{
			$_messageStatus = "<font color='red'>กรุณาป้อนอีเมลก่อน</font>";
		}
		else
		{
			$_sqlUpdate = "update teachers set PREFIX = '" . $_POST['prefix'] . "',
											   FIRSTNAME = '" . $_POST['firstname'] . "',
											   LASTNAME = '" . $_POST['lastname'] . "',
											   NICKNAME = '" .$_POST['nickname'] . "',
											   POSITION = '" . $_POST['position'] . "',
											   T_PHONE = '" . $_POST['t_phone'] . "',
											   t_mobile = '" . $_POST['t_mobile'] . "',
											   t_email = '" . $_POST['t_email'] . "'
							where username = '" . $_SESSION['username'] . "'";
			if(mysql_query($_sqlUpdate))
			{
				$_messageStatus = "<font color='green'>แก้ไขข้อมูลส่วนตัวเรียบร้อยแล้ว</font>";
			}
			else
			{
				$_messageStatus = "<font color='red'>ผิดพลาดทางเทคนิค กรุณาติดต่อผู้ดูแลระบบ</font>";
			}
		}
	}
	$_res = mysql_query("select * from teachers where username = '" . $_SESSION['username'] . "'");
	$_dat = mysql_fetch_assoc($_res);
?>

<form id="form1" method="post" action="">
<table width="100%" align="center" cellspacing="1" class="admintable">
  <tr>
    <td colspan="2" class="key">&nbsp;</td>
  </tr>
  <tr>
    <td width="36%" align="right">คำนำหน้า :</td>
    <td width="64%"><input type="text" name="prefix" class="inputbox" value="<?=$_dat['PREFIX']?>"/> 
      <span class="style1">*</span> </td>
  </tr>
  <tr>
    <td width="36%" align="right">ชื่อ :</td>
    <td width="64%">
      <p>
        <input name="firstname" type="text" class="inputbox" value="<?=$_dat['FIRSTNAME']?>" />
        <span class="style1">*</span></p>    </td>
  </tr>
  <tr>
    <td align="right">นามสกุล :</td>
    <td><input name="lastname" type="text" class="inputbox" value="<?=$_dat['LASTNAME']?>" />
      <span class="style1">*</span></td>
  </tr>
  <tr>
    <td align="right">ชื่อเ่ล่น :</td>
    <td><input name="nickname" type="text" class="inputbox" value="<?=$_dat['NICKNAME']?>" />
      <span class="style1">*</span></td>
  </tr>
  <tr>
    <td align="right">ตำแหน่งปัจจุบัน :</td>
    <td><input name="position" type="text" class="inputbox" value="<?=$_dat['POSITION']?>" /></td>
  </tr>
  <tr>
    <td align="right">หมายเลขโทรศัพท์ :</td>
    <td><input name="t_phone" type="text" class="inputbox" value="<?=$_dat['T_PHONE']?>" maxlength="9" onkeypress="return isNumberKey(event)" />
		ตัวอย่าง 044846117</td>
  </tr>
  <tr>
    <td align="right">หมายเลขมือถือ :</td>
    <td><input name="t_mobile" type="text" class="inputbox" value="<?=$_dat['t_mobile']?>" maxlength="10" onkeypress="return isNumberKey(event)"/>
      ตัวอย่าง 0813567531 <span class="style1">*</span></td>
  </tr>
  <tr>
    <td align="right">อีเมล :</td>
    <td><input name="t_email" type="text" class="inputbox" value="<?=$_dat['t_email']?>" />
      <span class="style1">*</span></td>
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
