<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_config/index">
			<img src="../images/config.png" alt="" width="48" height="48" />
		</a>
	</td>
      <td><strong><font color="#990000" size="4">ปรับแต่งระบบ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1. จัดการบัญชีผู้ใช้งาน [บัญชีผู้ใช้งาน]</strong></font></span></td>
      <td align="right">
	  	<form method="post" name="myform">
			<font   size="2" color="#000000">
			<input type="checkbox" value="xcancel" name="type" 
				onclick="document.myform.submit()" <?=isset($_POST['type'])&&$_POST['type']=="xcancel"?"checked":""?> />
			เฉพาะบัญชีที่มีการใช้งานอยู่เท่านั้น </font>
		</form>
	  </td>
    </tr>
  </table>
  <? $_sql = "select * from teachers";
  	 if(isset($_POST['type']) && $_POST['type']=="xcancel") $_sql .= " where type in ('admin','teacher') ";
	 $_sql .= " order by TeacCode,type,FIRSTNAME"; ?>
  <? $_res = mysql_query($_sql) ?>
	<table width="100%" class="admintable">
		<tr>
			<td colspan="8"><h3>บัญชีรายชื่อผู้ใช้งานระบบสารสนเทศกิจการนักเรียน</h3></td>
		</tr>
		<tr>
			<td align="center" class="key" width="35px">ที่</td>
			<td align="center" class="key" width="55px">รหัส</td>
			<td align="center" class="key">ชื่อ-สกุล</td>
			<td align="center" class="key" width="65px">ชื่อเล่น</td>
			<td align="center" class="key" width="110px">ชื่อเข้าใช้งาน</td>
			<td align="center" class="key" width="110px">รหัสผ่าน</td>
			<td align="center" class="key" width="50px">รูปถ่าย</td>
			<td align="center" class="key" width="135px">สิทธิ</td>
		</tr>
		<? $_i = 1; ?>
		<? while($_dat = mysql_fetch_assoc($_res)){ ?>
		<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
			<td align="center"><?=$_i++?></td>
			<td align="center">
				<a href="index.php?option=module_config/userEdit&teaccode=<?=$_dat['TeacCode']?>">
					<?=$_dat['TeacCode']?>
				</a>
			</td>
			<td><?=$_dat['PREFIX'].$_dat['FIRSTNAME']. ' ' .$_dat['LASTNAME']?></td>
			<td><?=$_dat['NICKNAME']?></td>
			<td><?=$_dat['username']?></td>
			<td><?=$_dat['password']?></td>
			<td align="center">
				<a href="index.php?option=module_config/userAddPics&teacher_code=<?=$_dat['TeacCode']?>">
					<? if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/pk/images/teacphoto/TC" . $_dat['TeacCode'] .".jpg")) { ?>
						<img src="../images/apply.png" width="16px" alt="คลิกเพื่อแก้ไขรูปถ่ายของบัญชีผู้ใช้" />
					<? } else { ?>
						<img src="../images/delete.png" width="16px" alt="คลิกเพื่อแก้ไขรูปถ่ายของบัญชีผู้ใช้" />
					<? } ?>
				</a>
			</td>
			<td align="center"><?=displayPrivillage($_dat['type'])?></td>
		</tr>
		<? } //end while ?>
	</table>
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