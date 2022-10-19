<script language="javascript">
	function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
	  function formCheckValue()
	  {
			if(document.getElementById('teaccode').value =="" || document.getElementById('teaccode').value.length < 3)
			{
				alert('กรุณาป้อนรหัสบัญชีผู้ใช้ให้ถูกต้อง');
				document.getElementById('teaccode').focus();
				return;
			}
			if(document.getElementById('firstname').value =="")
			{
				alert('กรุณาป้อนชื่อให้ถูกต้อง');
				document.getElementById('firstname').focus();
				return;
			}
			if(document.getElementById('lastname').value =="")
			{
				alert('กรุณาป้อนนามสกุลให้ถูกต้อง');
				document.getElementById('lastname').focus();
				return;
			}
			if(document.getElementById('nickname').value =="")
			{
				alert('กรุณาป้อนชื่อเล่นให้ถูกต้อง');
				document.getElementById('nickname').focus();
				return;
			}
			if(document.getElementById('t_mobile').value =="" || document.getElementById('t_mobile').value.length < 10)
			{
				alert('กรุณาป้อนหมายเลขโทรศัพท์มือถือให้ถูกต้อง คุณอาจจะป้อนไม่ครบ 10 หลัก');
				document.getElementById('t_mobile').focus();
				return;
			}
			
			if(document.getElementById('t_email').value != "")
			{
				var email = document.getElementById('t_email').value;		
					if ( (email.charCodeAt(0) > 3630) || (email.indexOf(' ') != -1) || (email.indexOf('@') < 1) || (email.indexOf('@') != email.lastIndexOf('@')) || (email.indexOf('@.') != -1) || (email.lastIndexOf('.') <= email.indexOf('@')+1) || ((email.lastIndexOf('.')+1) == email.length) ) {
						err = 'กรุณาตรวจสอบ อีเมลแอดเดรส (E-mail Address) ไม่ถูกต้อง';
						alert(err);
						document.getElementById('t_email').focus();
						return;
					}
			}
			
			if(document.getElementById('username').value =="" || document.getElementById('username').value.length < 4)
			{
				alert('กรุณาป้อน ชื่อเข้าใช้งาน ให้ถูกต้อง');
				document.getElementById('username').focus();
				return;
			}
			if(document.getElementById('password').value =="" || document.getElementById('password').value.length < 5)
			{
				alert('กรุณาป้อน รหัสผ่าน ให้ถูกต้อง');
				document.getElementById('password').focus();
				return;
			}
			if(document.getElementById('repassword').value =="" || document.getElementById('repassword').value != document.getElementById('password').value)
			{
				alert('กรุณาป้อนการ ยืนยันรหัสผ่าน ให้ถูกต้อง');
				document.getElementById('repassword').focus();
				return;
			}
			else { document.myform.submit(); }
			//t_email,username,password,repassword
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
			<td>
				<strong><font color="#990000" size="4">ปรับแต่งระบบ</font></strong><br />
				<span class="normal"><font color="#0066FF"><strong>
				1.2 เพิ่มบัญชีผู้ใช้งาน
				[<a href="index.php?option=module_config/userList">บัญชีผู้ใช้งาน</a>]
				</strong></font></span>
			</td>
			<td align="right"> </td>
		</tr>
	</table>

<?
	$_error_teaccode = "";
	$_error_username = "";
	if(isset($_POST['teaccode'])){ 
		$_code = mysql_query("select teaccode from teachers where teaccode = '" . $_POST['teaccode'] . "'");
		$_user = mysql_query("select username from teachers where username = '" . $_POST['username'] . "'");
		if(mysql_num_rows($_code)>0){
			$_error_teaccode = "<font color='red'><br/>ไม่สามารถเพิ่มบัญชีผู้ใช้ได้เนื่องจาก 'รหัส' ที่ป้อนมีอยู่ในบัญชีของระบบแล้ว !</font><br/>";
		}
		else if(mysql_num_rows($_user)>0){
			$_error_username = "<font color='red'><br/>ไม่สามารถเพิ่มบัญชีผู้ใช้ได้เนื่องจาก 'ชื่อเข้าใช้งาน' ที่ป้อนมีอยู่ในบัญชีของระบบแล้ว !</font><br/>";
		}
		else
		{
			$_sql = "insert teachers values (
						'" . $_POST['teaccode'] . "',
						'" . $_POST['prefix'] . "',
						'" . $_POST['firstname'] . "',
						'" . $_POST['lastname'] . "',
						'" .$_POST['nickname'] . "',
						'" . $_POST['position'] . "',
						'" . $_POST['t_phone'] . "',
						'" . $_POST['t_mobile'] . "',
						'" . $_POST['t_email'] . "',
						'" . $_POST['username'] . "',
						'" . $_POST['password'] . "',
						'" . $_POST['type'] . "',
						'" . ($_POST['superuser']==1?"1":"0") . "')";
				if(mysql_query($_sql))
				{
					echo "<center><br/><font color='green'><b>บันทึกแก้ไขข้อมูลเรียบร้อยแล้ว</b></font><br/></center>";
				}else 
				{
					echo "<center><br/><font color='red'>บันทึกข้อมูลผิดพลาด เนื่องจาก - " . mysql_error() . "</font><br/><br/></center>";
				}
		}
	}//end บันทึกแก้ไขข้อมูล
?>
 
	<form method="post" name="myform" autocomplete="off">
	<table class="admintable" width="100%">
		<tr>
			<td colspan="2" class="key">
				รายการเพิ่มบัญชีผู้ใช้งานใหม่
			</td>
		</tr>
		<tr>
			<td width="200px" align="right" valign="top">รหัส :</td>
			<td>
				<input type="text" id="teaccode" name="teaccode" maxlength="3" size="3" value="<?=isset($_POST['teaccode'])?$_POST['teaccode']:""?>" class="inputboxUpdate" onkeypress="return isNumberKey(event)" />
				<font color="#FF0000">*</font> ควรใช้รหัสให้ตรงกันกับที่ใช้งานโปรแกรม Student'44 (มีความยาวอย่างน้อย 3 ตัวอักษร)
				<?=isset($_POST['teaccode'])?$_error_teaccode:""?>
			</td>
		</tr>
		<tr>
			<td align="right">คำนำหน้า :</td>
			<td>
				<select name="prefix" class="inputboxUpdate">
					<option value="นาย" <?=isset($_POST['prefix']) && $_POST['prefix']=="นาย"?"selected":""?>>นาย</option>
					<option value="นาง" <?=isset($_POST['prefix']) && $_POST['prefix']=="นาง"?"selected":""?>>นาง</option>
					<option value="นางสาว" <?=isset($_POST['prefix']) && $_POST['prefix']=="นางสาว"?"selected":""?>>นางสาว</option>
				</select>
				<font color="#FF0000">*</font>
			</td>
		</tr>
		<tr>
			<td align="right">ชื่อ :</td>
			<td>
				<input id="firstname" name="firstname" type="text" value="<?=isset($_POST['firstname'])?$_POST['firstname']:""?>" class="inputboxUpdate" />
				<font color="#FF0000">*</font>
			</td>
		</tr>
		<tr>
			<td align="right">นามสกุล :</td>
			<td>
				<input id="lastname" name="lastname" type="text" value="<?=isset($_POST['lastname'])?$_POST['lastname']:""?>" class="inputboxUpdate" />
				<font color="#FF0000">*</font>
			</td>
		</tr>
		<tr>
			<td align="right">ชื่อเล่น :</td>
			<td>
				<input id="nickname" name="nickname" type="text" value="<?=isset($_POST['nickname'])?$_POST['nickname']:""?>" size="7" class="inputboxUpdate"  />
				<font color="#FF0000">*</font>
			</td>
		</tr>
		<tr>
			<td align="right">ตำแหน่งปัจจุบัน :</td>
			<td><input name="position" type="text" value="<?=isset($_POST['position'])?$_POST['position']:""?>" size="35" class="inputboxUpdate" /></td>
		</tr>
		<tr>
			<td align="right">หมายเลขโทรศัพท์ :</td>
			<td>
				<input name="t_phone" type="text" value="<?=isset($_POST['t_phone'])?$_POST['t_phone']:""?>" class="inputboxUpdate" size="10" maxlength="9" onkeypress="return isNumberKey(event)" />
				<font color="#FF0000">*</font> ตัวอย่าง 044859255
			</td>
		</tr>
		<tr>
			<td align="right">หมายเลขมือถือ :</td>
			<td>
				<input id="t_mobile" name="t_mobile" type="text" value="<?=isset($_POST['t_mobile'])?$_POST['t_mobile']:""?>" class="inputboxUpdate" size="10" maxlength="10" onkeypress="return isNumberKey(event)"/>
				<font color="#FF0000">*</font> ตัวอย่าง 0813567531
			</td>
		</tr>
		<tr>
			<td align="right">อีเมล :</td>
			<td>
				<input id="t_email" name="t_email" type="text" value="<?=isset($_POST['t_email'])?$_POST['t_email']:""?>" size="35" class="inputboxUpdate" />
				<font color="#FF0000">*</font> ตัวอย่าง taokok@gmail.com
			</td>
		</tr>
		<tr>
			<td align="right" valign="top"><b>ชื่อเข้าใช้งาน :</b></td>
			<td><input id="username" type="text" name="username" value="<?=isset($_POST['username'])?$_POST['username']:""?>" size="10" class="inputboxUpdate" />
			<font color="#FF0000">*</font> ไม่ควรต่ำกว่า 4 ตัวอักษร
			<?=strlen($_error_username)>0?$_error_username:""?>
		</tr>
		<tr>
			<td align="right"><b>รหัสผ่าน :</b></td>
			<td><input id="password" type="password" name="password" size="10" class="inputboxUpdate" />
			<font color="#FF0000">*</font> ไม่ควรต่ำกว่า 5 ตัวอักษร
		</tr>
		<tr>
			<td align="right"><b>ยืนยันรหัสผ่านอีกครั้ง</b></td>
			<td><input id="repassword" type="password" name="repassword" size="10" class="inputboxUpdate" />
			<font color="#FF0000">*</font> ป้อนรหัสผ่านซ้ำเพื่อยืนยันความถูกต้อง
		</tr>
		<tr>
			<td align="right"><b>สิทธิ :</b></td>
			<td>
				<select name="type" class="inputboxUpdate">
					<option value="teacher" <?=isset($_POST['type']) && $_POST['type']=="teacher"?"selected":""?>>ครูที่ปรึกษา</option>
					<option value="admin" <?=isset($_POST['type']) && $_POST['type']=="admin"?"selected":""?>>ผู้ดูแลระบบ</option>
				</select>
				<font color="#FF0000">*</font>
			</td>
		</tr>
		<tr>
			<td align="right"><b>กำหนดเป็น Super User :</b></td>
			<td>
				<input type="checkbox" value="1" name="superuser" /> กำหนดเป็นผู้ใช้ขั้นสูง หรือ Super User
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="button" value="บันทึก" name="save" class="button" onclick="formCheckValue()" />
				<input type="button" value="ยกเลิก" class="button" onclick="location.href='index.php?option=module_config/index'" />
			</td>
		</tr>
	</table>
	</form>


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