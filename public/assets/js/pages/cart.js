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
                        "<td><input type='radio' value='"+item.productid+"' name='visa' onClick='updateVisa(this)' class='visas' data-name='" + item.name +
                        "' data-id='" + item.id + "' data-price='" + item.price + "'></td>" +
                        "<td>" + item.name + "</td>" +
                        "<td>" + (item.max_stay || '30 days') + "</td>" +
                        "<td>" + item.price + "</td>" +
                        "<td><a href='#' onClick='getRequirements(this)' data-visa_id='" + item.id + "'>requirements</a> </td>" +
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

function getRequirements (visa) {
    $('#visa_requirements').empty();
    $.ajax({
            type: "GET",
            url: "requirements/visa/"+$(visa).data('visa_id'),
            success: function (result) {
                console.log(result);
                if(result.data.length > 0) {
                    $.each(result.data, function (i, item) {
                        $('#visa_requirements').append("<li><b>" + item.title + "</b>"
                            + "<p>" + item.description + "</p></li>");
                    });    
                } else {
                    
                    $('#visa_requirements').append("<li>No requirments available for this visa</li>");                    
                }
                

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            }
        });
    $('#reqModal').modal('toggle')
    
}

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
				var month = "<option value=''>Month</option>" ;
				for(var j=1;j<=12;j++){
						month+="<option value='"+j+"'> "+j+" </option>";
				}
				var day = "<option value=''>Day</option>" ;
				for(var k=1;k<=31;k++){
						day+="<option value='"+k+"'> "+k+" </option>";
				}
        for (var i = 0; i < $('#qty').val(); i++) {
            $("#passengers").append("<div class='form-group'>" +
                        "<label for='gender-"+i+"' class='col-sm-2 control-label'>Gender</label>" +
                        "<div class='col-sm-4'>" +
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
                            "<input data-rule-required='true' id='fname-"+i+"' name='fname-"+i+"' type='text' class='form-control'/>" +
                        "</div>" +
                    "</div>" +
                    "<div class='form-group required'>" +
                        "<label for='lname-"+i+"' class='col-sm-2 control-label'>Last Name</label>" +
                        "<div class='col-sm-4'>" +
                            "<input data-rule-required='true' id='lname-"+i+"' name='lname-"+i+"' type='text' class='form-control'/>" +
                        "</div>" +
                    "</div>" +

                    "<div class='form-group required'>" +
                        "<label for='dob-"+i+"' class='col-sm-2 control-label'>Date of Birth</label>" +
                        "<div class='col-sm-3'>" +
														"<select class='form-control' data-rule-required='true' id='month-dob-"+i+"' name='month-dob-"+i+"'>"+month+"</select>"+
											  "</div>"+
												"<div class='col-sm-3'>" +
														"<select class='form-control' data-rule-number='true'  data-rule-required='true' id='day-dob-"+i+"' name='day-dob-"+i+"'>"+day+"</select>"+
												"</div>"+
                        "<div class='col-sm-3'>" +
                          	"<input data-rule-rangelength='4,4' data-rule-number='true' data-rule-required='true' id='year-dob-"+i+"' name='year-dob-"+i+"' type='text' class='form-control' " +
                                                           " placeholder='yyyy'/>" +
                        "</div>" +
                    "</div>" +

                    "<div class='form-group required'>" +
                        "<label for='passport-"+i+"' class='col-sm-2 control-label'>Pasport No.</label>" +
                        "<div class='col-sm-4'>" +
                            "<input data-rule-alphanumeric='true' data-rule-required='true' id='passport-"+i+"' name='passport-"+i+"' type='text' class='form-control'/>" +
                        "</div>" +
                    "</div>" +

                    "<div class='form-group required'>" +
                        "<label for='passportExp-"+i+"' class='col-sm-2 control-label'>Pasport Expiration.</label>" +
                        "<div class='col-sm-3'>" +
														"<select class='form-control' data-rule-required='true' id='month-passportExp-"+i+"' name='month-passportExp-"+i+"'>"+month+"</select>"+
											  "</div>"+
												"<div class='col-sm-3'>" +
														"<select class='form-control' data-rule-number='true'  data-rule-required='true' id='day-passportExp-"+i+"' name='day-passportExp-"+i+"'>"+day+"</select>"+
												"</div>"+
                       "<div class='col-sm-3'>" +
                            "<input data-rule-rangelength='4,4' data-rule-number='true' data-rule-required='true' id='passportExp-dob-"+i+"' name='year-passportExp-"+i+"' type='text' class='form-control' " +
                                   " placeholder='yyyy'/>" +
                        "</div>" +
                    "</div>" +
                    "<hr>");
        }
};
