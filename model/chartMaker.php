<?php
//include_once 'MYSQLDB.php';
require_once '../lib/db.php';
include_once '../interface/interfaces.php';

class ChartMaker implements ChartInterface
{
	protected $db;
	public function __construct(DBInterface $db)
	{
		$this->db=$db;
	}
	
function getNoOfUsers($db)
{
	$sql = "select count(logID)from userrating";
	$result  =$db->query($sql);
	return $result;
}
function AverageStarRate($db)
{
	$sql = "select sum(starID) / count(logID) from userrating";
	$result =$db->query($sql);
	return $result;
}

function star5($db)
{
	$sql ="select (( count(starID) / (select count(logid) from userrating ))) * 100   from userrating where starID =5";
	$result =$db->query($sql);
	return $result;
}


function star4($db)
{
	$sql ="select (( count(starID) / (select count(logid) from userrating ))) * 100   from userrating where starID =4";
	$result =$db->query($sql);
	return $result;
}

function star3($db)
{
	$sql ="select (( count(starID) / (select count(logid) from userrating ))) * 100   from userrating where starID =3";
	$result =$db->query($sql);
	return $result;
}

function star2($db)
{
	$sql ="select (( count(starID) / (select count(logid) from userrating ))) * 100   from userrating where starID =2";
	$result =$db->query($sql);
	return $result;
}

function star1($db)
{
	$sql ="select (( count(starID) / (select count(logid) from userrating ))) * 100   from userrating where starID =1";
	$result =$db->query($sql);
	return $result;
}

}

