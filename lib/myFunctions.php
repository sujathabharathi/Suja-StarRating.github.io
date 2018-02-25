<?php

function localize($phrase) {
		$lang_file = '../textLang.ini';		
		$lang_file_content = parse_ini_file($lang_file, true);	
		$language = $GLOBALS['language'];	    
		if (array_key_exists($phrase, $lang_file_content[$language])) {
			return $lang_file_content[$language][$phrase];
		} else {
			return $phrase;
		}
	}
	
function test($input)
{
	$input = trim($input);
	$input = stripcslashes($input);
	$input = htmlspecialchars($input,ENT_QUOTES,"UTF-8");
	return $input;
}

function verifyConfiguration($string)
{
	$default ='English';
	$verification=array('English','Hindi');
	$string = test_input($string);
	if(in_array($string,$verification))
		return $string;
	else
		return $default;
}

function getUserDetails($db,$theUserName,$thePassword)
{
	$hashedPassword = getHashedPassword($db, $theUserName)->fetch()['regPassword'];
	$result = password_verify($thePassword,$hashedPassword);
	
	if($result == true)
	{
		getIDFromLogin($db,$theUserName)->fetch()['logID'];		
	}
	return $result;
}


function getHashedPassword($db, $theUserName)
{
	$sql= "select regPassword from login where refLoginName='$theUserName'";
	$result =$db->query($sql);
	return $result;
} 

function getIDFromLogin($db,$theUserName)
{
	$sql ="select logID from login where refLoginName ='$theUserName'";
	$result =$db->query($sql);
	return $result;
}

function updatePassword($db,$id,$newHash)
{
	$sql = "update login set regPassword ='$newHash' where logID='$id'";
	$result =$db->insertRow($sql);
	return $result;
}

function getUserName($db,$loginId)
{
	$sql ="select regFname,regLname from registration WHERE regID = $loginId;";
	$result =$db->query($sql);
	return $result;
}


function checkUserNameExists($db,$logName)
{
	$sql ="select refLoginName from Registration where refLoginName ='$logName'";
	$result = $db->query($sql);
	return $result;
}

function createNewSignUp($db,$fname,$lname,$emailid,$mobileNo,$logname,$hasedPassword,$dob,$gender,$city)
{
	$sql ="insert into Registration values(null,'$fname','$lname','$emailid','$mobileNo','$logname','$hasedPassword','$dob','$gender','$city')";
	$result =$db->insertRow($sql);
	return $result;
}

function newUseerReview($db,$loginId,$star,$date,$ratedCom,$Usercomments)
{
	$sql =" insert into userRating values(null,'$loginId','$star','2017-09-15','$ratedCom','$Usercomments')"; 
	$result = $db->insertRow($sql);
	return $result;
}
/* entry for admin */
function newAdminReview($db,$adminID,$star,$date,$ratedCom,$Usercomments)
{
	$sql =" insert into userRating values(null,'$adminID','$star','2017-09-15','$ratedCom','$Usercomments')"; 
	$result = $db->insertRow($sql);
	return $result;
}
