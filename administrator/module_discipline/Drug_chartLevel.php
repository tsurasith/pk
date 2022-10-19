

<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>4.5 แผนภูมิรายงานการคัดกรองยาเสพติด<br/>(แยกตามระดับชั้น)</strong></font></span></td>
      <td >
	  	<?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_discipline/Drug_chartLevel&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/Drug_chartLevel&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1)
					{
						echo "<font color='blue'>1</font> , ";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/Drug_chartLevel&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2)
					{
						echo "<font color='blue'>2</font>";
					}
					else
					{
						echo " <a href=\"index.php?option=module_discipline/Drug_chartLevel&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form action="" method="post">
		<font color="#000000" size="2">
		เลือกระดับชั้น 
			 <select name="level" class="inputboxUpdate">
			 	<option value=""></option>
				<option value="3" <?=isset($_POST['level'])&&$_POST['level']=="3"?"selected":""?>>ม.ต้น</option>
				<option value="4" <?=isset($_POST['level'])&&$_POST['level']=="4"?"selected":""?>>ม.ปลาย</option>
				<option value="all" <?=isset($_POST['level'])&&$_POST['level']=="all"?"selected":""?>>ทั้งโรงเรียน</option>
			 </select> 
			เดือน
			<select name="month" class="inputboxUpdate">
			 	<option value=""></option>
				<?php
					$_sqlMonth = "select distinct month(task_date)as m,year(task_date)+543 as y
									from student_drug_task where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
									order by year(task_date),month(task_date)";
					$_resMonth = mysql_query($_sqlMonth);
					while($_datMonth = mysql_fetch_assoc($_resMonth))
					{
						$_select = (isset($_POST['month'])&&$_POST['month'] == $_datMonth['m']?"selected":"");
						echo "<option value=\"" . $_datMonth['m'] . "\" $_select >" . displayMonth($_datMonth['m']) . ' ' . $_datMonth['y'] . "</option>";
					} mysql_free_result($_resMonth);
				?>
			 </select>
			 <input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			 <input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		  </font>
		  </form>
	</td>
    </tr>
  </table>
  <br/>
<table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%" >
    <tr>
	<?php
		if(isset($_POST['search']) && ($_POST['month'] == "" || $_POST['level']=="")){ echo "<td align='center'><br/><font color='red'>กรุณาเลือก ระดับชั้น และ เดือน ให้ครบถ้วน</font></td></tr>"; }
		if(isset($_POST['search']) && $_POST['month'] != "" && $_POST['level']!= "")
		{
			$_sql = "select drugtype as drug,
					  sum(if(drugLevel='00' && sex = 1,1,0)) as am,
					  sum(if(drugLevel='00' && sex = 2,1,0)) as af,
					  sum(if(drugLevel='01' && sex = 1,1,0)) as bm,
					  sum(if(drugLevel='01' && sex = 2,1,0)) as bf,
					  sum(if(drugLevel='02' && sex = 1,1,0)) as cm,
					  sum(if(drugLevel='02' && sex = 2,1,0)) as cf,
					  sum(if(drugLevel='03' && sex = 1,1,0)) as dm,
					  sum(if(drugLevel='03' && sex = 2,1,0)) as df,
					  count(drugtype) as total
					from student_drug right outer join students
					on (student_id = id)
					where check_date = '" . $_POST['month'] . "'
					  and acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
					  and xEDBE = '" . $acadyear . "'" ;
			if($_POST['level']!="all" && $_POST['level']=="4") $_sql .= " and substr(class_id,1,1) > 3 ";
			if($_POST['level']!="all" && $_POST['level']=="3") $_sql .= " and substr(class_id,1,1) < 4 ";
			if($_POST['studstatus']=="1,2") $_sql .= " and studstatus in (1,2) ";
			$_sql .= " group by drugtype  order by drugtype";
			
			@$_res = mysql_query($_sql);
			if(@mysql_num_rows($_res)<=0){ echo "<td align='center'><br/><font color='red'>ยังไม่มีการบันทึกข้อมูลในรายการที่เลือก</font></td></tr>"; }
			else{
			
			$_xmlColumn = "<?xml version='1.0' encoding='UTF-8' ?>";
			$_xmlColumn .= "<graph caption='' formatNumberScale='0' decimalPrecision='0' >";

			$_xmlPie = "<?xml version='1.0' encoding='UTF-8' ?>";
			$_xmlPie .="<graph caption='' decimalPrecision='0' showPercentageValues='1' showNames='1'  showValues='1'  pieYScale='65' pieSliceDepth='25' pieRadius='100'>";

			$_catXML = "<categories><category name='บุหรี่' hoverText=''/><category name='เหล้า' hoverText=''/><category name='ยาบ้า' hoverText=''/><category name='สารระเหย' hoverText=''/>";
			$_setB = "<dataset seriesname='เสี่ยง' showValue='1' color='669900'>";
			$_setC = "<dataset seriesname='เคยลอง' showValue='1' color='FFFF66'>";
			$_setD = "<dataset seriesname='ติด' showValue='1' color='FF0000'>";

	?>	 
		  <th align="center">
			<img src="../images/school_logo.gif" width="120px">
			<br/>
			รายงานผลการคัดกรองสารเสพติด
			"<?=$_POST['level']=="all"?"ทั้งโรงเรียน":($_POST['level']==3?"ชั้นมัธยมศึกษาตอนต้น":"ชั้นมัธยมศึกษาตอนปลาย")?>" <br/>
			ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
			<br/>ประจำเดือน <?=displayMonth($_POST['month'])?>
		  </th>
    </tr>
	<tr>
		<td align="center">
			<table class="admintable" width="85%" align="center" >
				<tr><td><div id="chart1" align="center" ></div></td></tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table>
				<tr align="center">
					<td class="key" width="160px" rowspan="3">ประเภทสารเสพติด</td>
					<td class="key" colspan="8">ระดับการคัดกรอง</td>
					<td class="key" width="100px" rowspan="3">รวม</td>
				</tr>
				<tr align="center">
					<td class="key" width="120px" colspan="2">ปกติ</td>
					<td class="key" width="120px" colspan="2">เสี่ยง</td>
					<td class="key" width="120px" colspan="2">เคยลอง</td>
					<td class="key" width="120px" colspan="2">ติด</th>
				</tr>
				<tr align="center">
					<td class="key" align="center">ชาย</td>
					<td class="key" align="center">หญิง</td>
					<td class="key" align="center">ชาย</td>
					<td class="key" align="center">หญิง</td>
					<td class="key" align="center">ชาย</td>
					<td class="key" align="center">หญิง</td>
					<td class="key" align="center">ชาย</td>
					<td class="key" align="center">หญิง</td>
				</tr>
				<? while($_dat = mysql_fetch_assoc($_res)) { ?>
				<tr>
					<td align="left"><b><?=displayDrug($_dat['drug'])?></b></td>
					<td align="right" style="padding-right:10px"><?=$_dat['am']>0?$_dat['am']:'-'?></td>
					<td align="right" style="padding-right:10px"><?=$_dat['af']>0?$_dat['af']:'-'?></td>
					<td align="right" style="padding-right:10px"><?=$_dat['bm']>0?$_dat['bm']:'-'?></td>
					<td align="right" style="padding-right:10px"><?=$_dat['bf']>0?$_dat['bf']:'-'?></td>
					<td align="right" style="padding-right:10px"><?=$_dat['cm']>0?$_dat['cm']:'-'?></td>
					<td align="right" style="padding-right:10px"><?=$_dat['cf']>0?$_dat['cf']:'-'?></td>
					<td align="right" style="padding-right:10px"><?=$_dat['dm']>0?$_dat['dm']:'-'?></td>
					<td align="right" style="padding-right:10px"><?=$_dat['df']>0?$_dat['df']:'-'?></td>
					<td align="right" style="padding-right:10px"><?=$_dat['total']?></td>
				</tr>
				<? // xml 
				 	$_setB .= "<set value='" . ($_dat['bm'] + $_dat['bf']) . "'  />";
					$_setC .= "<set value='" . ($_dat['cm'] + $_dat['cf']) . "'  />";
					$_setD .= "<set value='" . ($_dat['dm'] + $_dat['df']) . "'  />";
				?>
				<? } //end while ?>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<? 
			$_catXML .= "</categories>";
			$_setB .= "</dataset>";
			$_setC .= "</dataset>";
			$_setD .= "</dataset>";
			$_xmlColumn .= $_catXML . $_setB . $_setC  . $_setD . "</graph>";
			?>
			<script language="javascript" type="text/javascript">
				FusionCharts.setCurrentRenderer('JavaScript');
				var myColumn = new FusionCharts("../fusionII/charts/MSColumn3D.swf", "myColumn", "560", "300"); 
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
			</script>
		</td>
	</tr>
<?	  }//ปิด else ตรวจสอบข้อมูลในฐานข้อมูล
	}//ปิด if-else ตรวจสอบการเลือกวันที่
	?>
</table>
</div>
<?

	function displayDrug($_value)
	{
		switch($_value){
			case '00' : return "บุหรี่"; break;
			case '01' : return "เครื่องดื่มแอลกอฮอร์"; break;
			case '02' : return "ยาบ้า"; break;
			case '03' : return "สารระเหย"; break;
			default : return "ไม่ระบุ"; }
	}
?>