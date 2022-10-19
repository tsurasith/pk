
<div id="content">
	<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
		<tr>
			<td width="6%" align="center">
				<a href="index.php?option=module_projects/index">
				<img src="../images/computer.png" alt="" width="48" height="48" border="0"/>
				</a>
			</td>
			<td ><strong><font color="#990000" size="4">ระบบสารสนเทศกิจกรรม/โครงการ</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>2.1.1 รายงานสรุปกิจกรรมโครงการตามประเภทงบประมาณ</strong></font></span></td>
			<td>
				<?php
					if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
					if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
				?>
				ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_projects/xReportMoneySemester&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo "<a href=\"index.php?option=module_projects/xReportMoneySemester&acadyear=" . ($acadyear + 1) . "\"> <img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
				ภาคเรียนที่ <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else { echo " <a href=\"index.php?option=module_projects/xReportMoneySemester&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ; }
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else { echo " <a href=\"index.php?option=module_projects/xReportMoneySemester&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ; }
				?>
		<font size="2" color="#000000">
			<form method="post" autocomplete="off">
				แหล่งเงินงบประมาณ 
				<select name="budgetType" class="inputboxUpdate">
					<option value=""></option>
					<option value="00" <?=isset($_POST['budgetType'])&&$_POST['budgetType']=="00"?"selected":""?>>เงินงบประมาณ</option>
					<option value="01" <?=isset($_POST['budgetType'])&&$_POST['budgetType']=="01"?"selected":""?>>เงินอุดหนุนอื่น</option>
				</select>
				<input type="submit" value="เรียกดู" class="button" />
			</form>
		</font>
	  </td>
    </tr>
  </table>
  
<? if($_POST['budgetType']==""){ ?>  
<?php
	$_sql = "select budget_type,count(project_id) as num,sum(budget_income) as income from project where acadyear = '" .$acadyear. "' and acadsemester = '" . $acadsemester ."' group by budget_type";
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
			$_catXML .= "<category name='" . ($_dat['budget_type']=="00"?"เงินงบประมาณ":"เงินอุดหนุนอื่น") . "' hoverText=''/>";
			$_setA .= "<set value='" . $_dat['income'] . "' " . ($_dat['budget_type']=="00"?"color = 'FF9900'":"color = '0099FF'"). " />";
			if($_dat['budget_type']=="00") { $_m += $_dat['income']; $_cm=$_dat['num']; }
			else { $_f += $_dat['income']; $_cf=$_dat['num']; }
		}
		$_catXML .= "</categories>";
		$_setA .= "</dataset>";
		$_xmlColumn .= $_catXML . $_setA . "</graph>";
		
		if($_m > 0) $_xmlPie .= "<set value='" . $_m . "' name='เงินงบประมาณ' color='FF9900'/>";
		if($_f > 0) $_xmlPie .= "<set value='" . $_f . "' name='เงินอุดหนุนอื่น' color='0099FF'/>";
		$_xmlPie .= "</graph>";
		
?>
		<table class="admintable" width="100%" align="center" >
			<tr>
				<th colspan="2" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>
					รายงานเงินงบประมาณที่ใช้จ่ายในกิจกรรม/โครงการ<br/>
					ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
				</th>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<table class="admintable">
						<tr>
							<td class="key" align="center" width="200">แหล่งเงิน</td>
							<td class="key" align="center" width="100px">จำนวน<br/>โครงการ</td>
							<td class="key" align="center" width="150px">จำนวนเงิน<br/>(บาท)</td>
						</tr>
						<tr>
							<td style="padding-left:15px">เงินงบประมาณ</td>
							<td align="right" style="padding-right:20px"><?=$_cm>0?$_cm:"-"?></td>
							<td align="right" style="padding-right:10px"><?=$_m>0?number_format($_m,2,'.',','):"-"?></td>
						</tr>
						<tr>
							<td style="padding-left:15px">เงินอุดหนุนอื่น</td>
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
			var myColumn = new FusionCharts("../fusionII/charts/MSColumn3D.swf", "myColumn", "320", "280"); 
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
			
			var myPie = new FusionCharts("../fusionII/charts/Pie3D.swf", "myPie", "400", "280"); 
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
					where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "' and a.budget_type = '" . $_POST['budgetType'] . "'
					group by a.project_id
					order by finish_date"; //echo $_sql; ?>
		<? $_res = mysql_query($_sql); $_x=1; ?>
		<? if(mysql_num_rows($_res)>0){ ?>
		<table class="admintable" width="100%" align="center" >
			<tr>
				<th colspan="6" align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>
					รายงานเงินงบประมาณที่ใช้จ่ายในกิจกรรม/โครงการ<br/>
					สรุปตาม <?=$_POST['budgetType']=="00"?"เงินงบประมาณ":"เงินอุดหนุนอื่น"?><br/>
					ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
				</td>
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
		<? } else { echo "<center><font color='red'><br/>ไม่มีข้อมูลในรายการที่เรียกดู</font></center>";} ?>
<? } ?>
	
</div>

