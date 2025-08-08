<?php
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
$lvhr_lv0211=new hr_lv0211($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0211');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","HR0045.txt",$plang);

$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvhr_lv0211->lv001=InsertWithCheckExt('hr_lv0210', 'lv001', '',0);
$lvhr_lv0211->lv002=$_POST['txtlv002'];
$lvhr_lv0211->lv003=$_POST['txtlv003'];
$lvhr_lv0211->lv004=$_POST['txtlv004'];
$lvhr_lv0211->lv005=$_POST['txtlv005'];
$lvhr_lv0211->lv006=$_POST['txtlv006'];
$lvhr_lv0211->lv007=$_POST['txtlv007'];
$lvhr_lv0211->lv008=$_POST['txtlv008'];
$lvhr_lv0211->lv009=$_POST['txtlv009'];
if($vFlag==1)
{
		
		$vresult=$lvhr_lv0211->LV_Insert();
		if($vresult==true) {
			$vStrMessage=$vLangArr[12];
			$vFlag = 1;	
		} else{
			$vStrMessage=$vLangArr[13].sof_error();		
			$vFlag = 0;
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>MINH PHUONG</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascripts/lvscriptfunc.js"></script>
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
		//o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo  $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,13,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		o.txtlv007.value=getChecked(o.chklv007.value,'chklv007');
		if(o.txtlv001.value=="")
		{
			alert("<?php echo $vLangArr[21];?>");
			o.txtlv001.select();
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
-->
</script>
<?php
if($lvhr_lv0211->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[0];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" method="post" enctype="multipart/form-data" name="frmadd">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo 'Mã tự động';?></td>
								<td width="*%"  height="20px">
									<input class="norequired" name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvhr_lv0211->lv001;?>" tabindex="5" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo 'Tên tài liệu';?></td>
							  <td  height="20px"><input class="norequired" name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvhr_lv0211->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo 'Loại tại liệu';?></td>
							  <td  height="20px">
									<select class="norequired" name="txtlv003" type="text" id="txtlv003"  tabindex="6" style="width:80%" onKeyPress="return CheckKey(event,7)">
								  	<?php echo $lvhr_lv0211->LV_LinkField('lv003',$lvhr_lv0211->lv003);?> 
								  	</select>
							
							</td>
						  	</tr>								
							<tr>
							  <td  height="20px"><?php echo 'Dung lượng tập tin';?></td>
							  <td  height="20px"><input class="norequired" name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvhr_lv0211->lv004;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo 'Quyền truy cập';?></td>
							  <td  height="20px">
							  		<input class="norequired" name="txtlv007" type="hidden" id="txtlv007" value="<?php echo $lvhr_lv0211->lv007;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							  	<?php echo $lvhr_lv0211->GetBuilCheckShift($lvhr_lv0211->lv007,'chklv007',10,'hr_lv0151','lv002');?>
							  </td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo 'Thứ tự';?></td>
							  <td  height="20px"><input class="norequired" name="txtlv009" type="text" id="txtlv009" value="<?php echo $lvhr_lv0211->lv009;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
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
				  </form>	

				
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
	var o=document.frmadd;
		o.txtlv003.focus();
</script>
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