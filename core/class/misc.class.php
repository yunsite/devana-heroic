<?php

class misc
{
	public static function clean($data, $type=0)
	{
		global $db;
		if (is_array($data))
			foreach ($data as $key=>$value)
			{
				if (($type)&&($type=='numeric'))
					if (!is_numeric($value)) $value=0;
					else $value=floor(abs($value));
				$value=$db->real_escape_string($value);
				$data[$key]=htmlspecialchars($value);
			}
		else
		{
			if (($type)&&($type=='numeric'))
				if (!is_numeric($data)) $data=0;
				else $data=floor(abs($data));
			$data=$db->real_escape_string($data);
			$data=htmlspecialchars($data);
		}
		return $data;
	}
	public static function showMessage($message)
	{
		return '<div class="container" style="cursor: pointer;" onClick="this.style.display=\'none\'"><div class="message">'.$message.'</div></div>';
	}
	public static function newId($type)
	{
		global $db;
		$result=$db->query('select min(id) as id from free_ids where type="'.$type.'"');
		$id=db::fetch($result);
		if (isset($id['id']))
		{
			$db->query('delete from free_ids where id="'.$id['id'].'" and type="'.$type.'"');
			return $id['id'];
		}
		else
		{
			$result=$db->query('select max(id) as id from '.$type);
			$id=db::fetch($result);
			if (isset($id['id'])) return $id['id']+1;
			else return 1;
		}
	}
	public static function sToHMS($seconds)
	{
		$h=floor($seconds/3600);
		$m=floor($seconds%3600/60);
		$s=$seconds%3600%60;
		return array($h, $m, $s);
	}
	public static function microTime()
	{
		list($usec, $sec)=explode(" ", microtime());
		return ((float)$usec+(float)$sec);
	}
}

class flags
{
	public static function get($index)
	{
		global $db;
		$result=$db->query('select * from flags');
		$flags=array();
		if ($index=='name')
			while ($row=db::fetch($result)) $flags[$row['name']]=$row['value'];
		else
			for ($i=0; $row=db::fetch($result); $i++) $flags[$i]=$row;
		return $flags;
	}
	public static function set($name, $value)
	{
		global $db;
		$db->query('update flags set value="'.$value.'" where name="'.$name.'"');
		if ($db->affected_rows()>-1) $status='done';
		else $status='error';
		return $status;
	}
}
?>