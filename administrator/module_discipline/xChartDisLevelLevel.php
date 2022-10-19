

<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center" valign="top"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td width="45%" valign="top"><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.4 แผนภูมิสรุปพฤติกรรมไม่พึงประสงค์<br/>ตามระดับโทษความผิดตามระดับชั้น</strong></font></span></td>
      <td align="right">
	  	<?php
			if(isset($_REQUEST['acadyear'])){ $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])){ $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_discipline/xChartDisLevelLevel&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_discipline/xChartDisLevelLevel&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <?php 
					if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_discipline/xChartDisLevelLevel&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_discipline/xChartDisLevelLevel&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<font color="#000000" size="2">
		  <form action="" method="post">
			ระดับชั้น 
			<select name="level" class="inputboxUpdate">
				<option value=""></option>
				<option value="3/1" <?=isset($_POST['level'])&&$_POST['level']=="3/1"?"selected":""?>> มัธยมศึกษาปีที่ 1 </option>
				<option value="3/2" <?=isset($_POST['level'])&&$_POST['level']=="3/2"?"selected":""?>> มัธยมศึกษาปีที่ 2 </option>
				<option value="3/3" <?=isset($_POST['level'])&&$_POST['level']=="3/3"?"selected":""?>> มัธยมศึกษาปีที่ 3 </option>
				<option value="4/1" <?=isset($_POST['level'])&&$_POST['level']=="4/1"?"selected":""?>> มัธยมศึกษาปีที่ 4 </option>
				<option value="4/2" <?=isset($_POST['level'])&&$_POST['level']=="4/2"?"selected":""?>> มัธยมศึกษาปีที่ 5 </option>
				<option value="4/3" <?=isset($_POST['level'])&&$_POST['level']=="4/3"?"selected":""?>> มัธยมศึกษาปีที่ 6 </option>
				<option value="all" <?=isset($_POST['level'])&&$_POST['level']=="all"?"selected":""?>>ทั้งโรงเรียน</option>
			</select> <input type="submit" name="search" value="เรียกดู" class="button"/><br/>
			<input name="chartType" type="radio" value="column" <?=$_POST['chartType']!="pie"?"checked":""?>> กราฟแท่ง 
			<input type="radio" value="pie" name="chartType" <?=isset($_POST['chartType'])&&$_POST['chartType']=="pie"?"checked":""?>> กราฟวงกลม<br/>
		    <input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา<br/>
			 <input type="checkbox" name="split" value="split" <?=$_POST['split']=="split"?"checked='checked'":""?> />
			 ไม่นับรวมการขาด สาย ลา กิจกรรมหน้าเสาธง
		  </form>
		  </font>
		  </td>
    </tr>
    <tr>
    	<td colspan="3">
        	<font size="2" color="#000000">
            	<u>คำชี้แจง</u> - แผนภูมินี้จะนับเฉพาะคดีที่มีสถานะตั้งแต่สอบสวนคดีเสร็จสิ้นแล้วจนถึงสถานะปิดคดี
            </font>
        </td>
    </tr>
  </table>
<br />
<? if(isset($_POST['search']) && $_POST['level']==""){ ?>
		<font color="#FF0000"><center><br/>กรุณาเลือกระดับชั้นก่อน</center></font>
<? } //end if ?>

<?php
	if(isset($_POST['search']) && $_POST['level'] != "") {
		$_xx = explode('/',$_POST['level']);
		
		$_sql = "select c.dis_level,count(*) as 'count' from students right outer join student_disciplinestatus b
			on (id = b.student_id) right outer join student_investigation c on (b.dis_id = c.dis_id)
			where xedbe = '" . $acadyear. "' and b.acadyear = '" . $acadyear. "' and c.dis_type != '00'
			and b.acadsemester = '" . $acadsemester . "'";	
		if($_POST['level']!="all"){$_sql .= " and xlevel = '" . $_xx[0] . "' and xyearth = '" . $_xx[1] . "' ";}
		if($_POST['studstatus']=="1,2"){ $_sql .= " and studstatus in (1,2) "; }
		if($_POST['split']=="split"){$_sql.= " and b.dis_id in (select dis_id from student_discipline where dis_detail not like '%การเข้าร่วมกิจกรรมหน้าเสาธง%')";}
		$_sql .= " group by c.dis_level order by 1";
		$_res = mysql_query($_sql);
		if(mysql_num_rows($_res) > 0) {			
			$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
			if($_POST['chartType'] == "column") { $_strXML = $_strXML . "<graph caption='' xAxisName='' yAxisName='Units' decimalPrecision='0' formatNumberScale='0' >"; }
			else { $_strXML = $_strXML . "<graph caption='' decimalPrecision='0' showNames='1' numberSuffix=' คดี' pieSliceDepth='30' formatNumberScale='0'>"; }
	?>
    	<div align="center">			
			<table class="admintable" align="center" width="600px">
			<tr>
				<th align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>แผนภูมิแสดงพฤติกรรมไม่พึงประสงค์ตามระดับโทษความผิด
					<br/><?=$_POST['level']=="all"?"ทั้งโรงเรียน":displayLevel($_POST['level'])?>
					<br/>ภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?>
				</th>
			</tr>
			<tr>
				<td align="center">
					<table class="admintable">
						<tr>
							<td class="key" width="200px" align="center">ระดับโทษพฤติกรรม<br/>ไม่พึงประสงค์</td>
							<td class="key" width="70px"  align="center">จำนวน</td>
						</tr>
						<? $_count=0;?>
						<? while($_dat = mysql_fetch_assoc($_res)) { ?>
							<? if($_dat['count']>0) { $_strXML = $_strXML . "<set name='" . displayDislevel($_dat['dis_level']) . "' value='" . $_dat['count'] . "' color='" . getFCColor()  . "' showname='1'/> "; } ?>
							<tr>
								<td align="left" style="padding-left:15px;"><?=displayDislevel($_dat['dis_level'])?></td>
								<td align="right" style="padding-right:15px;"><?=$_dat['count']?></td>
							</tr>
						<? $_count+=$_dat['count'];} //end while ?>
						<tr height="30px">
							<td align="center" class="key">รวม</td>
							<td align="right" class="key" style="padding-right:10px;"><?=$_count?></td>
                         </tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
<?				$_strXML = $_strXML . "</graph>";
				FC_SetRenderer("javascript");
				if($_POST['chartType'] == "column") { echo renderChart("../fusionII/charts/Column3D.swf", "", $_strXML , "discipline", 700, 450); }
				else { echo renderChart("../fusionII/charts/Pie3D.swf", "", $_strXML , "discipline", 600, 450); }	
?>				</td>
			</tr>
			</table>
        </div>
<?		} else { ?> <font color="#FF0000"><center><br/><br/>ไม่มีข้อมูลในภาคเรียนที่ <?=$acadsemester?> ปีการศึกษา <?=$acadyear?> </center></font><? } }//end if-else?>
</div>
<? 
	function displayLevel($_value){
		$_x = explode('/',$_value);
		if($_x[0] == 3) return "ชั้นมัธยมศึกษาปีที่ " . $_x[1];
		else return "ชั้นมัธยมศึกษาปีที่ " . ($_x[1] + 3);
	}
	function displayDislevel($_value){
		$_dat = mysql_fetch_assoc(mysql_query("SELECT * FROM ref_disciplinelevel where dis_levelid = '" . $_value . "'"));
		return $_dat['dis_leveldetail'];
	}
?>