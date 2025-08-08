<?php
/////////////coding tc_lv0097///////////////
class   tc_lv0097 extends lv_controler
{
	public $lv001=null;
	public $lv002=null;
	public $lv003=null;
	public $lv004=null;
	public $lv005=null;
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv053,lv054,lv057,lv058,lv061,lv062,lv065,lv066,lv069,lv070,lv073,lv074,lv077,lv078,lv081,lv082,lv085,lv086,lv089,lv090,lv093,lv094,lv097,lv098,lv026,lv004,lv014";	
////////////////////GetDate
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='tc_lv0097';
	public $Dir="";
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv027"=>"28","lv101"=>"102","lv053"=>"54","lv054"=>"55","lv057"=>"58","lv058"=>"59","lv061"=>"62","lv062"=>"63","lv065"=>"66","lv066"=>"67","lv069"=>"70","lv070"=>"71","lv073"=>"74","lv074"=>"75","lv077"=>"78","lv078"=>"79","lv081"=>"82","lv082"=>"83","lv085"=>"86","lv086"=>"87","lv089"=>"90","lv090"=>"91","lv093"=>"94","lv094"=>"95","lv097"=>"98","lv098"=>"99");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"10","lv005"=>"10","lv006"=>"10","lv007"=>"10","lv008"=>"10","lv009"=>"10","lv010"=>"10","lv011"=>"10","lv012"=>"10","lv013"=>"10","lv014"=>"0","lv015"=>"10","lv016"=>"10","lv017"=>"10","lv018"=>"10","lv019"=>"10","lv020"=>"10","lv021"=>"10","lv022"=>"10","lv023"=>"10","lv024"=>"10","lv025"=>"10","lv026"=>"10","lv027"=>"10","lv101"=>"0","lv053"=>"10","lv054"=>"10","lv057"=>"10","lv058"=>"10","lv061"=>"10","lv062"=>"10","lv065"=>"10","lv066"=>"10","lv069"=>"10","lv070"=>"10","lv073"=>"10","lv074"=>"10","lv077"=>"10","lv078"=>"10","lv081"=>"10","lv082"=>"10","lv085"=>"10","lv086"=>"10","lv089"=>"10","lv090"=>"10","lv093"=>"10","lv094"=>"10","lv097"=>"10","lv098"=>"10");	
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
		
	}
	protected function LV_CheckLock()
	{
		$lvsql="select lv011 from tc_lv0013 B where  B.lv001='$this->lv002'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv011']>1)
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_Load()
	{
		$vsql="select * from  tc_lv0097";
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
			$this->lv023=$vrow['lv023'];
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			$this->lv027=$vrow['lv027'];
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  tc_lv0097 Where lv001='$vlv001'";
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
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			$this->lv027=$vrow['lv027'];
		}
	}
	function LV_LoadTemplate($vlv001)
	{
		
		$strReturn="";
		$lvsql="select A.*,B.lv007 lv014 from  tc_lv0097 A left join hr_lv0044 B on A.lv002=B.lv001 Where A.lv001='$vlv001'";
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
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			$this->lv027=$vrow['lv027'];
		}
		return $strReturn;
	}
	function LV_Insert()
	{
		
		if($this->isAdd==0) return false;
		$lvsql="insert into tc_lv0097 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027,lv051,lv052,lv053,lv054,lv055,lv056,lv057,lv058,lv059,lv060,lv061,lv062,lv063,lv064,lv065,lv066,lv067,lv068,lv069,lv070,lv071,lv072,lv073,lv074,lv075,lv076,lv077,lv078,lv079,lv080,lv081,lv082,lv083,lv084,lv085,lv086,lv087,lv088,lv089,lv090,lv091,lv092,lv093,lv094,lv095,lv096,lv097,lv098,lv050,lv101) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022','$this->lv023','$this->lv024','$this->lv025','$this->lv026','$this->lv027','$this->lv051','$this->lv052','$this->lv053','$this->lv054','$this->lv055','$this->lv056','$this->lv057','$this->lv058','$this->lv059','$this->lv060','$this->lv061','$this->lv062','$this->lv063','$this->lv064','$this->lv065','$this->lv066','$this->lv067','$this->lv068','$this->lv069','$this->lv070','$this->lv071','$this->lv072','$this->lv073','$this->lv074','$this->lv075','$this->lv076','$this->lv077','$this->lv078','$this->lv079','$this->lv080','$this->lv081','$this->lv082','$this->lv083','$this->lv084','$this->lv085','$this->lv086','$this->lv087','$this->lv088','$this->lv089','$this->lv090','$this->lv091','$this->lv092','$this->lv093','$this->lv094','$this->lv095','$this->lv096','$this->lv097','$this->lv098','$this->lv050','$this->lv101')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0097.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_InsertAuto()
	{
		if($this->isAdd==0) return false;
		$lvsql="insert into tc_lv0097 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027,lv051,lv052,lv053,lv054,lv055,lv056,lv057,lv058,lv059,lv060,lv061,lv062,lv063,lv064,lv065,lv066,lv067,lv068,lv069,lv070,lv071,lv072,lv073,lv074,lv075,lv076,lv077,lv078,lv079,lv080,lv081,lv082,lv083,lv084,lv085,lv086,lv087,lv088,lv089,lv090,lv091,lv092,lv093,lv094,lv095,lv096,lv097,lv098,lv050,lv101) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022','$this->lv023','$this->lv024','$this->lv025','$this->lv026','$this->lv027','$this->lv051','$this->lv052','$this->lv053','$this->lv054','$this->lv055','$this->lv056','$this->lv057','$this->lv058','$this->lv059','$this->lv060','$this->lv061','$this->lv062','$this->lv063','$this->lv064','$this->lv065','$this->lv066','$this->lv067','$this->lv068','$this->lv069','$this->lv070','$this->lv071','$this->lv072','$this->lv073','$this->lv074','$this->lv075','$this->lv076','$this->lv077','$this->lv078','$this->lv079','$this->lv080','$this->lv081','$this->lv082','$this->lv083','$this->lv084','$this->lv085','$this->lv086','$this->lv087','$this->lv088','$this->lv089','$this->lv090','$this->lv091','$this->lv092','$this->lv093','$this->lv094','$this->lv095','$this->lv096','$this->lv097','$this->lv098','$this->lv050','$this->lv101')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0097.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Update()
	{
		$this->LV_CheckLock();
		if($this->isEdit==0) return false;
		 $lvsql="Update tc_lv0097 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv018='$this->lv018',lv019='$this->lv019',lv020='$this->lv020',lv021='$this->lv021',lv022='$this->lv022',lv023='$this->lv023',lv024='$this->lv024',lv025='$this->lv025',lv026='$this->lv026',lv027='$this->lv027',lv051='$this->lv051',lv052='$this->lv052',lv053='$this->lv053',lv054='$this->lv054',lv055='$this->lv055',lv056='$this->lv056',lv057='$this->lv057',lv058='$this->lv058',lv059='$this->lv059',lv060='$this->lv060',lv061='$this->lv061',lv062='$this->lv062',lv063='$this->lv063',lv064='$this->lv064',lv065='$this->lv065',lv066='$this->lv066',lv067='$this->lv067',lv068='$this->lv068',lv069='$this->lv069',lv070='$this->lv070',lv071='$this->lv071',lv072='$this->lv072',lv073='$this->lv073',lv074='$this->lv074',lv075='$this->lv075',lv076='$this->lv076',lv077='$this->lv077',lv078='$this->lv078',lv079='$this->lv079',lv080='$this->lv080',lv081='$this->lv081',lv082='$this->lv082',lv083='$this->lv083',lv084='$this->lv084',lv085='$this->lv085',lv086='$this->lv086',lv087='$this->lv087',lv088='$this->lv088',lv089='$this->lv089',lv090='$this->lv090',lv091='$this->lv091',lv092='$this->lv092',lv093='$this->lv093',lv094='$this->lv094',lv095='$this->lv095',lv096='$this->lv096',lv097='$this->lv097',lv098='$this->lv098',lv050='$this->lv050',lv101='$this->lv101' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0097.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateChuyenKhoan($lvarr,$vValue=0)
	{
		if($this->isAdd==0) return false;
		$lvsql="update tc_lv0097 set lv100='$vValue' where lv001 in ($lvarr) and lv099=0";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0021.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	//Xoá nhóm phòng ban
	function LV_DeleteDept($vCalID,$vDepID)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM tc_lv0097  WHERE lv002='$vCalID' and lv003='$vDepID' and lv099=0";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0097.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM tc_lv0097  WHERE tc_lv0097.lv001 IN ($lvarr) and lv099<1";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0097.delete',sof_escape_string($lvsql));
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
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001 like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002 = '$this->lv002'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003 like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004 like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005 like '%$this->lv005%'";
		if($this->lv016!="") $strCondi=$strCondi." and A.lv016 = '$this->lv016'";
		if($this->lv129!="")
		{
			$strCondi=$strCondi." and B.lv029 in (".$this->LV_GetDep($this->lv129).")";
		}
		return $strCondi;
	}
	function LV_GetStaffWorkYear($vDateFrom,$vDateTo)
	{
		$lvsql="select A.lv001,A.lv030 from hr_lv0020  where A.lv030>='$vDateFrom' and A.lv030<='$vDateTo'";
		//Search list dept to cal
		$vresult= db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$vYear=getyear($vrow['lv030']);
			$vMonth=getmonth($vrow['lv030']);
			$vDay=getday($vrow['lv030']);
			if($vDay>15)
			{
				$this->ArrStaffWork[$vrow['lv001']][0]=true;
				$this->ArrStaffWork[$vrow['lv001']][1]=$vMonth;
				$this->ArrStaffWork[$vrow['lv001']][2]=$vYear;
			}
		}

	}
	
	function LV_GetDep($vDepID)
	{
		if($vDepID=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		if($this->isChildCheck=="") $this->isChildCheck=1;
		if($this->isChildCheck==1)
		{
			$vsql="select lv001 from  hr_lv0002 where lv001 in ($vReturn) ";
			$bResult=db_query($vsql);
			while ($vrow = db_fetch_array ($bResult)){
				//$vReturn=$vReturn.",'".$vrow['lv001']."'";
				$vReturn=$vReturn.",".$this->LV_GetChildDep($vrow['lv001']);
			}
		}
		return $vReturn;
	}
	function LV_GetChildDep($vDepID)
	{
		$vReturn="";
		if(trim($vDepID)=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		$vsql="select lv001 from  hr_lv0002 where lv002 in ($vReturn) ";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vReturn=$vReturn.",".$this->LV_GetChildDep($vrow['lv001']);
		}
		return $vReturn;
	}
	function LV_GetDonTinhThuong()
	{
		$vReturn="";
		$vsql="select * from tc_lv0002 where lv008=1";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			if($vReturn=='')
				$vReturn="'".$vrow['lv001']."'";
			else
				$vReturn=$vReturn.",'".$vrow['lv001']."'";
		}
		return $vReturn;
	}
	function LV_GetPhepTinhThuong($vDateFrom,$vDateTo)
	{
		$lsMaCong=$this->LV_GetDonTinhThuong();
		$lvsql="select MP.lv002,MP.MonthW,MP.YearW,sum(MP.TNLD)/3600/8 SoNgay from (select B.lv002,TIME_TO_SEC(TIMEDIFF('08:00:00',A.lv005)) TNLD,Month(A.lv004) MonthW,Year(A.lv004) YearW,A.lv004 from tc_lv0011 A inner join tc_lv0010 B on A.lv002=B.lv001  where A.lv004>='$vDateFrom' and A.lv004<='$vDateTo' and A.lv007 in ($lsMaCong) and lv100<>1) MP group by MP.lv002,MP.MonthW,MP.YearW";
		//echo $lvsql="select MP.lv002,MP.MonthW,MP.YearW,count(MP.lv002) SoNgay from (select B.lv002,Month(A.lv004) MonthW,Year(A.lv004) YearW,A.lv004 from tc_lv0011 A inner join tc_lv0010 B on A.lv002=B.lv001  where A.lv004>='$vDateFrom' and A.lv004<='$vDateTo' and A.lv007 in ($lsMaCong) and lv100<>1) MP group by MP.lv002,MP.MonthW,MP.YearW";
		//Search list dept to cal
		$vresult= db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			
			if($vrow['lv002']=='086') $vrow['lv002']='1803';
			$this->ArrStaffNghiTinhThuong[$vrow['lv002']][(int)$vrow['MonthW']]=$vrow['SoNgay'];
		}

	}
	function LV_GetFullContractCalMonth($vMonth,$vYear)
	{
		$vArrReturn=Array();
		$lvsql="
		select A.lv099,B.lv002 from tc_lv0011 A inner join tc_lv0010 B on A.lv002=B.lv001 where year(A.lv004)='$vYear' and month(A.lv004)='$vMonth' and day(A.lv004)=28 and lv100=0
		union
		select A.lv099,B.lv002 from tc_lv0011 A inner join tc_lv0010 B on A.lv002=B.lv001 where year(A.lv004)='$vYear' and month(A.lv004)='$vMonth' and day(A.lv004)=1 and lv100=0
		;";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			//if($vrow['lv002']=='086') $vrow['lv002']='1803';
			if(!isset($vArrReturn[$vrow['lv002']]))
			{
				$vArrReturn[$vrow['lv002']]=$vrow['lv099'];
			}
		}
		return $vArrReturn;
	}
	function LV_GetStaffToCal()
	{
		$vReturn="";
		$vsql="select A.lv001,A.lv002,A.lv029,A.lv019 from hr_lv0020 A where  A.lv009 not in (2,3) and lv029 in (".$this->LV_GetDep($this->DeptCal).")";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			if($vReturn=='')
				$vReturn="'".$vrow['lv001']."'";
			else
				$vReturn=$vReturn.",'".$vrow['lv001']."'";
		}
		return $vReturn;
	}
	function GetCostList($vEmployeeID,$vCalculateTimesID,$listCode)
	{
		$vsql="select sum(A.lv005) TotalMoney from tc_lv0023 A  where A.lv002='$vEmployeeID'  and A.lv003='$vCalculateTimesID' and A.lv004 in($listCode)";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow['TotalMoney'];
		}
	}
	function GetExpensiveList($vEmployeeID,$vCalculateTimesID,$listCode)
	{
		$vsql="select sum(A.lv005) TotalMoney from tc_lv0017 A where A.lv002='$vEmployeeID'  and A.lv003='$vCalculateTimesID' and A.lv004 in($listCode) ";//and A.lv008='1' and A.lv003='$vCalculateTimesID' and A.lv004 in($listCode) ";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow['TotalMoney'];
		}
	}
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0097 set lv099=1  WHERE tc_lv0097.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0097.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0097 set lv099=0  WHERE tc_lv0097.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0097.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_GetFullContract()
	{
		$vArrReturn=Array();
		$lvsql="select distinct lv010,lv002 from hr_lv0038 order by lv004 desc,lv005 desc,lv009 asc;";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			if(!isset($vArrReturn[$vrow['lv002']]))
			{
				$vArrReturn[$vrow['lv002']]=$vrow['lv010'];
			}
		}
		return $vArrReturn;
	}
	function LV_GetFullContractHDLD()
	{
		$vArrReturn=Array();
		$lvsql="select distinct lv001,lv002 from hr_lv0038 order by lv004 desc,lv005 desc,lv009 asc;";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			if(!isset($vArrReturn[$vrow['lv002']]))
			{
				$vArrReturn[$vrow['lv002']]=$vrow['lv001'];
			}
		}
		return $vArrReturn;
	}
	function LV_PhepNamTruyTra_ThuongQuanTri($vCalID)
	{
		$vsql="select A.lv003,A.lv008,sum(A.lv009) TruThuongHTNV from tc_lv0110 A inner join tc_lv0013 AA on A.lv002=AA.lv001 where A.lv002='$vCalID' and A.lv009<>0 group by A.lv003,A.lv008";
		$bResult = db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			if($vrow['lv003']=='086') $vrow['lv003']='1803';
			$vrow['lv008']=(int)$vrow['lv008'];
				$this->ArrTruThuongHTNV[$vrow['lv003']][$vrow['lv008']]=$vrow['TruThuongHTNV'];
		}
	}
	function LV_GetHieuQuaNamTruoc($vCalID)
	{
		$vsql="select A.lv003,A.lv008,A.lv010 from tc_lv0097 A where A.lv002='$vCalID' and A.lv016=1";
		$bResult = db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			if($vrow['lv003']=='086') $vrow['lv003']='1803';
			$this->ArrThuongHieuQuaNamTruoc[$vrow['lv003']]=$vrow['lv008']+$vrow['lv010'];
		}
	}
	function LV_GetFullImport($listCode,$vCalculateTimesID)
	{
		$vReturn='';
		$vsql="select A.lv002 from tc_lv0017 A inner join hr_lv0018 B on A.lv006=B.lv001 where  A.lv003='$vCalculateTimesID' and A.lv004 in($listCode) ";//and A.lv008='1' and A.lv003='$vCalculateTimesID' and A.lv004 in($listCode) ";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
		
			if($vReturn=='')
				$vReturn="'".$vrow['lv002']."'";
			else
				$vReturn=$vReturn.",'".$vrow['lv002']."'";
		}
		return $vReturn;
	}
	function AutoCalSalary($vCalID)
	{
		//BQ Lương
		//Cal Staff
		if($this->DeptCal!="")
			$vListStaff=$this->LV_GetStaffToCal();
		else
			$vListStaff="";
		//Load tham số tính lương
		$this->motc_lv0013->LV_LoadID($vCalID);
		//Load cac du lieu can cho tinh
		
		$vMonthFrom=getmonth($this->datefrom);
		$vMonthTo=getmonth($this->dateto);
		$vSoThang=$vMonthTo-$vMonthFrom+1;
		$vYear=getyear($this->dateto);
		$this->LV_GetBQLuong($vYear,$vMonthFrom,$vMonthTo,$vListStaff);	
		// Tính nhân viên theo thoả ước
		//Delete All
		if($vListStaff!="")
		{			
			$lvsql = "DELETE FROM tc_lv0097  WHERE tc_lv0097.lv002='".$vCalID."' and lv003 in ($vListStaff)  and lv099=0";
			db_query($lvsql);	
		}
		else
		{			
			$lvsql = "DELETE FROM tc_lv0097  WHERE tc_lv0097.lv002='".$vCalID."' and lv099=0";
			db_query($lvsql);
			
		}
		
			if($vListStaff!="")
			{
				$lvsql="select A.lv001,A.lv002,A.lv029 from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where   A.lv009 not in (2,3)  and A.lv001 in ($vListStaff)  and (A.lv030>'1980-01-01' and A.lv030<='$this->dateto') and A.lv044<'2000-01-01'";
			}
			else
			{
				$lvsql="select A.lv001,A.lv002,A.lv029 from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001  where  A.lv009 not in (2,3)  and (A.lv030>'1980-01-01' and A.lv030<='$this->dateto') and A.lv044<'2000-01-01'";
			}
			//Search list dept to cal
			$vresult= db_query($lvsql);
			//Số nhân viên tính
			$vCount=db_num_rows($vresult);
			//Tổng quỹ lương theo thoả ước
			$vTongTienChi=$this->motc_lv0013->lv033;
			
			$vArrTongHeSoBQ=Array();
			while($vrow=db_fetch_array($vresult))
			{
			
				$this->lv002=$vCalID;
				//Mã nhân viên
				$this->lv003=$vrow['lv001'];
				//BQ CHNQ/ năm (%)
				$this->lv018=$vCHNQ;
			
			
				//Thưởng tết
				$this->lv027=$this->GetExpensiveList($vrow['lv001'],$vCalID,"'THUONGTET'");
						
				//Tổng trừ TNCN
				$this->lv011=$this->GetCostList($vrow['lv001'],$vCalID,"'TNCNTHUONG'");
				//Trừ Trực tết
				$this->lv012=$this->GetCostList($vrow['lv001'],$vCalID,"'TRUCTET'");
				//Tổng cộng
				//$this->lv013=$this->lv008+$this->lv009+$this->lv010-$this->lv012-$this->lv011;
				//Tiền tệ
				$this->lv014='VND';
				//T1
				$vSoThang=0;
				$vTongTien=0;
				$this->lv053=$this->ArrBQ_LUONG[$vrow['lv001']]['C.1'];
				$this->lv054=$this->ArrBQ_LUONG[$vrow['lv001']]['T.1'];
				if($this->lv053>0 && $this->lv054>0)
				{
					$vSoThang++;
					$vTongTien=$vTongTien+$this->lv054;
				}
				//T2				
				$this->lv057=$this->ArrBQ_LUONG[$vrow['lv001']]['C.2'];
				$this->lv058=$this->ArrBQ_LUONG[$vrow['lv001']]['T.2'];
				if($this->lv057>0 && $this->lv058>0)
				{
					$vTongTien=$vTongTien+$this->lv054;
					$vSoThang++;
				}
				//T3				
				$this->lv061=$this->ArrBQ_LUONG[$vrow['lv001']]['C.3'];
				$this->lv062=$this->ArrBQ_LUONG[$vrow['lv001']]['T.3'];
				if($this->lv061>0 && $this->lv062>0)
				{
					$vTongTien=$vTongTien+$this->lv054;
					$vSoThang++;
				}
				//T4
				$this->lv065=$this->ArrBQ_LUONG[$vrow['lv001']]['C.4'];
				$this->lv066=$this->ArrBQ_LUONG[$vrow['lv001']]['T.4'];
				if($this->lv065>0 && $this->lv066>0)
				{
					$vTongTien=$vTongTien+$this->lv054;
					$vSoThang++;
				}
				//T5
				$this->lv069=$this->ArrBQ_LUONG[$vrow['lv001']]['C.5'];
				$this->lv070=$this->ArrBQ_LUONG[$vrow['lv001']]['T.5'];
				if($this->lv069>0 && $this->lv070>0)
				{
					$vTongTien=$vTongTien+$this->lv070;
					$vSoThang++;
				}
				//T6
				$this->lv073=$this->ArrBQ_LUONG[$vrow['lv001']]['C.6'];
				$this->lv074=$this->ArrBQ_LUONG[$vrow['lv001']]['T.6'];
				if($this->lv057>0 && $this->lv058>0)
				{
					$vTongTien=$vTongTien+$this->lv074;
					$vSoThang++;
				}
				//T7
				$this->lv077=$this->ArrBQ_LUONG[$vrow['lv001']]['C.7'];
				$this->lv078=$this->ArrBQ_LUONG[$vrow['lv001']]['T.7'];
				if($this->lv077>0 && $this->lv078>0)
				{
					$vTongTien=$vTongTien+$this->lv078;
					$vSoThang++;
				}
				//T8
				$this->lv081=$this->ArrBQ_LUONG[$vrow['lv001']]['C.8'];
				$this->lv082=$this->ArrBQ_LUONG[$vrow['lv001']]['T.8'];
				if($this->lv081>0 && $this->lv082>0)
				{
					$vTongTien=$vTongTien+$this->lv082;
					$vSoThang++;
				}
				//T9
				$this->lv085=$this->ArrBQ_LUONG[$vrow['lv001']]['C.9'];
				$this->lv086=$this->ArrBQ_LUONG[$vrow['lv001']]['T.9'];
				if($this->lv085>0 && $this->lv086>0)
				{
					$vTongTien=$vTongTien+$this->lv086;
					$vSoThang++;
				}
				//T10
				$this->lv089=$this->ArrBQ_LUONG[$vrow['lv001']]['C.10'];
				$this->lv090=$this->ArrBQ_LUONG[$vrow['lv001']]['T.10'];
				if($this->lv089>0 && $this->lv090>0)
				{
					$vTongTien=$vTongTien+$this->lv090;
					$vSoThang++;
				}
				//T11
				$this->lv093=$this->ArrBQ_LUONG[$vrow['lv001']]['C.11'];
				$this->lv094=$this->ArrBQ_LUONG[$vrow['lv001']]['T.11'];
				if($this->lv093>0 && $this->lv094>0)
				{
					$vTongTien=$vTongTien+$this->lv094;
					$vSoThang++;
				}
				//T12
				$this->lv097=$this->ArrBQ_LUONG[$vrow['lv001']]['C.12'];
				$this->lv098=$this->ArrBQ_LUONG[$vrow['lv001']]['T.12'];
				if($this->lv097>0 && $this->lv098>0)
				{
					$vTongTien=$vTongTien+$this->lv098;
					$vSoThang++;
				}
				$this->lv026=$vSoThang;
				$this->lv004=$vTongTien/12;
				$this->lv050=$vArrDeptCur[$vrow['lv001']];
				$this->lv101=$vArrContract[$vrow['lv001']];
				$this->LV_InsertAuto();
			}
			//$vsql="update tc_lv0097 set lv013=(lv008+lv009+lv027+lv010-lv011-lv012) where lv002='$vCalID' and lv016=2";
			//$vresult= db_query($vsql);
		
	}
	//Lấy cấp bậc hiện tại.
	function LV_GetHDCurrent()
	{
		$vNow=$this->motc_lv0013->lv005;
		$this->ArrHDHienTai=Array();
		$vDateEnd=$this->motc_lv0013->lv005;
		$lvsql="select * from (select  A.lv001,C.lv012 HTNV,10 CHNQ,IF(B.lv009=1,1,0) UuTien from hr_lv0020 A inner join hr_lv0038 B on A.lv001=B.lv002 left join hr_lv0008 C on B.lv300=C.lv001  where  A.lv030<='$vDateEnd' and  (B.lv004<='$vNow' and B.lv005>='$vNow')  and  A.lv009 not in (2,3) and  year(A.lv044)<='2015') MP order by MP.UuTien asc";
		$vresult= db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$this->ArrHDHienTai[$vrow['lv001']][0]=$vrow['HTNV']+$vrow['CHNQ'];
			$this->ArrHDHienTai[$vrow['lv001']][1]=$vrow['HTNV'];
			$this->ArrHDHienTai[$vrow['lv001']][2]=$vrow['CHNQ'];
		}
	}
	function LV_GetHoanThanhNVChuan()
	{
		$lvsql="select C.lv001,C.lv012 HTNV,10 CHNQ from hr_lv0008 C ";
		$vresult= db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$this->ArrHTNVChuan[$vrow['lv001']][0]=$vrow['HTNV']+$vrow['CHNQ'];
			$this->ArrHTNVChuan[$vrow['lv001']][1]=$vrow['HTNV'];
			$this->ArrHTNVChuan[$vrow['lv001']][2]=$vrow['CHNQ'];
		}
	}
	//Mức qui về CHNQ+HTNV áp dụng cho, áp dụng KPI HTNV 2019
	function LV_GetMucQuiChuanHTNV($vMucChuan,$vMucHienTai,$vHTNV_BP,$vViPham)
	{
		//echo "($vMucChuan,$vMucHienTai,$vHTNV_BP,$vViPham)=";
		$vMucTraVe=$vMucCham;
		if($vMucChuan==$vMucHienTai)
		{
			return $vHTNV_BP-$vViPham;
		}
		else
		{
			$vChenhLech=$vMucHienTai-$vHTNV_BP;
			switch($vMucHienTai)
			{
				case 50:
					return $vMucChuan+$vChenhLech-$vViPham*1.7;
					break;
				case 40:
					return $vMucChuan+$vChenhLech-$vViPham*1.4;
					break;
				case 30:
					return $vMucChuan+$vChenhLech-$vViPham*1;
					break;
				case 20:
					return $vMucChuan+$vChenhLech-$vViPham*0.7;
					break;
				case 10:
					return $vMucChuan+$vChenhLech-$vViPham*0.4;
					break;
			}
				
		}
		return $vMucTraVe;
		/*
		* 0.4đ (đ/v VTCV có mức xét thưởng HTNV là 10%).
		* 0.7đ (đ/v VTCV có mức
		 xét thưởng HTNV là 20%).
		* 1.0đ (đ/v VTCV có mức
		 xét thưởng HTNV là 30%).
		* 1.4đ (đ/v VTCV có mức xét thưởng HTNV là 40%).
		* 1.7đ (đ/v VTCV có mức
		 xét thưởng HTNV là 50%).
 		*/
	}
	//Mức chuẩn CHNQ+HTNV
	function LV_GetMucChuan_CHNQ_HTNV($vYear,$vMonth,$vListStaff)
	{
		$vMonthFrom=(int)$vMonthFrom;
		$vMonthTo=(int)$vMonthTo;
		if($vListStaff!="")
			$lvsql="select A.lv002 StaffID,A.lv036 CHNQ_HTNV from tc_lv0009 A where A.lv004='$vYear' and A.lv003='$vMonth' and A.lv002 in ($vListStaff)";
		else
			$lvsql="select A.lv002 StaffID,A.lv036 CHNQ_HTNV from tc_lv0009 A where A.lv004='$vYear' and A.lv003='$vMonth'";
		$vresult= db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($vrow['StaffID']=='086') $vrow['StaffID']='1803';
			if($this->ArrMucChuan_CHNQ_HTNV[$vrow['StaffID']]<$vrow['CHNQ_HTNV']) $this->ArrMucChuan_CHNQ_HTNV[$vrow['StaffID']]=$vrow['CHNQ_HTNV'];	
		}
	}
	function LV_GetRateError($vYear,$vMonthFrom,$vMonthTo,$vListStaff)
	{
		if($this->ArrError==true) return ;
		$this->ArrErrorCHNQ=Array();
		$this->ArrErrorHTNV=Array();
		$this->ArrErrorCC=Array();
		if($vListStaff!="")
			$vsql="select * from hr_lv0036 where year(lv006)='$vYear' and (month(lv006)>='$vMonthFrom' and month(lv006)<='$vMonthTo') and lv002 in ($vListStaff)";
		else
			$vsql="select * from hr_lv0036 where year(lv006)='$vYear' and (month(lv006)>='$vMonthFrom' and month(lv006)<='$vMonthTo') ";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($vrow['lv002']=='086') $vrow['lv002']='1803';
			$vMonthCal=(int)getmonth($vrow['lv006']);
			if($vrow['lv007']>0)
			{
				$this->ArrErrorCHNQ[$vrow['lv002']]['CHNQ.'.$vMonthCal]=$this->ArrErrorCHNQ[$vrow['lv002']]['CHNQ.'.$vMonthCal]+$vrow['lv007'];
				//echo "[".$vrow['lv002']."][CHNQ$vMonthCal]=".$this->ArrErrorCHNQ[$vrow['lv002']]['CHNQ.'.$vMonthCal]."<br/>";
				if($this->ArrErrorCHNQ[$vrow['lv002']]['CHNQ.'.$vMonthCal]>10) $this->ArrErrorCHNQ[$vrow['lv002']]['CHNQ.'.$vMonthCal]=10;
			}
			if($vrow['lv012']>0)
			{
				$this->ArrErrorHTNV[$vrow['lv002']]['HTNV.'.$vMonthCal]=$this->ArrErrorHTNV[$vrow['lv002']]['HTNV.'.$vMonthCal]+$vrow['lv012'];
			}
		}
		$this->ArrError=true;
	}
	//Lấy binh quan CHNQ+HTNV
	function LV_GetBQHTNV($vYear,$vMonthFrom,$vMonthTo,$vListStaff)
	{
		$vMonthFrom=(int)$vMonthFrom;
		$vMonthTo=(int)$vMonthTo;
		if($vListStaff!="")
			$lvsql="select A.lv002 StaffID,A.lv031 CHNQ,A.lv032 HTNV,A.lv003 MonthCal from tc_lv0009 A where A.lv004='$vYear' and (A.lv003>='$vMonthFrom' and A.lv003<='$vMonthTo') and A.lv002 in ($vListStaff)";
		else
			$lvsql="select A.lv002 StaffID,A.lv031 CHNQ,A.lv032 HTNV,A.lv003 MonthCal from tc_lv0009 A where A.lv004='$vYear' and (A.lv003>='$vMonthFrom' and A.lv003<='$vMonthTo')";
		$vresult= db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			//if($vrow['StaffID']=='086') $vrow['StaffID']='1803';
			$vMonthCal=(int)$vrow['MonthCal'];
			if($vMonthTo==$vMonthCal)
			{
				//if($vrow['StaffID']=='001') echo $vMonthTo."=>".$vrow['StaffID'].'==>'.$vrow['HTNV'].'<br/>';
				$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']][99]=$vrow['HTNV'];
			}
			if($this->ArrBQ_LUONG[$vrow['StaffID']]['T.'.$vMonthCal]>0)
			{
				if($vrow['CHNQ']-$this->ArrErrorHTNV[$vrow['StaffID']]['CHNQ.'.$vMonthCal]>=0) 
				{
					$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']][0]=$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']][0]+$vrow['CHNQ']-$this->ArrErrorCHNQ[$vrow['StaffID']]['CHNQ.'.$vMonthCal];
					$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']][2]=$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']][2]+$vrow['CHNQ']-$this->ArrErrorCHNQ[$vrow['StaffID']]['CHNQ.'.$vMonthCal];
				}
				if($vrow['HTNV']-$this->ArrErrorHTNV[$vrow['StaffID']]['HTNV.'.$vMonthCal]>=0) 
				{
					$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']][0]=$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']][0]+$vrow['HTNV']-$this->ArrErrorHTNV[$vrow['StaffID']]['HTNV.'.$vMonthCal];
					$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']][1]=$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']][1]+$vrow['HTNV']-$this->ArrErrorHTNV[$vrow['StaffID']]['HTNV.'.$vMonthCal];
				}
				
				$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']][3]=$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']][3]+1;

				$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']]['CHNQ.'.$vMonthCal]=$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']]['CHNQ.'.$vMonthCal]+$vrow['CHNQ']-$this->ArrErrorCHNQ[$vrow['StaffID']]['CHNQ.'.$vMonthCal];
				if($this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']]['CHNQ.'.$vMonthCal]<0) $this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']]['CHNQ.'.$vMonthCal]=0;
				$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']]['HTNV.'.$vMonthCal]=$this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']]['HTNV.'.$vMonthCal]+$vrow['HTNV']-$this->ArrErrorHTNV[$vrow['StaffID']]['HTNV.'.$vMonthCal];
				if($this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']]['HTNV.'.$vMonthCal]<0) $this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']]['HTNV.'.$vMonthCal]=0;
			}
			if($vrow['StaffID']=='982') $this->ArrBQ_CHNQ_HTNV[$vrow['StaffID']][99]=0;
		}
	}
	function LV_GetBacLuongCongTy($vStaffID,$vLevelID,$vStartDate,$vDateCal='',&$vBacCu=null,$vEndDate='')
	{
		$vConditionDate=" AND A.lv004<='$vEndDate' ";
		if(trim($vLevelID)=='' || $vLevelID==NULL)
		{
			$vsql="select B.*,A.lv004 StartDate,A.lv005 EndDate from hr_lv0033 A inner join hr_lv0008 B on A.lv003=B.lv001 where A.lv002='$vStaffID' $vConditionDate order by A.lv004 DESC,A.lv001 DESC limit 0,1";
			$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			return $vrow;
		}
		else
		{
			$vsql="select B.*,A.lv004 StartDate,A.lv005 EndDate from hr_lv0033 A inner join hr_lv0008 B on A.lv003=B.lv001 where A.lv002='$vStaffID' $vConditionDate order by A.lv004 DESC,A.lv001 DESC limit 0,1";
			$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow['StartDate']>$vStartDate)
			{
					//Xác định trong tháng
					if(getmonth($vrow['StartDate'])==getmonth($vDateCal) && getyear($vrow['StartDate'])==getyear($vDateCal) )
					{
						//Lấy bậc cũ
						//Lấy bậc mới.
						if(getday($vrow['StartDate'])==1)
						{
							return $vrow;
						}
						else
						{
							$vBacCu=$vrow;
							$vsql="select B.* from hr_lv0008 B where B.lv001='$vLevelID'";
							$vresult=db_query($vsql);
							$vrow=db_fetch_array($vresult);
							return $vrow;
						}
					}
					else
					{
						if($vDateCal>=$vrow['StartDate'] && $vDateCal<=$vrow['EndDate'])
						{
							return $vrow;
						}
						else
						{
							$vsql="select B.* from hr_lv0008 B where B.lv001='$vLevelID'";
							$vresult=db_query($vsql);
							$vrow=db_fetch_array($vresult);
							return $vrow;
						}	
					}		
			} 
			else
			{
				$vsql="select B.* from hr_lv0008 B where B.lv001='$vLevelID'";
				$vresult=db_query($vsql);
				$vrow=db_fetch_array($vresult);
				return $vrow;
			}
			
		}
	}
	//Lấy Bình Quan Lương
	function LV_GetBQLuong($vYear,$vMonthFrom,$vMonthTo,$vListStaff)
	{
		$vMonthFrom=(int)$vMonthFrom;
		$vMonthTo=(int)$vMonthTo;
		if($vListStaff!="")
			$lvsql="select MP.* from (select A.lv002 StaffID,A.lv004,A.lv005,sum(A.lv025+A.lv018) TongCong,sum(A.lv033-(A.lv035+A.lv040+A.lv041+A.lv042+A.lv042+A.lv088+A.lv079+A.lv076+A.lv077+A.lv078+A.lv095+A.lv089+A.lv046+A.lv087)) BQLuong,sum(A.lv026) SoPhep,sum(A.lv029) TienPhep,A.lv060,month(A.lv004) MonthCal,A.lv004 NgayTinhLuong,B.lv081 NgayKHD1Nam,A.lv059 QuiDoi,C.lv004 StartDate from tc_lv0021 A inner join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0038 C on C.lv001=A.lv056 where year(A.lv004)='$vYear' and month(A.lv004)<='$vMonthTo' and month(A.lv004)>='$vMonthFrom' and A.lv002 in ($vListStaff) group by A.lv002,A.lv060) MP order by MP.NgayTinhLuong ASC";// Còn thêm xác định (A.lv013+A.lv014)>0 luong phep A.lv029+
		else
			$lvsql="select MP.* from (select A.lv002 StaffID,A.lv004,A.lv005,sum(A.lv025+A.lv018) TongCong,sum(A.lv033-(A.lv035+A.lv040+A.lv041+A.lv042+A.lv042+A.lv088+A.lv079+A.lv076+A.lv077+A.lv078+A.lv095+A.lv089+A.lv046+A.lv087)) BQLuong,sum(A.lv026) SoPhep,sum(A.lv029) TienPhep,A.lv060,month(A.lv004) MonthCal,A.lv004 NgayTinhLuong,B.lv081 NgayKHD1Nam,A.lv059 QuiDoi,C.lv004 StartDate from tc_lv0021 A inner join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0038 C on C.lv001=A.lv056 where year(A.lv004)='$vYear' and month(A.lv004)<='$vMonthTo' and month(A.lv004)>='$vMonthFrom' group by A.lv002,A.lv060) MP order by MP.NgayTinhLuong ASC";// Còn thêm xác định (A.lv013+A.lv014)>0,luong phep 
		$vresult= db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($vrow['TongCong']>0.5)
			{
				$vMonthCal=(int)$vrow['MonthCal'];
				$vBacCtyCu=null;
				$isRun=true;
				$vTienPhepThuong=0;
				//if(($vrow['BQLuong']>0 || ( $vrow['BQLuong']==0 && $vrow['LuongPhep']>0 && $vrow['TongPhep']>=23)) && ($vrow['TongCong']>0 || ($vrow['TongCong']==0 && $vrow['TongPhep']>=23)) && $isRun)
				if($vrow['BQLuong']>0 && $vrow['TongCong']>0  && $isRun)
				{	
					$this->ArrBQ_LUONG[$vrow['StaffID']]['T.'.$vMonthCal]=$this->ArrBQ_LUONG[$vrow['StaffID']]['T.'.$vMonthCal]+$vrow['BQLuong']+$vTienPhepThuong;
					$this->ArrBQ_LUONG[$vrow['StaffID']]['C.'.$vMonthCal]=$this->ArrBQ_LUONG[$vrow['StaffID']]['C.'.$vMonthCal]+$vrow['TongCong'];				
				}
			}
		}
	}
	function LV_GetOnePerson($vlv001)
	{
	$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
	$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
	$motc_lv0097=new tc_lv0097($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
	$motc_lv0097->LV_LoadID($vlv001);
	$motc_lv0013->LV_LoadID($motc_lv0097->lv002);
	$mohr_lv0020->LV_LoadID($motc_lv0097->lv003);
	//$mohr_lv0038->LV_LoadID($motc_lv0020->lv033);
	//$vPBCha=$mohr_lv0020->LV_GetPBLon($mohr_lv0020->lv029);
	//$vFNUsed=$motc_lv0008->LV_CheckOne_FNCB($motc_lv0020->lv002,$motc_lv0013->lv007,0);
	//$vFNMonth=$motc_lv0009->LV_FNLoadMonthID($motc_lv0020->lv002,$motc_lv0013->lv006,$motc_lv0013->lv007);
	$vstrRetrun='';
		$vstrRetrun=$vstrRetrun.'
		<div style="float:left;width:489px;border:0px #c3c3c3 solid;padding-right:20px;padding-bottom:10px">
	<div style="width:489px;border:1px #c3c3c3 solid;">
	<table style="width: 489px;" border="1" cellspacing="0" cellpadding="0" align="left">
	<tbody>
		<tr>
			<td align="center" colspan="4" height="36" valign="middle"><b><font size="2">PHIẾU NHẬN TIỀN THƯỞNG '.($motc_lv0013->lv007-1).'</font></b></td>
		</tr>
		<tr>
			<td align="center" height="32" valign="bottom">'.($mohr_lv0020->getvaluelink('lv029',$mohr_lv0020->lv029)).'</td>
			<td align="center" valign="bottom">'.$mohr_lv0020->lv002.'</td>
			<td align="center" valign="bottom">'.$mohr_lv0020->lv001.'</td>
			<td align="center" valign="bottom">'.$motc_lv0097->lv001.'</td>
		</tr>
		<tr>
			<td align="right" colspan="2" height="27" valign="bottom">Thưởng tế/ Thưởng 3 tại chỗ:</td>
			<td align="center" colspan="2" valign="bottom">'.$motc_lv0097->FormatView($motc_lv0097->lv027,20).'</td>
		</tr>
		<tr>
			<td align="right" colspan="2" height="29" valign="bottom">Tiền thưởng th&ecirc;m HQ '.($motc_lv0013->lv007-2).':</td>
			<td align="center" colspan="2" valign="bottom">'.$motc_lv0097->FormatView($motc_lv0097->lv009,20).'</td>
		</tr>
		<tr>
			<td align="right" colspan="2" height="29" valign="bottom">Tiền thưởng HQ '.($motc_lv0013->lv007-1).':</td>
			<td align="center" colspan="2" valign="bottom">'.$motc_lv0097->FormatView($motc_lv0097->lv008+$motc_lv0097->lv010,20).'</td>
		</tr>
		
		<tr>
			<td align="right" colspan="2" height="32" valign="bottom"><b>Tổng thưởng: </b></td>
			<td align="center" colspan="2" valign="bottom"><b>'.$motc_lv0097->FormatView($motc_lv0097->lv010+$motc_lv0097->lv009+$motc_lv0097->lv008+$motc_lv0097->lv027,20).'</b></td>
		</tr>
		<tr>
			<td align="right" colspan="2" height="27" valign="bottom">Trừ thuế thu nhập:</td>
			<td align="center" colspan="2" valign="bottom">'.$motc_lv0097->FormatView($motc_lv0097->lv011,20).'</td>
		</tr>
		<tr>
			<td align="right" colspan="2" height="27" valign="bottom">Giảm thưởng do không trực tết</td>
			<td align="center" colspan="2" valign="bottom">'.$motc_lv0097->FormatView($motc_lv0097->lv012,20).'</td>
		</tr>
		<tr>
			<td align="right" colspan="2" height="27" valign="bottom">Trừ thuế TNCN</td>
			<td align="center" colspan="2" valign="bottom">'.$motc_lv0097->FormatView($motc_lv0097->lv011,20).'</td>
		</tr>
		<tr>
			<td align="right" colspan="2" height="32" valign="bottom"><b>Thực lãnh: </b></td>
			<td align="center" colspan="2" valign="bottom"><b>'.$motc_lv0097->FormatView($motc_lv0097->lv013,20).'</b></td>
		</tr>
		<tr>
			<td align="center" height="28" valign="bottom"><b><br />
				</b></td>
			<td align="center" colspan="3" valign="bottom"><b>Lập biểu</b></td>
		</tr>
		<tr>
			<td align="left" height="16" valign="bottom" rowspan="3"><b><br />
				</b></td>
			<td align="center" valign="bottom" colspan="3" rowspan="3" height="100"><b>'.(($this->NguoiKy!='')?'<img src="../../nguoiky/'.$this->NguoiKy.'.jpg" style="height:80px"/>':'').'
				</b>
			</td>
			
		</tr>
		<tr>
			
		</tr>
		<tr>
			
		</tr>
		<tr>
			<td align="left" height="28" valign="bottom"><b><br />
				</b></td>
			<td align="center" colspan="3" valign="bottom"><b>'.(($this->NguoiKy!='')?$this->TenNguoiKy:'..................').'</b></td>
		</tr>
	</tbody>
</table>

	</div>
	</div>
	
';
		return $vstrRetrun;
	}
		////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0097 A inner join hr_lv0020 B on A.lv003=B.lv001 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	public function GetBuilCheckListDept($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002',$vDepID="")
	{
		$vListID=",".$vListID.",";
		$strTbl="<table  align=\"center\" class=\"lvtable\">
		<input type=\"hidden\" id=$vID name=$vID value=\"@#02\">
		@#01
		</table>
		";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>
			
		</tr>
		";
		if($vDepID=="") 
		{
			$vsql="select * from  ".$vTbl." where lv002='HRKPI'";
		}
		else
		{
			$vReturn="'".str_replace(",","','",$vDepID)."'";
			$vsql="select lv001,lv003 from  hr_lv0002 where (lv001 in ($vReturn))  order by lv003";
		}
		
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
				$strTempChk=str_replace("@03","",$strTempChk);
			else
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			
			$strTempChk=str_replace("@04",$vrow['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			if($this->LV_IsNameDep==1)
				$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
			else
				$strTemp=str_replace("@#02",$vrow[$vFieldView],$strTemp);
			$strGetScript=$strGetScript.$strTemp;
			$strGetScript=$strGetScript.$this->GetBuilCheckListChild($vListID,$vID,$vrow['lv001'],$vTbl,$vFieldView,$i,$numrows,'');
			$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	function GetBuilCheckListChild($vListID,$vID,$vParentID,$vTbl,$vFieldView,&$i,&$numrows,$vspace)
	{
		$strGetScript="";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>			
		</tr>
		";
		$vsql1="select * from  ".$vTbl." where lv002='".$vParentID."' order by lv003";
		$vresult1=db_query($vsql1);
		$vnum=db_num_rows($vresult1);
		$numrows=$numrows+$vnum;
		$i++;
		while($vrow1=db_fetch_array($vresult1))		
		{
			$strTempChk=str_replace("@01",$i,$lvChk);
			$strTempChk=str_replace("@02",$vrow1['lv001'],$strTempChk);
			if(strpos($vListID,",".$vrow1['lv001'].",") === FALSE)
				$strTempChk=str_replace("@03","",$strTempChk);
			else
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			
			$strTempChk=str_replace("@04",'&nbsp;&nbsp;&nbsp;'.$vrow1['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			if($this->LV_IsNameDep==1)
				$strTemp=str_replace("@#02",$vspace.'|-----'.$vrow1[$vFieldView]."(".$vrow1['lv001'].")",$strTemp);
			else
				$strTemp=str_replace("@#02",$vspace.'|-----'.$vrow1[$vFieldView],$strTemp);
			$strGetScript=$strGetScript.$strTemp;
			$strGetScript=$strGetScript.$this->GetBuilCheckListChild($vListID,$vID,$vrow1['lv001'],$vTbl,$vFieldView,$i,$numrows,$vspace.'&nbsp;&nbsp;&nbsp;');
			$i++;
		}
		$i--;
		return $strGetScript;
	}
			//////////////////////Buil list////////////////////
	function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		$this->LV_CheckLock();
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
		$lvHref="<a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\">@02</a>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$strSort=" order by A.lv016,B.lv029,A.lv003";
		$sqlS = "SELECT A.* FROM tc_lv0097 A inner join hr_lv0020 B on A.lv003=B.lv001 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$vTempF=str_replace("@01","<!--".$lstArr[$i]."-->",$lvTdF);
				$strH=$strH.$vTemp;
				$strF=$strF.$vTempF;
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vSumLv004=$vSumLv004+$vrow['lv004'];
			$vSumLv005=$vSumLv005+$vrow['lv005'];
			$vSumLv006=$vSumLv006+$vrow['lv006'];
			$vSumLv007=$vSumLv007+$vrow['lv007'];
			$vSumLv008=$vSumLv008+$vrow['lv008'];
			$vSumLv009=$vSumLv009+$vrow['lv009'];
			$vSumLv010=$vSumLv010+$vrow['lv010'];
			$vSumLv011=$vSumLv011+$vrow['lv011'];
			$vSumLv012=$vSumLv012+$vrow['lv012'];
			$vSumLv013=$vSumLv013+$vrow['lv013'];
			$vSumLv015=$vSumLv015+$vrow['lv015'];
			$vSumLv016=$vSumLv016+$vrow['lv016'];
			$vSumLv017=$vSumLv017+$vrow['lv017'];
			$vSumLv018=$vSumLv018+$vrow['lv018'];
			$vSumLv019=$vSumLv019+$vrow['lv019'];
			$vSumLv020=$vSumLv020+$vrow['lv020'];
			$vSumLv021=$vSumLv021+$vrow['lv021'];
			$vSumLv022=$vSumLv022+$vrow['lv022'];
			$vSumLv023=$vSumLv023+$vrow['lv023'];
			$vSumLv024=$vSumLv024+$vrow['lv024'];
			$vSumLv025=$vSumLv025+$vrow['lv025'];

			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv099']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv004-->",$this->FormatView($vSumLv004,10),$strF);
		$strF=str_replace("<!--lv005-->",$this->FormatView($vSumLv005,10),$strF);
		$strF=str_replace("<!--lv006-->",$this->FormatView($vSumLv006,10),$strF);
		$strF=str_replace("<!--lv007-->",$this->FormatView($vSumLv007,10),$strF);
		$strF=str_replace("<!--lv008-->",$this->FormatView($vSumLv008,10),$strF);
		$strF=str_replace("<!--lv009-->",$this->FormatView($vSumLv009,10),$strF);
		$strF=str_replace("<!--lv010-->",$this->FormatView($vSumLv010,10),$strF);
		$strF=str_replace("<!--lv011-->",$this->FormatView($vSumLv011,10),$strF);
		$strF=str_replace("<!--lv012-->",$this->FormatView($vSumLv012,10),$strF);
		$strF=str_replace("<!--lv013-->",$this->FormatView($vSumLv013,10),$strF);
		$strF=str_replace("<!--lv015-->",$this->FormatView($vSumLv015,10),$strF);
		$strF=str_replace("<!--lv016-->",$this->FormatView($vSumLv016,10),$strF);
		$strF=str_replace("<!--lv017-->",$this->FormatView($vSumLv017,10),$strF);
		$strF=str_replace("<!--lv018-->",$this->FormatView($vSumLv018,10),$strF);
		$strF=str_replace("<!--lv019-->",$this->FormatView($vSumLv019,10),$strF);
		$strF=str_replace("<!--lv020-->",$this->FormatView($vSumLv020,10),$strF);
		$strF=str_replace("<!--lv021-->",$this->FormatView($vSumLv021,10),$strF);
		$strF=str_replace("<!--lv022-->",$this->FormatView($vSumLv022,10),$strF);
		$strF=str_replace("<!--lv023-->",$this->FormatView($vSumLv023,10),$strF);
		$strF=str_replace("<!--lv024-->",$this->FormatView($vSumLv024,10),$strF);
		$strF=str_replace("<!--lv025-->",$this->FormatView($vSumLv025,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
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
			window.open('$this->Dir'+'tc_lv0097/?lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
	function LV_BuilListReport($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$vSortNum)
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
		@#02
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
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"1\">&nbsp;</td>";
		$sqlS = "SELECT * FROM tc_lv0097 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
				$strH=$strH.$vTemp;
				$strF=$strF.$vTempF;
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vSumLv004=$vSumLv004+$vrow['lv004'];
				$vSumLv005=$vSumLv005+$vrow['lv005'];
				$vSumLv006=$vSumLv006+$vrow['lv006'];
				$vSumLv007=$vSumLv007+$vrow['lv007'];
				$vSumLv008=$vSumLv008+$vrow['lv008'];
				$vSumLv009=$vSumLv009+$vrow['lv009'];
				$vSumLv010=$vSumLv010+$vrow['lv010'];
				$vSumLv011=$vSumLv011+$vrow['lv011'];
				$vSumLv012=$vSumLv012+$vrow['lv012'];
				$vSumLv013=$vSumLv013+$vrow['lv013'];
				$vSumLv015=$vSumLv015+$vrow['lv015'];
				$vSumLv016=$vSumLv016+$vrow['lv016'];
				$vSumLv017=$vSumLv017+$vrow['lv017'];
				$vSumLv018=$vSumLv018+$vrow['lv018'];
				$vSumLv019=$vSumLv019+$vrow['lv019'];
				$vSumLv020=$vSumLv020+$vrow['lv020'];
				$vSumLv021=$vSumLv021+$vrow['lv021'];
				$vSumLv022=$vSumLv022+$vrow['lv022'];
				$vSumLv023=$vSumLv023+$vrow['lv023'];
				$vSumLv024=$vSumLv024+$vrow['lv024'];
				$vSumLv025=$vSumLv025+$vrow['lv025'];
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv004-->",$this->FormatView($vSumLv004,10),$strF);
		$strF=str_replace("<!--lv005-->",$this->FormatView($vSumLv005,10),$strF);
		$strF=str_replace("<!--lv006-->",$this->FormatView($vSumLv006,10),$strF);
		$strF=str_replace("<!--lv007-->",$this->FormatView($vSumLv007,10),$strF);
		$strF=str_replace("<!--lv008-->",$this->FormatView($vSumLv008,10),$strF);
		$strF=str_replace("<!--lv009-->",$this->FormatView($vSumLv009,10),$strF);
		$strF=str_replace("<!--lv010-->",$this->FormatView($vSumLv010,10),$strF);
		$strF=str_replace("<!--lv011-->",$this->FormatView($vSumLv011,10),$strF);
		$strF=str_replace("<!--lv012-->",$this->FormatView($vSumLv012,10),$strF);
		$strF=str_replace("<!--lv013-->",$this->FormatView($vSumLv013,10),$strF);
		$strF=str_replace("<!--lv015-->",$this->FormatView($vSumLv015,10),$strF);
		$strF=str_replace("<!--lv016-->",$this->FormatView($vSumLv016,10),$strF);
		$strF=str_replace("<!--lv017-->",$this->FormatView($vSumLv017,10),$strF);
		$strF=str_replace("<!--lv018-->",$this->FormatView($vSumLv018,10),$strF);
		$strF=str_replace("<!--lv019-->",$this->FormatView($vSumLv019,10),$strF);
		$strF=str_replace("<!--lv020-->",$this->FormatView($vSumLv020,10),$strF);
		$strF=str_replace("<!--lv021-->",$this->FormatView($vSumLv021,10),$strF);
		$strF=str_replace("<!--lv022-->",$this->FormatView($vSumLv022,10),$strF);
		$strF=str_replace("<!--lv023-->",$this->FormatView($vSumLv023,10),$strF);
		$strF=str_replace("<!--lv024-->",$this->FormatView($vSumLv024,10),$strF);
		$strF=str_replace("<!--lv025-->",$this->FormatView($vSumLv025,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	
	public function LV_LinkField($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),2));
	}
	private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0013";
				break;
			case 'lv003':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv014':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018";
				break;
			case 'lv129':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002";
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
			case 'lv003':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";	
				break;
			case 'lv014':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018 where lv001='$vSelectID'";
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