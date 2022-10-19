<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.1.5 รายชื่อนักเรียนแยกตามดัชนีมวลกาย <br/>(รายระดับชั้น)</strong></font></span></td>
      <td >
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_history/reportBMILevel&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/reportBMILevel&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
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
		ดัชนีมวลกาย
			<select name="bmi" class="inputboxUpdate">
				<option value=""></option>
				<option value="1" <?=isset($_POST['bmi'])&&$_POST['bmi']=="1"?"selected":""?>>ผอม</option>
				<option value="2" <?=isset($_POST['bmi'])&&$_POST['bmi']=="2"?"selected":""?>>ปกติ</option>
				<option value="3" <?=isset($_POST['bmi'])&&$_POST['bmi']=="3"?"selected":""?>>น้ำหนักเกิน</option>
				<option value="4" <?=isset($_POST['bmi'])&&$_POST['bmi']=="4"?"selected":""?>>อ้วนเกินไป</option>
				<option value="5" <?=isset($_POST['bmi'])&&$_POST['bmi']=="5"?"selected":""?>>ทั้งหมด</option>
			</select><br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา 
			<input type="submit" value="เรียกดู" class="button" name="search"/> 
			</font>
	   </td>
    </tr>
  </table>
  </form>
<? if(isset($_POST['search']) && (($_POST['roomID'] != "" && $_POST['bmi'] == "")||($_POST['roomID'] == "" && $_POST['bmi'] != ""))){ ?>
	<br/><br/><center><font color="#FF0000">กรุณาเลือก ระดับชั้น และ ดัชนีมวลกาย ที่ท่านต้องการทราบข้อมูลก่อน</font></center>
<? } //end if ?>

<? if(isset($_POST['search']) && $_POST['roomID'] != "" && $_POST['bmi'] != ""){ ?>
  <table class="admintable" width="100%" cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th colspan="10" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			ข้อมูลสุขภาพ นักเรียนชั้นมัธยมศึกษาปีที่ <?=displayXyear($_POST['roomID'])?>
            <?=$_POST['roomID']!=""&&$_POST['bmi']!=""?"และ ดัชนีมวลกาย  ". displayPOSTBMI($_POST['bmi']):""?><br/>
			ปีการศึกษา <?php echo $acadyear; ?>	  </th>
    </tr>
    <tr> 
		<td class="key" width="30px" align="center">เลขที่</td>
      	<td class="key" width="75px" align="center">เลขประจำตัว</td>
      	<td class="key" width="185px" align="center">ชื่อ - นามสกุล</td>
		<td class="key" width="30" align="center">ห้อง</td>
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
		if($_POST['bmi']!=""){$sqlStudent .= genBMISQL($_POST['bmi']);}
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
<? if($_POST['roomID'] == "" && $_POST['bmi'] == "") {//end_if isset($_POST['search']) ?>
	<table width="100%">
		<tr> 
			<th align="center">
				<img src="../images/school_logo.gif" width="120px"><br/>
				ข้อมูลสุขภาพ <?=displayXyear($_POST['roomID'])?> <?=$_POST['roomID']!=""&&$_POST['bmi']!=""?"และ ดัชนีมวลกาย  ".displayBMI($_POST['bmi']+14+($_POST['bmi']*$_POST['bmi'])):""?><br/>
				ปีการศึกษา <?php echo $acadyear; ?>
			</th>
		</tr>
		<tr>
			<td colspan="10" align="center">
				<? $_result = mysql_query("select xlevel,xyearth,
								  sum(if(bmi>=30,1,0)) as a,
								  sum(if(bmi>=25 and bmi<30,1,0)) as b,
								  sum(if(bmi>=18.5 and bmi<25,1,0)) as c,
								  sum(if(bmi>0 and bmi<18.5,1,0)) as d,
								  sum(if(bmi=0 or bmi is null,1,0)) as e
								from students
								where xEDBE = '" . $acadyear ."'" . (isset($_POST['studstatus'])=="1,2"?" and studstatus in (1,2) ":"") . "
								group by xlevel,xyearth
								order by xlevel,xyearth"); ?>
				<table class="admintable">
					<tr>
						<td class="key" align="center" rowspan="2" width="170px">ระดับชั้น</td>
						<td class="key" align="center" colspan="5">จำนวน(คน)</td>
						<td class="key" align="center" rowspan="2" width="100px">รวม</td>
					</tr>
					<tr>
						<td class="key" align="center" width="70px">อ้วนเกินไป</td>
						<td class="key" align="center" width="70px">น้ำหนักเกิน</td>
						<td class="key" align="center" width="70px">สมส่วน</td>
						<td class="key" align="center" width="70px">ผอม</td>
						<td class="key" align="center" width="70px">ไม่ระบุ</td>
					</tr>
					<? $_a = 0;$_b = 0; $_c = 0; $_d = 0; $_e = 0; $_sum = 0; ?>
					<? while($_dat = mysql_fetch_assoc($_result)) { ?>
					<tr bgcolor="#FFFFFF">
						<td style="padding-left:20px">ชั้นมัธยมศึกษาปีที่ <?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?></td>
						<td style="padding-right:30px" align="right"><?=$_dat['a']==0?"-":number_format($_dat['a'],0,'',',')?></td>
						<td style="padding-right:30px" align="right"><?=$_dat['b']==0?"-":number_format($_dat['b'],0,'',',')?></td>
						<td style="padding-right:30px" align="right"><?=$_dat['c']==0?"-":number_format($_dat['c'],0,'',',')?></td>
						<td style="padding-right:30px" align="right"><?=$_dat['d']==0?"-":number_format($_dat['d'],0,'',',')?></td>
						<td style="padding-right:30px" align="right"><?=$_dat['e']==0?"-":number_format($_dat['e'],0,'',',')?></td>
						<td align="right" style="padding-right:25px"><?=number_format($_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']+$_dat['e'],0,'',',')?></td>
						<? $_a += $_dat['a']; $_b += $_dat['b']; $_c += $_dat['c'];
						   $_d += $_dat['d']; $_e += $_dat['e']; $_sum += ($_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']+$_dat['e']); ?>
					</tr>
					<? } mysql_free_result($_result); ?>
					<tr height="30px">
					  <td class="key" align="center">รวม</td>
					  <td class="key" style="padding-right:30px" align="right"><?=$_a==0?"-":number_format($_a,0,'',',')?></td>
					  <td class="key" style="padding-right:30px" align="right"><?=$_b==0?"-":number_format($_b,0,'',',')?></td>
					  <td class="key" style="padding-right:30px" align="right"><?=$_c==0?"-":number_format($_c,0,'',',')?></td>
					  <td class="key" style="padding-right:30px" align="right"><?=$_d==0?"-":number_format($_d,0,'',',')?></td>
					  <td class="key" style="padding-right:30px" align="right"><?=$_e==0?"-":number_format($_e,0,'',',')?></td>
					  <td class="key" align="right" style="padding-right:25px"><?=$_sum==0?"-":number_format($_sum,0,'',',')?></td>
				  </tr>
				</table>
			</td>
		</tr>
	</table>
<? } //end_else ?>  
</div>

<?
	function genBMISQL($_value)
	{
		switch ($_value) {
			case "1" : return "and bmi between 1 and 18.499"; break;
			case "2" : return "and bmi between 18.5 and 24.999"; break;
			case "3" : return "and bmi between 25.00 and 29.999"; break;
			case "4" : return "and bmi >= 30.00"; break;
			default : return "";
		}
	}
	
	function displayPOSTBMI($_value)
	{
		switch ($_value) {
			case "1" : return "ผอม"; break;
			case "2" : return "ปกติ"; break;
			case "3" : return "น้ำหนักเกิน"; break;
			case "4" : return "อ้วนเกินไป"; break;
			default : return "ทั้งหมด";
		}
	}
?>