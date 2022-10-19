<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_maps/index"><img src="../images/add.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">แผนที่ติดตามที่อยู่</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>2.1.1 สารสนเทศระยะเวลาที่นักเรียนใช้ในการเดินทางมาโรงเรียน<br/> จำนวนนักเรียน แยกตามระดับชั้น</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_maps/reportNumberHowlong&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_maps/reportNumberHowlong&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	  	<font color="#000000" size="2">
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
	   </td>
    </tr>
  </table>
  </form>

<? if(isset($_POST['search']) && $_POST['roomID'] == "") { ?>
		<center><font color="#FF0000"><br/>กรุณาเลือก ระดับชั้น ที่ต้องการเรียกดูข้อมูลก่อน</font></center>
<? } //end if ?>

 <?php
  $_sql = "";
  $_totalStudent = 0;
  if($_POST['roomID']=="all")
  {
  	$_sql = "select howlong,count(*)as c from students where xedbe = '" . $acadyear . "'  ";
	if($_POST['studstatus']=="1,2") $_sql .= "and studstatus in (1,2) ";
	$_sql .= " group by howlong order by 1 desc";
	$_totalStudent = mysql_fetch_assoc(mysql_query("select count(*) as total from students where xedbe = '" . $acadyear . "'" . ($_POST['studstatus']=="1,2"?"and studstatus in (1,2)":"")));
  }
  else
  {
  	$_sql = "select howlong,count(*)as c from students 
				where xedbe = '" . $acadyear . "' and xlevel = '" . substr($_POST['roomID'],0,1) . "' 
					and xyearth = '" . substr($_POST['roomID'],2,1) . "' ";
	if($_POST['studstatus']=="1,2") $_sql .= "and studstatus in (1,2) ";
	$_sql .= " group by howlong desc order by 1 desc";
	$_totalStudent = mysql_fetch_assoc(mysql_query("select count(*) as total from students where xedbe = '" . $acadyear . "' and xlevel = '" . substr($_POST['roomID'],0,1) . "' and xyearth = '" . substr($_POST['roomID'],2,1) . "' " . ($_POST['studstatus']=="1,2"?"and studstatus in (1,2)":"")));
  }
  $_result = mysql_query($_sql);
  if(mysql_num_rows($_result)>0) {
  ?>
  <table class="admintable" width="100%" align="center">
    <tr> 
      <th align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายงานแสดงเวลาที่นักเรียนใช้ในการเดินทาง <br/>
			นักเรียนชั้นมัธยมศึกษาปีที่ <?=displayXyear($_POST['roomID'])?><br/>
			ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
	  </th>
    </tr>
	<tr>
		<td align="center">
			<table class="admintable">
				<tr> 
					<td class="key" width="140px" align="center">ระยะเวลา<br/>(นาที)</td>
					<td class="key" width="100px" align="center">จำนวนนักเรียน<br/>(คน)</td>
					<td class="key" width="80px" align="center">ร้อยละ</td>
				</tr>
				<?  $_Point = 0; $_sumTime = 0;  ?>
				<?	while($_dat = mysql_fetch_assoc($_result)){ ?>
					<tr>
						<td align="center"><?=$_dat['howlong']>0?$_dat['howlong']:"ไม่ระบุ"?></td>
						<td align="right" style="padding-right:25px;"><?=number_format($_dat['c'],0,'',',')?></td>
						<td align="right"  style="padding-right:25px;"><?=number_format(($_dat['c']/$_totalStudent['total'])*100,'2','.',',')?></td>
						<? $_Point += $_dat['howlong'] * $_dat['c'] ; $_sumTime += $_dat['c'];?>
					</tr>	
				<?	} mysql_free_result($_result); ?>
					<tr height="35px">
						<td class="key" align="center">ค่าเฉลี่ย : <?=number_format(($_Point/$_sumTime),2,'.',',')?> นาที</td>
						<td class="key" align="center">รวม : <?=number_format($_totalStudent['total'],0,'',',')?> คน</td>
						<td></td>
					</tr>
			</table>
		</td>
	</tr>
</table>
<? } // end if  ?>  
</div>

