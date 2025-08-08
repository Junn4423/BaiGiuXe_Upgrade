// JavaScript Document

var showimage1		= "yes"		//  SHOW FIRST SIDEBAR IMAGE
var showimage2		= "yes"		//  SHOW SECOND SIDEBAR IMAGE
var linkstop 		= "no" 		//  START LINKS AT THE VERY TOP

function IEHoverPseudopopup() {
	var navItems = document.getElementById("pop-nav").getElementsByTagName("li");
	for (var i=0; i<navItems.length; i++) {
		if(navItems[i].className == "menupopT") {
			navItems[i].onmouseover=function() { this.className += " over"; }
			navItems[i].onkeyup=function() { this.className += " over"; }
			navItems[i].onmouseout=function() { this.className = "menupopT"; }
			navItems[i].onblur=function() { this.className = "menupopT"; }
		}
	}

}
function ChangeName(o,vopt)
{
	if(o.id=='pop-nav') 
		{IEHoverPseudopopup();
		return;
		}
	div1 = document.getElementById('pop-nav');
	if(div1!=null)	div1.id=div1.lang;
	o.id='pop-nav';
	div2 = document.getElementById('lv_popup');
	div2.style.display="none";
	if(div2!=null)	div2.id=div2.lang;
	div3 = document.getElementById('lv_popup'+vopt);
	div3.id='lv_popup';	
	div3.style.display="block";
	IEHoverPseudopopup();
	
}
window.onload = IEHoverPseudopopup;