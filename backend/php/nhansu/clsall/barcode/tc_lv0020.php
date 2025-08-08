<?php
/////////////coding tc_lv0020///////////////
class   tc_lv0020 extends lv_controler
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
	public $lv047=null;
	public $lv048=null;
	public $lv049=null;
	public $lv050=null;
	public $lv051=null;
	public $lv052=null;
	public $lv053=null;
	public $lv054=null;
	public $lv055=null;
	public $lv056=null;
	public $lv057=null;
	public $lv058=null;
	public $lv059=null;
	public $lv060=null;
	public $lv061=null;
	public $lv062=null;
	public $lv063=null;
	public $lv064=null;
	public $lv065=null;
	public $lv067=null;
	public $lv068=null;
	public $lv069=null;
	public $lv070=null;
	public $lv071=null;
	public $lv072=null;
	public $lv073=null;
	public $lv074=null;
	public $lv075=null;
	public $lv076=null;
	public $lv077=null;
	public $lv078=null;
	public $lv079=null;
	public $lv080=null;
	public $lv081=null;
	public $lv082=null;
	public $lv083=null;
	public $lv084=null;
	public $lv085=null;
	public $lv086=null;
	public $lv087=null;
	public $lv088=null;
	public $lv089=null;
	public $lv090=null;
	public $lv091=null;
	public $lv092=null;
	public $lv093=null;
	public $lv094=null;
	public $lv095=null;
	public $lv096=null;
	public $lv097=null;
	public $lv098=null;
	public $lv099=null;
	public $lv100=null;
	public $lv101=null;
	public $ArrDaySpecial=null;
	public $CountDate=null;
	public $vArrDay=null;
	public $vArrPetrol=null;
	public $Bank=null;
	
///////////
////////////////////GetDate
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027,lv028,lv029,lv030,lv031,lv032,lv033,lv034,lv035,lv036,lv037,lv038,lv039,lv040,lv041,lv042,lv043,lv044,lv045,lv046,lv047,lv048,lv049,lv050,lv051,lv052,lv053,lv054,lv055,lv056,lv057,lv058,lv059,lv060,lv061,lv062,lv063,lv064,lv065,lv066,lv067,lv068,lv069,lv070,lv071,lv072,lv073,lv074,lv075,lv076,lv077,lv078,lv079,lv080,lv081,lv082,lv083,lv084,lv085,lv086,lv087,lv088,lv089,lv090,lv091,lv092,lv093,lv094,lv095,lv096,lv097,lv098,lv099,lv100,lv101";	
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	public $mohr_lv0020=null;
	public $mohr_lv0038=null;
	public $ArrDepartment=null;
	public $ArrPriceItem=null;
	public $vlv024_sum=null;
	public $vlv024_sumcheck=null;
	protected $objhelp='tc_lv0020';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv027"=>"28","lv028"=>"29","lv029"=>"30","lv030"=>"31","lv031"=>"32","lv032"=>"33","lv033"=>"34","lv034"=>"35","lv035"=>"36","lv036"=>"37","lv037"=>"38","lv038"=>"39","lv039"=>"40","lv040"=>"41","lv041"=>"42","lv042"=>"43","lv043"=>"44","lv044"=>"45","lv045"=>"46","lv046"=>"47","lv047"=>"48","lv048"=>"49","lv049"=>"50","lv050"=>"51","lv051"=>"52","lv052"=>"53","lv053"=>"54","lv054"=>"55","lv055"=>"56","lv056"=>"57","lv057"=>"58","lv058"=>"59","lv059"=>"60","lv060"=>"61","lv061"=>"62","lv062"=>"63","lv063"=>"64","lv064"=>"65","lv065"=>"66","lv066"=>"67","lv067"=>"68","lv068"=>"69","lv069"=>"70","lv070"=>"71","lv071"=>"72","lv072"=>"73","lv073"=>"74","lv074"=>"75","lv075"=>"76","lv076"=>"77","lv077"=>"78","lv078"=>"79","lv079"=>"80","lv080"=>"81","lv081"=>"82","lv082"=>"83","lv083"=>"84","lv084"=>"85","lv085"=>"86","lv086"=>"87","lv087"=>"88","lv088"=>"89","lv089"=>"90","lv090"=>"91","lv091"=>"92","lv092"=>"93","lv093"=>"94","lv094"=>"95","lv095"=>"96","lv096"=>"97","lv097"=>"98","lv098"=>"99","lv099"=>"100","lv100"=>"101","lv101"=>"102");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"2","lv004"=>"2","lv005"=>"2","lv006"=>"1","lv007"=>"0","lv008"=>"10","lv009"=>"10","lv010"=>"10","lv011"=>"10","lv012"=>"13","lv013"=>"10","lv014"=>"10","lv015"=>"10","lv016"=>"10","lv017"=>"10","lv018"=>"10","lv019"=>"0","lv020"=>"10","lv021"=>"10","lv022"=>"10","lv023"=>"10","lv024"=>"10","lv025"=>"10","lv026"=>"10","lv027"=>"10","lv028"=>"10","lv029"=>"0","lv030"=>"10","lv030"=>"10","lv031"=>"10","lv032"=>"10","lv033"=>"10","lv034"=>"10","lv035"=>"13","lv036"=>"10","lv037"=>"10","lv038"=>"10","lv039"=>"10","lv040"=>"0","lv041"=>"10","lv042"=>"10","lv043"=>"10","lv044"=>"10","lv045"=>"10","lv046"=>"10","lv047"=>"10","lv048"=>"10","lv049"=>"10","lv050"=>"10","lv051"=>"10","lv052"=>"10","lv053"=>"10","lv054"=>"10","lv055"=>"10","lv056"=>"10","lv057"=>"10","lv058"=>"10","lv059"=>"10","lv060"=>"10","lv061"=>"13","lv062"=>"10","lv063"=>"10","lv064"=>"10","lv065"=>"10","lv066"=>"10","lv067"=>"10","lv068"=>"10","lv069"=>"13","lv070"=>"13","lv071"=>"10","lv072"=>"10","lv073"=>"10","lv074"=>"10","lv075"=>"10","lv076"=>"10","lv077"=>"10","lv078"=>"10","lv079"=>"13","lv080"=>"10","lv081"=>"10","lv082"=>"10","lv083"=>"10","lv084"=>"10","lv085"=>"10","lv086"=>"13","lv087"=>"13","lv088"=>"13","lv089"=>"13","lv090"=>"13","lv091"=>"13","lv092"=>"10","lv093"=>"10","lv094"=>"10","lv095"=>"0","lv096"=>"0","lv097"=>"10","lv098"=>"0","lv099"=>"0","lv100"=>"0","lv101"=>"10");	

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
	 	$this->isFil=0;	
		$this->isEdit=0;
		$this->lang=$_GET['lang'];		
		$this->vlv024_sumcheck=false;
		$this->ArrDaySpecial=Array();
		$this->vArrDay=Array();
		$this->vArrPetrol=Array();
		$this->CountDate=0;
		
	}
	
	function LV_Load()
	{
		$vsql="select * from  tc_lv0021";
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
			$this->lv046=$vrow['lv046'];
			$this->lv047=$vrow['lv047'];
			$this->lv048=$vrow['lv048'];
			$this->lv048=$vrow['lv048'];
			$this->lv049=$vrow['lv049'];
			$this->lv050=$vrow['lv050'];
			$this->lv051=$vrow['lv051'];
			$this->lv052=$vrow['lv052'];
			$this->lv053=$vrow['lv053'];
			$this->lv054=$vrow['lv054'];
			$this->lv055=$vrow['lv055'];
			$this->lv056=$vrow['lv056'];
			$this->lv057=$vrow['lv057'];
			$this->lv058=$vrow['lv058'];
			$this->lv059=$vrow['lv059'];
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
			$this->lv070=$vrow['lv070'];
			$this->lv071=$vrow['lv071'];
			$this->lv072=$vrow['lv072'];
			$this->lv073=$vrow['lv073'];
			$this->lv074=$vrow['lv074'];
			$this->lv075=$vrow['lv075'];
			$this->lv076=$vrow['lv076'];
			$this->lv077=$vrow['lv077'];
			$this->lv078=$vrow['lv078'];
			$this->lv079=$vrow['lv079'];
			$this->lv080=$vrow['lv080'];
			$this->lv081=$vrow['lv081'];
			$this->lv082=$vrow['lv082'];
			$this->lv083=$vrow['lv083'];
			$this->lv084=$vrow['lv084'];
			$this->lv085=$vrow['lv085'];
			$this->lv086=$vrow['lv086'];
			$this->lv087=$vrow['lv087'];
			$this->lv088=$vrow['lv088'];
			$this->lv089=$vrow['lv089'];
			$this->lv090=$vrow['lv090'];
			$this->lv091=$vrow['lv091'];
			$this->lv092=$vrow['lv092'];
			$this->lv093=$vrow['lv093'];
			$this->lv094=$vrow['lv094'];
			$this->lv095=$vrow['lv095'];
			$this->lv096=$vrow['lv096'];
			$this->lv097=$vrow['lv097'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
		}
	}
	function LV_LoadActiveID($vlv002,$vlv020)
	{
		$lvsql="select * from  tc_lv0021 Where lv002='$vlv002' and lv053='$vlv020'";
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
			$this->lv048=$vrow['lv048'];
			$this->lv048=$vrow['lv048'];
			$this->lv049=$vrow['lv049'];
			$this->lv050=$vrow['lv050'];
			$this->lv051=$vrow['lv051'];
			$this->lv052=$vrow['lv052'];
			$this->lv053=$vrow['lv053'];
			$this->lv054=$vrow['lv054'];
			$this->lv055=$vrow['lv055'];
			$this->lv056=$vrow['lv056'];
			$this->lv057=$vrow['lv057'];
			$this->lv058=$vrow['lv058'];
			$this->lv059=$vrow['lv059'];
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
			$this->lv070=$vrow['lv070'];
			$this->lv071=$vrow['lv071'];
			$this->lv072=$vrow['lv072'];
			$this->lv073=$vrow['lv073'];
			$this->lv074=$vrow['lv074'];
			$this->lv075=$vrow['lv075'];
			$this->lv076=$vrow['lv076'];
			$this->lv077=$vrow['lv077'];
			$this->lv078=$vrow['lv078'];
			$this->lv079=$vrow['lv079'];
			$this->lv080=$vrow['lv080'];
			$this->lv081=$vrow['lv081'];
			$this->lv082=$vrow['lv082'];
			$this->lv083=$vrow['lv083'];
			$this->lv084=$vrow['lv084'];
			$this->lv085=$vrow['lv085'];
			$this->lv086=$vrow['lv086'];
			$this->lv087=$vrow['lv087'];
			$this->lv088=$vrow['lv088'];
			$this->lv089=$vrow['lv089'];
			$this->lv090=$vrow['lv090'];
			$this->lv091=$vrow['lv091'];
			$this->lv092=$vrow['lv092'];
			$this->lv093=$vrow['lv093'];
			$this->lv094=$vrow['lv094'];
			$this->lv095=$vrow['lv095'];
			$this->lv096=$vrow['lv096'];
			$this->lv097=$vrow['lv097'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
		}
		else
			$this->lv001=null;
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  tc_lv0021 Where lv001='$vlv001'";
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
			$this->lv048=$vrow['lv048'];
			$this->lv048=$vrow['lv048'];
			$this->lv049=$vrow['lv049'];
			$this->lv050=$vrow['lv050'];
			$this->lv051=$vrow['lv051'];
			$this->lv052=$vrow['lv052'];
			$this->lv053=$vrow['lv053'];
			$this->lv054=$vrow['lv054'];
			$this->lv055=$vrow['lv055'];
			$this->lv056=$vrow['lv056'];
			$this->lv057=$vrow['lv057'];
			$this->lv058=$vrow['lv058'];
			$this->lv059=$vrow['lv059'];
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
			$this->lv070=$vrow['lv070'];
			$this->lv071=$vrow['lv071'];
			$this->lv072=$vrow['lv072'];
			$this->lv073=$vrow['lv073'];
			$this->lv074=$vrow['lv074'];
			$this->lv075=$vrow['lv075'];
			$this->lv076=$vrow['lv076'];
			$this->lv077=$vrow['lv077'];
			$this->lv078=$vrow['lv078'];
			$this->lv079=$vrow['lv079'];
			$this->lv080=$vrow['lv080'];
			$this->lv081=$vrow['lv081'];
			$this->lv082=$vrow['lv082'];
			$this->lv083=$vrow['lv083'];
			$this->lv084=$vrow['lv084'];
			$this->lv085=$vrow['lv085'];
			$this->lv086=$vrow['lv086'];
			$this->lv087=$vrow['lv087'];
			$this->lv088=$vrow['lv088'];
			$this->lv089=$vrow['lv089'];
			$this->lv090=$vrow['lv090'];
			$this->lv091=$vrow['lv091'];
			$this->lv092=$vrow['lv092'];
			$this->lv093=$vrow['lv093'];
			$this->lv094=$vrow['lv094'];
			$this->lv095=$vrow['lv095'];
			$this->lv096=$vrow['lv096'];
			$this->lv097=$vrow['lv097'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
		}
	}
	function LV_GetAmountTypeCalID($vlv002,$vlv098,$vlv032,$vField)
	{
		$lvsql="select $vField from  tc_lv0021 Where lv002='$vlv002' and lv098='$vlv098' and lv032='$vlv032'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return (float)$vrow[$vField];
		}
		return 0;
	}
	function LV_LoadTypeCalID($vlv002,$vlv098,$vlv032)
	{
		$lvsql="select * from  tc_lv0021 Where lv002='$vlv002' and lv098='$vlv098' and lv032='$vlv032'";
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
			$this->lv048=$vrow['lv048'];
			$this->lv048=$vrow['lv048'];
			$this->lv049=$vrow['lv049'];
			$this->lv050=$vrow['lv050'];
			$this->lv051=$vrow['lv051'];
			$this->lv052=$vrow['lv052'];
			$this->lv053=$vrow['lv053'];
			$this->lv054=$vrow['lv054'];
			$this->lv055=$vrow['lv055'];
			$this->lv056=$vrow['lv056'];
			$this->lv057=$vrow['lv057'];
			$this->lv058=$vrow['lv058'];
			$this->lv059=$vrow['lv059'];
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
			$this->lv070=$vrow['lv070'];
			$this->lv071=$vrow['lv071'];
			$this->lv072=$vrow['lv072'];
			$this->lv073=$vrow['lv073'];
			$this->lv074=$vrow['lv074'];
			$this->lv075=$vrow['lv075'];
			$this->lv076=$vrow['lv076'];
			$this->lv077=$vrow['lv077'];
			$this->lv078=$vrow['lv078'];
			$this->lv079=$vrow['lv079'];
			$this->lv080=$vrow['lv080'];
			$this->lv081=$vrow['lv081'];
			$this->lv082=$vrow['lv082'];
			$this->lv083=$vrow['lv083'];
			$this->lv084=$vrow['lv084'];
			$this->lv085=$vrow['lv085'];
			$this->lv086=$vrow['lv086'];
			$this->lv087=$vrow['lv087'];
			$this->lv088=$vrow['lv088'];
			$this->lv089=$vrow['lv089'];
			$this->lv090=$vrow['lv090'];
			$this->lv091=$vrow['lv091'];
			$this->lv092=$vrow['lv092'];
			$this->lv093=$vrow['lv093'];
			$this->lv094=$vrow['lv094'];
			$this->lv095=$vrow['lv095'];
			$this->lv096=$vrow['lv096'];
			$this->lv097=$vrow['lv097'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
		}
	}
	function LV_LoadCurrentID($vlv002,$vlv098)
	{
		$lvsql="select * from  tc_lv0021 Where lv002='$vlv002' and lv098='$vlv098'";
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
			$this->lv048=$vrow['lv048'];
			$this->lv048=$vrow['lv048'];
			$this->lv049=$vrow['lv049'];
			$this->lv050=$vrow['lv050'];
			$this->lv051=$vrow['lv051'];
			$this->lv052=$vrow['lv052'];
			$this->lv053=$vrow['lv053'];
			$this->lv054=$vrow['lv054'];
			$this->lv055=$vrow['lv055'];
			$this->lv056=$vrow['lv056'];
			$this->lv057=$vrow['lv057'];
			$this->lv058=$vrow['lv058'];
			$this->lv059=$vrow['lv059'];
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
			$this->lv070=$vrow['lv070'];
			$this->lv071=$vrow['lv071'];
			$this->lv072=$vrow['lv072'];
			$this->lv073=$vrow['lv073'];
			$this->lv074=$vrow['lv074'];
			$this->lv075=$vrow['lv075'];
			$this->lv076=$vrow['lv076'];
			$this->lv077=$vrow['lv077'];
			$this->lv078=$vrow['lv078'];
			$this->lv079=$vrow['lv079'];
			$this->lv080=$vrow['lv080'];
			$this->lv081=$vrow['lv081'];
			$this->lv082=$vrow['lv082'];
			$this->lv083=$vrow['lv083'];
			$this->lv084=$vrow['lv084'];
			$this->lv085=$vrow['lv085'];
			$this->lv086=$vrow['lv086'];
			$this->lv087=$vrow['lv087'];
			$this->lv088=$vrow['lv088'];
			$this->lv089=$vrow['lv089'];
			$this->lv090=$vrow['lv090'];
			$this->lv091=$vrow['lv091'];
			$this->lv092=$vrow['lv092'];
			$this->lv093=$vrow['lv093'];
			$this->lv094=$vrow['lv094'];
			$this->lv095=$vrow['lv095'];
			$this->lv096=$vrow['lv096'];
			$this->lv097=$vrow['lv097'];
			$this->lv098=$vrow['lv098'];
			$this->lv099=$vrow['lv099'];
			$this->lv100=$vrow['lv100'];
			$this->lv101=$vrow['lv101'];
		}
	}
	function LV_Insert()
	{
		if($this->isAdd==0) return false;
		$lvsql="insert into tc_lv0021 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027,lv028,lv029,lv030,lv031,lv032,lv033,lv034,lv035,lv036,lv037,lv038,lv039,lv040,lv041,lv042,lv043,lv044,lv045,lv046,lv047,lv048,lv049,lv050,lv051,lv052,lv053,lv054,lv055,lv056,lv057,lv058,lv059,lv060,lv061,lv062,lv063,lv064,lv065,lv066,lv067,lv068,lv069,lv070,lv071,lv072,lv073,lv074,lv075,lv076,lv077,lv078,lv079,lv080,lv081,lv082,lv083,lv084,lv085,lv086,lv087,lv088,lv089,lv090,lv091,lv092,lv093,lv094,lv095,lv096,lv097,lv098,lv099,lv100,lv101) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022','$this->lv023','$this->lv024','$this->lv025','$this->lv026','$this->lv027','$this->lv028','$this->lv029','$this->lv030','$this->lv031','$this->lv032','$this->lv033','$this->lv034','$this->lv035','$this->lv036','$this->lv037','$this->lv038','$this->lv039','$this->lv040','$this->lv041','$this->lv042','$this->lv043','$this->lv044','$this->lv045','$this->lv046','$this->lv047','$this->lv048','$this->lv049','$this->lv050','$this->lv051','$this->lv052','$this->lv053','$this->lv054','$this->lv055','$this->lv056','$this->lv057','$this->lv058','$this->lv059','$this->lv060','$this->lv061','$this->lv062','$this->lv063','$this->lv064','$this->lv065','$this->lv066','$this->lv067','$this->lv068','$this->lv069','$this->lv070','$this->lv071','$this->lv072','$this->lv073','$this->lv074','$this->lv075','$this->lv076','$this->lv077','$this->lv078','$this->lv079','$this->lv080','$this->lv081','$this->lv082','$this->lv083','$this->lv084','$this->lv085','$this->lv086','$this->lv087','$this->lv088','$this->lv089','$this->lv090','$this->lv091','$this->lv092','$this->lv093','$this->lv094','$this->lv095','$this->lv096','$this->lv097','$this->lv098','$this->lv099','$this->lv100','$this->lv101')";
		$vReturn= db_query($lvsql);
		if($vReturn) {
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0021.insert',sof_escape_string($lvsql));
		$this->LV_InsertOther($this->lv001,$this->lv011);
		}
		return $vReturn;
	}	
	function LV_InsertOther($lv002,$vlv0022)
	{
		
		if($this->isAdd==0) return false;
		$lvsql="insert into tc_lv0014 (lv002,lv003,lv004) select '$lv002',lv003,lv004 from tc_lv0014 where lv002='$vlv0022'";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0014.insert',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Update()
	{
		 $lvsql="Update tc_lv0021 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv018='$this->lv018',lv019='$this->lv019',lv020='$this->lv020',lv021='$this->lv021',lv022='$this->lv022',lv023='$this->lv023',lv024='$this->lv024',lv025='$this->lv025',lv026='$this->lv026',lv027='$this->lv027' ,lv028='$this->lv028',lv029='$this->lv029',lv030='$this->lv030',lv031='$this->lv031',lv032='$this->lv032',lv033='$this->lv033',lv034='$this->lv034',lv035='$this->lv035',lv036='$this->lv036',lv037='$this->lv037',lv038='$this->lv038',lv039='$this->lv039',lv040='$this->lv040',lv041='$this->lv041',lv042='$this->lv042',lv043='$this->lv043',lv044='$this->lv044',lv045='$this->lv045',lv046='$this->lv046',lv047='$this->lv047',lv048='$this->lv048',lv049='$this->lv049',lv050='$this->lv050',lv051='$this->lv051',lv052='$this->lv052',lv053='$this->lv053',lv054='$this->lv054',lv055='$this->lv055',lv056='$this->lv056',lv057='$this->lv057',lv058='$this->lv058',lv059='$this->lv059',lv060='$this->lv060',lv061='$this->lv061',lv062='$this->lv062',lv063='$this->lv063',lv064='$this->lv064',lv065='$this->lv065',lv066='$this->lv066',lv067='$this->lv067',lv068='$this->lv068',lv069='$this->lv069',lv070='$this->lv070',lv071='$this->lv071',lv072='$this->lv072',lv073='$this->lv073',lv074='$this->lv074',lv075='$this->lv075',lv076='$this->lv076',lv077='$this->lv077',lv078='$this->lv078',lv079='$this->lv079',lv080='$this->lv080',lv081='$this->lv081',lv082='$this->lv082',lv083='$this->lv083',lv084='$this->lv084',lv085='$this->lv085',lv086='$this->lv086',lv087='$this->lv087',lv088='$this->lv088',lv089='$this->lv089',lv090='$this->lv090',lv091='$this->lv091',lv092='$this->lv092',lv093='$this->lv093',lv094='$this->lv094',lv095='$this->lv095',lv096='$this->lv096',lv097='$this->lv097',lv098='$this->lv098',lv099='$this->lv099',lv100='$this->lv100' where  lv001='$this->lv001' AND lv101<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0021.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM tc_lv0021  WHERE tc_lv0021.lv101<=0 AND tc_lv0021.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0021.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0021 set lv086=lv086+1  WHERE tc_lv0021.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) 
		{
			$this->LV_SendMailAll($lvarr);
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0021.approval',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0021 set lv086=lv086-1  WHERE tc_lv0021.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0021.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_SendMailAll($lvarr)
	{
		$lvsql="select A.lv001,A.lv002,A.lv098 from tc_lv0021 A where A.lv001 in($lvarr)";
		$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
		$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
		$vReturn= db_query($lvsql);
		while ($vrow = db_fetch_array ($vReturn)){
				$str = "";
		$motc_lv0013->LV_LoadID($vrow['lv098']);
		$mohr_lv0020->LV_LoadID($vrow['lv002']);
		$lvtitle=$mohr_lv0020->lv001." ".$motc_lv0013->lv002;
		$lvemail="newsletter@tdl-mep.vn";
		$vTo="";
		if($mohr_lv0020->lv040!="" && $mohr_lv0020->lv041!="")	
		{
			$vTo=$mohr_lv0020->lv040.",".$mohr_lv0020->lv041;
		}
		else
		{
			if($mohr_lv0020->lv040!="")	$vTo=$mohr_lv0020->lv040;
			if($mohr_lv0020->lv041!="")	$vTo=$mohr_lv0020->lv041;
		}
		$lvcontent=$this->LV_GetOnePerson($vrow['lv001']);
		$lvuser=$_SESSION['ERPSOFV2RUserID'];
		if($vTo!="")
			$this->LV_SendMail($lvcontent,$lvtitle,$lvuser,$lvemail,$vTo);
		else
			echo 'Email ['.$vrow['lv002'].'] không có'; 
			
		}
	}	
	function LV_SendMail($lvcontent,$lvtitle,$lvuser,$lvemail,$vTo)
	{
		$lvListId_del="";
		$lvml_lv0008=new ml_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0008');
		$lvml_lv0100=new ml_lv0100($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0100');		
		$lvml_lv0009=new ml_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0009');
		$lvml_lv0009->LV_LoadSMTP();
		$lvml_lv0008->LV_LoadUser($lvuser,$lvemail);
			$this->Domain=$lvml_lv0009->lv010;
			$vstrTo=SplitTo(str_replace(";",",",str_replace(" ","",$vTo)),"<",">",",");
			$vstrToSend=$this->SplitToEsc($vstrTo,",",0);
			$lvml_lv0100=new ml_lv0100($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0100');
			$lvml_lv0100->To(explode(",",$vstrToSend));		
			if($lvml_lv0008->lv005==1)
			{
					$lvml_lv0100->lvml_lv0009=$lvml_lv0009;
					$lvml_lv0100->lvml_lv0008=$lvml_lv0008;
					$lvml_lv0100->To(explode(",",$vstrToSend));
					$lvml_lv0100->From($lvemail);
					$lvml_lv0100->Subject($lvtitle);
					$lvml_lv0100->Priority(3);	
					$lvml_lv0100->Content_type("multipart/related");
					$lvml_lv0100->charset="utf-8";
					$lvml_lv0100->ctencoding="quoted-printable";
					$lvml_lv0100->Cc(explode(",",$vstrCCSend));
					$lvml_lv0100->Bcc(explode(",",$vstrBCCSend));
					$lvml_lv0100->Body($lvcontent,'');
					$lvml_lv0100->Content_type('text/html');
					if($lvml_lv0100->Send())
					{
						echo 'Thành công gửi! Email:'.$vTo."<br/>";
					}
					else	
						echo 'Không thành công gửi! Email:'.$vTo."<br/>";

			}
			else	
						echo 'Không thành công gửi! Email:'.$vTo."<br/>";

		return $vReturn;
	}
	function SplitToEsc($vAddress,$vPara1,$vopt)
	{
		$strTemp=$vAddress;
		$vArrTemp=explode($vPara1,$strTemp);
		$strReturn="";
		if(count($vArrTemp)==0) return $vAddress;
		for($i=0;$i<count($vArrTemp);$i++)
		{
			if($vopt==1)
			{
				if (!(strpos($vArrTemp[$i],"@".$this->Domain)===false))
				{
					if($strReturn!="")
						$strReturn=$strReturn.$vPara1.trim($vArrTemp[$i]);
					else
						$strReturn=$strReturn.trim($vArrTemp[$i]);			
				}		
			}
			else
			{
				if ((strpos($vArrTemp[$i],"@".$this->Domain)===false))
				{
					if($strReturn!="")
						$strReturn=$strReturn.$vPara1.trim($vArrTemp[$i]);
					else
						$strReturn=$strReturn.trim($vArrTemp[$i]);			
				}		
			
			}
		}
		return $strReturn;
	}
	function LV_GetOnePerson($vlv001)
	{
	$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
	$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
	$motc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
	$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
	$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
	$motc_lv0020->LV_LoadID($vlv001);
	$motc_lv0013->LV_LoadID($motc_lv0020->lv098);
	$mohr_lv0020->LV_LoadID($motc_lv0020->lv002);
	$vFNUsed=$motc_lv0008->LV_CheckOne_FNCB($motc_lv0020->lv002,$motc_lv0013->lv007,0);
	$vFNMonth=$motc_lv0009->LV_FNLoadMonthID($motc_lv0020->lv002,$motc_lv0013->lv006,$motc_lv0013->lv007);
	$vstrRetrun='';
		$vstrRetrun=$vstrRetrun.'
<table cellpadding="0" cellspacing="0" border="1" width="760">
<tr>
  <td width="14%">HỌ TÊN/FULL NAME </td>
  <td width="32%">'.($mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002).'</td>
  <td width="15%">MÃ NV/ EMP.CODE </td>
  <td width="23%">'.($mohr_lv0020->lv001).'</td>
  </tr>
<tr>
 
  <td>LƯƠNG CƠ BẢN/BASIC </td>
  <td>'.($motc_lv0020->FormatView($motc_lv0020->lv006,10)).'</td>
   <td>Bộ phận/ Section </td>
  <td>'.($mohr_lv0020->getvaluelink('lv029',$mohr_lv0020->lv029)).'</td>
  </tr>
</table>
<br/>
<table cellpadding="0" cellspacing="0" border="1" width="760">  
<tr>
  <td width="20%">Ngày làm việc/ working day </td>
  <td>'.($motc_lv0013->FormatView($motc_lv0020->lv018,10)).'</td>
  <td width="20%">Phép năm/ Annual leave  </td>
  <td>'.($mohr_lv0020->FormatView($motc_lv0020->lv016,10)).'</td>
  <td width="20%">Không lương/ Ul </td>
  <td>'.($mohr_lv0020->FormatView($motc_lv0020->lv020,10)).'</td>
  </tr>
 <tr>
  <td>Ngày lễ và nghỉ bù/ compensation leave </td>
  <td>'.($motc_lv0013->FormatView($motc_lv0020->lv015,10)).'</td>
  <td>Bệnh/Medical leave   </td>
  <td>'.($mohr_lv0020->FormatView($motc_lv0020->lv016,10)).'</td>
  <td>Làm vào ngày lễ/ PH  </td>
  <td>'.($mohr_lv0020->FormatView($motc_lv0020->lv026,10)).'</td>
  </tr>
</table>
<br/>
';
	$vSumAdd=0;
	$vSumSub=0;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv035;
	$vSumSub=$vSumSub+$motc_lv0020->lv062;
	$vSumSub=$vSumSub+$motc_lv0020->lv063;
	$vSumSub=$vSumSub+$motc_lv0020->lv064;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv040;
	$vSumSub=$vSumSub+$motc_lv0020->lv065;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv037;
	$vSumSub=$vSumSub+$motc_lv0020->lv066;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv038;
	$vSumSub=$vSumSub+$motc_lv0020->lv068;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv039;;
	$vSumSub=$vSumSub+$motc_lv0020->lv067;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv047;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv048;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv049;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv050;
	$vMeal=$motc_lv0020->LV_GetPriceProduct($motc_lv0020->lv098,'Meal');
	if($vMeal==0) $vMeal=1;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv041;;
	$vTransport=$motc_lv0020->LV_GetPriceProduct($motc_lv0020->lv098,'Transport');
	if($vTransport==0) $vTransport=1;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv042;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv044;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv043;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv045;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv056;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv060;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv046;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv051;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv031;
			
$vstrRetrun=$vstrRetrun.'
<table cellpadding="0" cellspacing="0" border="1" width="760">
	<colgroup>
		<col width="187" />
		<col width="109" />
		<col width="105" />
		<col width="108" />
		<col width="121" />
		<col width="135" />
		<col width="84" /></colgroup>
	<tbody>
		<tr height="36">
			<td height="36" width="187">Các khoản thu nhập/ Incomes&nbsp;</td>
			<td width="109">Số <br />
				Ngày/giờ&nbsp;</td>
			<td width="105">Số tiền&nbsp;</td>
			<td colspan="2" width="229">Các khoản giảm trừ/ Deductions&nbsp;</td>
			<td colspan="2" width="219">Phép năm T1/2014&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Ngày làm việc</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv018,10)).'</td>
			<td align="right">'.$motc_lv0013->FormatView($motc_lv0020->lv035,10).'</td>
			<td>Tạm ứng</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv062,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Lương điều chỉnh&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Tạm ứng riêng</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv063,10)).'</td>
			<td>Phép năm đã sử dụng trong năm&nbsp;</td>
			<td>'.($motc_lv0008->FormatView($motc_lv0008->lv003-$vFNUsed,10)).'</td>
		</tr>
		<tr height="19">
			<td height="19">Tăng ca Ngày thường 150%</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv022,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv036,10)).'</td>
			<td>BHXH</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv065,10)).'</td>
			<td>Phép năm nghỉ trong tháng</td>
			<td>'.($motc_lv0008->FormatView($vFNMonth,10)).'</td>
		</tr>
		<tr height="19">
			<td height="19">Tăng ca Ngày nghỉ lễ 300%</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv026,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv040,10)).'</td>
			<td>BHYT&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv066,10)).'</td>
			<td>Phép năm còn lại&nbsp;</td>
			<td>'.($motc_lv0008->FormatView($vFNUsed,10)).'</td>
		</tr>
		<tr height="19">
			<td height="19">Tăng ca (Chủ nhật) 200%</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv023,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv037,10)).'</td>
			<td>BHTN</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv067,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Tăng ca&nbsp; ca đêm (195%)</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv024,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv038,10)).'</td>
			<td>Đoàn phí CĐ&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv068,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Tăng ca CN của CN 260%</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv025,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv039,10)).'</td>
			<td>Thuế TNCN</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv067,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp trượt giá&nbsp;</td>
			<td align="center"> - </td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv047,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp vận hànhnh&nbsp;</td>
			<td align="center"> - </td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv048,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp chức vụ</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv049,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp quản lý&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv050,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp cơm</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv041/$vMeal,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv041,10)).'</td>
			<td>Kh&aacute;c&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp xăng</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv042/$vTransport,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv042,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp phòng trộn</td>
			<td align="center">-</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv044,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp ca đêm</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv019,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv043,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp thôi việc</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -&nbsp;&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Hoàn trả</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -&nbsp;&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Chuyên cần</td>
			<td></td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv045,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Lucky Money</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv031,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Bốc xếp</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv056,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Lương th&aacute;ng 13</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv060,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	';
		switch($motc_lv0020->lv095)
		{	
			case 2:
		$vstrRetrun=$vstrRetrun.'
		<tr height="19">
			<td height="19">Trợ cấp OT (QC)&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv046,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		';
				break;
			case 3:
		$vstrRetrun=$vstrRetrun.'
		<tr height="19">
			<td height="19">SPI & Commission </td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv051,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		';
			
		}
$vstrRetrun=$vstrRetrun.'		
		<tr height="26">
			<td height="26">Tổng cộng/ Total</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($vSumAdd,10)).'</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($vSumSub,10)).'</td>
			<td colspan="2" rowspan="3" width="219">Cảm ơn sự nỗ lực v&agrave; hợp t&aacute;c của <br />
				Các bạn trong thời gian qua&nbsp;</td>
		</tr>
		<tr height="23">
			<td height="23">Thực nhận còn lại/ Remaining&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($vSumAdd-$vSumSub,10)).'</td>
		</tr>
	</tbody>
</table>
<br/>
<table cellpadding="0" cellspacing="0" border="0" width="760">
	<colgroup>
		<col width="187" />
		<col width="109" />
		<col width="105" />
		<col width="108" />
		<col width="121" />
		<col width="135" />
		<col width="84" /></colgroup>
	<tbody>
		<tr height="19">
			<td height="19" width="187">Prepared by</td>
			<td width="109">HR Dept</td>
			<td width="121">&nbsp;</td>
		</tr>
		<tr height="19">
			<td colspan="6">&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Remarks :</td>
			<td colspan="5">Salary period from';
			$motc_lv0020->lang="EN"; 
		$vstrRetrun=$vstrRetrun.$motc_lv0020->FormatView($motc_lv0020->lv004,2).' till '.($motc_lv0020->FormatView($motc_lv0020->lv005,2)).' / Lương được tính từ';
		$motc_lv0020->lang="VN"; 
		$vstrRetrun=$vstrRetrun.$motc_lv0020->FormatView($motc_lv0020->lv004,2).'  đến '.($motc_lv0020->FormatView($motc_lv0020->lv005,2)).'</td>
		</tr>
	</tbody>
</table>
  ';
	return $vstrRetrun;
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
		if($this->lv012!="") $strCondi=$strCondi." and lv012  like '%$this->lv012%'";
		if($this->lv013!="") $strCondi=$strCondi." and lv013  like '%$this->lv013%'";
		if($this->lv014!="") $strCondi=$strCondi." and lv014  like '%$this->lv014%'";
		if($this->lv015!="") $strCondi=$strCondi." and lv015  like '%$this->lv015%'";
		if($this->lv016!="") $strCondi=$strCondi." and lv016  like '%$this->lv016%'";
		if($this->lv017!="") $strCondi=$strCondi." and lv017  like '%$this->lv017%'";
		if($this->lv018!="") $strCondi=$strCondi." and lv018  like '%$this->lv018%'";
		if($this->lv019!="") $strCondi=$strCondi." and lv019  like '%$this->lv019%'";
		if($this->lv020!="") $strCondi=$strCondi." and lv020  like '%$this->lv020%'";
		if($this->lv021!="") $strCondi=$strCondi." and lv021  like '%$this->lv021%'";
		if($this->lv022!="") $strCondi=$strCondi." and lv022  like '%$this->lv022%'";
		if($this->lv023!="") $strCondi=$strCondi." and lv023  like '%$this->lv023%'";
		if($this->lv024!="") $strCondi=$strCondi." and lv024  like '%$this->lv024%'";
		if($this->lv025!="") $strCondi=$strCondi." and lv025  like '%$this->lv025%'";
		if($this->lv026!="") $strCondi=$strCondi." and lv026  like '%$this->lv026%'";
		if($this->lv027!="") $strCondi=$strCondi." and lv027  like '%$this->lv027%'";
		if($this->lv028!="") $strCondi=$strCondi." and lv028  like '%$this->lv028%'";
		if($this->lv029!="") $strCondi=$strCondi." and lv029  like '%$this->lv029%'";
		if($this->lv030!="") $strCondi=$strCondi." and lv030  like '%$this->lv030%'";
		if($this->lv031!="") $strCondi=$strCondi." and lv031  like '%$this->lv031%'";
		if($this->lv032!="") $strCondi=$strCondi." and lv032  like '%$this->lv032%'";
		if($this->lv033!="") $strCondi=$strCondi." and lv033  like '%$this->lv033%'";
		if($this->lv034!="") $strCondi=$strCondi." and lv034  like '%$this->lv034%'";
		if($this->lv035!="") $strCondi=$strCondi." and lv035  like '%$this->lv035%'";
		if($this->lv053!="") $strCondi=$strCondi." and lv053  like '%$this->lv053%'";
		if($this->lv098!="") $strCondi=$strCondi." and lv098  like '%$this->lv098%'";
		return $strCondi;
	}
	//////////Get Filter///////////////
	protected function GetConditionOther()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="") $strCondi=$strCondi." and A.lv007  like '%$this->lv007%'";
		if($this->lv008!="") $strCondi=$strCondi." and A.lv008  like '%$this->lv008%'";
		if($this->lv009!="") $strCondi=$strCondi." and A.lv009  like '%$this->lv009%'";
		if($this->lv010!="") $strCondi=$strCondi." and A.lv010  like '%$this->lv010%'";
		if($this->lv011!="") $strCondi=$strCondi." and A.lv011  like '%$this->lv011%'";
		if($this->lv012!="") $strCondi=$strCondi." and A.lv012  like '%$this->lv012%'";
		if($this->lv013!="") $strCondi=$strCondi." and A.lv013  like '%$this->lv013%'";
		if($this->lv014!="") $strCondi=$strCondi." and A.lv014  like '%$this->lv014%'";
		if($this->lv015!="") $strCondi=$strCondi." and A.lv015  like '%$this->lv015%'";
		if($this->lv016!="") $strCondi=$strCondi." and A.lv016  like '%$this->lv016%'";
		if($this->lv017!="") $strCondi=$strCondi." and A.lv017  like '%$this->lv017%'";
		if($this->lv018!="") $strCondi=$strCondi." and A.lv018  like '%$this->lv018%'";
		if($this->lv019!="") $strCondi=$strCondi." and A.lv019  like '%$this->lv019%'";
		if($this->lv020!="") $strCondi=$strCondi." and A.lv020  like '%$this->lv020%'";
		if($this->lv021!="") $strCondi=$strCondi." and A.lv021  like '%$this->lv021%'";
		if($this->lv022!="") $strCondi=$strCondi." and A.lv022  like '%$this->lv022%'";
		if($this->lv023!="") $strCondi=$strCondi." and A.lv023  like '%$this->lv023%'";
		if($this->lv024!="") $strCondi=$strCondi." and A.lv024  like '%$this->lv024%'";
		if($this->lv025!="") $strCondi=$strCondi." and A.lv025  like '%$this->lv025%'";
		if($this->lv026!="") $strCondi=$strCondi." and A.lv026  like '%$this->lv026%'";
		if($this->lv027!="") $strCondi=$strCondi." and A.lv027  like '%$this->lv027%'";
		if($this->lv028!="") $strCondi=$strCondi." and A.lv028  like '%$this->lv028%'";
		if($this->lv029!="") $strCondi=$strCondi." and A.lv029  like '%$this->lv029%'";
		if($this->lv030!="") $strCondi=$strCondi." and A.lv030  like '%$this->lv030%'";
		if($this->lv031!="") $strCondi=$strCondi." and A.lv031  like '%$this->lv031%'";
		if($this->lv032!="") $strCondi=$strCondi." and A.lv032  like '%$this->lv032%'";
		if($this->lv033!="") $strCondi=$strCondi." and A.lv033  like '%$this->lv033%'";
		if($this->lv034!="") $strCondi=$strCondi." and A.lv034  like '%$this->lv034%'";
		if($this->lv035!="") $strCondi=$strCondi." and A.lv035  like '%$this->lv035%'";
		if($this->lv053!="") $strCondi=$strCondi." and A.lv053  like '%$this->lv053%'";
		if($this->lv098!="") $strCondi=$strCondi." and A.lv098  like '%$this->lv098%'";
		switch($this->Bank)
		{
			case 2:
				$strCondi=$strCondi." and (trim(A.lv099) = '' or ISNULL(A.lv099))";
				break;
			case 1:
				$strCondi=$strCondi." and (trim(A.lv099) <> '')";
				break;
		}
		if($this->lv201!="") $strCondi=$strCondi." and (A.lv002 in (select B.lv001 from hr_lv0020 B where B.lv029 in ('".str_replace(",","','",$this->lv201)."')	))";
		if($this->lv202!="") $strCondi=$strCondi." and (A.lv002 in (select B.lv001 from hr_lv0020 B where B.lv009 in ('".str_replace(",","','",$this->lv202)."')	))";
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0021 WHERE 1=1 ".$this->GetCondition();
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
		$sqlS = "SELECT * FROM tc_lv0021 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			if($vrow['lv086']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
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
			window.open('".$this->Dir."tc_lv0020/?lang=".$this->lang."&func='+value+'&NVID=".base64_encode($this->lv002)."&CalID=".base64_encode($this->lv020)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM tc_lv0021 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
	//////////////////////Buil list////////////////////
	function LV_BuilListReportOther($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
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
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		<tr class=\"lvlineboldtable\"><td colspan='2'>".($this->ArrPush[1000])."</td>@#02</tr>
		</table>
		";
		$lvTdS="<td>@#01</td>";
		$lvTrH="<tr class=\"lvhtable\">			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\" style='white-space:nowrap'>@02</td>";
		$sqlS = "SELECT A.*  FROM tc_lv0021 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$strH="<td width=\"@01\" class=\"lvhtable\">".($this->ArrPush[1])."</td>";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
		$strDepart="";	
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vlv091=$vlv091+$vrow['lv091'];
			$vlv090=$vlv090+$vrow['lv090'];
			$vlv089=$vlv089+$vrow['lv089'];
			$vlv088=$vlv088+$vrow['lv088'];
			$vlv087=$vlv087+$vrow['lv087'];
			$vlv086=$vlv086+$vrow['lv086'];
			$vlv085=$vlv085+$vrow['lv085'];
			$vlv084=$vlv084+$vrow['lv084'];
			$vlv083=$vlv083+$vrow['lv083'];
			$vlv082=$vlv082+$vrow['lv082'];
			$vlv081=$vlv081+$vrow['lv081'];
			$vlv080=$vlv080+$vrow['lv080'];
			$vlv079=$vlv079+$vrow['lv079'];
			$vlv078=$vlv078+$vrow['lv078'];
			$vlv077=$vlv077+$vrow['lv077'];
			$vlv076=$vlv076+$vrow['lv076'];
			$vlv075=$vlv075+$vrow['lv075'];
			$vlv074=$vlv074+$vrow['lv074'];
			$vlv073=$vlv073+$vrow['lv073'];
			$vlv072=$vlv072+$vrow['lv072'];
			$vlv071=$vlv071+$vrow['lv071'];
			$vlv070=$vlv070+$vrow['lv070'];
			$vlv069=$vlv069+$vrow['lv069'];
			$vlv068=$vlv068+$vrow['lv068'];
			$vlv067=$vlv067+$vrow['lv067'];
			$vlv066=$vlv066+$vrow['lv066'];
			$vlv065=$vlv065+$vrow['lv065'];
			$vlv064=$vlv064+$vrow['lv064'];
			$vlv063=$vlv063+$vrow['lv063'];
			$vlv062=$vlv062+$vrow['lv062'];
			$vlv061=$vlv061+$vrow['lv061'];
			$vlv060=$vlv060+$vrow['lv060'];
			$vlv059=$vlv059+$vrow['lv059'];
			$vlv058=$vlv058+$vrow['lv058'];
			$vlv057=$vlv057+$vrow['lv057'];
			$vlv056=$vlv056+$vrow['lv056'];
			$vlv055=$vlv055+$vrow['lv055'];
			$vlv054=$vlv054+$vrow['lv053'];
			$vlv053=$vlv053+$vrow['lv053'];
			$vlv052=$vlv052+$vrow['lv052'];
			$vlv051=$vlv051+$vrow['lv051'];
			$vlv050=$vlv050+$vrow['lv050'];
			$vlv049=$vlv049+$vrow['lv049'];
			$vlv048=$vlv048+$vrow['lv048'];
			$vlv047=$vlv047+$vrow['lv047'];
			$vlv046=$vlv046+$vrow['lv046'];
			$vlv045=$vlv045+$vrow['lv045'];
			$vlv044=$vlv044+$vrow['lv044'];
			$vlv043=$vlv043+$vrow['lv043'];
			$vlv042=$vlv042+$vrow['lv042'];
			$vlv041=$vlv041+$vrow['lv041'];
			$vlv040=$vlv040+$vrow['lv040'];
			$vlv039=$vlv039+$vrow['lv039'];
			$vlv038=$vlv038+$vrow['lv038'];
			$vlv037=$vlv037+$vrow['lv037'];
			$vlv036=$vlv036+$vrow['lv036'];
			$vlv035=$vlv035+$vrow['lv035'];
			$vlv034=$vlv034+$vrow['lv034'];
			$vlv033=$vlv033+$vrow['lv033'];
			$vlv032=$vlv032+$vrow['lv032'];
			$vlv029=$vlv029+$vrow['lv029'];
			$vlv028=$vlv028+$vrow['lv028'];
			$vlv026=$vlv026+$vrow['lv026'];
			$vlv027=$vlv027+$vrow['lv027'];
			$vlv025=$vlv025+$vrow['lv025'];
			$vlv024=$vlv024+$vrow['lv024'];
			$vlv023=$vlv023+$vrow['lv023'];
			$vlv022=$vlv022+$vrow['lv022'];
			$vlv021=$vlv021+$vrow['lv021'];			
			$vlv020=$vlv020+$vrow['lv020'];
			$vlv019=$vlv019+$vrow['lv019'];		
			$vlv018=$vlv018+$vrow['lv018'];
			$vlv017=$vlv017+$vrow['lv017'];
			$vlv016=$vlv016+$vrow['lv016'];
			$vlv015=$vlv015+$vrow['lv015'];
			$vlv014=$vlv014+$vrow['lv014'];
			$vlv013=$vlv013+$vrow['lv013'];
			$vlv012=$vlv012+$vrow['lv012'];
			$vlv011=$vlv011+$vrow['lv011'];
			$vlv010=$vlv010+$vrow['lv010'];
			$vlv009=$vlv009+$vrow['lv009'];
			$vlv008=$vlv008+$vrow['lv008'];
			$vlv007=$vlv007+$vrow['lv007'];
			$vlv006=$vlv006+$vrow['lv006'];
			if(strpos($strDepart,$vrow['lv096'].'')===false)
			{
				$vorder=1;
			}
				$vTemp1=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vorder,10)),$this->Align($lvTd,10));
			
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					
					case 'lv096':
						if(strpos($strDepart,$vrow['lv096'].'')===false)
						{
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
							$strDepart=$strDepart.$vrow['lv096']."@";
						}
						else
						{
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView('',(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						}
						break;
					case 'lv007':
						if($this->option==1)
						{
						$vTemp=str_replace("@02",unicode_to_none($this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]))),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
						}
					default:
					
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$vTemp1.$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv007']==1)		$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		/*$strTable=str_replace("@#lv029",$this->FormatView($vlv029,1),$lvTable);
		$strTable=str_replace("@#lv028",$this->FormatView($vlv028,1),$strTable);
		$strTable=str_replace("@#lv027",$this->FormatView($vlv027,1),$strTable);
		$strTable=str_replace("@#lv019",$this->FormatView($vlv019,1),$strTable);
		$strTable=str_replace("@#lv025",$this->FormatView($vlv025,1),$strTable);
		$strTable=str_replace("@#lv024",$this->FormatView($vlv024,10),$strTable);
		$strTable=str_replace("@#lv017",$this->FormatView($vlv017,1),$strTable);
		$strTable=str_replace("@#lv022",$this->FormatView($vlv022,1),$strTable);
		$strTable=str_replace("@#lv016",$this->FormatView($vlv016,10),$strTable);
		$strTable=str_replace("@#lv015",$this->FormatView($vlv015,1),$strTable);
		$strTable=str_replace("@#lv014",$this->FormatView($vlv014,1),$strTable);
		$strTable=str_replace("@#lv013",$this->FormatView($vlv013,1),$strTable);
		$strTable=str_replace("@#lv012",$this->FormatView($vlv012,1),$strTable);
		$strTable=str_replace("@#lv011",$this->FormatView($vlv011,1),$strTable);
		$strTable=str_replace("@#lv010",$this->FormatView($vlv010,1),$strTable);
		$strTable=str_replace("@#lv009",$this->FormatView($vlv009,1),$strTable);
		$strTable=str_replace("@#lv008",$this->FormatView($vlv008,1),$strTable);
		$strTable=str_replace("@#lv007",$this->FormatView($vlv007,1),$strTable);
		$strTable=str_replace("@#lv006",$this->FormatView($vlv006,1),$strTable);*/
		$strSumBuil="";
		for($i=1;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv090':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv090,1),$lvTdS);
						break;
					case 'lv089':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv089,1),$lvTdS);
						break;
					case 'lv088':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv088,1),$lvTdS);
						break;
					case 'lv087':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv087,1),$lvTdS);
						break;
					case 'lv086':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv086,1),$lvTdS);
						break;
					case 'lv085':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv085,1),$lvTdS);
						break;
					case 'lv084':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv084,1),$lvTdS);
						break;
					case 'lv083':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv083,1),$lvTdS);
						break;
					case 'lv082':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv082,1),$lvTdS);
						break;
					case 'lv081':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv081,1),$lvTdS);
						break;
					case 'lv080':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv080,1),$lvTdS);
						break;
					case 'lv079':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv079,1),$lvTdS);
						break;
					case 'lv078':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv078,1),$lvTdS);
						break;
					case 'lv077':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv077,1),$lvTdS);
						break;
					case 'lv076':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv076,1),$lvTdS);
						break;
					case 'lv075':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv075,1),$lvTdS);
						break;
					case 'lv074':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv074,1),$lvTdS);
						break;
					case 'lv073':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv073,1),$lvTdS);
						break;
					case 'lv072':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv072,1),$lvTdS);
						break;
					case 'lv071':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv071,1),$lvTdS);
						break;
					case 'lv070':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv070,1),$lvTdS);
						break;
					case 'lv069':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv069,1),$lvTdS);
						break;
					case 'lv068':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv068,1),$lvTdS);
						break;
					case 'lv067':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv067,1),$lvTdS);
						break;
					case 'lv066':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv066,1),$lvTdS);
						break;
					case 'lv065':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv065,1),$lvTdS);
						break;
					case 'lv064':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv064,1),$lvTdS);
						break;
					case 'lv063':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv063,1),$lvTdS);
						break;
					case 'lv062':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv062,1),$lvTdS);
						break;
					case 'lv061':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv061,1),$lvTdS);
						break;
					case 'lv060':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv060,1),$lvTdS);
						break;
					case 'lv059':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv059,1),$lvTdS);
						break;
					case 'lv058':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv058,1),$lvTdS);
						break;
					case 'lv057':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv057,1),$lvTdS);
						break;
					case 'lv056':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv056,1),$lvTdS);
						break;
					case 'lv055':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv055,1),$lvTdS);
						break;
					case 'lv054':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv054,1),$lvTdS);
						break;
					case 'lv053':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv053,1),$lvTdS);
						break;
					case 'lv052':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv052,1),$lvTdS);
						break;
					case 'lv051':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv051,1),$lvTdS);
						break;
					case 'lv050':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv050,1),$lvTdS);
						break;
					case 'lv049':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv049,1),$lvTdS);
						break;
					case 'lv048':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv048,1),$lvTdS);
						break;
					case 'lv047':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv047,1),$lvTdS);
						break;
					case 'lv046':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv046,1),$lvTdS);
						break;
					case 'lv045':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv045,1),$lvTdS);
						break;
					case 'lv044':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv044,1),$lvTdS);
						break;
					case 'lv043':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv043,1),$lvTdS);
						break;
					case 'lv042':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv042,1),$lvTdS);
						break;
					case 'lv041':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv041,1),$lvTdS);
						break;
					case 'lv040':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv040,1),$lvTdS);
						break;
					case 'lv039':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv039,1),$lvTdS);
						break;
					case 'lv038':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv038,1),$lvTdS);
						break;
					case 'lv037':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv037,1),$lvTdS);
						break;
					case 'lv035':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv036,1),$lvTdS);
						break;
					case 'lv036':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv035,1),$lvTdS);
						break;
					case 'lv035':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv035,1),$lvTdS);
						break;
					case 'lv034':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv034,1),$lvTdS);
						break;
					case 'lv033':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv033,1),$lvTdS);
						break;
					case 'lv032':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv032,1),$lvTdS);
						break;
					case 'lv031':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv032,1),$lvTdS);
						break;
					case 'lv030':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv032,1),$lvTdS);
						break;
					case 'lv029':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv029,1),$lvTdS);
						break;
					case 'lv028':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv028,1),$lvTdS);
						break;
					case 'lv027':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv027,1),$lvTdS);
						break;
					case 'lv026':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv026,1),$lvTdS);
						break;
					case 'lv025':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv025,1),$lvTdS);
						break;
					case 'lv024':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv024,1),$lvTdS);
						break;
					case 'lv023':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv023,1),$lvTdS);
						break;
					case 'lv022':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv022,1),$lvTdS);
						break;
					case 'lv021':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv021,1),$lvTdS);
						break;	
					case 'lv020':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv020,1),$lvTdS);
						break;	
					case 'lv019':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv019,1),$lvTdS);
						break;						
					
					case 'lv018':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv018,1),$lvTdS);
						break;
					case 'lv017':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv017,1),$lvTdS);
						break;
					case 'lv016':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv016,10),$lvTdS);
						break;
					case 'lv015':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv015,1),$lvTdS);
						break;
					case 'lv014':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv014,1),$lvTdS);
						break;
					case 'lv013':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv013,1),$lvTdS);
						break;
					case 'lv012':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv012,1),$lvTdS);
						break;
					case 'lv011':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv011,1),$lvTdS);
						break;
					case 'lv010':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv010,1),$lvTdS);
						break;
					case 'lv009':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv009,1),$lvTdS);
						break;
					case 'lv008':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv008,1),$lvTdS);
						break;
					case 'lv006':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv006,1),$lvTdS);
						break;
					default:
						$strSumBuil=$strSumBuil.str_replace("@#01","&nbsp;",$lvTdS);
						break;
				}
			}
			$strTable=str_replace("@#02",$strSumBuil,$lvTable);
		return str_replace("@#01",$strTrH.$strTr,$strTable);
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportOtherNone($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
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
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		<tr class=\"lvlineboldtable\"><td colspan='2'>".($this->ArrPush[1000])."</td>@#02</tr>
		</table>
		";
		$lvTdS="<td align=\"right\">@#01</td>";
		$lvTrS="<tr style=\"background:yellow;font-weight:bold;\"><td colspan='2'>".($this->ArrPush[999])."</td>@#02</tr>";
		$lvTrH="<tr class=\"lvhtable\">			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\" style='white-space:nowrap'>@02</td>";
		$sqlS = "SELECT A.*  FROM tc_lv0021 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		$strH="<td width=\"@01\" class=\"lvhtable\">".($this->ArrPush[1])."</td>";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
		$strDepart="";	
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			if(strpos($strDepart,$vrow['lv096'].'')===false && $strDepart!="")
			{
			$strSumBuil="";
			for($i=1;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv090':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv090,13),$lvTdS);
						break;
					case 'lv089':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv089,13),$lvTdS);
						break;
					case 'lv088':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv088,13),$lvTdS);
						break;
					case 'lv087':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv087,13),$lvTdS);
						break;
					case 'lv086':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv086,13),$lvTdS);
						break;
					case 'lv085':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv085,13),$lvTdS);
						break;
					case 'lv084':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv084,13),$lvTdS);
						break;
					case 'lv083':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv083,13),$lvTdS);
						break;
					case 'lv082':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv082,13),$lvTdS);
						break;
					case 'lv081':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv081,13),$lvTdS);
						break;
					case 'lv080':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv080,13),$lvTdS);
						break;
					case 'lv079':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv079,13),$lvTdS);
						break;
					case 'lv078':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv078,13),$lvTdS);
						break;
					case 'lv077':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv077,13),$lvTdS);
						break;
					case 'lv076':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv076,13),$lvTdS);
						break;
					case 'lv075':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv075,13),$lvTdS);
						break;
					case 'lv074':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv074,13),$lvTdS);
						break;
					case 'lv073':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv073,13),$lvTdS);
						break;
					case 'lv072':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv072,13),$lvTdS);
						break;
					case 'lv071':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv071,13),$lvTdS);
						break;
					case 'lv070':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv070,13),$lvTdS);
						break;
					case 'lv069':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv069,13),$lvTdS);
						break;
					case 'lv068':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv068,13),$lvTdS);
						break;
					case 'lv067':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv067,13),$lvTdS);
						break;
					case 'lv066':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv066,13),$lvTdS);
						break;
					case 'lv065':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv065,13),$lvTdS);
						break;
					case 'lv064':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv064,13),$lvTdS);
						break;
					case 'lv063':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv063,13),$lvTdS);
						break;
					case 'lv062':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv062,13),$lvTdS);
						break;
					case 'lv061':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv061,13),$lvTdS);
						break;
					case 'lv060':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv060,13),$lvTdS);
						break;
					case 'lv059':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv059,13),$lvTdS);
						break;
					case 'lv058':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv058,13),$lvTdS);
						break;
					case 'lv057':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv057,13),$lvTdS);
						break;
					case 'lv056':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv056,13),$lvTdS);
						break;
					case 'lv055':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv055,13),$lvTdS);
						break;
					case 'lv054':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv054,13),$lvTdS);
						break;
					case 'lv053':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv053,13),$lvTdS);
						break;
					case 'lv052':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv052,13),$lvTdS);
						break;
					case 'lv051':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv051,13),$lvTdS);
						break;
					case 'lv050':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv050,13),$lvTdS);
						break;
					case 'lv049':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv049,13),$lvTdS);
						break;
					case 'lv048':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv048,13),$lvTdS);
						break;
					case 'lv047':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv047,13),$lvTdS);
						break;
					case 'lv046':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv046,13),$lvTdS);
						break;
					case 'lv045':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv045,13),$lvTdS);
						break;
					case 'lv044':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv044,13),$lvTdS);
						break;
					case 'lv043':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv043,13),$lvTdS);
						break;
					case 'lv042':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv042,13),$lvTdS);
						break;
					case 'lv041':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv041,13),$lvTdS);
						break;
					case 'lv040':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv040,13),$lvTdS);
						break;
					case 'lv039':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv039,13),$lvTdS);
						break;
					case 'lv038':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv038,13),$lvTdS);
						break;
					case 'lv037':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv037,13),$lvTdS);
						break;
					case 'lv036':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv036,13),$lvTdS);
						break;
					case 'lv035':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv035,13),$lvTdS);
						break;
					case 'lv034':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv034,13),$lvTdS);
						break;
					case 'lv033':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv033,13),$lvTdS);
						break;
					case 'lv032':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv032,13),$lvTdS);
						break;
					case 'lv031':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv032,13),$lvTdS);
						break;
					case 'lv030':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv032,13),$lvTdS);
						break;
					case 'lv029':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv029,13),$lvTdS);
						break;
					case 'lv028':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv028,13),$lvTdS);
						break;
					case 'lv027':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv027,13),$lvTdS);
						break;
					case 'lv026':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv026,13),$lvTdS);
						break;
					case 'lv025':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv025,13),$lvTdS);
						break;
					case 'lv024':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv024,13),$lvTdS);
						break;
					case 'lv023':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv023,13),$lvTdS);
						break;
					case 'lv022':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv022,13),$lvTdS);
						break;
					case 'lv021':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv021,13),$lvTdS);
						break;	
					case 'lv020':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv020,13),$lvTdS);
						break;	
					case 'lv019':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv019,13),$lvTdS);
						break;						
					
					case 'lv018':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv018,13),$lvTdS);
						break;
					case 'lv017':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv017,13),$lvTdS);
						break;
					case 'lv016':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv016,10),$lvTdS);
						break;
					case 'lv015':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv015,13),$lvTdS);
						break;
					case 'lv014':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv014,13),$lvTdS);
						break;
					case 'lv013':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv013,13),$lvTdS);
						break;
					case 'lv012':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv012,13),$lvTdS);
						break;
					case 'lv011':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv011,13),$lvTdS);
						break;
					case 'lv010':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv010,13),$lvTdS);
						break;
					case 'lv009':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv009,13),$lvTdS);
						break;
					case 'lv008':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv008,13),$lvTdS);
						break;
					case 'lv006':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv006,13),$lvTdS);
						break;
					default:
						$strSumBuil=$strSumBuil.str_replace("@#01","&nbsp;",$lvTdS);
						break;
				}
			}
			
			$strTr=$strTr.str_replace("@#02",$strSumBuil,$lvTrS);
			$deplv091=0;//$deplv091+$vrow['lv091'];
			$deplv090=0;//$deplv090+$vrow['lv090'];
			$deplv089=0;//$deplv089+$vrow['lv089'];
			$deplv088=0;//$deplv088+$vrow['lv088'];
			$deplv087=0;//$deplv087+$vrow['lv087'];
			$deplv086=0;//$deplv086+$vrow['lv086'];
			$deplv085=0;//$deplv085+$vrow['lv085'];
			$deplv084=0;//$deplv084+$vrow['lv084'];
			$deplv083=0;//$deplv083+$vrow['lv083'];
			$deplv082=0;//$deplv082+$vrow['lv082'];
			$deplv081=0;//$deplv081+$vrow['lv081'];
			$deplv080=0;//$deplv080+$vrow['lv080'];
			$deplv079=0;//$deplv079+$vrow['lv079'];
			$deplv078=0;//$deplv078+$vrow['lv078'];
			$deplv077=0;//$deplv077+$vrow['lv077'];
			$deplv076=0;//$deplv076+$vrow['lv076'];
			$deplv075=0;//$deplv075+$vrow['lv075'];
			$deplv074=0;//$deplv074+$vrow['lv074'];
			$deplv073=0;//$deplv073+$vrow['lv073'];
			$deplv072=0;//$deplv072+$vrow['lv072'];
			$deplv071=0;//$deplv071+$vrow['lv071'];
			$deplv070=0;//$deplv070+$vrow['lv070'];
			$deplv069=0;//$deplv069+$vrow['lv069'];
			$deplv068=0;//$deplv068+$vrow['lv068'];
			$deplv067=0;//$deplv067+$vrow['lv067'];
			$deplv066=0;//$deplv066+$vrow['lv066'];
			$deplv065=0;//$deplv065+$vrow['lv065'];
			$deplv064=0;//$deplv064+$vrow['lv064'];
			$deplv063=0;//$deplv063+$vrow['lv063'];
			$deplv062=0;//$deplv062+$vrow['lv062'];
			$deplv061=0;//$deplv061+$vrow['lv061'];
			$deplv060=0;//$deplv060+$vrow['lv060'];
			$deplv059=0;//$deplv059+$vrow['lv059'];
			$deplv058=0;//$deplv058+$vrow['lv058'];
			$deplv057=0;//$deplv057+$vrow['lv057'];
			$deplv056=0;//$deplv056+$vrow['lv056'];
			$deplv055=0;//$deplv055+$vrow['lv055'];
			$deplv054=0;//$deplv054+$vrow['lv053'];
			$deplv053=0;//$deplv053+$vrow['lv053'];
			$deplv052=0;//$deplv052+$vrow['lv052'];
			$deplv051=0;//$deplv051+$vrow['lv051'];
			$deplv050=0;//$deplv050+$vrow['lv050'];
			$deplv049=0;//$deplv049+$vrow['lv049'];
			$deplv048=0;//$deplv048+$vrow['lv048'];
			$deplv047=0;//$deplv047+$vrow['lv047'];
			$deplv046=0;//$deplv046+$vrow['lv046'];
			$deplv045=0;//$deplv045+$vrow['lv045'];
			$deplv044=0;//$deplv044+$vrow['lv044'];
			$deplv043=0;//$deplv043+$vrow['lv043'];
			$deplv042=0;//$deplv042+$vrow['lv042'];
			$deplv041=0;//$deplv041+$vrow['lv041'];
			$deplv040=0;//$deplv040+$vrow['lv040'];
			$deplv039=0;//$deplv039+$vrow['lv039'];
			$deplv038=0;//$deplv038+$vrow['lv038'];
			$deplv037=0;//$deplv037+$vrow['lv037'];
			$deplv036=0;//$deplv036+$vrow['lv036'];
			$deplv035=0;//$deplv035+$vrow['lv035'];
			$deplv034=0;//$deplv034+$vrow['lv034'];
			$deplv033=0;//$deplv033+$vrow['lv033'];
			$deplv032=0;//$deplv032+$vrow['lv032'];
			$deplv029=0;//$deplv029+$vrow['lv029'];
			$deplv028=0;//$deplv028+$vrow['lv028'];
			$deplv026=0;//$deplv026+$vrow['lv026'];
			$deplv027=0;//$deplv027+$vrow['lv027'];
			$deplv025=0;//$deplv025+$vrow['lv025'];
			$deplv024=0;//$deplv024+$vrow['lv024'];
			$deplv023=0;//$deplv023+$vrow['lv023'];
			$deplv022=0;//$deplv022+$vrow['lv022'];
			$deplv021=0;//$deplv021+$vrow['lv021'];			
			$deplv020=0;//$deplv020+$vrow['lv020'];
			$deplv019=0;//$deplv019+$vrow['lv019'];		
			$deplv018=0;//$deplv018+$vrow['lv018'];
			$deplv017=0;//$deplv017+$vrow['lv017'];
			$deplv016=0;//$deplv016+$vrow['lv016'];
			$deplv015=0;//$deplv015+$vrow['lv015'];
			$deplv014=0;//$deplv014+$vrow['lv014'];
			$deplv013=0;//$deplv013+$vrow['lv013'];
			$deplv012=0;//$deplv012+$vrow['lv012'];
			$deplv011=0;//$deplv011+$vrow['lv011'];
			$deplv010=0;//$deplv010+$vrow['lv010'];
			$deplv009=0;//$deplv009+$vrow['lv009'];
			$deplv008=0;//$deplv008+$vrow['lv008'];
			$deplv007=0;//$deplv007+$vrow['lv007'];
			$deplv006=0;//$deplv006+$vrow['lv006'];
			}
			$deplv091=$deplv091+$vrow['lv091'];
			$deplv090=$deplv090+$vrow['lv090'];
			$deplv089=$deplv089+$vrow['lv089'];
			$deplv088=$deplv088+$vrow['lv088'];
			$deplv087=$deplv087+$vrow['lv087'];
			$deplv086=$deplv086+$vrow['lv086'];
			$deplv085=$deplv085+$vrow['lv085'];
			$deplv084=$deplv084+$vrow['lv084'];
			$deplv083=$deplv083+$vrow['lv083'];
			$deplv082=$deplv082+$vrow['lv082'];
			$deplv081=$deplv081+$vrow['lv081'];
			$deplv080=$deplv080+$vrow['lv080'];
			$deplv079=$deplv079+$vrow['lv079'];
			$deplv078=$deplv078+$vrow['lv078'];
			$deplv077=$deplv077+$vrow['lv077'];
			$deplv076=$deplv076+$vrow['lv076'];
			$deplv075=$deplv075+$vrow['lv075'];
			$deplv074=$deplv074+$vrow['lv074'];
			$deplv073=$deplv073+$vrow['lv073'];
			$deplv072=$deplv072+$vrow['lv072'];
			$deplv071=$deplv071+$vrow['lv071'];
			$deplv070=$deplv070+$vrow['lv070'];
			$deplv069=$deplv069+$vrow['lv069'];
			$deplv068=$deplv068+$vrow['lv068'];
			$deplv067=$deplv067+$vrow['lv067'];
			$deplv066=$deplv066+$vrow['lv066'];
			$deplv065=$deplv065+$vrow['lv065'];
			$deplv064=$deplv064+$vrow['lv064'];
			$deplv063=$deplv063+$vrow['lv063'];
			$deplv062=$deplv062+$vrow['lv062'];
			$deplv061=$deplv061+$vrow['lv061'];
			$deplv060=$deplv060+$vrow['lv060'];
			$deplv059=$deplv059+$vrow['lv059'];
			$deplv058=$deplv058+$vrow['lv058'];
			$deplv057=$deplv057+$vrow['lv057'];
			$deplv056=$deplv056+$vrow['lv056'];
			$deplv055=$deplv055+$vrow['lv055'];
			$deplv054=$deplv054+$vrow['lv054'];
			$deplv053=$deplv053+$vrow['lv053'];
			$deplv052=$deplv052+$vrow['lv052'];
			$deplv051=$deplv051+$vrow['lv051'];
			$deplv050=$deplv050+$vrow['lv050'];
			$deplv049=$deplv049+$vrow['lv049'];
			$deplv048=$deplv048+$vrow['lv048'];
			$deplv047=$deplv047+$vrow['lv047'];
			$deplv046=$deplv046+$vrow['lv046'];
			$deplv045=$deplv045+$vrow['lv045'];
			$deplv044=$deplv044+$vrow['lv044'];
			$deplv043=$deplv043+$vrow['lv043'];
			$deplv042=$deplv042+$vrow['lv042'];
			$deplv041=$deplv041+$vrow['lv041'];
			$deplv040=$deplv040+$vrow['lv040'];
			$deplv039=$deplv039+$vrow['lv039'];
			$deplv038=$deplv038+$vrow['lv038'];
			$deplv037=$deplv037+$vrow['lv037'];
			$deplv036=$deplv036+$vrow['lv036'];
			$deplv035=$deplv035+$vrow['lv035'];
			$deplv034=$deplv034+$vrow['lv034'];
			$deplv033=$deplv033+$vrow['lv033'];
			$deplv032=$deplv032+$vrow['lv032'];
			$deplv029=$deplv029+$vrow['lv029'];
			$deplv028=$deplv028+$vrow['lv028'];
			$deplv026=$deplv026+$vrow['lv026'];
			$deplv027=$deplv027+$vrow['lv027'];
			$deplv025=$deplv025+$vrow['lv025'];
			$deplv024=$deplv024+$vrow['lv024'];
			$deplv023=$deplv023+$vrow['lv023'];
			$deplv022=$deplv022+$vrow['lv022'];
			$deplv021=$deplv021+$vrow['lv021'];			
			$deplv020=$deplv020+$vrow['lv020'];
			$deplv019=$deplv019+$vrow['lv019'];		
			$deplv018=$deplv018+$vrow['lv018'];
			$deplv017=$deplv017+$vrow['lv017'];
			$deplv016=$deplv016+$vrow['lv016'];
			$deplv015=$deplv015+$vrow['lv015'];
			$deplv014=$deplv014+$vrow['lv014'];
			$deplv013=$deplv013+$vrow['lv013'];
			$deplv012=$deplv012+$vrow['lv012'];
			$deplv011=$deplv011+$vrow['lv011'];
			$deplv010=$deplv010+$vrow['lv010'];
			$deplv009=$deplv009+$vrow['lv009'];
			$deplv008=$deplv008+$vrow['lv008'];
			$deplv007=$deplv007+$vrow['lv007'];
			$deplv006=$deplv006+$vrow['lv006'];
			
			$vlv091=$vlv091+$vrow['lv091'];
			$vlv090=$vlv090+$vrow['lv090'];
			$vlv089=$vlv089+$vrow['lv089'];
			$vlv088=$vlv088+$vrow['lv088'];
			$vlv087=$vlv087+$vrow['lv087'];
			$vlv086=$vlv086+$vrow['lv086'];
			$vlv085=$vlv085+$vrow['lv085'];
			$vlv084=$vlv084+$vrow['lv084'];
			$vlv083=$vlv083+$vrow['lv083'];
			$vlv082=$vlv082+$vrow['lv082'];
			$vlv081=$vlv081+$vrow['lv081'];
			$vlv080=$vlv080+$vrow['lv080'];
			$vlv079=$vlv079+$vrow['lv079'];
			$vlv078=$vlv078+$vrow['lv078'];
			$vlv077=$vlv077+$vrow['lv077'];
			$vlv076=$vlv076+$vrow['lv076'];
			$vlv075=$vlv075+$vrow['lv075'];
			$vlv074=$vlv074+$vrow['lv074'];
			$vlv073=$vlv073+$vrow['lv073'];
			$vlv072=$vlv072+$vrow['lv072'];
			$vlv071=$vlv071+$vrow['lv071'];
			$vlv070=$vlv070+$vrow['lv070'];
			$vlv069=$vlv069+$vrow['lv069'];
			$vlv068=$vlv068+$vrow['lv068'];
			$vlv067=$vlv067+$vrow['lv067'];
			$vlv066=$vlv066+$vrow['lv066'];
			$vlv065=$vlv065+$vrow['lv065'];
			$vlv064=$vlv064+$vrow['lv064'];
			$vlv063=$vlv063+$vrow['lv063'];
			$vlv062=$vlv062+$vrow['lv062'];
			$vlv061=$vlv061+$vrow['lv061'];
			$vlv060=$vlv060+$vrow['lv060'];
			$vlv059=$vlv059+$vrow['lv059'];
			$vlv058=$vlv058+$vrow['lv058'];
			$vlv057=$vlv057+$vrow['lv057'];
			$vlv056=$vlv056+$vrow['lv056'];
			$vlv055=$vlv055+$vrow['lv055'];
			$vlv054=$vlv054+$vrow['lv054'];
			$vlv053=$vlv053+$vrow['lv053'];
			$vlv052=$vlv052+$vrow['lv052'];
			$vlv051=$vlv051+$vrow['lv051'];
			$vlv050=$vlv050+$vrow['lv050'];
			$vlv049=$vlv049+$vrow['lv049'];
			$vlv048=$vlv048+$vrow['lv048'];
			$vlv047=$vlv047+$vrow['lv047'];
			$vlv046=$vlv046+$vrow['lv046'];
			$vlv045=$vlv045+$vrow['lv045'];
			$vlv044=$vlv044+$vrow['lv044'];
			$vlv043=$vlv043+$vrow['lv043'];
			$vlv042=$vlv042+$vrow['lv042'];
			$vlv041=$vlv041+$vrow['lv041'];
			$vlv040=$vlv040+$vrow['lv040'];
			$vlv039=$vlv039+$vrow['lv039'];
			$vlv038=$vlv038+$vrow['lv038'];
			$vlv037=$vlv037+$vrow['lv037'];
			$vlv036=$vlv036+$vrow['lv036'];
			$vlv035=$vlv035+$vrow['lv035'];
			$vlv034=$vlv034+$vrow['lv034'];
			$vlv033=$vlv033+$vrow['lv033'];
			$vlv032=$vlv032+$vrow['lv032'];
			$vlv029=$vlv029+$vrow['lv029'];
			$vlv028=$vlv028+$vrow['lv028'];
			$vlv026=$vlv026+$vrow['lv026'];
			$vlv027=$vlv027+$vrow['lv027'];
			$vlv025=$vlv025+$vrow['lv025'];
			$vlv024=$vlv024+$vrow['lv024'];
			$vlv023=$vlv023+$vrow['lv023'];
			$vlv022=$vlv022+$vrow['lv022'];
			$vlv021=$vlv021+$vrow['lv021'];			
			$vlv020=$vlv020+$vrow['lv020'];
			$vlv019=$vlv019+$vrow['lv019'];		
			$vlv018=$vlv018+$vrow['lv018'];
			$vlv017=$vlv017+$vrow['lv017'];
			$vlv016=$vlv016+$vrow['lv016'];
			$vlv015=$vlv015+$vrow['lv015'];
			$vlv014=$vlv014+$vrow['lv014'];
			$vlv013=$vlv013+$vrow['lv013'];
			$vlv012=$vlv012+$vrow['lv012'];
			$vlv011=$vlv011+$vrow['lv011'];
			$vlv010=$vlv010+$vrow['lv010'];
			$vlv009=$vlv009+$vrow['lv009'];
			$vlv008=$vlv008+$vrow['lv008'];
			$vlv007=$vlv007+$vrow['lv007'];
			$vlv006=$vlv006+$vrow['lv006'];
			
			if(strpos($strDepart,$vrow['lv096'].'')===false)
			{
				$vorder=1;
			}
				$vTemp1=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vorder,10)),$this->Align($lvTd,10));
			
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					
					case 'lv096':
						if(strpos($strDepart,$vrow['lv096'].'')===false)
						{
						
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
							$strDepart=$strDepart.$vrow['lv096']."@";
						}
						else
						{
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView('',(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						}
						break;
					case 'lv007':
						if($this->option==1)
						{
						$vTemp=str_replace("@02",unicode_to_none($this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]))),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
						}
					default:
					
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$vTemp1.$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv007']==1)		$strTr=str_replace("@#04","",$strTr);
			
		}
		$strSumBuil="";
		for($i=1;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv090':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv090,13),$lvTdS);
						break;
					case 'lv089':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv089,13),$lvTdS);
						break;
					case 'lv088':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv088,13),$lvTdS);
						break;
					case 'lv087':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv087,13),$lvTdS);
						break;
					case 'lv086':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv086,13),$lvTdS);
						break;
					case 'lv085':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv085,13),$lvTdS);
						break;
					case 'lv084':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv084,13),$lvTdS);
						break;
					case 'lv083':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv083,13),$lvTdS);
						break;
					case 'lv082':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv082,13),$lvTdS);
						break;
					case 'lv081':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv081,13),$lvTdS);
						break;
					case 'lv080':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv080,13),$lvTdS);
						break;
					case 'lv079':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv079,13),$lvTdS);
						break;
					case 'lv078':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv078,13),$lvTdS);
						break;
					case 'lv077':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv077,13),$lvTdS);
						break;
					case 'lv076':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv076,13),$lvTdS);
						break;
					case 'lv075':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv075,13),$lvTdS);
						break;
					case 'lv074':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv074,13),$lvTdS);
						break;
					case 'lv073':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv073,13),$lvTdS);
						break;
					case 'lv072':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv072,13),$lvTdS);
						break;
					case 'lv071':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv071,13),$lvTdS);
						break;
					case 'lv070':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv070,13),$lvTdS);
						break;
					case 'lv069':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv069,13),$lvTdS);
						break;
					case 'lv068':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv068,13),$lvTdS);
						break;
					case 'lv067':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv067,13),$lvTdS);
						break;
					case 'lv066':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv066,13),$lvTdS);
						break;
					case 'lv065':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv065,13),$lvTdS);
						break;
					case 'lv064':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv064,13),$lvTdS);
						break;
					case 'lv063':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv063,13),$lvTdS);
						break;
					case 'lv062':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv062,13),$lvTdS);
						break;
					case 'lv061':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv061,13),$lvTdS);
						break;
					case 'lv060':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv060,13),$lvTdS);
						break;
					case 'lv059':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv059,13),$lvTdS);
						break;
					case 'lv058':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv058,13),$lvTdS);
						break;
					case 'lv057':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv057,13),$lvTdS);
						break;
					case 'lv056':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv056,13),$lvTdS);
						break;
					case 'lv055':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv055,13),$lvTdS);
						break;
					case 'lv054':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv054,13),$lvTdS);
						break;
					case 'lv053':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv053,13),$lvTdS);
						break;
					case 'lv052':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv052,13),$lvTdS);
						break;
					case 'lv051':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv051,13),$lvTdS);
						break;
					case 'lv050':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv050,13),$lvTdS);
						break;
					case 'lv049':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv049,13),$lvTdS);
						break;
					case 'lv048':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv048,13),$lvTdS);
						break;
					case 'lv047':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv047,13),$lvTdS);
						break;
					case 'lv046':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv046,13),$lvTdS);
						break;
					case 'lv045':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv045,13),$lvTdS);
						break;
					case 'lv044':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv044,13),$lvTdS);
						break;
					case 'lv043':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv043,13),$lvTdS);
						break;
					case 'lv042':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv042,13),$lvTdS);
						break;
					case 'lv041':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv041,13),$lvTdS);
						break;
					case 'lv040':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv040,13),$lvTdS);
						break;
					case 'lv039':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv039,13),$lvTdS);
						break;
					case 'lv038':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv038,13),$lvTdS);
						break;
					case 'lv037':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv037,13),$lvTdS);
						break;
					case 'lv036':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv036,13),$lvTdS);
						break;
					case 'lv035':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv035,13),$lvTdS);
						break;
					case 'lv034':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv034,13),$lvTdS);
						break;
					case 'lv033':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv033,13),$lvTdS);
						break;
					case 'lv032':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv032,13),$lvTdS);
						break;
					case 'lv031':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv032,13),$lvTdS);
						break;
					case 'lv030':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv032,13),$lvTdS);
						break;
					case 'lv029':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv029,13),$lvTdS);
						break;
					case 'lv028':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv028,13),$lvTdS);
						break;
					case 'lv027':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv027,13),$lvTdS);
						break;
					case 'lv026':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv026,13),$lvTdS);
						break;
					case 'lv025':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv025,13),$lvTdS);
						break;
					case 'lv024':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv024,13),$lvTdS);
						break;
					case 'lv023':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv023,13),$lvTdS);
						break;
					case 'lv022':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv022,13),$lvTdS);
						break;
					case 'lv021':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv021,13),$lvTdS);
						break;	
					case 'lv020':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv020,13),$lvTdS);
						break;	
					case 'lv019':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv019,13),$lvTdS);
						break;						
					
					case 'lv018':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv018,13),$lvTdS);
						break;
					case 'lv017':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv017,13),$lvTdS);
						break;
					case 'lv016':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv016,10),$lvTdS);
						break;
					case 'lv015':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv015,13),$lvTdS);
						break;
					case 'lv014':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv014,13),$lvTdS);
						break;
					case 'lv013':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv013,13),$lvTdS);
						break;
					case 'lv012':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv012,13),$lvTdS);
						break;
					case 'lv011':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv011,13),$lvTdS);
						break;
					case 'lv010':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv010,13),$lvTdS);
						break;
					case 'lv009':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv009,13),$lvTdS);
						break;
					case 'lv008':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv008,13),$lvTdS);
						break;
					case 'lv006':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv006,13),$lvTdS);
						break;
					default:
						$strSumBuil=$strSumBuil.str_replace("@#01","&nbsp;",$lvTdS);
						break;
				}
			}
		$strTr=$strTr.str_replace("@#02",$strSumBuil,$lvTrS);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		/*$strTable=str_replace("@#lv029",$this->FormatView($vlv029,13),$lvTable);
		$strTable=str_replace("@#lv028",$this->FormatView($vlv028,13),$strTable);
		$strTable=str_replace("@#lv027",$this->FormatView($vlv027,13),$strTable);
		$strTable=str_replace("@#lv019",$this->FormatView($vlv019,13),$strTable);
		$strTable=str_replace("@#lv025",$this->FormatView($vlv025,13),$strTable);
		$strTable=str_replace("@#lv024",$this->FormatView($vlv024,10),$strTable);
		$strTable=str_replace("@#lv017",$this->FormatView($vlv017,13),$strTable);
		$strTable=str_replace("@#lv022",$this->FormatView($vlv022,13),$strTable);
		$strTable=str_replace("@#lv016",$this->FormatView($vlv016,10),$strTable);
		$strTable=str_replace("@#lv015",$this->FormatView($vlv015,13),$strTable);
		$strTable=str_replace("@#lv014",$this->FormatView($vlv014,13),$strTable);
		$strTable=str_replace("@#lv013",$this->FormatView($vlv013,13),$strTable);
		$strTable=str_replace("@#lv012",$this->FormatView($vlv012,13),$strTable);
		$strTable=str_replace("@#lv011",$this->FormatView($vlv011,13),$strTable);
		$strTable=str_replace("@#lv010",$this->FormatView($vlv010,13),$strTable);
		$strTable=str_replace("@#lv009",$this->FormatView($vlv009,13),$strTable);
		$strTable=str_replace("@#lv008",$this->FormatView($vlv008,13),$strTable);
		$strTable=str_replace("@#lv007",$this->FormatView($vlv007,13),$strTable);
		$strTable=str_replace("@#lv006",$this->FormatView($vlv006,13),$strTable);*/
		$strSumBuil="";
		for($i=1;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv090':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv090,13),$lvTdS);
						break;
					case 'lv089':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv089,13),$lvTdS);
						break;
					case 'lv088':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv088,13),$lvTdS);
						break;
					case 'lv087':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv087,13),$lvTdS);
						break;
					case 'lv086':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv086,13),$lvTdS);
						break;
					case 'lv085':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv085,13),$lvTdS);
						break;
					case 'lv084':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv084,13),$lvTdS);
						break;
					case 'lv083':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv083,13),$lvTdS);
						break;
					case 'lv082':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv082,13),$lvTdS);
						break;
					case 'lv081':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv081,13),$lvTdS);
						break;
					case 'lv080':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv080,13),$lvTdS);
						break;
					case 'lv079':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv079,13),$lvTdS);
						break;
					case 'lv078':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv078,13),$lvTdS);
						break;
					case 'lv077':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv077,13),$lvTdS);
						break;
					case 'lv076':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv076,13),$lvTdS);
						break;
					case 'lv075':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv075,13),$lvTdS);
						break;
					case 'lv074':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv074,13),$lvTdS);
						break;
					case 'lv073':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv073,13),$lvTdS);
						break;
					case 'lv072':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv072,13),$lvTdS);
						break;
					case 'lv071':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv071,13),$lvTdS);
						break;
					case 'lv070':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv070,13),$lvTdS);
						break;
					case 'lv069':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv069,13),$lvTdS);
						break;
					case 'lv068':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv068,13),$lvTdS);
						break;
					case 'lv067':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv067,13),$lvTdS);
						break;
					case 'lv066':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv066,13),$lvTdS);
						break;
					case 'lv065':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv065,13),$lvTdS);
						break;
					case 'lv064':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv064,13),$lvTdS);
						break;
					case 'lv063':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv063,13),$lvTdS);
						break;
					case 'lv062':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv062,13),$lvTdS);
						break;
					case 'lv061':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv061,13),$lvTdS);
						break;
					case 'lv060':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv060,13),$lvTdS);
						break;
					case 'lv059':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv059,13),$lvTdS);
						break;
					case 'lv058':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv058,13),$lvTdS);
						break;
					case 'lv057':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv057,13),$lvTdS);
						break;
					case 'lv056':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv056,13),$lvTdS);
						break;
					case 'lv055':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv055,13),$lvTdS);
						break;
					case 'lv054':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv054,13),$lvTdS);
						break;
					case 'lv053':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv053,13),$lvTdS);
						break;
					case 'lv052':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv052,13),$lvTdS);
						break;
					case 'lv051':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv051,13),$lvTdS);
						break;
					case 'lv050':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv050,13),$lvTdS);
						break;
					case 'lv049':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv049,13),$lvTdS);
						break;
					case 'lv048':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv048,13),$lvTdS);
						break;
					case 'lv047':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv047,13),$lvTdS);
						break;
					case 'lv046':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv046,13),$lvTdS);
						break;
					case 'lv045':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv045,13),$lvTdS);
						break;
					case 'lv044':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv044,13),$lvTdS);
						break;
					case 'lv043':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv043,13),$lvTdS);
						break;
					case 'lv042':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv042,13),$lvTdS);
						break;
					case 'lv041':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv041,13),$lvTdS);
						break;
					case 'lv040':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv040,13),$lvTdS);
						break;
					case 'lv039':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv039,13),$lvTdS);
						break;
					case 'lv038':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv038,13),$lvTdS);
						break;
					case 'lv037':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv037,13),$lvTdS);
						break;
					case 'lv036':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv036,13),$lvTdS);
						break;
					case 'lv035':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv035,13),$lvTdS);
						break;
					case 'lv034':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv034,13),$lvTdS);
						break;
					case 'lv033':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv033,13),$lvTdS);
						break;
					case 'lv032':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv032,13),$lvTdS);
						break;
					case 'lv031':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv032,13),$lvTdS);
						break;
					case 'lv030':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv032,13),$lvTdS);
						break;
					case 'lv029':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv029,13),$lvTdS);
						break;
					case 'lv028':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv028,13),$lvTdS);
						break;
					case 'lv027':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv027,13),$lvTdS);
						break;
					case 'lv026':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv026,13),$lvTdS);
						break;
					case 'lv025':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv025,13),$lvTdS);
						break;
					case 'lv024':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv024,13),$lvTdS);
						break;
					case 'lv023':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv023,13),$lvTdS);
						break;
					case 'lv022':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv022,13),$lvTdS);
						break;
					case 'lv021':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv021,13),$lvTdS);
						break;	
					case 'lv020':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv020,13),$lvTdS);
						break;	
					case 'lv019':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv019,13),$lvTdS);
						break;						
					
					case 'lv018':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv018,13),$lvTdS);
						break;
					case 'lv017':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv017,13),$lvTdS);
						break;
					case 'lv016':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv016,10),$lvTdS);
						break;
					case 'lv015':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv015,13),$lvTdS);
						break;
					case 'lv014':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv014,13),$lvTdS);
						break;
					case 'lv013':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv013,13),$lvTdS);
						break;
					case 'lv012':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv012,13),$lvTdS);
						break;
					case 'lv011':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv011,13),$lvTdS);
						break;
					case 'lv010':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv010,13),$lvTdS);
						break;
					case 'lv009':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv009,13),$lvTdS);
						break;
					case 'lv008':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv008,13),$lvTdS);
						break;
					case 'lv006':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv006,13),$lvTdS);
						break;
					default:
						$strSumBuil=$strSumBuil.str_replace("@#01","&nbsp;",$lvTdS);
						break;
				}
			}
			$strTable=str_replace("@#02",$strSumBuil,$lvTable);
		return str_replace("@#01",$strTrH.$strTr,$strTable);
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
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;	
			case 'lv098':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0013";
				break;
			case 'lv096':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002";
				break;
			case 'lv047':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0032";
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
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";	
				break;
			case 'lv098':
				$vsql="select lv001, lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0013 where lv001='$vSelectID'";	
				break;
			case 'lv096':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002 where lv001='$vSelectID'";	
				break;
			case 'lv095':
				$vsql="select lv001, lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0032 where lv001='$vSelectID'";	
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

	function CalSalaryScaleHeso($vObjCal,$vEmployeeID,$salaryitem,$heso,$totalnumtime)
	{
	///Salary belong to insurance anually
		$this->lv006=$this->GetSalaryOpt($vEmployeeID,0);
	///Salary no belong to insurance anually
		$this->lv007=$this->GetSalaryOpt($vEmployeeID,1);
	///Salary belong to benefit anually
		$this->lv008=$this->GetSalaryOpt($vEmployeeID,2);
	///salary belong to substrate anually
		 $this->lv009=$this->GetSalaryOpt($vEmployeeID,3);	
	/////salary DependenceMoney
		$this->lv026=$this->GetSalaryOpt($vEmployeeID,4);	
	/////////////////////////////////	
	$this->lv021=$this->GetContract($vEmployeeID,'lv001');
	$vContractTypeID=$this->GetContract($vEmployeeID,'lv003');
	if((int)$vContractTypeID==1)
	{
		$this->lv012=(float)$vObjCal->lv012*$this->lv006/100;
		$this->lv013=(float)$vObjCal->lv013*$this->lv006/100;
		$this->lv014=(float)$vObjCal->lv014*$this->lv006/100;
	}
	else
	{
		$this->lv012=0;
		$this->lv013=0;
		$this->lv014=0;
	}
	//////////Get Expensive//////////
		$this->lv011=(float)$this->GetExpensive($vEmployeeID,$vObjCal->lv001);
	///Get Cost of Temporary
		$this->lv010=(float)$this->GetCost($vEmployeeID,$vObjCal->lv001);
	
		if($vObjCal->lv003==0)
		{
			$vNumDay=26;
		}
		else
			$vNumDay=GetDayWorkInMonth($vObjCal->lv007,$vObjCal->lv006);
			$this->lv022=($this->lv006+$this->lv007)/($vNumDay*$this->GetTime('08:00:00'));
		$this->lv020=$vObjCal->lv001;
		$this->lv022=round($this->lv022,2);
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		if($calendar=="") $calendar="''";
		$this->lv015=$this->Gethours($vObjCal->lv001,$vEmployeeID,$this->lv022,$vObjCal,0,$calendar);
		$this->lv016=$this->GetOverHours($vObjCal->lv001,$vEmployeeID,$this->lv022,$vObjCal,1,$calendar);
		$alltime=$this->GetAllhours($vObjCal->lv001,$vEmployeeID,$this->lv022,$vObjCal,0,$calendar)+$this->GetAllOverHours($vObjCal->lv001,$vEmployeeID,$this->lv022,$vObjCal,1,$calendar);
		
		//LÆ°Æ¡ng % theo chuyá»�n
		$this->lv025=$salaryitem*$heso*(($alltime))/$totalnumtime;
		//LÆ°Æ¡ng thá»�i gian bá»‹
			$this->lv017=0;
		$this->lv018=$this->lv017+$this->lv011-$this->lv010-$this->lv012-$this->lv013-$this->lv014+$this->lv025;
		$this->lv024=$this->GetQuantityItem($vObjCal->lv001,$vEmployeeID);
		
		//Tá»•ng thu nháº­p chÆ°a thuáº¿
		$this->lv019=$this->lv018+$this->lv008-$this->lv009;
		$this->lv001=$this->CheckExist($vObjCal->lv001,$vEmployeeID);
		
		$this->lv032 =$vObjCal->lv016*($this->lv019+$this->lv010)/100;
		if($this->lv019+$this->lv010-(float)$vObjCal->lv015-$this->lv026>0)
		{
			$this->lv027 =$this->lv019-(float)$vObjCal->lv015-$this->lv026+$this->lv010;
			$this->lv028=$this->GetTax($this->lv027 );
		}
		else
		{
			$this->lv027=0;
			$this->lv028=0; 
		}
		$this->lv029=$this->lv019-$this->lv028;
		if($this->lv001==-1)
		{
			$this->LV_Insert();
		}
		else
			$this->LV_Update();
		
	}//TÃ­nh lÆ°Æ¡ng theo há»‡ sá»‘ cÃ´ng
	function LV_GETHSOK($vDepartment,$vCalID,&$hsok,&$tanggiamhso)
	{
		$vsql="select BB.lv006 hsok,BB.lv004 tanggiamhso from tc_lv0031 BB where BB.lv003='".$vDepartment."' and BB.lv002='".$vCalID."' limit 0,1";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$hsok=(float)$vrow['hsok'];
			$tanggiamhso=(float)$vrow['tanggiamhso'];
		}
	}
	function TinhCongTheoNgay($vDepartment,$vyear,$vmonth,$vrate,$vCalID)
	{
		if($this->ArrDepartment["$vDepartment"][0]['value']==true) return;
		$vListEmp=$this->LV_GetListEmp("'".$vDepartment."'",'lv001');
		if($vListEmp=="") $vListEmp="''";
		$vListCalendar=$this->LV_GetListCalendar($vListEmp,'lv001');
		if($vListCalendar=="") $vListCalendar="''";
		$vNumDay=GetDayInMonth($vyear,$vmonth);
		$tanggiamhso=0;
		$hesok=0;
		$this->LV_GETHSOK($vDepartment,$vCalID,$hesok,$tanggiamhso);
		for($i=1;$i<=$vNumDay;$i++)
		{
			$vDay=$vyear."-".Fillnum($vmonth,2)."-".Fillnum($i,2);
			if($vsql=="")
				$vsql="select $i stt, A.lv004 ngaytinh,sum(IF(A.lv011='$vDepartment',A.lv006,(IF(ISNULL(C.lv007),0,(IF(ISNULL(D.lv004),IF(A.lv007='AD',C.lv007*0.77,C.lv007),IF(A.lv007='AD',C.lv007*0.77,C.lv007)*D.lv004/100)))))) tonghesocong,count(A.lv007) tongcong,(select sum(IF(ISNULL(DD.lv006*EE.lv004),0,DD.lv006*EE.lv004)) from tc_lv0026 DD left join tc_lv0015 EE on DD.lv005=EE.lv003 and EE.lv002='$vCalID' where DD.lv004=A.lv004 and DD.lv003='$vCalID' and DD.lv013=0 and DD.lv012='$vDepartment' AND DD.lv011=1) TongTien,(select sum(IF(ISNULL(DD.lv006),0,DD.lv006)) from tc_lv0026 DD  where DD.lv004=A.lv004 and DD.lv003='$vCalID' and DD.lv013=1 and DD.lv012='$vDepartment'  AND DD.lv011=1) TongCongNgoai,$hesok hesok,$tanggiamhso tanggiamconglv   from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join tc_lv0009 C on B.lv002=C.lv002 and C.lv003='$vmonth' and C.lv004='$vyear' left join tc_lv0025 D on C.lv008=D.lv001 and D.lv002='".$vCalID."' where A.lv004='$vDay' and ( (A.lv002 in ($vListCalendar) AND (A.lv011='' or ISNULL(A.lv011))) or A.lv011='$vDepartment') and A.lv007 in ('1','2','3','11','22','33','U','H','AD')";
			else
				$vsql=$vsql." union
				select $i stt, A.lv004 ngaytinh,sum(IF(A.lv011='$vDepartment',A.lv006,(IF(ISNULL(C.lv007),0,(IF(ISNULL(D.lv004),IF(A.lv007='AD',C.lv007*0.77,C.lv007),IF(A.lv007='AD',C.lv007*0.77,C.lv007)*D.lv004/100)))))) tonghesocong,count(A.lv007) tongcong,(select sum(IF(ISNULL(DD.lv006*EE.lv004),0,DD.lv006*EE.lv004)) from tc_lv0026 DD left join tc_lv0015 EE on DD.lv005=EE.lv003 and EE.lv002='$vCalID' where DD.lv004=A.lv004 and DD.lv003='$vCalID' and DD.lv013=0 and DD.lv012='$vDepartment' AND DD.lv011=1) TongTien,(select sum(IF(ISNULL(DD.lv006),0,DD.lv006)) from tc_lv0026 DD  where DD.lv004=A.lv004 and DD.lv003='$vCalID' and DD.lv013=1 and DD.lv012='$vDepartment'  AND DD.lv011=1) TongCongNgoai,$hesok hesok,$tanggiamhso tanggiamconglv   from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join tc_lv0009 C on B.lv002=C.lv002 and C.lv003='$vmonth' and C.lv004='$vyear' left join tc_lv0025 D on C.lv008=D.lv001 and D.lv002='".$vCalID."' where A.lv004='$vDay' and ((A.lv002 in ($vListCalendar) AND (A.lv011='' or ISNULL(A.lv011))) or A.lv011='$vDepartment')  and A.lv007 in ('1','2','3','11','22','33','U','H','AD')";
		}
			$this->ArrDepartment["$vDepartment"][0]['value']=true;
			$vresult=db_query($vsql);
			$this->ArrDepartment["$vDepartment"][0]['log']='<p style="cursor:pointer" onclick=document.getElementById("logto").style.display="block">Lương tổ(phòng ban) từng ngày :</p><div id=logto style="display:none">';
			while($vrow=db_fetch_array($vresult))
			{
				$i=$vrow['stt'];
				$this->ArrDepartment["$vDepartment"][$i]['ngaytinh']=$vrow['ngaytinh'];
				$this->ArrDepartment["$vDepartment"][$i]['hesok']=$vrow['hesok'];
				$this->ArrDepartment["$vDepartment"][$i]['tonghesocong']=$vrow['tonghesocong'];
				$this->ArrDepartment["$vDepartment"][$i]['tongcong']=$vrow['tongcong'];
				$this->ArrDepartment["$vDepartment"][$i]['TongTien']=$vrow['TongTien'];
				$this->ArrDepartment["$vDepartment"][$i]['ngaytinh']=$vrow['ngaytinh'];
				$this->ArrDepartment["$vDepartment"][$i]['tanggiamconglv']=$vrow['tanggiamconglv'];
				$this->ArrDepartment["$vDepartment"][$i]['TongCongNgoai']=$vrow['TongCongNgoai'];
				$this->ArrDepartment["$vDepartment"][0][$vrow['MaCong']]=(int)$this->ArrDepartment["$vDepartment"][0][$vrow['MaCong']]+1;
				
				if($this->ArrDepartment["$vDepartment"][$i]['tongcong']>0)
				{
					if($this->ArrDepartment["$vDepartment"][$i]['hesok']==0) $this->ArrDepartment["$vDepartment"][$i]['hesok']=1;
					$this->ArrDepartment["$vDepartment"][$i]['TienPhongBan']=round($this->ArrDepartment["$vDepartment"][$i]['TongTien']*$this->ArrDepartment["$vDepartment"][$i]['tongcong']*$this->ArrDepartment["$vDepartment"][$i]['hesok']/($this->ArrDepartment["$vDepartment"][$i]['tongcong']+$this->ArrDepartment["$vDepartment"][$i]['TongCongNgoai']+$this->ArrDepartment["$vDepartment"][$i]['tanggiamconglv']),0);
					$this->ArrDepartment["$vDepartment"][0]['TienPhongBan']=$this->ArrDepartment["$vDepartment"][0]['TienPhongBan']+$this->ArrDepartment["$vDepartment"][$i]['TienPhongBan'];
					$this->ArrDepartment["$vDepartment"][0]['log']=$this->ArrDepartment["$vDepartment"][0]['log']."ngày $i:".$this->ArrDepartment["$vDepartment"][$i]['TongTien']."*".$this->ArrDepartment["$vDepartment"][$i]['tongcong']."*".$this->ArrDepartment["$vDepartment"][$i]['hesok']."/".($this->ArrDepartment["$vDepartment"][$i]['tongcong']+$this->ArrDepartment["$vDepartment"][$i]['TongCongNgoai']+$this->ArrDepartment["$vDepartment"][$i]['tanggiamconglv'])."=".(round($this->ArrDepartment["$vDepartment"][$i]['TongTien']*$this->ArrDepartment["$vDepartment"][$i]['tongcong']*$this->ArrDepartment["$vDepartment"][$i]['hesok']/($this->ArrDepartment["$vDepartment"][$i]['tongcong']+$this->ArrDepartment["$vDepartment"][$i]['TongCongNgoai']+$this->ArrDepartment["$vDepartment"][$i]['tanggiamconglv']),0))."<br/>";
				}
			}
			$this->ArrDepartment["$vDepartment"][0]['log']=$this->ArrDepartment["$vDepartment"][0]['log']."</div>";
	}
	function LV_GetLimitDate($vstartdate,$venddate)
	{
		if(count($this->vArrDay)>0) return $this->vArrDay;
		$vstt=1;
		$vstartday=(int)getday($vstartdate);
		$vstartmonth=getmonth($vstartdate);
		$vstartyear=getyear($vstartdate);
		$vendday=(int)getday($venddate);
		$vendmonth=getmonth($venddate);
		$vendyear=getyear($venddate);
		if($vstartmonth!=$vendmonth)
		{
			$vStartNumDay=GetDayInMonth($vstartyear,$vstartmonth);
			for($i=$vstartday;$i<=$vStartNumDay;$i++)
			{
				$this->vArrDay[$vstt]=$vstartyear."-".Fillnum($vstartmonth,2)."-".Fillnum($i,2);
				$vstt++;
			}
			$vEndNumDay=$vendday;
			for($i=1;$i<=$vEndNumDay;$i++)
			{
				$this->vArrDay[$vstt]=$vendyear."-".Fillnum($vendmonth,2)."-".Fillnum($i,2);
				$vstt++;
			}
		}
		else
		{
			for($i=$vstartday;$i<=$vendday;$i++)
			{
				$this->vArrDay[$vstt]=$vstartyear."-".Fillnum($vstartmonth,2)."-".Fillnum($i,2);
				$vstt++;
			}
		}
		return $this->vArrDay;
	}
	function TinhCongTheoNgayVP_BV($vEmpID,$vstartdate,$venddate,$vrate,$vCalID,&$ArrEmpList)
	{
		$vListEmp="'".$vEmpID."'";
		$vListCalendar=$this->LV_GetListCalendar($vListEmp,'lv001');
		if($vListCalendar=="") $vListCalendar="''";
		$vArrDay=$this->LV_GetLimitDate($vstartdate,$venddate);
		$hesok=0;
		$this->LV_GETHSOK($this->mohr_lv0020->lv029,$vCalID,$hesok,$tanggiamhso);
		for($i=1;$i<=count($vArrDay);$i++)
		{
			$vDay=$vArrDay[$i];
			if($this->ArrDaySpecial[0]['state']==false)
			{
				if(GetDayOfWeek($vDay)==7)	$this->ArrDaySpecial[0]['T7']=(int)$this->ArrDaySpecial[0]['T7']+1;
				if(GetDayOfWeek($vDay)==1)	$this->ArrDaySpecial[0]['CN']=(int)$this->ArrDaySpecial[0]['CN']+1;
			}
			if($vsql=="")
				$vsql="select $i stt, A.lv007 MaCong,A.lv008 tiencomtc,A.lv010 tiencom,A.lv004 ngaytinh,A.lv011 DepID from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 where A.lv004='$vDay' and A.lv002 in ($vListCalendar) ";
			else
				$vsql=$vsql." union
				       select $i stt, A.lv007 MaCong,A.lv008 tiencomtc,A.lv010 tiencom,A.lv004 ngaytinh,A.lv011 DepID from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 where A.lv004='$vDay' and A.lv002 in ($vListCalendar)";
		}
		$this->ArrDaySpecial[0]['state']=true;
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			$i=$vrow['stt'];
			$ArrEmpList["$vEmpID"][$i]['value']=true;
			$ArrEmpList["$vEmpID"][$i]['DepID']=$vrow['DepID'];
			$ArrEmpList["$vEmpID"][$i]['HSCV']=$vrow['hscv'];
			$ArrEmpList["$vEmpID"][$i]['MaCong']=$vrow['MaCong'];
			$ArrEmpList["$vEmpID"][$i]['ngaytinh']=$vrow['ngaytinh'];
			$ArrEmpList["$vEmpID"][$i]['hesok']=$vrow['hesok'];				
			$ArrEmpList["$vEmpID"][0][$vrow['MaCong']]=(int)$ArrEmpList["$vEmpID"][0][$vrow['MaCong']]+1;
			if((int)$ArrEmpList["$vEmpID"][0]['hesok']==0) $ArrEmpList["$vEmpID"][0]['hesok']=$vrow['hesok'];
			if($vrow['tiencom']!=1)
				$ArrEmpList["$vEmpID"][0]['tiencom']=(int)$ArrEmpList["$vEmpID"][0]['tiencom']+1;	
			else
				$ArrEmpList["$vEmpID"][0]['tiencoman']=(int)$ArrEmpList["$vEmpID"][0]['tiencoman']+1;	
			if($vrow['tiencomtc']!=1)
				$ArrEmpList["$vEmpID"][0]['tiencomtc']=(int)$ArrEmpList["$vEmpID"][0]['tiencomtc']+1;	
			else
				$ArrEmpList["$vEmpID"][0]['tiencomtcan']=(int)$ArrEmpList["$vEmpID"][0]['tiencomtcan']+1;	
		}
		
	}
	function LV_GetListEmp($vDepartment,$vField)
	{
		$vsql="select $vField from hr_lv0020 where lv029 in ($vDepartment)";
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
	function LV_GetTongHeCong($vObjCal)
	{
		
		$vsql="select lv003 from tc_lv0031 where lv002='".$vObjCal->lv001."' and lv007=1";
		$vresult=db_query($vsql);
		$strReturn="";
		while($vrow=db_fetch_array($vresult))
		{
			if($strReturn=="") $strReturn="'".$vrow['lv003']."'";
				else $strReturn=$strReturn.",'".$vrow['lv003']."'";
		}
		$vListEmp=$this->LV_GetListEmp($strReturn,'lv001');
		if($vListEmp=="") return 0;
		$vsql="select sum(lv007) sumcong from tc_lv0009 where lv003='".$vObjCal->lv006."' and lv004='".$vObjCal->lv007."' and lv002 in ($vListEmp) ";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)		return $vrow['sumcong'];
		return 0;
		
	}
	function LV_GetPriceProduct($vCalculateTimesID,$ItemID)
	{
		$vsql="select lv004 from tc_lv0015 where lv002='$vCalculateTimesID' and lv003='$ItemID'";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)		return $vrow['lv004'];
		return 0;
	}
	function PreCalculate($vObjCal,$vEmployeeID,$vTypeCalculate,$salaryitem,$heso,$salarydepartment,$totalnumtime,$departmentid,$vrate=0,$vPetrol)
	{
		$this->lv002=$vEmployeeID;
		$this->lv003=GetServerDate();
		$this->lv004=$vObjCal->lv004;
		$this->lv005=$vObjCal->lv005;
		$this->mohr_lv0038->LV_PreLoadActive($vEmployeeID);
		$this->motc_lv0008->LV_LoadCurrentID($vEmployeeID,$vObjCal->lv005);
		$vTypeCalculate=$this->mohr_lv0038->lv012;
		$this->lv098=$vObjCal->lv001;
		$this->lv081=$vTypeCalculate;
		switch($vTypeCalculate)
		{
			case 0:
			case 1:
			case 2:
			case 3:
				$this->PreCaculateSalaryNone($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol);
				break;
		
			
		}
	}
	function PreCaculateSalaryNone($vObjCal,$vEmployeeID,$vPara,$heso,$vrate,$vTypeCalculate,$vPetrol)
	{
		$this->mohr_lv0020->LV_CurLoadID($vEmployeeID);
		$vArrDepartment=Array();
		$vDepartmentID=$this->mohr_lv0020->lv029;
		$this->TinhCongTheoNgayVP_BV($vEmployeeID,$vObjCal->lv004,$vObjCal->lv005,$vrate,$vObjCal->lv001,$vArrEmp);
	///Salary belong to insurance anually
		$this->lv006=$this->PreGetSalaryOpt($vEmployeeID,0,$this->mohr_lv0038->lv001);
	///Salary no belong to insurance anually
		$this->lv012=$this->PreGetSalaryOpt($vEmployeeID,1,$this->mohr_lv0038->lv001);
	///Salary belong to benefit anually
		$this->lv008=$this->PreGetSalaryOpt($vEmployeeID,2,$this->mohr_lv0038->lv001);
	///salary belong to substrate anually
		 $this->lv009=$this->PreGetSalaryOpt($vEmployeeID,3,$this->mohr_lv0038->lv001);	
	/////////////////////////////////
		$this->lv021=$this->GetContract($vEmployeeID,'lv001');
		$vContractTypeID=$this->GetContract($vEmployeeID,'lv003');
		if((int)$vContractTypeID==1 || (int)$vContractTypeID==3)
		{
			$this->lv072=(float)$vObjCal->lv012*$this->lv006/100;
			$this->lv073=(float)$vObjCal->lv013*$this->lv006/100;
			$this->lv074=(float)$vObjCal->lv014*$this->lv006/100;
			
			$this->lv075=(float)$vObjCal->lv017*$this->lv006/100;
			$this->lv076=(float)$vObjCal->lv018*$this->lv006/100;
			$this->lv077=(float)$vObjCal->lv019*$this->lv006/100;
			
			
			//Company pay 100%
			$this->lv078=$this->lv072+$this->lv073+$this->lv074+$this->lv075+$this->lv076+$this->lv077;

		}
		else
		{
			$this->lv072=0;
			$this->lv073=0;
			$this->lv074=0;
			$this->lv075=0;
			$this->lv076=0;
			$this->lv077=0;

			//Company pay 100%
			$this->lv078=0;
		}
		if($this->mohr_lv0020->lv031!='VIETNAM')
		{
			$this->lv072=0;
			$this->lv073=0;
			$this->lv074=0;
			$this->lv075=0;
			if((int)$vContractTypeID==1 || (int)$vContractTypeID==3)
				$this->lv076=$vObjCal->lv020;
			else
				$this->lv076=0;
			$this->lv077=0;
			//Company pay 100%
			$this->lv078=$this->lv072+$this->lv073+$this->lv074+$this->lv075+$this->lv076+$this->lv077;
			
		}
	//////////Get Expensive//////////
		$this->lv011=(float)$this->GetExpensive($vEmployeeID,$vObjCal->lv001);
	///Get Cost of Temporary
		$this->lv010=(float)$this->GetCost($vEmployeeID,$vObjCal->lv001);
		$vNumDay=GetDayWorkInMonths($vObjCal->lv007,$vObjCal->lv006,$vPara);
		//Lấy dữ liệu tổng hệ số công select sum(lv007) from tc_lv0009 where lv003='8' and lv004='2013' and lv002 in (select lv001 from hr_lv0020 where lv029='MAYKY'  );
		//select A.lv004,sum(C.lv007),(select sum(DD.lv006) from tc_lv0026 DD where DD.lv004=A.lv004) TongTien  from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join tc_lv0009 C on B.lv002=C.lv002 where A.lv004='2013-08-01' and A.lv002 in (select lv001 from tc_lv0010 where lv002 in(select lv001 from hr_lv0020 where lv029='MAYKY'));
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		if($calendar=="") $calendar="''";
		//LÆ°Æ¡ng % theo chuyá»�n
		$this->lv025=0;
		//Tổng công cộng thêm
		$vlv024_sum=$this->LV_GetTongHeCong($vObjCal);
		/////salary DependenceMoney
		$this->lv040=$this->mohr_lv0020->lv049;
		$this->lv041=$vObjCal->lv023*$this->lv040;
		//$this->lv041=$this->GetSalaryOpt($vEmployeeID,4);	
		//if($vObjCal->lv023>0) $this->lv040=(int)$this->lv041/$vObjCal->lv023;	
		//Other
		$this->lv013=(int)$vArrEmp["$vEmployeeID"][0]['P-O']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-O');
		//PH
		$this->lv014=(int)$vArrEmp["$vEmployeeID"][0]['P-PH']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-PH');
		//Weeding
		$this->lv015=(int)$vArrEmp["$vEmployeeID"][0]['P-W']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-W');	
		// Annual & Hafl annual
		$this->lv016=(float)$vArrEmp["$vEmployeeID"][0]['P-A']+(float)$vArrEmp["$vEmployeeID"][0]['P-HA']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-A');
		//Weeding
		$this->lv017=(int)$vArrEmp["$vEmployeeID"][0]['P-F']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-F');	
		//Actual Worked
		$vNS=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-NS');
		$vX=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-X');
		$this->lv018=(int)$vArrEmp["$vEmployeeID"][0]['P-X']+(($vX>0)?0:$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-NN100')/9.5)+(float)$vArrEmp["$vEmployeeID"][0]['P-HA']*0.5+(float)$vArrEmp["$vEmployeeID"][0]['P-HP']*0.5+$vX-$vNS;
		//Night Shift -----Chưa ổn--------
		
		$this->lv019=(($vNS>0)?0:$this->GetNightShiftNum($vObjCal->lv001,$vEmployeeID,'P-NN130'))+$vNS;			
		//Personal
		//$this->lv020=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['HP']*0.5+(int)$vArrEmp["$vEmployeeID"][0]['R']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P')+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'R');			
		$this->lv020=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['P-HP']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-P');			
		//Sick
		$this->lv021=(int)$vArrEmp["$vEmployeeID"][0]['P-S']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-S');			
		//Normal 150%
		$this->lv022=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-NN150')+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-N7150');			
		//RH 200%
		$this->lv023=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-N7200')+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-NS200');			
		//Night shift 195%
		$this->lv024=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-N7195')+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-NN195');			
		//Sunday  260%
		$this->lv025=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-N7260')+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-NS260');
		//PH  300%
		$this->lv026=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-HP300');
		//Meal
		$this->lv027=(int)$vArrEmp["$vEmployeeID"][0]['P-tiencoman']+$vArrEmp["$vEmployeeID"][0]['P-tiencomtcan']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-Meal');
		//Petrol
		$this->lv028=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-Petrol');	
		$vdaydiv=22;
		switch($this->mohr_lv0038->lv011)
		{
			case 0:	$vdaydiv=26;
			break;
			case 1:
				if(count($this->vArrDay)==0)		
					$vdaydiv=22;
				else
					$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				$vdaydiv=22;	
				
			break;
			case 2: $vdaydiv=30;
			break;
		}
		echo "</br>số ngày làm việc:".$vdaydiv."</br>";
		//NightShift Allowance
		$this->lv029=$this->mohr_lv0020->lv005;//($this->lv012/$vdaydiv)*0.3*$this->lv019;
		//Mixing Operator allowance
		$this->lv030=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-MO');
		//LUCKYMONEY
		$this->lv031=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-LUCKYMONEY'");
		//OT level apply for QC 
		$this->lv032=1;
		//Inflation allowance 
		$this->lv033=0;
		//Opretor 
		$this->lv034=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P-OP');
		
		//Actual month salary 
		$this->lv035=($this->lv012/$vdaydiv)*($this->lv013+$this->lv014+$this->lv015+$this->lv016+$this->lv017+$this->lv018+$this->lv019);
		//OverTime Normal
		$this->lv036=$this->GetNightShiftPrice($vObjCal->lv001,$vEmployeeID,'P-NN150')+$this->GetNightShiftPrice($vObjCal->lv001,$vEmployeeID,'P-N7150');			
		if($this->lv036==0)	$this->lv036=($this->lv012/$vdaydiv/(($this->mohr_lv0038->lv007==0)?1:$this->mohr_lv0038->lv007))*1.5*$this->lv022;
		//OverTime RH
		$this->lv037=($this->lv012/$vdaydiv/(($this->mohr_lv0038->lv007==0)?1:$this->mohr_lv0038->lv007))*2*$this->lv023;
		//OverTime Night shift day
		$this->lv038=($this->lv012/$vdaydiv/(($this->mohr_lv0038->lv007==0)?1:$this->mohr_lv0038->lv007))*1.95*$this->lv024;
		//OverTime Night shift day(Sunday)
		$this->lv039=($this->lv012/$vdaydiv/(($this->mohr_lv0038->lv007==0)?1:$this->mohr_lv0038->lv007))*2.6*$this->lv025;
		//OverTime PH
		$this->lv040=($this->lv012/$vdaydiv/(($this->mohr_lv0038->lv007==0)?1:$this->mohr_lv0038->lv007))*3*$this->lv026;
		
		//Allowances Petrol
		if($this->mohr_lv0038->lv016==1)
		{
		//Allowances Meal
			if($this->ArrPriceItem['Meal']==NULL || $this->ArrPriceItem['Meal']=="") $this->ArrPriceItem['Meal']=$this->LV_GetPriceProduct($vObjCal->lv001,'Meal');
			$this->lv041=$this->ArrPriceItem['Meal']*($this->lv018+$this->lv019+$this->lv027);
			
			if($this->ArrPriceItem['Transport']==NULL || $this->ArrPriceItem['Transport']=="") $this->ArrPriceItem['Transport']=$this->LV_GetPriceProduct($vObjCal->lv001,'Transport');
			$this->lv042=$this->ArrPriceItem['Transport']*($this->lv018+$this->lv019+$this->lv028);
		}
		else
		{
			//Allowances Meal
			if($this->ArrPriceItem['Meal']==NULL || $this->ArrPriceItem['Meal']=="") $this->ArrPriceItem['Meal']=$this->LV_GetPriceProduct($vObjCal->lv001,'Meal');
			$this->lv041=$this->ArrPriceItem['Meal']*($this->lv027);
			if($this->ArrPriceItem['P-Transport']==NULL || $this->ArrPriceItem['P-Transport']=="") $this->ArrPriceItem['P-Transport']=$this->LV_GetPriceProduct($vObjCal->lv001,'P-Transport');
			$this->lv042=$this->ArrPriceItem['P-Transport']*($this->lv028);
		}
		//Night shift allowance
		$this->lv043=($this->lv012/$vdaydiv)*0.3*$this->lv019;
		//Night shift allowance
		if($this->ArrPriceItem['MixingO']==NULL || $this->ArrPriceItem['MixingO']=="") $this->ArrPriceItem['MixingO']=$this->LV_GetPriceProduct($vObjCal->lv001,'MixingO');
		$this->lv044= $this->ArrPriceItem['MixingO']*$this->lv030;
		//Attendance 200.0000
		if($this->ArrPriceItem['Attendance']==NULL || $this->ArrPriceItem['Attendance']=="") $this->ArrPriceItem['Attendance']=$this->LV_GetPriceProduct($vObjCal->lv001,'Attendance');
		if(($this->lv013+$this->lv014+$this->lv015+$this->lv016+$this->lv017+$this->lv018+$this->lv019)>=$vdaydiv)
		{
			$this->lv045= $this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-ATTENDANCE'")+$this->mohr_lv0038->lv018;
		}
		else
			$this->lv045= $this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-ATTENDANCE'")+($this->mohr_lv0038->lv018/$vdaydiv)*($this->lv018+$this->lv019);
		
		// OT Level apply for QC
		if($vTypeCalculate==2)
		{
			if($this->mohr_lv0038->lv013==700000)
				$this->lv046=25000*($this->lv022+$this->lv023+$this->lv024+$this->lv025+$this->lv026);
			elseif($this->mohr_lv0038->lv013==600000)
				$this->lv046=20000*($this->lv022+$this->lv023+$this->lv024+$this->lv025+$this->lv026);
			elseif($this->mohr_lv0038->lv013==500000)
				$this->lv046=15000*($this->lv022+$this->lv023+$this->lv024+$this->lv025+$this->lv026);
			else
				$this->lv046=10000*($this->lv022+$this->lv023+$this->lv024+$this->lv025+$this->lv026);				
		}
		else
			$this->lv046=0;
		//Inflation allowance 
		$this->lv047=$this->mohr_lv0038->lv020+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'INFLATION'");
		//Opretor 
		if($this->ArrPriceItem['P-Opretor']==NULL || $this->ArrPriceItem['P-Opretor']=="") $this->ArrPriceItem['P-Opretor']=$this->LV_GetPriceProduct($vObjCal->lv001,'P-Opretor');
		$this->lv048= $this->ArrPriceItem['P-Opretor']*$this->lv034;
		//Position Free
		$this->lv049=$this->mohr_lv0038->lv013;
		//Leader
		$this->lv050=$this->mohr_lv0038->lv014;
		//
		if($this->mohr_lv0038->lv012==3)
		{
			echo $vCongThuc=$this->LV_SPIForSale($vEmployeeID,$vObjCal->lv001,$vrate);
			echo $this->lv051=$this->LV_SPIForSaleRun($vCongThuc)+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-SPI'");
			echo "<br/>";
		}
		else		
			$this->lv051=0;
		if($vPetrol!="")
		{
			$ArrPetrol=$this->Get_PetrolParkingMobil($vObjCal->lv001,$vEmployeeID,$vPetrol,$vdaydiv,$vArrEmp);
			//Phụ cấp tiền xăng
			$this->lv052=$ArrPetrol[0]+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-PETROL'");
			//Parking fee
			$this->lv054=$ArrPetrol[1]+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-PARKING'");
			//Mobie phone
			$this->lv053=$ArrPetrol[2]+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-MOBIE'");
		}
		else
		{
			//Phụ cấp tiền xăng
			$this->lv052=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-PETROL'");
			//Mobie phone
			$this->lv053=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-MOBIE'");
			//Parking fee
			$this->lv054=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-PARKING'");
		}
		//Traveling allowance
		$this->lv055=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-TRAVELING'");
		//Portal allowance
		$this->lv056=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-PORTAL'");
		//Slry reimbursement
		$this->lv057=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-SALARY-RE'");
		//Resignation Allowance
		$this->lv058=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-RE-ALLOW'");
		//Allowance
		$this->lv059=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-ALLOWANCE'");
		//13th salary 
		if($vObjCal->lv021==1)	
			$this->lv060=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'P-SALARY13TH'")+$this->GetSalary13TH($vObjCal,$this->mohr_lv0020->lv030,$this->lv006);
		else
			$this->lv060=0;
		//Total
		$this->lv061=$this->lv031+$this->lv035+$this->lv036+$this->lv037+$this->lv038+$this->lv039+$this->lv040+$this->lv041+$this->lv042+$this->lv043+$this->lv044+$this->lv045+$this->lv046+$this->lv047+$this->lv048+$this->lv049+$this->lv050+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv056+$this->lv057+$this->lv058+$this->lv059+$this->lv060;
		//Ứng Half Month
		$this->lv062=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'P-HALFMONTH'");
		//Ứng other DEDUCTION
		$this->lv063=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'P-DEDUCTION'");
		//Union Free
		if($this->ArrPriceItem['P-Unionfee']==NULL || $this->ArrPriceItem['Unionfee']=="") $this->ArrPriceItem['Unionfee']=$this->LV_GetPriceProduct($vObjCal->lv001,'Unionfee');
		if($this->mohr_lv0038->lv015==1) $this->lv068=$this->ArrPriceItem['Unionfee'];
		else
			$this->lv068=0;
		
		//Bacsic Salary
		$this->lv071=$this->lv006;
		
		//Private mức đóng thuế
		$this->lv080=0;
		/// Family-Per
		$this->lv081=$this->mohr_lv0020->lv049;
		// Family-amt
		$this->lv082=$vObjCal->lv023*$this->lv081;
		//Meal
		$this->lv085=$this->lv041;
	/*	//Cộng/trừ
		$this->lv030=$this->lv058+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'CONGTRU'")-$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'CONGTRU'");
	*/
		//Salary income 
		$this->lv079=0;
		//Payable
		//Meal
		$this->lv085=$this->lv041;
		if($this->mohr_lv0038->lv017==0)
			{
				if((int)$vContractTypeID==1 || (int)$vContractTypeID==3)
				{
					$this->lv064=(float)$vObjCal->lv012*$this->lv006/100;
					$this->lv065=(float)$vObjCal->lv013*$this->lv006/100;
					$this->lv066=(float)$vObjCal->lv014*$this->lv006/100;
				}
				else
				{
					$this->lv064=0;
					$this->lv065=0;
					$this->lv066=0;
				}
			}
		if($this->mohr_lv0038->lv017!=3)
		{
			//SI
			$this->lv084=$this->lv072+$this->lv073+$this->lv074;
		}
		else
		{
			//SI
			$this->lv084=$this->lv064+$this->lv065+$this->lv066;
		}
		//SI
			$this->lv084=$this->lv064+$this->lv065+$this->lv066;
		$this->lv086=0;//$this->lv079-(float)$vObjCal->lv015-$this->lv082-$this->lv083-$this->lv084-$this->lv085;
		if($this->lv086>0)
		{
			if($this->mohr_lv0038->lv017==1)
			{
				$vCongThuc=str_replace("[Payable]",$this->lv086,$vObjCal->lv025);
				$this->lv087=$this->LV_SPIForSaleRun($vCongThuc);
				$this->lv088=$this->GetTax($this->lv087);
				///PIT				
				$this->lv067=0;
			}
			else
			{
				$this->lv087=$this->lv086;
				$this->lv088=$this->GetTax($this->lv087);
				////PIT
				$this->lv067=$this->lv088;
			}
				
				$this->lv089=$this->lv079;
			//Gross salary
			
		}
		else
		{
			$this->lv086=0;
			$this->lv087=0;
			$this->lv088=0; 
			$this->lv089=0;
			$this->lv067=0;
		}
		$this->lv067=$this->lv067+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'P-PIT'");
		//Remaining Amount 
		$this->lv069=$this->lv061-$this->lv062-$this->lv063-$this->lv064-$this->lv065-$this->lv066-$this->lv068-$this->lv067;
		//Round
			$this->lv070=round($this->lv069,0);
		
		if($this->mohr_lv0038->lv019==1)
		{
			//Employee's charge
			$this->lv091=$this->lv064+$this->lv065+$this->lv066+$this->lv067+$this->lv068;//+$this->lv063;
			//Employer's charge
			$this->lv090=$this->lv088+$this->lv078+$this->lv061;
		}
		else
		{
			//Employee's charge
			$this->lv091=$this->lv064+$this->lv065+$this->lv066+$this->lv067+$this->lv068;//+$this->lv063;
			//Employer's charge
			$this->lv090=$this->lv075+$this->lv076+$this->lv077+$this->lv061;
		}
		$this->lv095=$this->mohr_lv0038->lv012;
		//Department
		$this->lv096=$vDepartmentID;
		//BankACount
		$this->lv099=$this->mohr_lv0020->lv014;
		//
		$this->lv007=$vEmployeeID;
		$this->lv001=$this->CheckExist($vObjCal->lv001,$vEmployeeID,1);
		if($this->lv001==-1)
		{
			$this->LV_Insert();
		}
		else
			$this->LV_Update();
		
		//$this->GetSalaryhours($vCalculateTimesID,$vEmployeeID,$this->lv022,$vObjCal->lv004,$vObjCal->lv005,$vObjCal->lv007,$vObjCal->lv006);
		
			
		
	}
	function Calculate($vObjCal,$vEmployeeID,$vTypeCalculate,$salaryitem,$heso,$salarydepartment,$totalnumtime,$departmentid,$vrate=0,$vPetrol)
	{
		$this->lv002=$vEmployeeID;
		$this->lv003=GetServerDate();
		$this->lv004=$vObjCal->lv004;
		$this->lv005=$vObjCal->lv005;
		$this->mohr_lv0038->LV_LoadActive($vEmployeeID);
		$this->motc_lv0008->LV_LoadCurrentID($vEmployeeID,$vObjCal->lv005);
		$vTypeCalculate=$this->mohr_lv0038->lv012;
		$this->lv098=$vObjCal->lv001;
		$this->lv081=$vTypeCalculate;
		switch($vTypeCalculate)
		{
			case 0:
			case 1:
			case 2:
			case 3:
				$this->CaculateSalaryNone($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol);
				break;
		
			
		}
	}
	
	function GetSalary13TH($vObjCal,$vDateWork,$vBasicSalary)
	{
		$vYear=getyear($vDateWork);
		$vMonth=getmonth($vDateWork);
		$vday=(int)getday($vDateWork);
		if($vYear=$vObjCal->lv007)
		{
			for($i=(int)$vMonth;$i<=12;$i++)
			{
				$vnumdays=$vnumdays+GetDayInMonth($vYear,$i);
			}
			$vnumdays=$vnumdays-$vday+1;
			return $vBasicSalary*$vnumdays/365;
		}
		elseif($vYear<$vObjCal->lv007)
		{
			return $vBasicSalary;
		}
		return 0;
	}
	function LV_SPIManager($vEmployee,$vCalID,$vCongTHuc)
	{
		$vsql="select A.lv001 from hr_lv0020 A where A.lv042='$vEmployee'";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($vCongThuc1=="")
				$vCongThuc1=$this->LV_SPIForSaleReady($vrow['lv001'],$vCalID,$vCongTHuc);
			else
				$vCongThuc1=$vCongThuc1.'+'.$this->LV_SPIForSaleReady($vrow['lv001'],$vCalID,$vCongTHuc);
		}
		return $vCongThuc1;
	}
	function LV_SPIForSaleRun($vCongTHuc)
	{
		$vCongTHuc=str_replace(" ","",$vCongTHuc);
		$vCongTHuc1=$vCongTHuc;
		for($i=strlen($vCongTHuc);$i>=0;$i--)
		{
			$vTwo=substr($vCongTHuc,$i,2);
			if(strtoupper($vTwo)=="IF")
			{
				$vEndVT= $this->LV_IF($i,$vCongTHuc);
				$vFunIFRun=$this->LV_IFRUN(substr($vCongTHuc,$i,$vEndVT-$i));
				$vCongTHuc1=str_replace(substr($vCongTHuc,$i,$vEndVT-$i+1),$vFunIFRun,$vCongTHuc1);
				$vCongTHuc=$vCongTHuc1;
			}
			
		}	
		$vCongTHuc2=$vCongTHuc1;
		for($i=0;$i<strlen($vCongTHuc1);$i++)
		{
			$vOne=substr($vCongTHuc1,$i,1);
			if(strtoupper($vOne)=="(")
			{
				$vEndVT= $this->LV_DAYMO($i,$vCongTHuc1);
				
				$vFunIFRun=$this->LV_DAYMORUN(substr($vCongTHuc1,$i,$vEndVT-$i+1));
				$vCongTHuc2=str_replace(substr($vCongTHuc1,$i,$vEndVT-$i+1),$vFunIFRun,$vCongTHuc2);
				$i=$vEndVT;
			}
			
			
		}	
		//echo $vCongTHuc2;
		return $this->LV_CheckOperation($vCongTHuc2);
		
	}
	function LV_DieuKien($vStr)
	{
		if(eregi("&",$vStr))
		{
			
			$vArrStr=explode("&",$vStr);
			if($this->LV_CheckOperation($this->LV_DieuKien($vArrStr[0])) && $this->LV_CheckOperation($this->LV_DieuKien($vArrStr[1])))
			{
				return true;
			}
			else
			return false;
		}
		elseif(eregi(">=",$vStr))
		{
			$vArrStr=explode(">=",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])>=$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		else if(eregi("<=",$vStr))
		{
			
			$vArrStr=explode("<=",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])<=$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		else if(eregi("!=",$vStr))
		{
			
			$vArrStr=explode("!=",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])!=$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		else if(eregi("<>",$vStr))
		{
			
			$vArrStr=explode("<>",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])<>$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		else if(eregi("=",$vStr))
		{
			
			$vArrStr=explode("=",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])==$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		else if(eregi(">",$vStr))
		{
			
			$vArrStr=explode(">",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])>$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		else if(eregi("<",$vStr))
		{
			
			$vArrStr=explode("<",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])<$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		
		return false;
		
	}
	function LV_DAYMORUN($vStr)
	{
		$vStr=substr($vStr,1,strlen($vStr)-2);
		return $this->LV_CheckOperation($vStr);
		
	}
	function LV_IFRUN($vStr)
	{	
		$vArStr=explode("(",$vStr,2);//lây IF
		if(strpos($vArStr[1],"IF")===false)
		{
			$vAr1=explode(",",$vArStr[1],3);
			if($this->LV_DieuKien($vAr1[0]))
			{
				return $vAr1[1];
			}
			else
				return $vAr1[2];
		}
		else
		{
			$vAr1=explode(",",$vArStr[1],3);
			if($this->LV_DieuKien($vAr1[0]))
			{
				if(strpos($vAr1[1],"IF")===false)
					return $this->LV_CheckOperation($vAr1[1]);
				else
					{
						$vEndVT=$this->LV_IF(0,$vAr1[1]);
						return $this->LV_IFRUN(substr($vAr1[1],0,$vEndVT));
						
					}
			}
			else
			{
				if(strpos($vAr1[2],"IF")===false)
					return $this->LV_CheckOperation($vAr1[2]);
				else
				{
					$vEndVT=$this->LV_IF(0,$vAr1[2]);
					return $this->LV_IFRUN(substr($vAr1[2],0,$vEndVT));
				}
				
			}
			
		}
		for($v=$vVitri+2;$v<strlen($vStr);$v++)
		{
			$vOne=substr($vStr,$v,1);
			if($vOne=="(") $vtang++;
			if($vOne==")") $vtang--;
			if($vtang==0) return $v;
		}
		return $vVitri;
	}
	function LV_CheckOperation($vStr)
	{
		$vCongTHuc2=$vStr;
		for($i=0;$i<strlen($vStr);$i++)
		{
			$vOne=substr($vStr,$i,1);
			if(strtoupper($vOne)=="(")
			{
				$vEndVT= $this->LV_DAYMO($i,$vStr);
				
				$vFunIFRun=$this->LV_DAYMORUN(substr($vStr,$i,$vEndVT-$i+1));
				$vCongTHuc2=str_replace(substr($vStr,$i,$vEndVT-$i+1),$vFunIFRun,$vCongTHuc2);
				$i=$vEndVT;
			}
			
			
		}	
		$vStr=$vCongTHuc2;
		if(strpos($vStr,"+")>0)
		{
			$vArrStr=explode("+",$vStr,2);
			return $this->LV_CheckOperation($vArrStr[0])+$this->LV_CheckOperation($vArrStr[1]);
		}
		else if(strpos($vStr,"-")>0)
		{			
			$vArrStr=explode("-",$vStr,2);
			return $this->LV_CheckOperation($vArrStr[0])-$this->LV_CheckOperation($vArrStr[1]);
		}
		else if(strpos($vStr,"*")>0)
		{			
			$vArrStr=explode("*",$vStr,2);
			return $this->LV_CheckOperation($vArrStr[0])*$this->LV_CheckOperation($vArrStr[1]);
		}
		else if(strpos($vStr,"/")>0)
		{			
			$vArrStr=explode("/",$vStr,2);
			return $this->LV_CheckOperation($vArrStr[0])/$this->LV_CheckOperation($vArrStr[1]);
		}
		else if(strpos($vStr,"%")>0)
		{			
			$vArrStr=explode("%",$vStr,2);
			return $this->LV_CheckOperation($vArrStr[0])%$this->LV_CheckOperation($vArrStr[1]);
		}
		else if(strpos($vStr,"^")>0)
		{			
			$vArrStr=explode("^",$vStr,2);
			return $this->LV_LayNguyen($this->LV_CheckOperation($vArrStr[0])/$this->LV_CheckOperation($vArrStr[1]));
		}
		return (float)$vStr;
	}
	function LV_LayNguyen($vNumber)
	{
		$vArray=explode(".",$vNumber);
		return $vArray[0];
	}
	function LV_DAYMO($vVitri,$vStr)
	{
		$vtang=0;
		for($v=$vVitri;$v<strlen($vStr);$v++)
		{
			$vOne=substr($vStr,$v,1);
			if($vOne=="(") $vtang++;
			if($vOne==")") $vtang--;
			if($vtang==0) return $v;
		}
		return $vVitri;
		
	}
	function LV_IF($vVitri,$vStr)
	{
		$vtang=0;
		for($v=$vVitri+2;$v<strlen($vStr);$v++)
		{
			$vOne=substr($vStr,$v,1);
			if($vOne=="(") $vtang++;
			if($vOne==")") $vtang--;
			if($vtang==0) return $v;
		}
		return $vVitri;
	}
	function LV_SPIForSaleReady($vEmployee,$vCalID,$vCongThuc)
	{

			$vCongThuc=str_replace("\n\r","",$vCongThuc);
			$vCongThuc=str_replace("\n","",$vCongThuc);
			$vCongThuc=str_replace("\r","",$vCongThuc);
			$vCongThuc1=$vCongThuc;
			$vTimeArr=$this->LV_GetItemArr($vCongThuc,$vEmployee,$vCalID);
			for($i=0;$i<count($vTimeArr);$i++)
			{
				$vCongThuc1=str_replace($vTimeArr[$i]['name'],$vTimeArr[$i]['value'],$vCongThuc1);
			}
			return $vCongThuc1;
	}
	function LV_SPIForSale($vEmployee,$vCalID,$vTypeOT)
	{
		$vsql="select * from tc_lv0025 where lv002='$vCalID' and lv001='$vTypeOT'";
		$vresult=db_query($vsql);
		$strReturn="";
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vCongThuc=$vrow['lv005'];
			$vCongThuc=str_replace("\n\r","",$vCongThuc);
			$vCongThuc=str_replace("\n","",$vCongThuc);
			$vCongThuc=str_replace("\r","",$vCongThuc);
			
			if(strpos($vCongThuc,"[MANAGER]")===false)
			{
				$vCongThucTong="";
			}
			else
			{
				$vArrCT=explode("#",$vCongThuc,3);
				$vCongThucTong=$vArrCT[1];
				$vLongCongThuc="#".$vArrCT[1]."#";
			}
			if($vCongThucTong!="")
			{
				$vCtyEmp=$this->LV_SPIManager($vEmployee,$vCalID,$vCongThucTong);
				$vCongThuc=str_replace($vLongCongThuc,$vCtyEmp,$vCongThuc);
			}
			
			$vCongThuc1=$vCongThuc;
			$vTimeArr=$this->LV_GetItemArr($vCongThuc,$vEmployee,$vCalID);
			for($i=0;$i<count($vTimeArr);$i++)
			{
				$vCongThuc1=str_replace($vTimeArr[$i]['name'],$vTimeArr[$i]['value'],$vCongThuc1);
			}
		}
		return $vCongThuc1;
	}
	function LV_GetItemArr($vCongThuc,$vEmployee,$vCalID)
	{
		$vReturn=Array();
		$i=0;
		$vArrCT=explode("[",$vCongThuc);
		$strOK="";
		foreach($vArrCT as $vTC)
		{
			$vCTC=explode("]",$vTC);
			
			if(strpos($vCTC[0],",")===false)
			{
				if(strpos($strOK,'['.$vCTC[0].']')===false)
				{
					if($vCTC[0]=='SUMQTY')
						{
							$vsql="select sum(lv004/lv010) sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID' and lv006>0 ";
							$vresult=db_query($vsql);
						
							$vrow=db_fetch_array($vresult);
							$vReturn[$i]['name']='[SUMQTY]';
							$vReturn[$i]['value']=$vrow['sumqty'];
						}
					else if($vCTC[0]=='SUMMONEY')
						{
							$vsql="select sum(lv004*lv006) sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID'  and lv006>0";
							$vresult=db_query($vsql);
						
							$vrow=db_fetch_array($vresult);
							$vReturn[$i]['name']='[SUMMONEY]';
							$vReturn[$i]['value']=$vrow['sumqty'];
						}
					else if($vCTC[0]=='TARGETQTY')
					{					
							$vsql="select lv005 sumqty from tc_lv0035 where lv003='$vEmployee' and lv002='$vCalID' ";
							$vresult=db_query($vsql);
						
							$vrow=db_fetch_array($vresult);
							$vReturn[$i]['name']='[TARGETQTY]';
							$vReturn[$i]['value']=$vrow['sumqty'];
					}
					else if($vCTC[0]=='TARGETAMOUNT')
					{					
							$vsql="select lv004 sumqty from tc_lv0035 where lv003='$vEmployee' and lv002='$vCalID' ";
							$vresult=db_query($vsql);
						
							$vrow=db_fetch_array($vresult);
							$vReturn[$i]['name']='[TARGETAMOUNT]';
							$vReturn[$i]['value']=$vrow['sumqty'];
					}
					else if($vCTC[0]=='DAYOFWORK')
					{
							$vReturn[$i]['name']='[DAYOFWORK]';
							$vReturn[$i]['value']=$this->lv018;
					}
					else
						{
							$vsql="select sum(lv004*lv006) sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID' and lv003='".$vCTC[0]."'";
							$vresult=db_query($vsql);
						
							$vrow=db_fetch_array($vresult);
							$vReturn[$i]['name']='['.$vCTC[0].']';
							$vReturn[$i]['value']=$vrow['sumqty'];
						}
						$strOK=$strOK.",[".$vCTC[0]."]";
						$i++;
				}
			}
			else
			{
				$vDivTC=explode(",",$vCTC[0]);
				if(strpos($strOK,'['.$vCTC[0].']')===false)
				{
				switch($vDivTC[1])
				{
					case "QTY":
						$vsql="select lv004 sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID' and lv003='".$vDivTC[0]."'";
						break;
					case "PRICE":
						$vsql="select (lv006) sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID' and lv003='".$vDivTC[0]."'";
						break;
					case "MONEY":						
						$vsql="select (lv004*lv006) sumqty from sl_lv0014 where lv002='$vEmployee' and lv009='$vCalID' and lv003='".$vDivTC[0]."'";
						break;
				}
				
				$vresult=db_query($vsql);
					
						$vrow=db_fetch_array($vresult);
						$vReturn[$i]['name']='['.$vCTC[0].']';
						$vReturn[$i]['value']=(float)$vrow['sumqty'];
				$strOK=$strOK.",[".$vCTC[0]."]";
				$i++;
				}
			}
			
		}
		return $vReturn;
	}
	function LV_GetTimeCardArr($vCongThuc,$vEmployee,$vCalID,$vdaydiv,$vArrEmp)
	{
		$vReturn=Array();
		$i=0;
		$vArrCT=explode("[",$vCongThuc);
		$strOK="";
		foreach($vArrCT as $vTC)
		{
			$vCTC=explode("]",$vTC);
			
			if(strpos($vCTC[0],",")===false)
			{
				if(strpos($strOK,'['.$vCTC[0].']')===false)
				{
					if($vCTC[0]=='DAYS')
						{
							$vReturn[$i]['name']='[DAYS]';
							$vReturn[$i]['value']=$vdaydiv;
						}
					else if($vCTC[0]=='X')
						{
							$vReturn[$i]['name']='[X]';
							$vReturn[$i]['value']=$this->lv018;
						}
					else if($vCTC[0]=='SUMMONEY')
						{
							$vsql="select sum(lv004*lv006) sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID'  and lv006>0";
							$vresult=db_query($vsql);
						
							$vrow=db_fetch_array($vresult);
							$vReturn[$i]['name']='[SUMMONEY]';
							$vReturn[$i]['value']=$vrow['sumqty'];
						}					
					else
						{
							$vReturn[$i]['name']='['.$vCTC[0].']';
							$vReturn[$i]['value']=(int)$vArrEmp["$vEmployee"][0][$vCTC[0]];
						}
						$strOK=$strOK.",[".$vCTC[0]."]";
						$i++;
				}
			}
			else
			{
				$vDivTC=explode(",",$vCTC[0]);
				if(strpos($strOK,'['.$vCTC[0].']')===false)
				{
				switch($vDivTC[1])
				{
					case "QTY":
						$vsql="select lv004 sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID' and lv003='".$vDivTC[0]."'";
						break;
					case "PRICE":
						$vsql="select (lv006) sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID' and lv003='".$vDivTC[0]."'";
						break;
					case "MONEY":						
						$vsql="select (lv004*lv006) sumqty from sl_lv0014 where lv002='$vEmployee' and lv009='$vCalID' and lv003='".$vDivTC[0]."'";
						break;
				}
				
				$vresult=db_query($vsql);					
				$vrow=db_fetch_array($vresult);
				$vReturn[$i]['name']='['.$vCTC[0].']';
				$vReturn[$i]['value']=(float)$vrow['sumqty'];
				$strOK=$strOK.",[".$vCTC[0]."]";
				$i++;
				}
			}
			
		}
		return $vReturn;
	}
	function LV_TinhPetrol($vEmployee,$vCalID,$vCongThuc,$vdaydiv,$vArrEmp)
	{
			$vCongThuc1=$vCongThuc;
			$vTimeArr=$this->LV_GetTimeCardArr($vCongThuc,$vEmployee,$vCalID,$vdaydiv,$vArrEmp);
			for($i=0;$i<count($vTimeArr);$i++)
			{
				$vCongThuc1=str_replace($vTimeArr[$i]['name'],$vTimeArr[$i]['value'],$vCongThuc1);
			}
		return $this->LV_TinhPetrolRun($vCongThuc1);
	}
	function LV_TinhPetrolRun($vCongTHuc)
	{
		$vCongTHuc=str_replace(" ","",$vCongTHuc);
		$vCongTHuc1=$vCongTHuc;
		for($i=strlen($vCongTHuc);$i>=0;$i--)
		{
			$vTwo=substr($vCongTHuc,$i,2);
			if(strtoupper($vTwo)=="IF")
			{
				$vEndVT= $this->LV_IF($i,$vCongTHuc);
				$vFunIFRun=$this->LV_IFRUN(substr($vCongTHuc,$i,$vEndVT-$i));
				$vCongTHuc1=str_replace(substr($vCongTHuc,$i,$vEndVT-$i+1),$vFunIFRun,$vCongTHuc1);
				$vCongTHuc=$vCongTHuc1;
			}
			
		}	
		$vCongTHuc2=$vCongTHuc1;
		for($i=0;$i<strlen($vCongTHuc1);$i++)
		{
			$vOne=substr($vCongTHuc1,$i,1);
			if(strtoupper($vOne)=="(")
			{
				$vEndVT= $this->LV_DAYMO($i,$vCongTHuc1);
				
				$vFunIFRun=$this->LV_DAYMORUN(substr($vCongTHuc1,$i,$vEndVT-$i+1));
				$vCongTHuc2=str_replace(substr($vCongTHuc1,$i,$vEndVT-$i+1),$vFunIFRun,$vCongTHuc2);
				$i=$vEndVT;
			}
			
			
		}	
		//echo "<br>".'Petrol:'.$vCongTHuc2;
		//echo "=".$this->LV_CheckOperation($vCongTHuc2);
		return $this->LV_CheckOperation($vCongTHuc2);
		
	}
	function Get_PetrolParkingMobil($vCalID,$vEmployeeID,$vPetrol,$vdaydiv,$vArrEmp)
	{
		$vReturn=Array();
		if($this->vArrPetrol[$vPetrol]['state']!=true)
		{		
			$vsql="select * from tc_lv0047 where lv001='$vPetrol' and lv002='$vCalID'";
			$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)		
			{
				$this->vArrPetrol[$vPetrol]['state']=true;
				$this->vArrPetrol[$vPetrol]['petrol']= $vrow['lv004'];
				$this->vArrPetrol[$vPetrol]['parking']= $vrow['lv005'];
				$this->vArrPetrol[$vPetrol]['mobil']= $vrow['lv006'];
			}
		}
		$vRetrun[0]=$this->LV_TinhPetrol($vEmployeeID,$vCalID,$this->vArrPetrol[$vPetrol]['petrol'],$vdaydiv,$vArrEmp);
		$vRetrun[1]=$this->LV_TinhPetrol($vEmployeeID,$vCalID,$this->vArrPetrol[$vPetrol]['parking'],$vdaydiv,$vArrEmp);
		$vRetrun[2]=$this->LV_TinhPetrol($vEmployeeID,$vCalID,$this->vArrPetrol[$vPetrol]['mobil'],$vdaydiv,$vArrEmp);
		return $vRetrun;
	}
	
	function CaculateSalaryNone($vObjCal,$vEmployeeID,$vPara,$heso,$vrate,$vTypeCalculate,$vPetrol)
	{
		$this->mohr_lv0020->LV_CurLoadID($vEmployeeID);
		$vArrDepartment=Array();
		$vDepartmentID=$this->mohr_lv0020->lv029;
		$this->TinhCongTheoNgayVP_BV($vEmployeeID,$vObjCal->lv004,$vObjCal->lv005,$vrate,$vObjCal->lv001,$vArrEmp);
	///Salary belong to insurance anually
		$this->lv006=$this->GetSalaryOpt($vEmployeeID,0);
	///Salary no belong to insurance anually
		$this->lv012=$this->GetSalaryOpt($vEmployeeID,1);
	///Salary belong to benefit anually
		$this->lv008=$this->GetSalaryOpt($vEmployeeID,2);
	///salary belong to substrate anually
		 $this->lv009=$this->GetSalaryOpt($vEmployeeID,3);	
	/////////////////////////////////
		$this->lv021=$this->GetContract($vEmployeeID,'lv001');
		$vContractTypeID=$this->GetContract($vEmployeeID,'lv003');
		if((int)$vContractTypeID==1 || (int)$vContractTypeID==3)
		{
			$this->lv072=(float)$vObjCal->lv012*$this->lv006/100;
			$this->lv073=(float)$vObjCal->lv013*$this->lv006/100;
			$this->lv074=(float)$vObjCal->lv014*$this->lv006/100;
			
			$this->lv075=(float)$vObjCal->lv017*$this->lv006/100;
			$this->lv076=(float)$vObjCal->lv018*$this->lv006/100;
			$this->lv077=(float)$vObjCal->lv019*$this->lv006/100;
			
			
			//Company pay 100%
			$this->lv078=$this->lv072+$this->lv073+$this->lv074+$this->lv075+$this->lv076+$this->lv077;

		}
		else
		{
			$this->lv072=0;
			$this->lv073=0;
			$this->lv074=0;
			$this->lv075=0;
			$this->lv076=0;
			$this->lv077=0;

			//Company pay 100%
			$this->lv078=0;
		}
		if($this->mohr_lv0020->lv031!='VIETNAM')
		{
			$this->lv072=0;
			$this->lv073=0;
			$this->lv074=0;
			$this->lv075=0;
			if((int)$vContractTypeID==1 || (int)$vContractTypeID==3)
				$this->lv076=$vObjCal->lv020;
			else
				$this->lv076=0;
			$this->lv077=0;
			//Company pay 100%
			$this->lv078=$this->lv072+$this->lv073+$this->lv074+$this->lv075+$this->lv076+$this->lv077;
			
		}
	//////////Get Expensive//////////
		$this->lv011=(float)$this->GetExpensive($vEmployeeID,$vObjCal->lv001);
	///Get Cost of Temporary
		$this->lv010=(float)$this->GetCost($vEmployeeID,$vObjCal->lv001);
		$vNumDay=GetDayWorkInMonths($vObjCal->lv007,$vObjCal->lv006,$vPara);
		//Lấy dữ liệu tổng hệ số công select sum(lv007) from tc_lv0009 where lv003='8' and lv004='2013' and lv002 in (select lv001 from hr_lv0020 where lv029='MAYKY'  );
		//select A.lv004,sum(C.lv007),(select sum(DD.lv006) from tc_lv0026 DD where DD.lv004=A.lv004) TongTien  from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join tc_lv0009 C on B.lv002=C.lv002 where A.lv004='2013-08-01' and A.lv002 in (select lv001 from tc_lv0010 where lv002 in(select lv001 from hr_lv0020 where lv029='MAYKY'));
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		if($calendar=="") $calendar="''";
		//LÆ°Æ¡ng % theo chuyá»�n
		$this->lv025=0;
		//Tổng công cộng thêm
		$vlv024_sum=$this->LV_GetTongHeCong($vObjCal);
		/////salary DependenceMoney
		$this->lv040=$this->mohr_lv0020->lv049;
		$this->lv041=$vObjCal->lv023*$this->lv040;
		//$this->lv041=$this->GetSalaryOpt($vEmployeeID,4);	
		//if($vObjCal->lv023>0) $this->lv040=(int)$this->lv041/$vObjCal->lv023;	
		//Other
		$this->lv013=(int)$vArrEmp["$vEmployeeID"][0]['O']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'O');
		//PH
		$this->lv014=(int)$vArrEmp["$vEmployeeID"][0]['L']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'L');
		//Weeding
		$this->lv015=(int)$vArrEmp["$vEmployeeID"][0]['W']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'W');	
		// Annual & Hafl annual
		$this->lv016=(float)$vArrEmp["$vEmployeeID"][0]['A']+(float)$vArrEmp["$vEmployeeID"][0]['HA']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'A');
		//Weeding
		$this->lv017=(int)$vArrEmp["$vEmployeeID"][0]['F']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'F');	
		//Actual Worked
		$vNS=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'NS');
		$vX=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'X');
		$this->lv018=(int)$vArrEmp["$vEmployeeID"][0]['X']+(($vX>0)?0:$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'NN100')/9.5)+(float)$vArrEmp["$vEmployeeID"][0]['HA']*0.5+(float)$vArrEmp["$vEmployeeID"][0]['HP']*0.5+$vX-$vNS;
		//Night Shift -----Chưa ổn--------
		
		$this->lv019=(($vNS>0)?0:$this->GetNightShiftNum($vObjCal->lv001,$vEmployeeID,'NN130'))+$vNS;			
		//Personal
		//$this->lv020=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['HP']*0.5+(int)$vArrEmp["$vEmployeeID"][0]['R']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P')+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'R');			
		$this->lv020=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['HP']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P');			
		//Sick
		$this->lv021=(int)$vArrEmp["$vEmployeeID"][0]['S']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'S');			
		//Normal 150%
		$this->lv022=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'NN150')+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'N7150');			
		//RH 200%
		$this->lv023=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'N7200')+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'NS200');			
		//Night shift 195%
		$this->lv024=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'N7195')+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'NN195');			
		//Sunday  260%
		$this->lv025=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'N7260')+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'NS260');
		//PH  300%
		$this->lv026=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'HP300');
		//Meal
		$this->lv027=(int)$vArrEmp["$vEmployeeID"][0]['tiencoman']+$vArrEmp["$vEmployeeID"][0]['tiencomtcan']+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'Meal');
		//Petrol
		$this->lv028=$heso+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'Petrol');	
		$vdaydiv=22;
		switch($this->mohr_lv0038->lv011)
		{
			case 0:	$vdaydiv=26;
			break;
			case 1:
				if(count($this->vArrDay)==0)		
					$vdaydiv=22;
				else
					$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				$vdaydiv=22;	
				
			break;
			case 2: $vdaydiv=30;
			break;
		}
		echo "</br>số ngày làm việc:".$vdaydiv."</br>";
		//NightShift Allowance
		$this->lv029=$this->mohr_lv0020->lv005;//($this->lv012/$vdaydiv)*0.3*$this->lv019;
		//Mixing Operator allowance
		$this->lv030=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'MO');
		//Attendance
		$this->lv031=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'LUCKYMONEY'");
		//OT level apply for QC 
		$this->lv032=0;
		//Inflation allowance 
		$this->lv033=0;
		//Opretor 
		$this->lv034=$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'OP');
		
		//Actual month salary 
		$this->lv035=($this->lv012/$vdaydiv)*($this->lv013+$this->lv014+$this->lv015+$this->lv016+$this->lv017+$this->lv018+$this->lv019);
		//OverTime Normal
		$this->lv036=$this->GetNightShiftPrice($vObjCal->lv001,$vEmployeeID,'NN150')+$this->GetNightShiftPrice($vObjCal->lv001,$vEmployeeID,'N7150');			
		if($this->lv036==0)	$this->lv036=($this->lv012/$vdaydiv/(($this->mohr_lv0038->lv007==0)?1:$this->mohr_lv0038->lv007))*1.5*$this->lv022;
		//OverTime RH
		$this->lv037=($this->lv012/$vdaydiv/$this->mohr_lv0038->lv007)*2*$this->lv023;
		//OverTime Night shift day
		$this->lv038=($this->lv012/$vdaydiv/$this->mohr_lv0038->lv007)*1.95*$this->lv024;
		//OverTime Night shift day(Sunday)
		$this->lv039=($this->lv012/$vdaydiv/$this->mohr_lv0038->lv007)*2.6*$this->lv025;
		//OverTime PH
		$this->lv040=($this->lv012/$vdaydiv/$this->mohr_lv0038->lv007)*3*$this->lv026;
		
		//Allowances Petrol
		if($this->mohr_lv0038->lv016==1)
		{
		//Allowances Meal
			if($this->ArrPriceItem['Meal']==NULL || $this->ArrPriceItem['Meal']=="") $this->ArrPriceItem['Meal']=$this->LV_GetPriceProduct($vObjCal->lv001,'Meal');
			$this->lv041=$this->ArrPriceItem['Meal']*($this->lv018+$this->lv019+$this->lv027);
			
			if($this->ArrPriceItem['Transport']==NULL || $this->ArrPriceItem['Transport']=="") $this->ArrPriceItem['Transport']=$this->LV_GetPriceProduct($vObjCal->lv001,'Transport');
			$this->lv042=$this->ArrPriceItem['Transport']*($this->lv018+$this->lv019+$this->lv028);
		}
		else
		{
			//Allowances Meal
			if($this->ArrPriceItem['Meal']==NULL || $this->ArrPriceItem['Meal']=="") $this->ArrPriceItem['Meal']=$this->LV_GetPriceProduct($vObjCal->lv001,'Meal');
			$this->lv041=$this->ArrPriceItem['Meal']*($this->lv027);
			if($this->ArrPriceItem['Transport']==NULL || $this->ArrPriceItem['Transport']=="") $this->ArrPriceItem['Transport']=$this->LV_GetPriceProduct($vObjCal->lv001,'Transport');
			$this->lv042=$this->ArrPriceItem['Transport']*($this->lv028);
		}
		//Night shift allowance
		$this->lv043=($this->lv012/$vdaydiv)*0.3*$this->lv019;
		//Night shift allowance
		if($this->ArrPriceItem['MixingO']==NULL || $this->ArrPriceItem['MixingO']=="") $this->ArrPriceItem['MixingO']=$this->LV_GetPriceProduct($vObjCal->lv001,'MixingO');
		$this->lv044= $this->ArrPriceItem['MixingO']*$this->lv030;
		//Attendance 200.0000
		if($this->ArrPriceItem['Attendance']==NULL || $this->ArrPriceItem['Attendance']=="") $this->ArrPriceItem['Attendance']=$this->LV_GetPriceProduct($vObjCal->lv001,'Attendance');
		if(($this->lv013+$this->lv014+$this->lv015+$this->lv016+$this->lv017+$this->lv018+$this->lv019)>=$vdaydiv)
		{
			$this->lv045= $this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'ATTENDANCE'")+$this->mohr_lv0038->lv018;
		}
		else
			$this->lv045= $this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'ATTENDANCE'")+($this->mohr_lv0038->lv018/$vdaydiv)*($this->lv018+$this->lv019);
		
		//$this->lv045= $this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'ATTENDANCE'")+(($this->lv013+$this->lv014+$this->lv015+$this->lv016+$this->lv017+$this->lv018+$this->lv019)>=$vdaydiv)?$this->mohr_lv0038->lv018:$this->mohr_lv0038->lv018/$vdaydiv*($this->lv018+$this->lv019);
		// OT Level apply for QC
		if($vTypeCalculate==2)
		{
			if($this->mohr_lv0038->lv013==700000)
				$this->lv046=25000*($this->lv022+$this->lv023+$this->lv024+$this->lv025+$this->lv026);
			elseif($this->mohr_lv0038->lv013==600000)
				$this->lv046=20000*($this->lv022+$this->lv023+$this->lv024+$this->lv025+$this->lv026);
			elseif($this->mohr_lv0038->lv013==500000)
				$this->lv046=15000*($this->lv022+$this->lv023+$this->lv024+$this->lv025+$this->lv026);
			else
				$this->lv046=10000*($this->lv022+$this->lv023+$this->lv024+$this->lv025+$this->lv026);				
		}
		else
			$this->lv046=0;
		//Inflation allowance 
		$this->lv047=$this->mohr_lv0038->lv020+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'INFLATION'");
		//Opretor 
		if($this->ArrPriceItem['Opretor']==NULL || $this->ArrPriceItem['Opretor']=="") $this->ArrPriceItem['Opretor']=$this->LV_GetPriceProduct($vObjCal->lv001,'Opretor');
		$this->lv048= $this->ArrPriceItem['Opretor']*$this->lv034;
		//Position Free
		$this->lv049=$this->mohr_lv0038->lv013;
		//Leader
		$this->lv050=$this->mohr_lv0038->lv014;
		//
		if($this->mohr_lv0038->lv012==3)
		{
			echo $vCongThuc=$this->LV_SPIForSale($vEmployeeID,$vObjCal->lv001,$vrate);
			echo $this->lv051=$this->LV_SPIForSaleRun($vCongThuc)+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'SPI'");
			echo "<br/>";
		}
		else		
		$this->lv051=0;
		if($vPetrol!="")
		{
			$ArrPetrol=$this->Get_PetrolParkingMobil($vObjCal->lv001,$vEmployeeID,$vPetrol,$vdaydiv,$vArrEmp);
			//Phụ cấp tiền xăng
			$this->lv052=$ArrPetrol[0]+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PETROL'");
			//Parking fee
			$this->lv054=$ArrPetrol[1]+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PARKING'");
			//Mobie phone
			$this->lv053=$ArrPetrol[2]+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'MOBIE'");
		}
		else
		{
			//Phụ cấp tiền xăng
			$this->lv052=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PETROL'");
			//Mobie phone
			$this->lv053=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'MOBIE'");
			//Parking fee
			$this->lv054=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PARKING'");
		}
		//Traveling allowance
		$this->lv055=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TRAVELING'");
		//Portal allowance
		$this->lv056=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PORTAL'");
		//Slry reimbursement
		$this->lv057=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'SALARY-RE'");
		//Resignation Allowance
		$this->lv058=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'RE-ALLOW'");
		//Allowance
		$this->lv059=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'ALLOWANCE'");
		//13th salary 
		if($vObjCal->lv021==1)	
			$this->lv060=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'SALARY13TH'")+$this->GetSalary13TH($vObjCal,$this->mohr_lv0020->lv030,$this->lv006);
		else
			$this->lv060=0;
		//Total
		$this->lv061=$this->lv031+$this->lv035+$this->lv036+$this->lv037+$this->lv038+$this->lv039+$this->lv040+$this->lv041+$this->lv042+$this->lv043+$this->lv044+$this->lv045+$this->lv046+$this->lv047+$this->lv048+$this->lv049+$this->lv050+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv056+$this->lv057+$this->lv058+$this->lv059+$this->lv060;
		//Ứng Half Month
		$this->lv062=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'HALFMONTH'");
		//Ứng other DEDUCTION
		$this->lv063=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'DEDUCTION'");
		//Union Free
		if($this->ArrPriceItem['Unionfee']==NULL || $this->ArrPriceItem['Unionfee']=="") $this->ArrPriceItem['Unionfee']=$this->LV_GetPriceProduct($vObjCal->lv001,'Unionfee');
		if($this->mohr_lv0038->lv015==1) $this->lv068=$this->ArrPriceItem['Unionfee'];
		else
			$this->lv068=0;
		
		//Bacsic Salary
		$this->lv071=$this->lv006;
		
		//Private mức đóng thuế
		$this->lv080=$vObjCal->lv015;
		/// Family-Per
		$this->lv081=$this->mohr_lv0020->lv049;
		// Family-amt
		$this->lv082=$vObjCal->lv023*$this->lv081;
		//Meal
		$this->lv085=$this->lv041;
	/*	//Cộng/trừ
		$this->lv030=$this->lv058+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'CONGTRU'")-$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'CONGTRU'");
	*/
		//Salary income 
		$this->lv079=$this->lv061+$this->LV_GetAmountTypeCalID($this->lv002,$this->lv098,1,'lv061');
		//Payable
		//Meal
		$this->lv085=$this->lv041;
		if($this->mohr_lv0038->lv017==0)
			{
				if((int)$vContractTypeID==1 || (int)$vContractTypeID==3)
				{
					$this->lv064=(float)$vObjCal->lv012*$this->lv006/100;
					$this->lv065=(float)$vObjCal->lv013*$this->lv006/100;
					$this->lv066=(float)$vObjCal->lv014*$this->lv006/100;
				}
				else
				{
					$this->lv064=0;
					$this->lv065=0;
					$this->lv066=0;
				}
			}
		if($this->mohr_lv0038->lv017!=3)
		{
			//SI
			$this->lv084=$this->lv072+$this->lv073+$this->lv074;
		}
		else
		{
			//SI
			$this->lv084=$this->lv064+$this->lv065+$this->lv066;
		}
		//SI
			$this->lv084=$this->lv064+$this->lv065+$this->lv066;
		$this->lv086=$this->lv079-(float)$vObjCal->lv015-$this->lv082-$this->lv083-$this->lv084-$this->lv085-$this->LV_GetAmountTypeCalID($this->lv002,$this->lv098,1,'lv082')-$this->LV_GetAmountTypeCalID($this->lv002,$this->lv098,1,'lv083')-$this->LV_GetAmountTypeCalID($this->lv002,$this->lv098,1,'lv084')-$this->LV_GetAmountTypeCalID($this->lv002,$this->lv098,1,'lv085');
		if($this->lv086>0)
		{
			if($this->mohr_lv0038->lv017==1)
			{
				$vCongThuc=str_replace("[Payable]",$this->lv086,$vObjCal->lv025);
				$this->lv087=$this->LV_SPIForSaleRun($vCongThuc);
				$this->lv088=$this->GetTax($this->lv087);
				///PIT				
				$this->lv067=0;
			}
			else
			{
				$this->lv087=$this->lv086;
				$this->lv088=$this->GetTax($this->lv087);
				////PIT
				$this->lv067=$this->lv088;
			}
				
				$this->lv089=$this->lv079;
			//Gross salary
			
		}
		else
		{
			//$this->lv086=0;
			if($this->mohr_lv0038->lv017==1)
			{
				$vCongThuc=str_replace("[Payable]",$this->lv086,$vObjCal->lv025);
				$this->lv087=$this->LV_SPIForSaleRun($vCongThuc);
			}
			else
				$this->lv087=$this->lv086;
			$this->lv088=0; 
			$this->lv089=0;
			$this->lv067=0;
		}
		$this->lv067=$this->lv067+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PIT'");
		//Remaining Amount 
		$this->lv069=$this->lv061-$this->lv062-$this->lv063-$this->lv064-$this->lv065-$this->lv066-$this->lv068-$this->lv067;
		//Round
			$this->lv070=round($this->lv069,0);
		
		if($this->mohr_lv0038->lv019==1)
		{
			//Employee's charge
			$this->lv091=$this->lv064+$this->lv065+$this->lv066+$this->lv067+$this->lv068;//+$this->lv063;
			//Employer's charge
			$this->lv090=$this->lv088+$this->lv078+$this->lv061;
		}
		else
		{
			//Employee's charge
			$this->lv091=$this->lv064+$this->lv065+$this->lv066+$this->lv067+$this->lv068;//+$this->lv063;
			//Employer's charge
			$this->lv090=$this->lv075+$this->lv076+$this->lv077+$this->lv061;
		}
		$this->lv095=$this->mohr_lv0038->lv012;
		//Department
		$this->lv096=$vDepartmentID;
		//BankACount
		$this->lv099=$this->mohr_lv0020->lv014;
		//
		$this->lv007=$vEmployeeID;
		$this->lv001=$this->CheckExist($vObjCal->lv001,$vEmployeeID,0);
		if($this->lv001==-1)
		{
			$this->LV_Insert();
		}
		else
			$this->LV_Update();
		
		//$this->GetSalaryhours($vCalculateTimesID,$vEmployeeID,$this->lv022,$vObjCal->lv004,$vObjCal->lv005,$vObjCal->lv007,$vObjCal->lv006);
		
			
		
	}
	
	function Get_PercentTimecode($CalculateID,$TimeCode)
	{
		$lvsql="select lv004 from tc_lv0014 where lv002='$CalculateID' and lv003='$TimeCode'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv004']>0)
			{
			 return $vrow['lv004'];
			}
		}
		return 0;
	}
	function GetTime($vTime)
	{
			$vHours=substr($vTime,0,2) ;
			$vMinutes=substr($vTime,3,2);
			$vSecond=substr($vTime,6,2);
			$vMinutes=(int)($vSecond/60)+$vMinutes;
			$vSecond=$vSecond%60;
			$vHours=$vHours+(int)($vMinutes/60)+(($vMinutes%60)/60);	
			return $vHours;
	}

	function CheckExist($vCalculateTimesID,$vEmployeeID,$vPreCal)
	{
		
		$lvsql="select lv001 from  tc_lv0021 Where lv002='$vEmployeeID' and lv098='$vCalculateTimesID' and lv032='$vPreCal'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['lv001'];		
		}
		return -1;
	}
	function GetMoneyItem($vCalculateTimesID,$vEmployeeID)
	{
		$lvsql="select sum(A.lv006*(IF(ISNULL(B.lv004*D.lv003),0,B.lv004*D.lv003))*(IF(ISNULL(C.lv004),0,C.lv004)/100)) sumqty from  tc_lv0026 A left join tc_lv0015 B on A.lv005=B.lv003 and B.lv002=A.lv003 left join tc_lv0025 C on A.lv007=C.lv001 left join hr_lv0018 D on B.lv005=D.lv001  Where A.lv002='$vEmployeeID' and A.lv003='$vCalculateTimesID'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['sumqty'];		
		}
		return 0;
	}
	function GetItemTimecard($vCalculateTimesID,$vEmployeeID)
	{
		$lvList='lv001,lv002,lv003,lv004,lv005,lv006,lv007';
		$ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"1","lv005"=>"1","lv006"=>"1","lv007"=>"1");
		$lvOrderList='0,1,2,3,4,5,6';
		if($this->isRpt==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$lvTable="
		<div align=\"center\" class=lv0>".($this->ArrTime1CordPush[0])."</div>
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		<tr class=\"lvlineboldtable\"><td colspan=6>".($this->ArrTime1CordPush[9])."</td><td>@#02</td></tr>
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
		$sqlS="select MP.lv001,MP.lv002,MP.lv003,sum(MP.lv004) lv004,MP.lv005,MP.lv006,sum(MP.lv007) lv007 from (select A.lv005 lv001,D.lv002 lv002,C.lv003 lv003,A.lv006 lv004,C.lv004 lv005,B.lv004*E.lv003 lv006,A.lv006*(IF(ISNULL(B.lv004*E.lv003),0,B.lv004*E.lv003))*(IF(ISNULL(C.lv004),0,C.lv004)/100) lv007 from  tc_lv0026 A left join tc_lv0015 B on A.lv005=B.lv003 and B.lv002=A.lv003 left join tc_lv0025 C on A.lv007=C.lv001 left join sl_lv0007 D on A.lv005=D.lv001 left join  hr_lv0018 E on B.lv005=E.lv001 Where A.lv002='$vEmployeeID' and A.lv003='$vCalculateTimesID') MP group by lv001,lv002,lv003,lv005,lv006";
		$vSumSalary=0;
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrTime1CordPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			 $vSumSalary= $vSumSalary+$vrow['lv006'];
			for($i=0;$i<count($lstArr);$i++)
			{
				
				$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]]),$lvTd);
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
		
		
	}
	function GetQuantityItem($vCalculateTimesID,$vEmployeeID)
	{
		$lvsql="select sum(lv006) sumqty from  tc_lv0026 Where lv002='$vEmployeeID' and lv003='$vCalculateTimesID'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['sumqty'];		
		}
		return 0;
	}
	function GetNightShift($vCalculateTimesID,$vEmployeeID,$vTimeCode)
	{
		$lvsql="select sum(lv004) sumqty from  tc_lv0046 Where lv006='$vEmployeeID' and lv002='$vCalculateTimesID' and lv003='$vTimeCode'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['sumqty'];		
		}
		return 0;
	}
	function GetNightShiftPrice($vCalculateTimesID,$vEmployeeID,$vTimeCode)
	{
		$lvsql="select sum(lv004*lv008) sumqty from  tc_lv0046 Where lv006='$vEmployeeID' and lv002='$vCalculateTimesID' and lv003='$vTimeCode'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['sumqty'];		
		}
		return 0;
	}
	function GetNightShiftNum($vCalculateTimesID,$vEmployeeID,$vTimeCode)
	{
		$lvsql="select count(*) sumqty from  tc_lv0046 Where lv006='$vEmployeeID' and lv002='$vCalculateTimesID' and lv003='$vTimeCode'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['sumqty'];		
		}
		return 0;
	}
	function PreGetSalaryOpt($vEmployeeID,$vOpt,$vHDID)
	{
		$vsql="select sum(A.lv005*B.lv003) TotalMoney from hr_lv0042 A inner join hr_lv0018 B on A.lv006=B.lv001  where A.lv002='$vEmployeeID' and A.lv007='$vOpt' and A.lv003='$vHDID'";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
			return $vrow['TotalMoney'];
		}
		return 0;
	}
	function GetSalaryOpt($vEmployeeID,$vOpt)
	{
		$vsql="select sum(A.lv005*B.lv003) TotalMoney from hr_lv0042 A inner join hr_lv0018 B on A.lv006=B.lv001  where A.lv002='$vEmployeeID' and A.lv007='$vOpt' and A.lv003 in (select BB.lv001 from  hr_lv0038 BB where BB.lv002='$vEmployeeID' and BB.lv009=1)";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
			return $vrow['TotalMoney'];
		}
		return 0;
	}
	function GetSalaryBasic($vEmployeeID,$vBasic)
	{
		$vsql="select sum(lv005*B.lv003) TotalMoney from hr_lv0042 A inner join hr_lv0018 B on A.lv006=B.lv001  where A.lv002='$vEmployeeID' and A.lv004='$vBasic' and A.lv003 in (select BB.lv001 from  hr_lv0038 BB where BB.lv002='$vEmployeeID' and BB.lv009=1)";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow['TotalMoney'];
		}
		return 0;
	}
	function GetExpensive($vEmployeeID,$vCalculateTimesID)
	{
		$vsql="select sum(A.lv005*B.lv003) TotalMoney from tc_lv0017 A inner join hr_lv0018 B on A.lv006=B.lv001 where A.lv002='$vEmployeeID' and A.lv008='1' and A.lv003='$vCalculateTimesID' ";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow['TotalMoney'];
		}
	}
	function GetExpensiveList($vEmployeeID,$vCalculateTimesID,$listCode)
	{
		$vsql="select sum(A.lv005*B.lv003) TotalMoney from tc_lv0017 A inner join hr_lv0018 B on A.lv006=B.lv001 where A.lv002='$vEmployeeID' and A.lv008='1' and A.lv003='$vCalculateTimesID' and A.lv004 in($listCode) ";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow['TotalMoney'];
		}
	}
	function GetCost($vEmployeeID,$vCalculateTimesID)
	{
		$vsql="select sum(lv005*B.lv003) TotalMoney from tc_lv0023 A inner join hr_lv0018 B on A.lv006=B.lv001 where A.lv002='$vEmployeeID' and A.lv008='1' and A.lv003='$vCalculateTimesID'";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow['TotalMoney'];
		}
	}
	function GetCostList($vEmployeeID,$vCalculateTimesID,$listCode)
	{
		$vsql="select sum(lv005*B.lv003) TotalMoney from tc_lv0023 A inner join hr_lv0018 B on A.lv006=B.lv001 where A.lv002='$vEmployeeID' and A.lv008='1' and A.lv003='$vCalculateTimesID' and A.lv004 in($listCode)";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow['TotalMoney'];
		}
	}
	function GetCalculate($vCalculateTimesID,$vField)
	{
		$vsql="select $vField from tc_lv0013 where lv001='$vCalculateTimesID' ";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow["$vField"];
		}
	}
	function GetContract($vEmployeeID,$vField)
	{
		$vsql="select $vField from hr_lv0038 where lv002='$vEmployeeID' and lv009=1";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		   return $vrow["$vField"];
		}
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
	function GetBuilCalendar($vEmployeeID,$vField)
	{
		$vsql="select $vField from tc_lv0010 where lv002='$vEmployeeID'";
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
	//Used sql server
	function Gethours_Old($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100),0,IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select A.lv001,A.lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003=A.lv001) PerCent,(select sum(left(A1.lv005,2))+sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A ) PM) SM;";
	$vresult=db_query($vsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			return $vrow['SumHours'];
		}	
		else
			return 0;
	}
	//Used mysql server	
	function Gethours($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select * from tc_lv0002";
		$vresult=db_query($vsql);
		if($vresult)
		{
			$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (";
			$strTemp="";																								
			while($vrow=db_fetch_array($vresult))
			{
				if($strTemp=="")
				$strTemp=" select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100),0,IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv005,2))+sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond  ) PM";
				else
				 $strTemp=$strTemp." Union select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100),0,IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv005,2))+sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond  ) PM";
				
			}
		$vsql=$vsql.$strTemp.") SM;";
		$vresult1=db_query($vsql);
		if($vresult1)
		{
			$vrow1=db_fetch_array($vresult1);
			return $vrow1['SumHours'];
		}	
		else
			return 0;			
		}
		return 0;
	}
	function GethoursPN($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select count(*) SumHours  from tc_lv0011 A1 where  A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004' and A1.lv007='PN' and A1.lv002 in (".$calendar.")";
	$vresult=db_query($vsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			return $vrow['SumHours'];
		}	
		else
			return 0;
	}
	//Used sql server
	function GetAllhours_Old($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100),0,IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select A.lv001,A.lv004,100 PerCent,(select sum(left(A1.lv005,2)) +sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A ) PM) SM;";
	$vresult=db_query($vsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			return $vrow['SumHours'];
		}	
		else
			return 0;	
	}
	//Used MySql
	function GetAllhours($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select * from tc_lv0002";
		$vresult=db_query($vsql);
		if($vresult)
		{
			$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (";
			$strTemp="";																								
			while($vrow=db_fetch_array($vresult))
			{
				if($strTemp=="")
				$strTemp=" select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100),0,IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv001']."' lv004,100 PerCent,(select sum(left(A1.lv005,2)) +sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond  ) PM ";
				else
				 $strTemp=$strTemp." Union  select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100),0,IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,100 PerCent,(select sum(left(A1.lv005,2)) +sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond ) PM";
			}
		$vsql=$vsql.$strTemp.") SM;";
		$vresult1=db_query($vsql);
		if($vresult1)
		{
			$vrow1=db_fetch_array($vresult1);
			return $vrow1['SumHours'];
		}	
		else
			return 0;			
		}	
		return 0;		
	}
	function GetTimeCodehours($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vTimeCode)
	{
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		if($calendar=="") $calendar="''";
		$lvList='lv001,lv002,lv003,lv004,lv005,lv006';
		$ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"1","lv004"=>"1","lv005"=>"1","lv006"=>"1");
		$lvOrderList='0,1,2,3,4,5,6';
		if($this->isRpt==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$lvTable="
		<div align=\"center\" class=lv0>".($this->ArrTimeCordPush[0])."</div>
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		<tr class=\"lvlineboldtable\"><td colspan=5 >".($this->ArrTimeCordPush[8])."</td><td>@#02</td></tr>
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
		 $sqlS="select VM.lv001,C.lv002 lv002,VM.lv003,VM.lv005,sum(VM.lv004) lv004,sum(VM.lv006) lv006 from(select PM.lv001 lv001,PM.PerCent lv003,(IF(ISNULL(PM.SumHour/100),0,PM.SumHour)) lv004,$vSalaryPerHours lv005, $vSalaryPerHours*(IF(ISNULL(PM.SumHour/100),0,PM.SumHour))*PM.PerCent/100 lv006 from (select A.lv001,A.lv002,A.lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003=A.lv001) PerCent,(select sum(left(A1.lv005,2))+sum(substr(A1.lv005,4,5))/60 from tc_lv0011 A1 where A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A where A.lv004!='1') PM
		UNION
		 select PM.lv001 lv001,PM.PerCent lv003,(IF(ISNULL(PM.SumHour/100),0,PM.SumHour) ) lv004,$vSalaryPerHours lv005, $vSalaryPerHours*(IF(ISNULL(PM.SumHour/100),0,PM.SumHour))*PM.PerCent/100 lv006 from (select A.lv001,A.lv002,A.lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003=A.lv001) PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A where A.lv004='1') PM
		 UNION
		 select PM.lv001 lv001	,PM.PerCent lv003,(IF(ISNULL(PM.SumHour/100),0,PM.SumHour) ) lv004,$vSalaryPerHours lv005, $vSalaryPerHours*(IF(ISNULL(PM.SumHour/100),0,PM.SumHour))*PM.PerCent/100 lv006 from (select '$vTimeCode' lv001,A.lv002,A.lv004,100 PerCent,(select sum(left(A1.lv005,2))+sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A where A.lv004='1') PM) VM left join tc_lv0002 C on VM.lv001=C.lv001   GROUP BY lv001,lv003,lv005;";
		 $vSumSalary=0;
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		if($bResult ) {
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strH = "";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrTimeCordPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			 $vSumSalary= $vSumSalary+$vrow['lv006'];
			for($i=0;$i<count($lstArr);$i++)
			{
				
				$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]]),$lvTd);
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01", $strTrH . ($strTr ?? ""), $lvTable);
	}
	function GetOverHours_Old($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(PM.PerCent*PM.SumHour/100),0,PM.PerCent*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select A.lv001,A.lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003=A.lv001) PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A  where A.lv004='$vopt') PM) SM;";
		$vresult=db_query($vsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			return $vrow['SumHours'];
		}	
		else
			return 0;
	}	
	function GetOverHours($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select * from tc_lv0002 where lv004='$vopt'";
		$vresult=db_query($vsql);
		if($vresult)
		{
			$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (";
			$strTemp="";																								
			while($vrow=db_fetch_array($vresult))
			{
				if($strTemp=="")
				$strTemp=" select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(PM.PerCent*PM.SumHour/100),0,PM.PerCent*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond ) PM ";
			else
				 $strTemp=$strTemp." Union  select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(PM.PerCent*PM.SumHour/100),0,PM.PerCent*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond ) PM ";
			}
		$vsql=$vsql.$strTemp.") SM;";
		$vresult1=db_query($vsql);
		if($vresult1)
		{
			$vrow1=db_fetch_array($vresult1);
			return $vrow1['SumHours'];
		}	
		else
			return 0;
			
		}	
		
		
	}
	
	function GetAllOverHours($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select * from tc_lv0002 where lv004='$vopt'";
		$vresult=db_query($vsql);
		if($vresult)
		{
			$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (";
			$strTemp="";																								
			while($vrow=db_fetch_array($vresult))
			{
				if($strTemp=="")
				$strTemp=" select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(PM.PerCent*PM.SumHour/100),0,PM.PerCent*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,100 PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond ) PM ";
			else
				 $strTemp=$strTemp." Union  select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(PM.PerCent*PM.SumHour/100),0,PM.PerCent*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,100 PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond ) PM ";
			}
		$vsql=$vsql.$strTemp.") SM;";
		$vresult1=db_query($vsql);
		if($vresult1)
		{
			$vrow1=db_fetch_array($vresult1);
			return $vrow1['SumHours'];
		}	
		else
			return 0;
		}
		return 0;
	}
	function GetAllOverHours_Old($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(PM.PerCent*PM.SumHour/100),0,PM.PerCent*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select A.lv001,A.lv004,100 PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A  where A.lv004='$vopt') PM) SM;";
	$vresult=db_query($vsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			return $vrow['SumHours'];
		}	
		else
			return 0;
		
		
	}
	function GetTax($vSalaray)//Get percent of tax
	{
		$vReturn=0;
		$i=0;
		$vFrom[0]=0;
		$vTo[0]=0;		
		$vPerCal[0]=0;
		$vsql="select * from  tc_lv0005 A where A.lv002<$vSalaray Order by lv004 ";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			$vFrom[$i]=$vrow['lv002'];
			$vTo[$i]=$vrow['lv003'];
			$vPerCal[$i]=$vrow['lv004'];
			$i=$i+1;			
			
		}				
		for($j=0;$j<$i;$j++)
		{
			if($j==$i-1)
			{
				$vReturn=$vReturn+($vSalaray-$vFrom[$j])*$vPerCal[$j]/100;		
			}
			else
			{
				$vReturn=$vReturn+($vTo[$j]-$vFrom[$j])*$vPerCal[$j]/100;		
			}
		}
		return $vReturn;
	}	
}
?>