

<h3>تقرير يعرض احصائيات الأراضي حسب التقسيمات الادارية</h3>
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
                                <label style="font-size: 20px;direction: rtl">نوع الموقع :
                                <select name="site_types" id="site_types">
                                    <option value="all">الكل</option>
                                    <?php
                                    if(isset($Sites)) {
                                        for($i=0;$i<$Sites;$i++) {
                                            echo '<option value="'.$SiteTypeID[$i].'">'.$SiteTypeName[$i].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                </label>
                            </div>
                            
                            <div class="par_form" style="float:right;margin-right: 15px">    
                                <label style="font-size: 20px;direction: rtl">نوع الملكية :
                                <select name="owner_types" id="owner_types">
                                    <option value="all">الكل</option>
                                    <?php
                                    if(isset($Owners)) {
                                        for($i=0;$i<$Owners;$i++) {
                                            echo '<option value="'.$OwnerTypeID[$i].'">'.$OwnerTypeName[$i].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                </label>
                            </div>
                            <input type="hidden" id="report_type" value="stat">
<br/>

                           							                            
                            <br/><br/> <br/><br/> <br/><br/><br/><br/>
                            <div class="par_form" align="center">                                            
                             <button class="btn btn-large btn-inverse" id="empty_fields">جديد  </button>
                             <button class="btn btn-large btn-success" id="show_report" name="submit"> عرض </button>                                                                                                                   
                            </div>
                        </fieldset>
                    </form>
               