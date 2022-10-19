
<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.8 แผนภูมิแสดงเปรียบเทียบร้อยละ<br/>ของการเข้าร่วมกิจกรรมหน้าเสาธง(ภาคเรียน)</strong></font></span></td>
      <td >		
		<form action="" method="post">
			<font color="#000000" size="2" >
			การเข้าร่วมกิจกรรม 
				<select name="check" class="inputboxUpdate">
					<option></option>
					<option value="01" <?=isset($_POST['check'])&&$_POST['check']=='01'?"selected":""?>> กิจกรรม </option>
					<option value="02" <?=isset($_POST['check'])&&$_POST['check']=='02'?"selected":""?>> สาย </option>
					<option value="03" <?=isset($_POST['check'])&&$_POST['check']=='03'?"selected":""?>> ลา </option>
					<option value="04" <?=isset($_POST['check'])&&$_POST['check']=='04'?"selected":""?>> ขาด </option>
				</select>  <input type="submit" name="search" value="เรียกดู" class="button" /><br/>
				<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
				เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา</font>
		</form>
	  </td>
    </tr>
  </table>

<? if(isset($_POST['search']) && $_POST['check'] == ""){ ?>
		<br/><br/><center><font color="#FF0000">กรุณาเลือก รายการ การเข้าร่วมกิจกรรมหน้าเสาธงก่อน</font></center>
<? } //end if ?>

<? if(isset($_POST['search']) && $_POST['check'] != ""){ ?>
	<?	$sqlStudent = "select acadsemester,acadyear,
				count(distinct check_date) as 'day',
				sum(if(timecheck_id = '" . $_POST['check'] . "',1,0)) as 'x',
				count(timecheck_id) as 'all',
				100*sum(if(timecheck_id = '" . $_POST['check'] . "',1,0))/count(timecheck_id) as 'px' 
			from student_800 left outer join students on (student_id = id and acadyear = xedbe) "; ?>
	<?  $sqlStudent .= ($_POST['studstatus']=="1,2"?" where studstatus in (1,2) ":""); ?>
	<?  $sqlStudent .= " group by acadsemester,acadyear order by acadyear,acadsemester"; ?>

	<? $resStudent = mysql_query($sqlStudent); ?>
	<? if(mysql_num_rows($resStudent)>0) { ?>
		<table class="admintable" width="100%">
			<tr>
				<th align="center">
					<img src="../images/school_logo.gif" width="120px">
					<br/>รายงานสรุปร้อยละการ<?=displayTimecheck($_POST['check'])?> การเข้าร่วมกิจกรรมหน้าเสาธง
					<br/>เปรียบเทียบรายภาคเรียน<br/>
				</th>
			</tr>
			<tr><td align="center"><div id="chart1" align="center" ></div></td></tr>
			<tr>
				<td align="center">
					<? $_scale = ($_POST['check']=="04"?15:2.5); ?>
					<? $_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ; ?>
					<? $_strXML .= "<graph caption='' yAxisName='Units' decimalPrecision='2' formatNumberScale='0' yAxisMaxValue='" . $_scale ."' >"; ?>
					<table class="admintable">
						<tr>
							<td class="key" align="center" width="150px">ภาคเรียน/ปีการศึกษา</td>
							<td class="key" align="center" width="80px">จำนวนวัน<br/>ที่มีกิจกรรม</td>
							<td class="key" align="center" width="90px">จำนวนรวม<?=displayTimecheck($_POST['check'])?>(ครั้ง)</td>
							<td class="key" align="center" width="130px">จำนวนรวมเช็ค<br/>ทั้งหมด(ครั้ง)</td>
							<td class="key" align="center" width="70px">ร้อยละ<br/>ภาคเรียน</td>
						</tr>
						<? $_day=0; $_x=0; $_all=0; ?>
						<? while($dat = mysql_fetch_assoc($resStudent)) { ?>
							<tr>
								<td align="center" style="padding-left:15px;"><?=$dat['acadsemester'] . '/' . $dat['acadyear']?></td>
								<td align="right" style="padding-right:35px;"><?=$dat['day']?></td>
								<td align="right" style="padding-right:10px;"><?=$dat['x']==0?"-":number_format($dat['x'],0,'',',')?></td>
								<td align="right" style="padding-right:10px;"><?=$dat['all']==0?"-":number_format($dat['all'],0,'',',')?></td>
								<td align="right" style="padding-right:15px;"><?=$dat['px']==0?"-":number_format($dat['px'],2,'.',',')?></td>
							</tr>
							<? $_strXML .= "<set name='" . $dat['acadsemester'] . '/' . $dat['acadyear'] . "' value='" . number_format($dat['px'],2,'.',',') . "' color='" . getFCColor()  . "' /> "; ?>
						<? } //end while ?>
					</table>
					<? $_strXML = $_strXML . "</graph>"; ?>
					<script language="javascript" type="text/javascript">
						FusionCharts.setCurrentRenderer('JavaScript');
						var myColumn = new FusionCharts("../fusionII/charts/Column3D.swf", "myColumn", "600", "330");
						myColumn.setDataXML("<?=$_strXML?>");
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
			<tr><td><br/><u>หมายเหตุ</u>: แกน X คือ ภาคเรียนและปีการศึกษา และ แกน Y คือ ร้อยละ</td></tr>
</table>
	<? } else { echo "<br/><br/><center><font color='red'>ยังไม่มีการบันทึกข้อมูลในรายการที่คุณเลือก</font></center>"; } ?>
<? }//end if ตรวจสอบการคลิ๊กเลือกรายการ ?>
</div>

