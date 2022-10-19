
<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>4.1 รายงานคัดกรองยาเสพติด(ตัวเลข)</strong></font></span></td>
      <td >
	  	<?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_discipline/Drug_reportNumber&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/Drug_reportNumber&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_discipline/Drug_reportNumber&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) {
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/Drug_reportNumber&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form action="" method="post">
		<font color="#000000" size="2">
		เลือกสารเสพติด 
			 <select name="drugType" class="inputboxUpdate">
			 	<option value=""></option>
				<option value="00" <?=isset($_POST['drugType'])&&$_POST['drugType']=="00"?"selected":""?>>บุหรี่</option>
				<option value="01" <?=isset($_POST['drugType'])&&$_POST['drugType']=="01"?"selected":""?>>แอลกอฮอล์</option>
				<option value="02" <?=isset($_POST['drugType'])&&$_POST['drugType']=="02"?"selected":""?>>ยาบ้า</option>
				<option value="03" <?=isset($_POST['drugType'])&&$_POST['drugType']=="03"?"selected":""?>>สารระเหย</option>
			 </select> 
			เดือน
			<select name="month" class="inputboxUpdate">
			 	<option value=""></option>
				<?php
					$_sqlMonth = "select distinct month(task_date)as m,year(task_date)+543 as y
									from student_drug_task where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
									order by year(task_date),month(task_date)";
					$_resMonth = mysql_query($_sqlMonth);
					while($_datMonth = mysql_fetch_assoc($_resMonth))
					{
						$_select = (isset($_POST['month'])&&$_POST['month'] == $_datMonth['m']?"selected":"");
						echo "<option value=\"" . $_datMonth['m'] . "\" $_select >" . displayMonth($_datMonth['m']) . ' ' . $_datMonth['y'] . "</option>";
					} mysql_free_result($_resMonth);
				?>
			 </select>
			 <input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			 <input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		  </font>
		  </form>
	</td>
    </tr>
  </table>
  <br/>
<table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%" >
    <tr>
	<?php
		if(isset($_POST['search']) && ($_POST['month'] == "" || $_POST['drugType']=="")){ echo "<td align='center'><font color='red'><br/>กรุณาเลือก สารเสพติด และ เดือน ที่ต้องการทราบข้อมูลให้ครบถ้วน </font></td></tr>"; }
		if(isset($_POST['search']) && $_POST['month'] != "" && $_POST['drugType']!= "")
		{
			$_sql = "select class_id,
					  sum(if(drugLevel='00',1,0)) as a,
					  sum(if(drugLevel='01',1,0)) as b,
					  sum(if(drugLevel='02',1,0)) as c,
					  sum(if(drugLevel='03',1,0)) as d,
					  count(class_id) as total
					from student_drug right outer join students
					on (student_id = id)
					where drugType = '" . $_POST['drugType'] ."' and check_date = '" . $_POST['month'] . "'
					  and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
					  and xEDBE = '" . $acadyear . "'" ;
			if($_POST['studstatus']=="1,2") $_sql .= " and studstatus in (1,2) ";
			$_sql .= " group by class_id order by class_id";
			
			@$_res = mysql_query($_sql);
			if(@mysql_num_rows($_res)<=0){ echo "<td align='center'><font color='red'><br/>ยังไม่มีการบันทึกข้อมูลในรายการที่เลือก</font></td></tr>"; }
			else{
	?>	 
		  <th align="center">
			<img src="../images/school_logo.gif" width="120px">
			<br/>
			รายงานผลการคัดกรองสารเสพติด ประเภท "<?=displayDrug($_POST['drugType'])?>" <br/>
			ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
			<br/>ประจำเดือน <?=displayMonth($_POST['month'])?>
		  </th>
    </tr>
	<tr>
		<td align="center">
			<table class="admintable">
				<tr align="center">
					<td class="key" width="100px" rowspan="2">ห้อง</td>
					<td class="key" colspan="4">ระดับการคัดกรอง</td>
					<td class="key" width="100px" rowspan="2">รวม</td>
				</tr>
				<tr align="center">
					<td class="key" width="80px">ปกติ</td>
					<td class="key" width="80px">เสี่ยง</td>
					<td class="key" width="80px">เคยลอง</td>
					<td class="key" width="80px">ติด</td>
				</tr>
				<? $_a=0;$_b=0;$_c=0;$_d=0;$_total=0; ?>
				<? while($_dat = mysql_fetch_assoc($_res)) { ?>
				<tr>
					<td align="center"><?=getFullRoomFormat($_dat['class_id'])?></td>
					<td align="right" style="padding-right:15px"><?=$_dat['a']>0?number_format($_dat['a'],0,'',','):'-'?></td>
					<td align="right" style="padding-right:15px"><?=$_dat['b']>0?number_format($_dat['b'],0,'',','):'-'?></td>
					<td align="right" style="padding-right:15px"><?=$_dat['c']>0?number_format($_dat['c'],0,'',','):'-'?></td>
					<td align="right" style="padding-right:15px"><?=$_dat['d']>0?number_format($_dat['d'],0,'',','):'-'?></td>
					<td align="right" style="padding-right:15px"><?=number_format($_dat['total'],0,'',',')?></td>
				</tr>
				<? $_a+=$_dat['a'];$_b+=$_dat['b'];$_c+=$_dat['c'];$_d+=$_dat['d'];$_total+=$_dat['total']; ?>
				<? } //end while ?>
				<tr height="30px">
					<td class="key" align="center">รวม</th>
					<td class="key" align="right" style="padding-right:15px"><?=$_a>0?number_format($_a,0,'',','):"-"?></td>
					<td class="key" align="right" style="padding-right:15px"><?=$_b>0?number_format($_b,0,'',','):"-"?></td>
					<td class="key" align="right" style="padding-right:15px"><?=$_c>0?number_format($_c,0,'',','):"-"?></td>
					<td class="key" align="right" style="padding-right:15px"><?=$_d>0?number_format($_d,0,'',','):"-"?></td>
					<td class="key" align="right" style="padding-right:15px"><?=$_total>0?number_format($_total,0,'',','):"-"?></td>
				</tr>
			</table>
		</td>
	</tr>
<?	  }//ปิด else ตรวจสอบข้อมูลในฐานข้อมูล
	}//ปิด if-else ตรวจสอบการเลือกวันที่
	?>
</table>
</div>
<?

	function displayDrug($_value)
	{
		switch($_value){
			case '00' : return "บุหรี่"; break;
			case '01' : return "เครื่องดื่มแอลกอฮอร์"; break;
			case '02' : return "ยาบ้า"; break;
			case '03' : return "สารระเหย"; break;
			default : return "ไม่ระบุ"; }
	}
?>