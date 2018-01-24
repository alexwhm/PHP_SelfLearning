<?php  
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
			$filemodel = "../HTML_Localizer/".$htmltemplate;//#模板地址  
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
			fwrite(fopen("../HTML_Localizer/"."$htmlname","wb"),$temp); 
			#$htmlname是静态页面的文件名  
			if(file_exists("../HTML_Localizer/"."$htmlname")!==True){
				echo 'write html error';  
			}  
		}  
	}
}  
?>