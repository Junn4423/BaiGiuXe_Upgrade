<?php
$vDir="../";
include("../clsall/lv_controler.php");	
include("../clsall/lv_lv0005.php");	
include("paras.php");
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="VN";
	$vLangArr=GetLangFile("../","AD0010.txt",$plang); 

$strUserID = $_POST["txtlv001"];
$psql = $_POST['txtSQL'];
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
//////////////////////////////////////////////////Show User Information//////////////////////////////////////////////////
$strSQL = "SELECT lv001, lv004 FROM lv_lv0007 WHERE lv001 = '$strUserID'";
$arrResult = db_query($strSQL); 
$intRows = db_fetch_array($arrResult);
$strUserID=$intRows['lv001'];
$strUserName=$intRows['UserName'];
//////////////////////////////////////////////////Show User Information//////////////////////////////////////////////////
////////////////////////////////Move lv_lv0005 -> rightdetail///////////////////////////////////////////////////////////////
$vStringID=$_POST['txtStringID'];
$vFlag   = (int)($_POST['txtFlag'] ?? 0);
/////////////////////Show data have in lv_lv0005 table and have in rightdetail table/////////////////////////////////////////
//////////////////////////////////////////////////////
//Init object
//////////////////////////////////////////////////////
$molv_lv0005=new lv_lv0005($vCheckAdmin,$vUserID,$vright);
$strUserID=$_POST['txtlv001'];
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////

	
	$xajax = new xajax(); 
	$xajax->processRequests();
	
	//Define identify name(s) to your treeview(s); Add more comma separated names to create more than one treeview. The treeview names must always be unique. You can´t even use the same treeview names on different php sites. 
	$treeviewid = array("treeviewcheckbox");
			$CheckBoxNodes = array();
			$CheckBoxNodes = $_SESSION["treeviewcheckbox"]->GetCheckedCheckboxNodes();
if($vFlag==1)
{		
	$molv_lv0005->DeleteRightUser($strUserID);
	for ($i = 0; $i < count($CheckBoxNodes); $i++)
	{
				$vGetRight=explode("@",$CheckBoxNodes[$i]->id); 	
				$molv_lv0005->ControlAddRight($strUserID,$vGetRight[0],$vGetRight[1]);				
	}
}
elseif($vFlag==2)
{		
	$molv_lv0005->DeleteRightUser($strUserID);
}
?>
<script language="javascript">
<!--
function Reload()
{
	document.frmchoose.submit();
}

function Help()
{
	'http://www.sof.vn?option=com_content&amp;sectionid=0#';
}

function Back()
{
	var o=document.frmPostThis;
	o.curPg.value=1;
	//o.txtlv001.value="";
	o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>";
	BackHistory(o,o.action);
}
function Save()
{
	var o=document.frmchoose;
	o.target="_self";
	o.txtFlag.value="1";
	o.submit();
}
function EmptySave()
{
	if(confirm("<?php echo $vLangArr[33];?>"))
	{
	
	var o=document.frmchoose;
	o.target="_self";
	o.txtFlag.value="2";
	o.submit();
	}
}
-->
</script>
<?php
if(checkright("",$_SESSION['ERPSOFV2RUserID'], "Ad0013", "") > 0)
{
?>
<div id="content_child">
	<div id="breadCrumb">
		<TABLE class="menubar" cellSpacing="0" cellPadding="0" width="100%" border="0">
		<TBODY>
			<TR>
				<TD class='menudottedline' width="40%">
				<DIV class=pathway>
					<A href="http://www.sof.vn"><STRONG>SOF CO., LTD</STRONG></A> 
				</DIV>
				</TD>
				<TD class="menudottedline" align="right">
					<TABLE id="toolbar" cellSpacing="0" cellPadding="0" border="0" width="100%">
					<TBODY>
						<TR vAlign="center" align="middle">
							<?php
							if(checkright("",$_SESSION['ERPSOFV2RUserID'], "Ad0013", "Save") > 0)
							{
							?>

							<TD>
								<a class="toolbar" href="javascript:EmptySave();">
								<img src="../images/controlright/adm_del.png" title="<?php echo $vLangArr[30];?>"
								border="0" align="middle"><br><?php echo $vLangArr[32];?></a>
							</TD>
							<TD>
								<a class="toolbar" href="javascript:Save();">
								<img src="../images/controlright/save_f2.png" title="<?php echo $vLangArr[30];?>"
								border="0" align="middle"><br><?php echo $vLangArr[30];?></a>
							</TD>
							<?php
							}
							?>
							<TD>
								<a class="toolbar" href="javascript:Back();">
								<img title="<?php echo $vLangArr[9];?>" src="../images/controlright/move_f2.png" 
								align="middle" border="0" name="back"><br><?php echo $vLangArr[10];?></a>
							</TD>
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<TD>
								<a class="toolbar" href="javascript:Reload();">
								<img title="<?php echo $vLangArr[11];?>" src="../images/controlright/reload.gif" align="middle" 
								border="0" name="reload"><br><?php echo $vLangArr[12];?></a>
							</TD>
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<TD>
								<a class="toolbar" 
								onclick="window.open('http://sof.vnindex2.php?option=com_content&amp;task=findkey&amp;pop=1&amp;keyref=screen.content', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" 
								href="javascript:Help()">
								<IMG title="<?php echo $vLangArr[13];?>" 
								src="../images/controlright/help.gif" align="middle" border="0" name="help">
								<BR><?php echo $vLangArr[14];?></a>
							</TD>
						</TR>
						</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
		</TABLE>
	</div>
	<h2 id="pageName"><?php echo $vLangArr[15];?></h2>
	<div class="story">
	<h3>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="13">
					<img name="table_r1_c1" src="../images/pictures/table_r1_c1.gif" 
						width="13" height="12" border="0" alt=""></td>
				<td width="*" background="../images/pictures/table_r1_c2.gif">
					<img name="table_r1_c2" src="../images/pictures/spacer.gif" 
						width="1" height="1" border="0" alt=""><?php echo $vStrMessage;?></td>
				<td width="13">
					<img name="table_r1_c3" src="../images/pictures/table_r1_c3.gif" 
						width="13" height="12" border="0" alt=""></td>
				<td width="11">
					<img src="../images/pictures/spacer.gif" 
						width="1" height="12" border="0" alt=""></td>
			</tr>
			<tr>
				<td background="../images/pictures/table_r2_c1.gif">
					<img name="table_r2_c1" src="../images/pictures/spacer.gif" 
						width="1" height="1" border="0" alt=""></td>
				<td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="?<?php echo $psaveget;?>" name="frmchoose" method="post">
						<input type="hidden" name="curPg" value="<?php echo $curPage;?>"/>
						<input type="hidden" name="curPg2" value="<?php echo $curPage2;?>"/>						
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtlv001" type="hidden" id="txtlv001" value="<?php echo $strUserID;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="0" />	
						<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center" >
							<tr>
								<td width="30%" align=""><b><?php echo $vLangArr[16]." ";?></b><?php echo $strUserName." (".$strUserID.")"; ?></td>
								<td width="30%" align="left"></td>
								<td width="40%" align="right"><a href="javascript:Back();" title="<?php echo $vLangArr[17];?>">
									<?php echo $vLangArr[18];?></a></td>
							</tr>
						<tr>
								<td colspan="4">	<?php
								
		
			//IMPORTANT! To be able to see the changes you have made to the code you have to clean the session.
			//(By uncomment the line below during one page load). Be sure to comment the line when publishing the treeview, or else the treeview won´t remember the old state throu page loads.
			//unset($_SESSION["NodesHasBeenAddedCheckBox"]); 
			//Get selected checkbox nodes and print their names.				
			
			if (isset($_SESSION["NodesHasBeenAddedCheckBox"]) == false)
			{
				//Do only load treeview nodes first time page is loaded.
				//If nodes from last session exists, remove them.
				unset($_SESSION["treeviewcheckbox"]->Nodes);
				$node = new TreeNode('1111111',$vLangArr[31]);		//Create a new node object with id "1" and set name to "Root Folder".
				$_SESSION["treeviewcheckbox"]->AddNode($node);	//Add "Root Folder" node to treeview.						
				$vresult=$molv_lv0005->LoadStructs();			
				while($vrow=db_fetch_array($vresult))
				{
					if($vrow['lv007']==0)
					{

						$node = new TreeNode($vrow['lv001'],GetLangRightID($vrow['lv001'],$plang));		//Create a new node object with id "1" and set name to "Root Folder".
						$node->SetParentId('1111111');					//Set "Root Folder" node as parent.						
						$_SESSION["treeviewcheckbox"]->AddNode($node);	//Add "Root Folder" node to treeview.						
						//if($molv_lv0005->CheckChild($vrow['lv001'])==0)
						{
							$vsql="select * from lv_lv0006";
							$tresult=db_query($vsql);
							while($trow=db_fetch_array($tresult))
							{
								$node = new TreeNode($vrow['lv001']."@".$trow['lv001'],$trow['lv001']."(".$trow['lv002'].")");
								$node->SetParentId($vrow['lv001']);	//Set "Root Folder" node as parent.
								$node->SetIsCheckBox(true);					//Activate checkbox.													
								if(checkright_private("TC",$strUserID,$vrow['lv001'],$trow['lv001'])>0)
									$node->SetCheckBoxIsChecked(true);
								else
									$node->SetCheckBoxIsChecked(false);								
							
								$_SESSION["treeviewcheckbox"]->AddNode($node);								
							}
								
						}
					}
					else
					{
						$node = new TreeNode($vrow['lv001'],GetLangRightID($vrow['lv001'],$plang));
						$node->SetParentId($vrow['lv006']);					//Set "Root Folder" node as parent.
						$_SESSION["treeviewcheckbox"]->AddNode($node);
						//if($molv_lv0005->CheckChild($vrow['lv001'])==0)
						{
							$vsql="select * from lv_lv0006";
							$tresult=db_query($vsql);
							while($trow=db_fetch_array($tresult))
							{
								$node = new TreeNode($vrow['lv001']."@".$trow['lv001'],$trow['lv001']."(".$trow['lv002'].")");
								$node->SetParentId($vrow['lv001']);	//Set "Root Folder" node as parent.
								$node->SetIsCheckBox(true);	//Activate checkbox.															
								if(checkright_private("",$strUserID,$vrow['lv001'],$trow['lv001'])>0)
									$node->SetCheckBoxIsChecked(true);
								else
									$node->SetCheckBoxIsChecked(false);								
								$_SESSION["treeviewcheckbox"]->AddNode($node);								
							}
						}						
					}
					
				}
				$_SESSION["NodesHasBeenAddedCheckBox"] = true;
			}
			
			//Print the treeview.
			$_SESSION["treeviewcheckbox"]->PrintTreeView();
			

			
		?>
		
								</td>
							</tr>
						</table>
					</form>
					
					
					<!--/////////////////////////////////////Applyed//////////////////////////////////////////////////-->
<form action="" id="frmPostThis" name="frmPostThis" method="post">
						<input type="hidden" name="curPg2" value="<?php echo $curPage2;?>"/>
						<input type="hidden" name="curPg" value="<?php echo $curPage;?>"/>						
						<input type="hidden" name="txtBlank" id="txtBlank" value="" />
						<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
				  </form>
				
	</div>
</div>
<?php
} else {
	include ("permit.php");
}
?>
				