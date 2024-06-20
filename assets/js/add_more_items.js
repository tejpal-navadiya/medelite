function AddMoreItem(type) 
{
    var total_items=$("#total_items").val();
    total_items=parseInt(total_items);
    var cnt=total_items+1;
    var item_html='';
    if(type=="education-training")
    {
        item_html=''+
        '<div class="row col-sm-12" id="content_item'+cnt+'" style="border-top:1px solid;padding-top:10px;">'+
            '<div class="col-sm-8 col-md-9"><h5><u>Institution '+cnt+'</u></h5></div><div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Institution Type 321111111</label>'+
                '<div class="form-group">'+
                    '<select name="institute_type[]" class="form-control" id="institute_type'+cnt+'">'+
                        '<option value="">Select Type</option>'+
                    '</select>'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Start Date </label>'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="100" name="start_date[]" id="start_date'+cnt+'"  class="form-control" placeholder="mm/dd/yyyy" value="">'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">End Date </label>'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="100" name="end_date[]" id="end_date'+cnt+'"  class="form-control" placeholder="mm/dd/yyyy" value="">'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-12">'+
                '<label for="firstname" class="control-label">Institution Name</label>'+
                '<div class="form-group">'+
                    '<input type="text" name="institute_name[]" id="institute_name'+cnt+'"  class="form-control" placeholder="Institution Name" value=""  >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+      
            '<div class="col-sm-12"><label for="firstname" class="control-label">Institute Address </label></div>'+
            '<div class="col-sm-6">'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="150" name="address_line_1[]" id="address_line_1-'+cnt+'" class="form-control" placeholder="Address Line 1" value="">'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6">'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="100" name="address_line_2[]" id="address_line_2-'+cnt+'"  class="form-control" placeholder="Address Line 2" value="" >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-3">'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="100" name="address_city[]" id="address_city'+cnt+'"  class="form-control" placeholder="City" value="" >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            // '<div class="col-sm-6 col-md-3">'+
            //     '<div class="form-group">'+
            //         '<input type="text" maxlength="100" name="address_state[]" id="address_state'+cnt+'"  class="form-control" placeholder="State" value="" >'+
            //         '<span class="help" id="msg2"></span>'+
            //     '</div>'+
            // '</div>'+

            '<div class="col-sm-6 col-md-3">'+
                '<div class="form-group">'+
                    '<select data-placeholder="Select State" name="address_state[]" class="form-control  state_dropdown" id="address_state'+cnt+'">'+
                    '</select>'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+

            '<div class="col-sm-6 col-md-3">'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="100" name="address_zipcode[]" id="address_zipcode'+cnt+'"  class="form-control" placeholder="Zip Code" value="" >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-3">'+
                '<div class="form-group">'+
                    '<select name="address_country[]" class="form-control" id="address_country'+cnt+'">'+
                        '<option value="">Select Country</option>'+
                    '</select>'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6">'+
                '<label for="firstname" class="control-label">Degree </label>'+
                '<div class="form-group">'+
                    '<select name="degree[]" class="form-control" id="degree'+cnt+'">'+
                        '<option value="">Select Degree</option>'+
                    '</select>'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6">'+
                '<label for="firstname" class="control-label">Major </label>'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="100" name="major[]" id="major'+cnt+'"  class="form-control" placeholder="major" value="">'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Program Completed? </label>'+
                '<div class="form-group">'+
                    '<select name="program_completed[]" class="form-control" id="program_completed'+cnt+'">'+
                        '<option value="">Completed</option>'+
                    '</select>'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Grad Date </label>'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="100" name="graduation_date[]" id="graduation_date'+cnt+'"  class="form-control" placeholder="mm/dd/yyyy" value="">'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
        '</div>';
        $("#content_wrapper_more_items").append(item_html);
        $("#total_items").val(cnt);
        $('#start_date'+cnt).datepicker({
            format: 'mm/dd/yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
        });
        $('#end_date'+cnt).datepicker({
            format: 'mm/dd/yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
        });
       $('#graduation_date'+cnt).datepicker({
            format: 'mm/dd/yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
        });

        
        var country_ele='#address_country'+cnt; 
        if($(country_ele).length)
        {
            InitCountryDropDown(country_ele);
        }

        var institute_type_ele='#institute_type'+cnt; 
        // alert(institute_type_ele);
        if($(institute_type_ele).length)
        {
            InitInstituteTypeDropDown(institute_type_ele);
        }

        var degree_ele='#degree'+cnt; 
        // alert(institute_type_ele);
        if($(degree_ele).length)
        {
            InitDegreeDropDown(degree_ele);
        }

        var state_ele='#address_state'+cnt; 
        if($(state_ele).length)
        {
            InitStateDropDown(state_ele);
        }

    }
    if(type=="exam-history")
    {
        var examination_option='';
        for (eoic=1; eoic < 6; eoic++) 
        { 
            var id=eoic;
            examination_option+='<option value="'+id+'"> Level '+eoic+'</option>';
            // console.log(medical_board_list_option);
        }
        var attemps_option='';
        for (eoic=1; eoic < 6; eoic++) 
        { 
            var id=eoic;
            attemps_option+='<option value="'+id+'">'+eoic+'</option>';
            // console.log(medical_board_list_option);
        }
        item_html=''+
            '<div class="row col-sm-12" id="content_item'+cnt+'" style="border-top:1px solid;padding-top:10px;">'+                        
                '<div class="col-sm-8 col-md-9"><h5><u>Exam '+cnt+'</u></h5></div><div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>'+    
                '<div class="col-sm-6 col-md-4">'+
                    '<label for="firstname" class="control-label">Exam Type </label>'+
                    '<div class="form-group">'+
                        '<select name="exam_type[]" class="form-control" id="exam_type'+cnt+'">'+
                            '<option value="">Select Type</option>'+
                        '</select>'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                
                '<div class="col-sm-6 col-md-4">'+
                    '<label for="firstname" class="control-label">Examination </label>'+
                    '<div class="form-group">'+
                        '<select name="examination[]" class="form-control" id="examination'+cnt+'">'+
                            '<option value="">Select Attemps</option>'+
                            examination_option+
                        '</select>'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-md-4">'+
                    '<label for="firstname" class="control-label"># of Attempts </label>'+
                    '<div class="form-group">'+
                        '<select name="no_of_attempts[]" class="form-control" id="no_of_attempts'+cnt+'">'+
                            '<option value="">Select Attemps</option>'+
                            attemps_option+
                        '</select>'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-md-4">'+
                    '<label for="firstname" class="control-label">Score</label>'+
                    '<div class="form-group">'+
                        '<input type="text" name="score[]" id="score'+cnt+'"  class="form-control " placeholder="Score" value=""  >'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-md-4">'+
                    '<label for="firstname" class="control-label">First try Date </label>'+
                    '<div class="form-group">'+
                        '<input type="text" maxlength="100" name="first_try_date[]" id="first_try_date'+cnt+'"  class="form-control" placeholder="mm/dd/yyyy" value="">'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-md-4">'+
                    '<label for="firstname" class="control-label">Exam Date </label>'+
                    '<div class="form-group">'+
                        '<input type="text" maxlength="100" name="exam_date[]" id="exam_date'+cnt+'"  class="form-control" placeholder="mm/dd/yyyy" value="">'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-md-4">'+
                    '<label for="firstname" class="control-label">Exam Passed? </label>'+
                    '<div class="form-group">'+
                        '<select name="is_passed[]" class="form-control" id="is_passed'+cnt+'">'+
                            '<option value="Yes">Yes</option>'+
                            '<option value="No">No</option>'+
                        '</select>'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-8">'+
                    '<label for="firstname" class="control-label">Location </label>'+
                    '<div class="form-group">'+
                        '<input type="text"  name="location[]" id="location'+cnt+'"  class="form-control" placeholder="Location" value="">'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-12">'+
                    '<label for="firstname" class="control-label">Notes </label>'+
                    '<div class="form-group">'+
                        '<input type="text"  name="notes[]" id="notes'+cnt+'"  class="form-control" placeholder="Notes" value="">'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
            '</div>  ';
        $("#content_wrapper_more_items").append(item_html);
        $("#total_items").val(cnt);

        $('#first_try_date'+cnt).datepicker({
            format: 'mm/dd/yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
        });
        $('#exam_date'+cnt).datepicker({
            format: 'mm/dd/yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
        });

        var exam_type_ele='#exam_type'+cnt; 
        // alert(institute_type_ele);
        if($(exam_type_ele).length)
        {
            InitexamTypeDropDown(exam_type_ele);
        }

        
    }
    
    if(type=="board-certification")
    {
        var medical_board_list_enc=$("#medical_board_list").val();
        var medical_board_list_json=atob(medical_board_list_enc);
        var medical_board_list_arr=JSON.parse(medical_board_list_json);
        // console.log(medical_board_list_arr);
        var medical_board_list_option='';
        for (csic=0; csic < medical_board_list_arr.length; csic++) 
        { 
            var id=csic+1;
            medical_board_list_option+='<option value="'+id+'">'+medical_board_list_arr[csic]+'</option>';
            // console.log(medical_board_list_option);

        }
        item_html=''+
                    '<div class="row col-sm-12" id="content_item'+cnt+'">'+
                    '<div class="col-sm-8 col-md-9"><h5><u>Board Certification '+cnt+'</u></h5></div><div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>'+
                    '<div class="col-sm-12">'+
                        '<label>American Medical Association(AMA)/American Osteopathic Association(AOA) Are you a Member? </label>'+
                        '<div class="form-group">'+
                            '<input type="radio" value="1" id="is_member_medical_board_yes'+cnt+'" name="is_member_medical_board[]" />Yes'+
                            '<input type="radio" value="0" id="is_member_medical_board_no'+cnt+'" name="is_member_medical_board[]" />No'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-3">'+
                        '<label for="firstname" class="control-label">Primary? </label>'+
                        '<div class="form-group">'+
                            '<input type="radio" value="1" id="is_primary_yes'+cnt+'" name="is_primary[]" />Yes'+
                            '<input type="radio" value="0" id="is_primary_no'+cnt+'" name="is_primary[]" />No'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-3">'+
                        '<label for="firstname" class="control-label">Board Eligible </label>'+
                        '<div class="form-group">'+
                            '<input type="radio" value="1" id="is_board_eligible_yes'+cnt+'" name="is_board_eligible[]" />Yes'+
                            '<input type="radio" value="0" id="is_board_eligible_no'+cnt+'" name="is_board_eligible[]" />No'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-3" style="display:none;">'+
                        '<label for="firstname" class="control-label">Indefinite </label>'+
                        '<div class="form-group">'+
                            '<input type="radio" value="1" id="is_indefinite_yes'+cnt+'" name="is_indefinite[]" />Yes'+
                            '<input type="radio" value="0" id="is_indefinite_no'+cnt+'" name="is_indefinite[]" />No'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-3" style="display:none;">'+
                        '<label for="firstname" class="control-label">Meeting MOC </label>'+
                        '<div class="form-group">'+
                            '<input type="radio" value="1" id="is_meeting_moc_yes'+cnt+'" name="is_meeting_moc[]" />Yes'+
                            '<input type="radio" value="0" id="is_meeting_moc_no'+cnt+'" name="is_meeting_moc[]" />No'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-12">'+
                        '<label for="firstname" class="control-label">Board Name </label>'+
                        '<div class="form-group">'+
                            '<select name="board_name[]" class="form-control" id="board_name'+cnt+'">'+
                                '<option value="">Select Board Name</option>'+
                                medical_board_list_option+
                            '</select>'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-4">'+
                        '<label for="firstname" class="control-label">Speciality/Subspeciality </label>'+
                        '<div class="form-group">'+
                            '<select name="specialty[]" class="form-control" id="specialty'+cnt+'">'+
                                '<option value="">Select Option</option>'+
                            '</select>'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-4">'+
                        '<label for="firstname" class="control-label">Certificate #</label>'+
                        '<div class="form-group">'+
                            '<input type="text" name="certificate_no[]" id="certificate_no'+cnt+'"  class="form-control datepicker" placeholder="Certificate #" value=""  >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-4">'+
                        '<label for="firstname" class="control-label">Focus </label>'+
                        '<div class="form-group">'+
                            '<select name="focus[]" class="form-control select2" id="focus'+cnt+'">'+
                                '<option value="">Select Option</option>'+
                            '</select>'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-4">'+
                        '<label for="firstname" class="control-label">Cert Status </label>'+
                        '<div class="form-group">'+
                            '<select name="status[]" class="form-control select2" id="status'+cnt+'">'+
                                '<option value="">Select Option</option>'+
                            '</select>'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-4">'+
                        '<label for="firstname" class="control-label">Exam Passed?</label>'+
                        '<div class="form-group">'+
                            '<select name="exam_passed[]" class="form-control select2" id="exam_passed'+cnt+'">'+
                                '<option value="">Select Option</option>'+
                                '<option value="Yes">Yes</option>'+
                                '<option value="No">No</option>'+
                            '</select>'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-4">'+
                        '<label for="firstname" class="control-label">Board Link</label>'+
                        '<div class="form-group">'+
                            '<input type="text" name="board_link[]" id="board_link'+cnt+'"  class="form-control" placeholder="Board Link" value=""  >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                        '<label for="firstname" class="control-label">Upload Documents</label>'+
                        '<div class="form-group">'+
                        '<input type="file" name="documents[]" id="documents'+cnt+'"  class="form-control " placeholder="" value=""  >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-12">'+
                        '<label for="firstname" class="control-label">Notes</label>'+
                        '<div class="form-group">'+
                            '<input type="text" name="notes[]" id="notes'+cnt+'"  class="form-control" placeholder="Notes" value=""  >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-12">'+
                        '<h4>Certification Date</h4>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                        '<label for="firstname" class="control-label">Certificate Duration</label>'+
                        '<div class="form-group">'+
                            '<input type="text" name="certificate_duration[]" id="certificate_duration'+cnt+'"  class="form-control" placeholder="Certificate Duration" value=""  >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                        '<label for="firstname" class="control-label">Issue Date </label>'+
                        '<div class="form-group">'+
                            '<input type="text" maxlength="100" name="issue_date[]" id="issue_date'+cnt+'"  class="form-control" placeholder="mm/dd/yyyy" value="">'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                        '<label for="firstname" class="control-label">Expiration Date </label>'+
                        '<div class="form-group">'+
                            '<input type="text" maxlength="100" name="expiry_date[]" id="expiry_date'+cnt+'"  class="form-control" placeholder="mm/dd/yyyy" value="">'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                        '<label for="firstname" class="control-label">Recertification Date </label>'+
                        '<div class="form-group">'+
                            '<input type="text" maxlength="100" name="recertification_date[]" id="recertification_date'+cnt+'"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="">'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-12">'+
                        '<h4>Maintenance of Certification</h4>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                        '<label for="firstname" class="control-label">MOC/OCC Status</label>'+
                        '<div class="form-group">'+
                            '<select name="moc_status[]" class="form-control select2" id="moc_status'+cnt+'">'+
                                '<option value="">Select Option</option>'+
                            '</select>'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                        '<label for="firstname" class="control-label">Meeting MOC/OCC</label>'+
                        '<div class="form-group">'+
                            '<select name="meeting_moc[]" class="form-control select2" id="meeting_moc'+cnt+'">'+
                                '<option value="">Select Option</option>'+
                            '</select>'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6">'
                        '<label for="firstname" class="control-label">MOC/OCC Verification Date </label>'+
                        '<div class="form-group">'+
                            '<input type="text" maxlength="100" name="moc_verification_date[]" id="moc_verification_date'+cnt+'"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="">'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                        '<label for="firstname" class="control-label">Annual Reverification Date </label>'+
                        '<div class="form-group">'+
                            '<input type="text" maxlength="100" name="annual_reverification_date[]" id="annual_revertification_date'+cnt+'"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="">'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            $("#content_wrapper_more_items").append(item_html);
            $("#total_items").val(cnt);    
            $("#board_name"+cnt).select2();
            $('#issue_date'+cnt).datepicker({
                format: 'mm/dd/yyyy',
                autoclose:!0,
                showOtherMonths: true,
                selectOtherMonths: true
            });
            $('#expiry_date'+cnt).datepicker({
                format: 'mm/dd/yyyy',
                autoclose:!0,
                showOtherMonths: true,
                selectOtherMonths: true
            });

            $('#recertification_date'+cnt).datepicker({
                format: 'mm/dd/yyyy',
                autoclose:!0,
                showOtherMonths: true,
                selectOtherMonths: true
            });
            $('#moc_verification_date'+cnt).datepicker({
                format: 'mm/dd/yyyy',
                autoclose:!0,
                showOtherMonths: true,
                selectOtherMonths: true
            });
            $('#annual_revertification_date'+cnt).datepicker({
                format: 'mm/dd/yyyy',
                autoclose:!0,
                showOtherMonths: true,
                selectOtherMonths: true
            });
            
            
            $('#documents'+cnt).fileuploader({
                addMore: true,
                limit: 5,
                maxSize: 5,
                extensions: ['jpg', 'jpeg', 'png', 'gif','pdf','doc','txt','docx'] // allowed extensions or types {Array}
        
              });

        var specialty_ele='#specialty'+cnt; 
        // alert(institute_type_ele);
        if($(specialty_ele).length)
        {
            InitSpecialtyDropDown(specialty_ele);
        }

        var focus_ele='#focus'+cnt; 
        // alert(institute_type_ele);
        if($(focus_ele).length)
        {
            InitFocusDropDown(focus_ele);
        }

        var status_ele='#status'+cnt; 
        // alert(institute_type_ele);
        if($(status_ele).length)
        {
            InitStatusDropDown(status_ele);
        }

        var moc_status_ele='#moc_status'+cnt; 
        // alert(institute_type_ele);
        if($(moc_status_ele).length)
        {
            InitMOCOCCDropDown(moc_status_ele);
        }

        var meeting_moc_ele='#meeting_moc'+cnt; 
        // alert(institute_type_ele);
        if($(meeting_moc_ele).length)
        {
            InitMeetingMOCDropDown(meeting_moc_ele);
        }

        
        
        
    }
    if(type=="practice_employer")
    {
        item_html=''+
                '<div class="row col-sm-12" id="content_item'+cnt+'">'+
                    '<div class="col-sm-8 col-md-9"><h5><u>Practice / Employer '+cnt+'</u></h5></div><div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>'+
                    '<div class="col-sm-6">'+
                        '<label for="firstname" class="control-label">Practice /Employer /Facility Type </label>'+
                        '<div class="form-group">'+
                            '<select name="practice_type[]" class="form-control" id="practice_type'+cnt+'">'+
                                '<option value="">Select Type</option>'+
                            '</select>'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                        '<label for="firstname" class="control-label">Practice/Employer</label>'+
                        '<div class="form-group">'+
                            '<input type="text" name="practice_name[]" id="practice_name'+cnt+'"  class="form-control datepicker" placeholder="Practice/Employer" value=""  >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                        '<label for="firstname" class="control-label">Start Date </label>'+
                        '<div class="form-group">'+
                            '<input type="text" maxlength="100" name="start_date[]" id="start_date'+cnt+'"  class="form-control" placeholder="mm/dd/yyyy" value="">'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                        '<label for="firstname" class="control-label">End Date </label>'+
                        '<div class="form-group">'+
                            '<input type="text" maxlength="100" name="end_date[]" id="end_date'+cnt+'"  class="form-control" placeholder="mm/dd/yyyy" value="">'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-12"><label for="firstname" class="control-label">Practice / Employer Address </label></div>'+
                    '<div class="col-sm-6">'+
                        '<div class="form-group">'+
                            '<input type="text" maxlength="150" name="address_line_1[]" id="address_line_1-'+cnt+'" class="form-control" placeholder="Address Line 1" value="">'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                        '<div class="form-group">'+
                            '<input type="text" maxlength="100" name="address_line_2[]" id="address_line_2-'+cnt+'"  class="form-control" placeholder="Address Line 2" value="" >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-3">'+
                        '<div class="form-group">'+
                            '<input type="text" maxlength="100" name="address_city[]" id="address_city'+cnt+'"  class="form-control" placeholder="City" value="" >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    // '<div class="col-sm-6 col-md-3">'+
                    //     '<div class="form-group">'+
                    //         '<input type="text" maxlength="100" name="address_state[]" id="address_state'+cnt+'"  class="form-control" placeholder="State" value="" >'+
                    //         '<span class="help" id="msg2"></span>'+
                    //     '</div>'+
                    // '</div>'+
                    '<div class="col-sm-6 col-md-3">'+
                        '<div class="form-group">'+
                            '<select data-placeholder="Select State" name="address_state[]" class="form-control  state_dropdown" id="address_state'+cnt+'">'+
                            '</select>'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-3">'+
                        '<div class="form-group">'+
                            '<input type="text" maxlength="100" name="address_zipcode[]" id="address_zipcode'+cnt+'"  class="form-control" placeholder="Zip Code" value="" >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-3">'+
                        '<div class="form-group">'+
                            '<select name="address_country[]" class="form-control" id="address_country'+cnt+'">'+
                                '<option value="">Select Country</option>'+
                            '</select>'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-12">'+
                        '<label for="firstname" class="control-label">Reason for departure (If Not Current)</label>'+
                        '<div class="form-group">'+
                            '<input type="text" name="reason_deaprture[]" id="reason_deaprture'+cnt+'"  class="form-control datepicker" placeholder="Reason for departure" value=""  >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-12"><h5><u>HR Contact / Supervisor</u></h5></div>'+
                    '<div class="col-sm-12"><label for="firstname" class="control-label">Name </label></div>'+
                    '<div class="col-sm-6 col-md-4">'+                        
                        '<div class="form-group">'+
                            '<input type="text" maxlength="150" name="hr_title[]" id="hr_title'+cnt+'" class="form-control" placeholder="Title" value="">'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-4">'+
                        '<div class="form-group">'+
                            '<input type="text" maxlength="100" name="hr_contact_name[]" id="hr_contact_name'+cnt+'"  class="form-control" placeholder="Contact Name" value="" >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-4">'+
                        '<div class="form-group">'+
                            '<input type="text" maxlength="100" name="hr_contract_start_date[]" id="hr_contract_start_date'+cnt+'"  class="form-control " placeholder="Contract Start Date" value="" >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    
                    '<div class="col-sm-6 col-md-4">'+
                        '<div class="form-group">'+
                            '<input type="email" maxlength="100" name="hr_email[]" id="hr_email'+cnt+'"  class="form-control" placeholder="Email" value="" >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-6 col-md-4">'+
                        '<div class="form-group">'+
                            '<input type="tel" maxlength="100" name="hr_phone[]" id="hr_phone'+cnt+'"  class="form-control" placeholder="Phone" value="" >'+
                            '<span class="help" id="msg2"></span>'+
                        '</div>'+
                    '</div>'+
                '</div>';
                
        $("#content_wrapper_more_items").append(item_html);
        
        $("#total_items").val(cnt);        
        $('#hr_contract_start_date'+cnt).datepicker({
            format: 'mm/dd/yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
        });
        $('#start_date'+cnt).datepicker({
            format: 'mm/dd/yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
        });
        $('#end_date'+cnt).datepicker({
            format: 'mm/dd/yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
        });
        var country_ele='#address_country'+cnt; 
        if($(country_ele).length)
        {
            InitCountryDropDown(country_ele);
        }

        var practice_type_ele='#practice_type'+cnt; 
        // alert(institute_type_ele);
        if($(practice_type_ele).length)
        {
            InitPracticeTypeDropDown(practice_type_ele);
        }

        var state_ele='#address_state'+cnt; 
        if($(state_ele).length)
        {
            InitStateDropDown(state_ele);
        }
		
    }
    if(type=="hospital-facility")
    {
        item_html=''+
        '<div class="row col-sm-12" id="content_item'+cnt+'">'+
            '<div class="col-sm-8 col-md-9"><h5><u>Hospital Affiliation '+cnt+'</u></h5></div><div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>'+
                '<div class="col-sm-6 col-md-4">'+
                    '<label for="firstname" class="control-label">Hospital Affiliation</label>'+
                    '<div class="form-group">'+
                        '<input type="text" name="hospital_affiliation[]" id="hospital_affiliation'+cnt+'"  class="form-control" placeholder="Hospital Affiliation" value=""  >'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-md-4">'+
                    '<label for="firstname" class="control-label">Start Date </label>'+
                    '<div class="form-group">'+
                        '<input type="text" maxlength="100" name="start_date[]" id="start_date'+cnt+'"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="">'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-md-4">'+
                    '<label for="firstname" class="control-label">End Date </label>'+
                    '<div class="form-group">'+
                        '<input type="text" maxlength="100" name="end_date[]" id="end_date'+cnt+'"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="">'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-12"><label for="firstname" class="control-label">Hospital Affiliation Address </label></div>'+
                '<div class="col-sm-6">'+
                    '<div class="form-group">'+
                        '<input type="text" maxlength="150" name="address_line_1[]" id="address_line_1-'+cnt+'" class="form-control" placeholder="Address Line 1" value="">'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6">'+
                    '<div class="form-group">'+
                        '<input type="text" maxlength="100" name="address_line_2[]" id="address_line_2-'+cnt+'"  class="form-control" placeholder="Address Line 2" value="" >'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-md-3">'+
                    '<div class="form-group">'+
                        '<input type="text" maxlength="100" name="address_city[]" id="address_city'+cnt+'"  class="form-control" placeholder="City" value="" >'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                // '<div class="col-sm-6 col-md-3">'+
                //     '<div class="form-group">'+
                //         '<input type="text" maxlength="100" name="address_state[]" id="address_state'+cnt+'"  class="form-control" placeholder="State" value="" >'+
                //         '<span class="help" id="msg2"></span>'+
                //     '</div>'+
                // '</div>'+
                '<div class="col-sm-6 col-md-3">'+
                    '<div class="form-group">'+
                        '<select data-placeholder="Select State" name="address_state[]" class="form-control  state_dropdown" id="address_state'+cnt+'">'+
                        '</select>'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-md-3">'+
                    '<div class="form-group">'+
                        '<input type="text" maxlength="100" name="address_zipcode[]" id="address_zipcode'+cnt+'"  class="form-control" placeholder="Zip Code" value="" >'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-md-3">'+
                    '<div class="form-group">'+
                        '<select name="address_country[]" class="form-control" id="address_country'+cnt+'">'+
                            '<option value="">Select Country</option>'+
                        '</select>'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-md-4">'+
                    '<label for="firstname" class="control-label">Staff Category</label>'+
                    '<div class="form-group">'+
                        '<input type="text" name="staff_category[]" id="staff_category'+cnt+'"  class="form-control" placeholder="Staff Category" value=""  >'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-md-4">'+
                    '<div class="form-group">'+
                        '<input type="checkbox" style="margin-top: 20px;margin-left: 10px;" name="is_primary_affiliation['+(cnt-1)+']" id="is_primary_affiliation'+cnt+'"  class=""    >'+
                        '<label for="is_primary_affiliation'+cnt+'" class="control-label">Primary Affiliation</label>'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
                '<div class="col-sm-6 col-md-4">'+
                    '<div class="form-group">'+
                        '<input type="checkbox" style="margin-top: 20px;margin-left: 10px;" name="is_currently_affiliated['+(cnt-1)+']" id="is_currently_affiliated'+cnt+'"  class=""    >'+
                        '<label for="is_primary_affiliation'+cnt+'" class="control-label">Currently Affiliated?</label>'+
                        '<span class="help" id="msg2"></span>'+
                    '</div>'+
                '</div>'+
            '</div>';
        $("#content_wrapper_more_items").append(item_html);
        $("#total_items").val(cnt);
        $('#start_date'+cnt).datepicker({
            format: 'mm/dd/yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
        });
        $('#end_date'+cnt).datepicker({
            format: 'mm/dd/yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
        });
        var country_ele='#address_country'+cnt; 
        if($(country_ele).length)
        {
            InitCountryDropDown(country_ele);
        }

        var state_ele='#address_state'+cnt; 
        if($(state_ele).length)
        {
            InitStateDropDown(state_ele);
        }
    }

    if(type=="professional-reference")
    {
        item_html=''+
        '<div class="row col-sm-12" id="content_item'+cnt+'">'+                        
            '<div class="col-sm-8 col-md-9"><h5><u>Refrence '+cnt+'</u></h5></div><div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>'+
            '<div class="col-sm-12"><label for="firstname" class="control-label">Name </label></div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="150" name="title[]" id="title'+cnt+'" class="form-control" placeholder="Title" value="">'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="100" name="first_name[]" id="first_name'+cnt+'"  class="form-control" placeholder="First Name" value="" >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="100" name="last_name[]" id="last_name'+cnt+'"  class="form-control" placeholder="Last Name" value="" >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Company</label>'+
                '<div class="form-group">'+
                    '<input type="text" name="company_name[]" id="company_name'+cnt+'"  class="form-control datepicker" placeholder="Company" value=""  >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Email </label>'+
                '<div class="form-group">'+
                    '<input type="email" maxlength="100" name="email[]" id="email'+cnt+'"  class="form-control" placeholder="Email" value="" >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Phone </label>'+
                '<div class="form-group">'+
                    '<input type="tel" maxlength="100" name="phone[]" id="phone'+cnt+'"  class="form-control" placeholder="Phone" value="" >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-12"><label for="firstname" class="control-label">Home Address </label></div>'+
            '<div class="col-sm-6">'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="150" name="address_line_1[]" id="address_line_1-'+cnt+'" class="form-control" placeholder="Address Line 1" value="">'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6">'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="100" name="address_line_2[]" id="address_line_2-'+cnt+'"  class="form-control" placeholder="Address Line 2" value="" >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-3">'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="100" name="address_city[]" id="address_city'+cnt+'"  class="form-control" placeholder="City" value="" >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-3">'+
                '<div class="form-group">'+
                    '<select data-placeholder="Select State" name="address_state[]" class="form-control  state_dropdown" id="address_state'+cnt+'">'+
                    '</select>'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-3">'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="100" name="address_zipcode[]" id="address_zipcode'+cnt+'"  class="form-control" placeholder="Zip Code" value="" >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-3">'+
                '<div class="form-group">'+
                    '<select name="address_country[]" class="form-control country_dropdown" id="address_country'+cnt+'">'+
                        '<option value="">Select Country</option>'+
                    '</select>'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
        '</div>';
        $("#content_wrapper_more_items").append(item_html);
        $("#total_items").val(cnt);
        
        var country_ele='#address_country'+cnt; 
        if($(country_ele).length)
        {
            InitCountryDropDown(country_ele);
        }
        var state_ele='#address_state'+cnt; 
        if($(state_ele).length)
        {
            InitStateDropDown(state_ele);
        }
    }

    if(type=="licensure")
    {
        var license_status_list_enc=$("#license_status_list").val();
        var license_status_list_json=atob(license_status_list_enc);
        var license_status_list_arr=JSON.parse(license_status_list_json);
        // console.log(license_status_list_arr);
        var license_status_list_option='';
        for (csic=0; csic < license_status_list_arr.length; csic++) 
        { 
            var id=csic+1;
            license_status_list_option+='<option value="'+id+'">'+license_status_list_arr[csic]+'</option>';
            // console.log(license_status_list_option);

        }
        // console.log(license_status_list_option);

        item_html=''+
        '<div class="row col-sm-12" id="content_item'+cnt+'">'+
        '<div class="col-sm-8 col-md-9"><h5><u>Licensure '+cnt+'</u></h5></div><div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Licence Type </label>'+
                '<div class="form-group">'+
                    '<select name="license_type[]" class="form-control" id="license_type'+cnt+'">'+
                        '<option value="">Select Type</option>'+
                        '<option value="State Licenses">State Licenses</option>'+
                        '<option value="DEA Licenses">DEA Licenses</option>'+
                        '<option value="State Controlled Substance Licenses">State Controlled Substance Licenses</option>'+
                    '</select>'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">State </label>'+
                '<div class="form-group">'+
                    '<select name="license_state[]" class="form-control" id="license_state'+cnt+'">'+
                        '<option value="">Select State</option>'+
                    '</select>'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Licence Number</label>'+
                '<div class="form-group">'+
                    '<input type="text" name="license_no[]" id="license_no'+cnt+'"  class="form-control datepicker" placeholder="License Number" value=""  >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Issue Date </label>'+
                '<div class="form-group">'+
                    '<input type="text"  name="issue_date[]" id="issue_date'+cnt+'"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="">'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Expiry Date </label>'+
                '<div class="form-group">'+
                    '<input type="text" maxlength="100" name="expiry_date[]" id="expiry_date'+cnt+'"  class="form-control datepicker" placeholder="mm/dd/yyyy" value="">'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Primary </label>'+
                '<div class="form-group">'+
                    '<select name="primary_license[]" class="form-control" id="primary_license'+cnt+'">'+
                        '<option value="Yes">Yes</option>'+
                        '<option value="No">No</option>'+
                    '</select>'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Compact </label>'+
                '<div class="form-group">'+
                    '<select name="compact_license[]" class="form-control" id="compact_license'+cnt+'">'+
                        '<option value="Yes">Yes</option>'+
                        '<option value="No">No</option>'+
                    '</select>'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Status </label>'+
                '<div class="form-group">'+
                    '<select name="license_status[]" class="form-control select2" id="license_status'+cnt+'">'+
                        '<option value="">select status</option>'+
                        license_status_list_option+
                    '</select>'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
        '</div>';
        $("#content_wrapper_more_items").append(item_html);
        $("#total_items").val(cnt);
        $('#issue_date'+cnt).datepicker({
            format: 'mm/dd/yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
        });
        $('#expiry_date'+cnt).datepicker({
            format: 'mm/dd/yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
        });
        var state_ele='#license_state'+cnt; 
        if($(state_ele).length)
        {
            InitStateDropDown(state_ele);
        }
        $("#license_type"+cnt).select2();
        $("#license_status"+cnt).select2();
    }

    if(type=="state-board")
    {
        item_html=''+
        '<div class="row col-sm-12" id="content_item'+cnt+'">'+      
            '<div class="col-sm-8 col-md-9"><h5><u>State Board '+cnt+'</u></h5></div><div class="col-sm-4 col-md-3 text-right"><button type="button" onclick="RemoveItem(this);" style="cursor:pointer;" class="btn btn-sm btn-danger">X</button></div>'+  
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Website </label>'+
                '<div class="form-group">'+
                    // '<input type="text" name="website[]" id="website'+cnt+'"  class="form-control" placeholder="Website" value=""  >'+
                    '<select name="website[]" id="website'+cnt+'" class="form-control" >'+
                        '<option value="AMA">AMA</option>'+
                    '</select>'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Username</label>'+
                '<div class="form-group">'+
                    '<input type="text" name="user_name[]" id="user_name'+cnt+'"  class="form-control" placeholder="Username" value=""  >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6 col-md-4">'+
                '<label for="firstname" class="control-label">Password</label>'+
                '<div class="form-group">'+
                    '<input type="password" name="password[]" id="password'+cnt+'"  class="form-control" placeholder="Password" value=""  >'+
                    '<span class="help" id="msg2"></span>'+
                '</div>'+
            '</div>'+
        '</div>';
        $("#content_wrapper_more_items").append(item_html);
        $("#total_items").val(cnt);
        
    }
}

function RemoveItem(e)
{
    $(e).parent().parent().remove();
}