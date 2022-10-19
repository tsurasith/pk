<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.1.2 รายชื่อนักเรียนตาม น้ำหนัก ส่วนสูง<br/> หมู่โลหิตและดัชนีมวลกาย (รายระดับชั้น)</strong></font></span></td>
      <td >
	  <? if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_history/reportWHLevel&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/reportWHLevel&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
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
			</select> 
	  		<input type="submit" value="สืบค้น" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			</font>
	   </td>
    </tr>
  </table>
  </form>

<? if(isset($_POST['search']) && $_POST['roomID'] == ""){ ?>
	<br/><center><font color="#FF0000">กรุณาเลือกระดับชั้นที่ต้องการทราบข้อมูลก่อน</font></center>
<? } else if(isset($_POST['search']) && $_POST['roomID'] != "") { ?>

  <table class="admintable" width="100%" cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th colspan="10" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			ข้อมูลสุขภาพ นักเรียนชั้นมัธยมศึกษาปีที่ <?=displayXyear($_POST['roomID'])?><br/>
			ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
	  </th>
    </tr>
    <tr> 
		<td class="key" width="30px" align="center">เลขที่</td>
      	<td class="key" width="75px" align="center">เลขประจำตัว</td>
      	<td class="key" width="195px" align="center">ชื่อ - นามสกุล</td>
		<td class="key" width="35px" align="center">ห้อง</td>
      	<td class="key" width="100px"  align="center">สถานภาพ</td>
		<td class="key" width="40px" align="center">หมู่<br/>โลหิต</td>
		<td class="key" width="60px" align="center">น้ำหนัก<br/>(กก.)</td>
		<td class="key" width="60px" align="center">ส่วนสูง<br/>(ซม.)</td>
      	<td class="key" width="50px" align="center">BMI</td>
      	<td class="key" align="center">ความหมาย<br/>ดัชนีมวลกาย</td>
    </tr>
	<?php
		$sqlStudent = "select id,prefix,firstname,lastname,xlevel,xyearth,room,studstatus,blood_group,weight,height,bmi
						from students 
						where xlevel = '". substr($_POST['roomID'],0,1) . "' and xyearth = '" . substr($_POST['roomID'],2,1) . "' 
								and xedbe = '" . $acadyear . "' ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		$sqlStudent .= "order by room,sex,id";
		
		$resStudent = mysql_query($sqlStudent);
		$ordinal = 1;
		$totalRows = mysql_num_rows($resStudent);
		for($i = 0; $i < $totalRows ; $i++)
		{ ?>
			<? $dat = mysql_fetch_array($resStudent); ?>
			<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">	
			<td align="center"><?=$ordinal++?></td>
			<td align="center"><?=$dat['id']?></td>
			<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
			<td align="center"><?=displayXyear($_POST['roomID']).'/'.$dat['room']?></td>
			<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
			<td align="center"><?=$dat['blood_group']!=""?$dat['blood_group']:"-"?></td>
			<td align="center"><?=$dat['weight']>0?number_format($dat['weight'],1,'.',','):"-"?></td>
			<td align="center"><?=$dat['height']>0?number_format($dat['height'],2,'.',','):"-"?></td>
			<td align="center"><?=$dat['bmi']>0?$dat['bmi']:"-"?></td>
			<td align="center"><?=displayBMI($dat['bmi'])?></td>
			</tr>
	<?	} //end_for	?>
</table>
<? } //end if-esle ?>
</div>

