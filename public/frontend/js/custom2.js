$('select[name="city_id"]').on('change', function() {

    let id_city = $(this).val();

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

    $.ajax({
        url: base_url+'/xa-phuong/'+id_district,
        type:'GET',
        success: function(data) {

            $('select[name="ward_id"]').html(data);

        }
    });
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