

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_moral/index"><img src="../images/objects.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">ระบบสารสนเทศธนาคารความดี</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>3.2 แผนภูมิพฤติกรรมที่พึงประสงค์<br/>ของนักเรียนแยกตามระดับชั้น</strong></font></span></td>
     <td >
		<?  if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา <?php  
					echo "<a href=\"index.php?option=module_moral/gLevelNumber&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_moral/gLevelNumber&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		 ภาคเรียนที่ <? if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_moral/gLevelNumber&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_moral/gLevelNumber&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?><br/>
		<form method="post">
			<font color="#000000" size="2"  >
			ประเภทของกิจกรรม
			<? @$_resMtype = mysql_query("select * from ref_moral") ?>
			<select name="mtype" class="inputboxUpdate">
				<option value=""></option>
				<? while($_dat = mysql_fetch_assoc($_resMtype)) { ?>
				<option value="<?=$_dat['moral_id']?>" <?=(isset($_POST['mtype']) && $_POST['mtype'] == $_dat['moral_id'])?"selected":""?>><?=$_dat['moral_description']?></option>
				<? } ?>
				<option value="all" <?=$_POST['mtype']=="all"?"selected":""?>>รวมทั้งหมด</option>
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
		$_xmlColumn .= "<graph caption='' formatNumberScale='0' decimalPrecision='0' >";
		$_xmlPie .="<graph caption='' decimalPrecision='0' showPercentageValues='1' showNames='1'  showValues='1'  pieYScale='65' pieSliceDepth='25' pieRadius='100'>";
		
		$_catXML = "<categories>";
		$_setA = "<dataset seriesname='ชาย'  showValue='1' color='FF0000'>";
		$_setB = "<dataset seriesname='หญิง' showValue='1' color='00CCFF'>";
	?>	
<? if(isset($_POST['search']) && $_POST['mtype'] == "") { ?>
		<br/><br/><center><font color="#FF0000">กรุณาเลือก ประเภทของกิจกรรม ที่ต้องการทราบข้อมูลก่อน</font></center>
<? } ?>	

<? if(isset($_POST['search']) && $_POST['mtype'] == "all"){ ?>
		<? $_sql = "select xlevel,xyearth,
										  sum(if(mtype='00',1,0)) as a,
										  sum(if(mtype='01',1,0)) as b,
										  sum(if(mtype='02',1,0)) as c,
										  sum(if(mtype='03',1,0)) as d,
										  count(a.id) as total
										from student_moral a left outer join students b
										on a.student_id = b.id
										where xedbe = '" . $acadyear . "'and acadsemester = '" . $acadsemester . "' 
											and acadyear = '" . $acadyear . "' " . (isset($_POST['studstatus'])=="1,2"?" and studstatus in (1,2) ":"") . "
										group by xlevel,xyearth";?>
		<? $_result = mysql_query($_sql); ?>
		<? $_a = 0;$_b = 0; $_c = 0; $_d = 0; $_sum = 0; ?>
		<? if(mysql_num_rows($_result)>0) { ?>
		  <table class="admintable"  width="100%">
			<tr>
				<th align="center">
					<img src="../images/school_logo.gif" width="120px"><br/>
					รายงานผลการเข้าร่วมกิจกรรม "<?=displayMtype($_POST['mtype'])?>"<br/>
					ภาคเรียนที่ <?=$acadsemester?>  ปีการศึกษา <?=$acadyear?>
				</th>
			</tr>
			<tr>
				<td align="center">
						<div id="chart1" align="center" ></div><br/>
						<div id="chart2" align="center" ></div>
						<table align="center" class="admintable">
							<tr>
								<td class="key" align="center" rowspan="2" width="160px">ระดับชั้น</td>
								<td class="key" align="center" colspan="4">ประเภทของกิจกรรมที่เข้าร่วม(คน)</td>
								<td class="key" align="center" rowspan="2" width="90px">รวม</td>
							</tr>
							<tr>
								<td class="key" align="center" width="80px">บำเพ็ญประโยชน์</td>
								<td class="key" align="center" width="80px">เข้าร่วมอบรม</td>
								<td class="key" align="center" width="80px">แข่งขันทักษะวิชาการ</td>
								<td class="key" align="center" width="80px">แข่งขันทักษะกีฬา</td>
							</tr>
							<? while($_dat = mysql_fetch_assoc($_result)) { ?>
							<tr>
								<td style="padding-left:20px">ชั้นมัธยมศึกษาปีที่ <?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?></td>
								<td style="padding-right:10px" align="right"><?=$_dat['a']==0?"-":number_format($_dat['a'],0,'',',')?></td>
								<td style="padding-right:10px" align="right"><?=$_dat['b']==0?"-":number_format($_dat['b'],0,'',',')?></td>
								<td style="padding-right:10px" align="right"><?=$_dat['c']==0?"-":number_format($_dat['c'],0,'',',')?></td>
								<td style="padding-right:10px" align="right"><?=$_dat['d']==0?"-":number_format($_dat['d'],0,'',',')?></td>
								<td align="right" style="padding-right:10px"><?=$_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']?></td>
								<? $_a += $_dat['a']; $_b += $_dat['b']; $_c += $_dat['c'];
								   $_d += $_dat['d']; $_sum += ($_dat['a']+$_dat['b']+$_dat['c']+$_dat['d']); 
								   $_color = getFCColor();
								   $_xmlPie .= "<set name='ม. " . ($_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3) . "' value='" . $_dat['total'] . "' color ='" . $_color . "' />";
								   $_xmlColumn .= "<set name='ม. " . ($_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3) . "' value='" . $_dat['total'] . "' color ='" . $_color . "' />";?>
							</tr>
							<? } mysql_free_result($_result); ?>
							<tr height="30px">
							  <td class="key" align="center">รวม</th>
							  <td class="key" style="padding-right:10px" align="right"><?=$_a>0?number_format($_a,0,'',','):"-"?></td>
							  <td class="key" style="padding-right:10px" align="right"><?=$_b>0?number_format($_b,0,'',','):"-"?></td>
							  <td class="key" style="padding-right:10px" align="right"><?=$_c>0?number_format($_c,0,'',','):"-"?></td>
							  <td class="key" style="padding-right:10px" align="right"><?=$_d>0?number_format($_d,0,'',','):"-"?></td>
							  <td class="key" align="right" style="padding-right:10px"><?=$_sum>0?number_format($_sum,0,'',','):"-"?></td>
						  </tr>
						</table>
					</td>
				</tr>
			</table>
						<?  $_xmlPie .="</graph>"; $_xmlColumn .= "</graph>"; ?>
						<script language="javascript" type="text/javascript">
							FusionCharts.setCurrentRenderer('JavaScript');
							var myColumn = new FusionCharts("../fusionII/charts/Column3D.swf", "myColumn2", "500", "350"); 
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
							
							var myPie = new FusionCharts("../fusionII/charts/Pie3D.swf", "myColumn2", "500", "300"); 
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
				<? }else{?><br/><br/><center><font color="#FF0000">ไม่พบข้อมูลตามเงื่อนไขที่คุณเลือก</font></center><? } ?>
 <? } else if (isset($_POST['search']) && $_POST['mtype'] != "") {  ?>
		 <? $_sql = "select xlevel,xyearth,
								  sum(if(sex=1,1,0)) as a,
								  sum(if(sex=2,1,0)) as b,
								  count(a.id) as total
								from student_moral a left outer join students b
								on a.student_id = b.id
								where xedbe = '" . $acadyear . "'and acadsemester = '" . $acadsemester . "' 
									and mtype = '" . $_POST['mtype'] . "' 
									and acadyear = '" . $acadyear . "' " . (isset($_POST['studstatus'])=="1,2"?" and studstatus in (1,2) ":"") . "
								group by xlevel,xyearth";?>
		<? $_result = mysql_query($_sql); ?>
		<? $_a = 0;$_b = 0; $_sum = 0; ?>
		<? if(mysql_num_rows($_result)>0){ ?>
		 	<table class="admintable"  width="100%">
			<tr>
				<th align="center">
					<img src="../images/school_logo.gif" width="120px"><br/>
					รายงานผลการเข้าร่วมกิจกรรม "<?=displayMtype($_POST['mtype'])?>"<br/>
					ภาคเรียนที่ <?=$acadsemester?>  ปีการศึกษา <?=$acadyear?>
				</th>
			</tr>
			<tr>
				<td>
					<div id="chart1" align="center" ></div><br/>
				<div id="chart2" align="center" ></div>
  				<table align="center" class="admintable">
					<tr>
						<td class="key" align="center" rowspan="2" width="160px">ระดับชั้น</td>
						<td class="key" align="center" colspan="2">นักเรียน(คน)</td>
						<td class="key" align="center" rowspan="2" width="90px">รวม</td>
					</tr>
					<tr>
						<td class="key" align="center" width="70px">ชาย</td>
						<td class="key" align="center" width="70px">หญิง</td>
					</tr>
					<? while($_dat = mysql_fetch_assoc($_result)) { ?>
					<tr>
						<td style="padding-left:20px">ชั้นมัธยมศึกษาปีที่ <?=$_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3?></td>
						<td style="padding-right:10px" align="right"><?=$_dat['a']==0?"-":number_format($_dat['a'],0,'',',')?></td>
						<td style="padding-right:10px" align="right"><?=$_dat['b']==0?"-":number_format($_dat['b'],0,'',',')?></td>
						<td align="right" style="padding-right:10px"><?=number_format($_dat['a']+$_dat['b'],0,'',',')?></td>
						<? $_a += $_dat['a']; $_b += $_dat['b']; 
							$_sum += ($_dat['a']+$_dat['b']); 
						   $_color = getFCColor();
						   $_xmlPie .= "<set name='ม. " . ($_dat['xlevel']==3?$_dat['xyearth']:$_dat['xyearth']+3) . "' value='" . $_dat['total'] . "' color ='" . $_color . "' />";
						   $_catXML .= "<category name='ม." . ($_dat['xlevel']==3?$_dat['xyearth']:($_dat['xyearth']+3)) . "' hoverText=''/>";
							$_setA .= "<set value='" . $_dat['a'] . "'  />";
							$_setB .= "<set value='" . $_dat['b'] . "'  />";
						 ?>
					</tr>
					<? } mysql_free_result($_result); ?>
					<tr height="30px">
					  <td class="key" align="center">รวม</td>
					  <td class="key" style="padding-right:10px" align="right"><?=$_a>0?number_format($_a,0,'',','):""?></td>
					  <td class="key" style="padding-right:10px" align="right"><?=$_b>0?number_format($_b,0,'',','):""?></td>
					  <td class="key" align="right" style="padding-right:10px"><?=$_sum>0?number_format($_sum,0,'',','):""?></td>
				  </tr>
				</table>
				<? 
					$_xmlPie .="</graph>";
					
					$_catXML .= "</categories>";
					$_setA .= "</dataset>";
					$_setB .= "</dataset>";
					$_xmlColumn .= $_catXML . $_setA . $_setB  . "</graph>";
				?>
				<script language="javascript" type="text/javascript">
					FusionCharts.setCurrentRenderer('JavaScript');
					var myColumn = new FusionCharts("../fusionII/charts/MSColumn3D.swf", "myColumn2", "540", "300"); 
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
		<? }else{?><br/><br/><center><font color="#FF0000">ไม่พบข้อมูลตามเงื่อนไขที่คุณเลือก</font></center><? } ?>
<? } //end check submit value ?>
</div>

