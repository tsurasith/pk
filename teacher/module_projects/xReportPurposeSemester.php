
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_projects/index">
			<img src="../images/computer.png" alt="" width="48" height="48" border="0"/>
		</a>
	  </td>
    <td ><strong><font color="#990000" size="4">ระบบสารสนเทศกิจกรรม/โครงการ</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>2.1.2 รายงานสรุปกิจกรรมโครงการตามเกณฑ์เป้าหมาย<br/>(ผ่าน/ไม่ผ่าน)</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_projects/xReportPurposeSemester&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_projects/xReportPurposeSemester&acadyear=" . ($acadyear + 1) . "\"> <img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else { echo " <a href=\"index.php?option=module_projects/xReportPurposeSemester&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ; }
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else { echo " <a href=\"index.php?option=module_projects/xReportPurposeSemester&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ; }
				?>
		<font size="2" color="#000000">
			<form method="post" autocomplete="off">
				เป้าหมายเชิงปริมาณ
				<select name="purpose" class="inputboxUpdate">
					<option value=""></option>
					<option value="1" <?=isset($_POST['purpose'])&&$_POST['purpose']=="1"?"selected":""?>>ผ่านเกณฑ์</option>
					<option value="0" <?=isset($_POST['purpose'])&&$_POST['purpose']=="0"?"selected":""?>>ไม่ผ่านตามเกณฑ์</option>
				</select>
				<input type="submit" value="เรียกดู" class="button" />
			</form>
		</font>
	  </td>
    </tr>
  </table>
  
<? if($_POST['purpose']==""){ ?>  
<?php
	$_sql = "select purpose,count(project_id) as num,sum(budget_income) as income from project where acadyear = '" .$acadyear. "' and acadsemester = '" . $acadsemester ."' group by purpose order by purpose desc";
	$_result = mysql_query($_sql);
	if(mysql_num_rows($_result)>0)
	{
		$_xmlColumn = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlPie = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlColumn .= "<graph caption='' xAxisName='' yAxisName='Bath' formatNumberScale='0' decimalPrecision='0'>";
		$_xmlPie .="<graph caption='' decimalPrecision='0' showPercentageValues='1' showNames='1'  showValues='1'  pieYScale='65' pieSliceDepth='25' pieRadius='100'>";
		
		$_catXML = "<categories>";
		$_setA = "<dataset seriesname=''  showValue='1'>";
		$_m = 0; $_cm = 0;
		$_f = 0; $_cf = 0;
		while($_dat = mysql_fetch_assoc($_result))
		{
			$_catXML .= "<category name='" . ($_dat['purpose']==0?"ไม่่่ผ่านเกณฑ์":"ผ่านเกณฑ์") . "' hoverText=''/>";
			$_setA .= "<set value='" . $_dat['income'] . "' " . ($_dat['purpose']==0?"color = 'FF9900'":"color = '0099FF'"). " />";
			if($_dat['purpose']==1) { $_m += $_dat['income']; $_cm=$_dat['num']; }
			else { $_f += $_dat['income']; $_cf=$_dat['num']; }
		}
		$_catXML .= "</categories>";
		$_setA .= "</dataset>";
		$_xmlColumn .= $_catXML . $_setA . "</graph>";
		
		if($_m>0) $_xmlPie .= "<set value='" . $_m . "' name='ผ.' color='0099FF'/>";
		if($_f>0) $_xmlPie .= "<set value='" . $_f . "' name='มผ.' color='FF9900'/>";
		$_xmlPie .= "</graph>";
		
?>
		<table class="admintable" width="100%" align="center" >
			<tr>
				<th colspan="2" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>
					รายงานกิจกรรมโครงการตามเกณฑ์เป้าหมายและเงินงบประมาณที่ใช้จ่ายในกิจกรรม/โครงการ<br/>
					ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
				</th>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<table class="admintable">
						<tr>
							<td class="key" align="center" width="200px">เป้าหมายเชิงปริมาณ/คุณภาพ</td>
							<td class="key" align="center" width="100px">กิจกรรมโครงการ</td>
							<td class="key" align="center" width="150px">จำนวนเงิน<br/>(บาท)</td>
						</tr>
						<tr>
							<td style="padding-left:15px">ผ่านเกณฑ์</td>
							<td align="right" style="padding-right:20px"><?=$_cm>0?$_cm:"-"?></td>
							<td align="right" style="padding-right:10px"><?=$_m>0?number_format($_m,2,'.',','):"-"?></td>
						</tr>
						<tr>
							<td style="padding-left:15px">ไม่ผ่านเกณฑ์</td>
							<td align="right" style="padding-right:20px"><?=$_cf>0?$_cf:"-"?></td>
							<td align="right" style="padding-right:10px"><?=$_f>0?number_format($_f,2,'.',','):"-"?></td>
						</tr>
						<tr height="30px">
							<td class="key" align="center">รวม</td>
							<td class="key" align="right" style="padding-right:20px"><?=$_cm+$_cf?></td>
							<td class="key" align="right" style="padding-right:10px"><?=number_format($_m+$_f,2,'.',',')?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td width="50%"><div id="chart1" align="center" ></div></td>
				<td><div id="chart2" align="center" ></div></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
		  </tr>
		</table>
		<script language="javascript" type="text/javascript">
			FusionCharts.setCurrentRenderer('JavaScript');
			var myColumn = new FusionCharts("../fusionII/charts/MSColumn3D.swf", "myColumn", "360", "300"); 
			myColumn.setDataXML("<?=$_xmlColumn?>"); 
			myColumn.render("chart1");
			myColumn.addEventListener( "nodatatodisplay", function() { 
									if ( window.windowIsReady ){
										notifyLocalAJAXSecurityRestriction(); 
									}else
									{
										$(document).ready (function(){
											notifyLocalAJAXSecurityRestriction();
										});
									}
								});
			
			var myPie = new FusionCharts("../fusionII/charts/Pie3D.swf", "myPie", "360", "300"); 
			myPie.setDataXML("<?=$_xmlPie?>");
			myPie.render("chart2");
			myPie.addEventListener( "nodatatodisplay", function() { 
									if ( window.windowIsReady ){
										notifyLocalAJAXSecurityRestriction(); 
									}else
									{
										$(document).ready (function(){
											notifyLocalAJAXSecurityRestriction();
										});
									}
								});
			
		</script> <? }  //end - if
	else { echo "<center><font color='red'><br/>ยังไม่มีข้อมูลในรายการที่ท่านเลือก</font></center>"; }?>
<? } else { ?>
		<? $_sql = "select a.project_id,a.project_name,a.finish_date,a.purpose,a.budget_income,
					  sum(b.money) as money,a.budget_income-sum(b.money) as total
					from project a left outer join project_budget b
					on (a.project_id = b.project_id)
					where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' and a.purpose = '" . $_POST['purpose'] . "'
					group by a.project_id
					order by finish_date"; ?>
		<? $_res = mysql_query($_sql); $_x=1; ?>
		<? if(mysql_num_rows($_res)>0){ ?>
		<table class="admintable" width="100%" align="center" >
			<tr>
				<th colspan="6" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>
					รายงานโครงการตามเป้าหมายเชิงปริมาณของจ่ายในกิจกรรม/โครงการ<br/>
					สรุปตาม <?=$_POST['purpose']=="0"?"ไม่ผ่านเกณฑ์เป้าหมาย":"ผ่านเกณฑ์เป้าหมาย"?><br/>
					ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
				</th>
			</tr>
			<tr>
				<td class="key" align="center" width="50px">ที่</td>
				<td class="key" align="center">ชื่อกิจกรรม/โครงการ</td>
				<td class="key" align="center" width="130px">สิ้นสุดโครงการ</td>
				<td class="key" align="center" width="100px">งบประมาณที่ขอ</td>
				<td class="key" align="center" width="100px">งบประมาณที่ใช้</td>
				<td class="key" align="center" width="100px">คงเหลือ</td>
			</tr>
			<? $_a = 0; $_b=0; $_sum=0; ?>
			<? while($_dat = mysql_fetch_assoc($_res)){ ?>
			<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
				<td align="center" valign="top"><?=$_x++?></td>
				<td>
					<a href="index.php?option=module_projects/projectFull&p_id=<?=$_dat['project_id']?>&acadyear=<?=$acadyear?>&acadsemester=<?=$acadsemester?>">
					<?=$_dat['project_name']?>
					</a>
				</td>
				<td align="center" valign="top"><?=displayDate($_dat['finish_date'])?></td>
				<td align="right" valign="top" style="padding-right:5px"><?=number_format($_dat['budget_income'],2,'.',',')?></td>
				<td align="right" valign="top" style="padding-right:5px"><?=$_dat['money']==""?"ยังไม่มีการใช้เงิน":number_format($_dat['money'],2,'.',',')?></td>
				<td align="right" valign="top" style="padding-right:5px"><?=$_dat['money']==""?number_format($_dat['budget_income'],2,'.',','):number_format($_dat['total'],2,'.',',')?></td>
				<? $_a+= $_dat['budget_income']; $_b+= $_dat['money']; $_sum += ($_dat['money']==""?$_dat['budget_income']:$_dat['total']); ?>
			</tr>
			<? } //end while ?>
			</tr>
			<tr>
				<td></td><td></td>
				<td class="key" align="center">รวม</td>
				<td class="key" align="right" style="padding-right:5px"><?=number_format($_a,2,'.',',')?></td>
				<td class="key" align="right" style="padding-right:5px"><?=number_format($_b,2,'.',',')?></td>
				<td class="key" align="right" style="padding-right:5px"><?=number_format($_sum,2,'.',',')?></td>
			</tr>
		</table>
		<? }else {echo "<center><font color='red'><br/>ยังไม่มีข้อมูลในรายการที่ท่านเลือก</font></center>";} ?>
<? } ?>
	
</div>

