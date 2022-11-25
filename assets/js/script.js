
var url = $("#base_url").val();



$( document ).ready(function() {
    $('#nav-head').scrollToFixed();
})
$(document).ready(function() {
     $('#summernote').summernote({
		     placeholder: 'Post Your Question',
         tabsize: 2,
         height: 300,
         callbacks: {
           onImageUpload: function(files, editor, welEditable) {
              var img =  sendFile(files[0], editor, welEditable);

            }
         }

	 });
});

function sendFile(file, editor, welEditable) {
    data = new FormData();
    data.append("file", file);
    $.ajax({
        data: data,
        type: "POST",
        url: url+"posts/image_upload",
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
            $('#summernote').summernote('insertImage', url);
        }
    });
}

function show_login(){
	$("#signupmodel").modal('hide');
	$("#loginmodel").modal('show');
}

function account_signup(){
	$("#loginmodel").modal('hide');
	$("#signupmodel").modal('show');
}

function show_replay(){
	$("#replay_post").toggle();
}

function show_search(){
	$(".search-box").show();
}

function hide_search(){
    setTimeout(function(){
        $(".search-box").hide();
    }, 300)
	
}


function smart_validate(arr) {
    var val = 1;
    arr.forEach(function(e) {
        var i = 1;
        var id = e.id;
        if (e.validate.required === undefined || e.validate.required == 0) {} else {
            var content = $("#"+id).val();
            if(content == ''){
               var pro = $("#"+id).prop("tagName");
               if(pro == 'SELECT'){
                  $("#"+id+'-err').text('Select a '+e.msg);
               }else{
                  $("#"+id+'-err').text('Enter valid '+e.msg);
               }

               $("#"+id).addClass('in-err');
               $("#"+id).attr("onfocus","remove_error('"+id+"')");
               $("#"+id+'-err').show();
                val = 0;
                i = 0;
            }
        }
        if (e.validate.mobile === undefined || e.validate.mobile == 0) {} else {
            if(i == 1){
                var mobile =  $("#"+id).val();
                if(mobile.length != 10){
                    $("#"+id+'-err').text('Enter valid '+e.msg);
                    $("#"+id).addClass('in-err');
                    $("#"+id).attr("onfocus","remove_error('"+id+"')");
                    $("#"+id+'-err').show();
                     val = 0;
                     i = 0;
                }
            }
        }
        if (e.validate.email === undefined || e.validate.email == 0) {} else {
            if(i == 1){
                var email =  $("#"+id).val();
                var ec = emailCheck(email);
                if(ec == 0){
                    $("#"+id+'-err').text('Enter valid '+e.msg);
                    $("#"+id).addClass('in-err');
                    $("#"+id).attr("onfocus","remove_error('"+id+"')");
                    $("#"+id+'-err').show();
                     val = 0;
                     i = 0;
                }
            }
        }
        if (e.validate.length === undefined || e.validate.length == 0) {  } else {
            if(i == 1){
                var leng =  $("#"+id).val().length;
                if(leng < e.validate.length){
                    $("#"+id+'-err').text(e.msg+'must be at least '+e.validate.length+' characters.');
                    $("#"+id).addClass('in-err');
                    $("#"+id).attr("onfocus","remove_error('"+id+"')");
                    $("#"+id+'-err').show();
                    val = 0;
                    i = 0;
                }
            }
        }
    })
    return val;
}


function password_validate(p1, p2){
    var pswd1 =  $("#"+p1).val();
    var pswd2 =  $("#"+p2).val();
    if(pswd1 != pswd2){
        $("#"+p2+'-err').text('Password not Match');
        $("#"+p2).addClass('in-err');
        $("#"+p2).attr("onfocus","remove_error('"+p2+"')");
        $("#"+p2+'-err').show();
        return 0;
    }else{
        return 1;
    }
}



$('#myForm').ajaxForm({
    beforeSend:function(){
      $("#sav").hide()
      $("skp").show();
       $("#pb").show();
       $("#cropimage").attr("src",'http://doozyfive.com/assets/images/preloaders/loadingBig.gif');
    },
    uploadProgress:function(event,position,total,percentComplete){
      $("#pbc").width(percentComplete+'%'); //dynamicaly change the progress bar width
      $(".sr-only").html(percentComplete+'%'); // show the percentage number
    },
    success:function(){
      $("#pb").hide(); //hide progress bar on success of upload
    },
    complete:function(response){
        
        $("#oldimg").hide();
        $("#newimg").show();
      if(response.responseText=='0'){
        $(".image").html("Error"); //display error if response is 0
        alert('The File Format does not Support Pleas Select Another');
      }else
        $("#cropimage").attr("src",response.responseText);
        $("#altimage").hide();
        $("#cropimage").show();
        $(".cropFrame").show();
        rerun()
        $("#sav").show()
        $("#skp").hide();
        
        // show the image after success
    }
});

function rerun(){
    var r = $('#results1'),
       x = $('.cropX1', r),
       y = $('.cropY1', r),
       w = $('.cropW1', r),
       h = $('.cropH1', r);
   $('#cropimage').cropbox({
        width: 200,
       height: 200
   }).on('cropbox', function (event, results, img) {
       x.text(results.cropX);
       y.text(results.cropY);
       w.text(results.cropW);
       h.text(results.cropH);
   });
}

function imageChosed(){
    $("#userfile").click();
}

$("#userfile").change(function(){
    $("#myForm").submit();
})

function crope1(){
    var x = $('.cropX1').text();
    var y = $('.cropY1').text();
    var w = $('.cropW1').text();
    var h = $('.cropH1').text();
    var img = $("#cropimage").attr("src");
    
    $.ajax({url:url+"users/cropeimage",
        data:"img="+img+"&x="+x+"&y="+y+"&w="+w+"&h="+h,
        type:"POST",
        success: function(e){
          $(".cropimage").attr("src",e);
          $("#altimage").attr("src",e);
          $("#profileedit").hide();
          $("#altimage").show();
          $(".cropFrame").hide();
          $("#sav").hide();
        }
    });
  }

