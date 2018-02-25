
create database UserRating;
use UserRating;

create table Registration(
regID integer Not null auto_increment,
regFname varchar(20),
regLname varchar(20),
refLoginName varchar(20),
regPassword varchar(20),
regDOB Date,
gender enum('M','F','O'),
emailID varchar(80),
mobile integer(10),
regCity varchar(20),
primary key(regID,emailID));


insert into Registration values(null,"sujatha","bharathi","suja16","suja1603","1986-03-16","F","sujathabharathi08@gmail.com",02108236970,"ChristChurch");
insert into Registration values(null,"sujatha","bharathi","suja16","suja1603","1986-03-16","M","chefganesh21@gmail.com",02102979689,"ChristChurch");
insert into Registration values(null,"sujatha","bharathi","suja16","suja1603","1986-03-16","F","sujathabharathi@gmail.com",02108236970,"ChristChurch");

update Registration set regFname="suja",regLname="Ganesh",refLoginName="sGanesh",regPassword="ganesh2312" where regID=2;
update Registration set regFname="bhoomika",regLname="shree",refLoginName="shree14",regPassword="shree1407", regDOB="2011-07-14" where regID=3;

update Registration set regDOB="1980-12-23" where regID=2;
update Registration set regDOB="2011-7-14" where regID=3;

select * from Registration;

create table StarRank(
starID integer Not null auto_increment,
starDetails varchar(20),
primary key(starID));

insert into StarRank values(null,"HATED IT");
insert into StarRank values(null,"DIDN'T LIKED IT");
insert into StarRank values(null,"JUST OK");
insert into StarRank values(null,"LIKED IT");
insert into StarRank values(null,"LOVED IT");

select * from StarRank;


create table Login(
logID integer Not null auto_increment,
refLoginName varchar(20),
regPassword varchar(20),
emailID varchar(80),
regID integer(5),
primary key(logID),
foreign key (regID) references Registration(regID));


insert into Login values(null,"suja16","suja1603","sujathabharathi08@gmail.com",1); 
insert into Login values(null,"sGanesh","ganesh2312","chefganesh21@gmail.com",2); 
insert into Login values(null,"shree14","shree1407","sujathabharathi@gmail.com",3);


select * from Login;

drop table userRating;

create table userRating(
userRateID integer Not null auto_increment,
logID integer(5),
starID integer(5),
ratedDate Date,
ratedYear year,
primary key(userRateID),
foreign key (logID) references Login(logID),
foreign key (starID) references StarRank(starID));

DELIMITER $$

DROP TRIGGER IF EXISTS userrating.userrating_BEFORE_INSERT$$
USE `userrating`$$
CREATE DEFINER = CURRENT_USER TRIGGER `userrating`.`userrating_BEFORE_INSERT` BEFORE INSERT ON `userrating` FOR EACH ROW
BEGIN
Set New.ratedDate =Now(), New.ratedYear= YEAR(New.ratedDate);
END$$
DELIMITER ;


insert into userRating(logID,starID,ratedDate,ratedYear)
 values(1,1,"2017-09-15","2017");
 
insert into userRating(logID,starID,ratedDate,ratedYear)
 values(3,1,"2017-09-15","2017");
 
 insert into userRating(logID,starID,ratedDate,ratedYear)
 values(2,3,"2017-09-15","2017");
 
 insert into userRating(logID,starID,ratedDate,ratedYear)
 values(4,3,"2017-09-15","2017");
 
select * from userrating;

select userRateID, 
userrating.logID, 
starrank.starID,
starDetails
from (userrating 
left join starrank on starrank.starID = userrating.starID);

select login.logid,
starDetails, 
starrank.starID,
Login.refLoginName,
concat(regFname," ",regLname) as 'Full Name',
regDOB,
gender,
registration.emailID,
mobile,
regCity
from (((userrating
inner join starrank on userrating.starID = starrank.starID)
inner join Login on userrating.logID = Login.logID)
inner join registration on Login.regID =registration.regID) order by logid;


select login.logid,
starDetails, 
starrank.starID,
Login.refLoginName,
concat(regFname," ",regLname) as 'Full Name',
regDOB,
gender,
registration.emailID,
mobile,
regCity
from (((userrating
inner join starrank on userrating.starID = starrank.starID)
inner join Login on userrating.logID = Login.logID)
inner join registration on Login.regID =registration.regID) where 
(registration.regDOB between "1980-01-01" and "1990-01-01") AND (starrank.starID >=4) order by starID;


DELIMITER $$
CREATE TRIGGER reg_Insert_trigger
AFTER INSERT ON registration
FOR EACH ROW
BEGIN
  INSERT INTO login set logID= null, 
	refLoginName = new.refLoginName, 
    regPassword = new.regPassword,
    emailID= new.emailID, 
    regID = new.regID;
END$$
DELIMITER ;

insert into Registration values
(null,"radha","krishna","radha16","krish1402","1996-06-24","F","radhakrish@gmail.com",02105439752,"ChristChurch");

select * from registration;
select * from login;


select sum(starID) as 'TotalRank', count(logID) as 'No.of Users' from userrating;

select sum(starID) / count(logID) as 'Average Rating' from userrating;

select (( count(starID) / (select count(logid) from userrating ))) * 100  as 'Rank 5% ' from userrating where starID =5;
select (( count(starID) / (select count(logid) from userrating ))) * 100  as 'Rank 4% ' from userrating where starID =4;
select (( count(starID) / (select count(logid) from userrating ))) * 100  as 'Rank 3% ' from userrating where starID =3;
select (( count(starID) / (select count(logid) from userrating ))) * 100  as 'Rank 2% ' from userrating where starID =2;
select (( count(starID) / (select count(logid) from userrating ))) * 100  as 'Rank 1% ' from userrating where starID =1;

# For Full name display
select regFname,regLname
from (registration
inner join Login on Login.regID =1);

#posting details
select Login.refLoginName,
userrating.starID,
starrank.starDetails,
userrating.Usercomments
 from userrating 
 inner join Login on Login.logID = userrating.logID
 inner join starrank on userrating.starID = starrank.starID;
 

#for login name an comments display  may be for search
select Login.refLoginName,
userrating.Usercomments
 from userrating inner join Login on Login.logID = userrating.logID;


#login table trigger used to update the registration table automatically
DROP TRIGGER IF EXISTS `userreview`.`login_AFTER_UPDATE`;

DELIMITER $$
USE `userreview`$$
CREATE DEFINER = CURRENT_USER TRIGGER `userreview`.`login_AFTER_UPDATE` 
AFTER UPDATE ON `login` FOR EACH ROW
BEGIN
update registration set regPassword =new.regPassword where regID=new.logID;
END$$
DELIMITER ;
