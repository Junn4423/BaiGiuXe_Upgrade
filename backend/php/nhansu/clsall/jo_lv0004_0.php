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
		public $DefaultFieldList="lv001,lv015,lv003,lv016,lv017,lv098,lv008,lv013,lv018,lv019,lv021,lv009,lv010,lv025";	
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
		var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"4","lv006"=>"0","lv007"=>"4","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"0","lv016"=>"4","lv017"=>"4","lv018"=>"4","lv019"=>"4","lv020"=>"0","lv021"=>"0","lv022"=>"0","lv023"=>"0","lv024"=>"2","lv025"=>"22","lv099"=>"0");	
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
		function LV_GetPNThamNien($vStaffID,$datefrom)
		{
			$vsql="select (((year('$datefrom')-year(lv030))*12+month('$datefrom')-month(lv030))/12) Num_FN_FM,lv030 DateW ,(((year('$datefrom')-year(lv030))*12+month('$datefrom')-month(lv030))) Num_FN_FM_Month from  hr_lv0020 where lv001='$vStaffID'";
			$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			$vPhep=$this->LV_GetTangP($this->LV_GetChan($vrow['Num_FN_FM']));
			if(getmonth($vrow['DateW'])==getmonth($datefrom) && getmonth($vrow['DateW'])!=1)
			{
				if($this->LV_GetOKDungThang($vrow['Num_FN_FM_Month'],5))
				{
					return 1; 
				}
				else
				{
					return 0;
				}
			}
			if(getmonth($datefrom)>1)
			{
				return 0;
			}
			if($vPhep<0) return 0;
			return $vPhep; 
		}
		function LV_GetOKDungThang($vSoThang,$vSoNam=5)
		{
			if($vSoThang/12<4) return false;
			$vDemNam=$vSoThang/(12*$vSoNam);
			//$vSoDu=$vSoThang%(12*$vSoNam);
			if($vDemNam>0)
			{
				$vSoDu=$vSoThang%(12*$vSoNam);
				if($vSoDu==0)
				{
					return true;
				}
			}
			return false;
		}
		function LV_GetTangP($vTN,$vSN=5)
		{
			if($vTNv==0 || $vSNv==0) return 0;
			return $this->LV_GetChan($vTN/$vSN);
			if($vTN>=$vSN)
				return $vTN-$vSN+1;
			else
				return 0;
			
		}
		function LV_GetChan($vvalue)
		{
			$vArr=explode(".",$vvalue);
			return $vArr[0];
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
		function LV_CheckXinKL($vStaffID,$vStartDate,$vEndDate,$vListPhep="'KL','1/2KL'")
		{
			$vArrPhep=Array();
			$vArrPhep[0]=0;
			$vArrPhep[1]=0;
			if($this->ArrDonxinDiTreVeSomKL[0][0]) return;
			$this->ArrDonxinDiTreVeSomKL=Array();
			$vsql="select lv003,lv021,DATEDIFF(lv017,lv016) SoNgay,IF('$vEndDate 23:59:59'>lv017,DATEDIFF(lv017,lv016),DATEDIFF('$vEndDate',lv016)) SoNgayTinh from jo_lv0004 where ((lv016>='$vStartDate 00:00:00' and lv016<='$vEndDate 23:59:59') OR (lv017>='$vStartDate 00:00:00' and lv017<='$vEndDate 23:59:59')) and (lv021>=0 and lv021<2) and lv015='$vStaffID' and lv003 in ($vListPhep)";
			$bResult=db_query($vsql);
			$this->ArrDonxinDiTreVeSomKL[0][0]=true;
			while($vrow = db_fetch_array ($bResult))
			{
				$vHeSo=($vrow['lv003']=='KL')?1:0.5;
				//Chưa xử lý xin liên tục.
				if($vrow['SoNgayTinh']==0)
				{
					if($vrow['lv021']==1)
					{
						$vArrPhep[0]=$vArrPhep[0]+1*$vHeSo;
					}
					else
					{
						$vArrPhep[1]=$vArrPhep[1]+1*$vHeSo;
					}
				}
				else
				{
					if($vrow['lv021']==1)
					{
						$vArrPhep[0]=$vArrPhep[0]+$vrow['SoNgayTinh']*$vHeSo+1*$vHeSo;
					}
					else
					{
						$vArrPhep[1]=$vArrPhep[1]+$vrow['SoNgayTinh']*$vHeSo+1*$vHeSo;
					}
				}

			}
			return $vArrPhep;
		}
		function LV_CheckXinPN($vStaffID,$vStartDate,$vEndDate,$vListPhep="'P','1/2P'")
		{
			$vArrPhep=Array();
			$vArrPhep[0]=0;
			$vArrPhep[1]=0;
			if($this->ArrDonxinDiTreVeSom[0][0]) return;
			$this->ArrDonxinDiTreVeSom=Array();
			if($vEndDate=='') $vEndDate='2050-12-30';
			$vsql="select lv003,lv021,DATEDIFF(lv017,lv016) SoNgay,IF('$vEndDate 23:59:59'>lv017,DATEDIFF(lv017,lv016),DATEDIFF('$vEndDate',lv016)) SoNgayTinh from jo_lv0004 where ((lv016>='$vStartDate 00:00:00' and lv016<='$vEndDate 23:59:59') OR (lv017>='$vStartDate 00:00:00' and lv017<='$vEndDate 23:59:59')) and (lv021>=0 and lv021<2) and lv015='$vStaffID' and lv003 in ($vListPhep)";
			$bResult=db_query($vsql);
			$this->ArrDonxinDiTreVeSom[0][0]=true;
			while($vrow = db_fetch_array ($bResult))
			{
				$vHeSo=($vrow['lv003']=='P')?1:0.5;
				//Chưa xử lý xin liên tục.
				if($vrow['SoNgayTinh']==0)
				{
					if($vrow['lv021']==1)
					{
						$vArrPhep[0]=$vArrPhep[0]+1*$vHeSo;
					}
					else
					{
						$vArrPhep[1]=$vArrPhep[1]+1*$vHeSo;
					}
				}
				else
				{
					if($vrow['lv021']==1)
					{
						$vArrPhep[0]=$vArrPhep[0]+$vrow['SoNgayTinh']*$vHeSo+1*$vHeSo;
					}
					else
					{
						$vArrPhep[1]=$vArrPhep[1]+$vrow['SoNgayTinh']*$vHeSo+1*$vHeSo;
					}
				}

			}
			return $vArrPhep;
		}
		//lay 1 lan ta ca nhan vien hay phong ban va ngay
		function LV_CheckPhepStateArrMulti($vDate,$vCheckNT=0,$vListEmp)
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
					$vCount=count($this->ArrJobs[$vrow['lv015']][$datecur][$vrow['lv022']]);
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
			$lvsql = "Update jo_lv0004 set lv021=1  WHERE jo_lv0004.lv001 IN ($lvarr) and lv006=0  ";
			$vReturn= db_query($lvsql);
			if($vReturn){
				$this->InsertLogOperation($this->DateCurrent,'jo_lv0004.approval',sof_escape_string($lvsql));
			}
			return $vReturn;
		}	
		function LV_UnAproval($lvarr)
		{
			if($this->isApr==0) return false;
			$lvsql = "Update jo_lv0004 set lv021=0  WHERE jo_lv0004.lv001 IN ($lvarr) and lv006=0 ";
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
			$lvsql="insert into jo_lv0004 (lv001,lv002,lv003,lv004,lv006,lv008,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv020,lv021,lv022,lv023,lv025) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv006','$this->lv008','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->LV_UserID','$this->lv016','$this->lv017','$this->lv020','$this->lv021','$this->lv022','$this->lv023',now())";
			$vReturn= db_query($lvsql);
			if($vReturn) 
			{
				$this->InsertLogOperation($this->DateCurrent,'jo_lv0004.insert',sof_escape_string($lvsql));
				$this->LV_XuLyNoiDung($this->lv001);
			}
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
			$lvsql="insert into jo_lv0004 (lv002,lv003,lv004,lv006,lv008,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv020,lv021,lv022,lv023,lv025) values('$this->lv002','$this->lv003','$this->lv004','$this->lv006','$this->lv008','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->LV_UserID','$this->lv016','$this->lv017','$this->lv020','$this->lv021','$this->lv022','$this->lv023',now())";
			$vReturn= db_query($lvsql);
			if($vReturn) 
			{
				$vID=sof_insert_id();
				$this->InsertLogOperation($this->DateCurrent,'jo_lv0004.insert',sof_escape_string($lvsql));
				$this->LV_XuLyNoiDung($vID);
			}
			return $vReturn;
		}
		function get_count_codeidyear($vempid,$vyear,$vCodeList="'P'")
		{
			$sqlS="select sum(IF(B.lv007='P',1,0.5)) numfn from tc_lv0011 B inner join tc_lv0010 A on A.lv001=B.lv002 and A.lv002='$vempid' where B.lv100<>1 and B.lv007 in ($vCodeList) and year(B.lv004)='$vyear'";
			$bResult = db_query($sqlS);
			$vrow = db_fetch_array ($bResult);
			return $vrow['numfn'];
		}
		function LV_CheckPhepLienKe($vMaNV,$vIdPhep,$vDateFrom,$vDateTo)
		{
			//Do phép liền kề
			$sqlS1 = "SELECT sum(DATEDIFF(lv017,lv016)+1) NumsRequire,sum(DATEDIFF(lv017,lv016)+IF(LEFT(lv003,3)='1/2',0.5,1)) NumsRequireMore  FROM jo_lv0004 WHERE (jo_lv0004.lv003<>'CT' and jo_lv0004.lv003<>'QCC') and jo_lv0004.lv001 <>'$vIdPhep' and lv015='$vMaNV' and ( (ADDDATE('$vDateFrom',INTERVAL -1 DAY )<=substr(lv017,1,10) and ADDDATE('$vDateFrom',INTERVAL 1 DAY)>=substr(lv016,1,10)) or (ADDDATE('$vDateTo',INTERVAL -1 DAY )<=substr(lv017,1,10) and ADDDATE('$vDateTo',INTERVAL 1 DAY)>=substr(lv016,1,10)) )	and lv004<>2 and lv021<>2 and (lv022 not in (13,2,3,1,4,8,5,6,9,7))	";
			$bResult = db_query($sqlS1);
			while ($vrow = db_fetch_array ($bResult)){
				return $vrow['NumsRequireMore'];
			}
		}
		function LV_CheckPhepLienKe1($vMaNV,$vIdPhep,$vDateFrom,$vDateTo)
		{
			//Do phép liền kề
			$sqlS1 = "SELECT sum(DATEDIFF(lv017,lv016)+1) NumsRequire,sum(DATEDIFF(lv017,lv016)+IF(LEFT(lv003,3)='1/2',0.5,1)) NumsRequireMore  FROM jo_lv0004 WHERE (jo_lv0004.lv003<>'CT' and jo_lv0004.lv003<>'QCC') and jo_lv0004.lv001 <>'$vIdPhep' and lv015='$vMaNV' and ( (ADDDATE('$vDateFrom',INTERVAL -1 DAY )<=substr(lv017,1,10) and ADDDATE('$vDateFrom',INTERVAL 1 DAY)>=substr(lv016,1,10)) or (ADDDATE('$vDateTo',INTERVAL -1 DAY )<=substr(lv017,1,10) and ADDDATE('$vDateTo',INTERVAL 1 DAY)>=substr(lv016,1,10)) )	and lv004<>2 and lv021<>2 and (lv022 not in (13,2,3,1,4,8,5,6,9,7))	";
			$bResult = db_query($sqlS1);
			while ($vrow = db_fetch_array ($bResult)){
				return $vrow['NumsRequireMore'];
			}
		}
		function LV_XuLyNoiDung($vID)
		{
			$sqlS1 = "SELECT *,DATEDIFF(lv017,lv016) NumsRequire FROM jo_lv0004 WHERE  jo_lv0004.lv001='$vID'";
			$bResult = db_query($sqlS1);
			while ($vrow = db_fetch_array ($bResult)){
				
				$vSoPhepKLDaDung=0;
				if($vrow['lv003']=='KL' || $vrow['lv003']=='1/2KL')
				{
					$vCodeList="'KL','1/2KL'";
					$vSoPhepKLDaDung=$this->get_count_codeidyear($vrow['lv015'],getyear($vrow['lv016']),$vCodeList);
				}
				$vDateFrom=substr($vrow['lv016'],0,10);
				$vDateTo=substr($vrow['lv017'],0,10);
				$vNghiLienKe=$this->LV_CheckPhepLienKe($vrow['lv015'],$vrow['lv001'],$vDateFrom,$vDateTo);
				$vNgayNghi=$vrow['NumsRequire']+1;
				if(($vrow['lv003']<>'CT' && $vrow['lv003']<>'QCC' && ($vNghiLienKe+$vNgayNghi)>3) || (($vrow['lv003']=='KL' || $vrow['lv003']=='1/2KL') && ($vNgayNghi+$vSoPhepKLDaDung)>7 ))
				{
					if(($vrow['lv003']=='KL' || $vrow['lv003']=='1/2KL') && ($vNgayNghi+$vSoPhepKLDaDung)>7 )
						$lvsql = "Update jo_lv0004 set lv009='Phép KL đã dùng:".($vNgayNghi+$vSoPhepKLDaDung)." ngày>=7 ngày.'  WHERE jo_lv0004.lv001 ='".$vrow['lv001']."' ";
					else
						$lvsql = "Update jo_lv0004 set lv009='Phép liền kề lớn hơn 3 ngày'  WHERE jo_lv0004.lv001 ='".$vrow['lv001']."' ";
					$vReturn= db_query($lvsql);
					if($vReturn){
						$this->InsertLogOperation($this->DateCurrent,'jo_lv0004.approval',sof_escape_string($lvsql));
					}
				}
				
			}
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
			//if($this->isDel==0) return false;
			$lvsql = "DELETE FROM jo_lv0004  WHERE jo_lv0004.lv001 IN ($lvarr) and lv021=0 and lv004=0  and lv015='$this->LV_UserID'";
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
		function GetCountWait()
		{
			$sqlC = "SELECT COUNT(*) AS nums FROM jo_lv0004 WHERE lv021=0 and lv022 ='0' ".$this->GetCondition();
			$bResultC = db_query($sqlC);
			$arrRowC = db_fetch_array($bResultC);
			return $arrRowC['nums'];
		}
		function GetCountWaitFull()
		{
			$sqlC = "SELECT COUNT(*) AS nums FROM jo_lv0004 WHERE lv021=0  ".$this->GetCondition();
			$bResultC = db_query($sqlC);
			$arrRowC = db_fetch_array($bResultC);
			return $arrRowC['nums'];
		}
		function GetCount()
		{
			$sqlC = "SELECT COUNT(*) AS nums FROM jo_lv0004 WHERE 1=1 and lv022 ='0' ".$this->GetCondition();
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
			$sqlS = "SELECT *,lv015 lv829,lv015 lv099,IF(SUBSTR(lv003,1,3)='1/2',DATEDIFF(lv017,lv016)+0.5,IF(TIMEDIFF(lv017,lv016)<'24:00:00' AND DATEDIFF(lv017,lv016)<1,1,DATEDIFF(lv017,lv016)+1)) lv098 FROM jo_lv0004 WHERE 1=1 and lv022 ='0'  ".$this->GetCondition()."";
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
			@#01
			<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
			</table>
			";
			$lvTrH="<tr class=\"lvhtable\">
				<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
				<td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>
				@#01
			</tr>
			";
			$lvTrTemp="<tr class=\"lvlinehtable@01\">
				<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>

			";
			$lvHref="@02";
			$lvTdH="<td nowrap width=\"@01\" class=\"lvhtable\">@02</td>";
			
			$lvTd="<td nowrap class=\"@#04\" align=\"@#05\">@02</td>";
			$sqlS = "SELECT *,DATEDIFF(lv016,lv025) SoNgayXinPhep,ADDTIME(lv025,'00:05:00') CheckNgay,lv015 lv829,lv015 lv099,IF(SUBSTR(lv003,1,3)='1/2',DATEDIFF(lv017,lv016)+0.5,IF(TIMEDIFF(lv017,lv016)<'24:00:00' AND DATEDIFF(lv017,lv016)<1,1,DATEDIFF(lv017,lv016)+1)) lv098 FROM jo_lv0004 WHERE 1=1 and lv022 ='0'  ".$this->GetCondition()." order by lv016 desc LIMIT $curRow, $maxRows";
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
				if($vrow['CheckNgay']>=$this->DateCurrent && $vrow['lv004']==0 && $vrow['lv021']==0)
					$lvTr=$lvTrTemp."<td width=1%><input style=\"padding:2px;\" name=\"$lvChk\" type=\"button\" id=\"$lvChk@03\" onclick=\"Delete('@02')\" value=\"Xoá phép\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>@#01</tr>";
				else
					$lvTr=$lvTrTemp."<td></td>@#01</tr>";
				

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
			$lvTd="<td align=@#05>@02</td>";
			$sqlS = "SELECT *,DATEDIFF(lv016,lv025) SoNgayXinPhep,lv015 lv829,lv015 lv099,IF(SUBSTR(lv003,1,3)='1/2',DATEDIFF(lv017,lv016)+0.5,IF(TIMEDIFF(lv017,lv016)<'24:00:00' AND DATEDIFF(lv017,lv016)<1,1,DATEDIFF(lv017,lv016)+1)) lv098 FROM jo_lv0004 WHERE 1=1 and lv022 ='0' and lv016>=concat(curdate(),' 00:00:00') order by lv016 asc";
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
				if($vrow['SoNgayXinPhep']<2)
				{
					if($vrow['lv008']!='CT')
					{
					//$vrow['lv008']=$vrow['lv008'].'('.'Xin phép không đúng trước 2 ngày'.')';
					}
				}
				for($i=0;$i<count($lstArr);$i++)
				{
					
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$strL=$strL.$vTemp;
				}


				$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
				
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
			$sqlS = "SELECT *,lv015 lv829,lv015 lv099,IF(SUBSTR(lv003,1,3)='1/2',DATEDIFF(lv017,lv016)+0.5,IF(TIMEDIFF(lv017,lv016)<'24:00:00' AND DATEDIFF(lv017,lv016)<1,1,DATEDIFF(lv017,lv016)+1)) lv098 FROM jo_lv0004 WHERE 1=1 and lv022 ='0'  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
					$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0002 where lv001 not in ('L','X','KP','TS','1/4KP') order by lv009 asc";
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
				case 'lv021':
					$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  jo_lv0003";
					break;
				case 'lv022':
					$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  jo_lv0100 order by lv009";
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
				default:
					$vsql ="";
					break;
			}
			if($vsql=="")
			{
				return $vSelectID;
			}
			else
			$lvResult = db_query($vsql);
			while($row= db_fetch_array($lvResult)){
			return ($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
			}
			
		}
	}
	?>