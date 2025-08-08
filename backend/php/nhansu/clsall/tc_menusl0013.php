<?php
class tc_menusl0013
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function tc_menusl0013()
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
					$strReturn=$this->Dir."tc_lv0014/tc_lv0014.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0014/tc_lv0014.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0015/tc_lv0015.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0025/tc_lv0025.php";
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0031/tc_lv0031.php";
					break;
				}
				break;
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0064/tc_lv0064.php";
					break;
				}
				break;
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0009/inputlist.php";
					break;
				}
				break;
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0047/tc_lv0047.php";
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
					$strReturn=$this->Dir."cr_lv0202/cr_lv0202-31.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0014/tc_lv0014.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0015/tc_lv0015.php";
					break;
				}
				break;	
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0025/tc_lv0025.php";
					break;
				}
				break;		
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0031/tc_lv0031.php";
					break;
				}
				break;
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0064/tc_lv0064.php";
					break;
				}
				break;
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0009/inputlist.php";
					break;
				}
				break;
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0047/tc_lv0047.php";
					break;
				}
				break;
			case 8:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0021/tc_lv0021.php";
					break;
				}
				break;
			case 31:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0202/cr_lv0202-31.php";
					break;
				}
				break;
			case 32:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ac_lv0019/ac_lv0019-32.php";
					break;
				}
				break;	
			case 33:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0339/cr_lv0339.php";
					break;
				}
				break;	
			case 15:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0097/tc_lv0097.php";
					break;
				}
				break;
		}
		return $strReturn;
	}
}
?>