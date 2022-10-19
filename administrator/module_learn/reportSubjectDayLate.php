
<link rel="stylesheet" type="text/css" href="module_learn/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_learn/js/calendar.js"></script>

<div id="content">

  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.1 รายงานการเข้าเรียนสายของนักเรียน<br/>แบบรายชื่อ [รายวัน] </strong></font></span></td>
      <td >
	  	 ปีการศึกษา
        <?php  
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
					echo "<a href=\"index.php?option=module_learn/reportSubjectDayLate&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_learn/reportSubjectDayLate&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
        ภาคเรียนที่ 
        <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else { echo " <a href=\"index.php?option=module_learn/reportSubjectDayLate&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ; }
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_learn/reportSubjectDayLate&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>	<br/>
		 <font  size="2" color="#000000">
		 <form action="" method="post">
		 	เลือกวันที่ <input name="date" type="text" id="date" onClick="showCalendar(this.id)" size="10px" maxlength="10" value="<?=(isset($_POST['date'])&&$_POST['date']!=""?$_POST['date']:"")?>" class="inputboxUpdate" /> 
			ระดับชั้น  
			<select name="roomID" class="inputboxUpdate">
				<option value=""></option>
				<option value="3/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/1"?"selected":""?>> มัธยมศึกษาปีที่ 1 </option>
				<option value="3/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/2"?"selected":""?>> มัธยมศึกษาปีที่ 2 </option>
				<option value="3/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/3"?"selected":""?>> มัธยมศึกษาปีที่ 3 </option>
				<option value="4/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/1"?"selected":""?>> มัธยมศึกษาปีที่ 4 </option>
				<option value="4/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/2"?"selected":""?>> มัธยมศึกษาปีที่ 5 </option>
				<option value="4/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/3"?"selected":""?>> มัธยมศึกษาปีที่ 6 </option>
				<option value="all" <?=isset($_POST['roomID'])&&$_POST['roomID']=="all"?"selected":""?>> ทั้งโรงเรียน </option>
			</select> <input type="submit" name="search" value="เรียกดู" class="button" /><br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		 </form>
		 </font>
	  </td>
    </tr>
  </table>

<? if(isset($_POST['search'])){ ?>
<?	$_sql = "select id,prefix,firstname,lastname,xlevel,xyearth,room,studstatus,
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
				and acadyear = '". $acadyear . "' and acadsemester = '" . $acadsemester . "' 
				and timecheck_id != '00'
				and check_date = '" . $_POST['date'] . "' ";
	if($_POST['roomID']!="all") $_sql .= " and xLevel = '" . (int)substr($_POST['roomID'],0,1) . "' and xYearth = '". (int)substr($_POST['roomID'],2,1) ."' ";
	if($_POST['studstatus']=="1,2") $_sql .= " and studstatus in (1,2) ";				
	$_sql .= " group by id order by xlevel,xyearth,room,sex,id";
	$_res = mysql_query($_sql); ?>
	<? if(@mysql_num_rows($_res)>0) { ?>
			<table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%" >
			<tr>
			<th colspan="13" align="center">
				<img src="../images/school_logo.gif" width="120px">
				<br/>
				รายงานการเข้าชั้นเรียน "ขาด" และ "สาย"<br/>
				ของนักเรียนชั้นมัธยมศึกษาปีที่ <?=displayXyear($_POST['roomID'])?><br/>
				ประจำวันที่ <?=displayFullDate($_POST['date'])?><br/>
			  </th>
			</tr>
			<tr> 
				<td class="key" width="35px" align="center" rowspan="2">เลขที่</td>
				<td class="key" width="85px" align="center" rowspan="2">เลขประจำตัว</td>
				<td class="key" width="220px" align="center" rowspan="2">ชื่อ - นามสกุล</td>
				<td class="key" width="35px" align="center" rowspan="2">ห้อง</td>
				<td class="key" width="100px"  align="center" rowspan="2">สถานภาพ<br/>ปัจจุบัน</td>
				<td class="key"  align="center" colspan="8">คาบเรียนที่</td>
			</tr>
			<tr align="center">
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
				<td align="center"><?=($_dat['xlevel']==4?$_dat['xyearth']+3:$_dat['xyearth']) . '/' . $_dat['room']?></td>
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
		<table width="100%" align="center">
			<tr>
				<td align="center"><font color="#FF0000"><br/>ไม่พบข้อมูลที่ค้นตามเงื่อนไข กรุณาทดลองใหม่อีกครั้ง</font></td>
			</tr>
		</table>
<?	} //end else ?>
<? } //end if($_POST[''] ?>  

</div>
