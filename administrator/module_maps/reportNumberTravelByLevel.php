<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_maps/index"><img src="../images/add.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">แผนที่ติดตามที่อยู่</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>2.2.2 สารสนเทศจำนวนนักเรียนตามระดับชั้น<br/> แยกตามวิธีการเดินทางมาโรงเรียน</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_maps/reportNumberTravelByLevel&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_maps/reportNumberTravelByLevel&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font><br/>
	  	<font color="#000000" size="2">
		เลือกวิธีการเดินทาง
			<? $_resTravel = mysql_query("select * from ref_travel order by 1"); ?>
		  	<select name="travelby" class="inputboxUpdate">
				<option value=""></option>
				<? while($_datTravel = mysql_fetch_assoc($_resTravel)) { ?>
					<option value="<?=$_datTravel['travel_id']?>" <?=$_POST['travelby']==$_datTravel['travel_id']?"selected":""?>><?=$_datTravel['travel_description']?></option>
				<? } //end-while ?>
				<? mysql_free_result($_resTravel); ?>
			</select>
	  		<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			 </font>
	   </td>
    </tr>
  </table>
  </form>
<? if(isset($_POST['search'])&&$_POST['travelby'] == ""){ ?>
		<center><font color="#FF0000"><br/>กรุณาเลือก วิธีการเดินทาง ที่ต้องการเรียกดูข้อมูลก่อน</font></center>
<? } //end if ?>
 <?php
  if(isset($_POST['search'])&&$_POST['travelby'] != ""){
  $_sql = "";
  $_totalStudent = 0;
  if($_POST['roomID']=="all")
  {
  	$_sql = "select xlevel,xyearth,sum(if(sex=1,1,0)) as 'm',sum(if(sex=2,1,0)) as 'f',count(*)as c from students where xedbe = '" . $acadyear . "'  ";
	if($_POST['studstatus']=="1,2") $_sql .= "and studstatus in (1,2) ";
	$_sql .= " group by xlevel,xyearth order by xlevel,xyearth ";
	$_totalStudent = mysql_fetch_assoc(mysql_query("select count(*) as total from students where xedbe = '" . $acadyear . "'" . ($_POST['studstatus']=="1,2"?"and studstatus in (1,2)":"")));
  }
  else
  {
  	$_sql = "select xlevel,xyearth,sum(if(sex=1,1,0)) as 'm',sum(if(sex=2,1,0)) as 'f',count(*)as c from students 
				where xedbe = '" . $acadyear . "' and travelby = '" . $_POST['travelby'] . "'  ";
	if($_POST['studstatus']=="1,2") $_sql .= "and studstatus in (1,2) ";
	$_sql .= " group by xlevel,xyearth order by xlevel,xyearth ";
	$_totalStudent = mysql_fetch_assoc(mysql_query("select count(*) as total from students where xedbe = '" . $acadyear . "' and travelby = '" . $_POST['travelby'] . "' " . ($_POST['studstatus']=="1,2"?"and studstatus in (1,2)":"")));
  }
  $_result = mysql_query($_sql);
  if(mysql_num_rows($_result)>0) {
  ?>
  <table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายงานแสดงวิธีการเดินทางมาโรงเรียน <br/>
			ใช้วิธีการเดินทางโดย : <?=displayTravel($_POST['travelby'])?><br/>
			ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
	  </th>
    </tr>
	<tr>
		<td align="center">
			<table class="admintable">
				<tr> 
					<td class="key" width="200px" rowspan="2" align="center">ระดับชั้น</td>
					<td class="key" colspan="3" align="center">จำนวนนักเรียน(คน)</td>
					<td class="key" width="120px" rowspan="2" align="center">ร้อยละ</td>
				</tr>
				<tr>
					<td class="key" width="60px" align="center">ชาย</td>
					<td class="key" width="60px" align="center">หญิง</td>
					<td class="key" width="70px" align="center">รวม</td>
				</tr>
				<?  $_Point = 0; $_sumTime = 0;  ?>
				<?  $_m=0; $_f=0; ?>
				<?	while($_dat = mysql_fetch_assoc($_result)){ ?>
					<tr>
						<td style="padding-left:10px;">ชั้นมัธยมศึกษาปีที่ <?=($_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3)?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['m']>0?number_format($_dat['m'],0,'',','):"-"?></td>
						<td style="padding-right:15px;" align="right"><?=$_dat['f']>0?number_format($_dat['f'],0,'',','):"-"?></td>
						<td style="padding-right:15px;" align="right"><?=number_format($_dat['c'],0,'',',')?></td>
						<td style="padding-right:45px;" align="right"><?=number_format(($_dat['c']/$_totalStudent['total'])*100,'2','.',',')?></td>
						<? $_Point += $_dat['travelby'] * $_dat['c'] ; $_sumTime += $_dat['c'];?>
						<? $_m += $_dat['m']; $_f += $_dat['f']; ?>
					</tr>	
				<?	} mysql_free_result($_result); ?>
					<tr height="30px">
						<td class="key" align="center">รวม</td>
						<td align="center" class="key"><?=$_m?></td>
						<td align="center" class="key"><?=$_f?></td>
						<td align="center" class="key"><?=$_totalStudent['total']?></td>
						<td></td>
					</tr>
			</table>
		</td>
	</tr>
</table>
<? } // end if 
	else
	{  ?>
	<center><font color="#FF0000"><br/>ยังไม่มีข้อมูลตามเงื่อนไขที่ค้นหา</font></center>
<? }} // end else ?>  
</div>

