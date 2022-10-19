<script language="javascript1.2">
checked = false;
function checkedAll (count) {
	var aa= document.getElementById('frm1');
	    if (checked == false){checked = true}
        else{checked = false}
		
	for (var i =1; i < count+1; i++) 
	{
		document.getElementById('chk' + i).checked = checked;
	} 
}
</script>
<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td width="45%"><strong><font color="#990000" size="4">แก้ไขหมู่บ้านที่อาศัยของนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>ระบบบริหารจัดการ/สืบค้นประวัตินักเรียน</strong></font></span></td>
      <td >
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
					echo "<a href=\"index.php?option=module_history/studentList_p_village&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/studentList_p_village&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		<br/>ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_history/studentList_p_village&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_history/studentList_p_village&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		</font>
		<br/>
	  		เลือกห้อง 
			<?php 
					$sql_Room = "select replace(room_id,'0','/') as room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
					//echo $sql_Room ;
					$resRoom = mysql_query($sql_Room);			
			?>
			<select name="roomID">
				<?php

					while($dat = mysql_fetch_assoc($resRoom))
					{
						echo "<option value=\"" . $dat['room_id'] . "\">";
						echo $dat['room_id'];
						echo "</option>";
					}
					
				?>
			</select>
	  		<input type="submit" value="สืบค้น" class="button" name="search"/>
	   </td>
    </tr>
  </table>
  </form>
  <?php
  $xlevel;
  $xyearth;
  $room = substr($_POST['roomID'],2,1);
  if(substr($_POST['roomID'],0,1) > 3)
  {
  	$xlevel = 4;
	if(substr($_POST['roomID'],0,1) == 4){ $xyearth = 1;}
	if(substr($_POST['roomID'],0,1) == 5){ $xyearth = 2;}
	if(substr($_POST['roomID'],0,1) == 6){ $xyearth = 3;}		
  }
  else
  {
  	$xlevel = 3;
	if(substr($_POST['roomID'],0,1) == 1){ $xyearth = 1;}
	if(substr($_POST['roomID'],0,1) == 2){ $xyearth = 2;}
	if(substr($_POST['roomID'],0,1) == 3){ $xyearth = 3;}
  }
  
  if(isset($_POST['search']))
  {
  		$sqlStudent = "select id,prefix,firstname,lastname,studstatus,p_village from students where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' and room = '" . $room . "' and xedbe = '" . $acadyear . "' order by sex,ordinal ";
		$resStudent = mysql_query($sqlStudent);
  ?>
  <form method="post" id="frm1">
  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="left">
    <tr> 
      <td class="key" colspan="9">รายชื่อนักเรียนห้อง <?php echo $_POST['roomID']; ?> ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?></td>
    </tr>
    <tr bgcolor="#CCCCFF"> 
		<td align="center"><input type='checkbox' name='checkall' onclick='checkedAll(<?=mysql_num_rows($resStudent)?>);' ></td>
		<td width="35px" align="center">เลขที่</td>
      	<td width="80px" align="center">เลขประจำตัว</td>
      	<td width="200px" align="center">ชื่อ - นามสกุล</td>
      	<td width="140px"  align="center">สถานภาพปัจจุบัน</td>
      	<td width="200px" align="center">หมู่บ้านที่อาศัย</td>
    </tr>
	<?php
		$ordinal = 1;
		$totalRows = mysql_num_rows($resStudent);
		for($i = 0; $i < $totalRows ; $i++)
		{
			if($i % 2 == 0 ){echo "<tr>";}
			else{echo "<tr bgcolor=\"#EFFEFE\">";}
			$dat = mysql_fetch_array($resStudent); ?>
			<td><input type="checkbox" id="chk<?=$ordinal?>" value="<?= $$dat['id'] ?>" /></td>
	<?php	echo "<td align=\"center\">$ordinal</td>";
			echo "<td align=\"center\">" . $dat['id'] . "</td>";
			echo "<td>" . $dat['prefix'] . $dat['firstname'] . " " . $dat['lastname'] . "</td>";
			echo "<td align=\"center\">" . displayStatus($dat['studstatus']) . "</td>";
			echo "<td>" . $dat['p_village'] . "</td>";
			echo "</tr>";
			$ordinal++;
		}
	?>
</table>
</form>
 <?php
 	} // end-if
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