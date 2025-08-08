<?php
$vfunc=$_GET['childfunc'];
$vChildID=$_GET['ChildID'];
switch($vfunc)
{
	case 'add':
		include('add.php');
		break;
	case 'edit':
		include('edit.php');
		break;
	case 'filter':
		include('filter.php');
		break;
	case 'word':
		include('report.php');
		break;
	case 'excel':
		include('report.php');
		break;
	case 'pdf':
		include('report.php');
		break;
	case 'child':
		include('child.php');
		break;
		case 'rpt':
			include('report1.php');
			break;
		case 'rpt1':
			include('report2.php');
			break;
		case 'rpt3':
			include('report3.php');
			break;
		case 'rpt5':
			include('report5.php');
			break;
		case 'rpt6':
			include('report6.php');
			break;
		case 'rpt9':
			include('report9.php');
			break;
		case 'rpt19':
			include('report19.php');
			break;
		case 'rpt19ktt':
			include('report19ktt.php');
			break;
		case 'rpt19ktvt':
			include('report19ktvt.php');
			break;
		case 'rpt19ktct':
			include('report19ktct.php');
			break;
		case 'rpt10':
			include('report10.php');
			break;
		case 'rpt20':
			include('report20.php');
			break;
		case 'rpt20ktt':
			include('report20ktt.php');
			break;
		case 'rpt20ktvt':
			include('report20ktvt.php');
			break;
		case 'rpt20ktct':
			include('report20ktct.php');
			break;
		case 'rpt69':
			include('report69.php');
			break;
}
?>