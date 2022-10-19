<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
	<tr> 
	  <td width="6%" align="center"><a href="index.php?option=module_color/index"><img src="../images/color.png" alt="กิจกรรมคณะสี" width="48" height="48" border="0"/></a></td>
	  <td><strong><font color="#990000" size="4">กิจกรรมคณะสี</font></strong><br />
		<span class="normal"><font color="#0066FF"><strong>ระบบบริหารจัดการงานคณะสี</strong></font></span></td>
	  <td width="300px">
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
						echo "<a href=\"index.php?option=module_color/FormCountStudentByColor&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
						echo '<font color=\'blue\'>' .$acadyear . '</font>';
						echo " <a href=\"index.php?option=module_color/FormCountStudentByColor&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
					?>
			<br/>
		</font>
	  
	  </td>
	</tr>
</table>
<?php
	$_sql = "select color,xlevel,count(*)as 'sum' from students
        		where xedbe = '" .$acadyear . "' and length(color)>2 and studstatus in (1,2)
				group by color,xlevel
       		 order by color,xlevel";
	$_result = mysql_query($_sql);
	if($_result)
	{ ?>
		<table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" >
			<tr>
				<td class="key" align="center" colspan="4">
					<img src="../images/school_logo.gif" width="120px">
					<br/>
					สรุปจำนวนนักเรียนตามคณะสี<br/>
					ประจำภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
					<br/>
				</td>
			</tr>
			<tr bgcolor="#CCCCFF" height="35px" > 
				<td width="50px" align="center">-</td>
				<td width="110px" align="center" >คณะสี</td>
				<td width="250px" align="center" >ระดับชั้น</td>
				<td align="center" width="90px">จำนวน(คน)</td>
			</tr>
			<?php
			$_i = 1;
			while($_dat = mysql_fetch_assoc($_result))
			{
			?>
			<tr bgcolor="#CCCCCC">
				<td align="center">-</td>
				<td align="center"><?=$_dat['color']?></td>
				<td >ระดับชั้นมัธยมศึกษาตอน<?=($_dat['xlevel']==4)?"ปลาย":"ต้น"?></td>
				<td align="center"><?=($_dat['sum'])?></td>
			</tr>
			<?php
			} //end-while
			$_sqlEmpty = "(select count(*) as 'sum' from students where length(color) < 2 and xedbe = '" . $acadyear . "' and studstatus in (1,2))
						  union all
						  (select count(*) as 'sum' from students where color is null and xedbe = '" . $acadyear . "' and studstatus in (1,2))";
			$_resultEmpty = mysql_query($_sqlEmpty);
			$_datEmpty = mysql_fetch_assoc($_resultEmpty);
			?>
			<tr bgcolor="#CCCCCC">
				<td colspan="3" rowspan="2" align="center">จำนวนที่ยังไม่ระบุคณะสี</td>
				<td align="center"><?=$_datEmpty['sum']?></td>
				<?php
					$_datEmpty = mysql_fetch_assoc($_resultEmpty);
				?>
			</tr>
			<tr bgcolor="#CCCCCC">
				<td align="center"><?=$_datEmpty['sum']?></td>
			</tr>
		</table>
		<?php
	} // end if
	else
		{ ?>
			<div align="center"><font color="red">ไม่พบข้อมูลที่ต้องการ</font></div>
		<?php	
		}
	?>
</div>
