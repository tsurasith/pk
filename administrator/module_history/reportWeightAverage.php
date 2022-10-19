<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td width="45%"><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.1.3 สารสนเทศน้ำหนักเฉลี่ยของนักเรียน<br/>แยกตามห้องเรียนและระดับชั้น</strong></font></span></td>
      <td >
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_history/reportWeightAverage&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/reportWeightAverage&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	  	<font color="#000000" size="2"  >
		เลือกรายการดูข้อมูล
		  	<select name="detail" class="inputboxUpdate">
		  		<option value=""></option>
				<option value="1" <?=isset($_POST['detail'])&&$_POST['detail']=="1"?"selected":""?>>ระดับห้องเรียน</option>
				<option value="2" <?=isset($_POST['detail'])&&$_POST['detail']=="2"?"selected":""?>>ระดับชั้นเรียน</option>
			</select> 
	  		<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			</font>
	   </td>
    </tr>
  </table>
  </form>

<? if(isset($_POST['search']) && $_POST['detail'] != "") { ?>
  <table class="admintable" width="100%" cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th  align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายการข้อมูลค่าน้ำหนักเฉลี่ยของนักเรียนโรงเรียนโป่งนกประชาสามัคคี<br/>
			ปีการศึกษา <?php echo $acadyear; ?> แยกตามระดับ <?=$_POST['detail']==1?"ห้องเรียน":"ชั้น"?>
	  </th>
    </tr>
    <tr>
		<td align="center">
			<? $_sql = "select xlevel,xyearth,room, sum(if(sex=1,weight,0)) as WM, sum(if(sex=1,1,0)) as Male, sum(if(sex=2,weight,0)) as WF , sum(if(sex=2,1,0)) as Female
						from students where xEDBE = '" . $acadyear . "' ";
			   if($_POST['studstatus'] == "1,2") $_sql .= " and studstatus in (1,2)";		
			   $_sql .= " group by xlevel,xyearth" .( $_POST['detail']==1?",room":""); ?>
			<table class="admintable">
				<tr> 
					<td class="key" align="center" rowspan="2" width="200px"><?=$_POST['detail']=="1"?"ห้องเรียน":"ระดับชั้น"?></td>
					<td class="key" align="center" colspan="2">จำนวนนักเรียน (คน)</td>
					<td class="key" align="center" colspan="2">น้ำหนักเฉลี่ย (กิโลกรัม)</td>
				</tr>
				<tr>
					<td class="key" align="center" width="60px">ชาย</td>
					<td class="key" align="center" width="60px">หญิง</td>
					<td class="key" align="center" width="60px">ชาย</td>
					<td class="key" align="center" width="60px">หญิง</td>
				</tr>
				<? $_res = mysql_query($_sql); $_f=0;$_m=0; ?>
				<? while($_dat = mysql_fetch_assoc($_res)) { ?>
				<tr>
					<td style="padding-left:20px">ชั้นมัธยมศึกษาปีที่ <?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?><?=$_POST['detail']==1?"/" . $_dat['room']:""?></td>
					<td align="right" style="padding-right:15px"><?=$_dat['Male']!=0?number_format($_dat['Male'],0,'',','):"-"?></td>
					<td align="right" style="padding-right:15px"><?=$_dat['Female']!=0?number_format($_dat['Female'],0,'',','):"-"?></td>
					<td align="right" style="padding-right:15px"><?=$_dat['WM']>0?number_format($_dat['WM']/$_dat['Male'],2,'.',','):"-"?></td>
					<td align="right" style="padding-right:15px"><?=$_dat['WF']>0?number_format($_dat['WF']/$_dat['Female'],2,'.',','):"-"?></td>
					<? $_f += $_dat['Female']; $_m += $_dat['Male']; ?>
				</tr>
				<? } ?>
				<tr height="30px">
					<td class="key" align="center">รวม</td>
					<td class="key" align="right" style="padding-right:15px"><?=number_format($_m,0,'',',')?></td>
					<td class="key" align="right" style="padding-right:15px"><?=number_format($_f,0,'',',')?></td>
					<td class="key" colspan="2" align="center"><?=number_format($_f+$_m,0,'',',')?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? } else { //end-if check_submit ?>  
		<? $_sql = "select id,prefix,firstname,lastname,xlevel,xyearth,room,weight from students where xEDBE = '" .$acadyear."' " . ($_POST['studstatus']=="1,2"?"and studstatus in (1,2)":"");?>
		<table align="center" class="admintable" width="100%">
			<tr>
				<td colspan="6" class="key" align="center">
					<img src="../images/school_logo.gif" width="120px"><br/>
					รายชื่อนักเรียนที่มีน้ำหนักมากที่สุด 10 อันดับแรกของโรงเรียนโป่งนกประชาสามัคคี<br />ปีการศึกษา <?=$acadyear?>
				</td>
			</tr>
			<tr>
				<td colspan="3" align="center" class="key">นักเรียนชาย</td>
				<td colspan="3" align="center" class="key">นักเรียนหญิง</td>
			</tr>
			<tr>
				<td align="center" class="key">ชื่อ - สกุล</td>
				<td align="center" class="key">ห้อง</td>
				<td align="center" class="key">น้ำหนัก(กก.)</td>
				<td align="center" class="key">ชื่อ - สกุล</td>
				<td align="center" class="key">ห้อง</td>
				<td align="center" class="key">น้ำหนัก(กก.)</td>
			</tr>
			<? $_sqlMale = $_sql . "and sex = 1 order by weight desc limit 0,10";
			   $_sqlFemale = $_sql . "and sex = 2 order by weight desc limit 0,10"; 
			   $_resM = mysql_query($_sqlMale);
			   $_resF = mysql_query($_sqlFemale); ?>
			<? for($_i = 1; $_i <= 10; $_i++) { ?>
			<? $_datM = mysql_fetch_assoc($_resM); $_datF = mysql_fetch_assoc($_resF); ?>
			<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">	
				<td >
					<?=$_i?>. 
					<?=$_datM['prefix'] . $_datM['firstname'] . ' ' . $_datM['lastname']?>
				</td>
				<td width="90px" align="center"><?=($_datM['xlevel']==3?$_datM['xyearth']:$_datM['xyearth']+3) .'/'.$_datM['room']?></td>
				<td width="90px" align="center"><?=$_datM['weight']?></td>
				<td >
					<?=$_i?>. 
					<?=$_datF['prefix'] . $_datF['firstname'] . ' ' . $_datF['lastname']?>
				</td>
				<td width="90px" align="center"><?=($_datF['xlevel']==3?$_datF['xyearth']:$_datF['xyearth']+3) .'/'.$_datF['room']?></td>
				<td width="90px" align="center"><?=$_datF['weight']?></td>
			</tr>
			<? } //end for ?>
		</table>
<? } //end else?>
</div>
