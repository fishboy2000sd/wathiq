

     <h3 align="center">التقارير بالستشاريين </h3>
<br>
                    <form class="feedbackform" method="post">                        
                            <legend></legend>
                            <div class="par_form" style="float:right;margin-right: 15px">
                                <label style="font-size: 20px;direction: rtl">القطـــــــاع :
                                <select name="sectors" id="sectors" onchange="get_region();">
                                    <option value="all">الكل</option>                                    
                                    <?php                                    
                                    if(isset($data_sector)) {
                                        for($i=0;$i<$data_sector;$i++) {
                                            echo '<option value="'.$sector_ID[$i].'">'.$sector_Name[$i].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                </label>								
								
                            </div>
                            <div class="par_form" style="float:left;margin-left: 100px">
                                <label style="font-size: 20px;direction: rtl">المنطــــــقة :
                                <select name="regions" id="regions" onchange="get_state();">
                                    <option value="all">الكل</option>
                                </select>
                                </label>
                            </div>
                            
                            <div class="par_form" style="float:right;margin-right: 15px">    
                                <label style="font-size: 20px;direction: rtl">المحافظـــة :
                                <select name="states" id="states">
                                    <option value="all">الكل</option>
                                </select>
                                </label>
                            </div>
                                                                                                             
                            
                            <div class="par_form" style="float:left;margin-left: 100px">    
                                <label style="font-size: 20px;direction: rtl">الاستشاري :
                                <select name="consultant" id="consultant">
                                    <option value="all">الكل</option>
                                    <?php
                                    if(isset($data_consultant)) {
                                        for($i=0;$i<$data_consultant;$i++) {
                                            echo '<option value="'.$consultant_ID[$i].'">'.$consultant_Name[$i].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                </label>
                            </div>
<br/>

                  <input type="hidden" id="report_type" value="consultants">
                           							                            
                            <br/><br/> <br/><br/> <br/><br/><br/><br/>
                            <div class="par_form" align="center">                                            
                             <button class="btn btn-large btn-inverse" id="empty_fields">جديد  </button>
                             <button class="btn btn-large btn-success" id="show_report" name="submit"> عرض </button>                                                                                                                   
                            </div>
                        </fieldset>
                    </form>
       <br/><br/>
               
                   
              