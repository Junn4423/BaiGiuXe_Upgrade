<?php
class lv_connectdsn
{
///init variant///////////////////
var $ID=null;
var $Name=null;
var $DepartmentID=null;
var $DSN=null;
var $UserDSN=null;
var $PwdDSN=null;
var $CategoryConnectID=null;
var $Owner=null;
var $LCDatabase=null;
var $LCOpt=null;
////////init control variant//////////////
var $isExist=null;
	function lv_connectdsn()
	{
		$this->isExist=null;
	}
	function Load($vID)
	{
		$vsql="select * from lv_connectdsn where ID='$vID'";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->ID=$vrow['ID'];
			$this->Name=$vrow['Name'];			
			$this->DepartmentID=$vrow['DepartmentID'];
			$this->DSN=$vrow['DSN'];		
			$this->UserDSN=$vrow['UserDSN'];													
			$this->PwdDSN=$vrow['PwdDSN'];
			$this->CategoryConnectID=$vrow['CategoryConnectID'];
			$this->Owner=$vrow['Owner'];
			$this->LCDatabase=$vrow['LCDatabase'];
			$this->LCOpt=$vrow['LCOpt'];
		}
		else
		{
			$this->ID=null;
			$this->Name=null;			
			$this->DepartmentID=null;
			$this->DSN=null;			
			$this->UserDSN=null;					
			$this->PwdDSN=null;
			$this->CategoryConnectID=null;
			$this->Owner=null;
			$this->LCDatabase=null;
			$this->LCOpt=null;
		}
	}
	function Insert()
	{
		 $vsql="insert into lv_connectdsn(ID,Name,DepartmentID,DSN,PwdDSN,UserDSN,CategoryConnectID,Owner,LCDatabase,LCOpt) values('$this->ID','$this->Name','$this->DepartmentID','$this->DSN','$this->PwdDSN','$this->UserDSN','$this->CategoryConnectID','$this->Owner','$this->LCDatabase','$this->LCOpt')";
		db_query($vsql);
		
	}
	function update()
	{
		$vsql="update lv_connectdsn set Name='$this->Name',DepartmentID='$this->DepartmentID',DSN='$this->DSN',UserDSN='$this->UserDSN',PwdDSN='$this->PwdDSN',CategoryConnectID='$this->CategoryConnectID',Owner='$this->Owner',LCDatabase='$this->LCDatabase',LCOpt='$this->LCOpt' where ID='$this->ID'";
		return db_query($vsql);
	}
	function Delete($strar)
	{
		  $sqlD = "DELETE FROM lv_connectdsn  WHERE lv_connectdsn.ID IN ($strar) ";
		return db_query($sqlD);
		
	}	
	function Count()
	{
		$vsql="select count(*) as nums from lv_connectdsn ";	
		$vrow= (db_fetch_array(db_query($vsql)));
		return $vrow['nums'];
	}	
	//Hàm kiểm tra vải mẫu có tồn tại không
	function Exist($vConnectID)
	{
		$vsql="select ID from lv_connectdsn where ID='".$vConnectID."'";
		$vresult=db_query($vsql);
		$this->isExist=db_num_rows($vresult);
		return $this->isExist;
	}
	function CreateFrame($vArrLang)
	{
	 	$vstrReturn="<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"100%\" align=\"center\" >
                                      <tr>
                                        <td width=\"20%\" >$vArrLang[20]:</td>
                                        <td ><b>$this->ID</b></td>
                                        <td width=\"15%\" >$vArrLang[28]:</td>
                                        <td  width=\"15%\" align=\"right\">$this->Name</td>
                                      </tr>
                                      <tr>
                                        <td >$vArrLang[21]:</td>
                                        <td >$this->DSN</td>
                                        <td >$vArrLang[22]:</td>
                                        <td  align=\"right\">$this->UserDSN</td>
                                      </tr>
                                      <tr>
                                        <td >$vArrLang[33]:</td>
                                        <td >$this->CategoryConnectID</td>
                                        <td >$vArrLang[29]:</td>
                                        <td  align=\"right\">".$vArrLang[30+$this->LCOpt]."</td>
                                      </tr>									  
                                      <tr>
                                        <td >$vArrLang[24]:</td>
                                        <td >$this->Owner</td>
                                        <td >$vArrLang[27]:</td>
                                        <td  align=\"right\">$this->DepartmentID</td>										
                                      </tr>
                                    </table>";
	return $vstrReturn;
									
	}	
	
}
?>
