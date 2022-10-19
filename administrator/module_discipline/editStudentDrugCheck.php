<SCRIPT language="javascript" type="text/javascript">

	function check(name,value)
	{
		document.getElementById(name).bgColor=value;
	}
</script>
<div id="content">
 <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
			<span class="normal"><font color="#0066FF"><strong>4. ระบบคัดกรองยาเสพติด [แก้ไขการคัดกรอง]</strong></font></span></td>
      <td >ปีการศึกษา <?=$acadyear?> ภาคเรียนที่ <?=$acadsemester?></td>
    </tr>
  </table><br/>

<? 
 if(isset($_POST['update'])){
	for($_i=0;$_i<4;$_i++){
		$_sql = "update student_drug set druglevel = '" . timecheck_id($_POST['check'][$_i]) . "'
				 where student_id = '" . $_POST['student_id'] ."' and drugtype = '" . $_POST['drugtype'][$_i] . "' and
					   check_date = '" . $_POST['month'] . "'";
		//echo $_sql . "<br/>";
		if(isset($_POST['drugtype'][$_i]) && $_POST['drugtype'][$_i] != "") mysql_query($_sql);
	}
 } //end if 
?>
 
<form method="post" autocomplete="off">
<table class="admintable" width="100%" align="center">
	<tr>
		<td class="key" colspan="2">รายการแก้ไขบันทึกการคัดกรองยาเสพติด</td>
	</tr>
	<tr>
		<td width="300px" align="right">เลือกเดือน :</td>
		<td>
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
		</td>
	</tr>
	<tr>
		<td align="right">เลขประจำตัวนักเรียน :</td>
		<td><input type="text" class="inputboxUpdate" name="student_id" size="5" maxlength="5" onkeypress="return isNumberKey(event)" value="<?=isset($_POST['student_id'])?$_POST['student_id']:""?>"/></td>
	</tr>
	<tr>
		<td>&nbsp;</td><td><input type="submit" name="search" value="เรียกดู" class="button" /></td>
	</tr>
</table>
</form>

<? if(isset($_POST['search']) && $_POST['student_id'] != "" && $_POST['month'] != ""){ ?>
	<? 
		$_sql = "select  * from student_drug where student_id='" . $_POST['student_id'] ."'
					and acadyear = '" . $acadyear . "' and acadsemester ='" . $acadsemester . "'
					and check_date = '" . $_POST['month'] . "'
				order by drugtype";
		$_res = mysql_query($_sql);	?>
		<? if(@mysql_num_rows($_res) > 0) { ?>
			<? $_datStud = mysql_fetch_assoc(mysql_query("select id,prefix,firstname,lastname,nickname,p_village,xlevel,xyearth,room  from students where xedbe = '" . $acadyear . "' and id = '" . $_POST['student_id'] . "'")) ?>
			<form method="post">
			<table class="admintable" width="100%" align="center">
				<tr>
					<td class="key" colspan="2">ผลการค้นหา [<font color="#0000FF" size="4">ข้อมูลส่วนตัวนักเรียน</font>]</td>
				</tr>
				<tr>
					<td align="right" width="120px">ชื่อ - สกุล :</td>
					<td><b><?=$_datStud['prefix'].$_datStud['firstname'] . ' ' . $_datStud['lastname']?></b></td>
				</tr>
				<tr>
					<td align="right">ชื่อเล่น :</td>
					<td><b><?=$_datStud['nickname']?></b></td>
				</tr>
				<tr>
					<td align="right">ห้อง :</td>
					<td><b><?=$_datStud['xlevel']==3?$_datStud['xyearth']:$_datStud['xyearth']+3?>/<?=$_datStud['room']?></b></td>
				</tr>
				<tr>
					<td align="right">หมู่บ้าน :</td>
					<td><b><?=$_datStud['p_village']?></b></td>
				</tr>
				<tr>
					<td class="key" colspan="2">
						ผลการค้นหา [<font color="#0000FF" size="4">การคัดกรอง</font>]
						<?=isset($_POST['update'])?"<font color='green' size='4'> !! ระบบได้บันทึกการแก้ไขเรียบร้อยแล้ว</font>":""?>
					</td>
				</tr>
				<? while($_dat = mysql_fetch_assoc($_res)){ ?>
				<tr>
					<td align="right">
						<b><?=displayDrug($_dat['drugType'])?></b>
						<input type="hidden" name="drugtype[<?=(int)$_dat['drugType']?>]" value="<?=$_dat['drugType']?>" />
					</td>
					<td>
						<table>
							<tr id="check[<?=(int)$_dat['drugType']?>]">
								<td ><input type="radio" name="check[<?=(int)$_dat['drugType']?>]" <?=$_dat['drugLevel']==00?"checked":""?> value="white" onClick="check(this.name,this.value)" /> ปกติ | </td>
								<td ><input type="radio" name="check[<?=(int)$_dat['drugType']?>]" <?=$_dat['drugLevel']==01?"checked":""?> value="yellow" onClick="check(this.name,this.value)" > เสี่ยง | </td>
								<td ><input type="radio" name="check[<?=(int)$_dat['drugType']?>]" <?=$_dat['drugLevel']==02?"checked":""?> value="orange" onClick="check(this.name,this.value)" > เคยลอง | </td>
								<td ><input type="radio" name="check[<?=(int)$_dat['drugType']?>]" <?=$_dat['drugLevel']==03?"checked":""?> value="red" onClick="check(this.name,this.value)" > ติด  </td>	
							</tr>
						</table>
					</td>
				</tr>
				<? } //end while ?>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="hidden" name="month" value="<?=$_POST['month']?>" />
						<input type="hidden" name="student_id" value="<?=$_POST['student_id']?>" />
						<input type="hidden" name="search" />
						<input type="submit" name="update" value="บันทึกแก้ไข" class="button" />
                        <input type="button" name="cancel" value="ยกเลิก" class="button" onclick="history.go(-1);"/>
					</td>
				</tr>
			</table>
			</form>
		<? } else {  ?>
	<table class="admintable" width="100%" align="center">
		<tr>
			<td class="key">ผลการค้นหา</td>
		</tr>
		<tr>
			<td align="center"><br/><font color="#FF0000">ไม่พบข้อมูลที่ค้นหา</font></td>
		</tr>
	</table>
	<? }//end else check rows data?>
<? } //end if check submit ?>


</div>
<?php
//-------------------------------
function timecheck_id($value)
{
	if($value == 'white') return '00';
	if($value == 'yellow') return '01';
	if($value == 'orange') return '02';
	if($value == 'red') return '03';
	else return 9;
}

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