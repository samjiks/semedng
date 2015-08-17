<?php
class Misc
{

public static function printdate($date)
{
	$date;
	try
	{
	  $sdate=explode("-",$date);
	  if(isset($sdate[2]))
		  $day=explode(" ",$sdate[2]);
	  else $day=array("00","00","00");
  
	  $time=array();
	  if(isset($day[1]))
		  $time=explode(":",$day[1]);
	  if(isset($time[1]))
		  $date=date("D M j, Y ", mktime($time[0], $time[1], $time[1], $sdate[1], $day[0], $sdate[0]));
	  else 
		  $date=date("D M j, Y ", mktime(0, 0, 0, $sdate[1], $sdate[2], $sdate[0]));
	  return $date;
	}
	catch(Exception $e)
	{
		
	}
	return $date;

}
public static function is_valid_email($email) {
  return preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $email);
}
}
?>