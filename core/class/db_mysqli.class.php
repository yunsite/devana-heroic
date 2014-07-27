<?php
class db
{
	private $db;
	public	$qrynum;
	
	public	function create($dbHost, $dbUser,	$dbPass, $dbName,	$dbPcon)
	{
		if($dbPcon)
		{
			$this->db=new	mysqli('p:'.$dbHost, $dbUser,	$dbPass, $dbName);
		}
		else
		{
			$this->db=new mysqli($dbHost, $dbUser,	$dbPass, $dbName);
		}
		if ($this->db->connect_error)
		{
			die('Connect Error ('.$this->db->connect_errno .') '.$mysqli->connect_error);
		}
		//$this->db->query("set	global transaction isolation level serializable",	$this->db);
	}
	
	public	function query($query)
	{
		if ($result=$this->db->query($query))
		{
			$this->qrynum	++;
			return $result;
		}
		if($this->db->error)
		{
			try
			{		 
				throw	new	Exception("MySQL error ".$this->db->error."	<br> Query:<br>	$query", $this->db->errno);		 
			}
			catch(Exception	$e )
			{
				echo "Error	No:	".$e->getCode(). " - ".	$e->getMessage() . "<br	>";
				echo nl2br($e->getTraceAsString());
			}
		}
	}
	
	public	static function	fetch($result)
	{
		return $result->fetch_array(MYSQLI_ASSOC);
	}
	
	public	function real_escape_string($string)
	{
		return $this->db->real_escape_string($string);
	}
	
	public	function affected_rows()
	{
		return $this->db->affected_rows;
	}
	
	public	function	get_primary_id($table, $keyname = 'id')	//获得非自增主键的最适id
	{
		$min = array_shift(self::fetch($this->query("SELECT MIN(".$keyname.") FROM ".$table)));
		if (!$min) {
			$id = 1;
		}
		elseif ($min > 1)
		{
			$id = $min - 1;
		}
		else
		{
			$max = array_shift(self::fetch($this->query("SELECT MAX(".$keyname.") FROM ".$table)));
			$id = $max + 1;
		}
		return $id;
	}
}
?>