<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.6 แสดงรายชื่อนักเรียนที่มีคดีตามห้องเรียน</strong></font></span></td>
      <td >
	  	<?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_discipline/reportStudentList&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/reportStudentList&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1){ echo "<font color='blue'>1</font> , "; }
					else{
						echo " <a href=\"index.php?option=module_discipline/reportStudentList&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2){ echo "<font color='blue'>2</font>"; }
					else{
						echo " <a href=\"index.php?option=module_discipline/reportStudentList&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		</font>
		<br/>
	  	<font  size="2" color="#000000">เลือกห้องเรียน
			<?  $sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
			    $resRoom = mysql_query($sql_Room); ?>
			<select name="roomID" class="inputboxUpdate">
				<option value=""></option>
				<? while($dat = mysql_fetch_assoc($resRoom)) {
						$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
						echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
						echo getFullRoomFormat($dat['room_id']);
						echo "</option>";
					}
				?>
			</select>
	  		<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			</font>
	   </td>
    </tr>
  </table>
  </form>
<?php
  	  $xlevel = getXlevel($_POST['roomID']);
	  $xyearth= getXyearth($_POST['roomID']);
	  $room = getRoom($_POST['roomID']);
?>
  
<? if(isset($_POST['search']) && $_POST['roomID'] == "") { ?>
	<center><br/><font color="#FF0000">กรุณาเลือกห้องเรียนก่อน </font></center>
<? } else if (isset($_POST['search']) && $_POST['roomID'] != "") { ?>
  <table class="admintable" cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th colspan="13" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายชื่อนักเรียนห้อง <?=getFullRoomFormat($_POST['roomID'])?><br/>
			ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
	  </th>
    </tr>
    <tr height="30px"> 
		<td class="key" width="35px" align="center" rowspan="2">เลขที่</td>
      	<td class="key" width="85px" align="center" rowspan="2">เลข<br/>ประจำตัว</td>
      	<td class="key" width="195px" align="center" rowspan="2">ชื่อ - นามสกุล</td>
      	<td class="key" width="100px"  align="center" rowspan="2">สถานภาพ</td>
		<td class="key" width="80px" align="center" rowspan="2">คะแนน<br/>ความประพฤติ</td>
		<td class="key" colspan="7" align="center">สถานะคดีพฤติกรรมไม่พึงประสงค์</td>
		<td class="key" rowspan="2" align="center" width="85px">รวม</td>
    </tr>
	<tr>
		<td class="key" width="30px" align="center">0</td>
		<td class="key" width="30px" align="center">1</td>
		<td class="key" width="30px" align="center">2</td>
      	<td class="key" width="30px" align="center">3</td>
      	<td class="key" width="30px" align="center">4</td>
      	<td class="key" width="30px" align="center">5</td>
		<td class="key" width="30px" align="center">6</td>
	</tr>
	<?php
		$sqlStudent = "select id,prefix,firstname,lastname,studstatus,points,
						sum(if(dis_status=0,1,0)) as '00',
						  sum(if(dis_status=1,1,0)) as '01',
						  sum(if(dis_status=2,1,0)) as '02',
						  sum(if(dis_status=3,1,0)) as '03',
						  sum(if(dis_status=4,1,0)) as '04',
						  sum(if(dis_status=5,1,0)) as '05',
						  sum(if(dis_status=6,1,0)) as '06'
					from students right outer join student_disciplinestatus on (id = student_id)
					where xlevel = '". $xlevel . "' and xyearth = '" . $xyearth . "' and room = '" . $room . "'  and xedbe = '" . $acadyear . "' 
							and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		$sqlStudent .= "group by id ";
		$sqlStudent .= "order by sex,id ";
		// echo $sqlStudent;
		$resStudent = mysql_query($sqlStudent);
		$ordinal = 1;
		$totalRows = mysql_num_rows($resStudent);
		for($i = 0; $i < $totalRows ; $i++) { ?>
		<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
			<? $dat = mysql_fetch_array($resStudent); ?>
			<td align="center"><?=$ordinal++?></td>
			<td align="center">
				<a href="index.php?option=module_discipline/disciplineSearch&page=1&student_id=<?=$dat['id']?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">
					<?=$dat['id']?>
				</a>
			</td>
			<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
			<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
			<td align="center"><?=displayPoint($dat['points'])?></td>
			<td align="right"><?=$dat['00']>0?$dat['00']:"-"?></td>
			<td align="right"><?=$dat['01']>0?$dat['01']:"-"?></td>
			<td align="right"><?=$dat['02']>0?$dat['02']:"-"?></td>
			<td align="right"><?=$dat['03']>0?$dat['03']:"-"?></td>
			<td align="right"><?=$dat['04']>0?$dat['04']:"-"?></td>
			<td align="right"><?=$dat['05']>0?$dat['05']:"-"?></td>
			<td align="right"><?=$dat['06']>0?$dat['06']:"-"?></td>
			<? $_sum = $dat['00']+$dat['01']+$dat['02']+$dat['03']+$dat['04']+$dat['05']+$dat['06'];?>
			<td align="right" style="padding-right:15px"><b><?=$_sum>0?$_sum:"-"?></b></td>
		</tr>
	<? } //end for?>
</table>
  <? } //end else-if ?>
</div>


