<?php
session_start();
//require_once("../../clsall/tc_lv0046.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0046.php");
require_once("../../clsall/tc_lv0013.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/hr_lv0002.php");
require_once("../../clsall/tc_lv0002.php");
//////////////init object////////////////
$lvtc_lv0046=new tc_lv0046($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0046');
$lvtc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$lvtc_lv0002=new tc_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0002');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvtc_lv0013->LV_LoadActiveID();
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0095.txt",$plang);
$lvtc_lv0046->lang= strtolower($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvtc_lv0046->lv001=InsertWithCheckExt('tc_lv0046', 'lv001', '',1);
$lvtc_lv0046->lv002=$lvtc_lv0013->lv001;
$lvtc_lv0046->lv003=$_POST['txtlv003'];
$lvtc_lv0046->lv004=$_POST['txtlv004'];
$lvtc_lv0046->lv005=$_POST['txtlv005'];
$lvtc_lv0046->lv006=$_POST['txtlv006'];
$lvtc_lv0046->lv007=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$lvtc_lv0046->lv008=$_POST['txtlv008'];
$lvtc_lv0046->lv013=$_POST['txtlv013'];
$lvtc_lv0046->lv011=0;
if($vFlag==1)
{		
		$vresult=$lvtc_lv0046->LV_Insert();
		if($vresult==true) {
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}
else if($vFlag==2)
{
		$lvtc_lv0013->LV_LoadActiveID();
		$data = array();
  
  

	 $lvNow=GetServerDate()." ".GetServerTime();
	 if ( $_FILES['file']['tmp_name'] )
  	{
	
		$vArrItem=Array();
		$row1=1;
	  $dom=new DOMDocument();
	  	$dom->load( $_FILES['file']['tmp_name'] );
	  $rows = $dom->getElementsByTagName( 'Row' );
	  $first_row = true;
	  $vColItem=0;
	  $vRowItem=0;
	  foreach ($rows as $row)
	  {
		  
			  $first = "";
			  $middle = "";
			  $last = "";
			  $email = "";
			  
			  $index = 1;
			  $cells = $row->getElementsByTagName( 'Cell' );
			  foreach( $cells as $cell )
			  { 
			  $ind = $cell->getAttribute( 'Index' );
			  if($cell->nodeValue!=NULL && $cell->nodeValue!="" && $vColItem==0)
			  {
				$lvtc_lv0002->LV_LoadID(trim($cell->nodeValue));
				if($lvtc_lv0002->lv001!=NULL && $lvtc_lv0002->lv001!="") 
				{
					if($vColItem==0)
					{
						$vColItem= $index;
						$vRowItem=$row1;
					}
				}
			  }
			  $vArrItem[$row1][$index]=trim($cell->nodeValue);
			  $index++;
			  }
			 
		  
		$row1++;
		
  	}
	  for($s=$vRowItem+2;$s<=$row1;$s++)
		  {
			$lvhr_lv0020->LV_LoadID($vArrItem[$s][1]);
			if($lvhr_lv0020->lv001!=NULL && $lvhr_lv0020->lv001!="")
			{
			for($v=$vColItem;$v<=count($vArrItem[$s]);$v++)
			{
				if($vArrItem[$s][$v]!=0)
				{
					$lvtc_lv0002->LV_LoadID($vArrItem[$vRowItem][$v]);
					if($lvtc_lv0002->lv001!=NULL && $lvtc_lv0002->lv001!="") 
					{
						$lvtc_lv0046->lv002=$lvtc_lv0013->lv001;
						$lvtc_lv0046->lv003=$vArrItem[$vRowItem][$v];
						$lvtc_lv0046->lv004=$vArrItem[$s][$v];
						$lvtc_lv0046->lv005=$lvtc_lv0013->lv005;
						$lvtc_lv0046->lv006=$lvhr_lv0020->lv001;
						$lvtc_lv0046->lv007=getInfor($_SESSION['ERPSOFV2RUserID'],2);
						$lvtc_lv0046->LV_InsertAuto();
					}
				}

			}
			}
		  }
 
}
		if($vresult==true) {
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>

</head>
<script language="javascript">
<!--
function isnumber(s){
	if(s!=""){
		var str="0123456789"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					alert("<?php echo $vLangArr[21];?>")	
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmadd;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv007.value="";
		o.txtlv003.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		//o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,8,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv003.value=="")
		{
			alert("Mã ca đêm không rỗng");
			o.txtlv003.select();
		}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
	function SaveMul()
	{
		var o=document.frmadd;
		
				o.txtFlag.value=2;
				o.submit();

	}

-->
</script>
<?php
if($lvtc_lv0046->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[0];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmadd" method="post"  enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" id="table">
							<tr>
							  <td colspan="2" height="100%" align="center"><p>
							    <label>
							      <input type="radio" name="load-enter" value="0" id="load-enter_0" <?php echo ($loadenter==0)?'checked':'';?> onClick="changestate(1)">
							      Nhập từng sản phẩm
							    </label>
							    
							    <label>
							      <input type="radio" name="load-enter" value="1" id="load-enter_1" <?php echo ($loadenter==1)?'checked':'';?> onClick="changestate(2)">
							     Nạp sản phẩm từ tập tin
							    </label>
							    <br>
						      </p></td>
						  </tr>
                         </table>
						 <!---Load File-->                         
                         <div id="fileload" style="display:none">
                         <table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[31];?></td>
								<td width="*%"  height="20px">
									<input type="file" name="file" />			</td>
							</tr>															
							<tr>
							  <td  height="20px" colspan="2"><a href="SAP-PHAM-TRONG-THANG.zip" title="<?php echo $vLangArr[33];?>"><?php echo 'Tải mẫu';?></a></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
                                        <TBODY>
                                        <TR vAlign=center align=middle>
                                              <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:SaveMul();" tabindex="16"><img src="../images/controlright/save_f2.png" 
                                            alt="Save" title="<?php echo $vLangArr[1];?>" 
                                            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
                                          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
                                            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
                                            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
                                          <TD nowrap="nowrap"><a class=lvtoolbar 
                                            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
                                            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
                                            name=remove> <?php echo $vLangArr[6];?></a></TD>
                                            </TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
                      </div>
<!---End Load File-->
<!---Enter New Line-->                      
                      <div id="enterline" style="display:block">
						<table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[15];?></td>
								<td width="*%"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvtc_lv0046->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvtc_lv0046->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
								<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px"><table width="80%"><tr><td width="50%"><select name="txtlv003" id="txtlv003"  tabindex="7" maxlength="50" style="width:100%" onKeyPress="return CheckKeys(event,7,this)">
							   <?php echo $lvtc_lv0046->LV_LinkField('lv003',$lvtc_lv0046->lv003);?>
                              </select>
							  </td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv003_search" id="txtlv003_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','tc_lv0002','lv002')" onFocus="LoadPopup(this,'txtlv003','tc_lv0002','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>						 </td>
						  </tr>	
						   <tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><input name="txtlv004" type="text" id="txtlv004" value="<?php echo (float)$lvtc_lv0046->lv004;?>" tabindex="8" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
						  <tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvtc_lv0046->FormatView(($lvtc_lv0046->lv005=="")?GetServerDate():$lvtc_lv0046->lv005,2);?>" tabindex="9" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
					        <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv005);return false;" /></span></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px">
							  <table width="80%"><tr><td width="50%"><input name="txtlv006" type="text" id="txtlv006"  value="<?php echo $lvtc_lv0046->lv006;?>" tabindex="6" maxlength="225" style="width:100%" onKeyPress="return CheckKey(event,7)" readonly="true"/>
							  </td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv006_search" id="txtlv006_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv006','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002,@!-@!,lv001)')" onFocus="LoadPopup(this,'txtlv006','hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002,@!-@!,lv001)')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table>	
					</td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[22];?>(Nếu giá lơn hơn 0 thì cách tính là Price*Quantity)</td>
							  <td  height="20px"><input name="txtlv008" type="text" id="txtlv008"  value="<?php echo $lvtc_lv0046->lv008;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					  </div>
					 <!---End Enter New Line--> 
			      </form>	

				
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
	var o=document.frmadd;
		o.txtlv012.focus();
</script>
<script language="javascript">
	function changestate(value)
	{
		var o1=document.getElementById('fileload');
		var o2=document.getElementById('enterline');
		if(value==2)
		{
			o1.style.display="block";
			o2.style.display="none";
			
		}
		else
		{
			o1.style.display="none";
			o2.style.display="block";
		}
	}
	changestate(<?php echo (int)$loadenter+1;?>)
	var o=document.frmadd;
		o.txtlv002.focus();
</script>
<script language="javascript" src="../../javascripts/menupopup.js"></script>
	<?php
	if($vFlag==1)
	{
	?>
	<script language="javascript">
	<!--
		Cancel();
	//-->
	</script>
	<?php
	}
	?>
<?php
} else {
	include("../permit.php");
}
?>
</body>
</html>