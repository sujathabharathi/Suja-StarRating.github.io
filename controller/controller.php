<?php
require_once '../lib/db.php';
require_once '../model/sessionsmgt.php';

class Controller
{
	public function __construct()
	{
		
	}
	public function connection()
	{
		session_save_path('../sessions');
		session_start();
		$session = new Session();
		include_once '../lib/MYSQLDB.php';
		require_once '../lib/db.php';
		require_once '../model/tableMaker.php';
		require_once '../model/chartMaker.php';
		require_once '../model/alltables.php';
		require_once '../lib/myFunctions.php';
    }
	
}