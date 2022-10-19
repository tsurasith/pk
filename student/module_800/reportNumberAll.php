
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td width="350px"><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.2 รายงานสรุปรายภาคเรียน</strong></font></span></td>
       <td >&nbsp;</td>
    </tr>
  </table>

  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%" >
    <tr>
	<?php
		$_sql = "select acadyear,acadsemester,
								  sum(if(timecheck_id = '00',timecheck_id,null)+1) as a,
								  sum(if(timecheck_id = '01',timecheck_id,null)) as b,
								  sum(if(timecheck_id = '02',timecheck_id,null))/2 as c,
								  sum(if(timecheck_id = '03',timecheck_id,null))/3 as d,
								  sum(if(timecheck_id = '04',timecheck_id,null))/4 as e ,
								  count(class_id) as sum
								from student_800
								where student_id = '" . $_SESSION['username'] . "'
								group by student_id,acadyear,acadsemester";
				$_res = mysql_query($_sql);
	?>
      <td class="key" align="center" width="190px"><br/>
	  	<img src="../images/studphoto/id<?=$_SESSION['username']?>.jpg" width="160px">
	  	<br/>
	  	<br/>
	  </td>
	  <td valign="top">
	  		<font color="#663366"><b>
	  		รายงานการเข้าร่วมกิจกรรมหน้าเสาธงนักเรียน<br/>
			</b></font>
			<?php if(mysql_num_rows($_res) > 0 ) {  ?>
				<table cellspacing="1" cellpadding="2" bgcolor="#FFCCFF">
					<tr >
						<td width="160px" align="center"><b>ภาคเรียน/ปีการศึกษา</b></td>
						<td width="60px" align="center"><b>มา</b></td>
						<td width="60px" align="center"><b>กิจกรรม</b></td>
						<td width="60px" align="center"><b>สาย</b></td>
						<td width="60px" align="center"><b>ลา</b></td>
						<td width="60px" align="center"><b>ขาด</b></td>
						<td width="80px" align="center"><b>รวม</b></td>
						</tr>
					<? while($_dat = mysql_fetch_assoc($_res)) { ?>
					<tr bgcolor="#FFFFFF">
					  <td align="center"><?=$_dat['acadsemester'].'/'.$_dat['acadyear']?></td>
					  <td align="center"><?=($_dat['a']!=""?$_dat['a']:"-")?></td>
					  <td align="center"><?=($_dat['b']!=""?$_dat['b']:"-")?></td>
					  <td align="center"><?=($_dat['c']!=""?$_dat['c']:"-")?></td>
					  <td align="center"><?=($_dat['d']!=""?$_dat['d']:"-")?></td>
					  <td align="center"><?=($_dat['e']!=""?$_dat['e']:"-")?></td>
					  <td align="center"><?=($_dat['sum']!=""?$_dat['sum']:"-")?></td>
					 </tr>
					 <? } //end while ?>
				</table>
		<?php } //end if
				else
				{
					echo "<font color='pink' size='4'>";
					echo "<br/><br/>ไม่มีรายการข้อมูลกิจกรรมหน้าเสาธง<br/>";
					//echo $_sql;
					echo "</font>";
				} ?>
	  </td>
    </tr>
</table>

</div>
