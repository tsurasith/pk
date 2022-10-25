

-- Fix module student_learn & SDQ

-- 1. แก้ไขเลขประจำตัวนักเรียน
update student_learn
set
	student_id = concat(0,right(student_id,4))
where
	acadyear = 2565 and acadsemester = 1 and student_id like '1____';


-- 2. ลบห้องเรียน 4/2
delete from student_learn_task
where
  acadyear = 2565
  and task_roomid = '402';


-- 3. แก่ไชห่องเรียนจาก 4/2 มาเป็น 4/1
update student_learn
set
	class_id = '401'
where
	class_id = '402'
    and acadyear = 2565
;  

-- 4. fix table: teachers_800 & teachers_learn 
delete from teachers_800
where 
	acadyear = 2565 and acadsemester = 1
    and room_id = '402';
    
delete from teachers_learn
where 
	acadyear = 2565 and acadsemester = 1
    and room_id = '402'
;    

-- 5. fix table: sdq_student
update sdq_student
set
	student_id = concat(0,student_id)
where
	acadyear = 2565 and semester = 1
    and length(student_id) < 5;

insert into sdq_student (student_id,acadyear,semester,status,create_date)
select id,2565,1,0,'2022-10-25' from students
where 
	id not in (select student_id from sdq_student where acadyear = 2565 and semester = 1)
    and xedbe = 2565 and studstatus in (1,4);


-- 6. fix table: sdq_teacher
update sdq_teacher
set
	student_id = concat(0,student_id)
where
	acadyear = 2565 and semester = 1
    and length(student_id) < 5;

insert into sdq_teacher (student_id,teacher_id,acadyear,semester,status,create_date)
select id,'999',2565,1,0,'2022-10-25' from students
where 
	id not in (select student_id from sdq_teacher where acadyear = 2565 and semester = 1)
    and xedbe = 2565 and studstatus in (1,4);


-- 7. fix table: sql_parent
update sdq_parent
set
	student_id = concat(0,student_id)
where
	acadyear = 2565 and semester = 1
    and length(student_id) < 5;	

insert into sdq_parent (student_id,acadyear,semester,status,create_date)
select id,2565,1,0,'2022-10-25' from students
where 
	id not in (select student_id from sdq_parent where acadyear = 2565 and semester = 1)
    and xedbe = 2565 and studstatus in (1,4);

-- 8. fix table: sdq_result
insert into sdq_result
select student_id,-1,-1,-1,-1,-1,-1,-1,2565,1,'student' from sdq_student where acadyear = 2565 and semester = 1 ;

insert into sdq_result
select student_id,-1,-1,-1,-1,-1,-1,-1,2565,1,'teacher' from sdq_teacher where acadyear = 2565 and semester = 1 ;

insert into sdq_result
select student_id,-1,-1,-1,-1,-1,-1,-1,2565,1,'parent' from sdq_parent where acadyear = 2565 and semester = 1 ;


-- 9. fix result calculation
update sdq_result r inner join sdq_student s on (r.student_id = s.student_id and r.acadyear = s.acadyear and r.acadsemester = s.semester)
set 
	type1 = c03+c08+c13+c16+c24,
	type2 = c05+c07+c12+c18+c22,
    type3 = c02+c10+c15+c21+c25,
    type4 = c06+c11+c14+c19+c23,
    type5 = c01+c04+c09+c17+c20
where
	r.acadyear = 2565 and r.acadsemester = 1 and s.status = 1
    and r.questioner = 'student';
 
 update sdq_result r inner join sdq_student s on (r.student_id = s.student_id and r.acadyear = s.acadyear and r.acadsemester = s.semester)
set 
	r.all = type1+type2+type3+type4
where
	r.acadyear = 2565 and r.acadsemester = 1 and s.status = 1
    and r.questioner = 'student';

 
update sdq_result r inner join sdq_teacher s on (r.student_id = s.student_id and r.acadyear = s.acadyear and r.acadsemester = s.semester)
set 
	type1 = c03+c08+c13+c16+c24,
	type2 = c05+c07+c12+c18+c22,
    type3 = c02+c10+c15+c21+c25,
    type4 = c06+c11+c14+c19+c23,
    type5 = c01+c04+c09+c17+c20
where
	r.acadyear = 2565 and r.acadsemester = 1 and s.status = 1
    and r.questioner = 'teacher';
 
 update sdq_result r inner join sdq_teacher s on (r.student_id = s.student_id and r.acadyear = s.acadyear and r.acadsemester = s.semester)
set 
	r.all = type1+type2+type3+type4
where
	r.acadyear = 2565 and r.acadsemester = 1 and s.status = 1
    and r.questioner = 'teacher';

update sdq_result r inner join sdq_parent s on (r.student_id = s.student_id and r.acadyear = s.acadyear and r.acadsemester = s.semester)
set 
	type1 = c03+c08+c13+c16+c24,
	type2 = c05+c07+c12+c18+c22,
    type3 = c02+c10+c15+c21+c25,
    type4 = c06+c11+c14+c19+c23,
    type5 = c01+c04+c09+c17+c20
where
	r.acadyear = 2565 and r.acadsemester = 1 and s.status = 1
    and r.questioner = 'parent';
 
 update sdq_result r inner join sdq_parent s on (r.student_id = s.student_id and r.acadyear = s.acadyear and r.acadsemester = s.semester)
set 
	r.all = type1+type2+type3+type4
where
	r.acadyear = 2565 and r.acadsemester = 1 and s.status = 1
    and r.questioner = 'parent';


