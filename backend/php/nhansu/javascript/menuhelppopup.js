// JavaScript Document

var showimage1		= "yes"		//  SHOW FIRST SIDEBAR IMAGE
var showimage2		= "yes"		//  SHOW SECOND SIDEBAR IMAGE
var linkstop 		= "no" 		//  START LINKS AT THE VERY TOP

function IEHoverPseudopopup3() {

	var navItems = document.getElementById("helppop-nav").getElementsByTagName("li");
	for (var i=0; i<navItems.length; i++) {
		if(navItems[i].className == "menuhelppopT") {
			navItems[i].onmouseover=function() { this.className += " over"; }
			navItems[i].onmouseout=function() { this.className = "menuhelppopT"; }
		}
	}

}

function ChangeName1(o,vopt)
{
	if(o.id=='helppop-nav') return;
	div1 = document.getElementById('helppop-nav');
	div1.id=div1.lang;
	o.id='helppop-nav';
	div2 = document.getElementById('lv_helppopup');
	div2.id=div2.lang;	

	div3 = document.getElementById('lv_helppopup'+vopt);
	div3.id='lv_helppopup';	
	IEHoverPseudopopup3();
	
}
window.onload = IEHoverPseudopopup3;