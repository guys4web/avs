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
        var text = "Can't delete because it's have "+$(this).attr("data-delete")+" products " ;
        $('#delete-confirm-btn').hide();
        $('#delete-visa-confirm-btn').attr("data-id",0);
        $('#delete-visa-confirm-btn').show();
    }else{
        var text = "Do you want delete this visa?" ;
        $('#delete-confirm-btn').show();
        var visa_id = $(this).attr("data-id");
        $('#delete-visa-confirm-btn').attr("data-id",visa_id);
        $('#delete-visa-confirm-btn').hide();
    }
    
    $("#delete_confirm").find('.modal-body').html(text);
    $("#delete_confirm").modal("show");   
});

$(document).on('click','#delete-visa-confirm-btn',function(){
    if(parseInt($(this).attr('data-id'))!=0)
    {
        var href = $(this).attr("data-href");
        href = href.replace('#id#',$(this).attr('data-id'));
        window.location = href ;
    }
});
