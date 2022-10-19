<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.2.1 รายชื่อนักเรียนตามการพักอาศัยของนักเรียน<br/>(รายระดับชั้น)</strong></font></span></td>
      <td >
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_history/reportStayLevel&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/reportStayLevel&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	  	<font color="#000000" size="2" >
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
			</select><br/>
		การพักอาศัย
			<select name="inservice" class="inputboxUpdate">
				<option value=""></option>
				<? $_resInService = mysql_query("SELECT * FROM ref_inservice"); ?>
				<? while($_datInService = mysql_fetch_assoc($_resInService)) {  ?>
						<option value="<?=$_datInService['service_id']?>" <?=($_POST['inservice']==$_datInService['service_id']?"SELECTED":"")?>><?=$_datInService['service_description']?></option>
				<?	} mysql_free_result($_resInService); ?>
				<option value="all" <?=isset($_POST['search'])&&$_POST['inservice']=="all"?"selected":""?>>ทั้งหมด</option>
			</select>
	  		<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			</font>
	   </td>
    </tr>
  </table>
  </form>
<? if(isset($_POST['search']) && (($_POST['roomID'] != "" && $_POST['inservice'] == "") || ($_POST['roomID']=="" && $_POST['inservice']!=""))) { ?>
		<br/><br/><center><font color="#FF0000">กรุณาเลือก ระดับชั้น และ การพักอาศัย ที่ท่านต้องการทราบข้อมูลก่อน</font></center>
<? } ?>

<? if(isset($_POST['search']) && $_POST['roomID'] != "" && $_POST['inservice'] != ""){ ?>
  <table class="admintable">
    <tr> 
      <th colspan="7" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			ข้อมูลการพักอาศัย <?=displayXyear($_POST['roomID'])?>  <?=isset($_POST['search'])&&$_POST['inservice']!=""?displayInservice($_POST['inservice']):""?><br/>
			ปีการศึกษา <?=$acadyear?>	  </th>
    </tr>
    <tr> 
		<td class="key" width="30px" align="center">เลขที่</td>
      	<td class="key" width="75px" align="center">เลขประจำตัว</td>
      	<td class="key" width="185px" align="center">ชื่อ - นามสกุล</td>
		<td class="key" width="30" align="center">ห้อง</td>
      	<td class="key" width="100px"  align="center">สถานภาพ</td>
		<td class="key" width="140px" align="center">รายได้<br/>ผู้ปกครอง</td>
      	<td class="key" width="140px" align="center">การเดินทางมาโรงเรียน</td>
    </tr>
	<?php
		$sqlStudent = "select id,prefix,firstname,lastname,xlevel,xyearth,room,studstatus,a_earn,travelby from students ";
		if($_POST['roomID']!="all"){$sqlStudent .=  " where xlevel = '". substr($_POST['roomID'],0,1) . "' and xyearth = '" . substr($_POST['roomID'],2,1) . "' and xedbe = '" . $acadyear . "' ";}
		else {$sqlStudent .= " where xedbe = '" . $acadyear . "' " ;}
		if($_POST['inservice']!="all"){$sqlStudent .= " and inservice = '" . $_POST['inservice'] . "' ";}
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
			<td align="right"><?=$dat['a_earn']>0?number_format($dat['a_earn'],2,'.',','):"-"?></td>
			<td align="center"><?=displayTravel($dat['travelby'])?></td>
			</tr>
	<?	} //end_for	?>
	</table>
<? } else {//end_if isset($_POST['search']) ?>
	<table class="admintable" width="100%">
		<tr>
			<th align="center">
	  			<img src="../images/school_logo.gif" width="120px"><br/>
				ข้อมูลการพักอาศัยของนักเรียน <br/>
				ปีการศึกษา <?=$acadyear?>
			</th>
		</tr>
		<tr>
			<td align="center">
				<? $_result = mysql_query("select xlevel,xyearth,
								  sum(if(inservice=1,1,0)) as a,
								  sum(if(inservice=2,1,0)) as b,
								  sum(if(inservice=3,1,0)) as c,
								  sum(if(inservice=4,1,0)) as d,
								  sum(if(inservice=5,1,0)) as e,
								  sum(if(inservice=0 || inservice is null,1,0)) as f
								from students
								where xEDBE = '" . $acadyear ."'" . (isset($_POST['studstatus'])=="1,2"?" and studstatus in (1,2) ":"") . "
								group by xlevel,xyearth
								order by xlevel,xyearth"); ?>
				<table class="admintable">
					<tr>
						<td class="key" align="center" rowspan="2" width="180px">ระดับชั้น</td>
						<td class="key" align="center" colspan="6">ที่อยู่พักอาศัย(คน)</td>
						<td class="key" align="center" rowspan="2" width="100px">รวม</td>
					</tr>
					<tr>
						<td class="key" align="center" width="70px">ผู้ปกครอง</td>
						<td class="key" align="center" width="70px">บ้านพักครู</td>
						<td class="key" align="center" width="70px">ญาติ</td>
						<td class="key" align="center" width="70px">หอใน ร.ร.</td>
						<td class="key" align="center" width="70px">หอนอก ร.ร.</td>
						<td class="key" align="center" width="70px">ไม่ระบุ</td>
					</tr>
					<? $_a = 0;$_b = 0; $_c = 0; $_d = 0; $_e = 0; $_f=0; $_sum = 0; ?>
					<? while($_dat = mysql_fetch_assoc($_result)) { ?>
					<tr bgcolor="#FFFFFF">
						<td style="padding-left:20px">ชั้นมัธยมศึกษาปีที่ <?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?></td>
						<td style="padding-right:20px" align="right"><?=$_dat['a']==0?"-":number_format($_dat['a'],0,'',',')?></td>
						<td style="padding-right:20px" align="right"><?=$_dat['b']==0?"-":number_format($_dat['b'],0,'',',')?></td>
						<td style="padding-right:20px" align="right"><?=$_dat['c']==0?"-":number_format($_dat['c'],0,'',',')?></td>
						<td style="padding-right:20px" align="right"><?=$_dat['d']==0?"-":number_format($_dat['d'],0,'',',')?></td>
						<td style="padding-right:20px" align="right"><?=$_dat['e']==0?"-":number_format($_dat['e'],0,'',',')?></td>
						<td style="padding-right:20px" align="right"><?=$_dat['f']==0?"-":number_format($_dat['f'],0,'',',')?></td>
						<td align="right" style="padding-right:25px"><?=number_format($_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']+$_dat['e']+$_dat['f'],0,'',',')?></td>
						<? $_a += $_dat['a']; $_b += $_dat['b']; $_c += $_dat['c']; $_f += $_dat['f'];
						   $_d += $_dat['d']; $_e += $_dat['e']; $_sum += ($_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']+$_dat['e']+$_dat['f']); ?>
					</tr>
					<? } mysql_free_result($_result); ?>
					<tr height="30px">
					  <td class="key" align="center">รวม</th>
					  <td class="key" style="padding-right:20px" align="right"><?=number_format($_a,0,'',',')?></td>
					  <td class="key" style="padding-right:20px" align="right"><?=number_format($_b,0,'',',')?></td>
					  <td class="key" style="padding-right:20px" align="right"><?=number_format($_c,0,'',',')?></td>
					  <td class="key" style="padding-right:20px" align="right"><?=number_format($_d,0,'',',')?></td>
					  <td class="key" style="padding-right:20px" align="right"><?=number_format($_e,0,'',',')?></td>
					  <td class="key" style="padding-right:20px" align="right"><?=number_format($_f,0,'',',')?></td>
					  <td class="key" align="right" style="padding-right:25px"><?=number_format($_sum,0,'',',')?></td>
				  </tr>
				</table>
			</td>
		</tr>
	</table>
<? } //end_else ?>  
</div>

