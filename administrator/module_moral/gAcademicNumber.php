

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_moral/index"><img src="../images/objects.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">ระบบสารสนเทศธนาคารความดี</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>3.1 แผนภูมิผลการแข่งขันทักษะทางวิชาการแยกตาม<br/>กลุ่มสาระการเรียนรู้และระดับของกิจกรรม</strong></font></span></td>
     <td >
		<?  if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_moral/gAcademicNumber&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_moral/gAcademicNumber&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		 ภาคเรียนที่ <? if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_moral/gAcademicNumber&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_moral/gAcademicNumber&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?><br/>
		<form method="post">
			<font color="#000000" size="2">
			กลุ่มสาระการเรียนรู้
			<? @$_resAcademic = mysql_query("select * from ref_academic"); ?>
			<select name="academic" class="inputboxUpdate">
				<option value=""></option>
				<? while($_dat = mysql_fetch_assoc($_resAcademic)){ ?>
				<option value="<?=$_dat['academic_id']?>" <?=(isset($_POST['academic']) && $_POST['academic'] == $_dat['academic_id'])?"selected":""?>><?=$_dat['academic_description']?></option>
				<? } ?>
				<option value="all" <?=$_POST['academic']=="all"?"selected":""?>>รวมทุกกลุ่มสาระการเรียนรู้</option>
			</select>
			<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2"  <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา</font>
		</form>
	  </td>
    </tr>
  </table>
  
	<?
  		$_xmlColumn = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlPie = "<?xml version='1.0' encoding='UTF-8' ?>";
		$_xmlColumn .= "<graph caption='ผลการแข่งขัน' formatNumberScale='0' decimalPrecision='0' >";
		$_xmlPie .="<graph caption='ระดับของกิจกรรม' decimalPrecision='0' showPercentageValues='1' showNames='1'  showValues='1'  pieYScale='65' pieSliceDepth='25' pieRadius='100'>";
	?>	
<? if(isset($_POST['search']) && $_POST['academic'] == "") { ?>
		<br/><br/><center><font color="#FF0000">กรุณาเลือก กลุ่มสาระการเรียนรู้ ที่ต้องการทราบข้อมูลก่อน</font></center>
<? }//end if ?>

<? if(isset($_POST['search']) && $_POST['academic'] != "") { ?>  
		<? $_sql = "select mprize,
					  sum(if(mlevel='00',1,0)) as a,
					  sum(if(mlevel='01',1,0)) as b,
					  sum(if(mlevel='02',1,0)) as c,
					  sum(if(mlevel='03',1,0)) as d,
					  sum(if(mlevel='04',1,0)) as e,
					  count(a.id) as total
					from student_moral a left outer join students b
					on a.student_id = b.id
					where xedbe = '" . $acadyear . "'and acadsemester = '" . $acadsemester . "'  and mtype = '02' "?>
		<? if($_POST['academic'] != "all") $_sql .= " and a.academic = '" . $_POST['academic'] . "' "; ?>
		<? $_sql .= " and acadyear = '" . $acadyear . "' " . (isset($_POST['studstatus'])=="1,2"?" and studstatus in (1,2) ":"") . " group by mprize";?>
		<? $_result = mysql_query($_sql); ?>
		<? $_a = 0;$_b = 0; $_c = 0; $_d = 0; $_e = 0; $_sum = 0; ?>
		<? if(mysql_num_rows($_result)>0){ ?>
			  <table class="admintable"  width="100%">
				<tr>
					<th align="center">
						<img src="../images/school_logo.gif" width="120px"><br/>
						รายงานผลการแข่งขันทักษะทางวิชาการกลุ่มสาระการเรียนรู้ "<?=displayAcademic($_POST['academic'])?>"<br/>
						ภาคเรียนที่ <?=$acadsemester?> 
						ปีการศึกษา <?=$acadyear?>
					</th>
				</tr>
				<tr>
					<td align="center">
							<div id="chart1" align="center" ></div><br/>
							<div id="chart2" align="center" ></div>
							<table align="center" class="admintable">
								<tr>
									<td class="key" align="center" rowspan="2" width="160px">ผลการแข่งขัน</td>
									<td class="key" align="center" colspan="5">ระดับของกิจกรรมที่เข้าร่วม(ครั้ง)</td>
									<td class="key" align="center" rowspan="2" width="90px">รวม</td>
								</tr>
								<tr>
									<td class="key" align="center" width="70px">ภายใน</td>
									<td class="key" align="center" width="70px">ชุมชน</td>
									<td class="key" align="center" width="70px">เขตพื้นที่<br/>การศึกษา</td>
									<td class="key" align="center" width="70px">จังหวัด</td>
									<td class="key" align="center" width="70px">ประเทศ</td>
								</tr>
								<? while($_dat = mysql_fetch_assoc($_result)) { ?>
								<tr>
									<td style="padding-left:20px" align="left"><?=displayPrize($_dat['mprize'])?></td>
									<td style="padding-right:10px" align="right"><?=$_dat['a']==0?"-":number_format($_dat['a'],0,'',',')?></td>
									<td style="padding-right:10px" align="right"><?=$_dat['b']==0?"-":number_format($_dat['b'],0,'',',')?></td>
									<td style="padding-right:10px" align="right"><?=$_dat['c']==0?"-":number_format($_dat['c'],0,'',',')?></td>
									<td style="padding-right:10px" align="right"><?=$_dat['d']==0?"-":number_format($_dat['d'],0,'',',')?></td>
									<td style="padding-right:10px" align="right"><?=$_dat['e']==0?"-":number_format($_dat['e'],0,'',',')?></td>
									<td align="right" style="padding-right:10px"><?=$_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']+$_dat['e']>0?number_format($_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']+$_dat['e'],0,'',','):""?></td>
									<? $_a += $_dat['a']; $_b += $_dat['b']; $_c += $_dat['c']; $_e+=$_dat['e'];
									   $_d += $_dat['d']; $_sum += ($_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']+$_dat['e']);
									   $_xmlColumn .= "<set name='" . displayPrizeShort($_dat['mprize']) . "' value='" . $_dat['total'] . "' color ='" . getFCColor() . "' />";?>
								</tr>
								<? } mysql_free_result($_result); ?>
								<tr height="30px">
								  <td class="key" align="center">รวม</th>
								  <td class="key" style="padding-right:10px" align="right"><?=$_a>0?number_format($_a,0,'',','):"-"?></td>
								  <td class="key" style="padding-right:10px" align="right"><?=$_b>0?number_format($_b,0,'',','):"-"?></td>
								  <td class="key" style="padding-right:10px" align="right"><?=$_c>0?number_format($_c,0,'',','):"-"?></td>
								  <td class="key" style="padding-right:10px" align="right"><?=$_d>0?number_format($_d,0,'',','):"-"?></td>
								  <td class="key" style="padding-right:10px" align="right"><?=$_e>0?number_format($_e,0,'',','):"-"?></td>
								  <td class="key" align="right" style="padding-right:10px"><?=$_sum>0?number_format($_sum,0,'',','):"-"?></td>
							  </tr>
							</table>
							<? 
								if($_a>0) $_xmlPie .= "<set name='ภายใน' value='" . $_a . "' color='" . getFCColor()  . "' /> ";
								if($_b>0) $_xmlPie .= "<set name='ชุมชน' value='" . $_b . "' color='" . getFCColor()  . "' /> ";
								if($_c>0) $_xmlPie .= "<set name='เขตพื้นที่ฯ' value='" . $_c . "' color='" . getFCColor()  . "' /> ";
								if($_d>0) $_xmlPie .= "<set name='จังหวัด' value='" . $_d . "' color='" . getFCColor()  . "' /> ";
								if($_e>0) $_xmlPie .= "<set name='ประเทศ' value='" . $_e . "' color='" . getFCColor()  . "' /> ";
								$_xmlPie .="</graph>";
								$_xmlColumn .= "</graph>";
							?>
							<script language="javascript" type="text/javascript">
								FusionCharts.setCurrentRenderer('JavaScript');
								var myColumn = new FusionCharts("../fusionII/charts/Column3D.swf", "myColumn2", "540", "300"); 
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
								
								var myPie = new FusionCharts("../fusionII/charts/Pie3D.swf", "myColumn2", "540", "300"); 
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
							</script>
					 </td>
					</tr>
				</table>
		<? } else { ?><br/><br/><font color="#FF0000"><center>ไม่พบข้อมูลที่ต้องการทราบตามเงื่อนไข</center></font><? } ?>
<? } ?>
</div>


