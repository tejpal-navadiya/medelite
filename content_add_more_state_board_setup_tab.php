<?php 
    $cnt=$cnt_i+1;
?>
<div class="row col-sm-12" id="content_item<?php echo $cnt; ?>">
    <?php 
    if($cnt==1)
    {
        ?>
        <div class="col-sm-12"><h5><u>State Board <?php echo $cnt; ?></u></h5></div>
        <?php
    }else
    {
    ?>
    <div class="col-sm-8 col-md-9"><h5><u>State Board <?php echo $cnt; ?></u></h5></div>
    <div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>
    <?php } ?>
    <div class="col-sm-6 col-md-4">
        <label for="firstname"  class="control-label">Website </label>
        <div class="form-group">
            <select name="website[]" id="website<?php echo $cnt; ?>"  <?php echo $disabled;?> class="form-control" >
                <option value="AMA" <?php if(isset($cur_detail['website']) && $cur_detail['website']=="AMA"){ echo "selected";} ?>>AMA</option>
            </select>
            <!-- <input type="text" name="website[]" id="website<?php echo $cnt; ?>"  class="form-control" placeholder="Website" value=""  > -->
            <span class="help" id="msg2"></span>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Username</label>
        <div class="form-group">
            <input type="text" name="user_name[]" id="user_name<?php echo $cnt; ?>"  <?php echo $readonly;?> class="form-control" placeholder="Username" value="<?php if(isset($cur_detail['user_name'])){ echo $cur_detail['user_name'];} ?>"  >
            <span class="help" id="msg2"></span>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <label for="firstname" class="control-label">Password</label>
        <div class="form-group">
            <input type="text" name="password[]" id="password<?php echo $cnt; ?>" <?php echo $readonly;?>  class="form-control" placeholder="Password" value="<?php if(isset($cur_detail['password'])){ echo $cur_detail['password'];} ?>"  >
            <span class="help" id="msg2"></span>
        </div>
    </div>    
    
</div>