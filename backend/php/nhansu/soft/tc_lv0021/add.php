<?php
session_start();
//require_once("../../clsall/tc_lv0021.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0021.php");
require_once("../../clsall/tc_lv0013.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/hr_lv0038.php");

//////////////init object////////////////
$lvtc_lv0021=new tc_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0021');
$lvtc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
$lvhr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0038');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvtc_lv0013->LV_LoadID( $_GET['ID']);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../../","TC0039.txt",$plang);
$lvtc_lv0021->lang=strtoupper($plang.'');
$curPage = (int)($_POST['curPg'] ?? 1);	
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
$lvtc_lv0021->lv001=$_POST['txtlv001'];
$lvtc_lv0021->lv002=$_POST['txtlv002'];
$lvtc_lv0021->lv003=$_POST['txtlv003'];
$lvtc_lv0021->lv004=$_POST['txtlv004'];
$lvtc_lv0021->lv005=$_POST['txtlv005'];
$lvtc_lv0021->lv006=$_POST['txtlv006'];
$lvtc_lv0021->lv007=$_POST['txtlv007'];	
$lvtc_lv0021->lv008=$_POST['txtlv008'];
$lvtc_lv0021->lv009=$_POST['txtlv009'];
$lvtc_lv0021->lv010=$_POST['txtlv010'];
$lvtc_lv0021->lv011=$_POST['txtlv011'];
if($vFlag==2 && $lvtc_lv0013->lv001!=NULL)
{
	$data = array();
function add_person( $ArrField,$ArrList)
  {
  	global $data;
  	$i=1;
  	if(count($ArrField)>0)
  	{
	  	foreach($ArrField as $vField)
	  	{
	  		$vRowData[$vField]=$ArrList[$i];
	  		$i++;
	  	}
	  	$data []= $vRowData;
  	}
  }

	 $lvNow=GetServerDate()." ".GetServerTime();
	 if ( $_FILES['file']['tmp_name'] )
  	{
	  $dom=new DOMDocument();
	  	$dom->load( $_FILES['file']['tmp_name'] );
	  $rows = $dom->getElementsByTagName( 'Row' );
	  $first_row = true;
	  $DongDau=true;
	  foreach ($rows as $row)
	  {
	  	$ArrList=Array();
		  if ( !$first_row )
		  {
		  	if($DongDau)
		  	{
		  		$DongDau=false;	
		  	}
		  	else
		  	{
		  		$first = "";
			  	$middle = "";
			  	$last = "";
			  	$email = "";
			  
			  	$index = 1;
			  	$cells = $row->getElementsByTagName( 'Cell' );
			 	if($cells!=null)
	 	 		{
				  	foreach( $cells as $cell )
				  	{ 
					  //$ind = $cell->getAttribute( 'Index' );
					  //if ( $ind != null )
					  {
					  	$ArrList[$index]=$cell->nodeValue;
					  	$index += 1;
					  } 
			  	  	}	
			  	  	add_person($ArrField,$ArrList);
		  		}
	  			
		  	}
		  	
	 	 }
	 	 else
	 	 {
	 	 	$index=1;
	 	 	$cells = $row->getElementsByTagName( 'Cell' );
	 	 	$ArrField=Array();
	 	 	if($cells!=null)
	 	 	{
 	 			foreach( $cells as $cell )
		 		{ 
				 	//echo $ind = $cell->getAttribute( 'Index' );
				 	//if ( $ind != null )
				 	if($cell->nodeValue!=NULL && $cell->nodeValue!='' && $cell->nodeValue!='0')
				 	{ 
						$ArrField[$index]='lv'.Fillnum($cell->nodeValue,3);
						$index += 1;
				  	}
	  	  		}
		  	} 	
	 	 }
		  $first_row = false;
	  }
  	}
	$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
	global $data;
	foreach( $data as $row )
	{
		if(trim($row['lv002'])!="" && $row['lv002']!=NULL)
		{
			$lvhr_lv0020->LV_LoadID(trim($row['lv002']));
			if($lvhr_lv0020->lv001!=NULL && $lvhr_lv0020->lv001!='')
			{
				$vContractID=$lvhr_lv0038->LV_LoadHDMonth($lvhr_lv0020->lv001,$lvtc_lv0013->lv006,$lvtc_lv0013->lv007);
				$lvtc_lv0021->lv002=$row['lv002'];
				$lvtc_lv0021->lv003=$lvNow;
				$lvtc_lv0021->lv004=$lvtc_lv0013->lv004;
				$lvtc_lv0021->lv005=$lvtc_lv0013->lv005;
				$lvtc_lv0021->lv060=$lvtc_lv0013->lv001;
				$lvtc_lv0021->lv067=$lvtc_lv0013->lv015;
				$lvtc_lv0021->lv056=$vContractID;
				$vresult=$lvtc_lv0021->LV_InsertFieldFull($ArrField,$row);
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
<!-- TinyMCE -->
<script type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "txtlv010",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
		
	});
		
</script>
</head>
<script language="javascript">
<!--
function isphone(s){
	if(s!=""){
		var str="0123456789.()-"
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
		var o=document.frmadd;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv001.focus();
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
	function SaveMul()
	{
		var o=document.frmadd;
		o.txtFlag.value=2;
		o.submit();

	}
-->
</script>
<?php
if($lvtc_lv0021->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[0];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmadd" method="post" enctype="multipart/form-data">
						<input name="txtFlag" type="hidden" id="txtFlag"  />
						  <table width="100%" border="0" align="center" class="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo 'Chọn file *.xml';?></td>
								<td width="*%"  height="20px">
									<input type="file" name="file" />			</td>
							</tr>															
							<tr>
							  <td  height="20px" colspan="2"><a href="MAU_IMPORT_LUONG.zip" title="<?php echo $vLangArr[33];?>"><?php echo 'Tải mẫu';?></a></td>
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
			      </form>	

				
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascripts/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
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