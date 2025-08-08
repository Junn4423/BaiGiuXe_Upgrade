//********* Calendar DHTML *********
//Author : Danilo Priore
//Email  : support@prioregroup.com
//URL    : http://www.prioregroup.com
//Created: 16 Ago 2004
//
// Updates Date		Author				Description
//----------------------------------------------------------------------
// 19 Ago 2004      Danilo Priore		fix rows visibility
//										add more language calendar
// 25 Ago 2004		Danilo Priore		fix japan show
// 02 Spt 2004		Danilo Priore		show current sys date in bold
//
//
//This code is written and distributed under
//the GNU General Public License which means
//that its source code is freely-distributed
//and available to the general public. 
//**********************************
//
// showCalendar(textbox,lang);
//
// use:
//		showCalendar('DataValue','US');
//
// name		description
// ------------------------------------------
// textbox	name of input type text to
//			valorize with selected date.
// lang     language of the calendar and
//			for date format (US, IT, JP).
//
// NOTE: use the charset iso-8859-15
//
//<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
//
// global for week and month names
var weeks=new Array();
var months=new Array();

function showCalendar(textbox,lang){
	var cal=document.getElementById("Calendar");
	if(cal!=null)cal.datetype=lang;
	var obj=document.getElementById(textbox);
	if(obj!=null){
		var txt=obj.value;
		// week and month names
		if(lang=="US"||lang=="us"){
			weeks=Array('sun','mon','tue','wed','thu','fri','sat');
			months=Array('January','February','March','April','May','June','July','August','September','October','November','December');
			var month=txt.substring(0,2);
			var year=txt.substring(6,10);
		}
		else if(lang=="EN"||lang=="en"){
			weeks=Array('mon','tue','wed','thu','fri','sat','sun');
			months=Array('January','February','March','April','May','June','July','August','September','October','November','December');
			var month=txt.substring(0,2);
			var year=txt.substring(6,10);
		}
		else if(lang=="VN"||lang=="vn"){
			weeks=Array('T2','T3','T4','T5','T6','T7','CN');
			months=Array('ThÃ¡ng 1','ThÃ¡ng 2','ThÃ¡ng 3','ThÃ¡ng 4','ThÃ¡ng 5','ThÃ¡ng 6','ThÃ¡ng 7','ThÃ¡ng 8','ThÃ¡ng 9','ThÃ¡ng 10','ThÃ¡ng 11','ThÃ¡ng 12');
			var month=txt.substring(3,5);
			var year=txt.substring(6,10);
		}
		else if(lang=="IT"||lang=="it"){
			weeks=Array('dom','lun','mar','mer','gio','ven','sab');
			months=Array('Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre');
			var month=txt.substring(3,5);
			var year=txt.substring(6,10);
		}else if(lang=="JP"||lang=="jp"){
			weeks=Array('nic','get','kay','sui','mok','kin','doy');
			months=Array('Ichigatsu','Nigatsu','Sangatsu','Shigatsu','Gogatsu','Rukugatsu','Shichigatsu','Hachigatsu','Kugatsu','Juugatsu','Juuichigatsu','Juunigatsu');
			var month=txt.substring(5,7);
			var year=txt.substring(0,4);
		}else if(lang=="DE"||lang=="de"){
			weeks=Array('son','mon','die','mit','don','fre','sam');
			months=Array('Januar','Februar','MÃâ¬rz','April','Mag','Juni','Juli','August','September','Oktober','November','Dezember');
			var month=txt.substring(3,5);
			var year=txt.substring(6,10);
		}else if(lang=="FR"||lang=="fr"){
			weeks=Array('dim','lun','mar','mer','jeu','ven','sam');
			months=Array('Janvier','FÃÂ©vrier','Mars','Avril','Peut','Juin','Juillet','AoÃÂ»t','Septembre','Octobre','Novembre','DÃÂ©cembre');
			var month=txt.substring(3,5);
			var year=txt.substring(6,10);
		}else if(lang=="ES"||lang=="es"){
			weeks=Array('dom','lun','mar','miÃÂ©','jue','vie','sÃÂ¡b');
			months=Array('Enero','Febrero','Marcha','Abril','Puede','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
			var month=txt.substring(3,5);
			var year=txt.substring(6,10);
		}else if(lang=="PT"||lang=="pt"||lang=="BR"||lang=="br"){
			weeks=Array('dom','seg','ter','qua','qui','sex','sÃÂ¡b');
			months=Array('Janeiro','Fevereiro','MarÃÂ§o','Abril','Pode','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
			var month=txt.substring(3,5);
			var year=txt.substring(6,10);
		}	
		showCalendarEx(year,month,textbox);
	}
}
// extended function
function showCalendarEx(year,month,textbox){
	// init calendar
	var today=new Date();
	if(parseInt(year)!=0&&year!=null&&year!=''&&parseInt(month)!=0&&month!=null&&month!=''){
		today.setFullYear(year,month-1)}
	fillCalendar(today.getMonth(),today.getFullYear());
	var tab=document.getElementById("tabMonths");
	// clear month list
	var m=tab.rows;
	if(m!=null){
		for(var r=m.length;r>-1;r--){
			try{
				tab.deleteRow(m(r).rowIndex);
			}catch(e){}
		}
	}
	// fill month list
	for(var i=0;i<months.length;i++){
		var row=tab.insertRow(-1);
		addEvent(row,"mouseover",doItemOver);
		addEvent(row,"mouseout",doItemOut);
		addEvent(row,"click",doMonthClick);
		// month number (first cell)
		var cell=row.insertCell(-1);
		cell.innerHTML=i+1;
		// month name (last cell)
		var cell=row.insertCell(-1);
		cell.innerHTML=months[i];
	}
	// fill year list (one time)
	var tab=document.getElementById("tabYear");
	var years=tab.rows;
	if(years!=null){
		if(years.length==0){
			for(var i=0;i<150;i++){
				var row=tab.insertRow(-1);
				addEvent(row,"mouseover",doItemOver);
				addEvent(row,"mouseout",doItemOut);
				addEvent(row,"click",doYearClick);
				var cell=row.insertCell(-1);
				cell.innerHTML=1910+i;
			}
		}
	}
	setCalendar(textbox);
}
// set calendar position from mouse position and show
function setCalendar(textbox){
	var a=document.getElementById("Calendar");
	if(a!=null){
		var sty=a.style;
		if(sty!=null){
			var e=(window.event || a);
			sty.left=e.clientX-10;
			sty.top=e.clientY-10;
			if(parseInt(sty.left)+parseInt(sty.width)>screen.availWidth)
				sty.left=(e.clientX-parseInt(sty.width))+10;
			if(parseInt(sty.top)+parseInt(sty.height)>screen.availHeight)
				sty.top=(e.clientY-parseInt(sty.height))+10;
			a.textbox=textbox;
			sty.display="inline";
		}
	}
}
// fill table month/year/days
function fillCalendar(month,year){
	var tab=document.getElementById("tabCalendar");
	// clear clendar table
	var rows=tab.rows;
	if(rows!=null){
		for(var r=rows.length;r>-1;r--){
			try{
				tab.deleteRow(rows[r].rowIndex);
			}catch(e){}
		}
	}
	// month
	var m=document.getElementById("month");
	m.innerHTML=months[month];
	m.number=month;
	// year
	document.getElementById("year").innerHTML=year;
	// week names
	var tab=document.getElementById("tabCalendar");
	var row=tab.insertRow(-1);
	for(var i=0;i<weeks.length;i++){
		var cell=row.insertCell(-1);
		cell.innerHTML=weeks[i];
		if(i==0){
			var sty=cell.style;
			if(sty!=null) sty.color="#FF0000";
		}
	}
	// retrieve current system date
	var current=new Date();
	// retrieve first week
	var range=new Date();
	range.setFullYear(year,month,1);
	var start=range.getDay();
	// retrieve last day
	range.setMonth(range.getMonth()+1);
	range.setDate(1);
	range.setDate(range.getDate()-1);
	var max=range.getDate();
	// days
	var c=0;
	for(var r=0;r<6;r++){
		var row=tab.insertRow(-1);
		for(var i=0;i<7;i++){
			var cell=row.insertCell(-1);
			if((r==0&&i>=start)||(r>0&&c<max)){
				c++;
				cell.innerHTML=c;
				cell.align="right";
				addEvent(cell,"mouseover",doDayOver);
				addEvent(cell,"mouseout",doDayOut);
				addEvent(cell,"click",doDayClick);
				var sty=cell.style;
				if(sty!=null){
					// colored the last week day
					if(i==0) sty.color="#FF0000";
					// bold current system date
					if(c==current.getDate()&&month==current.getMonth()&&year==current.getYear()){
						sty.fontWeight="bold";
						sty.textDecoration="underline";
					}
				}
			}
		}
	}
}
// make color on mouse over
function doItemOver(){
	var cell=event.srcElement;
	if(cell!=null){
		var row=cell.parentElement;
		if(row!=null){
			var sty=row.style;
			if(sty!=null){
				sty.color="#FFFFFF";
				sty.background="#000080";
				sty.cursor="pointer";
			}
		}
	}
}
// restore color on mouse out
function doItemOut(){
	var cell=event.srcElement;
	if(cell!=null){
		var row=cell.parentElement
		if(row!=null){
			var sty=row.style;
			if(sty!=null){
				sty.color="#000000";
				sty.background="#FFFFFF";
				sty.cursor="default";
			}
		}
	}
}
// show month list
function showMonths(vobj){
	var month=document.getElementById("lstMonths");
	if(month!=null){
		var sty=month.style;
		if(sty!=null)
		{
			if(!nn6)
			{
				sty.left=event.clientX-10;
				sty.top=event.clientY-10;
			}
			sty.display="inline";
		}
	}
}
// show year list
function showYears(){
	var year=document.getElementById("lstYear");
	if(year!=null){
		var sty=year.style;
		if(sty!=null){
			if(!nn6)
			{
				sty.left=event.clientX-10;
				sty.top=event.clientY-10;
			}
			sty.display="inline";
		}
	}
}
// hide list
function hideList(e){
	if(!nn6)	var e=event.srcElement;
	if(e!=null){
		var sty=e.style;
		if(sty!=null) sty.display="none";
	}
}
// set new month
function doMonthClick(vobj){
	if(nn6)
	{
		cell=vobj.target;
	}
	else
		var cell=event.srcElement;
	if(cell!=null){
		if(nn6)
		{
			var row=cell.parentNode;						
		}
		else
		{
			var row=cell.parentElement;			
		}
		var year=document.getElementById("year");
		if(row!=null&&year!=null){
			var cells=row.cells;
			if(cells!=null) fillCalendar(parseInt(cells[0].innerHTML)-1,year.innerHTML);
		}
	}
	var month=document.getElementById("lstMonths");
	if(month!=null){
		var sty=month.style;
		if(sty!=null) sty.display="none";
	}
}
// set new year
function doYearClick(vobj){
	var vmonth=document.getElementById("month")
	if(nn6)
	{
		var e=vobj.target;		
	}
	else
	{
		var e=event.srcElement;
	}
	var month=document.getElementById("month");
	if(e!=null&&month!=null) fillCalendar(month.number,e.innerHTML);
	var year=document.getElementById("lstYear");
	if(year!=null){
		var sty=year.style;
		if(sty!=null) sty.display="none";
	}
}
// make color on mouse over for single day
function doDayOver(vobj){
	var vmonth=document.getElementById("month")
	if(nn6)
	{
		var cell=vobj.target;		
	}
	else
	{
		var cell=event.srcElement;
	}	
	var sty=cell.style;
	if(sty!=null){
		sty.color="#FFFFFF";
		sty.background="#000080";
		sty.cursor="pointer";
	}
}
// restore color on mouse out for single day
function doDayOut(vobj){
	var vmonth=document.getElementById("month")
	if(nn6)
	{
		var cell=vobj.target;		
	}
	else
	{
		var cell=event.srcElement;
	}
	if(cell!=null){
			if(nn6)
			{
				var row=cell.parentNode;
			}
			else
			{
				var row=cell.parentElement;				
			}
		if(row!=null){
			var cells=row.cells;
			var sty=cell.style;
			if(sty!=null&&cells!=null){
				if(cell.innerHTML==cells[0].innerHTML)
				{
					sty.color="#FF0000";
				}
				else{
					sty.color="#000000";
				}
				sty.background="#FFFFFF";
				sty.cursor="default";
			}
		}
	}
}
// previous month
function prevMonth(){
	var dt=new Date();
	var year=document.getElementById("year");
	var month=document.getElementById("month");
	if(year!=null&&month!=null) dt.setFullYear(year.innerHTML,month.number);
	dt.setMonth(dt.getMonth()-1);
	fillCalendar(dt.getMonth(),dt.getFullYear());
}
// next month
function nextMonth(){
	var dt=new Date();
	var year=document.getElementById("year");
	var month=document.getElementById("month");
	if(year!=null&&month!=null) dt.setFullYear(year.innerHTML,month.number);
	dt.setMonth(dt.getMonth()+1);
	fillCalendar(dt.getMonth(),dt.getFullYear());
}
// return date selected and hide calendar
function doDayClick(vValue){
	var vmonth=document.getElementById("month")
	if(CheckEvent(vmonth)==1)
	{
		var day=vValue.target.innerHTML;		
	}
	else
	{
		var day=window.event.srcElement.innerHTML;
	}
	var month=document.getElementById("month").number+1;
	var year=document.getElementById("year").innerHTML;
	var a=document.getElementById("Calendar");
	if(a!=null){
		if(day<10) day="0"+day;
		if(month<10) month="0"+month;
		if(a.textbox!=" "){
			if(a.datetype=="US"||a.datetype=="us"){
				document.getElementById(a.textbox).value=month+"/"+day+"/"+year;
			}
			else if(a.datetype=="EN"||a.datetype=="en"){
				document.getElementById(a.textbox).value=month+"/"+day+"/"+year;
			}
			else if(a.datetype=="VN"||a.datetype=="vn"){
				document.getElementById(a.textbox).value=day+"-"+month+"-"+year;
			}else if(a.datetype=="IT"||a.datetype=="it"){
				document.getElementById(a.textbox).value=day+"-"+month+"-"+year;
			}else if(a.datetype=="JP"||a.datetype=="jp"){
				document.getElementById(a.textbox).value=year+"/"+month+"/"+day;
			}else if(a.datetype=="DE"||a.datetype=="de"){
				document.getElementById(a.textbox).value=day+"."+month+"."+year;
			}else if(a.datetype=="FR"||a.datetype=="fr"){
				document.getElementById(a.textbox).value=day+"/"+month+"/"+year;
			}else if(a.datetype=="ES"||a.datetype=="es"){
				document.getElementById(a.textbox).value=day+"/"+month+"/"+year;
			}else if(a.datetype=="PT"||a.datetype=="pt"||a.datetype=="BR"||a.datetype=="br"){
				document.getElementById(a.textbox).value=day+"/"+month+"/"+year;
			}
			closeCalendar();
		}
	}
}
// close calendar
function closeCalendar(){
	var a=document.getElementById("Calendar");
	if(a!=null){
		var sty=a.style;
		if(sty!=null) sty.display="none";
	}
}
// add a event
function addEvent(obj,evname,func){
	try{
		obj.attachEvent("on"+evname,func);
	}catch(e){
		try{
			obj.addEventListener(evname,func,false);
		}catch(e){}
	}
}
function CheckEvent(obj){
	if(obj.addEventListener)
		return 1;
	else
		return 0;
	
}
//
// document html, calendar popup
var htm= "<div id=\"Calendar\" style=\"BORDER:#000000 2px solid;FONT-SIZE:12px;BACKGROUND:#ffffff;OVERFLOW auto;FONT-FAMILY:Verdana,Arial,Helvetica;POSITION:absolute;DISPLAY:none;Z-INDEX:200;FILTER:progid:DXImageTransform.Microsoft.Shadow(color=\"#000000\",Direction=135,Strength=6)\" textbox=\" \" datetype=\" \">";
htm+= "<table bgcolor=\"#295284\" border=\"0\" style=\"FONT-SIZE:12px;FONT-FAMILY:Verdana,Arial,Helvetica\">";
htm+= "<tr><td width=\"20px\"><input type=\"button\" value=&#9668; onclick=\"prevMonth()\" style=\"cursor:pointer;font-weigh:bold;width:30px\"></td>";
htm+= "<td align=\"center\" width=\"90px\"><b><span id=\"month\" style=\"color:#FFFFFF;cursor:pointer\" onclick=\"showMonths()\" number=\"0\">month</span></b></td>";
htm+= "<td align=\"center\" width=\"40px\"><b><span id=\"year\" style=\"color:#FFFFFF;cursor:pointer\" onclick=\"showYears()\">year</span></b></td>";
htm+= "<td width=\"20px\"><input type=\"button\" value=&#9658; onclick=\"nextMonth()\" style=\"cursor:pointer;font-weigh:bold;width:30px\"></td>";
htm+= "<td><input type=\"button\" value=\"x\" onclick=\"closeCalendar()\" style=\"cursor:pointer;font-weigh:bold;width:20px\"></td></tr></table>";
htm+= "<table id=\"tabCalendar\" width=\"220px\" style=\"COLOR:#000000;FONT-SIZE:12px;FONT-FAMILY:Verdana,Arial,Helvetica\"><tbody></tbody></table>";
htm+= "</div>";
htm+= "<div id=\"lstMonths\" onmouseleave=\"hideList(this)\" style=\"WIDTH:120px;HEIGHT:130px;BORDER:#000000 2px solid;BACKGROUND:#ffffff;OVERFLOW:auto;FONT-SIZE:12px;FONT-FAMILY:Verdana,Arial,Helvetica;SCROLLBAR-FACE-COLOR:#295284;SCROLLBAR-SHADOW-COLOR:#003e68;SCROLLBAR-3DLIGHT-COLOR:#295284;SCROLLBAR-ARROW-COLOR:#f7efb5;SCROLLBAR-TRACK-COLOR:#cedef7;SCROLLBAR-DARKSHADOW-COLOR:#000000;SCROLLBAR-HIGTLIGHT-COLOR:#CEDEF7;POSITION:absolute;DISPLAY:none;Z-INDEX:201\"><table id=\"tabMonths\" border=\"0\" width=\"100%\" style=\"COLOR:#000000;FONT-SIZE:12px;FONT-FAMILY:Verdana,Arial,Helvetica\"></table></div>";
htm+= "<div id=\"lstYear\" onmouseleave=\"hideList()\" style=\"WIDTH:70px;HEIGHT:130px;BORDER:#000000 2px solid;BACKGROUND:#ffffff;OVERFLOW:scroll;FONT-SIZE:12px;FONT-FAMILY:Verdana,Arial,Helvetica;SCROLLBAR-FACE-COLOR:#295284;SCROLLBAR-SHADOW-COLOR:#003e68;SCROLLBAR-3DLIGHT-COLOR:#295284;SCROLLBAR-ARROW-COLOR:#f7efb5;SCROLLBAR-TRACK-COLOR:#cedef7;SCROLLBAR-DARKSHADOW-COLOR:#000000;SCROLLBAR-HIGTLIGHT-COLOR:#CEDEF7;POSITION:absolute;DISPLAY:none;Z-INDEX:201\"><table id=\"tabYear\" border=\"0\" width=\"100%\" style=\"COLOR:#000000;FONT-SIZE:12px;FONT-FAMILY:Verdana,Arial,Helvetica\"></table></div>";
document.write(htm);
