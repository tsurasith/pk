<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_gpa/index"><img src="../images/gpa.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Learning Achievement</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.4 รายชื่อนักเรียนที่ส่งผลสอบแก้ไขผลการเรียนแล้ว</strong></font></span></td>
      <td >
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_gpa/studentListRegradeLevel&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_gpa/studentListRegradeLevel&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_gpa/studentListRegradeLevel&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_gpa/studentListRegradeLevel&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
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
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา <br/>
            <input type="checkbox" name="regradeonly" value="1" <?=$_POST['regradeonly']=="1"?"checked":""?>> 
             เฉพาะวิชาที่มีการดำเนินการแก้ไข
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
      <th colspan="8" align="center">
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
		<td class="key" width="35px" align="center" rowspan="2">ที่</td>
      	<td class="key" width="70px" align="center" rowspan="2">เลขประจำตัว</td>
      	<td class="key" width="205px" align="center" rowspan="2">ชื่อ - นามสกุล</td>
        <td class="key" width="40px" align="center" rowspan="2">ห้อง</td>
      	<td class="key" width="100px"  align="center" rowspan="2">สถานภาพ</td>
		<td class="key" width="85px" align="center" rowspan="2">คะแนน<br/>ความประพฤติ</td>
		<td class="key" align="center" colspan="2">ผลการเรียนไม่พึงประสงค์</td>
		<td class="key" width="70px" align="center" rowspan="2">-</td>
    </tr>
    <tr>
      	<td class="key" width="100px" align="center">วิชาที่ไม่ผ่าน</td>
      	<td class="key" width="100px" align="center">วิชาที่แก้ไขแล้ว</td>
    </tr>
	<?php
		$sqlStudent = "select 
							id,prefix,firstname,lastname,studstatus,points,room,students.xlevel,xyearth,
							count(grade) as total,
							sum(if(regrade is not null,if(regrade!='',1,0),0)) as regrade
					   from students left outer join grades on (id = student_id)
					   where 1=1 and xedbe = '" . $acadyear . "' and ";
		if($_POST['roomID'] != "all"){		
			$sqlStudent .= " students.xlevel = '". $xlevel . "' and 
							 xyearth = '" . $xyearth . "' and  ";
		}
			$sqlStudent .= " grade in ('0','ร','มส') ";
		if($_POST['studstatus']=="1,2") $sqlStudent .= " and studstatus in (1,2) ";
		$sqlStudent .= "group by student_id ";
		$sqlStudent .= "order by count(grade) desc,sex,id ";
		
		//echo $sqlStudent;
		
		$resStudent = mysql_query($sqlStudent);
		$ordinal = 1;
		$totalRows = mysql_num_rows($resStudent);
		
	?>
    <? if($_POST['regradeonly'] == 1) { ?>
    <? while($dat = mysql_fetch_array($resStudent)){ ?>
    		<? if($dat['regrade'] > 0) { ?>
                <tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
                    <td align="center"><?=$ordinal++?></td>
                    <td align="center"><?=$dat['id']?></td>
                    <td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
                    <td align="center"><?=$dat['xlevel']==3?$dat['xyearth']:$dat['xyearth']+3?>/<?=$dat['room']?></td>
                    <td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
                    <td align="center"><?=displayPoint($dat['points'])?></td>
                    <td align="center"><?=$dat['total']==0?"-":("<b>" . $dat['total'] . "</b>")?></td>
                    <td align="center"><?=$dat['regrade']==0?"-":("<b>" . $dat['regrade'] . "</b>")?></td>
                    <td align="center">
                        <a href="index.php?option=module_gpa/gradestudentListRegradeLevel&xlevel=<?=$dat['xlevel']?>&xyearth=<?=$dat['xyearth']?>&room=<?=$dat['room']?>&name=<?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?>&student_id=<?=$dat['id']?>">
                            รายละเอียด
                        </a>
                    </td>
                </tr>
             <? } else continue; ?>
	<? }} else //end for?>
     <? while($dat = mysql_fetch_array($resStudent)){ ?>
                <tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">
                    <td align="center"><?=$ordinal++?></td>
                    <td align="center"><?=$dat['id']?></td>
                    <td><?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?></td>
                    <td align="center"><?=$dat['xlevel']==3?$dat['xyearth']:$dat['xyearth']+3?>/<?=$dat['room']?></td>
                    <td align="center"><?=displayStudentStatusColor($dat['studstatus'])?></td>
                    <td align="center"><?=displayPoint($dat['points'])?></td>
                    <td align="center"><?=$dat['total']==0?"-":("<b>" . $dat['total'] . "</b>")?></td>
                    <td align="center"><?=$dat['regrade']==0?"-":("<b>" . $dat['regrade'] . "</b>")?></td>
                    <td align="center">
                        <a href="index.php?option=module_gpa/gradestudentListRegradeLevel&xlevel=<?=$dat['xlevel']?>&xyearth=<?=$dat['xyearth']?>&room=<?=$dat['room']?>&name=<?=$dat['prefix'] . $dat['firstname'] . " " . $dat['lastname']?>&student_id=<?=$dat['id']?>">
                            รายละเอียด
                        </a>
                    </td>
                </tr>
	<? } //end for?>
</table>
</div>
  <? } //end else-if ?>
</div>


