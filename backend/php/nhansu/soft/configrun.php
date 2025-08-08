<?php
error_reporting(E_ERROR | E_PARSE);
/////////////////////////////////////////
//ham dieu khien cho trang thao tac
/////////////////////////////////////////
function controlmain($vopt,$vitem,$vlink,$vitemlst,$vchildlst,$vlevel3lst,$vchild3lst)
{
	$titemlst=(int)$vitemlst;
	$childlst=(int)$vchildlst;
	$vlevel3lst=(int)$vlevel3lst;
	$vchild3lst=(int)$vchild3lst;
	echo $vlink=base64_decode($vlink);
	switch($vopt)
		{	case 0:
				include("display.php");
//				include("parapayroll/parapayroll.php");
				break;
//////*******************************************************************************************************************//
//////Admin Manage
//////*******************************************************************************************************************//					
			case 1:
					switch($titemlst)
					{
		///////////////////////////////////////////////////////////////////////
		//Danh cho load chung
		///////////////////////////////////////////////////////////////////////					
						case 0:
							include ($vlink);
							break;
						case 1://Dieu khien cho truong hop them
							include('lv_lv0007/user.php');
							break;
						case 2://Dieu khien cho truong hop sua
							include('lv_lv0007/useredit.php');
							break;
///////////////////////////////////////////////////////////////////////							
//Danh cho viec load dac biet
///////////////////////////////////////////////////////////////////////							
						case 3:
							{$vitem="Ad0013";
								switch($childlst)
								{
									case 0:
										include ("security/securitylist.php");									
										break;
									case 1:
										include ("security/security.php");																		
										break;
									case 2:
										break;
								}
							}
							break;
///////////////////////////////////////////////////////////////////////							
//Danh cho viec kiá»ƒm soÃ¡t thá»�i gian log cá»§a user
///////////////////////////////////////////////////////////////////////									
						case 4:
							$vitem="Ad0014";
							switch($childlst)
							{
								case 0:
									include("logtime/logtimelist.php");
									break;
								case 1:
									include("logtime/logtimedel.php");
									break;										
							}
							break;
						
///////////////////////////////////////////////////// resetpwd ///////////////////////////////////////////////////																																								
						case 17:
								include("lv_lv0007/resetpwd.php");
								break;		
						case 18:					
								include("lv_lv0007/userfilter.php");
								break;		

					}
						
				break;

//////*******************************************************************************************************************//
//////Dieu khien cho xem message
//////*******************************************************************************************************************//					
			case 3:
				$vitem="";
					switch ($titemlst)
					{
						case 1:
							include ("messages/messageslist.php");
							break;
						case 2:
							include ("messages/messages.php");
							break;
						case 4:
							include ("messages/messagesview.php");
							break;
					}
				break;
//////*******************************************************************************************************************//
//////Dieu khien cho security
//////*******************************************************************************************************************//					
		   case 4:
					switch($titemlst)
					{
						case 1:
							include("lv_lv0007/userpwd.php");
							break;
						case 2:
							switch($childlst)
							{
								case 0:
									include("logtime/logtimelist.php");
									break;
								case 1:
									include("logtime/logtimedel.php");
									break;
							}
							break;
						case 3:
							break;
					}
				break;
//////*******************************************************************************************************************//
/////HR Manage
//////*******************************************************************************************************************//					
				
			case 5:
					switch($titemlst)
					{
		///////////////////////////////////////////////////////////////////////
		//Danh cho load chung
		///////////////////////////////////////////////////////////////////////					
						case 0:
							include($vlink);
							break;
												
	
					}
					break;
						
//////*******************************************************************************************************************//
/////LB Menu List
//////*******************************************************************************************************************//					
			case 6:
					switch($titemlst)
					{
		///////////////////////////////////////////////////////////////////////
		//Danh cho load chung
		///////////////////////////////////////////////////////////////////////					
						case 0:
							include ($vlink);
							break;		
											
							
					}				
					break;
	
//HR					
			case 8:
		/////////////////////////////////////////
		/////////////////////////////////////////			
					switch($titemlst)
					{
		///////////////////////////////////////////////////////////////////////
		//Danh cho load chung
		///////////////////////////////////////////////////////////////////////					
						case 0:
							include ($vlink);
							break;
						case 1://Dieu khien cho truong hop them
							$vlink=str_replace("list.php",".php",$vlink);
							if(trim($vlink)!='') include($vlink);
							break;
						case 2://Dieu khien cho truong hop sua
							$vlink=str_replace("list.php","edit.php",$vlink);
							if(trim($vlink)!='') include($vlink);
							break;		
						case 3://Dieu khien cho truong hop loc
							$vlink=str_replace("list.php","filter.php",$vlink);
							if(trim($vlink)!='') include($vlink);
							break;							
							
							
					}				
		
					break;			
//////*******************************************************************************************************************//
/////Public form
//////*******************************************************************************************************************//					
			case 10:
					switch($titemlst)
					{
		///////////////////////////////////////////////////////////////////////
		//Danh cho load chung
		///////////////////////////////////////////////////////////////////////					
						case 0:
							include ($vlink);
							break;
						case 1://Dieu khien cho truong hop them
							$vlink=str_replace("list.php",".php",$vlink);
							if(trim($vlink)!='') include($vlink);
							break;
						case 2://Dieu khien cho truong hop sua
							$vlink=str_replace("list.php","edit.php",$vlink);
							if(trim($vlink)!='') include($vlink);
							break;
						case 3:
							$vlink=str_replace("list.php","filter.php",$vlink);
							if(trim($vlink)!='') include($vlink);
							break;
					}
					break;
//////*******************************************************************************************************************//
/////Employee LB
//////*******************************************************************************************************************//					
				case 11:
///////////////////////////////////////////////////////////////////////							
//Danh cho viec kiá»ƒm soÃ¡t lÆ°Æ¡ng cÆ¡ báº£n
///////////////////////////////////////////////////////////////////////									
					switch($titemlst)
					{
		///////////////////////////////////////////////////////////////////////
		//Danh cho load chung
		///////////////////////////////////////////////////////////////////////					
						case 0:
							include ($vlink);
							break;
						case 1://Dieu khien cho truong hop them
							$vlink=str_replace("list.php",".php",$vlink);
							if(trim($vlink)!='') include($vlink);
							break;
						case 2://Dieu khien cho truong hop sua
							$vlink=str_replace("list.php","edit.php",$vlink);
							if(trim($vlink)!='') include($vlink);
							break;


///////////////////////////////////////////////////// images ///////////////////////////////////////////////////																																								
						case 16:
								include("uploads/images.php");
								break;

						}		
					break;
				
//////*******************************************************************************************************************//
/////Module Public Marketing
//////*******************************************************************************************************************//		
			case 19:
					switch($titemlst)
					{
		///////////////////////////////////////////////////////////////////////
		//Danh cho load chung
		///////////////////////////////////////////////////////////////////////					
						case 0:
							include ($vlink);
							break;
												
	
					}
					break;
						
				case 22:
					switch($titemlst)
					{
						case 0:
							include ($vlink);						
							break;
					}
					break;							
//////*******************************************************************************************************************//
/////Module Reports
//////*******************************************************************************************************************//		
				case 25:
					switch($titemlst)
					{
						case 0:
							include ($vlink);						
							break;
					}
					break;	
//////*******************************************************************************************************************//
/////JOBS Module
//////*******************************************************************************************************************//					
				case 27:
					switch($titemlst)
					{
						case 0:
							include ($vlink);						
							break;
					}
					break;													
//////*******************************************************************************************************************//
/////EMP Module
//////*******************************************************************************************************************//					
				case 99:
					switch($titemlst)
					{
						case 0:
							include ($vlink);						
							break;
					}
					break;			
				case 102:
					switch($titemlst)
					{
						case 0:
							include ($vlink);						
							break;
					}
					break;			
				case 103:
					switch($titemlst)
							{
							/*--------------------------------------------*/			
								case 0:				
									include("employees/employeeinfo.php"); break;
								case 1:
									 switch($childlst)
										{	
										} break;
								case 2: //Change Infor
									switch($childlst)
									{	case 0: include("employees/employeeedit.php"); break;
										case 1: include("employees/employeepwd.php"); break;
										default: include("employees/employeeinfo.php"); break;
									} break;
								case 3: //List Messages
									switch($childlst)
									{	case 0: include("messageslist.php"); break;
										case 1: include("#"); break;
										default: include ("#"); break;
									} break;
								case 4: //Other
									switch($childlst)
									{	case 0: include("#"); break;	
										default: include ("#"); break;
									} break;
								/*------------------------------------------------------*/
								}
								break;
		}

}
?>
