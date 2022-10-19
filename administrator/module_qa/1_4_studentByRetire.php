<div id="content">
<form name="myform" method="post">
<?php
	if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
	if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
?>
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      	<td width="6%" align="center"><a href="index.php?option=module_qa/index"><img src="../images/qa.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td><strong><font color="#990000" size="4">งานประกันคุณภาพและมาตรฐาน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.4 แสดงร้อยละการออกกลางคันของผู้เรียนตั้งแต่ปี <?=$acadyear-1?>-<?=$acadyear+1?></strong></font></span></td>
		<td>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_qa/1_4_studentByRetire&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_qa/1_4_studentByRetire&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		</font>
		<br/>
	  	<font color="#000000" size="2"  >
			<? $_resStatus = mysql_query("select * from ref_studstatus where studstatus not in (1,2) order by 1 "); ?>
			เลือกเหตุผลที่ไม่มาเรียน
			<select name="studstatus" class="inputboxUpdate" onchange="document.myform.submit();">
				<option value=""></option>
				<? while($_datStatus = mysql_fetch_assoc($_resStatus)) { ?>
						<option value="<?=$_datStatus['studstatus']?>" <?=isset($_POST['studstatus'])&&$_POST['studstatus']==$_datStatus['studstatus']?"selected":""?>><?=$_datStatus['studstatus_description']?></option>
				<? } ?>
			</select>
		</font>
	   </td>
    </tr>
  </table>
  </form>
<br/>
<? if($_POST['studstatus'] != ""){ ?>
		<? mysql_query("set @x = (select count(*) from students where xedbe = '" . ($acadyear-1) . "')"); ?>
		<? mysql_query("set @y = (select count(*) from students where xedbe = '" . $acadyear . "')"); ?>
		<? mysql_query("set @z = (select count(*) from students where xedbe = '" . ($acadyear+1) . "')");?>
		<? $_sql = "select xlevel,xyearth,
					  sum(if(xedbe = " . ($acadyear-1) . ",1,0)) as 'a1',
					  sum(if(xedbe = " . ($acadyear-1) . ",1,0))*100/@x as 'a2',
					  sum(if(xedbe = " . $acadyear . ",1,0)) as 'b1',
					  sum(if(xedbe = " . $acadyear . ",1,0))*100/@y as 'b2',
					  sum(if(xedbe = " . ($acadyear+1) . ",1,0)) as 'c1',
					  sum(if(xedbe = " . ($acadyear+1) . ",1,0))*100/@z as 'c2'
					from students where studstatus = '" . $_POST['studstatus'] . "' group by xlevel,xyearth";?>
		<? $_result = mysql_query($_sql); ?>
		<? if(mysql_num_rows($_result)>0) { ?>
				<table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
					<tr> 
						<th align="center">
							<img src="../images/school_logo.gif" width="120px"><br/><br/>
							ร้อยละการออกกลางคันของผู้เรียน ปีการศึกษา <?=$acadyear-1?>-<?=$acadyear+1?><br/>
						</th>
					</tr>
					<tr>
						<td align="center">
							<table cellpadding="0" cellspacing="1">
								<tr>
									<td class="key" width="150px" align="center" rowspan="3">ระดับชั้น</td>
									<td class="key" align="center" colspan="6">ปีการศึกษา</td>
								</tr>
								<tr>
									<td class="key" colspan="2" align="center"><?=$acadyear-1?></td>
									<td class="key" colspan="2" align="center"><?=$acadyear?></td>
									<td class="key" colspan="2" align="center"><?=$acadyear+1?></td>
								</tr>
								<tr>
									<td class="key" width="60px" align="center">จำนวน</td>
									<td class="key" width="70px" align="center">คิดเป็น<br/>ร้อยละ</td>
									<td class="key" width="60px" align="center">จำนวน</td>
									<td class="key" width="70px" align="center">คิดเป็น<br/>ร้อยละ</td>
									<td class="key" width="60px" align="center">จำนวน</td>
									<td class="key" width="70px" align="center">คิดเป็น<br/>ร้อยละ</td>
								</tr>
								<?	$_a1;$_a2;$_b1;$_b2;$_c1;$_c2; ?>
								<?	while($_dat = mysql_fetch_assoc($_result)){ ?>
								<tr>
									<td style="padding-left:10px;">มัธยมศึกษาปีที่ <?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?></td>
									<td style="padding-right:15px;" align="right"><?=$_dat['a1']==0?"-":$_dat['a1']?></td>
									<td style="padding-right:15px;" align="right"><?=$_dat['a2']==0?"-":number_format($_dat['a2'],2,'.','')?></td>
									<td style="padding-right:15px;" align="right"><?=$_dat['b1']==0?"-":$_dat['b1']?></td>
									<td style="padding-right:15px;" align="right"><?=$_dat['b2']==0?"-":number_format($_dat['b2'],2,'.','')?></td>
									<td style="padding-right:15px;" align="right"><?=$_dat['c1']==0?"-":$_dat['c1']?></td>
									<td style="padding-right:15px;" align="right"><?=$_dat['c2']==0?"-":number_format($_dat['c2'],2,'.','')?></td>
								</tr>
								<?	$_a1+=$_dat['a1'];  $_a2+=$_dat['a2'];  $_b1+=$_dat['b1'];  $_b2+=$_dat['b2']; ?>
								<?  $_c1+=$_dat['c1'];  $_c2+=$_dat['c2']; ?>
								<?	} mysql_free_result($_result); ?>
								<tr height="35px">
									<td class="key" align="center">รวม</td>
									<td class="key" align="right"><?=$_a1==0?"-":$_a1?></td>
									<td class="key" align="right"><?=$_a2==0?"-":number_format($_a2,2,'.','')?></td>
									<td class="key" align="right"><?=$_b1==0?"-":$_b1?></td>
									<td class="key" align="right"><?=$_b2==0?"-":number_format($_b2,2,'.','')?></td>
									<td class="key" align="right"><?=$_c1==0?"-":$_c1?></td>
									<td class="key" align="right"><?=$_c2==0?"-":number_format($_c2,2,'.','')?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
		<? }else {echo "<center><font color='red'><br/>ยังไม่มีข้อมูลในปีการศึกษา " . $acadyear . "</font></center>";} ?>
<? } //end if ?>
</div>

