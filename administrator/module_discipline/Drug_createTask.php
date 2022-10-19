
<div id="content">
	<link rel="stylesheet" type="text/css" href="module_discipline/css/calendar-mos2.css"/>
	<script language="JavaScript" type="text/javascript" src="module_discipline/js/calendar.js"></script>
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td width="45%"><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>4. ระบบคัดกรองยาเสพติด [สร้างงานคัดกรอง]</strong></font></span></td>
      <td >
		ปีการศึกษา <?=$acadyear?>
		ภาคเรียนที่ <?=$acadsemester?>
	</td>
    </tr>
  </table>
<? if(!isset($_POST['create']) || $_POST['date']=="") { ?>
	<table class="admintable" width="100%">
		<tr>
			<td class="key">การสร้างงานบันทึกการคัดกรองประจำเดือน</td>
		</tr>
		<tr>
			<td align="center">
				<form method="post">
				<table width="350px">
					<tr>
						<td><b>เลือกวันที่ : </b>
							<input type="text" id="date" name="date" size="10" onClick="showCalendar(this.id)" class="inputboxUpdate" value="<?=isset($_POST['date'])?$_POST['date']:""?>"/>
						</td>
					</tr>
					<tr>
						<td align="center"><input type="submit" name="create" value="สร้างงานบันทึก" /></td>
					</tr>
					<tr>
						<td><br/>
							<font color="#FF0000">***</font> การสร้างงานประเมินคัดกรองนั้นจะสามารถสร้างได้เพียงเดือนละ 1 ครั้งเท่านั้น
						</td>
					</tr>
					<tr>
						<td class="key" align="center">งานคัดกรองที่สร้างแล้วในภาคเรียนนี้</td>
					</tr>
					<?php
						$_sqlMonth = "select distinct month(task_date)as m,year(task_date)+543 as y
										from student_drug_task where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
										order by year(task_date),month(task_date)";
						$_resMonth = mysql_query($_sqlMonth);
						while($_datMonth = mysql_fetch_assoc($_resMonth)){ ?>
							<tr>
								<td><font color="#0000FF"><b>เดือน<?=displayMonth($_datMonth['m']) . ' ' . $_datMonth['y']?></b></font></td>
							</tr>
					<?	} mysql_free_result($_resMonth); ?>
				</table>
				</form>
			</td>
		</tr>
	</table>
<? } //end if not $_POST['create'] ?>
<? if(isset($_POST['create']) && $_POST['date'] != "") { ?>
	<?
		$sql = 'SELECT distinct room_id FROM rooms where acadyear = ' . $acadyear .' and acadsemester = ' .$acadsemester ;
		$sql2 = "select distinct month(task_date) from student_drug_task 
						where 
							month(task_date) = '" . substr($_POST['date'],5,2) . "' and 
							acadyear = '" . $acadyear .' and 
							acadsemester = ' .$acadsemester . "'" ;
	?>
	<table class="admintable" width="100%">
		<tr><td class="key">การสร้างงานบันทึกการคัดกรองประจำเดือน</td></tr>
		<tr>
			<td align="center">
				<?
					$c_date = mysql_query($sql2);
					$rows = mysql_num_rows($c_date);
					if($rows == 0)
					{
						$result = mysql_query($sql);
						while ($data = mysql_fetch_assoc($result))
						{
							$sql_insert = "insert into student_drug_task values ( null,'". $_POST['date'] ."','" . $data['room_id'] . "','0','00', '" . $acadyear . "','" .$acadsemester ."') ";
							mysql_query($sql_insert) or die ('Error - ' . mysql_error());
							
							$sql_insert = "insert into student_drug_task values ( null,'". $_POST['date'] ."','" . $data['room_id'] . "','0','01', '" . $acadyear . "','" .$acadsemester ."') ";
							mysql_query($sql_insert) or die ('Error - ' . mysql_error());
							
							$sql_insert = "insert into student_drug_task values ( null,'". $_POST['date'] ."','" . $data['room_id'] . "','0','02', '" . $acadyear . "','" .$acadsemester ."') ";
							mysql_query($sql_insert) or die ('Error - ' . mysql_error());
							
							$sql_insert = "insert into student_drug_task values ( null,'". $_POST['date'] ."','" . $data['room_id'] . "','0','03', '" . $acadyear . "','" .$acadsemester ."') ";
							mysql_query($sql_insert) or die ('Error - ' . mysql_error());
						}
						echo "<font color=\"#009900\" size=\"2\" face=\"Tahoma\"><strong>บันทึกข้อมูลเรียบร้อยแล้ว</strong></font>";
						mysql_free_result($result);
					}
					else{ echo "<font color=\"red\" size=\"2\" face=\"Tahoma\"><strong>คุณไม่สามารถสร้างงานบันทึกข้อมูลได้<br/>เนื่องจากมีการสร้างงานบันทึกในเดือนนี้แล้ว</strong></font>";}
				?><br/><br/><br/>
				<input type="button" value="ดำเนินการต่อไป" onClick="history.go(-1)"/>
			</td>
		</tr>
	</table>
<? } //end if submit value ?>

</div>

