<?php

/**
* 
*/
class DD
{
	// echo a message
	public static function e($message)
	{
		echo '<pre>'.$message.'</pre>';
	}
	// stop
	public static function stop()
	{
		echo '<pre>stop!!!</pre>';
	}
	// print an array
	public static function a($data)
	{
		echo '<br />';
		print_r($data);
	}
}