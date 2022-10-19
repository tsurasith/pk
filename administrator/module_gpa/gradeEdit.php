<?
	if(isset($_POST['regrade'])) {
			$_sqlUpdate = " update grades 
							set	regrade 		= '" . trim($_POST['regrade']) . "',
								update_user 	= '" . $_SESSION['name'] . "',
								update_datetime = '" . getCurrentDateTime() . "' 
							where student_id 	= '" . $_POST['student_id'] . "'  and 
								  acadyear 		= '" . $_POST['acadyear'] . "'  and 
								  acadsemester 	= '" . $_POST['acadsemester'] . "'  and 
								  psubjectcode 	= '" . $_POST['subject_id'] . "'";
			mysql_query($_sqlUpdate);
			
			//echo $_sqlUpdate;
			
			if($_FILES["file"]["name"] != "") {
						
						$_target = $_SERVER["DOCUMENT_ROOT"] . "/bn/grades/";
						$_fileName = $_POST['acadyear'] . $_POST['acadsemester'] . $_POST['student_id'] . $_POST['groupsara'] . substr(trim($_POST['subject_id']),-5);
						$_uploadError = 0;
						
						echo $_fileName;
				
						if ((($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png")))
						{
							if ($_FILES["file"]["error"] > 0)
							{ $_uploadError = 1; /* error ที่การ upload */ }
							else if ($_FILES["file"]["size"] > 1000000)
							{ $_uploadError = 3; /* error ที่ขนาดไฟล์ใหญ่กว่าที่กำหนด 1MB */ }
							else
							{
								@unlink($_target . $_fileName . ".jpg");
								move_uploaded_file($_FILES["file"]["tmp_name"], $_target . $_FILES["file"]["name"]);
								if($_FILES["file"]["name"] != ( $_fileName . ".jpg"))
								{
									rename($_target . $_FILES["file"]["name"] , $_target.$_fileName . ".jpg");
									$_uploadError = 4; // upload Complete	
								}
							}
						}
						else 
						{ 
							// $_uploadError = 2; // error ที่เลือกไฟล์ไม่ถูกต้อง }
						}
			} // check submit file
	}
?>

<div id="content">
<script language="javascript" type="text/javascript">
	function checkGradeInput(){
		var value = document.getElementById("regrade").value.trim();
		var text  = "\n\n โดย ข้อมูลผลการเรียนที่สามารถป้อนได้ คือ มส., มผ., ร, 0 และผลการเรียนเป็นตัวเลขไม่เกิน 4.0 \n\n ";
		if(value == "")
		{
			alert("กรุณาป้อนข้อมูล ผลการเรียน ที่ต้องการแก้ไขก่อน");
			document.getElementById("regrade").focus();
		}
		else
		{
			if((Number(value) <= 4 && Number(value) >= 0))
			{
				//alert('xx');
				document.frmRegrade.submit();
			}
			else if(value == "มส" || value == "ร" || value == "มผ")
			{
				//alert('yy');
				document.frmRegrade.submit();
			}
			else{
				alert("กรุณาป้อนข้อมูล ผลการเรียน ที่ถูกต้องตามรูปแบบ" + text);
				document.getElementById("regrade").focus();
			}
		}
	}
	
	function checkFile(e) {

		var file_list = e.target.files;
	
		for (var i = 0, file; file = file_list[i]; i++) {
			var sFileName = file.name;
			var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
			var iFileSize = file.size;
			var iConvert = (file.size / 1048576).toFixed(2);
	
			if (!(sFileExtension === "jpg") || iFileSize > 1048576) {
				txt = "พบข้อผิดพลาดในการเลือกไฟล์ \n\n";
				txt += " - ประเภทไฟล์ : " + sFileExtension + "\n";
				txt += " - ขนาด: " + iConvert + " MB \n";
				txt += "โปรดตรวจสอบไฟล์อีกครั้งว่ามีประเภทไฟล์ (นามสกุล เป็น .jpg) และขนาดไม่เกิน 1 MB หรือไม่ \n\n";
				alert(txt);
				document.getElementById('confirm').value = "";
			}
		}
	}
</script>
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td width="6%" align="center"><a href="index.php?option=module_gpa/index"><img src="../images/gpa.png" alt="" width="48" height="48" border="0" /></a></td>
      <td ><strong><font color="#990000" size="4">Learning Achievement</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.1 แก้ไขผลการเรียนนักเรียน</strong></font></span></td>
      <td align="right">
      		<font size="2" color="#000000">
            <form method="post" action="">
                <table class="admintable">
                    <tr>
                        <th align="right">ภาคเรียน/ปีการศึกษา :</th>
                        <td>
                            <? $_result = mysql_query("select distinct concat(acadsemester,'/',acadyear) as display 
                                                from grades order by acadyear,acadsemester"); ?>
                            <select name="term" class="inputboxUpdate">
                                <option value=""></option>
                                <? while($_term = mysql_fetch_assoc($_result)){ ?>
                                        <option value="<?=$_term['display']?>" <?=$_term['display']==$_POST['term']?"selected":""?>><?=$_term['display']?> &nbsp;  &nbsp; &nbsp; </option>
                                <? } ?>
                            </select>
                            <input type="submit" name="search" value="เรียกดู" class="button" />
                        </td>
                    </tr>
                    <tr>
                        <th align="right">เลขประจำตัวนักเรียน :</th>
                        <td><input type="text" name="student_id" value="<?=$_POST['student_id']?>" maxlength="5" size="10" onkeypress="return isNumberKey(event)" class="inputboxUpdate" /></td>
                    </tr>
                    <tr>
                        <th align="right">รหัสวิชา :</th>
                        <td>
                            <input type="text" name="subject_id" value="<?=$_POST['subject_id']?>" maxlength="10" size="10"  class="inputboxUpdate" />
                        </td>
                    </tr>
                </table>
            </form>
            </font>
      </td>
    </tr>
  </table>
<br/>



	<? if(isset($_POST['search']) && !($_POST['term'] == "" || $_POST['student_id'] == "" || $_POST['subject_id'] == "")){ ?>
    <?
					$_dd = explode("/",$_POST['term']);
					$Qacadyear =   $_dd[1];
					$Qacadsemester = $_dd[0];
			
					$_sqlGrade = "select grades.psubjectcode,p100,grade,regrade,update_user,update_datetime,psubjectname,groupsara  from grades  
								left outer join subjects 
								on (grades.psubjectcode = subjects.psubjectcode and grades.acadyear = subjects.acadyear)
								where grades.acadyear 		= 	 '" . $Qacadyear . "' and 
									  grades.acadsemester 	= '" . $Qacadsemester . "' and 
									  student_id 			=	 '" . trim($_POST['student_id']) . "' and
									  grades.psubjectcode 	= '" . trim($_POST['subject_id']) . "'";
			
					$_sqlStudent = "select id,prefix,firstname,lastname,xlevel,xyearth,room from students
								  where 	id 		= '" . $_POST['student_id'] . "' and
											xedbe 	= '" . $acadyear . "'";
					
					//echo $_sqlGrade;						
											
					@$_resGrade = mysql_query($_sqlGrade);
					@$_resStudent = mysql_query($_sqlStudent);
		
		?>
            <? if(mysql_num_rows($_resGrade)>0){ ?>
                    <div align="center">                
                    <? $_datG = mysql_fetch_assoc($_resGrade); ?>
                    <? $_datS = mysql_fetch_assoc($_resStudent); ?>
                    <form name="frmRegrade" method="post" enctype="multipart/form-data">
                        <table width="">
                        	<tr>
                            	<td colspan="2">ข้อมูลนักเรียน</td>
                            </tr>
                            <tr>
                            	<td align="right">เลขประจำตัว :</td>
                                <td><?=$_datS['id']?></td>
                            </tr>
                            <tr>
                            	<td align="right">ชื่อ-สกุล :</td>
                                <td><?=$_datS['prefix'].$_datS['firstname'] . ' ' . $_datS['lastname']?></td>
                            </tr>
                            <tr>
                            	<td align="right">ระดับชั้น :</td>
                                <td><?=$_datS['xlevel']==3?$_datS['xyearth']:($_datS['xyearth']+3)?>/<?=$_datS['room']?></td>
                            </tr>
                            <tr>
                            	<td colspan="2">ผลการเรียน</td>
                            </tr>
                            <tr>
                            	<td align="right">รายวิชา :</td>
                                <td><?=$_datG['psubjectcode'] . ' ' . $_datG['psubjectname']?></td>
                            </tr>
                            <tr>
                            	<td align="right">คะแนน :</td>
                                <td><?=$_datG['p100']?></td>
                            </tr>
                            <tr>
                            	<td align="right">ผลการเรียนเดิม :</td>
                                <td><b><?=displayGrade($_datG['grade'])?></b></td>
                            </tr>
                            <tr>
                            	<td align="right">ผลการเรียนที่แก้ไข :</td>
                                <td><b><?=displayGrade($_datG['regrade'])?></b></td>
                            </tr>
                            <tr>
                            	<td align="right">เอกสารแนบ :</td>
                                <td>
                                		<? $_fileAttached = $_SERVER["DOCUMENT_ROOT"] . "/bn/grades/"; ?>
										<? $_fileAttached .= $Qacadyear . $Qacadsemester . $_POST['student_id'] . $_datG['groupsara'] . substr(trim($_POST['subject_id']),-5) . ".jpg"; ?>
										<? if(file_exists($_fileAttached)){?>
                                                <a target="_blank" href="module_gpa/displayFileAttached.php?id=<?=substr($_fileAttached,-20);?>">
                                                    <b>หลักฐานการแก้ไข</b>
                                                </a> (คลิกเพื่อแสดงรายละเอียด)
                                                
                                        <? } else { echo "ไม่มีเอกสารแนบ ";} ?>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>แก้ไขผลการเรียนเป็น :</td>
                                <td>
                                	<input type="text" id="regrade" name="regrade" maxlength="3" size="4" class="inputboxUpdate" />
                                    <input type="button" name="save" value="บันทึก" class="button" onclick="checkGradeInput();" />
                                    <input type="hidden" name="student_id" value="<?=$_POST['student_id']?>" />
                                    <input type="hidden" name="subject_id" value="<?=$_POST['subject_id']?>" />
                                    <input type="hidden" name="groupsara" value="<?=$_datG['groupsara']?>" />
                                    <input type="hidden" name="acadyear" value="<?=$Qacadyear?>" />
                                    <input type="hidden" name="acadsemester" value="<?=$Qacadsemester?>" />
                                    <input type="hidden" name="term" value="<?=$_POST['term']?>" />
                                    <input type="hidden" name="search" />
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right" valign="top">เอกสารแนบ :</td>
                                <td>
                                    <input type="file" name="file" id="confirm" size="60px" onchange="checkFile(event);"/><br/>
                                    ไฟล์เกียรติบัตรที่แนบต้องมีรูปแบบไฟล์เป็น .jpg และขนาดไม่ควรเกิน 1 MB<br/>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td align="right">แก้ไขโดย :</td>
                                <td><?=$_datG['update_user']?></td>
                            </tr>
                            <tr>
                            	<td align="right">เวลาที่แก้ไข :</td>
                                <td><?=$_datG['update_datetime']?></td>
                            </tr>
                        </table>
                    </form>
                    </div>
            <? } else { ?>
                    <div align="center">
                        <br/><font color="red">ไม่พบข้อมูลที่ค้นหาตามเงื่อนไข กรุณาลองใหม่อีกครั้งค่ะ</font>
                    </div>            		
            <? } //end check search grade ?>
	<? } else if(isset($_POST['search'])) { ?>
    		<div align="center">
        		<br/><font color="red">กรุณาป้อนข้อมูลให้ครบถ้วนก่อนค่ะ</font>
    		</div>  
    <? } //end else ?>
</div>

