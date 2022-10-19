<?php 
	include("include/class.mysqldb.php");
	include("include/config.inc.php");
	$username = "";
	$password = "";
	$type = "";
	if(!@$_SESSION['pk-logined']) {
		$classtext = array("", "");
		$classbox = array("noborder2", "noborder2");
		$message = "กรุณาป้อนข้อมูลชื่อผู้ใช้งาน รหัสผ่านและสิทธิการใช้งาน";
		if(isset($_REQUEST['action'])) {
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
			if(empty($_REQUEST['username']) && empty($_REQUEST['password'])) {
				$message = "<span class=\"red\">กรุณากรอกชื่อผู้ใช้และรหัสผ่านของท่านด้วย</span>";
			} else if(empty($_REQUEST['username']) && !empty($_REQUEST['password'])) {
				$message = "<span class=\"red\">กรุณากรอกชื่อผู้ใช้ของท่านด้วย</span>";
			} else if(!empty($_REQUEST['username']) && empty($_REQUEST['password'])) {
				$message = "<span class=\"red\">กรุณากรอกรหัสผ่านของท่านด้วย</span>";
			} else {
				$sql = "";
				switch ($_REQUEST['type']) {
					case 'admin' :	$sql = "select * from teachers where username = '".$_REQUEST['username']."' and password = '".($_REQUEST['password'])."' and type= 'admin'"; break;
					case 'teacher' : $sql = "select * from teachers where username = '".$_REQUEST['username']."' and password = '".($_REQUEST['password'])."' and type= 'teacher'"; break;
					case 'student' : $sql = "select * from students where id = '".$_REQUEST['username']."' and id = '".($_REQUEST['password'])."' order by xedbe desc" ; break;
				}
				$result = $link->query($sql);
				if($link->num_rows() == 0) {
					$message = "<span class=\"red\">ข้อมูลของท่านไม่ถูกต้อง กรุณาตรวจสอบข้อมูลด้วย</span>";
				} else {
					$data = mysql_fetch_object($result);
					$_SESSION['pk-logined'] = true;
					$_SESSION['username'] = $_REQUEST['username'];
					$_SESSION['name'] = $data->PREFIX . $data->FIRSTNAME ." ".  $data->LASTNAME;
					$_SESSION['pk-type'] = $_REQUEST['type'] ;
						if($data->TeacCode == "999" || $data->superuser == "1")
						{ $_SESSION['superAdmin'] = true; }
					//$sql = "update administrator set lastlogin = '".date("Y-m-d H:i:s")."' where username = '".$_REQUEST['username']."'";
					//$link->query($sql);
					if($_SESSION['pk-type'] == 'admin')
					{
						?><meta http-equiv="refresh" content="0;url=administrator/index.php"><?
						exit(0);
					}
					if($_SESSION['pk-type'] == 'teacher')
					{
						$_SESSION['teacher_id'] = $data->TeacCode;
						?><meta http-equiv="refresh" content="0;url=teacher/index.php"><?
						exit(0);
					}
					if($_SESSION['pk-type'] == 'student')
					{
						$_SESSION['name'] = $data->PREFIX . $data->FIRSTNAME ." ".  $data->LASTNAME;
						?><meta http-equiv="refresh" content="0;url=student/index.php"><?
						exit(0);
					}
					mysql_free_result($result);
					mysql_close($link);
				}
			}
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Mr.Surasith Taokok" />
	<meta name="keywords" content="โรงเรียนโป่งนกประชาสามัคคี" />
	<meta name="description" content="Student Information Project" />	
    <link href="css/main.css" type=text/css rel=stylesheet>
	<link rel="shortcut icon" href="images/favicon.ico" />
	
	<title>-:- ระบบสารสนเทศกิจการนักเรียนโรงเรียนโป่งนกประชาสามัคคี -:-</title>
    
    
    
</head>
<body onLoad="document.login.username.focus();">
<div id="maincontent">
	<div id="loginform">
		<h2>ระบบสารสนเทศ<span class="green">กิจการนักเรียน</span></h2>
		<form name="login" id="login" method="post" action="" autocomplete="off">
			<?php echo $message; ?>
			<table align="right">
            	<tr>
                	<td><label for="username">ชื่อผู้ใช้ :</label></td>
                    <td><input type="text" name="username" id="username" class="<?php echo $classbox[0]; ?>"  value="<?php echo $username; ?>"  onclick="this.value=''" /></td>
                </tr>
                <tr>
                	<td><label for="password">รหัสผ่าน :</label></td>
                    <td><input type="password" name="password" id="password" class="<?php echo $classbox[1]; ?>"  value="<?php echo $password; ?>"  onclick="this.value=''" /></td>
                </tr>
                <tr>
                	<td><label for="type">สิทธิเข้าใช้งาน :</label></td>
                    <td align="left">
                        <input type="hidden" name="action" id="action" value="login"> 
                        <select name="type" class="loginSelect" id="type">
                            <option value="admin">ผู้ดูแลระบบ</option>
                            <option value="teacher">ครูที่ปรึกษา</option>
                            <option value="student">นักเรียน</option>
                        </select>
                    </td>
               </tr>
               <tr>
               		<td>&nbsp;</td>
                    <td>
                        <input name="button" type="submit" class="button" id="button" value="เข้าสู่ระบบ"   />
                        <input name="button2" type="button" class="button" id="button2" value="ยกเลิก" onClick="window.location='index.php'" /><br />
                 	</td>
            	</tr>
                <tr>
                	<td colspan="2">
                    	<div style="line-height: 18px">
                            <br />
                            ระบบจัดการสารสนเทศกิจการนักเรียน<br />
                            ออกแบบและพัฒนาระบบ: <a href="mailto:taokok@gmail.com">นายสุรสิทธิ์  ท้าวกอก</a>
                        </div>
                    </td>
                </tr>
            </table>
		</form>
	</div>
</div>

</body>
</html>
<?php
	} else {
		?><meta http-equiv="refresh" content="0;url=../pk/logoff.php"><?
	}
?>