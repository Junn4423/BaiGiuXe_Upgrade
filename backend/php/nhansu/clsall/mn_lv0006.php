<?php
/////////////coding sl_lv0013///////////////
class  mn_lv0006 extends lv_controler
{
	public $lv001=null;
	public $lv002=null;
	public $lv003=null;
	public $lv004=null;
	public $lv005=null;
	public $lv006=null;
	public $lv007=null;
	public $lv008=null;
	public $lv009=null;
	public $lv010=null;
	public $lv011=null;
	public $lv012=null;
	public $lv013=null;
	public $lv014=null;
	public $lv015=null;
	public $lv016=null;
	public $lv017=null;
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027,lv028,lv029,lv030,lv031,lv032";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='sl_lv0013';
	public $obj_child=null;
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv027"=>"28","lv028"=>"29","lv029"=>"30","lv030"=>"31","lv031"=>"32","lv032"=>"33");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"2","lv005"=>"2","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"10","lv016"=>"0","lv017"=>"0","lv018"=>"0","lv019"=>"22","lv020"=>"0","lv021"=>"22","lv022"=>"10","lv023"=>"10","lv024"=>"10","lv025"=>"10","lv026"=>"10","lv027"=>"10","lv028"=>"0","lv029"=>"0","lv030"=>"0","lv031"=>"0","lv032"=>"0");	
	
	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
	 	$this->isFil=1;
		$this->lang=$_GET['lang'];	
		
		$this->isAdd=0;		
		$this->isEdit=0;		
		$this->isDel=0;			
	}
	function LV_Load()
	{
		$vsql="select * from  sl_lv0013";
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
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv015=$vrow['lv015'];
			$this->lv016=$vrow['lv016'];
			$this->lv017=$vrow['lv017'];
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
		}
	}
	function LV_LoadChild($vparent)
	{
		$vsql="select * from  sl_lv0013 where lv017='$vparent'";
		$vresult=db_query($vsql);
		return $vresult;
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  sl_lv0013 Where lv001='$vlv001'";
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
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv015=$vrow['lv015'];
			$this->lv016=$vrow['lv016'];
			$this->lv017=$vrow['lv017'];
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];
		}
	}
	function LV_LoadIDAmount($vlv001)
	{
		$lvsql="select * from  sl_lv0013 Where lv001='$vlv001'";
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
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv015=$vrow['lv015'];
			$this->lv016=$vrow['lv016'];
			$this->lv017=$vrow['lv017'];
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$this->LV_GetContractMoney($this->lv001);
		}
	}
	function LV_CalMaterial($lvarr)
	{
		$lvsql="select * from  sl_lv0013 Where lv001 in ($lvarr) and lv011=1";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$vOrderID=$vrow['lv001'];
			$this->LV_StructMaterial($vOrderID);
		}
	}
	function LV_StructMaterial($vOrderID)
	{
		$vsql="DELETE FROM mn_lv0009  WHERE lv002='$vOrderID';";
		db_query($vsql);
		$vsql="DELETE FROM mn_lv0029  WHERE lv002='$vOrderID';";
		db_query($vsql);
		db_query("DELETE FROM mn_lv0009_1  WHERE mn_lv0009_1.lv001='".$_SESSION['ERPSOFV2RUserID']."' ");
		$lvsql="select * from  sl_lv0014 Where lv002='$vOrderID'";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$vItemID=$vrow['lv003'];
			$vQty=$vrow['lv004'];
			$vUnitID=$vrow['lv005'];
			$vColor=$vrow['lv009'];
			$vSize=$vrow['lv012'];
			$this->LV_BOMRunMaterial($vOrderID,$vItemID,$vQty,$vTT,$vColor,$vSize);			
		}
		$this->LV_RunGomNVL($vOrderID);
	}
	function LV_RunGomNVL($vOrderID)
	{
		$vUser=$_SESSION['ERPSOFV2RUserID'];
		$vsql="insert into mn_lv0009 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014) select lv002,lv003,sum(lv004),lv005,lv006,lv007,lv008,lv009,lv010,lv011,sum(lv012),sum(lv013),sum(lv014) from mn_lv0009_1 where lv001='$vUser' and lv002='$vOrderID' group by lv002,lv003,lv005,lv007,lv008 ";
		db_query($vsql);
		db_query("DELETE FROM mn_lv0009_1  WHERE mn_lv0009_1.lv001='".$_SESSION['ERPSOFV2RUserID']."' ");
	}
	function LV_BOMRunMaterial($vOrderID,$vItemID,$vQty,&$vTT,&$vColor,&$vSize)
	{
		$vTT++;
		if($vTT>35) return ;
		if($vQty==0) return;
		$lvsql="select '$vOrderID' lv002,A.lv003,A.lv004*$vQty lv004,lv005,lv006,lv007,lv008,lv009,0 lv011,0 lv012,0 lv013,0 lv014,A.lv011 State from mn_lv0004 A where lv002='$vItemID' and (select count(*) from mn_lv0004 BB where BB.lv002=A.lv003)=0";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($vrow['State']!=0)
			{
				$vslline = $this->objlot->LV_Get_slt_nolot_all($vrow['lv003']);	
				if($vrow['lv008']==1)
				{
					
					if($vrow['lv007']==1)
					{
						$lvsql="insert into mn_lv0009_1(lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv011,lv012,lv013,lv014) values('".$_SESSION['ERPSOFV2RUserID']."','".$vrow['lv002']."','".$vrow['lv003']."','".$vrow['lv004']."','".$vrow['lv005']."','".$vrow['lv006']."','".$vSize."','".$vColor."','".$vrow['lv009']."','".$vslline."','".$vrow['lv004']."','".($vrow['lv006']*$vrow['lv004']/100)."','".($vrow['lv004']+$vrow['lv006']*$vrow['lv004']/100)."') ";
					}
					else
					{
						$lvsql="insert into mn_lv0009_1(lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv011,lv012,lv013,lv014) values('".$_SESSION['ERPSOFV2RUserID']."','".$vrow['lv002']."','".$vrow['lv003']."','".$vrow['lv004']."','".$vrow['lv005']."','".$vrow['lv006']."','".$vrow['lv007']."','".$vColor."','".$vrow['lv009']."','".$vslline."','".$vrow['lv004']."','".($vrow['lv006']*$vrow['lv004']/100)."','".($vrow['lv004']+$vrow['lv006']*$vrow['lv004']/100)."') ";
					}
				}
				else
				{
					
					if($vrow['lv007']==1)
					{
						$lvsql="insert into mn_lv0009_1(lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv011,lv012,lv013,lv014) values('".$_SESSION['ERPSOFV2RUserID']."','".$vrow['lv002']."','".$vrow['lv003']."','".$vrow['lv004']."','".$vrow['lv005']."','".$vrow['lv006']."','".$vSize."','".$vrow['lv008']."','".$vrow['lv009']."','".$vslline."','".$vrow['lv004']."','".($vrow['lv006']*$vrow['lv004']/100)."','".($vrow['lv004']+$vrow['lv006']*$vrow['lv004']/100)."') ";
					}
					else
					{
						$lvsql="insert into mn_lv0009_1(lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv011,lv012,lv013,lv014) values('".$_SESSION['ERPSOFV2RUserID']."','".$vrow['lv002']."','".$vrow['lv003']."','".$vrow['lv004']."','".$vrow['lv005']."','".$vrow['lv006']."','".$vrow['lv007']."','".$vrow['lv008']."','".$vrow['lv009']."','".$vslline."','".$vrow['lv004']."','".($vrow['lv006']*$vrow['lv004']/100)."','".($vrow['lv004']+$vrow['lv006']*$vrow['lv004']/100)."') ";
					}
				}
				$vReturn=db_query($lvsql);
				if($vReturn) $this->InsertLogOperation($this->DateCurrent,'mn_lv0009_1.insert',sof_escape_string($lvsql));
			}
			else
			{
				$lvsql="insert into mn_lv0029(lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv011,lv012,lv013,lv014) values('".$_SESSION['ERPSOFV2RUserID']."','".$vrow['lv002']."','".$vrow['lv003']."','".$vrow['lv004']."','".$vrow['lv005']."','".$vrow['lv006']."','".$vrow['lv007']."','".$vrow['lv008']."','".$vrow['lv009']."','".$vslline."','".$vrow['lv004']."','".($vrow['lv006']*$vrow['lv004']/100)."','".($vrow['lv004']+$vrow['lv006']*$vrow['lv004']/100)."') ";
				$vReturn=db_query($lvsql);
				if($vReturn) $this->InsertLogOperation($this->DateCurrent,'mn_lv0029.insert',sof_escape_string($lvsql));
			}
		}
		$lvsql="select A.*,A.lv004*$vQty SLCal from mn_lv0004 A where lv002='$vItemID' and (select count(*) from mn_lv0004 BB where BB.lv002=A.lv003)>0";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$vItemID=$vrow['lv003'];
			$vQty=$vrow['SLCal'];
				$vSize=$vrow['lv012'];
				
			$lvsql="insert into mn_lv0029(lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv011,lv012,lv013,lv014) values('".$_SESSION['ERPSOFV2RUserID']."','".$vrow['lv002']."','".$vrow['lv003']."','".$vrow['lv004']."','".$vrow['lv005']."','".$vrow['lv006']."','".$vrow['lv007']."','".$vrow['lv008']."','".$vrow['lv009']."','".$vslline."','".$vrow['lv004']."','".($vrow['lv006']*$vrow['lv004']/100)."','".($vrow['lv004']+$vrow['lv006']*$vrow['lv004']/100)."') ";
			if(db_query($lvsql))
			{
				if($vReturn) $this->InsertLogOperation($this->DateCurrent,'mn_lv0029.insert',sof_escape_string($lvsql));
				
			}
			$this->LV_BOMRunMaterial($vOrderID,$vItemID,$vQty,$vTT,$vColor,$vSize);
		}
		
	}
	function LV_Insert()
	{
		
		if($this->isAdd==0) return false;
		//$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		 $lvsql="insert into sl_lv0013 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv022) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv022')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0013.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_InsertTemp()
	{
		
		if($this->isAdd==0) return false;
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		 $lvsql="insert into sl_lv0013 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv022) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv022')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0013.insert',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Update()
	{
		if($this->isEdit==0) return false;

		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		$lvsql="Update sl_lv0013 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011' ,lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv022='$this->lv022'  where  lv001='$this->lv001' and lv011<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0013.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM sl_lv0013  WHERE sl_lv0013.lv001 IN ($lvarr) and  sl_lv0013.lv011<=0";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0013.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Aproval($lvarr)
	{
		$this->LV_CalMaterial($lvarr);
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isUnApr==0) return false;
		$vUserID=$this->LV_UserID;
		$lvsql = "Update sl_lv0013 set lv011=2,lv018='$vUserID',lv019=concat(CURDATE(),' ',CURTIME())  WHERE sl_lv0013.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0013.unapproval',sof_escape_string($lvsql));
		return $vReturn;
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
		if($this->lv001!="") $strCondi=$strCondi." and lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and lv010 like '%$this->lv010%'";
		if($this->lv011!="")  $strCondi=$strCondi." and lv011 like '%$this->lv011%'";
		if($this->lv012!="")  $strCondi=$strCondi." and lv012 like '%$this->lv012%'";
		if($this->lv013!="")  $strCondi=$strCondi." and lv013 like '%$this->lv013%'";
		if($this->lv014!="")  $strCondi=$strCondi." and lv014 like '%$this->lv014%'";
		if($this->lv015!="")  $strCondi=$strCondi." and lv015 like '%$this->lv015%'";
		if($this->lv016!="")  $strCondi=$strCondi." and lv016 like '%$this->lv016%'";
		if($this->lv017!="")  $strCondi=$strCondi." and lv017 like '%$this->lv017%'";
		if($this->lv018!="")  $strCondi=$strCondi." and lv018 like '%$this->lv018%'";
		if($this->lv019!="")  $strCondi=$strCondi." and lv019 like '%$this->lv019%'";
		return $strCondi;
	}
	protected function GetConditionView()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and lv001  = '$this->lv001'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and lv010 like '%$this->lv010%'";
		if($this->lv011!="")  $strCondi=$strCondi." and lv011 like '%$this->lv011%'";
		if($this->lv012!="")  $strCondi=$strCondi." and lv012 like '%$this->lv012%'";
		if($this->lv013!="")  $strCondi=$strCondi." and lv013 like '%$this->lv013%'";
		if($this->lv014!="")  $strCondi=$strCondi." and lv014 like '%$this->lv014%'";
		if($this->lv015!="")  $strCondi=$strCondi." and lv015 like '%$this->lv015%'";
		if($this->lv016!="")  $strCondi=$strCondi." and lv016 like '%$this->lv016%'";
		if($this->lv017!="")  $strCondi=$strCondi." and lv017 like '%$this->lv017%'";
		if($this->lv018!="")  $strCondi=$strCondi." and lv018 like '%$this->lv018%'";
		if($this->lv019!="")  $strCondi=$strCondi." and lv019 like '%$this->lv019%'";
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0013 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_GetContractMoney($vContractID,$vTax=0)
	{
		$lvsql="select PM.CKTM,sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discountmoney from ((select sum(A.lv004*A.lv006) lv003,sum(A.lv004*A.lv006*A.lv008/100) lv004,sum(A.lv004*A.lv006*A.lv011/100) lv005,B.lv022 CKTM from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and B.lv001='$vContractID'  )) PM ";	
		$vresult=db_query($lvsql);
		$vrow = db_fetch_array ($vresult);
		if($vrow['convertmoney']==0)
		{
			if($vrow['money']==0) return "0";
		}		
		if($vTax!=0)
			{
				$allsum=$vrow['money'];
				if($vrow['CKTM']>0)
					return round($allsum+$vrow['money']*$vTax/100-$allsum*$vrow['CKTM']/100-$vrow['discountmoney'],0);
				else
					return round($allsum+$vrow['money']*$vTax/100-$vrow['discountmoney'],0);
			}
		else
			{
				$allsum=$vrow['money'];
				if($vrow['CKTM']>0)
					return round($allsum+$vrow['convertmoney']-$allsum*$vrow['CKTM']/100-$vrow['discountmoney'],0);
				else
					return round($allsum+$vrow['convertmoney']-$vrow['discountmoney'],0);
			}
	}	
	function LV_GetContractMoneyProduct($vContractID,$vTax=0,$vOpt=0)
	{
		$lvsql="select A.lv002,A.lv003,A.lv006,A.lv008,A.lv009,A.lv010,A.lv012 from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and B.lv001='$vContractID'";
		$vresult=db_query($lvsql);
		$vsumamount=0;
		while($vrow = db_fetch_array ($vresult))
		{
			$vqty_nhap=$this->obj_child->LV_GETNHAP_TP('BANHANG',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']);
			$vqty_nhaplai=$this->obj_child->LV_GETNHAP_TP('RECONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']);
			$vqty_xuat=$this->obj_child->LV_GETXUAT_TP('BANHANG',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']);
			$vqty_xuatlai=$this->obj_child->LV_GETXUAT_TP('RECONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']);
			switch($vOpt)
			{
				case 0: 
					$line_sumqty= $vqty_nhap+$vqty_nhaplai-$vqty_xuat-$vqty_xuatlai;
					break;
				case 1:
					$line_sumqty= $vqty_nhap+$vqty_nhaplai;
					break;
				case 2:
					$line_sumqty= $vqty_xuat+$vqty_xuatlai;
					break;
			}
		
		if($vTax!=0)
			$vsumamount += $line_sumqty*$vrow['lv006'] + $line_sumqty*$vrow['lv006']*$vTax/100;
		else
			$vsumamount += $line_sumqty*$vrow['lv006'] + $line_sumqty*$vrow['lv006']*$vrow['lv008']/100;
		}
		return $vsumamount;
	}	
	function LV_GetPCMoney($vContractID)
	{
	//GetMoney

		$vListParent=$this->LV_GetInvoiceParent($vContractID,1);
		$lvsql = "select if(ISNULL(sum(lv004)),0,sum(lv004)) SumMoney from ac_lv0005 A  WHERE A.lv002 in (".$vListParent.")";
		$vReturnArr=array();
		$lvResult= db_query($lvsql);
		$row= db_fetch_array($lvResult);
		return $row['SumMoney'];			
		
	}	
	function LV_GetPTMoney($vContractID)
	{
	//GetMoney
		$vListParent=$this->LV_GetInvoiceParent($vContractID,0);
		$lvsql = "select if(ISNULL(sum(lv004)),0,sum(lv004)) SumMoney from ac_lv0005 A  WHERE A.lv002 in (".$vListParent.") ";
		$vReturnArr=array();
		$lvResult= db_query($lvsql);
		$row= db_fetch_array($lvResult);
		return $row['SumMoney'];
	}
	function LV_GetInvoiceParent($vContractID,$vtype)
	{
		$vResult='';
		$lvsql = "select B.lv001 from ac_lv0004 B where B.lv013='$vContractID' and B.lv002='$vtype'";
		$lvResult= db_query($lvsql);
		while($row= db_fetch_array($lvResult))
		{
			if($vResult=="")
				$vResult="'".$row['lv001']."'";
			else
				$vResult=$vResult.",'".$row['lv001']."'";;					
		}
		if($vResult=='') return "''";
		else
			return $vResult;
	}	
			//////////////////////Buil list////////////////////
//////////////////////Buil list////////////////////
	function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		if($curRow<0) $curRow=0;	if($lvList=="") $lvList=$this->DefaultFieldList;
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
		@#02
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
		$lvTrSum="<tr class=\"lvlinehtable@01\">
			<td colspan=\"2\"><strong>".($this->ArrPush[99])."</strong></td>
			@#01
		</tr>
		";
		$lvHref="<span onclick=\"ProcessTextHiden(this)\"><a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\">@02</a></span>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$lvSum="<td  class=\"@#04\" align=\"@#05\"><strong>@02</strong></td>";
		$sqlS = "SELECT *,IF(lv011=2,(DATEDIFF(lv004,lv021)+30),(DATEDIFF(lv004,CURDATE())+30)) lv025 FROM sl_lv0013 WHERE lv011=1 ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				$vTempF=str_replace("@01","<!--".$lstArr[$i]."-->",$lvTdF);
				$strF=$strF.$vTempF;
			}
		$sumHD=0;
		$sumTT=0;
		$sumCL=0;
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$strSum='';
			$AmountHD=$this->LV_GetContractMoney($vrow['lv001'],$vrow['lv006']);
			$vInputProduct=$this->LV_GetContractMoneyProduct($vrow['lv001'],$vrow['lv006'],1);
			$vOutputProduct=$this->LV_GetContractMoneyProduct($vrow['lv001'],$vrow['lv006'],2);
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
				case "lv030":
					$sumOut=$sumOut+$vOutputProduct;
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vOutputProduct,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$vTempsum=str_replace("@02",$this->FormatView($sumHD,(int)$this->ArrView[$lstArr[$i]]),$this->Align($lvSum,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv031":
					$vPercent=round(($vInputProduct/$AmountHD)*100,2);
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vPercent."%",(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$vTempsum=str_replace("@02",$this->FormatView($sumHD,(int)$this->ArrView[$lstArr[$i]]),$this->Align($lvSum,(int)$this->ArrView[$lstArr[$i]]));
					break;	
				case "lv032":
					$vPercent=round(($vOutputProduct/$AmountHD)*100,2);
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vPercent."%",(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$vTempsum=str_replace("@02",$this->FormatView($sumHD,(int)$this->ArrView[$lstArr[$i]]),$this->Align($lvSum,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv023":				
					$sumHD=$sumHD+$AmountHD;
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($AmountHD,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$vTempsum=str_replace("@02",$this->FormatView($sumHD,(int)$this->ArrView[$lstArr[$i]]),$this->Align($lvSum,(int)$this->ArrView[$lstArr[$i]]));
					break;					
				case "lv024":	
					$sumIn=$sumIn+$vInputProduct;
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vInputProduct,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$vTempsum=str_replace("@02",'',$this->Align($lvSum,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv026":
					$AmountTT=$this->LV_GetPTMoney($vrow['lv001'])-$this->LV_GetPCMoney($vrow['lv001']);
					$sumTT=$sumTT+$AmountTT;
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($AmountTT,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$vTempsum=str_replace("@02",$this->FormatView($sumTT,(int)$this->ArrView[$lstArr[$i]]),$this->Align($lvSum,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv027":
					$AmountTT=$this->LV_GetPTMoney($vrow['lv001'])-$this->LV_GetPCMoney($vrow['lv001']);
					$AmountCL=$AmountHD-$AmountTT;
					$sumCL=$sumCL+$AmountCL;
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($AmountCL,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$vTempsum=str_replace("@02",$this->FormatView($sumCL,(int)$this->ArrView[$lstArr[$i]]),$this->Align($lvSum,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv028":
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$vrow['lv001']),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$vTempsum=str_replace("@02",'',$this->Align($lvSum,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv029":
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$vrow['lv002']),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$vTempsum=str_replace("@02",'',$this->Align($lvSum,(int)$this->ArrView[$lstArr[$i]]));
					break;
				default:
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$vTempsum=str_replace("@02",'',$this->Align($lvSum,(int)$this->ArrView[$lstArr[$i]]));
					break;
				}	
				$strL=$strL.$vTemp;
				$strSum=$strSum.$vTempsum;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else if($vrow['lv011']==2)		$strTr=str_replace("@#04","lvlineapproval_level2",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv023-->",$this->FormatView($sumHD,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		//$strTr=$strTr.str_replace("@#01",$strSum,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTrSum))));
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		$lvTotalNumTd=str_replace("@#01",$this->FormatView($vtotalnum,10),$lvTotalNumTd);
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
			window.open('".$this->Dir."sl_lv0013/?lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$strTemp=str_replace("@01",$lvNumPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
				$strTemp=str_replace("@01",$lvSortPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvButton,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
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
	function LV_BuilListReportMini($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvDateSort)
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
		$lvTable="
		<ul id=\"menu3-nav\">
			<li class=\"menusubT3\">
				<a target=\"_self\" href=\"\">
				<img style=\"position:absolute;right:0px;top:-20px\" src=\"../images/lvicon/recent_l.png\" height=\"50\" border=\"0\">
				</a>
			<ul id=\"submenu3-nav\">
				<li><table  align=\"center\" class=\"lvtable\">
		<!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		@#01
		</table></li>
			</ul>
			</li>
		</ul>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			<td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			<td width=1%><input type=\"image\" class=\"btn_img_rpt\" name=\"$lvChk\"  id=\"$lvChk@03\" onclick=\"Report('@02')\" value=\"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\"  tabindex=\"2\"  border=\"0\"/></td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM sl_lv0013 WHERE 1=1 and lv004 like '$lvDateSort%'  $strSort LIMIT $curRow, $maxRows";
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
				if($lstArr[$i]=="lv023")
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetContractMoney($vrow['lv001'],$vrow['lv006']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				elseif($lstArr[$i]=="lv024")
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetContractMoneyProduct($vrow['lv001'],$vrow['lv006']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				elseif($lstArr[$i]=="lv026")
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetPTMoney($vrow['lv001'])-$this->LV_GetPCMoney($vrow['lv001']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv007']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function LV_GetBLMoney($vContractID)
	{
		$lvsql="select sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discount from ((select sum(A.lv004*A.lv006) lv003,sum(A.lv004*A.lv006*A.lv008/100) lv004,sum(A.lv004*A.lv006*A.lv011/100) lv005 from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and B.lv001='$vContractID' )) PM ";	
		$vresult=db_query($lvsql);
		$vrow = db_fetch_array ($vresult);
		if($vrow['convertmoney']==0)
		{
			if($vrow['money']==0) return "0";
		}
		return $vrow['convertmoney']+$vrow['money']-$vrow['discount'];
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
		$lvTable="<div align=\"center\"><img  src=\"".$this->GetLogo()."\" /></div>
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
		$lvTrSum="<tr class=\"lvlinehtable@01\">
			<td ><strong>".($this->ArrPush[99])."</strong></td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$lvSum="<td  class=\"#04\" align=\"@#05\"><strong>@02</strong></td>";
		$sqlS = "SELECT *,IF(lv011=2,(DATEDIFF(lv005,lv021)+30),(DATEDIFF(lv005,CURDATE())+30)) lv025 FROM sl_lv0013 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
			$strSum='';
			$AmountHD=$this->LV_GetContractMoney($vrow['lv001'],$vrow['lv006']);
			$vInputProduct=$this->LV_GetContractMoneyProduct($vrow['lv001'],$vrow['lv006'],1);
			$vOutputProduct=$this->LV_GetContractMoneyProduct($vrow['lv001'],$vrow['lv006'],2);
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
				case "lv030":
					$sumOut=$sumOut+$vOutputProduct;
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vOutputProduct,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv031":
					$vPercent=round(($vInputProduct/$AmountHD)*100,2);
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vPercent."%",(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;	
				case "lv032":
					$vPercent=round(($vOutputProduct/$AmountHD)*100,2);
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vPercent."%",(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv023":				
					$sumHD=$sumHD+$AmountHD;
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($AmountHD,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv024":				
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetContractMoneyProduct($vrow['lv001'],$vrow['lv006']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv026":
					$AmountTT=$this->LV_GetPTMoney($vrow['lv001'])-$this->LV_GetPCMoney($vrow['lv001']);
					$sumTT=$sumTT+$AmountTT;
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($AmountTT,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv027":
					$AmountTT=$this->LV_GetPTMoney($vrow['lv001'])-$this->LV_GetPCMoney($vrow['lv001']);
					$AmountCL=$AmountHD-$AmountTT;
					$sumCL=$sumCL+$AmountCL;
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($AmountCL,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv028":
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$vrow['lv001']),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv029":
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$vrow['lv002']),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				default:				
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));					
					break;
				}
				$strL=$strL.$vTemp;
				$strSum=$strSum.$vTempsum;
			}			
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
		}
		$strTr=$strTr.str_replace("@#01",$strSum,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTrSum))));
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
//////////////////////Buil list////////////////////
	function LV_BuilListReportOther($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
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
		$lvTable="
		<div align=\"center\" class=lv0>".($this->ArrPush[0])."</div>
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT *,IF(lv011=2,(DATEDIFF(lv005,lv021)+30),(DATEDIFF(lv005,CURDATE())+30)) lv025 FROM sl_lv0013 WHERE 1=1  ".$this->GetConditionView()." $strSort LIMIT $curRow, $maxRows";
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
			$AmountHD=$this->LV_GetContractMoney($vrow['lv001'],$vrow['lv006']);
			$vInputProduct=$this->LV_GetContractMoneyProduct($vrow['lv001'],$vrow['lv006'],1);
			$vOutputProduct=(float)$this->LV_GetContractMoneyProduct($vrow['lv001'],$vrow['lv006'],2);
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
				case "lv030":
					$sumOut=$sumOut+$vOutputProduct;
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vOutputProduct,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv031":
					$vPercent=round(($vInputProduct/$AmountHD)*100,2);
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vPercent."%",(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;	
				case "lv032":
					$vPercent=round(($vOutputProduct/$AmountHD)*100,2);
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vPercent."%",(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv023":				
					$sumHD=$sumHD+$AmountHD;
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($AmountHD,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv024":				
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetContractMoneyProduct($vrow['lv001'],$vrow['lv006']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				case "lv026":
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetPTMoney($vrow['lv001'])-$this->LV_GetPCMoney($vrow['lv001']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				default:
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					break;
				}
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","",$strTr);
			
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
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0001";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0009";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0008";
				break;
			case 'lv011':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0054";
				break;
			case 'lv012':
				if($this->lv002!="")
					$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0010 where lv002='$this->lv002'";
				else
					$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0010 ";
				break;
			case 'lv015':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0016";
				break;
			case 'lv017':
				$vsql="select lv001,concat(lv003,' - ',lv016) lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0013";
				break;
		}
		return $vsql;
	}
	function getvaluelink($vFile,$vSelectID)
	{
		if($vSelectID=="")
		{
			return $vSelectID;
		}
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0001 where lv001='$vSelectID'";
				$lvopt=2;
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0009 where lv001='$vSelectID'";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0008 where lv001='$vSelectID'";
				break;
			case 'lv010':
				$lvopt=2;
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv011':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0054 where lv001='$vSelectID'";
				break;
			case 'lv012':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0010 where lv002='$this->lv002'";
				break;
			case 'lv028':
				$vsql="select A.lv001,(select concat(B.lv002,'(',B.lv001,')') from hr_lv0020 B where B.lv001=A.lv011)  lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0010 A  where (A.lv005='BANHANG' or A.lv005='RECONTRACT') and A.lv006='$vSelectID'";
				break;
			case 'lv029':
				$vsql="select A.lv001,concat(lv009,',',lv007) lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0001 A  where A.lv001='$vSelectID'";
				break;
			/*case 'lv017':
				$vsql="select lv001,concat(lv003,' - ',lv016) lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0013 where lv002='$this->lv002'";
				break;*/
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
			$this->ArrGetValueLink[$vFile][$vSelectID][0]=true;
		}
		while($row= db_fetch_array($lvResult)){
			$this->ArrGetValueLink[$vFile][$vSelectID][1]=($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
			return $this->ArrGetValueLink[$vFile][$vSelectID][1];
		}
		
	}
}
?>