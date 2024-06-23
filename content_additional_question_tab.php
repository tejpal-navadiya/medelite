<!-- <div class="row">
    <div class="col-md-12"> -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Additional Questions Details</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                    <?php 
                        if($is_readonly)
                        {
                    ?>
                    <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id'] ?>&tab=require-supporting-doc" id="" class="btn btn-default">back</a>
                    <?php }else{ ?>
                        <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                    <?php } ?>
                    </div>        

                </div>
            </div>

            <div class="card-body">
            <?php include("message.php"); ?>
            
                <form  class="form-horizontal validate-form" data-err_msg_ele="help"  method="post" action="process/controller_action_api_call.php">
                    <div class="row" style="padding: 15px;">
                    
                    <div class="col-md-12"><h4>Additional Questions</h4></div>
                    <div class="col-md-12"><p>If you answer “Yes” to any question, please provide a detailed explanation.</p></div>
                  
                  <?php
                    if (isset($is_admin_form) && $is_admin_form == 1) {
                            ?>
                            <input type="hidden" name="action" value="update_questions"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php 
                        } else {
                            ?>
                            <input type="hidden" name="action" value="update_questions"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=additional-question&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=provider-demographic&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php
                        }
                    ?>
                    <!-- <input type="hidden" name="action" value="update_questions"/>
                    <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=additional-question&id=<?php echo $_REQUEST['id']; ?>"/>
                    <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=provider-demographic&id=<?php echo $_REQUEST['id']; ?>"/> -->
                    <?php
                        if(isset($_REQUEST['id']))
                        {
                            echo '<input type="hidden" name="form_id" value="'.$_REQUEST['id'].'">';
                        } 
                        $question_list_arr=array();
                        $question_list_arr[1]="In the 10 years prior to this application have you had any physician injury or disease or mental illness or impairment, which could reasonably be expected to affect your ability to practice medicine or other health profession?";
                        $question_list_arr[2]="In the 10 years prior to this application have you been referred to or obtained treatment for a substance abuse disorder including alcohol abuse?";
                        $question_list_arr[3]="Have you EVER been arrested for, cited for, charged with, convicted of; or pled guilty to; or pled nolo contendere to, a violation of ANY municipal, state or federal statute? You must answer “Yes” even if records have been pardoned, expunged, plead down, released or sealed. (You do not have to report misdemeanor traffic offenses or traffic ordinance violations unless they involve alcohol or drugs).";
                        $question_list_arr[4]="Have you failed a professional licensure or certification examination (any step/part of FLEX, USMLE, NBME, NBOME, COMLEX-USA, SPEX/COMVEX-USA)?";
                        $question_list_arr[5]="Has your application for any professional license, certificate, or registration been denied by any state licensing board or federal authority?";
                        $question_list_arr[6]="Has your professional license, certificate, or registration been the subject of investigation or revoked, suspended, probated, restricted, reprimanded, limited, or subjected to any other disciplinary action by any state licensing board or federal authority?";
                        $question_list_arr[7]="Have you voluntarily surrendered any professional license, or agreed with any licensing authority not to seek re-licensure in order to avoid disciplinary action, investigation or inquiry?";
                        $question_list_arr[8]="Was your application for staff or clinical privileges at any hospital, clinic, or other health care institution denied?";
                        $question_list_arr[9]="Were you the subject of an inquiry or investigation by any hospital, clinic, or other health care institution which resulted in the suspension, restriction, probation or other limitation on your affiliation or staff or clinical privileges; including remediation and/or non-disciplinary sanctions?";
                        $question_list_arr[10]="Did you surrender or fail to renew staff or clinical privileges at any hospital, clinic, or other health care entity in lieu of investigation, while under investigation or while you were the subject of disciplinary proceedings?";
                        $question_list_arr[11]="Were you the subject of disciplinary action, placed on academic probation, or asked to undergo additional training or remediation during your professional training (as a student, intern, resident, fellow, or other trainee)?";
                        $question_list_arr[12]="Did you leave any professional training program as defined above before completion?";
                        $question_list_arr[13]="Did you leave any professional training program as defined above before completion?";
                        $question_list_arr[14]="Has your participation in any private, federal or state health insurance program been terminated, non-renewed, denied, suspended, restricted, placed on probation, or are you the subject of a current investigation or proceeding by such entities?";
                        $question_list_arr[15]="Have you surrendered your state or federal controlled substances permit or registration?";
                        $question_list_arr[16]="Has your membership in a professional society been revoked, suspended, or disciplined or have you resigned
                        membership while under investigation?";
                        $question_list_arr[17]="Have you EVER or do you have any malpractice claims, settlements, or judgements or medically related lawsuits
                        against you or pending, regardless of the outcome?";
                        $question_list_arr[18]="Has any court determined you are currently in violation of a court’s judgment or order for the support of dependent
                        children?";
                        $question_list_arr[19]="If you are seeking an expedited military permit, please respond to the following: Do you have a complaint, allegation, or investigation by anyone or any entity, currently pending against you, which is related to unprofessional conduct and/or an alleged crime? If so, please note, by law, the LSBME cannot issue or deny an applicant’s military permit until the complaint, allegation, or investigation is resolved, or the applicant otherwise satisfies the criteria for permanent licensure in Louisiana to the satisfaction of the LSBME.";
                        for ($i=1; $i <= count($question_list_arr); $i++) 
                        { 
                            $di=$i;
                            $name_param="answer[$di]";
                            $id_yes_param="question_".$di."_yes";
                            $id_no_param="question_".$di."_no";
                            $cdi=$di-1;
                            ?>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-8 col-lg-9">
                                            <label>Question <?php echo $di; ?><span  class="text-danger">*</span></label>
                                            <p><?php echo $question_list_arr[$i];  ?> </p>
                                        </div>
                                        <div class="col-md-4 col-lg-3 text-right">
                                            <input type="hidden" value="<?php echo $di; ?>" name="question_id[]" />
                                            <input type="radio" <?php echo $disabled;?> value="1" <?php if(isset($questions_detail[$cdi]) && is_array($questions_detail[$cdi]) && $questions_detail[$cdi]['answer']=="1"){echo "checked";} ?> id="<?php echo $id_yes_param; ?>" name="<?php echo $name_param; ?>" /><label for="<?php echo $id_yes_param; ?>">Yes</label>
                                            <input type="radio"  <?php echo $disabled;?> value="0" <?php if(isset($questions_detail[$cdi]) && is_array($questions_detail[$cdi])) { if($questions_detail[$cdi]['answer']=="0"){echo "checked";}}else{echo "checked";} ?> id="<?php echo $id_no_param; ?>" name="<?php echo $name_param; ?>" /><label for="<?php echo $id_no_param; ?>">No</label>
                                        </div>    
                                    </div>
                                </div>
                            <?php
                        }
                        ?>
                        

                        
                        <div class="col-sm-12 text-center" style="margin-top:20px;">
                        <?php   
                        if(isset($is_admin_form) && $is_admin_form == 1 )
                        {
                        }else
                        {
                            if(!$is_readonly)
                                {
                        ?>
                        
                            <button type="button" id="save_submit" onclick="SubmitLastOnboardingForm('0');" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Save As Draft</button>
                        <?php } } ?>
                        <!-- <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id'] ?>&tab=require-supporting-doc" id="" class="btn btn-default"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save";} ?></a> -->
                        <?php
                            if(isset($is_admin_form) && $is_admin_form == 1 ){

                            }else{
                                
                           
                            ?>
                            <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id'] ?>&tab=require-supporting-doc" id="" class="btn btn-default">back</a>
                             <?php
                            }
                            ?>
                        <input type="submit" id="submit" style="display:none;"/>
                        <input type="hidden" id="application_status" name="status" value="0"/>
                        <?php 
                                if($is_readonly)
                                {
                                    ?>
                                    <!-- <a href="index.php?pid=add_boarding_form&tab=additional-question&id=<?php echo $_REQUEST['id'];?>"  class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Next</a> -->
                                    <?php
                                }else
                                {
                                    ?>
                                        <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                                    <?php
                                }
                             ?>
                        <!-- <button type="button" id="save_submit" onclick="SubmitLastOnboardingForm('1');" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Submit</button> -->
                        </div>


                    </div>
                </form>

            </div>
            
        </div>

    <!-- </div>

</div> -->