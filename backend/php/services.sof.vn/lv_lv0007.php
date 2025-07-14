 
<?php
class lv_lv0007 extends lv_controler {

	var $lv001=null;
	var $lv002=null;
	var $lv003=null;
	var $lv004=null;
	var $lv005=null;
	var $lv006=null;
	var $lv095=null;
	var $lv099=null;
	var $lv900= null;
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv094,lv095,lv099,lv100";	
	
	
	function LV_Load()
	{
		$vsql="select * from  lv_lv0007";
		$vresult=db_query($vsql);
		return $vresult;
	}
	function LV_LoadID($vlv097)
	{
		$lvsql="select * from  lv_lv0007 Where lv097='$vlv097'";
		$vresult=db_query($lvsql);
		return $vresult;
	}
	function Load($vlv001){
		$vsql="SELECT * FROM lv_lv0007 WHERE lv001='$vlv001' ;";
		$vresult=db_query($vsql);
		return $vresult;
	}

	function LV_Insert(){
		$vsql="INSERT INTO lv_lv0007(lv001, lv003, lv004, lv005, lv006,lv009,lv900) 
		VALUES ('$this->lv001', '$this->lv003', '$this->lv004', '".md5($this->lv005)."', '$this->lv006',CURDATE(),'$this->lv900')";
		$result=db_query($vsql);

		return $result;
	}

	function LV_Update(){
		$hashed_lv005 = md5($this->lv005);
		$vsql = "UPDATE lv_lv0007 SET 
					lv003 = '$this->lv003', 
					lv004 = '$this->lv004', 
					lv005 = '$hashed_lv005', 
					lv006 = '$this->lv006', 
					lv007 = CURDATE(), 
					lv900 = '$this->lv900', 
				WHERE lv001 = '$this->lv001'";
		
		$result = db_query($vsql);
		return $result;		
	}


	
	
}
?>