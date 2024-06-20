<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> CE-Tracking List</h3>
                            </div>
                            <div class="col-sm-6 text-right">
                                <!-- <button type="button" class="btn btn-primary btn-sm">Save & Next</button> -->
                            </div>        

                        </div>
                    </div>

                    <div class="card-body">
                        <!-- <form class="form-horizontal" id="directory_form"  method="post" > -->
                        <form class="form-horizontal" id="ce_tracking_form"  method="post">
                        <?php if(isset($_REQUEST['id'])){echo "<input type='hidden' id='id' value='".$_REQUEST['id']."'>";}?>
                            <div class="row">
                            <!-- <div class="col-sm-6 col-md-4" style="display:none;">
                                    <label for="firstname" class="control-label">Practice /Employer /Facility Type</label>
                                    <div class="form-group">
                                        <select name="directry_type" class="form-control" id="directry_type">
                                            <option value="">Select Type</option>
                                            
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-6">
                                    <label for="firstname" class="control-label">State Medical Board Name<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" name="provider_approving_body" id="provider_approving"  class="form-control " placeholder="State Medical Board Name" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="firstname" class="control-label">Attention To</label>
                                    <div class="form-group">
                                        <input type="text" name="ce_course" id="ce_course"  class="form-control " placeholder="Attention To" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12"><label for="firstname" class="control-label">Address <span class="text-danger">*</span></label></div>
                                
                                <div class="col-sm-6">
                                    
                                    <div class="form-group">
                                        <input type="text" maxlength="150" name="address_line_1" id="address_line_1" class="form-control" placeholder="Address Line 1" value="">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="address_line_2" id="address_line_2"  class="form-control" placeholder="Address Line 2" value="" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>-->


                                
                              
                                <div class="col-sm-6 col-md-4">
                                     <div class="form-group">
                                        <input type="checkbox" id="applay_to_all_state" name="applay_to_all_state" value="1">
                                        <label for="applay_to_all_state">Apply to All States</label>
                                     </div>
                                       
                                     <div class="form-group">
                                        <input type="checkbox" id="state_specific" name="state_specific" value="1">
                                        <label for="state_specific">State(s) Specific</label>
                                    </div>
                                </div> 
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                   <label for="state_one" class="control-label">State One</label>
                                      
                                    <!-- <input type="text" maxlength="100" name="state_one" id="state_one"  class="form-control" placeholder="state_one" value="" > -->
                                        <select name="state_one" class="form-control" id="state_one">
                                            <option value="">Select State</option>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                   <label for="completed_date" class="control-label"> Date Completed </label>
                                    <div class="form-group">
                                        <input type="text"  name="completed_date[]" data-is_validate="1" id="completed_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['completed_date'])){ echo $cur_detail['completed_date'];} ?>">
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6 col-md-4">
                                     <div class="form-group">
                                        <input type="checkbox" id="select_ce_course_catelog" name="select_ce_course_catelog" value="1">
                                        <label for="select_ce_course_catelog">Select From MedElite CE Course Catalog</label>
                                     </div>
                                </div> 

                                <div class="col-sm-8 col-md-6">
                                    <div class="form-group">
                                    <select name="select_course" class="form-control" id="select_course">
                                            <option value="">Select Course</option>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="provider_approving_body" class="control-label">Educational Provider/Approving Body<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" name="provider_approving_body" id="provider_approving_body"  class="form-control " placeholder="State Medical Board Name" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="ce_course_transcript_description" class="control-label">CE Course or Transcript Description</label>
                                    <div class="form-group">
                                        <input type="text" name="ce_course_transcript_description" id="ce_course_transcript_description"  class="form-control " placeholder="Attention To" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <label for="course_content_requirements" class="control-label">Course Fulfills Content Requirement(s)for:</label>
                                    <div class="form-group">
                                    <select name="course_content_requirements" class="form-control" id="course_content_requirements">
                                            <option value="">Select Course</option>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label for="ce_hrs_first" class="control-label">CE Hrs</label>
                                    <div class="form-group">
                                        <input type="text" name="ce_hrs_first" id="ce_hrs_first"  class="form-control " placeholder="CE Hrs" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="pharmacology_hrs" class="control-label">Pharmacology Hrs</label>
                                    <div class="form-group">
                                        <input type="text" name="pharmacology_hrs" id="pharmacology_hrs"  class="form-control " placeholder="pharmacology hrs" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label for="total_ce_hrs" class="control-label">Total CE Hrs</label>
                                    <div class="form-group">
                                        <input type="text" name="total_ce_hrs" id="total_ce_hrs"  class="form-control" placeholder="Total CE Hrs" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                

                                <!-- <div class="col-sm-6">
                                     <div class="form-group">
                                        <input type="checkbox" id="catalog" name="catalog">
                                        <label for="catalog">Separate Addt'l CE Hrs.</label>
                                     </div>
                                </div>  -->

                                <div class="col-md-2">
                                <button type="button" id="shaprate_ce_hrs" onclick="AddMoreItem('ce-tracking');" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary"><i class="fas fa-plus"></i></button>
                                   </a>
                                   <button type="button" id="shaprate_ce_hrs"  class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary"><i class="fas fa-minus"></i></button>
                                   </a>
                                    <!-- <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-minus"></i></a> -->
                               </div>

                               <div class="col-sm-4">
                                 
                                    <div class="form-group">
                                        <input type="text" name="add_course_content" id="add_course_content"  class="form-control " placeholder="Addt'l Course Content(s)" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                 
                                    <div class="form-group">
                                        <input type="text" name="ce_hrs_two" id="ce_hrs_two"  class="form-control " placeholder="CE Hrs" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <textarea type ="file" maxlength="150" name="attachment" id="attachment" class="form-control" placeholder="Drag and drop or Browse" value="">
                                       </textarea>
                                    </div>
                                </div>
                                  
                                <!-- <div class="col-md-2">
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-minus"></i></a>
                               </div>

                               <div class="col-sm-4">
                                 
                                    <div class="form-group">
                                        <input type="text" name="course_content_two" id="course_content_two"  class="form-control " placeholder="Addt'l Course Content(s)" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                 
                                    <div class="form-group">
                                        <input type="text" name="ce_hrs_three" id="ce_hrs_three"  class="form-control " placeholder="CE Hrs" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <textarea type ="file" maxlength="150" name="p_address_line_1" id="p_address_line_1" class="form-control" placeholder="Drag and drop or Browse" value="">
                                       </textarea>
                                    </div>
                                </div>
               -->
                                <div class="col-sm-6 col-md-4">
                                     <div class="form-group">
                                        <input type="checkbox" id="update_ce_course" name="update_ce_course" value="1">
                                        <label for="update_ce_course">Update Change to MedElite CE Course Catalog</label>
                                     </div>
                                       
                                     <div class="form-group">
                                        <input type="checkbox" id="add_course_catelog" name="add_course_catelog" value="1">
                                        <label for="add_course_catelog">Add to MedElite CE Course Catalog</label>
                                    </div>
                                </div> 
                                <div class="col-md-12 text-center"><h5><u><b>Does Course fulfill additional separate state content requirements? <input type="checkbox" id="stateSpecific" name="stateSpecific" value="1"></b></u></h5></div>
                                <div class="col-md-2">
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-minus"></i></a>
                               </div>
                                <div class="col-sm-2">
                                    <!-- <label for="firstname" class="control-label">state</label> -->
                                    <div class="form-group">
                                    <select name="state_two" class="form-control" id="state_two">
                                            <option value="">State(s)</option>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- <label for="firstname" class="control-label">CE Hrs</label> -->
                                    <div class="form-group">
                                        <input type="text" name="state_content_requirement" id="state_content_requirement"  class="form-control " placeholder="Cource fulfills Content Requirements(s)for" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <!-- <label for="firstname" class="control-label">Pharmacology Hrs</label> -->
                                    <div class="form-group">
                                        <input type="text" name="ce_hrs" id="ce_hrs"  class="form-control " placeholder="CE Hrs" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                               
                             
                                <!-- <div class="col-md-2">
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-minus"></i></a>
                               </div> -->
                                <!-- <div class="col-sm-2">
                                    <!-- <label for="firstname" class="control-label">state</label> --
                                    <div class="form-group">
                                    <select name="state_two" class="form-control" id="state_two">
                                            <option value="">State(s)</option>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- <label for="firstname" class="control-label">CE Hrs</label> --
                                    <div class="form-group">
                                        <input type="text" name="course_content_two" id="course_content_two"  class="form-control" placeholder="Cource fulfills Content Requirements(s)for" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <!-- <label for="firstname" class="control-label">Pharmacology Hrs</label> --
                                    <div class="form-group">
                                        <input type="text" name="ce_hrs_three" id="ce_hrs_three"  class="form-control " placeholder="CE Hrs" value=""  >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div> -->
                               
                             
                             
                                <div class="col-sm-12 text-center">
                                   <a href="index.php?pid=ce_tracking_list" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Back</a>
                                    <button type="submit" id="ce_tracking_submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Submit Details</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                          
        </div>        

    </div>
</section>