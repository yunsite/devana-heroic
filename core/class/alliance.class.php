<?php
class alliance
{
	public $data, $members, $invitations, $wars;
	public function get($idType, $id)
	{
		global $db;
		$result=$db->query('select * from alliances where '.$idType.'="'.$id.'"');
		$this->data=db::fetch($result);
		if (isset($this->data['id'])) $status='done';
		else $status='noAlliance';
		return $status;
	}
	public function set($nodeId)
	{
		global $db, $game;
		$alliance=new alliance();
		if ($alliance->get('id', $this->data['id'])=='done')
			if ($alliance->get('name', $this->data['name'])=='noAlliance')
			{
				$node=new node();
				if ($node->get('id', $nodeId)=='done')
				{
					$node->getResources();
					$setCost=$game['factions'][$node->data['faction']]['costs']['alliance'];
					$setCostData=$node->checkCost($setCost, 'alliance');
					if ($setCostData['ok'])
					{
						$ok=1;
						foreach ($setCost as $cost)
						{
							$node->resources[$cost['resource']]['value']-=$cost['value']*$game['users']['cost']['alliance'];
							$db->query('update resources set value="'.$node->resources[$cost['resource']]['value'].'" where node="'.$node->data['id'].'" and id="'.$cost['resource'].'"');
							if ($db->affected_rows()==-1) $ok=0;
						}
						$db->query('update alliances set name="'.$this->data['name'].'" where id="'.$this->data['id'].'"');
						if ($db->affected_rows()==-1) $ok=0;
						if ($ok) $status='done';
						else $status='error';
					}
					else $status='notEnoughResources';
				}
				else $status='noNode';
			}
			else $status='nameTaken';
		else $status='noAlliance';
		return $status;
	}
	public function add($nodeId)
	{
		global $db, $game;
		$alliance=new alliance();
		if ($alliance->get('name', $this->data['name'])=='noAlliance')
		{
			$node=new node();
			if ($node->get('id', $nodeId)=='done')
			{
				$node->checkResources(time());
				$addCost=$game['factions'][$node->data['faction']]['costs']['alliance'];
				$addCostData=$node->checkCost($addCost, 'alliance');
				if ($addCostData['ok'])
				{
					$ok=1;
					foreach ($addCost as $cost)
					{
						$node->resources[$cost['resource']]['value']-=$cost['value']*$game['users']['cost']['alliance'];
						$db->query('update resources set value="'.$node->resources[$cost['resource']]['value'].'" where node="'.$node->data['id'].'" and id="'.$cost['resource'].'"');
						if ($db->affected_rows()==-1) $ok=0;
					}
					$this->data['id']=misc::newId('alliances');
					$db->query('insert into alliances (id, user, name) values ("'.$this->data['id'].'", "'.$node->data['user'].'", "'.$this->data['name'].'")');
					if ($db->affected_rows()==-1) $ok=0;
					$db->query('update users set alliance="'.$this->data['id'].'" where id="'.$this->data['user'].'"');
					if ($db->affected_rows()==-1) $ok=0;
					if ($ok) $status='done';
					else $status='error';
				}
				else $status='notEnoughResources';
			}
			else $status='noNode';
		}
		else $status='nameTaken';
		return $status;
	}
	public static function remove($id)
	{
		global $db;
		$alliance=new alliance();
		if ($alliance->get('id', $id)=='done')
		{
			$ok=1;
			$db->query('delete from invitations where alliance="'.$id.'"');
			if ($db->affected_rows()==-1) $ok=0;
			$db->query('delete from wars where sender="'.$id.'" or recipient="'.$id.'"');
			if ($db->affected_rows()==-1) $ok=0;
			$db->query('insert into free_ids (id, type) values ("'.$id.'", "alliances")');
			if ($db->affected_rows()==-1) $ok=0;
			$db->query('delete from alliances where id="'.$id.'"');
			if ($db->affected_rows()==-1) $ok=0;
			if ($ok) $status='done';
			else $status='error';
		}
		else $status='noAlliance';
		return $status;
	}
	public function getMembers()
	{
		global $db;
		$result=$db->query('select * from users where alliance="'.$this->data['id'].'"');
		$this->members=array();
		for ($i=0; $row=db::fetch($result); $i++) $this->members[$i]=$row;
	}
	public static function getInvitations($column, $id)
	{
		global $db;
		$result=$db->query('select * from invitations where '.$column.'="'.$id.'"');
		$invitations=array();
		for ($i=0; $row=db::fetch($result); $i++) $invitations[$i]=$row;
		return $invitations;
	}
	public function addInvitation($userId)
	{
		global $db;
		$user=new user();
		if ($user->get('id', $userId)=='done')
		{
			$result=$db->query('select count(*) as count from invitations where alliance="'.$this->data['id'].'" and user="'.$userId.'"');
			$row=db::fetch($result);
			if (!$row['count'])
			{
				$ok=1;
				$db->query('insert into invitations (alliance, user) values ("'.$this->data['id'].'", "'.$user->data['id'].'")');
				if ($db->affected_rows()==-1) $ok=0;
				if ($ok) $status='done';
				else $status='error';
			}
			else $status='invitationSet';
		}
		else $status='noUser';
		return $status;
	}
	public static function removeInvitation($allianceId, $userId)
	{
		global $db;
		$alliance=new alliance();
		if ($alliance->get('id', $allianceId)=='done')
		{
			$user=new user();
			if ($user->get('id', $userId)=='done')
			{
				$result=$db->query('select count(*) as count from invitations where alliance="'.$allianceId.'" and user="'.$userId.'"');
				$row=db::fetch($result);
				if ($row['count'])
				{
					$db->query('delete from invitations where alliance="'.$allianceId.'" and user="'.$userId.'"');
					if ($db->affected_rows()>-1) $status='done';
					else $status='error';
				}
				else $status='noEntry';
			}
			else $status='noUser';
		}
		else $status='noAlliance';
		return $status;
	}
	public static function acceptInvitation($allianceId, $userId)
	{
		global $db;
		$alliance=new alliance();
		if ($alliance->get('id', $allianceId)=='done')
		{
			$user=new user();
			if ($user->get('id', $userId)=='done')
				if (!$user->data['alliance'])
				{
					$result=$db->query('select count(*) as count from invitations where alliance="'.$allianceId.'" and user="'.$userId.'"');
					$row=db::fetch($result);
					if ($row['count'])
					{
						$ok=1;
						$db->query('update users set alliance="'.$allianceId.'" where id="'.$userId.'"');
						if ($db->affected_rows()==-1) $ok=0;
						$db->query('delete from invitations where alliance="'.$allianceId.'" and user="'.$userId.'"');
						if ($db->affected_rows()==-1) $ok=0;
						if ($ok) $status='done';
						else $status='error';
					}
					else $status='noEntry';
				}
				else $status='allianceSet';
			else $status='noUser';
		}
		else $status='noAlliance';
		return $status;
	}
	public function removeMember($userId)
	{
		global $db;
		$user=new user();
		if ($user->get('id', $userId)=='done')
		{
			$db->query('update users set alliance=0 where id="'.$userId.'"');
			if ($db->affected_rows()>-1) $status='done';
			else $status='error';
		}
		else $status='noUser';
		return $status;
	}
	public function getWars()
	{
		global $db;
		$result=$db->query('select * from wars where sender="'.$this->data['id'].'" or recipient="'.$this->data['id'].'"');
		$this->wars=array();
		for ($i=0; $row=db::fetch($result); $i++) $this->wars[$i]=$row;
	}
	public function getWar($allianceId)
	{
		global $db;
		$result=$db->query('select * from wars where type=1 and (sender="'.$this->data['id'].'" and recipient="'.$allianceId.'") or (sender="'.$allianceId.'" and recipient="'.$this->data['id'].'")');
		$row=db::fetch($result);
		return $row;
	}
	public function addWar($allianceId)
	{
		global $db;
		$alliance=new alliance();
		if ($alliance->get('id', $allianceId)=='done')
		{
			$result=$db->query('select count(*) as count from wars where type=1 and (sender="'.$this->data['id'].'" or recipient="'.$this->data['id'].'")');
			$row=db::fetch($result);
			if (!$row['count'])
			{
				$db->query('insert into wars (type, sender, recipient) values ("1", "'.$this->data['id'].'", "'.$alliance->data['id'].'")');
				if ($db->affected_rows()>-1) $status='done';
				else $status='error';
			}
			else $status='warSet';
		}
		else $status='noAlliance';
		return $status;
	}
	public function proposePeace($allianceId)
	{
		global $db;
		$alliance=new alliance();
		if ($alliance->get('id', $allianceId)=='done')
		{
			$result=$db->query('select count(*) as count from wars where type=1 and ((sender="'.$this->data['id'].'" and recipient="'.$alliance->data['id'].'") or (sender="'.$alliance->data['id'].'" and recipient="'.$this->data['id'].'"))');
			$row=db::fetch($result);
			if ($row['count'])
			{
				$result=$db->query('select count(*) as count from wars where type=0 and ((sender="'.$this->data['id'].'" and recipient="'.$alliance->data['id'].'") or (sender="'.$alliance->data['id'].'" and recipient="'.$this->data['id'].'"))');
				$row=db::fetch($result);
				if (!$row['count'])
				{
					$db->query('insert into wars (type, sender, recipient) values ("0", "'.$this->data['id'].'", "'.$alliance->data['id'].'")');
					if ($db->affected_rows()>-1) $status='done';
					else $status='error';
				}
				else $status='peaceSet';
			}
			else $status='noWar';
		}
		else $status='noAlliance';
		return $status;
	}
	public function removePeace($allianceId)
	{
		global $db;
		$alliance=new alliance();
		if ($alliance->get('id', $allianceId)=='done')
		{
			$result=$db->query('select count(*) as count from wars where type=0 and ((sender="'.$this->data['id'].'" and recipient="'.$alliance->data['id'].'") or (sender="'.$alliance->data['id'].'" and recipient="'.$this->data['id'].'"))');
			$row=db::fetch($result);
			if ($row['count'])
			{
				$db->query('delete from wars where type=0 and ((sender="'.$this->data['id'].'" and recipient="'.$alliance->data['id'].'") or (sender="'.$alliance->data['id'].'" and recipient="'.$this->data['id'].'"))');
				if ($db->affected_rows()>-1) $status='done';
				else $status='error';
			}
			else $status='noPeace';
		}
		else $status='noAlliance';
		return $status;
	}
	public function acceptPeace($allianceId)
	{
		global $db;
		$alliance=new alliance();
		if ($alliance->get('id', $allianceId)=='done')
		{
			$result=$db->query('select count(*) as count from wars where type=0 and sender="'.$alliance->data['id'].'" and recipient="'.$this->data['id'].'"');
			$row=db::fetch($result);
			if ($row['count'])
			{
				$ok=1;
				$db->query('delete from wars where type=1 and ((sender="'.$this->data['id'].'" and recipient="'.$alliance->data['id'].'") or (sender="'.$alliance->data['id'].'" and recipient="'.$this->data['id'].'"))');
				if ($db->affected_rows()==-1) $ok=0;
				$db->query('delete from wars where type=0 and sender="'.$alliance->data['id'].'" and recipient="'.$this->data['id'].'"');
				if ($db->affected_rows()==-1) $ok=0;
				if ($ok) $status='done';
				else $status='error';
			}
			else $status='noPeace';
		}
		else $status='noAlliance';
		return $status;
	}
	public function getAll()
	{
		$this->getMembers();
		$this->invitations=alliance::getInvitations('alliance', $this->data['id']);
		$this->getWars();
	}
}
?>