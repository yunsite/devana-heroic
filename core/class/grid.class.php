<?php
class grid
{
	public $data=array();
	public function get($x, $y)
	{
		global $db;
		$result=$db->query('select * from grid where (y between '.($y-3).' and '.($y+3).')  and (x between '.($x-3).' and '.($x+3).') order by y desc, x asc');
		for ($i=0; $row=db::fetch($result); $i++) $this->data[$i]=$row;
	}
	public function getAll()
	{
		global $db;
		$result=$db->query('select * from grid order by y desc, x asc');
		for ($i=0; $row=db::fetch($result); $i++) $this->data[$i]=$row;
	}
	public static function getSector($x, $y)
	{
		global $db;
		$result=$db->query('select * from grid where x="'.$x.'" and y="'.$y.'"');
		$sector=db::fetch($result);
		return $sector;
	}
	public function getSectorImage($x, $y, &$i, $template)
	{
		global $shortTitle;
		if ((isset($this->data[$i]))&&($this->data[$i]['x']==$x)&&($this->data[$i]['y']==$y))
			if ($this->data[$i]['type']!=2)
			{
				$output='templates/'.$template.'/images/grid/env_'.$this->data[$i]['type'].$this->data[$i]['id'].'.png';
				if ($i<count($this->data)-1) $i++;
			}
			else
			{
				$output='templates/'.$template.'/images/grid/env_'.$this->data[$i]['type'].'2.png';
				if ($i<count($this->data)-1) $i++;
			}
		else $output='templates/'.$template.'/images/grid/env_x.png';
		return $output;
	}
	public function getSectorLink($x, $y, &$i)
	{
		if ((isset($this->data[$i]))&&($this->data[$i]['x']==$x)&&($this->data[$i]['y']==$y))
		{
			if ($this->data[$i]['type']!=2) $output='href="javascript: fetch(\'getGrid.php\', \'x='.$x.'&y='.$y.'\')" onMouseOver="setSectorData(labels['.$this->data[$i]['type'].'], \'-\', \'-\')" onMouseOut="setSectorData(\'-\', \'-\', \'-\')"';
			else
			{
				$node=new node(); $node->get('id', $this->data[$i]['id']);
				$user=new user(); $user->get('id', $node->data['user']);
				$alliancename = '-';
				if($user->data['alliance'])
				{
					$alliance=new alliance(); $alliance->get('user', $user->data['id']);
					$alliancename = $alliance->data['name'];
			}
				$output='href="javascript: fetch(\'getGrid.php\', \'x='.$x.'&y='.$y.'\')" onMouseOver="setSectorData(\''.$node->data['name'].'\', \''.$user->data['name'].'\', \''.$alliancename.'\')" onMouseOut="setSectorData(\'-\', \'-\', \'-\')"';
			}
			if ($i<count($this->data)-1) $i++;
		}
		else $output='href="javascript: fetch(\'getGrid.php\', \'x='.$x.'&y='.$y.'\')"';
		return $output;
	}
}
?>