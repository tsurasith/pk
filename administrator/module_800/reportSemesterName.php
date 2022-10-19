
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.9 แบบรายงานประจำภาคเรียน<br/>(รายชื่อตามระดับชั้นและทั้งโรงเรียน)</strong></font></span></td>
       <td >
		<?php
			$_error = 1;
			if(isset($_REQUEST['acadyear']))
			{
				$acadyear = $_REQUEST['acadyear'];
			}
			if(isset($_REQUEST['acadsemester']))
			{
				$acadsemester = $_REQUEST['acadsemester'];
			}
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_800/reportSemesterName&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportSemesterName&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		 ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_800/reportSemesterName&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_800/reportSemesterName&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form action="" method="post">
		<font color="#000000" size="2"  >
		เลือกระดับชั้น
		  	<select name="roomID" class="inputboxUpdate">
		  		<option value=""></option>
				<option value="3/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/1"?"selected":""?>> มัธยมศึกษาปีที่ 1 </option>
				<option value="3/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/2"?"selected":""?>> มัธยมศึกษาปีที่ 2 </option>
				<option value="3/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/3"?"selected":""?>> มัธยมศึกษาปีที่ 3 </option>
				<option value="4/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/1"?"selected":""?>> มัธยมศึกษาปีที่ 4 </option>
				<option value="4/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/2"?"selected":""?>> มัธยมศึกษาปีที่ 5 </option>
				<option value="4/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/3"?"selected":""?>> มัธยมศึกษาปีที่ 6 </option>
				<option value="all" <?=isset($_POST['roomID'])&&$_POST['roomID']=="all"?"selected":""?>> ทั้งโรงเรียน </option>
			</select> 
			 <input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			 <input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		  </font>
		  </form>
	  </td>
    </tr>
  </table>

  <?php
  $xlevel;
  $xyearth;
  if($_POST['roomID'] != "all")
  {
  	$xlevel = substr($_POST['roomID'],0,1);;
	$xyearth = substr($_POST['roomID'],2,1);
  }
  ?>

  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%" >
    <tr>
	<?php
		if(isset($_POST['search']) && $_POST['roomID'] == "")
		{
			echo "<td align='center'><br/><font color='red'>กรุณาเลือกระดับชั้นที่ต้องการทราบข้อมูลก่อน !</font></td></tr>";
		}
		else if(isset($_POST['search']) && $_POST['roomID'] != "")
		{
			$sqlStudent = "";
			if($_POST['roomID'] != "all")
			{
				$sqlStudent = "select students.id,students.prefix,students.firstname,students.lastname ,students.xyearth,students.xlevel,students.room,students.studstatus ,
								  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
								  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
								  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
								  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
								  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
								  count(class_id) as sum
								from students  left outer join student_800 on students.id = student_800.student_id
								where xyearth = '" . $xyearth . "' and xlevel = '" . $xlevel ."' and xedbe = '" .$acadyear . "'
									  and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' ";
				if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2)";
				$sqlStudent .= " group by id order by a,e desc,room,sex,id";
			}
			else
			{
				$sqlStudent = "select students.id,students.prefix,students.firstname,students.lastname ,students.xyearth,students.xlevel,students.room,students.studstatus ,
								  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
								  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
								  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
								  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
								  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
								  count(class_id) as sum
								from students  left outer join student_800 on students.id = student_800.student_id
								where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' and xedbe = '" .$acadyear . "' ";
				if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
				$sqlStudent .= "group by id order by a,e desc,xlevel,xyearth,room,sex,id";			
			}
			$resStudent = mysql_query($sqlStudent);
			$ordinal = 1;
			$totalRows = mysql_num_rows($resStudent);
			if($totalRows == 0)
			{
				echo "<br/><br/><center><font color='red'>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</font></center>";
				$error = 0;
			}
			else{
	?>	 
      <th colspan="12" align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>
        รายงานการเข้าร่วมกิจกรรมหน้าเสาธงนักเรียนชั้นมัธยมศึกษาปีที่
        <?php echo displayXyear($_POST['roomID']); ?>
        <br/>
        ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
		<br/>
      </th>
    </tr>
    <tr> 
		<td class="key" width="40px" align="center" rowspan="2">เลขที่</td>
      	<td class="key" width="80px" align="center" rowspan="2">เลขประจำตัว</td>
      	<td class="key" width="200px" align="center" rowspan="2">ชื่อ - นามสกุล</td>
		<td class="key" width="40px" align="center" rowspan="2">ห้อง</td>
		<td class="key" width="100px"  align="center" rowspan="2">สถานภาพ<br/>ปัจจุบัน</td>
		<td class="key" align="center" colspan="6">การมาเข้าแถว</td>
		<td class="key" rowspan="2" align="center" width="70px">ร้อยละ<br/>การเข้าร่วม</td>
    </tr>
	<tr>
		<td class="key" width="50px" align="center">มา</td>
		<td class="key" width="50px" align="center">กิจกรรม</td>
		<td class="key" width="50px" align="center">สาย</td>
		<td class="key" width="50px" align="center">ลา</td>
		<td class="key" width="50px" align="center">ขาด</td>
		<td class="key" width="50px" align="center">รวม</td>
	</tr>
	<? $_x = 0; ?>
	<? for($i = 0; $i < $totalRows ; $i++) { ?>
		<tr <?=$_x<5?"":"bgcolor=\"#EFFEFE\""?>>
		<? $dat = mysql_fetch_array($resStudent); ?>
		<td align="center"><?=$ordinal?></td>
		<td align="center"><?=$dat['id']?></td>
		<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
		<td align="center"><?=displayRoomTable($dat['xlevel'] , $dat['xyearth']) . "/" .$dat['room']?></td>
		<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
		<td align="center"><?=$dat['a']==0?"-":$dat['a']?></td>
		<td align="center"><?=$dat['b']==0?"-":$dat['b']?></td>
		<td align="center"><?=$dat['c']==0?"-":$dat['c']?></td>
		<td align="center"><?=$dat['d']==0?"-":$dat['d']?></td>
		<td align="center"><?=$dat['e']==0?"-":$dat['e']?></td>
		<td align="center"><?=$dat['sum']?></td>
		<td align="right"><b><?=number_format(100*$dat['a']/$dat['sum'],0,'.',',')?>%</b></td>
		</tr>
		<? $ordinal++; $_x++; ?>
		<?	if($_x == 10){$_x = 0;}
			else{}
		} mysql_free_result($resStudent);
	  }//ปิด if-else ตรวจสอบข้อมูลในฐานข้อมูล
	}//ปิด if-else ตรวจสอบการเลือกวันที่	?>
</table>

</div>

