
<link rel="stylesheet" type="text/css" href="module_learn/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_learn/js/calendar.js"></script>

<div id="content">

  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.1 รายงานการเข้าห้องเรียนในแต่ละวันทั้งห้องเรียน</strong></font></span></td>
      <td >
	  	 ปีการศึกษา
        <? if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
					echo "<a href=\"index.php?option=module_learn/reportSubjectDay&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_learn/reportSubjectDay&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
        ภาคเรียนที่ 
        <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_learn/reportSubjectDay&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_learn/reportSubjectDay&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>	<br/>
		 <font  size="2" color="#000000">
		 <form action="" method="post">
		 	วันที่ <input name="date" type="text" id="date" onClick="showCalendar(this.id)" size="10px" maxlength="10" value="<?=(isset($_POST['date'])&&$_POST['date']!=""?$_POST['date']:"")?>" class="inputboxUpdate" /> 
			<?
				$_roomID;
				$_sqlRoom  = "select xyearth,xlevel,room from students where xedbe = '" . $acadyear . "' and id = '" . $_SESSION['username'] . "'";
				
				$_resRoom = mysql_query($_sqlRoom);
				if(@mysql_num_rows($_resRoom) > 0)
				{
					$_dat = mysql_fetch_assoc($_resRoom);
					$_year = $_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3;
					$_room = (int)$_dat['room']<10?"0".$_dat['room']:$_dat['room'];
					$_roomID = $_year.$_room;
				}
				else
				{
					$_roomID = "<font color='red'>ไม่มีข้อมูล</font>";
				}
			?>
			ห้อง <font color="#0000FF"><?=getFullRoomFormat($_roomID)?></font> 
			<input type="hidden" name="roomID" value="<?=$_roomID?>" />
			<input type="submit" name="search" value="สืบค้น" class="button" /><br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		 </form>
		 </font>
	  </td>
    </tr>
  </table>

<? if(isset($_POST['search'])){ ?>
<?	$_sql = "select id,prefix,firstname,lastname,studstatus,
			  sum(if(period = 1,timecheck_id,null)) as p1,
			  sum(if(period = 2,timecheck_id,null)) as p2,
			  sum(if(period = 3,timecheck_id,null)) as p3,
			  sum(if(period = 4,timecheck_id,null)) as p4,
			  sum(if(period = 5,timecheck_id,null)) as p5,
			  sum(if(period = 6,timecheck_id,null)) as p6,
			  sum(if(period = 7,timecheck_id,null)) as p7,
			  sum(if(period = 8,timecheck_id,null)) as p8
			from students right outer join student_learn on id = student_id
			where xEDBE = '". $acadyear . "' 
				and xLevel = '" . getXlevel($_POST['roomID']) . "' 
				and xYearth = '". getXyearth($_POST['roomID']) ."' 
				and room = '" . getRoom($_POST['roomID']) ."'
				and acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "' 
				and class_id = '". $_POST['roomID'] ."' and check_date = '" . $_POST['date'] . "' ";
	if($_POST['studstatus']=="1,2") $_sql .= " and studstatus in (1,2) ";				
	$_sql .= " group by id order by sex,id";
	$_res = mysql_query($_sql); ?>
	<? if(@mysql_num_rows($_res)>0) { ?>
			<table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" >
			<tr>
			<th colspan="12" align="center">
				<img src="../images/school_logo.gif" width="120px">
				<br/>
				รายงานการเข้าชั้นเรียนของนักเรียนชั้นมัธยมศึกษาปีที่ <?=getFullRoomFormat($_POST['roomID'])?><br/>
				ประจำวันที่ <?=displayDate($_POST['date'])?><br/>
			  </th>
			</tr>
			<tr> 
				<td class="key" width="40px" align="center" rowspan="2">เลขที่</td>
				<td class="key" width="80px" align="center" rowspan="2">เลขประจำตัว</td>
				<td class="key" width="220px" align="center" rowspan="2">ชื่อ - นามสกุล</td>
				<td class="key" width="100px"  align="center" rowspan="2">สถานภาพ<br/>ปัจจุบัน</td>
				<td class="key" align="center" colspan="8">คาบเรียนที่</td>
			</tr>
			<tr height="30px" align="center">
				<td class="key" width="45px">1</td>
				<td class="key" width="45px">2</td>
				<td class="key" width="45px">3</td>
				<td class="key" width="45px">4</td>
				<td class="key" width="45px">5</td>
				<td class="key" width="45px">6</td>
				<td class="key" width="45px">7</td>
				<td class="key" width="45px">8</td>
			</tr>
			<? $_i = 1; ?>
			<? while($_dat = mysql_fetch_assoc($_res)){ ?>
			<tr>
				<td align="center"><?=$_i++?></td>
				<td align="center"><?=$_dat['id']?></td>
				<td><?=$_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname']?></td>
				<td align="center"><?=displayStudentStatusColor($_dat['studstatus'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p1'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p2'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p3'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p4'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p5'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p6'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p7'])?></td>
				<td align="center"><?=displayTimecheckColor($_dat['p8'])?></td>
			</tr>
			<? } mysql_free_result($_res); //end while ?>
		 </table>
<?	} else { //end chekc_rows	 ?>
		<center><font color="#FF0000"><br/><br/>ไม่พบข้อมูลที่ค้นตามเงื่อนไข กรุณาทดลองใหม่อีกครั้ง</font></center>
<?	} //end else ?>
<? } //end if($_POST[''] ?>  

</div>

