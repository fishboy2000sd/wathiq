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
<li><a href="location.php" class="normalMenu">الموقع</a></li>
<li><a href="projects.php" class="selectedMenu">المشاريع</a></li>
<li><a href="reports.php" class="normalMenu">التقارير</a></li>
<li><a href="setting.php" class="normalMenu">الاعدادات</a></li>

</ul>

</div>
			
			</td>
	</tr>
</table>
44
      
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