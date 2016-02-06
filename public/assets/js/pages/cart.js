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
    });    
    

});

function updateVisa(visa) {
        // console.log($(visa).data('name'), visa);
        fee = $(visa).data('price');
        $('#visa_type').text($(visa).data('name'));
        $('#visa_fee').text(fee);        
        $('#quantity').text($('#qty').val());
        $('#order_total').text($('#qty').val() * fee);
    };

