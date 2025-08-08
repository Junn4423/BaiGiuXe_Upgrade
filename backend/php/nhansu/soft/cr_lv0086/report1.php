<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../images/employees/";
//require_once("../../clsall/sp_lv0008.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sp_lv0008.php");
//////////////init object////////////////
$lvsp_lv0008=new sp_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sp0008');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$vColor=Array(0=>'black',1=>'red',2=>'blue');
$lvsp_lv0008->lv001= $_GET['ID'];
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SP0012.txt",$plang);
$mosp_lv0008->lang=strtoupper($plang);
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);

$lvsp_lv0008->LV_LoadID($lvsp_lv0008->lv001);
$lvsp_lv0008->lv029ex='';
if($lvsp_lv0008->GetApr()==0)  $lvsp_lv0008->lv029ex=$lvsp_lv0008->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script></head>
<script language="javascript">
<!--
function isphone(s){
	if(s!=""){
		var str="0123456789. ()-"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmedit;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmedit;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.action="?func=<?php echo $_GET['func'];?>&ID=<?php echo  $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmedit;
		if(o.txtlv002.value==""){
			alert("<?php echo $vLangArr[61];?>");
			o.txtlv002.focus();
			}	
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}

-->
</script>
<?php
if($lvsp_lv0008->GetRpt()>0)
{
?>
<body onkeyup="KeyPublicRun(event)">
<center>
<div id="content_child" style="width:800px" >
  <div class="story">
  
    <h3>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td align="right"><?php echo ($lvsp_lv0008->lv036==1)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mo->lv001."'>":"";?>
			</td>
			
		  </tr>	
		  <tr>
		  <td> <h2 id="pageName"><center> <?php echo $vLangArr[14];echo "BÁO CÁO CHI TIẾT KẾ HOẠCH ";?></center></h2>
		 </td></tr>
			<tr>
				<td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
						<table width="800" border="0" align="center" class="table1">
							 
							<tr>
								<td width="150"  height="20"><?php echo $vLangArr[15];?></td>
								<td width="200"  height="20">
								<?php echo $lvsp_lv0008->lv001;?></td>
								<td colspan="2">
									<div style="background:<?php echo $vColor[$lvsp_lv0008->lv036]?>;color:white;width:20;height:20px;padding:5px;float:left;margin-right:5px;">KH</div>
									<div style="background:<?php echo $vColor[$lvsp_lv0008->lv037]?>;color:white;width:20;height:20px;padding:5px;float:left;margin-right:5px;">HQ</div>
									<div style="background:<?php echo $vColor[$lvsp_lv0008->lv038]?>;color:white;width:20;height:20px;padding:5px;float:left;margin-right:5px;">VC</div>
									<div style="background:<?php echo $vColor[$lvsp_lv0008->lv039]?>;color:white;width:20;height:20px;padding:5px;float:left;margin-right:5px;">KT</div>
								</td>
							</tr>
							<tr>
								<td width="150"   height="20"><?php echo $vLangArr[16];?></td>
								<td width="200"  height="20"><?php echo $lvsp_lv0008->lv002;?></td>
								<td  width="150" height="20"><?php echo $vLangArr[17];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv003;?></td>
							<tr>
								<td  height="20"><?php echo $vLangArr[18];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv004;?></td>
								<td  height="20"><?php echo $vLangArr[19];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv005;?>
								</td>
							</TR>
							<TR>
								<td  height="20"><?php echo $vLangArr[20];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv006;?></td>
							
								<td  height="20"><?php echo $vLangArr[21];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->FormatView($lvsp_lv0008->lv007,4);?>
								</td>
								</tr>	
							<tr>
								<td  height="20"><?php echo $vLangArr[22];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv008;?></td>
								<td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><?php echo $lvsp_lv0008->FormatView($lvsp_lv0008->lv009,4);?></td>
							</tr>
							<tr>
								
								<td height="20"><?php echo $vLangArr[39];?></td>
								<td height="20">
									<?php echo $lvsp_lv0008->lv025;?>
								</td>
								<td  height="20"><?php echo $vLangArr[38];?></td>
								<td  height="20">
									<?php echo $lvsp_lv0008->lv024;?>
											</td>
							</tr>
								<tr>
								<td  height="20"><?php echo $vLangArr[26];?></td>
								<td  height="20"><?php echo (float)$lvsp_lv0008->lv012;?></td>
								<td  height="20"><?php echo $vLangArr[27];?></td>
								<td  height="20">
									<?php echo $lvsp_lv0008->getvaluelink('lv013',$lvsp_lv0008->lv013);?></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[28];?></td>
								<td  height="20"><?php echo (float)$lvsp_lv0008->lv014;?></td>
								<td  height="20"><?php echo $vLangArr[29];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->getvaluelink('lv013',$lvsp_lv0008->lv015);?>						    </td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[42];?></td>
								<td  height="20">
									  <?php echo $lvsp_lv0008->getvaluelink('lv028',$lvsp_lv0008->lv028);?>
									 </td>
								<td  height="20"><?php echo $vLangArr[30];?></td>
								<td  height="20" colspan="3">
							  	<?php echo $lvsp_lv0008->getvaluelink('lv016',$lvsp_lv0008->lv016);?>
								</td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[63];?></td>
								<td  height="20" colspan="3"><?php echo $lvsp_lv0008->lv048;?></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[54];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->Formatview($lvsp_lv0008->lv041,4);?></td>
								<td  height="20"><?php echo $vLangArr[58];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv045;?></td>
							</tr>
							<tr>
								<td  height="20" colspan="4"><div class="lv_gachchia">Thông tin tờ khai</div></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[24];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv010;?></td>
								<td  height="20"><?php echo $vLangArr[25];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->FormatView($lvsp_lv0008->lv011,4);?>
								</td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[49];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->getvaluelink('lv035',$lvsp_lv0008->lv035);?></td>
								<td  height="20"><?php echo $vLangArr[64];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv049;?></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[55];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->Formatview($lvsp_lv0008->lv042,4);?></td>
								<td  height="20"><?php echo $vLangArr[59];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv046;?></td>
							</tr>
							<tr>
								<td  height="20" colspan="4"><div class="lv_gachchia">Thông tin vận chuyển</div></td>
							</tr>
							<tr>
								
								<td height="20"><?php echo $vLangArr[40];?></td>
								<td height="20">
									<?php echo $lvsp_lv0008->lv026;?></td>
									</td>
								<td  height="20"><?php echo $vLangArr[41];?></td>
								<td  height="20">
									<?php echo $lvsp_lv0008->lv027;?>
											</td>
							</tr>
							<tr>
								<td height="20"><?php echo $vLangArr[33];?></td>
								<td height="20">
									<?php echo $lvsp_lv0008->lv019;?>
							  			</td>
							  <td  height="20"><?php echo $vLangArr[43];?></td>
							  <td  height="20">
									  <?php echo $lvsp_lv0008->getvaluelink('lv029',$lvsp_lv0008->lv029);?></select></td>
							</tr>					
							<tr>
								<td  height="20"><?php echo $vLangArr[31];?></td>
								<td  height="20">
								<?php echo $lvsp_lv0008->getvaluelink('lv017',$lvsp_lv0008->lv017);?>
								
							    </td>
							  <td  height="20"><?php echo $vLangArr[32];?></td>
							  <td  height="20">
								<?php echo $lvsp_lv0008->getvaluelink('lv018',$lvsp_lv0008->lv018);?></td>
								
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[34];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv020;?></td>
								<td  height="20"><?php echo $vLangArr[35];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv021;?>
								</td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[36];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv022;?>
								</td>
							  <td  height="20"><?php echo $vLangArr[37];?></td>
							  <td  height="20"><?php echo $lvsp_lv0008->lv023;?>
							  </td>
							</tr>									  
							<tr>  
							  <td  height="20"><?php echo $vLangArr[44];?></td>
							  <td  height="20"><?php echo $lvsp_lv0008->getvaluelink('lv030',$lvsp_lv0008->lv030);?></td>
								
							</tr>		
							<tr>
								<td height="20"><?php echo $vLangArr[45];?></td>
								<td height="20"><?php echo $lvsp_lv0008->lv031;?>
								</td>
								<td  height="20"><?php echo $vLangArr[48];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv034;?></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[47];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv033;?></td>
								<td  height="20"><?php echo $vLangArr[46];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv032;?></td>
								
							</tr>	
							<tr>
								<td  height="20"><?php echo $vLangArr[64];?></td>
								<td  height="20" colspan="3"><?php echo $lvsp_lv0008->lv050;?></td>
							</tr>
								<tr>
								<td  height="20"><?php echo $vLangArr[56];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->Formatview($lvsp_lv0008->lv042,4);?></td>
								<td  height="20"><?php echo $vLangArr[60];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv046;?></td>
							</tr>	
							<tr>
								<td  height="20" colspan="4"><div class="lv_gachchia">Thông tin kế toán</div></td>
							</tr>
							
							<tr>
								<td  height="20"><?php echo $vLangArr[65];?></td>
								<td  height="20" colspan="3"><?php echo $lvsp_lv0008->lv051;?></td>
							</tr>
							<tr>
								<td  height="20"><?php echo $vLangArr[57];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->Formatview($lvsp_lv0008->lv043,4);?></td>
								<td  height="20"><?php echo $vLangArr[61];?></td>
								<td  height="20"><?php echo $lvsp_lv0008->lv047;?></td>
							</tr>	
							<tr>
							  <td  height="20" colspan="3"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							 <tr>
								<td colspan="4">
								<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20">&nbsp;</td>
						<td width="150">&nbsp;</td>
						<td width="20">&nbsp;</td>
						<td width="150">&nbsp;</td>
						<td width="20">&nbsp;</td>
						<td width="143">&nbsp;</td>
						<td width="20">&nbsp;</td>
						<td width="117">&nbsp;</td>
						<td width="20">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td style="text-align:center" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b>NV KH</b></span></b></td>
						<td>&nbsp;</td>
						<td style="text-align:center" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b>NV HQ</b></span></b></td>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b>NV VC</b></span></b></td>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b>NV KT</b></span></b></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="120px"><td colspan="7">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<40; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<40; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<40; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<40; $i++) echo ".";?></td>
						<td>&nbsp;</td>
					</tr>
				</table></td>
				<tr>
  </tr>
        <TBODY>
       
					  </table>
					</form>	

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td>
			</tr>
		</table>
	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript"> /*var o=document.frmedit; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);*/
		o.txtlv001.focus();
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
</center>
</body>
</html>