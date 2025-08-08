// JavaScript Document
/////Getkey enter////////////
var keepkey=0;
function CheckKeyItem(o,e,vHD,vOrder)
{
	var values=o.value;
	var ArValue=values.split(".");
	var vKey=ArValue[0];
	var vItem=ArValue[1];
	var keynum;
	var keychar;
	var numcheck;
	
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	vcode=checkItem(o,keynum);
	if(vcode!="")	AddItemNew(vHD,vOrder,vcode)
		
	return;
}

function checkItem(o,vkey)
{
	
	var value='';
	var vArrValue=Array();
	for(var i=1;i<200;i++)
	{
		var o=document.getElementById('liitemkey_'+i)
		
		if(o==null) return;
		value=o.title;
		vArrValue=value.split(".");
		ikey=vArrValue[0];
		ikeyup=ikey.toUpperCase();
		ikeylow=ikey.toLowerCase();
		if(vkey==ascii(ikeyup) || vkey==ascii(ikeylow) ) return value;
	}
	return '';
}
function ascii (a) { return a.charCodeAt(0); }
function CheckKey(e,opt)
{
	var keynum;
	var keychar;
	var numcheck;
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum=="13")
	{
		switch(opt)
		{
			case 1:
				Add();
				break;
			case 2:
				Edt();
				break;
			case 3:
				Del();
				break;
			case 4:
				Back();
				break;
			case 6:
				Filter();
				break;
			case 7:
				Save();
				break;
		}
	}
	return;
}	
function CheckKeys(e,opt,o)
{
	var keynum;
	var keychar;
	var numcheck;
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum=="13")
	{
		switch(opt)
		{
			case 1:
				Add();
				break;
			case 2:
				Edt();
				break;
			case 3:
				Del();
				break;
			case 4:
				Back();
				break;
			case 6:
				Filter();
				break;
			case 7:
				Save();
				break;
		}
	}
	else if(keynum=="32")
		{
			if(e.shiftKey==true)
			{
				var vname=o.name;
				var obj=document.getElementById(vname+"_search");
				obj.focus();
				obj.select();
			}
		}
	return;
}	
function KeyMenuRun(e,o,stt)
{
	var keynum;
	var keychar;
	var numcheck;
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum=="40")
	{
		var o=document.getElementById("a_"+stt);
		o.className="lv_linone";
		if(o.name=="1") o.className=o.className+" "+"menuleft_con";
		var vt=get_nextnode(stt,leftmenuspt,1);
		var t=document.getElementById("a_"+vt);
		t.focus();
		t.className="lv_liselected";
		if(t.name=="1") t.className=t.className+" "+"lv_liselectedcon";
		
	}
	else if(keynum=="38")
	{
		var o=document.getElementById("a_"+stt);
		o.className="lv_linone";
		if(o.name=="1") o.className=o.className+" "+"menuleft_con";
		var vt=get_nextnode(stt,leftmenuspt,-1);
		var t=document.getElementById("a_"+vt);
		t.focus();
		t.className="lv_liselected";
		if(t.name=="1") t.className=t.className+" "+"lv_liselectedcon";
	}
	else if(keynum=="39") //key next
	{
		var o=document.getElementById("a_"+stt);
		if(o.name!="")
			{
			var o=document.getElementById("ul_a_"+stt);
			o.style.display="block";
			set_nextnode(stt,leftmenuspt,1);
			}
	}
	else if(keynum=="37") //key back
	{
		var o=document.getElementById("a_"+stt);
		if(o.name!="")
			{
			var o=document.getElementById("ul_a_"+stt);
			o.style.display="none";
			set_nextnode(stt,leftmenuspt,-1);
			}
	}
}
function on_mouse_click(stt)
{
		var o=document.getElementById("a_"+stt);
		if(o.name!="")
			{
			var o=document.getElementById("ul_a_"+stt);
			if(o.style.display!="block")
				{
				o.style.display="block";
				set_nextnode(stt,leftmenuspt,1);
				}
			else
				{
				o.style.display="none";
				set_nextnode(stt,leftmenuspt,-1);
				}
			}
}

function set_nextnode(stt,spt,opt)
{
	if(opt==-1)
	{
		var o=document.getElementById("a_"+stt);
		for(var i=stt+1;i<=spt;i++)
		 {
		 	var kq=strnodenouse.indexOf(","+i+",",0);
		 	var t=document.getElementById("a_"+i);
		 	if(parseInt(o.rev)>=parseInt(t.rev)) return i;
		 	if(kq==-1)
	 		{
		 		strnodenouse=","+i+","+strnodenouse;
	 		}	
		 }
	}
	else
	{
		
		for(var i=stt+1;i<=spt;i++)
		 {
		 	
		 	var o=document.getElementById("a_"+i);
		 	if(o.rel=="c_"+stt) 
		 	{
		 		var kq=strnodenouse.indexOf(","+i+",",0);
			 	if(kq==-1)
			 		return i;
			 	else
		 		{
			 		strnodenouse=strnodenouse.replace(","+i+",","");		 			
		 		}
		 	}
		 }
	}
}
function get_nextnode(stt,spt,opt)
{
	if(opt==-1)
		{
		 for(var i=stt-1;i>0;i--)
			 {
			 	var kq=strnodenouse.indexOf(","+i+",",0);
			 	if (kq==-1) return i;
			 }
		}
	else
		{
		 for(var i=stt+1;i<=spt;i++)
		 {
		 	var kq=strnodenouse.indexOf(","+i+",",0);
		 	if (kq==-1) return i;
		 }
		
		}
}
function KeyPublicRun(e)
{
	var keynum;
	var keychar;
	var numcheck;
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;		
	if(keynum=="76" || keynum=="108")
		{
		if(e.shiftKey==true)
			{
				var tparent=document.getElementById('chkAll');
				var t=document.getElementById('lvChk'+(parseInt(tparent.value)+1));
				t.checked=true;
				RowLight(t);
				t.focus();
			}
		}
	else if(keynum=="18" || keynum=="32")
	{
	if(e.ctrlKey==true)
		{
			var tparent=document.getElementById('chkAll');
			var t=document.getElementById('lvChk'+(parseInt(tparent.value)+1));
			t.checked=true;
			RowLight(t);
			t.focus();
		}
	}
	else if(keynum=="122" )
	{
		var isfull=document.getElementById('fullscreen').value;
		if(isfull=='1') 
			document.getElementById('fullscreen').value='0';
		else
			document.getElementById('fullscreen').value='1';
			setConfirmView();
			startscreen();
			
	}
	else if(keynum=="77" || keynum=="109")
	{
	
	if(e.ctrlKey==true)
		{
			Cancel();
		}
	}
	else if(keynum=="120")
		{
		
			var t1=document.getElementById('menu_mousehover');
			var t2=document.getElementById('menu_treeview');
			if(e.ctrlKey==true)
				{
				var t3=document.getElementById('left_content');
				var t4=document.getElementById('center_content');
				if(t3.style.display=="none")
					{
					t4.style.width="1016px";
					t3.style.display="block";
					}
				else
					{
					t3.style.display="none";
					t4.style.width="100%";
					}
				}
			else
				{
					if(t1.style.display=="block")
						{
						t1.style.display="none";
						t2.style.display="block";
						o=document.getElementById("a_1");
						o.focus();
						}
					else
					{
						t2.style.display="none";
						t1.style.display="block";
					}
				}
		}
	else if(keynum=="40")
	{
		if(e.ctrlKey==true)
		{	o=document.getElementById("header");
			o.style.display="block";
			var t1=document.getElementById('header_menu_selected');
			t1.focus();
		}
	}
	else if(keynum=="39")
		{
			if(e.ctrlKey==true)
			{	NextRuntTime();
			}
		}
	else if(keynum=="38")
	{
		if(e.ctrlKey==true)
		{	
			o=document.getElementById("header");
			o.style.display="none";
		}
	}
	else if(keynum=="37")
	{
		if(e.ctrlKey==true)
		{	BackRuntTime();
		}
	}
	return;
}
function CheckKeyCheck(e,opt,id,frm, chkName, chkAllName,order)
{
	var keynum;
	var keychar;
	var numcheck;
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum=="13")
	{
		switch(opt)
		{
			case 1:
				Add();
				break;
			case 2:
				Edt();
				break;
			case 3:
				Del();
				break;
			case 4:
				Back();
				break;
			case 6:
				Filter();
				break;
			case 7:
				Save();
				break;
			
		}
		
	}
	else if(keynum=="40")
	{
		if(e.shiftKey==false && e.ctrlKey==false )
		{
			var t=document.getElementById(id+order);
			t.checked=false;
			RowLight(t);
		}
		if(e.ctrlKey==true)
			Select_NoCheck(id+(order+1),frm, chkName, chkAllName);
		else
			Select_Check(id+(order+1),frm, chkName, chkAllName);
	}
	else if(keynum=="38")
	{
		if(e.shiftKey==false && e.ctrlKey==false)
		{
			var t=document.getElementById(id+order);
			t.checked=false;
			RowLight(t);
		}
		if(e.ctrlKey==true)
			Select_NoCheck(id+(order-1),frm, chkName, chkAllName);
		else
			Select_Check(id+(order-1),frm, chkName, chkAllName);
	}
	else if(keynum=="120" || keynum=="88")
	{
		if(e.shiftKey==true)
			{
			Del();
			}
	}
	else if(keynum=="70" || keynum=="102")
	{
		if(e.shiftKey==true)
			{
			Fil();
			}
	}
	else if(keynum=="82" || keynum=="114")
	{
		if(e.shiftKey==true)
			{
			Rpt();
			}
	}
	else if(keynum=="65" || keynum=="97")
	{
		if(e.shiftKey==true)
			{
			Add();
			}
	}
	else if(keynum=="69" || keynum=="101")
	{
		if(e.shiftKey==true)
			{
			Edt();
			}
	}
	else if(keynum=="67" || keynum=="99")
	{
		if(e.shiftKey==true)
		{
			var t=document.getElementById(id+order);
			FunctRunning1(t.value);
		}
		
	}
	else if(keynum=="86" || keynum=="116")
		{
			if(e.shiftKey==true)
			{
				var t=document.getElementById("submenu-nav");
				if(t.style.display!="block")
					{
					t.style.display="block";
					var o=document.getElementById("lvdisplaychk0");
					o.focus();					
					}
				else
					{
					var o=document.getElementById("lvChk1");
					o.focus();
					t.style.display="";
					}
			}
		}
	else if(keynum=="75" || keynum=="107")
	{
		if(e.shiftKey==true)
		{
			var t=document.getElementById("submenu1-nav");
			if(t.style.display!="block")
				{
				t.style.display="block";
				var o=document.getElementById("lvbuttonexcel");
				o.focus();					
				}
			else
				{
				var o=document.getElementById("lvChk1");
				o.focus();
				t.style.display="";
				}
		}
	}
	else if(keynum=="49" )
		{
			GotoPageMulti(document.frmchoose,document.frmchoose.curPg,1);
		}
	else if(keynum=="50" )
	{
		GotoPageMulti(document.frmchoose,document.frmchoose.curPg,2);
	}
	else if(keynum=="51" )
	{
		GotoPageMulti(document.frmchoose,document.frmchoose.curPg,3);
	}
	else if(keynum=="52" )
	{
		GotoPageMulti(document.frmchoose,document.frmchoose.curPg,4);
	}
	else if(keynum=="53" )
	{
		GotoPageMulti(document.frmchoose,document.frmchoose.curPg,5);
	}
	else if(keynum=="54" )
	{
		GotoPageMulti(document.frmchoose,document.frmchoose.curPg,6);
	}
	else if(keynum=="55" )
	{
		GotoPageMulti(document.frmchoose,document.frmchoose.curPg,7);
	}
	else if(keynum=="56" )
	{
		GotoPageMulti(document.frmchoose,document.frmchoose.curPg,8);
	}
	else if(keynum=="57" )
	{
		GotoPageMulti(document.frmchoose,document.frmchoose.curPg,9);
	}
	else if(keynum=="48" )
	{
		GotoPageMulti(document.frmchoose,document.frmchoose.curPg,10);
	}
}	
function CheckKeyCheckTabExp(e)
{
	var keynum;
	var keychar;
	var numcheck;
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum=="13" || keynum=="27")
	{
		var t=document.getElementById("submenu1-nav");
		var o=document.getElementById("lvChk1");
		o.focus();
		t.style.display="";
	}
}
function CheckKeyCheckTab(e,obj,num)
{

	var keynum;
	var keychar;
	var numcheck;
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum=="13")
	{
		SelectChk(obj,num);
	}
	else if(keynum=="27")
	{
		var t=document.getElementById("submenu-nav");
		var o=document.getElementById("lvChk1");
		o.focus();
		t.style.display="";
	}
}
function CheckKeyCheckOther(e,opt,id,frm, chkName, chkAllName,order,idother)
{
	var keynum;
	var keychar;
	var numcheck;
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum=="13")
	{
		switch(opt)
		{
			case 1:
				Add();
				break;
			case 2:
				Edt();
				break;
			case 3:
				Del();
				break;
			case 4:
				Back();
				break;
			case 6:
				Filter();
				break;
			case 7:
				Save();
				break;
			
		}
		
	}
	else if(keynum=="40")
	{
		if(e.shiftKey==false && e.ctrlKey==false )
		{
			var t=document.getElementById(id+order);
			t.checked=false;
			RowLight(t);
		}
		if(e.ctrlKey==true)
			Select_NoCheckOther(id+(order+1),frm, chkName, chkAllName,idother+(order+1));
		else
			Select_CheckOther(id+(order+1),frm, chkName, chkAllName,idother+(order+1));
	}
	else if(keynum=="38")
	{
		if(e.shiftKey==false && e.ctrlKey==false)
		{
			var t=document.getElementById(id+order);
			t.checked=false;
			RowLight(t);
		}
		if(e.ctrlKey==true)
			Select_NoCheckOther(id+(order-1),frm, chkName, chkAllName,idother+(order-1));
		else
			Select_CheckOther(id+(order-1),frm, chkName, chkAllName,idother+(order-1));
	}
	else if(keynum=="120" || keynum=="88")
	{
		if(e.shiftKey==true)
			{
			Del();
			}
	}
	else if(keynum=="70" || keynum=="102")
	{
		if(e.shiftKey==true)
			{
			Fil();
			}
	}
	else if(keynum=="82" || keynum=="114")
	{
		if(e.shiftKey==true)
			{
			Rpt();
			}
	}
	else if(keynum=="65" || keynum=="97")
	{
		if(e.shiftKey==true)
			{
			Add();
			}
	}
	else if(keynum=="69" || keynum=="101")
	{
		if(e.shiftKey==true)
			{
			Edt();
			}
	}
	else if(keynum=="67" || keynum=="99")
	{
		if(e.shiftKey==true)
		{
			var t=document.getElementById(id+order);
			FunctRunning1(t.value);
		}
		
	}

}	
function Select_Check(id,frm, chkName, chkAllName)
{
	var o=document.getElementById(id);
	if(o)
		{
			o.checked=!(o.checked);	
			o.focus();
			CheckOne(frm, chkName, chkAllName,o);
		}
}
function Select_CheckOther(id,frm, chkName, chkAllName,idother)
{
	var o=document.getElementById(id);
	if(o)
		{
			o.checked=!(o.checked);	
			var o1=document.getElementById(idother);
			o1.select();
			CheckOne(frm, chkName, chkAllName,o);
		}
}
function Select_NoCheck(id,frm, chkName, chkAllName)
{
	var o=document.getElementById(id);
	if(o)
		{
			o.focus();
			CheckOne(frm, chkName, chkAllName,o);
		}
}
function Select_NoCheckOther(id,frm, chkName, chkAllName,idother)
{
	var o=document.getElementById(id);
	if(o)
		{
			var o1=document.getElementById(idother);
			o1.select();
			CheckOne(frm, chkName, chkAllName,o);
		}
}
function PopupSelect(vvalue,vobjid)
{
	div1 = document.getElementById(vobjid);
	div1.value=vvalue;
	div1.focus();
	var Items = document.getElementById("lv_popup");
	Items.innerHTML='';
	
}
function PopupSelectNext(vvalue,vobjid)
{
	div1 = document.getElementById(vobjid);
	div1.value=div1.value+vvalue;
	div1.focus();
	var Items = document.getElementById("lv_popup");
	Items.innerHTML='';
	
}
function LoadPopupParentTabIndex2(e,o,obj,table,field,fieldreturn)
{
	var keynum;
	var keychar;
	var numcheck;
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum!=9 && keynum!=16 && keynum!=13  )
	{
		ajax_do ('lv_ct015/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfield='+field+'&fieldreturn='+fieldreturn,2);
	}
}
function LoadPopupParentTabIndex(e,o,obj,table,field)
{
	var keynum;
	var keychar;
	var numcheck;
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum!=9 && keynum!=16 && keynum!=13  )
	{
		ajax_do ('lv_ct011/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfield='+field,2);
	}
}
function LoadPopupTabIndex(e,o,obj,table,field)
{
	var keynum;
	var keychar;
	var numcheck;
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum!=9 && keynum!=16 && keynum!=13  )
	{
		ajax_do ('../lv_ct011/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfield='+field,2);
	}
}
function LoadPopup(o,obj,table,field)
{
	ajax_do ('../lv_ct001/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfield='+field,2);	
}
function LoadPopupSecond(o,obj,table,field)
{
	ajax_do ('../lv_ct008/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfield='+field,2);
	
}
function LoadPopupParentSecond(o,obj,table,field)
{
	ajax_do ('lv_ct008/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfield='+field,2);
	
}
function LoadPopupParent(o,obj,table,field)
{
	ajax_do ('lv_ct001/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfield='+field,2);
	
}
function LoadPopupParentWH(o,obj,table,field)
{
	ajax_do ('lv_ct006/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfield='+field,2);
	
}
function LoadPopupParentWHCondi(o,obj,table,field,condi)
{
	ajax_do ('lv_ct007/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfield='+field+'&condi='+condi,2);
	
}
function LoadPopupParentCSCondi(o,obj,table,field,condi)
{
	ajax_do ('../lv_ct008/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfield='+field+'&condi='+condi,2);
	
}
function LoadText(o,obj,table,field,vid2,vopt,vlang)
{
	ajax_do ('../lv_ct002/?lang='+vlang+'&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfield='+field+'&id2='+vid2+'&lvopt='+vopt,2);
	
}
function LoadTextParent(o,obj,table,field,vid2,vopt,vlang)
{
	ajax_do ('lv_ct002/?lang='+vlang+'&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfield='+field+'&id2='+vid2+'&lvopt='+vopt,2);
	
}
function LoadSelf(o,obj,table,field)
{
	ajax_do ('../lv_ct003/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfield='+field,2);
}
function LoadSelfNext(o,obj,table,fieldreturn,fieldsearch)
{
	ajax_do ('../lv_ct004/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfieldreturn='+fieldreturn+'&objfieldsearch='+fieldsearch,2);
}
function LoadSelfNextParent(o,obj,table,fieldreturn,fieldsearch)
{
	ajax_do ('lv_ct004/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfieldreturn='+fieldreturn+'&objfieldsearch='+fieldsearch,2);
}
function LoadSelfCond3(o,obj,table,fieldreturn,fieldsearch,fieldreturn2,fieldsearch2,fieldreturn3,fieldsearch3)
{
	ajax_do ('../lv_ct004/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfieldreturn='+fieldreturn+'&objfieldsearch='+fieldsearch+'&objfieldreturn2='+fieldreturn2+'&objfieldsearch2='+fieldsearch2+'&objfieldreturn3='+fieldreturn3+'&objfieldsearch3='+fieldsearch3,2);
}
function Help(tbl,lang)
{
	window.open('hr_lv0211/readfile.php?&codehelp='+tbl+'&lang='+lang+'&type=8&size=0&lv=N*jlIUS02VFdULT*ZIS1QtNlFIQQ*==',tbl,'width=650,height=560,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes');
}
function LoadSelfNextParentNewSreen(o,obj,table,fieldreturn,fieldsearch,parentname,parentvalue,once_opt)
{
	if(parentvalue=='')
	{
		ajax_do ('lv_ct024/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfieldreturn='+fieldreturn+'&objfieldsearch='+fieldsearch+"&once_opt="+once_opt,2);
		return;
	}
	else
	{
		var parents=document.getElementById(parentvalue);
		if(parents==null) 
		{
			ajax_do ('lv_ct024/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfieldreturn='+fieldreturn+'&objfieldsearch='+fieldsearch+"&once_opt="+once_opt,2);
			return;
		}
	}
	ajax_do ('lv_ct024/?lang=<?php echo $plang;?>&objid='+obj+'&objvalue='+o.value+'&objtable='+table+'&objfieldreturn='+fieldreturn+'&objfieldsearch='+fieldsearch+'&ParentSearch='+parents.value+"&ParentName="+parentname+"&once_opt="+once_opt,2);
}	
function ProcessHiden()
{
	div = document.getElementById('lvright');
	if(div.innerHTML!='')
	{
		obj = document.getElementById('showparent');
		func_id = document.getElementById('func_id');
		if(obj==null)
		{
			obj1 = document.getElementById('lvleft');
			obj1.style.display="none";
		}
		else
		{
			obj.style.display="none";
			obj1 = document.getElementById('showparenttext');
			if(obj1.innerHTML=='') obj1.innerHTML='<div class="showparenttext" style="cursor:pointer;text-align:right;border-radius:5px 5px 0px 0px;" onclick="ShowParent(this,\'showparent\');"><img src="../images/open_list.png"/></div>';
			func_id.style.top="";
		}
	}
}
function ProcessTextHiden(olv)
{
	obj = document.getElementById('showparenttext');
	if(obj==null)
		{
		}
	else
		{
			obj.style.display='block';
			var nn6=document.getElementById&&!document.all;
			if(nn6)
				r = olv.parentNode.parentNode;
			else
				r = olv.parentElement.parentElement;
			LV_GetTable(r,nn6,obj)	
		}
}
function LV_GetTable(r,nn6,obj)
{
	if(nn6)
		var res = r.parentNode.innerHTML.split('<tr class="lvhtable">');
	else
		var res = r.parentElement.innerHTML.split('<tr class="lvhtable">');
		
	var end=res[1].split('</tr>');
	obj.innerHTML='<div class="showparenttext"  style="cursor:pointer;text-align:right;border-radius:5px 5px 0px 0px;" onclick="ShowParent(this,\'showparent\');"><img src="../images/open_list.png"/></div><div id="showlisttmp"><table class="lvtable">'+'<tr class="lvhtable">'+end[0]+'</tr><tr>'+r.innerHTML+'</tr></table></div>';
}
function ProcessTextHidenMore(olv)
{
	obj = document.getElementById('showparenttext')
	if(obj==null)
		{
		}
	else
		{
			obj.style.display='block';
			var nn6=document.getElementById&&!document.all;
			if(nn6)
				r = olv.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
			else
				r = olv.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
			LV_GetTableMore(r,nn6,obj)	
		}
}
function LV_GetTableMore(r,nn6,obj)
{
	if(nn6)
		var res = r.parentNode.innerHTML.split('<tr class="lvhtable">');
	else
		var res = r.parentElement.innerHTML.split('<tr class="lvhtable">');
		
	var end=res[1].split('</tr>');
	obj.innerHTML='<div class="showparenttext"  style="cursor:pointer;text-align:right;border-radius:5px 5px 0px 0px;" onclick="ShowParent(this,\'showparent\');"><img src="../images/open_list.png"/></div><div id="showlisttmp"><table class="lvtable">'+'<tr class="lvhtable">'+end[0]+'</tr><tr>'+r.innerHTML+'</tr></table></div>';
}
function ProcessTextHidenMore2(olv)
{
	obj = document.getElementById('showparenttext')
	if(obj==null)
		{
		}
	else
		{
			obj.style.display='block';
			var nn6=document.getElementById&&!document.all;
			if(nn6)
				r = olv.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
			else
				r = olv.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
				LV_GetTableMore2(r,nn6,obj)	
		}
}
function LV_GetTableMore2(r,nn6,obj)
{
	if(nn6)
		var res = r.parentNode.innerHTML.split('<tr class="lvhtable" id="CC_Title">');
	else
		var res = r.parentElement.innerHTML.split('<tr class="lvhtable" id="CC_Title">');
		
	var end=res[1].split('</tr>');
	obj.innerHTML='<div class="showparenttext"  style="cursor:pointer;text-align:right;border-radius:5px 5px 0px 0px;" onclick="ShowParent(this,\'showparent\');"><img src="../images/open_list.png"/></div><div id="showlisttmp"><table class="lvtable">'+'<tr class="lvhtable">'+end[0]+'</tr><tr>'+r.innerHTML+'</tr></table></div>';
}
function ShowParent(o,str)
{
	if(document.getElementById(str).style.display=='block')
	{	
		obj = document.getElementById('showparenttext');	
		obj.style.height='';
		obj.style.display='block';
		document.getElementById(str).style.display="none";
		document.getElementById('showlisttmp').style.display='block';		
		
	}
	else
	{
		obj = document.getElementById('showparenttext');	
		obj.style.height='';
		obj.style.display='none';
		document.getElementById(str).style.display="block";
		document.getElementById('showlisttmp').style.display='none';

	}
	//o.innerHTML='';
	
}
function openchildmenu(vmenu)
{
	if(document.getElementById(vmenu).style.display=='block')
		document.getElementById(vmenu).style.display='none';
	else
		document.getElementById(vmenu).style.display='block'
	if(document.getElementById('idleft_cur').value!="" && document.getElementById('idleft_cur').value!=vmenu) 
	{
		document.getElementById(document.getElementById('idleft_cur').value).style.display='none';
	}
		document.getElementById('idleft_cur').value=vmenu;
}
function resizeWidthAll(width,height)
{
	var o=document.getElementById('showparent');
	var o1=document.getElementById('showparenttext');
	var o2=document.getElementById('lvright');
	
	//o.style.width = parseInt(width-20,10) + 'px';
	o1.style.width = parseInt(width-20,10) + 'px';
	o2.style.width = parseInt(width-20,10) + 'px';
/*	o.style.height = parseInt(height,10) + 'px';
	o1.style.height = parseInt(height,10) + 'px';
	o2.style.height= parseInt(height,10) + 'px';*/
}
function resizeFrameAll(width,height)
{
		var ofr=parent.document.getElementById('lvframefrm');
		var to=parent.parent.document.getElementById('curtab');
		var ofrpar=parent.parent.document.getElementById('blogIframe_'+to.value);
		if(height!=0)
		{
		ofr.style.height=(height+70)+'px';
		ofrpar.style.height=(height+130)+'px';
		}
		var oadd=document.getElementById('frmadd');
		var oedit=document.getElementById('frmedit');
		var ofil=document.getElementById('frmfilter');
		if(oadd!=null) oadd.style.width=(screen.width)+'px';
		if(oedit!=null) oedit.style.width=(screen.width)+'px';
		if(ofil!=null) ofil.style.width=(screen.width)+'px';
}
function NumberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
	}
function LayLaiGiaTri(o)
{
	if(o.title!='') o.value=o.title;
	o.select();
	
}
function SetGiaTri(o)
{
	o.title=o.value;
	if(parseFloat(o.title)>=1000) o.value=NumberWithCommas(o.title);
}
	function CloseMain(lang)
	{
		if(confirm('All changes you have made will be lost. Do you want to continue?'))
		{
			window.open('?lang='+lang,'_self')
		}
	}
	function CloseMainAll(func,lang,opt)
	{
		if(opt==0)
		{
			if(confirm('All changes you have made will be lost. Do you want to continue?'))
			{
				switch(func)
				{
					case 'PR':
						window.open('?lang='+lang+'&opt=22&item=&link=c2xfbHYwNDkxL3NsX2x2MDQ5MS5waHA=','_self');
						break;
					case 'LONGTERM':
						window.open('?lang='+lang+'&opt=22&item=&link=c2xfbHYwNDkyL3NsX2x2MDQ5Mi5waHA=','_self');
						break;
					case 'CO':
						window.open('?lang='+lang+'&opt=22&item=&link=c2xfbHYwNDkzL3NsX2x2MDQ5My5waHA=','_self');
						break;
					case 'CONTRACT':
						window.open('?lang='+lang+'&opt=22&item=&link=c2xfbHYwNDk0L3NsX2x2MDQ5NC5waHA=','_self');
						break;
					case 'RFA':
						window.open('?lang='+lang+'&opt=22&item=&link=c2xfbHYwNDk1L3NsX2x2MDQ5NS5waHA=','_self');
						break;
					case 'DOCS':
						window.open('?lang='+lang+'&opt=1&item=&link=c2xfbHYwNDk2L3NsX2x2MDQ5Ni5waHA=','_self');
						break;
					default:
						window.open('?lang='+lang,'_self');
						break;
				}
			}
		}
		else
		{
				switch(func)
				{
					case 'PR':
						window.open('?lang='+lang+'&opt=22&item=&link=c2xfbHYwNDkxL3NsX2x2MDQ5MS5waHA=','_self');
						break;
					case 'LONGTERM':
						window.open('?lang='+lang+'&opt=22&item=&link=c2xfbHYwNDkyL3NsX2x2MDQ5Mi5waHA=','_self');
						break;
					case 'CO':
						window.open('?lang='+lang+'&opt=22&item=&link=c2xfbHYwNDkzL3NsX2x2MDQ5My5waHA=','_self');
						break;
					case 'CONTRACT':
						window.open('?lang='+lang+'&opt=22&item=&link=c2xfbHYwNDk0L3NsX2x2MDQ5NC5waHA=','_self');
						break;
					case 'RFA':
						window.open('?lang='+lang+'&opt=22&item=&link=c2xfbHYwNDk1L3NsX2x2MDQ5NS5waHA=','_self');
						break;
					case 'DOCS':
						window.open('?lang='+lang+'&opt=1&item=&link=c2xfbHYwNDk2L3NsX2x2MDQ5Ni5waHA=','_self');
						break;
					default:
						window.open('?lang='+lang,'_self');
						break;
				}
		}
	}
	function RefreshMain()
	{
		if(confirm('All changes you have made will be refresh and delete temp data. Do you want to continue?'))
		{
			Refresh();
		}
	}
	function ConverStrScript(value)
	{
		return value.replace("&","!!!");
	}
	function CheckKeyValidCharID(e)
{
	var keynum;
	var keychar;
	var numcheck;
	if(window.event) // IE
	  {
	  keynum = e.keyCode;
	  }
	else if(e.which) // Netscape/Firefox/Opera
	  {
	  keynum = e.which;
	  }
	else
		keynum = e.keyCode;
	if(keynum=="32" || keynum=="39" || keynum=="34" || keynum=="35" || keynum=="40" || keynum=="41")
	{
		return false;
	}
	if(keynum=='') return false;

}
function showNoteMore(id)
{
	var o=document.getElementById(id);	
	o.style.display="block";
}