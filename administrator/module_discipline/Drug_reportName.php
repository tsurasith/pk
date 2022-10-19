
<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center" valign="top"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td valign="top"><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>4.2 รายงานคัดกรองยาเสพติด(รายชื่อ)</strong></font></span></td>
      <td >
	  	<?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_discipline/Drug_reportName&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/Drug_reportName&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/Drug_reportName&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/Drug_reportName&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
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
			ขั้นการกรอง
			<select name="drugLevel" class="inputboxUpdate">
				<option value=""></option>
				<option value="00" <?=isset($_POST['drugLevel'])&&$_POST['drugLevel']=="00"?"selected":""?>> ปกติ </option>
				<option value="01" <?=isset($_POST['drugLevel'])&&$_POST['drugLevel']=="01"?"selected":""?>> เสี่ยง </option>
				<option value="02" <?=isset($_POST['drugLevel'])&&$_POST['drugLevel']=="02"?"selected":""?>> เคยลอง </option>
				<option value="03" <?=isset($_POST['drugLevel'])&&$_POST['drugLevel']=="03"?"selected":""?>> ติด </option>
				<option value="02,03" <?=isset($_POST['drugLevel'])&&$_POST['drugLevel']=="02,03"?"selected":""?>> เคยลอง + ติด </option>
			</select>
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
			</select> 
			 <br/><input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
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
		if(isset($_POST['search']) && ($_POST['month'] == "" || $_POST['drugType']=="" || $_POST['roomID']=="")){ echo "<td align='center'><br/><font color='red'>กรุณาเลือก สารเสพติด เดือน ขั้นการกรอง และ ระดับชั้นให้ครบถ้วน</font></td></tr>"; }
		if(isset($_POST['search']) && $_POST['month'] != "" && $_POST['drugType']!= "" && $_POST['roomID']!="")
		{
			$_sql = "select id,prefix,firstname,lastname,nickname,p_village,travelby,class_id,drugLevel
					from student_drug right outer join students
					on (student_id = id)
					where drugType = '" . $_POST['drugType'] ."' and drugLevel in (" . $_POST['drugLevel'] . ")
					  and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' and check_date = '" . $_POST['month'] . "'
					  and xEDBE = '" . $acadyear . "'"  ;
			if($_POST['roomID']!="all") $_sql .= " and xlevel = '" . substr($_POST['roomID'],0,1) ."' and xyearth = '" . substr($_POST['roomID'],2,1) . "' ";
			if($_POST['studstatus']=="1,2") $_sql .= " and studstatus in (1,2) ";
			$_sql .= " order by drugLevel,class_id,sex,id";
			
			@$_res = mysql_query($_sql);
			if(@mysql_num_rows($_res)<=0){ echo "<td align='center'><font color='red'>ยังไม่มีการบันทึกข้อมูลในรายการที่เลือก</font></td></tr>"; }
			else{
	?>	 
		  <th align="center" colspan="8">
			<img src="../images/school_logo.gif" width="120px">
			<br/>
			รายงานผลการคัดกรองสารเสพติด ประเภท "<?=displayDrug($_POST['drugType'])?>" <br/>
			ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
			<br/>ประจำเดือน <?=displayMonth($_POST['month'])?>
		  </th>
    </tr>
	<tr align="center">
		<td class="key" width="30px">ที่</td>
		<td class="key" width="80px">เลขประจำตัว</td>
		<td class="key" width="185px">ชื่อ-สกุล</td>
		<td class="key" width="50px">ชื่อเล่น</td>
		<td class="key" width="40px">ห้อง</td>
		<td class="key" width="100px">การกรอง</td>
		<td class="key" width="170px">หมู่บ้าน</td>
		<td class="key" >การเดินทาง<br/>มาโรงเรียน</td>
	</tr>
	<? $_i = 1; ?>
	<? while($_dat = mysql_fetch_assoc($_res)){ ?>
	<tr>
		<td align="center"><?=$_i++?></td>
		<td align="center"><?=$_dat['id']?></td>
		<td><?=$_dat['prefix'].$_dat['firstname']. ' ' . $_dat['lastname']?></td>
		<td align="center"><?=$_dat['nickname']?></td>
		<td align="center"><?=getFullRoomFormat($_dat['class_id'])?></td>
		<td align="center"><?=displayDrugLevel($_dat['drugLevel'])?></td>
		<td><?=$_dat['p_village']?></td>
		<td><?=displayTravel($_dat['travelby'])?></td>
	</tr>
	<? } //end while ?>
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
	function displayDrugLevel($_value)
	{
		switch($_value){
			case '00' : return "ปกติ"; break;
			case '01' : return "<font color='green'><b>เสี่ยง</b></font>"; break;
			case '02' : return "<font color='orange'><b>เคยลอง</b></font>"; break;
			case '03' : return "<font color='red'><b>ติด</b></font>"; break;
			default : return "ไม่ระบุ"; }
	}


?>