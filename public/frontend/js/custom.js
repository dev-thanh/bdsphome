$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});

$('.btn_send_login').click(function(e){

    e.preventDefault();

    const el = $(this);

    const url =$(this).parents('form').attr('action');

    const data = $(this).parents('form').serialize();

    $('.fr-error').html('');

    $.ajax({

        type: 'POST',

        url: url,

        dataType: "json",

        data: data,

        success:function(data){

            if(data.success==true){
                //location.reload();
                location.href = data.url;
            }

            if(data.success==false){
                el.parents('form').find('.fr-error_name').html(data.errorMessage.email);
                el.parents('form').find('.fr-error_password').html(data.errorMessage.password);
                el.parents('form').find('.fr-error_login_error').html(data.errorMessage.login_error);
            }

        }

    });

});

$('#refresh').click(function(){
    $.ajax({
       type:'GET',
       url:'/refreshcaptcha',
       success:function(data){
          $(".screen__captcha").html(data.captcha);
       }
    });
});

$('.btn_send_register_account').click(function(e){

    e.preventDefault();

    const el = $(this);

    const url =$(this).parents('form').attr('action');

    const data = $(this).parents('form').serialize();

    $('.fr-error').html('');

    $.ajax({

        type: 'POST',

        url: url,

        dataType: "json",

        data: data,

        success:function(data){

            console.log(data);

            // if(data.success==true){
            //     location.reload();
            // }

            if(data.success==false)
            {
                $.each(data.errorMessage, function(field, item) {

                    el.parents('form').find('.fr-error_'+field).html(item);
                    
                });
            }

        }

    });

});

$('.btn__aupdate__account').click(function(e){

    e.preventDefault();

    const el = $(this);

    const form = el.parents('form')[0];

    const url =$(this).parents('form').attr('action');

    const data = new FormData(form);

    $('.fr-error').html('');

    $.ajax({

        type: 'POST',

        url: url,

        dataType: "json",

        processData: false,

        contentType: false,

        data: data,

        success:function(data){

            console.log(data);

            if(data.success==true){

                toastr["success"](data.message, "Thông báo");

                $('.image_avatar_header').attr('src',data.image_respon);
            }

            if(data.success==false)
            {
                $.each(data.errorMessage, function(field, item) {

                    // el.parents('form').find('.fr-error_'+field).html(item);

                    $('.fr__'+field)[0].setCustomValidity(item);

                    $('.fr__'+field)[0].reportValidity();
                    
                });
            }

        }

    });

});