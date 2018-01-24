<?php
	$folder = $dir."../HTML_Localizer/";
	/** Empty Folder Start */
	if (is_dir($folder)){
		//echo ("$folder is a directory");
	  if ($dh = opendir($folder)){
		while (($file = readdir($dh)) !== false){
		  //echo "filename:" . $file . "<br>";
		  @unlink ("../HTML_Localizer/".$file);
		}
		if (($file = readdir($dh)) !== false){
			echo "<script>alert('unlink file error');history.back();</script>";  
		}
		closedir($dh);
	  }
	}
	/** Empty Folder END */
?>
