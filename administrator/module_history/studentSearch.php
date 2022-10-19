
<div id="content">

 <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" /></a></td>
      <td><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1. รายการสืบค้นประวัติ [ค้นหานักเรียน]</strong></font></span></td>
      <td >&nbsp;</td>
    </tr>
  </table>
  <br/>
<? if(!isset($_POST['search'])) { ?>
  <form action="" method="post" autocomplete="off">
	<table width="100%" align="center" cellspacing="1" class="admintable" cellpadding="3">
      <tr height="30px"> 
        <td  class="key" colspan="2">โปรดใส่รายละเอียดที่ต้องการสืบค้นข้อมูลนักเรียน</td>
	  </tr>
	  <tr>
	  	<td align="right" width="140px">เลขประจำตัวนักเรียน :</td><td><input type="text" name="student_id" maxlength="5" size="10" onkeypress="return isNumberKey(event)" class="inputboxUpdate" /></td>
	  </tr>
	  <tr>
	  	<td align="right">ชื่อ :</td><td><input type="text" name="firstname" class="inputboxUpdate"/> สกุล <input type="text" name="lastname" class="inputboxUpdate" /></td>
	  </tr>
	  <tr>
	  	<td align="right">ชื่อเล่น :</td><td><input  type="text"  name="nickname" size="10" class="inputboxUpdate" /></td>
	  </tr>
	  <tr>
	  	<td align="right">หมู่บ้านที่อาศัย :</td><td><input type="text" name="p_village" size="40" class="inputboxUpdate" /></td>
	  </tr>
	  <tr>
	  	<td align="right">จำนวนรายการที่แสดง :</td>
		<td>
			<select name="list" class="inputboxUpdate">
				<option value="10">10</option>
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="100">100</option>
				<option value="all">ทั้งหมด</option>
			</select>
		</td>
	  </tr>
	  <tr>
	  	<td>&nbsp;</td><td><input type="submit" name="search" value="สืบค้น"/> <input type="reset" value="ล้างข้อมูลสืบค้น" /></td>
	  </tr>
	</table>
	</form>
<? }// end -if ?>

<? if(isset($_POST['search']) && $_POST['student_id'] == "" && $_POST['firstname'] == "" && $_POST['lastname'] == "" && $_POST['nickname'] == ""  && $_POST['p_village'] == "") {?>
		<center><font color="#FF0000"><br/><br/>โปรดใส่รายละเอียดที่ต้องการสืบค้นข้อมูลนักเรียนก่อนค้นหา
		<br/><br/><input type="button" value="กลับไปหน้าค้นหา" onClick="history.go(-1)"/>
		</font></center>
  <? } ?>
  
<? if(isset($_POST['search']) && ($_POST['student_id'] != "" || $_POST['firstname'] != "" || $_POST['lastname'] != "" || $_POST['nickname'] != ""  || $_POST['p_village'] != "")) {?>
<?		$_sql = "select distinct id from students 
				where 1=1 ";
				$_sql .= trim($_POST['student_id'])==""?"":" and id like '%" . $_POST['student_id'] . "%'";
				$_sql .= trim($_POST['firstname'])==""?"":" and firstname like '%" . $_POST['firstname'] . "%'";
				$_sql .= trim($_POST['lastname'])==""?"":" and lastname like '%" . $_POST['lastname'] . "%'";
				$_sql .= trim($_POST['nickname'])==""?"":" and nickname like '%" . $_POST['nickname'] . "%'";
				$_sql .= trim($_POST['p_village'])==""?"":" and p_village like '%" . $_POST['p_village'] . "%' ";
				$_sql .= " order by id";
		//echo $_sql;
		
		if($_POST['list'] != "all")	$_sql .= " limit 0," . $_POST['list'] ;
				
		$_result = mysql_query($_sql);
		if(mysql_num_rows($_result) > 0) { ?>
			<table class="admintable" align="center">
				<tr align="center" height="30px">
					<td class="key" width="35px">ที่</td>
					<td class="key" width="75px">เลขประจำตัว</td>
					<td class="key" width="200px">ชื่อ - สกุล</td>
					<td class="key" width="50px">ชื่อเล่น</td>
					<td class="key" width="40px">ห้อง</td>
					<td class="key" width="120px">สถานะภาพ</td>
					<td class="key" width="180px">หมู่บ้าน</td>
				</tr>
				<? $_i = 1; ?>
				<? while($_dat = mysql_fetch_assoc($_result)){ ?>
				<tr>
					<td align="center"><?=$_i++?></td>
					<? $_sqlx = " select prefix,firstname,lastname,nickname,xedbe,xyearth,xlevel,room,p_village,studstatus from students
									where id = '" . $_dat['id'] . "' order by xedbe desc limit 0,1 ";
						$_resx = mysql_query($_sqlx);
						$_datx = mysql_fetch_assoc($_resx); ?>
					<td align="center"><a href="index.php?option=module_history/history&studentid=<?=$_dat['id']?>&acadyear=<?=$_datx['xedbe']?>"><?=$_dat['id']?></a></td>
					<td ><?=$_datx['prefix'] . $_datx['firstname'] . ' ' . $_datx['lastname']?></td>
					<td align="left"><?=$_datx['nickname']?></td>
					<td align="center"><?=displayXyear($_datx['xlevel'] . '/' . $_datx['xyearth']) . '/' . $_datx['room']?></td>
					<td align="center"><?=displayStudentStatusColor($_datx['studstatus'])?></td>
					<td ><?=$_datx['p_village']!=""?$_datX['p_village']:"-"?></td>
				</tr>
				<? } //end while?>
			</table>
			<input type="button" value="กลับไปหน้าค้นหา" onClick="history.go(-1)"/>
	<?	} else {?>
			<center><font color="#008000"><br/><br/>ไม่พบข้อมูลตามเงื่อนไขที่ค้นหา โปรดลองระบุเงื่อนไขในการค้นหาใหม่อีกครั้ง
			<br/><br/><br/><input type="button" value="กลับไปหน้าค้นหา" onClick="history.go(-1)"/></font></center>
  	<? } //end if-else ค้นหาข้อมูลจากฐานข้อมูล ?>
<? }//end check value ในการค้นหา ?>

</div>
