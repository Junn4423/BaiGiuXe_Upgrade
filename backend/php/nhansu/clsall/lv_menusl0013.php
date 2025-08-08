<?php
class lv_menusl0013
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function lv_menusl0013()
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
					$strReturn=$this->Dir."cr_lv0276/cr_lv0276.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0276/cr_lv0276.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0014/sl_lv0014.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0321/sl_lv0321.php";
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0322/sl_lv0322.php";
					break;
				}
				break;
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0043/cr_lv0043.php";
					break;
				}
				break;
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0324/sl_lv0324.php";
					break;
				}
				break;
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0329/sl_lv0329.php";
					break;
				}
				break;
			case 8:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0041/cr_lv0041.php";
					break;
				}
				break;
			case 9:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0113/cr_lv0113.php";
					break;
				}
				break;
			case 10:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0058/sl_lv0058.php";
					break;
				}
				break;
			case 11:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0021/sl_lv0021.php";
					break;
				}
				break;	
			case 12:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0277/cr_lv0277.php";
					break;
				}
				break;
			case 13:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0130/cr_lv0130.php";
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
					$strReturn=$this->Dir."cr_lv0276/cr_lv0276.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0276/cr_lv0276.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0014/sl_lv0014.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0321/sl_lv0321.php";
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0322/sl_lv0322.php";
					break;
				}
				break;
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0043/cr_lv0043.php";
					break;
				}
				break;
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0324/sl_lv0324.php";
					break;
				}
				break;
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0329/sl_lv0329.php";
					break;
				}
				break;
			case 8:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0041/cr_lv0041.php";
					break;
				}
				break;
			case 9:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0113/cr_lv0113.php";
					break;
				}
				break;
			case 10:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0058/sl_lv0058.php";
					break;
				}
				break;
			case 11:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0259/cr_lv0259-11.php";
					break;
				}
				break;	
			case 12:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0277/cr_lv0277.php";
					break;
				}
				break;
			case 13:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0130/cr_lv0130.php";
					break;
				}
				break;
			case 14:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0257/cr_lv0257.php";
					break;
				}
				break;			
			case 15:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0258/cr_lv0258-15.php";
					break;
				}
				break;		
			case 16:
				switch($this->child3lst)
				{
					case 0:
					$strReturn=$this->Dir."cr_lv0259/cr_lv0259-16.php";
					break;
				}
				break;		
			case 17:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."wh_lv0021/wh_lv0021-17.php";
					break;
				}
				break;	
			case 18:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0108/cr_lv0108-18.php";
					break;
				}
				break;	
			case 19:
				switch($this->child3lst)
				{
					case 0:
					$strReturn=$this->Dir."cr_lv0033/cr_lv0033-19.php";
					break;
				}
				break;	
			case 20:
				switch($this->child3lst)
				{
					case 0:
					$strReturn=$this->Dir."cr_lv0281/cr_lv0281-20.php";
					break;
				}
				break;	
			case 21:
				switch($this->child3lst)
				{
					case 0:
					$strReturn=$this->Dir."cr_lv0286/cr_lv0286-21.php";
					break;
				}
				break;	
			case 32:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0256/cr_lv0256-32.php";
					break;
				}
				break;
			case 33:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."cr_lv0306/cr_lv0306.php";
					break;
				}
				break;

		}
		return $strReturn;
	}	
}
?>