<?php

if ($_FILES["file"]["error"] > 0)
{
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
}
else
{
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

  if (file_exists("../HTML_Localizer/" . $_FILES["file"]["name"]))
  {
      echo $_FILES["file"]["name"] . " already exists. ";
  }
  else
  {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../HTML_Localizer/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "../HTML_Localizer/" . $_FILES["file"]["name"];
  }
}

if ($_FILES["file"]["type"] == "text/HTML")
{
    $myfile = fopen($_FILES["file"]["name"], "r") or die("Unable to open file!");
    echo fread($myfile,filesize($_FILES["file"]["name"]));
    fclose($myfile);
}
else
{
    echo "Invalid file";
}

$dir = "../HTML_Localizer/";

// 打开目录，然后读取其内容
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false)
	{
		if($file !== $_FILES["file"]["name"])
		{
			if(strpos($_FILES["file"]["name"],"htm") !== false)
			{
				if(strpos($file,"htm") !== false)
				{
					unlink("../HTML_Localizer/".$file);
					}
			}
			elseif(strpos($_FILES["file"]["name"],"xls") !== false)
			{
				if(strpos($file,"xls") !== false)
				{
					unlink("../HTML_Localizer/".$file);
				}
			}
			elseif(strpos($_FILES["file"]["name"],"xlsx") !== false)
			{
				if(strpos($file,"xlsx") !== false)
				{
					unlink("../HTML_Localizer/".$file);
				}
			}
			elseif(strpos($_FILES["file"]["name"],"csv") !== false)
			{
				if(strpos($file,"csv") !== false)
				{
					unlink("../HTML_Localizer/".$file);
				}
			}
			elseif(strpos($_FILES["file"]["name"],"xlsm") !== false)
			{
				if(strpos($file,"xlsm") !== false)
				{
					unlink("../HTML_Localizer/".$file);
				}
			}
		}
    }
    closedir($dh);
  }
}

?>