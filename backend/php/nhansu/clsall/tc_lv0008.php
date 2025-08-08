<?php
/////////////coding tc_lv0008///////////////
class   tc_lv0008 extends lv_controler
{
	public $lv001=null;
	public $lv002=null;
	public $lv003=null;
	public $lv004=null;
	public $lv005=null;
	public $lv006=null;
	public $lv007=null;
	public $lv008=null;
///////////
	public $DefaultFieldList="lv001,lv002,lv004,lv005,lv006,lv100,lv200,lv008,lv208,lv101,lv201";	
	//public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv100,lv200,lv008,lv101,lv201";	
	//public $DefaultFieldList="lv001,lv002,lv003,lv102,lv004,lv005,lv006,lv007,lv100,lv101,lv008,lv099,lv097,lv098,lv010,lv011,lv012";
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='tc_lv0008';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv099"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv097"=>"98","lv098"=>"99","lv100"=>"101","lv101"=>"102","lv102"=>"103","lv201"=>"202","lv200"=>"201","lv208"=>"209");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv099"=>"10","lv010"=>"10","lv011"=>"10","lv012"=>"10","lv097"=>"10","lv098"=>"10","lv100"=>"10","lv101"=>"10","lv102"=>"10","lv201"=>"10","lv200"=>"10","lv208"=>"10");	

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
	
	function LV_Load()
	{
		$vsql="select * from  tc_lv0008";
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
			$this->lv095=$vrow['lv095'];
			$this->lv096=$vrow['lv096'];
			$this->lv097=$vrow['lv097'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv200=$vrow['lv200'];
			$this->lv101=$vrow['lv101'];
			$this->lv102=$vrow['lv102'];
			$this->lv201=$vrow['lv201'];
			$this->lv208=$vrow['lv208'];
		}
		else
			$this->lv001=NULL;
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  tc_lv0008 Where lv001='$vlv001'";
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
			$this->lv095=$vrow['lv095'];
			$this->lv096=$vrow['lv096'];
			$this->lv097=$vrow['lv097'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv200=$vrow['lv200'];
			$this->lv101=$vrow['lv101'];
			$this->lv102=$vrow['lv102'];
			$this->lv201=$vrow['lv201'];
			$this->lv208=$vrow['lv208'];
		}
		else
			$this->lv001=NULL;
	}
	function LV_Update_PrevYear_ThisYear($vThisYear,$vPreYear)
	{
		$vsql="select A.lv001,B.lv001 CodeID  from hr_lv0020 A left join tc_lv0008 B on A.lv001=B.lv002 and B.lv005='".$vThisYear."' where A.lv009 not in ('2','3')";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			$vArrS=$this->LV_CheckOne_FNCBEND($vrow['lv001'],$vPreYear,0,12);
			$vAL=$vArrS[0];
			$vCL=$vArrS[1];//$this->LV_CheckOne_FNCBEND($vrow['lv001'],$vPreYear,1,12);
			if($vrow['CodeID']==NULL || $vrow['CodeID']=='')
			{
				$lvsql="insert into tc_lv0008(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv100,lv101) select lv001,(IF(YEAR(lv030)<>'$vyear',$vHave*(lv102/12),($vHave-IF(DAY(lv030)<15,MONTH(lv030)-1,MONTH(lv030)))*(lv102/12)+round(replace(DATEDIFF('$vCurDate',lv030)/(365*3),'.','.0')))) numday,DATEDIFF('$vCurDate',lv030)/365 numyear,'$vThisYear',8,'',0,'".round($vAL,2)."','".round($vCL,2)."' from hr_lv0020 where lv001='".$vrow['lv001']."'";
				db_query($lvsql);
			}
			else
			{
				 $lvsql="update tc_lv0008 set lv100='".round($vAL,2)."',lv101='".round($vCL,2)."' where lv001='".$vrow['CodeID']."'";
				// db_query($lvsql);
			}
		}
	}
	function LV_UpdateThisYear()
	{
		
	}
	function LV_CheckOne_FNCB($vEmpID,$vYear,$opt=0,$vmonth='')
	{
		if($vmonth=='') $vmonth=date('m');
		$vyear=$vYear;
		//$sqlS = "SELECT C.lv001 NVID,C.lv029 lv001,D.lv007 Shift,D.lv003 FN_Nam,D.lv100 TimePhepPrevious,D.lv101 TimeAddPrevious,D.lv102 ALYear,D.lv008 FN_Prev,(select sum(BB.lv096) from tc_lv0009 BB where BB.lv002=C.lv001 and BB.lv004='$vYear' and BB.lv003!='$vmonth') TimeAdd,D.lv098 TimeClear,D.lv099 TimeBUsed,C.lv102 Num_FN_F,((($vyear-year(C.lv030))*12+$vmonth-month(C.lv030))/12) Num_FN_FM,E.lv095 CL_PH,E.lv096 CL_TimeSum,F.lv006 IsFNMonth FROM hr_lv0020 C left join tc_lv0008 D on D.lv002=C.lv001  and D.lv005='$vYear' left join tc_lv0009 E on E.lv002=C.lv001 and E.lv004='$vYear' and E.lv003='$vmonth'  left join hr_lv0002 F on C.lv029=F.lv001  WHERE C.lv001='$vEmpID' and (C.lv009 not in ('2','3'))";
		$sqlS = "SELECT C.lv001 NVID,C.lv029 lv001,D.lv007 Shift,D.lv003 FN_Nam,D.lv100 TimePhepPrevious,D.lv101 TimeAddPrevious,D.lv102 ALYear,D.lv008 FN_Prev,(select sum(BB.lv096) from tc_lv0009 BB where BB.lv002=C.lv001 and BB.lv004='$vYear' ) TimeAdd,(select sum(BB.lv131) from tc_lv0009 BB where BB.lv002=C.lv001 and BB.lv004='$vYear' And BB.lv130=1 ) FNKTinh,D.lv098 TimeClear,D.lv099 TimeBUsed,C.lv102 Num_FN_F,((($vyear-year(C.lv030))*12+$vmonth-month(C.lv030))/12) Num_FN_FM,(select sum(BB.lv095) from tc_lv0009 BB where BB.lv002=C.lv001 and BB.lv004='$vYear' ) CL_PH,E.lv096 CL_TimeSum,F.lv006 IsFNMonth FROM hr_lv0020 C left join tc_lv0008 D on D.lv002=C.lv001  and D.lv005='$vYear' left join tc_lv0009 E on E.lv002=C.lv001 and E.lv004='$vYear' and E.lv003='$vmonth'  left join hr_lv0002 F on C.lv029=F.lv001  WHERE C.lv001='$vEmpID' and (C.lv009 not in ('2','3'))";
		$vresult=db_query($sqlS);
		while($vrow=db_fetch_array($vresult))
		{
			if($opt==1)
			{
				//cong thuc: CL Truoc + Gio Bu+ CL cho PH- CL dung
				$vArrTime=$this->LV_GetTimeAddClear($vrow['NVID'],$vyear);
				//print_r($vArrTime);
				//echo $vrow['TimeAddPrevious'].'+'.$vrow['TimeAdd'].'+'.round($vrow['CL_PH'],1).'+'.round((float)$vArrTime['addtimes']/8,2).'-'.round((float)$vArrTime['cleartimes']/8,2);
				return $vrow['TimeAddPrevious']+$vrow['TimeAdd']+round($vrow['CL_PH'],1)+round((float)$vArrTime['addtimes']/8,2)-round((float)$vArrTime['cleartimes']/8,2);
			}
			else
			{
				//cong thuc: AL Ph�ng ban + AL Truoc + AL cho PH- CL dung
				$vFNUsed=$this->LV_GetNumberTimeCard($vrow['NVID'],$vyear,"AL")+$this->LV_GetNumberTimeCard($vrow['NVID'],$vyear,"0.5AL")*0.5;
				$vAL=($vrow['IsFNMonth']==0)?(($vrow['TimePhepPrevious']!=0)?$vrow['TimePhepPrevious']:$vrow['ALYear']):($vrow['TimePhepPrevious']);//chinh tu o cuoi $vrow['FN_Nam']+$vrow['TimePhepPrevious']
				$monthInt=($vrow['Num_FN_FM']*12>=$vmonth)?(int)$vmonth:(int)$vrow['Num_FN_FM']*12;
				$vNum_FN_FM=$this->LV_GetTangAL($this->LV_GetChan($vrow['Num_FN_FM']));
				
				//echo "$vAL+".$vrow['FN_Prev']."+((".$vrow['Num_FN_F']."+".$vNum_FN_FM.")*$monthInt/12)"."-$vFNUsed";
				//if($vrow['FN_Prev']<0)//neu am thi bat len
				//	return $vAL+$vrow['FN_Prev']+round(($vrow['Num_FN_F']+$vNum_FN_FM)*$monthInt/12,1)-$vFNUsed-(int)$vrow['FNKTinh'];
				//else
					return $vAL+round(($vrow['Num_FN_F']+$vNum_FN_FM)*$monthInt/12,1)-$vFNUsed-(int)$vrow['FNKTinh'];
			}
		}
		
		return 0;
	}
	function LV_CheckOne_FNCBEND($vEmpID,$vYear,$opt=0,$vmonth='')
	{
		if($vmonth=='') $vmonth=date('m');
		$vyear=$vYear;
		//$sqlS = "SELECT C.lv001 NVID,C.lv029 lv001,D.lv007 Shift,D.lv003 FN_Nam,D.lv100 TimePhepPrevious,D.lv101 TimeAddPrevious,D.lv102 ALYear,D.lv008 FN_Prev,(select sum(BB.lv096) from tc_lv0009 BB where BB.lv002=C.lv001 and BB.lv004='$vYear') TimeAdd,D.lv098 TimeClear,D.lv099 TimeBUsed,C.lv102 Num_FN_F,((($vyear-year(C.lv030))*12+$vmonth-month(C.lv030))/12) Num_FN_FM,E.lv095 CL_PH,E.lv096 CL_TimeSum,F.lv006 IsFNMonth FROM hr_lv0020 C left join tc_lv0008 D on D.lv002=C.lv001  and D.lv005='$vYear' left join tc_lv0009 E on E.lv002=C.lv001 and E.lv004='$vYear' and E.lv003='$vmonth'  left join hr_lv0002 F on C.lv029=F.lv001  WHERE C.lv001='$vEmpID' and (C.lv009 not in ('2','3'))";
		$sqlS = "SELECT C.lv001 NVID,C.lv029 lv001,D.lv007 Shift,D.lv003 FN_Nam,D.lv100 TimePhepPrevious,D.lv101 TimeAddPrevious,D.lv102 ALYear,D.lv008 FN_Prev,(select sum(BB.lv096) from tc_lv0009 BB where BB.lv002=C.lv001 and BB.lv004='$vYear') TimeAdd,(select sum(BB.lv131) from tc_lv0009 BB where BB.lv002=C.lv001 and BB.lv004='$vYear' And BB.lv130=1 ) FNKTinh,D.lv098 TimeClear,D.lv099 TimeBUsed,C.lv102 Num_FN_F,((($vyear-year(C.lv030))*12+$vmonth-month(C.lv030))/12) Num_FN_FM,E.lv095 CL_PH,E.lv096 CL_TimeSum,F.lv006 IsFNMonth FROM hr_lv0020 C left join tc_lv0008 D on D.lv002=C.lv001  and D.lv005='$vYear' left join tc_lv0009 E on E.lv002=C.lv001 and E.lv004='$vYear' and E.lv003='$vmonth'  left join hr_lv0002 F on C.lv029=F.lv001  WHERE C.lv001='$vEmpID' and (C.lv009 not in ('2','3'))";
		$vresult=db_query($sqlS);
		while($vrow=db_fetch_array($vresult))
		{

				//cong thuc: CL Truoc + Gio Bu+ CL cho PH- CL dung
				$vArrTime=$this->LV_GetTimeAddClear($vrow['NVID'],$vyear);
				//print_r($vArrTime);
				//echo $vrow['TimeAddPrevious']."+".$vrow['TimeAdd']."+".round($vrow['CL_PH'],1)."+".round((float)$vArrTime['addtimes']/8,2);
				$vArray[1]=$vrow['TimeAddPrevious']+$vrow['TimeAdd']+round($vrow['CL_PH'],1)+round((float)$vArrTime['addtimes']/8,2)-round((float)$vArrTime['cleartimes']/8,2);

				//cong thuc: AL Ph�ng ban + AL Truoc + AL cho PH- CL dung
				$vFNUsed=$this->LV_GetNumberTimeCard($vrow['NVID'],$vyear,"AL")+$this->LV_GetNumberTimeCard($vrow['NVID'],$vyear,"0.5AL")*0.5;
				//$vAL=($vrow['IsFNMonth']==0)?(($vrow['TimePhepPrevious']!=0)?$vrow['TimePhepPrevious']:$vrow['ALYear']):((($vYear=='2015')?0:$vrow['FN_Nam'])+$vrow['TimePhepPrevious']);
				$vAL=($vrow['TimePhepPrevious']!=0)?$vrow['TimePhepPrevious']:$vrow['ALYear'];
				$vNum_FN_FM=$this->LV_GetTangAL($this->LV_GetChan($vrow['Num_FN_FM']));
				//echo "$vAL+".$vrow['FN_Prev']."+".(($vrow['Num_FN_F']+$vNum_FN_FM)/12)."-$vFNUsed";
				$monthInt=($vrow['Num_FN_FM']*12>=$vmonth)?(int)$vmonth:(int)$vrow['Num_FN_FM']*12;
				if($vrow['FN_Prev']<0)
					$vArray[0]=$vAL+$vrow['FN_Prev']+round(($vrow['Num_FN_F']+$vNum_FN_FM)*$monthInt/12,1)-$vFNUsed-(int)$vrow['FNKTinh'];
				else
					$vArray[0]=$vAL+round(($vrow['Num_FN_F']+$vNum_FN_FM)*$monthInt/12,1)-$vFNUsed-(int)$vrow['FNKTinh'];
		}
		
		return $vArray;
	}
	function LV_GetChan($vvalue)
	{
		$vArr=explode(".",$vvalue);
		return $vArr[0];
	}
	function LV_GetTangAL($vTN,$vSN=3)
	{
		if($vTN>=$vSN)
			return $vTN-$vSN+1;
		else
		return 0;
		
	}
	function get_count_codeidyear($vempid,$vyear,$vCodeList="'P'")
	{
		$sqlS="select sum(IF(B.lv007='P',1,0.5)) numfn from tc_lv0011 B inner join tc_lv0010 A on A.lv001=B.lv002 and A.lv002='$vempid' where B.lv100<>1 and B.lv007 in ($vCodeList) and year(B.lv004)='$vyear'";
		$bResult = db_query($sqlS);
		$vrow = db_fetch_array ($bResult);
		return $vrow['numfn'];
	}
	function LV_LoadCurrentID($vlv002,$vlv005)
	{
		$lvsql="select * from  tc_lv0008 Where lv002='$vlv002' and lv005='$vlv005'";
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
			$this->lv095=$vrow['lv095'];
			$this->lv096=$vrow['lv096'];
			$this->lv097=$vrow['lv097'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv200=$vrow['lv200'];
			$this->lv101=$vrow['lv101'];
			$this->lv102=$vrow['lv102'];
			$this->lv201=$vrow['lv201'];
			$this->lv208=$vrow['lv208'];
			return true;
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
		}
		return false;
	}
	function LV_InsertEmpContract($vEmpID,$vShiftID,$vTimeWork,$vDateStart,$vDateEnd,$vdatabase='')
	{
			if($vdatabase=='')
			{
				$vYearStart=getyear(recoverdate($vDateStart,$this->lang));
				$vYearEnd=getyear(recoverdate($vDateEnd,$this->lang));
			}
			else
			{
				$vYearStart=getyear($vDateStart);
				$vYearEnd=getyear($vDateEnd);
			}
			if($vYearEnd<$vYearStart) return ;
			for($i=$vYearStart;$i<=$vYearEnd;$i++)
			{
				if($this->LV_LoadCurrentID($vEmpID,$i)==false)
				{
				$this->lv002=$vEmpID;
				$this->lv003=0;
				$this->lv004=0;
				$this->lv005=$i;
				$this->lv006=$vTimeWork;
				$this->lv007=$vShiftID;		
				$this->lv008='';
				$this->LV_Insert($vdatabase);
				}
			}
			
	}
	function LV_UpdateFN($vCurDate)
	{
		$vmonth=getmonth($vCurDate);
		$vyear=getyear($vCurDate);
		$lsNVFN=$this->LV_GetCurFN($vyear);
		$vHave=(int)$vmonth;
		
		if($lsNVFN!="")
			$lvsql="insert into tc_lv0008(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv099,lv102) select lv001,(IF(YEAR(lv030)<>'$vyear',$vHave*(lv102+round(replace(DATEDIFF('$vCurDate',lv030)/(365*3),'.','.0'),0)/12),($vHave-IF(DAY(lv030)<15,MONTH(lv030)-1,MONTH(lv030)))*((lv102+round(replace(DATEDIFF('$vCurDate',lv030)/(365*3),'.','.0'),0))/12))) numday,DATEDIFF('$vCurDate',lv030)/365 numyear,'$vyear','08:00','',0,0,(IF(YEAR(lv030)<>'$vyear',lv102,(12-IF(DAY(lv030)<15,MONTH(lv030)-1,MONTH(lv030)))*(lv102/12))+round(replace(DATEDIFF('$vCurDate',lv030)/(365*3),'.','.0'),0)) ALYear from hr_lv0020 where lv001 not in ($lsNVFN) and (lv009 not in ('2','3'))";
		else
			$lvsql="insert into tc_lv0008(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv099,lv102) select lv001,(IF(YEAR(lv030)<>'$vyear',$vHave*(lv102+round(replace(DATEDIFF('$vCurDate',lv030)/(365*3),'.','.0'),0)/12),($vHave-IF(DAY(lv030)<15,MONTH(lv030)-1,MONTH(lv030)))*((lv102+round(replace(DATEDIFF('$vCurDate',lv030)/(365*3),'.','.0')))/12))) numday,DATEDIFF('$vCurDate',lv030)/365 numyear,'$vyear',8,'',0,0,(IF(YEAR(lv030)<>'$vyear',lv102,(12-IF(DAY(lv030)<15,MONTH(lv030)-1,MONTH(lv030)))*(lv102/12))+round(replace(DATEDIFF('$vCurDate',lv030)/(365*3),'.','.0'),0)) ALYear from hr_lv0020 where (lv009 not in ('2','3'))";
		$vresult=db_query($lvsql);
		if($lsNVFN=="")
			$lvsql="select B.lv001,(IF(YEAR(B.lv030)<>'$vyear',IF('$vyear'='2015',1,($vHave))*((B.lv102+round(replace(DATEDIFF('$vCurDate',lv030)/(365*3),'.','.0'),0))/12),IF('$vyear'='2015',1,($vHave-IF(DAY(B.lv030)<15,MONTH(B.lv030)-1,MONTH(B.lv030))))*((B.lv102)/12))) numday,DATEDIFF('$vCurDate',B.lv030)/365 numyear,'$vyear',8,'',(select sum(A1.lv003+A1.lv008-A1.lv099)  from  tc_lv0008 A1 Where A1.lv002=B.lv001 and A1.lv005='".($vyear-1)."'  ) FNTon,(IF(YEAR(B.lv030)<>'$vyear',B.lv102,(12-IF(DAY(B.lv030)<15,MONTH(B.lv030)-1,MONTH(B.lv030)))*((B.lv102+round(replace(DATEDIFF('$vCurDate',B.lv030)/(365*3),'.','.0'),0))/12))) ALYear from hr_lv0020 B left join tc_lv0008 A on A.lv002=B.lv001 and A.lv005='$vyear' where (B.lv009 not in ('2','3'))";	
		else
			$lvsql="select B.lv001,(IF(YEAR(B.lv030)<>'$vyear',IF('$vyear'='2015',1,($vHave))*((B.lv102+round(replace(DATEDIFF('$vCurDate',lv030)/(365*3),'.','.0'),0))/12),IF('$vyear'='2015',1,($vHave-IF(DAY(B.lv030)<15,MONTH(B.lv030)-1,MONTH(B.lv030))))*((B.lv102)/12))) numday,DATEDIFF('$vCurDate',B.lv030)/365 numyear,'$vyear',8,'',(select sum(A1.lv003+A1.lv008-A1.lv099)  from  tc_lv0008 A1 Where A1.lv002=B.lv001 and A1.lv005='".($vyear-1)."'  ) FNTon,(IF(YEAR(B.lv030)<>'$vyear',B.lv102,(12-IF(DAY(B.lv030)<15,MONTH(B.lv030)-1,MONTH(B.lv030)))*((B.lv102++round(replace(DATEDIFF('$vCurDate',B.lv030)/(365*3),'.','.0'),0))/12))) ALYear from hr_lv0020 B left join tc_lv0008 A on A.lv002=B.lv001 and A.lv005='$vyear' where B.lv001 in ($lsNVFN) and (B.lv009 not in ('2','3'))";
		//echo $lvsql;
		/*$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$vFNUsed=$this->LV_GetNumberTimeCard($vrow['lv001'],$vyear,"AL")+$this->LV_GetNumberTimeCard($vrow['lv001'],$vyear,"0.5AL")*0.5;
			$vArrTime=$this->LV_GetTimeAddClear($vrow['lv001'],$vyear);
			$vTimeHoliday=$this->LV_GetTimeSaveHoliday($vrow['lv001'],$vyear,'lv095');
			$vLastMonthSave=$this->LV_GetTimeSaveHoliday($vrow['lv001'],$vyear,'lv096');
			$vLastFist=$this->LV_GetTimeSaveHoliday($vrow['lv001'],$vyear,'lv100');
			$vALYear=$vrow['ALYear'];
			$vPNTon=$vrow['FNTon'];
			$vsql="update tc_lv0008 set lv003='".round($vrow['numday'],1)."',lv004='".$vrow['numyear']."',lv008='".$vPNTon."',lv099='$vFNUsed',lv097='".($vArrTime['addtimes']/8)."',lv098='".($vArrTime['cleartimes']/8)."',lv095='".$vTimeHoliday."',lv096='".$vLastMonthSave."',lv102='".$vALYear."' where lv002='".$vrow['lv001']."' and lv005='".$vyear."'";
			$vresult1=db_query($vsql);
		}*/
	}
	function LV_GetPreviousFN($vEmpID,$vyear)
	{
		$strReturn="";
		$lvsql="select (lv003+lv008+lv097-lv098-lv099) FNTon from  tc_lv0008 Where lv002='$vEmpID' and lv005='$vyear'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow) 		return $vrow['FNTon'];
		return 0;
	}
	function LV_GetTimeSaveHoliday($vEmpID,$vyear,$vField)
	{
		$strReturn="";
		$lvsql="select sum($vField) FNTon from  tc_lv0009 Where lv002='$vEmpID' and lv004='$vyear'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow) 		return $vrow['FNTon'];
		return 0;
	}
	function LV_GetCurFN($vyear)
	{
		$strReturn="";
		$lvsql="select lv002 from  tc_lv0008 Where lv005='$vyear'";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($strReturn=='') 
				$strReturn="'".$vrow['lv002']."'";
			else
				$strReturn=$strReturn.",'".$vrow['lv002']."'";
		}
		return $strReturn;
	}
	function LV_Insert($vdatabase='')
	{
		
		if($this->isAdd==0) return false;
		if($vdatabase=='')
			$lvsql="insert into tc_lv0008 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008')";
		else
			$lvsql="insert into $vdatabase.tc_lv0008 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008')";
		$vReturn= db_query($lvsql);
		if($vReturn){
		 $this->InsertLogOperation($this->DateCurrent,'tc_lv0008.insert',sof_escape_string($lvsql));
		 }
		return $vReturn;
	}		
	function LV_InsertAuto()
	{
		
		$lvsql="insert into tc_lv0008 (lv002,lv003,lv004,lv005,lv006,lv007,lv008) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008')";
		$vReturn= db_query($lvsql);
		if($vReturn){
		 $this->InsertLogOperation($this->DateCurrent,'tc_lv0008.insert',sof_escape_string($lvsql));
		 }
		return $vReturn;
	}	
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		$lvsql="Update tc_lv0008 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv208='$this->lv208' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0008.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_Update_DauKy()
	{
		if($this->isEdit==0) return false;
		$lvsql="Update tc_lv0008 set lv100='$this->lv100',lv200='$this->lv200',lv101='$this->lv101',lv201='$this->lv201',lv008='$this->lv008',lv208='$this->lv208' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) {
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0008.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM tc_lv0008  WHERE  tc_lv0008.lv001 IN ($lvarr)";// and (select count(*) from ts_lv0009 B where  B.lv002= tc_lv0008.lv001)<=0  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0008.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0008 set lv005=1  WHERE tc_lv0008.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0008.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0008 set lv005=0  WHERE tc_lv0008.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0008.unapproval',sof_escape_string($lvsql));
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
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  = '$this->lv002'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="") $strCondi=$strCondi." and A.lv007  like '%$this->lv007%'";
		if($this->lv008!="") $strCondi=$strCondi." and A.lv008  like '%$this->lv008%'";
		
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0008 A WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_GetListCalendar($vListEmployeeID,$vField)
	{
		$vsql="select $vField from tc_lv0010 where lv002 in ($vListEmployeeID)";
		$vresult=db_query($vsql);
		$strReturn="";
		if($vresult)
		{
			while($vrow=db_fetch_array($vresult))
			{
		   		if($strReturn=="") $strReturn="'".$vrow["$vField"]."'";
				else $strReturn=$strReturn.",'".$vrow["$vField"]."'";
			}
			return $strReturn;
		}
	}
	function LV_GetNumberTimeCard($vEmpID,$vyear,$vMaCong)
	{
		$vListEmp="'".$vEmpID."'";
		//$vListCalendar=$this->LV_GetListCalendar($vListEmp,'lv001');
		if($vListCalendar=="") $vListCalendar="''";
		$vsql="select count(A.lv007) SoMaCong from tc_lv0011 A inner join tc_lv0010 B on A.lv002=B.lv001 where A.lv100=0 and YEAR(A.lv004)='$vyear' and B.lv002 ='$vEmpID' and A.lv007='$vMaCong';";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['SoMaCong'];
		}
		return 0;
	}
	function LV_GetTimeAddClear($vEmpID,$vyear)
	{
		$vReturnArr=Array();
		$vListEmp="'".$vEmpID."'";
		$vsql="select (sum(left(A.lv016,2))+sum(substr(A.lv016,4,5))/60+sum(substr(A.lv016,7,8))/360) cleartimes,(sum(left(A.lv017,2))+sum(substr(A.lv017,4,5))/60+sum(substr(A.lv017,7,8))/360) addtimes from tc_lv0011 A inner join tc_lv0010 B on A.lv002=B.lv001 where A.lv100=0 and YEAR(A.lv004)='$vyear' and B.lv002 ='$vEmpID' ;";
		//if($vEmpID=='0004') echo $vsql;
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vReturnArr['cleartimes']=$vrow['cleartimes'];
			$vReturnArr['addtimes']=$vrow['addtimes'];
			return $vReturnArr;
		}
		$vReturnArr['cleartimes']=0;
		$vReturnArr['addtimes']=0;
		return $vReturnArr;
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
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT A.*,C.lv006 IsFNMonth FROM tc_lv0008 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			$vTimeBUsed=$vrow['lv099'];
			$vTimeAdd=$vrow['lv097'];
			$vTimeClear=$vrow['lv098'];
			$vTimeAddPrevious=$vrow['lv101'];
			$vTimePUsed=$this->LV_GetNumberTimeCard($vrow['lv002'],$vrow['lv005'],"AL");
			//IF year, only use previous AL
			//IF month, 
			$vAL=($vrow['IsFNMonth']==0)?(($vrow['lv100']!=0)?$vrow['lv100']:$vrow['lv102']):($vrow['lv003']+$vrow['lv100']);
			$vHaftTimePUsed=0;//$this->LV_GetNumberTimeCard($vrow['lv002'],$vrow['lv005'],"HA")*0.5;
			for($i=0;$i<count($lstArr);$i++)
			{
				
				switch($lstArr[$i])
				{
					case 'lv099':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTimeBUsed,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv003':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView((($vrow['IsFNMonth']==0)?0:($vrow['lv003']+$vrow['lv100'])),(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv102':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView((($vrow['IsFNMonth']==0)?$vrow['lv102']:0),(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv010':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vAL+$vTimeAddPrevious+$vrow['lv008']+$vTimeAdd-$vTimeClear-$vTimeBUsed,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv011':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTimePUsed+$vHaftTimePUsed,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv012':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vAL+$vTimeAddPrevious+$vrow['lv008']-$vTimePUsed-$vHaftTimePUsed,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
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
			window.open('".$this->Dir."tc_lv0008/?lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
			<td width=1% class=@#04>@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM tc_lv0008 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
			$vTimeBUsed=$this->LV_GetNumberTimeCard($vrow['lv002'],$vrow['lv005'],"B");
			$vTimePUsed=$this->LV_GetNumberTimeCard($vrow['lv002'],$vrow['lv005'],"A");
			$vHaftTimePUsed=$this->LV_GetNumberTimeCard($vrow['lv002'],$vrow['lv005'],"HA")*0.5;
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv009':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTimeBUsed,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv010':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv008']-$vTimeBUsed,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv011':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTimePUsed+$vHaftTimePUsed,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv012':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv003']-$vTimePUsed-$vHaftTimePUsed,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
					
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
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
		$sqlS = "SELECT * FROM tc_lv0008 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			$vTimeBUsed=$this->LV_GetNumberTimeCard($vrow['lv002'],$vrow['lv005'],"B");
			$vTimePUsed=$this->LV_GetNumberTimeCard($vrow['lv002'],$vrow['lv005'],"A");
			$vHaftTimePUsed=$this->LV_GetNumberTimeCard($vrow['lv002'],$vrow['lv005'],"HA")*0.5;
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv009':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTimeBUsed,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv010':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv008']-$vTimeBUsed,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv011':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vTimePUsed+$vHaftTimePUsed,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv012':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv003']-$vTimePUsed-$vHaftTimePUsed,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
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
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0004";
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
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0004 where lv001='$vSelectID'";
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