<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_projects/index">
			<img src="../images/computer.png" alt="" width="48" height="48" border="0"/>
		</a>
	  </td>
    <td ><strong><font color="#990000" size="4">ระบบสารสนเทศกิจกรรม/โครงการ</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>2.2.7 รายงานสรุปกิจกรรมโครงการ<br/>ตามมาตรฐานและตัวชี้วัด(เรียงตามกิจกรรมโครงการ)</strong></font></span></td>
      <td >
		<?php
			if(isset($_REQUEST['acadyear'])) { $acadyear = $_REQUEST['acadyear']; }
			if(isset($_REQUEST['acadsemester'])) { $acadsemester = $_REQUEST['acadsemester']; }
		?>
		ปีการศึกษา<?php  
					echo "<a href=\"index.php?option=module_projects/xReportStandardYearName&acadyear=" . ($acadyear - 1) . "\"><img src=\"../images/pull_left.gif\" border=\"0\" /></a> " ;
					echo ' <font color=\'blue\'>' .$acadyear . '</font>';
					echo " <a href=\"index.php?option=module_projects/xReportStandardYearName&acadyear=" . ($acadyear + 1) . "\"><img src=\"../images/pull_right.gif\" border=\"0\" /></a> " ;
				?>
		<br/>
		<form method="post" name="myform">
			<font size="2" color="#000000">
				มาตรฐาน
				<select name="standard" class="inputboxUpdate">
					<option value=""></option>
					<option value="00" <?=$_POST['standard']=="00"?"selected":""?>>สมศ.</option>
					<option value="01" <?=$_POST['standard']=="01"?"selected":""?>>สพฐ.</option>
					<option value="02" <?=$_POST['standard']=="02"?"selected":""?>>ท้องถิ่นฯ</option>
				</select> 
				<input type="submit" value="เรียกดู" name="search" class="button" /><br/>
				<input type="checkbox" value="1" name="budgetType" onclick="document.myform.submit();" <?=$_POST['budgetType']=="1"?"checked":""?> /> เฉพาะเงินงบประมาณแผ่นดิน
			</font>
		</form>
	  </td>
    </tr>
  </table>
<? if(isset($_POST['search']) && $_POST['standard'] == ""){ ?>
		<center><font color="#FF0000"><br/><br/>กรุณาเลือก มาตรฐาน ที่ต้องการทราบข้อมูลก่อน</font></center>
<? }//end if ?>

<? if($_POST['standard'] != "") { ?>
		<?	$_sql = "select a.standard,a.indexof,b.project_name,b.budget_income,b.budget_academic
					from project_qa a left outer join project b on (a.project_id = b.project_id)
					where organize = '" . $_POST['standard'] . "' and acadyear = '" . $acadyear . "' "; ?>
		<? $_sql .= ($_POST['budgetType']!="1"?"":" and a.budget_type = '00' ");	?>
		<? $_sql .= " order by b.acadyear,b.acadsemester,b.project_name,a.standard,a.indexof"; ?>
		<?	$_res = @mysql_query($_sql); ?>
		<?	if(@mysql_num_rows($_res)>0) { ?>
			<table class="admintable" align="center">
				<tr>
					<th colspan="5" align="center">
						<img src="../images/school_logo.gif" width="120px"><br/>
						รายงานกิจกรรมโครงการ<br/>
						ตามมาตรฐานของ<?=$_POST['standard']=="00"?"สมศ.":($_POST['standard']=="01"?"สพฐ.":"ท้องถิ่น")?> 
						ปีการศึกษา <?=$acadyear?>
					</th>
				</tr>
				<tr align="center">
					<td class="key" width="35px">ที่</td>
					<td class="key" width="400px">กิจกรรมโครงการ</td>
					<td class="key" width="90px">งบอนุมัติ</td>
					<td class="key" width="120px">ฝ่ายที่รับผิดชอบ</td>
					<td class="key" width="75px">มาตรฐานที่</td>
					<td class="key" width="50px">ตัวชี้วัด</td>
				</tr>
				<? $_i = 1; $_before = ""; $_pName = ""; $_budget = ""; $_bAcademic = ""; ?>
				<? while($_dat = mysql_fetch_assoc($_res)){ ?>
					<tr onMouseOver="this.style.backgroundColor='#FFCCFF'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#FFFFFF" >
						<td align="center" valign="top"><?=$_dat['project_name']!=$_pName?$_i++:""?></td>
						<td align="left" valign="top">
							<?=$_dat['project_name']!=$_pName?$_dat['project_name']:""?>
							<? $_pName = $_dat['project_name']; ?>
						</td>
						<td align="right" valign="top">
							<?=$_dat['budget_income']!=$_budget?number_format($_dat['budget_income'],2,'.',','):""?>
							<? $_budget = $_dat['budget_income']; ?>
						</td>
						<td align="left" valign="top">
							<?=$_dat['budget_academic']!=$_bAcademic?$_dat['budget_academic']:""?>
							<? $_bAcademic = $_dat['budget_academic']; ?>
						</td>
						<td align="center" valign="top">
							<?=$_dat['standard']!=$_before?$_dat['standard']:""?>
							<? $_before = $_dat['standard']; ?>
						</td>
						<td align="center" valign="top"><?=$_dat['indexof']?></td>
					</tr>	
				<? }//end while ?>
			</table>
		<?	}else { ?><center><font color="#FF0000"><br/><br/>ไม่พบข้อมูลที่ต้องการ</font></center> <? } //end if check rows ?>
<? }//end if check submit form ?>
</div>

