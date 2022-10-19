
<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td width="45%"><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>4. ระบบคัดกรองยาเสพติด [บันทึกงานคัดกรอง]</strong></font></span></td>
      <td >
	  	<?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_discipline/Drug_tasklist&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/Drug_tasklist&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/Drug_tasklist&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/Drug_tasklist&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
			<font color="#000000" size="2"  >
			<form method="post" action="index.php?option=module_discipline/Drug_tasklist"> <b>เลือกเดือนสำหรับบันทึก</b>
			<? $_sqlMonth = "select distinct month(task_date) as m,year(task_date) as y from student_drug_task 
								where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' and task_status = '0' 
								order by year(task_date),month(task_date)";
				$_resMonth = mysql_query($_sqlMonth);
			?>
			<select name="month" class="inputboxUpdate">
				<option value=""></option>
				<? while($_datMonth = mysql_fetch_assoc($_resMonth)) { ?>
					<option value="<?=$_datMonth['m']?>" <?=isset($_POST['month'])&&$_POST['month']==$_datMonth['m']?"selected":""?>>
					<?=displayMonth($_datMonth['m']) .' '. ($_datMonth['y']+543)?>
					</option>
				<? } mysql_free_result($_resMonth); ?>
			</select>
			<input type="submit" name="search" value="เรียกดู" class="button" />
			</form>
			</font>
	  </td>
    </tr>
  </table><br/>
  
<? if(isset($_POST['search']) && $_POST['month'] != "") { ?>
	<?
		$_sql = "select task_roomid,
			  sum(if(drug_id='00',task_status,null)) as tobacco,
			  sum(if(drug_id='01',task_status,null)) as drink,
			  sum(if(drug_id='02',task_status,null)) as amphet,
			  sum(if(drug_id='03',task_status,null)) as glue,
			  sum(task_status) as total
			from student_drug_task
			where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
				and month(task_date) = '" . $_POST['month'] . "'
			group by task_date,task_roomid";
		$_res = mysql_query($_sql);
		$_i = 1;
	?>
	<table class="admintable" align="center">
		<tr>
			<td class="key" align="center" rowspan="2" width="50px">ลำดับที่</td>
			<td class="key" align="center" rowspan="2" width="100px">ห้อง</td>
			<td class="key" align="center" colspan="4">สารเสพติดที่คัดกรอง</td>
			<td class="key" align="center" rowspan="2" width="170px">สถานะ</td>
		</tr>
		<tr>
			<td align="center" width="70px" class="key">บุหรี่่</td>
			<td align="center" width="70px" class="key">แอลกอฮอร์</td>
			<td align="center" width="70px" class="key">ยาบ้า</td>
			<td align="center" width="70px" class="key">สารระเหย</td>
		</tr>
		<? while($_dat = mysql_fetch_assoc($_res)) { ?>
		<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
			<td align="center"><?=$_i++?></td>
			<td align="center"><?=getFullRoomFormat($_dat['task_roomid'])?></td>
			<td align="center"><?=disStatus($_dat['tobacco'],$_dat['task_roomid'],$_POST['month'],"00",$acadyear,$acadsemester)?></td>
			<td align="center"><?=disStatus($_dat['drink'],$_dat['task_roomid'],$_POST['month'],"01",$acadyear,$acadsemester)?></td>
			<td align="center"><?=disStatus($_dat['amphet'],$_dat['task_roomid'],$_POST['month'],"02",$acadyear,$acadsemester)?></td>
			<td align="center"><?=disStatus($_dat['glue'],$_dat['task_roomid'],$_POST['month'],"03",$acadyear,$acadsemester)?></td>
			<td align="center"><?=displayTotal($_dat['total'])?></td>
		</tr>
		<? } //end while ?>
	</table>
<? } //end if submit search ?>
</div>
<?php

	function displayTotal($_value)
	{
		if($_value == 4){return "<font color='green'><b>บันทึกครบทุกรายการแล้ว</b></font>";	}
		else{return "<font color='red'><b>ยังบันทึกไม่ครบทุกรายการ</b></font>";}
	}
	function disStatus($_value,$room,$month,$drugType,$year,$semes)
	{
		if ($_value == 1) return "<img src='../images/apply.png' alt='บันทึกแล้ว' width='16' height='16' />";
		else return 
			"<a href='module_discipline/studentListForm.php?room=" . $room . "&month=" .$month . "&drugType=" . $drugType . "&acadyear=" . $year . "&acadsemester=".$semes . "'>
			<img src='../images/delete.png' alt='บันทึกแล้ว' width='16' height='16' /></a>";
		
	}
?>