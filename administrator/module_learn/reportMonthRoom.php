<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.2 รายงานการเข้าเรียนสายของนักเรียน <br/>ตามห้องเรียนตัวเลขสถิติ [รายเดือน]</strong></font></span></td>
       <td >
		<?php
			$_error = 1;
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
					echo "<a href=\"index.php?option=module_learn/reportMonthRoom&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_learn/reportMonthRoom&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_learn/reportMonthRoom&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_learn/reportMonthRoom&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form action="" method="post">
		<font color="#000000" size="2"  > 
			เลือกเดือน
			<select name="month" class="inputboxUpdate">
			 	<option value=""></option>
				<?php
					$_sqlMonth = "select distinct month(check_date)as m,year(check_date)+543 as y
									from student_learn where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
									order by year(check_date),month(check_date)";
					$_resMonth = mysql_query($_sqlMonth);
					while($_datMonth = mysql_fetch_assoc($_resMonth))
					{
						$_select = (isset($_POST['month'])&&$_POST['month'] == $_datMonth['m']?"selected":"");
						echo "<option value=\"" . $_datMonth['m'] . "\" $_select >" . displayMonth($_datMonth['m']) . ' ' . $_datMonth['y'] . "</option>";
					} mysql_free_result($_resMonth);
				?>
			 </select>
			 <input type="submit" value="เรียกดู" class="button" name="search"/>
		  </font>
		  </form>
	  </td>
    </tr>
  </table>

  <?php
  $xlevel;
  $xyearth;
  if($_POST['roomID'] != "all")
  {
  	$xlevel = substr($_POST['roomID'],0,1);;
	$xyearth = substr($_POST['roomID'],2,1);
  }
  ?>

  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%" >
    <tr>
	<?php
		if(isset($_POST['search']) && $_POST['month'] == "")
		{
			echo "<td align='center'><br/><font color='red'>กรุณาเลือกห้องหรือเดือนที่ต้องการทราบข้อมูลก่อน !</font></td></tr>";
		}
		else if(isset($_POST['search']) && $_POST['month'] != "")
		{
			$sqlStudent = "select class_id,count(timecheck_id) as late from student_learn
								where acadyear = '" . $acadyear . "' and acadsemester = '". $acadsemester . "' and timecheck_id = '02'
									and month(check_date) = '" . $_POST['month'] . "'
								group by class_id
								order by class_id";
			$resStudent = mysql_query($sqlStudent);
			$totalRows = mysql_num_rows($resStudent);
			if($totalRows == 0)
			{
				echo "<td align='center'><br/><font color='red'>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</font></td></tr>";
				$error = 0;
			}
			else{
	?>	 
     	<td align="center">
			<table class="admintable">
				<tr>
					 <th colspan="2" align="center">
						<img src="../images/school_logo.gif" width="120px"><br/>
						<b>รายงานการเข้าห้องเรียน <b><u>สาย</u></b> <br/>
						ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
						<br/>ประจำเดือน <?php echo displayMonth($_POST['month']); ?></b>
					  </th>
					</tr>
					<tr> 
						<td class="key" align="center" width="200px">ห้อง</td>
						<td class="key" align="center" width="130px">จำนวนนักเรียนที่<br/>เข้าเรียนสาย(ครั้ง)</td>
					</tr>
					<? $_sum = 0 ; ?>
					<? while($dat = mysql_fetch_assoc($resStudent)) { ?>
					<tr>
						<td align="center">ชั้นมัธยมศึกษาปีที่ <?=getFullRoomFormat($dat['class_id'])?></td>
						<td align="right" style="padding-right:40px"><b><?=$dat['late']?></b></td>
					</tr>
					<? $_sum += $dat['late'];?>
					<?	} mysql_free_result($resStudent); //end while ?>
					<tr height="30px">
						<td class="key" align="center">รวม</td>
						<td class="key" align="right" style="padding-right:40px"><?=$_sum?></td>
					</tr>
			</table>
		</td>
	</tr>
<?
  }//ปิด if-else ตรวจสอบข้อมูลในฐานข้อมูล
}//ปิด if-else ตรวจสอบการเลือกวันที่
?>
</table>

</div>

