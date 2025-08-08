<?php
/////////////coding jo_lv0004///////////////
class   jo_lv0004 extends lv_controler
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
	public $lv018=null;
	public $lv019=null;
	public $lv020=null;
	public $lv021=null;
	public $lv022=null;	
	public $lv023=null;
	public $ArrJobs=null;
///////////
	public $DefaultFieldList="lv001,lv099,lv015,lv829,lv003,lv022,lv025,lv016,lv017,lv098,lv008,lv013,lv018,lv019,lv021,lv009,lv010,lv025";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='jo_lv0004';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv099"=>"100","lv098"=>"99","lv829"=>"830");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"4","lv006"=>"0","lv007"=>"4","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"0","lv016"=>"4","lv017"=>"4","lv018"=>"4","lv019"=>"4","lv020"=>"0","lv021"=>"0","lv022"=>"0","lv023"=>"0","lv024"=>"2","lv025"=>"22","lv099"=>"0","lv829"=>"0");	
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
		$this->ArrJobs=Array();
	}
	function LV_Load()
	{
		$vsql="select * from  jo_lv0004";
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
		}
	}
	function LV_CheckPhepMonth($vEmpID,$vDateFrom,$vDateTo)
	{
		//if($vCheckNT==1)
		//{	
			$vYear=getyear($vDateFrom);
			$vMonth=getmonth($vDateFrom);
			$vNumDayInMonth = GetDayInMonth((int)$vYear,(int)$vMonth);
			$vDateLonHon=$vDateFrom;
			$vDateNhoHon=$vDateTo;
			$lvsql="select SUM(IF(A.lv003='P',1,IF(A.lv003='0.5P',0.5,0))) PHEP from  jo_lv0004 A left join jo_lv0100 C on A.lv022=C.lv001 Where A.lv002='$vEmpID' and ((A.lv016<='$vDateNhoHon 23:59:59' and A.lv016>='$vDateLonHon 00:00:00') or (A.lv017<='$vDateNhoHon 23:59:59' and A.lv017>='$vDateLonHon 00:00:00') or (A.lv017>='$vDateNhoHon 00:00:00' and A.lv016<='$vDateLonHon 23:59:59'))";
		
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		
		return $vrow['PHEP'];
		
	}
	function LV_GetNameVietTat($vPBID)
	{
		if($this->ArrPBVT[$vPBID][0]) return $this->ArrPBVT[$vPBID][1];
		$this->OrderRun=0;
		$vsql="select lv002,lv004 from  hr_lv0002 where lv001='$vPBID'";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			if(trim($vrow['lv004'])=='')
				 $this->ArrPBVT[$vPBID][1]=$this->LV_GetNameVietTatParent($vrow['lv002']);
			else
				$this->ArrPBVT[$vPBID][1]=$vrow['lv004'];
			break;
		}
		$this->ArrPBVT[$vPBID][0]=true;
		return $this->ArrPBVT[$vPBID][1];
	}
	
	function LV_GetNameVietTatParent($vPBID)
	{
		$this->OrderRun++;
		if($this->OrderRun>10) return '';
		if($vPBID=='SOF') return '';
		$vsql="select lv002,lv004 from  hr_lv0002 where lv001='$vPBID'";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			if(trim($vrow['lv004'])=='')
				return $this->LV_GetNameVietTatParent($vrow['lv002']);
			else
				return $vrow['lv004'];
		}
	}
	function LV_CheckPhepFilter($vDateFrom,$vDateTo)
	{
		//if($vCheckNT==1)
		//{	
			$vYear=getyear($vDateFrom);
			$vMonth=getmonth($vDateFrom);
			$vNumDayInMonth = GetDayInMonth((int)$vYear,(int)$vMonth);
			$vDateLonHon=$vDateFrom;
			$vDateNhoHon=$vDateTo;
			$lvsql="select A.lv001,A.lv015,A.lv016,A.lv017,A.lv022,A.lv021,A.lv002,A.lv003 TimeCard,TIMEDIFF(A.lv017,lv016) TimeNghi,DATEDIFF(A.lv017,lv016) NumsRequire,DATEDIFF(A.lv019,lv018) NumsAproval,C.lv004 TimesAdd from  jo_lv0004 A left join jo_lv0100 C on A.lv022=C.lv001 Where  ((A.lv016<='$vDateNhoHon 23:59:59' and A.lv016>='$vDateLonHon 00:00:00') or (A.lv017<='$vDateNhoHon 23:59:59' and A.lv017>='$vDateLonHon 00:00:00') or (A.lv017>='$vDateNhoHon 00:00:00' and A.lv016<='$vDateLonHon 23:59:59'))";
		//}
		//elseA.lv015
		//	$lvsql="select A.lv001,A.lv015,A.lv016,A.lv017,A.lv022,A.lv021,A.lv002,A.lv003 TimeCard,DATEDIFF(A.lv017,lv016) NumsRequire,DATEDIFF(A.lv019,lv018) NumsAproval,C.lv004 TimesAdd from  jo_lv0004 A left join jo_lv0100 C on A.lv022=C.lv001 Where A.lv015 in ($vListEmp) and (A.lv016<='$vDate 23:59:59' and A.lv017>='$vDate 00:00:00') and lv021=1 ";
		$strEmp='';
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			if(getmonth($vrow['lv017'])==getmonth($vrow['lv016']))
			{
				$vdateto=substr($vrow['lv017'],0,10);
				$vdatefrom=substr($vrow['lv016'],0,10);
				$datecur=$vdatefrom;
				$vNums=$vrow['NumsRequire']+1;
				if($vNums<=0) $vNums=1;
				if($vNums>31) $vNums=31;
			}
			else
			{
				if($vMonth==getmonth($vrow['lv017']) && $vYear==getyear($vrow['lv017']))
					$vdateto=substr($vrow['lv017'],0,10);
				else
					$vdateto=$vDateNhoHon;
				if($vMonth==getmonth($vrow['lv016']) && $vYear==getyear($vrow['lv016']))
					$vdatefrom=substr($vrow['lv016'],0,10);
				else
					$vdatefrom=$vDateLonHon;
				$datecur=$vdatefrom;
				$vNums=getday($vdateto)-getday($vdatefrom)+1;
			}
			for($i=1;$i<=$vNums;$i++)
			{
				if($strEmp=='') $strEmp="'".$vrow['lv001']."'";
				$strEmp=$strEmp.",'".$vrow['lv001']."'";
			}
		}
		return $strEmp;
	}
	function LV_CheckPhep($vEmpID,$vDate)
	{
		$lvsql="select A.*,B.lv003 TimeCard,DATEDIFF(A.lv017,lv016) NumsRequire,DATEDIFF(A.lv019,lv018) NumsAproval,C.lv004 TimesAdd from  jo_lv0004 A left join jo_lv0002 B on A.lv003=B.lv001 left join jo_lv0100 C on A.lv002=C.lv001 Where A.lv015='$vEmpID' and (A.lv018<='$vDate 23:59:59' and A.lv019>='$vDate 00:00:00') and lv021=1 and lv006=1";
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
			$this->Shift=$vrow['lv002'];
			$this->TimeCard=$vrow['TimeCard'];
			$this->TimesAdd=$vrow['TimesAdd'];
			$this->NumsRequire=$vrow['NumsRequire']+1;
			$this->NumsAproval=$vrow['NumsAproval']+1;
		}
		else
		{
			$this->lv001=null;
			$this->lv002=null;
			$this->lv003=null;
			$this->lv004=null;
			$this->lv005=null;
			$this->lv006=null;
			$this->lv007=null;
			$this->lv008=null;
			$this->lv009=null;
			$this->lv010=null;
			$this->lv011=null;
			$this->lv012=null;
			$this->lv013=null;
			$this->lv014=null;
			$this->lv015=null;
			$this->lv016=null;
			$this->lv017=null;
			$this->lv018=null;
			$this->lv019=null;
			$this->lv020=null;
			$this->lv021=null;
			$this->lv022=null;
			$this->lv023=null;
			$this->TimeCard='';
		}
		
	}
	//lay 1 lan ta ca nhan vien hay phong ban va ngay
	function LV_CheckPhepStateArrMulti($vDate,$vCheckNT=0,$vListEmp)
	{
		$this->ArrJobs=Array();
		//if($vCheckNT==1)
		//{	
			$vYear=getyear($vDate);
			$vMonth=getmonth($vDate);
			$vNumDayInMonth = GetDayInMonth((int)$vYear,(int)$vMonth);
			$vDateLonHon=$vYear."-".$vMonth."-01";
			$vDateNhoHon=$vYear."-".$vMonth."-".Fillnum($vNumDayInMonth,2);
			$lvsql="select A.lv001,A.lv015,A.lv016,A.lv017,A.lv022,A.lv021,A.lv002,A.lv003 TimeCard,TIMEDIFF(A.lv017,lv016) TimeNghi,DATEDIFF(A.lv017,lv016) NumsRequire,DATEDIFF(A.lv019,lv018) NumsAproval,C.lv004 TimesAdd from  jo_lv0004 A left join jo_lv0100 C on A.lv022=C.lv001 Where A.lv015 in ($vListEmp) and ((A.lv016<='$vDateNhoHon 23:59:59' and A.lv016>='$vDateLonHon 00:00:00') or (A.lv017<='$vDateNhoHon 23:59:59' and A.lv017>='$vDateLonHon 00:00:00') or (A.lv017>='$vDateNhoHon 00:00:00' and A.lv016<='$vDateLonHon 23:59:59')) and  lv021=1";
		//}
		//else
		//	$lvsql="select A.lv001,A.lv015,A.lv016,A.lv017,A.lv022,A.lv021,A.lv002,A.lv003 TimeCard,DATEDIFF(A.lv017,lv016) NumsRequire,DATEDIFF(A.lv019,lv018) NumsAproval,C.lv004 TimesAdd from  jo_lv0004 A left join jo_lv0100 C on A.lv022=C.lv001 Where A.lv015 in ($vListEmp) and (A.lv016<='$vDate 23:59:59' and A.lv017>='$vDate 00:00:00') and lv021=1 ";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			if(getmonth($vrow['lv017'])==getmonth($vrow['lv016']))
			{
				$vdateto=substr($vrow['lv017'],0,10);
				$vdatefrom=substr($vrow['lv016'],0,10);
				$datecur=$vdatefrom;
				$vNums=$vrow['NumsRequire']+1;
				if($vNums<=0) $vNums=1;
				if($vNums>31) $vNums=31;
			}
			else
			{
				if($vMonth==getmonth($vrow['lv017']) && $vYear==getyear($vrow['lv017']))
					$vdateto=substr($vrow['lv017'],0,10);
				else
					$vdateto=$vDateNhoHon;
				if($vMonth==getmonth($vrow['lv016']) && $vYear==getyear($vrow['lv016']))
					$vdatefrom=substr($vrow['lv016'],0,10);
				else
					$vdatefrom=$vDateLonHon;
				$datecur=$vdatefrom;
				$vNums=getday($vdateto)-getday($vdatefrom)+1;
			}
			for($i=1;$i<=$vNums;$i++)
			{
				if($this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]==null)
					$vCount=0;
				else
					$vCount=count($this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]);
				$vDows=date('w', strtotime($datecur))+1;
				$vRunOk=true;
				//echo "$datecur => ".$vrow['lv022']."<br/>";
				if($vDows==1 )
				{
					switch($vrow['lv022'])
					{
						case 0:
							$vRunOk=false; 
							break;
						default:
							break;
					}
					
				}
				if($vRunOk)
				{
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][0][0]=true;
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['lv001']=$vrow['lv001'];
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['lv002']=$vrow['lv002'];
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['lv003']=$vrow['lv003'];
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['lv004']=$vrow['lv004'];
					
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['lv015']=$vrow['lv015'];
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['lv016']=$vrow['lv016'];
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['lv017']=$vrow['lv017'];
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['lv022']=$vrow['lv022'];
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['Shift']=$vrow['lv002'];
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['TimeCard']=$vrow['TimeCard'];
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['TimesAdd']=$vrow['TimesAdd'];
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['TimeNghi']=$vrow['TimeNghi'];
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['NumsRequire']=$vrow['NumsRequire']+1;
					$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][$vCount]['NumsAproval']=$vrow['NumsAproval']+1;
				}
				$datecur=ADDDATE($vdatefrom,$i);
			}
		}
	}
	//lay 1 lan ta ca nhan vien hay phong ban va ngay
	function LV_CheckPhepStateArr($vDate,$vCheckNT=0,$vListEmp)
	{
		//if($vCheckNT==1)
		//{	
			$vYear=getyear($vDate);
			$vMonth=getmonth($vDate);
			$vNumDayInMonth = GetDayInMonth((int)$vYear,(int)$vMonth);
			$vDateLonHon=$vYear."-".$vMonth."-01";
			$vDateNhoHon=$vYear."-".$vMonth."-".Fillnum($vNumDayInMonth,2);
			$lvsql="select A.lv001,A.lv015,A.lv016,A.lv017,A.lv022,A.lv021,A.lv002,A.lv003 TimeCard,TIMEDIFF(A.lv017,lv016) TimeNghi,DATEDIFF(A.lv017,lv016) NumsRequire,DATEDIFF(A.lv019,lv018) NumsAproval,C.lv004 TimesAdd from  jo_lv0004 A left join jo_lv0100 C on A.lv022=C.lv001 Where A.lv015 in ($vListEmp) and ((A.lv016<='$vDateNhoHon 23:59:59' and A.lv016>='$vDateLonHon 00:00:00') or (A.lv017<='$vDateNhoHon 23:59:59' and A.lv017>='$vDateLonHon 00:00:00') or (A.lv017>='$vDateNhoHon 00:00:00' and A.lv016<='$vDateLonHon 23:59:59')) and  lv021=1";
		//}
		//else
		//	$lvsql="select A.lv001,A.lv015,A.lv016,A.lv017,A.lv022,A.lv021,A.lv002,A.lv003 TimeCard,DATEDIFF(A.lv017,lv016) NumsRequire,DATEDIFF(A.lv019,lv018) NumsAproval,C.lv004 TimesAdd from  jo_lv0004 A left join jo_lv0100 C on A.lv022=C.lv001 Where A.lv015 in ($vListEmp) and (A.lv016<='$vDate 23:59:59' and A.lv017>='$vDate 00:00:00') and lv021=1 ";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			if(getmonth($vrow['lv017'])==getmonth($vrow['lv016']))
			{
				$vdateto=substr($vrow['lv017'],0,10);
				$vdatefrom=substr($vrow['lv016'],0,10);
				$datecur=$vdatefrom;
				$vNums=$vrow['NumsRequire']+1;
				if($vNums<=0) $vNums=1;
				if($vNums>31) $vNums=31;
			}
			else
			{
				if($vMonth==getmonth($vrow['lv017']) && $vYear==getyear($vrow['lv017']))
					$vdateto=substr($vrow['lv017'],0,10);
				else
					$vdateto=$vDateNhoHon;
				if($vMonth==getmonth($vrow['lv016']) && $vYear==getyear($vrow['lv016']))
					$vdatefrom=substr($vrow['lv016'],0,10);
				else
					$vdatefrom=$vDateLonHon;
				$datecur=$vdatefrom;
				$vNums=getday($vdateto)-getday($vdatefrom)+1;
			}
			for($i=1;$i<=$vNums;$i++)
			{
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']][0]=true;
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['lv001']=$vrow['lv001'];
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['lv002']=$vrow['lv002'];
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['lv003']=$vrow['lv003'];
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['lv004']=$vrow['lv004'];
				
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['lv015']=$vrow['lv015'];
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['lv016']=$vrow['lv016'];
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['lv017']=$vrow['lv017'];
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['lv022']=$vrow['lv022'];
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['Shift']=$vrow['lv002'];
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['TimeCard']=$vrow['TimeCard'];
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['TimesAdd']=$vrow['TimesAdd'];
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['TimeNghi']=$vrow['TimeNghi'];
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['NumsRequire']=$vrow['NumsRequire']+1;
				$this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]['NumsAproval']=$vrow['NumsAproval']+1;
				$datecur=ADDDATE($vdatefrom,$i);
			}
		}
	}
	function LV_CheckPhepState($vEmpID,$vDate,$vState=0)
	{
		if($this->ArrJobs[$vEmpID][$vDate][$vState][0]==true)
		{
			$this->lv001=$this->ArrJobs[$vEmpID][$vDate][$vState]['lv001'];
			$this->lv002=$this->ArrJobs[$vEmpID][$vDate][$vState]['lv002'];
			$this->lv003=$this->ArrJobs[$vEmpID][$vDate][$vState]['lv003'];
			$this->lv004=$this->ArrJobs[$vEmpID][$vDate][$vState]['lv004'];
			//$this->lv005=$vrow['lv005'];
			//$this->lv006=$vrow['lv006'];	
			//$this->lv007=$vrow['lv007'];
			//$this->lv008=$vrow['lv008'];
			//$this->lv009=$vrow['lv009'];
			//$this->lv010=$vrow['lv010'];
			//$this->lv011=$vrow['lv011'];
			//$this->lv012=$vrow['lv012'];
			//$this->lv013=$vrow['lv013'];
			//$this->lv014=$vrow['lv014'];
			$this->lv015=$this->ArrJobs[$vEmpID][$vDate][$vState]['lv015'];
			$this->lv016=$this->ArrJobs[$vEmpID][$vDate][$vState]['lv016'];
			$this->lv017=$this->ArrJobs[$vEmpID][$vDate][$vState]['lv017'];
			//$this->lv018=$vrow['lv018'];
			//$this->lv019=$vrow['lv019'];
			//$this->lv020=$vrow['lv020'];
			$this->lv021=$this->ArrJobs[$vEmpID][$vDate][$vState]['lv021'];
			$this->lv022=$this->ArrJobs[$vEmpID][$vDate][$vState]['lv022'];
			//$this->lv023=$vrow['lv023'];
			$this->Shift=$this->ArrJobs[$vEmpID][$vDate][$vState]['lv002'];
			$this->TimeCard=$this->ArrJobs[$vEmpID][$vDate][$vState]['TimeCard'];
			$this->TimesAdd=$this->ArrJobs[$vEmpID][$vDate][$vState]['TimesAdd'];
			$this->TimeNghi=$this->ArrJobs[$vEmpID][$vDate][$vState]['TimeNghi'];
			$this->NumsRequire=$this->ArrJobs[$vEmpID][$vDate][$vState]['NumsRequire']+1;
			$this->NumsAproval=$this->ArrJobs[$vEmpID][$vDate][$vState]['NumsAproval']+1;
		}
		else
		{
			$this->lv001=null;
			$this->lv002=null;
			$this->lv003=null;
			$this->lv004=null;
			$this->lv005=null;
			$this->lv006=null;
			$this->lv007=null;
			$this->lv008=null;
			$this->lv009=null;
			$this->lv010=null;
			$this->lv011=null;
			$this->lv012=null;
			$this->lv013=null;
			$this->lv014=null;
			$this->lv015=null;
			$this->lv016=null;
			$this->lv017=null;
			$this->lv018=null;
			$this->lv019=null;
			$this->lv020=null;
			$this->lv021=null;
			$this->lv022=null;
			$this->lv023=null;
			$this->TimeCard='';
			$this->TimeCard='';
		}
	}
	function LV_CheckPhepStateMulti($vEmpID,$vDate,$vState=0,$vLan=0)
	{
		if($this->ArrJobs[$vEmpID][$vDate][$vState][0][0]==true)
		{
			$this->lv001=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['lv001'];
			$this->lv002=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['lv002'];
			$this->lv003=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['lv003'];
			$this->lv004=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['lv004'];
			$this->lv015=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['lv015'];
			$this->lv016=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['lv016'];
			$this->lv017=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['lv017'];
			$this->lv021=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['lv021'];
			$this->lv022=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['lv022'];
			$this->Shift=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['lv002'];
			$this->TimeCard=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['TimeCard'];
			$this->TimesAdd=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['TimesAdd'];
			$this->TimeNghi=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['TimeNghi'];
			$this->NumsRequire=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['NumsRequire']+1;
			$this->NumsAproval=$this->ArrJobs[$vEmpID][$vDate][$vState][$vLan]['NumsAproval']+1;
			return count($this->ArrJobs[$vEmpID][$vDate][$vState]);
		}
		else
		{
			$this->lv001=null;
			$this->lv002=null;
			$this->lv003=null;
			$this->lv004=null;
			$this->lv005=null;
			$this->lv006=null;
			$this->lv007=null;
			$this->lv008=null;
			$this->lv009=null;
			$this->lv010=null;
			$this->lv011=null;
			$this->lv012=null;
			$this->lv013=null;
			$this->lv014=null;
			$this->lv015=null;
			$this->lv016=null;
			$this->lv017=null;
			$this->lv018=null;
			$this->lv019=null;
			$this->lv020=null;
			$this->lv021=null;
			$this->lv022=null;
			$this->lv023=null;
			$this->TimeCard='';
			$this->TimeCard='';
			return 0;
		}
	}
	function LV_CheckTSState($vEmpID,$vDate,$vState=0)
	{
		$lvsql="select A.*,B.lv003 TimeCard,DATEDIFF(A.lv017,lv016) NumsRequire,DATEDIFF(A.lv019,lv018) NumsAproval,C.lv004 TimesAdd from  jo_lv0004 A left join jo_lv0002 B on A.lv003=B.lv001 left join jo_lv0100 C on A.lv022=C.lv001 Where A.lv015='$vEmpID' and (A.lv016<='$vDate 23:59:59' and A.lv017>='$vDate 00:00:00') and lv021=1 and A.lv022 in ($vState)";
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
			$this->TimeCard=$vrow['TimeCard'];
			$this->TimesAdd=$vrow['TimesAdd'];
			$this->NumsRequire=$vrow['NumsRequire']+1;
			$this->NumsAproval=$vrow['NumsAproval']+1;
		}
		else
		{
			$this->lv001=null;
			$this->lv002=null;
			$this->lv003=null;
			$this->lv004=null;
			$this->lv005=null;
			$this->lv006=null;
			$this->lv007=null;
			$this->lv008=null;
			$this->lv009=null;
			$this->lv010=null;
			$this->lv011=null;
			$this->lv012=null;
			$this->lv013=null;
			$this->lv014=null;
			$this->lv015=null;
			$this->lv016=null;
			$this->lv017=null;
			$this->lv018=null;
			$this->lv019=null;
			$this->lv020=null;
			$this->lv021=null;
			$this->lv022=null;
			$this->lv023=null;
			$this->TimeCard='';
			$this->TimeCard='';
		}
		
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select A.*,B.lv003 TimeCard,DATEDIFF(A.lv017,lv016) NumsRequire,DATEDIFF(A.lv019,lv018) NumsAproval from  jo_lv0004 A left join jo_lv0002 B on A.lv003=B.lv001 Where A.lv001='$vlv001'";
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
			$this->TimeCard=$vrow['TimeCard'];
			$this->NumsRequire=$vrow['NumsRequire']+1;
			$this->NumsAproval=$vrow['NumsAproval']+1;
		}
	}
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update jo_lv0004 set lv021=1  WHERE jo_lv0004.lv001 IN ($lvarr) ";
		$vReturn= db_query($lvsql);
		if($vReturn){
		 	$this->InsertLogOperation($this->DateCurrent,'jo_lv0004.approval',sof_escape_string($lvsql));
		 }
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update jo_lv0004 set lv021=0  WHERE jo_lv0004.lv001 IN ($lvarr) ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'jo_lv0004.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_HuyDon($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update jo_lv0004 set lv021=-1  WHERE jo_lv0004.lv001 IN ($lvarr) ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'jo_lv0004.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Insert()
	{
		
		if($this->isAdd==0) return false;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		$this->lv007 = ($this->lv007!="")?recoverdate(($this->lv007), $this->lang):$this->DateDefault;
		$this->lv016 = ($this->lv016!="")?recoverdate(($this->lv016), $this->lang)." ".gettime($this->lv016):$this->DateDefault;
		$this->lv017 = ($this->lv017!="")?recoverdate(($this->lv017), $this->lang)." ".gettime($this->lv017):$this->DateDefault;
		$this->lv018 = ($this->lv018!="")?recoverdate(($this->lv018), $this->lang)." ".gettime($this->lv018):$this->DateDefault;
		$this->lv019 = ($this->lv019!="")?recoverdate(($this->lv019), $this->lang)." ".gettime($this->lv019):$this->DateDefault;
		$this->lv021 = (int) $this->lv021;
		 $lvsql="insert into jo_lv0004 (lv001,lv002,lv003,lv004,lv006,lv008,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv020,lv021,lv022,lv023,lv025) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv006','$this->lv008','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv020','$this->lv021','$this->lv022','$this->lv023',now())";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'jo_lv0004.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Insert_NoID()
	{
		
		if($this->isAdd==0) return false;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		$this->lv007 = ($this->lv007!="")?recoverdate(($this->lv007), $this->lang):$this->DateDefault;
		$this->lv016 = ($this->lv016!="")?recoverdate(($this->lv016), $this->lang)." ".gettime($this->lv016):$this->DateDefault;
		$this->lv017 = ($this->lv017!="")?recoverdate(($this->lv017), $this->lang)." ".gettime($this->lv017):$this->DateDefault;
		$this->lv018 = ($this->lv018!="")?recoverdate(($this->lv018), $this->lang)." ".gettime($this->lv018):$this->DateDefault;
		$this->lv019 = ($this->lv019!="")?recoverdate(($this->lv019), $this->lang)." ".gettime($this->lv019):$this->DateDefault;
		$this->lv021 = (int) $this->lv021;
		$lvsql="insert into jo_lv0004 (lv002,lv003,lv004,lv006,lv008,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv020,lv021,lv022,lv023,lv025) values('$this->lv002','$this->lv003','$this->lv004','$this->lv006','$this->lv008','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv020','$this->lv021','$this->lv022','$this->lv023',now())";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'jo_lv0004.insert',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		$this->lv007 = ($this->lv007!="")?recoverdate(($this->lv007), $this->lang):$this->DateDefault;
		$this->lv016 = ($this->lv016!="")?recoverdate(($this->lv016), $this->lang)." ".gettime($this->lv016):$this->DateDefault;
		$this->lv017 = ($this->lv017!="")?recoverdate(($this->lv017), $this->lang)." ".gettime($this->lv017):$this->DateDefault;
		$this->lv018 = ($this->lv018!="")?recoverdate(($this->lv018), $this->lang)." ".gettime($this->lv018):$this->DateDefault;
		$this->lv019 = ($this->lv019!="")?recoverdate(($this->lv019), $this->lang)." ".gettime($this->lv019):$this->DateDefault;
		$this->lv021 = (int) $this->lv021;
		$lvsql="Update jo_lv0004 set lv002='$this->lv002',lv003='$this->lv003',lv008='$this->lv008',lv011='$this->lv011',lv013='$this->lv013',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv020='$this->lv020',lv021='$this->lv021',lv022='$this->lv022' where  lv001='$this->lv001' and lv021<=0";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'jo_lv0004.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM jo_lv0004  WHERE jo_lv0004.lv001 IN ($lvarr) and jo_lv0004.lv021<=0 and (select count(*) from jo_lv0005 B where  B.lv002= jo_lv0004.lv001)<=0 ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'jo_lv0004.delete',sof_escape_string($lvsql));
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
		if($this->ListEmp!='') $strCondi=$strCondi." and lv001 in ($this->ListEmp)";
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
		if($this->lv012!="")  
		{
			if($this->lv015!="")  $strCondi=$strCondi." and (lv012='$this->lv012' or lv015 like '%$this->lv015%')";
			else
			$strCondi=$strCondi." and lv012='$this->lv012'";
		}
		if($this->lv013!="")  $strCondi=$strCondi." and lv013 like '%$this->lv013%'";
		if($this->lv014!="")  $strCondi=$strCondi." and lv014 like '%$this->lv014%'";
		if($this->lv015!="")  $strCondi=$strCondi." and lv015 = '$this->lv015'";
		if($this->lv016!="")  $strCondi=$strCondi." and lv016 like '%$this->lv016%'";
		if($this->lv017!="")  $strCondi=$strCondi." and lv017 like '%$this->lv017%'";
		if($this->lv018!="")  $strCondi=$strCondi." and lv018 like '%$this->lv018%'";
		if($this->lv019!="")  $strCondi=$strCondi." and lv019 like '%$this->lv019%'";
		if($this->lv020!="")  $strCondi=$strCondi." and lv020 like '%$this->lv020%'";
		if($this->lv021!="")  $strCondi=$strCondi." and lv021 like '%$this->lv021%'";
		if($this->lv022!="")  $strCondi=$strCondi." and lv022 like '%$this->lv022%'";
		if($this->lv023!="")  $strCondi=$strCondi." and lv023 like '%$this->lv023%'";
		return $strCondi;
	}
		////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM jo_lv0004 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_ReportPhep()
	{
		$vTable='
		<table cellpadding="10" cellspacing="0" style="page-break-before: always" width="977">
			<colgroup>
				<col width="27" />
				<col width="232" />
				<col width="28" />
				<col width="33" />
				<col width="84" />
				<col width="141" />
				<col width="71" />
				<col width="198" /></colgroup>
			<tbody>
				<tr>
					<td colspan="3" height="5" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="327">
						<p align="center" class="western">&nbsp;</p>
					</td>
					<td colspan="3" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="298">
						<p align="center" class="western" style="margin-bottom: 0in"><font face="Arial, sans-serif"><font style="font-size: 15pt">PHIẾU B&Aacute;O TĂNG CA</font></font></p>
						<p align="center" class="western"><font face="Arial, sans-serif">Ng&agrave;y: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</font></p>
					</td>
					<td colspan="2" style="border: 1px solid #000000; padding: 0in 0.08in" width="290">
						<p class="western" style="margin-bottom: 0in"><font face="Arial, sans-serif"><font style="font-size: 11pt">M&atilde;: BM-HCNS-15</font></font></p>
						<p class="western" style="margin-bottom: 0in"><font face="Arial, sans-serif"><font style="font-size: 11pt">Lần sửa đổi: 01</font></font></p>
						<p class="western"><font face="Arial, sans-serif"><font style="font-size: 11pt">Ng&agrave;y ban h&agrave;nh: 15/05/2012</font></font></p>
					</td>
				</tr>
				<tr>
					<td height="18" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="27">
						<p align="center" class="western"><font face="Arial, sans-serif"><b>Stt</b></font></p>
					</td>
					<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="232">
						<p align="center" class="western"><font face="Arial, sans-serif"><b>Họ t&ecirc;n</b></font></p>
					</td>
					<td colspan="2" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="81">
						<p align="center" class="western"><font face="Arial, sans-serif"><b>Từ giờ</b></font></p>
					</td>
					<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="84">
						<p align="center" class="western"><font face="Arial, sans-serif"><b>Đến giờ</b></font></p>
					</td>
					<td colspan="2" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in" width="233">
						<p align="center" class="western"><font face="Arial, sans-serif"><b>L&yacute; do tăng ca</b></font></p>
					</td>
					<td style="border: 1px solid #000000; padding: 0in 0.08in" width="198">
						<p align="center" class="western"><font face="Arial, sans-serif"><b>Kết quả c&ocirc;ng việc</b></font></p>
					</td>
				</tr>
				
				<tr>
					<td colspan="8" height="72" style="border: 1px solid #000000; padding: 0in 0.08in" valign="top" width="955">
						<p class="western" style="margin-top: 0.08in; margin-bottom: 0in"><font face="Arial, sans-serif"><span lang="en-US">P.NCNS Trưởng Bộ phận Trưởng đơn vị</span></font></p>
						<p align="center" class="western" lang="en-US" style="margin-top: 0.08in; margin-bottom: 0in">&nbsp;</p>
						<p align="center" class="western" lang="en-US" style="margin-top: 0.08in">&nbsp;</p>
					</td>
				</tr>
			</tbody>
		</table>
';
		$vTR='<tr height="17">
			<td height="17" >'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap">@#02</td>
			<td style="white-space:nowrap">@#03</td>
			<td align=center>@#04</td>
			<td align=center>@#05</td>
			<td align=center>@#06</td>
		</tr>
			
		';
		$sqlS = "SELECT *,lv015 lv829,lv015 lv099,IF(SUBSTR(lv003,1,3)='1/2',DATEDIFF(lv017,lv016)+0.5,IF(TIMEDIFF(lv017,lv016)<'24:00:00' AND DATEDIFF(lv017,lv016)<1,1,DATEDIFF(lv017,lv016)+1)) lv098 FROM jo_lv0004 WHERE 1=1  ".$this->GetCondition()."";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';
		
		$vlv079_0=0;
		$vlv024_0=0;
		$vlv019_0=0;
		$vlv028_0=0;
		$vlv015_0=0;
		$vlv020_0=0;
		$vlv050_0=0;
		$vlv025_0=0;
		$vlv085_0=0;
		$vlv043_0=0;
		$vlv039_0=0;
		$vlv045_0=0;
		$vlv035_0=0;
		$vlv048_0=0;
		$vlv084_0=0;
		$vlv080_0=0;
		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
			
				$vLineOne=$vTR;
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$this->getvaluelink('lv007',$this->FormatView($vrow['lv002'],(int)$this->ArrView['lv002'])),$vLineOne);
			$vLineOne=str_replace("@#03",$this->FormatView($vrow['lv025'],20),$vLineOne);
			$vLineOne=str_replace("@#04",$this->FormatView($vrow['lv079'],20),$vLineOne);
			$vLineOne=str_replace("@#05",$this->FormatView($vrow['lv024'],20),$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv019'],20),$vLineOne);
			$vLineOne=str_replace("@#07",$this->FormatView($vrow['lv028'],20),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView($vrow['lv015'],20),$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vrow['lv020'],20),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vrow['lv050'],20),$vLineOne);
			$vLineOne=str_replace("@#15",$this->FormatView($vrow['lv051'],20),$vLineOne);			
			$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
		}
		$strTrH=$strTrH.$vLineOne;
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		return $strFullTbl;	
	}
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
		<tr ><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</td></tr>
		@#01
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
		<tr ><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</td></tr>
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
		$lvHref="<span onclick=\"ProcessTextHiden(this)\"><a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\" class=@#04>@02</a></span>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT *,DATEDIFF(lv017,lv016) SoNgayXinPhep,lv015 lv829,lv015 lv099,IF(SUBSTR(lv003,1,3)='1/2',DATEDIFF(lv017,lv016)+0.5,IF(TIMEDIFF(lv017,lv016)<'24:00:00' AND DATEDIFF(lv017,lv016)<1,1,DATEDIFF(lv017,lv016)+1)) lv098,ADDTIME(lv025,'00:05:00') CheckNgay FROM jo_lv0004 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$strTrEnter="<td class=\"@#04\"><input title=\"Hiển thị tất cả phép\" type=\"checkbox\" name=\"txtcheckmonth\" value=\"1\" onclick=\"document.frmchoose.submit();\" ".(($this->checkmonth==1)?'checked="true"':"")."/></td><td class=\"@#04\"><input tabindex=2 type=\"checkbox\" name=\"qxtlvkeep\" value=1 ".(($this->tv001=='1')?'checked="true"':'')."/></td>";//<input type='hidden' name='qxtlv001' id='qxtlv001' value=''/><input onclick='Save()' tabindex='3' type='button' value='Thêm' style='width:80%'/></td>";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				switch($lstArr[$i])
				{				
					case 'lv099':
						$vTempEnter='<td><ul style="width:100%" id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onKeyUp="ChangeName(this,1)"> <li class="menupopT">
												<input name="qxtlv001" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:80px" onKeyUp="LoadPopupParentTabIndex(event,this,\'qxtlv015\',\'hr_lv0020\',\'concat(lv002,@! - @!,lv001)\')" tabindex="2" value="">
												<div id="lv_popup" lang="lv_popup1"> </div>						  
												</li>
											</ul></td>';
						break;						
					case 'lv002':
						$vstr='<select class="selenterquick"   name="qxtlv002" id="qxtlv002" tabindex="2" style="width:100%;min-width:50px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkFieldExt('lv002',$this->tv002).'</select>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv003':
						$vstr='<select class="selenterquick" onblur="runchangephep(this.value)"   name="qxtlv003" id="qxtlv003" tabindex="2" style="width:100%;min-width:50px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkFieldExt('lv003',$this->tv003).'</select>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
						break;
					case 'lv008':
						$vTempEnter='<td><table style="min-width:300px;"><tr><td width="*"><input name="qxtlv008" class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:80px"  tabindex="2" value="'.$this->tv008.'"></td><td><img tabindex="2" border="0" title="Add" class="imgButton" onclick="Save()" onmouseout="this.src=\'../images/iconcontrol/btn_add.jpg\';" onmouseover="this.src=\'../images/iconcontrol/btn_add_02.jpg\';" src="../images/iconcontrol/btn_add.jpg" onkeypress="return CheckKey(event,11)"></td></tr></table></td>';
						break;	
					case 'lv016':
						$vstr='<table><tr><td><input class="txtenterquick"  autocomplete="off" name="qxtlv016_1" type="text" id="qxtlv016_1" value="'.$this->tv016_1.'" tabindex="2" maxlength="32" style="width:50%;min-width:80px" onKeyPress="return CheckKey(event,7)" ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;"></td><td><input class="txtenterquick"  autocomplete="off" name="qxtlv016_2" type="text" id="qxtlv016_2" value="'.$this->tv016_2.'" tabindex="2" maxlength="32" style="width:50%;min-width:60px" onKeyPress="return CheckKey(event,7)" ></td></tr></table>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					case 'lv017':
						$vstr='<table><tr><td><input onfocus="if(this.value==\'\') this.value=document.getElementById(\'qxtlv016_1\').value" class="txtenterquick"  autocomplete="off" name="qxtlv017_1" type="text" id="qxtlv017_1" value="'.$this->tv017_1.'" tabindex="2" maxlength="32" style="width:50%;min-width:80px" onKeyPress="return CheckKey(event,7)" ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;"></td><td><input class="txtenterquick"  autocomplete="off" name="qxtlv017_2" type="text" id="qxtlv017_2" value="'.$this->tv017_2.'" tabindex="2" maxlength="32" style="width:50%;min-width:60px" onKeyPress="return CheckKey(event,7)" ></td></tr></table>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;
					
					case 'lv015':
						$vstr='<select class="selenterquick" name="qxtlv015" id="qxtlv015" tabindex="2" style="width:100%;min-width:60px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkField('lv015',$this->tv015).'</select>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;	
					case 'lv022':
						$vstr='<select  onblur="SetDefaultGio(this.value)" class="selenterquick" name="qxtlv022" id="qxtlv022" tabindex="2" style="width:100%;min-width:60px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkField('lv022',$this->tv02).'</select>';
						$vTempEnter = str_replace("@02", $vstr, $this->Align($lvTd, (int)($this->ArrView[$lstArr[$i]] ?? 0)));
						break;	
					case 'lv001':
						$vTempEnter='<td><div id="msphepid">&nbsp;</div></td>';
						break;
					default:
						$vTempEnter="<td>&nbsp;</td>";
						break;
					
				}
				$strTrEnter=$strTrEnter.$vTempEnter;
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			if($vrow['SoNgayXinPhep']<2)
			{
				if($vrow['lv008']!='CT')
				{
				//$vrow['lv008']=$vrow['lv008'].'('.'Xin phép không đúng trước 2 ngày'.')';
				}
			}
			for($i=0;$i<count($lstArr);$i++)
			{
				if ($lstArr[$i]=='lv008')
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView(str_replace(" ","&nbsp;",str_replace("\n","<br/>",$vrow[$lstArr[$i]])),(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				else
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			/*if($vrow['CheckNgay']>=$this->DateCurrent && $vrow['lv004']==0 && $vrow['lv021']==0)
				$lvTr=$lvTrTemp."<td width=1%><input style=\"padding:2px;\" name=\"$lvChk\" type=\"button\" id=\"$lvChk@03\" onclick=\"Delete('@02')\" value=\"Xoá phép\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>@#01</tr>";
			else
				$lvTr=$lvTrTemp."<td></td>@#01</tr>";*/
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			//if($vrow['lv021']==1)
			{
				switch($vrow['lv021'])
				{
					case -1:
						$strTr=str_replace("@#04","lvlineapproval_purple",$strTr);
						break;
					case 0:
						$strTr=str_replace("@#04","lvlineapproval_level2",$strTr);
						break;
					case 1:
						$strTr=str_replace("@#04","lvlineapproval_black",$strTr);
						break;
					case 2:
						$strTr=str_replace("@#04","lvlineapproval_level3",$strTr);
						break;
				}
				
			}
		//else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH."<tr class='lvlinehtable0'>".$strTrEnter."</tr>".$strTr,$lvTable);
	}
/////////////////////ListFieldExport//////////////////////////
	function ListFieldExport($lvFrom,$lvList,$maxRows)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvSelect="<ul id=\"menu1-nav\" onkeyup=\"return CheckKeyCheckTabExp(event)\">
						<li class=\"menusubT1\"><img src=\"$this->Dir../images/lvicon/export.png\" border=\"0\" />".$this->ArrFunc[12]."
							<ul id=\"submenu1-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function Export(vFrom,value)
		{
			window.open('jo_lv0004/?lang=".$this->lang."&func='+value,'','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT *,lv015 lv829,lv015 lv099,IF(SUBSTR(lv003,1,3)='1/2',DATEDIFF(lv017,lv016)+0.5,IF(TIMEDIFF(lv017,lv016)<'24:00:00' AND DATEDIFF(lv017,lv016)<1,1,DATEDIFF(lv017,lv016)+1)) lv098 FROM jo_lv0004 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
				if($lstArr[$i]=='lv099')
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				else
					$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	protected function GetCondition7Day()
	{
		$strCondi="";
		if($this->NgayXinPhep!='') 
		{
			$strCondi=$strCondi." and 
			(
				(A.lv016 >='$this->NgayXinPhep 00:00:00' and A.lv017 <='$this->NgayXinPhep 23:59:59')
				OR
				( '$this->NgayXinPhep 23:59:59'>=A.lv016 and '$this->NgayXinPhep 00:00:00'<=A.lv017)
			)
			";
		}
		if($this->lv016_!='' && $this->lv017_!='') 
		{
			$strCondi=$strCondi." and 
			(
				(A.lv016 >='$this->lv016_ 00:00:00' and A.lv017 <='$this->lv017_ 23:59:59')
				OR
				( '$this->lv016_ 23:59:59'>=A.lv016 and '$this->lv016_ 00:00:00'<=A.lv017)
				OR
				( '$this->lv017_ 23:59:59'>=A.lv016 and '$this->lv017_ 00:00:00'<=A.lv017)
			)
			";
		}
		elseif($this->lv016_!='') 
		{
			$strCondi=$strCondi." and ('$this->lv016_ 23:59:59'>=A.lv016 and '$this->lv016_ 00:00:00'<=A.lv017)";
		}
		elseif($this->lv017_!='') 
		{
			$strCondi=$strCondi." and ('$this->lv017_ 23:59:59'>=A.lv016 and '$this->lv017_ 00:00:00'<=A.lv017)
			";
		}
		if($this->ListEmp!='') $strCondi=$strCondi." and A.lv001 in ($this->ListEmp)";
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and A.lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and A.lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and A.lv010 like '%$this->lv010%'";
		if($this->lv011!="")  $strCondi=$strCondi." and A.lv011 like '%$this->lv011%'";
		if($this->lv012!="")  
		{
			if($this->lv015!="")  $strCondi=$strCondi." and (A.lv012='$this->lv012' or A.lv015 like '%$this->lv015%')";
			else
			$strCondi=$strCondi." and A.lv012='$this->lv012'";
		}
		if($this->lv013!="")  $strCondi=$strCondi." and A.lv013 like '%$this->lv013%'";
		if($this->lv014!="")  $strCondi=$strCondi." and A.lv014 like '%$this->lv014%'";
		if($this->lv015!="")  $strCondi=$strCondi." and A.lv015 = '$this->lv015'";
		if($this->lv016!="")  $strCondi=$strCondi." and A.lv016 like '%$this->lv016%'";
		if($this->lv017!="")  $strCondi=$strCondi." and A.lv017 like '%$this->lv017%'";
		if($this->lv018!="")  $strCondi=$strCondi." and A.lv018 like '%$this->lv018%'";
		if($this->lv019!="")  $strCondi=$strCondi." and A.lv019 like '%$this->lv019%'";
		if($this->lv020!="")  $strCondi=$strCondi." and A.lv020 like '%$this->lv020%'";
		if($this->lv021!="")  $strCondi=$strCondi." and A.lv021 like '%$this->lv021%'";
		if($this->lv022!="")  $strCondi=$strCondi." and A.lv022 like '%$this->lv022%'";
		if($this->lv023!="")  $strCondi=$strCondi." and A.lv023 like '%$this->lv023%'";
		return $strCondi;
	}
	function LV_BuilList7Day($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
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
		$lvTd="<td class=@#04 align=@#05 nowrap>@02</td>";
		$sqlS = "SELECT A.*,DATEDIFF(A.lv017,A.lv016) SoNgayXinPhep,B.lv029 lv829,A.lv015 lv099,IF(SUBSTR(A.lv003,1,3)='1/2',DATEDIFF(A.lv017,A.lv016)+0.5,IF(TIME_TO_SEC(TIMEDIFF(A.lv017,A.lv016))<TIME_TO_SEC('24:00:00'),1,DATEDIFF(A.lv017,A.lv016)+1)) lv098,TIMEDIFF(A.lv017,A.lv016) lv098_1 FROM jo_lv0004 A inner join hr_lv0020 B on A.lv015=B.lv001 WHERE 1=1  ".$this->GetCondition7Day()."  order by A.lv016 asc";
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
			if($vrow['lv003']=='CT' && $this->LV_UserID!='MP001')
				{
					$vrow['lv008']='***';
				}
			if($vrow['SoNgayXinPhep']<2)
			{
				if($vrow['lv003']!='CT')
				{
				//$vrow['lv008']=$vrow['lv008'].'('.'Xin phép không đúng trước 2 ngày'.')';
				}
			}
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=='lv003')
				{
					if($vrow['lv003']=='')
						$vTemp=str_replace("@02",$this->getvaluelink('lv022',$this->FormatView($vrow['lv022'],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					else
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				elseif($lstArr[$i]=='lv829')
				{				
					$vTemp=str_replace("@02",$this->LV_GetNameVietTat($vrow[$lstArr[$i]]),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				elseif($lstArr[$i]=='lv098')
				{
					switch($vrow['lv022'])
					{
						case 13:
							$vTemp=str_replace("@02",$vrow['lv098_1'],$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
							break;
						case 4:
						case 5:
						case 6:
						case 7:
						case 8:
						case 9:
							$vTimeStart=substr($vrow['lv016'],11,8);
							$vTimeEnd=substr($vrow['lv017'],11,8);
							if($vTimeStart>$vTimeEnd)
							{
								$vSoGio=TIMEADD(TIMEDIFF('24:00:00',$vTimeStart),$vTimeEnd);
							}
							else
								$vSoGio=TIMEDIFF($vTimeEnd,$vTimeStart);
							$vTemp=str_replace("@02",$vSoGio,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
							break;
						default:
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
							break;
					}
						
				}
				else
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				//else
				//$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			//if($vrow['lv021']==1)
			{
				switch($vrow['lv021'])
				{
					case 0:
						$strTr=str_replace("@#04","lvlineapproval_level2",$strTr);
						break;
					case 1:
						$strTr=str_replace("@#04","lvlineapproval_black",$strTr);
						break;
					case 2:
						$strTr=str_replace("@#04","lvlineapproval_level3",$strTr);
						break;
				}
				
			}
		//else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	public function LV_LinkFieldExt($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),0));
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
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0004";
				break;
			case 'lv003':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0002 where lv001<>'1/4KP' order by lv009 asc";
				break;
			case 'lv004':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  jo_lv0003";
				break;
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  jo_lv0003";
				break;
			case 'lv013':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv015':
				if($this->isApr==1 || $this->isUnApr==1)
					$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				else
					$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$this->lv015'";
				break;
			case 'lv915':
					$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
					break;
			case 'lv021':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  jo_lv0003";
				break;
			case 'lv022':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  jo_lv0100 order by lv009";
				break;
		}
		return $vsql;
	}
	public function getvaluelink($vFile,$vSelectID)
	{
		if (!empty($this->ArrGetValueLink[$vFile][$vSelectID][0] ?? null)) {return $this->ArrGetValueLink[$vFile][$vSelectID][1] ?? null;}
		if($vSelectID=="")
		{
			return $vSelectID;
		}
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0004 where lv001='$vSelectID'";
				break;
			case 'lv003':
				$lvopt=0;
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0002 where lv001='$vSelectID'";
				break;
			case 'lv004':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  jo_lv0003 where lv001='$vSelectID'";
				break;
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  jo_lv0003 where lv001='$vSelectID'";
				break;				
			case 'lv012':
				$lvopt=0;
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv013':
				$lvopt=0;
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv015':
				$lvopt=0;
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;	
			case 'lv099':
				$lvopt=2;
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;			
			case 'lv022':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  jo_lv0100 where lv001='$vSelectID'";
				break;
			case 'lv021':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  jo_lv0003 where lv001='$vSelectID'";
				break;
			case 'lv829':
				$lvopt=0;
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002 where lv001='$vSelectID'";
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
			$this->ArrGetValueLink[$vFile][$vSelectID][0]=true;
		}
		while($row= db_fetch_array($lvResult)){
			$this->ArrGetValueLink[$vFile][$vSelectID][1]=($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
			return $this->ArrGetValueLink[$vFile][$vSelectID][1];
		}
		
	}
}
?>