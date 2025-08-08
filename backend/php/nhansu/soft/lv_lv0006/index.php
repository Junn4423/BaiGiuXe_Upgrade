<?php
$vfunc=$_GET['func'];
$vID= $_GET['ID'] ?? '';
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
}
?>