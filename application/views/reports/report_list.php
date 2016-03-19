<?php 
if($report_type == "stat"){
?>
            <table id="jo_list" class="table table-hover table-striped">                      
                      <thead>
                        <tr>                                                                                                                                                          
						  <th style="text-align:right">العقودات</th>
						  <th style="text-align:right">اجمالي القطع</th> 
						  <th style="text-align:right">البيان</th>					
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        //var_dump($report_data);
                         if(isset($show_data)){
                         for($i=0;$i<$show_data;$i++) { ?>
                      
                        <tr>                         				                                                    
						  
						  
                          <td style="text-align:right"><?=$CNT[$i]; ?></td>
                          <td style="text-align:right"><?=$total[$i]; ?></td>
<?php 
        if(isset($sector_name[$i])){
        ?>						  
                          <td style="text-align:right"><?=$sector_name[$i]; ?></td>
		<?php } else if(isset($region_name[$i])){ ?>
		                 <td style="text-align:right"><?=$region_name[$i]; ?></td>
		<?php } else{ ?>
                         <td style="text-align:right"><?=$state_name[$i]; ?></td>    
		<?php } ?>
                        </tr>
                               <?php } } ?>
							   							  
                      </tbody>
      </table>  
      
      <?php 
} 

else{

	if($report_type == "list_sites"){
	?>     
    <table id="jo_list" class="table table-hover table-striped">                      
                      <thead>
                        <tr>
                        <th style="text-align:right">الوحدات المتوقعة/عدد الوحدات الفعلي</th>  
                        <th style="text-align:right">الحالة</th>         
                        <th style="text-align:right">تاريخ بدء التصميم</th> 
                        <th style="text-align:right">الاستشاري</th> 
                        <th style="text-align:right">المساحة الفعلية /المساحة الاولية</th> 
                        <th style="text-align:right">نوع الموقع</th> 
                        <th style="text-align:right">الموقع</th>                
                        <th style="text-align:right">المحافظة </th>                                                                                                                                                          
						  <th style="text-align:right">المنطقة </th>						  
						  <th style="text-align:right">الرقم</th>					
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        //var_dump($report_data);
                         if(isset($show_data)){                         
                         	for($i=0;$i<$show_data;$i++) { 
                         ?>                      
                        <tr>   
                          <td style="text-align:right"><?=$expected_unit[$i]; ?>/<?=$actual_unit[$i]; ?></td> 
                          <td style="text-align:right"><?=$status[$i];?></td>
                          <td style="text-align:right"><?=$start_date[$i];?></td> 
                          <td style="text-align:right"><?=$consultant[$i];?></td>                  				                                                    						  						
                          <td style="text-align:right"><?=$site_area[$i]; ?>/<?=$consultunt_area[$i]; ?></td> 
                          <td style="text-align:right"><?=$site_type[$i]; ?></td>
                          <td style="text-align:right"><?=$site_name[$i]; ?></td>
                          <td style="text-align:right"><?=$stateName[$i]; ?></td> 
                          <td style="text-align:right"><?=$regionName[$i]; ?></td>
                          <td style="text-align:right"><?=$code[$i]; ?></td>   
                        </tr>
                        <?php } } ?>
							   							  
                      </tbody>
                  
      </table> 
      <table class="gridtable"  style="width: 100%">                      
                      <tbody>
                        <tr>                        
                        <td style="text-align:right">
                        <span> مجموع عدد الوحدات المتوقع : <?php echo $total_exp_unit; ?></span><br>
                        <span> مجموع عدد الوحدات الفعلي : <?php echo $total_actual_unit; ?></span><br>
                        <span> مجموع عدد الوحدات  : <?php echo $total_actual_unit+$total_exp_unit; ?></span> 
                        </td>                       
                        <td style="text-align:right">
                        <span> اجمالي المساحات الاولية : <?php echo $total_init_area; ?></span><br>
                        <span> اجمالي المساحات الفعلية : <?php echo $total_actual_area; ?></span><br>
                        <span> اجمالي كافة المساحات  : <?php echo $total_actual_area+$total_init_area; ?></span> 
                        </td>                            
                        <td style="text-align:right"> اجمالي كافة المواقع : <?php echo $total_site; ?></td>                       
                        </tr>
      </tbody>
      </table>            
      
<?php }
elseif ($report_type == "consultants"){
	$countr=1; 
	$consultant = array();
	$area = array();
	$volume = array(); 
	$chart_pie = array();
	?>

	<table id="jo_list" class="table table-hover table-striped">                      
                      <thead>
                        <tr>                        
                        <th style="text-align:right">Volume</th> 
                        <th style="text-align:right">المساحة المخصصة</th>                         
                        <th style="text-align:right">عدد الوحدات</th>                
                        <th style="text-align:right">عدد المواقع </th>                                                                                                                                                          
						  <th style="text-align:right">الاستشاري </th>						  
						  <th style="text-align:right">الرقم</th>					
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        //var_dump($report_data);
                         if(isset($show_data)){ 
                         	                       
                         	for($i=0;$i<$show_data;$i++) { 
                         		
                         ?>                      
                        <tr>                             
                          <td style="text-align:right"><?=$i;?></td>                  				                                                    						  						
                          <td style="text-align:right"><?=$site_area[$i]; ?></td>                           
                          <td style="text-align:right"><?=$actual_unit[$i]; ?></td>
                          <td style="text-align:right"><?=$site_no[$i]; ?></td> 
                          <td style="text-align:right"><?=$consultant_name[$i];?></td>
                          <td style="text-align:right"><?=$countr++; ?></td>   
                        </tr>
                        <?php 
                        array_push($consultant, "'$consultant_name[$i]'");
                        array_push($area, $site_area[$i]); 
                        array_push($chart_pie, "['$consultant_name[$i]'", "$site_area[$i]]");
                        
                        ?>
                        <?php } } ?>
                        
                        <tr>  
                        <td style="text-align:right;background-color: #CCC"><?php echo $unitCount; ?></td>      
                        <td style="text-align:right;background-color: #CCC"><?php echo $areaCount; ?></td>                
                        <td style="text-align:right;background-color: #CCC"><?php echo $unitCount; ?></td>                       
                        <td style="text-align:right;background-color: #CCC"><?php echo $siteCount; ?></td>                            
                        <td style="text-align:right">Grand Total</td>                        
                        <td></td>                      
                        </tr>
							   							  
                      </tbody>                  
      </table> 
      </br><br/>
      <?php                         
      $consultant = implode(",",$consultant);
      $area = implode(",",$area);
      $chart_pie = implode(",",$chart_pie);      
      ?>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'wathiq'
            },
            subtitle: {
                //text: 'wathiq'
            },
            xAxis: {
                categories: [<?php echo $consultant; ?>],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                max: 100,
                title: {
                   // text: 'area',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                //valueSuffix: ' millions'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -100,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
            	name: 'volume',
            	color: '#ED8621',            	
                data: [<?php echo $area; ?>]
            }, {
            	name:  'area', 
            	color: '#4D399F',               
            	data: [<?php echo $area; ?>]
            }]
        });
    });
    
$(function () {
    var chart;
    
    $(document).ready(function () {
    	
    	// Build the chart
        $('#consultant_area').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: ''
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.y +' ';
                        }
                    },
                    showInLegend: true
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 150,
                borderWidth: 1,                
                labelFormatter: function() {
                    var total = 0, percentage; 
                $.each(this.series.data, function() { 
                    total+=this.y; 
                 }); 

                 percentage=((this.y/total)*100).toFixed(1); 
                 //return this.name+' '+percentage+'%';
                    
                    return '<div style="text-align: left; width:150px;float:left;">' + this.name + '</div><div style="width:50px; float:right;text-align:right;">' + this.y + 'M</div>    <div style="width:40px; float:right;text-align:right;">' + percentage + '%</div>';
                }
            },
            series: [{
                type: 'pie',                
                data: [<?php echo $chart_pie; ?>]
            }]
        });
    });
    
});
		</script>


<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div><br/><br/><br/>
<div id="consultant_area" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

        
<?php }

elseif ($report_type == "project_phases"){
	?>
	
	<table id="jo_list" class="table table-hover table-striped">                      
                      <thead>
                        <tr>                        
                        <th style="text-align:right">المنطقة</th> 
                        <th style="text-align:right">المجموع</th>                         
                        <th style="text-align:right">التهيئة للتصميم</th>                
                        <th style="text-align:right">تحت الترسية </th>                                                                                                                                                          
						  <th style="text-align:right">تحت التصميم </th>						  
						  <th style="text-align:right">تحت التنفيذ</th>	
						  <th style="text-align:right">تحت الطرح</th>				
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        //var_dump($report_data);
                         if(isset($show_data)){ 
                         	                       
                         	for($i=0;$i<$show_data;$i++) { 
                         		
                         ?>                      
                        <tr>                             
                          <td style="text-align:right"><?=$region_name[$i];?></td>                  				                                                    						  						
                          <td style="text-align:right"><?=$total_area[$i]; ?></td>                           
                          <td style="text-align:right"><?=$actual_unit[$i]; ?></td>
                          <td style="text-align:right"><?=$site_no[$i]; ?></td> 
                          <td style="text-align:right"><?=$consultant_name[$i];?></td>
                          <td style="text-align:right"><?=$countr++; ?></td>   
                        </tr>                      
                        <?php } } ?>
                        
                        <tr>  
                        <td style="text-align:right;background-color: #CCC"><?php echo $unitCount; ?></td>      
                        <td style="text-align:right;background-color: #CCC"><?php echo $areaCount; ?></td>                
                        <td style="text-align:right;background-color: #CCC"><?php echo $unitCount; ?></td>                       
                        <td style="text-align:right;background-color: #CCC"><?php echo $siteCount; ?></td>                            
                        <td style="text-align:right">Grand Total</td>                        
                        <td></td>                      
                        </tr>
							   							  
                      </tbody>                  
      </table> 
	
	
<?php } 
elseif ($report_type == "owner_status"){
	$counter=1;
	?>
	<table id="jo_list" class="table table-hover table-striped">                      
                      <thead>
                        <tr>                        
                        <th style="text-align:right">الحالة</th>                                 
                        <th style="text-align:right">الاستشاري</th> 
                        <th style="text-align:right">رقم التخصيص</th> 
                        <th style="text-align:right">المساحة المخصصة</th> 
                        <th style="text-align:right">رقم الصك</th> 
                        <th style="text-align:right">نوع الموقع</th> 
                        <th style="text-align:right">الموقع</th>                
                        <th style="text-align:right">المحافظة </th>                                                                                                                                                          
						  <th style="text-align:right">المنطقة </th>						  
						  <th style="text-align:right">الرقم</th>					
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        //var_dump($report_data);
                         if(isset($show_data)){                         
                         	for($i=0;$i<$show_data;$i++) { 
                         ?>                      
                        <tr>                             
                          <td style="text-align:right"><?=$status[$i];?></td>                          
                          <td style="text-align:right"><?=$consultant[$i];?></td>
                          <td style="text-align:right"><?=$owner_type[$i];?></td>                  				                                                    						  						
                          <td style="text-align:right"><?=$site_area[$i]; ?></td>
                          <td style="text-align:right"><?=$code[$i]; ?></td> 
                          <td style="text-align:right"><?=$site_type[$i]; ?></td>
                          <td style="text-align:right"><?=$site_name[$i]; ?></td>
                          <td style="text-align:right"><?=$stateName[$i]; ?></td> 
                          <td style="text-align:right"><?=$regionName[$i]; ?></td>                          
                          <td style="text-align:right"><?=$counter++; ?></td>    
                        </tr>
                        <?php } } ?>
							   							  
                      </tbody>
                  
      </table> 
      <br/><br/>
      <table class="gridtable"  style="width: 100%">                      
                      <tbody>
                        <tr>                                                                          
                        <td style="text-align:right"> اجمالي كافة المواقع : <?php echo $total_site; ?></td>                       
                        </tr>
      </tbody>
      </table> 
	
<?php } } ?>





<script type="text/javascript">
<!--
jQuery(function() {
    $('#jo_list').dataTable( {
        
        "oLanguage": {
            "sLengthMenu": "عرض _MENU_ عناصر لكل صفحة",
            "sSearch": "البحث",
          
           
            "sZeroRecords": "لا توجد نتائج",
            "sInfo": "عرض من _START_ وحتى _END_  من إجمالي _TOTAL_ نتيجة",
            "sInfoEmpty": "عرض 0 إلى 0 من إجمالي 0 نتيجة",
            "sInfoFiltered": "(تصفية من  إجمالي _MAX_ نتائج)",
            "oPaginate" :{
            	"sFirst": " <div class=btn>البداية</div>  ",
    			"sLast": " <div class=btn>النهاية</div>  ",
                   "sNext": " <div class=btn>التالي</div>  ",    
                    "sPrevious": " <div class=btn>السابق</div> "
                           }

        },
        "bJQueryUI": true,       
          "oClasses":{
            "sPagePrevDisabled":"btn"         
        },
        "sDom": 'T<"clear"><"H"lfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
                "print",
				"copy",                
                "xls",
                {
                    "sExtends": "pdf",
                    "sPdfOrientation": "landscape",
                    "sPdfMessage": "Your custom message would go here."
                }                
            ]
        }     
        
    } );
} );
//-->
</script>
