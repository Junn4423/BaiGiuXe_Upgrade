<?php
class tc_menuemployee
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function tc_menuemployee()
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
					$strReturn=$this->Dir."tc_lv0007/tc_lv0007.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0007/tc_lv0007.php";
					break;
				
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0008/tc_lv0008.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0009/tc_lv0009.php";					
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0010/tc_lv0010.php";					
					break;
				}
				break;				
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0017/tc_lv0017.php";					
					break;
				}
				break;				
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0012/tc_lv0012.php";					
					break;
				}
				break;	
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0026/tc_lv0026.php";					
					break;
				}
				break;	
			case 8:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0046/tc_lv0046.php";					
					break;
				}
				break;	
			case 9:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0031/hr_lv0031.php";					
					break;
				}
				break;	
			case 10:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0033/hr_lv0033.php";					
					break;
				}
				break;	
			case 11:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0034/hr_lv0034.php";					
					break;
				}
				break;																
			case 12:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0036/hr_lv0036.php";					
					break;
				}
				break;						
			case 13:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0041/hr_lv0041.php";					
					break;
				}
				break;		
			case 14:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."emp_others/emp_otherspopup.php";					
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
					$strReturn=$this->Dir."tc_lv0007/tc_lv0007.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0007/tc_lv0007.php";
					break;
				
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0008/tc_lv0008.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0009/tc_lv0009.php";					
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0010/tc_lv0010.php";					
					break;
				}
				break;				
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0017/tc_lv0017.php";					
					break;
				}
				break;				
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0012/tc_lv0012.php";					
					break;
				}
				break;		
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0026/tc_lv0026.php";					
					break;
				}
				break;		
			case 8:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."tc_lv0046/tc_lv0046.php";					
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