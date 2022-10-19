<?
	$_textError = "";
	$_textError2 = "";
	$_textError3 = "";
	$_uploadError = 0;
	$_insertComplete = 0;
	if(isset($_POST['save']) && $_FILES["file"]["name"] != "")
	{
		$_file = explode(".",$_FILES["file"]["name"]);
		if ($_file[1] == "txt")
		{
			if ($_FILES["file"]["error"] > 0) { $_uploadError = 1; /*error ที่การ upload*/ }
			else
			{
				$_f = fopen($_FILES["file"]["tmp_name"], "r");//ชื่อไฟล์ และ โหมด r เพื่ออ่านข้อมูลจากไฟล์อย่างเดียว 
				$_i = 0;
				$_countError1 = 1;
				$_countError2 = 1;
				$_countError3 = 1;
				while(($_data = fgetcsv( $_f , 1024 , "\t")) !== false)	{
					if ($_i == 0) $_i++; //เพื่อไม่ให้อ่านหัวแถว ลงฐานข้อมูล  
					else
					{
						//no[0] id[1] personal_id[2] prefix[3] firstname[4] lastname[5] nickname[6] acadyear[7] level[8] room[9] start_date[10] expire_date[11]
						if(trim($_data[1])!="" && trim($_data[2])!="" && trim($_data[3])!="" && trim($_data[4])!="" && trim($_data[5])!="" && 
						                          trim($_data[7])!="" && trim($_data[8])!="" && trim($_data[9])!=""){
							$_res = mysql_query("select * from students where xedbe = '" . trim($_data[6]) . "' and id = '" . trim($_data[1]) . "'");
							if(mysql_num_rows($_res)>0)
							{
								$_uploadError = 5;
								$_textError2 .= "<tr>";
								$_textError2 .= "<td align='center'>" . $_countError2++ . "</td>";
								$_textError2 .= "<td align='center'>" . $_data[0] . "</td>";
								$_textError2 .= "<td align='center'>" . $_data[1] . "</td>";
								$_textError2 .= "<td>" . $_data[2] . "</td>";
								$_textError2 .= "<td>" . $_data[3] . "</td>";
								$_textError2 .= "<td>" . $_data[4] . "</td>";
								$_textError2 .= "<td>" . $_data[6] . "</td>";
								$_textError2 .= "<td>" . $_data[7] . "</td>";
								$_textError2 .= "<td>" . $_data[8] . "</td>";
								$_textError2 .= "<td>" . $_data[9] . "</td></tr>";
								mysql_free_result($_res);
							}
							else
							{
								$_data[8] = (int) trim($_data[8]);
								$_xlevel = ($_data[8]>3?4:3);
								$_xyearth = ($_data[8]>3?$_data[8]-3:$_data[8]);
								//no[0] id[1] personal_id[2] prefix[3] firstname[4] lastname[5] nickname[6] acadyear[7] level[8] room[9] start_date[10] expire_date[11]
								
								$_sqlInsert = "insert into students 
												(ID,pin,PREFIX,FIRSTNAME,LASTNAME,xLevel,xYearth,xEDBE,NICKNAME,SEX,ROOM,ENT_YEAR,studstatus,Start_Date,Expire_Date,StudJudge,Points)
												values 
												(
													'" . trim($_data[1]) . "',
													'" . trim(str_replace("-","",$_data[2])) . "',
													'" . trim($_data[3]) . "',
													'" . trim($_data[4]) . "',
													'" . trim($_data[5]) . "',
													'" . $_xlevel . "',
													'" . $_xyearth . "',
													'" . trim($_data[7]) . "',
													'" . trim($_data[6]) . "',
													'" . getSex(trim($_data[3])) . "',
													'" . trim($_data[9]) . "',
													'" . trim($_data[10]) . "',
													'1',
													'" . trim($_data[10]) . "',
													'" . trim($_data[11]) . "',
													'1','100' )";
								if(mysql_query($_sqlInsert)) { $_insertComplete++; }
								else {
									$_textError3 .= "<tr>";
									$_textError3 .= "<td align='center'>" . $_countError3++ . "</td>";
									$_textError3 .= "<td align='center'>" . $_data[0] . "</td>";
									$_textError3 .= "<td align='center'>" . $_data[1] . "</td>";
									$_textError3 .= "<td>" . $_data[2] . "</td>";
									$_textError3 .= "<td>" . $_data[3] . "</td>";
									$_textError3 .= "<td>" . $_data[4] . "</td>";
									$_textError3 .= "<td>" . mysql_error() . "</td>";
								}/// insert Error 
								//echo $_sqlInsert . "<br/>";
							}///ตรวจสอบข้อมูลซ้ำ
						}///ตรวจสอบค่าว่างของข้อมูล
						else
						{ 
							$_uploadError = 4; 
							$_textError .= "<tr>";
							$_textError .= "<td align='center'>" . $_countError1++ . "</td>";
							$_textError .= "<td align='center'>" . $_data[0] . "</td>";
							$_textError .= "<td align='center'>" . (trim($_data[1])!=""?$_data[1]:"<font color='red'>**</font>") . "</td>";
							$_textError .= "<td>" . (trim($_data[2])!=""?$_data[2]:"<font color='red'>**</font>") . "</td>";
							$_textError .= "<td>" . (trim($_data[3])!=""?$_data[3]:"<font color='red'>**</font>") . "</td>";
							$_textError .= "<td>" . (trim($_data[4])!=""?$_data[4]:"<font color='red'>**</font>") . "</td>";
							$_textError .= "<td>" . (trim($_data[6])!=""?$_data[6]:"<font color='red'>**</font>") . "</td>";
							$_textError .= "<td>" . (trim($_data[7])!=""?$_data[7]:"<font color='red'>**</font>") . "</td>";
							$_textError .= "<td>" . (trim($_data[8])!=""?$_data[8]:"<font color='red'>**</font>") . "</td>";
							$_textError .= "<td>" . (trim($_data[9])!=""?$_data[9]:"<font color='red'>**</font>") . "</td></tr>";
						}
					}//end else ตรวจสอบข้อมูลที่ไม่ใช่บรรทัดแรกที่เป็นชื่อคอลัมน์
				}//end while
				fclose($_f);
				unlink($_FILES['file']['tmp_name']);
			}//end else เช็คไฟล์ที่ถูกต้องตามรูปแบบที่มีนามสกุล (.csv)
		}else{ $_uploadError = 2; unlink($_FILES['file']['tmp_name']); /*error ที่เลือกไฟล์ไม่ถูกต้อง*/ }
	}else { $_uploadError = 3; /*error ไม่ได้เลือกไฟล์แล้วกด upload*/ }

?>

<div id="content">
<table width="100%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
    <tr> 
      <td align="center" width="6%">
      <a href="index.php?option=module_history/index"><img src="../images/users.png" alt="" width="48" height="48" border="0" /></a></td>
      <td><strong><font color="#990000" size="4">สืบค้นประวัติ</font></strong><br />
        <span class="normal"><font color="#0066FF"><strong>3.7 โปรแกรมนำเข้าข้อมูลนักเรียน</strong></font></span></td>
      <td></td>
    </tr>
</table>

	<form method="post" enctype="multipart/form-data">
	<table class="admintable" width="100%">
		<tr>
			<td colspan="2" class="key"> &nbsp; ส่วนนำเข้าข้อมูลนักเรียน</td>
		</tr>
		<tr>
			<td align="right" width="200px"><b>เลือกไฟล์ :</b></td>
			<td>
				<input type="file" name="file" size="40" />
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" value="นำเข้า" name="save" class="button" /> 
				<input type="button" value="ยกเลิก" class="button" onclick="location.href='index.php?option=module_history/index'" />
				<br/><br/>
			</td>
		</tr>
		<? if(isset($_POST['save']) && $_uploadError != 0 ){?>
		<tr>
			<td align="right" valign="top"><b>ผลการดำเนินการ :</b></td>
			<td>
				<?php
					$_html = "	<table>
									<tr align='center'>
										<td class='key'>ที่</td>
										<td class='key'>แถวที่</td>
										<td class='key'>เลขประจำตัว</td>
										<td class='key'>คำนำหน้า</td>
										<td class='key'>ชื่อ</td>
										<td class='key'>นามสกุล</td>
										<td class='key'>ปีการศึกษา</td>
										<td class='key'>ชั้น</td>
										<td class='key'>ห้อง</td>
									</tr>";
					
					if($_insertComplete>0)
					{
						echo "<font color='green'><b>ระบบได้ทำการนำเข้าข้อมูลนักเรียนจำนวนทั้งหมด " . $_insertComplete . " รายการ</b></font><br/><br/>";
					}
					if($_textError3 != "")
					{
						echo "<font color='red'><b>ข้อมูลที่ผิดพลาดเนื่องมาจากมีไม่สามารถบันทึกลงฐานข้อมูลได้</b></font>";
						echo "	<table>
									<tr align='center'>
										<td class='key'>ที่</td>
										<td class='key'>แถวที่</td>
										<td class='key'>เลขประจำตัว</td>
										<td class='key'>คำนำหน้า</td>
										<td class='key'>ชื่อ</td>
										<td class='key'>นามสกุล</td>
										<td class='key'>สาเหตุ</td>
									</tr>" . $_textError3 . "</table><br/>";
					}
					if($_uploadError == 4) { echo "<font color='red'><b>ข้อมูลที่ผิดพลาดเนื่องมาจากมีข้อมูลสำคัญไม่ครบถ้วน</b></font>" . $_html . $_textError . "</table>"; }
					if($_uploadError == 5) 
					{ 
						echo "<font color='red'><b>ข้อมูลที่ผิดพลาดเนื่องมาจากมีข้อมูลสำคัญไม่ครบถ้วน</b></font>" . $_html . $_textError . "</table><br/>"; 
						echo "<font color='red'><b>ข้อมูลที่ผิดพลาดเนื่องมาจากมีข้อมูลสำซ้ำกับฐานข้อมูลทะเบียนประวัติ</b></font>" . $_html . $_textError2 . "</table>"; 
					}
					switch ($_uploadError)
					{
						case 1: echo "<font color='red'>การเชื่อมต่อเครือข่ายผิดพลาด กรุณาตรวจสอบอีกครั้ง</font>"; break;
						case 2: echo "<font color='red'>รูปแบบหรือนามสกุลไฟล์ที่อัพโหลดไม่ถูกต้อง</font>"; break;
						case 3: echo "<font color='red'>กรุณาเลือกไฟล์นำเข้าข้อมูลนักเรียนก่อน</font>"; break;
					}
				?>
			</td>
		</tr>
		<? } ?>
	</table>
	</form>
	
	<br/><br/>
	<table class="admintable" width="100%">
		<tr>
			<td class="key" colspan="2"> &nbsp; ข้อแนะนำการใช้งานโปรแกรมนำเข้าข้อมูลนักเรียน</td>
		</tr>
		<tr>
			<td width="50px"></td>
			<td>
				<b>จัดเตรียมไฟล์ Microsoft Excel ที่พิมพ์ข้อมูลนักเรียนให้พร้อมใช้งาน ซึ่งมีข้อกำหนดดังนี้</b>
				<ol>
					<li>ในบรรทัดแรกเซลล์ A1 - K1 ในโปรแกรมให้พิมพ์ชื่อคอลัมน์เรียงลำดับให้ถูกต้องตามตัวอย่าง</li>
					<li>ตั้งแต่บรรทัดที่ 2 ให้พิมพ์ข้อมูลนักเรียนให้ถูกต้องตามตามคอลัมน์ที่กำหนด และควรพิมพ์ข้อความให้ครบทุกคอลัมน์</li>
					<li>เมื่อทำการพิมพ์ข้อมูลนักเรียนครบถ้วนแล้ว ให้ทำการตรวจสอบความถูกต้องของข้อมูลด้วย</li>
					<li>จากนั้นให้ทำการบันทึกแฟ้มเอกสารเป็น (Save as) รูปแบบเอกสาร Text (Tab Delimited) (นามสกุล .txt)</li>
					<li>เมื่อได้ไฟล์ข้อมูลที่มีนามสกุล ____.txt เรียบร้อยแล้ว ให้ทำการเปิดไฟล์ข้อมูลแล้วทำการเลือกที่ File -> Save As...</li>
					<li>จากนั้นเลือกที่ช่อง Encodeing เลือกเป็นแบบ UTF-8 แล้วกด Save เมื่อเสร็จสิ้นขั้นตอนนี้ก็จะสามารถทำการนำข้อมูลเข้าสู่ระบบได้</li>
				</ol>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<b><br/>ตัวอย่างข้อมูลที่ป้อนในโปรแกรม Microsoft Excel</b>							
				<table>
					<tr align="center">
						<td width="20px"></td>
						<td class="key">A</td>
						<td class="key">B</td>
						<td class="key">C</td>
						<td class="key">D</td>
						<td class="key">E</td>
						<td class="key">F</td>
						<td class="key">G</td>
						<td class="key">H</td>
						<td class="key">I</td>
						<td class="key">J</td>
						<td class="key">K</td>
                        <td class="key">L</td>
					</tr>
					<tr>
						<td class="key" align="center">1</td>
						<td>NO</td>
						<td>ID</td>
                        <td>Personal_ID</td>
						<td>Prefix</td>
						<td>Firstname</td>
						<td>Lastname</td>
						<td>Nickname</td>
						<td>Acadyear</td>
						<td>Level</td>
						<td>Room</td>
						<td>Start_Date</td>
						<td>Expire_Date</td>
					</tr>
					<tr>
						<td class="key" align="center">2</td>
						<td>1</td>
						<td>02354</td>
                        <td>1-2222-33333-44-5</td>
						<td>เด็กชาย</td>
						<td>ณรงค์ศักดิ์</td>
						<td>ผ่องสี</td>
						<td>ตี๋</td>
						<td>2553</td>
						<td>1</td>
						<td>1</td>
						<td>16/05/2553</td>
						<td>31/03/2555</td>
					</tr>
					<tr>
						<td class="key" align="center">3</td>
						<td>2</td>
						<td>02360</td>
                        <td>1-2222-33333-44-5</td>
						<td>เด็กหญิง</td>
						<td>สุกัญญา</td>
						<td>ใหญ่สูงเนิน</td>
						<td>เจน</td>
						<td>2553</td>
						<td>1</td>
						<td>3</td>
						<td>16/05/2553</td>
						<td>31/03/2555</td>
					</tr>
					<tr>
						<td class="key" align="center">4</td>
						<td>3</td>
						<td>02363</td>
                        <td>1-2222-33333-44-5</td>
						<td>นาย</td>
						<td>สุรสิทธิ์</td>
						<td>ท้าวกอก</td>
						<td>บี้</td>
						<td>2553</td>
						<td>4</td>
						<td>1</td>
						<td>16/05/2553</td>
						<td>31/03/2555</td>
					</tr>
					<tr>
						<td class="key" align="center">5</td>
						<td>4</td>
						<td>02374</td>
                        <td>1-2222-33333-44-5</td>
						<td>นางสาว</td>
						<td>วรรณภา</td>
						<td>คำจุมพล</td>
						<td>ติ๊ก</td>
						<td>2553</td>
						<td>4</td>
						<td>2</td>
						<td>16/05/2553</td>
						<td>31/03/2555</td>
					</tr>
					<tr>
						<td class="key" align="center">6</td>
					</tr>
					<tr>
						<td class="key" align="center">7</td>
					</tr>
					<tr>
						<td class="key" align="center">8</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<b><br/>หมายเหตุ</b>
				<ul>
					<li><b>NO</b> คือ ลำดับที่พิมพ์จะเริ่มนับจาก 1 ไปจนถึงคนสุดท้าย ไม่ใช่เลขที่ในห้องเรียน</li>
					<li><b>ID</b> คือ เลขประจำตัวนักเรียน ต้องพิมพ์ให้ครบ 5 หลัก</li>
                    <li><b>Personal_ID</b> คือ เลขบัตรประจำตัวประชาชนของนักเรียน
					<li><b>Prefix</b> คือ คำนำหน้าชื่อ ได้แก่ เด็กชาย,เด็กหญิง,นาย หรือ นางสาว</li>
					<li><b>Firstname</b> คือ ชื่อนักเรียน</li>
					<li><b>Lastname</b> คือ นามสกุลของนักเรียน</li>
					<li><b>Nickname</b> คือ ชื่อเล่นของนักเรียน หากไม่มีข้อมูลให้ว่างไว้ได้</li>
					<li><b>Acadyear</b> คือ ปีการศึกษาที่เข้าเรียน หรือ โดยมากจะเป็นปีการศึกษาปัจจุบันที่นำเข้าข้อมูลรายชื่อ</li>
					<li><b>Level</b> คือ ระดับชั้น จะมีค่าตั้งแต่ 1-6 เช่น ม.1 ให้พิมพ์ 1 หรือ ม.6 ให้พิมพ์ 6</li>
					<li><b>Room</b> คือ ห้องเรียนของนักเรียน เช่น ถ้าอยู่ ม.1/5 ให้พิมพ์ 5 </li>
					<li><b>Start_Date</b> คือ วันที่ออกบัตรนักเรียน หากไม่มีข้อมูลให้ว่างไว้ได้</li>
					<li><b>Expire_Date</b> คือ วันที่บัตรนักเรียนหมดอายุ หากไม่มีข้อมูลให้ว่างไว้ได้</li>
				</ul>
			</td>
		</tr>
	</table>

</div>
<?php
	function getSex($_prefix) { 
	if(trim($_prefix) == "เด็กชาย" || trim($_prefix) == "นาย") return "1"; 
	else return "2";
	}
?>  