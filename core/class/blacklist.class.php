<?php
class blacklist
{
	public static function check($type, $value)
	{
		global $db;
		$result=$db->query('select count(*) as count from blacklist where type="'.$type.'" and value="'.$value.'"');
		$row=db::fetch($result);
		return $row['count'];
	}
	public static function get($type)
	{
		global $db;
		$result=$db->query('select * from blacklist where type="'.$type.'"');
		$blacklist=array();
		for ($i=0; $row=db::fetch($result); $i++) $blacklist[$i]=$row;
		return $blacklist;
	}
	public static function add($type, $value)
	{
		global $db;
		if (!blacklist::check($type, $value))
		{
			$db->query('insert into blacklist (type, value) values ("'.$type.'", "'.$value.'")');
			if ($db->affected_rows()>-1) $status='done';
			else $status='error';
		}
		else $status='duplicateEntry';
		return $status;
	}
	public static function remove($type, $value)
	{
		global $db;
		if (blacklist::check($type, $value))
		{
			$db->query('delete from blacklist where type="'.$type.'" and value="'.$value.'"');
			if ($db->affected_rows()>-1) $status='done';
			else $status='error';
		}
		else $status='noEntry';
		return $status;
	}
}
?>