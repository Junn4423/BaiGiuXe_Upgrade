<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
//require_once("../../clsall/hr_lv0211.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0211.php");
//////////////init object////////////////
$lvhr_lv0211=new hr_lv0211($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'HR0211');
/////////Get ID///////////////
$lvhr_lv0211->lv001=$_GET['ChildID'];
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","SL0322.txt",$plang);

$vFlag   = (int)($_POST['txtFlag'] ?? 0);

$vStrMessage="";

if($vFlag==1)
{
		$lvhr_lv0211->lv002=$_POST['qxtlv002'];
		$lvhr_lv0211->lv003=$_POST['qxtlv003'];
		$lvhr_lv0211->lv004=$_POST['qxtlv004'];
		$lvhr_lv0211->lv005=$_POST['qxtlv005'];
		$lvhr_lv0211->lv006=$_POST['qxtlv006'];
		$lvhr_lv0211->lv007=$_POST['qxtlv007'];
		$lvhr_lv0211->lv008=$_POST['qxtlv008'];
		$vresult=$lvhr_lv0211->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[14];
			$vFlag=1;
		} else{
			$vStrMessage=$vLangArr[15].sof_error();
			$vFlag=0;
		}

}
function UploadImg($folder_name, $fname){
	$maxsize = 10485760;//Max file size 30KMB
	$path = "../../images/human/File/customers/";
	$arrName = explode(".", $fname);
		$fname = $arrName[0];///Get name without extention of file
	if(create_folder($path, $folder_name)==true || is_dir($path.$folder_name)){
		$path = $path.$folder_name."/";
		$result = upload_file($fpath, $fname, $path, $maxsize);
		if($result==1){
			$message = "Image uploaded successfully!";
			//$vFlag = 2;//Upload successful.
			//$fpath = "";
			//$fname = "";
		}
		if($result==2)
			$message = "Incorrect file type!";
		if($result==3 || $result==4)
			$message = "Image size is very small or big!";
		if($result==5 || $result==6)
			$message = "Error in uploading file, please try again!";
	}
  else
	{
		$path = $path.$folder_name."/";
		$result = upload_file($fpath, $fname, $path, $maxsize);
		if($result==1){
			$message = "Image uploaded successfully!";
			//$vFlag = 2;//Upload successful.
			//$fpath = "";
			//$fname = "";
		}
		if($result==2)
			$message = "Incorrect file type!";
		if($result==3 || $result==4)
			$message = "Image size is very small or big!";
		if($result==5 || $result==6)
			$message = "Error in uploading file, please try again!";
	}
}
$lvhr_lv0211->LV_LoadID($lvhr_lv0211->lv001);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>MINH PHUONG</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascripts/engines.js"></script>
</head>
<script language="javascript">
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
		var o=document.frmedit;
		o.qxtlv003.value="<?php echo $lvhr_lv0211->lv003;?>";
		o.qxtlv004.value="<?php echo $lvhr_lv0211->lv004;?>";
		o.qxtlv005.value="<?php echo $lvhr_lv0211->lv005;?>";
		o.qxtlv006.value="<?php echo $lvhr_lv0211->lv006;?>";			
		o.qxtlv002.focus();
	}
	function Cancel()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,5,0)?>";
		o.submit();
	}
		function Save()
	{
		var o=document.frmedit;
		o.qxtlv008.value=getChecked(o.chklv008.value,'chklv008');
		if(o.qxtlv003.value==""){
			alert("<?php echo 'Type document is not empty!';?>");
			o.qxtlv003.focus();
			}
		else if(o.qxtlv004.value==""){
			alert("<?php echo 'Name document is not empty!';?>");
			o.qxtlv004.focus();
			}
		else
			{
			o.txtFlag.value="1";
			o.submit();
			}
			
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
					str=div.value;
				else
					 str=str+','+div.value;
				}
			
			}
			return str;
		}
</script>
<?php
if($lvhr_lv0211->GetEdit()>0)
{
?>
<body >
<div id="content_child">
    <h2 id="pageName"><?php echo $vLangArr[9];?></h2>
  <div class="story">
						<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form name="frmedit" id="frmedit" action="#" method="post" enctype="multipart/form-data">
					<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" class="table1">
							<tr><td colspan="2" align="center">
					<?php		
						echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
						?>
							</td></tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[15];?></td>
								<td width="*"  height="20px">
									<input class="norequired" name="qxtlv001" type="text" id="qxtlv001"  value="<?php echo $lvhr_lv0211->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
				 			 	<td  height="20px"><input class="norequired" name="qxtlv002" type="text" id="qxtlv002" value="<?php echo $lvhr_lv0211->lv002;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								</td>
						  </tr>		
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
				 			 	<td  height="20px"><select class="norequired" name="qxtlv003"  id="qxtlv003"  tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  		<?php echo $lvhr_lv0211->LV_LinkField('lv003',$lvhr_lv0211->lv003);?>
							  		</select>	
								</td>
						  </tr>								
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><input class="norequired" name="qxtlv004" type="text" id="qxtlv004" value="<?php echo $lvhr_lv0211->lv004;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px">
							<?php 	
							$lvImg="<a target='_blank' href='../hr_lv0211/readfile.php?FileID=".$lvhr_lv0211->lv001."&type=8&size=0'><div style='border-radius:5px;background:#aaa;padding:4px;color:#000;width:40px;text-align:center;'>View</div></a>";
							$vstr='
							<table valign=\"top\" style=\"width:100%\">
								<tr>
								
								
									<td title=\"Download file pdf\">
									<div id="framupload_8_'.$lvhr_lv0211->lv001.'" style="width:116px">
										<iframe  height=24 width="100%" marginheight=0 marginwidth=0 frameborder=0 src="../hr_lv0211/?childfunc=upload&ViTriUp=8&FileID='.$lvhr_lv0211->lv001.'&lang='.$plang.'"></iframe>
									</td>
									<td align=\"center\">
									<div style=\"text-align:center\" id="attachfile_8_'.$lvhr_lv0211->lv001.'">'.$lvImg.'</div>
								</td>
								</tr>
							</table>	
									';
									echo $vstr;
							?>	  
							</td>
							</tr>
							<tr>
							  	<td  height="20px"><?php echo $vLangArr[20];?></td>
							  	<td  height="20px">
								  	<select class="norequired" name="qxtlv006"  id="qxtlv006"  tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)">
				  						<?php echo $lvhr_lv0211->LV_LinkField('lv006',$lvhr_lv0211->lv006);?>
				  					</select>
								</td>
							</tr>	
							<tr>
							  	<td  height="20px"><?php echo $vLangArr[21];?></td>
							  	<td  height="20px">
								  <input type="checkbox" name="qxtlv007" id="qxtlv007" tabindex="7"  onKeyPress="return CheckKey(event,7)" value="1" <?php echo ($lvhr_lv0211->lv007==1)?'checked="true"':'';?>/>	
								</td>
							</tr>	
							  
							<tr>
							  <td  height="20px"><?php echo $vLangArr[22];?></td>
							  <td  height="20px">
								  <div style="width:80%">
							  		<input class="norequired" name="qxtlv008" type="hidden" id="qxtlv008" value="<?php echo $lvhr_lv0211->lv008;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							  	<?php echo $lvhr_lv0211->GetBuilCheckShift($lvhr_lv0211->lv008,'chklv008',10,'hr_lv0002','lv002');?>
								  </div>	
							  </td>
							</tr> 
							<tr>
							  <td  height="20px" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag" /></td>
						  </tr>
							<tr>
							  <td  height="20px" colspan="2"> <TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /><?php echo $vLangArr[2];?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove><?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					</form>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript"> /*var o=document.frmedit; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);*/
		o.qxtlv003.select();
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