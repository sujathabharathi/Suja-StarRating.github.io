<?php
include_once '../interface/interfaces.php';
require_once '../lib/db.php';

class Tables implements AllTableInterface
{
	protected $db;
	public function __construct(DBInterface $db)
	{
		$this->db =$db;
	}
	
	function getLogin($db)
	{
		$sql ="select * from login order by logID";
		$result =$db->query($sql);
		return $result;
	}
	
	function displayLogin($logResult)
	{
		echo "<div style='overflow:hidden; overflow-x: scroll;'>";	
		echo "<table class='table table-striped table-hover' ><tr><th>Login ID </th><th>Login Name</th><th>Password</th><th>E-mail</th></tr>";
		while ( $aRow =  $logResult->fetch() )
		{
			$outputLine = "<tr><td>$aRow[logID]</td>";
			$outputLine .= "<td>$aRow[refLoginName]</td>";
			$outputLine .= "<td>$aRow[regPassword]</td>";
			$outputLine .= "<td>$aRow[emailID]</td></tr>";
			echo $outputLine;
		}
		 echo '</table>';
		 echo '</div>';
		 echo "<hr class ='divider'><br/><br/>";		
	}
}
class TablesExt extends Tables
{
	public function  __construct(DBInterface $db)
	{
		parent::__construct($db);
	}
	
	public function getRegistration($db)
	{
		$sql ="select * from registration order by regID";
		$result =$db->query($sql);
		return $result;
	}
	
	function displayRegistration($regResult)
	{
		echo "<div style='overflow:hidden; overflow-x: scroll;'>";
		echo "<table class='table table-striped table-hover' ><tr><th>Register ID </th><th>First Name</th><th>Last Name</th><th>E-mail</th> <th>Mobile</th> <th>Login Name</th> <th>Password</th> <th>DOB</th> <th>Gender</th> <th>City</th></tr>";
		while ( $aRow =  $regResult->fetch() )
		{
			$outputLine = "<tr><td>$aRow[regID]</td>";
			$outputLine .= "<td>$aRow[regFname]</td>";
			$outputLine .= "<td>$aRow[regLname]</td>";
			$outputLine .= "<td>$aRow[emailID]</td>";
			$outputLine .= "<td>$aRow[mobile]</td>";
			$outputLine .= "<td>$aRow[refLoginName]</td>";
			$outputLine .= "<td>$aRow[regPassword]</td>";
			$outputLine .= "<td>$aRow[regDOB]</td>";
			$outputLine .= "<td>$aRow[gender]</td>";
			$outputLine .= "<td>$aRow[regCity]</td></tr>";
			echo $outputLine;
		}
		 echo '</table>';
		 echo '</div>';
		 echo "<hr class ='divider'><br/><br/>";		
	}
	
	public function getStar($db)
	{
		$sql ="select * from starrank order by starID";
		$result =$db->query($sql);
		return $result;
	}
	
	function displayStar($starResult)
	{
		echo "<table class='table table-striped table-hover'><tr><th style='text-align:left;'>Star ID </th><th style='text-align:left;'>Star Details</th></tr>";
		while ( $aRow =  $starResult->fetch() )
		{
			$outputLine = "<tr><td>$aRow[starID]</td>";	
			$outputLine .= "<td>$aRow[starDetails]</td></tr>";
			echo $outputLine;
		}
		 echo '</table>';
		 echo "<hr class ='divider'><br/><br/>";		
	}
	
	
		
	public function getUserRating($db)
	{
		$sql ="select * from userrating order by userRateID";
		$result =$db->query($sql);
		return $result;
	}
	
	function displayUserRating($userResult)
	{
		echo "<div style='overflow:hidden; overflow-x: scroll;'>";
		echo "<table class='table table-striped table-hover' ><tr><th>User ID </th><th>Login ID</th><th>Star Rate</th><th>Rated Date</th><th>Rated Community</th> <th>User Comments</th></tr>";
		while ( $aRow =  $userResult->fetch() )
		{
			$outputLine = "<tr><td>$aRow[userRateID]</td>";
			$outputLine .= "<td>$aRow[logID]</td>";
			$outputLine .= "<td>$aRow[starID]</td>";
			$outputLine .= "<td>$aRow[ratedDate]</td>";
			$outputLine .= "<td>$aRow[ratedCom]</td>";
			$outputLine .= "<td>$aRow[Usercomments]</td></tr>";
			echo $outputLine;
		}
		 echo '</table>';
		 echo '</div>';
		 echo "<hr class ='divider'><br/><br/>";		
	}
	
	
}