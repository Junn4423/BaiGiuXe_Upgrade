<?php
class hr_menuemployee
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function hr_menuemployee()
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
					$strReturn=$this->Dir."hr_lv0038/hr_lv0038.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0024/hr_lv0024.php";
					break;
				
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0026/hr_lv0026.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0027/hr_lv0027.php";					
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0038/hr_lv0038.php";					
					break;
				}
				break;	
			case 24:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0238/hr_lv0238.php";					
					break;
				}
				break;				
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0042/hr_lv0042.php";					
					break;
				}
				break;				
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0029/hr_lv0029.php";					
					break;
				}
				break;	
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0028/hr_lv0028.php";					
					break;
				}
				break;
			case 8:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0030/hr_lv0030.php";					
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
					$strReturn=$this->Dir."hr_lv0098/hr_lv0098.php";					
					break;
				}
				break;		
			case 16:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ts_lv0009/ts_lv0009_hr.php";					
					break;
				}
				break;	
			case 17:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ts_lv0011/ts_lv0011_hr.php";					
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
			case 15:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."employees/employeeinfo.php";					
					break;
				}
				break;	
			case 0:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0038/hr_lv0038.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0024/hr_lv0024.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0026/hr_lv0026.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0027/hr_lv0027.php";					
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0038/hr_lv0038.php";									
					break;
				}
				break;	
			case 24:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0238/hr_lv0238.php";					
					break;
				}
				break;					
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0042/hr_lv0042.php";					
					break;
				}
				break;				
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0029/hr_lv0029.php";					
					break;
				}
				break;	
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0028/hr_lv0028.php";					
					break;
				}
				break;
			case 8:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0030/hr_lv0030.php";					
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
					$strReturn=$this->Dir."hr_lv0098/hr_lv0098.php";				
					break;
				}
				break;
			case 16:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ts_lv0009/ts_lv0009_hr.php";					
					break;
				}
				break;	
			case 17:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ts_lv0011/ts_lv0011_hr.php";					
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
			
				break;
		}
		return $vArrReturn;
	}
		
}
?>