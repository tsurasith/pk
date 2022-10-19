<div id="content">
<form action="" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.3.2 รายชื่อนักเรียนที่พ้นสภาพตามประเภทสาเหตุ<br/>และวันที่ออก (รายปีการศึกษา)</strong></font></span></td>
      <td >
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_history/reportStudstatus&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_history/reportStudstatus&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	  	<font  size="2" color="#000000">สถานภาพ </font>
			<select id="studstatus" name="studstatus" class="inputboxUpdate">
				<option value=""></option>
				<? $_resStatus = mysql_query("SELECT * FROM ref_studstatus");?>
				<? while($_datStatus = mysql_fetch_assoc($_resStatus)) {  ?>
								<option value="<?=$_datStatus['studstatus']?>" <?=($_POST['studstatus']==$_datStatus['studstatus']?"SELECTED":"")?>><?=$_datStatus['studstatus_description']?></option>
				<? }mysql_free_result($_resStatus); ?>
			</select>
	  		<input type="submit" value="เรียกดู" class="button" name="search"/>
	   </td>
    </tr>
  </table>
  </form>

<? if(isset($_POST['search']) && $_POST['studstatus'] == "") { ?>
		<br/><br/><center><font color='red'>กรุณาเลือกสถานภาพของนักเรียนที่ต้องการทราบข้อมูลก่อน</font></center>
<? } ?>

<? if(isset($_POST['search']) && $_POST['studstatus'] != "") {
			$sqlStudent = "select id,prefix,firstname,lastname,nickname,xlevel,xyearth,room,studstatus,points,
									retirecause,students.leave
								from students
								where xedbe = '" .$acadyear . "' and studstatus = '" . $_POST['studstatus'] . "'
								order by  xlevel,xyearth,room,sex,id";			
			$resStudent = mysql_query($sqlStudent);
			$ordinal = 1;
			$totalRows = mysql_num_rows($resStudent);
			if($totalRows == 0)
			{
				echo "<br/><br/><center><font color='red'>ไม่พบข้อมูลตามเงื่อนไข</font></center>";
				$error = 0;
			}
			else{
	?>	 
   <table class="admintable" align="center">
	 <tr> 
	  <th colspan="6" align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>
        รายชื่อนักเรียนสถานภาพ : <?=displayStudentStatusColor($_POST['studstatus'])?> <br/>
        ปีการศึกษา <?=$acadyear?>
		<br/>
      </th>
    </tr>
    <tr> 
		<td class="key" width="45px" align="center" >เลขที่</td>
      	<td class="key" width="85px" align="center" >เลขประจำตัว</td>
      	<td class="key" width="190px" align="center" >ชื่อ - นามสกุล</td>
		<td class="key" width="45px" align="center" >ห้อง</td>
      	<td class="key" width="120px"  align="center" >วันที่ออก</td>
		<td class="key" width="200px" align="center" >กลุ่มสถานภาพ/สาเหตุ</td>
    </tr>

	<? for($i = 0; $i < $totalRows ; $i++) { ?>
		<? $dat = mysql_fetch_array($resStudent); ?>
		<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF">	
			<td align="center" valign="top"><?=$ordinal++?></td>
			<td align="center" valign="top"><?=$dat['id']?></td>
			<td valign="top"><?=displayPrefix($dat['prefix']) . $dat['firstname'] . " " . $dat['lastname']?></td>
			<td align="center" valign="top"><?=displayRoomTable($dat['xlevel'] , $dat['xyearth']) . "/" .$dat['room']?></td>
			<td align="center" valign="top"><?=displayThaiDate($dat['leave'])?></td>
			<td valign="top"><?=$dat['retirecause']!=""?displayRetirecause($dat['retirecause']):"-"?></td>
		</tr>
		<? } //end for loop ?>
	<?  }//ปิด if-else ตรวจสอบข้อมูลในฐานข้อมูล
	}//ปิด if-else ตรวจสอบการเลือกวันที่
	?>
</table>

</div>


