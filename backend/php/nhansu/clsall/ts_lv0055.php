<?php
class ts_lv0055 extends lv_controler{
public $sophieunhap=null;
public $sophieuxuat=null;
public $sokho=null;
	var $vRowHeader="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>@02</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@03</b></td>
				<td class=\"tdhprint\" width=\"25%\" align=\"center\"><b>@04</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@05</b></td>
				<td class=\"tdhprint\" width=\"*\" align=\"center\"><b>@06</b></td>
			</tr>
		@01
		</table>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	var $vRowHeaderAll="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>@02</b></td>
				<td class=\"tdhprint\" width=\"15%\" align=\"center\"><b>@03</b></td>
				<td class=\"tdhprint\" width=\"*\" align=\"center\"><b>@04</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@05</b></td>
				<td class=\"tdhprint\" width=\"15%\" align=\"center\"><b>@06</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@07</b></td>
			</tr>
		@01
		</table>";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
		$this->isRpt=0;		
	 	$this->isFil=1;	
		$this->img_height=50;
		
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];
		$this->sophieunhap=Array();
		$this->sophieuxuat=Array();
		$this->sokho=$this->GetWH();
		
	}
	function GetWH()
	{
		$sqlC="select count(*) nums from ts_lv0001";
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
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
	function LV_GET_ITEMS_EXIST($vWHID,$strwh)
	{
		$str_return="";
		$vcondtion="";
		if($vWHID!="")
		{
			$vcondtion=" and lv003='$vWHID'";
		}
		else 
		{
			$vcondtion=" and lv003 in ($strwh)";
		}
		$vsql="select distinct lv002 from ts_lv0012 where 1=1 $vcondtion";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($str_return=="")
				$str_return="'".$vrow['lv002']."'";
			else 
				$str_return=$str_return.",'".$vrow['lv002']."'";
		}
		return $str_return;
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function ReportInventoryAdv($plang, $vArrLang, $strInventorylv001, $strTitle, $strWarehouselv001, $strDateCalFrom, $strDateCalTo, $strApproval){
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"htable_hr\" width=\"3%\" >@02</td>
				<td class=\"htable_hr\" width=\"20%\" >@03</td>
				<td class=\"htable_hr\" width=\"*%\" >@04</td>
				<td class=\"htable_hr\" width=\"20%\" >@05</td>
				<td class=\"htable_hr\" width=\"10%\" >@06</td>
				<td class=\"htable_hr\" width=\"10%\" >@07</td>
				<td class=\"htable_hr\" width=\"10%\" >@08</td>				
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_hr\" rowspan=\"@01\" valign=\"top\" >@02</td>
				<td class=\"left_hr\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_hr\" >@04</td>
				<td class=\"left_hr\" >@05</td>
				<td class=\"left_hr\" >@06</td>
				<td class=\"left_hr\" >@07</td>
				<td class=\"left_hr\" >@08</td>
			</tr>";

		$vRowLightText="
			<tr>
				<td class=\"left_hr\" >@04</td>
				<td class=\"left_hr\" >@05</td>
				<td class=\"left_hr\" >@06</td>
				<td class=\"left_hr\" >@07</td>
				<td class=\"left_hr\" >@08</td>				
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01')\" >@01</a>";
		$vCondition = "";
		if($strInventorylv001!="") $vCondition = " AND A.lv001 LIKE '%$strInventorylv001%'";
		if($strTitle!="") $vCondition = $vCondition." AND A.Title LIKE '%$strTitle%'";
		if($strWarehouselv001!="") $vCondition = $vCondition." AND A.Warehouselv001='$strWarehouselv001'";	
		if($strDateCalFrom!="") $vCondition = $vCondition." AND A.DateCal >= '$strDateCalFrom'";
		if($strDateCalTo!="") $vCondition = $vCondition." AND A.DateCal <= '$strDateCalTo'";
		if($strApproval!="") $vCondition = $vCondition." AND A.Approval='$strApproval'";	
	
		$sqlS = "select A.*,B.lv002 Warehouselv002 from wh_inventory A left join  wh_warehouse B on A.Warehouselv001=B.lv001 where 1=1 ".$vCondition." ORDER BY A.DateCal Desc,A.lv001 DESC";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv001']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv001'];
						$vTitle = ($arrS['Title']!="" || $arrS['Title']!=NULL)?$arrS['Title']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03",str_replace("@01",$vtInventorylv001,$Href), $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['Warehouselv002']!="" || $arrS['Warehouselv002']!=NULL)?$arrS['Warehouselv002']:"-", $vLineRun);
				$vLineRun = str_replace("@06", $arrS['Employeelv001'], $vLineRun);
				$vLineRun = str_replace("@07", ($arrS['DateCal']!="" || $arrS['DateCal']!=NULL)?formatdate($arrS['DateCal'],$plang):"-", $vLineRun);
				$vLineRun = str_replace("@08", $arrS['Approval'], $vLineRun);				
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}

		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Order
		$vHeader = str_replace("@02", $vArrLang[6], $vHeader);
		//Inventorylv001
		$vHeader = str_replace("@03", $vArrLang[7], $vHeader);
		//Title
		$vHeader = str_replace("@04", $vArrLang[8], $vHeader);
		//Warehouse
		$vHeader = str_replace("@05",$vArrLang[9], $vHeader);
		//DateCal
		$vHeader = str_replace("@06", $vArrLang[12], $vHeader);
		//Employee
		$vHeader = str_replace("@07", $vArrLang[10], $vHeader);
		//Approval
		$vHeader = str_replace("@08",$vArrLang[11], $vHeader);

		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);
	}	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function ReportReceiptionAdv($plang, $vArrLang, $strReceiptionlv001, $strTitle, $strWarehouselv001, $strlv009From, $strlv009To, $strApproval,$strlv005,$strlv006){
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"htable_hr\" width=\"3%\" >@02</td>
				<td class=\"htable_hr\" width=\"20%\" >@03</td>
				<td class=\"htable_hr\" width=\"*%\" >@04</td>
				<td class=\"htable_hr\" width=\"20%\" >@05</td>
				<td class=\"htable_hr\" width=\"10%\" >@06</td>
				<td class=\"htable_hr\" width=\"10%\" >@07</td>
				<td class=\"htable_hr\" width=\"10%\" >@08</td>				
				<td class=\"htable_hr\" width=\"10%\" >@09</td>								
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_hr\" rowspan=\"@01\" valign=\"top\" >@02</td>
				<td class=\"left_hr\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_hr\" >@04</td>
				<td class=\"left_hr\" >@05</td>
				<td class=\"left_hr\" >@06</td>
				<td class=\"left_hr\" >@07</td>
				<td class=\"left_hr\" >@08</td>
				<td class=\"left_hr\" >@09</td>				
			</tr>";

		$vRowLightText="
			<tr>
				<td class=\"left_hr\" >@04</td>
				<td class=\"left_hr\" >@05</td>
				<td class=\"left_hr\" >@06</td>
				<td class=\"left_hr\" >@07</td>
				<td class=\"left_hr\" >@08</td>				
				<td class=\"left_hr\" >@09</td>								
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01')\" >@01</a>";
		$vCondition = "";
		if($strReceiptionlv001!="") $vCondition = " AND A.lv001 LIKE '%$strReceiptionlv001%'";
		if($strTitle!="") $vCondition = $vCondition." AND A.Title LIKE '%$strTitle%'";
		if($strlv009!="") $vCondition = $vCondition." AND A.lv009 >= '$strlv009From'";
		if($strlv009!="") $vCondition = $vCondition." AND A.lv009 <= '$strlv009To'";
		if($strWarehouselv001!="") $vCondition = $vCondition." AND A.Warehouselv001='$strWarehouselv001'";
		if($strApproval!="") $vCondition = $vCondition." AND A.Approval='$strApproval'";
		if($strlv005!="") $vCondition = $vCondition." AND A.lv005='$strlv005'";	
		if($strlv006!="") $vCondition = $vCondition." AND A.lv006='$strlv006'";			
		
	
		$sqlS = "select A.*,B.lv002 Warehouselv002 from  ts_lv0008 A left join  wh_warehouse B on A.Warehouselv001=B.lv001 where 1=1 ".$vCondition." ORDER BY A.lv009 Desc,A.lv001 DESC";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv001']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv001'];
						$vTitle = ($arrS['Title']!="" || $arrS['Title']!=NULL)?$arrS['Title']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", str_replace("@01",$vtInventorylv001,$Href), $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['Warehouselv002']!="" || $arrS['Warehouselv002']!=NULL)?$arrS['Warehouselv002']:"-", $vLineRun);
				$vLineRun = str_replace("@06", $arrS['Employeelv001'], $vLineRun);
				$vLineRun = str_replace("@07", ($arrS['lv009']!="" || $arrS['lv009']!=NULL)?formatdate($arrS['lv009'],$plang):"-", $vLineRun);
				$vLineRun = str_replace("@08", $arrS['Approval'], $vLineRun);				
				$vLineRun = str_replace("@09", $arrS['lv005'], $vLineRun);								
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}

		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Order
		$vHeader = str_replace("@02", $vArrLang[6], $vHeader);
		//Inventorylv001
		$vHeader = str_replace("@03", $vArrLang[7], $vHeader);
		//Title
		$vHeader = str_replace("@04", $vArrLang[8], $vHeader);
		//Warehouse
		$vHeader = str_replace("@05",$vArrLang[9], $vHeader);
		//DateCal
		$vHeader = str_replace("@06", $vArrLang[12], $vHeader);
		//Employee
		$vHeader = str_replace("@07", $vArrLang[10], $vHeader);
		//Approval
		$vHeader = str_replace("@08",$vArrLang[11], $vHeader);
		//lv005
		$vHeader = str_replace("@09",$vArrLang[13], $vHeader);		

		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);
	}		
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function ReportOutStockAdv($plang, $vArrLang, $strReceiptionlv001, $strTitle, $strWarehouselv001, $strlv009From, $strlv009To, $strApproval,$strlv005,$strlv006){
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"htable_hr\" width=\"3%\" >@02</td>
				<td class=\"htable_hr\" width=\"20%\" >@03</td>
				<td class=\"htable_hr\" width=\"*%\" >@04</td>
				<td class=\"htable_hr\" width=\"20%\" >@05</td>
				<td class=\"htable_hr\" width=\"10%\" >@06</td>
				<td class=\"htable_hr\" width=\"10%\" >@07</td>
				<td class=\"htable_hr\" width=\"10%\" >@08</td>				
				<td class=\"htable_hr\" width=\"10%\" >@09</td>								
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_hr\" rowspan=\"@01\" valign=\"top\" >@02</td>
				<td class=\"left_hr\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_hr\" >@04</td>
				<td class=\"left_hr\" >@05</td>
				<td class=\"left_hr\" >@06</td>
				<td class=\"left_hr\" >@07</td>
				<td class=\"left_hr\" >@08</td>
				<td class=\"left_hr\" >@09</td>				
			</tr>";

		$vRowLightText="
			<tr>
				<td class=\"left_hr\" >@04</td>
				<td class=\"left_hr\" >@05</td>
				<td class=\"left_hr\" >@06</td>
				<td class=\"left_hr\" >@07</td>
				<td class=\"left_hr\" >@08</td>				
				<td class=\"left_hr\" >@09</td>								
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01')\" >@01</a>";
		$vCondition = "";
		if($strReceiptionlv001!="") $vCondition = " AND A.lv001 LIKE '%$strReceiptionlv001%'";
		if($strTitle!="") $vCondition = $vCondition." AND A.Title LIKE '%$strTitle%'";
		if($strlv009!="") $vCondition = $vCondition." AND A.lv009 >= '$strlv009From'";
		if($strlv009!="") $vCondition = $vCondition." AND A.lv009 <= '$strlv009To'";
		if($strWarehouselv001!="") $vCondition = $vCondition." AND A.Warehouselv001='$strWarehouselv001'";
		if($strApproval!="") $vCondition = $vCondition." AND A.Approval='$strApproval'";
		if($strlv005!="") $vCondition = $vCondition." AND A.lv005='$strlv005'";	
		if($strlv006!="") $vCondition = $vCondition." AND A.lv006='$strlv006'";	
	
		$sqlS = "select A.*,B.lv002 Warehouselv002 from  ts_lv0010 A left join  wh_warehouse B on A.Warehouselv001=B.lv001 where 1=1 ".$vCondition." ORDER BY A.lv009 Desc,A.lv001 DESC";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv001']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv001'];
						$vTitle = ($arrS['Title']!="" || $arrS['Title']!=NULL)?$arrS['Title']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", str_replace("@01",$vtInventorylv001,$Href), $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['Warehouselv002']!="" || $arrS['Warehouselv002']!=NULL)?$arrS['Warehouselv002']:"-", $vLineRun);
				$vLineRun = str_replace("@06", $arrS['Employeelv001'], $vLineRun);
				$vLineRun = str_replace("@07", ($arrS['lv009']!="" || $arrS['lv009']!=NULL)?formatdate($arrS['lv009'],$plang):"-", $vLineRun);
				$vLineRun = str_replace("@08", $arrS['Approval'], $vLineRun);				
				$vLineRun = str_replace("@09", $arrS['lv005'], $vLineRun);								
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}

		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Order
		$vHeader = str_replace("@02", $vArrLang[6], $vHeader);
		//Inventorylv001
		$vHeader = str_replace("@03", $vArrLang[7], $vHeader);
		//Title
		$vHeader = str_replace("@04", $vArrLang[8], $vHeader);
		//Warehouse
		$vHeader = str_replace("@05",$vArrLang[9], $vHeader);
		//DateCal
		$vHeader = str_replace("@06", $vArrLang[12], $vHeader);
		//Employee
		$vHeader = str_replace("@07", $vArrLang[10], $vHeader);
		//Approval
		$vHeader = str_replace("@08",$vArrLang[11], $vHeader);
		//lv005
		$vHeader = str_replace("@09",$vArrLang[13], $vHeader);		

		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);
	}			
	function PrintInOutPutInStock($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd)
	{
	if($vDateStart!="") $vDateStart=$vDateStart." 00:00:00";
	if($vDateEnd!="") $vDateEnd=$vDateEnd." 23:59:59";
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"8%\" >@03</td>
				<td class=\"htable\" width=\"*%\" >@04</td>
				<td class=\"htable\" width=\"5%\" >@05</td>
				<td class=\"htable\" width=\"10%\" >@06</td>
				<td class=\"htable\" width=\"10%\" >@07</td>
				<td class=\"htable\" width=\"10%\" >@08</td>				
				<td class=\"htable\" width=\"10%\" >@09</td>
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >@02</td>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"right_style\" >@06</td>
				<td class=\"right_style\" >@07</td>
				<td class=\"right_style\" >@08</td>
				<td class=\"right_style\" >@09</td>				
			</tr>";

		$vRowLightText="
			<tr>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"right_style\" >@06</td>
				<td class=\"right_style\" >@07</td>
				<td class=\"right_style\" >@08</td>				
				<td class=\"right_style\" >@09</td>								
			</tr>";
	
		$sqlS = "select A.*,B.lv002 UnitName,(select sum(A1.lv004) from ts_lv0009 A1 where A1.lv003=A.lv001 and A1.lv002 IN (select A11.lv001 from ts_lv0008 A11 Where A11.lv009<'$vDateStart' and A11.lv002='$vlv001')) ReReceiptQty,(select sum(A1.lv004) from ts_lv0009 A1 where A1.lv003=A.lv001 and A1.lv002 IN (select A11.lv001 from ts_lv0008 A11 Where A11.lv009>='$vDateStart' and A11.lv009<='$vDateEnd' and A11.lv002='$vlv001')) InReceiptQty,(select sum(A2.lv004) from ts_lv0011 A2 where A2.lv003=A.lv001 and A2.lv002 IN (select A21.lv001 from ts_lv0010 A21 Where A21.lv009<'$vDateStart' and A21.lv002='$vlv001')) ReOutlv004 ,(select sum(A2.lv004) from ts_lv0011 A2 where A2.lv003=A.lv001 and A2.lv002 IN (select A21.lv001 from ts_lv0010 A21 Where A21.lv009>='$vDateStart' and A21.lv009<='$vDateEnd' and A21.lv002='$vlv001')) InOutlv004  from sl_lv0007 A left join sl_lv0005 B on A.lv004=B.lv001 where 1=1 and A.lv015=0";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv001']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv001'];
						$vTitle = ($arrS['lv002']!="" || $arrS['lv002']!=NULL)?$arrS['lv002']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", $vtInventorylv001, $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['UnitName']!="" || $arrS['UnitName']!=NULL)?$arrS['UnitName']:"-", $vLineRun);
				$vLineRun = str_replace("@06", Lcurrency($arrS['ReReceiptQty']-$arrS['ReOutlv004'],$plang), $vLineRun);
				$vLineRun = str_replace("@07", LCurrency($arrS['InReceiptQty'],$plang), $vLineRun);
				$vLineRun = str_replace("@08", LCurrency($arrS['InOutlv004'],$plang), $vLineRun);				
				$vLineRun = str_replace("@09", LCurrency( ( $arrS['ReReceiptQty']-$arrS['ReOutlv004'])+( $arrS['InReceiptQty']-$arrS['InOutlv004']),$plang), $vLineRun);								
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}
		$sqlS = "select MP.lv004,MP.UnitName,sum(IF(ISNULL(MP.ReReceiptQty),0,MP.ReReceiptQty)+IF(ISNULL(MP.InReceiptQty),0,MP.InReceiptQty)-IF(ISNULL(MP.ReOutlv004),0,MP.ReOutlv004)-IF(ISNULL(MP.InOutlv004),0,MP.InOutlv004) ) SumQty from (select A.lv004,B.lv002 UnitName,(select sum(A1.lv004) from ts_lv0009 A1 where A1.lv003=A.lv001 and A1.lv002 IN (select A11.lv001 from ts_lv0008 A11 Where A11.lv009<'$vDateStart' and A11.lv002='$vlv001')) ReReceiptQty,(select sum(A1.lv004) from ts_lv0009 A1 where A1.lv003=A.lv001 and A1.lv002 IN (select A11.lv001 from ts_lv0008 A11 Where A11.lv009>='$vDateStart' and A11.lv009<='$vDateEnd' and A11.lv002='$vlv001')) InReceiptQty,(select sum(A2.lv004) from ts_lv0011 A2 where A2.lv003=A.lv001 and A2.lv002 IN (select A21.lv001 from ts_lv0010 A21 Where A21.lv009<'$vDateStart' and A21.lv002='$vlv001')) ReOutlv004 ,(select sum(A2.lv004) from ts_lv0011 A2 where A2.lv003=A.lv001 and A2.lv002 IN (select A21.lv001 from ts_lv0010 A21 Where A21.lv009>='$vDateStart' and A21.lv009<='$vDateEnd' and A21.lv002='$vlv001')) InOutlv004   from sl_lv0007 A left join sl_lv0005 B on A.lv004=B.lv001 where 1=1 and A.lv015=0) MP group by MP.lv004,MP.UnitName ";		
		$strExpportAll=$strExpportAll.$this->SumSQLRun($sqlS,8,$vArrLang[14],$plang);	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Order
		$vHeader = str_replace("@02", $vArrLang[4], $vHeader);
		//lv003
		$vHeader = str_replace("@03", $vArrLang[5], $vHeader);
		//Stock lv002
		$vHeader = str_replace("@04", $vArrLang[6], $vHeader);
		//Unit
		$vHeader = str_replace("@05",$vArrLang[7], $vHeader);
		//Fist
		$vHeader = str_replace("@06", $vArrLang[8], $vHeader);
		//Input Mlv001dle
		$vHeader = str_replace("@07", $vArrLang[9], $vHeader);
		//Output Mlv001dle
		$vHeader = str_replace("@08",$vArrLang[10], $vHeader);
		//Last
		$vHeader = str_replace("@09",$vArrLang[11], $vHeader);		

		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}	
	function GetBuildTableLot($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001,$vVS_Color)
	{
		
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"tblprint\">
			<tr height=\"5px\" class=\"tblRunChild\" >
				<td class=\"htablerun\" width=\"10%\" ></td>
				<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"15%\" >".$vArrLang[24]."</td>
				".((trim($vlv001." ")!="")?"":"<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"15%\" >".$vArrLang[1]."</td>")."
				<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"15%\" >".$vArrLang[29]."</td>
				<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"*%\" >".$vArrLang[22]."</td>
				<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"15%\" >".$vArrLang[53]."</td>
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
				<td  class=\"left_style\" rowspan=\"@01\" valign=\"top\" ></td>
				<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"left_style\" rowspan=\"@01\" valign=\"top\">@02</td>			
				".((trim($vlv001." ")!="")?"":"<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"left_style\" rowspan=\"@01\" valign=\"top\">@06</td>")."			
				<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"right_style\" >@08</td>
				<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"right_style\" >@03</td>
				<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"right_style\" >@04</td>
			</tr>
			";
		if($vVS_Color!="")
		{
			$vAddCond=$vAddCond." AND lv008 like '%$vVS_Color%'";	
		}	
		if($strlv014!="")
		{
			$vAddCond=$vAddCond." AND lv001 like '%$strlv014%'";	
		}	
		if($vlv001!="") 
		{
			$vAddCond=$vAddCond." AND lv003 = '$vlv001'";
		}
		$lvsql="select * from ts_lv0020 where lv002='$vlv003'  $vAddCond order by lv004 desc";
		$strAllTr='';
		$lvResult = db_query($lvsql);
		while($row=db_fetch_array($lvResult)){
				$lvTemp=str_replace("@02",$row['lv001']."&nbsp",$vRowFirst);
				$lvTemp=str_replace("@08",$row['lv008']."&nbsp",$lvTemp);
				$lvTemp=str_replace("@06",$row['lv003']."&nbsp",$lvTemp);
				$lvTemp=str_replace("@03",$this->LV_Get_slt_lot($row['lv001'],$row['lv002'],$row['lv003']),$lvTemp);
				$lvTemp=str_replace("@04",$this->FormatView($row['lv004'],2)."&nbsp",$lvTemp);
				$strAllTr=$strAllTr.$lvTemp;
				}
		if($strAllTr=='') return "";
		return str_replace("@01", $strAllTr, $vHeaderReportInventory);			
	}	
	function LV_Get_slt_lot($vLotId,$vItemId,$vWhId)
	{
		if($this->sokho<=1)
		{
			$vsql="select sum(lv004) sumslnhap from ts_lv0009 A where A.lv003='$vItemId' and A.lv014='$vLotId'";
		}
		else
		{
			if($this->sophieunhap[$vWhId]==NULL) $this->sophieunhap[$vWhId]=$this->get_sophieu($vWhId,0,'lv001');
			$sophieu=$this->sophieunhap[$vWhId];
			if($sophieu=="") $sophieu="''";
			$vsql="select sum(lv004) sumslnhap from ts_lv0009 A where A.lv002 in ($sophieu) and A.lv003='$vItemId' and A.lv014='$vLotId'";
		}
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		$slnhap=$vrow['sumslnhap'];
		if($this->sokho<=1)
		{
			$vsql="select sum(lv004) sumslxuat from ts_lv0011 A where A.lv003='$vItemId' and A.lv014='$vLotId'";
		}
		else
		{
			if($this->sophieuxuat[$vWhId]==NULL) $this->sophieuxuat[$vWhId]=$this->get_sophieu($vWhId,1,'lv001');
			$sophieu=$this->sophieuxuat[$vWhId];
			$vsql="select sum(lv004) sumslxuat from ts_lv0011 A where A.lv002 in ($sophieu) and A.lv003='$vItemId' and A.lv014='$vLotId'";
		}
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		$slxuat=$vrow['sumslxuat'];
		return LCurrency($slnhap-$slxuat,"EN");
	}
	function get_sophieu($vWhId,$vopt,$vField)
	{
		if($vopt==0)
			$vsql="select $vField from ts_lv0008 where lv002='$vWhId'";
		else
			$vsql="select $vField from ts_lv0010 where lv002='$vWhId'";
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
			return $strReturn;
			
	}	
function PrintInOutPutInStockDetail($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv003,$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$strCategory,$vVS_Color,$vExistItem,$vExistItemCur,$vshowimage)
	{
	if($vDateStart!="") $vDateStart=$vDateStart." 00:00:00";
	if($vDateEnd!="") $vDateEnd=$vDateEnd." 23:59:59";
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"10%\" >@03</td>
				<td class=\"htable\" width=\"*%\" >@04</td>
				<td class=\"htable\" width=\"5%\" >@05</td>
				<td class=\"htable\" width=\"10%\" >@06</td>
				<td class=\"htable\" width=\"10%\" >@07</td>
				<td class=\"htable\" width=\"10%\" >@08</td>
				<td class=\"htable\" width=\"10%\" >@12</td>
				<td class=\"htable\" width=\"10%\" >@13</td>				
				<td class=\"htable\" width=\"10%\" >@09</td>
				<td class=\"htable\" width=\"10%\" >@10</td>
				<td class=\"htable\" width=\"3%\" >@11</td>
				".(($vshowimage==1)?"<td class=\"htable\" width=\"3%\" >@15</td>":"")."
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >@02</td>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"right_style\" >@06</td>
				<td class=\"right_style\" >@07</td>
				<td class=\"right_style\" >@08</td>
				<td class=\"right_style\" >@12</td>
				<td class=\"right_style\" >@13</td>
				<td class=\"right_style\" >@09</td>	
				<td class=\"right_style\" >@10</td>
				<td class=\"right_style\" >@11</td>
				".(($vshowimage==1)?"<td class=\"right_style\" >@15</td>":"")."				
			</tr>
			@20
			";

		$vRowLightText="
			<tr>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"right_style\" >@06</td>
				<td class=\"right_style\" >@07</td>
				<td class=\"right_style\" >@08</td>
				<td class=\"right_style\" >@12</td>
				<td class=\"right_style\" >@13</td>				
				<td class=\"right_style\" >@09</td>
				<td class=\"right_style\" >@10</td>	
				<td class=\"right_style\" >@11</td>
				".(($vshowimage==1)?"<td class=\"right_style\" >@15</td>":"")."				
			</tr>";
		$vCondition="";
		$vAddCond=""; 
		if($strSupplierlv001!="")
		{
			
		}
		if($strTyles!="") 	$vAddCond=$vAddCond." AND B1.lv004 like '%$strTyles%'";
		if($strQuantiative!="") 	$vAddCond=$vAddCond." AND B1.lv005 like '%$strQuantiative%'";		
		if($strColor!="") 	$vAddCond=$vAddCond." AND B1.lv006 like '%$strColor%'";	
		if($strNote!="")  	$vAddCond=$vAddCond." AND B1.lv007 like '%$strNote%'";
		if($strlv014!="") {
		 	$vAddLot=$vAddLot." AND A1.lv014 like '%$strlv014%'";	
			}
		if($vVS_Color!="")
		{
			$vListVS_Color=$this->LV_GetSophieu("select A11.lv001 from ts_lv0020 A11 Where A11.lv008 like '%$vVS_Color%'");
			$vAddLot=$vAddLot." AND A1.lv014 in ($vListVS_Color)";	
		}
		if($strlv003!="") {
		 	$vAddLot=$vAddLot." AND A1.lv003 like '%$strlv003%'";	
			}
		if($vlv001!="")
		{
			$vAddContractR=$vAddContractR." AND (A11.lv002='$vlv001') ";
			$vAddContractO=$vAddContractO." AND  (A21.lv002='$vlv001')  ";		
		}
		else 
		{
			$strwh=$this->Get_TSControler();
			$vAddContractR=$vAddContractR." AND (A11.lv002 in  ($strwh)) ";
			$vAddContractO=$vAddContractO." AND (A21.lv002 in  ($strwh))  ";
		}
		if($strContractlv001!="") {$vAddContractR=" AND A11.lv006='".$strContractlv001."'";
		$vAddContractO=" AND A21.lv006='".$strContractlv001."'";
		}
		if($strSource!=""){ 
			$vAddContractR=$vAddContractR." AND (A11.lv005='$strSource') ";
			$vAddContractO=$vAddContractO." AND  (A21.lv005='$strSource')  ";					
		}
//		if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from ts_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from ts_lv0020 B where 1=1 $vAddCond)";
		if($vAddCond!="") $vCondition = $vCondition." left join ts_lv0020 B1 on A1.lv003=B1.lv003 AND A1.lv014=B1.lv002  $vAddCond";
		$vConditionStock="";
		$strwh=$this->Get_TSControler();
		if($vExistItem==1)
		{
			$vListItem=$this->LV_GET_ITEMS_EXIST($vlv001,$strwh);
			$vConditionStock =$vConditionStock." AND (A.lv001 in ($vListItem))";	
		}
		if($vExistItemCur==1)
		{
			
		}
		if($strlv003!="") $vConditionStock = $vConditionStock." AND A.lv001 LIKE '%$strlv003%'";		
		if($strCategory!="")  	 $vConditionStock=$vConditionStock." AND A.lv003 in ('".str_replace(",","','",$strCategory)."')";		;
		$vSPNhap1=$this->LV_GetSophieu("select A11.lv001 from ts_lv0008 A11 Where A11.lv009<'$vDateStart' $vAddContractR");
		$vSPNhap2=$this->LV_GetSophieu("select A11.lv001 from ts_lv0008 A11  Where A11.lv009>='$vDateStart' and A11.lv009<='$vDateEnd 23:59:59' $vAddContractR");
		$vSPXuat1=$this->LV_GetSophieu("select A21.lv001 from ts_lv0010 A21 Where A21.lv009<'$vDateStart' $vAddContractO");
		$vSPXuat2=$this->LV_GetSophieu("select A21.lv001 from ts_lv0010 A21 Where A21.lv010 NOT IN ('CANCEL','DEFECT') and A21.lv009>='$vDateStart' and A21.lv009<='$vDateEnd 23:59:59' $vAddContractO");
		$vSPXuat3=$this->LV_GetSophieu("select A21.lv001 from ts_lv0010 A21 Where A21.lv010='CANCEL' and A21.lv009>='$vDateStart' and A21.lv009<='$vDateEnd 23:59:59' $vAddContractO");
		$vSPXuat4=$this->LV_GetSophieu("select A21.lv001 from ts_lv0010 A21 Where A21.lv010='DEFECT' and A21.lv009>='$vDateStart' and A21.lv009<='$vDateEnd 23:59:59' $vAddContractO");
		$sqlS = "select A.*,B.lv002 UnitName,C.lv002 UnitNameP,(select sum(A1.lv004) from ts_lv0009 A1  $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN ($vSPNhap1) ) ReReceiptQty,(select sum(A1.lv004) from ts_lv0009 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN ($vSPNhap2) ) InReceiptQty,(select sum(A1.lv004) from ts_lv0011 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN ($vSPXuat1) ) ReOutlv004 ,(select sum(A1.lv004) from ts_lv0011 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN ($vSPXuat2) ) InOutlv004,(select sum(A1.lv004) from ts_lv0011 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN ($vSPXuat3) ) InOutBo,(select sum(A1.lv004) from ts_lv0011 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN ($vSPXuat4) ) InOutDefect,A.lv006 OtherC  from sl_lv0007 A left join sl_lv0005 B on A.lv004=B.lv001 left join sl_lv0005 C on A.lv005=C.lv001 where 1=1  and A.lv015=0 $vConditionStock";	
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv001']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv001'];
						$vTitle = ($arrS['lv002']!="" || $arrS['lv002']!=NULL)?$arrS['lv002']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", $vtInventorylv001, $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['UnitName']!="" || $arrS['UnitName']!=NULL)?$arrS['UnitName']:"-", $vLineRun);
				$vLineRun = str_replace("@11", ($arrS['UnitNameP']!="" || $arrS['UnitNameP']!=NULL)?$arrS['UnitNameP']:"-", $vLineRun);
				$vLineRun = str_replace("@06", $this->FormatView($arrS['ReReceiptQty']-$arrS['ReOutlv004'],10), $vLineRun);
				$vLineRun = str_replace("@07", $this->FormatView($arrS['InReceiptQty'],10), $vLineRun);
				$vLineRun = str_replace("@08", $this->FormatView($arrS['InOutlv004'],10), $vLineRun);
				$vLineRun = str_replace("@12", $this->FormatView($arrS['InOutBo'],10), $vLineRun);				
				$vLineRun = str_replace("@13", $this->FormatView($arrS['InOutDefect'],10), $vLineRun);			
				$vLineRun = str_replace("@15", $this->FormatView($arrS['lv014'],6), $vLineRun);							
				$vLineRun = str_replace("@09",$this->FormatView( ( $arrS['ReReceiptQty']-$arrS['ReOutlv004'])+( $arrS['InReceiptQty']-$arrS['InOutlv004']-$arrS['InOutBo']-$arrS['InOutDefect']),10), $vLineRun);
				$vOtherC=$arrS['OtherC'];
				if($arrS['OtherC']==0) $vOtherC=1;
				$vLineRun = str_replace("@10",$this->FormatView( ( $arrS['ReReceiptQty']-$arrS['ReOutlv004'])+( $arrS['InReceiptQty']-$arrS['InOutlv004'])/$vOtherC,10), $vLineRun);
				
				$vdetail='';
				switch($stropt)
				{
					case 2:
						$vLineRun = str_replace("@20", '', $vLineRun);	
						break;
					case 3:
						$vdetail=$this->GetBuildTableInputOutputDetail($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001,$vVS_Color);
						$vLineRun = str_replace("@20", "<tr><td colspan=\"12\">".$vdetail."</td></tr>", $vLineRun);
						if($vExistItemCur==1)
						{
							if($vdetail==""){$vOrder--; $vLineRun="";}
							
						}	
						break;
					case 4:
						$vdetail=$this->GetBuildTableLot($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001,$vVS_Color);
						$vLineRun = str_replace("@20","<tr><td colspan=\"".(($vshowimage==1)?13:12)."\">".$vdetail."</td></tr>", $vLineRun);	
						if($vExistItemCur==1)
						{
							if($vdetail=="") {$vOrder--; $vLineRun="";}
							
						}
						break;
					/*case 4:
						$vLineRun = str_replace("@20", $this->GetBuildTableInputOutputDetailStyle($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);	
						break;*/
					default:
						$vdetail = $this->GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001,$vVS_Color);
						$vLineRun = str_replace("@20", "<tr><td colspan=\"".(($vshowimage==1)?13:12)."\">".$vdetail."</td></tr>" , $vLineRun);		
						if($vExistItemCur==1)
						{
							if($vdetail=="") {$vOrder--; $vLineRun="";}
							
						}			
					break;
				}
					$strExpportAll = $strExpportAll.$vLineRun;
					$vLineRun = $vRowLightText;
				
			}
		} else {
			return $vArrLang[5];
		}
		if($vExistItemCur!=1)
		{
	  		$sqlS = "select MP.lv004,MP.UnitName,sum(IF(ISNULL(MP.ReReceiptQty),0,MP.ReReceiptQty)+IF(ISNULL(MP.InReceiptQty),0,MP.InReceiptQty)-IF(ISNULL(MP.ReOutlv004),0,MP.ReOutlv004)-IF(ISNULL(MP.InOutlv004),0,MP.InOutlv004) ) SumQty from (select A.lv004,B.lv002 UnitName,(select sum(A1.lv004) from ts_lv0009 A1  $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN (select A11.lv001 from ts_lv0008 A11 Where A11.lv009<'$vDateStart' $vAddContractR) ) ReReceiptQty,(select sum(A1.lv004) from ts_lv0009 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN (select A11.lv001 from ts_lv0008 A11  Where A11.lv009>='$vDateStart' and A11.lv009<='$vDateEnd' $vAddContractR) ) InReceiptQty,(select sum(A1.lv004) from ts_lv0011 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN (select A21.lv001 from ts_lv0010 A21 Where A21.lv009<'$vDateStart' $vAddContractO) ) ReOutlv004 ,(select sum(A1.lv004) from ts_lv0011 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN (select A21.lv001 from ts_lv0010 A21 Where A21.lv009>='$vDateStart' and A21.lv009<='$vDateEnd' $vAddContractO) ) InOutlv004  from sl_lv0007 A left join sl_lv0005 B on A.lv004=B.lv001  where 1=1 and A.lv015=0 $vConditionStock) MP group by MP.lv004,MP.UnitName ";		
			$strExpportAll=$strExpportAll.$this->SumSQLRun($sqlS,(($vshowimage==1)?13:12),$vArrLang[14],$plang);
		}	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Order
		$vHeader = str_replace("@02", $vArrLang[4], $vHeader);
		//lv003
		$vHeader = str_replace("@03", $vArrLang[5], $vHeader);
		//Stock lv002
		$vHeader = str_replace("@04", $vArrLang[6], $vHeader);
		//Unit
		$vHeader = str_replace("@11", $vArrLang[7], $vHeader);
		//Unit
		$vHeader = str_replace("@05",$vArrLang[7], $vHeader);
		//Fist
		$vHeader = str_replace("@06", $vArrLang[8], $vHeader);
		//Input Mlv001dle
		$vHeader = str_replace("@07", $vArrLang[9], $vHeader);
		//Output Mlv001dle
		$vHeader = str_replace("@08",$vArrLang[10], $vHeader);
		$vHeader = str_replace("@12",$vArrLang[48], $vHeader);
		$vHeader = str_replace("@13",$vArrLang[49], $vHeader);
		//Last
		$vHeader = str_replace("@09",$vArrLang[11], $vHeader);		
		//Last
		$vHeader = str_replace("@10",$vArrLang[50], $vHeader);	
		//Images
		$vHeader = str_replace("@15",$vArrLang[52], $vHeader);			
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}	
	function GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001,$vVS_Color)
	{
		
	$vHeaderReportInventory="
		<table style=\"border-top:0xp;border-bottom:0px;border-left:0px;border-right:0px\" width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"tblprint\">
			<tr height=\"5px\" class=\"tblRunChild\" >
				<td width=\"5%\" >@02</td>
				<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"10%\" >@03</td>
				<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"8%\" >@04</td>
				<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"15%\" >@05</td>
				<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"3%\" >@06</td>
				<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"5%\" >@09</td>												
				<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"10%\" >Giá</td>
				<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"5%\" >@08</td>	
				<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"5%\" >@11</td>	
				<td style=\"border-left:1px #303030 solid;\" class=\"htablerun\" width=\"10%\" >@10</td>												
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@02</td>			
				<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"left_style\" rowspan=\"@01\">@04</td>
				<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"right_style\" >@05</td>
				<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"center_style\" >@06</td>
				<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"left_style\" >@09</td>								
				<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"right_style\" >@07</td>				
				<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"center_style\" >@08</td>
				<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"left_style\" >@11</td>	
				<td style=\"border-top:1px #303030 solid;border-left:1px #303030 solid;\" class=\"left_style\" >@10</td>				
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\" >@09</td>								
				<td class=\"right_style\" >@07</td>				
				<td class=\"center_style\" >@08</td>
				<td class=\"left_style\" >@11</td>
				<td class=\"left_style\" >@10</td>				
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01','@02')\" >@01</a>";		
		$HrefLot="<a href=\"javascript:ViewLot('@01','@02','@03')\" >@01</a>";					
		$vCondition="";
		$vAddCond=""; 
		if($strlv014!="") 	$vAddLot=$vAddLot." AND A.lv014 like '%$strlv014%'";	
		if($vVS_Color!="")
		{
			$vListVS_Color=$this->LV_GetSophieu("select A11.lv001 from ts_lv0020 A11 Where A11.lv008 like '%$vVS_Color%'");
			$vAddLot=$vAddLot." AND A.lv014 in ($vListVS_Color)";	
		}	
		if($strTyles!="") 	$vAddCond=$vAddCond." AND B1.lv004 like '%$strTyles%'";
		if($strQuantiative!="") 	$vAddCond=$vAddCond." AND B1.lv005 like '%$strQuantiative%'";		
		if($strColor!="") 	$vAddCond=$vAddCond." AND B1.lv006 like '%$strColor%'";				
		if($strNote!="") 	$vAddCond=$vAddCond." AND B1.lv007 like '%$strNote%'";				
		if($strContractlv001!="")
		{
			$vAddContractR=" AND B.lv006='".$strContractlv001."' and (B.lv005=4 or B.lv005=7) ";				
			$vAddContractO=" AND B.lv006='".$strContractlv001."' and B.lv005=4  ";						 
		 }		
		 if($strSource!=""){ 
			$vAddContractR=$vAddContractR." AND (B.lv005='$strSource') ";
			$vAddContractO=$vAddContractO." AND  (B.lv005='$strSource')  ";					
		}	
		 if($vlv001!="")
		 {
			 $vAddContractR=$vAddContractR." AND B.lv002='$vlv001'";				
			$vAddContractO=$vAddContractO." AND B.lv002='$vlv001'";		
		 }
		else 
		{
			$strwh=$this->Get_TSControler();
			$vAddContractR=$vAddContractR." AND (B.lv002 in ($strwh)) ";
			$vAddContractO=$vAddContractO." AND (B.lv002 in ($strwh))  ";
		}
		//if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from ts_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from ts_lv0020 B where 1=1 $vAddCond)";
			if($vAddCond!="") $vCondition = $vCondition." left join ts_lv0020 B1 on A.lv003=B1.lv003 AND A.lv014=B1.lv002  $vAddCond";		
		  $sqlS = "select A.lv001, A.lv002 ,A.lv004,C.lv002 UnitName,B.lv005 Type,B.lv009 DateEnter,'N' CategoryPut,A.lv008 Price,A.lv007,A.lv014 Lot,A.lv015,B.lv006 Reference,B.lv002 WhID  from ts_lv0009 A inner join ts_lv0008 B on A.lv002=B.lv001 and (B.lv009>='$vDateStart' and B.lv009<='$vDateEnd') $vAddContractR  left join sl_lv0005 C on A.lv005=C.lv001 $vCondition where A.lv003='$vlv003' $vAddLot
				UNION
				select A.lv001, A.lv002,A.lv004,C.lv002 UnitName,B.lv005 Type,B.lv009 DateEnter,'X' CategoryPut,A.lv008 Price,A.lv007,A.lv014 Lot,A.lv015,B.lv006 Reference,B.lv002 WhID from ts_lv0011 A inner join ts_lv0010 B on A.lv002=B.lv001 and B.lv009>='$vDateStart' and B.lv009<='$vDateEnd' $vAddContractO left join sl_lv0005 C on A.lv005=C.lv001 $vCondition where A.lv003='$vlv003' $vAddLot 
		";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv002']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv002'];
						$vTitle = ($arrS['DateEnter']!="" || $arrS['DateEnter']!=NULL)?formatdate($arrS['DateEnter'],$plang):"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", '', $vLineRun);
						$vLineRun = str_replace("@03",str_replace("@02",$arrS['CategoryPut'],str_replace("@01",$vtInventorylv001,$Href)), $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['lv004']!="" || $arrS['lv004']!=NULL)?Lcurrency($arrS['lv004'],$plang)."(".$arrS['UnitName'].")":"-", $vLineRun);
				$vLineRun = str_replace("@06", $arrS['CategoryPut'], $vLineRun);
				$vLineRun = str_replace("@07", $this->FormatView($arrS['Price'],10)."&nbsp;", $vLineRun);				
				$vLineRun = str_replace("@08", $arrS['Type'], $vLineRun);
				$vLineRun = str_replace("@09", ($arrS['Lot']!="" || $arrS['Lot']!=NULL)?(str_replace("@02",$vlv003,str_replace("@01",$arrS['Lot'],str_replace("@03",$arrS['WhID'],$HrefLot)))):"&nbsp;", $vLineRun);				
				$vLineRun = str_replace("@10",($arrS['lv015']!="" || $arrS['lv015']!=NULL)?$arrS['lv015']:"&nbsp;", $vLineRun);	
				$vLineRun = str_replace("@11",($arrS['Reference']!="" || $arrS['Reference']!=NULL)?$arrS['Reference']:"&nbsp;", $vLineRun);				
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return '';
		}

		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Space
		$vHeader = str_replace("@02", '', $vHeader);		
		//Invoice
		$vHeader = str_replace("@03", $vArrLang[20], $vHeader);
		//Title
		$vHeader = str_replace("@04", $vArrLang[21], $vHeader);
		//Quanity
		$vHeader = str_replace("@05",$vArrLang[22], $vHeader);
		//Category N/X
		$vHeader = str_replace("@06", $vArrLang[23], $vHeader);
		//Title
		$vHeader = str_replace("@07", $vArrLang[25], $vHeader);
		//Source
		$vHeader = str_replace("@08", $vArrLang[26], $vHeader);
		//Reference
		$vHeader = str_replace("@11", $vArrLang[27], $vHeader);
		//Lot
		$vHeader = str_replace("@09", $vArrLang[24], $vHeader);
		//Note
		$vHeader = str_replace("@10", $vArrLang[28], $vHeader);		
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);			
	}	
//////////////////////////////////Purchase Order////////////////////////////
	function GetBuildTableInputOutputDetail($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001)
	{
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"5px\" class=\"tblRunChild\" >
				<td class=\"htablerun\" width=\"3%\" >@02</td>
				<td class=\"htablerun\" width=\"8%\" >@03</td>
				<td class=\"htablerun\" width=\"7%\" >@04</td>
				<td class=\"htablerun\" width=\"9%\" >@05</td>
				<td class=\"htablerun\" width=\"3%\" >@06</td>
				<td class=\"htablerun\" width=\"6%\" >@09</td>												
				<td class=\"htablerun\" width=\"6%\" >@11</td>	
				<td class=\"htablerun\" width=\"7%\" >@12</td>
				<td class=\"htablerun\" width=\"7%\" >@13</td>				
				<td class=\"htablerun\" width=\"7%\" >@15</td>														
				<td class=\"htablerun\" width=\"6%\" >@14</td>						
				<td class=\"htablerun\" width=\"*%\" >@07</td>
				<td class=\"htablerun\" width=\"5%\" >@08</td>	
				<td class=\"htablerun\" width=\"8%\" >@10</td>																																													
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@02</td>			
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_style\" rowspan=\"@01\">@04</td>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\" >@09</td>				
				<td class=\"left_style\" >@11</td>				
				<td class=\"left_style\" >@12</td>				
				<td class=\"left_style\" >@13</td>		
				<td class=\"left_style\" >@15</td>						
				<td class=\"left_style\" >@14</td>																																		
				<td class=\"left_style\" >@07</td>				
				<td class=\"center_style\" >@08</td>
				<td class=\"left_style\" >@10</td>				
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\" >@09</td>	
				<td class=\"left_style\" >@11</td>				
				<td class=\"left_style\" >@12</td>				
				<td class=\"left_style\" >@13</td>				
				<td class=\"left_style\" >@15</td>																				
				<td class=\"left_style\" >@14</td>												
				<td class=\"left_style\" >@07</td>				
				<td class=\"center_style\" >@08</td>
				<td class=\"left_style\" >@10</td>																											
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01','@02')\" >@01</a>";		
		$HrefLot="<a href=\"javascript:ViewLot('@01','@02')\" >@01</a>";					
		$vCondition="";
		$vAddCond=""; 
		if($strlv014!="") 	$vAddCond=$vAddCond." AND B1.lv014 like '%$strlv014%'";		
		if($strTyles!="") 	$vAddCond=$vAddCond." AND B1.lv004 like '%$strTyles%'";
		if($strQuantiative!="") 	$vAddCond=$vAddCond." AND B1.lv005 like '$strQuantiative'";		
		if($strColor!="") 	$vAddCond=$vAddCond." AND B1.lv006 like '%$strColor%'";	
		if($strNote!="") 	 $vAddCond=$vAddCond." AND B1.lv007 like '%$strNote%'";		
		if($strContractlv001!="")
		{
			$vAddContractR=" AND B.lv006='".$strContractlv001."' and (B.lv005=4 or B.lv005=7) ";				
			$vAddContractO=" AND B.lv006='".$strContractlv001."' and B.lv005=4  ";						 
		 }			
		 if($strSource!=""){ 
			$vAddContractR=$vAddContractR." AND (B.lv005='$strSource') ";
			$vAddContractO=$vAddContractO." AND  (B.lv005='$strSource')  ";					
		}	
		 if($vlv001!="")
		 {
			 $vAddContractR=$vAddContractR." AND B.lv002='$vlv001'";				
			$vAddContractO=$vAddContractO." AND B.lv002='$vlv001'";		
		 }
		else 
		{
			$strwh=$this->Get_TSControler();
			$vAddContractR=$vAddContractR." AND (B.lv002 in ($strwh)) ";
			$vAddContractO=$vAddContractO." AND (B.lv002 in ($strwh))  ";
		}
		//if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from ts_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from ts_lv0020 B where 1=1 $vAddCond)";
		if($vAddCond!="") $vCondition = $vCondition." inner join ts_lv0020 B1 on A.lv003=B1.lv003 AND A.lv014=B1.lv014  $vAddCond";		
		 $sqlS = "select A.lv001,A.lv002 ,A.lv004,C.lv002 UnitName,B.lv005,B.lv009 DateEnter,'N' CategoryPut,B.lv004 Title,A.lv007,A.lv014 Lot,D.lv006,D.lv004,D.lv005,D.lv007 NoteLot,E.lv002VN Colorlv002  from ts_lv0009 A inner join ts_lv0008 B on A.lv002=B.lv001 and (B.lv009>='$vDateStart' and B.lv009<='$vDateEnd') $vAddContractR  left join sl_lv0005 C on A.lv005=C.lv001 left join ts_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003' 
				UNION
				select A.lv001, A.lv002,A.lv004,C.lv002 UnitName,B.lv005,B.lv009 DateEnter,'X' CategoryPut,B.lv004 Title,A.lv007,A.lv014 Lot,D.lv006,D.lv004,D.lv005,D.lv007 NoteLot,E.lv002VN Colorlv002 from ts_lv0011 A inner join ts_lv0010 B on A.lv002=B.lv001 and B.lv009>='$vDateStart' and B.lv009<='$vDateEnd' $vAddContractO left join sl_lv0005 C on A.lv005=C.lv001  left join ts_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003' 
		";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv002']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv002'];
						$vTitle = ($arrS['DateEnter']!="" || $arrS['DateEnter']!=NULL)?formatdate($arrS['DateEnter'],$plang):"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", '', $vLineRun);
						$vLineRun = str_replace("@03",str_replace("@02",$arrS['CategoryPut'],str_replace("@01",$vtInventorylv001,$Href)), $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['lv004']!="" || $arrS['lv004']!=NULL)?Lcurrency($arrS['lv004'],$plang)."(".$arrS['UnitName'].")":"-", $vLineRun);
				$vLineRun = str_replace("@06", $arrS['CategoryPut'], $vLineRun);
				$vLineRun = str_replace("@07", $arrS['Title']."&nbsp;", $vLineRun);				
				$vLineRun = str_replace("@08", $arrS['lv005'], $vLineRun);
				$vLineRun = str_replace("@09", ($arrS['Lot']!="" || $arrS['Lot']!=NULL)?(str_replace("@02",$vlv003,str_replace("@01",$arrS['Lot'],$HrefLot))):"&nbsp;", $vLineRun);				
				$vLineRun = str_replace("@10",($arrS['Note']!="" || $arrS['Note']!=NULL)?$arrS['Note']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@11",($arrS['Color']!="" || $arrS['Color']!=NULL)?$arrS['Color']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@12",($arrS['Colorlv002']!="" || $arrS['Colorlv002']!=NULL)?$arrS['Colorlv002']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@13",($arrS['Tyles']!="" || $arrS['Tyles']!=NULL)?$arrS['Tyles']:"&nbsp;", $vLineRun);	
				$vLineRun = str_replace("@14",($arrS['NoteLot']!="" || $arrS['NoteLot']!=NULL)?$arrS['NoteLot']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@15",($arrS['Quantitative']!="" || $arrS['Quantitative']!=NULL)?$arrS['Quantitative']:"&nbsp;", $vLineRun);																					
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return '';
		}

		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Space
		$vHeader = str_replace("@02", '', $vHeader);		
		//Invoice
		$vHeader = str_replace("@03", $vArrLang[39], $vHeader);
		//Title
		$vHeader = str_replace("@04", $vArrLang[44], $vHeader);
		//Quanity
		$vHeader = str_replace("@05",$vArrLang[41], $vHeader);
		//Category N/X
		$vHeader = str_replace("@06", $vArrLang[42], $vHeader);
		//Title
		$vHeader = str_replace("@07", $vArrLang[40], $vHeader);
		//lv005
		$vHeader = str_replace("@08", $vArrLang[43], $vHeader);
		//Lot
		$vHeader = str_replace("@09", $vArrLang[46], $vHeader);
		//Note
		$vHeader = str_replace("@10", $vArrLang[45], $vHeader);		
		//Colorlv001
		$vHeader = str_replace("@11", $vArrLang[47], $vHeader);				
		//Colorlv002
		$vHeader = str_replace("@12", $vArrLang[48], $vHeader);				
		//Tyles
		$vHeader = str_replace("@13", $vArrLang[50], $vHeader);				
		//Description
		$vHeader = str_replace("@14", $vArrLang[49], $vHeader);	
		//Quantitative
		$vHeader = str_replace("@15", $vArrLang[51], $vHeader);						
				
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);			
	}	
//////////////////////////////////Detail Sale Style////////////////////////////
	function GetBuildTableInputOutputDetailStyle($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001)

	{
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"5px\" class=\"tblRunChild\" >
				<td class=\"htablerun\" width=\"3%\" >@02</td>
				<td class=\"htablerun\" width=\"8%\" >@03</td>
				<td class=\"htablerun\" width=\"7%\" >@04</td>
				<td class=\"htablerun\" width=\"9%\" >@05</td>
				<td class=\"htablerun\" width=\"3%\" >@06</td>
				<td class=\"htablerun\" width=\"9%\" >@07</td>
				<td class=\"htablerun\" width=\"9%\" >@08</td>
				<td class=\"htablerun\" width=\"6%\" >@09</td>												
				<td class=\"htablerun\" width=\"8%\" >@10</td>																																													
				<td class=\"htablerun\" width=\"6%\" >@11</td>					
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@02</td>			
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_style\" rowspan=\"@01\">@04</td>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"center_style\" >@07</td>
				<td class=\"center_style\" >@08</td>
				<td class=\"left_style\" >@09</td>				
				<td class=\"left_style\" >@10</td>					
				<td class=\"left_style\" >@11</td>	
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"center_style\" >@07</td>
				<td class=\"center_style\" >@08</td>				
				<td class=\"left_style\" >@09</td>
				<td class=\"left_style\" >@10</td>	
				<td class=\"left_style\" >@11</td>				
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01','@02')\" >@01</a>";		
		$HrefLot="<a href=\"javascript:ViewLot('@01','@02')\" >@01</a>";					
		$vCondition="";
		$vAddCond=""; 
		if($strlv014!="") 	$vAddCond=$vAddCond." AND B1.lv014 like '%$strlv014%'";		
		if($strTyles!="") 	$vAddCond=$vAddCond." AND B1.lv004 like '%$strTyles%'";
		if($strQuantiative!="") 	$vAddCond=$vAddCond." AND B1.lv005 like '$strQuantiative'";		
		if($strColor!="") 	$vAddCond=$vAddCond." AND B1.lv006 like '%$strColor%'";				
		if($strNote!="")  $vAddCond=$vAddCond." AND B1.lv007 like '%$strNote%'";		
		if($strContractlv001!="")
		{
			$vAddContractR=" AND B.lv006='".$strContractlv001."' and (B.lv005=4 or B.lv005=7) ";				
			$vAddContractO=" AND B.lv006='".$strContractlv001."' and B.lv005=4  ";						 
		 }		
		 if($strSource!=""){ 
			$vAddContractR=$vAddContractR." AND (B.lv005='$strSource') ";
			$vAddContractO=$vAddContractO." AND  (B.lv005='$strSource')  ";					
		}		
		 if($vlv001!="")
		 {
			 $vAddContractR=$vAddContractR." AND B.lv002='$vlv001'";				
			$vAddContractO=$vAddContractO." AND B.lv002='$vlv001'";		
		 }
		else 
		{
			$strwh=$this->Get_TSControler();
			$vAddContractR=$vAddContractR." AND (B.lv002 in ($strwh)) ";
			$vAddContractO=$vAddContractO." AND (B.lv002 in ($strwh))  ";
		}
		//if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from ts_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from ts_lv0020 B where 1=1 $vAddCond)";
		if($vAddCond!="") $vCondition = $vCondition." inner join ts_lv0020 B1 on A.lv003=B1.lv003 AND A.lv014 Lot=B1.lv014  $vAddCond";		
		 $sqlS = "select  VC.lv004,VC.lv006,VC.lv006lv002,sum(VC.lv004D) lv004D,sum(VC.lv004N) lv004N,sum(VC.lv004X) lv004X from (select A.lv001,A.lv002,0 lv004D,A.lv004 lv004N,0 lv004X,'N' CategoryPut,D.lv006,D.lv004,E.lv002VN Colorlv002  from ts_lv0009 A inner join ts_lv0008 B on A.lv002=B.lv001 and (B.lv009>='$vDateStart' and B.lv009<='$vDateEnd') $vAddContractR left join sl_lv0005 C on A.lv005=C.lv001 left join ts_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003' 
				UNION
				select A.lv001, A.lv002,0 lv004D,0 lv004N,A.lv004 lv004X,'X' CategoryPut,D.lv006,D.lv004,E.lv002VN Colorlv002 from ts_lv0011 A inner join ts_lv0010 B on A.lv002=B.lv001 and B.lv009>='$vDateStart' and B.lv009<='$vDateEnd' $vAddContractO left join sl_lv0005 C on A.lv005=C.lv001  left join ts_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003'
				UNION
select A.lv001,A.lv002,A.lv004 lv004D ,0 lv004N,0 lv004X,'N' CategoryPut,D.lv006,D.lv004,E.lv002VN Colorlv002  from ts_lv0009 A inner join ts_lv0008 B on A.lv002=B.lv001 and B.lv009<'$vDateStart' $vAddContractR left join sl_lv0005 C on A.lv005=C.lv001 left join ts_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003' 
				UNION
				select A.lv001, A.lv002,-A.lv004 lv004D,0 lv004N,0 lv004X,'X' CategoryPut,D.lv006,D.lv004,E.lv002VN Colorlv002 from ts_lv0011 A inner join ts_lv0010 B on A.lv002=B.lv001 and B.lv009<'$vDateStart' $vAddContractO  left join sl_lv0005 C on A.lv005=C.lv001  left join ts_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003'		
				) VC		
				
				 Group by VC.lv004,VC.lv006 
		";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtTyles='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtTyles != $arrS['Tyles']){
						$vOrder++;
						$vtTyles = $arrS['lv002'];
						$vTitle = ($arrS['Tyles']!="" || $arrS['Tyles']!=NULL)?$arrS['Tyles']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", '', $vLineRun);
						$vLineRun = str_replace("@03","+ ".$vOrder, $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['Color']!="" || $arrS['Color']!=NULL)?$arrS['Color']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@06",($arrS['Colorlv002']!="" || $arrS['Colorlv002']!=NULL)?$arrS['Colorlv002']:"&nbsp;" , $vLineRun);
				$vLineRun = str_replace("@07",($arrS['lv004D']!="" || $arrS['lv004D']!=NULL)?$arrS['lv004D']:"0", $vLineRun);				
				$vLineRun = str_replace("@08", ($arrS['lv004N']!="" || $arrS['lv004N']!=NULL)?$arrS['lv004N']:"0", $vLineRun);
				$vLineRun = str_replace("@09", ($arrS['lv004X']!="" || $arrS['lv004X']!=NULL)?$arrS['lv004X']:"0", $vLineRun);				
				$vLineRun = str_replace("@10",($arrS['lv004D']+$arrS['lv004N']-$arrS['lv004X']), $vLineRun);
				$vLineRun = str_replace("@11","..........", $vLineRun);																				
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return '';
		}

		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Space
		$vHeader = str_replace("@02", '', $vHeader);		
		//Order
		$vHeader = str_replace("@03", $vArrLang[19], $vHeader);
		//Tyles
		$vHeader = str_replace("@04", $vArrLang[50], $vHeader);
		//Colorlv001
		$vHeader = str_replace("@05",$vArrLang[47], $vHeader);
		//Colorlv002
		$vHeader = str_replace("@06", $vArrLang[48], $vHeader);
		//Tồn đầu kỳ
		$vHeader = str_replace("@07", $vArrLang[23], $vHeader);
		//Nhập trong kỳ
		$vHeader = str_replace("@08", $vArrLang[24], $vHeader);
		//Xuất trong kỳ
		$vHeader = str_replace("@09", $vArrLang[25], $vHeader);
		//Tồn cuối kỳ
		$vHeader = str_replace("@10", $vArrLang[26], $vHeader);		
		//Description
		$vHeader = str_replace("@11", $vArrLang[45], $vHeader);	
				
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);			
	}	
//////////////////////////////////////////Purchase Order////////////////////////////////////////////////////////////////////
	function ReportPurchaseOrderAdv($plang, $vArrLang, $strPurchaseRequirelv001, $strTitle,$strDateCreateFrom, $strDateCreateTo, $strDateRequireFrom,$strDateRequireTo,$strDateDeliveryFrom,$strDateDeliveryTo,$strShippingMethodlv001,$strPaymentMethodlv001,$strApproval,$strlv005,$strSupplierlv001){
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"htable_hr\" width=\"3%\" >@02</td>
				<td class=\"htable_hr\" width=\"20%\" >@03</td>
				<td class=\"htable_hr\" width=\"*%\" >@04</td>
				<td class=\"htable_hr\" width=\"20%\" >@05</td>
				<td class=\"htable_hr\" width=\"10%\" >@06</td>
				<td class=\"htable_hr\" width=\"10%\" >@07</td>
				<td class=\"htable_hr\" width=\"10%\" >@08</td>				
				<td class=\"htable_hr\" width=\"10%\" >@09</td>								
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_hr\" rowspan=\"@01\" valign=\"top\" >@02</td>
				<td class=\"left_hr\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_hr\" >@04</td>
				<td class=\"left_hr\" >@05</td>
				<td class=\"left_hr\" >@06</td>
				<td class=\"left_hr\" >@07</td>
				<td class=\"left_hr\" >@08</td>
				<td class=\"left_hr\" >@09</td>				
			</tr>";

		$vRowLightText="
			<tr>
				<td class=\"left_hr\" >@04</td>
				<td class=\"left_hr\" >@05</td>
				<td class=\"left_hr\" >@06</td>
				<td class=\"left_hr\" >@07</td>
				<td class=\"left_hr\" >@08</td>				
				<td class=\"left_hr\" >@09</td>								
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01')\" >@01</a>";
		$vCondition = "";
		if($strPurchaseRequirelv001!="") $vCondition = " AND A.lv001 LIKE '%$strPurchaseRequirelv001%'";
		if($strTitle!="") $vCondition = $vCondition." AND A.Title LIKE '%$strTitle%'";
		if($strDateCreateFrom!="") $vCondition = $vCondition." AND A.DateCreate >= '$strDateCreateFrom'";
		if($strDateCreateTo!="") $vCondition = $vCondition." AND A.DateCreate <= '$strDateCreateTo'";
		if($strDateRequireFrom!="") $vCondition = $vCondition." AND A.DateRequire>= '$strDateRequireFrom'";
		if($strDateRequireTo!="") $vCondition = $vCondition." AND A.DateRequire<= '$strDateRequireTo'";
		if($strDateDeliveryFrom!="") $vCondition = $vCondition." AND A.DateDelivery>= '$strDateDeliveryFrom'";
		if($strDateDeliveryTo!="") $vCondition = $vCondition." AND A.DateDelivery<= '$strDateDeliveryTo'";
		if($strShippingMethodlv001!="") $vCondition = $vCondition." AND A.ShippingMethodlv001='$strShippingMethodlv001'";
		if($strPaymentMethodlv001!="") $vCondition = $vCondition." AND A.PaymentMethodlv001='$strPaymentMethodlv001'";		
		if($strApproval!="") $vCondition = $vCondition." AND A.Approval='$strApproval'";
		if($strlv005!="") $vCondition = $vCondition." AND A.lv005='$strlv005'";			
		if($strSupplierlv001!="") $vCondition = $vCondition." AND A.Supplierlv001='$strSupplierlv001'";			
	
		$sqlS = "select A.*,B.Companylv002 Warehouselv002 from  wh_purchaserequire A left join  wh_supplier B on A.Supplierlv001=B.lv001 where 1=1 ".$vCondition." ORDER BY A.DateCreate Desc,A.lv001 DESC";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv001']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv001'];
						$vTitle = ($arrS['Title']!="" || $arrS['Title']!=NULL)?$arrS['Title']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", str_replace("@01",$vtInventorylv001,$Href), $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['Warehouselv002']!="" || $arrS['Warehouselv002']!=NULL)?$arrS['Warehouselv002']:"-", $vLineRun);
				$vLineRun = str_replace("@06", $arrS['Employeelv001'], $vLineRun);
				$vLineRun = str_replace("@07", ($arrS['DateCreate']!="" || $arrS['DateCreate']!=NULL)?formatdate($arrS['DateCreate'],$plang):"-", $vLineRun);
				$vLineRun = str_replace("@08", $arrS['Approval'], $vLineRun);				
				$vLineRun = str_replace("@09", $arrS['lv005'], $vLineRun);								
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}

		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Order
		$vHeader = str_replace("@02", $vArrLang[6], $vHeader);
		//Inventorylv001
		$vHeader = str_replace("@03", $vArrLang[7], $vHeader);
		//Title
		$vHeader = str_replace("@04", $vArrLang[8], $vHeader);
		//Warehouse
		$vHeader = str_replace("@05",$vArrLang[9], $vHeader);
		//DateCal
		$vHeader = str_replace("@06", $vArrLang[12], $vHeader);
		//Employee
		$vHeader = str_replace("@07", $vArrLang[10], $vHeader);
		//Approval
		$vHeader = str_replace("@08",$vArrLang[11], $vHeader);
		//lv005
		$vHeader = str_replace("@09",$vArrLang[13], $vHeader);		

		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);
	}	
	function SumSQLRun($vSQL,$vColpan,$vLang,$plang)
	{
		$vtr="<tr onDblClick=\"this.innerHTML=''\" style=\"cursor:move;font-size:20px;font-weight:bold\"><td class=\"right_hr\" colspan=\"$vColpan\" valign=\"top\" >$vLang: @01</td></tr>";
		$bResultS = db_query($vSQL);
		$vValue="";
		while($arrS=db_fetch_array($bResultS)){		
			if($vValue=="") $vValue=$this->FormatView($arrS['SumQty'],10).$arrS['UnitName'];
			else $vValue=$vValue." ; ".$this->FormatView($arrS['SumQty'],10).$arrS['UnitName'];
		}
		if($vValue!="") return  str_replace("@01",$vValue,$vtr);
		return "";
	}
	public function GetBuilCheckList($vListID,$vID,$vTabIndex)
	{
		$vListID=",".$vListID.",";
		$strTbl="<table  align=\"center\" class=\"lvtable\">
		<input type=\"hidden\" id=$vID name=$vID value=\"@#02\">
		@#01
		</table>
		<script language=\"javascript\">
		function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{
				if(str=='') 
					str=div.value;
				else
					 str=str+','+div.value;
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
		$vsql="select * from  sl_lv0006";
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
			$strTemp=str_replace("@#02",$vrow['lv002']."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
						$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	function LV_GetSophieu($vsql)
	{
		$vresult=db_query($vsql);
			$strReturn="";
			if($vresult)
			{
				while($vrow=db_fetch_array($vresult))
				{
			   		if($strReturn=="") $strReturn="'".$vrow["lv001"]."'";
					else $strReturn=$strReturn.",'".$vrow["lv001"]."'";
				}
				if($strReturn=="") $strReturn="''";
				return $strReturn;
			}
			if($strReturn=="") $strReturn="''";
			return $strReturn;
			
	}
	public function LV_LinkField($vFile,$vSelectlv001)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectlv001),1));
	}
	private function sqlcondition($vFile,$vSelectlv001)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv002':
				$strwh=$this->Get_TSControler();
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  ts_lv0001 where lv001 in ($strwh)";
				break;
			case 'lv003':
				$vsql="select lv001,concat(lv004,lv003,lv002) lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv004':
				$vsql="select lv001,lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  ts_lv0013";
				break;
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  sl_lv0007";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  sl_lv0006";
				break;
		}
		return $vsql;
	}
	public  function getvaluelink($vFile,$vSelectlv001)
	{
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  ts_lv0001 where lv001='$vSelectlv001'";
				break;
			case 'lv003':
				$vsql="select lv001,concat(lv004,lv003,lv002) lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  hr_lv0020 where lv001='$vSelectlv001'";
				break;
			case 'lv004':
				$vsql="select lv001,lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  ts_lv0013 where lv001='$vSelectlv001'";
				break;
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  sl_lv0007 where lv001='$vSelectlv001'";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  sl_lv0006 where lv001='$vSelectlv001'";
				break;
			default:
				$vsql ="";
				break;
		}
		if($vsql=="")
		{
			return $vSelectlv001;
		}
		else
		$lvResult = db_query($vsql);
		$lvopt=1;
		while($row= db_fetch_array($lvResult)){
		return ($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
		}
		
	}
}
	?>