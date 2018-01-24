<?php
//$dir = dirname(__FILE__);  //找出当前脚本所在路径
header("Content-type:text/html;charset=utf-8");

//require 'fileGenerate.class.php';
require 'PHPExcel/Classes/PHPExcel.php'; //添加读取excel所需的类文件
require 'PHPExcel/Classes/PHPExcel/IOFactory.php';

/* 
 * To change this template file, choose Tools | Templates 
 * and open the template in the editor. 
 */  
 
$dir = dirname(__FILE__);
class fileGenerate {   
	public function htmlfile($htmlname,$Cust_Type,$Row2,$Row3,$Row4,$Row5,$Row6,$Row25,$Row26,$Row27,$Row28,$Row29,$Row30,$htmltemplate){  
		//判断静态文件是否存在不存在直接生成 存在删除重新生成  
		if(file_exists($htmlname)){  
			unlink($htmlname);  
		}else {              
			$filemodel = "HTML_Localizer/".$htmltemplate;//#模板地址  
			$file=fopen($filemodel,"rb");                 //#打开模板，得到文件指针  
			$temp=fread($file,filesize($filemodel));      //#得到模板文件html代码  
			//替换摸版中的内容 
			$temp=str_replace("{Logo}",$Logo,$temp); 
			$temp=str_replace("CustType",$Cust_Type,$temp);
			$temp=str_replace("{Row2}",$Row2,$temp);
			$temp=str_replace("{Row3}",$Row3,$temp);
			$temp=str_replace("{Row4}",$Row4,$temp);
			$temp=str_replace("{Row5}",$Row5,$temp);
			$temp=str_replace("{Row6}",$Row6,$temp);
			$temp=str_replace("{Row25}",$Row25,$temp);
			$temp=str_replace("{Row26}",$Row26,$temp);
			$temp=str_replace("{Row27}",$Row27,$temp);
			$temp=str_replace("{Row28}",$Row28,$temp);
			$temp=str_replace("{Row29}",$Row29,$temp);
			$temp=str_replace("{Row30}",$Row30,$temp);
			//生成html文件              
			fwrite(fopen("HTML_Localizer/"."$htmlname","wb"),$temp); 
			#$htmlname是静态页面的文件名  
			if(file_exists("HTML_Localizer/"."$htmlname")!==True){
				echo 'write html error';  
			}  
		}  
	}
} 

$folder = "HTML_Localizer/";
// 打开目录，然后读取其内容
$xlsflag = "";
$htmlflag ="";
$excelname ="";
$htmltemplate ="";

if (is_dir($folder)) {
	if ($dh = opendir($folder)) {
		while (($file = readdir($dh)) !== false) {
			$file_suffix = substr($file, strrpos($file, '.') + 1);
			if( $file_suffix == "xls" ||  $file_suffix == "xlsx" || $file_suffix == "xlsm"){
				$xlsflag = 1;
				$excelname = $file;
			}
			elseif($file_suffix == "html" ||  $file_suffix == "htm" ){
				$htmlflag = 1;
				$htmltemplate = $file;
			}
		} closedir($dh);
	}
}
if (empty($xlsflag) && empty($htmlflag)){
	echo "<script>alert('Please upload HTML and Excel');history.back();</script>";  
}
if (!empty($xlsflag) && empty($htmlflag)){
	echo "<script>alert('Please upload HTML');history.back();</script>";  
}
if (empty($xlsflag) && !empty($htmlflag)){
	echo "<script>alert('Please upload Excel');history.back();</script>";  
}
if (!empty($xlsflag) && !empty($htmlflag)){
	$excelname = 'HTML_Localizer/'.$excelname;
	$objReader = PHPExcel_IOFactory::createReaderForFile($excelname);; //准备打开文件  
	$objPHPExcel = $objReader->load($excelname);   //载入文件
	//$sheetCount = $PHPExcel->getSheetCount();
	$sheet = $objPHPExcel->getSheet(0); // 读取第一個工作表 
	$highestRow = $sheet->getHighestRow(); // 取得总行数  

	/** write html START */ 
	$highestColumm = $sheet->getHighestColumn(); // 取得总列数  
	$highestColummNum = PHPExcel_Cell::columnIndexFromString($highestColumm);
	//获取最大列值字母对应的数值;
	for ($column = 'B'; PHPExcel_Cell::columnIndexFromString($column) <= $highestColummNum;  $column++)
	{  
		$namedata1 = $objPHPExcel->getActiveSheet()->getCell('A'.'32')->getValue();
		$namedata2 = $objPHPExcel->getActiveSheet()->getCell($column.'1')->getValue();
		$namedata = $namedata1.$namedata2;
		if (strpos($namedata,"AA_SE") !== false){
			$Logo = "LiO_APC_RGB_250x50.jpg";
		}elseif (strpos($namedata,"AA_ITB") !== false){
			$Logo = "schneider_LIO_Life-Green_RGB_250x50.png";
		}
		//获取每列1的值  
		$Cust_Type = "";
		$Row2 = $sheet->getCell($column.'2')->getValue();
		$Row3 = $sheet->getCell($column.'3')->getValue();
		$Row4 = $sheet->getCell($column.'4')->getValue();
		$Row5 = $sheet->getCell($column.'5')->getValue();
		$Row6 = $sheet->getCell($column.'6')->getValue();
		for ($row = 7; $row <= 24; $row++)  //行号从1开始 
		{  
			$Cust_Type1="<option value=\"".$sheet->getCell('A'.$row)->getValue()."\">".$sheet->getCell($column.$row)->getValue()."</option>";
			$Cust_Type = $Cust_Type.$Cust_Type1;
		}
		$Row25 = $sheet->getCell($column.'25')->getValue();
		$Row26 = $sheet->getCell($column.'26')->getValue();
		$Row27 = $sheet->getCell($column.'27')->getValue();
		$Row28 = $sheet->getCell($column.'28')->getValue();
		$Row29 = $sheet->getCell($column.'29')->getValue();
		$Row30 = $sheet->getCell($column.'30')->getValue();
		$htmlname=$namedata.".html";  
		$fileGenerate=new fileGenerate();
		$fileGenerate->htmlfile($htmlname,$Cust_Type,$Row2,$Row3,$Row4,$Row5,$Row6,$Row25,$Row26,$Row27,$Row28,$Row29,$Row30,$htmltemplate);
	}  
		/** write html END */
}

	//include '../addFileToZip.class.php';
	
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
	
	//require_once 'deleteFile.php';
	
	$folder = "HTML_Localizer/";
	/** Empty Folder Start */
	if (is_dir($folder)){
		//echo ("$folder is a directory");
	  if ($dh = opendir($folder)){
		while (($file = readdir($dh)) !== false){
		  //echo "filename:" . $file . "<br>";
		  @unlink ("HTML_Localizer/".$file);
		}
		if (($file = readdir($dh)) !== false){
			echo "<script>alert('unlink file error');history.back();</script>";  
		}
		closedir($dh);
	  }
	}
	/** Empty Folder END */
?>