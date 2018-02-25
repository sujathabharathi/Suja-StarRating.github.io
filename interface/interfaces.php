<?php

interface DBInterface
{
	function __construct( $host, $dbUser, $dbPass, $dbName );
	function connectToServer();
	function selectDatabase();
	function dropDatabase();	
	function createDatabase();
	function isError();	
	function createTable(array $table, string $sql );
	function insertRow(string $sql);
	function query(string $sql );
}

interface ResultInterface 
{  
   function __construct(DBInterface &$mydb, $query );  
   function size();
   function fetch();
   function insertID();
   function isError();
}

interface TableInterface
{
	function __construct(DBInterface $db);
	function getPostedCommets($db,$theWord);
	function displayPostedComments($post);	
}

interface ChartInterface
{
	function __construct(DBInterface $db);
	function getNoOfUsers($db);
	function AverageStarRate($db);
	function star5($db);
	function star4($db);	
	function star3($db);
	function star2($db);
	function star1($db);
}
interface AllTableInterface
{
	function __construct(DBInterface $db);
	function getLogin($db);
	function displayLogin($logResult);	
}

interface SessionInterface
{
	function __construct();
	function get($key);
	function set($key,$value);
	function isKeySet($key);
	function sessionRecreate();
	function clear();
}
