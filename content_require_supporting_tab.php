<style>
    .fileuploader
    {
        margin: 0px!important;
    }
    
</style>
<?php 
    // print_r($supporting_documents_detail);
?>
<!-- <div class="row">
    <div class="col-md-12"> -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Required Supporting Document</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                    </div>        

                </div>
            </div>

            <div class="card-body">
            <?php include("message.php"); ?>
            
                <form  class="form-horizontal validate-form" enctype="multipart/form-data" data-err_msg_ele="help"  method="post" action="process/controller_action_api_call.php">
                    <div class="row" style="padding: 15px;">
                    <div class="col-md-12"><h4>Required Supporting Documents</h4></div>
                    
                    <?php
                        if(isset($_REQUEST['id']))
                        {
                            echo '<input type="hidden" name="form_id" value="'.$_REQUEST['id'].'">';
                        } 
                        include "message.php";
                        if (isset($is_admin_form) && $is_admin_form == 1) {
                            ?>
                            <input type="hidden" name="action" value="update_require_document"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php 
                        } else {
                            ?>
                            <input type="hidden" name="action" value="update_require_document"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=require-supporting-doc&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=additional-question&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php
                        }
                    ?>
                    <!-- <input type="hidden" name="action" value="update_require_document"/>
                    <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=require-supporting-doc&id=<?php echo $_REQUEST['id']; ?>"/>
                    <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=additional-question&id=<?php echo $_REQUEST['id']; ?>"/> -->
                        
                        
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Driver's License/Passport<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="file" name="driver_license_passport" id="driver_license_passport"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['driver_license_passport']) && $supporting_documents_detail['driver_license_passport']!="")
                            {
                                $file_name=$supporting_documents_detail['driver_license_passport'];
                                $id_file="driver_license_passport";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Social Security Card<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="file" name="social_security_card" id="social_security_card"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['social_security_card']) && $supporting_documents_detail['social_security_card']!="")
                            {
                                $file_name=$supporting_documents_detail['social_security_card'];
                                $id_file="social_security_card";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Birth Certificate</label>
                            <div class="form-group">
                                <input type="file" name="birth_certificate" id="birth_certificate"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['birth_certificate']) && $supporting_documents_detail['birth_certificate']!="")
                            {
                                $file_name=$supporting_documents_detail['birth_certificate'];
                                $id_file="birth_certificate";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Proof of name change</label>
                            <div class="form-group">
                                <input type="file" name="proof_name_change" id="proof_name_change"  class="form-control single-upload-file" placeholder="" value=""  >
                                <?php if(isset($supporting_documents_detail['proof_name_change']) && $supporting_documents_detail['proof_name_change']!="")
                                {
                                    $file_name=$supporting_documents_detail['proof_name_change'];
                                    $id_file="proof_name_change";
                                    echo GetUploadedSingleFileLayout($file_name,$id_file);
                                } ?>
                                <span class="text-danger" >(ex. marriage certificate, divorce)</span>
                                <span class="help" id="msg2"></span>
                            </div>
                            
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Medical School Diploma<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="file" name="medical_diploma" id="medical_diploma"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['medical_diploma']) && $supporting_documents_detail['medical_diploma']!="")
                            {
                                $file_name=$supporting_documents_detail['medical_diploma'];
                                $id_file="medical_diploma";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="text-danger" >(i.e., MD, DO) (translated if not in English)</span>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Internship / Residency / Fellowship Certificates</label>
                            <div class="form-group">
                                <input type="file" name="internship_certificate" id="internship_certificate"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['internship_certificate']) && $supporting_documents_detail['internship_certificate']!="")
                            {
                                $file_name=$supporting_documents_detail['internship_certificate'];
                                $id_file="internship_certificate";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="text-danger" >(translated if not in English)</span>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">USMLE / NBOME / Complex transcripts & scores<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="file" name="transcripts_scores" id="transcripts_scores"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['transcripts_scores']) && $supporting_documents_detail['transcripts_scores']!="")
                            {
                                $file_name=$supporting_documents_detail['transcripts_scores'];
                                $id_file="transcripts_scores";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">License(s) including DEA and/or CS<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="file" name="license_dea_cs" id="license_dea_cs"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['license_dea_cs']) && $supporting_documents_detail['license_dea_cs']!="")
                            {
                                $file_name=$supporting_documents_detail['license_dea_cs'];
                                $id_file="license_dea_cs";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">CME/CE Certificates and/or transcripts<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="file" name="cme_ce_certificate" id="cme_ce_certificate"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['cme_ce_certificate']) && $supporting_documents_detail['cme_ce_certificate']!="")
                            {
                                $file_name=$supporting_documents_detail['cme_ce_certificate'];
                                $id_file="cme_ce_certificate";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="text-danger" >(from past 24 months)</span>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Board Certification<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="file" name="board_certificate" id="board_certificate"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['board_certificate']) && $supporting_documents_detail['board_certificate']!="")
                            {
                                $file_name=$supporting_documents_detail['board_certificate'];
                                $id_file="board_certificate";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="text-danger" >(i.e., ABFM, ABIM, AOBFM, AOBIM)</span>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Documentation of you current military status</label>
                            <div class="form-group">
                                <input type="file" name="military_status_document" id="military_status_document"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['military_status_document']) && $supporting_documents_detail['military_status_document']!="")
                            {
                                $file_name=$supporting_documents_detail['military_status_document'];
                                $id_file="military_status_document";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="text-danger" >(if active duty) or discharge papers (DD Form 214) (if applicable)</span>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Original Signature</label>
                            <div class="form-group">
                                <input type="file" name="original_signature" id="original_signature"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['original_signature']) && $supporting_documents_detail['original_signature']!="")
                            {
                                $file_name=$supporting_documents_detail['original_signature'];
                                $id_file="original_signature";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="text-danger" >(Optional: for digital signature)</span>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">CV</label>
                            <div class="form-group">
                                <input type="file" name="cv" id="cv"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['cv']) && $supporting_documents_detail['cv']!="")
                            {
                                $file_name=$supporting_documents_detail['cv'];
                                $id_file="cv";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="text-danger" >(include any gaps in history more than 30 days such as maternity, sabbatical, vacation leave)</span>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label" style="font-size:15px!important;">Malpractice supporting documentation (If applicable)</label>
                            <div class="form-group">
                                <input type="file" name="malpractice_support_document" id="malpractice_support_document"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['malpractice_support_document']) && $supporting_documents_detail['malpractice_support_document']!="")
                            {
                                $file_name=$supporting_documents_detail['malpractice_support_document'];
                                $id_file="malpractice_support_document";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="text-danger" >(translated if not in English)</span>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <label for="firstname" class="control-label">Affirmative  Responses</label>
                            <div class="form-group">
                                <input type="file" name="affirmative_response" id="affirmative_response"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['affirmative_response']) && $supporting_documents_detail['affirmative_response']!="")
                            {
                                $file_name=$supporting_documents_detail['affirmative_response'];
                                $id_file="affirmative_response";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="text-danger" >Supporting documentation related to affirmative response to attestation question and/or criminal conviction (if applicable)</span>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="firstname" class="control-label">Proof of malpractice insurance from previous employer(s) 10 years history of claim reports</label>
                            <div class="form-group">
                                <input type="file" name="malpractice_insurance" id="malpractice_insurance"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['malpractice_insurance']) && $supporting_documents_detail['malpractice_insurance']!="")
                            {
                                $file_name=$supporting_documents_detail['malpractice_insurance'];
                                $id_file="malpractice_insurance";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="text-danger" >(translated if not in English)</span>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="firstname" class="control-label">NPDB self query report</label>
                            <div class="form-group">
                                <input type="file" name="npdb_report" id="npdb_report"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['npdb_report']) && $supporting_documents_detail['npdb_report']!="")
                            {
                                $file_name=$supporting_documents_detail['npdb_report'];
                                $id_file="npdb_report";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="text-danger" >Ordering NPDB self query: https://www.npdb.hrsa.gov/ext/selfquery/SQHome.jsp Using the link above, please click “start a new order” and follow the steps given to complete the order. This should take 10-15 minutes. Once you’ve entered all of the information, please order an electronic copy that you will be able to save after the process is complete. Before the order can be finalized, you must answer 4 personal questions to access your NPDB report. The other option is to notarize a form that they provide.</span>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="control-label">Passport Photo<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="file" name="passport_photo" id="passport_photo"  class="form-control single-upload-file" placeholder="" value=""  >
                                
                            <?php if(isset($supporting_documents_detail['passport_photo']) && $supporting_documents_detail['passport_photo']!="")
                            {
                                $file_name=$supporting_documents_detail['passport_photo'];
                                $id_file="passport_photo";
                                echo GetUploadedSingleFileLayout($file_name,$id_file);
                            } ?>
                                <span class="text-danger" >Passport Photo (2 x 2 of full face and shoulders taken within the past six months.) Passport headshot: We recommend downloading an application on your smartphone that allows you to take a picture from your phone. Here are a few applications:</span>
                                <span class="help" id="msg2"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center" style="margin-top:15px;">

                        <?php
                            if(isset($is_admin_form) && $is_admin_form == 1 ){

                            }else{

                           
                            ?>
                            <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id']; ?>&tab=state-board-setup" id="" class="btn btn-default">back</a>
                            <?php
                            }
                            ?>
                            <button type="submit" id="submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                        </div>


                    </div>
                </form>

            </div>
            
        </div>

    <!-- </div>

</div> -->