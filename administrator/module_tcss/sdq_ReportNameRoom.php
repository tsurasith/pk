<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_tcss/index&content=sdq"><img src="../images/tcss.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">TCSS</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.2 รายงานการคัดกรองรายห้อง<br/>(แปลผลรายด้าน 3 แบบประเมิน)</strong></font></span></td>
      <td >
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_tcss/sdq_ReportNameRoom&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_tcss/sdq_ReportNameRoom&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_tcss/sdq_ReportNameRoom&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_tcss/sdq_ReportNameRoom&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		</font>
		<br/>
		<font color="#000000" size="2">
			ชุดประเมิน
			<select name="questioner" class="inputboxUpdate">
				<option value="student" <?=isset($_POST['questioner'])&&$_POST['questioner']=="student"?"selected":""?>>นักเรียนประเมินตนเอง</option>
				<option value="parent" <?=isset($_POST['questioner'])&&$_POST['questioner']=="parent"?"selected":""?>>ผู้ปกครองประเมิน</option>
				<option value="teacher" <?=isset($_POST['questioner'])&&$_POST['questioner']=="teacher"?"selected":""?>>ครูที่ปรึกษาประเมิน</option>
			</select>
	  		<br/>เลือกห้อง 
			<?php 
					$sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
					//echo $sql_Room ;
					$resRoom = mysql_query($sql_Room);			
			?>
			<select name="roomID" class="inputboxUpdate">
				<option value=""></option>
				<?
					while($dat = mysql_fetch_assoc($resRoom))
					{
						$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
						echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
						echo getFullRoomFormat($dat['room_id']);
						echo "</option>";
					}
					
				?>
			</select>
	  		<input type="submit" value="เรียกดู" class="button" name="search"/><br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา </font>
	   </td>
    </tr>
  </table>
  </form>
  <?php
if(isset($_POST['search']) && $_POST['roomID'] != "")
{
  $xlevel = getXlevel($_POST['roomID']);
  $xyearth= getXyearth($_POST['roomID']);
  $room = getRoom($_POST['roomID']);
  ?>
  <table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th colspan="11" align="center">
	  	<img src="../images/school_logo.gif" width="120px"><br/>
	  	ผลการประเมิน SDQ ห้อง <?=getFullRoomFormat($_POST['roomID'])?> ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?><br />
		โดย <?=displayQuestioner($_POST['questioner'])?> เป็นผู้ประเมิน
	  </th>
    </tr>
    <tr> 
		<td class="key" width="30px" align="center" rowspan="2">เลขที่</td>
      	<td class="key" width="75px" align="center" rowspan="2">เลขประจำตัว</td>
      	<td class="key" width="175px" align="center" rowspan="2">ชื่อ - นามสกุล</td>
      	<td class="key" width="80px"  align="center" rowspan="2">สถานภาพ</td>
		<td class="key" align="center" colspan="6"><b>การแปลผลรายด้าน</b></td>
		<td class="key" align="center" rowspan="2">แปลผลรวม</td>
    </tr>
	<tr>
		<td class="key" width="50px" align="center">ด้านที่ 1</td>
		<td class="key" width="50px" align="center">ด้านที่ 2</td>
		<td class="key" width="50px" align="center">ด้านที่ 3</td>
		<td class="key" width="50px" align="center">ด้านที่ 4</td>
		<td class="key" width="60px" align="center">ด้านที่ 5</td>
		<td class="key" width="70px" align="center">ด้านอื่นๆ</td>
	</tr>
	<?php
		$sqlStudent = "select id,prefix,firstname,lastname,studstatus,
						type1,type2,type3,type4,type5,more_detail,b.all
					from students a right outer join sdq_result b
						on	(a.id = b.student_id)
					where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' and room = '" . $room . "' 
										and a.xedbe = '" .$acadyear ."'
										and b.acadyear = '" .$acadyear ."'
										and b.acadsemester = '" .$acadsemester ."'
										and b.questioner = '" . $_POST['questioner'] . "' ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		$sqlStudent .= " order by sex,id,ordinal";
		$resStudent = mysql_query($sqlStudent);
		$ordinal = 1;
		$totalRows = mysql_num_rows($resStudent);
		for($i = 0; $i < $totalRows ; $i++)
		{ ?>
			<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
			<? $dat = mysql_fetch_array($resStudent); ?>
				<td align="center"><?=$ordinal++?></td>
				<td align="center"><?=$dat['id']?></td>
				<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
				<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
				<td align="center"><?=displayType1($dat['type1'],$_POST['questioner'])?></td>
				<td align="center"><?=displayType2($dat['type2'],$_POST['questioner'])?></td>
				<td align="center"><?=displayType3($dat['type3'],$_POST['questioner'])?></td>
				<td align="center"><?=displayType4($dat['type4'],$_POST['questioner'])?></td>
				<td align="center"><?=displayType5($dat['type5'],$_POST['questioner'])?></td>
				<td align="center"><?=displayMoreDetail($dat['more_detail'])?></td>
				<td align="center">
					<a href="index.php?option=module_tcss/sdq_ReportPersonalFull&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>&student_id=<?=$dat['id']?>">
					<?=displayAll($dat['all'],$_POST['questioner'])?>
					</a>
				</td>
			</tr>
	<?	} //end for?>
</table>
<? } // end if ?>
</div>

