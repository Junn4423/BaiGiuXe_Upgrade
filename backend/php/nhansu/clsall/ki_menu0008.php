<?php
class ki_menu0008
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function ki_menu0008()
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
					$strReturn=$this->Dir."ki_lv0012/ki_lv0012.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
					case 0:
					$strReturn=$this->Dir."ki_lv0012/ki_lv0012.php";
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
					$strReturn=$this->Dir."ki_lv0012/ki_lv0012.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
					case 0:
					$strReturn=$this->Dir."ki_lv0012/ki_lv0012.php";
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
		}
		return $vArrReturn;
	}
		
}
?>