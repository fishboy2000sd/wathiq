<!DOCTYPE html>
<html>
<head>
<title>Wathiq</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="ar-sa" http-equiv="Content-Language">

<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>



<link rel="stylesheet" href="<?=base_url()?>css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="<?=base_url()?>css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="<?=base_url()?>css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="<?=base_url()?>css/demo.css" type="text/css" />

<link href="<?=base_url()?>css/modern-menu.css" type="text/css" rel="stylesheet" />
		
		<script src="<?=base_url()?>js/jquery.modern-menu.min.js" type="text/javascript"></script>




<script type="text/javascript" src="<?=base_url()?>js/script.js"></script>



<link rel="stylesheet" href="<?=base_url()?>css/green.css">




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
	background-image: url(base_url().'/images/top_m_02.jpg');
	width:499px;
	height:37px;
}
.top_left {
	background-image: url(base_url().'/images/top_m_01.png');
	width:416px;
	height:37px;

}
.auto-style2 {
	border-style: solid;
}
</style>
<?php
	
	//require_once("ajax_table.class.php");
	//$obj = new ajax_table();
	//$records = $obj->getRecords();
?>

  <script>
	 // Column names must be identical to the actual column names in the database, if you dont want to reveal the column names, you can map them with the different names at the server side.
	 var columns = new Array("name","consultant");
	 var placeholder = new Array("أدخل الاسم","أدخل الاستشاري");
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
 
  <link rel="stylesheet" href="<?=base_url()?>css/table_style.css">

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

			مرحباً: <?=$name?></td>
		<td class="top_right" style="width: 80%">
			<div id="menu-container">
				


</div>
<ul class="modern-menu theme6" style="direction: rtl;">
			
			<li>
				<a href="<?=site_url('portal/index')?>"><span>الرئيسية</span></a>
			</li>
			
			<?php if($ci->has_privilege('read_project')){ ?>
			<li>
				<a href="#"><span>المشاريع</span></a>
				<ul>
					<li><a href="<?=site_url('portal/projects_management')?>"><span>قائمة المشاريع</span></a></li>
					<li><a href="<?=site_url('portal/project_status_management')?>"><span>حالة المشروع</span></a></li>
					<li><a href="<?=site_url('portal/phase_management')?>"><span>مراحل المشروع</span></a></li>
					<!-- <li><a href="<?=site_url('portal/project_subphase_management')?>"><span>مراحل المشروع الفرعية</span></a></li> -->
					<li><a href="<?=site_url('portal/deliverables_management')?>"><span>التسليمات</span></a></li>
					<li><a href="<?=site_url('portal/deliverable_status_management')?>"><span>حالات التسليمات</span></a></li>
				</ul>
			</li>
			<?php } ?>

			<?php if($ci->has_privilege('read_attachment')){ ?>
			<li>
				<a href="#"><span>المرفقات</span></a>
				<ul>
					<li><a href="<?=site_url('portal/phase_attachements_management')?>"><span>مرفقات المراحل</span></a></li>
					<!-- <li><a href="<?=site_url('portal/subphase_attachements_management')?>"><span>مرفقات المراحل الفرعية</span></a></li> -->
					<li><a href="<?=site_url('portal/deliverable_attachements_management')?>"><span>مرفقات التسليمات</span></a></li>
					<li><a href="<?=site_url('portal/attachement_categories_management')?>"><span>تصنيفات المرفقات</span></a></li>
					<li><a href="<?=site_url('portal/attachement_types_management')?>"><span>أنواع المرفقات</span></a></li>
				</ul>
			</li>
			<?php } ?>

			<?php if($ci->has_privilege('read_site')){ ?>
			<li>
				<a href="#"><span>المواقع</span></a>
				<ul>
					<li><a href="<?=site_url('portal/sites_management')?>"><span>قائمة المواقع</span></a></li>
					<li><a href="<?=site_url('portal/site_types_management')?>"><span>أنواع المواقع</span></a></li>
					<!-- <li><a href="<?=site_url('portal/owners_management')?>"><span>ملكية الموقع</span></a></li> -->
					<li><a href="<?=site_url('portal/owner_types_management')?>"><span>أنواع الملكيات</span></a></li>
				</ul>
			</li>
			<?php } ?>

			<?php if($ci->has_privilege('read_contract')){ ?>
			<li>
				<a href="#"><span>العقودات</span></a>
				<ul>
					<li><a href="<?=site_url('portal/contracts_management')?>"><span>النموذج الزمني</span></a></li>
					<!-- <li><a href="<?=site_url('portal/contract_types_management')?>"><span>أنواع العقودات</span></a></li> -->
					<li><a href="<?=site_url('portal/contract_categories_management')?>"><span>تصنيف العقودات</span></a></li>
					<li><a href="<?=site_url('portal/contract_phases_management')?>"><span>مراحل العقودات</span></a></li>
					<li><a href="<?=site_url('portal/contract_phase_category_list_management')?>"><span>قائمة التسليمات</span></a></li>
				</ul>
			</li>	
			<?php } ?>		
			
			<?php if($ci->has_privilege('read_setting')){ ?>
			<li><a href="#"><span>الإعدادات</span></a>
				<ul>
					<li>
						<a href="<?=site_url('portal/users_management')?>"><span>المستخدمين</span></a>
						<ul>
							<li><a href="<?=site_url('portal/privileges_management')?>"><span>الصلاحيات</span></a></li>
							<li><a href="<?=site_url('portal/roles_management')?>"><span>الأدوار</span></a></li>
						</ul>
					</li>
					<li><a href="<?=site_url('portal/consultants_management')?>"><span>المستشارين</span></a></li>
					<li><a href="<?=site_url('portal/contractors_management')?>"><span>المقاولين</span></a></li>

					<li>
						<a href="#"><span>التقسيمات الإدارية</span></a>
						<ul>
							<li><a href="<?=site_url('portal/sectors_management')?>"><span>القطاعات</span></a></li>
							<li><a href="<?=site_url('portal/regions_management')?>"><span>المناطق</span></a></li>
							<li><a href="<?=site_url('portal/states_management')?>"><span>المحافظات</span></a></li>
						</ul>
					</li>

					<li>
						<a href="#"><span>الهيكل الإداري</span></a>
						<ul>
							<li><a href="<?=site_url('portal/departments_management')?>"><span>الإدارة</span></a></li>
							<li><a href="<?=site_url('portal/sections_management')?>"><span>القسم</span></a></li>							
						</ul>
					</li>					

				</ul>
			</li>
			<?php } ?>

			<?php if($ci->has_privilege('read_report')){ ?>
			<li><a href="#"><span>التقارير</span></a>
			<ul>
			        <li>
						<a href="#"><span>تقارير المواقع</span></a>
						<ul>
							<li><a href="<?=site_url('reports/Listsites')?>"><span>قائمة المواقع</span></a></li>
							<li><a href="<?=site_url('reports/Cardsites')?>"><span>بطاقة الموقع </span></a></li>
							<li><a href="<?=site_url('reports/Ownerstatus')?>"><span>حالة الملكية للموقع  </span></a></li>	
						</ul>
					</li>
					<li>
						<a href="#"><span>تقارير المشاريع</span></a>
						<ul>
							<li><a href="<?=site_url('reports/Consultants')?>"><span>الاستشاريين  </span></a></li>	
							<li><a href="<?=site_url('reports/ProjectPhases')?>"><span>مراحل المشاريع </span></a></li>								
						</ul>
					</li>
		     </ul>
			</li>
			<?php } ?>

		</ul>
		<script type="text/javascript">

			$(".modern-menu").modernMenu();

		</script>
			
			</td>
	</tr>
</table>
		  <br><br>
		  <center>
		<div>
			<?php echo $output; ?>
    	</div>
	</center>

            <br>
      
          <br>
          

          <br><br><br><br><br><br><br><br><br><br><br><br></div>
    </div>
  </section>
  <footer>
    <p class="lf" style="width: 312px">Copyright &copy; 2015 <a href="#">W<span class="auto-style1">athik</span></a> 
	- All Rights Reserved</p>
    <div style="clear:both;"></div>
  </footer>
</div>
<!-- END PAGE SOURCE -->

</body>
</html>