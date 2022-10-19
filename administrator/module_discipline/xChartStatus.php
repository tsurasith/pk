

<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center" valign="top"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td valign="top"><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.1 แผนภูมิแสดงพฤติกรรมไม่พึงประสงค์<br/>ตามสถานะการดำเนินการ</strong></font></span></td>
      <td align="right">
	  	<?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_discipline/xChartStatus&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/xChartStatus&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1){ echo "<font color='blue'>1</font> , "; }
					else{
						echo " <a href=\"index.php?option=module_discipline/xChartStatus&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2){ echo "<font color='blue'>2</font>"; }
					else{
						echo " <a href=\"index.php?option=module_discipline/xChartStatus&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		 <? $_resS = mysql_query("select * from ref_disciplinestatus order by status"); ?>
		 <font color="#000000" size="2">
		 <form action="" method="post">
			 <select name="level" class="inputboxUpdate">
				<option value=""></option>
				<? while ($_datS = mysql_fetch_assoc($_resS)){ ?>
					<option value="<?=$_datS['status']?>" <?=isset($_POST['level'])&&$_POST['level']==$_datS['status']?"selected":""?>><?=$_datS['status']?> - <?=$_datS['status_detail']?></option>
				<? } //end while ?>
				<option value="all" <?=isset($_POST['level'])&&$_POST['level']=="all"?"selected":""?>>ทุกสถานะการดำเนินการ</option>
			</select><br/> 
			<input name="chartType" type="radio" value="column" <?=$_POST['chartType']!="pie"?"checked":""?>> กราฟแท่ง 
			<input type="radio" value="pie" name="chartType" <?=isset($_POST['chartType'])&&$_POST['chartType']=="pie"?"checked":""?>> กราฟวงกลม <br/>
		    <input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา<br/>
			 <input type="checkbox" name="split" value="split" <?=$_POST['split']=="split"?"checked='checked'":""?> />
			 ไม่นับรวมการขาด สาย ลา กิจกรรมหน้าเสาธง<br/>
			<input type="submit" name="search" value="เรียกดู" class="button"/>
	    </form></font>
		</td>
    </tr>
  </table>
<br/>
<? if(isset($_POST['search']) && $_POST['level']==""){ ?>
		<font color="#FF0000"><center><br/>กรุณาเลือกสถานะดำเนินการก่อน</center></font>
<? } //end if ?>

<?php
	if(isset($_POST['search']) && $_POST['level'] != "") {
		$_sql = "";	
		if($_POST['level'] == "all")
		{
			$_sql = "select xlevel,xyearth,count(student_id) as 'cc'
						 from  student_disciplinestatus
						 left outer join students
						   on student_id = id
						 where acadyear = '". $acadyear ."' and acadsemester = '". $acadsemester . "' 
						 	   and xedbe = '" .$acadyear . "' ";
			if($_POST['studstatus']=="1,2"){ $_sql .= " and studstatus in (1,2) "; }
			if($_POST['split']=="split"){$_sql.= " and dis_id in (select dis_id from student_discipline where dis_detail not like '%การเข้าร่วมกิจกรรมหน้าเสาธง%')";}
			$_sql .= " group by xlevel,xyearth order by xlevel,xyearth";
		}else {
			$_sql = "select xlevel,xyearth,count(student_id) as 'cc'
						 from  student_disciplinestatus
						 left outer join students
						   on student_id = id
						 where acadyear = '". $acadyear ."' and acadsemester = '". $acadsemester . "' 
						 	   and xedbe = '" .$acadyear . "' and dis_status = '" . $_POST['level'] . "' ";
			if($_POST['studstatus']=="1,2"){ $_sql .= " and studstatus in (1,2) "; }
			if($_POST['split']=="split"){$_sql.= " and dis_id in (select dis_id from student_discipline where dis_detail not like '%การเข้าร่วมกิจกรรมหน้าเสาธง%')";}
			$_sql .= " group by xlevel,xyearth order by xlevel,xyearth";
		}
		$_res = mysql_query($_sql);
		if(mysql_num_rows($_res) > 0) {
			$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
			if($_POST['chartType'] == "column"){ $_strXML = $_strXML . "<graph caption='' xAxisName='' yAxisName='Units' decimalPrecision='0' formatNumberScale='0' >"; }
			else{ $_strXML = $_strXML . "<graph caption='' decimalPrecision='0' showNames='1' numberSuffix=' คดี' pieSliceDepth='30' formatNumberScale='0'>"; }
			
			while($_dat = mysql_fetch_assoc($_res))
			{
				$_level = ($_dat['xlevel']==3)?$_dat['xyearth']:($_dat['xyearth']+3);
				$_level = "ชั้นม. " . $_level;
				$_strXML = $_strXML . "<set name='" . $_level . "' value='" . $_dat['cc'] . "' color='" . getFCColor()  . "' showname='1'/> ";
			}
			$_strXML = $_strXML . "</graph>";
?>
	<div align="center">
		<table class="admintable" align="center" width="600px">
			<tr>
				<th align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>แผนภูมิแสดงพฤติกรรมไม่พึงประสงค์ตามสถานะดำเนินการแยกตามระดับชั้น
					<br/>สถานะดำเนินการ : <?=displayDisciplineStatus($_POST['level']);?>
					<br/>ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
				</th>
			</tr>
			<tr>
				<td>
				<?
					FC_SetRenderer("javascript");
					if($_POST['chartType'] == "column") { echo renderChart("../fusionII/charts/Column3D.swf", "", $_strXML , "discipline", 600, 450); }
					else { echo renderChart("../fusionII/charts/Pie3D.swf", "", $_strXML , "discipline", 600, 450); }	
					//echo $_strXML; ?>
				</td>
			</tr>
		</table>
    </div>
<? } else { ?><font color="#FF0000"><center><br/><br/>ไม่มีข้อมูลในรายการที่เลือก</center></font> <? } } //end if ?>				
</div>

