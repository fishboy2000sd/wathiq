

		<script   src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script   src="<?php echo base_url(); ?>assets/js/bootstrap-popover.js"></script> 
<script   src="<?php echo base_url(); ?>assets/js/mustache.js"></script>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
		chart: {
                type: 'line'
            },
            title: {
                text: 'عدد القطع '
            },
            
            xAxis: {
                categories: [
					'Saturday',
                    'Sunday',
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday'
                    
                ]
            },
            yAxis: {
                title: {
                    text: 'value'
                }
            },                                  
           tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:,.0f} قطعة</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'القطع',
                data:  [100, 150, 80, 25, 50, 100, 22]            
            }]
            
        });
    
    
});



/*---------------------consultant------------------*/

		
		$(function () {
	$('#consultant').highcharts({
	
	    chart: {
	        type: 'gauge',
	        plotBorderWidth: 1,
	        plotBackgroundColor: {
	        	linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	        	stops: [
	        		[0, '#FFF4C6'],
	        		[0.3, '#FFFFFF'],
	        		[1, '#FFF4C6']
	        	]
	        },
	        plotBackgroundImage: null,
	        height: 200
	    },
	
	    title: {
	        text: 'الاستشاريين'
	    },
	    
	    pane: [{
	        startAngle: -45,
	        endAngle: 45,
	        background: null,
	        center: ['12%', '120%'],
	        size: 180
	    }, {
	    	startAngle: -45,
	    	endAngle: 45,
	    	background: null,
	        center: ['37%', '120%'],
	        size: 180
	    }, {
	    	startAngle: -45,
	    	endAngle: 45,
	    	background: null,
	        center: ['63%', '120%'],
	        size: 180
	    }, {
	    	startAngle: -45,
	    	endAngle: 45,
	    	background: null,
	        center: ['88%', '120%'],
	        size: 180
	    }],	    		        
	
	    yAxis: [
{
	        min: 0,
	        max: 100,
	        minorTickPosition: 'outside',
	        tickPosition: 'outside',
	        labels: {
	        	rotation: 'auto',
	        	distance: 20
	        },
	        plotBands: [{
	        	from: 0,
	        	to: 10,
	        	color: '#C02316',
	        	innerRadius: '100%',
	        	outerRadius: '105%'
	        }],
	        pane: 0,
	        title: {
	        	text: '<br/><span style="font-size:13px">دار الرياض</span>',
	        	y: -20
	        }
	   }, {
	        min: 0,
	        max: 100,
	        minorTickPosition: 'outside',
	        tickPosition: 'outside',
	        labels: {
	        	rotation: 'auto',
	        	distance: 20
	        },
	        plotBands: [{
	        	from: 0,
	        	to: 10,
	        	color: '#C02316',
	        	innerRadius: '100%',
	        	outerRadius: '105%'
	        }],
	        pane: 1,
	        title: {
	        	text: '<br/><span style="font-size:13px">Parsons</span>',
	        	y: -20
	        }
	    }, {
		    min: 0,
	        max: 100,
	        minorTickPosition: 'outside',
	        tickPosition: 'outside',
	        labels: {
	        	rotation: 'auto',
	        	distance: 20
	        },
	        plotBands: [{
	        	from: 0,
	        	to: 10,
	        	color: '#C02316',
	        	innerRadius: '100%',
	        	outerRadius: '105%'
	        }],
	        pane: 2,
	        title: {
	        	text: '<br/><span style="font-size:13px">عمرانية</span>',
	        	y: -20
	        }
	    }, {

	        min: 0,
	        max: 100,
	        minorTickPosition: 'outside',
	        tickPosition: 'outside',
	        labels: {
	        	rotation: 'auto',
	        	distance: 20
	        },
	        plotBands: [{
	        	from: 0,
	        	to: 10,
	        	color: '#C02316',
	        	innerRadius: '100%',
	        	outerRadius: '105%'
	        }],
	        pane: 3,
	        title: {
	        	text: '<br/><span style="font-size:13px"> زهير فايز</span>',
	        	y: -20
	        }	    
	    }
	    ],
	    
	    plotOptions: {
	    	gauge: {
	    		dataLabels: {
	    			enabled: false
	    		},
	    		dial: {
	    			radius: '100%'
	    		}
	    	}
	    },
	    	
	
	    series: [{
	        data: [80],
	        yAxis: 0
	    }, {
	        data: [15],
	        yAxis: 1
	    }, {
		        data: [40],
		        yAxis: 2
	    }, {
	        data: [22],
	        yAxis: 3		    
	    }]
	
	},
	
	// Let the music play
	function(chart) {
	    setInterval(function() {
	        var left = chart.series[0].points[0],
	            right = chart.series[1].points[0],
	            leftVal, 
	            inc = (Math.random() - 0.5) * 3;
	
	        leftVal =  left.y + inc;
	        rightVal = leftVal + inc / 3;
	        if (leftVal < 100 || leftVal > 0) {
	            leftVal = left.y - inc;
	        }
	        if (rightVal < 100 || rightVal > 0) {
	            rightVal = leftVal;
	        }
	
	        left.update(leftVal, false);
	        right.update(rightVal, false);
	        chart.redraw();
	
	    }, 500);
	
	});
});

		</script>
	<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modules/exporting.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts-more.js"></script>




		
		<!-- 3. Add the container -->
<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div><br/><br/><br/><br/>				
<div id="consultant" style="width: 800px; height: 400px; margin: 0 auto"></div>
	