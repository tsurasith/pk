<script language="javascript">
	function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</script>
<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_config/index">
			<img src="../images/config.png" alt="" width="48" height="48" />
		</a>
	</td>
      <td><strong><font color="#990000" size="4">ปรับแต่งระบบ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>
			1.1 แก้ไขบัญชีข้อมูลผู้ใช้งาน
			[<a href="index.php?option=module_config/userList">บัญชีผู้ใช้งาน</a>]
		</strong></font></span></td>
      <td align="right">
	  	<form method="post">
			<font   size="2" color="#000000">
			รหัสผู้ใช้ เช่น 501,704 
			<input type="text" name="teaccode" size="4" maxlength="3" value="<?=isset($_POST['teaccode'])?$_POST['teaccode']:$_REQUEST['teaccode']?>" onKeyPress="return isNumberKey(event)" id="teaccode" class="inputboxUpdate"/>
			<input type="submit" value="เรียกดู" name="search" class="button" />
			</font>
		</form>
	  </td>
    </tr>
  </table>
  


  <? if(isset($_POST['search']) && $_POST['teaccode'] == "") { ?>
  		<center><br /><font color="#FF0000">กรุณาป้อนรหัสบัญชีผู้ใช้ก่อน !</font></center>
  <? }//end if ?>

<?
	if(isset($_POST['save'])){ 
		$_sqlUpdate = "update teachers set PREFIX = '" . $_POST['prefix'] . "',
								   FIRSTNAME = '" . $_POST['firstname'] . "',
								   LASTNAME = '" . $_POST['lastname'] . "',
								   NICKNAME = '" .$_POST['nickname'] . "',
								   POSITION = '" . $_POST['position'] . "',
								   T_PHONE = '" . $_POST['t_phone'] . "',
								   t_mobile = '" . $_POST['t_mobile'] . "',
								   t_email = '" . $_POST['t_email'] . "',
								   type = '" . $_POST['type'] . "',
								   superuser = '" . ($_POST['superuser']==1?"1":"0") . "'
							where TeacCode = '" . $_POST['teaccode'] . "'";
		if(mysql_query($_sqlUpdate))
		{
			echo "<center><br/><font color='green'><b>บันทึกแก้ไขข้อมูลเรียบร้อยแล้ว</b></font><br/></center><br/>";
		}else 
		{
			echo "<center><br/><font color='red'>บันทึกข้อมูลผิดพลาด เนื่องจาก - " . mysql_error() . "</font><br/></center>";
		}
	}//end บันทึกแก้ไขข้อมูล
?>
  
  
  <? if((isset($_POST['search']) && $_POST['teaccode'] != "") || (isset($_REQUEST['teaccode']) && $_REQUEST['teaccode']!="")) { ?>
  		<? $_sql = "select * from teachers where TeacCode = '" . (isset($_REQUEST['teaccode'])?$_REQUEST['teaccode']:$_POST['teaccode']) . "'" ?>
		<? $_res = mysql_query($_sql); ?>
		<? if(mysql_num_rows($_res)>0){ ?>
			<form method="post">
			<table class="admintable" width="100%">
				<tr>
					<td colspan="2" class="key">
						รายการแก้ไขบัญชีผู้ใช้งาน <? $_dat = mysql_fetch_assoc($_res); ?>
					</td>
				</tr>
				<tr>
					<td width="200px" align="right">รหัส :</td>
					<td>
						<input type="text" name="" size="3" class="inputboxUpdate" value="<?=$_dat['TeacCode']?>" disabled="disabled"/>
						<input type="hidden" name="teaccode" value="<?=$_dat['TeacCode']?>" />
					</td>
				</tr>
				<tr>
					<td align="right">คำนำหน้า :</td>
					<td>
						<input type="text" name="prefix" size="10" class="inputboxUpdate" value="<?=$_dat['PREFIX']?>"/> 
						<font color="#FF0000">*</font>
					</td>
				</tr>
				<tr>
					<td align="right">ชื่อ :</td>
					<td>
						<input name="firstname" type="text" class="inputboxUpdate" value="<?=$_dat['FIRSTNAME']?>" />
						<font color="#FF0000">*</font>
					</td>
				</tr>
				<tr>
					<td align="right">นามสกุล :</td>
					<td>
						<input name="lastname" type="text" class="inputboxUpdate" value="<?=$_dat['LASTNAME']?>" />
						<font color="#FF0000">*</font>
					</td>
				</tr>
				<tr>
					<td align="right">ชื่อเล่น :</td>
					<td>
						<input name="nickname" type="text" size="7" class="inputboxUpdate" value="<?=$_dat['NICKNAME']?>" />
						<font color="#FF0000">*</font>
					</td>
				</tr>
				<tr>
					<td align="right">ตำแหน่งปัจจุบัน :</td>
					<td><input name="position" type="text" size="35" class="inputboxUpdate" value="<?=$_dat['POSITION']?>" /></td>
				</tr>
				<tr>
					<td align="right">หมายเลขโทรศัพท์ :</td>
					<td>
						<input name="t_phone" type="text" class="inputboxUpdate" value="<?=$_dat['T_PHONE']?>" size="10" maxlength="9" onkeypress="return isNumberKey(event)" />
						<font color="#FF0000">*</font> ตัวอย่าง 044846117
					</td>
				</tr>
				<tr>
					<td align="right">หมายเลขมือถือ :</td>
					<td>
						<input name="t_mobile" type="text" class="inputboxUpdate" value="<?=$_dat['t_mobile']?>" size="10" maxlength="10" onkeypress="return isNumberKey(event)"/>
						<font color="#FF0000">*</font> ตัวอย่าง 0813567531
					</td>
				</tr>
				<tr>
					<td align="right">อีเมล :</td>
					<td>
						<input name="t_email" type="text" size="35" class="inputboxUpdate" value="<?=$_dat['t_email']?>" />
						<font color="#FF0000">*</font> ตัวอย่าง tsurasith@yahoo.com
					</td>
				</tr>
				<tr>
					<td align="right">สิทธิ :</td>
					<td>
						<select name="type" class="inputboxUpdate">
							<option value="admin" <?=$_dat['type']=="admin"?"selected":""?>>ผู้ดูแลระบบ</option>
							<option value="teacher" <?=$_dat['type']=="teacher"?"selected":""?>>ครูที่ปรึกษา</option>
							<option value="xcancel" <?=$_dat['type']=="xcancel"?"selected":""?>>ยกเลิกใช้งาน</option>
						</select>
						<font color="#FF0000">*</font>
					</td>
				</tr>
				<tr>
					<td align="right">กำหนดเป็น Super User :</td>
					<td>
						<input type="checkbox" value="1" <?=$_dat['superuser']==1?"checked":""?> name="superuser" /> กำหนดเป็นผู้ใช้ขั้นสูง หรือ Super User
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" value="บันทึก" name="save" class="button" />
						<input type="button" value="ยกเลิก" class="button" onclick="location.href='index.php?option=module_config/index'" />
					</td>
				</tr>
			</table>
			</form>
		<? } else { //check รหัสว่าถูกต้องหริอไ่ม่ ?>
				<center><font color="#FF0000"><br/>ไม่พบบัญชีข้อมูลผู้ใช้ โปรดตรวจสอบรหัสที่ป้อนอีกครั้ง </font></center>
		<? } //end else ?>
		
  <? } //end if ?>
</div>
<? 
	function displayPrivillage($_value){
		switch($_value){
			case "admin" : return "<b>ผู้ดูแลระบบ</b>"; break;
			case "teacher": return "ครูที่ปรึกษา"; break;
			case "xcancel" : return "<font color='red'>ยกเลิก</font>";break;
			default : return "-";
		}
	}
?>