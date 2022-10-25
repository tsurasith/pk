-- จัดการนักเรียนชั้น ม.1 

-- 1. ลบ รายชื่อนักเรียน ที่ไม่เกี่ยวข้องให้ถูกต้อง 
delete from students
where
	length(ID) < 5 and xlevel = 3 and studstatus != 1 and xedbe = 2565;


-- 2. แก้ไขเลขประจำตัวนักเรียนให้ถูกต้องตาม format 5 ตัวอักษร
update students
set
	id = concat(0,id)
where 
	length(ID) < 5 and xlevel = 3 and xedbe = 2565;

-- 3. แก้ไขข้อมูล เลขประจำตัวนักเรียน ในตาราง student_800 
update student_800
set
	student_id = concat(0,student_id)
where
	length(student_id)<5 and class_id in ('101','102');

-- 4. ลบรายชื่อนักเรียนห้อง 1/2 ซึ่งเกิดจากข้อมูลที่ผิดพลาด
delete from students 
where xlevel = 3 and xyearth = 1 and xedbe = 2565 and room = 2;


-- 5. อัพเดท เลขประจำตัวนักเรียนในตาราง student_800 ให้มีความยาวเท่ากับ 5 ตัวอักษร
update student_800
set student_id = concat(0,student_id)
where
	acadyear = 2565 and acadsemester = 1
    and length(student_id) < 5;

-- 6. อัพเดท เลขประจำตัวนักเรียนในตาราง student_lean ให้มีความยาวเท่ากับ 5 ตัวอักษร
update student_learn
set student_id = concat(0,student_id)
where
	acadyear = 2565 and acadsemester = 1
    and length(student_id) < 5;


-- 7. ลบรายชื่อนักเรียนห้อง 4/2 ซึ่งเกิดจากนำเข้าข้อมูลผิดพลาด
delete from students 
where xlevel = 4 and xyearth = 1 and xedbe = 2565 and room = 2;

delete from students
where xlevel = 4 and xyearth = 1 and xedbe = 2565 and length(id) < 5;

delete from students
where  id = '01064' and xlevel = 4 and xyearth = 1 and xedbe = 2565;

-- 8. แก้ไขเลขประจำตัวนักเรียน ม.4 ให้ขึ้นต้นด้วยเลข 0
update students
set
	id = concat(0,right(id,4))
where
	xlevel = 4 and xyearth = 1 and xedbe = 2565;


-- 9. แก้ leading zeo on table: student_800
update	student_800
set		student_id = concat(0,right(student_id,4))
where
		student_id like '1____';

/*  need to retest this script  */
update  student_800
set     class_id = '401'
where 
        acadyear = '2565' and acadsemester = '1'
        and class_id = '402';

-- 10. delete data from table: student_800_task
delete from student_800_task
where
	acadyear = 2565
    and acadsemester = 1
    and task_roomid like '__2';




-- 11. remove duplate data in table: student_800
DROP TABLE IF EXISTS `student_800_temp`;
CREATE TABLE `student_800_temp` (
  `student_id` varchar(5) NOT NULL,
  `check_date` varchar(20) NOT NULL,
  `acadsemester` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO student_800_temp
select student_id,check_date,count(check_date) from student_800
where 
	acadyear = 2565
    and acadsemester = 1
group by student_id,check_date
having count(check_date) > 1;

delete s.* 
from student_800_temp t inner join student_800 s on (t.student_id = s.student_id and t.check_date = s.check_date and s.acadyear = 2565)
where
	s.row_id like '%402__';

DROP TABLE IF EXISTS `student_800_temp`;


-- 12. fix table student_discipline
update student_discipline
set
	dis_studentid = concat(0,dis_studentid)
where
	length(dis_studentid) < 5;

update student_discipline
set
	dis_studentid = concat(0,right(dis_studentid,4))
where
	dis_studentid like '1____';


-- 13 fix table student_disciplinestatus
update student_disciplinestatus
set
	student_id = concat(0,right(student_id,4))
where
	student_id like '1____';

update student_disciplinestatus
set
	student_id = concat(0,student_id)
where
	length(student_id) < 5;


-- 14. fix table student_drug and student_drug_task
update student_drug
set
	student_id = concat(0,right(student_id,4))
where
	student_id like '1____';

update student_drug
set
	student_id = concat(0,student_id)
where
	length(student_id) < 5;

delete from student_drug_task
where task_roomid = '402' and acadyear = 2565


