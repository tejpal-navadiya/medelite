<?php 
  require_once("config.php");
    $cnt=$cnt_i+1;
?>
<div class="row col-sm-12" id="content_item<?php echo $cnt; ?>">                        
    <?php 
    if($cnt==1)
    {
        ?>
        <div class="col-sm-12"><h5><u>Exam <?php echo $cnt; ?></u></h5></div>
        <?php
    }else
    {
    ?>
    <div class="col-sm-8 col-md-9"><h5><u>Exam <?php echo $cnt; ?></u></h5></div>
    <div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>
    <?php } ?>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Exam Type </label>
        <div class="form-group">
            <select name="exam_type[]" class="form-control select2" id="exam_type<?php echo $cnt; ?>">
                <option value="">Select Type</option>
                <?php
                    $sql = "SELECT id, name FROM me_exam_type where is_deleted='0'";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                        }
                    } else {
                        echo '<option value="">No found</option>';
                    }
                    
                ?>
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Examination </label>
        <div class="form-group">
            <select name="examination[]" class="form-control" id="examination<?php echo $cnt; ?>">
                <option value="">Select Level</option>
                <?php 
                    for ($i=1; $i < 6; $i++) 
                    {
                        $sel_level="";
                        if(isset($cur_detail['examination']) && $cur_detail['examination']==$i){ $sel_level= "selected";} 

                        echo '<option value="'.$i.'" '.$sel_level.'>Level '.$i.'</option>';
                    }
                ?>
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label"># of Attempts<span class="text-danger">*</span> </label>
        <div class="form-group">
            <select name="no_of_attempts[]" class="form-control" data-is_validate="1" id="no_of_attempts<?php echo $cnt; ?>">
                <option value="">Select Attemps</option>
                <?php 
                    for ($i=1; $i < 6; $i++) 
                    {
                        $sel_attemps="";
                        if(isset($cur_detail['no_of_attempts']) && $cur_detail['no_of_attempts']==$i){ $sel_attemps= "selected";} 
                        echo '<option '.$sel_attemps.'>'.$i.'</option>';
                    }
                ?>
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Score<span class="text-danger">*</span></label>
        <div class="form-group">
            <input type="number" name="score[]" id="score<?php echo $cnt; ?>" data-is_validate="1"  class="form-control " placeholder="Score" value="<?php if(isset($cur_detail['score'])){ echo $cur_detail['score'];} ?>"  >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">First try Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" name="first_try_date[]" data-is_validate="1" id="first_try_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['first_try_date'])){ echo $cur_detail['first_try_date'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Exam Date<span class="text-danger">*</span> </label>
        <div class="form-group">
            <input type="text" maxlength="100" name="exam_date[]" data-is_validate="1" id="exam_date<?php echo $cnt; ?>"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php if(isset($cur_detail['exam_date'])){ echo $cur_detail['exam_date'];} ?>">
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Exam Passed?<span class="text-danger">*</span> </label>
        <div class="form-group">
            <select name="is_passed[]" class="form-control" id="is_passed<?php echo $cnt; ?>" data-is_validate="1">
                <option value="Yes" <?php if(isset($cur_detail['is_passed']) && $cur_detail['is_passed']=="Yes"){ echo "selected";} ?>>Yes</option>
                <option value="No" <?php if(isset($cur_detail['is_passed']) && $cur_detail['is_passed']=="No"){ echo "selected";} ?>>No</option>
                
            </select>
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-8">
        <label for="firstname" class="control-label">Location</label>
        <div class="form-group">
            <input type="text" name="location[]" id="location<?php echo $cnt; ?>"  class="form-control " placeholder="Location" value="<?php if(isset($cur_detail['location'])){ echo $cur_detail['location'];} ?>"  >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-12">
        <label for="firstname" class="control-label">Notes</label>
        <div class="form-group">
            <input type="text" name="notes[]" id="notes<?php echo $cnt; ?>"  class="form-control " placeholder="Notes" value="<?php if(isset($cur_detail['notes'])){ echo $cur_detail['notes'];} ?>"  >
            <span class="help" id="msg2"></span>
        </div>
    </div>
</div>