<script language="javascript" type="text/javascript">
	function checkDeduct()
	{
			if(document.getElementById('deduct').value.trim()!='')
			{
				document.myform.submit();
			}
			else
			{
				alert('กรุณาระบุคะแนนพฤติกรรมที่ต้องการหักให้ถูกต้อง');
				document.getElementById('deduct').focus();
			}
	}
</script>
<? $_flag = 2; ?>
<? if(isset($_POST['deduct'])){
	$_sql = "update students 
				set points = '" . ($_POST['oldPoints'] - $_POST['deduct']) . "' 
					where id = '" . $_POST['studentid'] . "' and 
			 	  xedbe = '" . $acadyear . "'";
	 if(mysql_query($_sql)) $_flag = 1;
	 else $_flag = 0;
	 //echo $_sql;
	}
?>

<div id="content">

<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_discipline/index"><img src="../images/discipline.png" alt="" width="48" height="48" border="0"/></a></td>
      <td ><strong><font color="#990000" size="4">งานวินัยนักเรียน</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>1.7 ตัดคะแนนความประพฤติ</strong></font></span></td>
      <td align="right">
		<form method="post" autocomplete="off"> 
			ปีการศึกษา <?=$acadyear?> ภาคเรียนที่ <?=$acadsemester?> <br/>
			<font color="#000000" size="2"  > 
			เลขประจำตัวนักเรียน
			<input type="text" name="studentid" maxlength="5" value="<?=isset($_POST['studentid'])?$_POST['studentid']:""?>" size="5" class="inputboxUpdate" onKeyPress="return isNumberKey(event)"/>
			<input type="submit" name="action" value="เรียกดู" class="button" />
			</font>
		</form>
	  </td>
    </tr>
  </table>

<? if(isset($_POST['action']) && $_POST['studentid'] == ""){ ?>
	<center><br/><font color="#FF0000">กรุณาป้อน เลขประจำตัวนักเรียนก่อน !</font></center>
<? } ?>


<? if(isset($_POST['action']) && $_POST['studentid'] != ""){ ?>
	<? $sql = "select id,prefix,firstname,lastname,nickname,xlevel,xyearth,room,sex,f_name,m_name,a_name,a_mobile,studstatus,points from students where id = '" . $_POST['studentid'] . "' and xedbe = '" . $acadyear . "'" ; ?>
	<? $result = mysql_query($sql);?>
	<? if($result && mysql_num_rows($result) > 0) { ?>
    	 <? $_dat = mysql_fetch_assoc($result); ?>
		 <form name="myform"  method="post" autocomplete="off">
		  <table width="100%" align="center" cellspacing="1" class="admintable" border="0" cellpadding="0">
			<tr>
				<td colspan="2" class="key">ข้อมูลนักเรียนและรายการหักคะแนนความประพฤตินักเรียน </td>
                <td rowspan="7" align="right"><img src="../images/studphoto/id<?=$_POST['studentid']?>.jpg" width="140px" height="200px" alt="รูปนักเรียน" align="top" style="border:solid 1px #003399"/></td>
			</tr>
			<tr>
				<td width="200px" align="right">เลขประจำตัว :</td>
				<td width="280px"><?=$_dat['id']?></td>
			</tr>
            <tr>
            	<td align="right">ชื่อ - สกุล :</td>
                <td><?=$_dat['prefix'].$_dat['firstname'].' '. $_dat['lastname']?></td>
            </tr>
			<tr>
				<td align="right">ระดับชั้นมัธยมศึกษาปีที่ :</td>
                <td><?=displayRoomTable($_dat['xlevel'],$_dat['xyearth']).'/'.$_dat['room']?></td>
			</tr>
            <tr>
            	<td align="right">คะแนนความประพฤติปัจจุบัน :</td>
                <td><?=displayPoint($_dat['points'])?></td>
            </tr>
            <tr>
            	<td align="right">สถานภาพปัจจุบัน :</td>
                <td><?=displayStudentStatusColor($_dat['studstatus'])?></td>
            </tr>
                    <? if($_flag==1){ ?>
                    		<tr>
                            	<td></td>
                                <td colspan="2">
                                	<b>รายละเอียดผลการดำเนินการ</b><br/>
                                    คะแนนเดิม <?=displayPoint($_POST['oldPoints'])?> คะแนน <br/>
                                    หักคะแนนความประพฤติ <?=displayPoint($_POST['deduct'])?> คะแนน <br/>
                                    คงเหลือ <?=displayPoint($_dat['points'])?> คะแนน
                                </td>
                            </tr>
                    <? } else if ($_flag==0) { ?>
                    		<tr>
                            	<td></td>
                                <td colspan="2">
                                	<font color="#cc0000">
                                    	เกิดข้อผิดพลาดระหว่างประมวลผลเนื่องจาก : <?=mysql_error();?>
                                    </font>
                                </td>
                            </tr>
                    <? } ?>            
            <tr>
            	<td align="right">คะแนนพฤติกรรมที่หัก :</td>
                <td>
                	<input type="text" id="deduct" name="deduct" size="5" maxlength="2" class="noborder" onKeyPress="return isNumberKey(event)" style="color:#cc0000 !important;font-size::14px !important;font-weight:bold !important;" />
                    <input type="hidden" name="studentid" value="<?=$_dat['id']?>" />
                    <input type="hidden" name="oldPoints" value="<?=$_dat['points']?>" />
                    <input type="hidden" name="action" />
                </td>
            </tr>
            <tr>
            	<td></td>
                <td>
                	<br/>
                    <input type="button" name="save" value="บันทึก" class="button" onclick="checkDeduct()" />
                    <input type="reset" value="ยกเลิก" class="button" />
                </td>
            </tr>
		</table>
        </form>
	<?	} //end if - check_data
		else { ?>
				<center><br/><font color="red">ผิดพลาด ไม่พบข้อมูลที่ค้นหา กรุณาตรวจสอบเลขประจำตัวนักเรียนอีกครั้ง</font></center>
	<?	} //end-else?>	
<?	} // end_submit_search?>


</div>

