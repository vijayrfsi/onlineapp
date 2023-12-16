var checkbox = [];
$(document).ready(function(){
  $(document).on("click",".redirect",function(){
    window.location.href = $(this).attr("redirect_url");
    })
  $(document).on("click","#show_camera",function(){
     Webcam.set({
        width: 281,
        height: 250,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach( '#my_camera' );
    $("#show_camera").hide();
    $("#take_snapshot").show();
    })
  $(document).on("click","#take_snapshot",function(){
    if(Webcam!=undefined){
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );}
    })

  $(document).on("click",'.email_radio li',function(){
    var id = $(this).find("input").attr("id");
    
    $(".credentials").removeClass('active');
    $("#C"+id).addClass("active");
    })

    $(document).on('submit','.comment_form',function(event){
     event.preventDefault();
         var action = $(this).attr('action');
         var element = $(this).find('#submit');
          element.prop("disabled",true);
          element.html("Sending...");
          
         var formData = new FormData(this);
         var h = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url: action, 
            type: "POST",    
            headers: {
            "X-CSRF-TOKEN":h,
            },
            data: formData, 
             cache : false,
             processData: false,
             contentType: false,
            success: function (h) {
              element.prop("disabled",false);
              element.html("Save");
              var html = JSON.parse(h);
              if(html.status==true){
                toastr.success(html.message);
                window.location.href = html.redirect_url;
                }else {
                  toastr.error(html.message);
                }
             }
         })
    })


  $(document).on('submit','.ajax_login',function(event){
     event.preventDefault();
         var action = $(this).attr('action');
         var element = $('#submit')
          element.prop("disabled",true);
        //   if($(this).find("input[name=mobile").length >0) {
        //      if($(this).find("input[name=mobile").val().length != 10){
        //          toastr.error("Phone Number Must be 10 digit");
        //          return false;
        //      }
        //  }
         
          if($(this).find("input[name=mobile").length >0) {
             var mob = $(this).find("input[name=mobile").val().length;
             if(mob > 15 || mob < 10){
                 toastr.error("Phone Number Must around 10-15 digit");
                 return false;
             }
         }
         var formData = new FormData(this);
          $.ajax({
            url: action, 
            type: "POST",    
            data: formData, 
             cache : false,
             processData: false,
             contentType: false,
            success: function (h) {
              element.prop("disabled",false);
              var html = JSON.parse(h);
              if(html.status==true){
                toastr.success(html.message);
                $(".ajax_login").trigger("reset");
                if($('.ajax_login').find('#results_mobile').length>0){
                    $('.ajax_login').find('#results_mobile').empty();
                    $('.ajax_login').find('#results').empty();
                }
                setTimeout(function(){
                     if(html.redirect_url != undefined){
                      window.location.href = html.redirect_url;
                     }
                     },1500)
                }else {
                  toastr.error(html.message);

                }
             }
         })
    })



   $(document).on('change','.filter99',function(){
    var val = '';
    var url = $("#filter_url").val();
    var key = $(this).attr('name');
    if($(this).find("option:selected").val()!=undefined){
      val = $(this).find("option:selected").val();
    }else {
     val = $(this).val();
    }
    console.log(val);
    url += "?key="+key+"&val="+val;
    $.get(url,function(data){
     customer_list.ajax.reload(null,false);
      })

    })

  var apply_reload = function(){
     $('.filter').each(function(){
    var url = $("#filter_url").val();
      var key = $(this).attr('name');
      if($(this).find("option:selected").val()!=undefined){
      val = $(this).find("option:selected").val();
      }else {
      val = $(this).val();
      }
      console.log(val);
      url += "?key="+key+"&val="+val;
    $.get(url,function(data){
      })
    });
     customer_list.ajax.reload(null,false);
  }
   $(document).on("click",'.apply_reload',function(){
    apply_reload();
    apply_reload();
    
    customer_list.ajax.reload(null,false);
    })
   
   $(document).on("click",".edit_customer",function(event){
      event.preventDefault();
      var action = $(this).attr('href');
      $.get(action,function(data){
        var ddata = JSON.parse(data);
        var pdata = ddata.Data;
         $("#edit_project").modal('show');
         $("#edit_project").find("#name").val(pdata.name);
         $("#edit_project").find("#email").val(pdata.email);
         $("#edit_project").find("#id").val(pdata.id);
         $("#edit_project").find("#mobile").val(pdata.mobile);
         $("#edit_project").find("#profile").attr("src",pdata.profile);
         $("#edit_project").find("#address").val(pdata.address);
         $("#edit_project").find("#password").val(pdata.decode_password);
         $("#edit_project").find("#cpassword").val(pdata.decode_password);
         $("#edit_project").find('#wtsp_api_key').val(pdata.wtsp_api_key);
         $("#edit_project").find('#wtsp_secret_key').val(pdata.wtsp_secret_key);
         $("#edit_project").find('#email_smtp_host').val(pdata.email_smtp_host);
         $("#edit_project").find('#from_email').val(pdata.from_email);
         $("#edit_project").find('#email_smtp_port').val(pdata.email_smtp_port);
         $("#edit_project").find('#email_smtp_username').val(pdata.email_smtp_username);
         $("#edit_project").find('#email_smtp_password').val(pdata.email_smtp_password);
         $("#edit_project").find('#template_string').val(pdata.template_string);

         $("#edit_project").find('#email_template_string').val(pdata.email_template_string);
         
         $("#edit_project").find('#g_email_smtp_host').val(pdata.g_email_smtp_host);
         $("#edit_project").find('#g_from_email').val(pdata.g_from_email);
         $("#edit_project").find('#g_email_smtp_port').val(pdata.g_email_smtp_port);
         $("#edit_project").find('#g_email_smtp_username').val(pdata.g_email_smtp_username);
         $("#edit_project").find('#g_email_smtp_password').val(pdata.g_email_smtp_password);

         $("#edit_project").find('#zoho_api_key').val(pdata.zoho_api_key);
         $("#edit_project").find('#zoho_email_title').val(pdata.zoho_email_title);
         $("#edit_project").find('#zoho_from_email').val(pdata.zoho_from_email);
         $("#edit_project").find('#bounce_address').val(pdata.bounce_address);
         
         $("#edit_project").find("#is_template option#"+pdata.is_template).attr('selected',true);
         //console.log("#is_media option#"+pdata.is_media);
         $("#edit_project").find('.credentials').removeClass('active');
         $("#edit_project").find('#CE'+pdata.mail_type).addClass('active');
         $("#edit_project").find('#CE'+pdata.mail_type).addClass('active');
         $("#edit_project").find('#E'+pdata.mail_type).prop('checked',true);
      })
   })

   $(document).on("click",'.selected_download',function(event){
    event.preventDefault();
    })
   $(document).on("click",'#bulk-message',function(){
    myArray = '';
    MmyArray = '';
    // $(".checkbox:checked").each(function(k,val){

      //if(k==0){
      //myArray = $(this).attr('email'); 
      //MmyArray = $(this).attr('mobile'); 
      //}else{
       // myArray = myArray+","+$(this).attr('email'); 
        //MmyArray = MmyArray+","+$(this).attr('mobile'); 
      //}
     //})
    $("#ids").val(checkbox);
    //$("#phones").val(MmyArray);

    
    })

   var checkbox_update = function(checkbox){
    var url = $("#checkbox_url").attr('url');
          //var state_id = $(this).find("option:selected").val();
          var nurl = url;
          var fd = new FormData();
          fd.append("checkbox",checkbox);
          var h = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url:nurl, 
            headers: {
            "X-CSRF-TOKEN":h,
            },
            type: "POST",  
             data: fd,  
             cache : false,
             processData: false,
             contentType: false,
            success: function (data) {
             
             }
          })
   }

   $(document).on("click",'.checkbox_all',function(event){
    checkbox = [];
    if($(this).prop("checked")==true){
     $('.checkbox').prop("checked",true);
    }else{
      $('.checkbox').prop("checked",false);
    }
    if($(".checkbox:checked").length >0){
      $("#bulk-message").prop("disabled",false);
      $("#multiple_delete").prop("disabled",false);
    }else{
      $("#bulk-message").prop("disabled",true);
      $("#multiple_delete").prop("disabled",true);
    }
    $(".checkbox:checked").each(function(k,val){ 
        var id = $(this).attr("id");
           var i = checkbox.indexOf(id);
    if($(this).prop('checked')==true){
       if(i == -1){  
          checkbox.push(id);
        }else {
          checkbox.splice(i, 1);
        }
    }else {
      checkbox.splice(i, 1);
    }
      });
    //checkbox_update(checkbox);
    })

   $(document).on("click",'#multiple_delete',function(){
    var formData = new FormData();
         var h = $('meta[name="csrf-token"]').attr('content');
         var action = $(this).attr('url');
         if(checkbox.length <= 0){
             alert("Please select at least one entry");
             return false;
         }
         var msg = "are you sure to delete "+checkbox.length+" entries";
         var d = window.confirm(msg);
    if(d){
         formData.append("ids",checkbox);
          $.ajax({
            url: action, 
            type: "POST",    
            headers: {
            "X-CSRF-TOKEN":h,
            },
            data: formData, 
             cache : false,
             processData: false,
             contentType: false,
            success: function (h) {
              //element.prop("disabled",false);
              var html = JSON.parse(h);
              if(html.status==true){
                customer_list.ajax.reload(null,false);
                checkbox = [];
                toastr.success(html.message);
                }else {
                  toastr.error(html.message);
                }
             }
         })
        }
   })

   $(document).on("click",'.checkbox',function(event){
    //checkbox = [];
     var id = $(this).attr("id");  
        var i = checkbox.indexOf(id);
    if($(this).prop('checked')==true){
       if(i == -1){  
          checkbox.push(id);
        }else {
          checkbox.splice(i, 1);
        }
    }else {
      checkbox.splice(i, 1);
    }
    if($(".checkbox:checked").length >0){
     // $(".checkbox:checked").each(function(k,val){ 
       
     // });
      $("#bulk-message").prop("disabled",false);
      $("#multiple_delete").prop("disabled",false);

    }else{
      $("#bulk-message").prop("disabled",true);
      $("#multiple_delete").prop("disabled",true);
    }
    //checkbox_update(checkbox);
    console.log(checkbox);
    })



   $(document).on("click",".edit_lead",function(event){
      event.preventDefault();
      var action = $(this).attr('href');
      $.get(action,function(data){
        var ddata = JSON.parse(data);
        var pdata = ddata.Data;
         $("#edit_project").modal('show');
         $("#edit_project").find("#name").val(pdata.name);
         $("#edit_project").find("#email").val(pdata.email);
         $("#edit_project").find("#id").val(pdata.id);
         $("#edit_project").find("#mobile").val(pdata.mobile);
         $("#edit_project").find("#profile").attr("src",pdata.profile);
         //$("#edit_project").find("#location").val(pdata.location);
         $("#edit_project").find("#dob").val(pdata.dob);
         $("#edit_project").find("#id").val(pdata.id);
         $("#edit_project").find("#remark").val(pdata.remark);
         if(pdata.refer_by!=null){
         let refer_by = pdata.refer_by.replace(" ","_");
         $("#edit_project").find("#refer_by option#"+refer_by).attr('selected',true);
         }
         if(pdata.lead_agent!=null){

         let lead_agent = pdata.lead_agent.replace(" ","_");
         $("#edit_project").find("#lead_agent option#"+lead_agent).attr('selected',true);
       }
         $("#edit_project").find("#edit_state_id option[value='"+pdata.state_id+"']").attr('selected',true);
          var url = $("#get_district_by_state_id").attr('url');
          //var state_id = $(this).find("option:selected").val();
          var nurl = url;
          var fd = new FormData();
          fd.append("state_id",pdata.state_id);
          fd.append("did",pdata.district_id);
          var h = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url:nurl, 
            headers: {
            "X-CSRF-TOKEN":h,
            },
            type: "POST",  
             data: fd,  
             cache : false,
             processData: false,
             contentType: false,
            success: function (data) {
             $("#edit_district_id").html(data);
             }
          })
          $("#edit_project").find("#edit_district_id option[value='"+pdata.district_id+"']").attr('selected',true);
      })
   })


   $(document).on("click",".edit_referrby",function(event){
      event.preventDefault();
      var action = $(this).attr('href');
      $.get(action,function(data){
        var ddata = JSON.parse(data);
        var pdata = ddata.Data;
         $("#edit_project").modal('show');
         $("#edit_project").find("#name").val(pdata.name);
         $("#edit_project").find("#id").val(pdata.id);
      })
   })

   $(document).on("click",".edit_leadagent",function(event){
      event.preventDefault();
      var action = $(this).attr('href');
      $.get(action,function(data){
        var ddata = JSON.parse(data);
        var pdata = ddata.Data;
         $("#edit_project").modal('show');
         $("#edit_project").find("#name").val(pdata.name);
         $("#edit_project").find("#id").val(pdata.id);
      })
   })


     $(document).on("click",".edit_template",function(event){
      event.preventDefault();
      var action = $(this).attr('href');
      $.get(action,function(data){
        var ddata = JSON.parse(data);
        var pdata = ddata.Data;
         $("#edit_project").modal('show');
         $("#edit_project").find("#name").val(pdata.name);
         $("#edit_project").find("#template_string").val(pdata.template_string);
         $("#edit_project").find("#email_edit_template_string").val(pdata.email_template_string);
         if(pdata.cid != null){
            var obj = JSON.parse(pdata.cid);
            console.log(obj);
            $.each(obj, function(key,value) {
              $("#edit_project").find("#edit_customer").find("option#"+value).attr('selected',true);
            });
          }
          $("#edit_project").find("#is_template").find("option#"+pdata.is_template).attr('selected',true);
          $("#edit_project").find("#is_media option#"+pdata.is_media).attr('selected',true);
           $('#edit_customer').select2();
           if(pdata.media_url != ''){
            var asset = $("#asset").attr('value');
            
            var media_extension = pdata.media_url.split('.',2)[1];
            if(media_extension=='mp4'){
                var img = '<video width="320" height="240" controls>';
                img += "<source src='"+asset+pdata.media_url+"' type='video/mp4'>";
                img += "</video>";
                // img = "<video src='"+asset+pdata.media_url+"' width='100px' />";  
            }
            else {
            var img = "<img src='"+asset+pdata.media_url+"' width='100px' />";
            }
            $("#edit_project").find(".img_container").html(img);
           }

         $("#edit_project").find("#id").val(pdata.id);
      })
   })

   $(document).on("click",".view_lead",function(event){
      event.preventDefault();
      var action = $(this).attr('href');
      $.get(action,function(data){
         $("#leads-details").modal('show');
         $("#leads-details-html").html(data);
      })
   })

  $(document).on("click",".ajax_href",function(event){
    event.preventDefault();
    var href = $(this).attr("href");
    $.get(href,function(data){
      var d = JSON.parse(data);
      if(d.status==true){
        toastr.success(d.message);
        customer_list.ajax.reload(null,false);
      }
      })
    })

  $(document).on("change",".template_selection",function(){
    var obj = $(this).find("option:selected");
    var str = obj.attr("str");
    var str2 = obj.attr('str2');
    var wtsp_s = '';
    var input_string = '';
    if(obj.attr('is_media')==1){
       if(obj.attr('media_url')==''){
        input_string = '<input type="file" name="media" />';
       }
       else {
        input_string = '<input type="hidden" name="media_url" value="'+obj.attr('media_url')+'" />';
        //  var media_extension = obj.attr('media_url').split('.',4)[1];
            if(obj.attr('media_url').indexOf('mp4') != -1){
                var img = '<video width="320" height="240" controls>';
                img += "<source src='"+obj.attr('media_url')+"' type='video/mp4'>";
                img += "</video>";
                input_string += img;
                // img = "<video src='"+asset+pdata.media_url+"' width='100px' />";  
            }
            else {
        input_string += '<img src="'+obj.attr('media_url')+'" width="200px" />';
            }
       }
    }
    console.log(str);
    //$("<h1>GeeksforGeeks!</h1>").replaceAll("p");
    //str = str.replace("/\$$/g","<p contenteditable='true'></p>");
     wtsp_s += str.replace(/\{{1}(.*?)\}{1}/g, "<p contenteditable='true'>Variable $1</p>");
    var str2 = str2.replace(/\{{1}(.*?)\}{1}/g, "<p contenteditable='true'>Variable $1</p>");
    //var s = 'some+multi+word+string'.replace(/\+/g, ' ');
    //console.log(str);
    //str = str.replace("}}","' />");
    //console.log(str);
    $(".final_string").html(wtsp_s);
    $(".input_string").html(input_string);
    $(".email_final_string").html(str2);
    })
  $(document).on('submit','.customer_form',function(event){
     event.preventDefault();
         var action = $(this).attr('action');
         var element = $('#submit')
         if($(this).find("#password").val() != $(this).find("#cpassword").val()){
          toastr.error("Confirm Password Not Matched");
          return false;
         }
          element.prop("disabled",true);
         var formData = new FormData(this);
         var h = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url: action, 
            type: "POST",    
            headers: {
            "X-CSRF-TOKEN":h,
            },
            data: formData, 
             cache : false,
             processData: false,
             contentType: false,
            success: function (h) {
              element.prop("disabled",false);
              var html = JSON.parse(h);
              if(html.status==true){
                toastr.success(html.message);
                $('.customer_form').trigger("reset");
                if(html.redirect_url != undefined){
                      window.location.href = html.redirect_url;
                     }
                customer_list.ajax.reload(null,false);
                $("#add_project").modal('hide');
                $("#edit_project").modal('hide');
                     
                     
                }else {
                  toastr.error(html.message);

                }
             }
         })
    })

$(document).on("click",".psw .password_absolute .fa",function(){
  if($(this).hasClass("fa-eye")){
    $(this).parents(".psw").find("input[type=password]").attr("type","text");
    $(this).removeClass("fa-eye");
    $(this).addClass("fa-eye-slash");
  }else{
    $(this).parents(".psw").find("input[type=text]").attr("type","password");
    $(this).addClass("fa-eye");
    $(this).removeClass("fa-eye-slash");
  }

  })


  $(document).on('submit','.excel_form',function(event){
     event.preventDefault();
         var action = $(this).attr('action');
         var element = $(this).find('#submit');
          element.prop("disabled",true);
         var formData = new FormData(this);
         var h = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url: action, 
            type: "POST",    
            headers: {
            "X-CSRF-TOKEN":h,
            },
            data: formData, 
             cache : false,
             processData: false,
             contentType: false,
            success: function (h) {
              element.prop("disabled",false);
              var html = JSON.parse(h);
              if(html.status==true){
                $('.excel_form').trigger("reset");
                toastr.success(html.message);
                customer_list.ajax.reload(null,false);
                $("#add_project").modal('hide');
                $("#excel_import").modal('hide');
                $("#edit_project").modal('hide');
                }else {
                  toastr.error(html.message);

                }
             }
         })
    })



  $(document).on('submit','.lead_form',function(event){
     event.preventDefault();
         var action = $(this).attr('action');
         var element = $(this).find('#submit');
          element.prop("disabled",true);
          element.html("Sending...");
         if($(this).find("input[name=mobile").length >0) {
             var mob = $(this).find("input[name=mobile").val().length;
             if(mob > 15 || mob < 10){
                 toastr.error("Phone Number Must around 10-15 digit");
                 return false;
             }
         }
         var formData = new FormData(this);
         var h = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url: action, 
            type: "POST",    
            headers: {
            "X-CSRF-TOKEN":h,
            },
            data: formData, 
             cache : false,
             processData: false,
             contentType: false,
            success: function (h) {
              element.prop("disabled",false);
              element.html("Save");
              var html = JSON.parse(h);
              if(html.status==true){
                $('.lead_form').trigger("reset");
                toastr.success(html.message);
                customer_list.ajax.reload(null,false);
                $("#add_project").modal('hide');
                $("#edit_project").modal('hide');
                $("#seld_bulk_message").modal('hide');
                }else {
                  toastr.error(html.message);

                }
             }
         })
    })

  $(document).on("click",".remove_link",function(event){
    event.preventDefault();
    var d = window.confirm("are you sure to delete this");
    if(d){
    var action = $(this).attr("href");
    var message = $(this).attr("message");
    var fd = new FormData();
    var h = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
            url: action, 
            headers: {
            "X-CSRF-TOKEN":h,
            },
            type: "DELETE",  
             data: fd,  
             cache : false,
             processData: false,
             contentType: false,
            success: function (h) {
             toastr.success(message);
             customer_list.ajax.reload(null,false);
             }
         })
    
    }
  });

  $(document).on("change",'#state_id',function(){
    var url = $("#get_district_by_state_id").attr('url');
    var state_id = $(this).find("option:selected").val();
    var nurl = url;
    var fd = new FormData();
    fd.append("state_id",state_id);
    var h = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
            url:nurl, 
            headers: {
            "X-CSRF-TOKEN":h,
            },
            type: "POST",  
             data: fd,  
             cache : false,
             processData: false,
             contentType: false,
            success: function (data) {
             $("#district_id").html(data);
             }
         })
    
    })


   $(document).on("change",'#filter_state_id',function(){
    var url = $("#get_district_by_state_id").attr('url');
    var state_id = $(this).find("option:selected").val();
    var nurl = url;
    var fd = new FormData();
    fd.append("state_id",state_id);
    var h = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
            url:nurl, 
            headers: {
            "X-CSRF-TOKEN":h,
            },
            type: "POST",  
             data: fd,  
             cache : false,
             processData: false,
             contentType: false,
            success: function (data) {
             $("#filter_district_id").html(data);
             }
         })
    
    })

   $(document).on("change",'#edit_state_id',function(){
    var url = $("#get_district_by_state_id").attr('url');
    var state_id = $(this).find("option:selected").val();
    var nurl = url;
    var fd = new FormData();
    fd.append("state_id",state_id);
    var h = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
            url:nurl, 
            headers: {
            "X-CSRF-TOKEN":h,
            },
            type: "POST",  
             data: fd,  
             cache : false,
             processData: false,
             contentType: false,
            success: function (data) {
             $("#edit_district_id").html(data);
             }
         })
    
    })


  $(document).on('submit','.send_bulk_form',function(event){
     event.preventDefault();
         var action = $(this).attr('action');
         var element = $(this).find('#submit');
          element.prop("disabled",true);
          element.html("Sending...");
          
         var formData = new FormData(this);
         var final_string = $(".final_string").html();
         var email_final_string = $(".email_final_string").html();
         formData.append("final_string",final_string);
         formData.append("email_final_string",email_final_string);
         var h = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url: action, 
            type: "POST",    
            headers: {
            "X-CSRF-TOKEN":h,
            },
            data: formData, 
             cache : false,
             processData: false,
             contentType: false,
            success: function (h) {
              element.prop("disabled",false);
              element.html("Save");
              var html = JSON.parse(h);
              if(html.status==true){
                $('.lead_form').trigger("reset");
                toastr.success(html.message);
                customer_list.ajax.reload(null,false);
                $("#add_project").modal('hide');
                $("#edit_project").modal('hide');
                $("#seld_bulk_message").modal('hide');
                $(".final_string").empty();
                $(".email_final_string").empty();
                $(".template_selection").prop('selectedIndex', 0);
                }else {
                  toastr.error(html.message);

                }
             }
         })
    })




})