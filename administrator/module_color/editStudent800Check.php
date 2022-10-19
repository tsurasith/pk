<?php
require_once('../Connections/bn.php'); 
mysql_select_db($database_nn, $nn);
mysql_query("SET Character set utf8");
mysql_query("set collation_connection = 'utf8'");

?>

<html>
<head>
<title>แก้ไขการบันทึกข้อมูลรายคน</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="module_800/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_800/js/calendar.js"></script>
<script type="text/javascript">
function check(name,value)
{

	document.getElementById(name).bgColor=value;

}
</script>
</head>

<body>

<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
  <tr> 
    <td width="6%" align="center"><a href="index.php?option=module_color/index"><img src="../images/color.png" alt="กิจกรรมคณะสี" width="48" height="48" border="0"/></a></td>
    <td width="94%"><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br /> 
      <span class="normal"><font color="#0066FF"><strong>ระบบบันทึกการเข้าร่วมกิจกรรมหน้าเสาธง</strong></font></span></td>
    <td width="94%">&nbsp;</td>
  </tr>
</table>

  <table width="100%" align="center" cellspacing="1" class="admintable">
    <tr> 
      <td colspan="2" class="key">แก้ไขการบันทึกการเ้ข้าแถวหน้าเสาธงรายคน</td>
    </tr>
    <tr> 
      <td width="120px">เลขประจำตัวนักเรียน</td>
      <td><input type="text" name="studentid" maxlength="5" />
	  </td>
    </tr>
	    <tr> 
      <td>วันที่แก้ไข</td>
        <td><input type="text" id="date" name="date" size="20" onClick="showCalendar(this.id)"/> 
          &nbsp; 
          <input type="submit" name="action" value="เรียกดูข้อมูล" />
        </td>
    </tr>
	<?php
		if(isset($_POST['action']))
		{
	?>
	<tr>
		<td class="key" colspan="2">
			ผลการค้นหา
		</td>
	</tr>
	<?php
		}
	?>
		<?php
		if(isset($_POST['saveedit']))
		{
	?>
	<tr>
		<td class="key" colspan="2">
			ผลการแก้ไขข้อมูล
		</td>
	</tr>
	<?php
		}
	?>
			<?php
				$sql = '';

				if(isset($_POST['action']))
				{
					$sql = "select * from student_800 where student_id = '" . $_POST['studentid'] . "' and check_date = '" . $_POST['date'] . "'" ;

					//echo $sql . '<br/>';
					$result = mysql_query($sql);
					if($result)
					{
						if(mysql_num_rows($result) > 0)
						{
							echo "<tr><td>วันที่บันทึก</td><td><font color=\"darkblue\">" . $_POST['date'] ."</font><input type=\"hidden\" value=\"" . $_POST['date'] . "\" name=\"date\"></td></tr>";
							echo '<tr>';
							$sql_student = "select prefix , firstname , lastname, studstatus from students where id = '" . $_POST['studentid'] . "'";
							$res_student = mysql_query($sql_student);
							$dat_student = mysql_fetch_assoc($res_student);
							echo "<td>ชื่อ - สกุล</td>";
							echo "<td><font color=\"darkblue\">" . $dat_student['prefix'] . $dat_student['firstname'] . ' ' . $dat_student['lastname'] . "</font></td>";
							echo "</tr>";
							echo "<tr><td>เลขประจำตัว</td><td><font color=\"darkblue\">" . $_POST['studentid'] . "</font><input type=\"hidden\" value=\"" . $_POST['studentid'] . "\" name=\"studentid\"></td></tr>";
							echo "<tr>";
							echo "<td>การมาเข้าแถ้วหน้าเสาธง</td><td>&nbsp;</td>";
							echo "</tr>";
							$periodRows = 1;
							
							while($dat = mysql_fetch_assoc($result))
							{	echo "<tr  >";
								echo "<td align=\"right\">การมาเข้าแถว</td>";
								echo "<td id=\"check[$periodRows]\">";
								$p0Check = "";
								$p1Check = "";
								$p2Check = "";
								$p3Check = "";
								$p4Check = "";
								switch($dat['timecheck_id'])
								{	case '00' : $p0Check = "checked"; break;
									case '01' : $p1Check = "checked"; break;
									case '02' : $p2Check = "checked"; break;
									case '03' : $p3Check = "checked"; break;
									case '04' : $p4Check = "checked"; break;
									default : echo "xx";
								}
								echo "<input type='radio' name=\"check[$periodRows]\" value='white'  $p0Check  onclick=\"check(this.name,this.value)\" />มา | ";
								echo "<input type='radio' name=\"check[$periodRows]\" value='lightgreen'  $p1Check onclick=\"check(this.name,this.value)\" />กิจกรรม | ";
								echo "<input type='radio' name=\"check[$periodRows]\" value='yellow'  $p2Check  onclick=\"check(this.name,this.value)\" >สาย | ";
								echo "<input type='radio' name=\"check[$periodRows]\" value='blue'  $p3Check  onclick=\"check(this.name,this.value)\" >ลา | ";
								echo "<input type='radio' name=\"check[$periodRows]\" value='red'  $p4Check onclick=\"check(this.name,this.value)\" >ขาด";
								echo "</tr>";
								$periodRows++;
							}//end while
							echo "</td>";
							echo "</tr>";
							echo "<tr>";
							echo "</tr>";
						}
						else
						{
							echo '<tr><td>&nbsp;</td>';
							echo '<td>';
							echo "<font color=\"red\">ผิดพลาด ไม่พบข้อมูลที่ค้นหา </font>";
							echo '</td></tr>';
						}
					}
				}
			?>
			
			<?php
				if(isset($_POST['saveedit']) && $_POST['studentid'] != '')
				{
					echo "<tr><td>&nbsp;</td>";
					echo "<td>";
					$sqlEdit = 'update student_800 set ';
					$sqlEdit = $sqlEdit . " timecheck_id = '" . timecheck_id($_POST['check'][1]) . "'";
					$sqlEdit = $sqlEdit . " where student_id = '" . $_POST['studentid'] . "'" ;
					$sqlEdit = $sqlEdit . " and check_date = '" . $_POST['date']  . "'" ;
					$update = mysql_query($sqlEdit) or die ('Error - ' . mysql_error());
					if($update)
					{
						echo "<font color='green' >บันทึกการแก้ไขข้อมูลเรียบร้อยแล้ว</font>";
					}
					echo "</td>";
					echo "</tr>";
					
				}
				else
				{
					if(!isset($_POST['action']) && isset($_POST['saveedit']))
					{
						echo "<tr><td>&nbsp;</td>";
						echo "<td><font color='red'>ผิดพลาด! คุณยังไม่ได้เลือกข้อมูลนักเรียนที่แก้ไขกรุณาเรียกดูข้อมูลก่อน</font></td>";
						echo "</tr>";
					}
				}
			?>

    <tr> 
        <td colspan="2" class="key">
			<input type="submit" value="บันทึกแก้ไข"  name="saveedit" class="button"/>
			<input type="button" value="ยกเลิก" class="button" onClick="location.href='../administrator/index.php?option=module_learn/index'"/>
		</td>
    </tr>
  </table>
</form>
</div>

</body>
</html>
<?php
function timecheck_id($value)
{
	if($value == 'white') return '00';
	if($value == 'lightgreen') return '01';
	if($value == 'yellow') return '02';
	if($value == 'blue') return '03';
	if($value == 'red') return '04';
	else return 9;
}
?>