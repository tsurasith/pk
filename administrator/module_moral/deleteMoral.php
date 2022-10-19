<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_moral/index"><img src="../images/objects.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">ระบบสารสนเทศธนาคารความดี</font></strong><br />
	<span class="normal"><font color="#0066FF"><strong>ลบพฤติกรรมที่พึงประสงค์ของนักเรียน</strong></font></span></td>
     <td >&nbsp;</td>
    </tr>
  </table>
<? if(!isset($_POST['confirm'])){ ?>
	<form method="post">
	<table width="100%" align="center" class="admintable">
		<tr>
			<td  class="key" headers="30px"> ยืนยันการลบพฤติกรรมที่พึงประสงค์ </td>
		</tr>
		<tr>
			<td align="center" height="130px"><font color="#FF0000">
				คุณต้องการลบ พฤติกรรมที่พึงประสงค์ของนักเรียน ที่เลือกนี้ "ใช่" หรือ "ไม่ใช่"<br/><br/>
				<input type="hidden" name="num_id" value="<?=$_REQUEST['num_id']?>" />
				<input type="submit" name="confirm" value="ใช่" /> 
				<input type="button" value="ไม่ใช่"  onclick="history.go(-1)" />
				</font>
			</td>
		</tr>
	 </table>
	</form>
<? } else { // end if?> 
	<?
		$_p = mysql_fetch_assoc(mysql_query("select point,student_id,acadyear from student_moral where id = '" . $_POST['num_id'] . "'"));
		if($_p['point']>0){
			$_point = "update students set points = points - " . $_p['point'] . " 
				where id = '" . $_p['student_id'] ."' and xedbe = '" . $_p['acadyear'] . "'";
			mysql_query($_point);
		}
		mysql_query("delete from student_moral where id = '" . $_POST['num_id'] . "'");
	?>
	<table class="admintable" width="100%">
		<tr>
			<td class="key">ผลการดำเนินการ</td>
		</tr>
		<tr>
			<td align="center" height="130px"><font color="#008000">
				คุณได้ทำการลบ คดี ที่ต้องการเรียบร้อยแล้ว<br/><br/>
				<input type="button" value="ดำเนินการต่อไป" onclick="location.href='index.php?option=module_moral/index'" /></font>
			</td>
		</tr>
	</table>
<? } //end else ?>

</div>
