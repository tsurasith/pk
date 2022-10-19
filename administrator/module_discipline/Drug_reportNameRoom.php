
<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>4.3 รายงานคัดกรองยาเสพติด(รายชื่อตามห้องเรียน)</strong></font></span></td>
      <td >
	  	<?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_discipline/Drug_reportNameRoom&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/Drug_reportNameRoom&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/Drug_reportNameRoom&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/Drug_reportNameRoom&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form action="" method="post">
		<font color="#000000" size="2">
			 เลือกห้อง
		 <?php 
				$error = 1;
				$sql_Room = "select room_id from rooms where acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "'  order by room_id";
				//echo $sql_Room ;
				$resRoom = mysql_query($sql_Room);			
		?>
		  <select name="roomID" class="inputboxUpdate">
			<option> &nbsp; &nbsp; &nbsp; </option>
			<?php
				while($dat = mysql_fetch_assoc($resRoom))
				{
					$_select = (isset($_POST['roomID'])&&$_POST['roomID'] == $dat['room_id']?"selected":"");
					echo "<option value=\"" . $dat['room_id'] . "\" $_select>";
					echo getFullRoomFormat($dat['room_id']);
					echo "</option>";
				} mysql_free_result($resRoom);	?>
			</select>
			 เดือน
			<select name="month" class="inputboxUpdate">
			 	<option value=""></option>
				<?php
					$_sqlMonth = "select distinct month(task_date)as m,year(task_date)+543 as y
									from student_drug_task where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
									order by year(task_date),month(task_date)";
					$_resMonth = mysql_query($_sqlMonth);
					while($_datMonth = mysql_fetch_assoc($_resMonth))
					{
						$_select = (isset($_POST['month'])&&$_POST['month'] == $_datMonth['m']?"selected":"");
						echo "<option value=\"" . $_datMonth['m'] . "\" $_select >" . displayMonth($_datMonth['m']) . ' ' . $_datMonth['y'] . "</option>";
					} mysql_free_result($_resMonth);
				?>
			 </select> 
			<input type="submit" value="เรียกดู" class="button" name="search"/>
			 <br/><input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		  </font>
		  </form>
	</td>
    </tr>
  </table>
  <br/>
  <?php
  	  $xlevel  = getXlevel($_POST['roomID']);
	  $xyearth = getXyearth($_POST['roomID']);
	  $room    = getRoom($_POST['roomID']);
  ?>
<table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%" >
    <tr>
	<?php
		if(isset($_POST['search']) && ($_POST['month'] == "" || $_POST['roomID']=="")){ echo "<td align='center'><br/><font color='red'>กรุณาเลือก ห้องเรียน และ เดือน ให้ครบถ้วน</font></td></tr>"; }
		if(isset($_POST['search']) && $_POST['month'] != "" && $_POST['roomID']!="")
		{
			$_sql = "select id,prefix,firstname,lastname,p_village,studstatus,nickname,
					  sum(if(drugtype=00,druglevel,null)) as tobacco,
					  sum(if(drugtype=01,druglevel,null)) as drink,
					  sum(if(drugtype=02,druglevel,null)) as amphet,
					  sum(if(drugtype=03,druglevel,null)) as glue
					 from student_drug right outer join students on (student_id = id)
					 where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' 
					 	and check_date = '" . $_POST['month'] . "' and xEDBE = '" . $acadyear . "' 
						and xlevel = '" . $xlevel . "' and xyearth = '" . $xyearth ."' and room = '" . $room . "'
					group by id
					order by sex,id";
			@$_res = mysql_query($_sql);
			if(@mysql_num_rows($_res)<=0){ echo "<td align='center'><br/><font color='red'>ยังไม่มีการบันทึกข้อมูลในรายการที่เลือก</font></td></tr>"; }
			else{
	?>	 
		  <th align="center" colspan="10">
			<img src="../images/school_logo.gif" width="120px">
			<br/>
			รายงานผลการคัดกรองสารเสพติด ชั้นมัธยมศึกษาปีที่ <?=getFullRoomFormat($_POST['roomID'])?><br/>
			ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
			<br/>ประจำเดือน <?=displayMonth($_POST['month'])?>
		  </th>
    </tr>
	<tr align="center">
		<td class="key" width="25px">ที่</td>
		<td class="key" width="80px">เลขประจำตัว</td>
		<td class="key" width="180px">ชื่อ-สกุล</td>
		<td class="key" width="50px">ชื่อเล่น</td>
		<td class="key" width="100px">สถานภาพ<br/>ปัจจุบัน</td>
		<td class="key" width="170px">หมู่บ้าน</td>
		<td class="key" width="50px">บุหรี่</td>
		<td class="key" width="50px">เหล้า</td>
		<td class="key" width="50px">ยาบ้า</td>
		<td class="key" width="50px">สารระเหย</td>
	</tr>
	<? $_i = 1; ?>
	<? while($_dat = mysql_fetch_assoc($_res)){ ?>
	<tr>
		<td align="center"><?=$_i++?></td>
		<td align="center"><?=$_dat['id']?></td>
		<td><?=$_dat['prefix'].$_dat['firstname']. ' ' . $_dat['lastname']?></td>
		<td align="center"><?=$_dat['nickname']?></td>
		<td align="center"><?=displayStudentStatusColor($_dat['studstatus'])?></td>
		<td><?=$_dat['p_village']?></td>
		<td align="center"><?=displayDrugLevel($_dat['tobacco'])?></td>
		<td align="center"><?=displayDrugLevel($_dat['drink'])?></td>
		<td align="center"><?=displayDrugLevel($_dat['amphet'])?></td>
		<td align="center"><?=displayDrugLevel($_dat['glue'])?></td>
	</tr>
	<? } //end while ?>
<?	  }//ปิด else ตรวจสอบข้อมูลในฐานข้อมูล
	}//ปิด if-else ตรวจสอบการเลือกวันที่
	?>
</table>
</div>
<?

	function displayDrugLevel($_value)
	{
		switch($_value){
			case '00' : return "ปกติ"; break;
			case '01' : return "<font color='green'><b>เสี่ยง</b></font>"; break;
			case '02' : return "<font color='orange'><b>เคยลอง</b></font>"; break;
			case '03' : return "<font color='red'><b>ติด</b></font>"; break;
			default : return "ไม่ระบุ"; }
	}

?>