<!DOCTYPE html>
<html>
<head>
<title>Wathik</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="ar-sa" http-equiv="Content-Language">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<![endif]-->
<link href="css/wizard.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/green.css">

<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.smartWizard-2.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
    	// Smart Wizard 	
  		$('#wizard').smartWizard();
      
      function onFinishCallback(){
        $('#wizard').smartWizard('showMessage','Finish Clicked');
      }     
		});
</script>

<style type="text/css">
.auto-style1 {
	font-size: 100%;
}
</style>
                        <style type="text/css">
<!--
    body {
        margin:0;
        padding:0;
        font: bold 16px/1.5em Arial;
}

h2 {
        font: bold 16px Arial, Helvetica, sans-serif;
        color: #000;
        margin: 0px;
        padding: 0px 0px 0px 15px;
}
.CSSTableGenerator {
	margin:0px;padding:0px;
	width:100%;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
	
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
	
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
	
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}.CSSTableGenerator table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:100%;
	margin:0px;padding:0px;
}.CSSTableGenerator tr:last-child td:last-child {
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
}
.CSSTableGenerator table tr:first-child td:first-child {
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
.CSSTableGenerator table tr:first-child td:last-child {
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
}.CSSTableGenerator tr:last-child td:first-child{
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
}.CSSTableGenerator tr:hover td{
	
}
.CSSTableGenerator tr:nth-child(odd){ background-color:#edddb4; }
.CSSTableGenerator tr:nth-child(even)    { background-color:#ffffff; }.CSSTableGenerator td{
	vertical-align:middle;
	
	
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:7px;
	font-size:10px;
	font-family:Arial;
	font-weight:bold;
	color:#000000;
}.CSSTableGenerator tr:last-child td{
	border-width:0px 1px 0px 0px;
}.CSSTableGenerator tr td:last-child{
	border-width:0px 0px 1px 0px;
}.CSSTableGenerator tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.CSSTableGenerator tr:first-child td{
		background:-o-linear-gradient(bottom, #603207 5%, #7a3c02 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #603207), color-stop(1, #7a3c02) );
	background:-moz-linear-gradient( center top, #603207 5%, #7a3c02 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#603207", endColorstr="#7a3c02");	background: -o-linear-gradient(top,#603207,7a3c02);

	background-color:#603207;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:14px;
	font-family:Arial;
	font-weight:bold;
	color:#ffffff;
}
.CSSTableGenerator tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #603207 5%, #7a3c02 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #603207), color-stop(1, #7a3c02) );
	background:-moz-linear-gradient( center top, #603207 5%, #7a3c02 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#603207", endColorstr="#7a3c02");	background: -o-linear-gradient(top,#603207,7a3c02);

	background-color:#603207;
}
.CSSTableGenerator tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.CSSTableGenerator tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}

/*- Menu Tabs--------------------------- */


    #tabs {
      float:right;
      width:100%;
      background:#E6E6E6;
      font-size:18px;
      line-height:normal;
      }
    #tabs ul {
        margin:0;
        padding:10px 10px 0 50px;
        list-style:none;
      }
    #tabs li {
      display:inline;
      margin:0;
      padding:0;
      }
    #tabs a {
      float:right;
      background:url("images/tableft.gif") no-repeat left top;
      margin:0;
      padding:0 0 0 4px;
      text-decoration:none;
      }
    #tabs a span {
      float:right;
      display:block;
      background:url("images/tabright.gif") no-repeat right top;
      padding:5px 15px 4px 6px;
      color:#666;
      }
    /* Commented Backslash Hack hides rule from IE5-Mac \*/
    #tabs a span {float:none;}
    /* End IE5-Mac hack */
    #tabs a:hover span {
      color:#FF9834;
      }
    #tabs a:hover {
      background-position:0% -42px;
      }
    #tabs a:hover span {
      background-position:100% -42px;
      }

        #tabs #current a {
                background-position:0% -42px;
        }
        #tabs #current a span {
                background-position:100% -42px;
        }
-->
</style>
<style type="text/css">
.top_right {
	background-image: url('images/top_m_02.jpg');
	width:499px;
	height:37px;
}
.top_left {
	background-image: url('images/top_m_01.png');
	width:416px;
	height:37px;

}
</style>
<?php
	
	require_once("ajax_table.class.php");
	$obj = new ajax_table();
	$records = $obj->getRecords();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title>Ajax Table Inline Edit</title>
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
  <script>
	 // Column names must be identical to the actual column names in the database, if you dont want to reveal the column names, you can map them with the different names at the server side.
	 var columns = new Array("fname","lname");
	 var placeholder = new Array("أدخل الاسم","أدخل الموقع الجغرافي");
	 var inputType = new Array("text","text");
	 var table = "tableDemo";
	 
	 // Set button class names 
	 var savebutton = "ajaxSave";
	 var deletebutton = "ajaxDelete";
	 var editbutton = "ajaxEdit";
	 var updatebutton = "ajaxUpdate";
	 var cancelbutton = "cancel";
	 
	 var saveImage = "images/save.png"
	 var editImage = "images/edit.png"
	 var deleteImage = "images/remove.png"
	 var cancelImage = "images/back.png"
	 var updateImage = "images/save.png"

	 // Set highlight animation delay (higher the value longer will be the animation)
	 var saveAnimationDelay = 3000; 
	 var deleteAnimationDelay = 1000;
	  
	 // 2 effects available available 1) slide 2) flash
	 var effect = "flash"; 
  
  </script>
  <script src="js/jquery-1.11.0.min.js"></script>	
  <script src="js/jquery-ui.js"></script>	
  <script src="js/table_script.js"></script>	
  <link rel="stylesheet" href="css/table_style.css">

</head>
<body  class="bg-green">
<!-- START PAGE SOURCE -->
<div class="main">
  <header>
      <nav>
<?php include_once('header.php'); ?>       
    </nav>
    
  </header>
  
  <section id="content">
    <div class="wrapper">
     
      <div class="wrapper">
      <table id="Table_011" width="915" height="37" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="top_left">
			مرحباً: محمد علي الدوسري</td>
		<td class="top_right">
			<div id="menu-container">

<ul id="navigationMenu">

<li><a href="home.php" class="normalMenu">الرئيسية</a></li>
<li><a href="location.php" class="selectedMenu">الموقع</a></li>
<li><a href="projects.php" class="normalMenu">المشاريع</a></li>
<li><a href="reports.php" class="normalMenu">التقارير</a></li>
<li><a href="setting.php" class="normalMenu">الاعدادات</a></li>

</ul>

</div>
			
			</td>
	</tr>
</table>
		  <br><br>
		  <center>
		  <table dir="rtl" border="0" class="tableDemo bordered">
		<tr class="ajaxTitle">
			<th width="2%">رقم</th>
			<th width="16%">الاسم</th>
			<th width="16%">الموقع الجغرافي</th>
			<th width="14%">العمليات</th>
		</tr>
		<?php
		if(count($records)){
		 $i = 1;	
		 foreach($records as $key=>$eachRecord){
		?>
		<tr id="<?php echo$eachRecord['id']; ?>">
			<td><?php $i++; ?></td>
			<td class="fname"><?php echo $eachRecord['name'];?></td>
			<td class="lname"><?php echo $eachRecord['consultant'];?></td>
			<td>
				<a href="javascript:;" id="<?php echo $eachRecord['id'];?>" class="ajaxEdit"><img src="" class="eimage"></a>
				<a href="javascript:;" id="<?php echo $eachRecord['id'];?>" class="ajaxDelete"><img src="" class="dimage"></a>
			</td>
		</tr>
		<?php }
		}
		?>
	</table>  
	</center>

            <br>
      
          <br>
          

          <br><br><br><br><br><br><br><br><br><br><br><br>لغة عربية</div>
    </div>
  </section>
  <footer>
    <p class="lf" style="width: 312px">Copyright &#65533; 2015 <a href="#">W<span class="auto-style1">athik</span></a> 
	- All Rights Reserved</p>
    <div style="clear:both;"></div>
  </footer>
</div>
<!-- END PAGE SOURCE -->

</body>
</html>