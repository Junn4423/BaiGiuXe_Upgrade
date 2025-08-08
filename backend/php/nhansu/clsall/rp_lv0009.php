<?php
class rp_lv0009 extends lv_controler{
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
	
		$this->isApr=0;		
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];
		
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
	/////////////////////////*****************///////////////////////////////
	function PrintInOutPutInStockDetail($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$strlv006,$strlv007,$strlv008,$strlv009)
	{
		$lvArrCateSize=array();
		$lvArrChildSize=array();
		$maxCol=0;
		$this->BuilCategorySize($lvArrCateSize,$lvArrChildSize,$maxCol,$rowline,$rowts);
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			$rowline
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"8%\" >@03</td>
				<td class=\"htable\" width=\"*%\" >@04</td>
				<td class=\"htable\" width=\"5%\" >@05</td>
				<td class=\"htable\" width=\"10%\" >@06</td>
				<td class=\"htable\" width=\"10%\" >@07</td>
				<td class=\"htable\" width=\"10%\" >@08</td>				
				<td class=\"htable\" width=\"10%\" >@09</td>
				<td class=\"htable\" width=\"10%\" >@10</td>
				<td class=\"htable\" width=\"10%\" >@11</td>
				$rowts
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
				<td class=\"right_style\" >@10</td>
				<td class=\"right_style\" >@11</td>	
				<td class=\"right_style\" >@12</td>	
				@99
			</tr>
			<tr>
				<td colspan=\"".(11+$maxCol)."\">@20<td>
			</tr>
			";

		$vRowLightText="
			<tr>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"right_style\" >@06</td>
				<td class=\"right_style\" >@07</td>
				<td class=\"right_style\" >@08</td>				
				<td class=\"right_style\" >@09</td>								
			</tr>";
		$vConditionStock="";
		
		if($vlv001!="") 	$vConditionStock=$vConditionStock." AND C.lv002 like '%$vlv001%'";
		if($strlv006!="") 	$vConditionStock=$vConditionStock." AND A.lv003 like '%$strlv006%'";		
		if($strlv008!="") 	$vConditionStock=$vConditionStock." AND A.lv003 in (select BB.lv001 from sl_lv0007 BB where BB.lv003 in ('".str_replace(",","','",$strlv008)."'))";
		if($strlv007!="") 	$vConditionStock=$vConditionStock." AND A.lv010 like '$strlv007'";
		if($strlv009!="") 	$vConditionStock=$vConditionStock." AND A.lv011 = '$strlv009'";
		$sqlS = "select distinct A.lv002,A.lv003,A.lv009,A.lv010,A.lv011,A.lv013,B.lv002 ItemName,C.lv016 PO,(select V.lv002 from hr_lv0014 V where V.lv001=D.lv018) CustomerID,F.lv002 ShipName from sl_lv0014 A left join sl_lv0007 B on A.lv003=B.lv001 inner join sl_lv0013 C on A.lv002=C.lv001 left join sl_lv0001  D on C.lv002=D.lv001 left join sl_lv0008  F on C.lv008=F.lv001 where 1=1    $vConditionStock";	
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
						//$vtInventorylv001 = $arrS['lv001'];
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", ($arrS['PO']!="" || $arrS['PO']!=NULL)?$arrS['PO']:"-", $vLineRun);
						$vLineRun = str_replace("@04",($arrS['ShipName']!="" || $arrS['ShipName']!=NULL)?$arrS['ShipName']:"-", $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@06", "-", $vLineRun);
				$vLineRun = str_replace("@07", ($arrS['lv013']!="" || $arrS['lv013']!=NULL)?formatdate($arrS['lv013'],$plang):"-", $vLineRun);
				$vLineRun = str_replace("@08", ($arrS['lv003']!="" || $arrS['lv003']!=NULL)?$arrS['lv003']:"-", $vLineRun);
				$vLineRun = str_replace("@09",$arrS['ItemName'], $vLineRun);				
				$vLineRun = str_replace("@10",($arrS['lv009']!="" || $arrS['lv009']!=NULL)?$arrS['lv009']:"-", $vLineRun);	
				$vLineRun = str_replace("@11",($arrS['lv010']!="" || $arrS['lv010']!=NULL)?$arrS['lv010']:"-", $vLineRun);	
				$vLineRun = str_replace("@12",($arrS['lv011']!="" || $arrS['lv011']!=NULL)?$arrS['lv011']:"-", $vLineRun);	
				$sumLine=0;
				$vLineRun=str_replace("@99",$this->BuilCategorySizeDetail($lvArrCateSize,$lvArrChildSize,$maxCol,$arrS['lv002'],$arrS['lv003'],$arrS['lv009'],$arrS['lv010'],$arrS['lv011'],$arrS['lv013'],$sumLine),$vLineRun);
				$vLineRun = str_replace("@05", $sumLine, $vLineRun);
				switch($stropt)
				{
					case 2:
						$vLineRun = str_replace("@20", '', $vLineRun);	
						break;
					case 3:
					$vLineRun = str_replace("@20", '', $vLineRun);	
					//	$vLineRun = str_replace("@20", $this->GetBuildTableInputOutputDetail($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);	
						break;
					case 4:
					$vLineRun = str_replace("@20", '', $vLineRun);	
					
						//$vLineRun = str_replace("@20", $this->GetBuildTableInputOutputDetailStyle($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);	
						break;
					default:
					$vLineRun = str_replace("@20", '', $vLineRun);	
					//	$vLineRun = str_replace("@20", $this->GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);					
					break;
				}

				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}
	  $sqlS = "select * from sl_lv0014 ";		
		//$strExpportAll=$strExpportAll.$this->SumSQLRun($sqlS,8,$vArrLang[14],$plang);	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Order
		$vHeader = str_replace("@02", "ORDER", $vHeader);
		//lv003
		$vHeader = str_replace("@03", "PO#", $vHeader);
		//Stock lv002
		$vHeader = str_replace("@04", "SHIP TO", $vHeader);
		//Unit
		$vHeader = str_replace("@05","ORDERED QTY", $vHeader);
		//Fist
		$vHeader = str_replace("@06", "SHIP MODE", $vHeader);
		//Input Mlv001dle
		$vHeader = str_replace("@07", "OB DATE", $vHeader);
		//Output Mlv001dle
		$vHeader = str_replace("@08","STYLE#", $vHeader);
		//Last
		$vHeader = str_replace("@09","STYLE NAME", $vHeader);		
		$vHeader = str_replace("@10","COLOR", $vHeader);	
		$vHeader = str_replace("@11","CUT#", $vHeader);	

		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}	
	function BuilCategorySize(&$lvArrCateSize,&$lvArrChildSize,&$maxCol,&$rowline,&$rowts)
	{
		//Khai bao mang chua type size
		$vRowFirst="
			<tr>
				<td class=\"htable\" width=\"3%\" >&nbsp;</td>
				<td class=\"htable\" width=\"8%\" >&nbsp;</td>
				<td class=\"htable\" width=\"*%\" >&nbsp;</td>
				<td class=\"htable\" width=\"5%\" >&nbsp;</td>
				<td class=\"htable\" width=\"4%\" >&nbsp;</td>
				<td class=\"htable\" width=\"4%\" >&nbsp;</td>
				<td class=\"htable\" width=\"4%\" >&nbsp;</td>				
				<td class=\"htable\" width=\"4%\" >&nbsp;</td>
				<td class=\"htable\" width=\"4%\" >&nbsp;</td>				
				<td class=\"htable\" width=\"4%\" >&nbsp;</td>
				@01
			</tr>
			";
		$vColFill="<td class=\"htable\" >@01</td>";
		$vsql="select *,(select count(B.lv001) from sl_lv0030 B where B.lv002=A.lv001) numrow  from sl_lv0029 A order by numrow desc";
		$i=0;
		$rowts="";
		$bResultS = db_query($vsql);
		while($arrS=db_fetch_array($bResultS)){	
		$lvArrCateSize[$arrS['lv001']]=$i;
		$lvchildslq="select lv003 from sl_lv0030 where lv002='".$arrS['lv001']."' order by lv003 asc";
		$vchildResultS = db_query($lvchildslq);
			$j=0;
			if($i==0) $maxCol=$arrS['numrow'];
			$line="";
			$max=0;
			$line=$line.str_replace("@01",$arrS['lv002'],$vColFill);
			while($childarrS=db_fetch_array($vchildResultS)){	
			$line=$line.str_replace("@01",$childarrS['lv003'],$vColFill);
			$lvArrChildSize[$i][$j]=$childarrS['lv003'];
			$j++;
			$max++;
			}
			if($maxCol>$max) 
			{
				for($z=$max;$z<$maxCol;$z++)
				{
					$line=$line.str_replace("@01","&nbsp;",$vColFill);
				}
			}
			
			$rowline=$rowline.str_replace("@01",$line,$vRowFirst);
		$i++;
		}
		$rowts="<td class=\"htable\" >SCALE</td>";
		for($z=1;$z<=$maxCol;$z++)
		{
			$rowts=$rowts.str_replace("@01","s".$z,$vColFill);
		}
		
	}
	function BuilCategorySizeDetail($lvArrCateSize,$lvArrChildSize,$maxCol,$dklv002,$dklv003
,$dklv009,$dklv010,$dklv011,$dklv013,&$sumLine)
	{
		$vArrColFill= array();
		//Khai bao mang chua type size
		$vColFill="<td class=\"left_style\">@01</td>";
		$vsql="select lv012,lv004 from sl_lv0014 where lv002='$dklv002' and lv003='$dklv003' and lv009='$dklv009' and lv010='$dklv010' and lv011='$dklv011' and lv013='$dklv013' order by lv012 asc";
		$i=0;
		$line="";
		$bResultS = db_query($vsql);
		while($arrS=db_fetch_array($bResultS)){	
			$vArrColFill[$arrS['lv012']]=$arrS['lv004'];
			$sumLine=$sumLine+$arrS['lv004'];
			/*while($childarrS=db_fetch_array($vchildResultS)){	
			$line=$line.str_replace("@01",$childarrS['lv003'],$vColFill);
			$lvArrChildSize[$i][$j]=$childarrS['lv003'];
			$j++;
			$max++;
			}*/

		$i++;
		}
		for($i=0;$i<$maxCol;$i++)
		{
			//echo $vColFill[($lvArrChildSize[($lvArrCateSize[$dklv011])][$i])];
			$strvalue=$vArrColFill[($lvArrChildSize[($lvArrCateSize[$dklv011])][$i])];
			if($strvalue=="" || $strvalue==NULL) $strvalue="&nbsp;";
			$line=$line.str_replace("@01",$strvalue,$vColFill);
		}
		return $line;
		
	}
//////////////////////////////////SumSQLRun////////////////////////////
	function SumSQLRun($vSQL,$vColpan,$vLang,$plang)
	{
		$vtr="<tr onDblClick=\"this.innerHTML=''\" style=\"cursor:move;font-size:20px;font-weight:bold\"><td class=\"right_hr\" colspan=\"$vColpan\" valign=\"top\" >$vLang: @01</td></tr>";
		$bResultS = db_query($vSQL);
		$vValue="";
		while($arrS=db_fetch_array($bResultS)){		
			if($vValue=="") $vValue=Lcurrency($arrS['SumQty'],$plang).$arrS['Unitlv002'];
			else $vValue=$vValue." ; ".Lcurrency($arrS['SumQty'],$plang).$arrS['Unitlv002'];
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
	public function LV_LinkField($vFile,$vSelectlv001)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectlv001),2));
	}
	private function sqlcondition($vFile,$vSelectlv001)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  sl_lv0001 ";
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
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  sl_lv0029";
				break;
		}
		return $vsql;
	}
	public  function getvaluelink($vFile,$vSelectlv001)
	{
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  sl_lv0001 where lv001='$vSelectlv001'";
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
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  sl_lv0029 where lv001='$vSelectlv001'";
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
		while($row= db_fetch_array($lvResult)){
		return ($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
		}
		
	}
}
	?>