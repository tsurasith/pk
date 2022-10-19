<?

	function getCurrentDateTime()
	{
		date_default_timezone_set('Asia/Bangkok');
		$date = date('d/m/Y h:i:s', time());
		return $date;
	}
	
	function getFullRoomFormat($_value) // input = 301,611 output = 3/1,6/1
	{
		return substr($_value,0,1). "/" . (int)substr($_value,-2);
	}
	
	function getRoom($_value) // input 301,615 output = 1,15
	{
		return (int) substr($_value,-2);
	}
	function getXyearth($_room) //input = 101,601 output = 1,3
	{
		$_xRoom = (int) substr($_room,0,1);
		if($_xRoom > 3) { return $_xRoom-3; }
		else { return $_xRoom; }
	}
	
	function displayRoomTable($_x , $_y) // input $xlevel,$xyearth
	{
		if($_x==3) return $_y;
		if($_x==4) return $_y+3;
		else { return "";}
	}
	
	function getXlevel($_room) // input = 101,601 output = 3,4
	{
		$_xRoom = (int) substr($_room,0,1);
		if($_xRoom > 3) { return 4; }
		else { return 3; }
	}
	
	
	function displayXyear($_value)
	{
		switch ($_value){
			case "3/1": return "1" ; break;
			case "3/2": return "2" ; break;
			case "3/3": return "3" ; break;
			case "4/1": return "4" ; break;
			case "4/2": return "5" ; break;
			case "4/3": return "6" ; break;
			default : return " ทั้งโรงเรียน ";
		}
	}
	
	
	function displayTimecheck($id) // input = 00,01 output = มา,ทำกิจกรรม
	{
		switch ($id) {
			case "00" :  return "มา"; break;
			case "01" :  return "กิจกรรม"; break;
			case "02" :  return "มาสาย"; break;
			case "03" :  return "ลา"; break;
			case "04" :  return "ขาด"; break;
			default :  return "ไม่ระบุ";
		}	
	}
	
	function displayTimecheckColor($id) {
		switch ($id) {
			case "00" :  return "มา"; break;
			case "01" :  return "<font color='#66CC33'><b>กิจกรรม</b></font>"; break;
			case "02" :  return "<font color='#FFCC00'><b>สาย</b></font>"; break;
			case "03" :  return "<font color='blue'><b>ลา</b></font>"; break;
			case "04" :  return "<font color='red'><b>ขาด</b></font>"; break;
			default : return "-";
		}	
	}
	
	function displayMonth($_value) // input = 1,2 output = มกราคม,กุมภาพันธ์
	{
		switch ($_value) {
			case 1 : return "มกราคม "  ;break;
			case 2 : return "กุมภาพันธ์" ;break;
			case 3 : return "มีนาคม "	;break;
			case 4 : return "เมษายน";break;
			case 5 : return "พฤษภาคม" ;break;
			case 6 : return "มิถุุนายน"  ;break;
			case 7 : return "กรกฎาคม" ;break;
			case 8 : return "สิงหาคม" ;break;
			case 9 : return "กันยายน"  ;break;
			case 10 : return "ตุลาคม"  ;break;
			case 11 : return "พฤศจิกายน" ;break;
			case 12 : return "ธันวาคม"  ;break;
			default : return "";
		}
	}
	
	function displayShortMonth($_value) {
		switch ($_value) {
			case 1 : return "ม.ค. "  ;break;
			case 2 : return "ก.พ." ;break;
			case 3 : return "มี.ค. "	;break;
			case 4 : return "เม.ย.";break;
			case 5 : return "พ.ค." ;break;
			case 6 : return "มิ.ย."  ;break;
			case 7 : return "ก.ค." ;break;
			case 8 : return "ส.ค." ;break;
			case 9 : return "ก.ย."  ;break;
			case 10 : return "ต.ค."  ;break;
			case 11 : return "พ.ย." ;break;
			case 12 : return "ธ.ค."  ;break;
			default : return "ผิดพลาด";
		}
	}
	
	function displayThaiDate($date) // input = 31/09/2556
	{
		$txt = "" ;
		$_x = explode('/',$date,3);
		switch ($_x[1]) {
			case "01" : $txt = $txt . number_format($_x[0],0,'.','') . "  มกราคม " . ($_x[2] + 0) ;break;
			case "02" : $txt = $txt . number_format($_x[0],0,'.','') . "  กุมภาพันธ์ " . ($_x[2] + 0) ;break;
			case "03" : $txt = $txt . number_format($_x[0],0,'.','') . "  มีนาคม " . ($_x[2] + 0) ;break;
			case "04" : $txt = $txt . number_format($_x[0],0,'.','') . "  เมษายน " . ($_x[2] + 0) ;break;
			case "05" : $txt = $txt . number_format($_x[0],0,'.','') . "  พฤษภาคม " . ($_x[2] + 0) ;break;
			case "06" : $txt = $txt . number_format($_x[0],0,'.','') . "  มิถุุนายน " . ($_x[2] + 0) ;break;
			case "07" : $txt = $txt . number_format($_x[0],0,'.','') . "  กรกฎาคม " . ($_x[2] + 0) ;break;
			case "08" : $txt = $txt . number_format($_x[0],0,'.','') . "  สิงหาคม " . ($_x[2] + 0) ;break;
			case "09" : $txt = $txt . number_format($_x[0],0,'.','') . "  กันยายน " . ($_x[2] + 0) ;break;
			case "10" : $txt = $txt . number_format($_x[0],0,'.','') . "  ตุลาคม " . ($_x[2] + 0) ;break;
			case "11" : $txt = $txt . number_format($_x[0],0,'.','') . "  พฤศจิกายน " . ($_x[2] + 0) ;break;
			case "12" : $txt = $txt . number_format($_x[0],0,'.','') . "  ธันวาคม  " . ($_x[2] + 0) ;break;
			default : $txt = $txt . "-";
		}
		return $txt ;
	}
	
	function displayDateChart($date)
	{
		$txt = "" ;
		$_x = explode('-',$date,3);
		switch ($_x[1]) {
			case "01" : $txt = $txt . number_format($_x[2],0,'.','') . " ม.ค. " . ($_x[0] + 543) ;break;
			case "02" : $txt = $txt . number_format($_x[2],0,'.','') . " ก.พ. " . ($_x[0] + 543) ;break;
			case "03" : $txt = $txt . number_format($_x[2],0,'.','') . " มี.ค. " . ($_x[0] + 543) ;break;
			case "04" : $txt = $txt . number_format($_x[2],0,'.','') . " เม.ษ. " . ($_x[0] + 543) ;break;
			case "05" : $txt = $txt . number_format($_x[2],0,'.','') . " พ.ค. " . ($_x[0] + 543) ;break;
			case "06" : $txt = $txt . number_format($_x[2],0,'.','') . " มิ.ย. " . ($_x[0] + 543) ;break;
			case "07" : $txt = $txt . number_format($_x[2],0,'.','') . " ก.ค. " . ($_x[0] + 543) ;break;
			case "08" : $txt = $txt . number_format($_x[2],0,'.','') . " ส.ค. " . ($_x[0] + 543) ;break;
			case "09" : $txt = $txt . number_format($_x[2],0,'.','') . " ก.ย. " . ($_x[0] + 543) ;break;
			case "10" : $txt = $txt . number_format($_x[2],0,'.','') . " ต.ค. " . ($_x[0] + 543) ;break;
			case "11" : $txt = $txt . number_format($_x[2],0,'.','') . " พ.ย. " . ($_x[0] + 543) ;break;
			case "12" : $txt = $txt . number_format($_x[2],0,'.','') . " ธ.ค. " . ($_x[0] + 543) ;break;
			default : $txt = $txt . "ผิดพลาด";
		}
		return $txt ;
	}

	function displayDate($date)
	{
		$txt = "" ;
		$_x = explode('-',$date,3);
		switch ($_x[1]) {
			case "01" : $txt = $txt . number_format($_x[2],0,'.','') . "  มกราคม   " . ($_x[0] + 543) ;break;
			case "02" : $txt = $txt . number_format($_x[2],0,'.','') . "  กุมภาพันธ์   " . ($_x[0] + 543) ;break;
			case "03" : $txt = $txt . number_format($_x[2],0,'.','') . "  มีนาคม   " . ($_x[0] + 543) ;break;
			case "04" : $txt = $txt . number_format($_x[2],0,'.','') . "  เมษายน   " . ($_x[0] + 543) ;break;
			case "05" : $txt = $txt . number_format($_x[2],0,'.','') . "  พฤษภาคม   " . ($_x[0] + 543) ;break;
			case "06" : $txt = $txt . number_format($_x[2],0,'.','') . "  มิถุุนายน   " . ($_x[0] + 543) ;break;
			case "07" : $txt = $txt . number_format($_x[2],0,'.','') . "  กรกฎาคม   " . ($_x[0] + 543) ;break;
			case "08" : $txt = $txt . number_format($_x[2],0,'.','') . "  สิงหาคม   " . ($_x[0] + 543) ;break;
			case "09" : $txt = $txt . number_format($_x[2],0,'.','') . "  กันยายน   " . ($_x[0] + 543) ;break;
			case "10" : $txt = $txt . number_format($_x[2],0,'.','') . "  ตุลาคม   " . ($_x[0] + 543) ;break;
			case "11" : $txt = $txt . number_format($_x[2],0,'.','') . "  พฤศจิกายน   " . ($_x[0] + 543) ;break;
			case "12" : $txt = $txt . number_format($_x[2],0,'.','') . "  ธันวาคม   " . ($_x[0] + 543) ;break;
			default : $txt = $txt . "ผิดพลาด";
		}
		return $txt ;
	}

	function displayFullDate($date)
	{
		$txt = "" ;

		$_x = explode('-',$date,3);
		switch ($_x[1]) {
			case "01" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน มกราคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "02" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน กุมภาพันธ์  พ.ศ. " . ($_x[0] + 543) ;break;
			case "03" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน มีนาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "04" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน เมษายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "05" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน พฤษภาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "06" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน มิถุุนายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "07" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน กรกฎาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "08" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน สิงหาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "09" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน กันยายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "10" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน ตุลาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			case "11" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน พฤศจิกายน  พ.ศ. " . ($_x[0] + 543) ;break;
			case "12" : $txt = $txt . number_format($_x[2],0,'.','') . " เดือน ธันวาคม  พ.ศ. " . ($_x[0] + 543) ;break;
			default : $txt = $txt . "ผิดพลาด";
		}
		
		return $txt ;
	}



	function displayStudentStatusColor($id)
	{
		switch ($id) {
			case 0 :  return "<font color='red'><b>ออก</b></font>"; break;
			case 1 :  return "ปกติ"; break;
			case 2 :  return "<b>สำเร็จการศึกษา</b>"; break;
			case 3 :  return "<font color='red'><b>แขวนลอย</b></font>"; break;
			case 4 :  return "<font color='darkorange'><b>พักการเรียน</b></font>"; break;
			case 5 :  return "<font color='blue'><b>ย้ายสถานศึกษา</b></font>"; break;
			case 9 :  return "<font color='red'><b>เสียชีวิต</b></font>"; break;
			default : return " - ไม่ทราบ - ";
		}	
	}
	
	function displayPoint($_value)  // ใช้สำหรับแสดงคะแนนพฤติกรรมนักเรียน
	{
		if($_value > 100)
		{
			return "<font color='black' size='4'>" . $_value . "</font><font color='red'>*</font>";
		}
		else if($_value == 100)
		{
			return "<font color='blue' size='4'>" . $_value . "</font>";
		}
		else if($_value >=80)
		{
			return "<font color='green' size='4'>" . $_value . "</font>";
		}else if ($_value >=60)
		{
			return "<font color='orange' size='4'>" . $_value . "</font>";
		}else
		{
			return "<font color='red' size='4'>" . $_value . "</font>";
		}
	}

//--- มาจากหน้า ประวัตินักเรียน
	function displayPIN($_value) {
		$_pin = "";
		if($_value != "")
		{
			$_pin .= substr($_value,0,1) . "-";
			$_pin .= substr($_value,1,4) . "-";
			$_pin .= substr($_value,5,5) . "-";
			$_pin .= substr($_value,10,2) . "-";
			$_pin .= substr($_value,12,1);
			return display($_pin);
		}else { return "-"; }
	}
	function displayBMI($_value) {
		if($_value >= 30) { return "<font color='red'><b>อ้วนเกินไป</b></font>"; }
		else if($_value >=25) { return "<font color='orange'><b>น้ำหนักเกิน</b></font>"; }
		else if ($_value >=18.5) { return "<font color='green'><b>ปกติ/สมส่วน</b></font>"; }
		else if ($_value < 18.5 && $_value > 0) { return "<font color='darkyellow'><b>ผอม</b></font>"; }
		else { return "<font>-</font>"; }
	}
	function displayNationality($_value) {
		switch ($_value) {
			case 0: return "ไม่ระบุ"; break;
			case 1: return "ไทย"; break;
			case 2: return "จีน"; break;
			case 3: return "พม่า"; break;
			default : return "ไม่ทราบ";
		}
	}
	function displayReligion($_value) {
		switch ($_value) {
			case 0: return "ไม่ระบุ"; break;
			case 1: return "พุทธ"; break;
			case 2: return "คริสต์"; break;
			case 3: return "อิสลาม"; break;
			case 4: return "ฮินดู"; break;
			case 5: return "พราหมณ์"; break;
			case 6: return "ซิกส์"; break;
			default : return "ไม่ทราบ";
		}
	}
	function displayOccupation($_id){
		if($_id != ""){
			$_dat = mysql_fetch_assoc(mysql_query("select occ_description from ref_occupation where occ_id = '" . $_id . "'"));
			return $_dat['occ_description'];
		} else { return "-";};
	}
	function displayFMStatus($_id){
		if($_id != ""){
			$_dat = mysql_fetch_assoc(mysql_query("select fmstatus_description from ref_fmstatus where fmstatus_id = '" . $_id . "'"));
			return $_dat['fmstatus_description'];
		} else { return "-";};
	}
	function displayRelation($_id){
		if($_id != ""){
			$_dat = mysql_fetch_assoc(mysql_query("select relation_description from ref_relation where relation_id = '" . $_id . "'"));
			return $_dat['relation_description'];
		} else { return "-";};
	}
	
	function displayAge($_value) {
		if($_value != "") {
			$_cDate = explode('/',date("d/m/Y"));
			$_bDate = explode('/',$_value);
			$_text = " ";
			if($_bDate[0] > $_cDate[0])
			{
				--$_cDate[1];
				$_text = $_text . (($_cDate[0]+30) - $_bDate[0]) . " วัน";
			}
			else { $_text = $_text . ($_cDate[0] - $_bDate[0]) . " วัน"; }
			if($_bDate[1] > $_cDate[1])
			{
				--$_cDate[2];
				$_text = (($_cDate[1] + 12) - $_bDate[1])  . " เดือน" . $_text;
			}
			else { $_text = ($_cDate[1] - $_bDate[1])  . " เดือน" . $_text; }
			$_text = ($_cDate[2]+543 - $_bDate[2]) . " ปี " . $_text ;
			return $_text;
		} else { return "-"; }
	}
	
	function getAdvisor($_level,$_year,$_room,$_acadyear,$_acadsemester) {
		$_roomID = (($_level == 4)?($_year+3):($_year)) . "0" . $_room;
		$_sqlAd = "select prefix,firstname, lastname from teachers left outer join rooms on teachers.teaccode = rooms.teacher_id
						where room_id = '" . $_roomID ."' and rooms.acadyear = '" . $_acadyear . "' and rooms.acadsemester = '" . $_acadsemester . "'";
		$_resAd = mysql_query($_sqlAd);
		$_datAd = mysql_fetch_assoc($_resAd);
		return "ครู" . $_datAd['firstname'] . " " . $_datAd['lastname'];
	}
	function getTeacher($_id){
		$_res = mysql_query("select prefix,firstname,lastname from teachers where teaccode = '" . $_id . "'");
		$_dat = mysql_fetch_assoc($_res);
		if(mysql_num_rows($_res) > 0) return "ครู" . $_dat['firstname'] . " " . $_dat['lastname'] ;
		else return "";
	}
	function getPoint($_point)
	{		
		if($_point >= 80) return  "<font color='green' size='4'>" . $_point . "</font>";
		else if($_point >= 60) return "<font color='orage' size='4'>" . $_point . "</font>";
		else return "<font color='red' size='4'>" . $_point . "</font>";
	}
	function displayTravel($_id) {
		switch($_id) {
			case '01' : return "เดิน"; break;
			case '02' : return "รถจักรยาน"; break;
			case '03' : return "รถจักรยานยนต์"; break;
			case '04' : return "รถประจำทาง"; break;
			case '05' : return "ผู้ปกครองมาส่ง"; break;
			case '06' : return "รถรับส่งนักเรียน";break;
			default : return "<font color='red'>ไม่ระบุ</font>";
		}
	}
	function displayCripple($_id)
	{
		switch($_id) {
			case 0 : return "ปกติ"; break;
			case 1 : return "พิการทางการมองเห็น"; break;
			case 2 : return "พิการทางการได้ยิน"; break;
			case 3 : return "พิการทางสติปัญญา"; break;
			case 4: return "พิการทางร่างกาย,สุขภาพ"; break;
			case 5 : return "มีปัญหาทางการเรียนรู้"; break;
			case 6 : return "พิการทางการพูด,ภาษา"; break;
			case 7 : return "มีปัญหาทางพฤติกรรมและการเรียนรู้"; break;
			case 8 : return "พิการทางออทิสติก"; break;
			case 9 : return "พิการซ้อน"; break;
			case 10: return "อื่นๆ";
			default : return "ไม่ระบุ";
		}
	}
	function displayStudjudge($_value)
	{
		switch($_value) {
			case 1 : return "นักเรียนต้นปีการศึกษา"; break;
			case 2 : return "ย้ายมาเรียนระหว่างปี"; break;
			case 3 : return "ย้ายมาเรียนระหว่างภาคเรียน"; break;
			case 4 : return "ออกกลางคัน"; break;
			case 5 : return "เสียชีวิต"; break;
			case 6 : return "นักเรียนในวันสิ้นปีการศึกษา"; break;
			default : return "ไม่ระบุ";
		}
	}
	function displayInservice($_value)
	{
		switch ($_value) {
			case 0: return "ไม่ระบุ"; break;
			case 1: return "พักอยู่กับผู้ปกครองนักเรียน"; break;
			case 2: return "พักในบ้านพักครู"; break;
			case 3: return "พักอยู่กับญาติ"; break;
			case 4: return "พักอยู่หอพักในโรงเรียน"; break;
			case 5: return "พักอยู่หอพักนอกโรงเรียน"; break;
			default : return "-";
		}
	}
	function displayStudAbsent($_value){
		switch($_value) {
			case 0 : return "ไม่ขาดแคลน"; break;
			case 1 : return "เครื่องแบบนักเรียนชาย"; break;
			case 2 : return "เครื่องแบบนักเรียนหญิง"; break;
			case 3 : return "เครื่องเขียน"; break;
			case 4 : return "แบบเรียน"; break;
			case 5 : return "อาหารกลางวัน"; break;
			default : return "ไม่ระบุ";
		}
	}

	function display($data) {
		if(!is_numeric($data)) {
			$data = trim($data);
			if($data == "" || $data == null) { return "<font color=\"blue\"><b>-</b></font>"; }
			else{ return "<font color=\"blue\"><b>" . $data . "</b></font>"; }
		}
		else {
			if($data == "" || $data == 0) { return "<font color=\"blue\"><b>-</b></font>"; }
			else if($data>0){ return "<font color=\"blue\"><b>".number_format($data,2,'.',',') ."</b></font>"; }
			else { return "<font color=\"blue\"><b>-</b></font>"; }
		}
	}

	function displayText($data)
	{
		if($data == "")
		{
			return "<font color=\"blue\"><b>-</b></font>";
		}
		else{
			return "<font color=\"blue\"><b>" . $data . "</b></font>";
		}
	}
	
	function displayRetirecause($_value){
		$_resRetire = mysql_query("SELECT * FROM ref_retire where retire_id = '" . $_value . "'");
		$_datRe = mysql_fetch_assoc($_resRetire);
		return $_datRe['retire_description'];
	}
	
//-----

	function displayDisciplineStatus($_value)
	{
		switch($_value){
			case 0 : return "คดีสอบสวนไม่มีมูล";break;
			case 1 : return "แจ้งพฤติกรรมไม่พึงประสงค์";break;
			case 2 : return "ดำเนินการสอบสวนแล้ว";break;
			case 3 : return "แจ้งบทลงโทษแล้ว";break;
			case 4 : return "อยู่ระหว่างการดำเนินการกำกับ/ติดตาม";break;
			case 5 : return "อยู่ในระหว่างการพิจารณาของหัวหน้าฝ่ายกิจการนักเรียน";break;
			case 6 : return "ดำเนินการเสร็จสิ้น/ปิดคดี";break;
			default : return "ไม่ระบุ";
		}
	}

	function displayPrefix($_value)
	{
		if($_value == "เด็กชาย")
		{
			return "ด.ช.";
		}
		else if ($_value == "เด็กหญิง")
		{
			return "ด.ญ.";
		}
		else if ($_value == "นางสาว")
			return "น.ส.";
		else
			return $_value;
	}
	
	
	function displayP100($_value)
	{
		if(trim($_value)=="")
		{
			return "-";
		}
		else if ((int)$_value < 1 )
		{
			return "-";
		}else { return number_format($_value,1,'.',','); }
	}
	
	function displayGrade($_value)
	{
		if(trim($_value)=="") { return "-"; }
		if(is_numeric(trim($_value))) 
		{ 
			if($_value > 0) { return number_format($_value,1,'.',','); }
			else return "<font color='red'>" . trim($_value) . "</font>";
		}else return "<font color='red'>" . trim($_value) . "</font>";
	}
	
		
	//*************SDQ function ************************//
	function displayAll($_value,$_q) {
		if($_q =="student")
		{
			if($_value >=0 && $_value < 17) return "<b>ปกติ</b>"; 
			if($_value == 17 || $_value == 18) return "<b><font color='orange'>เสี่ยง</font></b>";
			if($_value > 18) return "<b><font color='red'>มีปัญหา</font></b>";
			else return "<font color='blue'>ยังไม่ประเมิน</font>";
		}else
		{
			if($_value >=0 && $_value < 16) return "<b>ปกติ</b>"; 
			if($_value == 16 || $_value == 17) return "<b><font color='orange'>เสี่ยง</font></b>";
			if($_value > 17) return "<b><font color='red'>มีปัญหา</font></b>";
			else return "<font color='blue'>ยังไม่ประเมิน</font>";
		}
	}
	//---------------แปลผล sdq-------------------------------------//
	function displayType($_value){
		switch ($_value){
			case "type1": return "อารมณ์"; break;
			case "type2": return "ความประพฤติ/เกเร"; break;
			case "type3": return "อยู่ไม่นิ่ง/สมาธิสั้น"; break;
			case "type4": return "ความสัมพันธ์กับเพื่อน"; break;
			case "type5": return "สัมพันธภาพทางสังคม"; break;
			default : return "รวมทั้ง 5 ด้าน";
		}
	}
		
	function displayType1($_value,$_q){
		if($_q == 'student')
		{	if($_value >=0 && $_value < 6) return "ปกติ"; 
			if($_value == 6) return "<font color='orange'>เสี่ยง</font>";
			if($_value > 6) return "<font color='red'>มีปัญหา</font>";
			else return "-";
		}else
		{
			if($_value >=0 && $_value < 4) return "ปกติ"; 
			if($_value == 4) return "<font color='orange'>เสี่ยง</font>";
			if($_value > 4) return "<font color='red'>มีปัญหา</font>";
			else return "-";
		}
	}
	
	function displayType2($_value,$_q) {
		if($_q == 'student')
		{
			if($_value >=0 && $_value < 5) return "ปกติ"; 
			if($_value == 5) return "<font color='orange'>เสี่ยง</font>";
			if($_value > 5) return "<font color='red'>มีปัญหา</font>";
			else return "-";
		}else
		{
			if($_value >=0 && $_value < 4) return "ปกติ"; 
			if($_value == 4) return "<font color='orange'>เสี่ยง</font>";
			if($_value > 4) return "<font color='red'>มีปัญหา</font>";
			else return "-";
		}
	}
	
	function displayType3($_value,$_q) {
		if($_value >=0 && $_value < 6) return "ปกติ"; 
		if($_value == 6) return "<font color='orange'>เสี่ยง</font>";
		if($_value > 6) return "<font color='red'>มีปัญหา</font>";
		else return "-";
	}
	
	function displayType4($_value,$_q) {
		if($_q == 'student')
		{
			if($_value >=0 && $_value < 4) return "ปกติ"; 
			if($_value == 4) return "<font color='orange'>เสี่ยง</font>";
			if($_value > 4) return "<font color='red'>มีปัญหา</font>";
			else return "-";
		}else
		{
			if($_value >=0 && $_value < 6) return "ปกติ"; 
			if($_value == 6) return "<font color='orange'>เสี่ยง</font>";
			if($_value > 6) return "<font color='red'>มีปัญหา</font>";
			else return "-";
		}
	}
	
	function displayType5($_value,$_q) {
		if($_q == 'student')
		{
			if($_value >=0 && $_value <= 3) return "<font color='red'>มีปัญหา</font>"; 
			if($_value > 3) return "ปกติ";
			else return "-";
		}else
		{
			if($_value >=0 && $_value < 3) return "<font color='red'>มีปัญหา</font>"; 
			if($_value == 3) return "<font color='orange'>เสี่ยง</font>";
			if($_value > 3) return "ปกติ";
			else return "-";
		}
	}
	
	function displayMoreDetail($_value){
		switch($_value){
			case -1 : return "-";break;
			case 0 : return "ไม่รุนแรง";break;
			case 1 : return "<font color='orange'>รุนแรงปานกลาง</font>";break;
			case 2 : return "<font color='orange'>รุนแรงปานกลาง</font>";break;
			default : return "<font color='red'>รุนแรงมาก</font>";
		}
	}

	
	function displayQuestioner($_value){
		switch ($_value) {
			case "student" : return "นักเรียน";break;
			case "parent" : return "ผู้ปกครอง";break;
			case "teacher" : return "ครูที่ปรึกษา";break;
			default : return "ไม่ระบุ";
		}
	}
	
	function displaySurvey($_value){
		if($_value != "")
		switch($_value){
			case 0 : return "ไม่จริง"; break;
			case 1 : return "ค่อนข้างจริง"; break;
			case 2 : return "จริง"; break;
			default : return "<font color='#FF0000'>ยังไม่ประเมิน</font>";
		}
		else { return "<font color='#FF0000'>ยังไม่ประเมิน</font>";}
	}
	function displaySurveyReverse($_value){
		if($_value != "")
		switch($_value){
			case 2 : return "ไม่จริง"; break;
			case 1 : return "ค่อนข้างจริง"; break;
			case 0 : return "จริง"; break;
			default : return "<font color='#FF0000'>ยังไม่ประเมิน</font>";
		}
		else { return "<font color='#FF0000'>ยังไม่ประเมิน</font>";}
	}
	
	function noSurvey(){
		return "<font color='red'>ยังไม่ได้ประเมิน</font>";
	}
	
	
	///---------- module_moral
	function displayMLevel($_value){
		switch($_value){
			case "00" : return "กิจกรรมภายใน"; break;
			case "01" : return "กิจกรรมของชุมชน"; break;
			case "02" : return "ระดับเขตพื้นที่การศึกษา"; break;
			case "03" : return "ระดับจังหวัด"; break;
			case "04" : return "ระดับประเทศ"; break;
			default : return "ไม่ระบุ";
		}
	}
	
		function displayMtype($_value){
		switch($_value){
			case "00" : return "การบำเพ็ญประโยชน์"; break;
			case "01" : return "การเข้าร่วมกิจกรรม"; break;
			case "02" : return "การแข่งขันทักษะทางวิชาการ"; break;
			case "03" : return "การแข่งขันทักษะด้านกีฬา"; break;
			default : return "รวมทั้งทุกประเภทกิจกรรม";
		}
	}
	
		
	function displayAcademic($_value) {
		switch ($_value){
			case "0": return "ฝ่ายบริหาร"; break;
			case "1": return "ภาษาไทย"; break;
			case "2": return "คณิตศาสตร์"; break;
			case "3": return "วิทยาศาสตร์"; break;
			case "4": return "สังคมศึกษา ฯ"; break;
			case "5": return "สุขศึกษาและพลศึกษา"; break;
			case "6": return "ศิลปะ"; break;
			case "7": return "การงานอาชีพและเทคโนโลยี"; break;
			case "8": return "ภาษาต่างประเทศ"; break;
			case "9": return "กิจกรรมพัฒนาผู้เรียน"; break;
			case "all": return "ทุกกลุ่มสาระการเรียนรู้"; break;
			default : return "ไม่ระบุ";
		}
	}
	
	function displayPrize($_value){
		switch($_value){
			case "00" : return "ชนะเลิศอันดับที่ 1"; break;
			case "01" : return "ชนะเลิศอันดับที่ 2"; break;
			case "02" : return "ชนะเลิศอันดับที่ 3"; break;
			case "03" : return "ติดลำดับหนึ่งในห้า"; break;
			case "04" : return "ได้เข้าร่วม"; break;
			default : return "ไม่ระบุ";
		}
	}
	
	function displayPrizeShort($_value){
		switch($_value){
			case "00" : return "ที่ 1"; break;
			case "01" : return "ที่ 2"; break;
			case "02" : return "ที่ 3"; break;
			case "03" : return "ติด 1 ใน 5"; break;
			case "04" : return "ได้เข้าร่วม"; break;
			default : return "ไม่ระบุ";
		}
	}
	
	
	
	
?>