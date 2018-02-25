<?php
include_once '../interface/interfaces.php';
class Session implements SessionInterface
{
	function __construct()
	{
		$timestamp = time();
		if($this->isKeySet('lastAccess')){
			$timeSinceLstAccess = $timestamp - $this->get('lastAccess');
			if($timeSinceLstAccess >60*15){
				$this->clear();
				// throw new PageExpiredException("Session has expired!");
				$this->sessionRecreate();	
			}
	}
	$this->set('lastAccess',$timestamp);
	}
	
	function get($key){
		return $_SESSION[$key];
	}
	
	function set($key,$value){
		$_SESSION[$key]=$value;
	}
	
	function isKeySet($key){
		return isset ($_SESSION[$key]);
	}

	function sessionRecreate(){
		session_regenerate_id(true);
		header('Location:index.php' );	
	}
	function clear()
	{
		foreach($_SESSION as $key=>$value){
			unset($_SESSION[$key]);
		}
		session_destroy();
	}
	
}