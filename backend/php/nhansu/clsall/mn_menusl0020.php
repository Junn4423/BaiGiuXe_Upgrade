<?php
class mn_menusl0020
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function mn_menusl0020()
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
					$strReturn=$this->Dir."wh_lv0022/wh_lv0022.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."wh_lv0022/wh_lv0022.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0171/cr_lv0171.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."wh_lv0052/wh_lv0052.php";
					break;
				}
				break;	
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0020/sl_lv0020.php";
					break;
				}
				break;
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0176/cr_lv0176.php";
					break;
				}
				break;
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0324/cr_lv0324.php";
					break;
				}
				break;	
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0106/cr_lv0106.php";
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
					switch($this->TypePO)
					{
						case 2:
						case 3:
							$strReturn=$this->Dir."cr_lv0176/cr_lv0176.php";
							break;
						default:
							$strReturn=$this->Dir."wh_lv0022/wh_lv0022.php";
						break;
					}
					//$strReturn=$this->Dir."cr_lv0177/cr_lv0177-2.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					switch($this->TypePO)
					{
						case 2:
						case 3:
							$strReturn=$this->Dir."cr_lv0176/cr_lv0176.php";
							break;
						default:
							$strReturn=$this->Dir."wh_lv0022/wh_lv0022.php";
						break;
					}
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0171/cr_lv0171.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."wh_lv0052/wh_lv0052.php";
					break;
				}
				break;	
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0020/sl_lv0020.php";
					break;
				}
				break;
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0176/cr_lv0176.php";
					break;
				}
				break;
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0324/cr_lv0324.php";
					break;
				}
				break;	
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0108/cr_lv0108.php";
					break;
				}
				break;	
			case 8:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0202/cr_lv0202-8.php";
					break;
				}
				break;
			case 9:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0177/cr_lv0177-2.php";
					break;
				}
				break;
			case 10:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0340/cr_lv0340.php";
					break;
				}
				break;
			case 24:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0150/cr_lv0150-24.php";
					break;
				}
				break;
		}
		return $strReturn;
	}
}
?>