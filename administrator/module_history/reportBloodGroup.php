<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.1.6 รายชื่อนักเรียนแยกตามหมู่โลหิต<br/>(รายระดับชั้น)</strong></font></span></td>
      <td >
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_history/reportBloodGroup&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/reportBloodGroup&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
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
				<option value="all" <?=isset($_POST['roomID'])&&$_POST['roomID']=="all"?"selected":""?>> ทั้งโรงเรียน </option>
			</select> 
		หมู่โลหิต
			<select name="blood_group" class="inputboxUpdate">
				<option value=""></option>
				<option value="เอ" <?=isset($_POST['blood_group'])&&$_POST['blood_group']=="เอ"?"selected":""?>>เอ</option>
				<option value="บี" <?=isset($_POST['blood_group'])&&$_POST['blood_group']=="บี"?"selected":""?>>บี</option>
				<option value="เอบี" <?=isset($_POST['blood_group'])&&$_POST['blood_group']=="เอบี"?"selected":""?>>เอบี</option>
				<option value="โอ" <?=isset($_POST['blood_group'])&&$_POST['blood_group']=="โอ"?"selected":""?>>โอ</option>
				<option value="ไม่ระบุ" <?=isset($_POST['blood_group'])&&$_POST['blood_group']=="ไม่ระบุ"?"selected":""?>>ไม่ระบุ</option>
				<option value="all" <?=isset($_POST['blood_group'])&&$_POST['blood_group']=="all"?"selected":""?>>ทั้งหมด</option>
			</select>
	  		<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			</font>
	   </td>
    </tr>
  </table>
  </form>
<? if(isset($_POST['search']) && (($_POST['roomID'] != "" && $_POST['blood_group'] == "")||($_POST['roomID'] == "" && $_POST['blood_group'] != ""))){ ?>
	<br/><br/><center><font color="#FF0000">กรุณาเลือก ระดับชั้น และ หมู่โลหิต ที่ท่านต้องการทราบข้อมูลก่อน</font></center>
<? } //end if ?>

<? if(isset($_POST['search']) && $_POST['roomID'] != "" && $_POST['blood_group']!= ""){ ?>
  <table class="admintable" width="100%" cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th colspan="10" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			ข้อมูลสุขภาพ นักเรียนชั้นมัธยมศึกษาปีที่ <?=displayXyear($_POST['roomID'])?> 
            และ หมู่โลหิต  <?=isset($_POST['search'])&&$_POST['blood_group']!="all"?$_POST['blood_group']:"ทั้งหมด"?><br/>
			ปีการศึกษา <?php echo $acadyear; ?>
		</th>
    </tr>
    <tr> 
		<td class="key" width="30px" align="center">เลขที่</td>
      	<td class="key" width="75px" align="center">เลขประจำตัว</td>
      	<td class="key" width="185px" align="center">ชื่อ - นามสกุล</td>
		<td class="key" width="30px" align="center">ห้อง</td>
      	<td class="key" width="100px"  align="center">สถานภาพ</td>
		<td class="key" width="50px" align="center">หมู่<br/>โลหิต</td>
		<td class="key" width="70px" align="center">น้ำหนัก<br/>(กก.)</td>
		<td class="key" width="70px" align="center">ส่วนสูง<br/>(ซม.)</td>
      	<td class="key" width="50px" align="center">BMI</td>
      	<td class="key" align="center">ความหมาย<br/>ดัชนีมวลกาย</td>
    </tr>
	<?php
		$sqlStudent = "select id,prefix,firstname,lastname,xlevel,xyearth,room,studstatus,blood_group,weight,height,bmi	from students ";
		if($_POST['roomID']!="all"){$sqlStudent .=  " where xlevel = '". substr($_POST['roomID'],0,1) . "' and xyearth = '" . substr($_POST['roomID'],2,1) . "' and xedbe = '" . $acadyear . "' ";}
		else {$sqlStudent .= " where xedbe = '" . $acadyear . "' " ;}
		if($_POST['blood_group']!="all"){$sqlStudent .= genBGSQL($_POST['blood_group']);}
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		$sqlStudent .= "order by xlevel,xyearth,room,sex,id";
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
			<td align="center"><?=($dat['xlevel']==3?$dat['xyearth']:$dat['xyearth']+3) . '/' . $dat['room']?></td>
			<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
			<td align="center"><?=$dat['blood_group']!=""?$dat['blood_group']:"-"?></td>
			<td align="center"><?=$dat['weight']>0?number_format($dat['weight'],1,'.',','):"-"?></td>
			<td align="center"><?=$dat['height']>0?number_format($dat['height'],2,'.',','):"-"?></td>
			<td align="center"><?=$dat['bmi']>0?$dat['bmi']:"-"?></td>
			<td align="center"><?=displayBMI($dat['bmi'])?></td>
			</tr>
	<?	} //end_for	?>
	</table>
<? } ?>
<? if($_POST['roomID']=="" && $_POST['blood_group']=="") {//end_if isset($_POST['search']) ?>
	<table width="100%">
		<tr>
			<th colspan="10" align="center">
	  			<img src="../images/school_logo.gif" width="120px"><br/>
				ข้อมูลสุขภาพ นักเรียนชั้นมัธยมศึกษาปีที่ <?=displayXyear($_POST['roomID'])?> <br/>
				ปีการศึกษา <?php echo $acadyear; ?>
			</th>
		</tr>
		<tr>
			<td align="center">
				<? $_result = mysql_query("select blood_group,
								  sum(if(sex=1,1,0)) as Male,
								  sum(if(sex=2,1,0)) as Female,
								  count(sex) as Sums
								from students
								where xEDBE = '" . $acadyear ."'" . (isset($_POST['studstatus'])=="1,2"?" and studstatus in (1,2) ":"") . "
								group by blood_group
								order by blood_group desc"); ?>
				<table align="center" class="admintable">
					<tr>
						<td class="key" align="center" rowspan="2" width="120px">หมู่โลหิต</td>
						<td class="key" align="center" colspan="2">เพศ</td>
						<td class="key" align="center" rowspan="2" width="80px">รวม</td>
					</tr>
					<tr>
						<td class="key" align="center" width="60px">ชาย</td>
						<td class="key" align="center" width="60px">หญิง</td>
					</tr>
					<? $_male = 0 ; $_female = 0; ?>
					<? while($_dat = mysql_fetch_assoc($_result)) { ?>
					<tr bgcolor="#FFFFFF">
						<td style="padding-left:20px">กรุ๊ป <b><?=($_dat['blood_group']!=""?$_dat['blood_group']:"ไม่ระบุ")?></b></td>
						<td style="padding-right:20px" align="right"><?=$_dat['Male']==0?"-":number_format($_dat['Male'],0,'',',')?></td>
						<td style="padding-right:20px" align="right"><?=$_dat['Female']==0?"-":number_format($_dat['Female'],0,'',',')?></td>
						<td align="right" style="padding-right:25px"><?=number_format($_dat['Sums'],0,'',',')?></td>
					</tr>
					<? $_male += $_dat['Male']; $_female += $_dat['Female']; ?>
					<? } mysql_free_result($_result); ?>
					<tr height="30px">
					  <td class="key" align="center">รวม</td>
					  <td class="key" style="padding-right:20px" align="right"><?=number_format($_male,0,'',',')?></td>
					  <td class="key" style="padding-right:20px" align="right"><?=number_format($_female,0,'',',')?></td>
					  <td class="key" style="padding-right:25px" align="right"><?=number_format($_male + $_female,0,'',',')?></td>
				  </tr>
				</table>
			</td>
		</tr>
	</table>
<? } //end_else ?>

  
</div>
<?php
	function genBGSQL($_value)
	{
		if($_value != "ไม่ระบุ") {return " and blood_group = '"  . $_value . "' " ;}
		else {return " and blood_group is null ";}
	}
?>

