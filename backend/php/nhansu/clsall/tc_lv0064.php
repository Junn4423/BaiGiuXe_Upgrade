<?php
/////////////coding tc_lv0064///////////////
class   tc_lv0064 extends lv_controler
{
	public $lv001=null;
	public $lv002=null;
	public $lv003=null;
	public $lv004=null;
	public $lv005=null;
	public $lv006=null;
	public $lv007 =null;
	public $lv010 =null;
	public $lv011 =null; 
	 
	
	
	
	 
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv099,lv004,lv008,lv009,lv005";	
	//public $DefaultFieldList="lv001,lv002,lv003,lv099,lv004,lv008,lv009,lv005,lv006,lv007,lv010,lv011,lv012";	
////////////////////GetDate
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='tc_lv0064';
	public $Dir="";
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv099"=>'100');
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"2","lv009"=>"2","lv010"=>"0","lv011"=>"0","lv012"=>"0","lv099"=>0);	
	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ=="; 
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;	
	 	$this->isFil=1;	
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];
		
	}
	protected function LV_CheckLock()
	{
		$lvsql="select lv011 from tc_lv0013 B where  B.lv001='$this->lv002'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv011']>=2)
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_Load()
	{
		$vsql="select * from  tc_lv0064";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			$this->lv011=$vrow['lv011'];
			$this->lv012=$vrow['lv012'];
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  tc_lv0064 Where lv001='$vlv001'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			$this->lv011=$vrow['lv011'];
			$this->lv012=$vrow['lv012'];		
		}
	}
	function LV_LoadCurrentID($vlv002,$vlv003)
	{
		$lvsql="select * from  tc_lv0064 Where lv002='$vlv002' and lv003='$vlv003'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];	
			$this->lv010=$vrow['lv010'];
			$this->lv011=$vrow['lv011'];
			$this->lv012=$vrow['lv012'];		
		}
	}
	function LV_LoadTemplate($vlv001)
	{
		
		$strReturn="";
		$lvsql="select A.*,B.lv007 lv014 from  tc_lv0064 A left join hr_lv0044 B on A.lv002=B.lv001 Where A.lv001='$vlv001'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			$this->lv011=$vrow['lv011'];
			$this->lv012=$vrow['lv012'];			
		}
		return $strReturn;
	}
	function LV_Insert()
	{
		if($this->isAdd==0) return false;
		$this->lv008 = ($this->lv008!="")?recoverdate(($this->lv008), $this->lang):$this->DateDefault;
		$this->lv009 = ($this->lv009!="")?recoverdate(($this->lv009), $this->lang):$this->DateDefault;
		$lvsql="insert into tc_lv0064 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0064.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_InsertAuto()
	{
		if($this->isAdd==0) return false;
		$this->lv008 = ($this->lv008!="")?recoverdate(($this->lv008), $this->lang):$this->DateDefault;
		$this->lv009 = ($this->lv009!="")?recoverdate(($this->lv009), $this->lang):$this->DateDefault;
		$lvsql="insert into tc_lv0064 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0064.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_InsertAutoNoDate()
	{
		$lvsql="insert into tc_lv0064 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0064.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UpdateNoDate()
	{
		$this->LV_CheckLock();
		if($this->isEdit==0) return false;
		 $lvsql="Update tc_lv0064 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0064.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Update()
	{
		$this->LV_CheckLock();
		if($this->isEdit==0) return false;
		$this->lv008 = ($this->lv008!="")?recoverdate(($this->lv008), $this->lang):$this->DateDefault;
		$this->lv009 = ($this->lv009!="")?recoverdate(($this->lv009), $this->lang):$this->DateDefault;
		 $lvsql="Update tc_lv0064 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0064.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM tc_lv0064  WHERE tc_lv0064.lv001 IN ($lvarr) and (select lv011 from tc_lv0013 B where  B.lv001= tc_lv0064.lv002)<=1";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0064.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Aproval($vCalID='')
	{
		$this->LV_CheckLock();
		if($this->isApr==0) return false;
		$lvsql="delete from tc_lv0064 where lv002='$vCalID'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$this->InsertLogOperation($this->DateCurrent,'tc_lv0064.delete',sof_escape_string($lvsql));
			$this->objtc_lv0013->LV_LoadID($vCalID);
			//$vDateFrom=$this->objtc_lv0013->lv007."-".$this->objtc_lv0013->lv006."-".GetDayInMonth($this->objtc_lv0013->lv007,$this->objtc_lv0013->lv006);
			$lvsql="insert into tc_lv0064(lv002,lv003,lv004,lv005,lv008,lv009) select '$vCalID',A.lv001,A.lv029,A.lv009,'".$this->objtc_lv0013->lv004."','".$this->objtc_lv0013->lv005."' from hr_lv0020 A where A.lv009 not in (2,3) and A.lv030<='".$this->objtc_lv0013->lv005."'";
			$vReturn= db_query($lvsql);
			if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0064.insert',sof_escape_string($lvsql));
			$lvsql="insert into tc_lv0064(lv002,lv003,lv004,lv005,lv008,lv009) select '$vCalID',A.lv001,A.lv029,A.lv009,'".$this->objtc_lv0013->lv004."','".$this->objtc_lv0013->lv005."' from hr_lv0020 A where A.lv009 in (2,3) and year(A.lv044)='".$this->objtc_lv0013->lv007."' and month(A.lv044)='".$this->objtc_lv0013->lv006."'";
			$vReturn= db_query($lvsql);
			if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0064.insert',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_AutoInsertNV($vListNV,$vCalID,$vStartDate='',$vEndDate='')
	{
		$lvsql="insert into tc_lv0064(lv002,lv003,lv004,lv005,lv008,lv009) select '$vCalID',A.lv001,A.lv029,A.lv009,'$vStartDate','$vEndDate' from hr_lv0020 A where A.lv001 in ($vListNV) and A.lv001 not in (select B.lv003 from tc_lv0064 B where B.lv002='$vCalID') ";
		$vReturn= db_query($lvsql);
		//if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0064.insert',sof_escape_string($lvsql));
	}
	function LV_UnAproval($vCalID)
	{
		$this->LV_CheckLock();
		if($this->isApr==0) return false;
		$vlistEmp=$this->GetMultiValue("select BB.lv003 lv001  from tc_lv0064 BB where BB.lv002='$vCalID'");
		
		$this->objtc_lv0013->LV_LoadID($vCalID);
		//$vDateFrom=$this->objtc_lv0013->lv007."-".$this->objtc_lv0013->lv006."-".GetDayInMonth($this->objtc_lv0013->lv007,$this->objtc_lv0013->lv006);
		$lvsql="insert into tc_lv0064(lv002,lv003,lv004,lv005,lv008,lv009) select '$vCalID',A.lv001,A.lv029,A.lv009,'".$this->objtc_lv0013->lv004."','".$this->objtc_lv0013->lv005."' from hr_lv0020 A where A.lv009 not in (2,3) and A.lv030<='".$this->objtc_lv0013->lv005."' and A.lv001 not in ($vlistEmp)";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0064.insert',sof_escape_string($lvsql));
		$lvsql="insert into tc_lv0064(lv002,lv003,lv004,lv005,lv008,lv009) select '$vCalID',A.lv001,A.lv029,A.lv009,'".$this->objtc_lv0013->lv004."','".$this->objtc_lv0013->lv005."' from hr_lv0020 A where A.lv009 in (2,3) and year(A.lv044)='".$this->objtc_lv0013->lv007."' and month(A.lv044)='".$this->objtc_lv0013->lv006."'  and A.lv001 not in ($vlistEmp)";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0064.insert',sof_escape_string($lvsql));
		return $vReturn;
	}
	function GetMultiValue($sqlS)
	{
		$lv_str="";
		$bResult = db_query($sqlS);
		while ($vrow = db_fetch_array ($bResult)){	
			if($lv_str=="")
				$lv_str=$vrow['lv001'];
			else
				$lv_str=$lv_str."','".$vrow['lv001'];
		}
		$lv_str="'".$lv_str."'";
		return $lv_str;
	}
	function LV_AlarmDeptTwoo($vCalID)
	{
		$sqlS="select A.lv003 from tc_lv0064 A where A.lv002='$vCalID' group by A.lv003 having  count(A.lv003)>1";
		$bResult = db_query($sqlS);
		while ($vrow = db_fetch_array ($bResult)){	
			if($lv_str=="")
				$lv_str=$vrow['lv003'];
			else
				$lv_str=$lv_str.",".$vrow['lv003'];
		}
		return $lv_str;
	}
	//Điều khiển đổi phòng ban
	function LV_ControlChangeDept($vCalID,$vStaffID,$vDepNewID,$vDepOldID,$vDateChange,$vStartDate,$vEndDate)
	{
		//Xác định phòng ban hiện tại và phòng ban mới có đổi không
		if($vDepNewID!=$vDepOldID)
		{
			//Nếu đổi thì xứ lý các vấn đề sau.
			//Kiểm tra xem phòng ban chưa tạo thì tạo
			//echo "$vCalID,$vStaffID,$vDepNewID,$vDateChange";
			$vCheckExist=$this->LV_CheckExistChange($vCalID,$vStaffID,$vDepNewID,$vDateChange,3);
			if($vCheckExist=='')
			{
				$this->lv002=$vCalID;
				$this->lv003=$vStaffID;
				$this->lv004=$vDepNewID;
				$this->lv008=$vDateChange;
				$this->lv009=$vEndDate;
				$vReturn=$this->LV_InsertAutoNoDate();//Tạo cho đổi phòng ban mới
				//Kiểm tra tồn tại đổi phòng ban
				//xem nhan vien do co chua?
				$vCheckExist=$this->LV_CheckExistChange($vCalID,$vStaffID,$vDepOldID,$vStartDate,1);
				if(getday($vDateChange)!=1) $vDateChange=ADDDATE($vDateChange,-1);
				if($vCheckExist=='')
				{
					$this->lv002=$vCalID;
					$this->lv003=$vStaffID;
					$this->lv004=$vDepOldID;
					$this->lv008=$vStartDate;
					$this->lv009=$vDateChange;
					$this->LV_InsertAutoNoDate();
				}
				else
				{
					$this->lv001=$vCheckExist;
					$this->lv002=$vCalID;
					$this->lv003=$vStaffID;
					$this->lv004=$vDepOldID;
					$this->lv008=$vStartDate;
					$this->lv009=$vDateChange;
					$this->LV_UpdateNoDate();
				}
			}	
			else
			{
				//Nếu co trong day
				$vCheckExist=$this->LV_CheckExistChange($vCalID,$vStaffID,$vDepNewID,$vDateChange,1);
				if($vCheckExist=='')
				{
					$this->lv002=$vCalID;
					$this->lv003=$vStaffID;
					$this->lv004=$vDepNewID;
					$this->lv008=$vDateChange;
					$this->lv009=$vEndDate;
					$vReturn=$this->LV_InsertAutoNoDate();//Tạo cho đổi phòng ban mới
					//Kiểm tra tồn tại đổi phòng ban
					$vCheckExist=$this->LV_CheckExistChange($vCalID,$vStaffID,$vDepOldID,$vStartDate,1);
					if(getday($vDateChange)!=1) $vDateChange=ADDDATE($vDateChange,-1);
					if($vCheckExist=='')
					{
						$this->lv002=$vCalID;
						$this->lv003=$vStaffID;
						$this->lv004=$vDepOldID;
						$this->lv008=$vStartDate;
						$this->lv009=$vDateChange;
						$this->LV_InsertAutoNoDate();
					}
					else
					{
						$this->lv001=$vCheckExist;
						$this->lv002=$vCalID;
						$this->lv003=$vStaffID;
						$this->lv004=$vDepOldID;
						$this->lv008=$vStartDate;
						$this->lv009=$vDateChange;
						$this->LV_UpdateNoDate();
					}
				}	
				else
				{
					//Kiểm tra tồn tại đổi phòng ban cũ, nếu chưa có tạo
					$vCheckExistTemp=$vCheckExist;
					$vCheckExist=$this->LV_CheckExistChange($vCalID,$vStaffID,$vDepOldID,$vStartDate,2);
					if($vCheckExist=='')
					{
						$this->lv001=$vCheckExistTemp;
						$this->lv002=$vCalID;
						$this->lv003=$vStaffID;
						$this->lv004=$vDepOldID;
						$this->lv008=$vStartDate;
						$this->lv009=$vDateChange;
						$this->LV_UpdateNoDate();
					}
					
				}
				
			}
			//xét có tồn tại phòng ban đã đổi chưa, chưa thì chọn vào.
			//Nếu có tồn tại, thì xem có trùng lắp thời gian không, nếu không thì chèn vào, nếu có thì sửa lại
		}
		else
		{
			//Kiểm tra xem phòng ban chưa tạo thì tạo
			$vCheckExist=$this->LV_CheckExistChange($vCalID,$vStaffID,$vDepNewID,$vStartDate,1);
			if($vCheckExist=='')
			{
				$this->lv002=$vCalID;
				$this->lv003=$vStaffID;
				$this->lv004=$vDepNewID;
				$this->lv008=$vStartDate;
				$this->lv009=$vEndDate;
				$this->LV_InsertAutoNoDate();
			}	
		}
		

	}
	function LV_CheckExistChange($vCalID,$vStaffID,$vDeptID,$vDateChange,$vOpt=0)
	{
		if($vOpt==0)
			$sqlC = "SELECT lv001 FROM tc_lv0064 WHERE lv002='$vCalID' and lv003='$vStaffID'  and lv008='$vDateChange'";
		elseif($vOpt==2)
			$sqlC = "SELECT lv001 FROM tc_lv0064 WHERE lv002='$vCalID' and lv003='$vStaffID' and lv004='$vDeptID'  and lv008='$vDateChange'";
		elseif($vOpt==3)
			$sqlC = "SELECT lv001 FROM tc_lv0064 WHERE lv002='$vCalID' and lv003='$vStaffID'";
		else
			$sqlC = "SELECT lv001 FROM tc_lv0064 WHERE lv002='$vCalID' and lv003='$vStaffID'  and lv004='$vDeptID'";
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		if($arrRowC)
		return $arrRowC['lv001'];
		return '';
	}
	//////////get view///////////////
	function GetView()
	{
		return $this->isView;
	}//////////get view///////////////
	function GetRpt()
	{
		return $this->isRpt;
	}
	//////////get view///////////////
	function GetAdd()
	{
		return $this->isAdd;
	}	
	//////////get edit///////////////
	function GetEdit()
	{
		return $this->isEdit;
	}	
	//////////get edit///////////////
	function GetApr()
	{
		return $this->isApr;
	}		
	//////////get edit///////////////
	function GetUnApr()
	{
		return $this->isUnApr;
	}	
	//////////Get Filter///////////////
	protected function GetCondition()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and lv001 like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002 like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003 like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004 like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005 like '%$this->lv005%'";
		return $strCondi;
	}
		////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0064 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
			//////////////////////Buil list////////////////////
	function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		if($curRow<0) $curRow=0;	$this->LV_CheckLock();
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$strSort="";
		switch($lvSortNum)
		{
			case 0:
				break;
			case 1:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"asc");
				break;
			case 2:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"desc");
				break;
		}
		$lvTable="
		<table  align=\"center\" class=\"lvtable\">
		<!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		<tr class=\"cssbold_tab\"><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</td></tr>
		@#01
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
		<tr class=\"cssbold_tab\"><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</td></tr>
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			<td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>
			@#01
		</tr>
		";
		$lvHref="<a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\">@02</a>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT *,lv003 lv099 FROM tc_lv0064 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv009']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
/////////////////////ListFieldExport//////////////////////////
	function ListFieldExport($lvFrom,$lvList,$maxRows)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvSelect="<ul id=\"menu1-nav\" onkeyup=\"return CheckKeyCheckTabExp(event)\">
						<li class=\"menusubT1\"><img src=\"$this->Dir../images/lvicon/config.png\" border=\"0\" />".$this->ArrFunc[12]."
							<ul id=\"submenu1-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function Export(vFrom,value)
		{
			window.open('$this->Dir'+'tc_lv0064/?lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
		}
	
		
		</script>
";
		$lvScript="<li class=\"menuT\"> @01 </li>";
		$lvexcel="<input class=lvbtdisplay type=\"button\" id=\"lvbuttonexcel\" value=\"".$this->ArrFunc[13]."\" onclick=\"Export($lvFrom,'excel')\">";
		$lvpdf="<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"".$this->ArrFunc[15]."\" onclick=\"Export($lvFrom,'pdf')\">";
		$lvword="<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"".$this->ArrFunc[14]."\" onclick=\"Export($lvFrom,'word')\">";
		$strGetList="";
		$strGetScript="";
		
		$strTemp=str_replace("@01",$lvexcel,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvword,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvpdf,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strReturn=str_replace("@#01",$strGetScript,$lvSelect).$strScript;
		return $strReturn;
		
	}
	/////////////////////ListFieldSave//////////////////////////
	function ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrder,$lvSortNum)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvArrOrder=explode(",",$lvOrder);
		$lvSelect="<ul id=\"menu-nav\" onkeyup=\"return CheckKeyCheckTab(event,$lvFrom,".count($lstArr).")\">
						<li class=\"menusubT\"><img src=\"$this->Dir../images/lvicon/config.png\" border=\"0\" />".$this->ArrFunc[11]."
							<ul id=\"submenu-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function SelectChk(vFrom,len)
		{
			vFrom.txtFieldList.value=getChecked(len,'lvdisplaychk');
			vFrom.txtOrderList.value=getAlllen(len,'lvorder');
			vFrom.txtFlag.value=2;
			vFrom.submit();
		}
		function lv_on_open(opt)
		{
			div = document.getElementById('lvsllist');
			if(opt==0)
			{
				div.size=1;
			}
			else
				div.size=div.length;
			
		}
		function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{

				if(str=='') 
					str=''+div.value;
				else
					 str=str+','+div.value;

				}
			}
			return str;
		}
		function getAlllen(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
				div = document.getElementById(nameobj+i);
				if(str=='') 
					str=''+div.value;
				else
					 str=str+','+div.value;
			}
			return str;
		}
		</script>
";
		$lvScript="<li class=\"menuT\"> @01 </li>";
		$lvNumPage="".$this->ArrOther[2]."<input type=\"text\" class=\"lvmaxrow\" name=lvmaxrow id=lvmaxrow value=\"$maxRows\">";
		$lvSortPage="".GetLangSort(0,$this->lang)."<select class=\"lvsortrow\" name=lvsort id=lvsort >
				<option value=0 ".(($lvSortNum==0)?'selected':'').">".GetLangSort(1,$this->lang)."</option>
				<option value=1 ".(($lvSortNum==1)?'selected':'').">".GetLangSort(2,$this->lang)."</option>
				<option value=2 ".(($lvSortNum==2)?'selected':'').">".GetLangSort(3,$this->lang)."</option>
		</select>";
		$lvChk="<input type=\"checkbox\" id=\"lvdisplaychk@01\" name=\"lvdisplaychk@01\" value=\"@02\" @03><input id=\"lvorder@01\" name=\"lvorder@01\"  type=\"text\" value=\"@06\"\ style=\"width:20px\" >";
		$lvButton="<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"".$this->ArrOther[1]."\" onclick=\"SelectChk($lvFrom,".count($lstArr).")\">";
		$strGetList="";
		$strGetScript="";
		$strTemp=str_replace("@01",$lvButton,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvNumPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
				$strTemp=str_replace("@01",$lvSortPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		
		for ($i=0;$i<count($lstArr);$i++)
		{
			
			$strTempChk=str_replace("@01",$i,$lvChk.$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]]);
			$strTempChk=str_replace("@02",$lstArr[$i],$strTempChk);
			
			$strTempChk=str_replace("@07",100+$i,$strTempChk);
			if(strpos($lvList,",".$lstArr[$i].",") === FALSE)
			{
				$strTempChk=str_replace("@03","",$strTempChk);
				
			}
			else
			{
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			}
			if(!isset($lvArrOrder[$i]) || $lvArrOrder[$i] === NULL || $lvArrOrder[$i] === "")
				{
				$strTempChk=str_replace("@06",$i,$strTempChk);
				}
			else
				$strTempChk=str_replace("@06",$lvArrOrder[$i],$strTempChk);
			
			
			$strTemp=str_replace("@01",$strTempChk,$lvScript);
			$strGetScript=$strGetScript.$strTemp;
		}
		$strReturn=str_replace("@#01",$strGetScript,$lvSelect).$strScript;
		return $strReturn;
		
	}
	public function GetBuilCheckList($vListID,$vID,$vTabIndex)
	{
		$vListID=",".$vListID.",";
		$strTbl="<table  align=\"center\" class=\"lvtable\">
		<input type=\"hidden\" id=$vID name=$vID value=\"@#02\">
		@#01
		</table>
		<script language=\"javascript\">
		function getChecked(len,nameobj,namevalue)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{
				div1 = document.getElementById(namevalue+i);
				if(str=='') 
					str=(namevalue=='')?div.value:div1.value;
				else
					 str=str+','+(namevalue=='')?div.value:div1.value;
				}
			
			}
			return str;
		}
		</script>
		";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>
			
		</tr>
		";
		$vsql="select * from  hr_lv0004";
		$strGetList="";
		$strGetScript="";
		$i=0;
		$vresult=db_query($vsql);
		$numrows=db_num_rows($vresult);
		while($vrow=db_fetch_array($vresult))		
		{

			$strTempChk=str_replace("@01",$i,$lvChk);
			$strTempChk=str_replace("@02",$vrow['lv001'],$strTempChk);
			if(strpos($vListID,",".$vrow['lv001'].",") === FALSE)
			{
				$strTempChk=str_replace("@03","",$strTempChk);
			}
			else
			{
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			}
			
			$strTempChk=str_replace("@04",$vrow['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			$strTemp=str_replace("@#02",$vrow['lv002']."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
						$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
//////////////////////Buil list////////////////////
	function LV_BuilListReport($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
	{
			
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$strSort="";
		switch($lvSortNum)
		{
			case 0:
				break;
			case 1:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"asc");
				break;
			case 2:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"desc");
				break;
		}
		$lvTable="<!--<div align=\"center\"><img  src=\"".$this->GetLogo()."\" style=\"max-width:1024px\" /></div>-->
		<div align=\"center\"><h1>".($this->ArrPush[0])."</h2></div>
		<table  align=\"center\" class=\"lvtable\" border=1>
		@#01
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT *,lv003 lv099 FROM tc_lv0064 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	
	public function LV_LinkField($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),0));
	}
	private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0014";
				break;
			case 'lv003':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 ";
				break;
			case 'lv004':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002 ";
				break;
			case 'lv007':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0032 ";
				break;
			case 'lv010':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0004 ";
				break;
		}
		return $vsql;
	}
	public  function getvaluelink($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0013 where lv001='$vSelectID'";	
				break;
			case 'lv099':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv004':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002 where lv001='$vSelectID'";
				break;
			case 'lv007':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0032 where lv001='$vSelectID'";
				break;
			case 'lv010':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0004 where lv001='$vSelectID'";
				break;
			default:
				$vsql ="";
				break;
		}
		if($vsql=="")
		{
			return $vSelectID;
		}
		else
		{
		$lvResult = db_query($vsql);
		while($row= db_fetch_array($lvResult)){
		return ($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
		}
		}
		
	}
}
?>