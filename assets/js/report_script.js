function get_sector(){
    var sectors = $("#sectors option:selected").val();    

        $.ajax({
            type: "POST",
            url: "../reports/getSectorsbyId/",
            secureuri: false,
            data: {},
            dataType: "json",
            cache: false,
            success: function(data){
                if (data.status == "success"){
                    //alert(data.city_id)
                    $("#sectors").html(data.output);
                }
                else{
                    //$("#remove").remove();
                    //$("#dialog-message").append('<p align="center" id="remove">'+data.msg+'</p>');
                    //$("#dialog-message").dialog('open');
                    alert(data.msg)
                    $("#sectors").html("<option value='all'>الكل</option>");
                }
            }
        });
   
}


function get_region(){
    
    var sectors = $("#sectors option:selected").val();        
    if ((sectors == "") || (sectors == 0 )) {
        $("#sectors option:selected").focus();
        $("#sectors").css({
            'backgroundcolor':'#FFeeee',
            'border': '1px solid red'
        });
        return false;
    }
    else
    {
        $("#sectors").css({
            'backgroundcolor':'#ddFFBA',
            'border': '1px solid yellow'
        });
            $.ajax({
                type: "POST",
                url: "../reports/getRegions/",
                secureuri: false,
                data: {
                    'sectors' : sectors
                },
                dataType: "json",
                cache: false,
                success: function(data){                	
                    if (data.status == "success"){
                        $("#regions").html(data.output);                        
                    }
                    else{
                        //$("#remove").remove();
                        //$("#dialog-message").append('<p align="center" id="remove">'+data.msg+'</p>');
                        //$("#dialog-message").dialog('open');
                        alert(data.msg)
                        $("#regions").html("<option value='all'>الكل</option>");
                    }
                }
            });        
    }
    return false;

}








function get_state(){
    //var group_id = $("input#group_id").val();
	var sectors = $("#sectors option:selected").val();
    var regions = $("#regions option:selected").val();
            
            $.ajax({
                type: "POST",
                url: "../reports/getStates/",
                secureuri: false,
                data: {
                    'regions' : regions
                },
                dataType: "json",
                cache: false,
                success: function(data){
                    if (data.status == "success"){
                        $("#states").html(data.output);
                    }
                    else{
                        //$("#remove").remove();
                        //$("#dialog-message").append('<p align="center" id="remove">'+data.msg+'</p>');
                        //$("#dialog-message").dialog('open');
                        alert(data.msg)
                        $("#states").html("<option value='all'>الكل</option>");
                    }
                }
            });
     
            return false;

}




/* reports */

$(function() {
    $('#show_report').live("click",function(e) {	
        e.preventDefault();
        
        var sectors = $("#sectors option:selected").val();
        var regions = $("#regions option:selected").val();
        var states = $("#states option:selected").val();
        
        var site_types = $("#site_types option:selected").val();
        var owner_types = $("#owner_types option:selected").val();      
        var consultant  = $("#consultant option:selected").val();
        var ownStatus  = $("#ownStatus option:selected").val();
        var report_type = $("input#report_type").val();
			          
        	
            	$.isLoading({ text: "الرجاء الانتظار بينما تتم المعالجة" });     
                  $.ajax({
                      type: "POST",
                      url: "../reports/showDataReports/",
                      secureuri		:false,
                      cache: false,
                      //dataType	: 'json',
                      data: {
                          "sectors"  : sectors,
                          "regions"  : regions,
                          "states" : states,
                          "site_types" : site_types,
                          "owner_types" :  owner_types,
                          "owner_status" :  ownStatus,
                          "consultant" : consultant,
                          "report_type": report_type
                          },
                      success: function(data){
                          if(data)
                          {                        	  
                        	  $.isLoading( "hide" );
                              $("#showReports").html(data);
                              $('html, body').animate({
                                  scrollTop:750
                              }, 'slow');
                             
                                                                     
                          }
                          else{
                                  //$("#remove").remove();
                                  alert('يوجد خطأ او هنالك بيانات ناقصة');
                                  //$("#dialog-message").dialog('open');                                                
                          }
                      }
                  });                
           
        
        
    });
});