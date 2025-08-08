var widthscreen=screen.width;
var menuwidth=910;
if(widthscreen<700) widthscreen=700;
if(widthscreen==800)
	var menuwidth=430;
else if(widthscreen>800)
	var menuwidth=(widthscreen-800)+430;
else if(widthscreen<800 && widthscreen>350 )
	var menuwidth=(widthscreen-800)+430;
else
	var menuwidth=910;