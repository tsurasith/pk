
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_learn/index"><img src="../images/history.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Room Tracking</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.3 รายงานสรุปการเข้าห้องเรียนสาย</strong></font></span></td>
      <td >
	  	
	  </td>
    </tr>
  </table>

  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%" >
    <tr>
	<?php
		$_sql = "select acadyear,acadsemester,count(*) as late
				  from student_learn
				  where student_id = '" . $_SESSION['username'] . "' and timecheck_id = 02
				group by student_id,acadyear,acadsemester
				order by acadyear,acadsemester";
				$_res = mysql_query($_sql);
				
	?>
      <td class="key" align="center" width="190px"><br/>
	  	<img src="../images/studphoto/id<?=$_SESSION['username']?>.jpg" width="160px">
	  	<br/>
	  	<br/>
	  </td>
	  <td valign="top">
	  		<font color="#663366"><b>
	  		รายงานสรุปการเข้าห้องเรียนสายของนักเรียน<br/></b></font>
			<?php if(mysql_num_rows($_res) > 0 ) {  ?>
				<table cellspacing="1" cellpadding="2"  class="admintable">
					<tr >
						<td class="key" width="200px" align="center"><b>ภาคเรียน/ปีการศึกษา</b></td>
						<td class="key" width="80px" align="center"><b>จำนวนครั้ง<br/>(สาย)</b></td>
					</tr>
					<? while ($_dat = mysql_fetch_assoc($_res)) { ?>
					<tr>
					  <td align="center"><?=$_dat['acadsemester'].'/'.$_dat['acadyear']?></td>
					  <td align="center"><?=$_dat['late']?></td>
					 </tr>
					 <? } //end while ?>
				</table>
		<?php } //end if
				else
				{
					echo "<font color='pink' size='4'>";
					echo "<br/><br/>ไม่มีรายการข้อมูลการเข้าห้องเรียนสาย <br/>";
					//echo $_sql;
					echo "</font>";
				} ?>
	  </td>
    </tr>
</table>

</div>
