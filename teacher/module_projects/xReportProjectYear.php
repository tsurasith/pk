<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_projects/index">
			<img src="../images/computer.png" alt="" width="48" height="48" border="0"/>
		</a>
	  </td>
    <td ><strong><font color="#990000" size="4">ระบบสารสนเทศกิจกรรม/โครงการ</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>2.2.5 รายชื่อกิจกรรมโครงการ งบประมาณ<br/> และฝ่ายที่รับผิดชอบกิจกรรมโครงการ</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_projects/xReportProjectYear&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_projects/xReportProjectYear&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		<br/>
		<form method="post" name="myform">
			<font size="2" color="#000000">
				<input type="checkbox" value="1" name="budgetType" onclick="document.myform.submit();" <?=$_POST['budgetType']=="1"?"checked":""?> /> เฉพาะเงินงบประมาณแผ่นดิน
			</font>
		</form>
	  </td>
    </tr>
  </table>
<?	$_sql = "select a.project_id,a.project_name,a.start_date,a.finish_date,
			  a.budget_income,sum(b.money) as money,a.budget_income-sum(b.money) as total,
			  a.budget_academic
			from project a left outer join project_budget b on (a.project_id = b.project_id)
			where acadyear = '" . $acadyear . "' "; ?>
<? $_sql .= ($_POST['budgetType']!="1"?"":" and a.budget_type = '00' ");	?>
<? $_sql .= " group by a.project_id order by acadyear,acadsemester"; ?>
<?	$_res = @mysql_query($_sql); ?>
<?	if(@mysql_num_rows($_res)>0) { ?>
	<table class="admintable" align="center">
		<tr>
			<th colspan="8" align="center">
				<img src="../images/school_logo.gif" width="120px"><br/>
				รายงานกิจกรรมโครงการ<br/>
				ปีการศึกษา <?=$acadyear?>
			</th>
		</tr>
		<tr align="center">
			<td class="key" width="35px" rowspan="2">ที่</td>
			<td class="key" width="205px" rowspan="2">กิจกรรมโครงการ</td>
			<td class="key" width="80px" rowspan="2">วันที่เริ่ม</td>
			<td class="key" width="80px" rowspan="2">วันที่สิ้นสุด</td>
			<td class="key" colspan="3">งบประมาณ</td>
			<td class="key" width="100px" rowspan="2">ฝ่ายที่รับผิดชอบ</td>
		</tr>
		<tr align="center">
			<td class="key" width="100px">อนุมัติ</td>
			<td class="key" width="100px">ใช้จริง</td>
			<td class="key" width="100px">คงเหลือ</td>
		</tr>
		<? $_i = 1; $_a=0; $_b=0; $_c=0; ?>
		<? while($_dat = mysql_fetch_assoc($_res)){ ?>
			<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
				<td align="center" valign="top"><?=$_i++?></td>
				<td align="left" valign="top"><?=$_dat['project_name']?></td>
				<td align="center" valign="top"><?=displayDateChart($_dat['start_date'])?></td>
				<td align="center" valign="top"><?=displayDateChart($_dat['finish_date'])?></td>
				<td align="right" valign="top"><?=$_dat['budget_income']>0?number_format($_dat['budget_income'],2,'.',','):"-"?></td>
				<td align="right" valign="top"><?=$_dat['money']==""?"ยังไม่มีการใช้เงิน":number_format($_dat['money'],2,'.',',')?></td>
				<td align="right" valign="top"><?=$_dat['money']==""?number_format($_dat['budget_income'],2,'.',','):number_format($_dat['total'],2,'.',',')?></td>
				<td align="left" valign="top"><?=$_dat['budget_academic']?></td>
			</tr>	
			<? $_a += ($_dat['budget_income']>0?$_dat['budget_income']:0); ?>
			<? $_b += ($_dat['money']==""?0:$_dat['money']); ?>
			<? $_c += ($_dat['money']==""?$_dat['budget_income']:$_dat['total']); ?>
		<? }//end while ?>
		<tr height="30px">
			<td align="center" colspan="4" class="key">รวม</td>
			<td align="right" class="key"><?=number_format($_a,2,'.',',')?></td>
			<td align="right" class="key"><?=number_format($_b,2,'.',',')?></td>
			<td align="right" class="key"><?=number_format($_c,2,'.',',')?></td>
		</tr>
	</table>
<?	}else { ?><center><font color="#FF0000"><br/><br/>ไม่พบข้อมูลที่ต้องการ</font></center> <? } //end if ?>
</div>


