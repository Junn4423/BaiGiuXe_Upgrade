<?php
/////////////coding tc_lv0029///////////////
class   tc_lv0059 extends lv_controler
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
	public $lvNVID=null;

///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='tc_lv0029';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"2","lv005"=>"0","lv006"=>"0","lv007"=>"0");	

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=0;
		$this->isRpt=0;	
		$this->isAdd=0;
		$this->isEdit=0;
		$this->isApr=0;
		$this->isUnApr=0;
	 	$this->isHelp=1;	
		$this->isConfig=0;
	 	$this->isFil=0;	
		$this->isDel=0;
		$this->lang=$_GET['lang'];		
	}
	function GetEmployeeID($vTimeCardEmpID)
	{
		if(trim($vTimeCardEmpID)=='') return '';
		$lvsql="select lv001 from hr_lv0020 where (lv001='$vTimeCardEmpID' or lv099='$vTimeCardEmpID' or ( concat(',',lv099,',') like '%,$vTimeCardEmpID,%'   ) ) and lv009 not in (2,3)";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv001']!="" && $vrow['lv001']!=NULL)
			{
				return $vrow['lv001'];
			}
			else
			return '';
		}
		return '';
		
	}
	function LV_LoadSQLServer($vServer,$vUser,$vPass,$vDatabase,$vYear,$vMonth,$vDay,$vopt)
	{
		$link = mssql_connect($vServer, $vUser, $vPass);

		if (!$link || !mssql_select_db($vDatabase, $link)) {
			die('Unable to connect or select database!');
		}
		$vcondition="and YEAR(A.GioCham)=$vYear and MONTH(A.GioCham)=$vMonth ";
		if($vopt==0) $vcondition=$vcondition." AND DAY(A.GioCham)=$vDay ";
		
		$lvsql="SELECT  A.MaChamCong [MaChamCong],B.MaNhanVien [MaNhanVien]
      ,[NgayCham]
      ,CONVERT(VARCHAR(20),[GioCham],120) GioCham
      ,[KieuCham]
      ,[NguonCham]
      ,[MaSoMay]
      ,[TenMay]
  FROM  ".$vDatabase.".[dbo].[CheckInOut] A inner join ".$vDatabase.".[dbo].[NHANVIEN] B on A.MaChamCong=B.MaChamCong  where 1=1 $vcondition";  
		$vresult=mssql_query($lvsql);
		while($vrow=mssql_fetch_array($vresult))
		{
			$lvdate=substr($vrow["GioCham"],0,10);
			$lvtime=substr($vrow["GioCham"],11,8);
			$linout=0;//$vrow["KieuCham"];
			$lvEmpID=$vrow['MaChamCong'];
			$lvMaSoMay='VP-'.$vrow['MaSoMay'];
			$lvEmpID=$this->GetEmployeeID($lvEmpID);	
			if($lvEmpID!="")			$this->Insert($lvEmpID,$lvdate,$lvtime,$linout,$lvMaSoMay);
			$i++;

		}

		mssql_free_result($vresult);

	}
	/*
	function LV_LoadSQLServer($vServer,$vUser,$vPass,$vDatabase,$vYear,$vMonth,$vDay,$vopt)
	{
		$link = mssql_connect($vServer, $vUser, $vPass);

		if (!$link || !mssql_select_db($vDatabase, $link)) {
			die('Unable to connect or select database!');
		}
		$vcondition="and YEAR(A.TimeStr)=$vYear and MONTH(A.TimeStr)=$vMonth ";
		if($vopt==0) $vcondition=$vcondition." AND DAY(A.TimeStr)=$vDay ";
		
		$lvsql="SELECT  [UserFullCode]
      ,[UserEnrollNumber]
      ,[TimeDate]
      ,CONVERT(VARCHAR(20),[TimeStr],120) TimeStr
      ,[TimeType]
      ,[TimeSource]
      ,[MachineNo]
      ,[CardNo]
  FROM ".$vDatabase.".dbo.CheckInOut A  where 1=1 $vcondition";  
		$vresult=mssql_query($lvsql);
		while($vrow=mssql_fetch_array($vresult))
		{
			$lvdate=substr($vrow["TimeStr"],0,10);
			$lvtime=substr($vrow["TimeStr"],11,8);
			$linout=$vrow["TimeType"];
			$lvEmpID=$vrow['UserEnrollNumber'];
			$lvEmpID=$this->GetEmployeeID($lvEmpID);	
			if($lvEmpID!="")			$this->Insert($lvEmpID,$lvdate,$lvtime,$linout);
			$i++;

		}

		mssql_free_result($vresult);

	}*/
	function LoadAccess($molv_toolodbc,$datadate,$table,$employeeid,$dateemp,$timeemp,$TypeInOut)
	{
		if($TypeInOut!="")
		{
			$vsql="select B.".$employeeid.",Format(".$dateemp.",'yyyy/mm/dd') as dateemp ,Format(".$timeemp.",'h:m:s') as timeemp,$TypeInOut as inout from ".$table." A left join USERINFO B on A.USERID=B.USERID where Format(".$dateemp.",'mm/dd/yyyy')='".$datadate."'";
		}
		else
		$vsql="select B.".$employeeid.",Format(".$dateemp.",'yyyy/mm/dd') as dateemp ,Format(".$timeemp.",'h:m:s') as timeemp from ".$table." A left join USERINFO B on A.USERID=B.USERID where Format(".$dateemp.",'mm/dd/yyyy')='".$datadate."'";
		$i=1;
		$vresult=$molv_toolodbc->mssql_exec($vsql);
		while($vrow=$molv_toolodbc->mssql_fetch_arrays($vresult))
		{
			$lvdate=$vrow["dateemp"];
			$lvtime=$vrow["timeemp"];
			$linout=$vrow["inout"];
			
			$lvEmpID=$this->GetEmployeeID($vrow["$employeeid"]);	
			if($lvEmpID!="")			$this->Insert($lvEmpID,$lvdate,$lvtime,$linout);
			$i++;
		}
	}
	function Insert($EmployeeID,$Date,$Time,$linout,$lvMaSoMay)
	{
		$lvsql="insert into tc_lv0012(lv001,lv002,lv003,lv004,lv099) values('$EmployeeID','$Date','$Time','$linout','$lvMaSoMay');";
		return db_query($lvsql);
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
	public function LV_ViewHelp($lvList,$lvFrom,$maxRows)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		return $this->TabFunction($lvFrom,$lvList,$maxRows);
	}
}

?>