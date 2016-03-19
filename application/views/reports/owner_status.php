

     <h3 align="center">تقرير يوضح حالة الملكية للموقع </h3>
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
                                <label style="font-size: 20px;direction: rtl">نوع الملكية :
                                <select name="owner_types" id="owner_types">
                                    <option value="all">الكل</option>
                                    <?php
                                    if(isset($data_owner_type)) {
                                        for($i=0;$i<$data_owner_type;$i++) {
                                            echo '<option value="'.$owner_type_ID[$i].'">'.$owner_type_Name[$i].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                </label>
                            </div>
                            
                            <div class="par_form" style="float:right;margin-right: 15px">    
                                <label style="font-size: 20px;direction: rtl">الحـــــــالة :
                                <select name="ownStatus" id="ownStatus">
                                    <option value="all">الكل</option>
                                    <?php
                                    if(isset($data_project_status)) {
                                        for($i=0;$i<$data_project_status;$i++) {
                                            echo '<option value="'.$project_status_ID[$i].'">'.$project_status_Name[$i].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                </label>
                            </div>
<br/>

                  <input type="hidden" id="report_type" value="owner_status">
                           							                            
                            <br/><br/> <br/><br/> <br/><br/><br/><br/>
                            <div class="par_form" align="center">                                            
                             <button class="btn btn-large btn-inverse" id="empty_fields">جديد  </button>
                             <button class="btn btn-large btn-success" id="show_report" name="submit"> عرض </button>                                                                                                                   
                            </div>
                        </fieldset>
                    </form>
                    
                    <br/><br/>
               
              