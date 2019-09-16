window.setTimeout(function() {
  $(".alert").fadeTo(5000, 0).slideUp(500, function() {
      $(this).remove();
  });
}, 2000);

$(document).ready(function(){
 
    

  
  $('#sendProfileData').click(function(){
      var formData = new FormData($('#profileupdate')[0]);
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: APP_URL+"/admin/update-profile",
        processData: false,  // Important!
        contentType: false,
        cache: false,
        data: formData,
        success: function (data) {
        
          if(data.status == 200){
           $('#msg').html('<div class="alert alert-info fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="icon-remove"></i></button><strong>Success!</strong>'+data.success+'</div>')
          
           window.setTimeout(function(){location.reload()},3000)
          }
          else{
            $('.text-danger').remove();
            jQuery.each(data.error, function(key, value){
            $('#'+key).parent().append('<span class="text-danger">'+value+'<span>');
          });
          }
         
        }
      })
    
  })
  
})

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#previewHolder').show();
      $('#previewHolder').attr('src', e.target.result);

    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#profile_img").change(function() {
  readURL(this);
});


function convertToSlug()
{ var slug = function(str) {
  var $slug = '';
  var trimmed = $.trim(str);
  $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
  replace(/-+/g, '-').
  replace(/^-|-$/g, '');
  return $slug.toLowerCase();
}
$('#slug').val(slug($('#cname').val()));
}

$(document).ready(function() {
  $("input[name='search']").on("input", function() {
    var column=[];
    var joins=[];
    $('th').each(function(){
         
        console.log($(this).attr("data-column"));
        column.push($(this).attr("data-column"));
    })

    $('th').each(function(){
         
      console.log($(this).attr("data-join"));
      joins.push($(this).attr("data-join"));
  })

    //console.log(column.filter(function(e){return e}));
   //console.log($('th').attr("data-column"));
   //return;
   var inputvalue = this.value;
   var tablename = $(this).attr("data-table");
   var baseurl = $(this).attr("base-url");
   var deleteurl = $(this).attr("delete-url");
   var editurl = $(this).attr("edit-url");
    $.ajax({
      type: "GET",
      url: APP_URL+"/admin/ajax/serch",
      data: {inputvalue:inputvalue, joins:joins.filter(function(e){return e}),tablename:tablename ,columns:column.filter(function(e){return e}),baseurl:baseurl,editurl:editurl,deleteurl:deleteurl},
      success: function (data) {
        $('#result').html(data);
      }
    });
  });

  CKEDITOR.replaceClass = 'ckeditor';
  

  //  $('#ptype').change(function(){
  //     if($(this).val() == '1'){
  //       $('#category').show();
  //     }else{
  //       $('#category').hide();
  //     }
  //  });
   
  //    if($('.show').text() !=''){
  //     $('#category').show();
  //    }
    //  $('#category').show();
   
});
    $('.remove').hide();
    $('.defaultclass').hide();
    
    $(document).on('change', '.uploadFile', function() {
      //alert($(this).size());
      $(this).parent().siblings('.image_preview').prev().parent().next().show();
     //$('.image_preview').html("");
     var total_file=$(this).size();
    //$(this).parent().siblings('.image_preview').css('background-color','red');

     for(var i=0;i<total_file;i++)
     {
      $(this).parent().siblings('.image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
        $('.addbtn').hide();
        $(this).parent().siblings('.image_preview').prev().show();
     }
     $('.addnew').append('<div class="col-lg-6"><div class="addMore"><div class="remove" style = "display:none"><i class="icon_close_alt" aria-hidden="true"></i></div><div class="image_preview"></div><div class="addbtn"><span>+</span>Add More<input type="file" name = "product_img[]" class="form-control uploadFile"></div></div><div class = "defaultclass" style = "display:none"><label>Make a default :</label><input type = "hidden" name = "is_default[]" class = "codeview"> <input type = "radio" name = "radiobutton[]" class = "radioclass" value = "1"></div></div>');
     
  });

  $(document).on('click', '.remove', function() {
    $(this).parent().parent().remove();
  });

  $(document).on('click', '.addvideo', function() {
    $(this).parent().parent().next().append('<div class="form-group"><label for="inputEmail1" class="col-lg-2 control-label">Video URL</label><div class="col-lg-8"><input type="text" class="form-control" id="video" name = "videourl[]" placeholder="Enter Video URL"></div><div class="col-lg-2"><button type = "button" class = "btn btn-danger remove_video">Remove</button></div>');
  });

  $(document).on('click', '.remove_video', function() {
      $(this).parent().parent().remove();
  });

  $(document).on('click', 'input[name="radiobutton[]"]', function() {
      $('.codeview').val('0');
      $(this).prev().val(1);
});


$(document).ready(function() {
  $('#multiselect').multiselect({
    buttonWidth : '80%%',
    includeSelectAllOption : true,
		nonSelectedText: 'Select City'
  });
});

function getSelectedValues() {
  var selectedVal = $("#multiselect").val();
	for(var i=0; i<selectedVal.length; i++){
		function innerFunc(i) {
			setTimeout(function() {
				location.href = selectedVal[i];
			}, i*2000);
		}
		innerFunc(i);
	}
}

