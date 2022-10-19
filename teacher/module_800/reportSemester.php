
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.7 แบบรายงานประจำภาคเรียน(ตัวเลขทั้งโรงเรียน)</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_800/reportSemester&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportSemester&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else { echo " <a href=\"index.php?option=module_800/reportSemester&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_800/reportSemester&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
	  </td>
    </tr>
  </table>
<?php
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
							where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' 
								and xedbe = '" . $acadyear . "' and studstatus in (" . $_POST['studstatus'] . ")
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
							where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
								and xedbe = '" . $acadyear . "' and studstatus in (" . $_POST['studstatus'] . ") )
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
							from student_800 where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' 
							group by class_id)
							union
							(select 'TOS',
							  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
							  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
							  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
							  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
							  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
							  count(class_id) as sum
							from student_800 where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' )
							order by class_id";
			}
			
			$resStudent = mysql_query($sqlStudent);
			$totalRows = mysql_num_rows($resStudent);
			if($totalRows <2) { echo "<br/><br/><center><font color='red'>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</font></center>"; }
			else {
	?>
  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%">
    <tr>
      <th colspan="6" align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>รายงานการเข้าร่วมกิจกรรมหน้าเสาธงนักเรียน
		<br/>ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?><br/>
		<form method="post" name="myform">
			<input type="checkbox" name="studstatus" value="1,2"
				onclick="document.myform.submit()" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา 
		</form>
	  </th>
    </tr>
		
    <tr bgcolor="#CCCCFF" > 
		<td colspan="6" bgcolor="white" align="center">
			<table cellpadding="0" cellspacing="1" align="center" bgcolor="linghtpink">
				<tr bgcolor="#FEEFEF" align="center" height="35px">
					<th width="60px">ห้อง</th>
					<th width="60px">มา</th>
					<th width="60px">กิจกรรม</th>
					<th width="60px">สาย</th>
					<th width="60px">ลา</th>
					<th width="60px">ขาด</th>
					<th width="60px">รวม</th>
					<th width="70px">% ขาด</th>
				</tr>
				<? $_a=0; $_b=0; $_c=0; $_d=0; $_e=0; $_sum=0; ?>
				<? while($dat = mysql_fetch_assoc($resStudent)){ ?>
				<tr bgcolor="white">
					<td align="center"><?=$dat['class_id']=="TOS"?"รวม":getFullRoomFormat($dat['class_id'])?></td>
					<td align='right'><?=number_format($dat['a'],0,'.',',')?></td>
					<td align='right'><?=($dat['b']!=0?number_format($dat['b'],0,'.',','):"-")?></td>
					<td align='right'><?=($dat['c']!=0?number_format($dat['c'],0,'.',','):"-")?></td>
					<td align='right'><?=($dat['d']!=0?number_format($dat['d'],0,'.',','):"-")?></td>
					<td align='right'><?=($dat['e']!=0?number_format($dat['e'],0,'.',','):"-")?></td>
					<td align='right'><b><?=number_format($dat['sum'],0,'.',',')?></b></td>
					<td align='right' bgcolor='#FEEFEF'><b><?=number_format((100 * $dat['e']/$dat['sum']),2,'.',',')?></b></td>
				</tr>
				<? $_a+=$dat['a']; $_b+=$dat['b']; $_c+=$dat['c']; $_d+=$dat['d']; $_e+=$dat['e']; $_sum+=$dat['sum'];  ?>
				<?	} mysql_free_result($resStudent); ?>
				<tr bgcolor='#FEEFEF'>
				  <td align="center"><b>ร้อยละ</b></td>
				  <td align='right'><b><?=number_format(100*$_a/$_sum,2,'.',',')?></b></td>
				  <td align='right'><b><?=number_format(100*$_b/$_sum,2,'.',',')?></b></td>
				  <td align='right'><b><?=number_format(100*$_c/$_sum,2,'.',',')?></b></td>
				  <td align='right'><b><?=number_format(100*$_d/$_sum,2,'.',',')?></b></td>
				  <td align='right'><b><?=number_format(100*$_e/$_sum,2,'.',',')?></b></td>
				  <td align='right'><b><?=number_format(100*$_sum/$_sum,2,'.',',')?></b></td>
				  <td align='right' >-</td>
			  </tr>
			</table>
		</td>
    </tr>
	<?php
	  }//ปิด if-else ตรวจสอบข้อมูลในฐานข้อมูล
	?>
</table>

</div>

