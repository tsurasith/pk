<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_gpa/index"><img src="../images/gpa.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Learning Achievement</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.3 ผลสัมฤทธิ์ไม่พึงประสงค์ตามระดับชั้น</strong></font></span></td>
      <td >
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_gpa/studentListFailsLevel&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_gpa/studentListFailsLevel&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_gpa/studentListFailsLevel&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_gpa/studentListFailsLevel&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		</font>
        <font size="2" color="#000000">
		<br/>
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
	  		<input type="submit" value="สืบค้น" class="button" name="search"/> <br/>
            <input type="checkbox" name="failstatus" value="1" <?=$_POST['failstatus']=="1"?"checked":""?> />
             เฉพาะรายวิชาที่ยังไม่ดำเนินการแก้ไขผลการเรียน <br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			</font>
	   </td>
    </tr>
  </table>
  </form>
  <?php
   $xlevel;
   $xyearth;
   if($_POST['roomID'] != "all")
   {
   	 $xlevel = substr($_POST['roomID'],0,1);;
	 $xyearth = substr($_POST['roomID'],2,1);
   }
  ?>
  
<? if(isset($_POST['search']) && $_POST['roomID'] == "") { ?>
	<center><br/><font color="#FF0000">กรุณาเลือกห้องเรียนก่อน !</font></center>
<? } else if (isset($_POST['search']) && $_POST['roomID'] != "") { ?>
<div align="center">
  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th colspan="10" align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			รายชื่อนักเรียนชั้นมัธยมศึกษาปีที่ 
			<?
			   if($_POST['roomID'] != "all") echo $xlevel==3?$xyearth:($xyearth+3);
			   else echo "ทั้งโรงเรียน";
			 ?><br/>
			ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
	  </th>
    </tr>
    <tr> 
		<td class="key" width="25px" align="center" rowspan="2">ที่</td>
      	<td class="key" width="70px" align="center" rowspan="2">เลขประจำตัว</td>
      	<td class="key" width="205px" align="center" rowspan="2">ชื่อ - นามสกุล</td>
        <td class="key" width="40px" align="center" rowspan="2">ห้อง</td>
      	<td class="key" width="100px"  align="center" rowspan="2">สถานภาพ</td>
		<td class="key" width="85px" align="center" rowspan="2">คะแนน<br/>ความประพฤติ</td>
		<td class="key" align="center" colspan="4">ผลการเรียนไม่พึงประสงค์</td>
		<td class="key" width="70px" align="center" rowspan="2">-</td>
    </tr>
    <tr>
      	<td class="key" width="50px" align="center">0</td>
      	<td class="key" width="50px" align="center">ร</td>
      	<td class="key" width="50px"  align="center">มส.</td>
        <td class="key" width="60px"  align="center">รวม</td>
    </tr>
	<?php
		$sqlStudent = "select 
							id,prefix,firstname,lastname,studstatus,points,room,students.xlevel,xyearth,
							sum(if(grade='0',1,0)) as z0,
							sum(if(grade='ร',1,0)) as z1,
							sum(if(grade='มส',1,0)) as z2,
							count(grade) as total
					   from students left outer join grades on (id = student_id)
					   where 1=1 and xedbe = '" . $acadyear . "' and ";
		if($_POST['roomID'] != "all"){		
			$sqlStudent .= " students.xlevel = '". $xlevel . "' and 
							 xyearth = '" . $xyearth . "' and  ";
		}
			$sqlStudent .= " grade in ('0','ร','มส') ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		if($_POST['failstatus']=="1") $sqlStudent .= " and regrade is null or regrade in ('','0','ร','มส') ";
		$sqlStudent .= "group by student_id ";
		$sqlStudent .= "order by count(grade) desc,sex,id ";
		
		//echo $sqlStudent;
		
		$resStudent = mysql_query($sqlStudent);
		$ordinal = 1;
		$totalRows = mysql_num_rows($resStudent);
		for($i = 0; $i < $totalRows ; $i++) { ?>
		<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
			<? $dat = mysql_fetch_array($resStudent); ?>
			<td align="center"><?=$ordinal++?></td>
			<td align="center"><?=$dat['id']?></td>
			<td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
            <td align="center"><?=$dat['xlevel']==3?$dat['xyearth']:$dat['xyearth']+3?>/<?=$dat['room']?></td>
			<td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
			<td align="center"><?=displayPoint($dat['points'])?></td>
			<td align="center"><?=$dat['z0']==0?"-":("<b>" . $dat['z0'] . "</b>")?></td>
            <td align="center"><?=$dat['z1']==0?"-":("<b>" . $dat['z1'] . "</b>")?></td>
            <td align="center"><?=$dat['z2']==0?"-":("<b>" . $dat['z2'] . "</b>")?></td>
            <td align="center"><?=$dat['total']==0?"-":("<b>" . $dat['total'] . "</b>")?></td>
            <td align="center">
            	<a href="index.php?option=module_gpa/gradeStudentListFailsLevel&xlevel=<?=$dat['xlevel']?>&xyearth=<?=$dat['xyearth']?>&room=<?=$dat['room']?>&name=<?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?>&student_id=<?=$dat['id']?>">
                	รายละเอียด
                </a>
            </td>
		</tr>
	<? } //end for?>
</table>
</div>
  <? } //end else-if ?>
</div>


