//////////////////////////////////////////////////////Background Row//////////////////////////////////////////////////////////
var nn6=document.getElementById&&!document.all;
var goleftimage='../images/images/back.png'
var gorightimage='../images/images/next.png'
//configure menu width (in px):
//configure menu height (in px):
var menuheight=49;
//Specify scroll buttons directions ("normal" or "reverse"):
var scrolldir="normal"
//configure scroll speed (1-10), where larger is faster
var scrollspeed=6
//specify menu content
function RowLight(e)
{
	var r = null;
	if(nn6)
		r = e.parentNode.parentNode;
	else
		r = e.parentElement.parentElement;
	
	if (r)
		{
		if(e.checked==true)
			{
				r.bgColor ="#B6C7E5";
				if(r.className.substring(0,1)!="0")	 r.className="0"+r.className;
			}
		else
			{
			if(r.className.substring(0,1)=="0")		{
				r.className=r.className.substring(1, r.className.length);
				r.bgColor="";
			}
				
			}
			
		}

}
function RowFontColor(id,count)
{
	var r=null;
	var vj=0;
	for(vj=0;vj<count;vj++)
	{
	r=document.getElementById(id+"_"+vj);
	if(r==null) break;
	var strbold=r.innerHTML;
	r.innerHTML='';
	strbold=replaces("lvlineboldtable","lvlinenoboldtable",replaces("\n","",strbold));
	r.innerHTML=strbold;
	}
}
//////////////////////////////////////////////////////Background Row//////////////////////////////////////////////////////////
function docheckall(e)//chon het check box
{
 var i;
 var st=e.checked;
 var n=e.name;
 var pt=document.frmchoose.elements.length;
      for (i=0;i<pt;i++)
		 {var t=document.frmchoose.elements[i];
		  if (t.name=="chkuser")
			t.checked=st;
			RowLight(t);
		 }
 }
function onecheck(e)
{var i;
var gt=true;
 RowLight(e);
 var st=e.checked;
 if (st==false)
    gt=false;
 else
 {
  var pt=document.frmchoose.elements.length;
  for(i=0;i<pt;i++)
    { 
	var t=document.frmchoose.elements[i];
      if(t.name=="chkuser" & t.checked==false)
	    {gt=false;
         RowLight(e);
  	     break;
	    }
	    
    }
 }	
 document.frmchoose.chkall.checked=gt;
 RowLight( document.frmchoose.chkall); 
}
function open_del(pg,ma)
{
var strchk,spt;
 strchk="";spt=0; 
 var pt=document.frmchoose.elements.length;
  for(i=0;i<pt;i++)
    { var t=document.frmchoose.elements[i];
      if(t.name=="chkuser" & t.checked==true)
	    {strchk=strchk+t.value+"@";
		 spt=spt+1;
	    }
    }
 if(strchk=="")
 {
	 alert("Select item(s), please!");
 }
 else
 {
	 if(confirm("Do you want to delete data?"))
	 {
		DoDelete(strchk);
	 }
 }
}
function DoDelete(vStrID)
{
	var o = document.frmchoose;
	o.txtStringID.value = vStrID;
	o.txtFlag.value = "1";
	o.submit();
}
function open_insert(vUserID,frm)
{var strchk,spt;
 strchk="";spt=0; 
 var pt=frm.elements.length;
  for(i=0;i<pt;i++)
    { var t=frm.elements[i];
      if(t.name=="chkuser" & t.checked==true)
	    {strchk=strchk+t.value+"@";
		 spt=spt+1;
	    }
    }
 if(strchk=="")
 {
	 alert("Select item(s), please!");
 }
 else
 {
	DoInsert(frm,strchk,vUserID);
 }
}
function DoInsert(frm, vStrID,vUserID)
{
	var o = frm;
	o.txtStringID.value = vStrID;
	o.txtUserID.value=vUserID;
	o.txtFlag.value = "1";
	o.submit();
}
function open_edit()
{var strchk,spt;
 strchk="";spt=0;
 var pt=document.frmchoose.elements.length;
  for(i=0;i<pt;i++)
    { var t=document.frmchoose.elements[i];
      if(t.name=="chkuser" & t.checked==true)
	    {strchk=t.value;
		 break;
	    }
    }
 if(strchk=="")
 {
	 alert("Select items");
 }
 else
 EditItem(strchk);
}
//Ham dung chung cho viec goi xem, them ,sua
function open_public(vValue)
{var strchk,spt;
 strchk="";spt=0; 
 var pt=document.frmchoose.elements.length;
  for(i=0;i<pt;i++)
    { var t=document.frmchoose.elements[i];
      if(t.name=="chkuser" & t.checked==true)
	    {strchk=t.value;
		 break;
	    }
    }
 if(strchk=="")
 {
	 alert("Select items");
 }
 else
 {
	 if(vValue==1)
		 ViewPublic(strchk);	 
	 else if(vValue==2)
	 	AddPublic(strchk);
	 else if(vValue==3)
	 	EditPublic(strchk);
	 else if(vValue==4)//timesheetlist;
	 	ViewCalandar(strchk);
	 else if(vValue==5)
		 runemployee(strchk);
	else if(vValue==6)
		AddPermission(strchk);
	 else if(vValue==8)
	 	CreateCalandar(strchk);

 }
}

function frmsubmit()
{
	document.frmchoose.submit();
}
function ltrim(st)//c?t kho?ng tr?ng tri
{st=st+"";
	 for(var i=0;i<st.length;i++)
   if (st.charAt(0)==" ")
      {st=st.substring(1,st.length);
	  }
   else 
     break;	  
return st;
}
function rtrim(st)//c?t kho?ng tr?ng ph?i
{st=st+"";
	 for(var i=st.length;i>0;i--)
   if (st.charAt(st.length-1)==" ")
      {st=st.substring(0,st.length-1);
	  }
   else 
     break;	  
return st;
}
function trims(st) //c?t kho?ng tr?ng ? hai d?u chu?i
{
	st=st+"";
st=ltrim(st);
st=rtrim(st);
return st;
}

function GotoPage(iPage) {
	document.frmchoose.curPg.value=iPage;
    frmchoose.submit();
}
function GotoPageMulti(frm,obj,iPage) {
	obj.value=iPage;
    frm.submit();
}
function check_email(a)	
{	myexp = /^[0-9a-zA-Z\-\.\_]+@[0-9a-zA-Z\-]+\.[0-9a-zA-Z\-\.]+$/;
	if (a.toString().match(myexp)) return true;
	return false;
}
function replaces(lookfor,replacewith,sentence)
{
	var s;
	s="";
	var len1,len2,len3,dem;
	len1=lookfor.length;
	len3=replacewith.length;
	len2=sentence.length;
	dem=0;
	if(len1>len2)
	   return sentence;
	else
			{for(var i=0;i<len2;i++)
			  {if(i<=len2-len1)
				   {for(var j=0;j<len1;j++)
				    if(lookfor.charAt(j)==sentence.charAt(i+j))
					  {				  dem++;
					  }
					 if(dem==len1)
					 {for(var p=0;p<len3;p++)
						s=s+replacewith.charAt(p);
						i=i+len1-1;
						dem=0;
					 }
					 else
					 {dem=0;
					  s=s+sentence.charAt(i);
					 }
				  }
				else
				 {s=s+sentence.charAt(i);
				 }
			}
			
			}return s;
}
/////////////////////////////////////////////////////Focus a textbox//////////////////////////////////////////////////////////
function Focus(txtField)//longersoft
{	
	for (i = 0; i < document.forms[0].length; ++i)
	{
		var obj = document.forms[0].item(i);
		if (obj.id.indexOf(txtField) > -1)
			obj.focus();
	}
}
/////////////////////////////////////////////////////Focus a textbox//////////////////////////////////////////////////////////

//////////////////////////////////////////////////////Time Function///////////////////////////////////////////////////////////
function checkTime(i)
{
if (i<10) 
  {i="0" + i;}
  return i;
}

function startTime()/*call: startTime(); -> It print a clock on <div id="txt"></div> tag*/
{
	var today=new Date();
	var h=today.getHours();
	var m=today.getMinutes();
	var s=today.getSeconds();
	var d=today.getDate();
	var M=today.getMonth() + 1;
	var y=today.getFullYear();
	// add a zero in front of numbers<10;
	m=checkTime(m);
	s=checkTime(s); 
	d=checkTime(d);
	M=checkTime(M);
	//document.getElementById('txt').innerHTML="Now is: "+h+":"+m+":"+s+" - "+d+"/"+M+"/"+y;
	//document.getElementById('txt').innerHTML=" "+h+":"+m+":"+s+" - "+d+"/"+M+"/"+y;
	document.getElementById('txt').innerHTML="Time: "+h+":"+m+":"+s;
	t=setTimeout('startTime()',500);
}

function MyDate()
{
	var d = new Date();
	document.write(d.getDate());
	document.write("/");
	document.write(d.getMonth() + 1);
	document.write("/");
	document.write(d.getFullYear());
}
///////////////////////////////////////////////////Select one checkbox////////////////////////////////////////////////////////
function CheckOne(frm, chkName, chkAllName, e)//Select 1 checkbox
{	///neu su dung cho chinh trang hien hanh: e=this khi truyen bien
	//CheckOne(document.frmName, 'chkName', document.frmName.chkAllName, this);
	
	var i;
	var gt=true;
	var vObjAllName;
	RowLight(e);//Add background color function (in javascript/pubscript.js)
	var st=e.checked;
	if (st==false)
	{
		var pt=frm.elements.length;
		for(i=0;i<pt;i++)
		{ 
		
			var t=frm.elements[i];
			if(t.name==chkAllName)
			{
				vObjAllName=t;
			}
	
		}
		
		gt=false;
	}
	else
	{
		var pt=frm.elements.length;
		for(i=0;i<pt;i++)
		{ 
		
			var t=frm.elements[i];
			if(t.name==chkName & t.checked==false)
			{
				gt=false;
				RowLight(e);
				break;

			}
			if(t.name==chkAllName)
			{
				vObjAllName=t;
			}
	
		}
	}
	vObjAllName.checked=gt;
	RowLight(vObjAllName);
}
///////////////////////////////////////////////////Select one checkbox////////////////////////////////////////////////////////

///////////////////////////////////////////////////Select all checkbox////////////////////////////////////////////////////////
function DoChkAll(frm, chkName, e)//Select all checkbox
{
	//DoChkAll(document.frmName, 'chkName', this);
	var i;
	///neu su dung cho chinh trang hien hanh: e=this
	var st=e.checked;
	var n=e.name;
	var pt=frm.elements.length;
	for (i=0;i<pt;i++)
	{
		var t=frm.elements[i];
		if (t.name==chkName)
			t.checked=st;
		RowLight(t);
	}
}
///////////////////////////////////////////////////Select all checkbox////////////////////////////////////////////////////////

////////////////////////////////////////////////////////Submit data///////////////////////////////////////////////////////////
////////////////////////////////////////////////////////Submit data///////////////////////////////////////////////////////////

////////////////////////////////////////////////////Check to Insert data//////////////////////////////////////////////////////
function ChkedIns(strUserID, frm, chkName)
{
	var strchk,spt;
	strchk="";spt=0; 
	var pt=frm.elements.length;
	for(i=0;i<pt;i++)
	{
		var t=frm.elements[i];
		if(t.name==chkName & t.checked==true)
		{
			strchk=strchk+t.value+"@";
			spt=spt+1;
		}
	}
	if(strchk=="")
	{
		alert("Select item(s), please!");
	}
	else
	{
		if(confirm("Do you want add permission?"))
		{
			DoInsertThis(frm, strchk, strUserID);
		}
	}
}
////////////////////////////////////////////////////Check to Insert data//////////////////////////////////////////////////////

/////////////////////////////////////////////////////Check to Edit data///////////////////////////////////////////////////////
function ChkedEdit(frm, chkName)
{
	var strchk, spt;
	strchk=""; spt=0;
	var pt=frm.elements.length;
	for(i=0; i<pt; i++)
	{
		var t=frm.elements[i];
		if(t.name==chkName & t.checked==true)
		{
			strchk=t.value;
			break;
		}
	}
	if(strchk=="")
	{
		alert("Select item, please");
	}
	else
		EditItem(strchk);
}
/////////////////////////////////////////////////////Check to Edit data///////////////////////////////////////////////////////

////////////////////////////////////////////////////Check to Delete data//////////////////////////////////////////////////////
function ChkedDel(vUserID, frm, chkName)
{
	var strchk, spt;
	strchk=""; spt=0;
	var pt=frm.elements.length;
	for(i=0; i<pt; i++)
	{
		var t=frm.elements[i];
		if(t.name==chkName & t.checked==true)
		{
			strchk=strchk+t.value+"@";
			spt=spt+1;
		}
	}
	if(strchk=="")
	{
		alert("Select item(s), please!");
	}
	else
	{
		if(confirm("Are you sure?"))
		{
			DoDelThis(frm, strchk, vUserID);
		}
	}
}
////////////////////////////////////////////////////Check to Delete data//////////////////////////////////////////////////////

/////////////////////////////////////////////////////Check to View data///////////////////////////////////////////////////////
function ChkedView(vUserID, frm, chkName){
	var strchk, spt;
	strchk=""; spt=0;
	var pt=frm.elements.length;
	for(i=0; i<pt; i++)	{
		var t=frm.elements[i];
		if(t.name==chkName & t.checked==true){
			strchk=strchk+t.value+"@";
			spt=spt+1;
		}
	}
	if(strchk==""){
		alert("Select item(s), please!");
	} else{
		Reports(frm, strchk, vUserID);
	}
}
/////////////////////////////////////////////////////Check to View data///////////////////////////////////////////////////////
function ChkedViewAll(vUserID, frm, chkName){
	var strchk, spt;
	strchk=""; spt=0;
	var pt=frm.elements.length;
	for(i=0; i<pt; i++)	{
		var t=frm.elements[i];
		if(t.name==chkName & t.checked==true){
			strchk=strchk+t.value+"@";
			spt=spt+1;
		}
	}
	if(strchk==""){
		Reports(frm, strchk, vUserID);
	} else{
		Reports(frm, strchk, vUserID);
	}
}
/////////////////////////////////////////////////Check to Admin Delete data//////////////////////////////////////////////////
function ChkedAdmDel(frm, chkName)
{
	var strchk, spt;
	strchk=""; spt=0;
	var pt=frm.elements.length;
	for(i=0; i<pt; i++)
	{
		var t=frm.elements[i];
		if(t.name==chkName & t.checked==true)
		{
			strchk=strchk+t.value+"@";
			spt=spt+1;
		}
	}
	if(strchk=="")
	{
		alert("Select item(s), please!");
	}
	else
	{
		if(confirm("Are you sure?"))
		{
			AdmDelThis(frm, strchk);
		}
	}
}
/////////////////////////////////////////////////Check to Admin Delete data//////////////////////////////////////////////////

////////////////////////////////////////////////////////Check to Update//////////////////////////////////////////////////////
function ChkedEnable(frm, chkName1, chkName2)
{//ChkedEnable(document.frmName, 'chkName1', 'chkName2');
	var strchk, strchk1, spt;
	strchk=""; strchk1=""; spt=0;
	var pt=frm.elements.length;
	for(i=0;i<pt;i++)
	{
		var t=frm.elements[i];
		if(t.name==chkName1)
		{
			strchk=strchk+t.value+"@";
		}
		else
			if(t.name==chkName2)
			{
				if( t.checked==true)
					strchk1=strchk1+"1"+"@";
				else
					strchk1=strchk1+"0"+"@";
			}
	}
	if(confirm("Do you want to change it?"))
	{
		DoEnableThis(frm, strchk, strchk1);
	}
}
////////////////////////////////////////////////////////Check to Update//////////////////////////////////////////////////////

//////////////////////////////////////////////////////Goto History Page//////////////////////////////////////////////////////
function BackHistory(frm,vValue)
{
	frm.action=vValue;
	frm.target="_self";
	frm.submit();
}
//////////////////////////////////////////////////////Goto History Page//////////////////////////////////////////////////////
function lv_chk_list(frm, chkName, vValue)
{//Chked2Submit(document.frmName, 'chkName', number);
	var strchk, spt;
	strchk=""; spt=0; 
	var pt=frm.elements.length;
	for(i=0; i<pt; i++)
	{
		var t=frm.elements[i];
		if(t.name==chkName & t.checked==true)
		{
			if(vValue==1 || vValue==2 || vValue==5)	
			{strchk=t.value;
				break;
			}
			else
			{
				strchk=strchk+t.value+"@";
			}
			
		}
	}
	if(strchk=="")
	{
		alert("Select item, please!");
		return;
	}
	else
	{
		switch(vValue)
		{
			case 1: View(strchk);	break;//TC			 
			case 2:	Edit(strchk);break;//--
			case 3:
			 if(confirm("Do you want to delete data?"))
				{
					Delete(strchk);
				}
				break;//--
			case 4: Report(strchk);
			case 5: ReportAll(strchk);
			case 6:	FunctRunning1(strchk);break;//--
			case 7:	FunctRunning2(strchk);break;//--
			case 8:	FunctRunning3(strchk);break;//--
			case 9: Approvals(strchk);break;//--
			case 10: UnApprovals(strchk);break;//--
			case 11: FunctRunning4(strchk);break;//--
			case 12: FunctRunning5(strchk);break;//--
			case 13: FunctRunning6(strchk);break;//--
			case 14: FunctRunning7(strchk);break;//--
			
		}
	}
}
/////////////////////////////////////////Call Submit Functions - Using while Get 1 Checked///////////////////////////////////
function Chked2Submit(frm, chkName, vValue)
{//Chked2Submit(document.frmName, 'chkName', number);
	var strchk, spt;
	strchk=""; spt=0; 
	var pt=frm.elements.length;
	for(i=0; i<pt; i++)
	{
		var t=frm.elements[i];
		if(t.name==chkName & t.checked==true)
		{
			strchk=t.value;
			break;
		}
	}
	if(strchk=="")
	{
		alert("Select item, please!");
	}
	else
	{
		switch(vValue)
		{
			case 1: ViewPublic(strchk);	break;//TC			 
			case 2: AddPublic(strchk);break;//--
			case 3:	EditPublic(strchk);break;//--
			case 4: ViewCalandar(strchk);break;//--
			case 5: runemployee(strchk);break;//--
			case 6: AddPermission(strchk);break;//--
			case 7: DoEditPer(strchk);break;//Edit Permission
			case 8: CreateCalandar(strchk);break;//Tao lich
			case 9: ViewLogtime(strchk);break;//--
			case 10: ViewDisplays(strchk);break;//--
			case 11: InfoYears(strchk);break;//--
			case 12: InfoWeeks(strchk);break;//--
			case 13: enteremployee(strchk);break;//--
			case 14: BasicPayrolls(strchk);break;//--
			case 15: CostEmployees(strchk);break;//--
			case 16: Expenses(strchk);break;//--
			case 17: Loans(strchk);break;//--
			case 18: LoanPayments(strchk);break;//--
			case 19: EmpRests(strchk);break;//--
			case 20: CalSalarys( strchk);break;//--
			case 21: PreCalSalarys(strchk);break;//--
			case 22: Bonuss(strchk);break;//--
			case 23: ViewEmployee(strchk);break;//--
			case 24: RptTimesheets(strchk);break;//--
			case 25: Reportpayroll(strchk);break;//--
			case 26: ResetPass(strchk);break;//--
			case 27: States(strchk);break;//TC
			case 28: Jobs(strchk);break;//HR
			case 29: Resources(strchk);break;//--
			case 30: Performances(strchk);break;//--
			case 31: CourseDetails(strchk);break;//--
			case 32: Views(strchk);break;//--
			case 33: Trainings(strchk);break;//--
			case 34: Contracts(strchk);break;//--
			case 35: TrainingCertifys(strchk);break;//--
			case 36: Benefits(strchk);break;//--
			case 37: Documents(strchk);break;//HR
 			case 38: ChildMenus(strchk);break;//WB
 			case 39: InputLangs(strchk);break;		//WB	
 			case 40: InputContents(strchk);break;		//WB
			case 41: RunBookLinks(strchk);break;//LB
			case 42: CreateLectures(strchk);break;//LB
			case 43: Violates(strchk);break;//LB
			case 44: ViewViolates(strchk);break;//LB
			case 45: ViewHistorys(strchk);break;//LB
			case 46: Moneys(strchk);break;//LB
			case 47: ReloadCards(strchk);break;//LB
			case 48: FabricSamples(strchk);break;//MK
			case 49: Analyzes(strchk);break;//MK
			case 50: ContractDetail(strchk);break;//MK
			case 51: EditShippingDetail(strchk);break;//MK
			case 52: EditFabricReturn(strchk);break;//MK
			case 53: CusHistorys(strchk);break;//MK
			case 54: ViewResultSamples(strchk);break;//MK
			case 55: CreateFabrics(strchk);break;//MK
			case 56: SalaryCurrencys(strchk);break;//HR
			case 57: JobTitleEmpStats(strchk);break;//HR
			case 58: ViewInfos(strchk);break;//HR
			case 59: Personals(strchk);break;//HR
			case 60: Contacts(strchk);break;//HR
			case 61: EmpJobs(strchk);break;//HR
			case 62: ParaBuildContracts(strchk);break;//HR
			case 63: BuildContracts(strchk);break;//HR
			
		}
	}
}
/////////////////////////////////////////Call Submit Functions - Using while Get 1 Checked///////////////////////////////////

///////////////////////////////////////Call Submit Functions - Using while Get All Checked///////////////////////////////////
function ChkedAll2Submit(frm, chkName,vValue)
{
	var strchk, spt;
	strchk=""; spt=0;
	var pt=frm.elements.length;
	for(i=0; i<pt; i++)
	{
		var t=frm.elements[i];
		if(t.name==chkName & t.checked==true)
		{
			strchk=strchk+t.value+"@";
			spt=spt+1;
		}
	}
	if(strchk=="")
	{
		alert("Select item(s), please!");
	}
	else
	{
		if(confirm("Are you sure?"))
		{
			if(vValue==8) {UnApprovals(frm,strchk);}	
			else if(vValue==9) {Approvals(frm,strchk);}					
		}
	}
}
///////////////////////////////////////Call Submit Functions - Using while Get All Checked///////////////////////////////////

///////////////////////////////////////////Check to Add Permission for User on Right/////////////////////////////////////////
function ChkedAddPer(frm, chkName1, chkName2)
{//ChkedAddPer(document.frmName, 'chkName1', 'chkName2');
	var strchk, strchk1, spt, flag;
	flag=0;
	strchk=""; strchk1=""; spt=0;
	var pt=frm.elements.length;
	for(i=0;i<pt;i++)
	{
		var t=frm.elements[i];
		if(t.name==chkName1 && t.checked==true)
		{
			strchk=strchk+t.value+"@";
			if(flag==1)
			{
				strchk1=strchk1+"0"+"@";
			}
			flag=1;
		}
		else
			{
				if(t.name==chkName2 && flag==1)
				{
					if( t.checked==true)
						strchk1=strchk1+"1"+"@";
					else
						strchk1=strchk1+"0"+"@";
					flag=0;
				}
			}
	}
	if(confirm("Are you sure?"))
	{
		DoAddPerThis(frm, strchk, strchk1);
	}
}
///////////////////////////////////////////Check to Add Permission for User on Right/////////////////////////////////////////
///////////////////////////////////////////Fill number //////////////////////////////////////////////////////////////////////
function FillNumber(vValue,vLen)
{
	vValue=vValue+"";
	tlen=vValue.length;
	if(tlen<vLen)
	{
		for(var i=0;i<vLen-tlen;i++)
		{
			vValue="0"+vValue;
		}
	}
	return vValue;
}
function Sleeping(vTimes)
{
var	i=0;
	while(i<vTimes)
	{
		i++;
	}
}
//////////////////////////////////////////////////////Change Image///////////////////////////////////////////////////////////
function changeImage(img_name, img_src)
{
	document[img_name].src = img_src;
}
//////////////////////////////////////////////////////Change Image///////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////Clock//////////////////////////////////////////////////////////////
/*Ham can co doan sau de su dung:
<body onLoad="lclock();">
//va chen vao dau do  nhu sau:
<span id="pendule"></span>
*/
function lclock() {
var digital = new Date();
var hours = digital.getHours();
var minutes = digital.getMinutes();
var seconds = digital.getSeconds();
var amOrPm = "AM";
if (hours > 11) amOrPm = "PM";
if (hours > 12) hours = hours - 12;
if (hours == 0) hours = 12;
if (minutes <= 9) minutes = "0" + minutes;
if (seconds <= 9) seconds = "0" + seconds;
dispTime = hours + ":" + minutes + ":" + seconds + " " + amOrPm;
var vobj=document.getElementById("pendule");
vobj.innerHTML = dispTime;
setTimeout("lclock()", 1000);
}
//////////////////////////////////////////////////////////Clock//////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////Get Month////////////////////////////////////////////////////////////
function getmonth(vdate,vlang)
{
	vreturn="";
	switch(vlang)
	{
		case "EN":
				vreturn= vdate.substring(0,2);
			break;
		case "VN":
			vreturn= vdate.substring(3,5);
			break;
	}
	return parseInt(vreturn,10);
}
////////////////////////////////////////////////////////Get Month////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////Get Day/////////////////////////////////////////////////////////////
function getday(vdate,vlang)
{
	vreturn="";
	switch(vlang)
	{
		case "EN":
				vreturn= vdate.substring(3,5);
			break;
		case "VN":
			vreturn= vdate.substring(0,2);
			break;
	}
	return parseInt(vreturn,10);
}
/////////////////////////////////////////////////////////Get Day/////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////Get Year////////////////////////////////////////////////////////////
function getyear(vdate,vlang)
{
	switch(vlang)
	{

		case "EN":
				vreturn= vdate.substring(6,10);
			break;
		case "VN":
			vreturn= vdate.substring(6,10);
			break;
	}
	return parseInt(vreturn,10);
}
/////////////////////////////////////////////////////////Is Number///////////////////////////////////////////////////////////
function isLNumber(a) {
    return typeof a == 'number' && isFinite(a);
}
/////////////////////////////////////////////////////////Is Number///////////////////////////////////////////////////////////
function isNumber(s){
	if(s!=""){
		var str="0123456789"
		for(var j=0;j<s.length;j++)
			if(str.indexOf(s.charAt(j))==-1){
				//alert("You must enter number !")	
				return false
			}
		return true
	}
	return true
}
/////////////////////////////////////////////////////////Is Number///////////////////////////////////////////////////////////
function IsNumeric(sText){//Dang su dung ham nay
	var ValidChars = "0123456789.";
	var IsNumber=true;
	var Char; 
	for (i = 0; i < sText.length && IsNumber == true; i++){
		Char = sText.charAt(i); 
		if (ValidChars.indexOf(Char) == -1){
			IsNumber = false;
		}
	}
	return IsNumber;
}


function scrollToBottom(){
parent.resizeWidthAll(document.body.scrollWidth,document.body.scrollHeight);
//id1.width=document.body.scrollWidth;
//window.parent.showparenttext.style.width=window.lvleft.width;
return 0;
var scrollH=document.body.scrollHeight;
var offsetH=document.body.offsetHeight;
if(scrollH>offsetH) window.scrollTo(0,scrollH);
else window.scrollTo(0,offsetH);
}
/*-----------Menu-main-------------*/
function get_slide()
{
	var leftdircode='onMouseover="moveleft()" onMouseout="clearTimeout(lefttime)"';
	var rightdircode='onMouseover="moveright()" onMouseout="clearTimeout(righttime)"';
	if (scrolldir=="reverse"){
	var tempswap=leftdircode;
	leftdircode=rightdircode;
	rightdircode=tempswap;
	}
	
	var actualwidth='';
	var cross_scroll, ns_scroll;
	var loadedyes=0;
	

	if (iedom||document.layers){
	with (document){
	write('<table border="0" cellspacing="0" cellpadding="0">');
	write('<td valign="middle"><a href="#" '+rightdircode+'><img src="'+goleftimage+'"border=0></a> </td>');
	write('<td width="'+menuwidth+'px" valign="top">')
	if (iedom){
	write('<div style="position:relative;width:'+menuwidth+'px;height:'+menuheight+'px;overflow:hidden;">');
	write('<div id="test2" style="position:absolute;left:0;top:0">');
	write('</div></div>');
	}
	else if (document.layers){
	write('<ilayer width='+menuwidth+' height='+menuheight+' name="ns_scrollmenu">');
	write('<layer name="ns_scrollmenu2" left=0 top=0></layer></ilayer>');
	}
	write('</td>');
	write('<td valign="middle"> <a href="#" '+leftdircode+'>');
	write('<img src="'+gorightimage+'"border=0></a>');
	write('</td></table>');
	}
	}

}	
function fillup(){
	
	if (iedom){
			cross_scroll=document.getElementById? document.getElementById("test2") : document.all.test2;
			cross_scroll.innerHTML=menucontents.replace("header_menu","header_menu_selected");
			actualwidth=document.all? cross_scroll.offsetWidth : document.getElementById("temp").offsetWidth
	}
	else if (document.layers){
		ns_scroll=document.ns_scrollmenu.document.ns_scrollmenu2;
		ns_scroll.document.write(menucontents);
		ns_scroll.document.close();
		actualwidth=ns_scroll.document.width;
	}
	loadedyes=1;
	//var o=document.getElementById('header_menu_selected');
	//o.focus();
	//NextRuntTimeFull();
	callscreen();
}
function callscreen()
{
	var o=document.getElementById('header');
	var o1=document.getElementById('menu_header_my_logo');
	var o2=document.getElementById('content');
	var o4=document.getElementById('center_content');
	var o3=document.getElementById('td_screen_save');
	var o5=document.getElementById('header_my_logo');
	var widthscreen=screen.width;
	if(widthscreen<700) widthscreen=700;
	if(widthscreen==800)
		{
		o.style.width="800px";
		o1.style.width="511px";
		o5.style.width="511px";
		o2.style.width="800px";
		o4.style.width="544px";
		o3.style.width="330px";
		}
	else if(widthscreen>800)
		{
		o.style.width=widthscreen+"px";
		o1.style.width=((widthscreen-800)+511)+"px";
		o5.style.width=((widthscreen-800)+511)+"px";
		o2.style.width=widthscreen+"px";
		o4.style.width=((widthscreen-800)+544)+"px";
		o3.style.width="412px";
		}
	else if(widthscreen<800 && widthscreen>350)
		{
		var o7=document.getElementById('header_company');
		o7.innerHTML='';
		o.style.width=widthscreen+"px";
		o1.style.width=((widthscreen-800)+511)+"px";
		o5.style.width=((widthscreen-800)+511)+"px";
		o2.style.width=widthscreen+"px";
		o4.style.width=((widthscreen-800)+544)+"px";
		o3.style.width="350px";
		}
	else
		{
		var o7=document.getElementById('header_company');
		o7.innerHTML='';
		widthscreen1=400;
		o.style.width=widthscreen1+"px";
		o1.style.width=((widthscreen1-800)+511)+"px";
		o5.style.width=((widthscreen1-800)+511)+"px";
		o2.style.width=widthscreen1+"px";
		o4.style.width=((widthscreen1-800)+544)+"px";
		o3.style.width="350px";
		}
}
function moveleft(){
	if (loadedyes){
	if (iedom&&parseInt(cross_scroll.style.left)>(menuwidth-actualwidth)){
	cross_scroll.style.left=parseInt(cross_scroll.style.left)-scrollspeed+"px"
	}
	else if (document.layers&&ns_scroll.left>(menuwidth-actualwidth))
	ns_scroll.left-=scrollspeed
	}
	lefttime=setTimeout("moveleft()",50)
	}

function moveright(){
	if (loadedyes){
	if (iedom&&parseInt(cross_scroll.style.left)<0)
	cross_scroll.style.left=parseInt(cross_scroll.style.left)+scrollspeed+"px"
	else if (document.layers&&ns_scroll.left<0)
	ns_scroll.left+=scrollspeed
	}
	righttime=setTimeout("moveright()",50)
	}
function waitetimerun()
{
	clearTimeout(lefttime);
	clearTimeout(righttime);
}
function NextRuntTime()
{
	moveleft();
	setTimeout("waitetimerun()",200)
}
function NextRuntTimeFull()
{
	moveleft();
	setTimeout("waitetimerun()",800)
}
function BackRuntTime()
{
	moveright();
	setTimeout("waitetimerun()",200)
}