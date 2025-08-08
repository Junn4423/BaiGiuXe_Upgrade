<?php
class lv_lv0006{
	//Declare variant
	var $lv001=null;
	var $lv002=null;

	//Variant control
	var $isExist=null;

	function lv_lv0006(){
		$this->isExist=-1;
	}

	function Load($vID){
		$vsql="SELECT * FROM lv_lv0006 WHERE ID='$vID' ;";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow){
			$this->ID=$vrow['ID'];
			$this->lv002=$vrow['lv002'];
		} else {
			$this->ID=null;
			$this->lv002=null;
		}
	}

	function Insert(){
		$vsql="INSERT INTO lv_lv0006(lv001, `lv002`) VALUES ('$this->lv001', '$this->lv002') ;";
		return db_query($vsql);
	}

	function Update(){
		$vsql="UPDATE lv_lv0006 SET lv_lv0006.lv002='$this->lv002' WHERE lv001='$this->lv001' ;";
		return db_query($vsql);		
	}

	function Delete($strar){
		$sqlD = "DELETE FROM lv_lv0006 WHERE lv001 IN (".$strar.") AND (SELECT COUNT(*) FROM rightcontroldetail rcd where rcd.RightControlID=lv_lv0006.lv001)<=0;";
		return db_query($sqlD);
	}

//Kiem tra ton tai
	function Exist($vID){
		$vsql="SELECT lv001 FROM lv_lv0006 WHERE lv001='".$vID."'";
		$vresult=db_query($vsql);
		$this->isExist=db_num_rows($vresult);
		return $this->isExist;
	}
	function CheckUser($vUserID,$vRightID,$vRightControlID)
	{
		$vsql="SELECT A.ID FROM rightcontroldetail  A WHERE A.RightDetailID in (select B.ID from rightdetail B where B.UserID='$vUserID' and B.RightID='$vRightID') and A.RightControlID='$vRightControlID' ";
		$vresult=db_query($vsql);
		return db_num_rows($vresult);
	}
}
?>