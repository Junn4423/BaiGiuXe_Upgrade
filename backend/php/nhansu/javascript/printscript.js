///////////////////////////////////////////////Hide Image after click Print Image////////////////////////////////////////////
/*
This function change image after click on a image 
and rechange first image after n second you can set.
Using:
<form id="frm" name="frm">
	<img id="img" name="img" src="dose.gif" 
		onclick="hideImgPrint(document.frm, document.frm.img, 'dose2.gif', 'dose.gif');" />
</form>
*/
/*-------------------------------------------------------------------------------------------------------------------------*/
function hideImgPrint01(objFrm, objImg, strImg2, strImg1){
	///objFrm: form object
	///objImg: image object
	///strImg1: string image name 1
	///strImg2: string image name 2

	//Change image
	objImg.src = strImg2;
	//Proceessing print
	window.print();
	//Set timeout 5 second -> rechange first image
	var strRun = 'document.'+ objFrm.name +'.'+ objImg.name+'.src ="'+ strImg1+'"';
	setTimeout(strRun, 5000);
}
/*-------------------------------------------------------------------------------------------------------------------------*/
/*
		<script language="javascript" src="../../javascripts/printscript.js"></script>
		<tr>
			<form action="" id="frmImage" name="frmImage">
			<td class="specialtext" align="center" colspan="5">
				<a href="javascript:hideImgPrint(document.frmImage, document.frmImage.imgPrint, document.frmImage.imgClose, '../../images/iconcontrol/ic_print_off.gif', '../../images/iconcontrol/ic_print_on.gif', '../../images/iconcontrol/ic_close_off.gif', '../../images/iconcontrol/ic_close_on.gif');" style="text-decoration:none; color:#888888;">
					<img id="imgPrint" name="imgPrint" src="../../images/iconcontrol/ic_print_on.gif" border="0" align="absmiddle" title="<?php echo $vLangArr[4];?>"></a>
				<a href="javascript:window.close();" style="text-decoration:none; color:#888888;">
					<img id="imgClose" name="imgClose" src="../../images/iconcontrol/ic_close_on.gif" border="0" align="absmiddle" title="<?php echo $vLangArr[5];?>"></a>
			</td>
			</form>
		</tr>
*/
function hideImgPrint02(objFrm, objImg01, objImg02, strImgOff1, strImgOn1, strImgOff2, strImgOn2){
	objImg01.src = strImgOff1;
	objImg02.src = strImgOff2;
	window.print();
	var strRun = 'document.'+ objFrm.name +'.'+ objImg01.name+'.src ="'+ strImgOn1+'";'+'document.'+ objFrm.name +'.'+ objImg02.name+'.src ="'+ strImgOn2+'"';
	setTimeout(strRun, 5000);
}
///////////////////////////////////////////////Hide Image after click Print Image////////////////////////////////////////////

//-------------------------------------------------------------------------------------------------------------------------//
/* truoc tien chen vao trang doan nay:
<script language="javascript" src="../../javascripts/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">

*/
function loadImgsPrint(vDir){
	document.write('<DIV id=\"MenuDiv\" STYLE=\"position:absolute;right:2;top:12;width:100;\"><a href=\"javascript:printWindow(\''+vDir+'\');\" style=\"text-decoration:none; color:#888888;\"><img id=\"imgPrint\" name=\"imgPrint\" src=\"'+vDir+'images/iconcontrol/printer.gif\" border=\"0\" align=\"absmiddle\" title=\"Print\"></a>&nbsp;&nbsp;<a href=\"javascript:window.close();\" style=\"text-decoration:none; color:#888888;\"><img id=\"imgClose\" name=\"imgClose\" src=\"'+vDir+'images/iconcontrol/door.gif\" border=\"0\" align=\"absmiddle\" title=\"Close\"></a></DIV>');
}
function printWindow(vDir){//hidden images
	var div=document.getElementById('MenuDiv');
	div.innerHTML="";//Gan du lieu rong vao tag div
	window.print();
	setTimeout('reloadImage(\''+vDir+'\')', 5000);
}
function reloadImage(vDir){//reshow images
	var div=document.getElementById('MenuDiv');
	div.innerHTML='<a href=\"javascript:printWindow(\''+vDir+'\');\" style=\"text-decoration:none; color:#888888;\"><img id=\"imgPrint\" name=\"imgPrint\" src=\"'+vDir+'images/iconcontrol/printer.gif\" border=\"0\" align=\"absmiddle\" title=\"Print\"></a>&nbsp;&nbsp;<a href=\"javascript:window.close();\" style=\"text-decoration:none; color:#888888;\"><img id=\"imgClose\" name=\"imgClose\" src=\"'+vDir+'images/iconcontrol/door.gif\" border=\"0\" align=\"absmiddle\" title=\"Close\"></a>';
}
//-------------------------------------------------------------------------------------------------------------------------//
function moveImgPrint(){
	var arr = new Array();
	arr = getBrowserSize();
	CreateStaticMenu("MenuDiv", arr[0], arr[1]);
}

////////////////////////////////////////////////Get Width And Height Of Browser//////////////////////////////////////////////
function getBrowserSize(){
	var arr = new Array();
	var winW = 630, winH = 460;
	if (parseInt(navigator.appVersion)>3) {
		if (navigator.appName=="Netscape") {
			winW = window.innerWidth;
			winH = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1) {
			winW = document.body.offsetWidth;
			winH = document.body.offsetHeight;
		}
		if (navigator.appName.appName=="Mozilla Firefox") {
			winW = document.body.offsetWidth;
			winH = document.body.offsetHeight;
		}
	}
	/* vi tri xuat hien cua imgs: giua phai */
	//arr[0] = winW-78-20;//tru di chieu rong cua 2 image va 2 phan trai, phai cua windows //origin 40
	//arr[1] = (winH/2)-23-20;//tru di chieu cao cua 2 image va 2 phan tren, duoi cua windows//origin-233
	
	/* vi tri xuat hien cua imgs: tren phai */
	arr[0] = winW-98-20;//tru di chieu rong cua 2 image va 2 phan trai, phai cua windows //origin 40
	arr[1] = 12;//chieu cao cua images

	/* vi tri xuat hien cua imgs: giua duoi */
	//arr[0] = (winW/2)-40;//tru di chieu rong cua 2 image va 2 phan trai, phai cua windows //origin 40
	//arr[1] = winH-30-10;//chieu cao cua images va them 1 doan nua
	/* vi tri xuat hien cua imgs */
	return arr;
}
////////////////////////////////////////////////Get Width And Height Of Browser//////////////////////////////////////////////
///////////////////////////////////////////4 files of foating banner are combine here////////////////////////////////////////
/*-------------------------------------------------------- staticMenu.js --------------------------------------------------*/
var myBrowser;
var staticMenu;

function CreateStaticMenu(theObj, x, y){
	myBrowser = new xBrowser();

	staticMenu = new xLayerFromObj(theObj);
	staticMenu.baseX = x;
	staticMenu.baseY = y;
	staticMenu.x = x;
	staticMenu.y = y;
	staticMenu.moveTo(x,y);
	staticMenu.show();
	setInterval("ani()", 20);
}
function ani(){
	var b = staticMenu;
	var targetX = myBrowser.getMinX() + b.baseX;
	var targetY = myBrowser.getMinY() + b.baseY;
	var dx = (targetX - b.x)/8;
	var dy = (targetY - b.y)/8;
	b.x += dx;
	b.y += dy;

	b.moveTo(b.x, b.y);
}
/*-------------------------------------------------------- staticMenu.js --------------------------------------------------*/

/*--------------------------------------------------------- xBrowser.js ---------------------------------------------------*/
/*** File    : xBrowser.js
** Created : 2000/07/15
** Author  : Roy Whittle  (Roy@Whittle.com) www.Roy.Whittle.com
** Purpose : To create a cross browser "Browser" object.
*		This library will allow scripts to query parameters
*		about the current browser window.
*
* History
* Date         Version        Description
*
* 2000-06-08	1.0		Initial version
* 2000-08-31	1.1		Made all parameters function calls
* 2000-10-14	1.2		Made compatible with NS6
***********************************************************************/
function xBrowser(){
	if(navigator.appName.indexOf("Netscape") != -1){
		this.getCanvasWidth	= function() {return innerWidth;}
		this.getCanvasHeight	= function() {return innerHeight;}
		this.getWindowWidth 	= function() {return outerWidth;}
		this.getWindowHeight	= function() {return outerHeight;}
		this.getScreenWidth 	= function() {return screen.width;}
		this.getScreenHeight	= function() {return screen.height;}
		this.getMinX		= function() {return(pageXOffset);}
		this.getMinY		= function() {return(pageYOffset);}
		this.getMaxX		= function() {return(pageXOffset+innerWidth);}
		this.getMaxY		= function() {return(pageYOffset+innerHeight);}
	} else if(document.all){
		this.getCanvasWidth	= function() {return document.body.clientWidth;}
		this.getCanvasHeight	= function() {return document.body.clientHeight;}
		this.getScreenWidth	= function() {return screen.width;}
		this.getScreenHeight	= function() {return screen.height;}
		this.getMinX		= function() {return(document.body.scrollLeft);}
		this.getMinY		= function() {return(document.body.scrollTop);}
		this.getMaxX		= function() {
			return(document.body.scrollLeft
				+document.body.clientWidth);
		}
		this.getMaxY		= function() {
				return(document.body.scrollTop
					+document.body.clientHeight);
		}
	}
	return(this);
}
/*** End  - xBrowser a cross browser "Browser" object by www.Roy.Whittle.com ***/
/*--------------------------------------------------------- xBrowser.js ---------------------------------------------------*/

/*---------------------------------------------------------- xLayer.js ----------------------------------------------------*/
/******************************************************************* 
* 
* File    : xLayer.js 
* 
* Created : 2000/06/08 
* 
* Author  : Roy Whittle  (Roy@Whittle.com) www.Roy.Whittle.com 
* 
* Purpose : To create a cross browser dynamic layers. This 
*		library is based on the library defined in the 
*		excellent book. "JavasScript - The Definitive guide" 
*		by David Flanagan. Published by O'Reilly. 
*		ISBN 1-56592-392-8 
* 
* History 
* Date         Version        Description 
* 
* 2000-06-08	1.0		Initial version 
* 2000-06-17	1.1		Changed function name to setzIndex()
* 2000-06-17	1.2		Changed function name to getzIndex()
* 2000-08-07	1.3		Added the event handling functionality
*					from the book.
* 2000-08-15	1.4		Finally! The NS functions are now prototypes.
* 2000-10-14	1.5		Attempting to add NS6 (W3C Standard) functionality
* 2000-11-04	1.6		Added NS6 Event handling
* 2000-11-06	1.7		Added xLayerFromObj - Allows pre existing 
*					layers/divs to gain the functionality of xLayer.
* 2000-11-19	1.8		Changed the event handling to use an event object
*					and make the core properties the same.
*					e.type, e.button
*					e.layerX, e.layerY,  e.clientX, e.clientY, e.pageX, e.pageY
*					e.keyCode, e.altKey, e.ctrlKey, e.shiftKey
***********************************************************************/ 
var xLayerNo=0; 
function xLayer(newLayer, x, y) 
{
	if(x==null)x=0; 
	if(y==null)y=0; 
 	if(document.layers) 
	{
		if(typeof newLayer == "string")
		{
			this.layer=new Layer(100); 
			this.layer.document.open(); 
			this.layer.document.write(newLayer); 
			this.layer.document.close(); 
		}
		else
			this.layer=newLayer;

		this.layer.moveTo(x,y); 
		this.images=this.layer.document.images; 
 	} 
	else 
	if(document.all) 
	{
		var Xname;
		if(typeof newLayer == "string")
		{
			xName="xLayer" + xLayerNo++; 
 			var txt =   "<DIV ID='" + xName 
				+ "' STYLE=\"position:absolute;" 
				+ "left:"  + x + ";" 
				+ "top:"   + y + ";" 
				+ "visibility:hidden\">" 
				+ newLayer 
 				+ "</DIV>"; 

			document.body.insertAdjacentHTML("BeforeEnd",txt); 
		}
		else
			xName=newLayer.id;

		this.content = document.all[xName]; 
		this.layer   = document.all[xName].style; 
		this.images  = document.images; 
	} 
	else 
	if (document.getElementById)
	{
		/*** Add Netscape 6.0 support (NOTE: This may work in I.E. 5+. Will have to test***/

		var newDiv;

		if(typeof newLayer == "string")
		{
			var xName="xLayer" + xLayerNo++;

			var txt = ""
				+ "position:absolute;"
				+ "left:"  + x + "px;"
				+ "top:"   + y + "px;"
				+ "visibility:hidden";

			var newRange   = document.createRange();

			newDiv = document.createElement("DIV");
			newDiv.setAttribute("style",txt);
			newDiv.setAttribute("id", xName);

			document.body.appendChild(newDiv);

			newRange.setStartBefore(newDiv);
			strFrag = newRange.createContextualFragment(newLayer);	
			newDiv.appendChild(strFrag);
		}
		else
			newDiv = newLayer;

		this.content = newDiv;	
		this.layer   = newDiv.style;
		this.images  = document.images;
	}

	return(this); 
} 

function xLayerFromObj(theObj)
{
	if(document.layers)
		return(new xLayer(document.layers[theObj]));
	else 
	if(document.all)
		return(new xLayer(document.all[theObj]));
	else 
	if(document.getElementById)
		return(new xLayer(document.getElementById(theObj)));
}

if(navigator.appName.indexOf("Netscape") != -1 && !document.getElementById)
{
var eventmasks = {
      onabort:Event.ABORT, onblur:Event.BLUR, onchange:Event.CHANGE,
      onclick:Event.CLICK, ondblclick:Event.DBLCLICK, 
      ondragdrop:Event.DRAGDROP, onerror:Event.ERROR, 
      onfocus:Event.FOCUS, onkeydown:Event.KEYDOWN,
      onkeypress:Event.KEYPRESS, onkeyup:Event.KEYUP, onload:Event.LOAD,
      onmousedown:Event.MOUSEDOWN, onmousemove:Event.MOUSEMOVE, 
      onmouseout:Event.MOUSEOUT, onmouseover:Event.MOUSEOVER, 
      onmouseup:Event.MOUSEUP, onmove:Event.MOVE, onreset:Event.RESET,
      onresize:Event.RESIZE, onselect:Event.SELECT, onsubmit:Event.SUBMIT,
      onunload:Event.UNLOAD
};

/**** START prototypes for NS ***/ 
xLayer.prototype.moveTo 	= function(x,y) 	{ this.layer.moveTo(x,y); }
xLayer.prototype.moveBy 	= function(x,y) 	{ this.layer.moveBy(x,y); }
xLayer.prototype.show		= function() 	{ this.layer.visibility = "show"; }
xLayer.prototype.hide 		= function() 	{ this.layer.visibility = "hide"; }
xLayer.prototype.setzIndex	= function(z)	{ this.layer.zIndex = z; }
xLayer.prototype.setBgColor 	= function(color) { this.layer.bgColor = color; if(color==null)this.layer.background.src=null;}
xLayer.prototype.setBgImage 	= function(image) { this.layer.background.src = image; }
xLayer.prototype.getX 		= function() 	{ return this.layer.left; }
xLayer.prototype.getY 		= function() 	{ return this.layer.top; }
xLayer.prototype.getWidth 	= function() 	{ return this.layer.width; }
xLayer.prototype.getHeight 	= function() 	{ return this.layer.height; }
xLayer.prototype.getzIndex	= function()	{ return this.layer.zIndex; }
xLayer.prototype.isVisible 	= function() 	{ return this.layer.visibility == "show"; }
xLayer.prototype.setContent   = function(xHtml)
{
	this.layer.document.open();
	this.layer.document.write(xHtml);
	this.layer.document.close();
}

xLayer.prototype.clip = function(x1,y1, x2,y2)
{
	this.layer.clip.top	=y1;
	this.layer.clip.left	=x1;
	this.layer.clip.bottom	=y2;
	this.layer.clip.right	=x2;
}
xLayer.prototype.addEventHandler = function(eventname, handler) 
{
        this.layer.captureEvents(eventmasks[eventname]);
        var xl = this;
        this.layer[eventname] = function(event) { 
		event.clientX	= event.pageX;
		event.clientY	= event.pageY;
		event.button	= event.which;
		event.keyCode	= event.which;
		event.altKey	=((event.modifiers & Event.ALT_MASK) != 0);
		event.ctrlKey	=((event.modifiers & Event.CONTROL_MASK) != 0);
		event.shiftKey	=((event.modifiers & Event.SHIFT_MASK) != 0);
            return handler(xl, event);
        }
}
xLayer.prototype.removeEventHandler = function(eventName) 
{
	this.layer.releaseEvents(eventmasks[eventName]);
	delete this.layer[eventName];
}

/*** END NS ***/ 
} 
else if(document.all) 
{ 
/*** START prototypes for IE ***/ 
xLayer.prototype.moveTo = function(x,y) 
{ 
	this.layer.pixelLeft = x; 
	this.layer.pixelTop = y; 
} 
xLayer.prototype.moveBy = function(x,y) 
{ 
	this.layer.pixelLeft += x; 
	this.layer.pixelTop += y; 
} 
xLayer.prototype.show		= function() 	{ this.layer.visibility = "visible"; } 
xLayer.prototype.hide		= function() 	{ this.layer.visibility = "hidden"; } 
xLayer.prototype.setzIndex	= function(z)	{ this.layer.zIndex = z; } 
xLayer.prototype.setBgColor	= function(color) { this.layer.backgroundColor = color==null?'transparent':color; } 
xLayer.prototype.setBgImage	= function(image) { this.layer.backgroundImage = "url("+image+")"; } 
xLayer.prototype.setContent   = function(xHtml)	{ this.content.innerHTML=xHtml; } 
xLayer.prototype.getX		= function() 	{ return this.layer.pixelLeft; } 
xLayer.prototype.getY		= function() 	{ return this.layer.pixelTop; } 
xLayer.prototype.getWidth	= function() 	{ return this.layer.pixelWidth; } 
xLayer.prototype.getHeight	= function() 	{ return this.layer.pixelHeight; } 
xLayer.prototype.getzIndex	= function()	{ return this.layer.zIndex; } 
xLayer.prototype.isVisible	= function()	{ return this.layer.visibility == "visible"; } 
xLayer.prototype.clip		= function(x1,y1, x2,y2) 
{ 
	this.layer.clip="rect("+y1+" "+x2+" "+y2+" "+x1+")"; 
	this.layer.pixelWidth=x2; 
	this.layer.pixelHeight=y2; 
	this.layer.overflow="hidden"; 
}
xLayer.prototype.addEventHandler = function(eventName, handler) 
{
	var xl = this;
	this.content[eventName] = function() 
	{ 
        var e = window.event;
		e.layerX = e.offsetX;
		e.layerY = e.offsetY;
        e.cancelBubble = true;
        return handler(xl, e); 
	}
}
xLayer.prototype.removeEventHandler = function(eventName) 
{
	this.content[eventName] = null;
}
 /*** END IE ***/ 
} 
else if (document.getElementById) 
{
/*** W3C (NS 6) ***/ 
xLayer.prototype.moveTo = function(x,y)
{
	this.layer.left = x+"px";
	this.layer.top = y+"px";
}
xLayer.prototype.moveBy 	= function(x,y) 	{ this.moveTo(this.getX()+x, this.getY()+y); } 
xLayer.prototype.show		= function() 	{ this.layer.visibility = "visible"; }
xLayer.prototype.hide		= function() 	{ this.layer.visibility = "hidden"; }
xLayer.prototype.setzIndex	= function(z)	{ this.layer.zIndex = z; }
xLayer.prototype.setBgColor	= function(color) { this.layer.backgroundColor = color==null?'transparent':color; }
xLayer.prototype.setBgImage	= function(image) { this.layer.backgroundImage = "url("+image+")"; }
xLayer.prototype.getX		= function() 	{ return parseInt(this.layer.left); }
xLayer.prototype.getY		= function() 	{ return parseInt(this.layer.top); }
xLayer.prototype.getWidth	= function() 	{ return parseInt(this.layer.width); }
xLayer.prototype.getHeight	= function() 	{ return parseInt(this.layer.height); }
xLayer.prototype.getzIndex	= function()	{ return this.layer.zIndex; }
xLayer.prototype.isVisible	= function()	{ return this.layer.visibility == "visible"; }
xLayer.prototype.clip		= function(x1,y1, x2,y2)
{
	this.layer.clip="rect("+y1+" "+x2+" "+y2+" "+x1+")";
	this.layer.width=x2 + "px";
	this.layer.height=y2+ "px";
	this.layer.overflow="hidden";
}
xLayer.prototype.addEventHandler = function(eventName, handler) 
{
	var xl = this;
	this.content[eventName] = function(e) 
	{ 
            e.cancelBubble = true;
            return handler(xl, e);
	}
}
xLayer.prototype.removeEventHandler = function(eventName) 
{
	delete this.content[eventName];
}
xLayer.prototype.setContent   = function(xHtml)
{
	var newRange   = document.createRange();
	newRange.setStartBefore(this.content);

	while (this.content.hasChildNodes())
		this.content.removeChild(this.content.lastChild);

	var strFrag    = newRange.createContextualFragment(xHtml);	
	this.content.appendChild(strFrag);
}

} else
{
xLayer.prototype.moveTo 	= function(x,y) 	{  }
xLayer.prototype.moveBy 	= function(x,y) 	{  }
xLayer.prototype.show 		= function() 	{  }
xLayer.prototype.hide 		= function() 	{  }
xLayer.prototype.setzIndex	= function(z) {  }
xLayer.prototype.setBgColor 	= function(color) {  }
xLayer.prototype.setBgImage 	= function(image) {  }
xLayer.prototype.getX 		= function() 	{ return 0; }
xLayer.prototype.getY 		= function() 	{ return 0; }
xLayer.prototype.getWidth 	= function() 	{ return 0; }
xLayer.prototype.getHeight 	= function() 	{ return 0; }
xLayer.prototype.getzIndex	= function()	{ return 0; }
xLayer.prototype.isVisible 	= function() 	{ return false; }
xlayer.prototype.setContent   = function(xHtml) { }
}

/*** End  - xLayer - a cross browser layer object by www.Roy.Whittle.com ***/ 
/*---------------------------------------------------------- xLayer.js ----------------------------------------------------*/

/*---------------------------------------------------------- xMouse.js ----------------------------------------------------*/
/******************************************************************* 
* 
* File    : xMouse.js 
* 
* Created : 2000/07/15 
* 
* Author  : Roy Whittle  (Roy@Whittle.com) www.Roy.Whittle.com 
* 
* Purpose : To create a cross browser "Mouse" object.
*		This library will allow scripts to query the current x,y
*		coordinates of the browser
* 
* History 
* Date         Version        Description 
* 2000-06-08	1.0		Initial version
* 2000-07-31	1.1		Some fixing up.
* 2000-10-14	1.2		Now works in IE 5.0+
***********************************************************************/
/*** Create an object able to hold the x,y coordinates ***/
function xMouse() 
{ 	this.X = 0;
	this.Y = 0;

	if(navigator.appName.indexOf("Netscape") != -1)
	{
		this.getMouseXY = function (evnt) 
		{
			document.ml.X=evnt.pageX;
			document.ml.Y=evnt.pageY;
		}

		window.captureEvents(Event.MOUSEMOVE);
		window.onmousemove = this.getMouseXY;

		document.ml = this;
	}
	else if(document.all)
	{
		if(navigator.appVersion.indexOf("MSIE 5.") != -1)
			this.getMouseXY = function ()
			{
				document.ml.X = event.x + document.body.scrollLeft;
				document.ml.Y = event.y + document.body.scrollTop;
			}
		else
			this.getMouseXY = function ()
			{
				document.ml.X = event.x;
				document.ml.Y = event.y;
			}

		document.ml = this;
		document.onmousemove = this.getMouseXY;
	} 
	return(this);
 
}
/*** End  - xMouse a cross browser "Mouse" object by www.Roy.Whittle.com ***/ 
/*---------------------------------------------------------- xMouse.js ----------------------------------------------------*/
///////////////////////////////////////////4 files of foating banner are combine here////////////////////////////////////////