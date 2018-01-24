<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width. initial-scale=1">
<title>Ad-Hoc Details | AutoSE</title>

<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" />
<link href="../css/Auto SE.css" rel="stylesheet" type="text/css" />
<link href="../css/Jetlag.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>

<script type="text/javascript">
var d = new Date();
var Year = d.getFullYear();
var clickNum;

function formateDate(date){
        if(date instanceof Date){
            return date.getMonth() + 1;
        }
        else
        {
            return "Error Date";
        }
}

function autoHeight(){
  //定义ShowCase高度
    var Form = document.getElementById('FormGroup');
    var FormHeight = Form.offsetHeight + 'px';
    document.getElementById('ShowCase').style.height = FormHeight;
}
//页面加载完成后，执行初始化操作
function autoMonth(){
        //当前日期
        var date = new Date();
        //获取select元素
        var dateSelectObj = document.getElementById("Month");
        for(var i = 0;i <= 3; i++){
        //创建option子元素
        var optionElement = document.createElement("option");
        optionElement.appendChild(document.createTextNode(formateDate(date)));
        dateSelectObj.appendChild(optionElement);
        //日期加一个月
        date.setMonth(date.getMonth() +1);
        }
}

function CreateTr() {
  var TrElement = document.createElement("tr");
  var ThElement = document.createElement("th");
  var TdElement = document.createElement("td");
  
  var firstTh = document.createTextNode("Workfront Name");
  ThElement.appendChild(firstTh);
  document.getElementById("firstTr").appendChild(ThElement);
  
  var secondTh = document.createTextNode("Responsys Name");
  ThElement.appendChild(secondTh);
  document.getElementById("secondTr").appendChild(ThElement);
  
  var thirdTh = document.createTextNode("Mail List");
  ThElement.appendChild(thirdTh);
  document.getElementById("thirdTr").appendChild(ThElement);
}



function WorkfrontName(){
    
  
  var TrElement = document.createElement("tr");
  var ThElement = document.createElement("th");
  var TdElement = document.createElement("td");
  
  var firstTh = document.createTextNode("Workfront Name");
  var firstTd = document.createTextNode(Workfront);
  
  ThElement.appendChild(firstTh);
  TdElement.appendChild(firstTd);
  
  document.getElementById("firstTr").appendChild(ThElement);
  document.getElementById("firstTr").appendChild(TdElement);
}

function ResponsysName(){
  var TrElement = document.createElement("tr");
  var ThElement = document.createElement("th");
  var TdElement = document.createElement("td");
  
  var secondTh = document.createTextNode("Responsys Name");
  var secondTd = document.createTextNode(Responsys);
  
  ThElement.appendChild(secondTh);
  TdElement.appendChild(secondTd);
  
  document.getElementById("secondTr").appendChild(ThElement);
  document.getElementById("secondTr").appendChild(TdElement);
}

function UnicaName(){
  var TrElement = document.createElement("tr");
  var ThElement = document.createElement("th");
  var TdElement = document.createElement("td");
  
  var thirdTh = document.createTextNode("Mail List Name");
  var thirdTd = document.createTextNode(Maillist);
  
  ThElement.appendChild(thirdTh);
  TdElement.appendChild(thirdTd);
  
  document.getElementById("thirdTr").appendChild(ThElement);
  document.getElementById("thirdTr").appendChild(TdElement);
}

function CountryName(){
  var TrElement = document.createElement("tr");
  var ThElement = document.createElement("th");
  var TdElement = document.createElement("td");
  
  var fourthTh = document.createTextNode("Country Name"); 
  var fourthTd = document.createTextNode("<?php echo $Result['Country']; ?>");
  
  ThElement.appendChild(fourthTh);
  TdElement.appendChild(fourthTd);
  
  document.getElementById("fourthTr").appendChild(ThElement);
  document.getElementById("fourthTr").appendChild(TdElement);
}
 
var xmlHttp;

var CountryISOCode;

var ISOencode;

/*var CountryISOCode = document.getElementById("CountryISO").value;*/


for(var i = 0;i <= 300; i++)
{
function listdetail() 
  {
    
  var VersionObj=document.getElementById('Version');
  var VersionSelect=VersionObj.selectedIndex; //序号，取当前选中选项的序号
  Version = VersionObj.options[VersionSelect].text;

  var RegionObj=document.getElementById('Region');
  var RegionSelect=RegionObj.selectedIndex; //序号，取当前选中选项的序号
  Region = RegionObj.options[RegionSelect].text;

  var MonthObj=document.getElementById('Month');
  var MonthSelect=MonthObj.selectedIndex; //序号，取当前选中选项的序号
  var Month = MonthObj.options[MonthSelect].text;
  
  if (Month < 10)
  {
  Month = "0" + Month;
  }
  
  //判断季节
  if (Month <= 3)
  {
   var Quarter = "Q1";
  }
  else if (Month <= 6)
  {
    var Quarter = "Q2";
  }
  else if (Month <= 9)
  {
    var Quarter = "Q3";
  }
  else
  {
    var Quarter = "Q4";
  }

  //判断Form是否为空
  var CountryISOEmpty = document.getElementById('ISOGroup');
  CountryISOEmpty.setAttribute("class", "form-group");

  var KEYCODEEmpty = document.getElementById('KEYCODEGroup');
  KEYCODEEmpty.setAttribute("class", "form-group");

  var DescriptionEmpty = document.getElementById('DescriptionGroup');
  DescriptionEmpty.setAttribute("class", "form-group");
  
  //格式化表单填写内容
  CountryISOCode = document.getElementById('CountryISO').value;
  ISOencode = $.trim(CountryISOCode);

  var KEYCODE = document.getElementById('KEYCODE');
  var KEYCODEencode = $.trim(KEYCODE.value);
  
  var Description = document.getElementById('Description');
  var Descriptionencode = $.trim(Description.value).replace(/ /g, "_");
  
  //计算命名
  Workfront = Region + " " + Version + " " + Year + " " + Quarter + " " + Month + " " + ISOencode + " " + Descriptionencode + "_" + KEYCODEencode;
  
  Responsys = Year + Month + "_" + Region + "_" + Version + "_" + ISOencode + "_" + Descriptionencode + "_" + KEYCODEencode;
  
  Maillist = "files\\output\\" + Region + "_" + Version + "_" + ISOencode + "_" + Descriptionencode + "_" + KEYCODEencode + ".txt";

    //显示必填内容是否为空
  if (CountryISOCode==0)
  { 
    CountryISOEmpty.setAttribute("class", "has-error form-group");
  }
  
  if (KEYCODE.value==0)
  {
    KEYCODEEmpty.setAttribute("class", "has-error form-group");
  }
  
  if (Description.value==0)
  {
    DescriptionEmpty.setAttribute("class", "has-error form-group");
  }
  
  if (KEYCODE.value!=0 & CountryISOCode!=0 & Description.value!=0)
  {
  //document.getElementById('btn-submit').setAttribute("disabled","disabled");
  document.getElementById("firstTr").innerHTML="";
  document.getElementById("secondTr").innerHTML="";
  document.getElementById("thirdTr").innerHTML="";
  WorkfrontName();
  ResponsysName();
  UnicaName();
  }
  
  
  if(i > 1 & KEYCODE.value!=0 & CountryISOCode!=0 & Description.value!=0) {
    document.getElementById("btn-submit").innerHTML = "Requery";
  }
}
}

function showDetail(str)
{
  if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML=""
  return
  }

  xmlHttp=GetXmlHttpObject()

  if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

var url="../PHP/getuser.php"
url=url+"?ISO="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 {
 document.getElementById("txtHint").innerHTML=xmlHttp.responseText 
 }
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 { 
 //Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}



function reloadPage()
  {
  window.location.reload()  
  }
</script>
</head>

<body class="sign-in-bg" onload="autoMonth();autoHeight();">
<?php
  include ("../PHP/Jetlag_Navbar.php");
?>
<br />
<br />
<div class="container font-arial">
  <div class="col-lg-12">
    <div class="page-header">
      <h3>Ad-Hoc Details&nbsp;<small>for Ad-Hoc Campaign naming coversion</small></h3>
    </div>
  </div>
</div>
<div class="container font-arial">
	<div class="col-lg-4">
    		<h5>Region <span style="color:#a94442">*</span></h5>
    </div>
    <div class="col-lg-8">
    		<h5>Details</h5>
    </div>
</div>
<div class="container font-arial">
    <div class="col-lg-4" id="FormGroup">
    	<form>
        <div class="form-group" id="VersionGroup">
          <select id="Region" class="form-control" rows="1" name="Region">
            <option value="APJ">APJ</option>
            <option value="Europe">Europe</option>
            <option value="GCN">GCN</option>
            <option value="LAMEAIB">LAMEAIB</option>
            <option value="NAM">NAM</option>
          </select>
        </div>
        <div class="form-group" id="VersionGroup">
          <h5>Version<span style="color:#a94442">*</span></h5>
          <select id="Version" class="form-control" rows="1" name="Version">
            <option value="SE">SE</option>
            <option value="ITB">ITB</option>
          </select>
        </div>
        <div class="form-group" id="MonthGroup">
          <h5>Month<span style="color:#a94442">*</span></h5>
          <select id="Month" class="form-control" rows="1" name="Month">
          </select>
        </div>
        <div class="form-group" id="ISOGroup">
          <h5>Country ISO Code<span style="color:#a94442">*</span></h5>
          <input id="CountryISO" rows="1" class="form-control" placeholder="Country ISO Code" name="CountryISOCode" type="text"/>
        </div>
        <div class="form-group" id="KEYCODEGroup">
          <h5>KEYCODE<span style="color:#a94442">*</span></h5>
          <textarea id="KEYCODE" rows="1" class="form-control" placeholder="KEYCODE" name="KEYCODE"></textarea>
        </div>
        <div class="form-group" id="DescriptionGroup">
          <h5>Short Description<span style="color:#a94442">*</span></h5>
          <textarea id="Description" rows="2" class="form-control" placeholder="Short Description" name="Short Description"></textarea>
        </div>
        <br />
        <button type="button" class="btn btn-brand btn-main" id="btn-submit" onclick="showDetail(document.getElementById('CountryISO').value); listdetail();">Query</button>
      </form>
        <button type="button" class="btn btn-default btn-main" id="btn-refresh" onclick="reloadPage()">Reload</button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Instruction</h4>
              </div>
              <div class="modal-body">
                <ol>
                	<li>Ad-hoc Details is for checking all necessary Ad-hoc details in platforms. Copy & paste simple given info and click <strong>Query</strong> Button. details will be show on right;</li>
                  <li>Please use <strong>Chrome</strong> to get the best user experience. Lower version IE will be supported no longer;</li>
                  <li>Default value: Region:<strong>APJ</strong>. Version:<strong>ITB</strong>. Month: <strong>current month</strong>;
                  <li>Space characters in the beginning & the end will be auto-removed;</li>
                  <li>There is no retract button. You could just re-input info and click <strong>Requery</strong> Button when you want to re-do. <strong>Reload</strong> Button is for refreshing the whole page.</li>
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
        <div class="bs-example" id="ShowCase">
        	<table id="DetailTable" class="table table-striped">
              <tr>
              </tr>
              <tr id="firstTr">
              </tr>
              <tr id="secondTr">
              </tr>
              <tr id="thirdTr">
              </tr>
              <tr id="fourthTr">
              </tr>
              <tbody id="txtHint" style="border-top: 0;">
              </tbody>
          </table>
        </div>
        <br />
        <br />
    </div>
</div>
<?php
  include ("../PHP/Auto-SE_Footer.php");
?>
</body>
</html>
