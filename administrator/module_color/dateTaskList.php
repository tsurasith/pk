<div id="content">
	<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
		<tr>
			<td width="6%" align="center"><a href="index.php?option=module_color/index"><img src="../images/color.png" alt="กิจกรรมคณะสี" width="48" height="48" border="0"/></a></td>
			<td ><strong><font color="#990000" size="4">กิจกรรมคณะสี</font></strong><br />
				<span class="normal"><font color="#0066FF"><strong>2.2 เลือกวันที่บันทึกข้อมูล</strong></font></span></td>
			<td>
				<?
					if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
					if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
				?>
				ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_color/dateTaskList&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_color/dateTaskList&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
				ภาคเรียนที่  <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_color/dateTaskList&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_color/dateTaskList&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
			</font>
			</td>
		</tr>
	</table>
	<br/>
	<? $sql_date = "select distinct task_date from student_color_task where task_status = '0' and acadyear = '" . $acadyear . "' and acadsemester = '" .$acadsemester . "' order by task_date " ; ?>
	<? $result = mysql_query($sql_date); ?>
	<form method="post" action="index.php?option=module_color/dateTaskList">
	เลือกวันที่ 
	<select name="date" class="inputboxUpdate" >
		<option value=""></option>
		<? while($data = mysql_fetch_assoc($result)){ ?>
			<option value="<?=$data['task_date']?>"><?=displayDate($data['task_date'])?></option>
		<? } //end while?>
	</select>
	<input type="submit" name="Submit" value="เลือก" class="button">
	<br/><br/>
	
	<? if($_POST['date'] != "") { ?>
		<table width="60%" class="admintable">
			<tr height="35px">
				<td width="100px" align="center" class="key">-</td>
				<td align="center" class="key">รายการบันทึกวันที่ <?=displayDate($_POST['date'])?> </td>
			</tr>
			<tr>
				<td align="center">-</td>
				<td align="center"> ม.ต้น <br />
					<? $sql_room = "select * from student_color_task where task_roomid like '3%' and task_date  = '" .  $_POST['date']  ."' order by task_roomid" ; ?>
					<? $res = mysql_query($sql_room) or die (' ' . mysql_error()); ?>
					<? echo "| "; ?>
					<? while($_dat = mysql_fetch_assoc($res)) { ?>
						<? if($_dat['task_status'] == 0) {
								echo "<a href=\"module_color/studentListForm.php?color=" . getColor($_dat['task_roomid']) . "&xlevel=3&date=" .$_POST['date'] . "&task_id=" . $_dat['task_roomid'] . "&acadyear=" . $acadyear . "&acadsemester=" . $acadsemester . "\">สี" . getColor($_dat['task_roomid']) . "</a> | ";
							} else {
								echo "สี" . getColor($_dat['task_roomid']) . " | ";
							}
						}//end while ?>
					<br/><br/>ม.ปลาย<br/>
					<? $sql_room = "select * from student_color_task where task_roomid like '4%' and task_date  = '" .  $_POST['date']  ."' order by task_roomid" ; ?>
					<? $res = mysql_query($sql_room) or die (' ' . mysql_error()); ?>
					<? echo "| ";?>
					<? while($_dat = mysql_fetch_assoc($res)){ ?>
						<? if($_dat['task_status'] == 0){
								echo "<a href=\"module_color/studentListForm.php?color=" . getColor($_dat['task_roomid']) . "&xlevel=4&date=" .$_POST['date'] . "&task_id=" . $_dat['task_roomid'] . "&acadyear=" . $acadyear . "&acadsemester=" . $acadsemester . "\">สี" . getColor($_dat['task_roomid']) . "</a> | ";
							} else {
								echo "สี" . getColor($_dat['task_roomid']) . " | ";
							}
						}//end while?>
					<br/><br/>
				</td>
				<? } // end-if ?>
			</tr>
		</table>
		</form>
</div>
<?php
	function displayDate($date) {
		$txt = "" ;
		$_x = explode('-',$date,3);
		switch ($_x[1]) {
			case "01" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน มกราคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "02" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน กุมภาพันธ์  พ.ศ. " . ($_x[0] + 543) ;break;
			case "03" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน มีนาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "04" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน เมษายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "05" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน พฤษภาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "06" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน มิถุุนายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "07" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน กรกฎาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "08" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน สิงหาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "09" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน กันยายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "10" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน ตุลาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "11" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน พฤศจิกายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "12" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน ธันวาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			default : $txt = $txt . "ผิดพลาด";
		}
		return $txt ;
	}
	function getColor($_value) {
		switch (substr($_value,1,2)) {
			case "01" : return "ส้ม"; break;
			case "02" : return "ชมพู"; break;
			case "03" : return "ม่วง"; break;
			case "04" : return "เหลือง"; break;
			case "05" : return "เขียว"; break;
			default : return "-";
		}
	}
?>