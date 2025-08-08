<?php
class lv_toolodbc
{
/////set odbc//////////
var $dsn=null;
var $username=null;
var $password=null;
var $owner=null;
//object connection
var $odbcconnect=null;
/////set database local run///////
var $LCDatabase=null;
var $LCCommand=null;//Dùng để sử dụng lệnh trỏ data base về.
var $LCOpt=null;//Dùng để điều khiển lấy cấu trúc và data 0:Copy structure;1:Copy data; 2:Copystructure and data.
///////////////Template
var $vdropdb="drop table if exists @01;";
var $vtabledb="CREATE TABLE @01 (@02) CHARSET=utf8";
var $vPK="PRIMARY KEY  (@01)";
var $vInsert="insert  into @01 values(@02)";
/////////////////////////
var $isExist=null;
	function lv_toolodbc()
	{
		$this->isExist=-1;
		
	}
	function setconnect($vdsn,$vusername,$vpassword,$vodbcfile)
	{
		$this->dsn=$vdsn;
		$this->username=$vusername;
		$this->password=$vpassword;
		//echo "Driver={Microsoft Access Driver (*.mdb)};Dbq=$vodbcfile;";
		$this->odbcconnect=odbc_connect("Driver={Microsoft Access Driver (*.mdb)};Dbq=$vodbcfile;", $this->username, $this->password);
		return $this->odbcconnect;
	}
	function SetDataTranfer($vLCDatabase,$vLCCCommand,$vLCOpt)
	{
		$this->LCDatabase=$vLCDatabase;
		$this->LCCCommand=$vLCCCommand;
		$this->LCOpt=$vLCOpt;
	}
	function SetOwner($vOwner)
	{
		$this->owner=$vOwner;
	}
	function mssql_tables($vTable,$vowner,$TypeTable)
	{	
		return odbc_tables($this->odbcconnect,$vTable,$vowner,'',$TypeTable);
	}
	function mssql_columns($vTable,$vowner)
	{	
		return odbc_columns($this->odbcconnect,'',$vowner,$vTable);
	}
	function mssql_sp_pkeys($vTable,$vowner)
	{	
		return odbc_primarykeys($this->odbcconnect,'',$vowner,$vTable);
	}	
	function mssql_exec($vsql)
	{
		return odbc_exec($this->odbcconnect,$vsql);
	}
	function mssql_fetch_arrays($vobj)
	{
		return odbc_fetch_array($vobj);
	}
	function mssql_num_field($vobj)
	{
		return odbc_num_fields($vobj);
	}
//Lấy dữ liệu vào mãng để xử lý dữ liệu
	function GetDataSource()
	{
			$vID='';
			$j=0;
			$vArray=array();
			$vResultTbl=$this->mssql_tables('',$this->owner,'TABLE');
			while ($tbl=odbc_fetch_array($vResultTbl))
			{
			$vArray[$j]=$tbl['TABLE_NAME']."@".$tbl['TABLE_CAT']."@".$tbl['TABLE_SCHEM'];
			$j++;
			//if($j>=10) break;
			}
			return $vArray;
	}	
//Thực thi cập nhật dữ liệu bảng
	function PushCheckData($vTable)
	{
		switch($this->LCOpt)
		{
			case 0:
				
				$this->buildata($vTable);
				break;
			case 1:
				$this->buildata($vTable);
				break;
			case 2:
				$this->buildata($vTable);
				break;
		}
	}	
//Thực thi  cậyp nhật tất cả các bảng nếu tồn tại	
	function ExcTranferData()
	{
			$vID='';
			$j=0;
			$vResultTbl=odbc_tables($this->odbcconnect,'',$this->owner);
			//odbc_result_all($process11);
			while ($tbl=odbc_fetch_array($vResultTbl))
			{
				$vResultClm=odbc_columns($this->odbcconnect,$tbl['TABLE_CAT'],$tbl['TABLE_SCHEM'],$tbl['TABLE_NAME']);
				$vRs=odbc_primarykeys($this->odbcconnect,'','',$tbl['TABLE_NAME']);
				$vID="";
				//odbc_result_all($vRs);
				while($vn=odbc_fetch_array($vRs))
				{
					if($vID=="") $vID= "`".$vn['COLUMN_NAME']."`";
					else $vID= $vID.",`".$vn['COLUMN_NAME']."`";					
				}
				$strTb=$this->Builtable($tbl['TABLE_NAME'],$vResultClm,$vID);
				db_query($strTb);
				$this->buildata($tbl['TABLE_NAME']);
			$j++;
			//if($j>=10) break;
			}	

	}
	//tạo table nếu bảng dữ liệu chưa tồn tại
	function CreateTable($vTable,$vOwner,$vDrop)	
	{
//			$vResultTbl=odbc_tables($this->odbcconnect,'',$this->owner,'','TABLE');
			//odbc_result_all($vResultTbl);
			$vResultClm=$this->mssql_columns($vTable,$vOwner);
			$vRs=$this->mssql_sp_pkeys($vTable,$vOwner);
			$vID="";
			while($vn=odbc_fetch_array($vRs))
			{
				if($vID=="") $vID= "`".$vn['COLUMN_NAME']."`";
				else $vID= $vID.",`".$vn['COLUMN_NAME']."`";					
			}
			$strTb=$this->Builtable($vTable,$vResultClm,$vID);
			if($vDrop==true) 
			{
				$strdropdb=str_replace('@01',$vTable,$this->vdropdb);
				db_query($strdropdb);
			}
			$strTb=$strTb;
			db_query($strTb);		
			$this->buildata($vTable);
			
	}

	function Builtable($vTableName,$vArrColum,$vPKey)
	{
		//Buil từng columm
		$strCol="";
		$linePKey="";
		while ($vrow=odbc_fetch_array($vArrColum))
		{
			$lineCol="`".$vrow['COLUMN_NAME']."`"." ".(($vrow['TYPE_NAME']=="bit")?"tinyint":$vrow['TYPE_NAME'])."(".(($vrow['LENGTH']=="" || $vrow['LENGTH']==NULL)?"28":$vrow['LENGTH']).(($vrow['SCALE']=="" || $vrow['SCALE']==NULL)?"":$vrow['SCALE']).") ".(($vrow['NULLABLE']==1)?"NULL":"NOT NULL") ;
			if($strCol=="") $strCol=$strCol.$lineCol;
			else $strCol=$strCol.",".$lineCol;
		}
		if($vPKey!="" && $vPKey!=NULL)
		{
		$linePKey=str_replace("@01",$vPKey,$this->vPK);
		$strCol=$strCol.",".$linePKey;
		}
		$strReturn=str_replace("@02",$strCol,str_replace("@01",(($this->LCDatabase==""?"":$this->LCDatabase.".")).$vTableName,$this->vtabledb));
		return $strReturn;
	}
	function buildata($vTableName)
	{
		$vResultRow=odbc_exec($this->odbcconnect,"select * from ".$vTableName);
		$i=0;
		while(odbc_fetch_row($vResultRow)){
			$strBuil="";
			for($i=1;$i<=odbc_num_fields($vResultRow);$i++){
				if($strBuil=="") $strBuil= $this->getValue(odbc_result($vResultRow,$i));
				else $strBuil= $strBuil.",".$this->getValue(odbc_result($vResultRow,$i));
			}
			$strInsert=str_replace("@02",$strBuil,str_replace("@01",(($this->LCDatabase==""?"":$this->LCDatabase.".")).$vTableName,$this->vInsert));
			db_query($strInsert);
			
		}
	}
	function getValue($vStr)
	{
		if(is_null($vStr)) return 'null';
		if(is_int($vStr) || is_real($vStr) || is_long($vStr) || is_integer($vStr) || is_numeric($vStr) ) return $vStr;
		return "'".sof_escape_string($vStr)."'";
	}
	
}
?>
