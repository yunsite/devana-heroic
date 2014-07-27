<?php
class message
{
	public $data;
	public function get($id)
	{
		global $db;
		$result=$db->query('select * from messages where id="'.$id.'"');
		$this->data=db::fetch($result);
		if (isset($this->data['id'])) $status='done';
		else $status='noMessage';
		return $status;
	}
	public function set()
	{
		global $db;
		$message=new message();
		if ($message->get($this->data['id'])=='done')
		{
			$db->query('update messages set viewed="'.$this->data['viewed'].'" where id="'.$this->data['id'].'"');
			if ($db->affected_rows()>-1) $status='done';
			else $status='error';
		}
		else $status='noMessage';
		return $status;
	}
	public function add()
	{
		global $db;
		$recipient=new user();
		if ($recipient->get('name', $this->data['recipient'])=='done')
		{
			$sender=new user();
			if ($sender->get('name', $this->data['sender'])=='done')
				if (!$sender->isBlocked($recipient->data['id']))
				{
					$this->data['id']=misc::newId('messages');
					$sent=strftime('%Y-%m-%d %H:%M:%S', time());
					$db->query('insert into messages (id, sender, recipient, subject, body, sent, viewed) values ("'.$this->data['id'].'", "'.$sender->data['id'].'", "'.$recipient->data['id'].'", "'.$this->data['subject'].'", "'.$this->data['body'].'", "'.$sent.'", "'.$this->data['viewed'].'")');
					if ($db->affected_rows()>-1) $status='done';
					else $status='error';
				}
				else $status='blocked';
			else $status='noSender';
		}
		else $status='noRecipient';
		return $status;
	}
	public static function remove($id)
	{
		global $db;
		$message=new message();
		if ($message->get($id)=='done')
		{
			$ok=1;
			$db->query('insert into free_ids (id, type) values ("'.$id.'", "messages")');
			if ($db->affected_rows()==-1) $ok=0;
			$db->query('delete from messages where id="'.$id.'"');
			if ($db->affected_rows()==-1) $ok=0;
			if ($ok) $status='done';
			else $status='error';
		}
		else $status='noMessage';
		return $status;
	}
	public static function removeAll($userId)
	{
		global $db;
		$result=$db->query('select id from messages where recipient="'.$userId.'"');
		$ok=1;
		while ($row=db::fetch($result))
		{
			$db->query('insert into free_ids (id, type) values ("'.$row['id'].'", "messages")');
			if ($db->affected_rows()==-1) $ok=0;
			$db->query('delete from messages where id="'.$row['id'].'"');
			if ($db->affected_rows()==-1) $ok=0;
		}
		if ($ok) $status='done';
		else $status='error';
		return $status;
	}
	public static function getList($recipient, $limit, $offset)
	{
		global $db;
		$messages=array();
		$messages['messages']=array();
		$result=$db->query('select count(*) as count from messages where recipient="'.$recipient.'"');
		$row=db::fetch($result);
		$messages['count']=$row['count'];
		$result=$db->query('select * from messages where recipient="'.$recipient.'" order by sent desc limit '.$limit.' offset '.$offset);
		for ($i=0; $row=db::fetch($result); $i++)
		{
			$messages['messages'][$i]=new message();
			$messages['messages'][$i]->data=$row;
		}
		return $messages;
	}
	public static function getUnreadCount($recipient)
	{
		global $db;
		$result=$db->query('select count(*) as count from messages where recipient="'.$recipient.'" and viewed=0');
		$row=db::fetch($result);
		return $row['count'];
	}
}
?>