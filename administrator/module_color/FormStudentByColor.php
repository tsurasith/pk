<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
	<tr> 
	  <td width="6%" align="center"><a href="index.php?option=module_color/index"><img src="../images/color.png" alt="กิจกรรมคณะสี" width="48" height="48" border="0"/></a></td>
	  <td><strong><font color="#990000" size="4">กิจกรรมคณะสี</font></strong><br />
		<span class="normal"><font color="#0066FF"><strong>ระบบบริหารจัดการงานคณะสี</strong></font></span></td>
	  <td width="300px">
		<?php
				if(isset($_REQUEST['acadyear']))
				{
					$acadyear = $_REQUEST['acadyear'];
				}
				if(isset($_REQUEST['acadsemester']))
				{
					$acadsemester = $_REQUEST['acadsemester'];
				}
			?>
			ปีการศึกษา<?php  
						echo "<a href=\"index.php?option=module_color/FormStudentByColor&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
						echo '<font color=\'blue\'>' .$acadyear . '</font>';
						echo " <a href=\"index.php?option=module_color/FormStudentByColor&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
					?>
			<br/>ภาคเรียนที่   <?php 
						if($acadsemester == 1)
						{
							echo "<font color='blue'>1</font> , ";
						}
						else
						{
							echo " <a href=\"index.php?option=module_color/FormStudentByColor&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
						}
						if($acadsemester == 2)
						{
							echo "<font color='blue'>2</font>";
						}
						else
						{
							echo " <a href=\"index.php?option=module_color/FormStudentByColor&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
						}
				?>
		</font>
	  <form method="post">
	  <font color="#330033" face="sans serif" size="2">
	  	คณะสี <select name="color">
				<option value=""></option>
				<option value="ม่วง">ม่วง</option>
				<option value="เหลือง">เหลือง</option>
				<option value="เขียว">เขียว</option>
				<option value="ชมพู">ชมพู</option>
				<option value="ส้ม">ส้ม</option>
			 </select><br/>
			 
			 <input type="radio" name="level" value="3" /> ม.ต้น |
			 <input type="radio" name="level" value="4" /> ม.ปลาย
			 </font>
			 <input type="submit" name="submit" value="เรียกดูข้อมูล" class="button" />
	  </form>
	  </td>
	</tr>
</table>
<?php
	if(isset($_POST['submit']))
	{
		if(isset($_POST['level']) && $_POST['color'] != "")
		{
			$_sql = "select id,prefix,firstname,lastname,xyearth,room,studstatus from students 
						where xlevel = '" . $_POST['level'] . "' and color = '" . $_POST['color'] . "' 
							and xedbe = '" . $acadyear . "' order by xyearth,room,id";
			$_result = mysql_query($_sql);
			if($_result)
			{ ?>
				<table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%" >
					<tr>
						<td class="key" align="center" colspan="6">
							<img src="../images/school_logo.gif" width="120px">
							<br/>
							รายชื่อนักเรียนคณะสี<?=$_POST['color']?><br/>
							ระดับชั้นมัธยมศึกษาตอน<?=($_POST['level']==4)?"ปลาย":"ต้น"?>
							<br/>
							ประจำภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
							<br/>
						</td>
					</tr>
					<tr bgcolor="#CCCCFF" height="35px" > 
						<td width="50px" align="center">เลขที่</td>
						<td width="110px" align="center" >เลขประจำตัว</td>
						<td width="250px" align="center" >ชื่อ - นามสกุล</td>
						<td align="center" width="70px">ห้อง</td>
						<td  align="center" >สถานภาพปัจจุบัน</td>
						<td  align="center">-</td>
					</tr>
					<?php
						$_i = 1;
						while($_dat = mysql_fetch_assoc($_result))
						{
					?>
					<tr>
						<td align="center"><?=$_i++?></td>
						<td align="center"><?=$_dat['id']?></td>
						<td ><?=$_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname'] ?></td>
						<td align="center"><?=(($_POST['level']==4)?(($_dat['xyearth']+3)."/".$_dat['room']):($_dat['xyearth']."/".$_dat['room']))?></td>
						<td align="center"><?=displayStatus($_dat['studstatus'])?></td>
						<td align="center">&nbsp;</td>
					</tr>
					<?php
						} //end-while
					?>
				</table>
			<?php
			}
			else
			{ ?>
				<div align="center"><font color="red">ไม่พบข้อมูลที่ต้องการตามเงื่อนไข</font></div>
			<?php	
			}
		}
		else
		{ ?>
			<table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="50%" >
				<tr>
					<td >
						กรุณาเลือกข้อมูลให้ครบถ้วน
						<li>ตรวจสอบปีการศึกษา และภาคเรียนให้ถูกต้อง
						<li>เลือกคณะสี
						<li>เลือกระดับชั้น
					</td>
				</tr>
			</table>
		<?php
		}
	} 
?>
		
</div>
<?php
	function displayStatus($id)
	{
		switch ($id) {
			case 0 :  return "<font color='red'><b>ออก</b></font>"; break;
			case 1 :  return "ปกติ"; break;
			case 2 :  return "<b>สำเร็จการศึกษา</b>"; break;
			case 3 :  return "<font color='red'><b>แขวนลอย</b></font>"; break;
			case 4 :  return "<font color='darkorange'><b>พักการเรียน</b></font>"; break;
			case 5 :  return "<font color='blue'><b>ย้ายสถานศึกษา</b></font>"; break;
			case 9 :  return "<font color='red'><b>เสียชีวิต</b></font>"; break;
			default : return " - ไม่ทราบ - ";
		}	
	}
?>