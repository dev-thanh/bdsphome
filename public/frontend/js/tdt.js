jQuery(document).ready(function($) {
    /*  GIỎ HÀNG  */
    var base_url = $('input[name="base_url"]').val();
    ajax_giohang = function(id,qty,url,parent){
        $.ajax({
            url: url,
            type:'GET',
            data: {id:id,qty:qty},
            beforeSend: function() {
                
            },
            success: function(data) {
               console.log(data);
               parent.find('.cartitem-price').html(data.price_new);
               $('.total-cart').html(data.total);
               $('.count-cart').html('( '+data.count+' )');
               $('.disabled-click').removeClass();
            }
        });
    }
    $(".icon-minus-next").click(function(e){
        e.preventDefault();
        var parent = $(this).parents('tr');
        var id = parent.find('input[name="get_id_product"]').val();
        var url = parent.find('input[name="get_id_product"]').data('url');
        var qty_old = parent.find('input[name="product_qty"]');
        parent.addClass("disabled-click");
        var qty = qty_old.val();
        qty = parseFloat(qty)+1;
        qty_old.val(qty);

        ajax_giohang(id,qty,url,parent);
    });
    $(".icon-minus-pre").click(function(e){
        e.preventDefault();
        var parent = $(this).parents('tr');
        var id = parent.find('input[name="get_id_product"]').val();
        var url = parent.find('input[name="get_id_product"]').data('url');
        var qty_old = parent.find('input[name="product_qty"]');
        parent.addClass("disabled-click");
        var qty = qty_old.val();
        if(parseFloat(qty) > 1){
            qty =  parseFloat(qty)-1;        
            qty_old.val(qty);
            ajax_giohang(id,qty,url,parent);
        }
        else{
            //alert('Bạn có mún xóa sản phẩm khỏi giỏ hàng');
            $('.disabled-click').removeClass();
        }
    });

    $('.btn__delete_cart_item').click(function(e){
        e.preventDefault();
        var parent = $(this).parents('.cart__group');
        var parent_tr = $(this).parents('tr');
        var id = $(this).data('rowid');
        $.ajax({
            url: base_url+'/remove-cart',
            type:'GET',
            data: {id:id},
            success: function(data) {
               console.log(data);
               $('.cart__total-number').html(data.total);
               $('.cart__count').html(data.count);
               toastr["success"](data.toastr, "");
                $('.cart-group_'+id).remove();
               if(data.count==0){
                    $('.cart_empty').html(data.empty);
               }
            }
        });
    });

    $('input[name="color"]').on('click',function(){

        $('input[name="color"]').prop('checked' , false);

        $(this).prop('checked',true);

    });

    $('input[name="qty"]').blur(function(){
        var id = $(this).data('id');

        var qty = $(this).val();

        $.ajax({
            url: base_url+'/update-cart',
            type:'GET',
            data: {id:id,qty:qty},
            success: function(data) {
               $('input[name="qty"][data-id="'+id+'"]').val(qty);
               $('.cart__total-number').html(data.total);
               $('.cart__count').html(data.count);
            }
        });
    });







    $('input[name="product_qty"]').blur(function(){
        var parent = $(this).parents('tr');
        var url = parent.find('input[name="get_id_product"]').data('url');
        var id = parent.find('input[name="get_id_product"]').val();
        var qty = $(this).val();
        if(qty !=''){            
            ajax_giohang(id,qty,url,parent);        
        }
    });

    $('#filter-products').click(function(e){
        var url = $('input[name="curent_url"]').val();
        var price_from = $('input[name="price_from"]').val();
        var price_to = $('input[name="price_to"]').val();
        location.href = url+'?min='+price_from+'&max='+price_to;
    });

    $('.btn-send-contact').click(function(e){

        e.preventDefault();

        $('.loadingcover').show();

        var UrlContact =$('#frm_contact').attr('action');

        var data = $("#frm_contact").serialize();

        $.ajax({

            type: 'POST',

            url: UrlContact,

            dataType: "json",

            data: data,

            success:function(data){

                if(data.message_name){

                    $('.fr-error').css('display', 'block');

                    $('#error_name').html(data.message_name);

                } else {

                    $('#error_name').html('');

                }

                if(data.message_email){

                    $('.fr-error').css('display', 'block');

                    $('#error_email').html(data.message_email);

                } else {

                    $('#error_email').html('');

                }

                if(data.message_phone){

                    $('.fr-error').css('display', 'block');

                    $('#error_phone').html(data.message_phone);

                } else {

                    $('#error_phone').html('');

                }

                if(data.message_content){

                    $('.fr-error').css('display', 'block');

                    $('#error_content').html(data.message_content);

                } else {

                    $('#error_content').html('');

                }

                if (data.success) {

                    $('#frm_contact')[0].reset();

                    toastr["success"](data.success, "Thông báo");

                }

                $('.loadingcover').hide();

            }

        });

    });

    $('.btn-send-sale').click(function(e){

        e.preventDefault();

        $('.loadingcover').show();

        var UrlContact =$('#form-send-sale').attr('action');

        var data = $("#form-send-sale").serialize();

        $.ajax({

            type: 'POST',

            url: UrlContact,

            dataType: "json",

            data: data,

            success:function(data){

                console.log(data);

                if(data.message_error){

                    toastr["error"](data.message_error, "Thông báo");

                }

                if (data.success) {

                    $('#form-send-sale')[0].reset();

                    toastr["success"](data.success, "Thông báo");

                }

                $('.loadingcover').hide();

            }

        });

    });

    var base = $('input[name="base_url"]').val();

    function getAjaxProducts(param, html= true) {

        $('.loadingcover').show();

        $.ajax({

            url: base + '/filter-products',

            type: 'GET',

            data: param,

        })

        .done(function(data) {

            console.log(data);

            $('.loadingcover').hide();


                $('.page__category-main-load').html(data);

        })

    }

    $('.filter-price').click(function(event) {

        var min_price = $(this).data('min');

        var max_price = $(this).data('max');

        var bran_checked = $('.filter-brand:checked').val();

        var order = $('.filter__top-radio:checked').val();

        var slug = $('input[name="get_slug"]').val();

        var search = $('input[name="url_search"]').val();

        param = { 

            _token: $('meta[name="_token"]').attr('content'),

            min_price : min_price,

            max_price : max_price,

            bran_checked : bran_checked,

            order : order,

            slug : slug,

            search : search,

        }

        getAjaxProducts(param);

    });

    $('.filter-brand').click(function(event) {

        var min_price = $('.filter-price:checked').data('min');

        var max_price = $('.filter-price:checked').data('max');

        var bran_checked = $(this).val();

        var order = $('.filter__top-radio:checked').val();

        var slug = $('input[name="get_slug"]').val();

        var search = $('input[name="url_search"]').val();

        param = { 

            _token: $('meta[name="_token"]').attr('content'),

            min_price : min_price,

            max_price : max_price,

            bran_checked : bran_checked,

            order : order,

            slug : slug,
            
            search : search,

        }

        getAjaxProducts(param);

    });

    $('.filter__top-radio').click(function(event) {

        var min_price = $('.filter-price:checked').data('min');

        var max_price = $('.filter-price:checked').data('max');

        var bran_checked = $('.filter-brand:checked').val();

        var order = $(this).val();

        var slug = $('input[name="get_slug"]').val();

        var search = $('input[name="url_search"]').val();

        param = { 

            _token: $('meta[name="_token"]').attr('content'),

            min_price : min_price,

            max_price : max_price,

            bran_checked : bran_checked,

            order : order,

            slug : slug,
            
            search : search,

        }

        getAjaxProducts(param);

    });

    $('#form-send-sale input').on('keypress', function(e) {
        return e.which !== 13;
    });

});


var sort_fields = 'date';
var sort_type = 'desc';
var base = 'desc';

jQuery(document).ready(function($) {
    
    $('.filter-check-box').click(function(event) {

        setParam($(this));

        filterString = getParam();

        addChoosedFilter();

        param = { 
            _token: $('meta[name="_token"]').attr('content'),
            filterString : filterString,
            category_base : $('#category_base').val(),
            sort_fields : sort_fields,
            sort_type: sort_type,
        }
        getAjaxProducts(param);

        setTang();
                
    });



    $('.sort_fields').click(function(event) {
        sort_fields = $(this).data('fields');
        sort_type = $(this).data('type');

        filterString = getParam();

        param = { 
            _token: $('meta[name="_token"]').attr('content'),
            filterString : filterString,
            category_base : $('#category_base').val(),
            sort_fields : sort_fields,
            sort_type: sort_type,
        }
        getAjaxProducts(param);
    });

});

function getAjaxProducts(param, html= true) {
    var base_url = $('input[name="base_url"]').val();
    $('.loadingcover').show();
    $.ajax({
        url: base_url + '/filter-products',
        type: 'POST',
        data: param,
    })
    .done(function(data) {
        
        $('.loadingcover').hide();
            
        $('#list-products').html(data);
            
    })
}

function setParam(el) {

    idInput = el.data('id');
    type = el.data('type');

    var selected = [];
    valueInput = $('#'+idInput);
    $('.filter-check-box.'+type).each(function() {
        if ($(this).is(":checked")) {
            selected.push($(this).val());
        }
    });
    valueInput.val(selected.toString());
}

function setTang(){
    var html = '';
    $('input[data-type="category"]').each(function() {
        if ($(this).is(":checked")) {
            var name = $(this).data('name');
            var value = $(this).val();
            html+='<label for="" class="show__item">'+
            '<span class="show__item-n">'+name+'</span>'+
            '<button data-value="'+value+'" type="button" class="btn btn__close">x</button>'+
            '</label>';
        }
    });
    $('.show__global').html(html);
}

$(document).on('click','.btn__close',function(){
    var value = $(this).data('value');

    $('input[data-vl="'+value+'"]').prop('checked',false);

    setParam($('input[data-vl="'+value+'"]'));

    filterString = getParam();

        addChoosedFilter();
        
        param = { 
            _token: $('meta[name="_token"]').attr('content'),
            filterString : filterString,
            category_base : $('#category_base').val(),
            sort_fields : sort_fields,
            sort_type: sort_type,
        }
        getAjaxProducts(param);

        setTang();
});


function getParam() {
    string = '';
    $('.input-param').each(function() {
        var param = ($(this)).val();
        if (param.length > 0) {
            var type = $(this).data('type');
            string = string+type+':'+param+'&';
        }
        
    });
    return string.substring(0, string.length - 1);;
}

function addChoosedFilter(){
    $html = '<li class="list-inline-item"><span>Lọc:</span></li>';
    $('.check-box-filter').each(function() {
        if ($(this).is(":checked")) {
           $html = $html + '<li class="list-inline-item"><label>'+$(this).data('name')+'</label><a href="javascript:0" class="remove_choosed_filter" data-id="'+$(this).attr('id')+'">x</a></li>';
        }
    });
    $('#filter-properties').html($html);
}

$('body').on('click', '.remove_choosed_filter', function(event) {

    var id_input = '#'+$(this).data('id');

    $(id_input).attr('checked', false);

    setParam($(id_input));

    filterString = getParam();

    addChoosedFilter();
    
    param = { 
        _token: $('meta[name="_token"]').attr('content'),
        filterString : filterString,
        category_base : $('#category_base').val(),
        sort_fields : sort_fields,
        sort_type: sort_type,
    }
    
    getAjaxProducts(param);
});

function getParamMobile() {
    string = '';
    $('.select-filter-mobile').each(function() {
        var param = ($(this)).val();
        if (param.length > 0) {
            var type = $(this).data('type');
            string = string+type+':'+param+'&';
        }
        
    });
    return string.substring(0, string.length - 1);;
}

$('.select-filter-mobile').change(function(event) {

    filterString = getParamMobile();
    //addChoosedFilter();
    param = { 
        _token: $('meta[name="_token"]').attr('content'),
        filterString : filterString,
        category_base : $('#category_base').val(),
        sort_fields : sort_fields,
        sort_type: sort_type,
    }
    getAjaxProducts(param);
});