<?php
class tc_menulv0019
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function tc_menulv0019()
	{
		$this->itemlst=0;
		$this->childlst=0;
		$this->level3lst=0;
		$this->child3lst=0;
		$this->lang="EN";
		$this->Dir="";
	}
		function GetLink()
	{
		$strReturn="permit.php";
		switch ($this->level3lst)
		{
			case 0:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0020/tc_lv0020.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0020/tc_lv0020.php";
					break;
				
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0021/tc_lv0021.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0022/tc_lv0022.php";					
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0023/tc_lv0023.php";				
					break;
				}
				break;				
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0018/tc_lv0018.php";					
					break;
				}
				break;				
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0025/tc_lv0025.php";					
					break;
				}
				break;															
				
				
		}
		return $strReturn;
	}
	function GetLinkEmp()
	{
		$strReturn="permit.php";
		$this->child3lst=(int)$this->child3lst;
		switch ($this->level3lst)
		{
			case 0:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0020/tc_lv0020.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
					
				case 0:
					$strReturn=$this->Dir."tc_lv0020/tc_lv0020.php";
					break;
				
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0021/tc_lv0021.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0022/tc_lv0022.php";					
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0023/tc_lv0023.php";				
					break;
				}
				break;				
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0018/tc_lv0018.php";					
					break;
				}
				break;				
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0025/tc_lv0025.php";					
					break;
				}
				break;		
					
		}
		return $strReturn;
	}
	function GetGroupLink()
	{
		$vArrReturn= array();
		switch ($this->level3lst)
		{
			case 0:		
				break;
			case 1:
				break;
			case 2:
				$vArrReturn[0]="hr_empdependents/hr_empdependentslist.php";
				$vArrReturn[1]="hr_empchildren/hr_empchildrenlist.php";				
				break;
		}
		return $vArrReturn;
	}
		
}
?>