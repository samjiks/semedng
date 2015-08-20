<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Model_CModel extends Model 
{
protected $instance_name="default";
	public $db_link;
	protected static $db;
	private $handle;
	public function __construct()
	{
			$this->db_link=Database::instance($this->instance_name);
		  parent::__construct();
	}
	function backup_tables($host,$user,$pass,$name,$file,$tables = '*')
	{
	  $return="";
	  $link = mysql_connect($host,$user,$pass);
	  mysql_select_db($name,$link);
	  
	  //get all of the tables
	  if($tables == '*')
	  {
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
		  $tables[] = $row[0];
		}
	  }
	  else
	  {
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	  }
	  
	  //cycle through
	  foreach($tables as $table)
	  {
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
		  while($row = mysql_fetch_row($result))
		  {
			$return.= 'INSERT INTO '.$table.' VALUES(';
			for($j=0; $j<$num_fields; $j++) 
			{
			  $row[$j] = addslashes($row[$j]);
			  $row[$j] = str_replace("\n","\\n",$row[$j]);
			  if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
			  if ($j<($num_fields-1)) { $return.= ','; }
			}
			$return.= ");\n";
		  }
		}
		$return.="\n\n\n";
	  }
	  
	  //save file
	  //$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	  $handle = fopen("backup/$file",'w+');
	  fwrite($handle,$return);
	  fclose($handle);
	}
	
	/*$ccyymmdd = date("Ymd");
  $file = fopen("backup".$ccyymmdd.".sql","w");
  $line_count = create_backup_sql($file);
  fclose($file);*/


  function create_backup_sql($file) {
    $line_count = 0;
    $db_connection = db_connect();
    mysql_select_db (db_name()) or exit();
    $tables = mysql_list_tables(db_name());
    $sql_string = NULL;
    while ($table = mysql_fetch_array($tables)) {   
      $table_name = $table[0];
      $sql_string = "DELETE FROM $table_name";
      $table_query = mysql_query("SELECT * FROM `$table_name`");
      $num_fields = mysql_num_fields($table_query);
      while ($fetch_row = mysql_fetch_array($table_query)) {
        $sql_string .= "INSERT INTO $table_name VALUES(";
        $first = TRUE;
        for ($field_count=1;$field_count<=$num_fields;$field_count++){
          if (TRUE == $first) {
            $sql_string .= "'".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
            $first = FALSE;            
          } else {
            $sql_string .= ", '".mysql_real_escape_string($fetch_row[($field_count - 1)])."'";
          }
        }
        $sql_string .= ");";
        if ($sql_string != ""){
          $line_count = write_backup_sql($file,$sql_string,$line_count);        
        }
        $sql_string = NULL;
      }    
    }
    return $line_count;
  }


  function write_backup_sql($file, $string_in, $line_count) { 
    fwrite($file, $string_in);
    return ++$line_count;
  }
	// LET'S RESTORE OUR DATABASE
	
  function load_backup_sql($host,$user,$pass,$db,$file) {
    $line_count = 0;
    $db_connection = mysql_connect("$host", "$user", "$pass");
    mysql_select_db ("$db") or exit();
	$query=file_get_contents($file);
    /*$line_count = 0;
    while (!feof($file)) {
      $query = NULL;
      while (!feof($file)) {
        $query .= fgets($file);
      }
      if (NULL != $query) {
        $line_count++;
        
      }
    }  
    return $line_count;*/
	mysql_query($query) or die("sql not successful: ".mysql_error());
  }
  
  	public function sync($host,$user,$pass,$name,$file,$tables = '*',$location)
	{
	  $return="";
	  $link = mysql_connect($host,$user,$pass);
	  mysql_select_db($name,$link);
	  
	  //get all of the tables
	  
	$tables = is_array($tables) ? $tables : explode(',',$tables);
	  
	  //cycle through
	  foreach($tables as $table)
	  {
	  	if($table=="")
			continue;
			
		$result = mysql_query("SELECT * FROM `$table`");
		if($table=="account" OR $table=="hotelfloor"):
			$return.="DELETE FROM `$table` WHERE ownerid='$location';\n";
		else:
		 	$return.="DELETE FROM `$table` WHERE locationid='$location';\n";
		endif;
		$num_fields = mysql_num_fields($result);
				
		for ($i = 0; $i < $num_fields; $i++) 
		{
		  while($row = mysql_fetch_row($result))
		  {
			$return.= 'INSERT INTO `'.$table.'` VALUES(';
			for($j=0; $j<$num_fields; $j++) 
			{
			  $row[$j] = addslashes($row[$j]);
			  $row[$j] = ereg_replace("\n","\\n",$row[$j]);
			  if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
			  if ($j<($num_fields-1)) { $return.= ','; }
			}
			$return.= ");\n";
		  }
		}
		$return.="\n\n\n";
	  }
	  $handle = fopen("backup/$file",'w+');
	  fwrite($handle,$return);
	  fclose($handle);
	}
  

}

?>