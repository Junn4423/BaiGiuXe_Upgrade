<?php
class ml_menusl0011
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function ml_menusl0011()
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
					$strReturn=$this->Dir."ml_lv0011/viewmsg.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ml_lv0011/viewmsg.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ml_lv0011/view.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ml_lv0010/ml_lv0010.php";
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ml_lv0011/viewhtlm.php";
					break;
				}
				break;
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ml_lv0011/viewforward.php";
					break;
				}
				break;
			case 15:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ml_lv0010/ml_lv0010.php";
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
					$strReturn=$this->Dir."ml_lv0011/viewmsg.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ml_lv0011/viewmsg.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ml_lv0011/view.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ml_lv0010/ml_lv0010.php";
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ml_lv0011/viewhtlm.php";
					break;
				}
				break;
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ml_lv0011/viewforward.php";
					break;
				}
				break;
			case 15:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ml_lv0010/ml_lv0010.php";
					break;
				}
				break;
		}
		return $strReturn;
	}

}
?>