
 <?php
include_once '../lib/MYSQLDB.php';
require '../lib/db.php';
$db->createDatabase();
$db->selectDatabase();

//drop the tables
$sql ="drop table if exists Registration";
$result = $db->query($sql);

$sql ="drop table if exists StarRank";
$result = $db->query($sql);

$sql ="drop table if exists Login";
$result = $db->query($sql);

$sql ="drop table if exists userRating;";
$result = $db->query($sql);

//create the table Registration
$sql ="create table Registration(
					regID integer Not null auto_increment,
					regFname varchar(20),
					regLname varchar(20),
					emailID varchar(80),
					mobile integer(10),
					refLoginName varchar(20),
					regPassword varchar(80),
					regDOB Date,
					gender enum('M','F','O'),
					regCity varchar(20),
					primary key(regID,emailID)) ENGINE=InnoDB";
$result = $db->query($sql);
if($result)
{
	echo 'The Registration table was added <br>';	
}
else
{
	echo 'The Registration table was not added <br>';
}


//create the table StarRank
$sql ="create table StarRank(
					starID integer Not null auto_increment,
					starDetails varchar(20),
					primary key(starID)) ENGINE=InnoDB";
					
$result  = $db->query($sql);
if($result)
{
	echo 'The StarRank table was added <br>';
}
else
{
	echo 'The StarRank table was not added <br>';
}

//create the table Login
$sql="create table Login(
				   logID integer Not null auto_increment,
				   refLoginName varchar(20),
				   regPassword varchar(80),
				   emailID varchar(80),
				   regID integer(5),
				   primary key(logID),
				   foreign key (regID) references Registration(regID))";
				   
$result = $db->query($sql);
if($result)
{
	echo 'The Login table was added <br>';
}
else
{
	echo 'The Login table was not added <br>';
}


// Create the table UserRating
$sql ="create table userRating(
					userRateID integer Not null auto_increment,
					logID integer(5),
					starID integer(5),
					ratedDate Date,
					ratedCom varchar(10),
					Usercomments varchar(100),
					primary key(userRateID),
					foreign key (logID) references Login(logID),
					foreign key (starID) references StarRank(starID))ENGINE=InnoDB";
$result = $db->query($sql);
if($result)
{
	echo 'The UserRating table was added <br>';
}
else
{
	echo 'The UserRating table was not added <br>';
}

//Check Trigger;
$sql="DROP TRIGGER IF EXISTS `userreview`.`registration_AFTER_INSERT`";
$result =$db->query($sql);

//creating trigger for Registration table - purpose is to automatically insert data into "Login Table" when user adding data through "Registration table"

$sql="
CREATE  
TRIGGER `userreview`.`registration_AFTER_INSERT`
 AFTER INSERT ON `registration` FOR EACH ROW


BEGIN
  INSERT INTO login set logID= null, 
	refLoginName = new.refLoginName, 
    regPassword = new.regPassword,
    emailID= new.emailID, 
    regID = new.regID;


END";
$result = $db->query($sql);
if($result)
{
	echo 'The Registration table " Trigger " was added <br>';
}
else
{
	echo 'The Registration table "Trigger " was not added <br>';
}




//Check Trigger exists for userrating table
$sql="DROP TRIGGER IF EXISTS `userreview`.`userrating_BEFORE_INSERT`";
$result = $db->query($sql);

//Create "Trigger" for UserRating table for automatic insertion of current System's date into tables
$sql="CREATE DEFINER = CURRENT_USER TRIGGER `userreview`.`userrating_BEFORE_INSERT` BEFORE INSERT ON `userrating` FOR EACH ROW
BEGIN

Set New.ratedDate =Now(); 
END";
$result = $db->query($sql);


if($result)
{
	echo 'The userRating table " Trigger " was added <br>';
}
else
{
	echo 'The UserRating table "Trigger " was not added <br>';
}


//Check Trigger exists for login table
$sql="DROP TRIGGER IF EXISTS `userreview`.`login_AFTER_UPDATE`;";
$result = $db->query($sql);

//Create "Trigger" for login table, when user Updates(chagePassword) the password this trigger will automatically updated into Registration table... 

$sql="CREATE DEFINER = CURRENT_USER TRIGGER `userreview`.`login_AFTER_UPDATE` 
AFTER UPDATE ON `login` FOR EACH ROW
BEGIN
update registration set regPassword =new.regPassword where regID=new.logID;
END";
$result = $db->query($sql);


if($result)
{
	echo 'The Login table " Trigger " was added <br>';
}
else
{
	echo 'The Login table "Trigger " was not added <br>';
}


//inserting into Registration
$password = password_hash('suja1603',PASSWORD_DEFAULT);
$sql="insert into Registration values(null,'sujatha','bharathi','sujathabharathi08@gmail.com',02108236970,'suja16','$password','1986-03-16','F','ChristChurch')";
$result =$db->query($sql);

$password = password_hash('ganesh2312',PASSWORD_DEFAULT);
$sql= "insert into Registration values(null,'suja','Ganesh','chefganesh21@gmail.com',02102979689,'sGanesh','$password','1980-12-23','M','ChristChurch')";
$result =$db->query($sql);


$password = password_hash('shree1407',PASSWORD_DEFAULT);
$sql="insert into Registration values(null,'bhoomika','shree','sujathabharathi@gmail.com',02108236970,'shree14','$password','2011-07-14','F','ChristChurch')";
$result =$db->query($sql); 

//inserting into StarRank
$sql ="insert into StarRank values(null,'HATED IT'),
						   (null,'DIDNT LIKED IT'),
                           (null,'JUST OK'),
                           (null,'LIKED IT'),
                           (null,'LOVED IT')";
$result =$db->query($sql);

//inserting into userRating
$sql="insert into userRating(logID,starID,ratedDate,ratedCom,Usercomments)
 values(1,1,'2017-09-15','hindi','Not a good App with expected Level of features')";
 $result =$db->query($sql);
 
$sql="insert into userRating(logID,starID,ratedDate,ratedCom,Usercomments)
 values(3,5,'2017-09-15','bagchal','Very nice app for play a game highly recommended')";
  $result =$db->query($sql);
 
$sql="insert into userRating(logID,starID,ratedDate,ratedCom,Usercomments)
 values(2,3,'2017-09-15','hindi','Good app expecting some improvements')";
  $result =$db->query($sql);
  

  	header('Location:../view/index.php' );	
 ?>
 

