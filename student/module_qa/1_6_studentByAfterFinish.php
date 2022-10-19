<div id="content">
<form name="myform" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_qa/index"><img src="../images/qa.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">งานประกันคุณภาพและมาตรฐาน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.6 แสดงจำนวนของผู้เรียนที่จบหลักสูตรแล้วศึกษาต่อ ประกอบอาชีพ และอื่นๆ</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_qa/1_6_studentByAfterFinish&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_qa/1_6_studentByAfterFinish&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	  	<font color="#000000" size="2"  >
			 </font>
	   </td>
    </tr>
  </table>
  </form>
<br/>
<? $_sql = "select xlevel,xyearth,
				sum(if(nextacademic='01' || nextacademic='02' || nextacademic='03' || nextacademic='04' || nextacademic='05' || nextacademic='06',1,0)) as 'learn',
				sum(if(nextacademic='07' || nextacademic='08' || nextacademic='09',1,0)) as 'work',
				sum(if(nextacademic='00' || nextacademic is null,1,0)) as 'other',
				count(id) as 'sum'
			from students where xedbe = '" . $acadyear . "' and studstatus = 2 group by xlevel,xyearth" ;?>
<? $_result = mysql_query($_sql); ?>
<? if(mysql_num_rows($_result)>0) { ?>
		<table class="admintable" width="100%" align="center">
			<tr> 
				<th align="center">
					<img src="../images/school_logo.gif" width="120px"><br/><br/>
					แสดงจำนวนผู้ที่จบหลักสูตรแล้วศึกษาต่อ ประกอบอาชีพ<br/>และอื่นๆ ปีการศึกษา <?=$acadyear?><br/>
					<? $_resTotal = mysql_query("select count(id) as 'total' from students where xedbe = '" . $acadyear . "' and studstatus = '2' ");?>
					<? $_total = mysql_fetch_assoc($_resTotal); ?>
				</th>
			</tr>
			<tr>
				<td align="center">
					<table cellpadding="0" cellspacing="1">
						<tr>
							<td class="key" width="150px" align="center" rowspan="3">ระดับชั้น</td>
							<td class="key" align="center" colspan="6">จำนวนนักเรียน(คน)</td>
							<td class="key" align="center" width="80px" rowspan="3">รวม(คน)</td>
						</tr>
						<tr>
							<td class="key" align="center" colspan="2">ศึกษาต่อ</td>
							<td class="key" align="center" colspan="2">ประกอบอาชีพ</td>
							<td class="key" align="center" colspan="2">อื่นๆ</td>
						</tr>
						<tr>
							<td class="key" width="50px" align="center">จำนวน</td>
							<td class="key" width="50px" align="center">ร้อยละ</td>
							<td class="key" width="50px" align="center">จำนวน</td>
							<td class="key" width="50px" align="center">ร้อยละ</td>
							<td class="key" width="50px" align="center">จำนวน</td>
							<td class="key" width="50px" align="center">ร้อยละ</td>
						</tr>
						<?	$_learn; $_work; $_other; $_sum; ?>
						<?	while($_dat = mysql_fetch_assoc($_result)){ ?>
						<tr>
							<td style="padding-left:10px;">มัธยมศึกษาปีที่ <?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['learn']==0?"-":$_dat['learn']?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['learn']==0?"-":number_format($_dat['learn']*100/$_dat['sum'],1,'.','')?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['work']==0?"-":$_dat['work']?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['work']==0?"-":number_format($_dat['work']*100/$_dat['sum'],1,'.','')?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['other']==0?"-":$_dat['other']?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['other']==0?"-":number_format($_dat['other']*100/$_dat['sum'],1,'.','')?></td>
							<td align="center"><?=number_format($_dat['sum'],0,'.','')?></td>
						</tr>
						<?	$_learn+=$_dat['learn'];$_work+=$_dat['work']; $_other+=$_dat['other']; $_sum+=$_dat['sum'];?>
						<?	} mysql_free_result($_result); ?>
						<tr height="35px">
							<td class="key" align="center">รวม</td>
							<td class="key" align="right"><?=$_learn>0?$_learn:"-"?></td>
							<td class="key" align="right"><?=$_learn>0?number_format($_learn*100/$_total['total'],1,'.',''):"-"?></td>
							<td class="key" align="right"><?=$_work>0?$_work:"-"?></td>
							<td class="key" align="right"><?=$_work>0?number_format($_work*100/$_total['total'],1,'.',''):"-"?></td>
							<td class="key" align="right"><?=$_other>0?$_other:"-"?></td>
							<td class="key" align="right"><?=$_other>0?number_format($_other*100/$_total['total'],1,'.',''):"-"?></td>
							<td class="key" align="center"><?=$_total['total']?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
<? }else {echo "<center><font color='red'><br/>ยังไม่มีข้อมูลในปีการศึกษา " . $acadyear . "</font></center>";} ?>
</div>
<?php
	function displayClass($_id)
	{
		$_xlevel = substr($_id,0,1);
		$_xyearth = substr($_id,2,1);
		if($_xlevel == 0) { return "ของนักเรียนทั้งหมด"; }
		else { return "นักเรียนชั้นมัธยมศึกษาปีที่ " . ($_xlevel == 3 ? $_xyearth : $_xyearth + 3); }
	}
?>