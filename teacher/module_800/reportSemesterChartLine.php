

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_800/index"><img src="../images/refresh.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">8.00 O' Clock</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>2.4 แผนภูมิเปรียบเทียบการเข้าร่วมกิจกรรมหน้าเสาธง<br/>(กราฟพื้นที่ทั้งโรงเรียน)</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_800/reportSemesterChartLine&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_800/reportSemesterChartLine&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		ภาคเรียนที่   <? if($acadsemester == 1) { echo "<font color='blue'>1</font> , "; }
					else {
						echo " <a href=\"index.php?option=module_800/reportSemesterChartLine&acadyear=" . ($acadyear) . "&acadsemester=1 \"> 1</a> , " ;
					}
					if($acadsemester == 2) { echo "<font color='blue'>2</font>"; }
					else {
						echo " <a href=\"index.php?option=module_800/reportSemesterChartLine&acadyear=" . ($acadyear) . "&acadsemester=2 \"> 2</a> " ;
					}
				?>
		<form action="" method="post">
		<font color="#000000" size="2"  >
		เลือกเดือน
			 <select name="month" class="inputboxUpdate">
			 	<option value=""> </option>
				<? $_sqlMonth = "select distinct month(check_date)as m,year(check_date)+543 as y
									from student_800 where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
									order by year(check_date),month(check_date)";
					$_resMonth = mysql_query($_sqlMonth); ?>
				<? while($_datMonth = mysql_fetch_assoc($_resMonth)) { ?>
						<option value="<?=$_datMonth['m']?>" <?=isset($_POST['month'])&&$_POST['month']==$_datMonth['m']?"selected":""?> > <?=displayMonth($_datMonth['m']) . ' ' . $_datMonth['y'] ?></option>
				<? } ?>
				<? if(mysql_num_rows($_resMonth)>0){ ?><option value="all" <?=isset($_POST['month'])&&$_POST['month']=="all"?"selected":""?>>ทั้งหมด</option><? } ?>
			 </select>
			 <input type="submit" value="เรียกดู" class="button" name="search"/> <br/>
			 <input type="checkbox" name="studstatus" value="1,2" <?=$_POST['studstatus']=="1,2"?"checked='checked'":""?> />
			 เฉพาะนักเรียนสถานะปกติหรือสำเร็จการศึกษา
		  </font>
		  </form>
	  </td>
    </tr>
  </table>
<?php
		$_sql = "";
		if($_POST['month'] == "all") {
			$_sql = "select check_date,
					  sum(if(timecheck_id = '00',timecheck_id,0)+1) as a,
					  sum(if(timecheck_id = '01',timecheck_id,0)) as b,
					  sum(if(timecheck_id = '02',timecheck_id,0))/2 as c,
					  sum(if(timecheck_id = '03',timecheck_id,0))/3 as d,
					  sum(if(timecheck_id = '04',timecheck_id,0))/4 as e
					from student_800 left outer join students on student_id = id
					where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
						and xEDBE = '" . $acadyear . "' ";
			if($_POST['studstatus']=="1,2"){$_sql .= " and studstatus in (" . $_POST['studstatus'] . ") ";}
			$_sql .= "group by check_date order by check_date";
		}
		else {
			$_sql = "select check_date,
					  sum(if(timecheck_id = '00',timecheck_id,0)+1) as a,
					  sum(if(timecheck_id = '01',timecheck_id,0)) as b,
					  sum(if(timecheck_id = '02',timecheck_id,0))/2 as c,
					  sum(if(timecheck_id = '03',timecheck_id,0))/3 as d,
					  sum(if(timecheck_id = '04',timecheck_id,0))/4 as e
					from student_800 left outer join students on student_id = id
					where acadyear = '" . $acadyear . "' and acadsemester = '" . $acadsemester . "'
						and month(check_date) = '" . $_POST['month'] . "' and xEDBE = '" . $acadyear . "' ";
			if($_POST['studstatus']=="1,2"){$_sql .= " and studstatus in (" . $_POST['studstatus'] . ") ";}
			$_sql .= "group by check_date order by check_date";
		}
	?>	 
<? if(isset($_POST['search']) && $_POST['month'] == "") { ?>
		<br/><br/><center><font color="#FF0000">กรุณาเลือก เดือน ที่ต้องการทราบข้อมูลก่อน</font></center>
<? } //end if ?>

<? if(isset($_POST['search']) && $_POST['month'] != "") { ?>
  <table class="admintable"  cellpadding="1" cellspacing="1" border="0" align="center" width="100%">
    <tr>
      <th align="center">
	  	<img src="../images/school_logo.gif" width="120px">
	  	<br/>เปรียบเทียบการเข้าร่วมกิจกรรมหน้าเสาธง
		<br/>ภาคเรียนที่ <?php echo $acadsemester; ?> ปีการศึกษา <?php echo $acadyear; ?>
		<br/><?=($_POST['month']=="all")?"":("ประจำเดือน ". displayMonth($_POST['month'])) ?>
	  </th>
    </tr>
    <tr > 
		<td align="center">
			<?php
				$_res = mysql_query($_sql);
				$_rows = mysql_num_rows($_res);				
				
				$_strXML = "<?xml version='1.0' encoding='UTF-8' ?>" ;
				$_strXML = $_strXML . "<chart caption='' divlinecolor='F47E00' numVDivLines='10' showAreaBorder='1' areaBorderColor='000000' showNames='1'  vDivLineAlpha='30' formatNumberScale='1' labelDisplay='Rotate' decimalPrecision='0' yAxisMaxValue='100'>";
				$_catXML = "<categories>";
				$_setA = "<dataset seriesname='ขาด' color='FF5904' showValues='0' areaAlpha='30' showAreaBorder='1' areaBorderThickness='2' areaBorderColor='FF0000'>";
				$_setB = "<dataset seriesname='ลา' color='1D8BD1' showValue='0' alpha='20' showAreaBorder='1' areaBorderThickness='2' areaBorderColor='1D8BD1'>";
				$_setC = "<dataset seriesname='สาย' color='99cc99' showValue='0' alpha='30' showAreaBorder='1' areaBorderThickness='2' areaBorderColor='006600'>";
				
				while($_dat = mysql_fetch_assoc($_res))
				{
					$_catXML .= "<category name='" . displayDateChart($_dat['check_date']) . "'/>";
					$_setA .= "<set value='" . $_dat['e'] . "' />";
					$_setB .= "<set value='" . $_dat['d'] . "' />";
					$_setC .= "<set value='" . $_dat['c'] . "' />";
				}
				$_catXML .= "</categories>";
				$_setA .= "</dataset>";
				$_setB .= "</dataset>";
				$_setC .= "</dataset>";
				$_strXML .= $_catXML . $_setA . $_setB . $_setC . "</chart>";
				FC_SetRenderer( "javascript" );
				echo renderChart("../fusion/Charts/MSArea.swf", "", $_strXML , "absent", 720, 600);
				//echo $_strXML;
			?>
		</td>
    </tr>
</table>
<? }//end if  ?>
</div>

