$(function () {   
	
	var order = {
    	clear: function() {
    		$('#order_total, #quantity, #visa_type, #visa_fee').text('');
	    	$('.visas').prop('checked', false);
    	}
    }

	$('#services').change(function() {        
        //console.log(this.value, $(this).find("option:selected").text());
        $('#service_type').text($(this).find("option:selected").text());
        order.clear();
        $('#numPassengers').hide();
        $('.visa_item').remove();
        $.ajax({
            type: "GET",
            url: "visa/service/"+$(this).val(),
            success: function (result) {                
                $('.portlet').show();
                $.each(result.data, function (i, item) {                    
                                                    
                    $('#service_visas').append("<tr class='visa_item'>" +
                        "<td><input type='radio' name='visa' onClick='updateVisa(this)' class='visas' data-name='" + item.name + 
                        "' data-id='" + item.id + "' data-price='" + item.price + "'></td>" +
                        "<td>" + item.name + "</td>" +
                        "<td>" + (item.max_stay || '30 days') + "</td>" +
                        "<td>" + item.price + "</td>" +
                        "<td>requirements </td>" +
                        "</tr>");
                });
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            }
        });
    });    

    $('#qty').change(function() {
        var fee = $('form input[type=radio]:checked').data('price');
        $('#quantity').text($(this).val());
        $('#order_total').text($(this).val() * fee);
        updatePassengersForm();
    });

    updatePassengersForm();
});

function updateVisa(visa) {
    // console.log($(visa).data('name'), visa);
    fee = $(visa).data('price');
    $('#visa_type').text($(visa).data('name'));
    $('#visa_fee').text(fee);        
    $('#quantity').text($('#qty').val());
    $('#order_total').text($('#qty').val() * fee);
    $('#numPassengers').show();
};

function updatePassengersForm() {
    $("#passengers").html('');
        for (var i = 0; i < $('#qty').val(); i++) {
            $("#passengers").append("<div class='form-group'>" +
                        "<label for='gender-"+i+"' class='col-sm-2 control-label'>Gender</label>" +
                        "<div class='col-sm-2'>" +
                            "<select class='form-control' title='Select Gender...' name='gender-"+i+"'>" +
                                "<option value=''>Select</option>" +
                                "<option value='male'>Male</option>" +
                                "<option value='female'>Female</option>" +                            
                            "</select>" +
                        "</div>" +
                    "</div>" +
                    "<div class='form-group required'>" +
                        "<label for='fname-"+i+"' class='col-sm-2 control-label'>First Name</label>" +
                        "<div class='col-sm-4'>" +
                            "<input id='fname-"+i+"' name='fname-"+i+"' type='text' class='form-control'/>" +
                        "</div>" +
                    "</div>" +
                    "<div class='form-group required'>" +
                        "<label for='lname-"+i+"' class='col-sm-2 control-label'>Last Name</label>" +
                        "<div class='col-sm-4'>" +
                            "<input id='lname-"+i+"' name='lname-"+i+"' type='text' class='form-control'/>" +
                        "</div>" +
                    "</div>" +

                    "<div class='form-group required'>" +
                        "<label for='dob-"+i+"' class='col-sm-2 control-label'>Date of Birth</label>" +
                        "<div class='col-sm-4'>" +
                            "<input id='dob-"+i+"' name='dob-"+i+"' type='text' class='form-control' " +
                                   " placeholder='mm-dd-yyyy'/>" +
                        "</div>" +
                    "</div>" +

                    "<div class='form-group required'>" +
                        "<label for='passport-"+i+"' class='col-sm-2 control-label'>Pasport No.</label>" +
                        "<div class='col-sm-4'>" +
                            "<input id='passport-"+i+"' name='passport-"+i+"' type='text' class='form-control'/>" +
                        "</div>" +
                    "</div>" +

                    "<div class='form-group required'>" +
                        "<label for='passportExp-"+i+"' class='col-sm-2 control-label'>Pasport Expiration.</label>" +
                        "<div class='col-sm-4'>" +
                            "<input id='passportExp-"+i+"' name='passportExp-"+i+"' type='text' class='form-control'/>" +
                        "</div>" +
                    "</div>" +
                    "<hr>");
        }
};

