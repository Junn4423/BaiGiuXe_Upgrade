<?php
/////////////coding hr_lv0020///////////////
class   jo_lv0004_1 extends lv_controler
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
	public $lv024=null;
	public $lv025=null;
	public $lv026=null;
	public $lv027=null;
	public $lv028=null;
	public $lv029=null;
	public $lv030=null;
	public $lv031=null;
	public $lv032=null;
	public $lv033=null;
	public $lv034=null;
	public $lv035=null;
	public $lv036=null;
	public $lv037=null;
	public $lv038=null;
	public $lv039=null;
	public $lv040=null;
	public $lv041=null;
	public $lv042=null;
	public $lv043=null;
	public $lv044=null;
	public $lv045=null;
	public $lv046=null;
	public $lv049=null;
	public $lv050=null;
	public $lv051=null;
	
	public $dateworkfrom=null;
	public $dateworkto=null;
	
///////////
	public $DefaultFieldList="lv001,lv002,lv005,lv029,lv099,lv101,lv025";
///////////////////	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	public $ArrDeptCurrent=null;
	public $ArrTimeCal=null;
	protected $objhelp='hr_lv0020';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv027"=>"28","lv028"=>"29","lv029"=>"30","lv030"=>"31","lv031"=>"32","lv032"=>"33","lv033"=>"34","lv034"=>"35","lv035"=>"36","lv036"=>"37","lv037"=>"38","lv038"=>"39","lv039"=>"40","lv040"=>"41","lv041"=>"42","lv042"=>"43","lv043"=>"44","lv044"=>"45","lv045"=>"46","lv046"=>"47","lv047"=>"48","lv048"=>"49","lv049"=>"50","lv050"=>"51","lv051"=>"52","lv052"=>"53","lv060"=>"61","lv061"=>"62","lv062"=>"63","lv063"=>"64","lv064"=>"65","lv065"=>"66","lv066"=>"67","lv067"=>"68","lv069"=>"70","lv099"=>"100","lv101"=>"102","lv102"=>"103","lv103"=>"104","lv104"=>"105","lv105"=>"106","lv106"=>"107","lv150"=>"151","lv302"=>"303","lv303"=>"304","lv304"=>"305","lv305"=>"306","lv306"=>"307","lv307"=>"308","lv308"=>"309","lv309"=>"310","lv310"=>"311","lv311"=>"312","lv312"=>"313","lv313"=>"314","lv199"=>"200","lv829"=>"830");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"2","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"2","lv016"=>"0","lv017"=>"0","lv018"=>"0","lv019"=>"0","lv020"=>"0","lv021"=>"2","lv022"=>"0","lv023"=>"0","lv024"=>"0","lv025"=>"22","lv026"=>"0","lv027"=>"0","lv028"=>"0","lv029"=>"0","lv030"=>"2","lv031"=>"0","lv032"=>"0","lv033"=>"0","lv034"=>"0","lv035"=>"0","lv036"=>"0","lv037"=>"0","lv038"=>"0","lv039"=>"0","lv040"=>"0","lv041"=>"0","lv042"=>"0","lv043"=>"0","lv044"=>"2","lv045"=>"0","lv046"=>"10","lv047"=>"10","lv048"=>"10","lv049"=>"0","lv050"=>"10","lv051"=>"0","lv052"=>"10","lv060"=>"0","lv061"=>"0","lv062"=>"0","lv063"=>"0","lv064"=>"0","lv065"=>"0","lv066"=>"0","lv067"=>"0","lv068"=>"0","lv069"=>"0","lv099"=>"0","lv101"=>"0","lv102"=>"10","lv103"=>"10","lv104"=>"4","lv105"=>"0","lv106"=>"0","lv150"=>"10","lv302"=>"0","lv303"=>"0","lv304"=>"0","lv305"=>"2","lv306"=>"0","lv307"=>"0","lv308"=>"10","lv309"=>"0","lv310"=>"0","lv311"=>"0","lv312"=>"0","lv313"=>"2","lv199"=>"0");	

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
	 	$this->isFil=1;	
		$this->isAdd=0;		
		$this->isEdit=0;		
		$this->isRpt=0;		
		$this->isApr=0;		
		$this->isUnApr=0;
		$this->isDel=0;		
		$this->lang=$_GET['lang'];
		if($_GET['func']=='excel') $this->ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"2","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"2","lv016"=>"0","lv017"=>"0","lv018"=>"0","lv019"=>"0","lv020"=>"0","lv021"=>"2","lv022"=>"0","lv023"=>"0","lv024"=>"0","lv025"=>"0","lv026"=>"0","lv027"=>"0","lv028"=>"0","lv029"=>"0","lv030"=>"2","lv031"=>"0","lv032"=>"0","lv033"=>"0","lv034"=>"0","lv035"=>"0","lv036"=>"0","lv037"=>"0","lv038"=>"0","lv039"=>"0","lv040"=>"0","lv041"=>"0","lv042"=>"0","lv043"=>"0","lv044"=>"2","lv045"=>"0","lv046"=>"0","lv047"=>"0","lv048"=>"0","lv049"=>"0","lv050"=>"0","lv051"=>"0","lv052"=>"0","lv060"=>"0","lv061"=>"0","lv062"=>"0","lv063"=>"0","lv064"=>"0","lv065"=>"0","lv066"=>"0","lv099"=>"0","lv102"=>"0","lv103"=>"0","lv150"=>"0");	
		
	}
	function LV_CheckExist($vlv001)
	{
		$lvsql="select lv001 from  hr_lv0020 Where lv001='$vlv001'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			if($vrow['lv001']=='' || $vrow['lv001']!=NULL) return false;
			return true;
		}
		return false;
	}
	function LV_ChanageALL($vlv001,$vNewID)
	{
		$vcheck=$this->LV_CheckExist($vNewID);
		if($vcheck==true)
		{
			return false;
		}
		else
		{
			$vsql="update hr_lv0024 set lv002='$vNewID'";
		}
	}
	function LV_Load()
	{
		$vsql="select * from  hr_lv0020";
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
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv040=$vrow['lv040'];
			$this->lv041=$vrow['lv041'];
			$this->lv042=$vrow['lv042'];
			$this->lv043=$vrow['lv043'];
			$this->lv044=$vrow['lv044'];
			$this->lv045=$vrow['lv045'];
			$this->lv049=$vrow['lv049'];
			$this->lv060=$vrow['lv060'];
			$this->lv061=$vrow['lv061'];
			$this->lv062=$vrow['lv062'];
			$this->lv063=$vrow['lv063'];
			$this->lv064=$vrow['lv064'];
			$this->lv065=$vrow['lv065'];
			$this->lv066=$vrow['lv066'];
			$this->lv067=$vrow['lv067'];
			$this->lv068=$vrow['lv068'];
			$this->lv069=$vrow['lv069'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
			$this->lv102=$vrow['lv102'];
			$this->lv104=$vrow['lv104'];
			$this->lv105=$vrow['lv105'];
			$this->lv106=$vrow['lv106'];
		}
	}
	function LV_GetPBLon($vlv001)
	{
		if($vlv001=='BUENO' || $vlv001=='GROUP' || $vlv001=='HOTEL' || $vlv001=='') return $vlv001;
		$lvsql="select lv001,lv002,lv003 from  hr_lv0002 Where lv001='$vlv001'";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			
			if($vrow['lv002']=='BUENO' || $vrow['lv002']=='GROUP' || $vrow['lv002']=='HOTEL')
			{
				return $vrow['lv003'];
			}
			else
			{
				return $this->LV_GetPBLon($vrow['lv002']);
			}
		}
		return $vlv001;
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  hr_lv0020 Where lv001='$vlv001'";
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
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv040=$vrow['lv040'];
			$this->lv041=$vrow['lv041'];
			$this->lv042=$vrow['lv042'];				
			$this->lv043=$vrow['lv043'];
			$this->lv044=$vrow['lv044'];
			$this->lv045=$vrow['lv045'];
			$this->lv049=$vrow['lv049'];
			$this->lv060=$vrow['lv060'];
			$this->lv061=$vrow['lv061'];
			$this->lv062=$vrow['lv062'];
			$this->lv063=$vrow['lv063'];
			$this->lv064=$vrow['lv064'];
			$this->lv065=$vrow['lv065'];
			$this->lv066=$vrow['lv066'];
			$this->lv067=$vrow['lv067'];
			$this->lv068=$vrow['lv068'];
			$this->lv069=$vrow['lv069'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
			$this->lv102=$vrow['lv102'];
			$this->lv104=$vrow['lv104'];
			$this->lv105=$vrow['lv105'];
			$this->lv106=$vrow['lv106'];
		}
		else
		{
			$this->lv001=null;
		}
	}
	function LV_LoadFullID($vlv001)
	{
		$lvsql="select *,DATEDIFF(CURRENT_DATE(),lv015)/365 lv046,(((year(CURRENT_DATE())-year(lv030))*12+month(CURRENT_DATE())-month(lv030))/12) lv047,(select B.lv003 from hr_lv0033 A inner join hr_lv0008 B on A.lv003=B.lv001	 where A.lv002=hr_lv0020.lv001 order by A.lv003 DESC limit 0,1) lv050 from  hr_lv0020  Where lv001='$vlv001'";
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
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv040=$vrow['lv040'];
			$this->lv041=$vrow['lv041'];
			$this->lv042=$vrow['lv042'];				
			$this->lv043=$vrow['lv043'];
			$this->lv044=$vrow['lv044'];
			$this->lv045=$vrow['lv045'];
			$this->lv046=$vrow['lv046'];
			$this->lv047=$vrow['lv047'];
			$this->lv049=$vrow['lv049'];			
			$this->lv048=$vrow['lv048'];
			$this->lv050=$vrow['lv050'];
			$this->lv060=$vrow['lv060'];
			$this->lv061=$vrow['lv061'];
			$this->lv062=$vrow['lv062'];
			$this->lv063=$vrow['lv063'];
			$this->lv064=$vrow['lv064'];
			$this->lv065=$vrow['lv065'];
			$this->lv066=$vrow['lv066'];
			$this->lv067=$vrow['lv067'];
			$this->lv068=$vrow['lv068'];
			$this->lv069=$vrow['lv069'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
			$this->lv102=$vrow['lv102'];
			$this->lv104=$vrow['lv104'];
			$this->lv105=$vrow['lv105'];
			$this->lv106=$vrow['lv106'];
		}
		else
		{
			$this->lv001=null;
		}
	}
	function LV_LoadFullIDCal($vlv001,$vDate)
	{
		$lvsql="select *,DATEDIFF(CURRENT_DATE(),lv015)/365 lv046,(((year('$vDate')-year(lv030))*12+month('$vDate')-month(lv030))/12) lv047,(select B.lv003 from hr_lv0033 A inner join hr_lv0008 B on A.lv003=B.lv001	 where A.lv002=hr_lv0020.lv001 order by A.lv003 DESC limit 0,1) lv050 from  hr_lv0020  Where lv001='$vlv001'";
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
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv040=$vrow['lv040'];
			$this->lv041=$vrow['lv041'];
			$this->lv042=$vrow['lv042'];				
			$this->lv043=$vrow['lv043'];
			$this->lv044=$vrow['lv044'];
			$this->lv045=$vrow['lv045'];
			$this->lv046=$vrow['lv046'];
			$this->lv047=$vrow['lv047'];
			$this->lv049=$vrow['lv049'];			
			$this->lv048=$vrow['lv048'];
			$this->lv050=$vrow['lv050'];
			$this->lv060=$vrow['lv060'];
			$this->lv061=$vrow['lv061'];
			$this->lv062=$vrow['lv062'];
			$this->lv063=$vrow['lv063'];
			$this->lv064=$vrow['lv064'];
			$this->lv065=$vrow['lv065'];
			$this->lv066=$vrow['lv066'];
			$this->lv067=$vrow['lv067'];
			$this->lv068=$vrow['lv068'];
			$this->lv069=$vrow['lv069'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
			$this->lv102=$vrow['lv102'];
			$this->lv104=$vrow['lv104'];
			$this->lv105=$vrow['lv105'];
			$this->lv106=$vrow['lv106'];
		}
		else
		{
			$this->lv001=null;
		}
	}
	function LV_CurLoadID($vlv001)
	{
		$lvsql="select *,(select B.lv003 from hr_lv0033 A inner join hr_lv0008 B on A.lv003=B.lv001	 where A.lv002=hr_lv0020.lv001 order by A.lv003 DESC limit 0,1) lv050 from  hr_lv0020 Where lv001='$vlv001'";
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
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv040=$vrow['lv040'];
			$this->lv041=$vrow['lv041'];
			$this->lv042=$vrow['lv042'];				
			$this->lv043=$vrow['lv043'];
			$this->lv044=$vrow['lv044'];
			$this->lv045=$vrow['lv045'];
			$this->lv049=$vrow['lv049'];
			$this->lv050=$vrow['lv050'];
			$this->lv060=$vrow['lv060'];
			$this->lv061=$vrow['lv061'];
			$this->lv062=$vrow['lv062'];
			$this->lv063=$vrow['lv063'];
			$this->lv064=$vrow['lv064'];
			$this->lv065=$vrow['lv065'];
			$this->lv066=$vrow['lv066'];
			$this->lv067=$vrow['lv067'];
			$this->lv068=$vrow['lv068'];
			$this->lv069=$vrow['lv069'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
			$this->lv102=$vrow['lv102'];
			$this->lv104=$vrow['lv104'];
			$this->lv105=$vrow['lv105'];
			$this->lv106=$vrow['lv106'];
		}
		else
		{
			$this->lv001=null;
			$this->lv002=null;//['lv002'];
			$this->lv003=null;//['lv003'];
			$this->lv004=null;//['lv004'];
			$this->lv005=null;//['lv005'];
			$this->lv006=null;//['lv006'];	
			$this->lv007=null;//['lv007'];
			$this->lv008=null;//['lv008'];
			$this->lv009=null;//['lv009'];
			$this->lv010=null;//['lv010'];
			$this->lv011=null;//['lv011'];
			$this->lv012=null;//['lv012'];
			$this->lv013=null;//['lv013'];
			$this->lv014=null;//['lv014'];
			$this->lv015=null;//['lv015'];
			$this->lv016=null;//['lv016'];
			$this->lv017=null;//['lv017'];
			$this->lv018=null;//['lv018'];
			$this->lv019=null;//['lv019'];
			$this->lv020=null;//['lv020'];
			$this->lv021=null;//['lv021'];
			$this->lv022=null;//['lv022'];
			$this->lv023=null;//['lv023'];
			$this->lv024=null;//['lv024'];
			$this->lv025=null;//['lv025'];
			$this->lv026=null;//['lv026'];
			$this->lv027=null;//['lv027'];
			$this->lv028=null;//['lv028'];
			$this->lv029=null;//['lv029'];
			$this->lv030=null;//['lv030'];
			$this->lv031=null;//['lv031'];
			$this->lv032=null;//['lv032'];
			$this->lv033=null;//['lv033'];
			$this->lv034=null;//['lv034'];
			$this->lv035=null;//['lv035'];
			$this->lv036=null;//['lv036'];
			$this->lv037=null;//['lv037'];
			$this->lv038=null;//['lv038'];
			$this->lv039=null;//['lv039'];
			$this->lv040=null;//['lv040'];
			$this->lv041=null;//['lv041'];
			$this->lv042=null;//['lv042'];				
			$this->lv043=null;//['lv043'];
			$this->lv044=null;//['lv044'];
			$this->lv045=null;//['lv045'];
			$this->lv049=null;//['lv049'];
			$this->lv050=null;//['lv050'];
			$this->lv060=null;
			$this->lv061=null;
			$this->lv062=null;
			$this->lv063=null;
			$this->lv064=null;
			$this->lv065=null;
			$this->lv066=null;
			$this->lv067=null;
			$this->lv068=null;
			$this->lv069=null;
			$this->lv099=null;
		}
	}
	function LV_UnAproval($lvarr)
	{
		if($this->isEdit==0) return false;
		$lvsql = "Update hr_lv0020 set lv009=2  WHERE hr_lv0020.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0013.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Aproval($lvarr)
	{
		if($this->isEdit==0) return false;
		$lvsql = "Update hr_lv0020 set lv009=0  WHERE hr_lv0020.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0013.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_codeidfill($codeid)
	{
		$codeid=trim($codeid);
		$len=strlen($codeid);
		
		if($codeid=="")
		{
	   $lvReturn='<table style="width: 252px; height: 24px;" border="1" cellspacing="0" cellpadding="0">
	<tbody>
	<tr>
	<td width="22" height="22">&nbsp;</td>
	<td width="22">&nbsp;</td>
	<td width="22">&nbsp;</td>
	<td width="22">&nbsp;</td>
	<td width="22">&nbsp;</td>
	<td width="22">&nbsp;</td>
	<td width="22">&nbsp;</td>
	<td width="22">&nbsp;</td>
	<td width="22">&nbsp;</td>
	<td width="22">&nbsp;</td>
	<td width="22">&nbsp;</td>
	</tr>
	</tbody>
	</table>';
		}
		else
		{
			 $lvReturn='<table style="width: 252px; height: 24px;" border="1" cellspacing="0" cellpadding="0">
	<tbody>
	<tr>';
		for($i=0;$i<$len;$i++)
		{
			$lvReturn=$lvReturn.'<td width="22" height="22" align=center>'.substr($codeid,$i,1).'</td>';
		}
		for($i=0;$i<11-$len;$i++)
		{
			$lvReturn=$lvReturn.'<td width="22" height="22">&nbsp;</td>';
		}
			$lvReturn=$lvReturn.'</tr>
	</tbody>
	</table>';
	
		}
		return $lvReturn;
	
	}
	
	function LV_GetLastName($strFullName){
	
		$vArrName= explode(" ",trim($strFullName));
		return $vArrName[count($vArrName)-1];
		
	}
	function  LV_None($str) {
	if($str=="" || $str==NULL) return '';
	$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
	$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	$str = preg_replace("/(đ)/", 'd', $str);
	$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
	$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
	$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
	$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
	$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
	$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
	$str = preg_replace("/(Đ)/", 'D', $str);
	//$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
	//$str=strtolower($str);
	return $str;
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
		if($this->FullName!="")
		{	
			$vArrName=explode(",",$this->FullName);
			foreach($vArrName as $vName)
			{
				if($vName!="")
				{
				if($strCondi=="")	
					$strCondi= " AND ( concat(lv004,' ',lv003,' ',lv002)  like '%$vName%'";
				else
					$strCondi=$strCondi." OR concat(lv004,' ',lv003,' ',lv002)  like '%$vName%'";		
				}
			}
			$strCondi=$strCondi.")";
			
		}
		if($this->lsempid!="")  $strCondi=$strCondi." and lv001 in ('".str_replace(",","','",$this->lsempid)."')";
		if($this->lv001!="") $strCondi=$strCondi." and lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and lv009 in ('".str_replace(",","','",$this->lv009)."')";
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
		if($this->lv020!="")  $strCondi=$strCondi." and lv020 like '%$this->lv020%'";
		if($this->lv021!="")  $strCondi=$strCondi." and lv021 like '%$this->lv021%'";
		if($this->lv022!="")  $strCondi=$strCondi." and lv022 like '%$this->lv022%'";
		if($this->lv023!="")  $strCondi=$strCondi." and lv023 like '%$this->lv023%'";
		if($this->lv024!="")  $strCondi=$strCondi." and lv024 like '%$this->lv024%'";
		if($this->lv025!="")  $strCondi=$strCondi." and lv025 like '%$this->lv025%'";
		if($this->lv026!="")  $strCondi=$strCondi." and lv026 like '%$this->lv026%'";
		if($this->lv027!="")  $strCondi=$strCondi." and lv027 like '%$this->lv027%'";
		if($this->lv028!="")  $strCondi=$strCondi." and lv028 like '%$this->lv028%'";
		if($this->lv029!="")  
		{
			$strCondi=$strCondi." and lv029 in (".$this->LV_GetDep($this->lv029).")";
		}
		if($this->lv030!="")  $strCondi=$strCondi." and lv030 like '%$this->lv030%'";
		if($this->lv031!="")  $strCondi=$strCondi." and lv031 like '%$this->lv031%'";
		if($this->lv032!="")  $strCondi=$strCondi." and lv032 like '%$this->lv032%'";
		if($this->lv033!="")  $strCondi=$strCondi." and lv033 like '%$this->lv033%'";
		if($this->lv034!="")  $strCondi=$strCondi." and lv034 like '%$this->lv034%'";
		if($this->lv035!="")  $strCondi=$strCondi." and lv035 like '%$this->lv035%'";
		if($this->lv036!="")  $strCondi=$strCondi." and lv036 like '%$this->lv036%'";
		if($this->lv037!="")  $strCondi=$strCondi." and lv037 like '%$this->lv037%'";
		if($this->lv038!="")  $strCondi=$strCondi." and lv038 like '%$this->lv038%'";
		if($this->lv039!="")  $strCondi=$strCondi." and lv039 like '%$this->lv039%'";
		if($this->lv040!="")  $strCondi=$strCondi." and lv040 like '%$this->lv040%'";
		if($this->lv041!="")  $strCondi=$strCondi." and lv041 like '%$this->lv041%'";
		if($this->lv042!="")  $strCondi=$strCondi." and lv042 like '%$this->lv042%'";
		if($this->lv043!="")  $strCondi=$strCondi." and lv043 like '%$this->lv043%'";
		if($this->lv044!="")  $strCondi=$strCondi." and lv044 like '%$this->lv044%'";
		if($this->lv045!="")  $strCondi=$strCondi." and lv045 like '%$this->lv045%'";
		if($this->lv060!="")  $strCondi=$strCondi." and lv060 like '%$this->lv060%'";
		if($this->lv061!="")  $strCondi=$strCondi." and lv061 like '%$this->lv061%'";
		if($this->lv062!="")  $strCondi=$strCondi." and lv062 like '%$this->lv062%'";
		if($this->lv063!="")  $strCondi=$strCondi." and lv063 like '%$this->lv063%'";
		if($this->lv064!="")  $strCondi=$strCondi." and lv064 like '%$this->lv064%'";
		if($this->lv065!="")  $strCondi=$strCondi." and lv065 like '%$this->lv065%'";
		if($this->lv066!="")  $strCondi=$strCondi." and lv066 like '%$this->lv066%'";
		if($this->lv067!="")  $strCondi=$strCondi." and lv067 like '%$this->lv067%'";
		if($this->lv068!="")  $strCondi=$strCondi." and lv068 like '%$this->lv068%'";
		if($this->lv099!="")  $strCondi=$strCondi." and lv099 like '%$this->lv099%'";

		return $strCondi;
	}
	function LV_GetDep($vDepID)
	{
		if($vDepID=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		$vsql="select lv001 from  hr_lv0002 where lv001 in ($vReturn)  order by lv103 asc";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			//$vReturn=$vReturn.",'".$vrow['lv001']."'";
			$vReturn=$vReturn.",".$this->LV_GetChildDep($vrow['lv001']);
		}
		return $vReturn;
	}
	function LV_GetChildDep($vDepID)
	{
		$vReturn="";
		if(trim($vDepID)=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		$vsql="select lv001 from  hr_lv0002 where lv002 in ($vReturn) order by lv103 asc";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vReturn=$vReturn.",".$this->LV_GetChildDep($vrow['lv001']);
		}
		return $vReturn;
	}
		////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM hr_lv0020 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
		////////////////Count///////////////////////////
	function LV_Get_HoiVien($vEmployeeID)
	{
		$vreturn="";
		$sqlC = "select B.lv002 from hr_lv0034 A inner join hr_lv0013 B on A.lv003=B.lv001	 where A.lv002='$vEmployeeID' order by A.lv003 DESC";
		$bResultC = db_query($sqlC);
		while($arrRowC = db_fetch_array($bResultC))
		{
			if($vreturn=="") 
				$vreturn=$arrRowC['lv002'];
			else
				$vreturn=$vreturn." , ".$arrRowC['lv002'];
		}
		return $vreturn;
	}
	function LV_Get_HopDong($vEmployeeID)
	{
		$vreturn="";
		$sqlC = "select lv016 from hr_lv0038 where lv002='$vEmployeeID' and lv009=1 order by lv001 DESC";
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		if($arrRowC) return $arrRowC['lv016'];
		return 0;
	}
	function GetSalaryOpt($vEmployeeID,$vOpt)
	{
		$vsql="select BB.lv021 TotalMoney from  hr_lv0038 BB where BB.lv002='$vEmployeeID' and BB.lv009=1";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
			return $vrow['TotalMoney'];
		}
		return 0;
	}
	function LV_GetChan($vvalue)
	{
		$vArr=explode(".",$vvalue);
		return $vArr[0];
	}
	public function LV_GetChildDepSelect($vDepID,$vSelectID)
	{
		if($vDepID=="") 
		{
			$vDepID='BUENO';
			$vsql="select lv001,lv003 from  hr_lv0002 where lv002='$vDepID' order by lv003";
			$bResult=db_query($vsql);
			while ($vrow = db_fetch_array ($bResult)){
				$vReturn=$vReturn."<option value='".$vrow['lv001']."' ".(($vSelectID==$vrow['lv001'])?'selected="selected"':'').">".$vrow['lv003']."</option>";
				$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow['lv001']."' order by lv003";
				$bResult1=db_query($vsql);
				while ($vrow1 = db_fetch_array ($bResult1)){					
					$vReturn=$vReturn."<option value='".$vrow1['lv001']."' ".(($vSelectID==$vrow1['lv001'])?'selected="selected"':'').">&nbsp;&nbsp;&nbsp;&nbsp;".$vrow1['lv003']."</option>";
					$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow1['lv001']."' order by lv003";
					$bResult2=db_query($vsql);
					while ($vrow2 = db_fetch_array ($bResult2)){
						
						$vReturn=$vReturn."<option value='".$vrow2['lv001']."' ".(($vSelectID==$vrow2['lv001'])?'selected="selected"':'').">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$vrow2['lv003']."</option>";
						$vsql="select lv001,lv003 from  hr_lv0002 where lv002='".$vrow2['lv001']."' order by lv003";
						$bResult3=db_query($vsql);
						while ($vrow3 = db_fetch_array ($bResult3)){
							
							$vReturn=$vReturn."<option value='".$vrow3['lv001']."' ".(($vSelectID==$vrow3['lv001'])?'selected="selected"':'').">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$vrow3['lv003']."</option>";
						}
					}
				}
			}
		}
		else
		{
		if(strpos($vDepID,",")===false) $vReturn="<option value='".$vDepID."'>".$vDepID."</option>";
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		$vsql="select lv001,lv003 from  hr_lv0002 where (lv001 in ($vReturn) or lv002 in ($vReturn))  order by lv003";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			
			$vReturn=$vReturn."<option value='".$vrow['lv001']."' ".(($vSelectID==$vrow['lv001'])?'selected="selected"':'').">&nbsp;&nbsp;&nbsp;&nbsp;".$vrow['lv003']."</option>";
		}
		}
		return $vReturn;
	}
	function LV_GetThamNien($vEmployeeID,$vThamNien)
	{
		$vThamNien=$this->LV_GetChan($vThamNien);
		$vsql="select BB.lv026 BasicSalary,lv010 from  hr_lv0038 BB where BB.lv002='$vEmployeeID' and BB.lv009=1";
		$vresult=db_query($vsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
			if($vrow['lv010']==1)
			{
				$vBasicSalary=$vrow['BasicSalary'];
				$vReturn= ROUND((($vThamNien<1)?0:(($vThamNien==1)?$vBasicSalary*0.1:(($vThamNien==2)?$vBasicSalary*0.14:(($vThamNien==3)?1.4*0.14*$vBasicSalary:(($vThamNien==4)?1.45*1.4*0.14*$vBasicSalary:(($vThamNien==5)?1.45*1.45*1.4*0.14*$vBasicSalary:(($vThamNien>5 && $vThamNien<10)?pow(1.1,($vThamNien-5))*1.45*1.45*1.4*0.14*$vBasicSalary:pow(1.15,($vThamNien-9))*1.4641*1.45*1.45*1.4*1.4*0.1*$vBasicSalary))))))),0);
				return $vReturn;
				}
			else
				return 0;
			}
			else
				return 0;
		}
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
		$lvHref="<span onclick=\"ProcessTextHiden(this)\"><a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\">@02</a></span>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$lvImg="<td  ><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"../../images/employees/@01/@02\" /></td>";
		$sqlS = "SELECT * FROM hr_lv0020 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
		while ($vrow = db_fetch_array ($bResult)){
			$vSumTongTien=$vSumTongTien+$vrow['lv150'];
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=='lv007')
				{
					$vTemp=str_replace("@02",$vrow[$lstArr[$i]],str_replace("@01",$vrow['lv001'],$lvImg));
				}
				else if($lstArr[$i]=='lv048')
				{
					$vThamNien=$this->LV_GetThamNien($vrow['lv001'],(int)$vrow['lv047']);
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vThamNien,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv051')
				{
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_Get_HoiVien($vrow['lv001']),(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv052')
				{
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->GetSalaryOpt($vrow['lv001'],0),(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv048')
				{
					$vThamNien=$this->LV_GetThamNien($vrow['lv001'],(int)$vrow['lv047']);
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vThamNien,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv047')
				{
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetChan($vrow[$lstArr[$i]]),(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv150-->",$this->FormatView($vSumTongTien,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
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
			$vsql="select * from  ".$vTbl." where lv002='BUENO'";
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
			$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
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
			$strTemp=str_replace("@#02",$vspace.'|-----'.$vrow1[$vFieldView]."(".$vrow1['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
			$strGetScript=$strGetScript.$this->GetBuilCheckListChild($vListID,$vID,$vrow1['lv001'],$vTbl,$vFieldView,$i,$numrows,$vspace.'&nbsp;&nbsp;&nbsp;');
			$i++;
		}
		$i--;
		return $strGetScript;
	}
	public function GetBuilCheckListDep($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002')
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
		$vsql="select * from  ".$vTbl." where lv002='BUENO'";
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
			$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
			
						$i++;
						$vsql1="select * from  ".$vTbl." where lv002='".$vrow['lv001']."' order by lv003";
						$vresult1=db_query($vsql1);
						$numrows=$numrows+db_num_rows($vresult1);
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
							$strTemp=str_replace("@#02",'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$vrow1[$vFieldView]."(".$vrow1['lv001'].")",$strTemp);
							$strGetScript=$strGetScript.$strTemp;
							$i++;
							$vsql2="select * from  ".$vTbl." where lv002='".$vrow1['lv001']."' order by lv003";
							$vresult2=db_query($vsql2);
							$numrows=$numrows+db_num_rows($vresult2);
							while($vrow2=db_fetch_array($vresult2))		
							{
								$strTempChk=str_replace("@01",$i,$lvChk);
								$strTempChk=str_replace("@02",$vrow2['lv001'],$strTempChk);
								if(strpos($vListID,",".$vrow2['lv001'].",") === FALSE)
									$strTempChk=str_replace("@03","",$strTempChk);
								else
									$strTempChk=str_replace("@03","checked=checked",$strTempChk);
								
								$strTempChk=str_replace("@04",'&nbsp;&nbsp;&nbsp;'.$vrow2['lv003'],$strTempChk);
								
								$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
								$strTemp=str_replace("@#02",'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$vrow2[$vFieldView]."(".$vrow2['lv001'].")",$strTemp);
								$strGetScript=$strGetScript.$strTemp;
								$i++;
								$vsql3="select * from  ".$vTbl." where lv002='".$vrow2['lv001']."' order by lv003";
								$vresult3=db_query($vsql3);
								$numrows=$numrows+db_num_rows($vresult3);
								while($vrow3=db_fetch_array($vresult3))		
								{
									$strTempChk=str_replace("@01",$i,$lvChk);
									$strTempChk=str_replace("@02",$vrow3['lv001'],$strTempChk);
									if(strpos($vListID,",".$vrow3['lv001'].",") === FALSE)
										$strTempChk=str_replace("@03","",$strTempChk);
									else
										$strTempChk=str_replace("@03","checked=checked",$strTempChk);
									
									$strTempChk=str_replace("@04",'&nbsp;&nbsp;&nbsp;'.$vrow3['lv003'],$strTempChk);
									
									$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
									$strTemp=str_replace("@#02",'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$vrow3[$vFieldView]."(".$vrow3['lv001'].")",$strTemp);
									$strGetScript=$strGetScript.$strTemp;
									$i++;
									
								}
							}
						}
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	public function CheckListFilter($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002')
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
		$vsql="select * from  ".$vTbl;
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
			$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
						$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	public function GetMonthStartEnd($vStartDate,$vEndDate)
	{
		$vCount=0;
		$vStartMonth=getmonth($vStartDate);
		$vStartYear=getyear($vStartDate);
		$vSDate=getday($vStartDate);
		
		$vEndMonth=getmonth($vEndDate);
		$vEndYear=getyear($vEndDate);
		$vEDate=getday($vEndDate);
		if($vStartYear==$vEndYear)
		{
			$vCount= ($vEndMonth-$vStartMonth);
		}
		else
		{
			for($i=$vStartYear;$i<=$vEndYear;$i++)
			{
				if($i==$vStartYear)
				{
					$vCount=$vCount+12-$vStartMonth;				
				}
				else if($i==$vEndYear)
				{
					$vCount=$vCount+$vEndMonth;
				}
				else
				{
					$vCount=$vCount+12;				
				}
				
			}
		}
		if((int)$vEDate-(int)$vSDate>15) $vCount++;
		return $vCount;
		
	}
/////////////////////ListFieldExport//////////////////////////
	function ListFieldExport($lvFrom,$lvList,$maxRows)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvSelect="<ul id=\"menu1-nav\" onkeyup=\"return CheckKeyCheckTabExp(event)\">
						<li class=\"menusubT1\"><img src=\"../images/lvicon/config.png\" border=\"0\" />".$this->ArrFunc[12]."
							<ul id=\"submenu1-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function Export(vFrom,value)
		{
			ChkedViewAll(value,vFrom,'lvChk');
			
		}
		function Reports(frm, strchk, value)
		{
			window.open('hr_lv0020/?lang=".$this->lang."&func='+value+'&Emp='+strchk,'','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
						<li class=\"menusubT\"><img src=\"../images/lvicon/config.png\" border=\"0\" />".$this->ArrFunc[11]."
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
	function LV_BuilListReport($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
	{
		$sExport=$_GET['func'];	
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
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"1\">&nbsp;</td>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$lvImg="<td  ><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"../../images/employees/@01/@02\" /></td>";
		if($this->ListEmp!="")
			{
				$strar=substr($this->ListEmp,0,strlen($this->ListEmp)-1);
				$strar=str_replace("@","','",$strar);
				$strar="'".$strar."'";
				$vCondition=" And lv001 in ($strar) ";
			}
		$sqlS = "SELECT *,lv029 lv199,'200000' lv150,DATEDIFF(CURRENT_DATE(),lv015)/365 lv046,(((year(CURRENT_DATE())-year(lv030))*12+month(CURRENT_DATE())-month(lv030))/12) lv047,(select B.lv003 from hr_lv0033 A inner join hr_lv0008 B on A.lv003=B.lv001	 where A.lv002=hr_lv0020.lv001 order by A.lv003 DESC limit 0,1) lv050 FROM hr_lv0020 WHERE 1=1  $vCondition ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
			
		while ($vrow = db_fetch_array ($bResult)){
			$vSumTongTien=$vSumTongTien+$vrow['lv150'];
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=='lv007')
				{
					$vTemp=str_replace("@02",$vrow[$lstArr[$i]],str_replace("@01",$vrow['lv001'],$lvImg));

				}
				else if($lstArr[$i]=='lv048')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$vrow['lv001']),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv051')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_Get_HoiVien($vrow['lv001']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv052')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->GetSalaryOpt($vrow['lv001'],0),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv047')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetChan($vrow[$lstArr[$i]]),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv001' && $sExport=="excel")
				{
					$vTemp=str_replace("@02",'<Data ss:Type="String">="'.$vrow['lv001'].'"</Data>',$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv150-->",$this->FormatView($vSumTongTien,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function GetConditionRpt()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and lv001  like '%$this->lv001%'";
		if($this->lv009!="")  $strCondi=$strCondi." and lv009 in ('".str_replace(",","','",$this->lv009)."')";
		if($this->lv026!="") $strCondi=$strCondi." and lv026 ='$this->lv026'";
		if($this->lv018!="") $strCondi=$strCondi." and lv018 ='$this->lv018'";
		if($this->lv028!="")  
		{
			$strCondi=$strCondi." and lv028 in ('".str_replace(",","','",$this->lv028)."')";
		}
		if($this->lv029!="")  
		{
			$strCondi=$strCondi." and lv029 in (".$this->LV_GetDep($this->lv029).")";
		}
		if($this->lv042!="")  
		{
			$strCondi=$strCondi." and lv042 in ('".str_replace(",","','",$this->lv042)."')";
		}
		if($this->isWork==4)
		{
			$vListEmp=$this->LV_GetEmpDependence();
			if($vListEmp!="") $strCondi=$strCondi." and lv001  in ($vListEmp)";
		}
		elseif($this->isWork==3)
		{
			$vListEmp=$this->LV_GetEmpReminder();
			if($vListEmp!="") $strCondi=$strCondi." and lv001  in ($vListEmp)";
		}
		else if($this->isWork==1112)
		{
			if($this->dateworkfrom!="")
			{
				$vYeraN=getyear(recoverdate($this->dateworkfrom, $this->lang));
				$strCondi=$strCondi." and replace(lv015,year(lv015),'$vYeraN')>= '".str_replace("/","-",recoverdate($this->dateworkfrom, $this->lang))."'";
			}
			if($this->dateworkto!="")
			{
				$vYeraN=getyear(recoverdate($this->dateworkto, $this->lang));
				$strCondi=$strCondi." and replace(lv015,year(lv015),'$vYeraN')<= '".str_replace("/","-",recoverdate($this->dateworkto, $this->lang))."'";
			}
		}
		else if($this->isWork==2)
		{
			if($this->isbirthday==0)
			{
				if($this->dateworkfrom!="")
				{
					$vYeraN=getyear(recoverdate($this->dateworkfrom, $this->lang));
					$strCondi=$strCondi." and replace(lv015,year(lv015),'$vYeraN')>= '".str_replace("/","-",recoverdate($this->dateworkfrom, $this->lang))."'";
				}
				if($this->dateworkto!="")
				{
					$vYeraN=getyear(recoverdate($this->dateworkto, $this->lang));
					$strCondi=$strCondi." and replace(lv015,year(lv015),'$vYeraN')<= '".str_replace("/","-",recoverdate($this->dateworkto, $this->lang))."'";
				}
			}
			else
			{
				if($this->dateworkfrom!="")
				{
					$strCondi=$strCondi." and lv015>= '".str_replace("/","-",recoverdate($this->dateworkfrom, $this->lang))."'";
				}
				if($this->dateworkto!="")
				{
					$vYeraN=getyear(recoverdate($this->dateworkto, $this->lang));
					$strCondi=$strCondi." and lv015<= '".str_replace("/","-",recoverdate($this->dateworkto, $this->lang))."'";
				}
			}
		}
		elseif($this->isWork==1)
		{
			if($this->dateworkfrom!="")
			{
				$strCondi=$strCondi." and lv044>= '".recoverdate($this->dateworkfrom, $this->lang)."'";
			}
			if($this->dateworkto!="")
			{
				$strCondi=$strCondi." and lv044<= '".recoverdate($this->dateworkto, $this->lang)."'";
			}
		}
		else
		{
			if($this->dateworkfrom!="")
			{
				$strCondi=$strCondi." and lv030>= '".recoverdate($this->dateworkfrom, $this->lang)."'";
			}
			if($this->dateworkto!="")
			{
				$strCondi=$strCondi." and lv030<= '".recoverdate($this->dateworkto, $this->lang)."'";
			}
		}
		if($this->isStaffOff==1)  $strCondi=$strCondi." AND year(lv044)<2014 ";
		return $strCondi;

	}
	function GetConditionRptChild()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv009!="")  $strCondi=$strCondi." and A.lv009 in ('".str_replace(",","','",$this->lv009)."')";
		if($this->lv304!="")  $strCondi=$strCondi." and ABC.lv004 in ('".str_replace(",","','",$this->lv304)."')";
		if($this->isPhuThuoc!="")  $strCondi=$strCondi." and ABC.lv011 ='$this->isPhuThuoc'";
		if($this->isuptoyearold!="")   $strCondi=$strCondi." and (((year(CURRENT_DATE())-year(ABC.lv005))*12+month(CURRENT_DATE())-month(ABC.lv005))/12) <='$this->isuptoyearold'";
		if($this->lv026!="") $strCondi=$strCondi." and A.lv026 ='$this->lv026'";
		if($this->lv018!="") $strCondi=$strCondi." and A.lv018 ='$this->lv018'";
		if($this->lv028!="")  
		{
			$strCondi=$strCondi." and A.lv028 in ('".str_replace(",","','",$this->lv028)."')";
		}
		if($this->lv029!="")  
		{
			$strCondi=$strCondi." and A.lv029 in (".$this->LV_GetDep($this->lv029).")";
		}
		if($this->lv042!="")  
		{
			$strCondi=$strCondi." and A.lv042 in ('".str_replace(",","','",$this->lv042)."')";
		}
		if($this->isWork==4)
		{
			$vListEmp=$this->LV_GetEmpDependence();
			if($vListEmp!="") $strCondi=$strCondi." and A.lv001  in ($vListEmp)";
		}
		elseif($this->isWork==3)
		{
			$vListEmp=$this->LV_GetEmpReminder();
			if($vListEmp!="") $strCondi=$strCondi." and A.lv001  in ($vListEmp)";
		}
		else if($this->isWork==2)
		{
			if($this->dateworkfrom!="")
			{
				$vYeraN=getyear(recoverdate($this->dateworkfrom, $this->lang));
				$strCondi=$strCondi." and replace(A.lv015,year(A.lv015),'$vYeraN')>= '".str_replace("/","-",recoverdate($this->dateworkfrom, $this->lang))."'";
			}
			if($this->dateworkto!="")
			{
				$vYeraN=getyear(recoverdate($this->dateworkto, $this->lang));
				$strCondi=$strCondi." and replace(A.lv015,year(A.lv015),'$vYeraN')<= '".str_replace("/","-",recoverdate($this->dateworkto, $this->lang))."'";
			}
		}
		elseif($this->isWork==1)
		{
			if($this->dateworkfrom!="")
			{
				$strCondi=$strCondi." and A.lv044>= '".recoverdate($this->dateworkfrom, $this->lang)."'";
			}
			if($this->dateworkto!="")
			{
				$strCondi=$strCondi." and A.lv044<= '".recoverdate($this->dateworkto, $this->lang)."'";
			}
		}
		elseif($this->isWork==5)
		{
			if($this->dateworkfrom!="")
			{
				$strCondi=$strCondi." and ABC.lv005>= '".recoverdate($this->dateworkfrom, $this->lang)."'";
			}
			if($this->dateworkto!="")
			{
				$strCondi=$strCondi." and ABC.lv005<= '".recoverdate($this->dateworkto, $this->lang)."'";
			}
		}
		if($this->isStaffOff==1)  $strCondi=$strCondi." AND year(A.lv044)<2014 ";
		return $strCondi;

	}
	function LV_GetEmpDependence()
	{
		$this->ArrEmpDependence=Array();
		if($this->dateworkfrom!="")
			{
				$strCondi=$strCondi." and BB.lv013>= '".recoverdate($this->dateworkfrom, $this->lang)."'";
			}
			if($this->dateworkto!="")
			{
				$strCondi=$strCondi." and BB.lv013<= '".recoverdate($this->dateworkto, $this->lang)."'";
			}
		$slq="select BB.* from hr_lv0026 BB  where BB.lv011=1 $strCondi ";
		$vResult=db_query($slq);
		$lv_str="";
		$j=0;
		while($vrow=db_fetch_array($vResult))
		{
			$j++;
			$this->ArrEmpDependence[$vrow['lv002']][$vrow['lv001']]['lv003']=$vrow['lv003'];
			$this->ArrEmpDependence[$vrow['lv002']][$vrow['lv001']]['lv004']=$vrow['lv004'];
			$this->ArrEmpDependence[$vrow['lv002']][$vrow['lv001']]['lv005']=$vrow['lv005'];
			$this->ArrEmpDependence[$vrow['lv002']][$vrow['lv001']]['lv006']=$vrow['lv006'];
			$this->ArrEmpDependence[$vrow['lv002']][$vrow['lv001']]['lv012']=$vrow['lv012'];
			$this->ArrEmpDependence[$vrow['lv002']][$vrow['lv001']]['lv013']=$vrow['lv013'];
			
			if($lv_str=="")
				$lv_str=$vrow['lv002'];
			else
				$lv_str=$lv_str."','".$vrow['lv002'];
		}
		$lv_str="'".$lv_str."'";
		return $lv_str;
	}
	function LV_GetEmpReminder()
	{
		$this->ArrEmpReminder=Array();
		if($this->dateworkfrom!="")
			{
				$strCondi=$strCondi." and BB.lv006>= '".recoverdate($this->dateworkfrom, $this->lang)."'";
			}
			if($this->dateworkto!="")
			{
				$strCondi=$strCondi." and BB.lv006<= '".recoverdate($this->dateworkto, $this->lang)."'";
			}
		$slq="select BB.*,CC.lv002 RateName from hr_lv0036 BB inner join hr_lv0035 CC on BB.lv004=CC.lv001 where 1=1 $strCondi ";
		$vResult=db_query($slq);
		$lv_str="";
		$j=0;
		while($vrow=db_fetch_array($vResult))
		{
			$j++;
			$this->ArrEmpReminder[$vrow['lv002']][$vrow['lv001']]['lv003']=$vrow['lv003'];
			$this->ArrEmpReminder[$vrow['lv002']][$vrow['lv001']]['lv004']=$vrow['lv004'];
			$this->ArrEmpReminder[$vrow['lv002']][$vrow['lv001']]['lv005']=$vrow['lv005'];
			$this->ArrEmpReminder[$vrow['lv002']][$vrow['lv001']]['lv006']=$vrow['lv006'];
			$this->ArrEmpReminder[$vrow['lv002']][$vrow['lv001']]['RateName']=$vrow['RateName'];
			
			if($lv_str=="")
				$lv_str=$vrow['lv002'];
			else
				$lv_str=$lv_str."','".$vrow['lv002'];
		}
		$lv_str="'".$lv_str."'";
		return $lv_str;
	}
	function LV_GetDependence($vEmpID)
	{
		if($this->ArrEmpDependence[$vEmpID]==NULL) return;
		foreach($this->ArrEmpDependence[$vEmpID] as $vRate)
		{
			//print_r($vRateEmp);
			//foreach($vRateEmp as $vRate)
			{
				if($vStrReturn=="")
					$vStrReturn= "[".$vRate['lv003']."]".$vRate['lv004']." - ".$this->FormatView($vRate['lv013'],2);
				else
				$vStrReturn=$vStrReturn." | ".$vRate['lv003']."]".$vRate['lv004']." - ".$this->FormatView($vRate['lv013'],2);
			}
		}
		return $vStrReturn;
	}
	function LV_GetDanhGia($vEmpID)
	{
		if($this->ArrEmpReminder[$vEmpID]==NULL) return;
		foreach($this->ArrEmpReminder[$vEmpID] as $vRate)
		{
			//print_r($vRateEmp);
			//foreach($vRateEmp as $vRate)
			{
				if($vStrReturn=="")
					$vStrReturn= "[".$vRate['lv004']."]".$vRate['lv005']." - ".$this->FormatView($vRate['lv006'],2);
				else
				$vStrReturn=$vStrReturn." | [".$vRate['lv004']."]".$vRate['lv005']." - ".$this->FormatView($vRate['lv006'],2);
			}
		}
		return $vStrReturn;
	}
	function GetContractLaborRpt()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and lv001  = '$this->lv001'";
		if($this->lv009!="")  $strCondi=$strCondi." and lv009 in ('".str_replace(",","','",$this->lv009)."')";
		if($this->isStaffOff==1)  $strCondi=$strCondi." AND year(lv044)<2014 ";
		if($this->lv028!="")  
		{
			$strCondi=$strCondi." and lv028 in ('".str_replace(",","','",$this->lv028)."')";
		}
		if($this->lv029!="")  
		{
			$strCondi=$strCondi." and lv029 in (".$this->LV_GetDep($this->lv029).")";
		}
		if($this->isType==0)
			$vListEMP=$this->LV_GetEmpExpire();
		if($this->isType==2)
			$vListEMP=$this->LV_GetEmpExpireFull();
		else
			$vListEMP=$this->LV_GetEmpChangeContract();
		if( $vListEMP!='' && $vListEMP!=NULL) $strCondi=$strCondi." and lv001 in ($vListEMP)";
		return $strCondi;
		
	}
	function LV_GetEmpExpireFull()
	{
		if($this->dateworkfrom!="")
			{
				//$strCondi=$strCondi." and B.lv005>= '".recoverdate($this->dateworkfrom, $this->lang)."'";
				$strCondi1=$strCondi1." and BB.lv005>= '".recoverdate($this->dateworkfrom, $this->lang)."'";
			}
			if($this->dateworkto!="")
			{
				$strCondi1=$strCondi1." and BB.lv005<= '".recoverdate($this->dateworkto, $this->lang)."'";
				//$strCondi1=$strCondi1." and BB.lv004>= '".recoverdate($this->dateworkto, $this->lang)."'";
			}
		if($strCondi1=="") return "";
		$slq="select * from (select A.lv001,A.lv002,A.lv003,A.lv004,(select count(*) from hr_lv0038 BB where BB.lv002=A.lv001 $strCondi1) OverMore from hr_lv0020 A inner join hr_lv0038 B on A.lv001=B.lv002  where  1=1 $strCondi  and B.lv009>=1  and  A.lv009 not in (2,3,7)) MP where MP.OverMore>0";
		$vResult=db_query($slq);
		$lv_str="";
		while($vrow=db_fetch_array($vResult))
		{
			if($lv_str=="")
				$lv_str=$vrow['lv001'];
			else
				$lv_str=$lv_str."','".$vrow['lv001'];
		}
		$lv_str="'".$lv_str."'";
		return $lv_str;
	}
	function LV_GetEmpExpire()
	{
		if($this->dateworkfrom!="")
			{
				$strCondi=$strCondi." and B.lv005>= '".recoverdate($this->dateworkfrom, $this->lang)."'";
				$strCondi1=$strCondi1." and BB.lv004>= '".recoverdate($this->dateworkfrom, $this->lang)."'";
			}
			if($this->dateworkto!="")
			{
				$strCondi=$strCondi." and B.lv005<= '".recoverdate($this->dateworkto, $this->lang)."'";
				//$strCondi1=$strCondi1." and BB.lv004>= '".recoverdate($this->dateworkto, $this->lang)."'";
			}
		if($strCondi1=="") return "";
		$slq="select * from (select A.lv001,A.lv002,A.lv003,A.lv004,(select count(*) from hr_lv0038 BB where BB.lv002=A.lv001 $strCondi1) OverMore from hr_lv0020 A inner join hr_lv0038 B on A.lv001=B.lv002  where  1=1 $strCondi  and B.lv009>=1  and  A.lv009 not in (2,3,7)) MP where MP.OverMore=0";
		$vResult=db_query($slq);
		$lv_str="";
		while($vrow=db_fetch_array($vResult))
		{
			if($lv_str=="")
				$lv_str=$vrow['lv001'];
			else
				$lv_str=$lv_str."','".$vrow['lv001'];
		}
		$lv_str="'".$lv_str."'";
		return $lv_str;
	}
	function LV_GetEmpChangeContract()
	{
		if($this->dateworkfrom!="")
			{
				$strCondi=$strCondi." and B.lv004>= '".recoverdate($this->dateworkfrom, $this->lang)."'";
				//$strCondi1=$strCondi1." and BB.lv004>= '".recoverdate($this->dateworkfrom, $this->lang)."'";
			}
			if($this->dateworkto!="")
			{
				$strCondi=$strCondi." and B.lv004<= '".recoverdate($this->dateworkto, $this->lang)."'";
				//$strCondi1=$strCondi1." and BB.lv004>= '".recoverdate($this->dateworkto, $this->lang)."'";
			}
		$slq="select * from (select A.lv001,A.lv002,A.lv003,A.lv004 from hr_lv0020 A inner join hr_lv0038 B on A.lv001=B.lv002  where  1=1 $strCondi    and  A.lv009 not in (2,3,7)) MP ";
		$vResult=db_query($slq);
		$lv_str="";
		while($vrow=db_fetch_array($vResult))
		{
			if($lv_str=="")
				$lv_str=$vrow['lv001'];
			else
				$lv_str=$lv_str."','".$vrow['lv001'];
		}
		$lv_str="'".$lv_str."'";
		return $lv_str;
	}
	function LV_GetNVNghi($vDeptID,$vYear,$vMonth)
	{
		$vTimeCalID=$this->LV_GetTimeCal($vYear,$vMonth);
		$vListDep=$this->LV_GetDep($vDeptID);
		if($this->isStaffOff==1)
			$vsql="select (select count(*) from hr_lv0020 A inner join tc_lv0064 AA on AA.lv003=A.lv001 and AA.lv002='$vTimeCalID' where A.lv009 not in (7) AND  Year(A.lv030)='$vYear' and Month(A.lv030)='$vMonth' and AA.lv004 in (".$vListDep.")) vao,(select count(*) from hr_lv0020 A inner join tc_lv0064 AA on AA.lv003=A.lv001 and AA.lv002='$vTimeCalID' where  Year(A.lv044)='$vYear' and Month(A.lv044)='$vMonth' and AA.lv004 in (".$vListDep.")) nghi";
		else
			$vsql="select (select count(*) from hr_lv0020 A inner join tc_lv0064 AA on AA.lv003=A.lv001 and AA.lv002='$vTimeCalID' where A.lv009 not in (7) AND  Year(A.lv030)='$vYear' and Month(A.lv030)='$vMonth' and AA.lv004 in (".$vListDep.")) vao,(select count(*) from hr_lv0020 A inner join tc_lv0064 AA on AA.lv003=A.lv001 and AA.lv002='$vTimeCalID' where A.lv009 in (2,3) and  Year(A.lv044)='$vYear' and Month(A.lv044)='$vMonth' and AA.lv004 in (".$vListDep.")) nghi";
		$vResult=db_query($vsql);
		return $vrow=db_fetch_array($vResult);
	}
	function LV_GetTimeCal($vYear,$vMonth)
	{
		$vMonth=(int)$vMonth;
		if($this->ArrTimeCal["$vYear-$vMonth"][0]==true) return $this->ArrTimeCal["$vYear-$vMonth"][1];
		$vsql="select lv001 from tc_lv0013 A where A.lv006='$vMonth' AND  A.lv007='$vYear'";
		$vResult=db_query($vsql);
		$vrow=db_fetch_array($vResult);
		$this->ArrTimeCal["$vYear-$vMonth"][1]=$vrow['lv001'];
		$this->ArrTimeCal["$vYear-$vMonth"][0]=true;
		return $this->ArrTimeCal["$vYear-$vMonth"][1];
	}
	function LV_GetNumDeptMonthsHopDong($vYear,$vMonth)
	{
		$vArrContract=Array();
		$vTimeCalID=$this->LV_GetTimeCal($vYear,$vMonth);
		$vDateCheckIn=$vYear."-".$vMonth."-01";//.GetDayInMonth($vYear,$vMonth);
		$vDateCheckOut=$vYear."-".$vMonth."-".GetDayInMonth($vYear,$vMonth);
		//echo $vsql="select count(*) from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 in (2,3) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') ) GROUP BY A.lv029,A.lv018";
		//echo "<br/>";
		if($this->isStaffOff==1)
		{
			$vsql="select * from (select AA.lv004 lv029,A.lv009,A.lv044,A.lv001 EmpID from hr_lv0020 A inner join tc_lv0064 AA on AA.lv003=A.lv001 and AA.lv002='$vTimeCalID' inner join hr_lv0002 B on AA.lv004=B.lv001 where ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 not in (7) and YEAR(A.lv030)='$vYear' and Month(A.lv030)='$vMonth') or (A.lv009 not in (7) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') )) MP where (not ( YEAR(MP.lv044)='$vYear' and Month(MP.lv044)='$vMonth') and not ( YEAR(MP.lv044)>1900 and MP.lv009 not in(2,3,7) and MP.lv044<'$vDateCheckOut' )) ";
			
		}
			
		else
			$vsql="select * from (select AA.lv004 lv029,A.lv009,A.lv044,A.lv001 EmpID from hr_lv0020 A inner join tc_lv0064 AA on AA.lv003=A.lv001 and AA.lv002='$vTimeCalID' inner join hr_lv0002 B on AA.lv004=B.lv001 where ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 not in (7) and YEAR(A.lv030)='$vYear' and Month(A.lv030)='$vMonth') or (A.lv009 not in (7) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') )) MP where not (MP.lv009 in (2,3,7) and YEAR(MP.lv044)='$vYear' and Month(MP.lv044)='$vMonth')) ";
		//$vsql="select AA.lv004 lv029,A.lv018,A.lv001 EmpID from hr_lv0020 A inner join tc_lv0064 AA on AA.lv003=A.lv001 and AA.lv002='$vTimeCalID' inner join hr_lv0002 B on AA.lv004=B.lv001 where 1=1 AND ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 not in (7) and YEAR(A.lv030)='$vYear' and Month(A.lv030)='$vMonth') or (A.lv009 not in (7) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') ) ";
		$vResult=db_query($vsql);
		while($vrow=db_fetch_array($vResult))
		{
			if($vListDept=="")
				$vListDept="'".$vrow['lv029']."'";
			else
				$vListDept=$vListDept.",'".$vrow['lv029']."'";
			$vType=$this->LV_LoadTypeHDMonth($vrow['EmpID'],$vMonth,$vYear);
			$vArrContract[$vType]=$vArrContract[$vType]+1;
		}
		return $vArrContract;
	}
	function LV_LoadTypeHDMonth($vEmpID,$sMonth,$sYear)
	{
		$vMinDate='2015-01-01';
		$vMaxDate=$this->DateCurrent;
		$cM=getmonth($vMaxDate);
		$cY=getyear($vMaxDate);
		$vArrContractBuild=Array();
		
		$lvsql="
		SELECT MP.* FROM (
			select IF(A.lv100=1,CURDATE(),A.lv004) DateS,A.lv100 IsActive,ADDDATE(A.lv005,1) DateE,A.lv001,A.lv003,A.lv004,A.lv005,A.lv009,A.lv010,A.lv021,A.lv022,A.lv023,A.lv024,A.lv025,A.lv027,A.lv028 from hr_lv0038 A where A.lv003<>'9' and A.lv002='".$vEmpID."' $vCondition
			UNION
			select B.lv004 DateS,A.lv100 IsActive,ADDDATE(A.lv005,1) DateE,A.lv001,A.lv003,A.lv004,A.lv005,A.lv009,IF(B.lv003='DOICVPB' OR B.lv003='DOIPHONGBAN',B.lv006,A.lv010) lv010,A.lv021,A.lv022,A.lv023,A.lv024,A.lv025,B.lv010 lv027,B.lv011 lv028 from hr_lv0038 A inner join hr_lv0098 B on B.lv099=A.lv001 where A.lv003<>'9' and  A.lv002='".$vEmpID."' $vCondition
		) MP order by MP.DateS ASC";
		$vresult=db_query($lvsql);
		$vArrContractSave=Array();
		$vPre=0;
		$isFirst=false;
		$vCodeFirst='';
		$vArrHD=Array();
		$vACot3=Array();
		$vACot7=Array();
		$vContractID='';
		while($vrow=db_fetch_array($vresult))
		{
			if($vrow['lv009']==1) $vContractIDNo=$vrow['lv003'];
			if($vrow['IsActive']==1 && $vArrHD[0]!=$vrow['lv001'] )
			{
				if($vArrHD!=NULL)
				{
					if($vArrHD[1]<$vrow['DateS'])
					{
						$vdatefrom=$vArrHD[1];
					}
					else
						$vdatefrom=$vrow['DateS'];
				}
				else
				{
					if($vMinDate>$vrow['lv004'])
						$vdatefrom=$vMinDate;
					else
						$vdatefrom=$vrow['lv004'];
				}
			}
			else
			{
				if($vMinDate>$vrow['DateS'])
				{
					$vdatefrom=$vMinDate;
				}
				else
					$vdatefrom=$vrow['DateS'];
			}
			$vArrHD[0]=$vrow['lv001'];
			$vArrHD[1]=$vrow['DateE'];
			$vYearS=getyear($vdatefrom);
			$vYearE=getyear($vMaxDate);
			$vYMin=getyear($vMinDate);
			if($vYearS<$vYMin) $vYearS=$vYMin;
			for($y=$vYearS;$y<=$vYearE;$y++)
			{
				if($y==$vYearS)
				{
					$vMonthS=(int)getmonth($vdatefrom);
				}
				else
					$vMonthS=1;
				if($y==$cY) 
					$vMonthE=$cM;
				else 
					$vMonthE=12;
				for($m=$vMonthS;$m<=$vMonthE;$m++)
				{
					if($sMonth==$m && $y==$sYear)
					{
						$vContractID=$vrow['lv003'];
					}
					
				}
		
			}			
			
		}
		if($vContractID=='') $vContractID=$vContractIDNo;
		return $vContractID;
	}
	function LV_GetNumDeptMonthsTrinhDo($vYear,$vMonth,$vTrinhDo)
	{
		$vTimeCalID=$this->LV_GetTimeCal($vYear,$vMonth);
		$vDateCheckIn=$vYear."-".$vMonth."-01";//.GetDayInMonth($vYear,$vMonth);
		$vDateCheckOut=$vYear."-".$vMonth."-".GetDayInMonth($vYear,$vMonth);
		if($this->ArrDeptMonths[$vYear."-".$vMonth][0][0][0]==true) return ;
		$this->ArrDeptMonths[$vYear."-".$vMonth][0][0][0]=true;
		//echo $vsql="select count(*) from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 in (2,3) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') ) GROUP BY A.lv029,A.lv018";
		//echo "<br/>";
		if($this->isStaffOff==1)
		{
			$vsql="select MP.lv029,MP.lv018,MP.lv002,count(MP.MaNV) NumDept,MP.lv001,MP.lv002 from (select A.lv044,A.lv009,AA.lv004 lv029,A.lv018,A.lv002 TenNV,A.lv001 MaNV,B.lv001,B.lv002 from hr_lv0020 A inner join tc_lv0064 AA on AA.lv003=A.lv001 and AA.lv002='$vTimeCalID' inner join hr_lv0002 B on AA.lv004=B.lv001 where  A.lv028 in ($vTrinhDo) AND ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 not in (7) and YEAR(A.lv030)='$vYear' and Month(A.lv030)='$vMonth') or (A.lv009 not in (7) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') )) MP where (not ( YEAR(MP.lv044)='$vYear' and Month(MP.lv044)='$vMonth') and not ( YEAR(MP.lv044)>1900 and MP.lv009 not in(2,3,7) and MP.lv044<'$vDateCheckOut' ) ) GROUP BY MP.lv029,MP.lv018";
			/*if($vMonth==1)
				$vsql="select MP.lv029,MP.lv018,MP.lv002,count(MP.MaNV) NumDept,MP.lv001,MP.lv002 from (select A.lv044,A.lv009,A.lv029,A.lv018,A.lv002 TenNV,A.lv001 MaNV,B.lv001,B.lv002 from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where A.lv028 in ($vTrinhDo) AND ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 not in (7) and YEAR(A.lv030)='$vYear' and Month(A.lv030)='$vMonth') or (A.lv009 not in (7) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') )) MP where (not ( YEAR(MP.lv044)='$vYear' and Month(MP.lv044)='$vMonth') and not ( YEAR(MP.lv044)='".($vYear-1)."' and Month(MP.lv044)='12')) GROUP BY MP.lv029,MP.lv018";
			else
				$vsql="select MP.lv029,MP.lv018,MP.lv002,count(MP.MaNV) NumDept,MP.lv001,MP.lv002 from (select A.lv044,A.lv009,A.lv029,A.lv018,A.lv002 TenNV,A.lv001 MaNV,B.lv001,B.lv002 from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where A.lv028 in ($vTrinhDo) AND ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 not in (7) and YEAR(A.lv030)='$vYear' and Month(A.lv030)='$vMonth') or (A.lv009 not in (7) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') )) MP where (not ( YEAR(MP.lv044)='$vYear' and Month(MP.lv044)='$vMonth') and not ( YEAR(MP.lv044)='$vYear' and Month(MP.lv044)='".($vMonth-1)."')) GROUP BY MP.lv029,MP.lv018";
			*/
		}
			
		else
			$vsql="select MP.lv029,MP.lv018,MP.lv002,count(MP.MaNV) NumDept,MP.lv001,MP.lv002 from (select A.lv044,A.lv009,AA.lv004 lv029,A.lv018,A.lv002 TenNV,A.lv001 MaNV,B.lv001,B.lv002 from hr_lv0020 A inner join tc_lv0064 AA on AA.lv003=A.lv001 and AA.lv002='$vTimeCalID' inner join hr_lv0002 B on AA.lv004=B.lv001 where  A.lv028 in ($vTrinhDo) AND ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 not in (7) and YEAR(A.lv030)='$vYear' and Month(A.lv030)='$vMonth') or (A.lv009 not in (7) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') )) MP where not (MP.lv009 in (2,3,7) and YEAR(MP.lv044)='$vYear' and Month(MP.lv044)='$vMonth') GROUP BY MP.lv029,MP.lv018";
		
		//$vsql="select AA.lv004 lv029,A.lv018,A.lv002,count(A.lv001) NumDept,B.lv001,B.lv002 from hr_lv0020 A inner join tc_lv0064 AA on AA.lv003=A.lv001 and AA.lv002='$vTimeCalID' inner join hr_lv0002 B on AA.lv004=B.lv001 where A.lv028 in ($vTrinhDo) AND ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 not in (7) and YEAR(A.lv030)='$vYear' and Month(A.lv030)='$vMonth') or (A.lv009 not in (7) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') ) GROUP BY A.lv029,A.lv018";
		$vResult=db_query($vsql);
		while($vrow=db_fetch_array($vResult))
		{
			if($vListDept=="")
				$vListDept="'".$vrow['lv029']."'";
			else
				$vListDept=$vListDept.",'".$vrow['lv029']."'";
			$this->ArrDeptMonths[$vYear."-".$vMonth][$vrow['lv029']][$vrow['lv018']]=$vrow['NumDept'];//OK
			//Cau truc
			$this->ArrDeptMonths[$vYear."-".$vMonth][$vrow['lv002']][$vrow['lv029']]=$vrow['lv001'];
		}
		if($vListDept=="") $vListDept="''";
		$vsql="select * from hr_lv0002 where lv001 not in ($vListDept)";
		$vResult=db_query($vsql);
		while($vrow=db_fetch_array($vResult))
		{
			//echo $vYear."-".$vMonth."][".$vrow['lv002']."][".$vrow['lv001']."<br/>";
			$this->ArrDeptMonths[$vYear."-".$vMonth][$vrow['lv002']][$vrow['lv001']]=$vrow['lv001'];
		}
	}
	function LV_GetNumContactMonths($vYear,$vMonth)
	{
		$vContractArr=Array();
		$vDateCheckIn=$vYear."-".$vMonth."-01";//.GetDayInMonth($vYear,$vMonth);
		$vDateCheckOut=$vYear."-".$vMonth."-".GetDayInMonth($vYear,$vMonth);
		$vsql="select MP.TypeContract CodeID,count(MP.TypeContract) Nums from (select (select AA.lv003 from hr_lv0038 AA where AA.lv003<>9 and AA.lv002=A.lv001 order by A.lv004 DESC limit 0,1) TypeContract from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 not in (7) and YEAR(A.lv030)='$vYear' and Month(A.lv030)='$vMonth') or (A.lv009 not in (7) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') )) MP  group by MP.TypeContract";
		$vResult=db_query($vsql);
		while($vrow=db_fetch_array($vResult))
		{
			$vContractArr[$vrow['CodeID']]=$vrow['Nums'];
		}
		return $vContractArr;
	}
	function LV_GetNumDeptMonths($vYear,$vMonth)
	{
		$vTimeCalID=$this->LV_GetTimeCal($vYear,$vMonth);
		$vDateCheckIn=$vYear."-".$vMonth."-01";//.GetDayInMonth($vYear,$vMonth);
		$vDateCheckOut=$vYear."-".$vMonth."-".GetDayInMonth($vYear,$vMonth);
		if($this->ArrDeptMonths[$vYear."-".$vMonth][0][0][0]==true) return ;
		$this->ArrDeptMonths[$vYear."-".$vMonth][0][0][0]=true;
		//echo $vsql="select count(*) from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 in (2,3) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') ) GROUP BY A.lv029,A.lv018";
		//echo "<br/>";
		if($this->isStaffOff==1)
		{
			$vsql="select MP.lv029,MP.lv018,MP.lv002,count(MP.MaNV) NumDept,MP.lv001,MP.lv002 from (select A.lv044,A.lv009,AA.lv004 lv029,A.lv018,A.lv002 TenNV,A.lv001 MaNV,B.lv001,B.lv002 from hr_lv0020 A inner join tc_lv0064 AA on AA.lv003=A.lv001 and AA.lv002='$vTimeCalID' inner join hr_lv0002 B on AA.lv004=B.lv001 where ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 not in (7) and YEAR(A.lv030)='$vYear' and Month(A.lv030)='$vMonth') or (A.lv009 not in (7) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') )) MP where (not ( YEAR(MP.lv044)='$vYear' and Month(MP.lv044)='$vMonth') and not ( YEAR(MP.lv044)>1900 and MP.lv009 not in(2,3,7) and MP.lv044<'$vDateCheckOut' ) ) GROUP BY MP.lv029,MP.lv018";
			/*if($vMonth==1)
				$vsql="select MP.lv029,MP.lv018,MP.lv002,count(MP.MaNV) NumDept,MP.lv001,MP.lv002 from (select A.lv044,A.lv009,A.lv029,A.lv018,A.lv002 TenNV,A.lv001 MaNV,B.lv001,B.lv002 from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 not in (7) and YEAR(A.lv030)='$vYear' and Month(A.lv030)='$vMonth') or (A.lv009 not in (7) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') )) MP where (not ( YEAR(MP.lv044)='$vYear' and Month(MP.lv044)='$vMonth') and not ( YEAR(MP.lv044)='".($vYear-1)."' and Month(MP.lv044)='12')) GROUP BY MP.lv029,MP.lv018";
			else
				$vsql="select MP.lv029,MP.lv018,MP.lv002,count(MP.MaNV) NumDept,MP.lv001,MP.lv002 from (select A.lv044,A.lv009,A.lv029,A.lv018,A.lv002 TenNV,A.lv001 MaNV,B.lv001,B.lv002 from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 not in (7) and YEAR(A.lv030)='$vYear' and Month(A.lv030)='$vMonth') or (A.lv009 not in (7) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') )) MP where (not ( YEAR(MP.lv044)='$vYear' and Month(MP.lv044)='$vMonth') and not ( YEAR(MP.lv044)='$vYear' and Month(MP.lv044)='".($vMonth-1)."')) GROUP BY MP.lv029,MP.lv018";
			*/
		}
			
		else
			$vsql="select MP.lv029,MP.lv018,MP.lv002,count(MP.MaNV) NumDept,MP.lv001,MP.lv002 from (select A.lv044,A.lv009,AA.lv004 lv029,A.lv018,A.lv002 TenNV,A.lv001 MaNV,B.lv001,B.lv002 from hr_lv0020 A inner join tc_lv0064 AA on AA.lv003=A.lv001 and AA.lv002='$vTimeCalID' inner join hr_lv0002 B on AA.lv004=B.lv001 where ((A.lv009 not in(2,3,7) and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckIn' and A.lv030<='$vDateCheckIn') or (A.lv009 not in (7) and YEAR(A.lv030)='$vYear' and Month(A.lv030)='$vMonth') or (A.lv009 not in (7) and YEAR(A.lv044)='$vYear' and Month(A.lv044)='$vMonth') or (A.lv009 in (2,3) and A.lv044>='$vDateCheckOut'  and A.lv030<='$vDateCheckOut') or (A.lv009 in (2,3) and A.lv030<='$vDateCheckOut' and A.lv044>='$vDateCheckIn') )) MP where not (MP.lv009 in (2,3,7) and YEAR(MP.lv044)='$vYear' and Month(MP.lv044)='$vMonth') GROUP BY MP.lv029,MP.lv018";
		$vResult=db_query($vsql);
		while($vrow=db_fetch_array($vResult))
		{
			if($vListDept=="")
				$vListDept="'".$vrow['lv029']."'";
			else
				$vListDept=$vListDept.",'".$vrow['lv029']."'";
			$this->ArrDeptMonths[$vYear."-".$vMonth][$vrow['lv029']][$vrow['lv018']]=$vrow['NumDept'];//OK
			//Cau truc
			$this->ArrDeptMonths[$vYear."-".$vMonth][$vrow['lv002']][$vrow['lv029']]=$vrow['lv001'];
		}
		if($vListDept=="") $vListDept="''";
		$vsql="select * from hr_lv0002 where lv001 not in ($vListDept)";
		$vResult=db_query($vsql);
		while($vrow=db_fetch_array($vResult))
		{
			//echo $vYear."-".$vMonth."][".$vrow['lv002']."][".$vrow['lv001']."<br/>";
			$this->ArrDeptMonths[$vYear."-".$vMonth][$vrow['lv002']][$vrow['lv001']]=$vrow['lv001'];
		}
	}
	function LV_GetNumDeptCurrent()
	{
		if($this->ArrDeptCurrent[0][0][0]==true) return ;
		$this->ArrDeptCurrent[0][0][0]=true;
		if($this->isStaffOff==1)
			$vsql="select A.lv029,A.lv018,A.lv002,count(A.lv001) NumDept,B.lv001,B.lv002 from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where A.lv009 not in (2,3,7) and (  YEAR(A.lv044) <=1900)    GROUP BY A.lv029,A.lv018";
		else
			$vsql="select A.lv029,A.lv018,A.lv002,count(A.lv001) NumDept,B.lv001,B.lv002 from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where A.lv009 not in (2,3,7) GROUP BY A.lv029,A.lv018";
		$vResult=db_query($vsql);
		while($vrow=db_fetch_array($vResult))
		{
			if($vListDept=="")
				$vListDept="'".$vrow['lv029']."'";
			else
				$vListDept=$vListDept.",'".$vrow['lv029']."'";
			$this->ArrDeptCurrent[$vrow['lv029']][$vrow['lv018']]=$vrow['NumDept'];//OK
			//Cau truc
			$this->ArrDeptCurrent[$vrow['lv002']][$vrow['lv029']]=$vrow['lv001'];
		}
		if($vListDept=="") $vListDept="''";
		$vsql="select * from hr_lv0002 where lv001 not in ($vListDept)";
		$vResult=db_query($vsql);
		while($vrow=db_fetch_array($vResult))
		{
			$this->ArrDeptCurrent[$vrow['lv002']][$vrow['lv001']]=$vrow['lv001'];
		}
	}
	function LV_CheckChild($vDeptID)
	{
		if($this->ArrDeptCurrent[$vDeptID]==null) return;
		foreach($this->ArrDeptCurrent[$vDeptID] as $vrow)
		{
			if(!is_numeric($vrow))
			{
					return true;
			}
		}
		return false;
	}
	function LV_GetNumberDeptChild($vDeptID,&$vNu=0)
	{
		$vNu=0;
		if($this->ArrDeptCurrent[$vDeptID]==null) return 0;
		$vCount=(int)$this->ArrDeptCurrent[$vDeptID][0]+(int)$this->ArrDeptCurrent[$vDeptID][1];
		$vNu=(int)$this->ArrDeptCurrent[$vDeptID][0];
		foreach($this->ArrDeptCurrent[$vDeptID] as $vrow)
		{
			if(!is_numeric($vrow))
			{
					if($this->LV_CheckChild($vrow)) 
					{
						$vCount=$vCount+$this->LV_GetNumberDeptChild($vrow,$vGetNu);
						$vNu=$vNu+$vGetNu;
					}
					else
						if($vDeptID!=$vrow)
						{
							$vCount=$vCount+$this->ArrDeptCurrent[$vrow][0]+$this->ArrDeptCurrent[$vrow][1];
							$vNu=$vNu+$this->ArrDeptCurrent[$vrow][0];
						}
			}
		}
		return $vCount;
	}
	function LV_CheckChildMonths($vDeptID,$vYear,$vMonth)
	{
		if($this->ArrDeptMonths[$vYear."-".$vMonth][$vDeptID]==null) return false;
		foreach($this->ArrDeptMonths[$vYear."-".$vMonth][$vDeptID] as $vrow)
		{
			if(!is_numeric($vrow))
			{
					return true;
			}
		}
		return false;
	}
	function LV_GetNumberDeptChildMonth($vDeptID,$vYear,$vMonth,&$vNu=0)
	{
		$vNu=0;
		if($this->ArrDeptMonths[$vYear."-".$vMonth][$vDeptID]==null) return 0;
		$vCount=(int)$this->ArrDeptMonths[$vYear."-".$vMonth][$vDeptID][0]+(int)$this->ArrDeptMonths[$vYear."-".$vMonth][$vDeptID][1];
		$vNu=(int)$this->ArrDeptMonths[$vYear."-".$vMonth][$vDeptID][0];
		foreach($this->ArrDeptMonths[$vYear."-".$vMonth][$vDeptID] as $vrow)
		{
			if(!is_numeric($vrow))
			{
					if($this->LV_CheckChildMonths($vrow,$vYear,$vMonth)) 
					{
						$vGetNu=0;
						$vCount=$vCount+$this->LV_GetNumberDeptChildMonth($vrow,$vYear,$vMonth,$vGetNu);
						$vNu=$vNu+$vGetNu;
					}
					else
						if($vDeptID!=$vrow)
						{
							$vCount=$vCount+$this->ArrDeptMonths[$vYear."-".$vMonth][$vrow][0]+$this->ArrDeptMonths[$vYear."-".$vMonth][$vrow][1];
							$vNu=$vNu+$this->ArrDeptMonths[$vYear."-".$vMonth][$vrow][0];
						}
			}
		}
		return $vCount;
	}
	function LV_GetCompareDept($vArr,$vMonth)
	{
		$vStrReturn="";
		foreach($vArr[$vMonth] as $vValue)
		{
			if($vStrReturn=="") 
				$vStrReturn=$vValue;
			else
				$vStrReturn=$vStrReturn."/".$vValue;
		}
		return $vStrReturn;
	}
	function LV_StaffInOut($vOpt=0)
	{
		$lvTable='<table border="1" cellpadding="0" cellspacing="0" style="width: 100%;" width="1017">
	<colgroup>
		<col style="mso-width-source:userset;mso-width-alt:1462;width:30pt" width="40" />
		<col style="mso-width-source:userset;mso-width-alt:5485;width:113pt" width="150" />
		<col span="10" style="width:48pt" width="64" />
		<col style="mso-width-source:userset;mso-width-alt:4498;width:92pt" width="123" />
		<col style="width:48pt" width="64" /></colgroup>
	<tbody>
		<tr height="20" style="height:15.0pt">
			<td class="xl65" height="100" rowspan="2" style="height:75.0pt;width:30pt" width="40" align="center">STT</td>
			<td class="xl65" rowspan="2" style="width:113pt" width="150" align="center">Họ và tên</td>
			<td class="xl69" colspan="2" width="128" align="center">Giới tính</td>
			<td class="xl65" colspan="6" width="384" align="center">Trình độ chuyên môn kỹ thuật</td>
			<td class="xl65" colspan="3" width="251" align="center">Loại hợp đồng lao động</td>
			<td class="xl65" rowspan="2" width="64" align="center">Vị trì việc làm</td>
		</tr>
		<tr height="80" style="height:60.0pt">
			<td width="64" align="center">Nam</td>
			<td width="64" align="center">Nữ</td>
			<td width="64" align="center">Đại học trở lên</td>
			<td width="64" align="center">Cao đẳng/ Cao đẳng nghề</td>
			<td width="64" align="center">Trung cấp/ Trung cấp nghề</td>
			<td width="64" align="center">Sơ cấp nghề</td>
			<td width="64" align="center">Dạy nghề thường xuyên</td>
			<td width="64" align="center">Chưa qua đào tạo</td>
			<td width="64" align="center">Không xác định thời hạn</td>
			<td width="64" align="center">Xác định thời hạn</td>
			<td width="123" align="center">Theo mùa vụ hoặc theo công việc nhất định dưới 12 tháng</td>
		</tr>
		<tr height="20" style="height:15.0pt">
			<td align="center">(1)</td>
			<td align="center">(2)</td>
			<td align="center">(3)</td>
			<td align="center">4)</td>
			<td align="center">(5)</td>
			<td align="center">(6)</td>
			<td align="center">(7)</td>
			<td align="center">(8)</td>
			<td align="center">(9)</td>
			<td align="center">(10)</td>
			<td align="center">(11)</td>
			<td align="center">(12)</td>
			<td align="center">(13)</td>
			<td align="center">(14)</td>
		</tr>
		@#01
	</tbody>
</table>';
		$vTr='
		<tr>
			<td align="center">@01</td>
			<td align="left">@02</td>
			<td align="center">@03</td>
			<td align="center">@04</td>
			<td align="center">@05</td>
			<td align="center">@06</td>
			<td align="center">@07</td>
			<td align="center">@08</td>
			<td align="center">@09</td>
			<td align="center">@10</td>
			<td align="center">@11</td>
			<td align="center">@12</td>
			<td align="center">@13</td>
			<td align="center">@14</td>
		</tr>';
		if($vOpt==0)
		{
			if($this->isStaffOff==1)
				$vsql="select A.*,(select BB.lv003 from hr_lv0038 BB where A.lv001=BB.lv002 and BB.lv009=1 and BB.lv003<>9  limit 0,1) Actives from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where A.lv009 not in (2,3,7) and A.lv030>='".recoverdate($this->dateworkfrom,$this->lang)."' and A.lv030<='".recoverdate($this->dateworkto,$this->lang)."' and year(A.lv044)<2014";
			else
				$vsql="select A.*,(select BB.lv003 from hr_lv0038 BB where A.lv001=BB.lv002 and BB.lv009=1 and BB.lv003<>9  limit 0,1) Actives from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where A.lv009 not in (2,3,7) and A.lv030>='".recoverdate($this->dateworkfrom,$this->lang)."' and A.lv030<='".recoverdate($this->dateworkto,$this->lang)."'";
		}
		else
		{
			if($this->isStaffOff==1)
				$vsql="select A.*,(select BB.lv003 from hr_lv0038 BB where A.lv001=BB.lv002 and BB.lv009=1 and BB.lv003<>9 limit 0,1) Actives from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where A.lv009 in (2,3)  and A.lv044>='".recoverdate($this->dateworkfrom,$this->lang)."' and A.lv044<='".recoverdate($this->dateworkto,$this->lang)."'  and year(A.lv044)<2014";
			else
				$vsql="select A.*,(select BB.lv003 from hr_lv0038 BB where A.lv001=BB.lv002 and BB.lv009=1 and BB.lv003<>9 limit 0,1) Actives from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where A.lv009 in (2,3)  and A.lv044>='".recoverdate($this->dateworkfrom,$this->lang)."' and A.lv044<='".recoverdate($this->dateworkto,$this->lang)."'";
		}
		$bResult=db_query($vsql);
		$vOrder=1;
		while ($vrow = db_fetch_array ($bResult)){
			$vTrTemp=str_replace("@01",$vOrder,$vTr);
			$vTrTemp=str_replace("@02",$vrow['lv002'],$vTrTemp);
			$vTrTemp=str_replace("@03",($vrow['lv018']==1)?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@04",($vrow['lv018']==0)?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@05",($vrow['lv028']=='DH')?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@06",($vrow['lv028']=='CD')?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@07",($vrow['lv028']=='TC')?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@08",($vrow['lv028']=='SCN')?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@09",($vrow['lv028']=='DNTX')?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@10",($vrow['lv028']=='CQDT' || $vrow['lv028']=='')?'x':'',$vTrTemp);
			$vActives=$vrow['Actives'];
			switch($vActives)
			{
				case 3:
					$vTrTemp=str_replace("@11",'x',$vTrTemp);
					$vTrTemp=str_replace("@12",'&nbsp;',$vTrTemp);
					$vTrTemp=str_replace("@13",'&nbsp;',$vTrTemp);
					break;
				case 2:
				case 5:
				case 7:
				case 1:
				case 8:
					$vTrTemp=str_replace("@11",'&nbsp;',$vTrTemp);
					$vTrTemp=str_replace("@12",'x',$vTrTemp);
					$vTrTemp=str_replace("@13",'&nbsp;',$vTrTemp);
					break;
				default:
					$vTrTemp=str_replace("@11",'&nbsp;',$vTrTemp);
					$vTrTemp=str_replace("@12",'&nbsp;',$vTrTemp);
					$vTrTemp=str_replace("@13",'x',$vTrTemp);
					break;
			}
			$vTrTemp=str_replace("@14",$vrow['lv061'],$vTrTemp);
			$strTr=$strTr.$vTrTemp;
			$vOrder++;
		}
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function LV_StaffOut()
	{
		$lvTable='<table border="1" cellpadding="0" cellspacing="0" style="width: 100%;" width="1017">
	<colgroup>
		<col style="mso-width-source:userset;mso-width-alt:1462;width:30pt" width="40" />
		<col style="mso-width-source:userset;mso-width-alt:5485;width:113pt" width="150" />
		<col span="10" style="width:48pt" width="64" />
		<col style="mso-width-source:userset;mso-width-alt:4498;width:92pt" width="123" />
		<col style="width:48pt" width="64" /></colgroup>
	<tbody>
		<tr height="20" style="height:15.0pt">
			<td class="xl65" height="100" rowspan="2" style="height:75.0pt;width:30pt" width="40" align="center">STT</td>
			<td class="xl65" rowspan="2" style="width:113pt" width="150" align="center">Họ và tên</td>
			<td class="xl69" colspan="2" style="border-right:.5pt solid black;
  border-left:none;width:96pt" width="128" align="center">Giới tính</td>
			<td class="xl65" colspan="6" style="border-left:none;width:288pt" width="384" align="center">Trình độ chuyên môn kỹ thuật</td>
			<td class="xl65" colspan="3" style="border-left:none;width:188pt" width="251" align="center">Loại hợp đồng lao động</td>
			<td class="xl65" colspan="5" align="center">Lý do giảm</td>
		</tr>
		<tr height="80" style="height:60.0pt">
			<td width="64" align="center">Nam</td>
			<td width="64" align="center">Nữ</td>
			<td width="64" align="center">Đại học trở lên</td>
			<td width="64" align="center">Cao đẳng/ Cao đẳng nghề</td>
			<td width="64" align="center">Trung cấp/ Trung cấp nghề</td>
			<td width="64" align="center">Sơ cấp nghề</td>
			<td width="64" align="center">Dạy nghề thường xuyên</td>
			<td width="64" align="center">Chưa qua đào tạo</td>
			<td width="64" align="center">Không xác định thời hạn</td>
			<td width="64" align="center">Xác định thời hạn</td>
			<td width="64" align="center">Theo mùa vụ hoặc theo công việc nhất định dưới 12 tháng</td>
			<td width="64" align="center">Nghỉ hưu</td>
			<td width="64" align="center">Đơn phương chấm dứt Hợp đồng lao động/ Hợp đồng làm việc</td>
			<td width="64" align="center">Kỷ luật sa thải</td>
			<td width="64" align="center">Thỏa thuận chấm dứt</td>
			<td width="64" align="center">Lý do khác</td>
		</tr>
		<tr height="20" style="height:15.0pt">
			<td align="center">(1)</td>
			<td align="center">(2)</td>
			<td align="center">(3)</td>
			<td align="center">4)</td>
			<td align="center">(5)</td>
			<td align="center">(6)</td>
			<td align="center">(7)</td>
			<td align="center">(8)</td>
			<td align="center">(9)</td>
			<td align="center">(10)</td>
			<td align="center">(11)</td>
			<td align="center">(12)</td>
			<td align="center">(13)</td>
			<td align="center">(14)</td>
			<td align="center">(15)</td>
			<td align="center">(16)</td>
			<td align="center">(17)</td>
			<td align="center">(18)</td>
		</tr>
		@#01
	</tbody>
</table>';
		$vTr='
		<tr>
			<td align="center">@01</td>
			<td align="left">@02</td>
			<td align="center">@03</td>
			<td align="center">@04</td>
			<td align="center">@05</td>
			<td align="center">@06</td>
			<td align="center">@07</td>
			<td align="center">@08</td>
			<td align="center">@09</td>
			<td align="center">@10</td>
			<td align="center">@11</td>
			<td align="center">@12</td>
			<td align="center">@13</td>
			<td align="center">@14</td>
			<td align="center">@15</td>
			<td align="center">@16</td>
			<td align="center">@17</td>
			<td align="center">@18</td>
		</tr>';
			$vsql="select A.*,(select BB.lv003 from hr_lv0038 BB where A.lv001=BB.lv002 and BB.lv009=1 limit 0,1) Actives from hr_lv0020 A inner join hr_lv0002 B on A.lv029=B.lv001 where (A.lv009 in (2,3) OR ( Year(A.lv044)<2014 and A.lv009 not in(2,3)))  and A.lv044>='".recoverdate($this->dateworkfrom,$this->lang)."' and A.lv044<='".recoverdate($this->dateworkto,$this->lang)."'";
		$bResult=db_query($vsql);
		$vOrder=1;
		while ($vrow = db_fetch_array ($bResult)){
			$vTrTemp=str_replace("@01",$vOrder,$vTr);
			$vTrTemp=str_replace("@02",$vrow['lv002'],$vTrTemp);
			$vTrTemp=str_replace("@03",($vrow['lv018']==1)?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@04",($vrow['lv018']==0)?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@05",($vrow['lv028']=='DH')?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@06",($vrow['lv028']=='CD')?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@07",($vrow['lv028']=='TC')?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@08",($vrow['lv028']=='SCN')?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@09",($vrow['lv028']=='DNTX')?'x':'',$vTrTemp);
			$vTrTemp=str_replace("@10",($vrow['lv028']=='CQDT' || $vrow['lv028']=='')?'x':'',$vTrTemp);
			$vActives=$vrow['Actives'];
			switch($vActives)
			{
				case 3:
					$vTrTemp=str_replace("@11",'x',$vTrTemp);
					$vTrTemp=str_replace("@12",'&nbsp;',$vTrTemp);
					$vTrTemp=str_replace("@13",'&nbsp;',$vTrTemp);
					break;
				case 2:
				case 5:
				case 7:
				case 1:
				case 8:
					$vTrTemp=str_replace("@11",'&nbsp;',$vTrTemp);
					$vTrTemp=str_replace("@12",'x',$vTrTemp);
					$vTrTemp=str_replace("@13",'&nbsp;',$vTrTemp);
					break;
				default:
					$vTrTemp=str_replace("@11",'&nbsp;',$vTrTemp);
					$vTrTemp=str_replace("@12",'&nbsp;',$vTrTemp);
					$vTrTemp=str_replace("@13",'x',$vTrTemp);
					break;
			}
			$vTrTemp=str_replace("@14",'&nbsp;',$vTrTemp);
			$vTrTemp=str_replace("@15",'&nbsp;',$vTrTemp);
			$vTrTemp=str_replace("@16",'&nbsp;',$vTrTemp);
			$vTrTemp=str_replace("@17",'&nbsp;',$vTrTemp);
			$vTrTemp=str_replace("@18",'&nbsp;',$vTrTemp);
			$strTr=$strTr.$vTrTemp;
			$vOrder++;
		}
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function LV_GetContractNum($vArr,$vCode)
	{
		$vCount=0;
		$vArrCode=explode(",",$vCode);
		foreach($vArrCode as $Code)
		{
			$vCount=$vCount+(int)$vArr[$Code];
		}
		return $vCount;
	}
	function LV_StaffFirst($vYear,$vMonth)
	{
		//$vYear=getyear(recoverdate($this->dateworkfrom,$this->lang));
		if($this->lv029=="" || $this->lv029==NULL)
		{
			$vDepID='BUENO';
			$vsql="select lv001,lv003 from  hr_lv0002 where lv002='$vDepID' order by lv003";
		}
		else
		{
			$vsql="select lv001,lv003 from  hr_lv0002 where lv001 in ('".str_replace(",","','",$this->lv029)."') order by lv003";
		}
		$bResult=db_query($vsql);
		$i=1;
		/*for($jt=1;$jt<=12;$jt++)
		{
			$this->LV_GetNumDeptMonths($vYear,Fillnum($jt,2));
		}*/
		$this->LV_GetNumDeptMonths($vYear,$vMonth);
		$vTotalNV=0;
		$vTotalNV12=0;
		$vTotalNuNV12=0;
		$vIn12=0;
		$vOut12=0;
		$vOt=0;
		while ($vrow = db_fetch_array ($bResult)){
			$vrownv12=$this->LV_GetNVNghi($vrow['lv001'],$vYear,$vMonth);
			$vIn12=$vIn12+$vrownv12['vao'];
			$vOut12=$vOut12+$vrownv12['nghi'];
			$vTotalNV12=$vTotalNV12+$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,$vMonth,$vNuNV12);
			$vTotalNuNV12=$vTotalNuNV12+$vNuNV12;
		}
		$this->ArrDeptMonths=null;
		
		$this->LV_GetNumDeptMonthsTrinhDo($vYear,$vMonth,"'DH','ThS','TS'");
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vTotalNV12_DH=$vTotalNV12_DH+$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,$vMonth,$vNuNV12);
			$vTotalNuNV12_DH=$vTotalNuNV12_DH+$vNuNV12;
		}
		$this->ArrDeptMonths=null;
		$this->LV_GetNumDeptMonthsTrinhDo($vYear,$vMonth,"'CD'");
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vTotalNV12_CD=$vTotalNV12_CD+$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,$vMonth,$vNuNV12);
			$vTotalNuNV12_CD=$vTotalNuNV12_CD+$vNuNV12;
		}
		$this->ArrDeptMonths=null;
		$this->LV_GetNumDeptMonthsTrinhDo($vYear,$vMonth,"'TC'");
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vTotalNV12_TC=$vTotalNV12_TC+$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,$vMonth,$vNuNV12);
			$vTotalNuNV12_TC=$vTotalNuNV12_TC+$vNuNV12;
		}
		$this->ArrDeptMonths=null;
		$this->LV_GetNumDeptMonthsTrinhDo($vYear,$vMonth,"'SCN'");
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vTotalNV12_SCN=$vTotalNV12_SCN+$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,$vMonth,$vNuNV12);
			$vTotalNuNV12_SCN=$vTotalNuNV12_SCN+$vNuNV12;
		}
		$this->ArrDeptMonths=null;
		$this->LV_GetNumDeptMonthsTrinhDo($vYear,$vMonth,"'DNTX'");
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vTotalNV12_DNTX=$vTotalNV12_DNTX+$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,$vMonth,$vNuNV12);
			$vTotalNuNV12_DNTX=$vTotalNuNV12_DNTX+$vNuNV12;
		}
		$this->ArrDeptMonths=null;
		$this->LV_GetNumDeptMonthsTrinhDo($vYear,$vMonth,"'CQDT','PT','PTTH','D-PTTH'");
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vTotalNV12_CQDT=$vTotalNV12_CQDT+$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,$vMonth,$vNuNV12);
			$vTotalNuNV12_CQDT=$vTotalNuNV12_CQDT+$vNuNV12;
		}
		$vContractArr=$this->LV_GetNumDeptMonthsHopDong($vYear,$vMonth);//$this->LV_GetNumContactMonths($vYear,$vMonth);
		$vNumKXD=$this->LV_GetContractNum($vContractArr,'3,10');
		$vNumXD=$this->LV_GetContractNum($vContractArr,'5,2,7,1,8');
		$vNumTV=$this->LV_GetContractNum($vContractArr,'4,6');
		$lvTable='
		<table border="1" cellpadding="0" cellspacing="0" style="width: 100%;" id="tbl_staff">
	<colgroup>
		<col span="10" width="64" />
		<col width="172" />
		<col width="64" /></colgroup>
	<tbody>
		<tr height="20">
			<td height="100" rowspan="2" width="64" align="center">Tổng số</td>
			<td rowspan="2" width="64" align="center">Trong đó lao động nữ</td>
			<td colspan="6" width="384" align="center">Trình độ chuyên môn kỹ thuật</td>
			<td colspan="3" width="300" align="center">Loại hợp đồng lao động</td>
			<td rowspan="2" width="64" align="center">Ghi chú</td>
		</tr>
		<tr height="80">
			<td height="80" width="64" align="center">Đại học trở lên</td>
			<td width="64" align="center">Cao đẳng/ Cao đẳng nghề</td>
			<td width="64" align="center">Trung cấp/ Trung cấp nghề</td>
			<td width="64" align="center">Sơ cấp nghề</td>
			<td width="64" align="center">Dạy nghề thường xuyên</td>
			<td width="64" align="center">Chưa qua đào tạo</td>
			<td width="64" align="center">Không xác định thời hạn</td>
			<td width="64" align="center">Xác định thời hạn</td>
			<td width="172" align="center">Theo mùa vụ hoặc theo công việc nhất định dưới 12 tháng</td>
		</tr>
		<tr height="20">
			<td height="20">'.$this->FormatView($vTotalNV12,10).'</td>
			<td>'.$this->FormatView($vTotalNuNV12,10).'</td>
			<td>'.$this->FormatView($vTotalNV12_DH,10).'</td>
			<td>'.$this->FormatView($vTotalNV12_CD,10).'</td>
			<td>'.$this->FormatView($vTotalNV12_TC,10).'</td>
			<td>'.$this->FormatView($vTotalNV12_SCN,10).'</td>
			<td>'.$this->FormatView($vTotalNV12_DNTX,10).'</td>
			<td>'.$this->FormatView($vTotalNV12-$vTotalNV12_DH-$vTotalNV12_CD-$vTotalNV12_TC-$vTotalNV12_SCN-$vTotalNV12_DNTX,10).'</td>
			<td>'.$this->FormatView($vNumKXD,10).'</td>
			<td>'.$this->FormatView($vNumXD,10).'</td>
			<td>'.$this->FormatView($vNumTV,10).'</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>

';
		
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	
	}
	function LV_BuilListReportDeptFullInOut()
	{
	$this->LV_GetNumDeptCurrent();
	//echo "<textarea>";
	//print_r($this->ArrDeptCurrent);
	//echo "</textarea>";
	$this->isAdd=0;
	$this->isEdit=0;
	$childfunc=$_GET['childfunc'];
	$vYear=getyear(recoverdate($this->dateworkfrom,$this->lang));
	$vTable='
<div><br/><h1>'.$this->ArrPush[0].'</h1>
<center><h1>NĂM '.$vYear.'<h1/></center>
<table  style="width: 760px;"   align="center" class="tblprint" id="tabletc" border="1" cellpadding="0" cellspacing="0">
<colgroup>
<col width="6%"></col> 
<col width="6%"></col>
 <col width="12%"></col>
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 </colgroup> 
<tbody>
<tr height="21">
<td class="lvhtable" rowspan="3" height="42" >&nbsp;NO.&nbsp;</td>

<td class="lvhtable" rowspan="3">CURRENT NUM</td>
<td class="lvhtable" rowspan="3">&nbsp;DEPT.&nbsp;</td>
<td class="lvhtable" colspan="36">&nbsp;MONTHLY&nbsp;</td>
</tr>
<tr>
<td colspan="3" align=center>01</td>
<td colspan="3" align=center>02</td>
<td colspan="3" align=center>03</td>
<td colspan="3" align=center>04</td>
<td colspan="3" align=center>05</td>
<td colspan="3" align=center>06</td>
<td colspan="3" align=center>07</td>
<td colspan="3" align=center>08</td>
<td colspan="3" align=center>09</td>
<td colspan="3" align=center>10</td>
<td colspan="3" align=center>11</td>
<td colspan="3" align=center>12</td>
</tr>
<tr>
<td align=center>Total</td>
<td align=center>In</td>
<td align=center>Out</td>
<td align=center>Total</td>
<td align=center>In</td>
<td align=center>Out</td>
<td align=center>Total</td>
<td align=center>In</td>
<td align=center>Out</td>
<td align=center>Total</td>
<td align=center>In</td>
<td align=center>Out</td>
<td align=center>Total</td>
<td align=center>In</td>
<td align=center>Out</td>
<td align=center>Total</td>
<td align=center>In</td>
<td align=center>Out</td>
<td align=center>Total</td>
<td align=center>In</td>
<td align=center>Out</td>
<td align=center>Total</td>
<td align=center>In</td>
<td align=center>Out</td>
<td align=center>Total</td>
<td align=center>In</td>
<td align=center>Out</td>
<td align=center>Total</td>
<td align=center>In</td>
<td align=center>Out</td>
<td align=center>Total</td>
<td align=center>In</td>
<td align=center>Out</td>
<td align=center>Total</td>
<td align=center>In</td>
<td align=center>Out</td>
</tr>
@01
</table>
<table style="width: 760px;"   align="center" class="tblprint" id="tabletc" border="0" cellpadding="0" 
<tr height="21">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td colspan="2" height="20" align=center>Prepared   by</td>
<td align=center>Checked by</td>
<td>&nbsp;</td>
<td align=center>&nbsp;</td>
<td align=center>Approved by</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td colspan="2" height="20" align=center><input style="backround:#fff;border:0px;text-align:center" type="textbox" value="Võ Thị Ngọc Trang"/></td>
<td colspan="2" align=center><input style="backround:#fff;border:0px;text-align:center" type="textbox" value="Trần Thị Thu Thúy"/></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td colspan="2" height="20" align=center>HR   Staff</td>
<td align=center>AHR Manager</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
</center>

		';

		$vTrStr='
		<tr style="background-color:@11" height="21">
			<td style="padding:3px" align="left">@#01</td>
			<td style="padding:3px" align="center">@#02</td>
			<td style="padding:3px" align="left">@#03</td>
			<td style="padding:3px" align="right">@#04</td>
			<td style="padding:3px" align="right">@&04</td>
			<td style="padding:3px" align="right">@*04</td>			
			<td style="padding:3px" align="right">@#05</td>
			<td style="padding:3px" align="right">@&05</td>
			<td style="padding:3px" align="right">@*05</td>
			<td style="padding:3px" align="right">@#06</td>
			<td style="padding:3px" align="right">@&06</td>
			<td style="padding:3px" align="right">@*06</td>
			<td style="padding:3px" align="right">@#07</td>
			<td style="padding:3px" align="right">@&07</td>
			<td style="padding:3px" align="right">@*07</td>
			<td style="padding:3px" align="right">@#08</td>
			<td style="padding:3px" align="right">@&08</td>
			<td style="padding:3px" align="right">@*08</td>
			<td style="padding:3px" align="right">@#09</td>
			<td style="padding:3px" align="right">@&09</td>
			<td style="padding:3px" align="right">@*09</td>
			<td style="padding:3px" align="right">@#10</td>
			<td style="padding:3px" align="right">@&10</td>
			<td style="padding:3px" align="right">@*10</td>
			<td style="padding:3px" align="right">@#11</td>
			<td style="padding:3px" align="right">@&11</td>
			<td style="padding:3px" align="right">@*11</td>
			<td style="padding:3px" align="right">@#12</td>
			<td style="padding:3px" align="right">@&12</td>
			<td style="padding:3px" align="right">@*12</td>
			<td style="padding:3px" align="right">@#13</td>
			<td style="padding:3px" align="right">@&13</td>
			<td style="padding:3px" align="right">@*13</td>
			<td style="padding:3px" align="right">@#14</td>
			<td style="padding:3px" align="right">@&14</td>
			<td style="padding:3px" align="right">@*14</td>
			<td style="padding:3px" align="right">@#15</td>
			<td style="padding:3px" align="right">@&15</td>
			<td style="padding:3px" align="right">@*15</td>
		</tr>
';
$vTrStrLevel='
		<tr style="background-color:@11" height="21">
			<td style="padding:3px" align="left">@#01</td>
			<td style="padding:3px" align="center">@#02</td>
			<td style="padding:3px" align="left">@#03</td>
			<td style="padding:3px" align="right">@#04</td>
			<td style="padding:3px" align="right">@&04</td>
			<td style="padding:3px" align="right">@*04</td>			
			<td style="padding:3px" align="right">@#05</td>
			<td style="padding:3px" align="right">@&05</td>
			<td style="padding:3px" align="right">@*05</td>
			<td style="padding:3px" align="right">@#06</td>
			<td style="padding:3px" align="right">@&06</td>
			<td style="padding:3px" align="right">@*06</td>
			<td style="padding:3px" align="right">@#07</td>
			<td style="padding:3px" align="right">@&07</td>
			<td style="padding:3px" align="right">@*07</td>
			<td style="padding:3px" align="right">@#08</td>
			<td style="padding:3px" align="right">@&08</td>
			<td style="padding:3px" align="right">@*08</td>
			<td style="padding:3px" align="right">@#09</td>
			<td style="padding:3px" align="right">@&09</td>
			<td style="padding:3px" align="right">@*09</td>
			<td style="padding:3px" align="right">@#10</td>
			<td style="padding:3px" align="right">@&10</td>
			<td style="padding:3px" align="right">@*10</td>
			<td style="padding:3px" align="right">@#11</td>
			<td style="padding:3px" align="right">@&11</td>
			<td style="padding:3px" align="right">@*11</td>
			<td style="padding:3px" align="right">@#12</td>
			<td style="padding:3px" align="right">@&12</td>
			<td style="padding:3px" align="right">@*12</td>
			<td style="padding:3px" align="right">@#13</td>
			<td style="padding:3px" align="right">@&13</td>
			<td style="padding:3px" align="right">@*13</td>
			<td style="padding:3px" align="right">@#14</td>
			<td style="padding:3px" align="right">@&14</td>
			<td style="padding:3px" align="right">@*14</td>
			<td style="padding:3px" align="right">@#15</td>
			<td style="padding:3px" align="right">@&15</td>
			<td style="padding:3px" align="right">@*15</td>
		</tr>
';
		$lvListTrAll="";
		$vDepartment="";
		$StrMulSub="";
		$vSumAn=0;
		$vSumKhach=0;
		$vSum=0;
		
		if($this->lv029=="" || $this->lv029==NULL)
		{
		$vDepID='BUENO';
		$vsql="select lv001,lv003 from  hr_lv0002 where lv002='$vDepID' order by lv003";
		}
		else
		{
			
		$vsql="select lv001,lv003 from  hr_lv0002 where lv001 in ('".str_replace(",","','",$this->lv029)."') order by lv003";
		}
		$bResult=db_query($vsql);
		$i=1;
		for($jt=1;$jt<=12;$jt++)
		{
			$this->LV_GetNumDeptMonths($vYear,Fillnum($jt,2));
		}
		$vTotalNV=0;
		$vTotalNV1=0;
		$vTotalNV2=0;
		$vTotalNV3=0;
		$vTotalNV4=0;
		$vTotalNV5=0;
		$vTotalNV6=0;
		$vTotalNV7=0;
		$vTotalNV8=0;
		$vTotalNV9=0;
		$vTotalNV10=0;
		$vTotalNV11=0;
		$vTotalNV12=0;
		$vOt=0;
		while ($vrow = db_fetch_array ($bResult)){
			$LineTrStrParent=$vTrStr;
			$color='#EAEAEA';
			$vSumNV=$this->LV_GetNumberDeptChild($vrow['lv001'],$vNuNV);
			$vTotalNV=$vTotalNV+$vSumNV;
			$vTotalNu=$vTotalNu+$vNuNV;
			$LineTrStrParent=str_replace("@11",$color,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#01",$i,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#02",$vSumNV,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#03",$vrow['lv003'],$LineTrStrParent);
			$vrownv1=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"01");
			$vIn1=$vIn1+$vrownv1['vao'];
			$vOut1=$vOut1+$vrownv1['nghi'];
			$vrownv2=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"02");
			$vIn2=$vIn2+$vrownv2['vao'];
			$vOut2=$vOut2+$vrownv2['nghi'];
			$vrownv3=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"03");
			$vIn3=$vIn3+$vrownv3['vao'];
			$vOut3=$vOut3+$vrownv3['nghi'];
			$vrownv4=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"04");
			$vIn4=$vIn4+$vrownv4['vao'];
			$vOut4=$vOut4+$vrownv4['nghi'];
			$vrownv5=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"05");
			$vIn5=$vIn5+$vrownv5['vao'];
			$vOut5=$vOut5+$vrownv5['nghi'];
			$vrownv6=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"06");
			$vIn6=$vIn6+$vrownv6['vao'];
			$vOut6=$vOut6+$vrownv6['nghi'];
			$vrownv7=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"07");
			$vIn7=$vIn7+$vrownv7['vao'];
			$vOut7=$vOut7+$vrownv7['nghi'];
			$vrownv8=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"08");
			$vIn8=$vIn8+$vrownv8['vao'];
			$vOut8=$vOut8+$vrownv8['nghi'];
			$vrownv9=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"09");
			$vIn9=$vIn9+$vrownv9['vao'];
			$vOut9=$vOut9+$vrownv9['nghi'];
			$vrownv10=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"10");
			$vIn10=$vIn10+$vrownv10['vao'];
			$vOut10=$vOut10+$vrownv10['nghi'];
			$vrownv11=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"11");
			$vIn11=$vIn11+$vrownv11['vao'];
			$vOut11=$vOut11+$vrownv11['nghi'];
			$vrownv12=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"12");
			$vIn12=$vIn12+$vrownv12['vao'];
			$vOut12=$vOut12+$vrownv12['nghi'];
			$vSumNV1=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"01",$vNuNV1);
			$vSumNV2=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"02",$vNuNV2);
			$vSumNV3=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"03",$vNuNV3);
			$vSumNV4=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"04",$vNuNV4);
			$vSumNV5=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"05",$vNuNV5);
			$vSumNV6=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"06",$vNuNV6);
			$vSumNV7=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"07",$vNuNV7);
			$vSumNV8=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"08",$vNuNV8);
			$vSumNV9=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"09",$vNuNV9);
			$vSumNV10=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"10",$vNuNV10);
			$vSumNV11=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"11",$vNuNV11);
			$vSumNV12=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"12",$vNuNV12);
			$vArrSum[99][$vOt]=$vSumNV;
			$vArrSum[0][$vOt]=$vrow['lv001'];
			$vArrSum[1][$vOt]=$vSumNV1;
			$vArrSum[2][$vOt]=$vSumNV2;
			$vArrSum[3][$vOt]=$vSumNV3;
			$vArrSum[4][$vOt]=$vSumNV4;
			$vArrSum[5][$vOt]=$vSumNV5;
			$vArrSum[6][$vOt]=$vSumNV6;
			$vArrSum[7][$vOt]=$vSumNV7;
			$vArrSum[8][$vOt]=$vSumNV8;
			$vArrSum[9][$vOt]=$vSumNV9;
			$vArrSum[10][$vOt]=$vSumNV10;
			$vArrSum[11][$vOt]=$vSumNV11;
			$vArrSum[12][$vOt]=$vSumNV12;
			$vOt++;
			$vTotalNV1=$vTotalNV1+$vSumNV1;
			$vTotalNV2=$vTotalNV2+$vSumNV2;
			$vTotalNV3=$vTotalNV3+$vSumNV3;
			$vTotalNV4=$vTotalNV4+$vSumNV4;
			$vTotalNV5=$vTotalNV5+$vSumNV5;
			$vTotalNV6=$vTotalNV6+$vSumNV6;
			$vTotalNV7=$vTotalNV7+$vSumNV7;
			$vTotalNV8=$vTotalNV8+$vSumNV8;
			$vTotalNV9=$vTotalNV9+$vSumNV9;
			$vTotalNV10=$vTotalNV10+$vSumNV10;
			$vTotalNV11=$vTotalNV11+$vSumNV11;
			$vTotalNV12=$vTotalNV12+$vSumNV12;
			
			$vTotalNu1=$vTotalNu1+$vNuNV1;
			$vTotalNu2=$vTotalNu2+$vNuNV2;
			$vTotalNu3=$vTotalNu3+$vNuNV3;
			$vTotalNu4=$vTotalNu4+$vNuNV4;
			$vTotalNu5=$vTotalNu5+$vNuNV5;
			$vTotalNu6=$vTotalNu6+$vNuNV6;
			$vTotalNu7=$vTotalNu7+$vNuNV7;
			$vTotalNu8=$vTotalNu8+$vNuNV8;
			$vTotalNu9=$vTotalNu9+$vNuNV9;
			$vTotalNu10=$vTotalNu10+$vNuNV10;
			$vTotalNu11=$vTotalNu11+$vNuNV11;
			$vTotalNu12=$vTotalNu12+$vNuNV12;
			
			$LineTrStrParent=str_replace("@#04",$vSumNV1,$LineTrStrParent);
			$LineTrStrParent=str_replace("@&04",$vrownv1['vao'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@*04",$vrownv1['nghi'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@#05",$vSumNV2,$LineTrStrParent);
			$LineTrStrParent=str_replace("@&05",$vrownv2['vao'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@*05",$vrownv2['nghi'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@#06",$vSumNV3,$LineTrStrParent);
			$LineTrStrParent=str_replace("@&06",$vrownv3['vao'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@*06",$vrownv3['nghi'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@#07",$vSumNV4,$LineTrStrParent);
			$LineTrStrParent=str_replace("@&07",$vrownv4['vao'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@*07",$vrownv4['nghi'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@#08",$vSumNV5,$LineTrStrParent);
			$LineTrStrParent=str_replace("@&08",$vrownv5['vao'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@*08",$vrownv5['nghi'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@#09",$vSumNV6,$LineTrStrParent);
			$LineTrStrParent=str_replace("@&09",$vrownv6['vao'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@*09",$vrownv6['nghi'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@#10",$vSumNV7,$LineTrStrParent);
			$LineTrStrParent=str_replace("@&10",$vrownv7['vao'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@*10",$vrownv7['nghi'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@#11",$vSumNV8,$LineTrStrParent);
			$LineTrStrParent=str_replace("@&11",$vrownv8['vao'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@*11",$vrownv8['nghi'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@#12",$vSumNV9,$LineTrStrParent);
			$LineTrStrParent=str_replace("@&12",$vrownv9['vao'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@*12",$vrownv9['nghi'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@#13",$vSumNV10,$LineTrStrParent);
			$LineTrStrParent=str_replace("@&13",$vrownv10['vao'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@*13",$vrownv10['nghi'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@#14",$vSumNV11,$LineTrStrParent);
			$LineTrStrParent=str_replace("@&14",$vrownv11['vao'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@*14",$vrownv11['nghi'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@#15",$vSumNV12,$LineTrStrParent);
			$LineTrStrParent=str_replace("@&15",$vrownv12['vao'],$LineTrStrParent);
			$LineTrStrParent=str_replace("@*15",$vrownv12['nghi'],$LineTrStrParent);
			$vsql="select lv001,lv003 from  hr_lv0002 where ".(($this->level>0)?'':' 1=0 and ')." lv002='".$vrow['lv001']."' order by lv003";
			$bResult1=db_query($vsql);
			$StrMulSub="";
			$i1=1;
			
			while ($vrow1 = db_fetch_array ($bResult1)){
				$StrMulSub1='';
				$LineTrStrEmp1=$vTrStr;
				$color='#fff';
				$LineTrStrEmp1=str_replace("@11",$color,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#01",$i.".".$i1,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#02",$this->LV_GetNumberDeptChild($vrow1['lv001']),$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#03",$vrow1['lv003'],$LineTrStrEmp1);
				$vSumNV1=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"01");
				$vSumNV2=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"02");
				$vSumNV3=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"03");
				$vSumNV4=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"04");
				$vSumNV5=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"05");
				$vSumNV6=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"06");
				$vSumNV7=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"07");
				$vSumNV8=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"08");
				$vSumNV9=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"09");
				$vSumNV10=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"10");
				$vSumNV11=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"11");
				$vSumNV12=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"12");
				$vrownv1=$this->LV_GetNVNghi($vrow1['lv001'],$vYear,"01");
				$vrownv2=$this->LV_GetNVNghi($vrow1['lv001'],$vYear,"02");
				$vrownv3=$this->LV_GetNVNghi($vrow1['lv001'],$vYear,"03");
				$vrownv4=$this->LV_GetNVNghi($vrow1['lv001'],$vYear,"04");
				$vrownv5=$this->LV_GetNVNghi($vrow1['lv001'],$vYear,"05");
				$vrownv6=$this->LV_GetNVNghi($vrow1['lv001'],$vYear,"06");
				$vrownv7=$this->LV_GetNVNghi($vrow1['lv001'],$vYear,"07");
				$vrownv8=$this->LV_GetNVNghi($vrow1['lv001'],$vYear,"08");
				$vrownv9=$this->LV_GetNVNghi($vrow1['lv001'],$vYear,"09");
				$vrownv10=$this->LV_GetNVNghi($vrow1['lv001'],$vYear,"10");
				$vrownv11=$this->LV_GetNVNghi($vrow1['lv001'],$vYear,"11");
				$vrownv12=$this->LV_GetNVNghi($vrow1['lv001'],$vYear,"12");
				$LineTrStrEmp1=str_replace("@#04",$vSumNV1,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@&04",$vrownv1['vao'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@*04",$vrownv1['nghi'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#05",$vSumNV2,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@&05",$vrownv2['vao'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@*05",$vrownv2['nghi'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#06",$vSumNV3,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@&06",$vrownv3['vao'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@*06",$vrownv3['nghi'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#07",$vSumNV4,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@&07",$vrownv4['vao'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@*07",$vrownv4['nghi'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#08",$vSumNV5,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@&08",$vrownv5['vao'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@*08",$vrownv5['nghi'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#09",$vSumNV6,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@&09",$vrownv6['vao'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@*09",$vrownv6['nghi'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#10",$vSumNV7,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@&10",$vrownv7['vao'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@*10",$vrownv7['nghi'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#11",$vSumNV8,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@&11",$vrownv8['vao'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@*11",$vrownv8['nghi'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#12",$vSumNV9,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@&12",$vrownv9['vao'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@*12",$vrownv9['nghi'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#13",$vSumNV10,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@&13",$vrownv10['vao'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@*13",$vrownv10['nghi'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#14",$vSumNV11,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@&14",$vrownv11['vao'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@*14",$vrownv11['nghi'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#15",$vSumNV12,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@&15",$vrownv12['vao'],$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@*15",$vrownv12['nghi'],$LineTrStrEmp1);
				$i2=1;
				$vsql="select lv001,lv003 from  hr_lv0002 where ".(($this->level>1)?'':' 1=0 and ')." lv002='".$vrow1['lv001']."' order by lv003";
				$bResult2=db_query($vsql);
				while ($vrow2 = db_fetch_array ($bResult2)){
					$LineTrStrEmp=$vTrStr;
					$color='#fff';
					$LineTrStrEmp=str_replace("@11",$color,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#01",$i.".".$i1.".".$i2,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#02",$this->LV_GetNumberDeptChild($vrow2['lv001']),$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#03",$vrow2['lv003'],$LineTrStrEmp);
					$vSumNV1=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"01");
					$vSumNV2=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"02");
					$vSumNV3=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"03");
					$vSumNV4=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"04");
					$vSumNV5=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"05");
					$vSumNV6=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"06");
					$vSumNV7=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"07");
					$vSumNV8=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"08");
					$vSumNV9=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"09");
					$vSumNV10=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"10");
					$vSumNV11=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"11");
					$vSumNV12=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"12");
					
					$vrownv1=$this->LV_GetNVNghi($vrow2['lv001'],$vYear,"01");
				$vrownv2=$this->LV_GetNVNghi($vrow2['lv001'],$vYear,"02");
				$vrownv3=$this->LV_GetNVNghi($vrow2['lv001'],$vYear,"03");
				$vrownv4=$this->LV_GetNVNghi($vrow2['lv001'],$vYear,"04");
				$vrownv5=$this->LV_GetNVNghi($vrow2['lv001'],$vYear,"05");
				$vrownv6=$this->LV_GetNVNghi($vrow2['lv001'],$vYear,"06");
				$vrownv7=$this->LV_GetNVNghi($vrow2['lv001'],$vYear,"07");
				$vrownv8=$this->LV_GetNVNghi($vrow2['lv001'],$vYear,"08");
				$vrownv9=$this->LV_GetNVNghi($vrow2['lv001'],$vYear,"09");
				$vrownv10=$this->LV_GetNVNghi($vrow2['lv001'],$vYear,"10");
				$vrownv11=$this->LV_GetNVNghi($vrow2['lv001'],$vYear,"11");
				$vrownv12=$this->LV_GetNVNghi($vrow2['lv001'],$vYear,"12");
				$LineTrStrEmp=str_replace("@#04",$vSumNV1,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@&04",$vrownv1['vao'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@*04",$vrownv1['nghi'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#05",$vSumNV2,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@&05",$vrownv2['vao'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@*05",$vrownv2['nghi'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#06",$vSumNV3,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@&06",$vrownv3['vao'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@*06",$vrownv3['nghi'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#07",$vSumNV4,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@&07",$vrownv4['vao'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@*07",$vrownv4['nghi'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#08",$vSumNV5,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@&08",$vrownv5['vao'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@*08",$vrownv5['nghi'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#09",$vSumNV6,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@&09",$vrownv6['vao'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@*09",$vrownv6['nghi'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#10",$vSumNV7,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@&10",$vrownv7['vao'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@*10",$vrownv7['nghi'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#11",$vSumNV8,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@&11",$vrownv8['vao'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@*11",$vrownv8['nghi'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#12",$vSumNV9,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@&12",$vrownv9['vao'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@*12",$vrownv9['nghi'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#13",$vSumNV10,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@&13",$vrownv10['vao'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@*13",$vrownv10['nghi'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#14",$vSumNV11,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@&14",$vrownv11['vao'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@*14",$vrownv11['nghi'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@#15",$vSumNV12,$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@&15",$vrownv12['vao'],$LineTrStrEmp);
				$LineTrStrEmp=str_replace("@*15",$vrownv12['nghi'],$LineTrStrEmp);
					$StrMulSub1=$StrMulSub1.$LineTrStrEmp;
					$i3=1;
					$vsql="select lv001,lv003 from  hr_lv0002 where ".(($this->level>2)?'':' 1=0 and ')." lv002='".$vrow2['lv001']."' order by lv003";
					$bResult3=db_query($vsql);
					while ($vrow3 = db_fetch_array ($bResult3)){
						$LineTrStrEmp=$vTrStr;
						$color='#fff';
						$LineTrStrEmp=str_replace("@11",$color,$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#01",$i.".".$i1.".".$i2.".".$i3,$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#02",$this->LV_GetNumberDeptChild($vrow3['lv001']),$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#03",$vrow3['lv003'],$LineTrStrEmp);
						$StrMulSub1=$StrMulSub1.$LineTrStrEmp;
						$i3++;
					}
					$i2++;
				}
				$StrMulSub=$StrMulSub.$LineTrStrEmp1;
				$StrMulSub=$StrMulSub.$StrMulSub1;
				$i1++;
			}
			$vSumAn=$vSumAn+$vSLAn;
			$vSumKhach=$vSumKhach+$vSLKhach;
			$lvListTrAll=$lvListTrAll.$LineTrStrParent;
			$lvListTrAll=$lvListTrAll.$StrMulSub;
			$i++;
		}
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",$vTotalNV,$LineTrStr);
		$LineTrStr=str_replace("@#03",'Total',$LineTrStr);
		$LineTrStr=str_replace("@#04",$vTotalNV1,$LineTrStr);
		$LineTrStr=str_replace("@#05",$vTotalNV2,$LineTrStr);
		$LineTrStr=str_replace("@#06",$vTotalNV3,$LineTrStr);
		$LineTrStr=str_replace("@#07",$vTotalNV4,$LineTrStr);
		$LineTrStr=str_replace("@#08",$vTotalNV5,$LineTrStr);
		$LineTrStr=str_replace("@#09",$vTotalNV6,$LineTrStr);
		$LineTrStr=str_replace("@#10",$vTotalNV7,$LineTrStr);
		$LineTrStr=str_replace("@#11",$vTotalNV8,$LineTrStr);
		$LineTrStr=str_replace("@#12",$vTotalNV9,$LineTrStr);
		$LineTrStr=str_replace("@#13",$vTotalNV10,$LineTrStr);
		$LineTrStr=str_replace("@#14",$vTotalNV11,$LineTrStr);
		$LineTrStr=str_replace("@#15",$vTotalNV12,$LineTrStr);
		
		$LineTrStr=str_replace("@&04",$vIn1,$LineTrStr);
		$LineTrStr=str_replace("@&05",$vIn2,$LineTrStr);
		$LineTrStr=str_replace("@&06",$vIn3,$LineTrStr);
		$LineTrStr=str_replace("@&07",$vIn4,$LineTrStr);
		$LineTrStr=str_replace("@&08",$vIn5,$LineTrStr);
		$LineTrStr=str_replace("@&09",$vIn6,$LineTrStr);
		$LineTrStr=str_replace("@&10",$vIn7,$LineTrStr);
		$LineTrStr=str_replace("@&11",$vIn8,$LineTrStr);
		$LineTrStr=str_replace("@&12",$vIn9,$LineTrStr);
		$LineTrStr=str_replace("@&13",$vIn10,$LineTrStr);
		$LineTrStr=str_replace("@&14",$vIn11,$LineTrStr);
		$LineTrStr=str_replace("@&15",$vIn12,$LineTrStr);
		
		$LineTrStr=str_replace("@*04",$vOut1,$LineTrStr);
		$LineTrStr=str_replace("@*05",$vOut2,$LineTrStr);
		$LineTrStr=str_replace("@*06",$vOut3,$LineTrStr);
		$LineTrStr=str_replace("@*07",$vOut4,$LineTrStr);
		$LineTrStr=str_replace("@*08",$vOut5,$LineTrStr);
		$LineTrStr=str_replace("@*09",$vOut6,$LineTrStr);
		$LineTrStr=str_replace("@*10",$vOut7,$LineTrStr);
		$LineTrStr=str_replace("@*11",$vOut8,$LineTrStr);
		$LineTrStr=str_replace("@*12",$vOut9,$LineTrStr);
		$LineTrStr=str_replace("@*13",$vOut10,$LineTrStr);
		$LineTrStr=str_replace("@*14",$vOut11,$LineTrStr);
		$LineTrStr=str_replace("@*15",$vOut12,$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#03",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#15",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&15",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*15",'&nbsp;',$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		
		
		
		
		
		
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",$vTotalNV-$vTotalNu,$LineTrStr);
		$LineTrStr=str_replace("@#03",'Male',$LineTrStr);
		$LineTrStr=str_replace("@#04",($vTotalNV1-$vTotalNu1),$LineTrStr);
		$LineTrStr=str_replace("@&04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#05",$vTotalNV2-$vTotalNu2,$LineTrStr);
		$LineTrStr=str_replace("@&05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#06",$vTotalNV3-$vTotalNu3,$LineTrStr);
		$LineTrStr=str_replace("@&06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#07",$vTotalNV4-$vTotalNu4,$LineTrStr);
		$LineTrStr=str_replace("@&07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#08",$vTotalNV5-$vTotalNu5,$LineTrStr);
		$LineTrStr=str_replace("@&08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#09",$vTotalNV6-$vTotalNu6,$LineTrStr);
		$LineTrStr=str_replace("@&09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#10",$vTotalNV7-$vTotalNu7,$LineTrStr);
		$LineTrStr=str_replace("@&10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#11",$vTotalNV8-$vTotalNu8,$LineTrStr);
		$LineTrStr=str_replace("@&11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#12",$vTotalNV9-$vTotalNu9,$LineTrStr);
		$LineTrStr=str_replace("@&12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#13",$vTotalNV10-$vTotalNu10,$LineTrStr);
		$LineTrStr=str_replace("@&13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#14",$vTotalNV11-$vTotalNu11,$LineTrStr);
		$LineTrStr=str_replace("@&14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#15",$vTotalNV12-$vTotalNu12,$LineTrStr);
		$LineTrStr=str_replace("@&15",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*15",'&nbsp;',$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",$vTotalNu,$LineTrStr);
		$LineTrStr=str_replace("@#03",'FeMale',$LineTrStr);
		$LineTrStr=str_replace("@#04",$vTotalNu1,$LineTrStr);
		$LineTrStr=str_replace("@&04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#05",$vTotalNu2,$LineTrStr);
		$LineTrStr=str_replace("@&05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#06",$vTotalNu3,$LineTrStr);
		$LineTrStr=str_replace("@&06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#07",$vTotalNu4,$LineTrStr);
		$LineTrStr=str_replace("@&07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#08",$vTotalNu5,$LineTrStr);
		$LineTrStr=str_replace("@&08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#09",$vTotalNu6,$LineTrStr);
		$LineTrStr=str_replace("@*09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#10",$vTotalNu7,$LineTrStr);
		$LineTrStr=str_replace("@&10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#11",$vTotalNu8,$LineTrStr);
		$LineTrStr=str_replace("@&11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#12",$vTotalNu9,$LineTrStr);
		$LineTrStr=str_replace("@&12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#13",$vTotalNu10,$LineTrStr);
		$LineTrStr=str_replace("@&13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#14",$vTotalNu11,$LineTrStr);
		$LineTrStr=str_replace("@&14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#15",$vTotalNu12,$LineTrStr);
		$LineTrStr=str_replace("@&15",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*15",'&nbsp;',$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#03",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#15",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@&15",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*15",'&nbsp;',$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",$this->LV_GetCompareDept($vArrSum,99),$LineTrStr);
		$LineTrStr=str_replace("@#03",$this->LV_GetCompareDept($vArrSum,0),$LineTrStr);
		$LineTrStr=str_replace("@#04",$this->LV_GetCompareDept($vArrSum,1),$LineTrStr);
		$LineTrStr=str_replace("@&04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#05",$this->LV_GetCompareDept($vArrSum,2),$LineTrStr);
		$LineTrStr=str_replace("@&05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#06",$this->LV_GetCompareDept($vArrSum,3),$LineTrStr);
		$LineTrStr=str_replace("@&06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#07",$this->LV_GetCompareDept($vArrSum,4),$LineTrStr);
		$LineTrStr=str_replace("@&07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#08",$this->LV_GetCompareDept($vArrSum,5),$LineTrStr);
		$LineTrStr=str_replace("@&08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#09",$this->LV_GetCompareDept($vArrSum,6),$LineTrStr);
		$LineTrStr=str_replace("@&09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#10",$this->LV_GetCompareDept($vArrSum,7),$LineTrStr);
		$LineTrStr=str_replace("@&10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#11",$this->LV_GetCompareDept($vArrSum,8),$LineTrStr);
		$LineTrStr=str_replace("@&11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#12",$this->LV_GetCompareDept($vArrSum,9),$LineTrStr);
		$LineTrStr=str_replace("@&12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#13",$this->LV_GetCompareDept($vArrSum,10),$LineTrStr);
		$LineTrStr=str_replace("@&13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#14",$this->LV_GetCompareDept($vArrSum,11),$LineTrStr);
		$LineTrStr=str_replace("@&14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#15",$this->LV_GetCompareDept($vArrSum,12),$LineTrStr);
		$LineTrStr=str_replace("@&15",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*15",'&nbsp;',$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",$vTotalNV,$LineTrStr);
		$LineTrStr=str_replace("@#03",'Total',$LineTrStr);
		$LineTrStr=str_replace("@#04",$vTotalNV1,$LineTrStr);
		$LineTrStr=str_replace("@&04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#05",$vTotalNV2,$LineTrStr);
		$LineTrStr=str_replace("@&05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#06",$vTotalNV3,$LineTrStr);
		$LineTrStr=str_replace("@&06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#07",$vTotalNV4,$LineTrStr);
		$LineTrStr=str_replace("@&07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#08",$vTotalNV5,$LineTrStr);
		$LineTrStr=str_replace("@&08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#09",$vTotalNV6,$LineTrStr);
		$LineTrStr=str_replace("@&09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#10",$vTotalNV7,$LineTrStr);
		$LineTrStr=str_replace("@&10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#11",$vTotalNV8,$LineTrStr);
		$LineTrStr=str_replace("@&11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#12",$vTotalNV9,$LineTrStr);
		$LineTrStr=str_replace("@&12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#13",$vTotalNV10,$LineTrStr);
		$LineTrStr=str_replace("@&13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#14",$vTotalNV11,$LineTrStr);
		$LineTrStr=str_replace("@&14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#15",$vTotalNV12,$LineTrStr);
		$LineTrStr=str_replace("@&15",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@*15",'&nbsp;',$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		return str_replace("@01",$lvListTrAll,str_replace("#02",$this->FormatView($vSum,10),$vTable));
	
	}
	function LV_BuilListReportDeptFull()
	{
	$this->LV_GetNumDeptCurrent();
	//echo "<textarea>";
	//print_r($this->ArrDeptCurrent);
	//echo "</textarea>";
	$this->isAdd=0;
	$this->isEdit=0;
	$childfunc=$_GET['childfunc'];
	$vYear=getyear(recoverdate($this->dateworkfrom,$this->lang));
	$vTable='
<div><br/><h1>'.$this->ArrPush[0].'</h1>
<center><h1>NĂM '.$vYear.'<h1/></center>
<table  style="width: 760px;"   align="center" class="tblprint" id="tabletc" border="1" cellpadding="0" cellspacing="0">
<colgroup>
<col width="6%"></col> 
<col width="6%"></col>
 <col width="12%"></col>
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 <col width="5%"></col> 
 </colgroup> 
<tbody>
<tr height="21">
<td class="lvhtable" rowspan="2" height="42" >&nbsp;NO.&nbsp;</td>

<td class="lvhtable" rowspan="2">CURRENT NUM</td>
<td class="lvhtable" rowspan="2">&nbsp;DEPT.&nbsp;</td>
<td class="lvhtable" colspan="12">&nbsp;MONTHLY&nbsp;</td>
</tr>
<tr>
<td align=center>01</td>
<td align=center>02</td>
<td align=center>03</td>
<td align=center>04</td>
<td align=center>05</td>
<td align=center>06</td>
<td align=center>07</td>
<td align=center>08</td>
<td align=center>09</td>
<td align=center>10</td>
<td align=center>11</td>
<td align=center>12</td>
</tr>
@01
</table>
<table style="width: 760px;"   align="center" class="tblprint" id="tabletc" border="0" cellpadding="0" 
<tr height="21">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td colspan="2" height="20" align=center>Prepared   by</td>
<td align=center>Checked by</td>
<td>&nbsp;</td>
<td align=center>&nbsp;</td>
<td align=center>Approved by</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td colspan="2" height="20" align=center><input style="backround:#fff;border:0px;text-align:center" type="textbox" value="Võ Thị Ngọc Trang"/></td>
<td colspan="2" align=center><input style="backround:#fff;border:0px;text-align:center" type="textbox" value="Trần Thị Thu Thúy"/></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td colspan="2" height="20" align=center>HR   Staff</td>
<td align=center>AHR Manager</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
<td height="20">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="21">
<td height="21">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
</center>

		';

		$vTrStr='
		<tr style="background-color:@11" height="21">
			<td style="padding:3px" align="left">@#01</td>
			<td style="padding:3px" align="center">@#02</td>
			<td style="padding:3px" align="left">@#03</td>
			<td style="padding:3px" align="right">@#04</td>		
			<td style="padding:3px" align="right">@#05</td>
			<td style="padding:3px" align="right">@#06</td>
			<td style="padding:3px" align="right">@#07</td>
			<td style="padding:3px" align="right">@#08</td>
			<td style="padding:3px" align="right">@#09</td>
			<td style="padding:3px" align="right">@#10</td>
			<td style="padding:3px" align="right">@#11</td>
			<td style="padding:3px" align="right">@#12</td>
			<td style="padding:3px" align="right">@#13</td>
			<td style="padding:3px" align="right">@#14</td>
			<td style="padding:3px" align="right">@#15</td>
		</tr>
';
		$lvListTrAll="";
		$vDepartment="";
		$StrMulSub="";
		$vSumAn=0;
		$vSumKhach=0;
		$vSum=0;
		
		if($this->lv029=="" || $this->lv029==NULL)
		{
		$vDepID='BUENO';
		$vsql="select lv001,lv003 from  hr_lv0002 where lv002='$vDepID' order by lv003";
		}
		else
		{
			
		$vsql="select lv001,lv003 from  hr_lv0002 where lv001 in ('".str_replace(",","','",$this->lv029)."') order by lv003";
		}
		$bResult=db_query($vsql);
		$i=1;
		for($jt=1;$jt<=12;$jt++)
		{
			$this->LV_GetNumDeptMonths($vYear,Fillnum($jt,2));
		}
		$vTotalNV=0;
		$vTotalNV1=0;
		$vTotalNV2=0;
		$vTotalNV3=0;
		$vTotalNV4=0;
		$vTotalNV5=0;
		$vTotalNV6=0;
		$vTotalNV7=0;
		$vTotalNV8=0;
		$vTotalNV9=0;
		$vTotalNV10=0;
		$vTotalNV11=0;
		$vTotalNV12=0;
		$vOt=0;
		while ($vrow = db_fetch_array ($bResult)){
			$LineTrStrParent=$vTrStr;
			$color='#EAEAEA';
			$vSumNV=$this->LV_GetNumberDeptChild($vrow['lv001'],$vNuNV);
			$vTotalNV=$vTotalNV+$vSumNV;
			$vTotalNu=$vTotalNu+$vNuNV;
			$LineTrStrParent=str_replace("@11",$color,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#01",$i,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#02",$vSumNV,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#03",$vrow['lv003'],$LineTrStrParent);
			$vrownv1=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"01");
			$vIn1=$vIn1+$vrownv1['vao'];
			$vOut1=$vOut1+$vrownv1['nghi'];
			$vrownv2=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"02");
			$vIn2=$vIn2+$vrownv2['vao'];
			$vOut2=$vOut2+$vrownv2['nghi'];
			$vrownv3=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"03");
			$vIn3=$vIn3+$vrownv3['vao'];
			$vOut3=$vOut3+$vrownv3['nghi'];
			$vrownv4=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"04");
			$vIn4=$vIn4+$vrownv4['vao'];
			$vOut4=$vOut4+$vrownv4['nghi'];
			$vrownv5=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"05");
			$vIn5=$vIn5+$vrownv5['vao'];
			$vOut5=$vOut5+$vrownv5['nghi'];
			$vrownv6=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"06");
			$vIn6=$vIn6+$vrownv6['vao'];
			$vOut6=$vOut6+$vrownv6['nghi'];
			$vrownv7=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"07");
			$vIn7=$vIn7+$vrownv7['vao'];
			$vOut7=$vOut7+$vrownv7['nghi'];
			$vrownv8=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"08");
			$vIn8=$vIn8+$vrownv8['vao'];
			$vOut8=$vOut8+$vrownv8['nghi'];
			$vrownv9=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"09");
			$vIn9=$vIn9+$vrownv9['vao'];
			$vOut9=$vOut9+$vrownv9['nghi'];
			$vrownv10=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"10");
			$vIn10=$vIn10+$vrownv10['vao'];
			$vOut10=$vOut10+$vrownv10['nghi'];
			$vrownv11=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"11");
			$vIn11=$vIn11+$vrownv11['vao'];
			$vOut11=$vOut11+$vrownv11['nghi'];
			$vrownv12=$this->LV_GetNVNghi($vrow['lv001'],$vYear,"12");
			$vIn12=$vIn12+$vrownv12['vao'];
			$vOut12=$vOut12+$vrownv12['nghi'];
			$vSumNV1=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"01",$vNuNV1);
			$vSumNV2=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"02",$vNuNV2);
			$vSumNV3=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"03",$vNuNV3);
			$vSumNV4=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"04",$vNuNV4);
			$vSumNV5=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"05",$vNuNV5);
			$vSumNV6=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"06",$vNuNV6);
			$vSumNV7=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"07",$vNuNV7);
			$vSumNV8=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"08",$vNuNV8);
			$vSumNV9=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"09",$vNuNV9);
			$vSumNV10=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"10",$vNuNV10);
			$vSumNV11=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"11",$vNuNV11);
			$vSumNV12=$this->LV_GetNumberDeptChildMonth($vrow['lv001'],$vYear,"12",$vNuNV12);
			$vArrSum[99][$vOt]=$vSumNV;
			$vArrSum[0][$vOt]=$vrow['lv001'];
			$vArrSum[1][$vOt]=$vSumNV1;
			$vArrSum[2][$vOt]=$vSumNV2;
			$vArrSum[3][$vOt]=$vSumNV3;
			$vArrSum[4][$vOt]=$vSumNV4;
			$vArrSum[5][$vOt]=$vSumNV5;
			$vArrSum[6][$vOt]=$vSumNV6;
			$vArrSum[7][$vOt]=$vSumNV7;
			$vArrSum[8][$vOt]=$vSumNV8;
			$vArrSum[9][$vOt]=$vSumNV9;
			$vArrSum[10][$vOt]=$vSumNV10;
			$vArrSum[11][$vOt]=$vSumNV11;
			$vArrSum[12][$vOt]=$vSumNV12;
			$vOt++;
			$vTotalNV1=$vTotalNV1+$vSumNV1;
			$vTotalNV2=$vTotalNV2+$vSumNV2;
			$vTotalNV3=$vTotalNV3+$vSumNV3;
			$vTotalNV4=$vTotalNV4+$vSumNV4;
			$vTotalNV5=$vTotalNV5+$vSumNV5;
			$vTotalNV6=$vTotalNV6+$vSumNV6;
			$vTotalNV7=$vTotalNV7+$vSumNV7;
			$vTotalNV8=$vTotalNV8+$vSumNV8;
			$vTotalNV9=$vTotalNV9+$vSumNV9;
			$vTotalNV10=$vTotalNV10+$vSumNV10;
			$vTotalNV11=$vTotalNV11+$vSumNV11;
			$vTotalNV12=$vTotalNV12+$vSumNV12;
			
			$vTotalNu1=$vTotalNu1+$vNuNV1;
			$vTotalNu2=$vTotalNu2+$vNuNV2;
			$vTotalNu3=$vTotalNu3+$vNuNV3;
			$vTotalNu4=$vTotalNu4+$vNuNV4;
			$vTotalNu5=$vTotalNu5+$vNuNV5;
			$vTotalNu6=$vTotalNu6+$vNuNV6;
			$vTotalNu7=$vTotalNu7+$vNuNV7;
			$vTotalNu8=$vTotalNu8+$vNuNV8;
			$vTotalNu9=$vTotalNu9+$vNuNV9;
			$vTotalNu10=$vTotalNu10+$vNuNV10;
			$vTotalNu11=$vTotalNu11+$vNuNV11;
			$vTotalNu12=$vTotalNu12+$vNuNV12;
			
			$LineTrStrParent=str_replace("@#04",$vSumNV1,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#05",$vSumNV2,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#06",$vSumNV3,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#07",$vSumNV4,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#08",$vSumNV5,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#09",$vSumNV6,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#10",$vSumNV7,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#11",$vSumNV8,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#12",$vSumNV9,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#13",$vSumNV10,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#14",$vSumNV11,$LineTrStrParent);
			$LineTrStrParent=str_replace("@#15",$vSumNV12,$LineTrStrParent);
			$vsql="select lv001,lv003 from  hr_lv0002 where ".(($this->level>0)?'':' 1=0 and ')." lv002='".$vrow['lv001']."' order by lv003";
			$bResult1=db_query($vsql);
			$StrMulSub="";
			$i1=1;
			
			while ($vrow1 = db_fetch_array ($bResult1)){
				$StrMulSub1='';
				$LineTrStrEmp1=$vTrStr;
				$color='#fff';
				$LineTrStrEmp1=str_replace("@11",$color,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#01",$i.".".$i1,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#02",$this->LV_GetNumberDeptChild($vrow1['lv001']),$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#03",$vrow1['lv003'],$LineTrStrEmp1);
				$vSumNV1=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"01");
				$vSumNV2=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"02");
				$vSumNV3=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"03");
				$vSumNV4=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"04");
				$vSumNV5=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"05");
				$vSumNV6=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"06");
				$vSumNV7=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"07");
				$vSumNV8=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"08");
				$vSumNV9=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"09");
				$vSumNV10=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"10");
				$vSumNV11=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"11");
				$vSumNV12=$this->LV_GetNumberDeptChildMonth($vrow1['lv001'],$vYear,"12");
				
				$LineTrStrEmp1=str_replace("@#04",$vSumNV1,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#05",$vSumNV2,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#06",$vSumNV3,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#07",$vSumNV4,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#08",$vSumNV5,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#09",$vSumNV6,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#10",$vSumNV7,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#11",$vSumNV8,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#12",$vSumNV9,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#13",$vSumNV10,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#14",$vSumNV11,$LineTrStrEmp1);
				$LineTrStrEmp1=str_replace("@#15",$vSumNV12,$LineTrStrEmp1);
				$i2=1;
				$vsql="select lv001,lv003 from  hr_lv0002 where ".(($this->level>1)?'':' 1=0 and ')." lv002='".$vrow1['lv001']."' order by lv003";
				$bResult2=db_query($vsql);
				while ($vrow2 = db_fetch_array ($bResult2)){
					$LineTrStrEmp=$vTrStr;
					$color='#fff';
					$LineTrStrEmp=str_replace("@11",$color,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#01",$i.".".$i1.".".$i2,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#02",$this->LV_GetNumberDeptChild($vrow2['lv001']),$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#03",$vrow2['lv003'],$LineTrStrEmp);
					$vSumNV1=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"01");
					$vSumNV2=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"02");
					$vSumNV3=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"03");
					$vSumNV4=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"04");
					$vSumNV5=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"05");
					$vSumNV6=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"06");
					$vSumNV7=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"07");
					$vSumNV8=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"08");
					$vSumNV9=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"09");
					$vSumNV10=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"10");
					$vSumNV11=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"11");
					$vSumNV12=$this->LV_GetNumberDeptChildMonth($vrow2['lv001'],$vYear,"12");
					
					$LineTrStrEmp=str_replace("@#04",$vSumNV1,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#05",$vSumNV2,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#06",$vSumNV3,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#07",$vSumNV4,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#08",$vSumNV5,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#09",$vSumNV6,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#10",$vSumNV7,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#11",$vSumNV8,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#12",$vSumNV9,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#13",$vSumNV10,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#14",$vSumNV11,$LineTrStrEmp);
					$LineTrStrEmp=str_replace("@#15",$vSumNV12,$LineTrStrEmp);
					$StrMulSub1=$StrMulSub1.$LineTrStrEmp;
					$i3=1;
					$vsql="select lv001,lv003 from  hr_lv0002 where ".(($this->level>2)?'':' 1=0 and ')." lv002='".$vrow2['lv001']."' order by lv003";
					$bResult3=db_query($vsql);
					while ($vrow3 = db_fetch_array ($bResult3)){
						$LineTrStrEmp=$vTrStr;
						$color='#fff';
						$LineTrStrEmp=str_replace("@11",$color,$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#01",$i.".".$i1.".".$i2.".".$i3,$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#02",$this->LV_GetNumberDeptChild($vrow3['lv001']),$LineTrStrEmp);
						$LineTrStrEmp=str_replace("@#03",$vrow3['lv003'],$LineTrStrEmp);
						$StrMulSub1=$StrMulSub1.$LineTrStrEmp;
						$i3++;
					}
					$i2++;
				}
				$StrMulSub=$StrMulSub.$LineTrStrEmp1;
				$StrMulSub=$StrMulSub.$StrMulSub1;
				$i1++;
			}
			$vSumAn=$vSumAn+$vSLAn;
			$vSumKhach=$vSumKhach+$vSLKhach;
			$lvListTrAll=$lvListTrAll.$LineTrStrParent;
			$lvListTrAll=$lvListTrAll.$StrMulSub;
			$i++;
		}
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",$vTotalNV,$LineTrStr);
		$LineTrStr=str_replace("@#03",'Total',$LineTrStr);
		$LineTrStr=str_replace("@#04",$vTotalNV1,$LineTrStr);
		$LineTrStr=str_replace("@#05",$vTotalNV2,$LineTrStr);
		$LineTrStr=str_replace("@#06",$vTotalNV3,$LineTrStr);
		$LineTrStr=str_replace("@#07",$vTotalNV4,$LineTrStr);
		$LineTrStr=str_replace("@#08",$vTotalNV5,$LineTrStr);
		$LineTrStr=str_replace("@#09",$vTotalNV6,$LineTrStr);
		$LineTrStr=str_replace("@#10",$vTotalNV7,$LineTrStr);
		$LineTrStr=str_replace("@#11",$vTotalNV8,$LineTrStr);
		$LineTrStr=str_replace("@#12",$vTotalNV9,$LineTrStr);
		$LineTrStr=str_replace("@#13",$vTotalNV10,$LineTrStr);
		$LineTrStr=str_replace("@#14",$vTotalNV11,$LineTrStr);
		$LineTrStr=str_replace("@#15",$vTotalNV12,$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#03",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#15",'&nbsp;',$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#03",'In',$LineTrStr);
		$LineTrStr=str_replace("@#04",$vIn1,$LineTrStr);
		$LineTrStr=str_replace("@#05",$vIn2,$LineTrStr);
		$LineTrStr=str_replace("@#06",$vIn3,$LineTrStr);
		$LineTrStr=str_replace("@#07",$vIn4,$LineTrStr);
		$LineTrStr=str_replace("@#08",$vIn5,$LineTrStr);
		$LineTrStr=str_replace("@#09",$vIn6,$LineTrStr);
		$LineTrStr=str_replace("@#10",$vIn7,$LineTrStr);
		$LineTrStr=str_replace("@#11",$vIn8,$LineTrStr);
		$LineTrStr=str_replace("@#12",$vIn9,$LineTrStr);
		$LineTrStr=str_replace("@#13",$vIn10,$LineTrStr);
		$LineTrStr=str_replace("@#14",$vIn11,$LineTrStr);
		$LineTrStr=str_replace("@#15",$vIn12,$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#03",'Out',$LineTrStr);
		$LineTrStr=str_replace("@#04",$vOut1,$LineTrStr);
		$LineTrStr=str_replace("@#05",$vOut2,$LineTrStr);
		$LineTrStr=str_replace("@#06",$vOut3,$LineTrStr);
		$LineTrStr=str_replace("@#07",$vOut4,$LineTrStr);
		$LineTrStr=str_replace("@#08",$vOut5,$LineTrStr);
		$LineTrStr=str_replace("@#09",$vOut6,$LineTrStr);
		$LineTrStr=str_replace("@#10",$vOut7,$LineTrStr);
		$LineTrStr=str_replace("@#11",$vOut8,$LineTrStr);
		$LineTrStr=str_replace("@#12",$vOut9,$LineTrStr);
		$LineTrStr=str_replace("@#13",$vOut10,$LineTrStr);
		$LineTrStr=str_replace("@#14",$vOut11,$LineTrStr);
		$LineTrStr=str_replace("@#15",$vOut12,$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",$vTotalNV,$LineTrStr);
		$LineTrStr=str_replace("@#03",'Total',$LineTrStr);
		$LineTrStr=str_replace("@#04",$vTotalNV1,$LineTrStr);
		$LineTrStr=str_replace("@#05",$vTotalNV2,$LineTrStr);
		$LineTrStr=str_replace("@#06",$vTotalNV3,$LineTrStr);
		$LineTrStr=str_replace("@#07",$vTotalNV4,$LineTrStr);
		$LineTrStr=str_replace("@#08",$vTotalNV5,$LineTrStr);
		$LineTrStr=str_replace("@#09",$vTotalNV6,$LineTrStr);
		$LineTrStr=str_replace("@#10",$vTotalNV7,$LineTrStr);
		$LineTrStr=str_replace("@#11",$vTotalNV8,$LineTrStr);
		$LineTrStr=str_replace("@#12",$vTotalNV9,$LineTrStr);
		$LineTrStr=str_replace("@#13",$vTotalNV10,$LineTrStr);
		$LineTrStr=str_replace("@#14",$vTotalNV11,$LineTrStr);
		$LineTrStr=str_replace("@#15",$vTotalNV12,$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#03",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#04",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#05",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#06",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#07",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#08",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#09",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#10",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#11",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#12",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#13",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#14",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#15",'&nbsp;',$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",$vTotalNV-$vTotalNu,$LineTrStr);
		$LineTrStr=str_replace("@#03",'Male',$LineTrStr);
		$LineTrStr=str_replace("@#04",($vTotalNV1-$vTotalNu1),$LineTrStr);
		$LineTrStr=str_replace("@#05",$vTotalNV2-$vTotalNu2,$LineTrStr);
		$LineTrStr=str_replace("@#06",$vTotalNV3-$vTotalNu3,$LineTrStr);
		$LineTrStr=str_replace("@#07",$vTotalNV4-$vTotalNu4,$LineTrStr);
		$LineTrStr=str_replace("@#08",$vTotalNV5-$vTotalNu5,$LineTrStr);
		$LineTrStr=str_replace("@#09",$vTotalNV6-$vTotalNu6,$LineTrStr);
		$LineTrStr=str_replace("@#10",$vTotalNV7-$vTotalNu7,$LineTrStr);
		$LineTrStr=str_replace("@#11",$vTotalNV8-$vTotalNu8,$LineTrStr);
		$LineTrStr=str_replace("@#12",$vTotalNV9-$vTotalNu9,$LineTrStr);
		$LineTrStr=str_replace("@#13",$vTotalNV10-$vTotalNu10,$LineTrStr);
		$LineTrStr=str_replace("@#14",$vTotalNV11-$vTotalNu11,$LineTrStr);
		$LineTrStr=str_replace("@#15",$vTotalNV12-$vTotalNu12,$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",$vTotalNu,$LineTrStr);
		$LineTrStr=str_replace("@#03",'FeMale',$LineTrStr);
		$LineTrStr=str_replace("@#04",$vTotalNu1,$LineTrStr);
		$LineTrStr=str_replace("@#05",$vTotalNu2,$LineTrStr);
		$LineTrStr=str_replace("@#06",$vTotalNu3,$LineTrStr);
		$LineTrStr=str_replace("@#07",$vTotalNu4,$LineTrStr);
		$LineTrStr=str_replace("@#08",$vTotalNu5,$LineTrStr);
		$LineTrStr=str_replace("@#09",$vTotalNu6,$LineTrStr);
		$LineTrStr=str_replace("@#10",$vTotalNu7,$LineTrStr);
		$LineTrStr=str_replace("@#11",$vTotalNu8,$LineTrStr);
		$LineTrStr=str_replace("@#12",$vTotalNu9,$LineTrStr);
		$LineTrStr=str_replace("@#13",$vTotalNu10,$LineTrStr);
		$LineTrStr=str_replace("@#14",$vTotalNu11,$LineTrStr);
		$LineTrStr=str_replace("@#15",$vTotalNu12,$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",$this->LV_GetCompareDept($vArrSum,99),$LineTrStr);
		$LineTrStr=str_replace("@#03",$this->LV_GetCompareDept($vArrSum,0),$LineTrStr);
		$LineTrStr=str_replace("@#04",$this->LV_GetCompareDept($vArrSum,1),$LineTrStr);
		$LineTrStr=str_replace("@#05",$this->LV_GetCompareDept($vArrSum,2),$LineTrStr);
		$LineTrStr=str_replace("@#06",$this->LV_GetCompareDept($vArrSum,3),$LineTrStr);
		$LineTrStr=str_replace("@#07",$this->LV_GetCompareDept($vArrSum,4),$LineTrStr);
		$LineTrStr=str_replace("@#08",$this->LV_GetCompareDept($vArrSum,5),$LineTrStr);
		$LineTrStr=str_replace("@#09",$this->LV_GetCompareDept($vArrSum,6),$LineTrStr);
		$LineTrStr=str_replace("@#10",$this->LV_GetCompareDept($vArrSum,7),$LineTrStr);
		$LineTrStr=str_replace("@#11",$this->LV_GetCompareDept($vArrSum,8),$LineTrStr);
		$LineTrStr=str_replace("@#12",$this->LV_GetCompareDept($vArrSum,9),$LineTrStr);
		$LineTrStr=str_replace("@#13",$this->LV_GetCompareDept($vArrSum,10),$LineTrStr);
		$LineTrStr=str_replace("@#14",$this->LV_GetCompareDept($vArrSum,11),$LineTrStr);
		$LineTrStr=str_replace("@#15",$this->LV_GetCompareDept($vArrSum,12),$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		$LineTrStr=$vTrStr;
		$LineTrStr=str_replace("@#01",'&nbsp;',$LineTrStr);
		$LineTrStr=str_replace("@#02",$vTotalNV,$LineTrStr);
		$LineTrStr=str_replace("@#03",'Total',$LineTrStr);
		$LineTrStr=str_replace("@#04",$vTotalNV1,$LineTrStr);
		$LineTrStr=str_replace("@#05",$vTotalNV2,$LineTrStr);
		$LineTrStr=str_replace("@#06",$vTotalNV3,$LineTrStr);
		$LineTrStr=str_replace("@#07",$vTotalNV4,$LineTrStr);
		$LineTrStr=str_replace("@#08",$vTotalNV5,$LineTrStr);
		$LineTrStr=str_replace("@#09",$vTotalNV6,$LineTrStr);
		$LineTrStr=str_replace("@#10",$vTotalNV7,$LineTrStr);
		$LineTrStr=str_replace("@#11",$vTotalNV8,$LineTrStr);
		$LineTrStr=str_replace("@#12",$vTotalNV9,$LineTrStr);
		$LineTrStr=str_replace("@#13",$vTotalNV10,$LineTrStr);
		$LineTrStr=str_replace("@#14",$vTotalNV11,$LineTrStr);
		$LineTrStr=str_replace("@#15",$vTotalNV12,$LineTrStr);
		$lvListTrAll=$lvListTrAll.$LineTrStr;
		return str_replace("@01",$lvListTrAll,str_replace("#02",$this->FormatView($vSum,10),$vTable));
	
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportAdvance($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
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
		$lvTd="<td align=@#05>@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"1\">&nbsp;</td>";
		$lvImg="<td  ><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"".$this->Dir."../images/employees/@01/@02\" /></td>";
		$sqlS = "SELECT *,lv029 lv199,'200000' lv150,DATEDIFF(CURRENT_DATE(),lv015)/365 lv053,DATEDIFF(CURRENT_DATE(),lv030)/365 lv047,(select count(*) from hr_lv0026 BB where BB.lv002=hr_lv0020.lv001) lv049,(select B.lv003 from hr_lv0033 A inner join hr_lv0008 B on A.lv003=B.lv001	 where A.lv002=hr_lv0020.lv001 order by B.lv003 DESC limit 0,1) lv050,IF(lv102>0,(lv102+round(replace(DATEDIFF(CurDate(),lv030)/(365*3),'.','.0'),0))/12,0) lv103 FROM hr_lv0020 WHERE 1=1  ".$this->GetConditionRpt()." $strSort LIMIT $curRow, $maxRows";
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
		if($this->isWork==4)
		{
			$vTemp=str_replace("@01","",$lvTdH);
			$vTemp=str_replace("@02",'Phụ thuộc',$vTemp);
			$strH=$strH.$vTemp;
		}
		elseif($this->isWork==3)
		{
			$vTemp=str_replace("@01","",$lvTdH);
			$vTemp=str_replace("@02",'Đánh giá',$vTemp);
			$strH=$strH.$vTemp;
		}		
		while ($vrow = db_fetch_array ($bResult)){
			$vSumTongTien=$vSumTongTien+$vrow['lv150'];
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=='lv007')
				{
					$vTemp=str_replace("@02",$vrow[$lstArr[$i]],str_replace("@01",$vrow['lv001'],$lvImg));

				}
				else if($lstArr[$i]=='lv048')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$vrow['lv001']),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv051')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_Get_HoiVien($vrow['lv001']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv047')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetChan($vrow[$lstArr[$i]]),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv001' && $_GET['func']=="excel")
				{
					$vTemp=str_replace("@02",'<Data ss:Type="String">="'.$vrow['lv001'].'"</Data>',$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}

			if($this->isWork==3)
			{
				$vTemp=str_replace("@02",$this->LV_GetDanhGia($vrow['lv001']),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			elseif($this->isWork==4)
			{
				$vTemp=str_replace("@02",$this->LV_GetDependence($vrow['lv001']),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv150-->",$this->FormatView($vSumTongTien,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function LV_BuilListReportAdvanceChildren1($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		
		$lvTable='<table style="width: 1302px;" border="0" cellspacing="0" cellpadding="0">
<colgroup><col width="40"></col> <col width="54"></col> <col width="59"></col> <col width="150"></col> <col width="95"></col> <col width="198"></col> <col width="188"></col> <col width="109"></col> <col width="204"></col> <col width="88"></col> <col width="117"></col> </colgroup> 
<tbody>
<tr height="33">
<td colspan="4" width="303" height="33"><strong>CÔNG TY CỔ PHẦN LẠC ViỆT</strong></td>
<td width="95">&nbsp;</td>
<td width="198">&nbsp;</td>
<td width="188">&nbsp;</td>
<td width="109">&nbsp;</td>
<td width="204">&nbsp;</td>
<td width="88">&nbsp;</td>
<td width="117">&nbsp;</td>
</tr>
<tr height="33">
<td colspan="4" height="33">Khách   sạn The Imperial Vũng Tàu</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="33">
<td height="33" align="left" valign="top">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="40" height="33">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="4"><strong>THE IMPERIAL STAFF\'S   CHILDREN&nbsp; - '.getyear($this->DateCurrent).' (Up to '.$this->isuptoyearold.' years old)</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="33">
<td height="33">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="4">DANH S&Aacute;CH CON C&Aacute;N BỘ C&Ocirc;NG   NHẬN VI&Ecirc;N (đến '.$this->isuptoyearold.' TUỔI)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="46">
<td height="46">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="4"><textarea style="width:100%;border:0px #fff solid;">The Internationanal Children Day / Ngày quốc tế thiếu nhi 01/6/'.getyear($this->DateCurrent).'</textarea></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<table style="width: 1302px;" border="1" cellspacing="0" cellpadding="0">
<colgroup><col width="40"></col> <col width="54"></col> <col width="59"></col> <col width="150"></col> <col width="95"></col> <col width="198"></col> <col width="188"></col> <col width="109"></col> <col width="204"></col> <col width="88"></col> <col width="117"></col> </colgroup> 
<tbody>
<tr height="46">
<td width="40" height="46"><strong>No1</strong></td>
<td width="54"><strong>No2</strong></td>
<td width="59"><strong>Code</strong></td>
<td width="150"><strong>Surname</strong></td>
<td width="95"><strong>First Name</strong></td>
<td width="198"><strong>Department</strong></td>
<td width="188"><strong>Postion</strong></td>
<td width="109"><strong>No<br /> of children</strong></td>
<td width="204"><strong>Name of   children</strong></td>
<td width="88"><strong>Sex</strong></td>
<td width="117"><strong>Age</strong></td>
</tr>
@#01
</tbody>
</table>
';
$vTrDept='
<tr height="46">
<td height="46">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>@01</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td width="109">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>';
$vTr='
<tr height="46">
<td height="46">@01</td>
<td>@02</td>
<td>@03</td>
<td>@04</td>
<td>@05</td>
<td width="198">@06</td>
<td width="188">@07</td>
<td>@08</td>
<td>@09</td>
<td><center>@10</center></td>
<td><center>@11</center></td>
</tr>';
$vTrChild='
<tr height="46">
<td height="46">&nbsp;</td>
<td>@02</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td width="198">&nbsp;</td>
<td width="188">&nbsp;</td>
<td>&nbsp;</td>
<td>@09</td>
<td><center>@10</center></td>
<td><center>@11</center></td>
</tr>
';
		$vSex=Array(0=>'Female',1=>'Male');
		$vCodeEmp='';
		$vCodeDept='';
		 $strCondi='';
		if($this->lv304!="")  $strCondi=$strCondi." and DDD.lv004 in ('".str_replace(",","','",$this->lv304)."')";
		if($this->isPhuThuoc!="")  $strCondi=$strCondi." and DDD.lv011 ='$this->isPhuThuoc'";
		if($this->isuptoyearold!="")   $strCondi=$strCondi." and (((year(CURRENT_DATE())-year(DDD.lv005))*12+month(CURRENT_DATE())-month(DDD.lv005))/12) <='$this->isuptoyearold'";
		$sqlS = "SELECT A.*,(select count(DDD.lv001) from hr_lv0026 DDD  where A.lv001=DDD.lv002 $strCondi) CountChild,D.lv003 DeptName,(((year(CURRENT_DATE())-year(ABC.lv005))*12+month(CURRENT_DATE())-month(ABC.lv005))/12) tuoi,ABC.lv002 lv302,ABC.lv003 lv303,ABC.lv004 lv304,ABC.lv005 lv305,ABC.lv006 lv306,ABC.lv007 lv307,ABC.lv008 lv308,ABC.lv009 lv309,ABC.lv010 lv310,ABC.lv011 lv311,ABC.lv012 lv312,ABC.lv013 lv313,'200000' lv150,DATEDIFF(CURRENT_DATE(),A.lv015)/365 lv053,DATEDIFF(CURRENT_DATE(),A.lv030)/365 lv047,(select count(*) from hr_lv0026 BB where BB.lv002=A.lv001) lv049,(select B.lv003 from hr_lv0033 AA inner join hr_lv0008 B on AA.lv003=B.lv001	 where AA.lv002=A.lv001 order by B.lv003 DESC limit 0,1) lv050,IF(lv102>0,(lv102+round(replace(DATEDIFF(CurDate(),A.lv030)/(365*3),'.','.0'),0))/12,0) lv103 FROM hr_lv0020 A inner join hr_lv0026 ABC on A.lv001=ABC.lv002 inner join hr_lv0002 D on A.lv029=D.lv001 WHERE 1=1  ".$this->GetConditionRptChild()." order by A.lv029,A.lv001,ABC.lv005 LIMIT 0, 10000";
		$bResult=db_query($sqlS);
		$vstt=1;
		while ($vrow = db_fetch_array ($bResult)){
			if($vCodeDept!=$vrow['lv029'])
			{
				$vCodeDept=$vrow['lv029'];
				$strTr=$strTr.str_replace("@01",$vrow['DeptName'],$vTrDept);
			}
			
			$vSumTongTien=$vSumTongTien+$vrow['lv150'];
			$strL="";
			if($vCodeEmp!=$vrow['lv001'])
			{	
				$vCodeEmp=$vrow['lv001'];
				$vTrTemp=$vTr;
				$vorder++;
				if($lstArr[$i]=='lv001' && $_GET['func']=="excel")
				{
					$vTemp=str_replace("@02",'<Data ss:Type="String">="'.$vrow['lv001'].'"</Data>',$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
					
			}
			else
			{
				$vTrTemp=$vTrChild;
			}
			$vArrName= explode(" ",trim($vrow['lv002']));
			$vFirtName=$vArrName[count($vArrName)-1];
			$vTrTemp=str_replace("@01",$vorder,$vTrTemp);
			$vTrTemp=str_replace("@02",$vstt,$vTrTemp);
			$vTrTemp=str_replace("@03",$vrow['lv001'],$vTrTemp);
			$vTrTemp=str_replace("@04",str_replace($vFirtName,'',$vrow['lv002']),$vTrTemp);
			$vTrTemp=str_replace("@05",$vFirtName,$vTrTemp);
			$vTrTemp=str_replace("@06",$vrow['DeptName'],$vTrTemp);
			$vTrTemp=str_replace("@07",$vrow['lv005'],$vTrTemp);
			$vTrTemp=str_replace("@08",$vrow['CountChild'],$vTrTemp);
			$vTrTemp=str_replace("@09",$vrow['lv303'],$vTrTemp);
			$vTrTemp=str_replace("@10",$vSex[$vrow['lv312']],$vTrTemp);
			$vTrTemp=str_replace("@11",$this->FormatView($vrow['lv305'],2),$vTrTemp);
			$strTr=$strTr.$vTrTemp;
			$vstt++;
			
		}

		return str_replace("@#01",$strTr,$lvTable);
	}
	function LV_BuilListReportAdvanceChildren($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		$this->DefaultFieldList=$this->DefaultFieldList.",lv303,lv304,lv305,lv306,lv307,lv308,lv310,lv309,lv311,lv312,lv313";
		if($lvList=="") $lvList=$this->DefaultFieldList.",lv303,lv304,lv305,lv306,lv307,lv308,lv310,lv309,lv311,lv312,lv313";
		else
		$lvList=$lvList.",lv303,lv304,lv305,lv306,lv307,lv308,lv310,lv309,lv311,lv312,lv313";
		$lvOrderList=$lvOrderList.',303,304,305,306,307,308,309,310,311,312,313';
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
		$lvTd="<td align=@#05>@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"1\">&nbsp;</td>";
		$lvImg="<td  ><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"../../images/employees/@01/@02\" /></td>";
		$sqlS = "SELECT A.*,(((year(CURRENT_DATE())-year(ABC.lv005))*12+month(CURRENT_DATE())-month(ABC.lv005))/12) tuoi,ABC.lv002 lv302,ABC.lv003 lv303,ABC.lv004 lv304,ABC.lv005 lv305,ABC.lv006 lv306,ABC.lv007 lv307,ABC.lv008 lv308,ABC.lv009 lv309,ABC.lv010 lv310,ABC.lv011 lv311,ABC.lv012 lv312,ABC.lv013 lv313,'200000' lv150,DATEDIFF(CURRENT_DATE(),A.lv015)/365 lv053,DATEDIFF(CURRENT_DATE(),A.lv030)/365 lv047,(select count(*) from hr_lv0026 BB where BB.lv002=A.lv001) lv049,(select B.lv003 from hr_lv0033 AA inner join hr_lv0008 B on AA.lv003=B.lv001	 where AA.lv002=A.lv001 order by B.lv003 DESC limit 0,1) lv050,IF(lv102>0,(lv102+round(replace(DATEDIFF(CurDate(),A.lv030)/(365*3),'.','.0'),0))/12,0) lv103 FROM hr_lv0020 A inner join hr_lv0026 ABC on A.lv001=ABC.lv002 WHERE 1=1  ".$this->GetConditionRptChild()." order by A.lv001,ABC.lv005 LIMIT $curRow, $maxRows";
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
		if($this->isWork==4)
		{
			$vTemp=str_replace("@01","",$lvTdH);
			$vTemp=str_replace("@02",'Phụ thuộc',$vTemp);
			$strH=$strH.$vTemp;
		}
		elseif($this->isWork==3)
		{
			$vTemp=str_replace("@01","",$lvTdH);
			$vTemp=str_replace("@02",'Đánh giá',$vTemp);
			$strH=$strH.$vTemp;
		}
		$vCodeEmp='';
		while ($vrow = db_fetch_array ($bResult)){
			$vSumTongTien=$vSumTongTien+$vrow['lv150'];
			$strL="";
			if($vCodeEmp!=$vrow['lv001'])
			{	
				$vCodeEmp=$vrow['lv001'];
				$vorder++;
				for($i=0;$i<count($lstArr);$i++)
				{
					if($lstArr[$i]=='lv007')
					{
						$vTemp=str_replace("@02",$vrow[$lstArr[$i]],str_replace("@01",$vrow['lv001'],$lvImg));

					}
					else if($lstArr[$i]=='lv048')
					{
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$vrow['lv001']),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
					else if($lstArr[$i]=='lv051')
					{
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_Get_HoiVien($vrow['lv001']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
					else if($lstArr[$i]=='lv047')
					{
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetChan($vrow[$lstArr[$i]]),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
					else if($lstArr[$i]=='lv001' && $_GET['func']=="excel")
					{
						$vTemp=str_replace("@02",'<Data ss:Type="String">="'.$vrow['lv001'].'"</Data>',$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
					else
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$strL=$strL.$vTemp;
				}
				$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			}
			else
			{
				for($i=0;$i<count($lstArr);$i++)
				{
					if(substr($lstArr[$i],2,3)>=300)
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));	
					else
						$vTemp=str_replace("@02",'&nbsp;',$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					$strL=$strL.$vTemp;
				}
				$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",'&nbsp;',str_replace("@01",$vorder%2,$lvTr))));
			}			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv150-->",$this->FormatView($vSumTongTien,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function LV_GetContractHeader()
	{
		if($this->LSContract!='') $vCondition=" and lv001 in (".$this->LSContract.")";
		else	
			return '';
		$vlv839=$this->lv839;
		$lvsql="select * from hr_lv0039 where 1=1 $vCondition order by lv003";
		$vresult=db_query($lvsql);
		$this->C_Header='';
		$this->C_TD='';
		while($vrow=db_fetch_array($vresult))
		{
			$this->C_Header=$this->C_Header.'<td width="@01" class="lvhtable">'.$vrow['lv002'].'</td>';
			$this->C_TD=$this->C_TD.'<td><!--'.$vrow['lv001'].'--></td>';
		}
	}
	function LV_FillContractTD($vEmpID,&$vArrContractSave)
	{
		$lvparatimecard=explode(",",$this->paratimecard);
		if($this->LSContract!='') $vCondition=" and A.lv003 in (".$this->LSContract.")";
		$lvsql="
		SELECT MP.* FROM (
			select A.lv001,A.lv003,A.lv004,A.lv005,A.lv009,A.lv010,A.lv021,A.lv022,A.lv023,A.lv024,A.lv025,A.lv027,A.lv028 from hr_lv0038 A where A.lv002='".$vEmpID."' $vCondition
			UNION
			select A.lv001,A.lv003,A.lv004,A.lv005,A.lv009,B.lv006 lv010,A.lv021,A.lv022,A.lv023,A.lv024,A.lv025,B.lv010 lv027,B.lv011 lv028 from hr_lv0038 A inner join hr_lv0098 B on B.lv099=A.lv001 where A.lv002='".$vEmpID."' $vCondition
		) MP order by MP.lv004 ASC";
		$vresult=db_query($lvsql);
		$vArrContractSave=Array();
		$vTable='
		
		';
		while($vrow=db_fetch_array($vresult))
		{
			$vTdSave='';
			$vTdHead='';
			$vArrContractSave[0]=$vContract;
			$vArrContractSave[1]=$vrow['lv001'];
			$vArrContractSave[11]='';
			$vArrContractSave[12]='';
			$vArrContractSave[13]='';
			$vArrContractSave[21]='';
			$vArrContractSave[22]='';
			$vArrContractSave[23]='';
			$vArrContractSave[31]='';
			$vArrContractSave[32]='';
			$vArrContractSave[33]='';
			foreach($lvparatimecard as $lvgt)
			{
				switch ($lvgt)
				{
					case 1:
						$vSave='<td width="20%" style="border-right:1px #8e8e8e solid;border-top:1px #8e8e8e solid;"><div class="csscontract">'.$this->FormatView($vrow['lv004'],2).'->'.$this->FormatView($vrow['lv005'],2).'</div></td>';
						$vHead='<td style="border:1px #8e8e8e solid;font-weight:bold;text-align:center;">Ngày</td>';
						//Ngày hợp đồng
						$vArrContractSave[11]=$vArrContractSave[11].$vSave;
						$vArrContractSave[21]=$vArrContractSave[21].$vHead;
						$vArrContractSave[12]=$vArrContractSave[12].$vSave;
						$vArrContractSave[22]=$vArrContractSave[22].$vHead;
						$vArrContractSave[13]=$vArrContractSave[13].$vSave;
						$vArrContractSave[23]=$vArrContractSave[23].$vHead;
						$vTdSave=$vTdSave.$vSave;
						$vTdHead=$vTdHead.$vHead;
						break;
					case 2:
						//Lương chính
						
						$vSave='<td width="15%" style="border-right:1px #8e8e8e solid;border-top:1px #8e8e8e solid;"><div class="csscontract">'.$this->FormatView($vrow['lv022'],10).'</div></td>';
						$vHead='<td style="border:1px #8e8e8e solid;font-weight:bold;text-align:center;">Lương chính</td>';
						$vArrContractSave[11]=$vArrContractSave[11].$vSave;
						$vArrContractSave[21]=$vArrContractSave[21].$vHead;
						$vTdSave=$vTdSave.$vSave;
						$vTdHead=$vTdHead.$vHead;
						break;
					case 3:
						
						$vSave='<td width="15%" style="border-right:1px #8e8e8e solid;border-top:1px #8e8e8e solid;"><div class="csscontract">'.$this->FormatView($vrow['lv023'],10).'</div></td>';
						$vHead='<td style="border:1px #8e8e8e solid;font-weight:bold;text-align:center;">Thưởng</td>';
						//Lương thưởng
						$vArrContractSave[11]=$vArrContractSave[11].$vSave;
						$vArrContractSave[21]=$vArrContractSave[21].$vHead;
						$vTdSave=$vTdSave.$vSave;
						$vTdHead=$vTdHead.$vHead;
						break;
					case 4:
						$vSave='<td width="15%" style="border-right:1px #8e8e8e solid;border-top:1px #8e8e8e solid;"><div class="csscontract">'.$this->FormatView($vrow['lv025'],10).'</div></td>';
						$vHead='<td style="border:1px #8e8e8e solid;font-weight:bold;text-align:center;">Thưởng khác</td>';
						//Lương thưởng khác
						$vArrContractSave[11]=$vArrContractSave[11].$vSave;
						$vArrContractSave[21]=$vArrContractSave[21].$vHead;
						$vTdSave=$vTdSave.$vSave;
						$vTdHead=$vTdHead.$vHead;
						break;
					case 5:
						$vSave='<td width="15%" style="border-right:1px #8e8e8e solid;border-top:1px #8e8e8e solid;"><div class="csscontract">'.$this->FormatView($vrow['lv021'],10).'</div></td>';
						$vHead='<td style="border:1px #8e8e8e solid;font-weight:bold;text-align:center;">Lương BH</td>';
						//Lương bảo hiểm
						$vArrContractSave[11]=$vArrContractSave[11].$vSave;
						$vArrContractSave[21]=$vArrContractSave[21].$vHead;
						$vTdSave=$vTdSave.$vSave;
						$vTdHead=$vTdHead.$vHead;
						break;
					case 6:
						$vSave='<td width="5%" style="border-right:1px #8e8e8e solid;border-top:1px #8e8e8e solid;"><div class="csscontract">'.$vrow['lv024'].'</div></td>';
						$vHead='<td style="border:1px #8e8e8e solid;font-weight:bold;text-align:center;">ĐV</td>';
						//Đơn vị
						$vArrContractSave[11]=$vArrContractSave[11].$vSave;
						$vArrContractSave[21]=$vArrContractSave[21].$vHead;
						$vTdSave=$vTdSave.$vSave;
						$vTdHead=$vTdHead.$vHead;
						break;
					case 7:
						$vSave='<td width="15%" style="border-right:1px #8e8e8e solid;border-top:1px #8e8e8e solid;"><div class="csscontract">'.$vrow['lv010'].'</div></td>';
						$vHead='<td style="border:1px #8e8e8e solid;font-weight:bold;text-align:center;">Phòng Ban</td>';
						$vArrContractSave[12]=$vArrContractSave[12].$vSave;
						$vArrContractSave[22]=$vArrContractSave[22].$vHead;
						$vTdSave=$vTdSave.$vSave;
						$vTdHead=$vTdHead.$vHead;
						//Phòng ban
						break;
					case 8:
						$vSave='<td width="15%" style="border-right:1px #8e8e8e solid;border-top:1px #8e8e8e solid;"><div class="csscontract">'.$vrow['lv009'].'</div></td>';
						$vHead='<td style="border:1px #8e8e8e solid;font-weight:bold;text-align:center;">Trạng thái</td>';
						$vArrContractSave[11]=$vArrContractSave[11].$vSave;
						$vArrContractSave[21]=$vArrContractSave[21].$vHead;
						$vArrContractSave[12]=$vArrContractSave[12].$vSave;
						$vArrContractSave[22]=$vArrContractSave[22].$vHead;
						$vArrContractSave[13]=$vArrContractSave[13].$vSave;
						$vArrContractSave[23]=$vArrContractSave[23].$vHead;
						$vTdSave=$vTdSave.$vSave;
						$vTdHead=$vTdHead.$vHead;
						//Trạng thái HĐ
						break;
					case 9:
						$vSave='<td width="15%" style="border-right:1px #8e8e8e solid;border-top:1px #8e8e8e solid;"><div class="csscontract">'.$vrow['lv027'].'/'.$vrow['lv028'].'</div></td>';
						$vHead='<td style="border:1px #8e8e8e solid;font-weight:bold;text-align:center;">Chức vụ</td>';
						$vArrContractSave[13]=$vArrContractSave[13].$vSave;
						$vArrContractSave[23]=$vArrContractSave[23].$vHead;
						$vTdSave=$vTdSave.$vSave;
						$vTdHead=$vTdHead.$vHead;
						//Trạng thái HĐ
						break;
					
						
				}
			}
			if($vTdSave!='')
			{
				$vTR='<tr>'.$vTdHead.'</tr>';
				if($this->isTitle!=1 ) $vTR='';
				
				$vTableSave='<table width="100%"  style="border:1px #8e8e8e solid;" cellpadding=0 cellspacing=0>
				'.$vTR.'				
				<!--@#-01-->
				</table>';
			}
			else
			{
				$vTdSave='<div class="csscontract">'.$this->FormatView($vrow['lv004'],2).'->'.$this->FormatView($vrow['lv005'],2).'</div>';
			}
			if($vArrContract[$vrow['lv003']][1]!=NULL) 
			{
				$vArrContract[$vrow['lv003']][0]=str_replace("<!--@#-01-->",'<tr>'.$vTdSave.'</tr>'."<!--@#-01-->",$vArrContract[$vrow['lv003']][0]);
				$vArrContract[$vrow['lv003']][1]=$vrow['lv003'];
			}
			else
			{
				$vArrContract[$vrow['lv003']][1]=$vrow['lv003'];
				$vArrContract[$vrow['lv003']][0]=str_replace("<!--@#-01-->",'<tr>'.$vTdSave.'</tr>'."<!--@#-01-->",$vTableSave);
			}
			//Luong
			if($vArrContractSave[11]!='')
			{
				$vTR='<tr>'.$vArrContractSave[21].'</tr>';
				if($this->isTitle!=1 ) $vTR='';
				
				$vTableSave1='<table width="100%"  style="border:1px #8e8e8e solid;" cellpadding=0 cellspacing=0>
				'.$vTR.'				
				<!--@#-01-->
				</table>';
			}
			else
			{
				$vArrContractSave[11]='<div class="csscontract">'.$this->FormatView($vrow['lv004'],2).'->'.$this->FormatView($vrow['lv005'],2).'</div>';
			}
			if($vArrContract1[$vrow['lv003']][1]!=NULL) 
			{
				$vArrContract1[$vrow['lv003']][0]=str_replace("<!--@#-01-->",'<tr>'.$vArrContractSave[11].'</tr>'."<!--@#-01-->",$vArrContract1[$vrow['lv003']][0]);
				$vArrContract1[$vrow['lv003']][1]=$vrow['lv003'];
			}
			else
			{
				$vArrContract1[$vrow['lv003']][1]=$vrow['lv003'];
				$vArrContract1[$vrow['lv003']][0]=str_replace("<!--@#-01-->",'<tr>'.$vArrContractSave[11].'</tr>'."<!--@#-01-->",$vTableSave1);
			}
			//OutLet
			if($vArrContractSave[12]!='')
			{
				$vTR='<tr>'.$vArrContractSave[22].'</tr>';
				if($this->isTitle!=1 ) $vTR='';
				
				$vTableSave2='<table width="100%"  style="border:1px #8e8e8e solid;" cellpadding=0 cellspacing=0>
				'.$vTR.'				
				<!--@#-01-->
				</table>';
			}
			else
			{
				$vArrContractSave[12]='<div class="csscontract">'.$this->FormatView($vrow['lv004'],2).'->'.$this->FormatView($vrow['lv005'],2).'</div>';
			}
			if($vArrContract2[$vrow['lv003']][1]!=NULL) 
			{
				$vArrContract2[$vrow['lv003']][0]=str_replace("<!--@#-01-->",'<tr>'.$vArrContractSave[12].'</tr>'."<!--@#-01-->",$vArrContract2[$vrow['lv003']][0]);
				$vArrContract2[$vrow['lv003']][1]=$vrow['lv003'];
			}
			else
			{
				$vArrContract2[$vrow['lv003']][1]=$vrow['lv003'];
				$vArrContract2[$vrow['lv003']][0]=str_replace("<!--@#-01-->",'<tr>'.$vArrContractSave[12].'</tr>'."<!--@#-01-->",$vTableSave2);
			}
			//Chức vụ
			if($vArrContractSave[13]!='')
			{
				$vTR='<tr>'.$vArrContractSave[23].'</tr>';
				if($this->isTitle!=1 ) $vTR='';
				
				$vTableSave3='<table width="100%"  style="border:1px #8e8e8e solid;" cellpadding=0 cellspacing=0>
				'.$vTR.'				
				<!--@#-01-->
				</table>';
			}
			else
			{
				$vArrContractSave[13]='<div class="csscontract">'.$this->FormatView($vrow['lv004'],2).'->'.$this->FormatView($vrow['lv005'],2).'</div>';
			}
			if($vArrContract3[$vrow['lv003']][1]!=NULL) 
			{
				$vArrContract3[$vrow['lv003']][0]=str_replace("<!--@#-01-->",'<tr>'.$vArrContractSave[13].'</tr>'."<!--@#-01-->",$vArrContract3[$vrow['lv003']][0]);
				$vArrContract3[$vrow['lv003']][1]=$vrow['lv003'];
			}
			else
			{
				$vArrContract3[$vrow['lv003']][1]=$vrow['lv003'];
				$vArrContract3[$vrow['lv003']][0]=str_replace("<!--@#-01-->",'<tr>'.$vArrContractSave[13].'</tr>'."<!--@#-01-->",$vTableSave3);
			}
			
			$vContract=$vrow['lv001'];	
		}
		$vTdContract=$this->C_TD;
		if($vArrContract!=NULL) {
			foreach($vArrContract as $ArrC)
			{
				if($ArrC[0]=='<' || is_numeric($ArrC[0])) $ArrC[0]='';
				$vTdContract=str_replace('<!--'.$ArrC[1].'-->',$ArrC[0].'',$vTdContract);
			}
		}
		//Lương
		$vArrContractSave[31]=$this->C_TD;
		if($vArrContract1!=NULL) {
			foreach($vArrContract1 as $ArrC)
			{
				if($ArrC[0]=='<' || is_numeric($ArrC[0])) $ArrC[0]='';
				$vArrContractSave[31]=str_replace('<!--'.$ArrC[1].'-->',$ArrC[0].'',$vArrContractSave[31]);
			}
		}
		//OutLet
		$vArrContractSave[32]=$this->C_TD;
		if($vArrContract2!=NULL) {
			foreach($vArrContract2 as $ArrC)
			{
				if($ArrC[0]=='<' || is_numeric($ArrC[0])) $ArrC[0]='';
				$vArrContractSave[32]=str_replace('<!--'.$ArrC[1].'-->',$ArrC[0].'',$vArrContractSave[32]);
			}
		}
		//Chức vụ
		$vArrContractSave[33]=$this->C_TD;
		if($vArrContract3!=NULL) {
			foreach($vArrContract3 as $ArrC)
			{
				if($ArrC[0]=='<' || is_numeric($ArrC[0])) $ArrC[0]='';
				$vArrContractSave[33]=str_replace('<!--'.$ArrC[1].'-->',$ArrC[0].'',$vArrContractSave[33]);
			}
		}
		return $vTdContract;
	}
	function LV_ConfirmHD($vContractID,$vOldContractID)
	{
		$vrow1=$this->LV_GetHD($vContractID);
		$vrow2=$this->LV_GetHD($vOldContractID);
		if($vrow1['lv011']==$vrow2['lv011'] && $vrow1['lv012']==$vrow2['lv012'] && $vrow1['lv013']==$vrow2['lv013'] && $vrow1['lv014']==$vrow2['lv014'] && $vrow1['lv015']==$vrow2['lv015'] && $vrow1['lv016']==$vrow2['lv016']  && $vrow1['lv018']==$vrow2['lv018'] && $vrow1['lv019']==$vrow2['lv019'] && $vrow1['lv020']==$vrow2['lv020'] && $vrow1['lv021']==$vrow2['lv021'] && $vrow1['lv022']==$vrow2['lv022'] && $vrow1['lv023']==$vrow2['lv023'] && $vrow1['lv024']==$vrow2['lv024'] && $vrow1['lv025']==$vrow2['lv025'] && $vrow1['lv026']==$vrow2['lv026'])
		$vContractCompare['T'.$vContractID.'-'.$vOldContractID][1]=0;
		else
		$vContractCompare[1]=1;
		if($vrow1['lv010']==$vrow2['lv010'] )
			$vContractCompare[2]=0;
		else
			$vContractCompare[2]=1;
		if($vrow1['lv027']==$vrow2['lv027'] && $vrow1['lv028']==$vrow2['lv028'] )
			$vContractCompare[3]=0;
		else
			$vContractCompare[3]=1;
		//echo $vrow1['lv003'];
		$vContractCompare[4]=(($vrow1['lv003']==9)?1:0);
		return $vContractCompare;
	}
	function LV_GetHD($vConTractID)
	{
		$vsql="select lv003,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027,lv028 from hr_lv0038 where lv001='$vConTractID'";
		$vresult=db_query($vsql);
		$strReturn="";
		return db_fetch_array($vresult);
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportAdvanceContractMore($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
	{
		$vSaveGroup=Array();
		$this->LV_GetContractHeader();
		$vArrState=Array(0=>'Không',1=>'Có');
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$strSort="";
		$vSaveGroup[1]=="";
		$vSaveGroup[2]=="";
		$vSaveGroup[3]=="";
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
		<div style='height:60px;font:bold 24px Arial,Tahoma;text-align:left'><br/>@#03</div>
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
		$lvTd="<td align=@#05>@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"1\">&nbsp;</td>";
		$lvImg="<td  ><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"../../images/employees/@01/@02\" /></td>";
		$sqlS = "SELECT *,'200000' lv150,DATEDIFF(CURRENT_DATE(),lv015)/365 lv053,DATEDIFF(CURRENT_DATE(),lv030)/365 lv047,(select count(*) from hr_lv0026 BB where BB.lv002=hr_lv0020.lv001) lv049,(select B.lv003 from hr_lv0033 A inner join hr_lv0008 B on A.lv003=B.lv001	 where A.lv002=hr_lv0020.lv001 order by B.lv003 DESC limit 0,1) lv050,IF(lv102>0,(lv102+round(replace(DATEDIFF(CurDate(),lv030)/(365*3),'.','.0'),0))/12,0) lv103 FROM hr_lv0020 WHERE 1=1  ".$this->GetContractLaborRpt()." $strSort LIMIT $curRow, $maxRows";
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
			$strH=$strH.$this->C_Header;
			if($this->isType==1 || $this->isType==3)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",'Tình trạng',$vTemp);
				$strH=$strH.$vTemp;
			}
		while ($vrow = db_fetch_array ($bResult)){
			$vStrSateContract='';
			$vSumTongTien=$vSumTongTien+$vrow['lv150'];
			$strL="";
			$strL1="";
			$strL2="";
			$strL3="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=='lv007')
				{
					$vTemp=str_replace("@02",$vrow[$lstArr[$i]],str_replace("@01",$vrow['lv001'],$lvImg));

				}
				else if($lstArr[$i]=='lv048')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$vrow['lv001']),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv051')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_Get_HoiVien($vrow['lv001']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv047')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetChan($vrow[$lstArr[$i]]),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv001' && $_GET['func']=="excel")
				{
					$vTemp=str_replace("@02",'<Data ss:Type="String">="'.$vrow['lv001'].'"</Data>',$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$vArrContract=Array();
			$strLFull=$this->LV_FillContractTD($vrow['lv001'],$vArrContract);
			$strL1=$strL.$vArrContract[31];
			$strL2=$strL.$vArrContract[32];
			$strL3=$strL.$vArrContract[33];
			$strL=$strL.$strLFull;
			
			if($this->isType==1 || $this->isType==3)
			{
				if($vArrContract[0]!=0 && $vArrContract[1]!=0)
				{
					$vArrContractState=$this->LV_ConfirmHD($vArrContract[0],$vArrContract[1]);
					if($vArrContractState[1]==0 && $vArrContractState[2]==0 && $vArrContractState[3]==0)
					{
							$vStrSateContract='';
					}
					else
					{
					$vStrSateContract=$vStrSateContract.'Lương:'.$vArrState[$vArrContractState[1]];
					$vStrSateContract=$vStrSateContract.',Outlet:'.$vArrState[$vArrContractState[2]];
					$vStrSateContract=$vStrSateContract.',Chức vụ:'.$vArrState[$vArrContractState[3]];
					if($vArrContractState[4]==1) $vStrSateContract=$vStrSateContract.',Nghỉ việc:'.$vArrState[$vArrContractState[4]];
					}
				}
				else
					$vStrSateContract='';
				
				$strL=$strL.str_replace("@02",$vStrSateContract,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL1=$strL1.str_replace("@02",$vStrSateContract,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL2=$strL2.str_replace("@02",$vStrSateContract,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL3=$strL3.str_replace("@02",$vStrSateContract,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				if($vStrSateContract!='')
				{
					if($vArrContractState[1]==1)
					{
						$vorder1++;
						$vSaveGroup[1]=$vSaveGroup[1].str_replace("@#01",$strL1,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder1,str_replace("@01",$vorder1%2,$lvTr))));
					}
					if($vArrContractState[2]==1) {
						$vorder2++;
						$vSaveGroup[2]=$vSaveGroup[2].str_replace("@#01",$strL2,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder2,str_replace("@01",$vorder2%2,$lvTr))));
					}
					if($vArrContractState[3]==1) {
						$vorder3++;
						$vSaveGroup[3]=$vSaveGroup[3].str_replace("@#01",$strL3,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder3,str_replace("@01",$vorder3%2,$lvTr))));
					}
					$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
				}
			}
			else
				$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv150-->",$this->FormatView($vSumTongTien,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		if($this->isType==3)
		{
			if($vSaveGroup[1]!=""){
				
				echo str_replace("@#01",$strTrH.$vSaveGroup[1],str_replace("@#03",'THAY ĐỔI LƯƠNG',$lvTable));
			}
			if($vSaveGroup[2]!="") echo str_replace("@#01",$strTrH.$vSaveGroup[2],str_replace("@#03",'THAY ĐỔI OUTLET',$lvTable));
			if($vSaveGroup[3]!="") echo str_replace("@#01",$strTrH.$vSaveGroup[3],str_replace("@#03",'THAY ĐỔI CHỨC VỤ',$lvTable));	
			return;
		}
		else
			return str_replace("@#01",$strTrH.$strTr,str_replace("@#03",'',$lvTable));
	}
	function LV_BuilListReportAdvanceContract($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
	{
			
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lvList='lv000,lv0000,'.$lvList;
		$lstArr=explode(",",$lvList);
		$lvOrderList='0.0,0,'.$lvOrderList;
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
		$lvImg="<td  ><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"../../images/employees/@01/@02\" /></td>";
		$sqlS = "SELECT A.lv003 lv000,C.lv002 TypeContractName,B.*,DATEDIFF(CURRENT_DATE(),B.lv015)/365 lv053,DATEDIFF(CURRENT_DATE(),B.lv030)/365 lv047,(select count(*) from hr_lv0026 BB where BB.lv002=B.lv001) lv049,(select AA.lv003 from hr_lv0033 AA inner join hr_lv0008 B on AA.lv003=B.lv001	 where AA.lv002=B.lv001 order by B.lv003 DESC limit 0,1) lv050 FROM hr_lv0038 A inner join hr_lv0020 B on A.lv002=B.lv001 and A.lv009=1 left join hr_lv0039 C on C.lv001=A.lv003 WHERE 1=1  ".$this->GetConditionRptContract()." order by A.lv003,B.lv001 ASC";
		$vorder=$curRow;
		$vorder1=1;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		for($i=0;$i<count($lstArr);$i++)
			{
				
				$vTemp=str_replace("@01","",$lvTdH);
				if($lstArr[$i]=='lv000')
				{
					$vTemp=str_replace("@02","Lo?i h?p d?ng",$vTemp);
				}
				elseif($lstArr[$i]=='lv0000')
				{
					$vTemp=str_replace("@02","Số thứ tự",$vTemp);
				}
				else
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			$strDepart="";
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vorder1++;
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=='lv000')
				{
					if(strpos($strDepart,$vrow['lv000'].'')===false)
					{
						$strTr=str_replace("@!001",$vorder1-1,$strTr);
						$vorder1=1;
						$vTemp=str_replace("@02","<strong>".$vrow['TypeContractName']."(@!001)"."</strong>",$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						$strDepart=$strDepart.$vrow['lv000']."@";
					}
					else
					{
						$vTemp=str_replace("@02",'&nbsp;',$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
				}
				else if($lstArr[$i]=='lv0000')
				{
					$vTemp=str_replace("@02",$vorder1,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv007')
				{
					$vTemp=str_replace("@02",$vrow[$lstArr[$i]],str_replace("@01",$vrow['lv001'],$lvImg));

				}
				else if($lstArr[$i]=='lv048')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$vrow['lv001']),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv051')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_Get_HoiVien($vrow['lv001']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv047')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetChan($vrow[$lstArr[$i]]),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv001' && $_GET['func']=="excel")
				{
					$vTemp=str_replace("@02",'<Data ss:Type="String">="'.$vrow['lv001'].'"</Data>',$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}

			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
			
		}
		$strTr=str_replace("@!001",$vorder1,$strTr);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function LV_BuilListReportAdvanceDegree($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
	{
			
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lvList='lv000,lv0000,'.$lvList;
		$lstArr=explode(",",$lvList);
		$lvOrderList='0.0,0,'.$lvOrderList;
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
		$lvImg="<td  ><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"../../images/employees/@01/@02\" /></td>";
		$sqlS = "SELECT A.lv001 lv000,A.lv002 TypeContractName,B.*,DATEDIFF(CURRENT_DATE(),B.lv015)/365 lv053,DATEDIFF(CURRENT_DATE(),B.lv030)/365 lv047,(select count(*) from hr_lv0026 BB where BB.lv002=B.lv001) lv049,(select AA.lv003 from hr_lv0033 AA inner join hr_lv0008 B on AA.lv003=B.lv001	 where AA.lv002=B.lv001 order by B.lv003 DESC limit 0,1) lv050 FROM hr_lv0020 B left join hr_lv0005 A on A.lv001=B.lv028 WHERE 1=1  ".$this->GetConditionRptContract()." order by B.lv028,B.lv001 ASC";
		$vorder=$curRow;
		$vorder1=1;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		for($i=0;$i<count($lstArr);$i++)
			{
				
				$vTemp=str_replace("@01","",$lvTdH);
				if($lstArr[$i]=='lv000')
				{
					$vTemp=str_replace("@02","Tr?h d?",$vTemp);
				}
				elseif($lstArr[$i]=='lv0000')
				{
					$vTemp=str_replace("@02","Số thứ tự",$vTemp);
				}
				else
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			$strDepart="";
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vorder1++;
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=='lv000')
				{
					if(strpos($strDepart,$vrow['lv000'].'')===false)
					{
						$strTr=str_replace("@!001",$vorder1-1,$strTr);
						$vorder1=1;
						$vTemp=str_replace("@02","<strong>".$vrow['TypeContractName']."(@!001)"."<strong>",$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						$strDepart=$strDepart.$vrow['lv000']."@";
					}
					else
					{
						$vTemp=str_replace("@02",'&nbsp;',$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
				}
				else if($lstArr[$i]=='lv0000')
				{
					$vTemp=str_replace("@02",$vorder1,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv007')
				{
					$vTemp=str_replace("@02",$vrow[$lstArr[$i]],str_replace("@01",$vrow['lv001'],$lvImg));

				}
				else if($lstArr[$i]=='lv048')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$vrow['lv001']),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv051')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_Get_HoiVien($vrow['lv001']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv047')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetChan($vrow[$lstArr[$i]]),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv001' && $_GET['func']=="excel")
				{
					$vTemp=str_replace("@02",'<Data ss:Type="String">="'.$vrow['lv001'].'"</Data>',$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}

			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
			
		}
		$strTr=str_replace("@!001",$vorder1-1,$strTr);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function GetConditionRptContract()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and B.lv001  like '%$this->lv001%'";
		if($this->lv026!="") $strCondi=$strCondi." and B.lv026  like '%$this->lv026%'";
		if($this->lv018!="") $strCondi=$strCondi." and B.lv018 ='$this->lv018'";
		if($this->lv009!="")  $strCondi=$strCondi." and B.lv009 in ('".str_replace(",","','",$this->lv009)."')";
		if($this->lv028!="")  
		{
			$strCondi=$strCondi." and B.lv028 in ('".str_replace(",","','",$this->lv028)."')";
		}
		if($this->lv029!="")  
		{
			$strCondi=$strCondi." and B.lv029 in (".$this->LV_GetDep($this->lv029).")";
		}
		if($this->lv042!="")  
		{
			$strCondi=$strCondi." and B.lv042 in ('".str_replace(",","','",$this->lv042)."')";
		}
		if($this->lv051!="")  
		{
			$strCondi=$strCondi." and A.lv003 in ('".str_replace(",","','",$this->lv051)."')";
		}
		
		if($this->dateworkfrom!="")
		{
			$strCondi=$strCondi." and A.lv005>= '".recoverdate($this->dateworkfrom, $this->lang)."'";
		}
		if($this->dateworkto!="")
		{
			$strCondi=$strCondi." and A.lv005<= '".recoverdate($this->dateworkto, $this->lang)."'";
		}
		
		if($this->typecontract!="")
		{
			$strCondi=$strCondi." and A.lv003 in ('".str_replace(",","','",$this->typecontract)."')";
		}
		return $strCondi;

	}
	function LV_BuilListReportAdvanceMember($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
	{
			
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lvList='lv000,lv0000,'.$lvList;
		$lstArr=explode(",",$lvList);
		$lvOrderList='0.0,0,'.$lvOrderList;
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
		$lvImg="<td  ><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"../../images/employees/@01/@02\" /></td>";
		$sqlS = "SELECT A.lv003 lv000,C.lv002 TypeContractName,B.*,DATEDIFF(CURRENT_DATE(),B.lv015)/365 lv053,DATEDIFF(CURRENT_DATE(),B.lv030)/365 lv047,(select AA.lv003 from hr_lv0033 AA inner join hr_lv0008 B on AA.lv003=B.lv001	 where AA.lv002=B.lv001 order by B.lv003 DESC limit 0,1) lv050 FROM hr_lv0034 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0013 C on C.lv001=A.lv003 WHERE 1=1  ".$this->GetConditionRptContract()." order by A.lv003,B.lv001 ASC";
		$vorder=$curRow;
		$vorder1=1;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		for($i=0;$i<count($lstArr);$i++)
			{
				
				$vTemp=str_replace("@01","",$lvTdH);
				if($lstArr[$i]=='lv000')
				{
					$vTemp=str_replace("@02","Hội viên",$vTemp);
				}
				elseif($lstArr[$i]=='lv0000')
				{
					$vTemp=str_replace("@02","Số thứ tự",$vTemp);
				}
				else
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			$strDepart="";
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vorder1++;
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=='lv000')
				{
					if(strpos($strDepart,$vrow['lv000'].'')===false)
					{
						$strTr=str_replace("@!001",$vorder1-1,$strTr);
						$vorder1=1;
						$vTemp=str_replace("@02","<strong>".$vrow['TypeContractName']."(@!001)"."<strong>",$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						$strDepart=$strDepart.$vrow['lv000']."@";
					}
					else
					{
						$vTemp=str_replace("@02",'&nbsp;',$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
				}
				else if($lstArr[$i]=='lv0000')
				{
					$vTemp=str_replace("@02",$vorder1,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv007')
				{
					$vTemp=str_replace("@02",$vrow[$lstArr[$i]],str_replace("@01",$vrow['lv001'],$lvImg));

				}
				else if($lstArr[$i]=='lv048')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$vrow['lv001']),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv051')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_Get_HoiVien($vrow['lv001']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv047')
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetChan($vrow[$lstArr[$i]]),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else if($lstArr[$i]=='lv001' && $_GET['func']=="excel")
				{
					$vTemp=str_replace("@02",'<Data ss:Type="String">="'.$vrow['lv001'].'"</Data>',$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}

			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
			
		}
		$strTr=str_replace("@!001",$vorder1,$strTr);
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
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0022";
				break;
			case 'lv017':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0021";
				break;
			case 'lv022':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014";
				break;
			case 'lv023':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0016";
				break;
			case 'lv024':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0017";
				break;
			case 'lv025':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0015";
				break;
			case 'lv026':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0007";
				break;
			case 'lv027':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0004";
				break;
			case 'lv028':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0005";
				break;
			case 'lv029':
				$vsql="select lv001,CONCAT(lv003,'[',lv002,']') lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002";
				break;
			case 'lv031':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014";
				break;
			case 'lv032':
				$vsql="select lv001,CONCAT(lv002,'[',lv003,']') lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0023	";
				break;
			case 'lv042':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020	";
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
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0022 where lv001='$vSelectID'";
				break;
			case 'lv017':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0021 where lv001='$vSelectID'";
				break;
			case 'lv018':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from (select 0 lv001,'Nữ' lv002 union select 1 lv001,'Nam' lv002) MP 	 where MP.lv001='$vSelectID'";
				break;
			case 'lv022':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014 where lv001='$vSelectID'";
				break;
			case 'lv023':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0016 where lv001='$vSelectID'";
				break;
			case 'lv024':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0017 where lv001='$vSelectID'";
				break;
			case 'lv025':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0015 where lv001='$vSelectID'";
				break;
			case 'lv027':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0004 where lv001='$vSelectID'";
				break;
			case 'lv028':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0005 where lv001='$vSelectID'";
				break;
			case 'lv029':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002 where lv001='$vSelectID'";
				break;
			case 'lv031':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0014  where lv001='$vSelectID'";
				break;
			case 'lv032':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from hr_lv0023 	 where lv001='$vSelectID'";
				break;
			case 'lv042':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from hr_lv0020  	 where lv001='$vSelectID'";
				break;
			case 'lv312':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from (select 0 lv001,'Nữ' lv002 union select 1 lv001,'Nam' lv002) MP 	 where MP.lv001='$vSelectID'";
				break;
			case 'lv199':
				return $this->LV_GetPBLon($vSelectID);
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