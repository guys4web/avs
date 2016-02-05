$(function () {   

	var fee = 0;
	$('#services').change(function() {        
        //console.log(this.value, $(this).find("option:selected").text());
        $('#service_type').text($(this).find("option:selected").text());
    });

    $('.visas').click(function() {
    	//console.log($(this).data('price'));
    	$('#visa_type').text($(this).data('name'));
    	$('#visa_fee').text($(this).data('price'));
    	fee = $(this).data("price");
    	$('#quantity').text($('#qty').val());
    	$('#order_total').text($('#qty').val() * $(this).data('price'));
    });

    $('#qty').change(function() {        
       console.log(fee + '--fee');
        $('#order_total').text($(this).val() * fee);
    });

});
