<div id="content">
<form name="myform" method="post">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_qa/index"><img src="../images/qa.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">งานประกันคุณภาพและมาตรฐาน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.1 ร้อยละของผู้เรียนที่มาโรงเรียนทันเวลา</strong></font></span></td>
		<td>
	  <?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_qa/2_1_studentBy800&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_qa/2_1_studentBy800&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	  	<font color="#000000" size="2"  >
			<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> onclick="document.myform.submit();" />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
			 </font>
	   </td>
    </tr>
  </table>
  </form>
<br/>
<? $_sql = "select timecheck_id,count(a.id) as 'count' from students a left outer join student_800 on (a.id = student_id) ";?>
<? $_sql .= " where  xedbe = '" . $acadyear . "' and acadyear = '" . $acadyear . "' " . ($_POST['studstatus']=="1,2"?"and studstatus in (1,2) ":"") . "  group by timecheck_id ";?>
<? $_result = mysql_query($_sql); ?>
<? if(mysql_num_rows($_result)>0) { ?>
		<table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
			<tr> 
				<th align="center">
					<img src="../images/school_logo.gif" width="120px"><br/><br/>
					การเช็คนักเรียนเข้าร่วมกิจกรรมหน้าเสาธง ปีการศึกษา <?=$acadyear?><br/>
					<? $_resTotal = mysql_query("select count(a.id) as 'total' from students a left outer join student_800 on (a.id = student_id) where  xedbe = '" . $acadyear . "' and acadyear = '" .$acadyear."' " . ($_POST['studstatus']=="1,2"?"and studstatus in (1,2) ":""));?>
					<? $_total = mysql_fetch_assoc($_resTotal); ?>
				</th>
			</tr>
			<tr>
				<td align="center">
					<table cellpadding="0" cellspacing="1">
						<tr>
							<td class="key" width="150px" align="center" rowspan="2">การเข้าร่วม</td>
							<td class="key" align="center" colspan="2">จำนวน(ครั้ง)</td>
						</tr>
						<tr>
							<td class="key" width="70px" align="center">รวม</td>
							<td class="key" width="100px" align="center">คิดเป็นร้อยละ</td>
						</tr>
						<?	$_sum; ?>
						<?	while($_dat = mysql_fetch_assoc($_result)){ ?>
						<tr>
							<td style="padding-left:25px;"><?=displayTimecheckID($_dat['timecheck_id'])?></td>
							<td style="padding-right:15px;" align="right"><?=$_dat['count']==0?"-":number_format($_dat['count'],0,'',',')?></td>
							<td align="center"><?=number_format($_dat['count']/$_total['total']*100,1,'.','')?></td>
						</tr>
						<?	$_sum+=$_dat['count'];?>
						<?	} mysql_free_result($_result); ?>
						<tr height="35px">
							<td class="key" align="center">รวม</td>
							<td class="key" align="right"><?=number_format($_sum,0,'',',')?></td>
							<td class="key" align="center"><?=number_format($_sum/$_total['total']*100,1,'.','')?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
<? }else {echo "<center><font color='red'><br/>ยังไม่มีข้อมูลในปีการศึกษา " . $acadyear . "</font></center>";} ?>
</div>
<?php
	function displayTimecheckID($id)
	{
		switch ($id) {
			case "00" :  return "มาปกติ"; break;
			case "01" :  return "กิจกรรม"; break;
			case "02" :  return "สาย"; break;
			case "03" :  return "ลา"; break;
			case "04" :  return "ขาด"; break;
		}	
	}
?>