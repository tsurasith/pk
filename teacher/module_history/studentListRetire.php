<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.3.1 รายชื่อนักเรียนที่พ้นสภาพตามโรงเรียนเดิม<br/>และสาเหตุ (รายระดับชั้น)</strong></font></span></td>
      <td >
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_history/studentListRetire&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/studentListRetire&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	  	<font  size="2" color="#000000">เลือกระดับชั้น </font>
			<select name="roomID" class="inputboxUpdate">
		  		<option value=""> </option>
				<option value="3/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/1"?"selected":""?>> มัธยมศึกษาปีที่ 1 </option>
				<option value="3/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/2"?"selected":""?>> มัธยมศึกษาปีที่ 2 </option>
				<option value="3/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/3"?"selected":""?>> มัธยมศึกษาปีที่ 3 </option>
				<option value="4/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/1"?"selected":""?>> มัธยมศึกษาปีที่ 4 </option>
				<option value="4/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/2"?"selected":""?>> มัธยมศึกษาปีที่ 5 </option>
				<option value="4/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/3"?"selected":""?>> มัธยมศึกษาปีที่ 6 </option>
				<option value="all" <?=isset($_POST['roomID'])&&$_POST['roomID']=="all"?"selected":""?>> ทั้งโรงเรียน </option>
			</select> 
	  		<input type="submit" value="เรียกดู" class="button" name="search"/>
	   </td>
    </tr>
  </table>
  </form>
 <?php
  $xlevel;
  $xyearth;
  if($_POST['roomID'] != "all")
  {
  	$xlevel = substr($_POST['roomID'],0,1);;
	$xyearth = substr($_POST['roomID'],2,1);
  }
?>

	<?php
		if(isset($_POST['search']) && $_POST['roomID'] == "") {
			echo "<br/><br/><center><font color='red'>กรุณาเลือกระดับชั้นที่ต้องการทราบข้อมูลก่อน </font></center>";
		}
		else if(isset($_POST['search']) && $_POST['roomID'] != "")
		{
			$sqlStudent = "";
			if($_POST['roomID'] != "all")
			{
				$sqlStudent = "select id,prefix,firstname,lastname,nickname,xlevel,xyearth,room,studstatus,points,
									ent_date,sch_name,gpa,students.leave,students.cause
								from students
								where xyearth = '" . $xyearth . "' and xlevel = '" . $xlevel ."' and xedbe = '" .$acadyear . "' 
										and studstatus not in (1,2)
								order by xlevel,xyearth,room,sex,id";
			}
			else
			{
				$sqlStudent = "select id,prefix,firstname,lastname,nickname,xlevel,xyearth,room,studstatus,points,
									ent_date,sch_name,gpa,students.leave,students.cause
								from students
								where xedbe = '" .$acadyear . "' and studstatus not in (1,2) 
								order by  xlevel,xyearth,room,sex,id";			
			}
			$resStudent = mysql_query($sqlStudent);
			$ordinal = 1;
			$totalRows = mysql_num_rows($resStudent);
			if($totalRows == 0)
			{
				echo "<br/><br/><center><font color='red'>ไม่พบข้อมูลตามเงื่อนไข</font></center>";
				$error = 0;
			}
			else{
	?>	 
   <table class="admintable" align="center">
	 <tr> 
	  <th colspan="8" align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>
        รายชื่อนักเรียนที่พ้นสภาพการเป็นนักเรียนโดยที่ไม่สำเร็จการศึกษา <br/>
        ปีการศึกษา <?=$acadyear?> ชั้นมัธยมศึกษาปีที่ <?=displayXyear($_POST['roomID'])?> 
		<br/>
      </th>
    </tr>
    <tr> 
		<td class="key" width="35px" align="center" >เลขที่</td>
      	<td class="key" width="75px" align="center" >เลขประจำตัว</td>
      	<td class="key" width="170px" align="center" >ชื่อ - นามสกุล</td>
		<td class="key" width="35px" align="center" >ห้อง</td>
		<td class="key" width="25px" align="center" >GPAX</td>
      	<td class="key" width="100px"  align="center" >สถานะภาพ</td>
		<td class="key" width="150px" align="center" >โรงเรียนเดิม</td>
		<td class="key" width="180px" align="center" >สาเหตุที่ออก</td>
    </tr>

	<?php
		for($i = 0; $i < $totalRows ; $i++)
		{
		$dat = mysql_fetch_array($resStudent); ?>
		<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">	
			<td align="center" valign="top"><?=$ordinal++?></td>
			<td align="center" valign="top">
				<? if($_SESSION['superAdmin']) { ?><a href="index.php?option=module_history/editStudentListRetire&student_id=<?=$dat['id']?>&acadyear=<?=$acadyear?>&roomID=<?=$_POST['roomID']?>">
						<?=$dat['id']?>
					</a>
				<? } else { ?>
						<?=$dat['id']?>
				<? } // end if-else ?>
			</td>
			<td valign="top"><?=displayPrefix($dat['prefix']) . $dat['firstname'] . " " . $dat['lastname']?></td>
			<td align="center" valign="top"><?=displayRoomTable($dat['xlevel'] , $dat['xyearth']) . "/" .$dat['room']?></td>
			<td align="center" valign="top"><?=$dat['gpa']?></td>
			<td align="center" valign="top"><?=displayStudentStatusColor($dat['studstatus'])?></td>
			<td valign="top"><?=strlen(trim($dat['sch_name']))>0?$dat['sch_name']:" &nbsp; -"?></td>
			<td valign="top"><?=$dat['cause']?></td>
		</tr>
		<? } //end for loop ?>
	<?  }//ปิด if-else ตรวจสอบข้อมูลในฐานข้อมูล
	}//ปิด if-else ตรวจสอบการเลือกวันที่
	?>
</table>

</div>

