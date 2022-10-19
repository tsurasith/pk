
<link rel="stylesheet" type="text/css" href="module_discipline/css/calendar-mos2.css"/>
<script language="JavaScript" type="text/javascript" src="module_discipline/js/calendar.js"></script>
<SCRIPT language=Javascript>
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
   </SCRIPT>
<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td width="45%"><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>ระบบบริหารจัดการงานวินัยนักเรียน</strong></font></span></td>
      <td >
	  	<?php
			if(isset($_REQUEST['acadyear']))
			{
				$acadyear = $_REQUEST['acadyear'];
			}
			if(isset($_REQUEST['acadsemester']))
			{
				$acadsemester = $_REQUEST['acadsemester'];
			}
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_discipline/disciplineSearchProgress&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/disciplineSearchProgress&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/disciplineSearchProgress&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/disciplineSearchProgress&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
	  </td>
    </tr>
  </table>
<? 
	$_totalRows; 
	$_disPlay = 50;
	$_currentPage = (isset($_REQUEST['page'])?$_REQUEST['page']:1);
	$_num = (($_currentPage - 1) * $_disPlay ) + 1;
?>
<?	if(!isset($_POST['search']) && !isset($_REQUEST['page'])) { ?>
  <form action="" method="post">
	<table width="100%" align="center" cellspacing="1" class="admintable" border="0" cellpadding="3">
      <tr><td  class="key" colspan="2">รายการสืบค้นคดี [รายการอยู่ระหว่างการดำเนินการ]</td></tr>
	  <tr>
	  	<td align="right" width="130px">เลขประจำตัวนักเรียน</td><td><input type="text" name="student_id" maxlength="5" size="5" class="inputboxUpdate" onkeypress="return isNumberKey(event)" /></td>
	  </tr>
	  <tr>
	  	<td align="right">ชื่อ</td><td><input type="text" name="firstname" class="inputboxUpdate" /> สกุล <input type="text" name="lastname" class="inputboxUpdate" /></td>
	  </tr>
	  <tr>
	  	<td align="right">วันที่เกิดเหตุ</td><td><input  type="text" id="date" name="date" size="10" onClick="showCalendar(this.id)" class="inputboxUpdate"/></td>
	  </tr>
	  <tr>
	  	<td align="right">ระดับชั้น</td>
		<td>
			<select name="level" class="inputboxUpdate">
				<option value="all"></option>
				<option value="3/1">ชั้นมัธยมศึกษาปีที่ 1</option>
				<option value="3/2">ชั้นมัธยมศึกษาปีที่ 2</option>
				<option value="3/3">ชั้นมัธยมศึกษาปีที่ 3</option>
				<option value="4/1">ชั้นมัธยมศึกษาปีที่ 4</option>
				<option value="4/2">ชั้นมัธยมศึกษาปีที่ 5</option>
				<option value="4/3">ชั้นมัธยมศึกษาปีที่ 6</option>
			</select>
		</td>
	  </tr>
	  <tr>
	  	<td align="right">&nbsp;</td>
		<td>
			ในช่องกรอก "ชื่อ" หรือ "สกุล" สามารถพิมพ์เฉพาะบางส่วนของข้อความได้ เช่่น ถ้าต้องการสืบค้นนักเรียนชื่อ "สันติชัย" <br/>
			สามารถใช้พิมพ์แค่คำว่า "สันติ" ได้
		</td>
	  </tr>
	  <tr>
	  	<td align="right">&nbsp;</td><td>&nbsp;</td>
	  </tr>
	  <tr>
	  	<td>&nbsp;</td><td><input type="submit" name="search" value="สืบค้น"/> <input type="reset" value="ล้างข้อมูลสืบค้น" /></td>
	  </tr>
	</table>
</form>
<? } // end ! isset($_POST['search'])
else
{ 
	$_sql = "select  id,prefix,firstname,lastname,xlevel,xyearth,room,student_discipline.dis_id,dis_date,dis_detail,dis_status
			from student_discipline  left outer join students on student_discipline.dis_studentid =  students.id
									 left outer join student_disciplinestatus on students.id =
										  student_disciplinestatus.student_id and student_discipline.dis_id =
										  student_disciplinestatus.dis_id
			where xedbe = '" .$acadyear . "' and acadyear = '" .$acadyear . "' and acadsemester = '" .$acadsemester . "'
					and student_disciplinestatus.dis_status not in (0,1,6) ";
	
	$_id =  (isset($_POST['student_id'])?$_POST['student_id']:$_REQUEST['student_id']);
	if($_id != ""){ $_sql = $_sql . " and students.id = '" . $_id . "'"; }

	$_level = (isset($_POST['level'])?$_POST['level']:$_REQUEST['level']);
	if($_level != "" && $_level != "all")
	{ $_sql = $_sql . " and xlevel = '" . substr($_level,0,1) . "' and xyearth = '" . substr($_level,2,1) . "'"; }
	
	$_firstname = (isset($_POST['firstname'])?$_POST['firstname']:$_REQUEST['firstname']);
	if($_firstname != ""){ $_sql .=  " and firstname like '%" . $_firstname . "%' ";}
	
	$_lastname = (isset($_POST['lastname'])?$_POST['lastname']:$_REQUEST['lastname']);
	if($_lastname != ""){ $_sql .=  " and lastname like '%" . $_lastname . "%' ";}
	
	$_date = (isset($_POST['date'])?$_POST['date']:$_REQUEST['date']);
	if($_date != ""){ $_sql .= " and dis_date = '" . $_date . "' ";}
	
	$_sqlAll = $_sql; // นับจำนวนแถวทั้งหมด
	$_sql .= " order by id,dis_id,xlevel,xyearth,room,dis_date ";
	$_sql .= " limit " . ($_num-1)  . "," . ($_disPlay);
	$_result = mysql_query($_sql);
	//echo $_sql ;
	@$_totalRows = mysql_num_rows(mysql_query($_sqlAll));
?>
	<table width="100%" align="center" cellspacing="1" class="admintable" border="0" cellpadding="3">
      <tr> 
        <td  class="key" colspan="6">รายการสืบค้นคดี <a href="index.php?option=module_discipline/disciplineSearchProgress">[รายการอยู่ระหว่างการดำเนินการ]</a></td>
	  </tr>
	  <tr bgcolor="#CCCCFF">
	  	<td width="40px" align="center">ที่</td>
	  	<td width="55px" align="center">เลขประ<br/>จำตัว</td>
		<td width="170px" align="center">ชื่อ - สกุล</td>
		<td width="45px" align="center">เลขที่<br/>คดี</td>
		<td width="110px" align="center">วันที่แจ้ง</td>
		<td align="center">รายละเอียดการแจ้ง</td>
	  </tr>
	<? if(mysql_num_rows($_result) > 0) { ?>
		<? while($_dat = mysql_fetch_assoc($_result)){ ?>
		<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
			<td align="center" valign="top"><?=$_num++?></td>
			<td align="center" valign="top"><?=$_dat['id']?></td>
			<td valign="top"><?=$_dat['prefix'] . $_dat['firstname'] . ' ' . $_dat['lastname']?></td>
			<td align="center" valign="top">
				<?=makeLink($_dat['dis_id'],$_dat['dis_status'],$acadyear,$acadsemester)?>
			</td>
			<td align="center" valign="top"><?=displayDate($_dat['dis_date'])?></td>
			<td valign="top"><?=$_dat['dis_detail']?></td>
		<tr>
		<? } mysql_free_result($_result); //end while ?>
		<tr>
	  	<td>&nbsp;</td><td>&nbsp;</td>
		<td colspan="4" align="center">
			หน้าที่ <?=display($_currentPage)?> จากจำนวนทั้งหมด <?=display(ceil($_totalRows/$_disPlay))?> หน้า<br/>
			รายการที่ <?=display((($_currentPage - 1) * $_disPlay ) + 1)?>
			ถึง <?=display(($_currentPage * $_disPlay))?> 
			จาำกจำนวนทั้งหมด <?=display($_totalRows)?> รายการ <br/>
			<? if($_currentPage != 1){ ?>
				<a href="index.php?option=module_discipline/disciplineSearchProgress&page=<?=$_currentPage-1?>&student_id=<?=$_id?>&level=<?=$_level?>&firstname=<?=$_firstname?>&lastname=<?=$_lastname?>&date=<?=$_date?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">&lt;&lt;หน้าก่อนหน้า</a>
			<? } //end if ?>
			 || 
			<? if($_currentPage != (ceil($_totalRows/$_disPlay))) { ?>
				<a href="index.php?option=module_discipline/disciplineSearchProgress&page=<?=$_currentPage+1?>&student_id=<?=$_id?>&level=<?=$_level?>&firstname=<?=$_firstname?>&lastname=<?=$_lastname?>&date=<?=$_date?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">หน้าถัดไป&gt;&gt;</a>
			<? } //end if ?>
		</td>
	  </tr>
	<? }else { //end if check rows ?>
		
		<tr><td>&nbsp;</td><td colspan="5">ไม่พบข้อมูลที่ต้องการ</td></tr>
	<? } //end else check rows ?> 
	 </table>
<?php } // end-else  check submit search?>
</div>
<?php

	function makeLink($_id,$_status,$_y,$_s)
	{
		switch($_status){
			case 2 : return  "<a href=\"index.php?option=module_discipline/disciplineSanction&acadyear=$_y&acadsemester=$_s&dis_id=" . $_id . "\">" . $_id . "</a>"; break;
			case 3 : return  "<a href=\"index.php?option=module_discipline/disciplineActivate&acadyear=$_y&acadsemester=$_s&dis_id=" . $_id . "\">" . $_id . "</a>"; break;
			case 4 : return  "<a href=\"index.php?option=module_discipline/disciplineActivate&acadyear=$_y&acadsemester=$_s&dis_id=" . $_id . "\">" . $_id . "</a>"; break;
			case 5 : return  "<a href=\"index.php?option=module_discipline/disciplineDecision&acadyear=$_y&acadsemester=$_s&dis_id=" . $_id . "\">" . $_id . "</a>"; break;
			default : return $_id;
		}
	}
?>