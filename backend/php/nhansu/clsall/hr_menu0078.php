<?php
class hr_menu0078
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function hr_menu0078()
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
					$strReturn=$this->Dir."hr_lv0079/hr_lv0079.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
					case 0:
					$strReturn=$this->Dir."hr_lv0079/hr_lv0079.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
					case 0:
					$strReturn=$this->Dir."hr_lv0080/hr_lv0080.php";
					break;				
				}
				break;		
			case 3:
				switch($this->child3lst)
				{
					case 0:
					$strReturn=$this->Dir."hr_lv0082/hr_lv0082.php";
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
					$strReturn=$this->Dir."hr_lv0079/hr_lv0079.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
					case 0:
					$strReturn=$this->Dir."hr_lv0079/hr_lv0079.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
					case 0:
					$strReturn=$this->Dir."hr_lv0080/hr_lv0080.php";
					break;				
				}
				break;		
			case 3:
				switch($this->child3lst)
				{
					case 0:
					$strReturn=$this->Dir."hr_lv0082/hr_lv0082.php";
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