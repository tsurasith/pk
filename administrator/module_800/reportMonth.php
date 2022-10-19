

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.4 แบบรายงานประจำเดือน(ตัวเลขทั้งโรงเรียน)</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_800/reportMonth&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportMonth&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_800/reportMonth&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_800/reportMonth&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form action="" method="post">
		<font color="#000000" size="2"  >
		เลือกเดือน
			 <select name="month" class="inputboxUpdate">
			 	<option value=""></option>
				<?php
					$_sqlMonth = "select distinct month(check_date)as m,year(check_date)+543 as y
									from student_800 where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
									order by year(check_date),month(check_date)";
					$_resMonth = mysql_query($_sqlMonth);
					while($_datMonth = mysql_fetch_assoc($_resMonth))
					{
						$_select = (isset($_POST['month'])&&$_POST['month'] == $_datMonth['m']?"selected":"");
						echo "<option value=\"" . $_datMonth['m'] . "\" $_select>" . displayMonth($_datMonth['m']) . ' ' . $_datMonth['y'] . "</option>";
					} mysql_free_result($_resMonth);
				?>
			 </select> <input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			 <input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			 
		  </font>
		  </form>
	  </td>
    </tr>
  </table>


  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%">
    <tr>
	<?php
		if(isset($_POST['search']) && $_POST['month'] == "")
		{
			echo "<td align='center'><br/><font color='red'>กรุณาเลือกเดือนที่ต้องการดูข้อมูลก่อน !</font></td></tr>";
		}
		else if(isset($_POST['search']) && $_POST['month'] != "")
		{
			$sqlStudent = "";
			if($_POST['studstatus']=="1,2")
			{
				$sqlStudent = "(select class_id,
								  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
									sum(if(timecheck_id = '01',timecheck_id,null)) as b,
									sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
									sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
									sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
									count(class_id) as sum
								  from student_800 left outer join students on student_id = id
								  where month(check_date) = '" . $_POST['month'] . "' and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester ."'
									and xEDBE = '" . $acadyear . "' and studstatus in (" . $_POST['studstatus'] . ")
									group by class_id)
								union
								(select 'TOS',
								  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
								  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
									sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
									sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
									sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
									count(class_id) as sum
								  from student_800 left outer join students on student_id = id
								  where month(check_date) = '" . $_POST['month'] . "' and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester ."'
									and xEDBE = '" . $acadyear . "' and studstatus in (" . $_POST['studstatus'] . ") )
								order by class_id";
			}
			else
			{
				$sqlStudent = "(select class_id,
							  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
							  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
							  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
							  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
							  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
							  count(class_id) as sum
							from student_800 where month(check_date) = '" . $_POST['month'] . "' and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
							group by class_id)
							union
							(select 'TOS',
							  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
							  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
							  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
							  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
							  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
							  count(class_id) as sum
							from student_800 where month(check_date) = '" . $_POST['month'] . "' and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "')
							order by class_id";
			}
			$resStudent = mysql_query($sqlStudent);
			$totalRows = mysql_num_rows($resStudent);
			if($totalRows == 0)
			{
				echo "<td>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</td></tr>";
			}
			else{
	?>	 
      <td colspan="6" align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>รายงานการเข้าร่วมกิจกรรมหน้าเสาธงนักเรียน
		<br/>ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
		<br/>ประจำเดือน <?php echo displayMonth($_POST['month']); ?>
	  </td>
    </tr>
    <tr bgcolor="#CCCCFF" > 
		<td colspan="6" bgcolor="white" align="center">
			<table class="admintable">
				<tr align="center">
					<td width="60px" class="key">ห้อง</td>
					<td width="50px" class="key">มา</td>
					<td width="50px" class="key">กิจกรรม</td>
					<td width="50px" class="key">สาย</td>
					<td width="50px" class="key">ลา</td>
					<td width="50px" class="key">ขาด</td>
					<td width="60px" class="key">รวม</td>
					<td width="70px" class="key">% ขาด</td>
				</tr>
				<? while($dat = mysql_fetch_assoc($resStudent)) { ?>
					<? $_header = ($dat['class_id']=="TOS"?"class='key'":""); ?>
					<tr>
					<td align="center" <?=$_header?>><?=$dat['class_id']=="TOS"?"รวม":getFullRoomFormat($dat['class_id'])?></td>
					<td align="right" <?=$_header?>><?=$dat['a']==0?"-":number_format($dat['a'],0,'.',',')?></td>
					<td align="right" <?=$_header?>><?=$dat['b']==0?"-":$dat['b']?></td>
					<td align="right" <?=$_header?>><?=$dat['c']==0?"-":$dat['c']?></td>
					<td align="right" <?=$_header?>><?=$dat['d']==0?"-":$dat['d']?></td>
					<td align="right" <?=$_header?>><?=$dat['e']==0?"-":$dat['e']?></td>
					<td align="right" <?=$_header?>><b><?=number_format($dat['sum'],0,'.',',')?></b></td>
					<td align='right' <?=$_header?>><b><?=number_format((100 * $dat['e']/$dat['sum']),2,'.',',')?></b></td>
					</tr>
				<? } mysql_free_result($resStudent); ?>
			</table>
		</td>
    </tr>
	<?php
	  }//ปิด if-else ตรวจสอบข้อมูลในฐานข้อมูล
	}//ปิด if-else ตรวจสอบการเลือกวันที่
	?>
</table>

</div>

