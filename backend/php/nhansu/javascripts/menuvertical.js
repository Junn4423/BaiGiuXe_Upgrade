<!-- Begin

// NOTE: If you use a ' add a slash before it like this \'

// USE lowercase FOR ALL OPTIONS ONLY

var showimage1		= "yes"		//  SHOW FIRST SIDEBAR IMAGE
var showimage2		= "yes"		//  SHOW SECOND SIDEBAR IMAGE
var linkstop 		= "no" 		//  START LINKS AT THE VERY TOP




// COPYRIGHT 2005 © Allwebco Design Corporation
// Unauthorized use or sale of this script is strictly prohibited by law

// YOU DO NOT NEED TO EDIT BELOW THIS LINE









function IEHoverPseudo() {
	var navItems = document.getElementById("top-nav").getElementsByTagName("li");
	for (var i=0; i<navItems.length; i++) {
		if(navItems[i].className == "menuT") {
			navItems[i].onmouseover=function() { this.className += " over"; }
			navItems[i].onmouseout=function() { this.className = "menuT"; }
		}
	}
IEHoverPseudosub();
IEHoverPseudosub1();
}
function IEHoverPseudosub() {

	var navItems = document.getElementById("menu-nav").getElementsByTagName("li");
	for (var i=0; i<navItems.length; i++) {
		if(navItems[i].className == "menusubT") {
			navItems[i].onmouseover=function() { this.className += " over"; }
			navItems[i].onmouseout=function() { this.className = "menusubT"; }
		}
	}

}
function IEHoverPseudosub1() {

	var navItems = document.getElementById("menu1-nav").getElementsByTagName("li");
	
	for (var i=0; i<navItems.length; i++) {
		if(navItems[i].className == "menusubT1") {
			navItems[i].onmouseover=function() { this.className += " over"; }
			navItems[i].onmouseout=function() { this.className = "menusubT1"; }
		}
	}

}
window.onload = IEHoverPseudo;