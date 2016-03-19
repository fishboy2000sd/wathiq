

<link href="<?=base_url()?>assets/css/wathiq_projects.css" rel="stylesheet">

<script src="<?=base_url()?>js/bootstrap.min.js"></script> 

<style type="text/css">
body {
	margin-top:40px;
}
.stepwizard-step p {
	margin-top: 10px;
}
.stepwizard-row {
	display: table-row;
}
.stepwizard {
	display: table;
	width: 50%;
	position: relative;
}
.stepwizard-step button[disabled] {
	opacity: 1 !important;
	filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
	top: 14px;
	bottom: 0;
	position: absolute;
	content: " ";
	width: 100%;
	height: 1px;
	background-color: #ccc;
	z-order: 0;
}
.stepwizard-step {
	display: table-cell;
	text-align: center;
	position: relative;
	direction:rtl;
}
.btn-circle {
	width: 30px;
	height: 30px;
	text-align: center;
	padding: 6px 0;
	font-size: 12px;
	line-height: 1.428571429;
	border-radius: 15px;
}
</style>

<script type="text/javascript">
  $(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
		  allWells = $('.setup-content'),
		  allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
	  e.preventDefault();
	  var $target = $($(this).attr('href')),
			  $item = $(this);

	  if (!$item.hasClass('disabled')) {
		  navListItems.removeClass('btn-primary').addClass('btn-default');
		  $item.addClass('btn-primary');
		  allWells.hide();
		  $target.show();
		  $target.find('input:eq(0)').focus();
	  }
  });

 /* allNextBtn.click(function(){
	  var curStep = $(this).closest(".setup-content"),
		  curStepBtn = curStep.attr("id"),
		  nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
		  curInputs = curStep.find("input[type='text'],input[type='url'],textarea[textarea]"),
		  isValid = true;

	  $(".form-group").removeClass("has-error");
	  for(var i=0; i<curInputs.length; i++){
		  if (!curInputs[i].validity.valid){
			  isValid = false;
			  $(curInputs[i]).closest(".form-group").addClass("has-error");
		  }
	  }

	  if (isValid)
		  nextStepWizard.removeAttr('disabled').trigger('click');
  });*/

  //$('div.setup-panel div a.btn-primary').trigger('click');
  //var attr = $(this).attr('disabled');
  //alert(attr);
  $("a.active").trigger("click");
});
  </script>

<?php 

	
	$uri2 = $this->ci->uri->segment(2);
	//print_r($this->ci->uri);
	//echo $column->project_status_id;
	if($uri2 == "projects_management"){
		$project_status_id =  @$this->project_status_id; 
		$uri3 = $this->ci->uri->segment(3);

		//echo "<pre>"; print_r( $this->get_column("name") ); echo "</pre>"; exit;

		//echo "<pre>"; print_r( $input_fields["project_status_id"] ); echo "</pre>"; exit;

		

		if($uri3 == "add" || $uri3 == "edit"){
			//if($uri3 == "add")
			//	$project_status_id = 1;
			//echo "Initilization";
			//echo $project_status_id;
?>


  <div class="stepwizard col-md-offset-3" style="direction: rtl">
    <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step">
        <a href="#step-1" type="button" class="btn btn-primary btn-circle <?php if($project_status_id == 1) echo 'active'; ?>" <?php if($project_status_id != 1) echo "disabled=\"disabled\""; ?>>1</a>
        <p>الإنشاء</p>
      </div>
          <div class="stepwizard-step">
        <a href="#step-2" type="button" class="btn btn-default btn-circle <?php if($project_status_id == 2) echo 'active'; ?>" <?php if($project_status_id != 2) echo "disabled=\"disabled\""; ?>>
			  2</a>
        <p>التصميم</p>
      </div>
          <div class="stepwizard-step">
        <a href="#step-3" type="button" class="btn btn-default btn-circle <?php if($project_status_id == 3) echo 'active'; ?>" <?php if($project_status_id != 3) echo "disabled=\"disabled\""; ?>>
			  3</a>
        <p>الطرح </p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-4" type="button" class="btn btn-default btn-circle <?php if($project_status_id == 4) echo 'active'; ?>" <?php if($project_status_id != 4) echo "disabled=\"disabled\""; ?>>
			  4</a>
        <p>الترسية</p>
        </div>
        <div class="stepwizard-step">
        <a href="#step-5" type="button" class="btn btn-default btn-circle <?php if($project_status_id == 5) echo 'active'; ?>" <?php if($project_status_id != 5) echo "disabled=\"disabled\""; ?>>
			  5</a>
        <p>التنفيذ </p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-5" type="button" class="btn btn-default btn-circle <?php if($project_status_id == 6) echo 'active'; ?>" <?php if($project_status_id != 6) echo "disabled=\"disabled\""; ?>>
			  6</a>
        <p>الإغلاق </p>
      </div>

      </div>

        </div>
<?php 
	}

	}

?>

