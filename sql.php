-- exercise 1

create database college;
 


create table student(
student_id int not null primary key,
name varchar(10) not null,
year smallint not null default 1,
dept_no int not null,
major varchar(20)
);

create table department(
dept_no int primary key auto_increment,
dept_name varchar(20) unique,
office varchar(20),
office_tel varchar(13) not null
);
 
alter table student change column major major varchar(40);
alter table student add column gender varchar(5) not null;
alter table department change column dept_name dept_name varchar(40);
alter table department change column office office varchar(30);
 

-- exercise 2

alter table student drop gender;
 
insert into student values (20070002,'James Bond', 3, 4,'Business Administration')
insert into student values (20060001, 'Queenie', 4, 4, 'Business Administration');
insert into student values (20030001,'Reonardo', 4, 2, 'Electronic Engineering');
insert into student values (20040003,'Julia', 3, 2, 'Electronic Engineering');
insert into student values (20060002, 'Roosevelt', 3, 1, 'Computer Science');
insert into student values (20100002, 'Fearne', 3, 4, 'Business Administration');
insert into student values (20110001, 'Chloe', 2, 1, 'Computer Science');
insert into student values (20080003, 'Amy', 4, 3, 'Law');
insert into student values (20040002, 'Selina', 4, 5, 'English Literature');
insert into student values (20070001, 'Ellen', 4, 4, 'Business Administration');
insert into student values (20100001, 'Kathy', 3, 4, 'Business Administration');
insert into student values (20110002, 'Lucy', 2, 2, 'Electronic Engineering');
insert into student values (20030002, 'Michelle', 5, 1, 'Computer Science');
insert into student values (20070003, 'April', 4, 3, 'Law');
insert into student values (20070005, 'Alicia', 2, 5, 'English Literature');
insert into student values (20100003, 'Yullia', 3, 1, 'Computer Science');
insert into student values (20070007, 'Ashlee', 2, 4, 'Business Administration');


alter table student add foreign key(dept_no) references department(dept_no);


insert into department values (1, 'Computer Scienece', 'Engineering building', '02-3290-0123');
insert into department values (2, 'Electronic Engineering', 'Engineering building', '02-3290-2345');
insert into department values (3, 'Law', 'Law building', '02-3290-7896');
insert into department values (4, 'Business Administration', 'Administration building', '02-3290-1112');
insert into department values (5, 'English Literature', 'Literature building', '02-3290-4412');


-- exercise 3

update department set dept_name='Electoronic engineering' where dept_name='Electoronic and Electrical Engineering';

insert into department(dept_name, office, office_tel) values ('Educatuion', 'Educatuion Building', '02-3290-2347');

update student set major='Educatuion' where name='Chloe';

delete from student where name='Michelle';

delete from student where name='Fearne';

-- exercise 4

select * from student where major='Computer Science';

select student_id,year,major from student;

select * from student where year=3;

select * from student where year=1 or year=2;

select name from student s join department d on s.dept_no=d.dept_no where major='Business Administration';

-- exercise 5


select name from student where student_id like '%2007%'; 

select name from student order by student_id;

select major from student group by major having avg(year)>3;
 
select name from student where major='Business Administration' like '%2007%' limit 2;


-- exercise 6

select role from roles r join movies m on r.movie_id=m.id where m.name='Pi';

select first_name firstname,last_name lastname from actors a join roles r on a.id=r.actor_id join movies m on m.id=r.movie_id where m.name='Pi';

select a.first_name, a.last_name  from actors a JOIN roles r1 on r1.actor_id = a.id JOIN roles r2 on r2.actor_id = a.id JOIN movies m1 on m1.id = r1.movie_id JOIN movies m2 on m2.id = r2.movie_idwhere m1.name = 'Kill Bill: Vol. 1'and m2.name = 'Kill Bill: Vol. 2';

select first_name,last_name from actors a join roles r on a.id=r.actor_id group by r.actor_id order by count(actor_id) desc limit 7;

select genre from movies_genres group by genre order by count(genre) desc limit 3;

select d.first_name,d.last_name, count(d.id) as count from directors d, directors_genres dg where d.id=dg.director_id and dg.genre='Thriller' group by dg.genre having count order by count desc limit 1;

-- exercise 7

select g.grade grade from grades g join courses c on course_id=c.id where c.name = 'Computer Science 143';
	
select s.name name, g.grade grade from grades g join students s on g.student_id=s.id join courses c on g.course_id=c.id where c.name='Computer Science 143' and g.grade <= 'B-';

select s.name student, c.name course, g.grade grade from grades g join students s on g.student_id = s.id join courses c on g.course_id = c.id where g.grade <= 'B-';

select c.name course, count(*) howmany from grades g join students s on g.student_id = s.id join courses c on g.course_id = c.id group by c.name having count(*) >= 2;
