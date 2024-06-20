<!-- <div class="row">
    <div class="col-md-12"> -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Exam History Details</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button type="button" onclick="SubmitCurrentForm()" class="btn btn-primary btn-sm"><?php   if(isset($is_admin_form) && $is_admin_form == 1 ){echo "Update Details";}else{echo "Save & Next";} ?></button>
                    </div>        

                </div>
            </div>

            <div class="card-body">
            <?php include("message.php"); ?>
            
                <form  class="form-horizontal validate-form" data-err_msg_ele="help"  method="post" action="process/controller_action_api_call.php">
                    <?php
                        if(isset($_REQUEST['id']))
                        {
                            echo '<input type="hidden" name="form_id" value="'.$_REQUEST['id'].'">';
                        } 
						include "message.php";
                        if (isset($is_admin_form) && $is_admin_form == 1) {
                            ?>
                            <input type="hidden" name="action" value="update_exam_history"/>
                            <input type="hidden" name="redirect_url_error" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <input type="hidden" name="redirect_url_success" value="../index.php?pid=admin_edit_boarding_app_form&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php 
                        } else {
                            ?>
                          <input type="hidden" name="action" value="update_exam_history"/>
                          <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=exam-history&id=<?php echo $_REQUEST['id']; ?>"/>
                          <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=board-certification&id=<?php echo $_REQUEST['id']; ?>"/>
                            <?php
                        }
                    ?>
                    <!-- <input type="hidden" name="action" value="update_exam_history"/>
                    <input type="hidden" name="redirect_url_error" value="../index.php?pid=add_boarding_form&tab=exam-history&id=<?php echo $_REQUEST['id']; ?>"/>
                    <input type="hidden" name="redirect_url_success" value="../index.php?pid=add_boarding_form&tab=board-certification&id=<?php echo $_REQUEST['id']; ?>"/> -->
                    <?php 
                        $total_items=1;
                        if(isset($_REQUEST['id']) && isset($exam_history_detail) && is_array($exam_history_detail))
                        {
                            $total_items = count($exam_history_detail);
                        }
                    ?>
                    <input type="hidden" id="total_items" value="<?php echo $total_items; ?>"/>
                    <h4>Exam History</h4>
                    <p>List complete exam history of all licensing exams. include the following: Exam Type, First try Date (if more than one attempt), Exam Date, Exam Passed, Score, # of Attempts, and Location.</p>
                    <div id="content_wrapper_more_items" class="" style="padding: 15px;">
                        <?php 
                            if(isset($_REQUEST['id']) && isset($exam_history_detail) && is_array($exam_history_detail))
                            {
                                for($cnt_i=0 ; $cnt_i<count($exam_history_detail); $cnt_i++)
                                {
                                    $cur_detail=$exam_history_detail[$cnt_i];
                                    include 'content_add_more_exam_history.php';
                                }
                            }else
                            {
                                $cnt_i=0;$cur_detail=array();  
                                include 'content_add_more_exam_history.php';
                            }
                        ?>
                        
                    </div>
                        <!-- content_add_more_exam_history.php -->
                    
                    <div class="row">    
                        <div class="col-sm-12 text-center">
                            
                            <button type="button"  id="add_more_item" onclick="AddMoreItem('exam-history');" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">+ Add Exam</button>
                        </div>
                        
                        <div class="col-sm-12 text-center" style="margin-top:15px;">
                        <?php
                            if(isset($is_admin_form) && $is_admin_form == 1 ){

                            }else{

                           
                            ?>
                            <a href="index.php?pid=add_boarding_form&id=<?php echo $_REQUEST['id'] ?>&tab=education-training" id="" class="btn btn-default">back</a>
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