// global settings
// -----------------------------------------------------------------------------
CalendarGlobal = function (){};   
CalendarGlobal._SETTINGS = {};
CalendarGlobal._SETTINGS["description_max_length"] = 1024;
CalendarGlobal._SETTINGS["direction"] = 'ltr';
CalendarGlobal._SETTINGS["description_required"] = false;
// -----------------------------------------------------------------------------

function __calSkipToAnchor(u_prefix){
   var unique_prefix = (u_prefix == null) ? '' : u_prefix;
   var currentHref = window.location.href;
   window.location.href = currentHref.substr(0, currentHref.lastIndexOf('#')) + '#' + unique_prefix + 'top';
}

function __JumpTodayDate(){
   var jump_day   = GL_jump_day;
   var jump_month = GL_jump_month;
   var jump_year  = GL_jump_year;
   var view_type  = (jQuery("#view_type")) ? jQuery("#view_type").val() : GL_view_type;

   __doPostBack('view', view_type, jump_year, jump_month, jump_day);
}

function __JumpToDate(){
   __doPostBack('view', jQuery("#view_type").val(), jQuery("#jump_year").val(), jQuery("#jump_month").val(), jQuery("#jump_day").val());
}

function __EventsSort(sort_by, sort_direction, sort_page){
   jQuery("#hid_sort_by").val((sort_by != null) ? sort_by : '');
   jQuery("#hid_sort_direction").val((sort_direction != null) ? sort_direction : '');
   __doPostBack('view', null, null, null, null, 'events_management', null, sort_page);      
}

function __CategoriesSort(sort_by, sort_direction, sort_page){
   jQuery("#hid_sort_by").val((sort_by != null) ? sort_by : '');
   jQuery("#hid_sort_direction").val((sort_direction != null) ? sort_direction : '');
   __doPostBack('view', null, null, null, null, 'categories_management', null, sort_page);      
}

function __LocationsSort(sort_by, sort_direction, sort_page){
   jQuery("#hid_sort_by").val((sort_by != null) ? sort_by : '');
   jQuery("#hid_sort_direction").val((sort_direction != null) ? sort_direction : '');
   __doPostBack('view', null, null, null, null, 'locations_management', null, sort_page);      
}

function __UsersSort(sort_by, sort_direction, sort_page){
   jQuery("#hid_sort_by").val((sort_by != null) ? sort_by : '');
   jQuery("#hid_sort_direction").val((sort_direction != null) ? sort_direction : '');
   __doPostBack('view', null, null, null, null, 'users_management', null, sort_page);      
}

function __doPostBack(action, view_type, year, month, day, event_action, event_id, page, chart_type, category_id, user_id, event_user_id, location_id){			      
   jQuery("#hid_event_action").val((event_action != null) ? event_action : '');
   jQuery("#hid_event_id").val((event_id != null) ? event_id : '');      
   jQuery("#hid_action").val((action != null) ? action : 'view');
   jQuery("#hid_view_type").val((view_type != null) ? view_type : 'monthly');
   jQuery("#hid_year").val((year != null) ? year : GL_today_year);
   jQuery("#hid_month").val((month != null) ? month : GL_today_mon);
   jQuery("#hid_day").val((day != null) ? day : GL_today_mday);
   jQuery("#hid_page").val(page);
   jQuery("#hid_chart_type").val(chart_type);
   jQuery("#hid_category_id").val(category_id);
   jQuery("#hid_location_id").val(location_id);
   jQuery("#hid_user_id").val(user_id);
   jQuery("#hid_event_user_id").val(event_user_id);
   
   jQuery("#frmCalendar").submit();
}

function __doPostBackSmall(action, view_type, year, month, day, form_action){
   jQuery("#frmCalendar").attr("action", form_action); 
   __doPostBack(action, view_type, year, month, day);      
}

function __doPostBackWith(event_name, eid, euid){
   var jump_day    = (jQuery("#jump_day")) ? jQuery("#jump_day").val() : '';
   var jump_month  = (jQuery("#jump_month")) ? jQuery("#jump_month").val() : '';
   var jump_year   = (jQuery("#jump_year")) ? jQuery("#jump_year").val() : '';
   var view_type   = (jQuery("#view_type")) ? jQuery("#view_type").val() : '';
   __doPostBack('view', view_type, jump_year, jump_month, jump_day, event_name, eid, null, null, null, null, euid);
}

function __HideEventForm(el){
   jQuery("#"+el+"_lnkClose").attr("style", "display:none");
   jQuery("#"+el).animate({
       height: 'toggle',
       opacity: -0.25
     }, 450, function() {
      // Animation complete.
   });      
}

function __ShowEventForm(el, form_type){
   var local_x = 200;
   var local_y = 100;
   var window_x = jQuery(window).width();
   var window_y = jQuery(window).height();
   var div_width = 370;
   var div_height = 250;
   var form_type_ = (form_type != null) ? form_type : "add";
   
   if(form_type_ == "day"){
      //old - local_x = (jQuery(window).width() - div_width)/2 + 15;
      if(CalendarGlobal._SETTINGS["direction"] == 'rtl'){
         local_x = jQuery("#calendar_wrapper").position().left + 15;
      }else{
         local_x = jQuery("#calendar_wrapper").position().left + jQuery("#calendar_wrapper").width() - 398;         
      }
      local_y = 130 + ((__GetBrowser() == 'chrome') ? 5 : 0);
   }else{
      // move div at the right from the click point
      if(jQuery("#"+el).position().left <= click_x){
         local_x = click_x + 12;
         local_y = click_y - 10;
      }else{
         local_x = jQuery("#"+el).position().left;
         local_y = jQuery("#"+el).position().top;
      }         
      // move left if right border was touched
      if((window_x - local_x) < (div_width + 10)){
         local_x = local_x - (div_width + 70);
         // don't move if difference is too small
         if(Math.abs(local_x - jQuery("#"+el).position().left) < 10){
            local_x = jQuery("#"+el).position().left;
         }         
         local_y = (window_y - div_height) / 2;
      }   
      // move top if bottom border was touched
      if((window_y - local_y) < (div_height + 10)){
         local_y -= div_height;
      }         
   }

   jQuery("#"+el).css({ "opacity": 1.0, "left": local_x + "px", "top": local_y + "px" });
   if(jQuery("#"+el).is(":hidden")) jQuery("#"+el).show();
   jQuery("#divAddEvent_lnkClose").attr("style", "display:inline");
}   

function __CallAddEventForm(el, year, month, day, hour, allow_disabling, form_type)
{
   //close edit event form
   jQuery("#divEditEvent").attr("style", "display:none");
   
   __ShowEventForm(el, form_type);
   var event_from_year    = document.getElementById('event_from_year');
   var event_to_year 	 = document.getElementById('event_to_year');				
   var event_from_month   = document.getElementById('event_from_month');
   var event_to_month 	 = document.getElementById('event_to_month');				
   var event_from_day     = document.getElementById('event_from_day');
   var event_to_day 	     = document.getElementById('event_to_day');				
   var event_from_hour    = document.getElementById('event_from_hour');
   var event_to_hour 	 = document.getElementById('event_to_hour');
   var allow_disabling_ 	 = (allow_disabling != null) ? allow_disabling : false;
   
   for(i = 0; i < jQuery("#event_from_hour").attr('options').length; i++){
      if(allow_disabling_){
         if(event_from_hour.options[i].value < hour){
            event_from_hour.options[i].disabled = true;
         }else{
            event_from_hour.options[i].disabled = false;
         }            
      }
      if(event_from_hour.options[i].value == hour){
         event_from_hour.options[i].disabled = false;
         event_from_hour.options[i].selected = true;
         event_to_hour.options[i+1].selected = true;
      }
   }

   for(i = 0; i < jQuery("#event_from_day").attr('options').length; i++){
      if(event_from_day.options[i].value == day){
         event_from_day.options[i].selected = true;
         event_to_day.options[i].selected = true;
      }
   }

   for(i = 0; i < jQuery("#event_from_month").attr('options').length; i++){
      if(event_from_month.options[i].value == month){
         event_from_month.options[i].selected = true;
         event_to_month.options[i].selected = true;
      }
   }
   
   for(i = 0; i < jQuery("#event_from_year").attr('options').length; i++){
      if(event_from_year.options[i].value == year){
         event_from_year.options[i].selected = true;
         event_to_year.options[i].selected = true;
      }
   }

   jQuery('#divAddEvent_msg').html("");
   jQuery('#event_name').val("");
   jQuery('#event_description').val("");
   jQuery('#sel_event_new').trigger('click');      
   
   if(!jQuery('#event_name').is(":disabled")) jQuery('#event_name').focus();
}

function __CallEditEventForm(el, cal_id, cat_allowed, loc_allowed, disable_all)
{
   //close add event form
   jQuery("#divAddEvent").attr("style", "display:none");   
   var disable_all_ = (disable_all != null) ? disable_all : 'true';
   
   var div_width = 370;
   var div_height = 250;

   //old - var local_x = (jQuery(window).width() - div_width)/2 + 15; 
   if(CalendarGlobal._SETTINGS["direction"] == 'rtl'){
      var local_x = jQuery("#calendar_wrapper").position().left + 15;
   }else{
      var local_x = jQuery("#calendar_wrapper").position().left + jQuery("#calendar_wrapper").width() - 398;
   }   
   var local_y = 130 + ((__GetBrowser() == 'chrome') ? 5 : 0);
   
   if(jQuery("#"+el).is(":hidden")){
      jQuery("#"+el).show();
      jQuery("#"+el).css({ "left": local_x + "px", "top": local_y + "px" });
   }
   jQuery("#"+el).css({ "opacity": 0.85 }); /* [#003-1] */
   jQuery("#divEditEvent_lnkClose").attr("style", "display:inline");
   jQuery.ajax({         
      url: GL_cal_dir+"ajax/handler.ajax.php",
      global: false,
      type: "POST",
      data: ({cid : cal_id, check_key : GL_installation_key, categories_allowed : cat_allowed, locations_allowed : loc_allowed }),
      dataType: "html",
      async: false,
      success: function(html){
         var obj = jQuery.parseJSON(html);
         
         jQuery("#"+el).css({ "opacity": 1.0 }); /* [#003-1] */      
         ///jQuery("#"+el).animate({ opacity: 1.0 }, "fast"); /* [#003-1] */
         
         // change delete link
         $('#divEditEvent_Delete').html("<a href=\"javascript:void('delete');\" onclick=\"__DeleteEvent("+cal_id+");\">"+Vocabulary._MSG["delete"]+"</a>");
      
         if(obj.status == "1"){
            var from_date_split = obj.from_date.split('-', 3);
            var from_year  = (from_date_split[0]);
            var from_month = (from_date_split[1]);
            var from_day   = (from_date_split[2]);
            var from_time_split = obj.from_time.split(':', 2);
            var from_hour   = (from_time_split[0]);
            var from_minute = (from_time_split[1]);
            
            var to_date_split = obj.to_date.split('-', 3);
            var to_year  = (to_date_split[0]);
            var to_month = (to_date_split[1]);
            var to_day   = (to_date_split[2]);
            var to_time_split = obj.to_time.split(':', 2);
            var to_hour   = (to_time_split[0]);
            var to_minute = (to_time_split[1]);
            
            //assign event ID for deleting button 
            jQuery('#divEditEvent').html(jQuery('#divEditEvent').html().replace("{h:val_id}", cal_id));
            
            if(obj.category_name == "n/d"){
               jQuery("#lbl_category_name").text("- "+Vocabulary._MSG["not_defined"]+" -");
               jQuery("#lbl_category_name").css('color', 'gray');
            }else{
               jQuery("#lbl_category_name").text(__decode_text(obj.category_name));
               jQuery("#lbl_category_name").css('color', 'black');
            }
            if(obj.location_name == "n/d"){
               jQuery("#lbl_location_name").text("- "+Vocabulary._MSG["not_defined"]+" -");
               jQuery("#lbl_location_name").css('color', 'gray');
            }else{
               jQuery("#lbl_location_name").text(__decode_text(obj.location_name));
               jQuery("#lbl_location_name").css('color', 'black');
            }
            
            jQuery("#event_name_edit").val(__decode_text(obj.name));
            jQuery("#event_description_edit").val(__decode_text(obj.description));
            //jQuery("#event_description_edit").attr('readonly', true);               
            jQuery("#event_unique_key").val(obj.unique_key);
            jQuery("#event_name_edit").attr('readonly', true);
            
            jQuery("#event_from_edit_year").removeAttr("selected"); 
            jQuery("#event_from_edit_month").removeAttr("selected"); 
            jQuery("#event_from_edit_day").removeAttr("selected"); 
            jQuery("#event_from_edit_hour").removeAttr("selected"); 
            jQuery("#event_from_edit_year option[value='"+from_year+"']").attr('selected',true);
            jQuery("#event_from_edit_month option[value='"+from_month+"']").attr('selected',true);
            jQuery("#event_from_edit_day option[value='"+from_day+"']").attr('selected',true);
            jQuery("#event_from_edit_hour option[value='"+from_hour+":"+from_minute+"']").attr('selected',true);

            jQuery("#event_to_edit_year").removeAttr("selected"); 
            jQuery("#event_to_edit_month").removeAttr("selected"); 
            jQuery("#event_to_edit_day").removeAttr("selected"); 
            jQuery("#event_to_edit_hour").removeAttr("selected"); 
            jQuery("#event_to_edit_year option[value='"+to_year+"']").attr('selected',true);
            jQuery("#event_to_edit_month option[value='"+to_month+"']").attr('selected',true);
            jQuery("#event_to_edit_day option[value='"+to_day+"']").attr('selected',true);
            jQuery("#event_to_edit_hour option[value='"+to_hour+":"+to_minute+"']").attr('selected',true);
            
            if(jQuery("#event_to_edit_hour option").size() > jQuery("#event_to_edit_hour").attr("selectedIndex")+1){
               jQuery("#event_to_edit_hour").attr("selectedIndex", jQuery("#event_to_edit_hour").attr("selectedIndex")+1);
            }

            if(disable_all_ == 'true'){
               jQuery("#event_description_edit").attr('readonly', true);
               jQuery("#event_from_edit_year").attr('disabled', true);
               jQuery("#event_from_edit_month").attr('disabled', true);
               jQuery("#event_from_edit_day").attr('disabled', true);
               jQuery("#event_from_edit_hour").attr('disabled', true);
               jQuery("#event_to_edit_year").attr('disabled', true);
               jQuery("#event_to_edit_month").attr('disabled', true);
               jQuery("#event_to_edit_day").attr('disabled', true);
               jQuery("#event_to_edit_hour").attr('disabled', true);
            }
         }else{
            jQuery("#divEditEvent_msg").html("<span class='msg_error'>Wrong parameters passed or connection error!</span>");
         }
      }
   });
}


/////////////////////////////////////////////////////////////////////////////   
// EVENTS

// Cancel event insertion
function __EventsCancel(){      
   __doPostBack('view', null, null, null, null, 'events_management');
   return true;
}

// Back to events management
function __EventsBack(event_name){
   var event_name_ = (event_name) ? event_name : 'events_management';      
   __doPostBackWith(event_name_);
   return true;
}

// Delete event 
function __EventsDelete(eid){			
   if(confirm(Vocabulary._MSG["alert_delete_event_occurrences"])){			
      __doPostBackWith('events_delete', eid);
      return true;
   }
   return false;
}

// Edit event
function __EventsEdit(eid){
   __doPostBackWith('events_edit', eid);
   return true;
}   

// View event details
function __EventsDetails(eid){
   __doPostBackWith('events_details', eid);
   return true;
}   

// Delete by range 
function __EventsDeleteByRange(){            
   var start_datetime  = jQuery('#event_from_year').val()+jQuery('#event_from_month').val()+jQuery('#event_from_day').val();
   var finish_datetime = jQuery('#event_to_year').val()+jQuery('#event_to_month').val()+jQuery('#event_to_day').val();

   if(start_datetime >= finish_datetime){
      jQuery('#divEventsDeleteByRange_msg').html("<span class='msg_error'>"+Vocabulary._MSG["alert_start_date_earlier"]+"</span>");
      return false;
   }

   __doPostBackWith('events_delete_by_range');
   return true;
}

// Events Users management
function __EventsUsersManagement(eid){
   __doPostBackWith('events_users_management', eid);
   return true;      
}  

// Unassign user from event
function __EventsUserDelete(eid, euid){
   if(confirm(Vocabulary._MSG["alert_unassign_user"])){			
      __doPostBackWith("events_users_delete", eid, euid);
   }      
   return true;      
}  

// Update event
function __EventsUpdate(eid){
   var event_name = (jQuery('#event_name')) ? trim(jQuery('#event_name').val()) : "";
   var event_description = (jQuery('#event_description')) ? trim(jQuery('#event_description').val()) : "";

   if(document.getElementById('wysiwyg'+'event_description')){
      WYSIWYG.updateTextArea('event_description');
      event_description = trim(jQuery('#event_description').val());
   }      

   if(event_name == ''){
      jQuery('#event_name').focus();
      jQuery('#divEventsEdit_msg').html("<span class='msg_error'>"+Vocabulary._MSG["err_event_name_empty"]+"</span>");
      return false;
   }else if(CalendarGlobal._SETTINGS["description_required"] && event_description == ''){
      if(document.getElementById('wysiwyg'+'event_description')){
         WYSIWYG.getEditorWindow('event_description').focus();
      }else{
         jQuery('#event_description').focus();
      }
      jQuery('#divEventsEdit_msg').html("<span class='msg_error'>"+Vocabulary._MSG["err_event_descr_empty"]+"</span>");
      return false;
   }else if(event_description.length > CalendarGlobal._SETTINGS["description_max_length"]){
      if(document.getElementById('wysiwyg'+'event_description')){
         WYSIWYG.getEditorWindow('event_description').focus();
      }else{
         jQuery('#event_description').focus();
      }
      jQuery('#divEventsEdit_msg').html("<span class='msg_error'>"+Vocabulary._MSG["msg_event_description_length"].replace("_MAX_LEN_", CalendarGlobal._SETTINGS["description_max_length"])+"</span>");
      return false;
   }

   __doPostBackWith('events_update', eid);
   return true;
}   

// Add single event
function __AddEvent(){
   var event_name = (jQuery('#event_name')) ? trim(jQuery('#event_name').val()) : "";
   var sel_event_name = (jQuery('#sel_event_name')) ? jQuery('#sel_event_name').val() : "";
   var event_description = (jQuery('#event_description')) ? jQuery('#event_description').val() : "";
   var sel_event = __getCheckedValue(document.forms['frmCalendar'].sel_event);

   var start_datetime  = jQuery('#event_from_year').val()+jQuery('#event_from_month').val()+jQuery('#event_from_day').val()+jQuery('#event_from_hour').val();
   var finish_datetime = jQuery('#event_to_year').val()+jQuery('#event_to_month').val()+jQuery('#event_to_day').val()+jQuery('#event_to_hour').val();
   
   if(sel_event == 'new' && trim(event_name) == ''){
      jQuery('#event_name').focus();
      jQuery('#divAddEvent_msg').html("<span class='msg_error'>"+Vocabulary._MSG["msg_enter_event_name"]+"</span>");
      return false;
   }else if(sel_event == 'new'){
      if(CalendarGlobal._SETTINGS["description_required"] && trim(event_description) == ''){
         jQuery('#event_description').focus();
         jQuery('#divAddEvent_msg').html("<span class='msg_error'>"+Vocabulary._MSG["msg_enter_event_description"]+"</span>");
         return false;            
      }else if(event_description.length > CalendarGlobal._SETTINGS["description_max_length"]){
         jQuery('#event_description').focus();
         jQuery('#divAddEvent_msg').html("<span class='msg_error'>"+Vocabulary._MSG["msg_event_description_length"].replace("_MAX_LEN_", CalendarGlobal._SETTINGS["description_max_length"])+"</span>");
         return false;                        
      }else if(start_datetime >= finish_datetime){
         jQuery('#divAddEvent_msg').html("<span class='msg_error'>"+Vocabulary._MSG["alert_start_date_earlier"]+"</span>");
         return false;
      }
   }else if(sel_event == 'current' && sel_event_name == ''){
      jQuery('#divAddEvent_msg').html("<span class='msg_error'>"+Vocabulary._MSG["msg_event_not_selected"]+"</span>");
      return false;
   }else if(start_datetime >= finish_datetime){
      jQuery('#divAddEvent_msg').html("<span class='msg_error'>"+Vocabulary._MSG["alert_start_date_earlier"]+"</span>");
      return false;
   }
   
   __doPostBackWith('add');
   __HideEventForm('divAddEvent');
   return true;
}

// Add single event occurrence
function __UpdateEvent(){      
   var start_datetime  = jQuery('#event_from_edit_year').val()+jQuery('#event_from_edit_month').val()+jQuery('#event_from_edit_day').val()+jQuery('#event_from_edit_hour').val();
   var finish_datetime = jQuery('#event_to_edit_year').val()+jQuery('#event_to_edit_month').val()+jQuery('#event_to_edit_day').val()+jQuery('#event_to_edit_hour').val();
   var event_description_edit = jQuery('#event_description_edit').val();

   if(CalendarGlobal._SETTINGS["description_required"] && trim(event_description_edit) == ''){
      jQuery('#event_description_edit').focus();
      jQuery('#divEditEvent_msg').html("<span class='msg_error'>"+Vocabulary._MSG["err_event_descr_empty"]+"</span>");
      return false;         
   }else if(event_description_edit.length > CalendarGlobal._SETTINGS["description_max_length"]){
      jQuery('#event_description_edit').focus();
      jQuery('#divEditEvent_msg').html("<span class='msg_error'>"+Vocabulary._MSG["msg_event_description_length"].replace("_MAX_LEN_", CalendarGlobal._SETTINGS["description_max_length"])+"</span>");
      return false;
   }else if(start_datetime >= finish_datetime){
      jQuery('#divEditEvent_msg').html("<span class='msg_error'>"+Vocabulary._MSG["alert_start_date_earlier"]+"</span>");
      return false;
   }

   __doPostBackWith('update_event');
   __HideEventForm('divEditEvent');
   return true;      
}

function __DeleteEvent(eid){			
   if(confirm(Vocabulary._MSG["alert_delete_event"])){			
      __doPostBackWith('delete', eid);
   }
   return false;
}

function __EventSelectedDDL(sel_type, time_block){
   var val; 
   // add new event
   if(sel_type == 1){
      jQuery('#sel_category_name').show();
      jQuery('#sel_category_name').width('230px');
      jQuery('#sel_location_name').attr('disabled', false);
      jQuery('#sel_event_name').attr('selectedIndex', '0');
      jQuery('#sel_event_name').hide();
      jQuery('#event_name').attr('disabled', false);
      jQuery('#event_description').attr('disabled', false);
      // change dropdown boxes "To" according to the time block size
      val = jQuery('#sel_category_name').val();
   }else{
   // select event from existing
      jQuery('#sel_category_name').attr('selectedIndex', '0');
      jQuery('#sel_category_name').hide();
      jQuery('#sel_location_name').attr('selectedIndex', '0');
      jQuery('#sel_location_name').attr('disabled', true);
      jQuery('#sel_event_name').show();
      
      jQuery('#sel_event_current').attr('checked', true);
      jQuery('#event_name').val('');
      jQuery('#event_name').attr('disabled', true);
      jQuery('#event_description').val('');
      jQuery('#event_description').attr('disabled', true);
      // change dropdown boxes "To" according to the time block size
      val = jQuery('#sel_event_name').val();
   }
   jQuery('#divAddEvent_msg').html("");
   
   __CategoryOnChange(val, time_block, true);
}

// Add events 
function __EventsAdd(){
   var msg = "";

   var event_name = jQuery('#event_name').val();
   var event_description = jQuery('#event_description').val();
   var event_repeat_type = jQuery('#event_repeat_type').val();
   
   var event_insertion_subtype = document.getElementById('event_insertion_subtype');
   var event_insertion_type    = __getCheckedValue(document.forms['frmCalendar'].event_insertion_type);
   
   var start_datetime = "";
   var finish_datetime = "";
   if(event_insertion_subtype.value == "repeat"){
      start_datetime  = jQuery('#event_from_date_year').val()+jQuery('#event_from_date_month').val()+jQuery('#event_from_date_day').val()+jQuery('#event_from_time_hour').val().replace(":", "");
      finish_datetime = jQuery('#event_to_date_year').val()+jQuery('#event_to_date_month').val()+jQuery('#event_to_date_day').val()+jQuery('#event_to_time_hour').val().replace(":", "");
   }else{
      start_datetime  = jQuery('#event_from_year').val()+jQuery('#event_from_month').val()+jQuery('#event_from_day').val()+jQuery('#event_from_hour').val().replace(":", "");
      finish_datetime = jQuery('#event_to_year').val()+jQuery('#event_to_month').val()+jQuery('#event_to_day').val()+jQuery('#event_to_hour').val().replace(":", "");
   }

   if(document.getElementById('wysiwyg'+'event_description')){
      WYSIWYG.updateTextArea('event_description');
      event_description = trim(jQuery('#event_description').val());
   }      

   if(trim(event_name) == ''){
      jQuery('#event_name').focus();
      msg = Vocabulary._MSG["err_event_name_empty"];
   }else if(CalendarGlobal._SETTINGS["description_required"] && trim(event_description) == ''){         
      if(document.getElementById('wysiwyg'+'event_description')){
         WYSIWYG.getEditorWindow('event_description').focus();
      }else{
         jQuery('#event_description').focus();   
      }
      msg = Vocabulary._MSG["err_event_descr_empty"];         
   }else if(event_description.length > CalendarGlobal._SETTINGS["description_max_length"]){
      if(document.getElementById('wysiwyg'+'event_description')){
         WYSIWYG.getEditorWindow('event_description').focus();
      }else{
         jQuery('#event_description').focus();   
      }
      msg = Vocabulary._MSG["msg_event_description_length"].replace("_MAX_LEN_", CalendarGlobal._SETTINGS["description_max_length"]);         
   }else if(event_insertion_type == 2){
      // event_insertion_type == 2 - add occurrences
      if(start_datetime >= finish_datetime){
         msg = Vocabulary._MSG["alert_start_date_earlier"];
      }else if(event_repeat_type == "weekly" && event_insertion_subtype.value == "repeat" && !jQuery("#repeat_sun").is(":checked") && !jQuery("#repeat_mon").is(":checked") && !jQuery("#repeat_tue").is(":checked") && !jQuery("#repeat_wed").is(":checked") && !jQuery("#repeat_thu").is(":checked") && !jQuery("#repeat_fri").is(":checked") && !jQuery("#repeat_sat").is(":checked")){
         msg = Vocabulary._MSG["alert_no_week_day_selected"];
      }
   }

   if(msg != ""){
      jQuery('#divEventsAdd_msg').html("<span class='msg_error'>"+msg+"</span>");   
      return false;
   }
   
   __doPostBackWith('events_insert');
   return true;
}

// Assign user to event 
function __EventsAssignUser(eid){
   if(jQuery('#assigned_user_id').val() == ''){
      jQuery('#divEventUserAssign_msg').html("<span class='msg_error'>"+Vocabulary._MSG["alert_select_user"]+"</span>");
      return false;
   }
   __doPostBackWith('events_users_assign', eid);
   return true;
}

function __EventInsertionType(val){
   var event_insertion_type = __getCheckedValue(document.forms['frmCalendar'].event_insertion_type);
   var disabled_status = true;
   if(val == 1){
      // select add to list
      if(jQuery("#ea_wrapper").css("display") == "block") jQuery("#divEventsAdd_msg").html("");
      jQuery("#ea_wrapper").css("display", "none");
      disabled_status = true;
   }else{
      // select add occurences
      jQuery("#ea_wrapper").css("display", "block");
      disabled_status = false;
   }      
   jQuery("#event_from_hour").attr("disabled", disabled_status);
   jQuery("#event_from_day").attr("disabled", disabled_status);
   jQuery("#event_from_month").attr("disabled", disabled_status);
   jQuery("#event_from_year").attr("disabled", disabled_status);
   jQuery("#event_to_hour").attr("disabled", disabled_status);
   jQuery("#event_to_day").attr("disabled", disabled_status);
   jQuery("#event_to_month").attr("disabled", disabled_status);
   jQuery("#event_to_year").attr("disabled", disabled_status);
}

// Repeat type changer
function __RepeatTypeOnChange(val){
   //alert(val);
   if(val == 'weekly'){
      jQuery("#event_repeat_every_weeks").show();
      jQuery("#repeat_on_weekly").show();
      jQuery("#repeat_on_monthly").hide();
      jQuery("#event_repeat_every_months").hide();         
   }else{
      jQuery("#event_repeat_every_weeks").hide();
      jQuery("#repeat_on_weekly").hide();
      jQuery("#repeat_on_monthly").show();
      jQuery("#event_repeat_every_months").show();         
   }
}

// Category changer
function __CategoryChange(selected_category, view_type){
   jQuery('#hid_selected_category').val((selected_category != null) ? selected_category : '');
   
   __doPostBack('view', view_type, jQuery("#jump_year").val(), jQuery("#jump_month").val(), jQuery("#jump_day").val());      
}

// Change category
function __CategoryOnChange(val, time_block, force){
   var event_insertion_type = __getCheckedValue(document.forms['frmCalendar'].event_insertion_type);
   var force_ = (force != null) ? force : false;

   //  change time in time DDLs according to category duration    
   if(event_insertion_type == 2 || force_){
      if(val.indexOf('#') >= 0){
         var event_from_year   = document.getElementById('event_from_year');
         var event_from_month  = document.getElementById('event_from_month');
         var event_from_day    = document.getElementById('event_from_day');
         var event_from_hour   = document.getElementById('event_from_hour');            

         var event_to_year   = document.getElementById('event_to_year');
         var event_to_month  = document.getElementById('event_to_month');
         var event_to_day    = document.getElementById('event_to_day');
         var event_to_hour   = document.getElementById('event_to_hour');            
         
         var duration = val.split('#', 2);
         var steps = (duration[1]/time_block);            
         
         var from_hour_i = event_from_hour.selectedIndex;
         var from_day_i = event_from_day.selectedIndex;
         var from_month_i = event_from_month.selectedIndex;
         var from_year_i = event_from_year.selectedIndex;
         
         var hours_index=0;
         for(i=1;i<=steps;i++){
            if((event_to_hour.options[from_hour_i+i])) hours_index = steps - i;   
         }
         
         if(event_to_hour.options[from_hour_i+steps]){
            event_to_hour.options[from_hour_i+steps].selected = true;
            event_to_year.selectedIndex = from_year_i;
            event_to_month.selectedIndex = from_month_i;
            event_to_day.selectedIndex = from_day_i;               
         }else if(event_to_day.options[from_day_i+1]){
            event_to_day.options[from_day_i+1].selected = true;
            event_to_hour.selectedIndex = hours_index;
         }else if(event_to_month.options[from_month_i+1]){
            event_to_month.options[from_month_i+1].selected = true;
            event_to_day.selectedIndex = 0;
            event_to_hour.selectedIndex = hours_index;
         }else if(event_to_year.options[from_year_i+1]){
            event_to_year.options[from_year_i+1].selected = true;
            event_to_month.selectedIndex = 0;
            event_to_day.selectedIndex = 0;
            event_to_hour.selectedIndex = hours_index;
         }
      }
   }
   return true;
}


/////////////////////////////////////////////////////////////////////////////   
// USERS
// Cancel users insertion
function __UsersCancel(){      
   __doPostBack('view', null, null, null, null, 'users_management');
   return true;
}

// Back to users management
function __UsersBack(event_name){
   __doPostBack('view', null, null, null, null, 'users_management');
   return true;
}

// View user details
function __UsersDetails(uid){
   __doPostBack('view', null, null, null, null, 'users_details', '', '', '', '', uid);
   return true;
}

// Edit user 
function __UsersEdit(uid){
   __doPostBack('view', null, null, null, null, 'users_edit', '', '', '', '', uid);
   return true;
}   

// Add user 
function __UsersAdd(){
   if(trim(jQuery('#first_name').val()) == ''){
      jQuery('#first_name').focus();
      jQuery('#divUsersAdd_msg').html("<span class='msg_error'>"+Vocabulary._MSG["err_first_name_empty"]+"</span>");
      return false;
   }else if(trim(jQuery('#last_name').val()) == ''){
      jQuery('#last_name').focus();
      jQuery('#divUsersAdd_msg').html("<span class='msg_error'>"+Vocabulary._MSG["err_last_name_empty"]+"</span>");
      return false;
   //}else if(trim(jQuery('#email').val()) == ''){
   //   jQuery('#email').focus();
   //   jQuery('#divUsersAdd_msg').html("<span class='msg_error'>"+Vocabulary._MSG["err_email_empty"]+"</span>");
   //   return false;
   }else if(trim(jQuery('#email').val()) != '' && __IsEmail(jQuery('#email').val()) == ''){
      jQuery('#email').focus();
      jQuery('#divUsersAdd_msg').html("<span class='msg_error'>"+Vocabulary._MSG["err_email_wrong"]+"</span>");
      return false;
   }
   
   __doPostBackWith('users_insert');
   return true;
}   

// Update user
function __UsersUpdate(uid){
   if(trim(jQuery('#first_name').val()) == ''){
      jQuery('#first_name').focus();
      jQuery('#divUsersEdit_msg').html("<span class='msg_error'>"+Vocabulary._MSG["err_first_name_empty"]+"</span>");
      return false;
   }else if(trim(jQuery('#last_name').val()) == ''){
      jQuery('#last_name').focus();
      jQuery('#divUsersEdit_msg').html("<span class='msg_error'>"+Vocabulary._MSG["err_last_name_empty"]+"</span>");
      return false;
   //}else if(trim(jQuery('#email').val()) == ''){
   //   jQuery('#email').focus();
   //   jQuery('#divUsersEdit_msg').html("<span class='msg_error'>"+Vocabulary._MSG["err_email_empty"]+"</span>");
   //   return false;
   }else if(trim(jQuery('#email').val()) != '' && __IsEmail(jQuery('#email').val()) == ''){
      jQuery('#email').focus();
      jQuery('#divUsersEdit_msg').html("<span class='msg_error'>"+Vocabulary._MSG["err_email_wrong"]+"</span>");
      return false;
   }

   __doPostBack('view', null, null, null, null, 'users_update', '', '', '', '', uid);
   return true;
}   

// Delete user
function __UsersDelete(uid){
   if(confirm(Vocabulary._MSG["alert_delete_user"])){			     
      __doPostBack('view', null, null, null, null, 'users_delete', '', '', '', '', uid);
      return true;
   }
   return false;      
}


/////////////////////////////////////////////////////////////////////////////   
// CATEGORIES

// Cancel category insertion 
function __CategoriesCancel(){      
   __doPostBack('view', null, null, null, null, 'categories_management');
   return true;
}

// Back to categories management
function __CategoriesBack(){
   __doPostBack('view', null, null, null, null, 'categories_management');
   return true;
}

// Add new category
function __CategoriesAdd(){
   if(trim(jQuery("#category_name").val()) == ''){
      jQuery("#category_name").focus();         
      jQuery("#divCategoriesAdd_msg").html("<span class='msg_error'>"+Vocabulary._MSG["err_cat_name_empty"]+"</span>");
      return false;
   }else if(CalendarGlobal._SETTINGS["description_required"] && trim(jQuery("#category_description").val()) == ''){
      jQuery("#category_description").focus();
      jQuery("#divCategoriesAdd_msg").html("<span class='msg_error'>"+Vocabulary._MSG["err_cat_descr_empty"]+"</span>");
      return false;         
   }else if(trim(jQuery("#category_description").val()).length > CalendarGlobal._SETTINGS["description_max_length"]){
      jQuery("#category_description").focus();
      jQuery('#divCategoriesAdd_msg').html("<span class='msg_error'>"+Vocabulary._MSG["msg_cat_description_length"].replace("_MAX_LEN_", CalendarGlobal._SETTINGS["description_max_length"])+"</span>");
      return false;
   }
   
   __doPostBackWith('categories_insert');
   return true;
}

// Edit category details
function __CategoriesEdit(cid){
   __doPostBack('view', null, null, null, null, 'categories_edit', '', '', '', cid);
   return true;
}   

// Update category
function __CategoriesUpdate(cid){
   if(trim(jQuery("#category_name").val()) == ''){
      jQuery("#category_name").focus();
      jQuery("#divCategoriesEdit_msg").html("<span class='msg_error'>"+Vocabulary._MSG["err_cat_name_empty"]+"</span>");
      return false;
   }else if(CalendarGlobal._SETTINGS["description_required"] && trim(jQuery("#category_description").val()) == ''){
      jQuery("#category_description").focus();
      jQuery("#divCategoriesEdit_msg").html("<span class='msg_error'>"+Vocabulary._MSG["err_cat_descr_empty"]+"</span>");
      return false;
   }else if(trim(jQuery("#category_description").val()).length > CalendarGlobal._SETTINGS["description_max_length"]){
      jQuery("#category_description").focus();
      jQuery('#divCategoriesEdit_msg').html("<span class='msg_error'>"+Vocabulary._MSG["msg_cat_description_length"].replace("_MAX_LEN_", CalendarGlobal._SETTINGS["description_max_length"])+"</span>");
      return false;
   }

   __doPostBack('view', false, false, false, false, 'categories_update', '', '', '', cid);
   return true;
}   

// View category details
function __CategoriesDetails(cid){
   __doPostBack('view', null, null, null, null, 'categories_details', '', '', '', cid);
   return true;
}

// Delete category
function __CategoriesDelete(cid, alert_type){
   var alert_msg = (alert_type == '1') ? Vocabulary._MSG["alert_delete_category_and_events"] : Vocabulary._MSG["alert_delete_category"];
   if(confirm(alert_msg)){			     
      __doPostBack('view', null, null, null, null, 'categories_delete', '', '', '', cid);
      return true;
   }
   return false;      
}

// Change color
function __ChangeColor(el, color){
   if(jQuery("#"+el).length) jQuery("#"+el).css("backgroundColor", color);
   return true;
}

/////////////////////////////////////////////////////////////////////////////   
// LOCATIONS

// Cancel category insertion
function __LocationsCancel(){      
   __doPostBack('view', null, null, null, null, 'locations_management');
   return true;
}

// Back to locations management
function __LocationsBack(){
   __doPostBack('view', null, null, null, null, 'locations_management');
   return true;
}

// Add new location
function __LocationsAdd(){
   if(trim(jQuery("#location_name").val()) == ''){
      jQuery("#location_name").focus();         
      jQuery("#divLocationsAdd_msg").html("<span class='msg_error'>"+Vocabulary._MSG["err_loc_name_empty"]+"</span>");
      return false;
   }else if(trim(jQuery("#location_description").val()).length > CalendarGlobal._SETTINGS["description_max_length"]){
      jQuery("#location_description").focus();
      jQuery('#divLocationsAdd_msg').html("<span class='msg_error'>"+Vocabulary._MSG["msg_loc_description_length"].replace("_MAX_LEN_", CalendarGlobal._SETTINGS["description_max_length"])+"</span>");
      return false;
   }
   
   __doPostBackWith('locations_insert');
   return true;
}

// Edit location details
function __LocationsEdit(lid){
   __doPostBack('view', null, null, null, null, 'locations_edit', '', '', '', '', '', '', lid);
   return true;
}   

// Update location
function __LocationsUpdate(lid){
   if(trim(jQuery("#location_name").val()) == ''){
      jQuery("#location_name").focus();
      jQuery("#divLocationsEdit_msg").html("<span class='msg_error'>"+Vocabulary._MSG["err_loc_name_empty"]+"</span>");
      return false;
   }else if(trim(jQuery("#location_description").val()).length > CalendarGlobal._SETTINGS["description_max_length"]){
      jQuery("#location_description").focus();
      jQuery('#divLocationsEdit_msg').html("<span class='msg_error'>"+Vocabulary._MSG["msg_loc_description_length"].replace("_MAX_LEN_", CalendarGlobal._SETTINGS["description_max_length"])+"</span>");
      return false;
   }

   __doPostBack('view', null, null, null, null, 'locations_update', '', '', '', '', '', '', lid);
   return true;
}   

// View location details
function __LocationsDetails(lid){
   __doPostBack('view', null, null, null, null, 'locations_details', '', '', '', '', '', '', lid);
   return true;
}

// Delete location
function __LocationsDelete(lid){
   var alert_msg = Vocabulary._MSG["alert_delete_location"];
   if(confirm(alert_msg)){			     
      __doPostBack('view', null, null, null, null, 'locations_delete', '', '', '', '', '', '', lid);
      return true;
   }
   return false;      
}

// Location changer
function __LocationChange(selected_location, view_type){
   jQuery('#hid_selected_location').val((selected_location != null) ? selected_location : '');
   
   __doPostBack('view', view_type, jQuery("#jump_year").val(), jQuery("#jump_month").val(), jQuery("#jump_day").val());      
}


/////////////////////////////////////////////////////////////////////////////   
// EXPORT   
// Export events
function __EventsExport(){
   var start_datetime  = jQuery('#event_from_year').val()+jQuery('#event_from_month').val()+jQuery('#event_from_day').val();
   var finish_datetime = jQuery('#event_to_year').val()+jQuery('#event_to_month').val()+jQuery('#event_to_day').val();

   if(start_datetime >= finish_datetime){
      jQuery('.message_box_success').hide('fast');
      jQuery('.message_box_error').hide('fast');
      jQuery('#divEventsExport_msg').html("<span class='msg_error'>"+Vocabulary._MSG["alert_start_date_earlier"]+"</span>");
      return false;
   }

   __doPostBackWith('events_exporting_execute');
   return true;
}


/////////////////////////////////////////////////////////////////////////////
// AUXILIARY   
// returns checked value in radio buttons 
function __getCheckedValue(el) {
   if(!el) return "";
   var radioLength = el.length;
   if(radioLength == undefined)
      if(el.checked) return el.value;
      else return "";
   for(var i = 0; i < radioLength; i++) {
      if(el[i].checked) return el[i].value;
   }
   return "";
}

// refill days in days dropdown box
function __refillDaysInMonth(type){
   var years_dll = document.getElementById(type+'year');
   var months_dll = document.getElementById(type+'month');
   var days_dll = document.getElementById(type+'day');
   var selected_day = document.getElementById(type+'day').selectedIndex;
   var day_in_month = __daysInMonth(months_dll.value-1, years_dll.value);
   
   //alert(selected_day);

   var option;
   var day_value;
   var ind = 0;
   if(selected_day > (day_in_month-1)) selected_day = (day_in_month-1);
   
   __cleanDDL(days_dll);
   for(i = 1; i <= day_in_month; i++) {
      option = new Option;
      ind = i - 1;
      
      day_value =  (i < 10) ? '0'+i : i;
      option.text = day_value;
      option.value = day_value;
      days_dll.options[ind] = option;
      if((ind) == selected_day){
         days_dll.options[ind].selected = true;
      }
   }      
}

function __daysInMonth(month, year){
   return 32 - new Date(year, month, 32).getDate();
}

function __cleanDDL(obj){
   var options_length = obj.options.length;
   for (i=0; i<options_length; i++) {
      obj.remove(0);
   }
   obj.options.length = 0;
}

function __SetFocus(el){
   if(!jQuery("#"+el).is(":disabled")) jQuery("#"+el).focus();
}

function __toggleCellScroll(el){
   if(document.getElementById("divDayEventContainer"+el)){
      if(document.getElementById("divDayEventContainer"+el).style.overflowY == "scroll"){
         document.getElementById("divDayEventContainer"+el).style.overflowY = "hidden";
         document.getElementById("dayEventLinkShow"+el).style.display = "";
         document.getElementById("dayEventLinkCollapse"+el).style.display = "none";
      }else{
         document.getElementById("divDayEventContainer"+el).style.overflowY = "scroll";
         document.getElementById("dayEventLinkShow"+el).style.display = "none";
         document.getElementById("dayEventLinkCollapse"+el).style.display = "";
      }
   }
}

function __switchElements(id1, id2, num, lnk_id1, lnk_id2, store_id, store_val){
   el1 = (document.getElementById(id1)) ? document.getElementById(id1) : null;
   el2 = (document.getElementById(id2)) ? document.getElementById(id2) : null;
   lnk1 = (document.getElementById(lnk_id1)) ? document.getElementById(lnk_id1) : null;
   lnk2 = (document.getElementById(lnk_id2)) ? document.getElementById(lnk_id2) : null;
   store_el = (document.getElementById(store_id)) ? document.getElementById(store_id) : null;
   
   if(el1 && el2){
      if(num == "1"){
         el1.style.display = "";
         el2.style.display = "none";
         if(lnk1) lnk1.style.fontWeight = "bold";
         if(lnk2) lnk2.style.fontWeight = "normal";
      }else{
         el1.style.display = "none";
         el2.style.display = "";
         if(lnk1) lnk1.style.fontWeight = "normal";
         if(lnk2) lnk2.style.fontWeight = "bold";
      }         
   }
   if(store_el) store_el.value = store_val;
}

function trim(str, chars) {
   return ltrim(rtrim(str, chars), chars);
}
 
function ltrim(str, chars) {
   chars = chars || "\\s";
   return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
 
function rtrim(str, chars) {
   chars = chars || "\\s";
   return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}

function __IsEmail(str){
   var email_pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/;  
   return email_pattern.test(str);  
}

function __decode_text(str){
   str = str.replace(/&#92;&#34;/g, '\\"');
   str = str.replace(/&#92;&#39;/g, "\\'");
   str = str.replace(/&#39;/g, "'");   
   str = str.replace(/&#34;/g, '"');
   str = str.replace(/&#92;/g, '\\');
   return str;  
}

function __StopPropagation(e){
   if(window.event){
      e.cancelBubble = true; // IE
   }else{
      e.stopPropagation(); // others
   }
}

function __ToggleLinks(link_el, text1, text2, container_el){
   if(jQuery('#'+link_el).text() == text1) jQuery('#'+link_el).text(text2);
   else jQuery('#'+link_el).text(text1);
   jQuery('#'+container_el).toggle();
}

function __SetCookie(name, value, days){
   if(days){
      var date = new Date();
      date.setTime(date.getTime()+(days*24*60*60*1000));
      var expires = '; expires='+date.toGMTString();
   }
   else var expires = '';
   document.cookie = name+'='+value+expires+'; path=/';
}

function __RowOnMouseOver(el){
   oldColor=el.style.backgroundColor;
   el.style.backgroundColor='#efefef';
}

function __RowOnMouseOut(el){
   el.style.backgroundColor=oldColor;
}

function __GetBrowser(){
   if(/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)){
      return 'firefox';
   }else if(/Chrome[\/\s](\d+\.\d+)/.test(navigator.userAgent)){
      return 'chrome';
   }else{
      return 'ie';
   }
}