<?php
/** Zip folder START */
	function addFileToZip($path,$zip){
		$handler=opendir($path); //打开当前文件夹由$path指定。
		while(($filename=readdir($handler))!==false){
			if($filename != "." && $filename != ".."){
				//文件夹文件名字为'.'和‘..’，不要对他们进行操作
				if(is_dir($path."/".$filename)){// 如果读取的某个对象是文件夹，则递归
					addFileToZip($path."/".$filename, $zip);
				}else{ //将文件加入zip对象
					$zip->addFile($path."/".$filename);
				}
			}
		}
		@closedir($path);
	}
	
	ini_set('memory_limit', '512M'); // for large file 
	$path = "HTML_Localizer";
	$filename =date ( 'YmdHms' ) . ".zip";
	$zip = new ZipArchive;
	if($zip->open($filename, ZipArchive::OVERWRITE)=== TRUE){
		addFileToZip($path, $zip); 
		//调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
		$zip->close(); //关闭处理的zip文件
	}
	if(!file_exists($filename)){     
		exit("无法找到文件"); //即使创建，仍有可能失败。。。。     
	} 
	 
	header('Content-Description: File Transfer');    
	header('Content-Type: application/zip'); // zip格式的
	header('Content-Disposition: attachment; filename='.basename($filename));     
	header('Content-Transfer-Encoding: binary');     
	header('Expires: 0');     
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');     
	header('Pragma: public');     
	header('Content-Length: ' . filesize($filename));     
	ob_clean();   //清空但不关闭输出缓存 
	flush();     
	@readfile($filename);//输出文件;
	@unlink($filename);//删除打包的临时zip文件。文件会在用户下载完成后
	/** Zip folder END */
?>