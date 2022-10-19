-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.51
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `pk`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `drug_level`
-- 

DROP TABLE IF EXISTS `drug_level`;
CREATE TABLE IF NOT EXISTS `drug_level` (
  `level_id` varchar(2) NOT NULL,
  `level_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`level_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `drug_level`
-- 

INSERT INTO `drug_level` VALUES ('00', 'ปกติ');
INSERT INTO `drug_level` VALUES ('01', 'เสี่ยง');
INSERT INTO `drug_level` VALUES ('02', 'เคยมีการทดลอง');
INSERT INTO `drug_level` VALUES ('03', 'ติดสารเสพติด');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `grades`
-- 

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `XLEVEL` varchar(1) NOT NULL,
  `ACADYEAR` varchar(4) NOT NULL,
  `ACADSEMESTER` varchar(1) NOT NULL,
  `PSUBJECTCODE` varchar(20) NOT NULL,
  `CLASS_ID` varchar(3) NOT NULL,
  `STUDENT_ID` varchar(10) NOT NULL,
  `P100` varchar(4) default NULL,
  `GRADE` varchar(10) NOT NULL,
  `REGRADE` varchar(10) default NULL,
  `TEACHER_ID` varchar(50) default NULL,
  `UPDATE_USER` varchar(255) default NULL,
  `UPDATE_DATETIME` varchar(255) default NULL,
  PRIMARY KEY  (`XLEVEL`,`ACADYEAR`,`ACADSEMESTER`,`PSUBJECTCODE`,`STUDENT_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `grades`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `project`
-- 

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `project_id` varchar(10) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `acadyear` varchar(4) NOT NULL,
  `acadsemester` varchar(1) NOT NULL,
  `detail` text NOT NULL,
  `purpose` varchar(1) NOT NULL,
  `start_date` varchar(10) NOT NULL,
  `finish_date` varchar(10) NOT NULL,
  `budget_type` varchar(2) NOT NULL,
  `budget_academic` varchar(255) NOT NULL,
  `budget_income` int(11) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  PRIMARY KEY  (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `project`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `project_budget`
-- 

DROP TABLE IF EXISTS `project_budget`;
CREATE TABLE IF NOT EXISTS `project_budget` (
  `budget_id` int(11) NOT NULL auto_increment,
  `project_id` varchar(10) NOT NULL,
  `budget_type` varchar(2) NOT NULL,
  `budget_detail` varchar(255) NOT NULL,
  `prize_per_unit` float(12,2) NOT NULL,
  `amount` int(11) NOT NULL,
  `money` float(24,2) NOT NULL,
  PRIMARY KEY  (`budget_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `project_budget`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `project_comment`
-- 

DROP TABLE IF EXISTS `project_comment`;
CREATE TABLE IF NOT EXISTS `project_comment` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(10) NOT NULL,
  `comment_type` varchar(1) NOT NULL,
  `detail` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `project_comment`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `project_qa`
-- 

DROP TABLE IF EXISTS `project_qa`;
CREATE TABLE IF NOT EXISTS `project_qa` (
  `project_id` varchar(10) NOT NULL,
  `organize` varchar(2) NOT NULL,
  `standard` int(11) NOT NULL,
  `indexof` int(11) NOT NULL,
  PRIMARY KEY  (`project_id`,`organize`,`standard`,`indexof`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `project_qa`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_academic`
-- 

DROP TABLE IF EXISTS `ref_academic`;
CREATE TABLE IF NOT EXISTS `ref_academic` (
  `academic_id` varchar(1) NOT NULL,
  `academic_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`academic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_academic`
-- 

INSERT INTO `ref_academic` VALUES ('0', 'ฝ่ายบริหาร');
INSERT INTO `ref_academic` VALUES ('1', 'ภาษาไทย');
INSERT INTO `ref_academic` VALUES ('2', 'คณิตศาสตร์');
INSERT INTO `ref_academic` VALUES ('3', 'วิทยาศาสตร์');
INSERT INTO `ref_academic` VALUES ('4', 'สังคมศึกษา ฯ');
INSERT INTO `ref_academic` VALUES ('5', 'สุขศึกษาและพลศึกษา');
INSERT INTO `ref_academic` VALUES ('6', 'ศิลปะและดนตรี');
INSERT INTO `ref_academic` VALUES ('7', 'การงานอาชีพและเทคโนโลยี');
INSERT INTO `ref_academic` VALUES ('8', 'ภาษาต่างประเทศ');
INSERT INTO `ref_academic` VALUES ('9', 'กิจกรรมพัฒนาผู้เรียน');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_color`
-- 

DROP TABLE IF EXISTS `ref_color`;
CREATE TABLE IF NOT EXISTS `ref_color` (
  `color_id` varchar(2) NOT NULL,
  `color_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`color_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_color`
-- 

INSERT INTO `ref_color` VALUES ('00', 'ไม่ระบุ');
INSERT INTO `ref_color` VALUES ('01', 'ส้ม');
INSERT INTO `ref_color` VALUES ('02', 'ชมพู');
INSERT INTO `ref_color` VALUES ('03', 'ม่วง');
INSERT INTO `ref_color` VALUES ('04', 'เหลือง');
INSERT INTO `ref_color` VALUES ('05', 'เขียว');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_cripple`
-- 

DROP TABLE IF EXISTS `ref_cripple`;
CREATE TABLE IF NOT EXISTS `ref_cripple` (
  `cripple_id` int(11) NOT NULL,
  `cripple_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`cripple_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_cripple`
-- 

INSERT INTO `ref_cripple` VALUES (0, 'ไม่พิการ');
INSERT INTO `ref_cripple` VALUES (1, 'ความพิการทางการมองเห็น');
INSERT INTO `ref_cripple` VALUES (2, 'ความพิการทางการได้ยิน');
INSERT INTO `ref_cripple` VALUES (3, 'ความพิการทางสติปัญญา');
INSERT INTO `ref_cripple` VALUES (4, 'ความพิการทางร่างกาย, สุขภาพ');
INSERT INTO `ref_cripple` VALUES (5, 'ปัญหาทางการเรียนรู้');
INSERT INTO `ref_cripple` VALUES (6, 'ความพิการทางการพูด, ภาษา');
INSERT INTO `ref_cripple` VALUES (7, 'ปัญหาทางพฤติกรรมและการเรียนรู้');
INSERT INTO `ref_cripple` VALUES (8, 'ความพิการทางออทิสติก');
INSERT INTO `ref_cripple` VALUES (9, 'ความพิการซ้อน');
INSERT INTO `ref_cripple` VALUES (10, 'อื่น ๆ');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_discipline`
-- 

DROP TABLE IF EXISTS `ref_discipline`;
CREATE TABLE IF NOT EXISTS `ref_discipline` (
  `dis_id` int(11) NOT NULL auto_increment,
  `dis_type` varchar(255) character set utf8 NOT NULL,
  PRIMARY KEY  (`dis_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=21 ;

-- 
-- dump ตาราง `ref_discipline`
-- 

INSERT INTO `ref_discipline` VALUES (10, 'ตรงต่อเวลา');
INSERT INTO `ref_discipline` VALUES (11, 'การเข้าชั้นเรียน');
INSERT INTO `ref_discipline` VALUES (12, 'ทะเลาะวิวาท');
INSERT INTO `ref_discipline` VALUES (13, 'ลักขโมย');
INSERT INTO `ref_discipline` VALUES (14, 'สิ่งเสพติด');
INSERT INTO `ref_discipline` VALUES (15, 'อาวุธ');
INSERT INTO `ref_discipline` VALUES (16, 'สื่อลามกอนาจาร');
INSERT INTO `ref_discipline` VALUES (17, 'พฤติกรรม');
INSERT INTO `ref_discipline` VALUES (18, 'เครื่องแต่งกาย');
INSERT INTO `ref_discipline` VALUES (19, 'อุปกรณ์อิเล็กทรอนิกส์');
INSERT INTO `ref_discipline` VALUES (20, 'เรื่องทั่วไป');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_disciplinelevel`
-- 

DROP TABLE IF EXISTS `ref_disciplinelevel`;
CREATE TABLE IF NOT EXISTS `ref_disciplinelevel` (
  `dis_levelid` int(11) NOT NULL auto_increment,
  `dis_leveldetail` varchar(255) character set utf8 NOT NULL,
  PRIMARY KEY  (`dis_levelid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

-- 
-- dump ตาราง `ref_disciplinelevel`
-- 

INSERT INTO `ref_disciplinelevel` VALUES (10, 'สถานเบา');
INSERT INTO `ref_disciplinelevel` VALUES (11, 'สถานปานกลาง');
INSERT INTO `ref_disciplinelevel` VALUES (12, 'สถานหนัก');
INSERT INTO `ref_disciplinelevel` VALUES (13, 'สถานหนักมาก');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_disciplinestatus`
-- 

DROP TABLE IF EXISTS `ref_disciplinestatus`;
CREATE TABLE IF NOT EXISTS `ref_disciplinestatus` (
  `status` int(11) NOT NULL,
  `status_detail` varchar(255) NOT NULL,
  PRIMARY KEY  (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_disciplinestatus`
-- 

INSERT INTO `ref_disciplinestatus` VALUES (0, 'คดีสอบสวนไม่มีมูล');
INSERT INTO `ref_disciplinestatus` VALUES (1, 'รายการแจ้งพฤติกรรมไม่พึงประสงค์');
INSERT INTO `ref_disciplinestatus` VALUES (2, 'ดำเนินการสอบสวนแล้ว');
INSERT INTO `ref_disciplinestatus` VALUES (3, 'แจ้งบทลงโทษแล้ว');
INSERT INTO `ref_disciplinestatus` VALUES (4, 'อยู่ระหว่างการดำเนินการกำกับ/ติดตาม');
INSERT INTO `ref_disciplinestatus` VALUES (5, 'อยู่ในระหว่างการพิจารณาของหัวหน้าฝ่ายกิจการนักเรียน');
INSERT INTO `ref_disciplinestatus` VALUES (6, 'ดำเนินการเสร็จสิ้น/ปิดคดี');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_drug`
-- 

DROP TABLE IF EXISTS `ref_drug`;
CREATE TABLE IF NOT EXISTS `ref_drug` (
  `drug_id` varchar(2) NOT NULL,
  `drug_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`drug_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_drug`
-- 

INSERT INTO `ref_drug` VALUES ('00', 'บุหรี่');
INSERT INTO `ref_drug` VALUES ('01', 'เครื่องดื่มแอลกอฮอร์');
INSERT INTO `ref_drug` VALUES ('02', 'ยาบ้า');
INSERT INTO `ref_drug` VALUES ('03', 'สารระเหย/กาว');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_fmstatus`
-- 

DROP TABLE IF EXISTS `ref_fmstatus`;
CREATE TABLE IF NOT EXISTS `ref_fmstatus` (
  `fmstatus_id` int(11) NOT NULL,
  `fmstatus_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`fmstatus_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_fmstatus`
-- 

INSERT INTO `ref_fmstatus` VALUES (0, 'ไม่ทราบติดต่อไม่ได้');
INSERT INTO `ref_fmstatus` VALUES (1, 'อยู่ด้วยกัน');
INSERT INTO `ref_fmstatus` VALUES (2, 'แยกกันอยู่');
INSERT INTO `ref_fmstatus` VALUES (3, 'หย่าร้าง');
INSERT INTO `ref_fmstatus` VALUES (4, 'บิดาถึงแก่กรรม');
INSERT INTO `ref_fmstatus` VALUES (5, 'มารดาถึงแก่กรรม');
INSERT INTO `ref_fmstatus` VALUES (6, 'บิดาแต่งงานใหม่');
INSERT INTO `ref_fmstatus` VALUES (7, 'มารดาแต่งงานใหม่');
INSERT INTO `ref_fmstatus` VALUES (9, 'บิดาและมารดาถึงแก่กรรม');
INSERT INTO `ref_fmstatus` VALUES (10, 'บิดาและมารดาแต่งงานใหม่');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_inservice`
-- 

DROP TABLE IF EXISTS `ref_inservice`;
CREATE TABLE IF NOT EXISTS `ref_inservice` (
  `service_id` int(11) NOT NULL,
  `service_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_inservice`
-- 

INSERT INTO `ref_inservice` VALUES (0, 'ไม่ระบุ');
INSERT INTO `ref_inservice` VALUES (1, 'พักอยู่กับผู้ปกครองนักเรียน');
INSERT INTO `ref_inservice` VALUES (2, 'พักในบ้านพักครู');
INSERT INTO `ref_inservice` VALUES (3, 'พักอยู่กับญาติ');
INSERT INTO `ref_inservice` VALUES (4, 'พักอยู่หอพักในโรงเรียน');
INSERT INTO `ref_inservice` VALUES (5, 'พักอยู่หอพักนอกโรงเรียน');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_moral`
-- 

DROP TABLE IF EXISTS `ref_moral`;
CREATE TABLE IF NOT EXISTS `ref_moral` (
  `moral_id` varchar(2) NOT NULL,
  `moral_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`moral_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_moral`
-- 

INSERT INTO `ref_moral` VALUES ('00', 'การบำเพ็ญประโยชน์');
INSERT INTO `ref_moral` VALUES ('01', 'การเข้าร่วมกิจกรรม');
INSERT INTO `ref_moral` VALUES ('02', 'การแข่งขันทักษะทางวิชาการ');
INSERT INTO `ref_moral` VALUES ('03', 'การแข่งขันทักษะด้านกีฬา');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_moraljoin`
-- 

DROP TABLE IF EXISTS `ref_moraljoin`;
CREATE TABLE IF NOT EXISTS `ref_moraljoin` (
  `moraljoin_id` varchar(2) NOT NULL,
  `moraljoin_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`moraljoin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_moraljoin`
-- 

INSERT INTO `ref_moraljoin` VALUES ('00', 'ชนะเลิศอันดับที่หนึ่ง');
INSERT INTO `ref_moraljoin` VALUES ('01', 'ชนะเลิศอันดับที่สอง');
INSERT INTO `ref_moraljoin` VALUES ('02', 'ชนะเลิศอันดับที่สาม');
INSERT INTO `ref_moraljoin` VALUES ('03', 'ติดลำดับหนึ่งในห้า');
INSERT INTO `ref_moraljoin` VALUES ('04', 'ได้เข้าร่วม');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_morallevel`
-- 

DROP TABLE IF EXISTS `ref_morallevel`;
CREATE TABLE IF NOT EXISTS `ref_morallevel` (
  `morallev_id` varchar(2) NOT NULL,
  `morallev_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`morallev_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_morallevel`
-- 

INSERT INTO `ref_morallevel` VALUES ('00', 'กิจกรรมภายใน');
INSERT INTO `ref_morallevel` VALUES ('01', 'กิจกรรมของชุมชน');
INSERT INTO `ref_morallevel` VALUES ('02', 'ระดับเขตพื้นที่การศึกษา');
INSERT INTO `ref_morallevel` VALUES ('03', 'ระดับจังหวัด');
INSERT INTO `ref_morallevel` VALUES ('04', 'ระดับประเทศ');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_nationality`
-- 

DROP TABLE IF EXISTS `ref_nationality`;
CREATE TABLE IF NOT EXISTS `ref_nationality` (
  `nation_id` int(11) NOT NULL,
  `nation_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`nation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_nationality`
-- 

INSERT INTO `ref_nationality` VALUES (0, 'ยังไม่ระบุ');
INSERT INTO `ref_nationality` VALUES (1, 'ไทย');
INSERT INTO `ref_nationality` VALUES (2, 'จีน');
INSERT INTO `ref_nationality` VALUES (3, 'พม่า');
INSERT INTO `ref_nationality` VALUES (4, 'ลาว');
INSERT INTO `ref_nationality` VALUES (5, 'กัมพูชา');
INSERT INTO `ref_nationality` VALUES (6, 'เวียดนาม');
INSERT INTO `ref_nationality` VALUES (7, 'มาเลเซีย');
INSERT INTO `ref_nationality` VALUES (8, 'อินเดีย');
INSERT INTO `ref_nationality` VALUES (9, 'ฟิลิปปิน');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_nextacademic`
-- 

DROP TABLE IF EXISTS `ref_nextacademic`;
CREATE TABLE IF NOT EXISTS `ref_nextacademic` (
  `id` varchar(2) NOT NULL,
  `next_desc` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_nextacademic`
-- 

INSERT INTO `ref_nextacademic` VALUES ('00', '-ไม่ระบุ-');
INSERT INTO `ref_nextacademic` VALUES ('01', 'ศึกษาต่อระดับมัธยมศึกษาตอนปลาย');
INSERT INTO `ref_nextacademic` VALUES ('02', 'ศึกษาต่อระดับปวช.');
INSERT INTO `ref_nextacademic` VALUES ('03', 'ศึกษาต่อระดับปวส.');
INSERT INTO `ref_nextacademic` VALUES ('04', 'ศึกษาต่อระดับมหาวิทยาลัยของรัฐ');
INSERT INTO `ref_nextacademic` VALUES ('05', 'ศึกษาต่อระดับมหาวิทยาลัยของเอกชน');
INSERT INTO `ref_nextacademic` VALUES ('06', 'ศึกษาต่อในระดับมหาวิทยาลัยและทำงานด้วย');
INSERT INTO `ref_nextacademic` VALUES ('07', 'ทำงานในหน่วยงานราชการ');
INSERT INTO `ref_nextacademic` VALUES ('08', 'ทำงานในหน่วยงานรัฐวิสาหกิจ');
INSERT INTO `ref_nextacademic` VALUES ('09', 'ทำงานในหน่วยงานเอกชน');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_nextregion`
-- 

DROP TABLE IF EXISTS `ref_nextregion`;
CREATE TABLE IF NOT EXISTS `ref_nextregion` (
  `id` varchar(2) NOT NULL,
  `next_region` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_nextregion`
-- 

INSERT INTO `ref_nextregion` VALUES ('00', '-ไม่ระบุ-');
INSERT INTO `ref_nextregion` VALUES ('01', 'ภาคกลาง');
INSERT INTO `ref_nextregion` VALUES ('02', 'ภาคตะวันออก');
INSERT INTO `ref_nextregion` VALUES ('03', 'ภาคตะวันออกเฉียงเหนือ');
INSERT INTO `ref_nextregion` VALUES ('04', 'ภาคเหนือ');
INSERT INTO `ref_nextregion` VALUES ('05', 'ภาคใต้');
INSERT INTO `ref_nextregion` VALUES ('06', 'ภาคตะวันตก');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_occupation`
-- 

DROP TABLE IF EXISTS `ref_occupation`;
CREATE TABLE IF NOT EXISTS `ref_occupation` (
  `occ_id` varchar(2) NOT NULL,
  `occ_description` varchar(255) NOT NULL,
  `occg_id` varchar(2) NOT NULL,
  `occg_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`occ_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_occupation`
-- 

INSERT INTO `ref_occupation` VALUES ('0', 'ไม่ได้ระบุ', '0', 'ไม่ได้ระบุ');
INSERT INTO `ref_occupation` VALUES ('1', 'เกษตรกร', '1', 'เกษตรกร');
INSERT INTO `ref_occupation` VALUES ('2', 'ค้าขาย', '2', 'ค้าขาย');
INSERT INTO `ref_occupation` VALUES ('3', 'รับจ้าง', '3', 'รับจ้าง');
INSERT INTO `ref_occupation` VALUES ('4', 'รับราชการ', '4', 'รับราชการ');
INSERT INTO `ref_occupation` VALUES ('5', 'พนักงาน', '5', 'พนักงาน');
INSERT INTO `ref_occupation` VALUES ('6', 'นักธุรกิจ', '6', 'นักธุรกิจ');
INSERT INTO `ref_occupation` VALUES ('7', 'ไม่ได้ประกอบอาชีพ', '7', 'ยังไม่ได้ประกอบอาชีพ');
INSERT INTO `ref_occupation` VALUES ('8', 'อาชีพอิสระ', '8', 'อาชีพอิสระ');
INSERT INTO `ref_occupation` VALUES ('9', 'อื่นๆ', '9', 'อื่นๆ');
INSERT INTO `ref_occupation` VALUES ('11', 'ทำนา', '11', 'ทำนา');
INSERT INTO `ref_occupation` VALUES ('12', 'ทำไร่', '12', 'ทำไร่');
INSERT INTO `ref_occupation` VALUES ('13', 'ทำสวน', '13', 'ทำสวน');
INSERT INTO `ref_occupation` VALUES ('14', 'เลี้ยงสัตว์', '14', 'เลี้ยงสัตว์');
INSERT INTO `ref_occupation` VALUES ('15', 'ประมง', '15', 'ประมง');
INSERT INTO `ref_occupation` VALUES ('19', '-', '19', '-');
INSERT INTO `ref_occupation` VALUES ('21', 'ค้าขายอาหาร', '21', 'ค้าขายอาหาร');
INSERT INTO `ref_occupation` VALUES ('22', 'ค้าขายของใช้', '22', 'ค้าขายของใช้');
INSERT INTO `ref_occupation` VALUES ('29', '-', '29', '-');
INSERT INTO `ref_occupation` VALUES ('31', 'รับจ้างก่อสร้าง', '31', 'รับจ้างก่อสร้าง');
INSERT INTO `ref_occupation` VALUES ('32', 'รับจ้างขับรถ', '32', 'รับจ้างขับรถ');
INSERT INTO `ref_occupation` VALUES ('39', '-', '39', '-');
INSERT INTO `ref_occupation` VALUES ('41', 'ครู', '41', 'ครู');
INSERT INTO `ref_occupation` VALUES ('42', 'ทหาร', '42', 'ทหาร');
INSERT INTO `ref_occupation` VALUES ('43', 'ตำรวจ', '43', 'ตำรวจ');
INSERT INTO `ref_occupation` VALUES ('49', 'ข้าราชการ/พนักงานของรัฐเกษียณ', '49', 'ข้าราชการ/พนักงานของรัฐเกษียณ');
INSERT INTO `ref_occupation` VALUES ('51', 'พนักงานบริษัท', '51', 'พนักงานบริษัท');
INSERT INTO `ref_occupation` VALUES ('52', 'พนักงานรัฐวิสาหกิจ', '52', 'พนักงานรัฐวิสาหกิจ');
INSERT INTO `ref_occupation` VALUES ('59', '-', '59', '-');
INSERT INTO `ref_occupation` VALUES ('61', 'นักธุรกิจการเงินการธนาคาร', '61', 'นักธุรกิจการเงินการธนาคาร');
INSERT INTO `ref_occupation` VALUES ('62', 'นักธุรกิจสิ่งก่อสร้าง', '62', 'นักธุรกิจสิ่งก่อสร้าง');
INSERT INTO `ref_occupation` VALUES ('69', '-', '69', '-');
INSERT INTO `ref_occupation` VALUES ('44', 'พนักงานของรัฐ', '44', 'พนักงานของรัฐ');
INSERT INTO `ref_occupation` VALUES ('70', 'พระ/นักบวช', '70', 'พระ/นักบวช');
INSERT INTO `ref_occupation` VALUES ('90', 'เสียชีวิต', '90', 'เสียชีวิต');
INSERT INTO `ref_occupation` VALUES ('99', 'อาชีพอื่น ๆ', '99', 'อาชีพอื่น ๆ');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_prefix`
-- 

DROP TABLE IF EXISTS `ref_prefix`;
CREATE TABLE IF NOT EXISTS `ref_prefix` (
  `prefix_id` varchar(2) NOT NULL,
  `prefix_detail` varchar(255) NOT NULL,
  PRIMARY KEY  (`prefix_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_prefix`
-- 

INSERT INTO `ref_prefix` VALUES ('1', 'เด็กชาย');
INSERT INTO `ref_prefix` VALUES ('2', 'เด็กหญิง');
INSERT INTO `ref_prefix` VALUES ('3', 'นาย');
INSERT INTO `ref_prefix` VALUES ('4', 'นางสาว');
INSERT INTO `ref_prefix` VALUES ('5', 'นาง');
INSERT INTO `ref_prefix` VALUES ('6', 'หม่อมหลวง');
INSERT INTO `ref_prefix` VALUES ('7', 'หม่อมราชวงศ์');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_province`
-- 

DROP TABLE IF EXISTS `ref_province`;
CREATE TABLE IF NOT EXISTS `ref_province` (
  `prov_id` varchar(2) NOT NULL,
  `prov_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`prov_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_province`
-- 

INSERT INTO `ref_province` VALUES ('81', 'กระบี่');
INSERT INTO `ref_province` VALUES ('10', 'กรุงเทพมหานคร');
INSERT INTO `ref_province` VALUES ('71', 'กาญจนบุรี');
INSERT INTO `ref_province` VALUES ('46', 'กาฬสินธุ์');
INSERT INTO `ref_province` VALUES ('62', 'กำแพงเพชร');
INSERT INTO `ref_province` VALUES ('40', 'ขอนแก่น');
INSERT INTO `ref_province` VALUES ('22', 'จันทบุรี');
INSERT INTO `ref_province` VALUES ('24', 'ฉะเชิงเทรา');
INSERT INTO `ref_province` VALUES ('20', 'ชลบุรี');
INSERT INTO `ref_province` VALUES ('17', 'ชัยนาท');
INSERT INTO `ref_province` VALUES ('36', 'ชัยภูมิ');
INSERT INTO `ref_province` VALUES ('86', 'ชุมพร');
INSERT INTO `ref_province` VALUES ('57', 'เชียงราย');
INSERT INTO `ref_province` VALUES ('50', 'เชียงใหม่');
INSERT INTO `ref_province` VALUES ('92', 'ตรัง');
INSERT INTO `ref_province` VALUES ('23', 'ตราด');
INSERT INTO `ref_province` VALUES ('63', 'ตาก');
INSERT INTO `ref_province` VALUES ('26', 'นครนายก');
INSERT INTO `ref_province` VALUES ('73', 'นครปฐม');
INSERT INTO `ref_province` VALUES ('48', 'นครพนม');
INSERT INTO `ref_province` VALUES ('30', 'นครราชสีมา');
INSERT INTO `ref_province` VALUES ('80', 'นครศรีธรรมราช');
INSERT INTO `ref_province` VALUES ('60', 'นครสวรรค์');
INSERT INTO `ref_province` VALUES ('11', 'นนทบุรี');
INSERT INTO `ref_province` VALUES ('96', 'นราธิวาส');
INSERT INTO `ref_province` VALUES ('55', 'น่าน');
INSERT INTO `ref_province` VALUES ('31', 'บุรีรัมย์');
INSERT INTO `ref_province` VALUES ('12', 'ปทุมธานี');
INSERT INTO `ref_province` VALUES ('77', 'ประจวบคีรีขันธ์');
INSERT INTO `ref_province` VALUES ('25', 'ปราจีนบุรี');
INSERT INTO `ref_province` VALUES ('94', 'ปัตตานี');
INSERT INTO `ref_province` VALUES ('13', 'พระนครศรีอยุธยา');
INSERT INTO `ref_province` VALUES ('56', 'พะเยา');
INSERT INTO `ref_province` VALUES ('82', 'พังงา');
INSERT INTO `ref_province` VALUES ('93', 'พัทลุง');
INSERT INTO `ref_province` VALUES ('66', 'พิจิตร');
INSERT INTO `ref_province` VALUES ('65', 'พิษณุโลก');
INSERT INTO `ref_province` VALUES ('76', 'เพชรบุรี');
INSERT INTO `ref_province` VALUES ('67', 'เพชรบูรณ์');
INSERT INTO `ref_province` VALUES ('54', 'แพร่');
INSERT INTO `ref_province` VALUES ('83', 'ภูเก็ต');
INSERT INTO `ref_province` VALUES ('44', 'มหาสารคาม');
INSERT INTO `ref_province` VALUES ('49', 'มุกดาหาร');
INSERT INTO `ref_province` VALUES ('58', 'แม่ฮ่องสอน');
INSERT INTO `ref_province` VALUES ('35', 'ยโสธร');
INSERT INTO `ref_province` VALUES ('95', 'ยะลา');
INSERT INTO `ref_province` VALUES ('45', 'ร้อยเอ็ด');
INSERT INTO `ref_province` VALUES ('85', 'ระนอง');
INSERT INTO `ref_province` VALUES ('21', 'ระยอง');
INSERT INTO `ref_province` VALUES ('70', 'ราชบุรี');
INSERT INTO `ref_province` VALUES ('15', 'ลพบุรี');
INSERT INTO `ref_province` VALUES ('52', 'ลำปาง');
INSERT INTO `ref_province` VALUES ('51', 'ลำพูน');
INSERT INTO `ref_province` VALUES ('42', 'เลย');
INSERT INTO `ref_province` VALUES ('33', 'ศรีสะเกษ');
INSERT INTO `ref_province` VALUES ('47', 'สกลนคร');
INSERT INTO `ref_province` VALUES ('90', 'สงขลา');
INSERT INTO `ref_province` VALUES ('91', 'สตูล');
INSERT INTO `ref_province` VALUES ('19', 'สมุทรปราการ');
INSERT INTO `ref_province` VALUES ('75', 'สมุทรสงคราม');
INSERT INTO `ref_province` VALUES ('74', 'สมุทรสาคร');
INSERT INTO `ref_province` VALUES ('27', 'สระแก้ว');
INSERT INTO `ref_province` VALUES ('18', 'สระบุรี');
INSERT INTO `ref_province` VALUES ('16', 'สิงห์บุรี');
INSERT INTO `ref_province` VALUES ('64', 'สุโขทัย');
INSERT INTO `ref_province` VALUES ('72', 'สุพรรณบุรี');
INSERT INTO `ref_province` VALUES ('84', 'สุราษฎร์ธานี');
INSERT INTO `ref_province` VALUES ('32', 'สุรินทร์');
INSERT INTO `ref_province` VALUES ('43', 'หนองคาย');
INSERT INTO `ref_province` VALUES ('39', 'หนองบัวลำภู');
INSERT INTO `ref_province` VALUES ('14', 'อ่างทอง');
INSERT INTO `ref_province` VALUES ('37', 'อำนาจเจริญ');
INSERT INTO `ref_province` VALUES ('41', 'อุดรธานี');
INSERT INTO `ref_province` VALUES ('53', 'อุตรดิตถ์');
INSERT INTO `ref_province` VALUES ('61', 'อุทัยธานี');
INSERT INTO `ref_province` VALUES ('34', 'อุบลราชธานี');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_race`
-- 

DROP TABLE IF EXISTS `ref_race`;
CREATE TABLE IF NOT EXISTS `ref_race` (
  `race_id` int(11) NOT NULL,
  `race_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`race_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_race`
-- 

INSERT INTO `ref_race` VALUES (0, 'ยังไม่ระบุ');
INSERT INTO `ref_race` VALUES (1, 'ไทย');
INSERT INTO `ref_race` VALUES (2, 'จีน');
INSERT INTO `ref_race` VALUES (3, 'พม่า');
INSERT INTO `ref_race` VALUES (4, 'ลาว');
INSERT INTO `ref_race` VALUES (5, 'กัมพูชา');
INSERT INTO `ref_race` VALUES (6, 'เวียดนาม');
INSERT INTO `ref_race` VALUES (7, 'มาเลเซีย');
INSERT INTO `ref_race` VALUES (8, 'อินเดีย');
INSERT INTO `ref_race` VALUES (9, 'ฟิลิปปิน');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_relation`
-- 

DROP TABLE IF EXISTS `ref_relation`;
CREATE TABLE IF NOT EXISTS `ref_relation` (
  `relation_id` varchar(2) NOT NULL,
  `relation_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`relation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_relation`
-- 

INSERT INTO `ref_relation` VALUES ('0', 'ยังไม่ระบุ');
INSERT INTO `ref_relation` VALUES ('1', 'บิดา');
INSERT INTO `ref_relation` VALUES ('2', 'มารดา');
INSERT INTO `ref_relation` VALUES ('3', 'ญาติทางบิดา');
INSERT INTO `ref_relation` VALUES ('4', 'ญาติทางมารดา');
INSERT INTO `ref_relation` VALUES ('5', 'ผู้มีอุปการคุณ');
INSERT INTO `ref_relation` VALUES ('6', 'ปู่');
INSERT INTO `ref_relation` VALUES ('7', 'ย่า');
INSERT INTO `ref_relation` VALUES ('8', 'ตา');
INSERT INTO `ref_relation` VALUES ('9', 'ยาย');
INSERT INTO `ref_relation` VALUES ('10', 'ลุง');
INSERT INTO `ref_relation` VALUES ('11', 'ป้า');
INSERT INTO `ref_relation` VALUES ('12', 'น้า');
INSERT INTO `ref_relation` VALUES ('13', 'อา');
INSERT INTO `ref_relation` VALUES ('14', 'พี่');
INSERT INTO `ref_relation` VALUES ('99', 'อื่น ๆ');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_religion`
-- 

DROP TABLE IF EXISTS `ref_religion`;
CREATE TABLE IF NOT EXISTS `ref_religion` (
  `religion_id` int(11) NOT NULL,
  `religion_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`religion_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_religion`
-- 

INSERT INTO `ref_religion` VALUES (0, 'ไม่ระบุ');
INSERT INTO `ref_religion` VALUES (1, 'พุทธ');
INSERT INTO `ref_religion` VALUES (2, 'คริสต์');
INSERT INTO `ref_religion` VALUES (3, 'อิสลาม');
INSERT INTO `ref_religion` VALUES (4, 'ฮินดู');
INSERT INTO `ref_religion` VALUES (5, 'พรามหณ์');
INSERT INTO `ref_religion` VALUES (6, 'ซิกส์');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_retire`
-- 

DROP TABLE IF EXISTS `ref_retire`;
CREATE TABLE IF NOT EXISTS `ref_retire` (
  `retire_id` int(11) NOT NULL,
  `retire_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`retire_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_retire`
-- 

INSERT INTO `ref_retire` VALUES (0, 'ยังไม่ออก');
INSERT INTO `ref_retire` VALUES (1, 'ฐานะยากจน');
INSERT INTO `ref_retire` VALUES (2, 'มีปัญหาครอบครัว');
INSERT INTO `ref_retire` VALUES (3, 'สมรสแล้ว');
INSERT INTO `ref_retire` VALUES (4, 'มีปัญหาในการปรับตัว');
INSERT INTO `ref_retire` VALUES (5, 'ต้องคดี/ถูกจับ');
INSERT INTO `ref_retire` VALUES (6, 'เจ็บป่วย/อุบัติเหตุ');
INSERT INTO `ref_retire` VALUES (7, 'อพยพตามผู้ปกครอง');
INSERT INTO `ref_retire` VALUES (8, 'ออกเพื่อหาเลี้ยงครอบครัว');
INSERT INTO `ref_retire` VALUES (9, 'ย้ายสถานศึกษา');
INSERT INTO `ref_retire` VALUES (10, 'เสียชีวิต');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_sanction`
-- 

DROP TABLE IF EXISTS `ref_sanction`;
CREATE TABLE IF NOT EXISTS `ref_sanction` (
  `sanc_id` varchar(2) NOT NULL,
  `sanc_detail` varchar(255) NOT NULL,
  PRIMARY KEY  (`sanc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_sanction`
-- 

INSERT INTO `ref_sanction` VALUES ('00', 'ยังไม่ดำเนินการสอบสวน');
INSERT INTO `ref_sanction` VALUES ('01', 'ดำเนินการสอบสวนเสร็จสิ้นและไม่มีกิจกรรม');
INSERT INTO `ref_sanction` VALUES ('02', 'ดำเนินการสอบสวนเสร็จสิ้นและมีกิจกรรมซ่อมเสริม');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_scout`
-- 

DROP TABLE IF EXISTS `ref_scout`;
CREATE TABLE IF NOT EXISTS `ref_scout` (
  `scout_id` int(11) NOT NULL,
  `scout_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`scout_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_scout`
-- 

INSERT INTO `ref_scout` VALUES (0, 'ไม่ได้เรียน/ไม่ได้สอน');
INSERT INTO `ref_scout` VALUES (1, 'ลูกเสือสำรอง');
INSERT INTO `ref_scout` VALUES (2, 'ลูกเสือสามัญ');
INSERT INTO `ref_scout` VALUES (3, 'ลูกเสือสามัญรุ่นใหญ่');
INSERT INTO `ref_scout` VALUES (4, 'ลูกเสือวิสามัญ');
INSERT INTO `ref_scout` VALUES (5, 'เนตรนารีสำรอง');
INSERT INTO `ref_scout` VALUES (6, 'เนตรนารีสามัญ');
INSERT INTO `ref_scout` VALUES (7, 'เนตรนารีสามัญรุ่นใหญ่');
INSERT INTO `ref_scout` VALUES (8, 'เนตรนารีวิสามัญ');
INSERT INTO `ref_scout` VALUES (9, 'ยุวกาชาด ระดับเตรียม');
INSERT INTO `ref_scout` VALUES (10, 'ยุวกาชาด ระดับ 1');
INSERT INTO `ref_scout` VALUES (11, 'ยุวกาชาด ระดับ 2');
INSERT INTO `ref_scout` VALUES (12, 'ยุวกาชาด ระดับ 3(ม.ต้น)');
INSERT INTO `ref_scout` VALUES (13, 'ยุวกาชาด ระดับ 4(ม.ปลาย)');
INSERT INTO `ref_scout` VALUES (14, 'ยุวกาชาด ระดับอุดมศึกษา');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_studabsent`
-- 

DROP TABLE IF EXISTS `ref_studabsent`;
CREATE TABLE IF NOT EXISTS `ref_studabsent` (
  `absent_id` int(11) NOT NULL,
  `absent_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`absent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_studabsent`
-- 

INSERT INTO `ref_studabsent` VALUES (0, 'ไม่ขาดแคลน');
INSERT INTO `ref_studabsent` VALUES (1, 'เครื่องแบบนักเรียนชาย');
INSERT INTO `ref_studabsent` VALUES (2, 'เครื่องแบบนักเรียนหญิง');
INSERT INTO `ref_studabsent` VALUES (3, 'เครื่องเขียน');
INSERT INTO `ref_studabsent` VALUES (4, 'แบบเรียน');
INSERT INTO `ref_studabsent` VALUES (5, 'อาหารกลางวัน');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_studjudge`
-- 

DROP TABLE IF EXISTS `ref_studjudge`;
CREATE TABLE IF NOT EXISTS `ref_studjudge` (
  `judge_id` int(11) NOT NULL,
  `judge_description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_studjudge`
-- 

INSERT INTO `ref_studjudge` VALUES (1, 'นักเรียนต้นปี กศ.(10 มิ.ย.)');
INSERT INTO `ref_studjudge` VALUES (2, 'ย้ายมาเรียนระหว่างปี');
INSERT INTO `ref_studjudge` VALUES (3, 'ย้ายมาเรียนระหว่างภาคเรียน');
INSERT INTO `ref_studjudge` VALUES (4, 'ออกกลางคัน');
INSERT INTO `ref_studjudge` VALUES (5, 'เสียชีวิต');
INSERT INTO `ref_studjudge` VALUES (6, 'นักเรียนในวันสิ้นปีการศึกษา');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_studstatus`
-- 

DROP TABLE IF EXISTS `ref_studstatus`;
CREATE TABLE IF NOT EXISTS `ref_studstatus` (
  `studstatus` int(11) NOT NULL,
  `studstatus_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`studstatus`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_studstatus`
-- 

INSERT INTO `ref_studstatus` VALUES (0, 'ออก');
INSERT INTO `ref_studstatus` VALUES (1, 'ปกติ');
INSERT INTO `ref_studstatus` VALUES (2, 'สำเร็จการศึกษา');
INSERT INTO `ref_studstatus` VALUES (3, 'แขวนลอย');
INSERT INTO `ref_studstatus` VALUES (4, 'พักการเรียน');
INSERT INTO `ref_studstatus` VALUES (5, 'ย้ายสถานศึกษา');
INSERT INTO `ref_studstatus` VALUES (9, 'เสียชีวิต');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_tambol`
-- 

DROP TABLE IF EXISTS `ref_tambol`;
CREATE TABLE IF NOT EXISTS `ref_tambol` (
  `tambol_id` varchar(6) NOT NULL,
  `tumbol_description` varchar(255) NOT NULL,
  `amphur_id` varchar(4) NOT NULL,
  `amphur_description` varchar(255) NOT NULL,
  `prov_id` varchar(2) NOT NULL,
  `prov_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`tambol_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_tambol`
-- 

INSERT INTO `ref_tambol` VALUES ('100101', 'พระบรมมหาราชวัง', '1001', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100102', 'วังบูรพาภิรมย์', '1001', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100103', 'วัดราชบพิธ', '1001', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100104', 'สำราญราษฎร์', '1001', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100105', 'ศาลเจ้าพ่อเสือ', '1001', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100106', 'เสาชิงช้า', '1001', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100107', 'บวรนิเวศ', '1001', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100108', 'ตลาดยอด', '1001', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100109', 'ชนะสงคราม', '1001', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100110', 'บ้านพานถม', '1001', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100111', 'บางขุนพรหม', '1001', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100112', 'วัดสามพระยา', '1001', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100201', 'ดุสิต', '1002', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100202', 'วชิรพยาบาล', '1002', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100203', 'สวนจิตรลดา', '1002', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100204', 'สี่แยกมหานาค', '1002', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100206', 'ถนนนครไชยศรี', '1002', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100301', 'กระทุ่มราย', '1003', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100302', 'หนองจอก', '1003', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100303', 'คลองสิบ', '1003', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100304', 'คลองสิบสอง', '1003', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100305', 'โคกแฝด', '1003', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100306', 'คู้ฝั่งเหนือ', '1003', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100307', 'ลำผักชี', '1003', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100308', 'ลำต้อยติ่ง', '1003', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100401', 'มหาพฤฒาราม', '1004', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100402', 'สีลม', '1004', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100403', 'สุริวงศ์', '1004', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100404', 'บางรัก', '1004', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100405', 'สี่พระยา', '1004', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100502', 'อนุสาวรีย์', '1005', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100508', 'ท่าแร้ง', '1005', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100601', 'คลองจั่น', '1006', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100608', 'หัวหมาก', '1006', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100701', 'รองเมือง', '1007', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100702', 'วังใหม่', '1007', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100703', 'ปทุมวัน', '1007', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100704', 'ลุมพินี', '1007', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100801', 'ป้อมปราบ', '1008', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100802', 'วัดเทพศิรินทร์', '1008', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100803', 'คลองมหานาค', '1008', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100804', 'บ้านบาตร', '1008', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100805', 'วัดโสมนัส', '1008', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('100905', 'บางจาก', '1009', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101001', 'มีนบุรี', '1010', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101002', 'แสนแสบ', '1010', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101101', 'ลาดกระบัง', '1011', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101102', 'คลองสองต้นนุ่น', '1011', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101103', 'คลองสามประเวศ', '1011', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101104', 'ลำปลาทิว', '1011', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101105', 'ทับยาว', '1011', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101106', 'ขุมทอง', '1011', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101203', 'ช่องนนทรี', '1012', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101204', 'บางโพงพาง', '1012', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101301', 'จักรวรรดิ', '1013', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101302', 'สัมพันธวงศ์', '1013', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101303', 'ตลาดน้อย', '1013', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101401', 'สามเสนใน', '1014', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101501', 'วัดกัลยาณ์', '1015', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101502', 'หิรัญรูจี', '1015', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101503', 'บางยี่เรือ', '1015', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101504', 'บุคคโล', '1015', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101505', 'ตลาดพลู', '1015', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101601', 'วัดอรุณ', '1016', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101602', 'วัดท่าพระ', '1016', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101701', 'ห้วยขวาง', '1017', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101702', 'บางกะปิ', '1017', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101704', 'สามเสนนอก', '1017', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101801', 'สมเด็จเจ้าพระยา', '1018', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101802', 'คลองสาน', '1018', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101803', 'บางลำภูล่าง', '1018', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101804', 'คลองต้นไทร', '1018', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101901', 'คลองชักพระ', '1019', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101902', 'ตลิ่งชัน', '1019', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101903', 'ฉิมพลี', '1019', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101904', 'บางพรม', '1019', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101905', 'บางระมาด', '1019', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('101907', 'บางเชือกหนัง', '1019', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102004', 'ศิริราช', '1020', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102005', 'บ้านช่างหล่อ', '1020', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102006', 'บางขุนนนท์', '1020', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102007', 'บางขุนศรี', '1020', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102009', 'อรุณอมรินทร์', '1020', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102105', 'ท่าข้าม', '1021', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102107', 'แสมดำ', '1021', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102201', 'บางหว้า', '1022', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102202', 'บางด้วน', '1022', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102206', 'บางจาก', '1022', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102207', 'บางแวก', '1022', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102208', 'คลองขวาง', '1022', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102209', 'ปากคลองภาษีเจริญ', '1022', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102210', 'คูหาสวรรค์', '1022', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102302', 'หนองแขม', '1023', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102303', 'หนองค้างพลู', '1023', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102401', 'ราษฎร์บูรณะ', '1024', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102402', 'บางปะกอก', '1024', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102501', 'บางพลัด', '1025', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102502', 'บางอ้อ', '1025', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102503', 'บางบำหรุ', '1025', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102504', 'บางยี่ขัน', '1025', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102601', 'ดินแดง', '1026', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102701', 'คลองกุ่ม', '1027', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102801', 'ทุ่งวัดดอน', '1028', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102802', 'ยานนาวา', '1028', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102803', 'ทุ่งมหาเมฆ', '1028', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('102901', 'บางซื่อ', '1029', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103001', 'ลาดยาว', '1030', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103101', 'บางคอแหลม', '1031', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103102', 'วัดพระยาไกร', '1031', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103103', 'บางโคล่', '1031', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103201', 'ประเวศ', '1032', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103202', 'หนองบอน', '1032', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103203', 'ดอกไม้', '1032', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103204', 'สวนหลวง', '1032', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103301', 'คลองเตย', '1033', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103302', 'คลองตัน', '1033', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103303', 'พระโขนง', '1033', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103401', 'สวนหลวง', '1034', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103501', 'บางขุนเทียน', '1035', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103502', 'บางค้อ', '1035', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103503', 'บางมด', '1035', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103504', 'จอมทอง', '1035', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103602', 'สีกัน', '1036', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103701', 'ทุ่งพญาไท', '1037', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103702', 'ถนนพญาไท', '1037', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103703', 'ถนนเพชรบุรี', '1037', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103704', 'มักกะสัน', '1037', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103801', 'ลาดพร้าว', '1038', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103802', 'จรเข้บัว', '1038', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103901', 'คลองเตยเหนือ', '1039', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103902', 'คลองตันเหนือ', '1039', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('103903', 'พระโขนงเหนือ', '1039', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104001', 'บางแค', '1040', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104002', 'บางแคเหนือ', '1040', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104003', 'บางไผ่', '1040', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104004', 'หลักสอง', '1040', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104101', 'ทุ่งสองห้อง', '1041', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104102', 'ตลาดบางเขน', '1041', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104201', 'สายไหม', '1042', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104202', 'ออเงิน', '1042', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104203', 'คลองถนน', '1042', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104301', 'คันนายาว', '1043', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104401', 'สะพานสูง', '1044', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104501', 'วังทองหลาง', '1045', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104601', 'สามวาตะวันตก', '1046', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104602', 'สามวาตะวันออก', '1046', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104603', 'บางชัน', '1046', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104604', 'ทรายกองดิน', '1046', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104605', 'ทรายกองดินใต้', '1046', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104701', 'บางนา', '1047', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104801', 'ทวีวัฒนา', '1048', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104802', 'ศาลาธรรมสพน์', '1048', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104901', 'บางมด', '1049', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('104902', 'ทุ่งครุ', '1049', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('105001', 'บางบอน', '1050', ' ', '10', ' ');
INSERT INTO `ref_tambol` VALUES ('110101', 'สวนใหญ่', '1101', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110102', 'ตลาดขวัญ', '1101', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110103', 'บางเขน', '1101', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110104', 'บางกระสอ', '1101', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110105', 'ท่าทราย', '1101', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110106', 'บางไผ่', '1101', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110107', 'บางศรีเมือง', '1101', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110108', 'บางกร่าง', '1101', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110109', 'ไทรม้า', '1101', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110110', 'บางรักน้อย', '1101', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110201', 'วัดชลอ', '1102', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110202', 'บางกรวย', '1102', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110203', 'บางสีทอง', '1102', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110204', 'บางขนุน', '1102', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110205', 'บางขุนกอง', '1102', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110206', 'บางคูเวียง', '1102', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110207', 'มหาสวัสดิ์', '1102', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110208', 'ปลายบาง', '1102', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110209', 'ศาลากลาง', '1102', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110301', 'บางม่วง', '1103', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110302', 'บางแม่นาง', '1103', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110303', 'บางเลน', '1103', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110304', 'เสาธงหิน', '1103', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110305', 'บางใหญ่', '1103', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110306', 'บ้านใหม่', '1103', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110401', 'โสนลอย', '1104', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110402', 'บางบัวทอง', '1104', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110403', 'บางรักใหญ่', '1104', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110404', 'บางคูรัด', '1104', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110405', 'ละหาร', '1104', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110406', 'ลำโพ', '1104', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110407', 'พิมลราช', '1104', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110408', 'บางรักพัฒนา', '1104', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110501', 'ไทรน้อย', '1105', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110502', 'ราษฎร์นิยม', '1105', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110503', 'หนองเพรางาย', '1105', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110504', 'ไทรใหญ่', '1105', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110505', 'ขุนศรี', '1105', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110506', 'คลองขวาง', '1105', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110507', 'ทวีวัฒนา', '1105', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110601', 'ปากเกร็ด', '1106', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110602', 'บางตลาด', '1106', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110603', 'บ้านใหม่', '1106', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110604', 'บางพูด', '1106', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110605', 'บางตะไนย์', '1106', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110606', 'คลองพระอุดม', '1106', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110607', 'ท่าอิฐ', '1106', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110608', 'เกาะเกร็ด', '1106', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110609', 'อ้อมเกร็ด', '1106', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110610', 'คลองข่อย', '1106', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110611', 'บางพลับ', '1106', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('110612', 'คลองเกลือ', '1106', ' ', '11', ' ');
INSERT INTO `ref_tambol` VALUES ('120101', 'บางปรอก', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120102', 'บ้านใหม่', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120103', 'บ้านกลาง', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120104', 'บ้านฉาง', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120105', 'บ้านกระแชง', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120106', 'บางขะแยง', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120107', 'บางคูวัด', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120108', 'บางหลวง', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120109', 'บางเดื่อ', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120110', 'บางพูด', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120111', 'บางพูน', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120112', 'บางกะดี', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120113', 'สวนพริกไทย', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120114', 'หลักหก', '1201', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120201', 'คลองหนึ่ง', '1202', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120202', 'คลองสอง', '1202', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120203', 'คลองสาม', '1202', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120204', 'คลองสี่', '1202', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120205', 'คลองห้า', '1202', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120206', 'คลองหก', '1202', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120207', 'คลองเจ็ด', '1202', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120301', 'ประชาธิปัตย์', '1203', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120302', 'บึงยี่โถ', '1203', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120303', 'รังสิต', '1203', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120304', 'ลำผักกูด', '1203', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120305', 'บึงสนั่น', '1203', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120306', 'บึงน้ำรักษ์', '1203', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120401', 'บึงบา', '1204', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120402', 'บึงบอน', '1204', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120403', 'บึงกาสาม', '1204', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120404', 'บึงชำอ้อ', '1204', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120405', 'หนองสามวัง', '1204', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120406', 'ศาลาครุ', '1204', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120407', 'นพรัตน์', '1204', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120501', 'ระแหง', '1205', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120502', 'ลาดหลุมแก้ว', '1205', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120503', 'คูบางหลวง', '1205', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120504', 'คูขวาง', '1205', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120505', 'คลองพระอุดม', '1205', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120506', 'บ่อเงิน', '1205', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120507', 'หน้าไม้', '1205', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120601', 'คูคต', '1206', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120602', 'ลาดสวาย', '1206', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120603', 'บึงคำพร้อย', '1206', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120604', 'ลำลูกกา', '1206', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120605', 'บึงทองหลาง', '1206', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120606', 'ลำไทร', '1206', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120607', 'บึงคอไห', '1206', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120608', 'พืชอุดม', '1206', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120701', 'บางเตย', '1207', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120702', 'คลองควาย', '1207', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120703', 'สามโคก', '1207', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120704', 'กระแชง', '1207', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120705', 'บางโพธิ์เหนือ', '1207', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120706', 'เชียงรากใหญ่', '1207', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120707', 'บ้านปทุม', '1207', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120708', 'บ้านงิ้ว', '1207', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120709', 'เชียงรากน้อย', '1207', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120710', 'บางกระบือ', '1207', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('120711', 'ท้ายเกาะ', '1207', ' ', '12', ' ');
INSERT INTO `ref_tambol` VALUES ('130101', 'ประตูชัย', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130102', 'กะมัง', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130103', 'หอรัตนไชย', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130104', 'หัวรอ', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130105', 'ท่าวาสุกรี', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130106', 'ไผ่ลิง', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130107', 'ปากกราน', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130108', 'ภูเขาทอง', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130109', 'สำเภาล่ม', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130110', 'สวนพริก', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130111', 'คลองตะเคียน', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130112', 'วัดตูม', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130113', 'หันตรา', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130114', 'ลุมพลี', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130115', 'บ้านใหม่', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130116', 'บ้านเกาะ', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130117', 'คลองสวนพลู', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130118', 'คลองสระบัว', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130119', 'เกาะเรียน', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130120', 'บ้านป้อม', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130121', 'บ้านรุน', '1301', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130201', 'ท่าเรือ', '1302', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130202', 'จำปา', '1302', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130203', 'ท่าหลวง', '1302', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130204', 'บ้านร่อม', '1302', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130205', 'ศาลาลอย', '1302', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130206', 'วังแดง', '1302', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130207', 'โพธิ์เอน', '1302', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130208', 'ปากท่า', '1302', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130209', 'หนองขนาก', '1302', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130210', 'ท่าเจ้าสนุก', '1302', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130301', 'นครหลวง', '1303', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130302', 'ท่าช้าง', '1303', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130303', 'บ่อโพง', '1303', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130304', 'บ้านชุ้ง', '1303', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130305', 'ปากจั่น', '1303', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130306', 'บางระกำ', '1303', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130307', 'บางพระครู', '1303', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130308', 'แม่ลา', '1303', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130309', 'หนองปลิง', '1303', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130310', 'คลองสะแก', '1303', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130311', 'สามไถ', '1303', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130312', 'พระนอน', '1303', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130401', 'บางไทร', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130402', 'บางพลี', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130403', 'สนามชัย', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130404', 'บ้านแป้ง', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130405', 'หน้าไม้', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130406', 'บางยี่โท', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130407', 'แคออก', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130408', 'แคตก', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130409', 'ช่างเหล็ก', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130410', 'กระแชง', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130411', 'บ้านกลึง', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130412', 'ช้างน้อย', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130413', 'ห่อหมก', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130414', 'ไผ่พระ', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130415', 'กกแก้วบูรพา', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130416', 'ไม้ตรา', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130417', 'บ้านม้า', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130418', 'บ้านเกาะ', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130419', 'ราชคราม', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130420', 'ช้างใหญ่', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130421', 'โพแตง', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130422', 'เชียงรากน้อย', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130423', 'โคกช้าง', '1304', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130501', 'บางบาล', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130502', 'วัดยม', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130503', 'ไทรน้อย', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130504', 'สะพานไทย', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130505', 'มหาพราหมณ์', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130506', 'กบเจา', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130507', 'บ้านคลัง', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130508', 'พระขาว', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130509', 'น้ำเต้า', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130510', 'ทางช้าง', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130511', 'วัดตะกู', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130512', 'บางหลวง', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130513', 'บางหลวงโดด', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130514', 'บางหัก', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130515', 'บางชะนี', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130516', 'บ้านกุ่ม', '1305', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130601', 'บ้านเลน', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130602', 'เชียงรากน้อย', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130603', 'บ้านโพ', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130604', 'บ้านกรด', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130605', 'บางกระสั้น', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130606', 'คลองจิก', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130607', 'บ้านหว้า', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130608', 'วัดยม', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130609', 'บางประแดง', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130610', 'สามเรือน', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130611', 'เกาะเกิด', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130612', 'บ้านพลับ', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130613', 'บ้านแป้ง', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130614', 'คุ้งลาน', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130615', 'ตลิ่งชัน', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130616', 'บ้านสร้าง', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130617', 'ตลาดเกรียบ', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130618', 'ขนอนหลวง', '1306', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130701', 'บางปะหัน', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130702', 'ขยาย', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130703', 'บางเดื่อ', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130704', 'เสาธง', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130705', 'ทางกลาง', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130706', 'บางเพลิง', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130707', 'หันสัง', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130708', 'บางนางร้า', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130709', 'ตานิม', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130710', 'ทับน้ำ', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130711', 'บ้านม้า', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130712', 'ขวัญเมือง', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130713', 'บ้านลี่', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130714', 'โพธิ์สามต้น', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130715', 'พุทเลา', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130716', 'ตาลเอน', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130717', 'บ้านขล้อ', '1307', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130801', 'ผักไห่', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130802', 'อมฤต', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130803', 'บ้านแค', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130804', 'ลาดน้ำเค็ม', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130805', 'ตาลาน', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130806', 'ท่าดินแดง', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130807', 'ดอนลาน', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130808', 'นาคู', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130809', 'กุฎี', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130810', 'ลำตะเคียน', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130811', 'โคกช้าง', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130812', 'จักราช', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130813', 'หนองน้ำใหญ่', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130814', 'ลาดชิด', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130815', 'หน้าโคก', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130816', 'บ้านใหญ่', '1308', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130901', 'ภาชี', '1309', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130902', 'โคกม่วง', '1309', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130903', 'ระโสม', '1309', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130904', 'หนองน้ำใส', '1309', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130905', 'ดอนหญ้านาง', '1309', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130906', 'ไผ่ล้อม', '1309', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130907', 'กระจิว', '1309', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('130908', 'พระแก้ว', '1309', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131001', 'ลาดบัวหลวง', '1310', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131002', 'หลักชัย', '1310', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131003', 'สามเมือง', '1310', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131004', 'พระยาบันลือ', '1310', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131005', 'สิงหนาท', '1310', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131006', 'คู้สลอด', '1310', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131007', 'คลองพระยาบันลือ', '1310', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131101', 'ลำตาเสา', '1311', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131102', 'บ่อตาโล่', '1311', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131103', 'วังน้อย', '1311', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131104', 'ลำไทร', '1311', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131105', 'สนับทึบ', '1311', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131106', 'พยอม', '1311', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131107', 'หันตะเภา', '1311', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131108', 'วังจุฬา', '1311', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131109', 'ข้าวงาม', '1311', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131110', 'ชะแมบ', '1311', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131201', 'เสนา', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131202', 'บ้านแพน', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131203', 'เจ้าเจ็ด', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131204', 'สามกอ', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131205', 'บางนมโค', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131206', 'หัวเวียง', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131207', 'มารวิชัย', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131208', 'บ้านโพธิ์', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131209', 'รางจรเข้', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131210', 'บ้านกระทุ่ม', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131211', 'บ้านแถว', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131212', 'ชายนา', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131213', 'สามตุ่ม', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131214', 'ลาดงา', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131215', 'ดอนทอง', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131216', 'บ้านหลวง', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131217', 'เจ้าเสด็จ', '1312', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131301', 'บางซ้าย', '1313', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131302', 'แก้วฟ้า', '1313', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131303', 'เต่าเล่า', '1313', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131304', 'ปลายกลัด', '1313', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131305', 'เทพมงคล', '1313', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131306', 'วังพัฒนา', '1313', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131401', 'คานหาม', '1314', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131402', 'บ้านช้าง', '1314', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131403', 'สามบัณฑิต', '1314', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131404', 'บ้านหีบ', '1314', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131405', 'หนองไม้ซุง', '1314', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131406', 'อุทัย', '1314', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131407', 'เสนา', '1314', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131408', 'หนองน้ำส้ม', '1314', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131409', 'โพสาวหาญ', '1314', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131410', 'ธนู', '1314', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131411', 'ข้าวเม่า', '1314', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131501', 'หัวไผ่', '1315', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131502', 'กะทุ่ม', '1315', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131503', 'มหาราช', '1315', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131504', 'น้ำเต้า', '1315', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131505', 'บางนา', '1315', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131506', 'โรงช้าง', '1315', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131507', 'เจ้าปลุก', '1315', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131508', 'พิตเพียน', '1315', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131509', 'บ้านนา', '1315', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131510', 'บ้านขวาง', '1315', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131511', 'ท่าตอ', '1315', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131512', 'บ้านใหม่', '1315', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131601', 'บ้านแพรก', '1316', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131602', 'บ้านใหม่', '1316', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131603', 'สำพะเนียง', '1316', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131604', 'คลองน้อย', '1316', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('131605', 'สองห้อง', '1316', ' ', '13', ' ');
INSERT INTO `ref_tambol` VALUES ('140101', 'ตลาดหลวง', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140102', 'บางแก้ว', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140103', 'ศาลาแดง', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140104', 'ป่างิ้ว', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140105', 'บ้านแห', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140106', 'ตลาดกรวด', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140107', 'มหาดไทย', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140108', 'บ้านอิฐ', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140109', 'หัวไผ่', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140110', 'จำปาหล่อ', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140111', 'โพสะ', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140112', 'บ้านรี', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140113', 'คลองวัว', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140114', 'ย่านซื่อ', '1401', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140201', 'จรเข้ร้อง', '1402', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140202', 'ไชยภูมิ', '1402', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140203', 'ชัยฤทธิ์', '1402', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140204', 'เทวราช', '1402', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140205', 'ราชสถิตย์', '1402', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140206', 'ไชโย', '1402', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140207', 'หลักฟ้า', '1402', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140208', 'ชะไว', '1402', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140209', 'ตรีณรงค์', '1402', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140301', 'บางปลากด', '1403', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140302', 'ป่าโมก', '1403', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140303', 'สายทอง', '1403', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140304', 'โรงช้าง', '1403', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140305', 'บางเสด็จ', '1403', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140306', 'นรสิงห์', '1403', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140307', 'เอกราช', '1403', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140308', 'โผงเผง', '1403', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140401', 'อ่างแก้ว', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140402', 'อินทประมูล', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140403', 'บางพลับ', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140404', 'หนองแม่ไก่', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140405', 'รำมะสัก', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140406', 'บางระกำ', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140407', 'โพธิ์รังนก', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140408', 'องครักษ์', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140409', 'โคกพุทรา', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140410', 'ยางช้าย', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140411', 'บ่อแร่', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140412', 'ทางพระ', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140413', 'สามง่าม', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140414', 'บางเจ้าฉ่า', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140415', 'คำหยาด', '1404', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140501', 'แสวงหา', '1405', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140502', 'ศรีพราน', '1405', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140503', 'บ้านพราน', '1405', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140504', 'วังน้ำเย็น', '1405', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140505', 'สีบัวทอง', '1405', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140506', 'ห้วยไผ่', '1405', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140507', 'จำลอง', '1405', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140601', 'ไผ่จำศิล', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140602', 'ศาลเจ้าโรงทอง', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140603', 'ไผ่ดำพัฒนา', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140604', 'สาวร้องไห้', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140605', 'ท่าช้าง', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140606', 'ยี่ล้น', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140607', 'บางจัก', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140608', 'ห้วยคันแหลน', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140609', 'คลองขนาก', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140610', 'ไผ่วง', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140611', 'สี่ร้อย', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140612', 'ม่วงเตี้ย', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140613', 'หัวตะพาน', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140614', 'หลักแก้ว', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140615', 'ตลาดใหม่', '1406', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140701', 'สามโก้', '1407', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140702', 'ราษฎรพัฒนา', '1407', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140703', 'อบทม', '1407', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140704', 'โพธิ์ม่วงพันธ์', '1407', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('140705', 'มงคลธรรมนิมิต', '1407', ' ', '14', ' ');
INSERT INTO `ref_tambol` VALUES ('150101', 'ทะเลชุบศร', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150102', 'ท่าหิน', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150103', 'กกโก', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150104', 'โก่งธนู', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150105', 'เขาพระงาม', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150106', 'เขาสามยอด', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150107', 'โคกกะเทียม', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150108', 'โคกลำพาน', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150109', 'โคกตูม', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150110', 'งิ้วราย', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150111', 'ดอนโพธิ์', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150112', 'ตะลุง', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150114', 'ท่าแค', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150115', 'ท่าศาลา', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150116', 'นิคมสร้างตนเอง', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150117', 'บางขันหมาก', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150118', 'บ้านข่อย', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150119', 'ท้ายตลาด', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150120', 'ป่าตาล', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150121', 'พรหมมาสตร์', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150122', 'โพธิ์เก้าต้น', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150123', 'โพธิ์ตรุ', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150124', 'สี่คลอง', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150125', 'ถนนใหญ่', '1501', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150201', 'พัฒนานิคม', '1502', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150202', 'ช่องสาริกา', '1502', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150203', 'มะนาวหวาน', '1502', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150204', 'ดีลัง', '1502', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150205', 'โคกสลุง', '1502', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150206', 'ชอนน้อย', '1502', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150207', 'หนองบัว', '1502', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150208', 'ห้วยขุนราม', '1502', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150209', 'น้ำสุด', '1502', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150301', 'โคกสำโรง', '1503', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150302', 'เกาะแก้ว', '1503', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150303', 'ถลุงเหล็ก', '1503', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150304', 'หลุมข้าว', '1503', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150305', 'ห้วยโป่ง', '1503', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150306', 'คลองเกตุ', '1503', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150307', 'สะแกราบ', '1503', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150308', 'เพนียด', '1503', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150309', 'วังเพลิง', '1503', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150310', 'ดงมะรุม', '1503', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150318', 'วังขอนขว้าง', '1503', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150320', 'วังจั่น', '1503', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150322', 'หนองแขม', '1503', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150401', 'ลำนารายณ์', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150402', 'ชัยนารายณ์', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150403', 'ศิลาทิพย์', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150404', 'ห้วยหิน', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150405', 'ม่วงค่อม', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150406', 'บัวชุม', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150407', 'ท่าดินดำ', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150408', 'มะกอกหวาน', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150409', 'ซับตะเคียน', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150410', 'นาโสม', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150411', 'หนองยายโต๊ะ', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150412', 'เกาะรัง', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150414', 'ท่ามะนาว', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150417', 'นิคมลำนารายณ์', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150418', 'ชัยบาดาล', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150419', 'บ้านใหม่สามัคคี', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150422', 'เขาแหลม', '1504', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150501', 'ท่าวุ้ง', '1505', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150502', 'บางคู้', '1505', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150503', 'โพตลาดแก้ว', '1505', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150504', 'บางลี่', '1505', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150505', 'บางงา', '1505', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150506', 'โคกสลุด', '1505', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150507', 'เขาสมอคอน', '1505', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150508', 'หัวสำโรง', '1505', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150509', 'ลาดสาลี่', '1505', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150510', 'บ้านเบิก', '1505', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150511', 'มุจลินท์', '1505', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150601', 'ไผ่ใหญ่', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150602', 'บ้านทราย', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150603', 'บ้านกล้วย', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150604', 'ดงพลับ', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150605', 'บ้านชี', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150606', 'พุคา', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150607', 'หินปัก', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150608', 'บางพึ่ง', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150609', 'หนองทรายขาว', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150610', 'บางกะพี้', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150611', 'หนองเต่า', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150612', 'โพนทอง', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150613', 'บางขาม', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150614', 'ดอนดึง', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150615', 'ชอนม่วง', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150616', 'หนองกระเบียน', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150617', 'สายห้วยแก้ว', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150618', 'มหาสอน', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150619', 'บ้านหมี่', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150620', 'เชียงงา', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150621', 'หนองเมือง', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150622', 'สนามแจง', '1506', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150701', 'ท่าหลวง', '1507', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150702', 'แก่งผักกูด', '1507', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150703', 'ซับจำปา', '1507', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150704', 'หนองผักแว่น', '1507', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150705', 'ทะเลวังวัด', '1507', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150706', 'หัวลำ', '1507', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150801', 'สระโบสถ์', '1508', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150802', 'มหาโพธิ', '1508', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150803', 'ทุ่งท่าช้าง', '1508', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150804', 'ห้วยใหญ่', '1508', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150805', 'นิยมชัย', '1508', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150901', 'โคกเจริญ', '1509', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150902', 'ยางราก', '1509', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150903', 'หนองมะค่า', '1509', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150904', 'วังทอง', '1509', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('150905', 'โคกแสมสาร', '1509', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('151001', 'ลำสนธิ', '1510', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('151002', 'ซับสมบูรณ์', '1510', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('151003', 'หนองรี', '1510', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('151004', 'กุดตาเพชร', '1510', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('151005', 'เขารวก', '1510', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('151006', 'เขาน้อย', '1510', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('151101', 'หนองม่วง', '1511', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('151102', 'บ่อทอง', '1511', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('151103', 'ดงดินแดง', '1511', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('151104', 'ชอนสมบูรณ์', '1511', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('151105', 'ยางโทน', '1511', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('151106', 'ชอนสารเดช', '1511', ' ', '15', ' ');
INSERT INTO `ref_tambol` VALUES ('160101', 'บางพุทรา', '1601', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160102', 'บางมัญ', '1601', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160103', 'โพกรวม', '1601', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160104', 'ม่วงหมู่', '1601', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160105', 'หัวไผ่', '1601', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160106', 'ต้นโพธิ์', '1601', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160107', 'จักรสีห์', '1601', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160108', 'บางกระบือ', '1601', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160201', 'สิงห์', '1602', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160202', 'ไม้ดัด', '1602', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160203', 'เชิงกลัด', '1602', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160204', 'โพชนไก่', '1602', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160205', 'แม่ลา', '1602', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160206', 'บ้านจ่า', '1602', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160207', 'พักทัน', '1602', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160208', 'สระแจง', '1602', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160301', 'โพทะเล', '1603', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160302', 'บางระจัน', '1603', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160303', 'โพสังโฆ', '1603', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160304', 'ท่าข้าม', '1603', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160305', 'คอทราย', '1603', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160306', 'หนองกระทุ่ม', '1603', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160401', 'พระงาม', '1604', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160402', 'พรหมบุรี', '1604', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160403', 'บางน้ำเชี่ยว', '1604', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160404', 'บ้านหม้อ', '1604', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160405', 'บ้านแป้ง', '1604', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160406', 'หัวป่า', '1604', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160407', 'โรงช้าง', '1604', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160501', 'ถอนสมอ', '1605', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160502', 'โพประจักษ์', '1605', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160503', 'วิหารขาว', '1605', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160504', 'พิกุลทอง', '1605', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160601', 'อินทร์บุรี', '1606', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160602', 'ประศุก', '1606', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160603', 'ทับยา', '1606', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160604', 'งิ้วราย', '1606', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160605', 'ชีน้ำร้าย', '1606', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160606', 'ท่างาม', '1606', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160607', 'น้ำตาล', '1606', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160608', 'ทองเอน', '1606', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160609', 'ห้วยชัน', '1606', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('160610', 'โพธิ์ชัย', '1606', ' ', '16', ' ');
INSERT INTO `ref_tambol` VALUES ('170101', 'ในเมือง', '1701', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170102', 'บ้านกล้วย', '1701', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170103', 'ท่าชัย', '1701', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170104', 'ชัยนาท', '1701', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170105', 'เขาท่าพระ', '1701', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170106', 'หาดท่าเสา', '1701', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170107', 'ธรรมามูล', '1701', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170108', 'เสือโฮก', '1701', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170109', 'นางลือ', '1701', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170201', 'คุ้งสำเภา', '1702', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170202', 'วัดโคก', '1702', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170203', 'ศิลาดาน', '1702', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170204', 'ท่าฉนวน', '1702', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170205', 'หางน้ำสาคร', '1702', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170206', 'ไร่พัฒนา', '1702', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170207', 'อู่ตะเภา', '1702', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170301', 'วัดสิงห์', '1703', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170302', 'มะขามเฒ่า', '1703', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170303', 'หนองน้อย', '1703', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170304', 'หนองบัว', '1703', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170306', 'หนองขุ่น', '1703', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170307', 'บ่อแร่', '1703', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170311', 'วังหมัน', '1703', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170401', 'สรรพยา', '1704', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170402', 'ตลุก', '1704', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170403', 'เขาแก้ว', '1704', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170404', 'โพนางดำตก', '1704', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170405', 'โพนางดำออก', '1704', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170406', 'บางหลวง', '1704', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170407', 'หาดอาษา', '1704', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170501', 'แพรกศรีราชา', '1705', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170502', 'เที่ยงแท้', '1705', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170503', 'ห้วยกรด', '1705', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170504', 'โพงาม', '1705', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170505', 'บางขุด', '1705', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170506', 'ดงคอน', '1705', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170507', 'ดอนกำ', '1705', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170508', 'ห้วยกรดพัฒนา', '1705', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170601', 'หันคา', '1706', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170602', 'บ้านเชี่ยน', '1706', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170605', 'ไพรนกยูง', '1706', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170606', 'หนองแซง', '1706', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170607', 'ห้วยงู', '1706', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170608', 'วังไก่เถื่อน', '1706', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170609', 'เด่นใหญ่', '1706', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170611', 'สามง่ามท่าโบสถ์', '1706', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170701', 'หนองมะโมง', '1707', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170702', 'วังตะเคียน', '1707', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170703', 'สะพานหิน', '1707', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170704', 'กุดจอก', '1707', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170801', 'เนินขาม', '1708', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170802', 'กะบกเตี้ย', '1708', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('170803', 'สุขเดือนห้า', '1708', ' ', '17', ' ');
INSERT INTO `ref_tambol` VALUES ('180101', 'ปากเพรียว', '1801', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180105', 'ดาวเรือง', '1801', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180106', 'นาโฉง', '1801', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180107', 'โคกสว่าง', '1801', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180108', 'หนองโน', '1801', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180109', 'หนองยาว', '1801', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180110', 'ปากข้าวสาร', '1801', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180111', 'หนองปลาไหล', '1801', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180112', 'กุดนกเปล้า', '1801', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180113', 'ตลิ่งชัน', '1801', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180114', 'ตะกุด', '1801', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180201', 'แก่งคอย', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180202', 'ทับกวาง', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180203', 'ตาลเดี่ยว', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180204', 'ห้วยแห้ง', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180205', 'ท่าคล้อ', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180206', 'หินซ้อน', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180207', 'บ้านธาตุ', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180208', 'บ้านป่า', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180209', 'ท่าตูม', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180210', 'ชะอม', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180211', 'สองคอน', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180212', 'เตาปูน', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180213', 'ชำผักแพว', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180215', 'ท่ามะปราง', '1802', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180301', 'หนองแค', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180302', 'กุ่มหัก', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180303', 'คชสิทธิ์', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180304', 'โคกตูม', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180305', 'โคกแย้', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180306', 'บัวลอย', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180307', 'ไผ่ต่ำ', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180308', 'โพนทอง', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180309', 'ห้วยขมิ้น', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180310', 'ห้วยทราย', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180311', 'หนองไข่น้ำ', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180312', 'หนองแขม', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180313', 'หนองจิก', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180314', 'หนองจรเข้', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180315', 'หนองนาก', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180316', 'หนองปลาหมอ', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180317', 'หนองปลิง', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180318', 'หนองโรง', '1803', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180401', 'หนองหมู', '1804', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180402', 'บ้านลำ', '1804', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180403', 'คลองเรือ', '1804', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180404', 'วิหารแดง', '1804', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180405', 'หนองสรวง', '1804', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180406', 'เจริญธรรม', '1804', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180501', 'หนองแซง', '1805', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180502', 'หนองควายโซ', '1805', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180503', 'หนองหัวโพ', '1805', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180504', 'หนองสีดา', '1805', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180505', 'หนองกบ', '1805', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180506', 'ไก่เส่า', '1805', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180507', 'โคกสะอาด', '1805', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180508', 'ม่วงหวาน', '1805', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180509', 'เขาดิน', '1805', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180601', 'บ้านหมอ', '1806', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180602', 'บางโขมด', '1806', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180603', 'สร่างโศก', '1806', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180604', 'ตลาดน้อย', '1806', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180605', 'หรเทพ', '1806', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180606', 'โคกใหญ่', '1806', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180607', 'ไผ่ขวาง', '1806', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180608', 'บ้านครัว', '1806', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180609', 'หนองบัว', '1806', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180701', 'ดอนพุด', '1807', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180702', 'ไผ่หลิ่ว', '1807', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180703', 'บ้านหลวง', '1807', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180704', 'ดงตะงาว', '1807', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180801', 'หนองโดน', '1808', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180802', 'บ้านกลับ', '1808', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180803', 'ดอนทอง', '1808', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180804', 'บ้านโปร่ง', '1808', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180901', 'พระพุทธบาท', '1809', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180902', 'ขุนโขลน', '1809', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180903', 'ธารเกษม', '1809', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180904', 'นายาว', '1809', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180905', 'พุคำจาน', '1809', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180906', 'เขาวง', '1809', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180907', 'ห้วยป่าหวาย', '1809', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180908', 'พุกร่าง', '1809', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('180909', 'หนองแก', '1809', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181001', 'เสาไห้', '1810', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181002', 'บ้านยาง', '1810', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181003', 'หัวปลวก', '1810', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181004', 'งิ้วงาม', '1810', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181005', 'ศาลารีไทย', '1810', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181006', 'ต้นตาล', '1810', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181007', 'ท่าช้าง', '1810', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181008', 'พระยาทด', '1810', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181009', 'ม่วงงาม', '1810', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181010', 'เริงราง', '1810', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181011', 'เมืองเก่า', '1810', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181012', 'สวนดอกไม้', '1810', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181101', 'มวกเหล็ก', '1811', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181102', 'มิตรภาพ', '1811', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181104', 'หนองย่างเสือ', '1811', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181105', 'ลำสมพุง', '1811', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181107', 'ลำพญากลาง', '1811', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181109', 'ซับสนุ่น', '1811', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181201', 'แสลงพัน', '1812', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181202', 'คำพราน', '1812', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181203', 'วังม่วง', '1812', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181301', 'เขาดินพัฒนา', '1813', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181302', 'บ้านแก้ง', '1813', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181303', 'ผึ้งรวง', '1813', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181304', 'พุแค', '1813', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181305', 'ห้วยบง', '1813', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('181306', 'หน้าพระลาน', '1813', ' ', '18', ' ');
INSERT INTO `ref_tambol` VALUES ('190101', 'ปากน้ำ', '1901', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190102', 'สำโรงเหนือ', '1901', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190103', 'บางเมือง', '1901', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190104', 'ท้ายบ้าน', '1901', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190108', 'บางปูใหม่', '1901', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190110', 'แพรกษา', '1901', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190111', 'บางโปรง', '1901', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190112', 'บางปู', '1901', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190113', 'บางด้วน', '1901', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190114', 'บางเมืองใหม่', '1901', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190115', 'เทพารักษ์', '1901', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190116', 'ท้ายบ้านใหม่', '1901', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190117', 'แพรกษาใหม่', '1901', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190201', 'บางบ่อ', '1902', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190202', 'บ้านระกาศ', '1902', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190203', 'บางพลีน้อย', '1902', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190204', 'บางเพรียง', '1902', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190205', 'คลองด่าน', '1902', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190206', 'คลองสวน', '1902', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190207', 'เปร็ง', '1902', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190208', 'คลองนิยมยาตรา', '1902', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190301', 'บางพลีใหญ่', '1903', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190302', 'บางแก้ว', '1903', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190303', 'บางปลา', '1903', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190304', 'บางโฉลง', '1903', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190308', 'ราชาเทวะ', '1903', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190309', 'หนองปรือ', '1903', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190401', 'ตลาด', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190402', 'บางพึ่ง', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190403', 'บางจาก', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190404', 'บางครุ', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190405', 'บางหญ้าแพรก', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190406', 'บางหัวเสือ', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190407', 'สำโรงใต้', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190408', 'บางยอ', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190409', 'บางกะเจ้า', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190410', 'บางน้ำผึ้ง', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190411', 'บางกระสอบ', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190412', 'บางกอบัว', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190413', 'ทรงคนอง', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190414', 'สำโรง', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190415', 'สำโรงกลาง', '1904', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190501', 'นาเกลือ', '1905', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190502', 'บ้านคลองสวน', '1905', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190503', 'แหลมฟ้าผ่า', '1905', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190504', 'ปากคลองบางปลากด', '1905', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190505', 'ในคลองบางปลากด', '1905', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190601', 'บางเสาธง', '1906', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190602', 'ศีรษะจรเข้น้อย', '1906', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('190603', 'ศีรษะจรเข้ใหญ่', '1906', ' ', '19', ' ');
INSERT INTO `ref_tambol` VALUES ('200101', 'บางปลาสร้อย', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200102', 'มะขามหย่ง', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200103', 'บ้านโขด', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200104', 'แสนสุข', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200105', 'บ้านสวน', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200106', 'หนองรี', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200107', 'นาป่า', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200108', 'หนองข้างคอก', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200109', 'ดอนหัวฬ่อ', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200110', 'หนองไม้แดง', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200111', 'บางทราย', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200112', 'คลองตำหรุ', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200113', 'เหมือง', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200114', 'บ้านปึก', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200115', 'ห้วยกะปิ', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200116', 'เสม็ด', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200117', 'อ่างศิลา', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200118', 'สำนักบก', '2001', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200201', 'บ้านบึง', '2002', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200202', 'คลองกิ่ว', '2002', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200203', 'มาบไผ่', '2002', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200204', 'หนองซ้ำซาก', '2002', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200205', 'หนองบอนแดง', '2002', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200206', 'หนองชาก', '2002', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200207', 'หนองอิรุณ', '2002', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200208', 'หนองไผ่แก้ว', '2002', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200301', 'หนองใหญ่', '2003', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200302', 'คลองพลู', '2003', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200303', 'หนองเสือช้าง', '2003', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200304', 'ห้างสูง', '2003', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200305', 'เขาซก', '2003', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200401', 'บางละมุง', '2004', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200402', 'หนองปรือ', '2004', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200403', 'หนองปลาไหล', '2004', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200404', 'โป่ง', '2004', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200405', 'เขาไม้แก้ว', '2004', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200406', 'ห้วยใหญ่', '2004', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200407', 'ตะเคียนเตี้ย', '2004', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200408', 'นาเกลือ', '2004', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200501', 'พานทอง', '2005', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200502', 'หนองตำลึง', '2005', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200503', 'มาบโป่ง', '2005', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200504', 'หนองกะขะ', '2005', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200505', 'หนองหงษ์', '2005', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200506', 'โคกขี้หนอน', '2005', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200507', 'บ้านเก่า', '2005', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200508', 'หน้าประดู่', '2005', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200509', 'บางนาง', '2005', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200510', 'เกาะลอย', '2005', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200511', 'บางหัก', '2005', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200601', 'พนัสนิคม', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200602', 'หน้าพระธาตุ', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200603', 'วัดหลวง', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200604', 'บ้านเซิด', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200605', 'นาเริก', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200606', 'หมอนนาง', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200607', 'สระสี่เหลี่ยม', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200608', 'วัดโบสถ์', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200609', 'กุฎโง้ง', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200610', 'หัวถนน', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200611', 'ท่าข้าม', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200613', 'หนองปรือ', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200614', 'หนองขยาด', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200615', 'ทุ่งขวาง', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200616', 'หนองเหียง', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200617', 'นาวังหิน', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200618', 'บ้านช้าง', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200620', 'โคกเพลาะ', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200621', 'ไร่หลักทอง', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200622', 'นามะตูม', '2006', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200701', 'ศรีราชา', '2007', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200702', 'สุรศักดิ์', '2007', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200703', 'ทุ่งสุขลา', '2007', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200704', 'บึง', '2007', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200705', 'หนองขาม', '2007', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200706', 'เขาคันทรง', '2007', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200707', 'บางพระ', '2007', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200708', 'บ่อวิน', '2007', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200801', 'ท่าเทววงษ์', '2008', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200901', 'สัตหีบ', '2009', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200902', 'นาจอมเทียน', '2009', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200903', 'พลูตาหลวง', '2009', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200904', 'บางเสร่', '2009', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('200905', 'แสมสาร', '2009', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('201001', 'บ่อทอง', '2010', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('201002', 'วัดสุวรรณ', '2010', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('201003', 'บ่อกวางทอง', '2010', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('201004', 'ธาตุทอง', '2010', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('201005', 'เกษตรสุวรรณ', '2010', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('201006', 'พลวงทอง', '2010', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('201101', 'เกาะจันทร์', '2011', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('201102', 'ท่าบุญมี', '2011', ' ', '20', ' ');
INSERT INTO `ref_tambol` VALUES ('210101', 'ท่าประดู่', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210102', 'เชิงเนิน', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210103', 'ตะพง', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210104', 'ปากน้ำ', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210105', 'เพ', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210106', 'แกลง', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210107', 'บ้านแลง', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210108', 'นาตาขวัญ', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210109', 'เนินพระ', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210110', 'กะเฉด', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210111', 'ทับมา', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210112', 'น้ำคอก', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210113', 'ห้วยโป่ง', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210114', 'มาบตาพุด', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210115', 'สำนักทอง', '2101', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210201', 'สำนักท้อน', '2102', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210202', 'พลา', '2102', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210203', 'บ้านฉาง', '2102', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210301', 'ทางเกวียน', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210302', 'วังหว้า', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210303', 'ชากโดน', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210304', 'เนินฆ้อ', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210305', 'กร่ำ', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210306', 'ชากพง', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210307', 'กระแสบน', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210308', 'บ้านนา', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210309', 'ทุ่งควายกิน', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210310', 'กองดิน', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210311', 'คลองปูน', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210312', 'พังราด', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210313', 'ปากน้ำกระแส', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210317', 'ห้วยยาง', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210318', 'สองสลึง', '2103', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210401', 'วังจันทร์', '2104', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210402', 'ชุมแสง', '2104', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210403', 'ป่ายุบใน', '2104', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210404', 'พลงตาเอี่ยม', '2104', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210501', 'บ้านค่าย', '2105', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210502', 'หนองละลอก', '2105', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210503', 'หนองตะพาน', '2105', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210504', 'ตาขัน', '2105', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210505', 'บางบุตร', '2105', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210506', 'หนองบัว', '2105', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210507', 'ชากบก', '2105', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210601', 'ปลวกแดง', '2106', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210602', 'ตาสิทธิ์', '2106', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210603', 'ละหาร', '2106', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210604', 'แม่น้ำคู้', '2106', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210605', 'มาบยางพร', '2106', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210606', 'หนองไร่', '2106', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210701', 'น้ำเป็น', '2107', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210702', 'ห้วยทับมอญ', '2107', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210703', 'ชำฆ้อ', '2107', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210704', 'เขาน้อย', '2107', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210801', 'นิคมพัฒนา', '2108', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210802', 'มาบข่า', '2108', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210803', 'พนานิคม', '2108', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('210804', 'มะขามคู่', '2108', ' ', '21', ' ');
INSERT INTO `ref_tambol` VALUES ('220101', 'ตลาด', '2201', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220102', 'วัดใหม่', '2201', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220103', 'คลองนารายณ์', '2201', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220104', 'เกาะขวาง', '2201', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220105', 'คมบาง', '2201', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220106', 'ท่าช้าง', '2201', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220107', 'จันทนิมิต', '2201', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220108', 'บางกะจะ', '2201', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220109', 'แสลง', '2201', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220110', 'หนองบัว', '2201', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220111', 'พลับพลา', '2201', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220201', 'ขลุง', '2202', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220202', 'บ่อ', '2202', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220203', 'เกวียนหัก', '2202', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220204', 'ตะปอน', '2202', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220205', 'บางชัน', '2202', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220206', 'วันยาว', '2202', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220207', 'ซึ้ง', '2202', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220208', 'มาบไพ', '2202', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220209', 'วังสรรพรส', '2202', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220210', 'ตรอกนอง', '2202', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220211', 'ตกพรม', '2202', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220212', 'บ่อเวฬุ', '2202', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220301', 'ท่าใหม่', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220302', 'ยายร้า', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220303', 'สีพยา', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220304', 'บ่อพุ', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220305', 'พลอยแหวน', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220306', 'เขาวัว', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220307', 'เขาบายศรี', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220308', 'สองพี่น้อง', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220309', 'ทุ่งเบญจา', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220311', 'รำพัน', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220312', 'โขมง', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220313', 'ตะกาดเง้า', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220314', 'คลองขุด', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220324', 'เขาแก้ว', '2203', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220401', 'ทับไทร', '2204', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220402', 'โป่งน้ำร้อน', '2204', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220404', 'หนองตาคง', '2204', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220409', 'เทพนิมิต', '2204', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220410', 'คลองใหญ่', '2204', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220501', 'มะขาม', '2205', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220502', 'ท่าหลวง', '2205', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220503', 'ปัถวี', '2205', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220504', 'วังแซ้ม', '2205', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220506', 'ฉมัน', '2205', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220508', 'อ่างคีรี', '2205', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220601', 'ปากน้ำแหลมสิงห์', '2206', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220602', 'เกาะเปริด', '2206', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220603', 'หนองชิ่ม', '2206', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220604', 'พลิ้ว', '2206', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220605', 'คลองน้ำเค็ม', '2206', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220606', 'บางสระเก้า', '2206', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220607', 'บางกะไชย', '2206', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220701', 'ปะตง', '2207', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220702', 'ทุ่งขนาน', '2207', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220703', 'ทับช้าง', '2207', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220704', 'ทรายขาว', '2207', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220705', 'สะตอน', '2207', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220801', 'แก่งหางแมว', '2208', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220802', 'ขุนซ่อง', '2208', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220803', 'สามพี่น้อง', '2208', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220804', 'พวา', '2208', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220805', 'เขาวงกต', '2208', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220901', 'นายายอาม', '2209', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220902', 'วังโตนด', '2209', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220903', 'กระแจะ', '2209', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220904', 'สนามไชย', '2209', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220905', 'ช้างข้าม', '2209', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('220906', 'วังใหม่', '2209', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('221001', 'ชากไทย', '2210', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('221002', 'พลวง', '2210', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('221003', 'ตะเคียนทอง', '2210', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('221004', 'คลองพลู', '2210', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('221005', 'จันทเขลม', '2210', ' ', '22', ' ');
INSERT INTO `ref_tambol` VALUES ('230101', 'บางพระ', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230102', 'หนองเสม็ด', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230103', 'หนองโสน', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230104', 'หนองคันทรง', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230105', 'ห้วงน้ำขาว', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230106', 'อ่าวใหญ่', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230107', 'วังกระแจะ', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230108', 'ห้วยแร้ง', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230109', 'เนินทราย', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230110', 'ท่าพริก', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230111', 'ท่ากุ่ม', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230112', 'ตะกาง', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230113', 'ชำราก', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230114', 'แหลมกลัด', '2301', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230201', 'คลองใหญ่', '2302', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230202', 'ไม้รูด', '2302', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230203', 'หาดเล็ก', '2302', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230301', 'เขาสมิง', '2303', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230302', 'แสนตุ้ง', '2303', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230303', 'วังตะเคียน', '2303', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230304', 'ท่าโสม', '2303', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230305', 'สะตอ', '2303', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230306', 'ประณีต', '2303', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230307', 'เทพนิมิต', '2303', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230308', 'ทุ่งนนทรี', '2303', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230401', 'บ่อพลอย', '2304', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230402', 'ช้างทูน', '2304', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230403', 'ด่านชุมพล', '2304', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230404', 'หนองบอน', '2304', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230405', 'นนทรีย์', '2304', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230501', 'แหลมงอบ', '2305', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230502', 'น้ำเชี่ยว', '2305', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230503', 'บางปิด', '2305', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230507', 'คลองใหญ่', '2305', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230601', 'เกาะหมาก', '2306', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230602', 'เกาะกูด', '2306', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230701', 'เกาะช้าง', '2307', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('230702', 'เกาะช้างใต้', '2307', ' ', '23', ' ');
INSERT INTO `ref_tambol` VALUES ('240101', 'หน้าเมือง', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240102', 'ท่าไข่', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240103', 'บ้านใหม่', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240104', 'คลองนา', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240105', 'บางตีนเป็ด', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240106', 'บางไผ่', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240107', 'คลองจุกกระเฌอ', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240108', 'บางแก้ว', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240109', 'บางขวัญ', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240110', 'คลองนครเนื่องเขต', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240111', 'วังตะเคียน', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240112', 'โสธร', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240113', 'บางพระ', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240114', 'บางกะไห', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240115', 'หนามแดง', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240116', 'คลองเปรง', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240117', 'คลองอุดมชลจร', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240118', 'คลองหลวงแพ่ง', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240119', 'บางเตย', '2401', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240201', 'บางคล้า', '2402', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240204', 'บางสวน', '2402', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240208', 'บางกระเจ็ด', '2402', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240209', 'ปากน้ำ', '2402', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240210', 'ท่าทองหลาง', '2402', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240211', 'สาวชะโงก', '2402', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240212', 'เสม็ดเหนือ', '2402', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240213', 'เสม็ดใต้', '2402', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240214', 'หัวไทร', '2402', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240301', 'บางน้ำเปรี้ยว', '2403', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240302', 'บางขนาก', '2403', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240303', 'สิงโตทอง', '2403', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240304', 'หมอนทอง', '2403', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240305', 'บึงน้ำรักษ์', '2403', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240306', 'ดอนเกาะกา', '2403', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240307', 'โยธะกา', '2403', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240308', 'ดอนฉิมพลี', '2403', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240309', 'ศาลาแดง', '2403', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240310', 'โพรงอากาศ', '2403', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240401', 'บางปะกง', '2404', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240402', 'ท่าสะอ้าน', '2404', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240403', 'บางวัว', '2404', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240404', 'บางสมัคร', '2404', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240405', 'บางผึ้ง', '2404', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240406', 'บางเกลือ', '2404', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240407', 'สองคลอง', '2404', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240408', 'หนองจอก', '2404', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240409', 'พิมพา', '2404', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240410', 'ท่าข้าม', '2404', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240411', 'หอมศีล', '2404', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240412', 'เขาดิน', '2404', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240501', 'บ้านโพธิ์', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240502', 'เกาะไร่', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240503', 'คลองขุด', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240504', 'คลองบ้านโพธิ์', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240505', 'คลองประเวศ', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240506', 'ดอนทราย', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240507', 'เทพราช', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240508', 'ท่าพลับ', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240509', 'หนองตีนนก', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240510', 'หนองบัว', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240511', 'บางซ่อน', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240512', 'บางกรูด', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240513', 'แหลมประดู่', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240514', 'ลาดขวาง', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240515', 'สนามจันทร์', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240516', 'แสนภูดาษ', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240517', 'สิบเอ็ดศอก', '2405', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240601', 'เกาะขนุน', '2406', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240602', 'บ้านซ่อง', '2406', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240603', 'พนมสารคาม', '2406', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240604', 'เมืองเก่า', '2406', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240605', 'หนองยาว', '2406', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240606', 'ท่าถ่าน', '2406', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240607', 'หนองแหน', '2406', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240608', 'เขาหินซ้อน', '2406', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240701', 'บางคา', '2407', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240702', 'เมืองใหม่', '2407', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240703', 'ดงน้อย', '2407', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240801', 'คู้ยายหมี', '2408', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240802', 'ท่ากระดาน', '2408', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240803', 'ทุ่งพระยา', '2408', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240805', 'ลาดกระทิง', '2408', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240901', 'แปลงยาว', '2409', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240902', 'วังเย็น', '2409', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240903', 'หัวสำโรง', '2409', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('240904', 'หนองไม้แก่น', '2409', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('241001', 'ท่าตะเกียบ', '2410', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('241002', 'คลองตะเกรา', '2410', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('241101', 'ก้อนแก้ว', '2411', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('241102', 'คลองเขื่อน', '2411', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('241103', 'บางเล่า', '2411', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('241104', 'บางโรง', '2411', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('241105', 'บางตลาด', '2411', ' ', '24', ' ');
INSERT INTO `ref_tambol` VALUES ('250101', 'หน้าเมือง', '2501', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250102', 'รอบเมือง', '2501', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250103', 'วัดโบสถ์', '2501', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250104', 'บางเดชะ', '2501', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250105', 'ท่างาม', '2501', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250106', 'บางบริบูรณ์', '2501', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250107', 'ดงพระราม', '2501', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250108', 'บ้านพระ', '2501', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250109', 'โคกไม้ลาย', '2501', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250110', 'ไม้เค็ด', '2501', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250111', 'ดงขี้เหล็ก', '2501', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250112', 'เนินหอม', '2501', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250113', 'โนนห้อม', '2501', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250201', 'กบินทร์', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250202', 'เมืองเก่า', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250203', 'วังดาล', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250204', 'นนทรี', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250205', 'ย่านรี', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250206', 'วังตะเคียน', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250207', 'หาดนางแก้ว', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250208', 'ลาดตะเคียน', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250209', 'บ้านนา', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250210', 'บ่อทอง', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250211', 'หนองกี่', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250212', 'นาแขม', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250213', 'เขาไม้แก้ว', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250214', 'วังท่าช้าง', '2502', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250301', 'นาดี', '2503', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250302', 'สำพันตา', '2503', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250303', 'สะพานหิน', '2503', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250304', 'ทุ่งโพธิ์', '2503', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250305', 'แก่งดินสอ', '2503', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250306', 'บุพราหมณ์', '2503', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250601', 'บ้านสร้าง', '2506', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250602', 'บางกระเบา', '2506', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250603', 'บางเตย', '2506', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250604', 'บางยาง', '2506', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250605', 'บางแตน', '2506', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250606', 'บางพลวง', '2506', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250607', 'บางปลาร้า', '2506', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250608', 'บางขาม', '2506', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250609', 'กระทุ่มแพ้ว', '2506', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250701', 'ประจันตคาม', '2507', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250702', 'เกาะลอย', '2507', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250703', 'บ้านหอย', '2507', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250704', 'หนองแสง', '2507', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250705', 'ดงบัง', '2507', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250706', 'คำโตนด', '2507', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250707', 'บุฝ้าย', '2507', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250708', 'หนองแก้ว', '2507', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250709', 'โพธิ์งาม', '2507', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250801', 'ศรีมหาโพธิ', '2508', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250802', 'สัมพันธ์', '2508', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250803', 'บ้านทาม', '2508', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250804', 'ท่าตูม', '2508', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250805', 'บางกุ้ง', '2508', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250806', 'ดงกระทงยาม', '2508', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250807', 'หนองโพรง', '2508', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250808', 'หัวหว้า', '2508', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250809', 'หาดยาง', '2508', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250810', 'กรอกสมบูรณ์', '2508', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250901', 'โคกปีบ', '2509', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250902', 'โคกไทย', '2509', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250903', 'คู้ลำพัน', '2509', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('250904', 'ไผ่ชะเลือด', '2509', ' ', '25', ' ');
INSERT INTO `ref_tambol` VALUES ('260101', 'นครนายก', '2601', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260102', 'ท่าช้าง', '2601', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260103', 'บ้านใหญ่', '2601', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260104', 'วังกระโจม', '2601', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260105', 'ท่าทราย', '2601', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260106', 'ดอนยอ', '2601', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260107', 'ศรีจุฬา', '2601', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260108', 'ดงละคร', '2601', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260109', 'ศรีนาวา', '2601', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260110', 'สาริกา', '2601', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260111', 'หินตั้ง', '2601', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260112', 'เขาพระ', '2601', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260113', 'พรหมณี', '2601', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260201', 'เกาะหวาย', '2602', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260202', 'เกาะโพธิ์', '2602', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260203', 'ปากพลี', '2602', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260204', 'โคกกรวด', '2602', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260205', 'ท่าเรือ', '2602', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260206', 'หนองแสง', '2602', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260207', 'นาหินลาด', '2602', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260301', 'บ้านนา', '2603', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260302', 'บ้านพร้าว', '2603', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260303', 'บ้านพริก', '2603', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260304', 'อาษา', '2603', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260305', 'ทองหลาง', '2603', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260306', 'บางอ้อ', '2603', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260307', 'พิกุลออก', '2603', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260308', 'ป่าขะ', '2603', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260309', 'เขาเพิ่ม', '2603', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260310', 'ศรีกะอาง', '2603', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260401', 'พระอาจารย์', '2604', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260402', 'บึงศาล', '2604', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260403', 'ศีรษะกระบือ', '2604', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260404', 'โพธิ์แทน', '2604', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260405', 'บางสมบูรณ์', '2604', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260406', 'ทรายมูล', '2604', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260407', 'บางปลากด', '2604', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260408', 'บางลูกเสือ', '2604', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260409', 'องครักษ์', '2604', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260410', 'ชุมพล', '2604', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('260411', 'คลองใหญ่', '2604', ' ', '26', ' ');
INSERT INTO `ref_tambol` VALUES ('270101', 'สระแก้ว', '2701', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270102', 'บ้านแก้ง', '2701', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270103', 'ศาลาลำดวน', '2701', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270104', 'โคกปี่ฆ้อง', '2701', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270105', 'ท่าแยก', '2701', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270106', 'ท่าเกษม', '2701', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270108', 'สระขวัญ', '2701', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270111', 'หนองบอน', '2701', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270201', 'คลองหาด', '2702', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270202', 'ไทยอุดม', '2702', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270203', 'ซับมะกรูด', '2702', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270204', 'ไทรเดี่ยว', '2702', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270205', 'คลองไก่เถื่อน', '2702', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270206', 'เบญจขร', '2702', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270207', 'ไทรทอง', '2702', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270301', 'ตาพระยา', '2703', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270302', 'ทัพเสด็จ', '2703', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270306', 'ทัพราช', '2703', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270307', 'ทัพไทย', '2703', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270309', 'โคคลาน', '2703', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270401', 'วังน้ำเย็น', '2704', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270403', 'ตาหลังใน', '2704', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270405', 'คลองหินปูน', '2704', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270406', 'ทุ่งมหาเจริญ', '2704', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270501', 'วัฒนานคร', '2705', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270502', 'ท่าเกวียน', '2705', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270503', 'ผักขะ', '2705', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270504', 'โนนหมากเค็ง', '2705', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270505', 'หนองน้ำใส', '2705', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270506', 'ช่องกุ่ม', '2705', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270507', 'หนองแวง', '2705', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270508', 'แซร์ออ', '2705', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270509', 'หนองหมากฝ้าย', '2705', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270510', 'หนองตะเคียนบอน', '2705', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270511', 'ห้วยโจด', '2705', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270601', 'อรัญประเทศ', '2706', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270602', 'เมืองไผ่', '2706', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270603', 'หันทราย', '2706', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270604', 'คลองน้ำใส', '2706', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270605', 'ท่าข้าม', '2706', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270606', 'ป่าไร่', '2706', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270607', 'ทับพริก', '2706', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270608', 'บ้านใหม่หนองไทร', '2706', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270609', 'ผ่านศึก', '2706', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270610', 'หนองสังข์', '2706', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270611', 'คลองทับจันทร์', '2706', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270612', 'ฟากห้วย', '2706', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270613', 'บ้านด่าน', '2706', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270701', 'เขาฉกรรจ์', '2707', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270702', 'หนองหว้า', '2707', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270703', 'พระเพลิง', '2707', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270704', 'เขาสามสิบ', '2707', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270801', 'โคกสูง', '2708', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270802', 'หนองม่วง', '2708', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270803', 'หนองแวง', '2708', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270804', 'โนนหมากมุ่น', '2708', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270901', 'วังสมบูรณ์', '2709', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270902', 'วังใหม่', '2709', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('270903', 'วังทอง', '2709', ' ', '27', ' ');
INSERT INTO `ref_tambol` VALUES ('300101', 'ในเมือง', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300102', 'โพธิ์กลาง', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300103', 'หนองจะบก', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300104', 'โคกสูง', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300105', 'มะเริง', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300106', 'หนองระเวียง', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300107', 'ปรุใหญ่', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300108', 'หมื่นไวย', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300109', 'พลกรัง', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300110', 'หนองไผ่ล้อม', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300111', 'หัวทะเล', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300112', 'บ้านเกาะ', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300113', 'บ้านใหม่', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300114', 'พุดซา', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300115', 'บ้านโพธิ์', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300116', 'จอหอ', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300117', 'โคกกรวด', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300118', 'ไชยมงคล', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300119', 'หนองบัวศาลา', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300120', 'สุรนารี', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300121', 'สีมุม', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300122', 'ตลาด', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300123', 'พะเนา', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300124', 'หนองกระทุ่ม', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300125', 'หนองไข่น้ำ', '3001', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300201', 'แชะ', '3002', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300202', 'เฉลียง', '3002', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300203', 'ครบุรี', '3002', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300204', 'โคกกระชาย', '3002', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300205', 'จระเข้หิน', '3002', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300206', 'มาบตะโกเอน', '3002', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300207', 'อรพิมพ์', '3002', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300208', 'บ้านใหม่', '3002', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300209', 'ลำเพียก', '3002', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300210', 'ครบุรีใต้', '3002', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300211', 'ตะแบกบาน', '3002', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300212', 'สระว่านพระยา', '3002', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300301', 'เสิงสาง', '3003', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300302', 'สระตะเคียน', '3003', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300303', 'โนนสมบูรณ์', '3003', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300304', 'กุดโบสถ์', '3003', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300305', 'สุขไพบูลย์', '3003', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300306', 'บ้านราษฎร์', '3003', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300401', 'เมืองคง', '3004', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300402', 'คูขาด', '3004', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300403', 'เทพาลัย', '3004', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300404', 'ตาจั่น', '3004', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300405', 'บ้านปรางค์', '3004', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300406', 'หนองมะนาว', '3004', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300407', 'หนองบัว', '3004', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300408', 'โนนเต็ง', '3004', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300410', 'ขามสมบูรณ์', '3004', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300501', 'บ้านเหลื่อม', '3005', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300502', 'วังโพธิ์', '3005', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300503', 'โคกกระเบื้อง', '3005', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300504', 'ช่อระกา', '3005', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300601', 'จักราช', '3006', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300603', 'ทองหลาง', '3006', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300604', 'สีสุก', '3006', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300605', 'หนองขาม', '3006', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300607', 'หนองพลวง', '3006', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300610', 'ศรีละกอ', '3006', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300611', 'คลองเมือง', '3006', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300613', 'หินโคน', '3006', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300701', 'กระโทก', '3007', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300702', 'พลับพลา', '3007', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300703', 'ท่าอ่าง', '3007', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300704', 'ทุ่งอรุณ', '3007', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300705', 'ท่าลาดขาว', '3007', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300706', 'ท่าจะหลุง', '3007', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300707', 'ท่าเยี่ยม', '3007', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300708', 'โชคชัย', '3007', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300709', 'ละลมใหม่พัฒนา', '3007', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300710', 'ด่านเกวียน', '3007', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300801', 'กุดพิมาน', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300802', 'ด่านขุนทด', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300803', 'ด่านนอก', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300804', 'ด่านใน', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300805', 'ตะเคียน', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300806', 'บ้านเก่า', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300807', 'บ้านแปรง', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300808', 'พันชนะ', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300809', 'สระจรเข้', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300810', 'หนองกราด', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300811', 'หนองบัวตะเกียด', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300812', 'หนองบัวละคร', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300813', 'หินดาด', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300815', 'ห้วยบง', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300817', 'โนนเมืองพัฒนา', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300818', 'หนองไทร', '3008', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300901', 'โนนไทย', '3009', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300902', 'ด่านจาก', '3009', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300903', 'กำปัง', '3009', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300904', 'สำโรง', '3009', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300905', 'ค้างพลู', '3009', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300906', 'บ้านวัง', '3009', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300907', 'บัลลังก์', '3009', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300908', 'สายออ', '3009', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300909', 'ถนนโพธิ์', '3009', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('300914', 'มะค่า', '3009', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301001', 'โนนสูง', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301002', 'ใหม่', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301003', 'โตนด', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301004', 'บิง', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301005', 'ดอนชมพู', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301006', 'ธารปราสาท', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301007', 'หลุมข้าว', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301008', 'มะค่า', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301009', 'พลสงคราม', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301010', 'จันอัด', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301011', 'ขามเฒ่า', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301012', 'ด่านคล้า', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301013', 'ลำคอหงษ์', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301014', 'เมืองปราสาท', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301015', 'ดอนหวาย', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301016', 'ลำมูล', '3010', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301101', 'ขามสะแกแสง', '3011', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301102', 'โนนเมือง', '3011', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301103', 'เมืองนาท', '3011', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301104', 'ชีวึก', '3011', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301105', 'พะงาด', '3011', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301106', 'หนองหัวฟาน', '3011', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301107', 'เมืองเกษตร', '3011', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301201', 'บัวใหญ่', '3012', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301203', 'ห้วยยาง', '3012', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301204', 'เสมาใหญ่', '3012', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301206', 'ดอนตะหนิน', '3012', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301207', 'หนองบัวสะอาด', '3012', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301208', 'โนนทองหลาง', '3012', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301214', 'กุดจอก', '3012', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301215', 'ด่านช้าง', '3012', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301220', 'ขุนทอง', '3012', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301224', 'หนองแจ้งใหญ่', '3012', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301301', 'ประทาย', '3013', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301303', 'กระทุ่มราย', '3013', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301304', 'วังไม้แดง', '3013', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301306', 'ตลาดไทร', '3013', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301307', 'หนองพลวง', '3013', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301308', 'หนองค่าย', '3013', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301309', 'หันห้วยทราย', '3013', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301310', 'ดอนมัน', '3013', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301313', 'นางรำ', '3013', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301314', 'โนนเพ็ด', '3013', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301315', 'ทุ่งสว่าง', '3013', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301317', 'โคกกลาง', '3013', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301318', 'เมืองโดน', '3013', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301401', 'เมืองปัก', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301402', 'ตะคุ', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301403', 'โคกไทย', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301404', 'สำโรง', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301405', 'ตะขบ', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301406', 'นกออก', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301407', 'ดอน', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301409', 'ตูม', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301410', 'งิ้ว', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301411', 'สะแกราช', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301412', 'ลำนางแก้ว', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301416', 'ภูหลวง', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301417', 'ธงชัยเหนือ', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301418', 'สุขเกษม', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301419', 'เกษมทรัพย์', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301420', 'บ่อปลาทอง', '3014', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301501', 'ในเมือง', '3015', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301502', 'สัมฤทธิ์', '3015', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301503', 'โบสถ์', '3015', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301504', 'กระเบื้องใหญ่', '3015', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301505', 'ท่าหลวง', '3015', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301506', 'รังกาใหญ่', '3015', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301507', 'ชีวาน', '3015', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301508', 'นิคมสร้างตนเอง', '3015', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301509', 'กระชอน', '3015', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301510', 'ดงใหญ่', '3015', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301511', 'ธารละหลอด', '3015', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301512', 'หนองระเวียง', '3015', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301601', 'ห้วยแถลง', '3016', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301602', 'ทับสวาย', '3016', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301603', 'เมืองพลับพลา', '3016', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301604', 'หลุ่งตะเคียน', '3016', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301605', 'หินดาด', '3016', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301606', 'งิ้ว', '3016', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301607', 'กงรถ', '3016', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301608', 'หลุ่งประดู่', '3016', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301609', 'ตะโก', '3016', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301610', 'ห้วยแคน', '3016', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301701', 'ชุมพวง', '3017', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301702', 'ประสุข', '3017', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301703', 'ท่าลาด', '3017', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301704', 'สาหร่าย', '3017', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301705', 'ตลาดไทร', '3017', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301710', 'โนนรัง', '3017', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301714', 'หนองหลัก', '3017', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301716', 'โนนตูม', '3017', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301717', 'โนนยอ', '3017', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301801', 'สูงเนิน', '3018', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301802', 'เสมา', '3018', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301803', 'โคราช', '3018', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301804', 'บุ่งขี้เหล็ก', '3018', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301805', 'โนนค่า', '3018', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301806', 'โค้งยาง', '3018', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301807', 'มะเกลือเก่า', '3018', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301808', 'มะเกลือใหม่', '3018', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301809', 'นากลาง', '3018', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301810', 'หนองตะไก้', '3018', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301811', 'กุดจิก', '3018', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301901', 'ขามทะเลสอ', '3019', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301902', 'โป่งแดง', '3019', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301903', 'พันดุง', '3019', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301904', 'หนองสรวง', '3019', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('301905', 'บึงอ้อ', '3019', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302001', 'สีคิ้ว', '3020', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302002', 'บ้านหัน', '3020', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302003', 'กฤษณา', '3020', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302004', 'ลาดบัวขาว', '3020', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302005', 'หนองหญ้าขาว', '3020', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302006', 'กุดน้อย', '3020', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302007', 'หนองน้ำใส', '3020', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302008', 'วังโรงใหญ่', '3020', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302009', 'มิตรภาพ', '3020', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302010', 'คลองไผ่', '3020', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302011', 'ดอนเมือง', '3020', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302012', 'หนองบัวน้อย', '3020', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302101', 'ปากช่อง', '3021', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302102', 'กลางดง', '3021', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302103', 'จันทึก', '3021', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302104', 'วังกะทะ', '3021', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302105', 'หมูสี', '3021', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302106', 'หนองสาหร่าย', '3021', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302107', 'ขนงพระ', '3021', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302108', 'โป่งตาลอง', '3021', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302109', 'คลองม่วง', '3021', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302110', 'หนองน้ำแดง', '3021', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302111', 'วังไทร', '3021', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302112', 'พญาเย็น', '3021', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302201', 'หนองบุนนาก', '3022', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302202', 'สารภี', '3022', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302203', 'ไทยเจริญ', '3022', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302204', 'หนองหัวแรต', '3022', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302205', 'แหลมทอง', '3022', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302206', 'หนองตะไก้', '3022', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302207', 'ลุงเขว้า', '3022', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302208', 'หนองไม้ไผ่', '3022', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302209', 'บ้านใหม่', '3022', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302301', 'แก้งสนามนาง', '3023', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302302', 'โนนสำราญ', '3023', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302303', 'บึงพะไล', '3023', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302304', 'สีสุก', '3023', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302305', 'บึงสำโรง', '3023', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302401', 'โนนแดง', '3024', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302402', 'โนนตาเถร', '3024', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302403', 'สำพะเนียง', '3024', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302404', 'วังหิน', '3024', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302405', 'ดอนยาวใหญ่', '3024', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302501', 'วังน้ำเขียว', '3025', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302502', 'วังหมี', '3025', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302503', 'ระเริง', '3025', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302504', 'อุดมทรัพย์', '3025', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302505', 'ไทยสามัคคี', '3025', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302601', 'สำนักตะคร้อ', '3026', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302602', 'หนองแวง', '3026', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302603', 'บึงปรือ', '3026', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302604', 'วังยายทอง', '3026', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302701', 'เมืองยาง', '3027', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302702', 'กระเบื้องนอก', '3027', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302703', 'ละหานปลาค้าว', '3027', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302704', 'โนนอุดม', '3027', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302802', 'มาบกราด', '3028', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302803', 'พังเทียม', '3028', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302804', 'ทัพรั้ง', '3028', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302805', 'หนองหอย', '3028', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302901', 'ขุย', '3029', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302902', 'บ้านยาง', '3029', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302903', 'ช่องแมว', '3029', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('302904', 'ไพล', '3029', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303001', 'เมืองพะไล', '3030', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303002', 'โนนจาน', '3030', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303003', 'บัวลาย', '3030', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303004', 'หนองหว้า', '3030', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303101', 'สีดา', '3031', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303102', 'โพนทอง', '3031', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303103', 'โนนประดู่', '3031', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303104', 'สามเมือง', '3031', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303105', 'หนองตาดใหญ่', '3031', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303201', 'ช้างทอง', '3032', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303202', 'ท่าช้าง', '3032', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303203', 'พระพุทธ', '3032', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303204', 'หนองงูเหลือม', '3032', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('303205', 'หนองยาง', '3032', ' ', '30', ' ');
INSERT INTO `ref_tambol` VALUES ('310101', 'ในเมือง', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310102', 'อิสาณ', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310103', 'เสม็ด', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310104', 'บ้านบัว', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310105', 'สะแกโพรง', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310106', 'สวายจีก', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310108', 'บ้านยาง', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310112', 'พระครู', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310113', 'ถลุงเหล็ก', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310114', 'หนองตาด', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310117', 'ลุมปุ๊ก', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310118', 'สองห้อง', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310119', 'บัวทอง', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310120', 'ชุมเห็ด', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310122', 'หลักเขต', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310125', 'สะแกซำ', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310126', 'กลันทา', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310127', 'กระสัง', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310128', 'เมืองฝาง', '3101', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310201', 'คูเมือง', '3102', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310202', 'ปะเคียบ', '3102', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310203', 'บ้านแพ', '3102', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310204', 'พรสำราญ', '3102', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310205', 'หินเหล็กไฟ', '3102', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310206', 'ตูมใหญ่', '3102', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310207', 'หนองขมาร', '3102', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310301', 'กระสัง', '3103', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310302', 'ลำดวน', '3103', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310303', 'สองชั้น', '3103', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310304', 'สูงเนิน', '3103', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310305', 'หนองเต็ง', '3103', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310306', 'เมืองไผ่', '3103', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310307', 'ชุมแสง', '3103', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310308', 'บ้านปรือ', '3103', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310309', 'ห้วยสำราญ', '3103', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310310', 'กันทรารมย์', '3103', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310311', 'ศรีภูมิ', '3103', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310401', 'นางรอง', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310403', 'สะเดา', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310405', 'ชุมแสง', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310406', 'หนองโบสถ์', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310408', 'หนองกง', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310413', 'ถนนหัก', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310414', 'หนองไทร', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310415', 'ก้านเหลือง', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310416', 'บ้านสิงห์', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310417', 'ลำไทรโยง', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310418', 'ทรัพย์พระยา', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310424', 'หนองยายพิมพ์', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310425', 'หัวถนน', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310426', 'ทุ่งแสงทอง', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310427', 'หนองโสน', '3104', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310501', 'หนองกี่', '3105', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310502', 'เย้ยปราสาท', '3105', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310503', 'เมืองไผ่', '3105', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310504', 'ดอนอะราง', '3105', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310505', 'โคกสว่าง', '3105', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310506', 'ทุ่งกระตาดพัฒนา', '3105', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310507', 'ทุ่งกระเต็น', '3105', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310508', 'ท่าโพธิ์ชัย', '3105', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310509', 'โคกสูง', '3105', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310510', 'บุกระสัง', '3105', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310601', 'ละหานทราย', '3106', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310603', 'ตาจง', '3106', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310604', 'สำโรงใหม่', '3106', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310607', 'หนองแวง', '3106', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310610', 'หนองตระครอง', '3106', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310611', 'โคกว่าน', '3106', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310701', 'ประโคนชัย', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310702', 'แสลงโทน', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310703', 'บ้านไทร', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310705', 'ละเวี้ย', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310706', 'จรเข้มาก', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310707', 'ปังกู', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310708', 'โคกย่าง', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310710', 'โคกม้า', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310713', 'ไพศาล', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310714', 'ตะโกตาพิ', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310715', 'เขาคอก', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310716', 'หนองบอน', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310718', 'โคกมะขาม', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310719', 'โคกตูม', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310720', 'ประทัดบุ', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310721', 'สี่เหลี่ยม', '3107', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310801', 'บ้านกรวด', '3108', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310802', 'โนนเจริญ', '3108', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310803', 'หนองไม้งาม', '3108', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310804', 'ปราสาท', '3108', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310805', 'สายตะกู', '3108', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310806', 'หินลาด', '3108', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310807', 'บึงเจริญ', '3108', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310808', 'จันทบเพชร', '3108', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310809', 'เขาดินเหนือ', '3108', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310901', 'พุทไธสง', '3109', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310902', 'มะเฟือง', '3109', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310903', 'บ้านจาน', '3109', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310906', 'บ้านเป้า', '3109', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310907', 'บ้านแวง', '3109', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310909', 'บ้านยาง', '3109', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('310910', 'หายโศก', '3109', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311001', 'ลำปลายมาศ', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311002', 'หนองคู', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311003', 'แสลงพัน', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311004', 'ทะเมนชัย', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311005', 'ตลาดโพธิ์', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311006', 'หนองกะทิง', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311007', 'โคกกลาง', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311008', 'โคกสะอาด', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311009', 'เมืองแฝก', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311010', 'บ้านยาง', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311011', 'ผไทรินทร์', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311012', 'โคกล่าม', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311013', 'หินโคน', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311014', 'หนองบัวโคก', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311015', 'บุโพธิ์', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311016', 'หนองโดน', '3110', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311101', 'สตึก', '3111', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311102', 'นิคม', '3111', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311103', 'ทุ่งวัง', '3111', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311104', 'เมืองแก', '3111', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311105', 'หนองใหญ่', '3111', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311106', 'ร่อนทอง', '3111', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311109', 'ดอนมนต์', '3111', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311110', 'ชุมแสง', '3111', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311111', 'ท่าม่วง', '3111', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311112', 'สะแก', '3111', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311114', 'สนามชัย', '3111', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311115', 'กระสัง', '3111', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311201', 'ปะคำ', '3112', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311202', 'ไทยเจริญ', '3112', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311203', 'หนองบัว', '3112', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311204', 'โคกมะม่วง', '3112', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311205', 'หูทำนบ', '3112', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311301', 'นาโพธิ์', '3113', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311302', 'บ้านคู', '3113', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311303', 'บ้านดู่', '3113', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311304', 'ดอนกอก', '3113', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311305', 'ศรีสว่าง', '3113', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311401', 'สระแก้ว', '3114', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311402', 'ห้วยหิน', '3114', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311403', 'ไทยสามัคคี', '3114', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311404', 'หนองชัยศรี', '3114', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311405', 'เสาเดียว', '3114', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311406', 'เมืองฝ้าย', '3114', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311407', 'สระทอง', '3114', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311501', 'จันดุม', '3115', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311502', 'โคกขมิ้น', '3115', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311503', 'ป่าชัน', '3115', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311504', 'สะเดา', '3115', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311505', 'สำโรง', '3115', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311601', 'ห้วยราช', '3116', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311602', 'สามแวง', '3116', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311603', 'ตาเสา', '3116', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311604', 'บ้านตะโก', '3116', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311605', 'สนวน', '3116', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311606', 'โคกเหล็ก', '3116', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311607', 'เมืองโพธิ์', '3116', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311608', 'ห้วยราชา', '3116', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311701', 'โนนสุวรรณ', '3117', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311702', 'ทุ่งจังหัน', '3117', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311703', 'โกรกแก้ว', '3117', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311704', 'ดงอีจาน', '3117', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311801', 'ชำนิ', '3118', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311802', 'หนองปล่อง', '3118', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311803', 'เมืองยาง', '3118', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311804', 'ช่อผกา', '3118', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311805', 'ละลวด', '3118', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311806', 'โคกสนวน', '3118', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311901', 'หนองแวง', '3119', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311902', 'ทองหลาง', '3119', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311903', 'แดงใหญ่', '3119', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311904', 'กู่สวนแตง', '3119', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('311905', 'หนองเยือง', '3119', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312001', 'โนนดินแดง', '3120', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312002', 'ส้มป่อย', '3120', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312003', 'ลำนางรอง', '3120', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312101', 'บ้านด่าน', '3121', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312102', 'ปราสาท', '3121', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312103', 'วังเหนือ', '3121', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312104', 'โนนขวาง', '3121', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312201', 'แคนดง', '3122', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312202', 'ดงพลอง', '3122', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312203', 'สระบัว', '3122', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312204', 'หัวฝาย', '3122', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312301', 'เจริญสุข', '3123', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312302', 'ตาเป๊ก', '3123', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312303', 'อีสานเขต', '3123', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312304', 'ถาวร', '3123', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('312305', 'ยายแย้มวัฒนา', '3123', ' ', '31', ' ');
INSERT INTO `ref_tambol` VALUES ('320101', 'ในเมือง', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320102', 'ตั้งใจ', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320103', 'เพี้ยราม', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320104', 'นาดี', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320105', 'ท่าสว่าง', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320106', 'สลักได', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320107', 'ตาอ็อง', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320109', 'สำโรง', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320110', 'แกใหญ่', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320111', 'นอกเมือง', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320112', 'คอโค', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320113', 'สวาย', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320114', 'เฉนียง', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320116', 'เทนมีย์', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320118', 'นาบัว', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320119', 'เมืองที', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320120', 'ราม', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320121', 'บุฤาษี', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320122', 'ตระแสง', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320125', 'แสลงพันธ์', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320126', 'กาเกาะ', '3201', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320201', 'ชุมพลบุรี', '3202', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320202', 'นาหนองไผ่', '3202', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320203', 'ไพรขลา', '3202', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320204', 'ศรีณรงค์', '3202', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320205', 'ยะวึก', '3202', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320206', 'เมืองบัว', '3202', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320207', 'สระขุด', '3202', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320208', 'กระเบื้อง', '3202', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320209', 'หนองเรือ', '3202', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320301', 'ท่าตูม', '3203', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320302', 'กระโพ', '3203', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320303', 'พรมเทพ', '3203', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320304', 'โพนครก', '3203', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320305', 'เมืองแก', '3203', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320306', 'บะ', '3203', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320307', 'หนองบัว', '3203', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320308', 'บัวโคก', '3203', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320309', 'หนองเมธี', '3203', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320310', 'ทุ่งกุลา', '3203', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320401', 'จอมพระ', '3204', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320402', 'เมืองลีง', '3204', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320403', 'กระหาด', '3204', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320404', 'บุแกรง', '3204', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320405', 'หนองสนิท', '3204', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320406', 'บ้านผือ', '3204', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320407', 'ลุ่มระวี', '3204', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320408', 'ชุมแสง', '3204', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320409', 'เป็นสุข', '3204', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320501', 'กังแอน', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320502', 'ทมอ', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320503', 'ไพล', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320504', 'ปรือ', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320505', 'ทุ่งมน', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320506', 'ตาเบา', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320507', 'หนองใหญ่', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320508', 'โคกยาง', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320509', 'โคกสะอาด', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320510', 'บ้านไทร', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320511', 'โชคนาสาม', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320512', 'เชื้อเพลิง', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320513', 'ปราสาททนง', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320514', 'ตานี', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320515', 'บ้านพลวง', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320516', 'กันตวจระมวล', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320517', 'สมุด', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320518', 'ประทัดบุ', '3205', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320601', 'กาบเชิง', '3206', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320604', 'คูตัน', '3206', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320605', 'ด่าน', '3206', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320606', 'แนงมุด', '3206', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320607', 'โคกตะเคียน', '3206', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320610', 'ตะเคียน', '3206', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320701', 'รัตนบุรี', '3207', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320702', 'ธาตุ', '3207', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320703', 'แก', '3207', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320704', 'ดอนแรด', '3207', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320705', 'หนองบัวทอง', '3207', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320706', 'หนองบัวบาน', '3207', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320709', 'ไผ่', '3207', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320711', 'เบิด', '3207', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320713', 'น้ำเขียว', '3207', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320714', 'กุดขาคีม', '3207', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320715', 'ยางสว่าง', '3207', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320716', 'ทับใหญ่', '3207', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320801', 'สนม', '3208', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320802', 'โพนโก', '3208', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320803', 'หนองระฆัง', '3208', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320804', 'นานวน', '3208', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320805', 'แคน', '3208', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320806', 'หัวงัว', '3208', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320807', 'หนองอียอ', '3208', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320901', 'ระแงง', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320902', 'ตรึม', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320903', 'จารพัต', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320904', 'ยาง', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320905', 'แตล', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320906', 'หนองบัว', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320907', 'คาละแมะ', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320908', 'หนองเหล็ก', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320909', 'หนองขวาว', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320910', 'ช่างปี่', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320911', 'กุดหวาย', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320912', 'ขวาวใหญ่', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320913', 'นารุ่ง', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320914', 'ตรมไพร', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('320915', 'ผักไหม', '3209', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321001', 'สังขะ', '3210', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321002', 'ขอนแตก', '3210', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321006', 'ดม', '3210', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321007', 'พระแก้ว', '3210', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321008', 'บ้านจารย์', '3210', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321009', 'กระเทียม', '3210', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321010', 'สะกาด', '3210', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321011', 'ตาตุม', '3210', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321012', 'ทับทัน', '3210', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321013', 'ตาคง', '3210', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321015', 'บ้านชบ', '3210', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321017', 'เทพรักษา', '3210', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321101', 'ลำดวน', '3211', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321102', 'โชคเหนือ', '3211', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321103', 'อู่โลก', '3211', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321104', 'ตรำดม', '3211', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321105', 'ตระเปียงเตีย', '3211', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321201', 'สำโรงทาบ', '3212', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321202', 'หนองไผ่ล้อม', '3212', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321203', 'กระออม', '3212', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321204', 'หนองฮะ', '3212', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321205', 'ศรีสุข', '3212', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321206', 'เกาะแก้ว', '3212', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321207', 'หมื่นศรี', '3212', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321208', 'เสม็จ', '3212', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321209', 'สะโน', '3212', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321210', 'ประดู่', '3212', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321301', 'บัวเชด', '3213', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321302', 'สะเดา', '3213', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321303', 'จรัส', '3213', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321304', 'ตาวัง', '3213', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321305', 'อาโพน', '3213', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321306', 'สำเภาลูน', '3213', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321401', 'บักได', '3214', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321402', 'โคกกลาง', '3214', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321403', 'จีกแดก', '3214', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321404', 'ตาเมียง', '3214', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321501', 'ณรงค์', '3215', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321502', 'แจนแวน', '3215', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321503', 'ตรวจ', '3215', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321504', 'หนองแวง', '3215', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321505', 'ศรีสุข', '3215', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321601', 'เขวาสินรินทร์', '3216', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321602', 'บึง', '3216', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321603', 'ตากูก', '3216', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321604', 'ปราสาททอง', '3216', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321605', 'บ้านแร่', '3216', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321701', 'หนองหลวง', '3217', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321702', 'คำผง', '3217', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321703', 'โนน', '3217', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321704', 'ระเวียง', '3217', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('321705', 'หนองเทพ', '3217', ' ', '32', ' ');
INSERT INTO `ref_tambol` VALUES ('330101', 'เมืองเหนือ', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330102', 'เมืองใต้', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330103', 'คูซอด', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330104', 'ซำ', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330105', 'จาน', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330106', 'ตะดอบ', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330107', 'หนองครก', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330111', 'โพนข่า', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330112', 'โพนค้อ', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330115', 'โพนเขวา', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330116', 'หญ้าปล้อง', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330118', 'ทุ่ม', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330119', 'หนองไฮ', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330121', 'หนองแก้ว', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330122', 'น้ำคำ', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330123', 'โพธิ์', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330124', 'หมากเขียบ', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330127', 'หนองไผ่', '3301', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330201', 'ยางชุมน้อย', '3302', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330202', 'ลิ้นฟ้า', '3302', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330203', 'คอนกาม', '3302', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330204', 'โนนคูณ', '3302', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330205', 'กุดเมืองฮาม', '3302', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330206', 'บึงบอน', '3302', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330207', 'ยางชุมใหญ่', '3302', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330301', 'ดูน', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330302', 'โนนสัง', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330303', 'หนองหัวช้าง', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330304', 'ยาง', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330305', 'หนองแวง', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330306', 'หนองแก้ว', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330307', 'ทาม', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330308', 'ละทาย', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330309', 'เมืองน้อย', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330310', 'อีปาด', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330311', 'บัวน้อย', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330312', 'หนองบัว', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330313', 'ดู่', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330314', 'ผักแพว', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330315', 'จาน', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330320', 'คำเนียม', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330321', 'ทุ่งใหญ่', '3303', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330401', 'บึงมะลู', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330402', 'กุดเสลา', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330403', 'เมือง', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330405', 'สังเม็ก', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330406', 'น้ำอ้อม', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330407', 'ละลาย', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330408', 'รุง', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330409', 'ตระกาจ', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330411', 'จานใหญ่', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330412', 'ภูเงิน', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330413', 'ชำ', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330414', 'กระแชง', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330415', 'โนนสำราญ', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330416', 'หนองหญ้าลาด', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330419', 'เสาธงชัย', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330420', 'ขนุน', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330421', 'สวนกล้วย', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330423', 'เวียงเหนือ', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330424', 'ทุ่งใหญ่', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330425', 'ภูผาหมอก', '3304', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330501', 'กันทรารมย์', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330502', 'จะกง', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330503', 'ใจดี', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330504', 'ดองกำเม็ด', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330505', 'โสน', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330506', 'ปรือใหญ่', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330507', 'สะเดาใหญ่', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330508', 'ตาอุด', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330509', 'ห้วยเหนือ', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330510', 'ห้วยใต้', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330511', 'หัวเสือ', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330513', 'ตะเคียน', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330515', 'นิคมพัฒนา', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330517', 'โคกเพชร', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330518', 'ปราสาท', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330521', 'สำโรงตาเจ็น', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330522', 'ห้วยสำราญ', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330524', 'กฤษณา', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330525', 'ลมศักดิ์', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330526', 'หนองฉลอง', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330527', 'ศรีตระกูล', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330528', 'ศรีสะอาด', '3305', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330601', 'ไพรบึง', '3306', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330602', 'ดินแดง', '3306', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330603', 'ปราสาทเยอ', '3306', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330604', 'สำโรงพลัน', '3306', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330605', 'สุขสวัสดิ์', '3306', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330606', 'โนนปูน', '3306', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330701', 'พิมาย', '3307', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330702', 'กู่', '3307', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330703', 'หนองเชียงทูน', '3307', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330704', 'ตูม', '3307', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330705', 'สมอ', '3307', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330706', 'โพธิ์ศรี', '3307', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330707', 'สำโรงปราสาท', '3307', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330708', 'ดู่', '3307', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330709', 'สวาย', '3307', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330710', 'พิมายเหนือ', '3307', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330801', 'สิ', '3308', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330802', 'บักดอง', '3308', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330803', 'พราน', '3308', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330804', 'โพธิ์วงศ์', '3308', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330805', 'ไพร', '3308', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330806', 'กระหวัน', '3308', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330807', 'ขุนหาญ', '3308', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330808', 'โนนสูง', '3308', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330809', 'กันทรอม', '3308', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330810', 'ภูฝ้าย', '3308', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330811', 'โพธิ์กระสังข์', '3308', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330812', 'ห้วยจันทร์', '3308', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330901', 'เมืองคง', '3309', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330902', 'เมืองแคน', '3309', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330903', 'หนองแค', '3309', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330906', 'จิกสังข์ทอง', '3309', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330907', 'ด่าน', '3309', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330908', 'ดู่', '3309', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330909', 'หนองอึ่ง', '3309', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330910', 'บัวหุ่ง', '3309', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330911', 'ไผ่', '3309', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330912', 'ส้มป่อย', '3309', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330913', 'หนองหมี', '3309', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330914', 'หว้านคำ', '3309', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('330915', 'สร้างปี่', '3309', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331001', 'กำแพง', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331002', 'อี่หล่ำ', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331003', 'ก้านเหลือง', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331004', 'ทุ่งไชย', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331005', 'สำโรง', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331006', 'แขม', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331007', 'หนองไฮ', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331008', 'ขะยูง', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331010', 'ตาเกษ', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331011', 'หัวช้าง', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331012', 'รังแร้ง', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331014', 'แต้', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331015', 'แข้', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331016', 'โพธิ์ชัย', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331017', 'ปะอาว', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331018', 'หนองห้าง', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331022', 'สระกำแพงใหญ่', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331024', 'โคกหล่าม', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331025', 'โคกจาน', '3310', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331101', 'เป๊าะ', '3311', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331102', 'บึงบูรพ์', '3311', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331201', 'ห้วยทับทัน', '3312', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331202', 'เมืองหลวง', '3312', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331203', 'กล้วยกว้าง', '3312', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331204', 'ผักไหม', '3312', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331205', 'จานแสนไชย', '3312', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331206', 'ปราสาท', '3312', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331301', 'โนนค้อ', '3313', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331302', 'บก', '3313', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331303', 'โพธิ์', '3313', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331304', 'หนองกุง', '3313', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331305', 'เหล่ากวาง', '3313', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331401', 'ศรีแก้ว', '3314', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331402', 'พิงพวย', '3314', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331403', 'สระเยาว์', '3314', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331404', 'ตูม', '3314', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331405', 'เสื่องข้าว', '3314', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331406', 'ศรีโนนงาม', '3314', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331407', 'สะพุง', '3314', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331501', 'น้ำเกลี้ยง', '3315', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331502', 'ละเอาะ', '3315', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331503', 'ตองปิด', '3315', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331504', 'เขิน', '3315', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331505', 'รุ่งระวี', '3315', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331506', 'คูบ', '3315', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331601', 'บุสูง', '3316', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331602', 'ธาตุ', '3316', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331603', 'ดวนใหญ่', '3316', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331604', 'บ่อแก้ว', '3316', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331605', 'ศรีสำราญ', '3316', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331606', 'ทุ่งสว่าง', '3316', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331607', 'วังหิน', '3316', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331608', 'โพนยาง', '3316', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331701', 'โคกตาล', '3317', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331702', 'ห้วยตามอญ', '3317', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331703', 'ห้วยตึ๊กชู', '3317', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331704', 'ละลม', '3317', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331705', 'ตะเคียนราม', '3317', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331706', 'ดงรัก', '3317', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331707', 'ไพรพัฒนา', '3317', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331801', 'เมืองจันทร์', '3318', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331802', 'ตาโกน', '3318', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331803', 'หนองใหญ่', '3318', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331901', 'เสียว', '3319', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331902', 'หนองหว้า', '3319', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331903', 'หนองงูเหลือม', '3319', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331904', 'หนองฮาง', '3319', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('331905', 'ท่าคล้อ', '3319', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332001', 'พยุห์', '3320', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332002', 'พรหมสวัสดิ์', '3320', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332003', 'ตำแย', '3320', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332004', 'โนนเพ็ก', '3320', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332005', 'หนองค้า', '3320', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332101', 'โดด', '3321', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332102', 'เสียว', '3321', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332103', 'หนองม้า', '3321', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332104', 'ผือใหญ่', '3321', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332105', 'อีเซ', '3321', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332201', 'กุง', '3322', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332202', 'คลีกลิ้ง', '3322', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332203', 'หนองบัวดง', '3322', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('332204', 'โจดม่วง', '3322', ' ', '33', ' ');
INSERT INTO `ref_tambol` VALUES ('340101', 'ในเมือง', '3401', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340104', 'หัวเรือ', '3401', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340105', 'หนองขอน', '3401', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340107', 'ปทุม', '3401', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340108', 'ขามใหญ่', '3401', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340109', 'แจระแม', '3401', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340111', 'หนองบ่อ', '3401', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340112', 'ไร่น้อย', '3401', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340113', 'กระโสบ', '3401', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340116', 'กุดลาด', '3401', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340119', 'ขี้เหล็ก', '3401', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340120', 'ปะอาว', '3401', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340201', 'นาคำ', '3402', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340202', 'แก้งกอก', '3402', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340203', 'เอือดใหญ่', '3402', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340204', 'วาริน', '3402', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340205', 'ลาดควาย', '3402', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340206', 'สงยาง', '3402', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340207', 'ตะบ่าย', '3402', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340208', 'คำไหล', '3402', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340209', 'หนามแท่ง', '3402', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340210', 'นาเลิน', '3402', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340211', 'ดอนใหญ่', '3402', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340301', 'โขงเจียม', '3403', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340302', 'ห้วยยาง', '3403', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340303', 'นาโพธิ์กลาง', '3403', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340304', 'หนองแสงใหญ่', '3403', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340305', 'ห้วยไผ่', '3403', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340306', 'คำเขื่อนแก้ว', '3403', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340401', 'เขื่องใน', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340402', 'สร้างถ่อ', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340403', 'ค้อทอง', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340404', 'ก่อเอ้', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340405', 'หัวดอน', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340406', 'ชีทวน', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340407', 'ท่าไห', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340408', 'นาคำใหญ่', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340409', 'แดงหม้อ', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340410', 'ธาตุน้อย', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340411', 'บ้านไทย', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340412', 'บ้านกอก', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340413', 'กลางใหญ่', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340414', 'โนนรัง', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340415', 'ยางขี้นก', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340416', 'ศรีสุข', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340417', 'สหธาตุ', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340418', 'หนองเหล่า', '3404', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340501', 'เขมราฐ', '3405', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340503', 'ขามป้อม', '3405', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340504', 'เจียด', '3405', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340507', 'หนองผือ', '3405', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340508', 'นาแวง', '3405', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340510', 'แก้งเหนือ', '3405', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340511', 'หนองนกทา', '3405', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340512', 'หนองสิม', '3405', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340513', 'หัวนา', '3405', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340701', 'เมืองเดช', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340702', 'นาส่วง', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340704', 'นาเจริญ', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340706', 'ทุ่งเทิง', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340708', 'สมสะอาด', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340709', 'กุดประทาย', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340710', 'ตบหู', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340711', 'กลาง', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340712', 'แก้ง', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340713', 'ท่าโพธิ์ศรี', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340715', 'บัวงาม', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340716', 'คำครั่ง', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340717', 'นากระแซง', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340720', 'โพนงาม', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340721', 'ป่าโมง', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340723', 'โนนสมบูรณ์', '3407', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340801', 'นาจะหลวย', '3408', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340802', 'โนนสมบูรณ์', '3408', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340803', 'พรสวรรค์', '3408', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340804', 'บ้านตูม', '3408', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340805', 'โสกแสง', '3408', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340806', 'โนนสวรรค์', '3408', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340901', 'โซง', '3409', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340903', 'ยาง', '3409', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340904', 'โดมประดิษฐ์', '3409', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340906', 'บุเปือย', '3409', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340907', 'สีวิเชียร', '3409', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340909', 'ยางใหญ่', '3409', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('340911', 'เก่าขาม', '3409', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341001', 'โพนงาม', '3410', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341002', 'ห้วยข่า', '3410', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341003', 'คอแลน', '3410', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341004', 'นาโพธิ์', '3410', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341005', 'หนองสะโน', '3410', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341006', 'โนนค้อ', '3410', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341007', 'บัวงาม', '3410', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341008', 'บ้านแมด', '3410', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341101', 'ขุหลุ', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341102', 'กระเดียน', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341103', 'เกษม', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341104', 'กุศกร', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341105', 'ขามเปี้ย', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341106', 'คอนสาย', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341107', 'โคกจาน', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341108', 'นาพิน', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341109', 'นาสะไม', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341110', 'โนนกุง', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341111', 'ตระการ', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341112', 'ตากแดด', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341113', 'ไหล่ทุ่ง', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341114', 'เป้า', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341115', 'เซเป็ด', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341116', 'สะพือ', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341117', 'หนองเต่า', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341118', 'ถ้ำแข้', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341119', 'ท่าหลวง', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341120', 'ห้วยฝ้ายพัฒนา', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341121', 'กุดยาลวน', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341122', 'บ้านแดง', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341123', 'คำเจริญ', '3411', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341201', 'ข้าวปุ้น', '3412', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341202', 'โนนสวาง', '3412', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341203', 'แก่งเค็ง', '3412', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341204', 'กาบิน', '3412', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341205', 'หนองทันน้ำ', '3412', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341401', 'ม่วงสามสิบ', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341402', 'เหล่าบก', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341403', 'ดุมใหญ่', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341404', 'หนองช้างใหญ่', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341405', 'หนองเมือง', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341406', 'เตย', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341407', 'ยางสักกระโพหลุ่ม', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341408', 'หนองไข่นก', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341409', 'หนองเหล่า', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341410', 'หนองฮาง', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341411', 'ยางโยภาพ', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341412', 'ไผ่ใหญ่', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341413', 'นาเลิง', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341414', 'โพนแพง', '3414', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341501', 'วารินชำราบ', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341502', 'ธาตุ', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341504', 'ท่าลาด', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341505', 'โนนโหนน', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341507', 'คูเมือง', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341508', 'สระสมิง', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341510', 'คำน้ำแซบ', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341511', 'บุ่งหวาย', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341515', 'คำขวาง', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341516', 'โพธิ์ใหญ่', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341518', 'แสนสุข', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341520', 'หนองกินเพล', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341521', 'โนนผึ้ง', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341522', 'เมืองศรีไค', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341524', 'ห้วยขะยูง', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341526', 'บุ่งไหม', '3415', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341901', 'พิบูล', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341902', 'กุดชมภู', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341904', 'ดอนจิก', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341905', 'ทรายมูล', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341906', 'นาโพธิ์', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341907', 'โนนกลาง', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341909', 'โพธิ์ไทร', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341910', 'โพธิ์ศรี', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341911', 'ระเว', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341912', 'ไร่ใต้', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341913', 'หนองบัวฮี', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341914', 'อ่างศิลา', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341918', 'โนนกาหลง', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('341919', 'บ้านแขม', '3419', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342001', 'ตาลสุม', '3420', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342002', 'สำโรง', '3420', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342003', 'จิกเทิง', '3420', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342004', 'หนองกุง', '3420', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342005', 'นาคาย', '3420', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342006', 'คำหว้า', '3420', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342101', 'โพธิ์ไทร', '3421', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342102', 'ม่วงใหญ่', '3421', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342103', 'สำโรง', '3421', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342104', 'สองคอน', '3421', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342105', 'สารภี', '3421', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342106', 'เหล่างาม', '3421', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342201', 'สำโรง', '3422', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342202', 'โคกก่อง', '3422', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342203', 'หนองไฮ', '3422', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342204', 'ค้อน้อย', '3422', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342205', 'โนนกาเล็น', '3422', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342206', 'โคกสว่าง', '3422', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342207', 'โนนกลาง', '3422', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342208', 'บอน', '3422', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342209', 'ขามป้อม', '3422', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342401', 'ดอนมดแดง', '3424', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342402', 'เหล่าแดง', '3424', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342403', 'ท่าเมือง', '3424', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342404', 'คำไฮใหญ่', '3424', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342501', 'คันไร่', '3425', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342502', 'ช่องเม็ก', '3425', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342503', 'โนนก่อ', '3425', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342504', 'นิคมลำโดมน้อย', '3425', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342505', 'ฝางคำ', '3425', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342506', 'คำเขื่อนแก้ว', '3425', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342602', 'หนองอ้ม', '3426', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342603', 'นาเกษม', '3426', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342604', 'กุดเรือ', '3426', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342605', 'โคกชำแระ', '3426', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342606', 'นาห่อม', '3426', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342901', 'นาเยีย', '3429', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342902', 'นาดี', '3429', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('342903', 'นาเรือง', '3429', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343001', 'นาตาล', '3430', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343002', 'พะลาน', '3430', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343003', 'กองโพน', '3430', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343004', 'พังเคน', '3430', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343101', 'เหล่าเสือโก้ก', '3431', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343102', 'โพนเมือง', '3431', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343103', 'แพงใหญ่', '3431', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343104', 'หนองบก', '3431', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343201', 'แก่งโดม', '3432', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343202', 'ท่าช้าง', '3432', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343203', 'บุ่งมะแลง', '3432', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343204', 'สว่าง', '3432', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343301', 'ตาเกา', '3433', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343302', 'ไพบูลย์', '3433', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343303', 'ขี้เหล็ก', '3433', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('343304', 'โคกสะอาด', '3433', ' ', '34', ' ');
INSERT INTO `ref_tambol` VALUES ('350101', 'ในเมือง', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350102', 'น้ำคำใหญ่', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350103', 'ตาดทอง', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350104', 'สำราญ', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350105', 'ค้อเหนือ', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350106', 'ดู่ทุ่ง', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350107', 'เดิด', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350108', 'ขั้นไดใหญ่', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350109', 'ทุ่งแต้', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350110', 'สิงห์', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350111', 'นาสะไมย์', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350112', 'เขื่องคำ', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350113', 'หนองหิน', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350114', 'หนองคู', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350115', 'ขุมเงิน', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350116', 'ทุ่งนางโอก', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350117', 'หนองเรือ', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350118', 'หนองเป็ด', '3501', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350201', 'ทรายมูล', '3502', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350202', 'ดู่ลาด', '3502', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350203', 'ดงมะไฟ', '3502', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350204', 'นาเวียง', '3502', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350205', 'ไผ่', '3502', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350301', 'กุดชุม', '3503', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350302', 'โนนเปือย', '3503', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350303', 'กำแมด', '3503', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350304', 'นาโส่', '3503', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350305', 'ห้วยแก้ง', '3503', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350306', 'หนองหมี', '3503', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350307', 'โพนงาม', '3503', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350308', 'คำน้ำสร้าง', '3503', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350309', 'หนองแหน', '3503', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350401', 'ลุมพุก', '3504', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350402', 'ย่อ', '3504', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350403', 'สงเปือย', '3504', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350404', 'โพนทัน', '3504', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350405', 'ทุ่งมน', '3504', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350406', 'นาคำ', '3504', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350407', 'ดงแคนใหญ่', '3504', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350408', 'กู่จาน', '3504', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350409', 'นาแก', '3504', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350410', 'กุดกุง', '3504', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350411', 'เหล่าไฮ', '3504', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350412', 'แคนน้อย', '3504', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350413', 'ดงเจริญ', '3504', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350501', 'โพธิ์ไทร', '3505', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350502', 'กระจาย', '3505', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350503', 'โคกนาโก', '3505', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350504', 'เชียงเพ็ง', '3505', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350505', 'ศรีฐาน', '3505', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350601', 'ฟ้าหยาด', '3506', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350602', 'หัวเมือง', '3506', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350603', 'คูเมือง', '3506', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350604', 'ผือฮี', '3506', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350605', 'บากเรือ', '3506', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350606', 'ม่วง', '3506', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350607', 'โนนทราย', '3506', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350608', 'บึงแก', '3506', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350609', 'พระเสาร์', '3506', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350610', 'สงยาง', '3506', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350701', 'ฟ้าห่วน', '3507', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350702', 'กุดน้ำใส', '3507', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350703', 'น้ำอ้อม', '3507', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350704', 'ค้อวัง', '3507', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350802', 'บุ่งค้า', '3508', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350803', 'สวาท', '3508', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350805', 'ห้องแซง', '3508', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350806', 'สามัคคี', '3508', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350807', 'กุดเชียงหมี', '3508', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350810', 'สามแยก', '3508', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350811', 'กุดแห่', '3508', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350812', 'โคกสำราญ', '3508', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350813', 'สร้างมิ่ง', '3508', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350814', 'ศรีแก้ว', '3508', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350901', 'ไทยเจริญ', '3509', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350902', 'น้ำคำ', '3509', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350903', 'ส้มผ่อ', '3509', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350904', 'คำเตย', '3509', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('350905', 'คำไผ่', '3509', ' ', '35', ' ');
INSERT INTO `ref_tambol` VALUES ('360101', 'ในเมือง', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360102', 'รอบเมือง', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360103', 'โพนทอง', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360104', 'นาฝาย', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360105', 'บ้านค่าย', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360106', 'กุดตุ้ม', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360107', 'ชีลอง', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360108', 'บ้านเล่า', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360109', 'นาเสียว', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360110', 'หนองนาแซง', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360111', 'ลาดใหญ่', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360112', 'หนองไผ่', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360113', 'ท่าหินโงม', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360114', 'ห้วยต้อน', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360115', 'ห้วยบง', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360116', 'โนนสำราญ', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360117', 'โคกสูง', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360118', 'บุ่งคล้า', '3601', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360201', 'บ้านเขว้า', '3602', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360202', 'ตลาดแร้ง', '3602', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360203', 'ลุ่มลำชี', '3602', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360204', 'ชีบน', '3602', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360205', 'ภูแลนคา', '3602', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360206', 'โนนแดง', '3602', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360301', 'คอนสวรรค์', '3603', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360302', 'ยางหวาย', '3603', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360303', 'ช่องสามหมอ', '3603', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360304', 'โนนสะอาด', '3603', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360305', 'ห้วยไร่', '3603', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360306', 'บ้านโสก', '3603', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360307', 'โคกมั่งงอย', '3603', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360308', 'หนองขาม', '3603', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360309', 'ศรีสำราญ', '3603', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360401', 'บ้านยาง', '3604', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360402', 'บ้านหัน', '3604', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360403', 'บ้านเดื่อ', '3604', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360404', 'บ้านเป้า', '3604', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360405', 'กุดเลาะ', '3604', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360406', 'โนนกอก', '3604', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360407', 'สระโพนทอง', '3604', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360408', 'หนองข่า', '3604', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360409', 'หนองโพนงาม', '3604', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360410', 'บ้านบัว', '3604', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360411', 'ซับสีทอง', '3604', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360412', 'โนนทอง', '3604', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360501', 'หนองบัวแดง', '3605', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360502', 'กุดชุมแสง', '3605', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360503', 'ถ้ำวัวแดง', '3605', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360504', 'นางแดด', '3605', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360507', 'หนองแวง', '3605', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360508', 'คูเมือง', '3605', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360509', 'ท่าใหญ่', '3605', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360511', 'วังชมภู', '3605', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360601', 'บ้านกอก', '3606', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360602', 'หนองบัวบาน', '3606', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360603', 'บ้านขาม', '3606', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360605', 'กุดน้ำใส', '3606', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360606', 'หนองโดน', '3606', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360607', 'ละหาน', '3606', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360610', 'หนองบัวใหญ่', '3606', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360611', 'หนองบัวโคก', '3606', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360613', 'ส้มป่อย', '3606', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360701', 'บ้านชวน', '3607', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360702', 'บ้านเพชร', '3607', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360703', 'บ้านตาล', '3607', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360704', 'หัวทะเล', '3607', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360705', 'โคกเริงรมย์', '3607', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360706', 'เกาะมะนาว', '3607', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360707', 'โคกเพชรพัฒนา', '3607', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360801', 'หนองบัวระเหว', '3608', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360802', 'วังตะเฆ่', '3608', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360803', 'ห้วยแย้', '3608', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360804', 'โคกสะอาด', '3608', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360805', 'โสกปลาดุก', '3608', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360901', 'วะตะแบก', '3609', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360902', 'ห้วยยายจิ๋ว', '3609', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360903', 'นายางกลัก', '3609', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360904', 'บ้านไร่', '3609', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('360905', 'โป่งนก', '3609', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361001', 'ผักปัง', '3610', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361002', 'กวางโจน', '3610', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361003', 'หนองคอนไทย', '3610', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361004', 'บ้านแก้ง', '3610', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361005', 'กุดยม', '3610', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361006', 'บ้านเพชร', '3610', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361007', 'โคกสะอาด', '3610', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361008', 'หนองตูม', '3610', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361009', 'โอโล', '3610', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361010', 'ธาตุทอง', '3610', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361011', 'บ้านดอน', '3610', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361101', 'บ้านแท่น', '3611', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361102', 'สามสวน', '3611', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361103', 'สระพัง', '3611', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361104', 'บ้านเต่า', '3611', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361105', 'หนองคู', '3611', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361201', 'ช่องสามหมอ', '3612', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361202', 'หนองขาม', '3612', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361203', 'นาหนองทุ่ม', '3612', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361204', 'บ้านแก้ง', '3612', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361205', 'หนองสังข์', '3612', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361206', 'หลุบคา', '3612', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361207', 'โคกกุง', '3612', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361208', 'เก่าย่าดี', '3612', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361209', 'ท่ามะไฟหวาน', '3612', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361210', 'หนองไผ่', '3612', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361301', 'คอนสาร', '3613', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361302', 'ทุ่งพระ', '3613', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361303', 'โนนคูณ', '3613', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361304', 'ห้วยยาง', '3613', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361305', 'ทุ่งลุยลาย', '3613', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361306', 'ดงบัง', '3613', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361307', 'ทุ่งนาเลา', '3613', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361308', 'ดงกลาง', '3613', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361401', 'บ้านเจียง', '3614', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361402', 'เจาทอง', '3614', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361403', 'วังทอง', '3614', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361404', 'แหลมทอง', '3614', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361501', 'หนองฉิม', '3615', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361502', 'ตาเนิน', '3615', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361503', 'กะฮาด', '3615', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361504', 'รังงาม', '3615', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361601', 'ซับใหญ่', '3616', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361602', 'ท่ากูบ', '3616', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('361603', 'ตะโกทอง', '3616', ' ', '36', ' ');
INSERT INTO `ref_tambol` VALUES ('370101', 'บุ่ง', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370102', 'ไก่คำ', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370103', 'นาจิก', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370104', 'ปลาค้าว', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370105', 'เหล่าพรวน', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370106', 'สร้างนกทา', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370107', 'คึมใหญ่', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370108', 'นาผือ', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370109', 'น้ำปลีก', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370110', 'นาวัง', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370111', 'นาหมอม้า', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370112', 'โนนโพธิ์', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370113', 'โนนหนามแท่ง', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370114', 'ห้วยไร่', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370115', 'หนองมะแซว', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370116', 'กุดปลาดุก', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370117', 'ดอนเมย', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370118', 'นายม', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370119', 'นาแต้', '3701', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370201', 'ชานุมาน', '3702', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370202', 'โคกสาร', '3702', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370203', 'คำเขื่อนแก้ว', '3702', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370204', 'โคกก่ง', '3702', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370205', 'ป่าก่อ', '3702', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370301', 'หนองข่า', '3703', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370302', 'คำโพน', '3703', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370303', 'นาหว้า', '3703', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370304', 'ลือ', '3703', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370305', 'ห้วย', '3703', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370306', 'โนนงาม', '3703', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370307', 'นาป่าแซง', '3703', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370401', 'พนา', '3704', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370402', 'จานลาน', '3704', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370403', 'ไม้กลอน', '3704', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370404', 'พระเหลา', '3704', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370501', 'เสนางคนิคม', '3705', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370502', 'โพนทอง', '3705', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370503', 'ไร่สีสุก', '3705', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370504', 'นาเวียง', '3705', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370505', 'หนองไฮ', '3705', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370506', 'หนองสามสี', '3705', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370601', 'หัวตะพาน', '3706', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370602', 'คำพระ', '3706', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370603', 'เค็งใหญ่', '3706', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370604', 'หนองแก้ว', '3706', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370605', 'โพนเมืองน้อย', '3706', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370606', 'สร้างถ่อน้อย', '3706', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370607', 'จิกดู่', '3706', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370608', 'รัตนวารี', '3706', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370701', 'อำนาจ', '3707', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370702', 'ดงมะยาง', '3707', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370703', 'เปือย', '3707', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370704', 'ดงบัง', '3707', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370705', 'ไร่ขี', '3707', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370706', 'แมด', '3707', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('370707', 'โคกกลาง', '3707', ' ', '37', ' ');
INSERT INTO `ref_tambol` VALUES ('390101', 'หนองบัว', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390102', 'หนองภัยศูนย์', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390103', 'โพธิ์ชัย', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390104', 'หนองสวรรค์', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390105', 'หัวนา', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390106', 'บ้านขาม', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390107', 'นามะเฟือง', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390108', 'บ้านพร้าว', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390109', 'โนนขมิ้น', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390110', 'ลำภู', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390111', 'กุดจิก', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390112', 'โนนทัน', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390113', 'นาคำไฮ', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390114', 'ป่าไม้งาม', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390115', 'หนองหว้า', '3901', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390201', 'นากลาง', '3902', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390202', 'ด่านช้าง', '3902', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390205', 'กุดดินจี่', '3902', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390206', 'ฝั่งแดง', '3902', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390207', 'เก่ากลอย', '3902', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390209', 'โนนเมือง', '3902', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390210', 'อุทัยสวรรค์', '3902', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390211', 'ดงสวรรค์', '3902', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390213', 'กุดแห่', '3902', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390215', 'โนนภูทอง', '3902', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390301', 'โนนสัง', '3903', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390302', 'บ้านถิ่น', '3903', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390303', 'หนองเรือ', '3903', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390304', 'กุดดู่', '3903', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390305', 'บ้านค้อ', '3903', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390306', 'โนนเมือง', '3903', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390307', 'โคกใหญ่', '3903', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390308', 'โคกม่วง', '3903', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390309', 'นิคมพัฒนา', '3903', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390310', 'ปางกู่', '3903', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390401', 'เมืองใหม่', '3904', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390402', 'ศรีบุญเรือง', '3904', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390403', 'หนองบัวใต้', '3904', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390404', 'กุดสะเทียน', '3904', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390405', 'นากอก', '3904', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390406', 'โนนสะอาด', '3904', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390407', 'ยางหล่อ', '3904', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390408', 'โนนม่วง', '3904', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390409', 'หนองกุงแก้ว', '3904', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390410', 'หนองแก', '3904', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390411', 'ทรายทอง', '3904', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390412', 'หันนางาม', '3904', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390501', 'นาสี', '3905', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390502', 'บ้านโคก', '3905', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390503', 'นาดี', '3905', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390504', 'นาด่าน', '3905', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390505', 'ดงมะไฟ', '3905', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390506', 'สุวรรณคูหา', '3905', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390507', 'บุญทัน', '3905', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390508', 'กุดผึ้ง', '3905', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390601', 'นาเหล่า', '3906', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390602', 'นาแก', '3906', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390603', 'วังทอง', '3906', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390604', 'วังปลาป้อม', '3906', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('390605', 'เทพคีรี', '3906', ' ', '39', ' ');
INSERT INTO `ref_tambol` VALUES ('400101', 'ในเมือง', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400102', 'สำราญ', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400103', 'โคกสี', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400104', 'ท่าพระ', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400105', 'บ้านทุ่ม', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400106', 'เมืองเก่า', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400107', 'พระลับ', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400108', 'สาวะถี', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400109', 'บ้านหว้า', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400110', 'บ้านค้อ', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400111', 'แดงใหญ่', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400112', 'ดอนช้าง', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400113', 'ดอนหัน', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400114', 'ศิลา', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400115', 'บ้านเป็ด', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400116', 'หนองตูม', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400117', 'บึงเนียม', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400118', 'โนนท่อน', '4001', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400201', 'หนองบัว', '4002', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400202', 'ป่าหวายนั่ง', '4002', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400203', 'โนนฆ้อง', '4002', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400204', 'บ้านเหล่า', '4002', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400205', 'ป่ามะนาว', '4002', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400206', 'บ้านฝาง', '4002', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400207', 'โคกงาม', '4002', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400301', 'พระยืน', '4003', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400302', 'พระบุ', '4003', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400303', 'บ้านโต้น', '4003', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400304', 'หนองแวง', '4003', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400305', 'ขามป้อม', '4003', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400401', 'หนองเรือ', '4004', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400402', 'บ้านเม็ง', '4004', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400403', 'บ้านกง', '4004', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400404', 'ยางคำ', '4004', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400405', 'จระเข้', '4004', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400406', 'โนนทอง', '4004', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400407', 'กุดกว้าง', '4004', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400408', 'โนนทัน', '4004', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400409', 'โนนสะอาด', '4004', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400410', 'บ้านผือ', '4004', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400501', 'ชุมแพ', '4005', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400502', 'โนนหัน', '4005', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400503', 'นาหนองทุ่ม', '4005', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400504', 'โนนอุดม', '4005', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400505', 'ขัวเรียง', '4005', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400506', 'หนองไผ่', '4005', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400507', 'ไชยสอ', '4005', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400508', 'วังหินลาด', '4005', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400509', 'นาเพียง', '4005', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400510', 'หนองเขียด', '4005', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400511', 'หนองเสาเล้า', '4005', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400512', 'โนนสะอาด', '4005', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400601', 'สีชมพู', '4006', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400602', 'ศรีสุข', '4006', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400603', 'นาจาน', '4006', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400604', 'วังเพิ่ม', '4006', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400605', 'ซำยาง', '4006', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400606', 'หนองแดง', '4006', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400607', 'ดงลาน', '4006', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400608', 'บริบูรณ์', '4006', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400609', 'บ้านใหม่', '4006', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400610', 'ภูห่าน', '4006', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400701', 'น้ำพอง', '4007', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400702', 'วังชัย', '4007', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400703', 'หนองกุง', '4007', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400704', 'บัวใหญ่', '4007', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400705', 'สะอาด', '4007', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400706', 'ม่วงหวาน', '4007', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400707', 'บ้านขาม', '4007', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400708', 'บัวเงิน', '4007', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400709', 'ทรายมูล', '4007', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400710', 'ท่ากระเสริม', '4007', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400711', 'พังทุย', '4007', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400712', 'กุดน้ำใส', '4007', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400801', 'โคกสูง', '4008', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400802', 'บ้านดง', '4008', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400803', 'เขื่อนอุบลรัตน์', '4008', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400804', 'นาคำ', '4008', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400805', 'ศรีสุขสำราญ', '4008', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400806', 'ทุ่งโป่ง', '4008', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400901', 'หนองโก', '4009', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400902', 'หนองกุงใหญ่', '4009', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400905', 'ห้วยโจด', '4009', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400906', 'ห้วยยาง', '4009', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400907', 'บ้านฝาง', '4009', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400909', 'ดูนสาด', '4009', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400910', 'หนองโน', '4009', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400911', 'น้ำอ้อม', '4009', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('400912', 'หัวนาคำ', '4009', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401001', 'บ้านไผ่', '4010', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401002', 'ในเมือง', '4010', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401005', 'เมืองเฟีย', '4010', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401009', 'บ้านลาน', '4010', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401010', 'แคนเหนือ', '4010', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401011', 'ภูเหล็ก', '4010', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401013', 'ป่าปอ', '4010', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401014', 'หินตั้ง', '4010', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401016', 'หนองน้ำใส', '4010', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401017', 'หัวหนอง', '4010', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401101', 'เปือยน้อย', '4011', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401102', 'วังม่วง', '4011', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401103', 'ขามป้อม', '4011', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401104', 'สระแก้ว', '4011', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401201', 'เมืองพล', '4012', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401203', 'โจดหนองแก', '4012', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401204', 'เก่างิ้ว', '4012', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401205', 'หนองมะเขือ', '4012', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401206', 'หนองแวงโสกพระ', '4012', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401207', 'เพ็กใหญ่', '4012', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401208', 'โคกสง่า', '4012', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401209', 'หนองแวงนางเบ้า', '4012', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401210', 'ลอมคอม', '4012', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401211', 'โนนข่า', '4012', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401212', 'โสกนกเต็น', '4012', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401213', 'หัวทุ่ง', '4012', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401301', 'คอนฉิม', '4013', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401302', 'ใหม่นาเพียง', '4013', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401303', 'โนนทอง', '4013', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401304', 'แวงใหญ่', '4013', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401305', 'โนนสะอาด', '4013', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401401', 'แวงน้อย', '4014', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401402', 'ก้านเหลือง', '4014', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401403', 'ท่านางแนว', '4014', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401404', 'ละหานนา', '4014', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401405', 'ท่าวัด', '4014', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401406', 'ทางขวาง', '4014', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401501', 'หนองสองห้อง', '4015', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401502', 'คึมชาด', '4015', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401503', 'โนนธาตุ', '4015', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401504', 'ตะกั่วป่า', '4015', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401505', 'สำโรง', '4015', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401506', 'หนองเม็ก', '4015', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401507', 'ดอนดู่', '4015', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401508', 'ดงเค็ง', '4015', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401509', 'หันโจด', '4015', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401510', 'ดอนดั่ง', '4015', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401511', 'วังหิน', '4015', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401512', 'หนองไผ่ล้อม', '4015', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401601', 'บ้านเรือ', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401602', 'ในเมือง', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401604', 'หว้าทอง', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401605', 'กุดขอนแก่น', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401606', 'นาชุมแสง', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401607', 'นาหว้า', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401608', 'เขาน้อย', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401610', 'หนองกุงธนสาร', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401612', 'หนองกุงเซิน', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401613', 'สงเปือย', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401614', 'ทุ่งชมพู', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401615', 'เมืองเก่าพัฒนา', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401616', 'ดินดำ', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401617', 'ภูเวียง', '4016', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401701', 'กุดเค้า', '4017', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401702', 'สวนหม่อน', '4017', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401703', 'หนองแปน', '4017', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401704', 'โพนเพ็ก', '4017', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401705', 'คำแคน', '4017', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401706', 'นาข่า', '4017', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401707', 'นางาม', '4017', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401710', 'ท่าศาลา', '4017', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401801', 'ชนบท', '4018', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401802', 'กุดเพียขอม', '4018', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401803', 'วังแสง', '4018', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401804', 'ห้วยแก', '4018', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401805', 'บ้านแท่น', '4018', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401806', 'ศรีบุญเรือง', '4018', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401807', 'โนนพะยอม', '4018', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401808', 'ปอแดง', '4018', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401901', 'เขาสวนกวาง', '4019', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401902', 'ดงเมืองแอม', '4019', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401903', 'นางิ้ว', '4019', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401904', 'โนนสมบูรณ์', '4019', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('401905', 'คำม่วง', '4019', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402001', 'โนนคอม', '4020', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402002', 'นาฝาย', '4020', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402003', 'ภูผาม่าน', '4020', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402004', 'วังสวาบ', '4020', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402005', 'ห้วยม่วง', '4020', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402101', 'กระนวน', '4021', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402102', 'คำแมด', '4021', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402103', 'บ้านโนน', '4021', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402104', 'คูคำ', '4021', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402105', 'ห้วยเตย', '4021', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402201', 'บ้านโคก', '4022', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402202', 'โพธิ์ไชย', '4022', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402203', 'ซับสมบูรณ์', '4022', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402204', 'นาแพง', '4022', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402301', 'กุดธาตุ', '4023', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402302', 'บ้านโคก', '4023', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402303', 'ขนวน', '4023', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402401', 'บ้านแฮด', '4024', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402402', 'โคกสำราญ', '4024', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402403', 'โนนสมบูรณ์', '4024', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402404', 'หนองแซง', '4024', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402501', 'โนนศิลา', '4025', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402502', 'หนองปลาหมอ', '4025', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402503', 'บ้านหัน', '4025', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402504', 'เปือยใหญ่', '4025', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('402505', 'โนนแดง', '4025', ' ', '40', ' ');
INSERT INTO `ref_tambol` VALUES ('410101', 'หมากแข้ง', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410102', 'นิคมสงเคราะห์', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410103', 'บ้านขาว', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410104', 'หนองบัว', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410105', 'บ้านตาด', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410106', 'โนนสูง', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410107', 'หมูม่น', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410108', 'เชียงยืน', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410109', 'หนองนาคำ', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410110', 'กุดสระ', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410111', 'นาดี', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410112', 'บ้านเลื่อม', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410113', 'เชียงพิณ', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410114', 'สามพร้าว', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410115', 'หนองไฮ', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410116', 'นาข่า', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410117', 'บ้านจั่น', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410118', 'หนองขอนกว้าง', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410119', 'โคกสะอาด', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410120', 'นากว้าง', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410121', 'หนองไผ่', '4101', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410201', 'กุดจับ', '4102', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410202', 'ปะโค', '4102', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410203', 'ขอนยูง', '4102', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410204', 'เชียงเพ็ง', '4102', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410205', 'สร้างก่อ', '4102', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410206', 'เมืองเพีย', '4102', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410207', 'ตาลเลียน', '4102', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410301', 'หมากหญ้า', '4103', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410302', 'หนองอ้อ', '4103', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410303', 'อูบมุง', '4103', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410304', 'กุดหมากไฟ', '4103', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410305', 'น้ำพ่น', '4103', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410306', 'หนองบัวบาน', '4103', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410307', 'โนนหวาย', '4103', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410308', 'หนองวัวซอ', '4103', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410401', 'ตูมใต้', '4104', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410402', 'พันดอน', '4104', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410403', 'เวียงคำ', '4104', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410404', 'แชแล', '4104', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410406', 'เชียงแหว', '4104', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410407', 'ห้วยเกิ้ง', '4104', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410409', 'เสอเพลอ', '4104', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410410', 'สีออ', '4104', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410411', 'ปะโค', '4104', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410413', 'ผาสุก', '4104', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410414', 'ท่าลี่', '4104', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410415', 'กุมภวาปี', '4104', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410416', 'หนองหว้า', '4104', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410501', 'โนนสะอาด', '4105', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410502', 'บุ่งแก้ว', '4105', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410503', 'โพธิ์ศรีสำราญ', '4105', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410504', 'ทมนางาม', '4105', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410505', 'หนองกุงศรี', '4105', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410506', 'โคกกลาง', '4105', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410601', 'หนองหาน', '4106', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410602', 'หนองเม็ก', '4106', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410605', 'พังงู', '4106', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410606', 'สะแบง', '4106', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410607', 'สร้อยพร้าว', '4106', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410609', 'บ้านเชียง', '4106', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410610', 'บ้านยา', '4106', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410611', 'โพนงาม', '4106', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410612', 'ผักตบ', '4106', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410614', 'หนองไผ่', '4106', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410617', 'ดอนหายโศก', '4106', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410618', 'หนองสระปลา', '4106', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410701', 'ทุ่งฝน', '4107', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410702', 'ทุ่งใหญ่', '4107', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410703', 'นาชุมแสง', '4107', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410704', 'นาทม', '4107', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410801', 'ไชยวาน', '4108', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410802', 'หนองหลัก', '4108', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410803', 'คำเลาะ', '4108', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410804', 'โพนสูง', '4108', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410901', 'ศรีธาตุ', '4109', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410902', 'จำปี', '4109', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410903', 'บ้านโปร่ง', '4109', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410904', 'หัวนาคำ', '4109', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410905', 'หนองนกเขียน', '4109', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410906', 'นายูง', '4109', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('410907', 'ตาดทอง', '4109', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411001', 'หนองกุงทับม้า', '4110', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411002', 'หนองหญ้าไซ', '4110', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411003', 'บะยาว', '4110', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411004', 'ผาสุก', '4110', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411005', 'คำโคกสูง', '4110', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411006', 'วังสามหมอ', '4110', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411101', 'ศรีสุทโธ', '4111', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411102', 'บ้านดุง', '4111', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411103', 'ดงเย็น', '4111', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411104', 'โพนสูง', '4111', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411105', 'อ้อมกอ', '4111', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411106', 'บ้านจันทน์', '4111', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411107', 'บ้านชัย', '4111', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411108', 'นาไหม', '4111', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411109', 'ถ่อนนาลับ', '4111', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411110', 'วังทอง', '4111', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411111', 'บ้านม่วง', '4111', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411112', 'บ้านตาด', '4111', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411113', 'นาคำ', '4111', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411701', 'บ้านผือ', '4117', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411702', 'หายโศก', '4117', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411703', 'เขือน้ำ', '4117', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411704', 'คำบง', '4117', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411705', 'โนนทอง', '4117', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411706', 'ข้าวสาร', '4117', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411707', 'จำปาโมง', '4117', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411708', 'กลางใหญ่', '4117', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411709', 'เมืองพาน', '4117', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411710', 'คำด้วง', '4117', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411711', 'หนองหัวคู', '4117', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411712', 'บ้านค้อ', '4117', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411713', 'หนองแวง', '4117', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411801', 'นางัว', '4118', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411802', 'น้ำโสม', '4118', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411805', 'หนองแวง', '4118', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411806', 'บ้านหยวก', '4118', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411807', 'โสมเยี่ยม', '4118', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411810', 'ศรีสำราญ', '4118', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411812', 'สามัคคี', '4118', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411901', 'เพ็ญ', '4119', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411902', 'บ้านธาตุ', '4119', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411903', 'นาพู่', '4119', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411904', 'เชียงหวาง', '4119', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411905', 'สุมเส้า', '4119', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411906', 'นาบัว', '4119', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411907', 'บ้านเหล่า', '4119', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411908', 'จอมศรี', '4119', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411909', 'เตาไห', '4119', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411910', 'โคกกลาง', '4119', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('411911', 'สร้างแป้น', '4119', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412001', 'สร้างคอม', '4120', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412002', 'เชียงดา', '4120', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412003', 'บ้านยวด', '4120', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412004', 'บ้านโคก', '4120', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412005', 'นาสะอาด', '4120', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412006', 'บ้านหินโงม', '4120', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412101', 'หนองแสง', '4121', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412102', 'แสงสว่าง', '4121', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412103', 'นาดี', '4121', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412104', 'ทับกุง', '4121', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412201', 'นายูง', '4122', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412202', 'บ้านก้อง', '4122', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412203', 'นาแค', '4122', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412204', 'โนนทอง', '4122', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412301', 'บ้านแดง', '4123', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412302', 'นาทราย', '4123', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412303', 'ดอนกลอย', '4123', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412401', 'บ้านจีต', '4124', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412402', 'โนนทองอินทร์', '4124', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412403', 'ค้อใหญ่', '4124', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412404', 'คอนสาย', '4124', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412501', 'นาม่วง', '4125', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412502', 'ห้วยสามพาด', '4125', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('412503', 'อุ่มจาน', '4125', ' ', '41', ' ');
INSERT INTO `ref_tambol` VALUES ('420101', 'กุดป่อง', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420102', 'เมือง', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420103', 'นาอ้อ', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420104', 'กกดู่', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420105', 'น้ำหมาน', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420106', 'เสี้ยว', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420107', 'นาอาน', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420108', 'นาโป่ง', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420109', 'นาดินดำ', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420110', 'น้ำสวย', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420111', 'ชัยพฤกษ์', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420112', 'นาแขม', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420113', 'ศรีสองรัก', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420114', 'กกทอง', '4201', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420201', 'นาด้วง', '4202', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420202', 'นาดอกคำ', '4202', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420203', 'ท่าสะอาด', '4202', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420204', 'ท่าสวรรค์', '4202', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420301', 'เชียงคาน', '4203', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420302', 'ธาตุ', '4203', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420303', 'นาซ่าว', '4203', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420304', 'เขาแก้ว', '4203', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420305', 'ปากตม', '4203', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420306', 'บุฮม', '4203', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420307', 'จอมศรี', '4203', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420308', 'หาดทรายขาว', '4203', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420401', 'ปากชม', '4204', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420402', 'เชียงกลม', '4204', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420403', 'หาดคัมภีร์', '4204', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420404', 'ห้วยบ่อซืน', '4204', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420405', 'ห้วยพิชัย', '4204', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420406', 'ชมเจริญ', '4204', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420501', 'ด่านซ้าย', '4205', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420502', 'ปากหมัน', '4205', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420503', 'นาดี', '4205', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420504', 'โคกงาม', '4205', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420505', 'โพนสูง', '4205', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420506', 'อิปุ่ม', '4205', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420507', 'กกสะทอน', '4205', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420508', 'โป่ง', '4205', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420509', 'วังยาว', '4205', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420510', 'นาหอ', '4205', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420601', 'นาแห้ว', '4206', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420602', 'แสงภา', '4206', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420603', 'นาพึง', '4206', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420604', 'นามาลา', '4206', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420605', 'เหล่ากอหก', '4206', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420701', 'หนองบัว', '4207', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420702', 'ท่าศาลา', '4207', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420703', 'ร่องจิก', '4207', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420704', 'ปลาบ่า', '4207', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420705', 'ลาดค่าง', '4207', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420706', 'สานตม', '4207', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420801', 'ท่าลี่', '4208', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420802', 'หนองผือ', '4208', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420803', 'อาฮี', '4208', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420804', 'น้ำแคม', '4208', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420805', 'โคกใหญ่', '4208', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420806', 'น้ำทูน', '4208', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420901', 'วังสะพุง', '4209', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420902', 'ทรายขาว', '4209', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420903', 'หนองหญ้าปล้อง', '4209', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420904', 'หนองงิ้ว', '4209', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420905', 'ปากปวน', '4209', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420906', 'ผาน้อย', '4209', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420910', 'ผาบิ้ง', '4209', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420911', 'เขาหลวง', '4209', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420912', 'โคกขมิ้น', '4209', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('420913', 'ศรีสงคราม', '4209', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421001', 'ศรีฐาน', '4210', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421005', 'ผานกเค้า', '4210', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421007', 'ภูกระดึง', '4210', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421010', 'ห้วยส้ม', '4210', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421101', 'ภูหอ', '4211', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421102', 'หนองคัน', '4211', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421103', 'วังน้ำใส', '4211', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421104', 'ห้วยสีเสียด', '4211', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421105', 'เลยวังไสย์', '4211', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421106', 'แก่งศรีภูมิ', '4211', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421201', 'ผาขาว', '4212', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421202', 'ท่าช้างคล้อง', '4212', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421203', 'โนนปอแดง', '4212', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421204', 'โนนป่าซาง', '4212', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421205', 'บ้านเพิ่ม', '4212', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421301', 'เอราวัณ', '4213', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421302', 'ผาอินทร์แปลง', '4213', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421303', 'ผาสามยอด', '4213', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421304', 'ทรัพย์ไพวัลย์', '4213', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421401', 'หนองหิน', '4214', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421402', 'ตาดข่า', '4214', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('421403', 'ปวนพุ', '4214', ' ', '42', ' ');
INSERT INTO `ref_tambol` VALUES ('430101', 'ในเมือง', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430102', 'มีชัย', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430103', 'โพธิ์ชัย', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430104', 'กวนวัน', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430105', 'เวียงคุก', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430106', 'วัดธาตุ', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430107', 'หาดคำ', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430108', 'หินโงม', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430109', 'บ้านเดื่อ', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430110', 'ค่ายบกหวาน', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430111', 'สองห้อง', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430113', 'พระธาตุบังพวน', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430116', 'หนองกอมเกาะ', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430117', 'ปะโค', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430118', 'เมืองหมี', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430119', 'สีกาย', '4301', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430201', 'ท่าบ่อ', '4302', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430202', 'น้ำโมง', '4302', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430203', 'กองนาง', '4302', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430204', 'โคกคอน', '4302', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430205', 'บ้านเดื่อ', '4302', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430206', 'บ้านถ่อน', '4302', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430207', 'บ้านว่าน', '4302', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430208', 'นาข่า', '4302', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430209', 'โพนสา', '4302', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430210', 'หนองนาง', '4302', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430301', 'บึงกาฬ', '4303', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430303', 'โนนสมบูรณ์', '4303', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430304', 'หนองเข็ง', '4303', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430305', 'หอคำ', '4303', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430306', 'หนองเลิง', '4303', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430307', 'โคกก่อง', '4303', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430310', 'นาสวรรค์', '4303', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430311', 'ไคสี', '4303', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430314', 'ชัยพร', '4303', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430316', 'วิศิษฐ์', '4303', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430318', 'คำนาดี', '4303', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430319', 'โป่งเปือย', '4303', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430401', 'ศรีชมภู', '4304', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430402', 'ดอนหญ้านาง', '4304', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430403', 'พรเจริญ', '4304', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430404', 'หนองหัวช้าง', '4304', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430405', 'วังชมภู', '4304', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430406', 'ป่าแฝก', '4304', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430407', 'ศรีสำราญ', '4304', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430501', 'จุมพล', '4305', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430502', 'วัดหลวง', '4305', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430503', 'กุดบง', '4305', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430504', 'ชุมช้าง', '4305', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430506', 'ทุ่งหลวง', '4305', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430507', 'เหล่าต่างคำ', '4305', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430508', 'นาหนัง', '4305', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430509', 'เซิม', '4305', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430513', 'บ้านโพธิ์', '4305', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430521', 'บ้านผือ', '4305', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430522', 'สร้างนางขาว', '4305', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430601', 'โซ่', '4306', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430602', 'หนองพันทา', '4306', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430603', 'ศรีชมภู', '4306', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430604', 'คำแก้ว', '4306', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430605', 'บัวตูม', '4306', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430606', 'ถ้ำเจริญ', '4306', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430607', 'เหล่าทอง', '4306', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430701', 'พานพร้าว', '4307', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430703', 'บ้านหม้อ', '4307', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430704', 'พระพุทธบาท', '4307', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430705', 'หนองปลาปาก', '4307', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430801', 'แก้งไก่', '4308', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430802', 'ผาตั้ง', '4308', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430803', 'บ้านม่วง', '4308', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430804', 'นางิ้ว', '4308', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430805', 'สังคม', '4308', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430901', 'เซกา', '4309', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430902', 'ซาง', '4309', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430903', 'ท่ากกแดง', '4309', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430906', 'บ้านต้อง', '4309', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430907', 'ป่งไฮ', '4309', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430908', 'น้ำจั้น', '4309', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430909', 'ท่าสะอาด', '4309', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430912', 'หนองทุ่ม', '4309', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('430913', 'โสกก่าม', '4309', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431001', 'ปากคาด', '4310', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431002', 'หนองยอง', '4310', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431003', 'นากั้ง', '4310', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431004', 'โนนศิลา', '4310', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431005', 'สมสนุก', '4310', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431006', 'นาดง', '4310', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431101', 'บึงโขงหลง', '4311', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431102', 'โพธิ์หมากแข้ง', '4311', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431103', 'ดงบัง', '4311', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431104', 'ท่าดอกคำ', '4311', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431201', 'ศรีวิไล', '4312', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431202', 'ชุมภูพร', '4312', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431203', 'นาแสง', '4312', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431204', 'นาสะแบง', '4312', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431205', 'นาสิงห์', '4312', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431301', 'บุ่งคล้า', '4313', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431302', 'หนองเดิ่น', '4313', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431303', 'โคกกว้าง', '4313', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431401', 'สระใคร', '4314', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431402', 'คอกช้าง', '4314', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431403', 'บ้านฝาง', '4314', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431501', 'เฝ้าไร่', '4315', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431502', 'นาดี', '4315', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431503', 'หนองหลวง', '4315', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431504', 'วังหลวง', '4315', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431505', 'อุดมพร', '4315', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431601', 'รัตนวาปี', '4316', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431602', 'นาทับไฮ', '4316', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431603', 'บ้านต้อน', '4316', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431604', 'พระบาทนาสิงห์', '4316', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431605', 'โพนแพง', '4316', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431701', 'โพธิ์ตาก', '4317', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431702', 'โพนทอง', '4317', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('431703', 'ด่านศรีสุข', '4317', ' ', '43', ' ');
INSERT INTO `ref_tambol` VALUES ('440101', 'ตลาด', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440102', 'เขวา', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440103', 'ท่าตูม', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440104', 'แวงน่าง', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440105', 'โคกก่อ', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440106', 'ดอนหว่าน', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440107', 'เกิ้ง', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440108', 'แก่งเลิงจาน', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440109', 'ท่าสองคอน', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440110', 'ลาดพัฒนา', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440111', 'หนองปลิง', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440112', 'ห้วยแอ่ง', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440113', 'หนองโน', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440114', 'บัวค้อ', '4401', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440201', 'แกดำ', '4402', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440202', 'วังแสง', '4402', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440203', 'มิตรภาพ', '4402', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440204', 'หนองกุง', '4402', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440205', 'โนนภิบาล', '4402', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440301', 'หัวขวาง', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440302', 'ยางน้อย', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440303', 'วังยาว', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440304', 'เขวาไร่', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440305', 'แพง', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440306', 'แก้งแก', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440307', 'หนองเหล็ก', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440308', 'หนองบัว', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440309', 'เหล่า', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440310', 'เขื่อน', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440311', 'หนองบอน', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440312', 'โพนงาม', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440313', 'ยางท่าแจ้ง', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440314', 'แห่ใต้', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440315', 'หนองกุงสวรรค์', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440316', 'เลิงใต้', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440317', 'ดอนกลาง', '4403', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440401', 'โคกพระ', '4404', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440402', 'คันธารราษฎร์', '4404', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440403', 'มะค่า', '4404', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440404', 'ท่าขอนยาง', '4404', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440405', 'นาสีนวน', '4404', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440406', 'ขามเรียง', '4404', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440407', 'เขวาใหญ่', '4404', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440408', 'ศรีสุข', '4404', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440409', 'กุดใส้จ่อ', '4404', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440410', 'ขามเฒ่าพัฒนา', '4404', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440501', 'เชียงยืน', '4405', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440503', 'หนองซอน', '4405', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440505', 'ดอนเงิน', '4405', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440506', 'กู่ทอง', '4405', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440507', 'นาทอง', '4405', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440508', 'เสือเฒ่า', '4405', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440511', 'โพนทอง', '4405', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440512', 'เหล่าบัวบาน', '4405', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440601', 'บรบือ', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440602', 'บ่อใหญ่', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440604', 'วังไชย', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440605', 'หนองม่วง', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440606', 'กำพี้', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440607', 'โนนราษี', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440608', 'โนนแดง', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440610', 'หนองจิก', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440611', 'บัวมาศ', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440613', 'หนองคูขาด', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440615', 'วังใหม่', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440616', 'ยาง', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440618', 'หนองสิม', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440619', 'หนองโก', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440620', 'ดอนงัว', '4406', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440701', 'นาเชือก', '4407', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440702', 'สำโรง', '4407', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440703', 'หนองแดง', '4407', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440704', 'เขวาไร่', '4407', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440705', 'หนองโพธิ์', '4407', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440706', 'ปอพาน', '4407', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440707', 'หนองเม็ก', '4407', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440708', 'หนองเรือ', '4407', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440709', 'หนองกุง', '4407', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440710', 'สันป่าตอง', '4407', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440801', 'ปะหลาน', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440802', 'ก้ามปู', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440803', 'เวียงสะอาด', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440804', 'เม็กดำ', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440805', 'นาสีนวล', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440809', 'ราษฎร์เจริญ', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440810', 'หนองบัวแก้ว', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440812', 'เมืองเตา', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440815', 'ลานสะแก', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440816', 'เวียงชัย', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440817', 'หนองบัว', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440818', 'ราษฎร์พัฒนา', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440819', 'เมืองเสือ', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440820', 'ภารแอ่น', '4408', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440901', 'หนองแสง', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440902', 'ขามป้อม', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440903', 'เสือโก้ก', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440904', 'ดงใหญ่', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440905', 'โพธิ์ชัย', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440906', 'หัวเรือ', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440907', 'แคน', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440908', 'งัวบา', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440909', 'นาข่า', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440910', 'บ้านหวาย', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440911', 'หนองไฮ', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440912', 'ประชาพัฒนา', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440913', 'หนองทุ่ม', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440914', 'หนองแสน', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('440915', 'โคกสีทองหลาง', '4409', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441001', 'นาดูน', '4410', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441002', 'หนองไผ่', '4410', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441003', 'หนองคู', '4410', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441004', 'ดงบัง', '4410', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441005', 'ดงดวน', '4410', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441006', 'หัวดง', '4410', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441007', 'ดงยาง', '4410', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441008', 'กู่สันตรัตน์', '4410', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441009', 'พระธาตุ', '4410', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441101', 'ยางสีสุราช', '4411', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441102', 'นาภู', '4411', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441103', 'แวงดง', '4411', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441104', 'บ้านกู่', '4411', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441105', 'ดงเมือง', '4411', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441106', 'ขามเรียน', '4411', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441107', 'หนองบัวสันตุ', '4411', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441201', 'กุดรัง', '4412', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441202', 'นาโพธิ์', '4412', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441203', 'เลิงแฝก', '4412', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441204', 'หนองแวง', '4412', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441205', 'ห้วยเตย', '4412', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441301', 'ชื่นชม', '4413', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441302', 'กุดปลาดุก', '4413', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441303', 'เหล่าดอกไม้', '4413', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('441304', 'หนองกุง', '4413', ' ', '44', ' ');
INSERT INTO `ref_tambol` VALUES ('450101', 'ในเมือง', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450102', 'รอบเมือง', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450103', 'เหนือเมือง', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450104', 'ขอนแก่น', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450105', 'นาโพธิ์', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450106', 'สะอาดสมบูรณ์', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450108', 'สีแก้ว', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450109', 'ปอภาร  (ปอพาน)', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450110', 'โนนรัง', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450117', 'หนองแก้ว', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450118', 'หนองแวง', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450120', 'ดงลาน', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450123', 'แคนใหญ่', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450124', 'โนนตาล', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450125', 'เมืองทอง', '4501', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450201', 'เกษตรวิสัย', '4502', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450202', 'เมืองบัว', '4502', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450203', 'เหล่าหลวง', '4502', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450204', 'สิงห์โคก', '4502', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450205', 'ดงครั่งใหญ่', '4502', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450206', 'บ้านฝาง', '4502', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450207', 'หนองแวง', '4502', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450208', 'กำแพง', '4502', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450209', 'กู่กาสิงห์', '4502', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450210', 'น้ำอ้อม', '4502', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450211', 'โนนสว่าง', '4502', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450212', 'ทุ่งทอง', '4502', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450213', 'ดงครั่งน้อย', '4502', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450301', 'บัวแดง', '4503', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450302', 'ดอกล้ำ', '4503', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450303', 'หนองแคน', '4503', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450304', 'โพนสูง', '4503', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450305', 'โนนสวรรค์', '4503', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450306', 'สระบัว', '4503', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450307', 'โนนสง่า', '4503', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450308', 'ขี้เหล็ก', '4503', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450401', 'หัวช้าง', '4504', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450402', 'หนองผือ', '4504', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450403', 'เมืองหงส์', '4504', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450404', 'โคกล่าม', '4504', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450405', 'น้ำใส', '4504', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450406', 'ดงแดง', '4504', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450407', 'ดงกลาง', '4504', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450408', 'ป่าสังข์', '4504', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450409', 'อีง่อง', '4504', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450410', 'ลิ้นฟ้า', '4504', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450411', 'ดู่น้อย', '4504', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450412', 'ศรีโคตร', '4504', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450501', 'นิเวศน์', '4505', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450502', 'ธงธานี', '4505', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450503', 'หนองไผ่', '4505', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450504', 'ธวัชบุรี', '4505', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450506', 'อุ่มเม้า', '4505', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450507', 'มะอึ', '4505', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450510', 'เขวาทุ่ง', '4505', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450515', 'ไพศาล', '4505', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450517', 'เมืองน้อย', '4505', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450518', 'โนนศิลา', '4505', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450520', 'บึงนคร', '4505', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450522', 'ราชธานี', '4505', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450524', 'หนองพอก', '4505', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450601', 'พนมไพร', '4506', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450602', 'แสนสุข', '4506', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450603', 'กุดน้ำใส', '4506', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450604', 'หนองทัพไทย', '4506', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450605', 'โพธิ์ใหญ่', '4506', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450606', 'วารีสวัสดิ์', '4506', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450607', 'โคกสว่าง', '4506', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450611', 'โพธิ์ชัย', '4506', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450612', 'นานวล', '4506', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450613', 'คำไฮ', '4506', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450614', 'สระแก้ว', '4506', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450615', 'ค้อใหญ่', '4506', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450617', 'ชานุวรรณ', '4506', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450701', 'แวง', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450702', 'โคกกกม่วง', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450703', 'นาอุดม', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450704', 'สว่าง', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450705', 'หนองใหญ่', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450706', 'โพธิ์ทอง', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450707', 'โนนชัยศรี', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450708', 'โพธิ์ศรีสว่าง', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450709', 'อุ่มเม่า', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450710', 'คำนาดี', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450711', 'พรมสวรรค์', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450712', 'สระนกแก้ว', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450713', 'วังสามัคคี', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450714', 'โคกสูง', '4507', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450801', 'ขามเบี้ย', '4508', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450802', 'เชียงใหม่', '4508', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450803', 'บัวคำ', '4508', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450804', 'อัคคะคำ', '4508', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450805', 'สะอาด', '4508', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450806', 'คำพอุง', '4508', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450807', 'หนองตาไก้', '4508', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450808', 'ดอนโอง', '4508', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450809', 'โพธิ์ศรี', '4508', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450901', 'หนองพอก', '4509', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450902', 'บึงงาม', '4509', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450903', 'ภูเขาทอง', '4509', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450904', 'กกโพธิ์', '4509', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450905', 'โคกสว่าง', '4509', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450906', 'หนองขุ่นใหญ่', '4509', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450907', 'รอบเมือง', '4509', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450908', 'ผาน้ำย้อย', '4509', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('450909', 'ท่าสีดา', '4509', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451001', 'กลาง', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451002', 'นางาม', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451003', 'เมืองไพร', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451004', 'นาแซง', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451005', 'นาเมือง', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451006', 'วังหลวง', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451007', 'ท่าม่วง', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451008', 'ขวาว', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451009', 'โพธิ์ทอง', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451010', 'ภูเงิน', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451011', 'เกาะแก้ว', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451012', 'นาเลิง', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451013', 'เหล่าน้อย', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451014', 'ศรีวิลัย', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451015', 'หนองหลวง', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451016', 'พรสวรรค์', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451017', 'ขวัญเมือง', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451018', 'บึงเกลือ', '4510', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451101', 'สระคู', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451102', 'ดอกไม้', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451103', 'นาใหญ่', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451104', 'หินกอง', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451105', 'เมืองทุ่ง', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451106', 'หัวโทน', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451107', 'บ่อพันขัน', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451108', 'ทุ่งหลวง', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451109', 'เปลือย', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451110', 'น้ำคำ', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451111', 'ห้วยหินลาด', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451112', 'ช้างเผือก', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451113', 'ทุ่งกุลา', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451114', 'ทุ่งศรีเมือง', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451115', 'จำปาขัน', '4511', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451201', 'หนองผือ', '4512', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451202', 'หนองหิน', '4512', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451203', 'คูเมือง', '4512', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451204', 'กกกุง', '4512', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451205', 'เมืองสรวง', '4512', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451301', 'โพนทราย', '4513', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451302', 'สามขา', '4513', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451303', 'ศรีสว่าง', '4513', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451304', 'ยางคำ', '4513', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451305', 'ท่าหาดยาว', '4513', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451401', 'อาจสามารถ', '4514', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451402', 'โพนเมือง', '4514', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451403', 'บ้านแจ้ง', '4514', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451404', 'หน่อม', '4514', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451405', 'หนองหมื่นถ่าน', '4514', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451406', 'หนองขาม', '4514', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451407', 'โหรา', '4514', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451408', 'หนองบัว', '4514', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451409', 'ขี้เหล็ก', '4514', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451410', 'บ้านดู่', '4514', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451501', 'เมยวดี', '4515', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451502', 'ชุมพร', '4515', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451503', 'บุ่งเลิศ', '4515', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451504', 'ชมสะอาด', '4515', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451601', 'โพธิ์ทอง', '4516', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451602', 'ศรีสมเด็จ', '4516', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451603', 'เมืองเปลือย', '4516', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451604', 'หนองใหญ่', '4516', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451605', 'สวนจิก', '4516', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451606', 'โพธิ์สัย', '4516', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451607', 'หนองแวงควง', '4516', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451608', 'บ้านบาก', '4516', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451701', 'ดินดำ', '4517', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451702', 'ปาฝา', '4517', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451703', 'ม่วงลาด', '4517', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451704', 'จังหาร', '4517', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451705', 'ดงสิงห์', '4517', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451706', 'ยางใหญ่', '4517', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451707', 'ผักแว่น', '4517', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451708', 'แสนชาติ', '4517', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451801', 'เชียงขวัญ', '4518', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451802', 'พลับพลา', '4518', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451803', 'พระธาตุ', '4518', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451804', 'พระเจ้า', '4518', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451805', 'หมูม้น', '4518', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451806', 'บ้านเขือง', '4518', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451901', 'หนองฮี', '4519', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451902', 'สาวแห', '4519', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451903', 'ดูกอึ่ง', '4519', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('451904', 'เด่นราษฎร์', '4519', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('452001', 'ทุ่งเขาหลวง', '4520', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('452002', 'เทอดไทย', '4520', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('452003', 'บึงงาม', '4520', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('452004', 'มะบ้า', '4520', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('452005', 'เหล่า', '4520', ' ', '45', ' ');
INSERT INTO `ref_tambol` VALUES ('460101', 'กาฬสินธุ์', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460102', 'เหนือ', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460103', 'หลุบ', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460104', 'ไผ่', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460105', 'ลำปาว', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460106', 'ลำพาน', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460107', 'เชียงเครือ', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460108', 'บึงวิชัย', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460109', 'ห้วยโพธิ์', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460111', 'ภูปอ', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460113', 'ภูดิน', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460115', 'หนองกุง', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460116', 'กลางหมื่น', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460117', 'ขมิ้น', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460119', 'โพนทอง', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460120', 'นาจารย์', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460121', 'ลำคลอง', '4601', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460201', 'นามน', '4602', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460202', 'ยอดแกง', '4602', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460203', 'สงเปลือย', '4602', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460204', 'หลักเหลี่ยม', '4602', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460205', 'หนองบัว', '4602', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460301', 'กมลาไสย', '4603', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460302', 'หลักเมือง', '4603', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460303', 'โพนงาม', '4603', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460304', 'ดงลิง', '4603', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460305', 'ธัญญา', '4603', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460308', 'หนองแปน', '4603', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460310', 'เจ้าท่า', '4603', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460311', 'โคกสมบูรณ์', '4603', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460401', 'ร่องคำ', '4604', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460402', 'สามัคคี', '4604', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460403', 'เหล่าอ้อย', '4604', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460501', 'บัวขาว', '4605', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460502', 'แจนแลน', '4605', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460503', 'เหล่าใหญ่', '4605', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460504', 'จุมจัง', '4605', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460505', 'เหล่าไฮงาม', '4605', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460506', 'กุดหว้า', '4605', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460507', 'สามขา', '4605', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460508', 'นาขาม', '4605', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460509', 'หนองห้าง', '4605', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460510', 'นาโก', '4605', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460511', 'สมสะอาด', '4605', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460512', 'กุดค้าว', '4605', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460601', 'คุ้มเก่า', '4606', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460602', 'สงเปลือย', '4606', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460603', 'หนองผือ', '4606', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460606', 'กุดสิมคุ้มใหม่', '4606', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460608', 'สระพังทอง', '4606', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460611', 'กุดปลาค้าว', '4606', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460701', 'ยางตลาด', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460702', 'หัวงัว', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460703', 'อุ่มเม่า', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460704', 'บัวบาน', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460705', 'เว่อ', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460706', 'อิตื้อ', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460707', 'หัวนาคำ', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460708', 'หนองอิเฒ่า', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460709', 'ดอนสมบูรณ์', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460710', 'นาเชือก', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460711', 'คลองขาม', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460712', 'เขาพระนอน', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460713', 'นาดี', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460714', 'โนนสูง', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460715', 'หนองตอกแป้น', '4607', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460801', 'ห้วยเม็ก', '4608', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460802', 'คำใหญ่', '4608', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460803', 'กุดโดน', '4608', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460804', 'บึงนาเรียง', '4608', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460805', 'หัวหิน', '4608', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460806', 'พิมูล', '4608', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460807', 'คำเหมือดแก้ว', '4608', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460808', 'โนนสะอาด', '4608', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460809', 'ทรายทอง', '4608', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460901', 'ภูสิงห์', '4609', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460902', 'สหัสขันธ์', '4609', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460903', 'นามะเขือ', '4609', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460904', 'โนนศิลา', '4609', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460905', 'นิคม', '4609', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460906', 'โนนแหลมทอง', '4609', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460907', 'โนนบุรี', '4609', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('460908', 'โนนน้ำเกลี้ยง', '4609', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461001', 'ทุ่งคลอง', '4610', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461002', 'โพน', '4610', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461005', 'ดินจี่', '4610', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461006', 'นาบอน', '4610', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461007', 'นาทัน', '4610', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461009', 'เนินยาง', '4610', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461101', 'ท่าคันโท', '4611', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461102', 'กุงเก่า', '4611', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461103', 'ยางอู้ม', '4611', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461104', 'กุดจิก', '4611', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461105', 'นาตาล', '4611', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461106', 'ดงสมบูรณ์', '4611', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461201', 'หนองกุงศรี', '4612', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461202', 'หนองบัว', '4612', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461203', 'โคกเครือ', '4612', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461204', 'หนองสรวง', '4612', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461205', 'เสาเล้า', '4612', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461206', 'หนองใหญ่', '4612', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461207', 'ดงมูล', '4612', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461208', 'ลำหนองแสน', '4612', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461209', 'หนองหิน', '4612', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461301', 'สมเด็จ', '4613', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461302', 'หนองแวง', '4613', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461303', 'แซงบาดาล', '4613', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461304', 'มหาไชย', '4613', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461305', 'หมูม่น', '4613', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461306', 'ผาเสวย', '4613', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461307', 'ศรีสมเด็จ', '4613', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461308', 'ลำห้วยหลัว', '4613', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461401', 'คำบง', '4614', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461402', 'ไค้นุ่น', '4614', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461403', 'นิคมห้วยผึ้ง', '4614', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461404', 'หนองอีบุตร', '4614', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461501', 'สำราญ', '4615', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461502', 'สำราญใต้', '4615', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461503', 'คำสร้างเที่ยง', '4615', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461504', 'หนองช้าง', '4615', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461601', 'นาคู', '4616', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461602', 'สายนาวัง', '4616', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461603', 'โนนนาจาน', '4616', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461604', 'บ่อแก้ว', '4616', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461605', 'ภูแล่นช้าง', '4616', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461701', 'ดอนจาน', '4617', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461702', 'สะอาดไชยศรี', '4617', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461703', 'ดงพยุง', '4617', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461704', 'ม่วงนา', '4617', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461705', 'นาจำปา', '4617', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461801', 'ฆ้องชัยพัฒนา', '4618', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461802', 'กุดฆ้องชัย', '4618', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461803', 'โคกสะอาด', '4618', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461804', 'โนนศิลาเลิง', '4618', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('461805', 'ลำชี', '4618', ' ', '46', ' ');
INSERT INTO `ref_tambol` VALUES ('470101', 'ธาตุเชิงชุม', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470102', 'ขมิ้น', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470103', 'งิ้วด่อน', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470104', 'โนนหอม', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470106', 'เชียงเครือ', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470107', 'ท่าแร่', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470109', 'ม่วงลาย', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470110', 'กกปลาซิว', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470111', 'ดงชน', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470112', 'ห้วยยาง', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470113', 'พังขว้าง', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470115', 'ดงมะไฟ', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470116', 'ธาตุนาเวง', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470117', 'เหล่าปอแดง', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470118', 'หนองลาด', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470120', 'ฮางโฮง', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470121', 'โคกก่อง', '4701', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470201', 'กุสุมาลย์', '4702', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470202', 'นาโพธิ์', '4702', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470203', 'นาเพียง', '4702', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470204', 'โพธิไพศาล', '4702', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470205', 'อุ่มจาน', '4702', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470301', 'กุดบาก', '4703', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470303', 'นาม่อง', '4703', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470305', 'กุดไห', '4703', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470401', 'พรรณา', '4704', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470402', 'วังยาง', '4704', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470403', 'พอกน้อย', '4704', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470404', 'นาหัวบ่อ', '4704', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470405', 'ไร่', '4704', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470406', 'ช้างมิ่ง', '4704', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470407', 'นาใน', '4704', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470408', 'สว่าง', '4704', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470409', 'บะฮี', '4704', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470410', 'เชิงชุม', '4704', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470501', 'พังโคน', '4705', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470502', 'ม่วงไข่', '4705', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470503', 'แร่', '4705', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470504', 'ไฮหย่อง', '4705', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470505', 'ต้นผึ้ง', '4705', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470601', 'วาริชภูมิ', '4706', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470602', 'ปลาโหล', '4706', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470603', 'หนองลาด', '4706', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470604', 'คำบ่อ', '4706', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470605', 'ค้อเขียว', '4706', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470701', 'นิคมน้ำอูน', '4707', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470702', 'หนองปลิง', '4707', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470703', 'หนองบัว', '4707', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470704', 'สุวรรณคาม', '4707', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470801', 'วานรนิวาส', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470802', 'เดื่อศรีคันไชย', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470803', 'ขัวก่าย', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470804', 'หนองสนม', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470805', 'คูสะคาม', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470806', 'ธาตุ', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470807', 'หนองแวง', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470808', 'ศรีวิชัย', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470809', 'นาซอ', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470810', 'อินทร์แปลง', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470811', 'นาคำ', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470812', 'คอนสวรรค์', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470813', 'กุดเรือคำ', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470814', 'หนองแวงใต้', '4708', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470901', 'คำตากล้า', '4709', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470902', 'หนองบัวสิม', '4709', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470903', 'นาแต้', '4709', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('470904', 'แพด', '4709', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471001', 'ม่วง', '4710', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471002', 'มาย', '4710', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471003', 'ดงหม้อทอง', '4710', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471004', 'ดงเหนือ', '4710', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471005', 'ดงหม้อทองใต้', '4710', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471006', 'ห้วยหลัว', '4710', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471007', 'โนนสะอาด', '4710', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471008', 'หนองกวั่ง', '4710', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471009', 'บ่อแก้ว', '4710', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471101', 'อากาศ', '4711', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471102', 'โพนแพง', '4711', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471103', 'วาใหญ่', '4711', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471104', 'โพนงาม', '4711', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471105', 'ท่าก้อน', '4711', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471106', 'นาฮี', '4711', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471107', 'บะหว้า', '4711', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471108', 'สามัคคีพัฒนา', '4711', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471201', 'สว่างแดนดิน', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471203', 'คำสะอาด', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471204', 'บ้านต้าย', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471206', 'บงเหนือ', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471207', 'โพนสูง', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471208', 'โคกสี', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471210', 'หนองหลวง', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471211', 'บงใต้', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471212', 'ค้อใต้', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471213', 'พันนา', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471214', 'แวง', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471215', 'ทรายมูล', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471216', 'ตาลโกน', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471217', 'ตาลเนิ้ง', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471220', 'ธาตุทอง', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471221', 'บ้านถ่อน', '4712', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471301', 'ส่องดาว', '4713', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471302', 'ท่าศิลา', '4713', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471303', 'วัฒนา', '4713', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471304', 'ปทุมวาปี', '4713', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471401', 'เต่างอย', '4714', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471402', 'บึงทวาย', '4714', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471403', 'นาตาล', '4714', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471404', 'จันทร์เพ็ญ', '4714', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471501', 'ตองโขบ', '4715', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471502', 'เหล่าโพนค้อ', '4715', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471503', 'ด่านม่วงคำ', '4715', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471504', 'แมดนาท่ม', '4715', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471601', 'บ้านเหล่า', '4716', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471602', 'เจริญศิลป์', '4716', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471603', 'ทุ่งแก', '4716', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471604', 'โคกศิลา', '4716', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471605', 'หนองแปน', '4716', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471701', 'บ้านโพน', '4717', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471702', 'นาแก้ว', '4717', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471703', 'นาตงวัฒนา', '4717', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471704', 'บ้านแป้น', '4717', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471705', 'เชียงสือ', '4717', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471801', 'สร้างค้อ', '4718', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471802', 'หลุบเลา', '4718', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471803', 'โคกภู', '4718', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('471804', 'กกปลาซิว', '4718', ' ', '47', ' ');
INSERT INTO `ref_tambol` VALUES ('480101', 'ในเมือง', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480102', 'หนองแสง', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480103', 'นาทราย', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480104', 'นาราชควาย', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480105', 'กุรุคุ', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480106', 'บ้านผึ้ง', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480107', 'อาจสามารถ', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480108', 'ขามเฒ่า', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480109', 'บ้านกลาง', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480110', 'ท่าค้อ', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480111', 'คำเตย', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480112', 'หนองญาติ', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480113', 'ดงขวาง', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480114', 'วังตามัว', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480115', 'โพธิ์ตาก', '4801', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480201', 'ปลาปาก', '4802', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480202', 'หนองฮี', '4802', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480203', 'กุตาไก้', '4802', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480204', 'โคกสว่าง', '4802', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480205', 'โคกสูง', '4802', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480206', 'มหาชัย', '4802', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480207', 'นามะเขือ', '4802', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480208', 'หนองเทาใหญ่', '4802', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480301', 'ท่าอุเทน', '4803', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480302', 'โนนตาล', '4803', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480303', 'ท่าจำปา', '4803', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480304', 'ไชยบุรี', '4803', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480305', 'พนอม', '4803', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480306', 'พะทาย', '4803', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480311', 'เวินพระบาท', '4803', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480312', 'รามราช', '4803', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480314', 'หนองเทา', '4803', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480401', 'บ้านแพง', '4804', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480402', 'ไผ่ล้อม', '4804', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480403', 'โพนทอง', '4804', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480404', 'หนองแวง', '4804', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480408', 'นางัว', '4804', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480409', 'นาเข', '4804', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480501', 'ธาตุพนม', '4805', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480502', 'ฝั่งแดง', '4805', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480503', 'โพนแพง', '4805', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480504', 'พระกลางทุ่ง', '4805', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480505', 'นาถ่อน', '4805', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480506', 'แสนพัน', '4805', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480507', 'ดอนนางหงส์', '4805', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480508', 'น้ำก่ำ', '4805', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480509', 'อุ่มเหม้า', '4805', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480510', 'นาหนาด', '4805', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480511', 'กุดฉิม', '4805', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480512', 'ธาตุพนมเหนือ', '4805', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480601', 'เรณู', '4806', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480602', 'โพนทอง', '4806', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480603', 'ท่าลาด', '4806', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480604', 'นางาม', '4806', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480605', 'โคกหินแฮ่', '4806', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480607', 'หนองย่างชิ้น', '4806', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480608', 'เรณูใต้', '4806', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480609', 'นาขาม', '4806', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480701', 'นาแก', '4807', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480702', 'พระซอง', '4807', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480703', 'หนองสังข์', '4807', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480704', 'นาคู่', '4807', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480705', 'พิมาน', '4807', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480706', 'พุ่มแก', '4807', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480707', 'ก้านเหลือง', '4807', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480708', 'หนองบ่อ', '4807', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480709', 'นาเลียง', '4807', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480712', 'บ้านแก้ง', '4807', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480713', 'คำพี้', '4807', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480715', 'สีชมพู', '4807', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480801', 'ศรีสงคราม', '4808', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480802', 'นาเดื่อ', '4808', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480803', 'บ้านเอื้อง', '4808', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480804', 'สามผง', '4808', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480805', 'ท่าบ่อสงคราม', '4808', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480806', 'บ้านข่า', '4808', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480807', 'นาคำ', '4808', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480808', 'โพนสว่าง', '4808', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480809', 'หาดแพง', '4808', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480901', 'นาหว้า', '4809', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480902', 'นางัว', '4809', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480903', 'บ้านเสียว', '4809', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480904', 'นาคูณใหญ่', '4809', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480905', 'เหล่าพัฒนา', '4809', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('480906', 'ท่าเรือ', '4809', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481001', 'โพนสวรรค์', '4810', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481002', 'นาหัวบ่อ', '4810', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481003', 'นาขมิ้น', '4810', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481004', 'โพนบก', '4810', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481005', 'บ้านค้อ', '4810', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481006', 'โพนจาน', '4810', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481007', 'นาใน', '4810', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481101', 'นาทม', '4811', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481102', 'หนองซน', '4811', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481103', 'ดอนเตย', '4811', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481201', 'วังยาง', '4812', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481202', 'โคกสี', '4812', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481203', 'ยอดชาด', '4812', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('481204', 'หนองโพธิ์', '4812', ' ', '48', ' ');
INSERT INTO `ref_tambol` VALUES ('490101', 'มุกดาหาร', '4901', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490102', 'ศรีบุญเรือง', '4901', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490103', 'บ้านโคก', '4901', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490104', 'บางทรายใหญ่', '4901', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490105', 'โพนทราย', '4901', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490106', 'ผึ่งแดด', '4901', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490107', 'นาโสก', '4901', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490108', 'นาสีนวน', '4901', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490109', 'คำป่าหลาย', '4901', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490110', 'คำอาฮวน', '4901', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490111', 'ดงเย็น', '4901', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490112', 'ดงมอน', '4901', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490113', 'กุดแข้', '4901', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490201', 'นิคมคำสร้อย', '4902', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490202', 'นากอก', '4902', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490203', 'หนองแวง', '4902', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490204', 'กกแดง', '4902', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490205', 'นาอุดม', '4902', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490206', 'โชคชัย', '4902', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490207', 'ร่มเกล้า', '4902', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490301', 'ดอนตาล', '4903', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490302', 'โพธิ์ไทร', '4903', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490303', 'ป่าไร่', '4903', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490304', 'เหล่าหมี', '4903', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490305', 'บ้านบาก', '4903', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490306', 'นาสะเม็ง', '4903', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490307', 'บ้านแก้ง', '4903', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490401', 'ดงหลวง', '4904', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490402', 'หนองบัว', '4904', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490403', 'กกตูม', '4904', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490404', 'หนองแคน', '4904', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490405', 'ชะโนดน้อย', '4904', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490406', 'พังแดง', '4904', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490503', 'บ้านซ่ง', '4905', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490504', 'คำชะอี', '4905', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490505', 'หนองเอี่ยน', '4905', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490506', 'บ้านค้อ', '4905', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490507', 'บ้านเหล่า', '4905', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490508', 'โพนงาม', '4905', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490511', 'เหล่าสร้างถ่อ', '4905', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490512', 'คำบก', '4905', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490514', 'น้ำเที่ยง', '4905', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490601', 'หว้านใหญ่', '4906', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490602', 'ป่งขาม', '4906', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490603', 'บางทรายน้อย', '4906', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490604', 'ชะโนด', '4906', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490605', 'ดงหมู', '4906', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490701', 'หนองสูง', '4907', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490702', 'โนนยาง', '4907', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490703', 'ภูวง', '4907', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490704', 'บ้านเป้า', '4907', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490705', 'หนองสูงใต้', '4907', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('490706', 'หนองสูงเหนือ', '4907', ' ', '49', ' ');
INSERT INTO `ref_tambol` VALUES ('500101', 'ศรีภูมิ', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500102', 'พระสิงห์', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500103', 'หายยา', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500104', 'ช้างม่อย', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500105', 'ช้างคลาน', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500106', 'วัดเกต', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500107', 'ช้างเผือก', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500108', 'สุเทพ', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500109', 'แม่เหียะ', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500110', 'ป่าแดด', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500111', 'หนองหอย', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500112', 'ท่าศาลา', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500113', 'หนองป่าครั่ง', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500114', 'ฟ้าฮ่าม', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500115', 'ป่าตัน', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500116', 'สันผีเสื้อ', '5001', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500203', 'บ้านหลวง', '5002', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500204', 'ข่วงเปา', '5002', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500205', 'สบเตี๊ยะ', '5002', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500206', 'บ้านแปะ', '5002', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500207', 'ดอยแก้ว', '5002', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500209', 'แม่สอย', '5002', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500301', 'ช่างเคิ่ง', '5003', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500302', 'ท่าผา', '5003', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500303', 'บ้านทับ', '5003', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500304', 'แม่ศึก', '5003', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500305', 'แม่นาจร', '5003', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500306', 'บ้านจันทร์', '5003', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500307', 'ปางหินฝน', '5003', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500308', 'กองแขก', '5003', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500309', 'แม่แดด', '5003', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500310', 'แจ่มหลวง', '5003', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500401', 'เชียงดาว', '5004', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500402', 'เมืองนะ', '5004', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500403', 'เมืองงาย', '5004', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500404', 'แม่นะ', '5004', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500405', 'เมืองคอง', '5004', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500406', 'ปิงโค้ง', '5004', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500407', 'ทุ่งข้าวพวง', '5004', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500501', 'เชิงดอย', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500502', 'สันปูเลย', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500503', 'ลวงเหนือ', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500504', 'ป่าป้อง', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500505', 'สง่าบ้าน', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500506', 'ป่าลาน', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500507', 'ตลาดขวัญ', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500508', 'สำราญราษฎร์', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500509', 'แม่คือ', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500510', 'ตลาดใหญ่', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500511', 'แม่ฮ้อยเงิน', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500512', 'แม่โป่ง', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500513', 'ป่าเมี่ยง', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500514', 'เทพเสด็จ', '5005', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500601', 'สันมหาพน', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500602', 'แม่แตง', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500603', 'ขี้เหล็ก', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500604', 'ช่อแล', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500605', 'แม่หอพระ', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500606', 'สบเปิง', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500607', 'บ้านเป้า', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500608', 'สันป่ายาง', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500609', 'ป่าแป๋', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500610', 'เมืองก๋าย', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500611', 'บ้านช้าง', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500612', 'กื้ดช้าง', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500613', 'อินทขิล', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500614', 'สมก๋าย', '5006', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500701', 'ริมใต้', '5007', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500702', 'ริมเหนือ', '5007', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500703', 'สันโป่ง', '5007', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500704', 'ขี้เหล็ก', '5007', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500705', 'สะลวง', '5007', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500706', 'ห้วยทราย', '5007', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500707', 'แม่แรม', '5007', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500708', 'โป่งแยง', '5007', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500709', 'แม่สา', '5007', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500710', 'ดอนแก้ว', '5007', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500711', 'เหมืองแก้ว', '5007', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500801', 'สะเมิงใต้', '5008', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500802', 'สะเมิงเหนือ', '5008', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500803', 'แม่สาบ', '5008', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500804', 'บ่อแก้ว', '5008', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500805', 'ยั้งเมิน', '5008', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500901', 'เวียง', '5009', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500903', 'ม่อนปิ่น', '5009', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500904', 'แม่งอน', '5009', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500905', 'แม่สูน', '5009', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500906', 'สันทราย', '5009', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500910', 'แม่คะ', '5009', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500911', 'แม่ข่า', '5009', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('500912', 'โป่งน้ำร้อน', '5009', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501001', 'แม่อาย', '5010', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501002', 'แม่สาว', '5010', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501003', 'สันต้นหมื้อ', '5010', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501004', 'แม่นาวาง', '5010', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501005', 'ท่าตอน', '5010', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501006', 'บ้านหลวง', '5010', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501007', 'มะลิกา', '5010', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501101', 'เวียง', '5011', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501102', 'ทุ่งหลวง', '5011', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501103', 'ป่าตุ้ม', '5011', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501104', 'ป่าไหน่', '5011', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501105', 'สันทราย', '5011', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501106', 'บ้านโป่ง', '5011', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501107', 'น้ำแพร่', '5011', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501108', 'เขื่อนผาก', '5011', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501109', 'แม่แวน', '5011', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501110', 'แม่ปั๋ง', '5011', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501111', 'โหล่งขอด', '5011', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501201', 'ยุหว่า', '5012', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501202', 'สันกลาง', '5012', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501203', 'ท่าวังพร้าว', '5012', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501204', 'มะขามหลวง', '5012', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501205', 'แม่ก๊า', '5012', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501206', 'บ้านแม', '5012', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501207', 'บ้านกลาง', '5012', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501208', 'ทุ่งสะโตก', '5012', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501210', 'ทุ่งต้อม', '5012', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501214', 'น้ำบ่อหลวง', '5012', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501215', 'มะขุนหวาน', '5012', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501301', 'สันกำแพง', '5013', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501302', 'ทรายมูล', '5013', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501303', 'ร้องวัวแดง', '5013', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501304', 'บวกค้าง', '5013', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501305', 'แช่ช้าง', '5013', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501306', 'ออนใต้', '5013', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501310', 'แม่ปูคา', '5013', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501311', 'ห้วยทราย', '5013', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501312', 'ต้นเปา', '5013', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501313', 'สันกลาง', '5013', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501401', 'สันทรายหลวง', '5014', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501402', 'สันทรายน้อย', '5014', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501403', 'สันพระเนตร', '5014', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501404', 'สันนาเม็ง', '5014', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501405', 'สันป่าเปา', '5014', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501406', 'หนองแหย่ง', '5014', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501407', 'หนองจ๊อม', '5014', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501408', 'หนองหาร', '5014', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501409', 'แม่แฝก', '5014', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501410', 'แม่แฝกใหม่', '5014', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501411', 'เมืองเล็น', '5014', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501412', 'ป่าไผ่', '5014', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501501', 'หางดง', '5015', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501502', 'หนองแก๋ว', '5015', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501503', 'หารแก้ว', '5015', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501504', 'หนองตอง', '5015', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501505', 'ขุนคง', '5015', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501506', 'สบแม่ข่า', '5015', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501507', 'บ้านแหวน', '5015', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501508', 'สันผักหวาน', '5015', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501509', 'หนองควาย', '5015', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501510', 'บ้านปง', '5015', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501511', 'น้ำแพร่', '5015', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501601', 'หางดง', '5016', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501602', 'ฮอด', '5016', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501603', 'บ้านตาล', '5016', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501604', 'บ่อหลวง', '5016', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501605', 'บ่อสลี', '5016', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501606', 'นาคอเรือ', '5016', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501701', 'ดอยเต่า', '5017', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501702', 'ท่าเดื่อ', '5017', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501703', 'มืดกา', '5017', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501704', 'บ้านแอ่น', '5017', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501705', 'บงตัน', '5017', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501706', 'โปงทุ่ง', '5017', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501801', 'อมก๋อย', '5018', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501802', 'ยางเปียง', '5018', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501803', 'แม่ตื่น', '5018', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501804', 'ม่อนจอง', '5018', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501805', 'สบโขง', '5018', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501806', 'นาเกียน', '5018', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501901', 'ยางเนิ้ง', '5019', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501902', 'สารภี', '5019', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501903', 'ชมภู', '5019', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501904', 'ไชยสถาน', '5019', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501905', 'ขัวมุง', '5019', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501906', 'หนองแฝก', '5019', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501907', 'หนองผึ้ง', '5019', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501908', 'ท่ากว้าง', '5019', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501909', 'ดอนแก้ว', '5019', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501910', 'ท่าวังตาล', '5019', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501911', 'สันทราย', '5019', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('501912', 'ป่าบง', '5019', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502001', 'เมืองแหง', '5020', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502002', 'เปียงหลวง', '5020', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502003', 'แสนไห', '5020', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502101', 'ปงตำ', '5021', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502102', 'ศรีดงเย็น', '5021', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502103', 'แม่ทะลบ', '5021', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502104', 'หนองบัว', '5021', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502201', 'บ้านกาด', '5022', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502202', 'ทุ่งปี้', '5022', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502203', 'ทุ่งรวงทอง', '5022', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502204', 'แม่วิน', '5022', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502205', 'ดอนเปา', '5022', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502301', 'ออนเหนือ', '5023', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502302', 'ออนกลาง', '5023', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502303', 'บ้านสหกรณ์', '5023', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502304', 'ห้วยแก้ว', '5023', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502305', 'แม่ทา', '5023', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502306', 'ทาเหนือ', '5023', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502401', 'ดอยหล่อ', '5024', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502402', 'สองแคว', '5024', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502403', 'ยางคราม', '5024', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('502404', 'สันติสุข', '5024', ' ', '50', ' ');
INSERT INTO `ref_tambol` VALUES ('510101', 'ในเมือง', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510102', 'เหมืองง่า', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510103', 'อุโมงค์', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510104', 'หนองช้างคืน', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510105', 'ประตูป่า', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510106', 'ริมปิง', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510107', 'ต้นธง', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510108', 'บ้านแป้น', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510109', 'เหมืองจี้', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510110', 'ป่าสัก', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510111', 'เวียงยอง', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510112', 'บ้านกลาง', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510113', 'มะเขือแจ้', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510116', 'ศรีบัวบาน', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510117', 'หนองหนาม', '5101', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510201', 'ทาปลาดุก', '5102', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510202', 'ทาสบเส้า', '5102', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510203', 'ทากาศ', '5102', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510204', 'ทาขุมเงิน', '5102', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510205', 'ทาทุ่งหลวง', '5102', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510206', 'ทาแม่ลอบ', '5102', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510301', 'บ้านโฮ่ง', '5103', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510302', 'ป่าพลู', '5103', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510303', 'เหล่ายาว', '5103', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510304', 'ศรีเตี้ย', '5103', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510305', 'หนองปลาสวาย', '5103', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510401', 'ลี้', '5104', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510402', 'แม่ตืน', '5104', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510403', 'นาทราย', '5104', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510404', 'ดงดำ', '5104', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510405', 'ก้อ', '5104', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510406', 'แม่ลาน', '5104', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510408', 'ป่าไผ่', '5104', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510409', 'ศรีวิชัย', '5104', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510501', 'ทุ่งหัวช้าง', '5105', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510502', 'บ้านปวง', '5105', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510503', 'ตะเคียนปม', '5105', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510601', 'ปากบ่อง', '5106', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510602', 'ป่าซาง', '5106', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510603', 'แม่แรง', '5106', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510604', 'ม่วงน้อย', '5106', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510605', 'บ้านเรือน', '5106', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510606', 'มะกอก', '5106', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510607', 'ท่าตุ้ม', '5106', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510608', 'น้ำดิบ', '5106', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510611', 'นครเจดีย์', '5106', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510701', 'บ้านธิ', '5107', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510702', 'ห้วยยาบ', '5107', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510801', 'หนองล่อง', '5108', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510802', 'หนองยวง', '5108', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('510803', 'วังผาง', '5108', ' ', '51', ' ');
INSERT INTO `ref_tambol` VALUES ('520101', 'เวียงเหนือ', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520102', 'หัวเวียง', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520103', 'สวนดอก', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520104', 'สบตุ๋ย', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520105', 'พระบาท', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520106', 'ชมพู', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520107', 'กล้วยแพะ', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520108', 'ปงแสนทอง', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520109', 'บ้านแลง', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520110', 'บ้านเสด็จ', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520111', 'พิชัย', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520112', 'ทุ่งฝาย', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520113', 'บ้านเอื้อม', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520114', 'บ้านเป้า', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520115', 'บ้านค่า', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520116', 'บ่อแฮ้ว', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520117', 'ต้นธงชัย', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520118', 'นิคมพัฒนา', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520119', 'บุญนาคพัฒนา', '5201', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520201', 'บ้านดง', '5202', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520202', 'นาสัก', '5202', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520203', 'จางเหนือ', '5202', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520204', 'แม่เมาะ', '5202', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520205', 'สบป้าด', '5202', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520301', 'ลำปางหลวง', '5203', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520302', 'นาแก้ว', '5203', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520303', 'ไหล่หิน', '5203', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520304', 'วังพร้าว', '5203', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520305', 'ศาลา', '5203', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520306', 'เกาะคา', '5203', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520307', 'นาแส่ง', '5203', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520308', 'ท่าผา', '5203', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520309', 'ใหม่พัฒนา', '5203', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520401', 'ทุ่งงาม', '5204', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520402', 'เสริมขวา', '5204', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520403', 'เสริมซ้าย', '5204', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520404', 'เสริมกลาง', '5204', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520501', 'หลวงเหนือ', '5205', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520502', 'หลวงใต้', '5205', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520503', 'บ้านโป่ง', '5205', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520504', 'บ้านร้อง', '5205', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520505', 'ปงเตา', '5205', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520506', 'นาแก', '5205', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520507', 'บ้านอ้อน', '5205', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520508', 'บ้านแหง', '5205', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520509', 'บ้านหวด', '5205', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520510', 'แม่ตีบ', '5205', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520601', 'แจ้ห่ม', '5206', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520602', 'บ้านสา', '5206', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520603', 'ปงดอน', '5206', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520604', 'แม่สุก', '5206', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520605', 'เมืองมาย', '5206', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520606', 'ทุ่งผึ้ง', '5206', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520607', 'วิเชตนคร', '5206', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520701', 'ทุ่งฮั้ว', '5207', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520702', 'วังเหนือ', '5207', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520703', 'วังใต้', '5207', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520704', 'ร่องเคาะ', '5207', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520705', 'วังทอง', '5207', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520706', 'วังซ้าย', '5207', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520707', 'วังแก้ว', '5207', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520708', 'วังทรายคำ', '5207', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520801', 'ล้อมแรด', '5208', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520802', 'แม่วะ', '5208', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520803', 'แม่ปะ', '5208', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520804', 'แม่มอก', '5208', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520805', 'เวียงมอก', '5208', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520806', 'นาโป่ง', '5208', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520807', 'แม่ถอด', '5208', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520808', 'เถินบุรี', '5208', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520901', 'แม่พริก', '5209', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520902', 'ผาปัง', '5209', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520903', 'แม่ปุ', '5209', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('520904', 'พระบาทวังตวง', '5209', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521001', 'แม่ทะ', '5210', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521002', 'นาครัว', '5210', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521003', 'ป่าตัน', '5210', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521004', 'บ้านกิ่ว', '5210', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521005', 'บ้านบอม', '5210', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521006', 'น้ำโจ้', '5210', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521007', 'ดอนไฟ', '5210', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521008', 'หัวเสือ', '5210', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521009', 'สบป้าด', '5210', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521010', 'วังเงิน', '5210', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521011', 'สันดอนแก้ว', '5210', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521101', 'สบปราบ', '5211', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521102', 'สมัย', '5211', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521103', 'แม่กัวะ', '5211', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521104', 'นายาง', '5211', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521201', 'ห้างฉัตร', '5212', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521202', 'หนองหล่ม', '5212', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521203', 'เมืองยาว', '5212', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521204', 'ปงยางคก', '5212', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521205', 'เวียงตาล', '5212', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521206', 'แม่สัน', '5212', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521207', 'วอแก้ว', '5212', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521301', 'เมืองปาน', '5213', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521302', 'บ้านขอ', '5213', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521303', 'ทุ่งกว๋าว', '5213', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521304', 'แจ้ซ้อน', '5213', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('521305', 'หัวเมือง', '5213', ' ', '52', ' ');
INSERT INTO `ref_tambol` VALUES ('530101', 'ท่าอิฐ', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530102', 'ท่าเสา', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530103', 'บ้านเกาะ', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530104', 'ป่าเซ่า', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530105', 'คุ้งตะเภา', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530106', 'วังกะพี้', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530107', 'หาดกรวด', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530108', 'น้ำริด', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530109', 'งิ้วงาม', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530110', 'บ้านด่านนาขาม', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530111', 'บ้านด่าน', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530112', 'ผาจุก', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530113', 'วังดิน', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530114', 'แสนตอ', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530115', 'หาดงิ้ว', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530116', 'ขุนฝาง', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530117', 'ถ้ำฉลอง', '5301', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530201', 'วังแดง', '5302', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530202', 'บ้านแก่ง', '5302', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530203', 'หาดสองแคว', '5302', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530204', 'น้ำอ่าง', '5302', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530205', 'ข่อยสูง', '5302', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530301', 'ท่าปลา', '5303', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530302', 'หาดล้า', '5303', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530303', 'ผาเลือด', '5303', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530304', 'จริม', '5303', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530305', 'น้ำหมัน', '5303', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530306', 'ท่าแฝก', '5303', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530307', 'นางพญา', '5303', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530308', 'ร่วมจิต', '5303', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530401', 'แสนตอ', '5304', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530402', 'บ้านฝาย', '5304', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530403', 'เด่นเหล็ก', '5304', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530404', 'น้ำไคร้', '5304', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530405', 'น้ำไผ่', '5304', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530406', 'ห้วยมุ่น', '5304', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530501', 'ฟากท่า', '5305', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530502', 'สองคอน', '5305', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530503', 'บ้านเสี้ยว', '5305', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530504', 'สองห้อง', '5305', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530601', 'ม่วงเจ็ดต้น', '5306', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530602', 'บ้านโคก', '5306', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530603', 'นาขุม', '5306', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530604', 'บ่อเบี้ย', '5306', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530701', 'ในเมือง', '5307', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530702', 'บ้านดารา', '5307', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530703', 'ไร่อ้อย', '5307', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530704', 'ท่าสัก', '5307', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530705', 'คอรุม', '5307', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530706', 'บ้านหม้อ', '5307', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530707', 'ท่ามะเฟือง', '5307', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530708', 'บ้านโคน', '5307', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530709', 'พญาแมน', '5307', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530710', 'นาอิน', '5307', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530711', 'นายาง', '5307', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530801', 'ศรีพนมมาศ', '5308', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530802', 'แม่พูล', '5308', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530803', 'นานกกก', '5308', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530804', 'ฝายหลวง', '5308', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530805', 'ชัยจุมพล', '5308', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530806', 'ไผ่ล้อม', '5308', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530807', 'ทุ่งยั้ง', '5308', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530808', 'ด่านแม่คำมัน', '5308', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530901', 'ผักขวง', '5309', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530902', 'บ่อทอง', '5309', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530903', 'ป่าคาย', '5309', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('530904', 'น้ำพี้', '5309', ' ', '53', ' ');
INSERT INTO `ref_tambol` VALUES ('540101', 'ในเวียง', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540102', 'นาจักร', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540103', 'น้ำชำ', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540104', 'ป่าแดง', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540105', 'ทุ่งโฮ้ง', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540106', 'เหมืองหม้อ', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540107', 'วังธง', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540108', 'แม่หล่าย', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540109', 'ห้วยม้า', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540110', 'ป่าแมต', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540111', 'บ้านถิ่น', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540112', 'สวนเขื่อน', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540113', 'วังหงษ์', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540114', 'แม่คำมี', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540115', 'ทุ่งกวาว', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540116', 'ท่าข้าม', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540117', 'แม่ยม', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540118', 'ช่อแฮ', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540119', 'ร่องฟอง', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540120', 'กาญจนา', '5401', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540201', 'ร้องกวาง', '5402', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540204', 'ร้องเข็ม', '5402', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540205', 'น้ำเลา', '5402', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540206', 'บ้านเวียง', '5402', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540207', 'ทุ่งศรี', '5402', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540208', 'แม่ยางตาล', '5402', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540209', 'แม่ยางฮ่อ', '5402', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540210', 'ไผ่โทน', '5402', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540213', 'ห้วยโรง', '5402', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540214', 'แม่ทราย', '5402', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540215', 'แม่ยางร้อง', '5402', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540301', 'ห้วยอ้อ', '5403', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540302', 'บ้านปิน', '5403', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540303', 'ต้าผามอก', '5403', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540304', 'เวียงต้า', '5403', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540305', 'ปากกาง', '5403', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540306', 'หัวทุ่ง', '5403', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540307', 'ทุ่งแล้ง', '5403', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540308', 'บ่อเหล็กลอง', '5403', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540309', 'แม่ปาน', '5403', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540401', 'สูงเม่น', '5404', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540402', 'น้ำชำ', '5404', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540403', 'หัวฝาย', '5404', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540404', 'ดอนมูล', '5404', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540405', 'บ้านเหล่า', '5404', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540406', 'บ้านกวาง', '5404', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540407', 'บ้านปง', '5404', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540408', 'บ้านกาศ', '5404', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540409', 'ร่องกาศ', '5404', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540410', 'สบสาย', '5404', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540411', 'เวียงทอง', '5404', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540412', 'พระหลวง', '5404', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540501', 'เด่นชัย', '5405', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540502', 'แม่จั๊วะ', '5405', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540503', 'ไทรย้อย', '5405', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540504', 'ห้วยไร่', '5405', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540505', 'ปงป่าหวาย', '5405', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540601', 'บ้านหนุน', '5406', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540602', 'บ้านกลาง', '5406', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540603', 'ห้วยหม้าย', '5406', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540604', 'เตาปูน', '5406', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540605', 'หัวเมือง', '5406', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540606', 'สะเอียบ', '5406', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540607', 'แดนชุมพล', '5406', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540608', 'ทุ่งน้าว', '5406', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540701', 'วังชิ้น', '5407', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540702', 'สรอย', '5407', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540703', 'แม่ป้าก', '5407', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540704', 'นาพูน', '5407', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540705', 'แม่พุง', '5407', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540706', 'ป่าสัก', '5407', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540707', 'แม่เกิ๋ง', '5407', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540801', 'แม่คำมี', '5408', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540802', 'หนองม่วงไข่', '5408', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540803', 'น้ำรัด', '5408', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540804', 'วังหลวง', '5408', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540805', 'ตำหนักธรรม', '5408', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('540806', 'ทุ่งแค้ว', '5408', ' ', '54', ' ');
INSERT INTO `ref_tambol` VALUES ('550101', 'ในเวียง', '5501', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550102', 'บ่อ', '5501', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550103', 'ผาสิงห์', '5501', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550104', 'ไชยสถาน', '5501', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550105', 'ถืมตอง', '5501', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550106', 'เรือง', '5501', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550107', 'นาชาว', '5501', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550108', 'ดู่ใต้', '5501', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550109', 'กองควาย', '5501', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550116', 'สวก', '5501', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550117', 'สะเนียน', '5501', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550202', 'หนองแดง', '5502', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550203', 'หมอเมือง', '5502', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550204', 'น้ำพาง', '5502', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550205', 'น้ำปาย', '5502', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550206', 'แม่จริม', '5502', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550301', 'บ้านฟ้า', '5503', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550302', 'ป่าคาหลวง', '5503', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550303', 'สวด', '5503', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550304', 'บ้านพี้', '5503', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550401', 'นาน้อย', '5504', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550402', 'เชียงของ', '5504', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550403', 'ศรีษะเกษ', '5504', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550404', 'สถาน', '5504', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550405', 'สันทะ', '5504', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550406', 'บัวใหญ่', '5504', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550407', 'น้ำตก', '5504', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550501', 'ปัว', '5505', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550502', 'แงง', '5505', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550503', 'สถาน', '5505', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550504', 'ศิลาแลง', '5505', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550505', 'ศิลาเพชร', '5505', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550506', 'อวน', '5505', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550509', 'ไชยวัฒนา', '5505', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550510', 'เจดีย์ชัย', '5505', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550511', 'ภูคา', '5505', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550512', 'สกาด', '5505', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550513', 'ป่ากลาง', '5505', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550514', 'วรนคร', '5505', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550601', 'ริม', '5506', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550602', 'ป่าคา', '5506', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550603', 'ผาตอ', '5506', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550604', 'ยม', '5506', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550605', 'ตาลชุม', '5506', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550606', 'ศรีภูมิ', '5506', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550607', 'จอมพระ', '5506', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550608', 'แสนทอง', '5506', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550609', 'ท่าวังผา', '5506', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550610', 'ผาทอง', '5506', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550701', 'กลางเวียง', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550702', 'ขึ่ง', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550703', 'ไหล่น่าน', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550704', 'ตาลชุม', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550705', 'นาเหลือง', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550706', 'ส้าน', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550707', 'น้ำมวบ', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550708', 'น้ำปั้ว', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550709', 'ยาบหัวนา', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550710', 'ปงสนุก', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550711', 'อ่ายนาไลย', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550712', 'ส้านนาหนองใหม่', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550713', 'แม่ขะนิง', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550714', 'แม่สาคร', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550715', 'จอมจันทร์', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550716', 'แม่สา', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550717', 'ทุ่งศรีทอง', '5507', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550801', 'ปอน', '5508', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550802', 'งอบ', '5508', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550803', 'และ', '5508', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550804', 'ทุ่งช้าง', '5508', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550901', 'เชียงกลาง', '5509', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550902', 'เปือ', '5509', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550903', 'เชียงคาน', '5509', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550904', 'พระธาตุ', '5509', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550908', 'พญาแก้ว', '5509', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('550909', 'พระพุทธบาท', '5509', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551001', 'นาทะนุง', '5510', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551002', 'บ่อแก้ว', '5510', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551003', 'เมืองลี', '5510', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551004', 'ปิงหลวง', '5510', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551101', 'ดู่พงษ์', '5511', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551102', 'ป่าแลวหลวง', '5511', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551103', 'พงษ์', '5511', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551201', 'บ่อเกลือเหนือ', '5512', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551202', 'บ่อเกลือใต้', '5512', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551204', 'ภูฟ้า', '5512', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551205', 'ดงพญา', '5512', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551301', 'นาไร่หลวง', '5513', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551302', 'ชนแดน', '5513', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551303', 'ยอด', '5513', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551401', 'ม่วงตึ๊ด', '5514', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551402', 'นาปัง', '5514', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551403', 'น้ำแก่น', '5514', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551404', 'น้ำเกี๋ยน', '5514', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551405', 'เมืองจัง', '5514', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551406', 'ท่าน้าว', '5514', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551407', 'ฝายแก้ว', '5514', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551501', 'ห้วยโก๋น', '5515', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('551502', 'ขุนน่าน', '5515', ' ', '55', ' ');
INSERT INTO `ref_tambol` VALUES ('560101', 'เวียง', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560102', 'แม่ต๋ำ', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560104', 'แม่นาเรือ', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560105', 'บ้านตุ่น', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560106', 'บ้านต๊ำ', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560107', 'บ้านต๋อม', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560108', 'แม่ปืม', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560110', 'แม่กา', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560111', 'บ้านใหม่', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560112', 'จำป่าหวาย', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560113', 'ท่าวังทอง', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560114', 'แม่ใส', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560115', 'บ้านสาง', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560116', 'ท่าจำปี', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560118', 'สันป่าม่วง', '5601', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560201', 'ห้วยข้าวก่ำ', '5602', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560202', 'จุน', '5602', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560203', 'ลอ', '5602', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560204', 'หงส์หิน', '5602', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560205', 'ทุ่งรวงทอง', '5602', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560206', 'ห้วยยางขาม', '5602', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560207', 'พระธาตุขิงแกง', '5602', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560301', 'หย่วน', '5603', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560306', 'น้ำแวน', '5603', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560307', 'เวียง', '5603', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560308', 'ฝายกวาง', '5603', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560309', 'เจดีย์คำ', '5603', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560310', 'ร่มเย็น', '5603', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560311', 'เชียงบาน', '5603', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560312', 'แม่ลาว', '5603', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560313', 'อ่างทอง', '5603', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560314', 'ทุ่งผาสุข', '5603', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560401', 'เชียงม่วน', '5604', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560402', 'บ้านมาง', '5604', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560403', 'สระ', '5604', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560501', 'ดอกคำใต้', '5605', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560502', 'ดอนศรีชุม', '5605', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560503', 'บ้านถ้ำ', '5605', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560504', 'บ้านปิน', '5605', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560505', 'ห้วยลาน', '5605', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560506', 'สันโค้ง', '5605', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560507', 'ป่าซาง', '5605', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560508', 'หนองหล่ม', '5605', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560509', 'ดงสุวรรณ', '5605', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560510', 'บุญเกิด', '5605', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560511', 'สว่างอารมณ์', '5605', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560512', 'คือเวียง', '5605', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560601', 'ปง', '5606', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560602', 'ควร', '5606', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560603', 'ออย', '5606', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560604', 'งิม', '5606', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560605', 'ผาช้างน้อย', '5606', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560606', 'นาปรัง', '5606', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560607', 'ขุนควร', '5606', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560701', 'แม่ใจ', '5607', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560702', 'ศรีถ้อย', '5607', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560703', 'แม่สุก', '5607', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560704', 'ป่าแฝก', '5607', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560705', 'บ้านเหล่า', '5607', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560706', 'เจริญราษฎร์', '5607', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560801', 'ภูซาง', '5608', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560802', 'ป่าสัก', '5608', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560803', 'ทุ่งกล้วย', '5608', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560804', 'เชียงแรง', '5608', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560805', 'สบบง', '5608', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560901', 'ห้วยแก้ว', '5609', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560902', 'ดงเจน', '5609', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('560903', 'แม่อิง', '5609', ' ', '56', ' ');
INSERT INTO `ref_tambol` VALUES ('570101', 'เวียง', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570102', 'รอบเวียง', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570103', 'บ้านดู่', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570104', 'นางแล', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570105', 'แม่ข้าวต้ม', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570106', 'แม่ยาว', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570107', 'สันทราย', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570111', 'แม่กรณ์', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570112', 'ห้วยชมภู', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570113', 'ห้วยสัก', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570114', 'ริมกก', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570115', 'ดอยลาน', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570116', 'ป่าอ้อดอนชัย', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570118', 'ท่าสาย', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570120', 'ดอยฮาง', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570121', 'ท่าสุด', '5701', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570202', 'เวียงชัย', '5702', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570203', 'ผางาม', '5702', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570204', 'เวียงเหนือ', '5702', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570206', 'ดอนศิลา', '5702', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570208', 'เมืองชุม', '5702', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570301', 'เวียง', '5703', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570302', 'สถาน', '5703', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570303', 'ครึ่ง', '5703', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570304', 'บุญเรือง', '5703', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570305', 'ห้วยซ้อ', '5703', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570308', 'ศรีดอนชัย', '5703', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570310', 'ริมโขง', '5703', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570401', 'เวียง', '5704', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570402', 'งิ้ว', '5704', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570403', 'ปล้อง', '5704', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570404', 'แม่ลอย', '5704', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570405', 'เชียงเคี่ยน', '5704', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570409', 'ตับเต่า', '5704', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570410', 'หงาว', '5704', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570411', 'สันทรายงาม', '5704', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570412', 'ศรีดอนไชย', '5704', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570413', 'หนองแรด', '5704', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570501', 'สันมะเค็ด', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570502', 'แม่อ้อ', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570503', 'ธารทอง', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570504', 'สันติสุข', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570505', 'ดอยงาม', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570506', 'หัวง้ม', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570507', 'เจริญเมือง', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570508', 'ป่าหุ่ง', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570509', 'ม่วงคำ', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570510', 'ทรายขาว', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570511', 'สันกลาง', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570512', 'แม่เย็น', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570513', 'เมืองพาน', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570514', 'ทานตะวัน', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570515', 'เวียงห้าว', '5705', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570601', 'ป่าแดด', '5706', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570602', 'ป่าแงะ', '5706', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570603', 'สันมะค่า', '5706', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570605', 'โรงช้าง', '5706', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570606', 'ศรีโพธิ์เงิน', '5706', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570701', 'แม่จัน', '5707', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570702', 'จันจว้า', '5707', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570703', 'แม่คำ', '5707', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570704', 'ป่าซาง', '5707', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570705', 'สันทราย', '5707', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570706', 'ท่าข้าวเปลือก', '5707', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570708', 'ป่าตึง', '5707', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570710', 'แม่ไร่', '5707', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570711', 'ศรีค้ำ', '5707', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570712', 'จันจว้าใต้', '5707', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570713', 'จอมสวรรค์', '5707', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570801', 'เวียง', '5708', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570802', 'ป่าสัก', '5708', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570803', 'บ้านแซว', '5708', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570804', 'ศรีดอนมูล', '5708', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570805', 'แม่เงิน', '5708', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570806', 'โยนก', '5708', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570901', 'แม่สาย', '5709', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570902', 'ห้วยไคร้', '5709', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570903', 'เกาะช้าง', '5709', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570904', 'โป่งผา', '5709', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570905', 'ศรีเมืองชุม', '5709', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570906', 'เวียงพางคำ', '5709', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570908', 'บ้านด้าย', '5709', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('570909', 'โป่งงาม', '5709', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571001', 'แม่สรวย', '5710', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571002', 'ป่าแดด', '5710', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571003', 'แม่พริก', '5710', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571004', 'ศรีถ้อย', '5710', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571005', 'ท่าก๊อ', '5710', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571006', 'วาวี', '5710', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571007', 'เจดีย์หลวง', '5710', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571101', 'สันสลี', '5711', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571102', 'เวียง', '5711', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571103', 'บ้านโป่ง', '5711', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571104', 'ป่างิ้ว', '5711', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571105', 'เวียงกาหลง', '5711', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571106', 'แม่เจดีย์', '5711', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571107', 'แม่เจดีย์ใหม่', '5711', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571201', 'แม่เปา', '5712', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571202', 'แม่ต๋ำ', '5712', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571203', 'ไม้ยา', '5712', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571204', 'เม็งราย', '5712', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571205', 'ตาดควัน', '5712', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571301', 'ม่วงยาย', '5713', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571302', 'ปอ', '5713', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571303', 'หล่ายงาว', '5713', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571304', 'ท่าข้าม', '5713', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571401', 'ต้า', '5714', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571402', 'ป่าตาล', '5714', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571403', 'ยางฮอม', '5714', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571501', 'เทอดไทย', '5715', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571502', 'แม่สลองใน', '5715', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571503', 'แม่สลองนอก', '5715', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571504', 'แม่ฟ้าหลวง', '5715', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571601', 'ดงมะดะ', '5716', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571602', 'จอมหมอกแก้ว', '5716', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571603', 'บัวสลี', '5716', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571604', 'ป่าก่อดำ', '5716', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571605', 'โป่งแพร่', '5716', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571701', 'ทุ่งก่อ', '5717', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571702', 'ดงมหาวัน', '5717', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571703', 'ป่าซาง', '5717', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571801', 'ปงน้อย', '5718', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571802', 'โชคชัย', '5718', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('571803', 'หนองป่าก่อ', '5718', ' ', '57', ' ');
INSERT INTO `ref_tambol` VALUES ('580101', 'จองคำ', '5801', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580102', 'ห้วยโป่ง', '5801', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580103', 'ผาบ่อง', '5801', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580104', 'ปางหมู', '5801', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580105', 'หมอกจำแป่', '5801', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580106', 'ห้วยผา', '5801', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580109', 'ห้วยปูลิง', '5801', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580201', 'ขุนยวม', '5802', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580202', 'แม่เงา', '5802', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580203', 'เมืองปอน', '5802', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580204', 'แม่ยวมน้อย', '5802', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580205', 'แม่กิ๊', '5802', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580206', 'แม่อูคอ', '5802', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580301', 'เวียงใต้', '5803', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580302', 'เวียงเหนือ', '5803', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580303', 'แม่นาเติง', '5803', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580304', 'แม่ฮี้', '5803', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580305', 'ทุ่งยาว', '5803', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580306', 'เมืองแปง', '5803', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580307', 'โป่งสา', '5803', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580401', 'บ้านกาศ', '5804', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580402', 'แม่สะเรียง', '5804', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580403', 'แม่คง', '5804', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580404', 'แม่เหาะ', '5804', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580405', 'แม่ยวม', '5804', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580406', 'เสาหิน', '5804', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580408', 'ป่าแป๋', '5804', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580501', 'แม่ลาน้อย', '5805', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580502', 'แม่ลาหลวง', '5805', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580503', 'ท่าผาปุ้ม', '5805', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580504', 'แม่โถ', '5805', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580505', 'ห้วยห้อม', '5805', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580506', 'แม่นาจาง', '5805', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580507', 'สันติคีรี', '5805', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580508', 'ขุนแม่ลาน้อย', '5805', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580601', 'สบเมย', '5806', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580602', 'แม่คะตวน', '5806', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580603', 'กองก๋อย', '5806', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580604', 'แม่สวด', '5806', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580605', 'ป่าโปง', '5806', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580606', 'แม่สามแลบ', '5806', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580701', 'สบป่อง', '5807', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580702', 'ปางมะผ้า', '5807', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580703', 'ถ้ำลอด', '5807', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('580704', 'นาปู่ป้อม', '5807', ' ', '58', ' ');
INSERT INTO `ref_tambol` VALUES ('600101', 'ปากน้ำโพ', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600102', 'กลางแดด', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600103', 'เกรียงไกร', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600104', 'แควใหญ่', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600105', 'ตะเคียนเลื่อน', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600106', 'นครสวรรค์ตก', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600107', 'นครสวรรค์ออก', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600108', 'บางพระหลวง', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600109', 'บางม่วง', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600110', 'บ้านมะเกลือ', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600111', 'บ้านแก่ง', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600112', 'พระนอน', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600113', 'วัดไทร', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600114', 'หนองกรด', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600115', 'หนองกระโดน', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600116', 'หนองปลิง', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600117', 'บึงเสนาท', '6001', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600201', 'โกรกพระ', '6002', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600202', 'ยางตาล', '6002', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600203', 'บางมะฝ่อ', '6002', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600204', 'บางประมุง', '6002', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600205', 'นากลาง', '6002', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600206', 'ศาลาแดง', '6002', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600207', 'เนินกว้าว', '6002', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600208', 'เนินศาลา', '6002', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600209', 'หาดสูง', '6002', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600301', 'ชุมแสง', '6003', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600302', 'ทับกฤช', '6003', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600303', 'พิกุล', '6003', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600304', 'เกยไชย', '6003', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600305', 'ท่าไม้', '6003', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600306', 'บางเคียน', '6003', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600307', 'หนองกระเจา', '6003', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600308', 'พันลาน', '6003', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600309', 'โคกหม้อ', '6003', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600310', 'ไผ่สิงห์', '6003', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600311', 'ฆะมัง', '6003', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600312', 'ทับกฤชใต้', '6003', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600401', 'หนองบัว', '6004', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600402', 'หนองกลับ', '6004', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600403', 'ธารทหาร', '6004', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600404', 'ห้วยร่วม', '6004', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600405', 'ห้วยถั่วใต้', '6004', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600406', 'ห้วยถั่วเหนือ', '6004', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600407', 'ห้วยใหญ่', '6004', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600408', 'ทุ่งทอง', '6004', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600409', 'วังบ่อ', '6004', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600501', 'ท่างิ้ว', '6005', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600502', 'บางตาหงาย', '6005', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600503', 'หูกวาง', '6005', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600504', 'อ่างทอง', '6005', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600505', 'บ้านแดน', '6005', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600506', 'บางแก้ว', '6005', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600507', 'ตาขีด', '6005', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600508', 'ตาสัง', '6005', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600509', 'ด่านช้าง', '6005', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600510', 'หนองกรด', '6005', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600511', 'หนองตางู', '6005', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600512', 'บึงปลาทู', '6005', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600513', 'เจริญผล', '6005', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600601', 'มหาโพธิ', '6006', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600602', 'เก้าเลี้ยว', '6006', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600603', 'หนองเต่า', '6006', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600604', 'เขาดิน', '6006', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600605', 'หัวดง', '6006', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600701', 'ตาคลี', '6007', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600702', 'ช่องแค', '6007', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600703', 'จันเสน', '6007', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600704', 'ห้วยหอม', '6007', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600705', 'หัวหวาย', '6007', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600706', 'หนองโพ', '6007', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600707', 'หนองหม้อ', '6007', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600708', 'สร้อยทอง', '6007', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600709', 'ลาดทิพรส', '6007', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600710', 'พรหมนิมิต', '6007', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600801', 'ท่าตะโก', '6008', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600802', 'พนมรอก', '6008', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600803', 'หัวถนน', '6008', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600804', 'สายลำโพง', '6008', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600805', 'วังมหากร', '6008', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600806', 'ดอนคา', '6008', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600807', 'ทำนบ', '6008', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600808', 'วังใหญ่', '6008', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600809', 'พนมเศษ', '6008', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600810', 'หนองหลวง', '6008', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600901', 'โคกเดื่อ', '6009', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600902', 'สำโรงชัย', '6009', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600903', 'วังน้ำลัด', '6009', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600904', 'ตะคร้อ', '6009', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600905', 'โพธิ์ประสาท', '6009', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600906', 'วังข่อย', '6009', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600907', 'นาขอม', '6009', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('600908', 'ไพศาลี', '6009', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601001', 'พยุหะ', '6010', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601002', 'เนินมะกอก', '6010', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601003', 'นิคมเขาบ่อแก้ว', '6010', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601004', 'ม่วงหัก', '6010', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601005', 'ยางขาว', '6010', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601006', 'ย่านมัทรี', '6010', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601007', 'เขาทอง', '6010', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601008', 'ท่าน้ำอ้อย', '6010', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601009', 'น้ำทรง', '6010', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601010', 'เขากะลา', '6010', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601011', 'สระทะเล', '6010', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601101', 'ลาดยาว', '6011', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601102', 'ห้วยน้ำหอม', '6011', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601103', 'วังม้า', '6011', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601104', 'วังเมือง', '6011', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601105', 'สร้อยละคร', '6011', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601106', 'มาบแก', '6011', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601107', 'หนองยาว', '6011', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601108', 'หนองนมวัว', '6011', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601109', 'บ้านไร่', '6011', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601110', 'เนินขี้เหล็ก', '6011', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601116', 'ศาลเจ้าไก่ต่อ', '6011', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601117', 'สระแก้ว', '6011', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601201', 'ตากฟ้า', '6012', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601202', 'ลำพยนต์', '6012', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601203', 'สุขสำราญ', '6012', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601204', 'หนองพิกุล', '6012', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601205', 'พุนกยูง', '6012', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601206', 'อุดมธัญญา', '6012', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601207', 'เขาชายธง', '6012', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601301', 'แม่วงก์', '6013', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601303', 'แม่เล่ย์', '6013', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601304', 'วังซ่าน', '6013', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601305', 'เขาชนกัน', '6013', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601401', 'แม่เปิน', '6014', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601501', 'ชุมตาบง', '6015', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('601502', 'ปางสวรรค์', '6015', ' ', '60', ' ');
INSERT INTO `ref_tambol` VALUES ('610101', 'อุทัยใหม่', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610102', 'น้ำซึม', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610103', 'สะแกกรัง', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610104', 'ดอนขวาง', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610105', 'หาดทนง', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610106', 'เกาะเทโพ', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610107', 'ท่าซุง', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610108', 'หนองแก', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610109', 'โนนเหล็ก', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610110', 'หนองเต่า', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610111', 'หนองไผ่แบน', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610112', 'หนองพังค่า', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610113', 'ทุ่งใหญ่', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610114', 'เนินแจง', '6101', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610201', 'ทัพทัน', '6102', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610202', 'ทุ่งนาไทย', '6102', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610203', 'เขาขี้ฝอย', '6102', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610204', 'หนองหญ้าปล้อง', '6102', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610205', 'โคกหม้อ', '6102', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610206', 'หนองยายดา', '6102', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610207', 'หนองกลางดง', '6102', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610208', 'หนองกระทุ่ม', '6102', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610209', 'หนองสระ', '6102', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610210', 'ตลุกดู่', '6102', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610301', 'สว่างอารมณ์', '6103', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610302', 'หนองหลวง', '6103', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610303', 'พลวงสองนาง', '6103', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610304', 'ไผ่เขียว', '6103', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610305', 'บ่อยาง', '6103', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610401', 'หนองฉาง', '6104', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610402', 'หนองยาง', '6104', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610403', 'หนองนางนวล', '6104', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610404', 'หนองสรวง', '6104', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610405', 'บ้านเก่า', '6104', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610406', 'อุทัยเก่า', '6104', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610407', 'ทุ่งโพ', '6104', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610408', 'ทุ่งพง', '6104', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610409', 'เขาบางแกรก', '6104', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610410', 'เขากวางทอง', '6104', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610501', 'หนองขาหย่าง', '6105', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610502', 'หนองไผ่', '6105', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610503', 'ดอนกลอย', '6105', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610504', 'ห้วยรอบ', '6105', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610505', 'ทุ่งพึ่ง', '6105', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610506', 'ท่าโพ', '6105', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610507', 'หมกแถว', '6105', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610508', 'หลุมเข้า', '6105', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610509', 'ดงขวาง', '6105', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610601', 'บ้านไร่', '6106', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610602', 'ทัพหลวง', '6106', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610603', 'ห้วยแห้ง', '6106', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610604', 'คอกควาย', '6106', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610605', 'วังหิน', '6106', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610606', 'เมืองการุ้ง', '6106', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610607', 'แก่นมะกรูด', '6106', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610609', 'หนองจอก', '6106', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610610', 'หูช้าง', '6106', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610611', 'บ้านบึง', '6106', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610612', 'บ้านใหม่คลองเคียน', '6106', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610613', 'หนองบ่มกล้วย', '6106', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610614', 'เจ้าวัด', '6106', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610701', 'ลานสัก', '6107', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610702', 'ประดู่ยืน', '6107', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610703', 'ป่าอ้อ', '6107', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610704', 'ระบำ', '6107', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610705', 'น้ำรอบ', '6107', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610706', 'ทุ่งนางาม', '6107', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610801', 'สุขฤทัย', '6108', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610802', 'ทองหลาง', '6108', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('610803', 'ห้วยคต', '6108', ' ', '61', ' ');
INSERT INTO `ref_tambol` VALUES ('620101', 'ในเมือง', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620102', 'ไตรตรึงษ์', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620103', 'อ่างทอง', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620104', 'นาบ่อคำ', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620105', 'นครชุม', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620106', 'ทรงธรรม', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620107', 'ลานดอกไม้', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620110', 'หนองปลิง', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620111', 'คณฑี', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620112', 'นิคมทุ่งโพธิ์ทะเล', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620113', 'เทพนคร', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620114', 'วังทอง', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620115', 'ท่าขุนราม', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620117', 'คลองแม่ลาย', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620118', 'ธำมรงค์', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620119', 'สระแก้ว', '6201', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620201', 'ไทรงาม', '6202', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620202', 'หนองคล้า', '6202', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620203', 'หนองทอง', '6202', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620204', 'หนองไม้กอง', '6202', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620205', 'มหาชัย', '6202', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620206', 'พานทอง', '6202', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620207', 'หนองแม่แตง', '6202', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620301', 'คลองน้ำไหล', '6203', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620302', 'โป่งน้ำร้อน', '6203', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620303', 'คลองลานพัฒนา', '6203', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620304', 'สักงาม', '6203', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620403', 'ยางสูง', '6204', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620404', 'ป่าพุทรา', '6204', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620405', 'แสนตอ', '6204', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620406', 'สลกบาตร', '6204', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620407', 'บ่อถ้ำ', '6204', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620408', 'ดอนแตง', '6204', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620409', 'วังชะพลู', '6204', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620410', 'โค้งไผ่', '6204', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620411', 'ปางมะค่า', '6204', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620412', 'วังหามแห', '6204', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620413', 'เกาะตาล', '6204', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620501', 'คลองขลุง', '6205', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620502', 'ท่ามะเขือ', '6205', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620504', 'ท่าพุทรา', '6205', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620505', 'แม่ลาด', '6205', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620506', 'วังยาง', '6205', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620507', 'วังแขม', '6205', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620508', 'หัวถนน', '6205', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620509', 'วังไทร', '6205', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620513', 'วังบัว', '6205', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620516', 'คลองสมบูรณ์', '6205', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620601', 'พรานกระต่าย', '6206', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620602', 'หนองหัววัว', '6206', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620603', 'ท่าไม้', '6206', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620604', 'วังควง', '6206', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620605', 'วังตะแบก', '6206', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620606', 'เขาคีริส', '6206', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620607', 'คุยบ้านโอง', '6206', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620608', 'คลองพิไกร', '6206', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620609', 'ถ้ำกระต่ายทอง', '6206', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620610', 'ห้วยยั้ง', '6206', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620701', 'ลานกระบือ', '6207', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620702', 'ช่องลม', '6207', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620703', 'หนองหลวง', '6207', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620704', 'โนนพลวง', '6207', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620705', 'ประชาสุขสันต์', '6207', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620706', 'บึงทับแรต', '6207', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620707', 'จันทิมา', '6207', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620801', 'ทุ่งทราย', '6208', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620802', 'ทุ่งทอง', '6208', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620803', 'ถาวรวัฒนา', '6208', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620901', 'โพธิ์ทอง', '6209', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620902', 'หินดาต', '6209', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('620903', 'ปางตาไว', '6209', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('621001', 'บึงสามัคคี', '6210', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('621002', 'วังชะโอน', '6210', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('621003', 'ระหาน', '6210', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('621004', 'เทพนิมิต', '6210', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('621101', 'โกสัมพี', '6211', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('621102', 'เพชรชมภู', '6211', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('621103', 'ลานดอกไม้ตก', '6211', ' ', '62', ' ');
INSERT INTO `ref_tambol` VALUES ('630101', 'ระแหง', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630102', 'หนองหลวง', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630103', 'เชียงเงิน', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630104', 'หัวเดียด', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630105', 'หนองบัวเหนือ', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630106', 'ไม้งาม', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630107', 'โป่งแดง', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630108', 'น้ำรึม', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630109', 'วังหิน', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630111', 'แม่ท้อ', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630112', 'ป่ามะม่วง', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630113', 'หนองบัวใต้', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630114', 'วังประจบ', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630115', 'ตลุกกลางทุ่ง', '6301', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630201', 'ตากออก', '6302', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630202', 'สมอโคน', '6302', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630203', 'แม่สลิด', '6302', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630204', 'ตากตก', '6302', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630205', 'เกาะตะเภา', '6302', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630206', 'ทุ่งกระเชาะ', '6302', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630207', 'ท้องฟ้า', '6302', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630301', 'สามเงา', '6303', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630302', 'วังหมัน', '6303', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630303', 'ยกกระบัตร', '6303', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630304', 'ย่านรี', '6303', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630305', 'บ้านนา', '6303', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630306', 'วังจันทร์', '6303', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630401', 'แม่ระมาด', '6304', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630402', 'แม่จะเรา', '6304', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630403', 'ขะเนจื้อ', '6304', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630404', 'แม่ตื่น', '6304', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630405', 'สามหมื่น', '6304', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630406', 'พระธาตุ', '6304', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630501', 'ท่าสองยาง', '6305', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630502', 'แม่ต้าน', '6305', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630503', 'แม่สอง', '6305', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630504', 'แม่หละ', '6305', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630505', 'แม่วะหลวง', '6305', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630506', 'แม่อุสุ', '6305', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630601', 'แม่สอด', '6306', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630602', 'แม่กุ', '6306', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630603', 'พะวอ', '6306', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630604', 'แม่ตาว', '6306', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630605', 'แม่กาษา', '6306', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630606', 'ท่าสายลวด', '6306', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630607', 'แม่ปะ', '6306', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630608', 'มหาวัน', '6306', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630609', 'ด่านแม่ละเมา', '6306', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630610', 'พระธาตุผาแดง', '6306', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630701', 'พบพระ', '6307', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630702', 'ช่องแคบ', '6307', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630703', 'คีรีราษฎร์', '6307', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630704', 'วาเล่ย์', '6307', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630705', 'รวมไทยพัฒนา', '6307', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630801', 'อุ้มผาง', '6308', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630802', 'หนองหลวง', '6308', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630803', 'โมโกร', '6308', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630804', 'แม่จัน', '6308', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630805', 'แม่ละมุ้ง', '6308', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630806', 'แม่กลอง', '6308', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630901', 'เชียงทอง', '6309', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630902', 'นาโบสถ์', '6309', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('630903', 'ประดาง', '6309', ' ', '63', ' ');
INSERT INTO `ref_tambol` VALUES ('640101', 'ธานี', '6401', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640102', 'บ้านสวน', '6401', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640103', 'เมืองเก่า', '6401', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640104', 'ปากแคว', '6401', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640105', 'ยางซ้าย', '6401', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640106', 'บ้านกล้วย', '6401', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640107', 'บ้านหลุม', '6401', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640108', 'ตาลเตี้ย', '6401', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640109', 'ปากพระ', '6401', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640110', 'วังทองแดง', '6401', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640201', 'ลานหอย', '6402', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640202', 'บ้านด่าน', '6402', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640203', 'วังตะคร้อ', '6402', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640204', 'วังน้ำขาว', '6402', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640205', 'ตลิ่งชัน', '6402', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640206', 'หนองหญ้าปล้อง', '6402', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640207', 'วังลึก', '6402', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640301', 'โตนด', '6403', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640302', 'ทุ่งหลวง', '6403', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640303', 'บ้านป้อม', '6403', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640304', 'สามพวง', '6403', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640305', 'ศรีคีรีมาศ', '6403', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640306', 'หนองจิก', '6403', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640307', 'นาเชิงคีรี', '6403', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640308', 'หนองกระดิ่ง', '6403', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640309', 'บ้านน้ำพุ', '6403', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640310', 'ทุ่งยางเมือง', '6403', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640401', 'กง', '6404', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640402', 'บ้านกร่าง', '6404', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640403', 'ไกรนอก', '6404', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640404', 'ไกรกลาง', '6404', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640405', 'ไกรใน', '6404', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640406', 'ดงเดือย', '6404', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640407', 'ป่าแฝก', '6404', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640408', 'กกแรต', '6404', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640409', 'ท่าฉนวน', '6404', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640410', 'หนองตูม', '6404', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640411', 'บ้านใหม่สุขเกษม', '6404', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640501', 'หาดเสี้ยว', '6405', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640502', 'ป่างิ้ว', '6405', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640503', 'แม่สำ', '6405', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640504', 'แม่สิน', '6405', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640505', 'บ้านตึก', '6405', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640506', 'หนองอ้อ', '6405', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640507', 'ท่าชัย', '6405', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640508', 'ศรีสัชนาลัย', '6405', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640509', 'ดงคู่', '6405', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640510', 'บ้านแก่ง', '6405', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640511', 'สารจิตร', '6405', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640601', 'คลองตาล', '6406', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640602', 'วังลึก', '6406', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640603', 'สามเรือน', '6406', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640604', 'บ้านนา', '6406', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640605', 'วังทอง', '6406', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640606', 'นาขุนไกร', '6406', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640607', 'เกาะตาเลี้ยง', '6406', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640608', 'วัดเกาะ', '6406', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640609', 'บ้านไร่', '6406', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640610', 'ทับผึ้ง', '6406', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640611', 'บ้านซ่าน', '6406', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640612', 'วังใหญ่', '6406', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640613', 'ราวต้นจันทร์', '6406', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640701', 'เมืองสวรรคโลก', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640702', 'ในเมือง', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640703', 'คลองกระจง', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640704', 'วังพิณพาทย์', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640705', 'วังไม้ขอน', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640706', 'ย่านยาว', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640707', 'นาทุ่ง', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640708', 'คลองยาง', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640709', 'เมืองบางยม', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640710', 'ท่าทอง', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640711', 'ปากน้ำ', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640712', 'ป่ากุมเกาะ', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640713', 'เมืองบางขลัง', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640714', 'หนองกลับ', '6407', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640801', 'ศรีนคร', '6408', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640802', 'นครเดิฐ', '6408', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640803', 'น้ำขุม', '6408', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640804', 'คลองมะพลับ', '6408', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640805', 'หนองบัว', '6408', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640901', 'บ้านใหม่ไชยมงคล', '6409', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640902', 'ไทยชนะศึก', '6409', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640903', 'ทุ่งเสลี่ยม', '6409', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640904', 'กลางดง', '6409', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('640905', 'เขาแก้วศรีสมบูรณ์', '6409', ' ', '64', ' ');
INSERT INTO `ref_tambol` VALUES ('650101', 'ในเมือง', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650102', 'วังน้ำคู้', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650103', 'วัดจันทร์', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650104', 'วัดพริก', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650105', 'ท่าทอง', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650106', 'ท่าโพธิ์', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650107', 'สมอแข', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650108', 'ดอนทอง', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650109', 'บ้านป่า', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650110', 'ปากโทก', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650111', 'หัวรอ', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650112', 'จอมทอง', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650113', 'บ้านกร่าง', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650114', 'บ้านคลอง', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650115', 'พลายชุมพล', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650116', 'มะขามสูง', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650117', 'อรัญญิก', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650118', 'บึงพระ', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650119', 'ไผ่ขอดอน', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650120', 'งิ้วงาม', '6501', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650201', 'นครไทย', '6502', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650202', 'หนองกะท้าว', '6502', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650203', 'บ้านแยง', '6502', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650204', 'เนินเพิ่ม', '6502', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650205', 'นาบัว', '6502', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650206', 'นครชุม', '6502', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650207', 'น้ำกุ่ม', '6502', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650208', 'ยางโกลน', '6502', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650209', 'บ่อโพธิ์', '6502', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650210', 'บ้านพร้าว', '6502', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650211', 'ห้วยเฮี้ย', '6502', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650301', 'ป่าแดง', '6503', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650302', 'ชาติตระการ', '6503', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650303', 'สวนเมี่ยง', '6503', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650304', 'บ้านดง', '6503', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650305', 'บ่อภาค', '6503', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650306', 'ท่าสะแก', '6503', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650401', 'บางระกำ', '6504', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650402', 'ปลักแรด', '6504', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650403', 'พันเสา', '6504', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650404', 'วังอิทก', '6504', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650405', 'บึงกอก', '6504', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650406', 'หนองกุลา', '6504', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650407', 'ชุมแสงสงคราม', '6504', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650408', 'นิคมพัฒนา', '6504', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650409', 'บ่อทอง', '6504', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650410', 'ท่านางงาม', '6504', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650411', 'คุยม่วง', '6504', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650501', 'บางกระทุ่ม', '6505', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650502', 'บ้านไร่', '6505', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650503', 'โคกสลุด', '6505', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650504', 'สนามคลี', '6505', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650505', 'ท่าตาล', '6505', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650506', 'ไผ่ล้อม', '6505', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650507', 'นครป่าหมาก', '6505', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650508', 'เนินกุ่ม', '6505', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650509', 'วัดตายม', '6505', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650601', 'พรหมพิราม', '6506', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650602', 'ท่าช้าง', '6506', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650603', 'วงฆ้อง', '6506', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650604', 'มะตูม', '6506', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650605', 'หอกลอง', '6506', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650606', 'ศรีภิรมย์', '6506', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650607', 'ตลุกเทียม', '6506', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650608', 'วังวน', '6506', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650609', 'หนองแขม', '6506', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650610', 'มะต้อง', '6506', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650611', 'ทับยายเชียง', '6506', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650612', 'ดงประคำ', '6506', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650701', 'วัดโบสถ์', '6507', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650702', 'ท่างาม', '6507', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650703', 'ท้อแท้', '6507', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650704', 'บ้านยาง', '6507', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650705', 'หินลาด', '6507', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650706', 'คันโช้ง', '6507', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650801', 'วังทอง', '6508', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650802', 'พันชาลี', '6508', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650803', 'แม่ระกา', '6508', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650804', 'บ้านกลาง', '6508', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650805', 'วังพิกุล', '6508', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650806', 'แก่งโสภา', '6508', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650807', 'ท่าหมื่นราม', '6508', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650808', 'วังนกแอ่น', '6508', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650809', 'หนองพระ', '6508', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650810', 'ชัยนาม', '6508', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650811', 'ดินทอง', '6508', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650901', 'ชมพู', '6509', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650902', 'บ้านมุง', '6509', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650903', 'ไทรย้อย', '6509', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650904', 'วังโพรง', '6509', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650905', 'บ้านน้อยซุ้มขี้เหล็ก', '6509', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650906', 'เนินมะปราง', '6509', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650907', 'วังยาง', '6509', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('650908', 'โคกแหลม', '6509', ' ', '65', ' ');
INSERT INTO `ref_tambol` VALUES ('660101', 'ในเมือง', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660102', 'ไผ่ขวาง', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660103', 'ย่านยาว', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660104', 'ท่าฬ่อ', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660105', 'ปากทาง', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660106', 'คลองคะเชนทร์', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660107', 'โรงช้าง', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660108', 'เมืองเก่า', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660109', 'ท่าหลวง', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660110', 'บ้านบุ่ง', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660111', 'ฆะมัง', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660112', 'ดงป่าคำ', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660113', 'หัวดง', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660115', 'ป่ามะคาบ', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660119', 'สายคำโห้', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660120', 'ดงกลาง', '6601', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660201', 'วังทรายพูน', '6602', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660202', 'หนองปลาไหล', '6602', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660203', 'หนองพระ', '6602', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660204', 'หนองปล้อง', '6602', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660301', 'โพธิ์ประทับช้าง', '6603', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660302', 'ไผ่ท่าโพ', '6603', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660303', 'วังจิก', '6603', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660304', 'ไผ่รอบ', '6603', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660305', 'ดงเสือเหลือง', '6603', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660306', 'เนินสว่าง', '6603', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660307', 'ทุ่งใหญ่', '6603', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660401', 'ตะพานหิน', '6604', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660402', 'งิ้วราย', '6604', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660403', 'ห้วยเกตุ', '6604', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660404', 'ไทรโรงโขน', '6604', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660405', 'หนองพยอม', '6604', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660406', 'ทุ่งโพธิ์', '6604', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660407', 'ดงตะขบ', '6604', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660408', 'คลองคูณ', '6604', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660409', 'วังสำโรง', '6604', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660410', 'วังหว้า', '6604', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660411', 'วังหลุม', '6604', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660412', 'ทับหมัน', '6604', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660413', 'ไผ่หลวง', '6604', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660501', 'บางมูลนาก', '6605', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660502', 'บางไผ่', '6605', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660503', 'หอไกร', '6605', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660504', 'เนินมะกอก', '6605', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660505', 'วังสำโรง', '6605', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660506', 'ภูมิ', '6605', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660507', 'วังกรด', '6605', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660508', 'ห้วยเขน', '6605', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660509', 'วังตะกู', '6605', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660514', 'ลำประดา', '6605', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660601', 'โพทะเล', '6606', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660602', 'ท้ายน้ำ', '6606', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660603', 'ทะนง', '6606', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660604', 'ท่าบัว', '6606', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660605', 'ทุ่งน้อย', '6606', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660606', 'ท่าขมิ้น', '6606', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660607', 'ท่าเสา', '6606', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660608', 'บางคลาน', '6606', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660611', 'ท่านั่ง', '6606', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660612', 'บ้านน้อย', '6606', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660613', 'วัดขวาง', '6606', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660701', 'สามง่าม', '6607', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660702', 'กำแพงดิน', '6607', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660703', 'รังนก', '6607', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660706', 'เนินปอ', '6607', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660707', 'หนองโสน', '6607', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660801', 'ทับคล้อ', '6608', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660802', 'เขาทราย', '6608', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660803', 'เขาเจ็ดลูก', '6608', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660804', 'ท้ายทุ่ง', '6608', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660901', 'สากเหล็ก', '6609', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660902', 'ท่าเยี่ยม', '6609', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660903', 'คลองทราย', '6609', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660904', 'หนองหญ้าไทร', '6609', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('660905', 'วังทับไทร', '6609', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661001', 'ห้วยแก้ว', '6610', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661002', 'โพธิ์ไทรงาม', '6610', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661003', 'แหลมรัง', '6610', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661004', 'บางลาย', '6610', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661005', 'บึงนาราง', '6610', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661101', 'วังงิ้วใต้', '6611', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661102', 'วังงิ้ว', '6611', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661103', 'ห้วยร่วม', '6611', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661104', 'ห้วยพุก', '6611', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661105', 'สำนักขุนเณร', '6611', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661201', 'บ้านนา', '6612', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661202', 'บึงบัว', '6612', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661203', 'วังโมกข์', '6612', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('661204', 'หนองหลุม', '6612', ' ', '66', ' ');
INSERT INTO `ref_tambol` VALUES ('670101', 'ในเมือง', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670102', 'ตะเบาะ', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670103', 'บ้านโตก', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670104', 'สะเดียง', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670105', 'ป่าเลา', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670106', 'นางั่ว', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670107', 'ท่าพล', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670108', 'ดงมูลเหล็ก', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670109', 'บ้านโคก', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670110', 'ชอนไพร', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670111', 'นาป่า', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670112', 'นายม', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670113', 'วังชมภู', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670114', 'น้ำร้อน', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670115', 'ห้วยสะแก', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670116', 'ห้วยใหญ่', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670117', 'ระวิง', '6701', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670201', 'ชนแดน', '6702', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670202', 'ดงขุย', '6702', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670203', 'ท่าข้าม', '6702', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670204', 'พุทธบาท', '6702', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670205', 'ลาดแค', '6702', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670206', 'บ้านกล้วย', '6702', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670208', 'ซับพุทรา', '6702', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670209', 'ตะกุดไร', '6702', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670210', 'ศาลาลาย', '6702', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670301', 'หล่มสัก', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670302', 'วัดป่า', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670303', 'ตาลเดี่ยว', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670304', 'ฝายนาแซง', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670305', 'หนองสว่าง', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670306', 'น้ำเฮี้ย', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670307', 'สักหลง', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670308', 'ท่าอิบุญ', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670309', 'บ้านโสก', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670310', 'บ้านติ้ว', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670311', 'ห้วยไร่', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670312', 'น้ำก้อ', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670313', 'ปากช่อง', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670314', 'น้ำชุน', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670315', 'หนองไขว่', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670316', 'ลานบ่า', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670317', 'บุ่งคล้า', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670318', 'บุ่งน้ำเต้า', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670319', 'บ้านกลาง', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670320', 'ช้างตะลูด', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670321', 'บ้านไร่', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670322', 'ปากดุก', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670323', 'บ้านหวาย', '6703', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670401', 'หล่มเก่า', '6704', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670402', 'นาซำ', '6704', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670403', 'หินฮาว', '6704', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670404', 'บ้านเนิน', '6704', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670405', 'ศิลา', '6704', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670406', 'นาแซง', '6704', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670407', 'วังบาล', '6704', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670408', 'นาเกาะ', '6704', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670409', 'ตาดกลอย', '6704', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670501', 'ท่าโรง', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670502', 'สระประดู่', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670503', 'สามแยก', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670504', 'โคกปรง', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670505', 'น้ำร้อน', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670506', 'บ่อรัง', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670507', 'พุเตย', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670508', 'พุขาม', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670509', 'ภูน้ำหยด', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670510', 'ซับสมบูรณ์', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670511', 'บึงกระจับ', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670512', 'วังใหญ่', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670513', 'ยางสาว', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670514', 'ซับน้อย', '6705', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670601', 'ศรีเทพ', '6706', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670602', 'สระกรวด', '6706', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670603', 'คลองกระจัง', '6706', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670604', 'นาสนุ่น', '6706', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670605', 'โคกสะอาด', '6706', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670606', 'หนองย่างทอย', '6706', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670607', 'ประดู่งาม', '6706', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670701', 'กองทูล', '6707', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670702', 'นาเฉลียง', '6707', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670703', 'บ้านโภชน์', '6707', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670704', 'ท่าแดง', '6707', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670705', 'เพชรละคร', '6707', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670706', 'บ่อไทย', '6707', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670707', 'ห้วยโป่ง', '6707', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670708', 'วังท่าดี', '6707', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670709', 'บัววัฒนา', '6707', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670710', 'หนองไผ่', '6707', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670711', 'วังโบสถ์', '6707', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670712', 'ยางงาม', '6707', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670713', 'ท่าด้วง', '6707', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670801', 'ซับสมอทอด', '6708', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670802', 'ซับไม้แดง', '6708', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670803', 'หนองแจง', '6708', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670804', 'กันจุ', '6708', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670805', 'วังพิกุล', '6708', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670806', 'พญาวัง', '6708', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670807', 'ศรีมงคล', '6708', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670808', 'สระแก้ว', '6708', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670809', 'บึงสามพัน', '6708', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670901', 'น้ำหนาว', '6709', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670902', 'หลักด่าน', '6709', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670903', 'วังกวาง', '6709', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('670904', 'โคกมน', '6709', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('671001', 'วังโป่ง', '6710', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('671002', 'ท้ายดง', '6710', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('671003', 'ซับเปิบ', '6710', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('671004', 'วังหิน', '6710', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('671005', 'วังศาล', '6710', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('671101', 'ทุ่งสมอ', '6711', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('671102', 'แคมป์สน', '6711', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('671103', 'เขาค้อ', '6711', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('671104', 'ริมสีม่วง', '6711', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('671105', 'สะเดาะพง', '6711', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('671106', 'หนองแม่นา', '6711', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('671107', 'เข็กน้อย', '6711', ' ', '67', ' ');
INSERT INTO `ref_tambol` VALUES ('700101', 'หน้าเมือง', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700102', 'เจดีย์หัก', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700103', 'ดอนตะโก', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700104', 'หนองกลางนา', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700105', 'ห้วยไผ่', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700106', 'คุ้งน้ำวน', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700107', 'คุ้งกระถิน', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700108', 'อ่างทอง', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700109', 'โคกหม้อ', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700110', 'สามเรือน', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700111', 'พิกุลทอง', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700112', 'น้ำพุ', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700113', 'ดอนแร่', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700114', 'หินกอง', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700115', 'เขาแร้ง', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700116', 'เกาะพลับพลา', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700117', 'หลุมดิน', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700118', 'บางป่า', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700119', 'พงสวาย', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700120', 'คูบัว', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700121', 'ท่าราบ', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700122', 'บ้านไร่', '7001', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700201', 'จอมบึง', '7002', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700202', 'ปากช่อง', '7002', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700203', 'เบิกไพร', '7002', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700204', 'ด่านทับตะโก', '7002', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700205', 'แก้มอ้น', '7002', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700206', 'รางบัว', '7002', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700301', 'สวนผึ้ง', '7003', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700302', 'ป่าหวาย', '7003', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700304', 'ท่าเคย', '7003', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700307', 'ตะนาวศรี', '7003', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700401', 'ดำเนินสะดวก', '7004', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700402', 'ประสาทสิทธิ์', '7004', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700403', 'ศรีสุราษฎร์', '7004', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700404', 'ตาหลวง', '7004', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700405', 'ดอนกรวย', '7004', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700406', 'ดอนคลัง', '7004', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700407', 'บัวงาม', '7004', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700408', 'บ้านไร่', '7004', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700409', 'แพงพวย', '7004', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700410', 'สี่หมื่น', '7004', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700411', 'ท่านัด', '7004', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700412', 'ขุนพิทักษ์', '7004', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700413', 'ดอนไผ่', '7004', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700501', 'บ้านโป่ง', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700502', 'ท่าผา', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700503', 'กรับใหญ่', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700504', 'ปากแรต', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700505', 'หนองกบ', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700506', 'หนองอ้อ', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700507', 'ดอนกระเบื้อง', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700508', 'สวนกล้วย', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700509', 'นครชุมน์', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700510', 'บ้านม่วง', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700511', 'คุ้งพยอม', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700512', 'หนองปลาหมอ', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700513', 'เขาขลุง', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700514', 'เบิกไพร', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700515', 'ลาดบัวขาว', '7005', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700601', 'บางแพ', '7006', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700602', 'วังเย็น', '7006', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700603', 'หัวโพ', '7006', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700604', 'วัดแก้ว', '7006', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700605', 'ดอนใหญ่', '7006', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700606', 'ดอนคา', '7006', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700607', 'โพหัก', '7006', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700701', 'โพธาราม', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700702', 'ดอนกระเบื้อง', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700703', 'หนองโพ', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700704', 'บ้านเลือก', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700705', 'คลองตาคต', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700706', 'บ้านฆ้อง', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700707', 'บ้านสิงห์', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700708', 'ดอนทราย', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700709', 'เจ็ดเสมียน', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700710', 'คลองข่อย', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700711', 'ชำแระ', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700712', 'สร้อยฟ้า', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700713', 'ท่าชุมพล', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700714', 'บางโตนด', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700715', 'เตาปูน', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700716', 'นางแก้ว', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700717', 'ธรรมเสน', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700718', 'เขาชะงุ้ม', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700719', 'หนองกวาง', '7007', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700801', 'ทุ่งหลวง', '7008', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700802', 'วังมะนาว', '7008', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700803', 'ดอนทราย', '7008', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700804', 'หนองกระทุ่ม', '7008', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700805', 'ปากท่อ', '7008', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700806', 'ป่าไก่', '7008', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700807', 'วัดยางงาม', '7008', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700808', 'อ่างหิน', '7008', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700809', 'บ่อกระดาน', '7008', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700810', 'ยางหัก', '7008', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700811', 'วันดาว', '7008', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700812', 'ห้วยยางโทน', '7008', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700901', 'เกาะศาลพระ', '7009', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700902', 'จอมประทัด', '7009', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('700903', 'วัดเพลง', '7009', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('701001', 'บ้านคา', '7010', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('701002', 'บ้านบึง', '7010', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('701003', 'หนองพันจันทร์', '7010', ' ', '70', ' ');
INSERT INTO `ref_tambol` VALUES ('710101', 'บ้านเหนือ', '7101', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710102', 'บ้านใต้', '7101', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710103', 'ปากแพรก', '7101', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710104', 'ท่ามะขาม', '7101', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710105', 'แก่งเสี้ยน', '7101', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710106', 'หนองบัว', '7101', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710107', 'ลาดหญ้า', '7101', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710108', 'วังด้ง', '7101', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710109', 'ช่องสะเดา', '7101', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710110', 'หนองหญ้า', '7101', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710111', 'เกาะสำโรง', '7101', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710113', 'บ้านเก่า', '7101', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710116', 'วังเย็น', '7101', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710201', 'ลุ่มสุ่ม', '7102', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710202', 'ท่าเสา', '7102', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710203', 'สิงห์', '7102', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710204', 'ไทรโยค', '7102', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710205', 'วังกระแจะ', '7102', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710206', 'ศรีมงคล', '7102', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710207', 'บ้องตี้', '7102', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710301', 'บ่อพลอย', '7103', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710302', 'หนองกุ่ม', '7103', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710303', 'หนองรี', '7103', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710305', 'หลุมรัง', '7103', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710308', 'ช่องด่าน', '7103', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710309', 'หนองกร่าง', '7103', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710401', 'นาสวน', '7104', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710402', 'ด่านแม่แฉลบ', '7104', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710403', 'หนองเป็ด', '7104', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710404', 'ท่ากระดาน', '7104', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710405', 'เขาโจด', '7104', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710406', 'แม่กระบุง', '7104', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710501', 'พงตึก', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710502', 'ยางม่วง', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710503', 'ดอนชะเอม', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710504', 'ท่าไม้', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710505', 'ตะคร้ำเอน', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710506', 'ท่ามะกา', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710507', 'ท่าเรือ', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710508', 'โคกตะบอง', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710509', 'ดอนขมิ้น', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710510', 'อุโลกสี่หมื่น', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710511', 'เขาสามสิบหาบ', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710512', 'พระแท่น', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710513', 'หวายเหนียว', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710514', 'แสนตอ', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710515', 'สนามแย้', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710516', 'ท่าเสา', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710517', 'หนองลาน', '7105', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710601', 'ท่าม่วง', '7106', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710602', 'วังขนาย', '7106', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710603', 'วังศาลา', '7106', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710604', 'ท่าล้อ', '7106', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710605', 'หนองขาว', '7106', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710606', 'ทุ่งทอง', '7106', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710607', 'เขาน้อย', '7106', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710608', 'ม่วงชุม', '7106', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710609', 'บ้านใหม่', '7106', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710610', 'พังตรุ', '7106', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710611', 'ท่าตะคร้อ', '7106', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710612', 'รางสาลี่', '7106', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710613', 'หนองตากยา', '7106', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710701', 'ท่าขนุน', '7107', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710702', 'ปิล๊อก', '7107', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710703', 'หินดาด', '7107', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710704', 'ลิ่นถิ่น', '7107', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710705', 'ชะแล', '7107', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710706', 'ห้วยเขย่ง', '7107', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710707', 'สหกรณ์นิคม', '7107', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710801', 'หนองลู', '7108', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710802', 'ปรังเผล', '7108', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710803', 'ไล่โว่', '7108', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710901', 'พนมทวน', '7109', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710902', 'หนองโรง', '7109', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710903', 'ทุ่งสมอ', '7109', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710904', 'ดอนเจดีย์', '7109', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710905', 'พังตรุ', '7109', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710906', 'รางหวาย', '7109', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710911', 'หนองสาหร่าย', '7109', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('710912', 'ดอนตาเพชร', '7109', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711001', 'เลาขวัญ', '7110', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711002', 'หนองโสน', '7110', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711003', 'หนองประดู่', '7110', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711004', 'หนองปลิง', '7110', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711005', 'หนองนกแก้ว', '7110', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711006', 'ทุ่งกระบ่ำ', '7110', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711007', 'หนองฝ้าย', '7110', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711101', 'ด่านมะขามเตี้ย', '7111', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711102', 'กลอนโด', '7111', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711103', 'จรเข้เผือก', '7111', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711104', 'หนองไผ่', '7111', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711201', 'หนองปรือ', '7112', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711202', 'หนองปลาไหล', '7112', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711203', 'สมเด็จเจริญ', '7112', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711301', 'ห้วยกระเจา', '7113', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711302', 'วังไผ่', '7113', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711303', 'ดอนแสลบ', '7113', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('711304', 'สระลงเรือ', '7113', ' ', '71', ' ');
INSERT INTO `ref_tambol` VALUES ('720101', 'ท่าพี่เลี้ยง', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720102', 'รั้วใหญ่', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720103', 'ทับตีเหล็ก', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720104', 'ท่าระหัด', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720105', 'ไผ่ขวาง', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720106', 'โคกโคเฒ่า', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720107', 'ดอนตาล', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720108', 'ดอนมะสังข์', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720109', 'พิหารแดง', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720110', 'ดอนกำยาน', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720111', 'ดอนโพธิ์ทอง', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720112', 'บ้านโพธิ์', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720113', 'สระแก้ว', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720114', 'ตลิ่งชัน', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720115', 'บางกุ้ง', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720116', 'ศาลาขาว', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720117', 'สวนแตง', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720118', 'สนามชัย', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720119', 'โพธิ์พระยา', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720120', 'สนามคลี', '7201', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720201', 'เขาพระ', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720202', 'เดิมบาง', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720203', 'นางบวช', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720204', 'เขาดิน', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720205', 'ปากน้ำ', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720206', 'ทุ่งคลี', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720207', 'โคกช้าง', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720208', 'หัวเขา', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720209', 'หัวนา', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720210', 'บ่อกรุ', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720211', 'วังศรีราช', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720212', 'ป่าสะแก', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720213', 'ยางนอน', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720214', 'หนองกระทุ่ม', '7202', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720301', 'หนองมะค่าโมง', '7203', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720302', 'ด่านช้าง', '7203', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720303', 'ห้วยขมิ้น', '7203', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720304', 'องค์พระ', '7203', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720305', 'วังคัน', '7203', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720306', 'นิคมกระเสียว', '7203', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720307', 'วังยาว', '7203', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720401', 'โคกคราม', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720402', 'บางปลาม้า', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720403', 'ตะค่า', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720404', 'บางใหญ่', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720405', 'กฤษณา', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720406', 'สาลี', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720407', 'ไผ่กองดิน', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720408', 'องครักษ์', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720409', 'จรเข้ใหญ่', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720410', 'บ้านแหลม', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720411', 'มะขามล้ม', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720412', 'วังน้ำเย็น', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720413', 'วัดโบสถ์', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720414', 'วัดดาว', '7204', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720501', 'ศรีประจันต์', '7205', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720502', 'บ้านกร่าง', '7205', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720503', 'มดแดง', '7205', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720504', 'บางงาม', '7205', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720505', 'ดอนปรู', '7205', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720506', 'ปลายนา', '7205', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720507', 'วังหว้า', '7205', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720508', 'วังน้ำซับ', '7205', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720509', 'วังยาง', '7205', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720601', 'ดอนเจดีย์', '7206', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720602', 'หนองสาหร่าย', '7206', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720603', 'ไร่รถ', '7206', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720604', 'สระกระโจม', '7206', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720605', 'ทะเลบก', '7206', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720701', 'สองพี่น้อง', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720702', 'บางเลน', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720703', 'บางตาเถร', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720704', 'บางตะเคียน', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720705', 'บ้านกุ่ม', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720706', 'หัวโพธิ์', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720707', 'บางพลับ', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720708', 'เนินพระปรางค์', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720709', 'บ้านช้าง', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720710', 'ต้นตาล', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720711', 'ศรีสำราญ', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720712', 'ทุ่งคอก', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720713', 'หนองบ่อ', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720714', 'บ่อสุพรรณ', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720715', 'ดอนมะนาว', '7207', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720801', 'ย่านยาว', '7208', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720802', 'วังลึก', '7208', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720803', 'สามชุก', '7208', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720804', 'หนองผักนาก', '7208', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720805', 'บ้านสระ', '7208', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720806', 'หนองสะเดา', '7208', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720807', 'กระเสียว', '7208', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720901', 'อู่ทอง', '7209', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720902', 'สระยายโสม', '7209', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720903', 'จรเข้สามพัน', '7209', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720904', 'บ้านดอน', '7209', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720905', 'ยุ้งทะลาย', '7209', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720906', 'ดอนมะเกลือ', '7209', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720907', 'หนองโอ่ง', '7209', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720908', 'ดอนคา', '7209', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720909', 'พลับพลาไชย', '7209', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720910', 'บ้านโข้ง', '7209', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720911', 'เจดีย์', '7209', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720912', 'สระพังลาน', '7209', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('720913', 'กระจัน', '7209', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('721001', 'หนองหญ้าไซ', '7210', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('721002', 'หนองราชวัตร', '7210', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('721003', 'หนองโพธิ์', '7210', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('721004', 'แจงงาม', '7210', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('721005', 'หนองขาม', '7210', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('721006', 'ทัพหลวง', '7210', ' ', '72', ' ');
INSERT INTO `ref_tambol` VALUES ('730101', 'พระปฐมเจดีย์', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730102', 'บางแขม', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730103', 'พระประโทน', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730104', 'ธรรมศาลา', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730105', 'ตาก้อง', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730106', 'มาบแค', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730107', 'สนามจันทร์', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730108', 'ดอนยายหอม', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730109', 'ถนนขาด', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730110', 'บ่อพลับ', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730111', 'นครปฐม', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730112', 'วังตะกู', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730113', 'หนองปากโลง', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730114', 'สามควายเผือก', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730115', 'ทุ่งน้อย', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730116', 'หนองดินแดง', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730117', 'วังเย็น', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730118', 'โพรงมะเดื่อ', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730119', 'ลำพยา', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730120', 'สระกะเทียม', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730121', 'สวนป่าน', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730122', 'ห้วยจรเข้', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730123', 'ทัพหลวง', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730124', 'หนองงูเหลือม', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730125', 'บ้านยาง', '7301', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730201', 'ทุ่งกระพังโหม', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730202', 'กระตีบ', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730203', 'ทุ่งลูกนก', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730204', 'ห้วยขวาง', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730205', 'ทุ่งขวาง', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730206', 'สระสี่มุม', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730207', 'ทุ่งบัว', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730208', 'ดอนข่อย', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730209', 'สระพัฒนา', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730210', 'ห้วยหมอนทอง', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730211', 'ห้วยม่วง', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730212', 'กำแพงแสน', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730213', 'รางพิกุล', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730214', 'หนองกระทุ่ม', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730215', 'วังน้ำเขียว', '7302', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730301', 'นครชัยศรี', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730302', 'บางกระเบา', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730303', 'วัดแค', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730304', 'ท่าตำหนัก', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730305', 'บางแก้ว', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730306', 'ท่ากระชับ', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730307', 'ขุนแก้ว', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730308', 'ท่าพระยา', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730309', 'พะเนียด', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730310', 'บางระกำ', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730311', 'โคกพระเจดีย์', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730312', 'ศรีษะทอง', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730313', 'แหลมบัว', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730314', 'ศรีมหาโพธิ์', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730315', 'สัมปทวน', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730316', 'วัดสำโรง', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730317', 'ดอนแฝก', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730318', 'ห้วยพลู', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730319', 'วัดละมุด', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730320', 'บางพระ', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730321', 'บางแก้วฟ้า', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730322', 'ลานตากฟ้า', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730323', 'งิ้วราย', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730324', 'ไทยาวาส', '7303', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730401', 'สามง่าม', '7304', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730402', 'ห้วยพระ', '7304', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730403', 'ลำเหย', '7304', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730404', 'ดอนพุทรา', '7304', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730405', 'บ้านหลวง', '7304', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730406', 'ดอนรวก', '7304', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730407', 'ห้วยด้วน', '7304', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730408', 'ลำลูกบัว', '7304', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730501', 'บางเลน', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730502', 'บางปลา', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730503', 'บางหลวง', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730504', 'บางภาษี', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730505', 'บางระกำ', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730506', 'บางไทรป่า', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730507', 'หินมูล', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730508', 'ไทรงาม', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730509', 'ดอนตูม', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730510', 'นิลเพชร', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730511', 'บัวปากท่า', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730512', 'คลองนกกระทุง', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730513', 'นราภิรมย์', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730514', 'ลำพญา', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730515', 'ไผ่หูช้าง', '7305', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730601', 'ท่าข้าม', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730602', 'ทรงคนอง', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730603', 'หอมเกร็ด', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730604', 'บางกระทึก', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730605', 'บางเตย', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730606', 'สามพราน', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730607', 'บางช้าง', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730608', 'ไร่ขิง', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730609', 'ท่าตลาด', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730610', 'กระทุ่มล้ม', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730611', 'คลองใหม่', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730612', 'ตลาดจินดา', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730613', 'คลองจินดา', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730614', 'ยายชา', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730615', 'บ้านใหม่', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730616', 'อ้อมใหญ่', '7306', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730701', 'ศาลายา', '7307', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730702', 'คลองโยง', '7307', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('730703', 'มหาสวัสดิ์', '7307', ' ', '73', ' ');
INSERT INTO `ref_tambol` VALUES ('740101', 'มหาชัย', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740102', 'ท่าฉลอม', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740103', 'โกรกกราก', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740104', 'บ้านบ่อ', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740105', 'บางโทรัด', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740106', 'กาหลง', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740107', 'นาโคก', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740108', 'ท่าจีน', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740109', 'นาดี', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740110', 'ท่าทราย', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740111', 'คอกกระบือ', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740112', 'บางน้ำจืด', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740113', 'พันท้ายนรสิงห์', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740114', 'โคกขาม', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740115', 'บ้านเกาะ', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740116', 'บางกระเจ้า', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740117', 'บางหญ้าแพรก', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740118', 'ชัยมงคล', '7401', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740201', 'ตลาดกระทุ่มแบน', '7402', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740202', 'อ้อมน้อย', '7402', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740203', 'ท่าไม้', '7402', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740204', 'สวนหลวง', '7402', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740205', 'บางยาง', '7402', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740206', 'คลองมะเดื่อ', '7402', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740207', 'หนองนกไข่', '7402', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740208', 'ดอนไก่ดี', '7402', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740209', 'แคราย', '7402', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740210', 'ท่าเสา', '7402', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740301', 'บ้านแพ้ว', '7403', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740302', 'หลักสาม', '7403', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740303', 'ยกกระบัตร', '7403', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740304', 'โรงเข้', '7403', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740305', 'หนองสองห้อง', '7403', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740306', 'หนองบัว', '7403', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740307', 'หลักสอง', '7403', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740308', 'เจ็ดริ้ว', '7403', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740309', 'คลองตัน', '7403', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740310', 'อำแพง', '7403', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740311', 'สวนส้ม', '7403', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('740312', 'เกษตรพัฒนา', '7403', ' ', '74', ' ');
INSERT INTO `ref_tambol` VALUES ('750101', 'แม่กลอง', '7501', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750102', 'บางขันแตก', '7501', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750103', 'ลาดใหญ่', '7501', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750104', 'บ้านปรก', '7501', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750105', 'บางแก้ว', '7501', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750106', 'ท้ายหาด', '7501', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750107', 'แหลมใหญ่', '7501', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750108', 'คลองเขิน', '7501', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750109', 'คลองโคน', '7501', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750110', 'นางตะเคียน', '7501', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750111', 'บางจะเกร็ง', '7501', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750201', 'กระดังงา', '7502', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750202', 'บางสะแก', '7502', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750203', 'บางยี่รงค์', '7502', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750204', 'โรงหีบ', '7502', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750205', 'บางคนที', '7502', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750206', 'ดอนมะโนรา', '7502', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750207', 'บางพรม', '7502', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750208', 'บางกุ้ง', '7502', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750209', 'จอมปลวก', '7502', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750210', 'บางนกแขวก', '7502', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750211', 'ยายแพง', '7502', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750212', 'บางกระบือ', '7502', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750213', 'บ้านปราโมทย์', '7502', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750301', 'อัมพวา', '7503', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750302', 'สวนหลวง', '7503', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750303', 'ท่าคา', '7503', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750304', 'วัดประดู่', '7503', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750305', 'เหมืองใหม่', '7503', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750306', 'บางช้าง', '7503', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750307', 'แควอ้อม', '7503', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750308', 'ปลายโพงพาง', '7503', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750309', 'บางแค', '7503', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750310', 'แพรกหนามแดง', '7503', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750311', 'ยี่สาร', '7503', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('750312', 'บางนางลี่', '7503', ' ', '75', ' ');
INSERT INTO `ref_tambol` VALUES ('760101', 'ท่าราบ', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760102', 'คลองกระแชง', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760103', 'บางจาน', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760104', 'นาพันสาม', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760105', 'ธงชัย', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760106', 'บ้านกุ่ม', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760107', 'หนองโสน', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760108', 'ไร่ส้ม', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760109', 'เวียงคอย', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760110', 'บางจาก', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760111', 'บ้านหม้อ', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760112', 'ต้นมะม่วง', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760113', 'ช่องสะแก', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760114', 'นาวุ้ง', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760115', 'สำมะโรง', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760116', 'โพพระ', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760117', 'หาดเจ้าสำราญ', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760118', 'หัวสะพาน', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760119', 'ต้นมะพร้าว', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760120', 'วังตะโก', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760121', 'โพไร่หวาน', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760122', 'ดอนยาง', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760123', 'หนองขนาน', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760124', 'หนองพลับ', '7601', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760201', 'เขาย้อย', '7602', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760202', 'สระพัง', '7602', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760203', 'บางเค็ม', '7602', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760204', 'ทับคาง', '7602', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760205', 'หนองปลาไหล', '7602', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760206', 'หนองปรง', '7602', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760207', 'หนองชุมพล', '7602', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760208', 'ห้วยโรง', '7602', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760209', 'ห้วยท่าช้าง', '7602', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760210', 'หนองชุมพลเหนือ', '7602', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760301', 'หนองหญ้าปล้อง', '7603', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760302', 'ยางน้ำกลัดเหนือ', '7603', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760303', 'ยางน้ำกลัดใต้', '7603', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760304', 'ท่าตะคร้อ', '7603', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760401', 'ชะอำ', '7604', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760402', 'บางเก่า', '7604', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760403', 'นายาง', '7604', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760404', 'เขาใหญ่', '7604', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760405', 'หนองศาลา', '7604', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760406', 'ห้วยทรายเหนือ', '7604', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760407', 'ไร่ใหม่พัฒนา', '7604', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760408', 'สามพระยา', '7604', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760409', 'ดอนขุนห้วย', '7604', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760501', 'ท่ายาง', '7605', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760502', 'ท่าคอย', '7605', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760503', 'ยางหย่อง', '7605', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760504', 'หนองจอก', '7605', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760505', 'มาบปลาเค้า', '7605', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760506', 'ท่าไม้รวก', '7605', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760507', 'วังไคร้', '7605', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760511', 'กลัดหลวง', '7605', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760512', 'ปึกเตียน', '7605', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760513', 'เขากระปุก', '7605', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760514', 'ท่าแลง', '7605', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760515', 'บ้านในดง', '7605', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760601', 'บ้านลาด', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760602', 'บ้านหาด', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760603', 'บ้านทาน', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760604', 'ตำหรุ', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760605', 'สมอพลือ', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760606', 'ไร่มะขาม', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760607', 'ท่าเสน', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760608', 'หนองกระเจ็ด', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760609', 'หนองกะปุ', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760610', 'ลาดโพธิ์', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760611', 'สะพานไกร', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760612', 'ไร่โคก', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760613', 'โรงเข้', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760614', 'ไร่สะท้อน', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760615', 'ห้วยข้อง', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760616', 'ท่าช้าง', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760617', 'ถ้ำรงค์', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760618', 'ห้วยลึก', '7606', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760701', 'บ้านแหลม', '7607', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760702', 'บางขุนไทร', '7607', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760703', 'ปากทะเล', '7607', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760704', 'บางแก้ว', '7607', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760705', 'แหลมผักเบี้ย', '7607', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760706', 'บางตะบูน', '7607', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760707', 'บางตะบูนออก', '7607', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760708', 'บางครก', '7607', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760709', 'ท่าแร้ง', '7607', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760710', 'ท่าแร้งออก', '7607', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760801', 'แก่งกระจาน', '7608', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760802', 'สองพี่น้อง', '7608', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760803', 'วังจันทร์', '7608', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760804', 'ป่าเด็ง', '7608', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760805', 'พุสวรรค์', '7608', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('760806', 'ห้วยแม่เพรียง', '7608', ' ', '76', ' ');
INSERT INTO `ref_tambol` VALUES ('770101', 'ประจวบคีรีขันธ์', '7701', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770102', 'เกาะหลัก', '7701', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770103', 'คลองวาฬ', '7701', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770104', 'ห้วยทราย', '7701', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770105', 'อ่าวน้อย', '7701', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770106', 'บ่อนอก', '7701', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770201', 'กุยบุรี', '7702', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770202', 'กุยเหนือ', '7702', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770203', 'เขาแดง', '7702', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770204', 'ดอนยายหนู', '7702', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770205', 'ไร่ใหม่', '7702', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770206', 'สามกระทาย', '7702', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770207', 'หาดขาม', '7702', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770301', 'ทับสะแก', '7703', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770302', 'อ่างทอง', '7703', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770303', 'นาหูกวาง', '7703', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770304', 'เขาล้าน', '7703', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770305', 'ห้วยยาง', '7703', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770306', 'แสงอรุณ', '7703', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770401', 'กำเนิดนพคุณ', '7704', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770402', 'พงศ์ประศาสน์', '7704', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770403', 'ร่อนทอง', '7704', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770404', 'ธงชัย', '7704', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770405', 'ชัยเกษม', '7704', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770406', 'ทองมงคล', '7704', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770407', 'แม่รำพึง', '7704', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770501', 'ปากแพรก', '7705', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770502', 'บางสะพาน', '7705', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770503', 'ทรายทอง', '7705', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770504', 'ช้างแรก', '7705', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770505', 'ไชยราช', '7705', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770601', 'ปราณบุรี', '7706', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770602', 'เขาน้อย', '7706', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770604', 'ปากน้ำปราณ', '7706', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770607', 'หนองตาแต้ม', '7706', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770608', 'วังก์พง', '7706', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770609', 'เขาจ้าว', '7706', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770701', 'หัวหิน', '7707', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770702', 'หนองแก', '7707', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770703', 'หินเหล็กไฟ', '7707', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770704', 'หนองพลับ', '7707', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770705', 'ทับใต้', '7707', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770706', 'ห้วยสัตว์ใหญ่', '7707', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770707', 'บึงนคร', '7707', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770801', 'สามร้อยยอด', '7708', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770802', 'ศิลาลอย', '7708', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770803', 'ไร่เก่า', '7708', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770804', 'ศาลาลัย', '7708', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('770805', 'ไร่ใหม่', '7708', ' ', '77', ' ');
INSERT INTO `ref_tambol` VALUES ('800101', 'ในเมือง', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800102', 'ท่าวัง', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800103', 'คลัง', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800106', 'ท่าไร่', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800107', 'ปากนคร', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800108', 'นาทราย', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800112', 'กำแพงเซา', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800113', 'ไชยมนตรี', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800114', 'มะม่วงสองต้น', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800115', 'นาเคียน', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800116', 'ท่างิ้ว', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800118', 'โพธิ์เสด็จ', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800119', 'บางจาก', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800120', 'ปากพูน', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800121', 'ท่าซัก', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800122', 'ท่าเรือ', '8001', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800201', 'พรหมโลก', '8002', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800202', 'บ้านเกาะ', '8002', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800203', 'อินคีรี', '8002', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800204', 'ทอนหงส์', '8002', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800205', 'นาเรียง', '8002', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800301', 'เขาแก้ว', '8003', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800302', 'ลานสกา', '8003', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800303', 'ท่าดี', '8003', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800304', 'กำโลน', '8003', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800305', 'ขุนทะเล', '8003', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800401', 'ฉวาง', '8004', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800403', 'ละอาย', '8004', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800404', 'นาแว', '8004', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800405', 'ไม้เรียง', '8004', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800406', 'กะเปียด', '8004', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800407', 'นากะชะ', '8004', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800409', 'ห้วยปริก', '8004', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800410', 'ไสหร้า', '8004', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800415', 'นาเขลียง', '8004', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800416', 'จันดี', '8004', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800501', 'พิปูน', '8005', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800502', 'กะทูน', '8005', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800503', 'เขาพระ', '8005', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800504', 'ยางค้อม', '8005', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800505', 'ควนกลาง', '8005', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800601', 'เชียรใหญ่', '8006', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800602', 'เชียรเขา', '8006', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800603', 'ท่าขนาน', '8006', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800604', 'บ้านกลาง', '8006', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800605', 'บ้านเนิน', '8006', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800606', 'ไสหมาก', '8006', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800607', 'ท้องลำเจียก', '8006', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800608', 'ดอนตรอ', '8006', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800609', 'สวนหลวง', '8006', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800610', 'เสือหึง', '8006', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800611', 'การะเกด', '8006', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800612', 'เขาพระบาท', '8006', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800613', 'แม่เจ้าอยู่หัว', '8006', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800701', 'ชะอวด', '8007', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800702', 'ท่าเสม็ด', '8007', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800703', 'ท่าประจะ', '8007', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800704', 'เคร็ง', '8007', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800705', 'วังอ่าง', '8007', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800706', 'บ้านตูล', '8007', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800707', 'ขอนหาด', '8007', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800708', 'เกาะขันธ์', '8007', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800709', 'ควนหนองหงษ์', '8007', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800710', 'เขาพระทอง', '8007', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800711', 'นางหลง', '8007', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800801', 'ท่าศาลา', '8008', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800802', 'กลาย', '8008', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800803', 'ท่าขึ้น', '8008', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800804', 'หัวตะพาน', '8008', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800806', 'สระแก้ว', '8008', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800807', 'โมคลาน', '8008', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800809', 'ไทยบุรี', '8008', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800810', 'ดอนตะโก', '8008', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800811', 'ตลิ่งชัน', '8008', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800813', 'โพธิ์ทอง', '8008', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800901', 'ปากแพรก', '8009', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800902', 'ชะมาย', '8009', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800903', 'หนองหงส์', '8009', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800904', 'ควนกรด', '8009', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800905', 'นาไม้ไผ่', '8009', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800906', 'นาหลวงเสน', '8009', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800907', 'เขาโร', '8009', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800908', 'กะปาง', '8009', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800909', 'ที่วัง', '8009', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800910', 'น้ำตก', '8009', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800911', 'ถ้ำใหญ่', '8009', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800912', 'นาโพธิ์', '8009', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('800913', 'เขาขาว', '8009', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801001', 'นาบอน', '8010', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801002', 'ทุ่งสง', '8010', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801003', 'แก้วแสน', '8010', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801101', 'ท่ายาง', '8011', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801102', 'ทุ่งสัง', '8011', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801103', 'ทุ่งใหญ่', '8011', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801104', 'กุแหระ', '8011', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801105', 'ปริก', '8011', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801106', 'บางรูป', '8011', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801107', 'กรุงหยัน', '8011', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801201', 'ปากพนัง', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801202', 'คลองน้อย', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801203', 'ป่าระกำ', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801204', 'ชะเมา', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801205', 'คลองกระบือ', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801206', 'เกาะทวด', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801207', 'บ้านใหม่', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801208', 'หูล่อง', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801209', 'แหลมตะลุมพุก', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801210', 'ปากพนังฝั่งตะวันตก', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801211', 'บางศาลา', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801212', 'บางพระ', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801213', 'บางตะพง', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801214', 'ปากพนังฝั่งตะวันออก', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801215', 'บ้านเพิง', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801216', 'ท่าพยา', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801217', 'ปากแพรก', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801218', 'ขนาบนาก', '8012', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801301', 'ร่อนพิบูลย์', '8013', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801302', 'หินตก', '8013', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801303', 'เสาธง', '8013', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801304', 'ควนเกย', '8013', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801305', 'ควนพัง', '8013', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801306', 'ควนชุม', '8013', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801401', 'สิชล', '8014', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801402', 'ทุ่งปรัง', '8014', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801403', 'ฉลอง', '8014', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801404', 'เสาเภา', '8014', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801405', 'เปลี่ยน', '8014', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801406', 'สี่ขีด', '8014', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801407', 'เทพราช', '8014', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801408', 'เขาน้อย', '8014', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801409', 'ทุ่งใส', '8014', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801501', 'ขนอม', '8015', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801502', 'ควนทอง', '8015', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801503', 'ท้องเนียน', '8015', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801601', 'หัวไทร', '8016', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801602', 'หน้าสตน', '8016', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801603', 'ทรายขาว', '8016', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801604', 'แหลม', '8016', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801605', 'เขาพังไกร', '8016', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801606', 'บ้านราม', '8016', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801607', 'บางนบ', '8016', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801608', 'ท่าซอม', '8016', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801609', 'ควนชะลิก', '8016', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801610', 'รามแก้ว', '8016', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801611', 'เกาะเพชร', '8016', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801701', 'บางขัน', '8017', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801702', 'บ้านลำนาว', '8017', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801703', 'วังหิน', '8017', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801704', 'บ้านนิคม', '8017', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801801', 'ถ้ำพรรณรา', '8018', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801802', 'คลองเส', '8018', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801803', 'ดุสิต', '8018', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801901', 'บ้านควนมุด', '8019', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801902', 'บ้านชะอวด', '8019', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801903', 'ควนหนองคว้า', '8019', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801904', 'ทุ่งโพธิ์', '8019', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801905', 'นาหมอบุญ', '8019', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('801906', 'สามตำบล', '8019', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802001', 'นาพรุ', '8020', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802002', 'นาสาร', '8020', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802003', 'ท้ายสำเภา', '8020', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802004', 'ช้างซ้าย', '8020', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802101', 'นบพิตำ', '8021', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802102', 'กรุงชิง', '8021', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802103', 'กะหรอ', '8021', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802104', 'นาเหรง', '8021', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802201', 'ช้างกลาง', '8022', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802202', 'หลักช้าง', '8022', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802203', 'สวนขัน', '8022', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802301', 'เชียรเขา', '8023', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802302', 'ดอนตรอ', '8023', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802303', 'สวนหลวง', '8023', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('802304', 'ทางพูน', '8023', ' ', '80', ' ');
INSERT INTO `ref_tambol` VALUES ('810101', 'ปากน้ำ', '8101', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810102', 'กระบี่ใหญ่', '8101', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810103', 'กระบี่น้อย', '8101', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810105', 'เขาคราม', '8101', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810106', 'เขาทอง', '8101', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810111', 'ทับปริก', '8101', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810115', 'ไสไทย', '8101', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810116', 'อ่าวนาง', '8101', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810117', 'หนองทะเล', '8101', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810118', 'คลองประสงค์', '8101', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810201', 'เขาพนม', '8102', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810202', 'เขาดิน', '8102', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810203', 'สินปุน', '8102', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810204', 'พรุเตียว', '8102', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810205', 'หน้าเขา', '8102', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810206', 'โคกหาร', '8102', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810301', 'เกาะลันตาใหญ่', '8103', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810302', 'เกาะลันตาน้อย', '8103', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810303', 'เกาะกลาง', '8103', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810304', 'คลองยาง', '8103', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810305', 'ศาลาด่าน', '8103', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810401', 'คลองท่อมใต้', '8104', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810402', 'คลองท่อมเหนือ', '8104', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810403', 'คลองพน', '8104', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810404', 'ทรายขาว', '8104', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810405', 'ห้วยน้ำขาว', '8104', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810406', 'พรุดินนา', '8104', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810407', 'เพหลา', '8104', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810501', 'อ่าวลึกใต้', '8105', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810502', 'แหลมสัก', '8105', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810503', 'นาเหนือ', '8105', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810504', 'คลองหิน', '8105', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810505', 'อ่าวลึกน้อย', '8105', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810506', 'อ่าวลึกเหนือ', '8105', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810507', 'เขาใหญ่', '8105', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810508', 'คลองยา', '8105', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810509', 'บ้านกลาง', '8105', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810601', 'ปลายพระยา', '8106', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810602', 'เขาเขน', '8106', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810603', 'เขาต่อ', '8106', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810604', 'คีรีวง', '8106', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810701', 'ลำทับ', '8107', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810702', 'ดินอุดม', '8107', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810703', 'ทุ่งไทรทอง', '8107', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810704', 'ดินแดง', '8107', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810801', 'เหนือคลอง', '8108', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810802', 'เกาะศรีบอยา', '8108', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810803', 'คลองขนาน', '8108', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810804', 'คลองเขม้า', '8108', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810805', 'โคกยาง', '8108', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810806', 'ตลิ่งชัน', '8108', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810807', 'ปกาสัย', '8108', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('810808', 'ห้วยยูง', '8108', ' ', '81', ' ');
INSERT INTO `ref_tambol` VALUES ('820101', 'ท้ายช้าง', '8201', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820102', 'นบปริง', '8201', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820103', 'ถ้ำน้ำผุด', '8201', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820104', 'บางเตย', '8201', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820105', 'ตากแดด', '8201', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820106', 'สองแพรก', '8201', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820107', 'ทุ่งคาโงก', '8201', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820108', 'เกาะปันหยี', '8201', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820109', 'ป่ากอ', '8201', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820201', 'เกาะยาวน้อย', '8202', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820202', 'เกาะยาวใหญ่', '8202', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820203', 'พรุใน', '8202', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820301', 'กะปง', '8203', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820302', 'ท่านา', '8203', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820303', 'เหมาะ', '8203', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820304', 'เหล', '8203', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820305', 'รมณีย์', '8203', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820401', 'ถ้ำ', '8204', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820402', 'กระโสม', '8204', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820403', 'กะไหล', '8204', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820404', 'ท่าอยู่', '8204', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820405', 'หล่อยูง', '8204', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820406', 'โคกกลอย', '8204', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820407', 'คลองเคียน', '8204', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820501', 'ตะกั่วป่า', '8205', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820502', 'บางนายสี', '8205', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820503', 'บางไทร', '8205', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820504', 'บางม่วง', '8205', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820505', 'ตำตัว', '8205', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820506', 'โคกเคียน', '8205', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820507', 'คึกคัก', '8205', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820508', 'เกาะคอเขา', '8205', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820601', 'คุระ', '8206', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820602', 'บางวัน', '8206', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820603', 'เกาะพระทอง', '8206', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820605', 'แม่นางขาว', '8206', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820701', 'ทับปุด', '8207', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820702', 'มะรุ่ย', '8207', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820703', 'บ่อแสน', '8207', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820704', 'ถ้ำทองหลาง', '8207', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820705', 'โคกเจริญ', '8207', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820706', 'บางเหรียง', '8207', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820801', 'ท้ายเหมือง', '8208', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820802', 'นาเตย', '8208', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820803', 'บางทอง', '8208', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820804', 'ทุ่งมะพร้าว', '8208', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820805', 'ลำภี', '8208', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('820806', 'ลำแก่น', '8208', ' ', '82', ' ');
INSERT INTO `ref_tambol` VALUES ('830101', 'ตลาดใหญ่', '8301', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830102', 'ตลาดเหนือ', '8301', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830103', 'เกาะแก้ว', '8301', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830104', 'รัษฎา', '8301', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830105', 'วิชิต', '8301', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830106', 'ฉลอง', '8301', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830107', 'ราไวย์', '8301', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830108', 'กะรน', '8301', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830201', 'กะทู้', '8302', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830202', 'ป่าตอง', '8302', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830203', 'กมลา', '8302', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830301', 'เทพกระษัตรี', '8303', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830302', 'ศรีสุนทร', '8303', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830303', 'เชิงทะเล', '8303', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830304', 'ป่าคลอก', '8303', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830305', 'ไม้ขาว', '8303', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('830306', 'สาคู', '8303', ' ', '83', ' ');
INSERT INTO `ref_tambol` VALUES ('840101', 'ตลาด', '8401', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840102', 'มะขามเตี้ย', '8401', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840103', 'วัดประดู่', '8401', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840104', 'ขุนทะเล', '8401', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840105', 'บางใบไม้', '8401', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840106', 'บางชนะ', '8401', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840107', 'คลองน้อย', '8401', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840108', 'บางไทร', '8401', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840109', 'บางโพธิ์', '8401', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840110', 'บางกุ้ง', '8401', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840111', 'คลองฉนาก', '8401', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840201', 'ท่าทองใหม่', '8402', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840202', 'ท่าทอง', '8402', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840203', 'กะแดะ', '8402', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840204', 'ทุ่งกง', '8402', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840205', 'กรูด', '8402', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840206', 'ช้างซ้าย', '8402', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840207', 'พลายวาส', '8402', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840208', 'ป่าร่อน', '8402', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840209', 'ตะเคียนทอง', '8402', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840210', 'ช้างขวา', '8402', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840211', 'ท่าอุแท', '8402', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840212', 'ทุ่งรัง', '8402', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840213', 'คลองสระ', '8402', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840301', 'ดอนสัก', '8403', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840302', 'ชลคราม', '8403', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840303', 'ไชยคราม', '8403', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840304', 'ปากแพรก', '8403', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840401', 'อ่างทอง', '8404', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840402', 'ลิปะน้อย', '8404', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840403', 'ตลิ่งงาม', '8404', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840404', 'หน้าเมือง', '8404', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840405', 'มะเร็ต', '8404', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840406', 'บ่อผุด', '8404', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840407', 'แม่น้ำ', '8404', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840501', 'เกาะพะงัน', '8405', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840502', 'บ้านใต้', '8405', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840503', 'เกาะเต่า', '8405', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840601', 'ตลาดไชยา', '8406', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840602', 'พุมเรียง', '8406', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840603', 'เลม็ด', '8406', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840604', 'เวียง', '8406', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840605', 'ทุ่ง', '8406', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840606', 'ป่าเว', '8406', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840607', 'ตะกรบ', '8406', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840608', 'โมถ่าย', '8406', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840609', 'ปากหมาก', '8406', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840701', 'ท่าชนะ', '8407', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840702', 'สมอทอง', '8407', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840703', 'ประสงค์', '8407', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840704', 'คันธุลี', '8407', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840705', 'วัง', '8407', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840706', 'คลองพา', '8407', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840801', 'ท่าขนอน', '8408', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840802', 'บ้านยาง', '8408', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840803', 'น้ำหัก', '8408', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840806', 'กะเปา', '8408', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840807', 'ท่ากระดาน', '8408', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840808', 'ย่านยาว', '8408', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840809', 'ถ้ำสิงขร', '8408', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840810', 'บ้านทำเนียบ', '8408', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840901', 'เขาวง', '8409', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840902', 'พะแสง', '8409', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840903', 'พรุไทย', '8409', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('840904', 'เขาพัง', '8409', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841001', 'พนม', '8410', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841002', 'ต้นยวน', '8410', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841003', 'คลองศก', '8410', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841004', 'พลูเถื่อน', '8410', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841005', 'พังกาญจน์', '8410', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841006', 'คลองชะอุ่น', '8410', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841101', 'ท่าฉาง', '8411', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841102', 'ท่าเคย', '8411', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841103', 'คลองไทร', '8411', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841104', 'เขาถ่าน', '8411', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841105', 'เสวียด', '8411', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841106', 'ปากฉลุย', '8411', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841201', 'นาสาร', '8412', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841202', 'พรุพี', '8412', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841203', 'ทุ่งเตา', '8412', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841204', 'ลำพูน', '8412', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841205', 'ท่าชี', '8412', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841206', 'ควนศรี', '8412', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841207', 'ควนสุบรรณ', '8412', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841208', 'คลองปราบ', '8412', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841209', 'น้ำพุ', '8412', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841210', 'ทุ่งเตาใหม่', '8412', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841211', 'เพิ่มพูนทรัพย์', '8412', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841301', 'บ้านนา', '8413', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841302', 'ท่าเรือ', '8413', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841303', 'ทรัพย์ทวี', '8413', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841304', 'นาใต้', '8413', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841401', 'เคียนซา', '8414', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841402', 'พ่วงพรมคร', '8414', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841403', 'เขาตอก', '8414', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841404', 'อรัญคามวารี', '8414', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841405', 'บ้านเสด็จ', '8414', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841501', 'เวียงสระ', '8415', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841502', 'บ้านส้อง', '8415', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841503', 'คลองฉนวน', '8415', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841504', 'ทุ่งหลวง', '8415', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841505', 'เขานิพันธ์', '8415', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841601', 'อิปัน', '8416', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841602', 'สินปุน', '8416', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841603', 'บางสวรรค์', '8416', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841604', 'ไทรขึง', '8416', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841605', 'สินเจริญ', '8416', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841606', 'ไทรโสภา', '8416', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841607', 'สาคู', '8416', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841701', 'ท่าข้าม', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841702', 'ท่าสะท้อน', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841703', 'ลีเล็ด', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841704', 'บางมะเดื่อ', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841705', 'บางเดือน', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841706', 'ท่าโรงช้าง', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841707', 'กรูด', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841708', 'พุนพิน', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841709', 'บางงอน', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841710', 'ศรีวิชัย', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841711', 'น้ำรอบ', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841712', 'มะลวน', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841713', 'หัวเตย', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841714', 'หนองไทร', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841715', 'เขาหัวควาย', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841716', 'ตะปาน', '8417', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841801', 'สองแพรก', '8418', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841802', 'ชัยบุรี', '8418', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841803', 'คลองน้อย', '8418', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841804', 'ไทรทอง', '8418', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841901', 'ตะกุกใต้', '8419', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('841902', 'ตะกุกเหนือ', '8419', ' ', '84', ' ');
INSERT INTO `ref_tambol` VALUES ('850101', 'เขานิเวศน์', '8501', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850102', 'ราชกรูด', '8501', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850103', 'หงาว', '8501', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850104', 'บางริ้น', '8501', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850105', 'ปากน้ำ', '8501', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850106', 'บางนอน', '8501', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850107', 'หาดส้มแป้น', '8501', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850108', 'ทรายแดง', '8501', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850109', 'เกาะพยาม', '8501', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850201', 'ละอุ่นใต้', '8502', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850202', 'ละอุ่นเหนือ', '8502', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850203', 'บางพระใต้', '8502', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850204', 'บางพระเหนือ', '8502', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850205', 'บางแก้ว', '8502', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850206', 'ในวงเหนือ', '8502', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850207', 'ในวงใต้', '8502', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850301', 'ม่วงกลวง', '8503', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850302', 'กะเปอร์', '8503', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850303', 'เชี่ยวเหลียง', '8503', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850304', 'บ้านนา', '8503', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850305', 'บางหิน', '8503', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850401', 'น้ำจืด', '8504', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850402', 'น้ำจืดน้อย', '8504', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850403', 'มะมุ', '8504', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850404', 'ปากจั่น', '8504', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850405', 'ลำเลียง', '8504', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850406', 'จ.ป.ร.', '8504', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850407', 'บางใหญ่', '8504', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850501', 'นาคา', '8505', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('850502', 'กำพวน', '8505', ' ', '85', ' ');
INSERT INTO `ref_tambol` VALUES ('860101', 'ท่าตะเภา', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860102', 'ปากน้ำ', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860103', 'ท่ายาง', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860104', 'บางหมาก', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860105', 'นาทุ่ง', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860106', 'นาชะอัง', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860107', 'ตากแดด', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860108', 'บางลึก', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860109', 'หาดพันไกร', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860110', 'วังไผ่', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860111', 'วังใหม่', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860112', 'บ้านนา', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860113', 'ขุนกระทิง', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860114', 'ทุ่งคา', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860115', 'วิสัยเหนือ', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860116', 'หาดทรายรี', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860117', 'ถ้ำสิงห์', '8601', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860201', 'ท่าแซะ', '8602', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860202', 'คุริง', '8602', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860203', 'สลุย', '8602', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860204', 'นากระตาม', '8602', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860205', 'รับร่อ', '8602', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860206', 'ท่าข้าม', '8602', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860207', 'หงษ์เจริญ', '8602', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860208', 'หินแก้ว', '8602', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860209', 'ทรัพย์อนันต์', '8602', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860210', 'สองพี่น้อง', '8602', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860301', 'บางสน', '8603', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860302', 'ทะเลทรัพย์', '8603', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860303', 'สะพลี', '8603', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860304', 'ชุมโค', '8603', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860305', 'ดอนยาง', '8603', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860306', 'ปากคลอง', '8603', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860307', 'เขาไชยราช', '8603', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860401', 'หลังสวน', '8604', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860402', 'ขันเงิน', '8604', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860403', 'ท่ามะพลา', '8604', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860404', 'นาขา', '8604', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860405', 'นาพญา', '8604', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860406', 'บ้านควน', '8604', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860407', 'บางมะพร้าว', '8604', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860408', 'บางน้ำจืด', '8604', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860409', 'ปากน้ำ', '8604', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860410', 'พ้อแดง', '8604', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860411', 'แหลมทราย', '8604', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860412', 'วังตะกอ', '8604', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860413', 'หาดยาย', '8604', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860501', 'ละแม', '8605', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860502', 'ทุ่งหลวง', '8605', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860503', 'สวนแตง', '8605', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860504', 'ทุ่งคาวัด', '8605', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860601', 'พะโต๊ะ', '8606', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860602', 'ปากทรง', '8606', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860603', 'ปังหวาน', '8606', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860604', 'พระรักษ์', '8606', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860701', 'นาโพธิ์', '8607', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860702', 'สวี', '8607', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860703', 'ทุ่งระยะ', '8607', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860704', 'ท่าหิน', '8607', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860705', 'ปากแพรก', '8607', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860706', 'ด่านสวี', '8607', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860707', 'ครน', '8607', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860708', 'วิสัยใต้', '8607', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860709', 'นาสัก', '8607', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860710', 'เขาทะลุ', '8607', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860711', 'เขาค่าย', '8607', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860801', 'ปากตะโก', '8608', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860802', 'ทุ่งตะไคร', '8608', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860803', 'ตะโก', '8608', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('860804', 'ช่องไม้แก้ว', '8608', ' ', '86', ' ');
INSERT INTO `ref_tambol` VALUES ('900101', 'บ่อยาง', '9001', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900102', 'เขารูปช้าง', '9001', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900103', 'เกาะแต้ว', '9001', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900104', 'พะวง', '9001', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900105', 'ทุ่งหวัง', '9001', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900106', 'เกาะยอ', '9001', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900201', 'จะทิ้งพระ', '9002', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900202', 'กระดังงา', '9002', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900203', 'สนามชัย', '9002', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900204', 'ดีหลวง', '9002', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900205', 'ชุมพล', '9002', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900206', 'คลองรี', '9002', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900207', 'คูขุด', '9002', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900208', 'ท่าหิน', '9002', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900209', 'วัดจันทร์', '9002', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900210', 'บ่อแดง', '9002', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900211', 'บ่อดาน', '9002', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900301', 'บ้านนา', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900302', 'ป่าชิง', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900303', 'สะพานไม้แก่น', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900304', 'สะกอม', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900305', 'นาหว้า', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900306', 'นาทับ', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900307', 'น้ำขาว', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900308', 'ขุนตัดหวาย', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900309', 'ท่าหมอไทร', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900310', 'จะโหนง', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900311', 'คู', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900312', 'แค', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900313', 'คลองเปียะ', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900314', 'ตลิ่งชัน', '9003', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900401', 'นาทวี', '9004', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900402', 'ฉาง', '9004', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900403', 'นาหมอศรี', '9004', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900404', 'คลองทราย', '9004', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900405', 'ปลักหนู', '9004', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900406', 'ท่าประดู่', '9004', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900407', 'สะท้อน', '9004', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900408', 'ทับช้าง', '9004', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900409', 'ประกอบ', '9004', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900410', 'คลองกวาง', '9004', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900501', 'เทพา', '9005', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900502', 'ปากบาง', '9005', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900503', 'เกาะสะบ้า', '9005', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900504', 'ลำไพล', '9005', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900505', 'ท่าม่วง', '9005', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900506', 'วังใหญ่', '9005', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900507', 'สะกอม', '9005', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900601', 'สะบ้าย้อย', '9006', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900602', 'ทุ่งพอ', '9006', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900603', 'เปียน', '9006', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900604', 'บ้านโหนด', '9006', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900605', 'จะแหน', '9006', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900606', 'คูหา', '9006', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900607', 'เขาแดง', '9006', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900608', 'บาโหย', '9006', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900609', 'ธารคีรี', '9006', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900701', 'ระโนด', '9007', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900702', 'คลองแดน', '9007', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900703', 'ตะเครียะ', '9007', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900704', 'ท่าบอน', '9007', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900705', 'บ้านใหม่', '9007', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900706', 'บ่อตรุ', '9007', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900707', 'ปากแตระ', '9007', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900708', 'พังยาง', '9007', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900709', 'ระวะ', '9007', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900710', 'วัดสน', '9007', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900711', 'บ้านขาว', '9007', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900712', 'แดนสงวน', '9007', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900801', 'เกาะใหญ่', '9008', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900802', 'โรง', '9008', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900803', 'เชิงแส', '9008', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900804', 'กระแสสินธุ์', '9008', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900901', 'กำแพงเพชร', '9009', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900902', 'ท่าชะมวง', '9009', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900903', 'คูหาใต้', '9009', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900904', 'ควนรู', '9009', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('900909', 'เขาพระ', '9009', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901001', 'สะเดา', '9010', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901002', 'ปริก', '9010', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901003', 'พังลา', '9010', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901004', 'สำนักแต้ว', '9010', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901005', 'ทุ่งหมอ', '9010', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901006', 'ท่าโพธิ์', '9010', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901007', 'ปาดังเบซาร์', '9010', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901008', 'สำนักขาม', '9010', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901009', 'เขามีเกียรติ', '9010', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901101', 'หาดใหญ่', '9011', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901102', 'ควนลัง', '9011', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901103', 'คูเต่า', '9011', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901104', 'คอหงส์', '9011', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901105', 'คลองแห', '9011', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901107', 'คลองอู่ตะเภา', '9011', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901108', 'ฉลุง', '9011', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901111', 'ทุ่งใหญ่', '9011', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901112', 'ทุ่งตำเสา', '9011', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901113', 'ท่าข้าม', '9011', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901114', 'น้ำน้อย', '9011', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901116', 'บ้านพรุ', '9011', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901118', 'พะตง', '9011', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901201', 'นาหม่อม', '9012', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901202', 'พิจิตร', '9012', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901203', 'ทุ่งขมิ้น', '9012', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901204', 'คลองหรัง', '9012', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901301', 'รัตภูมิ', '9013', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901302', 'ควนโส', '9013', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901303', 'ห้วยลึก', '9013', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901304', 'บางเหรียง', '9013', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901401', 'บางกล่ำ', '9014', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901402', 'ท่าช้าง', '9014', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901403', 'แม่ทอม', '9014', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901404', 'บ้านหาร', '9014', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901501', 'ชิงโค', '9015', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901502', 'สทิงหม้อ', '9015', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901503', 'ทำนบ', '9015', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901504', 'รำแดง', '9015', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901505', 'วัดขนุน', '9015', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901506', 'ชะแล้', '9015', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901507', 'ปากรอ', '9015', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901508', 'ป่าขาด', '9015', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901509', 'หัวเขา', '9015', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901510', 'บางเขียด', '9015', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901511', 'ม่วงงาม', '9015', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901601', 'คลองหอยโข่ง', '9016', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901602', 'ทุ่งลาน', '9016', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901603', 'โคกม่วง', '9016', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('901604', 'คลองหลา', '9016', ' ', '90', ' ');
INSERT INTO `ref_tambol` VALUES ('910101', 'พิมาน', '9101', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910102', 'คลองขุด', '9101', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910103', 'ควนขัน', '9101', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910104', 'บ้านควน', '9101', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910105', 'ฉลุง', '9101', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910106', 'เกาะสาหร่าย', '9101', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910107', 'ตันหยงโป', '9101', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910108', 'เจ๊ะบิลัง', '9101', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910109', 'ตำมะลัง', '9101', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910110', 'ปูยู', '9101', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910111', 'ควนโพธิ์', '9101', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910112', 'เกตรี', '9101', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910201', 'ควนโดน', '9102', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910202', 'ควนสตอ', '9102', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910203', 'ย่านซื่อ', '9102', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910204', 'วังประจัน', '9102', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910301', 'ทุ่งนุ้ย', '9103', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910302', 'ควนกาหลง', '9103', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910303', 'อุใดเจริญ', '9103', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910401', 'ท่าแพ', '9104', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910402', 'แป-ระ', '9104', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910403', 'สาคร', '9104', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910404', 'ท่าเรือ', '9104', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910501', 'กำแพง', '9105', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910502', 'ละงู', '9105', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910503', 'เขาขาว', '9105', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910504', 'ปากน้ำ', '9105', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910505', 'น้ำผุด', '9105', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910506', 'แหลมสน', '9105', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910601', 'ทุ่งหว้า', '9106', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910602', 'นาทอน', '9106', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910603', 'ขอนคลาน', '9106', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910604', 'ทุ่งบุหลัง', '9106', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910605', 'ป่าแก่บ่อหิน', '9106', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910701', 'ปาล์มพัฒนา', '9107', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('910702', 'นิคมพัฒนา', '9107', ' ', '91', ' ');
INSERT INTO `ref_tambol` VALUES ('920101', 'ทับเที่ยง', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920104', 'นาพละ', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920105', 'บ้านควน', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920106', 'นาบินหลา', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920107', 'ควนปริง', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920108', 'นาโยงใต้', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920109', 'บางรัก', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920110', 'โคกหล่อ', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920113', 'นาโต๊ะหมิง', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920114', 'หนองตรุด', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920115', 'น้ำผุด', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920117', 'นาตาล่วง', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920118', 'บ้านโพธิ์', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920119', 'นาท่ามเหนือ', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920120', 'นาท่ามใต้', '9201', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920201', 'กันตัง', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920202', 'ควนธานี', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920203', 'บางหมาก', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920204', 'บางเป้า', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920205', 'วังวน', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920206', 'กันตังใต้', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920207', 'โคกยาง', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920208', 'คลองลุ', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920209', 'ย่านซื่อ', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920210', 'บ่อน้ำร้อน', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920211', 'บางสัก', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920212', 'นาเกลือ', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920213', 'เกาะลิบง', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920214', 'คลองชีล้อม', '9202', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920301', 'ย่านตาขาว', '9203', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920302', 'หนองบ่อ', '9203', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920303', 'นาชุมเห็ด', '9203', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920304', 'ในควน', '9203', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920305', 'โพรงจรเข้', '9203', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920306', 'ทุ่งกระบือ', '9203', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920307', 'ทุ่งค่าย', '9203', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920308', 'เกาะเปียะ', '9203', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920401', 'ท่าข้าม', '9204', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920402', 'ทุ่งยาว', '9204', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920403', 'ปะเหลียน', '9204', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920404', 'บางด้วน', '9204', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920407', 'บ้านนา', '9204', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920409', 'สุโสะ', '9204', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920410', 'ลิพัง', '9204', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920411', 'เกาะสุกร', '9204', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920412', 'ท่าพญา', '9204', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920413', 'แหลมสอม', '9204', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920501', 'บ่อหิน', '9205', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920502', 'เขาไม้แก้ว', '9205', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920503', 'กะลาเส', '9205', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920504', 'ไม้ฝาด', '9205', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920505', 'นาเมืองเพชร', '9205', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920601', 'ห้วยยอด', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920602', 'หนองช้างแล่น', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920605', 'บางดี', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920606', 'บางกุ้ง', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920607', 'เขากอบ', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920608', 'เขาขาว', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920609', 'เขาปูน', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920610', 'ปากแจ่ม', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920611', 'ปากคม', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920614', 'ท่างิ้ว', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920615', 'ลำภูรา', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920616', 'นาวง', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920617', 'ห้วยนาง', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920619', 'ในเตา', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920620', 'ทุ่งต่อ', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920621', 'วังคีรี', '9206', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920701', 'เขาวิเศษ', '9207', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920702', 'วังมะปราง', '9207', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920703', 'อ่าวตง', '9207', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920704', 'ท่าสะบ้า', '9207', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920705', 'วังมะปรางเหนือ', '9207', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920801', 'นาโยงเหนือ', '9208', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920802', 'ช่อง', '9208', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920803', 'ละมอ', '9208', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920804', 'โคกสะบ้า', '9208', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920805', 'นาหมื่นศรี', '9208', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920806', 'นาข้าวเสีย', '9208', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920901', 'ควนเมา', '9209', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920902', 'คลองปาง', '9209', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920903', 'หนองบัว', '9209', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920904', 'หนองปรือ', '9209', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('920905', 'เขาไพร', '9209', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('921001', 'หาดสำราญ', '9210', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('921002', 'บ้าหวี', '9210', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('921003', 'ตะเสะ', '9210', ' ', '92', ' ');
INSERT INTO `ref_tambol` VALUES ('930101', 'คูหาสวรรค์', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930103', 'เขาเจียก', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930104', 'ท่ามิหรำ', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930105', 'โคกชะงาย', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930106', 'นาท่อม', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930107', 'ปรางหมู่', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930108', 'ท่าแค', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930109', 'ลำปำ', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930110', 'ตำนาน', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930111', 'ควนมะพร้าว', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930112', 'ร่มเมือง', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930113', 'ชัยบุรี', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930114', 'นาโหนด', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930115', 'พญาขัน', '9301', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930201', 'กงหรา', '9302', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930202', 'ชะรัด', '9302', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930203', 'คลองเฉลิม', '9302', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930204', 'คลองทรายขาว', '9302', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930205', 'สมหวัง', '9302', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930301', 'เขาชัยสน', '9303', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930302', 'ควนขนุน', '9303', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930305', 'จองถนน', '9303', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930306', 'หานโพธิ์', '9303', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930307', 'โคกม่วง', '9303', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930401', 'แม่ขรี', '9304', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930402', 'ตะโหมด', '9304', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930403', 'คลองใหญ่', '9304', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930501', 'ควนขนุน', '9305', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930502', 'ทะเลน้อย', '9305', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930504', 'นาขยาด', '9305', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930505', 'พนมวังก์', '9305', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930506', 'แหลมโตนด', '9305', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930508', 'ปันแต', '9305', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930509', 'โตนดด้วน', '9305', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930510', 'ดอนทราย', '9305', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930511', 'มะกอกเหนือ', '9305', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930512', 'พนางตุง', '9305', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930513', 'ชะมวง', '9305', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930516', 'แพรกหา', '9305', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930601', 'ปากพะยูน', '9306', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930602', 'ดอนประดู่', '9306', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930603', 'เกาะนางคำ', '9306', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930604', 'เกาะหมาก', '9306', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930605', 'ฝาละมี', '9306', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930606', 'หารเทา', '9306', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930607', 'ดอนทราย', '9306', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930701', 'เขาย่า', '9307', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930702', 'เขาปู่', '9307', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930703', 'ตะแพน', '9307', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930801', 'ป่าบอน', '9308', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930802', 'โคกทราย', '9308', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930803', 'หนองธง', '9308', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930804', 'ทุ่งนารี', '9308', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930806', 'วังใหม่', '9308', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930901', 'ท่ามะเดื่อ', '9309', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930902', 'นาปะขอ', '9309', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('930903', 'โคกสัก', '9309', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('931001', 'ป่าพะยอม', '9310', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('931002', 'ลานข่อย', '9310', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('931003', 'เกาะเต่า', '9310', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('931004', 'บ้านพร้าว', '9310', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('931101', 'ชุมพล', '9311', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('931102', 'บ้านนา', '9311', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('931103', 'อ่างทอง', '9311', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('931104', 'ลำสินธุ์', '9311', ' ', '93', ' ');
INSERT INTO `ref_tambol` VALUES ('940101', 'สะบารัง', '9401', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940102', 'อาเนาะรู', '9401', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940103', 'จะบังติกอ', '9401', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940104', 'บานา', '9401', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940105', 'ตันหยงลุโละ', '9401', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940106', 'คลองมานิง', '9401', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940107', 'กะมิยอ', '9401', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940108', 'บาราโหม', '9401', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940109', 'ปะกาฮะรัง', '9401', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940110', 'รูสะมิแล', '9401', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940111', 'ตะลุโบะ', '9401', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940112', 'บาราเฮาะ', '9401', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940113', 'ปุยุด', '9401', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940201', 'โคกโพธิ์', '9402', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940202', 'มะกรูด', '9402', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940203', 'บางโกระ', '9402', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940204', 'ป่าบอน', '9402', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940205', 'ทรายขาว', '9402', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940206', 'นาประดู่', '9402', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940207', 'ปากล่อ', '9402', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940208', 'ทุ่งพลา', '9402', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940211', 'ท่าเรือ', '9402', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940213', 'นาเกตุ', '9402', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940214', 'ควนโนรี', '9402', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940215', 'ช้างให้ตก', '9402', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940301', 'เกาะเปาะ', '9403', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940302', 'คอลอตันหยง', '9403', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940303', 'ดอนรัก', '9403', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940304', 'ดาโต๊ะ', '9403', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940305', 'ตุยง', '9403', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940306', 'ท่ากำชำ', '9403', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940307', 'บ่อทอง', '9403', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940308', 'บางเขา', '9403', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940309', 'บางตาวา', '9403', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940310', 'ปุโละปุโย', '9403', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940311', 'ยาบี', '9403', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940312', 'ลิปะสะโง', '9403', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940401', 'ปะนาเระ', '9404', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940402', 'ท่าข้าม', '9404', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940403', 'บ้านนอก', '9404', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940404', 'ดอน', '9404', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940405', 'ควน', '9404', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940406', 'ท่าน้ำ', '9404', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940407', 'คอกกระบือ', '9404', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940408', 'พ่อมิ่ง', '9404', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940409', 'บ้านกลาง', '9404', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940410', 'บ้านน้ำบ่อ', '9404', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940501', 'มายอ', '9405', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940502', 'ถนน', '9405', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940503', 'ตรัง', '9405', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940504', 'กระหวะ', '9405', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940505', 'ลุโบะยิไร', '9405', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940506', 'ลางา', '9405', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940507', 'กระเสาะ', '9405', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940508', 'เกาะจัน', '9405', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940509', 'ปะโด', '9405', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940510', 'สาคอบน', '9405', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940511', 'สาคอใต้', '9405', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940512', 'สะกำ', '9405', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940513', 'ปานัน', '9405', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940601', 'ตะโละแมะนา', '9406', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940602', 'พิเทน', '9406', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940603', 'น้ำดำ', '9406', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940604', 'ปากู', '9406', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940701', 'ตะลุบัน', '9407', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940702', 'ตะบิ้ง', '9407', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940703', 'ปะเสยะวอ', '9407', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940704', 'บางเก่า', '9407', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940705', 'บือเระ', '9407', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940706', 'เตราะบอน', '9407', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940707', 'กะดุนง', '9407', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940708', 'ละหาร', '9407', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940709', 'มะนังดาลำ', '9407', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940710', 'แป้น', '9407', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940711', 'ทุ่งคล้า', '9407', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940801', 'ไทรทอง', '9408', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940802', 'ไม้แก่น', '9408', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940803', 'ตะโละไกรทอง', '9408', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940804', 'ดอนทราย', '9408', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940901', 'ตะโละ', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940902', 'ตะโละกาโปร์', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940903', 'ตันหยงดาลอ', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940904', 'ตันหยงจึงงา', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940905', 'ตอหลัง', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940906', 'ตาแกะ', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940907', 'ตาลีอายร์', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940908', 'ยามู', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940909', 'บางปู', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940910', 'หนองแรต', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940911', 'ปิยามุมัง', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940912', 'ปุลากง', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940913', 'บาโลย', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940914', 'สาบัน', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940915', 'มะนังยง', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940916', 'ราตาปันยัง', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940917', 'จะรัง', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('940918', 'แหลมโพธิ์', '9409', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941001', 'ยะรัง', '9410', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941002', 'สะดาวา', '9410', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941003', 'ประจัน', '9410', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941004', 'สะนอ', '9410', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941005', 'ระแว้ง', '9410', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941006', 'ปิตูมุดี', '9410', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941007', 'วัด', '9410', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941008', 'กระโด', '9410', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941009', 'คลองใหม่', '9410', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941010', 'เมาะมาวี', '9410', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941011', 'กอลำ', '9410', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941012', 'เขาตูม', '9410', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941101', 'กะรุบี', '9411', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941102', 'ตะโละดือรามัน', '9411', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941103', 'ปล่องหอย', '9411', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941201', 'แม่ลาน', '9412', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941202', 'ม่วงเตี้ย', '9412', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('941203', 'ป่าไร่', '9412', ' ', '94', ' ');
INSERT INTO `ref_tambol` VALUES ('950101', 'สะเตง', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950102', 'บุดี', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950103', 'ยุโป', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950104', 'ลิดล', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950106', 'ยะลา', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950108', 'ท่าสาป', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950109', 'ลำใหม่', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950110', 'หน้าถ้ำ', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950111', 'ลำพะยา', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950112', 'เปาะเส้ง', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950114', 'พร่อน', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950115', 'บันนังสาเรง', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950116', 'สะเตงนอก', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950118', 'ตาเซะ', '9501', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950201', 'เบตง', '9502', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950202', 'ยะรม', '9502', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950203', 'ตาเนาะแมเราะ', '9502', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950204', 'อัยเยอร์เวง', '9502', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950205', 'ธารน้ำทิพย์', '9502', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950301', 'บันนังสตา', '9503', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950302', 'บาเจาะ', '9503', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950303', 'ตาเนาะปูเต๊ะ', '9503', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950304', 'ถ้ำทะลุ', '9503', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950305', 'ตลิ่งชัน', '9503', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950306', 'เขื่อนบางลาง', '9503', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950401', 'ธารโต', '9504', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950402', 'บ้านแหร', '9504', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950403', 'แม่หวาด', '9504', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950404', 'คีรีเขต', '9504', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950501', 'ยะหา', '9505', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950502', 'ละแอ', '9505', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950503', 'ปะแต', '9505', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950504', 'บาโร๊ะ', '9505', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950506', 'ตาชี', '9505', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950507', 'บาโงยซิแน', '9505', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950508', 'กาตอง', '9505', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950601', 'กายูบอเกาะ', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950602', 'กาลูปัง', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950603', 'กาลอ', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950604', 'กอตอตือร๊ะ', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950605', 'โกตาบารู', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950606', 'เกะรอ', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950607', 'จะกว๊ะ', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950608', 'ท่าธง', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950609', 'เนินงาม', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950610', 'บาลอ', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950611', 'บาโงย', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950612', 'บือมัง', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950613', 'ยะต๊ะ', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950614', 'วังพญา', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950615', 'อาซ่อง', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950616', 'ตะโล๊ะหะลอ', '9506', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950701', 'กาบัง', '9507', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950702', 'บาละ', '9507', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950801', 'กรงปินัง', '9508', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950802', 'สะเอะ', '9508', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950803', 'ห้วยกระทิง', '9508', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('950804', 'ปุโรง', '9508', ' ', '95', ' ');
INSERT INTO `ref_tambol` VALUES ('960101', 'บางนาค', '9601', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960102', 'ลำภู', '9601', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960103', 'มะนังตายอ', '9601', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960104', 'บางปอ', '9601', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960105', 'กะลุวอ', '9601', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960106', 'กะลุวอเหนือ', '9601', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960107', 'โคกเคียน', '9601', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960201', 'เจ๊ะเห', '9602', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960202', 'ไพรวัน', '9602', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960203', 'พร่อน', '9602', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960204', 'ศาลาใหม่', '9602', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960205', 'บางขุนทอง', '9602', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960206', 'เกาะสะท้อน', '9602', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960207', 'นานาค', '9602', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960208', 'โฆษิต', '9602', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960301', 'บาเจาะ', '9603', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960302', 'ลุโบะสาวอ', '9603', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960303', 'กาเยาะมาตี', '9603', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960304', 'ปะลุกาสาเมาะ', '9603', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960305', 'บาเระเหนือ', '9603', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960306', 'บาเระใต้', '9603', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960401', 'ยี่งอ', '9604', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960402', 'ละหาร', '9604', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960403', 'จอเบาะ', '9604', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960404', 'ลุโบะบายะ', '9604', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960405', 'ลุโบะบือซา', '9604', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960406', 'ตะปอเยาะ', '9604', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960501', 'ตันหยงมัส', '9605', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960502', 'ตันหยงลิมอ', '9605', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960506', 'บองอ', '9605', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960507', 'กาลิซา', '9605', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960508', 'บาโงสะโต', '9605', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960509', 'เฉลิม', '9605', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960510', 'มะรือโบตะวันตก', '9605', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960601', 'รือเสาะ', '9606', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960602', 'สาวอ', '9606', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960603', 'เรียง', '9606', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960604', 'สามัคคี', '9606', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960605', 'บาตง', '9606', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960606', 'ลาโละ', '9606', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960607', 'รือเสาะออก', '9606', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960608', 'โคกสะตอ', '9606', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960609', 'สุวารี', '9606', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960701', 'ซากอ', '9607', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960702', 'ตะมะยูง', '9607', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960703', 'ศรีสาคร', '9607', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960704', 'เชิงคีรี', '9607', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960705', 'กาหลง', '9607', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960706', 'ศรีบรรพต', '9607', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960801', 'แว้ง', '9608', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960802', 'กายูคละ', '9608', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960803', 'ฆอเลาะ', '9608', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960804', 'โละจูด', '9608', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960805', 'แม่ดง', '9608', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960806', 'เอราวัณ', '9608', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960901', 'มาโมง', '9609', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960902', 'สุคิริน', '9609', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960903', 'เกียร์', '9609', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960904', 'ภูเขาทอง', '9609', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('960905', 'ร่มไทร', '9609', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961001', 'สุไหงโก-ลก', '9610', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961002', 'ปาเสมัส', '9610', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961003', 'มูโนะ', '9610', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961004', 'ปูโยะ', '9610', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961101', 'ปะลุรู', '9611', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961102', 'สุไหงปาดี', '9611', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961103', 'โต๊ะเด็ง', '9611', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961104', 'สากอ', '9611', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961105', 'ริโก๋', '9611', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961106', 'กาวะ', '9611', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961201', 'จะแนะ', '9612', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961202', 'ดุซงญอ', '9612', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961203', 'ผดุงมาตร', '9612', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961204', 'ช้างเผือก', '9612', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961301', 'จวบ', '9613', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961302', 'บูกิต', '9613', ' ', '96', ' ');
INSERT INTO `ref_tambol` VALUES ('961303', 'มะรือโบออก', '9613', ' ', '96', ' ');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_timecheck`
-- 

DROP TABLE IF EXISTS `ref_timecheck`;
CREATE TABLE IF NOT EXISTS `ref_timecheck` (
  `CHECK_ID` varchar(50) character set utf8 NOT NULL COMMENT 'รหัสเวลาเข้าเช็คชื่อ',
  `CHECK_DESCRIPTION` varchar(50) character set utf8 default NULL COMMENT 'คำอธิบาย',
  `CHECK_POINTMINUS` int(10) default NULL COMMENT 'ระดับการหักคะแนนความประพฤติ',
  PRIMARY KEY  (`CHECK_ID`),
  KEY `TIMEID` (`CHECK_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- 
-- dump ตาราง `ref_timecheck`
-- 

INSERT INTO `ref_timecheck` VALUES ('00', 'มาปกติ', 0);
INSERT INTO `ref_timecheck` VALUES ('01', 'กิจกรรม', 0);
INSERT INTO `ref_timecheck` VALUES ('02', 'สาย', 0);
INSERT INTO `ref_timecheck` VALUES ('04', 'ขาด', 0);
INSERT INTO `ref_timecheck` VALUES ('03', 'ลา', 0);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `ref_travel`
-- 

DROP TABLE IF EXISTS `ref_travel`;
CREATE TABLE IF NOT EXISTS `ref_travel` (
  `travel_id` varchar(2) NOT NULL,
  `travel_description` varchar(255) NOT NULL,
  PRIMARY KEY  (`travel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `ref_travel`
-- 

INSERT INTO `ref_travel` VALUES ('01', 'เดิน');
INSERT INTO `ref_travel` VALUES ('02', 'รถจักรยาน');
INSERT INTO `ref_travel` VALUES ('03', 'รถจักรยานยนต์');
INSERT INTO `ref_travel` VALUES ('04', 'รถประจำทาง');
INSERT INTO `ref_travel` VALUES ('05', 'ผู้ปกครองมาส่ง');
INSERT INTO `ref_travel` VALUES ('06', 'รถรับส่งนักเรียน');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `rooms`
-- 

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` varchar(3) NOT NULL,
  `teacher_id` varchar(3) NOT NULL,
  `teacher_id2` varchar(3) NOT NULL default '704',
  `student_id` varchar(10) default NULL,
  `acadsemester` int(11) NOT NULL,
  `acadyear` int(11) NOT NULL,
  PRIMARY KEY  (`room_id`,`acadsemester`,`acadyear`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `rooms`
-- 

INSERT INTO `rooms` VALUES ('101', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('102', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('103', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('104', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('105', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('106', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('201', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('202', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('203', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('204', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('205', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('206', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('301', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('302', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('303', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('304', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('305', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('306', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('307', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('401', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('402', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('403', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('404', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('405', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('501', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('502', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('503', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('504', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('505', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('601', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('602', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('603', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('604', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('605', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('606', '000', '000', '', 2, 2557);
INSERT INTO `rooms` VALUES ('607', '000', '000', '', 2, 2557);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `sdq_parent`
-- 

DROP TABLE IF EXISTS `sdq_parent`;
CREATE TABLE IF NOT EXISTS `sdq_parent` (
  `student_id` varchar(5) NOT NULL,
  `c01` int(11) default NULL,
  `c02` int(11) default NULL,
  `c03` int(11) default NULL,
  `c04` int(11) default NULL,
  `c05` int(11) default NULL,
  `c06` int(11) default NULL,
  `c07` int(11) default NULL,
  `c08` int(11) default NULL,
  `c09` int(11) default NULL,
  `c10` int(11) default NULL,
  `c11` int(11) default NULL,
  `c12` int(11) default NULL,
  `c13` int(11) default NULL,
  `c14` int(11) default NULL,
  `c15` int(11) default NULL,
  `c16` int(11) default NULL,
  `c17` int(11) default NULL,
  `c18` int(11) default NULL,
  `c19` int(11) default NULL,
  `c20` int(11) default NULL,
  `c21` int(11) default NULL,
  `c22` int(11) default NULL,
  `c23` int(11) default NULL,
  `c24` int(11) default NULL,
  `c25` int(11) default NULL,
  `semester` int(11) NOT NULL,
  `acadyear` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `finish_date` date default NULL,
  PRIMARY KEY  (`student_id`,`semester`,`acadyear`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ตารางประเมิน SDQ นักเรียนสำหรับผู้ปกครอง';

-- 
-- dump ตาราง `sdq_parent`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `sdq_result`
-- 

DROP TABLE IF EXISTS `sdq_result`;
CREATE TABLE IF NOT EXISTS `sdq_result` (
  `student_id` varchar(5) NOT NULL,
  `type1` int(11) NOT NULL,
  `type2` int(11) NOT NULL,
  `type3` int(11) NOT NULL,
  `type4` int(11) NOT NULL,
  `type5` int(11) NOT NULL,
  `more_detail` text NOT NULL,
  `all` int(11) NOT NULL,
  `acadyear` varchar(4) NOT NULL,
  `acadsemester` varchar(1) NOT NULL,
  `questioner` varchar(255) NOT NULL,
  PRIMARY KEY  (`student_id`,`acadyear`,`acadsemester`,`questioner`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `sdq_result`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `sdq_student`
-- 

DROP TABLE IF EXISTS `sdq_student`;
CREATE TABLE IF NOT EXISTS `sdq_student` (
  `student_id` varchar(5) NOT NULL,
  `c01` int(11) default NULL,
  `c02` int(11) default NULL,
  `c03` int(11) default NULL,
  `c04` int(11) default NULL,
  `c05` int(11) default NULL,
  `c06` int(11) default NULL,
  `c07` int(11) default NULL,
  `c08` int(11) default NULL,
  `c09` int(11) default NULL,
  `c10` int(11) default NULL,
  `c11` int(11) default NULL,
  `c12` int(11) default NULL,
  `c13` int(11) default NULL,
  `c14` int(11) default NULL,
  `c15` int(11) default NULL,
  `c16` int(11) default NULL,
  `c17` int(11) default NULL,
  `c18` int(11) default NULL,
  `c19` int(11) default NULL,
  `c20` int(11) default NULL,
  `c21` int(11) default NULL,
  `c22` int(11) default NULL,
  `c23` int(11) default NULL,
  `c24` int(11) default NULL,
  `c25` int(11) default NULL,
  `semester` int(11) NOT NULL,
  `acadyear` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `finish_date` date default NULL,
  PRIMARY KEY  (`student_id`,`semester`,`acadyear`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ตารางประเมิน SDQ นักเรียน';

-- 
-- dump ตาราง `sdq_student`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `sdq_teacher`
-- 

DROP TABLE IF EXISTS `sdq_teacher`;
CREATE TABLE IF NOT EXISTS `sdq_teacher` (
  `student_id` varchar(5) NOT NULL,
  `teacher_id` varchar(3) NOT NULL,
  `c01` int(11) default NULL,
  `c02` int(11) default NULL,
  `c03` int(11) default NULL,
  `c04` int(11) default NULL,
  `c05` int(11) default NULL,
  `c06` int(11) default NULL,
  `c07` int(11) default NULL,
  `c08` int(11) default NULL,
  `c09` int(11) default NULL,
  `c10` int(11) default NULL,
  `c11` int(11) default NULL,
  `c12` int(11) default NULL,
  `c13` int(11) default NULL,
  `c14` int(11) default NULL,
  `c15` int(11) default NULL,
  `c16` int(11) default NULL,
  `c17` int(11) default NULL,
  `c18` int(11) default NULL,
  `c19` int(11) default NULL,
  `c20` int(11) default NULL,
  `c21` int(11) default NULL,
  `c22` int(11) default NULL,
  `c23` int(11) default NULL,
  `c24` int(11) default NULL,
  `c25` int(11) default NULL,
  `semester` int(11) NOT NULL,
  `acadyear` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `finish_date` date default NULL,
  PRIMARY KEY  (`student_id`,`semester`,`acadyear`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ตารางประเมิน SDQ นักเรียนสำหรับครูที่ปรึกษา';

-- 
-- dump ตาราง `sdq_teacher`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `students`
-- 

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `ID` varchar(5) NOT NULL default '',
  `PREFIX` varchar(20) default NULL,
  `FIRSTNAME` varchar(30) default NULL,
  `LASTNAME` varchar(30) default NULL,
  `SCH_ID` varchar(8) default NULL,
  `xLevel` varchar(1) NOT NULL default '',
  `xYearth` varchar(1) NOT NULL default '',
  `xEDBE` varchar(4) NOT NULL default '',
  `ExEDBE` varchar(4) default NULL,
  `EnglishNAME` varchar(60) default NULL,
  `NICKNAME` varchar(30) default NULL,
  `SEX` varchar(1) default NULL,
  `PROGRAM` varchar(30) default NULL,
  `ROOM` smallint(5) default NULL,
  `ORDINAL` smallint(5) default NULL,
  `pin` varchar(13) default NULL,
  `BIRTHDAY` varchar(10) default NULL,
  `Race` smallint(5) default NULL,
  `Nationality` smallint(5) default NULL,
  `RELIGION` varchar(1) default NULL,
  `TALENT` text,
  `ENT_YEAR` varchar(10) default NULL,
  `ENT_DATE` varchar(10) default NULL,
  `SCH_NAME` varchar(50) default NULL,
  `SCH_PROVINCE` varchar(25) default NULL,
  `SCH_LEVEL` varchar(30) default NULL,
  `SCH_CAUSE` varchar(50) default NULL,
  `SCH_Unit` float(24,2) default NULL,
  `SCH_Pass` float(24,2) default NULL,
  `SCH_GPA` float(24,2) default NULL,
  `SUBJECT_LIKE` varchar(20) default NULL,
  `SUBJECT_HATE` varchar(20) default NULL,
  `F_NAME` varchar(50) default NULL,
  `M_NAME` varchar(50) default NULL,
  `A_NAME` varchar(50) default NULL,
  `p_village` varchar(30) default NULL,
  `P_HOME` varchar(30) default NULL,
  `P_NO` varchar(15) default NULL,
  `P_GROUP` varchar(6) default NULL,
  `P_SOI` varchar(30) default NULL,
  `P_STREET` varchar(30) default NULL,
  `P_TUMBOL` varchar(30) default NULL,
  `P_AMPHUR` varchar(30) default NULL,
  `P_PROVINCE` varchar(25) default NULL,
  `P_ZIP` varchar(5) default NULL,
  `P_PHONE` varchar(30) default NULL,
  `mobile` varchar(30) default NULL,
  `fax` varchar(30) default NULL,
  `e_mail` varchar(30) default NULL,
  `blood_group` varchar(10) default NULL,
  `WEIGHT` float(24,2) default NULL,
  `HEIGHT` float(24,2) default NULL,
  `BMI` float(24,2) default NULL,
  `CRIPPLE` smallint(5) default NULL,
  `BTAMBOL` varchar(30) default NULL,
  `BAMPHUR` varchar(30) default NULL,
  `BPROVINCE` varchar(25) default NULL,
  `BHOSPITAL` varchar(30) default NULL,
  `F_EARN` float(24,2) default NULL,
  `F_Occupation` smallint(5) default NULL,
  `F_Mobile` varchar(30) default NULL,
  `M_EARN` float(24,2) default NULL,
  `M_Occupation` smallint(5) default NULL,
  `M_Mobile` varchar(30) default NULL,
  `All_EARN` float(24,2) default NULL,
  `FM_Status` varchar(1) default NULL,
  `A_EARN` float(24,2) default NULL,
  `A_Occupation` smallint(5) default NULL,
  `A_Mobile` varchar(30) default NULL,
  `A_Relation` smallint(5) default NULL,
  `GPA` float(24,2) default NULL,
  `PR` float(24,2) default NULL,
  `advisor11` varchar(3) default NULL,
  `advisor12` varchar(3) default NULL,
  `advisor21` varchar(3) default NULL,
  `advisor22` varchar(3) default NULL,
  `advisor31` varchar(3) default NULL,
  `advisor32` varchar(3) default NULL,
  `TrustTeacher1` varchar(3) default NULL,
  `TrustTeacher2` varchar(3) default NULL,
  `TrustTeacher3` varchar(3) default NULL,
  `education_loan1` int(10) default NULL,
  `education_loan2` int(10) default NULL,
  `education_loan3` int(10) default NULL,
  `Scout` smallint(5) default NULL,
  `ISSUE` varchar(10) default NULL,
  `LEAVE` varchar(10) default NULL,
  `CAUSE` varchar(255) default NULL,
  `studnote` varchar(255) default NULL,
  `studstatus` varchar(1) default NULL,
  `EPREFIX` varchar(20) default NULL,
  `EFIRSTNAME` varchar(30) default NULL,
  `ELASTNAME` varchar(30) default NULL,
  `ENationality` varchar(25) default NULL,
  `ERELIGION` varchar(25) default NULL,
  `ESCH_NAME` varchar(50) default NULL,
  `ESCH_COUNTRY` varchar(30) default NULL,
  `ESCH_GRADE` varchar(30) default NULL,
  `EF_NAME` varchar(50) default NULL,
  `EM_NAME` varchar(50) default NULL,
  `EA_NAME` varchar(50) default NULL,
  `EP_ADDRESS1` varchar(50) default NULL,
  `EP_ADDRESS2` varchar(50) default NULL,
  `EP_PROVINCE` varchar(30) default NULL,
  `EP_COUNTRY` varchar(30) default NULL,
  `EPlaceOfBirth` varchar(50) default NULL,
  `ECountryOfBirth` varchar(30) default NULL,
  `ESTUDNOTE` text,
  `Start_Date` varchar(10) default NULL,
  `Expire_Date` varchar(10) default NULL,
  `InService` varchar(1) default NULL,
  `InTR_14` varchar(1) default NULL,
  `StudAbsent` int(10) default NULL,
  `retirecause` int(10) default NULL,
  `NextAcademic` int(10) default NULL,
  `NextRegion` int(10) default NULL,
  `StudJudge` int(10) default NULL,
  `F_Cripple` int(10) default NULL,
  `F_Status` varchar(10) default NULL,
  `M_Cripple` int(10) default NULL,
  `M_Status` varchar(10) default NULL,
  `travelby` varchar(2) NOT NULL default '01',
  `HowLong` int(10) default NULL,
  `Dental` varchar(10) default NULL,
  `Scholar_Status` varchar(10) default NULL,
  `ScholarName1` varchar(255) default NULL,
  `ScholarName2` varchar(255) default NULL,
  `ScholarName3` varchar(255) default NULL,
  `GPA1` float(24,2) default NULL,
  `GPA2` float(24,2) default NULL,
  `GPA3` float(24,2) default NULL,
  `Change_Date` varchar(50) default NULL,
  `OLD_FIRSTNAME` varchar(50) default NULL,
  `OLD_LASTNAME` varchar(50) default NULL,
  `F_PIN` varchar(13) default NULL,
  `M_PIN` varchar(13) default NULL,
  `A_PIN` varchar(13) default NULL,
  `UTM_Coordinate_X` varchar(20) default NULL,
  `UTM_Coordinate_Y` varchar(20) default NULL,
  `UTM_Zone` varchar(10) default '+7GMT',
  `Points` int(11) NOT NULL default '100',
  `Color` varchar(20) default NULL,
  PRIMARY KEY  (`ID`,`xLevel`,`xYearth`,`xEDBE`),
  KEY `pin` (`pin`),
  KEY `SCH_ID` (`SCH_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `students`
-- 


-- 
-- โครงสร้างตาราง `student_800`
-- 

DROP TABLE IF EXISTS `student_800`;
CREATE TABLE IF NOT EXISTS `student_800` (
  `row_id` varchar(20) NOT NULL,
  `student_id` varchar(5) NOT NULL,
  `class_id` varchar(3) NOT NULL,
  `timecheck_id` varchar(2) NOT NULL,
  `check_date` varchar(20) NOT NULL,
  `create_date` varchar(20) NOT NULL,
  `acadyear` int(11) NOT NULL,
  `acadsemester` int(11) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  PRIMARY KEY  (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `student_800`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_800_task`
-- 

DROP TABLE IF EXISTS `student_800_task`;
CREATE TABLE IF NOT EXISTS `student_800_task` (
  `task_id` int(11) NOT NULL auto_increment,
  `task_date` varchar(20) NOT NULL,
  `task_roomid` varchar(3) NOT NULL,
  `task_status` varchar(2) NOT NULL,
  `acadyear` int(11) NOT NULL,
  `acadsemester` int(11) NOT NULL,
  PRIMARY KEY  (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `student_800_task`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_color`
-- 

DROP TABLE IF EXISTS `student_color`;
CREATE TABLE IF NOT EXISTS `student_color` (
  `row_id` varchar(20) NOT NULL,
  `student_id` varchar(5) NOT NULL,
  `class_id` varchar(3) NOT NULL,
  `timecheck_id` varchar(2) NOT NULL,
  `color` varchar(20) NOT NULL,
  `check_date` varchar(20) NOT NULL,
  `create_date` varchar(20) NOT NULL,
  `acadyear` int(11) NOT NULL,
  `acadsemester` int(11) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  PRIMARY KEY  (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `student_color`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_color_task`
-- 

DROP TABLE IF EXISTS `student_color_task`;
CREATE TABLE IF NOT EXISTS `student_color_task` (
  `task_id` int(11) NOT NULL auto_increment,
  `task_date` varchar(20) NOT NULL,
  `task_roomid` varchar(3) NOT NULL,
  `task_status` varchar(2) NOT NULL,
  `acadyear` varchar(4) NOT NULL,
  `acadsemester` varchar(1) NOT NULL,
  PRIMARY KEY  (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `student_color_task`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_decision`
-- 

DROP TABLE IF EXISTS `student_decision`;
CREATE TABLE IF NOT EXISTS `student_decision` (
  `dis_id` int(11) NOT NULL,
  `dec_detail` text NOT NULL,
  `dec_date` varchar(10) NOT NULL,
  `dec_point` varchar(20) NOT NULL,
  PRIMARY KEY  (`dis_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `student_decision`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_discipline`
-- 

DROP TABLE IF EXISTS `student_discipline`;
CREATE TABLE IF NOT EXISTS `student_discipline` (
  `dis_id` int(11) NOT NULL auto_increment,
  `dis_studentid` varchar(5) character set utf8 NOT NULL,
  `dis_date` varchar(10) character set utf8 NOT NULL,
  `dis_time` varchar(5) character set utf8 NOT NULL,
  `dis_village` varchar(255) character set utf8 NOT NULL,
  `dis_tumbol` varchar(255) character set utf8 NOT NULL,
  `dis_inform` varchar(255) character set utf8 NOT NULL,
  `dis_informdate` varchar(10) character set utf8 NOT NULL,
  `dis_informgroup` varchar(20) character set utf8 NOT NULL,
  `dis_reciever` varchar(255) character set utf8 NOT NULL,
  `dis_recievedate` varchar(255) character set utf8 NOT NULL,
  `dis_recievedetail` text character set utf8 NOT NULL,
  `dis_detail` text character set utf8 NOT NULL,
  `dis_user` varchar(255) character set utf8 NOT NULL,
  PRIMARY KEY  (`dis_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `student_discipline`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_disciplinestatus`
-- 

DROP TABLE IF EXISTS `student_disciplinestatus`;
CREATE TABLE IF NOT EXISTS `student_disciplinestatus` (
  `student_id` varchar(5) NOT NULL,
  `dis_id` int(11) NOT NULL auto_increment,
  `dis_status` int(11) NOT NULL,
  `sanc_status` varchar(2) NOT NULL,
  `point` int(11) NOT NULL,
  `acadyear` int(11) NOT NULL,
  `acadsemester` int(11) NOT NULL,
  PRIMARY KEY  (`dis_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `student_disciplinestatus`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_drug`
-- 

DROP TABLE IF EXISTS `student_drug`;
CREATE TABLE IF NOT EXISTS `student_drug` (
  `row_id` varchar(20) NOT NULL,
  `student_id` varchar(5) NOT NULL,
  `class_id` varchar(3) NOT NULL,
  `drugType` varchar(2) NOT NULL,
  `drugLevel` varchar(2) NOT NULL,
  `check_date` varchar(20) NOT NULL,
  `create_date` varchar(20) NOT NULL,
  `acadyear` int(11) NOT NULL,
  `acadsemester` int(11) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  PRIMARY KEY  (`row_id`),
  KEY `student_id` (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `student_drug`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_drug_task`
-- 

DROP TABLE IF EXISTS `student_drug_task`;
CREATE TABLE IF NOT EXISTS `student_drug_task` (
  `task_id` int(11) NOT NULL auto_increment,
  `task_date` varchar(20) NOT NULL,
  `task_roomid` varchar(3) NOT NULL,
  `task_status` varchar(2) NOT NULL,
  `drug_id` varchar(2) NOT NULL,
  `acadyear` int(11) NOT NULL,
  `acadsemester` int(11) NOT NULL,
  PRIMARY KEY  (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `student_drug_task`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_investigation`
-- 

DROP TABLE IF EXISTS `student_investigation`;
CREATE TABLE IF NOT EXISTS `student_investigation` (
  `dis_id` int(11) NOT NULL,
  `student_id` varchar(5) NOT NULL,
  `dis_type` varchar(2) NOT NULL,
  `dis_level` varchar(2) NOT NULL,
  `dis_investdetail` text NOT NULL,
  `dis_sanction` text,
  `dis_investor` varchar(255) NOT NULL,
  `dis_investdate` varchar(10) default NULL,
  PRIMARY KEY  (`dis_id`,`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `student_investigation`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_learn`
-- 

DROP TABLE IF EXISTS `student_learn`;
CREATE TABLE IF NOT EXISTS `student_learn` (
  `row_id` varchar(20) NOT NULL,
  `student_id` varchar(5) NOT NULL,
  `class_id` varchar(3) NOT NULL,
  `period` varchar(2) NOT NULL,
  `timecheck_id` varchar(2) NOT NULL,
  `check_date` varchar(20) NOT NULL,
  `create_date` varchar(20) NOT NULL,
  `acadyear` int(11) NOT NULL,
  `acadsemester` int(11) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  PRIMARY KEY  (`row_id`),
  KEY `student_id` (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `student_learn`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_learn_task`
-- 

DROP TABLE IF EXISTS `student_learn_task`;
CREATE TABLE IF NOT EXISTS `student_learn_task` (
  `task_id` int(11) NOT NULL auto_increment,
  `task_date` varchar(20) NOT NULL,
  `task_roomid` varchar(3) NOT NULL,
  `task_status` varchar(2) NOT NULL,
  `period` varchar(2) NOT NULL,
  `acadyear` int(11) NOT NULL,
  `acadsemester` int(11) NOT NULL,
  PRIMARY KEY  (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `student_learn_task`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_moral`
-- 

DROP TABLE IF EXISTS `student_moral`;
CREATE TABLE IF NOT EXISTS `student_moral` (
  `id` int(11) NOT NULL auto_increment,
  `mdate` varchar(10) NOT NULL,
  `place` varchar(255) NOT NULL,
  `mlevel` varchar(2) NOT NULL,
  `mdesc` varchar(255) NOT NULL,
  `mtype` varchar(2) NOT NULL,
  `mprize` varchar(2) NOT NULL,
  `mteacher` varchar(255) NOT NULL,
  `student_id` varchar(5) NOT NULL,
  `academic` varchar(1) NOT NULL,
  `acadyear` varchar(4) NOT NULL,
  `acadsemester` varchar(1) NOT NULL,
  `point` int(11) NOT NULL,
  `image` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `student_moral`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_sanction`
-- 

DROP TABLE IF EXISTS `student_sanction`;
CREATE TABLE IF NOT EXISTS `student_sanction` (
  `id` int(11) NOT NULL auto_increment,
  `dis_id` int(11) NOT NULL,
  `sanc_detail` text character set utf8 NOT NULL,
  `sanc_time` int(11) NOT NULL,
  `sanc_alltime` int(11) NOT NULL,
  `sanc_teacher` varchar(255) character set utf8 NOT NULL,
  `sanc_date` varchar(10) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `student_sanction`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `subjects`
-- 

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `ACADYEAR` int(4) NOT NULL,
  `PSUBJECTCODE` varchar(20) NOT NULL,
  `PSUBJECTNAME` varchar(255) NOT NULL,
  `ESUBJECTCODE` varchar(20) default NULL,
  `ESUBJECTNAME` varchar(255) default NULL,
  `PSUBTYPE` varchar(1) NOT NULL,
  `PSUBJECTCREDIT` double(4,1) NOT NULL,
  `PLEVEL` int(11) NOT NULL,
  `PPLAN` int(11) NOT NULL,
  `PSUBINCLASS` varchar(50) NOT NULL,
  `PSUBINTERM` int(11) NOT NULL,
  `GROUPSARA` int(11) NOT NULL,
  `PSUBJECTGROUP` int(11) NOT NULL,
  `PSUBJECTNO` int(11) default NULL,
  `NHOURPERWEEK` int(11) NOT NULL,
  `SUBJECTDESCRIPTION` varchar(255) default NULL,
  `STATUS` int(11) NOT NULL,
  PRIMARY KEY  (`ACADYEAR`,`PSUBJECTCODE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `subjects`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `teachers`
-- 

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `TeacCode` varchar(3) NOT NULL default '',
  `PREFIX` varchar(20) default NULL,
  `FIRSTNAME` varchar(25) default NULL,
  `LASTNAME` varchar(25) default NULL,
  `NICKNAME` varchar(30) default NULL,
  `POSITION` varchar(255) NOT NULL,
  `T_PHONE` varchar(30) default NULL,
  `t_mobile` varchar(30) default NULL,
  `t_email` varchar(30) default NULL,
  `username` varchar(20) default NULL,
  `password` varchar(20) default NULL,
  `type` varchar(20) default 'teacher',
  `superuser` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`TeacCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `teachers`
-- 

INSERT INTO `teachers` VALUES ('999', 'นาย', 'สุรสิทธิ์', 'ท้าวกอก', 'โทบี้', 'Quality Assurance Analyst', '044846509', '0873708079', 'taokok@gmail.com', 'admin', 'admin', 'admin', '1');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `teachers_800`
-- 

DROP TABLE IF EXISTS `teachers_800`;
CREATE TABLE IF NOT EXISTS `teachers_800` (
  `roow_id` varchar(20) NOT NULL,
  `room_id` varchar(3) NOT NULL,
  `stutus` varchar(20) NOT NULL,
  `check_date` varchar(20) NOT NULL,
  `acadyear` int(11) NOT NULL,
  `acadsemester` int(11) NOT NULL,
  PRIMARY KEY  (`roow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `teachers_800`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `teachers_learn`
-- 

DROP TABLE IF EXISTS `teachers_learn`;
CREATE TABLE IF NOT EXISTS `teachers_learn` (
  `roow_id` varchar(20) NOT NULL,
  `room_id` varchar(3) NOT NULL,
  `period` varchar(2) NOT NULL,
  `stutus` varchar(20) NOT NULL,
  `check_date` varchar(20) NOT NULL,
  `acadyear` int(11) NOT NULL,
  `acadsemester` int(11) NOT NULL,
  PRIMARY KEY  (`roow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `teachers_learn`
-- 

