<?php
class lv_lv0005{
	//Declare variant
	var $lv001=null;
	var $lv002=null;
	var $lv003=null;
	var $lv004=null;
	var $lv005=null;
	var $lv006=null;	
	var $lv007=null;
	//Variant lv005
	var $isExist=null;

	function lv_lv0005(){
		$this->isExist=-1;
	}

	function LV_LoadID($vlv001){
		$vsql="SELECT * FROM lv_lv0005 WHERE lv001='$vlv001' ;";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow){
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
		} else {
			$this->lv001=null;
			$this->lv002=null;
			$this->lv003=null;
			$this->lv004=null;
			$this->lv005=null;
			$this->lv006=null;
			$this->lv007=null;
		}
	}
	function LV_LoadUser($vlv002,$vlv003){
		$vsql="SELECT * FROM lv_lv0005 WHERE lv002='$vlv002' and lv003='$vlv003' ;";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow){
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
		} else {
			$this->lv001=null;
			$this->lv002=null;
			$this->lv003=null;
			$this->lv004=null;
			$this->lv005=null;
			$this->lv006=null;
			$this->lv007=null;
		}
	}
	function Insert(){
		if(trim($this->lv006)==trim($this->lv001))
			$this->lv007=0;
		else
			$this->lv007=1+$this->GetCount($this->lv006);
		$vsql="INSERT INTO lv_lv0005(lv001, lv002, `lv003`, lv004, lv005, lv006,lv007) VALUES ('$this->lv001', '$this->lv002', '$this->lv003', '$this->lv004', '$this->lv005', '$this->lv006','$this->lv007') ;";
		return db_query($vsql);
	}

	function Update(){
		if(trim($this->lv006)==trim($this->lv001))
			$this->lv007=0;
		else
			$this->lv007=1+$this->GetCount($this->lv006);
		$vsql="UPDATE lv_lv0005 SET lv002='$this->lv002', `lv003`='$this->lv003', lv004='$this->lv004', lv005='$this->lv005', lv006='$this->lv006',lv007='$this->lv007' WHERE lv001='$this->lv001' LIMIT 1;";
		return db_query($vsql);		
	}

	function Delete($strar){
		$sqlD = "DELETE FROM lv_lv0005 WHERE lv001 IN (".$strar.") AND ( SELECT COUNT(*) FROM rightdetail rd where rd.Right=lv_lv0005.lv001 )<=0 ;";
		return db_query($sqlD);
	}

//Kiem tra ton tai
	function Exist($vlv001){
		$vsql="SELECT lv001 FROM lv_lv0005 WHERE lv001='".$vlv001."' ;";
		$vresult=db_query($vsql);
		$this->isExist=db_num_rows($vresult);
		return $this->isExist;
	}

///*-----------------------------------Begin lv005 Add lv_lv0005---------------------------------*///
	function ControlAddRight($vUserID, $vRightID, $vRightControlID){
		$vRightDetailID = $this->addRightDetail($vUserID, $vRightID);
		$this->addData($vRightControlID, $vRightDetailID, 2);
	}
	function DeleteRightUser($vUserID)
	{
			$this->delData($vUserID, 2);// delete data of rightcontroldetail table
		$this->delData($vUserID, 1);// delete data of rightdetail table
	}
	function addRightDetail($vUserID, $vRightID){
		$vTempRightID = $vRightID;
			while(1==1){
				$vlv006 = $vRightID;
				if($this->addData($vUserID, $vlv006, 1)==false) break;
				$vlv006 = $this->getParentRight($vRightID);				
				if($vRightID==$vlv006){
					break;
				} else {
					$vRightID = $vlv006;
				}
			}
		return $this->getRightDetailID($vUserID, $vTempRightID);
	}

	function addData($Value01, $Value02, $Value03){
		//$Value03 == 1: rightdetail;
		//$Value03 == 2: rightcontroldetail;
		$vExist = $this->existData($Value01, $Value02, $Value03);
		if($vExist<=0){
			if((int)$Value03==1){				
				$sqlI = "INSERT INTO rightdetail(UserID, `Right`) VALUES ('$Value01', '$Value02') ;";
			} else if((int)$Value03==2){
				$sqlI = "INSERT INTO rightcontroldetail(RightControlID, RightDetailID, Enable) VALUES ('$Value01', '$Value02', 1) ;";
			}
			return db_query($sqlI);
		} else {
			return false;
		}
	}

	function delData($Value01, $Value02){
		//$Value02 == 1: rightdetail;
		//$Value02 == 2: rightcontroldetail;
		if((int)$Value02==1){
			$sqlD = "DELETE FROM rightdetail WHERE UserID='$Value01' ;";
		} else if((int)$Value02==2){
			$sqlD = "DELETE FROM rightcontroldetail WHERE RightDetailID IN (SELECT ID FROM rightdetail WHERE UserID='$Value01') ;";
		}
		return db_query($sqlD);
	}

	function getParentRight($vRightID){
		$sqlS = "SELECT lv001, lv006 FROM lv_lv0005 WHERE lv001='$vRightID' ;";
		$vResult = db_query($sqlS);
		$arrS = db_fetch_array($vResult);
		if($arrS){
			return $arrS['lv006'];
		} else {
			return NULL;
		}
	}

	function existData($Value01, $Value02, $Value03){
		//$Value03 == 1: rightdetail;
		//$Value03 == 2: rightcontroldetail;
		if((int)$Value03==1){
			$sqlS = "SELECT ID FROM rightdetail WHERE UserID='$Value01' AND `Right`='$Value02' ;";
		} else if((int)$Value03==2){
			$sqlS = "SELECT ID FROM rightcontroldetail WHERE RightControlID='$Value01' AND RightDetailID='$Value02' ;";
		}
		$vResult = db_query($sqlS);
		$vExist = db_num_rows($vResult);
		return $vExist;
	}

	function getRightDetailID($vUserID, $vRightID){
		$sqlS = "SELECT ID FROM rightdetail WHERE UserID='$vUserID' AND `Right`='$vRightID' ;";
		$vResult = db_query($sqlS);
		$arrS = db_fetch_array($vResult);
		if($arrS){
			return $arrS['lv001'];
		} else {
			return NULL;
		}
	}
//Load data 	
	function LoadStructs()
	{
		$vsql="select * from lv_lv0005 where lv006!='' order by lv007";
		return db_query($vsql);
	}
//Load Exist child 	
	function CheckChild($vRightID)
	{
		$vsql="select * from lv_lv0005 where lv006='$vRightID' and lv001!='$vRightID' and lv005=0";		
		$tresult=db_query($vsql);
		return db_num_rows($tresult);
	}	
//Lấy số lần đúng mẫu	
	function GetCount($vRightID)
	{
		$vsql="select lv006 from lv_lv0005 where lv001='$vRightID' and lv006!='$vRightID'";
		$tresult=db_query($vsql);
		$vnum=db_num_rows($tresult);
		if($vnum==0)
		{
			return 0;
		}
		else
		{
			$vrow=db_fetch_array($tresult);
			return(1+ $this->GetCount($vrow['lv006']));
		}
	}
///*-----------------------------------End lv005 Add lv_lv0005---------------------------------*///

}
?>