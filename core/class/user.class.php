<?php
class user
{
	public $data, $preferences, $blocklist;
	public function get($idType, $id)
	{
		global $db;
		$result=$db->query('select * from users where '.$idType.'="'.$id.'"');
		$this->data=db::fetch($result);
		if (isset($this->data['id'])) $status='done';
		else $status='noUser';
		return $status;
	}
	public function set()
	{
		global $db;
		$user=new user();
		if ($user->get('id', $this->data['id'])=='done')
		{
			$db->query('update users set name="'.$this->data['name'].'", password="'.$this->data['password'].'", email="'.$this->data['email'].'", level="'.$this->data['level'].'", joined="'.$this->data['joined'].'", lastVisit="'.$this->data['lastVisit'].'", ip="'.$this->data['ip'].'", alliance="'.$this->data['alliance'].'", template="'.$this->data['template'].'", locale="'.$this->data['locale'].'", sitter="'.$this->data['sitter'].'" where id="'.$this->data['id'].'"');
			if ($db->affected_rows()>-1) $status='done';
			else $status='error';
		}
		else $status='noUser';
		return $status;
	}
	public function add()
	{
		global $db, $game;
		$user=new user();
		if ($user->get('name', $this->data['name'])=='noUser')
			if ($user->get('email', $this->data['email'])=='noUser')
				if (!blacklist::check('ip', $this->data['ip']))
					if (!blacklist::check('email', $this->data['email']))
					{
						$ok=1;
						$this->data['id']=misc::newId('users');
						$db->query('insert into users (id, name, password, email, level, joined, lastVisit, ip, template, locale) values ("'.$this->data['id'].'", "'.$this->data['name'].'", "'.$this->data['password'].'", "'.$this->data['email'].'", "'.$this->data['level'].'", "'.$this->data['joined'].'", "'.$this->data['lastVisit'].'", "'.$this->data['ip'].'", "'.$this->data['template'].'", "'.$this->data['locale'].'")');
						if ($db->affected_rows()==-1) $ok=0;
						$preferences=array();
						foreach ($game['users']['preferences'] as $key=>$preference)
							$preferences[]='("'.$this->data['id'].'", "'.$key.'", "'.$preference.'")';
						$preferences=implode(', ', $preferences);
						$db->query('insert into preferences (user, name, value) values '.$preferences);
						if ($db->affected_rows()==-1) $ok=0;
						if ($ok) $status='done';
						else $status='error';
					}
					else $status='emailBanned';
				else $status='ipBanned';
			else $status='emailInUse';
		else $status='nameTaken';
		return $status;
	}
	public static function remove($id)
	{
		global $db;
		$user=new user();
		if ($user->get('id', $id)=='done')
		{
			$result=$db->query('select id from alliances where user="'.$id.'"');
			while ($row=db::fetch($result)) alliance::remove($row['id']);
			$result=$db->query('select id from nodes where user="'.$id.'"');
			while ($row=db::fetch($result)) node::remove($row['id']);
				$ok=1;
			$db->query('delete from activations where user="'.$id.'"');
			$db->query('delete from preferences where user="'.$id.'"');
			$db->query('delete from blocklist where to="'.$id.'" or from="'.$id.'"');
			$messagesResult=$db->query('select id from messages where recipient="'.$id.'" or sender="'.$id.'"');
			while ($row=db::fetch($messagesResult))
			{
				$db->query('insert into free_ids (id, type) values ("'.$row['id'].'", "messages")');
				if ($db->affected_rows()==-1) $ok=0;
				$db->query('delete from messages where id="'.$row['id'].'"');
				if ($db->affected_rows()==-1) $ok=0;
			}
			$db->query('insert into free_ids (id, type) values ("'.$id.'", "users")');
			if ($db->affected_rows()==-1) $ok=0;
			$db->query('delete from users where id="'.$id.'"');
			if ($db->affected_rows()==-1) $ok=0;
			if ($ok) $status='done';
			else $status='error';
		}
		else $status='noUser';
		return $status;
	}
	public static function removeInactive($maxIdleTime)
	{
		global $db;
		$fromWhen=time()-$maxIdleTime*86400;
		$fromWhen=strftime('%Y-%m-%d %H:%M:%S', $fromWhen);
		$usersResult=$db->query('select id from users where (lastVisit<"'.$fromWhen.'" or level=0) and level<2');
		$pendingCount=$removedCount=0;
		while ($userRow=db::fetch($usersResult))
		{
			$pendingCount++;
			$result=$db->query('select id from nodes where user="'.$userRow['id'].'"');
			while ($row=db::fetch($result)) node::remove($row['id']);
				$ok=1;
			$db->query('delete from activations where user="'.$userRow['id'].'"');
			$messagesResult=$db->query('select id from messages where recipient="'.$userRow['id'].'" or sender="'.$userRow['id'].'"');
			while ($row=db::fetch($messagesResult))
			{
				$db->query('insert into free_ids (id, type) values ("'.$row['id'].'", "messages")');
				if ($db->affected_rows()==-1) $ok=0;
				$db->query('delete from messages where id="'.$row['id'].'"');
				if ($db->affected_rows()==-1) $ok=0;
			}
			$db->query('insert into free_ids (id, type) values ("'.$userRow['id'].'", "users")');
			if ($db->affected_rows()==-1) $ok=0;
			$db->query('delete from users where id="'.$userRow['id'].'"');
			if ($db->affected_rows()==-1) $ok=0;
			if ($ok) $status='done';
			else $status='error';
			if ($ok) $removedCount++;
		}
		return array('found'=>$pendingCount, 'removed'=>$removedCount);
	}
	public function resetPassword($email, $newPass)
	{
		global $db, $game;
		if ($this->data['email']==$email)
			if (time()-strtotime($this->data['lastVisit'])>=$game['users']['passwordResetIdle']*60)
			{
				$this->data['lastVisit']=strftime('%Y-%m-%d %H:%M:%S', time());
				$db->query('update users set password=sha1("'.$newPass.'"), lastVisit="'.$this->data['lastVisit'].'" where id="'.$this->data['id'].'"');
				if ($db->affected_rows()>-1) $status='done';
				else $status='error';
			}
			else $status='tryAgain';
		else $status='wrongEmail';
		return $status;
	}
	public function getPreferences($index)
	{
		global $db;
		$result=$db->query('select * from preferences where user="'.$this->data['id'].'"');
		$this->preferences=array();
		if ($index=='name')
			while ($row=db::fetch($result)) $this->preferences[$row['name']]=$row['value'];
		else
			for ($i=0; $row=db::fetch($result); $i++) $this->preferences[$i]=$row;
	}
	public function setPreference($name, $value)
	{
		global $db;
		$db->query('update preferences set value="'.$value.'" where user="'.$this->data['id'].'" and name="'.$name.'"');
		if ($db->affected_rows()>-1) $status='done';
		else $status='error';
		return $status;
	}
	public function getBlocklist()
	{
		global $db;
		$result=$db->query('select * from blocklist where recipient="'.$this->data['id'].'"');
		$this->blocklist=array();
		$user=new user();
		for ($i=0; $row=db::fetch($result); $i++)
		{
			$this->blocklist[$i]=$row;
			if ($user->get('id', $this->blocklist[$i]['sender'])=='done') $this->blocklist[$i]['senderName']=$user->data['name'];
			else $this->blocklist[$i]['senderName']='[x]';
		}
	}
	public function isBlocked($recipient)
	{
		global $db;
		$result=$db->query('select count(*) as count from blocklist where recipient="'.$recipient.'" and sender="'.$this->data['id'].'"');
		$row=db::fetch($result);
		return $row['count'];
	}
	public function setBlocklist($name)
	{
		global $db;
		$user=new user();
		if ($user->get('name', $name)=='done')
		{
			$result=$db->query('select count(*) as count from blocklist where recipient="'.$this->data['id'].'" and sender="'.$user->data['id'].'"');
			$row=db::fetch($result);
			if ($row['count'])
				$db->query('delete from blocklist where recipient="'.$this->data['id'].'" and sender="'.$user->data['id'].'"');
			else
				$db->query('insert into blocklist (recipient, sender) values ("'.$this->data['id'].'", "'.$user->data['id'].'")');
			if ($db->affected_rows()>-1) $status='done';
			else $status='error';
		}
		else $status='noUser';
		return $status;
	}
}
?>