<?php

	$popt = isset($_GET['opt']) ? $_GET['opt'] : 0;
	$pitem = isset($_GET['item']) ? $_GET['item'] : "";
	$pitemlst = isset($_GET['itemlst']) ? $_GET['itemlst'] : "";
	$plevel3lst = isset($_GET['level3lst']) ? $_GET['level3lst'] : "";
	$pchildlst = isset($_GET['childlst']) ? $_GET['childlst'] : "";
	$pchild3lst = isset($_GET['child3lst']) ? $_GET['child3lst'] : "";
	$pgroup = isset($_GET['group']) ? $_GET['group'] : "";
	
	
	
	
	
	
	//if(isset($_GET['opt'])) $popt=$_GET['opt'];
	//if(isset($_GET['item'])) $pitem=$_GET['item'];
	if(isset($_GET['link'])) $plink=$_GET['link'];
	//if(isset($_GET['group'])) $pgroup=$_GET['group'];
	//if(isset($_GET['itemlst'])) $pitemlst=$_GET['itemlst'];
	//if(isset($_GET['childlst'])) $pchildlst=$_GET['childlst'];
	//if(isset($_GET['level3lst'])) $plevel3lst=$_GET['level3lst'];
	//if(isset($_GET['child3lst'])) $pchild3lst=$_GET['child3lst'];	
	if(isset($_GET['lang'])) $plang=$_GET['lang'];
?>



