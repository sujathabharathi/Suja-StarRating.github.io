<?php
/* include_once 'MYSQLDB.php'; */
include_once '../interface/interfaces.php';
require_once '../lib/db.php';
 
class TableMaker implements TableInterface
{
	protected $db;
	public function __construct(DBInterface $db)
	{
			$this->db= $db;
	}

	 function getPostedCommets($db,$theWord)
	 {
		$sql ="select Login.refLoginName,
				userrating.starID,
				starrank.starDetails,
				userrating.ratedCom,
				userrating.Usercomments
				from userrating 
				inner join Login on Login.logID = userrating.logID
				inner join starrank on userrating.starID = starrank.starID 
				where Login.refLoginName ='$theWord' or userrating.starID= '$theWord' order by starID";
		$result = $db->query($sql);
		return $result;
	 }

	function displayPostedComments($posts)
	{	
		while($aRow = $posts->fetch())
		{
			$out ="<table class='table table-striped'>";
			$out .= "<tr style='font-size:1em; font-weight: bold; color:blue;'><td style='white-space:nowrap;' colspan='2'>$aRow[refLoginName]</td></tr>";
			$out .= "<tr><td  colspan='2'><h3 style='font-size:1.3em;font-weight: bold;'>Community: $aRow[ratedCom]</h3></td></tr>";
			$out .= "<tr><td><h3 style='font-size:1.3em; font-weight: bold;'>Star Rate : $aRow[starID] - ";
			$out .= "$aRow[starDetails]</h3></td></tr>";		
			$out .= "<tr><td><h3 style='font-size:1.3em; font-weight: bold;'> Comments : </h3>$aRow[Usercomments]</td></tr><br/>";
			
			echo $out;
		}
		echo '</table>';
	}
}
 
class DesignTable extends TableMaker
{
	public function __construct(DBInterface $db)
	{
		parent::__construct($db);		
	}
	
	public function getComments($db,$theWord)
	{
	$sql="select Login.refLoginName,
			userrating.starID,
			starrank.starDetails,
			userrating.ratedCom,
			userrating.Usercomments
			from userrating 
			inner join Login on Login.logID = userrating.logID
			inner join starrank on userrating.starID = starrank.starID";
	$result = $db->query($sql);
	return $result;
	}
	
	function displayComments($posts)
	{	
		while($aRow = $posts->fetch())
		{
			$out ="<table class='table table-striped'>";
			$out .= "<tr><td style='white-space:nowrap;' colspan='2'><h3 style='font-size:1.5em; font-weight: bold; color:blue;'>$aRow[refLoginName]</h3></td></tr>";
			$out .= "<tr><td  colspan='2'><h3 style='font-size:1.3em;font-weight: bold;'>Community: $aRow[ratedCom]</h3></td></tr>";
			$out .= "<tr><td><h3 style='font-size:1.3em; font-weight: bold;'>Star Rate : $aRow[starID] - ";
			$out .= "$aRow[starDetails]</h3></td></tr>";		
			$out .= "<tr><td><h3 style='font-size:1.3em; font-weight: bold;'> Comments : </h3>$aRow[Usercomments]</td></tr><hr class='divider'>";
			
			echo $out;
		}
		echo '</table>';
	}	
	
}

