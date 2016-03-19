<?php 	
	$uri2 = $this->ci->uri->segment(2);
	//print_r($this->ci->uri);
	//echo $column->project_status_id;
	if($uri2 == "sites_management"){
		//$project_status_id =  @$this->project_status_id; 
		$uri3 = $this->ci->uri->segment(3);
		//echo "<pre>"; print_r( $this->get_column("name") ); echo "</pre>"; exit;
		//echo "<pre>"; print_r( $input_fields["project_status_id"] ); echo "</pre>"; exit;		
		if($uri3 == "add" || $uri3 == "edit"){
			//if($uri3 == "add")
			//	$project_status_id = 1;
			//echo "Initilization";
			//echo $project_status_id;
?>
  
  
  <script>
  $(function() {
    $( "#tabs" ).tabs();
    $( ".datepicker" ).datepicker();
  });
  </script>
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">محضر التسليم</a></li>
    <li><a href="#tabs-2">قرار التخصيص</a></li>
    <li><a href="#tabs-3">الصك</a></li>
  </ul>
  <div id="tabs-1">
  	<div class='form-display-as-box'>
		رقم مرجعي:
	</div>
	<div class='form-input-box'>
		<input type="text" name="ref_no-1" />
	</div>
	<div class='clear'></div>

	<div class='form-display-as-box'>
		تاريخ:
	</div>
	<div class='form-input-box'>
		<input type="text" name="date-1" class="datetime-input datepicker" />
	</div>
	<div class='clear'></div>

	<div class='form-display-as-box'>
		مساحة:
	</div>
	<div class='form-input-box'>
		<input type="text" name="area-1" />
	</div>
	<div class='clear'></div>

	<div class='form-display-as-box'>
		المرفقات:
	</div>
	<div class='form-input-box'>
		<span id="upload-button-1180549344" class="fileinput-button qq-upload-button" style="">
		<span>رفع ملف</span>
		<input type="file" name="attach-file-1" >
		<input class="hidden-upload-input" type="hidden" value="" name="attach-1">
		</span>

		<!-- <input type="text" name="attach-1" /> -->
	</div>
	<div class='clear'></div>

	<div class='form-display-as-box'>
		الملاحظات:
	</div>
	<div class='form-input-box'>		
		<textarea name="remarks-1"></textarea>
	</div>
	<div class='clear'></div>

  </div>
  <div id="tabs-2">
  	<div class='form-display-as-box'>
		رقم مرجعي:
	</div>
	<div class='form-input-box'>
		<input type="text" name="ref_no-2" />
	</div>
	<div class='clear'></div>

	<div class='form-display-as-box'>
		تاريخ:
	</div>
	<div class='form-input-box'>
		<input type="text" name="date-2" class="datetime-input datepicker" />
	</div>
	<div class='clear'></div>

	<div class='form-display-as-box'>
		مساحة:
	</div>
	<div class='form-input-box'>
		<input type="text" name="area-2" />
	</div>
	<div class='clear'></div>

	<div class='form-display-as-box'>
		المرفقات:
	</div>
	<div class='form-input-box'>
		<span id="upload-button-1180549344" class="fileinput-button qq-upload-button" style="">
		<span>رفع ملف</span>
		<input type="file" name="attach-file-2" >
		<input class="hidden-upload-input" type="hidden"  value="" name="attach-2">
		</span>

		<!-- <input type="text" name="attach-1" /> -->
	</div>
	<div class='clear'></div>

	<div class='form-display-as-box'>
		الملاحظات:
	</div>
	<div class='form-input-box'>		
		<textarea name="remarks-2"></textarea>
	</div>
	<div class='clear'></div>

  </div>
  <div id="tabs-3">
  	<div class='form-display-as-box'>
		رقم مرجعي:
	</div>
	<div class='form-input-box'>
		<input type="text" name="ref_no-3" />
	</div>
	<div class='clear'></div>

	<div class='form-display-as-box'>
		تاريخ:
	</div>
	<div class='form-input-box'>
		<input type="text" name="date-3" class="datetime-input datepicker" />
	</div>
	<div class='clear'></div>

	<div class='form-display-as-box'>
		مساحة:
	</div>
	<div class='form-input-box'>
		<input type="text" name="area-3" />
	</div>
	<div class='clear'></div>

	<div class='form-display-as-box'>
		المرفقات:
	</div>
	<div class='form-input-box'>
		<span id="upload-button-1180549344" class="fileinput-button qq-upload-button" style="">
		<span>رفع ملف</span>
		<input type="file" name="attach-file-3" >
		<input class="hidden-upload-input" type="hidden" value="" name="attach-3">
		</span>

		<!-- <input type="text" name="attach-1" /> -->
	</div>
	<div class='clear'></div>

	<div class='form-display-as-box'>
		الملاحظات:
	</div>
	<div class='form-input-box'>		
		<textarea name="remarks-3"></textarea>
	</div>
	<div class='clear'></div>

  </div>
  </div>
</div>
<?php 
	}

	}

?>