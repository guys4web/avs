$(document).ready(function(){
    $('.select2').select2();


    $('#form-add-visa').validate({
        errorPlacement: function (error, element) {
            element.before(error);
        },
        rules: {
            service : {
                required:true
            },
            price : {
              required:true,
            },
            name :{
                required:true
            },
        },
        messages: {

        }
    });

});
$(document).on('change','#country',function(){
    var country = $(this).val();
    var href = $(this).attr("data-href");
    href = href.replace('#value#',country);
    $.get(href,{},function(json){
        var select = "<option value=''>Service list</option>" ;
        $.each(json, function (i, item) {
            select+="<option value='"+item.id+"'>"+item.name+"</option>";
        });
        $('[name="service"]').html(select);
    },"json");
});
$(document).on('click','#visa-save-change',function(){
    var form =   $('#form-add-visa');
    form.submit();
});

$(document).on('click','.show_delete_modal',function(){
    if ($(this).attr("data-delete")!=0){
        var text = "Can't delete " ;
        $('#delete-confirm-btn').hide();
    }else{
        var text = "De you want delete this visa?" ;
        $('#delete-confirm-btn').show();
    }
    $("#delete_confirm").find('.modal-body').html(text);
    $("#delete_confirm").modal("show");   
});
