
<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
       <td width="6%" align="center">
	  	<a href="index.php?option=module_projects/index">
			<img src="../images/computer.png" alt="" width="48" height="48" border="0"/>
		</a>
	  </td>
    <td ><strong><font color="#990000" size="4">ระบบสารสนเทศกิจกรรม/โครงการ</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>1.รายชื่อกิจกรรม/โครงการทั้งหมด</strong></font></span></td>
      <td align="right">
	  	<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_projects/projectListAll&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_projects/projectListAll&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_projects/projectListAll&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_projects/projectListAll&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
	  </td>
    </tr>
  </table>
<? 
	$_totalRows; 
	$_disPlay = 25;
	$_currentPage = (isset($_REQUEST['page'])?$_REQUEST['page']:1);
	$_num = (($_currentPage - 1) * $_disPlay ) + 1;
 
	$_sql = "select * from project
			where acadyear = '" .$acadyear . "' and acadsemester = '" .$acadsemester . "' ";
	
	$_sqlAll = $_sql; // นับจำนวนแถวทั้งหมด
	$_sql .= " order by 1 ";
	$_sql .= " limit " . ($_num-1)  . "," . ($_disPlay);
	$_result = mysql_query($_sql);
	//echo $_sql ;
	@$_totalRows = mysql_num_rows(mysql_query($_sqlAll));
?>
	<table width="100%" align="center" cellspacing="1" class="admintable" border="0" cellpadding="3">
      <tr> 
        <th colspan="6" align="left">
				รายการแสดงข้อมูลกิจกรรมโครงการ<br/>
				ประจำภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
		</th>
	  </tr>
	  <tr height="30px">
	  	<td class="key" width="40px" align="center">ที่</td>
	  	<td class="key" width="100px" align="center">รหัสกิจกรรม/โครงการ</td>
		<td class="key" align="center">ชื่อกิจกรรม/โครงการ</td>
		<td class="key" width="80px" align="center">งบประมาณ<br/>(บาท)</td>
		<td class="key" width="110px" align="center">ผลตามเป้าหมาย</td>
	  </tr>
	<? if(mysql_num_rows($_result) > 0) { ?>
		<? while($_dat = mysql_fetch_assoc($_result)){ ?>
		<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
			<td align="center" valign="top"><?=$_num++?></td>
			<td align="center" valign="top"><?=$_dat['project_id']?></td>
			<td valign="top">
				<a href="index.php?option=module_projects/projectFull&p_id=<?=$_dat['project_id']?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">
				<?=$_dat['project_name']?>
				</a>
			</td>
			<td align="right" valign="top"><?=number_format($_dat['budget_income'],2,'.',',')?></td>
			<td align="center" valign="top"><?=$_dat['purpose']==1?"ผ่านเกณฑ์":"ไม่ผ่านเกณฑ์"?></td>
		<tr>
		<? } mysql_free_result($_result); //end while ?>
		<tr>
	  	<td>&nbsp;</td><td>&nbsp;</td>
		<td colspan="4" align="center">
			หน้าที่ <?=displayText($_currentPage)?> จากจำนวนทั้งหมด <?=displayText(ceil($_totalRows/$_disPlay))?> หน้า<br/>
			รายการที่ <?=displayText((($_currentPage - 1) * $_disPlay ) + 1)?>
			ถึง <?=displayText(($_currentPage * $_disPlay))?> 
			จากจำนวนทั้งหมด <?=displayText($_totalRows)?> รายการ <br/>
			<? if($_currentPage != 1){ ?>
				<a href="index.php?option=module_projects/projectListAll&page=<?=$_currentPage-1?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">&lt;&lt;หน้าก่อนหน้า</a>
			<? } //end if ?>
			 || 
			<? if($_currentPage != (ceil($_totalRows/$_disPlay))) { ?>
				<a href="index.php?option=module_projects/projectListAll&page=<?=$_currentPage+1?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">หน้าถัดไป&gt;&gt;</a>
			<? } //end if ?>
		</td>
	  </tr>
	<? }else { //end if check rows ?>
		
		<tr><td>&nbsp;</td><td colspan="5">ไม่พบข้อมูลที่ต้องการ</td></tr>
	<? } //end else check rows ?> 
	 </table>
</div>

