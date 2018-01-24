<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width. initial-scale=1">
<title>HTML Localizer | AutoSE</title>

<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" />
<link href="../css/Auto SE.css" rel="stylesheet" type="text/css" />
<link href="../css/Jetlag.css" rel="stylesheet" type="text/css" />
<link href="../css/Dropzone.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/dropzone.js"></script>
<script type="text/javascript">

function autoHeight(){
  //定义ShowCase高度
    var Form = document.getElementById('FormGroup');
    var FormHeight = Form.offsetHeight + 'px';
    document.getElementById('ShowCase').style.height = FormHeight;
}

function Test() {
  var HTMLList =  $("span:contains('.htm')");
  var HTMLNum = HTMLList.length;
  var HTMlName = HTMLList[HTMLNum-1].innerHTML;

  alert(HTMlName);

  document.getElementById('ShowCase').src="./HTML_Localizer/" + HTMlName;
}

  


function reloadPage()
{
  window.location.reload()  
}
</script>
</head>

<body class="sign-in-bg" onload="autoHeight();">
<?php
  include ("../PHP/Jetlag_Navbar.php");
?>
<br />
<br />
<div class="container font-arial">
  <div class="col-lg-12">
    <div class="page-header">
      <h3>HTML Localizer&nbsp;<small>upload EN HTML & translation Excel file below</small></h3>
    </div>
  </div>
</div>
<div class="container font-arial">
    <div class="col-lg-4" id="FormGroup">
    	<form action="./PHPExcel/Localizer_Upload.php" class="dropzone" method="post">
  			<div class="fallback">
    			<input name="file" type="file" multiple />
  			</div>
		  </form> 
      <br />
      <button type="button" class="btn btn-brand btn-main" id="btn-submit" onclick="Test()">Preview</button>
      <button type="button" class="btn btn-default btn-main" id="btn-refresh" onclick="window.location.href='download_htmlfile.php'">Download ZIP</button>
      <button type="button" class="btn btn-info btn-main"data-toggle="modal" data-target="#myModal">Introduction</button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">HTML Localizer tool is used to build prefill form pages</h4>
              </div>
              <div class="modal-body">
                <ol>
                <li>Upload HTML & translation Excel file below, here is the template as reference : <a href="./PHPExcel/Localizer_Template.zip" style="color:#f0f;">html/excel template.</a></li>
                <li>It only recognizes one html and one excel.If you want long prefill form pages, please upload "Long_Form_Template.htm" and "Excel_Template.xlsm". So does short form.</li>
                <li>Click "Preview" button to preview the html you uploaded.</li>
                <li>Please do not delete/change the rows in excel template. If you don't want the rows content, you can deletw {row&lt;num&gt;} and related code in html template.</li>
                <li>Click "Download ZIP" button to get prefill form files.</li>
                <li>Server-side only calculate. After generating the HTML, all files you uploaded and created will be deleted. <strong>No security concern!</strong></li>
                </ol>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-8">
      <iframe id="ShowCase">
      </iframe>
    </div>
</div>
<?php
  include ("../PHP/Auto-SE_Footer.php");
?>
</body>
</html>
