<?php
class activation
{
	public $data;
	public function get($user)
	{
		global $db;
		$result=$db->query('select * from activations where user="'.$user.'"');
		$this->data=db::fetch($result);
		if (isset($this->data['user'])) $status='done';
		else $status='noActivation';
		return $status;
	}
	public function add()
	{
		global $db;
		$db->query('insert into activations (user, code) values ("'.$this->data['user'].'", "'.$this->data['code'].'")');
		if ($db->affected_rows()>-1) $status='done';
		else $status='error';
		return $status;
	}
	public function activate($code)
	{
		global $db;
		if ($this->data['code']==$code)
		{
			$ok=1;
			$db->query('update users set level=level+1 where id="'.$this->data['user'].'"');
			if ($db->affected_rows()==-1) $ok=0;
			$db->query('delete from activations where user="'.$this->data['user'].'"');
			if ($db->affected_rows()==-1) $ok=0;
			if ($ok) $status='done';
			else $status='error';
		}
		else $status='wrongCode';
		return $status;
	}
}
?>