

<div id="content">
<form action="" method="post">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center" valign="top"><a href="index.php?option=module_maps/index"><img src="../images/add.png" alt="" width="54" height="50" border="0" /></a></td>
    	<td valign="top"><strong><font color="#990000" size="4">แผนที่ติดตามที่อยู่</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>3.3 แผนภูมิจำนวนนักเรียนตามตำบลที่อาศัย</strong></font></span></td>
      <td >
	  	<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_maps/reportTumbolChart&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo '<font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_maps/reportTumbolChart&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		<br/>
			<font color="#000000" size="2">
			เลือกระดับชั้น
		  	<select name="roomID" class="inputboxUpdate">
		  		<option value=""></option>
				<option value="3/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/1"?"selected":""?>> มัธยมศึกษาปีที่ 1 </option>
				<option value="3/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/2"?"selected":""?>> มัธยมศึกษาปีที่ 2 </option>
				<option value="3/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="3/3"?"selected":""?>> มัธยมศึกษาปีที่ 3 </option>
				<option value="4/1" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/1"?"selected":""?>> มัธยมศึกษาปีที่ 4 </option>
				<option value="4/2" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/2"?"selected":""?>> มัธยมศึกษาปีที่ 5 </option>
				<option value="4/3" <?=isset($_POST['roomID'])&&$_POST['roomID']=="4/3"?"selected":""?>> มัธยมศึกษาปีที่ 6 </option>
				<option value="all" <?=isset($_POST['roomID'])&&$_POST['roomID']=="all"?"selected":""?>> ทั้งโรงเรียน </option>
			</select>  
	  		<input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			<input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา<br/>
			<input name="chartType" type="radio" value="column" <?=$_POST['chartType']!="pie"?"checked":""?>> กราฟแท่ง 
			<input type="radio" value="pie" name="chartType" <?=$_POST['chartType']=="pie"?"checked":""?>> กราฟวงกลม
		  </font>
		  </td>
    </tr>
  </table>
</form>
<? if(isset($_POST['search']) && $_POST['roomID'] == ""){ ?>
		<center><font color="#FF0000"><br/>กรุณาเลือก ระดับชั้น ที่ต้องการเรียกดูข้อมูลก่อน</font></center>
<? } //end if ?>
<?php
  $_sql = "";
  $_totalStudent = 0;
  if($_POST['roomID']=="all")
  {
  	$_sql = "select p_tumbol,count(*)as c from students where xedbe = '" . $acadyear . "'  ";
	if($_POST['studstatus']=="1,2") $_sql .= "and studstatus in (1,2) ";
	$_sql .= " group by p_tumbol order by count(*) desc ";
  }
  else
  {
  	$_sql = "select p_tumbol,count(*)as c from students 
				where xedbe = '" . $acadyear . "' and xlevel = '" . substr($_POST['roomID'],0,1) . "' 
					and xyearth = '" . substr($_POST['roomID'],2,1) . "' ";
	if($_POST['studstatus']=="1,2") $_sql .= "and studstatus in (1,2) ";
	$_sql .= " group by p_tumbol order by count(*) desc ";
  }
  $_result = mysql_query($_sql);
  if(mysql_num_rows($_result)>0) {
  ?>
 <table class="admintable" width="100%"  cellpadding="1" cellspacing="1" border="0" align="center">
    <tr> 
      <th align="center">
	  		<img src="../images/school_logo.gif" width="120px"><br/>
			แผนภูมิแสดงจำนวนนักเรียนที่อาศัยอยู่ในแต่ละตำบล <br/>
			นักเรียนชั้นมัธยมศึกษาปีที่ <?=displayXyear($_POST['roomID'])?><br/>
			ภาคเรียนที่ <?=$acadsemester; ?> ปีการศึกษา <?=$acadyear; ?>
	  </th>
    </tr>
	<tr>
		<td align="center">
		  <?					
				$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
				if($_POST['chartType'] == "column")	{ $_strXML = $_strXML . "<graph caption='' xAxisName='' yAxisName='Units' decimalPrecision='0'  formatNumberScale='0' >";}
				else{$_strXML = $_strXML . "<graph decimalPrecision='0' showNames='1' numberSuffix=' คน' pieSliceDepth='30' formatNumberScale='0'>";}
				
				while($_dat = mysql_fetch_assoc($_result))
				{
					$_strXML = $_strXML . "<set name='" . $_dat['p_tumbol'] . "' value='" . $_dat['c'] . "' color='" . getFCColor()  . "' showname='1'/> ";
				}
				$_strXML = $_strXML . "</graph>";
				FC_SetRenderer("javascript");
				if($_POST['chartType'] == "column")	{echo renderChart("../fusionII/charts/Column3D.swf", "", $_strXML , "discipline", 750, 450);}
				else{echo renderChart("../fusion/Charts/Pie3D.swf", "", $_strXML , "Address", 600, 450);	}	
		?>			
		</td>
	</tr>
</table>
<? } // end if ?> 
 
</div>

