$('select[name="city_id"]').on('change', function() {

    let id_city = $(this).val();

    const name = $(this).find('option:selected').data('name');

    geocode({ address: name })

    $.ajax({
        url: base_url+'/quan-huyen/'+id_city,
        type:'GET',
        success: function(data) {

            $('select[name="district_id"]').html(data);
       
        }
    });
});

$('select[name="district_id"]').on('change', function() {

    let id_district = $(this).val();

    const city = $('select[name="city_id"]').find('option:selected').data('name');

    const name = $(this).find('option:selected').data('name');

    const address = name+' '+city;

    geocode({ address: address })

    $.ajax({
        url: base_url+'/xa-phuong/'+id_district,
        type:'GET',
        success: function(data) {

            $('select[name="ward_id"]').html(data);

        }
    });
});

$('select[name="ward_id"]').on('change', function() {

    const city = $('select[name="city_id"]').find('option:selected').data('name');

    const district = $('select[name="district_id"]').find('option:selected').data('name');

    const name = $(this).find('option:selected').data('name');

    const address = name+' '+district+' '+city;

    geocode({ address: address })
});

$('#file').change(function(evt) {

    var files = evt.target.files;
    var file = files[0];

    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.avatar__user').attr('src',e.target.result);
        };
        reader.readAsDataURL(file);
    }
});

$(document).on('change','#type_housing',function(){
    var id = $(this).children("option:selected").val();

    $.ajax({
        url: base_url+'/get-teamplate-bds/'+id,
        type:'GET',
        success: function(data) {
            $('#content__mtbs').html(data);

        }
    });
});

function savePost(url,data){
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url:url,
        method:"POST",
        data:data,
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            if(data.success==true){
                toastr["success"](data.message, "");

                setTimeout(function(){ window.location=base_url+'/admin-post/dang-tin'; }, 2000);

            }
            var n = 1;
            if (data.success==false) {
                $.each(data.errorMessage, function(field, item) {
                    if(n==1){

                        $('html, body').animate({ scrollTop: $('.error_'+field).offset().top - 120}, 'fast');
                    }
	
                    $('.error_'+field).html(item);

                    $('.error_'+field).addClass('error');

                    n=n+1
                });
                
            }
        }
    })
}

var selDiv = "";

var storedFiles = [];

function handleFileSelect(e) {

    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);
    var device = $(e.target).data("device");
    filesArr.forEach(function(f) {

        if (!f.type.match("image.*")) {
        return;
        }
        storedFiles.push(f);

        var reader = new FileReader();
        reader.onload = function(e) {
        var html = "<div class='image-item'><img src=\"" + e.target.result + "\" data-file='" + f.name + "' class='selFile' title='Click to remove'><br clear=\"left\"/></div>";

        if (device == "mobile") {
            $("#selectedFilesM").append(html);
        } else {
            $("#selectedFilesD").append(html);
        }
        }
        reader.readAsDataURL(f);
    });

}

function removeFile(e) {
    var file = $(this).data("file");
    for (var i = 0; i < storedFiles.length; i++) {
      if (storedFiles[i].name === file) {
        storedFiles.splice(i, 1);
        break;
      }
    }
    $(this).parent().remove();
}

$("#files").on("change", handleFileSelect);

$("body").on("click", ".selFile", removeFile);

$(document).on('click','.btn__save_draft_post',function(e){

    const url = $('#form__add__bds').attr('action');

    CKEDITOR.instances['editor2'].updateElement();

    const data = new FormData($('#form__add__bds')[0]);

    const fileInput = $("#file").val();

    if(fileInput){

        data.append('file',$('#file')[0].files[0]);
    }


    data.append('count_file',storedFiles.length);

    for (var i = 0, len = storedFiles.length; i < len; i++) {
        data.append('files-'+i, storedFiles[i]);
      }
    
    $('.fr-error').html('');

    savePost(url,data);
    
});

$(document).on('click','.btn__save_draft_post',function(e){

    const url = $(this).data('url');

    CKEDITOR.instances['editor2'].updateElement();

    const data = new FormData($('#form__add__bds')[0]);

    const fileInput = $("#file").val();

    if(fileInput){

        data.append('file',$('#file')[0].files[0]);
    }


    data.append('count_file',storedFiles.length);

    for (var i = 0, len = storedFiles.length; i < len; i++) {
        data.append('files-'+i, storedFiles[i]);
      }
    
    $('.fr-error').html('');

    savePost(url,data);
    
});

