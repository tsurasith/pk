<div id="content">
  <table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center">
	  	<a href="index.php?option=module_config/index">
			<img src="../images/config.png" alt="" width="48" height="48" />
		</a>
	</td>
      <td><strong><font color="#990000" size="4">ปรับแต่งระบบ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.1 เพิ่ม/ลบ ห้องเรียนที่ใช้ในระบบ &gt;&gt; ลบห้องเรียน</strong></font></span></td>
      <td></td>
    </tr>
  </table>
<? if(isset($_REQUEST['room_id']) && isset($_REQUEST['acadyear']) && isset($_REQUEST['acadsemester'])){ ?>
		<?
			$_xedbe = $_REQUEST['acadyear'];
			$_xlevel = substr($_REQUEST['room_id'],0,1)<4?3:4;
			$_xyearth = substr($_REQUEST['room_id'],0,1)<4?substr($_REQUEST['room_id'],0,1):substr($_REQUEST['room_id'],0,1)-3;
			$_room = (int) substr($_REQUEST['room_id'],1,2);
		?>
		<? $_sqlCheckStudent = "select id from students where xedbe = '" . $_xedbe . "' and xlevel = '" . $_xlevel . "' and xyearth = '" . $_xyearth . "' and room = '" . $_room ."'";?>
		<? $_resCheckStudent = mysql_query($_sqlCheckStudent); ?>
		
		<table class="admintable" width="100%">
			<tr>
				<td class="key">ผลการดำเนินการ</td>
			</tr>
			<tr>
				<td align="center">
					<? if(mysql_num_rows($_resCheckStudent)>0){?>
							<font color="#FF0000"><br/>
							ไม่สามารถทำการลบห้อง <?=displayRoom($_REQUEST['room_id'])?> 
							ออกจากภาคเรียนที่ <?=$_REQUEST['acadsemester']?> ปีการศึกษา <?=$_REQUEST['acadyear']?> ได้ <br/>
							เนื่องจากมีนักเรียนที่อยู่ในห้องเรียนนี้จำนวน <?=mysql_num_rows($_resCheckStudent)?> คน ถ้าหากต้องการ
							'ลบ' ต้องแก้ไขประวัตินักเรียนโดยทำการย้ายห้องเรียนเสียก่อน
							</font><br/><br/><br/>
							<input type="button" value="ย้อนกลับ" onclick="history.go(-1)" />
					<? } else { ?> 
							<? $_sqlDel = "delete from rooms where room_id = '" . $_REQUEST['room_id'] . "' and acadyear = '" . $_REQUEST['acadyear'] . "' and acadsemester = '" . $_REQUEST['acadsemester'] . "'";?>
							<? if(mysql_query($_sqlDel)){ ?>
									<font color="#008000">
									ได้ทำการลบข้อมูลห้อง <?=displayRoom($_REQUEST['room_id'])?> ออกจากระบบแล้ว
									</font><br/><br/><br/>
									<input type="button" value="ดำเนินการต่อไป" onclick="location.href='index.php?option=module_config/roomSetting&acadyear=<?=$_REQUEST['acadyear']?>&acadsemester=<?=$_REQUEST['acadsemester']?>'" />
							<? } else
								{ 
									echo "<font color='red'>";
									echo "<br/>ไม่สามารถทำการลบห้อง " . displayRoom($_REQUEST['room_id']) . " ได้ เนื่องจาก - " . mysql_error() ;
									echo "</font>";
									echo "<br/><br/><br/><input type='button' value='ย้อนกลับ' onclick='history.go(-1)'/>";
								}
							?>
					<? } ?>
				</td>
			</tr>
		</table>
<? } else { echo "<br/><br/><center><input type='button' value='กลับ' onclick='history.go(-1)'/></center>";} ?>

</div>
<?
	function displayRoom($_value){
		$_level = substr($_value,0,1);
		$_room = (int)substr($_value,1,2);
		return $_level . '/' . $_room ;
	}
?>