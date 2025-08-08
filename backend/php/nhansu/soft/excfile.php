<?php
/*======================================================================================================*/
/**
 * Deletes a file
 * @param string The relative folder path to the file
 */
function delete_file( $fullPath ){
	//$fullPath = "../images/employee/80880402.jpg";
	if (file_exists(  $fullPath )){
		if(unlink( $fullPath )){
			return true;
		} else{
			return false;
		}
	} else{
		return false;
	}
}

/*======================================================================================================*/


/**
* @param string An existing base path
* @param string A path to create from the base path
* @param int Directory permissions
* @return boolean True if successful
*/
function mosMakePath($base, $path='', $mode = NULL) {
	global $mosConfig_dirperms;

	// convert windows paths
	$path = str_replace( '\\', '/', $path );
	//$path = str_replace( '//', '/', $path );

	// check if dir exists
	if (file_exists( $base . $path )) return true;

	// set mode
	$origmask = NULL;
	if (isset($mode)) {
		$origmask = @umask(0);
	} else {
		if ($mosConfig_dirperms=='') {
			// rely on umask
			$mode = 0777;
		} else {
			$origmask = @umask(0);
			$mode = octdec($mosConfig_dirperms);
		} // if
	} // if
	$parts = explode( '/', $path );
	$n = count( $parts );
	$ret = true;
	if ($n < 1) {
		$ret = @mkdir($base, $mode);
	} else {
		$path = $base;
		for ($i = 0; $i < $n; $i++) {
			$path .= $parts[$i] . '/';
			if (!file_exists( $path )) {
				if (!@mkdir(substr($path,0,-1),$mode)) {
					$ret = false;
					break;
				}
			}
		}
	}
	if (isset($origmask)) {
		@umask($origmask);
	}

	return $ret;
}
/*======================================================================================================*/
function create_folder($dirPath, $folder_name) {

	if(strlen($folder_name) >0) {
		if (eregi("/[^0-9a-zA-Z_]", $folder_name)) {
			//echo "Folder name is invalid.";
			return false;
		}
		$folder = $dirPath . $folder_name;
		if(!is_dir( $folder ) && !is_file( $folder )) {
			mosMakePath( '',$folder );
			$fp = fopen( $folder . "/index.html", "w" );
			fwrite( $fp, "<html>\n<body bgcolor=\"#FFFFFF\">\n</body>\n</html>" );
			fclose( $fp );
			mosChmod( $folder."/index.html" );
			$refresh_dirs = true;
			return true;
		}
	}
}
/*======================================================================================================*/
/**
* Chmods files and directories recursively to given permissions. Available from 1.0.0 up.
* @param path The starting file or directory (no trailing slash)
* @param filemode Integer value to chmod files. NULL = dont chmod files.
* @param dirmode Integer value to chmod directories. NULL = dont chmod directories.
* @return TRUE=all succeeded FALSE=one or more chmods failed
*/
function mosChmodRecursive($path, $filemode=NULL, $dirmode=NULL)
{
	$ret = TRUE;
	if (is_dir($path)) {
		$dh = opendir($path);
		while ($file = readdir($dh)) {
			if ($file != '.' && $file != '..') {
				$fullpath = $path.'/'.$file;
				if (is_dir($fullpath)) {
					if (!mosChmodRecursive($fullpath, $filemode, $dirmode))
						$ret = FALSE;
				} else {
					if (isset($filemode))
						if (!@chmod($fullpath, $filemode))
							$ret = FALSE;
				} // if
			} // if
		} // while
		closedir($dh);
		if (isset($dirmode))
			if (!@chmod($path, $dirmode))
				$ret = FALSE;
	} else {
		if (isset($filemode))
			$ret = @chmod($path, $filemode);
	} // if
	return $ret;
} // mosChmodRecursive
/*======================================================================================================*/
/**
* Chmods files and directories recursively to mos global permissions. Available from 1.0.0 up.
* @param path The starting file or directory (no trailing slash)
* @param filemode Integer value to chmod files. NULL = dont chmod files.
* @param dirmode Integer value to chmod directories. NULL = dont chmod directories.
* @return TRUE=all succeeded FALSE=one or more chmods failed
*/
function mosChmod($path) {
	global $mosConfig_fileperms, $mosConfig_dirperms;
	$filemode = NULL;
	if ($mosConfig_fileperms != '')
		$filemode = octdec($mosConfig_fileperms);
	$dirmode = NULL;
	if ($mosConfig_dirperms != '')
		$dirmode = octdec($mosConfig_dirperms);
	if (isset($filemode) || isset($dirmode))
		return mosChmodRecursive($path, $filemode, $dirmode);
	return TRUE;
} // mosChmod
/*======================================================================================================*/
function delete_folder($path) {
	//$delFolder = mosGetParam( $_REQUEST, 'delFolder', '' );
	//$del_html 	= COM_MEDIA_BASE . $path . $delFolder . DIRECTORY_SEPARATOR . 'index.html';
 	$del_html 	= $path . '/index.html';
	//$del_folder = COM_MEDIA_BASE . $path . $delFolder;
	$del_folder = 	$path;

	$entry_count = 0;
	$dir = opendir( $del_folder );
	while ($entry = readdir( $dir )) {
		if( $entry != "." & $entry != ".." & strtolower($entry) != "index.html" )
		$entry_count++;
	}
	closedir( $dir );

	if ($entry_count < 1) {
		if(delete_file( $del_html )){
		//@unlink( $del_html );
			rmdir( $del_folder );
			return true;
		} else {
			return false;
		//echo '<font color="red">Unable to delete: not empty!</font>';
		}
	}
}
function getlistforder($path)
{

	if (is_dir($path)) {
    if ($dh = opendir($path)) {
        while (($file = readdir($dh)) !== false) {
			if(is_dir($path ."/".$file) && $file!="." && $file!=".." )
			{
				$files[]= $path ."/". $file ;
			}
        }
        closedir($dh);
    }
	}
	return $files;
}
function Looplistforder($vAr)
{$i=0;
	global $pListFolder;
	while ((int)count($vAr)>$i)
	{
		$pListFolder[] =$vAr[$i];
		$vTemp=	getlistforder($vAr[$i]);
		
		if(count($vTemp)!=0) Looplistforder($vTemp);
		$i++;
	}
	return $files;
}
function imageResize($width, $height, $target) {

		//takes the larger size of the width and height and applies the
		//formula accordingly...this is so this script will work
		//dynamically with any size image

		if ($width > $height) {
			$percentage = ($target / $width);
		} else {
			$percentage = ($target / $height);
		}

		//gets the new value and applies the percentage, then rounds the value
		$width = round($width * $percentage);
		$height = round($height * $percentage);

		//returns the new sizes in html image tag format...this is so you
		//can plug this function inside an image tag and just get the

		return "width=\"$width\" height=\"$height\"";

	}
function imageChild($vFile)
{
	$vReturn=$vFile;
	return 1;
}
?>