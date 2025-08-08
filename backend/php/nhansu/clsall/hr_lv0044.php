<?php
/////////////coding hr_lv0044///////////////
class   hr_lv0044 extends lv_controler
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

///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv015,lv011,lv012,lv013,lv014";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='hr_lv0044';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"2","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"1","lv013"=>"1","lv014"=>"1");	

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
		$vsql="select * from  hr_lv0044";
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
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  hr_lv0044 Where lv001='$vlv001'";
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
		}
	}
	function LV_LoadArr3a($vlv001,$vlv011)
	{
		$vArr=array();
		$lvsql="SELECT (SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv016>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) lv13001,(SELECT sum(A.lv016*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv016>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) lv15007,(SELECT sum(A.lv016*A.lv019*(A.lv007-A1.lv007)/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv016>0 AND A.lv007>A1.lv007) lv15008,(SELECT sum((A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv016>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) lv14001,(SELECT sum((A.lv007-A1.lv007)) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv016>0 AND A.lv007>A1.lv007) lv14002
		
,(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv017>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) lv19001,(SELECT sum(A.lv017*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv017>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) lv31007,(SELECT sum(A.lv017*A.lv019*(A.lv007-A1.lv007)/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv017>0 AND A.lv007>A1.lv007) lv31008,(SELECT sum((A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv017>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) lv30001,(SELECT sum((A.lv007-A1.lv007)) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv017>0 AND A.lv007>A1.lv007) lv30002		

,(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv015>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) lv07001,(SELECT sum(A.lv015*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv015>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) lv09007,(SELECT sum(A.lv015*A.lv019*(A.lv007-A1.lv007)/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv015>0 AND A.lv007>A1.lv007) lv09008,(SELECT sum((A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv015>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) lv08001,(SELECT sum((A.lv007-A1.lv007)) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv015>0 AND A.lv007>A1.lv007) lv08002	

,(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv016>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) lv16001
,(SELECT sum(A.lv016*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv016>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) lv18007,(SELECT sum(A.lv016*A.lv019*(A1.lv007-A.lv007)/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv016>0 AND A.lv007<A1.lv007) lv18008,(SELECT sum((A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv016>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) lv17001,(SELECT sum((A1.lv007-A.lv007)) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv016>0 AND A.lv007<A1.lv007) lv17002

,(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv017>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) lv32001
,(SELECT sum(A.lv017*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv017>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) lv34007,(SELECT sum(A.lv017*A.lv019*(A1.lv007-A.lv007)/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv017>0 AND A.lv007<A1.lv007) lv34008,(SELECT sum((A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv017>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) lv33001,(SELECT sum((A1.lv007-A.lv007)) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv017>0 AND A.lv007<A1.lv007) lv33002

,(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv015>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) lv10001
,(SELECT sum(A.lv015*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv015>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) lv12007,(SELECT sum(A.lv015*A.lv019*(A1.lv007-A.lv007)/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv015>0 AND A.lv007<A1.lv007) lv12008,(SELECT sum((A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv015>0 AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) lv11001,(SELECT sum((A1.lv007-A.lv007)) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv015>0 AND A.lv007<A1.lv007) lv11002,

(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv016>0 ) lv80001,(SELECT sum(A.lv016*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0'  AND A.lv016>0) lv82001,(SELECT sum((A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0'  AND A.lv016>0) lv81001,

(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv017>0 ) lv86001,(SELECT sum(A.lv017*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0'  AND A.lv017>0) lv88001,(SELECT sum((A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0'  AND A.lv017>0) lv87001,

(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv015>0 ) lv74001,(SELECT sum(A.lv015*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0'  AND A.lv015>0) lv76001,(SELECT sum((A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0'  AND A.lv015>0) lv75001,



(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv011' AND A.lv014='0' AND A.lv016>0 ) lv77001,(SELECT sum(A.lv016*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv011' AND A.lv014='0'  AND A.lv016>0) lv79001,(SELECT sum((A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv011' AND A.lv014='0'  AND A.lv016>0) lv78001,

(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv011' AND A.lv014='0' AND A.lv017>0 ) lv83001,(SELECT sum(A.lv017*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv011' AND A.lv014='0'  AND A.lv017>0) lv85001,(SELECT sum((A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv011' AND A.lv014='0'  AND A.lv017>0) lv84001,

(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv011' AND A.lv014='0' AND A.lv015>0 ) lv71001,(SELECT sum(A.lv015*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv011' AND A.lv014='0'  AND A.lv015>0) lv73001,(SELECT sum((A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv011' AND A.lv014='0'  AND A.lv015>0) lv72001,

(SELECT sum(A.lv016*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0048 A left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001'  AND A.lv016>0) lv51001,
(SELECT sum(A.lv017*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)+IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0048 A left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001'  AND A.lv017>0) lv52001
		";
		// echo str_replace(">","&gt;",str_replace("<","&lt;",$lvsql));
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vArr[0]=$vrow['lv15007'];//Tính % bảo hiểm yt tăng lao động
			$vArr[1]=$vrow['lv15008'];//Tính % bảo hiểm yt lương tăng
			$vArr[2]=$vrow['lv13001'];//Tính số lao động đăng ký bảo hiểm yt
			$vArr[3]=$vrow['lv14001'];//Tính lương bảo hiểm yt
			$vArr[4]=$vrow['lv14002'];//Tính lương bảo hiểm yt
			$vArr[5]=$vrow['lv31007'];//Tính % bảo hiểm tn tăng lao động
			$vArr[6]=$vrow['lv31008'];//Tính % bảo hiểm tn lương tăng
			$vArr[7]=$vrow['lv19001'];//Tính số lao động đăng ký bảo hiểm tn
			$vArr[8]=$vrow['lv30001'];//Tính lương bảo hiểm tn
			$vArr[9]=$vrow['lv30002'];//Tính lương bảo hiểm tn
			$vArr[10]=$vrow['lv09007'];//Tính % bảo hiểm xh tăng lao động
			$vArr[11]=$vrow['lv09008'];//Tính % bảo hiểm xh lương tăng
			$vArr[12]=$vrow['lv07001'];//Tính số lao động đăng ký bảo hiểm xh
			$vArr[13]=$vrow['lv08001'];//Tính lương bảo hiểm xh
			$vArr[14]=$vrow['lv08002'];//Tính lương bảo hiểm xh
			$vArr[15]=$vrow['lv18007'];//Tính % bảo hiểm yt giam lao động
			$vArr[16]=$vrow['lv18008'];//Tính % bảo hiểm yt lương giảm
			$vArr[17]=$vrow['lv16001'];//Tính số lao động đăng ký bảo hiểm yt giảm
			$vArr[18]=$vrow['lv17001'];//Tính lương bảo hiểm yt giảm
			$vArr[19]=$vrow['lv17002'];//Tính lương bảo hiểm yt giảm
			$vArr[20]=$vrow['lv34007'];//Tính % bảo hiểm tn tăng lao động
			$vArr[21]=$vrow['lv34008'];//Tính % bảo hiểm tn lương tăng
			$vArr[22]=$vrow['lv32001'];//Tính số lao động đăng ký bảo hiểm tn
			$vArr[23]=$vrow['lv33001'];//Tính lương bảo hiểm tn
			$vArr[24]=$vrow['lv33002'];//Tính lương bảo hiểm tn
			$vArr[25]=$vrow['lv12007'];//Tính % bảo hiểm xh tăng lao động
			$vArr[26]=$vrow['lv12008'];//Tính % bảo hiểm xh lương tăng
			$vArr[27]=$vrow['lv10001'];//Tính số lao động đăng ký bảo hiểm xh
			$vArr[28]=$vrow['lv11001'];//Tính lương bảo hiểm xh
			$vArr[29]=$vrow['lv11002'];//Tính lương bảo hiểm xh
			//Tổng bảo hiểm đóng
			$vArr[30]=$vrow['lv80001'];//Tính tổng số lao động đóng bảo hiểm yt 
			$vArr[31]=$vrow['lv81001'];//Tính tổng lương bảo hiểm yt
			$vArr[32]=$vrow['lv82001'];//Tính tổng tiền phải đóng hiểm yt
			
			$vArr[33]=$vrow['lv86001'];//Tính tổng số lao động đóng bảo hiểm nt 
			$vArr[34]=$vrow['lv87001'];//Tính tổng lương bảo hiểm nt
			$vArr[35]=$vrow['lv88001'];//Tính tổng tiền phải đóng hiểm nt
			
			$vArr[36]=$vrow['lv86001'];//Tính tổng số lao động đóng bảo hiểm xh
			$vArr[37]=$vrow['lv87001'];//Tính tổng lương bảo hiểm xh
			$vArr[38]=$vrow['lv88001'];//Tính tổng tiền phải đóng hiểm xh
			
			//Kỳ trước
			$vArr[39]=$vrow['lv77001'];//Tính tổng số lao động đóng bảo hiểm yt 
			$vArr[40]=$vrow['lv78001'];//Tính tổng lương bảo hiểm yt
			$vArr[41]=$vrow['lv79001'];//Tính tổng tiền phải đóng hiểm yt
			
			$vArr[42]=$vrow['lv83001'];//Tính tổng số lao động đóng bảo hiểm nt 
			$vArr[43]=$vrow['lv84001'];//Tính tổng lương bảo hiểm nt
			$vArr[44]=$vrow['lv85001'];//Tính tổng tiền phải đóng hiểm nt
			
			$vArr[45]=$vrow['lv71001'];//Tính tổng số lao động đóng bảo hiểm xh
			$vArr[46]=$vrow['lv72001'];//Tính tổng lương bảo hiểm xh
			$vArr[47]=$vrow['lv73001'];//Tính tổng tiền phải đóng hiểm xh
			
			$vArr[48]=$vrow['lv51001'];
			$vArr[49]=$vrow['lv52001'];
			
			$vArr[50]=$vrow['lv74001'];
			$vArr[51]=$vrow['lv75001'];
			$vArr[52]=$vrow['lv76001'];
			
			
			
		}
		return $vArr;
	}
	function LV_LoadArr($vlv001,$vlv011)
	{
		$vArr=array();
		$lvsql="select (select count(*) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') lv001,(select sum(lv007) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') lv002,(select count(*) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') lv003,(select sum(lv007) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') lv004,(select count(*) from  hr_lv0045 A inner join hr_lv0020 B on A.lv003=B.lv001 Where A.lv002='$vlv001' and B.lv018!=1 and A.lv014='0') lv005,(SELECT sum(A.lv007) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) lv006,(SELECT sum(A.lv007) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) lv007,0 lv008,(SELECT count(*) FROM hr_lv0045 A    WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) lv009,(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) lv010,0 lv011,(select count(*) from  hr_lv0045 A inner join hr_lv0019 B on A.lv005=B.lv001  Where A.lv002='$vlv001' and A.lv014='0' and (B.lv007 not in(select C.lv012 from hr_lv0001 C)) ) lv012,(select sum(lv010) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') TitleSalary,(select sum(lv011) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') VKSalary,(select sum(lv012) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') CareerSalary,(select sum(lv013) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') LocateSalary,(select sum(lv010) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') TitleSalary1,(select sum(lv011) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') VKSalary1,(select sum(lv012) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') CareerSalary1,(select sum(lv013) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') LocateSalary1,(select sum(A.lv010) from  hr_lv0045 A WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) TitleSalary2,(select sum(A.lv011) from  hr_lv0045 A WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) VKSalary2,(select sum(A.lv012) from  hr_lv0045 A WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) CareerSalary2,(select sum(A.lv013) from  hr_lv0045 A WHERE A.lv002='$vlv001' AND A.lv014='2' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='2' AND XX.lv002='$vlv011')) LocateSalary2,(select sum(A.lv010) from  hr_lv0045 A WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) TitleSalary3,(select sum(A.lv011) from  hr_lv0045 A WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) VKSalary3,(select sum(A.lv012) from  hr_lv0045 A WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) CareerSalary3,(select sum(A.lv013) from  hr_lv0045 A  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) LocateSalary3,(select sum(lv010) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') TitleSalary4,(select sum(lv011) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') VKSalary4,(select sum(lv012) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') CareerSalary4,(select sum(lv013) from  hr_lv0045 Where lv002='$vlv001'  and lv014='0') LocateSalary4,(SELECT sum(A.lv007-A1.lv007) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv007>A1.lv007) lv606,(select sum(lv010) from  hr_lv0045 Where lv002 in (select XX.lv011 from hr_lv0044 xx where XX.lv001='$vlv001') and lv014='0') TitleSalaryPre,(select sum(lv011) from  hr_lv0045 Where lv002 in (select XX.lv011 from hr_lv0044 xx where XX.lv001='$vlv001') and lv014='0') VKSalaryPre,(select sum(lv012) from  hr_lv0045 Where lv002 in (select XX.lv011 from hr_lv0044 xx where XX.lv001='$vlv001') and lv014='0') CareerSalaryPre,(select sum(lv013) from  hr_lv0045 Where lv002 in (select XX.lv011 from hr_lv0044 xx where XX.lv001='$vlv001') and lv014='0') LocateSalaryPre,(select count(*) from  hr_lv0045 Where lv002 in (select XX.lv011 from hr_lv0044 xx where XX.lv001='$vlv001') and lv014='0') CountPre,(select sum(lv007) from  hr_lv0045 Where lv002 in (select XX.lv011 from hr_lv0044 xx where XX.lv001='$vlv001') and lv014='0') SalaryPre,(SELECT sum(A.lv016*A.lv019*(A.lv007+IF(ISNULL(A.lv010),0,A.lv010)++IF(ISNULL(A.lv011),0,A.lv011)+IF(ISNULL(A.lv012),0,A.lv012)+IF(ISNULL(A.lv013),0,A.lv013))/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')) lv15007,(SELECT sum(A.lv016*A.lv019*(A.lv007-A1.lv007)/100) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv007>A1.lv007) lv15008";
		// echo str_replace(">","&gt;",str_replace("<","&lt;",$lvsql));
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vArr[0]=$vrow['lv001'];//count employee join insurance
			$vArr[1]=$vrow['lv002'];//sum salary employee join insurannce
			$vArr[2]=$vrow['lv003'];//count employee join insurance don't child
			$vArr[3]=$vrow['lv004'];//count employee female
			$vArr[4]=$vrow['lv005'];//sum salary femal
			$vArr[5]=$vrow['lv006'];//descrease salary
			$vArr[6]=$vrow['lv007'];//ascrease salary
			$vArr[7]=$vrow['lv008'];//remove employee
			$vArr[8]=$vrow['lv009'];//count ascrease
			$vArr[9]=$vrow['lv010'];//count descrease
			$vArr[10]=$vrow['lv011'];//count descrease
			$vArr[11]=$vrow['lv012'];//count descrease
			$vArr[12]=$vrow['TitleSalary'];//count descrease
			$vArr[13]=$vrow['VKSalary'];//count descrease
			$vArr[14]=$vrow['CareerSalary'];//count descrease
			$vArr[15]=$vrow['LocateSalary'];//count descrease
			$vArr[16]=$vrow['TitleSalary1'];//count descrease
			$vArr[17]=$vrow['VKSalary1'];//count descrease
			$vArr[18]=$vrow['CareerSalary1'];//count descrease
			$vArr[19]=$vrow['LocateSalary1'];//count descrease
			$vArr[20]=$vrow['TitleSalary2'];//count descrease
			$vArr[21]=$vrow['VKSalary2'];//count descrease
			$vArr[22]=$vrow['CareerSalary2'];//count descrease
			$vArr[23]=$vrow['LocateSalary2'];//count descrease
			$vArr[24]=$vrow['TitleSalary3'];//count descrease
			$vArr[25]=$vrow['VKSalary3'];//count descrease
			$vArr[26]=$vrow['CareerSalary3'];//count descrease
			$vArr[27]=$vrow['LocateSalary3'];//count descrease
			$vArr[28]=$vrow['TitleSalary4'];//count descrease
			$vArr[29]=$vrow['VKSalary4'];//count descrease
			$vArr[30]=$vrow['CareerSalary4'];//count descrease
			$vArr[31]=$vrow['LocateSalary4'];//count descrease
			$vArr[32]=$vrow['lv606'];//IV descrease
			$vArr[33]=$vrow['CountPre'];//Pre count
			$vArr[34]=$vrow['SalaryPre'];//Pre Salary
			$vArr[35]=$vrow['TitleSalaryPre'];//Pre Title salary
			$vArr[36]=$vrow['VKSalaryPre'];//Pre VKSalary
			$vArr[37]=$vrow['CareerSalaryPre'];//Pre CareerSalary
			$vArr[38]=$vrow['LocateSalaryPre'];//Pre LocateSalary	
			$vArr[39]=$vrow['lv15007'];//Tính bảo hiểm tăng lao động
			$vArr[40]=$vrow['lv15008'];//Tính bảo hiểm lương tăng
			
			
		}
		return $vArr;
	}
	function LV_LoadArr3aDN($vlv001)
	{
		$vArr=array();
		$lvsql="select (select count(*) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') lv001,(select sum(lv007) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') lv002,(select count(*) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') lv003,(select sum(lv007) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') lv004,(select count(*) from  hr_lv0045 A inner join hr_lv0020 B on A.lv003=B.lv001 Where A.lv002='$vlv001' and B.lv018!=1 and A.lv014='0') lv005,(SELECT sum(A1.lv007-A.lv007) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND  A.lv007<A1.lv007) lv006,(SELECT sum(A.lv007-A1.lv007) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND  A.lv007>A1.lv007) lv007,(SELECT sum(A.lv007)  FROM hr_lv0045 A   WHERE A.lv002='$vlv001' AND A.lv014='2') lv008,(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND  A.lv007>A1.lv007) lv009,(SELECT count(*) FROM hr_lv0045 A    left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='0' AND  A.lv007<A1.lv007) lv010,(SELECT count(*)  FROM hr_lv0045 A   WHERE A.lv002='$vlv001' AND A.lv014='2') lv011,(select count(*) from  hr_lv0045 A inner join hr_lv0019 B on A.lv005=B.lv001  Where A.lv002='$vlv001' and A.lv014='0' and (B.lv007 not in(select C.lv012 from hr_lv0001 C)) ) lv012,(select sum(lv010) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') TitleSalary,(select sum(lv011) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') VKSalary,(select sum(lv012) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') CareerSalary,(select sum(lv013) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') LocateSalary,(select sum(lv010) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') TitleSalary1,(select sum(lv011) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') VKSalary1,(select sum(lv012) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') CareerSalary1,(select sum(lv013) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') LocateSalary1,(select sum(lv010) from  hr_lv0045 Where lv002='$vlv001' and lv014='2') TitleSalary2,(select sum(lv011) from  hr_lv0045 Where lv002='$vlv001' and lv014='2') VKSalary2,(select sum(lv012) from  hr_lv0045 Where lv002='$vlv001' and lv014='2') CareerSalary2,(select sum(lv013) from  hr_lv0045 Where lv002='$vlv001' and lv014='2') LocateSalary2,(select sum(lv010) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') TitleSalary3,(select sum(lv011) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') VKSalary3,(select sum(lv012) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') CareerSalary3,(select sum(lv013) from  hr_lv0045 Where lv002='$vlv001' and lv008!=1 and lv014='0') LocateSalary3,(select sum(lv010) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') TitleSalary4,(select sum(lv011) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') VKSalary4,(select sum(lv012) from  hr_lv0045 Where lv002='$vlv001' and lv014='0') CareerSalary4,(select sum(lv013) from  hr_lv0045 Where lv002='$vlv001'  and lv014='0') LocateSalary4";
		// echo str_replace(">","&gt;",str_replace("<","&lt;",$lvsql));
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vArr[0]=$vrow['lv001'];//count employee join insurance
			$vArr[1]=$vrow['lv002'];//sum salary employee join insurannce
			$vArr[2]=$vrow['lv003'];//count employee join insurance don't child
			$vArr[3]=$vrow['lv004'];//count employee female
			$vArr[4]=$vrow['lv005'];//sum salary femal
			$vArr[5]=$vrow['lv006'];//descrease salary
			$vArr[6]=$vrow['lv007'];//ascrease salary
			$vArr[7]=$vrow['lv008'];//remove employee
			$vArr[8]=$vrow['lv009'];//count ascrease
			$vArr[9]=$vrow['lv010'];//count descrease
			$vArr[10]=$vrow['lv011'];//count descrease
			$vArr[11]=$vrow['lv012'];//count descrease
			$vArr[12]=$vrow['TitleSalary'];//count descrease
			$vArr[13]=$vrow['VKSalary'];//count descrease
			$vArr[14]=$vrow['CareerSalary'];//count descrease
			$vArr[15]=$vrow['LocateSalary'];//count descrease
			$vArr[16]=$vrow['TitleSalary1'];//count descrease
			$vArr[17]=$vrow['VKSalary1'];//count descrease
			$vArr[18]=$vrow['CareerSalary1'];//count descrease
			$vArr[19]=$vrow['LocateSalary1'];//count descrease
			$vArr[20]=$vrow['TitleSalary2'];//count descrease
			$vArr[21]=$vrow['VKSalary2'];//count descrease
			$vArr[22]=$vrow['CareerSalary2'];//count descrease
			$vArr[23]=$vrow['LocateSalary2'];//count descrease
			$vArr[24]=$vrow['TitleSalary3'];//count descrease
			$vArr[25]=$vrow['VKSalary3'];//count descrease
			$vArr[26]=$vrow['CareerSalary3'];//count descrease
			$vArr[27]=$vrow['LocateSalary3'];//count descrease
			$vArr[28]=$vrow['TitleSalary4'];//count descrease
			$vArr[29]=$vrow['VKSalary4'];//count descrease
			$vArr[30]=$vrow['CareerSalary4'];//count descrease
			$vArr[31]=$vrow['LocateSalary4'];//count descrease
		}
		return $vArr;
	}
	function LV_Insert()
	{
		
		if($this->isAdd==0) return false;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		 $lvsql="insert into hr_lv0044 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015')";
		$vReturn= db_query($lvsql);
		if($vReturn) {
			$this->InsertLogOperation($this->DateCurrent,'hr_lv0044.insert',sof_escape_string($lvsql));
			$this->LV_InsertOther($this->lv001,$this->lv011);
		}
		return $vReturn;
	}	
	function LV_InsertOther($lv002,$vlv0022)
	{
		if($this->isAdd==0) return false;
		echo $lvsql="insert into hr_lv0045 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019) 
		select '$lv002',lv001,lv020,(select lv005 from hr_lv0045 B where B.lv002='$vlv0022' and B.lv003=A.lv001 Order by B.lv001 Desc limit 0,1),(select lv006 from hr_lv0045 B where B.lv002='$vlv0022' and B.lv003=A.lv001 Order by B.lv001 Desc limit 0,1),(select C.lv021 from hr_lv0038 C where C.lv009=1 and C.lv002=A.lv001 Order by C.lv005 Desc limit 0,1),(select lv008 from hr_lv0045 B where B.lv002='$vlv0022' and B.lv003=A.lv001 Order by B.lv001 Desc limit 0,1),(select lv009 from hr_lv0045 B where B.lv002='$vlv0022' and B.lv003=A.lv001 Order by B.lv001 Desc limit 0,1),(select lv005 from hr_lv0042 B where B.lv002=A.lv001 and B.lv004='111' and B.lv007=0 and B.lv003 in (select C.lv001 from hr_lv0038 C where C.lv009=1 and C.lv002=A.lv001) Order by B.lv005 Desc limit 0,1),(select lv005 from hr_lv0042 B where B.lv002=A.lv001 and B.lv004='116' and B.lv007=0 and B.lv003 in (select C.lv001 from hr_lv0038 C where C.lv009=1 and C.lv002=A.lv001) Order by B.lv005 Desc limit 0,1),(select lv005 from hr_lv0042 B where B.lv002=A.lv001 and B.lv004='117' and B.lv007=0 and B.lv003 in (select C.lv001 from hr_lv0038 C where C.lv009=1 and C.lv002=A.lv001) Order by B.lv005 Desc limit 0,1),(select lv005 from hr_lv0042 B where B.lv002=A.lv001 and B.lv004='118' and B.lv007=0 Order by B.lv005 Desc limit 0,1),lv009,'$this->lv012','$this->lv013','$this->lv014','$this->lv005','1' from hr_lv0020 A where (A.lv009='0' or A.lv009='2') and (select C.lv021 from hr_lv0038 C where C.lv009=1 and C.lv002=A.lv001)>0";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0045.insert',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		  $lvsql="Update hr_lv0044 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015' where  lv001='$this->lv001' AND lv006<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0044.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		 $this->LV_DeleteParent($lvarr);
		$lvsql = "DELETE FROM hr_lv0044  WHERE hr_lv0044.lv006<=0 AND hr_lv0044.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn){
		 $this->InsertLogOperation($this->DateCurrent,'hr_lv0044.delete',sof_escape_string($lvsql));
		
		 }
		return $vReturn;
	}	
	function LV_DeleteParent($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM hr_lv0045  WHERE hr_lv0045.lv002 IN ($lvarr) and (select lv006 from hr_lv0044 B where  B.lv001= hr_lv0045.lv002)<=0";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0045.delete',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update hr_lv0044 set lv006=1  WHERE hr_lv0044.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0044.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update hr_lv0044 set lv006=0  WHERE hr_lv0044.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'hr_lv0044.unapproval',sof_escape_string($lvsql));
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
		if($this->lv007!="") $strCondi=$strCondi." and lv007  like '%$this->lv007%'";
		if($this->lv008!="") $strCondi=$strCondi." and lv008  like '%$this->lv008%'";
		if($this->lv009!="") $strCondi=$strCondi." and lv009  like '%$this->lv009%'";
		if($this->lv010!="") $strCondi=$strCondi." and lv010  like '%$this->lv010%'";
		if($this->lv011!="") $strCondi=$strCondi." and lv011  like '%$this->lv011%'";
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM hr_lv0044 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
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
		$lvTable="
		<div id=\"func_id\" style='position:relative;background:#f2f2f2'><div style=\"float:left\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</div><div style=\"float:right\">".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</div><div style='float:right'>&nbsp;&nbsp;&nbsp;</div><div style='float:right'>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</div></div><div style='height:35px'></div><table  align=\"center\" class=\"lvtable\"><!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		@#01
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
		<tr class=\"cssbold_tab\"><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right></td></tr>
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
		$lvTd="<td  class=@#04>@02</td>";
		$sqlS = "SELECT * FROM hr_lv0044 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv006']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
		//////////////////////Buil list////////////////////
//////////////////////Buil list////////////////////
function LV_BuilListOther01($vlv001,$vlv011)
	{
		$lvList='st2,st3,st4,st5,st6,st7,st8,st9,st10,st11,st12,st13,st14,st15,st16,st17,st18';
		$lvOrderList='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18';
		$ArrView=array("st2"=>"0","st3"=>"0","st4"=>"0","st5"=>"2","st6"=>"0","st7"=>"0","st8"=>"0","st9"=>"0","st10"=>"0","st11"=>"10","st12"=>"10","st13"=>"10","st14"=>"10","st15"=>"10","st16"=>"10","st17"=>"0","st18"=>"0");
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lvTable="
		@#01
		";		
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvHref="@02";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT concat(B.lv004,' ',B.lv003,' ',B.lv002) st2,B.lv020 st3,A.lv006 st4,B.lv015 st5,IF(B.lv018=1,'','X') st6,B.lv010 st7,concat(B.lv034 ,', ',IF(ISNULL(E.lv002),'',E.lv002)) st8,B.lv012 st9,c.lv002 st10,A.lv007 st11,A.lv010 st12,A.lv011 st13,A.lv012 st14,A.lv013 st15,A.lv007*A.lv017/100 st16,concat(month(A.lv018),'/',year(A.lv018)) st17 FROM hr_lv0045 A left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002  left join hr_lv0023 E on E.lv001=B.lv032  left join hr_lv0023 F on F.lv001=C.lv007 left join hr_lv0016 J on B.lv023=J.lv001 WHERE A.lv002='$vlv001' AND A.lv014='0' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='0' AND XX.lv002='$vlv011')";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";

		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv006']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		return str_replace("@#01",$strTr,$lvTable);
	}
	function LV_BuilListOther($vlv001)
	{
		$lvList='st2,st3,st4,st5,st6,st7,st8,st9,st10,st11,st12,st13,st14,st15,st16,st17,st18';
		$lvOrderList='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16';
		$ArrView=array("st2"=>"0","st3"=>"0","st4"=>"0","st5"=>"2","st6"=>"0","st7"=>"0","st8"=>"0","st9"=>"0","st10"=>"0","st11"=>"10","st12"=>"10","st13"=>"1","st14"=>"10","st15"=>"10","st16"=>"10","st17"=>"0");
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lvTable="
		@#01
		";
		
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTd="<td  class=@#04>@02</td>";
		 $sqlS = "SELECT concat(B.lv004,' ',B.lv003,' ',B.lv002) st2,B.lv020 st3,A.lv006 st4,B.lv015 st5,B.lv018 st6,B.lv010 st7,B.lv032 st8,C.lv007 st9,C.lv002 st10,A.lv007 st11,A.lv010 st12,A.lv011 st13,A.lv012 st14,A.lv013 st15,A.lv007 st16,concat(month(D.lv005),'/',year(D.lv005)) st17,A.lv009 st18 FROM hr_lv0045 A left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='0'";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";

		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv006']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		return str_replace("@#01",$strTr,$lvTable);
	}
	/////////report 2///////////////
		function LV_BuilListOtherEditAdd($vlv001,$vlv014,$vlv011,$perent)
	{
		$lvList='st2,st3,st4,st5,st6,st7,st8,st9,st10,st11,st12,st13,st14,st15,st16,st17,st18,st19,st20,st21,st22';
		$lvOrderList='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22';
		$ArrView=array("st2"=>"0","st3"=>"0","st4"=>"2","st5"=>"0","st6"=>"0","st7"=>"0","st8"=>"0","st9"=>"0","st10"=>"10","st11"=>"10","st12"=>"10","st13"=>"10","st14"=>"10","st15"=>"0","st16"=>"0","st17"=>"0","st18"=>"0","st18"=>"0","st19"=>"0","st20"=>"0","st21"=>"0","st22"=>"0");
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lvTable="
		@#01
		";
		
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTd="<td   align=left>@02</td>";
		$sqlS = "SELECT concat(B.lv004,' ',B.lv003,' ',B.lv002) st2,B.lv020 st3,B.lv015 st4,if(B.lv008!=1,'X','&nbsp;') st5,C.lv007 st6,C.lv002 st7,B.lv010 st8,B.lv005 st9,'&nbsp;' st10,'&nbsp;' st11,'&nbsp;' st12,'&nbsp;' st13,A.lv007 st14,A.lv010 st15,A.lv011 st16,A.lv012 st17,concat(month(A.lv018),'/',year(A.lv018)) st18,concat(month(ADDDATE(A.lv018,31*(A.lv019-1))),'/',year(ADDDATE(A.lv018,31*(A.lv019-1)))) st19,concat((A.lv015+A.lv016+A.lv017),'%') st20,IF(B.lv020='','&nbsp','x') st21,A.lv009 st22 FROM hr_lv0045 A left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='$vlv014' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='$vlv014' AND XX.lv002='$vlv011')";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		if(!$bResult) return ;
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";

		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv006']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		return str_replace("@#01",$strTr,$lvTable);
	}
	/////////report 2///////////////
		function LV_BuilListOtherEdit($vlv001,$vlv014,$vlv011,$perent)
	{
		$lvList='st2,st3,st4,st5,st6,st7,st8,st9,st10,st11,st12,st13,st14,st15,st16,st17,st18,st19,st20,st21,st22';
		$lvOrderList='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22';
		$ArrView=array("st2"=>"0","st3"=>"0","st4"=>"2","st5"=>"10","st6"=>"0","st7"=>"0","st8"=>"0","st9"=>"0","st10"=>"0","st11"=>"10","st12"=>"10","st13"=>"10","st14"=>"10","st15"=>"0","st16"=>"0","st17"=>"0","st18"=>"0","st18"=>"0","st19"=>"0","st20"=>"0","st21"=>"0","st22"=>"0");
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lvTable="
		@#01
		";
		
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTd="<td   align=left>@02</td>";
		$sqlS = "SELECT concat(B.lv004,' ',B.lv003,' ',B.lv002) st2,B.lv020 st3,B.lv015 st4,if(B.lv008!=1,'X','&nbsp;') st5,C.lv007 st6,C.lv002 st7,B.lv010 st8,B.lv005 st9,'&nbsp;' st14,A.lv010 st15,A.lv011 st16,A.lv012 st17,concat(month(A.lv018),'/',year(A.lv018)) st18,concat(month(ADDDATE(A.lv018,31*(A.lv019-1))),'/',year(ADDDATE(A.lv018,31*(A.lv019-1)))) st19,concat((A.lv015+A.lv016+A.lv017),'%') st20,IF(B.lv020='','&nbsp','x') st21,A.lv009 st22 FROM hr_lv0045 A left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='$vlv014' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='$vlv014' AND XX.lv002='$vlv011')";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		if(!$bResult) return ;
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";

		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv006']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		return str_replace("@#01",$strTr,$lvTable);
	}
	/////////report 2///////////////
	function LV_BuilListOtherEditIncrease($vlv001,$vlv014,$vlv011,$perent)
	{
		$lvList='st2,st3,st4,st5,st6,st7,st8,st9,st10,st11,st12,st13,st14,st15,st16,st17,st18,st19,st20,st21,st22';
		$lvOrderList='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22';
		$ArrView=array("st2"=>"0","st3"=>"0","st4"=>"2","st5"=>"10","st6"=>"0","st7"=>"10","st8"=>"0","st9"=>"0","st10"=>"10","st11"=>"10","st12"=>"10","st13"=>"10","st14"=>"10","st15"=>"10","st16"=>"10","st17"=>"10","st18"=>"0","st19"=>"0","st20"=>"0","st21"=>"0","st22"=>"0");
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lvTable="
		@#01
		";
		
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTd="<td   align=left>@02</td>";
		$sqlS = "SELECT concat(B.lv004,' ',B.lv003,' ',B.lv002) st2,B.lv020 st3,B.lv015 st4,if(B.lv008!=1,'X','&nbsp;') st5,C.lv007 st6,C.lv002 st7,B.lv010 st8,B.lv005 st9,A1.lv007 st10,A1.lv010 st11,A1.lv011 st12,A1.lv012 st13,A.lv007 st14,(A.lv010) st15,(A.lv011) st16,(A.lv012) st17,concat(month(A.lv018),'/',year(A.lv018)) st18,concat(month(ADDDATE(A.lv018,31*(A.lv019-1))),'/',year(ADDDATE(A.lv018,31*(A.lv019-1)))) st19,concat((A.lv015+A.lv016+A.lv017),'%') st20,IF(B.lv020='','&nbsp','x') st21,A.lv009 st22 FROM hr_lv0045 A  left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='$vlv014' AND A.lv007>A1.lv007";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		if(!$bResult) return ;
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";

		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv006']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		return str_replace("@#01",$strTr,$lvTable);
	}
	function LV_BuilListOtherEditDecrease($vlv001,$vlv014,$vlv011,$perent,$vOpt)
	{
		$lvList='st2,st3,st4,st5,st6,st7,st8,st9,st10,st11,st12,st13,st14,st15,st16,st17,st18,st19,st20,st21,st22';
		$lvOrderList='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22';
		$ArrView=array("st2"=>"0","st3"=>"0","st4"=>"2","st5"=>"10","st6"=>"0","st7"=>"0","st8"=>"0","st9"=>"0","st10"=>"10","st11"=>"10","st12"=>"10","st13"=>"10","st14"=>"10","st15"=>"10","st16"=>"10","st17"=>"10","st18"=>"0","st19"=>"0","st20"=>"0","st21"=>"0","st22"=>"0");
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lvTable="
		@#01
		";
		
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTd="<td   align=center>@02</td>";
		switch($vOpt)
		{
			case 'a':
				$sqlS = "SELECT concat(B.lv004,' ',B.lv003,' ',B.lv002) st2,B.lv020 st3,B.lv015 st4,if(B.lv008!=1,'X','&nbsp;') st5,C.lv007 st6,C.lv002 st7,B.lv010 st8,B.lv005 st9,A.lv007 st10,A.lv010 st11,A.lv011 st12,A.lv012 st13,concat(month(A.lv018),'/',year(A.lv018)) st18,concat(month(ADDDATE(A.lv018,31*(A.lv019-1))),'/',year(ADDDATE(A.lv018,31*(A.lv019-1)))) st19,concat((A.lv015+A.lv016+A.lv017),'%') st20,IF(B.lv020='','&nbsp','x') st21,A.lv009 st22 FROM hr_lv0045 A left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001' AND A.lv014='$vlv014' AND A.lv003 not in (select XX.lv003 from hr_lv0045 XX where XX.lv003=A.lv003 and XX.lv014='$vlv014' AND XX.lv002='$vlv011')";
				break;
			case 'b':
				//$sqlS = "SELECT concat(B.lv004,' ',B.lv003,' ',B.lv002) st2,B.lv020 st3,B.lv015 st4,if(B.lv008!=1,'X','&nbsp;') st5,C.lv007 st6,C.lv002 st7,B.lv010 st8,B.lv005 st9,A.lv007 st14,(A.lv010-A1.lv010) st15,(A.lv011-A1.lv011) st16,(A.lv012-A1.lv012) st17,concat(month(A.lv018),'/',year(A.lv018)) st18,concat(month(ADDDATE(A.lv018,31*(A.lv019-1))),'/',year(ADDDATE(A.lv018,31*(A.lv019-1)))) st19,concat((A.lv015+A.lv016+A.lv017),'%') st20,IF(B.lv020='','&nbsp','x') st21,A.lv009 st22 FROM hr_lv0045 A  left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='$vlv014' AND A.lv007<A1.lv007";
				break;
			case 'c':
				//$sqlS = "SELECT concat(B.lv004,' ',B.lv003,' ',B.lv002) st2,B.lv020 st3,B.lv015 st4,if(B.lv008!=1,'X','&nbsp;') st5,C.lv007 st6,C.lv002 st7,B.lv010 st8,B.lv005 st9,A.lv007 st14,(A.lv010-A1.lv010) st15,(A.lv011-A1.lv011) st16,(A.lv012-A1.lv012) st17,concat(month(A.lv018),'/',year(A.lv018)) st18,concat(month(ADDDATE(A.lv018,31*(A.lv019-1))),'/',year(ADDDATE(A.lv018,31*(A.lv019-1)))) st19,concat((A.lv015+A.lv016+A.lv017),'%') st20,IF(B.lv020='','&nbsp','x') st21,A.lv009 st22 FROM hr_lv0045 A  left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='$vlv014' AND A.lv007<A1.lv007";
				break;
			case 'd':
				//$sqlS = "SELECT concat(B.lv004,' ',B.lv003,' ',B.lv002) st2,B.lv020 st3,B.lv015 st4,if(B.lv008!=1,'X','&nbsp;') st5,C.lv007 st6,C.lv002 st7,B.lv010 st8,B.lv005 st9,A.lv007 st14,(A.lv010-A1.lv010) st15,(A.lv011-A1.lv011) st16,(A.lv012-A1.lv012) st17,concat(month(A.lv018),'/',year(A.lv018)) st18,concat(month(ADDDATE(A.lv018,31*(A.lv019-1))),'/',year(ADDDATE(A.lv018,31*(A.lv019-1)))) st19,concat((A.lv015+A.lv016+A.lv017),'%') st20,IF(B.lv020='','&nbsp','x') st21,A.lv009 st22 FROM hr_lv0045 A  left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='$vlv014' AND A.lv007<A1.lv007";
				break;
			case 'II2':
				$sqlS = "SELECT concat(B.lv004,' ',B.lv003,' ',B.lv002) st2,B.lv020 st3,B.lv015 st4,if(B.lv008!=1,'X','&nbsp;') st5,C.lv007 st6,C.lv002 st7,B.lv010 st8,B.lv005 st9,A1.lv007 st10,A1.lv010 st11,A1.lv011 st12,A1.lv012 st13,A.lv007 st14,(A.lv010) st15,(A.lv011) st16,(A.lv012) st17,concat(month(A.lv018),'/',year(A.lv018)) st18,concat(month(ADDDATE(A.lv018,31*(A.lv019-1))),'/',year(ADDDATE(A.lv018,31*(A.lv019-1)))) st19,concat((A.lv015+A.lv016+A.lv017),'%') st20,IF(B.lv020='','&nbsp','x') st21,A.lv009 st22 FROM hr_lv0045 A  left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='$vlv014' AND A.lv007<A1.lv007";
				break;
		}
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		if(!$bResult) return ;
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";

		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv006']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		return str_replace("@#01",$strTr,$lvTable);
	}
	/////////BoSungBHYT///////////////
	function LV_BuilListBoSungBHYT($vlv001,$vlv014,$vlv011,$perent)
	{
		$lvList='st2,st3,st4,st5,st6,st7,st8,st9,st10,st11,st12,st13,st14,st15,st16,st17,st18,st19,st20,st21,st22';
		$lvOrderList='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22';
		$ArrView=array("st2"=>"0","st3"=>"0","st4"=>"2","st5"=>"10","st6"=>"0","st7"=>"0","st8"=>"0","st9"=>"0","st10"=>"0","st11"=>"10","st12"=>"10","st13"=>"10","st14"=>"10","st15"=>"0","st16"=>"0","st17"=>"0","st18"=>"0","st18"=>"0","st19"=>"0","st20"=>"0","st21"=>"0","st22"=>"0");
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lvTable="
		@#01
		";
		
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTd="<td   align=left>@02</td>";
		$sqlS = "SELECT concat(B.lv004,' ',B.lv003,' ',B.lv002) st2,B.lv020 st3,B.lv015 st4,if(B.lv008!=1,'X','&nbsp;') st5,C.lv007 st6,C.lv002 st7,B.lv010 st8,B.lv005 st9,A.lv007 st14,A.lv010 st15,A.lv011 st16,A.lv012 st17,concat(month(A.lv018),'/',year(A.lv018)) st18,concat(month(ADDDATE(A.lv018,31*(A.lv019-1))),'/',year(ADDDATE(A.lv018,31*(A.lv019-1)))) st19,concat((A.lv016),'%') st20,IF(B.lv020='','&nbsp','x') st21,A.lv009 st22 FROM hr_lv0048 A left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001'  AND A.lv016>0";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		if(!$bResult) return ;
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";

		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv006']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		return str_replace("@#01",$strTr,$lvTable);
	}
	/////////BoSungBHYT///////////////
	function LV_BuilListBoSungBHTN($vlv001,$vlv014,$vlv011,$perent)
	{
		$lvList='st2,st3,st4,st5,st6,st7,st8,st9,st10,st11,st12,st13,st14,st15,st16,st17,st18,st19,st20,st21,st22';
		$lvOrderList='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22';
		$ArrView=array("st2"=>"0","st3"=>"0","st4"=>"2","st5"=>"10","st6"=>"0","st7"=>"0","st8"=>"0","st9"=>"0","st10"=>"0","st11"=>"10","st12"=>"10","st13"=>"10","st14"=>"10","st15"=>"0","st16"=>"0","st17"=>"0","st18"=>"0","st18"=>"0","st19"=>"0","st20"=>"0","st21"=>"0","st22"=>"0");		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lvTable="
		@#01
		";
		
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTd="<td   align=left>@02</td>";
		$sqlS = "SELECT concat(B.lv004,' ',B.lv003,' ',B.lv002) st2,B.lv020 st3,B.lv015 st4,if(B.lv008!=1,'X','&nbsp;') st5,C.lv007 st6,C.lv002 st7,B.lv010 st8,B.lv005 st9,A.lv007 st14,A.lv010 st15,A.lv011 st16,A.lv012 st17,concat(month(A.lv018),'/',year(A.lv018)) st18,concat(month(ADDDATE(A.lv018,31*(A.lv019-1))),'/',year(ADDDATE(A.lv018,31*(A.lv019-1)))) st19,concat((A.lv017),'%') st20,IF(B.lv020='','&nbsp','x') st21,A.lv009 st22 FROM hr_lv0048 A left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002  WHERE A.lv002='$vlv001'  AND A.lv017>0";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		if(!$bResult) return ;
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";

		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv006']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		return str_replace("@#01",$strTr,$lvTable);
	}
	/////////report 2///////////////
		function LV_BuilListOtherEditDescrease($vlv001,$vlv014,$vlv011,$perent)
	{
		$lvList='st2,st3,st4,st5,st6,st7,st8,st9,st10,st11,st12,st13,st14,st15,st16,st17,st18,st19';
		$lvOrderList='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16';
		$ArrView=array("st2"=>"0","st3"=>"0","st4"=>"2","st5"=>"0","st6"=>"0","st7"=>"0","st8"=>"0","st9"=>"0","st10"=>"10","st11"=>"10","st12"=>"10","st13"=>"10","st14"=>"10","st15"=>"0","st16"=>"0","st17"=>"0");
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lvTable="
		@#01
		";
		
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTd="<td   align=left>@02</td>";
		$sqlS = "SELECT concat(B.lv004,' ',B.lv003,' ',B.lv002) st2,B.lv020 st3,B.lv015 st4,'&nbsp;' st5,'&nbsp;' st6,'&nbsp;' st7,'&nbsp;' st8,'&nbsp;' st9,(A.lv007-A1.lv007) st10,A.lv010 st11,A.lv011 st12,A.lv012 st13,A.lv013 st14,concat(month(A.lv018),'/',year(A.lv018)) st15,concat(month(ADDDATE(A.lv018,31*(A.lv019-1))),'/',year(ADDDATE(A.lv018,31*(A.lv019-1)))) st16,concat((A.lv015+A.lv016+A.lv017),'%') st17,'&nbsp;' st18 FROM hr_lv0045 A  left join  hr_lv0020 B on A.lv003=B.lv001 left join hr_lv0019 C on C.lv001=A.lv005 left join hr_lv0044 D on D.lv001=A.lv002 inner join hr_lv0045 A1 on A.lv003=A1.lv003 and A1.lv002=D.lv011 WHERE A.lv002='$vlv001' AND A.lv014='$vlv014' AND  A.lv007<A1.lv007";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		if(!$bResult) return ;
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";

		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv006']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
		}
		return str_replace("@#01",$strTr,$lvTable);
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
			window.open('".$this->Dir."hr_lv0044/?lang=".$this->lang."&func='+value+'&ID=".base64_encode($this->lv001)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$lvTd="<td  class=@#04>@02</td>";
		$sqlS = "SELECT * FROM hr_lv0044 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
		$lvTd="<td  class=@#04>@02</td>";
		$sqlS = "SELECT * FROM hr_lv0044 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			if($vrow['lv007']==1)		$strTr=str_replace("@#04","",$strTr);
			
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
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0043 where lv004=1";
				break;		
			case 'lv011':
				if($this->lv001=="" || $this->lv001==NULL)
					$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0044";
				else
					$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0044 where lv001!='$this->lv001'";
				break;		
			default:
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
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0001 where lv001='$vSelectID'";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0043 where lv001='$vSelectID'";	
				break;
			case 'lv011':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0044 where lv001='$vSelectID'";	
				break;
			case 'ts9':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0023 where lv001='$vSelectID'";	
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